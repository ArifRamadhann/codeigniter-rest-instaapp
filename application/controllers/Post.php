<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->active_menu = 'post';
        $this->user_data = null;

        $this->load->library('session');
        $this->load->library('curl');
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!$is_logged_in) {
            redirect('auth/login');
        } else {
            $response = $this->curl->simple_post(API_ENDPOINT . '/auth/me', ['session_token' => $this->session->userdata('session_token')]);
            $response = json_decode($response);
            $this->user_data = $response->data;
        }
    }

    public function index() {
        load_page('post', 'New Post');
    }

    public function add() {
        $postData = $this->input->post();
        if(!empty($postData)) {
            
            if(!empty($_FILES['image_url']['name'])) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('image_url')) {
                    $data = $this->upload->data();
                    $postData['image_url'] = $data['file_name'];
                }
            }
            
            $postData = [
                'user_id' => $this->user_data->user_id,
                'image_url' => $postData['image_url'] ?? '',
                'caption' => $postData['caption']
            ];

            $response = $this->curl->simple_post(API_ENDPOINT . '/post/create', $postData);
            $response = json_decode($response);
            echo json_encode([ 'status' => $response->status, 'message' => $response->message, 'redirect' => base_url('feed') ]);
        } else {
            echo json_encode([ 'status' => false, 'message' => 'Something went wrong' ]);
        }
    }

    public function like($id) {
        $postData = [
            'post_id' => $id,
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/like/like', $postData);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message ]);
    }

    public function unlike($id) {
        $postData = [
            'post_id' => $id,
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/like/unlike', $postData);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message ]);
    }

    public function detail($id) {
        $this->active_menu = 'feed';
        $postData = [
            'post_id' => $id,
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/post/show', $postData);
        $response = json_decode($response);
        load_page('detail', 'Post Detail', [ 'post' => $response->data ]);
    }

    public function comment($id) {
        $this->active_menu = 'feed';
        $postData = [
            'post_id' => $id,
            'comment' => $this->input->post('comment'),
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/comment/add', $postData);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message, 'data' => $response->data ]);
    }

    public function uncomment($id) {
        $this->active_menu = 'feed';
        $postData = [
            'comment_id' => $id,
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/comment/remove', $postData);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message ]);
    }

}