<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krorus_api extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model(['common_model']);
    }		
	
    public function check_license()
    {
        $mac_address = $this->input->get('license');
        $where = 'l.mac_address ="'.$mac_address.'"';
        $select = '*';
        $details = $this->common_model->get_data('licence l','', '', $select,$where, '', $count = false);
        if(!empty($details)){
            $end_date = new DateTime($details[0]->end_date);
            $today = new DateTime(date('Y-m-d'));
            $diff = $today->diff($end_date);
            //echo '<pre>'; print_r($diff);exit;
            if($diff->invert==0){
                $response['message'] = 'valid';
                $response['result'] = 'License Valid. Days left '.$diff->days;
                json_encode($response);
            }
            else{
                $response['message'] = 'valid';
                $response['result'] = 'License Complete.'.$diff->days. ' days ago';
                json_encode($response);
            }
        }else{
            $response['message'] = 'invalid';
            $response['result'] = '';
            json_encode($response);
        }
        
        print_r($response);
    }	
	
}