<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        check_delete();
        if($this->session->userdata('type')!=1 && $this->uri->segment(1)!='change_password'){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $this->load->model(['admin/user_model','common_model']);
    }		
	
    public function index(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|callback_mobile_unique');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
        $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');
        if($this->form_validation->run() == FALSE){
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $this->load->view('admin/user',$data);
        }else{
            $this->user_model->add_user();	
        }
       	    
    }
    
    public function email_unique(){
        $where = ' status != "0" AND email = "'.$this->input->post('email').'"'; 
        if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-user'){
            $where = ' status != "0" AND email = "'.$this->input->post('email').'" AND id != '.$this->uri->segment(1);
        }
        $select = 'id';
        $count = $this->common_model->get_data('admin','', '', $select,$where,'', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    public function mobile_unique(){
        $where = ' status != "0" AND contact_number = "'.$this->input->post('mobile').'"'; 
        if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-user'){
            $where = ' status != "0" AND contact_number = "'.$this->input->post('mobile').'" AND id != '.$this->uri->segment(1);
        }
        $select = 'id';                   
        $count = $this->common_model->get_data('admin','', '', $select,$where,'', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    public function user_list(){
        $data['users'] = $this->user_model->all_user();    
        $this->load->view('admin/user_list',$data);	    
    }

    public function delete_user(){
        //echo preg_match_all("/delete/i", $this->router->fetch_class()).'__'.preg_match_all("/delete/i", $this->router->fetch_method())."<br>";
        //echo $this->router->fetch_class().'_'.$this->router->fetch_method(); exit;
        $this->user_model->delete_user();    
    }

    public function edit_user(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|callback_mobile_unique');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
        $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');
        if($this->form_validation->run() == FALSE){
            $data['user'] = $this->user_model->get_user(); 
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $this->load->view('admin/edit_user',$data);            
        }else{
            $this->user_model->update_user();	
        }   
        	    
    }
	
    public function change_password(){
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/change_password');
        }else{
            $where = 'id='.$this->session->userdata('id');
            $result = $this->common_model->get_data('admin','', '', 'password',$where,'', $count = false);
            if($result[0]->password<>$this->input->post('current_password')){
                $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid current password!</div>');
                redirect('change_password');
            }else{
                $update_arr = ['password'=>$this->input->post('new_password')];
                $this->common_model->update_data(['table_name'=>'admin','update_data'=>$update_arr,
                                            'condition'=>['id'=>$this->session->userdata('id')]]);
                $this->session->set_flashdata('message','<div class="alert alert-success">Password Changed Successfully!</div>');
                redirect('change_password');
                
            }
            //echo '<pre>';print_r($result);exit; 
        }
        
        
        
        
        
    }
	
}
