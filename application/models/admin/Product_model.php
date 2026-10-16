<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{	
	
    public function other_product(){
    
    $this->db->select('company.name as client,branch.city,branch.email,branch.contact_number,enquiry.*');
	$this->db->join('company','company.company_id = enquiry.company');
	$this->db->join('branch','branch.branch_id = enquiry.branch'); 
    $this->db->where('enquiry_for','Other');
    $this->db->or_where('status','automated-enquiry');
    $result = $this->db->get('enquiry');    
    return $result->result();    
        
    }
	
	public function edit_product(){
	    
	$this->db->where('id',$this->uri->segment(1));    
	$result = $this->db->get('enquiry');
	return $result->row();
	
	}
	public function product_name_suggesstion($postData){
	    //print_r($postData);exit;
	    //echo "hello";exit;

	

    $response = array();

  

    $this->db->select('*');



    if(!empty($postData['search'])){
        

 

      // Select record

      $this->db->where("name like '%".trim($postData['search'])."%' ");

      $this->db->limit(10);

      $records = $this->db->get('products')->result();
    // print_r($records);exit;



      foreach($records as $row ){

        $response[] = array("id"=>$row->id,"label"=>trim($row->name));

      }

 

    }

    return $response;	

	}

	
	
	public function update_product(){
	
	if( !empty($this->input->post('old_product')) ){
	$product = $this->input->post('old_product');    
	}
	elseif(!empty($this->input->post('new_product'))){
	$product = $this->input->post('new_product');        
	}
	
	if(!empty($product)){    
	$this->db->set('enquiry_for',$product);
	}
	if(!empty($this->input->post('added_by'))){    
	$this->db->set('added_by',$this->input->post('added_by'));
	}	
	if( !empty($this->input->post('client')) ){
    $this->db->set('company',$this->input->post('client'));
	$this->db->set('branch',$this->input->post('branch'));
	}
	if(!empty($product) || !empty($this->input->post('client'))){
	$this->db->set('status','Under Process');
	}else{
	$this->session->set_flashdata('message','Fill Atleast One Field!');
	redirect($_SERVER['HTTP_REFERER']);		    
	}
	$this->db->set('enquiry_type',$this->input->post('enquiry_type'));
	$this->db->where('id',$this->uri->segment(1));
	$this->db->update('enquiry');
	
    if(!empty($this->input->post('new_product'))){
        
    $new_product = array(
    'name' => $this->input->post('new_product')
    );   
    $this->db->insert('products',$new_product);
    }
    
	if($this->db->affected_rows() > 0){
	$this->session->set_flashdata('message','Updated Successfully!');
	redirect('indiamart-followup');		    
	}else{
	$this->session->set_flashdata('message','Error!Try Again');
	redirect($_SERVER['HTTP_REFERER']);	    
	}
	    
	}
	
	public function add_product(){
	    
    	$data = array(
    	        'name' => trim($this->input->post('new_product')),
                //'client_group_id' => $this->input->post('group_id'),
                'created' => date('Y-m-d H:i:s'),   
    	);    
    	$result = $this->db->insert('products',$data);  
    	if($result){
    		$this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');
    		redirect($_SERVER['HTTP_REFERER']);	    
    	}else{
    		$this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
    		redirect($_SERVER['HTTP_REFERER']);	    
    	}
	
	}
	
    public function get_product(){
    
    $this->db->where('id',$this->uri->segment(1));
    $result = $this->db->get('products');
    return $result->row();
    }	
	
	public function update_added_product(){
	    
	$data = array(
	'name' => trim($this->input->post('new_product')),
        'client_group_id' => $this->input->post('group_id'),   
	);    
	$this->db->where('id',$this->uri->segment(1));
	$result = $this->db->update('products',$data);  
	if($result){
		$this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
		redirect($_SERVER['HTTP_REFERER']);	    
	}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
		redirect($_SERVER['HTTP_REFERER']);	    
	}
	
	}
	
	public function delete_product(){
	
    $this->db->where('id',$this->uri->segment(1));
	$this->db->delete('products'); 

	if($this->db->affected_rows() > 0){
	$this->session->set_flashdata('message','Deleted Successfully!');
	redirect($_SERVER['HTTP_REFERER']);	    
	}else{
	$this->session->set_flashdata('message','Error!Try Again');
	redirect($_SERVER['HTTP_REFERER']);    
	}
	    
	}
	
	public function all_client(){
	$this->db->order_by('name','ASC');    
	$result = $this->db->get('company');  
	return $result->result();
	}
	
}
?>