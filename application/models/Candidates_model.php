<?php

class Candidates_model extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->helper('fetch');
    }

    /* read functions */

    public function get($id) {
        $this->db->select('*')->from('candidates');
        $this->db->where('id =', $id);

        return fetch($this->db);
    }

    public function get_all() {
        $this->db->select('*')->from('candidates');

        return fetch($this->db, -1);
    }

}

?>
