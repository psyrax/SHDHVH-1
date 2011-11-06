<?php

class Users_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_users($num, $offset)
    {
        $query = $this->db->get('users', $num, $offset);  
        return $query->result();
    }
    function get_all_users()
    {
        $query = $this->db->get('users');  
        return $query->result();
    }
    function create_user($table,$user){
        $query = $this->db->insert($table,$user);
    }

    function get_user($table,$uid)
    {
        $query = $this->db->get_where($table, array('uid'=>$uid));
        if($query->result()):
            $info=$query->result();
            return $info[0];
        else:
            return NULL;
        endif;
    }
    function cache_user_data($uid, $data){
        $this->db->where('uid', $uid);
        $insert=$this->db->update('users', $data); 
        return $insert;
    }
}
/* End of file users_model.php */
/* Location: ./application/models/alpha_users_model.php */