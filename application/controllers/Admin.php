<?php

class Admin extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('status');
        $this->load->helper('url');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('candidates_model');
        $this->load->model('info_model');
        $this->load->model('users_model');
    }

    public function index() {
        redirect(site_url('admin/results'));
    }

    public function auth() {
        if (isset($this->session->pemilos_admin)) {
            redirect(site_url('admin'));
        }

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            $password = $this->input->post('password');

            if (md5($password) === $this->info_model->get()->admin_password) {
                $this->session->pemilos_admin = TRUE;
                redirect(site_url('admin'));
            } else {
                $this->data['status'] = status_failure('Sorry lur dudu kui password');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }

        $this->render('templates/header');
        $this->render('admin/auth');
        $this->render('templates/footer');
    }

    public function results() {
        $this->auth_check();

        $candidates = $this->candidates_model->get_all();
        $votes = array();
        foreach ($candidates as $candidate) {
            $votes[$candidate->id] = $this->users_model->get_votes($candidate->id);
        }

        $this->data['candidates'] = $candidates;
        $this->data['votes'] = $votes;

        $this->render('templates/header');
        $this->render('admin/results');
        $this->render('templates/footer');
    }

    private function auth_check() {
        if (!isset($this->session->pemilos_admin)) {
            redirect(site_url('admin/auth'));
        }
    }

    private function render($page) {
        $this->data['info'] = $this->info_model->get();

        $this->load->view($page, $this->data);
    }

}

?>
