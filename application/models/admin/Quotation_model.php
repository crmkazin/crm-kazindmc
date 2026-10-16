<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_model extends CI_Model{	
    
	public function all_quotations(){

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,enquiry.multiple,enquiry.id as enquiry_id,quotation.*');	

	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id','LEFT');

	$this->db->join('company','company.company_id = enquiry.company','LEFT');

	$this->db->join('branch','branch.branch_id = enquiry.branch','LEFT');

	if($this->session->userdata('type') == 3){

	$this->db->where('enquiry.added_by',$this->session->userdata('id'));   

	}

	$this->db->order_by('id','DESC');

	$result = $this->db->get('quotation');

	return $result->result();

	}

	public function all_awarded_project(){

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.quotation_number,project_awarded.*');	

	$this->db->join('quotation','quotation.id = project_awarded.quotation_id');

	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');

	$this->db->join('company','company.company_id = enquiry.company');

	$this->db->join('branch','branch.branch_id = enquiry.branch');

	if($this->session->userdata('type') == 3){

	$this->db->where('enquiry.added_by',$this->session->userdata('id'));   

	}	
    
    $this->db->where('project_awarded.oa_status','pending');
	$this->db->order_by('project_awarded.id','DESC');

	$result = $this->db->get('project_awarded');

	return $result->result();		

	//print_r($result->result());exit;	

	}

	public function awarded_enquiry($number){

	$this->db->select('quotation_sent_detail.enquiry'); 

	$this->db->join('quotation_sent_detail','quotation_sent_detail.quotation_sent_id = quotation_sent.id'); 

	$this->db->where('quotation_sent.quotation_number',$number);

	$result = $this->db->get('quotation_sent');

	return $result->result();

	

	}

	public function order_detail(){
            $this->db->select('company.company_id,company.name,branch.branch_id,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.quotation_number,quotation.date as quotation_date,project_awarded.*');	
            $this->db->join('quotation','quotation.id = project_awarded.quotation_id');
            $this->db->join('enquiry','enquiry.id = quotation.enquiry_id');
            $this->db->join('company','company.company_id = enquiry.company');
            $this->db->join('branch','branch.branch_id = enquiry.branch');	
            $this->db->where('project_awarded.id',$this->uri->segment(1));
            if($this->session->userdata('type') == 3){
                $this->db->where('enquiry.added_by',$this->session->userdata('id'));   
            }	
            $result = $this->db->get('project_awarded');
            return $result->row();
	}

	public function new_order_creation(){	
            $this->db->order_by('id','DESC');
            $this->db->limit(1);
            $result = $this->db->get('order_acknowledgement');
            $result = $result->row();
            $no ='01';
            if(!empty($result)){
                if($result->id > 9){
                    $no = $result->id + 1;
                }else{
                    $add = $result->id + 1;   
                    $no = '0'.$add;    
                }    
            }

	$data = array(
            //'client_order_no'       =>$this->security->xss_clean($this->input->post('order_no')),
            'project_awarded_id'	=>$this->uri->segment(1),
            //'order_no'		=>substr(date('Y'), -2).$no,
            'order_no'        => $this->security->xss_clean($this->input->post('order_no')),
            'order_date'		=>date('Y-m-d', strtotime( $this->input->post('order_date') )),
            'performance_security'	=>$this->security->xss_clean($this->input->post('performance_security')),
            'delivery_due_date'	=>$this->input->post('delivery_due_date'),
            'status'		=>$this->security->xss_clean($this->input->post('status')),
            'remarks'               =>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks')))),
            'amount_with_gst'	=>$this->security->xss_clean($this->input->post('amount_with_gst')),
            'amount_without_gst'	=>$this->security->xss_clean($this->input->post('amount_without_gst')),
            'invoice'               =>$this->security->xss_clean($this->input->post('invoice_status')),
            'invoice_no'    	=>$this->security->xss_clean($this->input->post('invoice_no')),	
            'date'                  =>date('Y-m-d h:i:s'),
            'organization'      => $this->input->post('organization'),
            'security_amount' => $this->security->xss_clean($this->input->post('security_amount')),
            'mode_security_submission' => $this->security->xss_clean($this->input->post('mode_security_submission')),
            'security_duration' => $this->security->xss_clean($this->input->post('security_duration')),
            'warranty_start_date' => $this->security->xss_clean($this->input->post('warranty_start_date')),
            'enquiry_for' => $this->security->xss_clean($this->input->post('enquiry_for')),
            'branch' => $this->security->xss_clean($this->input->post('city')),
			'actual_delivered_date' => $this->security->xss_clean($this->input->post('delivery_actual_date')),
            'tds_tcs_deduction' => $this->security->xss_clean($this->input->post('tds_tcs_deducted')),
            'installation' => $this->security->xss_clean($this->input->post('installation')),
            'installation_date' => $this->security->xss_clean($this->input->post('installation_date')),
            'warranty_duration' => $this->security->xss_clean($this->input->post('warranty_duration')),
            'security_bank_name' => $this->security->xss_clean($this->input->post('security_bank_name')),
            'bank_reference_no' => $this->security->xss_clean($this->input->post('bank_reference_no')),
            'gst_percentage' => $this->security->xss_clean($this->input->post('gst_percentage')),
            'financial_year' =>$this->security->xss_clean($this->input->post('financialyear')),
            'security_creation_date' =>$this->security->xss_clean($this->input->post('security_creation_date')),

	);

	$order = $this->db->insert('order_acknowledgement',$data);
    
    $this->db->where('project_awarded.id',$this->uri->segment(1));
    $this->db->update('project_awarded',['oa_status'=>'created']);       
    
	if($order){
            return true;
	}else{
            return false;	
        }

	}

	public function order_acknowledgement(){
		//$this->db->select('company.name as company,company.name as client,branch.city,quotation.quotation_number,quotation_sent.date as quotation_date,quotation_sent.id as quotation_sent_id,order_acknowledgement.*');	
	
	/*$this->db->select('company.name as company,company.name as client,branch.city,order_acknowledgement.*,IF(tender.equipment IS NULL, 0,tender.equipment) AS enquiry_for,quotation_sent.id as quotation_sent_id,');	
	$this->db->join('project_awarded','project_awarded.id = order_acknowledgement.project_awarded_id');

	$this->db->join('quotation','quotation.id = project_awarded.quotation_id','LEFT');
	$this->db->join('quotation_sent','quotation_sent.quotation_number = quotation.quotation_number','LEFT');
	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id','LEFT');

	//$this->db->join('company','company.company_id = enquiry.company');

	//$this->db->join('branch','branch.branch_id = enquiry.branch');
	
	$this->db->join('bid','bid.id = project_awarded.bid_id','LEFT');
	$this->db->join('tender','bid.tender_id = tender.id','LEFT');
    $this->db->join('company','(company.company_id = enquiry.company || company.company_id = tender.company_id)','LEFT');
	$this->db->join('branch','(branch.branch_id = enquiry.branch || branch.branch_id = tender.branch_id)','LEFT');
	
	$this->db->where('order_acknowledgement.is_deleted',0);

	$this->db->order_by('order_acknowledgement.id','DESC');

	$result = $this->db->get('order_acknowledgement');

	$result = $result->result();*/

	$this->db->select('company.name as client,branch.city,order_acknowledgement.*');
	    $this->db->select('GROUP_CONCAT(invoice.invoice_name SEPARATOR ",") AS invoices,GROUP_CONCAT(invoice.previously_edited SEPARATOR ",") AS previous_invoices');
	$this->db->join('company','company.company_id = order_acknowledgement.organization');
	$this->db->join('branch','branch.branch_id = order_acknowledgement.branch');
	    $this->db->join('invoice','invoice.order_id = order_acknowledgement.id','LEFT');
	$this->db->where('order_acknowledgement.organization !=','');
	$this->db->where('order_acknowledgement.branch !=','');
	$this->db->where('order_acknowledgement.enquiry_for !=','');
	$this->db->where('order_acknowledgement.is_deleted',0);
//	$this->db->where('order_acknowledgement.invoice != ','Yes');
        $this->db->group_by('order_acknowledgement.id');
	$result2 = $this->db->get('order_acknowledgement');

	$result2 = $result2->result();
    return $result2;
	//return array_merge($result,$result2);

	}

	public function invoice(){

	/*$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,quotation.quotation_number,quotation.date as quotation_date');	

	$this->db->join('project_awarded','project_awarded.id = order_acknowledgement.project_awarded_id');

	$this->db->join('quotation','quotation.id = project_awarded.quotation_id');

	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');	

	$this->db->join('company','company.company_id = enquiry.company');	

	$this->db->join('branch','branch.branch_id = enquiry.branch');

	$this->db->where('order_acknowledgement.id',$this->uri->segment(1));

	$result = $this->db->get('order_acknowledgement');

	return $result->row();	
*/
      $this->db->select('company.name,company.company_id,order_acknowledgement.*');
        $this->db->join('company','company.company_id = order_acknowledgement.organization');
        $this->db->where('order_acknowledgement.id',$this->uri->segment(1));    
        $result = $this->db->get('order_acknowledgement'); 

        if(!empty($result->row())){
            return $result->row();    
	}
}

	public function print_quotation(){

	$this->db->select('enquiry.id as enquiry_id,enquiry.multiple,enquiry.enquiry_type,enquiry.enquiry_for,enquiry.mode,company.name,branch.contact_number,branch.email,branch.contact_person,branch.country,branch.state,branch.city,branch.address');//,quotation.quotation_number,quotation.date as quotation_date');

	//$this->db->join('enquiry','enquiry.id = quotation.enquiry_id','LEFT');	

	$this->db->join('company','company.company_id = enquiry.company','LEFT');	

	$this->db->join('branch','branch.branch_id = enquiry.branch','LEFT');

	//$this->db->where('quotation.id',$this->uri->segment(1));// 16 Feb 2023
	//$result = $this->db->get('quotation');// 16 Feb 2023
    $this->db->where('enquiry.id',$this->uri->segment(1));
    $result = $this->db->get('enquiry');
    //echo '<pre>';print_r($result->row());exit;
    if(!empty($result->row())){

        return $result->row();

    }else{

    redirect('quotation');    

    }	

	}	
    
    public function get_multiple_enquiry($enquiry_id){
        $final_array = array();
        $this->db->select('id,enquiry_for');
        $this->db->where('id',$enquiry_id);
        $result = $this->db->get('enquiry');
        $result = $result->row();

    if(!empty($result)){

    $final_array[] = array(

    'enquiry_id'=>$result->id,     

    'enquiry'   =>$result->enquiry_for 

    );

    }

    

    $this->db->select('id,enquiry_for');

    $this->db->where('enquiry_id',$enquiry_id);

    $result2 = $this->db->get('multiple_enquiry');

    $result2 = $result2->result();    

    

    if(!empty($result2)){

    foreach($result2 as $data){

    $final_array[] = array(

    'enquiry_id'=>$data->id,    

    'enquiry'   =>$data->enquiry_for 

    );        

    }    

    }

    return $final_array;

    

	}

    public function final_quotation($quotenumval){
    
    $select = '*';
    $where = ' status = "1"';
    $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];

    $this->db->select('MAX(financial_year_quotation_no) AS id');
    $this->db->where('financial_year',$financial_year->year);
    $id = $this->db->get('quotation');
    $id = $id->row();

    if(!empty($id->id) && $id->id != '0'){
        //$no = explode('/',$id->id);
        $no = $id->id + 1;                        
    }else{
        $no = 1;
    }
    $financial_year_quotation_no = $no;
    if(strlen($no)<3){
        $prefix = ['1'=>'00','2'=>'0'];
        $no = $prefix[strlen($no)].$no;	
    } 
    
        
    $quotation_number = $this->input->post('quote_prefix').$no;//$this->input->post('quotation_number');
        // $this->db->where('quotation_number',$quotation_number);    
        // $result = $this->db->get('quotation_sent');
        
        // updated on 31 Jan 2023
     
     // Added on 03 Jan 2023
     
    $qno_postfix = '';
    if($this->input->post('qno_postfix1')<>''){
        $qno_postfix1 = '-'.$this->input->post('qno_postfix1');
        $qno_postfix2 = ($this->input->post('qno_postfix2')<>'')?'-'.$this->input->post('qno_postfix2'):'';
        $qno_postfix = $qno_postfix1.$qno_postfix2;            
    }
    $quotation_number = $quotation_number.$qno_postfix; 
    
     if($quotenumval==$quotation_number)
     {
            $this->db->where('quotation_number',$quotation_number);    
            $resultnew = $this->db->get('quotation_sent'); 
        	if(!empty($resultnew->row())){
            $this->session->set_flashdata('message','Quotation No Already Exist!');	
            redirect($_SERVER['HTTP_REFERER']);
     }
     }
     
     else
     {
         
            
        $this->db->where('quotation_number',$quotation_number);    
        $result = $this->db->get('quotation');
        
	if(!empty($result->row())){
            $this->session->set_flashdata('message','Quotation No Already Exist!');	
            redirect($_SERVER['HTTP_REFERER']);
	}
	
	}
    
     
	/*$this->db->where('id',$this->uri->segment(1));
	//$this->db->where('quotation_number',$quotation_number);
	$check = $this->db->get('quotation');
	if(!empty($check->row())){
            $this->db->where('id',$this->uri->segment(1));
            //$previous = $this->db->get('quotation');
            //$previous =$previous->row();
            $data = array(
                //'enquiry_id'        =>$previous->enquiry_id,
                'quotation_number'  =>$quotation_number,
                //'quotation_status'  =>'0',
                //'remark'            =>$previous->remark,
                'date'              =>date('Y-m-d h:i:s')
            );

            //$this->db->insert('quotation',$data); 
            $this->db->update('quotation',$data);       
	}*/
       
        
       
       
       $data = array(
                'enquiry_id'        =>$this->uri->segment(1),
                'quotation_number'  =>$quotation_number,
                'quotation_status'  =>'0',
                'financial_year_quotation_no' => $financial_year_quotation_no,//$this->input->post('financial_year_quotation_no'),
                //'remark'            =>$previous->remark,
                'financial_year' => $this->input->post('financial_year'),
                'date'              =>date('Y-m-d h:i:s')
            );
        $this->db->insert('quotation',$data); 
        
        $update = array('status' =>'Quotation Send');
	    $this->db->where('id',$this->uri->segment(1));
	    $this->db->update('enquiry',$update);
       

        $detail = array(
            'quotation_number' =>$quotation_number,
            'price'            =>'',//$this->input->post('price'),    
            'payment'          =>'',//$this->input->post('payment'),
            'gst'              =>'',//$this->input->post('gst'),
            'validity'         =>'',//$this->input->post('validity'),
            'delivery'         =>'',//$this->input->post('delivery'),
            'warranty'         =>'',//$this->input->post('warranty'),
            
            //'email_to'         =>$this->input->post('hdn_preview_kind'),
           // 'email_to'         =>$this->input->post('hdn_preview_client_name'),
           // 'email_to'         =>$this->input->post('hdn_preview_complete_address'),
            'email_to'         =>$this->input->post('email_to'),
            'email_cc'         =>$this->input->post('email_cc'),
            'person_designation'=>$this->input->post('designation'),
            'email_subject'    =>$this->input->post('email_subject'),
            'executive_name'   =>$this->input->post('executive_name'),
            'executive_email'  =>$this->input->post('executive_email'),
            'executive_mobile' =>$this->input->post('executive_number'),
            'executive_designation' =>$this->input->post('executive_designation'),
            'date'             =>date('Y-m-d h:i:s'),
            'currency'         =>$this->input->post('currency')
	);    
	$this->db->insert('quotation_sent',$detail); 
	$quotation_sent_id = $this->db->insert_id();
    
        /*$j=1;
        while(isset($_REQUEST["enquiry_id".$j])){
            if(isset($_REQUEST["txtChoice".$j])){
                $data = array(
                    'quotation_sent_id'=>$quotation_sent_id,
                    'enquiry'          =>$_REQUEST["enquiry_for".$j],
                    'model'            =>$_REQUEST["model".$j],
                    'make'             =>$_REQUEST["make".$j],
                    'description'      =>$_REQUEST["description".$j],
                    'unit_price'       =>$_REQUEST["unit_price".$j],
                    'quantity'         =>$_REQUEST["quantity".$j],
                    'amount'           =>$_REQUEST["unit_price".$j] * $_REQUEST["quantity".$j]
                );
                $this->db->insert('quotation_sent_detail',$data);
            }
            $j++;
        }*/
        
        $cnt = count($this->input->post('description[]'));
        for($i=0;$i<$cnt;$i++){
			$quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
            $insert_array[] = array(
                    'quotation_sent_id'=>$quotation_sent_id,
                    'enquiry'          =>($this->input->post('enquiry_for['.$i.']')<>'')?$this->input->post('enquiry_for['.$i.']'):'',//$_REQUEST["enquiry_for".$i],
                    'model'            =>'',//$_REQUEST["model".$i],
                    'make'             =>'',//$_REQUEST["make".$i],
                    'description'      =>$this->input->post('description['.$i.']'),
                    'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                    'quantity'         =>$this->input->post('quantity['.$i.']'),
                    'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity
                );
        }
        //echo "<pre>";        print_r($insert_array);exit;
        $this->db->insert_batch('quotation_sent_detail',$insert_array);
        
	$this->session->set_flashdata('message','Submitted!');	
        $this->session->set_flashdata('POST',$_POST);
	redirect($quotation_sent_id.'/mail-data');   
    }
	public function mail_data(){
            $this->db->select('quotation_sent.*,quotation_sent_detail.*,branch.*,company.name as organization');    
            $this->db->where('quotation_sent.id',$this->uri->segment(1)); 
            $this->db->join('quotation_sent_detail','quotation_sent_detail.quotation_sent_id = quotation_sent.id');
            $this->db->join('quotation','quotation.quotation_number = quotation_sent.quotation_number');
            $this->db->join('enquiry','enquiry.id = quotation.enquiry_id');
            $this->db->join('branch','branch.branch_id = enquiry.branch');
            $this->db->join('company','company.company_id = branch.company_id');
            $result = $this->db->get('quotation_sent');  

            if(!empty($result->result())){
                return $result->result();
            }else{
                $this->session->set_flashdata('message','Error!');	
                redirect('quotation'); 
            }
	}

	

    public function sent_quotations(){
	$this->db->select('quotation_sent.*,branch.city,branch.contact_person,company.name as organization,quotation.id as qid,quotation.quotation_status,quotation.remark');    
	$this->db->join('quotation','quotation.quotation_number = quotation_sent.quotation_number');
	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');
	$this->db->join('branch','branch.branch_id = enquiry.branch');
	$this->db->join('company','company.company_id = branch.company_id');
	if($this->session->userdata('type') == 3){
            $this->db->where('enquiry.added_by',$this->session->userdata('id'));   
	}	
	$this->db->order_by('quotation_sent.id','DESC');
	$result = $this->db->get('quotation_sent');
        return $result->result();
    }

	

	public function sent_quotations_enquiry($id){

	$this->db->select('enquiry');

	$this->db->where('quotation_sent_id',$id);

	$result = $this->db->get('quotation_sent_detail');

	return $result->result();

	    

	}

	

    public function update_pdf($pdf,$id){

    $this->db->set('pdf',$pdf);

    $this->db->where('id',$id);

    $this->db->update('quotation_sent'); 

    if($this->db->affected_rows() > 0){

    return true;    

    }else{

        return false;

    }

    }



    public function get_pdf_mail($id){

    

    $this->db->select('email_to,email_cc,pdf,email_subject');  

    $this->db->where('id',$id);

    $result = $this->db->get('quotation_sent');

    

    if(!empty($result->row())){

    return $result->row();    

    }else{

	$this->session->set_flashdata('message','Error!');	

	redirect('quotation');        

    }

    

    }

    

	public function old_order_creation(){

	

	$data = array(

	'client_order_no'       =>$this->security->xss_clean($this->input->post('order_no')),

	'order_no'				=>$this->security->xss_clean($this->input->post('oa_no')),

	'order_date'			=>date('Y-m-d', strtotime( $this->input->post('order_date') )),

	'performance_security'	=>$this->security->xss_clean($this->input->post('performance_security')),

	'delivery_due_date'		=>$this->input->post('delivery_due_date'),

	'status'				=>$this->security->xss_clean($this->input->post('status')),

	'remarks'				=>$this->security->xss_clean($this->input->post('remarks')),

	'amount_with_gst'		=>$this->security->xss_clean($this->input->post('amount_with_gst')),

	'amount_without_gst'	=>$this->security->xss_clean($this->input->post('amount_without_gst')),

	'invoice'				=>$this->security->xss_clean($this->input->post('invoice_status')),

	'invoice_no'			=>$this->security->xss_clean($this->input->post('invoice_no')),	

	'date'                  =>date('Y-m-d h:i:s'),

	'organization'          =>$this->security->xss_clean($this->input->post('company_id')),

	'branch'                =>$this->security->xss_clean($this->input->post('branch')),

	'enquiry_for'           =>implode(",",$this->security->xss_clean($this->input->post('enquiry_for')))

	);

	$order = $this->db->insert('order_acknowledgement',$data);

	if($order){

	return true;	

	}else{

	return false;	

	}

	

	}    

  

    public function get_oa(){
        $this->db->select('company.name,order_acknowledgement.*');
        $this->db->join('company','company.company_id = order_acknowledgement.organization');
        $this->db->where('order_acknowledgement.id',$this->uri->segment(1));    
        $result = $this->db->get('order_acknowledgement'); 

        if(!empty($result->row())){
            return $result->row();    
        }else{
            $this->session->set_flashdata('message','Error!');	
            redirect($_SERVER['HTTP_REFERER']);
        }   

    }  

 

	public function update_order_creation(){

	

	$data = array(

	'client_order_no'       =>$this->security->xss_clean($this->input->post('order_no')),

	'order_no'				=>$this->security->xss_clean($this->input->post('oa_no')),

	'order_date'			=>date('Y-m-d', strtotime( $this->input->post('order_date') )),

	'performance_security'	=>$this->security->xss_clean($this->input->post('performance_security')),

	'delivery_due_date'		=>$this->input->post('delivery_due_date'),

	'status'				=>$this->security->xss_clean($this->input->post('status')),

	'remarks'				=>$this->security->xss_clean($this->input->post('remarks')),

	'amount_with_gst'		=>$this->security->xss_clean($this->input->post('amount_with_gst')),

	'amount_without_gst'	=>$this->security->xss_clean($this->input->post('amount_without_gst')),

	'invoice'				=>$this->security->xss_clean($this->input->post('invoice_status')),

	'invoice_no'			=>$this->security->xss_clean($this->input->post('invoice_no')),	

	'date'                  =>date('Y-m-d h:i:s'),

	'organization'          =>$this->security->xss_clean($this->input->post('company_id')),

	'branch'                =>$this->security->xss_clean($this->input->post('branch')),

	'enquiry_for'           =>implode(",",$this->security->xss_clean($this->input->post('enquiry_for')))

	);

	$this->db->where('id',$this->uri->segment(1));

	$this->db->update('order_acknowledgement',$data);



	if($this->db->affected_rows() > 0){

	return true;	

	}else{

	return false;	

	}

	

	} 

    

   public function delete_oa(){

    $this->db->set('is_deleted',1);

    $this->db->where('id',$this->uri->segment(1));

    $this->db->update('order_acknowledgement');

    if($this->db->affected_rows() > 0){

		$this->session->set_flashdata('message','Deleted Successfully!');	

		redirect($_SERVER['HTTP_REFERER']);        

    }else{

		$this->session->set_flashdata('message','Error!');	

		redirect($_SERVER['HTTP_REFERER']);        

    }

   } 
    public function get_similar_quotes($enquiry_abbr, $roe, $origin_city, $arrival_city, $arrival_time, $departing_time, $early_checkin, $late_checkout, $adults_num, $child_num, $no_of_nights, $city_names) {
        $this->db->select('q.*, e.number_persons, e.number_child, e.number_of_nights, e.enquiry_no, e.check_in_date, e.check_out_date');
        
        $this->db->from('quotations q');
        $this->db->join('enquiry e', 'e.id = q.enquiry_id', 'left');
        $this->db->where('e.number_persons', $adults_num);
        $this->db->where('e.number_child', $child_num);
        $this->db->where('e.enquiry_abbr', $enquiry_abbr);
        $this->db->where('e.number_of_nights', $no_of_nights);
        if (!empty($origin_city)) { 
            $this->db->where('q.city_of_origin', $origin_city);
        }   
        // $this->db->where('q.roe', $roe);
        if (!empty($arrival_city)){
            $this->db->where('q.city_of_arrival', $arrival_city);
        }
        // if (!empty($early_checkin)){
        //     $this->db->where('q.early_checkin', $early_checkin);
        // }
        // if (!empty($late_checkout)){
        //     $this->db->where('q.late_checkout', $late_checkout);
        // }
        if (!empty($arrival_time)){
            $this->db->where('q.arrival_time', $arrival_time);
        }
        if (!empty($departing_time)){
            $this->db->where('q.departing_time', $departing_time);
        }
        // $this->db->where('q.city_of_origin', $origin_city);
        // $this->db->where('q.roe', $roe);
        // $this->db->where('q.city_of_arrival', $arrival_city);
        // $this->db->where('q.early_checkin', $early_checkin);
        // $this->db->where('q.late_checkout', $late_checkout);
        // $this->db->where('q.arrival_time', $arrival_time);
        // $this->db->where('q.departing_time', $departing_time);
        // $this->db->where('q.quot_final', 'yes');

        // if (!empty($city_names)) {
        //     $cities_array = json_decode($city_names, true);
            
        //     if (is_array($cities_array) && !empty($cities_array)) {
        //         $cities_array = array_filter(array_map('trim', $cities_array));
                
        //         if (!empty($cities_array)) {
        //             $city_count = count($cities_array);
        //             $comma_count = $city_count - 1;
        //             $this->db->where("(LENGTH(q.city_details) - LENGTH(REPLACE(q.city_details, ',', ''))) = $comma_count");
                
        //             $search_string = implode(',', $cities_array);
        //             $this->db->where('q.city_details', $search_string);
                    
        //             // OR use both with AND
        //             // $this->db->where("(LENGTH(q.city_details) - LENGTH(REPLACE(q.city_details, ',', ''))) = $comma_count");
        //             // $this->db->like('q.city_details', $search_string);
        //         }
        //     }
        // }
        
        $this->db->order_by('q.created', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            log_message('error', 'Database error: ' . $error['message']);
            return array();
        }
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        
        return array();
    }
}



