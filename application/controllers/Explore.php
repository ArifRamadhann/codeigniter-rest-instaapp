<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->active_menu = 'explore';
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

        load_page('explore', 'Explore', $data);
    }

}