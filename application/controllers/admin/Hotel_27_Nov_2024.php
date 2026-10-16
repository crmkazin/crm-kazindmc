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

    // public function room_category()
    // {
    //     $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
    //     $where = 'hotel_id = ' . $hotel_id;
    //     $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false);

    //     $category_id = '';
    //     if ($this->input->get('category_id') <> '') {
    //         $category_id = base64_decode($this->input->get('category_id'));
    //         ($category_id == '') ? redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id)) : '';
    //         $where = 'hotel_id = ' . $hotel_id . ' AND id = ' . $category_id;
    //         $data['category'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false)[0];
    //         if (empty($data['category'])) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
    //             redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //         }
    //     }

    //     $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
    //     $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
    //     $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
    //     $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');
    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('admin/hotel_room_category', $data);
    //     } else {
    //         $arr = array(
    //             'category_name' => $this->input->post('category_name'),
    //             'max_accomodation' => $this->input->post('max_accomodation'),
    //             'number_adults' => $this->input->post('adult_number'),
    //             'number_childs' => $this->input->post('child_number'),
    //             'child_bed' => $this->input->post('child_bed'),
    //             'added_by' => $this->session->userdata('id'),
    //         );
    //         if ($category_id <> '') {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //             $id = $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
    //             $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
    //             $id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);
    //         }
    //         redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //     }
    // }

    public function room_category()
    {
        $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
        $where = 'hotels.id = ' . $hotel_id . ' GROUP BY hotel_room_categories.id';
        $select = 'hotel_room_categories.*,hotels.name,hotels.country,room_category_costing.price_with_breakfast';
        $join = [
            ['type' => 'right', 'join_table' => 'hotels', 'condition' => 'hotel_room_categories.hotel_id = hotels.id'],
            ['type' => 'left', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id']
        ];
        $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', $count = false, $join);
        //echo $this->db->last_query();exit;

        $where = 'LOWER(currency_value.country) = "' . strtolower($data['categories'][0]->country) . '"';
        $data['currency'] = $this->common_model->get_data('currency_value', '', '', '*', $where, '', $count = false);


        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
        $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
        $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/hotel_room_category', $data);
        } else {
            $category_id = base64_decode($this->input->post('category_id'));

            $arr = array(
                'category_name' => $this->input->post('category_name'),
                'room_size' => $this->input->post('room_size'),
                'max_accomodation' => $this->input->post('max_accomodation'),
                'number_adults' => $this->input->post('adult_number'),
                'number_childs' => $this->input->post('child_number'),
                'child_bed' => $this->input->post('child_bed'),
                'status' => 'active',
                'added_by' => $this->session->userdata('id'),
            );

            if (!empty($category_id)) {
                $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);

                // Retrieve posted data for adults and children
                $from_date =  $this->input->post('from_date');
                $to_date =  $this->input->post('to_date');
                $adult_prices = $this->input->post('adultprice_with_breakfast');
                $child_prices = $this->input->post('childprice_with_breakfast');
                $child_bed = $this->input->post('child_bed') === 'CWB' ? 'CWB' : 'CNB';

                // Initialize an array to hold the structured data
                $person_array = [];

                // Loop through adult prices to structure each entry
                foreach ($adult_prices as $index => $price) {
                    $person_array[] = [
                        'person_count' => $index + 1, // Setting person count starting from 1
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'price_with_breakfast' => $price,
                        'type' => 'adult',
                        'child_bed' => $child_bed,
                        'hotel_id' => $hotel_id,
                        'category_id' => $category_id,
                        'status' => 'active',
                        'admin_id' => $this->session->userdata('id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }

                // Loop through child prices similarly, but with type 'child'
                foreach ($child_prices as $index => $price) {
                    $person_array[] = [
                        'person_count' => $index + 1,
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'price_with_breakfast' => $price,
                        'type' => 'child',
                        'child_bed' => $child_bed,
                        'hotel_id' => $hotel_id,
                        'category_id' => $category_id,
                        'status' => 'active',
                        'admin_id' => $this->session->userdata('id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }


                // Loop through each person entry to update the database
                foreach ($person_array as $entry) {

                    $conflict_check = $this->db->get_where('room_category_costing', [
                        'from_date' => $entry['from_date'],
                        'to_date' => $entry['to_date'],
                        'hotel_id' => $entry['hotel_id'],
                        'category_id' => $entry['category_id'],
                    ])->row();

                    if ($conflict_check) {
                        // If a conflict is detected and the person_count is not part of the condition
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Record for Hotel ID: ' . $entry['hotel_id'] . ', 
                            Category ID: ' . $entry['category_id'] . ' with the same dates already exists. Please update the record instead.</div>');
                        redirect('room-category-hotel?hotel_id=' . base64_encode($entry['hotel_id'])); // Redirect with error message
                        return; // Stop further processing
                    }


                    // Check if a record exists with the same hotel_id, category_id, type, and person_count
                    $existing_record = $this->db->get_where('room_category_costing', [
                        'from_date' => $entry['from_date'],
                        'to_date' => $entry['to_date'],
                        'hotel_id' => $entry['hotel_id'],
                        'type' => $entry['type'],
                        'person_count' => $entry['person_count'],
                        'category_id' => $entry['category_id'],
                    ])->row();

                    if ($existing_record) {
                        // Update the existing record
                        $this->db->where('id', $existing_record->id);
                        $this->db->update('room_category_costing', $entry);
                    } else {
                        // Insert a new record
                        $this->db->insert('room_category_costing', $entry);
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            } else {
                $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
                $category_id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);

                // Retrieve posted data for adults and children
                $adult_prices = $this->input->post('adultprice_with_breakfast');
                $child_prices = $this->input->post('childprice_with_breakfast');
                $child_bed = $this->input->post('child_bed') === 'CWB' ? 'CWB' : 'CNB';

                // Initialize an array to hold the structured data
                $person_array = [];

                // Loop through adult prices to structure each entry
                foreach ($adult_prices as $index => $price) {
                    $person_array[] = [
                        'person_count' => $index + 1, // Setting person count starting from 1
                        'price_with_breakfast' => $price,
                        'type' => 'adult',
                        'child_bed' => $child_bed,
                        'hotel_id' => $hotel_id,
                        'category_id' => $category_id,
                        'status' => 'active',
                        'admin_id' => $this->session->userdata('id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }

                // Loop through child prices similarly, but with type 'child'
                foreach ($child_prices as $index => $price) {
                    $person_array[] = [
                        'person_count' => $index + 1,
                        'price_with_breakfast' => $price,
                        'type' => 'child',
                        'child_bed' => $child_bed,
                        'hotel_id' => $hotel_id,
                        'category_id' => $category_id,
                        'status' => 'active',
                        'admin_id' => $this->session->userdata('id'),
                        'created_at	' => date('Y-m-d H:i:s')
                    ];
                }

                // Insert data into the database
                if ($category_id > 1) {
                    foreach ($person_array as $record) {
                        $this->common_model->insert_data([
                            'table_name' => 'room_category_costing',
                            'insert_data' => $record
                        ]);
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
            }
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }
    }

    public function room_category_prices()
    {
        $hotel_id = base64_decode($this->input->post('hotel_id'));
        $category_id = base64_decode($this->input->post('category_id'));

        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $select = 'room_category_costing.*, hotel_room_categories.max_accomodation, hotel_room_categories.number_adults, hotel_room_categories.number_childs';

        $join = [['type' => 'left', 'join_table' => 'hotel_room_categories', 'condition' => 'room_category_costing.category_id = hotel_room_categories.id']];
        $price = $this->common_model->get_data('room_category_costing', '', '', $select, $where, ' ORDER BY room_category_costing.id', $count = false, $join);

        $where_data  = 'hotel_room_categories.id = ' . $category_id;
        $categories = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where_data, '', $count = false)[0];

        $transformed_data = [];

        // Group by from_date and to_date
        foreach ($price as $item) {
            $key = $item->from_date . '_' . $item->to_date;

            // Initialize the group if it doesn't exist
            if (!isset($transformed_data[$key])) {
                $transformed_data[$key] = [
                    'category_id' => $item->category_id,
                    'hotel_id' => $item->hotel_id,
                    'admin_id' => $item->admin_id,
                    'from_date' => $item->from_date,
                    'to_date' => $item->to_date,
                    'max_accomodation' => $item->max_accomodation,
                    'number_adults' => $item->number_adults,
                    'number_childs' => $item->number_childs,
                    'child_bed' => $item->child_bed,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                ];
            }

            // Add price fields based on type and person count
            if ($item->type === 'adult') {
                $transformed_data[$key][('price_with_breakfast_adult_person_count_' . $item->person_count)] = $item->price_with_breakfast;
            } elseif ($item->type === 'child') {
                $transformed_data[$key][('price_with_breakfast_child_person_count_' . $item->person_count)] = $item->price_with_breakfast;
            }
        }

        // Re-index to reset numeric keys
        $transformed_data = array_values($transformed_data);

        echo json_encode(['response' => 's', 'details' => $categories, 'price' => $transformed_data]);
        exit;
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
        $where = ' arrival_hotel_details.hotel_id = ' . $id;
        $hotels = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = true);
        if ($hotels) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Arrivals hotel details found. Hotel cannot be deleted.</div>');
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

    public function merge_hotels()
    {
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
            $hotel_merger = implode(',', $hotel_merger_arr);

            $sql_hotel_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = hotel_room_categories.hotel_id, hotel_room_categories.hotel_id="' . $main_hotel_id . '" WHERE hotel_room_categories.hotel_id IN(' . $hotel_merger . ')';
            $this->db->query($sql_hotel_categories);

            $sql_company = 'UPDATE `hotels` SET status="deleted", hotels.main_hotel_id = "' . $main_hotel_id . '", hotels.merge_status="yes", hotels.modified = "' . date('Y-m-d H:i:s') . '" WHERE hotels.id IN(' . $hotel_merger . ')';
            $this->db->query($sql_company);

            foreach ($hotel_merger_arr as $list) {
                $where = ' arrival_hotel_details.hotel_id = ' . $list;
                $arrival_hotel_details = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = false);
                foreach ($arrival_hotel_details as $enq) {
                    $insert_arr = [
                        'arrival_hotel_details_id' => $enq->id,
                        'previous_hotel_id' => $list,
                        'main_hotel_id' => $main_hotel_id,
                        'admin_id' => $this->session->userdata('id'),
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $id = $this->common_model->insert_data(['table_name' => 'arrival_hotel_details_merge_logs', 'insert_data' => $insert_arr]);
                    if ($id) {
                        $update_arr = ['hotel_id' => $main_hotel_id];
                        $update_data = ['table_name' => 'arrival_hotel_details', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success">Hotels Merged Successfully.</div>');
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

    public function hotel_names_merge()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id[] = $this->input->post('main_hotel_id');
        $hotel_ids = array_merge($main_hotel_id, (!empty($this->input->post('hotels_merger'))) ? $this->input->post('hotels_merger') : []);

        $response = array();
        $this->db->select('*');
        if (!empty($this->input->post('search'))) {
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

    public function get_merged_hotels()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id = $this->input->post('revoke_main_hotel_id');
        $where = 'hotels.main_hotel_id = "' . $main_hotel_id . '"';
        $select = 'hotels.*';
        $data['merged_hotels'] = $this->common_model->get_data('hotels', '', '', $select, $where, '', $count = false);
        echo json_encode($data);
    }

    public function revoke_merged_hotel()
    {

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

        $sql_hotel_room_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = 0, hotel_room_categories.hotel_id = ' . $hotel_revoke_id . ' WHERE hotel_room_categories.previous_hotel_id = ' . $hotel_revoke_id;
        $this->db->query($sql_hotel_room_categories);

        $sql_logs = 'UPDATE `arrival_hotel_details_merge_logs` SET arrival_hotel_details_merge_logs.status = "rollback", arrival_hotel_details_merge_logs.modified="' . date('Y-m-d H:i:s') . '", arrival_hotel_details_merge_logs.rollback_admin_id = ' . $this->session->userdata('id') . ' WHERE arrival_hotel_details_merge_logs.main_hotel_id = ' . $revoke_main_hotel_id . ' AND arrival_hotel_details_merge_logs.previous_hotel_id = ' . $hotel_revoke_id . ' AND arrival_hotel_details_merge_logs.status="active"';
        $this->db->query($sql_logs);

        $sql_hotels = 'UPDATE `hotels` SET status = "active", hotels.main_hotel_id = 0, hotels.merge_status="no", hotels.modified = "' . date('Y-m-d H:i:s') . '" WHERE hotels.id = "' . $hotel_revoke_id . '"';
        $this->db->query($sql_hotels);

        if (!empty($hotel_data)) {
            $hotel_ids = [];
            foreach ($hotel_data as $list) {
                $arrival_hotel_details_ids[] = $list->arrival_hotel_details_id;
            }
            $arrival_hotel_details = implode(',', $arrival_hotel_details_ids);
            $sql_hotel_details = 'UPDATE `arrival_hotel_details` SET arrival_hotel_details.hotel_id = ' . $hotel_revoke_id . ' WHERE arrival_hotel_details.id IN(' . $arrival_hotel_details . ')';
            $this->db->query($sql_hotel_details);
        }
        echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Hotel rollbacked successfully!</div>']);
        exit;
    }

    //new 
    public function room_category_costing()
    {
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

        if (isset($childprice_with_breakfast) && $childprice_with_breakfast != null) {
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
        }

        try {
            // Insert adult data if present
            if (!empty($adultData)) {
                $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $adultData]);
                if (!empty($childData)) {
                    $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $childData]);
                }
            }
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => 'Room Pricing created successfully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function room_category_costing_edit()
    {
        $category_id = base64_decode($this->input->get('category_id'));
        $hotel_id = base64_decode($this->input->get('hotel_id'));

        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $data = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);

        if (empty($data)) {
            echo json_encode(['response' => 'success', 'details' => []]);
            exit;
        }
        echo json_encode(['response' => 'success', 'details' => $data]);
        exit;
    }

    public function edit_category_costing()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $adultpriceid =  $this->input->post('adultpriceid');
        $childpriceid =  $this->input->post('childpriceid');

        $adultprice_with_breakfast = $this->input->post('adultprice_with_breakfast');
        $adultprice_without_breakfast = $this->input->post('adultprice_without_breakfast');

        $childprice_with_breakfast = $this->input->post('childprice_with_breakfast');
        $childprice_without_breakfast = $this->input->post('childprice_without_breakfast');

        $child_bed = $this->input->post('child_bed');

        $category_id = base64_decode($this->input->post('category_id'));
        $hotel_id = base64_decode($this->input->post('hotel_id'));

        $adultData = array();
        $childData = array();

        for ($i = 0; $i < count($adultprice_with_breakfast); $i++) {

            $adultData = array(
                'from_date' => $from_date,
                'to_date' => $to_date,
                'price_with_breakfast' => $adultprice_with_breakfast[$i],
                'price_without_breakfast' => $adultprice_without_breakfast[$i],
                'child_bed' => '',
                'type' => 'adult',
                'admin_id' => $this->session->userdata('id'),
            );

            $update_data = ['table_name' => 'room_category_costing', 'update_data' => $adultData, 'condition' => ['id' => $adultpriceid[$i]]];
            $this->common_model->update_data_limit($update_data);
        }

        if (isset($childprice_with_breakfast) && $childprice_with_breakfast != null) {
            for ($i = 0; $i < count($childpriceid); $i++) {

                $childData = array(
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'price_with_breakfast' => $childprice_with_breakfast[$i],
                    'price_without_breakfast' => $childprice_without_breakfast[$i],
                    'child_bed' => $child_bed[$i],
                    'type' => 'child',
                    'admin_id' => $this->session->userdata('id'),
                );
                if ($childpriceid[$i] <> '') {
                    $update_data = ['table_name' => 'room_category_costing', 'update_data' => $childData, 'condition' => ['id' => $childpriceid[$i]]];
                    $this->common_model->update_data_limit($update_data);
                } else {
                    $childData = $childData + ['category_id' => $category_id, 'hotel_id' => $hotel_id, 'person_count' => $i + 1];
                    $this->common_model->insert_data(['table_name' => 'room_category_costing', 'insert_data' => $childData]);
                }
            }
        }

        try {
            echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Category Price Updated successully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function get_costing_data()
    {
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $checkin = $this->db->escape($checkin);  // Escaping the input for safety
        $checkout = $this->db->escape($checkout);

        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $hotel_id = $this->input->get('hotel_id');
        $category_id = $this->input->get('category_id');

        // for blackout date checking
        $where = "(black_out_dates.from_date <= $checkout AND black_out_dates.to_date >= $checkin)";
        $data['blackout_days'] = $this->common_model->get_data('black_out_dates', '', '', '*', $where, '', $count = false);

        // for costing
        $where = '(room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $where .= ' AND room_category_costing.person_count = ' . $adult . ' AND room_category_costing.type = \'adult\')';
        for ($i = 1; $i <= $child; $i++) {
            $where .= ' OR (room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
            $where .= ' AND room_category_costing.person_count = ' . $i . ' AND room_category_costing.type = \'child\')';
        }

        $get_costing_data = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);
        //echo '<pre>';print_r($data['get_costing_data']);
        if (count($get_costing_data) > 1) {
            $total_child_price = $child_cnt = 0;
            for ($i = 1; $i < count($get_costing_data); $i++) {
                $total_child_price += $get_costing_data[$i]->price_with_breakfast;
                $child_cnt++;
            }
            $get_costing_data[1]->price_with_breakfast = $total_child_price;
            $get_costing_data[1]->person_count = $child_cnt;
        }
        $data['get_costing_data'] = $get_costing_data;
        // for all costing details
        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $data['all_costing_detials'] = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);

        $where = 'room_costing_price.hotel_id = ' . $hotel_id . ' AND room_costing_price.category_id = ' . $category_id .
            ' AND room_costing_price.date BETWEEN ' . $checkin . ' AND ' . $checkout;
        $data['edit_costing_price'] = $this->common_model->get_data('room_costing_price', '', '', '*', $where, '', $count = false);

        echo json_encode(['response' => 'success', 'details' => $data]);
        exit;
    }

    public function add_costing_price()
    {
        // Retrieve the form data
        $hotel_id = $this->input->post('hotel_id');
        $category_id = $this->input->post('category_id');
        $dates = $this->input->post('dates');
        $prices = $this->input->post('cost');
        $day_type = $this->input->post('day_type');
        $total = $this->input->post('total');
        $arrival_id = base64_decode($this->input->post('hdn_arrival_id'));

        $data_entries = array();

        $select = 'room_costing_price.id';
        $where = 'room_costing_price.hotel_id = ' . $hotel_id . ' AND room_costing_price.category_id = ' . $category_id . ' AND room_costing_price.arrival_id = ' . $arrival_id;
        $exists = $this->common_model->get_data('room_costing_price', '', '', $select, $where, '', $count = true);
        if ($exists) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div style="color:#ff0f0f;">For This Room Costing Already Created!</div>']);
            exit;
        }

        for ($i = 0; $i < count($dates); $i++) {
            $data_entries[] = array(
                'category_id' => $category_id,
                'hotel_id' => $hotel_id,
                'date' => $dates[$i],
                'price' => $prices[$i],
                'day_type' => $day_type[$i],
                'admin_id' => $this->session->userdata('id'),
                'arrival_id' => $arrival_id
            );
        }

        try {
            // Insert adult data if present
            if (!empty($data_entries)) {

                $this->common_model->insert_data_batch(['table_name' => 'room_costing_price', 'insert_data' => $data_entries]);

                $insert_arr = ['hotel_id' => $hotel_id, 'category_id' => $category_id, 'total_price' => $total, 'admin_id' => $this->session->userdata('id')];
                $this->common_model->insert_data(['table_name' => 'room_costing_price_log', 'insert_data' => $insert_arr]);

                echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Costing Added Successully!']);
                exit;
            } else {
                echo json_encode(['response' => 'e', 'details' => '', 'msg' => 'Room Costing Not Created!']);
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function edit_costing_price()
    {
        // Retrieve the form data
        $hotel_id = $this->input->post('hotel_id');
        $category_id = $this->input->post('category_id');
        $dates = $this->input->post('dates');
        $prices = $this->input->post('cost');
        $day_type = $this->input->post('day_type');
        $id = $this->input->post('ids');
        $total = $this->input->post('total');

        $data_entries = array();

        for ($i = 0; $i < count($dates); $i++) {
            $data_entries = array(
                'category_id' => $category_id,
                'hotel_id' => $hotel_id,
                'date' => $dates[$i],
                'price' => $prices[$i],
                'day_type' => $day_type[$i],
                'admin_id' => $this->session->userdata('id'),
            );

            $update_data = ['table_name' => 'room_costing_price', 'update_data' => $data_entries, 'condition' => ['id' => $id[$i]]];
            $updated = $this->common_model->update_data_limit($update_data);
        }

        try {
            $insert_arr = ['hotel_id' => $hotel_id, 'category_id' => $category_id, 'total_price' => $total, 'admin_id' => $this->session->userdata('id')];
            $this->common_model->insert_data(['table_name' => 'room_costing_price_log', 'insert_data' => $insert_arr]);

            echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Costing Prices Updated Successully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function hotel_pricing_download()
    {
        // Decode the hotel ID from the URL
        $hotel_id = base64_decode($this->input->get('hotel_id'));

        // Prepare the SQL query to retrieve hotel room categories and costs
        $select = 'hotel_room_categories.category_name, hotel_room_categories.room_size,hotel_room_categories.id AS ids, hotel_room_categories.max_accomodation, hotel_room_categories.number_adults, hotel_room_categories.number_childs, hotel_room_categories.child_bed, hotels.name, room_category_costing.*';
        $where = 'hotel_room_categories.hotel_id = ' . (int)$hotel_id; // Sanitize the hotel ID

        // Define the JOIN statements
        $join = [
            ['type' => 'left', 'join_table' => 'hotels', 'condition' => 'hotels.id = hotel_room_categories.hotel_id'],
            ['type' => 'left', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.category_id = hotel_room_categories.id']
        ];

        // Get data from the database
        $result = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', false, $join);

        // Format the result into a structured array
        $formattedResult = [];

        foreach ($result as $row) {
            $categoryId = $row->ids; // Use the category ID as the key

            // Initialize the category if not already done
            if (!isset($formattedResult[$categoryId])) {
                $formattedResult[$categoryId] = [
                    'category_name' => $row->category_name,
                    'ids' => $row->ids,
                    'room_size' => $row->room_size,
                    'from_date' => $row->from_date,
                    'to_date' => $row->to_date,
                    'max_accomodation' => $row->max_accomodation,
                    'number_adults' => $row->number_adults,
                    'number_childs' => $row->number_childs,
                    'child_bed' => $row->child_bed,
                    'date_from' => $row->from_date,
                    'date_to' => $row->to_date,
                    'name' => $row->name,
                ];
            }

            // Bind person_count and price based on type
            if ($row->type === 'adult') {
                $formattedResult[$categoryId]['price_with_breakfast_' . $row->person_count] = $row->price_with_breakfast;
            } elseif ($row->type === 'child') {
                $formattedResult[$categoryId]['price_with_child_' . $row->person_count] = $row->price_with_breakfast;
            }
        }

        // Re-index the array
        $result = array_values($formattedResult);
        
        // echo '<pre>';
        // print_r($result);
        // exit;

        // Load PHPExcel library
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        // Set the active sheet index
        $objPHPExcel->setActiveSheetIndex(0);

        // Set the header row font to bold
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

        // Set headers for the Excel sheet
        $headers = [
            'Category ID',
            'Room Category Name',
            'Room Size',
            'Max Occupancy',
            'Adults Allowed',
            'Childs Allowed',
            'Child Options (CWB/CNB/NA)',
            'Date From',
            'Date To',
            'Single Occupancy Price',
            'Double Occupancy Price',
            'Triple Occupancy Price',
            'Four Occupancy Price',
            'Child Price'
        ];

        // Populate the header row
        $column = 'A'; // Start from column A
        foreach ($headers as $header) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . '1', $header);
            $column++;
        }

        // Populate data rows
        $row = 2;
        foreach ($result as $sr => $list) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $list['ids']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $list['category_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $list['room_size']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $list['max_accomodation']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $list['number_adults']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $list['number_childs']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $list['child_bed']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $list['from_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $list['to_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $list['price_with_breakfast_1'] ?? '');
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $list['price_with_breakfast_2'] ?? '');
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $list['price_with_breakfast_3'] ?? '');
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $list['price_with_breakfast_4'] ?? '');
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $list['price_with_child_5'] ?? '');

            $row++;
        }

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $result[0]['name'] . '-room-category-pricing_' . date('d-M-Y') . '.csv"');
        header('Cache-Control: max-age=0');

        // Create CSV writer object and output the file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    public function csv_upload()
    {
        $hotel_id = ($this->input->get('hotel_id') !== '' && base64_decode($this->input->get('hotel_id')) !== '')
            ? base64_decode($this->input->get('hotel_id'))
            : redirect('all-hotel');

        $where = 'hotel_room_categories.hotel_id=' . $hotel_id;
        $all_category = $this->common_model->get_data('hotel_room_categories', '', '', 'hotel_room_categories.id', $where, '', $count = false);

        $category_ids = array_column($all_category, 'id'); // Valid category IDs from the DB
        $csv_category_ids = []; // Collect category IDs from CSV

        $upload_csv = 'documents/csv_files/';
        $allowed_csv_files = ['text/csv'];

        if (empty($_FILES['csv_file']['name']) || !in_array($_FILES['csv_file']['type'], $allowed_csv_files)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Improper inputs, try again!</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        $random_alphanumeric = substr(bin2hex(random_bytes(4)), 0, 8);
        $current_date = date('d-m-Y');
        $csv_file_name = $random_alphanumeric . '_' . $current_date . '.csv';
        $csv_file_path = $upload_csv . $csv_file_name;

        if (!move_uploaded_file($_FILES["csv_file"]["tmp_name"], $csv_file_path)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Failed to upload CSV. Please try again.</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        $file = fopen($csv_file_path, "r");
        fgetcsv($file); // Skip header

        $data_to_insert = [];
        $active_categories = [];
        $inactive_categories = $category_ids;

        date_default_timezone_set('Asia/Kolkata');
        $created_at = date('Y-m-d H:i:s');
        $total_rows = $inserted_rows = $updated_rows = 0;

        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $total_rows++;

            if (count($emapData) < 8 || empty($emapData[3])) {
                continue;
            }

            $category_id = $emapData[0];
            $csv_category_ids[] = $category_id;

            $room_size = $emapData[2];
            $max_accomodation = (int) $emapData[3];
            $number_adults = (int) $emapData[4];
            $number_childs = (int) $emapData[5];
            $child_bed = $emapData[6];
            $from_arr = explode('-',$emapData[7]);
            $from_date = trim($from_arr[2]).'-'.trim($from_arr[1]).'-'.trim($from_arr[0]);
            $to_arr = explode('-',$emapData[8]);
            $to_date = trim($to_arr[2]).'-'.trim($to_arr[1]).'-'.trim($to_arr[0]);
            $child_bed_price = $emapData[13];

            $errors = [];
            if ($max_accomodation > 5) $errors[] = 'Max accommodation must be <= 5';
            if ($number_adults < 1 || $number_adults > 4) $errors[] = 'Adults must be 1-4';
            if ($number_childs < 0 || $number_childs > 4) $errors[] = 'Children must be 0-4';
            if (($number_adults + $number_childs) > 5) $errors[] = 'Total occupants cannot exceed 5';
            if ($child_bed !=  'CWB' && $child_bed != 'CNB' && $child_bed != 'NA') $errors[] = 'Child bed required.';
            if ($child_bed !=  'NA' && $child_bed_price == '') $errors[] = 'Child bed price required.';


            if ($errors) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Row ' . $total_rows . ': ' . implode('. ', $errors) . '</div>');
                redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
            }

            $has_price = false;
            for ($i = 9; $i <= 13; $i++) {
                if (!empty($emapData[$i]) && $emapData[$i] > 0 ) {
                    $has_price = true;
                    $insert_data = [
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'person_count' => ($i === 13 ? 1 : $i - 8),
                        'price_with_breakfast' => $emapData[$i],
                        'type' => ($i === 13 ? 'child' : 'adult'),
                        'child_bed' => ($i === 13 ? $child_bed : ''),
                        'category_id' => $category_id,
                        'hotel_id' => $hotel_id,
                        'admin_id' => $this->session->userdata('id'),
                        'status' => 'active',
                        'created_at' => $created_at
                    ];

                    $where = [
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'category_id' => $category_id,
                        'hotel_id' => $hotel_id,
                        'person_count' => $i - 8,
                        'type' => ($i === 13 ? 'child' : 'adult')
                    ];

                    $existing_record = $this->db->get_where('room_category_costing', $where)->row_array();

                    if ($existing_record) {
                        $this->db->where($where);
                        $this->db->update('room_category_costing', $insert_data);
                        $updated_rows++;
                    } else {
                        $data_to_insert[] = $insert_data;
                    }
                }
            }

            if ($has_price) {
                $active_categories[] = $category_id;
            }

            $this->db->where('id', $category_id);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', [
                'room_size' => $room_size,
                'max_accomodation' => $max_accomodation,
                'number_adults' => $number_adults,
                'number_childs' => $number_childs,
                'child_bed' => $child_bed
            ]);
        }
        fclose($file);

        $invalid_categories = array_diff($csv_category_ids, $category_ids);
        if ($invalid_categories) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid categories: ' . implode(', ', $invalid_categories) . '</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        if ($active_categories) {
            $this->db->where_in('id', $active_categories);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', ['status' => 'active']);
            $inactive_categories = array_diff($inactive_categories, $active_categories);
        }

        if ($inactive_categories) {
            $this->db->where_in('id', $inactive_categories);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', ['status' => 'inactive']);
        }

        if ($data_to_insert) {
            $this->db->insert_batch('room_category_costing', $data_to_insert);
            $inserted_rows = count($data_to_insert);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success">CSV imported successfully. Rows: ' . $total_rows . ', Inserted: ' . $inserted_rows . ', Updated: ' . $updated_rows . '.</div>');
        redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    }
}
