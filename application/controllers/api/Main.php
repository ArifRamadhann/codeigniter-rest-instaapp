<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Main extends RestController {
    public function __construct() {
        parent::__construct();
    }

    public function index_get() {
        $this->response([
            'status' => true,
            'message' => 'InstaApp API by Arif B. Ramadhan'
        ], 200);
    }

    public function not_found_get() {
        $this->response([
            'status' => false,
            'message' => 'Not Found'
        ], 404);
    }
}