<?php
defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 0);
class Code extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {

        $this->load->view('home');
    }

    public function register()
    {

        if (!$this->session->userdata('user')) {
            redirect('login');
        } else {

            $this->load->model('Code_model');
            $data = array();
            $verif = $data['verif'] = empty($this->input->post('verif')) ? 0 : 1;
            if ($verif == 0) {
                $this->load->view('register', $data);
            } else {
                if ($verif == 1) {
                    redirect('/export');
                }
            }
        }
    }

    public function my_code($code_unique)
    {
        $data = array();
        $this->load->model('Code_model');
        $code_unique_exist = $this->Code_model->get_code_by_code($code_unique);
        if (!empty($code_unique_exist)&&$code_unique_exist[0]->status!=1) {
            $this->Code_model->status_to_1($code_unique);
        } else {
            redirect('http://www.github.com/');
        }
        $data = array('code_promo' => $code_unique_exist[0]->code_promo);
        $this->load->view('code', $data);
    }

    public function gestion($page = null)
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $code_unique = $this->input->post('code_unique');
        $codes_promo = $this->input->post('code_promo');
        $status = $this->input->post('status');

        if(!empty($code_unique)|| !empty($codes_promo)|| !empty($status)){
            
            $this->session->unset_userdata('codes_promo');
            $this->session->unset_userdata('code_unique');
            $this->session->unset_userdata('status');
            
        }
        if (!empty($code_unique)) {
            $this->session->set_userdata('code_unique', $code_unique);
        } else {
            $code_unique = $this->session->userdata('code_unique');
        }

        if (!empty($codes_promo)) {
            $this->session->set_userdata('codes_promo', $codes_promo);
        } else {
            $codes_promo = $this->session->userdata('codes_promo');
        }

        if (!empty($status)) {
            $this->session->set_userdata('status', $status);
        } else {
            $status = $this->session->userdata('status');
        }


        $this->load->model('Code_model');
        $codes_uniques = $this->Code_model->get_all_code_unique();
        $data['codes_uniques'] = $codes_uniques;

        if (!empty($code_unique) || !empty($codes_promo) || !empty($status)) {
            $this->session->unset_userdata('codes');
            $this->load->library('pagination');
            $config['base_url'] = 'http://0.0.0.0:8083/gestion/';
            $data['codes'] = $this->Code_model->search($code_unique, $codes_promo, $status, $page);
            $this->session->set_userdata('codes', $data['codes']);
                
            if (empty($this->input->post('code_unique')) || empty($this->input->post('code_promo')) || empty($this->input->post('status'))) {
                $this->session->unset_userdata('total_rows');
                $config['total_rows'] = $this->Code_model->count($code_unique, $codes_promo, $status);
                $this->session->set_userdata('total_rows', $config['total_rows']);
            } else {
                $config['total_rows'] = $this->session->userdata('total_rows');
            }
            $config['per_page'] = 3;
            $this->pagination->initialize($config);
            $data['paginate'] = $this->pagination->create_links();
        }

        if (!empty($username) && !empty($password)) {
            $this->load->model('User_model');
            $result = $this->User_model->get_user($username, $password);
            if ($result[0]->status == 1) {
                $this->session->set_userdata('admin', 'admin');
                $this->session->set_userdata('user', $username);
                $this->load->view('adminCsv', $data);
            } else {
                if (!empty($result)) {
                    $this->session->set_userdata('user', $username);
                    $this->load->view('userViews', $data);
                } else {
                    redirect('login');
                }
            }
        } else {
            if ($this->session->userdata('admin')) {
                $this->load->view('adminCsv', $data);
            } else {
                if ($this->session->userdata('user')) {
                    $this->load->view('userViews', $data);
                } else {
                    redirect('login');
                }
            }
        }
    }

    public function export_partial()
    {
        $this->load->library('session');
        $path = "/var/www/html/uploads/export_partial.csv";
        $this->load->helper('download');
        $file = fopen($path, "w+");
        $headers = array('id_code', 'code_unique', 'code_promo', 'status');
        fputcsv($file, $headers);
        $codes = $this->session->codes;
        for ($i = 0; $i < count($codes); $i++) {
            fputcsv($file, array($i + 1, $codes[$i]->code_unique, $codes[$i]->code_promo, $codes[$i]->status));
        }
        fclose($file);
        $data = file_get_contents($path);
        force_download('export_partial.csv', $data);
        shell_exec('rm /var/www/html/uploads/*');
        redirect('gestion');
    }

    public function disconnect()
    {
        $this->session->sess_destroy();
        redirect('http://0.0.0.0:8083/');
    }

    public function export()
    {
        $path = "/var/www/html/uploads/export.csv";

        $this->load->helper('download');


        $file = fopen($path, "w+");
        $headers = array('id_code', 'code_unique', 'code_promo', 'status');
        fputcsv($file, $headers);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('operation', 'operation', 'trim|required|numeric');
        $operation = $this->input->post('operation');
        if (!$this->session->userdata('user')) {
            redirect('login');
        } else {
            if ($this->form_validation->run() == false) {
                redirect('register');
            } else {

                $this->load->model('Code_model');
                $codes = $this->Code_model->generateCode($operation);

                for ($i = 0; $i < count($codes); $i++) {
                    fputcsv($file, array($i + 1, $codes[$i]->get_code_unique(), "à définir", $codes[$i]->get_status()));
                }
                fclose($file);
                $data = file_get_contents($path);

                force_download('export.csv', $data);
                shell_exec('rm /var/www/html/uploads/*');
                redirect('register');
            }
        }
    }


    public function import()
    {
        if (!$this->session->userdata('user')) {
            redirect('login');
        } else {
            shell_exec('rm /var/www/html/uploads/*');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->do_upload('csv');
            $data = array(null);
            $file = './uploads/' . $this->upload->data('file_name');
            $this->load->model('Code_model');
            if (!empty($file) && $file != './uploads/') {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $i = 0;
                    while (($dataCSV = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        if ($i == 1) {
                            $this->Code_model->truncate_table();
                        }
                        if ($i > 0) {
                            $data[$i - 1]['id_code'] = $dataCSV[0];
                            $data[$i - 1]['code_unique'] = $dataCSV[1];
                            $data[$i - 1]['code_promo'] = $dataCSV[2];
                            $data[$i - 1]['status'] = $dataCSV[3];
                            $this->Code_model->insert_code($dataCSV[1], $dataCSV[2], $dataCSV[3]);
                        }
                        $i++;
                    }
                    fclose($handle);
                }
            }
            $tab = array('data' => $data);
            $this->load->view('import', $tab);
        }
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!empty($username) && !empty($password)) {
            if ($this->form_validation->run() == FALSE) {
                redirect('login');
            } else {
                $this->load->model('User_model');
                $result = $this->User_model->get_user($username, $password);
                if (!empty($result)) {
                    redirect('gestion');
                } else {
                    $this->session->set_userdata('user', 'user');
                    redirect('login');
                }
            }
        } else {
            $this->load->view('login');
        }
    }

    public function user_gestion()
    {
        if ($this->session->userdata('admin') != 'admin') {
            redirect('login');
        } else {
            $this->load->model('User_model');
            $users = $this->User_model->get_all_user();
            $data = array('users' => $users);
            $this->load->view('user_gestion', $data);
        }
    }

    public function create_user()
    {
        if ($this->session->userdata('admin') != 'admin') {
            redirect('login');
        } else {
            if (!empty($this->input->post('username')) && !empty($this->input->post('password'))) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'username', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    redirect('user_gestion');
                }
                $this->load->model('User_model');
                $this->User_model->insert_user($this->input->post('username'), $this->input->post('password'));
                redirect('user_gestion');
            }
            $this->load->view('create_user');
        }
    }

    public function update_user($id_user)
    {
        if ($this->session->userdata('admin') != 'admin') {
            redirect('login');
        } else {
            if (!empty($this->input->post('password'))) {
                $this->load->model('User_model');
                $this->User_model->update_user($id_user, $this->input->post('password'));
                redirect('user_gestion');
            }
            $this->load->model('User_model');
            $user = $this->User_model->get_user_by_id($id_user);
            $data = array('user' => $user);
            $this->load->view('update_user', $data);
        }
    }

    public function delete_user($id_user)
    {
        if ($this->session->userdata('admin') != 'admin') {
            redirect('login');
        } else {
            $this->load->model('User_model');
            $this->User_model->delete_user($id_user);
            redirect('user_gestion');
        }
    }
}