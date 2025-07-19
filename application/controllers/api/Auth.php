<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model', 'user');
        $this->load->model('sessions_model', 'sess');
    }

    public function login_get() {
        $this->response([
            'status' => true,
            'message' => 'Login Action'
        ], 200);
    }

    public function login_post() {
        $postData = $this->input->post();

        $username = $postData['username'] ?? '';
        $password = $postData['password'] ?? '';
        $valid_user = $this->user->validate_login($username, $password);

        if($valid_user) {
            $session_data = $this->sess->do_login($valid_user);
            if($session_data) {
                $this->response([
                    'status' => true,
                    'message' => 'Login Success',
                    'session_token' => $session_data['session_token']
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Invalid Username or Password'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Username or Password'
            ], 200);
        }
    }

    public function register_get() {
        $this->response([
            'status' => true,
            'message' => 'Register Action'
        ], 200);
    }

    public function register_post() {
        $postData = $this->input->post();

        $username = $postData['username'] ?? '';
        $email = $postData['email'] ?? '';
        $is_valid_user = $this->user->validate_register($username, $email);

        if($is_valid_user) {

            $password = password_hash(($postData['password'] ?? 'user123'), PASSWORD_BCRYPT);
            $register_data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'full_name' => $postData['full_name'] ?? $username,
            ];

            $do_register = $this->user->register($register_data);
            if($do_register) {

                 $this->response([
                    'status' => true,
                    'message' => 'Register Process Successful',
                ], 200);
            
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to register user',
                    'error' => $do_register
                ], 200);
            }

        } else{
            $this->response([
                'status' => false,
                'message' => 'Username or Email already exist',
            ], 200);
        }

    }

    public function me_post() {
        $postData = $this->input->post();
        if(isset($postData['session_token'])) {
            $login_info = $this->sess->validate_session($postData['session_token']);
            $this->response([
                'status' => true,
                'message' => 'Login Info',
                'data' => $login_info
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Session Token'
            ], 200);
        }
    }

    public function logout_get() {
        $this->response([
            'status' => true,
            'message' => 'Logout Action'
        ], 200);
    }

    public function logout_post() {
        $this->response([
            'status' => true,
            'message' => 'Logout Process'
        ], 200);
    }
}