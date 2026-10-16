<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		$this->load->model(['admin/quotation_model','common_model']);
	}		
	
	public function index()
	{

		$data['quotations'] = $this->quotation_model->all_quotations();

		$this->load->view('admin/quotations',$data);
	}	
	
	public function sent_quotations(){
            $data['quotations'] = $this->quotation_model->sent_quotations();
            $this->load->view('admin/sent_quotations',$data);	    
	}
	
	public function awarded_project(){
		
	$data['projects'] = $this->quotation_model->all_awarded_project();
	$this->load->view('admin/awarded_project',$data);		
	}
        
    public function awarded_project_bids()
    {	
            
            $join = [['type'=>'','join_table'=>'bid b','condition'=>'b.id = pa.bid_id'],
                    ['type'=>'','join_table'=>'tender t','condition'=>'b.tender_id = t.id']];
            $where = 'pa.status=1 AND pa.oa_status="pending" '; $orderby = ' ORDER BY pa.id DESC';
            $select = '*, pa.id AS awarded_id';
            $data['bids'] = $this->common_model->get_data('project_awarded pa','', '', $select,$where, $orderby, $count = false,$join);
            $this->load->view('admin/awarded_project_bids',$data);		
	}
        
	
	public function order_creation(){
		
            if($this->input->post('submit') == 'Submit'){
                $result = $this->quotation_model->new_order_creation();
                if($result){
                    $this->session->set_flashdata('message','Added Successfully!');	
                    //redirect($_SERVER['HTTP_REFERER']);			
                    redirect('order-acknowledgement');
                }else{
                    $this->session->set_flashdata('message','Error!');	
                    redirect($_SERVER['HTTP_REFERER']);			
                }
            }
            
            $select = '*';
            $where = ' status = "1"';
            $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
            
           $where = 'order_acknowledgement.financial_year="'.$financial_year->year.'"';
            $result = $this->common_model->get_data('order_acknowledgement','', '', 'MAX(order_no) AS oa_id',$where, '', $count = false);
            if(empty($result[0])){
                $result[0]->oa_id = '001';
            }else{
                $result[0]->oa_id = substr($result[0]->oa_id, 4);
                $result[0]->oa_id = $result[0]->oa_id+1;
            }
            if(strlen($result[0]->oa_id)<3){
                $prefix = ['1'=>'00','2'=>'0'];
                $result[0]->oa_id = $prefix[strlen($result[0]->oa_id)].$result[0]->oa_id;	
            }
            $financialyear = str_replace('-', '', $financial_year->year);
            $data['orderAcknowlegdement_id'] = $financialyear.$result[0]->oa_id;
            $data['financialyear'] = $financial_year->year;
            $res = $this->common_model->get_data('project_awarded','', '', 'quotation_id,bid_id','id='.$this->uri->segment(1), '', $count = false);
            //echo '<pre>';            print_r($res);die;
            if($res[0]->quotation_id==0){
                $join = [['type'=>'','join_table'=>'tender t','condition'=>'b.tender_id = t.id'],
                        ['type'=>'','join_table'=>'company c','condition'=>'c.company_id = t.company_id']];
                $where = 'b.*,c.company_id,t.*';
                $data['detail'] = $this->common_model->get_data('bid b','', '', $where,'b.id='.$res[0]->bid_id, '', $count = false,$join)[0];

                $data['bid_id'] = $res[0]->bid_id;
            }else{
                $data['detail'] = $this->quotation_model->order_detail();
                $data['bid_id'] = 0;
            }
            /*print_r($data['detail']);
            die;*/
            $this->load->view('admin/order_creation',$data);
	}
	
	public function order_acknowledgement(){	
            $data['details'] = $this->quotation_model->order_acknowledgement();
            $this->load->view('admin/order_acknowledgement',$data);
	}
	
	public function invoice(){
       
    $this->load->model('admin/tender_model');
    $this->load->model('admin/enquiry_model');
    $data['products'] = $this->enquiry_model->products();
	$data['detail'] = $this->quotation_model->invoice();
    
    $data['branches'] = $this->tender_model->company_branch($data['detail']->organization);
	$this->load->view('admin/invoice',$data);	
	}
	
	public function print_quotation(){
	    
            $data['detail'] = $this->quotation_model->print_quotation();
            
            //$quotenum = $data['detail']->quotation_number;
            
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
            $rf = 'RF';
            $quotation_no = 'IT/QT/'.$rf.'/'.$financial_year->year.'/'.$no;
            if( $data['detail']->mode == "Indiamart" ){
                $quotation_no = "IT/QT/IM/".$financial_year->year."/".$no;    
            }
            $data['detail']->quotation_number = $quotation_no;
            $data['detail']->financial_year_quotation_no = $financial_year_quotation_no;
            $data['detail']->financial_year = $financial_year->year;
            
            $quotenum = $data['detail']->quotation_number;
            
            $data['multiple_enquiry'] = $this->quotation_model->get_multiple_enquiry($data['detail']->enquiry_id);
           
            if($this->input->post('submit') == 'Submit'){
                $this->quotation_model->final_quotation($quotenum);
            }

            $this->load->view('admin/print_quotation',$data);    
	}
	
	public function mail_data(){
            $data['detail'] = $this->quotation_model->mail_data();
            $data['file_name'] = uniqid().'.pdf';
            $this->load->view('admin/mail',$data);  
            $id = $this->uri->segment(1);
            $result2 = $this->quotation_model->update_pdf($data['file_name'],$id); 
            
            $mail_body = $this->load->view('admin/email_templates/quotation_email','',TRUE);
            $this->load->library('email');
            $config = array('charset'=>'utf-8','wordwrap'=> TRUE,'mailtype' => 'html');
            $this->email->initialize($config);
            $this->email->from('sales@intellitest.co.in', 'Intellitest Solutions India');
            $this->email->to($data['detail'][0]->email_to);
            $this->email->cc($data['detail'][0]->email_cc);
            //$this->email->bcc('sumeet@thavertech.com');
			$this->email->bcc(array('sumeet@thavertech.com','pankaj@thavertech.com'));
            $this->email->subject($data['detail'][0]->email_subject);
            $this->email->attach(FCPATH.'assets/sent_quotations/'.$data['file_name']);
            $this->email->message($mail_body);	
            $this->email->send();
            
            redirect('sent-quotations');
	}
	
	public function handle_pdf(){
    
    $data = $_POST['pdf_data'];
    $id = $_POST['id'];
    $b64 = $data;
    
    # Decode the Base64 string, making sure that it contains only valid characters
    $bin = base64_decode($b64, true);

    if (strpos($bin, '%PDF') !== 0) {
      throw new Exception('Missing the PDF file signature');exit;
    }
    $file_name = uniqid().'.pdf';

    $result = file_put_contents('/home/universal/public_html/crm/assets/sent_quotations/'.$file_name, $bin);
    
    if($result){
    $result2 = $this->quotation_model->update_pdf($file_name,$id);     
    
    }else{
    echo json_encode(array("statusCode"=>201));    
    }
    
    if($result2){

    $email = $this->quotation_model->get_pdf_mail($id);
    
	    $this->load->library('email');
            $this->email->from('sales@intellitest.co.in', 'Intellitest');
            $this->email->to($email->email_to);
            $this->email->cc($email->email_cc);
            $this->email->subject($email->email_subject);
            $this->email->attach('/home/universal/public_html/crm/assets/sent_quotations/'.$file_name);
            $msg = "Dear Sir/Madam,<br> Please find the attachment ";
            $msg .= "<br><br><br>Regards";
            $msg .= "<br>Intellitest Solution Pvt Ltd";
            $msg .= "<br>Note - Please do not reply on this email";
            $msg .= "<br>Automated Quotation does not require Signature";
            $this->email->message($msg);
            $this->email->set_mailtype('html');
       //     $this->email->send();
            if($this->email->send()){
        $this->session->set_flashdata('message','Sent Successfully!');        
        echo json_encode(array("statusCode"=>200));        
		//redirect('sent-quotations');               
            }else{
        $this->session->set_flashdata('message','Error!');        
		echo json_encode(array("statusCode"=>201));	
		//redirect('sent-quotations');               
            } 
        
    }else{
    echo json_encode(array("statusCode"=>201));	    
    }
    
    
	}
	
	public function resend_quotation(){
	
    $email = $this->quotation_model->get_pdf_mail($this->uri->segment(1));
    
	        $this->load->library('email');
            $this->email->from('sales@intellitest.co.in', 'Intellitest');
            $this->email->to($email->email_to);
            $this->email->cc($email->email_cc);
            $this->email->subject($email->email_subject);
            $this->email->attach('/home/universal/public_html/crm/assets/sent_quotations/'.$email->pdf);
            $msg = "Dear Sir/Madam,<br> Please find the attachment ";
            $msg .= "<br><br><br>Regards";
            $msg .= "<br>Intellitest";
            $msg .= "<br>Note - Please do not reply on this email";
            $msg .= "<br>Automated Quotation does not require Signature";
            $this->email->message($msg);
            $this->email->set_mailtype('html');
            if($this->email->send()){
		$this->session->set_flashdata('message','Sent Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);	                
            }else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);	                
            }	
	    
	}
	
	public function old_order_creation(){
		
		
		if($this->input->post('submit') == 'Submit'){
		$result = $this->quotation_model->old_order_creation();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$this->load->model('admin/enquiry_model');
        $data['products'] = $this->enquiry_model->products();
		$this->load->view('admin/old_order_creation',$data);		
		
	}	

    public function edit_oa(){

        if($this->input->post('submit') == 'Submit'){
            $result = $this->quotation_model->update_order_creation();

            if($result){
                $this->session->set_flashdata('message','Updated Successfully!');	
                redirect($_SERVER['HTTP_REFERER']);			
            }else{
                $this->session->set_flashdata('message','Error!');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }
        $this->load->model('admin/enquiry_model');
        $this->load->model('admin/tender_model');

        $data['products'] = $this->enquiry_model->products();

       /* echo '<pre>';
        print_r($data['products'] );
        die;*/
        $data['detail'] = $this->quotation_model->get_oa();
        //echo '<pre>';        print_r($data['detail']);exit;
        $data['branches'] = $this->tender_model->company_branch($data['detail']->organization);
                //echo '<pre>';        print_r($data['detail']);exit;

        $this->load->view('admin/edit_oa',$data);        
    }
	
    public function delete_oa(){
		$this->quotation_model->delete_oa();    
    }
	
	public function draft_quotation() {
        //echo '<pre>';        print_r($this->input->post());exit;
        $created = date('Y-m-d H:i:s');
        $enquiry_id = $this->input->post('hdn_enquiry_id');
        $result = $this->common_model->get_data('quotation_drafts','', '', '*','enquiry_id='.$enquiry_id, '', $count = false);
        if(empty($result)){
            $cnt = count($this->input->post('description[]'));
            for($i=0;$i<$cnt;$i++){
                $quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
                $insert_array[] = array(
                        'enquiry_id'      =>$enquiry_id,
                        'serial_num'        =>$i,
                        'description'      =>$this->input->post('description['.$i.']'),
                        'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                        'quantity'         =>$this->input->post('quantity['.$i.']'),
                        'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity,
                        'created'           =>$created,
                        'information_1'   => $this->input->post('information_1'),
                        'information_2'   => $this->input->post('information_2'),
                        'executive_name' =>$this->input->post('executive_name'),
                        'executive_number'   => $this->input->post('executive_number'),
                        'executive_email'   => $this->input->post('executive_email'),
                        'email_to' =>$this->input->post('email_to'),
                        'email_cc' =>$this->input->post('email_cc')
                    );
            }
            //echo "<pre>";        print_r($insert_array);exit;
            $this->db->insert_batch('quotation_drafts',$insert_array);
        }else{
            $drafts_count = count($result);
            $cnt = count($this->input->post('description[]'));
            if($drafts_count == $cnt){
                for($i=0;$i<$cnt;$i++){
                    $quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
                    $update_array = array(
                        'enquiry_id'      =>$enquiry_id,
                        'serial_num'        =>$i,
                        'description'      =>$this->input->post('description['.$i.']'),
                        'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                        'quantity'         =>$this->input->post('quantity['.$i.']'),
                        'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity,
                        'created'           =>$created,
                        'information_1'   => $this->input->post('information_1'),
                        'information_2'   => $this->input->post('information_2'),
                        'executive_name' =>$this->input->post('executive_name'),
                        'executive_number'   => $this->input->post('executive_number'),
                        'executive_email'   => $this->input->post('executive_email'),
                        'email_to' =>$this->input->post('email_to'),
                        'email_cc' =>$this->input->post('email_cc')
                    );
                    $update_data_details = ['table_name'=>'quotation_drafts',
                                            'update_data'=>$update_array,'condition'=>['enquiry_id'=>$enquiry_id,'serial_num'=>$i]];
                    $this->common_model->update_data($update_data_details);
                }
            }else{
                if($drafts_count < $cnt){
                    for($i=0;$i<$drafts_count;$i++){
                        $quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
                        $update_array = array(
                            'enquiry_id'      =>$enquiry_id,
                            'serial_num'        =>$i,
                            'description'      =>$this->input->post('description['.$i.']'),
                            'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                            'quantity'         =>$this->input->post('quantity['.$i.']'),
                            'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity,
                            'created'           =>$created,
                            'information_1'   => $this->input->post('information_1'),
                            'information_2'   => $this->input->post('information_2'),
                            'executive_name' =>$this->input->post('executive_name'),
                            'executive_number'   => $this->input->post('executive_number'),
                            'executive_email'   => $this->input->post('executive_email'),
                            'email_to' =>$this->input->post('email_to'),
                            'email_cc' =>$this->input->post('email_cc')
                        );
                        $update_data_details = ['table_name'=>'quotation_drafts',
                                                'update_data'=>$update_array,'condition'=>['enquiry_id'=>$enquiry_id,'serial_num'=>$i]];
                        $this->common_model->update_data($update_data_details);
                    }
                    
                    for($i=$drafts_count;$i<$cnt;$i++){
                        $quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
                        $insert_array = array(
                            'enquiry_id'      =>$enquiry_id,
                            'serial_num'        =>$i,
                            'description'      =>$this->input->post('description['.$i.']'),
                            'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                            'quantity'         =>$this->input->post('quantity['.$i.']'),
                            'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity,
                            'created'           =>$created,
                            'information_1'   => $this->input->post('information_1'),
                            'information_2'   => $this->input->post('information_2'),
                            'executive_name' =>$this->input->post('executive_name'),
                            'executive_number'   => $this->input->post('executive_number'),
                            'executive_email'   => $this->input->post('executive_email'),
                            'email_to' =>$this->input->post('email_to'),
                            'email_cc' =>$this->input->post('email_cc')
                        );
                        $this->common_model->insert_data(['table_name'=>'quotation_drafts','insert_data'=>$insert_array]);
                    }
                }else{
                    for($i=0;$i<$cnt;$i++){
                        $quantity = (is_numeric($this->input->post('quantity['.$i.']'))?$this->input->post('quantity['.$i.']'):1);
                        $update_array = array(
                            'enquiry_id'      =>$enquiry_id,
                            'serial_num'        =>$i,
                            'description'      =>$this->input->post('description['.$i.']'),
                            'unit_price'       =>$this->input->post('unitprice['.$i.']'),
                            'quantity'         =>$this->input->post('quantity['.$i.']'),
                            'amount'           =>$this->input->post('unitprice['.$i.']') * $quantity,
                            'created'           =>$created,
                            'information_1'   => $this->input->post('information_1'),
                            'information_2'   => $this->input->post('information_2'),
                            'executive_name' =>$this->input->post('executive_name'),
                            'executive_number'   => $this->input->post('executive_number'),
                            'executive_email'   => $this->input->post('executive_email'),
                            'email_to' =>$this->input->post('email_to'),
                            'email_cc' =>$this->input->post('email_cc')
                        );
                        $update_data_details = ['table_name'=>'quotation_drafts',
                                                'update_data'=>$update_array,'condition'=>['enquiry_id'=>$enquiry_id,'serial_num'=>$i]];
                        $this->common_model->update_data($update_data_details);
                    }
                    for($i=$cnt;$i<$drafts_count;$i++){
                        $where = ['enquiry_id'=>$enquiry_id,'serial_num'=>$i];
                        $this->common_model->delete_data(['table_name'=>'quotation_drafts','condition'=>$where]);
                    }
                }
            }
        }
    }
	
}
