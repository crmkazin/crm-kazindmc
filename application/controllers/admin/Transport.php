<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        $this->load->model(['admin/transport_model', 'transport_model', 'common_model']);
    }

    public function index()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehical Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', 'Vehical Type', 'trim|required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required');
        // $this->form_validation->set_rules('remarks', 'Remark', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Transport Add',$this->session->userdata('id'), 'Transport: Add');
            $data['content'] = 'admin/transport';
            $this->load->view('admin/layout',$data);
        } else {

            $response = $this->transport_model->add_new_transportation();

            if ($response['success'] == 1) {
                $id = $response['id'];
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

                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Transport Add New ',$this->session->userdata('id'), 'Transport: Add New ');
                redirect('all-transport');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Transport Add Error',$this->session->userdata('id'), 'Transport: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehical Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', 'Vehical Type', 'trim|required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required');
        // $this->form_validation->set_rules('remarks', 'Remark', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        $transport_id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('all-transport');

        $where= ['id' => $transport_id];
            $existing = $this->common_model->get_single(['table_name' => 'transportation', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'vehicle_name' => $existing['vehicle_name'],
                    'country'         => $existing['country'],
                    'state'         => $existing['state'],
                    'city'         => $existing['city'],
                    'vehicle_type'         => $existing['vehicle_type'],
                    'capacity'         => $existing['capacity'],
                    'remarks'         => $existing['remarks'],
                    'year'         => $existing['year'],
                    'make'         => $existing['make'],
                    'luggage_transport'         => $existing['luggage_transport'],
                    'luggage'         => $existing['luggage'],
                    'overnight_full_day'   => $existing['overnight_full_day'],
                ];
            } else {
                $previous_data = []; 
            }
            $where1= ['transportation_id' => $transport_id];
            $existing1 = $this->common_model->get_single(['table_name' => 'transportation_images', 'condition'  => $where1 ]);
            if (!empty($existing1)) {
                $previous_data1 = [
                    'image' => $existing1['image'],
                ];
            } else {
                $previous_data1 = []; 
            }

        if ($this->form_validation->run() == FALSE) {
            $where = 'id = ' . $transport_id;
            $data['transport'] = $this->common_model->get_data('transportation', '', '', '*', $where, '', $count = false)[0];
            log_user_activity('Transport: Edit',$this->session->userdata('id'), 'Transport: Edit');
            $data['content'] = 'admin/transport_edit';
            $this->load->view('admin/layout', $data);
        } else {
            $luggage_transport = '';
            if (array_key_exists('luggage_transport', $_POST) && $this->input->post('luggage_transport') == 'on') {
                $luggage_transport = 'yes';
            }
            $data = array(
                'vehicle_name'   => $this->input->post('vehicle_name'),
                'country'   => $this->input->post('country'),
                'state'   => $this->input->post('state'),
                'city'   => $this->input->post('city'),
                'vehicle_type'   => $this->input->post('vehicle_type'),
                'capacity'       => $this->input->post('capacity'),
                'remarks'        => $this->input->post('remarks'),
                'year' =>   $this->input->post('year'),
                'make' =>   $this->input->post('make'),
                'luggage_transport' => $luggage_transport,
                'luggage' =>   $this->input->post('luggage'),
                'overnight_full_day' =>   $this->input->post('overnight_full_day'),

            );

            $rows = $this->common_model->update_data_limit(['table_name' => 'transportation', 'update_data' => $data, 'condition' => ['id' => $transport_id]]);

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
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = $transport_id . '_' . time() . '_' . str_replace(' ', '_', $_FILES['img']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img')) {
                        //echo $this->upload->display_errors();
                    } else {
                        $filename = $this->upload->data();
                        $insert_uploads[$i] = ['transportation_id' => $transport_id, 'image' => $filename['file_name'], 'created' => $created];
                    }
                }
            }
            if (!empty($insert_uploads)) {
                $this->common_model->insert_data_batch(['table_name' => 'transportation_images', 'insert_data' => $insert_uploads]);
            }


            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            log_user_activity('Transport: Update',$this->session->userdata('id'), 'Previuos Data:'. json_encode($previous_data).json_encode($previous_data1));
            redirect('all-transport');
        }
    }


    // public function transport_list()
    // {
    //     log_user_activity('Transport View',$this->session->userdata('id'), 'Transport: View');
    //     $country = '';
    //     if ($this->session->userdata('admin_type') != 'superadmin') {
    //         $country = ($this->session->userdata('locations') != 'all') ? ucfirst($this->session->userdata('locations')) : '';
    //     }
    //     $data['transportations'] = $this->transport_model->all_transportations($country);
    //     $data['content'] = 'admin/transportation_list';
    //     $this->load->view('admin/layout', $data);
    // }

    public function transport_list()
    {
        log_user_activity('Transport View', $this->session->userdata('id'), 'Transport: View');

        $filters = [];
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                'state' => $this->input->get('state'),
                'city'    => $this->input->get('city')
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }

        $locations = '';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $locations = $this->session->userdata('locations');

            if (!empty($locations) && $locations != 'all') {
                // If multiple locations stored as comma-separated, convert to array
                $locations = array_map('ucfirst', explode(',', $locations));
            } else {
                $locations = '';
            }
        }

        $data['transportations'] = $this->transport_model->all_transportations($locations, $filters);
        $data['content'] = 'admin/transportation_list';
        $this->load->view('admin/layout', $data);
    }


    public function delete_transport()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-transport');
        $update_arr = ['status' => 'deleted'];
        $id = $this->common_model->update_data_limit(['table_name' => 'transportation', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($id) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Transport Delete',$this->session->userdata('id'), 'Transport: Deleted');
            redirect('all-transport');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Transport Delete Error',$this->session->userdata('id'), 'Transport: Delete(Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // public function transportation_cost()
    // {
    //     $transport_id = ($this->input->get('transport_id') <> '' && base64_decode($this->input->get('transport_id')) <> '') ? base64_decode($this->input->get('transport_id')) : redirect('all-transport');
    //     $id = base64_decode($this->input->get('id'));

    //     $where = 'transport_id = ' . $transport_id;
    //     $data['transport_cost'] = $this->common_model->get_data('transportation_costs', '', '', '*', $where, '', $count = false);

    //     if (empty($data['transport_cost'])) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
    //     }

    //     if (!empty($id)) {
    //         $where = 'id = ' . $id;
    //         $data['transport_costs'] = $this->common_model->get_data('transportation_costs', '', '', '*', $where, '', $count = false)[0];
    //     }

    //     $this->form_validation->set_rules('valid_from', 'Valid From', 'trim|required');
    //     $this->form_validation->set_rules('valid_to', 'Valid To', 'trim|required');
    //     $this->form_validation->set_rules('cost', 'Cost', 'trim|required|integer');
    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('admin/transportation_cost', $data);
    //     } else {

    //         $valid_from = $this->input->post('valid_from');
    //         $valid_to = $this->input->post('valid_to');

    //         foreach ($data['transport_cost'] as $transport) {
    //             $existing_valid_from = $transport->valid_from;
    //             $existing_valid_to = $transport->valid_to;
    //             if (
    //                 ($valid_from >= $existing_valid_from && $valid_from <= $existing_valid_to) ||
    //                 ($valid_to >= $existing_valid_from && $valid_to <= $existing_valid_to)
    //             ) {
    //                 // Dates overlap, show error message
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing record!</div>');
    //                 redirect('transportation-cost?transport_id=' . base64_encode($transport_id));
    //             }
    //         }

    //         $arr = array(
    //             'valid_from' => $valid_from,
    //             'valid_to' => $valid_to,
    //             'cost' => $this->input->post('cost'),
    //         );

    //         if ($id <> '') {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //             $this->common_model->update_data_limit(['table_name' => 'transportation_costs', 'update_data' => $arr, 'condition' => ['id' => $id]]);
    //         } else {
    //             $insert_arr = $arr + ['transport_id' => $transport_id];
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
    //             $id = $this->common_model->insert_data(['table_name' => 'transportation_costs', 'insert_data' => $insert_arr]);
    //         }
    //         redirect('transportation-cost?transport_id=' . base64_encode($transport_id));

    //     }

    // }

    public function transportation_cost()
    {
        // Use POST instead of GET
        $transport_id = base64_decode($this->input->post('id'));
		
        $where = 'id = ' . $transport_id;
        $transport = $this->common_model->get_data('transportation', '', '', '*', $where, '', $count = false)[0];

        $transport_cost = [];
		if(array_key_exists('valid_dates',$this->input->post())){
			$valid_dates = explode('_',$this->input->post('valid_dates'));
			$where = 'transport_id = ' . $transport_id .' AND (valid_from >= "'.$valid_dates[0].'" AND valid_to <= "'.$valid_dates[1].'")';
			$transport_cost = $this->common_model->get_data('transportation_costs', '', '', '*', $where, '', $count = false);
		}

        $where = 'transport_id = ' . $transport_id;
        $select = 'outsidecity_transportation_costs.*,sites.location_name as loc';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'sites', 'condition' => 'sites.id = outsidecity_transportation_costs.sites_id'],
        ];

        $outside_transport_cost = $this->common_model->get_data('outsidecity_transportation_costs', '', '', $select, $where, '', $count = false, $join);

        echo json_encode(['response' => 'success', 'transport' => $transport, 'transport_cost' => $transport_cost, 'outside_transport_cost' => $outside_transport_cost]);
        exit;
    }
	
	public function get_transportation_details(){
		$transport_id = base64_decode($this->input->post('id'));
		
		$where = 'id = ' . $transport_id;
        $transport = $this->common_model->get_data('transportation', '', '', '*', $where, '', $count = false)[0];
		
		$where = 'transport_id = ' . $transport_id;
        $select = 'transportation_costs.transport_id,CONCAT(transportation_costs.valid_from,"_",transportation_costs.valid_to) AS d';
        $transportation_details = $this->common_model->get_data('transportation_costs', '', '', $select, $where, ' GROUP BY transportation_costs.valid_from,transportation_costs.valid_to', $count = false);

        echo json_encode(['response' => 'success', 'transport' => $transport,'transportation_details' => $transportation_details]);
        exit;
	}
    	
    // 	12 frb 2026 old code
    //  public function transportation_cost_add()
    //  {
    // 		//echo '<pre>';print_r($this->input->post());exit;
    //         $id = $this->input->post('id');
    //         $transport_ids = $this->input->post('transport_id');
    //         $currency_type = $this->input->post('currency');
    //         $types = $this->input->post('type');
    //         $prices = $this->input->post('price');
    //         $start_times = $this->input->post('start_time');
    //         $end_times = $this->input->post('end_time');
    //         $hours = $this->input->post('hours');
    //         $data = [];
    
    //         if (empty(array_filter($id))) {
    //             // Insert new records
    //             foreach ($start_times as $index => $start_time) {
    //                 $data[] = [
    // 				'transport_id' => $transport_ids,
    // 				'currency' => $currency_type,
    // 				'type' => $types[$index],
    // 				'price' => $prices[$index],
    // 				'start_time' => $start_time,
    // 				'end_time' => $end_times[$index],
    // 				'hours' => $hours[$index],
    // 				'created_at' => date('Y-m-d H:i:s'),
    // 				'created_by' => $this->session->userdata('id'),
    // 				'valid_from'=> $this->input->post('valid_from'),
    // 				'valid_to'=>$this->input->post('valid_to')
    //                 ];
    //             }
    
    //             if (!empty($transport_ids)) {
    //                 foreach ($data as $record) {
    //                     $this->common_model->insert_data([
    //                         'table_name' => 'transportation_costs',
    //                         'insert_data' => $record
    //                     ]);
    //                 }
    //             }
    
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Prices added successfully!</div>');
    //             log_user_activity('Transport: Transportation Cost Add',$this->session->userdata('id'), 'Transportation Cost: '. json_encode($data));
    //             redirect('all-transport');
    //         } else {
    
    //             $update_data = [];
    
    //             foreach ($start_times as $index => $start_time) {
                    
    //                     // Fetch previous data for each specific id before updating
    //                     $current_id = $id[$index];
    //                     $where = 'id = ' . $current_id;
    //                     $existing = $this->common_model->get_single([
    //                         'table_name' => 'transportation_costs',
    //                         'condition'  => $where
    //                     ]);
                    
    //                     if (!empty($existing)) {
    //                         $previous_data[] = [
    //                             'id' => $existing['id'],
    //                             'type' => $existing['type'],
    //                             'start_time' => $existing['start_time'],
    //                             'end_time' => $existing['end_time'],
    //                             'hours' => $existing['hours'],
    //                             'price' => $existing['price'],
    //                             'valid_from' => $existing['valid_from'],
    //                             'valid_to' => $existing['valid_to'],
    //                         ];
    //                     }
    
    //                 $update_data[] = [
    //                     'id' => $id[$index], // Keep id separately
    //                     'data' => [
    // 					'type' => $types[$index],
    // 					'start_time' => $start_time,
    // 					'end_time' => $end_times[$index],
    // 					'hours' => $hours[$index],
    // 					'price' => $prices[$index],
    // 					'created_at' => date('Y-m-d H:i:s'),
    // 					'created_by' => $this->session->userdata('id'),
    // 					'valid_from'=> $this->input->post('valid_from'),
    // 					'valid_to'=>$this->input->post('valid_to')
    //                     ]
    //                 ];
    //             }
    //             // Update records without id in the set data
    //             foreach ($update_data as $entry) {
    //                 if (!empty($entry['id'])) {
    //                     $this->db->where('id', $entry['id']);
    //                     $this->db->update('transportation_costs', $entry['data']); // Use only data array
    //                 }
    //             }
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Prices updated successfully!</div>');
    //             log_user_activity('Transport: Transportation Cost Update',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
    //             redirect('all-transport');
    //         }
    //     }

    // public function outside_locations()
    // {
    //     $searchTerm = $this->input->post('search');
    //     $country = $this->input->post('country');
    //     $transport_id = $this->input->post('transport_id');
    //     // Fetch distinct sites based on the search term and country
    //     $this->db->distinct();
    //     $this->db->select('sites.id, sites.location_name,sites.location_ids');
    //     $this->db->where('lower(country)', trim(strtolower($country)));
    //     $this->db->like('location_name', trim($searchTerm),'both');
    //     $this->db->group_by('location_ids');
    //     $this->db->from('sites');
    //     $query = $this->db->get();
    //     //echo $this->db->last_query();
    //     // Fetch all existing records from outsidecity_transportation_costs
    //     $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', 'CONCAT(sites_id,"_",transport_id) AS ids', '', '', $count = false);

    //     // Extract existing site IDs into an array
    //     $existing_site_ids = [];
    //     foreach ($exist_record as $record) {
    //         $existing_site_ids[] = $record->ids;
    //     }
        
    //     // Compare and filter $query results
    //     $data = [];
    //     foreach ($query->result() as $row) {
    //         if (!in_array($row->id.'_'.$transport_id, $existing_site_ids)) {
    //             $data[] = [
    //                 'label' => $row->location_name,
    //                 'id' => $row->id,
    //                 'location_ids' => $row->location_ids
    //             ];
    //         }
    //     }

    //     // Output data as JSON for jQuery UI autocomplete
    //     echo json_encode($data);
    // }
    
    public function outside_locations()
    {
        $searchTerm = $this->input->post('search');
        $country = $this->input->post('country');
        $transport_id = $this->input->post('transport_id');
        // Fetch distinct sites based on the search term and country
        $this->db->distinct();
        $this->db->select('sites.id, sites.location_name,sites.location_ids');
        $this->db->where('lower(country)', trim(strtolower($country)));
        $this->db->like('location_name', trim($searchTerm),'both');
        $this->db->group_by('location_ids');
        $this->db->from('sites');
        $query = $this->db->get();
        //echo $this->db->last_query();
        // Fetch all existing records from outsidecity_transportation_costs
        $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', 'CONCAT(sites_id,"_",transport_id) AS ids', '', '', $count = false);

        // Extract existing site IDs into an array
        $existing_site_ids = [];
        foreach ($exist_record as $record) {
            $existing_site_ids[] = $record->ids;
        }
        
        // Compare and filter $query results
        $data = [];
        foreach ($query->result() as $row) {
            if (!in_array($row->id.'_'.$transport_id, $existing_site_ids)) {
                $data[] = [
                    'label' => $row->location_name,
                    'id' => $row->id,
                    'location_ids' => $row->location_ids,
                    'type'         => 'site'
                ];
            }
        }

        // If no sites found, also check hotels
        if (empty($data)) {
            $this->db->select('id, name');
            $this->db->from('hotels');
            $this->db->where('destination', 'outside');
            $this->db->where('country', trim(strtolower($country)));
            $this->db->like('name', trim($searchTerm), 'both');
            $hotelQuery = $this->db->get();

            foreach ($hotelQuery->result() as $hotel) {
                $data[] = [
                    'label'        => $hotel->name,
                    'id'           => '',
                    'location_ids' => $hotel->id,
                    'type'         => 'hotel'
                ];
            }
        }

        // Output data as JSON for jQuery UI autocomplete
        echo json_encode($data);
    }

    public function btn_enable()
    {

        $where = "country = " . $this->db->escape($this->input->post('country')) . " AND location_ids != 0";

        $exist_record = $this->common_model->get_data('sites', '', '', '*', $where, '', $count = false)[0];

        echo json_encode($exist_record);
    }

    // public function add_outsidecity_transportation_cost()
    // {
    //     $this->form_validation->set_rules('location', 'Location', 'trim|required');
    //     $this->form_validation->set_rules('price', 'Supplement Charges', 'trim|required');
    //     $id = $this->input->post('edit_id');

    //     if ($this->form_validation->run() == FALSE) {
    //         echo json_encode(['response' => 'danger', 'msg' => 'Fill form correctly']);
    //         exit;
    //     } else {
    //         $insert_arr = [
    //             'transport_id' => $this->input->post('transport_id'),
    //             'sites_id' => $this->input->post('sites_id'),
    //             'location_ids' => $this->input->post('location_id'),
    //             'price' => $this->input->post('price'),
    //             'toll_price' => $this->input->post('toll_price'),
				// 'toll_prices_per_person' => $this->input->post('toll_prices_per_person'),
    //             'parking_price' => $this->input->post('parking_price'),
				// 'add_on_prices' => $this->input->post('add_on_prices'),
				// 'est_hour' => $this->input->post('est_hour'),
				// 'est_minutes' => $this->input->post('est_minutes'),
				// 'est_km' => $this->input->post('est_km'),
    //             'status' => $this->input->post('status'),
    //             'created_by' => $this->session->userdata('id'),
    //             'created_at' => date('Y-m-d H:i:s'),
				// 'valid_from' => $this->input->post('outside_city_valid_from'),
				// 'valid_to' => $this->input->post('outside_city_valid_to')
    //         ];

    //         $where = 'transport_id = ' . $this->input->post('transport_id') .
    //             ' AND sites_id = ' . $this->input->post('sites_id');

    //         $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', '*', $where, '', $count = false);

    //         if (!empty($id)) {

    //             $where='id='.$id;
    //             $existing = $this->common_model->get_single(['table_name' => 'outsidecity_transportation_costs', 'condition'  => $where ]);

    //         if (!empty($existing)) {
    //             $previous_data = [
    //                 'transport_id' => $existing['transport_id'],
    //                 'sites_id'         => $existing['sites_id'],
    //                 'location_ids'         => $existing['location_ids'],
    //                 'price'         => $existing['price'],
    //                 'toll_price'         => $existing['toll_price'],
    //                 'toll_prices_per_person'      => $existing['toll_prices_per_person'],
    //                 'parking_price'         => $existing['parking_price'],
    //                 'add_on_prices'         => $existing['add_on_prices'],
    //                 'est_hour'         => $existing['est_hour'],
    //                 'est_minutes'         => $existing['est_minutes'],
    //                 'est_km'         => $existing['est_km'],
    //                 'status'         => $existing['status'],
    //                 'valid_from'         => $existing['valid_from'],
    //                 'valid_to'         => $existing['valid_to'],
    //                 'created_by'         => $existing['created_by'],
    //                 'created_at'         => $existing['created_at'],
    //             ];
    //         } else {
    //             $previous_data = []; 
    //         }
    //             $this->common_model->update_data_limit(['table_name' => 'outsidecity_transportation_costs', 'update_data' => $insert_arr, 'condition' => ['id' => $id]]);
    //             log_user_activity('Transport: Outside City Charges Update ',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
    //             echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Outside City Charges Updated Successfully!</div>']);
    //         } else if (empty($id)) {
    //             if ($exist_record) {
    //                 echo json_encode(['response' => 'danger', 'msg' => '<div class="alert alert-danger">Record already exists! Please edit.</div>']);
    //             } else {
    //                 $id = $this->common_model->insert_data(['table_name' => 'outsidecity_transportation_costs', 'insert_data' => $insert_arr]);
    //                 log_user_activity('Transport: Outdide City Charges Add ',$this->session->userdata('id'), 'Add New: '. json_encode($insert_arr));
    //                 echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Outside City Charges added successfully!</div>']);
    //             }
    //         } else {
    //             echo json_encode(['response' => 'danger', 'msg' => '<div class="alert alert-danger">Error in form!</div>']);
    //         }
    //     }
    // }
    
    
     public function add_outsidecity_transportation_cost()
    {
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('price', 'Supplement Charges', 'trim|required');
        $id = $this->input->post('edit_id');
        $transport_id = (int) $this->input->post('transport_id');
        $sites_id = trim($this->input->post('sites_id')) !== '' ? $this->input->post('sites_id') : NULL;

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'danger', 'msg' => 'Fill form correctly']);
            exit;
        } else {
            $hotel_status = ($this->input->post('hotel_outside_source') == 'hotel') ? 1 : 0;

            $insert_arr = [
                'transport_id' => $this->input->post('transport_id'),
                'sites_id'     => $sites_id,
                'location_ids' => $this->input->post('location_id'),
                'price' => $this->input->post('price'),
                'toll_price' => $this->input->post('toll_price'),
				'toll_prices_per_person' => $this->input->post('toll_prices_per_person'),
                'parking_price' => $this->input->post('parking_price'),
				'add_on_prices' => $this->input->post('add_on_prices'),
				'est_hour' => $this->input->post('est_hour'),
				'est_minutes' => $this->input->post('est_minutes'),
				'est_km' => $this->input->post('est_km'),
                'status' => $this->input->post('status'),
                'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s'),
				'valid_from' => $this->input->post('outside_city_valid_from'),
				'valid_to' => $this->input->post('outside_city_valid_to'),
                'hotel_outside_status'    => $hotel_status,
            ];

            // $where = 'transport_id = ' . $this->input->post('transport_id') .
            //     ' AND sites_id = ' . $this->input->post('sites_id');

            // $where = 'transport_id = ' . $transport_id;
            // if (!empty($sites_id)) {
            //     $where .= ' AND sites_id = ' . (int) $sites_id;
            // }

            // $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', '*', $where, '', $count = false);

            $exist_record = [];
            if (!empty($sites_id)) {
                $where = 'transport_id = ' . $transport_id . ' AND sites_id = ' . $sites_id;
                $exist_record = $this->common_model->get_data(
                    'outsidecity_transportation_costs',
                    '', '', '*',
                    $where,
                    '', 
                    $count = false
                );
            }

            if (!empty($id)) {

                $where='id='.$id;
                $existing = $this->common_model->get_single(['table_name' => 'outsidecity_transportation_costs', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'transport_id' => $existing['transport_id'],
                    'sites_id'         => $existing['sites_id'],
                    'location_ids'         => $existing['location_ids'],
                    'price'         => $existing['price'],
                    'toll_price'         => $existing['toll_price'],
                    'toll_prices_per_person'      => $existing['toll_prices_per_person'],
                    'parking_price'         => $existing['parking_price'],
                    'add_on_prices'         => $existing['add_on_prices'],
                    'est_hour'         => $existing['est_hour'],
                    'est_minutes'         => $existing['est_minutes'],
                    'est_km'         => $existing['est_km'],
                    'status'         => $existing['status'],
                    'hotel_outside_status'   => $existing['hotel_outside_status'],
                    'valid_from'         => $existing['valid_from'],
                    'valid_to'         => $existing['valid_to'],
                    'created_by'         => $existing['created_by'],
                    'created_at'         => $existing['created_at'],
                ];
            } else {
                $previous_data = []; 
            }
                $this->common_model->update_data_limit(['table_name' => 'outsidecity_transportation_costs', 'update_data' => $insert_arr, 'condition' => ['id' => $id]]);
                log_user_activity('Transport: Outside City Charges Update ',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
                echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Outside City Charges Updated Successfully!</div>']);
            } else if (empty($id)) {
                if ($exist_record) {
                    echo json_encode(['response' => 'danger', 'msg' => '<div class="alert alert-danger">Record already exists! Please edit.</div>']);
                } else {
                    $id = $this->common_model->insert_data(['table_name' => 'outsidecity_transportation_costs', 'insert_data' => $insert_arr]);
                    log_user_activity('Transport: Outdide City Charges Add ',$this->session->userdata('id'), 'Add New: '. json_encode($insert_arr));
                    echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Outside City Charges added successfully!</div>']);
                }
            } else {
                echo json_encode(['response' => 'danger', 'msg' => '<div class="alert alert-danger">Error in form!</div>']);
            }
        }
    }

    public function edit_outsidecity_tranport_price()
    {
        $id = $this->input->post('id');

        $where = 'outsidecity_transportation_costs.id = ' . $id;
        $select = 'outsidecity_transportation_costs.*,sites.location_name as loc';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'sites', 'condition' => 'sites.id = outsidecity_transportation_costs.sites_id'],
        ];
        $data = $this->common_model->get_data('outsidecity_transportation_costs', '', '', $select, $where, '', $count = false, $join)[0];
        echo json_encode(['response' => 'success', 'details' => $data]);
    }

    public function outside_locations_excel()
    {
        log_user_activity('Transport: Excel Download',$this->session->userdata('id'), 'Transport: Excel Downloaded');

        $country = $this->input->get('country');
        $transport_id = base64_decode($this->input->get('transport_id'));
        $currency = $this->input->get('currency');

        // Query for results with sites and transportation join
        // $where = "sites.location_ids != 0 AND sites.country = " . $this->db->escape($country);
        $where = "sites.location_ids != 0 
          AND sites.country = " . $this->db->escape($country) . "
          AND outsidecity_transportation_costs.id IS NOT NULL";

        $select = 'outsidecity_transportation_costs.id,outsidecity_transportation_costs.price,outsidecity_transportation_costs.toll_price,outsidecity_transportation_costs.parking_price,outsidecity_transportation_costs.created_at,outsidecity_transportation_costs.created_by,';
        $select .= 'sites.location_ids as loc_id,sites.id as sites_id,sites.country as countries, sites.location_name as loc,';
        $select .= 'transportation.id as transportation_id, transportation.vehicle_name, transportation.vehicle_type';

        $join = [
            ['type' => 'LEFT', 'join_table' => 'outsidecity_transportation_costs', 'condition' => 'outsidecity_transportation_costs.sites_id = sites.id AND outsidecity_transportation_costs.transport_id = ' . $transport_id,],
            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id'],
        ];

        $results = $this->common_model->get_data('sites', '', '', $select, $where, '', $count = false, $join);

        // Query for specific transportation data without joins
        $where_transport = "transportation.id = " . $transport_id;
        $results_transport = $this->common_model->get_data('transportation', '', '', 'transportation.id as transportation_id, transportation.vehicle_name, transportation.vehicle_type', $where_transport, '', $count = false);

        // Handle missing transportation data
        $transport_data = null;
        if (!empty($results_transport)) {
            $transport_data = [
                'transportation_id' => $results_transport[0]->transportation_id,
                'vehicle_name' => $results_transport[0]->vehicle_name,
                'vehicle_type' => $results_transport[0]->vehicle_type,
            ];
        }

        // Loop through results and handle missing transportation data
        if (!empty($results)) {
            $lastTransportation = null; // Initialize outside the loop
            foreach ($results as &$result) {
                if (!empty($result->transportation_id)) {
                    $lastTransportation = [
                        'transportation_id' => $result->transportation_id,
                        'vehicle_name' => $result->vehicle_name,
                        'vehicle_type' => $result->vehicle_type,
                    ];
                } else {
                    if ($lastTransportation) {
                        $result->transportation_id = $lastTransportation['transportation_id'];
                        $result->vehicle_name = $lastTransportation['vehicle_name'];
                        $result->vehicle_type = $lastTransportation['vehicle_type'];
                    } elseif ($transport_data) {
                        $result->transportation_id = $transport_data['transportation_id'];
                        $result->vehicle_name = $transport_data['vehicle_name'];
                        $result->vehicle_type = $transport_data['vehicle_type'];
                    }
                }
            }
            unset($result); // Break reference
        }

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);

        // Set headers for the Excel sheet
        $headers = [
            'S. No.',
            'Id',
            'Vehicle Name',
            'Vehicle Type',
            'Transport Id',
            'Sites Id',
            'Location Id',
            'Location',
            'Country',
            'Supplement Charges',
            'Toll Charges',
            'Parking Charges',
            'Currency'
        ];

        // Populate the header row
        $column = 'A'; // Start from column A
        foreach ($headers as $header) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . '1', $header);
            $column++;
        }

        $row = 2;
        $sr = 1;

        foreach ($results as $result) {
            // Add data to the Excel sheet
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $result->id);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $result->vehicle_name);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $result->vehicle_type);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $result->transportation_id);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $result->sites_id);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, '"' . $result->loc_id . '"');
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $result->loc);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $result->countries);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $result->price);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $result->toll_price);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $result->parking_price);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $currency);

            $row++;
            $sr++;
        }

        $name = !empty($results[0]->countries) ? $results[0]->countries : '';

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $name . '_Outside_city_charges_' . date('d-M-Y') . '.csv"');
        header('Cache-Control: max-age=0');

        // Create CSV writer object and output the file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    public function import_outside_locations()
    {
        $allowed_csv_files = ['text/csv'];
        $upload_csv = 'documents/csv_files/';

        if (empty($_FILES['csv_file']['name'])) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">No file uploaded.</div>']);
            return;
        }

        $fileType = $_FILES['csv_file']['type'];

        if (!in_array($fileType, $allowed_csv_files)) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">Invalid file type. Please upload a valid CSV file.</div>']);
            return;
        }

        $random_alphanumeric = substr(bin2hex(random_bytes(4)), 0, 8);
        $csv_file_name = $random_alphanumeric . '_' . date('d-m-Y') . '.csv';
        $csv_file_path = $upload_csv . $csv_file_name;

        if (!move_uploaded_file($_FILES["csv_file"]["tmp_name"], $csv_file_path)) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">Failed to upload CSV file. Please try again.</div>']);
            return;
        }

        if (($file = fopen($csv_file_path, "r")) === false) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">Failed to open CSV file. Please try again.</div>']);
            return;
        }

        fgetcsv($file);

        $insertData = [];

        while (($rowData = fgetcsv($file, 1000, ",")) !== false) {

            if (!empty($rowData[1]) && !empty($rowData[9])) {
                $this->db->where('id', $rowData[1]);
                $this->db->update('outsidecity_transportation_costs', [
                    'price' => $rowData[9],
                    'toll_price' => $rowData[10],
                    'parking_price' => $rowData[11],
                ]);
            } else {
                if (!empty($rowData[9])) {
                    $insertData[] = [
                        'transport_id' => $rowData[4],
                        'sites_id' => $rowData[5],
                        'location_ids' => $rowData[6],
                        'price' => $rowData[9],
                        'toll_price' => $rowData[10],
                        'parking_price' => $rowData[11],
                        'currency' => $rowData[12],
                        'status' => 'active',
                        'created_by' => $this->session->userdata('id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
            }
        }

        fclose($file);

        if (!empty($insertData)) {
            $this->db->insert_batch('outsidecity_transportation_costs', $insertData);
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Data processed and inserted successfully!</div>']);
            // log_user_activity('Transport: CSV Uploaded',$this->session->userdata('id'), 'CSV Uploaded:'. json_encode($insertData[]));

        } else {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-warning">No new data to insert. Updated existing records!</div>']);
        }
    }
    
    
    // 25 feb old code
    // public function transportation_cost_add()
    // {
    //     $id = $this->input->post('id');
    //     $transport_ids = $this->input->post('transport_id');
    //     $currency_type = $this->input->post('currency');
    //     $types = $this->input->post('type');
    //     $prices = $this->input->post('price');
    //     $start_times = $this->input->post('start_time');
    //     $end_times = $this->input->post('end_time');
    //     $hours = $this->input->post('hours');
    //     $data = [];

    //     $transfer_cost_option = $this->input->post('transfer_cost_option');
    //     $transfer_cost_fixed = $this->input->post('transfer_cost_fixed');
    //     $transfer_cost_id = $this->input->post('transfer_cost_id');

    //     if ($transfer_cost_option === 'yes' && $transfer_cost_fixed) {
    //         $transfer_data = [
    //             'transport_id' => $transport_ids,
    //             'type' => 'transfer-cost',
    //             'price' => $transfer_cost_fixed,
    //             'currency' => $currency_type,
    //             'valid_from' => $this->input->post('valid_from'),
    //             'valid_to' => $this->input->post('valid_to'),
    //             'start_time' => '00:00:00',
    //             'end_time' => '00:00:00',
    //             'hours' => '0',
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'created_by' => $this->session->userdata('id')
    //         ];
            
    //         if ($transfer_cost_id) {
    //             // Update existing transfer cost
    //             $this->common_model->update_data([
    //                 'table_name' => 'transportation_costs',
    //                 'update_data' => $transfer_data,
    //                 'condition' => ['id' => $transfer_cost_id]
    //             ]);
    //         } else {
    //             // Insert new transfer cost
    //             $this->common_model->insert_data([
    //                 'table_name' => 'transportation_costs',
    //                 'insert_data' => $transfer_data
    //             ]);
    //         }
    //     }

    //     // Handle TRAIN transfer cost
    //     $train_transfer_cost_option = $this->input->post('train_transfer_cost_option');
    //     $train_transfer_cost_fixed = $this->input->post('train_transfer_cost_fixed');
    //     $train_transfer_cost_id = $this->input->post('train_transfer_cost_id');

    //     if ($train_transfer_cost_option === 'yes' && $train_transfer_cost_fixed) {
    //         $train_transfer_data = [
    //             'transport_id' => $transport_ids,
    //             'type' => 'train-transfer-cost',
    //             'price' => $train_transfer_cost_fixed,
    //             'currency' => $currency_type,
    //             'valid_from' => $this->input->post('valid_from'),
    //             'valid_to' => $this->input->post('valid_to'),
    //             'start_time' => '00:00:00',
    //             'end_time' => '00:00:00',
    //             'hours' => '0',
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'created_by' => $this->session->userdata('id')
    //         ];
            
    //         if ($train_transfer_cost_id) {
    //             // Update existing train transfer cost
    //             $this->common_model->update_data([
    //                 'table_name' => 'transportation_costs',
    //                 'update_data' => $train_transfer_data,
    //                 'condition' => ['id' => $train_transfer_cost_id]
    //             ]);
    //         } else {
    //             // Insert new train transfer cost
    //             $this->common_model->insert_data([
    //                 'table_name' => 'transportation_costs',
    //                 'insert_data' => $train_transfer_data
    //             ]);
    //         }
    //     }

    //     if (empty(array_filter($id))) {
    //         // Insert new records
    //         foreach ($start_times as $index => $start_time) {
    //             $data[] = [
				// 'transport_id' => $transport_ids,
				// 'currency' => $currency_type,
				// 'type' => $types[$index],
				// 'price' => $prices[$index],
				// 'start_time' => $start_time,
				// 'end_time' => $end_times[$index],
				// 'hours' => $hours[$index],
				// 'created_at' => date('Y-m-d H:i:s'),
				// 'created_by' => $this->session->userdata('id'),
				// 'valid_from'=> $this->input->post('valid_from'),
				// 'valid_to'=>$this->input->post('valid_to')
    //             ];
    //         }

    //         if (!empty($transport_ids)) {
    //             foreach ($data as $record) {
    //                 $this->common_model->insert_data([
    //                     'table_name' => 'transportation_costs',
    //                     'insert_data' => $record
    //                 ]);
    //             }
    //         }

    //         $this->session->set_flashdata('message', '<div class="alert alert-success">Prices added successfully!</div>');
    //         log_user_activity('Transport: Transportation Cost Add',$this->session->userdata('id'), 'Transportation Cost: '. json_encode($data));
    //         redirect('all-transport');
    //     } else {

    //         $update_data = [];

    //         foreach ($start_times as $index => $start_time) {
                
    //                 // Fetch previous data for each specific id before updating
    //                 $current_id = $id[$index];
    //                 $where = 'id = ' . $current_id;
    //                 $existing = $this->common_model->get_single([
    //                     'table_name' => 'transportation_costs',
    //                     'condition'  => $where
    //                 ]);
                
    //                 if (!empty($existing)) {
    //                     $previous_data[] = [
    //                         'id' => $existing['id'],
    //                         'type' => $existing['type'],
    //                         'start_time' => $existing['start_time'],
    //                         'end_time' => $existing['end_time'],
    //                         'hours' => $existing['hours'],
    //                         'price' => $existing['price'],
    //                         'valid_from' => $existing['valid_from'],
    //                         'valid_to' => $existing['valid_to'],
    //                     ];
    //                 }

    //             $update_data[] = [
    //                 'id' => $id[$index], // Keep id separately
    //                 'data' => [
				// 	'type' => $types[$index],
				// 	'start_time' => $start_time,
				// 	'end_time' => $end_times[$index],
				// 	'hours' => $hours[$index],
				// 	'price' => $prices[$index],
				// 	'created_at' => date('Y-m-d H:i:s'),
				// 	'created_by' => $this->session->userdata('id'),
				// 	'valid_from'=> $this->input->post('valid_from'),
				// 	'valid_to'=>$this->input->post('valid_to')
    //                 ]
    //             ];
    //         }
    //         // Update records without id in the set data
    //         foreach ($update_data as $entry) {
    //             if (!empty($entry['id'])) {
    //                 $this->db->where('id', $entry['id']);
    //                 $this->db->update('transportation_costs', $entry['data']); // Use only data array
    //             }
    //         }
    //         $this->session->set_flashdata('message', '<div class="alert alert-success">Prices updated successfully!</div>');
    //         log_user_activity('Transport: Transportation Cost Update',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
    //         redirect('all-transport');
    //     }
    // }
    
    // 25 feb updated code
    public function transportation_cost_add()
    {
        $id = $this->input->post('id');
        $transport_ids = $this->input->post('transport_id');
        $currency_type = $this->input->post('currency');
        $types = $this->input->post('type');
        $prices = $this->input->post('price');
        $start_times = $this->input->post('start_time');
        $end_times = $this->input->post('end_time');
        $hours = $this->input->post('hours');
        $data = [];

        $transfer_cost_option = $this->input->post('transfer_cost_option');
        $transfer_cost_fixed = $this->input->post('transfer_cost_fixed');
        $transfer_cost_fixed_toll = $this->input->post('transfer_cost_fixed_toll');
        $transfer_cost_fixed_parking = $this->input->post('transfer_cost_fixed_parking');
        $transfer_cost_fixed_addon = $this->input->post('transfer_cost_fixed_addon');

        $transfer_cost_id = $this->input->post('transfer_cost_id');
        $transfer_cost_toll_id = $this->input->post('transfer_cost_toll_id');   // new hidden field for toll
        $transfer_cost_parking_id = $this->input->post('transfer_cost_parking_id'); // new hidden field for parking
        $transfer_cost_addon_id = $this->input->post('transfer_cost_addon_id');     // new hidden field for addon

        if ($transfer_cost_option === 'yes') {
            // FIXED PRICE (transfer-cost)
            if (isset($transfer_cost_fixed) && $transfer_cost_fixed !== '') {
                $transfer_data = [
                    'transport_id' => $transport_ids,
                    'type' => 'transfer-cost',
                    'price' => $transfer_cost_fixed,
                    'currency' => $currency_type,
                    'valid_from' => $this->input->post('valid_from'),
                    'valid_to' => $this->input->post('valid_to'),
                    'start_time' => '00:00:00',
                    'end_time' => '00:00:00',
                    'hours' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id')
                ];

                if ($transfer_cost_id) {
                    $this->common_model->update_data([
                        'table_name' => 'transportation_costs',
                        'update_data' => $transfer_data,
                        'condition' => ['id' => $transfer_cost_id]
                    ]);
                } else {
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $transfer_data
                    ]);
                }
            }

            // FIXED TOLL PRICE (transfer-cost-toll)
            if (isset($transfer_cost_fixed_toll) && $transfer_cost_fixed_toll !== '') {
                $toll_data = [
                    'transport_id' => $transport_ids,
                    'type' => 'transfer-cost-toll',
                    'price' => $transfer_cost_fixed_toll,
                    'currency' => $currency_type,
                    'valid_from' => $this->input->post('valid_from'),
                    'valid_to' => $this->input->post('valid_to'),
                    'start_time' => '00:00:00',
                    'end_time' => '00:00:00',
                    'hours' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id')
                ];

                if ($transfer_cost_toll_id) {
                    $this->common_model->update_data([
                        'table_name' => 'transportation_costs',
                        'update_data' => $toll_data,
                        'condition' => ['id' => $transfer_cost_toll_id]
                    ]);
                } else {
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $toll_data
                    ]);
                }
            }

            // FIXED PARKING PRICE (transfer-cost-parking)
            if (isset($transfer_cost_fixed_parking) && $transfer_cost_fixed_parking !== '') {
                $parking_data = [
                    'transport_id' => $transport_ids,
                    'type' => 'transfer-cost-parking',
                    'price' => $transfer_cost_fixed_parking,
                    'currency' => $currency_type,
                    'valid_from' => $this->input->post('valid_from'),
                    'valid_to' => $this->input->post('valid_to'),
                    'start_time' => '00:00:00',
                    'end_time' => '00:00:00',
                    'hours' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id')
                ];

                if ($transfer_cost_parking_id) {
                    $this->common_model->update_data([
                        'table_name' => 'transportation_costs',
                        'update_data' => $parking_data,
                        'condition' => ['id' => $transfer_cost_parking_id]
                    ]);
                } else {
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $parking_data
                    ]);
                }
            }

            // FIXED ADDON PRICE (transfer-cost-addon)
            if (isset($transfer_cost_fixed_addon) && $transfer_cost_fixed_addon !== '') {
                $addon_data = [
                    'transport_id' => $transport_ids,
                    'type' => 'transfer-cost-addon',
                    'price' => $transfer_cost_fixed_addon,
                    'currency' => $currency_type,
                    'valid_from' => $this->input->post('valid_from'),
                    'valid_to' => $this->input->post('valid_to'),
                    'start_time' => '00:00:00',
                    'end_time' => '00:00:00',
                    'hours' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id')
                ];

                if ($transfer_cost_addon_id) {
                    $this->common_model->update_data([
                        'table_name' => 'transportation_costs',
                        'update_data' => $addon_data,
                        'condition' => ['id' => $transfer_cost_addon_id]
                    ]);
                } else {
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $addon_data
                    ]);
                }
            }
        }

        // Handle TRAIN transfer cost (unchanged)
        $train_transfer_cost_option = $this->input->post('train_transfer_cost_option');
        $train_transfer_cost_fixed = $this->input->post('train_transfer_cost_fixed');
        $train_transfer_cost_id = $this->input->post('train_transfer_cost_id');

        if ($train_transfer_cost_option === 'yes' && isset($train_transfer_cost_fixed) && $train_transfer_cost_fixed !== '') {
            $train_transfer_data = [
                'transport_id' => $transport_ids,
                'type' => 'train-transfer-cost',
                'price' => $train_transfer_cost_fixed,
                'currency' => $currency_type,
                'valid_from' => $this->input->post('valid_from'),
                'valid_to' => $this->input->post('valid_to'),
                'start_time' => '00:00:00',
                'end_time' => '00:00:00',
                'hours' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id')
            ];

            if ($train_transfer_cost_id) {
                $this->common_model->update_data([
                    'table_name' => 'transportation_costs',
                    'update_data' => $train_transfer_data,
                    'condition' => ['id' => $train_transfer_cost_id]
                ]);
            } else {
                $this->common_model->insert_data([
                    'table_name' => 'transportation_costs',
                    'insert_data' => $train_transfer_data
                ]);
            }
        }

        // Process dynamic rows (halfday, full-day, etc.) – unchanged
        if (empty(array_filter($id))) {
            // Insert new records
            foreach ($start_times as $index => $start_time) {
                $data[] = [
                    'transport_id' => $transport_ids,
                    'currency' => $currency_type,
                    'type' => $types[$index],
                    'price' => $prices[$index],
                    'start_time' => $start_time,
                    'end_time' => $end_times[$index],
                    'hours' => $hours[$index],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id'),
                    'valid_from' => $this->input->post('valid_from'),
                    'valid_to' => $this->input->post('valid_to')
                ];
            }

            if (!empty($transport_ids)) {
                foreach ($data as $record) {
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $record
                    ]);
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Prices added successfully!</div>');
            log_user_activity('Transport: Transportation Cost Add', $this->session->userdata('id'), 'Transportation Cost: ' . json_encode($data));
            redirect('all-transport');
        } else {
            $update_data = [];
            $previous_data = []; // Initialize to avoid undefined variable warning

            foreach ($start_times as $index => $start_time) {
                $current_id = $id[$index];
                
                if (empty($current_id)) {
                    $record = [
                        'transport_id' => $transport_ids,
                        'currency'     => $currency_type,
                        'type'         => $types[$index],
                        'price'        => $prices[$index],
                        'start_time'   => $start_time,
                        'end_time'     => $end_times[$index],
                        'hours'        => $hours[$index],
                        'created_at'   => date('Y-m-d H:i:s'),
                        'created_by'   => $this->session->userdata('id'),
                        'valid_from'   => $this->input->post('valid_from'),
                        'valid_to'     => $this->input->post('valid_to')
                    ];
                    $this->common_model->insert_data([
                        'table_name' => 'transportation_costs',
                        'insert_data' => $record
                    ]);
                    // Skip update logic for this row
                    continue;
                }
                
                $where = 'id = ' . $current_id;
                $existing = $this->common_model->get_single([
                    'table_name' => 'transportation_costs',
                    'condition'  => $where
                ]);

                if (!empty($existing)) {
                    $previous_data[] = [
                        'id' => $existing['id'],
                        'type' => $existing['type'],
                        'start_time' => $existing['start_time'],
                        'end_time' => $existing['end_time'],
                        'hours' => $existing['hours'],
                        'price' => $existing['price'],
                        'valid_from' => $existing['valid_from'],
                        'valid_to' => $existing['valid_to'],
                    ];
                }

                $update_data[] = [
                    'id' => $id[$index],
                    'data' => [
                        'type' => $types[$index],
                        'start_time' => $start_time,
                        'end_time' => $end_times[$index],
                        'hours' => $hours[$index],
                        'price' => $prices[$index],
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id'),
                        'valid_from' => $this->input->post('valid_from'),
                        'valid_to' => $this->input->post('valid_to')
                    ]
                ];
            }

            foreach ($update_data as $entry) {
                if (!empty($entry['id'])) {
                    $this->db->where('id', $entry['id']);
                    $this->db->update('transportation_costs', $entry['data']);
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Prices updated successfully!</div>');
            log_user_activity('Transport: Transportation Cost Update', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
            redirect('all-transport');
        }
    }

    // get_cities_by_country method
    public function get_cities_by_country()
    {
        $country_id = $this->input->post('country_id');
        $search = $this->input->post('search');
        
        if (!$country_id) {
            echo json_encode(['results' => []]);
            exit;
        }
        
        $this->db->select('cities.id, cities.name as text');
        $this->db->from('cities');
        $this->db->join('states', 'states.id = cities.state_id', 'left');
        $this->db->join('countries', 'countries.id = states.country_id', 'left');
        $this->db->where('countries.id', $country_id);
        $this->db->group_by('cities.name');
        
        if ($search) {
            $this->db->like('cities.name', $search);
        }
        
        $this->db->order_by('cities.name', 'ASC');
        $this->db->limit(10);
        
        $query = $this->db->get();
        $results = $query->result_array();
        
        // Format for Select2
        echo json_encode(['results' => $results]);
        exit;
    }

    // get_country_id method
    public function get_country_id()
    {
        $country_name = $this->input->post('country_name');
        
        if (!$country_name) {
            echo json_encode(['success' => false, 'message' => 'Country name required']);
            exit;
        }
        
        $where = ['name' => $country_name];
        $country = $this->common_model->get_single([
            'table_name' => 'countries',
            'condition' => $where
        ]);
        
        if ($country) {
            echo json_encode([
                'success' => true, 
                'country_id' => $country['id'],
                'country_name' => $country['name']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Country not found']);
        }
        exit;
    }

    // Get city details by ID (for edit)
    public function get_city_by_id()
    {
        $city_id = $this->input->post('city_id');
        
        if (!$city_id) {
            echo json_encode(['success' => false]);
            exit;
        }
        
        $this->db->select('cities.id, cities.name, states.name as state_name, countries.name as country_name');
        $this->db->from('cities');
        $this->db->join('states', 'states.id = cities.state_id', 'left');
        $this->db->join('countries', 'countries.id = states.country_id', 'left');
        $this->db->where('cities.id', $city_id);
        
        $query = $this->db->get();
        $city = $query->row_array();
        
        if ($city) {
            echo json_encode(['success' => true, 'city' => $city]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }

    // Get city details for edit mode
    public function get_city_details()
    {
        $country_id = $this->input->post('country_id');
        $from_city_id = $this->input->post('from_city_id');
        $to_city_id = $this->input->post('to_city_id');
        
        $response = [
            'success' => true,
            'from_city' => null,
            'to_city' => null
        ];
        
        // Get from city details
        if ($from_city_id) {
            $this->db->select('cities.id as fromCityId, cities.name as fromCityName');
            $this->db->from('cities');
            $this->db->join('states', 'states.id = cities.state_id', 'left');
            $this->db->join('countries', 'countries.id = states.country_id', 'left');
            $this->db->where('cities.id', $from_city_id);
            $this->db->where('countries.id', $country_id);
            
            $query = $this->db->get();
            $from_city = $query->row_array();
            
            if ($from_city) {
                $response['from_city'] = [
                    'fromCityId' => $from_city['fromCityId'],
                    'fromCityName' => $from_city['fromCityName']
                ];
            }
        }
        
        // Get to city details
        if ($to_city_id) {
            $this->db->select('cities.id as toCityId, cities.name as toCityName');
            $this->db->from('cities');
            $this->db->join('states', 'states.id = cities.state_id', 'left');
            $this->db->join('countries', 'countries.id = states.country_id', 'left');
            $this->db->where('cities.id', $to_city_id);
            $this->db->where('countries.id', $country_id);
            
            $query = $this->db->get();
            $to_city = $query->row_array();
            
            if ($to_city) {
                $response['to_city'] = [
                    'toCityId' => $to_city['toCityId'],
                    'toCityName' => $to_city['toCityName']
                ];
            }
        }
        
        echo json_encode($response);
        exit;
    }

    // Add these methods to your controller
    // Add these methods to your controller
    public function get_transfer_routes()
    {
        $transport_id = $this->input->post('transport_id');
        
        if (!$transport_id) {
            echo json_encode(['success' => false, 'message' => 'Transport ID required']);
            exit;
        }
        
        $this->db->select('tr.*, 
            from_city.id as from_city_id,
            from_city.name as from_city_name, 
            to_city.id as to_city_id,
            to_city.name as to_city_name');
        $this->db->from('transfer_routes tr');
        $this->db->join('cities from_city', 'from_city.id = tr.from_city_id', 'left');
        $this->db->join('cities to_city', 'to_city.id = tr.to_city_id', 'left');
        $this->db->where('tr.transport_id', $transport_id);
        $this->db->where('tr.status', 'active');
        $this->db->order_by('tr.created_at', 'DESC');
        
        $query = $this->db->get();
        $transfer_routes = $query->result_array();
        
        echo json_encode(['success' => true, 'routes' => $transfer_routes]);
        exit;
    }

    public function save_transfer_route()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('from_city', 'From City', 'required');
        $this->form_validation->set_rules('to_city', 'To City', 'required');
        $this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
        $this->form_validation->set_rules('route_valid_from', 'Valid From', 'required');
        $this->form_validation->set_rules('route_valid_to', 'Valid To', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            exit;
        }
        
        $data = [
            'transport_id' => $this->input->post('transport_id'),
            'from_city_id' => $this->input->post('from_city_id'),
            'from_city' => $this->input->post('from_city'),
            'to_city_id' => $this->input->post('to_city_id'),
            'to_city' => $this->input->post('to_city'),
            'cost' => $this->input->post('cost'),
            'toll' => $this->input->post('toll'),
            'parking' => $this->input->post('parking'),
            'addon' => $this->input->post('addon'),
            'valid_from' => $this->input->post('route_valid_from'),
            'valid_to' => $this->input->post('route_valid_to'),
            'status' => $this->input->post('status') ?: 'active',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        
        $transfer_route_id = $this->input->post('transfer_route_id');
        
        if ($transfer_route_id) {
            // Update existing route
            $this->common_model->update_data([
                'table_name' => 'transfer_routes',
                'update_data' => $data,
                'condition' => ['id' => $transfer_route_id]
            ]);
            $message = 'Transfer route updated successfully';
        } else {
            // Insert new route
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('id');
            $this->common_model->insert_data([
                'table_name' => 'transfer_routes',
                'insert_data' => $data
            ]);
            $message = 'Transfer route added successfully';
        }
        
        echo json_encode(['success' => true, 'message' => $message]);
        exit;
    }

    public function delete_transfer_route()
    {
        $id = $this->input->post('id');
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Route ID required']);
            exit;
        }
        
        // Instead of deleting, update status to 'inactive'
        $this->common_model->update_data([
            'table_name' => 'transfer_routes',
            'update_data' => [
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s')
            ],
            'condition' => ['id' => $id]
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Transfer route deleted successfully']);
        exit;
    }

    // Save train transfer route (using city selection)
    public function save_train_transfer_route()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('from_city_id', 'From City', 'required');
        $this->form_validation->set_rules('to_city_id', 'To City', 'required');
        $this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
        $this->form_validation->set_rules('route_valid_from', 'Valid From', 'required');
        $this->form_validation->set_rules('route_valid_to', 'Valid To', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            exit;
        }
        
        $data = [
            'transport_id' => $this->input->post('transport_id'),
            'from_city_id' => $this->input->post('from_city_id'),
            'from_city' => $this->input->post('from_city'),
            'to_city_id' => $this->input->post('to_city_id'),
            'to_city' => $this->input->post('to_city'),
            'cost' => $this->input->post('cost'),
            'valid_from' => $this->input->post('route_valid_from'),
            'valid_to' => $this->input->post('route_valid_to'),
            'status' => $this->input->post('status') ?: 'active',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $train_transfer_route_id = $this->input->post('train_transfer_route_id');
        
        if ($train_transfer_route_id) {
            // Update existing route
            $this->common_model->update_data([
                'table_name' => 'train_transfer_routes',
                'update_data' => $data,
                'condition' => ['id' => $train_transfer_route_id]
            ]);
            $message = 'Train transfer route updated successfully';
        } else {
            // Insert new route
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('id');
            $this->common_model->insert_data([
                'table_name' => 'train_transfer_routes',
                'insert_data' => $data
            ]);
            $message = 'Train transfer route added successfully';
        }
        
        echo json_encode(['success' => true, 'message' => $message]);
        exit;
    }

    // Get train transfer routes with city details
    public function get_train_transfer_routes()
    {
        $transport_id = $this->input->post('transport_id');
        
        if (!$transport_id) {
            echo json_encode(['success' => false, 'message' => 'Transport ID required']);
            exit;
        }
        
        $this->db->select('tr.*, 
            from_city.name as from_city_name, 
            to_city.name as to_city_name');
        $this->db->from('train_transfer_routes tr');
        $this->db->join('cities from_city', 'from_city.id = tr.from_city_id', 'left');
        $this->db->join('cities to_city', 'to_city.id = tr.to_city_id', 'left');
        $this->db->where('tr.transport_id', $transport_id);
        $this->db->where('tr.status', 'active');
        $this->db->order_by('tr.created_at', 'DESC');
        
        $query = $this->db->get();
        $transfer_routes = $query->result_array();
        
        echo json_encode(['success' => true, 'routes' => $transfer_routes]);
        exit;
    }

    // Delete train transfer route
    public function delete_train_transfer_route()
    {
        $id = $this->input->post('id');
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Route ID required']);
            exit;
        }
        
        $this->common_model->update_data([
            'table_name' => 'train_transfer_routes',
            'update_data' => [
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s')
            ],
            'condition' => ['id' => $id]
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Train transfer route deleted successfully']);
        exit;
    }
    
    public function delete_transport_image()
    {
        // Decode parameters
        $transport_id = base64_decode($this->input->get('transport_id'));
        $image_name   = base64_decode($this->input->get('image'));

        if (!$transport_id || !$image_name) {
            show_404();
        }

        // Verify that the image exists for this transport
        $this->db->select('id');
        $this->db->from('transportation_images');
        $this->db->where('transportation_id', $transport_id);
        $this->db->where('image', $image_name);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->session->set_flashdata('error', 'Image not found.');
            redirect('all-transport');
        }

        // Delete physical file
        $file_path = FCPATH . 'uploads/transportation/' . $image_name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete database record
        $this->db->where('transportation_id', $transport_id);
        $this->db->where('image', $image_name);
        $this->db->delete('transportation_images');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Image Deleted Successfully!</div>');
        log_user_activity('Transport Image Delete', $this->session->userdata('id'), 'Deleted image: ' . $image_name . ' for transport ID: ' . $transport_id);

        redirect('all-transport');
    }
    
}
