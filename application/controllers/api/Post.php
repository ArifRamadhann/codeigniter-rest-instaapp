<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Post extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('posts_model');
    }

    public function create_post() {
        $postData = $this->input->post();
        
        if(!empty($postData)) {
            $saveData = [
                'user_id' => $postData['user_id'],
                'caption' => $postData['caption'],
                'image_url' => $postData['image_url']
            ];
            $createdPost = $this->posts_model->add_post($saveData);
            if($createdPost) {
                $this->response([
                    'status' => true,
                    'message' => 'Post created successfully',
                    'data' => $createdPost
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to create post'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Something went wrong'
            ], 200);
        }
    }

    public function feeds_post() {
        $postData = $this->input->post();
        if(isset($postData['session_token'])) {
            $feed = $this->posts_model->get_feed($postData['session_token']);
            if($feed) {
                $this->response([
                    'status' => true,
                    'message' => 'Feed',
                    'data' => $feed
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to get feed'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid Session Token'
            ], 200);
        }
    }

    public function show_post() {
        $postData = $this->input->post();
        if(isset($postData['post_id']) && isset($postData['session_token'])) {
            $postDetails = $this->posts_model->get_post($postData['post_id'], $postData['session_token']);
            if($postDetails) {
                $this->response([
                    'status' => true,
                    'message' => 'Post Details',
                    'data' => $postDetails
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to get post details'
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