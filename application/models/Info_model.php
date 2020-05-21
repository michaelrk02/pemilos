<?php

class Info_model extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->helper('fetch');
    }

    /* read functions */

    public function get() {
        $this->db->select('*')->from('info');

        return fetch($this->db);
    }

}

?>
