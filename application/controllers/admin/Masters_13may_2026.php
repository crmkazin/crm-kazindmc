<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masters extends CI_Controller
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
        check_delete();
        $this->load->model(['admin/enquiry_model', 'common_model', 'admin/company_model', 'admin/user_model', 'admin/dashboard_model','admin/auxiliary_model']);
        $this->load->library(['pagination', 'upload']);
        /*if(!in_array($this->session->userdata('id'),['8','13'])){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }*/
    }

    public function index()
    {
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                'state'   => $this->input->get('state'),
                'city'    => $this->input->get('city'),
                'category'=> $this->input->get('category'),
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }

        $where = 'sites.status != "deleted"';
        
        $admin = $this->db->select('location')
                    ->from('admin')
                    ->where('id', $this->session->userdata('id'))
                    ->get()->row();

        $admin_location = strtolower(trim($admin->location));

        if ($this->session->userdata('type') !== '1' && $admin->location !== 'all') 
        {
            $allowedCountries = array_map('trim', explode(',', $admin_location));
            $allowedCountries = array_map('strtolower', $allowedCountries);
            $where .= ' AND LOWER(sites.country) IN ("' . implode('","', $allowedCountries) . '")';
        }
        else 
        {
            if ($this->input->get('country')) {
                $where .= ' AND sites.country = "' . $this->input->get('country') . '"';
            }
        }

        // if ($this->input->get('country')) {
        //     $where .= ' AND sites.country = "' . $this->input->get('country') . '"';
        // }
        
        if ($this->input->get('state')) {
            $where .= ' AND sites.state = "' . $this->input->get('state') . '"';
        }
        if ($this->input->get('city')) {
            $where .= ' AND sites.city = "' . $this->input->get('city') . '"';
        }
        if ($this->input->get('category')) {
            $where .= ' AND sites.category = "' . $this->input->get('category') . '"';
        }

        $data['result'] = $this->common_model->get_data(
            'sites', '', '', '*', $where, ' ORDER BY id DESC'
        );

        $data['content'] = 'admin/itinerary_masters_list';
        $this->load->view('admin/layout', $data);
    }
    
    
    public function create_new()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Itinerary Masters Add', $this->session->userdata('id'), 'Masters: Itinerary Masters: Add');

            $data['country'] = ['label' => '', 'country_id' => ''];
            if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                $data['country'] = $this->company_model->get_country_ajax([
                    'search' => ucfirst($this->session->userdata('locations'))
                ])[0];
            }

            $data['content'] = 'admin/itinerary_masters_create_new';
            $this->load->view('admin/layout', $data);
        } else {
            // Collect form values
            $country      = $this->input->post('country');
            $city         = $this->input->post('city');
            $name         = $this->input->post('name');
            $category     = $this->input->post('category');
            $no_of_night  = $this->input->post('no_of_night');
            $location_ids = $this->input->post('location_ids');
            $new_location = $this->input->post('new_location_id');

            // Daywise data
            $sites = $this->input->post('hdn_site_id'); // array of arrays
            $times = $this->input->post('time');        // array of arrays

            // Insert into sites table
            $insert_arr = [
                'country'       => $country,
                'city'          => $city,
                'site_name'     => $name,
                'category'      => $category,
                'no_of_nights'   => $no_of_night,
                'admin_id'      => $this->session->userdata('id'),
                'created'       => date('Y-m-d H:i:s'),
                'location_ids'     => !empty($location_ids) ? json_encode($location_ids) : null,
                'location_name'  => $new_location ?? '',
                'status'        => 'active'
            ];

            // Insert site and get ID
            $itinerary_id = $this->common_model->insert_data([
                'table_name'  => 'sites',
                'insert_data' => $insert_arr
            ]);

            // Insert into overnight_itinerary table
            if (!empty($sites)) {
                foreach ($sites as $dayIndex => $siteIds) {
                    $dayNumber = $dayIndex + 1;

                    foreach ($siteIds as $key => $siteId) {
                        $overnightData = [
                            'itinerary_id' => $itinerary_id,
                            'site_ids'      => $siteId,
                            'time'         => isset($times[$dayIndex][$key]) ? $times[$dayIndex][$key] : '',
                            'days'          => $dayNumber
                        ];

                        $this->common_model->insert_data([
                            'table_name'  => 'overnight_itinerary',
                            'insert_data' => $overnightData
                        ]);
                    }
                }
            }

            log_user_activity('Itinerary Masters Add New Overnight Data', $this->session->userdata('id'), 'Add New:' . json_encode($insert_arr));

            $this->session->set_flashdata('success', 'Itinerary created successfully');
            redirect('/itinerary-masters-create-new');
        }
    }
    

    public function get_country_ajax()
    {
        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->company_model->get_country_ajax($postData);
        echo json_encode($data);
    }

    public function get_hotel_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_hotel_ajax($postData);
        echo json_encode($data);
    }


    public function get_country_ajax_new()
    {
        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->company_model->get_country_ajax_new($postData);
        echo json_encode($data);
    }

    public function get_specific_country_ajax()
    {
        $postData = $this->input->post();
        $response = [];

        $this->db->select('*');
        
        if (!empty($postData['search'])) {
            $this->db->like('name', $postData['search']);
        }

        if (!empty($postData['allowed_ids'])) {
            $allowedIds = array_map('intval', explode(',', $postData['allowed_ids']));
            $this->db->where_in('id', $allowedIds);
        }

        $this->db->limit(10);
        $records = $this->db->get('countries')->result();

        foreach ($records as $row) {
            $response[] = [
                "country_id" => $row->id,
                "label" => $row->name
            ];
        }

        echo json_encode($response);
    }


    public function get_state_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_state_ajax($postData);
        echo json_encode($data);
    }
    
    public function get_sites() {
        $country = strtolower(trim($this->input->post('country')));
        $search  = trim($this->input->post('search'));

        $select = 'sites.id, sites.site_name AS label, sites.days_of_operation, sites.entry_ticket_fee, sites.child_entry_ticket_fee';
        $where  = 'sites.status = "active" 
                AND LOWER(sites.country) = "'.$country.'" 
                AND sites.site_name LIKE "%'.$search.'%"';

        $sites = $this->common_model->get_data('sites','', '', $select, $where, '', $count = false);
        echo json_encode($sites);
        exit;
    }
    
    public function get_driver_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_driver_using_ajax($postData);
        echo json_encode($data);
    }

    public function get_city_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_city_ajax($postData);
        echo json_encode($data);
    }    


    public function get_cities() {
        $search  = $this->input->post('search');
        $country = strtolower(trim($this->input->post('country')));
        $response = [];

        // Cities
        $this->db->distinct();
        $this->db->select('cities.name');
        $this->db->from('cities');
        $this->db->join('states', 'cities.state_id = states.id');
        $this->db->join('countries', 'countries.id = states.country_id');
        $this->db->where('LOWER(countries.name)', $country);
        $this->db->like('cities.name', $search);
        $this->db->order_by('cities.name', 'ASC');
        $this->db->limit(10);
        $result = $this->db->get()->result();

        foreach ($result as $row) {
            $response[] = [
                "label"        => trim($row->name),
                "value"        => trim($row->name),
                "suburb_flag"  => false
            ];
        }

        // Suburbs
        $this->db->distinct();
        $this->db->select('suburbs.name');
        $this->db->from('suburbs');
        $this->db->join('cities', 'suburbs.city_id = cities.id');
        $this->db->join('states', 'cities.state_id = states.id');
        $this->db->join('countries', 'countries.id = states.country_id');
        $this->db->where('LOWER(countries.name)', $country);
        $this->db->like('suburbs.name', $search);
        $this->db->order_by('suburbs.name', 'ASC');
        $this->db->limit(10);
        $result = $this->db->get()->result();

        foreach ($result as $row) {
            $response[] = [
                "label"        => trim($row->name),
                "value"        => trim($row->name),
                "suburb_flag"  => true
            ];
        }

        echo json_encode($response);
    }

    public function create()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        //$this->form_validation->set_rules('country_id', 'Select Country', 'trim|required',['required'=>'&nbsp;Select Country From List']);
        $this->form_validation->set_rules('operational_days[]', 'Operation Days', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Itinerary Masters Add',$this->session->userdata('id'), 'Masters: Itinerary Masters: Add');

            $data['country'] = ['label' => '', 'country_id' => ''];
            if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                $data['country'] = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))])[0];
            }
            $data['content'] = 'admin/itinerary_masters_create';
            $this->load->view('admin/layout', $data);
        } else {
            $operational_days = implode(',', $this->input->post('operational_days[]'));
            $location_ids = '0';
            $location_name = '';
            if($this->input->post('destination_type') == 'outsidecity'){
                if(!empty($this->input->post('location_ids[]'))){
                    $location_ids = (!empty($this->input->post('location_ids[]'))) ? implode(',', $this->input->post('location_ids[]')) : '0';
                    if ($location_ids <> 0) {
                        $select = 'GROUP_CONCAT(location_masters.location SEPARATOR " + ") AS location_names';
                        $where = 'location_masters.id IN (' . $location_ids . ')';
                        $result = $this->common_model->get_data('location_masters', '', '', $select, $where, ' GROUP BY location_masters.country', $count = false)[0];
                        $location_name = $result->location_names;
                    }
                }else{
                    $location_name = $this->input->post('new_location_id');
                    $destination_type = $this->input->post('destination_type');
                    $insert_arr = [
                        'country' => $this->input->post('country'),
                        'location' => $location_name,
                        'destination_type' => $destination_type,
                        'status' => 'active'
                    ];
                    $location_ids = $this->common_model->insert_data(['table_name' => 'location_masters', 'insert_data' => $insert_arr]);
                }
            }
            $season = $this->input->post('season');
            if ($season === 'winter') {
                $closer_date_from = $this->input->post('winter_from');
                $closer_date_to   = $this->input->post('winter_to');
            } elseif ($season === 'summer') {
                $closer_date_from = $this->input->post('summer_from');
                $closer_date_to   = $this->input->post('summer_to');
            }
            $insert_arr = [
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'site_name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'entry_ticket' => $this->input->post('entry_ticket'),
                'group_entry_ticket_fee' => $this->input->post('price'),
                'entry_ticket_for' => $this->input->post('ticket_for'),
                'number_of_persons' => $this->input->post('number_of_persons'),
                'entry_ticket_fee' => $this->input->post('entry_fee'),
                'child_entry_ticket_fee' => $this->input->post('child_entry_fee'),
                'departing_time_from_hotel' => $this->input->post('departing_time'),
                'duration' => $this->input->post('duration'),
                'description' => $this->input->post('description'),
                'admin_id' => $this->session->userdata('id'),
                'created' => date('Y-m-d H:i:s'),
                'days_of_operation' => $operational_days,
                'location_ids' => $location_ids,
                'location_name' => $location_name,
                'season'         => $season,
                'closer_date_from' => $closer_date_from,
                'closer_date_to'   => $closer_date_to,
                'miscellaneous_cost' => $this->input->post('miscellaneous_cost') ?? 'withoutcost',
            ];
            $id = $this->common_model->insert_data(['table_name' => 'sites', 'insert_data' => $insert_arr]);
            log_user_activity('Itinerary Masters Add New Data',$this->session->userdata('id'), 'Add New:'.json_encode($insert_arr));
            if ($id) {
                $insert_arr = [];
                $cnt = ($this->input->post("remarks")[0] <> '') ? count($this->input->post("remarks")) : 0;
                for ($i = 0; $i < $cnt; $i++) {
                    $insert_arr[$i] = ['remarks' => $this->input->post("remarks")[$i], 'sites_id' => $id, 'created' => date('Y-m-d H:i:s')];
                }
                if (!empty($insert_arr)) {
                    $this->common_model->insert_data_batch(['table_name' => 'itinerary_masters_remarks', 'insert_data' => $insert_arr]);
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Created Successfully!</div>');
                redirect('all-masters');
            }
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('operational_days[]', 'Operation Days', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');
        $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('all-masters');

        $where = 'site_activities_costs.sites_id= ' . $id;
        $data['site_activities_costs'] = $this->common_model->get_data('site_activities_costs', '', '', '*', $where, '', $count = false);
        if ($this->form_validation->run() == FALSE) {
            $where = 'sites.id= ' . $id;
            $data['result'] = $this->common_model->get_data('sites', '', '', '*', $where, '', $count = false)[0];
            if (empty($data['result'])) {
                redirect('all-masters');
            }
            log_user_activity('Itinerary Masters Edit',$this->session->userdata('id'), 'Masters: Itinerary Masters: Edit');

            $where = 'sites_id = ' . $data['result']->id;
            $data['result_remarks'] = $this->common_model->get_data('itinerary_masters_remarks', '', '', '*', $where, '', $count = false);
            // $data['country_id'] = $this->company_model->get_country_ajax(['search' => $data['result']->country])[0]['country_id'];
            $country_result = $this->company_model->get_country_ajax(['search' => $data['result']->country]);

            $data['country_id'] = (!empty($country_result) && isset($country_result[0]['country_id']))
                ? $country_result[0]['country_id']
                : null;

            $where = 'location_masters.status = "active" AND location_masters.country = "' . $data['result']->country . '"';
            $data['location_masters'] = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false);
            $data['content'] = 'admin/itinerary_masters_edit';
            $this->load->view('admin/layout', $data);
            
        } else {
            $operational_days = implode(',', $this->input->post('operational_days[]'));
            $location_ids = '0';
            $location_name = '';
            if($this->input->post('destination_type')=='outsidecity')
            {
                if (!empty($this->input->post('location_ids[]'))) {
                    $location_ids = (!empty($this->input->post('location_ids[]'))) ? implode(',', $this->input->post('location_ids[]')) : '0';
                    if ($location_ids <> 0) {
                        $select = 'GROUP_CONCAT(location_masters.location SEPARATOR " + ") AS location_names';
                        $where = 'location_masters.id IN (' . $location_ids . ')';
                        $result = $this->common_model->get_data('location_masters', '', '', $select, $where, ' GROUP BY location_masters.country', $count = false)[0];
                        $location_name = $result->location_names;
                    }
                } else {
                    $location_name = $this->input->post('new_location_id');
                    $destination_type = $this->input->post('destination_type');
                    $insert_arr = [
                        'country' => $this->input->post('country'),
                        'location' => $location_name,
                        'destination_type' => $destination_type,
                        'status' => 'active'
                    ];
                    $location_ids = $this->common_model->insert_data(['table_name' => 'location_masters', 'insert_data' => $insert_arr]);
                }
            }
            $where2 = 'id='.$id;
            $existing = $this->common_model->get_single(['table_name' => 'sites', 'condition'  => $where2 ]);
            if (!empty($existing)) {
                $previous_data = [
                    'country' => $existing['country'],
                    'city'         => $existing['city'],
                    'site_name'         => $existing['site_name'],
                    'category'         => $existing['category'],
                    'entry_ticket'         => $existing['entry_ticket'],
                    'group_entry_ticket_fee' => $existing['group_entry_ticket_fee'],
                    'entry_ticket_for' => $existing['entry_ticket_for'],
                    'number_of_persons' => $existing['number_of_persons'],
                    'entry_ticket_fee' => $existing['entry_ticket_fee'] ,
                    'child_entry_ticket_fee' => $existing['child_entry_ticket_fee'],
                    'departing_time_from_hotel'         => $existing['departing_time_from_hotel'],
                    'duration'         => $existing['duration'],
                    'description'         => $existing['description'],
                    'admin_id'         => $existing['admin_id'],
                    'days_of_operation'         => $existing['days_of_operation'],
                    'location_ids'         => $existing['location_ids'],
                    'location_name'         => $existing['location_name'],
                    'miscellaneous_cost' => $existing['miscellaneous_cost'],
                    'outcity_cost'         => $existing['outcity_cost'],
                ];
            } else {
                $previous_data = []; 
            }
            $season = $this->input->post('season');
            if ($season === 'winter') {
                $closer_date_from = $this->input->post('winter_from');
                $closer_date_to   = $this->input->post('winter_to');
            } elseif ($season === 'summer') {
                $closer_date_from = $this->input->post('summer_from');
                $closer_date_to   = $this->input->post('summer_to');
            }
            $child_Age_status = $this->input->post('age_option');
            $update_arr = [
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'site_name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'entry_ticket' => $this->input->post('entry_ticket'),
                'group_entry_ticket_fee' => $this->input->post('price'),
                'entry_ticket_for' => $this->input->post('ticket_for'),
                'number_of_persons' => $this->input->post('number_of_persons'),
                'entry_ticket_fee' => $this->input->post('entry_fee'),
                'child_entry_ticket_fee' => $this->input->post('child_entry_fee'),
                'departing_time_from_hotel' => $this->input->post('departing_time'),
                'duration' => $this->input->post('duration'),
                'description' => $this->input->post('description'),
                'admin_id' => $this->session->userdata('id'),
                'days_of_operation' => $operational_days,
                'location_ids' => $location_ids,
                'location_name' => $location_name,
                'season'         => $season,
                'closer_date_from' => $closer_date_from,
                'closer_date_to'   => $closer_date_to,
                'miscellaneous_cost' => $this->input->post('miscellaneous_cost') ?? 'withoutcost',
                'outcity_cost' => $this->input->post('out_city_cost'),
                'itinerary_child_age_status' => $child_Age_status,
            ];
          
            $update_data = ['table_name' => 'sites', 'update_data' => $update_arr, 'condition' => ['id' => $id]];

            $affected_rows = $this->common_model->update_data_limit($update_data);
          
            if ($affected_rows) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Itinerary Master Update',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
            }

            $edit_cnt = (array_key_exists('edit_remarks', $this->input->post()) && $this->input->post("edit_remarks")[0] <> '') ? count($this->input->post("edit_remarks")) : 0;
            
            for ($i = 0; $i < $edit_cnt; $i++) {
            $edit_id = $this->input->post('edit_id_remarks')[$i];
            $where1= 'id='.$edit_id;
            $existing1 = $this->common_model->get_single(['table_name' => 'itinerary_masters_remarks', 'condition'  => $where1 ]);
            if (!empty($existing1)) {
                $previous_data1 = [
                    'remarks' => $existing1['remarks'][$i],
                    'created'         => $existing1['created'],
                ];
            } else {
                $previous_data1 = []; 
            }
            log_user_activity('Itinerary Master Update',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data1));
        }   

            for ($i = 0; $i < $edit_cnt; $i++) {
                $update_arr = '';
                $edit_id = $this->input->post('edit_id_remarks')[$i];
                $update_arr = ['remarks' => $this->input->post("edit_remarks")[$i], 'created' => date('Y-m-d H:i:s')];
                $update_data = ['table_name' => 'itinerary_masters_remarks', 'update_data' => $update_arr, 'condition' => ['id' => $edit_id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }

            $insert_arr = [];
            $cnt = ($this->input->post("remarks")[0] <> '') ? count($this->input->post("remarks")) : 0;
            for ($i = 0; $i < $cnt; $i++) {
                $insert_arr[$i] = ['remarks' => $this->input->post("remarks")[$i], 'sites_id' => $id, 'created' => date('Y-m-d H:i:s')];
            }
            if (!empty($insert_arr)) {
                $this->common_model->insert_data_batch(['table_name' => 'itinerary_masters_remarks', 'insert_data' => $insert_arr]);
            }
            redirect('all-masters');
        }
    }

    public function get_locations()
    {
        $country = $this->input->post('country');
        $where = 'location_masters.status = "active" AND location_masters.country = "' . strtolower($country) . '"';
        $location_masters = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false);
        echo json_encode(['response' => 's', 'details' => $location_masters]);
    }

    public function create_restaurants()
    {
        log_user_activity('Restaurants Masters Add',$this->session->userdata('id'), 'Masters: Restaurants Masters: Add');

        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        if ($this->form_validation->run() == FALSE) 
        {
            $data['country'] = ['label' => '', 'country_id' => ''];
            if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                $data['country'] = $this->company_model->get_country_ajax(['search' => ucfirst($this->session->userdata('locations'))])[0];
            }
            $data['content'] = 'admin/itinerary_masters_create_restaurant';
            $this->load->view('admin/layout', $data);
        } else {
            $image = '';
            if ($_FILES['image']['name'] != "") {
                $config = array(
                    'upload_path'     => "uploads/restaurants/",
                    'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                    'detect_mime' => true,
                    'overwrite' => true,
                    'max_size' => '2048',
                    'encrypt_name' => true,
                );
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $data_img = $this->upload->data();
                    $image = $data_img['file_name'];
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    redirect('itinerary-masters-create-restaurants');
                }
            }
            $cuisine = implode(', ', ($this->input->post('cuisine') <> '') ? $this->input->post('cuisine') : []);
            $insert_arr = [
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'map' => $this->input->post('map'),
                'name' => $this->input->post('name'),
                'image' => $image,
                'restaurant_address' => $this->input->post('restaurant_address'),
                'contact_number' => $this->input->post('contact_number'),
                'price_range' => $this->input->post('price_range'),
                'description' => $this->input->post('description'),
                'cuisine' => $cuisine,
                'seating_capacity' => $this->input->post('seating_capacity'),
                'opening_time' => $this->input->post('opening_time'),
                'closing_time' => $this->input->post('closing_time'),
                'admin_id' => $this->session->userdata('id'),
                'created' => date('Y-m-d H:i:s')
            ];
            $id = $this->common_model->insert_data(['table_name' => 'restaurants', 'insert_data' => $insert_arr]);
            if ($id) {
                $insert_arr = [];
                $cnt = ($this->input->post("remarks")[0] <> '') ? count($this->input->post("remarks")) : 0;
                for ($i = 0; $i < $cnt; $i++) {
                    $insert_arr[$i] = ['remarks' => $this->input->post("remarks")[$i], 'restaurant_id' => $id, 'created' => date('Y-m-d H:i:s')];
                }
                if (!empty($insert_arr)) {
                    $this->common_model->insert_data_batch(['table_name' => 'restaurants_remarks', 'insert_data' => $insert_arr]);
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Created Successfully!</div>');
                log_user_activity('Restaurants Masters Add New',$this->session->userdata('id'), 'Masters: Restaurants Masters: Add New');
                redirect('all-masters-restaurants');
            }
        }
    }

    // public function restaurants()
    // {
    //     log_user_activity('Restaurants Masters View',$this->session->userdata('id'), 'Masters: Restaurants Masters: View');

    //     $where = 'restaurants.status != "deleted"';
    //     if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
    //         $where .= ' AND LOWER(restaurants.country) = "' . strtolower($this->session->userdata('locations')) . '"';
    //     }
    //     $data['result'] = $this->common_model->get_data('restaurants', '', '', '*', $where, ' ORDER BY restaurants.id DESC', $count = false);
    //     //echo '<pre>';print_r($data['result']);exit;
    //     $data['content'] = 'admin/itinerary_masters_list_restaurants';
    //     $this->load->view('admin/layout', $data);
    // }

    // public function restaurants()
    // {
    //     log_user_activity('Restaurants Masters View', $this->session->userdata('id'), 'Masters: Restaurants Masters: View');
    //     if ($this->input->get('submit')) {
    //         $filters = [
    //             'country' => $this->input->get('country'),
    //             'state'   => $this->input->get('state'),
    //             'city'    => $this->input->get('city')
    //         ];
    //         log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
    //     }

    //     $where = 'restaurants.status != "deleted"';
        
    //     if ($this->session->userdata('admin_type') != 'superadmin' && $user_locations != 'all') {
    //         $location_array = explode(',', strtolower($user_locations));
    //         $location_conditions = array_map(function ($loc) {
    //             return 'LOWER(restaurants.country) = "' . trim($loc) . '"';
    //         }, $location_array);
            
    //         $where .= ' AND (' . implode(' OR ', $location_conditions) . ')';
    //     }

    //     if ($this->input->get('country')) {
    //         $where .= ' AND sites.country = "' . $this->input->get('country') . '"';
    //     }
    //     if ($this->input->get('state')) {
    //         $where .= ' AND sites.state = "' . $this->input->get('state') . '"';
    //     }
    //     if ($this->input->get('city')) {
    //         $where .= ' AND sites.city = "' . $this->input->get('city') . '"';
    //     }

    //     $data['result'] = $this->common_model->get_data(
    //         'sites', '', '', '*', $where, ' ORDER BY id DESC'
    //     );

    //     $user_locations = $this->session->userdata('locations');

    //     // $data['result'] = $this->common_model->get_data('restaurants', '', '', '*', $where, ' ORDER BY restaurants.id DESC', $count = false);

    //     $data['content'] = 'admin/itinerary_masters_list_restaurants';
    //     $this->load->view('admin/layout', $data);
    // }


    public function restaurants()
    {
        log_user_activity('Restaurants Masters View', $this->session->userdata('id'), 'Masters: Restaurants Masters: View');

        // Collect filters
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                // 'state'   => $this->input->get('state'),
                'city'    => $this->input->get('city')
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }

        $where = 'restaurants.status != "deleted"';

        $user_locations = $this->session->userdata('locations');

        if ($this->session->userdata('admin_type') != 'superadmin' && $user_locations != 'all') {
            $location_array = explode(',', strtolower($user_locations));
            $location_conditions = array_map(function ($loc) {
                return 'LOWER(restaurants.country) = "' . trim($loc) . '"';
            }, $location_array);

            $where .= ' AND (' . implode(' OR ', $location_conditions) . ')';
        }

        if ($this->input->get('country')) {
            $where .= ' AND restaurants.country = "' . $this->input->get('country') . '"';
        }
        // if ($this->input->get('state')) {
        //     $where .= ' AND restaurants.state = "' . $this->input->get('state') . '"';
        // }
        if ($this->input->get('city')) {
            $where .= ' AND restaurants.city = "' . $this->input->get('city') . '"';
        }

        $data['result'] = $this->common_model->get_data(
            'restaurants', '', '', '*', $where, ' ORDER BY id DESC'
        );

        $data['content'] = 'admin/itinerary_masters_list_restaurants';
        $this->load->view('admin/layout', $data);
    }


    public function edit_restaurants()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');
        $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('all-masters-restaurants');

        $where='id='.$id;
        $existing = $this->common_model->get_single(['table_name' => 'restaurants', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'country' => $existing['country'],
                    'city'         => $existing['city'],
                    'map'         => $existing['map'],
                    'name'         => $existing['name'],
                    'price_range'         => $existing['price_range'],
                    'restaurant_address'         => $existing['restaurant_address'],
                    'contact_number'         => $existing['contact_number'],
                    'description'         => $existing['description'],
                    'cuisine'         => $existing['cuisine'],
                    'seating_capacity'         => $existing['seating_capacity'],
                    'opening_time'         => $existing['opening_time'],
                    'closing_time'         => $existing['closing_time'],
                    'admin_id'         => $existing['admin_id'],
                    'image'         => $existing['image'],
                ];
            } else {
                $previous_data = []; 
            }
        if ($this->form_validation->run() == FALSE) {
            $where = 'restaurants.id= ' . $id;
            $data['result'] = $this->common_model->get_data('restaurants', '', '', '*', $where, '', $count = false)[0];
            log_user_activity('Restaurant Master Edit',$this->session->userdata('id'), 'Restaurant Master Edit');
            if (empty($data['result'])) {
                redirect('all-masters-restaurants');
            }
            $where = 'restaurant_id = ' . $data['result']->id;
            $data['result_remarks'] = $this->common_model->get_data('restaurants_remarks', '', '', '*', $where, '', $count = false);
            $data['country_id'] = $this->company_model->get_country_ajax(['search' => $data['result']->country])[0]['country_id'];
            $data['content'] = 'admin/itinerary_masters_edit_restaurant';
            $this->load->view('admin/layout', $data);
        } else {
            $image = '';
            if ($_FILES['image']['name'] != "") {
                $config = array(
                    'upload_path'     => "uploads/restaurants/",
                    'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                    'detect_mime' => true,
                    'overwrite' => true,
                    'max_size' => '2048',
                    'encrypt_name' => true,
                );
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $data_img = $this->upload->data();
                    $image = $data_img['file_name'];
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    redirect('edit_restaurants_masters?id=' . $this->input->get('id'));
                }
            }
            $cuisine = implode(', ', ($this->input->post('cuisine') <> '') ? $this->input->post('cuisine') : []);
            $update_arr = [
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'map' => $this->input->post('map'),
                'name' => $this->input->post('name'),
                'price_range' => $this->input->post('price_range'),
                'restaurant_address' => $this->input->post('restaurant_address'),
                'contact_number' => $this->input->post('contact_number'),
                'description' => $this->input->post('description'),
                'cuisine' => $cuisine,
                'seating_capacity' => $this->input->post('seating_capacity'),
                'opening_time' => $this->input->post('opening_time'),
                'closing_time' => $this->input->post('closing_time'),
                'admin_id' => $this->session->userdata('id')
            ];
            if ($image <> '') {
                $update_arr = $update_arr + ['image' => $image];
            }
            $update_data = ['table_name' => 'restaurants', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            if ($affected_rows) {
                log_user_activity('Restaurant Master Update',$this->session->userdata('id'), 'Previous Data: '.json_encode($previous_data));
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            }

            $edit_cnt = (array_key_exists('edit_remarks', $this->input->post()) && $this->input->post("edit_remarks")[0] <> '') ? count($this->input->post("edit_remarks")) : 0;

            for ($i = 0; $i < $edit_cnt; $i++) {
                $update_arr = '';
                $edit_id = $this->input->post('edit_id_remarks')[$i];
                $update_arr = ['remarks' => $this->input->post("edit_remarks")[$i], 'created' => date('Y-m-d H:i:s')];
                $update_data = ['table_name' => 'restaurants_remarks', 'update_data' => $update_arr, 'condition' => ['id' => $edit_id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }

            $insert_arr = [];
            $cnt = ($this->input->post("remarks")[0] <> '') ? count($this->input->post("remarks")) : 0;
            for ($i = 0; $i < $cnt; $i++) {
                $insert_arr[$i] = ['remarks' => $this->input->post("remarks")[$i], 'restaurant_id' => $id, 'created' => date('Y-m-d H:i:s')];
            }
            if (!empty($insert_arr)) {
                $this->common_model->insert_data_batch(['table_name' => 'restaurants_remarks', 'insert_data' => $insert_arr]);
            }
            redirect('all-masters-restaurants');
        }
    }

    public function delete_masters()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-masters');
        $update_arr = ['status' => 'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name' => 'sites', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Itinerary Masters Delete',$this->session->userdata('id'), 'Masters: Itinerary Masters: Deleted');

            redirect('all-masters');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Itinerary Masters Delete',$this->session->userdata('id'), 'Masters: Itinerary Masters: Deleted (Error! Please Try Again!)');

            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_masters_restaurant()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-masters-restaurants');

        $where = ' restaurant_menus.restaurant_id = ' . $id;
        $restaurant_menus = $this->common_model->get_data('restaurant_menus', '', '', '*', $where, '', $count = true);
        if ($restaurant_menus) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Restaurant Menus Found. Restaurant cannot be deleted.</div>');
            log_user_activity('Restaurant Masters Delete',$this->session->userdata('id'), 'Masters: Restaurant Masters: Deleted(Restaurant Menus Found. Restaurant cannot be deleted)');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $update_arr = ['status' => 'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name' => 'restaurants', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Restaurant Masters Delete',$this->session->userdata('id'), 'Masters: Restaurant Masters: Deleted');
            redirect('all-masters-restaurants');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Restaurant Masters Delete',$this->session->userdata('id'), 'Masters: Restaurant Masters: Deleted (Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function edit_remove_remarks()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('sites_id', 'Itinerary Masters ID', 'required|integer');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $this->db->limit(1);
        $this->db->where(['id' => $this->input->post('id'), 'sites_id' => $this->input->post('sites_id')]);
        $this->db->delete('itinerary_masters_remarks');

        $response = ['response' => 's', 'details' => '', 'msg' => 'Deleted Successfully!'];
        echo json_encode($response);
        exit;
    }

    public function remove_remarks_restaurant()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
        $this->form_validation->set_rules('restaurant_id', 'Restaurant ID', 'required|integer');
        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $this->db->limit(1);
        $this->db->where(['id' => $this->input->post('id'), 'restaurant_id' => $this->input->post('restaurant_id')]);
        $this->db->delete('restaurants_remarks');

        $response = ['response' => 's', 'details' => '', 'msg' => 'Deleted Successfully!'];
        echo json_encode($response);
        exit;
    }


    //13 May 2024
    public function site_cost()
    {
        $site_id = ($this->input->get('site_id') <> '' && base64_decode($this->input->get('site_id')) <> '') ? base64_decode($this->input->get('site_id')) : redirect('all-masters');
        $id = base64_decode($this->input->get('id'));

        $select = 'sites.site_name';
        $where = 'id = ' . $site_id;
        $data['site_name'] = $this->common_model->get_data('sites', '', '', $select, $where, '', $count = false);


        $where = 'site_id = ' . $site_id;
        $data['site_cost'] = $this->common_model->get_data('site_costs', '', '', '*', $where, '', $count = false);

        if (empty($data['site_cost'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
        }

        if (!empty($id)) {
            $where = 'id = ' . $id;
            $data['site_costs'] = $this->common_model->get_data('site_costs', '', '', '*', $where, '', $count = false)[0];
        }

        $this->form_validation->set_rules('valid_from', 'Valid From', 'trim|required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('cost_type', 'Cost Type', 'trim|required');
        $this->form_validation->set_rules('cost', 'Cost', 'trim|required|integer');
        // $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'admin/site_cost';
            $this->load->view('admin/layout', $data);
        } else {

            $valid_from = $this->input->post('valid_from');
            $valid_to = $this->input->post('valid_to');

            foreach ($data['site_cost'] as $site) {
                $existing_valid_from = $site->valid_from;
                $existing_valid_to = $site->valid_to;
                if (
                    ($valid_from >= $existing_valid_from && $valid_from <= $existing_valid_to) ||
                    ($valid_to >= $existing_valid_from && $valid_to <= $existing_valid_to)
                ) {
                    // Dates overlap, show error message
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing record!</div>');
                    redirect('site-cost?site_id=' . base64_encode($site_id));
                }
            }

            $arr = array(
                'valid_from' => $valid_from,
                'valid_to' => $valid_to,
                'title' => $this->input->post('title'),
                'cost_type' => $this->input->post('cost_type'),
                'cost' => $this->input->post('cost'),
                // 'status' => $this->input->post('status')
            );

            // if ($this->input->post('cost_for') == 'per-person') {
            //     $arr['cost_adult'] = $this->input->post('cost');
            //     $arr['cost_child'] = $this->input->post('cost');
            // }
            // if ($this->input->post('cost_for') == 'per-adult') {
            //     $arr['cost_adult'] = $this->input->post('cost');
            // }
            // if ($this->input->post('cost_for') == 'per-child') {
            //     $arr['cost_child'] = $this->input->post('cost');
            // }

            if ($id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $this->common_model->update_data_limit(['table_name' => 'site_costs', 'update_data' => $arr, 'condition' => ['id' => $id]]);
            } else {
                $insert_arr = $arr + ['site_id' => $site_id];
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $id = $this->common_model->insert_data(['table_name' => 'site_costs', 'insert_data' => $insert_arr]);
            }
            redirect('site-cost?site_id=' . base64_encode($site_id));
        }
    }

    // public function add_child_age_cost()
    // {
    //     $encodedId = $this->input->get('id');
    //     $itinerary_id = base64_decode($encodedId);

    //     if ($_POST) {
    //         $agefrom = $this->input->post('agefrom');
    //         $ageto = $this->input->post('ageto');
    //         $amount = $this->input->post('amount');

    //         $data = [
    //             'agefrom' => $agefrom,
    //             'ageto' => $ageto,
    //             'amount' => $amount,
    //             'itinerary_id' => $itinerary_id,
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_at' => date('Y-m-d H:i:s'),
    //         ];

    //         // Insert data into itinerary_child_age_cost
    //         $this->db->insert('itinerary_child_age_cost', $data);

    //         // Update status in sites table
    //         $this->db->where('id', $itinerary_id);
    //         $this->db->update('sites', ['itinerary_child_age_status' => 1]);

    //         echo json_encode(['status' => true, 'message' => 'Saved successfully']);
    //         return;
    //     }

    // }


    public function add_child_age_cost()
    {
        $encodedId = $this->input->get('id');
        $itinerary_id = base64_decode($encodedId);

        if ($_POST) {

            $edit_id = $this->input->post('edit_id');
            $agefrom = (int)$this->input->post('agefrom');
            $ageto   = (int)$this->input->post('ageto');
            $amount  = $this->input->post('amount');

            // ==========================
            // OVERLAP CHECK (exclude self if editing)
            // ==========================
            $this->db->from('itinerary_child_age_cost');
            $this->db->where('itinerary_id', $itinerary_id);
            $this->db->where('status', 'active');

            if ($edit_id) {
                $this->db->where('id !=', $edit_id);
            }

            $this->db->group_start();
            $this->db->where("agefrom <= {$ageto} AND ageto >= {$agefrom}", null, false);
            $this->db->group_end();

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                echo json_encode([
                    'status' => false,
                    'message' => 'This age range overlaps with an existing entry.'
                ]);
                return;
            }

            $data = [
                'agefrom'   => $agefrom,
                'ageto'     => $ageto,
                'amount'    => $amount,
                'updated_at'=> date('Y-m-d H:i:s'),
            ];

            if ($edit_id) {

                // 🔥 UPDATE
                $this->db->where('id', $edit_id);
                $this->db->update('itinerary_child_age_cost', $data);

                echo json_encode(['status' => true, 'message' => 'Updated successfully']);

            } else {

                // 🔥 INSERT
                $data['itinerary_id'] = $itinerary_id;
                $data['created_at']   = date('Y-m-d H:i:s');

                $this->db->insert('itinerary_child_age_cost', $data);

                $this->db->where('id', $itinerary_id);
                $this->db->update('sites', ['itinerary_child_age_status' => 1]);

                echo json_encode(['status' => true, 'message' => 'Saved successfully']);
            }
        }
    }

    public function fetch_child_age_list()
    {
        $encodedId = $this->input->get('id');
        $itinerary_id = base64_decode($encodedId);

        $result = $this->db->where('itinerary_id', $itinerary_id)
                        ->where('status', 'active')
                        ->order_by('created_at', 'ASC')
                        ->get('itinerary_child_age_cost')
                        ->result();

        echo json_encode($result);
    }

    public function delete_child_age_status()
    {
        $id = $this->input->post('id');

        if ($id) {
            $this->db->where('id', $id);
            $this->db->update('itinerary_child_age_cost', ['status' => 'inactive']);

            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function blackout_dates_list()
    {
        log_user_activity('Black Out Dates Masters View',$this->session->userdata('id'), 'Masters: Black Out Dates Master: View');

        $where = 'black_out_dates.status != "deleted"';
        $data['result'] = $this->common_model->get_data('black_out_dates', '', '', '*', $where, ' ORDER BY black_out_dates.id DESC', $count = false);

        $id = '';
        if ($this->input->get('id') <> '') {
            $id = base64_decode($this->input->get('id'));
            ($id == '') ? redirect('blackout-dates') : '';
            $where = 'id = ' . $id;
            $data['blackout_dates'] = $this->common_model->get_data('black_out_dates', '', '', '*', $where, '', $count = false)[0];
            if (empty($data['blackout_dates'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
                redirect('blackout-dates');
            }
            $select = 'black_out_dates_hotels.*,hotels.name';
            $where = 'black_out_dates_hotels.status="active" AND black_out_dates_hotels.black_out_dates_id = ' . $id;
            $join = [
                ['type' => '', 'join_table' => 'black_out_dates_hotels', 'condition' => 'black_out_dates_hotels.black_out_dates_id = black_out_dates.id'],
                ['type' => '', 'join_table' => 'hotels', 'condition' => 'hotels.id = black_out_dates_hotels.hotel_id']
            ];
            $data['blackout_dates_hotels'] = $this->common_model->get_data('black_out_dates', '', '', $select, $where, '', $count = false, $join);

            //echo '<pre>';print_R($data['blackout_dates_hotels']);exit;
        }
        $data['locations'] = $this->locations;
        $this->form_validation->set_rules('event_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('from_date', 'From', 'trim|required');
        $this->form_validation->set_rules('to_date', 'To', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'admin/blackoutdates_list_view';
            $this->load->view('admin/layout', $data);
        } else {
            $arr = array(
                'name' => $this->input->post('event_name'),
                'from_date' => $this->input->post('from_date'),
                'to_date' => $this->input->post('to_date'),
                'status' => $this->input->post('status'),
                'admin_id' => $this->session->userdata('id'),
            );
            if ($id <> '') {

                $where = ' status!="deleted" AND id='.$id;
                $existing = $this->common_model->get_single(['table_name' => 'black_out_dates', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'name' => $existing['name'],
                    'from_date'         => $existing['from_date'],
                    'to_date'         => $existing['to_date'],
                    'status'         => $existing['status'],
                    'admin_id'         => $existing['admin_id'],
                ];
            } else {
                $previous_data = []; 
            }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Black Out Dates Masters Update',$this->session->userdata('id'), 'Previous Data: '. json_encode($previous_data));
                $this->common_model->update_data_limit(['table_name' => 'black_out_dates', 'update_data' => $arr, 'condition' => ['id' => $id]]);
                if ($id && !empty($this->input->post('hotel_id'))) {
                    $created = date('Y-m-d H:i:s');
                    $insert_hotels = [];
                    foreach ($this->input->post('hotel_id') as $list) {
                        $hotel_id_index = array_search($list, array_column($data['blackout_dates_hotels'], 'hotel_id'));
                        if ($hotel_id_index !== false && $data['blackout_dates_hotels'][$hotel_id_index]->black_out_dates_id == $id) {
                            continue;
                        }
                        $insert_hotels[] = ['black_out_dates_id' => $id, 'hotel_id' => $list, 'created' => $created];
                    }
                    if (!empty($insert_hotels)) {
                        $this->common_model->insert_data_batch(['table_name' => 'black_out_dates_hotels', 'insert_data' => $insert_hotels]);
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Black Out Dates Masters Add New',$this->session->userdata('id'), 'Masters: Black Out Dates Master: Add New ');
                $insert_arr = $arr + ['created' => date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name' => 'black_out_dates', 'insert_data' => $insert_arr]);

                if ($id && !empty($this->input->post('hotel_id'))) {
                    $created = date('Y-m-d H:i:s');
                    foreach ($this->input->post('hotel_id') as $list) {
                        $insert_hotels[] = ['black_out_dates_id' => $id, 'hotel_id' => $list, 'created' => $created];
                    }
                    $this->common_model->insert_data_batch(['table_name' => 'black_out_dates_hotels', 'insert_data' => $insert_hotels]);
                }
            }
            redirect('blackout-dates');
        }
    }

    public function delete_blackout_dates()
    {
        log_user_activity('Black Out Dates Masters View',$this->session->userdata('id'), 'Masters: Black Out Dates Master: View');
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('blackout-dates');
        $update_arr = ['status' => 'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name' => 'black_out_dates', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) {
            $where = ['black_out_dates_id' => $id];
            $arr = ['status' => 'deleted', 'modified' => date('Y-m-d H:i:s')];
            $affected_rows = $this->common_model->update_data(['table_name' => 'black_out_dates_hotels', 'update_data' => $arr, 'condition' => $where]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Black Out Dates Masters Delete',$this->session->userdata('id'), 'Masters: Black Out Dates Master: Deleted');
            redirect('blackout-dates');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Black Out Dates Masters View',$this->session->userdata('id'), 'Masters: Black Out Dates Master: Deleted(Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_blackout_hotels()
    {
        $this->form_validation->set_rules('black_out_dates_hotels_id', 'Black Out Date ID', 'trim|required|integer');
        $this->form_validation->set_rules('hotel_id', 'Hotel Id', 'trim|required|integer');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $where = ['id' => $this->input->post('black_out_dates_hotels_id'), 'hotel_id' => $this->input->post('hotel_id')];
        $arr = ['status' => 'deleted', 'modified' => date('Y-m-d H:i:s')];
        $affected_rows = $this->common_model->update_data_limit(['table_name' => 'black_out_dates_hotels', 'update_data' => $arr, 'condition' => $where]);

        if ($affected_rows) {
            echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Hotel Removed Successfully!</div>']);
            exit;
        }
    }


    public function location_master_list()
    {
        log_user_activity('Location Masters View', $this->session->userdata('id'), 'Masters: Location Master: View');
    
        // Handle country filter from GET
        $filter_country = $this->input->get('country');
        $data['filter_country'] = $filter_country;
    
        $where = '';
        if (!empty($filter_country)) {
            $where = "country = " . $this->db->escape($filter_country);
            log_user_activity('Location Filter Applied', $this->session->userdata('id'), 'Filter: Country = ' . $filter_country);
        }
    
        $data['locations'] = $this->locations;
        $where .= "status = 'active'";
        $data['result'] = $this->common_model->get_data('location_masters', '', '', '*', $where, 'ORDER BY location_masters.id DESC');
    
        // Decode ID for edit case
        $id = base64_decode($this->input->get('id'));
    
        // Pre-fill edit data if ID is present
        if (!empty($id)) {
            $edit_where = 'id = ' . $id;
            $edit_data = $this->common_model->get_data('location_masters', '', '', '*', $edit_where);
            if (empty($edit_data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
                return redirect('location-master');
            }
            $data['result_data'] = $edit_data[0];
        }
    
        // Set form validation rules
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
    
        // Prepare form input data
        $arr = [
            'country' => $this->input->post('country'),
            'location' => $this->input->post('location'),
            'status' => $this->input->post('status'),
            'destination_type' => $this->input->post('destination_type'),
        ];
    
        // Check form validation
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'admin/location_master';
            $this->load->view('admin/layout', $data);
        } else {
            // Check for duplicate record
            $check_where = "country = " . $this->db->escape($arr['country']) .
                           " AND location = " . $this->db->escape($arr['location']);
            $exist_record = $this->common_model->get_data('location_masters', '', '', '*', $check_where);
    
            if (!empty($exist_record)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Record already exists! Please edit.!!</div>');
                log_user_activity('Location Masters Duplicate Entry', $this->session->userdata('id'), 'Duplicate Entry: ' . json_encode($arr));
            } elseif (!empty($id)) {
                // Update record
                $existing = $this->common_model->get_single([
                    'table_name' => 'location_masters',
                    'condition' => 'status != "deleted" AND id = ' . $id
                ]);
    
                if (!empty($existing)) {
                    $previous_data = [
                        'country' => $existing['country'],
                        'location' => $existing['location'],
                        'status' => $existing['status'],
                        'destination_type' => $existing['destination_type'],
                    ];
    
                    $this->common_model->update_data_limit([
                        'table_name' => 'location_masters',
                        'update_data' => $arr,
                        'condition' => ['id' => $id]
                    ]);
    
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master Updated Successfully!</div>');
                    log_user_activity('Location Masters Updated', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
                }
            } else {
                // Insert new record
                $this->common_model->insert_data([
                    'table_name' => 'location_masters',
                    'insert_data' => $arr
                ]);
    
                $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master added successfully!</div>');
                log_user_activity('Location Masters Added', $this->session->userdata('id'), 'New Entry: ' . json_encode($arr));
            }
    
            return redirect('location-master');
        }
    }
    
     // location master delete option
    public function delete_location($encoded_id)
    {
        $id = base64_decode($encoded_id);

        if (!$id) {
            $this->session->set_flashdata('error', 'Invalid Request');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Update status
        $update = $this->softDelete($id);

        if ($update) {
            $this->session->set_flashdata('success', 'Location deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete location.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function softDelete($id)
    {
        return $this->db->set('status', 'deleted')
                        ->where('id', $id)
                        ->update('location_masters');
    }

    // public function location_master_list()
    // {
    //     log_user_activity('Location Masters View',$this->session->userdata('id'), 'Masters: Location Master: View');
    //     $filter_country = $this->input->get('country');
    //     if ($this->input->get('submit')) {
    //         $filters = [
    //             'country' => $this->input->get('country')
    //         ];
    //         log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
    //     }
    //     // Build WHERE condition for country filter
    //     $where = '';
    //     if (!empty($filter_country)) {
    //         $where = "country = " . $this->db->escape($filter_country);
    //     }
    //     $data['locations'] = $this->locations;
    //     $data['result'] = $this->common_model->get_data('location_masters', '', '', '*', '', ' ORDER BY location_masters.id DESC', $count = false);

    //     $this->form_validation->set_rules('location', 'Location', 'trim|required');
    //     $this->form_validation->set_rules('country', 'Country', 'trim|required');
    //     $id = base64_decode($this->input->get('id'));

    //     $arr = array(
    //         'country' => $this->input->post('country'),
    //         'location' => $this->input->post('location'),
    //         'status' => $this->input->post('status'),
    //         'destination_type' => $this->input->post('destination_type'),
    //     );

    //     if ($this->input->get('id') <> '') {
    //         ($id == '') ? redirect('location-master') : '';
    //         $where = 'id = ' . $id;
    //         $data['result_data'] = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false)[0];
    //         if (empty($data['result_data'])) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
    //             redirect('location-master');
    //         }
    //     }

    //     $where = "country = " . $this->db->escape($this->input->post('country')) . 
    //     " AND location = " . $this->db->escape($this->input->post('location'));

    //    $exist_record = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false);

    //     // Check form validation
    //     if ($this->form_validation->run() == FALSE) {
    //         $data['content'] = 'admin/location_master';
    //         $this->load->view('admin/layout', $data);
    //     } else {
    //         if (!empty($exist_record)) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger">Record already exists! Please edit.!!</div>');
    //             log_user_activity('Location Masters Update',$this->session->userdata('id'), 'Record already exists! Please edit.!!');
    //         } 
    //         else if (!empty($id)) {

                
    //             $where1 = ' status!="deleted" AND id='.$id;
    //             $existing = $this->common_model->get_single(['table_name' => 'location_masters', 'condition'  => $where1 ]);

    //             if (!empty($existing)) {
    //                 $previous_data = [
    //                     'country' => $existing['country'],
    //                     'location' => $existing['location'],
    //                     'status' => $existing['status'],
    //                     'destination_type' => $existing['destination_type'],
    //                 ];
    //             // Update existing record
    //             $update_condition = ['id' => $id];
    //             $this->common_model->update_data_limit([
    //                 'table_name' => 'location_masters',
    //                 'update_data' => $arr,
    //                 'condition' => $update_condition
    //             ]);
               
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master Updated Successfully!</div>');
    //             log_user_activity('Location Masters Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
    //          } 
    //     }else {
    //                 $this->common_model->insert_data([
    //                     'table_name' => 'location_masters',
    //                     'insert_data' => $arr
    //                 ]);
    //                 $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master added successfully!!</div>');
    //                 log_user_activity('Location Masters Add New',$this->session->userdata('id'), 'Masters: Location Master: Add New');
    //         }
    //         redirect('location-master');
    //     }
    // }
    
    public function add_activities_cost()
    {
        $id = $this->input->post('id');
        $sites_id = $this->input->post('sites_id');
        $activity = $this->input->post('activity');
        // $ticket_type = $this->input->post('ticket_type');
        $activity_price = $this->input->post('activity_price');
        $child_activity_price = $this->input->post('child_activity_price');
        $activity_number_of_persons = $this->input->post('activity_number_of_persons');
        $activity_groupprice = $this->input->post('activity_Perprice');
        $activity_type = $this->input->post('activity_type');
        $currency = $this->input->post('currency');
        $childAgeOption = $this->input->post('child_age_type');

        $this->db->trans_start();

        foreach ($activity as $index => $act) {
            $record = [
                'sites_id' => $sites_id,
                'activity' => $activity[$index], 
                // 'ticket_type' => $ticket_type[$index], 
                'activity_type' => $activity_type[$index], 
                'price' => $activity_price[$index],
                'child_price' => $child_activity_price[$index], 
                'activity_child_age' => $childAgeOption[$index + 1],
                'group_price'=> $activity_groupprice[$index],
                'number_of_persons' => $activity_number_of_persons[$index],
                'currency' => $currency,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id')
            ];

            if (!empty($id[$index])) { 
                $this->db->where('id', $id[$index]);
                $this->db->update('site_activities_costs', $record);

            } else { 
                $this->db->insert('site_activities_costs', $record);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">An error occurred while saving the data.!</div>']);
            log_user_activity('Itinerary Master Add Activity',$this->session->userdata('id'), 'Error: (An error occurred while saving the data.!)');
        } else {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Activity Cost saved successfully!</div>']);
            log_user_activity('Itinerary Master Add Activity',$this->session->userdata('id'), 'Add Activity '. json_encode($record));

        }
    }
    
    public function add_entrance_cost()
    {
        $id = $this->input->post('id');
        $sites_id = $this->input->post('sites_id');
        $entrance_name = $this->input->post('entrance_name');
        // $entrance_ticket_type = $this->input->post('entrance_ticket_type');
        $entrance_adult_price = $this->input->post('entrance_adult_price');
        $entrance_child_price = $this->input->post('entrance_child_price');
        $entrance_number_of_persons = $this->input->post('entrance_number_of_persons');
        $entrance_group_price = $this->input->post('entrance_group_price');
        $entrance_type = $this->input->post('entrance_type');
        $currency = $this->input->post('currency');
        $childAgeOption = $this->input->post('child_age_type');

        $this->db->trans_start();

        foreach ($entrance_name as $index => $entrance) {
            $record = [
                'sites_id' => $sites_id,
                'entrance_name' => $entrance_name[$index], 
                'entrance_type' => $entrance_type[$index], 
                'adult_price' => $entrance_adult_price[$index],
                'child_price' => $entrance_child_price[$index], 
                'entrance_child_age' => $childAgeOption[$index + 1],
                'group_price' => $entrance_group_price[$index],
                'number_of_persons' => $entrance_number_of_persons[$index],
                'currency' => $currency,
                'created_by' => $this->session->userdata('id')
            ];

            if (!empty($id[$index])) { 
                $this->db->where('id', $id[$index]);
                $this->db->update('site_entrance_costs', $record);
            } else { 
                $this->db->insert('site_entrance_costs', $record);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">An error occurred while saving entrance data!</div>']);
            log_user_activity('Itinerary Master Add Entrance', $this->session->userdata('id'), 'Error: (An error occurred while saving entrance data!)');
        } else {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Entrance Cost saved successfully!</div>']);
            log_user_activity('Itinerary Master Add Entrance', $this->session->userdata('id'), 'Add Entrance ' . json_encode($record));
        }
    }

    public function delete_activities_costs()
    {
        $id = $this->input->post('id');

        $where ='id='.$id;

        $this->db->where($where);
        $deleted = $this->db->delete('site_activities_costs');

        if ($deleted) {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Row removed Successfully!</div>']);
            log_user_activity('Itinerary Master Activity Delete',$this->session->userdata('id'), 'Deleted Activity ID:'.$id);

        } else {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-danger">Error! Try Again!</div>']);
            log_user_activity('Itinerary Master Activity Delete',$this->session->userdata('id'), 'Error! Try Again!');
        }
    }
    
     public function delete_entrance_costs()
    {
        $id = $this->input->post('id');
        
        $data = [
            'status' => 'deleted',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $updated = $this->db->update('site_entrance_costs', $data);

        if ($updated) {
            echo json_encode(['response' => 'success', 'msg' => '<div class="alert alert-success">Entrance marked as deleted successfully!</div>']);
            log_user_activity('Itinerary Master Entrance Delete', $this->session->userdata('id'), 'Marked Entrance ID:' . $id . ' as deleted');
        } else {
            echo json_encode(['response' => 'error', 'msg' => '<div class="alert alert-danger">Error! Try Again!</div>']);
            log_user_activity('Itinerary Master Entrance Delete', $this->session->userdata('id'), 'Error marking Entrance ID:' . $id . ' as deleted');
        }
    }
    
    public function activity_costing(){
        $id = $this->input->post('id');

        $where = 'sites_id = ' . $id;
        $site_activities_costs = $this->common_model->get_data('site_activities_costs', '', '', '*', $where, '', $count = false);

        echo json_encode(['response' => 'success', 'cost' => $site_activities_costs]);
    }
    
    public function entrance_costing(){
        $id = $this->input->post('id');
        
        // Validate ID
        if(empty($id) || !is_numeric($id)) {
            echo json_encode(['response' => 'error', 'message' => 'Invalid site ID']);
            return;
        }
        
        $this->db->where('sites_id', $id);
        $this->db->where('status', 'active');
        $query = $this->db->get('site_entrance_costs');
        
        $site_entrance_costs = $query->result_array();
        
        echo json_encode(['response' => 'success', 'cost' => $site_entrance_costs]);
    }
    
    public function add_cuisine_prices(){
        $this->form_validation->set_rules('buffets', 'Buffet', 'trim|required');       
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        $this->form_validation->set_rules('adult_price', 'Adult Price', 'trim|required|integer');
        $this->form_validation->set_rules('child_price', 'Child Price', 'trim|required|integer');
        $this->form_validation->set_rules('cuisine_prices[]', 'Cuisines', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        if($this->input->post('hdn_update_id')<>'' && is_numeric($this->input->post('hdn_update_id'))){
            $where = ['id' => $this->input->post('hdn_update_id'), 'restaurant_id'=>$this->input->post('restaurant_id')];
            $insert_arr = ['type' => $this->input->post('type'),'buffet_name'=>$this->input->post('buffets'),
                'cuisines'=> implode(',',$this->input->post('cuisine_prices')),'adult_price'=>$this->input->post('adult_price'),
                'child_price'=>$this->input->post('child_price'),'restaurant_id'=>$this->input->post('restaurant_id'),
                'modified'=>date('Y-m-d H:i:s')];
            $affected_rows = $this->common_model->update_data_limit(['table_name' => 'restaurant_cuisine_prices', 'update_data' => $insert_arr, 'condition' => $where]);
            if($affected_rows){
                $msg = 'Updated Successfully!';
                $alert = 'alert-success';
            }else{ 
                $msg = 'Not Updated. Try Again!'; 
                $alert = 'alert-warning';
            } 
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert '.$alert.'">'.$msg.'</div>'];
            echo json_encode($response);
            exit;
        }
            
        $insert_arr = ['type' => $this->input->post('type'),'buffet_name'=>$this->input->post('buffets'),
            'cuisines'=> implode(',',$this->input->post('cuisine_prices')),'adult_price'=>$this->input->post('adult_price'),
            'child_price'=>$this->input->post('child_price'),'restaurant_id'=>$this->input->post('restaurant_id'),
            'created'=>date('Y-m-d H:i:s')];
        $id = $this->common_model->insert_data(['table_name' => 'restaurant_cuisine_prices', 'insert_data' => $insert_arr]);
        if($id){
            $msg = 'Added Successfully!';
            $alert = 'alert-success';
        }else{ 
            $msg = 'Not Added. Try Again!'; 
            $alert = 'alert-warning';
        } 
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert '.$alert.'">'.$msg.'</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function get_cuisine_prices(){
        $restaurant_id = $this->input->post('restaurant_id');
        $select = 'restaurant_cuisine_prices.*';
        $where = ' restaurant_cuisine_prices.status = "active" AND restaurant_cuisine_prices.restaurant_id = '.$restaurant_id;
        if(array_key_exists('id', $this->input->post()) && is_numeric(base64_decode($this->input->post('id')))){
            $id = base64_decode($this->input->post('id'));
            $where .= ' AND restaurant_cuisine_prices.id = '.$id;
        }
        $data['prices'] = $this->common_model->get_data('restaurant_cuisine_prices','', '', $select,$where, '',$count = false);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function auxiliary_master()
    {
        log_user_activity('Ancillary Masters View',$this->session->userdata('id'), 'Masters: Ancillary Masters: View');

        $where = 'auxiliary_guide.status != "deleted"';
        $data['result'] = $this->common_model->get_data('auxiliary_guide', '', '', '*', $where, ' ORDER BY auxiliary_guide.id DESC', $count = false);
        $data['content'] = 'admin/auxiliary_master';
        $this->load->view('admin/layout', $data);
    }
    
    public function auxiliary_guide_list()
    {
        log_user_activity('Ancillary Guide Masters View',$this->session->userdata('id'), 'Masters: Ancillary Guide Masters: View');
        
        $filter_country = $this->input->get('country');
        $data['filter_country'] = $filter_country;
        $where = 'auxiliary_guide.status != "deleted"';
        if (!empty($filter_country)) {
            $where .= ' AND auxiliary_guide.location = ' . $this->db->escape($filter_country);
            log_user_activity('Ancillary Guide Filter', $this->session->userdata('id'), 'Country Filter Applied: ' . $filter_country);
        }
        $data['result'] = $this->common_model->get_data('auxiliary_guide', '', '', '*', $where, ' ORDER BY auxiliary_guide.id DESC', $count = false);
        $data['content'] = 'admin/auxiliary_guide_list';
        $this->load->view('admin/layout', $data);
    }
    
    public function auxiliary_guide_create()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        // $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('day_charge', 'Day Charge', 'trim|required');
        $this->form_validation->set_rules('day_starttime', 'Day Start Time', 'trim|required');
        $this->form_validation->set_rules('guide_charge', 'Guide Charge', 'trim|required');
        $this->form_validation->set_rules('food_charge', 'Food Charge', 'trim|required');
        $this->form_validation->set_rules('accommodation_charge', 'Accommodation Charge', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            $this->load->model(['admin/user_model','common_model']);
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            log_user_activity('Ancillary Guide Add',$this->session->userdata('id'), 'Ancillary Guide: Add');
            $data['content'] = 'admin/auxiliary_guide_create';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
           
            $languages = $this->input->post('languages');
            $languages_string = !empty($languages) ? implode(',', $languages) : null;
            $vehicle = $this->input->post('vehicles');
            $vehicle_string = !empty($vehicle) ? implode(',', $vehicle) : null;

            $vehicle_names = null;

            if (!empty($vehicle)) {
                $this->db->select('vehicle_name');
                $this->db->from('transportation');
                $this->db->where_in('id', $vehicle);
                $query = $this->db->get();
                $rows = $query->result();

                // Extract vehicle names
                $names = array_map(function ($row) {
                    return $row->vehicle_name;
                }, $rows);

                $vehicle_names = implode(', ', $names);
            }
            
            $insert_arr = [
                'location' => $this->input->post('country'),
                'guide_type'=>$this->input->post('guide_type'),
                'gender'=> 'N/A',
                'languages' => $languages_string,
                'day_charge'=>$this->input->post('day_charge'),
                'day_start_time'=>$this->input->post('day_starttime'),
                'day_finish_time'=>$this->input->post('day_finishtime'),
                'night_charge'=>$this->input->post('night_charge'),
                'night_start_time'=>$this->input->post('night_starttime'),
                'night_finish_time'=>$this->input->post('night_finishtime'),
                'outday_charge'=>$this->input->post('outday_charge'),
                'outday_start_time'=>$this->input->post('outday_starttime'),
                'outday_end_time'=>$this->input->post('outday_endtime'),
                'guide_charge'=>$this->input->post('guide_charge'),
                'food_charge'=>$this->input->post('food_charge'),
                'accommodation_charge'=>$this->input->post('accommodation_charge'),
                'added_by'=>$this->session->userdata('id'),
                'vehicle' => $vehicle_names,
                'vehicle_name' => $vehicle_string
            ];

            $id = $this->common_model->insert_data(['table_name' => 'auxiliary_guide', 'insert_data' => $insert_arr]);
            if ($id) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Guide added Successfully!</div>');
                log_user_activity('Ancillary Guide Master Add New',$this->session->userdata('id'), 'Add New:'.json_encode($insert_arr));
                redirect('auxiliary-guide-master');
    
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Guide Master  Add New',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function auxiliary_guide_edit()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        // $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('day_charge', 'Day Charge', 'trim|required');
        $this->form_validation->set_rules('day_starttime', 'Day Start Time', 'trim|required');
        $this->form_validation->set_rules('guide_charge', 'Guide Charge', 'trim|required');
        $this->form_validation->set_rules('food_charge', 'Food Charge', 'trim|required');
        $this->form_validation->set_rules('accommodation_charge', 'Accommodation Charge', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if($this->form_validation->run() == FALSE)
        {
            $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-guide-master');
            $where = 'auxiliary_guide.id= ' . $id;
            $data['guide'] = $this->common_model->get_data('auxiliary_guide', '', '', '*', $where, '', $count = false)[0];

            log_user_activity('Ancillary Guide Edit',$this->session->userdata('id'), 'Ancillary Guide: Edit');
            $data['content'] = 'admin/auxiliary_guide_edit';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $where = 'id='.$this->input->post('id');
            $existing = $this->common_model->get_single(['table_name' => 'auxiliary_guide', 'condition'  => $where ]);
            if (!empty($existing)) 
            {
                $previous_data = [
                    'country' => $existing['location'],
                    'guide_type'         => $existing['guide_type'],
                    'gender'         => $existing['gender'],
                    'languages'         => $existing['languages'],
                    'day_charge'         => $existing['day_charge'],
                    'day_start_time'         => $existing['day_start_time'],
                    'day_finish_time'         => $existing['day_finish_time'],
                    'night_charge'         => $existing['night_charge'],
                    'night_start_time'         => $existing['night_start_time'],
                    'night_finish_time'         => $existing['night_finish_time'],
                    'outday_charge'         => $existing['outday_charge'],
                    'outday_start_time'         => $existing['outday_start_time'],
                    'outday_end_time'         => $existing['outday_end_time'],
                    'guide_charge'         => $existing['guide_charge'],
                    'food_charge'         => $existing['food_charge'],
                    'accommodation_charge'         => $existing['accommodation_charge'],
                    'added_by'         => $existing['added_by'],
                ];
            } else {
                $previous_data = []; 
            }
            $languages = $this->input->post('languages');
            $languages_string = !empty($languages) ? implode(',', $languages) : null;
            $vehicle = $this->input->post('vehicles');
            $vehicle_string = !empty($vehicle) ? implode(',', $vehicle) : null;

            $vehicle_names = null;

            if (!empty($vehicle)) {
                $this->db->select('vehicle_name');
                $this->db->from('transportation');
                $this->db->where_in('id', $vehicle);
                $query = $this->db->get();
                $rows = $query->result();

                // Extract vehicle names
                $names = array_map(function ($row) {
                    return $row->vehicle_name;
                }, $rows);

                $vehicle_names = implode(', ', $names);
            }

            $update_arr = [
                'location' => $this->input->post('country'),
                'guide_type'=>$this->input->post('guide_type'),
                'gender'=> $this->input->post('gender'),
                'languages' => $languages_string,
                'day_charge'=>$this->input->post('day_charge'),
                'day_start_time'=>$this->input->post('day_starttime'),
                'day_finish_time'=>$this->input->post('day_finishtime'),
                'night_charge'=>$this->input->post('night_charge'),
                'night_start_time'=>$this->input->post('night_starttime'),
                'night_finish_time'=>$this->input->post('night_finishtime'),
                'outday_charge'=>$this->input->post('outday_charge'),
                'outday_start_time'=>$this->input->post('outday_starttime'),
                'outday_end_time'=>$this->input->post('outday_endtime'),
                'guide_charge'=>$this->input->post('guide_charge'),
                'food_charge'=>$this->input->post('food_charge'),
                'accommodation_charge'=>$this->input->post('accommodation_charge'),
                'added_by'=>$this->session->userdata('id'),
                'vehicle' => $vehicle_names,
                'vehicle_name' => $vehicle_string
            ];
            $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_guide', 'update_data' => $update_arr, 'condition' => $where]);
            if ($affected) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Guide updated Successfully!</div>');
                log_user_activity('Ancillary Guide Master Update',$this->session->userdata('id'), 'Previous Data:'.json_encode($previous_data));
                redirect('auxiliary-guide-master');
    
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Guide Master  Update',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function auxiliary_guide_delete()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-guide-master');
        $update_arr = ['status' => 'deleted'];

        $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_guide', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) 
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Ancillary Guide Master Delete',$this->session->userdata('id'), 'Deleted id:'. $id);
            redirect('auxiliary-guide-master');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Ancillary Guide Master Delete',$this->session->userdata('id'), 'Error! Please Try Again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function auxiliary_luggage_vehicle()
    {
        log_user_activity('Ancillary Luggage Vehicle Master View',$this->session->userdata('id'), 'Masters: Ancillary Luggage Vehicle Master: View');
    
        $where = 'auxiliary_transportation.status != "deleted"';
        $data['result'] = $this->common_model->get_data('auxiliary_transportation', '', '', '*', $where, ' ORDER BY auxiliary_transportation.id DESC', $count = false);
        $data['content'] = 'admin/auxiliary_luggage_vehicle_list';
        $this->load->view('admin/layout', $data);
    }
    
    public function auxiliary_luggage_vehicle_create()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'trim|required');
        // $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            $this->load->model(['admin/user_model','common_model']);
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            log_user_activity('Ancillary Luggage Vehicle Master Add',$this->session->userdata('id'), 'Ancillary Luggage Vehicle Master: Add');
            $data['content'] = 'admin/auxiliary_luggage_vehicle_create';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $insert_arr = [
                'country' => $this->input->post('country'),
                'vehicle_type'=>$this->input->post('vehicle_type'),
                // 'vehicle_name'=> $this->input->post('vehicle_name'),
                'price'=>$this->input->post('price'),
                'added_by'=>$this->session->userdata('id'),
            ];

            $id = $this->common_model->insert_data(['table_name' => 'auxiliary_transportation', 'insert_data' => $insert_arr]);
            if ($id) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Luggage Vehicle added Successfully!</div>');
                log_user_activity('Ancillary Luggage Vehicle Master Add New',$this->session->userdata('id'), 'Add New:'.json_encode($insert_arr));
                redirect('auxiliary-luggage-vehicle');
    
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Luggage Vehicle Master Add New ',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function get_vehicle_types() {
        $country_name = $this->input->post('country_name');
        $vehicle_types = $this->auxiliary_model->get_vehicle_types_by_country($country_name);
        echo json_encode($vehicle_types);
    }
    
    public function auxiliary_luggage_vehicle_edit()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'trim|required');
        // $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-luggage-vehicle');
            $where = 'auxiliary_transportation.id= ' . $id;
            $data['guide'] = $this->common_model->get_data('auxiliary_transportation', '', '', '*', $where, '', $count = false)[0];

            log_user_activity('Ancillary Luggage Vehicle Master Edit',$this->session->userdata('id'), 'Ancillary Luggage Vehicle Master: Edit');
            $data['content'] = 'admin/auxiliary_luggage_vehicle_edit';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $where = 'id='.$this->input->post('id');
            $existing = $this->common_model->get_single(['table_name' => 'auxiliary_transportation', 'condition'  => $where ]);
            if (!empty($existing)) 
            {
                $previous_data = [
                    'country' => $existing['country'],
                    'vehicle_type'         => $existing['vehicle_type'],
                    // 'vehicle_name'         => $existing['vehicle_name'],
                    'price'         => $existing['price'],
                    'added_by'         => $existing['added_by'],
                ];
            } else {
                $previous_data = []; 
            }

            $update_arr = [
                'country' => $this->input->post('country'),
                'vehicle_type'=>$this->input->post('vehicle_type'),
                // 'vehicle_name'=> $this->input->post('vehicle_name'),
                'price'=>$this->input->post('price'),
                'added_by'=>$this->session->userdata('id'),
            ];

            $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_transportation', 'update_data' => $update_arr, 'condition' => $where]);
            if ($affected) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Luggage Vehicle updated Successfully!</div>');
                log_user_activity('Ancillary Luggage Vehicle Master Update',$this->session->userdata('id'), 'Previous Data:'.json_encode($previous_data));
                redirect('auxiliary-luggage-vehicle');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Luggage Vehicle Master Update',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function auxiliary_luggage_vehicle_delete()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-luggage-vehicle');
        $update_arr = ['status' => 'deleted'];

        $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_transportation', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) 
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Ancillary Luggage Vehicle Master Delete',$this->session->userdata('id'), 'Deleted id:'. $id);
            redirect('auxiliary-luggage-vehicle');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Ancillary Luggage Vehicle Master Delete',$this->session->userdata('id'), 'Error! Please Try Again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function auxiliary_miscellaneous_master()
    {
        log_user_activity('Ancillary Mandatory Services View',$this->session->userdata('id'), 'Masters: Ancillary Mandatory Services: View');
    
        $filter_country = $this->input->get('country');
        $data['filter_country'] = $filter_country;
        $where = 'auxiliary_miscellaneous.status != "deleted"';
        if (!empty($filter_country)) {
            $where .= ' AND auxiliary_miscellaneous.country = ' . $this->db->escape($filter_country);
            log_user_activity('Ancillary Guide Filter', $this->session->userdata('id'), 'Country Filter Applied: ' . $filter_country);
        }
        $data['result'] = $this->common_model->get_data('auxiliary_miscellaneous', '', '', '*', $where, ' ORDER BY auxiliary_miscellaneous.id DESC', $count = false);
        $data['content'] = 'admin/auxiliary_miscellaneous_list';
        $this->load->view('admin/layout', $data);
    }

    public function auxiliary_miscellaneous_create()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('group_type', 'group_type', 'trim|required');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('cost_by', 'cost_by', 'trim|required');
        $this->form_validation->set_rules('adult_price', 'Adult Price', 'trim|required');
        // $this->form_validation->set_rules('child_price', 'Child Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            log_user_activity('Ancillary Mandatory Services Add',$this->session->userdata('id'), 'Ancillary Mandatory Services: Add');
            $data['content'] = 'admin/auxiliary_miscellaneous_create';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $insert_arr = [
                'country' => $this->input->post('country'),
                'title'=>$this->input->post('title'),
                'group_type' => $this->input->post('group_type'),
                'quantity	'=>$this->input->post('quantity'),
                'cost_by	'=>$this->input->post('cost_by'),
                'adult_price'=> $this->input->post('adult_price'),
                'child_price'=>$this->input->post('child_price') ?: 0,
                'added_by'=>$this->session->userdata('id'),
            ];

            $id = $this->common_model->insert_data(['table_name' => 'auxiliary_miscellaneous', 'insert_data' => $insert_arr]);
            if ($id) 
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Mandatory Services added Successfully!</div>');
                log_user_activity('Ancillary Mandatory Services Add New',$this->session->userdata('id'), 'Add New:'.json_encode($insert_arr));
                redirect('auxiliary-miscellaneous-master');
    
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Mandatory Services Add New',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function auxiliary_miscellaneous_edit()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('adult_price', 'Adult Price', 'trim|required');
        $this->form_validation->set_rules('group_type', 'group_type', 'trim|required');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('cost_by', 'cost_by', 'trim|required');
        $this->form_validation->set_rules('adult_price', 'Adult Price', 'trim|required');
        // $this->form_validation->set_rules('child_price', 'Child Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-luggage-vehicle');
            $where = 'auxiliary_miscellaneous.id= ' . $id;
            $data['guide'] = $this->common_model->get_data('auxiliary_miscellaneous', '', '', '*', $where, '', $count = false)[0];

            log_user_activity('Ancillary Mandatory Services Edit',$this->session->userdata('id'), 'Ancillary Mandatory Services: Edit');
            $data['content'] = 'admin/auxiliary_miscellaneous_edit';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $where = 'id='.$this->input->post('id');
            $existing = $this->common_model->get_single(['table_name' => 'auxiliary_miscellaneous', 'condition'  => $where ]);
            if (!empty($existing)) 
            {
                $previous_data = [
                    'country' => $existing['country'],
                    'title'         => $existing['title'],
                    'group_type'    => $existing['group_type'],
                    'quantity'      => $existing['quantity'],
                    'cost_by'       => $existing['cost_by'],
                    'adult_price'         => $existing['adult_price'],
                    'child_price'         => $existing['child_price'],
                    'added_by'         => $existing['added_by'],
                ];
            } else {
                $previous_data = []; 
            }

            $update_arr = [
                'country' => $this->input->post('country'),
                'title'=>$this->input->post('title'),
                'group_type' => $this->input->post('group_type'),
                'quantity	'=>$this->input->post('quantity'),
                'cost_by	'=>$this->input->post('cost_by'),
                'adult_price'=> $this->input->post('adult_price'),
                'child_price'=>$this->input->post('child_price') ?: 0,
                'added_by'=>$this->session->userdata('id'),
            ];

            $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_miscellaneous', 'update_data' => $update_arr, 'condition' => $where]);
            if ($affected) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Mandatory Services updated Successfully!</div>');
                log_user_activity('Ancillary Mandatory Services Update',$this->session->userdata('id'), 'Previous Data:'.json_encode($previous_data));
                redirect('auxiliary-miscellaneous-master');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Mandatory Services Update',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function auxiliary_miscellaneous_delete()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-miscellaneous-master');
        $update_arr = ['status' => 'deleted'];

        $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_miscellaneous', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) 
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Ancillary Mandatory Services Delete',$this->session->userdata('id'), 'Deleted id:'. $id);
            redirect('auxiliary-miscellaneous-master');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Ancillary Mandatory Services Delete',$this->session->userdata('id'), 'Error! Please Try Again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function auxiliary_sightseeing_vehicle()
    {
        log_user_activity('Ancillary Sightseeing Vehicle Master View',$this->session->userdata('id'), 'Masters: Ancillary Sightseeing Vehicle Master: View');
    
        $where = 'auxiliary_sightseeing_vehicle.status != "deleted"';
        $data['result'] = $this->common_model->get_data('auxiliary_sightseeing_vehicle', '', '', '*', $where, ' ORDER BY auxiliary_sightseeing_vehicle.id DESC', $count = false);
        $data['content'] = 'admin/auxiliary_sightseeing_vehicle_list';
        $this->load->view('admin/layout', $data);
    }
    
    public function auxiliary_sightseeing_vehicle_create()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('sites_id', 'Sites Name', 'trim|required');
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'trim|required');
        $this->form_validation->set_rules('vehicle_capacity', 'Vehicle Capacity', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            log_user_activity('Ancillary Sightseeing Vehicle Master Add',$this->session->userdata('id'), 'Ancillary Sightseeing Vehicle Master: Add');
            $data['content'] = 'admin/auxiliary_sightseeing_vehicle_create';
            $this->load->view('admin/layout');
        } 
        else 
        {
            $insert_arr = [
                'country' => $this->input->post('country'),
                'sites_id'=>$this->input->post('sites_id'),
                'vehicle_name'=> $this->input->post('vehicle_name'),
                'vehicle_capacity'=>$this->input->post('vehicle_capacity'),
                'price'=>$this->input->post('price'),
                'added_by'=>$this->session->userdata('id'),
            ];

            $id = $this->common_model->insert_data(['table_name' => 'auxiliary_sightseeing_vehicle', 'insert_data' => $insert_arr]);
            if ($id) 
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Sightseeing Vehicle added Successfully!</div>');
                log_user_activity('Ancillary Sightseeing Vehicle Master Add New',$this->session->userdata('id'), 'Add New:'.json_encode($insert_arr));
                redirect('auxiliary-sightseeing-master');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Sightseeing Vehicle Master Add New',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function getsightseeing() 
    {
        $country_name = $this->input->post('country_name');
        $vehicle_types = $this->auxiliary_model->get_sightseeing_by_country($country_name);
        echo json_encode($vehicle_types);
    }
    
    public function auxiliary_sightseeing_vehicle_edit()
    {
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('sites_id', 'Sites Name', 'trim|required');
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'trim|required');
        $this->form_validation->set_rules('vehicle_capacity', 'Vehicle Capacity', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        if($this->form_validation->run() == FALSE)
        {
            $id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-sightseeing-master');
            $where = 'auxiliary_sightseeing_vehicle.id= ' . $id;
            $data['guide'] = $this->common_model->get_data('auxiliary_sightseeing_vehicle', '', '', '*', $where, '', $count = false)[0];

            log_user_activity('Ancillary Sightseeing Vehicle Master Edit',$this->session->userdata('id'), 'Ancillary Sightseeing Vehicle Master: Edit');
            $data['content'] = 'admin/auxiliary_sightseeing_vehicle_edit';
            $this->load->view('admin/layout', $data);
        } 
        else 
        {
            $where = 'id='.$this->input->post('id');
            $existing = $this->common_model->get_single(['table_name' => 'auxiliary_sightseeing_vehicle', 'condition'  => $where ]);
            if (!empty($existing)) 
            {
                $previous_data = [
                    'country' => $existing['country'],
                    'sites_id'         => $existing['sites_id'],
                    'vehicle_name'         => $existing['vehicle_name'],
                    'vehicle_capacity'         => $existing['vehicle_capacity'],
                    'price'         => $existing['price'],
                    'added_by'         => $existing['added_by'],
                ];
            } else {
                $previous_data = []; 
            }

            $update_arr = [
                'country' => $this->input->post('country'),
                'sites_id'=>$this->input->post('sites_id'),
                'vehicle_name'=> $this->input->post('vehicle_name'),
                'vehicle_capacity'=>$this->input->post('vehicle_capacity'),
                'price'=>$this->input->post('price'),
                'added_by'=>$this->session->userdata('id'),
            ];

            $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_sightseeing_vehicle', 'update_data' => $update_arr, 'condition' => $where]);
            if ($affected) 
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Ancillary Sightseeing Vehicle updated Successfully!</div>');
                log_user_activity('Ancillary Sightseeing Vehicle Master Update',$this->session->userdata('id'), 'Previous Data:'.json_encode($previous_data));
                redirect('auxiliary-sightseeing-master');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
                log_user_activity('Ancillary Sightseeing Vehicle Master Update',$this->session->userdata('id'), 'Error! Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function auxiliary_sightseeing_vehicle_delete()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('auxiliary-sightseeing-master');
        $update_arr = ['status' => 'deleted'];

        $affected = $this->common_model->update_data_limit(['table_name' => 'auxiliary_sightseeing_vehicle', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($affected) 
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Ancillary Sightseeing Vehicle Master Delete',$this->session->userdata('id'), 'Deleted id:'. $id);
            redirect('auxiliary-sightseeing-master');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Ancillary Sightseeing Vehicle Master Delete',$this->session->userdata('id'), 'Error! Please Try Again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // add driver
    public function add_driver()
    {
        log_user_activity('Driver Masters Add',$this->session->userdata('id'), 'Masters: Driver Masters: Add');
        
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'Mobile', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        
        if($this->form_validation->run() == FALSE){
            $this->load->model(['admin/user_model','common_model']);
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            log_user_activity('Driver Add',$this->session->userdata('id'), 'Driver: Add');
            $data['content'] = 'admin/driver_add';
            $this->load->view('admin/layout', $data);
        } else {
             $ins_data = ['driver_name' => $this->input->post('name'),'country'=>$this->input->post('country'),
                        'driver_phone_number'=>$this->input->post('isd_codes').'-'.$this->input->post('phone_number'),'state'=>$this->input->post('state'),
                        'city'=>$this->input->post('city'),'created'=>date('Y-m-d H:i:s'),
                        'admin_id'=>$this->session->userdata('id')];

            $insert = $this->common_model->insert_data(['table_name' => 'drivers', 'insert_data' => $ins_data]);
            if($insert){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Driver Add New',$this->session->userdata('id'), 'Driver: Add New');
                redirect('drivers-list');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Driver Add Error',$this->session->userdata('id'), 'Driver: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    // driver list
    public function list_drivers()
    {
        log_user_activity('Driver Masters View',$this->session->userdata('id'), 'Masters: Driver Masters: View');

        $where = 'drivers.status != "deleted"';
        if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
            $where .= ' AND LOWER(drivers.country) = "' . strtolower($this->session->userdata('locations')) . '"';
        }
        if ($this->session->userdata('locations') == 'all' && $this->input->get('country') <> '') {
            $where .= ' AND LOWER(drivers.country) = "' . strtolower($this->input->get('country')) . '"';
        }

        if ($this->input->get('state') != '') {
            $where .= ' AND LOWER(drivers.state) = "' . strtolower($this->input->get('state')) . '"';
        }

        if ($this->input->get('city') != '') {
            $where .= ' AND LOWER(drivers.state) = "' . strtolower($this->input->get('state')) . '"';
        }
        
        if ($this->input->get('driver_id') != '') {
            $where .= ' AND drivers.id = "' . $this->input->get('driver_id') . '"';
        }

        $data['result'] = $this->common_model->get_data('drivers', '', '', '*', $where, ' ORDER BY drivers.id DESC', $count = false);
        //echo '<pre>';print_r($data['result']);exit;
        $data['content'] = 'admin/drivers_list';
        $this->load->view('admin/layout', $data);
    }
    
    // driver Edit
    public function edit_driver(){
        
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'Mobile', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        
        $driver_id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('drivers-list');
        $where1 = 'id = '.$driver_id;
        $existing = $this->common_model->get_single(['table_name' => 'drivers', 'condition'  => $where1 ]);

            if (!empty($existing)) {
                $previous_data = [
                    'country' => $existing['country'],
                    'state'         => $existing['state'],
                    'city'         => $existing['city'],
                    'name'         => $existing['driver_name'],                    
                    'contact_number' => $existing['driver_phone_number'],
                    'status'         => $existing['status'],
                ];
            } else {
                $previous_data = []; 
            }

        if($this->form_validation->run() == FALSE){
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $where = 'id = '.$driver_id;
            $data['driver'] = $this->common_model->get_data('drivers','', '', '*',$where,'', $count = false)[0];
            log_user_activity('Driver: Edit',$this->session->userdata('id'), 'Driver: Edit');
            $data['content'] = 'admin/driver_edit';
            $this->load->view('admin/layout', $data);
        } else {
            
           $update_data = ['driver_name' => $this->input->post('name'),'country'=>$this->input->post('country'),
                        'driver_phone_number'=>$this->input->post('isd_codes').'-'.$this->input->post('phone_number'),'state'=>$this->input->post('state'),
                        'city'=>$this->input->post('city'), 'admin_id'=>$this->session->userdata('id')];
            
            
            $rows = $this->common_model->update_data_limit(['table_name'=>'drivers','update_data'=>$update_data,'condition'=>['id'=>$driver_id]]);
            if($rows){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Driver: Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
                redirect('drivers-list');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Driver: Update Error',$this->session->userdata('id'), 'Driver:Update (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
    }
    
    // delete driver for arrival
    public function delete_driver(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('drivers-list');
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'drivers','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Driver Delete',$this->session->userdata('id'), 'Driver: Deleted');
            redirect('drivers-list');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Driver Delete Error',$this->session->userdata('id'), 'Driver: Deleted (Error! Please Try Again!)');
            redirect('drivers-list');
        }
        
    }

    // update driver for arrival
    public function update_driver_for_arrival()
    {
        if ($this->input->method() === 'post') {
            $driver_id = $this->input->post('driver_id');
            $arrival_g_id = $this->input->post('arrival_g_id');
    
            if (empty($driver_id) || empty($arrival_g_id)) {
                echo json_encode([
                    'response' => 'e',
                    'msg' => 'Please select a driver and ensure the arrival ID is valid.'
                ]);
                return;
            }
    
            // Update the arrival with the driver_id
            $data = [
                'driver_id' => $driver_id
            ];
    
            $this->db->where('id', $arrival_g_id);
            $updated = $this->db->update('arrivals', $data);
    
            if ($updated) {
                // Get the driver details to return in response
                $this->db->select('driver_name, driver_phone_number');
                $this->db->from('guide_driver_detail');
                $this->db->where('id', $driver_id);
                $driver = $this->db->get()->row();
    
                echo json_encode([
                    'response' => 's',
                    'msg' => 'Driver updated successfully for the arrival.',
                    'driver' => [
                        'name' => $driver->driver_name ?? '',
                        'phone' => $driver->driver_phone_number ?? ''
                    ]
                ]);
            } else {
                echo json_encode([
                    'response' => 'e',
                    'msg' => 'No changes made or update failed.'
                ]);
            }
        }
    }
    
    // State Masters
    public function state_master()
    {
        log_user_activity('State Masters Add',$this->session->userdata('id'), 'Masters: State Masters: Add');
        
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        
        if($this->form_validation->run() == FALSE){
            log_user_activity('Region Add',$this->session->userdata('id'), 'Region: Add');
            $data['content'] = 'admin/state_master';
            $this->load->view('admin/layout', $data);
        } else {
            $existing_state = $this->db->where('country_id', $this->input->post('country_id'))
                                    ->where('name', $this->input->post('state'))
                                    ->where('is_deleted !=', 'yes')
                                    ->where('status !=', 'no')
                                    ->get('states')
                                    ->row_array();
            if($existing_state){
                $this->session->set_flashdata('message', '<p class="alert alert-danger text-dark" style="margin:0px!important;">Region already exists!</p>');
                log_user_activity('Region Add Error',$this->session->userdata('id'), 'Region: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $ins_data = ['country_id'=>$this->input->post('country_id'),'name'=>$this->input->post('state'),'status'=>'yes'];

            $insert = $this->common_model->insert_data(['table_name' => 'states', 'insert_data' => $ins_data]);
            if($insert){
                $this->session->set_flashdata('message', '<p class="alert alert-success text-dark" style="margin:0px!important;">Added Successfully!</p>');
                log_user_activity('Region Add New',$this->session->userdata('id'), 'Region: Add New');
                redirect('state-master-list');
            }else{
                $this->session->set_flashdata('message', '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
                log_user_activity('Region Add Error',$this->session->userdata('id'), 'Region: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // State Masters edit function
    public function edit_state_master($id = null)
    {
        log_user_activity('State Masters Edit', $this->session->userdata('id'), 'Masters: State Masters: Edit');
        if (empty($id)) {
            show_404();
        }
        $id = $id ?? $this->input->post('id');
        
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            
            // Fetch existing state
            $data['state'] = $this->db
            ->where('id', $id)
            ->where('status !=', 'no')
            ->get('states')
            ->row_array();
            
            if (empty($data['state'])) {
                show_404();
            }
            
            $data['content'] = 'admin/state_master_edit';
            $this->load->view('admin/layout', $data);
            
        } else {

            $update_data = [
                'country_id' => $this->input->post('country_id'),
                'name'       => $this->input->post('state'),
                'status'     => $this->input->post('status') ?? 'yes'
            ];

            $update_data = ['table_name' => 'states', 'update_data' => $update_data, 'condition' => ['id' => $id]];

            $update = $this->common_model->update_data_limit($update_data);

            if ($update) {
                $this->session->set_flashdata('message',
                    '<p class="alert alert-success text-dark" style="margin:0px!important;">Updated Successfully!</p>');
                log_user_activity('State Update Success', $this->session->userdata('id'), 'State: Update');
                redirect('state-master-list');
            } else {
                $this->session->set_flashdata('message',
                    '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
                log_user_activity('State Update Error', $this->session->userdata('id'), 'State: Update Error');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // State Masters delete function
    public function delete_state_master($id = null)
    {
        log_user_activity('State Masters Delete', $this->session->userdata('id'), 'Masters: State Masters: Delete');
        $id = $id ?? $this->input->post('id');

        $update_data = ['table_name' => 'states', 'update_data' => ['is_deleted' => 'yes'], 'condition' => ['id' => $id]];

        $delete = $this->common_model->update_data_limit($update_data);

        if ($delete) {
            $this->session->set_flashdata('message',
                '<p class="alert alert-success text-dark" style="margin:0px!important;">Deleted Successfully!</p>');
            log_user_activity('State Delete Success', $this->session->userdata('id'), 'State: Delete');
        } else {
            $this->session->set_flashdata('message',
                '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
            log_user_activity('State Delete Error', $this->session->userdata('id'), 'State: Delete Error');
        }

        redirect('state-master-list');
    }

    // State Masters List
    public function state_master_list()
    {
        log_user_activity('State Masters List',$this->session->userdata('id'), 'Masters: State Masters: List');
        $data['regions'] = $this->db->select('*')->from('states')->where('status !=', 'no')->where('is_deleted !=', 'yes')->order_by('id', 'DESC')->get()->result_array();
        $data['content'] = 'admin/state_master_list';
        $this->load->view('admin/layout', $data);
    }

    // City Masters
    public function city_master()
    {
        log_user_activity('City Masters Add',$this->session->userdata('id'), 'Masters: City Masters: Add');
        
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red" style="margin:0px">', '</p>');
        
        if($this->form_validation->run() == FALSE){
            $data['content'] = 'admin/city_master';
            $this->load->view('admin/layout', $data);
        } else {
            $existing_city = $this->db->where('state_id', $this->input->post('state_id'))
                                    ->where('name', $this->input->post('city'))
                                    ->where('is_deleted !=', 'yes')
                                    ->where('status !=', 'no')
                                    ->get('cities')
                                    ->row_array();
            if($existing_city){
                $this->session->set_flashdata('message', '<p class="alert alert-danger text-dark" style="margin:0px!important;">City already exists!</p>');
                log_user_activity('City Add Error',$this->session->userdata('id'), 'City: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $ins_data = ['state_id'=>$this->input->post('state_id'),'name'=>$this->input->post('city'),'status'=>'yes'];

            $insert = $this->common_model->insert_data(['table_name' => 'cities', 'insert_data' => $ins_data]);
            if($insert){
                $this->session->set_flashdata('message', '<p class="alert alert-success text-dark" style="margin:0px!important;">Added Successfully!</p>');
                log_user_activity('City Add New',$this->session->userdata('id'), 'City: Add New');
                redirect('city-master-list');
            }else{
                $this->session->set_flashdata('message', '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
                log_user_activity('Region Add Error',$this->session->userdata('id'), 'Region: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // City Masters
    public function city_master_list()
    {
        log_user_activity('City Masters List',$this->session->userdata('id'), 'Masters: City Masters: List');
        $data['regions'] = $this->db->select('*')->from('cities')->where('status !=', 'no')->where('is_deleted !=', 'yes')->order_by('id', 'DESC')->get()->result_array();
        $data['content'] = 'admin/city_master_list';
        $this->load->view('admin/layout', $data);
    }

    // City Masters edit function
    public function edit_city_master($id = null)
    {
        log_user_activity('City Masters Edit', $this->session->userdata('id'), 'Masters: City Masters: Edit');
        if (empty($id)) {
            show_404();
        }
        $id = $id ?? $this->input->post('id');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {

            // Fetch existing city
            $data['cities'] = $this->db
            ->where('id', $id)
            ->where('status !=', 'no')
            ->where('is_deleted !=', 'yes')
            ->get('cities')
            ->row_array();
            
            if (empty($data['cities'])) {
                show_404();
            }
       
            $data['content'] = 'admin/city_master_edit';
            $this->load->view('admin/layout', $data);
            
        } else {

            $update_data = [
                'state_id'   => $this->input->post('state_id'),
                'name'       => $this->input->post('city'),
                'status'     => $this->input->post('status') ?? 'yes'
            ];

            $update_data = ['table_name' => 'cities', 'update_data' => $update_data, 'condition' => ['id' => $id]];

            $update = $this->common_model->update_data_limit($update_data);

            if ($update) {
                $this->session->set_flashdata('message',
                    '<p class="alert alert-success text-dark" style="margin:0px!important;">Updated Successfully!</p>');
                log_user_activity('City Update Success', $this->session->userdata('id'), 'City: Update');
                redirect('city-master-list');
            } else {
                $this->session->set_flashdata('message',
                    '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
                log_user_activity('City Update Error', $this->session->userdata('id'), 'City: Update Error');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // City Masters delete function
    public function delete_city_master($id = null)
    {
        log_user_activity('City Masters Delete', $this->session->userdata('id'), 'Masters: City Masters: Delete');
        $id = $id ?? $this->input->post('id');

        $update_data = ['table_name' => 'cities', 'update_data' => ['is_deleted' => 'yes'], 'condition' => ['id' => $id]];

        $delete = $this->common_model->update_data_limit($update_data);

        if ($delete) {
            $this->session->set_flashdata('message',
                '<p class="alert alert-success text-dark" style="margin:0px!important;">Deleted Successfully!</p>');
            log_user_activity('City Delete Success', $this->session->userdata('id'), 'City: Delete');
        } else {
            $this->session->set_flashdata('message',
                '<p class="alert alert-danger text-dark" style="margin:0px!important;">Error! Please Try Again!</p>');
            log_user_activity('City Delete Error', $this->session->userdata('id'), 'City: Delete Error');
        }

        redirect('city-master-list');
    }

    // Get regions
    public function get_regions_ajax()
    {
        $postData = $this->input->post();
        $response = [];

        if (!empty($postData['search'])) {

            $this->db->select('MIN(id) AS id, name');
            $this->db->from('states');
            $this->db->like('name', $postData['search']);

            if (!empty($postData['country_id'])) {
                $this->db->where('country_id', $postData['country_id']);
            }

            $this->db->where('is_deleted', 'no');
            $this->db->where('status', 'yes');
            $this->db->group_by('name');
            $this->db->limit(10);

            $records = $this->db->get()->result();

            foreach ($records as $row) {
                $response[] = [
                    'state_id' => $row->id,
                    'label'    => $row->name
                ];
            }
        }

        echo json_encode($response);
        exit;
    }
    
    // Get transportation details
    public function get_transportation_by_country()
    {
        $country = $this->input->post('country');
        if ($country == '') {
            echo json_encode([]);
            return;
        }

        $this->db->select('id, vehicle_name');
        $this->db->from('transportation');
        $this->db->where('LOWER(country)', strtolower($country));
        $this->db->where('status', 'active');
        $query = $this->db->get()->result();

        echo json_encode($query);
    }

    // code start here for entrance child agewise price functionality
    public function save_child_age_price() 
    {
        $data = $this->input->post();
        
        // Basic validation
        if (!isset($data['from_age'], $data['to_age'], $data['price']) || $data['from_age'] == '' || $data['to_age'] == '' || $data['price'] == '') {
            echo json_encode(['status' => false, 'msg' => 'All fields are required.']);
            return;
        }
        
        $from_age = (int)$data['from_age'];
        $to_age   = (int)$data['to_age'];
        
        if ($from_age >= $to_age) {
            echo json_encode(['status' => false, 'msg' => 'From age must be less than to age.']);
            return;
        }
        
        // Check for overlapping active range for the same site and entrance
        $existing = $this->db->where([
            'site_id'     => $data['site_id'],
            'entrance_id' => $data['entrance_id'],
            'status'      => 1
        ])
        ->group_start()
            ->where('age_from <', $to_age)
            ->where('age_to >', $from_age)
        ->group_end()
        ->get('entrance_child_age_prices')
        ->num_rows();
        
        if ($existing > 0) {
            echo json_encode(['status' => false, 'msg' => 'An age range already exists that overlaps with the given range.']);
            return;
        }
        
        $insert = [
            'site_id'    => $data['site_id'],
            'entrance_id'=> $data['entrance_id'],
            'age_from'   => $from_age,
            'age_to'     => $to_age,
            'price'      => $data['price'],
            'status'     => 1
        ];
        $this->db->insert('entrance_child_age_prices', $insert);
        $entrance_id = $data['entrance_id'];

        $this->db->where([
            'id' => $entrance_id
        ])->update('site_entrance_costs', ['entrance_child_age' => 'yes']);
        echo json_encode(['status' => true]);
    }

    public function update_child_age_price() 
    {
        $id = $this->input->post('id');
        $from_age = (int)$this->input->post('from_age');
        $to_age   = (int)$this->input->post('to_age');
        $price    = $this->input->post('price');
        
        // Basic validation
        if ($from_age == '' || $to_age == '' || $price == '') {
            echo json_encode(['status' => false, 'msg' => 'All fields are required.']);
            return;
        }
        
        if ($from_age >= $to_age) {
            echo json_encode(['status' => false, 'msg' => 'From age must be less than to age.']);
            return;
        }
        
        // Get current record to know site_id and entrance_id
        $current = $this->db->where('id', $id)->get('entrance_child_age_prices')->row();
        if (!$current) {
            echo json_encode(['status' => false, 'msg' => 'Record not found.']);
            return;
        }
        
        // Check for overlapping with other active records (excluding this one)
        $existing = $this->db->where([
            'site_id'     => $current->site_id,
            'entrance_id' => $current->entrance_id,
            'status'      => 1
        ])
        ->where('id !=', $id)
        ->group_start()
            ->where('age_from <', $to_age)
            ->where('age_to >', $from_age)
        ->group_end()
        ->get('entrance_child_age_prices')
        ->num_rows();
        
        if ($existing > 0) {
            echo json_encode(['status' => false, 'msg' => 'Another active age range overlaps with the new range.']);
            return;
        }
        
        $update = [
            'age_from' => $from_age,
            'age_to'   => $to_age,
            'price'    => $price
        ];
        $this->db->where('id', $id)->update('entrance_child_age_prices', $update);
        echo json_encode(['status' => true]);
    }

    public function delete_child_age_price() 
    {
        $id = $this->input->post('id');

        // First get entrance_id before updating
        $row = $this->db->where('id', $id)
                        ->get('entrance_child_age_prices')
                        ->row();

        if (!$row) {
            echo json_encode(['status' => false, 'msg' => 'Record not found']);
            return;
        }

        $entrance_id = $row->entrance_id;

        // Soft delete (status = 0)
        $this->db->where('id', $id)
                ->update('entrance_child_age_prices', ['status' => 0]);

        // Check if any active records still exist
        $active_count = $this->db->where([
                'entrance_id' => $entrance_id,
                'status'      => 1
            ])
            ->count_all_results('entrance_child_age_prices');

        // If no active records → set to NO
        if ($active_count == 0) {
            $this->db->where('id', $entrance_id)
                    ->update('site_entrance_costs', ['entrance_child_age' => 'no']);
        }

        echo json_encode(['status' => true]);
    }

    public function get_child_age_prices() 
    {
        $site_id = $this->input->post('site_id');
        $entrance_id = $this->input->post('entrance_id');
        $prices = $this->db->where([
            'site_id' => $site_id,
            'entrance_id' => $entrance_id,
            'status' => 1
        ])->get('entrance_child_age_prices')->result();

        $html = '';
        foreach ($prices as $p) {
            $html .= '<tr>
                        <td>'.$p->age_from.'</td>
                        <td>'.$p->age_to.'</td>
                        <td>'.$p->price.'</td>
                        <td>
                            <button class="btn btn-sm btn-warning editAge" data-id="'.$p->id.'">Edit</button>
                            <button class="btn btn-sm btn-danger deleteAge" data-id="'.$p->id.'">Deactivate</button>
                        </td>
                    </tr>';
        }
        echo $html;
    }
    
    public function get_single_age_price() 
    {
        $id = $this->input->post('id');
        $price = $this->db->where('id', $id)->get('entrance_child_age_prices')->row();
        echo json_encode($price);
    }
    // code end here for entrance child agewise price functionality

    // code start here for activity child agewise price functionality
    public function save_child_age_price_activity() 
    {
        $data = $this->input->post();
        
        // Basic validation
        if (!isset($data['from_age'], $data['to_age'], $data['price']) || $data['from_age'] == '' || $data['to_age'] == '' || $data['price'] == '') {
            echo json_encode(['status' => false, 'msg' => 'All fields are required.']);
            return;
        }
        
        $from_age = (int)$data['from_age'];
        $to_age   = (int)$data['to_age'];
        
        if ($from_age >= $to_age) {
            echo json_encode(['status' => false, 'msg' => 'From age must be less than to age.']);
            return;
        }
        
        // Check for overlapping active range for the same site and entrance
        $existing = $this->db->where([
            'site_id'     => $data['site_id'],
            'activity_id' => $data['activity_id'],
            'status'      => 1
        ])
        ->group_start()
            ->where('age_from <', $to_age)
            ->where('age_to >', $from_age)
        ->group_end()
        ->get('activity_child_age_prices')
        ->num_rows();
        
        if ($existing > 0) {
            echo json_encode(['status' => false, 'msg' => 'An age range already exists that overlaps with the given range.']);
            return;
        }
        
        $insert = [
            'site_id'    => $data['site_id'],
            'activity_id'=> $data['activity_id'],
            'age_from'   => $from_age,
            'age_to'     => $to_age,
            'price'      => $data['price'],
            'status'     => 1
        ];
        $this->db->insert('activity_child_age_prices', $insert);
        $activity_id = $data['activity_id'];

        $this->db->where([
            'id' => $activity_id
        ])->update('site_activities_costs', ['activity_child_age' => 'yes']);
        echo json_encode(['status' => true]);
    }

    public function update_child_age_price_activity() 
    {
        $data = $this->input->post();
        $id = $this->input->post('id');
        $from_age = (int)$this->input->post('from_age');
        $to_age   = (int)$this->input->post('to_age');
        $price    = $this->input->post('price');
        
        // Basic validation
        if ($from_age == '' || $to_age == '' || $price == '') {
            echo json_encode(['status' => false, 'msg' => 'All fields are required.']);
            return;
        }
        
        if ($from_age >= $to_age) {
            echo json_encode(['status' => false, 'msg' => 'From age must be less than to age.']);
            return;
        }
        
        // Get current record to know site_id and entrance_id
        $current = $this->db->where('id', $id)->get('activity_child_age_prices')->row();
        if (!$current) {
            echo json_encode(['status' => false, 'msg' => 'Record not found.']);
            return;
        }
        
        // Check for overlapping with other active records (excluding this one)
        $existing = $this->db->where([
            'site_id'     => $data['site_id'],
            'activity_id' => $data['activity_id'], // ✅ FIXED
            'status'      => 1
        ])
        ->where('id !=', $id)
        ->group_start()
            ->where('age_from <', $to_age)
            ->where('age_to >', $from_age)
        ->group_end()
        ->get('activity_child_age_prices')
        ->num_rows();
        
        if ($existing > 0) {
            echo json_encode(['status' => false, 'msg' => 'Another active age range overlaps with the new range.']);
            return;
        }
        
        $update = [
            'age_from' => $from_age,
            'age_to'   => $to_age,
            'price'    => $price
        ];
        $this->db->where('id', $id)->update('activity_child_age_prices', $update);
        echo json_encode(['status' => true]);
    }

    public function delete_child_age_price_activity() 
    {
        $id = $this->input->post('id');

        // First get entrance_id before updating
        $row = $this->db->where('id', $id)
                        ->get('activity_child_age_prices')
                        ->row();

        if (!$row) {
            echo json_encode(['status' => false, 'msg' => 'Record not found']);
            return;
        }

        $entrance_id = $row->entrance_id;

        // Soft delete (status = 0)
        $this->db->where('id', $id)
                ->update('activity_child_age_prices', ['status' => 0]);

        // Check if any active records still exist
        $active_count = $this->db->where([
                'activity_id' => $entrance_id,
                'status'      => 1
            ])
            ->count_all_results('activity_child_age_prices');

        // If no active records → set to NO
        if ($active_count == 0) {
            $this->db->where('id', $entrance_id)
                    ->update('site_activities_costs', ['activity_child_age' => 'no']);
        }

        echo json_encode(['status' => true]);
    }

    public function get_child_age_prices_activity() 
    {
        $site_id = $this->input->post('site_id');
        $activity_id = $this->input->post('activity_id');
        $prices = $this->db->where([
            'site_id' => $site_id,
            'activity_id' => $activity_id,
            'status' => 1
        ])->get('activity_child_age_prices')->result();

        $html = '';
        foreach ($prices as $p) {
            $html .= '<tr>
                        <td>'.$p->age_from.'</td>
                        <td>'.$p->age_to.'</td>
                        <td>'.$p->price.'</td>
                        <td>
                            <button class="btn btn-sm btn-warning editAgeActivity" data-id="'.$p->id.'">Edit</button>
                            <button class="btn btn-sm btn-danger deleteAgeActivity" data-id="'.$p->id.'">Deactivate</button>
                        </td>
                    </tr>';
        }
        echo $html;
    }
    
    public function get_single_age_price_activity() 
    {
        $id = $this->input->post('id');
        $price = $this->db->where('id', $id)->get('activity_child_age_prices')->row();
        echo json_encode($price);
    }
    // code end here for activity child agewise price functionality

    // mandatory services child agewise price functionality start here
    public function save_mandatory_services_child_age_price()
    {
        $auxiliary_service_id = $this->input->post('auxiliary_service_id');
        $from_age          = $this->input->post('from_age');
        $to_age            = $this->input->post('to_age');
        $price             = $this->input->post('price');

        $data = [
            'agefrom'          => $from_age,
            'ageto'            => $to_age,
            'amount'             => $price,
            'auxiliary_service_id' => $auxiliary_service_id,
            'status'            => 'active'
        ];

        // Check overlap
        $this->db->where('auxiliary_service_id', $auxiliary_service_id);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->where('agefrom <=', $to_age);
        $this->db->where('ageto >=', $from_age);
        $this->db->group_end();

        $exists = $this->db->get('mandatory_services_child_age_cost')->row();

        if($exists){
            echo json_encode([
                'status'=>false,
                'msg'=>'Age range already exists or overlapping!'
            ]);
            return;
        }
        $this->db->insert('mandatory_services_child_age_cost', $data);

        $this->db->where('id',$auxiliary_service_id);
        $this->db->update('auxiliary_miscellaneous', ['with_age'=>'yes']);

        echo json_encode(['status'=>true]);
    }

    public function get_mandatory_services_single_age_price()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $data = $this->db->get('mandatory_services_child_age_cost')->row();
        echo json_encode($data);
    }

    public function get_mandatory_services_child_age_price()
    {
        $auxiliary_service_id = $this->input->post('auxiliary_service_id');

        $this->db->where('auxiliary_service_id',$auxiliary_service_id);
        $this->db->where('status','active');

        $records = $this->db->get('mandatory_services_child_age_cost')->result();

        foreach($records as $row){

            echo "<tr>

            <td>".$row->agefrom."</td>
            <td>".$row->ageto."</td>
            <td>".$row->amount."</td>

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

    public function update_mandatory_services_child_age_price()
    {
        $id      = $this->input->post('id');
        $from    = $this->input->post('from_age');
        $to      = $this->input->post('to_age');
        $price   = $this->input->post('price');

        $data = [
            'agefrom'=>$from,
            'ageto'=>$to,
            'amount'=>$price,
            'auxiliary_service_id' => $this->input->post('auxiliary_service_id'),
            'status' => 'active'
        ];

        $this->db->where('id !=', $id);
        $this->db->where('auxiliary_service_id', $this->input->post('auxiliary_service_id'));
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->where('agefrom <=', $to);
        $this->db->where('ageto >=', $from);
        $this->db->group_end();

        $exists = $this->db->get('mandatory_services_child_age_cost')->row();

        if($exists){
            echo json_encode([
                'status'=>false,
                'msg'=>'Age range overlap not allowed!'
            ]);
            return;
        }
        // print_r($data);
        $this->db->where('id',$id);
        $this->db->update('mandatory_services_child_age_cost',$data);

        $this->db->where('id',$this->input->post('auxiliary_service_id'));
        $this->db->update('auxiliary_miscellaneous', ['with_age'=>'yes']);
        echo json_encode(['status'=>true]);
    }

    private function update_auxiliary_with_age_status($auxiliary_service_id)
    {
        $has_active = $this->db->where('auxiliary_service_id', $auxiliary_service_id)
                            ->where('status', 'active')
                            ->count_all_results('mandatory_services_child_age_cost') > 0;

        $with_age = $has_active ? 'yes' : 'no';
        $this->db->where('id', $auxiliary_service_id)
                ->update('auxiliary_miscellaneous', ['with_age' => $with_age]);
    }

    public function delete_mandatory_services_child_age_price()
    {
        $id = $this->input->post('id');

        // Get auxiliary_service_id before update
        $row = $this->db->select('auxiliary_service_id')
                        ->where('id', $id)
                        ->get('mandatory_services_child_age_cost')
                        ->row();

        if ($row) {
            $this->db->where('id', $id);
            $this->db->update('mandatory_services_child_age_cost', ['status' => 'inactive']);

            // Update with_age flag based on remaining active rows
            $this->update_auxiliary_with_age_status($row->auxiliary_service_id);
        }

        echo json_encode(['status' => true]);
    }
    // mandatory services child agewise price functionality end here
    
}
