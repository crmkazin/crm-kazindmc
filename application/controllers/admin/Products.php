<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		if($this->session->userdata('type') == 3){
		redirect($_SERVER['HTTP_REFERER']);    
		}
		$this->load->model('admin/product_model');
		$this->load->model(['admin/enquiry_model','common_model']);
		
	}		
	
	public function other_product(){

	$data['products'] = $this->product_model->other_product();
	$this->load->view('admin/other_product',$data);		
	}
		public function product_name_suggesstion(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->product_model->product_name_suggesstion($postData);

    echo json_encode($data);
	}
	
	public function edit_product(){
	
	if($this->input->post('submit') == 'Submit'){
    $this->product_model->update_product();	
	}
	
	$this->load->model('admin/user_model');
    $data['users'] = $this->user_model->all_user();	
	$data['clients'] = $this->product_model->all_client();    
    $data['old_products'] = $this->enquiry_model->products();
	$data['product'] = $this->product_model->edit_product();
	$this->load->view('admin/edit_product',$data);	
    
	}
	
	public function product(){
	    
    	if($this->input->post('submit') == 'Submit' && trim($this->input->post('new_product')) != ''){
    	    $select = '*';
            $where = ' LOWER(name) = "'. strtolower(trim($this->input->post('new_product'))).'"';
            $cnt_result = $this->common_model->get_data('products','', '', $select,$where, '', $count = true);
            if($cnt_result != 0){
                $this->session->set_flashdata('message','<div class="alert alert-danger">Product Already Created!</div>');
                redirect('product');
            }
            $this->product_model->add_product();	
    	}   
    	    
    	$data['products'] = $this->enquiry_model->products(); 
    	$data['groups'] = $this->common_model->get_data('client_group','', '','*','', ' ORDER BY client_group.group_name ASC', $count = false);
    	$this->load->view('admin/product',$data);	    
	}

    public function delete_product(){
        
        $product = $this->product_model->get_product();
        $select = '*';
        $where = ' LOWER(enquiry_for) = "'. strtolower(trim($product->name)).'" AND is_deleted = 0';
        $cnt_result1 = $this->common_model->get_data('enquiry','', '', $select,$where, '', $count = true);
        
        $where = ' LOWER(equipment) = "'. strtolower(trim($product->name)).'" AND is_deleted = 0';
        $cnt_result2 = $this->common_model->get_data('invoice','', '', $select,$where, '', $count = true);
        
        $where = ' LOWER(enquiry_for) = "'. strtolower(trim($product->name)).'" AND is_deleted = 0';
        $cnt_result3 = $this->common_model->get_data('order_acknowledgement','', '', $select,$where, '', $count = true);
        
        $where = ' LOWER(equipment) = "'. strtolower(trim($product->name)).'" AND is_deleted = 0';
        $cnt_result4 = $this->common_model->get_data('tender','', '', $select,$where, '', $count = true);
        
        if($cnt_result1 != 0 || $cnt_result2 != 0 || $cnt_result3 != 0 || $cnt_result4 != 0){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Cannot Delete Product!</div>');
            redirect('product-list');
        }
        
        $this->product_model->delete_product();    
    }

	public function edit_added_product(){
	    
    	if($this->input->post('update') == 'Update' && trim($this->input->post('new_product')) != ''){
    	    $select = '*';
            $where = ' LOWER(name) = "'. strtolower(trim($this->input->post('new_product'))).'" AND id != '.$this->uri->segment(1);
            $cnt_result = $this->common_model->get_data('products','', '', $select,$where, '', $count = true);
            if($cnt_result != 0){
                $this->session->set_flashdata('message','<div class="alert alert-danger">Product Already Exists!</div>');
                redirect($this->uri->segment(1).'/product-edit');
            }
            $this->product_model->update_added_product();	
    	}   
    	    
    	$data['product'] = $this->product_model->get_product(); 
    	$data['groups'] = $this->common_model->get_data('client_group','', '','*','', ' ORDER BY client_group.group_name ASC', $count = false);
    	$this->load->view('admin/edit_added_product',$data);	    
	}
	
	public function product_list(){
	    
	$data['products'] = $this->enquiry_model->products();    
	$this->load->view('admin/product_list',$data);	    
	}	
	
	
}
