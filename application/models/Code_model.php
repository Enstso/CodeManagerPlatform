<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Code_model extends CI_Model
{

    private $code_unique;
    private $code_promo;
    private $status;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function get_all_code_unique()
    {
        $this->db->select('code_unique');
        $this->db->from('code');
        $query = $this->db->get();
        return $query->result();
    }


    public function insert_code($code_unique, $code_promo, $status)
    {
        $this->code_unique = $code_unique;
        $this->code_promo = $code_promo;
        $this->status = $status;
        $this->db->insert('code', array('code_unique' => $this->code_unique, 'code_promo' => $this->code_promo, 'status' => $this->status));
    }

    public function status_to_1($code_unique)
    {
        $this->db->set('status', 1);
        $this->db->where('code_unique', $code_unique);
        $this->db->update('code');
    }

    public function getAllCode()
    {
        $this->db->select('*');
        $this->db->from('code');
        $query = $this->db->get();
        return $query->result();
    }

    public function search($code_unique, $code_promo, $status, $limit)
    {

        $this->db->select('*');
        $this->db->from('code');

      
        if (!empty($code_unique)) {
            $this->db->where('code_unique', $code_unique);
            
        }

        

        if (!empty($code_promo)) {
            $this->db->where('code_promo', $code_promo);
        }

       
        if ($status == "2") {
            $status = "0";
        }


        if (!empty($status) || $status == "0") {
            $this->db->where('status', $status);
        }
        $this->db->limit(3, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function count($code_unique, $code_promo, $status)
    {

        if ($status == "2") {
            $status = "0";
        }
        $this->db->select('*');
        $this->db->from('code');

        if (!empty($code_unique)) {
            $this->db->where('code_unique', $code_unique);
        }

        if (!empty($code_promo)) {
            $this->db->where('code_promo', $code_promo);
        }

        if (!empty($status) || $status == "0") {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }



    public function generateCode($operation)
    {

        $codes = array();
        $this->load->model('codes/Code_model');
        $this->code_unique = (time() - 166033813);
        $this->status = 0;
        for ($i = 0; $i < $operation; $i++) {
            $code = new Code_model();
            $code->code_unique = $this->code_unique . $i . 'cde';
            $code->status = $this->status;
            $codes[$i] = $code;
        }
        return $codes;
    }

    public function get_code_by_code($code_unique)
    {
        $this->db->where('code_unique', $code_unique);
        $query = $this->db->get('code');
        return $query->result();
    }



    public function truncate_table()
    {
        $this->db->truncate('code');
    }

    public function get_code_unique()
    {
        return $this->code_unique;
    }

    public function get_code_promo()
    {
        return $this->code_promo;
    }

    public function get_status()
    {
        return $this->status;
    }
}
