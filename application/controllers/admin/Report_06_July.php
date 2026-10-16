<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ'],
        'georgia' => ['FGE', 'GGE', 'IGE'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE']
    ];
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('login');
        // }
        /*
        if($this->session->userdata('type') != 1){
        redirect($_SERVER['HTTP_REFERER']);	    
        } */
        $allowed_users = ['1', '3'];
        // if (!in_array($this->session->userdata('type'), $allowed_users)) {
        //     $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
        //     redirect('dashboard');
        // }

        $this->load->model(['admin/group_model', 'common_model', 'admin/user_model', 'admin/report_model', 'admin/dashboard_model', 'admin/company_model']);
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
            if ($this->session->userdata('type') != 1 && $data['client']->user_id != $this->session->userdata('id')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
                redirect('clients');
            }
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            $this->load->view('admin/edit_client', $data);
        } else {
            $data['clients'] = $this->report_model->update_client();
        }

    }

    public function edit_company()
    {

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
        $this->form_validation->set_rules('gst', 'GST', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/edit_company', $data);
        } else {
            $id = $this->input->post('id');
            $update_arr = ['name' => $this->input->post('name'), 'country' => $this->input->post('country'), 'state' => $this->input->post('state'), 'city' => $this->input->post('city'), 'address' => $this->input->post('address'), 'gstin' => $this->input->post('gst')];
            $update_data = ['table_name' => 'company', 'update_data' => $update_arr, 'condition' => ['id' => $id]];

            $updated = $this->common_model->update_data_limit($update_data);



            if (!$updated) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($company_id . '/edit-company');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
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
        $this->load->view('admin/pending_enquiry', $data);
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
        $this->load->view('admin/agentwise_report', $data);
    }

    //march 28

    public function enquiry_report()
    {

        $data['locations'] = $this->locations;

        // $result_cnt = $this->report_model->count_all_enquiry($name,$agent,$contact,$email,$city,$state,$country,$designation);
        $result_cnt = $this->report_model->count_all_enquiry($data['locations']);
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
        $data['offset'] = $offset;
        // $data['enquiry'] = $this->report_model->count_enquiry_report($name,$agent,$contact,$email,$city,$state,$country,$designation);
        $data['enquiry'] = $this->report_model->all_enquiry_report($config["per_page"], $offset, $data['locations']);
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        // echo "<pre>";
        // print_r($data['enquiry']);
        // exit;
        $this->load->view('admin/enquiry_report', $data);
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
        $this->load->view('admin/arrivals_report', $data);
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

        if ($query_string) {

            $result = $this->report_model->count_all_reports($data['locations']);

            $data['total_files'] = $result['total_files'];
            $data['progress_files'] = $result['in_progress_files'];
            $data['confirm_files'] = $result['confirm_files'];
            $data['cancelled_files'] = $result['cancelled_files'];
            $data['closed_files'] = $result['closed_files'];

            $result_cnt = $result['row_count'];
            $filter_count = $result['filter_count'];
        }
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
            $data['enquiry'] = $this->report_model->all_report_data($config["per_page"], $offset, $data['locations']);
        } else {
            $data['enquiry'] = [];
        }
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        $data['filter_count'] = $filter_count;

        $select = 'admin.*';
        $where = 'admin.type = "5"';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);

        $this->load->view('admin/monitoring_report', $data);
    }

    // public function itinerary_report()
    // {
    //     $data['locations'] = $this->locations;
    //     $select = 'DISTINCT enquiry.number_of_nights';
    //     $data['nights'] = $this->common_model->get_data('enquiry', '', '', $select, '', '', $count = false);

    //     $this->db->select('enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.number_persons,enquiry.number_child,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,arrivals.group_type,itinerary.content,itinerary.arrival_id');
    //     $this->db->from('itinerary');
    //     $this->db->join('arrivals', 'arrivals.id = itinerary.arrival_id');
    //     $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id');
    //     $this->db->where('itinerary.status !=', 'deleted');

    //     if ($this->input->get('no_of_nights') <> '') {
    //         $this->db->where('enquiry.number_of_nights', urldecode($this->input->get('no_of_nights')));
    //     }
    //     if ($this->input->get('location') <> '') {
    //         $loc = $this->locations[$this->input->get('location')];
    //         $this->db->where_in('enquiry.enquiry_abbr', $loc);
    //     }

    //     $this->db->group_by('itinerary.arrival_id');
    //     $this->db->order_by('itinerary.id', 'DESC');


    //     $query = $this->db->get();

    //     $data['result'] = $query->result();

    //     $this->load->view('admin/itinerary_report', $data);
    // }

    // public function print_itinerary_view()
    // {

    //     if ($this->input->get('arrival_id') == '' || !is_numeric(base64_decode($this->input->get('arrival_id')))) {
    //         redirect('arrivals');
    //     }
    //     $arrival_id = base64_decode($this->input->get('arrival_id'));

    //     $select = 'enquiry.*';
    //     $where = 'itinerary.arrival_id= ' . $arrival_id . ' AND itinerary.status != "deleted"';
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.id = itinerary.arrival_id'],
    //         ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id']
    //     ];
    //     $data['data'] = $this->common_model->get_data('itinerary', '', '', $select, $where, '', $count = false, $join);


    //     $where = 'itinerary.arrival_id= ' . $arrival_id . ' AND itinerary.status != "deleted"';
    //     $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, ' ORDER BY itinerary.date,itinerary.time ASC', $count = false);

    //     if ($this->input->get('print') == 'pdf') {
    //         $this->load->view('admin/print_itinerary_report_pdf', $data);
    //     } else {
    //         $this->load->view('admin/print_itinerary_view', $data);
    //     }
    // }


    public function itinerary_report()
    {
        $data['locations'] = $this->locations;
        $select = 'DISTINCT enquiry.number_of_nights';
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],];
        $data['nights'] = $this->common_model->get_data('enquiry', '', '', $select, '', '', $count = false, $join);

        $this->db->select('enquiry.enquiry_abbr,enquiry.number_of_nights,itinerary.arrival_id');
        $this->db->select('GROUP_CONCAT(DISTINCT itinerary.title ORDER BY itinerary.date, itinerary.time ) AS title');
        $this->db->from('itinerary');
        $this->db->join('arrivals', 'arrivals.id = itinerary.arrival_id');
        $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id');
        $this->db->where('itinerary.status !=', 'deleted');
        $this->db->where('itinerary.date >=', '2024-04-01');
        //echo '<pre>';print_r($this->input->get('title'));exit;
        if ($this->input->get('no_of_nights') <> '') {
            $this->db->where('enquiry.number_of_nights', urldecode($this->input->get('no_of_nights')));
        }
        if ($this->input->get('location') <> '') {
            //$loc = $this->locations[$this->input->get('location')];
            //$this->db->where_in('enquiry.enquiry_abbr', $loc);
        }

        if (!empty($this->input->get('title'))) {
            foreach ($this->input->get('title') as $list) {
                $title_array1[] = str_replace(['%26', '%2F', '%3A', '%27'], ['&', '/', ':', '&#39;'], rawurlencode($list)) . '%0A';
                $title_array2[] = str_replace(['%26', '%2F', '%3A', '%27'], ['&', '/', ':', '&#39;'], rawurlencode('<strong>' . $list . '</strong>') . '%0A');
            }

            $this->db->group_start();
            $this->db->where_in('itinerary.title', $title_array1);
            $this->db->or_where_in('itinerary.title', $title_array2);
            $this->db->group_end();
        }

        $this->db->group_by('itinerary.arrival_id');
        $this->db->order_by('itinerary.id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $data['result'] = $query->result();

        $select = 'DISTINCT sites.site_name';
        $where = 'sites.category IN ("sitescene","activity","night-life")';
        $sites_names = $this->common_model->get_data('sites', '', '', $select, $where, '', $count = false);
        foreach ($sites_names as $list) {
            $sites_title[] = $list->site_name;
        }
        $data['sites_names'] = $sites_title;
        // echo '<pre>';print_r($data['sites_names']);exit;
        $this->load->view('admin/itinerary_report', $data);
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

        // echo "<pre>";
        // print_r($data['itinerary']);
        // exit;

        if ($this->input->get('print') == 'pdf') {
            $this->load->view('admin/print_itinerary_report_pdf', $data);
        } else {
            $this->load->view('admin/print_itinerary_view', $data);
        }
    }

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
        if ($this->session->userdata('type') != 1 && $data['client']->user_id != $this->session->userdata('id')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Not Allowed. Permission Denied!</div>');
            redirect('clients');
        }
        if ($this->input->post('submit') <> '') {
            $filename = '';
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
                    redirect(base_url($data['client']->company_id . '/edit-client-logo'));
                } else {
                    $file = $this->upload->data();
                    $filename = $file['file_name'];
                    $data = array(
                        //'name' => ucwords(strtolower($this->input->post('name'))),
                        'company_logo' => $filename
                    );
                    $this->db->where('company_id', $this->input->post('company_id'));
                    $this->db->update('company', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                    redirect('clients');
                }
            }
        }
        $this->load->view('admin/edit_client_logo', $data);
    }

    public function get_site_titles()
    {
        $country = $this->input->post('country');
        $select = 'DISTINCT sites.site_name';
        $where = 'sites.country = "' . $country . '"';
        $sites_names = $this->common_model->get_data('sites', '', '', $select, $where, '', $count = false);
        $response = ['response' => 's', 'details' => $sites_names, 'msg' => ''];
        echo json_encode($response);
        exit;
    }

    public function vendor_report()
    {
        $data['locations'] = $this->locations;

        if ($this->input->get('location') <> '') {
            $location = trim($this->input->get('location'));
        }
        $where1 = '';
        if ($this->input->get('hotel') <> '' && is_numeric($this->input->get('hotel'))) {
            $id = trim($this->input->get('hotel'));
            $where1 = ' AND hotels.id=' . $id;
        }
        $where2 = '';
        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $where2 = ' AND (date(arrival_room_details.checkin_date) >="' . trim($this->input->get('date_from')) . '" AND date(arrival_room_details.checkout_date) <="' . trim($this->input->get('date_to')) . '")';
        }
        $data['links'] = '';
        $data['total'] = 0;
        if ($this->input->get('submit') <> '') {

            $query = 'SELECT hotels.id,hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country, GROUP_CONCAT(CONCAT(arrival_room_details.checkin_date," to ",arrival_room_details.checkout_date) SEPARATOR " , ") AS check_dates, count(arrival_room_details.id) AS room_counts FROM arrival_room_details LEFT JOIN `hotels` ON arrival_room_details.hotel_id = hotels.id WHERE LOWER(hotels.country) = "' . $location . '" ' . $where1 . ' AND hotels.status="active" AND arrival_room_details.hotel_confirmation_num != "" ' . $where2 . ' GROUP BY arrival_room_details.hotel_id';

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

            $query = 'SELECT hotels.id,hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country, GROUP_CONCAT(CONCAT(arrival_room_details.checkin_date," to ",arrival_room_details.checkout_date,"__",arrival_room_details.number_of_rooms) SEPARATOR " , ") AS check_dates,
            arrival_room_details.hotel_id, count(arrival_room_details.id) AS room_counts FROM arrival_room_details LEFT JOIN `hotels` ON arrival_room_details.hotel_id = hotels.id WHERE LOWER(hotels.country) = "' . $location . '" ' . $where1 . ' AND hotels.status="active" AND arrival_room_details.hotel_confirmation_num != "" ' . $where2 . ' GROUP BY arrival_room_details.hotel_id LIMIT ' . $offset . ', ' . $config["per_page"];

            $data['vendor_report'] = $this->common_model->custom_query($query);
            //echo '<pre>';print_r($data['vendor_report']);exit;
            $data['links'] = $this->pagination->create_links();
            $data['total'] = $total_rows;
        }
        $this->load->view('admin/vendor_report', $data);
    }

    public function get_hotels()
    {
        $location = $this->input->post('location');
        $where = 'LOWER(hotels.country) = "' . strtolower($location) . '"';
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

    public function revenue_report()
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
        }
        $select = 'admin.*';
        $where = 'admin.type = "5"';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        $this->load->view('admin/revenue_report', $data);
    }

    public function restaurant_report()
    {

        $data['country'] = ['label' => '', 'country_id' => ''];
        if ($this->session->userdata('locations') != 'all') {
            $data['country'] = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))])[0];
        }

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'restaurant-report?' . $search[0];

        $where = ' restaurants.status = "active"';
        if ($this->input->get('country') <> '') {
            $where .= ' AND restaurants.country = "' . trim($this->input->get('country')) . '"';
        }
        if ($this->input->get('city') <> '') {
            $where .= ' AND restaurants.city = "' . trim($this->input->get('city')) . '"';
        }
        if ($this->input->get('specility') <> '') {
            $where .= ' AND restaurants.cuisine = "' . trim($this->input->get('specility')) . '"';
        }

        $config["total_rows"] = $this->common_model->get_data('restaurants', '', '', 'restaurants.id', $where, '', $count = true, '');
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
        $data['result'] = $this->common_model->get_data('restaurants', $offset, $config["per_page"], '*', $where, ' ORDER BY restaurants.id DESC', $count = false, '');
        $data['links'] = $this->pagination->create_links();
        $this->load->view('admin/restaurant_report', $data);
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
            $this->load->view('admin/print_restaurant_details_pdf', $data);
        } else {
            $this->load->view('admin/print_restaurant_details', $data);
        }
    }

    public function get_country_name_ajax()
    {
        $this->db->select('*');
        // Select record
        $this->db->where_in("id", [15, 20, 81, 112]);
        //$this->db->limit(10);
        $records = $this->db->get('countries')->result();
        echo json_encode(['response' => 'success', 'details' => $records]);
    }

    public function live_tracking()
    {
        $this->load->view('admin/live_tracking');
    }
 
    public function live_tracking_files()
    {
        $this->load->view('admin/live_tracking_files');
    }

    
    public function date_based_files()
    {
        $date = $this->uri->segment(2);
        $select = "enquiry.id,enquiry.enquiry_no,enquiry.enquiry_abbr";
    
        $location = $this->session->userdata('locations');
        $location_condition = "";
    
        if ($location == 'kazakhstan') {
            $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'KZ'";
        } elseif ($location == 'azerbaijan') {
            $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'AZ'";
        } elseif ($location == 'belarus') {
            $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'BZ'";
        } elseif ($location == 'georgia') {
            $location_condition = "SUBSTRING(enquiry.enquiry_abbr, 2) = 'GE'";
        }
    
        $where = "enquiry.status != 'cancel-at-arrival' 
        AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
        AND '$date' BETWEEN enquiry.check_in_date AND enquiry.check_out_date";
    
        if (!empty($location_condition)) {
            $where .= " AND $location_condition";
        }
    
        $join = [
            ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.enquiry_id = enquiry.id'],
        ];
    
        $data = $this->common_model->get_data('enquiry', '', '', $select, $where, '', $count = false, $join);
    
        // Initialize an array to store counts
        $enquiryAbbrCounts = [];
    
        // Count occurrences of each enquiry_abbr
        foreach ($data as $item) {
            $enquiryAbbr = substr($item->enquiry_abbr, 1);
            if (isset($enquiryAbbrCounts[$enquiryAbbr])) {
                $enquiryAbbrCounts[$enquiryAbbr]++;
            } else {
                $enquiryAbbrCounts[$enquiryAbbr] = 1;
            }
        }
    
        echo json_encode(['response' => 'success', 'details' => $enquiryAbbrCounts]);
    }
    
    public function live_tracking_all_files($date, $enq_abbr)
    {
        $date = $this->db->escape($date);
        $enq_abbr = $this->db->escape($enq_abbr);
        
        $select = "arrivals.*, arrivals.guide_id as g_id, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.check_in_date, enquiry.check_out_date, guides.name as n, 
        arrival_hotel_details.hotel_name, company.name AS filename";
        
        $subquery = "(SELECT * FROM arrival_hotel_details ahd1 WHERE ahd1.id = (SELECT MAX(ahd2.id) FROM arrival_hotel_details ahd2 WHERE ahd2.enquiry_id = ahd1.enquiry_id)) as arrival_hotel_details";
        
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
            ['type' => 'LEFT', 'join_table' => $subquery, 'condition' => 'arrival_hotel_details.enquiry_id = arrivals.enquiry_id'],
        ];
        
        $where = "enquiry.status != 'cancel-at-arrival' 
            AND arrivals.status IN ('complete', 'file-closed', 'in-progress') 
            AND enquiry.check_in_date <= $date AND enquiry.check_out_date >= $date
            AND SUBSTRING(enquiry.enquiry_abbr, 2) = $enq_abbr";
        
        $data['arrivals'] = $this->common_model->get_data('arrivals', '', '', $select, $where, '', false, $join);
    
        if (!empty($data['arrivals'])) {
            $enquiryIds = array_map(function($arrival) {
                return $arrival->enquiry_id;
            }, $data['arrivals']);
            $enquiryIds = implode(',', $enquiryIds);
        
            $whereFlights = "arrival_flight_details.enquiry_id IN ($enquiryIds)";
            $orderByFlights = 'ORDER BY arrival_flight_details.departure_date, arrival_flight_details.departure_time ASC';
            $joinFlights = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id']];
            $selectFlights = 'arrival_flight_details.*,arrival_flight_details.arrival_date as flight_arrival_date, airlines.name as airline_name';
        
            $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $selectFlights, $whereFlights, $orderByFlights, false, $joinFlights);
        }
                            
        // Check if there are multiple arrivals with g_id = 0
        if (!empty($data['arrivals'])) {
            $guideNames = [];
            $flightDetails = [];
    
            foreach ($data['arrivals'] as $arrival) {
                if ($arrival->g_id == 0) {
                    $selectGuide = "guides.name";
                    $joinGuide = [
                        ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],
                    ];
                    $whereGuide = "enquiry_guide.enquiry_id = {$arrival->enquiry_id}";
    
                    $guides = $this->common_model->get_data('enquiry_guide', '', '', $selectGuide, $whereGuide, '', false, $joinGuide);
    
                    if (!empty($guides)) {
                        foreach ($guides as $guide) {
                            // Store guide names indexed by enquiry_id
                            $guideNames[$arrival->enquiry_id][] = $guide->name;
                        }
                    }
                }
    
                // Fetch flight details for each arrival
                if (!empty($data['arrival_flight'])) {
                    foreach ($data['arrival_flight'] as $flight) {
                        if ($flight->enquiry_id == $arrival->enquiry_id) {
                            // Store flight details indexed by enquiry_id
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
    
            $data['guide_names'] = $guideNames;
            $data['flight_details'] = $flightDetails;
        }
    
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

        $where = 'arrival_flight_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
        $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
        $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);

        $where = 'itinerary.arrival_id= ' . $id . ' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, 'Order By itinerary.date', $count = false, '');

        $this->load->view('admin/activity_logs', $data);
    }

    public function booking_room_details_data(){

        $hotel_id = urldecode($this->input->get('hotelId'));

        $select = 'arrival_room_details.*,hotels.name,enquiry.enquiry_no';
        $where = 'arrival_room_details.hotel_id='.$hotel_id;
        $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                 ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_room_details.enquiry_id']];
        $data['arrival_room_details'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where,'',$count = false,$join);

        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }


}