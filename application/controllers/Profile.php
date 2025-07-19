<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->active_menu = 'profile';
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
        redirect('profile/view/' . $this->user_data->username);
    }

    public function view($username) {
        $postData = [
            'username' => $username,
            'session_token' => $this->session->userdata('session_token')
        ];
        $response = $this->curl->simple_post(API_ENDPOINT . '/user/show', $postData);
        $response = json_decode($response);
        $data['profile'] = $response->data;

        load_page('profile', 'Profile', $data);
    }

    public function settings() {
        load_page('settings', 'Profile Settings');
    }

    public function save_settings() {
        $postData = $this->input->post();
        if(!empty($postData)) {

            if(!empty($_FILES['profile_picture']['name'])) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('profile_picture')) {
                    $data = $this->upload->data();
                    $postData['profile_picture'] = $data['file_name'];

                    if(file_exists('./assets/uploads/' . $this->user_data->profile_picture)) {
                        unlink('./assets/uploads/' . $this->user_data->profile_picture);
                    }
                }
            }

            $postData = [
                'user_id' => $this->user_data->user_id,
                'username' => $postData['username'],
                'full_name' => $postData['full_name'],
                'email' => $postData['email'],
                'bio' => $postData['bio'],
                'profile_picture' => $postData['profile_picture']
            ];

            $response = $this->curl->simple_post(API_ENDPOINT . '/user/update', $postData);
            $response = json_decode($response);
            echo json_encode([ 'status' => $response->status, 'message' => $response->message, 'redirect' => base_url('profile') ]);
        } else {
            echo json_encode([ 'status' => false, 'message' => 'Something went wrong' ]);
        }
    }

}