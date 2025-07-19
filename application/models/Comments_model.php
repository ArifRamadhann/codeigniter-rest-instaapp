<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function comment_post($data) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $data['session_token']])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();

        $this->db->insert('comments', ['post_id' => $data['post_id'], 'user_id' => $user_data->id, 'comment' => $data['comment']]);
        $insert_id = $this->db->insert_id();
        if($this->db->affected_rows() > 0) {
            return $this->db->get_where('comments', ['id' => $insert_id])->row();
        } else {
            return false;
        }
    }

    public function uncomment_post($data) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $data['session_token']])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();

        $this->db->delete('comments', ['user_id' => $user_data->id, 'id' => $data['comment_id']]);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}