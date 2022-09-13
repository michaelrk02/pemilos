<?php

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->helper('fetch');
    }

    /* create functions */

    public function insert($token) {
        $this->db->insert('users', ['token' => $token, 'vote_id' => 0]);
    }

    /* read functions */

    public function get_tokens() {
        $this->db->select('*')->from('users');

        return $this->db->get()->result_array();
    }

    public function count_tokens() {
        $this->db->select('COUNT(*)')->from('users');

        return $this->db->get()->row_array(0)['COUNT(*)'];
    }

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

    /* delete functions */

    public function reset() {
        $this->db->truncate('users');
    }

}

?>
