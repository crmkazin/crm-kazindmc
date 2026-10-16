<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'sendinblue/vendor/autoload.php'; 
class Enquiry extends CI_Controller {
    
    var $locations = ['kazakhstan'=>['FKZ','GKZ','IKZ'],'azerbaijan'=>['FAZ','GAZ','IAZ'],'belarus'=>['FBZ','GBZ','IBZ'],'georgia'=>['FGE','GGE','IGE'], 'armenia' => ['FAR','GAR','IAR'], 'uzbekistan' => ['FUZ','GUZ','IUZ'],'COMBO' => ['CMB'],
                    'all'=>['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']];
                    
    var $locations_new = ['kazakhstan'=>['FKZ','GKZ','IKZ'],'azerbaijan'=>['FAZ','GAZ','IAZ'],'belarus'=>['FBZ','GBZ','IBZ'],'georgia'=>['FGE','GGE','IGE'], 'armenia' => ['FAR','GAR','IAR'], 'uzbekistan' => ['FUZ','GUZ','IUZ'],'COMBO' => ['CMB'],
                    'all'=>['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']];
                    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        check_delete();
        $allowed_users = ['1','2','3','5','4','6'];
        if(!in_array($this->session->userdata('type'),$allowed_users)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library('pagination');
       // echo "Loading...";exit;
    }		
	
	public function get_users_by_booking_type()
    {
        $booking_type = $this->input->post('booking_type');

        if (!empty($booking_type)) {
            $this->db->select('id, name');
            $this->db->from('admin');
            $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0);
            $this->db->where('status', 1);
            $query = $this->db->get();
            $users = $query->result();

            echo json_encode($users);
        } else {
            echo json_encode([]);
        }
    }

	
    public function index()
    {        
        $this->form_validation->set_rules('enquiry_no', 'File No.', 'trim|required|is_unique[enquiry.enquiry_no]',array('is_unique'=>'<div class="alert alert-danger" style="padding:0px 10px;">File No. Already Taken.</div>'));  
        if($this->form_validation->run() == FALSE){
            log_user_activity('Query Board B2B Add',$this->session->userdata('id'), 'B2B Add');
            $this->load->model('admin/user_model');
            $data['users'] = $this->user_model->all_user_enquiry(); 
            $where = 'is_deleted=0';
            $data['company'] = $this->common_model->get_data('company','', '', '*',$where,'', $count = false);
            $data['locations'] = $this->locations;
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $data['countries'] = $this->common_model->get_data('countries','', '', '*','','', $count = false);
            $select = 'admin.*';
            $where = 'type IN (5,6) AND status = 1';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            
            $data['content'] = 'admin/enquiry';
            $this->load->view('admin/layout',$data);
        }else{
            $result = $this->enquiry_model->new_enquiry();
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');	
                redirect('enquiry-followup');
                //redirect($_SERVER['HTTP_REFERER']);			
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again. </div>');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }     
    }	
    
    
     public function index1()
    {        
        $this->form_validation->set_rules('enquiry_no', 'File No.', 'trim|required|is_unique[enquiry.enquiry_no]',array('is_unique'=>'<div class="alert alert-danger" style="padding:0px 10px;">File No. Already Taken.</div>'));  
        if($this->form_validation->run() == FALSE){
            log_user_activity('Query Board B2B Add',$this->session->userdata('id'), 'B2B Add');
            $this->load->model('admin/user_model');
            $data['users'] = $this->user_model->all_user_enquiry(); 
            $where = 'is_deleted=0';
            $data['company'] = $this->common_model->get_data('company','', '', '*',$where,'', $count = false);
            $data['locations'] = $this->locations;
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $data['countries'] = $this->common_model->get_data('countries','', '', '*','','', $count = false);
            $select = 'admin.*';
            $where = 'type IN (5,6) AND status = 1';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            
            $data['content'] = 'admin/combo_enquiry';
            $this->load->view('admin/layout',$data);
        }else{
            $result = $this->enquiry_model->new_combo_enquiry();
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');	
                redirect('enquiry-followup');
                //redirect($_SERVER['HTTP_REFERER']);			
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again. </div>');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }     
    }	
    
    
    // combo-edit file
    public function combo_edit($enquiry_id = null)
    {        
        if (!$enquiry_id) {
            show_404();
        }

        // Decode the enquiry ID if needed
        $enquiry_id = ($enquiry_id);
        
        // Check if enquiry exists and is a combo enquiry
        $enquiry_data = $this->common_model->get_data('enquiry', array('id' => $enquiry_id));
        $this->db->SELECT('*');
        $this->db->FROM('enquiry');
        $this->db->WHERE('id',$enquiry_id);
        $enquiry = $this->db->get()->result_array();

        $this->form_validation->set_rules('enquiry_no', 'File No.', 'trim|required');  
        
        if($this->form_validation->run() == FALSE){
            log_user_activity('Query Board B2B Edit',$this->session->userdata('id'), 'B2B Edit - Enquiry ID: ' . $enquiry_id);
            
            $this->load->model('admin/user_model');
            $data['users'] = $this->user_model->all_user_enquiry(); 
            
            $where = 'is_deleted=0';
            $data['company'] = $this->common_model->get_data('company','', '', '*',$where,'', $count = false);
            $data['locations'] = $this->locations;
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $data['countries'] = $this->common_model->get_data('countries','', '', '*','','', $count = false);
            
            $select = 'admin.*';
            $where = 'type IN (5,6) AND status = 1';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            
            // Get existing enquiry data
            $data['enquiry'] = $enquiry;
            $company = $this->db->query("
                SELECT * 
                FROM company 
                WHERE company_id = ? 
            ", array($data['enquiry'][0]['company_id']));

            // Get combo enquiry details
            $query = $this->db->query("
                SELECT * 
                FROM combo_enquiry 
                WHERE enquiry_id = ? 
                ORDER BY check_in_date ASC
            ", array($enquiry_id));

            $data['company'] = $company->result();
            // print_r($data['enquiry']);

            $data['combo_details'] = $query->result();
            $data['content'] = 'admin/combo_enquiry_edit';
            $this->load->view('admin/layout',$data);
        } else {
            $result = $this->enquiry_model->update_combo_enquiry($enquiry_id);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');	
                redirect('enquiry-followup');
            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again. </div>');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }     
    }
	
	public function get_states(){
        $where = 'country_id = '.$this->input->post('country_id');
        $states = $this->common_model->get_data('states','', '', '*',$where,'', $count = false);
        echo json_encode($states);
    }
    
    public function get_city(){
        $where = 'state_id = '.$this->input->post('state_id');
        $states = $this->common_model->get_data('cities','', '', '*',$where,'', $count = false);
        echo json_encode($states);
    }
	
    public function enquiry_followup()
    {
        log_user_activity('Query Board View',$this->session->userdata('id'), 'Query Board: View');
        $data['locations_new'] = $this->locations_new;
        $data['locations'] = $this->locations;  
        $result_cnt = $this->enquiry_model->count_all_enquiry($data['locations']);
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'enquiry-followup?'.$search[0];
        $config["total_rows"] = $result_cnt;
        $config["per_page"] = 10;
        //$config["uri_segment"] = 2;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        //$config['first_link'] = True;
        //$config['last_link'] = True;
        //$config['first_link'] = 'First';
        //$config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        //$config['prev_tag_open'] = '<li class="prev">';
        //$config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = TRUE;
        //$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;
        $data['enquiry'] = $this->enquiry_model->all_enquiry($config["per_page"],$offset,$data['locations']);
         $enquiry_ids = array_map(function($e) { return $e->id; }, $data['enquiry']);
        $data['followups_by_enquiry'] = [];
        if (!empty($enquiry_ids)) {
            $this->db->select('followups.*, admin.name AS created_by_name, admin.type AS created_by_type');
            $this->db->from('followups');
            $this->db->join('admin', 'admin.id = followups.created_by', 'left');
            $this->db->where_in('followups.enquiry_id', $enquiry_ids);
            $this->db->order_by('followups.id', 'DESC'); // sabse recent pehle
            $all_followups = $this->db->get()->result();
            foreach ($all_followups as $f) {
                $data['followups_by_enquiry'][$f->enquiry_id][] = $f;
            }
        }
        // echo '<pre>';
        // print_r($data['enquiry']);
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        $data['counts'] = $this->dashboard_model->enquiry_status_count($data['locations']);
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', 'admin.*', 'admin.type IN ("5","6")', '', $count = false);
        $data['content'] = 'admin/enquiry_followup';  
        $this->load->view('admin/layout',$data);        
    }

    public function delete_enquiry(){
        log_user_activity('Query Board Enquiry Delete',$this->session->userdata('id'), 'Query Board: Enquiry Deleted');  
        $this->enquiry_model->delete_enquiry();  
        log_user_activity('Query Board Enquiry Delete',$this->session->userdata('id'), 'Query Board: Enquiry Deleted');
    }       
    
    public function edit_enquiry(){
        if($this->input->post('update') == 'Update'){  
            $result = $this->enquiry_model->update_enquiry();
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');	
                redirect($_SERVER['HTTP_REFERER']);			
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again.</div>');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }
        $where = 'is_deleted=0';
        $data['company'] = $this->common_model->get_data('company','', '', '*',$where,'', $count = false);
        $data['locations'] = $this->locations;
        $data['enquiry'] = $this->enquiry_model->get_enquiry(); 
        $data['users'] = $this->user_model->all_user_enquiry();
        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
        $select = 'admin.*';
        $where = 'type IN (5,6) AND status = 1';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        
        //echo '<pre>';print_r($data['enquiry']);exit;
        log_user_activity('Query Board Enquiry Edit',$this->session->userdata('id'), 'Query Board: Enquiry Edit');
        $data['content'] = 'admin/edit_enquiry';  
        $this->load->view('admin/layout',$data);
    }
	
    public function navigation(){
        $data['content'] = 'admin/enquiry_navigation';
        $this->load->view('admin/layout', $data);
    }

    // public function get_enquiry_num(){
    //     $booking_type = $this->input->post('booking_type');
    //     $where = 'enquiry_abbr = "'.$booking_type.'"';
    //     $select = 'if (ISNULL(max(enquiry_sequence)),"",max(enquiry_sequence)+1) AS seq';
    //     $booking_type_result = $this->common_model->get_data('enquiry','', '', $select,$where,'', $count = false);
    //     $prefix = (strlen($booking_type_result[0]->seq)==1)?'0':'';
    //     //$file_num = $booking_type.date('y').$prefix.$booking_type_result[0]->seq;
    //     $file_num = trim($booking_type . $prefix . $booking_type_result[0]->seq);
    //     echo json_encode(['file_num' => $file_num, 'file_seq' => $booking_type_result[0]->seq]);
    // }
    
    // public function get_enquiry_num(){
    //     $booking_type = $this->input->post('booking_type');
    //     $where = 'enquiry_abbr = "'.$booking_type.'"';
    //     $select = 'IFNULL(MAX(enquiry_sequence)+1, 1) AS seq';
        
    //     $booking_type_result = $this->common_model->get_data('enquiry','', '', $select,$where,'', $count = false);

    //     $seq = $booking_type_result[0]->seq ?? '';
    //     $prefix = (strlen($seq) == 1) ? '0' : '';
    //     $file_num = trim($booking_type . $prefix . $seq);

    //     echo json_encode(['file_num' => $file_num, 'file_seq' => $seq]);
    // }
    
    public function get_enquiry_num(){
        $booking_type = $this->input->post('booking_type');
    
        // Extract the numeric part of enquiry_no and get MAX + 1
        $select = 'IFNULL(MAX(CAST(SUBSTRING(enquiry_no, LENGTH("'.$booking_type.'")+1) AS UNSIGNED)) + 1, 1) AS seq';
        $where = 'enquiry_no LIKE "'.$booking_type.'%"';
    
        $booking_type_result = $this->common_model->get_data(
            'enquiry', '', '', $select, $where, '', $count = false
        );
    
        $seq = $booking_type_result[0]->seq ?? 1;
    
        $prefix = (strlen($seq) == 1) ? '0' : '';
    
        $file_num = $booking_type . $prefix . $seq;
    
        echo json_encode([
            'file_num' => $file_num,
            'file_seq' => $seq
        ]);
    }
    

    public function get_enquiry_num_new()
    {
        // Always use prefix CMB
        $prefix = 'CMB';

        // Get the latest enquiry number starting with CMB
        $this->db->select('enquiry_no');
        $this->db->from('enquiry');
        $this->db->like('enquiry_no', $prefix, 'after'); // enquiry_no starts with CMB
        $this->db->order_by('LENGTH(enquiry_no)', 'DESC');
        $this->db->order_by('enquiry_no', 'DESC');
        $query = $this->db->get();

        $max_seq = 0;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $enquiry_no = $row->enquiry_no;
                // Extract numeric part
                if (preg_match('/(\d+)$/', $enquiry_no, $matches)) {
                    $current_seq = intval($matches[1]);
                    if ($current_seq > $max_seq) {
                        $max_seq = $current_seq;
                    }
                }
            }
        }

        // Increment sequence
        $seq = $max_seq + 1;

        // Always 2 digits (01, 02, 03, ...)
        $file_num = $prefix . str_pad($seq, 2, '0', STR_PAD_LEFT);

        echo json_encode([
            'file_num' => $file_num,
            'file_seq' => $seq
        ]);
    }

    
    public function add_new_company(){
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('contact_person_agent', 'Agent Name', 'trim|required');
        $this->form_validation->set_rules('email_agent', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_number_agent', 'Agent Contact Number', 'trim|required|integer');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');  
        $this->form_validation->set_rules('address', 'Register Address', 'trim|required');  
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            log_user_activity('Query Board Add New Company',$this->session->userdata('id'), 'Add New Company Error: '. validation_errors());
            exit;
        }
        
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('company_name'))).'" AND is_deleted ="0"';
        $res_company = $this->common_model->get_data('company','', '', '*',$where, '', $count = true);
        //echo $res_company;exit;
        if($res_company > 0){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-warning">Company with name ('.$this->input->post('company_name').') exists!</div>']);
            exit;
        }        
        
        $company_id = uniqid();
        $c_name = ucwords(strtolower($this->input->post('company_name')));
        $data = array('name' =>   $this->security->xss_clean($c_name),
                    'company_id'  => $company_id,'date'	 => date('Y-m-d'));
        $result = $this->db->insert('company',$data);
        if($result){
            $countryParts = explode('_', $this->input->post('country'));
            $stateParts   = explode('_', $this->input->post('state'));
            $cityParts    = explode('_', $this->input->post('city'));
            $branch = array(
        		'company'   => $company_id,
                'country'   => ucwords(strtolower($countryParts[1] ?? $countryParts[0] ?? '')),
                'state'     => ucwords(strtolower($stateParts[1] ?? $stateParts[0] ?? '')),
                'city'      => ucwords(strtolower($cityParts[1] ?? $cityParts[0] ?? '')),
        		'address'		=>$this->security->xss_clean($this->input->post('address')),
                'address_2'		=>$this->security->xss_clean($this->input->post('address_2')),
        		'contact_person'=>$this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person_agent')))),
        		'contact_person_number'=>$this->security->xss_clean($this->input->post('contact_number_agent')),
        		'email'			=>$this->security->xss_clean($this->input->post('email_agent')),
        		'creation_date'		=>date('Y-m-d'),
                'gstin'			=>$this->security->xss_clean($this->input->post('gstin')),
                'user_id'               =>$this->session->userdata('id'),
                'contact_person_isd_code' => $this->security->xss_clean($this->input->post('isd_codes')),
                'designation' => $this->security->xss_clean($this->input->post('agent_designation')),
                'acquiring_source' => $this->input->post('acquiring_source') ?? '',
                'exhibition_source'       => $this->input->post('exhibition') ?? '',
                'remark'           => $this->input->post('remark') ?? '',
                'pincode'          => $this->input->post('pincode') ?? '',
                'sales_admin_id'   => $this->input->post('sales') ?? '',
                'landline_number_isd_code' => $this->input->post('landline_number_isd_code') ?? '',
                'landline_number'  => $this->input->post('landline_number') ?? '',
                'email2'  => $this->input->post('email2') ?? '',
                'register_address' => $this->input->post('register_address') ?? '',
                'register_address2' => $this->input->post('register_address2') ?? '',
                'road_show' => $this->input->post('road_show') ?? '',
            );
            // print_r($branch);
            // // die;
            $insertResult = $this->db->insert('company_details', $branch);
            if (!$insertResult) {
            log_message('error', 'Insert failed: ' . $this->db->last_query());
            echo json_encode(['response' => 'e', 'msg' => 'Insert failed']);
            return;
            }
            log_user_activity('Query Board Add New Company',$this->session->userdata('id'), 'Add New Company: '. json_encode($branch));
            echo json_encode(['response'=>'s','details'=>['c_name'=>$c_name,'c_id'=>$company_id],'msg'=>'<div class="alert alert-success">Company created successully!</div>']);
        }
    }
    
    public function add_new_agent(){
        $this->form_validation->set_rules('agent_contact', 'Agent Name', 'trim|required');
        $this->form_validation->set_rules('agent_email', 'Agent Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('agent_contact_number', 'Agent Contact Number', 'trim|required|integer');
        $this->form_validation->set_rules('country_agent', 'Country', 'trim|required');
        $this->form_validation->set_rules('state_agent', 'State', 'trim|required');
        $this->form_validation->set_rules('city_agent', 'City', 'trim|required');
        $this->form_validation->set_rules('address', 'Register Address', 'trim|required');  
        $company_id = $this->input->post('company_id');
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            log_user_activity('Query Board Add New Agent',$this->session->userdata('id'), 'Add New Agent Error: '. validation_errors());
            exit;
        }
        $agent_name = ucwords(strtolower($this->input->post('agent_contact')));
        $agent_details = array(
            'company'               =>$company_id,            
            'contact_person'=>$this->security->xss_clean($agent_name),
            'contact_person_number'=>$this->security->xss_clean($this->input->post('agent_contact_number')),
            'email'			=>$this->security->xss_clean($this->input->post('agent_email')),
            'creation_date'		=>date('Y-m-d'),            
            'user_id'               =>$this->session->userdata('id'),
            'designation'           =>$this->security->xss_clean($this->input->post('agent_designation')),
            'contact_person_isd_code' => $this->security->xss_clean($this->input->post('isd_codes')),
            'country' => ucwords(strtolower($this->input->post('country_agent'))),
            'state' => ucwords(strtolower($this->input->post('state_agent'))),
            'city' => ucwords(strtolower($this->input->post('city_agent'))),
            'address' => array_key_exists('address', $this->input->post())?$this->input->post('address'):'',
            'address_2' => array_key_exists('address_2', $this->input->post())?$this->input->post('address_2'):'',
            'acquiring_source' => $this->input->post('acquiring_source') ?? '',
            'exhibition_source'=>$this->input->post('exhibition') ?? '',
            'remark'=>$this->input->post('remark') ?? '',
            'sales_admin_id'   => $this->input->post('sales') ?? '',
            'landline_number_isd_code' => $this->input->post('landline_number_isd_code'),
            'landline_number'  => $this->input->post('landline_number') ?? '',
            'email2'  => $this->input->post('email2') ?? '',
            'register_address' => $this->input->post('register_address') ?? '',
            'register_address2' => $this->input->post('register_address2') ?? '',
            'road_show' => $this->input->post('road_show') ?? '',
        );
        $this->db->insert('company_details',$agent_details);
        $id = $this->db->insert_id();
        /*$this->db->query('UPDATE company_details u JOIN company_details s ON s.company = u.company
               SET u.address = s.address,u.country=s.country,u.gstin=s.gstin,u.state=s.state,u.city=s.city where u.company_id='.$id);*/
               log_user_activity('Query Board Add New Agent',$this->session->userdata('id'), 'Add New Agent: '. json_encode($agent_details));
        echo json_encode(['response'=>'s','details'=>['a_name'=>$agent_name,'a_id'=>$id.'_'.$agent_name],'msg'=>'<div class="alert alert-success">Agent created successully!</div>']);
       
    }
    
    // b2c query
    public function b2c(){        
        $this->form_validation->set_rules('booking_type', 'Booking Type', 'trim|required');
        $this->form_validation->set_rules('enquiry_no', 'File Number', 'trim|required');
        $this->form_validation->set_rules('client_name', 'Client Name', 'trim|required');
        $this->form_validation->set_rules('client_email', 'Client Email', 'trim|required');
        $this->form_validation->set_rules('client_contact_number', 'Client Contact Number', 'trim|required');
        
        if($this->input->post('company')<>'' && $this->input->post('company_id')==''){
            $this->form_validation->set_message('company_name_unique', '&nbsp;&nbsp;Company Name Already Exist');
            $this->form_validation->set_rules('company', 'Campany', 'trim|callback_company_name_unique');
        }
        
        if($this->form_validation->run() == FALSE){
            log_user_activity('Query Board Add B2C',$this->session->userdata('id'), 'Add B2C: ');
            $this->load->model('admin/user_model');
            $data['users'] = $this->user_model->all_user_enquiry();        
            $data['locations'] = $this->locations;
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $data['content'] = 'admin/enquiry_b2c';
            $this->load->view('admin/layout',$data);
        }else{
            $company_id = $this->input->post('company_id');
            if($company_id == '' && $this->input->post('company')<>''){
                $company_id = uniqid();
                $data = array(
                    'name' =>   $this->security->xss_clean(ucwords(strtolower($this->input->post('company')))),
                    'company_id'  => $company_id,'date'	 => date('Y-m-d'),
                    'type'=>$this->security->xss_clean($this->input->post('enquiry_type'))
		);
                $this->common_model->insert_data(['table_name'=>'company','insert_data'=>$data]);            
            }
            
            $insert_data  = array(
                'company'               =>$company_id,            
                'contact_person'        =>ucwords(strtolower($this->input->post('client_name'))),
                'contact_person_number'=>$this->security->xss_clean($this->input->post('client_contact_number')),
                'email'			=>$this->security->xss_clean($this->input->post('client_email')),
                'creation_date'		=>date('Y-m-d'),            
                'user_id'               =>$this->session->userdata('id'),
                'designation'           =>$this->security->xss_clean($this->input->post('client_designation')),
                'contact_person_isd_code' => $this->security->xss_clean($this->input->post('isd_codes')),
                'country'               => $this->security->xss_clean($this->input->post('country')),
                'state'                 => $this->security->xss_clean($this->input->post('state')),
                'city'                  => $this->security->xss_clean($this->input->post('city')),
                'address'               => $this->security->xss_clean($this->input->post('address')),
                'gstin'                 => $this->security->xss_clean($this->input->post('gstin')),
                'type'                  => $this->security->xss_clean($this->input->post('enquiry_type'))
            );
            $client_id = $this->common_model->insert_data(['table_name'=>'company_details','insert_data'=>$insert_data]);
            $child_age = $this->input->post('child_age');
    		if(!empty($child_age)){
    			$child_age = array_map('intval', $child_age);
    		}
            $data_enq = array(
                'mode'  => $this->security->xss_clean($this->input->post('mode')),
                'company_id'            => $company_id,
                'company_details_id'    => $client_id,
                'enquiry_abbr'          => $this->security->xss_clean($this->input->post('booking_type')),
                'enquiry_sequence'       => $this->security->xss_clean($this->input->post('file_seq')),
                'number_persons'        => $this->security->xss_clean($this->input->post('number_persons')),
                'number_child'          => $this->security->xss_clean($this->input->post('number_child')),
                'check_in_date'         => $this->security->xss_clean($this->input->post('check_in')),
                'check_out_date'        => $this->security->xss_clean($this->input->post('check_out')),
                'query_received_date'       => $this->security->xss_clean($this->input->post('query_received_on')),
                'number_of_nights' =>  $this->security->xss_clean($this->input->post('number_of_nights')),
                'enquiry_type'      => $this->security->xss_clean($this->input->post('enquiry_type')),
                //'status'            => $this->security->xss_clean($this->input->post('status')),
                'remarks'           => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),		
                'added_by'          => $this->security->xss_clean($this->session->userdata('id')),
                'enquiry_no'        => $this->security->xss_clean($this->input->post('enquiry_no')),		
                'date'              => date('Y-m-d H:i:s'),
                'file_handle_by'    => $this->security->xss_clean($this->input->post('file_handle_by')),
                'sales_admin_id'    => $this->security->xss_clean($this->input->post('sales')),
                'child_age'			=> !empty($child_age) ? json_encode($child_age) : NULL,
            );
            $this->common_model->insert_data(['table_name'=>'enquiry','insert_data'=>$data_enq]);
            
            $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully! </div>');	
            log_user_activity('Query Board Add B2C New',$this->session->userdata('id'), 'Add B2C New: '. json_encode($insert_data). json_encode($data_enq));
            redirect('enquiry-followup');	
            
        }
    }
    
    // unique company name
    public function company_name_unique(){
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('company'))).'" AND is_deleted ="0"';
        $count = $this->common_model->get_data('company','', '', '*',$where, '', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    // get staff
    public function get_staff(){
        $location = $this->input->post('location');
        $escaped_location = $this->db->escape_str($location); // prevent SQL injection

        $where = "admin.status = 1 AND (FIND_IN_SET('$escaped_location', admin.location) OR admin.location = 'all')";
        //$where = 'admin.status=1 AND admin.location="'.$location.'" '; 
        // $where = 'admin.status=1 AND (admin.location="'.$location.'" OR admin.location="all")';
        
        $orderby = ' ORDER BY admin.name';
        $select = '*';
        $data = $this->common_model->get_data('admin','', '', $select,$where, $orderby, $count = false);
        echo json_encode(['response'=>'s','details'=>$data,'msg'=>'']);
    }
    
    // get staffusers
    public function get_staffuser(){
        $location = $this->input->post('location');
        $escaped_location = $this->db->escape_str($location); // prevent SQL injection

        $where = "admin.status = 1 AND (FIND_IN_SET('$escaped_location', admin.location) OR admin.location = 'all') AND admin.type=2 ";
        //$where = 'admin.status=1 AND admin.location="'.$location.'" '; 
        // $where = 'admin.status=1 AND (admin.location="'.$location.'" OR admin.location="all")';
        
        $orderby = ' ORDER BY admin.name';
        $select = '*';
        $data = $this->common_model->get_data('admin','', '', $select,$where, $orderby, $count = false);
        echo json_encode(['response'=>'s','details'=>$data,'msg'=>'']);
    }
    
    // excel download
    // public function excel_download()
    // {
    //     log_user_activity('Query Board Excel Download',$this->session->userdata('id'), 'Excel Downloaded');
    //     $allowed_users = ['1','3','5'];
    //     if(!in_array($this->session->userdata('type'),$allowed_users)){
    //         $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
    //         redirect('dashboard');
    //     }
    //     $data['locations'] = $this->locations;
    //     $result = $this->enquiry_model->all_enquiry('','0',$data['locations']);
    //     //echo '<pre>';        print_r($result);exit;
    //     $this->load->library('PHPExcel');
    //     include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->setActiveSheetIndex(0);
    //     //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

    //     $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
    //     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
    //     $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Received Date');
    //     $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Query Number');
    //     $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Handling File By');
    //     $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Check-in');
    //     $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Check-out');
    //     $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Number Of Guests');
    //     $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Agent Name');
    //     $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Company');
    //     $objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
    //     $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Corporate Office Address');
    //     $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Registered Office Address');
    //     $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Status');

    //     $row = 2;
    //     $sr = 1;
    //     if (isset($result[0])) {            
    //         foreach ($result as $enquiries) {
    //             $split = '';
    //             if(substr($enquiries->enquiry_abbr,0,1) == 'G' && $enquiries->split_count != 0){
    //                 $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$enquiries->arrival_id;
    //                 $qry_result = $this->common_model->custom_query($qry);
    //                 if(!empty($qry_result)){
    //                   $enquiries->check_in_date = ($qry_result[0]->chk_in <> '')?$qry_result[0]->chk_in:$enquiries->check_in_date;
    //                   $enquiries->check_out_date = ($qry_result[0]->chk_out <> '')?$qry_result[0]->chk_out:$enquiries->check_out_date;
    //                   $enquiries->number_persons = $enquiries->num_adults;
    //                   $enquiries->number_child = $enquiries->num_child;
    //                 }
    //                 $split = ' (Split-'.$enquiries->split_number.')';
    //             }
                
    //              /*** ADD THIS NEW BLOCK ***/
    //             $combo_enquiry = $this->db->where('enquiry_id', $enquiries->id)
    //                                     ->get('combo_enquiry')
    //                                     ->result();

    //             $checkin = [];
    //             $checkout = [];
    //             $no_of_child = [];
    //             $no_of_person = [];

    //             foreach ($combo_enquiry as $combo) {
    //                 $no_of_person[] = $combo->no_of_person;
    //                 $no_of_child[] = $combo->no_of_child;
    //                 $checkin[] = $combo->check_in_date;
    //                 $checkout[] = $combo->check_out_date;
    //             }

    //             if (!empty($checkin)) {
    //                 $timestamps_in = array_map('strtotime', $checkin);
    //                 $enquiries->check_in_date = date('Y-m-d', min($timestamps_in));
    //             }

    //             if (!empty($checkout)) {
    //                 $timestamps_out = array_map('strtotime', $checkout);
    //                 $enquiries->check_out_date = date('Y-m-d', max($timestamps_out));
    //             }

    //             if (!empty($no_of_person)) {
    //                 $enquiries->number_persons = ($no_of_person[0]);
    //             }
    //             if (!empty($no_of_child)) {
    //                 $enquiries->number_child = ($no_of_child[0]);
    //             }
                
                
    //             $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
    //             $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, date('d-M-Y', strtotime($enquiries->query_received_date)));
    //             $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $enquiries->enquiry_no.$split);
    //             $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $enquiries->staff_name);
    //             $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, date('d-M-Y', strtotime($enquiries->check_in_date)));
    //             $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, date('d-M-Y', strtotime($enquiries->check_out_date)));
    //             $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)');
    //             $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $enquiries->contact_person);
    //             $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $enquiries->name);
    //             $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $enquiries->city);
    //             $objPHPExcel->getActiveSheet()->setCellValue('K' .  $row,$enquiries->address . ', ' . $enquiries->address_2);
    //             $objPHPExcel->getActiveSheet()->setCellValue('L' . $row,implode(', ', array_filter([
    //                     $enquiries->register_address,
    //                     $enquiries->register_address2
    //                 ]))
    //             );
    //             $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucfirst(str_replace('-', ' ', $enquiries->follow_status)));
    //             $row++;
    //             $sr++;
    //         }
    //     }

    //     header('Content-Type: application/vnd.ms-excel'); //mime type
    //     header('Content-Disposition: attachment;filename="' . 'Queryboard_' . date('d-m-Y') . '.xlsx' . '"');
    //     header('Cache-Control: max-age=0'); //no cache

    //     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //     //if you want to save it as .XLSX Excel 2007 format
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     //force user to download the Excel file without writing it to server's HD
    //     $objWriter->save('php://output');
    // }
    // 28/09/26
     public function excel_download()
    {
        log_user_activity('Query Board Excel Download',$this->session->userdata('id'), 'Excel Downloaded');
        $allowed_users = ['1','3','5'];
        if(!in_array($this->session->userdata('type'),$allowed_users)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $data['locations'] = $this->locations;
        $result = $this->enquiry_model->all_enquiry('','0',$data['locations']);
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // headers: A1:O1 kar diya (M se badhaake N, O tak)
        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Received Date');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Query Number');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Handling File By');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Check-in');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Check-out');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Number Of Guests');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Agent Name');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Company');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Corporate Office Address');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Registered Office Address');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Status');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Ops Followups');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Sales Followups');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $enquiries) {
                $split = '';
                if(substr($enquiries->enquiry_abbr,0,1) == 'G' && $enquiries->split_count != 0){
                    $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$enquiries->arrival_id;
                    $qry_result = $this->common_model->custom_query($qry);
                    if(!empty($qry_result)){
                    $enquiries->check_in_date = ($qry_result[0]->chk_in <> '')?$qry_result[0]->chk_in:$enquiries->check_in_date;
                    $enquiries->check_out_date = ($qry_result[0]->chk_out <> '')?$qry_result[0]->chk_out:$enquiries->check_out_date;
                    $enquiries->number_persons = $enquiries->num_adults;
                    $enquiries->number_child = $enquiries->num_child;
                    }
                    $split = ' (Split-'.$enquiries->split_number.')';
                }

                $combo_enquiry = $this->db->where('enquiry_id', $enquiries->id)
                                        ->get('combo_enquiry')
                                        ->result();

                $checkin = [];
                $checkout = [];
                $no_of_child = [];
                $no_of_person = [];

                foreach ($combo_enquiry as $combo) {
                    $no_of_person[] = $combo->no_of_person;
                    $no_of_child[] = $combo->no_of_child;
                    $checkin[] = $combo->check_in_date;
                    $checkout[] = $combo->check_out_date;
                }

                if (!empty($checkin)) {
                    $timestamps_in = array_map('strtotime', $checkin);
                    $enquiries->check_in_date = date('Y-m-d', min($timestamps_in));
                }

                if (!empty($checkout)) {
                    $timestamps_out = array_map('strtotime', $checkout);
                    $enquiries->check_out_date = date('Y-m-d', max($timestamps_out));
                }

                if (!empty($no_of_person)) {
                    $enquiries->number_persons = ($no_of_person[0]);
                }
                if (!empty($no_of_child)) {
                    $enquiries->number_child = ($no_of_child[0]);
                }

                /*** NEW: latest Ops (admin.type = 2) aur latest Sales (admin.type = 5) followup ***/
                $ops_followup = $this->db->select('followups.followup_remarks')
                                    ->from('followups')
                                    ->join('admin', 'admin.id = followups.created_by')
                                    ->where('followups.enquiry_id', $enquiries->id)
                                    ->where('admin.type', '2')
                                    ->order_by('followups.date', 'DESC')
                                    ->order_by('followups.id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ->row();

                $sales_followup = $this->db->select('followups.followup_remarks')
                                    ->from('followups')
                                    ->join('admin', 'admin.id = followups.created_by')
                                    ->where('followups.enquiry_id', $enquiries->id)
                                    ->where('admin.type', '5')
                                    ->order_by('followups.date', 'DESC')
                                    ->order_by('followups.id', 'DESC')
                                    ->limit(1)
                                    ->get()
                                    ->row();

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, date('d-M-Y', strtotime($enquiries->query_received_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $enquiries->enquiry_no.$split);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $enquiries->staff_name);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, date('d-M-Y', strtotime($enquiries->check_in_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, date('d-M-Y', strtotime($enquiries->check_out_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)');
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $enquiries->contact_person);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $enquiries->name);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $enquiries->city);
                $objPHPExcel->getActiveSheet()->setCellValue('k' .  $row,$enquiries->address . ', ' . $enquiries->address_2);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row,implode(', ', array_filter([
                        $enquiries->register_address,
                        $enquiries->register_address2
                    ]))
                );
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucfirst(str_replace('-', ' ', $enquiries->follow_status)));
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, ($ops_followup) ? $ops_followup->followup_remarks : '');
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, ($sales_followup) ? $sales_followup->followup_remarks : '');

                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . 'Queryboard_' . date('d-m-Y') . '.xlsx' . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    // booking type users
    public function get_users_by_booking_types()
    {
        $booking_type = $this->input->get('booking_type');
        $location = strtolower($this->input->get('location')); // normalize

        $bookingTypeMap = $this->locations;
        
        if ($location === 'combo' && ($booking_type === 'all' || $booking_type === 'CMB')) {
            $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, admin.combo_access, hod_detail.booking_type AS hod_booking_type');
            $this->db->from('admin');
            $this->db->join('hod_detail', 'hod_detail.user_id = admin.id', 'left');
            $this->db->where('admin.status !=', '0');
            $this->db->where('admin.combo_access', 'yes');
            
            $this->db->order_by('admin.hod', 'DESC');
            $users = $this->db->get()->result_array();
            echo json_encode(['status' => 'success', 'data' => $users]);
            return;
        }

        // If booking_type is "all" and location exists in map
        if ($booking_type === 'all' && isset($bookingTypeMap[$location])) {
            $types = $bookingTypeMap[$location];

            $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
            $this->db->from('admin');
            $this->db->join('hod_detail', 'hod_detail.user_id = admin.id', 'left');
            $this->db->where('admin.status !=', '0');

            // Start outer group
            $this->db->group_start(); // (
            foreach ($types as $type) {
                $this->db->or_group_start(); // OR (
                    // HOD condition
                    $this->db->group_start(); // (
                        $this->db->where('admin.hod', 'yes');
                        $this->db->where('hod_detail.status !=', 'delete');
                        $this->db->group_start(); // (
                            $this->db->where("FIND_IN_SET('$type', hod_detail.booking_type)", null, false);
                            $this->db->or_where("FIND_IN_SET('$type', admin.booking_type)", null, false);
                        $this->db->group_end(); // )
                    $this->db->group_end(); // )

                    // Non-HOD condition
                    $this->db->or_group_start(); // OR (
                        $this->db->where('admin.hod !=', 'yes');
                        $this->db->where("FIND_IN_SET('$type', admin.booking_type)", null, false);
                    $this->db->group_end(); // )
                $this->db->group_end(); // )
            }
            $this->db->group_end(); // )

            $this->db->order_by('admin.hod', 'DESC');
            $users = $this->db->get()->result_array();
            echo json_encode(['status' => 'success', 'data' => $users]);
            return;
        }

        // When specific booking_type is selected
        $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
        $this->db->from('admin');
        $this->db->join('hod_detail', 'hod_detail.user_id = admin.id', 'left');
        $this->db->where('admin.status !=', '0');

        $this->db->where("(
            (
                admin.hod = 'yes'
                AND hod_detail.status != 'delete'
                AND (
                    (hod_detail.booking_type IS NOT NULL AND hod_detail.booking_type != '' AND FIND_IN_SET('$booking_type', hod_detail.booking_type))
                    OR
                    (admin.booking_type IS NOT NULL AND admin.booking_type != '' AND FIND_IN_SET('$booking_type', admin.booking_type))
                )
            )
            OR
            (
                admin.hod != 'yes'
                AND admin.booking_type IS NOT NULL 
                AND admin.booking_type != '' 
                AND FIND_IN_SET('$booking_type', admin.booking_type)
            )
        )", null, false);

        $this->db->order_by('admin.hod', 'DESC');
        $users = $this->db->get()->result_array();
        echo json_encode(['status' => 'success', 'data' => $users]);
    }

    // For user loggedin only
    public function get_users_by_booking_type_filtered()
    {
        $booking_type = $this->input->get('booking_type');
        $location = $this->input->get('location');
        $user_id = $this->session->userdata('id');
        $login_type = $this->session->userdata('type');

        $response = ['status' => 'error', 'users' => []];

        if ($login_type == 2 && $booking_type) {
            $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

            if ($admin) {
                $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
                $this->db->from('admin');
                $this->db->join('hod_detail', "hod_detail.user_id = admin.id AND hod_detail.status != 'delete'", 'left');

                // Only include active admins (status not 0 and not 2)
                $this->db->where('admin.status !=', '0');
                $this->db->where('admin.status !=', '2');

                $this->db->where("(
                    (admin.hod = 'yes' AND FIND_IN_SET('{$booking_type}', hod_detail.booking_type) 
                        AND hod_detail.booking_type IS NOT NULL 
                        AND hod_detail.booking_type != '')
                    OR
                    (admin.hod != 'yes' AND FIND_IN_SET('{$booking_type}', admin.booking_type) 
                        AND admin.booking_type IS NOT NULL 
                        AND admin.booking_type != '')
                    OR
                    (admin.hod = 'yes' AND admin.id = '{$user_id}')
                )", null, false);

                $users = $this->db->get()->result_array();

                $response = [
                    'status' => 'success',
                    'users' => $users,
                    'logged_in_user_id' => $user_id
                ];
            }
        }

        echo json_encode($response);
    }

    // For user loggedin only
    public function get_booking_data_for_hod_user()
    {
        $location = $this->input->get('location');
        $booking_type = $this->input->get('booking_type'); // may be empty
        $user_id = $this->session->userdata('id');
        $login_type = $this->session->userdata('type');

        $response = [
            'status' => 'error',
            'message' => 'Invalid request',
            'booking_type_options' => [],
            'selected_booking_type' => '',
            'users' => []
        ];

        $location_map = [
            'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
            'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
            'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
            'georgia'    => ['FGE', 'GGE', 'IGE'],
            'armenia'    => ['FAR','GAR','IAR'],
            'uzbekistan' => ['FUZ','GUZ','IUZ'],
            'combo' => ['CMB'],
        ];

        if ($login_type == 2 && $location) {
            $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

            if ($admin) {
                $location_types = $location_map[$location] ?? [];

                $admin_booking_types = !empty($admin['booking_type']) ? explode(',', $admin['booking_type']) : [];
                $matched_booking_types = [];

                if ($admin['hod'] === 'yes') {
                    $hod_detail = $this->db->get_where('hod_detail', [
                        'user_id' => $user_id,
                        'status !=' => 'delete'
                    ])->row_array();

                    $hod_booking_types = !empty($hod_detail['booking_type']) ? explode(',', $hod_detail['booking_type']) : [];

                    $all_booking_types = array_unique(array_merge($admin_booking_types, $hod_booking_types));

                    // Match booking types for selected location
                    $matched_booking_types = array_intersect($all_booking_types, $location_types);
                } else {
                    $matched_booking_types = array_intersect($admin_booking_types, $location_types);
                }

                if (!empty($matched_booking_types)) {
                    // If no booking_type passed, pick first matched
                    if (empty($booking_type)) {
                        $booking_type = reset($matched_booking_types);
                    }

                    // Now fetch users having this booking type
                    $this->db->select('id, name, hod');
                    $this->db->from('admin');
                    $this->db->where('status !=', '0');
                    $this->db->where('status !=', '2');
                    $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0, false);
                    $users = $this->db->get()->result_array();

                    // Ensure HOD in result
                    if (!in_array($user_id, array_column($users, 'id'))) {
                        $users[] = [
                            'id' => $admin['id'],
                            'name' => $admin['name'],
                            'hod' => $admin['hod']
                        ];
                    }

                    $response = [
                        'status' => 'success',
                        'selected_booking_type' => $booking_type,
                        'booking_type_options' => array_values($matched_booking_types),
                        'users' => $users,
                        'logged_in_user_id' => $user_id
                    ];
                } else {
                    $response['message'] = 'No matching booking types for this location.';
                }
            } else {
                $response['message'] = 'Invalid admin record.';
            }
        }

        echo json_encode($response);
    } 
    // Staff Booking Type filter End here according to assigned location
   
    // for combo files  
    // public function get_users_by_booking_type_new()
    // {   
    //     $booking_types = $this->input->post('booking_type');
        
    //     if (!$booking_types || empty($booking_types)) {
    //         echo json_encode([]);
    //         return;
    //     }

    //     $this->db->select('id, name');
    //     $this->db->from('admin');
    //     $this->db->where('status', '1');
    //     $this->db->where('type', '2');
        
    //     // Handle multiple booking types
    //     if (is_array($booking_types)) {
    //         $conditions = [];
    //         foreach ($booking_types as $type) {
    //             $type = $this->db->escape_str($type);
    //             $conditions[] = "FIND_IN_SET('{$type}', booking_type) > 0";
    //         }
    //         $this->db->where('(' . implode(' OR ', $conditions) . ')');
    //     } else {
    //         // Single booking type (backward compatibility)
    //         $booking_type = $this->db->escape_str($booking_types);
    //         $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0);
    //     }
        
    //     $this->db->group_by('id'); // Avoid duplicates if user matches multiple types
    //     $query = $this->db->get();
    //     $users = $query->result();
        
    //     echo json_encode($users);
    // }
    
    // For specific user
    public function get_booking_data_by_location()
    {
        $location = $this->input->get('location');
        $user_id = $this->session->userdata('id');
        $login_type = $this->session->userdata('type');

        $response = [
            'status' => 'error',
            'message' => 'Invalid request',
            'booking_type_options' => [],
            'selected_booking_type' => '',
            'users' => []
        ];

        $location_map = $this->locations_new;

        if ($location) {
            // Get booking types directly from location map
            $booking_type_options = $location_map[$location] ?? [];

            if (!empty($booking_type_options)) {
                // Pick first booking type as default
                $selected_booking_type = reset($booking_type_options);
                
                // Get all users for all booking types in this location
                $all_users = [];
                
                foreach ($booking_type_options as $booking_type) {
                    $this->db->select('id, name, hod, booking_type');
                    $this->db->from('admin');
                    $this->db->where('status !=', '0');
                    $this->db->where('status !=', '2');
                    $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0, false);
                    $users = $this->db->get()->result_array();
                    
                    foreach ($users as $user) {
                        // Add user if not already added
                        if (!isset($all_users[$user['id']])) {
                            $all_users[$user['id']] = $user;
                        }
                    }
                }

                // Convert to indexed array
                $all_users = array_values($all_users);

                // Ensure current user in result
                $current_user_exists = false;
                foreach ($all_users as $user) {
                    if ($user['id'] == $user_id) {
                        $current_user_exists = true;
                        break;
                    }
                }
                
                if (!$current_user_exists) {
                    $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();
                    if ($admin) {
                        $all_users[] = [
                            'id' => $admin['id'],
                            'name' => $admin['name'],
                            'hod' => $admin['hod'],
                            'booking_type' => $admin['booking_type']
                        ];
                    }
                }

                $response = [
                    'status' => 'success',
                    'selected_booking_type' => $selected_booking_type,
                    'booking_type_options' => array_values($booking_type_options),
                    'users' => $all_users,
                    'logged_in_user_id' => $user_id
                ];
            } else {
                $response['message'] = 'No booking types available for this location.';
            }
        }

        echo json_encode($response);
    }
    
    // display status in company selection
    public function get_company_status()
    {
        $company_id = $this->input->post('company_id');

        $this->db->select('
            company_details.company,
            (CASE 
                WHEN (
                    SELECT COUNT(*) 
                    FROM enquiry 
                    WHERE enquiry.company_id = company.company_id 
                    AND enquiry.status = "confirm"
                ) > 1 THEN "queries-converted"

                WHEN (
                    SELECT COUNT(*) 
                    FROM enquiry 
                    WHERE enquiry.company_id = company.company_id 
                    AND enquiry.status = "confirm"
                ) = 1 THEN "only-one-query-converted"

                WHEN EXISTS (
                    SELECT 1 FROM enquiry 
                    WHERE enquiry.company_id = company.company_id 
                    AND enquiry.status != "confirm"
                ) THEN "query-received-but-not-converted"

                ELSE "no-query"
            END) AS enquiry_status
        ');

        $this->db->join('company', 'company.company_id = company_details.company', 'left');
        $this->db->where('company_details.company', $company_id);

        $result = $this->db->get('company_details')->row();

        echo json_encode($result);
    }
    
    // meal master functions start from here
    // meal master functions start from here
    public function create_meal_master()
    {
        $data['locations'] = $this->db->select('*')->from('countries')->where_in('id', ['11','15','20','81','234','112'])->get()->result_array();
        $data['content'] = 'admin/add_meal_master';
        $this->load->view('admin/layout',$data);
    }

    public function save_meal_master()
    {
        $country = $this->input->post('location');
        $ctype   = $this->input->post('cuisine_type');
        $buffets = $this->input->post('buffet');
        $prices  = $this->input->post('price');
        $remarks = $this->input->post('remarks');
        $childPrice = $this->input->post('childprice');
        $childAgeOption = $this->input->post('child_age_type');

        // Entertainment arrays (grouped by block index)
        $ent_names = $this->input->post('ent_name');   // array of arrays
        $ent_prices = $this->input->post('ent_price');
        $ent_ids = $this->input->post('ent_id');

        if (empty($buffets) || empty($prices)) {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger">No buffet data found</div>');
            redirect('add-meal-price');
        }

        // Check duplicate (existing logic)
        $exists = $this->db
            ->where('country', $country)
            ->where('ctype', $ctype)
            ->where('status', 'active')
            ->get('meal_per_person_cost')
            ->num_rows();

        if ($exists > 0) {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger">
                    Meal Master already exists for this Country and Cuisine Type.
                </div>');
            redirect('add-meal-price');
        }

        $this->db->trans_start();

        // Loop through each buffet row
        foreach ($buffets as $key => $buffet) {
            if (empty($buffet) || empty($prices[$key])) {
                continue;
            }

            // Insert main meal
            $mealData = [
                'country' => $country,
                'ctype'   => $ctype,
                'Buffet'  => $buffet,
                'price'   => $prices[$key],
                'child_price' => $childPrice[$key] ?? 0,
                'child_with_age' => $childAgeOption[$key+1] ?? 'no',
                'remarks' => $remarks[$key] ?? '',
                'status'  => 'active',
                'created' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('meal_per_person_cost', $mealData);
            $mealId = $this->db->insert_id();

            // Insert entertainment for this block (using the same array key)
            if (isset($ent_names[$key]) && is_array($ent_names[$key])) {
                foreach ($ent_names[$key] as $idx => $entName) {
                    $entName = trim($entName);
                    $entPrice = $ent_prices[$key][$idx] ?? 0;
                    if (empty($entName) || empty($entPrice)) {
                        continue;
                    }
                    $entData = [
                        'meal_id' => $mealId,
                        'entertainment_name' => $entName,
                        'price' => $entPrice,
                        'status' => 'active',
                        'created' => date('Y-m-d H:i:s'),
                    ];
                    $this->db->insert('meal_entertainment_cost', $entData);
                }
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger">Failed to add meal data</div>');
        } else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-success">Meal Master added successfully</div>');
        }

        redirect('meal-master-list');
    }

    public function meal_master_list()
    {
        $result = $this->db
        ->select('c.id, c.name as country_name, m.ctype')
        ->from('meal_per_person_cost m')
        ->join('countries c', 'c.id = m.country', 'left')
        ->where('m.status', 'active')
        ->group_by(['m.country', 'm.ctype'])
        ->get()
        ->result_array();

        $data['meals'] = $result;
        $data['content'] = 'admin/meal_master_list';
        $this->load->view('admin/layout',$data);
    }
    
    public function edit_meal_master($country_id, $ctype)
    {
        $data['locations'] = $this->db
            ->where_in('id', ['11','15','20','81','234','112'])
            ->get('countries')
            ->result_array();

        $meals = $this->db
            ->where('country', $country_id)
            ->where('ctype', $ctype)
            ->where('status', 'active')
            ->get('meal_per_person_cost')
            ->result_array();

        // Fetch entertainment for each meal
        foreach ($meals as &$meal) {
            $meal['entertainment'] = $this->db
                ->where('meal_id', $meal['id'])
                ->where('status', 'active')
                ->get('meal_entertainment_cost')
                ->result_array();
        }

        $data['meals'] = $meals;

        $data['content'] = 'admin/edit_meal_master';
        $this->load->view('admin/layout', $data);
    }

    public function delete_meal_row()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id)
                ->update('meal_per_person_cost', [
                    'status' => 'is_deleted',
                ]);

        echo json_encode(['status'=>'success']);
    }

    public function update_meal_master()
    {
        $ids     = $this->input->post('meal_id');
        $buffet  = $this->input->post('buffet');
        $price   = $this->input->post('price');
        $country = $this->input->post('location');
        $ctype   = $this->input->post('cuisine_type');
        $remarks = $this->input->post('remarks');

        $childPrice     = $this->input->post('childprice');
        $childAgeOption = $this->input->post('child_age_type');

        // Entertainment arrays
        $ent_ids   = $this->input->post('ent_id');
        $ent_names = $this->input->post('ent_name');
        $ent_price = $this->input->post('ent_price');

        foreach ($buffet as $i => $name) {

            if (empty($name) || empty($price[$i])) {
                continue;
            }

            $index = $i + 1;

            $data = [
                'Buffet'          => $name,
                'price'           => $price[$i],
                'child_price'     => $childPrice[$i] ?? 0,
                'child_with_age'  => $childAgeOption[$index] ?? 'no',
                'remarks'         => $remarks[$i] ?? '',
                'country'         => $country,
                'ctype'           => $ctype,
                'updated'         => date('Y-m-d H:i:s'),
            ];

            // UPDATE / INSERT MEAL
            if (!empty($ids[$i])) {

                $this->db
                    ->where('id', $ids[$i])
                    ->update('meal_per_person_cost', $data);

                $mealId = $ids[$i];

            } else {

                $data['status']  = 'active';
                $data['created'] = date('Y-m-d H:i:s');

                $this->db->insert('meal_per_person_cost', $data);

                $mealId = $this->db->insert_id();
            }

            // =====================================================
            // ENTERTAINMENT SAVE
            // =====================================================

            if (isset($ent_names[$mealId])) {

                foreach ($ent_names[$mealId] as $k => $entName) {

                    $entName  = trim($entName);
                    $entPrice = $ent_price[$mealId][$k] ?? 0;
                    $entId    = $ent_ids[$mealId][$k] ?? '';

                    if (empty($entName) || empty($entPrice)) {
                        continue;
                    }

                    $saveData = [
                        'meal_id'            => $mealId,
                        'entertainment_name' => $entName,
                        'price'              => $entPrice,
                        'status'             => 'active',
                    ];

                    // UPDATE
                    if (!empty($entId)) {

                        $this->db
                            ->where('id', $entId)
                            ->update('meal_entertainment_cost', $saveData);

                    } else {

                        // INSERT
                        $saveData['created'] = date('Y-m-d H:i:s');

                        $this->db
                            ->insert('meal_entertainment_cost', $saveData);
                    }
                }
            }
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Updated Successfully</div>'
        );

        redirect('meal-master-list');
    }

    public function delete_meal_master($country_id, $ctype)
    {
        // Update all matching rows
        $this->db
            ->where('country', $country_id)
            ->where('ctype', $ctype)
            ->where('status', 'active')
            ->update(
                'meal_per_person_cost',
                ['status' => 'is_deleted']
            );

        // Check affected rows
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Meal master deleted successfully</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning">No active records found</div>'
            );
        }

        redirect('meal-master-list');
    }

    public function getMealsByCountry()
    {
        $countryName = $this->input->post('country');
        $ctype       = $this->input->post('ctype');

        // Handle multiple select values
        if (is_array($ctype)) {
            $ctype = array_map('strtolower', $ctype);
        } else {
            $ctype = [strtolower($ctype)];
        }

        // Get country
        $country = $this->db->where('name', $countryName)
                            ->get('countries')
                            ->row();

        if (!$country) {
            echo json_encode([]);
            return;
        }

        // Fetch meals
        $meals = $this->db
            ->where('country', $country->id)
            ->where_in('ctype', $ctype)
            ->where('status', 'active')
            ->get('meal_per_person_cost')
            ->result();

        echo json_encode($meals);
    }

    // get meal data for meal popup
    // public function getMealsByCountry()
    // {
    //     $countryName = $this->input->post('country');
    //     $ctype       = $this->input->post('ctype');

    //     // normalize ctype (VERY IMPORTANT)
    //     $ctype = strtolower($ctype);

    //     // get country id
    //     $country = $this->db->where('name', $countryName)
    //                         ->get('countries')
    //                         ->row();

    //     if (!$country) {
    //         echo json_encode([]);
    //         return;
    //     }

    //     $meals = $this->db->where('country', $country->id)
    //                     ->where('ctype', $ctype)
    //                     ->where('status', 'active')
    //                     ->get('meal_per_person_cost')
    //                     ->result();

    //     echo json_encode($meals);
    // }

    // public function update_meal_master()
    // {
    //     $ids     = $this->input->post('meal_id');
    //     $buffet  = $this->input->post('buffet');
    //     $price   = $this->input->post('price');
    //     $country = $this->input->post('location');
    //     $ctype   = $this->input->post('cuisine_type');
    //     $remarks = $this->input->post('remarks');
    //     $childPrice = $this->input->post('childprice');
    //     $childAgeOption = $this->input->post('child_age_type');

    //     $ent_ids   = $this->input->post('ent_id');
    //     $ent_price = $this->input->post('ent_price');

    //     $entIndex = 0;

    //     foreach ($buffet as $i => $name) {

    //         if(empty($name) || empty($price[$i])) continue;

    //         if(!empty($ids[$i])) {

    //             $mealId = $ids[$i];

    //             $this->db->where('id', $mealId)->update('meal_per_person_cost',[
    //                 'Buffet'=>$name,
    //                 'price'=>$price[$i],
    //                 'child_price' => $childPrice[$i] ?? 0,
    //                 'child_with_age' => $childAgeOption[$i + 1] ?? 'no',
    //                 'remarks'=>$remarks[$i],
    //                 'country'=>$country,
    //                 'ctype'=>$ctype,
    //                 'updated'=>date('Y-m-d H:i:s'),
    //             ]);

    //         } else {

    //             $this->db->insert('meal_per_person_cost',[
    //                 'Buffet'=>$name,
    //                 'price'=>$price[$i],
    //                 'child_price' => $childPrice[$i] ?? 0,
    //                 'child_with_age' => $childAgeOption[$i + 1] ?? 'no',
    //                 'remarks'=>$remarks[$i],
    //                 'country'=>$country,
    //                 'ctype'=>$ctype,
    //                 'status'=>'active',
    //                 'created'=>date('Y-m-d H:i:s'),
    //             ]);

    //             $mealId = $this->db->insert_id();
    //         }

    //         // =========================
    //         // HANDLE BELLY DANCE
    //         // =========================

    //         if(strtolower(trim($name)) === 'gala dinner'){

    //             if(!empty($ent_price[$entIndex])){

    //                 if(!empty($ent_ids[$entIndex])){

    //                     $this->db->where('id',$ent_ids[$entIndex])
    //                             ->update('meal_entertainment_cost',[
    //                                 'price'=>$ent_price[$entIndex],
    //                             ]);

    //                 } else {

    //                     $this->db->insert('meal_entertainment_cost',[
    //                         'meal_id'=>$mealId,
    //                         'entertainment_name'=>'Belly Dance',
    //                         'price'=>$ent_price[$entIndex],
    //                         'status'=>'active',
    //                         'created'=>date('Y-m-d H:i:s')
    //                     ]);
    //                 }
    //             }

    //             $entIndex++;
    //         }
    //     }

    //     $this->session->set_flashdata('message',
    //         '<div class="alert alert-success">Updated Successfully</div>');
    //     redirect('meal-master-list');
    // }
    // meal master functions End here

    // child-age meal price master code start from here
    public function save_child_age_price()
    {
        $meal_id = $this->input->post('meal_id');
        $from_age = (int)$this->input->post('from_age');
        $to_age   = (int)$this->input->post('to_age');
        $price    = $this->input->post('price');

        // ✅ Validation
        if(!$meal_id || $from_age === '' || $to_age === '' || $price === ''){
            echo json_encode(['status'=>false,'msg'=>'All fields required']);
            return;
        }

        if($from_age >= $to_age){
            echo json_encode(['status'=>false,'msg'=>'From age must be less than To age']);
            return;
        }

        // ✅ Overlap check (CORRECT)
        $exists = $this->db
            ->where('meal_id', $meal_id)
            ->where('status', 'active')
            ->group_start()
                ->where('age_from <', $to_age)
                ->where('age_to >', $from_age)
            ->group_end()
            ->get('meal_child_age_price')
            ->num_rows();

        if($exists > 0){
            echo json_encode([
                'status'=>false,
                'msg'=>'Age range overlaps with existing range'
            ]);
            return;
        }

        // ✅ Insert
        $this->db->insert('meal_child_age_price', [
            'meal_id'   => $meal_id,
            'age_from'  => $from_age,
            'age_to'    => $to_age,
            'price'     => $price,
            'status'    => 'active',
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        // ✅ Update parent flag
        $this->db->where('id', $meal_id)
                ->update('meal_per_person_cost', ['child_with_age'=>'yes']);

        echo json_encode(['status'=>true]);
    }

    public function get_single_age_price()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $data = $this->db->get('meal_child_age_price')->row();
        echo json_encode($data);
    }

    public function get_child_age_price()
    {
        $meal_id = $this->input->post('meal_id');

        $this->db->where('meal_id',$meal_id);
        $this->db->where('status','active');

        $records = $this->db->get('meal_child_age_price')->result();

        foreach($records as $row){

            echo "<tr>

            <td>".$row->age_from."</td>
            <td>".$row->age_to."</td>
            <td>".$row->price."</td>

            <td>

            <i class='fa fa-edit editAge'
            data-id='".$row->id."'
            style='cursor:pointer;color:blue'></i>

            &nbsp;

            <i class='fa fa-trash deleteAge'
            data-id='".$row->id."'
            style='cursor:pointer;color:red'></i>

            </td>

            </tr>";
        }
    }

    public function update_child_age_price()
    {
        $id = $this->input->post('id');
        $meal_id = $this->input->post('meal_id');
        $from = (int)$this->input->post('from_age');
        $to   = (int)$this->input->post('to_age');
        $price = $this->input->post('price');

        if($from >= $to){
            echo json_encode(['status'=>false,'msg'=>'Invalid age range']);
            return;
        }

        // ✅ Overlap check excluding current
        $exists = $this->db
            ->where('meal_id', $meal_id)
            ->where('status','active')
            ->where('id !=', $id)
            ->group_start()
                ->where('age_from <', $to)
                ->where('age_to >', $from)
            ->group_end()
            ->get('meal_child_age_price')
            ->num_rows();

        if($exists > 0){
            echo json_encode([
                'status'=>false,
                'msg'=>'Overlap not allowed'
            ]);
            return;
        }


        $this->db->where('id',$id)->update('meal_child_age_price',[
            'age_from'=>$from,
            'age_to'=>$to,
            'price'=>$price
        ]);

        echo json_encode(['status'=>true]);
    }

    public function delete_child_age_price()
    {
        $id = $this->input->post('id');

        // Get meal_id before delete
        $row = $this->db->where('id',$id)
                        ->get('meal_child_age_price')
                        ->row();

        if(!$row){
            echo json_encode(['status'=>false]);
            return;
        }

        $meal_id = $row->meal_id;

        // Soft delete
        $this->db->where('id',$id)
                ->update('meal_child_age_price',['status'=>'inactive']);

        // ✅ Check if any active records remain
        $active = $this->db->where([
            'meal_id'=>$meal_id,
            'status'=>'active'
        ])->count_all_results('meal_child_age_price');

        // ✅ If none → update parent
        if($active == 0){
            $this->db->where('id',$meal_id)
                    ->update('meal_per_person_cost',['child_with_age'=>'no']);
        }

        echo json_encode(['status'=>true]);
    }
}
