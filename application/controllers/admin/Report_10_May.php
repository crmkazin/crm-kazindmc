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
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        /*
        if($this->session->userdata('type') != 1){
        redirect($_SERVER['HTTP_REFERER']);	    
        } */
        $allowed_users = ['1', '3', '5'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }

        $this->load->model(['admin/group_model', 'common_model', 'admin/user_model', 'admin/report_model', 'admin/dashboard_model']);
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
        $query_string = $_SERVER['QUERY_STRING'];

        $data['locations'] = $this->locations;

        if ($query_string) {
            $result_cnt = $this->report_model->count_all_reports($data['locations']);
        } else {
            $result_cnt = 0;
        }

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'monitoring-report?' . $search[0];

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

        if ($query_string) {
            $data['enquiry'] = $this->report_model->all_report_data($config["per_page"], $offset, $data['locations']);
        } else {
            $data['enquiry'] = [];
        }
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        $this->load->view('admin/monitoring_report', $data);
    }
    
    public function itinerary_report()
    {
        $data['locations'] = $this->locations;
        $select = 'DISTINCT enquiry.number_of_nights';
        $data['nights'] = $this->common_model->get_data('enquiry', '', '', $select, '', '', $count = false);

        $this->db->select('enquiry.enquiry_no,enquiry.number_persons,enquiry.number_child,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,arrivals.group_type,itinerary.content,itinerary.arrival_id');
        $this->db->from('itinerary');
        $this->db->join('arrivals', 'arrivals.id = itinerary.arrival_id');
        $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id');
        $this->db->where('itinerary.status !=', 'deleted');

        if ($this->input->get('no_of_nights') <> '') {
            $this->db->where('enquiry.number_of_nights', urldecode($this->input->get('no_of_nights')));
        }
        if ($this->input->get('location') <> '') {
            $loc = $this->locations[$this->input->get('location')];
            $this->db->where_in('enquiry.enquiry_abbr', $loc);
        }


        $this->db->group_by('itinerary.arrival_id');
        $this->db->order_by('itinerary.id', 'DESC');


        $query = $this->db->get();

        $data['result'] = $query->result();
        $this->load->view('admin/itinerary_report', $data);
    }
    
        public function get_agent_ajax($id)
    {
        $company_id = $this->uri->segment(2);
        $escaped_company_id = $this->db->escape($company_id);
        $where = "company_details.company = $escaped_company_id";
        $data = $this->common_model->get_data('company_details', '', '', '*', $where, '', $count = false);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

    public function get_sales_ajax()
    {
        $where = "admin.type = 5";
        $data = $this->common_model->get_data('admin', '', '', '*', $where, '', $count = false);
        echo json_encode(['response' => 'success', 'details' => $data, 'msg' => '']);
    }

}