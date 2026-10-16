<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Enquiry_model extends CI_Model{

    public function new_enquiry(){
        $agent  = explode('_',$this->security->xss_clean($this->input->post('agent')));
            
	$data = array(
                'mode'  => $this->security->xss_clean($this->input->post('mode')),
		//'reference_by' => $this->security->xss_clean($this->input->post('reference_by')),
                'company_id'    => $this->security->xss_clean($this->input->post('company_id')),
		'company_details_id'    => $agent[0],
		//'enquiry_for'       => $this->security->xss_clean($this->input->post('enquiry_for')),
                'enquiry_abbr'       => $this->security->xss_clean($this->input->post('booking_type')),
                'enquiry_sequence'       => $this->security->xss_clean($this->input->post('file_seq')),
                'number_persons'       => $this->security->xss_clean($this->input->post('number_persons')),
                'number_child'      => $this->security->xss_clean($this->input->post('number_child')),
                'check_in_date'       => $this->security->xss_clean($this->input->post('check_in')),
                'check_out_date'       => $this->security->xss_clean($this->input->post('check_out')),
                'query_received_date'       => $this->security->xss_clean($this->input->post('query_received_on')),
                'number_of_nights' =>  $this->security->xss_clean($this->input->post('number_of_nights')),
		'enquiry_type'      => $this->security->xss_clean($this->input->post('enquiry_type')),
		//'status'            => $this->security->xss_clean($this->input->post('status')),
		'remarks'           => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),		
		'added_by'          => $this->security->xss_clean($this->session->userdata('id')),
		'enquiry_no'        => $this->security->xss_clean($this->input->post('enquiry_no')),		
		'date'              => date('Y-m-d'),
                'file_handle_by'    => $this->security->xss_clean($this->input->post('file_handle_by')),
                'sales_admin_id'    => $this->security->xss_clean($this->input->post('sales')),
            );

            $result = $this->db->insert('enquiry',$data);
            $enquiry_id = $this->db->insert_id();        
        
        if($result){
            return true;
	}else{
            return false;
	}
    }
    
//     public function count_all_enquiry($locations){
//         $this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status');
// 	$this->db->join('company_details','company_details.company_id = enquiry.company_details_id','LEFT');
//         $this->db->join('company','company.company_id = enquiry.company_id','LEFT');
//         //$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
//         $this->db->where('enquiry.is_deleted','0');
        
//         if(!empty( $this->input->get('booking_type') )){     
//             $booking_type = urldecode($this->input->get('booking_type'));
//             if($booking_type == 'all' && $this->input->get('location')<>'all'){
//                 $this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
//             }else if($booking_type != 'all'){
//                 $this->db->where('enquiry.enquiry_abbr',$booking_type);	
//             }
//         }
//         if(!empty( $this->input->get('followup_status') )){     
//             $followup_status = urldecode($this->input->get('followup_status'));
//             $this->db->where('enquiry.status',$followup_status);	
//         }
//         if(!empty( $this->input->get('from'))){
//             $from_date = urldecode($this->input->get('from')) ;
//             $this->db->where('enquiry.query_received_date >=',$from_date);
// 	}
// 	if(!empty( $this->input->get('to') )){     
//             $to_date = urldecode($this->input->get('to'));
//             $this->db->where('enquiry.query_received_date <=',$to_date);	
//         }
//         if(!empty( $this->input->get('query_number') )){     
//             $query_number = urldecode($this->input->get('query_number'));
//             $this->db->where('enquiry.enquiry_no',$query_number);	
//         }
//         if(!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all'){     
//             $staff_id = urldecode($this->input->get('staff_id'));
//             $this->db->where('enquiry.file_handle_by',$staff_id);	
//         }
//         if($this->session->userdata('type') != '1'){
//             //$this->db->where('enquiry.file_handle_by',$this->session->userdata('id'));	
//         }
//         if($this->session->userdata('admin_type') != 'superadmin'){
//             $assigned_loc = $locations[$this->session->userdata('locations')];           
//             $this->db->where_in('enquiry.enquiry_abbr', $assigned_loc);
//         }
// 	//$this->db->order_by('enquiry.id','DESC');
//         //$this->db->group_by('enquiry.id');
//         return $this->db->get('enquiry')->num_rows();
//     }
    
//     public function all_enquiry($limit,$offset,$locations){	

// 	$this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id');
// 	$this->db->join('company_details','company_details.company_id = enquiry.company_details_id','LEFT');
//         $this->db->join('company','company.company_id = enquiry.company_id','LEFT');
//         //$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
//         $this->db->join('admin','admin.id = enquiry.file_handle_by','LEFT');
//         $this->db->join('arrivals','arrivals.enquiry_id = enquiry.id','LEFT');
//         $this->db->where('enquiry.is_deleted','0');
        
        
//         if(!empty( $this->input->get('booking_type') )){     
//             $booking_type = urldecode($this->input->get('booking_type'));
//             if($booking_type == 'all' && $this->input->get('location')<>'all'){
//                 $this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
//             }else if($booking_type != 'all'){
//                 $this->db->where('enquiry.enquiry_abbr',$booking_type);	
//             }
//         }
//         if(!empty( $this->input->get('followup_status') )){     
//             $followup_status = urldecode($this->input->get('followup_status'));
//             $this->db->where('enquiry.status',$followup_status);	
//         }
//         if(!empty( $this->input->get('from'))){
//             $from_date = urldecode($this->input->get('from')) ;
//             $this->db->where('enquiry.query_received_date >=',$from_date);
// 	}
// 	if(!empty( $this->input->get('to') )){     
//             $to_date = urldecode($this->input->get('to'));
//             $this->db->where('enquiry.query_received_date <=',$to_date);	
//         }
//         if(!empty( $this->input->get('query_number') )){     
//             $query_number = urldecode($this->input->get('query_number'));
//             $this->db->where('enquiry.enquiry_no',$query_number);	
//         }
//         if(!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all'){     
//             $staff_id = urldecode($this->input->get('staff_id'));
//             $this->db->where('enquiry.file_handle_by',$staff_id);	
//         }
//         if($this->session->userdata('type') != '1'){
//             //$this->db->where('enquiry.file_handle_by',$this->session->userdata('id'));	
//         }
//         if($this->session->userdata('admin_type') != 'superadmin'){
//             $assigned_loc = $locations[$this->session->userdata('locations')];
//             $this->db->where_in('enquiry.enquiry_abbr', $assigned_loc);
//         }
        
// 	$this->db->order_by('enquiry.id','DESC');
//         //$this->db->group_by('enquiry.id');
//         $this->db->limit($limit, $offset);
// 	$result = $this->db->get('enquiry');
        
//         //echo $this->db->last_query();exit;
// 	return $result->result();
//     }

   //18 May
   
   	public function count_all_enquiry($locations)
	{
		$this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id');
		$this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
		$this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
		//$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
		$this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
		$this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
		$this->db->where('enquiry.is_deleted', '0');

		if ($this->input->get('company_id') <> '') {
			$company_id = urldecode($this->input->get('company_id'));
			$this->db->where('company_details.company', $company_id);
		}

		if (!empty($this->input->get('booking_type'))) {
			$booking_type = urldecode($this->input->get('booking_type'));
			if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
				$this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
			} else if ($booking_type != 'all') {
				$this->db->where('enquiry.enquiry_abbr', $booking_type);
			}
		}
		if (!empty($this->input->get('followup_status'))) {
			$followup_status = urldecode($this->input->get('followup_status'));
			$this->db->where('enquiry.status', $followup_status);
		}
		if (!empty($this->input->get('from'))) {
			$from_date = urldecode($this->input->get('from'));
			$this->db->where('enquiry.query_received_date >=', $from_date);
		}
		if (!empty($this->input->get('to'))) {
			$to_date = urldecode($this->input->get('to'));
			$this->db->where('enquiry.query_received_date <=', $to_date);
		}
		if (!empty($this->input->get('query_number'))) {
			$query_number = urldecode($this->input->get('query_number'));
			$this->db->where('enquiry.enquiry_no', $query_number);
		}
		if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
			$staff_id = urldecode($this->input->get('staff_id'));
			$this->db->where('enquiry.file_handle_by', $staff_id);
		}
		if ($this->session->userdata('type') != '1') {
			//$this->db->where('enquiry.file_handle_by',$this->session->userdata('id'));	
		}
		if ($this->session->userdata('admin_type') != 'superadmin') {
			$assigned_loc = $locations[$this->session->userdata('locations')];
			$this->db->where_in('enquiry.enquiry_abbr', $assigned_loc);
		}

		$this->db->order_by('enquiry.id', 'DESC');
		//$this->db->group_by('enquiry.id');
		return $this->db->get('enquiry')->num_rows();
	}

	public function all_enquiry($limit, $offset, $locations)
	{

		$this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id');
		$this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
		$this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
		//$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
		$this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
		$this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
		$this->db->where('enquiry.is_deleted', '0');

		if ($this->input->get('company_id') <> '') {
			$company_id = urldecode($this->input->get('company_id'));
			$this->db->where('company_details.company', $company_id);
		}

		if (!empty($this->input->get('booking_type'))) {
			$booking_type = urldecode($this->input->get('booking_type'));
			if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
				$this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
			} else if ($booking_type != 'all') {
				$this->db->where('enquiry.enquiry_abbr', $booking_type);
			}
		}
		if (!empty($this->input->get('followup_status'))) {
			$followup_status = urldecode($this->input->get('followup_status'));
			$this->db->where('enquiry.status', $followup_status);
		}
		if (!empty($this->input->get('from'))) {
			$from_date = urldecode($this->input->get('from'));
			$this->db->where('enquiry.query_received_date >=', $from_date);
		}
		if (!empty($this->input->get('to'))) {
			$to_date = urldecode($this->input->get('to'));
			$this->db->where('enquiry.query_received_date <=', $to_date);
		}
		if (!empty($this->input->get('query_number'))) {
			$query_number = urldecode($this->input->get('query_number'));
			$this->db->where('enquiry.enquiry_no', $query_number);
		}
		if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
			$staff_id = urldecode($this->input->get('staff_id'));
			$this->db->where('enquiry.file_handle_by', $staff_id);
		}
		if ($this->session->userdata('type') != '1') {
			//$this->db->where('enquiry.file_handle_by',$this->session->userdata('id'));	
		}
		if ($this->session->userdata('admin_type') != 'superadmin') {
			$assigned_loc = $locations[$this->session->userdata('locations')];
			$this->db->where_in('enquiry.enquiry_abbr', $assigned_loc);
		}

		$this->db->order_by('enquiry.id', 'DESC');
		//$this->db->group_by('enquiry.id');
		$this->db->limit($limit, $offset);
		$result = $this->db->get('enquiry');

		//echo $this->db->last_query();exit;
		return $result->result();
	}

    public function delete_enquiry(){
        $this->db->set('is_deleted',1);

        $this->db->where('id',$this->uri->segment(1));

        $this->db->update('enquiry');



    if($this->db->affected_rows() > 0){

    $this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');	

    redirect($_SERVER['HTTP_REFERER']);		    

    }else{

    $this->session->set_flashdata('message','<div class="alert alert-danger">Error!Try Again</div>');	

    redirect($_SERVER['HTTP_REFERER']);	    

    }



    }

	public function get_indiamart_enquiry(){

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');	

	$this->db->join('company','company.company_id = enquiry.company','LEFT');

	$this->db->join('branch','branch.branch_id = enquiry.branch','LEFT');

	$this->db->where('enquiry.status !=','Quotation Send');

	$this->db->where('enquiry.status !=','Send Quotation Now');

	$this->db->where('enquiry.mode','Indiamart');	

    $this->db->where('enquiry.status !=','Not Useful');

    $this->db->where('enquiry.is_deleted !=',1);

	if($this->session->userdata('type') == 3){

	$this->db->where('enquiry.added_by',$this->session->userdata('id'));    

	}    

	$this->db->order_by('enquiry.id','DESC');

	$result = $this->db->get('enquiry');

	return $result->result();

	

	}	

	public function indiamart_enquiry($enq){

		

	if(!empty($enq)){

	foreach($enq as $enquiries){

	

	$this->db->select('indiamart_query_id');

	$this->db->where('indiamart_query_id',$enquiries['QUERY_ID']);

	$check = $this->db->get('enquiry');

	$check = $check->row();

	

	if(empty($check)){

	

	$company_name = $enquiries['GLUSR_USR_COMPANYNAME'];

	if($company_name == null){

	$company_name = $enquiries['QUERY_ID'];	

	}

	

	$country_code = $enquiries['COUNTRY_ISO'];

	$country = "Not Found";

	if($country_code != null){

	$this->db->select('name');	

	$this->db->where('sortname',$country_code);	

	$country_data = $this->db->get('countries');

	$country_data = $country_data->row();

	if(!empty($country_data)){

	$country = $country_data->name;	

	}else{

	$country = "Not Found";	

	}

	

	}

	

	$state = $enquiries['ENQ_STATE'];

	if($state == null){

	$state = "No State Found";	

	}	



	$city = $enquiries['ENQ_CITY'];

	if($city == null){

	$city = "No City Found";	

	}



	$address = $enquiries['ENQ_ADDRESS'];

	if($address == null){

	$address = "No Address Found";	

	}



	$person = $enquiries['SENDERNAME'];

	if($person == null){

	$person = "Name Not Found";	

	}



	$mobile = $enquiries['MOB'];

	if($mobile == null){

	$mobile = "Number Not Found";	

	}



	$email = $enquiries['SENDEREMAIL'];

	if($email == null){

	$email = "Email Not Found";	

	}	

	

	$this->db->where('name',$company_name);

	$company = $this->db->get('company');

	$company = $company->row();

	$company_id = "";

	$branch_id = uniqid();

	

	if(empty($company)){

		

	$company_id = uniqid();

	

	$company_data = array(

	'company_id' =>$company_id,

	'name'		 =>$company_name,

	'date'		 =>date("Y-m-d",strtotime($enquiries['DATE_R']))

	);

	$this->db->insert('company',$company_data);

	

	$branch_data = array(

	'company_id'		=>$company_id,

	'branch_id'			=>$branch_id,

	'country'			=>$country,

	'state'				=>$state,

	'city'				=>$city,

	'address'			=>$address,

	'contact_person'	=>$person,	

	'contact_number'	=>$mobile,

	'email'				=>$email,

	'date'				=>date("Y-m-d",strtotime($enquiries['DATE_R']))

	);

	$new_branch = $this->db->insert('branch',$branch_data);

	

	}else{

	$company_id = $company->company_id;



	$this->db->select('branch_id');

	$this->db->where('city',$city);

	$this->db->where('company_id',$company_id);

	$branch = $this->db->get('branch');

	$branch = $branch->row();

	

	if(!empty($branch)){

	$branch_id = $branch->branch_id;	

	}else{

		

	$branch_data = array(

	'company_id'		=>$company_id,

	'branch_id'			=>$branch_id,

	'country'			=>$country,

	'state'				=>$state,

	'city'				=>$city,

	'address'			=>$address,

	'contact_person'	=>$person,	

	'contact_number'	=>$mobile,

	'email'				=>$email,

	'date'				=>date("Y-m-d",strtotime($enquiries['DATE_R']))

	);

	$new_branch = $this->db->insert('branch',$branch_data);		

		

	}

	

	}

	

	

	

	$remarks = $enquiries['ENQ_MESSAGE'];

	if($remarks == null){

	$remarks = "No Remarks Found";	

	}

	

	$product = $enquiries['PRODUCT_NAME'];

	if($product == null){

	$product = "No Product Found";	

	}

	

	

	$data = array(

	'indiamart_query_id' =>$enquiries['QUERY_ID'],

	'mode'		   =>'Indiamart',

	'company'	   =>$company_id,

	'branch'	   =>$branch_id,

	'enquiry_for'  =>$product,	

	'enquiry_type' =>'Indiamart',

	'status'	   =>'automated-enquiry',

	'remarks'	   =>$remarks,	

	'date'		   =>date("Y-m-d",strtotime($enquiries['DATE_R']))

	);

	

	$result = $this->db->insert('enquiry',$data);	

	

	}

	

	}		

	}

	}	

	public function products(){
            $this->db->order_by('name','ASC');
            $result = $this->db->get('products');
            return $result->result();   
	}

	public function get_multiple_enquiry($id){	    

	$this->db->where('enquiry_id',$id); 

	$result = $this->db->get('multiple_enquiry');

	return $result->result();

	

	}

	public function get_user($id){

	    

	$this->db->where('id',$id);    

	$result = $this->db->get('admin');

	

	if(!empty($result->row())){

	return $result->row();    

	}else{

	$this->session->set_flashdata('message','Error!');	

	redirect($_SERVER['HTTP_REFERER']);	    

	}    

	}

    public function get_enquiry(){
	$this->db->select('company.name,company.company_id,enquiry.*');
	$this->db->join('company','company.company_id = enquiry.company_id','LEFT');
	$this->db->join('company_details','company_details.company_id = enquiry.company_details_id','LEFT');
	$this->db->where('enquiry.id',$this->uri->segment(1));
	$result = $this->db->get('enquiry');
	if(!empty($result->row())){
            return $result->row();    
	}else{
            //$this->session->set_flashdata('message','Error!');	
            //redirect($_SERVER['HTTP_REFERER']);	    
	}
    }

    public function update_enquiry(){
	$agent  = explode('_',$this->security->xss_clean($this->input->post('agent')));
            
	$data = array(
                'mode'  => $this->security->xss_clean($this->input->post('mode')),
		//'reference_by' => $this->security->xss_clean($this->input->post('reference_by')),
                'company_id'    => $this->security->xss_clean($this->input->post('company_id')),
		'company_details_id'    => $agent[0],
		//'enquiry_for'       => $this->security->xss_clean($this->input->post('enquiry_for')),                
                'number_persons'       => $this->security->xss_clean($this->input->post('number_persons')),
                'number_child'      => $this->security->xss_clean($this->input->post('number_child')),
                'check_in_date'       => $this->security->xss_clean($this->input->post('check_in')),
                'check_out_date'       => $this->security->xss_clean($this->input->post('check_out')),
                'query_received_date'       => $this->security->xss_clean($this->input->post('query_received_on')),
                'number_of_nights' =>  $this->security->xss_clean($this->input->post('number_of_nights')),
		'enquiry_type'      => $this->security->xss_clean($this->input->post('enquiry_type')),
		//'status'            => $this->security->xss_clean($this->input->post('status')),
		'remarks'           => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),		
		'added_by'          => $this->security->xss_clean($this->session->userdata('id')),
		'enquiry_no'        => $this->security->xss_clean($this->input->post('enquiry_no')),		
		'file_handle_by'    => $this->security->xss_clean($this->input->post('file_handle_by')),
                'sales_admin_id'    => $this->security->xss_clean($this->input->post('sales')),
            );
        if($this->input->post('booking_type')<>'' && $this->input->post('file_seq') <> ''){
            $data = $data + ['enquiry_abbr'       => $this->security->xss_clean($this->input->post('booking_type')),
                'enquiry_sequence'       => $this->security->xss_clean($this->input->post('file_seq'))];
        }
        $this->db->where('id',$this->uri->segment(1));
	$result = $this->db->update('enquiry',$data);
	if($result > 0){
            return true;
	}else{
            return false;
	}
    }	

	

	

	

	

	

	

	

	

	

	

	

	

	

}

?>