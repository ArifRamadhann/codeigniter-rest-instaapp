<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model', 'user');
    }

    public function update_post() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            $saveData = [
                'username' => $postData['username'],
                'full_name' => $postData['full_name'],
                'profile_picture' => $postData['profile_picture'],
                'email' => $postData['email'],
                'bio' => $postData['bio'],
            ];
            $updatedUser = $this->user->update_profile($postData['user_id'], $saveData);
            if($updatedUser) {
                $this->response([
                    'status' => true,
                    'message' => 'Profile updated successfully',
                    'data' => $updatedUser
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to update profile'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Something went wrong'
            ], 200);
        }
    }

    public function show_post() {
        $postData = $this->input->post();
        if(isset($postData['username']) && isset($postData['session_token'])) {
            $userDetails = $this->user->get_user($postData['username'], $postData['session_token']);
            if($userDetails) {
                $this->response([
                    'status' => true,
                    'message' => 'User Details',
                    'data' => $userDetails
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to get user details'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Something went wrong'
            ], 200);
        }
    }
}