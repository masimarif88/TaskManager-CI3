<?php
class User_model extends CI_Model {

    public function getByEmail($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('users')
            ->row();
    }
}
