<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Comment extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('comments_model');
    }

    public function add_post() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            $is_commented = $this->comments_model->comment_post($postData);
            if($is_commented) {
                $this->response([
                    'status' => true,
                    'message' => 'Post commented successfully',
                    'data' => $is_commented
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to comment post'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Something went wrong'
            ], 200);
        }
    }

    public function remove_post() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            $is_removed = $this->comments_model->uncomment_post($postData);
            if($is_removed) {
                $this->response([
                    'status' => true,
                    'message' => 'Comment removed successfully'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to remove comment'
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