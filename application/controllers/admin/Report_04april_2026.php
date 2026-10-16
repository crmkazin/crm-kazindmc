<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ'],
        'georgia' => ['FGE', 'GGE', 'IGE'],
        'armenia' => ['FAR','GAR','IAR'],
        'uzbekistan' => ['FUZ','GUZ','IUZ'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ']
    ];
    
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
             redirect('login');
        }
        /*
        if($this->session->userdata('type') != 1){
        redirect($_SERVER['HTTP_REFERER']);	    
        } */
        $allowed_users = ['1', '3'];
        // if (!in_array($this->session->userdata('type'), $allowed_users)) {
        //     $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
        //     redirect('dashboard');
        // }

        $this->load->model(['admin/group_model', 'common_model', 'admin/user_model', 'admin/report_model', 'admin/dashboard_model', 'admin/company_model','admin/restaurantmenumaster_model']);
        $this->load->library('pagination');
    }

    // public function enquiry_report()
    // {
    //     $data['enquiry'] = array();
    //     if($this->input->post('submit') == 'Submit'){
    //     $data['enquiry'] = $this->report_model->enquiry_filter();
    //     }
    //     $this->load->view('admin/enquiry_report',$data);
    // }	

    public function edit_client()
    {
        log_user_activity('Database Agents Edit',$this->session->userdata('id'), 'Database: All Company Details: Agents Edit');
        $allowed_userIds = [101, 70];

        $currentId = $this->session->userdata('id');
        $currentType = $this->session->userdata('type');
        if ($this->session->userdata('type') == 3) {
            redirect('clients');
        }

        if ($this->input->post('submit') == 'Submit' && trim($this->input->post('name')) <> '') {
            $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('name'))) . '" AND company_id != "' . $this->input->post('company_id') . '" AND is_deleted ="0"';
            $res_company = $this->common_model->get_data('company', '', '', '*', $where, '', $count = true);
            //echo $this->db->last_query();exit;
            //echo $res_company;exit;
            if ($res_company > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Company with name (' . $this->input->post('name') . ') exists!</div>');
                redirect($this->uri->segment(1) . '/edit-client');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|integer|callback_mobile_unique');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
        $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');
        if ($this->form_validation->run() == FALSE) {

            $this->load->model('admin/group_model');
            $data['client'] = $this->report_model->edit_client();
            $isAdmin = ($currentType == 1);
            $isAllowedUser = in_array($currentId, $allowed_userIds);
            $isOwner = ($data['client']->user_id == $currentId);
           if (!$isAdmin && !$isAllowedUser && !$isOwner) {
            // if ($this->session->userdata('type') != 1 && $data['client']->user_id != $this->session->userdata('id')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
                redirect('clients');
            }
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            $select = 'admin.*';
            $where = 'type IN (5,6) AND status = 1';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            $data['content'] = 'admin/edit_client';
            $this->load->view('admin/layout', $data);
        } else {
            $data['clients'] = $this->report_model->update_client();
        }

    }

    public function edit_company()
    {
        log_user_activity('Database Edit Company Details',$this->session->userdata('id'), 'Database: Edit Compnay Details ');
        if ($this->session->userdata('type') == 3) {
            redirect('clients');
        }

        $company_id = $this->uri->segment(1);

        $select = 'company.*';
        $where = 'company.is_deleted != "1" AND company.company_id = "' . $company_id . '"';
        $data['company'] = $this->common_model->get_data('company', '', '', $select, $where, '', '');

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('gst', 'GST', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'admin/edit_company';
            $this->load->view('admin/layout', $data);
        } else {
            $id = $this->input->post('id');

            $this->db->select('*');
            $this->db->where('id', $id);
            $previous = $this->db->get('company')->row();

            $update_arr = ['name' => $this->input->post('name'), 'country' => $this->input->post('country'), 'state' => $this->input->post('state'), 'city' => $this->input->post('city'), 
            'address' => $this->input->post('address'),'address_2' => $this->input->post('address_2'),
            //'address_3' => $this->input->post('address_3'),
            'pincode' => $this->input->post('pincode'),
            'gstin' => $this->input->post('gst'),'modified'=>date('Y-m-d H:i:s'),'status' => $this->input->post('status'),];
            $update_data = ['table_name' => 'company', 'update_data' => $update_arr, 'condition' => ['id' => $id]];

            $updated = $this->common_model->update_data_limit($update_data);

            if (!$updated) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($company_id . '/edit-company');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            $previous_data = array(
                'name' => $previous->name,
                'county' => $previous->country,
                'state' => $previous->state,
                'city' => $previous->city,
                'pincode' => $previous->pincode,
                'address' => $previous->address,
                'address_2' => $previous->address_2,
                'gstin' => $previous->gstin,
            );
            log_user_activity('Database Company Details Update', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
            redirect($company_id . '/edit-company');
        }

    }

    public function email_unique()
    {
        $where = ' status != "deleted" AND email = "' . $this->input->post('email') . '"';
        if ($this->uri->segment(2) <> '' && $this->uri->segment(2) == 'edit-client') {
            $where = ' status != "deleted" AND email = "' . $this->input->post('email') . '" AND company_id != ' . $this->uri->segment(1);
        }
        $select = 'company_id';
        $count = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true);
        if ($count) {
            return false;
        } else {
            return true;
        }
    }

    public function mobile_unique()
    {
        $where = ' status != "deleted" AND contact_person_number = "' . $this->input->post('contact_number') . '"';
        if ($this->uri->segment(2) <> '' && $this->uri->segment(2) == 'edit-client') {
            $where = ' status != "deleted" AND contact_person_number = "' . $this->input->post('contact_number') . '" AND company_id != ' . $this->uri->segment(1);
        }
        $select = 'company_id';
        $count = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true);
        if ($count) {
            return false;
        } else {
            return true;
        }
    }


    public function pending_enquiry()
    {
        $data['enquiry'] = $this->report_model->pending_enquiry();
        $data['content'] = 'admin/pending_enquiry';
        $this->load->view('admin/layout', $data);
    }


    public function get_agents()
    {
        $this->db->select('company_id,contact_person AS label');
        $this->db->where("contact_person like '%" . $this->input->post('search') . "%' ");
        $this->db->order_by('contact_person', 'DESC');
        $result = $this->db->get('company_details');
        $result = $result->result();
        echo json_encode($result);
    }

    public function agentwise_report()
    {
        $data['enquiry'] = array();
        $data['locations'] = $this->locations;
        if ($this->input->post('submit') == 'Submit') {
            $data['enquiry'] = $this->report_model->agentwise_report();
        }
        $data['content'] = 'admin/agentwise_report';
        $this->load->view('admin/layout', $data);
    }

    //march 28

    public function enquiry_report()
    {
        if (!empty($this->input->get('submit'))) 
            {
                $Search_data = [
                    'booking_type'   => $this->input->get('booking_type'),
                    'location'       => $this->input->get('location'),
                    'date_from'      => $this->input->get('date_from'),
                    'date_to'        => $this->input->get('date_to'),
                    'staff_id'       => $this->input->get('staff_id'),
                    'sales'          => $this->input->get('sales'),
                    'agent'          => $this->input->get('agent'),
                    'company_id'     => $this->input->get('company_id'),
                    'city'           => $this->input->get('city'),
                    'state'          => $this->input->get('state'),
                    'country'        => $this->input->get('country'),
                    'status'            => $this->input->get('status'),
                ];
                log_user_activity('Query Report Search', $this->session->userdata('id'), 'Search: '. json_encode($Search_data));
            
            }
            
        $data['locations'] = $this->locations;        
        $this->db->select('company.company_id,company.name,COUNT(enquiry.id) AS file_cnt');
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
        $this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
        
        if (!empty($this->input->get('status'))) {
            $status = urldecode($this->input->get('status'));
            $this->db->where('enquiry.status', $status);
        }

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'All' && $this->input->get('location') <> 'all') {
                $this->db->where_in('enquiry.enquiry_abbr', $this->locations[$this->input->get('location')]);
            } else if ($booking_type != 'All') {
                $this->db->where('enquiry.enquiry_abbr', $booking_type);
            }
        }
        if (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) {
            $date_from = date('Y-m-d', strtotime($this->input->get('date_from')));
            $date_to = date('Y-m-d', strtotime($this->input->get('date_to')));
            $this->db->where('enquiry.query_received_date >=', $date_from);
            $this->db->where('enquiry.query_received_date <=', $date_to);
        }
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $staff_id = urldecode($this->input->get('staff_id'));
            $this->db->where('enquiry.file_handle_by', $staff_id);
        }
        if (!empty($this->input->get('sales'))) {
            $sales = urldecode($this->input->get('sales'));
            $this->db->where('enquiry.sales_admin_id', $sales);
        }
        
        if (!empty($this->input->get('agent'))) {
            $agent = urldecode($this->input->get('agent'));
            $this->db->where('company_details.company_id', $agent);
        }
        if ($this->input->get('country') <> '') {
            $this->db->where('LOWER(company_details.country)', strtolower(trim($this->input->get('country'))));
        }
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $this->db->where_in('LOWER(company_details.state)', $str_state);
        }
        if ($this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $this->db->where_in('LOWER(company_details.city)', $str_city);            
        }
        if(!empty($this->input->get('company_id'))){
            $this->db->where('enquiry.company_id', $this->input->get('company_id'));
        }
        
        $this->db->group_by('enquiry.company_id');
        
        $qry_num_rows = $this->db->get_compiled_select('enquiry', FALSE);
        if($this->input->get('excel_download')== '1')
        {
            log_user_activity('Query Report Excel Export',$this->session->userdata('id'), 'Query Report: Excel Export');
            $result = $this->common_model->custom_query($qry_num_rows);
            $this->enquiry_excel_download($result);        
        }
            $result_cnt = count($this->common_model->custom_query($qry_num_rows));
        
            

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'enquiry-report?' . $search[0];
        $config["total_rows"] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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
        $this->pagination->initialize($config);
        
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $qry = $this->db->limit($config["per_page"],$offset)->get_compiled_select();
        $data['enquiry'] = $this->common_model->custom_query($qry);
        $data['offset'] = $offset;
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        
        $query = 'SELECT admin.id,admin.name FROM admin WHERE admin.type=5 AND status != "0"';
        $data['sales_team'] = $this->common_model->custom_query($query);
        
        // echo "<pre>";
        // print_r($data['enquiry']);
        // exit;
        log_user_activity('Query Report View',$this->session->userdata('id'), 'Query Report: View');
        $data['content'] = 'admin/enquiry_report';
        $this->load->view('admin/layout', $data);
    }
    
    public function get_query_files(){
        
        $this->form_validation->set_rules('c_id', 'Company', 'trim|required');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $company_id = $this->input->post('c_id');
        
        $this->db->select('enquiry.*,company_details.contact_person,admin.name');
        $this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', '');        
        $this->db->join('admin', 'admin.id = enquiry.sales_admin_id', 'LEFT');
        
        $this->db->where('enquiry.company_id', $company_id);
        
        if (!empty($this->input->post('status'))) {
            $status = urldecode($this->input->post('status'));
            $this->db->where('enquiry.status', $status);
        }

        if (!empty($this->input->post('booking_type'))) {
            $booking_type = urldecode($this->input->post('booking_type'));
            if ($booking_type == 'All' && $this->input->post('location') <> 'all') {
                $this->db->where_in('enquiry.enquiry_abbr', $this->locations[$this->input->post('location')]);
            } else if ($booking_type != 'All') {
                $this->db->where('enquiry.enquiry_abbr', $booking_type);
            }
        }
        if (!empty($this->input->post('date_from')) && !empty($this->input->post('date_to'))) {
            $date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
            $date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
            $this->db->where('enquiry.query_received_date >=', $date_from);
            $this->db->where('enquiry.query_received_date <=', $date_to);
        }
        if (!empty($this->input->post('staff_id')) && $this->input->post('staff_id') != 'all') {
            $staff_id = urldecode($this->input->post('staff_id'));
            $this->db->where('enquiry.file_handle_by', $staff_id);
        }
        if (!empty($this->input->post('sales'))) { 
            $sales = $this->input->post('sales');
            $this->db->where('enquiry.sales_admin_id', $sales);
        }
        if (!empty($this->input->post('agent'))) {
            $agent = urldecode($this->input->post('agent'));
            $this->db->where('company_details.company_id', $agent);
        }
        if ($this->input->post('country') <> '') {
            $this->db->where('LOWER(company_details.country)', strtolower(trim($this->input->post('country'))));
        }
        if ($this->input->post('state') <> '') {
            $state = strtolower(urldecode($this->input->post('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $this->db->where_in('LOWER(company_details.state)', $str_state);
        }
        if ($this->input->post('city') <> '') {
            $city = strtolower(urldecode($this->input->post('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $this->db->where_in('LOWER(company_details.city)', $str_city);            
        }
        $this->db->order_by('enquiry.id', 'DESC');
        //$this->db->group_by('enquiry.company_id');
        $files = $this->db->get('enquiry')->result();
        //echo $this->db->last_query();exit;
        echo json_encode(['response'=>'s','details'=>$files, 'msg'=> '']);
        exit;
    }
    
    public function enquiry_excel_download($result){
        
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Total Files');
        if($this->input->get('status')<>''){
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Status');
        }
        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $list) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, ($list->name=='')?'B2C Sales':$list->name);                
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $list->file_cnt);
                if($this->input->get('status')<>''){
                    $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, ucfirst($this->input->get('status')));
                }
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'Enquiry-report_' . date('d-M-Y') . '.xls' . '"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        exit;        
    }
    
    public function arrivals_report()
    {
        $data['locations'] = $this->locations;
        $where = '';
        if ($this->input->get('submit') == '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
        }

        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'date(arrivals.arrival_date) >="' . $this->input->get('date_from') . '" AND date(arrivals.arrival_date) <="' . $this->input->get('date_to') . '"';
        }
        if ($this->input->get('status') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
        }
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
        }
        if ($this->input->get('company_id') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.company_id = "' . urldecode($this->input->get('company_id')) . '"';
        }
        if ($this->input->get('transport') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.transportation_id = "' . urldecode($this->input->get('transport')) . '"';
        }
        if ($this->input->get('guide') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.guide_id = "' . urldecode($this->input->get('guide')) . '"';
        }

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'All' && $this->input->get('location') <> 'all') {
                $loc = implode('","', $this->locations[$this->input->get('location')]);
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $loc . '")';
                //$this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
            } else if ($booking_type != 'All') {
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . 'enquiry.enquiry_abbr = "' . $booking_type . '"';
                //$this->db->where('enquiry.enquiry_abbr',$booking_type);	
            }
        }

        $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
        if ($this->input->get('country') <> '') {
            $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "' . urldecode($this->input->get('country')) . '"';
        }
        if ($this->input->get('query_number') <> '') {
            $enquiry_join .= ' AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '"';
        }

        $select = 'arrivals.*,transportation.vehicle_type,guides.name AS guide,enquiry.enquiry_no,enquiry.number_child,enquiry.number_of_nights,enquiry.check_in_date,enquiry.check_out_date,enquiry.sales_admin_id,admin.name AS staff_name,company.name';
        $join = [
            ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
        ];

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'get-arrivals-report/?' . $search[0];

        $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where, '', $count = true, $join);
        $result_cnt = $config["total_rows"];
        $data['total'] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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
        $data['enquiry'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' ORDER BY arrivals.arrival_date ASC', $count = false, $join);
        // echo "<pre>";
        // print_r($data['enquiry']);
        // exit;
        $data['links'] = $this->pagination->create_links();
        $data['content'] = 'admin/arrivals_report';
        $this->load->view('admin/layout', $data);
    }

    public function get_transportation()
    {
        $data_arr = array(
            'table_name' => 'transportation',
            'condition' => array('status' => 'active') // Example condition
        );

        $data = $this->common_model->get_rows($data_arr);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }

    public function get_guide()
    {
        $data_arr = array(
            'table_name' => 'guides',
            'condition' => array('status' => 'active') // Example condition
        );

        $data = $this->common_model->get_rows($data_arr);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }

    public function monitoring_report()
    {
        if ($this->session->userdata('type') != 1 && !in_array($this->session->userdata('admin_type'), ['accounts_admin'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $query_string = $_SERVER['QUERY_STRING'];

        $data['locations'] = $this->locations;

        $result = [];
        $result_cnt = 0;
        $filter_count = 0;

        
        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'monitoring-report?' . $search[0];

        if ($result_cnt > 1) {
            $config["total_rows"] = $result_cnt;
        }
        $config["total_rows"] = $filter_count;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;

        if ($query_string) {
            $response = $this->report_model->all_report_data($config["per_page"], $offset, $data['locations']);
            $data['enquiry'] = $response['result'];
        } else {
            $data['enquiry'] = [];
        }
        
        if ($query_string) {

            //$result = $this->report_model->count_all_reports($data['locations']);
            $result = $response['counts'];
            $data['total_files'] = $result['total_files'];
            $data['progress_files'] = $result['in_progress_files'];
            $data['confirm_files'] = $result['confirm_files'];
            $data['cancelled_files'] = $result['cancelled_files'];
            $data['closed_files'] = $result['closed_files'];

            $result_cnt = $result['row_count'];
            $filter_count = $result['filter_count'];
        }
        
        
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        $data['filter_count'] = $filter_count;

        $select = 'admin.*';
        $where = 'admin.type = "5"';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        $data['content'] = 'admin/monitoring_report';
        $this->load->view('admin/layout', $data);
    }

    public function itinerary_report()
    {
        $data['locations'] = $this->locations;
        $select = 'DISTINCT enquiry.number_of_nights';
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id']];
        $data['nights'] = $this->common_model->get_data('enquiry', '', '', $select, '', '', $count = false, $join);
    
        $data['result'] = '';
        $data['title'] = '';
    
        if ($this->input->get('submit') != '') {
            $search_data = [
                'title' => $this->input->get('title'),
                'not_in_title'         => $this->input->get('not_in_title'),
                'no_of_nights'         => $this->input->get('no_of_nights'),
                'location'         => $this->input->get('location'),
            ];
            log_user_activity('Itinerary Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));

            if ($this->input->get('title') == '' && $this->input->get('not_in_title') == '') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Select At Least One Title or Not In Title.</div>');
                log_user_activity('Report Itinerary Report',$this->session->userdata('id'), 'Error (Select At Least One Title or Not In Title.)');
                redirect('itinerary-report');
            }
    
            $this->db->select('itinerary.title, itinerary.sites_id, enquiry.enquiry_abbr, enquiry.number_of_nights, itinerary.arrival_id');
            $this->db->select('itinerary.time');
            $this->db->from('itinerary');
            $this->db->join('arrivals', 'arrivals.id = itinerary.arrival_id');
            $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id');
            $this->db->where('itinerary.status !=', 'deleted');
            $this->db->where('itinerary.date >=', '2024-09-01');
            $this->db->where('itinerary.title !=', '');
            $this->db->where('itinerary.sites_id !=', '0');
    
            // Filter by number of nights
            if ($this->input->get('no_of_nights') != '') {
                $this->db->where('enquiry.number_of_nights', urldecode($this->input->get('no_of_nights')));
            }
    
            // Filter by location
            if ($this->input->get('location') != '') {
                $loc = $this->locations[$this->input->get('location')];
                $this->db->where_in('enquiry.enquiry_abbr', $loc);
            }
    
            // Collect arrival_ids for inclusion and exclusion titles
            $arrival_ids_included = [];
            $arrival_ids_excluded = [];
    
            // Handle inclusion titles
            if (!empty($this->input->get('title'))) {
                $titles = $this->input->get('title'); // Titles is an array of site_ids
                $sites_count = count($titles); // Number of sites to check against
                
                // Build a query to find arrival_ids where every site_id from the input is present
                $query1 = 'SELECT itinerary.arrival_id
                           FROM itinerary 
                           JOIN arrivals ON arrivals.id = itinerary.arrival_id 
                           JOIN enquiry ON enquiry.id = arrivals.enquiry_id 
                           WHERE itinerary.status != "deleted" 
                           AND itinerary.date >= "2024-09-01" 
                           AND itinerary.sites_id IN (' . implode(',', $titles) . ') 
                           GROUP BY itinerary.arrival_id 
                           HAVING COUNT(DISTINCT itinerary.sites_id) = ' . $sites_count;
  
                
                // Execute the query
                $ids = $this->common_model->custom_query($query1);
                      
                // echo "<br><br><br><br>";
                // print_r($ids);

                if (!empty($ids)) {
                    foreach ($ids as $list1) {
                        $arrival_ids_included[] = $list1->arrival_id;
                    }
                }
            }
    
            // Handle exclusion titles
            if (!empty($this->input->get('not_in_title'))) {
                $titles = $this->input->get('not_in_title'); // Titles is an array of site_ids to exclude
                
                // Build a query to find arrival_ids where any site_id from the exclusion list is present
                $query2 = 'SELECT itinerary.arrival_id
                           FROM itinerary 
                           JOIN arrivals ON arrivals.id = itinerary.arrival_id 
                           JOIN enquiry ON enquiry.id = arrivals.enquiry_id 
                           WHERE itinerary.status != "deleted" 
                           AND itinerary.date >= "2024-09-01" 
                           AND itinerary.sites_id IN (' . implode(',', $titles) . ') 
                           GROUP BY itinerary.arrival_id';
                
                // Execute the query
                $ids = $this->common_model->custom_query($query2);

                // echo "<br><br><br><br>";
                // print_r($ids);
                
                if (!empty($ids)) {
                    foreach ($ids as $list1) {
                        $arrival_ids_excluded[] = $list1->arrival_id;
                    }
                }
            }
            
            // Apply filters based on included and excluded arrival_ids
            if (!empty($arrival_ids_included)) {
                $this->db->where_in('itinerary.arrival_id', $arrival_ids_included);
            } else {
                // If inclusion titles are specified and no arrival_ids were included, return no results
                $this->db->where('1 = 0');
            }
            if (!empty($arrival_ids_excluded)) {
                $this->db->where_not_in('itinerary.arrival_id', $arrival_ids_excluded);
            }
    
            $this->db->group_by('itinerary.arrival_id');
            $this->db->order_by('itinerary.id', 'DESC');
            $query = $this->db->get();
    
            // Debugging
            // echo "<br><br><br><br>";
            // echo $this->db->last_query();
    
            $data['result'] = $query->result();
            $data['title'] = $this->input->get('title') ?: [];
        }
        log_user_activity('Itinerary Report View',$this->session->userdata('id'), 'Itinerary Report: View');
        $data['content'] = 'admin/itinerary_report';
        $this->load->view('admin/layout', $data);
    }

    public function print_itinerary_view()
    {

        if ($this->input->get('arrival_id') == '' || !is_numeric(base64_decode($this->input->get('arrival_id')))) {
            redirect('arrivals');
        }
        $arrival_id = base64_decode($this->input->get('arrival_id'));

        $select = 'enquiry.*';
        $where = 'itinerary.arrival_id= ' . $arrival_id . ' AND itinerary.status != "deleted"';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.id = itinerary.arrival_id'],
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id']
        ];
        $data['data'] = $this->common_model->get_data('itinerary', '', '', $select, $where, '', $count = false, $join);


        $where = 'itinerary.arrival_id= ' . $arrival_id . ' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, ' ORDER BY itinerary.date,itinerary.time ASC', $count = false);
        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);

        // echo "<pre>";
        // print_r($data['itinerary']);
        // exit;

        if ($this->input->get('print') == 'pdf') {
            log_user_activity('Itinerary Voucher: Save As PDF',$this->session->userdata('id'), 'Report: Itinerary Vouvher: Save As PDF');
            // $data['content'] = 'admin/print_itinerary_report_pdf';
            $this->load->view('admin/print_itinerary_report_pdf', $data);
        } else {
            log_user_activity('Itinerary Voucher: View',$this->session->userdata('id'), 'Report: Itinerary Voucher: View');
            // $data['content'] = 'admin/print_itinerary_view';
            $this->get_company_name($data);
            $this->load->view('admin/print_itinerary_view', $data);
        }
    }


     public function get_company_name($data)
    {
        $this->session->set_userdata([
            'itinerary'   => $data['itinerary'],
            'data'        => $data['data'],
        ]);

    }

    public function sendPdfOnWhatsapp()
    {
        $encoded_id = $this->input->post('id');
        $id = base64_decode($encoded_id);
        $itinerary = $this->session->userdata('itinerary');
        $data = $this->session->userdata('data');
        $arrival_id = $itinerary[0]->arrival_id;
        $enquiry_abbr = $data[0]->enquiry_abbr;

        // Calculate $stays and $locations as required
        $stays = $data[0]->number_of_nights + 1;
        $this->session->set_userdata('stays', $stays);

        // Country abbreviation mapping
        $locations_data = $this->locations;

        $location = ''; // this will store country name like 'belarus'

        foreach ($locations_data as $country => $abbr_list) {
            if (in_array($enquiry_abbr, $abbr_list)) {
                $location = $country;
                break;
            }
        }

        if (empty($location)) {
            show_error('No matching location found for the enquiry abbreviation.');
            return;
        }
        $this->session->set_userdata('locations', $location);

        // Run the query
        $query = $this->db->query("
            SELECT * 
            FROM itinerary 
            LEFT JOIN arrivals ON itinerary.arrival_id = arrivals.id 
            WHERE itinerary.arrival_id = $arrival_id
        ");

        // Fetch result
        $result = $query->result();
        $country_code = $result[0]->lead_isd_code;
        $contact_number = $result[0]->lead_contact;
        $lead_num = $country_code.$contact_number;

        $manual_number = $this->input->post('contact_number');
        $to = !empty($manual_number) ? $manual_number : '';

        require_once FCPATH.'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $session_data = [
            'itinerary'      => $itinerary,
            'data'           => $data,
            'stays'      => $this->session->userdata('stays'),
            'locations'           => $this->session->userdata('locations'),
        ];
        // Load the view and get HTML as string
        $html = $this->load->view('admin/print_itinerary_report_pdf1', $session_data, true);
        $mpdf->WriteHTML($html);

        $pdf_filename = 'itinerary_' . $arrival_id . '_' . time() . '.pdf';
        $pdf_path = FCPATH . 'uploads/itinerary_report_pdf/' . $pdf_filename;

        $mpdf->Output($pdf_path, \Mpdf\Output\Destination::FILE);

        // Store in DB
        $this->db->insert('itinerary_pdf_table', [
            'arrival_id' => $arrival_id,
            'file_name'  => $pdf_filename,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Pass actual generated PDF filename to WhatsApp send function
        $this->send_service_voucher($to, $pdf_filename);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'PDF created and sent successfully.',
                'pdf_name' => $pdf_filename
            ]));
    }

    public function send_service_voucher($contact_number, $pdf_filename)
    {
        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
        $to = $contact_number;
        // $to = $contact_number;
        $server_link = base_url('uploads/itinerary_report_pdf/' . $pdf_filename);
        $parameters = [
            ['type' => 'text', 'text' => 'Sir/Mam'],
            ['type' => 'text', 'text' => $server_link]
        ];
    
        $headers = [
            'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
            'wabaid: 589332984253812',
            'phone_number_id: 546659848533061',
            'Content-Type: application/json'
        ];
    
        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => 'itinerary_reports',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => $parameters,
                    ]
                ]
            ]
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        log_message('info', "WhatsApp PDF sent to: $contact_number | File: $pdf_filename");
        log_message('info', "WhatsApp API response: " . $response);
    }

    // public function viewItineraryPdf()
    // {
    //     $itinerary = $this->session->userdata('itinerary');
    //     $data = $this->session->userdata('data');

    //     $enquiry_abbr = $data[0]->enquiry_abbr;

    //     if (empty($itinerary) || empty($data)) {
    //         show_error('Session data missing. Please regenerate the itinerary.');
    //         return;
    //     }

    //     // Calculate $stays and $locations as required
    //     $stays = $data[0]->number_of_nights + 1;

    //     // Country abbreviation mapping
    //     $locations_data = [
    //         'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
    //         'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
    //         'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
    //         'georgia'    => ['FGE', 'GGE', 'IGE'],
    //     ];

    //     $location = ''; // this will store country name like 'belarus'

    //     foreach ($locations_data as $country => $abbr_list) {
    //         if (in_array($enquiry_abbr, $abbr_list)) {
    //             $location = $country;
    //             break;
    //         }
    //     }

    //     if (empty($location)) {
    //         show_error('No matching location found for the enquiry abbreviation.');
    //         return;
    //     }

    //     $locations = $location;
        
    //     $this->load->view('admin/print_itinerary_report_pdf1', [
    //         'itinerary' => $itinerary,
    //         'data' => $data,
    //         'stays' => $stays,
    //         'locations' => $locations,
    //         'char' => $char
    //     ]);
    // }


    public function get_agent_ajax($id)
    {
        $company_id = $this->uri->segment(2);
        $escaped_company_id = $this->db->escape($company_id);
        $where = "company_details.company = $escaped_company_id";
        $data = $this->common_model->get_data('company_details', '', '', '*', $where, '', $count = false);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

    // public function get_sales_ajax()
    // {
    //     $where = "admin.type = 5";
    //     $data = $this->common_model->get_data('admin', '', '', '*', $where, '', $count = false);
    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }

    // 13 May

    public function get_sales_ajax($id)
    {
        $company_id = $this->uri->segment(2);
        $select = 'DISTINCT enquiry.company_id,admin.*';
        $escaped_company_id = $this->db->escape($company_id);
        $join = [
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = enquiry.sales_admin_id'],
        ];
        $where = 'enquiry.company_id = ' . $escaped_company_id . ' AND enquiry.sales_admin_id != "0"';

        $data = $this->common_model->get_data('enquiry', '', '', $select, $where, '', $count = false, $join);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

    public function edit_client_logo()
    {
        $data['client'] = $this->report_model->edit_client();

        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
        if ($this->session->userdata('type') == 3) {
            redirect('clients');
        }
        
        $userType  = $this->session->userdata('type');
        $userId    = $this->session->userdata('id');
        $userEmail = strtolower($this->session->userdata('email'));

        $allowedEmails = [
            'uz.backoffice@kazindmc.com',
            'bo.geo@kazindmc.com'
        ];
        
        if (!in_array($userType, ['1']) && !in_array($userEmail, $allowedEmails)) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
            redirect('clients');
        }
        
        // if ($this->session->userdata('type') != 1 && $data['client']->user_id != $this->session->userdata('id')) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
        //     redirect('clients');
        // }
        if ($this->input->post('submit') <> '') {
            $filename = '';
            $company_id = trim($this->input->post('company_id'));
            
            $this->db->select('company_logo');
            $this->db->where('company_id', $company_id);
            $previous_logo = $this->db->get('company')->row()->company_logo;
            
            if ($_FILES['company_logo']['name'] != '') {
                $this->load->library('upload');
                $config['upload_path'] = './assets/company/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '200';
                $config['max_height'] = '200';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['company_logo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('company_logo')) {
                    //echo $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    log_user_activity('Database Company Logo Update', $this->session->userdata('id'), $this->upload->display_errors() );
                    redirect(base_url($data['client']->company_id . '/edit-client-logo'));
                } else {
                    $file = $this->upload->data();
                    $filename = $file['file_name'];
                    $data = array(
                        //'name' => ucwords(strtolower($this->input->post('name'))),
                        'company_logo' => $filename
                    );
                    $this->db->where('company_id', trim($this->input->post('company_id')));
                    $this->db->update('company', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                    
                    $previous_data = array(
                        'company_id' => $company_id,
                        'previous_logo' => $previous_logo,
                    );
                    log_user_activity('Database Company Logo Update', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
                    redirect('clients');
                }
            }
        }
        log_user_activity('Database Edit Company Logo', $this->session->userdata('id'), 'Database: Edit Company Logo');
        $data['content'] = 'admin/edit_client_logo';
        $this->load->view('admin/layout', $data);
    }

    public function get_site_titles()
    {
        $country = $this->input->post('country');
        $select = 'DISTINCT itinerary.sites_id as id, sites.site_name';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'sites', 'condition' => 'sites.id = itinerary.sites_id'],
        ];
        $where = 'sites.country = "' . $country . '" AND sites.status != "deleted" ';
        $sites_names = $this->common_model->get_data('itinerary', '', '', $select, $where, '', $count = false,$join);
        $response = ['response' => 's', 'details' => $sites_names, 'msg' => ''];
        echo json_encode($response);
        exit;
    }

    // old 07 jan 2026
    // public function vendor_report()
    // {
    //     $data['locations'] = $this->locations;

    //     if ($this->input->get('location') <> '') {
    //         $location = trim($this->input->get('location'));
    //     }
        
    //     $where1 = ' AND arrivals.status IN("complete","file-closed","in-progress") ';
    //     if ($this->input->get('hotel') <> '' && is_numeric($this->input->get('hotel'))) {
    //         $id = trim($this->input->get('hotel'));
    //         $where1 .= ' AND arrival_room_details.hotel_id =' . $id;
    //     }
    //     $where2 = '';
    //     if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //         $where2 = ' AND (date(arrival_room_details.checkin_date) >="' . trim($this->input->get('date_from')) . '" AND date(arrival_room_details.checkout_date) <="' . trim($this->input->get('date_to')) . '")';
    //     }
    //      $city = trim($this->input->get('city'));
    //     $city = rtrim($city, ','); 
    //     $where3 = '';
    //     if (!empty($city)) {
    //         $city = $this->db->escape_str($city);
    //         $where3 = ' AND hotels.city = "' . $city . '" ';
    //     }
    //     $state = trim($this->input->get('state'));
    //     $state = rtrim($state, ','); 
    //     $where4 = '';
    //     if (!empty($state)) {
    //         $state = $this->db->escape_str($state);
    //         $where4 = ' AND hotels.state = "' . $state . '" ';
    //     }
    //     $data['links'] = '';
    //     $data['total'] = 0;
    //     if ($this->input->get('submit') <> '') {
    //         $search_data = [
    //             'location' => $this->input->get('location'),
    //             'state' => $this->input->get('state'),
    //             'city' => $this->input->get('city'),
    //             'hotel'    => $this->input->get('hotel'),
    //             'date_from' => $this->input->get('date_from'),
    //             'date_to'   =>$this->input->get('date_to'),
    //         ];
    //         log_user_activity('Hotel Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));

    //         if(empty($location)){ exit; }
    //         $query = 'SELECT t.hotel_id,t.name,t.address_1,t.city,t.state,t.country,SUM(t.num_nights) AS number_nights FROM

    //         (SELECT DATEDIFF(arrival_room_details.checkout_date,arrival_room_details.checkin_date) AS num_nights,arrival_room_details.hotel_id, hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country,enquiry.enquiry_no,
    //         if(arrival_persons_details.category="adult",count(DISTINCT LOWER(replace(trim(arrival_persons_details.first_name)," ","")),LOWER(replace(trim(arrival_persons_details.last_name)," ",""))),"") as cnt_adult,
    //         if(arrival_persons_details.category!="adult",count(DISTINCT LOWER(replace(trim(arrival_persons_details.first_name)," ","")),LOWER(replace(trim(arrival_persons_details.last_name)," ",""))),"") as cnt_child 
    //         FROM arrival_room_details LEFT JOIN hotels ON hotels.id = arrival_room_details.hotel_id 
    //         LEFT JOIN enquiry ON enquiry.id = arrival_room_details.enquiry_id 
    //         LEFT JOIN arrival_persons_details ON arrival_persons_details.arrival_room_details_id = arrival_room_details.id  
    //         JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
    //         WHERE LEFT(enquiry.enquiry_abbr,1) != "G" AND LOWER(hotels.country) = "' . $location . '" ' . $where1 . $where2. $where3. $where4. '
            
    //         GROUP BY arrival_persons_details.arrival_room_details_id order by arrival_room_details.enquiry_id
    //         ) AS t GROUP BY t.hotel_id';
            
    //         if($this->input->get('report_type') == 'group'){
    //             $query = 'SELECT t.hotel_id,t.name,t.address_1,t.city,t.state,t.country,SUM(t.num_nights) AS number_nights FROM

    //             (SELECT DATEDIFF(arrival_room_details.checkout_date,arrival_room_details.checkin_date)*arrival_room_details.number_of_rooms  AS num_nights,arrival_room_details.hotel_id, hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country,enquiry.enquiry_no
    //             FROM arrival_room_details LEFT JOIN hotels ON hotels.id = arrival_room_details.hotel_id LEFT JOIN enquiry ON enquiry.id = arrival_room_details.enquiry_id JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
    //             WHERE LEFT(enquiry.enquiry_abbr,1) = "G" AND LOWER(hotels.country) = "' . $location . '" ' . $where1 . $where2. $where3. $where4. '
    //             order by arrival_room_details.enquiry_id ) AS t GROUP BY t.hotel_id';
    //         }
            
    //         if ($this->input->get('report_type') == 'all') {
    //             $query = '
    //             SELECT t.hotel_id, t.name, t.address_1, t.city, t.state, t.country, SUM(t.num_nights) AS number_nights FROM (
                    
    //                 SELECT 
    //                     DATEDIFF(arrival_room_details.checkout_date, arrival_room_details.checkin_date) * 
    //                     IFNULL(arrival_room_details.number_of_rooms, 1) AS num_nights,
    //                     arrival_room_details.hotel_id,
    //                     hotels.name,
    //                     hotels.address_1,
    //                     hotels.city,
    //                     hotels.state,
    //                     hotels.country,
    //                     enquiry.enquiry_no
    //                 FROM arrival_room_details
    //                 LEFT JOIN hotels ON hotels.id = arrival_room_details.hotel_id
    //                 LEFT JOIN enquiry ON enquiry.id = arrival_room_details.enquiry_id
    //                 JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //                 WHERE LOWER(hotels.country) = "' . $location . '"
    //                 ' . $where1 . $where2 . $where3. $where4. '

    //             ) AS t
    //             GROUP BY t.hotel_id
    //             ';
    //         }
            
    //         //echo $query;
    //         if($this->input->get('excel_download')== '1'){
    //             log_user_activity('Hotel Report Excel Download',$this->session->userdata('id'), 'Hotel Report Excel Downloaded');
    //             $result = $this->common_model->custom_query($query);
    //             $this->vendor_excel_download($result);
                

    //         }
    //         $total_rows = $this->db->query($query)->num_rows();

    //         $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //         $config = array();
    //         $config["base_url"] = base_url() . 'vendor-report?' . $search[0];

    //         $config["total_rows"] = $total_rows;
    //         $config["per_page"] = 10;
    //         $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //         $config['full_tag_close'] = '</ul>';
    //         $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['first_tag_close'] = '</li>';
    //         $config['prev_link'] = 'Previous';
    //         $config['next_link'] = 'Next';
    //         $config['next_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['next_tag_close'] = '</li>';
    //         $config['last_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['last_tag_close'] = '</li>';
    //         $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
    //         $config['cur_tag_close'] = '</a></li>';
    //         $config['num_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['num_tag_close'] = '</li>';
    //         $config['page_query_string'] = TRUE;
    //         $this->pagination->initialize($config);
    //         $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //         $data['offset'] = $offset;

    //         $query .= ' LIMIT ' . $offset . ', ' . $config["per_page"];
    //         $data['vendor_report'] = $this->common_model->custom_query($query);
    //         //echo $this->db->last_query();exit;
    //         //echo '<pre>';print_r($data['vendor_report']);exit;
    //         $data['links'] = $this->pagination->create_links();
    //         $data['total'] = $total_rows;
    //     }
    //     log_user_activity('Vendor Report Hotel Report',$this->session->userdata('id'), 'Hotel Report: View');
    //     $data['content'] = 'admin/vendor_report';
    //     $this->load->view('admin/layout', $data);
    // }
    
    
    //Updated 07 jan 2026 
// 	public function vendor_report()
// 	{
// 		$data['locations'] = $this->locations;

// 		$location = '';
// 		if ($this->input->get('location') <> '') {
// 			$location = trim($this->input->get('location'));
// 		}
		
// 		$where1 = ' AND a.status IN("complete","file-closed","in-progress") ';
		
// 		if ($this->input->get('hotel') <> '' && is_numeric($this->input->get('hotel'))) {
// 			$id = trim($this->input->get('hotel'));
// 			$where1 .= ' AND ahd.hotel_id = ' . $id;
// 		}
		
// 		$where2 = '';
// 		if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
// 			$where2 = ' AND (DATE(ard.checkin_date) >= "' . trim($this->input->get('date_from')) . '" AND DATE(ard.checkout_date) <= "' . trim($this->input->get('date_to')) . '")';
// 		}
		
// 		$city = trim($this->input->get('city'));
// 		$city = rtrim($city, ','); 
// 		$where3 = '';
// 		if (!empty($city)) {
// 			$city = $this->db->escape_str($city);
// 			$where3 = ' AND h.city = "' . $city . '" ';
// 		}
		
// 		$state = trim($this->input->get('state'));
// 		$state = rtrim($state, ','); 
// 		$where4 = '';
// 		if (!empty($state)) {
// 			$state = $this->db->escape_str($state);
// 			$where4 = ' AND h.state = "' . $state . '" ';
// 		}
		
// 		$data['links'] = '';
// 		$data['total'] = 0;
		
// 		if ($this->input->get('submit') <> '') {
// 			$search_data = [
// 				'location' => $this->input->get('location'),
// 				'state' => $this->input->get('state'),
// 				'city' => $this->input->get('city'),
// 				'hotel'    => $this->input->get('hotel'),
// 				'date_from' => $this->input->get('date_from'),
// 				'date_to'   =>$this->input->get('date_to'),
// 				'report_type' => $this->input->get('report_type')
// 			];
			
// 			log_user_activity('Hotel Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));

// 			if(empty($location)){ 
// 				exit; 
// 			}
			
// 			// Determine enquiry filter based on report type
// 			$enquiry_filter = '';
// 			$report_type = $this->input->get('report_type');
			
// 			switch($report_type) {
// 				case 'group':
// 					$enquiry_filter = 'LEFT(e.enquiry_abbr, 1) = "G"';
// 					break;
// 				case 'individual':
// 					$enquiry_filter = 'LEFT(e.enquiry_abbr, 1) != "G"';
// 					break;
// 				case 'all':
// 				default:
// 					$enquiry_filter = '1=1'; // No filter for enquiry type
// 					break;
// 			}
			
// 			// Base query for all report types
// 			$query = "
// 				SELECT 
// 					GROUP_CONCAT(DISTINCT e.enquiry_no SEPARATOR ', ') AS enquiry_numbers,
// 					h.id AS hotel_id,
// 					h.name AS hotel_name,
// 					h.address_1 AS address,
// 					h.city,
// 					h.state,
// 					h.country,
// 					MIN(ard.checkin_date) AS min_checkin_date,
// 					MAX(ard.checkout_date) AS max_checkout_date,
// 					SUM(ard.number_of_rooms) AS total_rooms,
// 					SUM(DATEDIFF(ard.checkout_date, ard.checkin_date) * ard.number_of_rooms) AS total_room_nights,
// 					COUNT(DISTINCT e.id) AS total_enquiries
// 				FROM enquiry e
// 				JOIN arrivals a ON a.enquiry_id = e.id
// 				JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
// 				JOIN arrival_room_details ard ON ard.arrival_hotel_details_id = ahd.id
// 				JOIN hotels h ON h.id = ahd.hotel_id
// 				WHERE LOWER(h.country) = '" . strtolower($location) . "'
// 				AND " . $enquiry_filter . "
// 				" . $where1 . $where2 . $where3 . $where4 . "
// 				GROUP BY h.id
// 				ORDER BY h.name
// 			";
			
// 			// For individual enquiries (non-group), we need to handle adults/children differently
// 			if ($report_type == 'individual') {
// 				$query = "
// 					SELECT 
// 						GROUP_CONCAT(DISTINCT e.enquiry_no SEPARATOR ', ') AS enquiry_numbers,
// 						h.id AS hotel_id,
// 						h.name AS hotel_name,
// 						h.address_1 AS address,
// 						h.city,
// 						h.state,
// 						h.country,
// 						MIN(ard.checkin_date) AS min_checkin_date,
// 						MAX(ard.checkout_date) AS max_checkout_date,
// 						COUNT(DISTINCT ard.id) AS total_rooms,
// 						SUM(DATEDIFF(ard.checkout_date, ard.checkin_date)) AS total_room_nights,
// 						COUNT(DISTINCT e.id) AS total_enquiries,
// 						COUNT(DISTINCT CASE WHEN apd.category = 'adult' THEN apd.id END) AS total_adults,
// 						COUNT(DISTINCT CASE WHEN apd.category != 'adult' THEN apd.id END) AS total_children
// 					FROM enquiry e
// 					JOIN arrivals a ON a.enquiry_id = e.id
// 					JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
// 					JOIN arrival_room_details ard ON ard.arrival_hotel_details_id = ahd.id
// 					LEFT JOIN arrival_persons_details apd ON apd.arrival_room_details_id = ard.id
// 					JOIN hotels h ON h.id = ahd.hotel_id
// 					WHERE LOWER(h.country) = '" . strtolower($location) . "'
// 					AND LEFT(e.enquiry_abbr, 1) != 'G'
// 					" . $where1 . $where2 . $where3 . $where4 . "
// 					GROUP BY h.id
// 					ORDER BY h.name
// 				";
// 			}
			
// 			if($this->input->get('excel_download') == '1'){
// 				log_user_activity('Hotel Report Excel Download',$this->session->userdata('id'), 'Hotel Report Excel Downloaded');
// 				$result = $this->common_model->custom_query($query);
// 				$this->vendor_excel_download($result);
// 			}
			
// 			$total_rows = $this->db->query($query)->num_rows();

// 			$search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
// 			$config = array();
// 			$config["base_url"] = base_url() . 'vendor-report?' . $search[0];

// 			$config["total_rows"] = $total_rows;
// 			$config["per_page"] = 10;
// 			$config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
// 			$config['full_tag_close'] = '</ul>';
// 			$config['first_tag_open'] = '<li class="paginate_button page-item">';
// 			$config['first_tag_close'] = '</li>';
// 			$config['prev_link'] = 'Previous';
// 			$config['next_link'] = 'Next';
// 			$config['next_tag_open'] = '<li class="paginate_button page-item">';
// 			$config['next_tag_close'] = '</li>';
// 			$config['last_tag_open'] = '<li class="paginate_button page-item">';
// 			$config['last_tag_close'] = '</li>';
// 			$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
// 			$config['cur_tag_close'] = '</a></li>';
// 			$config['num_tag_open'] = '<li class="paginate_button page-item">';
// 			$config['num_tag_close'] = '</li>';
// 			$config['page_query_string'] = TRUE;
// 			$this->pagination->initialize($config);
// 			$offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
// 			$data['offset'] = $offset;

// 			$query .= ' LIMIT ' . $offset . ', ' . $config["per_page"];
// 			$data['vendor_report'] = $this->common_model->custom_query($query);
// 			$data['links'] = $this->pagination->create_links();
// 			$data['total'] = $total_rows;
// 		}
		
// 		log_user_activity('Vendor Report Hotel Report',$this->session->userdata('id'), 'Hotel Report: View');
// 		$data['content'] = 'admin/vendor_report';
// 		$this->load->view('admin/layout', $data);
// 	}


    // updated 08 jan 2026
    public function vendor_report()
    {
        $data['locations'] = $this->locations;

        $location = '';
        if ($this->input->get('location') <> '') {
            $location = trim($this->input->get('location'));
        }
        
        $where1 = ' AND a.status IN("complete","file-closed","in-progress") ';
        
        if ($this->input->get('hotel') <> '' && is_numeric($this->input->get('hotel'))) {
            $id = trim($this->input->get('hotel'));
            $where1 .= ' AND ahd.hotel_id = ' . $id;
        }
        
        $where2 = '';
        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where2 = ' AND (DATE(ard.checkin_date) >= "' . trim($this->input->get('date_from')) . '" AND DATE(ard.checkout_date) <= "' . trim($this->input->get('date_to')) . '")';
        }
        
        $city = trim($this->input->get('city'));
        $city = rtrim($city, ','); 
        $where3 = '';
        if (!empty($city)) {
            $city = $this->db->escape_str($city);
            $where3 = ' AND h.city = "' . $city . '" ';
        }
        
        $state = trim($this->input->get('state'));
        $state = rtrim($state, ','); 
        $where4 = '';
        if (!empty($state)) {
            $state = $this->db->escape_str($state);
            $where4 = ' AND h.state = "' . $state . '" ';
        }
        
        $data['links'] = '';
        $data['total'] = 0;
        
        if ($this->input->get('submit') <> '') {
            $search_data = [
                'location' => $this->input->get('location'),
                'state' => $this->input->get('state'),
                'city' => $this->input->get('city'),
                'hotel'    => $this->input->get('hotel'),
                'date_from' => $this->input->get('date_from'),
                'date_to'   =>$this->input->get('date_to'),
                'report_type' => $this->input->get('report_type')
            ];
            
            log_user_activity('Hotel Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));

            if(empty($location)){ 
                exit; 
            }
            
            $report_type = $this->input->get('report_type');
            
            // Individual report type
            if ($report_type == 'individual') {
                $query = "
                    SELECT 
                        GROUP_CONCAT(DISTINCT e.enquiry_no SEPARATOR ', ') AS enquiry_numbers,
                        h.id AS hotel_id,
                        h.name AS hotel_name,
                        h.address_1 AS address,
                        h.city,
                        h.state,
                        h.country,
                        MIN(ard.checkin_date) AS min_checkin_date,
                        MAX(ard.checkout_date) AS max_checkout_date,
                        COUNT(DISTINCT ard.id) AS total_rooms,
                        SUM(DATEDIFF(ard.checkout_date, ard.checkin_date)) AS total_room_nights,
                        COUNT(DISTINCT e.id) AS total_enquiries,
                        COUNT(DISTINCT CASE WHEN apd.category = 'adult' THEN apd.id END) AS total_adults,
                        COUNT(DISTINCT CASE WHEN apd.category != 'adult' THEN apd.id END) AS total_children
                    FROM enquiry e
                    JOIN arrivals a ON a.enquiry_id = e.id
                    JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
                    JOIN arrival_room_details ard ON ard.arrival_hotel_details_id = ahd.id
                    LEFT JOIN arrival_persons_details apd ON apd.arrival_room_details_id = ard.id
                    JOIN hotels h ON h.id = ahd.hotel_id
                    WHERE LOWER(h.country) = '" . strtolower($location) . "'
                    AND LEFT(e.enquiry_abbr, 1) != 'G'
                    " . $where1 . $where2 . $where3 . $where4 . "
                    GROUP BY h.id
                    ORDER BY h.name
                ";
            }
            // Group report type
            elseif ($report_type == 'group') {
                $query = "
                    SELECT 
                        GROUP_CONCAT(DISTINCT e.enquiry_no SEPARATOR ', ') AS enquiry_numbers,
                        h.id AS hotel_id,
                        h.name AS hotel_name,
                        h.address_1 AS address,
                        h.city,
                        h.state,
                        h.country,
                        MIN(ard.checkin_date) AS min_checkin_date,
                        MAX(ard.checkout_date) AS max_checkout_date,
                        SUM(ard.number_of_rooms) AS total_rooms,
                        SUM(DATEDIFF(ard.checkout_date, ard.checkin_date) * ard.number_of_rooms) AS total_room_nights,
                        COUNT(DISTINCT e.id) AS total_enquiries
                    FROM enquiry e
                    JOIN arrivals a ON a.enquiry_id = e.id
                    JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
                    JOIN arrival_room_details ard ON ard.arrival_hotel_details_id = ahd.id
                    JOIN hotels h ON h.id = ahd.hotel_id
                    WHERE LOWER(h.country) = '" . strtolower($location) . "'
                    AND LEFT(e.enquiry_abbr, 1) = 'G'
                    " . $where1 . $where2 . $where3 . $where4 . "
                    GROUP BY h.id
                    ORDER BY h.name
                ";
            }
            // All report type (both individual and group)
            else {
                $query = "
                    SELECT 
                        GROUP_CONCAT(DISTINCT e.enquiry_no SEPARATOR ', ') AS enquiry_numbers,
                        h.id AS hotel_id,
                        h.name AS hotel_name,
                        h.address_1 AS address,
                        h.city,
                        h.state,
                        h.country,
                        MIN(ard.checkin_date) AS min_checkin_date,
                        MAX(ard.checkout_date) AS max_checkout_date,
                        SUM(CASE 
                            WHEN LEFT(e.enquiry_abbr, 1) = 'G' THEN ard.number_of_rooms
                            ELSE 1
                        END) AS total_rooms,
                        SUM(CASE 
                            WHEN LEFT(e.enquiry_abbr, 1) = 'G' THEN 
                                DATEDIFF(ard.checkout_date, ard.checkin_date) * ard.number_of_rooms
                            ELSE 
                                DATEDIFF(ard.checkout_date, ard.checkin_date)
                        END) AS total_room_nights,
                        COUNT(DISTINCT e.id) AS total_enquiries,
                        COUNT(DISTINCT CASE 
                            WHEN LEFT(e.enquiry_abbr, 1) != 'G' AND apd.category = 'adult' THEN apd.id 
                        END) AS total_adults,
                        COUNT(DISTINCT CASE 
                            WHEN LEFT(e.enquiry_abbr, 1) != 'G' AND apd.category != 'adult' THEN apd.id 
                        END) AS total_children
                    FROM enquiry e
                    JOIN arrivals a ON a.enquiry_id = e.id
                    JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
                    JOIN arrival_room_details ard ON ard.arrival_hotel_details_id = ahd.id
                    LEFT JOIN arrival_persons_details apd ON apd.arrival_room_details_id = ard.id
                        AND LEFT(e.enquiry_abbr, 1) != 'G'  -- Only join for individual enquiries
                    JOIN hotels h ON h.id = ahd.hotel_id
                    WHERE LOWER(h.country) = '" . strtolower($location) . "'
                    " . $where1 . $where2 . $where3 . $where4 . "
                    GROUP BY h.id
                    ORDER BY h.name
                ";
            }
            
            if($this->input->get('excel_download') == '1'){
                log_user_activity('Hotel Report Excel Download',$this->session->userdata('id'), 'Hotel Report Excel Downloaded');
                $result = $this->common_model->custom_query($query);
                $this->vendor_excel_download($result);
            }
            
            $total_rows = $this->db->query($query)->num_rows();

            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'vendor-report?' . $search[0];

            $config["total_rows"] = $total_rows;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;

            $query .= ' LIMIT ' . $offset . ', ' . $config["per_page"];
            $data['vendor_report'] = $this->common_model->custom_query($query);
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $total_rows;
        }
        
        log_user_activity('Vendor Report Hotel Report',$this->session->userdata('id'), 'Hotel Report: View');
        $data['content'] = 'admin/vendor_report';
        $this->load->view('admin/layout', $data);
    }

    public function vendor_excel_download($result){        
        if (ob_get_length()) ob_end_clean();
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Hotel Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'State');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Rooms Nights');
        
        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $list) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $list->hotel_name);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $list->address);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $list->city);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $list->state);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $list->country);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $list->total_room_nights);
                
                $row++;
                $sr++;
            }
        }
        $report_type = $this->input->get('report_type');
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'Vendor-report_'.$report_type.'_' . date('d-M-Y') . '.xls' . '"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        exit;        
    }

    public function get_hotels()
    {
        $location = $this->input->post('location');
        $where = 'LOWER(hotels.country) = "' . strtolower($location) . '" AND status="active"';
        $select = '*';
        $data = $this->common_model->get_data('hotels', '', '', $select, $where, '', $count = false);
        if (empty($data)) {
            $response = json_encode(['response' => 'e', 'details' => '', 'msg' => '']);
        } else {
            $response = json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        }
        echo $response;
        exit;
    }

    public function revenue_report_old()
    {
        $data['locations'] = $this->locations;

        $where = ' arrivals.status IN("complete","file-closed","in-progress") ';
        if ($this->input->get('location') <> '') {
            $location = trim($this->input->get('location'));
            $location_abbr = implode('","', $data['locations'][$location]);
            $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
        }

        if ($this->input->get('company_id') <> '') {
            $where .= ' AND company.company_id = "' . trim($this->input->get('company_id')) . '"';
        }
        $join = '';
        if ($this->input->get('agent') <> '') {
            //$join = ' LEFT JOIN company_details ON company_details.company = company.company_id';
            $where .= ' AND enquiry.company_details_id = ' . trim($this->input->get('agent'));
        }
        if ($this->input->get('sales') <> '') {
            //$j = ' LEFT JOIN admin ON enquiry.sales_admin_id = admin.id';
            //$join = (($join<>'')?$join.$j:$j);
            $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->get('sales'));
        }

        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where .= ' AND (date(arrivals.created) >="' . trim($this->input->get('date_from')) . '" AND date(arrivals.created) <="' . trim($this->input->get('date_to')) . '")';
        }
        $j = '';
        if ($this->input->get('country') <> '' && $this->input->get('state') == '' && $this->input->get('city') == '') {
            $j = '  JOIN company_details ON (company_details.company = enquiry.company_id AND company_details.status="active")';
            $join = (($join <> '') ? $join . $j : $j);
            $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
        }
        if ($this->input->get('state') <> '' && $this->input->get('city') == '') {
            $j = '  JOIN company_details ON (company_details.company = enquiry.company_id AND company_details.status="active")';
            $join = (($join <> '') ? $join . $j : $j);
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
        }
        if ($this->input->get('city') <> '') {
            $j = '  JOIN company_details ON (company_details.company = enquiry.company_id AND company_details.status="active")';
            $join = (($join <> '') ? $join . $j : $j);
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';
        }

        $data['links'] = '';
        $data['total'] = 0;
        if ($this->input->get('submit') <> '') {

            $query = 'SELECT t.id,t.name,SUM(t.client_billing) AS total_billing,';
            $query .= 'SUM(t.dollar_payment_india) AS dollar_india,SUM(t.dollar_payment_other) AS dollar_other,SUM(t.inr_payment_india) AS inr_india,SUM(t.inr_payment_other) AS inr_other';
            $query .= ' FROM ';
            $query .= '(SELECT company.id,company.name,arrivals.client_billing,';
            $query .= 'If(payment_details.currency="dollar", SUM(payment_details.payment_recieved_in_india),"") AS dollar_payment_india,';
            $query .= 'If(payment_details.currency="dollar", SUM(payment_details.payment_recieved_in_other),"") AS dollar_payment_other,';

            $query .= 'If(payment_details.currency="inr", SUM(payment_details.payment_recieved_in_india),"") AS inr_payment_india,';
            $query .= 'If(payment_details.currency="inr", SUM(payment_details.payment_recieved_in_other),"") AS inr_payment_other ';

            $query .= 'FROM enquiry LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
                LEFT JOIN payment_details ON arrivals.id=payment_details.arrival_id 
                LEFT JOIN company ON enquiry.company_id = company.company_id 
                ' . $join . '
                WHERE ' . $where . '
                GROUP BY payment_details.arrival_id) t GROUP BY t.id';
            //echo $query;exit;
            $total_rows = $this->db->query($query)->num_rows();

            $total_query = 'SELECT SUM(t1.total_billing) AS final_total,SUM(t1.dollar_india) AS final_dollar_india,SUM(t1.dollar_other) AS final_dollar_other,SUM(t1.inr_india) AS final_inr_india,SUM(t1.inr_other) AS final_inr_other FROM (' . $query . ') t1';
            //echo $total_query;exit;
            $data['total_sales'] = $this->common_model->custom_query($total_query)[0];
            //echo '<pre>';print_r($data);exit;
            //echo $total_rows;
            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'revenue-report?' . $search[0];

            $config["total_rows"] = $total_rows;
            $config["per_page"] = 100;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;

            $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
            //echo $query;
            $data['revenue_report'] = $this->common_model->custom_query($query);
            //echo $this->db->last_query();exit;
            //echo '<pre>' ; print_r($data['revenue_report']);exit;
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $total_rows;
        }
        $select = 'admin.*';
        $where = 'admin.type = "5"';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        $data['content'] = 'admin/revenue_report_old';
        $this->load->view('admin/layout', $data);
    }

    // public function revenue_report()
    // {
    //     $data['locations'] = $this->locations;

    //     $where = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
    //     if ($this->input->get('status') <> '') {
    //         $where = ' arrivals.status = "'.$this->input->get('status').'"';
    //     }
        
    //     if ($this->input->get('location') <> '') {
    //         $location = trim($this->input->get('location'));
    //         $location_abbr = implode('","', $data['locations'][$location]);
    //         $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
    //     }

    //     if ($this->input->get('company_id') <> '') {
    //         $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
    //     }
        
    //     if ($this->input->get('agent') <> '') {
    //         $where .= ' AND enquiry.company_details_id = ' . trim($this->input->get('agent'));
    //     }

    //     if ($this->input->get('sales') <> '') {
    //         $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->get('sales'));
    //     }
		
    //     if($this->input->get('quarter')<>''){
    //         $quarter_dates = explode('_',$this->input->get('quarter'));
    //         $date_from = $quarter_dates[0];
    //         $date_to = $quarter_dates[1];
    //         $where .= ' AND (date(enquiry.check_in_date) >="' . trim($date_from) . '" AND date(enquiry.check_in_date) <="' . trim($date_to) . '")';
    //     }else if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //         $where .= ' AND (date(enquiry.check_in_date) >="' . trim($this->input->get('date_from')) . '" AND date(enquiry.check_in_date) <="' . trim($this->input->get('date_to')) . '")';
    //     }
		
    //     $join = ' LEFT JOIN company_details ON (company_details.company_id = enquiry.company_details_id)';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
        
    //     if ($this->input->get('state') <> '') {
    //         $state = strtolower(urldecode($this->input->get('state')));
    //         $arr = explode(',', $state);
    //         $arr = array_map('trim', $arr);
    //         if (end($arr) == '') {
    //             unset($arr[count($arr) - 1]);
    //         }
    //         $str_state = implode('","', $arr);
    //         $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
    //     }

    //     if ($this->input->get('city') <> '') {
    //         $city = strtolower(urldecode($this->input->get('city')));
    //         $arr = explode(',', $city);
    //         $arr = array_map('trim', $arr);
    //         if (end($arr) == '') {
    //             unset($arr[count($arr) - 1]);
    //         }
    //         $str_city = implode('","', $arr);
    //         $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';

    //     }

    //     // Filter by Fit or Git file
    //     if ($this->input->get('fit_git_files') != '') {
    //         $fit_git_file = trim($this->input->get('fit_git_files'));
    //         $prefix = strtolower($fit_git_file) == 'fit' ? 'f' : 'g';
    //         $where .= ' AND LEFT(enquiry.enquiry_no, 1) = "' . $prefix . '"';
    //     }

    //     // FIT/GIT Count Query
    //     $countFitGitQuery = '
    //         SELECT 
    //             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "f" THEN 1 ELSE 0 END) AS total_fit,
    //             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "g" THEN 1 ELSE 0 END) AS total_git
    //         FROM enquiry 
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
    //         LEFT JOIN company ON enquiry.company_id = company.company_id 
    //         ' . $join . '
    //         WHERE ' . $where;

    //     $data['fit_git_totals'] = $this->common_model->custom_query($countFitGitQuery)[0];

    //     $data['links'] = '';
    //     $data['total'] = 0;
    //     if ($this->input->get('submit') <> '') {
    //             $search_data = [
    //                 'location' => $this->input->get('location'),
    //                 'company_id'         => $this->input->get('company_id'),
    //                 'agent'         => $this->input->get('agent'),
    //                 'sales'         => $this->input->get('sales'),
    //                 'quarter'         => $this->input->get('quarter'),
    //                 'date_from'         => $this->input->get('date_from'),
    //                 'date_to'         => $this->input->get('date_to'),
    //                 'city'         => $this->input->get('city'),
    //                 'state'         => $this->input->get('state'),
    //                 'country'         => $this->input->get('country'),
    //                 'status'         => $this->input->get('status'),
    //                 'fit_git_file' => $this->input->get('fit_git_file'),
    //             ];
    //         log_user_activity('Sales Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));
    
    //         $query = 'SELECT enquiry.company_id,company.id,company.name,company.state,company.date,';
    //         // $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
    //         //$query .= 'If(arrivals.currency="inr", SUM(arrivals.client_billing),"") AS total_billing_inr, ';
    //         $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
    //         $query .= 'COUNT(enquiry.id) AS file_cnt, ';
    //         $query .= 'SUM(CASE 
    //                     WHEN arrivals.split_number != 0 
    //                     THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
    //                     ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
    //                 END) AS num_persons '; // Add on 06 Jan 2025
    //         if($this->input->get('excel_download')== '1'){
    //             $query .= ',GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers '; // Add on 10 Feb 2025
    //         }
    //         $query .= 'FROM enquiry LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
    //             LEFT JOIN company ON enquiry.company_id = company.company_id 
    //             ' . $join . '
    //             WHERE ' . $where . '
    //             GROUP BY enquiry.company_id';
    //         //echo $query;exit;
            
    //         if($this->input->get('excel_download')== '1'){
    //             log_user_activity('Sales Report Excel Export',$this->session->userdata('id'), 'Sales Report: Excel Export');
    //             $result = $this->common_model->custom_query($query);
    //             $this->revenue_excel_download($result);
                
    //         }
            
    //         $total_rows = $this->db->query($query)->num_rows();

    //         $total_query = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar FROM (' . $query . ') t1';
    //         //echo $total_query;exit;
    //         $data['total_sales'] = $this->common_model->custom_query($total_query)[0];
            
    //         // Total no of pax count
    //         $total_persons_query = 'SELECT SUM(t1.num_persons) AS final_total_persons FROM (' . $query . ') t1';
    //         $data['total_persons'] = $this->common_model->custom_query($total_persons_query)[0];

    //         // Total no of file count
    //         $total_file_cnt = 'SELECT SUM(t1.file_cnt) AS final_total_file_cnt FROM (' . $query . ') t1';
    //         $data['total_file_cnt'] = $this->common_model->custom_query($total_file_cnt)[0];
    //         //echo '<pre>';print_r($data);exit;
    //         //echo $total_rows;
    //         $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //         $config = array();
    //         $config["base_url"] = base_url() . 'revenue-report?' . $search[0];

    //         $config["total_rows"] = $total_rows;
    //         $config["per_page"] = 10;
    //         $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //         $config['full_tag_close'] = '</ul>';
    //         $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['first_tag_close'] = '</li>';
    //         $config['prev_link'] = 'Previous';
    //         $config['next_link'] = 'Next';
    //         $config['next_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['next_tag_close'] = '</li>';
    //         $config['last_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['last_tag_close'] = '</li>';
    //         $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
    //         $config['cur_tag_close'] = '</a></li>';
    //         $config['num_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['num_tag_close'] = '</li>';
    //         $config['page_query_string'] = TRUE;
    //         $this->pagination->initialize($config);
    //         $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //         $data['offset'] = $offset;

    //         $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
    //         //echo $query;
    //         $data['revenue_report'] = $this->common_model->custom_query($query);
    //         //echo $this->db->last_query();exit;
    //         //echo '<pre>' ; print_r($data['revenue_report']);exit;
    //         $data['links'] = $this->pagination->create_links();
    //         $data['total'] = $total_rows;
    //         // echo $this->db->last_query(); exit;
    //     }
    //     $select = 'admin.*';
    //     $where = 'admin.type IN ("5","6")';
    //     $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
    //     log_user_activity('Sales Report View',$this->session->userdata('id'), 'Sales Report: View');
    //     $data['content'] = 'admin/revenue_report';
    //     $this->load->view('admin/layout', $data);
    // }
    
    
    
    //     public function revenue_report()
    // {
    //     $data['locations'] = $this->locations;

    //     $where = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
    //     if ($this->input->get('status') <> '') {
    //         $where = ' arrivals.status = "'.$this->input->get('status').'"';
    //     }
        
    //     if ($this->input->get('location') <> '') {
    //         $location = trim($this->input->get('location'));
    //         $location_abbr = implode('","', $data['locations'][$location]);
    //         $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
    //     }

    //     if ($this->input->get('company_id') <> '') {
    //         $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
    //     }
        
    //     if ($this->input->get('agent') <> '') {
    //         $where .= ' AND enquiry.company_details_id = ' . trim($this->input->get('agent'));
    //     }

    //     if ($this->input->get('sales') <> '') {
    //         $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->get('sales'));
    //     }
		
    //     if($this->input->get('quarter')<>''){
    //         $quarter_dates = explode('_',$this->input->get('quarter'));
    //         $date_from = $quarter_dates[0];
    //         $date_to = $quarter_dates[1];
    //         $where .= ' AND (date(enquiry.check_in_date) >="' . trim($date_from) . '" AND date(enquiry.check_in_date) <="' . trim($date_to) . '")';
    //     }else if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //         $where .= ' AND (date(enquiry.check_in_date) >="' . trim($this->input->get('date_from')) . '" AND date(enquiry.check_in_date) <="' . trim($this->input->get('date_to')) . '")';
    //     }
		
    //     $join = ' LEFT JOIN company_details ON (company_details.company_id = enquiry.company_details_id)';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
        
    //     if ($this->input->get('state') <> '') {
    //         $state = strtolower(urldecode($this->input->get('state')));
    //         $arr = explode(',', $state);
    //         $arr = array_map('trim', $arr);
    //         if (end($arr) == '') {
    //             unset($arr[count($arr) - 1]);
    //         }
    //         $str_state = implode('","', $arr);
    //         $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
    //     }

    //     if ($this->input->get('city') <> '') {
    //         $city = strtolower(urldecode($this->input->get('city')));
    //         $arr = explode(',', $city);
    //         $arr = array_map('trim', $arr);
    //         if (end($arr) == '') {
    //             unset($arr[count($arr) - 1]);
    //         }
    //         $str_city = implode('","', $arr);
    //         $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';

    //     }

    //     // Filter by Fit or Git file
    //     if ($this->input->get('fit_git_files') != '') {
    //         $fit_git_file = trim($this->input->get('fit_git_files'));
    //         $prefix = strtolower($fit_git_file) == 'fit' ? 'f' : 'g';
    //         $where .= ' AND LEFT(enquiry.enquiry_no, 1) = "' . $prefix . '"';
    //     }

    //     // FIT/GIT Count Query
    //     $countFitGitQuery = '
    //         SELECT 
    //             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "f" THEN 1 ELSE 0 END) AS total_fit,
    //             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "g" THEN 1 ELSE 0 END) AS total_git
    //         FROM enquiry 
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
    //         LEFT JOIN company ON enquiry.company_id = company.company_id 
    //         ' . $join . '
    //         WHERE ' . $where;

    //     $data['fit_git_totals'] = $this->common_model->custom_query($countFitGitQuery)[0];

    //     $data['links'] = '';
    //     $data['total'] = 0;
    //     if ($this->input->get('submit') <> '') {
    //         $search_data = [
    //             'location' => $this->input->get('location'),
    //             'company_id'         => $this->input->get('company_id'),
    //             'agent'         => $this->input->get('agent'),
    //             'sales'         => $this->input->get('sales'),
    //             'quarter'         => $this->input->get('quarter'),
    //             'date_from'         => $this->input->get('date_from'),
    //             'date_to'         => $this->input->get('date_to'),
    //             'city'         => $this->input->get('city'),
    //             'state'         => $this->input->get('state'),
    //             'country'         => $this->input->get('country'),
    //             'status'         => $this->input->get('status'),
    //             'fit_git_file' => $this->input->get('fit_git_file'),
    //         ];
    //         log_user_activity('Sales Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));
    
    //         $query = 'SELECT enquiry.company_id,company.id,company.name,company.state,company.date,';
    //         // $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
    //         //$query .= 'If(arrivals.currency="inr", SUM(arrivals.client_billing),"") AS total_billing_inr, ';
    //         $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
    //         $query .= 'COUNT(enquiry.id) AS file_cnt, ';
    //         $query .= 'SUM(CASE 
    //                     WHEN arrivals.split_number != 0 
    //                     THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
    //                     ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
    //                 END) AS num_persons '; // Add on 06 Jan 2025
    //         if($this->input->get('excel_download')== '1'){
    //             $query .= ',GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers '; // Add on 10 Feb 2025
    //         }
    //         $query .= 'FROM enquiry LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
    //             LEFT JOIN company ON enquiry.company_id = company.company_id 
    //             ' . $join . '
    //             WHERE ' . $where . '
    //             GROUP BY enquiry.company_id';
    //         //echo $query;exit;
            
    //         if($this->input->get('excel_download')== '1'){
    //             log_user_activity('Sales Report Excel Export',$this->session->userdata('id'), 'Sales Report: Excel Export');
    //             $result = $this->common_model->custom_query($query);
    //             $this->revenue_excel_download($result);
                
    //         }
            
    //         $total_rows = $this->db->query($query)->num_rows();

    //         $total_query = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar FROM (' . $query . ') t1';
    //         //echo $total_query;exit;
    //         $data['total_sales'] = $this->common_model->custom_query($total_query)[0];
            
    //         // Total no of pax count
    //         $total_persons_query = 'SELECT SUM(t1.num_persons) AS final_total_persons FROM (' . $query . ') t1';
    //         $data['total_persons'] = $this->common_model->custom_query($total_persons_query)[0];

    //         // Total no of file count
    //         $total_file_cnt = 'SELECT SUM(t1.file_cnt) AS final_total_file_cnt FROM (' . $query . ') t1';
    //         $data['total_file_cnt'] = $this->common_model->custom_query($total_file_cnt)[0];

    //         // --- Base query for 2025 ---
    //         $query_2025 = 'SELECT enquiry.company_id,company.id,company.name,company.state,company.date,';
    //         $query_2025 .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
    //         $query_2025 .= 'COUNT(enquiry.id) AS file_cnt, ';
    //         $query_2025 .= 'SUM(CASE 
    //                             WHEN arrivals.split_number != 0 
    //                             THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
    //                             ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
    //                         END) AS num_persons ';

    //         if($this->input->get('excel_download')== '1'){
    //             $query_2025 .= ',GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers ';
    //         }

    //         $query_2025 .= 'FROM enquiry 
    //                         LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
    //                         LEFT JOIN company ON enquiry.company_id = company.company_id 
    //                         ' . $join . '
    //                         WHERE ' . $where . ' AND YEAR(enquiry.check_in_date) = 2025
    //                         GROUP BY enquiry.company_id';

    //         // --- Excel Export if requested ---
    //         if($this->input->get('excel_download')== '1'){
    //             log_user_activity('Sales Report Excel Export 2025',$this->session->userdata('id'), 'Sales Report: Excel Export 2025');
    //             $result_2025 = $this->common_model->custom_query($query_2025);
    //             $this->revenue_excel_download($result_2025);
    //         }

    //         // --- Rows Count ---
    //         $total_rows_2025 = $this->db->query($query_2025)->num_rows();

    //         // --- Totals for 2025 ---
    //         $total_query_2025 = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar 
    //                             FROM (' . $query_2025 . ') t1';
    //         $data['total_sales_2025'] = $this->common_model->custom_query($total_query_2025)[0];

    //         // --- Persons Count (2025) ---
    //         $total_persons_query_2025 = 'SELECT SUM(t1.num_persons) AS final_total_persons 
    //                                     FROM (' . $query_2025 . ') t1';
    //         $data['total_persons_2025'] = $this->common_model->custom_query($total_persons_query_2025)[0];

    //         // --- File Count (2025) ---
    //         $total_file_cnt_2025 = 'SELECT SUM(t1.file_cnt) AS final_total_file_cnt 
    //                                 FROM (' . $query_2025 . ') t1';
    //         $data['total_file_cnt_2025'] = $this->common_model->custom_query($total_file_cnt_2025)[0];
    //         $is_filter_applied = !empty(array_filter($search_data)); 
    //         $data['is_filter_applied'] = $is_filter_applied;

    //         //echo '<pre>';print_r($data);exit;
    //         //echo $total_rows;
    //         $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //         $config = array();
    //         $config["base_url"] = base_url() . 'revenue-report?' . $search[0];

    //         $config["total_rows"] = $total_rows;
    //         $config["per_page"] = 10;
    //         $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //         $config['full_tag_close'] = '</ul>';
    //         $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['first_tag_close'] = '</li>';
    //         $config['prev_link'] = 'Previous';
    //         $config['next_link'] = 'Next';
    //         $config['next_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['next_tag_close'] = '</li>';
    //         $config['last_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['last_tag_close'] = '</li>';
    //         $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
    //         $config['cur_tag_close'] = '</a></li>';
    //         $config['num_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['num_tag_close'] = '</li>';
    //         $config['page_query_string'] = TRUE;
    //         $this->pagination->initialize($config);
    //         $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //         $data['offset'] = $offset;

    //         $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
    //         //echo $query;
    //         $data['revenue_report'] = $this->common_model->custom_query($query);
    //         //echo $this->db->last_query();exit;
    //         //echo '<pre>' ; print_r($data['revenue_report']);exit;
    //         $data['links'] = $this->pagination->create_links();
    //         $data['total'] = $total_rows;
    //         // echo $this->db->last_query(); exit;
    //     }
    //     $select = 'admin.*';
    //     $where = 'admin.type IN ("5","6")';
    //     $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
    //     log_user_activity('Sales Report View',$this->session->userdata('id'), 'Sales Report: View');
    //     $data['content'] = 'admin/revenue_report';
    //     $this->load->view('admin/layout', $data);
    // }


//     public function revenue_report()
// {
//     $data['locations'] = $this->locations;

//     $where = 'arrivals.status IN("complete","file-closed","in-progress")';

//     if ($this->input->get('status') != '') {
//         $where = 'arrivals.status = "' . $this->input->get('status') . '"';
//     }

//     if ($this->input->get('location') != '') {
//         $location = trim($this->input->get('location'));
//         $location_abbr = implode('","', $data['locations'][$location]);
//         $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
//     }

//     if ($this->input->get('company_id') != '') {
//         $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
//     }

//     if ($this->input->get('agent') != '') {
//         $where .= ' AND enquiry.company_details_id = ' . trim($this->input->get('agent'));
//     }

//     if ($this->input->get('sales') != '') {
//         $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->get('sales'));
//     }

//     if ($this->input->get('quarter') != '') {
//         $quarter_dates = explode('_', $this->input->get('quarter'));
//         $date_from = $quarter_dates[0];
//         $date_to = $quarter_dates[1];
//         $where .= ' AND (date(arrivals.arrival_date) >= "' . trim($date_from) . '" AND date(arrivals.arrival_date) <= "' . trim($date_to) . '")';
//     } else if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
//         $where .= ' AND (date(arrivals.arrival_date) >= "' . trim($this->input->get('date_from')) . '" AND date(arrivals.arrival_date) <= "' . trim($this->input->get('date_to')) . '")';
//     }

//     $join = ' LEFT JOIN company_details ON (company_details.company_id = enquiry.company_details_id)';

//     if ($this->input->get('country') != '') {
//         $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
//     }

//     if ($this->input->get('state') != '') {
//         $state = strtolower(urldecode($this->input->get('state')));
//         $arr = array_filter(array_map('trim', explode(',', $state)));
//         $str_state = implode('","', $arr);
//         $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
//     }

//     if ($this->input->get('city') != '') {
//         $city = strtolower(urldecode($this->input->get('city')));
//         $arr = array_filter(array_map('trim', explode(',', $city)));
//         $str_city = implode('","', $arr);
//         $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';
//     }

//     // Filter by Fit or Git file
//     if ($this->input->get('fit_git_files') != '') {
//         $fit_git_file = trim($this->input->get('fit_git_files'));
//         $prefix = strtolower($fit_git_file) == 'fit' ? 'f' : 'g';
//         $where .= ' AND LEFT(enquiry.enquiry_no, 1) = "' . $prefix . '"';
//     }

//     // FIT/GIT Count Query
//     $countFitGitQuery = '
//         SELECT 
//             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "f" THEN 1 ELSE 0 END) AS total_fit,
//             SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "g" THEN 1 ELSE 0 END) AS total_git
//         FROM enquiry 
//         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
//         LEFT JOIN company ON enquiry.company_id = company.company_id 
//         ' . $join . '
//         WHERE ' . $where;

//     $data['fit_git_totals'] = $this->common_model->custom_query($countFitGitQuery)[0];

//     $data['links'] = '';
//     $data['total'] = 0;

//     if ($this->input->get('submit') != '') {

//         $search_data = [
//             'location' => $this->input->get('location'),
//             'company_id' => $this->input->get('company_id'),
//             'agent' => $this->input->get('agent'),
//             'sales' => $this->input->get('sales'),
//             'quarter' => $this->input->get('quarter'),
//             'date_from' => $this->input->get('date_from'),
//             'date_to' => $this->input->get('date_to'),
//             'city' => $this->input->get('city'),
//             'state' => $this->input->get('state'),
//             'country' => $this->input->get('country'),
//             'status' => $this->input->get('status'),
//             'fit_git_file' => $this->input->get('fit_git_file'),
//         ];

//         log_user_activity('Sales Report Search', $this->session->userdata('id'), 'Search: ' . json_encode($search_data));

//         $query = 'SELECT enquiry.company_id, company.id, company.name, company.state, company.date,
//             IF(arrivals.currency="dollar", SUM(arrivals.client_billing), "") AS total_billing_dollar,
//             COUNT(enquiry.id) AS file_cnt,
//             SUM(enquiry.number_persons + enquiry.number_child) AS num_persons';

//         if ($this->input->get('excel_download') == '1') {
//             $query .= ', GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers';
//         }

//         $query .= ' FROM enquiry 
//             LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
//             LEFT JOIN company ON enquiry.company_id = company.company_id 
//             ' . $join . '
//             WHERE ' . $where . '
//             GROUP BY enquiry.company_id';

//         if ($this->input->get('excel_download') == '1') {
//             log_user_activity('Sales Report Excel Export', $this->session->userdata('id'), 'Sales Report: Excel Export');
//             $result = $this->common_model->custom_query($query);
//             $this->revenue_excel_download($result);
//         }

//         $total_rows = $this->db->query($query)->num_rows();
//         $total_query = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar FROM (' . $query . ') t1';
//         $data['total_sales'] = $this->common_model->custom_query($total_query)[0];

//         $search = explode('&per_page', $this->input->server('QUERY_STRING'));
//         $config = array();
//         $config["base_url"] = base_url() . 'revenue-report?' . $search[0];
//         $config["total_rows"] = $total_rows;
//         $config["per_page"] = 10;
//         $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
//         $config['full_tag_close'] = '</ul>';
//         $config['first_tag_open'] = '<li class="paginate_button page-item">';
//         $config['first_tag_close'] = '</li>';
//         $config['prev_link'] = 'Previous';
//         $config['next_link'] = 'Next';
//         $config['next_tag_open'] = '<li class="paginate_button page-item">';
//         $config['next_tag_close'] = '</li>';
//         $config['last_tag_open'] = '<li class="paginate_button page-item">';
//         $config['last_tag_close'] = '</li>';
//         $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
//         $config['cur_tag_close'] = '</a></li>';
//         $config['num_tag_open'] = '<li class="paginate_button page-item">';
//         $config['num_tag_close'] = '</li>';
//         $config['page_query_string'] = TRUE;
//         $this->pagination->initialize($config);

//         $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
//         $data['offset'] = $offset;

//         $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
//         $data['revenue_report'] = $this->common_model->custom_query($query);
//         $data['links'] = $this->pagination->create_links();
//         $data['total'] = $total_rows;
//     }

//     $select = 'admin.*';
//     $where = 'admin.type IN ("5","6")';
//     $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', false);
//     log_user_activity('Sales Report View', $this->session->userdata('id'), 'Sales Report: View');
//     $data['content'] = 'admin/revenue_report';
//     $this->load->view('admin/layout', $data);
// }

    public function revenue_report()
    {
        $data['locations'] = $this->locations;
        $year = date('Y');

        $where = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
        if ($this->input->get('status') <> '') {
            $where = ' arrivals.status = "'.$this->input->get('status').'"';
        }
        
        if ($this->input->get('location') <> '') {
            $location = trim($this->input->get('location'));
            $location_abbr = implode('","', $data['locations'][$location]);
            $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
        }

        if ($this->input->get('company_id') <> '') {
            $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
        }
        
        if ($this->input->get('agent') <> '') {
            $where .= ' AND enquiry.company_details_id = ' . trim($this->input->get('agent'));
        }

        if ($this->input->get('sales') <> '') {
            $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->get('sales'));
        }
		
        if($this->input->get('quarter')<>''){
            $quarter_dates = explode('_',$this->input->get('quarter'));
            $date_from = $quarter_dates[0];
            $date_to = $quarter_dates[1];
            $where .= ' AND (date(enquiry.check_in_date) >="' . trim($date_from) . '" AND date(enquiry.check_in_date) <="' . trim($date_to) . '")';
        }else if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where .= ' AND (date(enquiry.check_in_date) >="' . trim($this->input->get('date_from')) . '" AND date(enquiry.check_in_date) <="' . trim($this->input->get('date_to')) . '")';
        }
		
        $join = ' LEFT JOIN company_details ON (company_details.company_id = enquiry.company_details_id)';
        if ($this->input->get('country') <> '') {
            $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
        }
        
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
        }

        if ($this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';

        }

        // Filter by Fit or Git file
        if ($this->input->get('fit_git_files') != '') {
            $fit_git_file = trim($this->input->get('fit_git_files'));
            $prefix = strtolower($fit_git_file) == 'fit' ? 'f' : 'g';
            $where .= ' AND LEFT(enquiry.enquiry_no, 1) = "' . $prefix . '"';
        }

        // FIT/GIT Count Query
        $countFitGitQuery = '
            SELECT 
                SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "f" THEN 1 ELSE 0 END) AS total_fit,
                SUM(CASE WHEN LEFT(enquiry.enquiry_no, 1) = "g" THEN 1 ELSE 0 END) AS total_git
            FROM enquiry 
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
            LEFT JOIN company ON enquiry.company_id = company.company_id 
            ' . $join . '
            WHERE ' . $where;

        $data['fit_git_totals'] = $this->common_model->custom_query($countFitGitQuery)[0];

        $data['links'] = '';
        $data['total'] = 0;
        if ($this->input->get('submit') <> '') {
            $search_data = [
                'location' => $this->input->get('location'),
                'company_id'         => $this->input->get('company_id'),
                'agent'         => $this->input->get('agent'),
                'sales'         => $this->input->get('sales'),
                'quarter'         => $this->input->get('quarter'),
                'date_from'         => $this->input->get('date_from'),
                'date_to'         => $this->input->get('date_to'),
                'city'         => $this->input->get('city'),
                'state'         => $this->input->get('state'),
                'country'         => $this->input->get('country'),
                'status'         => $this->input->get('status'),
                'fit_git_file' => $this->input->get('fit_git_file'),
            ];
            log_user_activity('Sales Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));
    
            $query = 'SELECT enquiry.company_id,company.id,company.name,company.state,company.date,';
            // $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
            //$query .= 'If(arrivals.currency="inr", SUM(arrivals.client_billing),"") AS total_billing_inr, ';
            $query .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
            $query .= 'COUNT(enquiry.id) AS file_cnt, ';
            $query .= 'SUM(CASE 
                        WHEN arrivals.split_number != 0 
                        THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
                        ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
                    END) AS num_persons '; // Add on 06 Jan 2025
            if($this->input->get('excel_download')== '1'){
                $query .= ',GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers '; // Add on 10 Feb 2025
            }
            $query .= 'FROM enquiry LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
                LEFT JOIN company ON enquiry.company_id = company.company_id 
                ' . $join . '
                WHERE ' . $where . '
                GROUP BY enquiry.company_id';
            //echo $query;exit;
            
            if($this->input->get('excel_download')== '1'){
                log_user_activity('Sales Report Excel Export',$this->session->userdata('id'), 'Sales Report: Excel Export');
                $result = $this->common_model->custom_query($query);
                $this->revenue_excel_download($result);
                
            }
            
            $total_rows = $this->db->query($query)->num_rows();

            $total_query = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar FROM (' . $query . ') t1';
            //echo $total_query;exit;
            $data['total_sales'] = $this->common_model->custom_query($total_query)[0];
            
            // Total no of pax count
            $total_persons_query = 'SELECT SUM(t1.num_persons) AS final_total_persons FROM (' . $query . ') t1';
            $data['total_persons'] = $this->common_model->custom_query($total_persons_query)[0];

            // Total no of file count
            $total_file_cnt = 'SELECT SUM(t1.file_cnt) AS final_total_file_cnt FROM (' . $query . ') t1';
            $data['total_file_cnt'] = $this->common_model->custom_query($total_file_cnt)[0];

            // --- Base query for 2025 ---
            $query_2025 = 'SELECT enquiry.company_id,company.id,company.name,company.state,company.date,';
            $query_2025 .= 'SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) AS total_billing_dollar,';
            $query_2025 .= 'COUNT(enquiry.id) AS file_cnt, ';
            $query_2025 .= 'SUM(CASE 
                                WHEN arrivals.split_number != 0 
                                THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
                                ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
                            END) AS num_persons ';

            if($this->input->get('excel_download')== '1'){
                $query_2025 .= ',GROUP_CONCAT(enquiry.enquiry_no SEPARATOR ",") AS enquiry_numbers ';
            }

            $query_2025 .= 'FROM enquiry 
                            LEFT JOIN arrivals ON arrivals.enquiry_id=enquiry.id 
                            LEFT JOIN company ON enquiry.company_id = company.company_id 
                            ' . $join . '
                            WHERE ' . $where . ' AND YEAR(enquiry.check_in_date) = \'' . $year . '\'
                            GROUP BY enquiry.company_id';

            // --- Excel Export if requested ---
            if($this->input->get('excel_download')== '1'){
                log_user_activity('Sales Report Excel Export' . $year, $this->session->userdata('id'), 'Sales Report: Excel Export');
                $result_2025 = $this->common_model->custom_query($query_2025);
                $this->revenue_excel_download($result_2025);
            }

            // --- Rows Count ---
            $total_rows_2025 = $this->db->query($query_2025)->num_rows();

            // --- Totals for 2025 ---
            $total_query_2025 = 'SELECT SUM(t1.total_billing_dollar) AS final_total_dollar 
                                FROM (' . $query_2025 . ') t1';
            $data['total_sales_2025'] = $this->common_model->custom_query($total_query_2025)[0];

            // --- Persons Count (2025) ---
            $total_persons_query_2025 = 'SELECT SUM(t1.num_persons) AS final_total_persons 
                                        FROM (' . $query_2025 . ') t1';
            $data['total_persons_2025'] = $this->common_model->custom_query($total_persons_query_2025)[0];

            // --- File Count (2025) ---
            $total_file_cnt_2025 = 'SELECT SUM(t1.file_cnt) AS final_total_file_cnt 
                                    FROM (' . $query_2025 . ') t1';
            $data['total_file_cnt_2025'] = $this->common_model->custom_query($total_file_cnt_2025)[0];
            $is_filter_applied = !empty(array_filter($search_data)); 
            $data['is_filter_applied'] = $is_filter_applied;

            //echo '<pre>';print_r($data);exit;
            //echo $total_rows;
            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'revenue-report?' . $search[0];

            $config["total_rows"] = $total_rows;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;

            $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
            //echo $query;
            $data['revenue_report'] = $this->common_model->custom_query($query);
            //echo $this->db->last_query();exit;
            //echo '<pre>' ; print_r($data['revenue_report']);exit;
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $total_rows;
            // echo $this->db->last_query(); exit;
        }
        $select = 'admin.*';
        $where = 'admin.type IN ("5","6")';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        log_user_activity('Sales Report View',$this->session->userdata('id'), 'Sales Report: View');
        $data['content'] = 'admin/revenue_report';
        $this->load->view('admin/layout', $data);
    }


    public function get_files(){
        //echo '<pre>';print_R($this->input->post());exit;
        $data['locations'] = $this->locations;
        
        $this->form_validation->set_rules('c_id', 'Company', 'trim|required');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $company_id = $this->input->post('c_id');
        $where = ' arrivals.status IN("complete","file-closed","in-progress") ';

        // Add FIT/GIT filter
        // if ($this->input->post('fit_git_files') <> '') {
        //     $fit_git = strtolower(trim($this->input->post('fit_git_files')));
        //     $where .= ' AND LOWER(enquiry.enquiry_no) = "' . $fit_git . '"';
        // }

        // if ($this->input->post('fit_git_files') !== '') {
        //     $fit_git = strtolower(trim($this->input->post('fit_git_files')));
        //     if ($fit_git === 'fit') {
        //         $where .= ' AND (enquiry.enquiry_no LIKE "FGE%" OR enquiry.enquiry_no LIKE "FIT%")';
        //     } elseif ($fit_git === 'git') {
        //         $where .= ' AND (enquiry.enquiry_no LIKE "GGE%" OR enquiry.enquiry_no LIKE "GIT%" OR enquiry.enquiry_no LIKE "GKZ%")';
        //     }
        // }

        if ($this->input->post('fit_git_files') !== null && $this->input->post('fit_git_files') !== '') {
            $fit_git = strtolower(trim($this->input->post('fit_git_files')));
            if ($fit_git === 'fit') {
                $where .= ' AND (enquiry.enquiry_no LIKE "FGE%" OR enquiry.enquiry_no LIKE "FIT%")';
            } elseif ($fit_git === 'git') {
                $where .= ' AND (enquiry.enquiry_no LIKE "GGE%" OR enquiry.enquiry_no LIKE "GIT%" OR enquiry.enquiry_no LIKE "GKZ%")';
            }
        }
        
        if ($this->input->post('status') <> '') {
            $where = ' arrivals.status = "'.$this->input->post('status').'"';
        }
        
        if ($this->input->post('location') <> '') {
            $location = trim($this->input->post('location'));
            $location_abbr = implode('","', $data['locations'][$location]);
            $where .= ' AND enquiry.enquiry_abbr IN("' . $location_abbr . '")';
        }

        if ($this->input->post('date_from') <> '' && $this->input->post('date_to') <> '') {
            $where .= ' AND (date(arrivals.arrival_date) >="' . trim($this->input->post('date_from')) . '" AND date(arrivals.arrival_date) <="' . trim($this->input->post('date_to')) . '")';
        }

        if ($this->input->post('agent') <> '') {
            //$join = ' LEFT JOIN company_details ON company_details.company = company.company_id';
            $where .= ' AND enquiry.company_details_id = ' . trim($this->input->post('agent'));
        }

        if ($this->input->post('sales') <> '') {
            $where .= ' AND enquiry.sales_admin_id = ' . trim($this->input->post('sales'));
        }

        $join_company_details = [];
        if ($this->input->post('country') <> '') {
            $where .= ' AND LOWER(company_details.country) = "' . strtolower(trim($this->input->post('country'))) . '"';
        }

        if ($this->input->post('state') <> '') {
            $state = strtolower(urldecode($this->input->post('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $where .= ' AND LOWER(company_details.state) IN ("' . $str_state . '")';
        }

        if ($this->input->post('city') <> '') {
            $city = strtolower(urldecode($this->input->post('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $where .= ' AND LOWER(company_details.city) IN ("' . $str_city . '")';
        }
        
        $where .= ' AND enquiry.company_id = "'.$company_id.'"';
        $select = 'enquiry.*,arrivals.client_billing,arrivals.balance_amount,arrivals.status AS arrivals_status,company_details.contact_person,arrivals.arrival_date,arrivals.split_number';
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
                ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
                ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => '(company_details.company_id = enquiry.company_details_id)']];
        $files = $this->common_model->get_data('enquiry', '', '', $select, $where, 'ORDER BY arrivals.arrival_date ASC', $count = false,$join);
        //echo $this->db->last_query();
        echo json_encode(['response'=>'s','details'=>$files, 'msg'=> '']);
        exit;
        
    }

    // public function get_fit_git_files()
    // {
    //     // Clean inputs: remove trailing commas and extra spaces, convert to lowercase
    //     $country = strtolower(trim(rtrim($this->input->post('country'), " ,")));
    //     $state   = strtolower(trim(rtrim($this->input->post('state'), " ,")));
    //     $city    = strtolower(trim(rtrim($this->input->post('city'), " ,")));

    //     $fit_files = [];
    //     $git_files = [];

    //     if ($country && $state && $city) {
    //         $this->db->select('enquiry.enquiry_no');
    //         $this->db->from('enquiry');
    //         $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id');
    //         $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id');
    //         $this->db->where('LOWER(company_details.country)', $country);
    //         $this->db->where('LOWER(company_details.state)', $state);
    //         $this->db->where('LOWER(company_details.city)', $city);
    //         $this->db->where('YEAR(arrivals.arrival_date)', 2025);
    //         $this->db->group_by('enquiry.enquiry_no');

    //         $query = $this->db->get();

    //         foreach ($query->result() as $row) {
    //             if (stripos($row->enquiry_no, 'F') === 0) {
    //                 $fit_files[] = $row->enquiry_no;
    //             } elseif (stripos($row->enquiry_no, 'G') === 0) {
    //                 $git_files[] = $row->enquiry_no;
    //             }
    //         }
    //     }

    //     echo json_encode(['fit' => $fit_files, 'git' => $git_files]);
    // }

    public function revenue_excel_download($result){
        if (ob_get_length()) ob_end_clean();
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Company State');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Agent Since');
	    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Pax Count');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Total Billing In Dollars');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Files');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Enquiry Numbers');
        if($this->input->get('status')<>''){
            $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Status');
        }
        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $list) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, ($list->name=='')?'B2C Sales':$list->name);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, ($list->state<>'')?$list->state:'');
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, ($list->date<>'')?date('d-M-y', strtotime($list->date)):'');
		        $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, ($list->num_persons<>'')?$list->num_persons:'');
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, ($list->total_billing_dollar<>'')?$list->total_billing_dollar:'0');
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $list->file_cnt);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $list->enquiry_numbers);
                if($this->input->get('status')<>''){
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, ucfirst($this->input->get('status')));
                }
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Sales-report_' . date('d-M-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
     
    }
    
    // public function restaurant_report()
    // {

    //     $data['country'] = ['label' => '', 'country_id' => ''];
        
    //     if ($this->session->userdata('locations') != 'all') {
    //         $countries = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))]);
        
    //         if (!empty($countries)) {
    //             $data['country'] = $countries[0];
    //         }
    //     }

    //     $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //     $config = array();
    //     $config["base_url"] = base_url() . 'restaurant-report?' . $search[0];

    //     $where = ' restaurants.status = "active"';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(restaurants.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
    //     if ($this->input->get('city') <> '') {
    //         $where .= ' AND LOWER(restaurants.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
    //     }
    //     if ($this->input->get('specility') <> '') {
    //         $where .= ' AND restaurants.cuisine LIKE "%' . trim($this->input->get('specility')) . '%"';
    //     }
    //     if(!empty($this->input->get('restaurants'))){
    //         foreach($this->input->get('restaurants') AS $list){
    //             $ids[] = $list;
    //         }            
    //         $where .= ' AND restaurants.id IN ('.implode(",",$ids).')';
    //     }

    //     $Search_data = [
    //         'locations'         => $this->input->get('country'),
    //         'city'         => $this->input->get('city'),
    //         'specility'         =>$this->input->get('specility'),
    //         'restaurants'         => $this->input->get('restaurants'),
    //     ];
    //     if ($this->input->get('submit') <> '') {
    //         log_user_activity('Transport Report Search',$this->session->userdata('id'), 'Search: '. json_encode($Search_data));
    //     }
    //     $config["total_rows"] = $this->common_model->get_data('restaurants', '', '', 'restaurants.id', $where, '', $count = true, '');
    //     $result_cnt = $config["total_rows"];
    //     $data['total'] = $result_cnt;
    //     $config["per_page"] = 10;
    //     $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //     $config['full_tag_close'] = '</ul>';
    //     $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['first_tag_close'] = '</li>';
    //     $config['prev_link'] = 'Previous';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['next_tag_close'] = '</li>';
    //     $config['last_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['last_tag_close'] = '</li>';
    //     $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['num_tag_close'] = '</li>';
    //     $config['page_query_string'] = TRUE;
    //     //$config['reuse_query_string'] = TRUE;
    //     $this->pagination->initialize($config);
    //     $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //     $data['offset'] = $offset;
    //     $data['result'] = $this->common_model->get_data('restaurants', $offset, $config["per_page"], '*', $where, ' ORDER BY restaurants.id DESC', $count = false, '');
    //     $data['links'] = $this->pagination->create_links();
    //     log_user_activity('Restaurant Report View',$this->session->userdata('id'), 'Restaurant Report: View');
    //     $data['content'] = 'admin/restaurant_report';
    //     $this->load->view('admin/layout', $data);
    // }
    
    
    // In your controller
    // public function get_restaurant_arrivals() {
    //     $restaurant_id = $this->input->post('restaurant_id');
    //     $date_from = $this->input->post('date_from');
    //     $date_to = $this->input->post('date_to');
        
    //     // Build date filter condition - use the SAME logic as main report
    //     $date_condition = "";
    //     if (!empty($date_from) && !empty($date_to)) {
    //         $date_condition = " AND (
    //             (e.split_count = 0 AND DATE(e.check_in_date) >= '$date_from' AND DATE(e.check_in_date) <= '$date_to')
    //             OR
    //             (e.split_count != 0 AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = ar.arrival_id
    //             ) >= '$date_from' 
    //             AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = ar.arrival_id
    //             ) <= '$date_to')
    //         )";
    //     }
        
    //     // Use the SAME logic as main report query
    //     $query = "
    //         SELECT 
    //             e.enquiry_no,
    //             ar.arrival_id,
    //             ar.date as restaurant_date,
    //             ar.buffet,
    //             (
    //                 SELECT MAX(rm2.no_of_person) 
    //                 FROM restaurant_menus rm2 
    //                 WHERE rm2.restaurant_id = ar.restaurant_id 
    //                 AND rm2.date = ar.date 
    //                 AND rm2.arr_id = ar.arrival_id
    //                 AND rm2.buffet = ar.buffet
    //             ) as no_of_person,
    //             e.check_in_date,
    //             e.check_out_date
    //         FROM arrival_restaurants ar
    //         LEFT JOIN arrivals a ON a.id = ar.arrival_id
    //         LEFT JOIN enquiry e ON e.id = a.enquiry_id
    //         WHERE ar.restaurant_id = ?
    //         $date_condition
    //         ORDER BY ar.date DESC
    //     ";
        
    //     $data = $this->db->query($query, [$restaurant_id])->result_array();
        
    //     // Calculate total to verify
    //     $total_persons = 0;
    //     foreach ($data as $row) {
    //         $total_persons += $row['no_of_person'];
    //     }
        
    //     echo json_encode([
    //         'success' => true, 
    //         'data' => $data,
    //         'total_persons' => $total_persons
    //     ]);
    //     exit;
    // }


    // public function restaurant_report()
    // {
    //     $data['country'] = ['label' => '', 'country_id' => ''];
        
    //     if ($this->session->userdata('locations') != 'all') {
    //         $countries = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))]);
        
    //         if (!empty($countries)) {
    //             $data['country'] = $countries[0];
    //         }
    //     }

    //     $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //     $config = array();
    //     $config["base_url"] = base_url() . 'restaurant-report?' . $search[0];

    //     $where = ' r.status = "active" AND r.id IS NOT NULL';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(r.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
    //     if ($this->input->get('city') <> '') {
    //         $where .= ' AND LOWER(r.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
    //     }
    //     if ($this->input->get('specility') <> '') {
    //         $where .= ' AND r.cuisine LIKE "%' . trim($this->input->get('specility')) . '%"';
    //     }
    //     if(!empty($this->input->get('restaurants'))){
    //         foreach($this->input->get('restaurants') AS $list){
    //             $ids[] = $list;
    //         }            
    //         $where .= ' AND r.id IN ('.implode(",",$ids).')';
    //     }

    //     // Date filter conditions based on enquiry table
    //     $date_where = '';
    //     if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $date_from = $this->input->get('date_from');
    //         $date_to = $this->input->get('date_to');
            
    //         $date_where = " AND (
    //             (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= '$date_from' AND DATE(enquiry.check_in_date) <= '$date_to')
    //             OR
    //             (enquiry.split_count != 0 AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = arrivals.id
    //             ) >= '$date_from' 
    //             AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = arrivals.id
    //             ) <= '$date_to')
    //         )";
    //     }

    //     $Search_data = [
    //         'locations'         => $this->input->get('country'),
    //         'city'         => $this->input->get('city'),
    //         'specility'         =>$this->input->get('specility'),
    //         'restaurants'         => $this->input->get('restaurants'),
    //         'date_from'         => $this->input->get('date_from'),
    //         'date_to'           => $this->input->get('date_to'),
    //     ];
    //     if ($this->input->get('submit') <> '') {
    //         log_user_activity('Transport Report Search',$this->session->userdata('id'), 'Search: '. json_encode($Search_data));
    //     }

    //     // Get restaurant data with total persons
    //     $restaurant_query = "
    //         SELECT 
    //             ar_data.restaurant_id,
    //             r.*,
    //             SUM(ar_data.no_of_person) AS total_no_of_person
    //         FROM (
    //             SELECT 
    //                 ar.restaurant_id,
    //                 SUM(rm_max.no_of_person) AS no_of_person
    //             FROM arrival_restaurants AS ar
    //             LEFT JOIN (
    //                 SELECT 
    //                     restaurant_id,
    //                     date,
    //                     buffet,
    //                     arr_id,
    //                     MAX(no_of_person) AS no_of_person
    //                 FROM restaurant_menus
    //                 GROUP BY restaurant_id, date, buffet, arr_id
    //             ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
    //                 AND rm_max.date = ar.date
    //                 AND rm_max.buffet = ar.buffet
    //                 AND rm_max.arr_id = ar.arrival_id
    //             LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
    //             LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //             WHERE 1=1 $date_where
    //             GROUP BY 
    //                 ar.restaurant_id,
    //                 ar.arrival_id
    //         ) AS ar_data
    //         LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
    //         WHERE $where
    //         GROUP BY 
    //             ar_data.restaurant_id
    //         ORDER BY 
    //             r.name
    //     ";

    //     // Get total count
    //     $count_query = "
    //         SELECT COUNT(*) as total_count
    //         FROM (
    //             SELECT ar_data.restaurant_id
    //             FROM (
    //                 SELECT 
    //                     ar.restaurant_id,
    //                     SUM(rm_max.no_of_person) AS no_of_person
    //                 FROM arrival_restaurants AS ar
    //                 LEFT JOIN (
    //                     SELECT 
    //                         restaurant_id,
    //                         date,
    //                         buffet,
    //                         arr_id,
    //                         MAX(no_of_person) AS no_of_person
    //                     FROM restaurant_menus
    //                     GROUP BY restaurant_id, date, buffet, arr_id
    //                 ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
    //                     AND rm_max.date = ar.date
    //                     AND rm_max.buffet = ar.buffet
    //                     AND rm_max.arr_id = ar.arrival_id
    //                 LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
    //                 LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //                 WHERE 1=1 $date_where
    //                 GROUP BY 
    //                     ar.restaurant_id,
    //                     ar.arrival_id
    //             ) AS ar_data
    //             LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
    //             WHERE $where
    //             GROUP BY ar_data.restaurant_id
    //         ) AS subquery
    //     ";

    //     $config["total_rows"] = $this->db->query($count_query)->row()->total_count;
    //     $result_cnt = $config["total_rows"];
    //     $data['total'] = $result_cnt;
    //     $config["per_page"] = 10;
    //     $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //     $config['full_tag_close'] = '</ul>';
    //     $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['first_tag_close'] = '</li>';
    //     $config['prev_link'] = 'Previous';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['next_tag_close'] = '</li>';
    //     $config['last_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['last_tag_close'] = '</li>';
    //     $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="paginate_button page-item">';
    //     $config['num_tag_close'] = '</li>';
    //     $config['page_query_string'] = TRUE;
    //     $this->pagination->initialize($config);
    //     $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //     $data['offset'] = $offset;

    //     // Add pagination to main query
    //     $restaurant_query .= " LIMIT $offset, " . $config["per_page"];
        
    //     $data['result'] = $this->db->query($restaurant_query)->result_array();
    //     $data['links'] = $this->pagination->create_links();
        
    //     log_user_activity('Restaurant Report View',$this->session->userdata('id'), 'Restaurant Report: View');
    //     $data['content'] = 'admin/restaurant_report';
    //     $this->load->view('admin/layout', $data);
    // }
    
         public function get_restaurant_arrivals() 
    {
        $restaurant_id = $this->input->post('restaurant_id');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $tour_type = $this->input->post('tour_type');
        
        // Build date filter condition - use the SAME logic as main report
        $date_condition = "";
        if (!empty($date_from) && !empty($date_to)) {
            $date_condition = " AND (
                (e.split_count = 0 AND DATE(e.check_in_date) >= '$date_from' AND DATE(e.check_in_date) <= '$date_to')
                OR
                (e.split_count != 0 AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = ar.arrival_id
                ) >= '$date_from' 
                AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = ar.arrival_id
                ) <= '$date_to')
            )";
        }
        
        // Tour Type filter for modal - handle NULL enquiry_no
        $tour_type_condition = "";
        if (!empty($tour_type)) {
            if ($tour_type == 'fit') {
                $tour_type_condition = " AND (e.enquiry_no IS NULL OR e.enquiry_no NOT LIKE 'G%')";
            } elseif ($tour_type == 'git') {
                $tour_type_condition = " AND e.enquiry_no LIKE 'G%'";
            }
        }
        
        // Use the SAME logic as main report query
        $query = "
            SELECT 
                e.enquiry_no,
                ar.arrival_id,
                ar.date as restaurant_date,
                ar.buffet,
                COALESCE((
                    SELECT MAX(rm2.no_of_person) 
                    FROM restaurant_menus rm2 
                    WHERE rm2.restaurant_id = ar.restaurant_id 
                    AND rm2.date = ar.date 
                    AND rm2.arr_id = ar.arrival_id
                    AND rm2.buffet = ar.buffet
                ), 0) as no_of_person,
                e.check_in_date,
                e.check_out_date
            FROM arrival_restaurants ar
            LEFT JOIN arrivals a ON a.id = ar.arrival_id
            LEFT JOIN enquiry e ON e.id = a.enquiry_id
            WHERE ar.restaurant_id = ?
            $date_condition $tour_type_condition
            ORDER BY ar.date DESC
        ";
        
        $data = $this->db->query($query, [$restaurant_id])->result_array();
        
        // Debug: Log the query and parameters
        error_log("Tour Type: " . $tour_type);
        error_log("Query: " . $query);
        error_log("Restaurant ID: " . $restaurant_id);
        
        // Calculate total to verify
        $total_persons = 0;
        foreach ($data as $row) {
            $total_persons += $row['no_of_person'];
            error_log("Enquiry No: " . $row['enquiry_no'] . ", Persons: " . $row['no_of_person']);
        }
        
        echo json_encode([
            'success' => true, 
            'data' => $data,
            'total_persons' => $total_persons,
            'debug' => [
                'tour_type' => $tour_type,
                'record_count' => count($data)
            ]
        ]);
        exit;
    }

    public function restaurant_report()
    {
        $data['country'] = ['label' => '', 'country_id' => ''];
        
        if ($this->session->userdata('locations') != 'all') {
            $countries = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))]);
        
            if (!empty($countries)) {
                $data['country'] = $countries[0];
            }
        }

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'restaurant-report?' . $search[0];

        $where = ' r.status = "active" AND r.id IS NOT NULL';
        if ($this->input->get('country') <> '') {
            $where .= ' AND LOWER(r.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
        }
        if ($this->input->get('city') <> '') {
            $where .= ' AND LOWER(r.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
        }
        
        // Speciality filter
        if ($this->input->get('specility') <> '') {
            if ($this->input->get('specility') == 'indian') {
                $where .= ' AND r.cuisine = "indian"';
            } elseif ($this->input->get('specility') == 'international') {
                $where .= ' AND r.cuisine != "indian"';
            }
        }

        // Tour Type filter (FIT/GIT)
        $tour_type_where = '';
        if ($this->input->get('tour_type') <> '') {
            if ($this->input->get('tour_type') == 'fit') {
                $tour_type_where = " AND enquiry.enquiry_no NOT LIKE 'G%'";
            } elseif ($this->input->get('tour_type') == 'git') {
                $tour_type_where = " AND enquiry.enquiry_no LIKE 'G%'";
            }
        }

        if(!empty($this->input->get('restaurants'))){
            foreach($this->input->get('restaurants') AS $list){
                $ids[] = $list;
            }            
            $where .= ' AND r.id IN ('.implode(",",$ids).')';
        }

        // Date filter conditions based on enquiry table
        $date_where = '';
        if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $date_from = $this->input->get('date_from');
            $date_to = $this->input->get('date_to');
            
            $date_where = " AND (
                (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= '$date_from' AND DATE(enquiry.check_in_date) <= '$date_to')
                OR
                (enquiry.split_count != 0 AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = arrivals.id
                ) >= '$date_from' 
                AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = arrivals.id
                ) <= '$date_to')
            )";
        }

        $Search_data = [
            'locations'         => $this->input->get('country'),
            'city'         => $this->input->get('city'),
            'specility'         => $this->input->get('specility'),
            'tour_type'         => $this->input->get('tour_type'),
            'restaurants'       => $this->input->get('restaurants'),
            'date_from'         => $this->input->get('date_from'),
            'date_to'           => $this->input->get('date_to'),
        ];
        if ($this->input->get('submit') <> '') {
            log_user_activity('Transport Report Search',$this->session->userdata('id'), 'Search: '. json_encode($Search_data));
        }

        // Get restaurant data with total persons
        // $restaurant_query = "
        //     SELECT 
        //         ar_data.restaurant_id,
        //         r.*,
        //         SUM(ar_data.no_of_person) AS total_no_of_person
        //     FROM (
        //         SELECT 
        //             ar.restaurant_id,
        //             SUM(rm_max.no_of_person) AS no_of_person
        //         FROM arrival_restaurants AS ar
        //         LEFT JOIN (
        //             SELECT 
        //                 restaurant_id,
        //                 date,
        //                 buffet,
        //                 arr_id,
        //                 MAX(no_of_person) AS no_of_person
        //             FROM restaurant_menus
        //             GROUP BY restaurant_id, date, buffet, arr_id
        //         ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
        //             AND rm_max.date = ar.date
        //             AND rm_max.buffet = ar.buffet
        //             AND rm_max.arr_id = ar.arrival_id
        //         LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
        //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //         WHERE 1=1 $date_where $tour_type_where
        //         GROUP BY 
        //             ar.restaurant_id,
        //             ar.arrival_id
        //     ) AS ar_data
        //     LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
        //     WHERE $where
        //     GROUP BY 
        //         ar_data.restaurant_id
        //     ORDER BY 
        //         r.name
        // ";

        // Get restaurant data with total persons and meal counts
        // $restaurant_query = "
        //     SELECT 
        //         ar_data.restaurant_id,
        //         r.*,
        //         SUM(ar_data.no_of_person) AS total_no_of_person,
        //         COUNT(DISTINCT ar_data.arrival_id) AS file_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN 1 ELSE 0 END) AS lunch_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN 1 ELSE 0 END) AS high_tea_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN 1 ELSE 0 END) AS dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN 1 ELSE 0 END) AS gala_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS cocktail_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS others_count
        //     FROM (
        //         SELECT 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet,
        //             SUM(rm_max.no_of_person) AS no_of_person
        //         FROM arrival_restaurants AS ar
        //         LEFT JOIN (
        //             SELECT 
        //                 restaurant_id,
        //                 date,
        //                 buffet,
        //                 arr_id,
        //                 MAX(no_of_person) AS no_of_person
        //             FROM restaurant_menus
        //             GROUP BY restaurant_id, date, buffet, arr_id
        //         ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
        //             AND rm_max.date = ar.date
        //             AND rm_max.buffet = ar.buffet
        //             AND rm_max.arr_id = ar.arrival_id
        //         LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
        //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //         WHERE 1=1 $date_where $tour_type_where
        //         GROUP BY 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet
        //     ) AS ar_data
        //     LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
        //     WHERE $where
        //     GROUP BY 
        //         ar_data.restaurant_id
        //     ORDER BY 
        //         r.name
        // ";


        // Get restaurant data with total persons and meal counts
        // $restaurant_query = "
        //     SELECT 
        //         ar_data.restaurant_id,
        //         r.*,
        //         SUM(ar_data.no_of_person) AS total_no_of_person,
        //         COUNT(DISTINCT ar_data.arrival_id) AS file_count,
                
        //         -- Meal type counts (number of bookings)
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN 1 ELSE 0 END) AS lunch_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN 1 ELSE 0 END) AS high_tea_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN 1 ELSE 0 END) AS dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN 1 ELSE 0 END) AS gala_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS cocktail_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS others_count,
                
        //         -- Meal type pax counts (total persons)
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN ar_data.no_of_person ELSE 0 END) AS lunch_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN ar_data.no_of_person ELSE 0 END) AS high_tea_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN ar_data.no_of_person ELSE 0 END) AS dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN ar_data.no_of_person ELSE 0 END) AS gala_dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS cocktail_dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS others_pax
                
        //     FROM (
        //         SELECT 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet,
        //             SUM(rm_max.no_of_person) AS no_of_person
        //         FROM arrival_restaurants AS ar
        //         LEFT JOIN (
        //             SELECT 
        //                 restaurant_id,
        //                 date,
        //                 buffet,
        //                 arr_id,
        //                 MAX(no_of_person) AS no_of_person
        //             FROM restaurant_menus
        //             GROUP BY restaurant_id, date, buffet, arr_id
        //         ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
        //             AND rm_max.date = ar.date
        //             AND rm_max.buffet = ar.buffet
        //             AND rm_max.arr_id = ar.arrival_id
        //         LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
        //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //         WHERE 1=1 $date_where $tour_type_where
        //         GROUP BY 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet
        //     ) AS ar_data
        //     LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
        //     WHERE $where
        //     GROUP BY 
        //         ar_data.restaurant_id
        //     ORDER BY 
        //         r.name
        // ";
        
        
        // Get restaurant data with total persons and meal counts
        $restaurant_query = "
            SELECT 
                ar_data.restaurant_id,
                r.*,
                -- Count each arrival only once for total persons (regardless of dates)
                SUM(ar_data.arrival_person_count) AS total_no_of_person,
                COUNT(DISTINCT ar_data.arrival_id) AS file_count,
                
                -- Meal type counts (number of bookings)
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN 1 ELSE 0 END) AS lunch_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN 1 ELSE 0 END) AS high_tea_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN 1 ELSE 0 END) AS dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN 1 ELSE 0 END) AS gala_dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS cocktail_dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS others_count,
                
                -- Meal type pax counts (total persons)
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN ar_data.no_of_person ELSE 0 END) AS lunch_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN ar_data.no_of_person ELSE 0 END) AS high_tea_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN ar_data.no_of_person ELSE 0 END) AS dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN ar_data.no_of_person ELSE 0 END) AS gala_dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS cocktail_dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS others_pax
                
            FROM (
                SELECT 
                    ar.restaurant_id,
                    ar.arrival_id,
                    ar.buffet,
                    ar.date,
                    -- Calculate person count per meal type
                    SUM(rm_max.no_of_person) AS no_of_person,
                    -- Calculate person count per arrival (count each arrival only once regardless of date)
                    CASE 
                        WHEN ROW_NUMBER() OVER (PARTITION BY ar.restaurant_id, ar.arrival_id ORDER BY ar.date, ar.buffet) = 1 
                        THEN SUM(rm_max.no_of_person) 
                        ELSE 0 
                    END AS arrival_person_count
                FROM arrival_restaurants AS ar
                LEFT JOIN (
                    SELECT 
                        restaurant_id,
                        date,
                        buffet,
                        arr_id,
                        MAX(no_of_person) AS no_of_person
                    FROM restaurant_menus
                    GROUP BY restaurant_id, date, buffet, arr_id
                ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
                    AND rm_max.date = ar.date
                    AND rm_max.buffet = ar.buffet
                    AND rm_max.arr_id = ar.arrival_id
                LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
                LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
                WHERE 1=1 $date_where $tour_type_where
                GROUP BY 
                    ar.restaurant_id,
                    ar.arrival_id,
                    ar.buffet,
                    ar.date
            ) AS ar_data
            LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
            WHERE $where
            GROUP BY 
                ar_data.restaurant_id
            ORDER BY 
                r.name
        ";

        // Get total count
        $count_query = "
            SELECT COUNT(*) as total_count
            FROM (
                SELECT ar_data.restaurant_id
                FROM (
                    SELECT 
                        ar.restaurant_id,
                        SUM(rm_max.no_of_person) AS no_of_person
                    FROM arrival_restaurants AS ar
                    LEFT JOIN (
                        SELECT 
                            restaurant_id,
                            date,
                            buffet,
                            arr_id,
                            MAX(no_of_person) AS no_of_person
                        FROM restaurant_menus
                        GROUP BY restaurant_id, date, buffet, arr_id
                    ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
                        AND rm_max.date = ar.date
                        AND rm_max.buffet = ar.buffet
                        AND rm_max.arr_id = ar.arrival_id
                    LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
                    LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
                    WHERE 1=1 $date_where $tour_type_where
                    GROUP BY 
                        ar.restaurant_id,
                        ar.arrival_id
                ) AS ar_data
                LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
                WHERE $where
                GROUP BY ar_data.restaurant_id
            ) AS subquery
        ";

        $config["total_rows"] = $this->db->query($count_query)->row()->total_count;
        $result_cnt = $config["total_rows"];
        $data['total'] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;

        // Add pagination to main query
        $restaurant_query .= " LIMIT $offset, " . $config["per_page"];
        
        $data['result'] = $this->db->query($restaurant_query)->result_array();
        $data['links'] = $this->pagination->create_links();
        
        log_user_activity('Restaurant Report View',$this->session->userdata('id'), 'Restaurant Report: View');
        $data['content'] = 'admin/restaurant_report';
        $this->load->view('admin/layout', $data);
    }

    public function print_restaurant_details()
    {
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            redirect('restaurant-report');
        }
        $id = base64_decode($this->input->get('id'));

        $where = 'restaurants.status = "active" AND restaurants.id = ' . $id;
        if ($this->input->get('country') <> '') {
            $where .= ' AND restaurants.country = "' . trim($this->input->get('country')) . '"';
        }
        if ($this->input->get('city') <> '') {
            $where .= ' AND restaurants.city = "' . trim($this->input->get('city')) . '"';
        }
        if ($this->input->get('specility') <> '') {
            $where .= ' AND restaurants.cuisine = "' . trim($this->input->get('specility')) . '"';
        }

        $data['result'] = $this->common_model->get_data('restaurants', '', '', '*', $where, '', $count = false, '');

        if ($this->input->get('print') == 'pdf') {
            log_user_activity('Restaurant Report Print Save As PDF',$this->session->userdata('id'), 'Restaurant Report: Print Save As PDF');
            // $data['content'] = 'admin/print_restaurant_details_pdf';
            $this->load->view('admin/print_restaurant_details_pdf', $data);
        } else {
            log_user_activity('Restaurant Report Print View',$this->session->userdata('id'), 'Restaurant Report: Print View');
            // $data['content'] = 'admin/print_restaurant_details';
            $this->load->view('admin/print_restaurant_details', $data);
        }
    }

    public function selected_print_restaurant_details()
    {
        $id = base64_decode($this->input->get('ids'));
        $ids_without_commas = str_replace(',', '', $id);

        if ($this->input->get('ids') == '' || !is_numeric($ids_without_commas)) {
            redirect('restaurant-report');
        }

        $where = 'restaurants.status = "active" AND restaurants.id IN (' . $id . ')';

        $data['result'] = $this->common_model->get_data('restaurants', '', '', '*', $where, '', $count = false, '');

        if ($this->input->get('print') == 'pdf') {
            log_user_activity('Restaurant Report Selected Print Save As PDF',$this->session->userdata('id'), 'Restaurant Report: Selected Print Save As PDF');
            // $data['content'] = 'admin/selected_print_restaurant_details_pdf';
            $this->load->view('admin/selected_print_restaurant_details_pdf', $data);
        } else {
            log_user_activity('Restaurant Report Selected Print View',$this->session->userdata('id'), 'Restaurant Report: Selected Print View');
            // $data['content'] = 'admin/selected_print_restaurant_details';
            $this->load->view('admin/selected_print_restaurant_details', $data);
        }
    }

    public function get_country_name_ajax()
    {
        $this->db->select('*');
        // Select record
        $this->db->where_in("id", [11, 15, 20, 81, 112, 234]);
        //$this->db->limit(10);
        $records = $this->db->get('countries')->result();
        echo json_encode(['response' => 'success', 'details' => $records]);
    }

    public function live_tracking()
    {
        $data['content'] = 'admin/live_tracking';
        $this->load->view('admin/layout', $data);
    }
 
    public function live_tracking_files()
    {
        $data['content'] = 'admin/live_tracking_files';
        $this->load->view('admin/layout', $data);
    }

    /* 29 april */
    // public function date_based_files()
    // {
    //     $date = $this->uri->segment(2);
    //     $select = "enquiry.id,enquiry.enquiry_no,enquiry.enquiry_abbr";
    
    //     $location = $this->session->userdata('locations');
    //     // print_r($location);
    //     $location_condition = "";
    
    //     if ($location == 'kazakhstan') {
    //         $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'KZ'";
    //     } elseif ($location == 'azerbaijan') {
    //         $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'AZ'";
    //     } elseif ($location == 'belarus') {
    //         $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'BZ'";
    //     } elseif ($location == 'georgia') {
    //         $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'GE'";
    //     }
    
    //     $where = "enquiry.status != 'cancel-at-arrival' 
    //     AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //     AND '$date' BETWEEN enquiry.check_in_date AND enquiry.check_out_date
    //     AND itinerary.date = '$date' ";
        
    
    //     if (!empty($location_condition)) {
    //         $where .= " AND $location_condition";
    //     }
    
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
    //         ['type' => 'LEFT', 'join_table' => 'itinerary', 'condition' => 'itinerary.arrival_id = arrivals.id'],
    //     ];
    
    //     $data = $this->common_model->get_data('enquiry', '', '', $select, $where, 'Group By itinerary.arrival_id', $count = false, $join);
    
    //     // Initialize an array to store counts
    //     $enquiryAbbrCounts = [];
    
    //     // Count occurrences of each enquiry_abbr
    //     foreach ($data as $item) {
    //         $enquiryAbbr = substr($item->enquiry_abbr, 1);
    //         if (isset($enquiryAbbrCounts[$enquiryAbbr])) {
    //             $enquiryAbbrCounts[$enquiryAbbr]++;
    //         } else {
    //             $enquiryAbbrCounts[$enquiryAbbr] = 1;
    //         }
    //     }
    
    //     echo json_encode(['response' => 'success', 'details' => $enquiryAbbrCounts, 'user_location' => $location]);
    // }
    
    /* 29 april */

    // public function date_based_files()
    // {
    //     $date = $this->uri->segment(2);
    //     $select = "enquiry.id,enquiry.enquiry_no,enquiry.enquiry_abbr";
    
    //     $locations = explode(',', $this->session->userdata('locations'));
    //     $location_conditions = [];
    
    //     $location_map = [
    //         'kazakhstan' => 'KZ',
    //         'azerbaijan' => 'AZ',
    //         'belarus' => 'BZ',
    //         'georgia' => 'GE'
    //     ];
    
    //     foreach ($locations as $loc) {
    //         $abbr = $location_map[strtolower(trim($loc))] ?? null;
    //         if ($abbr) {
    //             $location_conditions[] = "SUBSTRING(enquiry.enquiry_abbr, 2) = '$abbr'";
    //         }
    //     }
    
    //     $location_condition = "";
    //     if (!empty($location_conditions)) {
    //         $location_condition = '(' . implode(' OR ', $location_conditions) . ')';
    //     }
    
    //     $where = "enquiry.status != 'cancel-at-arrival' 
    //         AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //         AND '$date' BETWEEN enquiry.check_in_date AND enquiry.check_out_date";
    
    //     if (!empty($location_condition)) {
    //         $where .= " AND $location_condition";
    //     }
    
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
    //         ['type' => 'LEFT', 'join_table' => 'itinerary', 'condition' => 'itinerary.arrival_id = arrivals.id'],
    //     ];
    
    //     $data = $this->common_model->get_data('enquiry', '', '', $select, $where, 'Group By arrivals.enquiry_id', $count = false, $join);
    
    //     $enquiryAbbrCounts = [];
    
    //     foreach ($data as $item) {
    //         $enquiryAbbr = substr($item->enquiry_abbr, 1); // Remove prefix (e.g., EAZ -> AZ)
    //         if (isset($enquiryAbbrCounts[$enquiryAbbr])) {
    //             $enquiryAbbrCounts[$enquiryAbbr]++;
    //         } else {
    //             $enquiryAbbrCounts[$enquiryAbbr] = 1;
    //         }
    //     }
    
    //     echo json_encode(['response' => 'success', 'details' => $enquiryAbbrCounts, 'user_location' => implode(',', $locations)]);
    // }
    

    // public function live_tracking_all_files($date, $enq_abbr)
    // {
    //     $date = $this->db->escape($date);
    //     $enq_abbr = $this->db->escape($enq_abbr);
        
    //     $select = "arrivals.*, 
    //       arrivals.guide_id as g_id, 
    //       enquiry.enquiry_no, 
    //       enquiry.number_persons, 
    //       enquiry.number_child, 
    //       enquiry.check_in_date, 
    //       enquiry.check_out_date as n, 
    //       arrival_hotel_details.hotel_name, 
    //       company.name AS filename, 
    //       driver_name AS Driver, 
    //       drivers.driver_phone_number,
    //       transportation.vehicle_type, 
    //       transportation.vehicle_name, 
    //       transportation.capacity, 
    //       transportation.luggage, 
    //       transportation.remarks, 
    //       enquiry_guide.guide_id as enquiry_guide_id,  
    //       eg_guides.name as enquiry_guide_name,
    //       eg_guides.contact_number as enquiry_guide_contact,
    //       eg_guides.isd_codes as enquiry_guide_isdcode";

        
    //     $subquery = "(SELECT * FROM arrival_hotel_details ahd1 WHERE ahd1.id = (SELECT MAX(ahd2.id) FROM arrival_hotel_details ahd2 WHERE ahd2.enquiry_id = ahd1.enquiry_id)) as arrival_hotel_details";
        
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry_guide', 'condition' => 'enquiry_guide.enquiry_id = enquiry.id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides as eg_guides', 'condition' => 'eg_guides.id = enquiry_guide.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
    //         ['type' => 'LEFT', 'join_table' => 'itinerary', 'condition' => 'itinerary.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => 'drivers', 'condition' => 'drivers.id = arrivals.driver_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry_transport', 'condition' => 'enquiry_transport.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],
    //         ['type' => 'LEFT', 'join_table' => $subquery, 'condition' => 'arrival_hotel_details.enquiry_id = arrivals.enquiry_id'],
            
    //     ];
        
        // $where = "enquiry.status != 'cancel-at-arrival' 
        //     AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
        //     AND enquiry.check_in_date <= $date AND enquiry.check_out_date >= $date
        //     AND itinerary.date = $date 
        //     AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr";
        
    //     $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, 'Group By itinerary.arrival_id', false, $join);
        

    //     if (!empty($data['arrivals'])) {
    //         $enquiryIds = array_map(function($arrival) {
    //             return $arrival->enquiry_id;
    //         }, $data['arrivals']);
    //         $enquiryIds = implode(',', $enquiryIds);
        
    //         $whereFlights = "arrival_flight_details.enquiry_id IN ($enquiryIds)";
    //         $orderByFlights = 'ORDER BY arrival_flight_details.departure_date, arrival_flight_details.departure_time ASC';
    //         $joinFlights = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id']];
    //         $selectFlights = 'arrival_flight_details.*,arrival_flight_details.arrival_date as flight_arrival_date, airlines.name as airline_name';
        
    //         $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $selectFlights, $whereFlights, $orderByFlights, false, $joinFlights);
    //     }
                            
    //     // Check if there are multiple arrivals with g_id = 0
    //     if (!empty($data['arrivals'])) {

    //         $groupedItinerary = [];

    //         foreach ($data['arrivals'] as $arrival) {
    //             $id = $arrival->id;

    //             $where = 'itinerary.arrival_id = ' . $id . ' AND itinerary.status != "deleted"';
    //             $itinerary = $this->common_model->get_data('itinerary', '', '', '*', $where, 'ORDER BY itinerary.date, itinerary.time', false, '');

    //             foreach ($itinerary as $it) {
    //                 $groupedItinerary[$id][] = [
    //                     'date'         => $it->date,
    //                     'time'         => $it->time,
    //                     'title'        => $it->title,
    //                     'title_search' => $it->title_search,
    //                     'remarks' => $it->remarks,
    //                 ];
    //             }
    //         }

    //         $data['itinerary_details'] = $groupedItinerary;

            
    //         $transportationDetails = [];

    //         foreach ($data['arrivals'] as $arrival) {
    //             $transportationDetails[$arrival->id] = [
    //                 'vehicle_type'   => $arrival->vehicle_type,
    //                 'vehicle_name'   => $arrival->vehicle_name,
    //                 'capacity' => $arrival->capacity,
    //                 'luggage'   => $arrival->luggage,
    //                 'remarks' => $arrival->remarks,
    //             ];
    //         }

    //         $data['transportation_details'] = $transportationDetails;

            
    //         $flightDetails = [];


    //         foreach ($data['arrivals'] as $arrival) {
    //             $id = $arrival->id;

    //             // Fetch itinerary
    //             $where = 'itinerary.arrival_id = ' . $id . ' AND itinerary.status != "deleted"';
    //             $itinerary = $this->common_model->get_data('itinerary', '', '', '*', $where, 'ORDER BY itinerary.date, itinerary.time', false, '');

    //             // Fetch arrival restaurant buffet data
    //             $where_restaurants = 'arrival_restaurants.arrival_id = ' . $id .
    //                 ' AND restaurant_menus.buffet = arrival_restaurants.buffet' .
    //                 ' AND restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id' .
    //                 ' AND restaurant_menus.date = arrival_restaurants.date GROUP BY arrival_restaurants.id';

    //             $order_restaurants = 'ORDER BY arrival_restaurants.date, arrival_restaurants.opening_time ASC';

    //             $join_restaurants = [
    //                 ['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],
    //                 ['type' => 'LEFT', 'join_table' => 'restaurant_menus', 'condition' => '(restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id AND restaurant_menus.arr_id=' . $id . ')'],
    //             ];

    //             $select_restaurants = 'arrival_restaurants.*, restaurants.name, restaurants.description, restaurant_menus.packed';

    //             $arrival_restaurants = $this->common_model->get_data('arrival_restaurants', '', '', $select_restaurants, $where_restaurants, $order_restaurants, false, $join_restaurants);

    //             // Inject restaurant buffet into the itinerary      
    //             foreach ($arrival_restaurants as $arrival_buffet) {
    //                 foreach ($itinerary as $key => $list) {
    //                     if (
    //                         $arrival_buffet->date == $list->date &&
    //                         strtotime($arrival_buffet->date . ' ' . $arrival_buffet->opening_time) >= strtotime($list->date . ' ' . $list->time) &&
    //                         array_key_exists($key + 1, $itinerary) &&
    //                         strtotime($arrival_buffet->date . ' ' . $arrival_buffet->opening_time) <= strtotime($itinerary[$key + 1]->date . ' ' . $itinerary[$key + 1]->time)
    //                     ) {
    //                         $title = '<strong>Enjoy ' . $arrival_buffet->buffet . ' at ' . $arrival_buffet->name . '</strong>';
    //                         if ($arrival_buffet->packed == 1) {
    //                             $title = '<strong>Enjoy packed ' . $arrival_buffet->buffet . ' (' . $arrival_buffet->name . ')</strong>';
    //                         }

    //                         $inserted = (object)[
    //                             'date' => $arrival_buffet->date,
    //                             'time' => $arrival_buffet->opening_time,
    //                             'title' => $title,
    //                             'title_search' => '',
    //                             'remarks' => 'PREPAID',
    //                         ];

    //                         $arr1 = array_slice($itinerary, 0, $key + 1);
    //                         array_push($arr1, $inserted);
    //                         $arr2 = array_slice($itinerary, $key + 1);
    //                         $itinerary = array_merge($arr1, $arr2);
    //                         break;
    //                     }
    //                 }
    //             }

    //             // Store final itinerary per arrival
    //             foreach ($itinerary as $it) {
    //                 $groupedItinerary[$id][] = [
    //                     'date' => $it->date,
    //                     'time' => $it->time,
    //                     'title' => $it->title,
    //                     'title_search' => $it->title_search ?? '',
    //                     'remarks' => $it->remarks,
    //                 ];
    //             }

    //             // Fetch flight details for each arrival
    //             if (!empty($data['arrival_flight'])) {
    //                 foreach ($data['arrival_flight'] as $flight) {
    //                     if ($flight->enquiry_id == $arrival->enquiry_id) {
    //                         // Store flight details indexed by enquiry_id
    //                         $flightDetails[$arrival->enquiry_id][] = [
    //                             'flight_arrival_date' => $flight->flight_arrival_date,
    //                             'departure_date' => $flight->departure_date,
    //                             'airline_name' => $flight->airline_name,
    //                             'departure_city' => $flight->departure_city,
    //                             'arrival_city' => $flight->arrival_city,
    //                             'departure_time' => $flight->departure_time,
    //                             'arrival_time' => $flight->arrival_time,
    //                             'flight_mode' => $flight->flight_mode
    //                         ];
    //                     }
    //                 }
    //             }
    //         }

    //         $data['flight_details'] = $flightDetails;
    //     }

    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }
    
    
    // public function live_tracking_all_files($date, $enq_abbr)
    // {
    //     $date = $this->db->escape($date);
    //     $enq_abbr = $this->db->escape($enq_abbr);

    //     $select = "arrivals.*, 
    //     arrivals.guide_id as g_id, 
    //     enquiry.enquiry_no, 
    //     enquiry.number_persons, 
    //     enquiry.number_child, 
    //     enquiry.check_in_date, 
    //     enquiry.check_out_date as n, 
    //     arrival_hotel_details.hotel_name, 
    //     company.name AS filename, 
    //     driver_name AS Driver, 
    //     drivers.driver_phone_number,
    //     transportation.vehicle_type, 
    //     transportation.vehicle_name, 
    //     transportation.capacity, 
    //     transportation.luggage, 
    //     transportation.remarks, 
    //     enquiry_transport.quantity as transportation_quantity,
    //     enquiry_guide.guide_id as enquiry_guide_id,  
    //     eg_guides.name as enquiry_guide_name,
    //     eg_guides.contact_number as enquiry_guide_contact,
    //     eg_guides.isd_codes as enquiry_guide_isdcode";

    //     $subquery = "(SELECT * FROM arrival_hotel_details ahd1 WHERE ahd1.id = (SELECT MAX(ahd2.id) FROM arrival_hotel_details ahd2 WHERE ahd2.enquiry_id = ahd1.enquiry_id)) as arrival_hotel_details";

    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry_guide', 'condition' => 'enquiry_guide.enquiry_id = enquiry.id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides as eg_guides', 'condition' => 'eg_guides.id = enquiry_guide.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
    //         ['type' => 'LEFT', 'join_table' => 'drivers', 'condition' => 'drivers.id = arrivals.driver_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry_transport', 'condition' => 'enquiry_transport.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],
    //         ['type' => 'LEFT', 'join_table' => 'itinerary', 'condition' => 'itinerary.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => $subquery, 'condition' => 'arrival_hotel_details.enquiry_id = arrivals.enquiry_id'],
    //     ];
        
        
    //     // $where = "enquiry.status != 'cancel-at-arrival' 
    //     //     AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //     //     AND enquiry.check_in_date <= $date AND enquiry.check_out_date >= $date
    //     //     AND itinerary.date = $date 
    //     //     AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr";
        
    //     // $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, 'Group By itinerary.arrival_id', false, $join);

        
    //     $where = "enquiry.status != 'cancel-at-arrival' 
    //         AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //         AND enquiry.check_in_date <= $date AND enquiry.check_out_date >= $date
    //         AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr";
        
        
    //     //   $where = "enquiry.status != 'cancel-at-arrival' 
    //     //     AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //     //     AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr 
    //     //     AND (
    //     //         (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) = $date)
    //     //         OR 
    //     //         (enquiry.split_count != 0 AND DATE(arrival_hotel_details.checkin_date) = $date)
    //     //     )";

        

    //     // $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, '', false, $join);
    //     $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, 'Group By arrivals.enquiry_id', false, $join);


    //     if (!empty($data['arrivals'])) {
    //         $enquiryIds = array_column($data['arrivals'], 'enquiry_id');
    //         $enquiryIdsStr = implode(',', $enquiryIds);

    //         $whereFlights = "arrival_flight_details.enquiry_id IN ($enquiryIdsStr)";
    //         $orderByFlights = 'ORDER BY arrival_flight_details.departure_date, arrival_flight_details.departure_time ASC';
    //         $joinFlights = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id']];
    //         $selectFlights = 'arrival_flight_details.*,arrival_flight_details.arrival_date as flight_arrival_date, airlines.name as airline_name';

    //         $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $selectFlights, $whereFlights, $orderByFlights, false, $joinFlights);
    //     }

    //     $groupedItinerary = [];
    //     $flightDetails = [];

    //     foreach ($data['arrivals'] as $arrival) {
    //         $arrival_id = $arrival->id;

    //         $sql = "
    //             SELECT 
    //         'itinerary' AS source,
    //         itinerary.id,
    //         itinerary.arrival_id,
    //         itinerary.date,
    //         itinerary.time,
    //         itinerary.title,
    //         itinerary.title_search,
    //         itinerary.remarks,
    //         NULL AS restaurant_name,
    //         itinerary.content
    //     FROM itinerary
    //     WHERE itinerary.arrival_id = {$arrival_id} 
    //       AND itinerary.status != 'deleted'
        
    //     UNION ALL
        
    //     SELECT 
    //         'arrival_restaurant' AS source,
    //         arrival_restaurants.id,
    //         arrival_restaurants.arrival_id,
    //         arrival_restaurants.date,
    //         arrival_restaurants.opening_time AS time,
    //         CONCAT(
    //             '<strong>',
    //             IF(restaurant_menus.packed = 1, 
    //                 CONCAT('Enjoy packed ', arrival_restaurants.buffet, ' (', restaurants.name, ')'),
    //                 CONCAT('Enjoy ', arrival_restaurants.buffet, ' at ', restaurants.name)
    //             ),
    //             '</strong>'
    //         ) AS title,
    //         '' AS title_search,
    //         'PREPAID' AS remarks,
    //         restaurants.name AS restaurant_name,
    //         NULL AS content
    //     FROM arrival_restaurants
    //     LEFT JOIN restaurants ON restaurants.id = arrival_restaurants.restaurant_id
    //     LEFT JOIN restaurant_menus 
    //         ON restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id 
    //         AND restaurant_menus.arr_id = {$arrival_id}
    //     WHERE arrival_restaurants.arrival_id = {$arrival_id}
    //       AND restaurant_menus.buffet = arrival_restaurants.buffet
    //       AND restaurant_menus.date = arrival_restaurants.date
    //     GROUP BY arrival_restaurants.id
        
    //     ORDER BY date, time";

    //         $itinerary = $this->common_model->custom_query($sql);

    //         foreach ($itinerary as $it) {
    //             $groupedItinerary[$arrival_id][] = [
    //                 'date' => $it->date,
    //                 'time' => $it->time,
    //                 'title' => $it->title,
    //                 'title_search' => $it->title_search ?? '',
    //                 'content' => $it->content ?? '',
    //                 'remarks' => $it->remarks,
    //                 'restaurant_name' => $it->restaurant_name ?? '',
    //             ];
    //         }

    //         if (!empty($data['arrival_flight'])) {
    //             foreach ($data['arrival_flight'] as $flight) {
    //                 if ($flight->enquiry_id == $arrival->enquiry_id) {
    //                     $flightDetails[$arrival->enquiry_id][] = [
    //                         'flight_arrival_date' => $flight->flight_arrival_date,
    //                         'departure_date' => $flight->departure_date,
    //                         'airline_name' => $flight->airline_name,
    //                         'departure_city' => $flight->departure_city,
    //                         'arrival_city' => $flight->arrival_city,
    //                         'departure_time' => $flight->departure_time,
    //                         'arrival_time' => $flight->arrival_time,
    //                         'flight_mode' => $flight->flight_mode
    //                     ];
    //                 }
    //             }
    //         }
    //     }

    //     $data['itinerary_details'] = $groupedItinerary;
    //     $data['flight_details'] = $flightDetails;

    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }
    
    
    // Previous 21 Nov 2025
    // public function date_based_files()
    // {
    //     $date = $this->uri->segment(2);
    
    //     $select = "
    //         enquiry.id,
    //         enquiry.enquiry_no,
    //         enquiry.enquiry_abbr,
    //         enquiry.split_count,
    //         arrivals.id AS arrival_id,
    //         enquiry.check_in_date AS enquiry_checkin,
    //         enquiry.check_out_date AS enquiry_checkout,
    //         MIN(CASE WHEN enquiry.split_count > 0 THEN arrival_hotel_details.checkin_date END) AS split_min_checkin,
    //         MAX(CASE WHEN enquiry.split_count > 0 THEN arrival_hotel_details.checkout_date END) AS split_max_checkout
    //     ";
    
    //     $locations = explode(',', $this->session->userdata('locations'));
    //     $location_conditions = [];
    
    //     $location_map = [
    //         'kazakhstan' => 'KZ',
    //         'azerbaijan' => 'AZ',
    //         'belarus' => 'BZ',
    //         'georgia' => 'GE',
    //         'Armenia' => 'AR',
    //         'uzbekistan' => 'UZ'
    //     ];
    
    //     foreach ($locations as $loc) {
    //         $abbr = $location_map[strtolower(trim($loc))] ?? null;
    //         if ($abbr) {
    //             $location_conditions[] = "SUBSTRING(enquiry.enquiry_abbr, 2) = '$abbr'";
    //         }
    //     }
    
    //     $location_condition = "";
    //     if (!empty($location_conditions)) {
    //         $location_condition = '(' . implode(' OR ', $location_conditions) . ')';
    //     }
    
    //     // WHERE clause
    //     $where = "enquiry.status != 'cancel-at-arrival'
    //         AND arrivals.status IN ('complete', 'file-closed', 'in-progress')
    //         AND (
    //             (
    //                 enquiry.split_count > 0
    //                 AND '$date' BETWEEN arrival_hotel_details.checkin_date AND arrival_hotel_details.checkout_date
    //                 AND EXISTS (
    //                     SELECT 1 FROM itinerary i
    //                     WHERE i.arrival_id = arrivals.id
    //                     AND i.date = '$date'
    //                     AND i.status != 'deleted'
    //                 )
    //             )
    //             OR
    //             (
    //                 enquiry.split_count = 0
    //                 AND '$date' BETWEEN enquiry.check_in_date AND enquiry.check_out_date
    //             )
    //         )";
    
    //     if (!empty($location_condition)) {
    //         $where .= " AND $location_condition";
    //     }
    
    //     // JOINs
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
    //         ['type' => 'LEFT', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_hotel_details.enquiry_id = enquiry.id AND arrival_hotel_details.arrival_id = arrivals.id'],
    //     ];
    
    //     // GROUP BY
    //     $group_by = 'GROUP BY arrivals.id';
    
    //     // Get data
    //     $data = $this->common_model->get_data('enquiry', '', '', $select, $where, $group_by, false, $join);
    
    //     $enquiryAbbrCounts = [];
    
    //     foreach ($data as $item) {
    //         $enquiryAbbr = substr($item->enquiry_abbr, 1);
    //         if (isset($enquiryAbbrCounts[$enquiryAbbr])) {
    //             $enquiryAbbrCounts[$enquiryAbbr]++;
    //         } else {
    //             $enquiryAbbrCounts[$enquiryAbbr] = 1;
    //         }
    //     }
    
    //     echo json_encode([
    //         'response' => 'success',
    //         'details' => $enquiryAbbrCounts,
    //         'user_location' => implode(',', $locations),
    //         'data' => $data
    //     ]);
    // }
    
    
     // previous 21 Nov 2025
    // public function live_tracking_all_files($date, $enq_abbr)
    // {
    // $date = $this->db->escape($date);
    // $enq_abbr = $this->db->escape($enq_abbr);

    // $sql = "
    //     SELECT 
    //         arrivals.*, 
    //         arrivals.guide_id AS g_id, 
    //         enquiry.enquiry_no, 
    //         enquiry.number_persons, 
    //         enquiry.number_child, 
    //         enquiry.check_in_date, 
    //         enquiry.check_out_date AS n, 
    //         arrival_hotel_details.hotel_name, 
    //         company.name AS filename, 
    //         driver_name AS Driver, 
    //         drivers.driver_phone_number,
        
    //         -- Concatenate transportation details
    //         GROUP_CONCAT(DISTINCT transportation.vehicle_type SEPARATOR ', ') AS transport_vehicle_types,
    //         GROUP_CONCAT(DISTINCT transportation.vehicle_name SEPARATOR ', ') AS transport_vehicle_names,
    //         GROUP_CONCAT(DISTINCT transportation.capacity SEPARATOR ', ') AS transport_capacities,
    //         GROUP_CONCAT(DISTINCT transportation.luggage SEPARATOR ', ') AS transport_luggage,
    //         GROUP_CONCAT(DISTINCT transportation.remarks SEPARATOR ', ') AS transport_remarks,
    //         GROUP_CONCAT(DISTINCT enquiry_transport.quantity SEPARATOR ', ') AS transport_quantities,
        
    //         -- Concatenate guide details
    //         GROUP_CONCAT(DISTINCT enquiry_guide.guide_id) AS enquiry_guide_ids,
    //         GROUP_CONCAT(DISTINCT eg_guides.name SEPARATOR ', ') AS enquiry_guide_names,
    //         GROUP_CONCAT(DISTINCT eg_guides.contact_number SEPARATOR ', ') AS enquiry_guide_contacts,
    //         GROUP_CONCAT(DISTINCT eg_guides.isd_codes SEPARATOR ', ') AS enquiry_guide_isdcodes
        
    //     FROM arrivals
    //     LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //     LEFT JOIN enquiry_guide ON enquiry_guide.arrival_id = arrivals.id
    //     LEFT JOIN guides AS eg_guides ON eg_guides.id = enquiry_guide.guide_id
    //     LEFT JOIN guides ON guides.id = arrivals.guide_id
    //     LEFT JOIN company ON enquiry.company_id = company.company_id
    //     LEFT JOIN drivers ON drivers.id = arrivals.driver_id
    //     LEFT JOIN enquiry_transport ON enquiry_transport.arrival_id = arrivals.id
    //     LEFT JOIN transportation ON transportation.id = enquiry_transport.transportation_id
    //     LEFT JOIN itinerary ON itinerary.arrival_id = arrivals.id
    //     LEFT JOIN arrival_hotel_details ON arrival_hotel_details.enquiry_id = enquiry.id 
    //                                   AND arrival_hotel_details.arrival_id = arrivals.id 
        
    //     WHERE enquiry.status != 'cancel-at-arrival'
    //       AND arrivals.status IN ('complete', 'file-closed', 'in-progress')
    //       AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr
    //       AND (
    //             (
    //               enquiry.split_count > 0 
    //               AND $date BETWEEN arrival_hotel_details.checkin_date AND arrival_hotel_details.checkout_date
    //               AND EXISTS (
    //                   SELECT 1 
    //                   FROM itinerary i 
    //                   WHERE i.arrival_id = arrivals.id 
    //                   AND i.date = $date
    //                   AND i.status != 'deleted'
    //               )
    //             )
    //             OR
    //             (
    //               enquiry.split_count = 0 
    //               AND $date BETWEEN enquiry.check_in_date AND enquiry.check_out_date
    //             )
    //           )
    //     GROUP BY arrivals.id
    //     ";

    // $data['arrivals'] = $this->db->query($sql)->result();

    // // $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, $group_by, false, $join);


    //     // $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, 'Group By arrivals.enquiry_id', false, $join);

    //     if (!empty($data['arrivals'])) {
    //         $enquiryIds = array_column($data['arrivals'], 'enquiry_id');
    //         $enquiryIdsStr = implode(',', $enquiryIds);

    //         $whereFlights = "arrival_flight_details.enquiry_id IN ($enquiryIdsStr)";
    //         $orderByFlights = 'ORDER BY arrival_flight_details.departure_date, arrival_flight_details.departure_time ASC';
    //         $joinFlights = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id']];
    //         $selectFlights = 'arrival_flight_details.*,arrival_flight_details.arrival_date as flight_arrival_date, airlines.name as airline_name';

    //         $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $selectFlights, $whereFlights, $orderByFlights, false, $joinFlights);
    //     }

    //     $groupedItinerary = [];
    //     $flightDetails = [];

    //     foreach ($data['arrivals'] as $arrival) {
    //         $arrival_id = $arrival->id;

    //         $sql = "
    //             SELECT 
    //                 'itinerary' AS source,
    //                 itinerary.id,
    //                 itinerary.arrival_id,
    //                 itinerary.date,
    //                 itinerary.time,
    //                 itinerary.title,
    //                 itinerary.title_search,
    //                 itinerary.remarks,
    //                 NULL AS restaurant_name,
    //                 itinerary.content
    //             FROM itinerary
    //             WHERE itinerary.arrival_id = {$arrival_id} 
    //               AND itinerary.status != 'deleted'
                
    //             UNION ALL
                
    //             SELECT 
    //                 'arrival_restaurant' AS source,
    //                 arrival_restaurants.id,
    //                 arrival_restaurants.arrival_id,
    //                 arrival_restaurants.date,
    //                 arrival_restaurants.opening_time AS time,
    //                 CONCAT(
    //                     '<strong>',
    //                     IF(restaurant_menus.packed = 1, 
    //                         CONCAT('Enjoy packed ', arrival_restaurants.buffet, ' (', restaurants.name, ')'),
    //                         CONCAT('Enjoy ', arrival_restaurants.buffet, ' at ', restaurants.name)
    //                     ),
    //                     '</strong>'
    //                 ) AS title,
    //                 '' AS title_search,
    //                 'PREPAID' AS remarks,
    //                 restaurants.name AS restaurant_name,
    //                 NULL AS content
    //             FROM arrival_restaurants
    //             LEFT JOIN restaurants ON restaurants.id = arrival_restaurants.restaurant_id
    //             LEFT JOIN restaurant_menus 
    //                 ON restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id 
    //                 AND restaurant_menus.arr_id = {$arrival_id}
    //             WHERE arrival_restaurants.arrival_id = {$arrival_id}
    //               AND restaurant_menus.buffet = arrival_restaurants.buffet
    //               AND restaurant_menus.date = arrival_restaurants.date
    //             GROUP BY arrival_restaurants.id
                
    //             ORDER BY date, time
    //             ";

    //         $itinerary = $this->common_model->custom_query($sql);

    //         foreach ($itinerary as $it) {
    //             $groupedItinerary[$arrival_id][] = [
    //                 'date' => $it->date,
    //                 'time' => $it->time,
    //                 'title' => $it->title,
    //                 'title_search' => $it->title_search ?? '',
    //                 'content' => $it->content ?? '',
    //                 'remarks' => $it->remarks,
    //                 'restaurant_name' => $it->restaurant_name ?? '',
    //             ];
    //         }

    //         if (!empty($data['arrival_flight'])) {
    //             foreach ($data['arrival_flight'] as $flight) {
    //                 if ($flight->enquiry_id == $arrival->enquiry_id) {
    //                     $flightDetails[$arrival->enquiry_id][] = [
    //                         'flight_arrival_date' => $flight->flight_arrival_date,
    //                         'departure_date' => $flight->departure_date,
    //                         'airline_name' => $flight->airline_name,
    //                         'departure_city' => $flight->departure_city,
    //                         'arrival_city' => $flight->arrival_city,
    //                         'departure_time' => $flight->departure_time,
    //                         'arrival_time' => $flight->arrival_time,
    //                         'flight_mode' => $flight->flight_mode
    //                     ];
    //                 }
    //             }
    //         }
    //     }

    //     $data['itinerary_details'] = $groupedItinerary;
    //     $data['flight_details'] = $flightDetails;

    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }
    
    
    // Updated 21 Nov 2025 with Combo Enquiry Support
    public function date_based_files()
    {
        $date = $this->uri->segment(2);

        $select = "
            enquiry.id AS enquiry_id,
            enquiry.enquiry_no,
            enquiry.enquiry_abbr,
            enquiry.split_count,

            arrivals.id AS arrival_id,

            enquiry.check_in_date AS enquiry_checkin,
            enquiry.check_out_date AS enquiry_checkout,

            MIN(CASE WHEN enquiry.split_count > 0 THEN arrival_hotel_details.checkin_date END) AS split_min_checkin,
            MAX(CASE WHEN enquiry.split_count > 0 THEN arrival_hotel_details.checkout_date END) AS split_max_checkout,

            /* Combo enquiry fields */
            combo_enquiry.id AS combo_enquiry_id,
            combo_enquiry.enquiry_abbr AS combo_enquiry_abbr,
            combo_enquiry.check_in_date AS combo_checkin,
            combo_enquiry.check_out_date AS combo_checkout
        ";

        // --------------------------
        // HANDLE LOCATION FILTER
        // --------------------------

        $locations = explode(',', $this->session->userdata('locations'));
        $location_conditions = [];

        $location_map = [
            'kazakhstan' => 'KZ',
            'azerbaijan' => 'AZ',
            'belarus' => 'BZ',
            'georgia' => 'GE',
            'armenia' => 'AR',
            'uzbekistan' => 'UZ'
        ];

        foreach ($locations as $loc) {
            $abbr = $location_map[strtolower(trim($loc))] ?? null;
            if ($abbr) {
                // Normal inquiry file
                $location_conditions[] = "SUBSTRING(enquiry.enquiry_abbr, 2) = '$abbr'";
                // Combo file
                $location_conditions[] = "SUBSTRING(combo_enquiry.enquiry_abbr, 2) = '$abbr'";
            }
        }

        $location_condition = "";
        if (!empty($location_conditions)) {
            $location_condition = "(" . implode(" OR ", $location_conditions) . ")";
        }

        // --------------------------
        // WHERE CONDITIONS
        // --------------------------

        $where = "
            enquiry.status != 'cancel-at-arrival'
            AND arrivals.status IN ('complete', 'file-closed', 'in-progress')
            AND (
                    /* NORMAL ENQUIRY */
                    (
                        SUBSTRING(enquiry.enquiry_abbr, 2) IS NOT NULL
                        AND (
                                (
                                    enquiry.split_count > 0
                                    AND '$date' BETWEEN arrival_hotel_details.checkin_date 
                                                    AND arrival_hotel_details.checkout_date
                                    AND EXISTS (
                                        SELECT 1 FROM itinerary i
                                        WHERE i.arrival_id = arrivals.id
                                        AND i.date = '$date'
                                        AND i.status != 'deleted'
                                    )
                                )
                                OR
                                (
                                    enquiry.split_count = 0
                                    AND '$date' BETWEEN enquiry.check_in_date AND enquiry.check_out_date
                                )
                            )
                    )

                    OR

                    /* COMBO ENQUIRY */
                    (
                        arrivals.combo_enquiry_id IS NOT NULL
                        AND '$date' BETWEEN combo_enquiry.check_in_date AND combo_enquiry.check_out_date
                    )
                )
        ";

        if (!empty($location_condition)) {
            $where .= " AND $location_condition";
        }

        // --------------------------
        // JOINS
        // --------------------------

        $join = [
            ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
            ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_hotel_details.enquiry_id = enquiry.id AND arrival_hotel_details.arrival_id = arrivals.id'],
        ];

        // GROUP BY
        $group_by = 'GROUP BY arrivals.id';

        // DATA FETCH
        $data = $this->common_model->get_data('enquiry', '', '', $select, $where, $group_by, false, $join);

        // COUNT BY ABBR
        $enquiryAbbrCounts = [];

        foreach ($data as $item) {

            // Prefer combo enquiry_abbr if exists
            if (!empty($item->combo_enquiry_abbr)) {
                $abbr = substr($item->combo_enquiry_abbr, 1);
            } else {
                $abbr = substr($item->enquiry_abbr, 1);
            }

            if (isset($enquiryAbbrCounts[$abbr])) {
                $enquiryAbbrCounts[$abbr]++;
            } else {
                $enquiryAbbrCounts[$abbr] = 1;
            }
        }

        echo json_encode([
            'response' => 'success',
            'details' => $enquiryAbbrCounts,
            'user_location' => implode(',', $locations),
            'data' => $data
        ]);
    }
    
    
    // Updated21 Nov 2025   
    public function live_tracking_all_files($date, $enq_abbr)
    {
        $date = $this->db->escape($date);
        $enq_abbr = $this->db->escape($enq_abbr);

        $sql = "
            SELECT 
                arrivals.*, 
                arrivals.guide_id AS g_id, 
                enquiry.enquiry_no, 
                /* Common fields (Normal or CMB chosen dynamically) */
                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.enquiry_abbr
                    ELSE enquiry.enquiry_abbr
                END AS enquiry_abbr_final,

                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.no_of_person
                    ELSE enquiry.number_persons
                END AS num_adults,

                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.no_of_child
                    ELSE enquiry.number_child
                END AS num_child,

                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.check_in_date
                    ELSE enquiry.check_in_date
                END AS check_in_date,

                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.check_out_date
                    ELSE enquiry.check_out_date
                END AS n,

                
                arrival_hotel_details.hotel_name, 
                company.name AS filename, 
                driver_name AS Driver, 
                drivers.driver_phone_number,

                GROUP_CONCAT(DISTINCT transportation.vehicle_type SEPARATOR ', ') AS transport_vehicle_types,
                GROUP_CONCAT(DISTINCT transportation.vehicle_name SEPARATOR ', ') AS transport_vehicle_names,
                GROUP_CONCAT(DISTINCT transportation.capacity SEPARATOR ', ') AS transport_capacities,
                GROUP_CONCAT(DISTINCT transportation.luggage SEPARATOR ', ') AS transport_luggage,
                GROUP_CONCAT(DISTINCT transportation.remarks SEPARATOR ', ') AS transport_remarks,
                GROUP_CONCAT(DISTINCT enquiry_transport.quantity SEPARATOR ', ') AS transport_quantities,

                GROUP_CONCAT(DISTINCT enquiry_guide.guide_id) AS enquiry_guide_ids,
                GROUP_CONCAT(DISTINCT eg_guides.name SEPARATOR ', ') AS enquiry_guide_names,
                GROUP_CONCAT(DISTINCT eg_guides.contact_number SEPARATOR ', ') AS enquiry_guide_contacts,
                GROUP_CONCAT(DISTINCT eg_guides.isd_codes SEPARATOR ', ') AS enquiry_guide_isdcodes

            FROM arrivals
            LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
            LEFT JOIN combo_enquiry ON combo_enquiry.id = arrivals.combo_enquiry_id
            LEFT JOIN enquiry_guide ON enquiry_guide.arrival_id = arrivals.id
            LEFT JOIN guides AS eg_guides ON eg_guides.id = enquiry_guide.guide_id
            LEFT JOIN guides ON guides.id = arrivals.guide_id
            LEFT JOIN company ON enquiry.company_id = company.company_id
            LEFT JOIN drivers ON drivers.id = arrivals.driver_id
            LEFT JOIN enquiry_transport ON enquiry_transport.arrival_id = arrivals.id
            LEFT JOIN transportation ON transportation.id = enquiry_transport.transportation_id
            LEFT JOIN itinerary ON itinerary.arrival_id = arrivals.id
            LEFT JOIN arrival_hotel_details ON arrival_hotel_details.enquiry_id = enquiry.id 
                                        AND arrival_hotel_details.arrival_id = arrivals.id 

            WHERE enquiry.status != 'cancel-at-arrival'
            AND arrivals.status IN ('complete', 'file-closed', 'in-progress')
            AND (
                    /* NORMAL ENQUIRY FILES */
                    (
                        SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr
                        AND (
                                (
                                    enquiry.split_count > 0
                                    AND $date BETWEEN arrival_hotel_details.checkin_date AND arrival_hotel_details.checkout_date
                                    AND EXISTS (
                                        SELECT 1 
                                        FROM itinerary i 
                                        WHERE i.arrival_id = arrivals.id 
                                        AND i.date = $date
                                        AND i.status != 'deleted'
                                    )
                                )
                                OR
                                (
                                    enquiry.split_count = 0
                                    AND $date BETWEEN enquiry.check_in_date AND enquiry.check_out_date
                                )
                            )
                    )
                    
                    OR
                    
                    /* CMB FILE LOGIC */
                    (
                        arrivals.combo_enquiry_id IS NOT NULL
                        AND SUBSTRING(combo_enquiry.enquiry_abbr, 2) = $enq_abbr
                        AND $date BETWEEN combo_enquiry.check_in_date AND combo_enquiry.check_out_date
                    )
                )

            GROUP BY arrivals.id
        ";

        $data['arrivals'] = $this->db->query($sql)->result();

        if (!empty($data['arrivals'])) {
            $enquiryIds = array_column($data['arrivals'], 'enquiry_id');
            $enquiryIdsStr = implode(',', $enquiryIds);

            $whereFlights = "arrival_flight_details.enquiry_id IN ($enquiryIdsStr)";
            $orderByFlights = 'ORDER BY arrival_flight_details.departure_date, arrival_flight_details.departure_time ASC';
            $joinFlights = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id']];
            $selectFlights = 'arrival_flight_details.*,arrival_flight_details.arrival_date as flight_arrival_date, airlines.name as airline_name';

            $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $selectFlights, $whereFlights, $orderByFlights, false, $joinFlights);
        }

        $groupedItinerary = [];
        $flightDetails = [];

        foreach ($data['arrivals'] as $arrival) {
            $arrival_id = $arrival->id;

            $sql = "
                SELECT 
                    'itinerary' AS source,
                    itinerary.id,
                    itinerary.arrival_id,
                    itinerary.date,
                    itinerary.time,
                    itinerary.title,
                    itinerary.title_search,
                    itinerary.remarks,
                    NULL AS restaurant_name,
                    itinerary.content
                FROM itinerary
                WHERE itinerary.arrival_id = {$arrival_id} 
                  AND itinerary.status != 'deleted'
                
                UNION ALL
                
                SELECT 
                    'arrival_restaurant' AS source,
                    arrival_restaurants.id,
                    arrival_restaurants.arrival_id,
                    arrival_restaurants.date,
                    arrival_restaurants.opening_time AS time,
                    CONCAT(
                        '<strong>',
                        IF(restaurant_menus.packed = 1, 
                            CONCAT('Enjoy packed ', arrival_restaurants.buffet, ' (', restaurants.name, ')'),
                            CONCAT('Enjoy ', arrival_restaurants.buffet, ' at ', restaurants.name)
                        ),
                        '</strong>'
                    ) AS title,
                    '' AS title_search,
                    'PREPAID' AS remarks,
                    restaurants.name AS restaurant_name,
                    NULL AS content
                FROM arrival_restaurants
                LEFT JOIN restaurants ON restaurants.id = arrival_restaurants.restaurant_id
                LEFT JOIN restaurant_menus 
                    ON restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id 
                    AND restaurant_menus.arr_id = {$arrival_id}
                WHERE arrival_restaurants.arrival_id = {$arrival_id}
                  AND restaurant_menus.buffet = arrival_restaurants.buffet
                  AND restaurant_menus.date = arrival_restaurants.date
                GROUP BY arrival_restaurants.id
                
                ORDER BY date, time
                ";

            $itinerary = $this->common_model->custom_query($sql);

            foreach ($itinerary as $it) {
                $groupedItinerary[$arrival_id][] = [
                    'date' => $it->date,
                    'time' => $it->time,
                    'title' => $it->title,
                    'title_search' => $it->title_search ?? '',
                    'content' => $it->content ?? '',
                    'remarks' => $it->remarks,
                    'restaurant_name' => $it->restaurant_name ?? '',
                ];
            }

            if (!empty($data['arrival_flight'])) {
                foreach ($data['arrival_flight'] as $flight) {
                    if ($flight->enquiry_id == $arrival->enquiry_id) {
                        $flightDetails[$arrival->enquiry_id][] = [
                            'flight_arrival_date' => $flight->flight_arrival_date,
                            'departure_date' => $flight->departure_date,
                            'airline_name' => $flight->airline_name,
                            'departure_city' => $flight->departure_city,
                            'arrival_city' => $flight->arrival_city,
                            'departure_time' => $flight->departure_time,
                            'arrival_time' => $flight->arrival_time,
                            'flight_mode' => $flight->flight_mode
                        ];
                    }
                }
            }
        }

        $data['itinerary_details'] = $groupedItinerary;
        $data['flight_details'] = $flightDetails;

        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }
    
    public function activity_log()
    {
        $id = $this->uri->segment(1);

        $where = 'arrivals.id=' . $id;
        $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,hotels.city,hotels.state,';
        $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,company.company_logo,';
        $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,transportation.luggage_transport,';
        $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        $data['arrivals'] = $arrivals[0];

        $select = 'guides.*';
        $where = 'enquiry_guide.enquiry_id= ' . $arrivals[0]->enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
        $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);

        $select = 'transportation.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle';
        $where = 'enquiry_transport.enquiry_id= ' . $arrivals[0]->enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
        $data['data_transportation'] = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);

        $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1,hotels.address_2,hotels.city,hotels.state,hotels.map,arrival_room_details.id AS arrival_room_details_id';
        $where = 'arrival_hotel_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],
        ['type' => 'LEFT', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],];
        $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' GROUP BY arrival_hotel_details.id ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
        
        $select = 'drivers.*';
        $where = 'arrivals.id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'drivers.id = arrivals.driver_id'],];
        $data['data_drivers'] = $this->common_model->get_data('drivers', '', '', $select, $where, '', $count = false, $join);
        
        $data['arrival_flight'] = [];
        $where = 'arrival_flight_details.arrival_id = ' . $arrivals[0]->id;
        $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
        $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        if(empty($data['arrival_flight'])){
            $where = 'arrival_flight_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
            $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
            $select = 'arrival_flight_details.*,airlines.name';
            $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        }
        $where = 'itinerary.arrival_id= ' . $id . ' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, 'Order By itinerary.date,itinerary.time', $count = false, '');
        
        //*********** Adding restaurants to itinerary ***********
        $where = 'arrival_restaurants.arrival_id = ' . $id. ' AND restaurant_menus.buffet=arrival_restaurants.buffet
            AND restaurant_menus.restaurant_id=arrival_restaurants.restaurant_id AND restaurant_menus.date=arrival_restaurants.date GROUP BY arrival_restaurants.id';
        $order_by = ' ORDER BY arrival_restaurants.date,arrival_restaurants.opening_time ASC';
        $join = [['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],
                ['type' => 'LEFT', 'join_table' => 'restaurant_menus', 'condition' => '(restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id AND restaurant_menus.arr_id='.$id.')'],];
        $select = 'arrival_restaurants.*,restaurants.name,restaurants.description,restaurant_menus.packed';
        $data['arrival_restaurants'] = $this->common_model->get_data('arrival_restaurants', '', '', $select, $where, $order_by, $count = false, $join);

        foreach($data['arrival_restaurants'] AS $arrival_lists){
            $i=0;$inserted='';
            foreach($data['itinerary'] AS $key=>$list){
                //$chk_time = explode('-',$list->time);
                if($arrival_lists->date == $list->date && (strtotime($arrival_lists->date.' '.$arrival_lists->opening_time)>=strtotime($list->date.' '.$list->time) && array_key_exists($key + 1, $data['itinerary']) && strtotime($arrival_lists->date.' '.$arrival_lists->opening_time)<=strtotime($data['itinerary'][$key+1]->date.' '.$data['itinerary'][$key+1]->time))){
                    $title = '<strong>Enjoy '.$arrival_lists->buffet.' at '.$arrival_lists->name.'</strong>';
                    if($arrival_lists->packed == 1){
                        $title = '<strong>Enjoy packed '.$arrival_lists->buffet.' ('.$arrival_lists->name.')</strong>';
                    }
                    $inserted = (object)['date'=>$arrival_lists->date,'time'=>$arrival_lists->opening_time,'title'=>$title,'remarks'=>'PREPAID'];
                    $arr1 = array_slice( $data['itinerary'], 0, $key+1);
                    array_push($arr1,$inserted);
                    $arr2 = array_slice( $data['itinerary'], $key+1);
                    $data['itinerary'] = array_merge($arr1,$arr2);
                    break;
                }
                $i++;
            }
        }
        //*********** End adding restaurants to itinerary ***********
        
        $data['restaurant_menus'] = $this->restaurantmenumaster_model->available_menu_item($id);
        // $data['content'] = 'admin/activity_logs';
        $this->load->view('admin/activity_logs', $data);
    }

    // public function booking_room_details_data(){

    //     $hotel_id = urldecode($this->input->get('hotelId'));

    //     $select = 'arrival_room_details.*,hotels.name,enquiry.enquiry_no,
    //                 if(arrival_persons_details.category="adult",count(DISTINCT LOWER(replace(trim(arrival_persons_details.first_name)," ","")),LOWER(replace(trim(arrival_persons_details.last_name)," ",""))),"") as cnt_adult,
    //                 if(arrival_persons_details.category!="adult",count(DISTINCT LOWER(replace(trim(arrival_persons_details.first_name)," ","")),LOWER(replace(trim(arrival_persons_details.last_name)," ",""))),"") as cnt_child';
    //     $where = ' arrivals.status IN("complete","file-closed","in-progress") AND LEFT(enquiry.enquiry_abbr,1) '.(($this->input->get('report_type')=="group")?"=":"!=").' "G" ';
    //     $where .= ' AND arrival_room_details.hotel_id='.$hotel_id;
    //     if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //         $where .= ' AND (date(arrival_room_details.checkin_date) >="' . trim($this->input->get('date_from')) . '" AND date(arrival_room_details.checkout_date) <="' . trim($this->input->get('date_to')) . '")';
    //     }
    //     $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
    //              ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_room_details.enquiry_id'],
    //              ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'],
    //             ['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id']];
        
    //     $group_by = ' GROUP BY arrival_persons_details.arrival_room_details_id';
        
    //     if($this->input->get('report_type')=='group'){
    //         $select = 'arrival_room_details.*,hotels.name,enquiry.enquiry_no';
    //         $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
    //              ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_room_details.enquiry_id'],                 
    //             ['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id']];
    //         $where .= ' AND arrival_room_details.arrival_hotel_details_id!=0'; 
    //         //$group_by = ' GROUP BY arrival_room_details.arrival_hotel_details_id';
    //         $group_by = '';
    //     }
                
    //     $data['arrival_room_details'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where,$group_by.' order by arrival_room_details.enquiry_id',$count = false,$join);
    //     //echo $this->db->last_query();exit;
    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }
    
    // old 07 jan 2026
    // public function booking_room_details_data()
    // {
    //     $hotel_id = urldecode($this->input->get('hotelId'));
    //     $report_type = $this->input->get('report_type');

    //     $select = 'arrival_room_details.*,hotels.name,enquiry.enquiry_no,
    //         IF(arrival_persons_details.category="adult",
    //             COUNT(DISTINCT LOWER(REPLACE(TRIM(arrival_persons_details.first_name), " ", "")) 
    //                 + LOWER(REPLACE(TRIM(arrival_persons_details.last_name), " ", ""))),
    //             "") AS cnt_adult,
    //         IF(arrival_persons_details.category!="adult",
    //             COUNT(DISTINCT LOWER(REPLACE(TRIM(arrival_persons_details.first_name), " ", "")) 
    //                 + LOWER(REPLACE(TRIM(arrival_persons_details.last_name), " ", ""))),
    //             "") AS cnt_child';

    //     $where = 'arrivals.status IN("complete", "file-closed", "in-progress")';

    //     // Handle report_type logic
    //     if ($report_type === "group") {
    //         $where .= ' AND LEFT(enquiry.enquiry_abbr,1) = "G"';
    //     } elseif ($report_type === "individual") {
    //         $where .= ' AND LEFT(enquiry.enquiry_abbr,1) != "G"';
    //     }
    //     // If report_type is "all", no restriction is added

    //     $where .= ' AND arrival_room_details.hotel_id = ' . $hotel_id;

    //     // Date range filter
    //     if ($this->input->get('date_from') && $this->input->get('date_to')) {
    //         $where .= ' AND (
    //             DATE(arrival_room_details.checkin_date) >= "' . trim($this->input->get('date_from')) . '" 
    //             AND DATE(arrival_room_details.checkout_date) <= "' . trim($this->input->get('date_to')) . '"
    //         )';
    //     }

    //     // Join definitions
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_room_details.enquiry_id'],
    //         ['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id']
    //     ];

    //     $group_by = '';
    //     if ($report_type === "group") {
    //         $select = 'arrival_room_details.*,hotels.name,enquiry.enquiry_no';
    //         $where .= ' AND arrival_room_details.arrival_hotel_details_id != 0';
    //         // No group_by
    //     } else {
    //         $join[] = ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'];
    //         $group_by = ' GROUP BY arrival_persons_details.arrival_room_details_id';
    //     }

    //     // Fetch data
    //     $data['arrival_room_details'] = $this->common_model->get_data(
    //         'arrival_room_details',
    //         '',
    //         '',
    //         $select,
    //         $where,
    //         $group_by . ' ORDER BY arrival_room_details.enquiry_id',
    //         false,
    //         $join
    //     );

    //     echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    // }
    
    // Updated 07 jan 2026
// 	public function booking_room_details_data()
// 	{
// 		$hotel_id    = (int) $this->input->get('hotelId');
// 		$report_type = $this->input->get('report_type');

// 		$select = '
// 			e.enquiry_no,
// 			h.name AS hotel_name,

// 			MIN(ard.checkin_date)  AS min_checkin_date,
// 			MAX(ard.checkout_date) AS max_checkout_date,

// 			SUM(ard.number_of_rooms) AS total_rooms,

// 			SUM(
// 				DATEDIFF(ard.checkout_date, ard.checkin_date)
// 				* IFNULL(ard.number_of_rooms, 1)
// 			) AS total_room_nights,

// 			COUNT(DISTINCT CASE 
// 				WHEN apd.category = "adult" 
// 				THEN CONCAT(
// 					LOWER(REPLACE(TRIM(apd.first_name)," ","")),
// 					LOWER(REPLACE(TRIM(apd.last_name)," ",""))
// 				)
// 			END) AS total_adults,

// 			COUNT(DISTINCT CASE 
// 				WHEN apd.category != "adult" 
// 				THEN CONCAT(
// 					LOWER(REPLACE(TRIM(apd.first_name)," ","")),
// 					LOWER(REPLACE(TRIM(apd.last_name)," ",""))
// 				)
// 			END) AS total_children
// 		';

// 		$where = '
// 			a.status IN ("complete", "file-closed", "in-progress")
// 			AND ahd.hotel_id = ' . $hotel_id;

// 		// Report type filter
// 		if ($report_type === "group") {
// 			$where .= ' AND LEFT(e.enquiry_abbr,1) = "G"';
// 		} elseif ($report_type === "individual") {
// 			$where .= ' AND LEFT(e.enquiry_abbr,1) != "G"';
// 		}

// 		// Date filter
// 		if ($this->input->get('date_from') && $this->input->get('date_to')) {
// 			$where .= '
// 				AND DATE(ard.checkin_date) >= "' . $this->input->get('date_from') . '"
// 				AND DATE(ard.checkout_date) <= "' . $this->input->get('date_to') . '"';
// 		}

// 		$join = [
// 			['type' => '', 'join_table' => 'arrivals a', 'condition' => 'a.enquiry_id = e.id'],
// 			['type' => '', 'join_table' => 'arrival_hotel_details ahd', 'condition' => 'ahd.arrival_id = a.id'],
// 			['type' => '', 'join_table' => 'arrival_room_details ard', 'condition' => 'ard.arrival_hotel_details_id = ahd.id'],
// 			['type' => '', 'join_table' => 'hotels h', 'condition' => 'h.id = ahd.hotel_id'],
// 			['type' => 'LEFT', 'join_table' => 'arrival_persons_details apd', 'condition' => 'apd.arrival_room_details_id = ard.id'],
// 		];

// 		$group_by = ' GROUP BY e.enquiry_no, h.name';

// 		$data['arrival_room_details'] = $this->common_model->get_data(
// 			'enquiry e',
// 			'',
// 			'',
// 			$select,
// 			$where,
// 			$group_by,
// 			false,
// 			$join
// 		);

// 		echo json_encode([
// 			'response' => 'success',
// 			'details'  => $data
// 		]);
// 	}

    // Updated 08 jan 2026
    public function booking_room_details_data()
    {
        $hotel_id    = (int) $this->input->get('hotelId');
        $report_type = $this->input->get('report_type');

        $select = '
            e.enquiry_no,
            h.name AS hotel_name,
            MIN(ard.checkin_date)  AS min_checkin_date,
            MAX(ard.checkout_date) AS max_checkout_date,
            SUM(ard.number_of_rooms) AS total_rooms,
            SUM(
                DATEDIFF(ard.checkout_date, ard.checkin_date)
                * IFNULL(ard.number_of_rooms, 1)
            ) AS total_room_nights,
            SUM(ard.number_adults) AS total_adults,
            SUM(ard.number_child) AS total_children
        ';

        $where = '
            a.status IN ("complete", "file-closed", "in-progress")
            AND ahd.hotel_id = ' . $hotel_id;

        // Report type filter
        if ($report_type === "group") {
            $where .= ' AND LEFT(e.enquiry_abbr,1) = "G"';
        } elseif ($report_type === "individual") {
            $where .= ' AND LEFT(e.enquiry_abbr,1) != "G"';
        }

        // Date filter
        if ($this->input->get('date_from') && $this->input->get('date_to')) {
            $where .= '
                AND DATE(ard.checkin_date) >= "' . $this->input->get('date_from') . '"
                AND DATE(ard.checkout_date) <= "' . $this->input->get('date_to') . '"';
        }

        $join = [
            ['type' => '', 'join_table' => 'arrivals a', 'condition' => 'a.enquiry_id = e.id'],
            ['type' => '', 'join_table' => 'arrival_hotel_details ahd', 'condition' => 'ahd.arrival_id = a.id'],
            ['type' => '', 'join_table' => 'arrival_room_details ard', 'condition' => 'ard.arrival_hotel_details_id = ahd.id'],
            ['type' => '', 'join_table' => 'hotels h', 'condition' => 'h.id = ahd.hotel_id'],
        ];

        $group_by = ' GROUP BY e.enquiry_no, h.name';

        $data['arrival_room_details'] = $this->common_model->get_data(
            'enquiry e',
            '',
            '',
            $select,
            $where,
            $group_by,
            false,
            $join
        );

        echo json_encode([
            'response' => 'success',
            'details'  => $data
        ]);
    }
    
    // public function excel_download()
    // {
    //     log_user_activity('Restaurant Report Excel Download',$this->session->userdata('id'), 'Restaurant Report: Excel Downloaded');

    //     $where = ' restaurants.status = "active"';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(restaurants.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
    //     if ($this->input->get('city') <> '') {
    //         $where .= ' AND LOWER(restaurants.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
    //     }
    //     if ($this->input->get('specility') <> '') {
    //         $where .= ' AND restaurants.cuisine LIKE "%' . trim($this->input->get('specility')) . '%"';
    //     }
    //     if(!empty($this->input->get('restaurants'))){
    //         foreach($this->input->get('restaurants') AS $list){
    //             $ids[] = $list;
    //         }            
    //         $where .= ' AND restaurants.id IN ('.implode(",",$ids).')';
    //     }
        
    //     $result = $this->common_model->get_data('restaurants', '', '', '*', $where, ' ORDER BY restaurants.id DESC', $count = false, '');


    //     $this->load->library('PHPExcel');
    //     include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
    //     $objPHPExcel = new PHPExcel();

    //     $objPHPExcel->setActiveSheetIndex(0);


    //     //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

    //     $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
    //     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
    //     $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Restaurant');
    //     $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Specility');
    //     $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Price Range	');
    //     $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Timing');
    //     $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Seating Capacity');
    //     $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Address');
    //     $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Location');

    //     $row = 2;
    //     $sr = 1;
    //     if (isset($result[0])) {
    //         foreach ($result as $val) {

    //             $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
    //             $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->name);
    //             $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->cuisine);
    //             $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->price_range);
    //             $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->opening_time . ' - ' . $val->closing_time);
    //             $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $val->seating_capacity);
    //             $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, ucwords(strtolower($val->restaurant_address)));
    //             $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ucwords(strtolower($val->city . ', ' . $val->country)));
    //             $row++;
    //             $sr++;
    //         }
    //     }

    //     header('Content-Type: application/vnd.ms-excel'); //mime type
    //     header('Content-Disposition: attachment;filename="' . 'Restaurant-reports_' . date('d-m-Y') . '.xls' . '"');
    //     header('Cache-Control: max-age=0'); //no cache

    //     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //     //if you want to save it as .XLSX Excel 2007 format
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     //force user to download the Excel file without writing it to server's HD
    //     $objWriter->save('php://output');

    // }
    
    //   public function excel_download()
    // {
    //     // Clean output buffers
    //     while (ob_get_level()) {
    //         ob_end_clean();
    //     }
        
    //     log_user_activity('Restaurant Report Excel Download', $this->session->userdata('id'), 'Restaurant Report: Excel Downloaded');
        
    //     $where = ' r.status = "active" AND r.id IS NOT NULL';
    //     if ($this->input->get('country') <> '') {
    //         $where .= ' AND LOWER(r.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
    //     }
    //     if ($this->input->get('city') <> '') {
    //         $where .= ' AND LOWER(r.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
    //     }
    //     if ($this->input->get('specility') <> '') {
    //         if ($this->input->get('specility') == 'indian') {
    //             $where .= ' AND r.cuisine = "indian"';
    //         } elseif ($this->input->get('specility') == 'international') {
    //             $where .= ' AND r.cuisine != "indian"';
    //         }
    //     }

    //     // Tour Type filter (FIT/GIT)
    //     $tour_type_where = '';
    //     if ($this->input->get('tour_type') <> '') {
    //         if ($this->input->get('tour_type') == 'fit') {
    //             $tour_type_where = " AND enquiry.enquiry_no IS NOT NULL AND enquiry.enquiry_no <> '' AND enquiry.enquiry_no NOT LIKE 'G%'";
    //         } elseif ($this->input->get('tour_type') == 'git') {
    //             $tour_type_where = " AND enquiry.enquiry_no IS NOT NULL AND enquiry.enquiry_no LIKE 'G%'";
    //         }
    //     }

    //     if(!empty($this->input->get('restaurants'))){
    //         foreach($this->input->get('restaurants') AS $list){
    //             $ids[] = $list;
    //         }            
    //         $where .= ' AND r.id IN ('.implode(",",$ids).')';
    //     }

    //     // Date filter conditions
    //     $date_where = '';
    //     if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $date_from = $this->input->get('date_from');
    //         $date_to = $this->input->get('date_to');
            
    //         $date_where = " AND (
    //             (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= '$date_from' AND DATE(enquiry.check_in_date) <= '$date_to')
    //             OR
    //             (enquiry.split_count != 0 AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = arrivals.id
    //             ) >= '$date_from' 
    //             AND (
    //                 SELECT DATE(MIN(ahd.checkin_date))
    //                 FROM arrival_hotel_details ahd
    //                 WHERE ahd.arrival_id = arrivals.id
    //             ) <= '$date_to')
    //         )";
    //     }

    //     // Use the same query as the main report
    //     $restaurant_query = "
    //         SELECT 
    //             ar_data.restaurant_id,
    //             r.*,
    //             SUM(ar_data.no_of_person) AS total_no_of_person
    //         FROM (
    //             SELECT 
    //                 ar.restaurant_id,
    //                 SUM(rm_max.no_of_person) AS no_of_person
    //             FROM arrival_restaurants AS ar
    //             LEFT JOIN (
    //                 SELECT 
    //                     restaurant_id,
    //                     date,
    //                     buffet,
    //                     arr_id,
    //                     MAX(no_of_person) AS no_of_person
    //                 FROM restaurant_menus
    //                 GROUP BY restaurant_id, date, buffet, arr_id
    //             ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
    //                 AND rm_max.date = ar.date
    //                 AND rm_max.buffet = ar.buffet
    //                 AND rm_max.arr_id = ar.arrival_id
    //             LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
    //             LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //             WHERE 1=1 $date_where $tour_type_where
    //             GROUP BY 
    //                 ar.restaurant_id,
    //                 ar.arrival_id
    //         ) AS ar_data
    //         LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
    //         WHERE $where
    //         GROUP BY 
    //             ar_data.restaurant_id
    //         ORDER BY 
    //             r.name
    //     ";

    //     $result = $this->db->query($restaurant_query)->result();

    //     // Set headers for CSV
    //     header('Content-Type: text/csv; charset=utf-8');
    //     header('Content-Disposition: attachment; filename="Restaurant-reports_' . date('d-m-Y') . '.csv"');
    //     header('Pragma: no-cache');
    //     header('Expires: 0');

    //     // Create output stream
    //     $output = fopen('php://output', 'w');

    //     // Add BOM for UTF-8
    //     fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

    //     // Headers
    //     fputcsv($output, [
    //         'S. No.',
    //         'Restaurant',
    //         'Specility',
    //         'Price Range',
    //         'Timing',
    //         'Seating Capacity',
    //         'Total Pax',
    //         'Address',
    //         'Location'
    //     ]);

    //     // Data
    //     $sr = 1;
    //     foreach ($result as $val) {
    //         $timing = '';
    //         if (!empty($val->opening_time) && !empty($val->closing_time)) {
    //             $timing = $val->opening_time . ' - ' . $val->closing_time;
    //         }

    //         fputcsv($output, [
    //             $sr++,
    //             $val->name,
    //             $val->cuisine,
    //             $val->price_range,
    //             $timing,
    //             $val->seating_capacity,
    //             $val->total_no_of_person,
    //             ucwords(strtolower($val->restaurant_address)),
    //             ucwords(strtolower($val->city . ', ' . $val->country))
    //         ]);
    //     }

    //     fclose($output);
    //     exit;
    // }
    
    
    public function excel_download()
    {   
        // Clean output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        log_user_activity('Restaurant Report Excel Download', $this->session->userdata('id'), 'Restaurant Report: Excel Downloaded');
        
        $where = ' r.status = "active" AND r.id IS NOT NULL';
        if ($this->input->get('country') <> '') {
            $where .= ' AND LOWER(r.country) = "' . strtolower(trim($this->input->get('country'))) . '"';
        }
        if ($this->input->get('city') <> '') {
            $where .= ' AND LOWER(r.city) = "' . strtolower(trim($this->input->get('city'))) . '"';
        }
        if ($this->input->get('specility') <> '') {
            if ($this->input->get('specility') == 'indian') {
                $where .= ' AND r.cuisine = "indian"';
            } elseif ($this->input->get('specility') == 'international') {
                $where .= ' AND r.cuisine != "indian"';
            }
        }

        // Tour Type filter (FIT/GIT)
        $tour_type_where = '';
        if ($this->input->get('tour_type') <> '') {
            if ($this->input->get('tour_type') == 'fit') {
                $tour_type_where = " AND enquiry.enquiry_no IS NOT NULL AND enquiry.enquiry_no <> '' AND enquiry.enquiry_no NOT LIKE 'G%'";
            } elseif ($this->input->get('tour_type') == 'git') {
                $tour_type_where = " AND enquiry.enquiry_no IS NOT NULL AND enquiry.enquiry_no LIKE 'G%'";
            }
        }

        if(!empty($this->input->get('restaurants'))){
            foreach($this->input->get('restaurants') AS $list){
                $ids[] = $list;
            }            
            $where .= ' AND r.id IN ('.implode(",",$ids).')';
        }

        // Date filter conditions
        $date_where = '';
        if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $date_from = $this->input->get('date_from');
            $date_to = $this->input->get('date_to');
            
            $date_where = " AND (
                (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= '$date_from' AND DATE(enquiry.check_in_date) <= '$date_to')
                OR
                (enquiry.split_count != 0 AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = arrivals.id
                ) >= '$date_from' 
                AND (
                    SELECT DATE(MIN(ahd.checkin_date))
                    FROM arrival_hotel_details ahd
                    WHERE ahd.arrival_id = arrivals.id
                ) <= '$date_to')
            )";
        }

        // Use the updated query with meal counts and pax
        // $restaurant_query = "
        //     SELECT 
        //         ar_data.restaurant_id,
        //         r.*,
        //         SUM(ar_data.no_of_person) AS total_no_of_person,
        //         COUNT(DISTINCT ar_data.arrival_id) AS file_count,
                
        //         -- Meal type counts (number of bookings)
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN 1 ELSE 0 END) AS lunch_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN 1 ELSE 0 END) AS high_tea_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN 1 ELSE 0 END) AS dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN 1 ELSE 0 END) AS gala_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS cocktail_dinner_count,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS others_count,
                
        //         -- Meal type pax counts (total persons)
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN ar_data.no_of_person ELSE 0 END) AS lunch_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN ar_data.no_of_person ELSE 0 END) AS high_tea_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN ar_data.no_of_person ELSE 0 END) AS dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN ar_data.no_of_person ELSE 0 END) AS gala_dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS cocktail_dinner_pax,
        //         SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS others_pax
                
        //     FROM (
        //         SELECT 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet,
        //             SUM(rm_max.no_of_person) AS no_of_person
        //         FROM arrival_restaurants AS ar
        //         LEFT JOIN (
        //             SELECT 
        //                 restaurant_id,
        //                 date,
        //                 buffet,
        //                 arr_id,
        //                 MAX(no_of_person) AS no_of_person
        //             FROM restaurant_menus
        //             GROUP BY restaurant_id, date, buffet, arr_id
        //         ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
        //             AND rm_max.date = ar.date
        //             AND rm_max.buffet = ar.buffet
        //             AND rm_max.arr_id = ar.arrival_id
        //         LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
        //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //         WHERE 1=1 $date_where $tour_type_where
        //         GROUP BY 
        //             ar.restaurant_id,
        //             ar.arrival_id,
        //             ar.buffet
        //     ) AS ar_data
        //     LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
        //     WHERE $where
        //     GROUP BY 
        //         ar_data.restaurant_id
        //     ORDER BY 
        //         r.name
        // ";
        
        $restaurant_query = "
            SELECT 
                ar_data.restaurant_id,
                r.*,
                -- Count each arrival only once for total persons (regardless of dates)
                SUM(ar_data.arrival_person_count) AS total_no_of_person,
                COUNT(DISTINCT ar_data.arrival_id) AS file_count,
                
                -- Meal type counts (number of bookings)
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN 1 ELSE 0 END) AS lunch_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN 1 ELSE 0 END) AS high_tea_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN 1 ELSE 0 END) AS dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN 1 ELSE 0 END) AS gala_dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS cocktail_dinner_count,
                SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN 1 ELSE 0 END) AS others_count,
                
                -- Meal type pax counts (total persons)
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('lunch') THEN ar_data.no_of_person ELSE 0 END) AS lunch_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('high-tea', 'high_tea', 'high tea') THEN ar_data.no_of_person ELSE 0 END) AS high_tea_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('dinner') THEN ar_data.no_of_person ELSE 0 END) AS dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('gala-dinner', 'gala_dinner', 'gala dinner') THEN ar_data.no_of_person ELSE 0 END) AS gala_dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) IN ('cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS cocktail_dinner_pax,
                SUM(CASE WHEN LOWER(ar_data.buffet) NOT IN ('lunch', 'high-tea', 'high_tea', 'high tea', 'dinner', 'gala-dinner', 'gala_dinner', 'gala dinner', 'cocktail-dinner', 'cocktail_dinner', 'cocktail dinner') THEN ar_data.no_of_person ELSE 0 END) AS others_pax
                
            FROM (
                SELECT 
                    ar.restaurant_id,
                    ar.arrival_id,
                    ar.buffet,
                    ar.date,
                    -- Calculate person count per meal type
                    SUM(rm_max.no_of_person) AS no_of_person,
                    -- Calculate person count per arrival (count each arrival only once regardless of date)
                    CASE 
                        WHEN ROW_NUMBER() OVER (PARTITION BY ar.restaurant_id, ar.arrival_id ORDER BY ar.date, ar.buffet) = 1 
                        THEN SUM(rm_max.no_of_person) 
                        ELSE 0 
                    END AS arrival_person_count
                FROM arrival_restaurants AS ar
                LEFT JOIN (
                    SELECT 
                        restaurant_id,
                        date,
                        buffet,
                        arr_id,
                        MAX(no_of_person) AS no_of_person
                    FROM restaurant_menus
                    GROUP BY restaurant_id, date, buffet, arr_id
                ) AS rm_max ON rm_max.restaurant_id = ar.restaurant_id
                    AND rm_max.date = ar.date
                    AND rm_max.buffet = ar.buffet
                    AND rm_max.arr_id = ar.arrival_id
                LEFT JOIN arrivals ON arrivals.id = ar.arrival_id
                LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
                WHERE 1=1 $date_where $tour_type_where
                GROUP BY 
                    ar.restaurant_id,
                    ar.arrival_id,
                    ar.buffet,
                    ar.date
            ) AS ar_data
            LEFT JOIN restaurants AS r ON r.id = ar_data.restaurant_id
            WHERE $where
            GROUP BY 
                ar_data.restaurant_id
            ORDER BY 
                r.name
        ";

        $result = $this->db->query($restaurant_query)->result();

        // Set headers for CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Restaurant-reports_' . date('d-m-Y') . '.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Create output stream
        $output = fopen('php://output', 'w');

        // Add BOM for UTF-8
        fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        // Headers with all new columns
        fputcsv($output, [
            'S. No.',
            'Restaurant',
            'Specility',
            'Price Range',
            'Timing',
            'Seating Capacity',
            'Total Pax',
            'File Count',
            'Lunch Count',
            'Lunch Pax',
            'High Tea Count',
            'High Tea Pax',
            'Dinner Count', 
            'Dinner Pax',
            'Gala Dinner Count',
            'Gala Dinner Pax',
            'Cocktail Dinner Count',
            'Cocktail Dinner Pax',
            'Others Count',
            'Others Pax',
            'Address',
            'Location'
        ]);

        // Data
        $sr = 1;
        foreach ($result as $val) {
            $timing = '';
            if (!empty($val->opening_time) && !empty($val->closing_time)) {
                $timing = $val->opening_time . ' - ' . $val->closing_time;
            }

            fputcsv($output, [
                $sr++,
                $val->name,
                $val->cuisine,
                $val->price_range,
                $timing,
                $val->seating_capacity,
                $val->total_no_of_person,
                isset($val->file_count) ? $val->file_count : 0,
                isset($val->lunch_count) ? $val->lunch_count : 0,
                isset($val->lunch_pax) ? $val->lunch_pax : 0,
                isset($val->high_tea_count) ? $val->high_tea_count : 0,
                isset($val->high_tea_pax) ? $val->high_tea_pax : 0,
                isset($val->dinner_count) ? $val->dinner_count : 0,
                isset($val->dinner_pax) ? $val->dinner_pax : 0,
                isset($val->gala_dinner_count) ? $val->gala_dinner_count : 0,
                isset($val->gala_dinner_pax) ? $val->gala_dinner_pax : 0,
                isset($val->cocktail_dinner_count) ? $val->cocktail_dinner_count : 0,
                isset($val->cocktail_dinner_pax) ? $val->cocktail_dinner_pax : 0,
                isset($val->others_count) ? $val->others_count : 0,
                isset($val->others_pax) ? $val->others_pax : 0,
                ucwords(strtolower($val->restaurant_address)),
                ucwords(strtolower($val->city . ', ' . $val->country))
            ]);
        }

        fclose($output);
        exit;
    }
    
    public function database_report()
    {
        if (!empty($this->input->get('submit'))) 
            {
                $Search_data = [
                    'country'          => $this->input->get('country'),
                    'state'          => $this->input->get('state'),
                    'city'     => $this->input->get('city'),
                    'company'           => $this->input->get('company'),
                    'agent'          => $this->input->get('agent'),
                    'email'        => $this->input->get('email'),
                    'mobile'            => $this->input->get('mobile'),
                ];
                log_user_activity('Database Report Search', $this->session->userdata('id'), 'Search: '. json_encode($Search_data));
            }
        $allowed_users = ['1', '3', '5'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database Report View Error',$this->session->userdata('id'), 'Database Report: (Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }

        $result_cnt = $this->company_model->count_database_report();

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'database-report?' . $search[0];
        $config["total_rows"] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;
        $qry = $this->company_model->all_company_enquiry();
		$result_qry = 'SELECT t.* FROM ('.$qry.') AS t';
		if($this->input->get('enquiry_status')<>''){
			$result_qry .= ' WHERE t.enquiry_status = "'.$this->input->get('enquiry_status').'"';
		}
		$result_cnt = $this->db->query($result_qry);
        $result_qry .= ' LIMIT '.$config["per_page"].' OFFSET '.$offset;
		//echo $result_qry;exit;
		$data['company'] = $this->db->query($result_qry)->result();
        // $data['company'] = $this->company_model->all_database_report($config["per_page"], $offset);

        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt->num_rows();
        // print_r($data['total']);
        log_user_activity('Database Report View',$this->session->userdata('id'), 'Database Report: View');
        $data['content'] = 'admin/database_report';
        $this->load->view('admin/layout', $data);
    }

    public function database_report_excel()
    {

        $this->db->select('company.*,company_details.contact_person,company_details.contact_person_number,company_details.email');
        $this->db->select('COUNT(company_details.company) as totalRows');
        $this->db->join('company', 'company.company_id = company_details.company', 'left');
        $this->db->where('company.is_deleted !=', '1');
        $this->db->where('company_details.status', 'active');
    
        if ($this->input->get('country') <> '') {
          $country = strtolower(urldecode($this->input->get('country')));
          $arr = explode(',', $country);
          $arr = array_map('trim', $arr);
          if (end($arr) == '') {
              unset($arr[count($arr) - 1]);
          }
          $this->db->where_in('LOWER(company.country)', $arr);
        }
        if ($this->input->get('state') <> '') {
          $state = strtolower(urldecode($this->input->get('state')));
          $arr = explode(',', $state);
          $arr = array_map('trim', $arr);
          if (end($arr) == '') {
            unset($arr[count($arr) - 1]);
          }
          $this->db->where_in('LOWER(company.state)', $arr);
        }
        if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
          $city = strtolower(urldecode($this->input->get('city')));
          $arr = explode(',', $city);
          $arr = array_map('trim', $arr);
          if (end($arr) == '') {
            unset($arr[count($arr) - 1]);
          }
          $this->db->where_in('LOWER(company.city)', $arr);
        }
        if ($this->input->get('company_id') <> '') {
          $this->db->where('company_details.company', $this->input->get('company_id'));
        }
        if ($this->input->get('agent') <> '') {
            log_user_activity('Database Report Search ',$this->session->userdata('id'), 'Search Agent: '.$this->input->get('agent'));
          $agent = urldecode($this->input->get('agent'));
          $this->db->where('company_details.contact_person', $agent);
        }
        if ($this->input->get('email') <> '') {
          $email = urldecode($this->input->get('email'));
          $this->db->where('company_details.email', $email);
        }
        if ($this->input->get('mobile') <> '') {
          $mobile = urldecode($this->input->get('mobile'));
          $this->db->where('company_details.contact_person_number', $mobile);
        }
    
        $this->db->group_by('company_details.company');
        $this->db->order_by('company_details.company_id', 'DESC');
    
        $query = $this->db->get('company_details')->result();
        ob_end_clean();
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);


        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Total Agents');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'GST');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Pincode');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'State');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Added Date');
        // $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Company Logo');

        $row = 2; $sr = 1;
        if (isset($query[0])) {
            
            foreach ($query as $val) {
                $objPHPExcel->getActiveSheet()->setCellValue("A$row", $sr++);
                $objPHPExcel->getActiveSheet()->setCellValue("B$row", $val->name);
                $objPHPExcel->getActiveSheet()->setCellValue("C$row", $val->totalRows);
                $objPHPExcel->getActiveSheet()->setCellValue("D$row", $val->gstin);
                $objPHPExcel->getActiveSheet()->setCellValue("E$row", $val->address);
                $objPHPExcel->getActiveSheet()->setCellValue("F$row", $val->pincode);
                $objPHPExcel->getActiveSheet()->setCellValue("G$row", $val->city);
                $objPHPExcel->getActiveSheet()->setCellValue("H$row", $val->state);
                $objPHPExcel->getActiveSheet()->setCellValue("I$row", $val->country);
                $objPHPExcel->getActiveSheet()->setCellValue("J$row", $val->date);
                $row++;
            }
            log_user_activity('Database Report Excel Download',$this->session->userdata('id'), 'Database Report: Excel Downloaded');

        }

        // Output headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Company-reports_' . date('d-m-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Create writer and output
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;

    }

    public function get_company_agent_details(){
        
        $id = urldecode($this->input->get('id'));
        $escaped_company_id = $this->db->escape($id);

        $join=[['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = company_details.company']];
        $where = 'company_details.company ='.$escaped_company_id;
        $data = $this->common_model->get_data('company_details', '', '', 'company_details.*,company.name', $where,'',$count = false,$join);

        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

    public function agents_report()
    {

        $allowed_users = ['1', '3', '5'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }

        // Initialize the data array
        $data = [
            'total' => 0,
            'links' => '',
            'agents_data' => [],
            'offset' => 0, 
            'result' => [] 
        ];

        if ($this->input->get('submit') <> '') {

            $Search_data = [
                'country'          => $this->input->get('country'),
                'state'          => $this->input->get('state'),
                'city'     => $this->input->get('city'),
                'company_id'           => $this->input->get('company_id'),
                'agent'          => $this->input->get('agent'),
                'email'        => $this->input->get('email'),
                'mobile'            => $this->input->get('mobile'),
                'pincode' => $this->input->get('pincode'),
                'enquiry_status' => $this->input->get('enquiry_status'),
            ];
            log_user_activity('Agents Report Search', $this->session->userdata('id'), 'Search: '. json_encode($Search_data));

            $where = "company.is_deleted != 1 AND company_details.status = 'active'";
            // $select = 'company_details.*,company.name,company.company_logo';
            $select = 'company_details.*, company.name, company.company_logo, 
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
                    SELECT 1 
                    FROM enquiry 
                    WHERE enquiry.company_id = company.company_id 
                    AND enquiry.status != "confirm"
                ) THEN "query-received-but-not-converted"
                ELSE "no-query"
            END) AS enquiry_status';

            $join = [
                ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = company_details.company'],
            ];
    
            if ($this->input->get('country') <> '') {
                $country = strtolower(urldecode($this->input->get('country')));
                $arr = explode(',', $country);
                $arr = array_map('trim', $arr);
                if (end($arr) == '') {
                    unset($arr[count($arr) - 1]);
                }
                // Sanitize each element for SQL
                $arr = array_map(function ($item) {
                    return "'" . $this->db->escape_str($item) . "'";
                }, $arr);
    
                $where = 'LOWER(company_details.country) IN (' . implode(',', $arr) . ')';
            }
            if ($this->input->get('state') <> '') {
                $state = strtolower(urldecode($this->input->get('state')));
                $arr = explode(',', $state);
                $arr = array_map('trim', $arr);
                if (end($arr) == '') {
                    unset($arr[count($arr) - 1]);
                }
    
                // Sanitize each element for SQL
                $arr = array_map(function ($item) {
                    return "'" . $this->db->escape_str($item) . "'";
                }, $arr);
    
                $where = 'LOWER(company_details.state) IN (' . implode(',', $arr) . ')';
            }
            if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
                $city = strtolower(urldecode($this->input->get('city')));
                $arr = explode(',', $city);
                $arr = array_map('trim', $arr);
                if (end($arr) == '') {
                    unset($arr[count($arr) - 1]);
                }
                // Sanitize each element for SQL
                $arr = array_map(function ($item) {
                    return "'" . $this->db->escape_str($item) . "'";
                }, $arr);
    
                $where = 'LOWER(company_details.city) IN (' . implode(',', $arr) . ')';
            }
            if ($this->input->get('company_id') <> '') {
                $escaped_company_id = $this->db->escape($this->input->get('company_id'));
                $where = 'company_details.company= ' . $escaped_company_id;
            }
            if ($this->input->get('agent') <> '') {
                $agent = urldecode($this->input->get('agent'));
                $where = 'company_details.company_id= ' . $agent;
            }
            if ($this->input->get('email') <> '') {
                $email = urldecode($this->input->get('email'));
                $where = 'company_details.email= ' . $email;
            }
            
             if ($this->input->get('pincode') <> '') {
                $pincode = urldecode($this->input->get('pincode'));
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . "company_details.pincode = '" . $this->db->escape_str($pincode) . "'";
            }

            if ($this->input->get('enquiry_status') <> '') {
                $enquiry_status = urldecode($this->input->get('enquiry_status'));
                
                // Wrap the CASE logic inside a subquery and filter by it
                if ($enquiry_status == 'queries-converted') {
                    $where .= " AND (
                        SELECT COUNT(*) 
                        FROM enquiry 
                        WHERE enquiry.company_id = company.company_id 
                        AND enquiry.status = 'confirm'
                    ) > 1";
                } elseif ($enquiry_status == 'only-one-query-converted') {
                    $where .= " AND (
                        SELECT COUNT(*) 
                        FROM enquiry 
                        WHERE enquiry.company_id = company.company_id 
                        AND enquiry.status = 'confirm'
                    ) = 1";
                } elseif ($enquiry_status == 'query-received-but-not-converted') {
                    $where .= " AND EXISTS (
                        SELECT 1 
                        FROM enquiry 
                        WHERE enquiry.company_id = company.company_id 
                        AND enquiry.status != 'confirm'
                    )";
                } elseif ($enquiry_status == 'no-query') {
                    $where .= " AND NOT EXISTS (
                        SELECT 1 
                        FROM enquiry 
                        WHERE enquiry.company_id = company.company_id
                    )";
                }
            }


    
            // Build the query to count statuses grouped by company and status
            $this->db->select('
                company_details.company_id,
                company_details.contact_person,
                arrivals.status,
                COUNT(arrivals.status) as status_count
            ');
            $this->db->from('company_details');
            $this->db->join('enquiry', 'enquiry.company_details_id = company_details.company_id', 'left');
            $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'left');
            $this->db->join('company', 'company.company_id = company_details.company', 'left');
            $where = "company.is_deleted != 1 AND company_details.status = 'active'";

            // Apply filtering conditions
            if ($where != '') {
                $this->db->where($where);
            }

            // Group by company and status to get counts for each company
            $this->db->group_by(['company_details.company_id', 'arrivals.status']);
            $query = $this->db->get();

            // Process the result into the format we need
            $status_counts = $query->result_array();
            $agent_data = [];

            foreach ($status_counts as $record) {
                $id = $record['company_id'];

                if (!isset($agent_data[$id])) {
                    $agent_data[$id] = [
                        'company_id' => $id,
                        'name' => $record['contact_person'],
                        'statuses' => []
                    ];
                }
                $agent_data[$id]['statuses'][] = [
                    'status' => $record['status'],
                    'status_count' => $record['status_count']
                ];
            }

            $data['agent_data'] = $agent_data;
            
            // $result_cnt = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true, $join);
            $result_cnt = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true, $join);

            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));

            $config = array();
            $config["base_url"] = base_url() . 'agents-report?' . $search[0];
            $config["total_rows"] = $result_cnt;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;
            $data['agents_data'] = $this->common_model->get_data('company_details', $offset, $config["per_page"], $select, $where, '', $count = false, $join);
            // $data['agents_data'] = $this->common_model->get_data('company_details', $offset, $config["per_page"], $select, $where, '', $count = false, $join);
            // print_r($data['agents_data']);
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $result_cnt;
        }
        if ($this->input->get('status') <> '' && $this->input->get('submit') <> '') {

            if ($this->input->get('agent_id') <> '') {
                $agent = urldecode($this->input->get('agent_id'));
                $where = 'company_details.company_id= ' . $agent;
            }

            if ($this->input->get('status') <> '') {
                if($this->input->get('status') == 'total'){
                }else{
                    $where_and = ($where != '') ? ' AND ' : '';
                    $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
                }
            }

            $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
            $select = 'arrivals.*, transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, admin.name AS staff_name, company.name,company_details.contact_person,';
            $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

            $join = [
                ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
                ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
                ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
                ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
                ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
                ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
                ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
            ];

            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'agents-report?' . $search[0];

            $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where . ' GROUP BY arrivals.enquiry_id', '', $count = true, $join);

            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a style="color: #fff;" href="javascript:void(0);">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['page_query_string'] = TRUE;
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;
            $data['result'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' GROUP BY arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
            $data['links'] = $this->pagination->create_links();
        }
        log_user_activity('Agents Report View',$this->session->userdata('id'), 'Agents Report: View');
        $data['content'] = 'admin/agents_report';
        $this->load->view('admin/layout', $data);
    }
    
    public function agents_report_excel()
    {
    
        $where = "company.is_deleted != 1 AND company_details.status = 'active'";
        $select = 'company_details.*,company.name,company.company_logo';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = company_details.company'],
        ];


        if ($this->input->get('country') <> '') {
            $country = strtolower(urldecode($this->input->get('country')));
            $arr = explode(',', $country);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            // Sanitize each element for SQL
            $arr = array_map(function($item) {
                return "'" . $this->db->escape_str($item) . "'";
            }, $arr);

            $where = 'LOWER(company_details.country) IN (' . implode(',', $arr) . ')';

          }
          if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
              unset($arr[count($arr) - 1]);
            }

            // Sanitize each element for SQL
            $arr = array_map(function($item) {
                return "'" . $this->db->escape_str($item) . "'";
            }, $arr);

            $where = 'LOWER(company_details.state) IN (' . implode(',', $arr) . ')';
          }
          if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
              unset($arr[count($arr) - 1]);
            }
            // Sanitize each element for SQL
            $arr = array_map(function($item) {
                return "'" . $this->db->escape_str($item) . "'";
            }, $arr);

            $where = 'LOWER(company_details.city) IN (' . implode(',', $arr) . ')';
          }
        if ($this->input->get('company_id') <> '') {
            $escaped_company_id = $this->db->escape($this->input->get('company_id'));
            $where = 'company_details.company= ' . $escaped_company_id;
          }
          if ($this->input->get('agent') <> '') {
            $agent = urldecode($this->input->get('agent'));
            $where = 'company_details.contact_person= ' . $agent;
          }
          if ($this->input->get('email') <> '') {
            $email = urldecode($this->input->get('email'));
            $where = 'company_details.email= ' . $email;
          }
          if ($this->input->get('mobile') <> '') {
            $mobile = urldecode($this->input->get('mobile'));
            $where = 'company_details.contact_person_number= ' . $mobile;
          }   

            // Build the query to count statuses grouped by company and status
            $this->db->select('
            company_details.company_id,
            company_details.contact_person,
            arrivals.status,
            COUNT(arrivals.status) as status_count
        ');
        $this->db->from('company_details');
        $this->db->join('enquiry', 'enquiry.company_details_id = company_details.company_id', 'left');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->join('company', 'company.company_id = company_details.company', 'left');

        // Apply filtering conditions
        if ($where != '') {
            $this->db->where($where);
        }

        // Group by company and status to get counts for each company
        $this->db->group_by(['company_details.company_id', 'arrivals.status']);
        $query = $this->db->get();

        $status_counts = $query->result_array();

        foreach ($status_counts as $record) {
            $id = $record['company_id'];

            if (!isset($agent_data[$id])) {
                $agent_data[$id] = [
                    'company_id' => $id,
                    'name' => $record['contact_person'],
                    'statuses' => []
                ];
            }
            $agent_data[$id]['statuses'][] = [
                'status' => $record['status'],
                'status_count' => $record['status_count']
            ];
        }

        $query = $this->common_model->get_data('company_details','','',$select,$where,'',$count = false, $join);
    
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        //include_once APPPATH . 'libraries/PHPExcel/Worksheet/Drawing.php'; // Ensure this file exists

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);


        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sr. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Agent Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Designation');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Contact Number');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'GST');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Pincode');
        // $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'State');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Company Name');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Total Files'); 
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'In Progress');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Complete');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Cancel');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'File Closed');


        $row = 2;
        $sr = 1;

        if (isset($query[0])) {
            foreach ($query as $val) {
                $inProgress = 0;
                $complete = 0;
                $cancel = 0;
                $fileClosed = 0;
    
                // Find the status counts for the current agent
                $status_counts = isset($agent_data[$val->company_id]) ? $agent_data[$val->company_id]['statuses'] : [];
                foreach ($status_counts as $status) {
                    if ($status['status'] == 'in-progress') {
                        $inProgress = $status['status_count'];
                    } elseif ($status['status'] == 'complete') {
                        $complete = $status['status_count'];
                    } elseif ($status['status'] == 'cancel') {
                        $cancel = $status['status_count'];
                    } elseif ($status['status'] == 'file-closed') {
                        $fileClosed = $status['status_count'];
                    }
                }
    
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, ucwords(strtolower($val->contact_person)));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->designation);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->email);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->contact_person_isd_code .''. $val->contact_person_number);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $val->gstin);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $val->address);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $val->pincode);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, ucwords(strtolower($val->city)));
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, ucwords(strtolower($val->state)));
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, ucwords(strtolower($val->country)));
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, ucwords(strtolower($val->name)));
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $inProgress + $complete + $cancel + $fileClosed);
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $inProgress);
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $complete);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $cancel);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $fileClosed);
    
                $row++;
                $sr++;
            }
        }
    
        // Clean any output to avoid corrupting Excel file
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Company_agents-reports_' . date('d-m-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }


    public function agents_export_excel(){
        
        if ($this->input->get('agent_id') <> '') {
            $agent = urldecode($this->input->get('agent_id'));
            $where = 'company_details.company_id= ' . $agent;
        }

        if ($this->input->get('status') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
        }

        $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
        $select = 'arrivals.*, transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, admin.name AS staff_name, company.name,company_details.contact_person,';
        $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

        $join = [
            ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
            ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
            ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
        ];

        $result = $this->common_model->get_data('arrivals', '', '', $select, $where, ' GROUP BY arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Physical Arrival Date');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Number Of Nights');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Agent Name');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Handling Staff Name');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Hotel Name');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Transportation');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Guide');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Group Type');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Handover To Client');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Nos. Of Guests');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Company Name');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Currency');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Client Billing');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Payment Received In India');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Payment Received In Almaty');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Balance Amount');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Payment Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Status');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $val) {
                $where = 'payment_details.arrival_id= ' . $val->id;
                $select = 'payment_details.remarks';
                $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $select, $where, ' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
                $remarks = (!empty($payment_details_remarks)) ? $payment_details_remarks[0]->remarks : '';

                $where = 'arrival_hotel_details.enquiry_id = ' . $val->enquiry_id;
                $select = 'arrival_hotel_details.hotel_name';
                $hotel = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_hotel_details.id DESC LIMIT 1', $count = false);
                $hotel_name = (!empty($hotel) ? $hotel[0]->hotel_name : '');
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->enquiry_no);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d-M-Y', strtotime($val->arrival_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->number_of_nights);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->contact_person);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $val->staff_name);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $hotel_name);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $val->vehicle_type);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, ($val->guide <> '') ? $val->guide : '');
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->group_type);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $val->handover_to_client);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, (($val->number_persons == '') ? '0' : $val->number_persons) + (($val->number_child == '') ? '0' : $val->number_child));
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $val->name);
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, ucfirst($val->currency));
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $val->client_billing);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, (int)$val->payment_received_india + (int)$val->paymentreceived_india);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, (int)$val->payment_received_almaty + (int)$val->paymentrecieved_in_other);
                $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $val->balance_amount);
                $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, $remarks);
                $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, ucfirst($val->status));
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $result[0]->contact_person . '_report_' . date('d-m-Y') . '.xls"');

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    public function restaurants(){
        $location = $this->input->get('location');
        $select = 'restaurants.id,restaurants.name as names';
        $where = 'LOWER(restaurants.country) = "' . $location . '" AND restaurants.status = "active"';
        if($this->input->get('city')<>''){
            $where .= ' AND LOWER(restaurants.city) = "' . $this->input->get('city') . '"';
        }
        $data = $this->common_model->get_data('restaurants', '', '', $select, $where, '', $count = false);

        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);

    }

    public function menu_report()
    {

        $data['meals'] = $this->common_model->get_data('all_meal_types', '','', '*','all_meal_types.status = "active"', '', $count = false);        

        $data['menus'] = $this->common_model->get_data('all_restaurant_menus', '','', '*','all_restaurant_menus.status = "active"', '', $count = false);

        // $data['country'] = ['label' => '', 'country_id' => ''];
        // if ($this->session->userdata('locations') != 'all') {
        //     $data['country'] = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))])[0];
        // }
        
        $data['country'] = ['label' => '', 'country_id' => ''];

        if ($this->session->userdata('locations') != 'all') {
            $countries = $this->company_model->get_country_ajax([
                'search' => ucfirst($this->session->userdata('locations'))
            ]);
        
            if (!empty($countries) && isset($countries[0])) {
                $data['country'] = $countries[0];
            }
        }


        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'restaurant-menu-report?' . $search[0];

        $config["total_rows"]  = $this->restaurantmenumaster_model->menu_report_count();

        $Search_data = [
            'locations'         => $this->input->get('country'),
            'city'         => $this->input->get('city'),
            'restaurants'         => $this->input->get('restaurant'),
        ];
        if ($this->input->get('submit') <> '') {
            log_user_activity('Restaurant Menu Report Search',$this->session->userdata('id'), 'Search: '. json_encode($Search_data));
        }

        $result_cnt = $config["total_rows"];
        $data['total'] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
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

        $data['result'] = $this->restaurantmenumaster_model->menu_report($offset, $config["per_page"]);

        // echo "<pre>";
        // print_r($data['result']);
        // exit;
        log_user_activity('Restaurant Menu Report View',$this->session->userdata('id'), 'Restaurant Menu Report: View');
        $data['links'] = $this->pagination->create_links();
        $data['content'] = 'admin/menu_report';
        $this->load->view('admin/layout', $data);
    }

    public function menu_report_excel()
    {
    
        $this->db->select('restaurants.id AS restaurants_id,restaurants.name, restaurants.restaurant_address, restaurants.city, restaurants.country');
        $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
        $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');

        if ($this->input->get('country') <> '') {
            $this->db->where('restaurants.country', urldecode($this->input->get('country')));

        }
        if ($this->input->get('city') <> '') {
            $this->db->where('restaurants.city', urldecode($this->input->get('city')));
        }
        if ($this->input->get('restaurant') <> '') {
            $this->db->where('restaurants.id', urldecode($this->input->get('restaurant')));
        }

        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
        $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
        $this->db->group_by('restaurant_menus.restaurant_id');

        $result = $this->db->get('restaurant_menus')->result();


        // Initialize an array to store processed data
        $query = array();
        
        // After retrieving data from the database
        foreach ($result as $item) {
            // Reset the menu_cuisine_map for each item
            $item->menu_cuisine_map = array();
        
            // Explode menu_cuisine string into arrays
            $menu_cuisine_pairs = explode(';', $item->menu_cuisine);
        
            // Initialize an empty associative array for menus and cuisine items
            $menu_cuisine_map = array();
        
            // Extract menus and cuisine items from pairs
            foreach ($menu_cuisine_pairs as $pair) {
                // Split the pair into menu and cuisine item
                list($menu, $cuisine_item) = explode(':', $pair, 2);
        
                // Trim menu and cuisine item
                $menu = trim($menu);
                $cuisine_item = trim($cuisine_item);
        
                // Add cuisine item to the respective menu type
                if (!isset($menu_cuisine_map[$menu])) {
                    $menu_cuisine_map[$menu] = array();
                }
        
                // Add cuisine item to the menu type only if it's not already present
                if (!in_array($cuisine_item, $menu_cuisine_map[$menu])) {
                    $menu_cuisine_map[$menu][] = $cuisine_item;
                }
            }
        
            // Reorder the menu categories to ensure "dessert" comes last and "entrees_or_main_course" comes second to last
            $menu_cuisine_map_ordered = array();
        
            foreach (['appetizers_or_starters', 'sides_or_side_dishes', 'specials_or_chef_recommendations', 'kid_menu', 'healthy_or_lighter_options', 'extra_or_add_ons', 'beverages', 'entrees_or_main_course', 'dessert'] as $category) {
                if (isset($menu_cuisine_map[$category])) {
                    // Limit the cuisine items to the last 10 for each category
                    $menu_cuisine_map[$category] = array_slice($menu_cuisine_map[$category], -10);
                    $menu_cuisine_map_ordered[$category] = $menu_cuisine_map[$category];
                    unset($menu_cuisine_map[$category]);
                }
            }
        
            // Merge any remaining categories
            $menu_cuisine_map_ordered = array_merge($menu_cuisine_map_ordered, $menu_cuisine_map);
        
            // Convert menu_cuisine_map into comma-separated values
            foreach ($menu_cuisine_map_ordered as $menu => $cuisine_items) {
                $menu_cuisine_map_ordered[$menu] = implode(', ', $cuisine_items);
            }
        
            // Add the associative array to the result object
            $item->menu_cuisine_map = $menu_cuisine_map_ordered;
        
            // Add the processed item to the array
            $query[] = $item;
        }
    
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        //include_once APPPATH . 'libraries/PHPExcel/Worksheet/Drawing.php'; // Ensure this file exists

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);


        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sr. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Restaurant');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Cuisine');


        $row = 2;
        $sr = 1;
        if (isset($query[0])) {
            foreach ($query as $val) {

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, ucwords(strtolower($val->name)));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->restaurant_address);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->city);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->country);

                $menu_cuisine_text = '';
                foreach ($val->menu_cuisine_map as $menu_type => $cuisines) {
                    $menu_cuisine_text .= ucwords(str_replace('_', ' ', strtolower($menu_type))) . ": " . ucwords(strtolower($cuisines)) . "\n";
                }

                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $menu_cuisine_text);

                $row++;
                $sr++;
            }
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(400);


        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'Restaurant_menu-reports_' . date('d-m-Y') . '.xls' . '"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }
    
    public function print_menu_report(){

        $data['restaurant'] = $this->common_model->get_data('restaurants', '','', 'restaurants.*', 'id=' . urldecode(base64_decode($this->input->get('restaurant'))), '', $count = false)[0];

        $data['restaurant_menus'] = $this->restaurantmenumaster_model->menu_report_data();
        //echo '<pre>';print_r($data['restaurant_menus']);exit;
        if ($this->input->get('print') == 'pdf') {
            log_user_activity('Restaurant Menu Report Print Save As PDF',$this->session->userdata('id'), 'Restaurant Menu Report: Print Save As PDF');
            // $data['content'] = 'admin/print_restaurant_menu_pdf';
            $this->load->view('admin/print_restaurant_menu_pdf', $data);
        } else {
            log_user_activity('Restaurant Menu Report Print View',$this->session->userdata('id'), 'Restaurant Menu Report:Print View ');
            // $data['content'] = 'admin/print_restaurant_menu';
            $this->load->view('admin/print_restaurant_menu', $data);
        }
    }
    
    public function get_staff()
    {
        $data = $this->common_model->get_data('admin', '', '', '*', '', '', $count = false);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

    public function get_country_by_staff()
    {
        $id = $this->input->get('staff_id');

        $where = "admin.id=" . $id;
        $data = $this->common_model->get_data('admin', '', '', '*', $where, '', $count = false);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

     //old
//     public function staff_count_excel()
//     {
//         $data['locations'] = $this->locations;
//         $where = '';
    
//         // Initialize pagination and data variables
//         $data['total'] = 0;
//         $data['links'] = '';
//         $data['agents_data'] = [];
//         $data['status_uri'] = $this->input->get('status');
    
//         // Initialize where clause
//         $where = '';
    
//         // Add conditions to the where clause based on inputs
//         if (!empty($this->input->get('location'))) {
//             $location = urldecode($this->input->get('location'));
//             $loc = implode('","', $this->locations[$location]);
//             $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
//         }
    
//         if (!empty($this->input->get('staff_id'))) {
//             if ($this->input->get('staff_id') != 'all') {
//                 if ($where != '') $where .= ' AND ';
//                 $where .= 'arrivals.handling_staff_id = "' . urldecode($this->input->get('staff_id')) . '"';
//             }
//         }
    
//         if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
//             if ($where != '') $where .= ' AND ';
//             $where .= 'date(arrivals.arrival_date) >= "' . $this->input->get('date_from') . '" AND date(arrivals.arrival_date) <= "' . $this->input->get('date_to') . '"';
//         }
    
//         // Build the query to count records based on status and handling staff
//         $this->db->select('arrivals.status, COUNT(*) as status_count, arrivals.handling_staff_id, admin.name');
//         $this->db->from('arrivals');
//         $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id', 'left');
//         $this->db->join('admin', 'admin.id = arrivals.handling_staff_id', 'left');
//         if ($where != '') {
//             $this->db->where($where);
//         }
//         $this->db->group_by(array('arrivals.handling_staff_id', 'arrivals.status'));
    
//         $query = $this->db->get();
//         $status_counts = $query->result_array();
    
//         // Transform the data to the desired format
//         $staff_data = [];
    
//         foreach ($status_counts as $record) {
//             $id = $record['handling_staff_id'];
//             if (!isset($staff_data[$id])) {
//                 $staff_data[$id] = [
//                     'handling_staff_id' => $id,
//                     'name' => $record['name'],
//                     'statuses' => []
//                 ];
//             }
//             $staff_data[$id]['status'][] = [
//                 'status' => $record['status'],
//                 'status_count' => $record['status_count']
//             ];
//         }
    
//         $staff_data = array_values($staff_data);
    
//         $this->load->library('PHPExcel');
//         include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
//         $objPHPExcel = new PHPExcel();
//         $objPHPExcel->setActiveSheetIndex(0);
    
//         // Set headers
//         $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
//         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
//         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
//         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Total Files'); 
//         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'In Progress');
//         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Complete');
//         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Cancel');
//         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'File Closed');
    
//         $row = 2;
//         $sr = 1;
//         foreach ($staff_data as $staff) {
//             $inProgress = 0;
//             $complete = 0;
//             $cancel = 0;
//             $fileClosed = 0;
    
//             foreach ($staff['status'] as $status) {
//                 if ($status['status'] == 'in-progress') {
//                     $inProgress = $status['status_count'];
//                 } elseif ($status['status'] == 'complete') {
//                     $complete = $status['status_count'];
//                 } elseif ($status['status'] == 'cancel') {
//                     $cancel = $status['status_count'];
//                 } elseif ($status['status'] == 'file-closed') {
//                     $fileClosed = $status['status_count'];
//                 }
//             }
    
    
//             $total = $inProgress + $complete + $cancel + $fileClosed;
    
//             // Add data to the Excel sheet
//             $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
//             $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $staff['name']);
//             $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $total); 
//             $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $inProgress);
//             $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $complete);
//             $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $cancel);
//             $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $fileClosed);
    
//             $row++;
//             $sr++;
//         }
    
//         header('Content-Type: application/vnd.ms-excel'); //mime type
//         header('Content-Disposition: attachment;filename="Staff_report_' . date('d-m-Y') . '.xls"');
//         header('Cache-Control: max-age=0'); //no cache
    
//         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//         $objWriter->save('php://output');
// }

//     public function staff_report()
//     {
//         $data['locations'] = $this->locations;
//         $where = '';

//         // Initialize pagination and data variables
//         $data['total'] = 0;
//         $data['links'] = '';
//         $data['agents_data'] = [];
//         $data['status_uri'] = $this->input->get('status');

//         $where = ''; // Initialize where clause

//         // Add conditions to the where clause based on inputs
//         if (!empty($this->input->get('location'))) {
//             $location = urldecode($this->input->get('location'));
//             $loc = implode('","', $this->locations[$location]);
//             $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
//         }

//         if (!empty($this->input->get('staff_id'))) {
//             if ($this->input->get('staff_id') != 'all') {
//                 if ($where != '') $where .= ' AND ';
//                 $where .= 'arrivals.handling_staff_id = "' . urldecode($this->input->get('staff_id')) . '"';
//             }
//         }

//         if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
//             if ($where != '') $where .= ' AND ';
//             $where .= 'date(arrivals.arrival_date) >= "' . $this->input->get('date_from') . '" AND date(arrivals.arrival_date) <= "' . $this->input->get('date_to') . '"';
//         }

//         // Build the query to count records based on status and handling staff
//         $this->db->select('arrivals.status, COUNT(*) as status_count, arrivals.handling_staff_id, admin.name');
//         $this->db->from('arrivals');
//         $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id', 'left');
//         $this->db->join('admin', 'admin.id = arrivals.handling_staff_id', 'left');
//         if ($where != '') {
//             $this->db->where($where);
//         }
//         $this->db->group_by(array('arrivals.handling_staff_id', 'arrivals.status'));

//         $query = $this->db->get();
//         $status_counts = $query->result_array();

//         // Transform the data to the desired format
//         $staff_data = [];

//         foreach ($status_counts as $record) {
//             $id = $record['handling_staff_id'];
//             if (!isset($staff_data[$id])) {
//                 $staff_data[$id] = [
//                     'handling_staff_id' => $id,
//                     'name' => $record['name'],
//                     'statuses' => []
//                 ];
//             }
//             $staff_data[$id]['status'][] = [
//                 'status' => $record['status'],
//                 'status_count' => $record['status_count']
//             ];
//         }

//         $data['staff_data'] = array_values($staff_data);

//         // Initialize an array to hold the counts for each status
//         // $status_summary = [
//         //     'in-progress' => 0,
//         //     'complete' => 0,
//         //     'cancel' => 0,
//         //     'file-closed' => 0,
//         // ];

//         // // Populate the summary array with counts from the query results
//         // foreach ($status_counts as $row) {
//         //     if (array_key_exists($row['status'], $status_summary)) {
//         //         $status_summary[$row['status']] = $row['status_count'];
//         //     }
//         // }

//         // if (!empty($this->input->get('staff_id'))) {
//         //     $data['progress_files'] = $status_summary['in-progress'];
//         //     $data['confirm_files'] = $status_summary['complete'];
//         //     $data['cancelled_files'] = $status_summary['cancel'];
//         //     $data['closed_files'] = $status_summary['file-closed'];
//         // }

//         if ($this->input->get('submit') <> '' && $this->input->get('status') <> '') {
//             if ($where == '') {
//                 $where = ' (1=1) ';
//             }
//             // if ($this->input->get('status') <> '') {
//             //     $where_and = ($where != '') ? ' AND ' : '';
//             //     $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
//             // }

//             if ($this->input->get('status') <> '') {
//                 if($this->input->get('status') == 'total'){
//                 }else{
//                     $where_and = ($where != '') ? ' AND ' : '';
//                     $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
//                 }
//             }

//             $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
//             $select = 'arrivals.*, transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, admin.name AS staff_name, company.name,';
//             $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

//             $join = [
//                 ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
//                 ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
//                 ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
//                 ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
//                 ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
//                 ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],

//             ];

//             $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
//             $config = array();
//             $config["base_url"] = base_url() . 'staff-report?' . $search[0];

//             $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where . ' GROUP BY arrivals.enquiry_id', '', $count = true, $join);

//             $config["per_page"] = 10;
//             $config['full_tag_open'] = '<ul class="pagination">';
//             $config['full_tag_close'] = '</ul>';
//             $config['first_tag_open'] = '<li class="page-item">';
//             $config['first_tag_close'] = '</li>';
//             $config['prev_link'] = '&laquo';
//             $config['next_link'] = '&raquo';
//             $config['next_tag_open'] = '<li class="page-item">';
//             $config['next_tag_close'] = '</li>';
//             $config['last_tag_open'] = '<li class="page-item">';
//             $config['last_tag_close'] = '</li>';
//             $config['cur_tag_open'] = '<li class="page-item active"><a style="color: #fff;" href="javascript:void(0);">';
//             $config['cur_tag_close'] = '</a></li>';
//             $config['num_tag_open'] = '<li class="page-item">';
//             $config['num_tag_close'] = '</li>';
//             $config['page_query_string'] = TRUE;
//             $this->pagination->initialize($config);
//             $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
//             $data['offset'] = $offset;
//             $data['result'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' GROUP BY arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
//             $data['links'] = $this->pagination->create_links();
//         }
//         $this->load->view('admin/staff_report', $data);
//     }

//     public function staff_export_excel()
//     {
//         $data['locations'] = $this->locations;
//         $staff = $this->common_model->get_data('admin', '', '', 'admin.name', 'admin.id = " ' . urldecode($this->input->get('staff_id')) . '"', '', '', $count = false)[0];
//         $staff_name = $staff->name;
//         $where = '';
//         $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
//         $select = 'arrivals.*, transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, admin.name AS staff_name, company.name,';
//         $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

//         if (!empty($this->input->get('location'))) {
//             $location = urldecode($this->input->get('location'));
//             $loc = implode('","', $this->locations[$location]);
//             $where_and = ($where != '') ? ' AND ' : '';
//             $loc = implode('","', $this->locations[$location]);
//             $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $loc . '")';
//         }


//         if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
//             $where_and = ($where != '') ? ' AND ' : '';
//             $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
//         }

//         // Check for date range filter
//         if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
//             $where_and = ($where != '') ? ' AND ' : '';
//             $where .= $where_and . 'date(arrivals.arrival_date) >="' . $this->input->get('date_from') . '" AND date(arrivals.arrival_date) <="' . $this->input->get('date_to') . '"';
//         }
//         if ($this->input->get('status') <> '') {
//             $where_and = ($where != '') ? ' AND ' : '';
//             $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
//         }

//         $join = [
//             ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
//             ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
//             ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
//             ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
//             ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
//             //['type' => 'LEFT', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_hotel_details.enquiry_id = arrivals.enquiry_id'],
//             ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],

//         ];

//         $result = $this->common_model->get_data('arrivals', '', '', $select, $where, ' GROUP BY arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);

//         $this->load->library('PHPExcel');
//         include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
//         $objPHPExcel = new PHPExcel();
//         $objPHPExcel->setActiveSheetIndex(0);

//         $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
//         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
//         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Number');
//         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Physical Arrival Date');
//         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Number Of Nights');
//         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Handling Staff Name');
//         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Hotel Name');
//         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Transportation');
//         $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Guide');
//         $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Group Type');
//         $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Handover To Client');
//         $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Nos. Of Guests');
//         $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Company Name');
//         $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Currency');
//         $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Client Billing');
//         $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Payment Received In India');
//         $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Payment Received In Almaty');
//         $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Balance Amount');
//         $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Payment Remarks');
//         $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Status');

//         $row = 2;
//         $sr = 1;
//         if (isset($result[0])) {
//             foreach ($result as $val) {
//                 $where = 'payment_details.arrival_id= ' . $val->id;
//                 $select = 'payment_details.remarks';
//                 $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $select, $where, ' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
//                 $remarks = (!empty($payment_details_remarks)) ? $payment_details_remarks[0]->remarks : '';

//                 $where = 'arrival_hotel_details.enquiry_id = ' . $val->enquiry_id;
//                 $select = 'arrival_hotel_details.hotel_name';
//                 $hotel = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_hotel_details.id DESC LIMIT 1', $count = false);
//                 $hotel_name = (!empty($hotel) ? $hotel[0]->hotel_name : '');
//                 $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
//                 $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->enquiry_no);
//                 $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d-M-Y', strtotime($val->arrival_date)));
//                 $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->number_of_nights);
//                 $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->staff_name);
//                 $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $hotel_name);
//                 $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $val->vehicle_type);
//                 $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ($val->guide <> '') ? $val->guide : '');
//                 $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $val->group_type);
//                 $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->handover_to_client);
//                 $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, (($val->number_persons == '') ? '0' : $val->number_persons) + (($val->number_child == '') ? '0' : $val->number_child));
//                 $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $val->name);
//                 $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucfirst($val->currency));
//                 $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $val->client_billing);
//                 $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, (int)$val->payment_received_india + (int)$val->paymentreceived_india);
//                 $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, (int)$val->payment_received_almaty + (int)$val->paymentrecieved_in_other);
//                 $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $val->balance_amount);
//                 $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $remarks);
//                 $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, ucfirst($val->status));
//                 $row++;
//                 $sr++;
//             }
//         }

//         header('Content-Type: application/vnd.ms-excel'); //mime type
//         header('Content-Disposition: attachment;filename="' . $staff_name . '_report_' . date('d-m-Y') . '.xls"');
//         header('Cache-Control: max-age=0'); //no cache

//         //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//         //if you want to save it as .XLSX Excel 2007 format
//         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//         //force user to download the Excel file without writing it to server's HD
//         $objWriter->save('php://output');
//     }
    
    // *************************** Transportation Report ********************************
    
    public function transportation_report()
    {
        $data['locations'] = $this->locations;

        $where = ' arrivals.status IN("complete","file-closed","in-progress") ';
        if ($this->input->get('status') <> '') {
            $where = ' arrivals.status = "'.$this->input->get('status').'"';
        }
        
        if ($this->input->get('transportation_id') <> '') {
            $where .= ' AND enquiry_transport.transportation_id = "' . trim($this->input->get('transportation_id')) . '"';
        }
        
        if ($this->input->get('capacity') <> '') {
            $match_capacity = urldecode($this->input->get('match_capacity'));
            $where .= ' AND transportation.capacity '.$match_capacity.trim($this->input->get('capacity'));
        }        
        
        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where .= ' AND (date(arrivals.arrival_date) >="' . trim($this->input->get('date_from')) . '" AND date(arrivals.arrival_date) <="' . trim($this->input->get('date_to')) . '")';
        }
        
        if ($this->input->get('location') <> '') {
            $where .= ' AND LOWER(transportation.country) = "' . strtolower(trim($this->input->get('location'))) . '"';
        }
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $where .= ' AND LOWER(transportation.state) IN ("' . $str_state . '")';
        }
        if ($this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $where .= ' AND LOWER(transportation.city) IN ("' . $str_city . '")';
        }
        $Search_data = [
            'status' =>$this->input->get('status'),
            'transportation_id'         => $this->input->get('transportation_id'),
            'capacity'         => $this->input->get('capacity'),
            'date_from'         => $this->input->get('date_from'),
            'date_to'         => $this->input->get('date_to'),
            'location'         =>$this->input->get('location'),
            'match_capacity'         => $this->input->get('match_capacity'),
        ];

        $data['links'] = '';
        $data['total'] = 0;
        if ($this->input->get('submit') <> '') {
            log_user_activity('Transport Report Search',$this->session->userdata('id'), 'Search: '. json_encode($Search_data));
            $query = 'SELECT transportation.id,transportation.vehicle_name,transportation.country,transportation.vehicle_type,COUNT(enquiry_transport.id) AS number_used,';
            $query .= 'SUM(enquiry_transport.quantity) AS vehicle_quantity,SUM(DATEDIFF(enquiry.check_out_date,enquiry.check_in_date)) AS num_days';            
            $query .= ' FROM transportation JOIN enquiry_transport ON enquiry_transport.transportation_id = transportation.id JOIN enquiry ON enquiry_transport.enquiry_id = enquiry.id JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
                WHERE ' . $where . '
                GROUP BY enquiry_transport.transportation_id';
            //echo $query;exit;
            
            if($this->input->get('excel_download')== '1'){
                log_user_activity('Transport Report Excel Download',$this->session->userdata('id'), 'Transport Report : Excel Download');
                $result = $this->common_model->custom_query($query);
                $this->transportation_excel_download($result);
            }
            
            $total_rows = $this->db->query($query)->num_rows();
            
            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'transportation-report?' . $search[0];

            $config["total_rows"] = $total_rows;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;

            $query .= ' LIMIT ' . $config["per_page"] . ' OFFSET ' . $offset;
            //echo $query;
            $data['transportation_report'] = $this->common_model->custom_query($query);
            //echo $this->db->last_query();exit;
            //echo '<pre>' ; print_r($data['transportation_report']);exit;
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $total_rows;
        }
        log_user_activity('Transport Report View',$this->session->userdata('id'), 'Transport Report : View');
        $data['content'] = 'admin/transportation_report';
        $this->load->view('admin/layout', $data);
    }

    public function get_transportation_files(){
        
        $data['locations'] = $this->locations;
        
        $this->form_validation->set_rules('t_id', 'Transportation', 'trim|required');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $transportation_id = $this->input->post('t_id');
        $where = ' arrivals.status IN("complete","file-closed","in-progress") ';
        if ($this->input->post('status') <> '') {
            $where = ' arrivals.status = "'.$this->input->post('status').'"';
        }
        
        if ($this->input->post('transportation_id') <> '') {
            $where .= ' AND enquiry_transport.transportation_id = "' . trim($this->input->post('transportation_id')) . '"';
        }
        
        if ($this->input->post('capacity') <> '') {
            $match_capacity = urldecode($this->input->post('match_capacity'));
            $where .= ' AND transportation.capacity '.$match_capacity.trim($this->input->post('capacity'));
        }        
        
        if ($this->input->post('date_from') <> '' && $this->input->post('date_to') <> '') {
            $where .= ' AND (date(arrivals.arrival_date) >="' . trim($this->input->post('date_from')) . '" AND date(arrivals.arrival_date) <="' . trim($this->input->post('date_to')) . '")';
        }
        
        if ($this->input->post('location') <> '') {
            $where .= ' AND LOWER(transportation.country) = "' . strtolower(trim($this->input->post('location'))) . '"';
        }
        if ($this->input->post('state') <> '') {
            $state = strtolower(urldecode($this->input->post('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_state = implode('","', $arr);
            $where .= ' AND LOWER(transportation.state) IN ("' . $str_state . '")';
        }
        if ($this->input->post('city') <> '') {
            $city = strtolower(urldecode($this->input->post('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $str_city = implode('","', $arr);
            $where .= ' AND LOWER(transportation.city) IN ("' . $str_city . '")';
        }
        
        $where .= ' AND enquiry_transport.transportation_id = '.$transportation_id;
        $select = 'DATEDIFF(enquiry.check_out_date,enquiry.check_in_date) AS num_days,enquiry.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle,arrivals.arrival_date,arrivals.group_type,arrivals.status AS arrivals_status';
        $join = [['type' => '', 'join_table' => 'enquiry_transport', 'condition' => 'enquiry_transport.enquiry_id = enquiry.id'],
                ['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry_transport.enquiry_id'],
                ['type' => '', 'join_table' => 'transportation', 'condition' => 'enquiry_transport.enquiry_id = enquiry.id']];
        $files = $this->common_model->get_data('enquiry', '', '', $select, $where, ' GROUP BY enquiry.id ORDER BY arrivals.arrival_date ASC', $count = false,$join);
        //echo $this->db->last_query();exit;
        echo json_encode(['response'=>'s','details'=>$files, 'msg'=> '']);
        exit;
        
    }
    
    public function transportation_excel_download($result){
        ob_end_clean();
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Vehicle Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Vehicle Type');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Location');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Number of times used');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Total Number Of Days Used');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Quantity');
        if($this->input->get('status')<>''){
            $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Arrival`s Status');
        }
        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $list) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $list->vehicle_name);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $list->vehicle_type);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $list->country);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $list->number_used);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $list->num_days);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $list->vehicle_quantity);
                if($this->input->get('status')<>''){
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ucfirst($this->input->get('status')));
                }
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'Transportation-usage-report_' . date('d-M-Y') . '.xls' . '"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        exit;        
    }
    
    public function get_vehicle_names(){
        $this->load->model('admin/transport_model');
        echo $this->transport_model->vehicle_names();
    }
    
    public function vendor_all_reports(){
        if($this->session->userdata('type')==1 || $this->session->userdata('admin_type')=='accounts_admin'){
            log_user_activity('Vendor All Reports View',$this->session->userdata('id'), 'Vendor All Reports: View');

        }else{ 
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Vendor All Reports View',$this->session->userdata('id'), 'Not Allowed. Permission Denied!');
            redirect('dashboard');
        }
        $data['content'] = 'admin/vendor_all_reports';
        $this->load->view('admin/layout',$data);
    }
    
    //new
    
    public function staff_count_excel()
    {
        log_user_activity('Staff Report Excel Download',$this->session->userdata('id'), 'Staff Report: Excel Downloaded');

        $data['locations'] = $this->locations;

        $where = "admin.admin_type NOT IN ('admin', 'superadmin', 'accounts_admin')";

        // Add conditions to the where clause based on inputs
        if (!empty($this->input->get('location'))) {
            $location = urldecode($this->input->get('location'));
            $loc = implode('","', $this->locations[$location]);
            if ($where != '') $where .= ' AND ';
            $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
        }

        // Initialize pagination and data variables
        $data['total'] = 0;
        $data['links'] = '';
        $data['staff_data'] = [];
        $data['status_uri'] = $this->input->get('status');


        $date_from = $this->db->escape($this->input->get('date_from'));
        $date_to = $this->db->escape($this->input->get('date_to'));
        
        $this->db->select("
            enquiry.file_handle_by,
            COUNT(CASE 
                WHEN date(enquiry.query_received_date) < $date_from 
                AND date(enquiry.check_in_date) >= $date_from 
                AND date(enquiry.check_out_date) <= $date_to 
                AND enquiry.status = 'confirm' 
                THEN 1 END) as previous_confirm,
            COUNT(CASE 
                WHEN date(enquiry.query_received_date) > $date_to 
                AND date(enquiry.check_in_date) >= $date_from 
                AND date(enquiry.check_out_date) <= $date_to 
                AND enquiry.status = 'confirm' 
                THEN 1 END) as future_confirm,
            COUNT(CASE 
                WHEN date(enquiry.query_received_date) BETWEEN $date_from AND $date_to 
                AND date(enquiry.check_in_date) >= $date_from 
                AND date(enquiry.check_out_date) <= $date_to 
                AND enquiry.status = 'confirm' 
                THEN 1 END) as confirm,
            COUNT(CASE 
                WHEN date(enquiry.query_received_date) BETWEEN $date_from AND $date_to 
                AND date(enquiry.check_in_date) >= $date_from 
                AND date(enquiry.check_out_date) <= $date_to 
                 AND (enquiry.status != 'confirm' AND enquiry.status != 'not-materialized') 
                THEN 1 END) as pending,
            COUNT(CASE 
                WHEN date(enquiry.query_received_date) BETWEEN $date_from AND $date_to 
                AND date(enquiry.check_in_date) >= $date_from 
                AND date(enquiry.check_out_date) <= $date_to 
                AND enquiry.status = 'not-materialized' 
                THEN 1 END) as not_materialized,
            admin.name
        ");

        $this->db->from('enquiry');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'left');

        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->group_by(array('enquiry.file_handle_by'));

        $query = $this->db->get();
        $staff_data = $query->result_array();
        $staff_data = array_values($staff_data);

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Set headers
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Total Files');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Confirm');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Pending');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Not Materialized');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Future Confirm');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Previous Confirm');


        $row = 2;
        $sr = 1;
        foreach ($staff_data as $staff) {

            $total = $staff['confirm'] + $staff['pending'] + $staff['not_materialized'] + $staff['future_confirm'];

            // Add data to the Excel sheet
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $staff['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $total);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $staff['confirm']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $staff['pending']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $staff['not_materialized']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $staff['future_confirm']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $staff['previous_confirm']);


            $row++;
            $sr++;
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="Staff_report_' . date('d-m-Y') . '.xls"');
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    /*public function staff_report()
    {
        $data['locations'] = $this->locations;

        $where = "admin.admin_type NOT IN ('admin', 'superadmin', 'accounts_admin')";

        // Add conditions to the where clause based on inputs
        if (!empty($this->input->get('location'))) {
            $location = urldecode($this->input->get('location'));
            $loc = implode('","', $this->locations[$location]);
            if ($where != '') $where .= ' AND ';
            $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
        }

        if (!empty($this->input->get('staff_id'))) {
            if ($this->input->get('staff_id') != 'all') {
                if ($where != '') $where .= ' AND ';
                $where .= 'enquiry.file_handle_by = "' . urldecode($this->input->get('staff_id')) . '"';
            }
        }

        // Initialize pagination and data variables
        $data['total'] = 0;
        $data['links'] = '';
        $data['staff_data'] = [];
        $data['status_uri'] = $this->input->get('status');

        // Build the query to count records based on the conditions for status and query_received_date
        $this->db->select('
        enquiry.file_handle_by, 
        COUNT(CASE 
            WHEN date(enquiry.query_received_date) < "' . $this->input->get('date_from') . '" 
            AND enquiry.status = "confirm" 
            AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
            AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '" 
            THEN 1 END) as previous_confirm,
        
        COUNT(CASE 
            WHEN date(enquiry.query_received_date) > "' . $this->input->get('date_to') . '" 
            AND enquiry.status = "confirm" 
            AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
            AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '" 
            THEN 1 END) as future_confirm,
        
        COUNT(CASE 
            WHEN date(enquiry.query_received_date) BETWEEN "' . $this->input->get('date_from') . '" AND "' . $this->input->get('date_to') . '" 
            AND enquiry.status = "confirm" 
            AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
            AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '" 
            THEN 1 END) as confirm,
        
        COUNT(CASE 
            WHEN date(enquiry.query_received_date) BETWEEN "' . $this->input->get('date_from') . '" AND "' . $this->input->get('date_to') . '" 
            AND (enquiry.status != "confirm" AND enquiry.status != "not-materialized") 
            AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
            AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '" 
            THEN 1 END) as pending,
        
        COUNT(CASE 
            WHEN date(enquiry.query_received_date) BETWEEN "' . $this->input->get('date_from') . '" AND "' . $this->input->get('date_to') . '" 
            AND enquiry.status = "not-materialized" 
            AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
            AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '" 
            THEN 1 END) as not_materialized,
        admin.name
        ');


        $this->db->from('enquiry');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'left');

        if ($where != '') {
            $this->db->where($where);
        }

        $this->db->group_by(array('enquiry.file_handle_by'));

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $data['staff_data'] = $query->result_array();


        if ($this->input->get('submit') <> '' && $this->input->get('status') <> '') {
            if ($where == '') {
                $where = ' (1=1) ';
            }

            $where = "admin.admin_type NOT IN ('admin', 'superadmin', 'accounts_admin')";

            // Add conditions to the where clause based on inputs
            if (!empty($this->input->get('location'))) {
                $location = urldecode($this->input->get('location'));
                $loc = implode('","', $this->locations[$location]);
                if ($where != '') $where .= ' AND ';
                $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
            }
            $staff_id = $this->input->get('staff_id');
            $status = $this->input->get('status');
            $date_from = $this->input->get('date_from');
            $date_to = $this->input->get('date_to');

            switch ($status) {

                case 'future_confirm':
                    $where .= 'AND date(enquiry.query_received_date) > "' . $date_to . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;

                case 'confirm':
                    $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;

                case 'pending':
                    $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                              AND (enquiry.status != "confirm" AND enquiry.status != "not-materialized") 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;

                case 'not_materialized':
                    $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                              AND enquiry.status = "not-materialized" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;

                case 'previous_confirm':
                    $where .= 'AND date(enquiry.query_received_date) < "' . $date_from . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;

                case 'total':
                    $where .= 'AND (
                        (date(enquiry.query_received_date) > "' . $date_to . '" 
                            AND enquiry.status = "confirm") 
                        OR 
                        (date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                            AND enquiry.status = "confirm") 
                        OR 
                        (date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                             AND enquiry.status != "confirm") 
                    ) 
                    AND enquiry.file_handle_by = "' . $staff_id . '" 
                    AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                    AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                    break;
            }

            $select = 'company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id';

            $join = [
                ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
                ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = enquiry.file_handle_by'],
                ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
            ];

            $result_cnt =  $this->common_model->get_data('enquiry', '', '', $select, $where . ' ORDER BY enquiry.id', '', $count = true, $join);
            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'staff-report?' . $search[0];
            $config["total_rows"] = $result_cnt;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;
            $data['enquiry'] =  $this->common_model->get_data('enquiry', $offset, $config["per_page"], $select, $where . ' ORDER BY enquiry.id', '', $count = false, $join);
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $result_cnt;
        }
        $this->load->view('admin/staff_report', $data);
    }*/

    public function staff_report()
    {
        $data['locations'] = $this->locations;
        $where = "AND admin.admin_type NOT IN ('admin', 'superadmin', 'accounts_admin','accounts_view') AND admin.status!=0";
        $where_staff = '(1=1) '.$where;
        $data['staff_data'] = [];
        $data['links'] = '';
        $data['total'] = 0;
        if($this->input->get('submit')<>''){
                $search_data = [
                    'location' => $this->input->get('location'),
                    'staff_id'         => $this->input->get('staff_id'),
                    'quarter'         => $this->input->get('quarter'),
                    'date_from'         => $this->input->get('date_from'),
                    'date_to'         => $this->input->get('date_to'),
                ];
                log_user_activity('Staff Report Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));
    
            
            if (!empty($this->input->get('location'))) {
                $location = urldecode($this->input->get('location'));
                $loc = implode('","', $this->locations[$location]);

            if ($where != '') $where .= ' AND ';
                $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
                $where_staff .= ' AND admin.location IN ("all","'.$location.'") ';
            }

            // if (!empty($this->input->get('staff_id'))) {
            //     if ($this->input->get('staff_id') != 'all') {
            //         $staff = implode(',', $this->input->get('staff_id'));
            //         if ($where != '') $where .= ' AND ';
            //         $where .= 'enquiry.file_handle_by IN (' . $staff . ')';
            //         $where_staff .= ' AND admin.id IN (' . $staff . ')';
            //     }
            // }

            $staff_id = $this->input->get('staff_id');
            if (!empty($staff_id)) {
                if ($staff_id != 'all') {
                    if (is_array($staff_id)) {
                        $staff = implode(',', $staff_id);
                    } else {
                        $staff = $staff_id;
                    }

                    if ($where != '') $where .= ' AND ';
                    $where .= 'enquiry.file_handle_by IN (' . $staff . ')';
                    $where_staff .= ' AND admin.id IN (' . $staff . ')';
                }
            }

            
            if($this->input->get('quarter')<>''){
                $quarter_dates = explode('_',$this->input->get('quarter'));
                $date_from = $quarter_dates[0];
                $date_to = $quarter_dates[1];

            }else{ 
                $data['date_from'] = $date_from = $this->input->get('date_from');
                $data['date_to'] = $date_to = $this->input->get('date_to'); 
            }
            
            $qry_previous_prospect = 'SELECT t.id,t.name,GROUP_CONCAT(CONCAT(t.cnt,"_",t.status) ORDER BY t.status SEPARATOR ",") AS result 
            FROM (SELECT enquiry.status,COUNT(enquiry.id) AS cnt,admin.name,admin.id FROM `enquiry` 
            JOIN admin ON enquiry.file_handle_by = admin.id WHERE date(enquiry.query_received_date) < "'.$date_from.'" AND (date(enquiry.check_in_date) >= "'.$date_from.'" AND date(enquiry.check_out_date) <= "'.$date_to.'") '.$where.' GROUP BY enquiry.status,enquiry.file_handle_by) t GROUP BY t.id';
            
            $qry_current_prospect = 'SELECT t.id,t.name,GROUP_CONCAT(CONCAT(t.cnt,"_",t.status) ORDER BY t.status SEPARATOR ",") AS result 
            FROM (SELECT enquiry.status,COUNT(enquiry.id) AS cnt,admin.name,admin.id FROM `enquiry` 
            JOIN admin ON enquiry.file_handle_by = admin.id WHERE (date(enquiry.query_received_date) >= "'.$date_from.'" AND date(enquiry.query_received_date) <= "'.$date_to.'") AND (date(enquiry.check_in_date) >= "'.$date_from.'" AND date(enquiry.check_out_date) <= "'.$date_to.'") '.$where.' GROUP BY enquiry.status,enquiry.file_handle_by) t GROUP BY t.id';
            
            $qry_future_prospect = 'SELECT t.id,t.name,GROUP_CONCAT(CONCAT(t.cnt,"_",t.status) ORDER BY t.status SEPARATOR ",") AS result 
            FROM (SELECT enquiry.status,COUNT(enquiry.id) AS cnt,admin.name,admin.id FROM `enquiry` 
            JOIN admin ON enquiry.file_handle_by = admin.id WHERE (date(enquiry.query_received_date) >= "'.$date_from.'" AND date(enquiry.query_received_date) <= "'.$date_to.'") AND (date(enquiry.check_in_date) > "'.$date_to.'" OR date(enquiry.check_out_date) > "'.$date_to.'") '.$where.' GROUP BY enquiry.status,enquiry.file_handle_by) t GROUP BY t.id';
            
            $data['current_prospect'] = $this->common_model->custom_query($qry_current_prospect);
            $data['previous_prospect'] = $this->common_model->custom_query($qry_previous_prospect);
            $data['future_prospect'] = $this->common_model->custom_query($qry_future_prospect);
            
            if($this->input->get('graph')==true || $this->input->get('compare_graph')==true){
                //$staff_name = $data['previous_prospect'][0]->name;
                $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0','in-progress'=>'0','confirm'=>'0']; 
                $total = 0;
                if(!empty($data['previous_prospect'])){
                    $result = explode(',',$data['previous_prospect'][0]->result);
                    
                    foreach($result AS $list){
                        $res = explode('_',$list);
                        $number_cnt[$res[1]] = $res[0];
                        $total = $total + $res[0];
                    }
                }
                $staffData = [
                    ["name" => "Previous Prospect", "Total Files" => $total, "cancel-at-arrival" => $number_cnt['cancel-at-arrival'], 
                        "not-materialized" => $number_cnt['not-materialized'], "pending" => $number_cnt['pending'],  
                        "in-progress" => $number_cnt['in-progress'],'confirm'=>$number_cnt['confirm']],                    
                    ];
                
                $total = 0;
                $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0','in-progress'=>'0','confirm'=>'0']; 
                if(!empty($data['current_prospect'])){
                    $result = explode(',',$data['current_prospect'][0]->result);
                    foreach($result AS $list){
                        $res = explode('_',$list);
                        $number_cnt[$res[1]] = $res[0];
                        $total = $total + $res[0];
                    }
                }
                $arr = ["name" => "Current Prospect", "Total Files" => $total, "cancel-at-arrival" => $number_cnt['cancel-at-arrival'], 
                        "not-materialized" => $number_cnt['not-materialized'], "pending" => $number_cnt['pending'],  
                        "in-progress" => $number_cnt['in-progress'],'confirm'=>$number_cnt['confirm']];
                array_push($staffData,$arr);
                
                $total = 0;
                $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0','in-progress'=>'0','confirm'=>'0']; 
                
                if(!empty($data['future_prospect'])){
                    $result = explode(',',$data['future_prospect'][0]->result);                
                    foreach($result AS $list){
                        $res = explode('_',$list);
                        $number_cnt[$res[1]] = $res[0];
                        $total = $total + $res[0];
                    }
                }
                $arr = ["name" => "Future Prospect", "Total Files" => $total, "cancel-at-arrival" => $number_cnt['cancel-at-arrival'], 
                        "not-materialized" => $number_cnt['not-materialized'], "pending" => $number_cnt['pending'],  
                        "in-progress" => $number_cnt['in-progress'],'confirm'=>$number_cnt['confirm']];
                array_push($staffData,$arr);                
            }
            
            $result_cnt = $this->common_model->get_data('admin', '', '', '*',  $where_staff. ' ORDER BY admin.id', '', $count = true);
            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
            $config = array();
            $config["base_url"] = base_url() . 'staff-report?' . $search[0];
            $config["total_rows"] = $result_cnt;
            $config["per_page"] = 10;
            $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
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
            $this->pagination->initialize($config);
            $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['offset'] = $offset;
            $data['staff_data'] = $this->common_model->get_data('admin', $offset, $config["per_page"], '*',  $where_staff. ' ORDER BY admin.id', '', $count = false);
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $result_cnt;
        }
        if($this->input->get('graph')==true){
            log_user_activity('Staff Report View Graph',$this->session->userdata('id'), 'View Graph');
            // $data['content'] = 'admin/graph_view';
            $data['staff_name'] = $data['staff_data'][0]->name;
            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            $data['staffData'] = $staffData;

            $this->load->view('admin/graph_view', $data);
        }else if($this->input->get('compare_graph')==true){
            log_user_activity('Staff Report Compare Graph',$this->session->userdata('id'), 'Compare Graph');
            $data['staff_data'] = $this->common_model->get_data('admin', '', '', '*',  $where_staff. ' ORDER BY admin.id', '', $count = false);
            $data['content'] = 'admin/staff_report_comparison_graphs';
            $this->load->view('admin/layout', $data);
        }
        else{
            log_user_activity('Staff Report View',$this->session->userdata('id'), 'Staff Report: View');
            $data['content'] = 'admin/staff_report';
            $this->load->view('admin/layout', $data);
        }
    }

    public function staff_export_excel()
    {
        log_user_activity('Staff Report Excel Download',$this->session->userdata('id'), 'Staff Report: Excel Downloaded');

        $data['locations'] = $this->locations;
        $staff_id = $this->input->get('staff_id');
        $status = $this->input->get('status');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $where = "admin.admin_type NOT IN ('admin', 'superadmin', 'accounts_admin')";

        // Add conditions to the where clause based on inputs
        if (!empty($this->input->get('location'))) {
            $location = urldecode($this->input->get('location'));
            $loc = implode('","', $this->locations[$location]);
            if ($where != '') $where .= ' AND ';
            $where .= 'enquiry.enquiry_abbr IN ("' . $loc . '")';
        }


        switch ($status) {
            case 'future_confirm':
                $where .= 'AND date(enquiry.query_received_date) > "' . $date_to . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;

            case 'confirm':
                $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;

            case 'pending':
                $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                               AND (enquiry.status != "confirm" AND enquiry.status != "not-materialized") 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;

            case 'not_materialized':
                $where .= 'AND date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                              AND enquiry.status = "not-materialized" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;

            case 'previous_confirm':
                $where .= 'AND date(enquiry.query_received_date) < "' . $date_from . '" 
                              AND enquiry.status = "confirm" 
                              AND enquiry.file_handle_by = "' . $staff_id . '" 
                              AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                              AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;

            case 'total':
                $where .= 'AND (
                        (date(enquiry.query_received_date) > "' . $date_to . '" 
                            AND enquiry.status = "confirm") 
                        OR 
                        (date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                            AND enquiry.status = "confirm") 
                        OR 
                        (date(enquiry.query_received_date) BETWEEN "' . $date_from . '" AND "' . $date_to . '" 
                            AND enquiry.status != "confirm") 
                    AND enquiry.file_handle_by = "' . $staff_id . '" 
                    AND date(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" 
                    AND date(enquiry.check_out_date) <= "' . $this->input->get('date_to') . '"';
                break;
        }


        $select = 'company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id';

        $join = [
            ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = enquiry.file_handle_by'],
            ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
        ];


        $result =  $this->common_model->get_data('enquiry', '', '', $select, $where . ' ORDER BY enquiry.id', '', $count = false, $join);

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Recieved Date');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Query Entry Date/Time');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Query Number');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Handling File By');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Check-in');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Check-out');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Number Of Guests');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Agent Name');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Company');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Status');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $val) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, date('d-M-Y', strtotime($val->query_received_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d-M-Y', strtotime($val->date)));
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->enquiry_no);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->staff_name);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, date('d-M-Y', strtotime($val->check_in_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, date('d-M-Y', strtotime($val->check_out_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $val->number_persons . ' (A), ' . $val->number_child . ' (C)');
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $val->contact_person);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->name);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $val->city);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $val->follow_status);
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $result[0]->staff_name . '_Staff_report_' . date('d-m-Y') . '.xls"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    // old code before 02/04/20206
    // Agent Productivity report page
    // public function agent_productivity_report() {
    //     $year = date('Y');
    //     $data['locations'] = $this->locations;
    //     $where = 'enquiry.is_deleted = 0';

    //     // Abbreviation filter (initial fallback list)
    //     $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];

    //     // Apply location filter
    //     if ($this->input->get('location') != '') {
    //         $location = trim($this->input->get('location'));
    //         $abbrs = $data['locations'][$location]; 
    //     }

    //     // Escape abbrs for query
    //     $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
    //     $where .= " AND enquiry.enquiry_abbr IN ($abbr_clause)";

    //     // Apply filters from form
    //     if ($this->input->get('company_id') != '') {
    //         $where .= " AND enquiry.company_id = '" . trim($this->input->get('company_id')) . "'";
    //     }

    //     if ($this->input->get('quarter') != '') {
    //         $dates = explode('_', $this->input->get('quarter'));
    //         $where .= " AND DATE(enquiry.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where .= " AND DATE(enquiry.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
    //     }

    //     // Join with company_details
    //     $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

    //     if ($this->input->get('country') != '') {
    //         $where .= " AND LOWER(company_details.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
    //     }

    //     if ($this->input->get('state') != '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         $where .= ' AND LOWER(company_details.state) IN ("' . implode('","', $states) . '")';
    //     }

    //     if ($this->input->get('city') != '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         $where .= ' AND LOWER(company_details.city) IN ("' . implode('","', $cities) . '")';
    //     }

    //     // Final query with filters
    //     $query = "
    //         SELECT 
    //             company.name AS company_name,
    //             company.company_id AS company_id,
    //             COUNT(enquiry.id) AS query_received,
    //             SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //             SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //             SUM(
    //                 CASE 
    //                     WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND arrivals.currency = 'dollar' 
    //                     THEN arrivals.client_billing 
    //                     ELSE 0 
    //                 END
    //             ) AS total_billing
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         LEFT JOIN company ON enquiry.company_id = company.company_id
    //         $join
    //         WHERE $where
    //         GROUP BY enquiry.company_id
    //     ";
        
    //     $query_current_year = "
    //         SELECT 
    //             company.name AS company_name,
    //             company.company_id AS company_id,
    //             COUNT(enquiry.id) AS query_received,
    //             SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //             SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //             SUM(
    //                 CASE 
    //                     WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND arrivals.currency = 'dollar' 
    //                     THEN arrivals.client_billing 
    //                     ELSE 0 
    //                 END
    //             ) AS total_billing
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         LEFT JOIN company ON enquiry.company_id = company.company_id
    //         $join
    //         WHERE $where
    //         AND YEAR(enquiry.check_in_date) = '$year'
    //         GROUP BY enquiry.company_id
    //     ";

    //     if ($this->input->get('excel_download') == '1') {
    //         log_user_activity('Agent Productivity Report Download', $this->session->userdata('id'), 'Agent Productivity Report: Excel Export');
    //         $result = $this->db->query($query)->result();
    //         $this->agent_productivity_excel_download($result); // call download function
    //         exit;
    //     }
    //     log_user_activity('Agent Productivity Report', $this->session->userdata('id'), 'Agent Productivity Report: View');

    //     $filters_applied = 
    //             !empty($this->input->get('company_id')) ||
    //             !empty($this->input->get('quarter')) ||
    //             (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) ||
    //             !empty($this->input->get('country')) ||
    //             !empty($this->input->get('state')) ||
    //             !empty($this->input->get('city')) ||
    //             !empty($this->input->get('location'));

  
    //     $data['filters_applied'] = $filters_applied;

    //     $agent_report      = $this->db->query($query)->result();
    //     $agent_report_current_year = $this->db->query($query_current_year)->result();

    //     $data['agent_report']      = $agent_report;
    //     $data['$agent_report_current_year'] = $agent_report_current_year;

    //     if ($this->input->get()) {
    //         // If filters applied → use $agent_report
    //         $report_data = $agent_report;
    //         $data['filters_applied'] = true;
    //     } else {
    //         // If no filter → show only 2025 data
    //         $report_data = $agent_report_current_year;
    //         $data['filters_applied'] = false;
    //     }

    //     $total = [
    //         'total_query' => 0,
    //         'total_confirm' => 0,
    //         'total_cancel_at_arrival' => 0,
    //         'total_billing' => 0,
    //     ];

    //     foreach ($report_data as $row) {
    //         $total['total_query'] += $row->query_received;
    //         $total['total_confirm'] += $row->confirm_count;
    //         $total['total_cancel_at_arrival'] += $row->cancel_at_arrival_count;
    //         $total['total_billing'] += $row->total_billing;
    //     }

    //     $data['totals'] = $total;

    //     $data['content'] = 'admin/agent_productivity_report';
    //     $this->load->view('admin/layout', $data);
    // }


    // public function agent_productivity_excel_download($result) {
    //     if (ob_get_length()) ob_end_clean();
    //     $this->load->library('PHPExcel');
    //     include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->setActiveSheetIndex(0);
    //     $sheet = $objPHPExcel->getActiveSheet();

    //     // Set headers
    //     $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    //     $sheet->setCellValue('A1', 'S. No.');
    //     $sheet->setCellValue('B1', 'Company Name');
    //     $sheet->setCellValue('C1', 'Total Enquiries');
    //     $sheet->setCellValue('D1', 'Confirmed Files');
    //     $sheet->setCellValue('E1', 'Cancelled at Arrival');
    //     $sheet->setCellValue('F1', 'Total Revenue (USD)');

    //     // Populate rows
    //     $row = 2;
    //     $sr = 1;
    //     foreach ($result as $r) {
    //         $sheet->setCellValue('A' . $row, $sr);
    //         $sheet->setCellValue('B' . $row, ($r->company_name ?: 'B2C Sales'));
    //         $sheet->setCellValue('C' . $row, $r->query_received);
    //         $sheet->setCellValue('D' . $row, $r->confirm_count);
    //         $sheet->setCellValue('E' . $row, $r->cancel_at_arrival_count);
    //         $sheet->setCellValue('F' . $row, number_format((float)$r->total_billing, 2));
    //         $row++;
    //         $sr++;
    //     }

    //     // Output as Excel file
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="Agent-Productivity-Report_' . date('d-M-Y') . '.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $objWriter->save('php://output');
    //     exit;
    // }

    
    // public function download_agent_pdf($company_id) 
    // {
    //     // Basic company-level data
    //     $where = "enquiry.is_deleted = 0 AND enquiry.company_id = '".$this->db->escape_str($company_id)."'";
    //     $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

    //     // Main company summary
    //     $main_query = "
    //         SELECT 
    //             company.*,
    //             company_details.*,
    //             COUNT(enquiry.id) AS query_received,
    //             SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //             SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //             SUM(
    //                 CASE 
    //                     WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND arrivals.currency = 'dollar' 
    //                     THEN arrivals.client_billing 
    //                     ELSE 0 
    //                 END
    //             ) AS total_billing
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         LEFT JOIN company ON enquiry.company_id = company.company_id
    //         $join
    //         WHERE $where
    //         GROUP BY enquiry.company_id
    //     ";

    //     $result = $this->db->query($main_query)->row();

    //     if (!$result) {
    //         show_error("No data found for this company.");
    //     }

    //     // Yearly breakdown query
    //     $yearly_query = "
    //         WITH RECURSIVE year_range AS (
    //             SELECT LEAST(
    //                 (SELECT MIN(YEAR(e.check_in_date)) 
    //                 FROM enquiry e  
    //                 WHERE e.company_id = '".$this->db->escape_str($company_id)."' AND e.check_in_date IS NOT NULL),
    //                 (SELECT YEAR(c.date) 
    //                 FROM company c 
    //                 WHERE c.company_id = '".$this->db->escape_str($company_id)."')
    //             ) AS year

    //             UNION ALL

    //             SELECT year + 1
    //             FROM year_range
    //             WHERE year + 1 <= (
    //                 SELECT COALESCE(MAX(YEAR(e.check_in_date)), YEAR(CURDATE()))
    //                 FROM enquiry e
    //                 WHERE e.company_id = '".$this->db->escape_str($company_id)."'
    //             )
    //         ),

    //         enquiry_data AS (
    //             SELECT 
    //                 YEAR(e.check_in_date) AS year,
    //                 CASE 
    //                     WHEN e.enquiry_abbr IN ('FKZ', 'GKZ', 'IKZ') THEN 'KZ'
    //                     WHEN e.enquiry_abbr IN ('FAZ', 'GAZ', 'IAZ') THEN 'AZ'
    //                     WHEN e.enquiry_abbr IN ('FBZ', 'GBZ', 'IBZ') THEN 'BE'
    //                     WHEN e.enquiry_abbr IN ('FGE', 'GGE', 'IGE') THEN 'GE'
    //                     WHEN e.enquiry_abbr IN ('FAR', 'GAR', 'IAR') THEN 'AR'
    //                     WHEN e.enquiry_abbr IN ('FUZ', 'GUZ', 'IUZ') THEN 'UZ'
    //                     ELSE 'OT'
    //                 END AS destination,
    //                 COUNT(e.id) AS total_queries,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND a.currency = 'dollar' 
    //                     THEN a.client_billing ELSE 0 END
    //                 ) AS total_revenue
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             WHERE e.is_deleted = 0
    //             AND e.company_id = '".$this->db->escape_str($company_id)."'
    //             AND e.check_in_date IS NOT NULL
    //             GROUP BY YEAR(e.check_in_date), destination
    //         ),

    //         yearly_data AS (
    //             SELECT 
    //                 year,
    //                 SUM(total_queries) AS total_queries,
    //                 SUM(confirm_count) AS confirm_count,
    //                 SUM(cancel_at_arrival_count) AS cancel_at_arrival_count,
    //                 SUM(total_revenue) AS total_revenue,
    //                 GROUP_CONCAT(CONCAT(destination, '(', total_queries, ')') ORDER BY destination SEPARATOR ', ') AS query_dest,
    //                 GROUP_CONCAT(CONCAT(destination, '(', confirm_count, ')') ORDER BY destination SEPARATOR ', ') AS confirm_dest,
    //                 GROUP_CONCAT(CONCAT(destination, '(', cancel_at_arrival_count, ')') ORDER BY destination SEPARATOR ', ') AS cancel_dest
    //             FROM enquiry_data
    //             GROUP BY year
    //         )

    //         SELECT 
    //             yr.year,
    //             COALESCE(yd.total_queries, 0) AS total_queries,
    //             COALESCE(yd.confirm_count, 0) AS confirm_count,
    //             COALESCE(yd.cancel_at_arrival_count, 0) AS cancel_at_arrival_count,
    //             COALESCE(yd.total_revenue, 0) AS total_revenue,
    //             COALESCE(yd.query_dest, '') AS query_by_destination,
    //             COALESCE(yd.confirm_dest, '') AS confirm_by_destination,
    //             COALESCE(yd.cancel_dest, '') AS cancel_by_destination
    //         FROM year_range yr
    //         LEFT JOIN yearly_data yd ON yd.year = yr.year
    //         ORDER BY yr.year DESC";

    //     $yearly_data = $this->db->query($yearly_query)->result();

    //     $data =  [
    //         'report' => $result,
    //         'yearly_data' => $yearly_data,
    //     ];
    //     log_user_activity('Agent report pdf', $this->session->userdata('id'), 'Agent report pdf: view');        


    //     $this->load->view('admin/agent_report_pdf', $data);
    // }
    

    // public function download_agent_pdf1($company_id) 
    // {
    //     // Basic company-level data
    //     $where = "enquiry.is_deleted = 0 AND enquiry.company_id = '".$this->db->escape_str($company_id)."'";
    //     $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

    //     // Main company summary
    //     $main_query = "
    //         SELECT 
    //             company.*,
    //             company_details.*,
    //             COUNT(enquiry.id) AS query_received,
    //             SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //             SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //             SUM(
    //                 CASE 
    //                     WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND arrivals.currency = 'dollar' 
    //                     THEN arrivals.client_billing 
    //                     ELSE 0 
    //                 END
    //             ) AS total_billing
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         LEFT JOIN company ON enquiry.company_id = company.company_id
    //         $join
    //         WHERE $where
    //         GROUP BY enquiry.company_id
    //     ";

    //     $result = $this->db->query($main_query)->row();

    //     if (!$result) {
    //         show_error("No data found for this company.");
    //     }

    //     // Yearly breakdown query
    //     $yearly_query = "
    //         WITH RECURSIVE year_range AS (
    //             SELECT LEAST(
    //                 (SELECT MIN(YEAR(e.check_in_date)) 
    //                 FROM enquiry e  
    //                 WHERE e.company_id = '".$this->db->escape_str($company_id)."' AND e.check_in_date IS NOT NULL),
    //                 (SELECT YEAR(c.date) 
    //                 FROM company c 
    //                 WHERE c.company_id = '".$this->db->escape_str($company_id)."')
    //             ) AS year

    //             UNION ALL

    //             SELECT year + 1
    //             FROM year_range
    //             WHERE year + 1 <= (
    //                 SELECT COALESCE(MAX(YEAR(e.check_in_date)), YEAR(CURDATE()))
    //                 FROM enquiry e
    //                 WHERE e.company_id = '".$this->db->escape_str($company_id)."'
    //             )
    //         ),

    //         enquiry_data AS (
    //             SELECT 
    //                 YEAR(e.check_in_date) AS year,
    //                 CASE 
    //                     WHEN e.enquiry_abbr IN ('FKZ', 'GKZ', 'IKZ') THEN 'KZ'
    //                     WHEN e.enquiry_abbr IN ('FAZ', 'GAZ', 'IAZ') THEN 'AZ'
    //                     WHEN e.enquiry_abbr IN ('FBZ', 'GBZ', 'IBZ') THEN 'BE'
    //                     WHEN e.enquiry_abbr IN ('FGE', 'GGE', 'IGE') THEN 'GE'
    //                     WHEN e.enquiry_abbr IN ('FAR', 'GAR', 'IAR') THEN 'AR'
    //                     WHEN e.enquiry_abbr IN ('FUZ', 'GUZ', 'IUZ') THEN 'UZ'
    //                     ELSE 'OT'
    //                 END AS destination,
    //                 COUNT(e.id) AS total_queries,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete', 'file-closed', 'in-progress') 
    //                         AND a.currency = 'dollar' 
    //                     THEN a.client_billing ELSE 0 END
    //                 ) AS total_revenue
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             WHERE e.is_deleted = 0
    //             AND e.company_id = '".$this->db->escape_str($company_id)."'
    //             AND e.check_in_date IS NOT NULL
    //             GROUP BY YEAR(e.check_in_date), destination
    //         ),

    //         yearly_data AS (
    //             SELECT 
    //                 year,
    //                 SUM(total_queries) AS total_queries,
    //                 SUM(confirm_count) AS confirm_count,
    //                 SUM(cancel_at_arrival_count) AS cancel_at_arrival_count,
    //                 SUM(total_revenue) AS total_revenue,
    //                 GROUP_CONCAT(CONCAT(destination, '(', total_queries, ')') ORDER BY destination SEPARATOR ', ') AS query_dest,
    //                 GROUP_CONCAT(CONCAT(destination, '(', confirm_count, ')') ORDER BY destination SEPARATOR ', ') AS confirm_dest,
    //                 GROUP_CONCAT(CONCAT(destination, '(', cancel_at_arrival_count, ')') ORDER BY destination SEPARATOR ', ') AS cancel_dest
    //             FROM enquiry_data
    //             GROUP BY year
    //         )

    //         SELECT 
    //             yr.year,
    //             COALESCE(yd.total_queries, 0) AS total_queries,
    //             COALESCE(yd.confirm_count, 0) AS confirm_count,
    //             COALESCE(yd.cancel_at_arrival_count, 0) AS cancel_at_arrival_count,
    //             COALESCE(yd.total_revenue, 0) AS total_revenue,
    //             COALESCE(yd.query_dest, '') AS query_by_destination,
    //             COALESCE(yd.confirm_dest, '') AS confirm_by_destination,
    //             COALESCE(yd.cancel_dest, '') AS cancel_by_destination
    //         FROM year_range yr
    //         LEFT JOIN yearly_data yd ON yd.year = yr.year
    //         ORDER BY yr.year DESC";

    //     $yearly_data = $this->db->query($yearly_query)->result();


    //     // Load PDF view with both summary and yearly data
    //     require_once FCPATH . 'vendor/autoload.php';
    //     $mpdf = new \Mpdf\Mpdf();

    //     $html = $this->load->view('admin/agent_report_pdf1', [
    //         'report' => $result,
    //         'yearly_data' => $yearly_data,
    //     ], true);
        
    //     log_user_activity('Agent report pdf', $this->session->userdata('id'), 'Agent report pdf:' . json_encode($html));

    //     $pdf = new \Mpdf\Mpdf();
    //     $pdf->WriteHTML($html);
    //     $pdf->Output($result->name.'_Agent_Report.pdf', 'I');
    // }
    // old code before 02/04/20206
     
     
    // new code for agent productivity report start from here
    
    public function agent_productivity_report() {
        $year = date('Y');
        $data['locations'] = $this->locations;
        $where = 'enquiry.is_deleted = 0';
        $user_type = $this->session->userdata('type');
        $user_region = $this->session->userdata('region');
        // Region restriction for admin types 5 and 6
        if (in_array($user_type, [5, 6]) && !empty($user_region)) {
            $regions = array_map('trim', explode(',', $user_region));
            $regions = array_filter($regions);
            $regions_lower = array_map('strtolower', $regions);
            $regions_lower = array_unique($regions_lower);

            // Remove "all" if present – if only "all" remains, no restriction
            $regions_lower = array_diff($regions_lower, ['all']);

            if (!empty($regions_lower)) {
                $region_conditions = [];
                foreach ($regions_lower as $region) {
                    $escaped = $this->db->escape_str($region);
                    $region_conditions[] = "LOWER(company_details.country) = '$escaped'";
                    $region_conditions[] = "LOWER(company_details.state) = '$escaped'";
                }
                $region_where = '(' . implode(' OR ', $region_conditions) . ')';
                $where .= " AND $region_where";
            }
        }

        // Abbreviation filter (initial fallback list)
        $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];

        // Apply location filter
        if ($this->input->get('location') != '') {
            $location = trim($this->input->get('location'));
            $abbrs = $data['locations'][$location]; 
        }

        // Escape abbrs for query
        $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
        $where .= " AND enquiry.enquiry_abbr IN ($abbr_clause)";

        // Apply filters from form
        if ($this->input->get('company_id') != '') {
            $where .= " AND enquiry.company_id = '" . trim($this->input->get('company_id')) . "'";
        }

        if ($this->input->get('quarter') != '') {
            $dates = explode('_', $this->input->get('quarter'));
            $where .= " AND DATE(enquiry.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $where .= " AND DATE(enquiry.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
        }

        // Join with company_details
        $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

        if ($this->input->get('country') != '') {
            $where .= " AND LOWER(company_details.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
        }

        if ($this->input->get('state') != '') {
            $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
            $where .= ' AND LOWER(company_details.state) IN ("' . implode('","', $states) . '")';
        }

        if ($this->input->get('city') != '') {
            $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
            $where .= ' AND LOWER(company_details.city) IN ("' . implode('","', $cities) . '")';
        }

        // Final query with filters
        $query = "
            SELECT 
                company.name AS company_name,
                company.company_id AS company_id,
                COUNT(enquiry.id) AS query_received,
                SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                SUM(
                    CASE 
                        WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
                            AND arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END
                ) AS total_billing
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            LEFT JOIN company ON enquiry.company_id = company.company_id
            $join
            WHERE $where
            GROUP BY enquiry.company_id
        ";
        
        $query_current_year = "
            SELECT 
                company.name AS company_name,
                company.company_id AS company_id,
                COUNT(enquiry.id) AS query_received,
                SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                SUM(
                    CASE 
                        WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
                            AND arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END
                ) AS total_billing
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            LEFT JOIN company ON enquiry.company_id = company.company_id
            $join
            WHERE $where
            AND YEAR(enquiry.check_in_date) = '$year'
            GROUP BY enquiry.company_id
        ";

        if ($this->input->get('excel_download') == '1') {
            log_user_activity('Agent Productivity Report Download', $this->session->userdata('id'), 'Agent Productivity Report: Excel Export');
            $result = $this->db->query($query)->result();
            $this->agent_productivity_excel_download($result); // call download function
            exit;
        }
        log_user_activity('Agent Productivity Report', $this->session->userdata('id'), 'Agent Productivity Report: View');

        $filters_applied = 
                !empty($this->input->get('company_id')) ||
                !empty($this->input->get('quarter')) ||
                (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) ||
                !empty($this->input->get('country')) ||
                !empty($this->input->get('state')) ||
                !empty($this->input->get('city')) ||
                !empty($this->input->get('location'));

  
        $data['filters_applied'] = $filters_applied;

        $agent_report      = $this->db->query($query)->result();
        $agent_report_current_year = $this->db->query($query_current_year)->result();

        $data['agent_report']      = $agent_report;
        $data['$agent_report_current_year'] = $agent_report_current_year;

        if ($this->input->get()) {
            // If filters applied → use $agent_report
            $report_data = $agent_report;
            $data['filters_applied'] = true;
        } else {
            // If no filter → show only 2025 data
            $report_data = $agent_report_current_year;
            $data['filters_applied'] = false;
        }

        $total = [
            'total_query' => 0,
            'total_confirm' => 0,
            'total_cancel_at_arrival' => 0,
            'total_billing' => 0,
        ];

        foreach ($report_data as $row) {
            $total['total_query'] += $row->query_received;
            $total['total_confirm'] += $row->confirm_count;
            $total['total_cancel_at_arrival'] += $row->cancel_at_arrival_count;
            $total['total_billing'] += $row->total_billing;
        }

        $data['totals'] = $total;

        $data['content'] = 'admin/agent_productivity_report';
        $this->load->view('admin/layout', $data);
    }
    
    public function agent_productivity_excel_download($result) {
        if (ob_get_length()) ob_end_clean();
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        // Set headers
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->setCellValue('A1', 'S. No.');
        $sheet->setCellValue('B1', 'Company Name');
        $sheet->setCellValue('C1', 'Total Enquiries');
        $sheet->setCellValue('D1', 'Confirmed Files');
        $sheet->setCellValue('E1', 'Cancelled at Arrival');
        $sheet->setCellValue('F1', 'Total Revenue (USD)');

        // Populate rows
        $row = 2;
        $sr = 1;
        foreach ($result as $r) {
            $sheet->setCellValue('A' . $row, $sr);
            $sheet->setCellValue('B' . $row, ($r->company_name ?: 'B2C Sales'));
            $sheet->setCellValue('C' . $row, $r->query_received);
            $sheet->setCellValue('D' . $row, $r->confirm_count);
            $sheet->setCellValue('E' . $row, $r->cancel_at_arrival_count);
            $sheet->setCellValue('F' . $row, number_format((float)$r->total_billing, 2));
            $row++;
            $sr++;
        }

        // Output as Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Agent-Productivity-Report_' . date('d-M-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    public function download_agent_pdf($company_id) 
    {
        // Basic company-level data
        $where = "enquiry.is_deleted = 0 AND enquiry.company_id = '".$this->db->escape_str($company_id)."'";
        $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

        // Main company summary
        $main_query = "
            SELECT 
                company.*,
                company_details.*,
                COUNT(enquiry.id) AS query_received,
                SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                SUM(
                    CASE 
                        WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
                            AND arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END
                ) AS total_billing
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            LEFT JOIN company ON enquiry.company_id = company.company_id
            $join
            WHERE $where
            GROUP BY enquiry.company_id
        ";

        $result = $this->db->query($main_query)->row();

        if (!$result) {
            show_error("No data found for this company.");
        }

        // Yearly breakdown query
        $yearly_query = "
            WITH RECURSIVE year_range AS (
                SELECT LEAST(
                    (SELECT MIN(YEAR(e.check_in_date)) 
                    FROM enquiry e  
                    WHERE e.company_id = '".$this->db->escape_str($company_id)."' AND e.check_in_date IS NOT NULL),
                    (SELECT YEAR(c.date) 
                    FROM company c 
                    WHERE c.company_id = '".$this->db->escape_str($company_id)."')
                ) AS year

                UNION ALL

                SELECT year + 1
                FROM year_range
                WHERE year + 1 <= (
                    SELECT COALESCE(MAX(YEAR(e.check_in_date)), YEAR(CURDATE()))
                    FROM enquiry e
                    WHERE e.company_id = '".$this->db->escape_str($company_id)."'
                )
            ),

            enquiry_data AS (
                SELECT 
                    YEAR(e.check_in_date) AS year,
                    CASE 
                        WHEN e.enquiry_abbr IN ('FKZ', 'GKZ', 'IKZ') THEN 'KZ'
                        WHEN e.enquiry_abbr IN ('FAZ', 'GAZ', 'IAZ') THEN 'AZ'
                        WHEN e.enquiry_abbr IN ('FBZ', 'GBZ', 'IBZ') THEN 'BE'
                        WHEN e.enquiry_abbr IN ('FGE', 'GGE', 'IGE') THEN 'GE'
                        WHEN e.enquiry_abbr IN ('FAR', 'GAR', 'IAR') THEN 'AR'
                        WHEN e.enquiry_abbr IN ('FUZ', 'GUZ', 'IUZ') THEN 'UZ'
                        ELSE 'OT'
                    END AS destination,
                    COUNT(e.id) AS total_queries,
                    SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                    SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                    SUM(CASE 
                        WHEN a.status IN ('complete', 'file-closed', 'in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing ELSE 0 END
                    ) AS total_revenue
                FROM enquiry e
                LEFT JOIN arrivals a ON a.enquiry_id = e.id
                WHERE e.is_deleted = 0
                AND e.company_id = '".$this->db->escape_str($company_id)."'
                AND e.check_in_date IS NOT NULL
                GROUP BY YEAR(e.check_in_date), destination
            ),

            yearly_data AS (
                SELECT 
                    year,
                    SUM(total_queries) AS total_queries,
                    SUM(confirm_count) AS confirm_count,
                    SUM(cancel_at_arrival_count) AS cancel_at_arrival_count,
                    SUM(total_revenue) AS total_revenue,
                    GROUP_CONCAT(CONCAT(destination, '(', total_queries, ')') ORDER BY destination SEPARATOR ', ') AS query_dest,
                    GROUP_CONCAT(CONCAT(destination, '(', confirm_count, ')') ORDER BY destination SEPARATOR ', ') AS confirm_dest,
                    GROUP_CONCAT(CONCAT(destination, '(', cancel_at_arrival_count, ')') ORDER BY destination SEPARATOR ', ') AS cancel_dest
                FROM enquiry_data
                GROUP BY year
            )

            SELECT 
                yr.year,
                COALESCE(yd.total_queries, 0) AS total_queries,
                COALESCE(yd.confirm_count, 0) AS confirm_count,
                COALESCE(yd.cancel_at_arrival_count, 0) AS cancel_at_arrival_count,
                COALESCE(yd.total_revenue, 0) AS total_revenue,
                COALESCE(yd.query_dest, '') AS query_by_destination,
                COALESCE(yd.confirm_dest, '') AS confirm_by_destination,
                COALESCE(yd.cancel_dest, '') AS cancel_by_destination
            FROM year_range yr
            LEFT JOIN yearly_data yd ON yd.year = yr.year
            ORDER BY yr.year DESC";

        $yearly_data = $this->db->query($yearly_query)->result();

        $data =  [
            'report' => $result,
            'yearly_data' => $yearly_data,
        ];
        log_user_activity('Agent report pdf', $this->session->userdata('id'), 'Agent report pdf: view');        


        $this->load->view('admin/agent_report_pdf', $data);
    }

    public function download_agent_pdf1($company_id) 
    {
        // Basic company-level data
        $where = "enquiry.is_deleted = 0 AND enquiry.company_id = '".$this->db->escape_str($company_id)."'";
        $join = ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

        // Main company summary
        $main_query = "
            SELECT 
                company.*,
                company_details.*,
                COUNT(enquiry.id) AS query_received,
                SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                SUM(CASE WHEN enquiry.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                SUM(
                    CASE 
                        WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') 
                            AND arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END
                ) AS total_billing
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            LEFT JOIN company ON enquiry.company_id = company.company_id
            $join
            WHERE $where
            GROUP BY enquiry.company_id
        ";

        $result = $this->db->query($main_query)->row();

        if (!$result) {
            show_error("No data found for this company.");
        }

        // Yearly breakdown query
        $yearly_query = "
            WITH RECURSIVE year_range AS (
                SELECT LEAST(
                    (SELECT MIN(YEAR(e.check_in_date)) 
                    FROM enquiry e  
                    WHERE e.company_id = '".$this->db->escape_str($company_id)."' AND e.check_in_date IS NOT NULL),
                    (SELECT YEAR(c.date) 
                    FROM company c 
                    WHERE c.company_id = '".$this->db->escape_str($company_id)."')
                ) AS year

                UNION ALL

                SELECT year + 1
                FROM year_range
                WHERE year + 1 <= (
                    SELECT COALESCE(MAX(YEAR(e.check_in_date)), YEAR(CURDATE()))
                    FROM enquiry e
                    WHERE e.company_id = '".$this->db->escape_str($company_id)."'
                )
            ),

            enquiry_data AS (
                SELECT 
                    YEAR(e.check_in_date) AS year,
                    CASE 
                        WHEN e.enquiry_abbr IN ('FKZ', 'GKZ', 'IKZ') THEN 'KZ'
                        WHEN e.enquiry_abbr IN ('FAZ', 'GAZ', 'IAZ') THEN 'AZ'
                        WHEN e.enquiry_abbr IN ('FBZ', 'GBZ', 'IBZ') THEN 'BE'
                        WHEN e.enquiry_abbr IN ('FGE', 'GGE', 'IGE') THEN 'GE'
                        WHEN e.enquiry_abbr IN ('FAR', 'GAR', 'IAR') THEN 'AR'
                        WHEN e.enquiry_abbr IN ('FUZ', 'GUZ', 'IUZ') THEN 'UZ'
                        ELSE 'OT'
                    END AS destination,
                    COUNT(e.id) AS total_queries,
                    SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
                    SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_count,
                    SUM(CASE 
                        WHEN a.status IN ('complete', 'file-closed', 'in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing ELSE 0 END
                    ) AS total_revenue
                FROM enquiry e
                LEFT JOIN arrivals a ON a.enquiry_id = e.id
                WHERE e.is_deleted = 0
                AND e.company_id = '".$this->db->escape_str($company_id)."'
                AND e.check_in_date IS NOT NULL
                GROUP BY YEAR(e.check_in_date), destination
            ),

            yearly_data AS (
                SELECT 
                    year,
                    SUM(total_queries) AS total_queries,
                    SUM(confirm_count) AS confirm_count,
                    SUM(cancel_at_arrival_count) AS cancel_at_arrival_count,
                    SUM(total_revenue) AS total_revenue,
                    GROUP_CONCAT(CONCAT(destination, '(', total_queries, ')') ORDER BY destination SEPARATOR ', ') AS query_dest,
                    GROUP_CONCAT(CONCAT(destination, '(', confirm_count, ')') ORDER BY destination SEPARATOR ', ') AS confirm_dest,
                    GROUP_CONCAT(CONCAT(destination, '(', cancel_at_arrival_count, ')') ORDER BY destination SEPARATOR ', ') AS cancel_dest
                FROM enquiry_data
                GROUP BY year
            )

            SELECT 
                yr.year,
                COALESCE(yd.total_queries, 0) AS total_queries,
                COALESCE(yd.confirm_count, 0) AS confirm_count,
                COALESCE(yd.cancel_at_arrival_count, 0) AS cancel_at_arrival_count,
                COALESCE(yd.total_revenue, 0) AS total_revenue,
                COALESCE(yd.query_dest, '') AS query_by_destination,
                COALESCE(yd.confirm_dest, '') AS confirm_by_destination,
                COALESCE(yd.cancel_dest, '') AS cancel_by_destination
            FROM year_range yr
            LEFT JOIN yearly_data yd ON yd.year = yr.year
            ORDER BY yr.year DESC";

        $yearly_data = $this->db->query($yearly_query)->result();


        // Load PDF view with both summary and yearly data
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $html = $this->load->view('admin/agent_report_pdf1', [
            'report' => $result,
            'yearly_data' => $yearly_data,
        ], true);
        
        log_user_activity('Agent report pdf', $this->session->userdata('id'), 'Agent report pdf:' . json_encode($html));

        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($html);
        $pdf->Output($result->name.'_Agent_Report.pdf', 'I');
    }
     
    
     // Sales Team productivity report page
    // public function sales_productivity_report()
    // {
    //     $data['locations'] = $this->locations;
    //     $where = 'e.is_deleted = 0';

    //     // Location abbreviation
    //     $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];
    //     if ($this->input->get('location') != '') {
    //         $location = trim($this->input->get('location'));
    //         $abbrs = $data['locations'][$location];
    //     }
    //     $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
    //     $where .= " AND e.enquiry_abbr IN ($abbr_clause)";

    //     // Company
    //     if ($this->input->get('company_id') != '') {
    //         $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
    //     }

    //     // Dates
    //     if ($this->input->get('quarter') != '') {
    //         $dates = explode('_', $this->input->get('quarter'));
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
    //     }

    //     // Country
    //     if ($this->input->get('country') != '') {
    //         $where .= " AND LOWER(cd.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
    //     }

    //     // State
    //     if ($this->input->get('state') != '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     }

    //     // City
    //     if ($this->input->get('city') != '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
    //     }

        
    //     // Admin filter
    //     $sales_id = $this->input->get('sales');
    //     $sales_filter_sql = !empty($sales_id) 
    //         ? "admin.id = '" . $this->db->escape_str($sales_id) . "'" 
    //         : "admin.type IN (5, 6)";

    //     // Final Query
    //     $query = "
    //         WITH RECURSIVE region_split AS (
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
    //                 admin.created AS admin_created
    //             FROM admin
    //             WHERE $sales_filter_sql

    //             UNION ALL

    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
    //                 rs.admin_created
    //             FROM region_split rs
    //             WHERE rs.remaining <> ''
    //         )

    //         SELECT 
    //             LOWER(rs.region) AS region,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM (
    //             SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
    //         ) rs
    //         JOIN enquiry e ON e.is_deleted = 0
    //         AND e.query_received_date >= rs.admin_created
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             (LOWER(cd.state) = rs.region OR LOWER(cd.country) = rs.region)
    //             AND $where
    //         GROUP BY rs.region
    //     ";
        
    //     // Same query but restricted to year 2025
    //     $query_2025 = "
    //         WITH RECURSIVE region_split AS (
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
    //                 admin.created AS admin_created
    //             FROM admin
    //             WHERE $sales_filter_sql

    //             UNION ALL

    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
    //                 rs.admin_created
    //             FROM region_split rs
    //             WHERE rs.remaining <> ''
    //         )

    //         SELECT 
    //             LOWER(rs.region) AS region,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM (
    //             SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
    //         ) rs
    //         JOIN enquiry e ON e.is_deleted = 0
    //         AND e.query_received_date >= rs.admin_created
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             (LOWER(cd.state) = rs.region OR LOWER(cd.country) = rs.region)
    //             AND $where
    //             AND YEAR(e.check_in_date) = 2025
    //         GROUP BY rs.region
    //     ";

    //     $select = 'admin.*';
    //     $where = 'type IN ("5", "6") AND status = 1';
    //     $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);

    //     if ($this->input->get('excel_download') == '1') {
    //         log_user_activity('sales Productivity Excel Export', $this->session->userdata('id'), 'Agent Productivity Report: Excel Export');
    //         $result = $this->db->query($query)->result();
    //         $this->sales_productivity_excel_download($result); // call download function
    //         exit;
    //     }

    //     $filters_applied = !empty($this->input->get('company_id')) ||
    //               !empty($this->input->get('quarter')) ||
    //               (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) ||
    //               !empty($this->input->get('country')) ||
    //               !empty($this->input->get('state')) ||
    //               !empty($this->input->get('city')) ||
    //               !empty($this->input->get('location')) ||
    //               !empty($this->input->get('sales'));

    //     $data['filters_applied'] = $filters_applied;

    //     $sales_report      = $this->db->query($query)->result();
    //     $sales_report_2025 = $this->db->query($query_2025)->result();

    //     $data['sales_report']      = $sales_report;
    //     $data['sales_report_2025'] = $sales_report_2025;

    //     // Totals logic moved here
    //     $totals = [
    //         'queries'   => 0,
    //         'confirmed' => 0,
    //         'cancel'    => 0,
    //         'revenue'   => 0,
    //         'pax'       => 0,
    //     ];

    //     if ($this->input->get()) {
    //         // If filters applied → use $sales_report
    //         $report_data = $sales_report;
    //         $data['filters_applied'] = true;
    //     } else {
    //         // If no filter → show only 2025 data
    //         $report_data = $sales_report_2025;
    //         $data['filters_applied'] = false;
    //     }

    //     foreach ($report_data as $row) {
    //         $totals['queries']   += $row->total_queries;
    //         $totals['confirmed'] += $row->confirmed_queries;
    //         $totals['cancel']    += $row->cancel_at_arrival;
    //         $totals['revenue']   += $row->total_revenue;
    //         $totals['pax']       += $row->total_pax;
    //     }

    //     $data['totals'] = $totals;
    //     $data['content'] = 'admin/sales_productivity_report';
    //     log_user_activity('sales Productivity', $this->session->userdata('id'), 'Sales Productivity report: View');
    //     $this->load->view('admin/layout', $data);
    // }

    // 05 Dec 2025 previous
    // public function sales_productivity_report()
    // {
    //     $data['locations'] = $this->locations;
    //     $where = 'e.is_deleted = 0';

    //     // Company
    //     if ($this->input->get('company_id') != '') {
    //         $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
    //     }

    //     // Dates
    //     if ($this->input->get('quarter') != '') {
    //         $dates = explode('_', $this->input->get('quarter'));
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
    //     }

    //     // Country
    //     if ($this->input->get('country') != '') {
    //         $where .= " AND LOWER(cd.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
    //     }

    //     // State
    //     if ($this->input->get('state') != '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     }

    //     // City
    //     if ($this->input->get('city') != '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
    //     }

    //     // Admin filter
    //     $sales_id = $this->input->get('sales');
    //     if (!empty($sales_id)) {
    //         $admin_condition = "admin.id = '" . $this->db->escape_str($sales_id) . "'";
    //         $enquiry_condition = "e.sales_admin_id = '" . $this->db->escape_str($sales_id) . "'";
    //     } else {
    //         $admin_condition   = "admin.type IN (5, 6)";
    //         $enquiry_condition = "1=1";
    //     }

    //     // Next/Previous/All filter
    //     $time_period_filter = $this->input->get('time_period');
    //     $time_period_condition = "";
        
    //     // if (!empty($time_period_filter) && !empty($sales_id)) {
    //     //     switch ($time_period_filter) {
    //     //         case 'next':
    //     //             // Get data after admin.created date AND match sales_admin_id
    //     //             $time_period_condition = " AND e.query_received_date >= rs.admin_created AND cd.sales_admin_id = " . $this->db->escape($sales_id);
    //     //             break;
    //     //         case 'previous':
    //     //             // Get data before admin.created date AND match sales_admin_id
    //     //             $time_period_condition = " AND e.query_received_date < rs.admin_created AND cd.sales_admin_id = " . $this->db->escape($sales_id);
    //     //             break;
    //     //         case 'all':
    //     //             // Get all data AND match sales_admin_id
    //     //             // $time_period_condition = " AND cd.sales_admin_id = " . $this->db->escape($sales_id);
    //     //             break;
    //     //         default:
    //     //             $time_period_condition = "";
    //     //             break;
    //     //     }
    //     // }

    //     // Tier filter
    //     // if ($this->input->get('tier') != '') {
    //     //     $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('tier'))))));
    //     //     $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     // }

    //     // Final Query
    //     $query = "
    //         WITH RECURSIVE region_split AS (
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
    //                 admin.created AS admin_created
    //             FROM admin
    //             WHERE $admin_condition
    //             UNION ALL
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
    //                 rs.admin_created
    //             FROM region_split rs
    //             WHERE rs.remaining <> ''
    //         )

    //         SELECT 
    //             LOWER(rs.region) AS region,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') 
    //                     AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM (
    //             SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
    //         ) rs
    //         JOIN enquiry e ON e.is_deleted = 0 AND $enquiry_condition
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             (LOWER(cd.state) = rs.region OR LOWER(cd.country) = rs.region)
    //             AND $where
    //             $time_period_condition
    //         GROUP BY rs.region
    //     ";

    //     // Same query but restricted to year 2025
    //     $query_2025 = "
    //         WITH RECURSIVE region_split AS (
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
    //                 admin.created AS admin_created
    //             FROM admin
    //             WHERE $admin_condition
    //             UNION ALL
    //             SELECT 
    //                 TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
    //                 TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
    //                 rs.admin_created
    //             FROM region_split rs
    //             WHERE rs.remaining <> ''
    //         )

    //         SELECT 
    //             LOWER(rs.region) AS region,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') 
    //                     AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM (
    //             SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
    //         ) rs
    //         JOIN enquiry e ON e.is_deleted = 0 AND $enquiry_condition
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             (LOWER(cd.state) = rs.region OR LOWER(cd.country) = rs.region)
    //             AND $where
    //             AND YEAR(e.check_in_date) = 2025
    //             $time_period_condition
    //         GROUP BY rs.region
    //     ";

    //     $select = 'admin.*';
    //     $where = 'type IN ("5", "6") AND status = 1';
    //     $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);

    //     if ($this->input->get('excel_download') == '1') {
    //         log_user_activity('sales Productivity Excel Export', $this->session->userdata('id'), 'Agent Productivity Report: Excel Export');
    //         $result = $this->db->query($query)->result();
    //         $this->sales_productivity_excel_download($result);
    //         exit;
    //     }

    //     $filters_applied = !empty($this->input->get('company_id')) ||
    //               !empty($this->input->get('quarter')) ||
    //               (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) ||
    //               !empty($this->input->get('country')) ||
    //               !empty($this->input->get('state')) ||
    //               !empty($this->input->get('city')) ||
    //               !empty($this->input->get('sales'));

    //     $data['filters_applied'] = $filters_applied;
    //     $sales_report      = $this->db->query($query)->result();
    //     $sales_report_2025 = $this->db->query($query_2025)->result();

    //     $data['sales_report']      = $sales_report;
    //     $data['sales_report_2025'] = $sales_report_2025;

    //     // Totals logic moved here
    //     $totals = [
    //         'queries'   => 0,
    //         'confirmed' => 0,
    //         'cancel'    => 0,
    //         'revenue'   => 0,
    //         'pax'       => 0,
    //     ];

    //     if ($this->input->get()) {
    //         // If filters applied → use $sales_report
    //         $report_data = $sales_report;
    //         $data['filters_applied'] = true;
    //     } else {
    //         // If no filter → show only 2025 data
    //         $report_data = $sales_report_2025;
    //         $data['filters_applied'] = false;
    //     }

    //     foreach ($report_data as $row) {
    //         $totals['queries']   += $row->total_queries;
    //         $totals['confirmed'] += $row->confirmed_queries;
    //         $totals['cancel']    += $row->cancel_at_arrival;
    //         $totals['revenue']   += $row->total_revenue;
    //         $totals['pax']       += $row->total_pax;
    //     }

    //     $data['totals'] = $totals;
    //     // echo $this->db->last_query();
    //     log_user_activity('sales Productivity', $this->session->userdata('id'), 'Sales Productivity report: View');
    //     $data['content'] = 'admin/sales_productivity_report';
    //     $this->load->view('admin/layout', $data);
    // }

    // 05 Dec 2025 excel previous
    // public function sales_productivity_excel_download($result)
    // {
    //     if (ob_get_length()) ob_end_clean();

    //     $this->load->library('PHPExcel');
    //     include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

    //     $objPHPExcel = new PHPExcel();
    //     $sheet = $objPHPExcel->setActiveSheetIndex(0);

    //     // Set headers
    //     $sheet->getStyle('A1:G1')->getFont()->setBold(true);
    //     $sheet->setCellValue('A1', 'S. No.');
    //     $sheet->setCellValue('B1', 'Region');
    //     $sheet->setCellValue('C1', 'Total Enquiries');
    //     $sheet->setCellValue('D1', 'Confirmed Files');
    //     $sheet->setCellValue('E1', 'Cancelled at Arrival');
    //     $sheet->setCellValue('F1', 'Total Revenue (USD)');
    //     $sheet->setCellValue('G1', 'Total Pax');

    //     // Populate data
    //     $row = 2;
    //     $sr = 1;
    //     foreach ($result as $r) {
    //         $sheet->setCellValue('A' . $row, $sr++);
    //         $sheet->setCellValue('B' . $row, ucfirst($r->region));
    //         $sheet->setCellValue('C' . $row, $r->total_queries);
    //         $sheet->setCellValue('D' . $row, $r->confirmed_queries);
    //         $sheet->setCellValue('E' . $row, $r->cancel_at_arrival);
    //         $sheet->setCellValue('F' . $row, number_format((float)$r->total_revenue, 2));
    //         $sheet->setCellValue('G' . $row, $r->total_pax);
    //         $row++;
    //     }

    //     // Export to Excel
    //     $filename = 'Sales-Productivity-Report_' . date('d-M-Y') . '.xlsx';
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header("Content-Disposition: attachment; filename=\"$filename\"");
    //     header('Cache-Control: max-age=0');

    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $objWriter->save('php://output');
    //     exit;
    // }

    // public function download_sales_pdf($region) 
    // {

    //     $region = urldecode($region);
    //     $region_lower = strtolower($region);
    //     $location =  $this->input->post('location');
    //     $country =  $this->input->post('country');
    //     $state =  $this->input->post('state');
    //     $city =  $this->input->post('city');
    //     $date_from =  $this->input->post('date_from');
    //     $date_to =  $this->input->post('date_to');
    //     $quarter =  $this->input->post('quarter');
    //     $sales =  $this->input->post('sales');

    //     $data['locations'] = $this->locations;
    //     $where = 'e.is_deleted = 0';

    //     // Location abbreviation
    //     $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];
    //     if ($this->input->get('location') != '') {
    //         $location = trim($this->input->get('location'));
    //         $abbrs = $data['locations'][$location];
    //     }
    //     $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
    //     $where .= " AND e.enquiry_abbr IN ($abbr_clause)";

    //     // Company
    //     if ($this->input->get('company_id') != '') {
    //         $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
    //     }

    //     // Dates
    //     if ($this->input->get('quarter') != '') {
    //         $dates = explode('_', $this->input->get('quarter'));
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
    //     }

    //     // Country
    //     if ($this->input->get('country') != '') {
    //         $where .= " AND LOWER(cd.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
    //     }

    //     // State
    //     if ($this->input->get('state') != '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     }

    //     // City
    //     if ($this->input->get('city') != '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
    //     }
        
    //     // Admin filter
    //     $sales_id = $this->input->get('sales');
    //     $sales_filter_sql = !empty($sales_id) 
    //         ? "admin.id = '" . $this->db->escape_str($sales_id) . "'" 
    //         : "admin.type IN (5, 6)";

    //     // Load mPDF
    //     require_once FCPATH . 'vendor/autoload.php';
    //     $mpdf = new \Mpdf\Mpdf();

    //     // Simplified SQL query using direct region match
    //     $sql = "
    //         SELECT 
    //             ? AS region,
    //             COUNT(e.id) AS total_query,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
    //             SUM(CASE 
    //                 WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                 THEN a.client_billing 
    //                 ELSE 0 
    //             END) AS total_billing_dollar,
    //             SUM(CASE 
    //                 WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                     THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                 WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                     THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                 ELSE 0 
    //             END) AS total_num_persons
    //         FROM enquiry e
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             e.is_deleted = 0 AND 
    //             (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //     ";

    //     $yearwiseReport = "
    //         SELECT 
    //             ? AS region,
    //             YEAR(e.check_in_date) AS year,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM enquiry e
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             e.is_deleted = 0
    //             AND e.check_in_date IS NOT NULL
    //             AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //         GROUP BY YEAR(e.check_in_date)
    //         ORDER BY YEAR(e.check_in_date)";

        
    //     $cityReport = $this->db->query("
    //         SELECT 
    //             LOWER(cd.city) AS city,
    //             COUNT(e.id) AS total_queries,
    //             SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //             SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing 
    //                     ELSE 0 
    //                 END) AS total_revenue,
    //             SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_pax
    //         FROM enquiry e
    //         LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //         LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //         WHERE 
    //             e.is_deleted = 0
    //             AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //         GROUP BY cd.city
    //         ORDER BY total_queries DESC
    //     ", [$region, $region])->result();

    //     $YearlyCitywiseData = 
    //     $this->db->query("
    //     SELECT 
    //         LOWER(cd.city) AS city,
    //         YEAR(e.check_in_date) AS year,
            
    //         COUNT(e.id) AS total_queries,
    //         SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //         SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
            
    //         SUM(CASE 
    //             WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //             THEN a.client_billing 
    //             ELSE 0 
    //         END) AS total_revenue,

    //         SUM(CASE 
    //             WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                 THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //             WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                 THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //             ELSE 0 
    //         END) AS total_pax

    //     FROM enquiry e
    //     LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //     LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

    //     WHERE 
    //         e.is_deleted = 0
    //         AND e.check_in_date IS NOT NULL
    //         AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)

    //     GROUP BY year, cd.city
    //     ORDER BY year DESC, total_queries DESC", [$region, $region])->result();

    //     // Run the query with parameters (region label, match state, match country)
    //     $result = $this->db->query($sql, [$region_lower, $region_lower, $region_lower])->row();
    //     $yearlydata = $this->db->query($yearwiseReport, [$region_lower, $region_lower, $region_lower])->result();
        
    //     // Load view and pass the result
    //     $html = $this->load->view('admin/sales_report_pdf', [
    //         'report' => $result,
    //         'city_report' => $cityReport,
    //         'yearlyreport' => $yearlydata,
    //         'yearlycitywisedata' => $YearlyCitywiseData
    //     ], true);

    //     // Generate PDF
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output($result->region . '_Sales_Report.pdf', 'I');
    // }

    // public function download_sales_pdf($region) 
    // {
    //     $region = urldecode($region);
    //     $region_lower = strtolower($region);

    //     $location   = $this->input->post('location');
    //     $country    = $this->input->post('country');
    //     $state      = $this->input->post('state');
    //     $city       = $this->input->post('city');
    //     $date_from  = $this->input->post('date_from');
    //     $date_to    = $this->input->post('date_to');
    //     $quarter    = $this->input->post('quarter');
    //     $sales      = $this->input->post('sales');

    //     $data['locations'] = $this->locations;
    //     $where = 'e.is_deleted = 0';

    //     // Location abbreviation
    //     $abbrs = ['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE','FAR','GAR','IAR','FUZ','GUZ','IUZ'];
    //     if ($this->input->get('location') != '') {
    //         $location = trim($this->input->get('location'));
    //         $abbrs = $data['locations'][$location];
    //     }
    //     $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
    //     $where .= " AND e.enquiry_abbr IN ($abbr_clause)";

    //     // Company
    //     if ($this->input->get('company_id') != '') {
    //         $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
    //     }

    //     // Dates
    //     if ($this->input->get('quarter') != '') {
    //         $dates = explode('_', $this->input->get('quarter'));
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
    //     }

    //     // Country
    //     if ($this->input->get('country') != '') {
    //         $where .= " AND LOWER(cd.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
    //     }

    //     // State
    //     if ($this->input->get('state') != '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     }

    //     // City
    //     if ($this->input->get('city') != '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
    //     }

    //     // Admin filter
    //     $sales_id = $this->input->get('sales');
    //     $sales_filter_sql = !empty($sales_id) 
    //         ? "admin.id = '" . $this->db->escape_str($sales_id) . "'" 
    //         : "admin.type IN (5, 6)";

    //     // Check if any filters applied
        // $filtersApplied = (!empty($location) || !empty($country) || !empty($state) || 
        //             !empty($city) || !empty($date_from) || !empty($date_to) || 
        //             !empty($quarter) || !empty($sales));

    //     // Load mPDF
    //     require_once FCPATH . 'vendor/autoload.php';
    //     $mpdf = new \Mpdf\Mpdf();

    //     // If filters are applied → show only $result
    //     if ($filtersApplied) {
    //         // Base SQL (for region summary)
    //         $sql = "
    //             SELECT 
    //                 ? AS region,
    //                 COUNT(e.id) AS total_query,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing ELSE 0 END
    //                 ) AS total_billing_dollar,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 END
    //                 ) AS total_num_persons
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
                
    //             WHERE $where
                
    //         ";

    //         // Run summary query
    //         $result = $this->db->query($sql, [$region_lower])->row();
            
    //         $html = $this->load->view('admin/sales_report_pdf', [
    //             'report' => $result,
    //             'city_report' => [],
    //             'yearlyreport' => [],
    //             'yearlycitywisedata' => []
    //         ], true);

    //     } else {
    //         $sql = "
    //             SELECT 
    //                 ? AS region,
    //                 COUNT(e.id) AS total_query,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing ELSE 0 
    //                 END) AS total_billing_dollar,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 
    //                 END) AS total_num_persons
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //             WHERE e.is_deleted = 0
    //         ";
    //         $result = $this->db->query($sql, [$region_lower])->row();

    //         // Else → get all reports
    //         $yearwiseReport = "
    //             SELECT 
    //                 ? AS region,
    //                 YEAR(e.check_in_date) AS year,
    //                 COUNT(e.id) AS total_queries,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //                 SUM(CASE 
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                         THEN a.client_billing ELSE 0 END
    //                 ) AS total_revenue,
    //                 SUM(CASE 
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                             THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                             THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                         ELSE 0 END
    //                 ) AS total_pax
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //             WHERE 
    //                 e.is_deleted = 0
    //                 AND e.check_in_date IS NOT NULL
    //                 AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //             GROUP BY YEAR(e.check_in_date)
    //             ORDER BY YEAR(e.check_in_date)
    //         ";
    //         $yearlydata = $this->db->query($yearwiseReport, [$region_lower, $region_lower])->result();

    //         $cityReport = $this->db->query("
    //             SELECT 
    //                 LOWER(cd.city) AS city,
    //                 COUNT(e.id) AS total_queries,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //                 SUM(CASE 
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                         THEN a.client_billing ELSE 0 END
    //                 ) AS total_revenue,
    //                 SUM(CASE 
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                             THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                         WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                             THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                         ELSE 0 END
    //                 ) AS total_pax
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //             WHERE 
    //                 e.is_deleted = 0
    //                 AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //             GROUP BY cd.city
    //             ORDER BY total_queries DESC
    //         ", [$region_lower, $region_lower])->result();

    //         $YearlyCitywiseData = $this->db->query("
    //             SELECT 
    //                 LOWER(cd.city) AS city,
    //                 YEAR(e.check_in_date) AS year,
    //                 COUNT(e.id) AS total_queries,
    //                 SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
    //                 SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
    //                     THEN a.client_billing ELSE 0 END
    //                 ) AS total_revenue,
    //                 SUM(CASE 
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
    //                         THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
    //                     WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
    //                         THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
    //                     ELSE 0 END
    //                 ) AS total_pax
    //             FROM enquiry e
    //             LEFT JOIN arrivals a ON a.enquiry_id = e.id
    //             LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
    //             WHERE 
    //                 e.is_deleted = 0
    //                 AND e.check_in_date IS NOT NULL
    //                 AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
    //             GROUP BY year, cd.city
    //             ORDER BY year DESC, total_queries DESC
    //         ", [$region_lower, $region_lower])->result();

    //         $html = $this->load->view('admin/sales_report_pdf', [
    //             'report' => $result,
    //             'city_report' => $cityReport,
    //             'yearlyreport' => $yearlydata,
    //             'yearlycitywisedata' => $YearlyCitywiseData
    //         ], true);
    //     }

    //     // Generate PDF
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output($result->region . '_Sales_Report.pdf', 'I');
    // }
    
    // sales productivity report updated
    public function sales_productivity_report()
    {
        $year = date('Y');
        $data['locations'] = $this->locations;
        $where = 'e.is_deleted = 0';
        $filters_text = [];

        // Company filter
        if ($this->input->get('company_id') != '') {
            $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
            $filters_text[] = "Company ID: " . $this->input->get('company_id');
        }

        // Quarter / Date Range
        if ($this->input->get('quarter') != '') {
            $dates = explode('_', $this->input->get('quarter'));
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
            $filters_text[] = "Quarter: " . trim($dates[0]) . " to " . trim($dates[1]);
        } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
            $filters_text[] = "Dates: " . $this->input->get('date_from') . " to " . $this->input->get('date_to');
        }

        // Country filter
        if ($this->input->get('country') != '') {
            $where .= " AND LOWER(cd.country) = '" . strtolower(trim($this->input->get('country'))) . "'";
            $filters_text[] = "Country: " . $this->input->get('country');
        }

        // State filter
        if ($this->input->get('state') != '') {
            $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
            $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
            $filters_text[] = "State: " . $this->input->get('state');
        }

        // City filter
        if ($this->input->get('city') != '') {
            $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
            $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
            $filters_text[] = "City: " . $this->input->get('city');
        }

        /* -----------------------------
            ADMIN FILTER
        ------------------------------*/
        $sales_id = $this->input->get('sales');

        if (!empty($sales_id)) {

            $admin_condition   = "admin.id = '" . $this->db->escape_str($sales_id) . "'";
            // $enquiry_condition = "e.sales_admin_id = '" . $this->db->escape_str($sales_id) . "'";
            $enquiry_condition = "1=1";

            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('id', $sales_id);
            $this->db->limit(1);
            $sales_data = $this->db->get()->row();

            $filters_text[] = "Sales Person: " . $sales_data->name . " | Joining Date: " . $sales_data->created;

        } else {

            $admin_condition   = "admin.type IN (5, 6)";
            $enquiry_condition = "1=1";
        }

        /* -----------------------------
            TIME PERIOD FILTER
        ------------------------------*/
        $time_period_condition = "";
        $time_period_filter = $this->input->get('time_period');

        if (!empty($time_period_filter) && !empty($sales_id)) {

            if ($time_period_filter == "after_joining") {
                $time_period_condition = " AND e.query_received_date >= rs.admin_created ";
            }
            if ($time_period_filter == "before_joining") {
                $time_period_condition = " AND e.query_received_date < rs.admin_created ";
            }

            $filters_text[] = "Time Period: " . ucwords(str_replace('_', ' ', $time_period_filter));
        }
        
        
        $statesData = $this->db->get_where('states', ['country_id' => 101])->result();

        $states_list = [];
        foreach ($statesData as $s) {
            $states_list[] = strtolower(trim($s->name));
        }

        $states_sql_list = "'" . implode("','", $states_list) . "'";

        $dynamic_region_condition = "
        (
            CASE 
                WHEN rs.region IN ($states_sql_list)
                    THEN (LOWER(cd.state) = rs.region AND LOWER(cd.country) = 'india')
                ELSE 
                    (LOWER(cd.state) = rs.region OR LOWER(cd.country) = rs.region)
            END
        )";
        

        $query = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition
                UNION ALL
                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            )

            SELECT 
                LOWER(rs.region) AS region,

                COUNT(e.id) AS total_queries,

                -- Total confirmed queries
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,

                -- Cancel at arrival count
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,

                 -- FIT count (confirmed only, abbr starts with F or I)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm' 
                            AND (e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%')
                        THEN 1 
                        ELSE 0 
                    END
                ) AS fit_count,

                -- GIT count (confirmed only, abbr starts with G)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm'
                            AND e.enquiry_abbr LIKE 'G%'
                        THEN 1 
                        ELSE 0 
                    END
                ) AS git_count,

                -- Total revenue
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,

                -- Pax count logic
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax

            FROM (
                SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
            ) rs
            JOIN enquiry e ON e.is_deleted = 0 AND $enquiry_condition
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

            WHERE 
                $dynamic_region_condition
                AND $where
                $time_period_condition

            GROUP BY rs.region
        ";

        $query_2025 = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            )

            SELECT 
                LOWER(rs.region) AS region,

                COUNT(e.id) AS total_queries,

                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,

                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,

                 -- FIT count (confirmed only, abbr starts with F or I)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm' 
                            AND (e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%')
                        THEN 1 
                        ELSE 0 
                    END
                ) AS fit_count,

                -- GIT count (confirmed only, abbr starts with G)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm'
                            AND e.enquiry_abbr LIKE 'G%'
                        THEN 1 
                        ELSE 0 
                    END
                ) AS git_count,

                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                END) AS total_revenue,

                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                END) AS total_pax

            FROM (
                SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
            ) rs

            JOIN enquiry e 
                ON e.is_deleted = 0 
                AND $enquiry_condition

            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

            WHERE 
                $dynamic_region_condition
                AND $where
                AND YEAR(e.check_in_date) = '$year'
                $time_period_condition

            GROUP BY rs.region
        ";

        $where1 = '';

        if ($this->input->get('quarter') != '') {
            $dates = explode('_', $this->input->get('quarter'));
            $where1 .= " AND DATE(c.date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        } elseif ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $where1 .= " AND DATE(c.date) BETWEEN '" . trim($this->input->get('date_from')) . "' AND '" . trim($this->input->get('date_to')) . "'";
        }

        /* ------------------------------------------------------
            SALES TEAM DROPDOWN
        -------------------------------------------------------*/
        $select = 'admin.*';
        $where_admin = 'type IN ("5", "6") AND status = 1';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where_admin);

        $filters_summary = implode(" | ", $filters_text);
       
        /* ------------------------------------------------------
            GET DATA
        -------------------------------------------------------*/
        // $filters_applied = !empty($_GET);
        
        // Copy GET params
        $get_params = $_GET;
        // Exclude excel_download

        unset($get_params['excel_download']);

        // Check if any real filter is applied
        $filters_applied = !empty($get_params);
        
        $data['filters_applied'] = $filters_applied;
        $this->session->set_userdata('report_filter', $_GET);

        $sales_report      = $this->db->query($query)->result();
        $sales_report_2025 = $this->db->query($query_2025)->result();
        $report_data = $filters_applied ? $sales_report : $sales_report_2025;

        $data['sales_report']      = $report_data;
        $data['sales_report_2025'] = $sales_report_2025;

        /* ------------------------------------------------------
            TOTALS
        -------------------------------------------------------*/
        $totals = [
            'queries'   => 0,
            'confirmed' => 0,
            'cancel'    => 0,
            'revenue'   => 0,
            'pax'       => 0,
        ];

        // $yearbase_data = $filters_applied ? ' AND YEAR(e.check_in_date) = 2025' : '';
        $company_2025_data = $filters_applied ? "" : " AND c.date BETWEEN '{$year}-01-01' AND '{$year}-12-31'";

        // Company satus query start here
        $company_status_query = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            ),

            region_data AS (
                SELECT DISTINCT LOWER(region_split.region) AS region
                FROM region_split
                JOIN company_details cd 
                    ON LOWER(cd.state) = LOWER(region_split.region)
                    OR LOWER(cd.country) = LOWER(region_split.region)
                JOIN enquiry e 
                    ON e.company_id = cd.company
                    AND e.is_deleted = 0
            ),

            company_status AS (
                SELECT 
                    DISTINCT 
                    cd.company AS company_id,
                    CASE 
                        WHEN LOWER(cd.state) IN (SELECT region FROM region_data) 
                            THEN LOWER(cd.state)
                        WHEN LOWER(cd.country) IN (SELECT region FROM region_data)
                            THEN LOWER(cd.country)
                        ELSE NULL
                    END AS region,

                    CASE 
                        WHEN (
                            SELECT COUNT(*) 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status = 'confirm'
                        ) > 1 THEN 'queries-converted'

                        WHEN (
                            SELECT COUNT(*) 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status = 'confirm'
                        ) = 1 THEN 'only-one-query-converted'

                        WHEN EXISTS (
                            SELECT 1 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status != 'confirm'
                        ) THEN 'query-received-but-not-converted'

                        ELSE 'no-query'
                    END AS enquiry_status

                FROM company_details cd
                LEFT JOIN company c ON c.company_id = cd.company
                WHERE 
                    c.is_deleted != '1'
                    AND cd.status = 'active'
                    $where1
                    $company_2025_data
            ),

            company_aggregate AS (
                SELECT 
                    region,
                    COUNT(*) AS total_rows,
                    SUM(CASE WHEN enquiry_status = 'no-query' THEN 1 ELSE 0 END) AS no_query,
                    SUM(CASE WHEN enquiry_status = 'only-one-query-converted' THEN 1 ELSE 0 END) AS only_one_query_converted,
                    SUM(CASE WHEN enquiry_status = 'query-received-but-not-converted' THEN 1 ELSE 0 END) AS query_received_but_not_converted,
                    SUM(CASE WHEN enquiry_status = 'queries-converted' THEN 1 ELSE 0 END) AS queries_converted
                FROM company_status
                GROUP BY region
            )

            SELECT 
                rd.region,
                COALESCE(ca.total_rows, 0) AS total_rows,
                COALESCE(ca.no_query, 0) AS no_query,
                COALESCE(ca.only_one_query_converted, 0) AS only_one_query_converted,
                COALESCE(ca.query_received_but_not_converted, 0) AS query_received_but_not_converted,
                COALESCE(ca.queries_converted, 0) AS queries_converted
            FROM region_data rd
            LEFT JOIN company_aggregate ca ON rd.region = ca.region
            ORDER BY rd.region
        ";
        
        
        // Total company count
        $total_company_data = "
                WITH RECURSIVE region_split AS (
                    SELECT 
                        TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                        TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                        admin.created AS admin_created
                    FROM admin
                    
                    UNION ALL
                    
                    SELECT 
                        TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                        TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                        rs.admin_created
                    FROM region_split rs
                    WHERE rs.remaining <> ''
                ),

                region_data AS (
                    SELECT DISTINCT LOWER(region_split.region) AS region
                    FROM region_split
                    JOIN company_details cd 
                        ON LOWER(cd.state) = LOWER(region_split.region)
                        OR LOWER(cd.country) = LOWER(region_split.region)
                    JOIN enquiry e 
                        ON e.company_id = cd.company
                        AND e.is_deleted = 0
                ),

                company_status AS (
                    SELECT 
                        DISTINCT 
                        cd.company AS company_id,
                        CASE 
                            WHEN LOWER(cd.state) IN (SELECT region FROM region_data) 
                                THEN LOWER(cd.state)
                            WHEN LOWER(cd.country) IN (SELECT region FROM region_data)
                                THEN LOWER(cd.country)
                            ELSE NULL
                        END AS region

                    FROM company_details cd
                    LEFT JOIN company c ON c.company_id = cd.company
                    WHERE 
                        c.is_deleted != '1'
                        AND cd.status = 'active'
                ),

                company_aggregate AS (
                    SELECT 
                        region,
                        COUNT(*) AS total_rows
                    FROM company_status
                    GROUP BY region
                )

                SELECT 
                    rd.region,
                    COALESCE(ca.total_rows, 0) AS total_company
                FROM region_data rd
                LEFT JOIN company_aggregate ca ON rd.region = ca.region
                ORDER BY rd.region
        ";

        $result = $report_data;
        // STEP 1: Extract regions from $result
        $result_regions = array_column($result, 'region');

        $company_data = $this->db->query($company_status_query)->result();

        // Filter only regions that exist in $result
        $filtered_company_data = array_filter($company_data, function($row) use ($result_regions) {
            return in_array($row->region, $result_regions);
        });

        // Re-index the array
        $filtered_company_data = array_values($filtered_company_data);

        // Assign back if needed
        $company_data = $filtered_company_data;
        $data['company_data'] = $company_data;
        
        $total_company = $this->db->query($total_company_data)->result();
        // Filter only regions that exist in $result
        $filtered_total_company_data = array_filter($total_company, function($row) use ($result_regions) {
            return in_array($row->region, $result_regions);
        });
        
        // Re-index the array
        $filtered_total_company_data = array_values($filtered_total_company_data);
        
        // Assign back if needed
        $total_company = $filtered_total_company_data;
        $data['total_company'] = $total_company;

         /* ------------------------------------------------------
            EXCEL EXPORT
        -------------------------------------------------------*/
        if ($this->input->get('excel_download') == '1') {
            log_user_activity('sales Productivity Excel Export', $this->session->userdata('id'), 'Agent Productivity Report: Excel Export');
            
            $this->sales_productivity_excel_download($result, $company_data, $filters_summary, $total_company);
            exit;
        }

        foreach ($report_data as $row) {
            $totals['queries']   += $row->total_queries;
            $totals['confirmed'] += $row->confirmed_queries;
            $totals['cancel']    += $row->cancel_at_arrival;
            $totals['revenue']   += $row->total_revenue;
            $totals['pax']       += $row->total_pax;
        }

        $data['totals'] = $totals;

        log_user_activity('sales Productivity', $this->session->userdata('id'), 'Sales Productivity report: View');

        $data['content'] = 'admin/sales_productivity_report';
        $this->load->view('admin/layout', $data);
    }

    // 05-dec 2025 updated
    public function sales_productivity_excel_download($result, $company_data, $filters_summary = '', $total_company)
    {
        if (ob_get_length()) ob_end_clean();

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        // ============================================
        //  TOP FILTER SUMMARY ROW
        // ============================================
        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', $filters_summary != '' ? "FILTERS: " . $filters_summary : "FILTERS: None");

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $sheet->getRowDimension(1)->setRowHeight(22);

        // ============================================
        // HEADERS NOW START FROM ROW 2
        // ============================================
        $sheet->getStyle('A2:N2')->getFont()->setBold(true);

        // Set headers
        $sheet->getStyle('A2:G1')->getFont()->setBold(true);
        $sheet->setCellValue('A2', 'S. No.');
        $sheet->setCellValue('B2', 'Region');
        $sheet->setCellValue('C2', 'Total Company');
        $sheet->setCellValue('D2', 'Company');
        $sheet->setCellValue('E2', 'No Query');
        $sheet->setCellValue('F2', 'Query Received but No Conversion');
        $sheet->setCellValue('G2', 'Single Confirmed Query');
        $sheet->setCellValue('H2', 'Multiple Confirmed Queries');
        $sheet->setCellValue('I2', 'Total Enquiries');
        $sheet->setCellValue('J2', 'Confirmed Files');
        $sheet->setCellValue('K2', 'FIT Count');
        $sheet->setCellValue('L2', 'Git Count');
        $sheet->setCellValue('M2', 'Cancelled at Arrival');
        $sheet->setCellValue('N2', 'Total Revenue (USD)');
        $sheet->setCellValue('O2', 'Total Pax');

        // Populate data
        $row = 3;
        $sr = 1;
        foreach ($total_company as $r) {
            $sheet->setCellValue('A' . $row, $sr++);
            $sheet->setCellValue('B' . $row, ucfirst($r->region));
            $sheet->setCellValue('C' . $row, $r->total_company);
            $row++;
        }

        $row = 3;
        foreach ($company_data as $r) {
            $sheet->setCellValue('D' . $row, $r->total_rows);
            $sheet->setCellValue('E' . $row, $r->no_query);
            $sheet->setCellValue('F' . $row, $r->query_received_but_not_converted);
            $sheet->setCellValue('G' . $row, $r->only_one_query_converted);
            $sheet->setCellValue('H' . $row, $r->queries_converted);
            
            $row++;
        }

        $row = 3;
        foreach ($result as $r) {
            $sheet->setCellValue('I' . $row, $r->total_queries);
            $sheet->setCellValue('J' . $row, $r->confirmed_queries);
            $sheet->setCellValue('K' . $row, $r->fit_count);
            $sheet->setCellValue('L' . $row, $r->git_count);
            $sheet->setCellValue('M' . $row, $r->cancel_at_arrival);
            $sheet->setCellValue('N' . $row, number_format((float)$r->total_revenue, 2));
            $sheet->setCellValue('O' . $row, $r->total_pax);
            $row++;
        }

        // Export to Excel
        $filename = 'Sales-Productivity-Report_' . date('d-M-Y') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    // get enquiry no of the region on click of fit and git count and cancel-at-arrival
    // public function get_enquiries_by_type()
    // {
    //     $region = strtolower($this->input->post('region'));
    //     $type   = $this->input->post('type');
    //     $data = $this->session->userdata('report_filter') ?? '';

    //     if (!$region || !$type) {
    //         echo "<p class='text-danger'>Invalid request.</p>";
    //         return;
    //     }

    //     // FIT Condition
    //     if ($type == "fit") {
    //         $type_sql = "AND e.status = 'confirm' AND (e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%')";
    //     }
    //     elseif ($type == "git") {
    //         $type_sql = "AND e.status = 'confirm' AND e.enquiry_abbr LIKE 'G%'";
    //     }
    //     elseif ($type == "cancel-at-arrival") {
    //         $type_sql = "AND e.status = 'cancel-at-arrival'";
    //     } 
    //      elseif ($type == "confirm") {
    //         $type_sql = "AND e.status = 'confirm'";
    //     } 
    //      elseif ($type == "total_query") {
    //         $type_sql = "AND e.id";
    //     } 
    //     else {
    //         echo "Invalid Type";
    //         return;
    //     }

    //     $where = "";

    //     // Company filter   
    //     if (!empty($data['company_id'])) {
    //         $where .= " AND e.company_id = '" . trim($data['company_id']) . "'";
    //     }

    //     // Quarter filter
    //     if (!empty($data['quarter'])) {
    //         $dates = explode('_', $data['quarter']);
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
    //     }
    //     // Date range filter
    //     elseif (!empty($data['date_from']) && !empty($data['date_to'])) {
    //         $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($data['date_from']) . "' AND '" . trim($data['date_to']) . "'";
    //     }

    //     // Country filter
    //     if (!empty($data['country'])) {
    //         $where .= " AND LOWER(cd.country) = '" . strtolower(trim($data['country'])) . "'";
    //     }

    //     // State filter
    //     if (!empty($data['state'])) {
    //         $states = array_filter(array_map('trim', explode(',', strtolower($data['state']))));
    //         $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
    //     }

    //     // City filter
    //     if (!empty($data['city'])) {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower($data['city']))));
    //         $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
    //     }

    //     // Detect if any filters were applied
    //     $filters_applied = !empty($data);

    //     // Year filter only when NO filters applied
    //     $year_filter = $filters_applied ? "" : " AND YEAR(e.check_in_date) = 2025";

    //     $sql = "
    //         SELECT 
    //             e.*, 
    //             cd.country, 
    //             cd.state,
    //             COALESCE(a.client_billing, 0) AS revenue
    //         FROM enquiry e
    //         LEFT JOIN arrivals a 
    //             ON a.enquiry_id = e.id
    //             AND a.status IN ('complete','file-closed','in-progress')
    //         JOIN company_details cd 
    //             ON cd.company_id = e.company_details_id
    //         WHERE 
    //             e.is_deleted = 0
    //             AND (LOWER(cd.state) = '$region' OR LOWER(cd.country) = '$region')
    //             $type_sql
    //             $where
    //             $year_filter
    //         ORDER BY e.enquiry_no DESC
    //     ";

    //     $result = $this->db->query($sql)->result();
        
    //     // $query = $this->db->last_query();

    //     if (empty($result)) {
    //         echo "<p class='text-center text-muted'>No enquiries found.</p>";
    //         return;
    //     }

    //     $countryMap = [
    //         'kazakhstan'  => ['FKZ', 'GKZ', 'IKZ'],
    //         'azerbaijan'  => ['FAZ', 'GAZ', 'IAZ'],
    //         'belarus'     => ['FBZ', 'GBZ', 'IBZ'],
    //         'georgia'     => ['FGE', 'GGE', 'IGE'],
    //         'armenia'     => ['FAR','GAR','IAR'],
    //         'uzbekistan'  => ['FUZ','GUZ','IUZ']
    //     ];

    //     foreach ($result as $i => $row) {
    //         $matchedCountry = "-";

    //         // Find which country matches the enquiry_abbr
    //         foreach ($countryMap as $country => $codes) {
    //             if (in_array($row->enquiry_abbr, $codes)) {
    //                 $matchedCountry = ucfirst($country);
    //                 break;
    //             }
    //         }

    //         echo "<tr>
    //                 <td>".($i+1)."</td>
    //                 <td>{$row->enquiry_no}</td>
    //                 <td>{$row->enquiry_abbr}</td>
    //                 <td>{$matchedCountry}</td>";
    //                 if($type == 'confirm' || $type == 'git' || $type == 'fit'){
    //                 echo "<td>{$row->revenue}</td>";
    //                 }
    //             echo "</tr>";
    //     }

    // }
    
    
    
        // get enquiry no of the region on click of fit and git count and cancel-at-arrival
    public function get_enquiries_by_type()
    {
        $year = date('Y');
        $region = strtolower($this->input->post('region'));
        $type   = $this->input->post('type');
        $data = $this->session->userdata('report_filter') ?? '';

        if (!$region || !$type) {
            echo "<p class='text-danger'>Invalid request.</p>";
            return;
        }

        // FIT Condition
        if ($type == "fit") {
            $type_sql = "AND e.status = 'confirm' AND (e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%')";
        }
        elseif ($type == "git") {
            $type_sql = "AND e.status = 'confirm' AND e.enquiry_abbr LIKE 'G%'";
        }
        elseif ($type == "cancel-at-arrival") {
            $type_sql = "AND e.status = 'cancel-at-arrival'";
        } 
         elseif ($type == "confirm") {
            $type_sql = "AND e.status = 'confirm'";
        } 
         elseif ($type == "total_query") {
            $type_sql = "AND e.id";
        } 
        else {
            echo "Invalid Type";
            return;
        }

        $where = "";

        // Company filter   
        if (!empty($data['company_id'])) {
            $where .= " AND e.company_id = '" . trim($data['company_id']) . "'";
        }

        // Quarter filter
        if (!empty($data['quarter'])) {
            $dates = explode('_', $data['quarter']);
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        }
        // Date range filter
        elseif (!empty($data['date_from']) && !empty($data['date_to'])) {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($data['date_from']) . "' AND '" . trim($data['date_to']) . "'";
        }

        // Country filter
        if (!empty($data['country'])) {
            $where .= " AND LOWER(cd.country) = '" . strtolower(trim($data['country'])) . "'";
        }

        // State filter
        if (!empty($data['state'])) {
            $states = array_filter(array_map('trim', explode(',', strtolower($data['state']))));
            $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
        }

        // City filter
        if (!empty($data['city'])) {
            $cities = array_filter(array_map('trim', explode(',', strtolower($data['city']))));
            $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
        }

        // Detect if any filters were applied
        $filters_applied = !empty($data);

        // Year filter only when NO filters applied
        $year_filter = $filters_applied ? "" : " AND YEAR(e.check_in_date) = '$year'";

        $sql = "
            SELECT 
                e.*, 
                cd.country, 
                cd.state,
                COALESCE(a.client_billing, 0) AS revenue
            FROM enquiry e
            LEFT JOIN arrivals a 
                ON a.enquiry_id = e.id
                AND a.status IN ('complete','file-closed','in-progress')
            JOIN company_details cd 
                ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND (LOWER(cd.state) = '$region' OR LOWER(cd.country) = '$region')
                $type_sql
                $where
                $year_filter
            ORDER BY e.enquiry_no DESC
        ";

        $result = $this->db->query($sql)->result();
        
        // $query = $this->db->last_query();

        if (empty($result)) {
            echo "<p class='text-center text-muted'>No enquiries found.</p>";
            return;
        }

        $countryMap = [
            'kazakhstan'  => ['FKZ', 'GKZ', 'IKZ'],
            'azerbaijan'  => ['FAZ', 'GAZ', 'IAZ'],
            'belarus'     => ['FBZ', 'GBZ', 'IBZ'],
            'georgia'     => ['FGE', 'GGE', 'IGE'],
            'armenia'     => ['FAR','GAR','IAR'],
            'uzbekistan'  => ['FUZ','GUZ','IUZ']
        ];

        foreach ($result as $i => $row) {
            $matchedCountry = "-";

            // Find which country matches the enquiry_abbr
            foreach ($countryMap as $country => $codes) {
                if (in_array($row->enquiry_abbr, $codes)) {
                    $matchedCountry = ucfirst($country);
                    break;
                }
            }

            echo "<tr>
                    <td>".($i+1)."</td>
                    <td>{$row->enquiry_no}</td>
                    <td>{$row->enquiry_abbr}</td>
                    <td>{$matchedCountry}</td>";
                    if($type == 'confirm' || $type == 'git' || $type == 'fit'){
                    echo "<td>{$row->revenue}</td>";
                    }
                echo "</tr>";
        }

    }

    // Excel download method
    public function download_enquiries_excel()
    {
        if (ob_get_length()) ob_end_clean();
        $year = date('Y');

        $region = strtolower($this->input->post('region'));
        $type   = $this->input->post('type');
        $data = $this->session->userdata('report_filter') ?? '';

        if (!$region || !$type) {
            echo "<p class='text-danger'>Invalid request.</p>";
            return;
        }

        // FIT Condition
        if ($type == "fit") {
            $type_sql = "AND e.status = 'confirm' AND (e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%')";
        }
        elseif ($type == "git") {
            $type_sql = "AND e.status = 'confirm' AND e.enquiry_abbr LIKE 'G%'";
        }
        elseif ($type == "cancel-at-arrival") {
            $type_sql = "AND e.status = 'cancel-at-arrival'";
        } 
         elseif ($type == "confirm") {
            $type_sql = "AND e.status = 'confirm'";
        } 
         elseif ($type == "total_query") {
            $type_sql = "AND e.id";
        } 
        else {
            echo "Invalid Type";
            return;
        }

        $where = "";

        // Company filter   
        if (!empty($data['company_id'])) {
            $where .= " AND e.company_id = '" . trim($data['company_id']) . "'";
        }

        // Quarter filter
        if (!empty($data['quarter'])) {
            $dates = explode('_', $data['quarter']);
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        }
        // Date range filter
        elseif (!empty($data['date_from']) && !empty($data['date_to'])) {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($data['date_from']) . "' AND '" . trim($data['date_to']) . "'";
        }

        // Country filter
        if (!empty($data['country'])) {
            $where .= " AND LOWER(cd.country) = '" . strtolower(trim($data['country'])) . "'";
        }

        // State filter
        if (!empty($data['state'])) {
            $states = array_filter(array_map('trim', explode(',', strtolower($data['state']))));
            $where .= " AND LOWER(cd.state) IN ('" . implode("','", $states) . "')";
        }

        // City filter
        if (!empty($data['city'])) {
            $cities = array_filter(array_map('trim', explode(',', strtolower($data['city']))));
            $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
        }

        // Detect if any filters were applied
        $filters_applied = !empty($data);

        // Year filter only when NO filters applied
        $year_filter = $filters_applied ? "" : " AND YEAR(e.check_in_date) = '$year'";

        $sql = "
            SELECT 
                e.*, 
                cd.country, 
                cd.state,
                COALESCE(a.client_billing, 0) AS revenue
            FROM enquiry e
            LEFT JOIN arrivals a 
                ON a.enquiry_id = e.id
                AND a.status IN ('complete','file-closed','in-progress')
            JOIN company_details cd 
                ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND (LOWER(cd.state) = '$region' OR LOWER(cd.country) = '$region')
                $type_sql
                $where
                $year_filter
            ORDER BY e.enquiry_no DESC
        ";

        $result = $this->db->query($sql)->result();

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        $col = 'A';
        $sheet->setCellValue($col++.'1', 'S. No.');
        $sheet->setCellValue($col++.'1', 'Enquiry No');
        $sheet->setCellValue($col++.'1', 'Enquiry Abbr');
        $sheet->setCellValue($col++.'1', 'Country');

        $showRevenue = in_array($type, ['confirm','git','fit']);
        if ($showRevenue) {
            $sheet->setCellValue($col++.'1', 'Revenue');
        }

        $sheet->getStyle('A1:'.$col.'1')->getFont()->setBold(true);

        $countryMap = [
            'kazakhstan'  => ['FKZ', 'GKZ', 'IKZ'],
            'azerbaijan'  => ['FAZ', 'GAZ', 'IAZ'],
            'belarus'     => ['FBZ', 'GBZ', 'IBZ'],
            'georgia'     => ['FGE', 'GGE', 'IGE'],
            'armenia'     => ['FAR','GAR','IAR'],
            'uzbekistan'  => ['FUZ','GUZ','IUZ']
        ];

        $rowNo = 2;
        $sr = 1;

        foreach ($result as $row) {

            $matchedCountry = '-';
            foreach ($countryMap as $country => $codes) {
                if (in_array($row->enquiry_abbr, $codes)) {
                    $matchedCountry = ucfirst($country);
                    break;
                }
            }

            $col = 'A';
            $sheet->setCellValue($col++.$rowNo, $sr++);
            $sheet->setCellValue($col++.$rowNo, $row->enquiry_no);
            $sheet->setCellValue($col++.$rowNo, $row->enquiry_abbr);
            $sheet->setCellValue($col++.$rowNo, $matchedCountry);

            if ($showRevenue) {
                $sheet->setCellValue($col++.$rowNo, $row->revenue);
            }

            $rowNo++;
        }

        $filename = 'Enquiries_By_Type_' . date('d-M-Y') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }


    public function download_sales_pdf($region) 
    {
        $region = urldecode($region);
        $region_lower = strtolower($region);
        $location =  $this->input->post('location');
        $country =  $this->input->post('country');
        $state =  $this->input->post('state');
        $city =  $this->input->post('city');
        $date_from =  $this->input->post('date_from');
        $date_to =  $this->input->post('date_to');
        $quarter =  $this->input->post('quarter');
        $sales =  $this->input->post('sales');

        $data['locations'] = $this->locations;
        $where = 'e.is_deleted = 0';

        // Location abbreviation
        $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];
        if ($location != '') {
            $location = trim($location);
            $abbrs = $data['locations'][$location];
        }
        $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
        $where .= " AND e.enquiry_abbr IN ($abbr_clause)";

        // Company
        if ($this->input->get('company_id') != '') {
            $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
        }

        // Dates
        if ($quarter != '') {
            $dates = explode('_', $quarter);
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        } elseif ($date_from != '' && $date_to != '') {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($date_from) . "' AND '" . trim($date_to) . "'";
        }

        // Country
        // if ($country != '') {
            $where .= " AND (LOWER(cd.state) = '" . $this->db->escape_str($region_lower) . "' 
               OR LOWER(cd.country) = '" . $this->db->escape_str($region_lower) . "')";
        // }

        // State
        // if ($state != '') {
        //     // Always apply region condition (state OR country)
        //     $where .= " AND (LOWER(cd.state) = '" . $this->db->escape_str($region_lower) . "' 
        //        OR LOWER(cd.country) = '" . $this->db->escape_str($region_lower) . "')";

        // }

        // City
        if ($city != '') {
            $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($city)))));
            $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
        }

        // Load mPDF
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        // Simplified SQL query using direct region match
        $sql = "
            SELECT 
                '" . $region_lower . "' AS region,
                COUNT(e.id) AS total_query,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_billing_dollar,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_num_persons
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
        ";

        $sqls = "
            SELECT 
                ? AS region,
                COUNT(e.id) AS total_query,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
                SUM(CASE 
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                    THEN a.client_billing 
                    ELSE 0 
                END) AS total_billing_dollar,
                SUM(CASE 
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                        THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                        THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                    ELSE 0 
                END) AS total_num_persons
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0 AND 
                (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
        ";

        $yearwiseReport = "
            SELECT 
                ? AS region,
                YEAR(e.check_in_date) AS year,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND e.check_in_date IS NOT NULL
                AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
            GROUP BY YEAR(e.check_in_date)
            ORDER BY YEAR(e.check_in_date)";

        
        $cityReport = $this->db->query("
            SELECT 
                LOWER(cd.city) AS city,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
            GROUP BY cd.city
            ORDER BY total_queries DESC
        ", [$region, $region])->result();

        $YearlyCitywiseData = 
        $this->db->query("
        SELECT 
            LOWER(cd.city) AS city,
            YEAR(e.check_in_date) AS year,
            
            COUNT(e.id) AS total_queries,
            SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
            SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
            
            SUM(CASE 
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                THEN a.client_billing 
                ELSE 0 
            END) AS total_revenue,

            SUM(CASE 
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                    THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                    THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                ELSE 0 
            END) AS total_pax

        FROM enquiry e
        LEFT JOIN arrivals a ON a.enquiry_id = e.id
        LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

        WHERE 
            e.is_deleted = 0
            AND e.check_in_date IS NOT NULL
            AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)

        GROUP BY year, cd.city
        ORDER BY year DESC, total_queries DESC", [$region, $region])->result();

        // Run the query with parameters (region label, match state, match country)
        $result = $this->db->query($sql)->row();
        // echo $this->db->last_query();
       
        $results = $this->db->query($sqls, [$region_lower, $region_lower, $region_lower])->row();
        $yearlydata = $this->db->query($yearwiseReport, [$region_lower, $region_lower, $region_lower])->result();
        
        $filtersApplied = (!empty($location) || !empty($country) || !empty($state) || 
                    !empty($city) || !empty($date_from) || !empty($date_to) || 
                    !empty($quarter) || !empty($sales));

        if($filtersApplied){
            $html = $this->load->view('admin/sales_report_pdf', [
                'report' => $result,
                'city_report' => [],
                'yearlyreport' => [],
                'yearlycitywisedata' => []
            ], true);
            
            log_user_activity(
            'Sales report pdf without filter Download',
            $this->session->userdata('id'),
            'sales report pdf Download: ' . json_encode($filtersApplied)
            );
        }else{
            $html = $this->load->view('admin/sales_report_pdf', [
                'report' => $results,
                'city_report' => $cityReport,
                'yearlyreport' => $yearlydata,
                'yearlycitywisedata' => $YearlyCitywiseData
            ], true);
            
            log_user_activity(
            'Sales report pdf without filter Download',
            $this->session->userdata('id'),
            'sales report pdf Download: ' . json_encode($filtersApplied)
            );
        }

        // Load view and pass the result
        

        // Generate PDF
        $mpdf->WriteHTML($html);
        $mpdf->Output($result->region . '_Sales_Report.pdf', 'D');
    }


    public function download_sales_pdf1($region) 
    {
        $region = urldecode($region);
        $region_lower = strtolower($region);
        $location =  $this->input->post('location');
        $country =  $this->input->post('country');
        $state =  $this->input->post('state');
        $city =  $this->input->post('city');
        $date_from =  $this->input->post('date_from');
        $date_to =  $this->input->post('date_to');
        $quarter =  $this->input->post('quarter');
        $sales =  $this->input->post('sales');

        $data['locations'] = $this->locations;
        $where = 'e.is_deleted = 0';

        // Location abbreviation
        $abbrs = ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR', 'GAR', 'IAR','FUZ','GUZ','IUZ'];
        if ($location != '') {
            $location = trim($location);
            $abbrs = $data['locations'][$location];
        }
        $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
        $where .= " AND e.enquiry_abbr IN ($abbr_clause)";

        // Company
        if ($this->input->get('company_id') != '') {
            $where .= " AND e.company_id = '" . trim($this->input->get('company_id')) . "'";
        }

        // Dates
        if ($quarter != '') {
            $dates = explode('_', $quarter);
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($dates[0]) . "' AND '" . trim($dates[1]) . "'";
        } elseif ($date_from != '' && $date_to != '') {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . trim($date_from) . "' AND '" . trim($date_to) . "'";
        }

        $where .= " AND (LOWER(cd.state) = '" . $this->db->escape_str($region_lower) . "' 
            OR LOWER(cd.country) = '" . $this->db->escape_str($region_lower) . "')";

        // City
        if ($city != '') {
            $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($city)))));
            $where .= " AND LOWER(cd.city) IN ('" . implode("','", $cities) . "')";
        }

        // Load mPDF
        // require_once FCPATH . 'vendor/autoload.php';
        // $mpdf = new \Mpdf\Mpdf();

        // Simplified SQL query using direct region match
        $sql = "
            SELECT 
                '" . $region_lower . "' AS region,
                COUNT(e.id) AS total_query,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_billing_dollar,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_num_persons
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
        ";

        $sqls = "
            SELECT 
                ? AS region,
                COUNT(e.id) AS total_query,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
                SUM(CASE 
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                    THEN a.client_billing 
                    ELSE 0 
                END) AS total_billing_dollar,
                SUM(CASE 
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                        THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                    WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                        THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                    ELSE 0 
                END) AS total_num_persons
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0 AND 
                (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
        ";

        $yearwiseReport = "
            SELECT 
                ? AS region,
                YEAR(e.check_in_date) AS year,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND e.check_in_date IS NOT NULL
                AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
            GROUP BY YEAR(e.check_in_date)
            ORDER BY YEAR(e.check_in_date)";

        
        $cityReport = $this->db->query("
            SELECT 
                LOWER(cd.city) AS city,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE 
                e.is_deleted = 0
                AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)
            GROUP BY cd.city
            ORDER BY total_queries DESC
        ", [$region, $region])->result();

        $YearlyCitywiseData = 
        $this->db->query("
        SELECT 
            LOWER(cd.city) AS city,
            YEAR(e.check_in_date) AS year,
            
            COUNT(e.id) AS total_queries,
            SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
            SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
            
            SUM(CASE 
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.currency = 'dollar' 
                THEN a.client_billing 
                ELSE 0 
            END) AS total_revenue,

            SUM(CASE 
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number != 0 
                    THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                WHEN a.status IN ('complete','file-closed','in-progress') AND a.split_number = 0 
                    THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                ELSE 0 
            END) AS total_pax

        FROM enquiry e
        LEFT JOIN arrivals a ON a.enquiry_id = e.id
        LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

        WHERE 
            e.is_deleted = 0
            AND e.check_in_date IS NOT NULL
            AND (LOWER(cd.state) = ? OR LOWER(cd.country) = ?)

        GROUP BY year, cd.city
        ORDER BY year DESC, total_queries DESC", [$region, $region])->result();

        // Run the query with parameters (region label, match state, match country)
        $result = $this->db->query($sql)->row();
        // echo $this->db->last_query();
       
        $results = $this->db->query($sqls, [$region_lower, $region_lower, $region_lower])->row();
        $yearlydata = $this->db->query($yearwiseReport, [$region_lower, $region_lower, $region_lower])->result();
        
        $filtersApplied = (!empty($location) || !empty($country) || !empty($state) || 
                    !empty($city) || !empty($date_from) || !empty($date_to) || 
                    !empty($quarter) || !empty($sales));

        $filter_data = [
            'location' => $location,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'quarter' => $quarter,
            'sales' => $sales,
        ];

        if($filtersApplied){
            $html = [
                'filter' => $filter_data,
                'report' => $result,
                'city_report' => [],
                'yearlyreport' => [],
                'yearlycitywisedata' => []
            ];
            log_user_activity(
                'Sales report pdf filter',
                $this->session->userdata('id'),
                'sales report pdf: ' . json_encode($filter_data)
            );
            $this->load->view('admin/sales_report_pdf1', $html);
        }else{
             $html = [
                'filter' => $filter_data,
                'report' => $results,
                'city_report' => $cityReport,
                'yearlyreport' => $yearlydata,
                'yearlycitywisedata' => $YearlyCitywiseData
            ];
            log_user_activity(
            'Sales report pdf Without filter',
            $this->session->userdata('id'),
            'sales report pdf: ' . json_encode($filter_data)
            );
            $this->load->view('admin/sales_report_pdf1', $html);
        }

    }

}