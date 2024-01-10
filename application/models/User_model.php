<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $username, $password,$status;
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db->insert('user', array('username' => $this->username, 'password' => $this->password));
    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_by_id($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user($username,$password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password',$password);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_user($id_user,$password)
    {
        $this->db->set('password', $password);
        $this->db->where('id', $id_user);
        $this->db->update('user');
    }

    public function delete_user($id_user)
    {
        $this->db->where('id', $id_user);
        $this->db->delete('user');
    }

}