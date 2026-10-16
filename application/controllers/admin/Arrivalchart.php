<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arrivalchart extends CI_Controller
{

    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ','CMB'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ','CMB'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ','CMB'],
        'georgia' => ['FGE', 'GGE', 'IGE','CMB'],
        'armenia' => ['FAR','GAR','IAR','CMB'],
        'uzbekistan' => ['FUZ','GUZ','IUZ','CMB'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']
    ];
    
    var $locations_new = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ','CMB'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ','CMB'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ','CMB'],
        'georgia' => ['FGE', 'GGE', 'IGE','CMB'],
        'armenia' => ['FAR','GAR','IAR','CMB'],
        'uzbekistan' => ['FUZ','GUZ','IUZ','CMB'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']
    ];
    
    var $allowed_users = ['1', '2', '3'];
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model', 'common_model', 'admin/company_model', 'admin/user_model', 'admin/dashboard_model', 'admin/restaurantmenumaster_model']);
        $this->load->library('pagination');
    }

    // 12-11-2025 previous
    // public function index()
    // {
    //     $data['locations'] = $this->locations;
    //     // print_r($data['locations']);
    //     // die;
    //     $data['counts'] = $this->dashboard_model->arrival_status_count();
    //     $where = '';
    //     //echo '<pre>';print_r($this->session->userdata);exit;
    //     if ($this->session->userdata('type') == 2) {
    //         //$where = 'arrivals.added_by='.$this->session->userdata('id');
    //     }

    //     if ( empty($this->input->get('submit')) &&
    //         empty($this->input->get('query_number')) &&
    //         empty($this->input->get('date_from')) &&
    //         empty($this->input->get('date_to')) &&
    //         empty($this->input->get('status')) &&
    //         empty($this->input->get('staff_id')) &&
    //         empty($this->input->get('booking_type')) &&
    //         empty($this->input->get('company_id')) &&
    //         empty($this->input->get('country')) &&
    //         empty($this->input->get('confirm_cnt'))
    //     ) {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
    //     }



    //     // if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(enquiry.check_in_date) >="' . $this->input->get('date_from') . '" AND date(enquiry.check_in_date) <="' . $this->input->get('date_to') . '"';
    //     // }
    //     // if ($this->input->get('from') <> '' && $this->input->get('to') <> '') {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(enquiry.query_received_date) >="' . $this->input->get('from') . '" AND date(enquiry.query_received_date) <="' . $this->input->get('to') . '"';
    //     // }
    //     if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         // $where .= $where_and . '(
    //         //     (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //         //     OR
    //         //     (enquiry.split_count != 0 AND DATE(arrival_hotel_details.checkin_date) >= "' . $this->input->get('date_from') . '" AND DATE(arrival_hotel_details.checkin_date) <= "' . $this->input->get('date_to') . '")
    //         // )';
    //         $where .= $where_and . '(
    //                 (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //                 OR
    //                 (enquiry.split_count != 0 AND (
    //                     SELECT DATE(MIN(ahd.checkin_date))
    //                     FROM arrival_hotel_details ahd
    //                     WHERE ahd.arrival_id = arrivals.id
    //                 ) >= "' . $this->input->get('date_from') . '" 
    //                 AND (
    //                     SELECT DATE(MIN(ahd.checkin_date))
    //                     FROM arrival_hotel_details ahd
    //                     WHERE ahd.arrival_id = arrivals.id
    //                 ) <= "' . $this->input->get('date_to') . '")
    //             )';
    //     }
  
    //     if ($this->input->get('status') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
    //     }
    //     if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
    //     }
    //     if (!empty($this->input->get('booking_type'))) {
    //         $booking_type = urldecode($this->input->get('booking_type'));
    //         if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
    //             $loc = implode('","', $this->locations[$this->input->get('location')]);
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $loc . '")';
    //             //$this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
    //         } else if ($booking_type != 'all') {
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . 'enquiry.enquiry_abbr = "' . $booking_type . '"';
    //             //$this->db->where('enquiry.enquiry_abbr',$booking_type);
    //         }
    //     }

    //     if ($this->input->get('company_id') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
    //     }

    //     if ($this->session->userdata('admin_type') != 'superadmin' && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com', 'combo1@kazindmc.com']) && $this->session->userdata('type') != '3') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //       // $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
    //         $session_locations = explode(',', $this->session->userdata('locations'));
    //         $all_locations = [];
    //         foreach ($session_locations as $loc) {
    //             if (isset($this->locations[$loc])) {
    //                 $all_locations = array_merge($all_locations, $this->locations[$loc]);
    //             }
    //         }
    //         $assigned_loc = implode('","', $all_locations);
    //         $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
    //     }

    //     $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
    //     //if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //     //    $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "' . urldecode($this->input->get('country')) . '"';
    //     //}
    //     if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //         $country = $this->input->get('country');
    //         if(strlen($country) > 1){
    //             $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia'    => 'GE', 'Belarus'    => 'BE', 'Armenia'    => 'AR', 'Uzbekistan'    => 'UZ'];
    //             $abbr = $countryMapping[$country];
    //         }else{ $abbr = $country; }
    //         $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '"';
    //     }

    //     if ($this->input->get('query_number') <> '') {
    //         $enquiry_join .= ' AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '"';
    //     }

    //     if(!empty($this->input->get('confirm_cnt'))){
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and .' date(arrivals.created) = "' . date('Y-m-d') . '"';
    //     }

    //     $Search_data = [
    //         'query_number'         => $this->input->get('query_number'),
    //         'country'         =>$this->input->get('country'),
    //         'booking_type'         => $this->input->get('booking_type'),
    //         'location'         => $this->input->get('location'),
    //         'staff_id'         => $this->input->get('staff_id'),
    //         'status'         => $this->input->get('status'),
    //         'date_from'         => $this->input->get('date_from'),
    //         'date_to'         => $this->input->get('date_to'),
    //         'confirm_cnt'         => $this->input->get('confirm_cnt'),
    //     ];
    //     if ($this->input->get('submit') <> '') {
    //         log_user_activity('Arrivals Chart Search',$this->session->userdata('id'), 'Search:'.json_encode($Search_data));
    //     }

    //     // $select = 'arrivals.*,transportation.vehicle_type,guides.name AS guide,enquiry.enquiry_no,enquiry.number_persons,enquiry.number_child,enquiry.number_of_nights,admin.name AS staff_name,company.name,arrival_hotel_details.hotel_name';
    //     $select = 'arrivals.*,arrivals.split_number AS split_num,transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights,enquiry.split_count, admin.name AS staff_name, company.name, hotel_sub.hotel_name,';
    //     $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';
    //     $hotel_subquery = "(SELECT arrival_id, MIN(hotel_name) AS hotel_name FROM arrival_hotel_details GROUP BY arrival_id) AS hotel_sub";
    //     $join = [
    //         ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
    //         ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
    //         ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
    //         //['type' => 'LEFT', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_hotel_details.enquiry_id = arrivals.enquiry_id'],
    //         ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
    //         // ['type' => 'LEFT', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_hotel_details.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => $hotel_subquery, 'condition' => 'hotel_sub.arrival_id = arrivals.id'],

    //     ];
    //     if($where == ''){
    //         $where = ' (1=1) ';
    //     }
    //     $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //     $config = array();
    //     $config["base_url"] = base_url() . 'arrivals/?' . $search[0];

    //     $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where.'GROUP BY arrivals.id, arrivals.enquiry_id', '', $count = true, $join);
    //     $data["total"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where.'GROUP BY arrivals.id, arrivals.enquiry_id', '', $count = true, $join);
    //     // echo '<pre>';
    //     // print_r($config["total_rows"]);
    //     // exit;
    //     //echo $this->db->last_query();exit;
    //     $config["per_page"] = 10;
    //     //$config["uri_segment"] = 2;
    //     $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //     $config['full_tag_close'] = '</ul>';
    //     //$config['first_link'] = True;
    //     //$config['last_link'] = True;
    //     //$config['first_link'] = 'First';
    //     //$config['last_link'] = 'Last';
    //     $config['first_tag_open'] = '<li class="page-item">';
    //     $config['first_tag_close'] = '</li>';
    //     $config['prev_link'] = 'Previous';
    //     //$config['prev_tag_open'] = '<li class="prev">';
    //     //$config['prev_tag_close'] = '</li>';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li class="page-item">';
    //     $config['next_tag_close'] = '</li>';
    //     $config['last_tag_open'] = '<li class="page-item">';
    //     $config['last_tag_close'] = '</li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><a style="color: #fff;" href="javascript:void(0);">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="page-item">';
    //     $config['num_tag_close'] = '</li>';
    //     $config['page_query_string'] = TRUE;
    //     //$config['reuse_query_string'] = TRUE;
    //     $this->pagination->initialize($config);
    //     $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //     $data['offset'] = $offset;
    //     $data['result'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' GROUP BY arrivals.id,arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
    //     //echo $this->db->last_query();exit;
    //     // echo $this->db->last_query(); exit;
    //     // echo '<pre>'; print_r($data['result']); exit;
    //     $data['links'] = $this->pagination->create_links();
    //     $data['content'] = 'admin/arrivals_list';
    //     $this->load->view('admin/layout', $data);
    // }
    
    // before 28 april 2026
    // public function index()
    // {
    //     $data['locations'] = $this->locations;
    //     $data['locations_new'] = $this->locations_new;
    //     $data['counts'] = $this->dashboard_model->arrival_status_count();
    //     $where = '';
        
    //     if ($this->session->userdata('type') == 2) {
    //         //$where = 'arrivals.added_by='.$this->session->userdata('id');
    //     }

    //     if ( empty($this->input->get('submit')) &&
    //         empty($this->input->get('query_number')) &&
    //         empty($this->input->get('date_from')) &&
    //         empty($this->input->get('date_to')) &&
    //         empty($this->input->get('status')) &&
    //         empty($this->input->get('staff_id')) &&
    //         empty($this->input->get('booking_type')) &&
    //         empty($this->input->get('company_id')) &&
    //         empty($this->input->get('country')) &&
    //         empty($this->input->get('confirm_cnt'))
    //     ) {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
    //     }

    //     // if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . '(
    //     //             (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //     //             OR
    //     //             (enquiry.split_count != 0 AND (
    //     //                 SELECT DATE(MIN(ahd.checkin_date))
    //     //                 FROM arrival_hotel_details ahd
    //     //                 WHERE ahd.arrival_id = arrivals.id
    //     //             ) >= "' . $this->input->get('date_from') . '" 
    //     //             AND (
    //     //                 SELECT DATE(MIN(ahd.checkin_date))
    //     //                 FROM arrival_hotel_details ahd
    //     //                 WHERE ahd.arrival_id = arrivals.id
    //     //             ) <= "' . $this->input->get('date_to') . '")
    //     //         )';
    //     // }
        
    //     if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . '(
    //                 CASE 
    //                     WHEN arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.check_in_date IS NOT NULL AND combo_enquiry.check_in_date != "" THEN 
    //                         (DATE(combo_enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(combo_enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //                     WHEN arrivals.combo_enquiry_id IS NOT NULL THEN 
    //                         ((
    //                             SELECT DATE(MIN(ahd.checkin_date))
    //                             FROM arrival_hotel_details ahd
    //                             WHERE ahd.arrival_id = arrivals.id
    //                         ) >= "' . $this->input->get('date_from') . '" 
    //                         AND (
    //                             SELECT DATE(MIN(ahd.checkin_date))
    //                             FROM arrival_hotel_details ahd
    //                             WHERE ahd.arrival_id = arrivals.id
    //                         ) <= "' . $this->input->get('date_to') . '")
    //                     WHEN arrivals.combo_enquiry_id IS NULL AND enquiry.split_count = 0 THEN 
    //                         (DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //                     ELSE 
    //                         ((
    //                             SELECT DATE(MIN(ahd.checkin_date))
    //                             FROM arrival_hotel_details ahd
    //                             WHERE ahd.arrival_id = arrivals.id
    //                         ) >= "' . $this->input->get('date_from') . '" 
    //                         AND (
    //                             SELECT DATE(MIN(ahd.checkin_date))
    //                             FROM arrival_hotel_details ahd
    //                             WHERE ahd.arrival_id = arrivals.id
    //                         ) <= "' . $this->input->get('date_to') . '")
    //                 END
    //             )';
    //     }
    
    //     if ($this->input->get('status') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
    //     }
        
    //     if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
    //     }
        
    //     if (!empty($this->input->get('booking_type'))) {
    //         $booking_type = urldecode($this->input->get('booking_type'));
    //         if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
    //             $loc = implode('","', $this->locations[$this->input->get('location')]);
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . '(
    //                 (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $loc . '"))
    //                 OR 
    //                 (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $loc . '"))
    //             )';
    //         } else if ($booking_type != 'all') {
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . '(
    //                 (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr = "' . $booking_type . '")
    //                 OR 
    //                 (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr = "' . $booking_type . '")
    //             )';
    //         }
    //     }

    //     if ($this->input->get('company_id') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
    //     }

    //     if ($this->session->userdata('admin_type') != 'superadmin' && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com', 'combo1@kazindmc.com']) && $this->session->userdata('type') != '3') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $session_locations = explode(',', $this->session->userdata('locations'));
    //         $all_locations = [];
    //         foreach ($session_locations as $loc) {
    //             if (isset($this->locations[$loc])) {
    //                 $all_locations = array_merge($all_locations, $this->locations[$loc]);
    //             }
    //         }
    //         $assigned_loc = implode('","', $all_locations);
    //         $where .= $where_and . '(
    //             (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
    //             OR 
    //             (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
    //         )';
    //     }

    //     // Update SELECT for combo enquiries - FIXED
    //     $select = 'arrivals.*, arrivals.split_number AS split_num, transportation.vehicle_type, guides.name AS guide, ';
    //     $select .= 'enquiry.enquiry_no, '; // Always show the actual enquiry number like CMB04
    //     $select .= 'CASE WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.enquiry_abbr ELSE enquiry.enquiry_abbr END AS enquiry_abbr, ';
    //     $select .= 'enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, enquiry.split_count, admin.name AS staff_name, company.name, hotel_sub.hotel_name,';
    //     $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

    //     $hotel_subquery = "(SELECT arrival_id, MIN(hotel_name) AS hotel_name FROM arrival_hotel_details GROUP BY arrival_id) AS hotel_sub";
        
    //     $join = [
    //         ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
    //         ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
    //         ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
    //         ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
    //         ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => $hotel_subquery, 'condition' => 'hotel_sub.arrival_id = arrivals.id'],
    //     ];

    //     // Handle country filter for both regular and combo enquiries
    //     // if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //     //     $country = $this->input->get('country');
    //     //     if(strlen($country) > 1){
    //     //         $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia' => 'GE', 'Belarus' => 'BE', 'Armenia' => 'AR', 'Uzbekistan' => 'UZ'];
    //     //         $abbr = $countryMapping[$country];
    //     //     } else { 
    //     //         $abbr = $country; 
    //     //     }
            
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . '(
    //     //         (arrivals.combo_enquiry_id IS NULL AND SUBSTR(enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '")
    //     //         OR 
    //     //         (arrivals.combo_enquiry_id IS NOT NULL AND SUBSTR(combo_enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '")
    //     //     )';
    //     // }
        
    //     // 28-11-2025 previous
    //     // Handle country filter for both regular and combo enquiries
    //     // if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //     //     $country = $this->input->get('country');
    //     //     if(strlen($country) > 1){
    //     //         $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia' => 'GE', 'Belarus' => 'BE', 'Armenia' => 'AR', 'Uzbekistan' => 'UZ'];
    //     //         $abbr = $countryMapping[$country];
    //     //     } else { 
    //     //         $abbr = $country; 
    //     //     }
            
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . '(
    //     //         (arrivals.combo_enquiry_id IS NULL AND SUBSTR(enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '")
    //     //         OR 
    //     //         (arrivals.combo_enquiry_id IS NOT NULL AND SUBSTR(combo_enquiry.enquiry_abbr, 1, 2) = "' . $abbr . '")
    //     //     )';
    //     // }

    //     // if(!empty($this->input->get('confirm_cnt'))){
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and .' date(arrivals.created) = "' . date('Y-m-d') . '"';
    //     // }
        
    //     // 28-11-2025 Updated
    //     // Handle country filter for both regular and combo enquiries
    //     if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //         $country = $this->input->get('country');

    //         if (strlen($country) > 1) {
    //             $countryMapping = [
    //                 'Azerbaijan' => 'AZ',
    //                 'Kazakhstan' => 'KZ',
    //                 'Georgia' => 'GE',
    //                 'Belarus' => 'BE',
    //                 'Armenia' => 'AR',
    //                 'Uzbekistan' => 'UZ'
    //             ];
    //             $abbr = $countryMapping[$country];
    //         } else {
    //             $abbr = $country;
    //         }

    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . '(
    //             (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr LIKE "%' . $abbr . '%")
    //             OR
    //             (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr LIKE "%' . $abbr . '%")
    //         )';
    //     }

    //     // Confirm count → filter today's arrivals
    //     if (!empty($this->input->get('confirm_cnt'))) {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . ' DATE(arrivals.created) = "' . date('Y-m-d') . '"';
    //     }
        
    //     // Handle query number filter for both regular and combo enquiries
    //     if ($this->input->get('query_number') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . '(
    //             (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
    //             OR 
    //             (arrivals.combo_enquiry_id IS NOT NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
    //         )';
    //     }

    //     $Search_data = [
    //         'query_number' => $this->input->get('query_number'),
    //         'country' => $this->input->get('country'),
    //         'booking_type' => $this->input->get('booking_type'),
    //         'location' => $this->input->get('location'),
    //         'staff_id' => $this->input->get('staff_id'),
    //         'status' => $this->input->get('status'),
    //         'date_from' => $this->input->get('date_from'),
    //         'date_to' => $this->input->get('date_to'),
    //         'confirm_cnt' => $this->input->get('confirm_cnt'),
    //     ];
        
    //     if ($this->input->get('submit') <> '') {
    //         log_user_activity('Arrivals Chart Search',$this->session->userdata('id'), 'Search:'.json_encode($Search_data));
    //     }

    //     if($where == ''){
    //         $where = ' (1=1) ';
    //     }
        
    //     $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
    //     $config = array();
    //     $config["base_url"] = base_url() . 'arrivals/?' . $search[0];

    //     $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where.' GROUP BY arrivals.id', '', $count = true, $join);
    //     $data["total"] = $config["total_rows"];
        
    //     $config["per_page"] = 10;
    //     $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
    //     $config['full_tag_close'] = '</ul>';
    //     $config['first_tag_open'] = '<li class="page-item">';
    //     $config['first_tag_close'] = '</li>';
    //     $config['prev_link'] = 'Previous';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li class="page-item">';
    //     $config['next_tag_close'] = '</li>';
    //     $config['last_tag_open'] = '<li class="page-item">';
    //     $config['last_tag_close'] = '</li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><a style="color: #fff;" href="javascript:void(0);">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="page-item">';
    //     $config['num_tag_close'] = '</li>';
    //     $config['page_query_string'] = TRUE;
        
    //     $this->pagination->initialize($config);
    //     $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    //     $data['offset'] = $offset;
        
    //     $data['result'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' GROUP BY arrivals.id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
        
    //     $data['links'] = $this->pagination->create_links();
    //     $data['content'] = 'admin/arrivals_list';
    //     $this->load->view('admin/layout', $data);
    // }
    
    //28 april 2026 - Updated with fixes for combo enquiries and country filter
    public function index()
    {
        $data['locations'] = $this->locations;
        $data['locations_new'] = $this->locations_new;
        $data['counts'] = $this->dashboard_model->arrival_status_count();
        $where = '';
        
        if ($this->session->userdata('type') == 2) {
            //$where = 'arrivals.added_by='.$this->session->userdata('id');
        }

        if (empty($this->input->get('submit')) &&
            empty($this->input->get('query_number')) &&
            empty($this->input->get('date_from')) &&
            empty($this->input->get('date_to')) &&
            empty($this->input->get('status')) &&
            empty($this->input->get('staff_id')) &&
            empty($this->input->get('booking_type')) &&
            empty($this->input->get('company_id')) &&
            empty($this->input->get('country')) &&
            empty($this->input->get('confirm_cnt'))
        ) {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
        }
        
        if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . '(
                    CASE 
                        WHEN arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.check_in_date IS NOT NULL AND combo_enquiry.check_in_date != "" THEN 
                            (DATE(combo_enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(combo_enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
                        WHEN arrivals.combo_enquiry_id IS NOT NULL THEN 
                            ((
                                SELECT DATE(MIN(ahd.checkin_date))
                                FROM arrival_hotel_details ahd
                                WHERE ahd.arrival_id = arrivals.id
                            ) >= "' . $this->input->get('date_from') . '" 
                            AND (
                                SELECT DATE(MIN(ahd.checkin_date))
                                FROM arrival_hotel_details ahd
                                WHERE ahd.arrival_id = arrivals.id
                            ) <= "' . $this->input->get('date_to') . '")
                        WHEN arrivals.combo_enquiry_id IS NULL AND enquiry.split_count = 0 THEN 
                            (DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
                        ELSE 
                            ((
                                SELECT DATE(MIN(ahd.checkin_date))
                                FROM arrival_hotel_details ahd
                                WHERE ahd.arrival_id = arrivals.id
                            ) >= "' . $this->input->get('date_from') . '" 
                            AND (
                                SELECT DATE(MIN(ahd.checkin_date))
                                FROM arrival_hotel_details ahd
                                WHERE ahd.arrival_id = arrivals.id
                            ) <= "' . $this->input->get('date_to') . '")
                    END
                )';
        }
    
        if ($this->input->get('status') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
        }
        
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
        }
        
        // if (!empty($this->input->get('booking_type'))) {
        //     $booking_type = urldecode($this->input->get('booking_type'));
        //     if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
        //         $loc = implode('","', $this->locations[$this->input->get('location')]);
        //         $where_and = ($where != '') ? ' AND ' : '';
        //         $where .= $where_and . '(
        //             (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $loc . '"))
        //             OR 
        //             (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $loc . '"))
        //         )';
        //     } else if ($booking_type != 'all') {
        //         $where_and = ($where != '') ? ' AND ' : '';
        //         $where .= $where_and . '(
        //             (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr = "' . $booking_type . '")
        //             OR 
        //             (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr = "' . $booking_type . '")
        //         )';
        //     }
        // }

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            $selected_location = $this->input->get('location');

            // --- SPECIAL CASE: CMB + specific location (not 'all') ---
            if ($booking_type == 'CMB' && !empty($selected_location) && $selected_location != 'all') {
                // Get the location codes for the selected country (e.g. Kazakhstan -> ['FKZ','GKZ','IKZ','CMB'])
                $location_codes = $this->locations[$selected_location] ?? [];
                // Remove 'CMB' from the list (since regular arrivals never have 'CMB' as enquiry_abbr)
                $regular_codes = array_diff($location_codes, ['CMB']);
                
                $where_and = ($where != '') ? ' AND ' : '';
                $conditions = [];

                // 1. Regular arrivals: enquiry_abbr IN (FKZ, GKZ, IKZ)
                if (!empty($regular_codes)) {
                    // $regular_in = '"' . implode('","', $regular_codes) . '"';
                    $conditions[] = "(arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_no LIKE 'CMB%')";
                }

                // 2. Combo arrivals: EXISTS a combo_enquiry row for the same combo that has enquiry_abbr IN (FKZ, GKZ, IKZ)
                //    This ensures the combo belongs to the selected country.
                if (!empty($regular_codes)) {
                    $subquery_in = '"' . implode('","', $regular_codes) . '"';
                    $conditions[] = "(arrivals.combo_enquiry_id IS NOT NULL AND EXISTS (
                        SELECT 1 FROM combo_enquiry ce 
                        WHERE ce.id = arrivals.combo_enquiry_id 
                        AND ce.enquiry_abbr IN ($subquery_in)
                    ))";
                }

                if (!empty($conditions)) {
                    $where .= $where_and . '(' . implode(' OR ', $conditions) . ')';
                }

                // Set a flag to skip the country filter later (if needed)
                $skip_country_filter = true;
            }
            // --- Existing logic for other booking types ---
            else {
                if ($booking_type == 'all' && $selected_location != 'all') {
                    $loc = implode('","', $this->locations[$selected_location]);
                    $where_and = ($where != '') ? ' AND ' : '';
                    $where .= $where_and . '(
                        (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $loc . '"))
                        OR 
                        (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $loc . '"))
                    )';
                } else if ($booking_type != 'all') {
                    $where_and = ($where != '') ? ' AND ' : '';
                    $where .= $where_and . '(
                        (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr = "' . $booking_type . '")
                        OR 
                        (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr = "' . $booking_type . '")
                    )';
                }
                $skip_country_filter = false;
            }
        }

        if ($this->input->get('company_id') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
        }

        if ($this->session->userdata('admin_type') != 'superadmin' && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com', 'combo1@kazindmc.com']) && $this->session->userdata('type') != '3') {
            $where_and = ($where != '') ? ' AND ' : '';
            $session_locations = explode(',', $this->session->userdata('locations'));
            $all_locations = [];
            foreach ($session_locations as $loc) {
                if (isset($this->locations[$loc])) {
                    $all_locations = array_merge($all_locations, $this->locations[$loc]);
                }
            }
            $assigned_loc = implode('","', $all_locations);
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
                OR 
                (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
            )';
        }

        // Update SELECT for combo enquiries - FIXED
        $select = 'arrivals.*, arrivals.split_number AS split_num, transportation.vehicle_type, guides.name AS guide, ';
        $select .= 'enquiry.enquiry_no, '; // Always show the actual enquiry number like CMB04
        $select .= 'CASE WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.enquiry_abbr ELSE enquiry.enquiry_abbr END AS enquiry_abbr, ';
        $select .= 'enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, enquiry.split_count, admin.name AS staff_name, company.name, hotel_sub.hotel_name,';
        $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

        $hotel_subquery = "(SELECT arrival_id, MIN(hotel_name) AS hotel_name FROM arrival_hotel_details GROUP BY arrival_id) AS hotel_sub";
        
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
            ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
            ['type' => 'LEFT', 'join_table' => $hotel_subquery, 'condition' => 'hotel_sub.arrival_id = arrivals.id'],
        ];
        
        // 28-11-2025 Updated
        // Handle country filter for both regular and combo enquiries
        if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
            $country = $this->input->get('country');

            if (strlen($country) > 1) {
                $countryMapping = [
                    'Azerbaijan' => 'AZ',
                    'Kazakhstan' => 'KZ',
                    'Georgia' => 'GE',
                    'Belarus' => 'BE',
                    'Armenia' => 'AR',
                    'Uzbekistan' => 'UZ'
                ];
                $abbr = $countryMapping[$country];
            } else {
                $abbr = $country;
            }

            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr LIKE "%' . $abbr . '%")
                OR
                (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr LIKE "%' . $abbr . '%")
            )';
        }

        // Confirm count → filter today's arrivals
        if (!empty($this->input->get('confirm_cnt'))) {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . ' DATE(arrivals.created) = "' . date('Y-m-d') . '"';
        }
        
        // Handle query number filter for both regular and combo enquiries
        if ($this->input->get('query_number') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
                OR 
                (arrivals.combo_enquiry_id IS NOT NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
            )';
        }

        $Search_data = [
            'query_number' => $this->input->get('query_number'),
            'country' => $this->input->get('country'),
            'booking_type' => $this->input->get('booking_type'),
            'location' => $this->input->get('location'),
            'staff_id' => $this->input->get('staff_id'),
            'status' => $this->input->get('status'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'confirm_cnt' => $this->input->get('confirm_cnt'),
        ];
        
        if ($this->input->get('submit') <> '') {
            log_user_activity('Arrivals Chart Search',$this->session->userdata('id'), 'Search:'.json_encode($Search_data));
        }

        if($where == ''){
            $where = ' (1=1) ';
        }
        
        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'arrivals/?' . $search[0];

        $config["total_rows"] = $this->common_model->get_data('arrivals', '', '', 'arrivals.id', $where.' GROUP BY arrivals.id', '', $count = true, $join);
        $data["total"] = $config["total_rows"];
        
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
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
        
        $data['result'] = $this->common_model->get_data('arrivals', $offset, $config["per_page"], $select, $where, ' GROUP BY arrivals.id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
        
        $data['links'] = $this->pagination->create_links();
        $data['content'] = 'admin/arrivals_list';
        $this->load->view('admin/layout', $data);
    }
    

    public function add()
    {
        if (!in_array($this->session->userdata('type'), $this->allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }

        $id = base64_decode($this->input->get('enq_id'));
        $where = 'enquiry.id= ' . $id;
        $join = [['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry', '', '', 'enquiry.*,company.name', $where, '', $count = false, $join);
        if (empty($enquiry)) {
            redirect('enquiry-followup');
        }
        $data['enquiry'] = $enquiry[0];
        $type_abbr = substr($data['enquiry']->enquiry_no,0,1);

        //$this->form_validation->set_rules('arrival_date', 'Arrival date', 'trim|required');
        $this->form_validation->set_rules('handling_staff', 'Handling Staff', 'trim|required');
        //$this->form_validation->set_rules('transportation', 'Transportation', 'trim|required');
        //$this->form_validation->set_rules('transportation_id', 'Transportation Selection', 'trim|required|integer');
        //$this->form_validation->set_rules('guide', 'Guide', 'trim|required');
        //$this->form_validation->set_rules('guide_id', 'Guide Selection', 'trim|required|integer');
        $this->form_validation->set_rules('group_type', 'Group', 'trim|required');
        $this->form_validation->set_rules('handover_to_client', 'Client Handover', 'trim|required');
        $this->form_validation->set_rules('handover_to_kazin', 'Kazin Handover', 'trim|required');
        $this->form_validation->set_rules('handover_to_client', 'Group', 'trim|required');
        if($type_abbr != 'G'){
            $this->form_validation->set_rules('enq_id', 'Enquiry', 'trim|required|is_unique[arrivals.enquiry_id]', array('is_unique' => 'Arrival already created for this query.'));
        }
        $this->form_validation->set_error_delimiters('<div class="alert-danger" style="padding:4px;">', '</div>');
        if (in_array($this->session->userdata('type'), ['1', '3'])) {
            $this->form_validation->set_rules('client_billing', 'Client Billing', 'trim|required|integer');
            //$this->form_validation->set_rules('payment_india', 'Payment India', 'trim|required|integer');
            //$this->form_validation->set_rules('payment_almaty', 'Payment Almaty', 'trim|required|integer');
            //$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['locations'] = $this->locations;

            $data['users'] = $this->user_model->all_user();
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            //echo '<pre>';print_r($data['enquiry']);exit;

            $where = 'arrival_room_details.enquiry_id= ' . $id;
            $select = 'arrival_room_details.*,hotels.name AS hotel_name';
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],];
            $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, ' ORDER BY arrival_room_details.checkout_date ASC', $count = false, $join);

            foreach ($data['arrival_room'] as $list) {
                $where = 'arrival_persons_details.arrival_room_details_id = ' . $list->id;
                $data['arrival_persons'][$list->id] = $this->common_model->get_data('arrival_persons_details', '', '', '*', $where, '', $count = false);
            }

            $where = 'arrival_flight_details.enquiry_id= ' . $id;
            $select = 'arrival_flight_details.*,airlines.*';
            $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
            $data['arrival_flights'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, '', $count = false, $join);

            $where = '';
            $select = 'DISTINCT flight_schedule.departure_airport';
            //$join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['departure_airports'] = $this->common_model->get_data('flight_schedule', '', '', $select, $where, '', $count = false);

            $where = 'arrival_hotel_details.enquiry_id = ' . $id;
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
            // echo '<pre>';print_r($data);exit;
            log_user_activity('Query Board Arrival Add',$this->session->userdata('id'), 'Query Board: Arrival Add');
            $data['content'] = 'admin/add_arrivalchart';
            $this->load->view('admin/layout', $data);
        } else {
            $enq_total_persons = $enquiry[0]->number_persons + $enquiry[0]->number_child;

            $where = 'arrivals.enquiry_id= ' . $id;
            $check_arrivals = $this->common_model->get_data('arrivals', '', '', 'SUM(arrivals.num_adults+arrivals.num_child) AS arrival_total', $where, ' GROUP BY arrivals.enquiry_id', $count = false);
            $arrivals_total_persons = $this->input->post('number_persons') + $this->input->post('number_child');
            if(!empty($check_arrivals)){
                    $arrivals_total_persons = $arrivals_total_persons + $check_arrivals[0]->arrival_total;
            }
            if($arrivals_total_persons > $enq_total_persons){
                    $this->session->set_flashdata('message','<div class="alert alert-danger">Number of persons exceeded from enquiry persons number.</div>');
                    redirect(current_url().'?'.$_SERVER['QUERY_STRING']);
            }
            $lead_photo = '';
            if ($_FILES['lead_photo']['name'] != '') {
                $this->load->library('upload');
                $config['upload_path'] = './uploads/lead_photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['lead_photo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('lead_photo')) {
                    //echo $this->upload->display_errors();
                } else {
                    $filename = $this->upload->data();
                    $lead_photo = $filename['file_name'];
                }

            }

            // add new arrival chart
            $insert_arr = array(
                'arrival_date' => $this->input->post('hdn_arrival_date'),
                'handling_staff_id' => $this->input->post('handling_staff'),
                'enquiry_id' => $this->input->post('enq_id'),
                // 'transportation_id' => $this->input->post('transportation_id'),
                // 'guide_id' => $this->input->post('guide_id'),
                'hotel_id' => ($this->input->post('hotel_id') <> '') ? $this->input->post('hotel_id') : 0,
                'lead_name' => $this->input->post('lead_name'),
                'lead_isd_code' => $this->input->post('lead_isd_code'),
                'lead_contact' => $this->input->post('lead_contact'),
                'lead_photo' => $lead_photo,
                'number_rooms' => $this->input->post('number_rooms'),
                'group_type' => $this->input->post('group_type'),
                'handover_to_client' => $this->input->post('handover_to_client'),
                'handover_to_kazin' => $this->input->post('handover_to_kazin'),
                'added_by' => $this->session->userdata('id'),
                'status' => 'in-progress',
                'created' => date('Y-m-d H:i:s'),
                'agent_reference_num' => $this->input->post('agent_reference_num'),
				'num_adults' => $this->input->post('number_persons'),
				'num_child'  => $this->input->post('number_child'),
            );
            if (in_array($this->session->userdata('type'), ['1', '3'])) {
                //$balance = $this->input->post('client_billing') - ($this->input->post('payment_india')+$this->input->post('payment_almaty'));
                $insert_arr = $insert_arr + [
                    'client_billing' => $this->input->post('client_billing'),
                    //'payment_received_india'=>$this->input->post('payment_india'),
                    //'payment_received_almaty'=>$this->input->post('payment_almaty'),
                    'balance_amount' => $this->input->post('balance_amount'),
                    /*'currency'=>$this->input->post('currency')*/
                ];
            }

            if(array_key_exists('split_count',$_POST)){
                $insert_arr = $insert_arr + ['split_number'=>$this->input->post('split_count')];
            }

            $id = $this->common_model->insert_data(['table_name' => 'arrivals', 'insert_data' => $insert_arr]);
            if ($id) {
                $enq_id = $this->input->post('enq_id');
                if($type_abbr != 'G'){					
                        $update_arr = ['number_persons' => $this->input->post('number_persons'), 'number_child' => $this->input->post('number_child')];
                        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq_id]];
                        $this->common_model->update_data_limit($update_data);
                }
                if($type_abbr == 'G' && array_key_exists('split_count',$_POST)){
                    $update_arr = ['split_count' => $this->input->post('split_count')];
                    $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq_id]];
                    $this->common_model->update_data_limit($update_data);
                }else{
                    
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Query Board Arrival Add New',$this->session->userdata('id'), 'Query Board: Arrival Add New: '.json_encode($insert_arr) .json_encode($update_arr));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error in adding. Try Again!</div>');
            }
            redirect('arrivals');
        }
    }
    
    public function add_new()
    {
        if (!in_array($this->session->userdata('type'), $this->allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }

        $id = base64_decode($this->input->get('enq_id'));
        $where = 'enquiry.id= ' . $id;
        $join = [['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry', '', '', 'enquiry.*,company.name', $where, '', $count = false, $join);
        if (empty($enquiry)) {
            redirect('enquiry-followup');
        }
        $data['enquiry'] = $enquiry[0];

        // Get enquiry abbreviations
        $enquiry_abbrs = [];
        if (!empty($data['enquiry']->enquiry_abbr)) {
            if (is_array($data['enquiry']->enquiry_abbr)) {
                $enquiry_abbrs = $data['enquiry']->enquiry_abbr;
            } else {
                $enquiry_abbrs = explode(',', $data['enquiry']->enquiry_abbr);
            }
        }

        // Set basic validation rules
        $this->form_validation->set_rules('handling_staff[]', 'Handling Staff', 'trim|required');
        $this->form_validation->set_rules('group_type[]', 'Group', 'trim|required');
        $this->form_validation->set_rules('handover_to_client[]', 'Client Handover', 'trim|required');
        $this->form_validation->set_rules('handover_to_kazin[]', 'Kazin Handover', 'trim|required');
        $this->form_validation->set_rules('lead_name[]', 'Lead Name', 'trim|required');
        $this->form_validation->set_rules('lead_isd_code[]', 'ISD Code', 'trim|required');
        $this->form_validation->set_rules('lead_contact[]', 'Lead Contact', 'trim|required');
        $this->form_validation->set_rules('number_rooms[]', 'Number of Rooms', 'trim|required|integer');
        $this->form_validation->set_rules('number_persons[]', 'Number of Persons', 'trim|required|integer');
        $this->form_validation->set_rules('number_child[]', 'Number of Child', 'trim|required|integer');
        
        $this->form_validation->set_error_delimiters('<div class="alert-danger" style="padding:4px;">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            // Load basic data for form
            $data['users'] = $this->user_model->all_user();
            $data['content'] = 'admin/add_arrivalchart_combo';
            $this->load->view('admin/layout', $data);
        } else {
            // Get all posted arrays
            // $enquiry_data = $this->input->post('combo_id');
            
            // $enq_ids = $this->input->post('enq_id');
            $enq_ids = $this->input->post('enq_id');
            $this->db->select('*');
            $this->db->from('combo_enquiry');
            $this->db->where_in('combo_enquiry.enquiry_id', $enq_ids);
            $enq_Data = $this->db->get()->result_array();

            // Get all posted arrays
            $enquiry_data = [];
            if (!empty($enq_Data)) {
                foreach ($enq_Data as $row) {
                    $enquiry_data[] = $row['id'];
                }
            }

            // Optional: if you want to store as a comma-separated string
            $enquiry_ids = implode(',', $enquiry_data);
            $arrival_dates = $this->input->post('arrival_date');
            $handling_staffs = $this->input->post('handling_staff');
            $lead_names = $this->input->post('lead_name');
            $lead_isd_codes = $this->input->post('lead_isd_code');
            $lead_contacts = $this->input->post('lead_contact');
            $number_rooms = $this->input->post('number_rooms');
            $group_types = $this->input->post('group_type');
            $handover_to_clients = $this->input->post('handover_to_client');
            $handover_to_kazins = $this->input->post('handover_to_kazin');
            $agent_reference_nums = $this->input->post('agent_reference_num');
            $num_adults = $this->input->post('number_persons');
            $num_childs = $this->input->post('number_child');
            $client_billings = $this->input->post('client_billing');
            $balance_amounts = $this->input->post('balance_amount');
            $split_counts = $this->input->post('split_count');

            $success_count = 0;
            $error_count = 0;

            // Loop through each arrival entry and store data
            foreach ($enq_ids as $index => $enq_id) {
                // Prepare insert array for each arrival
                $insert_arr = array(
                    'arrival_date' => $arrival_dates[$index],
                    'handling_staff_id' => $handling_staffs[$index],
                    'enquiry_id' => $enq_id,
                    'hotel_id' => 0,
                    'lead_name' => $lead_names[$index],
                    'lead_isd_code' => $lead_isd_codes[$index],
                    'lead_contact' => $lead_contacts[$index],
                    'lead_photo' => '',
                    'number_rooms' => (int)$number_rooms[$index],
                    'group_type' => $group_types[$index],
                    'handover_to_client' => $handover_to_clients[$index],
                    'handover_to_kazin' => $handover_to_kazins[$index],
                    'added_by' => $this->session->userdata('id'),
                    'status' => 'in-progress',
                    'created' => date('Y-m-d H:i:s'),
                    'agent_reference_num' => $agent_reference_nums[$index],
                    'num_adults' => (int)$num_adults[$index],
                    'num_child' => (int)$num_childs[$index],
                    'combo_enquiry_id' => $enquiry_data[$index]
                );

                // Add financial data if available
                if (isset($client_billings[$index])) {
                    $insert_arr['client_billing'] = (float)$client_billings[$index];
                    $insert_arr['balance_amount'] = isset($balance_amounts[$index]) ? (float)$balance_amounts[$index] : 0;
                }

                // Add split number if exists
                if(isset($split_counts[$index]) && $split_counts[$index] != ''){
                    $insert_arr['split_number'] = (int)$split_counts[$index];
                }

                // Insert arrival record
                $arrival_id = $this->common_model->insert_data(['table_name' => 'arrivals', 'insert_data' => $insert_arr]);
                
                if ($arrival_id) {
                    $success_count++;
                } else {
                    $error_count++;
                }
            }

            // Set flash message based on results
            if ($success_count > 0) {
                $message = '<div class="alert alert-success">';
                $message .= 'Successfully added ' . $success_count . ' arrival(s)!';
                if ($error_count > 0) {
                    $message .= ' Failed to add ' . $error_count . ' arrival(s).';
                }
                $message .= '</div>';
                $this->session->set_flashdata('message', $message);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error in adding all arrivals. Please try again!</div>');
            }
            
            redirect('arrivals');
        }
    }

    // merge arrivals file
    public function save_combo() {
        $this->form_validation->set_rules('input1', 'First File', 'trim|required');
        $this->form_validation->set_rules('input2', 'Second File', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert-danger" style="padding:4px;">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $errors = [
                'input1' => form_error('input1'),
                'input2' => form_error('input2')
            ];
            echo json_encode(['status' => 'error', 'message' => $errors]);
            return;
        }

        $input1 = strtoupper(trim($this->input->post('input1')));
        $input2 = strtoupper(trim($this->input->post('input2')));

        // Get file type: first character
        $type1 = substr($input1, 0, 1);
        $type2 = substr($input2, 0, 1);

        // Get country code: second and third characters (index 1 and 2)
        $country1 = substr($input1, 1, 2);
        $country2 = substr($input2, 1, 2);

        $allowedCountries = ['KZ', 'AZ', 'GE', 'BZ', 'AR'];

        // Validate allowed country codes
        if (!in_array($country1, $allowedCountries) || !in_array($country2, $allowedCountries)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid country code in file number.']);
            return;
        }

        // Validate type match
        if ($type1 !== $type2) {
            echo json_encode(['status' => 'error', 'message' => 'Both files must be of the same type (F, G, or I).']);
            return;
        }

        // Validate country difference
        if ($country1 === $country2) {
            echo json_encode(['status' => 'error', 'message' => 'Both files must be from different countries.']);
            return;
        }

        // Check existence
        $enq1 = $this->enquiry_model->get_by_enquiry_no($input1);
        $enq2 = $this->enquiry_model->get_by_enquiry_no($input2);

        if (!$enq1 || !$enq2) {
            echo json_encode(['status' => 'error', 'message' => 'One or both enquiry numbers not found.']);
            return;
        }

        // Insert combo
        $insert_arr = [
            'enquiry_id1' => $enq1->id,
            'enquiry_id2' => $enq2->id,
            'file1'       => $enq1->enquiry_no,
            'file2'       => $enq2->enquiry_no,
            'created_at'  => date('Y-m-d H:i:s'),
            'status'      => 'active',
        ];

        $this->common_model->insert_data([
            'table_name'  => 'arrival_combo',
            'insert_data' => $insert_arr
        ]);

        $combo_id = $this->db->insert_id();

        // Update enquiries with combo_id
        $this->db->where('enquiry_no', $enq1->enquiry_no)->update('enquiry', ['combo_id' => $combo_id]);
        $this->db->where('enquiry_no', $enq2->enquiry_no)->update('enquiry', ['combo_id' => $combo_id]);

        echo json_encode(['status' => 'success', 'message' => 'Combo saved successfully.']);
    }

     //30 april
    public function add_enquiry_transportation()
    {
        $this->form_validation->set_rules('enquiry_id', 'Enquiry Id', 'trim|required');
        $this->form_validation->set_rules('transportation_id', 'Vehicle', 'trim|required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            log_user_activity('Query Board Transport Add ',$this->session->userdata('id'), 'Error:'.validation_errors());
            exit;
        }
        $checked = '';
        if(array_key_exists('luggage_vehicle',$this->input->post())){
            $checked = 'yes';
        }

        $data = array(
            'enquiry_id' => $this->input->post('enquiry_id'),
            'transportation_id' => $this->input->post('transportation_id'),
            'quantity' => $this->input->post('capacity'),'luggage_vehicle'=>$checked,
            'arrival_id' => $this->input->post('arrival_id')
        );

        $insert = $this->common_model->insert_data(['table_name' => 'enquiry_transport', 'insert_data' => $data]);

        if (!$insert) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-dange">Transportation not created!</div>']);
            log_user_activity('Query Board Transport Add New',$this->session->userdata('id'), 'Error: (Transportation not created!)');
            exit;
        }
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Transportation created successully!</div>']);
        log_user_activity('Query Board Transport Add New',$this->session->userdata('id'), 'Add Transport:'.json_encode($data));

    }

    public function enquiry_transportation_data($id)
    {

        $where = 'arrivals.enquiry_id= ' . $id;
        $select = 'arrivals.transportation_id,transportation.vehicle_type,transportation.vehicle_name';
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],];
        $datas = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);


        if (!empty($datas) && $datas[0]->transportation_id != 0) {

            $select = 'arrivals.transportation_id,arrivals.enquiry_id as enqId,transportation.vehicle_type,transportation.vehicle_name,transportation.luggage_transport AS luggage_vehicle';
            $join = [
                ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ];
            $arrivalData = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);

            $select = 'enquiry_transport.*,transportation.vehicle_type,transportation.vehicle_name, transportation.city';
            $where = 'enquiry_transport.enquiry_id = ' . $id;
            $join = [
                ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],
            ];
            $enquiryData = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);


            $data = array_merge($arrivalData, $enquiryData);

            echo json_encode(['response' => 'success', 'details' => $data]);
        } else {
            $select = 'enquiry_transport.*,transportation.vehicle_type,transportation.vehicle_name, transportation.city';
            $where = 'enquiry_transport.enquiry_id= ' . $id;
            $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
            $data = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);

            echo json_encode(['response' => 'success', 'details' => $data]);
        }

    }

    public function update_enquiry_transport_data($id)
    {
        $id = $this->uri->segment(2);
        $update_arr = array(
            'transportation_id' => '0',
        );

        $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['enquiry_id' => $id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);

        if ($affected_rows > 0) {
            echo json_encode(['response' => 'success', 'msg' => 'item delete successfully.']);
            log_user_activity('Query Board Transport Delete',$this->session->userdata('id'), 'Query Board: Transport Deleted');
        } else {
            echo json_encode(['response' => 'error', 'msg' => 'item not deleted .']);
        }

    }

    public function remove_enquiry_transportation_data($id)
    {
        $this->db->where('id', $this->uri->segment(2));
        $this->db->delete('enquiry_transport');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['response' => 'success', 'msg' => 'item delete successfully.']);
            log_user_activity('Query Board Transport Delete',$this->session->userdata('id'), 'Query Board: Transport Deleted');
        } else {
            echo json_encode(['response' => 'error', 'msg' => 'itemm not deleted .']);
        }

    }

    public function add_enquiry_guide()
    {
        $this->form_validation->set_rules('enquiry_g_id', 'Enquiry Id', 'trim|required');
        $this->form_validation->set_rules('guide_id', 'Guide', 'trim|required');

        $this->form_validation->set_error_delimiters('', '<br>');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            log_user_activity('Query Board Add Guide',$this->session->userdata('id'), 'Error: '.validation_errors());
            exit;
        }

        $data = array(
            'enquiry_id' => $this->input->post('enquiry_g_id'),
            'guide_id' => $this->input->post('guide_id'),
            'arrival_id' => $this->input->post('arrival_g_id'),
        );

        $insert = $this->common_model->insert_data(['table_name' => 'enquiry_guide', 'insert_data' => $data]);

        if (!$insert) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-dange">Guide not created!</div>']);
            exit;
        }
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Guide created successully!</div>']);
        log_user_activity('Query Board  Guide Add New',$this->session->userdata('id'), 'Add New Guide: '. json_encode($data));


    }

    public function enquiry_guide_data($id)
    {
        $where = 'arrivals.enquiry_id= ' . $id;
        $select = 'arrivals.guide_id,guides.name';
        $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],];
        $datas = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);

         if (!empty($datas) && $datas[0]->guide_id != 0) {
            $select = 'arrivals.guide_id,arrivals.enquiry_id as enqId, guides.name';
            $join = [
                ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ];
            $arrivalData = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);

            $select = 'enquiry_guide.*, guides.name, guides.isd_codes, guides.contact_number';
            $where = 'enquiry_guide.enquiry_id = ' . $id;
            $join = [
                ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],
            ];
            $enquiryData = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);

            $data = array_merge($arrivalData, $enquiryData);

            echo json_encode(['response' => 'success', 'details' => $data]);
        } else {
            $select = 'enquiry_guide.*,guides.name, guides.isd_codes, guides.contact_number';
            $where = 'enquiry_guide.enquiry_id= ' . $id;
            $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
            $data = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);

            echo json_encode(['response' => 'success', 'details' => $data]);
        }
    }

    public function remove_enquiry_guide_data($id)
    {
        $this->db->where('id', $this->uri->segment(2));
        $this->db->delete('enquiry_guide');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['response' => 'success', 'msg' => 'item delete successfully.']);
            log_user_activity('Query Board Guide Delete',$this->session->userdata('id'), 'Query Board: Guide Deleted');
        } else {
            echo json_encode(['response' => 'error', 'msg' => 'item not deleted .']);
            log_user_activity('Query Board Guide Delete',$this->session->userdata('id'), 'Error (item not deleted)');
        }

    }

    public function update_enquiry_guide_data($id)
    {

        $id = $this->uri->segment(2);
        $update_arr = array(
            'guide_id' => '0',
        );

        $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['enquiry_id' => $id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);



        if ($affected_rows > 0) {
            echo json_encode(['response' => 'success', 'msg' => 'item delete successfully.']);
            log_user_activity('Query Board Guide Delete',$this->session->userdata('id'), 'Query Board: Guide Deleted');
        } else {
            echo json_encode(['response' => 'error', 'msg' => 'item not deleted .']);
            log_user_activity('Query Board Guide Delete',$this->session->userdata('id'), 'Error (item not deleted)');
        }

    }

    public function edit()
    {
        //$this->form_validation->set_rules('arrival_date', 'Arrival date', 'trim|required');
        //$this->form_validation->set_rules('handling_staff', 'Handling Staff', 'trim|required');
        //$this->form_validation->set_rules('transportation', 'Transportation', 'trim|required');
        //$this->form_validation->set_rules('transportation_id', 'Transportation Selection', 'trim|required|integer');
        //$this->form_validation->set_rules('guide', 'Guide', 'trim|required');
        //$this->form_validation->set_rules('guide_id', 'Guide Selection', 'trim|required|integer');
        //$this->form_validation->set_rules('group_type', 'Group', 'trim|required');
        //$this->form_validation->set_rules('handover_to_client', 'Client Handover', 'trim|required');
        //$this->form_validation->set_rules('handover_to_kazin', 'Kazin Handover', 'trim|required');
        //$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        //$this->form_validation->set_rules('handover_to_client', 'Group', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Arrival', 'trim|required');
        if (in_array($this->session->userdata('type'), ['1', '3'])) {
            $this->form_validation->set_rules('client_billing', 'Client Billing', 'trim|required|integer');
            //$this->form_validation->set_rules('payment_india', 'Payment India', 'trim|required|integer');
            //$this->form_validation->set_rules('payment_almaty', 'Payment Almaty', 'trim|required|integer');
        }

        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id= ' . $id;
        $select = 'enquiry.id AS enq_id,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.number_persons,enquiry.number_child,enquiry.check_in_date,enquiry.number_of_nights,enquiry.check_out_date,enquiry.split_count,company.name,arrivals.* ,';
        $select .= 'guides.name AS guide,transportation.vehicle_name,hotels.name AS hotel_name';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        if (empty($arrivals)) {
            redirect('arrivals');
        }
        $data['arrivals'] = $arrivals[0];
        //echo '<pre>';print_r($data['arrivals']);exit;

        $select = 'guides.*';
        $where = 'enquiry_guide.enquiry_id= ' . $arrivals[0]->enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
        $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);

        $select = 'arrival_restaurants.*,restaurants.name as names';
        $where = 'arrival_restaurants.arrival_id=' . $id;
        $join = [['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],];
        $data['arrival_restaurants'] = $this->common_model->get_data('arrival_restaurants', '', '', $select, $where, '', $count = false, $join);

        //echo '<pre>';print_r($data['arrivals']);
        if ($this->form_validation->run() == FALSE) {
            $data['locations'] = $this->locations;

            $data['users'] = $this->user_model->all_user();
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            //echo '<pre>';print_r($arrivals);exit;
            $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
            $select = 'arrival_room_details.*,hotels.name AS hotel_name,hotels.id AS hotel_id, enquiry.enquiry_abbr';
            $join = [['type' => '', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_hotel_details.id = arrival_room_details.arrival_hotel_details_id'],
                    ['type' => '', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                     ['type' => '', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_hotel_details.enquiry_id'],
                    ];
            $data['arrival_room'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_room_details.checkout_date ASC', $count = false, $join);
            
            if(empty($data['arrival_room']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
                $where = 'arrival_room_details.enquiry_id = ' . $arrivals[0]->enq_id;
                $select = 'arrival_room_details.*,hotels.name AS hotel_name,hotels.id AS hotel_id, enquiry.enquiry_abbr';
                $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                        ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrival_room_details.enquiry_id'],];
                $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, ' ORDER BY arrival_room_details.checkout_date ASC', $count = false, $join);
            }
            
            foreach ($data['arrival_room'] as $list) {
                $where = 'arrival_persons_details.arrival_room_details_id = ' . $list->id;
                $data['arrival_persons'][$list->id] = $this->common_model->get_data('arrival_persons_details', '', '', '*', $where, '', $count = false);
            }
            //echo '<pre>';print_R($arrivals);exit;
            $where = 'arrival_flight_details.arrival_id= ' . $arrivals[0]->id;
            $select = 'arrival_flight_details.*,airlines.name,airlines.id AS a_id';
            $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
            $data['arrival_flights'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, '', $count = false, $join);
            
            if(empty($data['arrival_flights']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
                $where = 'arrival_flight_details.enquiry_id= ' . $arrivals[0]->enq_id;
                $select = 'arrival_flight_details.*,airlines.name,airlines.id AS a_id';
                $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
                $data['arrival_flights'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, '', $count = false, $join);
            }
            
            $data['allowed_users'] = $this->allowed_users;

            $where = 'hotel_id = ' . $arrivals[0]->hotel_id;
            $data['hotel_room_categories'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false);

            $where = '';
            $select = 'DISTINCT flight_schedule.departure_airport';
            //$join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['departure_airports'] = $this->common_model->get_data('flight_schedule', '', '', $select, $where, '', $count = false);

            if(($arrivals[0]->combo_enquiry_id == 'NULL')){
                $where = 'arrival_hotel_details.enquiry_id = ' . $arrivals[0]->enq_id;
            }else{
                $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
            }
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
			
            if(substr($arrivals[0]->enquiry_abbr,0,1) == 'G' && $arrivals[0]->split_count > 0){
                $arrival_hotel_details = $data['arrival_hotel_details'];
                $data['arrival_hotel_details'] = [];
                foreach($arrival_hotel_details AS $key=>$val){
                    if($val->arrival_id == $arrivals[0]->id){
                        $data['arrival_hotel_details'][] = $val; 
                    }
                }
            }
			
            $data_arr = array('table_name' => 'all_restaurant_menus', 'condition' => array('status' => 'active'));

            $data['menus'] = $this->common_model->get_rows($data_arr);

            $data_arrs = array('table_name' => 'all_meal_types', 'condition' => array('status' => 'active'));

            $data['meals'] = $this->common_model->get_rows($data_arrs);
            if($arrivals[0]->combo_enquiry_id != 'NULL'){
                $this->db->select('*');
                $this->db->from('combo_enquiry');
                $this->db->where('combo_enquiry.id', $arrivals[0]->combo_enquiry_id);
                $data['is_combo'] = $this->db->get()->result_array();
            }
            $select = 'restaurants.id,restaurants.name as names';
            $char = $data['is_combo'] ? substr($data['is_combo'][0]['enquiry_abbr'], 1, 2) : substr($arrivals[0]->enquiry_abbr, 1, 2);
            $locations = COUNTRY_ABBR; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
            $where = 'LOWER(restaurants.country) = "' . $locations[$char] . '" AND restaurants.status = "active"';

            $data['res'] = $this->common_model->get_data('restaurants', '', '', $select, $where, '', $count = false);

            // $select = 'arrival_restaurants.*,restaurants.name as names';
            // $where = 'arrival_restaurants.arrival_id = ' . $id;
            // $join = [['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],];
            // $data['restaurants_data'] = $this->common_model->get_data('arrival_restaurants', '', '', $select, $where, '', $count = false, $join);

            $this->db->select('restaurants.name as names, restaurant_menus.*');
            $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
            $this->db->join('arrival_restaurants', 'arrival_restaurants.arrival_id = restaurant_menus.arr_id
                            AND arrival_restaurants.date = restaurant_menus.date
                            AND arrival_restaurants.buffet = restaurant_menus.buffet
                            AND arrival_restaurants.restaurant_id = restaurant_menus.restaurant_id', 'left');
            $this->db->where('restaurant_menus.arr_id', $id);
            $this->db->where('arrival_restaurants.arrival_id IS NULL');
            $this->db->group_by('restaurant_menus.date, restaurant_menus.buffet, restaurant_menus.restaurant_id');
            $this->db->order_by('restaurant_menus.date');
            $this->db->order_by('FIELD (restaurant_menus.buffet, "Breakfast", "Lunch", "Dinner")');
            $result = $this->db->get('restaurant_menus');
            $data['menu_result'] = $result->result();

            $select = 'payment_details.*,arrivals.client_billing,arrivals.balance_amount';
            $join = [['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.id = payment_details.arrival_id'],];
            $where = 'payment_details.arrival_id = ' . $id;
            $data['payment_data'] = $this->common_model->get_data('payment_details', '', '', $select, $where, '', $count = false, $join);
            // $query = $this->db->get('guide_driver_detail');
            // $drivers = $query->result();
            // // $data['drivers'] = $drivers;
            //echo '<pre>';print_r($data);exit;
            log_user_activity('Query Board Arrival Edit',$this->session->userdata('id'), 'Query Board: Arrival Edit ');
            $data['content'] = 'admin/edit_arrivalchart';  
            $this->load->view('admin/layout', $data);
        } else {
            $enq_total_persons = (int)$arrivals[0]->number_persons + (int)$arrivals[0]->number_child;

            $where = 'arrivals.enquiry_id= ' . $arrivals[0]->enquiry_id. ' AND arrivals.id != '.$id;
            $check_arrivals = $this->common_model->get_data('arrivals', '', '', 'SUM(arrivals.num_adults+arrivals.num_child) AS arrival_total', $where, ' GROUP BY arrivals.enquiry_id', $count = false);
            $arrivals_total_persons = (int)$this->input->post('number_persons') + (int)$this->input->post('number_child');
            if(!empty($check_arrivals)){
                    $arrivals_total_persons = $arrivals_total_persons + $check_arrivals[0]->arrival_total;
            }
            
            if($arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
                if($arrivals_total_persons > $enq_total_persons){
                        $this->session->set_flashdata('message','<div class="alert alert-danger">Number of persons exceeded from enquiry persons number.</div>');
                        redirect(current_url().'?'.$_SERVER['QUERY_STRING']);
                }
            }
			
            $arrival_date = date_create($this->input->post('hdn_arrival_date'));
            $days_to_add = (int)$data['arrivals']->number_of_nights + 1;
            date_add($arrival_date, date_interval_create_from_date_string($days_to_add . ' days'));
            $d1_arrival = date_format($arrival_date, 'Y-m-d');
            $d2_today = date('Y-m-d');
            if ($d1_arrival > $d2_today && in_array($this->input->post('status'), ['complete', 'file-closed'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Cannot Update Status. As arrival date and number of nights has not been passed.</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $chk_balance = $this->input->post('client_billing') - ($this->input->post('payment_india') + $this->input->post('payment_almaty'));
            if ($d1_arrival < $d2_today && $this->input->post('status') == 'file-closed' && $chk_balance != '0') {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Cannot Update Status(File Close). As having pending balance.</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            // CORRECTED: Proper handling of child ages
            $child_ages = $this->input->post('child_age');
            
            // Validate child ages if children exist
            $number_child = $this->input->post('number_child');
            if ($number_child > 0 && !empty($child_ages)) {
                // Ensure we have exactly the number of ages as children
                if (count($child_ages) != $number_child) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Number of child ages does not match number of children.</div>');
                    redirect(current_url().'?'.$_SERVER['QUERY_STRING']);
                }
                
                // Validate each age
                foreach ($child_ages as $age) {
                    $age = (int)$age;
                    if ($age < 0 || $age > 17) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Child age must be between 0 and 17 years.</div>');
                        redirect(current_url().'?'.$_SERVER['QUERY_STRING']);
                    }
                }
            }
            
             $original_arrival_id = base64_decode($this->input->post('arrival_id'));
            $orig_where = 'arrivals.id = ' . $original_arrival_id;
            $orig_select = 'combo_enquiry_id, enquiry_id';
            $orig_arrival = $this->common_model->get_data('arrivals', '', '', $orig_select, $orig_where, '', $count = false);
            if (empty($orig_arrival)) {
                redirect('arrivals');
            }
            $orig_arrival = $orig_arrival[0];

            // 5. Determine if we should update enquiry status to cancel-at-arrival
            $update_enquiry_status = false;
            $new_status = $this->input->post('status');

            // Only proceed if status is 'cancel' and user has permission
            if ($new_status == 'cancel' && ($this->session->userdata('admin_type') == 'superadmin' || $this->session->userdata('id') == '33')) {
                
                // Check if this arrival belongs to a combo
                // combo_enquiry_id may be NULL, 0, 'NULL' (string), or a positive integer
                $combo_id = $orig_arrival->combo_enquiry_id;
                $is_combo = !empty($combo_id) && $combo_id != 'NULL' && $combo_id != 0;
                
                $is_combo = !empty($orig_arrival->combo_enquiry_id) && $orig_arrival->combo_enquiry_id != 'NULL';
    
                if ($is_combo) {
                    // For combo files: check other arrivals with the SAME enquiry_id that are NOT canceled
                    $enquiry_id = $orig_arrival->enquiry_id;
                    $current_arrival_id = $original_arrival_id;
                    
                    $this->db->select('COUNT(*) as not_canceled_count');
                    $this->db->from('arrivals');
                    $this->db->where('enquiry_id', $enquiry_id);
                    $this->db->where('id !=', $current_arrival_id);
                    $this->db->where('status !=', 'cancel');
                    $query = $this->db->get();
                    $result = $query->row();
                    // print_r($result);exit;
                    
                    if ($result->not_canceled_count == 0) {
                        // No other active (non-canceled) arrivals for this enquiry → update enquiry status
                        $update_enquiry_status = true;
                        $this->session->set_flashdata('info', 'All combo arrivals canceled. Enquiry status updated to cancel-at-arrival.');
                    } else {
                        $this->session->set_flashdata('info', 'Arrival canceled, but other combo arrivals remain active. Enquiry status not changed.');
                    }
                } else {
                    // Non-combo: always update enquiry status
                    $update_enquiry_status = true;
                }
            }

            $update_arr = array(
                'arrival_date' => $this->input->post('hdn_arrival_date'),
                'handling_staff_id' => $this->input->post('handling_staff'),
                'transportation_id' => $this->input->post('transportation_id'),
                'guide_id' => $this->input->post('guide_id'),
                'hotel_id' => $this->input->post('hotel_id'),
                'lead_name' => $this->input->post('lead_name'),
                'lead_isd_code' => $this->input->post('lead_isd_code'),
                'lead_contact' => $this->input->post('lead_contact'),
                'number_rooms' => $this->input->post('number_rooms'),
                'group_type' => $this->input->post('group_type'),
                'handover_to_client' => $this->input->post('handover_to_client'),
                'handover_to_kazin' => $this->input->post('handover_to_kazin'),
                'added_by' => $this->session->userdata('id'),
                'status' => $this->input->post('status'),
				'remarks' => $this->input->post('arrival_remarks'),
                'agent_reference_num' => $this->input->post('agent_reference_num'),
				'num_adults' => $this->input->post('number_persons'),
				'num_child' => $this->input->post('number_child'),
				'child_ages' => !empty($child_ages) ? json_encode($child_ages) : NULL
            );
            if (in_array($this->session->userdata('type'), ['1', '3'])) {
                $balance = $this->input->post('client_billing') - ($this->input->post('payment_india') + $this->input->post('payment_almaty'));
                $update_arr = $update_arr + [
                    'client_billing' => $this->input->post('client_billing'),
                    //'payment_received_india'=>$this->input->post('payment_india'),
                    //'payment_received_almaty'=>$this->input->post('payment_almaty'),
                    'balance_amount' => $balance,//$this->input->post('balance_amount'),
                    //'currency'=>$this->input->post('currency')
                ];
            }

            if ($_FILES['lead_photo']['name'] != '') {
                $this->load->library('upload');
                $config['upload_path'] = './uploads/lead_photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['lead_photo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('lead_photo')) {
                    //echo $this->upload->display_errors();
                } else {
                    $filename = $this->upload->data();
                    $update_arr['lead_photo'] = $filename['file_name'];
                }

            }

            if (!in_array($this->session->userdata('type'), $this->allowed_users)) {
                $update_arr = array(
                    'transportation_id' => $this->input->post('transportation_id'),
                    'guide_id' => $this->input->post('guide_id'),
                    //'payment_received_almaty'=>$this->input->post('payment_almaty'),
                    //'balance_amount'=> $balance,//$this->input->post('balance_amount'),
                    'added_by' => $this->session->userdata('id'),
                    'status' => $this->input->post('status'),
                    'child_ages' => !empty($child_ages) ? json_encode($child_ages) : NULL
                );
            }

            $id = base64_decode($this->input->post('arrival_id'));
            $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);

            $edit_cnt = array_key_exists('edit_checkin', $this->input->post()) ? count($this->input->post('edit_checkin')) : 0;
            $update_arr_dates = [];
            $smallest_date = $greatest_date = '';
            if ($edit_cnt > 0) {
                $smallest_date = strtotime($this->input->post('edit_checkin')[0]);
                $greatest_date = strtotime($this->input->post('edit_checkout')[0]);
                for ($i = 0; $i < $edit_cnt; $i++) {
                    $d1 = strtotime($this->input->post('edit_checkin')[$i]);
                    if ($smallest_date > $d1) {
                        $smallest_date = $d1;
                    }
                    $d2 = strtotime($this->input->post('edit_checkout')[$i]);
                    if ($greatest_date < $d2) {
                        $greatest_date = $d2;
                    }
                }
                $date_checkin = new DateTime(date('Y-m-d', $smallest_date));
                $date_checkout = new DateTime(date('Y-m-d', $greatest_date));
                $interval = $date_checkin->diff($date_checkout);
                $update_arr_dates = array('check_in_date' => date('Y-m-d', $smallest_date), 'check_out_date' => date('Y-m-d', $greatest_date), 'number_of_nights' => $interval->days);
            }
            $enq_id = $this->input->post('enq_id');
            $update_array = ['number_persons' => $this->input->post('number_persons'), 'number_child' => $this->input->post('number_child')];
            $update_array = $update_array + $update_arr_dates;

            // if ($this->input->post('status') == 'cancel' && ($this->session->userdata('admin_type') == 'superadmin' || $this->session->userdata('id') == '33')) {
            //     $update_array = $update_array + ['status' => 'cancel-at-arrival'];
            // }
            
            if ($update_enquiry_status) {
                $update_array = $update_array + ['status' => 'cancel-at-arrival'];
            }
            
            $update = ['table_name' => 'enquiry', 'update_data' => $update_array, 'condition' => ['id' => $enq_id]];
            $this->common_model->update_data_limit($update);
            
            // Use before 09-07-2025
            // $type_abbr = substr($data['arrivals']->enquiry_no,0,1);
            // if($type_abbr != 'G'){
            //     $this->common_model->update_data_limit($update);
            // }
            //if($affected_rows){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            //}else{ $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating. Try Again!</div>'); }
            redirect('arrivals');
        }
    }

    public function add_hotel()
    {
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('person_name', 'Contact Person Name', 'trim|required');
        $this->form_validation->set_rules('hotel_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_number', 'Contact Person Number', 'trim|required|integer');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }

        $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('hotel_name'))) . '" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('hotels', '', '', '*', $where, '', $count = true);
        //echo $res_company;exit;
        if ($res_hotels > 0) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-warning">Hotel with name (' . $this->input->post('hotel_name') . ') exists!</div>']);
            exit;
        }
        $hotel_name = ucwords(strtolower($this->input->post('hotel_name')));

        $data = array(
            'name' => $this->security->xss_clean($hotel_name),
            'country' => $this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
            'state' => $this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
            'city' => $this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
            'address_1' => $this->security->xss_clean($this->input->post('address_1')),
            'address_2' => $this->security->xss_clean($this->input->post('address_2')),
            'contact_person_name' => $this->security->xss_clean(ucwords(strtolower($this->input->post('person_name')))),
            'isd_codes' => $this->security->xss_clean($this->input->post('isd_codes')),
            'mobile' => $this->security->xss_clean($this->input->post('contact_number')),
            'email' => $this->security->xss_clean($this->input->post('hotel_email')),
            'created' => date('Y-m-d H:i:s'),
            'remarks' => $this->security->xss_clean($this->input->post('remarks')),
            'pincode' => $this->security->xss_clean($this->input->post('pincode')),
            'category' => $this->security->xss_clean($this->input->post('category')),
        );
        $this->db->insert('hotels', $data);
        $id = $this->db->insert_id();
        echo json_encode(['response' => 's', 'details' => ['hotel_name' => $hotel_name, 'h_id' => $id], 'msg' => '<div class="alert alert-success">Hotel created successully!</div>']);
    }

    public function add_transportation()
    {
        $this->form_validation->set_rules('tansportation_id', 'Vehicle', 'trim|required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }

        $where = ' LOWER(vehicle_type)= "' . strtolower(trim($this->input->post('vehicle_type'))) . '" AND capacity = "' . trim($this->input->post('capacity')) . '" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('transportation', '', '', '*', $where, '', $count = true);
        //echo $res_company;exit;
        if ($res_hotels > 0) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-warning">Vehicle with type (' . $this->input->post('vehicle_type') . ') and capacity exists!</div>']);
            exit;
        }
        if ($_FILES['upload_images']['name'][0] != '') {
            $cnt = count($_FILES['upload_images']['name']);
            if ($cnt > 6) {
                echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">Maximum 6 Images Allowed!</div>']);
                exit;
            }
        }
        $data = array(
            'vehicle_type' => $this->input->post('vehicle_type'),
            'capacity' => $this->input->post('capacity'),
            'created' => date('Y-m-d H:i:s'),
            'remarks' => $this->security->xss_clean($this->input->post('remarks')),
            'year' => $this->input->post('year'),
            'make' => $this->input->post('make'),
            'luggage' => $this->input->post('luggage'),
        );
        $this->db->insert('transportation', $data);
        $id = $this->db->insert_id();

        if ($id) {
            $this->load->library('upload');
            $insert_uploads = [];
            if ($_FILES['upload_images']['name'][0] != '') {
                $cnt = count($_FILES['upload_images']['name']);
                $FILES['images'] = $_FILES['upload_images'];
                $created = date('Y-m-d H:i:s');
                for ($i = 0; $i < $cnt; $i++) {
                    $filename = [];
                    $_FILES['inv'] = [];
                    $_FILES['img']['name'] = $FILES['images']['name'][$i];
                    $_FILES['img']['type'] = $FILES['images']['type'][$i];
                    $_FILES['img']['tmp_name'] = $FILES['images']['tmp_name'][$i];
                    $_FILES['img']['error'] = $FILES['images']['error'][$i];
                    $_FILES['img']['size'] = $FILES['images']['size'][$i];
                    $config['upload_path'] = './uploads/transportation/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = $id . '_' . time() . '_' . str_replace(' ', '_', $_FILES['img']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img')) {
                        //echo $this->upload->display_errors();
                    } else {
                        $filename = $this->upload->data();
                    }
                    $insert_uploads[$i] = ['transportation_id' => $id, 'image' => $filename['file_name'], 'created' => $created];
                }
            }
            if (!empty($insert_uploads)) {
                $this->common_model->insert_data_batch(['table_name' => 'transportation_images', 'insert_data' => $insert_uploads]);
            }
        }
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Transportation created successully!</div>']);
    }

    public function add_guide()
    {
        $this->form_validation->set_rules('guide_name', 'Guide Name', 'trim|required');
        $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required|integer');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $photo = '';
        if ($_FILES['photo']['name'] != "") {
            $this->load->library('upload');
            $config = array(
                'upload_path' => "assets/guide/",
                'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                'detect_mime' => true,
                'overwrite' => true,
                'max_size' => '2048',
                'file_name' => time() . '_' . str_replace(' ', '_', $_FILES['photo']['name'])
            );
            $this->upload->initialize($config);
            if ($this->upload->do_upload('photo')) {
                $data_img = $this->upload->data();
                $photo = $data_img['file_name'];
            } else {
                $response = ['response' => 'e', 'details' => '', 'msg' => $this->upload->display_errors()];
                exit;
            }
        } else {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">Guide Photo is required!</div>']);
            exit;
        }

        $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('guide_name'))) . '" AND location = "' . trim($this->input->post('location')) . '" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('guides', '', '', '*', $where, '', $count = true);
        //echo $res_company;exit;
        if ($res_hotels > 0) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-warning">Vehicle with type (' . $this->input->post('guide_name') . ') and location exists!</div>']);
            exit;
        }

        $data = array(
            'name' => $this->input->post('guide_name'),
            'last_name' => $this->input->post('guide_last_name'),
            'gender' => $this->input->post('gender'),
            'isd_codes' => $this->input->post('isd_codes'),
            'contact_number' => $this->input->post('contact_number'),
            'location' => $this->input->post('location'),
            'created' => date('Y-m-d H:i:s'),
            'photo' => $photo,
            'remarks' => $this->security->xss_clean($this->input->post('remarks')),
        );
        $this->db->insert('guides', $data);
        $id = $this->db->insert_id();
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Guide added successully!</div>']);
    }
    
    public function hotel_name_suggesstion()
    {
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR ; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('hotels')->result();
        foreach ($records as $row)
        {
            $response[] = array("h_id" => $row->id, "label" => trim($row->name));
        }
        echo json_encode($response);
    }

    public function transportation_name_suggesstion()
    {
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR ; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("vehicle_name like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('transportation')->result();
        foreach ($records as $row) {
            $city = !empty($row->city) ? trim($row->city) : 'All';
            $response[] = array("t_id" => $row->id, 
            'label' => trim($row->vehicle_name) . ' - ' . $city, 
            'vehicle_name' => trim($row->vehicle_name),
            'city' => $city,
            'luggage_vehicle'=>$row->luggage_transport,
            'capacity'=>$row->capacity);
        }
        echo json_encode($response);
    }

    public function guide_name_suggesstion()
    {
        $char = substr($this->input->post('location'), 1, 2);
        $locations =COUNTRY_ABBR; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('guides')->result();
        foreach ($records as $row) {
            $response[] = array("g_id" => $row->id, "label" => trim($row->name));
        }
        echo json_encode($response);
    }

    public function driver_name_suggestion()
    {
        $response = array();
        $char = substr($this->input->post('enquiry_abbr'), 1, 2);
        $locations =COUNTRY_ABBR; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $this->db->select('*');
        $this->db->like('driver_name', trim($this->input->post('search')));
        $this->db->where('status','active');
        $this->db->where('LOWER(country)',$locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('drivers')->result();
    
        foreach ($records as $row) {
            $response[] = array("d_id" => $row->id, "label" => trim($row->driver_name));
        }    
        echo json_encode($response);
    }
    
    public function fetch_driver_name()
    {
        $id = $this->uri->segment(2);
        // $where = 'arrivals.enquiry_id = ' . $id;
        $where = 'arrivals.id = ' . (int)$id; 
        $select = 'arrivals.driver_id,drivers.driver_name,drivers.driver_phone_number';
        $join = [['type' => 'LEFT', 'join_table' => 'drivers', 'condition' => 'drivers.id = arrivals.driver_id'],];
        $datas = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);

        //if (!empty($datas) && $datas[0]->driver_id != 0) {
            echo json_encode(['response' => 'success', 'details' => $datas]);
        //}
    }
    
    public function add_enquiry_driver()
    {
        $this->form_validation->set_rules('arrival_id_driver', 'Arrival Id', 'trim|required');
        $this->form_validation->set_rules('driver_id', 'Driver', 'trim|required');

        $this->form_validation->set_error_delimiters('', '<br>');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            log_user_activity('Query Board Add Driver',$this->session->userdata('id'), 'Error: '.validation_errors());
            exit;
        }
        $arrival_id = $this->input->post('arrival_id_driver');
        $update_arr = ['driver_id' => $this->input->post('driver_id')];
        $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $arrival_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);

        if (!$affected_rows) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-dange">Driver not added!</div>']);
            exit;
        }
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Driver added successully!</div>']);
        log_user_activity('Query Board  Driver Add New',$this->session->userdata('id'), 'Add New Driver: '. json_encode($update_arr));
    
    }
    
    public function airline_name_suggesstion()
    {
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->limit(10);
        $records = $this->db->get('airlines')->result();
        foreach ($records as $row) {
            $response[] = array("a_id" => $row->id, "label" => trim($row->name));
        }
        echo json_encode($response);
    }

    public function company_name_unique()
    {
        $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('company'))) . '" AND is_deleted ="0"';
        $count = $this->common_model->get_data('company', '', '', '*', $where, '', $count = true);
        if ($count) {
            return false;
        } else {
            return true;
        }
    }

    public function get_staff()
    {
        $location = $this->input->post('location');
        $where = 'admin.status=1 AND admin.location="' . $location . '" ';
        $orderby = ' ORDER BY admin.name';
        $select = '*';
        $data = $this->common_model->get_data('admin', '', '', $select, $where, $orderby, $count = false);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }

    public function arrival_personal_details()
    {
        $this->form_validation->set_rules('first_name[]', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name[]', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('person_category[]', 'Category', 'trim|required');
        $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
            echo json_encode($response);
            exit;
        }
        if ($this->input->post('first_name')[0] <> '') {
            $cnt = count($this->input->post('first_name'));
            $insert_array = [];
            $number_persons = $this->input->post('number_adult');
            $number_child = $this->input->post('number_child');
            for ($i = 0; $i < $cnt; $i++) {
                $insert_array[$i] = [
                    'first_name' => $this->input->post('first_name')[$i],
                    'last_name' => $this->input->post('last_name')[$i],
                    'gender' => $this->input->post('gender')[$i],
                    'category' => $this->input->post('person_category')[$i],
                    'age' => $this->input->post('age')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'created' => date('Y-m-d H:i:s')
                ];

                ($this->input->post('person_category')[$i] == 'adult') ? $number_persons++ : $number_child++;
            }
            $this->common_model->insert_data_batch(['table_name' => 'arrival_persons_details', 'insert_data' => $insert_array]);
            $update_arr = array(
                'number_persons' => $number_persons,
                'number_child' => $number_child
            );
            $id = $this->input->post('id');
            $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }

    public function edit_arrival_personal_details()
    {
        if (!isset($this->input->post('edit_first_name')[0]) || $this->input->post('edit_first_name')[0] == '') {
            $this->form_validation->set_rules('first_name[]', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name[]', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('person_category[]', 'Category', 'trim|required');
            $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
                echo json_encode($response);
                exit;
            }
        }
        $number_persons = $number_child = 0;
        if ($this->input->post('edit_first_name')[0] <> '') {
            $cnt = count($this->input->post('edit_first_name'));
            $update_array = [];
            for ($i = 0; $i < $cnt; $i++) {
                $update_array = [
                    'first_name' => $this->input->post('edit_first_name')[$i],
                    'last_name' => $this->input->post('edit_last_name')[$i],
                    'gender' => $this->input->post('edit_gender')[$i],
                    'category' => $this->input->post('edit_person_category')[$i],
                    'age' => $this->input->post('edit_age')[$i],
                ];

                ($this->input->post('edit_person_category')[$i] == 'adult') ? $number_persons++ : $number_child++;
                $id = $this->input->post('edit_persondetails')[$i];
                $update_data = ['table_name' => 'arrival_persons_details', 'update_data' => $update_array, 'condition' => ['id' => $id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
        }

        if ($this->input->post('first_name')[0] <> '') {
            $cnt = count($this->input->post('first_name'));
            $insert_array = [];

            for ($i = 0; $i < $cnt; $i++) {
                $insert_array[$i] = [
                    'first_name' => $this->input->post('first_name')[$i],
                    'last_name' => $this->input->post('last_name')[$i],
                    'gender' => $this->input->post('gender')[$i],
                    'category' => $this->input->post('person_category')[$i],
                    'age' => $this->input->post('age')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'created' => date('Y-m-d H:i:s')
                ];

                ($this->input->post('person_category')[$i] == 'adult') ? $number_persons++ : $number_child++;
            }
            $this->common_model->insert_data_batch(['table_name' => 'arrival_persons_details', 'insert_data' => $insert_array]);
        }
        $update_arr = array('number_persons' => $number_persons, 'number_child' => $number_child);
        $id = $this->input->post('id');
        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
        echo json_encode($response);
        exit;
    }

    public function arrival_room_details()
    {
        //$this->form_validation->set_rules('hotel_names[]', 'Hotel', 'trim|required');
        $this->form_validation->set_rules('hotel_details_ids[]', 'Hotel id', 'trim|required|integer');
        //$this->form_validation->set_rules('physical_arrival_date[]', 'Arrival Date', 'trim|required');
        $this->form_validation->set_rules('rooms_check_in[]', 'Check-in Date', 'trim|required');
        $this->form_validation->set_rules('rooms_check_out[]', 'Check-out Date', 'trim|required');
        $this->form_validation->set_rules('room_category[]', 'Category', 'trim|required');
        $this->form_validation->set_rules('number_adults[]', 'Number Adults', 'trim|required');
        $this->form_validation->set_rules('number_child[]', 'Number Child', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
            echo json_encode($response);
            exit;
        }

        /*if ($this->input->post('hotels_cnt') != count($this->input->post('confirmation_number')) || $this->input->post('hotels_cnt') != count($this->input->post('hotel_details_ids'))) {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Hotels(' . $this->input->post('hotels_cnt') . ') Details.</div>'];
            echo json_encode($response);
            exit;
        }*/
        $totalpersons = 0;
        for ($k = 0; $k < count($this->input->post('hotel_details_ids'))/*$this->input->post('hotels_cnt')*/; $k++) {
            $totalpersons = $totalpersons + ($this->input->post('number_adults')[$k] + $this->input->post('number_child')[$k]);
        }
        $first_character = substr($this->input->post('enquiry_no'), 0, 1);

        if ((!array_key_exists('first_name', $this->input->post()) || $totalpersons != count($this->input->post('first_name'))) && $first_character != 'G') {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Persons(' . $totalpersons . ') Details.</div>'];
            echo json_encode($response);
            exit;
        }
        //$confirmation_number = $this->input->post('confirmation_number');
        if ($this->input->post('rooms_check_in')[0] <> '') {
            $cnt = count($this->input->post('rooms_check_in'));

            $insert_array = $insert_array_persons = [];
            $start = 0;
            for ($i = 0; $i < $cnt; $i++) {
                $category_id = explode('_',$this->input->post('room_category')[$i]);
                $insert_array = [
                    'arrival_hotel_details_id' => $this->input->post('arrival_hotel_details_ids')[$i],
                    'hotel_id' => $this->input->post('hotel_details_ids')[$i],/*'physical_arrival_date'=>$this->input->post('physical_arrival_date')[$i],*/
                    'checkin_date' => $this->input->post('rooms_check_in')[$i],
                    'checkout_date' => $this->input->post('rooms_check_out')[$i],
                    'category_id' => $category_id[1],
                    'category' => $category_id[0],
                    'number_adults' => $this->input->post('number_adults')[$i],
                    'number_child' => $this->input->post('number_child')[$i],
                    'child_bed' => $this->input->post('child_bed')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'created' => date('Y-m-d H:i:s'),
                    'hotel_confirmation_num' => $this->input->post('confirmation_number')[$i],
                    'breakfast' => $this->input->post('breakfast')[$i]
                ];
                if($first_character == 'G'){
                    $insert_array = $insert_array + ['number_of_rooms'=>$this->input->post('number_rooms')[$i]];
                }
                $id = $this->common_model->insert_data(['table_name' => 'arrival_room_details', 'insert_data' => $insert_array]);
                $total_persons = $this->input->post('number_adults')[$i] + $this->input->post('number_child')[$i];
                $k = '';
                //if($first_character != 'G'){
                if(array_key_exists('first_name', $this->input->post()) && $this->input->post('first_name')[$start]!=''){
                    for ($j = $start; $j < $total_persons + $start; $j++) {
                        $insert_array_persons[$j] = [
                            'first_name' => $this->input->post('first_name')[$j],
                            'last_name' => $this->input->post('last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                            'category' => $this->input->post('person_category')[$j],
                            'age' => $this->input->post('age')[$j],
                            'enquiry_id' => $this->input->post('id'),
                            'passport_number' => $this->input->post('passport_number')[$j],
                            'nationality' => $this->input->post('nationality')[$j],
                            'smoking_status' => $this->input->post('smoking')[$j],
                            'meals' => $this->input->post('meals')[$j],
                            'remarks' => $this->input->post('remarks')[$j],
                            'arrival_room_details_id' => $id,
                            'created' => date('Y-m-d H:i:s')
                        ];
                        $k = $j;
                    }
                    $start = $k + 1;
                    $this->common_model->insert_data_batch(['table_name' => 'arrival_persons_details', 'insert_data' => $insert_array_persons]);
                    $insert_array_persons = [];
                }

            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);

            $smallest_date = strtotime($this->input->post('rooms_check_in')[0]);
            $greatest_date = strtotime($this->input->post('rooms_check_out')[0]);
            for ($i = 0; $i < $cnt; $i++) {
                $d1 = strtotime($this->input->post('rooms_check_in')[$i]);
                if ($smallest_date > $d1) {
                    $smallest_date = $d1;
                }
                $d2 = strtotime($this->input->post('rooms_check_out')[$i]);
                if ($greatest_date < $d2) {
                    $greatest_date = $d2;
                }
            }

            /*$date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            $date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);*/
            $date_checkin = new DateTime(date('Y-m-d', $smallest_date));
            $date_checkout = new DateTime(date('Y-m-d', $greatest_date));

            $interval = $date_checkin->diff($date_checkout);

            $update_arr = array('check_in_date' => date('Y-m-d', $smallest_date), 'check_out_date' => date('Y-m-d', $greatest_date), 'number_of_nights' => $interval->days);
            $id = $this->input->post('id');
            $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }

     // 19 July
    // public function edit_arrival_room_details()
    // {
    //     if (!isset($this->input->post('edit_rooms_check_in')[0]) || $this->input->post('edit_rooms_check_in')[0] == '') {
    //         //$this->form_validation->set_rules('hotel_names[]', 'Hotel', 'trim|required');
    //         //$this->form_validation->set_rules('hotel_ids[]', 'Hotel id', 'trim|required|integer');
    //         $this->form_validation->set_rules('confirmation_number[]', 'Confirmation Number', 'trim|required');
    //         $this->form_validation->set_rules('rooms_check_in[]', 'Check-in Date', 'trim|required');
    //         $this->form_validation->set_rules('rooms_check_out[]', 'Check-out Date', 'trim|required');
    //         $this->form_validation->set_rules('room_category[]', 'Category', 'trim|required');
    //         $this->form_validation->set_rules('number_adults[]', 'Number Adults', 'trim|required');
    //         $this->form_validation->set_rules('number_child[]', 'Number Child', 'trim|required');
    //         if ($this->form_validation->run() === FALSE) {
    //             $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
    //             echo json_encode($response);
    //             exit;
    //         }
    //     }
    //     $first_character = substr($this->input->post('enquiry_no'), 0, 1);
    //     if (array_key_exists('edit_confirmation_number', $this->input->post())) {
    //         if ($this->input->post('hotels_cnt') != count($this->input->post('edit_confirmation_number')) || $this->input->post('hotels_cnt') != count($this->input->post('edit_hotel_details_ids'))) {
    //             /*$new_details_required = $this->input->post('hotels_cnt') - count($this->input->post('edit_confirmation_number'));

    //             if( $new_details_required != count($this->input->post('confirmation_number')) || $new_details_required != count($this->input->post('hotel_details_ids'))){
    //                 $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Please Enter All Hotels('.$this->input->post('hotels_cnt').') Details.</div>'];
    //                 echo json_encode($response);
    //                 exit;
    //             }*/
    //             $totalpersons = 0;
    //             for ($k = 0; $k < count($this->input->post('edit_confirmation_number')); $k++) {
    //                 $totalpersons = $totalpersons + ($this->input->post('edit_number_adults')[$k] + $this->input->post('edit_number_child')[$k]);
    //             }
    //             if ($this->input->post('confirmation_number')[0] != '') {
    //                 for ($k = 0; $k < count($this->input->post('confirmation_number')); $k++) {
    //                     $this->form_validation->set_rules('number_adults[' . $k . ']', 'Number Adults', 'trim|required');
    //                     $this->form_validation->set_rules('number_child[' . $k . ']', 'Number Child', 'trim|required');
    //                     $this->form_validation->set_rules('confirmation_number[' . $k . ']', 'Confirmation Number', 'trim|required');
    //                     if ($this->form_validation->run() === FALSE) {
    //                         $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
    //                         echo json_encode($response);
    //                         exit;
    //                     }
    //                     $totalpersons = $totalpersons + ($this->input->post('number_adults')[$k] + $this->input->post('number_child')[$k]);
    //                 }
    //             }

    //             if (array_key_exists('first_name', $this->input->post()) && array_key_exists('edit_first_name', $this->input->post())) {
    //                 if ($totalpersons != (count($this->input->post('first_name')) + count($this->input->post('edit_first_name')))) {
    //                     $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Persons(' . $totalpersons . ') Details.</div>'];
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //             }
    //             /*for($k=0;$k<count($this->input->post('edit_first_name'));$k++){
    //                 $this->form_validation->set_rules('edit_first_name['.$k.']', 'Number Adults', 'trim|required');
    //                 if($this->form_validation->run() === FALSE){
    //                     $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //             }
    //             for($k=0;$k<count($this->input->post('first_name'));$k++){
    //                 $this->form_validation->set_rules('first_name['.$k.']', 'Number Adults', 'trim|required');
    //                 if($this->form_validation->run() === FALSE){
    //                     $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //             }*/
    //         }
    //     } else {
    //         /*if ($this->input->post('hotels_cnt') != count($this->input->post('confirmation_number')) || $this->input->post('hotels_cnt') != count($this->input->post('hotel_details_ids'))) {
    //             $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Hotels(' . $this->input->post('hotels_cnt') . ') Details.</div>'];
    //             echo json_encode($response);
    //             exit;
    //         }*/
    //         $totalpersons = 0;
    //         for ($k = 0; $k < count($this->input->post('hotel_details_ids'))/*$this->input->post('hotels_cnt')*/; $k++) {
    //             $totalpersons = $totalpersons + ($this->input->post('number_adults')[$k] + $this->input->post('number_child')[$k]);
    //         }


    //         if ((!array_key_exists('first_name', $this->input->post()) || $totalpersons != count($this->input->post('first_name'))) && $first_character != 'G') {
    //             $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Persons(' . $totalpersons . ') Details.</div>'];
    //             echo json_encode($response);
    //             exit;
    //         }
    //     }
    //     //echo 'w';exit;
    //     if (array_key_exists('edit_rooms_check_in', $this->input->post()) && $this->input->post('edit_rooms_check_in')[0] <> '') {
    //         $cnt = count($this->input->post('edit_rooms_check_in'));
    //         $update_array = $update_array_persons = [];
    //         $start = 0;

    //         for ($i = 0; $i < $cnt; $i++) {
    //             $update_array = [
    //                 'arrival_hotel_details_id' => $this->input->post('edit_arrival_hotel_details_ids')[$i],
    //                 'hotel_id' => $this->input->post('edit_hotel_details_ids')[$i],
    //                 'category_id' => $this->input->post('room_category_id')[$i],
    //                 /*'physical_arrival_date'=>$this->input->post('edit_physical_arrival_date')[$i],*/
    //                 'checkin_date' => $this->input->post('edit_rooms_check_in')[$i],
    //                 'checkout_date' => $this->input->post('edit_rooms_check_out')[$i],
    //                 'category' => $this->input->post('edit_room_category')[$i],
    //                 'number_adults' => $this->input->post('edit_number_adults')[$i],
    //                 'number_child' => $this->input->post('edit_number_child')[$i],
    //                 'child_bed' => $this->input->post('edit_child_bed')[$i],
    //                 'hotel_confirmation_num' => $this->input->post('edit_confirmation_number')[$i],
    //                 'breakfast' => $this->input->post('edit_breakfast')[$i]
    //             ];
    //             if($first_character == 'G'){
    //                 $update_array = $update_array + ['number_of_rooms'=>$this->input->post('edit_number_rooms')[$i]];
    //             }
    //             $id = $this->input->post('edit_roomdetails')[$i];
    //             $update_data = ['table_name' => 'arrival_room_details', 'update_data' => $update_array, 'condition' => ['id' => $id]];
    //             $affected_rows = $this->common_model->update_data_limit($update_data);

    //             //if($first_character != 'G'){
    //             if(array_key_exists('edit_first_name', $this->input->post()) && $this->input->post('edit_first_name')[$start] != ''){

    //                 $total_persons = $this->input->post('edit_number_adults')[$i] + $this->input->post('edit_number_child')[$i];
    //                 $k = '';
    //                 for ($j = $start; $j < $total_persons + $start; $j++) {
    //                     $update_array_persons = [
    //                         'first_name' => $this->input->post('edit_first_name')[$j],
    //                         'last_name' => $this->input->post('edit_last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
    //                         'category' => $this->input->post('edit_person_category')[$j],
    //                         'age' => $this->input->post('edit_age')[$j],
    //                         'enquiry_id' => $this->input->post('id'),
    //                         'passport_number' => $this->input->post('edit_passport_number')[$j],
    //                         'nationality' => $this->input->post('edit_nationality')[$j],
    //                         'smoking_status' => $this->input->post('edit_smoking')[$j],
    //                         'meals' => $this->input->post('edit_meals')[$j],
    //                         'remarks' => $this->input->post('edit_remarks')[$j],
    //                         'arrival_room_details_id' => $id,
    //                         'created' => date('Y-m-d H:i:s')
    //                     ];
    //                     $update_data_persons = ['table_name' => 'arrival_persons_details', 'update_data' => $update_array_persons, 'condition' => ['id' => $this->input->post('edit_person_details')[$j]]];
    //                     $this->common_model->update_data_limit($update_data_persons);
    //                     $k = $j;
    //                 }
    //                 $start = $k + 1;
    //                 $update_array_persons = [];
    //             }
    //         }
    //     }

    //     if ($this->input->post('rooms_check_in')[0] <> '') {
    //         $cnt = count($this->input->post('rooms_check_in'));
    //         $insert_array = $insert_array_persons = [];
    //         $start = 0;//echo '<pre>';print_r($this->input->post());exit;
    //         for ($i = 0; $i < $cnt; $i++) {
    //             $this->form_validation->set_rules('rooms_check_in[' . $i . ']', 'Check-in Date', 'trim|required');
    //             $this->form_validation->set_rules('rooms_check_out[' . $i . ']', 'Check-out Date', 'trim|required');
    //             $this->form_validation->set_rules('room_category[' . $i . ']', 'Category', 'trim|required');
    //             $this->form_validation->set_rules('number_adults[' . $i . ']', 'Number Adults', 'trim|required');
    //             $this->form_validation->set_rules('number_child[' . $i . ']', 'Number Child', 'trim|required');
    //             $this->form_validation->set_rules('confirmation_number[' . $i . ']', 'Confirmation Number', 'trim|required');
    //             if ($this->form_validation->run() === FALSE) {
    //                 $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
    //                 //echo json_encode($response);
    //                 continue;
    //             }

    //             $insert_array = [
    //                 'arrival_hotel_details_id' => $this->input->post('arrival_hotel_details_ids')[$i],
    //                 'hotel_id' => $this->input->post('hotel_details_ids')[$i],/*'physical_arrival_date'=>$this->input->post('physical_arrival_date')[$i],*/
    //                 'category_id' => $this->input->post('room_category_id')[$i],
    //                 'checkin_date' => $this->input->post('rooms_check_in')[$i],
    //                 'checkout_date' => $this->input->post('rooms_check_out')[$i],
    //                 'category' => $this->input->post('room_category')[$i],
    //                 'number_adults' => $this->input->post('number_adults')[$i],
    //                 'number_child' => $this->input->post('number_child')[$i],
    //                 'child_bed' => $this->input->post('child_bed')[$i],
    //                 'enquiry_id' => $this->input->post('id'),
    //                 'created' => date('Y-m-d H:i:s'),
    //                 'hotel_confirmation_num' => $this->input->post('confirmation_number')[$i],
    //                 'breakfast' => $this->input->post('breakfast')[$i]
    //             ];
    //             if($first_character == 'G'){
    //                 $insert_array = $insert_array + ['number_of_rooms'=>$this->input->post('number_rooms')[$i]];
    //             }
    //             $id = $this->common_model->insert_data(['table_name' => 'arrival_room_details', 'insert_data' => $insert_array]);
    //             $total_persons = $this->input->post('number_adults')[$i] + $this->input->post('number_child')[$i];

    //             //if($first_character != 'G'){
    //             if(array_key_exists('first_name', $this->input->post()) && $this->input->post('first_name')[$start] != ''){
    //                 $k = '';
    //                 for ($j = $start; $j < $total_persons + $start; $j++) {
    //                     $insert_array_persons[$j] = [
    //                         'first_name' => $this->input->post('first_name')[$j],
    //                         'last_name' => $this->input->post('last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
    //                         'category' => $this->input->post('person_category')[$j],
    //                         'age' => $this->input->post('age')[$j],
    //                         'enquiry_id' => $this->input->post('id'),
    //                         'passport_number' => $this->input->post('passport_number')[$j],
    //                         'nationality' => $this->input->post('nationality')[$j],
    //                         'smoking_status' => $this->input->post('smoking')[$j],
    //                         'meals' => $this->input->post('meals')[$j],
    //                         'remarks' => $this->input->post('remarks')[$j],
    //                         'arrival_room_details_id' => $id,
    //                         'created' => date('Y-m-d H:i:s')
    //                     ];
    //                     $k = $j;
    //                 }
    //                 $start = $k + 1;
    //                 $this->common_model->insert_data_batch(['table_name' => 'arrival_persons_details', 'insert_data' => $insert_array_persons]);
    //                 $insert_array_persons = [];
    //             }
    //         }
    //         //$this->common_model->insert_data_batch(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);

    //     }
    //     /*$edit_cnt = array_key_exists('edit_rooms_check_in', $this->input->post()) ? count($this->input->post('edit_rooms_check_in')) : 0;

    //     if ($this->input->post('confirmation_number')[0] != '') {
    //         $cnt_rooms = count($this->input->post('rooms_check_in'));
    //     } else {
    //         $cnt_rooms = 0;
    //     }
    //     $smallest_date = $greatest_date = '';
    //     if ($edit_cnt > 0) {
    //         $smallest_date = strtotime($this->input->post('edit_rooms_check_in')[0]);
    //         $greatest_date = strtotime($this->input->post('edit_rooms_check_out')[0]);
    //         for ($i = 0; $i < $edit_cnt; $i++) {
    //             $d1 = strtotime($this->input->post('edit_rooms_check_in')[$i]);
    //             if ($smallest_date > $d1) {
    //                 $smallest_date = $d1;
    //             }
    //             $d2 = strtotime($this->input->post('edit_rooms_check_out')[$i]);
    //             if ($greatest_date < $d2) {
    //                 $greatest_date = $d2;
    //             }
    //         }
    //     }

    //     if ($cnt_rooms > 0) {
    //         if ($smallest_date == '' && $greatest_date == '') {
    //             $smallest_date = strtotime($this->input->post('rooms_check_in')[0]);
    //             $greatest_date = strtotime($this->input->post('rooms_check_out')[0]);
    //         }
    //         for ($i = 0; $i < $cnt_rooms; $i++) {
    //             $d1 = strtotime($this->input->post('rooms_check_in')[$i]);
    //             if ($smallest_date > $d1) {
    //                 $smallest_date = $d1;
    //             }
    //             $d2 = strtotime($this->input->post('rooms_check_out')[$i]);
    //             if ($greatest_date < $d2) {
    //                 $greatest_date = $d2;
    //             }
    //         }
    //     }

    //     //$checkin = (array_key_exists('edit_rooms_check_in',$this->input->post()) && $this->input->post('edit_rooms_check_in')[0]<>'')?$this->input->post('edit_rooms_check_in')[0]:$this->input->post('rooms_check_in')[0];
    //     //$checkout = ($this->input->post('rooms_check_in')[0]<>'')?$this->input->post('rooms_check_out')[$cnt_rooms-1]:$this->input->post('edit_rooms_check_out')[$edit_cnt-1];

    //     $date_checkin = new DateTime(date('Y-m-d', $smallest_date));
    //     $date_checkout = new DateTime(date('Y-m-d', $greatest_date));
    //     $interval = $date_checkin->diff($date_checkout);

    //     $update_arr = array('check_in_date' => date('Y-m-d', $smallest_date), 'check_out_date' => date('Y-m-d', $greatest_date), 'number_of_nights' => $interval->days);
    //     $id = $this->input->post('id');
    //     $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
    //     $affected_rows = $this->common_model->update_data_limit($update_data);*/

    //     $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
    //     echo json_encode($response);
    //     exit;
    // }

    public function edit_arrival_room_details()
    {
        if (!isset($this->input->post('edit_rooms_check_in')[0]) || $this->input->post('edit_rooms_check_in')[0] == '') {
            //$this->form_validation->set_rules('hotel_names[]', 'Hotel', 'trim|required');
            //$this->form_validation->set_rules('hotel_ids[]', 'Hotel id', 'trim|required|integer');
            $this->form_validation->set_rules('confirmation_number[]', 'Confirmation Number', 'trim|required');
            $this->form_validation->set_rules('rooms_check_in[]', 'Check-in Date', 'trim|required');
            $this->form_validation->set_rules('rooms_check_out[]', 'Check-out Date', 'trim|required');
            $this->form_validation->set_rules('room_category[]', 'Category', 'trim|required');
            $this->form_validation->set_rules('number_adults[]', 'Number Adults', 'trim|required');
            $this->form_validation->set_rules('number_child[]', 'Number Child', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
                log_user_activity('Query Board Rooming List add/ Edit',$this->session->userdata('id'), 'Error: '.validation_errors());
                echo json_encode($response);
                exit;
            }
        }
        $first_character = substr($this->input->post('enquiry_no'), 0, 1);
        if (array_key_exists('edit_confirmation_number', $this->input->post())) {
            if ($this->input->post('hotels_cnt') != count($this->input->post('edit_confirmation_number')) || $this->input->post('hotels_cnt') != count($this->input->post('edit_hotel_details_ids'))) {
                /*$new_details_required = $this->input->post('hotels_cnt') - count($this->input->post('edit_confirmation_number'));

                if( $new_details_required != count($this->input->post('confirmation_number')) || $new_details_required != count($this->input->post('hotel_details_ids'))){
                    $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Please Enter All Hotels('.$this->input->post('hotels_cnt').') Details.</div>'];
                    echo json_encode($response);
                    exit;
                }*/
                $totalpersons = 0;
                for ($k = 0; $k < count($this->input->post('edit_confirmation_number')); $k++) {
                    $totalpersons = $totalpersons + ($this->input->post('edit_number_adults')[$k] + $this->input->post('edit_number_child')[$k]);
                }
                if ($this->input->post('confirmation_number')[0] != '') {
                    for ($k = 0; $k < count($this->input->post('confirmation_number')); $k++) {
                        $this->form_validation->set_rules('number_adults[' . $k . ']', 'Number Adults', 'trim|required');
                        $this->form_validation->set_rules('number_child[' . $k . ']', 'Number Child', 'trim|required');
                        $this->form_validation->set_rules('confirmation_number[' . $k . ']', 'Confirmation Number', 'trim|required');
                        if ($this->form_validation->run() === FALSE) {
                            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
                            echo json_encode($response);
                            exit;
                        }
                        $totalpersons = $totalpersons + ($this->input->post('number_adults')[$k] + $this->input->post('number_child')[$k]);
                    }
                }

                if (array_key_exists('first_name', $this->input->post()) && array_key_exists('edit_first_name', $this->input->post())) {
                    if ($totalpersons != (count($this->input->post('first_name')) + count($this->input->post('edit_first_name')))) {
                        $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Persons(' . $totalpersons . ') Details.</div>'];
                        echo json_encode($response);
                        exit;
                    }
                }
                /*for($k=0;$k<count($this->input->post('edit_first_name'));$k++){
                    $this->form_validation->set_rules('edit_first_name['.$k.']', 'Number Adults', 'trim|required');
                    if($this->form_validation->run() === FALSE){
                        $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
                        echo json_encode($response);
                        exit;
                    }
                }
                for($k=0;$k<count($this->input->post('first_name'));$k++){
                    $this->form_validation->set_rules('first_name['.$k.']', 'Number Adults', 'trim|required');
                    if($this->form_validation->run() === FALSE){
                        $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
                        echo json_encode($response);
                        exit;
                    }
                }*/
            }
        } else {
            /*if ($this->input->post('hotels_cnt') != count($this->input->post('confirmation_number')) || $this->input->post('hotels_cnt') != count($this->input->post('hotel_details_ids'))) {
                $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Hotels(' . $this->input->post('hotels_cnt') . ') Details.</div>'];
                echo json_encode($response);
                exit;
            }*/
            $totalpersons = 0;
            for ($k = 0; $k < count($this->input->post('hotel_details_ids'))/*$this->input->post('hotels_cnt')*/; $k++) {
                $totalpersons = $totalpersons + ($this->input->post('number_adults')[$k] + $this->input->post('number_child')[$k]);
            }


            if ((!array_key_exists('first_name', $this->input->post()) || $totalpersons != count($this->input->post('first_name'))) && $first_character != 'G') {
                $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Please Enter All Persons(' . $totalpersons . ') Details.</div>'];
                echo json_encode($response);
                exit;
            }
        }
        //echo 'w';exit;
        if (array_key_exists('edit_rooms_check_in', $this->input->post()) && $this->input->post('edit_rooms_check_in')[0] <> '') {
            $cnt = count($this->input->post('edit_rooms_check_in'));
            $update_array = $update_array_persons = [];
            $start = 0;

            for ($i = 0; $i < $cnt; $i++) {
                $category_id = explode('_', $this->input->post('edit_room_category')[$i]);

                $update_array = [
                    'arrival_hotel_details_id' => $this->input->post('edit_arrival_hotel_details_ids')[$i],
                    'hotel_id' => $this->input->post('edit_hotel_details_ids')[$i],
                    'category_id' => $category_id[1],
                    'category' => $category_id[0],
                    /*'physical_arrival_date'=>$this->input->post('edit_physical_arrival_date')[$i],*/
                    'checkin_date' => $this->input->post('edit_rooms_check_in')[$i],
                    'checkout_date' => $this->input->post('edit_rooms_check_out')[$i],

                    'number_adults' => $this->input->post('edit_number_adults')[$i],
                    'number_child' => $this->input->post('edit_number_child')[$i],
                    'child_bed' => $this->input->post('edit_child_bed')[$i],
                    'hotel_confirmation_num' => $this->input->post('edit_confirmation_number')[$i],
                    'breakfast' => $this->input->post('edit_breakfast')[$i]
                ];
                if($first_character == 'G'){
                    $update_array = $update_array + ['number_of_rooms'=>$this->input->post('edit_number_rooms')[$i]];
                }
                $id = $this->input->post('edit_roomdetails')[$i];
                $update_data = ['table_name' => 'arrival_room_details', 'update_data' => $update_array, 'condition' => ['id' => $id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);

                //if($first_character != 'G'){
                if(array_key_exists('edit_first_name', $this->input->post()) && $this->input->post('edit_first_name')[$start] != ''){

                    $total_persons = $this->input->post('edit_number_adults')[$i] + $this->input->post('edit_number_child')[$i];
                    $k = '';
                    for ($j = $start; $j < $total_persons + $start; $j++) {
                        $update_array_persons = [
                            'first_name' => $this->input->post('edit_first_name')[$j],
                            'last_name' => $this->input->post('edit_last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                            'category' => $this->input->post('edit_person_category')[$j],
                            'age' => $this->input->post('edit_age')[$j],
                            'enquiry_id' => $this->input->post('id'),
                            'passport_number' => $this->input->post('edit_passport_number')[$j],
                            'nationality' => $this->input->post('edit_nationality')[$j],
                            'smoking_status' => $this->input->post('edit_smoking')[$j],
                            'meals' => $this->input->post('edit_meals')[$j],
                            'remarks' => $this->input->post('edit_remarks')[$j],
                            'arrival_room_details_id' => $id,
                            'created' => date('Y-m-d H:i:s')
                        ];
                        $update_data_persons = ['table_name' => 'arrival_persons_details', 'update_data' => $update_array_persons, 'condition' => ['id' => $this->input->post('edit_person_details')[$j]]];
                        $this->common_model->update_data_limit($update_data_persons);
                        $k = $j;
                    }
                    $start = $k + 1;
                    $update_array_persons = [];
                }
            }
        }

        if ($this->input->post('rooms_check_in')[0] <> '') {
            $cnt = count($this->input->post('rooms_check_in'));
            $insert_array = $insert_array_persons = [];
            $start = 0;  //echo '<pre>';print_r($this->input->post());exit;
            for ($i = 0; $i < $cnt; $i++) {
                $this->form_validation->set_rules('rooms_check_in[' . $i . ']', 'Check-in Date', 'trim|required');
                $this->form_validation->set_rules('rooms_check_out[' . $i . ']', 'Check-out Date', 'trim|required');
                $this->form_validation->set_rules('room_category[' . $i . ']', 'Category', 'trim|required');
                $this->form_validation->set_rules('number_adults[' . $i . ']', 'Number Adults', 'trim|required');
                $this->form_validation->set_rules('number_child[' . $i . ']', 'Number Child', 'trim|required');
                $this->form_validation->set_rules('confirmation_number[' . $i . ']', 'Confirmation Number', 'trim|required');
                if ($this->form_validation->run() === FALSE) {
                    $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
                    //echo json_encode($response);
                    continue;
                }

                $category_id = explode('_', $this->input->post('room_category')[$i]);

                $insert_array = [
                    'arrival_hotel_details_id' => $this->input->post('arrival_hotel_details_ids')[$i],
                    'hotel_id' => $this->input->post('hotel_details_ids')[$i],/*'physical_arrival_date'=>$this->input->post('physical_arrival_date')[$i],*/
                    'category_id' => $category_id[1],
                    'checkin_date' => $this->input->post('rooms_check_in')[$i],
                    'checkout_date' => $this->input->post('rooms_check_out')[$i],
                    'category' => $category_id[0],
                    'number_adults' => $this->input->post('number_adults')[$i],
                    'number_child' => $this->input->post('number_child')[$i],
                    'child_bed' => $this->input->post('child_bed')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'created' => date('Y-m-d H:i:s'),
                    'hotel_confirmation_num' => $this->input->post('confirmation_number')[$i],
                    'breakfast' => $this->input->post('breakfast')[$i]
                ];
                if($first_character == 'G'){
                    $insert_array = $insert_array + ['number_of_rooms'=>$this->input->post('number_rooms')[$i]];
                }
                $id = $this->common_model->insert_data(['table_name' => 'arrival_room_details', 'insert_data' => $insert_array]);
                $total_persons = $this->input->post('number_adults')[$i] + $this->input->post('number_child')[$i];

                //if($first_character != 'G'){
                if(array_key_exists('first_name', $this->input->post()) && $this->input->post('first_name')[$start] != ''){
                    $k = '';
                    for ($j = $start; $j < $total_persons + $start; $j++) {
                        $insert_array_persons[$j] = [
                            'first_name' => $this->input->post('first_name')[$j],
                            'last_name' => $this->input->post('last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                            'category' => $this->input->post('person_category')[$j],
                            'age' => $this->input->post('age')[$j],
                            'enquiry_id' => $this->input->post('id'),
                            'passport_number' => $this->input->post('passport_number')[$j],
                            'nationality' => $this->input->post('nationality')[$j],
                            'smoking_status' => $this->input->post('smoking')[$j],
                            'meals' => $this->input->post('meals')[$j],
                            'remarks' => $this->input->post('remarks')[$j],
                            'arrival_room_details_id' => $id,
                            'created' => date('Y-m-d H:i:s')
                        ];
                        $k = $j;
                    }
                    $start = $k + 1;
                    $this->common_model->insert_data_batch(['table_name' => 'arrival_persons_details', 'insert_data' => $insert_array_persons]);
                    $insert_array_persons = [];
                }
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);

        }
        /*$edit_cnt = array_key_exists('edit_rooms_check_in', $this->input->post()) ? count($this->input->post('edit_rooms_check_in')) : 0;

        if ($this->input->post('confirmation_number')[0] != '') {
            $cnt_rooms = count($this->input->post('rooms_check_in'));
        } else {
            $cnt_rooms = 0;
        }
        $smallest_date = $greatest_date = '';
        if ($edit_cnt > 0) {
            $smallest_date = strtotime($this->input->post('edit_rooms_check_in')[0]);
            $greatest_date = strtotime($this->input->post('edit_rooms_check_out')[0]);
            for ($i = 0; $i < $edit_cnt; $i++) {
                $d1 = strtotime($this->input->post('edit_rooms_check_in')[$i]);
                if ($smallest_date > $d1) {
                    $smallest_date = $d1;
                }
                $d2 = strtotime($this->input->post('edit_rooms_check_out')[$i]);
                if ($greatest_date < $d2) {
                    $greatest_date = $d2;
                }
            }
        }

        if ($cnt_rooms > 0) {
            if ($smallest_date == '' && $greatest_date == '') {
                $smallest_date = strtotime($this->input->post('rooms_check_in')[0]);
                $greatest_date = strtotime($this->input->post('rooms_check_out')[0]);
            }
            for ($i = 0; $i < $cnt_rooms; $i++) {
                $d1 = strtotime($this->input->post('rooms_check_in')[$i]);
                if ($smallest_date > $d1) {
                    $smallest_date = $d1;
                }
                $d2 = strtotime($this->input->post('rooms_check_out')[$i]);
                if ($greatest_date < $d2) {
                    $greatest_date = $d2;
                }
            }
        }

        //$checkin = (array_key_exists('edit_rooms_check_in',$this->input->post()) && $this->input->post('edit_rooms_check_in')[0]<>'')?$this->input->post('edit_rooms_check_in')[0]:$this->input->post('rooms_check_in')[0];
        //$checkout = ($this->input->post('rooms_check_in')[0]<>'')?$this->input->post('rooms_check_out')[$cnt_rooms-1]:$this->input->post('edit_rooms_check_out')[$edit_cnt-1];

        $date_checkin = new DateTime(date('Y-m-d', $smallest_date));
        $date_checkout = new DateTime(date('Y-m-d', $greatest_date));
        $interval = $date_checkin->diff($date_checkout);

        $update_arr = array('check_in_date' => date('Y-m-d', $smallest_date), 'check_out_date' => date('Y-m-d', $greatest_date), 'number_of_nights' => $interval->days);
        $id = $this->input->post('id');
        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);*/

        $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
        log_user_activity('Query Board Rooming List add/ Edit',$this->session->userdata('id'), 'Query Board : Rooming List add/ Edit');

        echo json_encode($response);
        exit;
    }

    public function arrival_flight_details()
    {
        $this->form_validation->set_rules('airline_name[]', 'Airline', 'trim|required');
        $this->form_validation->set_rules('airline_ids[]', 'Airline id', 'trim|required|integer');
        $this->form_validation->set_rules('flight_number[]', 'Flight Number', 'trim|required');
        //$this->form_validation->set_rules('flight_type[]', 'Flight Type', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
            echo json_encode($response);
            exit;
        }
        if ($this->input->post('flight_number')[0] <> '') {
            $cnt = count($this->input->post('flight_number'));
            $insert_array = [];
            for ($i = 0; $i < $cnt; $i++) {
                $insert_array[$i] = [
                    'airline_id' => $this->input->post('airline_ids')[$i],
                    'flight_number' => $this->input->post('flight_number')[$i],/*'flight_type'=>$this->input->post('flight_type')[$i],*/
                    'departure_airport' => $this->input->post('departure_airport')[$i],
                    'departure_city' => $this->input->post('departure_city')[$i],
                    'departure_date' => $this->input->post('departure_date')[$i],
                    'departure_time' => $this->input->post('departure_time')[$i],
                    'arrival_city' => $this->input->post('arrival_city')[$i],
                    'arrival_date' => $this->input->post('arrival_date')[$i],
                    'arrival_time' => $this->input->post('arrival_time')[$i],
                    'number_persons' => $this->input->post('number_persons')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'flight_mode' => $this->input->post('flight_mode')[$i],
                    'created' => date('Y-m-d H:i:s')
                ];
            }
            $this->common_model->insert_data_batch(['table_name' => 'arrival_flight_details', 'insert_data' => $insert_array]);

            //$date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            //$date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);
            //$interval = $date_checkin->diff($date_checkout);
            $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }

    public function edit_arrival_flight_details()
    {
        if (!isset($this->input->post('edit_flight_number')[0]) || $this->input->post('edit_flight_number')[0] == '') {
            $this->form_validation->set_rules('airline_name[]', 'Airline', 'trim|required');
            $this->form_validation->set_rules('airline_ids[]', 'Airline id', 'trim|required|integer');
            $this->form_validation->set_rules('flight_number[]', 'Flight Number', 'trim|required');
            //$this->form_validation->set_rules('flight_type[]', 'Flight Type', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
                log_user_activity('Query Booad: Update',$this->session->userdata('id'), 'Error: '.validation_errors() );
                echo json_encode($response);
                exit;
            }
        }

        if (isset($this->input->post('edit_flight_number')[0]) && $this->input->post('edit_flight_number')[0] <> '') {
            $cnt = count($this->input->post('edit_flight_number'));
            $update_array = [];


            for ($i = 0; $i < $cnt; $i++) {
            // $where='id='.$this->input->post('edit_flightdetails'.[$i]);
            $id = $this->input->post('edit_flightdetails')[$i];  // FIXED
            $where = 'id=' . $id;
            $existing = $this->db
                ->where('id', $id)
                ->get('arrival_flight_details')
                ->row_array();
            // $existing = $this->common_model->get_single(['table_name' => 'arrival_flight_details', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'airline_id' => $existing['airline_id'],
                    'flight_number'         => $existing['flight_number'],
                    'departure_airport'         => $existing['departure_airport'],
                    'departure_city'         => $existing['departure_city'],
                    'departure_date'         => $existing['departure_date'],
                    'departure_time'         => $existing['departure_time'],
                    'arrival_city'         => $existing['arrival_city'],
                    'arrival_date'         => $existing['arrival_date'],
                    'arrival_time'         => $existing['arrival_time'],
                    'number_persons'         => $existing['number_persons'],
                    'flight_mode' => $existing['flight_mode'],
                ];
            } else {
                $previous_data = []; 
            }
                $update_array = [
                    'airline_id' => $this->input->post('edit_airline_ids')[$i],
                    'flight_number' => $this->input->post('edit_flight_number')[$i],/*'flight_type'=>$this->input->post('edit_flight_type')[$i],*/
                    'departure_airport' => $this->input->post('edit_departure_airport')[$i],
                    'departure_city' => $this->input->post('edit_departure_city')[$i],
                    'departure_date' => $this->input->post('edit_departure_date')[$i],
                    'departure_time' => $this->input->post('edit_departure_time')[$i],
                    'arrival_city' => $this->input->post('edit_arrival_city')[$i],
                    'arrival_date' => $this->input->post('edit_arrival_date')[$i],
                    'arrival_time' => $this->input->post('edit_arrival_time')[$i],
                    'number_persons' => $this->input->post('edit_number_persons')[$i],
                    'flight_mode' => $this->input->post('edit_flight_mode')[$i]
                ];
                $id = $this->input->post('edit_flightdetails')[$i];
                $update_data = ['table_name' => 'arrival_flight_details', 'update_data' => $update_array, 'condition' => ['id' => $id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
            log_user_activity('Query Board Flight Details Update',$this->session->userdata('id'), 'Previous Data: )'.json_encode($previous_data));

        }

        if ($this->input->post('airline_name')[0] <> '') {
            $cnt = count($this->input->post('flight_number'));
            $insert_array = [];
            for ($i = 0; $i < $cnt; $i++) {
                $insert_array[$i] = [
                    'airline_id' => $this->input->post('airline_ids')[$i],
                    'flight_number' => $this->input->post('flight_number')[$i]/*,'flight_type'=>$this->input->post('flight_type')[$i]*/ ,
                    'departure_airport' => $this->input->post('departure_airport')[$i],
                    'departure_city' => $this->input->post('departure_city')[$i],
                    'departure_date' => $this->input->post('departure_date')[$i],
                    'departure_time' => $this->input->post('departure_time')[$i],
                    'arrival_city' => $this->input->post('arrival_city')[$i],
                    'arrival_date' => $this->input->post('arrival_date')[$i],
                    'arrival_time' => $this->input->post('arrival_time')[$i],
                    'number_persons' => $this->input->post('number_persons')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'flight_mode' => $this->input->post('flight_mode')[$i],
                    'created' => date('Y-m-d H:i:s'),
                    'arrival_id'=>$this->input->post('arrival_id')
                ];
            }
            $this->common_model->insert_data_batch(['table_name' => 'arrival_flight_details', 'insert_data' => $insert_array]);
            //$date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            //$date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);
            log_user_activity('Query Board Flight Details Add New',$this->session->userdata('id'), 'Flight Details Add: )'.json_encode($insert_array));
            //$interval = $date_checkin->diff($date_checkout);
        }
        $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Details Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }

    public function edit_remove_details()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('module_id', 'ID', 'required|integer');
        $this->form_validation->set_rules('enq_id', 'Enquiry ID', 'required|integer');
        $this->form_validation->set_rules('module', 'Module', 'required');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $tbl_arr = [
            'person_details' => ['col_name' => 'enquiry_id', 'tbl' => 'arrival_persons_details'],
            'room_details' => ['col_name' => 'enquiry_id', 'tbl' => 'arrival_room_details'],
            'flight_details' => ['col_name' => 'enquiry_id', 'tbl' => 'arrival_flight_details'],
            'arrival_hotels' => ['col_name' => 'enquiry_id', 'tbl' => 'arrival_hotel_details']
        ];
        $this->db->limit(1);
        $this->db->where(['id' => $this->input->post('module_id'), $tbl_arr[$this->input->post('module')]['col_name'] => $this->input->post('enq_id')]);
        $this->db->delete($tbl_arr[$this->input->post('module')]['tbl']);

        if ($this->input->post('module') == 'room_details') {
            $this->db->where(['arrival_room_details_id' => $this->input->post('module_id'), $tbl_arr[$this->input->post('module')]['col_name'] => $this->input->post('enq_id')]);
            $this->db->delete('arrival_persons_details');
            if($this->input->post('room_category_id') <> '' && $this->input->post('arrival_id') <> '' && $this->input->post('hotel_id') <> ''){
                $category_id = explode('_',$this->input->post('room_category_id'))[1];
                $arrival_id = base64_decode($this->input->post('arrival_id'));
                $this->db->where(['hotel_id' => $this->input->post('hotel_id'), 'category_id' => $category_id,'arrival_id'=>$arrival_id]);
                $this->db->delete('room_costing_price');
            }

        }

        $response = ['response' => 's', 'details' => '', 'msg' => 'Deleted Successfully!'];
        echo json_encode($response);
        exit;
    }

    public function edit_remove_hotel_details()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('enq_id', 'Enquiry ID', 'required|integer');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $id = $this->input->post('id');
        $select = 'arrival_room_details.id';
        $where = 'arrival_room_details.arrival_hotel_details_id = ' . $id;
        $arrival_room_details = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, '', $count = false);
        if (!empty($arrival_room_details)) {
            $arrival_room_details = $arrival_room_details[0];
            $this->db->where('arrival_persons_details.arrival_room_details_id', $arrival_room_details->id);
            $this->db->delete('arrival_persons_details');

            $this->db->limit(1);
            $this->db->where(['arrival_room_details.arrival_hotel_details_id' => $id]);
            $this->db->delete('arrival_room_details');
        }
        $this->db->limit(1);
        $this->db->where(['arrival_hotel_details.id' => $id]);
        $this->db->delete('arrival_hotel_details');

        $response = ['response' => 's', 'details' => '', 'msg' => 'Deleted Successfully!'];
        echo json_encode($response);
        exit;
    }

    public function print_arrivals()
    {
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id=' . $id;
        // $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,hotels.city,hotels.state,';
        // $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,company.company_logo,';
        // $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,transportation.luggage_transport,';
        // $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $select = "
            arrivals.*,
            enquiry.enquiry_no,
            enquiry.enquiry_abbr,
            enquiry.number_of_nights,
            hotels.name AS hotel_name,
            hotels.address_1,
            hotels.address_2,
            hotels.city,
            hotels.state,
            
            -- Check-in date conditionally from combo or enquiry
            CASE 
                WHEN arrivals.combo_enquiry_id IS NOT NULL AND arrivals.combo_enquiry_id != '' 
                THEN combo_enquiry.check_in_date 
                ELSE enquiry.check_in_date 
            END AS check_in_date,
        
            -- Check-out date conditionally from combo or enquiry
            CASE 
                WHEN arrivals.combo_enquiry_id IS NOT NULL AND arrivals.combo_enquiry_id != '' 
                THEN combo_enquiry.check_out_date 
                ELSE enquiry.check_out_date 
            END AS check_out_date,
        
            company.name AS filename,
            company.company_logo,
        
            transportation.vehicle_type,
            transportation.capacity,
            transportation.remarks,
            transportation.vehicle_name,
            transportation.luggage_transport,
        
            guides.name AS guide,
            guides.gender,
            guides.isd_codes,
            guides.contact_number,
            guides.location,
            guides.remarks AS guide_remarks,
            guides.photo
        ";

        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        $data['arrivals'] = $arrivals[0];
        
        if(substr($data['arrivals']->enquiry_abbr,0,1) == 'G' && $data['arrivals']->split_number != 0){
            $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$data['arrivals']->id;
            $qry_result = $this->common_model->custom_query($qry);
            if(!empty($qry_result)){
               $data['arrivals']->check_in_date = $qry_result[0]->chk_in;
               $data['arrivals']->check_out_date = $qry_result[0]->chk_out;
            }
        }
        
        $where = 'arrival_persons_details.enquiry_id= ' . $arrivals[0]->enquiry_id;
        $data['arrival_persons'] = $this->common_model->get_data('arrival_persons_details', '', '', '*', $where, '', $count = false);

        if(empty($data['arrival_persons'])){
            
            $select = 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
            $where = 'arrival_hotel_details.arrival_id= ' . $arrivals[0]->id;
            $join = [
                ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],
                ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
            ];
            $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, '', $count = false, $join);
            
            if(empty($data['arrival_room']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
                $select = 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
                $where = 'arrival_room_details.enquiry_id= ' . $arrivals[0]->enquiry_id;
                $join = [
                    ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                ];
                $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, '', $count = false, $join);
            }
        }else{
            // old code of 04 jan 2026
            // $select = 'GROUP_CONCAT(arrival_persons_details.first_name," ",arrival_persons_details.last_name,IF(arrival_persons_details.category!="adult", CONCAT("(",arrival_persons_details.age,")") ,"") SEPARATOR ", ") AS persons_details,';
            // $select .= 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
            // $where = 'arrival_hotel_details.arrival_id= ' . $arrivals[0]->id;
            // $join = [
            //     ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],
            //     ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
            //     ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id  = arrival_room_details.id'],
            // ];
            // $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, ' GROUP BY arrival_persons_details.arrival_room_details_id', $count = false, $join);
            
            // if(empty($data['arrival_room']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            //     $select = 'GROUP_CONCAT(arrival_persons_details.first_name," ",arrival_persons_details.last_name,IF(arrival_persons_details.category!="adult", CONCAT("(",arrival_persons_details.age,")") ,"") SEPARATOR ", ") AS persons_details,';
            //     $select .= 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
            //     $where = 'arrival_room_details.enquiry_id= ' . $arrivals[0]->enquiry_id;
            //     $join = [
            //         ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
            //         ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id  = arrival_room_details.id'],
            //     ];
            //     $data['arrival_room'] = $this->common_model->get_data('arrival_room_details', '', '', $select, $where, ' GROUP BY arrival_persons_details.arrival_room_details_id', $count = false, $join);
            // }
            
            // updated code of 04 jan 2026
            // STEP 2: Get all room details for this arrival_id (with persons grouped if available)
            $select = '
                arrival_room_details.*,
                hotels.name AS hotel,
                hotels.contact_person_name,
                hotels.email,
                hotels.mobile,
                GROUP_CONCAT(
                    CONCAT(arrival_persons_details.first_name, " ", arrival_persons_details.last_name,
                        IF(arrival_persons_details.category != "adult", CONCAT(" (", arrival_persons_details.age, ")"), "")
                    )
                    SEPARATOR ", "
                ) AS persons_details
            ';
            $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
            $join = [
                ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],
                ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'],
            ];
            
            $data['arrival_room'] = $this->common_model->get_data(
                'arrival_room_details',
                '',
                '',
                $select,
                $where,
                ' GROUP BY arrival_room_details.id ORDER BY arrival_room_details.checkin_date ASC',
                false,
                $join
            );
        
            // STEP 3: Fallback if no records found for arrival_id and split_number = 0
            if (empty($data['arrival_room']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL') {
                $select = '
            arrival_room_details.*,
            hotels.name AS hotel,
            hotels.contact_person_name,
            hotels.email,
            hotels.mobile,
            GROUP_CONCAT(
                CONCAT(arrival_persons_details.first_name, " ", arrival_persons_details.last_name,
                    IF(arrival_persons_details.category != "adult", CONCAT(" (", arrival_persons_details.age, ")"), "")
                )
                SEPARATOR ", "
            ) AS persons_details
        ';
        $where = 'arrival_room_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
        $join = [
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'],
        ];
        $data['arrival_room'] = $this->common_model->get_data(
            'arrival_room_details',
            '',
            '',
            $select,
            $where,
            ' GROUP BY arrival_room_details.id ORDER BY arrival_room_details.checkin_date ASC',
            false,
            $join
        );
    }
        }
        //echo '<pre>';print_r($data['arrival_room']);exit;


        $select = 'transportation_images.image';
        $where = 'transportation_images.transportation_id= ' . $arrivals[0]->transportation_id;
        $data['transportation_images'] = $this->common_model->get_data('transportation_images', '', '', $select, $where, '', $count = false);

        $where = 'arrival_flight_details.arrival_id = ' . $arrivals[0]->id;
        $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
        $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        
        if(empty($data['arrival_flight']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $where = 'arrival_flight_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
            $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
            $select = 'arrival_flight_details.*,airlines.name';
            $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        }
        $where = 'itinerary.arrival_id= ' . $id . ' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, ' ORDER BY itinerary.date,itinerary.time ASC', $count = false);

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
        
        $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1,hotels.address_2,hotels.city,hotels.state,hotels.map,arrival_room_details.id AS arrival_room_details_id';
        $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],
                ['type' => 'LEFT', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],];
        $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' GROUP BY arrival_hotel_details.id ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
        
        if(empty($data['arrival_hotel_details']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1,hotels.address_2,hotels.city,hotels.state,hotels.map,arrival_room_details.id AS arrival_room_details_id';
            $where = 'arrival_hotel_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],
                    ['type' => 'LEFT', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' GROUP BY arrival_hotel_details.id ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
        }
        if (!empty($arrivals[0]->combo_enquiry_id) && $arrivals[0]->combo_enquiry_id !== 'NULL') {
            $where = 'combo_enquiry.id = ' . (int)$arrivals[0]->combo_enquiry_id;
            $select = '*';
            $combo_data = $this->common_model->get_data('combo_enquiry', '', '', $select, $where, '', false);
            
            if (!empty($combo_data[0]->enquiry_abbr)) {
                $char = substr($combo_data[0]->enquiry_abbr, 1, 2);
            } else {
                $char = '';
            }
        } else {
            $char = substr($arrivals[0]->enquiry_abbr, 1, 2);
        }
        // $char = substr($arrivals[0]->enquiry_abbr, 1, 2);
        $locations = COUNTRY_ABBR;
        $where = 'LOWER(company_addresses.country) = "' . $locations[$char] . '"';
        $select = 'company_addresses.name,company_addresses.address,company_addresses.person_name,company_addresses.contact_number,company_addresses.country';
        $company = $this->common_model->get_data('company_addresses', '', '', $select, $where, '', $count = false);
        if($company){
            $data['company'] = $company[0];
        }else{
            $data['company'] = null;
        }


        //23 April
        $data['restaurant_menus'] = $this->restaurantmenumaster_model->available_menu_item($id);

        $select = 'guides.*';
        $where = 'enquiry_guide.arrival_id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
        $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);
        
        if(empty($data['data_guides']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'guides.*';
            $where = 'enquiry_guide.enquiry_id= ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
            $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);
        }
        $select = 'transportation.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle';
        $where = 'enquiry_transport.arrival_id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
        $data['data_transportation'] = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);
        
        if(empty($data['data_transportation']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'transportation.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle';
            $where = 'enquiry_transport.enquiry_id= ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
            $data['data_transportation'] = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);
        }
        $select = 'drivers.*';
        $where = 'arrivals.id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'drivers.id = arrivals.driver_id'],];
        $data['data_drivers'] = $this->common_model->get_data('drivers', '', '', $select, $where, '', $count = false, $join);
        
        if ($this->input->get('print') == 'pdf') {
             
            // Clear all buffers
            while (ob_get_level()) {
                ob_end_clean();
            }
            
            $num_child = $data['arrivals']->num_child ?? 0;
            $child_ages = $data['arrivals']->child_ages ?? '';

            if ($num_child > 0 && !empty($child_ages)) {
                $ages_array = json_decode($child_ages, true) ?? [];
                $child_age_text = !empty($ages_array) ? implode(', ', $ages_array) . ' yrs' : $num_child . ' children';
            } else {
                $child_age_text = 'No children';
            }

            $data['child_ages'] = $child_age_text;
            $data['num_child'] = $num_child;
                
            log_user_activity('Arrival Chart File Arrivals Details',$this->session->userdata('id'), 'File Arrivals Details: Save As PDF');
            $this->load->view('admin/print_arrival_view_pdf', $data);
        } else {
            log_user_activity('Arrival Chart File Arrivals Details',$this->session->userdata('id'), 'File Arrivals Details: View');
            $this->load->view('admin/print_arrival_view', $data);
        }
    }

    // 16 Feb 2024
    public function print_service_voucher()
    {
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id=' . $id;
        $select = 'arrivals.*, enquiry.enquiry_no, enquiry.enquiry_abbr, enquiry.number_of_nights, hotels.name AS hotel_name, hotels.address_1, hotels.address_2, hotels.city, hotels.state, company.name AS filename, company.company_logo, company_details.address, company_details.address_2, company_details.contact_person, CONCAT(company_details.contact_person_isd_code," ",company_details.contact_person_number) AS contact_num, company_details.pincode, transportation.vehicle_type, transportation.capacity, transportation.remarks, transportation.vehicle_name, transportation.luggage_transport, guides.name AS guide, guides.gender, guides.isd_codes, guides.contact_number, guides.location, guides.remarks AS guide_remarks, guides.photo, CASE WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.check_in_date ELSE enquiry.check_in_date END AS check_in_date, CASE WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.check_out_date ELSE enquiry.check_out_date END AS check_out_date';  

        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
            ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'enquiry.company_details_id = company_details.company_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        $data['arrivals'] = $arrivals[0];
        // print_r($data['arrivals']);
        if(substr($data['arrivals']->enquiry_abbr,0,1) == 'G' && $data['arrivals']->split_number != 0){
            $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$data['arrivals']->id;
            $qry_result = $this->common_model->custom_query($qry);
            if(!empty($qry_result)){
               $data['arrivals']->check_in_date = $qry_result[0]->chk_in;
               $data['arrivals']->check_out_date = $qry_result[0]->chk_out;
            }
        }
      
        
        // STEP 1: Try to get all persons for this enquiry
        $where = 'arrival_persons_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
        $data['arrival_persons'] = $this->common_model->get_data('arrival_persons_details', '', '', '*', $where, '', false);

        // STEP 2: Get all room details for this arrival_id (with persons grouped if available)
        $select = '
            arrival_room_details.*,
            hotels.name AS hotel,
            hotels.contact_person_name,
            hotels.email,
            hotels.mobile,
            GROUP_CONCAT(
                CONCAT(arrival_persons_details.first_name, " ", arrival_persons_details.last_name,
                    IF(arrival_persons_details.category != "adult", CONCAT(" (", arrival_persons_details.age, ")"), "")
                )
                SEPARATOR ", "
            ) AS persons_details
        ';
        $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
        $join = [
            ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'],
        ];
        $data['arrival_room'] = $this->common_model->get_data(
            'arrival_room_details',
            '',
            '',
            $select,
            $where,
            ' GROUP BY arrival_room_details.id ORDER BY arrival_room_details.checkin_date ASC',
            false,
            $join
        );

        // STEP 3: Fallback if no records found for arrival_id and split_number = 0
        if (empty($data['arrival_room']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL') {
            $select = '
                arrival_room_details.*,
                hotels.name AS hotel,
                hotels.contact_person_name,
                hotels.email,
                hotels.mobile,
                GROUP_CONCAT(
                    CONCAT(arrival_persons_details.first_name, " ", arrival_persons_details.last_name,
                        IF(arrival_persons_details.category != "adult", CONCAT(" (", arrival_persons_details.age, ")"), "")
                    )
                    SEPARATOR ", "
                ) AS persons_details
            ';
            $where = 'arrival_room_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $join = [
                ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_room_details.hotel_id'],
                ['type' => 'LEFT', 'join_table' => 'arrival_persons_details', 'condition' => 'arrival_persons_details.arrival_room_details_id = arrival_room_details.id'],
            ];
            $data['arrival_room'] = $this->common_model->get_data(
                'arrival_room_details',
                '',
                '',
                $select,
                $where,
                ' GROUP BY arrival_room_details.id ORDER BY arrival_room_details.checkin_date ASC',
                false,
                $join
            );
        }
        $select = 'transportation_images.image';
        $where = 'transportation_images.transportation_id= ' . $arrivals[0]->transportation_id;
        $data['transportation_images'] = $this->common_model->get_data('transportation_images', '', '', $select, $where, '', $count = false);

        $where = 'arrival_flight_details.arrival_id = ' . $arrivals[0]->id;
        $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
        $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        
        if(empty($data['arrival_flight']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $where = 'arrival_flight_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $order_by = ' ORDER BY arrival_flight_details.departure_date,arrival_flight_details.departure_time ASC';
            $join = [['type' => 'LEFT', 'join_table' => 'airlines', 'condition' => 'airlines.id = arrival_flight_details.airline_id'],];
            $select = 'arrival_flight_details.*,airlines.name';
            $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, $order_by, $count = false, $join);
        }
        
        $where = 'itinerary.arrival_id= ' . $id . ' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary', '', '', '*', $where, ' ORDER BY itinerary.date,itinerary.time ASC', $count = false);

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
                    $inserted = (object)['date'=>$arrival_lists->date,'time'=>$arrival_lists->opening_time,'title'=>$title.'<br><br>'.str_replace(['<p>','</p>'],['','</br>'],$arrival_lists->description),'remarks'=>'PREPAID','content'=>''];
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
        $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1,hotels.address_2,hotels.city,hotels.state,hotels.map,arrival_room_details.id AS arrival_room_details_id';
        $where = 'arrival_hotel_details.arrival_id = ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],
                ['type' => 'LEFT', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],];
        $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' GROUP BY arrival_hotel_details.id ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
        
        if(empty($data['arrival_hotel_details']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1,hotels.address_2,hotels.city,hotels.state,hotels.map,arrival_room_details.id AS arrival_room_details_id';
            $where = 'arrival_hotel_details.enquiry_id = ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],
                    ['type' => 'LEFT', 'join_table' => 'arrival_room_details', 'condition' => 'arrival_room_details.arrival_hotel_details_id = arrival_hotel_details.id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' GROUP BY arrival_hotel_details.id ORDER BY arrival_hotel_details.checkout_date ASC', $count = false, $join);
        }
        if (!empty($arrivals[0]->combo_enquiry_id) && $arrivals[0]->combo_enquiry_id !== 'NULL') {
            $where = 'combo_enquiry.id = ' . (int)$arrivals[0]->combo_enquiry_id;
            $select = '*';
            $combo_data = $this->common_model->get_data('combo_enquiry', '', '', $select, $where, '', false);
            
            if (!empty($combo_data[0]->enquiry_abbr)) {
                $char = substr($combo_data[0]->enquiry_abbr, 1, 2);
            } else {
                $char = '';
            }
        } else {
            $char = substr($arrivals[0]->enquiry_abbr, 1, 2);
        }
        $locations =COUNTRY_ABBR; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $where = 'LOWER(company_addresses.country) = "' . $locations[$char] . '"';
        $select = 'company_addresses.name,company_addresses.address,company_addresses.person_name,company_addresses.contact_number,company_addresses.country';
        $company = $this->common_model->get_data('company_addresses', '', '', $select, $where, '', $count = false);
        if(substr($arrivals[0]->enquiry_no,0,3) == 'FAZ'){
            // $company[0]->person_name = 'Kamran Yusifov';
            // $company[0]->contact_number = '+994504409146';
            $company[0]->person_name = 'Sahib Khanlarov';
            $company[0]->contact_number = '+994102521778';
        }
        // $data['company'] = $company[0];
        if (!empty($company) && isset($company[0])) {
            $data['company'] = $company[0];
        } else {
            $data['company'] = null; // or set a default value
        }

        $data['restaurant_menus'] = $this->restaurantmenumaster_model->available_menu_item($id);

        $select = 'guides.*';
        $where = 'enquiry_guide.arrival_id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
        $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);
        
        if(empty($data['data_guides']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'guides.*';
            $where = 'enquiry_guide.enquiry_id= ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id'],];
            $data['data_guides'] = $this->common_model->get_data('enquiry_guide', '', '', $select, $where, '', $count = false, $join);
        }
        
        $select = 'transportation.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle';
        $where = 'enquiry_transport.arrival_id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
        $data['data_transportation'] = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);
        // print_r($data['data_transportation']);
        
        if(empty($data['data_transportation']) && $arrivals[0]->split_number == 0 && $arrivals[0]->combo_enquiry_id == 'NULL'){
            $select = 'transportation.*,enquiry_transport.quantity,enquiry_transport.luggage_vehicle';
            $where = 'enquiry_transport.enquiry_id= ' . $arrivals[0]->enquiry_id;
            $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id'],];
            $data['data_transportation'] = $this->common_model->get_data('enquiry_transport', '', '', $select, $where, '', $count = false, $join);
        }
        $select = 'drivers.*';
        $where = 'arrivals.id= ' . $arrivals[0]->id;
        $join = [['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'drivers.id = arrivals.driver_id'],];
        $data['data_drivers'] = $this->common_model->get_data('drivers', '', '', $select, $where, '', $count = false, $join);
        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);

        
        if ($this->input->get('print') == 'pdf') {
            require_once FCPATH.'vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();
            // $mpdf->ignore_invalid_utf8 = true;
            // $mpdf->allow_output_buffering = true; 
            log_user_activity('Arrival Chart Service Voucher',$this->session->userdata('id'), 'Service Voucher: Save As PDF');
            // $this->load->view('admin/print_service_voucher_pdf', $data);
            // Process child ages data
            $child_ages = json_decode($data['arrivals']->child_ages ?? '[]');
            if (is_array($child_ages) && !empty($child_ages)) {
                $child_age_text = implode(', ', $child_ages) . ' yrs';
            } else {
                $child_age_text = 'No children';
            }
            
            $data['child_age_text'] = $child_age_text;  
            
            // Load the view as HTML string
            $html = $this->load->view('admin/print_service_voucher_pdf', $data, TRUE);
            // Configure mPDF
            // $mpdf->setAutoTopMargin = true;
            // $mpdf->setAutoBottomMargin = 'stretch';
            // $mpdf->WriteHTML($html);
            
            // // Output PDF
            // $filename = $data['arrivals']->enquiry_no . '_service_voucher.pdf';
            // if (ob_get_level()) {
            //     ob_clean(); // or ob_end_clean() if you want to discard the buffer
            // }
            // $mpdf->Output($filename, 'D');
            $mpdf->setAutoTopMargin = true;
            $mpdf->setAutoBottomMargin = 'stretch';
            
            // PNG iCCP warning ko screen par aane se roko (sirf PDF banate waqt)
            $old_error_level = error_reporting();
            error_reporting($old_error_level & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
            
            $mpdf->WriteHTML($html);
            
            error_reporting($old_error_level);
            
            // Output PDF
            $filename = $data['arrivals']->enquiry_no . '_service_voucher.pdf';
            while (ob_get_level()) {
                ob_end_clean(); // buffer me jo bhi text ho use hata do, taaki PDF corrupt na ho
            }
            $mpdf->Output($filename, 'D');
        }
        else {
            log_user_activity('Arrival Chart Service Voucher',$this->session->userdata('id'), 'Service Voucher: View');
            $this->get_company_name($data);
            $this->load->view('admin/print_service_voucher', $data);
        }
    }

    public function get_company_name($data)
    {
        $filename = $data['arrivals']->filename;
        $this->session->set_userdata([
            'arrivals'             => $data['arrivals'],
            'arrival_hotel'        => $data['arrival_hotel_details'],
            'arrival_flight'       => $data['arrival_flight'],
            'itinerary'            => $data['itinerary'],
            'data_transportation'  => $data['data_transportation'],
            'data_guides'          => $data['data_guides'],
            'arrival_room'         => $data['arrival_room'],
            'restaurant_menus'     => $data['restaurant_menus'],
            'company'              => $data['company'],
            'company_name'         => $data['arrivals']->filename,
            'contact_num'          => $data['arrivals']->contact_num,
            'contact_person'       => $data['arrivals']->contact_person,

        ]);
        return $filename;
    }

    public function sendPdfOnWhatsapp()
    {
        $encoded_id = $this->input->post('id');
        $id = base64_decode($encoded_id);

        $company_name = $this->session->userdata('company_name');
        $agent_contact_num = $this->session->userdata('contact_num');
        $contact_person = $this->session->userdata('contact_person');

        // Fetch company
        $this->db->select('*');
        $this->db->from('company');
        $this->db->join('company_details', 'company.id = company_details.company_id', 'left');
        $this->db->where('company.name', $company_name);
        $query = $this->db->get();

        if (!$query || $query->num_rows() == 0) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Company not found.'
                ]));
        }

        $company = $query->row();
        $company_id = $company->company_id;
        $contact_person_number = $company->contact_person_number;
        $contact_person_isd_code = $company->contact_person_isd_code;
        $contact_num = $contact_person_isd_code.$contact_person_number;
        $manual_number = $this->input->post('agent_number');
        // $to = !empty($manual_number) ? $manual_number : $contact_num;
        $to = !empty($manual_number) ? $manual_number : $agent_contact_num;

        require_once FCPATH.'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $session_data = [
            'arrivals'            => $this->session->userdata('arrivals'),
            'arrival_hotel_details' => $this->session->userdata('arrival_hotel'),
            'arrival_flight'      => $this->session->userdata('arrival_flight'),
            'itinerary'           => $this->session->userdata('itinerary'),
            'data_transportation' => $this->session->userdata('data_transportation'),
            'data_guides'         => $this->session->userdata('data_guides'),
            'arrival_room'        => $this->session->userdata('arrival_room'),
            'restaurant_menus'    => $this->session->userdata('restaurant_menus'),
            'company'             => $this->session->userdata('company'),
            'company_name'        => $this->session->userdata('company_name')
        ];
        
        // Load the view and get HTML as string
        $html = $this->load->view('admin/print_service_voucher_pdf1', $session_data, true);
        $mpdf->WriteHTML($html);

        $pdf_filename = 'company_' . $company_id . '_' . time() . '.pdf';
        $pdf_path = FCPATH . 'uploads/service_voucher_pdf/' . $pdf_filename;

        $mpdf->Output($pdf_path, \Mpdf\Output\Destination::FILE);

        // Store in DB
        $this->db->insert('service_pdf_table', [
            'company_id' => $company_id,
            'file_name'  => $pdf_filename,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Pass actual generated PDF filename to WhatsApp send function
        $this->send_service_voucher($to, $pdf_filename, $company_name, $contact_person);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'PDF created and sent successfully.',
                'pdf_name' => $pdf_filename
            ]));
    }

    public function send_service_voucher($contact_number, $pdf_filename,$company_name, $contact_person)
    {
        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
        $to = $contact_number;
        // $to = $contact_number;
        $server_link = base_url('uploads/service_voucher_pdf/' . $pdf_filename);
        $parameters = [
            ['type' => 'text', 'text' => $contact_person],
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
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $status_message = ($http_status == 200)
            ? 'service voucher sent successfully'
            : 'service voucher not sent';

        $log_data = [
            'company_name' => $company_name,
            'number'  => $to,
            'status'        => $status_message,
            'response'      => $response
        ];
        error_log(json_encode($payload));

        $this->log_whatsapp_status($log_data);

    }

    public function log_whatsapp_status($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s'); // Ensure timestamp is stored
        return $this->db->insert('service_voucher_whatsapp_logs', $data);
    }
    
    public function print_restaurant_voucher()
    {
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id=' . $id;
        $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,hotels.address_2,hotels.city,hotels.state,';
        $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,company.company_logo,company_details.address,company_details.contact_person,CONCAT(company_details.contact_person_isd_code," ",company_details.contact_person_number) AS contact_num,';
        $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,';
        $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
            ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'enquiry.company_details_id = company_details.company_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        $data['arrivals'] = $arrivals[0];

        $where = 'arrival_persons_details.enquiry_id= ' . $arrivals[0]->enquiry_id;
        $data['arrival_persons'] = $this->common_model->get_data('arrival_persons_details', '', '', '*', $where, '', $count = false);

        $char = substr($arrivals[0]->enquiry_abbr, 1, 1);
        $locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $where = 'LOWER(company_addresses.country) = "' . $locations[$char] . '"';
        $select = 'company_addresses.name,company_addresses.address,company_addresses.person_name,company_addresses.contact_number,company_addresses.country';
        $company = $this->common_model->get_data('company_addresses', '', '', $select, $where, '', $count = false);
        $data['company'] = $company[0];

        //23 April
        $data['restaurant_menus'] = $this->restaurantmenumaster_model->available_menu_item($id);

        if ($this->input->get('print') == 'pdf') {
            // $data['content'] = 'admin/print_restaurant_voucher_pdf';
            $this->load->view('admin/print_restaurant_voucher_pdf', $data);
        } else {
            // $data['content'] = 'admin/print_restaurant_voucher';
            $this->get_company_data_for_restaurant_voucher($data);
            $this->load->view('admin/print_restaurant_voucher', $data);
        }
    }

    public function get_company_data_for_restaurant_voucher($data)
    {
        // print_r($data['restaurant_menus'][0]->name);
        $filename = $data['arrivals']->filename;
        $this->session->set_userdata([
            'arrivalsdata'         => $data['arrivals'],
            'restaurant_menus_data'    => $data['restaurant_menus'],
            'companydata'              => $data['company'],
            'company_name_restaurant'  => $data['arrivals']->filename,
            'restaurants_name'         => $data['restaurant_menus'][0]->name
        ]);
        return $filename;
    }

    public function sendPdfOnWhatsapp_for_restaurants_voucher()
    {
        $encoded_id = $this->input->post('id');
        $id = base64_decode($encoded_id);

        $company_name = $this->session->userdata('company_name_restaurant');
        $res_name = $this->session->userdata('restaurants_name');

        // Fetch company data
        $this->db->select('*');
        $this->db->from('company');
        $this->db->join('company_details', 'company.id = company_details.company_id', 'left');
        $this->db->where('company.name', $company_name);
        $query = $this->db->get();

        if (!$query || $query->num_rows() == 0) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Company not found.'
                ]));
        }

        $company = $query->row();
        $company_id = $company->company_id;
        $contact_person_number = $company->contact_person_number;
        $contact_person_isd_code = $company->contact_person_isd_code;
        $contact_num = $contact_person_isd_code.$contact_person_number;

        // Fetch restaurant number
        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->where('restaurants.name', $res_name);
        $query1 = $this->db->get();
        $restaurants = $query1->row();
        $res_num = str_replace('+', '', $restaurants->contact_number ?? '');

        // Get input values
        $company_number = $this->input->post('company_number');
        $restaurant_number = $this->input->post('restaurant_number');
        $selectedType = $this->input->post('selected_type');

        // Use based on dropdown selection
        if ($selectedType === 'Company') {
            $to = !empty($company_number) ? $company_number : $contact_num;
        } elseif ($selectedType === 'Restaurant') {
            $to = !empty($restaurant_number) ? $restaurant_number : $res_num;
        } else {
            $to = '';
        }

        // Generate PDF
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $session_data = [
            'arrivals' => $this->session->userdata('arrivalsdata'),
            'restaurant_menus' => $this->session->userdata('restaurant_menus_data'),
            'company' => $this->session->userdata('companydata'),
            'company_name' => $company_name
        ];

        $html = $this->load->view('admin/print_restaurant_voucher_pdf1', $session_data, true);
        $mpdf->WriteHTML($html);

        $pdf_filename = 'company_' . $company_id . '_' . time() . '.pdf';
        $pdf_path = FCPATH . 'uploads/restaurants_voucher_pdf/' . $pdf_filename;
        $mpdf->Output($pdf_path, \Mpdf\Output\Destination::FILE);

        // Store PDF in DB
        $this->db->insert('restaurants_pdf_table', [
            'company_id' => $company_id,
            'file_name' => $pdf_filename,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Send on WhatsApp
        $this->send_restaurants_voucher($to, $pdf_filename);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'PDF created and sent successfully.',
                'pdf_name' => $pdf_filename
        ]));
    }


    public function send_restaurants_voucher($contact_number, $pdf_filename)
    {
        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
        $to = $contact_number;
        // $to = $contact_number;
        $server_link = base_url('uploads/restaurants_voucher_pdf/' . $pdf_filename);
        $parameters = [
            ['type' => 'text', 'text' => 'Sumeet'],
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

    public function voucher_select_restaurant(){
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id=' . $id;
        $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,hotels.address_2,hotels.city,hotels.state,';
        $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,company.company_logo,company_details.address,company_details.contact_person,CONCAT(company_details.contact_person_isd_code," ",company_details.contact_person_number) AS contact_num,';
        $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,';
        $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrivals.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'enquiry.company_id = company.company_id'],
            ['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'enquiry.company_details_id = company_details.company_id'],
        ];
        $arrivals = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
        $data['arrivals'] = $arrivals[0];
        if(substr($data['arrivals']->enquiry_abbr,0,1) == 'G' && $data['arrivals']->split_number != 0){
            $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$data['arrivals']->id;
            $qry_result = $this->common_model->custom_query($qry);
            if(!empty($qry_result)){
               $data['arrivals']->check_in_date = $qry_result[0]->chk_in;
               $data['arrivals']->check_out_date = $qry_result[0]->chk_out;
            }
        }
        $data['restaurant_menus'] = $this->restaurantmenumaster_model->available_menu_item($id);

        //echo '<pre>';print_r( $data['restaurant_menus']);exit;
        // $data['content'] = 'admin/print_restaurant_voucher_select';
        $this->load->view('admin/print_restaurant_voucher_select', $data);

    }

    public function add_airline()
    {
        $this->form_validation->set_rules('airline_name', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('airline_code', 'Airline Code', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger" style="padding: 0 5px;">' . validation_errors() . '</div>']);
            exit;
        }

        $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('airline_name'))) . '" AND LOWER(code) = "' . strtolower(trim($this->input->post('airline_code'))) . '" AND status!="deleted"';
        $res_airlines = $this->common_model->get_data('airlines', '', '', '*', $where, '', $count = true);
        //echo $res_company;exit;
        if ($res_airlines > 0) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-warning">Airline with name (' . $this->input->post('airline_name') . ') and code exists!</div>']);
            exit;
        }

        $data = array(
            'name' => $this->input->post('airline_name'),
            'code' => $this->input->post('airline_code'),
            'created' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('airlines', $data);
        $id = $this->db->insert_id();
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success" style="padding: 0 5px;">Airline added successully!</div>']);
    }

    public function add_hotel_details()
    {
        $this->form_validation->set_rules('check_in[]', 'Check In', 'trim|required');
        $this->form_validation->set_rules('check_out[]', 'Check Out', 'trim|required');
        $this->form_validation->set_rules('hotel_ids[]', 'Hotel', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>'];
            echo json_encode($response);
            exit;
        }
        if ($this->input->post('check_in')[0] <> '') {
            $cnt = count($this->input->post('check_in'));
            $insert_array = $return_arr = [];
            for ($i = 0; $i < $cnt; $i++) {
                $insert_array = [
                    'checkin_date' => $this->input->post('check_in')[$i],
                    'checkout_date' => $this->input->post('check_out')[$i],
                    'hotel_name' => $this->input->post('hotel')[$i],
                    'hotel_id' => $this->input->post('hotel_ids')[$i],
                    'enquiry_id' => $this->input->post('id'),
                    'created' => date('Y-m-d H:i:s')
                ];
                $id = $this->common_model->insert_data(['table_name' => 'arrival_hotel_details', 'insert_data' => $insert_array]);
                $return_arr[$i] = ['id' => $id] + $insert_array;
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);

            $response = ['response' => 's', 'details' => $return_arr, 'msg' => '<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }

    public function update_hotel_details()
    {
        $msg_update = $msg_insert = '';
        if (isset($this->input->post('edit_checkin')[0]) && $this->input->post('edit_checkout')[0] <> '') {
            $cnt = count($this->input->post('edit_checkin'));
            $update_array = [];
            for ($i = 0; $i < $cnt; $i++) {
                if ($this->input->post('edit_checkin')[$i] <> '' && $this->input->post('edit_checkout')[$i] <> '' && $this->input->post('edit_hotel_ids')[$i] <> '') {
                    $update_array = [
                        'checkin_date' => $this->input->post('edit_checkin')[$i],
                        'checkout_date' => $this->input->post('edit_checkout')[$i],
                        'hotel_name' => $this->input->post('edit_hotel')[$i],
                        'hotel_id' => $this->input->post('edit_hotel_ids')[$i],
                        'enquiry_id' => $this->input->post('id'),
			'arrival_id' => $this->input->post('arrival_id')
                    ];
                    $id = $this->input->post('edit_hotel_details_id')[$i];
                    $update_data = ['table_name' => 'arrival_hotel_details', 'update_data' => $update_array, 'condition' => ['id' => $id]];
                    $affected_rows = $this->common_model->update_data_limit($update_data);
                    if ($affected_rows) {
                        log_user_activity('Query Board Hotel Details Update ',$this->session->userdata('id'), 'Update:'.json_encode($update_array));
                        $msg_update = '<div class="alert alert-success">Hotel Details Updated Successfully!</div>';
                    }
                }
            }
        }
        /*$this->form_validation->set_rules('check_in[]', 'Check In', 'trim|required');
        $this->form_validation->set_rules('check_out[]', 'Check Out', 'trim|required');
        $this->form_validation->set_rules('hotel_ids[]', 'Hotel', 'trim|required');

        if($this->form_validation->run() === FALSE){
            $response = ['response'=>'e','details'=>'','msg'=>$msg.'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }*/
        $insert_array = $return_arr = [];
        if ($this->input->post('check_in')[0] <> '' && $this->input->post('check_out')[0] <> '' && $this->input->post('hotel_ids')[0]) {
            $cnt = count($this->input->post('check_in'));
            for ($i = 0; $i < $cnt; $i++) {
                if ($this->input->post('check_in')[$i] <> '' && $this->input->post('check_out')[$i] <> '' && $this->input->post('hotel_ids')[$i]) {
                    $insert_array = [
                        'checkin_date' => $this->input->post('check_in')[$i],
                        'checkout_date' => $this->input->post('check_out')[$i],
                        'hotel_name' => $this->input->post('hotel')[$i],
                        'hotel_id' => $this->input->post('hotel_ids')[$i],
                        'enquiry_id' => $this->input->post('id'),
                        'created' => date('Y-m-d H:i:s'),
						'arrival_id' => $this->input->post('arrival_id')
                    ];
                    $id = $this->common_model->insert_data(['table_name' => 'arrival_hotel_details', 'insert_data' => $insert_array]);
                    $return_arr[$i] = ['id' => $id] + $insert_array;
                }
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);
            $msg_insert = '<div class="alert alert-success">Details Added Successfully</div>';
        }
        $response = ['response' => 's', 'details' => $return_arr, 'msg' => $msg_update . $msg_insert];
        echo json_encode($response);
        exit;
    }

    public function get_hotel_details()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $data = [];
        if(substr($this->input->post('enq_num'),0,1) == 'G'){
            $arrival_id = $this->input->post('arrival_id');
            $where = 'arrival_hotel_details.arrival_id =' . $arrival_id;
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
            $data = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, '', $count = false, $join);
        }
        if(empty($data)){
            $arrival_id = $this->input->post('arrival_id');
            $combo_check = $this->common_model->get_data(
                'arrivals',
                '', '', 'combo_enquiry_id',
                'id = ' . $arrival_id
            );
            if($combo_check !== 'NULL'){
                $arrival_id = $this->input->post('arrival_id');
                $where = 'arrival_hotel_details.arrival_id =' . $arrival_id;
            }else{
                $enq_id = $this->input->post('enq_id');
                $where = 'arrival_hotel_details.enquiry_id =' . $enq_id;
            }
            // $enq_id = $this->input->post('enq_id');
            // $where = 'arrival_hotel_details.enquiry_id =' . $enq_id;
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
            $data = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, '', $count = false, $join);
        }
        if (empty($data)) {
            $response = json_encode(['response' => 'e', 'details' => '', 'msg' => '']);
        } else {
            $response = json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        }
        echo $response;
        exit;
    }

    public function payment_details()
    {
        if (!in_array($this->session->userdata('type'), ['1', '3'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        } else {
            $this->form_validation->set_rules('arr_id', 'Arrival', 'trim|required');
            $this->form_validation->set_rules('pay_date', 'Date', 'trim|required');
            $this->form_validation->set_rules('billing_amount_text', 'Billing Amount', 'trim|required|integer');

            /*if($this->input->post('payment_india') == '' && $this->input->post('payment_other') == ''){
                $this->form_validation->set_rules('payment_india', '', 'trim|required',['required'=>'Enter Atleast One Payment.']);
            }*/
            if ($this->input->post('select_payment_mode') <> '') {
                if ($this->input->post('payment_india') == '' && $this->input->post('payment_other') == '') {
                    $this->form_validation->set_rules('payment_india', '', 'trim|required', ['required' => 'Enter Atleast One Payment.']);
                }
            }
            if ($this->input->post('payment_india') <> '') {
                $this->form_validation->set_rules('payment_india', 'Payment Received in India', 'trim|integer');
                $this->form_validation->set_rules('select_payment_mode', 'Select Payment Mode', 'trim|required');
            }
            if ($this->input->post('payment_other') <> '') {
                $this->form_validation->set_rules('payment_other', 'Payment Received in Other', 'trim|integer');
                $this->form_validation->set_rules('select_payment_mode', 'Select Payment Mode', 'trim|required');
            }

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
                redirect('edit_arrival' . '?id=' . ($this->input->post('arr_id')));
            }

            $update_bill = array(
                'client_billing' => $this->input->post('billing_amount_text'),
                'currency' => $this->input->post('main_currency'),
            );
            $update_bill_data = ['table_name' => 'arrivals', 'update_data' => $update_bill, 'condition' => ['id' => base64_decode($this->input->post('arr_id'))]];
            $affected_update_rows = $this->common_model->update_data_limit($update_bill_data);

            $arrival_id = base64_decode($this->input->post('arr_id'));
            $paymentdetails = $this->common_model->get_rows(['table_name' => 'payment_details', 'condition' => ['arrival_id' => $arrival_id]]);

            $arrival_data = $this->common_model->get_row(['table_name' => 'arrivals', 'condition' => ['id' => $arrival_id]]);
            $client_billing = $arrival_data[0]->client_billing;

            $india_total = ($arrival_data[0]->payment_received_india <> '') ? $arrival_data[0]->payment_received_india : 0;
            $other_total = ($arrival_data[0]->payment_received_almaty <> '') ? $arrival_data[0]->payment_received_almaty : 0;

            foreach ($paymentdetails as $arrival) {
                $india_total += $arrival->payment_recieved_in_india;
                $other_total += $arrival->payment_recieved_in_other;
            }

            $new_payment_in_india = isset($_POST['payment_india']) && $_POST['payment_india'] !== '' ? $_POST['payment_india'] : 0;
            $new_payment_in_other = isset($_POST['payment_other']) && $_POST['payment_other'] !== '' ? $_POST['payment_other'] : 0;

            $india_total = $india_total + $new_payment_in_india;
            $other_total = $other_total + $new_payment_in_other;

            $billing_total = $india_total + $other_total;



            $balance_amount = $client_billing - $billing_total;
            /*if($balance_amount < 0){
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Total received payments exceeding client billing amount by ('.intval($balance_amount).')</div>');
                redirect('edit_arrival' . '?id=' . ($this->input->post('arr_id')));
            }*/
            $insert_arr = array(
                'arrival_id' => base64_decode($this->input->post('arr_id')),
                'payment_mode' => $this->input->post('select_payment_mode'),
                'currency' => $this->input->post('main_currency'),
                'payment_recieved_in_india' => isset($_POST['payment_india']) && $_POST['payment_india'] !== '' ? $_POST['payment_india'] : 0,
                'other_country' => isset($_POST['other_country']) && $_POST['other_country'] !== '' ? $_POST['other_country'] : 'none',
                'payment_recieved_in_other' => isset($_POST['payment_other']) && $_POST['payment_other'] !== '' ? $_POST['payment_other'] : 0,
                'date' => $this->input->post('pay_date'),
                'remarks' => $this->input->post('remarks'),
                'added_by' => $this->session->userdata('type'),
                'client_billing_previous' => $this->input->post('billing_amount_text_previous'),
                'client_billing_new' => $this->input->post('billing_amount_text')
            );

            $insert = $this->common_model->insert_data(['table_name' => 'payment_details', 'insert_data' => $insert_arr]);

            /*if (empty($this->input->post('payment_india')) && empty($this->input->post('payment_other'))) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully! </div>');
                redirect('edit_arrival' . '?id=' . ($this->input->post('arr_id')));
            }*/

            /*$arrival = $this->common_model->get_row(['table_name' => 'payment_details', 'condition' => ['id' => $insert]]);
            $arrival_id = $arrival[0]->arrival_id;*/

            $update_arr = array(
                'balance_amount' => $balance_amount,
                //'payment_received_india' => $india_total,
                //'payment_received_other' => $other_total
            );

            $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $arrival_id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);

            if ($affected_rows) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully! </div>');
                log_user_activity('Query Board Payment Details',$this->session->userdata('id'), 'Payment Details: '. json_encode($insert_arr));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error in adding Payment Details. Try Again!</div>');
            }
            redirect('edit_arrival' . '?id=' . ($this->input->post('arr_id')));
        }
    }

    //20 april 2024

    public function edit_payment_details()
    {
        if (!in_array($this->session->userdata('type'), ['1', '3'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        } else {
            $this->form_validation->set_rules('arrs_id', 'Arrival', 'trim|required');
            $this->form_validation->set_rules('pay_date', 'Date', 'trim|required');
            $this->form_validation->set_rules('billing_amount_text', 'Billing Amount', 'trim|required|integer');

            if ($this->input->post('select_payment_mode') <> '') {
                if ($this->input->post('payment_india') == '' && $this->input->post('payment_other') == '') {
                    $this->form_validation->set_rules('payment_india', '', 'trim|required', ['required' => 'Enter Atleast One Payment.']);
                }
            }
            if ($this->input->post('payment_india') <> '') {
                $this->form_validation->set_rules('payment_india', 'Payment Received in India', 'trim|integer');
                $this->form_validation->set_rules('select_payment_mode', 'Select Payment Mode', 'trim|required');
            }
            if ($this->input->post('payment_other') <> '') {
                $this->form_validation->set_rules('payment_other', 'Payment Received in Other', 'trim|integer');
                $this->form_validation->set_rules('select_payment_mode', 'Select Payment Mode', 'trim|required');
            }

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
                redirect('edit_arrival' . '?id=' . ($this->input->post('arrs_id')));
            }

            $edit_id = $this->input->post('payment_edit_id');

            $where='id='.$edit_id;
            $existing = $this->common_model->get_single(['table_name' => 'payment_details', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'currency' => $existing['currency'],
                    'payment_recieved_in_india'         => $existing['payment_recieved_in_india'],
                    'other_country'         => $existing['other_country'],
                    'payment_recieved_in_other'         => $existing['payment_recieved_in_other'],
                    'date'         => $existing['date'],
                    'remarks'         => $existing['remarks'],
                    'added_by'         => $existing['added_by'],
                ];
            } else {
                $previous_data = []; 
            }

            $update_arrs = array(
                //'payment_mode' => $this->input->post('select_payment_mode'),
                'currency' => $this->input->post('main_currency'),
                'payment_recieved_in_india' => isset($_POST['payment_india']) && $_POST['payment_india'] !== '' ? $_POST['payment_india'] : 0,
                'other_country' => isset($_POST['other_country']) && $_POST['other_country'] !== '' ? $_POST['other_country'] : 'none',
                'payment_recieved_in_other' => isset($_POST['payment_other']) && $_POST['payment_other'] !== '' ? $_POST['payment_other'] : 0,
                'date' => $this->input->post('pay_date'),
                'remarks' => $this->input->post('remarks'),
                'added_by' => $this->session->userdata('type'),
                // 'client_billing_previous' => $this->input->post('billing_amount_text_previous'),
                // 'client_billing_new' => $this->input->post('billing_amount_text')
            );

            $update_data = ['table_name' => 'payment_details', 'update_data' => $update_arrs, 'condition' => ['id' => $edit_id]];
            $affected_rows_payments = $this->common_model->update_data_limit($update_data);

            $update_bill = array(
                'client_billing' => $this->input->post('billing_amount_text'),
                'currency' => $this->input->post('main_currency'),
            );
            $update_bill_data = ['table_name' => 'arrivals', 'update_data' => $update_bill, 'condition' => ['id' => base64_decode($this->input->post('arrs_id'))]];
            $affected_update_rows = $this->common_model->update_data_limit($update_bill_data);

            $arrival_id = base64_decode($this->input->post('arrs_id'));
            $paymentdetails = $this->common_model->get_rows(['table_name' => 'payment_details', 'condition' => ['arrival_id' => $arrival_id]]);

            $arrival_data = $this->common_model->get_row(['table_name' => 'arrivals', 'condition' => ['id' => $arrival_id]]);
            $client_billing = $arrival_data[0]->client_billing;

            $india_total = ($arrival_data[0]->payment_received_india <> '') ? $arrival_data[0]->payment_received_india : 0;
            $other_total = ($arrival_data[0]->payment_received_almaty <> '') ? $arrival_data[0]->payment_received_almaty : 0;

            foreach ($paymentdetails as $arrival) {
                $india_total += $arrival->payment_recieved_in_india;
                $other_total += $arrival->payment_recieved_in_other;
            }

            // $new_payment_in_india = isset($_POST['payment_india']) && $_POST['payment_india'] !== '' ? $_POST['payment_india'] : 0;
            // $new_payment_in_other = isset($_POST['payment_other']) && $_POST['payment_other'] !== '' ? $_POST['payment_other'] : 0;

            // $india_total = $india_total + $new_payment_in_india;
            // $other_total = $other_total + $new_payment_in_other;

            $billing_total = $india_total + $other_total;

            $balance_amount = $client_billing - $billing_total;

            /*if (empty($this->input->post('payment_india')) && empty($this->input->post('payment_other'))) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully! </div>');
                redirect('edit_arrival' . '?id=' . ($this->input->post('arr_id')));
            }*/

            /*$arrival = $this->common_model->get_row(['table_name' => 'payment_details', 'condition' => ['id' => $insert]]);
            $arrival_id = $arrival[0]->arrival_id;*/

            $update_arr = array(
                'balance_amount' => $balance_amount,
                //'payment_received_india' => $india_total,
                //'payment_received_other' => $other_total
            );

            $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $arrival_id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);

            if ($affected_rows_payments) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully! </div>');
                log_user_activity('Query Board: Payment Update',$this->session->userdata('id'), 'Prevoius Data:' .json_encode($previous_data));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error in editing Payment Details. Try Again!</div>');
                log_user_activity('Query Board: Payment Update',$this->session->userdata('id'), 'Error: (Error in editing Payment Details. Try Again!)');
            }
            redirect('edit_arrival' . '?id=' . ($this->input->post('arrs_id')));
        }
    }
    
    // previous 19-11-2025
    // public function excel_download()
    // {
    //     log_user_activity('Arrival Chart Excel Download',$this->session->userdata('id'), 'Arrival Chart: Excel Downloaded');
    //     $where = '';
    //     //echo '<pre>';print_r($this->session->userdata);exit;
    //     if ($this->session->userdata('type') == 2) {
    //         //$where = 'arrivals.added_by='.$this->session->userdata('id');
    //     }

    //     // if ($this->input->get('submit') == '') {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
    //     // }

    //     // if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(enquiry.check_in_date) >="' . $this->input->get('date_from') . '" AND date(enquiry.check_in_date) <="' . $this->input->get('date_to') . '"';
    //     // }
        
    //     // $date_from = $this->input->get('date_from');
    //     // $date_to = $this->input->get('date_to');
        
    //     // if (!empty($date_from) && !empty($date_to)) {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(enquiry.check_in_date) >= "' . $date_from . '" AND date(enquiry.check_in_date) <= "' . $date_to . '"';
    //     // } else {
    //     //     $where_and = ($where != '') ? ' AND ' : '';
    //     //     $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
    //     // }
        
    //     if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . '(
    //                 (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
    //                 OR
    //                 (enquiry.split_count != 0 AND (
    //                     SELECT DATE(MIN(ahd.checkin_date))
    //                     FROM arrival_hotel_details ahd
    //                     WHERE ahd.arrival_id = arrivals.id
    //                 ) >= "' . $this->input->get('date_from') . '" 
    //                 AND (
    //                     SELECT DATE(MIN(ahd.checkin_date))
    //                     FROM arrival_hotel_details ahd
    //                     WHERE ahd.arrival_id = arrivals.id
    //                 ) <= "' . $this->input->get('date_to') . '")
    //             )';
    //     }

        
    //     if ($this->input->get('status') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
    //     }
    //     if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
    //     }
    //     if (!empty($this->input->get('booking_type'))) {
    //         $booking_type = urldecode($this->input->get('booking_type'));
    //         if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
    //             $loc = implode('","', $this->locations[$this->input->get('location')]);
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $loc . '")';
    //             //$this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
    //         } else if ($booking_type != 'all') {
    //             $where_and = ($where != '') ? ' AND ' : '';
    //             $where .= $where_and . 'enquiry.enquiry_abbr = "' . $booking_type . '"';
    //             //$this->db->where('enquiry.enquiry_abbr',$booking_type);
    //         }
    //     }

    //     if ($this->input->get('company_id') <> '') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
    //     }

    //     if ($this->session->userdata('admin_type') != 'superadmin') {
    //         $where_and = ($where != '') ? ' AND ' : '';
    //         // $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
    //         // $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
    //         $session_locations = explode(',', $this->session->userdata('locations'));
    //         $all_locations = [];
    //         foreach ($session_locations as $loc) {
    //             if (isset($this->locations[$loc])) {
    //                 $all_locations = array_merge($all_locations, $this->locations[$loc]);
    //             }
    //         }
    //         $assigned_loc = implode('","', $all_locations);
    //         $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
    //     }

    //     $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
    //     if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
    //         $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "' . urldecode($this->input->get('country')) . '"';
    //     }
    //     if ($this->input->get('query_number') <> '') {
    //         $enquiry_join .= ' AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '"';
    //     }

    //     $select = 'arrivals.*, transportation.vehicle_type, guides.name AS guide, enquiry.enquiry_no, enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, admin.name AS staff_name, company.name,';
    //     $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india,SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';
    //     $hotel_subquery = "(SELECT arrival_id, MIN(hotel_name) AS hotel_name FROM arrival_hotel_details GROUP BY arrival_id) AS hotel_sub";
    //     $join = [
    //         ['type' => '', 'join_table' => 'enquiry', 'condition' => '(' . $enquiry_join . ')'],
    //         ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
    //         ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
    //         ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
    //         ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
    //         ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
    //         ['type' => 'LEFT', 'join_table' => $hotel_subquery , 'condition' => 'hotel_sub.arrival_id = arrivals.id'],
    //     ];

    //     $result = $this->common_model->get_data('arrivals', '', '', $select, $where, ' GROUP BY arrivals.id,arrivals.enquiry_id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
    //     //echo $this->db->last_query();exit;
    //     //echo '<pre>';print_r($result);exit;

    //     $this->load->library('PHPExcel');
    //     include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->setActiveSheetIndex(0);
    //     //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

    //     $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
    //     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
    //     $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Number');
    //     $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Physical Arrival Date');
    //     $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Number Of Nights');
    //     $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Handling Staff Name');
    //     $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Hotel Name');
    //     $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Transportation');
    //     $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Guide');
    //     $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Group Type');
    //     $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Handover To Client');
    //     $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Nos. Of Guests');
    //     $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Company Name');
    //     $excel_col = 'M';
    //     if (in_array($this->session->userdata('type'), ['1', '3'])) {
    //         $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Currency');
    //         $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Client Billing');
    //         $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Payment Received In India');
    //         $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Payment Received In Almaty');
    //         $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Balance Amount');
    //         $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Payment Remarks');
    //         $excel_col = 'S';
    //     }
    //     $objPHPExcel->getActiveSheet()->setCellValue($excel_col . '1', 'Status');

    //     $row = 2;
    //     $sr = 1;
    //     if (isset($result[0])) {
    //         foreach ($result as $val) {
    //             $split = '';
    //             if(substr($val->enquiry_no,0,1) == 'G' && $val->split_number != 0){
    //                 $split = ' (Split-'.$val->split_number.')';
    //                 $val->number_persons = $val->num_adults;
    //                 $val->number_child = $val->num_child;
    //             }
    //             $where = 'payment_details.arrival_id= ' . $val->id;
    //             $select = 'payment_details.remarks';
    //             $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $select, $where, ' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
    //             $remarks = (!empty($payment_details_remarks)) ? $payment_details_remarks[0]->remarks : '';

    //             $where = 'arrival_hotel_details.enquiry_id = '.$val->enquiry_id;
    //             $select = 'arrival_hotel_details.hotel_name';
    //             $hotel = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,' ORDER BY arrival_hotel_details.id DESC LIMIT 1', $count = false);
    //             $hotel_name = (!empty($hotel)?$hotel[0]->hotel_name:'');

    //             $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
    //             $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->enquiry_no.$split);
    //             $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d-M-Y', strtotime($val->arrival_date)));
    //             $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->number_of_nights);
    //             $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->staff_name);
    //             $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $hotel_name);
    //             $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $val->vehicle_type);
    //             $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ($val->guide <> '') ? $val->guide : '');
    //             $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $val->group_type);
    //             $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->handover_to_client);
    //             $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, (($val->number_persons == '') ? '0' : $val->number_persons) + (($val->number_child == '') ? '0' : $val->number_child));
    //             $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $val->name);
    //             if (in_array($this->session->userdata('type'), ['1', '3'])) {
    //                 $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucfirst($val->currency));
    //                 $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $val->client_billing);
    //                 $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, (int)$val->payment_received_india + (int)$val->paymentreceived_india);
    //                 $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, (int)$val->payment_received_almaty + (int)$val->paymentrecieved_in_other);
    //                 $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $val->balance_amount);
    //                 $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $remarks);
    //             }
    //             $objPHPExcel->getActiveSheet()->setCellValue($excel_col . $row, ucfirst($val->status));
    //             $row++;
    //             $sr++;
    //         }
    //     }

    //     header('Content-Type: application/vnd.ms-excel'); //mime type
    //     header('Content-Disposition: attachment;filename="' . 'Arrivals_list_' . date('d-m-Y') . '.xlsx' . '"');
    //     header('Cache-Control: max-age=0'); //no cache

    //     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //     //if you want to save it as .XLSX Excel 2007 format
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     //force user to download the Excel file without writing it to server's HD
    //     $objWriter->save('php://output');

    // }
    
    
    // updated excel download functionality 19-11-2025
    public function excel_download()
    {
        log_user_activity('Arrival Chart Excel Download',$this->session->userdata('id'), 'Arrival Chart: Excel Downloaded');
        $where = '';
        
        if ($this->session->userdata('type') == 2) {
            //$where = 'arrivals.added_by='.$this->session->userdata('id');
        }

        if ( empty($this->input->get('submit')) &&
            empty($this->input->get('query_number')) &&
            empty($this->input->get('date_from')) &&
            empty($this->input->get('date_to')) &&
            empty($this->input->get('status')) &&
            empty($this->input->get('staff_id')) &&
            empty($this->input->get('booking_type')) &&
            empty($this->input->get('company_id')) &&
            empty($this->input->get('country')) &&
            empty($this->input->get('confirm_cnt'))
        ) {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'date(arrivals.arrival_date) >= "' . date('Y-m-d') . '"';
        }

        // Use the same date filtering logic as index() method for combo enquiries
        if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . '(
                CASE 
                    WHEN arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.check_in_date IS NOT NULL AND combo_enquiry.check_in_date != "" THEN 
                        (DATE(combo_enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(combo_enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
                    WHEN arrivals.combo_enquiry_id IS NOT NULL THEN 
                        ((
                            SELECT DATE(MIN(ahd.checkin_date))
                            FROM arrival_hotel_details ahd
                            WHERE ahd.arrival_id = arrivals.id
                        ) >= "' . $this->input->get('date_from') . '" 
                        AND (
                            SELECT DATE(MIN(ahd.checkin_date))
                            FROM arrival_hotel_details ahd
                            WHERE ahd.arrival_id = arrivals.id
                        ) <= "' . $this->input->get('date_to') . '")
                    WHEN arrivals.combo_enquiry_id IS NULL AND enquiry.split_count = 0 THEN 
                        (DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
                    ELSE 
                        ((
                            SELECT DATE(MIN(ahd.checkin_date))
                            FROM arrival_hotel_details ahd
                            WHERE ahd.arrival_id = arrivals.id
                        ) >= "' . $this->input->get('date_from') . '" 
                        AND (
                            SELECT DATE(MIN(ahd.checkin_date))
                            FROM arrival_hotel_details ahd
                            WHERE ahd.arrival_id = arrivals.id
                        ) <= "' . $this->input->get('date_to') . '")
                END
            )';
        }
        
        if ($this->input->get('status') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.status ="' . urldecode($this->input->get('status')) . '"';
        }
        
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
        }
        
        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
                $loc = implode('","', $this->locations[$this->input->get('location')]);
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . '(
                    (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $loc . '"))
                    OR 
                    (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $loc . '"))
                )';
            } else if ($booking_type != 'all') {
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . '(
                    (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr = "' . $booking_type . '")
                    OR 
                    (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr = "' . $booking_type . '")
                )';
            }
        }

        if ($this->input->get('company_id') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
        }

        if ($this->session->userdata('admin_type') != 'superadmin' && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com', 'combo1@kazindmc.com']) && $this->session->userdata('type') != '3') {
            $where_and = ($where != '') ? ' AND ' : '';
            $session_locations = explode(',', $this->session->userdata('locations'));
            $all_locations = [];
            foreach ($session_locations as $loc) {
                if (isset($this->locations[$loc])) {
                    $all_locations = array_merge($all_locations, $this->locations[$loc]);
                }
            }
            $assigned_loc = implode('","', $all_locations);
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
                OR 
                (arrivals.combo_enquiry_id IS NOT NULL AND combo_enquiry.enquiry_abbr IN ("' . $assigned_loc . '"))
            )';
        }

        // Update SELECT for combo enquiries - same as index() method
        $select = 'arrivals.*, arrivals.split_number AS split_num, transportation.vehicle_type, guides.name AS guide, ';
        $select .= 'enquiry.enquiry_no, ';
        $select .= 'CASE WHEN arrivals.combo_enquiry_id IS NOT NULL THEN combo_enquiry.enquiry_abbr ELSE enquiry.enquiry_abbr END AS enquiry_abbr, ';
        $select .= 'enquiry.number_persons, enquiry.number_child, enquiry.number_of_nights, enquiry.split_count, admin.name AS staff_name, company.name, hotel_sub.hotel_name,';
        $select .= 'SUM(payment_details.payment_recieved_in_india) AS paymentreceived_india, SUM(payment_details.payment_recieved_in_other) AS paymentrecieved_in_other';

        $hotel_subquery = "(SELECT arrival_id, MIN(hotel_name) AS hotel_name FROM arrival_hotel_details GROUP BY arrival_id) AS hotel_sub";
        
        $join = [
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'combo_enquiry', 'condition' => 'combo_enquiry.id = arrivals.combo_enquiry_id'],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = arrivals.transportation_id'],
            ['type' => 'LEFT', 'join_table' => 'guides', 'condition' => 'guides.id = arrivals.guide_id'],
            ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = arrivals.handling_staff_id'],
            ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],
            ['type' => 'LEFT', 'join_table' => 'payment_details', 'condition' => 'payment_details.arrival_id = arrivals.id'],
            ['type' => 'LEFT', 'join_table' => $hotel_subquery, 'condition' => 'hotel_sub.arrival_id = arrivals.id'],
        ];

        // Handle country filter for both regular and combo enquiries - same as index() method
        if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
            $country = $this->input->get('country');
            if(strlen($country) > 1){
                $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia' => 'GE', 'Belarus' => 'BE', 'Armenia' => 'AR', 'Uzbekistan' => 'UZ'];
                $abbr = $countryMapping[$country];
            } else { 
                $abbr = $country; 
            }
            
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND SUBSTR(enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '")
                OR 
                (arrivals.combo_enquiry_id IS NOT NULL AND SUBSTR(combo_enquiry.enquiry_abbr, 1, 2) = "' . $abbr . '")
            )';
        }

        // Handle query number filter for both regular and combo enquiries - same as index() method
        if ($this->input->get('query_number') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . '(
                (arrivals.combo_enquiry_id IS NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
                OR 
                (arrivals.combo_enquiry_id IS NOT NULL AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '")
            )';
        }

        if(!empty($this->input->get('confirm_cnt'))){
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and .' date(arrivals.created) = "' . date('Y-m-d') . '"';
        }

        if($where == ''){
            $where = ' (1=1) ';
        }

        $result = $this->common_model->get_data('arrivals', '', '', $select, $where, ' GROUP BY arrivals.id ORDER BY arrivals.arrival_date ASC', $count = false, $join);
        
        // Rest of your Excel generation code remains the same...
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Query Number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Physical Arrival Date');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Number Of Nights');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Handling Staff Name');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Hotel Name');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Transportation');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Guide');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Group Type');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Handover To Client');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Nos. Of Guests');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Company Name');
        $excel_col = 'M';
        if (in_array($this->session->userdata('type'), ['1', '3'])) {
            $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Currency');
            $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Client Billing');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Payment Received In India');
            $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Payment Received In Almaty');
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Balance Amount');
            $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Payment Remarks');
            $excel_col = 'S';
        }
        $objPHPExcel->getActiveSheet()->setCellValue($excel_col . '1', 'Status');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $val) {
                $split = '';
                if(substr($val->enquiry_no,0,1) == 'G' && $val->split_number != 0){
                    $split = ' (Split-'.$val->split_number.')';
                    $val->number_persons = $val->num_adults;
                    $val->number_child = $val->num_child;
                }
                $where = 'payment_details.arrival_id= ' . $val->id;
                $select = 'payment_details.remarks';
                $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $select, $where, ' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
                $remarks = (!empty($payment_details_remarks)) ? $payment_details_remarks[0]->remarks : '';

                $where = 'arrival_hotel_details.enquiry_id = '.$val->enquiry_id;
                $select = 'arrival_hotel_details.hotel_name';
                $hotel = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,' ORDER BY arrival_hotel_details.id DESC LIMIT 1', $count = false);
                $hotel_name = (!empty($hotel)?$hotel[0]->hotel_name:'');

                $arrival_id = $val->id;
                $enq_id = $val->enquiry_id;
                $this->db->select('*');
                $this->db->from('combo_enquiry');
                $this->db->where('id =', $val->combo_enquiry_id);
                $enquiry = $this->db->get()->result_array();
                
                // Calculate number of guests with fallback logic
                $number_of_guests = (($val->number_persons == '') ? 0 : $val->number_persons) + (($val->number_child == '') ? 0 : $val->number_child);
                
                // If the main calculation results in 0, try to get from enquiry array
                if ($number_of_guests == 0 && !empty($enquiry)) {
                    // Try different possible field combinations
                    if (isset($enquiry[0]['no_of_person']) && isset($enquiry[0]['no_of_child'])) {
                        $number_of_guests = $enquiry[0]['no_of_person'] + $enquiry[0]['no_of_child'];
                    } 
                    else if (isset($enquiry[0]['number_persons']) && isset($enquiry[0]['number_child'])) {
                        $number_of_guests = $enquiry[0]['number_persons'] + $enquiry[0]['number_child'];
                    }
                    else if (isset($enquiry[0]['no'])) {
                        $number_of_guests = $enquiry[0]['no'];
                    }
                }

                $night_count = $val->number_of_nights;

                if (empty($night_count)) {
                    if (!empty($enquiry) && !empty($enquiry[0]['no_of_nights'])) {
                        $night_count = $enquiry[0]['no_of_nights'];
                    } else {
                        $night_count = ''; // fallback if nothing exists
                    }
                }

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->enquiry_no.$split);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, date('d-M-Y', strtotime($val->arrival_date)));
                // $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, !empty($val->number_of_nights) ? $val->number_of_nights : $enquiry[0]['no_of_nights']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $night_count);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->staff_name);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $hotel_name);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $val->vehicle_type);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ($val->guide <> '') ? $val->guide : '');
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $val->group_type);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->handover_to_client);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $number_of_guests);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $val->name);
                if (in_array($this->session->userdata('type'), ['1', '3'])) {
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucfirst($val->currency));
                    $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $val->client_billing);
                    $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, (int)$val->payment_received_india + (int)$val->paymentreceived_india);
                    $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, (int)$val->payment_received_almaty + (int)$val->paymentrecieved_in_other);
                    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $val->balance_amount);
                    $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $remarks);
                }
                $objPHPExcel->getActiveSheet()->setCellValue($excel_col . $row, ucfirst($val->status));
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . 'Arrivals_list_' . date('d-m-Y') . '.xlsx' . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }  
}