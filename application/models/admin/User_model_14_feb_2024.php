<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{	

    public function add_user(){	
        
        $data = array(
            'name'      =>$this->input->post('name'),
            'email'     =>$this->input->post('email'),
            'password'  =>$this->input->post('password'),
            'status'    =>$this->input->post('status'),
            'type'      =>$this->input->post('type'),
            'contact_number'    =>$this->input->post('mobile'),
            'location'      =>$this->input->post('location'),
            'country'      =>$this->input->post('country'),
            'state'      =>$this->input->post('state'),
            'city'      =>$this->input->post('city'),
            'isd_code'      =>$this->input->post('isd_codes'),
	);
	$this->db->insert('admin',$data);  
        $id = $this->db->insert_id();
	 
	if($id){
            $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');
            redirect('all-user');	    
	}else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);	    
	}
    }
	
    public function all_user(){
        $this->db->where('status!=','0'); 
	$this->db->order_by('name','ASC');    
	$result = $this->db->get('admin');  
	return $result->result();
    }	
	
    public function edit_product(){	    
	$this->db->where('id',$this->uri->segment(1));    
	$result = $this->db->get('enquiry');
	return $result->row();
    }
	
    public function delete_user(){
        $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
        
        $this->db->select('admin.*');
	$this->db->where('admin.id',$this->uri->segment(1));
	$result = $this->db->get('admin');
        $result = $result->result();
        //echo '<pre>';print_r($this->session->userdata()); print_r($result); exit;
        //if($this->session->userdata('type')=='1')
        
	if(in_array($result[0]->email,$super_admins)){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Cannot Delete Admin Account!</div>');
            redirect($_SERVER['HTTP_REFERER']);	
        }
        $data = array(            
            'status' =>0           
	); 
	$this->db->where('id',$this->uri->segment(1));
	$this->db->update('admin',$data); 
    
	if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');
            redirect($_SERVER['HTTP_REFERER']);	    
	}else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error!Try Again</div>');
            redirect($_SERVER['HTTP_REFERER']);    
	}
	    
    }
	
    public function get_user(){
    
    // $this->db->where('id',$this->uri->segment(1));
    // $result = $this->db->get('admin');
    // return $result->row();
    
    
        $this->db->select('admin.*,user_rights.userid,user_rights.products,user_rights.products_group,user_rights.organization,user_rights.enquiry,user_rights.quotations,user_rights.tender,user_rights.bid,user_rights.oa,user_rights.report,user_rights.date,user_rights.invoice,user_rights.expense');	
	$this->db->join('user_rights','user_rights.userid = admin.id','LEFT');
	$this->db->where('admin.id',$this->uri->segment(1));
	$result = $this->db->get('admin');
        return $result->row();
    }	
	
	
    public function update_user(){
	    
	$data = array(
            'name'      =>$this->input->post('name'),
            'email'     =>$this->input->post('email'),
            'password'  =>$this->input->post('password'),
            'status'    =>$this->input->post('status'),
            'type'      =>$this->input->post('type'),
            'contact_number'    =>$this->input->post('mobile'),
            'location'      =>$this->input->post('location'),
            'country'      =>$this->input->post('country'),
            'state'      =>$this->input->post('state'),
            'city'      =>$this->input->post('city'),
            'isd_code'      =>$this->input->post('isd_codes'),
	); 
	$this->db->where('id',$this->uri->segment(1));
	$this->db->update('admin',$data); 
		
	if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
            redirect('all-user');	    
	}else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error! You Have Not Change Anything!</div>');
            redirect($_SERVER['HTTP_REFERER']);	    
	}	
    }
	
	
}
?>