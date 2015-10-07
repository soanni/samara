<?php


class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create_user($username,$email) {
        // acts as a salt to encrypt the password and the confirmation string at the same time
        $confirm = $username . time();
        $data = array(
            'username' =>$username,
            'salt'=> null,
            'pwd' => null,
            'locked' => 1,
            'email' => $email,
            'changedate'=> date('Y-m-j H:i:s'),
            'confirm_string' => $confirm
        );
        if($this->db->insert('users', $data)){
            return $this->db->insert_id();
        }
        return 0;
    }

    public function update_with_password($userid,$password){
        $salt = time();
        $password = sha1($password . $salt);
        $data = array(
            'pwd' => $password,
            'salt' => $salt,
            'locked' => 0,
            'changedate' => date('Y-m-j H:i:s')
        );
        $this->db->where('user_id', $userid);
        return $this->db->update('users', $data);
    }

    // gets user using user_id or confirm_string
    public function getUser($id, $confirm = false){
        $return = array();
        if(!$confirm){
            $query = $this->db->get_where('users', array('user_id' => $id));
        }else{
            $query = $this->db->get_where('users', array('confirm_string' => $id));
        }
        $return = $query->row_array();
        return $return;
    }

    // function to retrieve confirm string from the database for the given userid
    // for password creation
    public function getConfirmString($userid){
        if(is_numeric($userid)){
            $query = $this->db->get_where('users', array('user_id' => $userid));
            return $query->row_array()['confirm_string'];
        }
        return null;
    }
}