<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model{	
	public function enquiry_filter(){

		//print_r($_POST) ;exit;
	    
	//    echo $this->input->post('company_id') ;exit;

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');	

	$this->db->join('company','company.company_id = enquiry.company');

	$this->db->join('branch','branch.branch_id = enquiry.branch');

	$this->db->where('enquiry.status !=','Quotation Send');
    $check=0;
	if(!empty( $this->input->post('from') )){
    $check++;
	$this->db->where('enquiry.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));

	}

	if(!empty( $this->input->post('to') )){
     $check++;
	$this->db->where('enquiry.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	

	}

	if(!empty( $this->input->post('country') )){
    $check++;
	$this->db->where('branch.country ',$this->input->post('country'));	

	}
	if(!empty( $this->input->post('company_id') )){
		$check++;
	   $this->db->where('company.name',$this->input->post('company_id'));	
   
	   }

	if(!empty( $this->input->post('state') )){
     $check++;
	$this->db->where('branch.state ',$this->input->post('state'));	

	}

	if(!empty( $this->input->post('city') )){
     $check++;
	$this->db->where('branch.city ',$this->input->post('city'));	

	}

	if(!empty( $this->input->post('contact_person') )){
     $check++;
	$this->db->where('branch.contact_person ',$this->input->post('contact_person'));	

	}	

	if(!empty( $this->input->post('email') )){
     $check++;
	$this->db->where('branch.email ',$this->input->post('email'));	

	}

	if(!empty( $this->input->post('contact_number') )){
      $check++;
	$this->db->where('branch.contact_number ',$this->input->post('contact_number'));	

	}

	if(!empty( $this->input->post('status') )){
     $check++;
	$this->db->where('enquiry.status ',$this->input->post('status'));	

	}else{

	$this->db->where('enquiry.status !=','Quotation Send');

	$this->db->where('enquiry.status !=','Send Quotation Now');

	}

	if(!empty( $this->input->post('date') )){
     $check++;
	$this->db->where('enquiry.date',$this->input->post('date'));	

	}

	
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('enquiry.financial_year',$this->input->post('financial_year'));	
   
	   }
	if(!empty( $this->input->post('enquiry_mode') )){
     $check++;
	$this->db->where('enquiry.mode',$this->input->post('enquiry_mode'));	

	}

	if(!empty( $this->input->post('enquiry_for') )){
    $check++;
	$this->db->where('enquiry.enquiry_for',$this->input->post('enquiry_for'));	

	}

	if(!empty( $this->input->post('enquiry_type') )){
     $check++;
	$this->db->where('enquiry.enquiry_type',$this->input->post('enquiry_type'));	

	}	
	if(!empty( $this->input->post('remarks') )){
     $check++;
	$this->db->where('enquiry.remarks',$this->input->post('remarks'));	

	}	
   if($check!=0)
   {
	$this->db->order_by('enquiry.id','DESC');

	$result = $this->db->get('enquiry');
	
//echo $this->db->last_query();exit;
	
    return $result->result();
	}
	
	else
	{
	
	$this->db->order_by('enquiry.id','DESC');

	$result = $this->db->get('enquiry');
	
//echo $this->db->last_query();exit;
	
    return $result->result(); 
	}
	
  }



	public function multiple_enquiry()
	{
	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,multiple_enquiry.enquiry_for,multiple_enquiry.enquiry_type,multiple_enquiry.status,multiple_enquiry.remarks,enquiry.date,enquiry.mode');	

	$this->db->join('company','company.company_id = enquiry.company');

	$this->db->join('branch','branch.branch_id = enquiry.branch');

	$this->db->join('multiple_enquiry','multiple_enquiry.enquiry_id = enquiry.id');

	$this->db->where('enquiry.status !=','Quotation Send');

   if(!empty( $this->input->post('from') )){

	$this->db->where('enquiry.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));

	}
		
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('enquiry.financial_year',$this->input->post('financial_year'));	
   
	   }

	if(!empty( $this->input->post('to') )){

	$this->db->where('enquiry.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	

	}


	if(!empty( $this->input->post('contact_person') )){

	$this->db->where('branch.contact_person ',$this->input->post('contact_person'));	

	}
	if(!empty( $this->input->post('contact_number') )){

	$this->db->where('branch.contact_number ',$this->input->post('contact_number'));	

	}	
	if(!empty( $this->input->post('email') )){

	$this->db->where('branch.email ',$this->input->post('email'));	

	}
	if(!empty( $this->input->post('country') )){

	$this->db->where('branch.country ',$this->input->post('country'));	

	}
    

	if(!empty( $this->input->post('city') )){

	$this->db->where('branch.city ',$this->input->post('city'));	

	}
   if(!empty( $this->input->post('company_id') )){


	$this->db->where('company.name',$this->input->post('company_id'));	

	}

   if(!empty( $this->input->post('enquiry_mode') )){

	$this->db->where('enquiry.mode',$this->input->post('enquiry_mode'));	

	}

	if(!empty( $this->input->post('enquiry_for') )){

	$this->db->where('enquiry.enquiry_for',$this->input->post('enquiry_for'));	

	}

	if(!empty( $this->input->post('enquiry_type') )){

	$this->db->where('enquiry.enquiry_type',$this->input->post('enquiry_type'));	

	}

	if(!empty( $this->input->post('date') )){

	$this->db->where('enquiry.date',$this->input->post('date'));	

	}

	if(!empty( $this->input->post('status') )){

	$this->db->where('enquiry.status ',$this->input->post('status'));	

	}else{

	$this->db->where('enquiry.status !=','Quotation Send');

	$this->db->where('enquiry.status !=','Send Quotation Now');

}
	if(!empty( $this->input->post('remarks') )){

	$this->db->where('enquiry.remarks',$this->input->post('remarks'));	

	}	

	$this->db->order_by('enquiry.id','DESC');

	$result = $this->db->get('enquiry');

	return $result->result();

	

	}

	

	public function quotation_filter(){

		

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.*');	

	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');

	$this->db->join('company','company.company_id = enquiry.company');

	$this->db->join('branch','branch.branch_id = enquiry.branch');
  //if(!empty('quotations')){
  	$check=0;
	  if(!empty( $this->input->post('from') )){
		//echo   $this->input->post('from');exit;
		$check++;
		$this->db->where('quotation.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));
	
		}
			
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('enquiry.financial_year',$this->input->post('financial_year'));	
   
	   }
	
		if(!empty( $this->input->post('to') )){
		 $check++;
		$this->db->where('quotation.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	
	
		}
	if(!empty( $this->input->post('quotation_number') )){
		$check++;
		//echo $this->input->post('quotation_number');exit;

		$this->db->where('quotation.quotation_number',$this->input->post('quotation_number') );
		//exit;
	
	
		}

	

	if(!empty( $this->input->post('country') )){
     $check++;
	$this->db->where('branch.country ',$this->input->post('country'));	

	}

	if(!empty( $this->input->post('state') )){
    $check++;
	$this->db->where('branch.state ',$this->input->post('state'));	

	}

	if(!empty( $this->input->post('city') )){
     $check++;
	$this->db->where('branch.city ',$this->input->post('city'));	

	}

	if(!empty( $this->input->post('contact_person') )){
     $check++;
	$this->db->where('branch.contact_person ',$this->input->post('contact_person'));	

	}	

	if(!empty( $this->input->post('email') )){
    $check++;
	//echo  $this->input->post('email');exit;
	$this->db->where('branch.email ',$this->input->post('email'));	

	}

	if(!empty( $this->input->post('contact_number') )){
    $check++;
	$this->db->where('branch.contact_number ',$this->input->post('contact_number'));	

	}

	if($this->input->post('status')<>''){
    $check++;
	$this->db->where('quotation.quotation_status ',$this->input->post('status'));	
  // print_r($this->input->post('status'));
  // die;
	}

	if(!empty( $this->input->post('company_id') )){
		//echo $this->input->post('company_id');exit;
    $check++;
	$this->db->where('company.name',$this->input->post('company_id'));	

	}

	if(!empty( $this->input->post('enquiry_one') )){
     $check++;
	$this->db->where('enquiry.enquiry_for',$this->input->post('enquiry_one'));	

	}

	if(!empty( $this->input->post('enquiry_two') )){
    $check++;
	$this->db->where('enquiry.enquiry_for',$this->input->post('enquiry_two'));	

	}

	if(!empty( $this->input->post('enquiry_three') )){
     $check++;
	$this->db->where('enquiry.enquiry_for',$this->input->post('enquiry_three'));	

	}	
	
   if($check!=0)
   {
	$this->db->order_by('id','DESC');

	$result = $this->db->get('quotation');

	return $result->result();
	//print_r($data);exit;
	//echo $this->db->last_query();
	//print_r($this->db->last_query());
	//exit;		
   }
  
		

	}

	public function tender_filter(){
     $this->db->select('company.name,branch.city,tender.*,bid.bid_number,bid.processing_fee,bid.processing_fee_no,bid.tender_fee,bid.tender_fee_no,bid.publish_date,bid.hard_document_date');
	$this->db->join('company','company.company_id = tender.company_id','LEFT');
	$this->db->join('branch','branch.branch_id = tender.branch_id','LEFT');
        $this->db->join('bid','(tender.id = bid.tender_id AND bid.is_deleted=0)','LEFT');
       // $this->db->join('enquiry','(enquiry.company = tender.company_id)','LEFT');
     $check=0;
	 if(!empty( $this->input->post('from') )){
		//echo   $this->input->post('from');exit;
		$check++;
		$this->db->where('tender.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));
	
		}
			
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('tender.financial_year',$this->input->post('financial_year'));	
   
	   }
	
		if(!empty( $this->input->post('to') )){
		 $check++;
		$this->db->where('tender.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	
	
		}
	if(!empty( $this->input->post('contact_person') )){
		$check++;
		$this->db->where('branch.contact_person',$this->input->post('contact_person') );	
}
if(!empty( $this->input->post('email') )){
	$check++;
	$this->db->where('branch.email',$this->input->post('email') );	
}
if(!empty( $this->input->post('contact_number') )){
	$check++;
	$this->db->where('branch.contact_number',$this->input->post('contact_number') );	
}
if(!empty( $this->input->post('country') )){
	$check++;
	$this->db->where('branch.country',$this->input->post('country') );	
}
if(!empty( $this->input->post('state') )){
	$check++;
	$this->db->where('branch.state',$this->input->post('state') );	
}
if(!empty( $this->input->post('city') )){
	$check++;
	$this->db->where('branch.city',$this->input->post('city') );	
}

	if(!empty( $this->input->post('last_date') )){
     $check++;
	$this->db->where('tender.last_date >=',$this->input->post('last_date') );

	}

	if(!empty( $this->input->post('tender_for') )){
    $check++;
	$this->db->where('tender.tender_for',$this->input->post('tender_for') );

	}

    if(!empty( $this->input->post('status') )){
     $check++;
	$this->db->where('tender.status ',$this->input->post('status'));	

	}	

	if(!empty( $this->input->post('equipment') )){
     $check++;
	$this->db->where('tender.equipment ',$this->input->post('equipment'));	

	}

	if(!empty( $this->input->post('e_tender_id') )){
     $check++;
	$this->db->where('tender.e_tender_id ',$this->input->post('e_tender_id'));	

	}


	if(!empty( $this->input->post('status') )){
     $check++;
	$this->db->where('tender.status ',$this->input->post('status'));	

	}	

	if(!empty( $this->input->post('company') )){
     $check++;
	$this->db->where('company.name',$this->input->post('company'));	

	}


	if(!empty( $this->input->post('city') )){
     $check++;
	$this->db->where('branch.city',$this->input->post('city'));	

	}

	if(!empty( $this->input->post('eligibility') )){
     $check++;
	$this->db->where('tender.eligibility',$this->input->post('eligibility'));	

	}

	if(!empty( $this->input->post('specifications') )){
      $check++;
	$this->db->where('tender.specifications',$this->input->post('specifications'));	

	}

	if(!empty( $this->input->post('remarks') )){
      $check++;
	$this->db->where('tender.remarks',$this->input->post('remarks'));	

	}	
    if(!empty( $this->input->post('emd_amount') )){
      $check++;
	$this->db->where('tender.emd_amount',$this->input->post('emd_amount'));	

	}	
   if(!empty( $this->input->post('est_cost') )){
     $check++;
	$this->db->where('tender.est_cost',$this->input->post('est_cost'));	

	}	
   if(!empty( $this->input->post('ammendment') )){
     $check++;
	$this->db->where('tender.ammendment',$this->input->post('ammendment'));	

	}	
    if($check!=0)
    {
	//$this->db->order_by('id','DESC');
    $this->db->order_by('bid.bid_number','ASC');
    $this->db->where('tender.is_deleted',0);
	$result = $this->db->get('tender');

	return $result->result();		

    }

	}


	public function bid_filter(){
		$this->db->select('company.name,branch.city,bid.*,tender.e_tender_id,tender.tender_for,tender.equipment,tender.last_date,tender.est_cost,tender.processing_fee_amt,tender.tender_fee_amt,tender.emd_amount,GROUP_CONCAT(DISTINCT CONCAT_WS(" - ",bid_followup.followup_status,bid_followup.remarks) SEPARATOR ", <br>") AS followup_details');	
		$this->db->join('tender','tender.id = bid.tender_id');
		$this->db->join('company','company.company_id = tender.company_id','LEFT');
		$this->db->join('branch','branch.branch_id = tender.branch_id','LEFT');
		$this->db->join('bid_followup','bid.id = bid_followup.bid_id','LEFT');
	
    $check=0;
	if(!empty( $this->input->post('from') )){
		//echo   $this->input->post('from');exit;
		$check++;
		$this->db->where('bid.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));
	
		}
			
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('bid.financial_year',$this->input->post('financial_year'));	
   
	   }
	
		if(!empty( $this->input->post('to') )){
		 $check++;
		$this->db->where('bid.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	
	
		}
	if(!empty( $this->input->post('bid_no') )){
    $check++;
	$this->db->where('bid.bid_number',$this->input->post('bid_no') );

	}
	if(!empty( $this->input->post('country') )){
		$check++;
		$this->db->where('branch.country',$this->input->post('country') );
	
		}


	if(!empty( $this->input->post('company') )){
    $check++;
	$this->db->where('company.name',$this->input->post('company') );

	}
	if(!empty( $this->input->post('city') )){
    $check++;
	$this->db->where('branch.city',$this->input->post('city') );

	}
	
	if(!empty( $this->input->post('tendor_no') )){
    $check++;
	$this->db->where('tender.e_tender_id ',$this->input->post('tendor_no'));	

	}

    if(!empty( $this->input->post('status') )){
     $check++;
	$this->db->where('bid.status ',$this->input->post('status'));	

	}	

	if(!empty( $this->input->post('contact_person') )){
    $check++;
	$this->db->where('bid.contact_person ',$this->input->post('contact_person'));	

	}

	if(!empty( $this->input->post('contact_email') )){
     $check++;
	$this->db->where('bid.contact_email ',$this->input->post('contact_email'));	

	}
	if(!empty( $this->input->post('contact_number') )){
    $check++;
	$this->db->where('bid.contact_number ',$this->input->post('contact_number'));	

	}


	if(!empty( $this->input->post('publish_date') )){
     $check++;
	$this->db->where('bid.publish_date ',$this->input->post('publish_date'));	

	}	

	

	if(!empty( $this->input->post('hard_document_date') )){
     $check++;
	$this->db->where('bid.hard_document_date ',$this->input->post('hard_document_date'));	

	}

	if(!empty( $this->input->post('process_fee') )){
    $check++;
	$this->db->where('bid.processing_fee',$this->input->post('process_fee'));	

	}


	if(!empty( $this->input->post('process_fee_no') )){
    $check++;
	$this->db->where('bid.processing_fee_no',$this->input->post('process_fee_no'));	

	}

	if(!empty( $this->input->post('process_fee_date') )){
    $check++;
	$this->db->where('bid.processing_fee_date',$this->input->post('process_fee_date'));	

	}
    

	if(!empty( $this->input->post('tender_fee') )){
     $check++;
	$this->db->where('bid.tender_fee',$this->input->post('tender_fee'));	

	}

	if(!empty( $this->input->post('tender_fee_no') )){
    $check++;
	$this->db->where('bid.tender_fee_no',$this->input->post('tender_fee_no'));	

	}

	if(!empty( $this->input->post('tender_fee_date') )){
   $check++;
	$this->db->where('bid.tender_fee_date',$this->input->post('tender_fee_date'));	

	}

	

	if(!empty( $this->input->post('emd_fee') )){
    $check++;
	$this->db->where('bid.emd_fee',$this->input->post('emd_fee'));	

	}

	if(!empty( $this->input->post('emd_fee_no') )){
     $check++;
	$this->db->where('bid.emd_fee_no',$this->input->post('emd_fee_no'));	

	}

	if(!empty( $this->input->post('emd_fee_date') )){
    $check++;
	$this->db->where('bid.emd_fee_date',$this->input->post('emd_fee_date'));	

	}

	if(!empty( $this->input->post('remarks') )){
    $check++;
	$this->db->where('bid.remarks',$this->input->post('remarks'));	

	}	
  
   if(!empty( $this->input->post('status') )){
    $check++;
	$this->db->where('bid.status',$this->input->post('status'));	

	}
	if($check!=0)
    {
        
    }
	$this->db->group_by('bid.id');
	//$this->db->order_by('id','ASC');
	$this->db->order_by('bid.bid_number','ASC');
	$this->db->where('bid.is_deleted','0');
	$result = $this->db->get('bid');

	return $result->result();		
    
		

	}
	
	public function oa_filter(){
        //echo '<pre>';print_r($this->input->post());exit;
        $this->db->select('company.name,branch.city,order_acknowledgement.*');	
        //$this->db->join('tender','tender.id = bid.tender_id');
        $this->db->join('company','company.company_id = order_acknowledgement.organization','LEFT');
	$this->db->join('branch','branch.branch_id = order_acknowledgement.branch','LEFT');
	$check=0;
	if(!empty( $this->input->post('from') )){
		//echo   $this->input->post('from');exit;
		$check++;
		$this->db->where('order_acknowledgement.date >=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('from')) )));
	
		}
			
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('order_acknowledgement.financial_year',$this->input->post('financial_year'));	
   
	   }
	
		if(!empty( $this->input->post('to') )){
		 $check++;
		$this->db->where('order_acknowledgement.date <=',date("Y-m-d",strtotime( $this->security->xss_clean($this->input->post('to')) )));	
	
		}
	if(!empty( $this->input->post('contact_person') )){
		$check++;
		$this->db->where('branch.contact_person',$this->input->post('contact_person') );	
}
if(!empty( $this->input->post('email') )){
	$check++;
	$this->db->where('branch.email',$this->input->post('email') );	
}
if(!empty( $this->input->post('contact_number') )){
	$check++;
	$this->db->where('branch.contact_number',$this->input->post('contact_number') );	
}
if(!empty( $this->input->post('country') )){
	$check++;
	$this->db->where('branch.country',$this->input->post('country') );	
}
if(!empty( $this->input->post('state') )){
	$check++;
	$this->db->where('branch.state',$this->input->post('state') );	
}
if(!empty( $this->input->post('city') )){
	$check++;
	$this->db->where('branch.city',$this->input->post('city') );	
}

	if(!empty( $this->input->post('order_date') )){
            $check++;
            $this->db->where('order_acknowledgement.order_date =',$this->input->post('order_date') );
	}

	if(!empty( $this->input->post('performance_security') )){
            $check++;
            $this->db->where('order_acknowledgement.performance_security',$this->input->post('performance_security') );
	}
	if(!empty( $this->input->post('installation') )){
            $check++;
            $this->db->where('order_acknowledgement.installation',$this->input->post('installation'));
	}
	
	if(!empty( $this->input->post('installation_date') )){
            $check++;
            $this->db->where('order_acknowledgement.installation_date',$this->input->post('installation_date'));
	}

        if(!empty( $this->input->post('status') )){
            $check++;
            //$this->db->where('order_acknowledgement.status',$this->input->post('status'));
			$this->db->where('RTRIM(LTRIM(order_acknowledgement.status))=',trim($this->input->post('status')));
	}	

	if(!empty( $this->input->post('remarks') )){
            $check++;
            $this->db->where('order_acknowledgement.remarks',$this->input->post('remarks'));	
	}

	if(!empty( $this->input->post('invoice_status') )){
            $check++;
            $this->db->where('order_acknowledgement.invoice',$this->input->post('invoice_status'));
	}
	
	if(!empty( $this->input->post('warranty_start_date') )){
            $check++;
            $this->db->where('order_acknowledgement.warranty_start_date',$this->input->post('warranty_start_date'));
	}
        
    if(!empty( $this->input->post('delivery_due_date') )){
            $check++;
            $this->db->where('order_acknowledgement.delivery_due_date',$this->input->post('delivery_due_date'));
	}
    if(!empty( $this->input->post('delivery_actual_date') )){
            $check++;
            $this->db->where('order_acknowledgement.actual_delivered_date',$this->input->post('delivery_actual_date'));
	}
	
	
	if($check!=0){
			$this->db->where('order_acknowledgement.is_deleted','0');
            $this->db->order_by('id','DESC');
            $result = $this->db->get('order_acknowledgement');
            return $result->result();		
        }
    }
	

	public function client_report(){
     
        $check=0;

        if(!empty( $this->input->post('company_id') )){
        $check++;
	$this->db->where('company.company_id',$this->input->post('company_id') );
        
	}
		
	if(!empty( $this->input->post('financial_year') )){
		$check++;
	   $this->db->where('company.financial_year',$this->input->post('financial_year'));	
   
	   }
	if(!empty( $this->input->post('contact_person') )){
        $check++;
	$this->db->where('branch.contact_person',$this->input->post('contact_person') );

	}

	if(!empty( $this->input->post('email') )){
     $check++;
	$this->db->where('branch.email',$this->input->post('email') );

	}

	if(!empty( $this->input->post('contact_number') )){
     $check++;
	$this->db->where('branch.contact_number',$this->input->post('contact_number') );

	}

	if(!empty( $this->input->post('country') )){
     $check++;
	$this->db->where('branch.country',$this->input->post('country') );

	}

	if(!empty( $this->input->post('state') )){
     $check++;
	$this->db->where('branch.state',$this->input->post('state') );

	}

	if(!empty( $this->input->post('city') )){
     $check++;
	$this->db->where('branch.city',$this->input->post('city') );

	}

	if(!empty( trim($this->input->post('address')) )){
     $check++;
	$this->db->like('branch.address',trim($this->input->post('address')) );

	}
	
	if(!empty( trim($this->input->post('gst_number')) )){
        $check++;
	    $this->db->where('branch.gstin',trim($this->input->post('gst_number')) );

	}
	
/*
	 if(!empty( $this->input->post('groups') )){
     $check++;
	$name = $this->input->post('groups');   

	for($x = 0; $x <=count($name); $x++){

	$this->db->like('branch.group_name',$name[$x]);    

	}  */  

	

	//} 

	/*if(!empty( $this->input->post('groups') )){
     $check++;
	$this->db->where('branch.group_name',$this->input->post('groups') );
	}*/
    
    if($this->input->post('from_date')<>''){
        $check++;
        $from_date = explode('-',$this->input->post('from_date'));
	    $this->db->where('company.date >= ',$from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
    }
    if($this->input->post('to_date')<>''){
        $check++;
        $to_date = explode('-',$this->input->post('to_date'));
	    $this->db->where('company.date <= ',$to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
    }
    
    if($check!=0)
    {
        
    }
	$this->db->select('branch.*,company.*');
	$this->db->join('branch','branch.company_id = company.company_id','LEFT');
	$this->db->order_by('company.id','DESC');
	$result = $this->db->get('company');
	$result = $result->result();
	return $result;	

	}

	

	public function edit_client(){

	$this->db->select('company.company_id,company.name as client,branch.*'); 

	$this->db->join('company','company.company_id = branch.company_id');

	$this->db->where('branch_id',$this->uri->segment(1));

	$result = $this->db->get('branch');

	return $result->row();

	}

    public function update_client(){
        $this->db->set('name', ucwords(strtolower($this->input->post('name'))));
        $this->db->where('company_id',$this->input->post('company_id'));  
        $this->db->update('company');
        $client = $this->db->affected_rows();
        
        if(!empty($this->input->post('groups'))){
            foreach($this->input->post('groups') AS $key=>$val){
                $groups[$key] = ucwords(strtolower($val));
            }
            $groups = implode(",",$groups);
        }else{ $groups=''; }
        
        $branch_data = array(
            'country'          =>ucwords(strtolower($this->input->post('country'))),
            'state'            =>ucwords(strtolower($this->input->post('state'))),
            'city'             =>ucwords(strtolower($this->input->post('city'))),
            'address'          =>$this->input->post('address'),
            'contact_person'   =>ucwords(strtolower($this->input->post('contact_person'))),
            'contact_number'   =>$this->input->post('contact_number'),
            'email'            =>$this->input->post('email'),
            'group_name'       =>$groups,
            'gstin'		=>$this->security->xss_clean($this->input->post('gstin')),
        );
        $this->db->where('branch_id',$this->uri->segment(1));
        $this->db->update('branch',$branch_data);
        $branch = $this->db->affected_rows();

	if($client >0 || $branch > 0){
            $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
            redirect($_SERVER['HTTP_REFERER']);	    
	}else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error! You have not changed anything!</div>');
            redirect($_SERVER['HTTP_REFERER']);	    
	}

    }

    public function pending_enquiry (){

    $date = date('Y-m-d', strtotime(date('Y-m-d'). ' - 15 days'));  

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');	

	$this->db->join('company','company.company_id = enquiry.company');

	$this->db->join('branch','branch.branch_id = enquiry.branch');    

    $this->db->where('enquiry.date <',$date);

    $this->db->where('enquiry.status','Under Process');

    $this->db->or_where('enquiry.status','automated-enquiry');

    $result = $this->db->get('enquiry');

    return $result->result();

    

    }	
    
    public function emd_filter(){
        $this->db->select('company.name,branch.city,branch.state,branch.country,bid.*,tender.e_tender_id,tender.tender_for,tender.equipment,tender.last_date,tender.est_cost,tender.processing_fee_amt,tender.tender_fee_amt,tender.emd_amount');	
        $this->db->join('tender','tender.id = bid.tender_id');
        $this->db->join('company','company.company_id = tender.company_id','LEFT');
	$this->db->join('branch','branch.branch_id = tender.branch_id','LEFT');
        $this->db->join('bid_followup','bid.id = bid_followup.bid_id','LEFT');
	$check=0;
        
        if($this->input->post('from_date')<>''){
            $check++;
            $from_date = explode('-',$this->input->post('from_date'));
            $this->db->where('bid.emd_fee_date >= ',$from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
        }
		if(!empty( $this->input->post('financial_year') )){
			$check++;
		   $this->db->where('bid.financial_year',$this->input->post('financial_year'));	
	   
		   }
        if($this->input->post('to_date')<>''){
            $check++;
            $to_date = explode('-',$this->input->post('to_date'));
            $this->db->where('bid.emd_fee_date <= ',$to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
        }
        
        if($this->input->post('from_emd_return_date')<>''){
            $check++;
            $from_date = explode('-',$this->input->post('from_emd_return_date'));
            $this->db->where('bid.emd_return_date >= ',$from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
        }
        if($this->input->post('to_emd_return_date')<>''){
            $check++;
            $to_date = explode('-',$this->input->post('to_emd_return_date'));
            $this->db->where('bid.emd_return_date <= ',$to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
        }
        if(!empty( $this->input->post('from_publish_date') )){
            $check++;
            $from_publish_date = explode('-',$this->input->post('from_publish_date'));
            $this->db->where('bid.publish_date >=',$from_publish_date[2].'-'.$from_publish_date[1].'-'.$from_publish_date[0]);            
	    }
        if(!empty( $this->input->post('to_publish_date') )){
            $check++;
            $to_publish_date = explode('-',$this->input->post('to_publish_date'));
            $this->db->where('bid.publish_date <=',$to_publish_date[2].'-'.$to_publish_date[1].'-'.$to_publish_date[0]);            
	    }
	if(!empty( $this->input->post('bid_number') )){
            $check++;
            $this->db->where('bid.bid_number',$this->input->post('bid_number'));
	}
        if(!empty( $this->input->post('tender_number') )){
            $check++;
            $this->db->where('tender.e_tender_id ',$this->input->post('tender_number'));
	}
	if(!empty( $this->input->post('company_id') )){
            $check++;
            $this->db->where('tender.company_id',$this->input->post('company_id'));
	}
        if(!empty( $this->input->post('country') )){
            $check++;
            $this->db->where('branch.country',$this->input->post('country') );
	}
        if(!empty( $this->input->post('state') )){
            $check++;
            $this->db->where('branch.state',$this->input->post('state') );
	}
	if(!empty( $this->input->post('city') )){
            $check++;
            $this->db->where('branch.city',$this->input->post('city') );
	}
        
	if(!empty( $this->input->post('deal_by') )){
            $check++;
            $this->db->where('tender.added_by',$this->input->post('deal_by'));
	}
	if(!empty( $this->input->post('emd_type') )){
            $check++;
            $this->db->where('bid.emd_fee',$this->input->post('emd_type'));	
	}
	if(!empty( $this->input->post('emd_amount') )){
            $check++;
            $this->db->where('tender.emd_amount ',$this->input->post('emd_amount'));
	}
	if(!empty( $this->input->post('emd_type_num') )){
            $check++;
            $this->db->where('bid.emd_fee_no',$this->input->post('emd_type_num'));
	}
	if(!empty( $this->input->post('emd_status') )){
            $check++;
            $this->db->where('bid.emd_status',$this->input->post('emd_status'));
	}
	if(!empty( $this->input->post('bid_status') )){
            $check++;
            $this->db->where('bid_followup.followup_status',$this->input->post('bid_status'));
	}
        
	if($check!=0)
        {
           		
        }
		$this->db->group_by('bid.id');
		//$this->db->order_by('id','ASC');
		$this->db->order_by('bid.bid_number','ASC');
		$this->db->where('bid.is_deleted','0');
		$result = $this->db->get('bid');
		//echo $this->db->last_query();exit;
		return $result->result();
    }
    
    public function performance_security_filter(){
        $this->db->select('order_acknowledgement.*,company.name,branch.city');	
        $this->db->join('company','company.company_id = order_acknowledgement.organization','LEFT');
	$this->db->join('branch','branch.branch_id = order_acknowledgement.branch','LEFT');
        $check=0;
        
        if($this->input->post('from')<>''){
            $check++;
            $from_date = explode('-',$this->input->post('from'));
            $this->db->where('order_acknowledgement.security_duration >= ',$from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
        }
		if(!empty( $this->input->post('financial_year') )){
			$check++;
		   $this->db->where('order_acknowledgement.financial_year',$this->input->post('financial_year'));	
	   
		   }
        if($this->input->post('to')<>''){
            $check++;
            $to_date = explode('-',$this->input->post('to'));
            $this->db->where('order_acknowledgement.security_duration <= ',$to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
        }
        
        if($this->input->post('till_date')<>''){
            $check++;
            $to_date = explode('-',$this->input->post('to_date'));
            $this->db->where('order_acknowledgement.security_duration <= ',$to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
        }
        if($this->input->post('amount_operator')<>'' && $this->input->post('security_amount')<>''){
            $check++;
            $arr = ['lessthan'=>'<=','greaterthan'=>'>=','equalto'=>'='];
            $this->db->where('order_acknowledgement.security_amount '.$arr[$this->input->post('amount_operator')], (int)$this->input->post('security_amount'));
        }
        if(!empty( $this->input->post('mode_security_submission') )){
            $check++;
            $this->db->where('order_acknowledgement.mode_security_submission = ',$this->input->post('mode_security_submission'));
	}
        if(!empty( $this->input->post('bank_name') )){
            $check++;
            $this->db->where('order_acknowledgement.security_bank_name =',$this->input->post('bank_name')); 
	}
	if(!empty( $this->input->post('bank_reference_no') )){
            $check++;
            $this->db->where('order_acknowledgement.bank_reference_no',$this->input->post('bank_reference_no'));
	}
        
	if($check!=0)
        {
          		
        }
		$this->db->order_by('order_acknowledgement.id','ASC');
		$this->db->where('order_acknowledgement.is_deleted','0');
		$result = $this->db->get('order_acknowledgement');
		//echo $this->db->last_query();exit;
		return $result->result();
    }
    
    
}

?>