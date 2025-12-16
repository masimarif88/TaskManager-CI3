<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('password','Password','required');

            if ($this->form_validation->run()) {

                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password');

                $user = $this->User_model->getByEmail($email);

                if ($user && password_verify($password, $user->password)) {                    
                    $this->session->set_userdata([
                        'user_id'    => $user->id,
                        'user_email' => $user->email
                    ]);
                    redirect(site_url('dashboard'));
                } else {
                    $data['error'] = 'Invalid email or password';
                }
            }
        }
        $this->load->view('auth/login', @$data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }

}
