<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->active_menu = '';
        $this->load->library('curl'); 
        $this->additional_assets = [
            'css' => [
                'vendor/libs/typeahead-js/typeahead.css',
            ],
            'js' => [

            ],
            'page_css' => ['vendor/css/pages/page-auth.css'],
            'page_js' => []
        ];

        $this->load->library('session');
        $is_logged_in = $this->session->userdata('is_logged_in');
        if($is_logged_in) {
            redirect('feed');
        }
    }

    public function index() {
        redirect('auth/login');
    }

    public function login() {
        $options['additional_css'] = $this->additional_assets['css'];
        $options['additional_js'] = $this->additional_assets['js'];
        $options['page_css'] = $this->additional_assets['page_css'];
        $options['page_js'] = $this->additional_assets['page_js'];

        load_page('login', 'Login', $options, 'auth-layout');
    }
    
    public function register() {
        $options['additional_css'] = $this->additional_assets['css'];
        $options['additional_js'] = $this->additional_assets['js'];
        $options['page_css'] = $this->additional_assets['page_css'];
        $options['page_js'] = $this->additional_assets['page_js'];

        load_page('register', 'Register', $options, 'auth-layout');
    }

    public function do_login() {
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $response = $this->curl->simple_post(API_ENDPOINT . '/auth/login', $post_data);
            $response = json_decode($response);

            if($response->status) {
                $userdata = [
                    'is_logged_in' => true,
                    'session_token' => $response->session_token
                ];
                $this->session->set_userdata($userdata);
            }
            echo json_encode([ 'status' => $response->status, 'message' => $response->message, 'redirect' => base_url('feed') ]);
        } else {
            echo json_encode([ 'status' => false, 'message' => 'Something went wrong' ]);
        }
    }

    public function do_register() {
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $response = $this->curl->simple_post(API_ENDPOINT . '/auth/register', $post_data);
            $response = json_decode($response);

            echo json_encode([ 'status' => $response->status, 'message' => $response->message, 'redirect' => base_url('auth/login') ]);
        } else {
            echo json_encode([ 'status' => false, 'message' => 'Something went wrong' ]);
        }
    }

}