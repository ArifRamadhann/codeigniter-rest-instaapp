<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->active_menu = 'feed';
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
        $response1 = $this->curl->simple_post(API_ENDPOINT . '/post/feeds', ['session_token' => $this->session->userdata('session_token')]);
        $response1 = json_decode($response1);
        $data['feeds'] = $response1->data;

        $response2 = $this->curl->simple_post(API_ENDPOINT . '/follow/suggestion', ['session_token' => $this->session->userdata('session_token')]);
        $response2 = json_decode($response2);
        $data['suggestions'] = $response2->data;

        load_page('feeds', 'Feeds', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function follow($user_id) {
        $response = $this->curl->simple_post(API_ENDPOINT . '/follow/follow', ['session_token' => $this->session->userdata('session_token'), 'user_id' => $user_id]);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message ]);
    }

    public function unfollow($user_id) {
        $response = $this->curl->simple_post(API_ENDPOINT . '/follow/unfollow', ['session_token' => $this->session->userdata('session_token'), 'user_id' => $user_id]);
        $response = json_decode($response);
        echo json_encode([ 'status' => $response->status, 'message' => $response->message ]);
    }

}