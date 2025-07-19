<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Follow extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('follows_model');
    }

    public function suggestion_post() {
        $postData = $this->input->post();
        if(isset($postData['session_token'])) {
            $follows = $this->follows_model->get_suggestion($postData['session_token']);
            if($follows) {
                $this->response([
                    'status' => true,
                    'message' => 'Follows',
                    'data' => $follows
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to get follows'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Session Token'
            ], 200);
        }
    }

    public function follow_post() {
        $postData = $this->input->post();
        if(isset($postData['session_token']) && isset($postData['user_id'])) {
            $follow = $this->follows_model->follow($postData['session_token'], $postData['user_id']);
            if($follow) {
                $this->response([
                    'status' => true,
                    'message' => 'Follow'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to follow'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Session Token'
            ], 200);
        }
    }

    public function unfollow_post() {
        $postData = $this->input->post();
        if(isset($postData['session_token']) && isset($postData['user_id'])) {
            $follow = $this->follows_model->unfollow($postData['session_token'], $postData['user_id']);
            if($follow) {
                $this->response([
                    'status' => true,
                    'message' => 'Unfollow'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to unfollow'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Session Token'
            ], 200);
        }
    }

}