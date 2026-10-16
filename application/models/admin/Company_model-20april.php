<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{
	
	public function new_company(){
		
		$company_id = uniqid();
		
		$data = array(
		'name'		 		=> $this->security->xss_clean($this->input->post('name')),
		'company_id' 		=> $company_id,
		'date'				=> date('Y-m-d')
		);
	$result = $this->db->insert('company',$data);
	if($result){
	
		$branch = array(
		'company_id'	=>$company_id,		
		'branch_id'		=>uniqid(),
		'country'		=>$this->security->xss_clean($this->input->post('country')),
		'state'			=>$this->security->xss_clean($this->input->post('state')),
		'city'			=>$this->security->xss_clean($this->input->post('city')),
		'address'		=>$this->security->xss_clean($this->input->post('address')),
		'contact_person'=>$this->security->xss_clean($this->input->post('contact_person')),
		'contact_number'=>$this->security->xss_clean($this->input->post('contact_number')),
		'email'			=>$this->security->xss_clean($this->input->post('email')),
		'group_name'    =>implode(",",$this->security->xss_clean($this->input->post('groups'))),
		'date'			=>date('Y-m-d')
		);
	$result2 = $this->db->insert('branch',$branch);
	if($result2){
	return true;	
	}else{
	return false;	
	}
	}else{
		return false;
	}
		
	}

	public function update_company(){
	
		$data = array(
		'name'		 		=> $this->security->xss_clean($this->input->post('name'))
		);
	$this->db->where('company_id',$this->security->xss_clean($this->input->post('company_id')));
	$result = $this->db->update('company',$data);
	$result = $this->db->affected_rows();
	
		$branch = array(
		'country'		=>$this->security->xss_clean($this->input->post('country')),
		'state'			=>$this->security->xss_clean($this->input->post('state')),
		'city'			=>$this->security->xss_clean($this->input->post('city')),
		'address'		=>$this->security->xss_clean($this->input->post('address')),
		'contact_person'=>$this->security->xss_clean($this->input->post('contact_person')),
		'contact_number'=>$this->security->xss_clean($this->input->post('contact_number')),
		'email'			=>$this->security->xss_clean($this->input->post('email'))
		);
		
	$this->db->where('company_id',$this->security->xss_clean($this->input->post('company_id')));	
	$this->db->where('branch_id',$this->security->xss_clean($this->input->post('branch')));	
	$result2 = $this->db->update('branch',$branch);
	$result2 = $this->db->affected_rows();
	
	if($result2 || $result){
	return true;	
	}else{
	return false;	
	}
		
	}	
	
	public function new_branch(){
		
		$branch = array(
		'company_id'	=>$this->security->xss_clean($this->input->post('company_id')),		
		'branch_id'		=>uniqid(),
		'country'		=>$this->security->xss_clean($this->input->post('country')),
		'state'			=>$this->security->xss_clean($this->input->post('state')),
		'city'			=>$this->security->xss_clean($this->input->post('city')),
		'address'		=>$this->security->xss_clean($this->input->post('address')),
		'contact_person'=>$this->security->xss_clean($this->input->post('contact_person')),
		'contact_number'=>$this->security->xss_clean($this->input->post('contact_number')),
		'email'			=>$this->security->xss_clean($this->input->post('email')),
		'date'			=>date('Y-m-d')
		);
	$result2 = $this->db->insert('branch',$branch);
	if($result2){
	return true;	
	}else{
	return false;	
	} 	
		
	}
	
	public function company_name(){
		
	$this->db->order_by('name','ASC');	
	$result = $this->db->get('company');
	$result = $result->result();
	return $result;		
		
	}
	
	public function all_company(){
	$this->db->join('branch','branch.company_id = company.company_id');
	$this->db->where('branch.is_deleted !=',1);
	$this->db->order_by('company.id','DESC');	
	$result = $this->db->get('company');
	$result = $result->result();
	return $result;	
	
	}
	
	public function all_countries(){
		
	$this->db->order_by('name','ASC');	
	$result = $this->db->get('countries');
	$result = $result->result();
	return $result;	
	//print_r($result);exit;	
	}

	public function get_country_ajax($postData){
	
    $response = array();
  
    $this->db->select('*');

    if(!empty($postData['search'])){
 
      // Select record
      $this->db->where("name like '%".$postData['search']."%' ");
      $this->db->limit(10);
      $records = $this->db->get('countries')->result();

      foreach($records as $row ){
        $response[] = array("country_id"=>$row->id,"label"=>$row->name);
      }
 
    }
    return $response;
	
	}
	
	public function get_state_ajax($postData){ 
    $response = array();
  
    $this->db->select('*');

    if(!empty($postData['search'])){
 
      // Select record
      $this->db->where("name like '%".$postData['search']."%' ");
	  if(!empty($postData['country_id'])){
	  $this->db->where('country_id',$postData['country_id']);
	  }
      $this->db->limit(10);
      $records = $this->db->get('states')->result();

      foreach($records as $row ){
        $response[] = array("state_id"=>$row->id,"label"=>$row->name);
      }
 
    }
    return $response;
	}	
	
	public function get_city_ajax($postData){ 
    $response = array();
  
    $this->db->select('*');

    if(!empty($postData['search'])){
 
      // Select record
      $this->db->where("name like '%".$postData['search']."%' ");
	  if(!empty($postData['state_id'])){
	  $this->db->where('state_id',$postData['state_id']);
	  }	  
      $this->db->limit(10);
      $records = $this->db->get('cities')->result();

      foreach($records as $row ){
        $response[] = array("label"=>$row->name);
      }
 
    }
    return $response;
	}	
	
	public function get_branch_ajax(){ 

		$this->db->where('company_id',$this->security->xss_clean($this->input->post('company')));
		$this->db->where('is_deleted !=',1);
		$this->db->order_by('id','DESC');
		$result = $this->db->get('branch');
		$result = $result->result();
		echo json_encode($result);
	}	
	
	public function branch_detail_ajax(){

		$this->db->where('branch_id',$this->security->xss_clean($this->input->post('branch_id')));
		$this->db->where('is_deleted !=',1);
		$result = $this->db->get('branch');
		$result = $result->row();
		echo json_encode($result);
		
	}
	
	public function company_name_suggesstion($postData){
	
    $response = array();
  
    $this->db->select('*');

    if(!empty($postData['search'])){
 
      // Select record
      $this->db->where("name like '%".$postData['search']."%' ");
      $this->db->limit(10);
      $records = $this->db->get('company')->result();

      foreach($records as $row ){
        $response[] = array("company_id"=>$row->company_id,"label"=>$row->name);
      }
 
    }
    return $response;	
	}
	
	public function enquiry_suggesstion($postData){
	
    $response = array();
  
    $this->db->select('*');

    if(!empty($postData['search'])){
 
      // Select record
      $this->db->where("enquiry_for like '%".$postData['search']."%' ");
    //  $this->db->group_by('enquiry_for');
      $this->db->limit(10);
      $records = $this->db->get('enquiry')->result();

      foreach($records as $row ){
        $response[] = array("label"=>$row->enquiry_for);
      }
 
    }
    return $response;	
	}
	
    public function delete_client(){
    
    $this->db->set('is_deleted',1);    
    $this->db->where('branch_id',$this->uri->segment(1));    
    $this->db->update('branch');  
    if($this->db->affected_rows() > 0){
    return true;    
    }else{
    return false;    
    }
    }


	
}
?>