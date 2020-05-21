<?php

class User extends CI_Controller {

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
        redirect(site_url('user/token_input'));
    }

    public function auth() {
        if (isset($this->session->pemilos_auth)) {
            redirect(site_url('user'));
        }

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            $password = $this->input->post('password');

            if (md5($password) === $this->info_model->get()->admin_password) {
                $this->session->pemilos_auth = TRUE;
                redirect(site_url('user'));
            } else {
                $this->data['status'] = status_failure('Incorrect password');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }

        $this->render('templates/header');
        $this->render('user/auth');
        $this->render('templates/footer');
    }

    public function token_input() {
        $this->auth_check();
        $this->action_check(TRUE, TRUE);

        $this->form_validation->set_rules('token', 'Token', 'required');

        if ($this->form_validation->run() === TRUE) {
            $token = $this->input->post('token');
            $user = $this->users_model->get($token);

            if (isset($user)) {
                if ($user->vote_id == 0) {
                    $this->session->pemilos_token = $token;
                    redirect(site_url('user/vote'));
                } else {
                    $this->data['status'] = status_failure('Token tersebut sudah digunakan sebelumnya. Mintalah token yang baru kepada panitia');
                }
            } else {
                $this->data['status'] = status_failure('Token yang anda masukkan salah. Mohon dikoreksi lagi');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }

        $this->render('templates/header');
        $this->render('user/token_input');
        $this->render('templates/footer');
    }

    public function vote() {
        $this->auth_check();
        $this->token_check();
        $this->action_check(FALSE, TRUE);

        $this->form_validation->set_rules('vote_id', 'Candidate ID', 'required');

        if ($this->form_validation->run() === TRUE) {
            $user = $this->users_model->get($this->session->pemilos_token);
            if (isset($user)) {
                $vote_id = $this->input->post('vote_id');
                $this->users_model->set($user->token, array('vote_id' => $vote_id));
                redirect(site_url('user/finish'));
            } else {
                unset($_SESSION['pemilos_token']);
                redirect(site_url('user/token_input'));
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }

        $this->data['candidates'] = $this->candidates_model->get_all();

        $this->render('templates/header');
        $this->render('user/vote');
        $this->render('templates/footer');
    }

    public function finish() {
        $this->auth_check();
        $this->token_check();
        $this->action_check(TRUE, FALSE);

        $this->render('templates/header');
        $this->render('user/finish');
        $this->render('templates/footer');
    }

    public function token_unset() {
        unset($_SESSION['pemilos_token']);
        redirect(site_url('user'));
    }

    public function logout() {
        unset($_SESSION['pemilos_token']);
        unset($_SESSION['pemilos_auth']);
        redirect(site_url('user'));
    }

    private function auth_check() {
        if (!isset($this->session->pemilos_auth)) {
            redirect(site_url('user/auth'));
        }
    }

    private function token_check() {
        if (!isset($this->session->pemilos_token)) {
            $page = site_url('user/token_input');
            die('ERROR: token belum dimasukkan. Silakan kunjungi <a href="'.$page.'">'.$page.'</a> untuk memasukkan token');
        }
    }

    private function action_check($vote, $finish) {
        if (isset($this->session->pemilos_token)) {
            $user = $this->users_model->get($this->session->pemilos_token);
            if ($user->vote_id == 0) {
                if ($vote === TRUE) {
                    redirect(site_url('user/vote'));
                }
            } else {
                if ($finish === TRUE) {
                    redirect(site_url('user/finish'));
                }
            }
        }
    }

    private function render($page) {
        $this->data['info'] = $this->info_model->get();

        $this->load->view($page, $this->data);
    }

}

?>
