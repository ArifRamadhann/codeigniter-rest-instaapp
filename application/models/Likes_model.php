<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Likes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function like_post($data) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $data['session_token']])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        $already_liked = $this->db->get_where('likes', ['post_id' => $data['post_id'], 'user_id' => $user_data->id])->num_rows() == 1 ? true : false;

        if($already_liked) {
            return true;
        } else {
            $this->db->insert('likes', ['post_id' => $data['post_id'], 'user_id' => $user_data->id]);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function unlike_post($data) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $data['session_token']])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        $already_liked = $this->db->get_where('likes', ['post_id' => $data['post_id'], 'user_id' => $user_data->id])->num_rows() == 1 ? true : false;

        if($already_liked) {
            $this->db->delete('likes', ['post_id' => $data['post_id'], 'user_id' => $user_data->id]);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}