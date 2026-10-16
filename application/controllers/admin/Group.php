<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		if($this->session->userdata('type') == 3){
		redirect($_SERVER['HTTP_REFERER']);	    
		}
		$this->load->model(['admin/group_model','common_model']);
	}		

	public function index(){
	    
	if($this->input->post('submit') == 'Submit'){
    $this->group_model->add_group();	
	}   
	    
	$this->load->view('admin/group');	    
	}
	
	public function group_list(){
	    
	$data['groups'] = $this->group_model->all_groups();    
	$this->load->view('admin/group_list',$data);	    
	}

    public function delete_group(){
        $client_group_id = $this->uri->segment(1);
        if($client_group_id != '' && is_numeric($client_group_id)){
            $where = 'client_group_id = '.$client_group_id;
            $result = $this->common_model->get_data('products','', '', '*',$where, '', $count = true);
            if($result != 0){
                $this->session->set_flashdata('message','<div class="alert alert-danger">Cannot Delete Group!</div>');
                redirect('group-list');
            }             
            $this->group_model->delete_group();    
        }    
    }

	public function edit_group(){
	    
	if($this->input->post('update') == 'Update'){
    $this->group_model->update_group();	
	}   
	    
	$data['group'] = $this->group_model->get_group();    
	$this->load->view('admin/edit_group',$data);	    
	}
	
	
	
}
