<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Followup extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        check_delete();
        $allowed_users = ['1','2','5'];
        if(!in_array($this->session->userdata('type'),$allowed_users)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
		$this->load->model(['admin/followup_model','common_model']);
    }		
	
	public function detail()
	{
		
        if($this->input->post('submit') == 'Submit'){
		    $result = $this->followup_model->new_followup();
		
    		if($result){
    		        $this->load->helper('whatsapp_email_messages');
                    query_status_update(['enquiry_id'=>$this->uri->segment(1)]);
                    $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');	
                    redirect($_SERVER['HTTP_REFERER']);			
    		}else{
                    $this->session->set_flashdata('message','Error!');	
                    redirect($_SERVER['HTTP_REFERER']);			
    		}
        } 
		log_user_activity('Query Board Status',$this->session->userdata('id'), 'Status: Edit');
		$data['followup'] = $this->followup_model->followup_detail();
		$data['followups'] = $this->followup_model->all_followup();
		$where = 'arrivals.enquiry_id = '.$data['followup']->id;
		$data['arrivals'] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where, '', $count = true);
		$data['content'] = 'admin/followup';
		$this->load->view('admin/layout',$data);
	}	
	
	public function quotation(){
	
            if($this->input->post('submit') == 'Submit'){
                    $result = $this->followup_model->new_quotation_followup();
		
		if($result){
                    $this->session->set_flashdata('message','Added Successfully!');	
                    redirect($_SERVER['HTTP_REFERER']);			
		}else{
                    $this->session->set_flashdata('message','Error!');	
                    redirect($_SERVER['HTTP_REFERER']);			
		}
            }	
	$data['followups'] = $this->followup_model->quotation_followups();
	$data['detail'] = $this->followup_model->quotation_detail();	
	$this->load->view('admin/quotation_followup',$data);		
		
	}
	
	public function tender_followup(){
		
		if($this->input->post('submit') == 'Submit'){
		$result = $this->followup_model->new_tender_followup();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		} 

		$data['detail'] = $this->followup_model->tender_detail();
		$data['followups'] = $this->followup_model->tender_followups();
		$this->load->view('admin/tender_followup',$data);		
		
	}
	
	public function bid_followup(){
		
		if($this->input->post('submit') == 'Submit'){
		$result = $this->followup_model->new_bid_followup();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		} 

		$data['detail'] = $this->followup_model->bid_detail();
		$data['followups'] = $this->followup_model->bid_followups();
		$this->load->view('admin/bid_followup',$data);		
		
	}			
	function update_bid_followup(){
            $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
            $this->form_validation->set_rules('id', 'Update', 'trim|required|integer');
            if($this->form_validation->run() == FALSE){
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                echo json_encode(['err_msg'=> validation_errors()]);
            }else{
                $update_data = ['table_name'=>'bid_followup',
                                'update_data'=>['remarks'=>$this->input->post('remarks')],
                                'condition'=>['id'=> $this->input->post('id')]];
                $id = $this->common_model->update_data($update_data);
                if($id>0){
                    echo json_encode(['err_msg'=> '']);
                }
            }
        }
	
public function download_latest_followups()
{
    $this->load->model('followup_model');

    // DEBUG: URL se kya aa raha hai dekhne ke liye ye line uncomment karo
    // echo '<pre>'; print_r($this->input->get()); die;

    $filters = [
        'booking_type'    => $this->input->get('booking_type'),
        'staff_id'        => $this->input->get('staff_id'),
        'from'            => $this->input->get('from'),
        'to'              => $this->input->get('to'),
        'city'            => $this->input->get('city'),
        'checkin_from'    => $this->input->get('checkin_from'),
        'checkout_to'     => $this->input->get('checkout_to'),
        'company_id'      => $this->input->get('company_id'),
        'company'         => urldecode((string) $this->input->get('company')),
        'guests_number'   => $this->input->get('guests_number'),
        'email_exchange'  => $this->input->get('email_exchange'),
        'query_number'    => $this->input->get('query_number'),
        'followup_status' => $this->input->get('followup_status'),
    ];
    // echo '<pre>'; print_r($filters); die;

    $rows = $this->followup_model->get_latest_sales_ops_followups($filters);
    // echo'<pre>';print_r($rows);die;
    if (empty($rows)) {
        show_error('No followup data found.');
        return;
    }

    $h = function ($v) {
        return ($v === null || trim($v) === '') ? '-' : htmlspecialchars($v);
    };
    $fmt_dt = function ($d) {
        return (!empty($d) && strpos($d, '0000-00-00') !== 0) ? date('d-m-Y h:i A', strtotime($d)) : '-';
    };

    $filename = 'Latest_Followups_' . date('Y-m-d') . '.xls';

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "\xEF\xBB\xBF";

    echo '<table border="1">';
    echo '<tr>
            <th>Sr.No</th>
            <th>Enquiry No.</th>
            <th>Sales Remark</th>
            <th>Sales Entry Date</th>
            <th>Ops Remark</th>
            <th>Ops Entry Date</th>
          </tr>';

    $i = 1;
    foreach ($rows as $r) {
        echo '<tr>';
        echo '<td>' . $i++ . '</td>';
        echo '<td>' . $h($r->enquiry_no) . '</td>';
        echo '<td>' . $h($r->sales_remark) . '</td>';
        echo '<td>' . $fmt_dt($r->sales_date) . '</td>';
        echo '<td>' . $h($r->ops_remark) . '</td>';
        echo '<td>' . $fmt_dt($r->ops_date) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    exit;
}
	public function update_agent_status()
{
    $id = $this->input->post('id');
    $status = $this->input->post('agent_status');

    $this->db->where('id', $id);
    $this->db->update('followups', ['email_status' => $status]);

    if($this->db->affected_rows() > 0){
        echo json_encode(['success' => true, 'message' => 'Status Updated Successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update Failed!']);
    }
}
}
