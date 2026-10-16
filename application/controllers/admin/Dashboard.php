<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Dashboard extends CI_Controller
    {

        var $locations = [
            'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
            'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
            'belarus' => ['FBZ', 'GBZ', 'IBZ'],
            'georgia' => ['FGE', 'GGE', 'IGE'],
            'armenia' => ['FAR','GAR','IAR'],
            'uzbekistan' => ['FUZ','GUZ','IUZ'],
            'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR', 'FUZ','GUZ','IUZ']
        ];
        
        
        var $locations_new = [
            'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
            'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
            'belarus' => ['FBZ', 'GBZ', 'IBZ'],
            'georgia' => ['FGE', 'GGE', 'IGE'],
            'armenia' => ['FAR','GAR','IAR'],
            'uzbekistan' => ['FUZ','GUZ','IUZ'],
            'combo' => ['CMB'],
            'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']
        ];

        public function __construct()
        {
            parent::__construct();
            if (!$this->session->userdata('email')) {
                redirect('login');
            }
            $this->load->model(['admin/dashboard_model', 'admin/quotation_model', 'common_model', 'admin/company_model']);
        }
        
        public function getBookingTypes()
        {
            $location = $this->input->post('location'); // CI3 input
            $codes = isset($this->locations[$location]) ? $this->locations[$location] : [];

            // Output JSON response
            echo json_encode($codes);
        }

        public function get_status_chart_data()
        {
            $year     = $this->input->get('year') ?? date('Y');
            $month    = $this->input->get('month');
            $quarter  = $this->input->get('quarter');
            $sales    = $this->input->get('sales');
            $country  = $this->input->get('country'); // only used to map locations
            $state    = $this->input->get('state');

            $locationMap = [
                'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                'georgia'    => ['FGE', 'GGE', 'IGE'],
                'armenia'    => ['FAR','GAR','IAR'],
                'uzbekistan' => ['FUZ','GUZ','IUZ'],
                'all'        => ['all']
            ];

            $enquiry_abbrs = $locationMap[strtolower($country)] ?? [];

            $counts = $this->dashboard_model->enquiry_status_for_sales_chart(
                $enquiry_abbrs, $year, $month, $quarter, $sales, $state
            );

            $statuses = ['confirm', 'in-progress', 'pending', 'cancel-at-arrival', 'not-materialized'];
            $data = [];

            foreach ($statuses as $status) {
                $data[$status] = isset($counts[$status]) ? $counts[$status] : 0;
            }

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'data' => $data,
                    'country' => strtoupper(substr($country, 0, 3)),
                    'sql' => $this->db->last_query() // for debugging
                ]));
        }


        // public function get_user_region()
        // {
        //     $search = $this->input->post('search');

        //     $query = $this->db->query("
        //         WITH RECURSIVE numbers AS (
        //             SELECT 1 AS n
        //             UNION ALL
        //             SELECT n + 1 FROM numbers WHERE n < 10
        //         )
        //         SELECT DISTINCT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(region, ',', n), ',', -1)) AS region
        //         FROM admin
        //         JOIN numbers ON CHAR_LENGTH(region) - CHAR_LENGTH(REPLACE(region, ',', '')) >= n - 1
        //         WHERE region IS NOT NULL AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(region, ',', n), ',', -1)) LIKE ?
        //         ORDER BY region
        //     ", ['%' . $search . '%']);

        //     $results = $query->result();
        //     $response = [];

        //     foreach ($results as $row) {
        //         $response[] = $row->region;
        //     }

        //     echo json_encode($response);
        // }


        public function get_user_region()
        {
            $search = $this->input->post('search');

            $query = $this->db->query("
                WITH RECURSIVE numbers AS (
                    SELECT 1 AS n
                    UNION ALL
                    SELECT n + 1 FROM numbers
                    WHERE n <= (
                        SELECT MAX(CHAR_LENGTH(region) - CHAR_LENGTH(REPLACE(region, ',', '')) + 1) 
                        FROM admin
                        WHERE region IS NOT NULL
                    )
                )
                SELECT DISTINCT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(region, ',', n), ',', -1)) AS region
                FROM admin
                JOIN numbers ON CHAR_LENGTH(region) - CHAR_LENGTH(REPLACE(region, ',', '')) + 1 >= n
                WHERE region IS NOT NULL
                AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(region, ',', n), ',', -1)) LIKE ?
                ORDER BY region
            ", ['%' . $search . '%']);

            $results = $query->result();
            $response = [];

            foreach ($results as $row) {
                $response[] = $row->region;
            }

            echo json_encode($response);
        }

        
        // public function get_sales_by_region()
        // {
        //     $regionInput = $this->input->post('region');
        //     $selectedRegions = array_map('trim', explode(',', $regionInput));

        //     $this->db->select('id, name, region');
        //     $this->db->from('admin');
        //     $this->db->where_in('type', [5, 6]);
        //     $this->db->where('status !=', 0);
        //     $this->db->where('status !=', 2);
        //     $query = $this->db->get();
        //     $allSalesUsers = $query->result_array();

        //     $filteredUsers = [];

        //     foreach ($allSalesUsers as $user) {
        //         $userRegions = array_map('trim', explode(',', $user['region']));
        //         foreach ($selectedRegions as $selectedRegion) {
        //             if (in_array($selectedRegion, $userRegions)) {
        //                 $filteredUsers[] = [
        //                     'id' => $user['id'],
        //                     'name' => $user['name']
        //                 ];
        //                 break; // Stop checking once we find a match
        //             }
        //         }
        //     }

        //     echo json_encode($filteredUsers);
        // }
        
        // public function get_loggedin_user_regions()
        // {
        //     $search = $this->input->post('search');
        //     $loggedInUserId = $this->session->userdata('id');
        //     $loggedInUserType = $this->session->userdata('type');

        //     if (!in_array($loggedInUserType, [5, 6])) {
        //         echo json_encode([]);
        //         return;
        //     }

        //     // Fetch region string for this user
        //     $this->db->select('region');
        //     $this->db->from('admin');
        //     $this->db->where('id', $loggedInUserId);
        //     $user = $this->db->get()->row();

        //     if (!$user || !$user->region) {
        //         echo json_encode([]);
        //         return;
        //     }

        //     // Split regions and filter based on search
        //     $regions = array_filter(array_map('trim', explode(',', $user->region)));
        //     $filteredRegions = [];

        //     foreach ($regions as $region) {
        //         if (stripos($region, $search) !== false) {
        //             $filteredRegions[] = $region;
        //         }
        //     }

        //     echo json_encode(array_values(array_unique($filteredRegions)));
        // }
        
        public function get_loggedin_user_regions()
        {
            $search = $this->input->post('search');
            $loggedInUserId = $this->session->userdata('id');
            $loggedInUserType = $this->session->userdata('type');

            if (!in_array($loggedInUserType, [5, 6])) {
                echo json_encode([]);
                return;
            }

            // Fetch regions for all users of same type (5 or 6)
            $this->db->select('region');
            $this->db->from('admin');
            $this->db->where('type', $loggedInUserType);
            $this->db->where('region IS NOT NULL');
            $query = $this->db->get();
            $results = $query->result();

            $allRegions = [];

            foreach ($results as $row) {
                $regions = array_filter(array_map('trim', explode(',', $row->region)));
                foreach ($regions as $region) {
                    if (stripos($region, $search) !== false) {
                        $allRegions[] = $region;
                    }
                }
            }

            echo json_encode(array_values(array_unique($allRegions)));
        }

        public function get_sales_by_region()
        {
            $regionInput = $this->input->post('region');
            $selectedRegions = array_map('trim', explode(',', $regionInput));

            $loggedInUserId = $this->session->userdata('id');
            $loggedInUserType = $this->session->userdata('type');

            $this->db->select('id, name, region, type');
            $this->db->from('admin');
            $this->db->where_in('type', [5, 6]);
            $this->db->where('status =', 1);

            // Type-based filter logic
            if ($loggedInUserType == 5 || $loggedInUserType == 6) {
                $this->db->where('type', $loggedInUserType); // Only same type users
            } elseif ($loggedInUserType != 1) {
                // Block others except type 1 (admin)
                echo json_encode([]);
                return;
            }

            $query = $this->db->get();
            $allUsers = $query->result_array();

            $filteredUsers = [];

            foreach ($allUsers as $user) {
                $userRegions = array_map('trim', explode(',', $user['region']));
                foreach ($selectedRegions as $selectedRegion) {
                    if (in_array($selectedRegion, $userRegions)) {
                        $filteredUsers[] = [
                            'id' => $user['id'],
                            'name' => $user['name']
                        ];
                        break;
                    }
                }
            }

            echo json_encode($filteredUsers);
        }

        public function index()
        {
            log_user_activity('Dashboard View', $this->session->userdata('id'), 'Dashboard: View');
            $where = '1=1';
            // Enquiry & Arrival counts
            $data['counts'] = $this->dashboard_model->enquiry_status_count();
            $data['admin_counts'] = $this->dashboard_model->admin_enquiry_status_count();
            $user_type = $this->session->userdata('type'); 
            $email = $this->session->userdata('email');
             $fullMasterAccess = in_array($email, [
                'optimax@kazindmc.com',
                'anuj.accounts@kazindmc.com'
            ]);
            if(in_array($user_type, ['1','4']) || $fullMasterAccess){
                $data['enquiry_status'] = $this->dashboard_model->count_total_enquiry_status_all($where);
                $data['arrivals_status'] = $this->dashboard_model->count_total_arrival_status_all($where);
            }else if (in_array($user_type, ['2','3','5'])) {
                $data['enquiry_status'] = $this->dashboard_model->count_total_enquiry_status($where);
                $data['arrivals_status'] = $this->dashboard_model->count_total_arrival_status($where);
            }else if(in_array($user_type, ['6'])){
                $data['enquiry_status'] = $this->dashboard_model->count_total_enquiry_status_by_abbr($where);
                $data['arrivals_status'] = $this->dashboard_model->count_total_arrival_status_by_abbr($where);
            }
            // Arrival status formatting
            $arrival_year = $total_arrival = $Complete_arrival = $File_closed = $arrival_cancel = $in_progress = [];

            foreach ($data['arrivals_status'] as $status) {
                $arrival_year[] = $status['year'];
                $total_arrival[] = $status['total'];
                $Complete_arrival[] = $status['complete'];
                $File_closed[] = $status['file_closed_count'];
                $arrival_cancel[] = $status['cancel_count'];
                $in_progress[] = $status['in_progress'];
            }

            $data['arrival_year'] = json_encode($arrival_year);
            $data['total_arrival'] = json_encode($total_arrival);
            $data['Complete_arrival'] = json_encode($Complete_arrival);
            $data['File_closed'] = json_encode($File_closed);
            $data['arrival_cancel'] = json_encode($arrival_cancel);
            $data['in_progress'] = json_encode($in_progress);

            // Enquiry status formatting
            $years = $totalData = $confirmData = $inProgressData = $notMaterializedData = $pendingData = [];

            foreach ($data['enquiry_status'] as $status) {
                $years[] = $status['year'];
                $totalData[] = $status['total'];
                $confirmData[] = $status['confirm_count'];
                $inProgressData[] = $status['in_progress_count'];
                $notMaterializedData[] = $status['not_materialized_count'];
                $pendingData[] = $status['pending_count'];
            }

            $data['years'] = json_encode($years);
            $data['totalData'] = json_encode($totalData);
            $data['confirmData'] = json_encode($confirmData);
            $data['inProgressData'] = json_encode($inProgressData);
            $data['notMaterializedData'] = json_encode($notMaterializedData);
            $data['pendingData'] = json_encode($pendingData);
            $select = 'admin.*';
            $where = 'type = "5" AND status !=0 AND status !=2';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            $selected_location = $this->input->get('location');
            $select = 'admin.*, admin.location';
            $where = 'type = "2" AND status !=0 AND status !=2';
            $data['all_user'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            $select = 'admin.*';
            $where = 'type = "6" AND status =1';
            $data['international_sales'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);

            $data['queries'] = $this->query_reminder();
            $data['email_queries'] = $this->email_exchange_reminder();
            // Final view load
            $data['location'] = $this->locations;
            $data['locations'] = $this->locations_new;
            $data['content'] = 'admin/dashboard';
            $this->load->view('admin/layout', $data);
        }
        

        public function get_users_by_booking_type()
        {
            $booking_type = $this->input->get('booking_type');
            $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
            $this->db->from('admin');
            $this->db->join('hod_detail', 'hod_detail.user_id = admin.id', 'left');
            $this->db->where('admin.status !=', '0');
            $this->db->where('admin.id !=', 61);

            if($booking_type == 'CMB'){
                $this->db->where('admin.combo_access', 'yes');
            }else{
                $this->db->where("(
                    (
                        admin.hod = 'yes'
                        AND hod_detail.status != 'delete'
                        AND (
                            (hod_detail.booking_type IS NOT NULL AND hod_detail.booking_type != '' AND FIND_IN_SET('{$booking_type}', hod_detail.booking_type))
                            OR
                            (admin.booking_type IS NOT NULL AND admin.booking_type != '' AND FIND_IN_SET('{$booking_type}', admin.booking_type))
                        )
                    )
                    OR
                    (
                        admin.hod != 'yes'
                        AND admin.booking_type IS NOT NULL 
                        AND admin.booking_type != '' 
                        AND FIND_IN_SET('{$booking_type}', admin.booking_type)
                    )
                )", null, false);
            }
        
            $this->db->order_by('admin.hod', 'DESC');
            $users = $this->db->get()->result_array();
            echo json_encode(['status' => 'success', 'data' => $users]);
        }


        // before 28 april 2026
        // public function get_users_by_booking_type_filtered()
        // {
        //     $booking_type = $this->input->get('booking_type');
        //     $location = $this->input->get('location');
        //     $user_id = $this->session->userdata('id');
        //     $login_type = $this->session->userdata('type');

        //     $response = ['status' => 'error', 'users' => []];

        //     if ($login_type == 2 && $booking_type) {
        //         $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

        //         if ($admin) {
        //             $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
        //             $this->db->from('admin');
        //             $this->db->join('hod_detail', "hod_detail.user_id = admin.id AND hod_detail.status != 'delete'", 'left');

        //             // Only include active admins (status not 0 and not 2)
        //             $this->db->where('admin.status !=', '0');
        //             $this->db->where('admin.status !=', '2');
        //             $this->db->where('admin.id !=', 61);

        //             $this->db->where("(
        //                 (admin.hod = 'yes' AND FIND_IN_SET('{$booking_type}', hod_detail.booking_type) 
        //                     AND hod_detail.booking_type IS NOT NULL 
        //                     AND hod_detail.booking_type != '')
        //                 OR
        //                 (admin.hod != 'yes' AND FIND_IN_SET('{$booking_type}', admin.booking_type) 
        //                     AND admin.booking_type IS NOT NULL 
        //                     AND admin.booking_type != '')
        //                 OR
        //                 (admin.hod = 'yes' AND admin.id = '{$user_id}')
        //             )", null, false);

        //             $users = $this->db->get()->result_array();

        //             $response = [
        //                 'status' => 'success',
        //                 'users' => $users,
        //                 'logged_in_user_id' => $user_id
        //             ];
        //         }
        //     }

        //     echo json_encode($response);
        // }
        
        // updated 28 april 2026
        public function get_users_by_booking_type_filtered()
        {
            $booking_type = $this->input->get('booking_type');
            $location = $this->input->get('location');
            $user_id = $this->session->userdata('id');
            $login_type = $this->session->userdata('type');

            $response = ['status' => 'error', 'users' => []];

            if ($login_type == 2 && $booking_type) {
                $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();
                $combo_access = $admin['combo_access'] ?? 'no';

                if ($admin) {
                    // NEW: If logged-in admin is HOD and has combo_access = 'yes',
                    // return all active admins with combo_access = 'yes' (ignore booking_type)
                    if ($admin['hod'] == 'yes' && $combo_access == 'yes') {
                        $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
                        $this->db->from('admin');
                        $this->db->join('hod_detail', "hod_detail.user_id = admin.id AND hod_detail.status != 'delete'", 'left');
                        $this->db->where('admin.status !=', '0');
                        $this->db->where('admin.status !=', '2');
                        $this->db->where('admin.id !=', 61);
                        $this->db->where('admin.combo_access', 'yes');   // only combo_access users

                        $users = $this->db->get()->result_array();

                        $response = [
                            'status' => 'success',
                            'users' => $users,
                            'logged_in_user_id' => $user_id
                        ];
                    } 
                    // Existing logic for non‑combo_access HOD or non‑HOD admins
                    else {
                        $this->db->select('admin.id, admin.name, admin.hod, admin.booking_type, admin.status, hod_detail.booking_type AS hod_booking_type');
                        $this->db->from('admin');
                        $this->db->join('hod_detail', "hod_detail.user_id = admin.id AND hod_detail.status != 'delete'", 'left');

                        $this->db->where('admin.status !=', '0');
                        $this->db->where('admin.status !=', '2');
                        $this->db->where('admin.id !=', 61);

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
            }

            echo json_encode($response);
        }

        // before 28 april 2026 code
        // public function get_booking_data_for_hod_user()
        // {
        //     $location = $this->input->get('location');
        //     $booking_type = $this->input->get('booking_type'); // may be empty
        //     $user_id = $this->session->userdata('id');
        //     $login_type = $this->session->userdata('type');

        //     $response = [
        //         'status' => 'error',
        //         'message' => 'Invalid request',
        //         'booking_type_options' => [],
        //         'selected_booking_type' => '',
        //         'users' => []
        //     ];

        //     $location_map = [
        //         'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        //         'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        //         'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
        //         'georgia'    => ['FGE', 'GGE', 'IGE'],
        //         'armenia'    => ['FAR','GAR','IAR'],
        //         'uzbekistan' => ['FUZ','GUZ','IUZ'],
        //         'combo'      => ['CMB']
        //     ];

        //     if ($login_type == 2 && $location) {
        //         $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

        //         if ($admin) {
                        
        //             if ($location === 'combo') {

        //                 // Directly set booking type to CMB
        //                 $booking_type = 'CMB';

        //                 // Fetch all users with booking_type containing CMB
        //                 $this->db->select('id, name, hod');
        //                 $this->db->from('admin');
        //                 $this->db->where('status !=', '0');
        //                 $this->db->where('status !=', '2');
        //                 $this->db->where("FIND_IN_SET('CMB', booking_type) >", 0, false);
        //                 $users = $this->db->get()->result_array();

        //                 // Ensure logged-in user included
        //                 if (!in_array($user_id, array_column($users, 'id'))) {
        //                     $users[] = [
        //                         'id' => $admin['id'],
        //                         'name' => $admin['name'],
        //                         'hod' => $admin['hod']
        //                     ];
        //                 }

        //                 $response = [
        //                     'status' => 'success',
        //                     'selected_booking_type' => 'CMB',
        //                     'booking_type_options' => ['CMB'],
        //                     'users' => $users,
        //                     'logged_in_user_id' => $user_id
        //                 ];

        //                 echo json_encode($response);
        //                 return;
        //             }
                    
        //             $location_types = $location_map[$location] ?? [];

        //             $admin_booking_types = !empty($admin['booking_type']) ? explode(',', $admin['booking_type']) : [];
        //             $matched_booking_types = [];

        //             if ($admin['hod'] === 'yes') {
        //                 $hod_detail = $this->db->get_where('hod_detail', [
        //                     'user_id' => $user_id,
        //                     'status !=' => 'delete'
        //                 ])->row_array();

        //                 $hod_booking_types = !empty($hod_detail['booking_type']) ? explode(',', $hod_detail['booking_type']) : [];

        //                 $all_booking_types = array_unique(array_merge($admin_booking_types, $hod_booking_types));

        //                 // Match booking types for selected location
        //                 $matched_booking_types = array_intersect($all_booking_types, $location_types);
        //             } else {
        //                 $matched_booking_types = array_intersect($admin_booking_types, $location_types);
        //             }

        //             if (!empty($matched_booking_types)) {
        //                 // If no booking_type passed, pick first matched
        //                 if (empty($booking_type)) {
        //                     $booking_type = reset($matched_booking_types);
        //                 }

        //                 // Now fetch users having this booking type
        //                 $this->db->select('id, name, hod');
        //                 $this->db->from('admin');
        //                 $this->db->where('status !=', '0');
        //                 $this->db->where('status !=', '2');
        //                 $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0, false);
        //                 $users = $this->db->get()->result_array();

        //                 // Ensure HOD in result
        //                 if (!in_array($user_id, array_column($users, 'id'))) {
        //                     $users[] = [
        //                         'id' => $admin['id'],
        //                         'name' => $admin['name'],
        //                         'hod' => $admin['hod']
        //                     ];
        //                 }

        //                 $response = [
        //                     'status' => 'success',
        //                     'selected_booking_type' => $booking_type,
        //                     'booking_type_options' => array_values($matched_booking_types),
        //                     'users' => $users,
        //                     'logged_in_user_id' => $user_id
        //                 ];
        //             } else {
        //                 $response['message'] = 'No matching booking types for this location.';
        //             }
        //         } else {
        //             $response['message'] = 'Invalid admin record.';
        //         }
        //     }

        //     echo json_encode($response);
        // }
        
        // updated 28 april 2026 code with CMB
        public function get_booking_data_for_hod_user()
        {
            $location = $this->input->get('location');
            $booking_type = $this->input->get('booking_type'); 
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
                'combo'      => ['CMB']
            ];

            if ($login_type == 2 && $location) {
                $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

                if ($admin) {
                        
                    if ($location === 'combo') {
                        // For combo location, set booking type to CMB (for display)
                        $booking_type = 'CMB';

                        // NEW LOGIC:
                        // If HOD + combo_access = yes → return all combo_access users
                        // Otherwise (non-HOD or HOD without combo_access) → return only the logged-in user
                        if ($admin['hod'] == 'yes' && ($admin['combo_access'] ?? 'no') == 'yes') {
                            $this->db->select('id, name, hod, combo_access');
                            $this->db->from('admin');
                            $this->db->where('status !=', '0');
                            $this->db->where('id !=', '61');
                            $this->db->where('status !=', '2');
                            $this->db->where('combo_access', 'yes');
                            $users = $this->db->get()->result_array();
                        } else {
                            // Non-HOD with combo_access (or HOD without combo_access) sees only themselves
                            $users = [[
                                'id' => $admin['id'],
                                'name' => $admin['name'],
                                'hod' => $admin['hod'],
                                'combo_access' => $admin['combo_access'] ?? 'no'
                            ]];
                        }

                        // Ensure logged-in user is included (already true in both cases)
                        // No need to add again because in the first case he's already in the list,
                        // in the second case it's only him.

                        $response = [
                            'status' => 'success',
                            'selected_booking_type' => 'CMB',
                            'booking_type_options' => ['CMB'],
                            'users' => $users,
                            'logged_in_user_id' => $user_id
                        ];

                        echo json_encode($response);
                        return;
                    }
                    
                    // ---------- Non‑combo locations (unchanged) ----------
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

                        $matched_booking_types = array_intersect($all_booking_types, $location_types);
                    } else {
                        $matched_booking_types = array_intersect($admin_booking_types, $location_types);
                    }

                    if (!empty($matched_booking_types)) {
                        if (empty($booking_type)) {
                            $booking_type = reset($matched_booking_types);
                        }

                        $this->db->select('id, name, hod');
                        $this->db->from('admin');
                        $this->db->where('status !=', '0');
                        $this->db->where('status !=', '2');
                        $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0, false);
                        $users = $this->db->get()->result_array();

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

        private function build_common_filters($sales_id, $quarter, $state, $company_id)
        {
            $filter = '';
    
            if (!empty($sales_id)) {
                $filter .= ' AND enquiry.sales_admin_id = ' . (int)$sales_id;
            }
            if (!empty($quarter)) {
                $quarter_dates = explode('_', $quarter);
                if (count($quarter_dates) == 2) {
                    $start_date = $this->db->escape_str($quarter_dates[0]);
                    $end_date   = $this->db->escape_str($quarter_dates[1]);
                    $filter .= " AND DATE(enquiry.check_in_date) BETWEEN '$start_date' AND '$end_date'";
                }
            }
            if (!empty($state)) {
                $state = strtolower(urldecode($state));
                $arr = array_map('trim', explode(',', $state));
                $arr = array_filter($arr);
                $safe_states = array_map([$this->db, 'escape'], $arr);
                $filter .= ' AND LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
            }
            if (!empty($company_id)) {
                $company_id = $this->db->escape_str($company_id);
                $filter .= " AND enquiry.company_id = '$company_id'";
            }
            return $filter;
        }
     
        public function get_company_billing_data()
        {
            $sales_id   = $this->input->get('sales');
            $quarter    = $this->input->get('quarter');
            $state      = $this->input->get('state');
            $company_id = $this->input->get('company_id');
            $country    = $this->input->get('country'); 
    
            $whereBase = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
    
            $locations = [
                'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                'georgia'    => ['FGE', 'GGE', 'IGE'],
                'armenia'    => ['FAR','GAR','IAR'],
                'uzbekistan' => ['FUZ','GUZ','IUZ']
            ];
    
            $country_totals = [];
    
            // Common filters
            $common_filter = $this->build_common_filters($sales_id, $quarter, $state, $company_id);
    
            if ($country === 'all') {
                foreach ($locations as $country_name => $abbrs) {
                    $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
                    $where = "$whereBase AND enquiry.enquiry_abbr IN ($abbr_clause) $common_filter";
    
                    $query = "
                        SELECT IF(arrivals.currency = 'dollar', SUM(arrivals.client_billing), 0) AS total_billing
                        FROM enquiry
                        LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                        LEFT JOIN company ON enquiry.company_id = company.company_id
                        LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id
                        WHERE $where
                    ";
    
                    $row = $this->db->query($query)->row();
                    $total = $row && $row->total_billing !== null ? floatval($row->total_billing) : 0;
                    $country_totals[$country_name] = $total;
                }
    
                $all_abbrs = "'" . implode("','", array_merge(...array_values($locations))) . "'";
                $where = "$whereBase AND enquiry.enquiry_abbr IN ($all_abbrs) $common_filter";
    
            } else {
                $abbrs = $locations[$country] ?? [];
                $abbr_clause = "'" . implode("','", array_map([$this->db, 'escape_str'], $abbrs)) . "'";
                $where = "$whereBase AND enquiry.enquiry_abbr IN ($abbr_clause) $common_filter";
            }
    
            $query = "
                SELECT 
                    company.name AS company_name,
                    SUM(IF(arrivals.currency = 'dollar', arrivals.client_billing, 0)) AS total_billing,
                    COUNT(enquiry.id) AS file_cnt
                FROM enquiry
                LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                LEFT JOIN company ON enquiry.company_id = company.company_id
                LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id
                WHERE $where
                GROUP BY enquiry.company_id
            ";
    
            $result = $this->db->query($query)->result_array();
    
            $labels   = array_column($result, 'company_name');
            $data     = array_column($result, 'total_billing');
            $file_cnt = array_column($result, 'file_cnt');
    
            echo json_encode([
                'labels'         => $labels,
                'data'           => $data,
                'file'           => $file_cnt,
                'country_totals' => $country_totals,
                'debug_sql'      => $this->db->last_query()
            ]);
        }

        public function get_company_billing_groupbar_data()
        {
            $location     = $this->input->get('location');
            $bookingType  = $this->input->get('bookingType');
            $year         = $this->input->get('year') ?? date('Y');
            $quarter      = $this->input->get('quarter');
            $stateFilter  = $this->input->get('state');
            $city         = $this->input->get('city');
            $countryInput = $this->input->get('country');

            $selectedCountries = array_filter(array_map('trim', explode(',', strtolower(urldecode($countryInput ?? '')))));
            $selectedStates    = array_filter(array_map('trim', explode(',', strtolower(urldecode($stateFilter ?? '')))));
            $selectedCities    = array_filter(array_map('trim', explode(',', strtolower(urldecode($city ?? '')))));

            $groupByCity  = !empty($selectedCities);
            $groupByState = !$groupByCity && !empty($selectedStates);

            $locations = $this->locations;

            $abbrToLocation = [];
            foreach ($locations as $loc => $abbrs) {
                if ($loc === 'all') continue;
                foreach ($abbrs as $abbr) {
                    $abbrToLocation[$abbr] = ucfirst($loc);
                }
            }

            $selected_abbrs = $locations[$location] ?? $locations['all'];
            $in_clause = implode('","', array_map([$this->db, 'escape_str'], $selected_abbrs));
            $where = "enquiry.enquiry_abbr IN (\"$in_clause\")";
            
            // Type filter
            if (!empty($bookingType)) {
                $type = $this->db->escape($bookingType);
                $where .= " AND enquiry.enquiry_abbr = $type";
            }

            if (!empty($year)) {
                $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
            }

            if (!empty($quarter)) {
                $quarter_dates = explode('_', $quarter);
                if (count($quarter_dates) == 2) {
                    $start_date = $this->db->escape_str($quarter_dates[0]);
                    $end_date   = $this->db->escape_str($quarter_dates[1]);
                    $where .= " AND (DATE(enquiry.check_in_date) >= '$start_date' AND DATE(enquiry.check_in_date) <= '$end_date')";
                }
            }

            if (!empty($selectedStates)) {
                $safe_states = array_map([$this->db, 'escape'], $selectedStates);
                $where .= ' AND LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
            }

            if (!empty($selectedCities)) {
                $safe_cities = array_map([$this->db, 'escape'], $selectedCities);
                $where .= ' AND LOWER(company_details.city) IN (' . implode(',', $safe_cities) . ')';
            }

            // Revenue + file counts query
            $query = "
                SELECT 
                    enquiry.enquiry_abbr,
                    LOWER(company_details.country) AS country,
                    LOWER(company_details.state) AS state,
                    LOWER(company_details.city) AS city,
                    COUNT(DISTINCT enquiry.enquiry_no) AS total_files,
                    COUNT(DISTINCT CASE WHEN enquiry.status = 'confirm' THEN enquiry.enquiry_no END) AS confirmed_files,
                    SUM(CASE 
                        WHEN arrivals.status IN ('complete', 'file-closed', 'in-progress') AND arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END) AS total_revenue
                FROM enquiry
                LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                LEFT JOIN company ON enquiry.company_id = company.company_id
                LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id
                WHERE $where
                GROUP BY enquiry.enquiry_abbr, country, state, city
                ORDER BY country, enquiry.enquiry_abbr
            ";

            $results = $this->db->query($query)->result_array();

            // Group data for chart display
            $groupData = [];
            $overallTotal = 0;
            $allKeys = [];
            $country_summary = [];

            foreach ($results as $row) {
                $abbr     = $row['enquiry_abbr'];
                $location = $abbrToLocation[$abbr] ?? 'Unknown';

                $groupKeyRaw = $groupByCity ? $row['city'] : ($groupByState ? $row['state'] : $row['country']);
                $groupKey    = strtolower($groupKeyRaw ?? '');
                $label       = ucfirst($groupKey);

                $isSelected = $groupByCity ? in_array($groupKey, $selectedCities) :
                            ($groupByState ? in_array($groupKey, $selectedStates) : in_array($groupKey, $selectedCountries));

                $subGroupLabel = $isSelected ? $label : 'Others';

                if (!isset($groupData[$location])) $groupData[$location] = [];

                if (!isset($groupData[$location][$subGroupLabel])) {
                    $groupData[$location][$subGroupLabel] = [
                        'amount' => 0, 
                        'file_count' => 0, 
                        'confirmed_count' => 0
                    ];
                }

                $groupData[$location][$subGroupLabel]['amount']          += floatval($row['total_revenue']);
                $groupData[$location][$subGroupLabel]['file_count']      += intval($row['total_files']);
                $groupData[$location][$subGroupLabel]['confirmed_count'] += intval($row['confirmed_files']);
                $overallTotal += floatval($row['total_revenue']);

                // Track country-level summary
                $countryKey = strtolower($location);
                if (!isset($country_summary[$countryKey])) {
                    $country_summary[$countryKey] = ['total' => 0, 'confirmed' => 0];
                }
                $country_summary[$countryKey]['total'] += intval($row['total_files']);
                $country_summary[$countryKey]['confirmed'] += intval($row['confirmed_files']);
            }

            // Final formatting
            $finalData = [];
            foreach ($groupData as $location => $subGroups) {
                $entry = ['location' => $location];
                $locationTotal = array_sum(array_column($subGroups, 'amount'));

                foreach ($subGroups as $label => $stats) {
                    $percentage = $locationTotal > 0 ? round(($stats['amount'] / $locationTotal) * 100, 2) : 0;
                    $entry[$label] = $stats + ['percentage' => $percentage];
                    if (!in_array($label, $allKeys)) $allKeys[] = $label;
                }

                $countryKey = strtolower($location);
                $entry['total_file_count']     = $country_summary[$countryKey]['total'] ?? 0;
                $entry['confirmed_file_count'] = $country_summary[$countryKey]['confirmed'] ?? 0;

                $finalData[] = $entry;
            }

            $keysToSend = ($groupByCity || $groupByState) 
                ? array_filter($allKeys, fn($k) => $k !== 'Others') 
                : $allKeys;

            echo json_encode([
                'chart_data'      => $finalData,
                'country_keys'    => $keysToSend,
                'total_sum'       => round($overallTotal, 2),
                'country_summary' => $country_summary
            ]);
        }
        
         // 11 dec 2025 updated
        public function get_kazin_guest_split($enquiry_abbrs = [], $type = '', $user_id = '', $month = '', $year = '', $quarter = '')
        {
            // Check if this is for CMB files
            $is_combo_location = !empty($enquiry_abbrs) && count($enquiry_abbrs) === 1 && in_array('CMB', $enquiry_abbrs);
            $is_cmb_query = ($type == 'CMB' || $is_combo_location);
            
            if ($is_cmb_query) {
                
                // CMB files – improved query (aggregates per enquiry)
                // ------------------------------------------------------------
                $where_user = '';
                if (!empty($user_id)) {
                    $where_user = "e.file_handle_by = " . (int)$user_id;
                } else {
                    $where_user = "e.file_handle_by != 61";
                }
        
                // Build date filters to be applied on effective_checkin
                $date_conditions = [];
                if (!empty($year)) {
                    $date_conditions[] = "YEAR(effective_checkin) = '" . $this->db->escape_str($year) . "'";
                }
                if (!empty($month)) {
                    $date_conditions[] = "MONTH(effective_checkin) = '" . $this->db->escape_str($month) . "'";
                }
                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $date_conditions[] = "effective_checkin BETWEEN '$start' AND '$end'";
                    }
                }
                $date_where = !empty($date_conditions) ? 'AND ' . implode(' AND ', $date_conditions) : '';
        
                $sql = "
                    WITH enquiry_combo_base AS (
                        SELECT
                            e.id AS enquiry_id,
                            COALESCE(
                                MIN(ahd.checkin_date),
                                MIN(ce.check_in_date),
                                e.check_in_date
                            ) AS effective_checkin,
                            MAX(
                                CASE
                                    WHEN EXISTS (
                                        SELECT 1
                                        FROM arrival_room_details ard
                                        JOIN arrival_hotel_details ahd2 ON ard.arrival_hotel_details_id = ahd2.id
                                        JOIN arrivals a2 ON ahd2.arrival_id = a2.id
                                        WHERE a2.enquiry_id = e.id
                                          AND a2.combo_enquiry_id = ce.id
                                    ) THEN 1
                                    ELSE 0
                                END
                            ) AS booked_by_kazin
                        FROM enquiry e
                        LEFT JOIN arrivals a ON a.enquiry_id = e.id
                        LEFT JOIN combo_enquiry ce ON ce.id = a.combo_enquiry_id
                        LEFT JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
                        WHERE e.is_deleted = 0
                          AND LOWER(e.status) = 'confirm'
                          AND e.company_id NOT IN ('656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2')
                          AND e.enquiry_no LIKE '%CMB%'
                          AND $where_user
                        GROUP BY e.id
                    )
                    SELECT
                        CASE
                            WHEN booked_by_kazin = 1 THEN 'Booked_By_Kazin'
                            ELSE 'Booked_Directly_By_Guest'
                        END AS booking_type,
                        COUNT(DISTINCT enquiry_id) AS total
                    FROM enquiry_combo_base
                    WHERE 1=1
                        $date_where
                    GROUP BY booking_type
                ";
            } else {
                // Non-CMB files - original logic
                $where = 'e.is_deleted = 0 AND LOWER(e.status) = "confirm"';
                $where .= " AND e.company_id NOT IN ('656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2')";
                
                if (!empty($enquiry_abbrs)) {
                    $escaped = array_map([$this->db, 'escape'], $enquiry_abbrs);
                    $where .= ' AND e.enquiry_abbr IN (' . implode(',', $escaped) . ')';
                }
                
                if (!empty($type) && $type != 'all') {
                    $type = $this->db->escape($type);
                    $where .= " AND e.enquiry_abbr = $type";
                }
                
                if (!empty($user_id)) {
                    $where .= " AND e.file_handle_by = " . (int)$user_id;
                } else {
                    $where .= " AND (e.file_handle_by IS NULL OR e.file_handle_by != 61)";
                }
                
                if (!empty($year)) {
                    $where .= ' AND YEAR(e.check_in_date) = "' . $year . '"';
                }
                
                // Month filter
                if (!empty($month)) {
                    $where .= ' AND MONTH(e.check_in_date) = "' . $month . '"';
                } 
                
                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $where .= " AND DATE(e.check_in_date) >= '$start' AND DATE(e.check_in_date) <= '$end'";
                    }
                }
                
                $sql = "
                    WITH enquiry_earliest_checkin AS (
                        SELECT
                            e.id AS enquiry_id,
                            COALESCE(
                                (
                                    SELECT MIN(ahd.checkin_date)
                                    FROM arrivals a
                                    JOIN arrival_hotel_details ahd ON ahd.arrival_id = a.id
                                    WHERE a.enquiry_id = e.id
                                        AND YEAR(ahd.checkin_date) = YEAR(e.check_in_date)
                                ),
                                e.check_in_date
                            ) AS earliest_effective_checkin,
                            CASE
                                WHEN EXISTS (
                                    SELECT 1
                                    FROM arrival_room_details ard
                                    JOIN arrival_hotel_details ahd ON ard.arrival_hotel_details_id = ahd.id
                                    JOIN arrivals a ON ahd.arrival_id = a.id
                                    WHERE a.enquiry_id = e.id
                                ) OR EXISTS (
                                    SELECT 1
                                    FROM arrival_room_details ard2
                                    WHERE ard2.enquiry_id = e.id
                                )
                                THEN 1 ELSE 0
                            END AS booked_by_kazin
                        FROM enquiry e
                        WHERE $where
                    )
                    SELECT
                        CASE 
                            WHEN booked_by_kazin = 1 THEN 'Booked_By_Kazin' 
                            ELSE 'Booked_Directly_By_Guest' 
                        END AS booking_type,
                        COUNT(DISTINCT enquiry_id) AS total
                    FROM enquiry_earliest_checkin
                    GROUP BY booking_type
                ";
            }
            
            $query = $this->db->query($sql);
            
            $result = ['Booked_By_Kazin' => 0, 'Booked_Directly_By_Guest' => 0];
            foreach ($query->result_array() as $row) {
                $result[$row['booking_type']] = (int)$row['total'];
            }
            
            return $result;
        }
        
        // 11-11-2025
        private function calculate_billing($enquiry_abbrs, $type, $user_id, $month, $year, $quarter)
        {
            $where = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
            $where .= " AND enquiry.company_id NOT IN ('656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2')";

            $join = 'LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
                    LEFT JOIN company ON enquiry.company_id = company.company_id
                    LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id';

            // Check if this is for CMB files
            $is_combo_location = !empty($enquiry_abbrs) && count($enquiry_abbrs) === 1 && in_array('CMB', $enquiry_abbrs);
            $is_cmb_query = ($type == 'CMB' || $is_combo_location);

            if ($is_cmb_query) {
                // For CMB files - use different JOIN and WHERE conditions
                $join .= ' INNER JOIN combo_enquiry ce ON ce.id = arrivals.combo_enquiry_id';
                $where .= " AND enquiry.enquiry_no LIKE '%CMB%'";

                // Year filter based on combo_enquiry table
                if (!empty($year)) {
                    $where .= " AND YEAR(ce.check_in_date) = '" . $year . "'";
                }
                
                // Month filter based on same MIN date
                if (!empty($month)) {
                    $where .= ' AND MONTH(ce.check_in_date) = "' . $month . '"';
                } 

                // Quarter filter based on combo_enquiry table
                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $where .= " AND ce.check_in_date BETWEEN '$start' AND '$end'";
                    }
                }
            } else {
                // Original non-CMB logic...
                if (!empty($enquiry_abbrs)) {
                    $escapedAbbrs = array_map([$this->db, 'escape'], $enquiry_abbrs);
                    $where .= ' AND enquiry.enquiry_abbr IN (' . implode(',', $escapedAbbrs) . ')';
                }

                if (!empty($type) && $type != 'all') {
                    $escapedType = $this->db->escape($type);
                    $where .= " AND enquiry.enquiry_abbr = $escapedType";
                }

                if (!empty($year)) {
                    $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
                }
                
                if (!empty($month)) {
                    $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
                }

                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $where .= ' AND (date(enquiry.check_in_date) >= "' . $start . '" AND date(enquiry.check_in_date) <= "' . $end . '")';
                    }
                }
            }

            // Apply user filter
            if (!empty($user_id)) {
                $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
            } else {
                $where .= " AND enquiry.file_handle_by != 61";
            }

            $query = $this->db->query("
                SELECT SUM(CASE WHEN arrivals.currency = 'dollar' THEN arrivals.client_billing ELSE 0 END) AS total_billing
                FROM enquiry
                $join
                WHERE $where
            ");

            return ($query && $query->num_rows()) ? floatval($query->row()->total_billing) : 0;
        }
        
        // 11-11-2025
        public function get_teamwise_revenue()
        {
            $user_id  = $this->input->get('user');
            $quarter  = $this->input->get('quarter');
            $type     = urldecode($this->input->get('type'));
            $country  = $this->input->get('country');
            $year     = $this->input->get('year') ?? date('Y');
            $month    = $this->input->get('month');

            $locationMap = $this->locations;
            $enquiry_abbrs = $locationMap[$country] ?? [];

            // Check if country is 'combo' - then we need to handle differently
            $is_combo_country = ($country == 'combo');
            
            $statuses = ['confirm', 'in-progress', 'pending', 'not-materialized', 'cancel-at-arrival'];
            $labels   = ['Confirm', 'In Progress', 'Pending', 'Not Materialized', 'Cancel at Arrival'];

            // Adjust previous quarter
            $previous_quarter = null;
            if (!empty($quarter)) {
                $dates = explode('_', $quarter);
                if (count($dates) === 2) {
                    $previous_quarter = date('Y-m-d', strtotime($dates[0] . ' -1 year')) . '_' . date('Y-m-d', strtotime($dates[1] . ' -1 year'));
                }
            }

            // Determine the type parameter for model
            $model_type = null;
            if ($type === 'CMB' || $is_combo_country) {
                $model_type = 'CMB';
            } elseif (!empty($type) && $type !== 'all') {
                $model_type = $type;
            }

            // Fetch status counts
            if ($country == 'all') {
                $current_counts = $this->dashboard_model->enquiry_status_for_teamwise_chart([], $model_type, $month, $quarter, $user_id, $year);
                $previous_counts = $this->dashboard_model->enquiry_status_for_teamwise_chart([], $model_type, $month, $previous_quarter, $user_id, $year - 1);
            } else {
                $current_counts = $this->dashboard_model->enquiry_status_for_teamwise_chart($enquiry_abbrs, $model_type, $month, $quarter, $user_id, $year);
                $previous_counts = $this->dashboard_model->enquiry_status_for_teamwise_chart($enquiry_abbrs, $model_type, $month, $previous_quarter, $user_id, $year - 1);
            }

            // ... rest of your existing code remains the same ...
            $current_counts1  = $current_counts['main'] ?? [];
            $previous_counts1 = $previous_counts['main'] ?? [];

            $excluded_current_counts = $current_counts['excluded'] ?? [];

            // Format data
            $data = [];
            $prevdata = [];
            $status_change = [];

            foreach ($statuses as $status) {
                $current = isset($current_counts1[$status]) ? (int)$current_counts1[$status] : 0;
                $prev = isset($previous_counts1[$status]) ? (int)$previous_counts1[$status] : 0;

                $data[] = $current;
                $prevdata[] = $prev;

                // Calculate % change
                if ($prev == 0) {
                    if ($current == 0) {
                        $change = 0;
                    } else {
                        $change = 100;
                    }
                } else {
                    $change = (($current - $prev) / $prev) * 100;
                }

                $status_change[] = [
                    'status' => $status,
                    'current' => $current,
                    'previous' => $prev,
                    'percentage_change' => round($change, 2),
                    'direction' => $change >= 0 ? 'increase' : 'decrease',
                    'color' => $change >= 0 ? 'green' : 'red',
                    'icon' => $change >= 0 ? '⬆' : '⬇'
                ];
            }

            // Revenue
            // $total_billing = $this->calculate_billing($enquiry_abbrs, $type, $user_id, $year, $quarter);
            // $previous_year_billing = $this->calculate_billing($enquiry_abbrs, $type, $user_id, $year - 1, $previous_quarter);

            if ($is_combo_country) {
                // Force CMB calculation for combo country
                $total_billing = $this->calculate_billing(['CMB'], 'CMB', $user_id, $month, $year, $quarter);
                $previous_year_billing = $this->calculate_billing(['CMB'], 'CMB', $user_id, $month, $year - 1, $previous_quarter);
                $bookingStatusCount = $this->get_kazin_guest_split(['CMB'], 'CMB', $user_id, $month, $year, $quarter);
            } else {
                // Normal calculation for other countries
                $total_billing = $this->calculate_billing($enquiry_abbrs, $type, $user_id, $month, $year, $quarter);
                $previous_year_billing = $this->calculate_billing($enquiry_abbrs, $type, $user_id, $month, $year - 1, $previous_quarter);
                $bookingStatusCount = $this->get_kazin_guest_split($enquiry_abbrs, $type, $user_id, $month, $year, $quarter);
            }

            // Revenue Change
            if ($previous_year_billing == 0) {
                $revenue_change = $total_billing == 0 ? 0 : 100;
            } else {
                $revenue_change = (($total_billing - $previous_year_billing) / $previous_year_billing) * 100;
            }

            $revenue_comparison = [
                'current' => round($total_billing, 2),
                'previous' => round($previous_year_billing, 2),
                'percentage_change' => round($revenue_change, 2),
                'direction' => $revenue_change >= 0 ? 'increase' : 'decrease',
                'color' => $revenue_change >= 0 ? 'green' : 'red',
                'icon' => $revenue_change >= 0 ? '⬆' : '⬇'
            ];

            // $bookingStatusCount = $this->get_kazin_guest_split($enquiry_abbrs, $type, $user_id, $year, $quarter);
            // $previous_year_billings = $this->get_kazin_guest_split($enquiry_abbrs, $type, $user_id, $year - 1, $previous_quarter);

            $BookedByKazinTotal = $bookingStatusCount['Booked_By_Kazin'];
            $BookedByGuestTotal = $bookingStatusCount['Booked_Directly_By_Guest'];

            $totalConfirmCount = $current_counts1['confirm'] ?? 0;
            
            $BookingByKazin = $totalConfirmCount > 0
                ? round(($bookingStatusCount['Booked_By_Kazin'] / $totalConfirmCount) * 100, 0)
                : 0;

            $BookingByGuest = $totalConfirmCount > 0
                ? round(($bookingStatusCount['Booked_Directly_By_Guest'] / $totalConfirmCount) * 100, 0)
                : 0;

            // $num_persons = $this->get_total_persons($enquiry_abbrs, $type, $user_id, $year, $quarter);

            if ($is_combo_country) {
                $num_persons = $this->get_total_persons(['CMB'], 'CMB', $user_id, $month, $year, $quarter);
            }else{
                $num_persons = $this->get_total_persons($enquiry_abbrs, $type, $user_id, $month, $year, $quarter);
            }
                
            // Return
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'labels'                 => $labels,
                    'data'                   => $data,
                    'prevdata'               => $prevdata,
                    'total_revenue'          => round($total_billing, 2),
                    'status_comparison'      => $status_change,
                    'revenue_comparison'     => $revenue_comparison,
                    'booking_status'         => $totalConfirmCount,
                    'booking_by_kazin'       => $BookingByKazin,
                    'booking_by_guest'       => $BookingByGuest,
                    'booking_by_kazin_total' => $BookedByKazinTotal,
                    'booking_by_guest_total' => $BookedByGuestTotal,
                    'num_persons'            => (int)$num_persons,
                    'excluded_company_data'  => $excluded_current_counts,
                ]));
        }

        // 11-11-2025
        private function get_total_persons($locations, $type, $user_id, $month, $year, $quarter)
        {
            $where = 'enquiry.is_deleted = 0 AND arrivals.status IN("complete","file-closed","in-progress")';
            $where .= " AND enquiry.company_id NOT IN ('656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2')";

            // Check if this is for CMB files
            $is_combo_location = !empty($locations) && count($locations) === 1 && in_array('CMB', $locations);
            $is_cmb_query = ($type == 'CMB' || $is_combo_location);

            if ($is_cmb_query) {
                // For CMB files - use combo_enquiry table for person count
                $where .= " AND enquiry.enquiry_no LIKE '%CMB%'";

                // Year filter based on combo_enquiry table
                if (!empty($year)) {
                    $where .= " AND YEAR(combo_enquiry.check_in_date) = '" . $year . "'";
                }
                
                // Month filter based on same MIN date
                if (!empty($month)) {
                    $where .= ' AND MONTH(combo_enquiry.check_in_date) = "' . $month . '"';
                } 

                // Quarter filter based on combo_enquiry table
                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $where .= " AND combo_enquiry.check_in_date BETWEEN '$start' AND '$end'";
                    }
                }
                
                if (!empty($user_id)) {
                    $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
                } else {
                    $where .= " AND enquiry.file_handle_by != 61";
                }

                $query = $this->db->query("
                    SELECT SUM(
                        COALESCE(combo_enquiry.no_of_person, 0) + COALESCE(combo_enquiry.no_of_child, 0)
                    ) AS total_persons
                    FROM enquiry
                    INNER JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                    INNER JOIN combo_enquiry ON combo_enquiry.id = arrivals.combo_enquiry_id
                    WHERE $where
                ");
            } else {
                // Non-CMB files - original logic
                if (!empty($locations)) {
                    $safe_locations = array_map([$this->db, 'escape_str'], $locations);
                    $in = '"' . implode('","', $safe_locations) . '"';
                    $where .= " AND enquiry.enquiry_abbr IN ($in)";
                }

                if (!empty($type) && $type != 'all') {
                    $type = $this->db->escape($type);
                    $where .= " AND enquiry.enquiry_abbr = $type";
                }

                if (!empty($year)) {
                    $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
                }
                
                // Month filter based on same MIN date
                if (!empty($month)) {
                    $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
                } 

                if (!empty($quarter)) {
                    $dates = explode('_', $quarter);
                    if (count($dates) === 2) {
                        $start = $this->db->escape_str($dates[0]);
                        $end   = $this->db->escape_str($dates[1]);
                        $where .= " AND DATE(enquiry.check_in_date) >= '$start' AND DATE(enquiry.check_in_date) <= '$end'";
                    }
                }
                
                // Apply user filter (common for both)
                if (!empty($user_id)) {
                    $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
                } else {
                    $where .= " AND enquiry.file_handle_by != 61";
                }

                $query = $this->db->query("
                    SELECT SUM(
                        CASE 
                            WHEN arrivals.split_number != 0 
                            THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
                            ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
                        END
                    ) AS total_persons
                    FROM enquiry
                    LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                    WHERE $where
                ");
            }


            return ($query && $query->row()) ? (int)$query->row()->total_persons : 0;
        }

        public function counts_data()
        {
            $query = 'SELECT count(arrivals.id) as cnt FROM arrivals JOIN enquiry ON enquiry.id=arrivals.enquiry_id WHERE arrivals.status="in-progress" AND date(arrivals.created) = "' . date('Y-m-d') . '"';
            // $query ='
            // SELECT COUNT(arrivals.id) AS cnt, enquiry.enquiry_abbr FROM arrivals 
            // JOIN enquiry ON enquiry.id = arrivals.enquiry_id 
            // WHERE arrivals.status = "in-progress" AND DATE(arrivals.created) >= "2024-11-15"';

            if ($this->session->userdata('admin_type') != 'superadmin') {
                $session_locations = explode(',', $this->session->userdata('locations'));
                $all_locations = [];
                foreach ($session_locations as $loc) {
                    if (isset($this->locations[$loc])) {
                        $all_locations = array_merge($all_locations, $this->locations[$loc]);
                    }
                }
                $assigned_loc = implode('","', $all_locations);
                // $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
                $query .= ' AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
            }
            $result = $this->common_model->custom_query($query);
            $count = $result[0]->cnt;
            echo json_encode(['response' => 's', 'data' => $count]);
        }
        
        // 10-11-2025
        public function admin_counts_data()
        {
            $query = '
                SELECT 
                    COUNT(a.id) AS cnt,
                    CASE 
                        WHEN a.combo_enquiry_id IS NOT NULL THEN ce.enquiry_abbr
                        ELSE e.enquiry_abbr
                    END AS enquiry_abbr
                FROM arrivals a
                LEFT JOIN enquiry e ON e.id = a.enquiry_id
                LEFT JOIN combo_enquiry ce ON ce.id = a.combo_enquiry_id
                WHERE a.status = "in-progress"
                AND DATE(a.created) = "' . date('Y-m-d') . '"
                GROUP BY CASE 
                    WHEN a.combo_enquiry_id IS NOT NULL THEN ce.enquiry_abbr
                    ELSE e.enquiry_abbr
                END
            ';

            $count = $this->common_model->custom_query($query);

            $countryMapping = [
                'AZ' => 'Azerbaijan',
                'GE' => 'Georgia',
                'BZ' => 'Belarus',
                'KZ' => 'Kazakhstan',
                'AR' => 'Armenia',
                'UZ' => 'Uzbekistan'
            ];

            $result = [];

            // Initialize result with all countries (count = 0)
            foreach ($countryMapping as $key => $country) {
                $result[$country] = ['country' => $country, 'count' => 0];
            }

            if (!empty($count)) {
                foreach ($count as $row) {
                    // Extract the 2-letter country code (middle chars of enquiry_abbr)
                    $middleChar = substr($row->enquiry_abbr, 1, 2);
                    $country = isset($countryMapping[$middleChar]) ? $countryMapping[$middleChar] : 'Unknown';

                    // Increment the count
                    if (isset($result[$country])) {
                        $result[$country]['count'] += $row->cnt;
                    } else {
                        $result[$country] = ['country' => $country, 'count' => $row->cnt];
                    }
                }
            }
            $result = array_values($result);
            echo json_encode(['response' => 's', 'data' => $result]);
        }

        public function pdf_preview()
        {
            $this->load->view('admin/mail_pdf_preview');
        }

        public function masters()
        {
            log_user_activity('Masters View',$this->session->userdata('id'), 'Masters: View');

            $counts = $this->dashboard_model->enquiry_status_count();
            $data['counts'] = $counts;
            $data['content'] = 'admin/masters';
            $this->load->view('admin/layout', $data);
        }
        
        // 29 dec 2025 old
        // public function query_reminder()
        // {
        //   $logged_user = $this->session->userdata('id');
        //   $logged_type = $this->session->userdata('type');
        //   $logged_email = $this->session->userdata('email');
        //   $where = 'enquiry.is_deleted = 0';
        //   if($logged_type == '2' && $logged_email !== 'optimax@kazindmc.com'){
        //       $where .= " AND enquiry.file_handle_by = '" . $logged_user . "'";
        //   }
        //     $sql = "
        //         SELECT 
        //             SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
        //             SUM(
        //                 CASE 
        //                     WHEN status = 'in-progress' 
        //                         AND check_in_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                     THEN 1 ELSE 0 
        //                 END
        //             ) AS inprogress_count
        //         FROM enquiry
        //         WHERE $where
        //     ";

        //     log_user_activity('Query reminder',$this->session->userdata('id'), 'query_reminder: query_reminder');

        //     $result = $this->common_model->custom_query($sql);
        //     return $result;
        // }
        
        // 29 dec 2025 old
        // public function query_reminder()
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     // Base condition
        //     $where = "enquiry.is_deleted = 0";

        //     // Login type restriction
        //     if (
        //         $logged_type == '2' &&
        //         !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //     ) {
        //         $where .= " AND enquiry.file_handle_by = '{$logged_user}'";
        //     }

        //     /* =====================================================
        //     REGION FILTER FOR TYPE = 5
        //     ====================================================== */
        //     if ($logged_type == '5' || $logged_type == '6') {

        //         $admin = $this->db
        //             ->select('region')
        //             ->where('id', $logged_user)
        //             ->get('admin')
        //             ->row();

        //         if (!empty($admin->region)) {

        //             $regions = array_map(
        //                 'strtolower',
        //                 array_map('trim', explode(',', $admin->region))
        //             );

        //             $region_list = "'" . implode("','", $regions) . "'";

        //             $where .= "
        //                 AND (
        //                     LOWER(cd.state) IN ($region_list)
        //                     OR LOWER(cd.country) IN ($region_list)
        //                 )
        //             ";
        //         }
        //     }

        //     /* =====================================================
        //     MAIN QUERY
        //     ====================================================== */
        //     $sql = "
        //         SELECT 
        //             SUM(CASE WHEN enquiry.status = 'pending' AND YEAR(enquiry.check_in_date) = 2026 THEN 1 ELSE 0 END) AS pending_count,

        //             SUM(
        //                 CASE 
        //                     WHEN enquiry.status = 'in-progress'
        //                         AND enquiry.check_in_date BETWEEN CURDATE() 
        //                         AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                     THEN 1 ELSE 0 
        //                 END
        //             ) AS inprogress_count

        //         FROM enquiry

        //         LEFT JOIN company_details cd 
        //             ON cd.company_id = enquiry.company_details_id

        //         WHERE $where
        //     ";

        //     log_user_activity(
        //         'Query reminder',
        //         $logged_user,
        //         'query_reminder: query_reminder'
        //     );

        //     return $this->common_model->custom_query($sql);
        // }
        
        // 05-feb-2026
        // public function query_reminder()
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     // Base condition
        //     $where = "enquiry.is_deleted = 0";

        //     // Login type restriction
        //     if($logged_user == '95'){
        //         $sql = "SELECT 
        //             COUNT(DISTINCT CASE 
        //                 WHEN enquiry.status = 'pending' 
        //                 THEN enquiry.id 
        //             END) AS pending_count,
                    
        //             COUNT(DISTINCT CASE 
        //                 WHEN enquiry.status = 'in-progress' 
        //                 AND enquiry.enquiry_no LIKE 'CMB%'
        //                 THEN enquiry.id 
        //             END) AS inprogress_count

        //         FROM enquiry

        //         WHERE enquiry.is_deleted = 0
        //         AND enquiry.file_handle_by = 95";

        //     }else{
        //         if (
        //             $logged_type == '2' &&
        //             !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //         ) {
        //             $where .= " AND enquiry.file_handle_by = '{$logged_user}'";
        //         }

        //         /* =====================================================
        //         REGION FILTER FOR TYPE = 5
        //         ====================================================== */
        //         if ($logged_type == '5' || $logged_type == '6') {

        //             $admin = $this->db
        //                 ->select('region')
        //                 ->where('id', $logged_user)
        //                 ->get('admin')
        //                 ->row();

        //             if (!empty($admin->region)) {

        //                 $regions = array_map(
        //                     'strtolower',
        //                     array_map('trim', explode(',', $admin->region))
        //                 );

        //                 $region_list = "'" . implode("','", $regions) . "'";

        //                 $where .= "
        //                     AND (
        //                         LOWER(cd.state) IN ($region_list)
        //                         OR LOWER(cd.country) IN ($region_list)
        //                     )
        //                 ";
        //             }
        //         }

        //         /* =====================================================
        //         MAIN QUERY
        //         ====================================================== */
        //         $sql = "
        //             SELECT 
        //                 SUM(CASE WHEN enquiry.status = 'pending' AND YEAR(enquiry.check_in_date) = 2026 THEN 1 ELSE 0 END) AS pending_count,

        //                 SUM(
        //                     CASE 
        //                         WHEN enquiry.status = 'in-progress'
        //                             AND enquiry.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                         THEN 1 ELSE 0 
        //                     END
        //                 ) AS inprogress_count

        //             FROM enquiry

        //             LEFT JOIN company_details cd 
        //                 ON cd.company_id = enquiry.company_details_id

        //             WHERE $where
        //         ";
        //     }
            
        //     log_user_activity(
        //         'Query reminder',
        //         $logged_user,
        //         'query_reminder: query_reminder'
        //     );

        //     return $this->common_model->custom_query($sql);
        // }
        
        // updated 15 april 2026
        // public function query_reminder()
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     $admin = $this->db->select('combo_access, hod')
        //                 ->where('id', $logged_user)
        //                 ->get('admin')
        //                 ->row();

        //     $combo_access = $admin->combo_access ?? 'no';
        //     $is_hod       = ($admin->hod ?? 'no') == 'yes';

        //     $where = "enquiry.is_deleted = 0";

        //     // ---------- ADMIN (type 1) : see ALL pending & in-progress (both CMB and non-CMB) ----------
        //     if ($logged_type == '1') {
        //         $sql = "
        //             SELECT 
        //                 SUM(CASE WHEN enquiry.status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
        //                 SUM(
        //                     CASE 
        //                         WHEN enquiry.status = 'in-progress'
        //                             AND enquiry.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                         THEN 1 ELSE 0 
        //                     END
        //                 ) AS inprogress_count
        //             FROM enquiry
        //             WHERE $where
        //         ";
        //     }
        //     // ---------- COMBO ACCESS USERS : only CMB files, with file_handle_by restrictions ----------
        //     elseif ($combo_access == 'yes') {
        //         if ($is_hod) {
        //             $subquery = $this->db->select('id')
        //                                 ->from('admin')
        //                                 ->where('combo_access', 'yes')
        //                                 ->where('status !=', '0')
        //                                 ->where('id !=', '61')
        //                                 ->where('status !=', '2')
        //                                 ->get_compiled_select();
        //             $file_handle_condition = "enquiry.file_handle_by IN ($subquery)";
        //         } else {
        //             $file_handle_condition = "enquiry.file_handle_by = $logged_user";
        //         }

        //         $sql = "
        //             SELECT 
        //                 COUNT(DISTINCT CASE 
        //                     WHEN enquiry.status = 'pending' 
        //                     AND enquiry.enquiry_no LIKE 'CMB%'
        //                     THEN enquiry.id 
        //                 END) AS pending_count,
                        
        //                 COUNT(DISTINCT CASE 
        //                     WHEN enquiry.status = 'in-progress' 
        //                     AND enquiry.enquiry_no LIKE 'CMB%'
        //                     THEN enquiry.id 
        //                 END) AS inprogress_count
        //             FROM enquiry
        //             WHERE enquiry.is_deleted = 0
        //             AND $file_handle_condition
        //         ";
        //     }
        //     // ---------- OTHER USERS (type 2,5,6, etc.) with region & date filters ----------
        //     else {
        //         // Type 6: only enquiries with enquiry_abbr starting with 'I'
        //         if ($logged_type == '6') {
        //             $where .= " AND enquiry.enquiry_abbr LIKE 'I%'";
        //         }

        //         // Type 2 restriction (except specific emails)
        //         if ($logged_type == '2' &&
        //             !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //         ) {
        //             $where .= " AND enquiry.file_handle_by = '{$logged_user}'";
        //         }

        //         // Region filter for type 5 or 6
        //         if ($logged_type == '5' || $logged_type == '6') {
        //             $admin_region = $this->db->select('region')
        //                                     ->where('id', $logged_user)
        //                                     ->get('admin')
        //                                     ->row();
        //             if (!empty($admin_region->region)) {
        //                 $regions = array_map('strtolower', array_map('trim', explode(',', $admin_region->region)));
        //                 $region_list = "'" . implode("','", $regions) . "'";
        //                 $where .= "
        //                     AND (
        //                         LOWER(cd.state) IN ($region_list)
        //                         OR LOWER(cd.country) IN ($region_list)
        //                     )
        //                 ";
        //             }
        //         }

        //         // Main query for non‑admin, non‑combo users (with date restrictions)
        //         $sql = "
        //             SELECT 
        //                 SUM(CASE WHEN enquiry.status = 'pending' AND YEAR(enquiry.check_in_date) = 2026 THEN 1 ELSE 0 END) AS pending_count,
        //                 SUM(
        //                     CASE 
        //                         WHEN enquiry.status = 'in-progress'
        //                             AND enquiry.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                         THEN 1 ELSE 0 
        //                     END
        //                 ) AS inprogress_count
        //             FROM enquiry
        //             LEFT JOIN company_details cd ON cd.company_id = enquiry.company_details_id
        //             WHERE $where
        //         ";
        //     }

        //     log_user_activity('Query reminder', $logged_user, 'query_reminder: query_reminder');
        //     return $this->common_model->custom_query($sql);
        // }
        
        
        // 29 dec 2025 old
        // email exchange hot and super-hot query reminder
        // public function email_exchange_reminder()
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     // Base where condition
        //     $where = "e.is_deleted = 0";

        //     // Login type restriction (same logic as query_reminder)
        //     if (
        //         $logged_type == '2' &&
        //         !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //     ) {
        //         $where .= " AND e.file_handle_by = '{$logged_user}'";
        //     }

        //     $sql = "
        //         SELECT 
        //             SUM(
        //                 CASE 
        //                     WHEN e.status = 'in-progress'
        //                         AND f_sum.total_email_exchange BETWEEN 3 AND 6
        //                     THEN 1 ELSE 0
        //                 END
        //             ) AS hot_count,

        //             SUM(
        //                 CASE 
        //                     WHEN e.status = 'in-progress'
        //                         AND f_sum.total_email_exchange >= 7
        //                     THEN 1 ELSE 0
        //                 END
        //             ) AS superhot_count

        //         FROM enquiry e

        //         LEFT JOIN (
        //             SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
        //             FROM followups
        //             GROUP BY enquiry_id
        //         ) f_sum ON f_sum.enquiry_id = e.id

        //         WHERE $where
        //     ";

        //     log_user_activity(
        //         'Email Exchange Reminder',
        //         $logged_user,
        //         'email_exchange_reminder: email_exchange_reminder'
        //     );

        //     return $this->common_model->custom_query($sql);
        // }
        
        // 29 dec 2025 old
        // public function email_exchange_reminder() 
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     // Base where condition
        //     $where = "e.is_deleted = 0";

        //     // Login type restriction
        //     if (
        //         $logged_type == '2' &&
        //         !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //     ) {
        //         $where .= " AND e.file_handle_by = '{$logged_user}'";
        //     }

        //     if ($logged_type == '5' || $logged_type == '6') {
        //         // Fetch logged-in user's region
        //         $admin = $this->db
        //             ->select('region')
        //             ->where('id', $logged_user)
        //             ->get('admin')
        //             ->row();

        //         $this->session->set_userdata('region', $admin->region);

        //         if (!empty($admin->region)) {

        //             // Convert to lowercase array
        //             $regions = array_map(
        //                 'strtolower',
        //                 array_map('trim', explode(',', $admin->region))
        //             );

        //             // Escape values for SQL
        //             $region_list = "'" . implode("','", $regions) . "'";

        //             // Apply dynamic condition
        //             $where .= "
        //                 AND (
        //                     LOWER(cd.state) IN ($region_list)
        //                     OR LOWER(cd.country) IN ($region_list)
        //                 )
        //             ";
        //         }

        //     }

        //     $sql = "
        //         SELECT 
        //             SUM(
        //                 CASE 
        //                     WHEN e.status = 'in-progress'
        //                         AND f_sum.total_email_exchange BETWEEN 3 AND 6
        //                     THEN 1 ELSE 0
        //                 END
        //             ) AS hot_count,

        //             SUM(
        //                 CASE 
        //                     WHEN e.status = 'in-progress'
        //                         AND f_sum.total_email_exchange >= 7
        //                     THEN 1 ELSE 0
        //                 END
        //             ) AS superhot_count

        //         FROM enquiry e

        //         LEFT JOIN company_details cd 
        //             ON cd.company_id = e.company_details_id

        //         LEFT JOIN (
        //             SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
        //             FROM followups
        //             GROUP BY enquiry_id
        //         ) f_sum 
        //             ON f_sum.enquiry_id = e.id

        //         WHERE $where
        //         AND e.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //     ";

        //     log_user_activity(
        //         'Email Exchange Reminder',
        //         $logged_user,
        //         'email_exchange_reminder: email_exchange_reminder'
        //     );

        //     return $this->common_model->custom_query($sql);
        // }
        
        // before 28-april-2026 updated
        // public function email_exchange_reminder() 
        // {
        //     $logged_user  = $this->session->userdata('id');
        //     $logged_type  = $this->session->userdata('type');
        //     $logged_email = $this->session->userdata('email');

        //     // Check if user is ID 95
        //     if($logged_user == '95'){
        //         $sql = "SELECT 
        //                     SUM(
        //                         CASE 
        //                             WHEN enquiry.status = 'in-progress'
        //                                 AND enquiry.enquiry_no LIKE 'CMB%'
        //                                 AND f_sum.total_email_exchange BETWEEN 3 AND 6
        //                             THEN 1 ELSE 0
        //                         END
        //                     ) AS hot_count,

        //                     SUM(
        //                         CASE 
        //                             WHEN enquiry.status = 'in-progress'
        //                                 AND enquiry.enquiry_no LIKE 'CMB%'
        //                                 AND f_sum.total_email_exchange >= 7
        //                             THEN 1 ELSE 0
        //                         END
        //                     ) AS superhot_count

        //                 FROM enquiry

        //                 LEFT JOIN (
        //                     SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
        //                     FROM followups
        //                     GROUP BY enquiry_id
        //                 ) f_sum 
        //                     ON f_sum.enquiry_id = enquiry.id

        //                 WHERE enquiry.is_deleted = 0
        //                 AND enquiry.file_handle_by = 95";
        //     } else {
        //         // Base where condition
        //         $where = "e.is_deleted = 0";

        //         // Login type restriction
        //         if (
        //             $logged_type == '2' &&
        //             !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
        //         ) {
        //             $where .= " AND e.file_handle_by = '{$logged_user}'";
        //         }

        //         if ($logged_type == '5' || $logged_type == '6') {
        //             // Fetch logged-in user's region
        //             $admin = $this->db
        //                 ->select('region')
        //                 ->where('id', $logged_user)
        //                 ->get('admin')
        //                 ->row();

        //             $this->session->set_userdata('region', $admin->region);

        //             if (!empty($admin->region)) {

        //                 // Convert to lowercase array
        //                 $regions = array_map(
        //                     'strtolower',
        //                     array_map('trim', explode(',', $admin->region))
        //                 );

        //                 // Escape values for SQL
        //                 $region_list = "'" . implode("','", $regions) . "'";

        //                 // Apply dynamic condition
        //                 $where .= "
        //                     AND (
        //                         LOWER(cd.state) IN ($region_list)
        //                         OR LOWER(cd.country) IN ($region_list)
        //                     )
        //                 ";
        //             }
        //         }

        //         $sql = "
        //             SELECT 
        //                 SUM(
        //                     CASE 
        //                         WHEN e.status = 'in-progress'
        //                             AND f_sum.total_email_exchange BETWEEN 3 AND 6
        //                             AND e.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                         THEN 1 ELSE 0
        //                     END
        //                 ) AS hot_count,

        //                 SUM(
        //                     CASE 
        //                         WHEN e.status = 'in-progress'
        //                             AND f_sum.total_email_exchange >= 7
        //                             AND e.check_in_date BETWEEN CURDATE() 
        //                             AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        //                         THEN 1 ELSE 0
        //                     END
        //                 ) AS superhot_count

        //             FROM enquiry e

        //             LEFT JOIN company_details cd 
        //                 ON cd.company_id = e.company_details_id

        //             LEFT JOIN (
        //                 SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
        //                 FROM followups
        //                 GROUP BY enquiry_id
        //             ) f_sum 
        //                 ON f_sum.enquiry_id = e.id

        //             WHERE $where
        //         ";
        //     }

        //     log_user_activity(
        //         'Email Exchange Reminder',
        //         $logged_user,
        //         'email_exchange_reminder: email_exchange_reminder'
        //     );

        //     return $this->common_model->custom_query($sql);
        // }
        
        // 28-april-2026
        public function query_reminder()
        {
            $logged_user  = $this->session->userdata('id');
            $logged_type  = $this->session->userdata('type');
            $logged_email = $this->session->userdata('email');

            $admin = $this->db->select('combo_access, hod')
                        ->where('id', $logged_user)
                        ->get('admin')
                        ->row();

            $combo_access = $admin->combo_access ?? 'no';
            $is_hod       = ($admin->hod ?? 'no') == 'yes';

            $where = "enquiry.is_deleted = 0";

            // ---------- ADMIN (type 1) : see ALL pending & in-progress (both CMB and non-CMB) ----------
            if ($logged_type == '1') {
                 $sql = "
                    SELECT 
                        COUNT(DISTINCT CASE 
                            WHEN enquiry.status = 'pending' 
                            THEN enquiry.id 
                        END) AS pending_count,

                        SUM(
                            CASE 
                                WHEN enquiry.status = 'in-progress'
                                AND COALESCE(ce.min_check_in, enquiry.check_in_date)
                                    BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0 
                            END
                        ) AS inprogress_count

                    FROM enquiry

                    LEFT JOIN (
                        SELECT enquiry_id, MIN(check_in_date) AS min_check_in
                        FROM combo_enquiry
                        GROUP BY enquiry_id
                    ) ce ON ce.enquiry_id = enquiry.id

                    WHERE enquiry.is_deleted = 0
                ";
            }
            // ---------- COMBO ACCESS USERS : only CMB files, with file_handle_by restrictions ----------
            elseif ($combo_access == 'yes') {
                if ($is_hod) {
                    $subquery = $this->db->select('id')
                                        ->from('admin')
                                        ->where('combo_access', 'yes')
                                        ->where('status !=', '0')
                                        ->where('id !=', '61')
                                        ->where('status !=', '2')
                                        ->get_compiled_select();
                    $file_handle_condition = "enquiry.file_handle_by IN ($logged_user)";
                } else {
                    $file_handle_condition = "enquiry.file_handle_by = $logged_user";
                }

                $sql = "
                    SELECT 
                        COUNT(DISTINCT CASE 
                            WHEN enquiry.status = 'pending' 
                            AND enquiry.enquiry_no LIKE 'CMB%'
                            THEN enquiry.id 
                        END) AS pending_count,
                        
                        SUM(
                            CASE 
                                WHEN enquiry.status = 'in-progress'
                                AND enquiry.enquiry_no LIKE 'CMB%'
                                AND COALESCE(ce.min_check_in, enquiry.check_in_date)
                                    BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0 
                            END
                        ) AS inprogress_count

                    FROM enquiry

                    LEFT JOIN (
                        SELECT enquiry_id, MIN(check_in_date) AS min_check_in
                        FROM combo_enquiry
                        GROUP BY enquiry_id
                    ) ce ON ce.enquiry_id = enquiry.id

                    WHERE enquiry.is_deleted = 0
                    AND $file_handle_condition
                ";
            }

            else {
                // Type 6: only enquiries with enquiry_abbr starting with 'I'
                if ($logged_type == '6') {
                    $where .= " AND enquiry.enquiry_abbr LIKE 'I%'";
                }

                // Type 2 restriction (except specific emails)
                if ($logged_type == '2' &&
                    !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
                ) {
                    $where .= " AND enquiry.file_handle_by = '{$logged_user}'";
                }

                // Region filter for type 5 or 6
                if ($logged_type == '5' || $logged_type == '6') {
                    $admin_region = $this->db->select('region')
                                            ->where('id', $logged_user)
                                            ->get('admin')
                                            ->row();
                    if (!empty($admin_region->region)) {
                        $regions = array_map('strtolower', array_map('trim', explode(',', $admin_region->region)));
                        $region_list = "'" . implode("','", $regions) . "'";
                        $where .= "
                            AND (
                                LOWER(cd.state) IN ($region_list)
                                OR LOWER(cd.country) IN ($region_list)
                            )
                        ";
                    }
                }

                // Main query for non‑admin, non‑combo users (with date restrictions & combo support)
                $sql = "
                    SELECT 
                        SUM(
                            CASE 
                                WHEN enquiry.status = 'pending' 
                                AND YEAR(COALESCE(ce.min_check_in, enquiry.check_in_date)) = 2026 
                                THEN 1 ELSE 0 
                            END
                        ) AS pending_count,
                        SUM(
                            CASE 
                                WHEN enquiry.status = 'in-progress'
                                AND COALESCE(ce.min_check_in, enquiry.check_in_date) 
                                    BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0 
                            END
                        ) AS inprogress_count
                    FROM enquiry
                    LEFT JOIN company_details cd ON cd.company_id = enquiry.company_details_id
                    LEFT JOIN (
                        SELECT enquiry_id, MIN(check_in_date) AS min_check_in
                        FROM combo_enquiry
                        GROUP BY enquiry_id
                    ) ce ON ce.enquiry_id = enquiry.id
                    WHERE $where
                ";
            }

            log_user_activity('Query reminder', $logged_user, 'query_reminder: query_reminder');
            return $this->common_model->custom_query($sql);
        }
        
        // 28-april-2026 updated
        public function email_exchange_reminder() 
        {
            $logged_user  = $this->session->userdata('id');
            $logged_type  = $this->session->userdata('type');
            $logged_email = $this->session->userdata('email');
            $admin = $this->db->select('combo_access, hod')
                    ->where('id', $logged_user)
                    ->get('admin')
                    ->row();

            $combo_access = $admin->combo_access ?? 'no';
            $is_hod       = ($admin->hod ?? 'no') == 'yes';

            // Check if user is ID 95
            if($combo_access == 'yes'){

            if ($is_hod) {
                    // HOD with combo_access sees all combo_access users
                    $subquery = $this->db->select('id')
                                        ->from('admin')
                                        ->where('combo_access', 'yes')
                                        ->where('status !=', '0')
                                        ->where('id !=', '61')
                                        ->where('status !=', '2')
                                        ->get_compiled_select();

                    $file_handle_condition = "enquiry.file_handle_by IN ($logged_user)";
                } else {
                    // Non-HOD combo_access sees only themselves
                    $file_handle_condition = "enquiry.file_handle_by = $logged_user";
                }
               
                $sql = "SELECT 
                        SUM(
                            CASE 
                                WHEN enquiry.status = 'in-progress'
                                    AND enquiry.enquiry_no LIKE 'CMB%'
                                    AND f_sum.total_email_exchange BETWEEN 3 AND 6
                                    AND COALESCE(ce.min_check_in_date, enquiry.check_in_date)
                                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0
                            END
                        ) AS hot_count,

                        SUM(
                            CASE 
                                WHEN enquiry.status = 'in-progress'
                                    AND enquiry.enquiry_no LIKE 'CMB%'
                                    AND f_sum.total_email_exchange >= 7
                                    AND COALESCE(ce.min_check_in_date, enquiry.check_in_date)
                                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0
                            END
                        ) AS superhot_count

                    FROM enquiry

                    LEFT JOIN (
                        SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
                        FROM followups
                        GROUP BY enquiry_id
                    ) f_sum 
                        ON f_sum.enquiry_id = enquiry.id

                    -- ✅ ADD THIS (IMPORTANT)
                    LEFT JOIN (
                        SELECT enquiry_id, MIN(check_in_date) AS min_check_in_date
                        FROM combo_enquiry
                        GROUP BY enquiry_id
                    ) ce 
                        ON ce.enquiry_id = enquiry.id

                    WHERE enquiry.is_deleted = 0
                    AND $file_handle_condition";
            } else {
                // Base where condition
                $where = "e.is_deleted = 0";

                if($logged_type == '6'){
                    $where .= " AND e.enquiry_abbr LIKE 'I%'";
                }

                // Login type restriction
                if (
                    $logged_type == '2' &&
                    !in_array($logged_email, ['optimax@kazindmc.com', 'anuj.accounts@kazindmc.com'])
                ) {
                    $where .= " AND e.file_handle_by = '{$logged_user}'";
                }

                if ($logged_type == '5' || $logged_type == '6') {
                    // Fetch logged-in user's region
                    $admin = $this->db
                        ->select('region')
                        ->where('id', $logged_user)
                        ->get('admin')
                        ->row();

                    $this->session->set_userdata('region', $admin->region);

                    if (!empty($admin->region)) {

                        // Convert to lowercase array
                        $regions = array_map(
                            'strtolower',
                            array_map('trim', explode(',', $admin->region))
                        );

                        // Escape values for SQL
                        $region_list = "'" . implode("','", $regions) . "'";

                        // Apply dynamic condition
                        $where .= "
                            AND (
                                LOWER(cd.state) IN ($region_list)
                                OR LOWER(cd.country) IN ($region_list)
                            )
                        ";
                    }
                }

                $sql = "
                    SELECT 
                        SUM(
                            CASE 
                                WHEN e.status = 'in-progress'
                                    AND f_sum.total_email_exchange BETWEEN 3 AND 6
                                    AND COALESCE(ce.min_check_in_date, e.check_in_date) 
                                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0
                            END
                        ) AS hot_count,

                        SUM(
                            CASE 
                                WHEN e.status = 'in-progress'
                                    AND f_sum.total_email_exchange >= 7
                                    AND COALESCE(ce.min_check_in_date, e.check_in_date) 
                                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                THEN 1 ELSE 0
                            END
                        ) AS superhot_count

                    FROM enquiry e

                    LEFT JOIN company_details cd 
                        ON cd.company_id = e.company_details_id

                    LEFT JOIN (
                        SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange
                        FROM followups
                        GROUP BY enquiry_id
                    ) f_sum 
                        ON f_sum.enquiry_id = e.id

                    -- Add this join to get the minimum check‑in date for combo enquiries
                    LEFT JOIN (
                        SELECT enquiry_id, MIN(check_in_date) AS min_check_in_date
                        FROM combo_enquiry
                        GROUP BY enquiry_id
                    ) ce 
                        ON ce.enquiry_id = e.id

                    WHERE $where
                ";
            }

            log_user_activity(
                'Email Exchange Reminder',
                $logged_user,
                'email_exchange_reminder: email_exchange_reminder'
            );

            return $this->common_model->custom_query($sql);
        }
        
    }
