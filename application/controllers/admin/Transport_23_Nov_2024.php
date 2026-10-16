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
            $this->load->view('admin/transport');
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
                redirect('all-transport');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
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

        if ($this->form_validation->run() == FALSE) {
            $where = 'id = ' . $transport_id;
            $data['transport'] = $this->common_model->get_data('transportation', '', '', '*', $where, '', $count = false)[0];
            $this->load->view('admin/transport_edit', $data);
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
            redirect('all-transport');
        }
    }


    public function transport_list()
    {
        $country = '';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $country = ($this->session->userdata('locations') != 'all') ? ucfirst($this->session->userdata('locations')) : '';
        }
        $data['transportations'] = $this->transport_model->all_transportations($country);
        $this->load->view('admin/transportation_list', $data);
    }

    public function delete_transport()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-transport');
        $update_arr = ['status' => 'deleted'];
        $id = $this->common_model->update_data_limit(['table_name' => 'transportation', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($id) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('all-transport');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
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

        $where = 'transport_id = ' . $transport_id;
        $transport_cost = $this->common_model->get_data('transportation_costs', '', '', '*', $where, '', $count = false);

        $where = 'transport_id = ' . $transport_id;
        $select = 'outsidecity_transportation_costs.*,sites.location_name as loc';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'sites', 'condition' => 'sites.id = outsidecity_transportation_costs.sites_id'],
        ];

        $outside_transport_cost = $this->common_model->get_data('outsidecity_transportation_costs', '', '', $select, $where, '', $count = false, $join);

        echo json_encode(['response' => 'success', 'transport' => $transport, 'transport_cost' => $transport_cost, 'outside_transport_cost' => $outside_transport_cost]);
        exit;
    }

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
                    'created_by' => $this->session->userdata('id')
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
            redirect('all-transport');
        } else {
            $update_data = [];

            foreach ($start_times as $index => $start_time) {
                $update_data[] = [
                    'id' => $id[$index], // Keep id separately
                    'data' => [
                        'type' => $types[$index],
                        'start_time' => $start_time,
                        'end_time' => $end_times[$index],
                        'hours' => $hours[$index],
                        'price' => $prices[$index],
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id')
                    ]
                ];
            }

            // Update records without id in the set data
            foreach ($update_data as $entry) {
                if (!empty($entry['id'])) {
                    $this->db->where('id', $entry['id']);
                    $this->db->update('transportation_costs', $entry['data']); // Use only data array
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Prices updated successfully!</div>');
            redirect('all-transport');
        }
    }

    public function outside_locations()
    {
        $searchTerm = $this->input->post('search');
        $country = $this->input->post('country');

        // Fetch distinct sites based on the search term and country
        $this->db->distinct();
        $this->db->select('sites.id, sites.location_name,sites.location_ids');
        $this->db->where('country', $country);
        $this->db->like('location_name', $searchTerm);
        $this->db->group_by('location_ids');
        $this->db->from('sites');
        $query = $this->db->get();



        // Fetch all existing records from outsidecity_transportation_costs
        $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', 'sites_id', '', '', $count = false);

        // Extract existing site IDs into an array
        $existing_site_ids = [];
        foreach ($exist_record as $record) {
            $existing_site_ids[] = $record->sites_id;
        }

        // Compare and filter $query results
        $data = [];
        foreach ($query->result() as $row) {
            if (!in_array($row->id, $existing_site_ids)) {
                $data[] = [
                    'label' => $row->location_name,
                    'id' => $row->id,
                    'location_ids' => $row->location_ids
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

    public function add_outsidecity_transportation_cost()
    {
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('price', 'Supplement Charges', 'trim|required');
        $id = $this->input->post('edit_id');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'danger', 'msg' => 'Fill form correctly']);
            exit;
        } else {
            $insert_arr = [
                'transport_id' => $this->input->post('transport_id'),
                'sites_id' => $this->input->post('sites_id'),
                'location_ids' => $this->input->post('location_id'),
                'price' => $this->input->post('price'),
                'toll_price' => $this->input->post('toll_price'),
                'parking_price' => $this->input->post('parking_price'),
                'currency' => $this->input->post('currency'),
                'status' => $this->input->post('status'),
                'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $where = 'transport_id = ' . $this->input->post('transport_id') .
                ' AND sites_id = ' . $this->input->post('sites_id');

            $exist_record = $this->common_model->get_data('outsidecity_transportation_costs', '', '', '*', $where, '', $count = false);

            if (!empty($id)) {
                $this->common_model->update_data_limit(['table_name' => 'outsidecity_transportation_costs', 'update_data' => $insert_arr, 'condition' => ['id' => $id]]);
                echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Outside City Charges Updated Successfully!</div>']);
            } else if (empty($id)) {
                if ($exist_record) {
                    echo json_encode(['response' => 'danger', 'msg' => '<div class="alert alert-danger">Record already exists! Please edit.</div>']);
                } else {
                    $id = $this->common_model->insert_data(['table_name' => 'outsidecity_transportation_costs', 'insert_data' => $insert_arr]);
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
        $country = $this->input->get('country');
        $transport_id = base64_decode($this->input->get('transport_id'));
        $currency = $this->input->get('currency');

        // Query for results with sites and transportation join
        $where = "sites.location_ids != 0 AND sites.country = " . $this->db->escape($country);

        $select = 'outsidecity_transportation_costs.id,outsidecity_transportation_costs.price,outsidecity_transportation_costs.created_at,outsidecity_transportation_costs.created_by,';
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
        } else {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-warning">No new data to insert. Updated existing records!</div>']);
        }
    }
}
