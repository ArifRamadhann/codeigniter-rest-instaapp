<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function do_login($userdata) {
        $session_data = [
            'user_id' => $userdata->id,
            'session_token' => password_hash($userdata->id . '-' . $userdata->username . '-' . time(), PASSWORD_BCRYPT),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $this->input->user_agent(), 
        ];

        $query = $this->db->insert('sessions', $session_data);
        return $query ? $session_data : $this->db->error();
    }

    public function validate_session($session_token) {
        $query = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $user = $this->db->get_where('users', ['id' => $query->user_id])->row();
        $data = [
            "user_id" => $user->id,
            "session_token" => $query->session_token,
            "username" => $user->username,
            "email" => $user->email,
            "full_name" => $user->full_name,
            "profile_picture" => $user->profile_picture,
            "bio" => $user->bio
        ];
        return $query ? $data : false;
    }
}