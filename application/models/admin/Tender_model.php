<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tender_model extends CI_Model{
	public function new_tender(){ 
	$company_id = $this->security->xss_clean($this->input->post('company_id'));

	$branch  = $this->security->xss_clean($this->input->post('branch'));

	if(empty($company_id)){

	$company_id = uniqid();

	$company_data = array(

	'company_id' =>$company_id,

	'name'		 =>$this->security->xss_clean($this->input->post('company')),

	'date'		 =>date('Y-m-d')		

	);

	$new_company = $this->db->insert('company',$company_data);
	}

	

	if($branch == 'add_branch'){

		

	$branch = uniqid();	

	$branch_data = array(

	'company_id'		=>$company_id,

	'branch_id'			=>$branch,

	'country'			=>$this->security->xss_clean($this->input->post('country')),

	'state'				=>$this->security->xss_clean($this->input->post('state')),

	'city'				=>$this->security->xss_clean($this->input->post('city')),

	'address'			=>$this->security->xss_clean($this->input->post('address')),

	'contact_person'	=>$this->security->xss_clean($this->input->post('contact_person')),	

	'contact_number'	=>$this->security->xss_clean($this->input->post('contact_number')),

	'email'				=>$this->security->xss_clean($this->input->post('email')),

	'date'				=>date('Y-m-d'),	

	'gstin'	=>$this->security->xss_clean($this->input->post('gstin'))

	);

	$new_branch = $this->db->insert('branch',$branch_data);		

		

	}

	

	if(!empty($this->security->xss_clean($this->input->post('secondary_contact_person')))){

	 

	$contact_person = $this->input->post('secondary_contact_person');

	$email = $this->input->post('secondary_email_address');

	$contact_number = $this->input->post('secondary_contact_number');

	    

	$loop_end = count($this->input->post('secondary_contact_person'));

	$secondary_contact_detail = array();

	

	for($i=0;$i<$loop_end;$i++){

	    

	$secondary_contact_detail[] = array(

	'company'   =>$company_id,

	'branch'    =>$branch,

	'name'      =>$contact_person[$i],

	'email'     =>$email[$i],

	'mobile'	=>$contact_number[$i]  

	);    



	}

	$check = $this->db->insert_batch('secondary_contact_detail',$secondary_contact_detail);



	}

	

	if($this->input->post('status') == 'Not Participate'){

	$approval = 1;    

	}else{

	$approval =  0;   

	}

	$work_equipment = "";
    if(strtolower($this->input->post('tender_for'))=='sales'){
        $work_equipment = $this->security->xss_clean($this->input->post('equipment'));    
    }else{
        $work_equipment = $this->security->xss_clean($this->input->post('work_name'));    
    }
	
	/*$work_equipment = "";
	if(!empty($this->security->xss_clean($this->input->post('equipment')))){
	    $work_equipment = $this->security->xss_clean($this->input->post('equipment'));    
	}else{
	    $work_equipment = $this->security->xss_clean($this->input->post('work_name'));    
	}*/

		$data = array(

		'company_id'		=>$company_id,

		'branch_id'		 	=>$branch,

		'tender_for'		=>$this->security->xss_clean($this->input->post('tender_for')),

		'equipment'		    =>$work_equipment,

		'e_tender_id'		=>$this->security->xss_clean($this->input->post('e_tender_id')),

		'pre_bid_date'		=>$this->security->xss_clean($this->input->post('pre_bid_date')),

		'last_date'			=>$this->security->xss_clean($this->input->post('last_date')),

		'ammendment'        =>$this->security->xss_clean($this->input->post('ammendment')),

		'emd_amount'		=>$this->security->xss_clean($this->input->post('emd_amount')),

		'est_cost'          =>$this->security->xss_clean($this->input->post('est_cost')),

		'eligibility'		=>$this->security->xss_clean($this->input->post('eligibility')),

		'specifications'	=>$this->security->xss_clean($this->input->post('specifications')),
		'tender_source'		=>$this->security->xss_clean($this->input->post('tender_source')),
		'status'		 	=>$this->security->xss_clean($this->input->post('status')),

		'remarks' => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),

		'added_by'          =>$this->session->userdata('id'),

		'only_for_main_admin' =>$approval,

		'date'				=>date('Y-m-d h:i:s'),
		'tender_fee_amt'=>$this->security->xss_clean($this->input->post('tender_fee_amt')),
		'processing_fee_amt'=>$this->security->xss_clean($this->input->post('processing_fee_amt')),
        'financial_year'=>$this->security->xss_clean($this->input->post('financial_year'))
		);

	$result = $this->db->insert('tender',$data);

	$inserted_id = $this->db->insert_id();

	

	if($this->security->xss_clean($this->input->post('status')) == 'Participate'){
            $bid_data = array('tender_id' => $inserted_id,
                        'bid_number' =>$this->security->xss_clean($this->input->post('bid_no')),
                        'financial_year_bid_number' =>$this->security->xss_clean($this->input->post('financial_year_bid_number')),
                        'status' => 'Incomplete',
                        'financial_year'=>$this->security->xss_clean($this->input->post('financial_year')),
                        'date'   =>date('Y-m-d')
            );
            $bid_insert = $this->db->insert('bid',$bid_data);
            $d['bid_number'] = $this->input->post('bid_no');
            $d['emd_amount'] = $this->input->post('emd_amount');
            $mail_body = $this->load->view('admin/email_templates/bid_email',$d,TRUE);
            $this->load->library('email');
            $config = array('charset'=>'utf-8','wordwrap'=> TRUE,'mailtype' => 'html');
            $this->email->initialize($config);
            $this->email->from('solutions@intellitest.co.in', 'Intellitest Solutions India');
            $this->email->to('accounts@intellitest.co.in');
            $this->email->bcc('sumeet@thavertech.com');
            $this->email->subject('Bid Details');
            $this->email->message($mail_body);	
            $this->email->send();
	}

	

	if($result){

	return true;

	}else{

		return false;

	}

		

	}	

	

	public function all_tender(){	

	$this->db->select('company.name,branch.city,tender.*');	

	$this->db->join('company','company.company_id = tender.company_id','LEFT');

	$this->db->join('branch','branch.branch_id = tender.branch_id','LEFT');

	$this->db->where('tender.is_deleted',0);
    
    if($this->uri->segment(2) != '' && $this->uri->segment(2) == 'updated'){
        $this->db->where('tender.status != ','Decision Pending');
    }else{
        $this->db->where('tender.status','Decision Pending');
    }
    
	if($this->session->userdata('id') != 1){

	//$this->db->where('tender.only_for_main_admin',0);    

	}

	$this->db->order_by('tender.id','DESC');

	$result = $this->db->get('tender');

	return $result->result();

	

	}

	

	public function all_bid(){

		

	$this->db->select('tender.equipment,tender.e_tender_id,tender.remarks,company.name,branch.city,bid.*,GROUP_CONCAT(DISTINCT CONCAT_WS(" - ",bid_followup.followup_status,bid_followup.remarks) SEPARATOR ", <br>") AS followup_details');	

	$this->db->join('tender','tender.id = bid.tender_id');

	$this->db->join('company','company.company_id = tender.company_id');

	$this->db->join('branch','branch.branch_id = tender.branch_id');
	$this->db->join('bid_followup','bid.id = bid_followup.bid_id','LEFT');
	$this->db->where('bid.is_deleted',0);
    $this->db->group_by('bid.id');
//	$this->db->order_by('bid.id','DESC');
	$this->db->order_by('bid.bid_number','DESC');

	$result = $this->db->get('bid');

	return $result->result();		

		

	}



    public function delete_tender(){

    

    $this->db->set('is_deleted',1);

    $this->db->where('id',$this->uri->segment(1));

    $this->db->update('tender');

    

		if($this->db->affected_rows() > 0){

		$this->session->set_flashdata('message','Deleted Successfully!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}    

    }



    public function delete_tender_followup(){

    

    $this->db->set('is_deleted',1);

    $this->db->where('id',$this->uri->segment(1));

    $this->db->update('tender_followup');

    

		if($this->db->affected_rows() > 0){

		$this->session->set_flashdata('message','Deleted Successfully!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}    

    }

	

    public function delete_bid(){

    

    $this->db->set('is_deleted',1);

    $this->db->where('id',$this->uri->segment(1));

    $this->db->update('bid');

    

		if($this->db->affected_rows() > 0){

		$this->session->set_flashdata('message','Deleted Successfully!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}    

    }



    public function delete_bid_followup(){

    

    $this->db->set('is_deleted',1);

    $this->db->where('id',$this->uri->segment(1));

    $this->db->update('bid_followup');

    

		if($this->db->affected_rows() > 0){

		$this->session->set_flashdata('message','Deleted Successfully!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);			

		}    

    }



    public function bid_detail(){

        

	$this->db->select('company.name,branch.city,tender.company_id,tender.branch_id,tender.tender_for,tender.equipment,tender.e_tender_id,tender.last_date,tender.pre_bid_date,tender.ammendment,tender.est_cost,tender.eligibility,tender.specifications,bid.*');

	$this->db->join('tender','tender.id = bid.tender_id');

	$this->db->join('company','company.company_id = tender.company_id');

	$this->db->join('branch','branch.branch_id = tender.branch_id');

	$this->db->where('bid.is_deleted',0);

	$this->db->where('bid.id',$this->uri->segment(1));

	$result = $this->db->get('bid');

	if(!empty($result->row())){

	 return $result->row();     

	}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);	    

	}

	

    }



    public function tender_detail(){

        

	$this->db->select('company.name,branch.city,branch.country,branch.contact_person,branch.email,branch.contact_number,branch.state,branch.address,tender.*');	

	$this->db->join('company','company.company_id = tender.company_id');

	$this->db->join('branch','branch.branch_id = tender.branch_id','LEFT');

	$this->db->where('tender.status !=',1);

	$this->db->where('tender.is_deleted',0);

	$this->db->where('tender.id',$this->uri->segment(1));

	$result = $this->db->get('tender');

	if(!empty($result->row())){

	 return $result->row();     

	}else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);	    

	}

	      

    }



    public function update_tender(){

	    $work_equipment = "";
        if(strtolower($this->input->post('tender_for'))=='sales'){
            $work_equipment = $this->security->xss_clean($this->input->post('equipment'));    
        }else{
            $work_equipment = $this->security->xss_clean($this->input->post('work_name'));    
        }
	    

		$data = array(

		'company_id'		=>$this->security->xss_clean($this->input->post('company_id')),

		'branch_id'		 	=>$this->security->xss_clean($this->input->post('branch')),

		'tender_for'		=>$this->security->xss_clean($this->input->post('tender_for')),

		'equipment'		    =>$work_equipment,

		'e_tender_id'		=>$this->security->xss_clean($this->input->post('e_tender_id')),

		'pre_bid_date'		=>$this->security->xss_clean($this->input->post('pre_bid_date')),

		'last_date'			=>$this->security->xss_clean($this->input->post('last_date')),

		'ammendment'        =>$this->security->xss_clean($this->input->post('ammendment')),

		'emd_amount'		=>$this->security->xss_clean($this->input->post('emd_amount')),

		'est_cost'          =>$this->security->xss_clean($this->input->post('est_cost')),

		'eligibility'		=>$this->security->xss_clean($this->input->post('eligibility')),

		'specifications'	=>$this->security->xss_clean($this->input->post('specifications')),

		'status'		 	=>$this->security->xss_clean($this->input->post('status')),
		'tender_source'		 	=>$this->security->xss_clean($this->input->post('tender_source')),
		'remarks'		 	=>$this->security->xss_clean($this->input->post('remarks')),

		'date'				=>date('Y-m-d h:i:s'),
		'tender_fee_amt'=>$this->security->xss_clean($this->input->post('tender_fee_amt')),
		'processing_fee_amt'=>$this->security->xss_clean($this->input->post('processing_fee_amt'))    

		);

	$this->db->where('id',$this->uri->segment(1));

	$this->db->update('tender',$data);

	

	if($this->security->xss_clean($this->input->post('status')) == 'Participate'){

	

	$bid_data = array(

	'tender_id'			=>$this->uri->segment(1),

	'bid_number'		=>$this->security->xss_clean($this->input->post('bid_no')),

	'status'			=>'Incomplete',

	//'company_id'		=>$this->security->xss_clean($this->input->post('company_id')),

	//'branch_id'			=>$this->security->xss_clean($this->input->post('branch')),

	'remarks'           =>$this->security->xss_clean($this->input->post('remarks')),

	'date'              =>date('Y-m-d')

	);
	
	$this->db->select('id');
    $this->db->where('tender_id',$this->uri->segment(1));
	$this->db->where('bid_number',$this->input->post('bid_no'));
	$this->db->where('is_deleted',0);
    $result = $this->db->get('bid');
	
	if($result->num_rows() == 0){
	    $bid_data = $bid_data + ['financial_year_bid_number'=>$this->security->xss_clean($this->input->post('financial_year_bid_number'))];
		$bid_insert = $this->db->insert('bid',$bid_data);
	}else{
		$result = $result->result();
		$this->db->where('id',$result[0]->id);
		$this->db->update('bid',$bid_data);
	}

	}	

	

	if($this->db->affected_rows() > 0){

	return true;

	}else{

		return false;

	}        

        

    }



    public function company_branch($id){

    

    $this->db->select('branch_id,city');

    $this->db->where('company_id',$id);

    $result = $this->db->get('branch');

    return $result->result();  

    

    }

// 31 Dec 2022

    public function company_branch_new($id){    
        $this->db->select('branch.*,company.name');
        $this->db->join('company','company.company_id = branch.company_id');
        $this->db->where('branch.company_id',$id);
        $result = $this->db->get('branch');
        return $result->result();
    }


    /*public function get_bid_no(){
		$result = $this->db->get('bid'); 
		$result = $result->num_rows();
		if($result == 0){
			return sprintf('%02d',1);;    
    }else{
    $temp = $result+1;    
    return sprintf('%02d', $temp);

    }

    }*/
	
	public function get_bid_no(){
	    $this->db->select('*');
        $this->db->where('status','1');
        $result_year = $this->db->get('financial_year'); 
        $result_year = $result_year->result();
        
        $this->db->select('max(financial_year_bid_number) AS bid_num');
        //$this->db->where('is_deleted',0);
        $this->db->where('financial_year',$result_year[0]->year);
        $result = $this->db->get('bid'); 
        $result = $result->result();
        
        if($result[0]->bid_num==''){
            $new_bid_num = 'IT/BID/'.$result_year[0]->year.'/001';
        }else{
            $new_bid_num = $result[0]->bid_num;
            //$new_bid_num = explode('/',$new_bid_num);
            //$cnt = count($new_bid_num);
            $new_bid_num = $new_bid_num + 1;
            if(strlen($new_bid_num)<3){
                $prefix = ['1'=>'00','2'=>'0'];
                $new_bid_num = $prefix[strlen($new_bid_num)].$new_bid_num;	
            }
            //$new_bid_num = implode('/',$new_bid_num); 
            //echo $new_bid_num;exit;
            $new_bid_num = 'IT/BID/'.$result_year[0]->year.'/'.$new_bid_num;
        }
        
        return $new_bid_num;
    }


    public function get_bid_no_by_id($id){

        

    $this->db->select('bid_number');

    $this->db->where('tender_id',$id);

    $result = $this->db->get('bid');

    return $result->row();

    

    }



	public function update_bid(){

	

	$bid_data = array(

	'bid_number'            =>$this->security->xss_clean($this->input->post('bid_no')),

	'category'              =>$this->security->xss_clean($this->input->post('category')),

	'contact_person'        =>$this->security->xss_clean($this->input->post('contact_person')),

	'contact_email'         =>$this->security->xss_clean($this->input->post('email')),

	'contact_number'        =>$this->security->xss_clean($this->input->post('contact_number')),

	'publish_date'          =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('publish_date')))),

	'hard_document_date'    =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('hard_document_date')))),

	'processing_fee'        =>$this->security->xss_clean($this->input->post('processing_fee')),

	'processing_fee_no'     =>$this->security->xss_clean($this->input->post('pf_no')),

	//'processing_fee_date'   =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('processing_fee_date')))),
        'processing_fee_date'   =>$this->security->xss_clean($this->input->post('processing_fee_date')),

	'tender_fee'            =>$this->security->xss_clean($this->input->post('tender_fee')),

	'tender_fee_no'         =>$this->security->xss_clean($this->input->post('tf_no')),

	//'tender_fee_date'       =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('tender_fee_date')))),
        'tender_fee_date'       => $this->security->xss_clean($this->input->post('tender_fee_date')),
	'emd_fee'               =>$this->security->xss_clean($this->input->post('emd_fee')),

	'emd_fee_no'            =>$this->security->xss_clean($this->input->post('ef_no')),

	//'emd_fee_date'          =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('end_fee_date')))),
        'emd_fee_date'          => $this->security->xss_clean($this->input->post('end_fee_date')),
        'emd_return_date'       => $this->security->xss_clean($this->input->post('emd_return_date')),
        'emd_status'    => $this->security->xss_clean($this->input->post('emd_status')),
	'remarks'               =>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks')))),

	'status'                =>'Complete',
        'hard_document_submission' => $this->input->post('hard_document_submission')

	);

	

	$this->db->where('tender_id',$this->input->post('tender_id'));

	$this->db->update('bid',$bid_data);

	$bid = $this->db->affected_rows();

	

	$tender_data = array(

	'company_id'     =>$this->security->xss_clean($this->input->post('company_id')),

	'branch_id'      =>$this->security->xss_clean($this->input->post('branch')), 

	'tender_for'     =>$this->security->xss_clean($this->input->post('tender_for')),   

	'e_tender_id'    =>$this->security->xss_clean($this->input->post('e_tender_id')),

	'last_date'      =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('last_date')))),

	'pre_bid_date'   =>date("Y-m-d",strtotime($this->security->xss_clean($this->input->post('pre_bid_date')))),    

	'ammendment'     =>$this->security->xss_clean($this->input->post('ammendment')),

	'est_cost'       =>$this->security->xss_clean($this->input->post('est_cost')),

	'eligibility'    =>$this->security->xss_clean($this->input->post('eligibility')),

	'specifications' =>$this->security->xss_clean($this->input->post('specifications'))

	);

	$this->db->where('id',$this->input->post('tender_id'));

	$this->db->update('tender',$tender_data);

	$tender = $this->db->affected_rows(); 

	

	if($bid > 0 || $tender > 0){

	return true;    

	}else{

	 return false;   

	}

	

	}

	

	

}

?>