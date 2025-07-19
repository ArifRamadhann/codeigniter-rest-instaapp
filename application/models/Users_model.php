<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate_register($username, $email) {
        $is_valid_user = $this->db->get_where('users', ['username' => $username])->num_rows() == 0 && $this->db->get_where('users', ['email' => $email])->num_rows() == 0 ? true : false;
        return $is_valid_user;
    }

    public function validate_login($username, $password) {
        $is_valid_user = $this->db->get_where('users', ['username' => $username])->num_rows() == 1 ? $this->db->get_where('users', ['username' => $username])->row() : false;
        return $is_valid_user && password_verify($password, $is_valid_user->password) ? $is_valid_user : false;
    }

    public function register($data) {
        $query = $this->db->insert('users', $data);
        return $query ?? $this->db->error();
    }

    public function update_profile($user_id, $data) {
        $query = $this->db->update('users', $data, ['id' => $user_id]);
        return $query ?? $this->db->error();
    }

    public function get_user($username, $session_token) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $current_user = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        $is_self = $current_user->username == $username ? true : false;
        if($current_user) {
            $user = $this->db->get_where('users', ['username' => $username])->row();
            if($user) {
                $user->posts = $this->db->get_where('posts', ['user_id' => $user->id])->result();
                $user->total_followers = $this->db->get_where('follows', ['following_id' => $user->id])->num_rows();
                $user->total_following = $this->db->get_where('follows', ['follower_id' => $user->id])->num_rows();
                $user->is_self = $is_self;

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}