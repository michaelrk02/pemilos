<?php

class Display extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');

        $this->load->model('info_model');
        $this->load->model('users_model');
    }

    public function index() {
        redirect(site_url('display/live_count'));
    }

    public function live_count() {
        $info = $this->info_model->get();

        $all_votes = $this->users_model->get_all_votes();
        $percentage = round((float)$all_votes / (float)$info->voters * 100.0, 2);

        $this->data['all_votes'] = $all_votes;
        $this->data['voters'] = $info->voters;
        $this->data['percentage'] = $percentage;

        $this->render('templates/header');
        $this->render('display/index');
        $this->render('templates/footer');
    }

    private function render($page) {
        $this->data['info'] = $this->info_model->get();

        $this->load->view($page, $this->data);
    }

}

?>
