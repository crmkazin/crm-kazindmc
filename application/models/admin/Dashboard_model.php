<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function count_organization()
    {
        $this->db->join('branch', 'branch.company_id = company.company_id');
        $this->db->order_by('company.id', 'DESC');
        $result = $this->db->get('company');
        $result = $result->num_rows();
        return $result;
    }

    public function count_enquiry()
    {
        $this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');
        $this->db->join('company', 'company.company_id = enquiry.company');
        $this->db->join('branch', 'branch.branch_id = enquiry.branch');
        $this->db->where('enquiry.status !=', 'Quotation Send');
        $this->db->where('enquiry.status !=', 'Not Useful');
        $this->db->order_by('enquiry.id', 'DESC');
        $result = $this->db->get('enquiry');
        return $result->num_rows();
    }

    public function count_quotations()
    {
        $this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.*');
        $this->db->join('enquiry', 'enquiry.id = quotation.enquiry_id');
        $this->db->join('company', 'company.company_id = enquiry.company');
        $this->db->join('branch', 'branch.branch_id = enquiry.branch');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('quotation');
        return $result->num_rows();
    }

    public function count_products()
    {
        $result = $this->db->get('products');
        return $result->num_rows();
    }
    
    // public function enquiry_status_for_sales_chart($locations = [], $year = null, $month = null, $quarter = null, $sales = null, $state = null)
    // {
    //     $where = 'enquiry.is_deleted = 0';
    //     $join = '';
    //     $use_arrival_join = false;

    //     $loggedInUserType = $this->session->userdata('type');
    //     $loggedInUserId   = $this->session->userdata('id');

    //     // Type 6: Intersect user-specific files with selected region
    //     if ($loggedInUserType == 6) {
    //         $type6_abbrs = ['IKZ', 'IAZ', 'IAR', 'IBZ', 'IGE'];
            
    //         // If "all" selected, show all type 6 specific enquiry_abbrs
    //         if (in_array('all', $locations)) {
    //             $locations = $type6_abbrs;
    //         } else {
    //             // Only include type6 abbrs that also exist in selected region
    //             $locations = array_intersect($locations, $type6_abbrs);
    //         }

    //         // If no valid abbrs remain, return empty result
    //         if (empty($locations)) {
    //             return [];
    //         }

    //         // Restrict to logged-in user's enquiries
    //         if (!empty($sales)) {
    //             $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales;
    //         }else{
    //             $where .= " AND enquiry.sales_admin_id = " . (int)$loggedInUserId;
    //         }

    //         $safe_locations = array_map([$this->db, 'escape_str'], $locations);
    //         $in = '"' . implode('","', $safe_locations) . '"';
    //         $where .= " AND enquiry.enquiry_abbr IN ($in)";
    //     } else {
    //         // For other user types
    //         if (!empty($locations) && is_array($locations)) {
    //             if (in_array('all', $locations)) {
    //                 $use_arrival_join = true;
    //             } else {
    //                 $safe_locations = array_map([$this->db, 'escape_str'], $locations);
    //                 $in = '"' . implode('","', $safe_locations) . '"';
    //                 $where .= " AND enquiry.enquiry_abbr IN ($in)";
    //             }
    //         }
    //     }

    //     if (!empty($year)) {
    //         $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
    //     }

    //     if (!empty($month)) {
    //         $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
    //     } elseif (!empty($quarter)) {
    //         switch ($quarter) {
    //             case 1: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 1 AND 3'; break;
    //             case 2: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 4 AND 6'; break;
    //             case 3: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 7 AND 9'; break;
    //             case 4: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 10 AND 12'; break;
    //         }
    //     }

    //     if (!empty($sales)) {
    //         $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales;
    //     }

    //     if (!empty($state)) {
    //         $state = strtolower(urldecode($state));
    //         $arr = array_map('trim', explode(',', $state));
    //         $arr = array_filter($arr);
    //         if (!empty($arr)) {
    //             $safe_states = array_map([$this->db, 'escape'], $arr);
    //             $state_condition = 'LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
    //             $country_condition = 'LOWER(company_details.country) IN (' . implode(',', $safe_states) . ')';

    //             $join .= ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
    //             $where .= ' AND (' . $state_condition . ' OR ' . $country_condition . ')';
    //         }
    //     }

    //     if ($use_arrival_join) {
    //         $join .= ' LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id ';
    //     }

    //     $query = $this->db->query("
    //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count 
    //         FROM enquiry 
    //         $join 
    //         WHERE $where 
    //         GROUP BY LOWER(enquiry.status)
    //     ");

    //     $counts = [];
    //     if ($query && $query->num_rows() > 0) {
    //         foreach ($query->result() as $row) {
    //             $counts[$row->status] = (int)$row->status_count;
    //         }
    //     }

    //     return $counts;
    // }
    
    
    public function enquiry_status_for_sales_chart($locations = [], $year = null, $month = null, $quarter = null, $sales = null, $state = null)
    {
        $where = 'enquiry.is_deleted = 0';
        $join = '';
        $use_arrival_join = false;

        $loggedInUserType = $this->session->userdata('type');
        $loggedInUserId   = $this->session->userdata('id');

        // Type 6: Intersect user-specific files with selected region
        if ($loggedInUserType == 6) {
            $type6_abbrs = ['IKZ', 'IAZ', 'IAR', 'IBZ', 'IGE'];

            // If "all" selected, show all type 6 specific enquiry_abbrs
            if (in_array('all', $locations)) {
                $locations = $type6_abbrs;
            } else {
                // Only include type6 abbrs that also exist in selected region
                $locations = array_intersect($locations, $type6_abbrs);
            }

            // If no valid abbrs remain, return empty result
            if (empty($locations)) {
                return [];
            }

            // Handle sales filter for type 6 users
            if (!empty($sales) && $sales !== 'all') {
                $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales;
            } elseif ($sales === 'all') {
                // Fetch all type 6 users from admin table
                $this->db->select('id');
                $this->db->from('admin');
                $this->db->where('type', 6);
                $type6UsersQuery = $this->db->get();

                if ($type6UsersQuery->num_rows() > 0) {
                    $type6UserIds = array_column($type6UsersQuery->result_array(), 'id');
                    $safe_ids = array_map('intval', $type6UserIds);
                    $in = implode(',', $safe_ids);
                    $where .= " AND enquiry.sales_admin_id IN ($in)";
                } else {
                    // No type 6 users found, return empty
                    return [];
                }
            } else {
                // Default case: logged-in Type 6 user's own data
                $where .= " AND enquiry.sales_admin_id = " . (int)$loggedInUserId;
            }

            // Apply enquiry_abbr filter
            if (!empty($locations)) {
                $safe_locations = array_map([$this->db, 'escape_str'], $locations);
                $in = '"' . implode('","', $safe_locations) . '"';
                $where .= " AND enquiry.enquiry_abbr IN ($in)";
            }
        } else {
            // For other user types
            if (!empty($locations) && is_array($locations)) {
                if (in_array('all', $locations)) {
                    $use_arrival_join = true;
                } else {
                    $safe_locations = array_map([$this->db, 'escape_str'], $locations);
                    $in = '"' . implode('","', $safe_locations) . '"';
                    $where .= " AND enquiry.enquiry_abbr IN ($in)";
                }
            }
        }

        // Date filters
        if (!empty($year)) {
            $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
        }

        if (!empty($month)) {
            $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
        } elseif (!empty($quarter)) {
            switch ($quarter) {
                case 1: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 1 AND 3'; break;
                case 2: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 4 AND 6'; break;
                case 3: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 7 AND 9'; break;
                case 4: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 10 AND 12'; break;
            }
        }

        // Sales filter for other user types (not type 6)
        if ($loggedInUserType != 6 && !empty($sales) && $sales !== 'all') {
            $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales;
        }

        // State filter
        if (!empty($state)) {
            $state = strtolower(urldecode($state));
            $arr = array_map('trim', explode(',', $state));
            $arr = array_filter($arr);
            if (!empty($arr)) {
                $safe_states = array_map([$this->db, 'escape'], $arr);
                $state_condition = 'LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
                $country_condition = 'LOWER(company_details.country) IN (' . implode(',', $safe_states) . ')';

                $join .= ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
                $where .= ' AND (' . $state_condition . ' OR ' . $country_condition . ')';
            }
        }

        // Join arrivals if required
        if ($use_arrival_join) {
            $join .= ' LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id ';
        }

        // Final query
        $query = $this->db->query("
            SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count 
            FROM enquiry 
            $join 
            WHERE $where 
            GROUP BY LOWER(enquiry.status)
        ");

        $counts = [];
        if ($query && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $counts[$row->status] = (int)$row->status_count;
            }
        }

        return $counts;
    }


    // public function enquiry_status_for_sales_chart($locations = [], $year = null, $month = null, $quarter = null, $sales = null, $state = null)
    // {
    //     $where = 'enquiry.is_deleted = 0';
    //     $join = '';
    //     $use_arrival_join = false;

    //     // If "all" is in location, use arrivals join and no abbr filtering
    //     if (!empty($locations) && is_array($locations)) {
    //         if (in_array('all', $locations)) {
    //             $use_arrival_join = true;
    //         } else {
    //             $safe_locations = array_map([$this->db, 'escape_str'], $locations);
    //             $in = '"' . implode('","', $safe_locations) . '"';
    //             $where .= " AND enquiry.enquiry_abbr IN ($in)";
    //         }
    //     }

    //     if (!empty($year)) {
    //         $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
    //     }

    //     if (!empty($month)) {
    //         $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
    //     } elseif (!empty($quarter)) {
    //         switch ($quarter) {
    //             case 1: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 1 AND 3'; break;
    //             case 2: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 4 AND 6'; break;
    //             case 3: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 7 AND 9'; break;
    //             case 4: $where .= ' AND MONTH(enquiry.check_in_date) BETWEEN 10 AND 12'; break;
    //         }
    //     }

    //     if (!empty($sales)) {
    //         $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales;
    //     }
        
    //     // if (!empty($state)) {
    //     //     $state = strtolower(urldecode($state));
    //     //     $arr = array_map('trim', explode(',', $state));
    //     //     $arr = array_filter($arr);
    //     //     $safe_states = array_map([$this->db, 'escape'], $arr);
    //     //     $join .= ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
    //     //     $where .= ' AND LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
    //     // }
        
    //     if (!empty($state)) {
    //         $state = strtolower(urldecode($state));
    //         $arr = array_map('trim', explode(',', $state));
    //         $arr = array_filter($arr);
    //         if (!empty($arr)) {
    //             $safe_states = array_map([$this->db, 'escape'], $arr);
    //             $state_condition = 'LOWER(company_details.state) IN (' . implode(',', $safe_states) . ')';
    //             $country_condition = 'LOWER(company_details.country) IN (' . implode(',', $safe_states) . ')';

    //             $join .= ' LEFT JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
    //             $where .= ' AND (' . $state_condition . ' OR ' . $country_condition . ')';
    //         }
    //     }

    //     // Add join if all locations
    //     if ($use_arrival_join) {
    //         $join .= ' LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id ';
    //     }

    //     $query = $this->db->query("
    //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count 
    //         FROM enquiry 
    //         $join 
    //         WHERE $where 
    //         GROUP BY LOWER(enquiry.status)
    //     ");

    //     $counts = [];
    //     if ($query && $query->num_rows() > 0) {
    //         foreach ($query->result() as $row) {
    //             $counts[$row->status] = (int)$row->status_count;
    //         }
    //     }

    //     return $counts;
    // }
    
    // 25 Aug 2025
    //  public function enquiry_status_for_teamwise_chart($locations = [], $type = null, $quarter = null, $user_id = null, $year = null)
    // {
    //     $where = 'enquiry.is_deleted = 0';

    //     // Apply location filters
    //     if (!empty($locations)) {
    //         $safe_locations = array_map([$this->db, 'escape_str'], $locations);
    //         $in = '"' . implode('","', $safe_locations) . '"';
    //         $where .= " AND enquiry.enquiry_abbr IN ($in)";
    //     }
        
    //     if (!empty($type)) {
    //         $type = $this->db->escape($type);
    //         $where .= " AND enquiry.enquiry_abbr = $type";
    //     }

    //     // Apply user filter
    //     if (!empty($user_id)) {
    //         $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
    //     } else {
    //         $where .= " AND enquiry.file_handle_by != 61";
    //     }

    //     if (!empty($year)) {
    //         $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
    //     }

    //     // Apply quarter date filter
    //     if (!empty($quarter)) {
    //         $dates = explode('_', $quarter);
    //         if (count($dates) === 2) {
    //             $start = $this->db->escape_str($dates[0]);
    //             $end   = $this->db->escape_str($dates[1]);
    //             $where .= " AND DATE(enquiry.check_in_date) >= '$start' AND DATE(enquiry.check_in_date) <= '$end'";
    //         }
    //     }

    //     $query = $this->db->query("
    //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         WHERE $where AND LOWER(enquiry.status) != 'cancel-at-arrival'
    //         GROUP BY LOWER(enquiry.status)
    //     ");
        
    //     $result = $query->result();

    //     // 2. Get arrival cancel count (used as cancel-at-arrival)
    //     $cancelArrivalQuery = $this->db->query("
    //         SELECT COUNT(*) AS cancel_arrival_count
    //         FROM arrivals
    //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //         WHERE $where AND LOWER(arrivals.status) = 'cancel'
    //     ");
        
    //     $cancel_arrival_count = (int)$cancelArrivalQuery->row()->cancel_arrival_count;

    //     // 3. Prepare output array with adjusted counts
    //     $output = [];

    //     foreach ($result as $row) {
    //         $status = $row->status;
    //         $count = (int)$row->status_count;

    //         // if ($status === 'confirm') {
    //         //     $count = max(0, $count - $cancel_arrival_count);
    //         // }

    //         $output[$status] = $count;
    //     }

    //     // 4. Add derived cancel-at-arrival entry
    //     $output['cancel-at-arrival'] = $cancel_arrival_count;

    //     return $output;
    // }
    
    // 11-11-2025 previous
    // public function enquiry_status_for_teamwise_chart($locations = [], $type = null, $quarter = null, $user_id = null, $year = null)
    // {
    //     $where = 'enquiry.is_deleted = 0';
    //     $excluded_companies = ['656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2'];
    //     // $where .= " AND enquiry.company_id NOT IN ('656d93b772dd0', '6557284ecda1e')";
    //     $where .= " AND enquiry.company_id NOT IN ('" . implode("','", $excluded_companies) . "')";

    //     // Apply location filters
    //     if (!empty($locations)) {
    //         $safe_locations = array_map([$this->db, 'escape_str'], $locations);
    //         $in = '"' . implode('","', $safe_locations) . '"';
    //         $where .= " AND enquiry.enquiry_abbr IN ($in)";
    //     }
        
    //     if (!empty($type)) {
    //         $type = $this->db->escape($type);
    //         $where .= " AND enquiry.enquiry_abbr = $type";
    //     }

    //     // Apply user filter
    //     if (!empty($user_id)) {
    //         $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
    //     } else {
    //         $where .= " AND enquiry.file_handle_by != 61";
    //     }

    //     if (!empty($year)) {
    //         $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
    //     }

    //     // Apply quarter date filter
    //     if (!empty($quarter)) {
    //         $dates = explode('_', $quarter);
    //         if (count($dates) === 2) {
    //             $start = $this->db->escape_str($dates[0]);
    //             $end   = $this->db->escape_str($dates[1]);
    //             $where .= " AND DATE(enquiry.check_in_date) >= '$start' AND DATE(enquiry.check_in_date) <= '$end'";
    //         }
    //     }

    //     $query = $this->db->query("
    //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         WHERE $where AND LOWER(enquiry.status) != 'cancel-at-arrival'
    //         GROUP BY LOWER(enquiry.status)
    //     ");
        
    //     $result = $query->result();

    //     // 2. Get arrival cancel count (used as cancel-at-arrival)
    //     $cancelArrivalQuery = $this->db->query("
    //         SELECT COUNT(*) AS cancel_arrival_count
    //         FROM arrivals
    //         LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
    //         WHERE $where AND LOWER(arrivals.status) = 'cancel'
    //     ");
        
    //     $cancel_arrival_count = (int)$cancelArrivalQuery->row()->cancel_arrival_count;
    //      // 🔹 Separate query for excluded companies
    //     // $excluded_where = str_replace(
    //     //     "NOT IN ('" . implode("','", $excluded_companies) . "')",
    //     //     "IN ('" . implode("','", $excluded_companies) . "')",
    //     //     $where
    //     // );

    //     // $excludedQuery = $this->db->query("
    //     //     SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
    //     //     FROM enquiry
    //     //     LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //     //     WHERE $excluded_where AND LOWER(enquiry.status) != 'cancel-at-arrival'
    //     //     GROUP BY LOWER(enquiry.status)
    //     // ");

    //     // $excluded_result = $excludedQuery->result();

    //     // // 3. Prepare output array with adjusted counts
    //     // $output = [];

    //     // foreach ($result as $row) {
    //     //     $status = $row->status;
    //     //     $count = (int)$row->status_count;

    //     //     $output[$status] = $count;
    //     // }

    //     // // 4. Add derived cancel-at-arrival entry
    //     // $output['cancel-at-arrival'] = $cancel_arrival_count;

    //     // $excluded_counts = [];
    //     // foreach ($excluded_result as $row) {
    //     //     $excluded_counts[$row->status] = (int)$row->status_count;
    //     // }
        
    //     $excluded_counts = [];
    //     foreach ($excluded_companies as $company_id) {
    //         $excluded_where = str_replace(
    //             "NOT IN ('" . implode("','", $excluded_companies) . "')",
    //             "= '" . $company_id . "'",
    //             $where
    //         );

    //         $excludedQuery = $this->db->query("
    //             SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
    //             FROM enquiry
    //             LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //             WHERE $excluded_where
    //             GROUP BY LOWER(enquiry.status)
    //         ");

    //         $excluded_counts[$company_id] = [];
    //         foreach ($excludedQuery->result() as $row) {
    //             $excluded_counts[$company_id][$row->status] = (int)$row->status_count;
    //         }
    //     }

    //     // ---------- PREPARE OUTPUT ----------
    //     $output = [];
    //     foreach ($result as $row) {
    //         $output[$row->status] = (int)$row->status_count;
    //     }

    //     $output['cancel-at-arrival'] = $cancel_arrival_count;

    //     return [
    //         'main'     => $output,
    //         'excluded' => $excluded_counts
    //     ];
    // }
    
    // 11-11-2025
    public function enquiry_status_for_teamwise_chart($locations = [], $type = null, $month = null, $quarter = null, $user_id = null, $year = null)
    {
        $where = 'enquiry.is_deleted = 0';
        $excluded_companies = ['656d93b772dd0', '6557284ecda1e', '64e0693b0b9b2'];
        $where .= " AND enquiry.company_id NOT IN ('" . implode("','", $excluded_companies) . "')";

        // Check if locations contain only 'CMB' (Combo files)
        $is_combo_location = !empty($locations) && count($locations) === 1 && in_array('CMB', $locations);
        
        // Apply location filters
        if (!empty($locations) && !$is_combo_location) {
            $safe_locations = array_map([$this->db, 'escape_str'], $locations);
            $in = '"' . implode('","', $safe_locations) . '"';
            $where .= " AND enquiry.enquiry_abbr IN ($in)";
        }

        // Apply user filter
        if (!empty($user_id)) {
            $where .= " AND enquiry.file_handle_by = " . (int)$user_id;
        } else {
            $where .= " AND enquiry.file_handle_by != 61";
        }

        // Handle CMB files (either from type='CMB' or location='CMB')
        $is_cmb_query = ($type == 'CMB' || $is_combo_location);
        
        if ($is_cmb_query) {
            // Filter for CMB enquiries
            $where .= " AND enquiry.enquiry_no LIKE '%CMB%'";

            // Year filter based on MIN(combo_enquiry.check_in_date)
            if (!empty($year)) {
                $where .= " AND YEAR((
                                SELECT MIN(ce.check_in_date)
                                FROM combo_enquiry ce
                                WHERE ce.enquiry_id = enquiry.id
                            )) = '" . $year . "'";
            }
            
            // Year filter based on MIN(combo_enquiry.check_in_date)
            if (!empty($month)) {
                $where .= " AND MONTH((
                                SELECT MIN(ce.check_in_date)
                                FROM combo_enquiry ce
                                WHERE ce.enquiry_id = enquiry.id
                            )) = '" . $month . "'";
            }

            // Quarter filter based on same MIN date
            if (!empty($quarter)) {
                $dates = explode('_', $quarter);
                if (count($dates) === 2) {
                    $start = $this->db->escape_str($dates[0]);
                    $end   = $this->db->escape_str($dates[1]);
                    $where .= " AND (
                                    SELECT MIN(ce.check_in_date)
                                    FROM combo_enquiry ce
                                    WHERE ce.enquiry_id = enquiry.id
                                ) BETWEEN '$start' AND '$end'";
                }
            }
        } else {
            // Non-CMB Enquiries
            if (!empty($type) && $type != 'all') {
                $type = $this->db->escape($type);
                $where .= " AND enquiry.enquiry_abbr = $type";
            }

            // Year filter
            if (!empty($year)) {
                $where .= ' AND YEAR(enquiry.check_in_date) = "' . $year . '"';
            }
            
            // Month filter
            if (!empty($month)) {
                $where .= ' AND MONTH(enquiry.check_in_date) = "' . $month . '"';
            } 

            // Quarter filter
            if (!empty($quarter)) {
                $dates = explode('_', $quarter);
                if (count($dates) === 2) {
                    $start = $this->db->escape_str($dates[0]);
                    $end   = $this->db->escape_str($dates[1]);
                    $where .= " AND DATE(enquiry.check_in_date) BETWEEN '$start' AND '$end'";
                }
            }
        }

        // ---------- MAIN QUERY ----------
        if ($is_cmb_query) {
            // For CMB files: Use GROUP BY enquiry.id with subquery
            $query = $this->db->query("
                SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
                FROM (
                    SELECT DISTINCT enquiry.id, enquiry.status
                    FROM enquiry
                    LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                    WHERE $where AND LOWER(enquiry.status) != 'cancel-at-arrival'
                    GROUP BY enquiry.id, enquiry.status
                ) AS enquiry
                GROUP BY LOWER(enquiry.status)
            ");
        } else {
            // For non-CMB files: Original query remains same
            $query = $this->db->query("
                SELECT LOWER(enquiry.status) AS status, COUNT(DISTINCT enquiry.id) AS status_count
                FROM enquiry
                LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                WHERE $where AND LOWER(enquiry.status) != 'cancel-at-arrival'
                GROUP BY LOWER(enquiry.status)
            ");
        }
        
        $result = $query->result();

        // ---------- CANCEL AT ARRIVAL ----------
        // $cancelArrivalQuery = $this->db->query("
        //     SELECT COUNT(*) AS cancel_arrival_count
        //     FROM arrivals
        //     LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //     WHERE $where AND LOWER(arrivals.status) = 'cancel'
        // ");
        
        // $cancelArrivalQuery = $this->db->query("
        //     SELECT COUNT(DISTINCT enquiry.id) AS cancel_arrival_count
        //     FROM arrivals
        //     LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
        //     WHERE $where AND LOWER(arrivals.status) = 'cancel'
        // ");
        
        if ($is_cmb_query) {
            // For CMB: Count only enquiries where ALL arrivals have status = 'cancel'
            $cancelArrivalQuery = $this->db->query("
                SELECT COUNT(*) AS cancel_arrival_count
                FROM (
                    SELECT enquiry.id
                    FROM enquiry
                    JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                    WHERE $where
                    GROUP BY enquiry.id
                    HAVING SUM(CASE WHEN LOWER(arrivals.status) = 'cancel' THEN 1 ELSE 0 END) = COUNT(*)
                ) AS fully_canceled_enquiries
            ");
        } else {
            // For non-CMB: Count any enquiry with at least one canceled arrival
            $cancelArrivalQuery = $this->db->query("
                SELECT COUNT(DISTINCT enquiry.id) AS cancel_arrival_count
                FROM arrivals
                LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id
                WHERE $where AND LOWER(arrivals.status) = 'cancel'
            ");
        }
        
        $cancel_arrival_count = (int)$cancelArrivalQuery->row()->cancel_arrival_count;

        // ---------- EXCLUDED COMPANIES ----------
        $excluded_counts = [];
        foreach ($excluded_companies as $company_id) {
            $excluded_where = str_replace(
                "NOT IN ('" . implode("','", $excluded_companies) . "')",
                "= '" . $company_id . "'",
                $where
            );

            if ($is_cmb_query) {
                // For CMB files: Use GROUP BY enquiry.id with subquery
                $excludedQuery = $this->db->query("
                    SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
                    FROM (
                        SELECT DISTINCT enquiry.id, enquiry.status
                        FROM enquiry
                        LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                        WHERE $excluded_where
                        GROUP BY enquiry.id, enquiry.status
                    ) AS enquiry
                    GROUP BY LOWER(enquiry.status)
                ");
                
                // if (($month == '03')) { 
                //     // For CMB files: Use GROUP BY enquiry.id with subquery
                //     $excludedQuery = $this->db->query("
                //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
                //         FROM (
                //             SELECT enquiry.id, enquiry.status
                //             FROM enquiry
                //             LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                //             WHERE $excluded_where
                //         ) AS enquiry
                //         GROUP BY LOWER(enquiry.status)
                //     ");
                // }else{
                //     // For CMB files: Use GROUP BY enquiry.id with subquery
                //     $excludedQuery = $this->db->query("
                //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
                //         FROM (
                //             SELECT DISTINCT enquiry.id, enquiry.status
                //             FROM enquiry
                //             LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                //             WHERE $excluded_where
                //         ) AS enquiry
                //         GROUP BY LOWER(enquiry.status)
                //     ");
                // }
            } else {
                // For non-CMB files: Original query remains same
                $excludedQuery = $this->db->query("
                    SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_count
                    FROM enquiry
                    LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
                    WHERE $excluded_where
                    GROUP BY LOWER(enquiry.status)
                ");
            }

            $excluded_counts[$company_id] = [];
            foreach ($excludedQuery->result() as $row) {
                $excluded_counts[$company_id][$row->status] = (int)$row->status_count;
            }
        }

        // ---------- PREPARE OUTPUT ----------
        $output = [];
        foreach ($result as $row) {
            $output[$row->status] = (int)$row->status_count;
        }

        $output['cancel-at-arrival'] = $cancel_arrival_count;

        return [
            'main'     => $output,
            'excluded' => $excluded_counts
        ];
    }

    // before 06_july_2026
    // public function enquiry_status_count($locations = '')
    // {
    //     $year = date('Y');
    //     $where = 'enquiry.is_deleted = 0 AND YEAR(enquiry.check_in_date) = ' . $year;

    //     // Company filter
    //     if (!empty($this->input->get('company_id'))) {
    //         $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
    //     }

    //     // Booking type and location filter
    //     if (!empty($this->input->get('booking_type'))) {
    //         $booking_type = urldecode($this->input->get('booking_type'));
    //         if ($booking_type === 'all' && $this->input->get('location') !== 'all') {
    //             $abbr_list = implode('","', $locations[$this->input->get('location')]);
    //             $where .= ' AND enquiry.enquiry_abbr IN ("' . $abbr_list . '")';
    //         } elseif ($booking_type !== 'all') {
    //             $where .= ' AND enquiry.enquiry_abbr = "' . $booking_type . '"';
    //         }
    //     }

    //     // Follow-up status
    //     if (!empty($this->input->get('followup_status'))) {
    //         $status = urldecode($this->input->get('followup_status'));
    //         $where .= ' AND enquiry.status = "' . $status . '"';
    //     }

    //     // Date range filters (query received)
    //     if (!empty($this->input->get('from'))) {
    //         $from_date = urldecode($this->input->get('from'));
    //         $where .= ' AND enquiry.query_received_date >= "' . $from_date . '"';
    //     }

    //     if (!empty($this->input->get('to'))) {
    //         $to_date = urldecode($this->input->get('to'));
    //         $where .= ' AND enquiry.query_received_date <= "' . $to_date . '"';
    //     }

    //     // Query number
    //     if (!empty($this->input->get('query_number'))) {
    //         $query_number = urldecode($this->input->get('query_number'));
    //         $where .= ' AND enquiry.enquiry_no = "' . $query_number . '"';
    //     }

    //     // Staff filter
    //     if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') !== 'all') {
    //         $staff_id = urldecode($this->input->get('staff_id'));
    //         $where .= ' AND enquiry.file_handle_by = "' . $staff_id . '"';
    //     }

    //     // Sales filter
    //     if (!empty($this->input->get('sales'))) {
    //         $sales_id = urldecode($this->input->get('sales'));
    //         $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales_id;
    //     }

    //     // Guests number range
    //     if (!empty($this->input->get('guests_number'))) {
    //         $guests_number = explode('-', urldecode($this->input->get('guests_number')));
    //         $where .= ' AND (enquiry.number_persons + enquiry.number_child) >= "' . $guests_number[0] . '"';
    //         if ($guests_number[1] !== 'above') {
    //             $where .= ' AND (enquiry.number_persons + enquiry.number_child) <= "' . $guests_number[1] . '"';
    //         }
    //     }

    //     // Check-in date range
    //     if (!empty($this->input->get('checkin_from'))) {
    //         $from_date = urldecode($this->input->get('checkin_from'));
    //         $where .= ' AND enquiry.check_in_date >= "' . $from_date . '"';
    //     }

    //     if (!empty($this->input->get('checkout_to'))) {
    //         $to_date = urldecode($this->input->get('checkout_to'));
    //         $where .= ' AND enquiry.check_in_date <= "' . $to_date . '"';
    //     }

    //     // Location-based filter for non-superadmin users
    //     if ($this->session->userdata('admin_type') !== 'superadmin' && $this->router->fetch_class() === 'enquiry') {
    //         $session_locations = explode(',', $this->session->userdata('locations'));
    //         $all_locations = [];
    //         foreach ($session_locations as $loc) {
    //             if (isset($this->locations[$loc])) {
    //                 $all_locations = array_merge($all_locations, $this->locations[$loc]);
    //             }
    //         }
    //         if (!empty($all_locations)) {
    //             $assigned_loc = implode('","', $all_locations);
    //             $where .= ' AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
    //         }
    //     }

    //     // Country/State/City filters (requires join)
    //     $join = '';
    //     if (!empty($this->input->get('country')) || !empty($this->input->get('state')) || !empty($this->input->get('city'))) {
    //         $join .= ' JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
    //     }

    //     if ($this->input->get('country') <> '') {
    //         $country = strtolower(urldecode($this->input->get('country')));
    //         $where .= ' AND LOWER(company_details.country) = "' . $country . '"';
    //     }

    //     if ($this->input->get('state') <> '') {
    //         $states = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('state'))))));
    //         if (!empty($states)) {
    //             $where .= ' AND LOWER(company_details.state) IN ("' . implode('","', $states) . '")';
    //         }
    //     }

    //     if ($this->input->get('city') <> '') {
    //         $cities = array_filter(array_map('trim', explode(',', strtolower(urldecode($this->input->get('city'))))));
    //         if (!empty($cities)) {
    //             $where .= ' AND LOWER(company_details.city) IN ("' . implode('","', $cities) . '")';
    //         }
    //     }

    //     // Final SQL query
    //     $query = $this->db->query("
    //         SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_cnt
    //         FROM enquiry
    //         LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
    //         $join
    //         WHERE $where
    //         GROUP BY LOWER(enquiry.status)
    //     ");

    //     $counts = $query->result();
    //     $new_arr = [];

    //     foreach ($counts as $row) {
    //         $new_arr[$row->status] = $row->status_cnt;
    //     }

    //     return $new_arr;
    // }
    
    // Updated Code after 06_july_2026
    public function enquiry_status_count($locations = '')
    {
        $year = date('Y');
    
        /*
        |--------------------------------------------------------------------------
        | Safe helper functions
        |--------------------------------------------------------------------------
        */
        $get_param = function ($key, $default = '') {
            $value = $this->input->get($key);
    
            if (is_array($value)) {
                $value = reset($value);
            }
    
            return trim(urldecode((string)($value ?? $default)));
        };
    
        $clean_list = function ($value, $case = 'upper') {
            if (is_array($value)) {
                $arr = $value;
            } else {
                $arr = explode(',', (string)$value);
            }
    
            $result = [];
    
            foreach ($arr as $item) {
                if (is_array($item)) {
                    continue;
                }
    
                $item = trim((string)$item);
    
                if ($item === '') {
                    continue;
                }
    
                if ($case === 'lower') {
                    $item = strtolower($item);
                } elseif ($case === 'upper') {
                    $item = strtoupper($item);
                }
    
                $result[] = $item;
            }
    
            return array_values(array_unique($result));
        };
    
        $normalize_locations = function ($locations_data) use ($clean_list) {
            if (!is_array($locations_data)) {
                return [];
            }
    
            $normalized = [];
    
            foreach ($locations_data as $key => $value) {
                $key = strtolower(trim((string)$key));
    
                if ($key === '') {
                    continue;
                }
    
                $list = $clean_list($value, 'upper');
    
                if (!empty($list)) {
                    $normalized[$key] = $list;
                }
            }
    
            return $normalized;
        };
    
        $build_in_condition = function ($field, $values) {
            $values = array_values(array_filter($values, function ($v) {
                return trim((string)$v) !== '';
            }));
    
            if (empty($values)) {
                return '';
            }
    
            $escaped = [];
    
            foreach ($values as $value) {
                $escaped[] = $this->db->escape($value);
            }
    
            return ' AND ' . $field . ' IN (' . implode(',', $escaped) . ')';
        };
    
        /*
        |--------------------------------------------------------------------------
        | Normalize locations
        |--------------------------------------------------------------------------
        */
        if (empty($locations) && isset($this->locations)) {
            $locations = $this->locations;
        }
    
        $locations = $normalize_locations($locations);
    
        /*
        |--------------------------------------------------------------------------
        | Base where
        |--------------------------------------------------------------------------
        */
        $where = 'enquiry.is_deleted = 0';
        $where .= ' AND YEAR(enquiry.check_in_date) = ' . (int)$year;
    
        /*
        |--------------------------------------------------------------------------
        | Company filter
        |--------------------------------------------------------------------------
        */
        $company_id = $get_param('company_id');
    
        if ($company_id !== '') {
            $where .= ' AND enquiry.company_id = ' . $this->db->escape($company_id);
        }
    
        /*
        |--------------------------------------------------------------------------
        | Booking type and location filter
        |--------------------------------------------------------------------------
        */
        $location = strtolower($get_param('location'));
        $booking_type = strtoupper($get_param('booking_type'));
    
        if ($booking_type === '') {
            $booking_type = 'ALL';
        }
    
        if ($location !== '' && $location !== 'all') {
    
            if ($location === 'combo') {
    
                $where .= ' AND enquiry.enquiry_no LIKE "CMB%"';
    
            } elseif (isset($locations[$location]) && !empty($locations[$location])) {
    
                if ($booking_type === 'ALL') {
    
                    $where .= $build_in_condition('enquiry.enquiry_abbr', $locations[$location]);
    
                } elseif ($booking_type === 'CMB') {
    
                    $where .= ' AND enquiry.enquiry_no LIKE "CMB%"';
    
                } else {
    
                    if (in_array($booking_type, $locations[$location], true)) {
                        $where .= ' AND enquiry.enquiry_abbr = ' . $this->db->escape($booking_type);
                    } else {
                        // Wrong combination, example: location=georgia and booking_type=FAZ
                        $where .= ' AND 1 = 0';
                    }
                }
    
            } else {
    
                // Invalid or blank location key. Do not access $locations[$location].
                if ($booking_type !== 'ALL') {
                    if ($booking_type === 'CMB') {
                        $where .= ' AND enquiry.enquiry_no LIKE "CMB%"';
                    } else {
                        $where .= ' AND enquiry.enquiry_abbr = ' . $this->db->escape($booking_type);
                    }
                }
            }
    
        } else {
    
            if ($booking_type !== '' && $booking_type !== 'ALL') {
    
                if ($booking_type === 'CMB') {
                    $where .= ' AND enquiry.enquiry_no LIKE "CMB%"';
                } else {
                    $where .= ' AND enquiry.enquiry_abbr = ' . $this->db->escape($booking_type);
                }
            }
        }
    
        /*
        |--------------------------------------------------------------------------
        | Follow-up status
        |--------------------------------------------------------------------------
        */
        $followup_status = $get_param('followup_status');
    
        if ($followup_status !== '') {
            $where .= ' AND enquiry.status = ' . $this->db->escape($followup_status);
        }
    
        /*
        |--------------------------------------------------------------------------
        | Date range filters - query received
        |--------------------------------------------------------------------------
        */
        $from_date = $get_param('from');
    
        if ($from_date !== '') {
            $where .= ' AND enquiry.query_received_date >= ' . $this->db->escape($from_date);
        }
    
        $to_date = $get_param('to');
    
        if ($to_date !== '') {
            $where .= ' AND enquiry.query_received_date <= ' . $this->db->escape($to_date);
        }
    
        /*
        |--------------------------------------------------------------------------
        | Query number
        |--------------------------------------------------------------------------
        */
        $query_number = $get_param('query_number');
    
        if ($query_number !== '') {
            $where .= ' AND enquiry.enquiry_no = ' . $this->db->escape($query_number);
        }
    
        /*
        |--------------------------------------------------------------------------
        | Staff filter
        |--------------------------------------------------------------------------
        */
        $staff_id = $get_param('staff_id');
    
        if ($staff_id !== '' && strtolower($staff_id) !== 'all') {
            $staff_ids = $clean_list($staff_id, 'none');
    
            if (!empty($staff_ids)) {
                $where .= $build_in_condition('enquiry.file_handle_by', $staff_ids);
            }
        }
    
        /*
        |--------------------------------------------------------------------------
        | Sales filter
        |--------------------------------------------------------------------------
        */
        $sales_id = $get_param('sales');
    
        if ($sales_id !== '') {
            $where .= ' AND enquiry.sales_admin_id = ' . (int)$sales_id;
        }
    
        /*
        |--------------------------------------------------------------------------
        | Guests number range
        |--------------------------------------------------------------------------
        */
        $guests_number = $get_param('guests_number');
    
        if ($guests_number !== '') {
            $guests_arr = explode('-', $guests_number);
    
            $guest_min = isset($guests_arr[0]) ? trim($guests_arr[0]) : '';
            $guest_max = isset($guests_arr[1]) ? trim($guests_arr[1]) : '';
    
            if ($guest_min !== '') {
                $where .= ' AND (enquiry.number_persons + enquiry.number_child) >= ' . (int)$guest_min;
            }
    
            if ($guest_max !== '' && strtolower($guest_max) !== 'above') {
                $where .= ' AND (enquiry.number_persons + enquiry.number_child) <= ' . (int)$guest_max;
            }
        }
    
        /*
        |--------------------------------------------------------------------------
        | Check-in date range
        |--------------------------------------------------------------------------
        */
        $checkin_from = $get_param('checkin_from');
    
        if ($checkin_from !== '') {
            $where .= ' AND enquiry.check_in_date >= ' . $this->db->escape($checkin_from);
        }
    
        $checkout_to = $get_param('checkout_to');
    
        if ($checkout_to !== '') {
            $where .= ' AND enquiry.check_in_date <= ' . $this->db->escape($checkout_to);
        }
    
        /*
        |--------------------------------------------------------------------------
        | Location-based filter for non-superadmin users
        |--------------------------------------------------------------------------
        */
        if ($this->session->userdata('admin_type') !== 'superadmin' && $this->router->fetch_class() === 'enquiry') {
    
            $session_locations = $clean_list($this->session->userdata('locations'), 'lower');
            $all_locations = [];
    
            foreach ($session_locations as $loc) {
                $loc = strtolower(trim($loc));
    
                if ($loc === '') {
                    continue;
                }
    
                if (isset($locations[$loc]) && is_array($locations[$loc])) {
                    $all_locations = array_merge($all_locations, $locations[$loc]);
                }
            }
    
            $all_locations = array_values(array_unique(array_filter($all_locations)));
    
            if (!empty($all_locations)) {
                $where .= $build_in_condition('enquiry.enquiry_abbr', $all_locations);
            }
        }
    
        /*
        |--------------------------------------------------------------------------
        | Country / State / City filters
        |--------------------------------------------------------------------------
        */
        $country = strtolower($get_param('country'));
        $state = strtolower($get_param('state'));
        $city = strtolower($get_param('city'));
    
        $join = '';
    
        if ($country !== '' || $state !== '' || $city !== '') {
            $join .= ' JOIN company_details ON company_details.company_id = enquiry.company_details_id ';
        }
    
        if ($country !== '') {
            $where .= ' AND LOWER(company_details.country) = ' . $this->db->escape($country);
        }
    
        if ($state !== '') {
            $states = $clean_list($state, 'lower');
    
            if (!empty($states)) {
                $where .= $build_in_condition('LOWER(company_details.state)', $states);
            }
        }
    
        if ($city !== '') {
            $cities = $clean_list($city, 'lower');
    
            if (!empty($cities)) {
                $where .= $build_in_condition('LOWER(company_details.city)', $cities);
            }
        }
    
        /*
        |--------------------------------------------------------------------------
        | Final SQL query
        |--------------------------------------------------------------------------
        */
        $sql = "
            SELECT LOWER(enquiry.status) AS status, COUNT(DISTINCT enquiry.id) AS status_cnt
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            $join
            WHERE $where
            GROUP BY LOWER(enquiry.status)
        ";
    
        $query = $this->db->query($sql);
    
        $counts = $query->result();
        $new_arr = [];
    
        foreach ($counts as $row) {
            $new_arr[$row->status] = $row->status_cnt;
        }
    
        return $new_arr;
    }
    
    // 14-11-2025
    public function admin_enquiry_status_count($locations = '')
    {
        $where = 'enquiry.is_deleted = 0';
        $year = date('Y');

        if ($this->router->fetch_class() == 'dashboard') {
            $where_and = ($where != '') ? ' AND ' : '';
            // $where .= $where_and . ' enquiry.check_in_date >= "2025-01-01" ';
            $where .= $where_and . ' enquiry.check_in_date BETWEEN "' . $year . '-01-01" AND "' . $year . '-12-31" ';
        }

        if ($this->input->get('company_id') != '') {
            $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
        }

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'all' && $this->input->get('location') != 'all') {
                $where .= ' AND enquiry.enquiry_abbr IN ("' . implode('","', $locations[$this->input->get('location')]) . '")';
            } else if ($booking_type != 'all') {
                $where .= ' AND enquiry.enquiry_abbr = "' . $booking_type . '"';
            }
        }

        if (!empty($this->input->get('followup_status'))) {
            $followup_status = urldecode($this->input->get('followup_status'));
            $where .= ' AND enquiry.status = "' . $followup_status . '"';
        }

        if (!empty($this->input->get('from'))) {
            $from_date = urldecode($this->input->get('from'));
            $where .= ' AND enquiry.query_received_date >= "' . $from_date . '"';
        }

        if (!empty($this->input->get('to'))) {
            $to_date = urldecode($this->input->get('to'));
            $where .= ' AND enquiry.query_received_date <= "' . $to_date . '"';
        }

        if (!empty($this->input->get('query_number'))) {
            $query_number = urldecode($this->input->get('query_number'));
            $where .= ' AND enquiry.enquiry_no = "' . $query_number . '"';
        }

        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $staff_id = urldecode($this->input->get('staff_id'));
            $where .= ' AND enquiry.file_handle_by = "' . $staff_id . '"';
        }

        if ($this->session->userdata('admin_type') != 'superadmin' && $this->router->fetch_class() == 'enquiry') {
            $assigned_loc = implode('","', $locations[$this->session->userdata('locations')]);
            $where .= ' AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
        }

        if (!empty($this->input->get('confirm_cnt'))) {
            $country = $this->input->get('country');
            $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia'  => 'GE', 'Belarus'  => 'BE', 'Armenia'  => 'AR', 'Uzbekistan'  => 'UZ',];

            $query = 'SELECT followups.enquiry_id FROM followups ';
            $query .= 'WHERE followups.id IN ( SELECT MAX(followups.id) FROM followups ';
            $query .= 'WHERE SUBSTRING(enquiry.enquiry_abbr, 2, 2) = "' . $countryMapping[$country] . '"';
            $query .= 'WHERE followups.date = "' . date('Y-m-d') . '" GROUP BY followups.enquiry_id) AND followups.followup_status="confirm"';
            $result = $this->common_model->custom_query($query);
            $where_in = [];
            foreach ($result as $list) {
                $where_in[] = $list->enquiry_id;
            }
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.id IN (' . implode(",", !empty($where_in) ? $where_in : [0]) . ')';
        }

        if ($where != '') {
            $where = ' WHERE ' . $where;
        }

        // Fetching grouped data by country and status
        $query = $this->db->query('
            SELECT enquiry.enquiry_abbr, enquiry.status, COUNT(enquiry.status) AS status_cnt 
            FROM enquiry 
            ' . $where . ' 
            GROUP BY enquiry.enquiry_abbr, enquiry.status
        ');

        // $counts = $query->result();
        // $result = [];

        // $countryMapping = [
        //     'FKZ' => 'Kazakhstan', 'GKZ' => 'Kazakhstan', 'IKZ' => 'Kazakhstan',
        //     'FAZ' => 'Azerbaijan', 'GAZ' => 'Azerbaijan', 'IAZ' => 'Azerbaijan',
        //     'FBZ' => 'Belarus',    'GBZ' => 'Belarus',    'IBZ' => 'Belarus',
        //     'FGE' => 'Georgia',    'GGE' => 'Georgia',    'IGE' => 'Georgia',
        //     'FAR' => 'Armenia',    'GAR' => 'Armenia',    'IAR' => 'Armenia',
        //     'FUZ' => 'Uzbekistan', 'GUZ' => 'Uzbekistan', 'IUZ' => 'Uzbekistan'
        // ];
        
        // if (!empty($counts)) {
        //     foreach ($counts as $row) {
        //         $abbr = $row->enquiry_abbr;
        //         // print_r($abbr);
        //         $country = isset($countryMapping[$abbr]) ? $countryMapping[$abbr] : 'Unknown';

        //         if (!isset($result[$country])) {
        //             $result[$country] = ['country' => $country, 'total_status_count' => 0];
        //         }

        //         // Add to status count
        //         if (isset($result[$country][$row->status])) {
        //             $result[$country][$row->status] += $row->status_cnt;
        //         } else {
        //             $result[$country][$row->status] = $row->status_cnt;
        //         }

        //         // Only add to total_status_count if status is one of the 4
        //         if (in_array(strtolower($row->status), ['confirm', 'in-progress', 'pending', 'not-materialized'])) {
        //             $result[$country]['total_status_count'] += $row->status_cnt;
        //         }
        //     }
        // }

        $counts = $query->result();
        $final_data = [];

        foreach ($counts as $row) {
            // If enquiry_abbr contains comma → expand it
            if (strpos($row->enquiry_abbr, ',') !== false) {

                $abbr_list = explode(',', $row->enquiry_abbr);

                foreach ($abbr_list as $abbr) {
                    $new = clone $row;
                    $new->enquiry_abbr = trim($abbr);
                    $final_data[] = $new;
                }

            } else {
                // Single value
                $final_data[] = $row;
            }
        }
        $result = [];

        $countryMapping = [
            'FKZ' => 'Kazakhstan', 'GKZ' => 'Kazakhstan', 'IKZ' => 'Kazakhstan',
            'FAZ' => 'Azerbaijan', 'GAZ' => 'Azerbaijan', 'IAZ' => 'Azerbaijan',
            'FBZ' => 'Belarus',    'GBZ' => 'Belarus',    'IBZ' => 'Belarus',
            'FGE' => 'Georgia',    'GGE' => 'Georgia',    'IGE' => 'Georgia',
            'FAR' => 'Armenia',    'GAR' => 'Armenia',    'IAR' => 'Armenia',
            'FUZ' => 'Uzbekistan', 'GUZ' => 'Uzbekistan', 'IUZ' => 'Uzbekistan'
        ];

        
        if (!empty($final_data)) {
            foreach ($final_data as $row) {
                $abbr = $row->enquiry_abbr;
                $country = isset($countryMapping[$abbr]) ? $countryMapping[$abbr] : 'Unknown';

                if (!isset($result[$country])) {
                    $result[$country] = [
                        'country' => $country,
                        'total_status_count' => 0,
                        'confirm' => 0,
                        'in-progress' => 0,
                        'pending' => 0,
                        'not-materialized' => 0,
                        'cancel-at-arrival' => 0
                    ];
                }

                // Add count to respective status
                $result[$country][$row->status] += $row->status_cnt;

                // Only add these statuses to total
                if (in_array(strtolower($row->status), ['confirm', 'in-progress', 'pending', 'not-materialized'])) {
                    $result[$country]['total_status_count'] += $row->status_cnt;
                }
            }
        }

        // Special count for arrivals if on dashboard
        if ($this->router->fetch_class() == 'dashboard') {
            $query_arrivals = $this->db->query('
                SELECT enquiry.status, COUNT(enquiry.status) AS status_cnt 
                FROM enquiry 
                JOIN arrivals ON arrivals.enquiry_id = enquiry.id 
                ' . $where . ' AND enquiry.status="confirm" 
                GROUP BY enquiry.status
            ');
            $counts_arr = $query_arrivals->result();
            if (!empty($counts_arr)) {
                $new_arr[$counts_arr[0]->status] = $counts_arr[0]->status_cnt;
            }
        }

        
        $revenue_sql = "SELECT 
                CASE
                    WHEN enquiry.enquiry_abbr IN ('FKZ', 'GKZ', 'IKZ') THEN 'Kazakhstan'
                    WHEN enquiry.enquiry_abbr IN ('FAZ', 'GAZ', 'IAZ') THEN 'Azerbaijan'
                    WHEN enquiry.enquiry_abbr IN ('FBZ', 'GBZ', 'IBZ') THEN 'Belarus'
                    WHEN enquiry.enquiry_abbr IN ('FGE', 'GGE', 'IGE') THEN 'Georgia'
                    WHEN enquiry.enquiry_abbr IN ('FAR', 'GAR', 'IAR') THEN 'Armenia'
                    WHEN enquiry.enquiry_abbr IN ('FUZ', 'GUZ', 'IUZ') THEN 'Uzbekistan'
                    ELSE 'Unknown'
                END AS country,
            
                SUM(CASE 
                        WHEN arrivals.currency = 'dollar' 
                        THEN arrivals.client_billing 
                        ELSE 0 
                    END) AS total_billing_dollar,
            
                SUM(CASE 
                        WHEN arrivals.split_number != 0 
                        THEN COALESCE(arrivals.num_adults, 0) + COALESCE(arrivals.num_child, 0)
                        ELSE COALESCE(enquiry.number_persons, 0) + COALESCE(enquiry.number_child, 0)
                    END) AS total_pax
            
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            WHERE enquiry.is_deleted = 0 
                AND enquiry.check_in_date BETWEEN ' {$year}-01-01' AND ' {$year}-12-31'
                AND arrivals.status IN ('complete', 'file-closed', 'in-progress')
                AND enquiry.enquiry_abbr IN (
                    'FKZ', 'GKZ', 'IKZ', 
                    'FAZ', 'GAZ', 'IAZ', 
                    'FBZ', 'GBZ', 'IBZ', 
                    'FGE', 'GGE', 'IGE',
                    'FAR', 'GAR', 'IAR',
                    'FUZ', 'GUZ', 'IUZ'
                )
            GROUP BY country";

        $revenue_data = $this->db->query($revenue_sql)->result();

        foreach ($revenue_data as $row) {
            $country = $row->country;

            if (!isset($result[$country])) {
                $result[$country] = ['country' => $country];
            }
            $result[$country]['total_pax'] = (int) $row->total_pax;
            $result[$country]['total_billing_dollar'] = (float) $row->total_billing_dollar;
        }

        return array_values($result);
    }

    public function arrival_status_count()
    {
        $year = date('Y');
        $where = 'WHERE 1=1';
        //   if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
        //         $where_and = ($where != '') ? ' AND ' : '';
        //         $where .= $where_and . 'date(enquiry.check_in_date) >="' . $this->input->get('date_from') . '" AND date(enquiry.check_in_date) <="' . $this->input->get('date_to') . '"';
        //     }
    
        if ($this->input->get('date_from') == '' && $this->input->get('date_to') == '') {
            $where .= ' AND YEAR(enquiry.check_in_date) = '. $year;
        }

        // if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
        //     $where .= ' AND date(enquiry.check_in_date) >="' . $this->input->get('date_from') . '" AND date(enquiry.check_in_date) <="' . $this->input->get('date_to') . '"';
        // }
        if ($this->input->get('date_from') != '' && $this->input->get('date_to') != '') {
            $where_and = ($where != '') ? ' AND ' : '';
            // $where .= $where_and . '(
            //     (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
            //     OR
            //     (enquiry.split_count != 0 AND DATE(arrival_hotel_details.checkin_date) >= "' . $this->input->get('date_from') . '" AND DATE(arrival_hotel_details.checkin_date) <= "' . $this->input->get('date_to') . '")
            // )';
            $where .= $where_and . '(
                    (enquiry.split_count = 0 AND DATE(enquiry.check_in_date) >= "' . $this->input->get('date_from') . '" AND DATE(enquiry.check_in_date) <= "' . $this->input->get('date_to') . '")
                    OR
                    (enquiry.split_count != 0 AND (
                        SELECT DATE(MIN(ahd.checkin_date))
                        FROM arrival_hotel_details ahd
                        WHERE ahd.arrival_id = arrivals.id
                    ) >= "' . $this->input->get('date_from') . '" 
                    AND (
                        SELECT DATE(MIN(ahd.checkin_date))
                        FROM arrival_hotel_details ahd
                        WHERE ahd.arrival_id = arrivals.id
                    ) <= "' . $this->input->get('date_to') . '")
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
                $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $loc . '")';
                //$this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
            } else if ($booking_type != 'all') {
                $where_and = ($where != '') ? ' AND ' : '';
                $where .= $where_and . 'enquiry.enquiry_abbr = "' . $booking_type . '"';
                //$this->db->where('enquiry.enquiry_abbr',$booking_type);	
            }
        }

        if ($this->input->get('company_id') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
        }

        if ($this->session->userdata('admin_type') != 'superadmin') {
            $where_and = ($where != '') ? ' AND ' : '';
            // $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
            $session_locations = explode(',', $this->session->userdata('locations'));
            $all_locations = [];
            foreach ($session_locations as $loc) {
                if (isset($this->locations[$loc])) {
                    $all_locations = array_merge($all_locations, $this->locations[$loc]);
                }
            }
            $assigned_loc = implode('","', $all_locations);
            $where .= $where_and . 'enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
        }

        $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
        // if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
        //     $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "' . urldecode($this->input->get('country')) . '"';
        // }

        if ($this->input->get('country') <> '' && $this->input->get('country') <> 'all') {
            $country = $this->input->get('country');
            if(strlen($country) > 1){
                $countryMapping = ['Azerbaijan' => 'AZ', 'Kazakhstan' => 'KZ', 'Georgia'    => 'GE', 'Belarus'    => 'BE', 'Armenia'    => 'AR', 'Uzbekistan'    => 'UZ',];
                $abbr = $countryMapping[$country];
            }else{ $abbr = $country; }
            $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 2) = "' . $abbr . '"';
        }

        if ($this->input->get('query_number') <> '') {
            $enquiry_join .= ' AND enquiry.enquiry_no = "' . urldecode($this->input->get('query_number')) . '"';
        }
        
        $where .= " AND enquiry.is_deleted = 0";

        // $query = $this->db->query('SELECT t.status_cnt,t.status 
        //     FROM (SELECT arrivals.status,COUNT(arrivals.status) AS status_cnt FROM arrivals JOIN enquiry ON (' . $enquiry_join . ') ' . $where . ' GROUP BY arrivals.status) t GROUP BY t.status');
        
        
        // $query = $this->db->query('SELECT t.status_cnt, t.status 
        // FROM (
        //     SELECT arrivals.status, COUNT(arrivals.status) AS status_cnt 
        //     FROM arrivals 
        //     JOIN enquiry ON (' . $enquiry_join . ')
        //     LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
        //     ' . $where . '
        //     GROUP BY arrivals.status
        // ) t 
        // GROUP BY t.status');

        
        $query = $this->db->query('
            SELECT t.status_cnt, t.status 
            FROM (
                SELECT a.status, COUNT(*) AS status_cnt
                FROM (
                    SELECT arrivals.id, arrivals.enquiry_id, arrivals.status
                    FROM arrivals 
                    JOIN enquiry ON (' . $enquiry_join . ')
                    LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
                    ' . $where . '
                    GROUP BY arrivals.id, arrivals.enquiry_id
                ) a
                GROUP BY a.status
            ) t 
            GROUP BY t.status
        ');

        $counts = $query->result();

        $new_arr = [];
        if (!empty($counts)) {
            foreach ($counts as $list) {
                $new_arr[$list->status] = $list->status_cnt;
            }
        }
        return $new_arr;
    }

    public function count_total_enquiry_status_all()
    {
        $this->db->select("
            YEAR(enquiry.check_in_date) as year,
            COUNT(*) as total,
            SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) as confirm_count,
            SUM(CASE WHEN enquiry.status = 'in-progress' THEN 1 ELSE 0 END) as in_progress_count,
            SUM(CASE WHEN enquiry.status = 'not-materialized' THEN 1 ELSE 0 END) as not_materialized_count,
            SUM(CASE WHEN enquiry.status = 'pending' THEN 1 ELSE 0 END) as pending_count
        ");
        $this->db->from('enquiry');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);
        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();
        return $query->result_array();
    }


    public function count_total_enquiry_status()
    {
        $user_id = $this->session->userdata('id');

        $this->db->select("
            YEAR(enquiry.check_in_date) AS year,
            COUNT(*) AS total,
            SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
            SUM(CASE WHEN enquiry.status = 'in-progress' THEN 1 ELSE 0 END) AS in_progress_count,
            SUM(CASE WHEN enquiry.status = 'not-materialized' THEN 1 ELSE 0 END) AS not_materialized_count,
            SUM(CASE WHEN enquiry.status = 'pending' THEN 1 ELSE 0 END) AS pending_count
        ");
        
        $this->db->from('enquiry');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->join('admin', 'admin.id = enquiry.added_by', 'left');

        // Apply filters
        $this->db->where("enquiry.check_in_date IS NOT NULL");
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);
        $this->db->where("enquiry.file_handle_by", $user_id);

        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();

        if (!$query) {
            log_message('error', 'Query failed: ' . $this->db->error()['message']);
            return false;
        }

        return $query->result_array();
    }


    public function count_total_arrival_status_all()
    {
        $this->db->select("
            YEAR(enquiry.check_in_date) AS year,
            COUNT(*) AS total,
            SUM(CASE WHEN arrivals.status = 'complete' THEN 1 ELSE 0 END) AS complete,
            SUM(CASE WHEN arrivals.status = 'file-closed' THEN 1 ELSE 0 END) AS file_closed_count,
            SUM(CASE WHEN arrivals.status = 'cancel' THEN 1 ELSE 0 END) AS cancel_count,
            SUM(CASE WHEN arrivals.status = 'in-progress' THEN 1 ELSE 0 END) AS in_progress
        ");
        $this->db->from('arrivals');
        $this->db->join('enquiry', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->where("enquiry.check_in_date IS NOT NULL");
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);
        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();

        if (!$query) {
            log_message('error', 'Database query failed: ' . $this->db->error()['message']);
            return false;
        }

        return $query->result_array();
    }


    public function count_total_arrival_status()
    {   
        // Get logged-in user ID
        $user_id = $this->session->userdata('id');

        $this->db->select("
            YEAR(enquiry.check_in_date) AS year,
            COUNT(*) AS total,
            SUM(CASE WHEN arrivals.status = 'complete' THEN 1 ELSE 0 END) AS complete,
            SUM(CASE WHEN arrivals.status = 'file-closed' THEN 1 ELSE 0 END) AS file_closed_count,
            SUM(CASE WHEN arrivals.status = 'cancel' THEN 1 ELSE 0 END) AS cancel_count,
            SUM(CASE WHEN arrivals.status = 'in-progress' THEN 1 ELSE 0 END) AS in_progress

        ");
        
        $this->db->from('arrivals');
        $this->db->join('enquiry', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->where("enquiry.check_in_date IS NOT NULL");
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);

        // Filter by logged-in user's handling
        $this->db->where("arrivals.handling_staff_id", $user_id);

        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();

        if (!$query) {
            log_message('error', 'Query failed: ' . $this->db->error()['message']);
            return false;
        }

        return $query->result_array();
    }
    
    // get only sales internation user data of query chart
    public function count_total_enquiry_status_by_abbr()
    {
        $loggedInUserId = $this->session->userdata('id');

        $this->db->select("
            YEAR(enquiry.check_in_date) AS year,
            COUNT(*) AS total,
            SUM(CASE WHEN enquiry.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_count,
            SUM(CASE WHEN enquiry.status = 'in-progress' THEN 1 ELSE 0 END) AS in_progress_count,
            SUM(CASE WHEN enquiry.status = 'not-materialized' THEN 1 ELSE 0 END) AS not_materialized_count,
            SUM(CASE WHEN enquiry.status = 'pending' THEN 1 ELSE 0 END) AS pending_count
        ");
        $this->db->from('enquiry');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);
        $this->db->where("enquiry.sales_admin_id", $loggedInUserId);
        $this->db->where_in("enquiry.enquiry_abbr", ['IKZ', 'IAZ', 'IAR', 'IBZ', 'IGE']);
        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();
        return $query->result_array();
    }
    
    // get only sales internation user data of arrival chart
    public function count_total_arrival_status_by_abbr()
    {
        $loggedInUserId = $this->session->userdata('id');

        $this->db->select("
            YEAR(enquiry.check_in_date) AS year,
            COUNT(*) AS total,
            SUM(CASE WHEN arrivals.status = 'complete' THEN 1 ELSE 0 END) AS complete,
            SUM(CASE WHEN arrivals.status = 'file-closed' THEN 1 ELSE 0 END) AS file_closed_count,
            SUM(CASE WHEN arrivals.status = 'cancel' THEN 1 ELSE 0 END) AS cancel_count,
            SUM(CASE WHEN arrivals.status = 'in-progress' THEN 1 ELSE 0 END) AS in_progress
        ");
        $this->db->from('arrivals');
        $this->db->join('enquiry', 'arrivals.enquiry_id = enquiry.id', 'left');
        $this->db->where("enquiry.check_in_date IS NOT NULL");
        $this->db->where("YEAR(enquiry.check_in_date) >", 2023);
        $this->db->where("YEAR(enquiry.check_in_date) <", 2027);
        $this->db->where("enquiry.is_deleted", 0);
        $this->db->where("enquiry.sales_admin_id", $loggedInUserId);
        $this->db->where_in("enquiry.enquiry_abbr", ['IKZ', 'IAZ', 'IAR', 'IBZ', 'IGE']);
        $this->db->group_by("YEAR(enquiry.check_in_date)");
        $this->db->order_by("YEAR(enquiry.check_in_date)", "ASC");

        $query = $this->db->get();

        if (!$query) {
            log_message('error', 'Database query failed: ' . $this->db->error()['message']);
            return false;
        }

        return $query->result_array();
    }
   
}
