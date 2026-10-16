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
 
 	$this->db->select('company.name,branch.city,invoice.*');	
	$this->db->join('company','company.company_id = invoice.organization');	
	$this->db->join('branch','branch.branch_id = invoice.branch');
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
	'igst'				    =>$this->security->xss_clean($this->input->post('igst')),
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
    
	public function update_invoice(){

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
	
	}    
    
    
	
}
?>