<?php
$GLOBALS['CI'] =& get_instance();

if(!function_exists('assets')) {
	function assets($path = null) {
		global $CI;

		$CI->load->helper('url');
		return base_url('assets/' . $path);
	}
}

if(!function_exists('load_page')) {
    function load_page($page, $title, $options = [], $layout = 'layout') {
        global $CI;
        $data['title'] = $title;
        $data['page'] = $page;
        $data['options'] = $options;

        $CI->load->view($layout, $data);
    }
}