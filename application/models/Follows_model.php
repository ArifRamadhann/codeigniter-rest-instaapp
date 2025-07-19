<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follows_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_suggestion($session_token) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        if($user_data) {
            $users = $this->db->select('id, username, full_name, profile_picture')->get_where('users', ['id !=' => $user_data->id])->result();

            foreach($users as $key => $user) {
                $users[$key]->is_followed = $this->db->get_where('follows', ['follower_id' => $user_data->id, 'following_id' => $user->id])->num_rows() == 1 ? true : false;
                $users[$key]->is_following = $this->db->get_where('follows', ['follower_id' => $user->id, 'following_id' => $user_data->id])->num_rows() == 1 ? true : false;
            }

            return $users;
        }
    }

    public function follow($session_token, $user_id) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        if($user_data) {
            $follow = $this->db->insert('follows', ['follower_id' => $user_data->id, 'following_id' => $user_id]);
            if($follow) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function unfollow($session_token, $user_id) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        if($user_data) {
            $follow = $this->db->delete('follows', ['follower_id' => $user_data->id, 'following_id' => $user_id]);
            if($follow) {
                return true;
            } else {
                return false;
            }
        }
    }
}