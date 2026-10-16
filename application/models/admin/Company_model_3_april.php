<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{
        
    public function new_company() 
    {
    $filename = '';
    if(empty($_FILES['company_logo']['name'])){
        $filename = 'no-image.png';
    }
    if (!empty($_FILES['company_logo']['name'])) {
        $this->load->library('upload');
        $config['upload_path'] = './assets/company/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['company_logo']['name']);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('company_logo')) {
            return false; // File upload failed
        }
        $file = $this->upload->data();
        $filename = $file['file_name'];
        
                // Validate image dimensions
        $image_path = $config['upload_path'] . $filename;
        list($width, $height) = getimagesize($image_path);
        if ($width >= 200 && $height >= 200) {
            // Delete the uploaded file
            unlink($image_path);
            // Return an error message or handle the error as needed
                $this->session->set_flashdata('message','<div class="alert alert-danger">Please Update Image of 200 * 200 Size.</div>');
                redirect('company');
        }
        
    }
    $company_id = uniqid();

    $data = array(
        'name' => ucwords(strtolower($this->input->post('name'))),
        'company_id' => $company_id,
        'date' => date('Y-m-d'),
        'company_logo' => $filename,
    );
    $result1 = $this->db->insert('company', $data);

    $branch = array(
        'company' => $company_id,
        'country' => ucwords(strtolower($this->input->post('country'))),
        'state' => ucwords(strtolower($this->input->post('state'))),
        'city' => ucwords(strtolower($this->input->post('city'))),
        'address' => $this->input->post('address'),
        'contact_person' => ucwords(strtolower($this->input->post('contact_person'))),
        'contact_person_isd_code' => $this->input->post('isd_codes'),
        'contact_person_number' => $this->input->post('contact_number'),
        'email' => $this->input->post('email'),
        'creation_date' => date('Y-m-d'),
        'gstin' => $this->input->post('gstin'),
        'user_id' => $this->session->userdata('id'),
        'designation' => $this->input->post('designation'),
    );

    $result2 = $this->db->insert('company_details', $branch);

    if ($result1 && $result2) {
        return true;	
    } else {
        return false;
    }
}

    public function update_company(){

	$data = array(
            'name'  => $this->security->xss_clean(ucwords(strtolower($this->input->post('name'))))
	);
	$this->db->where('company_id',$this->security->xss_clean($this->input->post('company_id')));

	$result = $this->db->update('company',$data);

	$result = $this->db->affected_rows();
            $branch = array(
		'country'		=>$this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
		'state'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
		'city'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
		'address'		=>$this->security->xss_clean($this->input->post('address')),
		'contact_person'=>$this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person')))),
		'contact_number'=>$this->security->xss_clean($this->input->post('contact_number')),
		'email'			=>$this->security->xss_clean($this->input->post('email')),
        'gstin'			=>$this->security->xss_clean($this->input->post('gstin')),
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

		'date'			=>date('Y-m-d'),
        'gstin'			=>$this->security->xss_clean($this->input->post('gstin')),

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
	$this->db->join('company_details','company_details.company = company.company_id');
	$this->db->where('company.is_deleted !=',1);
        $this->db->where('company_details.status = ','active');
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

	public function get_country_ajax_new($postData){
        $response = array();
        $this->db->select('*');
        if(!empty($postData['search'])){
            // Select record
            $this->db->where_in("id",[15, 20, 81, 112]);
            //$this->db->limit(10);
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
		$this->db->where('company',$this->security->xss_clean($this->input->post('company_id')));

		$this->db->order_by('contact_person','DESC');

		$result = $this->db->get('company_details');

		$result = $result->result();

		echo json_encode($result);

	}	

	public function branch_detail_ajax(){

            $this->db->where('company_id',$this->security->xss_clean($this->input->post('agent_id')));
            $result = $this->db->get('company_details');
            $result = $result->row();
            echo json_encode($result);
	}
        
	public function company_name_suggesstion($postData){

	

    $response = array();

  

    $this->db->select('*');



    if(!empty($postData['search'])){

 

      // Select record

      $this->db->where("name like '%".trim($postData['search'])."%' ");
      $this->db->where('is_deleted !=', '1');
      $this->db->limit(10);

      $records = $this->db->get('company')->result();



      foreach($records as $row ){

        $response[] = array("company_id"=>$row->company_id,"label"=>trim($row->name));

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

    $this->db->set('status','deleted');   
    $this->db->where('company_id',$this->uri->segment(1));    
    $this->db->update('company_details');  
    if($this->db->affected_rows() > 0){
        return true;    
    }else{
        return false;
    }
}


//abhi

    public function count_all_company(){
        $this->db->join('company', 'company.company_id = company_details.company');  
        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        
        if ($this->input->get('company_id') <> '') {
            $this->db->select('company.name, company.company_logo, company_details.*, COUNT(company_details.company) as totalRows');
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }else{
            $this->db->select('company.name, company.company_logo,company_details.*');
        }
        

        $this->db->group_by('company_details.company');
        $this->db->order_by('company_details.company_id', 'DESC'); 

        return $this->db->get('company_details')->num_rows();
    }


    public function all_company_enquiry($limit = '', $offset = '') {

        $this->db->join('company', 'company.company_id = company_details.company');  
        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        
        if ($this->input->get('company_id') <> '') {
            $this->db->select('company.name, company.company_logo, company_details.*, COUNT(company_details.company) as totalRows');
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }else{
            $this->db->select('company.name, company.company_logo,company_details.*');
        }
        

        $this->db->group_by('company_details.company');
        $this->db->limit($limit, $offset);  
        $this->db->order_by('company_details.company_id', 'DESC'); // Order by company_id in descending order

        $query = $this->db->get('company_details');
    
        // Check if there are any results
        if ($query->num_rows() > 0) {
            return $query->result(); // Return the results
        } else {
            return false; // Return false if no results found
        }
    }

    public function company_details_data() {

        $this->db->where('company_details.status', 'active');
        $this->db->select('company_details.*');
        $this->db->where('company_details.company', $this->input->get('company_id'));
        $this->db->order_by('company_details.company_id', 'DESC'); 

        $query = $this->db->get('company_details');
    
        // Check if there are any results
        if ($query->num_rows() > 0) {
            return $query->result(); // Return the results
        } else {
            return false; // Return false if no results found
        }
    } 
    
}

?>