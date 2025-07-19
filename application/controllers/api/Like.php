<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Like extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('likes_model');
    }

    public function like_post() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            $is_liked = $this->likes_model->like_post($postData);
            if($is_liked) {
                $this->response([
                    'status' => true,
                    'message' => 'Post liked successfully'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to like post'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Something went wrong'
            ], 200);
        }
    }

    public function unlike_post() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            $is_unliked = $this->likes_model->unlike_post($postData);
            if($is_unliked) {
                $this->response([
                    'status' => true,
                    'message' => 'Post unliked successfully'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to unlike post'
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