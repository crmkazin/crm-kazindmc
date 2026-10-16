<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		$this->load->model('admin/company_model');
	}	

	public function get_country_ajax(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->company_model->get_country_ajax($postData);

    echo json_encode($data);
	}	
	
	public function get_state_ajax(){
    $postData = $this->input->post();
    $data = $this->company_model->get_state_ajax($postData);
    echo json_encode($data);	
	}	
	
	public function get_city_ajax(){
    $postData = $this->input->post();
    $data = $this->company_model->get_city_ajax($postData);
    echo json_encode($data);	
	}	
	
	public function get_branch_ajax(){
	$this->company_model->get_branch_ajax();	
	}
	
	public function branch_detail_ajax(){
	$this->company_model->branch_detail_ajax();
	}	
	
	public function company_name_suggesstion(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->company_model->company_name_suggesstion($postData);

    echo json_encode($data);
	}
	
	public function enquiry_suggesstion(){

    $postData = $this->input->post();
    $data = $this->company_model->enquiry_suggesstion($postData);

    echo json_encode($data);
	}	
	
	public function index()
	{
		if($this->input->post('submit') == 'Submit'){
 
		$result = $this->company_model->new_company();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		
		if($this->input->post('submit') == 'update'){	
			
		$result = $this->company_model->update_company();
		
		if($result){
		$this->session->set_flashdata('message','Updated Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','You have not Chnaged anything or Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		} 
		}		
		
		if($this->input->post('submit') == 'Add Branch'){
			
		$result = $this->company_model->new_branch();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}		
		$this->load->model('admin/group_model');
		$data['groups'] = $this->group_model->all_groups();
		$data['countries'] = $this->company_model->all_countries();	
		$this->load->view('admin/company',$data);
	}
	
	public function clients(){
		$data['company'] = $this->company_model->all_company();
		$this->load->view('admin/all_client',$data);	    
	}
		
	public function branch()
	{
		if($this->input->post('submit') == 'Submit'){
			
		$result = $this->company_model->new_branch();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$data['company'] = $this->company_model->company_name();
		$data['countries'] = $this->company_model->all_countries();	
		$this->load->view('admin/branch',$data);
	}	
	
    public function delete_client(){
        
    $result = $this->company_model->delete_client();
    
		if($result){
		$this->session->set_flashdata('message','Deleted Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}    
    }

	
}
