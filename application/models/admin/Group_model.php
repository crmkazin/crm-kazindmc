<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model{	

	public function add_group(){
	    
	$data = array(
	'group_name' => $this->input->post('group')   
	);    
	$result = $this->db->insert('client_group',$data);  
	if($result){
		$this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');
		redirect($_SERVER['HTTP_REFERER']);	    
	}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
		redirect($_SERVER['HTTP_REFERER']);	    
	}
	
	}
	
	public function all_groups(){
            $this->db->select('*');
	$this->db->order_by('group_name','ASC');    
	$result = $this->db->get('client_group');  
	return $result->result();
	}	
	
	public function delete_group(){
	
    $this->db->where('id',$this->uri->segment(1));
	$this->db->delete('client_group'); 

	if($this->db->affected_rows() > 0){
	$this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');
	redirect($_SERVER['HTTP_REFERER']);	    
	}else{
	$this->session->set_flashdata('message','<div class="alert alert-danger">Error!Try Again</div>');
	redirect($_SERVER['HTTP_REFERER']);    
	}
	    
	}	
	
    public function get_group(){
    
    $this->db->where('id',$this->uri->segment(1));
    $result = $this->db->get('client_group');
    return $result->row();
    }
	
	public function update_group(){
	    
	$data = array(
	'group_name' => $this->input->post('group')   
	);    
	$this->db->where('id',$this->uri->segment(1));
	$result = $this->db->update('client_group',$data);  
	if($result){
		$this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
		redirect('group-list');	    
	}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
		redirect('group-list');	    
	}
	
	}
	
	
}
?>