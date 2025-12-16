<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model');
        if (!$this->session->userdata('user_id')) {
            redirect(site_url('auth/login'));
        }
    }

    public function index()
    {
         $userId = $this->session->userdata('user_id');
         if (!$userId) redirect('auth/login');

        $search = $this->input->get('search', TRUE);
        $status = $this->input->get('status', TRUE);

        $data['tasks'] = $this->Task_model->getTasks(
            $this->session->userdata('user_id'),
            $search,
            $status
        );

         // Pass search and status back to view
        $data['search'] = $search;
        $data['status_filter'] = $status;

        $this->load->view('dashboard/index', $data);
    }
}
