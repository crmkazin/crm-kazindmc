<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Followup_model extends CI_Model{	

public function followup_detail(){	

	$this->db->select('company.name,company_details.*,enquiry.*');
	$this->db->join('company_details','enquiry.company_details_id = company_details.company_id','LEFT');
        $this->db->join('company','company.company_id = company_details.company','LEFT');
	$this->db->where('enquiry.id',$this->uri->segment(1));
	$this->db->order_by('enquiry.id','DESC');
	$result = $this->db->get('enquiry');
	return $result->row();

    }
	

	public function new_followup(){

        // Get and sanitize email_exchange
        $email_exchange = $this->security->xss_clean(
            $this->input->post('email_exchange')
        );
        $followup_mode = $this->security->xss_clean($this->input->post('followup_mode'));
        $followup_status = $this->security->xss_clean($this->input->post('followup_status'));
        $followup_remarks = $this->security->xss_clean($this->input->post('followup_remarks'));
        if ($followup_status == 'not-materialized') {
            $followup_remarks = $this->security->xss_clean($this->input->post('dropped_reason'));
        } else {
            $followup_remarks = ucwords(strtolower($followup_remarks));
        }
        $data = array(
            'enquiry_id'        => $this->uri->segment(1),
            'followup_status'   => $followup_status,
            'followup_date'     => $this->security->xss_clean($this->input->post('followup_date')),
            'followup_remarks'  => $followup_remarks,
            'sales_remarks'     => $this->security->xss_clean($this->input->post('sales_remarks')),
            'email_exchange'    => $email_exchange,
            'followup_mode'     => $followup_mode,
            'date'              => date('Y-m-d'),
            'created_by'        => $this->session->userdata('id')
        );
    
        $result = $this->db->insert('followups', $data);
        $update = array('status' => $followup_status);
        $this->db->where('id', $this->uri->segment(1));
        $this->db->update('enquiry', $update);
        if ($result) {
            log_user_activity(
                'Query Board Status Update',
                $this->session->userdata('id'),
                'Status: Update ' . json_encode($data)
            );
            return true;
        } else {
            return false;
        }
    }

	

public function all_followup()
{
    $this->db->select('
        followups.*,
        admin.name AS created_by_name,
        admin.email AS created_by_email,
        admin.type AS created_by_type
    ');

    $this->db->from('followups');

    $this->db->join(
        'admin',
        'admin.id = followups.created_by',
        'left'
    );

    $this->db->where(
        'followups.enquiry_id',
        $this->uri->segment(1)
    );

    $this->db->order_by('followups.id', 'DESC');

    $result = $this->db->get();

    if ($result === false) {
        echo '<pre>';
        print_r($this->db->error());
        echo '</pre>';
        exit;
    }

    return $result->result();
}

	

	public function quotation_detail(){

	

	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.*');	

	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');

	$this->db->join('company','company.company_id = enquiry.company','LEFT');

	$this->db->join('branch','branch.branch_id = enquiry.branch','LEFT');

	$this->db->where('quotation.id',$this->uri->segment(1));

	$result = $this->db->get('quotation');

	return $result->row(); 

	

	}

	

	public function new_quotation_followup(){		

	$data = array(

	'quotation_id' =>$this->uri->segment(1),

	'close_status' =>$this->security->xss_clean($this->input->post('close_status')),

	'status'	   =>$this->security->xss_clean($this->input->post('followup_status')),

	'remarks'	   =>$this->security->xss_clean(ucwords(strtolower($this->input->post('followup_remarks')))),

	'date'         =>date('Y-m-d h:i:s')

	);	

	

	$result = $this->db->insert('quotation_followup',$data);	

	

    $update = array(
	'quotation_status'=>$this->security->xss_clean($this->input->post('followup_status')),
	'remark'=>$this->security->xss_clean(ucwords(strtolower($this->input->post('followup_remarks'))))
    );
	$this->db->where('id',$this->uri->segment(1));
	$this->db->update('quotation',$update);	

	if($this->input->post('close_status') == 'Award To Us'){

	

	$project = array(

	'quotation_id' =>$this->uri->segment(1),

	'remarks'	   =>$this->security->xss_clean(ucwords(strtolower($this->input->post('followup_remarks')))),

	'status'	   =>1,

	'date'         =>date('Y-m-d h:i:s')

	);

	$result = $this->db->insert('project_awarded',$project);	

	}else{

	

	$this->db->set('status',0);

	$this->db->where('quotation_id',$this->uri->segment(1));	

	$this->db->update('project_awarded');	

	}

	

	if($result){

	return true;

	}else{

		return false;

	}

	

	}

	

	public function quotation_followups(){

		

	$this->db->where('quotation_id',$this->uri->segment(1));

	$result = $this->db->get('quotation_followup');

	return $result->result();

	

	}

	

	public function tender_detail(){

	

	$this->db->select('company.name,company.company_id,branch.city,branch.branch_id,tender.*');	

	$this->db->join('company','company.company_id = tender.company_id');

	$this->db->join('branch','branch.branch_id = tender.branch_id');

	$this->db->where('tender.id',$this->uri->segment(1));

	$this->db->where('tender.is_deleted',0);

	$result = $this->db->get('tender');

	return $result->row();

	

	}	

	

	public function new_tender_followup(){

		

	$data = array(

	'tender_id'    	  =>$this->uri->segment(1),

	'followup_status' =>$this->security->xss_clean($this->input->post('status')),

	'followup_date'	  =>$this->security->xss_clean($this->input->post('followup_date')),

	'remarks'	   	  =>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks')))),

	'date'            =>date('Y-m-d h:i:s')

	);	

	

	$result = $this->db->insert('tender_followup',$data);	

	

	$update = array(

	/*'status'	=>$this->security->xss_clean($this->input->post('status')),*/

	'remarks'	=>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks'))))

	);

	$this->db->where('id',$this->uri->segment(1));

	$this->db->update('tender',$update);	

	

	if($this->security->xss_clean($this->input->post('status')) == 1){

	

	$bid_data = array(

	'tender_id'			=>$this->uri->segment(1),

	'bid_number	'		=>$this->security->xss_clean($this->input->post('bid_no')),

	'status'			=>'',

	'company_id'		=>$this->security->xss_clean($this->input->post('company')),

	'branch_id'			=>$this->security->xss_clean($this->input->post('branch')),

	'remarks'           =>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks')))),

	'date'              =>date('Y-m-d')

	);

	$bid_insert = $this->db->insert('bid',$bid_data);

	}

	

	if($result){

	return true;

	}else{

		return false;

	}

	

	}

	

	public function tender_followups(){

		

	$this->db->where('tender_id',$this->uri->segment(1));

	$this->db->where('is_deleted',0);

	$this->db->order_by('id','DESC');	

	$result = $this->db->get('tender_followup');

	$result = $result->result();

	return $result;

	}	



	public function bid_detail(){
            $this->db->select('tender.equipment,tender.tender_for,tender.e_tender_id,tender.remarks,company.name,branch.city,bid.*');	
            $this->db->join('tender','tender.id = bid.tender_id');
            $this->db->join('company','company.company_id = tender.company_id');
            $this->db->join('branch','branch.branch_id = tender.branch_id');
            $this->db->where('bid.id',$this->uri->segment(1));
            $this->db->where('bid.is_deleted',0);
            $result = $this->db->get('bid');
            return $result->row();
        }

	

	public function new_bid_followup(){

		

	$data = array(

	'bid_id'    	  =>$this->uri->segment(1),

	'followup_status' =>$this->security->xss_clean($this->input->post('status')),

	'awarded_company' =>$this->security->xss_clean($this->input->post('awarded_company')),

	'remarks'	   	  =>$this->security->xss_clean(ucwords(strtolower($this->input->post('remarks')))),

	'date'            =>date('Y-m-d h:i:s')

	);	

	

	$result = $this->db->insert('bid_followup',$data);	

	

	$this->db->set('status',$this->security->xss_clean($this->input->post('status')));

	$this->db->where('id',$this->uri->segment(1));

	$this->db->update('bid');
	
	if($this->input->post('status') == 'Awarded to Us'){
            $project = array('bid_id' =>$this->uri->segment(1),
                            'remarks' =>$this->security->xss_clean(ucwords(strtolower($this->input->post('followup_remarks')))),
                            'status'  =>1);
            $result = $this->db->insert('project_awarded',$project);
	}/*else{
                $this->db->set('status',0);
                $this->db->where('quotation_id',$this->uri->segment(1));	
                $this->db->update('project_awarded');	
            }
	*/
	if($result){
            return true;
	}else{
            return false;
	}
    }

    public function bid_followups(){
        $this->db->where('bid_id',$this->uri->segment(1));
        $this->db->where('is_deleted',0);
        $this->db->order_by('id','DESC');
        $result = $this->db->get('bid_followup');
        $result = $result->result();
        return $result;
    }		

	public function multiple_enquiry($id){



	$this->db->where('enquiry_id',$id);

	$result = $this->db->get('multiple_enquiry');

	$result = $result->result();

	return $result;

	    

	}

	

public function get_latest_sales_ops_followups($f)
{
    $this->db->select('
        e.enquiry_no,
        fs.followup_remarks AS sales_remark,
        fs.date             AS sales_date,
        fo.followup_remarks AS ops_remark,
        fo.date             AS ops_date
    ', false);

    $this->db->from('enquiry e');

    // Latest SALES followup (created_by -> admin.id, admin.type = 5)
    $this->db->join(
        'followups fs',
        'fs.id = (SELECT MAX(x.id) FROM followups x
                  JOIN admin a ON a.id = x.created_by
                  WHERE x.enquiry_id = e.id AND a.type = 5)',
        'left',
        false
    );

    // Latest OPS followup (created_by -> admin.id, admin.type = 2)
    $this->db->join(
        'followups fo',
        'fo.id = (SELECT MAX(y.id) FROM followups y
                  JOIN admin b ON b.id = y.created_by
                  WHERE y.enquiry_id = e.id AND b.type = 2)',
        'left',
        false
    );

    $this->db->where('e.is_deleted', 0);

    // Booking Type -> enquiry_abbr
    if (!empty($f['booking_type']) && $f['booking_type'] != 'all') {
        $this->db->where('e.enquiry_abbr', $f['booking_type']);
    }

    // Staff -> enquiry.file_handle_by
    if (!empty($f['staff_id']) && $f['staff_id'] != 'all') {
        $this->db->where('e.file_handle_by', (int) $f['staff_id']);
    }

    // Query Date -> enquiry.query_received_date
    if (!empty($f['from'])) {
        $this->db->where('e.query_received_date >=', $f['from']);
    }
    if (!empty($f['to'])) {
        $this->db->where('e.query_received_date <=', $f['to']);
    }

    // City -> quotations.city_of_arrival
    if (!empty($f['city'])) {
        $city = $this->db->escape_like_str(trim($f['city']));
        $this->db->where(
            "EXISTS (SELECT 1 FROM quotations q
                     WHERE q.enquiry_id = e.id
                     AND q.city_of_arrival LIKE '%{$city}%')",
            null,
            false
        );
    }

    // Arrival date -> enquiry.check_in_date / check_out_date
    if (!empty($f['checkin_from'])) {
        $this->db->where('e.check_in_date >=', $f['checkin_from']);
    }
    if (!empty($f['checkout_to'])) {
        $this->db->where('e.check_out_date <=', $f['checkout_to']);
    }

    // Company -> enquiry.company_id = company.company_id
    if (!empty($f['company_id']) && !empty($f['company'])) {
        $this->db->where('e.company_id', $f['company_id']);
    } elseif (!empty($f['company'])) {
        $name = $this->db->escape_like_str(trim($f['company']));
        $this->db->where(
            "EXISTS (SELECT 1 FROM company c
                     WHERE c.company_id = e.company_id
                     AND c.name LIKE '%{$name}%')",
            null,
            false
        );
    }

    // Number of guests -> enquiry.number_persons
    if (!empty($f['guests_number'])) {
        $parts = explode('-', $f['guests_number']);
        $min   = (int) $parts[0];
        $max   = isset($parts[1]) ? $parts[1] : '';

        $this->db->where('CAST(e.number_persons AS UNSIGNED) >= ' . $min, null, false);
        if ($max !== 'above' && $max !== '') {
            $this->db->where('CAST(e.number_persons AS UNSIGNED) <= ' . (int) $max, null, false);
        }
    }

    // Email Exchange -> enquiry ki total followups ka count
    if (!empty($f['email_exchange'])) {
        $count_sql = '(SELECT COUNT(*) FROM followups fc WHERE fc.enquiry_id = e.id)';

        if ($f['email_exchange'] == 'hot') {
            $this->db->where($count_sql . ' BETWEEN 3 AND 6', null, false);
        } elseif ($f['email_exchange'] == 'superhot') {
            $this->db->where($count_sql . ' >= 7', null, false);
        }
    }

    // Query Number -> enquiry.enquiry_no
    if (!empty($f['query_number'])) {
        $this->db->like('e.enquiry_no', trim($f['query_number']));
    }

    // Status -> enquiry.status
    if (!empty($f['followup_status'])) {
        $this->db->where('e.status', $f['followup_status']);
    }

    $this->db->order_by('e.id', 'DESC');

    return $this->db->get()->result();
}
	
	

}

?>