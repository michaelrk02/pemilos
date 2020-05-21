<?php

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->helper('fetch');
    }

    /* read functions */

    public function get($token) {
        $this->db->select('*')->from('users');
        $this->db->where('token =', $token);

        return fetch($this->db);
    }

    public function get_votes($candidate_id) {
        $this->db->select('COUNT(*)')->from('users');
        $this->db->where('vote_id =', $candidate_id);

        return $this->db->get()->row_array(0)['COUNT(*)'];
    }

    public function get_all_votes() {
        $this->db->select('COUNT(*)')->from('users');
        $this->db->where('vote_id !=', 0);

        return $this->db->get()->row_array(0)['COUNT(*)'];
    }

    /* update functions */

    public function set($token, $data) {
        $this->db->where('token =', $token);
        $this->db->update('users', $data);
    }

}

?>
