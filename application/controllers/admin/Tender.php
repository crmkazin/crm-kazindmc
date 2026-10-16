<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tender extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		$this->load->model('admin/tender_model');
		$this->load->model('admin/enquiry_model');
		$this->load->model('common_model');
	}		
	
	public function index()
	{
	     
		if($this->input->post('submit') == 'Submit'){
		$result = $this->tender_model->new_tender();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect('tender-list');			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect('tender-list');			
		}
		}
		$select = '*';
        $where = ' status = "1"';
        $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
        $data['financial_year'] = $financial_year->year;
		$data['products'] = $this->enquiry_model->products();
		$data['bid_no'] = $this->tender_model->get_bid_no();
		$num = explode('/',$data['bid_no']);
        $data['financial_year_bid_number'] = (int)end($num);
		$this->load->view('admin/tender',$data);
	}	

    public function edit_tender(){

		if($this->input->post('submit') == 'Update'){
		$result = $this->tender_model->update_tender();
		
		if($result){
		$this->session->set_flashdata('message','Updated Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','You have Not Changed anything!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$this->load->model('admin/enquiry_model');
		$data['products'] = $this->enquiry_model->products();
		$data['detail'] = $this->tender_model->tender_detail();
		$data['branches'] = $this->tender_model->company_branch($data['detail']->company_id);
		$data['bid_no'] = $this->tender_model->get_bid_no_by_id($data['detail']->id);
		$data['bid_num'] = $this->tender_model->get_bid_no();
		
		if(empty($data['bid_no'])){
            $num = explode('/',$data['bid_num']);
            $data['financial_year_bid_number'] = (int)end($num);
        }
		
		$select = '*';
        $where = ' status = "1"';
        $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
        $data['financial_year'] = $financial_year->year;
		
		$this->load->view('admin/edit_tender',$data);
        
    }

    public function tender_list(){
		$data['tenders'] = $this->tender_model->all_tender();
		$this->load->view('admin/tender_list',$data);        
    }

    public function delete_tender(){
    $this->tender_model->delete_tender();
    }

    public function delete_tender_followup(){
    $this->tender_model->delete_tender_followup();    
    }
	
	public function bid(){		
            $data['bids'] = $this->tender_model->all_bid();
            //echo '<pre>';            print_r($data);die;
            $this->load->view('admin/bid',$data);		
	}
	
	public function edit_bid(){

	if($this->input->post('submit') == 'Update'){
            $result = $this->tender_model->update_bid();
		
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');	
                redirect('bid');			
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger">Error!</div>');	
                redirect('bid');			
            }
	}
		
	$data['detail'] = $this->tender_model->bid_detail();
	$data['branches'] = $this->tender_model->company_branch($data['detail']->company_id);
	$data['products'] = $this->enquiry_model->products();
	$this->load->view('admin/edit_bid',$data);		
	}	
	
    public function delete_bid(){
    $this->tender_model->delete_bid();
    }	

    public function delete_bid_followup(){
    $this->tender_model->delete_bid_followup();    
    }

    public function change_approval(){
    $this->tender_model->change_approval();     
    }
	
}
