<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('log_user_activity')) {
    function log_user_activity($action,$usrid,$details = '') {
        $CI =& get_instance();
        $CI->load->database();
        
        $data = [
            'user_id'    => $usrid,
            'action'     => $action,
            'details'    => $details,
            'ip_address' => $CI->input->ip_address(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ];
        
        $CI->db->insert('user_activity_logs', $data);
    }
}
