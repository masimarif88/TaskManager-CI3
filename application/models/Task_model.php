<?php
class Task_model extends CI_Model {

    public function getTasks($userId, $search = null, $status = null)
    {
        $this->db->where('user_id', $userId);

        if ($search) {
            $this->db->like('title', $search);
        }

        if ($status) {
            $this->db->where('status', $status);
        }

        return $this->db->order_by('created_at','DESC')->get('tasks')->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('tasks', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('tasks', $data);
    }

    public function update($id, $data)
    {
        // Ensure $data is array
        if (!is_array($data)) {
            $data = (array) $data;
        }
         $this->db->where('id', $id);
         return $this->db->update('tasks', $data);
         //return $this->db->where('id', $id)->update('tasks', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('tasks', ['id' => $id]);
    }
}
