<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['admin/hotel_model', 'hotel_model', 'admin/user_model', 'common_model']);
        check_delete();
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
        // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        // $this->form_validation->set_rules('category', 'Category', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            $this->load->view('admin/hotel', $data);

        } else {

            $response = $this->hotel_model->add_new_hotel();

            if ($response['success'] == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('all-hotel');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
        // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        // $this->form_validation->set_rules('category', 'Category', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        $hotel_id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('all-hotel');

        if ($this->form_validation->run() == FALSE) {
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            $where = 'id = ' . $hotel_id;
            $data['hotels'] = $this->common_model->get_data('hotels', '', '', '*', $where, '', $count = false)[0];

            $this->load->view('admin/hotel_edit', $data);

        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'email' => $this->input->post('email'),
                'isd_codes' => $this->input->post('isd_codes'),
                'mobile' => $this->input->post('mobile'),
                'contact_person_name' => $this->input->post('contact_person_name'),
                'remarks' => $this->input->post('remarks'),
                'pincode' => $this->input->post('pincode'),
                'status' => 'active',
                'map' => $this->input->post('map'),
                'category' => $this->input->post('category')
            );

            if ($_FILES['hotel_image']['name'] != '') {
                $this->load->library('upload');
                $config['upload_path'] = './uploads/hotels/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['hotel_image']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('hotel_image')) {
                    //echo $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                    $data['image'] = $file['file_name'];
                }
            }
            $id = $this->common_model->update_data_limit(['table_name' => 'hotels', 'update_data' => $data, 'condition' => ['id' => $hotel_id]]);
            if ($id) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                redirect('all-hotel');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function hotel_list()
    {
        $country = '';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $country = ($this->session->userdata('locations') != 'all') ? ucfirst($this->session->userdata('locations')) : '';
        }
        $data['hotels'] = $this->hotel_model->all_hotels($country);
        $this->load->view('admin/hotel_list', $data);
    }

    public function room_category()
    {
        $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
        $where = 'hotel_id = ' . $hotel_id;
        $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false);
        $category_id = '';
        if ($this->input->get('category_id') <> '') {
            $category_id = base64_decode($this->input->get('category_id'));
            ($category_id == '') ? redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id)) : '';
            $where = 'hotel_id = ' . $hotel_id . ' AND id = ' . $category_id;
            $data['category'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false)[0];
            if (empty($data['category'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
                redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
            }
        }

        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
        $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
        $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/hotel_room_category', $data);
        } else {
            $arr = array(
                'category_name' => $this->input->post('category_name'),
                'max_accomodation' => $this->input->post('max_accomodation'),
                'number_adults' => $this->input->post('adult_number'),
                'number_childs' => $this->input->post('child_number'),
                'child_bed' => $this->input->post('child_bed'),
                'added_by' => $this->session->userdata('id'),
            );
            if ($category_id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $id = $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);
            }
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }
    }

    public function room_category_cost()
    {
        $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
        $category_id = base64_decode($this->input->get('category_id'));
        ($category_id == '') ? redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id)) : '';
        $id = base64_decode($this->input->get('id'));

        $where = 'hotel_id = ' . $hotel_id . ' AND category_id = ' . $category_id;
        $data['category_cost'] = $this->common_model->get_data('room_category_costs', '', '', '*', $where, '', $count = false);

        if (!empty($id)) {
            $where = 'id = ' . $id;
            $data['category'] = $this->common_model->get_data('room_category_costs', '', '', '*', $where, '', $count = false)[0];
        }

        if (empty($data['category_cost'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
        }

        $this->form_validation->set_rules('valid_from', 'Valid From', 'trim|required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'trim|required');
        $this->form_validation->set_rules('basic_cost', 'Basic Cost', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/room_hotel_category_cost', $data);
        } else {

            $valid_from = $this->input->post('valid_from');
            $valid_to = $this->input->post('valid_to');


            foreach ($data['category_cost'] as $category) {
                $existing_valid_from = $category->valid_from;
                $existing_valid_to = $category->valid_to;
                if (
                    ($valid_from >= $existing_valid_from && $valid_from <= $existing_valid_to) ||
                    ($valid_to >= $existing_valid_from && $valid_to <= $existing_valid_to)
                ) {
                    // Dates overlap, show error message
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing record!</div>');
                    redirect('room-category-cost?hotel_id=' . base64_encode($hotel_id) . '&category_id=' . base64_encode($category_id));
                }
            }

            $arr = array(
                'valid_from' => $valid_from,
                'valid_to' => $valid_to,
                'basic_cost' => $this->input->post('basic_cost'),
                'reason' => $this->input->post('reason'),
                'extra_cost' => $this->input->post('extra_cost'),
            );

            if ($id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $this->common_model->update_data_limit(['table_name' => 'room_category_costs', 'update_data' => $arr, 'condition' => ['id' => $id]]);
            } else {
                $insert_arr = $arr + ['category_id' => $category_id, 'hotel_id' => $hotel_id];
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $id = $this->common_model->insert_data(['table_name' => 'room_category_costs', 'insert_data' => $insert_arr]);
            }
            redirect('room-category-cost?hotel_id=' . base64_encode($hotel_id) . '&category_id=' . base64_encode($category_id));
        }
    }

    public function get_rooms_category()
    {
        $this->form_validation->set_rules('hotel_id', 'Hotel', 'trim|required|integer');

        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $hotel_id = $this->input->post('hotel_id');
        $where = 'hotel_id = ' . $hotel_id;
        $data['room_categories'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false);

        $enq_id = $this->input->post('enq_id');
        $details_id = $this->input->post('hotel_details_id');
        $where = 'hotel_id = ' . $hotel_id . ' AND enquiry_id = ' . $enq_id . ' AND id = ' . $details_id;
        $data['hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = false)[0];

        if (empty($data)) {
            $response = ['response' => 'e', 'details' => '', 'msg' => 'No room categories found!'];
            echo json_encode($response);
            exit;
        } else {
            $response = ['response' => 's', 'details' => $data, 'msg' => ''];
            echo json_encode($response);
            exit;
        }

    }

    public function delete_hotel()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-hotel');
        $where = ' arrival_hotel_details.hotel_id = '.$id;
        $hotels = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = true);
        if($hotels){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Arrivals hotel details found. Hotel cannot be deleted.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $update_arr = ['status' => 'deleted'];
        $id = $this->common_model->update_data_limit(['table_name' => 'hotels', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($id) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('all-hotel');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
    
    public function merge_hotels(){
        $allowed_users = ['1'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('main_hotel_id', 'Main Hotel', 'trim|required');
        $this->form_validation->set_rules('hotels_merger[]', 'Merging Hotels', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/merge_hotels');
        } else {
            //echo '<pre>';print_r($this->input->post());exit;
            $hotel_merger_arr = $this->input->post('hotels_merger');
            $main_hotel_id = $this->input->post('main_hotel_id');
            $hotel_merger = implode(',',$hotel_merger_arr);
            
            $sql_hotel_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = hotel_room_categories.hotel_id, hotel_room_categories.hotel_id="'.$main_hotel_id.'" WHERE hotel_room_categories.hotel_id IN('.$hotel_merger.')';
            $this->db->query($sql_hotel_categories);
            
            $sql_company = 'UPDATE `hotels` SET status="deleted", hotels.main_hotel_id = "'.$main_hotel_id.'", hotels.merge_status="yes", hotels.modified = "'.date('Y-m-d H:i:s').'" WHERE hotels.id IN('.$hotel_merger.')';
            $this->db->query($sql_company);
            
            foreach($hotel_merger_arr AS $list){
                $where = ' arrival_hotel_details.hotel_id = ' .$list;
                $arrival_hotel_details = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = false);
                foreach($arrival_hotel_details AS $enq){
                    $insert_arr = ['arrival_hotel_details_id'=>$enq->id,'previous_hotel_id'=>$list,'main_hotel_id'=>$main_hotel_id,
                                    'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
                    $id = $this->common_model->insert_data(['table_name' => 'arrival_hotel_details_merge_logs', 'insert_data' => $insert_arr]);
                    if($id){
                        $update_arr = ['hotel_id' => $main_hotel_id];
                        $update_data = ['table_name' => 'arrival_hotel_details', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message','<div class="alert alert-success">Hotels Merged Successfully.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function hotel_name_suggesstion()
    {
        $response = array();
        $this->db->select('*');
        if (!empty($this->input->post('search'))) {
            $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status', 'active');
            $this->db->limit(10);
            $records = $this->db->get('hotels')->result();
            foreach ($records as $row) {
                $response[] = array("hotel_id" => $row->id, "label" => trim($row->name));
            }
        }
        echo json_encode($response);
    }
    
    public function hotel_names_merge(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id[] = $this->input->post('main_hotel_id');
        $hotel_ids = array_merge($main_hotel_id, (!empty($this->input->post('hotels_merger')))?$this->input->post('hotels_merger'):[]);
        
        $response = array();
        $this->db->select('*');
        if(!empty($this->input->post('search'))) {
            $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status ', 'active');
            $this->db->where_not_in('id', $hotel_ids);
            $this->db->limit(10);
            $records = $this->db->get('hotels')->result();
            foreach ($records as $row) {
                $response[] = array("hotel_id" => $row->id, "label" => trim($row->name));
            }
        }
        echo json_encode($response);
    }
    
    public function get_merged_hotels(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id = $this->input->post('revoke_main_hotel_id');
        $where = 'hotels.main_hotel_id = "'.$main_hotel_id.'"';
        $select = 'hotels.*';
        $data['merged_hotels'] = $this->common_model->get_data('hotels', '', '', $select, $where, '', $count = false);
        echo json_encode($data);
    }
    
    public function revoke_merged_hotel(){
        
        $this->form_validation->set_rules('hotel_id', 'Hotel To Revoke', 'trim|required');
        $this->form_validation->set_rules('revoke_main_hotel_id', 'Main Hotel To Revoke', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $hotel_revoke_id = $this->input->post('hotel_id');
        $revoke_main_hotel_id = $this->input->post('revoke_main_hotel_id');
        
        $where = 'arrival_hotel_details_merge_logs.status = "active" AND arrival_hotel_details_merge_logs.previous_hotel_id = ' . $hotel_revoke_id;
        $select = '*';
        $hotel_data = $this->common_model->get_data('arrival_hotel_details_merge_logs', '', '', $select, $where, '', $count = false);
        //echo '<pre>';print_r($hotel_data);exit;
        
        $sql_hotel_room_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = 0, hotel_room_categories.hotel_id = '.$hotel_revoke_id.' WHERE hotel_room_categories.previous_hotel_id = '.$hotel_revoke_id;
        $this->db->query($sql_hotel_room_categories);
        
        $sql_logs = 'UPDATE `arrival_hotel_details_merge_logs` SET arrival_hotel_details_merge_logs.status = "rollback", arrival_hotel_details_merge_logs.modified="'.date('Y-m-d H:i:s').'", arrival_hotel_details_merge_logs.rollback_admin_id = '.$this->session->userdata('id').' WHERE arrival_hotel_details_merge_logs.main_hotel_id = '.$revoke_main_hotel_id.' AND arrival_hotel_details_merge_logs.previous_hotel_id = '.$hotel_revoke_id.' AND arrival_hotel_details_merge_logs.status="active"';
        $this->db->query($sql_logs);
        
        $sql_hotels = 'UPDATE `hotels` SET status = "active", hotels.main_hotel_id = 0, hotels.merge_status="no", hotels.modified = "'.date('Y-m-d H:i:s').'" WHERE hotels.id = "'.$hotel_revoke_id.'"';
        $this->db->query($sql_hotels);
        
        if(!empty($hotel_data)){
            $hotel_ids = [];
            foreach($hotel_data AS $list){
                $arrival_hotel_details_ids[] = $list->arrival_hotel_details_id;
            }
            $arrival_hotel_details = implode(',',$arrival_hotel_details_ids);
            $sql_hotel_details = 'UPDATE `arrival_hotel_details` SET arrival_hotel_details.hotel_id = '.$hotel_revoke_id .' WHERE arrival_hotel_details.id IN('.$arrival_hotel_details.')';
            $this->db->query($sql_hotel_details);
        }
        echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Hotel rollbacked successfully!</div>']);
        exit;
    }
    
        public function room_category_costing()
    {
        // $this->form_validation->set_rules('adultprice_with_breakfast[]', 'Adultprice with Breakfast', 'trim|required');
        // $this->form_validation->set_rules('adultprice_without_breakfast[]', 'Adultprice without Breakfast', 'trim|required');
        // $this->form_validation->set_rules('child_bed[]', 'Child Bed', 'trim|required');
        // $this->form_validation->set_rules('childprice_with_breakfast[]', 'Child Price with Breakfast', 'trim|required');
        // $this->form_validation->set_rules('childprice_without_breakfast', 'Child Price with Breakfast', 'trim|required');

        // $this->form_validation->set_error_delimiters('', '<br>');

        // if ($this->form_validation->run() == FALSE) {
        //     echo json_encode(['response' => 'e', 'msg' => validation_errors()]);
        //     exit;
        // }

        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $adultprice_with_breakfast = $this->input->post('adultprice_with_breakfast');
        $adultprice_without_breakfast = $this->input->post('adultprice_without_breakfast');

        $childprice_with_breakfast = $this->input->post('childprice_with_breakfast');
        $childprice_without_breakfast = $this->input->post('childprice_without_breakfast');

        $category_id = $this->input->post('category_id');
        $hotel_id = $this->input->post('hotel_id');
        $child_bed = $this->input->post('child_bed');

        $adultData = array();
        $childData = array();

        for ($i = 0; $i < count($adultprice_with_breakfast); $i++) {

            $adultData[] = array(
                'category_id' => base64_decode($category_id),
                'hotel_id' => base64_decode($hotel_id),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'person_count' => $i + 1,
                'price_with_breakfast' => $adultprice_with_breakfast[$i],
                'price_without_breakfast' => $adultprice_without_breakfast[$i],
                'child_bed' => '',
                'type' => 'adult',
                'admin_id' => $this->session->userdata('id'),
            );
        }

        for ($i = 0; $i < count($childprice_with_breakfast); $i++) {

            $childData[] = array(
                'category_id' => base64_decode($category_id),
                'hotel_id' => base64_decode($hotel_id),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'person_count' => $i + 1,
                'price_with_breakfast' => $childprice_with_breakfast[$i],
                'price_without_breakfast' => $childprice_without_breakfast[$i],
                'child_bed' => $child_bed[$i],
                'type' => 'child',
                'admin_id' => $this->session->userdata('id'),
            );
        }

        try {
            // Insert adult data if present
            if (!empty($adultData) && !empty($childData)) {
                $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $adultData]);
                $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $childData]);

                echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Category Price created successully!']);
                exit;
            } else {
                echo json_encode(['response' => 'e', 'details' => '', 'msg' => 'Room Category Price not created!']);
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
        public function get_costing_data()
    {
        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $hotel_id = $this->input->get('hotel_id');
        $category_id = $this->input->get('category_id');

        // Build the where clause with conditions for both adult and child
        $where = '(room_category_costing.person_count = ' . $adult . ' AND room_category_costing.type = \'adult\')';
        $where .= ' OR (room_category_costing.person_count = ' . $child . ' AND room_category_costing.type = \'child\')';
        $where .= ' AND room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;

        $data = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);

        echo json_encode(['response' => 'success', 'details' => $data]);
        exit;
    }
    

}