<?php

class Info_model extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->helper('fetch');
    }

    /* read functions */

    public function get() {
        //$this->db->select('*')->from('info');
        //return fetch($this->db);

        return (object)[
            'admin_password' => md5(PEMILOS_PASSWORD),
            'year' => PEMILOS_YEAR,
            'theme' => PEMILOS_THEME,
            'voters' => PEMILOS_VOTERS
        ];
    }

}

?>
