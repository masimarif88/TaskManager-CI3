<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model');
        if (!$this->session->userdata('user_id')) {
            redirect(site_url('auth/login'));
        }
    }

    public function create()
    {
        $this->_validate(); // set rules

        if ($this->form_validation->run() == FALSE) {
            // First time form load OR validation failed
            $this->load->view('tasks/form');
        } else {
            // Validation passed → insert task
            $data = [
                'user_id'     => $this->session->userdata('user_id'),
                'title'       => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE),
                'status'      => $this->input->post('status', TRUE),
                'priority'    => $this->input->post('priority', TRUE),
                'due_date'    => $this->input->post('due_date', TRUE)
            ];                

            if ($this->Task_model->insert($data)) {
                $this->session->set_flashdata('success', 'Task created successfully.');
                redirect(site_url('dashboard'));
            } else {
                $this->session->set_flashdata('error', 'Failed to create task.');
                redirect(site_url('tasks/create'));
            }
        }
    }


    public function edit($id)
    {
        $task = $this->Task_model->getById($id);

        if (!$task) redirect('dashboard');

        $this->_validate(); // sets form validation rules

        if ($this->form_validation->run() == FALSE) {
            // First load OR validation failed
            $data['task'] = $task;
            $this->load->view('tasks/form', $data);
        } else {
            // Validation passed → update task
            $data = [
                'title'       => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE) ?: null,
                'status'      => $this->input->post('status', TRUE),
                'priority'    => $this->input->post('priority', TRUE),
                'due_date'    => $this->input->post('due_date', TRUE) ?: null,
            ];

            if ($this->Task_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Task updated successfully.');
                redirect(site_url('dashboard'));
            } else {
                $this->session->set_flashdata('error', 'Failed to update task.');
                redirect(site_url('tasks/edit/'.$id));
            }
        }
    }



    public function delete($id)
    {
        if ($this->Task_model->delete($id)) {
        $this->session->set_flashdata('success', 'Task deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete task.');
        }

        redirect(site_url('dashboard'));
    }

    private function _validate()
    {
        $this->form_validation->set_rules('title','Title','required|min_length[3]');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('priority','Priority','required');
        $this->form_validation->set_rules('due_date', 'Due Date', 'required|callback_due_date_check');

    }

    public function due_date_check($date)
    {
        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            $this->form_validation->set_message('due_date_check', 'The {field} cannot be in the past.');
            return FALSE;
        }
        return TRUE;
    }

}
