<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_delete')){
    function check_delete(){
        $CI =& get_instance();
        if($CI->session->userdata('admin_type')!='superadmin'){
            if((preg_match_all("/delete/i", $CI->router->fetch_class()) || preg_match_all("/delete/i", $CI->router->fetch_method()))){
                $CI->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
                redirect('dashboard');
            }
        }
    }    
}