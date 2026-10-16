<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model{	
	
	public function invoice_list(){
		
	$this->db->select('admin.name as admin,company.name,branch.city,invoice.*');	
	$this->db->join('company','company.company_id = invoice.organization');	
	$this->db->join('branch','branch.branch_id = invoice.branch');
	$this->db->join('admin','admin.id = invoice.added_by');
	$this->db->where('invoice.is_deleted',0);
	$result = $this->db->get('invoice');
	return $result->result();	
		
	}

    public function get_invoice(){
 
 	$this->db->select('company.name,branch.city,branch.state,branch.address,branch.contact_person,branch.contact_number,branch.email,invoice.*,order_acknowledgement.client_order_no');	
	$this->db->join('company','company.company_id = invoice.organization');	
	$this->db->join('branch','branch.branch_id = invoice.branch');
	$this->db->join('order_acknowledgement','order_acknowledgement.id = invoice.order_id');
	$this->db->where('invoice.is_deleted',0);
	$this->db->where('invoice.id',$this->uri->segment(1));
	$result = $this->db->get('invoice');
	if(!empty($result->row())){
	return $result->row();    
	}else{
	$this->session->set_flashdata('message','Error!');	
	redirect($_SERVER['HTTP_REFERER']);	    
	}
	
        
    }
    
	public function add_invoice(){
	
	$data = array(
	'invoice_no'            =>$this->security->xss_clean($this->input->post('invoice_no')),
	'date'				    =>date('Y-m-d', strtotime( $this->input->post('date') )),
	'oa_no'			        =>$this->security->xss_clean($this->input->post('oa_no')),
	'organization'          =>$this->security->xss_clean($this->input->post('company_id')),
	'branch'                =>$this->security->xss_clean($this->input->post('branch')),	
	'equipment'             =>implode(",",$this->security->xss_clean($this->input->post('enquiry_for'))),	
	'purchase_order_detail'	=>$this->security->xss_clean($this->input->post('purchase_order_detail')),
	'subtotal'		        =>$this->input->post('sub_total'),
	'igst'				    =>18,
	'igst_tax'				    =>$this->security->xss_clean($this->input->post('igst_tax')),
	'amount'		        =>$this->security->xss_clean($this->input->post('amount')),
	'received_amount'	    =>$this->security->xss_clean($this->input->post('received_amount')),
	'received_amount_date'	=>$this->security->xss_clean($this->input->post('received_amount_date')),
	'tds_deduction'			=>$this->security->xss_clean($this->input->post('tds_deduction')),	
	'company_gst'			=>$this->security->xss_clean($this->input->post('company_gst')),	
	'customer_gst'			=>$this->security->xss_clean($this->input->post('customer_gst')),	
	'remarks'				=>$this->security->xss_clean($this->input->post('remarks')),
	'added_by'              =>$this->session->userdata('id'),
	);
	$invoice = $this->db->insert('invoice',$data);
	if($invoice){
	return true;	
	}else{
	return false;	
	}
	
	}    
 
 
   public function delete_invoice(){
    $this->db->set('is_deleted',1);
    $this->db->where('id',$this->uri->segment(1));
    $this->db->update('invoice');
    if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('message','Deleted Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);        
    }else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);        
    }
   } 
    
	/* public function update_invoice(){

	$data = array(
	'invoice_no'            =>$this->security->xss_clean($this->input->post('invoice_no')),
	'date'				    =>date('Y-m-d', strtotime( $this->input->post('date') )),
	'oa_no'			        =>$this->security->xss_clean($this->input->post('oa_no')),
	'organization'          =>$this->security->xss_clean($this->input->post('company_id')),
	'branch'                =>$this->security->xss_clean($this->input->post('branch')),	
	'equipment'             =>implode(",",$this->security->xss_clean($this->input->post('enquiry_for'))),	
	'purchase_order_detail'	=>$this->security->xss_clean($this->input->post('purchase_order_detail')),
	'subtotal'		        =>$this->input->post('sub_total'),
	'igst'				    =>$this->security->xss_clean($this->input->post('igst')),
	'amount'		        =>$this->security->xss_clean($this->input->post('amount')),
	'received_amount'	    =>$this->security->xss_clean($this->input->post('received_amount')),
	'received_amount_date'	=>$this->security->xss_clean($this->input->post('received_amount_date')),
	'tds_deduction'			=>$this->security->xss_clean($this->input->post('tds_deduction')),	
	'company_gst'			=>$this->security->xss_clean($this->input->post('company_gst')),	
	'customer_gst'			=>$this->security->xss_clean($this->input->post('customer_gst')),	
	'remarks'				=>$this->security->xss_clean($this->input->post('remarks'))
	);
	$this->db->where('id',$this->uri->segment(1));
	$this->db->update('invoice',$data);
	
	if($this->db->affected_rows() > 0){
	return true;	
	}else{
	return false;	
	}
	
	} */   
    
    public function update_invoice(){
	    $update_data = array(
            'invoice_no'            =>$this->security->xss_clean($this->input->post('invoice_no')),
            'date'                  =>date('Y-m-d', strtotime( $this->input->post('invoice_date') )),
            //'oa_no'                 =>$data['invoice']->order_no,
            //'organization'          =>$data['invoice']->company_id,
            'branch'                =>$this->input->post('branch_name'),//$data['invoice']->branch_id,	
            //'equipment'             =>implode(',',($this->security->xss_clean($this->input->post('product_name[]')))),	
            'equipment'             =>implode('_~$~_',($this->security->xss_clean($this->input->post('product_name[]')))),	//11 April 2023
            'purchase_order_detail' =>'',
            'subtotal'              =>$this->security->xss_clean($this->input->post('total')),
            'igst_tax'                  =>$this->security->xss_clean($this->input->post('rdo_tax')),
            'igst'              => $this->input->post('tax_percentage'),//($this->input->post('rdo_tax')=='cgst_sgst' || $this->input->post('rdo_tax')=='igst')?'18':'5',
            'received_amount'	    =>$this->security->xss_clean($this->input->post('advanced_received')),
            'received_amount_date'  =>'',
            'tds_deduction'         =>'',	
            'company_gst'           =>$this->security->xss_clean($this->input->post('gst_number')),	
            'customer_gst'          =>$this->security->xss_clean($this->input->post('consignee_gstin['.$this->input->post('branch_name').']')),	
            //'remarks'             =>$this->security->xss_clean($this->input->post('remarks')),
            'added_by'              =>$this->session->userdata('id'),
            'is_deleted'            =>0,
            //'order_id'              => $data['invoice']->id,
            'hsn_sac'               => implode(',',$this->input->post('hsn_sac[]')),
            'unit'                  => implode(',',$this->input->post('unit[]')),
            'rate'                  => implode(',',$this->input->post('rate[]')),
            'quantity'              => implode(',',$this->input->post('quantity[]')),
            'amount'                => implode(',',$this->input->post('amount[]')),
            'packing'               => $this->input->post('packing'),
            'installation_mobilization'=> $this->input->post('installation'),
            'fright_transport'      => $this->input->post('fright'),
            'eway_bill_no'          => $this->input->post('eway_bill_no'),
            'reverse_charge'        => $this->input->post('reverse_charge'),
            'place_of_supply'        => $this->input->post('place_of_supply'),
            'amount_payable'        => $this->input->post('total_amount'),
            //'financial_year'    => $financial_year->year,
            //'invoice_name' => $invoice_number.'.pdf'
        );
        $this->db->where('id',$this->uri->segment(1));
        $this->db->limit('1');
    	$this->db->update('invoice',$update_data);
            //echo $this->db->last_query();exit;
    	if($this->db->affected_rows() > 0){
    	    $this->db->query('UPDATE invoice SET previously_edited = previously_edited+1 WHERE id='.$this->uri->segment(1).' LIMIT 1');
                return true;	
    	}else{
                return false;	
    	}
    }
    
    
	
}
?>