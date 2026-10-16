<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Enquiry_model extends CI_Model{

    public function new_enquiry()
	{
        $agent  = explode('_',$this->security->xss_clean($this->input->post('agent')));
        $child_age = $this->input->post('child_age');
		if(!empty($child_age)){
			$child_age = array_map('intval', $child_age);
		}
            
		$data = array(
				'mode'  => $this->security->xss_clean($this->input->post('mode')),
		        //'reference_by' => $this->security->xss_clean($this->input->post('reference_by')),
				'company_id'    => $this->security->xss_clean($this->input->post('company_id')),
    			'company_details_id'    => $agent[0],
    			//'enquiry_for'       => $this->security->xss_clean($this->input->post('enquiry_for')),
				'enquiry_abbr'       => $this->security->xss_clean($this->input->post('booking_type')),
				'enquiry_sequence'       => $this->security->xss_clean($this->input->post('file_seq')),
				'number_persons'       => $this->security->xss_clean($this->input->post('number_persons')),
				'number_child'      => $this->security->xss_clean($this->input->post('number_child')),
				'check_in_date'       => $this->security->xss_clean($this->input->post('check_in')),
				'check_out_date'       => $this->security->xss_clean($this->input->post('check_out')),
				'query_received_date'       => $this->security->xss_clean($this->input->post('query_received_on')),
			 'entery_date'       => !empty($manual_received_on) ? $manual_received_on : NULL,   // ✅ fixed
				'number_of_nights' =>  $this->security->xss_clean($this->input->post('number_of_nights')),
    			'enquiry_type'      => $this->security->xss_clean($this->input->post('enquiry_type')),
    			//'status'            => $this->security->xss_clean($this->input->post('status')),
    			'remarks'           => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),		
    			'added_by'          => $this->security->xss_clean($this->session->userdata('id')),
    			'enquiry_no'        => $this->security->xss_clean($this->input->post('enquiry_no')),		
    			'date'              => date('Y-m-d H:i:s'),
				'file_handle_by'    => $this->security->xss_clean($this->input->post('file_handle_by')),
				'sales_admin_id'    => $this->security->xss_clean($this->input->post('sales')),
				'child_age'			=> !empty($child_age) ? json_encode($child_age) : NULL,
			);

				$result = $this->db->insert('enquiry',$data);
				$enquiry_id = $this->db->insert_id();
			if($result){
					log_user_activity('Query Board B2B Add New',$this->session->userdata('id'), 'B2B Add New: '. json_encode($data));
				$this->load->helper('whatsapp_email_messages');
				query_submission(['enquiry_id'=>$enquiry_id]);
				return true;
		}else{
				return false;
		}
    }
 

    // combo insert functionality 
    public function new_combo_enquiry()
	{
		$agent = explode('_', $this->security->xss_clean($this->input->post('agent')));
		// Get booking types and convert array to string
		$booking_types = $this->input->post('booking_type');
		$enquiry_abbr = '';
		
		if (is_array($booking_types)) {
			$enquiry_abbr = implode(',', $booking_types); // Convert array to comma-separated string
		} else {
			$enquiry_abbr = $booking_types; // Single value
		}
		
		// Main enquiry data
		$data = array(
			'mode' => $this->security->xss_clean($this->input->post('mode')),
			'company_id' => $this->security->xss_clean($this->input->post('company_id')),
			'company_details_id' => $agent[0],
			'enquiry_abbr' => $this->security->xss_clean($enquiry_abbr),
			'enquiry_sequence' => $this->security->xss_clean($this->input->post('file_seq')),
			// Remove individual booking details from main enquiry
			'query_received_date' => $this->security->xss_clean($this->input->post('query_received_on')),
			'enquiry_type' => $this->security->xss_clean($this->input->post('enquiry_type')),
			'remarks' => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),
			'added_by' => $this->security->xss_clean($this->session->userdata('id')),
			'enquiry_no' => $this->security->xss_clean($this->input->post('enquiry_no')),
			'date' => date('Y-m-d H:i:s'),
			'file_handle_by' => $this->security->xss_clean($this->input->post('file_handle_by')),
			'sales_admin_id' => $this->security->xss_clean($this->input->post('sales')),
		);

		// Start transaction
		$this->db->trans_start();

		// Insert main enquiry
		$result = $this->db->insert('enquiry', $data);
		$enquiry_id = $this->db->insert_id();

		if ($result && $enquiry_id) {
			// Get all selected booking types
			$booking_types = $this->input->post('booking_type');
			
			if (is_array($booking_types)) {
				// In your new_combo_enquiry method, update the field name processing:
				foreach ($booking_types as $booking_type) {
					// Create safe field name (same as in JavaScript)
					$safe_booking_type = strtolower(str_replace([' ', '-'], '_', $booking_type));
					
					$combo_data = array(
						'enquiry_id' => $enquiry_id,
						'enquiry_abbr' => $booking_type,
						'check_in_date' => $this->input->post('check_in_' . $safe_booking_type),
						'check_out_date' => $this->input->post('check_out_' . $safe_booking_type),
						'no_of_person' => $this->input->post('number_persons_' . $safe_booking_type),
						'no_of_child' => $this->input->post('number_child_' . $safe_booking_type),
						'no_of_nights' => $this->input->post('number_of_nights_' . $safe_booking_type)
					);
					
					$this->db->insert('combo_enquiry', $combo_data);
				}
			}

			// Complete transaction
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				// Transaction failed
				$this->db->trans_rollback();
				return false;
			} else {
				// Transaction successful
				log_user_activity('Query Board B2B Add New Combo', $this->session->userdata('id'), 'B2B Add New Combo: ' . json_encode($data));
				// $this->load->helper('whatsapp_email_messages');
				// query_submission(['enquiry_id' => $enquiry_id]);
				return true;
			}
		} else {
			$this->db->trans_rollback();
			return false;
		}
	}
	
    // 	combo update functionality
	public function update_combo_enquiry($enquiry_id)
	{
		$agent = explode('_', $this->security->xss_clean($this->input->post('agent')));
		$booking_types = $this->input->post('booking_type');

		// Convert booking types array to string
		$enquiry_abbr = is_array($booking_types) ? implode(',', $booking_types) : $booking_types;

		// Main enquiry data
		$data = array(
			'mode' => $this->security->xss_clean($this->input->post('mode')),
			'company_id' => $this->security->xss_clean($this->input->post('company_id')),
			'company_details_id' => isset($agent[0]) ? $agent[0] : null,
			'enquiry_abbr' => $this->security->xss_clean($enquiry_abbr),
			'query_received_date' => $this->security->xss_clean($this->input->post('query_received_on')),
			'enquiry_type' => $this->security->xss_clean($this->input->post('enquiry_type')),
			'added_by' => $this->security->xss_clean($this->session->userdata('id')),
			'remarks' => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),
			'file_handle_by' => $this->security->xss_clean($this->input->post('file_handle_by')),
			'sales_admin_id' => $this->security->xss_clean($this->input->post('sales')),
		);

		// Start transaction
		$this->db->trans_start();

		// Update main enquiry table
		$this->db->where('id', $enquiry_id);
		$this->db->update('enquiry', $data);

		// Get existing combo records
		$existing = $this->db
			->select('enquiry_abbr')
			->from('combo_enquiry')
			->where('enquiry_id', $enquiry_id)
			->get()
			->result_array();

		$existing_types = array_column($existing, 'enquiry_abbr');
		$new_types = is_array($booking_types) ? $booking_types : [];

		// Handle updates and inserts
		foreach ($new_types as $booking_type) {
			$safe_booking_type = strtolower(str_replace([' ', '-'], '_', $booking_type));

			$combo_data = array(
				'enquiry_id' => $enquiry_id,
				'enquiry_abbr' => $booking_type,
				'check_in_date' => $this->input->post('check_in_' . $safe_booking_type),
				'check_out_date' => $this->input->post('check_out_' . $safe_booking_type),
				'no_of_person' => $this->input->post('number_persons_' . $safe_booking_type),
				'no_of_child' => $this->input->post('number_child_' . $safe_booking_type),
				'no_of_nights' => $this->input->post('number_of_nights_' . $safe_booking_type)
			);

			if (in_array($booking_type, $existing_types)) {
				// Update existing record
				$this->db->where('enquiry_id', $enquiry_id);
				$this->db->where('enquiry_abbr', $booking_type);
				$this->db->update('combo_enquiry', $combo_data);
			} else {
				// Insert new record
				$this->db->insert('combo_enquiry', $combo_data);
			}
		}

		// Handle deleted booking types (remove ones not in new selection)
		$to_delete = array_diff($existing_types, $new_types);
		if (!empty($to_delete)) {
			$this->db->where('enquiry_id', $enquiry_id);
			$this->db->where_in('enquiry_abbr', $to_delete);
			$this->db->delete('combo_enquiry');
		}

		// Complete transaction
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			log_user_activity('Query Board B2B Update Combo', $this->session->userdata('id'), 'B2B Update Combo: ' . json_encode($data));
			return true;
		}
	}
	

    // updated 28 april 2026
    public function count_all_enquiry($locations)
	{
		$this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id');
		$this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
		$this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
		//$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
		$this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
		$this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
		
		$this->db->join("(SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange 
				FROM followups 
				GROUP BY enquiry_id) f_sum", 
				"f_sum.enquiry_id = enquiry.id", "LEFT");
				
		// Determine if the current filter is specifically for CMB files
		$location_input = $this->input->get('location');
		$logged_type  = $this->session->userdata('type');
		$booking_type_input = $this->input->get('booking_type');
		$is_cmb_filter = false;

		if (!empty($location_input) && strtolower($location_input) == 'combo') {
			$is_cmb_filter = true;
		} elseif (!empty($booking_type_input)) {
			$booking_type = urldecode($booking_type_input);
			if ($booking_type == 'CMB') {
				$is_cmb_filter = true;
			} elseif (!empty($location_input) && strtolower($location_input) == 'combo' && $booking_type == 'all') {
				$is_cmb_filter = true;
			}
		}

		if ($logged_type == '5' || $logged_type == '6') {
			$this->db->join("(SELECT enquiry_id, MIN(check_in_date) as min_check_in_date 
							FROM combo_enquiry 
							GROUP BY enquiry_id) ce", 
							"ce.enquiry_id = enquiry.id", "LEFT");
		} elseif ($is_cmb_filter || $logged_type == '1') {
			// For other users when explicitly filtering by combo
			$this->db->join("(SELECT enquiry_id, MIN(check_in_date) as min_check_in_date 
							FROM combo_enquiry 
							GROUP BY enquiry_id) ce", 
							"ce.enquiry_id = enquiry.id", "LEFT");
		}

		if (!empty($this->input->get('email_exchange'))) {
			$this->db->where('enquiry.status', 'in-progress');
			$email_filter = $this->input->get('email_exchange');
			if ($email_filter == 'hot') {
				// 3 to 6 emails
				$this->db->where('f_sum.total_email_exchange >=', 3);
				$this->db->where('f_sum.total_email_exchange <=', 6);
			}

			if ($email_filter == 'superhot') {
				// 7 and above
				$this->db->where('f_sum.total_email_exchange >=', 7);
			}
		}
		
		$this->db->where('enquiry.is_deleted', '0');
		
		$logged_type  = $this->session->userdata('type');

		if ($logged_type == '5' || $logged_type == '6' && $this->input->get('source') == 'dashboard') {

			$region = $this->session->userdata('region');

			if (!empty($region)) {

				$regions = array_map(
					'strtolower',
					array_map('trim', explode(',', $region))
				);

				$this->db->group_start()
					->where_in('LOWER(company_details.state)', $regions)
					->or_where_in('LOWER(company_details.country)', $regions)
				->group_end();
			}
		}

		if ($this->input->get('company_id') <> '') {
				$company_id = urldecode($this->input->get('company_id'));
				$this->db->where('company_details.company', $company_id);
		}

		if ($this->input->get('location') <> '') {
				$location = strtolower(urldecode($this->input->get('location')));
				if($location == 'combo'){
					$this->db->like('enquiry.enquiry_no','CMB');
				}
		}

		if (!empty($this->input->get('booking_type'))) {
			$booking_type = urldecode($this->input->get('booking_type'));
			
			// Check if location is combo and booking_type is all
			$isComboLocation = (strtolower($this->input->get('location')) == 'combo');
			$isAllBookingType = ($booking_type == 'all');
			$isCMBBookingType = ($booking_type == 'CMB');
			
			if ($isComboLocation && $isAllBookingType) {
				// If location is combo and booking_type is all, show all CMB files
				$this->db->like('enquiry.enquiry_no','CMB');
			} 
			else if ($isCMBBookingType) {
				// If booking_type is CMB, show all CMB files
				$this->db->like('enquiry.enquiry_no','CMB');
			}
			else if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
				$this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
			} 
			else if ($booking_type != 'all') {
				$this->db->where('enquiry.enquiry_abbr', $booking_type);
			}
		}
		
		if ($logged_type == '2') {

			$booking_type = $this->session->userdata('booking_type');

			if (!empty($booking_type)) {

				if (!is_array($booking_type)) {
					$booking_type = array_map('trim', explode(',', $booking_type));
				}

				// Separate CMB and others
				$cmb_exists = in_array('CMB', $booking_type);
				$booking_type = array_diff($booking_type, ['CMB']);

				$this->db->group_start();

				// For normal types (FGE, GGE)
				if (!empty($booking_type)) {
					$this->db->where_in('enquiry.enquiry_abbr', $booking_type);
				}

				// For CMB
				if ($cmb_exists) {
					if (!empty($booking_type)) {
						$this->db->or_like('enquiry.enquiry_no', 'CMB', 'after');
					} else {
						$this->db->like('enquiry.enquiry_no', 'CMB', 'after');
					}
				}

				$this->db->group_end();
			}
		}
		
		if (!empty($this->input->get('followup_status'))) {
				$followup_status = urldecode($this->input->get('followup_status'));
				$this->db->where('enquiry.status', $followup_status);
		}
		if (!empty($this->input->get('from'))) {
				$from_date = urldecode($this->input->get('from'));
				$this->db->where('enquiry.query_received_date >=', $from_date);
		}
		if (!empty($this->input->get('to'))) {
				$to_date = urldecode($this->input->get('to'));
				$this->db->where('enquiry.query_received_date <=', $to_date);
		}
		if (!empty($this->input->get('query_number'))) {
				$query_number = urldecode($this->input->get('query_number'));
				$this->db->where('enquiry.enquiry_no', $query_number);
		}
		
		// if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
		// 		$staff_id = urldecode($this->input->get('staff_id'));
		// 		$this->db->where('enquiry.file_handle_by', $staff_id);
		// }

		if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
			$staff_id = urldecode($this->input->get('staff_id'));
			$staff_ids = explode(',', $staff_id);
			$staff_ids = array_map('trim', $staff_ids);
			$this->db->where_in('enquiry.file_handle_by', $staff_ids);
		}
		
		if ($this->session->userdata('id') == '41') {

			$location = strtolower(
				trim(urldecode($this->input->get('location') ?? ''))
			);

			if (
				$location !== '' &&
				$location !== 'all' &&
				isset($locations[$location]) &&
				!empty($locations[$location])
			) {
				$bookingTypes = is_array($locations[$location])
					? $locations[$location]
					: array_filter(
						array_map('trim', explode(',', $locations[$location]))
					);

				$this->db->where_in(
					'enquiry.enquiry_abbr',
					$bookingTypes
				);
			}
		}

		// if ($this->session->userdata('type') != '1' && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com', 'combo1@kazindmc.com','optimax@kazindmc.com']) && $this->session->userdata('type') != '3') {
		if (!in_array($this->session->userdata('type'), ['1', '3', '5', '6']) && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com','optimax@kazindmc.com']) && $this->session->userdata('combo_access') == 'no') {
			$session_locations = explode(',', $this->session->userdata('locations'));
			$all_locations = [];
			foreach ($session_locations as $loc) {
				if (isset($locations[$loc])) {
					$all_locations = array_merge($all_locations, $locations[$loc]);
				}
			}
			$this->db->where_in('enquiry.enquiry_abbr', $all_locations);
		}

		if ($this->input->get('country') <> '') {
				$country = strtolower(urldecode($this->input->get('country')));
				$this->db->where('LOWER(company_details.country)', $country);
		}

		if ($this->input->get('state') <> '') {
				$state = strtolower(urldecode($this->input->get('state')));
				$arr = explode(',', $state);
				$arr = array_map('trim', $arr);
				if (end($arr) == '') {
				unset($arr[count($arr) - 1]);
				}
				$this->db->where_in('LOWER(company_details.state)', $arr);
		}

		if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
				$city = strtolower(urldecode($this->input->get('city')));
				$arr = explode(',', $city);
				$arr = array_map('trim', $arr);
				if (end($arr) == '') {
				unset($arr[count($arr) - 1]);
				}
				$this->db->where_in('LOWER(company_details.city)', $arr);
		}


		if (!empty($this->input->get('checkin_from'))) {
			$from_date = urldecode($this->input->get('checkin_from'));
			// For type 5/6 OR explicit combo filter, use effective date
			if ($logged_type == '5' || $logged_type == '6' || $is_cmb_filter || $logged_type == '1') {
				$this->db->where('COALESCE(ce.min_check_in_date, enquiry.check_in_date) >=', $from_date);
			} else {
				$this->db->where('enquiry.check_in_date >=', $from_date);
			}
		}

		if (!empty($this->input->get('checkout_to'))) {
			$to_date = urldecode($this->input->get('checkout_to'));
			if ($logged_type == '5' || $logged_type == '6' || $is_cmb_filter || $logged_type == '1') {
				$this->db->where('COALESCE(ce.min_check_in_date, enquiry.check_in_date) <=', $to_date);
			} else {
				$this->db->where('enquiry.check_in_date <=', $to_date);
			}
		}
		
		if (!empty($this->input->get('guests_number'))) {
				$guests_number = urldecode($this->input->get('guests_number'));
				$guests_number = explode('-',$guests_number);
				$this->db->where('(enquiry.number_persons + enquiry.number_child) >=', $guests_number[0]);
				if($guests_number[1] != 'above'){
						$this->db->where('(enquiry.number_persons + enquiry.number_child) <=', $guests_number[1]);
				}
		}
		if (!empty($this->input->get('sales'))){
			$sales_id = urldecode($this->input->get('sales'));
			$this->db->where('enquiry.sales_admin_id', $sales_id);
		}
		
		if ($this->session->userdata('type') == 6) {
			$this->db->like('enquiry.enquiry_abbr', 'I', 'after');
		}
		
		if(!empty($this->input->get('confirm_cnt'))){
				$query = 'SELECT followups.enquiry_id FROM followups ';
				$query .= 'WHERE followups.id IN ( SELECT MAX(followups.id) FROM followups ';
				$query .= 'WHERE followups.date = "'.date('Y-m-d').'" GROUP BY followups.enquiry_id) AND followups.followup_status="confirm"';
				$result = $this->common_model->custom_query($query);
				$where_in=[];
				foreach($result AS $list){
						$where_in[] = $list->enquiry_id;
				}
				$this->db->where_in('enquiry.id',!empty($where_in)?$where_in:[0]);
		}

		$this->db->group_by("CASE 
			WHEN enquiry.enquiry_no LIKE 'CMB%' THEN enquiry.id
			ELSE CONCAT(enquiry.id, '-', COALESCE(arrivals.id, 0))
		END");

		$this->db->order_by('enquiry.id', 'DESC');
		//$this->db->group_by('enquiry.id');
		return $this->db->get('enquiry')->num_rows();
	}
    
    // updated 28 april 2026
    public function all_enquiry($limit='', $offset, $locations)
	{
		$this->db->select('company.name,company_details.*,enquiry.*,enquiry.status as follow_status,admin.name AS staff_name,arrivals.id AS arrival_id,arrivals.split_number,arrivals.num_adults,arrivals.num_child');
		$this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
		$this->db->join('company', 'company.company_id = enquiry.company_id', 'LEFT');
		$this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
		$this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
		
		$this->db->join("(SELECT enquiry_id, SUM(email_exchange) AS total_email_exchange 
					FROM followups 
					GROUP BY enquiry_id) f_sum", 
					"f_sum.enquiry_id = enquiry.id", "LEFT");
					
		 // Determine if the current filter is specifically for CMB files
		$location_input = $this->input->get('location');
		$logged_type  = $this->session->userdata('type');
		$booking_type_input = $this->input->get('booking_type');
		$is_cmb_filter = false;

		if (!empty($location_input) && strtolower($location_input) == 'combo') {
			$is_cmb_filter = true;
		} elseif (!empty($booking_type_input)) {
			$booking_type = urldecode($booking_type_input);
			if ($booking_type == 'CMB') {
				$is_cmb_filter = true;
			} elseif (!empty($location_input) && strtolower($location_input) == 'combo' && $booking_type == 'all') {
				$is_cmb_filter = true;
			}
		}

		if ($logged_type == '5' || $logged_type == '6') {
			$this->db->join("(SELECT enquiry_id, MIN(check_in_date) as min_check_in_date 
							FROM combo_enquiry 
							GROUP BY enquiry_id) ce", 
							"ce.enquiry_id = enquiry.id", "LEFT");
		} elseif ($is_cmb_filter || $logged_type == '1') {
			// For other users when explicitly filtering by combo
			$this->db->join("(SELECT enquiry_id, MIN(check_in_date) as min_check_in_date 
							FROM combo_enquiry 
							GROUP BY enquiry_id) ce", 
							"ce.enquiry_id = enquiry.id", "LEFT");
		}

		if (!empty($this->input->get('email_exchange'))) {
			$this->db->where('enquiry.status', 'in-progress');
			$email_filter = $this->input->get('email_exchange');
			if ($email_filter == 'hot') {
				// 3 to 6 emails
				$this->db->where('f_sum.total_email_exchange >=', 3);
				$this->db->where('f_sum.total_email_exchange <=', 6);
			}

			if ($email_filter == 'superhot') {
				// 7 and above
				$this->db->where('f_sum.total_email_exchange >=', 7);
			}
		}

		$this->db->where('enquiry.is_deleted', '0');

		if ($logged_type == '5' || $logged_type == '6' && $this->input->get('source') == 'dashboard') {
			$region = $this->session->userdata('region');

			if (!empty($region)) {

				$regions = array_map(
					'strtolower',
					array_map('trim', explode(',', $region))
				);

				$this->db->group_start()
					->where_in('LOWER(company_details.state)', $regions)
					->or_where_in('LOWER(company_details.country)', $regions)
				->group_end();
			}
		}

		if ($this->input->get('company_id') <> '') {
                $company_id = urldecode($this->input->get('company_id'));
                $this->db->where('company_details.company', $company_id);
        }
        
        if ($this->input->get('location') <> '') {
                $location = strtolower(urldecode($this->input->get('location')));
				if($location == 'combo'){
					$this->db->like('enquiry.enquiry_no','CMB');
				}
        }

		if (!empty($this->input->get('booking_type'))) {
			$booking_type = urldecode($this->input->get('booking_type'));
			
			// Check if location is combo and booking_type is all
			$isComboLocation = (strtolower($this->input->get('location')) == 'combo');
			$isAllBookingType = ($booking_type == 'all');
			$isCMBBookingType = ($booking_type == 'CMB');
			
			if ($isComboLocation && $isAllBookingType) {
				// If location is combo and booking_type is all, show all CMB files
				$this->db->like('enquiry.enquiry_no','CMB');
			} 
			else if ($isCMBBookingType) {
				// If booking_type is CMB, show all CMB files
				$this->db->like('enquiry.enquiry_no','CMB');
			}
			else if ($booking_type == 'all' && $this->input->get('location') <> 'all') {
				$this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
			} 
			else if ($booking_type != 'all') {
				$this->db->where('enquiry.enquiry_abbr', $booking_type);
			}
		}
		
		if ($logged_type == '2') {

			$booking_type = $this->session->userdata('booking_type');

			if (!empty($booking_type)) {

				if (!is_array($booking_type)) {
					$booking_type = array_map('trim', explode(',', $booking_type));
				}

				// Separate CMB and others
				$cmb_exists = in_array('CMB', $booking_type);
				$booking_type = array_diff($booking_type, ['CMB']);

				$this->db->group_start();

				// For normal types (FGE, GGE)
				if (!empty($booking_type)) {
					$this->db->where_in('enquiry.enquiry_abbr', $booking_type);
				}

				// For CMB
				if ($cmb_exists) {
					if (!empty($booking_type)) {
						$this->db->or_like('enquiry.enquiry_no', 'CMB', 'after');
					} else {
						$this->db->like('enquiry.enquiry_no', 'CMB', 'after');
					}
				}

				$this->db->group_end();
			}
		}
    		
        if (!empty($this->input->get('followup_status'))) {
                $followup_status = urldecode($this->input->get('followup_status'));
                $this->db->where('enquiry.status', $followup_status);
        }
        if (!empty($this->input->get('from'))) {
                $from_date = urldecode($this->input->get('from'));
                $this->db->where('enquiry.query_received_date >=', $from_date);
        }
        if (!empty($this->input->get('to'))) {
                $to_date = urldecode($this->input->get('to'));
                $this->db->where('enquiry.query_received_date <=', $to_date);
        }
        if (!empty($this->input->get('query_number'))) {
                $query_number = urldecode($this->input->get('query_number'));
                $this->db->where('enquiry.enquiry_no', $query_number);
        }
        // if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
        //         $staff_id = urldecode($this->input->get('staff_id'));
		// 		// $staff_id = "95,71";
        //         $this->db->where('enquiry.file_handle_by', $staff_id);
        // }

		if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
			$staff_id = urldecode($this->input->get('staff_id'));
			$staff_ids = explode(',', $staff_id);
			$staff_ids = array_map('trim', $staff_ids);
			$this->db->where_in('enquiry.file_handle_by', $staff_ids);
		}
		
		if ($this->session->userdata('id') == '41') {

			$location = strtolower(
				trim(urldecode($this->input->get('location') ?? ''))
			);

			if (
				$location !== '' &&
				$location !== 'all' &&
				isset($locations[$location]) &&
				!empty($locations[$location])
			) {
				$bookingTypes = is_array($locations[$location])
					? $locations[$location]
					: array_filter(
						array_map('trim', explode(',', $locations[$location]))
					);

				$this->db->where_in(
					'enquiry.enquiry_abbr',
					$bookingTypes
				);
			}
		}

        if (!in_array($this->session->userdata('type'), ['1', '3', '5', '6']) && !in_array($this->session->userdata('email'), ['cau.incoming@kazindmc.com','optimax@kazindmc.com']) && $this->session->userdata('combo_access') == 'no') {
			$session_locations = explode(',', $this->session->userdata('locations'));
			$all_locations = [];
			foreach ($session_locations as $loc) {
				if (isset($locations[$loc])) {
					$all_locations = array_merge($all_locations, $locations[$loc]);
				}
			}
			$this->db->where_in('enquiry.enquiry_abbr', $all_locations);
		}

        if ($this->input->get('country') <> '') {
                $country = strtolower(urldecode($this->input->get('country')));
                $this->db->where('LOWER(company_details.country)', $country);
        }
        if ($this->input->get('state') <> '') {
                $state = strtolower(urldecode($this->input->get('state')));
                $arr = explode(',', $state);
                $arr = array_map('trim', $arr);
                if (end($arr) == '') {
                  unset($arr[count($arr) - 1]);
                }
                $this->db->where_in('LOWER(company_details.state)', $arr);
        }
        if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
                $city = strtolower(urldecode($this->input->get('city')));
                $arr = explode(',', $city);
                $arr = array_map('trim', $arr);
                if (end($arr) == '') {
                  unset($arr[count($arr) - 1]);
                }
                $this->db->where_in('LOWER(company_details.city)', $arr);
        }

		if (!empty($this->input->get('checkin_from'))) {
			$from_date = urldecode($this->input->get('checkin_from'));
			// For type 5/6 OR explicit combo filter, use effective date
			if ($logged_type == '5' || $logged_type == '6' || $is_cmb_filter || $logged_type == '1') {
				$this->db->where('COALESCE(ce.min_check_in_date, enquiry.check_in_date) >=', $from_date);
			} else {
				$this->db->where('enquiry.check_in_date >=', $from_date);
			}
		}

		if (!empty($this->input->get('checkout_to'))) {
			$to_date = urldecode($this->input->get('checkout_to'));
			if ($logged_type == '5' || $logged_type == '6' || $is_cmb_filter || $logged_type == '1') {
				$this->db->where('COALESCE(ce.min_check_in_date, enquiry.check_in_date) <=', $to_date);
			} else {
				$this->db->where('enquiry.check_in_date <=', $to_date);
			}
		}

        if (!empty($this->input->get('guests_number'))) {
                $guests_number = urldecode($this->input->get('guests_number'));
                $guests_number = explode('-',$guests_number);
                $this->db->where('(enquiry.number_persons + enquiry.number_child) >=', $guests_number[0]);
                if($guests_number[1] != 'above'){
                        $this->db->where('(enquiry.number_persons + enquiry.number_child) <=', $guests_number[1]);
                }
        }
        
        if (!empty($this->input->get('sales'))){
            $sales_id = urldecode($this->input->get('sales'));
            $this->db->where('enquiry.sales_admin_id', $sales_id);
        }

        if ($this->session->userdata('type') == 6) {
			$this->db->like('enquiry.enquiry_abbr', 'I', 'after');
		}

        if(!empty($this->input->get('confirm_cnt'))){
                $query = 'SELECT followups.enquiry_id FROM followups ';
                $query .= 'WHERE followups.id IN ( SELECT MAX(followups.id) FROM followups ';
                $query .= 'WHERE followups.date = "'.date('Y-m-d').'" GROUP BY followups.enquiry_id) AND followups.followup_status="confirm"';
                $result = $this->common_model->custom_query($query);
                $where_in=[];
                foreach($result AS $list){
                        $where_in[] = $list->enquiry_id;
                }
                $this->db->where_in('enquiry.id',!empty($where_in)?$where_in:[0]);
        }

		// Custom GROUP BY for CMB files
		$this->db->group_by("CASE 
			WHEN enquiry.enquiry_no LIKE 'CMB%' THEN enquiry.id
			ELSE CONCAT(enquiry.id, '-', COALESCE(arrivals.id, 0))
		END");

		$this->db->order_by('enquiry.id', 'DESC');
		
		if($limit != ''){
			$this->db->limit($limit, $offset);
		}
		
		$result = $this->db->get('enquiry');
		
		//echo $this->db->last_query();exit;
		return $result->result();
	}

    public function delete_enquiry(){
        $this->db->set('is_deleted',1);
        $this->db->where('id',$this->uri->segment(1));
        $this->db->update('enquiry');
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');	
		redirect($_SERVER['HTTP_REFERER']);		    
		}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger">Error!Try Again</div>');	
		redirect($_SERVER['HTTP_REFERER']);	    
		}
    }

	public function get_indiamart_enquiry()
	{
		$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');	
		$this->db->join('company','company.company_id = enquiry.company','LEFT');
		$this->db->join('branch','branch.branch_id = enquiry.branch','LEFT');
		$this->db->where('enquiry.status !=','Quotation Send');
		$this->db->where('enquiry.status !=','Send Quotation Now');
		$this->db->where('enquiry.mode','Indiamart');	
		$this->db->where('enquiry.status !=','Not Useful');
		$this->db->where('enquiry.is_deleted !=',1);
		if($this->session->userdata('type') == 3){
		$this->db->where('enquiry.added_by',$this->session->userdata('id'));    
		}    
		$this->db->order_by('enquiry.id','DESC');
		$result = $this->db->get('enquiry');
		return $result->result();
	}	

	public function indiamart_enquiry($enq)
	{
		if(!empty($enq)){
		foreach($enq as $enquiries){
		$this->db->select('indiamart_query_id');
		$this->db->where('indiamart_query_id',$enquiries['QUERY_ID']);
		$check = $this->db->get('enquiry');
		$check = $check->row();
		if(empty($check)){
		$company_name = $enquiries['GLUSR_USR_COMPANYNAME'];
		if($company_name == null){
		$company_name = $enquiries['QUERY_ID'];	
		}

		$country_code = $enquiries['COUNTRY_ISO'];
		$country = "Not Found";
		if($country_code != null){
		$this->db->select('name');	
		$this->db->where('sortname',$country_code);	
		$country_data = $this->db->get('countries');
		$country_data = $country_data->row();
		if(!empty($country_data)){
		$country = $country_data->name;	
		}else{
		$country = "Not Found";	
		}

		}

		$state = $enquiries['ENQ_STATE'];
		if($state == null){
		$state = "No State Found";	
		}	

		$city = $enquiries['ENQ_CITY'];
		if($city == null){
		$city = "No City Found";	
		}

		$address = $enquiries['ENQ_ADDRESS'];
		if($address == null){
		$address = "No Address Found";	
		}

		$person = $enquiries['SENDERNAME'];
		if($person == null){
		$person = "Name Not Found";	
		}

		$mobile = $enquiries['MOB'];
		if($mobile == null){
		$mobile = "Number Not Found";	
		}

		$email = $enquiries['SENDEREMAIL'];
		if($email == null){
		$email = "Email Not Found";	
		}	

		$this->db->where('name',$company_name);
		$company = $this->db->get('company');
		$company = $company->row();
		$company_id = "";
		$branch_id = uniqid();

		if(empty($company)){
		$company_id = uniqid();

		$company_data = array(
		'company_id' =>$company_id,
		'name'		 =>$company_name,
		'date'		 =>date("Y-m-d",strtotime($enquiries['DATE_R']))
		);

		$this->db->insert('company',$company_data);

		$branch_data = array(
			'company_id'		=>$company_id,
			'branch_id'			=>$branch_id,
			'country'			=>$country,
			'state'				=>$state,
			'city'				=>$city,
			'address'			=>$address,
			'contact_person'	=>$person,	
			'contact_number'	=>$mobile,
			'email'				=>$email,
			'date'				=>date("Y-m-d",strtotime($enquiries['DATE_R']))
		);

		$new_branch = $this->db->insert('branch',$branch_data);

		}else{
		$company_id = $company->company_id;
		$this->db->select('branch_id');
		$this->db->where('city',$city);
		$this->db->where('company_id',$company_id);
		$branch = $this->db->get('branch');
		$branch = $branch->row();
		
		if(!empty($branch)){
		$branch_id = $branch->branch_id;	
		}else{
		$branch_data = array(
		'company_id'		=>$company_id,
		'branch_id'			=>$branch_id,
		'country'			=>$country,
		'state'				=>$state,
		'city'				=>$city,
		'address'			=>$address,
		'contact_person'	=>$person,	
		'contact_number'	=>$mobile,
		'email'				=>$email,
		'date'				=>date("Y-m-d",strtotime($enquiries['DATE_R']))
		);

		$new_branch = $this->db->insert('branch',$branch_data);		
		}	

		}

		$remarks = $enquiries['ENQ_MESSAGE'];
		if($remarks == null){
		$remarks = "No Remarks Found";	
		}

		$product = $enquiries['PRODUCT_NAME'];
		if($product == null){
		$product = "No Product Found";	
		}

		$data = array(
		'indiamart_query_id' =>$enquiries['QUERY_ID'],
		'mode'		   =>'Indiamart',
		'company'	   =>$company_id,
		'branch'	   =>$branch_id,
		'enquiry_for'  =>$product,	
		'enquiry_type' =>'Indiamart',
		'status'	   =>'automated-enquiry',
		'remarks'	   =>$remarks,	
		'date'		   =>date("Y-m-d",strtotime($enquiries['DATE_R']))
		);

		$result = $this->db->insert('enquiry',$data);	

		}

		}		
		}
	}	

	public function products(){
            $this->db->order_by('name','ASC');
            $result = $this->db->get('products');
            return $result->result();   
	}

	public function get_multiple_enquiry($id){	    

	$this->db->where('enquiry_id',$id); 

	$result = $this->db->get('multiple_enquiry');

	return $result->result();

	

	}

	public function get_user($id){

	    

	$this->db->where('id',$id);    

	$result = $this->db->get('admin');

	

	if(!empty($result->row())){

	return $result->row();    

	}else{

	$this->session->set_flashdata('message','Error!');	

	redirect($_SERVER['HTTP_REFERER']);	    

	}    

	}

    public function get_enquiry(){
	$this->db->select('company.name,company.company_id,enquiry.*');
	$this->db->join('company','company.company_id = enquiry.company_id','LEFT');
	$this->db->join('company_details','company_details.company_id = enquiry.company_details_id','LEFT');
	$this->db->where('enquiry.id',$this->uri->segment(1));
	$result = $this->db->get('enquiry');
	if(!empty($result->row())){
            return $result->row();    
	}else{
            //$this->session->set_flashdata('message','Error!');	
            //redirect($_SERVER['HTTP_REFERER']);	    
	}
    }

 public function update_enquiry(){
    $where= 'id='.$this->uri->segment(1);
    $existing = $this->common_model->get_single(['table_name' => 'enquiry', 'condition'  => $where ]);

    if (!empty($existing)) {
        $previous_data = [
            'mode' => $existing['mode'],
            'company_id'         => $existing['company_id'],
            'company_details_id'         => $existing['company_details_id'],
            'number_persons'         => $existing['number_persons'],
            'number_child'         => $existing['number_child'],
            'check_in_date'         => $existing['check_in_date'],
            'check_out_date'         => $existing['check_out_date'],
            'query_received_date'         => $existing['query_received_date'],
            'entery_date' => $existing['entery_date'],
            'number_of_nights'         => $existing['number_of_nights'],
            'enquiry_type'         => $existing['enquiry_type'],
            'remarks'         => $existing['remarks'],
            'added_by'         => $existing['added_by'],
            'enquiry_no'         => $existing['enquiry_no'],
            'file_handle_by'         => $existing['file_handle_by'],
            'sales_admin_id'         => $existing['sales_admin_id'],
        ];
    } else {
        $previous_data = []; 
    }
	$agent  = explode('_',$this->security->xss_clean($this->input->post('agent')));
	$child_age = $this->input->post('child_age');
	if(!empty($child_age)){
		$child_age = array_map('intval', $child_age);
	}

	$manual_received_on = $this->security->xss_clean($this->input->post('manual_received_on'));

	$data = array(
            'mode'  => $this->security->xss_clean($this->input->post('mode')),
	        //'reference_by' => $this->security->xss_clean($this->input->post('reference_by')),
            'company_id'    => $this->security->xss_clean($this->input->post('company_id')),
    		'company_details_id'    => $agent[0],
    		//'enquiry_for'       => $this->security->xss_clean($this->input->post('enquiry_for')),                
            'number_persons'       => $this->security->xss_clean($this->input->post('number_persons')),
            'number_child'      => $this->security->xss_clean($this->input->post('number_child')),
            'check_in_date'       => $this->security->xss_clean($this->input->post('check_in')),
            'check_out_date'       => $this->security->xss_clean($this->input->post('check_out')),
            'query_received_date'       => $this->security->xss_clean($this->input->post('query_received_on')),
            'entery_date'       => !empty($manual_received_on) ? $manual_received_on : NULL,
            'number_of_nights' =>  $this->security->xss_clean($this->input->post('number_of_nights')),
    		'enquiry_type'      => $this->security->xss_clean($this->input->post('enquiry_type')),
    		//'status'            => $this->security->xss_clean($this->input->post('status')),
    		'remarks'           => ucwords(strtolower($this->security->xss_clean($this->input->post('remarks')))),		
    		'added_by'          => $this->security->xss_clean($this->session->userdata('id')),
    		'enquiry_no'        => $this->security->xss_clean($this->input->post('enquiry_no')),		
	        'file_handle_by'    => $this->security->xss_clean($this->input->post('file_handle_by')),
            'sales_admin_id'    => $this->security->xss_clean($this->input->post('sales')),
            'child_age'			=> !empty($child_age) ? json_encode($child_age) : NULL,
        );
        // if($this->input->post('booking_type')<>'' && $this->input->post('file_seq') <> ''){
        //     $data = $data + ['enquiry_abbr'       => $this->security->xss_clean($this->input->post('booking_type')),
        //         'enquiry_sequence'       => $this->security->xss_clean($this->input->post('file_seq'))];
        // }
        $this->db->where('id',$this->uri->segment(1));
    	$result = $this->db->update('enquiry',$data);
    	if($result > 0){
                    log_user_activity('Query Board Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
                return true;
    	}else{
                return false;
    	}
    }

    public function get_by_enquiry_no($enquiry_no) {
        return $this->db->where('enquiry_no', $enquiry_no)->get('enquiry')->row();
    }
		
}

?>