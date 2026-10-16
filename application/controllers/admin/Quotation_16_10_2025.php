<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'sendinblue/vendor/autoload.php';
class Quotation extends CI_Controller {
    
    var $locations = LOCATIONS;
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library(['pagination','upload']);
    }		

    // ************************************* 11 Dec 2024 ************************************
	public function fetch_suggesstions(){
        //echo '<pre>';print_r($this->input->post());exit;
        $capacity = $this->input->post('capacity');
        $char = substr($this->input->post('enquiry_num'), 1, 2);
	    $enquiry_id = base64_decode($this->input->post('enquiry_id'));
	    $transport_id ='8';
        
        $country = COUNTRY_ABBR; //['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $prefilled_city = ['azerbaijan'=>'Baku','belarus'=>'Minsk','georgia'=>'Tbilisi','kazakhstan'=>'Almaty'];
        $data['prefilled_city'] = $prefilled_city[$country[$char]];
        if($prefilled_city[$country[$char]] <>'')
        {
            $where = ' transportation.status = "active" AND LOWER(transportation.city) = "'.strtolower($prefilled_city[$country[$char]]).'"';
        }else{
            $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
        }
        $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
        $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, ' LIMIT 1', $count = false);

        $join = [
            [
                'type' => 'LEFT',
                'join_table' => 'location_masters',
                'condition' => 'location_masters.id = sites.location_ids'
            ],
            [
                'type' => 'LEFT',
                'join_table' => 'outsidecity_transportation_costs',
                'condition' => 'outsidecity_transportation_costs.sites_id = sites.id'
            ]
        ];

        $type = 'sitescene';
        $select = 'sites.id, sites.site_name, sites.days_of_operation, sites.entry_ticket_fee, sites.child_entry_ticket_fee, 
                sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes, outsidecity_transportation_costs.est_hour';

        $base_where = 'sites.status = "active" 
                    AND sites.category = "' . $type . '" 
                    AND LOWER(sites.country) = "' . strtolower($country[$char]) . '" 
                    AND LOWER(sites.city) = "' . strtolower($prefilled_city[$country[$char]]) . '" 
                    AND outsidecity_transportation_costs.transport_id = "' . (int)$transport_id . '"';

        $where_outsidecity = $base_where . ' AND location_masters.destination_type = "outsidecity"';
        $data['sites_outsidecity'] = $this->common_model->get_data('sites', '', '', $select, $where_outsidecity, '', false, $join);

        $select_inside = 'sites.id, sites.site_name, sites.days_of_operation, sites.entry_ticket_fee, sites.child_entry_ticket_fee, 
                sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes';
        $base_where_inside = 'sites.status = "active" 
            AND sites.category = "' . $type . '" 
            AND LOWER(sites.country) = "' . strtolower($country[$char]) . '" 
            AND LOWER(sites.city) = "' . strtolower($prefilled_city[$country[$char]]) . '"';
        $where_insidecity = $base_where_inside . ' AND sites.location_ids = "0"';
        $insidecity_join ='';
        $data['sites_insidecity'] = $this->common_model->get_data('sites', '', '', $select_inside, $where_insidecity, '', false, $insidecity_join);

        $where = 'currency_value.country ="'.strtolower($country[$char]).'" AND currency_value.status = "active" Order by currency_value.id DESC';
        $data['currency'] = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];
        
        $where = 'auxiliary_miscellaneous.country ="'.strtolower($country[$char]).'" AND auxiliary_miscellaneous.status="active"';
        $data['mandatory_services'] = $this->common_model->get_data('auxiliary_miscellaneous','', '', '*',$where, '', $count = false);
        
        $where = 'auxiliary_transportation.country ="'.strtolower($country[$char]).'" AND auxiliary_transportation.status="active"';
        $data['luggage_vehicle'] = $this->common_model->get_data('auxiliary_transportation','', '', '*',$where, ' LIMIT 1 ', $count = false);
        
        $where = 'quotations.enquiry_id = '.$enquiry_id;
        $data['quotations'] = $this->common_model->get_data('quotations','', '', 'quotations.id',$where, '', $count = false);
        // $this->generate_itinerary();
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }
    // dev@thavertech.com
    //  private $openai_api_key = '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'; 
   
//     public function generate_itinerary()
//     {
//         $check_in_time = '8:35';
//         $check_out_time = '23:15';
//         $check_in_date = '2025-07-25';
//         $check_out_date = '2025-07-30';

//         $this->db->where('city', 'Almaty');
//         $this->db->where('category', 'sitescene');
//         $query = $this->db->get('sites'); 
//         $sites = $query->result_array();

//         if (empty($sites)) {
//             echo "No sites found in the database.";
//             return;
//         }

//         $siteDescriptions = array_map(function($site) {
//             return $site['id'] . '. ' . $site['site_name'] . 
//                 ' (Duration: ' . $site['duration_hours'] . 'h, Days: ' . $site['days_of_operation'] . 
//                 ', Location ID: ' . $site['location_ids'] . ')';
//         }, $sites);
//         $siteList = implode(", ", $siteDescriptions);

//         // Generate dates with day names
//         $start = new DateTime($check_in_date);
//         $end = new DateTime($check_out_date);
//         $end->modify('+1 day'); // include checkout day
//         $interval = new DateInterval('P1D');
//         $dateRange = new DatePeriod($start, $interval, $end);
//         $days = [];
//         foreach ($dateRange as $index => $date) {
//             $dayNum = $index + 1;
//             $dayName = $date->format('l'); // Monday, Tuesday etc
//             $dateStr = $date->format('Y-m-d');
//             $days[] = [
//                 'day' => $dayNum,
//                 'date' => $dateStr,
//                 'day_name' => $dayName
//             ];
//         }
//         $dayConditions = [];
//         foreach ($days as $day) {
//             if ($day['day'] === 1 || $day['day'] === count($days)) {
//                 $dayConditions[] = "Day {$day['day']} ({$day['date']}) is for location_id = 0 (inside city only)";
//             } else {
//                 $dayConditions[] = "Day {$day['day']} ({$day['date']}) allows 1 site with location_id != 0 (outside city) first, then location_id = 0 if time remains.";
//             }
//         }
//         $dayLogic = implode("\n- ", $dayConditions);
//         $prompt = <<<EOD
//         You are a travel itinerary planner for tourists visiting Kazakhstan.
//         Create a JSON itinerary using the following site list:
//         $siteList
//         Constraints:
//         - Check-in: $check_in_date at $check_in_time
//         - Check-out: $check_out_date at $check_out_time
//         - Begin Day 1 two hours after check-in.
//         - End the last day five hours before checkout ($check_out_time), so schedule the last activity to finish before that.
//         - Daily schedule should be between 10:00 AM and 10:00 PM.
//         - Add at least 1-hour break between activities.
//         - Each activity's `start_time` must exactly match one of the site's available `departing_time_from_hotel` values.
//         - If there is no valid `departing_time_from_hotel` available after the previous activity (including 1-hour buffer), either:
//             - Move the activity to the next available day
//             - Or skip it and mark as "unschedulable"
//         - Avoid placing a site on a day it's not operational (check `days_of_operation`).
//         - Do not repeat any site.
//         - $dayLogic

//         Each scheduled activity must include:
//         - `id`
//         - `site_name`
//         - `start_time`
//         - `end_time`
//         - `duration_hours`
//         - `departing_time_from_hotel`
//         - `day_of_operation_used`
//         For skipped or unschedulable sites (due to time or operational limits), add them to a separate `"unscheduled_activities"` array with reason.
//         Return only valid JSON. No explanation or markdown.
//         Output format:
//         {
//         "itinerary": [
//             {
//             "day": 1,
//             "date": "YYYY-MM-DD",
//             "activities": [
//                 {
//                 "id": 5,
//                 "site_name": "Shymbulak Ski Resort",
//                 "start_time": "10:00",
//                 "end_time": "14:00",
//                 "duration_hours": 4,
//                 "departing_time_from_hotel": "10:00",
//                 "day_of_operation_used": "Monday"
//                 }
//             ]
//             }
//         ],
//         "unscheduled_activities": [
//             {
//             "id": 7,
//             "site_name": "Kok Tobe Hill",
//             "reason": "❌ No valid departing_time_from_hotel available after 20:00"
//             }
//         ]
//         }
//         EOD;

//         $apiKey = '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';
//         $endpoint = 'https://api.openai.com/v1/chat/completions';

//         $postData = [
//             'model' => 'gpt-4o-mini',
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You are a helpful travel planner. Respond only with valid JSON.'],
//                 ['role' => 'user', 'content' => $prompt]
//             ],
//             'temperature' => 0.7
//         ];

//         $headers = [
//             'Content-Type: application/json',
//             'Authorization: ' . 'Bearer ' . $apiKey
//         ];

//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $endpoint);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//         $response = curl_exec($ch);
//         curl_close($ch);

//         $result = json_decode($response, true);

//         if (isset($result['choices'][0]['message']['content'])) {
//             $content = $result['choices'][0]['message']['content'];

//             $cleaned = trim($content);
//             $cleaned = preg_replace('/^```(json)?/i', '', $cleaned); 
//             $cleaned = preg_replace('/```$/', '', $cleaned);       
//             $cleaned = str_replace(['“', '”'], '"', $cleaned);

//             $itinerary = json_decode($cleaned, true);

//             // After json_decode block is successful
// if (json_last_error() === JSON_ERROR_NONE) {
//     echo "<h3>🗓️ Itinerary Preview:</h3>";

//     foreach ($itinerary as $day) {
//         echo "<h4>Day {$day['day']} – {$day['date']}</h4><ul>";
//         $previous_end = null;

//         foreach ($day['activities'] as $index => &$activity) {
//     $site_id = $activity['id'];
//     $valid_times = $this->get_available_start_times($site_id);

//     if (empty($valid_times)) {
//         echo "<li><strong>{$activity['site_name']}</strong>: ❌ No valid departing times found in DB.</li>";
//         continue;
//     }

//     $duration = (int) $activity['duration_hours'];

//     // Determine the earliest allowed start time
//     if ($index === 0) {
//         if ($day['day'] === 1) {
//             $earliest = DateTime::createFromFormat('H:i', $check_in_time);
//             if (!$earliest) {
//                 echo "<li><strong>{$activity['site_name']}</strong>: ❌ Invalid check-in time: {$check_in_time}</li>";
//                 continue;
//             }
//             $earliest->modify('+2 hours');
//         } else {
//             $earliest = DateTime::createFromFormat('H:i', '10:00');
//             if (!$earliest) {
//                 echo "<li><strong>{$activity['site_name']}</strong>: ❌ Could not parse default earliest time (10:00).</li>";
//                 continue;
//             }
//         }
//     } else {
//         $earliest = DateTime::createFromFormat('H:i', $previous_end);
//         if (!$earliest) {
//             echo "<li><strong>{$activity['site_name']}</strong>: ❌ Invalid previous end time: {$previous_end}</li>";
//             continue;
//         }
//         $earliest->modify('+1 hour');
//     }

//     // Choose the next valid departing_time_from_hotel after the earliest allowed
//     $selectedStart = null;
//     foreach ($valid_times as $timeOption) {
//         $candidate = DateTime::createFromFormat('H:i', $timeOption);
//         if (!$candidate) continue; // skip malformed time

//         if ($candidate >= $earliest) {
//             $selectedStart = $candidate;
//             break;
//         }
//     }

//     if (!$selectedStart) {
//         echo "<li><strong>{$activity['site_name']}</strong>: ❌ No valid start time after " . $earliest->format('H:i') . ".</li>";
//         continue;
//     }

//     $start = $selectedStart;
//     $end = (clone $start)->modify("+{$duration} hours");

//     $activity['start_time'] = $start->format('H:i');
//     $activity['departing_time_from_hotel'] = $start->format('H:i');
//     $activity['end_time'] = $end->format('H:i');
//     $previous_end = $activity['end_time'];

//     echo "<li><strong>{$activity['site_name']}</strong> ({$activity['start_time']} to {$activity['end_time']}) – Duration: {$duration} hrs</li>";
// }


//         echo "</ul>";
//     }
// }
//  else {
//                 echo "❌ Failed to decode JSON. Error: " . json_last_error_msg();
//                 echo "<hr><b>GPT Raw Output:</b><br><pre>" . htmlspecialchars($content) . "</pre>";
//             }
//         } else {
//             echo "❌ Failed to generate itinerary: <pre>" . print_r($result, true) . "</pre>";
//         }
//     }
//     private function get_available_start_times($site_id) {
//     $this->db->select('departing_time_from_hotel');
//     $this->db->from('sites');
//     $this->db->where('id', $site_id);
//     $query = $this->db->get();
//     $result = $query->row_array();

//     if (!empty($result) && !empty($result['departing_time_from_hotel'])) {
//         // Split comma-separated times and trim each
//         $times = explode(',', $result['departing_time_from_hotel']);
//         return array_map('trim', $times); // e.g., ['10:00', '13:00', '17:00']
//     }

//     return []; // No times available
// }
    
    // public function fetch_suggesstions(){
    //     //echo '<pre>';print_r($this->input->post());exit;
    //     $capacity = $this->input->post('capacity');
    //     $char = substr($this->input->post('enquiry_num'), 1, 2);
	   // $enquiry_id = base64_decode($this->input->post('enquiry_id'));
        
    //     $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
    //     $prefilled_city = ['azerbaijan'=>'Baku','belarus'=>'Minsk','georgia'=>'Tbilisi','kazakhstan'=>'Almaty'];
    //     $data['prefilled_city'] = $prefilled_city[$country[$char]];
    //     if($prefilled_city[$country[$char]] <>''){
    //         $where = ' transportation.status = "active" AND LOWER(transportation.city) = "'.strtolower($prefilled_city[$country[$char]]).'"';
    //     }else{
    //         $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
    //     }
    //     $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
    //     $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, ' LIMIT 2', $count = false);

    //     $type = 'sitescene';
    //     $select = 'sites.id,sites.site_name,sites.days_of_operation,sites.entry_ticket_fee,sites.child_entry_ticket_fee, sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes';
    //     $where = 'sites.status= "active" AND sites.category = "'.$type.'" AND LOWER(sites.country) = "'.$country[$char].'"';
    //     //$where .= ' AND location_masters.status = "active"';
    // 	$join = [['type' => 'LEFT', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
    // 	$where_outsidecity = '';//' AND location_masters.destination_type = "outsidecity"';
    //     $data['sites_outsidecity'] = $this->common_model->get_data('sites','', '', $select,$where.$where_outsidecity,'', $count = false,$join);

    //     $where_insidecity = '';//' AND location_masters.destination_type = "insidecity"';
    //     //$data['sites_insidecity'] = $this->common_model->get_data('sites','', '', $select,$where.$where_insidecity,'', $count = false,$join);
    //     $data['sites_insidecity'] = [];
        
    //     $where = 'currency_value.country ="'.strtolower($country[$char]).'" AND currency_value.status = "active"';
    //     $data['currency'] = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];
        
    //     $where = 'auxiliary_miscellaneous.country ="'.strtolower($country[$char]).'" AND auxiliary_miscellaneous.status="active"';
    //     $data['mandatory_services'] = $this->common_model->get_data('auxiliary_miscellaneous','', '', '*',$where, '', $count = false);
        
    //     $where = 'auxiliary_transportation.country ="'.strtolower($country[$char]).'" AND auxiliary_transportation.status="active"';
    //     $data['luggage_vehicle'] = $this->common_model->get_data('auxiliary_transportation','', '', '*',$where, ' LIMIT 1 ', $count = false);
        
    //     $where = 'quotations.enquiry_id = '.$enquiry_id;
    //     $data['quotations'] = $this->common_model->get_data('quotations','', '', 'quotations.id',$where, '', $count = false);
        
    //     echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    // }
	
    public function get_hotel_comparison_prices(){
        //echo '<pre>';print_r($this->input->post());exit;
        $type = implode('","',$this->input->post('type'));
        $hotel_ids = $this->input->post('hotel_id');
        $room_type = $this->input->post('room_type');
        
        $select = 'room_category_costing.price_with_breakfast,hotels.id,hotels.name';
        $join = [['type' => '', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.hotel_id=hotels.id'],];
        $person_count = ['single'=>'1','twin'=>'2','triple'=>'3'];
        $data['hotel_min_price'] = [];
        //$data['hotel_max_price'] = '';
        foreach($hotel_ids AS $k=>$list){            
            foreach($person_count AS $key=>$person){
                if(in_array($key,$room_type)){
                    $where = ' hotels.status = "active" AND hotels.id = '.$list;
                    $where .= ' AND hotels.category ="'.$type.'"';
                    $where .= ' AND room_category_costing.person_count='.$person.' AND room_category_costing.type="adult" AND room_category_costing.status="active"';
                    $hotel_min_price = $this->common_model->get_data('hotels','', '', $select,$where, ' ORDER BY room_category_costing.price_with_breakfast ASC LIMIT 1', $count = false,$join);
                    if(!empty($hotel_min_price)){
                        $data['hotel_min_price'][$k][$key] = $hotel_min_price[0]->price_with_breakfast;
                        //$data['hotel_max_price'] = $this->common_model->get_data('hotels','', '', $select,$where.' AND hotels.id != '.$data['hotel_min_price'][0]->id, ' ORDER BY room_category_costing.price_with_breakfast DESC LIMIT 1', $count = false,$join);
                    }else{
                        $data['hotel_min_price'][$k][$key] = '';
                    }
                }else{
                    $data['hotel_min_price'][$k][$key] = '';
                }
            }
            $data['hotel_min_price'][$k]['hotel_name'] = $hotel_min_price[0]->name;
        }
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function aux_transportation_suggesstion()
    {
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("vehicle_type like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('auxiliary_transportation')->result();
        foreach ($records as $row) {
            $response[] = array("t_id" => $row->id, "label" => trim($row->vehicle_type),"price"=>trim($row->price));
        }
        echo json_encode($response);
    }
    
    // public function get_transportation_suggesstion()
    // {
    //     $city = $this->input->post('city');
    //     $char = substr($this->input->post('location'), 1, 2);
    //     $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where("vehicle_name like '%" . trim($this->input->post('search')) . "%' ");
    //     $this->db->where('status', 'active');
    //     if($city <> ''){
    //         $this->db->where('LOWER(city)', strtolower($city));
    //     }else{
    //         $this->db->where('LOWER(country)', $locations[$char]);
    //     }
    //     $this->db->limit(10);
    //     $records = $this->db->get('transportation')->result();
    //     foreach ($records as $row) {
    //         $response[] = array("t_id" => $row->id, "label" => trim($row->vehicle_name),'luggage_vehicle'=>$row->luggage_transport,'capacity'=>$row->capacity);
    //     }
    //     echo json_encode($response);
    // }
    public function get_transportation_suggesstion()
    {
        $city = $this->input->post('city');
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;
        $response = array();

        $this->db->distinct();
        $this->db->select('transportation.id, transportation.vehicle_name, transportation.luggage_transport, transportation.capacity');
        $this->db->from('transportation');
        $this->db->join('transportation_costs', 'transportation_costs.transport_id = transportation.id', 'INNER');
        $this->db->where("vehicle_name LIKE '%" . trim($this->input->post('search')) . "%'");
        $this->db->where('transportation.status', 'active');
        $this->db->where("transportation_costs.price != ''");

        if ($city != '') {
            $this->db->where('LOWER(transportation.city)', strtolower($city));
        } else {
            $this->db->where('LOWER(transportation.country)', $locations[$char]);
        }

        $this->db->limit(10);
        $records = $this->db->get()->result();

        foreach ($records as $row) {
            $response[] = array(
                "t_id" => $row->id,
                "label" => trim($row->vehicle_name),
                "luggage_vehicle" => $row->luggage_transport,
                "capacity" => $row->capacity
            );
        }

        echo json_encode($response);
    }
    
    public function get_hotels(){
        //echo '<pre>';print_r($this->input->post());exit;
        $type = implode('","',$this->input->post('type'));
        $select = 'hotels.id,hotels.name';
        $where = ' hotels.status = "active" AND LOWER(hotels.city) = "'.strtolower(trim($this->input->post('hotel_city'))).'"';
        $where .= ' AND hotels.category IN ("'.$type.'")';
        $data['hotels'] = $this->common_model->get_data('hotels','', '', $select,$where, '',$count = false);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }


    public function hotel_city(){
        $char = substr($this->input->post('enquiry_num'), 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('DISTINCT(hotels.city)');
        $this->db->where("hotels.city like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('hotels.status', 'active');
        $this->db->where('LOWER(hotels.country)',$country[$char]);
        $this->db->limit(10);
        $records = $this->db->get('hotels')->result();
        foreach ($records as $row) {
            $response[] = array("hotel_city" => trim($row->city), "label" => trim($row->city));
        }
        echo json_encode($response);
    }

    public function transport_prices(){
        //echo '<pre>';print_r($this->input->post());exit;
        $check_in = $this->input->post('checkin_date');
        $check_out = $this->input->post('checkout_date');
        $site_id = $this->input->post('site_id');
        $transport_id = $this->input->post('transports_id');

        $where = 'outsidecity_transportation_costs.sites_id = '.$site_id.' AND outsidecity_transportation_costs.transport_id IN ('.$transport_id.') AND outsidecity_transportation_costs.status = "active"';
        $where .= ' AND date(outsidecity_transportation_costs.valid_from) <= "'.$check_in.'" AND date(outsidecity_transportation_costs.valid_to) >= "'.$check_out.'"';
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id'],];
        $data['transportation'] = $this->common_model->get_data('outsidecity_transportation_costs','', '', '*',$where, '', $count = false,$join);
		
        //if(empty($data['transportation'])){
        $where = ' transportation_costs.transport_id IN ('.$transport_id.') AND transportation_costs.type IN ("full-day")';
        $where .= ' AND date(transportation_costs.valid_from) <= "'.$check_in.'" AND date(transportation_costs.valid_to) >= "'.$check_out.'"';
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = transportation_costs.transport_id'],];
        $data['transportation_cost'] = $this->common_model->get_data('transportation_costs','', '', '*',$where, '', $count = false,$join);
        //}
        //echo $this->db->last_query();'<pre>';print_R($data);exit;
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
	
    public function save_and_email(){
	//echo '<pre>'; print_r($this->input->post());exit;
		
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
        //$this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');        
        $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $cnt = count($this->input->post('itinerary_date'));
        $created = date('Y-m-d H:i:s');
        $enquiry_id = $this->input->post('enquiry_id');
        
        $where = ' enquiry.id = '.$enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                        ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

        //echo '<pre>';print_r($enquiry);exit;
        $total_persons = $enquiry->number_persons + $enquiry->number_child;
        $char = substr($enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'Azerbaijan', 'B' => 'Belarus', 'G' => 'Georgia', 'K' => 'Kazakhstan'];
        $where = 'currency_value.country ="'.strtolower($country[$char]).'"';
        $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

        $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);

        $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
            <tbody>
            <tr style="height:21px">
                    <td style="border:1px solid rgb(0,0,0);overflow:hidden;padding:2px 3px;vertical-align:bottom;background-color:rgb(255,242,204);font-size:11pt;font-weight:bold;text-align:center" rowspan="1" colspan="5">Day wise Itinerary - 4 Night - 5 Days
                    </td>
            </tr><tr style="">
            <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $html = '';
        $total_transportation_outside = 0;
        $total_transportation_inside = 0;
        $total_transportation = 0;
        for($i=0;$i<$cnt;$i++){
            $cnt_text = count($this->input->post('itinerary_title_search_'.$i));
            for($j=0;$j<$cnt_text;$j++){
                    if($j==0){
                            $html .= $this->input->post('itinerary_date')[$i].'<ol>'; 
                    }
                    $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
                    $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
            }
            $html .= '</ol><br>';
            if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
                    $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
            }
            if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
                    $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
            }
        }
        $total_transportation = $total_transportation_outside + $total_transportation_inside;
        if(array_key_exists('hdn_airport_in_total',$this->input->post())){
                $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
        }
        if(array_key_exists('hdn_airport_out_total',$this->input->post())){
                $total_transportation = $total_transportation + $this->input->post('hdn_airport_out_total');
        }
        $table_itinerary.= $html.'</td></tr></tbody></table>';

        //echo 'Transportation : '.$total_transportation;

        $grand_total_1 = $total_transportation + $this->input->post('hotel_total_1');
        $grand_total_1 = $grand_total_1 + ($grand_total_1 * ($this->input->post('markup_percentage')/100));
        $grand_total_2 = $total_transportation + $this->input->post('hotel_total_2');
        $grand_total_2 = $grand_total_2 + ($grand_total_2 * ($this->input->post('markup_percentage')/100));

        //echo 'Total 1:'. $grand_total_1.'__Total 2:'.$grand_total_2;

        $per_person_cost_1 = round($grand_total_1/$total_persons);
        $per_person_cost_1 = round($per_person_cost_1/$currency->country_currency_value); // In dollars

        $per_person_cost_2 = round($grand_total_2/$total_persons);
        $per_person_cost_2 = round($per_person_cost_2/$currency->country_currency_value); // In dollars
        //echo 'PP 1 :'.$per_person_cost_1.'__PP 2'.$per_person_cost_2;exit;
        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => $email_subject,
            'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'to' => [
                // [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
					[ 'name' => 'Vikash choudhary', 'email' => 'vikash.thaver@gmail.com'],
					],
            //'cc' => [['name' => 'Rohit', 'email' => 'rohit@kazindmc.com']],
            //'bcc' => [['name' => '', 'email' => '']],
            'htmlContent' => '<!DOCTYPE html><html><head>
                        <style>
                        th, td {
                          padding: 5px;
                          text-align: left;
                        }
                        </style>
                    </head><body>
                    <table style="width:100%">
                    <tr><td colspan="12" align="left">Dear Teams,</td></tr><tr><td colspan="12"></td></tr>
                    <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                    <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
                    <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?"<label style=`color:#33d70b;`>With Hotel</label>":"<label style=`color:#ff2c17;`>Without Hotel</label>").')</td></tr>
                    <tr><td colspan="12" align="left">Cost : U$ '.$per_person_cost_1.' PP [ '.$this->input->post('hotel_names_1').' ]</td></tr>
                    <tr><td colspan="12" align="left">Cost : U$ '.$per_person_cost_2.' PP [ '.$this->input->post('hotel_names_2').' ]</td></tr>

                    <tr><td colspan="12" align="left">'.$table_itinerary.'</td></tr>
                    <tr><td colspan="12" align="left"><mark>IMPORTANT NOTE:</mark> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
                    <tr><td colspan="12" align="left"><mark>INCLUSIONS:</mark> <br>'.$this->input->post('inclusions').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>EXCLUSIONS:</mark> <br>'.$this->input->post('exclusions').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>IMPORTANT NOTES:</mark> <br>'.$this->input->post('important_notes').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>CANCELLATION POLICY:</mark> <br>'.$this->input->post('cancellation_policy').' </td></tr>  
                    <tr><td colspan="12" align="left" height="25px"></td></tr><tr><td colspan="12" align="left">Regards,    </td></tr>
                    <tr><td colspan="12" align="left">Jasmine <br>
						OPS - FIT DESK (KAZAKHSTAN) </td></tr>
                    </table></body></html>',
             /*'params' => ['bodyMessage' => '']*/
        ]);

        try {
            $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
            //print_r($sendinblue_response);
        } catch (Exception $e) {
            //echo $e->getMessage(),PHP_EOL;
        }
		
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
        echo json_encode($response);
        exit;		
	}
    
//     public function save_and_email_new(){
// 	//echo '<pre>'; print_r($this->input->post());exit;
		
//         $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
//         //$this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');        
//         $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
//         $this->form_validation->set_error_delimiters('', '<br>');  
//         if($this->form_validation->run() == FALSE){
//             echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
//             exit;
//         }
//         $cnt = count($this->input->post('itinerary_date'));
//         $created = date('Y-m-d H:i:s');
//         $enquiry_id = $this->input->post('enquiry_id');
//         // $where2='enquiry_id ='.$enquiry_id;
//         // $arrivals = $this->common_model->get_data('arrivals', '', '', 'id, enquiry_id', $where2, '', $count = false, '');
//         // $arrival_id= $arrivals[0]->id;
    
//         $where = ' enquiry.id = '.$enquiry_id;
//         $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
//                  ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
//         $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

//         //echo '<pre>';print_r($enquiry);exit;
//         $total_persons = $enquiry->number_persons + $enquiry->number_child;
//         $char = substr($enquiry->enquiry_abbr, 1, 2);
//         $country = COUNTRY_ABBR;//['A' => 'Azerbaijan', 'B' => 'Belarus', 'G' => 'Georgia', 'K' => 'Kazakhstan'];
//         $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active"';
//         $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

//         $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
        
//         $stay_html = '';
//         /*if(array_key_exists('hotel_nights', $this->input->post())){
//             $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//             $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
//             $stay_html .= '<ol>';
//             $hotel_nights = json_decode($this->input->post('hotel_nights'));
//             foreach($hotel_nights AS $key=>$list){
//                 $h_name = explode('_',$key);
//                 $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
//             }
//             $stay_html .= '</ol></td></tr>';
//         }*/
        
//         $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
//         $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
//             <div>
//             <h4 class="title">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
//                 <h4>
//             </div>
//         <tbody>
//             '.$stay_html.$transportation_guide.'<tr style="">
//             <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
//         $total_transportation_outside = 0;
//         $total_transportation_inside = 0;
//         $hdn_travel_city_cost = 0;
//         $total_transportation = 0;
//         $n=0;
//         $html .= '<ol>'; 
//         for($i=0;$i<$cnt;$i++){            
//             $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
//             for($j=0;$j<$cnt_text;$j++){
//                 if($j==0){
//                     //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
//                 }
//                 $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
//                 $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
//                 //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
//                 if(!empty($this->input->post('itinerary_activities_'.$i))){
//                     $html .= '<ul>';
//                     foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
//                         if($activity != ""){
//                             $html .= '<li>'.$activity.'</li>';
//                         }
//                     }
//                     $html .= '</ul>';
//                 }
//             }
//             $n++;
//             if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
//                 $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
//             }
//             if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
//                 $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
//             }
//             if(array_key_exists('hdn_travel_city_cost_'.$i,$this->input->post())){
//                 $hdn_travel_city_cost = $hdn_travel_city_cost + $this->input->post('hdn_travel_city_cost_'.$i);
//             }
//         }
//         $html .= '</ol><br>';
        
//         $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
//         $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
//         $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
//         $total_transportation = $total_transportation_outside + $total_transportation_inside;
//         if(array_key_exists('hdn_airport_in_total',$this->input->post())){
//             $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
//         }
//         if(array_key_exists('hdn_airport_out_total',$this->input->post())){
//             $total_transportation = $total_transportation + $this->input->post('hdn_airport_out_total');
//         }
        
        
//         //echo 'Transportation : '.$total_transportation.'<br>';
        
//         $activities_total = 0;
//         if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
//             foreach($this->input->post('hdn_activities_total') AS $list)
//                 {
//                 $activities_total = $activities_total + (int)$list;
//             }
//         }
//         $restaurants_grand_total = 0;
//         /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
//             $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
//         }*/
//         $guide_grand_total = 0;
//         if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
//             $guide_grand_total = (int)$guide_grand_total + (int)$this->input->post('hdn_guide_grand_total');
//         }
//         //echo 'Guide : '.$guide_grand_total. '<br>';
//         $hdn_mandatory_grand_total = 0;
//         if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
//             $hdn_mandatory_grand_total = $hdn_mandatory_grand_total + $this->input->post('hdn_mandatory_grand_total');
//         }
//         //echo 'Mandatory : '.$hdn_mandatory_grand_total. '<br>';
//         $hdn_lugguage_total = 0;
//         if(array_key_exists('hdn_luggage_price',$this->input->post())){
//             $hdn_lugguage_total = $hdn_lugguage_total + (int)$this->input->post('hdn_luggage_price');
//         }
//         $hdn_final_ticket_price = 0;
//         if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
//             $hdn_final_ticket_price = $hdn_final_ticket_price + $this->input->post('hdn_final_ticket_price');
//         }
//         /*$grand_total_1 = $total_transportation + $this->input->post('hotel_total_1') + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
//         $grand_total_1 = $grand_total_1 + ($grand_total_1 * ($this->input->post('markup_percentage')/100));
//         //$grand_total_2 = $total_transportation + $this->input->post('hotel_total_2');
//         //$grand_total_2 = $grand_total_2 + ($grand_total_2 * ($this->input->post('markup_percentage')/100));
        
//         $per_person_cost_1 = round($grand_total_1/$total_persons);
//         $per_person_cost_1 = round($per_person_cost_1/$currency->country_currency_value); // In dollars
//         */
//         if(array_key_exists('hotel_names_category_wise', $this->input->post())){
//             // $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'));
//             $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
//         }
//         if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
//             // $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'));
//             $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
//         }
//         if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
//             $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
//         }
//         //echo '<pre>';print_r($hotel_costing_category_wise);print_r($hotel_names_category_wise);exit;
 

//         // $cost_html = '';
//         // if ($this->input->post('hdn_group_type') == 'family') 
//         // {
//         //     $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//         //     foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//         //         $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//         //             ? $hotel_room_category_names_wise[$rating_key]
//         //             : [];
        
//         //         $colspan = count($room_cat_list);
//         //         $rating_display = ucwords(str_replace('_', ' ', $rating_key));
        
//         //         $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//         //     }
//         //     $cost_html .= '</tr>';
        
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//         //     foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//         //         $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//         //             ? $hotel_room_category_names_wise[$rating_key]
//         //             : [];
        
//         //         for ($i = 0; $i < count($room_cat_list); $i++) {
//         //             $hotel_name = isset($hotel_list[$i]) ? $hotel_list[$i] : '-';
//         //             $cost_html .= '<td style="background-color: #f2f5d6;">' . $hotel_name . '</td>';
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
        
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//         //     foreach ($hotel_room_category_names_wise as $rating_key => $room_cat_list) {
//         //         if (!is_array($room_cat_list)) continue;
//         //         foreach ($room_cat_list as $room_cat_name) {
//         //             $cost_html .= '<td style="background-color: #f2dafc;">' . $room_cat_name . '</td>';
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
        
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
//         //     foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//         //         $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//         //             ? $hotel_room_category_names_wise[$rating_key]
//         //             : [];
        
//         //         foreach ($room_cat_list as $index => $room_cat_name) {
//         //             $hotel_cost = isset($hotel_costing_category_wise[$rating_key][$index]) ? $hotel_costing_category_wise[$rating_key][$index] : 0;
//         //             $grand_total = $total_transportation + $hotel_cost + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;
//         //             $markup_percentage = floatval($this->input->post('markup_percentage'));
//         //             $grand_total += ($grand_total * ($markup_percentage / 100));
        
//         //             $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
//         //                 ? round(($grand_total / $total_persons) / $currency->country_currency_value)
//         //                 : 0;
//         //             $cost_html .= '<td style="background-color: #f8d9d9;">$' . $per_person_cost . '</td>';
//         //         }
//         //     }
//         //         $cost_html .= '</tr>';
//         //         $cost_html .= '</table>';
//         // }
//         $cost_html = '';
//         if ($this->input->post('hdn_group_type') == 'family') {
//             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
//                 $colspan = max(count($hotels), 1); 
//                 $rating_display = ucwords(str_replace('_', ' ', $rating_key));

//                 $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotelId => $hotelName) {
//                     $cost_html .= '<td style="background-color: #f2f5d6;">' . $hotelName . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//             foreach ($hotel_room_category_names_wise as $rating_key => $room_cat_list) {
//                 if (!is_array($room_cat_list)) continue;
//                 foreach ($room_cat_list as $room_cat_name) {
//                     $cost_html .= '<td style="background-color: #f2dafc;">' . $room_cat_name . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotelId => $hotelName) {
//                     $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;
//                     $grand_total = $total_transportation + $hotel_cost + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;

//                     $markup_percentage = floatval($this->input->post('markup_percentage'));
//                     $grand_total += ($grand_total * ($markup_percentage / 100));

//                     $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
//                         ? round(($grand_total / $total_persons) / $currency->country_currency_value)
//                         : 0;

//                     $cost_html .= '<td style="background-color: #f8d9d9;">$' . $per_person_cost . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '</table>';
//             // echo $cost_html;
//             // die();
//         }
//         else if ($this->input->post('hdn_group_type') == 'individual') 
//         {
//             $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;
//             $grand_total_pp = $grand_total / $total_persons;

//             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 $colspan = 0;
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                          if (is_array($occupancies)) {
//                             $colspan += count($occupancies); 
//                          }
//                     }
//                 }
//                 $rating_display = ucwords(str_replace('_', ' ', $rating_key));
//                 $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//             }
//             $cost_html .= '</tr>';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) { 
//                     $occ_count = 0;
//                     foreach ($categories as $cat => $occupancies) {
//                     if ($cat === "nights") continue;
//                         if (is_array($occupancies)) {
//                             $occ_count += count($occupancies);
//                         }
//                     }

//                     $nights = isset($categories['nights']) ? $categories['nights'] : 0;
//                     $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
//                     $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #f2f5d6; font-weight:bold;">' . $hotel_display . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
//           $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     $roomCats = [];
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $roomCats[] = $cat;
//                         }
//                     }
//                     $prev = null;
//                     $span = 0;
//                     foreach ($roomCats as $i => $cat) {
//                         if ($cat === $prev) {
//                             $span++;
//                         } else {
//                             if ($prev !== null) {
//                                 $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//                                 $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//                             }
//                             $prev = $cat;
//                             $span = 1;
//                         }
//                     }
//                     if ($prev !== null) {
//                         $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//                         $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Occupancy</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $occ_arr = explode('__', $occ);
//                             $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
//                             $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
//                             $occupancy_type = trim($occupancy_type);
//                             $cost_html .= '<td style="background-color: #e2f0cb;">' . $occupancy_type . '</td>';
//                         }
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             $label = ($nights == 0) ? "Cost Per Person" : "Hotel Cost Per Person";
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">'. $label .'</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $occ_arr = explode('__', $occ);
//                             $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

//                             if ($nights == 0) {
//                                 $cost_with_total = $occupancy_cost + $grand_total_pp;
//                             } else {
//                                 $cost_with_total = $occupancy_cost;
//                             }
//                             $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

//                             $cost_html .= '<td style="background-color: #f8d9d9;">$' . $converted . '</td>';
//                         }
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             if ($nights != 0) {
//                 $total_cols = 0;
//                 foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                     foreach ($hotels as $hotel_name => $categories) {
//                         foreach ($categories as $cat => $occupancies) {
//                             if (is_array($occupancies)) {
//                                 $total_cols += count($occupancies);
//                             }
//                         }
//                     }
//                 }
//                 $converted_other = ($currency->country_currency_value > 0) 
//                     ? round($grand_total_pp / $currency->country_currency_value) 
//                     : 0;
//                 $cost_html .= '<tr>
//                     <th style="background-color:#90e0ef;">Other Cost Per Person</th>
//                     <td colspan="'.$total_cols.'" style="background-color:#f8d9d9;"> $'.$converted_other.'</td>
//                 </tr>';
//             }
//             $cost_html .= '</table>';
//           if ($nights != 0) {

//                 // Step 1: Group hotels by rating & city
//                 $hotels_by_city = [];
//                 foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                     foreach ($hotels as $hotel_name => $categories) {
//                         $city = $categories['hotel_city'] ?? 'Unknown';
//                         $hotels_by_city[$rating_key][$city][] = [
//                             'name' => $hotel_name,
//                             'nights' => $categories['nights'],
//                             'categories' => $categories
//                         ];
//                     }
//                 }

//                 // Step 2: Pair hotels city-wise
//                 $paired_combos = [];
//                 foreach ($hotels_by_city as $rating => $cities) {
//                     $city_lists = array_values($cities); 
//                     $max_count = max(array_map('count', $city_lists));

//                     for ($i = 0; $i < $max_count; $i++) {
//                         $combo = [];
//                         foreach ($city_lists as $city_hotels) {
//                             $hotel = $city_hotels[$i] ?? null;
//                             if ($hotel) $combo[] = $hotel;
//                         }
//                         if (!empty($combo)) $paired_combos[$rating][] = $combo;
//                     }
//                 }

//                 // Step 3: Merge costs per occupancy
//                 $all_occupancies = [];
//                 $grouped_combos = [];
//                 foreach ($paired_combos as $rating => $combos) {
//                     foreach ($combos as $combo) {
//                         $group_name = implode(" + ", array_map(fn($h) => $h['name']." (".$h['categories']['hotel_city'].") ".$h['nights']."N", $combo));
//                         $merged_costs = [];

//                         foreach ($combo as $hotel) {
//                             foreach ($hotel['categories'] as $cat => $occupancies) {
//                                 if (!is_array($occupancies)) continue;
//                                 foreach ($occupancies as $occ) {
//                                     $occ_arr = explode('__', $occ);
//                                     $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
//                                     $occ_cost = floatval($occ_arr[1] ?? 0);
//                                     $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
//                                     $all_occupancies[$occ_type] = true;
//                                 }
//                             }
//                         }
                        
//                         $grouped_combos[$rating][$group_name] = $merged_costs;
//                     }
//                 }
//                 $total_cols = 0;
//                         foreach ($grouped_combos as $rating => $combos) {
//                             foreach ($combos as $group_name => $costs) {
//                                 $total_cols += count($costs);
//                             }
//                         }


//                 // Step 4: Build HTML table
//                 $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
//                 $cost_html .= '<tr><th colspan="'.$total_cols.'" style="background-color:#90e0ef;">Package Cost With Hotel</th></tr>';

//                 foreach ($grouped_combos as $rating => $combos) {
//                     $cost_html .= '<tr><th colspan="'.(count($combos)+1).'" style="background-color:#d0fae8;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';

//                     // Header row
//                     $cost_html .= '<tr><th style="background-color:#90e0ef;">Occupancy</th>';
//                     foreach ($combos as $group_name => $costs) {
//                         $cost_html .= '<th style="background-color:#f8d9d9;">'.$group_name.'</th>';
//                     }
//                     $cost_html .= '</tr>';

//                     // Occupancy rows
//                     foreach ($all_occupancies as $occ_type => $_) {
//                         $cost_html .= '<tr><td style="font-weight:bold;">'.$occ_type.'</td>';
//                         foreach ($combos as $costs) {
//                             $occupancy_cost = isset($costs[$occ_type]) ? floatval($costs[$occ_type]) : 0;
//                             $total_cost = $occupancy_cost + $grand_total_pp;
//                             $converted = ($currency->country_currency_value > 0) 
//                                 ? round($total_cost / $currency->country_currency_value) 
//                                 : 0;

//                             $cost_html .= '<td>$'.$converted.'</td>';
//                         }
//                         $cost_html .= '</tr>';
//                     }
//                 }

//                 $cost_html .= '</table>';
//             }
//         }
//         // echo $cost_html;die();
//         // else if ($this->input->post('hdn_group_type') == 'individual') 
//         // {
//         //     $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;
//         //     $grand_total_pp = $grand_total / $total_persons;

//         //     $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//         //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//         //         $colspan = 0;
//         //         foreach ($hotels as $hotel_name => $categories) {
//         //             foreach ($categories as $cat => $occupancies) {
//         //                  if (is_array($occupancies)) {
//         //                     $colspan += count($occupancies); 
//         //                  }
//         //             }
//         //         }
//         //         $rating_display = ucwords(str_replace('_', ' ', $rating_key));
//         //         $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//         //     }
//         //     $cost_html .= '</tr>';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//         //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//         //         foreach ($hotels as $hotel_name => $categories) { 
//         //             $occ_count = 0;
//         //             foreach ($categories as $cat => $occupancies) {
//         //                 if ($cat === "nights") continue;
//         //                 $occ_count += count($occupancies);
//         //             }
//         //             $nights = isset($categories['nights']) ? $categories['nights'] : 0;
//         //             $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
//         //             $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #f2f5d6; font-weight:bold;">' . $hotel_display . '</td>';
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//         //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//         //         foreach ($hotels as $hotel_name => $categories) {
//         //             $roomCats = [];
//         //             foreach ($categories as $cat => $occupancies) {
//         //                 if (!is_array($occupancies)) continue;
//         //                 foreach ($occupancies as $occ) {
//         //                     $roomCats[] = $cat;
//         //                 }
//         //             }
//         //             $prev = null;
//         //             $span = 0;
//         //             foreach ($roomCats as $i => $cat) {
//         //                 if ($cat === $prev) {
//         //                     $span++;
//         //                 } else {
//         //                     if ($prev !== null) {
//         //                         $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//         //                         $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//         //                     }
//         //                     $prev = $cat;
//         //                     $span = 1;
//         //                 }
//         //             }
//         //             if ($prev !== null) {
//         //                 $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//         //                 $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//         //             }
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Occupancy</th>';
//         //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//         //         foreach ($hotels as $hotel_name => $categories) {
//         //             foreach ($categories as $cat => $occupancies) {
//         //                 if (!is_array($occupancies)) continue;
//         //                 foreach ($occupancies as $occ) {
//         //                     $occ_arr = explode('__', $occ);
//         //                     $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
//         //                     $cost_html .= '<td style="background-color: #e2f0cb;">' . $occupancy_type . '</td>';
//         //                 }
//         //             }
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
//         //     $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
//         //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//         //         foreach ($hotels as $hotel_name => $categories) {
//         //             foreach ($categories as $cat => $occupancies) {
//         //                 if (!is_array($occupancies)) continue;
//         //                 foreach ($occupancies as $occ) {
//         //                     $occ_arr = explode('__', $occ);
//         //                     $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

//         //                     $cost_with_total = $occupancy_cost + $grand_total_pp;
//         //                     $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

//         //                     $cost_html .= '<td style="background-color: #f8d9d9;">$' . $converted . '</td>';
//         //                 }
//         //             }
//         //         }
//         //     }
//         //     $cost_html .= '</tr>';
//         //     $cost_html .= '</table>';
//         // }

//         // else if($this->input->post('hdn_group_type') == 'individual')
//         // {
//         //     $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
//         //     $grand_total_pp = $grand_total/$total_persons;
//         //     foreach($hotel_costing_category_wise AS $key=>$hotel_names){                
//         //         foreach($hotel_names AS $h_name=>$categories){
//         //             $cnt = 1;
//         //             $cost_html.= '<tr style="background-color:#f1f8ff;"><td colspan="12" align="left">'.$h_name.' ('.str_replace('_',' ',$key).')'.'</td></tr>';
//         //             foreach($categories AS $c_name=>$occupancy){
//         //                 foreach($occupancy AS $occ){
//         //                     $occ_arr = explode('__',$occ);
//         //                     $txt = $occ_arr[0]. ' '.round(($occ_arr[1]+$grand_total_pp)/$currency->country_currency_value).' U$';
//         //                     $cost_html.= '<tr style="font-weight:bold;"><td colspan="12" align="left">'.$cnt.'). '.$c_name.' - '.$txt.' (PP)</td></tr>';
//         //                     $cnt++;
//         //                 }
//         //             }
//         //         }
//         //     }
            
//         // }
//         // echo $cost_html;die();
//         $flight_details='<div class="title"><h4>FLIGHT DETAILS</h4></div>
//                         <div class="text">
//                             <div class="flight-wrapper">
//                                 <div class="flight-card from">
//                                     <div class="card-header"> <i class="fa-solid fa-plane-departure"></i> From (Departure)</div>
//                                     <div class="flight-row">
//                                         <div class="label">City Of Origin:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('origin_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">City of Arrival:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Arrival Airline:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Arrival Time:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_time').'</div>
//                                     </div>
//                                 </div>
//                                 <div class="flight-card to">
//                                     <div class="card-header"><i class="fa-solid fa-plane-arrival"></i> To (Arrival)</div>
//                                     <div class="flight-row">
//                                         <div class="label">Departure City:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departure_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Departing Airline:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Departing Time:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_time').'</div>
//                                     </div>
//                                 </div>
//                             </div>
//                     </div>';

// $only_itinerary_html = '
// <div class="text">
//     <div class="itinerary-table">
//         <div class="itinerary-header">
//             <div class="col-one">
//                 <b>Day</b>
//             </div>
//             <div class="col-two">
//                 <b>Activity</b>
//             </div>
//         </div>';

// $total_transportation_outside = 0;
// $total_transportation_inside = 0;
// $n = 0;

// for ($i = 0; $i < $cnt; $i++) {
//     $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;
    
//     // Skip day if no activity
//     if ($cnt_text == 0) continue;

//     $only_itinerary_html .= '
//         <div class="itinerary-item">
//             <div class="col-one">
//                 <span>Day ' . ($i + 1) . '</span>
//             </div>
//             <div class="col-two">
//                 <ul style="padding: 0;">';

//     for ($j = 0; $j < $cnt_text; $j++) {
//         $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' : '';
//         $only_itinerary_html .= '<li>' . $t . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';

//         if (!empty($this->input->post('itinerary_activities_'.$i))) {
//             foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
//                 if ($activity != "") {
//                     $only_itinerary_html .= '<li style="margin-left:15px;">' . $activity . '</li>';
//                 }
//             }
//         }
//     }
//     $only_itinerary_html .= '
//                 </ul>
//             </div>
//         </div>';

//     $n++;

//     if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
//         $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
//     }

//     if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
//         $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
//     }
// }

// $only_itinerary_html .= '
//     </div>
// </div>';

// // echo $only_itinerary_html;
// // die();

//         $short_itinerary='<div class="title">
//             <h4>DAY WISE SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
//         </div>';
        
//         $inclusions=' <div class="title">
//             <h4>OUR INCLUSIONS</h4>
//         </div>
//         <div class="text" style="margin-top:-20px !important;">
//             <div class="our-inclusion">
//              <div class="inclusion-item">
//                     <div class="box">
//                         <h4>Complementory Services</h4>
//                         <ul>';
//                 $mandatory_services_json = $_POST['mandatory_services'] ?? '[]';
//                 $mandatory_services = json_decode($mandatory_services_json, true);
//                              if (!empty($mandatory_services)) {
//                                 foreach ($mandatory_services as $service) {
//                                     $service_text = explode("_|_", $service['service'])[0];
//                                     $price = explode("_|_", $service['service'])[1];
//                                     $qnty = $service['qnty'];
//                                     $inclusions .="<li>{$service_text} - {$qnty}</li>";
//                                 }
//                             } else {
//                                  $inclusions .="<li>No mandatory services provided.</li>";
//                             }

//             $inclusions.='</li></div>
//                 </div>
//                 <div class="inclusion-item">
//                     <div class="box">
//                         <h4>Transportation</h4>
//                         <ul>
//                             <li>All transfers & sightseeing by private vehicle ( Sedan ) for 12 Hrs (10AM – 10PM Only, Within City Limits)  </li>
//                             <li>Airport – hotel – airport transfers</li>
//                             <li>Airprt Pic</li>
//                             <li>Airport Drop</li>
//                             <li>Dinner Transfers</li>
//                         </ul>
//                     </div>
//                 </div>
//                 <div class="inclusion-item">
//                     <div class="box">
//                         <h4>Guide</h4>
//                         <ul>
//                             <li>All transfers & sightseeing include services of an English-speaking Guide.</li>
//                             <li>Airport meet & greet by our English-speaking staff.</li>
//                             <li>Departure souvenir gift.</li>
//                         </ul>
//                     </div>
//                 </div>
//             </div>
//         </div>';
//         // die();
        
// //         echo '<!DOCTYPE html><html><head>
// //         <meta charset="UTF-8" />
// //     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
// //     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
// //     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
// //                 <style>
// //                     th, td {
// //                         padding: 5px;
// //                         text-align: left;
// //                     }
// //                     .header {
// //                         background-color: #cfe0f2;
// //                         margin: -50px -50px !important;
// //                         text-align: left ;
// //                     }
// //                         .title {
// //             padding: 12px 20px;
// //             margin:15px 0px;
// //             background-color: antiquewhite;
// //             text-align: center;
// //         }
// //                     label {
// //                         font-weight: bold;
// //                     }
// //                         .flight-wrapper {
// //             display: flex;
// //             gap: 20px;
// //             justify-content: center;
// //         }
// //         .flight-card {
// //             background-color: #fff;
// //             border: solid 1px #ccc;
// //             /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); */
// //             width: calc(50% - 10px);
// //             padding: 15px 24px;
// //         }
// //             .card-header {
// //             font-size: 16px;
// //             font-weight: 600;
// //             color: #2e3b4e;
// //             border-bottom: dashed 1px #ccc;
// //             margin-bottom: 6px;
// //             padding-bottom: 15px;
// //             display: flex;
// //             align-items: center;
// //             gap: 8px;
// //         }
// //         .flight-row {
// //             margin-bottom: 4px;
// //             display: flex;
// //             justify-content: space-between;
// //         }
// //             .label {
// //             font-size: 12px;
// //             color: #778093;
// //             text-transform: uppercase;
// //             margin-bottom: 4px;
// //         }

// //         .value {
// //             font-size: 14px;
// //             font-weight: 500;
// //             color: #2d3748;
// //         }
// //             .title>h4 {
// //             padding: 0;
// //             margin: 0;
// //             color: #000;
// //             text-decoration: none;
// //             text-transform: capitalize;
// //         }
// //             .itinerary-header {
// //             color: #fff;
// //             /* color: #fff; */
// //             /* background-color: #f56100e3; */
// //             background-color: #8299b0;
// //             display: flex;
// //             padding: 10px;
// //         }

// //         .col-one {
// //             width: 20% !important;
// //         }

// //         .itinerary-item {
// //             display: flex;
// //             padding: 8px 10px;
// //             /* border-bottom: solid 2px #8299b0; */
// //             /* border-bottom: solid 2px #e4e4e4; */
// //             /* border-bottom: dashed 2px #e4e4e4; old*/
// //             border-bottom: dashed 1.6px #8299b070;
// //             align-items: center;
// //         }

// //         .col-one>span {
// //             font-size: 18px;
// //             color: #3c556e;
// //             font-weight: 500;
// //         }

// //         .col-two {
// //             border-left: solid 1px #8299b0;
// //             padding-left: 45px;
// //             width: 80% !important;
// //         }

// //         .col-two>ul {
// //             margin: 0;
// //         }
// //             .our-inclusion {
// //             display: flex;
// //             gap: 20px;
// //         }

// //         .inclusion-item {
// //             width: 33%;
// //         }

// //         .box {
// //             width: 100%;
// //             height: 90%;
// //             border-left: solid 1px #ccc;
// //             background-color: #ebf3fa;
          
// //         }

// //         .box h4 {
// //             padding-left: 12px;
// //             padding-top: 12px;
// //         }

// //         .inclusion-item ul li {
// //             position: relative;
// //             list-style: none;
// //             color: #555555;
// //         }

// //         .inclusion-item ul li::before {
// //             content: "❖";
// //             position: absolute;
// //             color: #242424;
// //             left: -22px;
// //             font-size: 11px;
// //             top: 0;
// //         }
// //           .activites-item {
// //             background: #fffbfb;
// //             display: flex;
// //             /* width: 33.33%; */
// //             padding: 8px 20px;
// //             margin-bottom: 6px;
// //         }
// //         .our-activites {
// //             display: flex;
// //         }
// //         .activites-item>div:nth-child(1) {
// //             width: 10%;
// //         }
// //         .activites-item>div:nth-child(2) {
// //             width: 6%;
// //         }
// //         .activites-item>div:nth-child(3) {
// //             width: 80%;
// //         }
// //         .our-activites>div {
// //             width: 33.33%;
// //         }
// //         .activites-item i {
// //             color: #6c6c6c;
// //         }
// //                 </style>
// //             </head><body>
// //                 <div class="table-container">
// //                     <div class="header">
// //                         <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
// //                     </div>
// //                     <table style="width:100%;">
// //                         <tr><td colspan="12" align="left">Dear Team,</td></tr>
// //                         <tr><td colspan="12"></td></tr>
// //                         <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
// //                         <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
// //                         <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
// //                         <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
// //                         <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
// //                         <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
// //                         <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
// //                         <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
// //                         <br>
// //                         <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:red;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
// //                     <br><br>
// //                         <tr><td style="background-color:#f2dafc;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
// //                         <tr><td style="background-color:#44f8db40;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
// //                         <tr><td style="background-color:#5f9ea040;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
// //                         <tr><td colspan="12" align="left">Click here for brief itinerary <a href="' . base_url('brief-itinerary/' . $enquiry_id) . '"  target="_blank">(Link)</a></td></tr>
// //                         <tr><td colspan="12" align="left" height="25px"></td></tr>
// //                         <tr><td colspan="12" align="left">Regards,</td></tr>
// //                         <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
// //                     </table>
// //                 </div>
// //             </body></html>';
// // echo $cost_html;
// // die();
//         $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
//         $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

//         $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
//             'subject' => $email_subject,
//             'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'to' => [[ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
//                     [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
//                     ],
//             'htmlContent' => '<!DOCTYPE html><html><head>
//         <meta charset="UTF-8" />
//     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
//     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
//     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
//                 <style>
//                     th, td {
//                         padding: 5px;
//                         text-align: left;
//                     }
//                     .header {
//                         background-color: #cfe0f2;
//                         margin: -50px -50px !important;
//                         text-align: left ;
//                     }
//                         .title {
//             padding: 12px 20px;
//             margin:15px 0px;
//             background-color: antiquewhite;
//             text-align: center;
//         }
//                     label {
//                         font-weight: bold;
//                     }
//                         .flight-wrapper {
//             display: flex;
//             gap: 20px;
//             justify-content: center;
//         }
//         .flight-card {
//             background-color: #fff;
//             border: solid 1px #ccc;
//             width: calc(50% - 10px);
//             padding: 15px 24px;
//         }
//             .card-header {
//             font-size: 16px;
//             font-weight: 600;
//             color: #2e3b4e;
//             border-bottom: dashed 1px #ccc;
//             margin-bottom: 6px;
//             padding-bottom: 15px;
//             display: flex;
//             align-items: center;
//             gap: 8px;
//         }
//         .flight-row {
//             margin-bottom: 4px;
//             display: flex;
//             justify-content: space-between;
//         }
//             .label {
//             font-size: 12px;
//             color: #778093;
//             text-transform: uppercase;
//             margin-bottom: 4px;
//         }

//         .value {
//             font-size: 14px;
//             font-weight: 500;
//             color: #2d3748;
//         }
//             .title>h4 {
//             padding: 0;
//             margin: 0;
//             color: #000;
//             text-decoration: none;
//             text-transform: capitalize;
//         }
//             .itinerary-header {
//             color: #fff;
//             /* color: #fff; */
//             /* background-color: #f56100e3; */
//             background-color: #8299b0;
//             display: flex;
//             padding: 10px;
//         }

//         .col-one {
//             width: 20% !important;
//         }

//         .itinerary-item {
//             display: flex;
//             padding: 8px 10px;
//             /* border-bottom: solid 2px #8299b0; */
//             /* border-bottom: solid 2px #e4e4e4; */
//             /* border-bottom: dashed 2px #e4e4e4; old*/
//             border-bottom: dashed 1.6px #8299b070;
//             align-items: center;
//         }

//         .col-one>span {
//             font-size: 18px;
//             color: #3c556e;
//             font-weight: 500;
//         }

//         .col-two {
//             border-left: solid 1px #8299b0;
//             padding-left: 45px;
//             width: 80% !important;
//         }

//         .col-two>ul {
//             margin: 0;
//         }
//             .our-inclusion {
//             display: flex;
//             gap: 20px;
//         }

//         .inclusion-item {
//             width: 33%;
//         }

//         .box {
//             width: 100%;
//             height: 90%;
//             border-left: solid 1px #ccc;
//             background-color: #ebf3fa;
          
//         }

//         .box h4 {
//             padding-left: 12px;
//             padding-top: 12px;
//         }

//         .inclusion-item ul li {
//             position: relative;
//             list-style: none;
//             color: #555555;
//         }

//         .inclusion-item ul li::before {
            
//             position: absolute;
//             color: #242424;
//             left: -22px;
//             font-size: 11px;
//             top: 0;
//         }
//           .activites-item {
//             background: #fffbfb;
//             display: flex;
//             /* width: 33.33%; */
//             padding: 8px 20px;
//             margin-bottom: 6px;
//         }
//         .our-activites {
//             display: flex;
//         }
//         .activites-item>div:nth-child(1) {
//             width: 10%;
//         }
//         .activites-item>div:nth-child(2) {
//             width: 6%;
//         }
//         .activites-item>div:nth-child(3) {
//             width: 80%;
//         }
//         .our-activites>div {
//             width: 33.33%;
//         }
//         .activites-item i {
//             color: #6c6c6c;
//         }
//                 </style>
//             </head><body>
//                 <div class="table-container">
//                     <div class="header">
//                         <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
//                     </div>
//                     <table style="width:100%;">
//                         <tr><td colspan="12" align="left">Dear Team,</td></tr>
//                         <tr><td colspan="12"></td></tr>
//                         <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
//                         <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
//                         <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
//                         <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
//                         <br>
//                         <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:red;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
//                     <br><br>
//                         <tr><td style="background-color:#f2dafc;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
//                         <tr><td style="background-color:#44f8db40;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
//                         <tr><td style="background-color:#5f9ea040;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
//                         <tr><td colspan="12" align="left">Click here for brief itinerary <a href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">(Link)</a></td></tr>
//                         <tr><td colspan="12" align="left" height="25px"></td></tr>
//                         <tr><td colspan="12" align="left">Regards,</td></tr>
//                         <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
//                     </table>
//                 </div>
//             </body></html>',
//              /*'params' => ['bodyMessage' => '']*/
//         ]);

//         try {
//             $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
//             //print_r($sendinblue_response);
//         } catch (Exception $e) {
//             //echo $e->getMessage(),PHP_EOL;
//         }
        
//         $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
//         echo json_encode($response);
//         exit;		
//     }  

//   public function save_and_email_new()
//     {
//         $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required'); 
//         $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
//         $this->form_validation->set_error_delimiters('', '<br>');  
//         if($this->form_validation->run() == FALSE){
//             echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
//             exit;
//         }
//         $cnt = count($this->input->post('itinerary_date'));
//         $created = date('Y-m-d H:i:s');
//         $enquiry_id = $this->input->post('enquiry_id');
    
//         $where = ' enquiry.id = '.$enquiry_id;
//         $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
//                  ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
//         $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

//         $total_persons = $enquiry->number_persons + $enquiry->number_child;
//         $char = substr($enquiry->enquiry_abbr, 1, 2);
//         $country = COUNTRY_ABBR;
//         $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active"';
//         $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

//         $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
        
//         $stay_html = '';
//         /*if(array_key_exists('hotel_nights', $this->input->post())){
//             $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//             $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
//             $stay_html .= '<ol>';
//             $hotel_nights = json_decode($this->input->post('hotel_nights'));
//             foreach($hotel_nights AS $key=>$list){
//                 $h_name = explode('_',$key);
//                 $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
//             }
//             $stay_html .= '</ol></td></tr>';
//         }*/
        
//         $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
//         $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
//             <div>
//             <h4 class="title">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
//                 <h4>
//             </div>
//         <tbody>
//             '.$stay_html.$transportation_guide.'<tr style="">
//             <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
//         // $total_transportation_outside = 0;
//         // $total_transportation_inside = 0;
//         $total_transportation = 0;
//         $n=0;
//         $html .= '<ol>'; 
//         for($i=0;$i<$cnt;$i++){            
//             $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
//             for($j=0;$j<$cnt_text;$j++){
//                 if($j==0){
//                     //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
//                 }
//                 $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
//                 $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
//                 //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
//                 if(!empty($this->input->post('itinerary_activities_'.$i))){
//                     $html .= '<ul>';
//                     foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
//                         if($activity != ""){
//                             $html .= '<li>'.$activity.'</li>';
//                         }
//                     }
//                     $html .= '</ul>';
//                 }
//             }
//             $n++;
//             // if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
//             //     $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
//             // }
//             // if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
//             //     $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
//             // }
//             // if(array_key_exists('hdn_travel_city_cost_'.$i,$this->input->post())){
//             //     $hdn_travel_city_cost = $hdn_travel_city_cost + $this->input->post('hdn_travel_city_cost_'.$i);
//             // }
//         }
//         $html .= '</ol><br>';
        
//         $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
//         $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
//         $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
//         // $total_transportation = $total_transportation_outside + $total_transportation_inside;
//         // if(array_key_exists('hdn_airport_in_total',$this->input->post())){
//         //     $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
//         // }
//         if(array_key_exists('final_transport',$this->input->post())){
//             $total_transportation = $this->input->post('final_transport');
//         }
//         //echo 'Transportation : '.$total_transportation.'<br>';
        
//         $activities_total = 0;
//         if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
//             foreach($this->input->post('hdn_activities_total') AS $list)
//                 {
//                 $activities_total = $activities_total + (int)$list;
//             }
//         }
//         $restaurants_grand_total = 0;
//         /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
//             $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
//         }*/
//         $guide_grand_total = 0;
//         if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
//             $guide_grand_total = (int)$this->input->post('hdn_guide_grand_total');
//         }
//         // echo 'Guide : '.$guide_grand_total. '<br>';
//         $hdn_mandatory_grand_total = 0;
//         if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
//             $hdn_mandatory_grand_total = $this->input->post('hdn_mandatory_grand_total');
//         }
//         $all_day_activities_total = 0;
//         if(array_key_exists('all_day_activities_total',$this->input->post())){
//             $all_day_activities_total = $this->input->post('all_day_activities_total');
//         }
       
//         $hdn_final_ticket_price = 0;
//         if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
//             $hdn_final_ticket_price = $this->input->post('hdn_final_ticket_price');
//         }
//         // echo 'Ticket Price : '.$hdn_final_ticket_price. '<br>';
//         if(array_key_exists('hotel_names_category_wise', $this->input->post())){
//             $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
//             // print_r($hotel_names_category_wise);
//         }
//         if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
//             $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
//         }
//         if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
//             $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
//         }
//         $cost_html = '';
//         if ($this->input->post('hdn_group_type') == 'family') 
//         {
//             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
//                 $colspan = max(count($hotels), 1); 
//                 $rating_display = ucwords(str_replace('_', ' ', $rating_key));

//                 $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotelId => $hotelName) {
//                     $cost_html .= '<td style="background-color: #f2f5d6;">' . $hotelName . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//             foreach ($hotel_room_category_names_wise as $rating_key => $room_cat_list) {
//                 if (!is_array($room_cat_list)) continue;
//                 foreach ($room_cat_list as $room_cat_name) {
//                     $cost_html .= '<td style="background-color: #f2dafc;">' . $room_cat_name . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotelId => $hotelName) {
//                     $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;
//                     $grand_total = $total_transportation + $hotel_cost + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price ;

//                     $markup_percentage = floatval($this->input->post('markup_percentage'));
//                     $grand_total += ($grand_total * ($markup_percentage / 100));

//                     $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
//                         ? round(($grand_total / $total_persons) / $currency->country_currency_value)
//                         : 0;

//                     $cost_html .= '<td style="background-color: #f8d9d9;">$' . $per_person_cost . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';

//             $cost_html .= '</table>';

//         }
//         else if ($this->input->post('hdn_group_type') == 'individual') 
//         {
//             $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price;
         
//             $grand_total_pp = $grand_total / $total_persons;

//             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 $colspan = 0;
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                          if (is_array($occupancies)) {
//                             $colspan += count($occupancies); 
//                          }
//                     }
//                 }
//                 $rating_display = ucwords(str_replace('_', ' ', $rating_key));
//                 $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//             }
//             $cost_html .= '</tr>';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) { 
//                     $occ_count = 0;
//                     foreach ($categories as $cat => $occupancies) {
//                     if ($cat === "nights") continue;
//                         if (is_array($occupancies)) {
//                             $occ_count += count($occupancies);
//                         }
//                     }

//                     $nights = isset($categories['nights']) ? $categories['nights'] : 0;
//                     $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
//                     $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #f2f5d6; font-weight:bold;">' . $hotel_display . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
//           $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     $roomCats = [];
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $roomCats[] = $cat;
//                         }
//                     }
//                     $prev = null;
//                     $span = 0;
//                     foreach ($roomCats as $i => $cat) {
//                         if ($cat === $prev) {
//                             $span++;
//                         } else {
//                             if ($prev !== null) {
//                                 $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//                                 $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//                             }
//                             $prev = $cat;
//                             $span = 1;
//                         }
//                     }
//                     if ($prev !== null) {
//                         $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
//                         $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Occupancy</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $occ_arr = explode('__', $occ);
//                             $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
//                             $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
//                             $occupancy_type = trim($occupancy_type);
//                             $cost_html .= '<td style="background-color: #e2f0cb;">' . $occupancy_type . '</td>';
//                         }
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             $label = ($nights == 0) ? "Cost Per Person" : "Hotel Cost Per Person";
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">'. $label .'</th>';
//             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                 foreach ($hotels as $hotel_name => $categories) {
//                     foreach ($categories as $cat => $occupancies) {
//                         if (!is_array($occupancies)) continue;
//                         foreach ($occupancies as $occ) {
//                             $occ_arr = explode('__', $occ);
//                             $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

//                             if ($nights == 0) {
//                                 $cost_with_total = $occupancy_cost + $grand_total_pp;
//                             } else {
//                                 $cost_with_total = $occupancy_cost;
//                             }
//                             $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

//                             $cost_html .= '<td style="background-color: #f8d9d9;">$' . $converted . '</td>';
//                         }
//                     }
//                 }
//             }
//             $cost_html .= '</tr>';
//             if ($nights != 0) {
//                 $total_cols = 0;
//                 foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                     foreach ($hotels as $hotel_name => $categories) {
//                         foreach ($categories as $cat => $occupancies) {
//                             if (is_array($occupancies)) {
//                                 $total_cols += count($occupancies);
//                             }
//                         }
//                     }
//                 }
//                 $converted_other = ($currency->country_currency_value > 0) 
//                     ? round($grand_total_pp / $currency->country_currency_value) 
//                     : 0;
//                 $cost_html .= '<tr>
//                     <th style="background-color:#90e0ef;">Other Cost Per Person</th>
//                     <td colspan="'.$total_cols.'" style="background-color:#f8d9d9;"> $'.$converted_other.'</td>
//                 </tr>';
//             }
//             $cost_html .= '</table>';

//           if ($nights != 0) {

//                 $hotels_by_city = [];
//                 foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
//                     foreach ($hotels as $hotel_name => $categories) {
//                         $city = $categories['hotel_city'] ?? 'Unknown';
//                         $hotels_by_city[$rating_key][$city][] = [
//                             'name' => $hotel_name,
//                             'nights' => $categories['nights'],
//                             'categories' => $categories
//                         ];
//                     }
//                 }

//                 $paired_combos = [];
//                 foreach ($hotels_by_city as $rating => $cities) {
//                     $city_lists = array_values($cities); 
//                     $max_count = max(array_map('count', $city_lists));

//                     for ($i = 0; $i < $max_count; $i++) {
//                         $combo = [];
//                         foreach ($city_lists as $city_hotels) {
//                             $hotel = $city_hotels[$i] ?? null;
//                             if ($hotel) $combo[] = $hotel;
//                         }
//                         if (!empty($combo)) $paired_combos[$rating][] = $combo;
//                     }
//                 }

//                 $all_occupancies = [];
//                 $grouped_combos = [];
//                 foreach ($paired_combos as $rating => $combos) {
//                     foreach ($combos as $combo) {
//                         $group_name = implode(" + ", array_map(fn($h) => $h['name']." (".$h['categories']['hotel_city'].") ".$h['nights']."N", $combo));
//                         $merged_costs = [];

//                         foreach ($combo as $hotel) {
//                             foreach ($hotel['categories'] as $cat => $occupancies) {
//                                 if (!is_array($occupancies)) continue;
//                                 foreach ($occupancies as $occ) {
//                                     $occ_arr = explode('__', $occ);
//                                     $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
//                                     $occ_cost = floatval($occ_arr[1] ?? 0);
//                                     $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
//                                     $all_occupancies[$occ_type] = true;
//                                 }
//                             }
//                         }
                        
//                         $grouped_combos[$rating][$group_name] = $merged_costs;
//                     }
//                 }
//                 $total_cols = 0;
//                         foreach ($grouped_combos as $rating => $combos) {
//                             foreach ($combos as $group_name => $costs) {
//                                 $total_cols += count($costs);
//                             }
//                         }

//                 $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
//                 $cost_html .= '<tr><th colspan="'.$total_cols.'" style="background-color:#90e0ef;">Package Cost With Hotel</th></tr>';

//                 foreach ($grouped_combos as $rating => $combos) {
//                     $cost_html .= '<tr><th colspan="'.(count($combos)+1).'" style="background-color:#d0fae8;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';

//                     $cost_html .= '<tr><th style="background-color:#90e0ef;">Occupancy</th>';
//                     foreach ($combos as $group_name => $costs) {
//                         $cost_html .= '<th style="background-color:#f8d9d9;">'.$group_name.'</th>';
//                     }
//                     $cost_html .= '</tr>';

//                     foreach ($all_occupancies as $occ_type => $_) {
//                         $cost_html .= '<tr><td style="font-weight:bold;">'.$occ_type.'</td>';
//                         foreach ($combos as $costs) {
//                             $occupancy_cost = isset($costs[$occ_type]) ? floatval($costs[$occ_type]) : 0;
//                             $total_cost = $occupancy_cost + $grand_total_pp;
//                             $converted = ($currency->country_currency_value > 0) 
//                                 ? round($total_cost / $currency->country_currency_value) 
//                                 : 0;
//                             $cost_html .= '<td>$'.$converted.'</td>';
//                         }
//                         $cost_html .= '</tr>';
//                     }
//                 }

//                 $cost_html .= '</table>';
//             }
//         }

//         $flight_details='<div class="title"><h4>FLIGHT DETAILS</h4></div>
//                         <div class="text">
//                             <div class="flight-wrapper">
//                                 <div class="flight-card from">
//                                     <div class="card-header"> <i class="fa-solid fa-plane-departure"></i> From (Departure)</div>
//                                     <div class="flight-row">
//                                         <div class="label">City Of Origin:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('origin_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">City of Arrival:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Arrival Airline:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Arrival Time:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_time').'</div>
//                                     </div>
//                                 </div>
//                                 <div class="flight-card to">
//                                     <div class="card-header"><i class="fa-solid fa-plane-arrival"></i> To (Arrival)</div>
//                                     <div class="flight-row">
//                                         <div class="label">Departure City:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departure_city').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Departing Airline:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
//                                     </div>
//                                     <div class="flight-row">
//                                         <div class="label">Departing Time:</div>
//                                         <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_time').'</div>
//                                     </div>
//                                 </div>
//                             </div>
//                     </div>';

//             $only_itinerary_html = '
//             <div class="text">
//                 <div class="itinerary-table">
//                     <div class="itinerary-header">
//                         <div class="col-one">
//                             <b>Day</b>
//                         </div>
//                         <div class="col-two">
//                             <b>Activity</b>
//                             <b style="display: inline-block; float: right;">
//                                 To view the detailed itinerary, click or download here. 
//                                 <a style="color:#fff;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">(Link)</a>
//                             </b>
//                         </div>
                       
//                     </div>';

//             $total_transportation_outside = 0;
//             $total_transportation_inside = 0;
//             $n = 0;

//             for ($i = 0; $i < $cnt; $i++) {
//                 $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;
//                 if ($cnt_text == 0) continue;

//                 $only_itinerary_html .= '
//                     <div class="itinerary-item">
//                         <div class="col-one">
//                             <span>Day ' . ($i + 1) . '</span>
//                         </div>
//                         <div class="col-two">
//                             <ul style="padding: 0;">';

//                 for ($j = 0; $j < $cnt_text; $j++) {
//                     $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' : '';
//                     $only_itinerary_html .= '<li>' . $t . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';

//                     if (!empty($this->input->post('itinerary_activities_'.$i))) {
//                         foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
//                             if ($activity != "") {
//                                 $only_itinerary_html .= '<li style="margin-left:15px;">' . $activity . '</li>';
//                             }
//                         }
//                     }
//                 }
//                 $only_itinerary_html .= '
//                             </ul>
//                         </div>
//                     </div>';

//                 $n++;

//                 if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
//                     $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
//                 }

//                 if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
//                     $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
//                 }
//             }

//             $only_itinerary_html .= '
//                 </div>

//             </div>';



//                 $short_itinerary='<div class="title">
//                     <h4>DAY WISE SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
//                 </div>';
                
//                 $inclusions=' <div class="title">
//                     <h4>OUR INCLUSIONS</h4>
//                 </div>
//                 <div class="text" style="margin-top:-20px !important;">
//                     <div class="our-inclusion">
//                     <div class="inclusion-item">
//                             <div class="box">
//                                 <h4>Complementory Services</h4>
//                                 <ul>';
//                         $mandatory_services_json = $_POST['mandatory_services'] ?? '[]';
//                         $mandatory_services = json_decode($mandatory_services_json, true);
//                                     if (!empty($mandatory_services)) {
//                                         foreach ($mandatory_services as $service) {
//                                             $service_text = explode("_|_", $service['service'])[0];
//                                             $price = explode("_|_", $service['service'])[1];
//                                             $qnty = $service['qnty'];
//                                             $inclusions .="<li>{$service_text} - {$qnty}</li>";
//                                         }
//                                     } else {
//                                         $inclusions .="<li>No mandatory services provided.</li>";
//                                     }

//                     $inclusions.='</li></div>
//                         </div>
//                         <div class="inclusion-item">
//                             <div class="box">
//                                 <h4>Transportation</h4>
//                                 <ul>
//                                     <li>All transfers & sightseeing by private vehicle ( Sedan ) for 12 Hrs (10AM – 10PM Only, Within City Limits)  </li>
//                                     <li>Airport – hotel – airport transfers</li>
//                                     <li>Airprt Pic</li>
//                                     <li>Airport Drop</li>
//                                     <li>Dinner Transfers</li>
//                                 </ul>
//                             </div>
//                         </div>
//                         <div class="inclusion-item">
//                             <div class="box">
//                                 <h4>Guide</h4>
//                                 <ul>
//                                     <li>All transfers & sightseeing include services of an English-speaking Guide.</li>
//                                     <li>Airport meet & greet by our English-speaking staff.</li>
//                                     <li>Departure souvenir gift.</li>
//                                 </ul>
//                             </div>
//                         </div>
//                     </div>
//                 </div>';
               
//         $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
//         $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

//         $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
//             'subject' => $email_subject,
//             'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'to' => [
//                 [ 'name' => 'Sumeet Verma', 'email' => 'vikash.thaver@gmail.com'],
//                     [ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
//                     [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
//                     ],
//             'htmlContent' => '<!DOCTYPE html><html><head>
//         <meta charset="UTF-8" />
//             <meta name="viewport" content="width=device-width, initial-scale=1.0" />
//             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
//             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
//                 <style>
//                     th, td {
//                         padding: 5px;
//                         text-align: left;
//                     }
//                     .header {
//                         background-color: #cfe0f2;
//                         margin: -50px -50px !important;
//                         text-align: left ;
//                     }
//                         .title {
//             padding: 12px 20px;
//             margin:15px 0px;
//             background-color: antiquewhite;
//             text-align: center;
//         }
//                     label {
//                         font-weight: bold;
//                     }
//                         .flight-wrapper {
//             display: flex;
//             gap: 20px;
//             justify-content: center;
//         }
//         .flight-card {
//             background-color: #fff;
//             border: solid 1px #ccc;
//             width: calc(50% - 10px);
//             padding: 15px 24px;
//         }
//             .card-header {
//             font-size: 16px;
//             font-weight: 600;
//             color: #2e3b4e;
//             border-bottom: dashed 1px #ccc;
//             margin-bottom: 6px;
//             padding-bottom: 15px;
//             display: flex;
//             align-items: center;
//             gap: 8px;
//         }
//         .flight-row {
//             margin-bottom: 4px;
//             display: flex;
//             justify-content: space-between;
//         }
//             .label {
//             font-size: 12px;
//             color: #778093;
//             text-transform: uppercase;
//             margin-bottom: 4px;
//         }

//         .value {
//             font-size: 14px;
//             font-weight: 500;
//             color: #2d3748;
//         }
//             .title>h4 {
//             padding: 0;
//             margin: 0;
//             color: #000;
//             text-decoration: none;
//             text-transform: capitalize;
//         }
//             .itinerary-header {
//             color: #fff;
//             /* color: #fff; */
//             /* background-color: #f56100e3; */
//             background-color: #8299b0;
//             display: flex;
//             padding: 10px;
//         }

//         .col-one {
//             width: 20% !important;
//         }

//         .itinerary-item {
//             display: flex;
//             padding: 8px 10px;
//             /* border-bottom: solid 2px #8299b0; */
//             /* border-bottom: solid 2px #e4e4e4; */
//             /* border-bottom: dashed 2px #e4e4e4; old*/
//             border-bottom: dashed 1.6px #8299b070;
//             align-items: center;
//         }

//         .col-one>span {
//             font-size: 18px;
//             color: #3c556e;
//             font-weight: 500;
//         }

//         .col-two {
//             border-left: solid 1px #8299b0;
//             padding-left: 45px;
//             width: 80% !important;
//         }

//         .col-two>ul {
//             margin: 0;
//         }
//             .our-inclusion {
//             display: flex;
//             gap: 20px;
//         }

//         .inclusion-item {
//             width: 33%;
//         }

//         .box {
//             width: 100%;
//             height: 90%;
//             border-left: solid 1px #ccc;
//             background-color: #ebf3fa;
          
//         }

//         .box h4 {
//             padding-left: 12px;
//             padding-top: 12px;
//         }

//         .inclusion-item ul li {
//             position: relative;
//             list-style: none;
//             color: #555555;
//         }

//         .inclusion-item ul li::before {
            
//             position: absolute;
//             color: #242424;
//             left: -22px;
//             font-size: 11px;
//             top: 0;
//         }
//           .activites-item {
//             background: #fffbfb;
//             display: flex;
//             /* width: 33.33%; */
//             padding: 8px 20px;
//             margin-bottom: 6px;
//         }
//         .our-activites {
//             display: flex;
//         }
//         .activites-item>div:nth-child(1) {
//             width: 10%;
//         }
//         .activites-item>div:nth-child(2) {
//             width: 6%;
//         }
//         .activites-item>div:nth-child(3) {
//             width: 80%;
//         }
//         .our-activites>div {
//             width: 33.33%;
//         }
//         .activites-item i {
//             color: #6c6c6c;
//         }
//                 </style>
//             </head><body>
//                 <div class="table-container">
//                     <div class="header">
//                         <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
//                     </div>
//                     <table style="width:100%;">
//                         <tr><td colspan="12" align="left">Dears Team,</td></tr>
//                         <tr><td colspan="12"></td></tr>
//                         <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
//                         <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
//                         <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
//                         <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
//                         <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
//                         <br>
//                         <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:red;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
//                     <br><br>
//                         <tr><td style="background-color:#f2dafc;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
//                         <tr><td style="background-color:#44f8db40;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
//                         <tr><td style="background-color:#5f9ea040;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
                       
//                         <tr><td colspan="12" align="left" height="25px"></td></tr>
//                         <tr><td colspan="12" align="left">Regards,</td></tr>
//                         <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
//                     </table>
//                 </div>
//             </body></html>',
//              /*'params' => ['bodyMessage' => '']*/
//         ]);

//         try {
//             $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
//             //print_r($sendinblue_response);
//         } catch (Exception $e) {
//             //echo $e->getMessage(),PHP_EOL;
//         }
        
//         $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
//         echo json_encode($response);
//         exit;		
//     }  

    // public function save_and_email_new()
    // {
    //     $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required'); 
    //     $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
    //     $this->form_validation->set_error_delimiters('', '<br>');  
    //     if($this->form_validation->run() == FALSE){
    //         echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
    //         exit;
    //     }
    //     $cnt = count($this->input->post('itinerary_date'));
    //     $created = date('Y-m-d H:i:s');
    //     $enquiry_id = $this->input->post('enquiry_id');
    
    //     $where = ' enquiry.id = '.$enquiry_id;
    //     $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
    //              ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
    //     $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

    //     $total_persons = $enquiry->number_persons + $enquiry->number_child;
    //     $char = substr($enquiry->enquiry_abbr, 1, 2);
    //     $country = COUNTRY_ABBR;
    //     $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active"';
    //     $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

    //     $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
    //     $guide = $this->input->post('driver_cum_guide') == 'guide' ? 'Guide' : 'Driver Cum Guide';
    //     $roe = $this->input->post('roe');
    //     $stay_html = '';
    //     /*if(array_key_exists('hotel_nights', $this->input->post())){
    //         $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
    //         $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
    //         $stay_html .= '<ol>';
    //         $hotel_nights = json_decode($this->input->post('hotel_nights'));
    //         foreach($hotel_nights AS $key=>$list){
    //             $h_name = explode('_',$key);
    //             $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
    //         }
    //         $stay_html .= '</ol></td></tr>';
    //     }*/
        
    //     $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
    //     $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
    //         <div>
    //         <h4 class="title">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
    //             <h4>
    //         </div>
    //     <tbody>
    //         '.$stay_html.$transportation_guide.'<tr style="">
    //         <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
    //     $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
    //     // $total_transportation_outside = 0;
    //     // $total_transportation_inside = 0;
    //     $total_transportation = 0;
    //     $n=0;
    //     $html .= '<ol>'; 
    //     for($i=0;$i<$cnt;$i++){            
    //         $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
    //         for($j=0;$j<$cnt_text;$j++){
    //             if($j==0){
    //                 //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
    //             }
    //             $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
    //             $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
    //             //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
    //             if(!empty($this->input->post('itinerary_activities_'.$i))){
    //                 $html .= '<ul>';
    //                 foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
    //                     if($activity != ""){
    //                         $html .= '<li>'.$activity.'</li>';
    //                     }
    //                 }
    //                 $html .= '</ul>';
    //             }
    //         }
    //         $n++;
    //         // if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
    //         //     $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
    //         // }
    //         // if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
    //         //     $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
    //         // }
    //         // if(array_key_exists('hdn_travel_city_cost_'.$i,$this->input->post())){
    //         //     $hdn_travel_city_cost = $hdn_travel_city_cost + $this->input->post('hdn_travel_city_cost_'.$i);
    //         // }
    //     }
    //     $html .= '</ol><br>';
        
    //     $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
    //     $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
    //     $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
    //     $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
    //     // $total_transportation = $total_transportation_outside + $total_transportation_inside;
    //     // if(array_key_exists('hdn_airport_in_total',$this->input->post())){
    //     //     $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
    //     // }
    //     if(array_key_exists('final_transport',$this->input->post())){
    //         $total_transportation = $this->input->post('final_transport');
    //     }
    //     //echo 'Transportation : '.$total_transportation.'<br>';
        
    //     $activities_total = 0;
    //     if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
    //         foreach($this->input->post('hdn_activities_total') AS $list)
    //             {
    //             $activities_total = $activities_total + (int)$list;
    //         }
    //     }
    //     $restaurants_grand_total = 0;
    //     /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
    //         $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
    //     }*/
    //     $guide_grand_total = 0;
    //     if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
    //         $guide_grand_total = (int)$this->input->post('hdn_guide_grand_total');
    //     }
    //     // echo 'Guide : '.$guide_grand_total. '<br>';
    //     $hdn_mandatory_grand_total = 0;
    //     if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
    //         $hdn_mandatory_grand_total = $this->input->post('hdn_mandatory_grand_total');
    //     }
    //     $all_day_activities_total = 0;
    //     if(array_key_exists('all_day_activities_total',$this->input->post())){
    //         $all_day_activities_total = $this->input->post('all_day_activities_total');
    //     }
    //     // echo 'Mandatory : '.$hdn_mandatory_grand_total. '<br>';
       
    //     // $hdn_lugguage_total = 0;
    //     // if(array_key_exists('hdn_luggage_price',$this->input->post())){
    //     //     $hdn_lugguage_total = $hdn_lugguage_total + (int)$this->input->post('hdn_luggage_price');
    //     // }
    //     $hdn_final_ticket_price = 0;
    //     if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
    //         $hdn_final_ticket_price = $this->input->post('hdn_final_ticket_price');
    //     }
    //     // echo 'Ticket Price : '.$hdn_final_ticket_price. '<br>';
    //     if(array_key_exists('hotel_names_category_wise', $this->input->post())){
    //         $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
    //         // print_r($hotel_names_category_wise);
    //     }
    //     if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
    //         $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
    //         //  print_r($hotel_costing_category_wise);   
    //     }
    //     if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
    //         $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
    //         // print_r($hotel_room_category_names_wise);
    //     }
    //     $cost_html = '';
    //     if ($this->input->post('hdn_group_type') == 'family') 
    //     {
    //         $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';

    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
    //             $colspan = max(count($hotels), 1); 
    //             $rating_display = ucwords(str_replace('_', ' ', $rating_key));

    //             $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
    //         }
    //         $cost_html .= '</tr>';

    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotelId => $hotelData) {
    //                 $hotel_name = $hotelData['hotel_name'] ?? '-';
    //                 $nights = isset($hotelData['nights']) ? ' (' . $hotelData['nights'] . 'N)' : '';
    //                 $cost_html .= '<td style="background-color: #d6d8d9;font-weight:bold;">' . $hotel_name . $nights . '</td>';
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotelId => $hotelName) {
    //                 $room_categories = $hotel_room_category_names_wise[$rating_key][$hotelId] ?? [];
    //                 if (!empty($room_categories)) {
    //                     $cost_html .= '<td style="background-color: #d6d8d9;">' . implode('<br>', $room_categories) . '</td>';
    //                 } else {
    //                     $cost_html .= '<td style="background-color: #d6d8d9;">-</td>';
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $label = ($nights == '') ? "Cost Per Person" : "Hotel Cost Per Person";
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
    //         // $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotelId => $hotelName) {
    //                 $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;
    //                 if($nights =='')
    //                 {
    //                     $grand_total = $total_transportation + $hotel_cost + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price ;
    //                 }
    //                 else{
    //                     $grand_total = $hotel_cost;
    //                 }
                    
    //                 $markup_percentage = floatval($this->input->post('markup_percentage'));
    //                 $grand_total += ($grand_total * ($markup_percentage / 100));

    //                 $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
    //                     ? round(($grand_total / $total_persons) / $currency->country_currency_value)
    //                     : 0;

    //                 $cost_html .= '<td style="background-color: #d6d8d9;">$' . $per_person_cost . '</td>';
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         if($nights !='')
    //         {
    //             $total_cols = 0;
    //             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotelData) {
    //                     if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
    //                         $total_cols++;
    //                     }
    //                 }
    //             }
    //             $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price ;
    //             $markup_percentage = floatval($this->input->post('markup_percentage'));
    //             $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
    //             $converted_other = ($currency->country_currency_value > 0) 
    //                 ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
    //                 : 0;
    //             $cost_html .= '<tr>
    //                 <th style="background-color:#d6d8d9;">Other Cost Per Person</th>
    //                 <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
    //             </tr>';

    //         }
    //         $cost_html .= '</table>';

    //         if ($nights != '') 
    //         {
    //             $grouped_combos = [];

    //             // Group hotels by city per rating
    //             $hotels_by_city = [];
    //             foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotel_id => $hotelData) {
    //                     $city = $hotelData['hotel_city'] ?? 'Unknown';
    //                     $hotels_by_city[$rating_key][$city][] = [
    //                         'id' => $hotel_id,
    //                         'name' => $hotelData['hotel_name'],
    //                         'nights' => $hotelData['nights'] ?? 0,
    //                         'cost' => $hotel_costing_category_wise[$rating_key][$hotel_id] ?? 0
    //                     ];
    //                 }
    //             }

    //             // Create combos
    //             foreach ($hotels_by_city as $rating_key => $cities) {
    //                 $city_lists = array_values($cities); 
    //                 $max_count = max(array_map('count', $city_lists));

    //                 for ($i = 0; $i < $max_count; $i++) {
    //                     $combo = [];
    //                     foreach ($city_lists as $city_hotels) {
    //                         $hotel = $city_hotels[$i] ?? $city_hotels[0]; 
    //                         $combo[] = $hotel;
    //                     }

    //                     $group_name_parts = [];
    //                     $total_hotel_cost = 0;

    //                     foreach ($combo as $hotel) {
    //                         $group_name_parts[] = $hotel['name'] . " (" . $hotel['nights'] . "N)";

    //                         // Use hotel cost as-is (already for all nights)
    //                         $hotel_cost = $hotel['cost'] ?? 0;

    //                         // Convert to per-person
    //                         $per_person = ($total_persons > 0 && $currency->country_currency_value > 0)
    //                             ? round($hotel_cost / $total_persons / $currency->country_currency_value)
    //                             : 0;

    //                         // Apply markup once
    //                         $markup_percentage = floatval($this->input->post('markup_percentage'));
    //                         $per_person += round($per_person * ($markup_percentage / 100));

    //                         $total_hotel_cost += $per_person;
    //                     }

    //                     // Add other per-person costs
    //                     $package_total_per_person = $total_hotel_cost + $converted_other;

    //                     $group_name = implode(" + ", $group_name_parts);
    //                     $grouped_combos[$rating_key][$group_name] = $package_total_per_person;
    //                 }
    //             }

    //             // Step 3: Render Package Cost Table
    //             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
    //             $cost_html .= '<tr><th style="background-color:#d6d8d9;">Package Cost With Hotel</th></tr>';

    //             foreach ($grouped_combos as $rating => $combos) {
    //                 $cost_html .= '<tr><th colspan="'.count($combos).'" style="background-color:#d6d8d9;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';
    //                 $cost_html .= '<tr>';
    //                 foreach ($combos as $group_name => $total_cost) {
    //                     $cost_html .= '<td style="background-color:#d6d8d9;">'.$group_name.'</td>';
    //                 }
    //                 $cost_html .= '</tr><tr>';
    //                 foreach ($combos as $group_name => $total_cost) {
    //                     $cost_html .= '<td style="background-color:#d6d8d9;">$'.$total_cost.'</td>';
    //                 }
    //                 $cost_html .= '</tr>';
    //             }

    //             $cost_html .= '</table>';
    //         }

    //         // echo '<pre>';print_r($hotel_names_category_wise);
    //         // echo '<pre>';print_r($hotel_room_category_names_wise);
    //         // echo '<pre>';print_r($hotel_costing_category_wise);
    //         // echo $cost_html;
    //         // die();
    //     }
    //     else if ($this->input->post('hdn_group_type') == 'individual') 
    //     {
    //         $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price;
         
    //         $grand_total_pp = $grand_total / $total_persons;

    //         $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             $colspan = 0;
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                      if (is_array($occupancies)) {
    //                         $colspan += count($occupancies); 
    //                      }
    //                 }
    //             }
    //             $rating_display = ucwords(str_replace('_', ' ', $rating_key));
    //             $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
    //         }
    //         $cost_html .= '</tr>';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) { 
    //                 $occ_count = 0;
    //                 foreach ($categories as $cat => $occupancies) {
    //                 if ($cat === "nights") continue;
    //                     if (is_array($occupancies)) {
    //                         $occ_count += count($occupancies);
    //                     }
    //                 }

    //                 $nights = isset($categories['nights']) ? $categories['nights'] : 0;
    //                 $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
    //                 $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #d6d8d9; font-weight:bold;">' . $hotel_display . '</td>';
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //       $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 $roomCats = [];
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $roomCats[] = $cat;
    //                     }
    //                 }
    //                 $prev = null;
    //                 $span = 0;
    //                 foreach ($roomCats as $i => $cat) {
    //                     if ($cat === $prev) {
    //                         $span++;
    //                     } else {
    //                         if ($prev !== null) {
    //                             $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
    //                             $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
    //                         }
    //                         $prev = $cat;
    //                         $span = 1;
    //                     }
    //                 }
    //                 if ($prev !== null) {
    //                     $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
    //                     $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Occupancy</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $occ_arr = explode('__', $occ);
    //                         $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
    //                         $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
    //                         $occupancy_type = trim($occupancy_type);
    //                         $cost_html .= '<td style="background-color: #d6d8d9;">' . $occupancy_type . '</td>';
    //                     }
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $label = ($nights == 0) ? "Cost Per Person" : "Hotel Cost Per Person";
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $occ_arr = explode('__', $occ);
    //                         $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

    //                         if ($nights == 0) {
    //                             $cost_with_total = $occupancy_cost + $grand_total_pp;
    //                         } else {
    //                             $cost_with_total = $occupancy_cost;
    //                         }
    //                         $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

    //                         $cost_html .= '<td style="background-color: #d6d8d9;">$' . $converted . '</td>';
    //                     }
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         if ($nights != 0) {
    //             $total_cols = 0;
    //             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotel_name => $categories) {
    //                     foreach ($categories as $cat => $occupancies) {
    //                         if (is_array($occupancies)) {
    //                             $total_cols += count($occupancies);
    //                         }
    //                     }
    //                 }
    //             }
    //             $converted_other = ($currency->country_currency_value > 0) 
    //                 ? round($grand_total_pp / $currency->country_currency_value) 
    //                 : 0;
    //             $cost_html .= '<tr>
    //                 <th style="background-color:#d6d8d9;">Other Cost Per Person</th>
    //                 <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
    //             </tr>';
    //         }
    //         $cost_html .= '</table>';

    //       if ($nights != 0) {

    //             $hotels_by_city = [];
    //             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotel_name => $categories) {
    //                     $city = $categories['hotel_city'] ?? 'Unknown';
    //                     $hotels_by_city[$rating_key][$city][] = [
    //                         'name' => $hotel_name,
    //                         'nights' => $categories['nights'],
    //                         'categories' => $categories
    //                     ];
    //                 }
    //             }

    //             $paired_combos = [];
    //             foreach ($hotels_by_city as $rating => $cities) {
    //                 $city_lists = array_values($cities); 
    //                 $max_count = max(array_map('count', $city_lists));

    //                 for ($i = 0; $i < $max_count; $i++) {
    //                     $combo = [];
    //                     foreach ($city_lists as $city_hotels) {
    //                         $hotel = $city_hotels[$i] ?? null;
    //                         if ($hotel) $combo[] = $hotel;
    //                     }
    //                     if (!empty($combo)) $paired_combos[$rating][] = $combo;
    //                 }
    //             }

    //             $all_occupancies = [];
    //             $grouped_combos = [];
    //             foreach ($paired_combos as $rating => $combos) {
    //                 foreach ($combos as $combo) {
    //                     $group_name = implode(" + ", array_map(fn($h) => $h['name']." (".$h['categories']['hotel_city'].") ".$h['nights']."N", $combo));
    //                     $merged_costs = [];

    //                     foreach ($combo as $hotel) {
    //                         foreach ($hotel['categories'] as $cat => $occupancies) {
    //                             if (!is_array($occupancies)) continue;
    //                             foreach ($occupancies as $occ) {
    //                                 $occ_arr = explode('__', $occ);
    //                                 $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
    //                                 $occ_cost = floatval($occ_arr[1] ?? 0);
    //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
    //                                 $all_occupancies[$occ_type] = true;
    //                             }
    //                         }
    //                     }
                        
    //                     $grouped_combos[$rating][$group_name] = $merged_costs;
    //                 }
    //             }
    //             $total_cols = 0;
    //                     foreach ($grouped_combos as $rating => $combos) {
    //                         foreach ($combos as $group_name => $costs) {
    //                             $total_cols += count($costs);
    //                         }
    //                     }

    //             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
    //             $cost_html .= '<tr><th colspan="'.$total_cols.'" style="background-color:#d6d8d9;">Package Cost With Hotel</th></tr>';

    //             foreach ($grouped_combos as $rating => $combos) {
    //                 $cost_html .= '<tr><th colspan="'.(count($combos)+1).'" style="background-color:#d6d8d9;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';

    //                 $cost_html .= '<tr><th style="background-color:#d6d8d9;">Occupancy</th>';
    //                 foreach ($combos as $group_name => $costs) {
    //                     $cost_html .= '<th style="background-color:#d6d8d9;">'.$group_name.'</th>';
    //                 }
    //                 $cost_html .= '</tr>';

    //                 foreach ($all_occupancies as $occ_type => $_) {
    //                     $cost_html .= '<tr><td style="font-weight:bold;">'.$occ_type.'</td>';
    //                     foreach ($combos as $costs) {
    //                         $occupancy_cost = isset($costs[$occ_type]) ? floatval($costs[$occ_type]) : 0;
    //                         $total_cost = $occupancy_cost + $grand_total_pp;
    //                         $converted = ($currency->country_currency_value > 0) 
    //                             ? round($total_cost / $currency->country_currency_value) 
    //                             : 0;
    //                         $cost_html .= '<td>$'.$converted.'</td>';
    //                     }
    //                     $cost_html .= '</tr>';
    //                 }
    //             }

    //             $cost_html .= '</table>';
    //         }
    //     }
    //     // echo '<pre>';print_r($hotel_costing_category_wise);
    //     // echo $cost_html;die();
    //     $flight_details='<div class="title"><h4>FLIGHT DETAILS</h4></div>
    //                     <div class="text">
    //                         <div class="flight-wrapper">
    //                             <div class="flight-card from">
    //                                 <div class="card-header"> <i class="fa-solid fa-plane-departure"></i> From (Arrival)</div>
    //                                 <div class="flight-row">
    //                                     <div class="label">City Of Origin:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('origin_city').'</div>
    //                                 </div>
    //                                 <div class="flight-row">
    //                                     <div class="label">City of Arrival:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_city').'</div>
    //                                 </div>
    //                                 <div class="flight-row">
    //                                     <div class="label">Arrival Airline:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
    //                                 </div>
    //                                 <div class="flight-row">
    //                                     <div class="label">Arrival Time:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_time').'</div>
    //                                 </div>
    //                             </div>
    //                             <div class="flight-card to">
    //                                 <div class="card-header"><i class="fa-solid fa-plane-arrival"></i> To (Departure)</div>
    //                                 <div class="flight-row">
    //                                     <div class="label">Departure City:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('departure_city').'</div>
    //                                 </div>
    //                                 <div class="flight-row">
    //                                     <div class="label">Departing Airline:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
    //                                 </div>
    //                                 <div class="flight-row">
    //                                     <div class="label">Departing Time:</div>
    //                                     <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_time').'</div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                 </div>';

    //         $only_itinerary_html = '
    //             <div class="text">
    //                 <div class="itinerary-table">
    //                     <div class="itinerary-header">
    //                         <div class="col-one">
    //                             <b style="color:black !important;">Day</b>
    //                         </div>
    //                         <div class="col-two">
    //                             <b style="color:black !important;">Activity</b>
    //                             <b style="display: inline-block; float: right;color:black !important;">
    //                                 To view the detailed itinerary, click or download here. 
    //                                 <a style="color:black !important;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">(Link)</a>
    //                             </b>
    //                         </div>
    //                     </div>';

    //         $total_transportation_outside = 0;
    //         $total_transportation_inside = 0;

    //         for ($i = 1; $i <= $cnt; $i++) {   
    //             $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;

    //             $only_itinerary_html .= '
    //                 <div class="itinerary-item">
    //                     <div class="col-one">
    //                         <span>Day ' . $i . '</span>
    //                     </div>
    //                     <div class="col-two">
    //                         <ul style="padding: 0;">';

    //             if ($cnt_text > 0) {
    //                 for ($j = 0; $j < $cnt_text; $j++) {
    //                     $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') 
    //                         ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' 
    //                         : '';
    //                     $only_itinerary_html .= '<li>' . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';
    //                 }

    //                 if (!empty($this->input->post('itinerary_activities_'.$i))) {
    //                     foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
    //                         if ($activity != "") {
    //                             $only_itinerary_html .= '<li style="margin-left:15px;">' . $activity . '</li>';
    //                         }
    //                     }
    //                 }
    //             } else {
    //                 // show message when no itinerary
    //                 $only_itinerary_html .= '<li><i>No Itinerary</i></li>';
    //             }

    //             $only_itinerary_html .= '
    //                         </ul>
    //                     </div>
    //                 </div>';

    //             if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
    //                 $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
    //             }
    //             if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
    //                 $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
    //             }
    //         }

    //         $only_itinerary_html .= '
    //                 </div>
    //             </div>';

    //             $short_itinerary='<div class="title">
    //                 <h4>DAY WISE SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
    //             </div>';
                
    //             $inclusions=' <div class="title">
    //                 <h4>OUR INCLUSIONS</h4>
    //             </div>
    //             <div class="text" style="margin-top:-20px !important;">
    //                 <div class="our-inclusion">
    //                 <div class="inclusion-item">
    //                         <div class="box">
    //                             <h4>Complementory Services</h4>
    //                             <ul>';
    //                     $mandatory_services_json = $_POST['mandatory_services'] ?? '[]';
    //                     $mandatory_services = json_decode($mandatory_services_json, true);
    //                                 if (!empty($mandatory_services)) {
    //                                     foreach ($mandatory_services as $service) {
    //                                         $service_text = explode("_|_", $service['service'])[0];
    //                                         $price = explode("_|_", $service['service'])[1];
    //                                         $qnty = $service['qnty'];
    //                                         $inclusions .="<li>{$service_text}</li>";
    //                                     }
    //                                 } else {
    //                                     $inclusions .="<li>No mandatory services provided.</li>";
    //                                 }

    //                 $inclusions.='</li></div>
    //                     </div>
    //                     <div class="inclusion-item">
    //                         <div class="box">
    //                             <h4>Transportation</h4>
    //                             <ul>
    //                                 <li>All transfers & sightseeing by private vehicle ( Sedan ) for 12 Hrs (10AM – 10PM Only, Within City Limits)  </li>
    //                                 <li>Airport – hotel – airport transfers</li>
    //                                 <li>Airprt Pic</li>
    //                                 <li>Airport Drop</li>
    //                                 <li>Dinner Transfers</li>
    //                             </ul>
    //                         </div>
    //                     </div>
    //                     <div class="inclusion-item">
    //                         <div class="box">
    //                             <h4>'.$guide.'</h4>
    //                             <ul>
    //                                 <li>All transfers & sightseeing include services of an English-speaking Guide.</li>
    //                                 <li>Airport meet & greet by our English-speaking staff.</li>
    //                                 <li>Departure souvenir gift.</li>
    //                             </ul>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>';
                
    //             $activities_html = '
    //             <div style="margin-top:20px;">
    //                 <h4 style="color:#2e3b4e; padding: 12px 20px; margin:15px 0px; background-color:#d6d8d9; font-size:16px; text-align:center;">
    //                     SPICE UP YOUR TRIP BY CHOOSING FROM OUR LIST OF ACTIVITIES
    //                 </h4>
    //                 <table border="1" cellspacing="0" cellpadding="6" width="100%" style="border-collapse:collapse; font-size:14px; color:#333;">
    //                     <thead>
    //                         <tr style="background-color:#d6d8d9; font-weight:bold; text-align:center;">
    //                             <th style="width:50px;">S.NO</th>
    //                             <th>Additional Activity Name</th>
    //                         </tr>
    //                     </thead>
    //                     <tbody>
    //                         <tr><td align="center">1</td><td>Private outdoor picnic set-up with lunch near River/Lakeside</td></tr>
    //                         <tr><td align="center">2</td><td>Party in a stretch Limo with music, Hostesses & champagne (2 hours)</td></tr>
    //                         <tr><td align="center">3</td><td>Paragliding</td></tr>
    //                         <tr><td align="center">4</td><td>Go-Karting + Buggy adventure</td></tr>
    //                         <tr><td align="center">5</td><td>Double barrel shotgun shooting experience</td></tr>
    //                         <tr><td align="center">6</td><td>Night club hopping</td></tr>
    //                         <tr><td align="center">7</td><td>3rd Longest Zipline in the world</td></tr>
    //                         <tr><td align="center">8</td><td>Private Pool Villa party</td></tr>
    //                         <tr><td align="center">9</td><td>Hot Air Ballooning</td></tr>
    //                         <tr><td align="center">10</td><td>River Rafting</td></tr>
    //                         <tr><td align="center">11</td><td>Picnic lunch near the river side</td></tr>
    //                         <tr><td align="center">12</td><td>Yacht Party</td></tr>
    //                         <tr><td align="center">13</td><td>GyroPlane experience</td></tr>
    //                         <tr><td align="center">14</td><td>Cessna – Learn to fly a plane</td></tr>
    //                         <tr><td align="center">15</td><td>Visit Big Almaty Lake on an E-Bikes/E-Cycles</td></tr>
    //                         <tr><td align="center">16</td><td>E-Scootie experience in the city</td></tr>
    //                         <tr><td align="center">17</td><td>Casino visit</td></tr>
    //                         <tr><td align="center">18</td><td>ATV ride</td></tr>
    //                         <tr><td align="center">19</td><td>Falcon show</td></tr>
    //                         <tr><td align="center">20</td><td>Dolphin Show</td></tr>
    //                         <tr><td align="center">21</td><td>Huns Ethno Village</td></tr>
    //                         <tr><td align="center">22</td><td>Wine Tasting</td></tr>
    //                         <tr><td align="center">23</td><td>Party Bus</td></tr>
    //                         <tr><td align="center">24</td><td>Rifle Shooting (Asanov)</td></tr>
    //                         <tr><td align="center">25</td><td>Qazaq Shooters (Carbine, Sniper, Revolver, Glock, Mosin, Steyr Aug etc)</td></tr>
    //                     </tbody>
    //                 </table>
    //             </div>';
                
    //     $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
    //     $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

    //     $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
    //         'subject' => $email_subject,
    //         'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
    //         'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
    //         'to' => [ 
    //             // [ 'name' => 'Sumeet Verma', 'email' => 'anant.thaver@gmail.com'],
    //                 // [ 'name' => 'Sumeet Verma', 'email' => 'back.office@kazindmc.com'],
    //                 // [ 'name' => 'Sumeet Verma', 'email' => 'rohit@kazindmc.com'],
    //                 [ 'name' => 'Sumeet Verma', 'email' => 'sumeet@thavertech.com'],
    //                 // [ 'name' => 'Sumeet Verma', 'email' => 'vikash.thaver@gmail.com'],
    //                 ],
    //         'htmlContent' => '<!DOCTYPE html><html><head>
    //     <meta charset="UTF-8" />
    //         <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    //         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    //         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    //             <style>
    //                 th, td {
    //                     padding: 5px;
    //                     text-align: left;
    //                 }
    //                 .header {
    //                     background-color: #d6d8d9;
    //                     margin: -50px -50px !important;
    //                     text-align: left ;
    //                 }
    //                     .title {
    //         padding: 12px 20px;
    //         margin:15px 0px;
    //         background-color: #d6d8d9;
    //         text-align: center;
    //     }
    //                 label {
    //                     font-weight: bold;
    //                 }
    //                     .flight-wrapper {
    //         display: flex;
    //         gap: 20px;
    //         justify-content: center;
    //     }
    //     .flight-card {
    //         background-color: #fff;
    //         border: solid 1px #ccc;
    //         width: calc(50% - 10px);
    //         padding: 15px 24px;
    //     }
    //         .card-header {
    //         font-size: 16px;
    //         font-weight: 600;
    //         color: #2e3b4e;
    //         border-bottom: dashed 1px #ccc;
    //         margin-bottom: 6px;
    //         padding-bottom: 15px;
    //         display: flex;
    //         align-items: center;
    //         gap: 8px;
    //     }
    //     .flight-row {
    //         margin-bottom: 4px;
    //         display: flex;
    //         justify-content: space-between;
    //     }
    //         .label {
    //         font-size: 12px;
    //         color: #778093;
    //         text-transform: uppercase;
    //         margin-bottom: 4px;
    //     }

    //     .value {
    //         font-size: 14px;
    //         font-weight: 500;
    //         color: #2d3748;
    //     }
    //         .title>h4 {
    //         padding: 0;
    //         margin: 0;
    //         color: #000;
    //         text-decoration: none;
    //         text-transform: capitalize;
    //     }
    //         .itinerary-header {
    //         color: #fff;
    //         /* color: #fff; */
    //         /* background-color: #f56100e3; */
    //         background-color: #d6d8d9;
    //         display: flex;
    //         padding: 10px;
    //     }

    //     .col-one {
    //         width: 20% !important;
    //     }

    //     .itinerary-item {
    //         display: flex;
    //         padding: 8px 10px;
    //         /* border-bottom: solid 2px #8299b0; */
    //         /* border-bottom: solid 2px #e4e4e4; */
    //         /* border-bottom: dashed 2px #e4e4e4; old*/
    //         border-bottom: dashed 1.6px #8299b070;
    //         align-items: center;
    //     }

    //     .col-one>span {
    //         font-size: 18px;
    //         color: #3c556e;
    //         font-weight: 500;
    //     }

    //     .col-two {
    //         border-left: solid 1px #8299b0;
    //         padding-left: 45px;
    //         width: 80% !important;
    //     }

    //     .col-two>ul {
    //         margin: 0;
    //     }
    //         .our-inclusion {
    //         display: flex;
    //         gap: 20px;
    //     }

    //     .inclusion-item {
    //         width: 33%;
    //     }

    //     .box {
    //         width: 100%;
    //         height: 90%;
    //         border-left: solid 1px #ccc;
    //         background-color: #d6d8d9;
          
    //     }

    //     .box h4 {
    //         padding-left: 12px;
    //         padding-top: 12px;
    //     }

    //     .inclusion-item ul li {
    //         position: relative;
    //         list-style: none;
    //         color: #555555;
    //     }

    //     .inclusion-item ul li::before {
            
    //         position: absolute;
    //         color: #242424;
    //         left: -22px;
    //         font-size: 11px;
    //         top: 0;
    //     }
    //       .activites-item {
    //         background: #d6d8d9;
    //         display: flex;
    //         /* width: 33.33%; */
    //         padding: 8px 20px;
    //         margin-bottom: 6px;
    //     }
    //     .our-activites {
    //         display: flex;
    //     }
    //     .activites-item>div:nth-child(1) {
    //         width: 10%;
    //     }
    //     .activites-item>div:nth-child(2) {
    //         width: 6%;
    //     }
    //     .activites-item>div:nth-child(3) {
    //         width: 80%;
    //     }
    //     .our-activites>div {
    //         width: 33.33%;
    //     }
    //     .activites-item i {
    //         color: #6c6c6c;
    //     }
    //             </style>
    //         </head><body>
    //             <div class="table-container">
    //                 <div class="header">
    //                     <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
    //                 </div>
    //                 <table style="width:100%;">
    //                     <tr><td colspan="12" align="left">Dear Team,</td></tr>
    //                     <tr><td colspan="12"></td></tr>
    //                     <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
    //                     <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
    //                     <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
    //                     <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
    //                     <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
    //                     <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
    //                     <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
    //                     <tr><td colspan="12" align="left">'.$activities_html.'</td></tr>
    //                     <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
    //                     <br>
    //                     <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:red;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.($roe ? $roe : $currency->country_currency_value).'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
    //                 <br><br>
    //                     <tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
    //                     <tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
    //                     <tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
    //                     <tr><td colspan="12" align="left" height="25px"></td></tr>
    //                     <tr><td colspan="12" align="left">Regards,</td></tr>
    //                     <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
    //                 </table>
    //             </div>
    //         </body></html>',
    //          /*'params' => ['bodyMessage' => '']*/
    //     ]);

    //     try {
    //         $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
    //         //print_r($sendinblue_response);
    //     } catch (Exception $e) {
    //         //echo $e->getMessage(),PHP_EOL;
    //     }
        
    //     $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
    //     echo json_encode($response);
    //     exit;		
    // }     
    
    
    // public function get_email_body()
    // {
    //     $postData = $this->input->post();
    //     $cnt = count($postData['itinerary_date']);

    //     if (empty($postData['enquiry_id'])) {
    //         show_error('Enquiry ID is required to generate email body.');
    //         return;
    //     }

    //     $data['form'] = $postData;
    //     $enquiry_id = $postData['enquiry_id'];

    //     $where = 'enquiry.id = "' . $this->db->escape_str($enquiry_id) . '"';
    //     $join = [
    //         [
    //             'type' => 'LEFT',
    //             'join_table' => 'company_details',
    //             'condition' => 'company_details.company_id = enquiry.company_details_id'
    //         ],
    //         [
    //             'type' => 'LEFT',
    //             'join_table' => 'company',
    //             'condition' => 'company.company_id = enquiry.company_id'
    //         ],
    //     ];

    //     $enquiryData = $this->common_model->get_data('enquiry', '', '', '*', $where, '', false, $join);
    //     if (empty($enquiryData)) {
    //         show_error('No enquiry found for ID ' . $enquiry_id);
    //         return;
    //     }

    //     $data['enquiry'] = $enquiryData[0];
    //     $total_persons = $data['enquiry']->number_persons + $data['enquiry']->number_child;
    //     $data['total_persons'] = $total_persons;

    //     // Get currency
    //     $char = substr($data['enquiry']->enquiry_abbr, 1, 2);
    //     $country = COUNTRY_ABBR;
    //     $where = 'currency_value.country = "' . strtolower($country[$char]) . '" AND currency_value.status = "active"';
    //     $currencyData = $this->common_model->get_data('currency_value', '', '', '*', $where, '', false);
    //     $currency = !empty($currencyData) ? $currencyData[0] : null;
    //     $data['currency'] = $currency;

    //     $only_itinerary_html = '
    //     <div class="text">
    //         <div class="itinerary-table">
    //             <div class="itinerary-header" style=" color: #fff; background-color: #d6d8d9; display: flex; padding: 10px;">
    //                 <div class="col-one" style="width: 20% !important;">
    //                     <b style="color:black;">Day</b>
    //                 </div>
    //                 <div class="col-two" style="border-left: solid 1px #8299b0; padding-left: 45px; width: 80% !important;">
    //                     <b style="color:black;">Activity</b>
    //                     <b style="display: inline-block; float: right; color:black;">
    //                         To view the detailed itinerary, click or download here. 
    //                         <a style="color:black;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">(Link)</a>
    //                     </b>
    //                 </div>
    //             </div>';

    //     $total_transportation_outside = 0;
    //     $total_transportation_inside = 0;
    //     $n = 0;

    //     for ($i = 1; $i <= $cnt; $i++) {   
    //         $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;

    //         $only_itinerary_html .= '
    //             <div class="itinerary-item" style=" display: flex; padding: 8px 10px; border-bottom:dashed 1.6px #8299b070; align-items: center;">
    //                 <div class="col-one" style="width: 20% !important;">
    //                     <span style="font-size: 18px; color: #3c556e; font-weight: 500;">Day ' . $i . '</span>
    //                 </div>
    //                 <div class="col-two" style="border-left: solid 1px #8299b0; padding-left: 45px; width: 80% !important;">
    //                     <ul style="padding: 0;  margin: 0;">';

    //         if ($cnt_text > 0) {
    //             for ($j = 0; $j < $cnt_text; $j++) {
    //                 $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') 
    //                     ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' 
    //                     : '';
    //                 $only_itinerary_html .= '<li>' . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';
    //             }

    //             if (!empty($this->input->post('itinerary_activities_'.$i))) {
    //                 foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
    //                     if ($activity != "") {
    //                         $only_itinerary_html .= '<li style="margin-left:15px;">' . $activity . '</li>';
    //                     }
    //                 }
    //             }
    //         } else {
    //             // ✅ Show message when no itinerary
    //             $only_itinerary_html .= '<li><i>No Itinerary</i></li>';
    //         }
    //         $only_itinerary_html .= '
    //                     </ul>
    //                 </div>
    //             </div>';

    //         $n++;

    //         if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
    //             $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
    //         }

    //         if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
    //             $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
    //         }
    //     }

    //     $only_itinerary_html .= '
    //         </div>
    //         </div>';

    //     $data['only_itinerary_html'] = $only_itinerary_html;
    //     $total_transportation = isset($postData['final_transport']) ? (float)$postData['final_transport'] : 0;
    //     $guide_grand_total = isset($postData['hdn_guide_grand_total']) ? (float)$postData['hdn_guide_grand_total'] : 0;
    //     $mandatory_grand_total = isset($postData['hdn_mandatory_grand_total']) ? (float)$postData['hdn_mandatory_grand_total'] : 0;
    //     $all_day_activities_total = isset($postData['all_day_activities_total']) ? (float)$postData['all_day_activities_total'] : 0;
    //     $final_ticket_price = isset($postData['hdn_final_ticket_price']) ? (float)$postData['hdn_final_ticket_price'] : 0;

    //     // Hotel related data
    //     $hotel_names_category_wise = isset($postData['hotel_names_category_wise']) ? json_decode($postData['hotel_names_category_wise'], true) : [];
    //     $hotel_costing_category_wise = isset($postData['hotel_costing_category_wise']) ? json_decode($postData['hotel_costing_category_wise'], true) : [];
    //     $hotel_room_category_names_wise = isset($postData['hotel_room_category_names_wise']) ? json_decode($postData['hotel_room_category_names_wise'], true) : [];

    //     $markup_percentage = isset($postData['markup_percentage']) ? (float)$postData['markup_percentage'] : 0;
    //     $group_type = isset($postData['hdn_group_type']) ? $postData['hdn_group_type'] : 'individual';

    //     $cost_html = '';
    //     $nights = isset($postData['hotel_nights']) ? (int)$postData['hotel_nights'] : 0;

    //     // === FAMILY GROUP TYPE ===
    //     if ($group_type == 'family') {
    //         $cost_html .= $this->generate_family_cost_table(
    //             $hotel_names_category_wise,
    //             $hotel_costing_category_wise,
    //             $hotel_room_category_names_wise,
    //             $total_persons,
    //             $total_transportation,
    //             $guide_grand_total,
    //             $mandatory_grand_total,
    //             $all_day_activities_total,
    //             $final_ticket_price,
    //             $markup_percentage,
    //             $currency,
    //             $nights
    //         );
    //     }
    //     // === INDIVIDUAL GROUP TYPE ===
    //     else {
    //         $cost_html .= $this->generate_individual_cost_table(
    //             $hotel_costing_category_wise,
    //             $total_persons,
    //             $total_transportation,
    //             $guide_grand_total,
    //             $mandatory_grand_total,
    //             $all_day_activities_total,
    //             $final_ticket_price,
    //             $markup_percentage,
    //             $currency,
    //             $nights
    //         );
    //     }

    //     $data['cost_html'] = $cost_html;

    //     $data['postData'] = $postData;

    //     // Load the email body view
    //     $this->load->view('admin/email_body', $data);
    // }
    
    
    
    public function save_and_email_new()
    {
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required'); 
        $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $cnt = count($this->input->post('itinerary_date'));
        $created = date('Y-m-d H:i:s');
        $enquiry_id = $this->input->post('enquiry_id');
    
        $where = ' enquiry.id = '.$enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                 ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

        $total_persons = $enquiry->number_persons + $enquiry->number_child;
        $char = substr($enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;
        $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active" Order by currency_value.id DESC';
        $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

        $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
        
        $stay_html = '';
        /*if(array_key_exists('hotel_nights', $this->input->post())){
            $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
            $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
            $stay_html .= '<ol>';
            $hotel_nights = json_decode($this->input->post('hotel_nights'));
            foreach($hotel_nights AS $key=>$list){
                $h_name = explode('_',$key);
                $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
            }
            $stay_html .= '</ol></td></tr>';
        }*/
        $guide = $this->input->post('driver_cum_guide') == 'guide' ? 'Guide' : 'Driver Cum Guide';
        $roe = $this->input->post('roe');
        
        $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
        $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
            <div>
            <h4 class="title">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
                <h4>
            </div>
        <tbody>
            '.$stay_html.$transportation_guide.'<tr style="">
            <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
        // $total_transportation_outside = 0;
        // $total_transportation_inside = 0;
        $total_transportation = 0;
        $n=0;
        $html .= '<ol>'; 
        for($i=0;$i<$cnt;$i++){            
            $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
            for($j=0;$j<$cnt_text;$j++){
                if($j==0){
                    //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
                }
                $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
                $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
                //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
                if(!empty($this->input->post('itinerary_activities_'.$i))){
                    $html .= '<ul>';
                    foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
                        if($activity != ""){
                            $html .= '<li>'.$activity.'</li>';
                        }
                    }
                    $html .= '</ul>';
                }
            }
            $n++;
            // if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
            //     $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
            // }
            // if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
            //     $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
            // }
            // if(array_key_exists('hdn_travel_city_cost_'.$i,$this->input->post())){
            //     $hdn_travel_city_cost = $hdn_travel_city_cost + $this->input->post('hdn_travel_city_cost_'.$i);
            // }
        }
        $html .= '</ol><br>';
        
        $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
        $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
        $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
        // $total_transportation = $total_transportation_outside + $total_transportation_inside;
        // if(array_key_exists('hdn_airport_in_total',$this->input->post())){
        //     $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
        // }
        if(array_key_exists('final_transport',$this->input->post())){
            $total_transportation = $this->input->post('final_transport');
        }
        //echo 'Transportation : '.$total_transportation.'<br>';
        
        $activities_total = 0;
        if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
            foreach($this->input->post('hdn_activities_total') AS $list)
                {
                $activities_total = $activities_total + (int)$list;
            }
        }
        $restaurants_grand_total = 0;
        /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
            $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
        }*/
        $guide_grand_total = 0;
        if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
            $guide_grand_total = (int)$this->input->post('hdn_guide_grand_total');
        }
        // echo 'Guide : '.$guide_grand_total. '<br>';
        $hdn_mandatory_grand_total = 0;
        if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
            $hdn_mandatory_grand_total = $this->input->post('hdn_mandatory_grand_total');
        }
        $all_day_activities_total = 0;
        if(array_key_exists('all_day_activities_total',$this->input->post())){
            $all_day_activities_total = $this->input->post('all_day_activities_total');
        }
        // echo 'Mandatory : '.$hdn_mandatory_grand_total. '<br>';
       
        // $hdn_lugguage_total = 0;
        // if(array_key_exists('hdn_luggage_price',$this->input->post())){
        //     $hdn_lugguage_total = $hdn_lugguage_total + (int)$this->input->post('hdn_luggage_price');
        // }
        $grandTotalMeal = $this->input->post('grandTotalMeal');
        $meal_type_daywise_price = $this->input->post('meal_type_daywise_price');;
        
        $hdn_final_ticket_price = 0;
        if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
            $hdn_final_ticket_price = $this->input->post('hdn_final_ticket_price');
        }
                $final_toll_price = $this->input->post('final_toll_price');
        // echo 'Ticket Price : '.$hdn_final_ticket_price. '<br>';
        if(array_key_exists('hotel_names_category_wise', $this->input->post())){
            $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
            // print_r($hotel_names_category_wise);
        }
        if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
            $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
            //  print_r($hotel_costing_category_wise);   
        }
        if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
            $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
            // print_r($hotel_room_category_names_wise);
        }
        $cost_html = '';
        if ($this->input->post('hdn_group_type') == 'family') 
        {
             $has_any_night = false;
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            foreach ($hotels as $hotelId => $hotelData) {
                if (!empty($hotelData['nights'])) {
                    // Check if any night > 0
                    $filtered_nights = array_filter($hotelData['nights'], fn($v) => $v > 0);
                    if (!empty($filtered_nights)) {
                        $has_any_night = true;
                        break 2; // exit both loops
                    }
                }
            }
        }
        $cost_html = '';
        if (!$has_any_night) {
            $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: left; margin:5px;">';

            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
                $colspan = max(count($hotels), 1); 
                $rating_display = ucwords(str_replace('_', ' ', $rating_key));

                $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
            }
            $cost_html .= '</tr>';

            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotelId => $hotelData) {
                    $hotel_name = $hotelData['hotel_name'] ?? '-';
                    $nights = isset($hotelData['nights']) ? ' (' . $hotelData['nights'] . 'N)' : '';
                    $cost_html .= '<td style="background-color: #d6d8d9;font-weight:bold;color:#6060a9 !important;">' . $hotel_name . $nights . '</td>';
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotelId => $hotelName) {
                    $room_categories = $hotel_room_category_names_wise[$rating_key][$hotelId] ?? [];
                    if (!empty($room_categories)) {
                        $cost_html .= '<td style="background-color: #d6d8d9;">' . implode('<br>', $room_categories) . '</td>';
                    } else {
                        $cost_html .= '<td style="background-color: #d6d8d9;">-</td>';
                    }
                }
            }
            $cost_html .= '</tr>';
            $label = ($nights == '') ? "Cost Per Person" : "Hotel Cost Per Person";
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
            // $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotelId => $hotelName) {
                    $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;
                    $markup_percentage = floatval($this->input->post('markup_percentage'));
                    $hotel_markup_percentage = floatval($this->input->post('hotel_markup_percentage'));
                    if(!empty($hotel_markup_percentage))
                    {
                        $hotel_cost += ($hotel_cost * ($hotel_markup_percentage / 100));
                    
                    }else{
                        $hotel_cost += ($hotel_cost * ($markup_percentage / 100));
                    }

                    if($nights =='')
                    {
                        $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                        $grand_total += ($grand_total * ($markup_percentage / 100));
                    
                    }
                    else{
                        $grand_total = $hotel_cost;
                    }
                   
                    // $markup_percentage = floatval($this->input->post('markup_percentage'));
                    // $grand_total += ($grand_total * ($markup_percentage / 100));
                    $grand_total_new = $hotel_cost;
                     if(empty($hotel_markup_percentage))
                    {
                        $grand_total_new += $grand_total;
                    }
             

                    $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
                        ? round(($grand_total_new / $total_persons) / $currency->country_currency_value)
                        : 0;

                    $cost_html .= '<td style="background-color: #d6d8d9;">$' . $per_person_cost . '</td>';
                }
            }
            $cost_html .= '</tr>';
            if(!empty($hotel_markup_percentage))
            {
                $total_cols = 0;
                foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                    foreach ($hotels as $hotelData) {
                        if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
                            $total_cols++;
                        }
                    }
                }
                $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                $markup_percentage = floatval($this->input->post('markup_percentage'));
                $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
                $converted_other = ($currency->country_currency_value > 0) 
                    ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
                    : 0;
                $cost_html .= '<tr>
                    <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                    <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                </tr>';

            }
            $cost_html .= '</table>';
        }

        if ($has_any_night) {
            $markup_percentage = floatval($this->input->post('markup_percentage'));
            $packages = [];
            $package_index = 1;

            $all_available_nights = [];
            foreach ($hotel_names_category_wise as $rating => $hotels) {
                foreach ($hotels as $hotel_data) {
                    if (isset($hotel_data['nights']) && !empty($hotel_data['nights']) && is_array($hotel_data['nights'])) {
                        $all_available_nights = array_merge($all_available_nights, $hotel_data['nights']);
                    }
                }
            }
            $all_available_nights = array_unique($all_available_nights);
            sort($all_available_nights);
            
            $final_nights_order = [];
            if (in_array(0, $all_available_nights)) {
                $final_nights_order[] = 0; 
            }
            
            foreach ($all_available_nights as $night) {
                if ($night != 0) {
                    $final_nights_order[] = $night;
                }
            }
            
            $all_available_nights = $final_nights_order;

            $main_hotels = [];
            foreach ($hotel_names_category_wise as $rating => $hotels) {
                foreach ($hotels as $hotel_id => $hotel_data) {
                    if (!isset($hotel_data['nights']) || empty($hotel_data['nights'])) {
                        $hotel_data['nights'] = $all_available_nights;
                    }
                    
                    $available_nights_count = count($hotel_data['nights']);
                    if ($available_nights_count >= 2) {
                        $main_hotels[] = [
                            'hotel_id' => $hotel_id,
                            'hotel_data' => $hotel_data,
                            'rating' => $rating
                        ];
                    }
                }
            }

            $package_signatures = [];
            $used_fallback_hotels = []; 

            foreach ($main_hotels as $main_hotel_info) {
                $hotel_id = $main_hotel_info['hotel_id'];
                $hotel_data = $main_hotel_info['hotel_data'];
                $rating = $main_hotel_info['rating'];

                $total_hotel_cost = floatval($hotel_costing_category_wise[$rating][$hotel_id] ?? 0);
                
                $nights_array = isset($hotel_data['nights']) ? $hotel_data['nights'] : $all_available_nights;
                $nights_count = count($nights_array);
                $per_night_cost = $total_hotel_cost / max($nights_count, 1);

                $package_hotels = [];
                $total_package_cost = 0;
                $fallback_hotels_used = [];
                $hotel_markup_percentage = floatval($this->input->post('hotel_markup_percentage'));
                foreach ($all_available_nights as $night_no) {
                    if (in_array($night_no, $nights_array)) 
                        {
                        $per_person = ($total_persons > 0 && $currency->country_currency_value > 0)
                            ? ($per_night_cost / $total_persons) / $currency->country_currency_value
                            : 0;
                        // $per_person += $per_person * ($markup_percentage / 100);
                        if(!empty($hotel_markup_percentage))
                        {
                            $per_person += ($per_person * ($hotel_markup_percentage / 100));
                        
                        }else{
                            $per_person += ($per_person * ($markup_percentage / 100));
                        }

                        $package_hotels[] = [
                            'name' => $hotel_data['hotel_name'],
                            'rating' => $rating,
                            'night' => $night_no,
                            'cost_per_person' => round($per_person),
                            'type' => 'same_hotel'
                        ];
                        
                        $total_package_cost += $per_person;
                    } else {
                        $fallback_hotel = $this->findFallbackHotel($hotel_names_category_wise, $hotel_costing_category_wise, $night_no, $rating, $hotel_data['hotel_name'], $total_persons, $currency, $markup_percentage, $used_fallback_hotels, $hotel_markup_percentage);
                        
                        $package_hotels[] = $fallback_hotel;
                        $total_package_cost += $fallback_hotel['cost_per_person'];
                        
                        if ($fallback_hotel['type'] != 'same_hotel') {
                            $fallback_hotels_used[] = $fallback_hotel['name'];
                        }
                    }
                }

                $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                $grand_total_other += $grand_total_other * ($markup_percentage / 100);
                $converted_other = ($currency->country_currency_value > 0)
                    ? round(($grand_total_other / $total_persons) / $currency->country_currency_value, 2)
                    : 0;

                // $total_package_cost += $converted_other;
                 if(empty($hotel_markup_percentage)) {
                    $total_package_cost += $converted_other;
                }

                $fallback_signature = implode('|', array_unique($fallback_hotels_used));
                $package_signature = $hotel_data['hotel_name'] . "|" . $fallback_signature;

                if (!in_array($package_signature, $package_signatures)) {
                    $package_signatures[] = $package_signature;
                    
                    $packages[] = [
                        'name' => 'Package ' . $package_index++,
                        'primary_rating' => $rating,
                        'main_hotel' => $hotel_data['hotel_name'],
                        'fallback_hotels' => array_unique($fallback_hotels_used),
                        'hotels' => $package_hotels,
                        'total_cost' => round($total_package_cost)
                    ];
                }
            }
            
            // 🔹 Merge same hotel nights within each package
            foreach ($packages as &$pkg) {
                $merged_hotels = [];
                foreach ($pkg['hotels'] as $hotel) {
                    $key = $hotel['name'] . '_' . $hotel['rating'];
                    if (!isset($merged_hotels[$key])) {
                        $merged_hotels[$key] = [
                            'name' => $hotel['name'],
                            'rating' => $hotel['rating'],
                            'nights' => [],
                            'cost_per_person' => $hotel['cost_per_person'],
                            'type' => $hotel['type']
                        ];
                    }
                    $merged_hotels[$key]['nights'][] = $hotel['night'];
                }

                foreach ($merged_hotels as &$h) {
                    sort($h['nights']);
                    $unique_nights = array_unique($h['nights']);
                    $formatted_nights = array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $unique_nights);

                    $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
                    if (in_array(0, $unique_nights)) {
                        $total_nights += 1; // count early check-in as 1N
                    }

                    $h['night'] = $total_nights ;
                }

                $pkg['hotels'] = array_values($merged_hotels);
            }
            unset($pkg);

            if (!empty($packages)) {
                $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
                $cost_html .= '<tr style="background-color: #d6d8d9; font-weight:bold;">
                    <th>Package</th>
                    <th>Hotel</th>
                    <th>Rating</th>
                    <th>No. of Nights</th>';
                    if (!empty($hotel_markup_percentage)) {
                            $cost_html .= '<th>Cost Per Person / Night</th>';
                        } else {
                            $cost_html .= '<th>Cost Per Person</th>';
                        }
                $cost_html .='</tr>';
                // usort($packages, function($a, $b) {
                //     return $a['total_cost'] <=> $b['total_cost'];
                // });
                foreach ($packages as $pkg) {
                    $rowspan = count($pkg['hotels']);
                    $first_row = true;

                    foreach ($pkg['hotels'] as $index => $hotel) {
                        $cost_html .= '<tr>';
                        if ($first_row) {
                            $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
                            $first_row = false;
                        }
                        
                        $hotel_bg_color = ($hotel['type'] == 'same_hotel') ? '#d6d8d9' : '#d6d8d9';
                        $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: ' . $hotel_bg_color . ';">' . $hotel['name'] . '</td>';
                        $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . str_replace('_', ' ', $hotel['rating']) . '</td>';
                        
                        // if ($hotel['night'] == 0) {
                        //     $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">Early Check-in</td>';
                        // } else {
                        //     $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . $hotel['night'] . ' N</td>';
                        // }
                         $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . $hotel['night'] . '</td>';

                        
                        if(!empty($hotel_markup_percentage))
                        {
                            $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">$' . $hotel['cost_per_person'] . '</td>';
                        }else
                        {
                            if ($index === 0) {
                                $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9; font-weight:bold;">$' . number_format($pkg['total_cost']) . '</td>';
                            }
                        }
                        $cost_html .= '</tr>';
                    }
                }
                if(!empty($hotel_markup_percentage))
                {
                    $total_cols = 0;
                    foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                        foreach ($hotels as $hotelData) {
                            if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
                                $total_cols++;
                            }
                        }
                    }
                    $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal ;
                    $markup_percentage = floatval($this->input->post('markup_percentage'));
                    $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
                    $converted_other = ($currency->country_currency_value > 0) 
                        ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
                        : 0;
                    $cost_html .= '<tr>
                        <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                        <td colspan="4" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                    </tr>';

                }

                $cost_html .= '</table>';
            }
        }

            // echo '<pre>';print_r($hotel_names_category_wise);
            // echo '<pre>';print_r($hotel_room_category_names_wise);
            // echo '<pre>';print_r($hotel_costing_category_wise);
            // echo $cost_html;
            // die();
        }
        else if ($this->input->post('hdn_group_type') == 'individual') 
        {
            $hotel_markup_percentage = floatval($this->input->post('hotel_markup_percentage'));
            $markup_percentage = floatval($this->input->post('markup_percentage'));
            $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
            $grand_total_pp = $grand_total / $total_persons;
            $grand_total_pp += ($grand_total_pp * ($markup_percentage / 100));

            $cost_html = '';
            $has_valid_nights = false;
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    if (!empty($categories['nights'])) {
                        $filtered_nights = array_filter($categories['nights'], fn($v) => $v != 0);
                        if (count($filtered_nights) > 0) {
                            $has_valid_nights = true;
                            break 2; // exit both loops
                        }
                    }
                }
            }
            if (!$has_valid_nights) {
            $cost_html .= '<table class="rating-table" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:100%; text-align: left;">';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                $colspan = 0;
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                         if (is_array($occupancies)) {
                            $colspan += count($occupancies); 
                         }
                    }
                }
                $rating_display = ucwords(str_replace('_', ' ', $rating_key));
                $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) { 
                    $occ_count = 0;
                    foreach ($categories as $cat => $occupancies) {
                    if ($cat === "nights") continue;
                        if (is_array($occupancies)) {
                            $occ_count += count($occupancies);
                        }
                    }

                    $nights = isset($categories['nights']) ? $categories['nights'] : 0;
                
                    if (is_array($nights)) {
                        $filtered_nights = array_filter($nights, function($v) {
                            return $v != 0; // remove any 0 entries
                        });
                        $night_count = count($filtered_nights);
                    } else {
                        $night_count = (int)$nights;
                    }
                    $hotel_display = $hotel_name . ($nights ? " ({$night_count}N)" : "");
                    $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #d6d8d9; font-weight:bold;color:#6060a9;">' . $hotel_display . '</td>';
                }
            }
            $cost_html .= '</tr>';
           $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    $roomCats = [];
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $roomCats[] = $cat;
                        }
                    }
                    $prev = null;
                    $span = 0;
                    foreach ($roomCats as $i => $cat) {
                        if ($cat === $prev) {
                            $span++;
                        } else {
                            if ($prev !== null) {
                                $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                                $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
                            }
                            $prev = $cat;
                            $span = 1;
                        }
                    }
                    if ($prev !== null) {
                        $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                        $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
                    }
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Occupancy</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
                            $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
                            $occupancy_type = trim($occupancy_type);
                            // $cost_html .= '<td style="background-color: #d6d8d9;">' . $occupancy_type . '</td>';
                            if(($occupancy_type) == 'Double'){
                                $occupancy_type = 'Double/Twin';
                                $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
                            }else{
                                $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
                            }
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            $label = ($has_valid_nights) ? "Hotel Cost Per Person" : "Cost Per Person";
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;
                            if(!empty($hotel_markup_percentage))
                            {
                                $occupancy_cost += ($occupancy_cost * ($hotel_markup_percentage / 100));
                            }else{
                                $occupancy_cost += ($occupancy_cost * ($markup_percentage / 100));
                            }

                            if ($has_valid_nights) {
                                $cost_with_total = $occupancy_cost;
                            } else {
                                 $cost_with_total = $occupancy_cost;
                                if (empty($hotel_markup_percentage)) {
                                    $cost_with_total += $grand_total_pp;
                                }
                            }
                            $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

                            $cost_html .= '<td style="background-color: #d6d8d9;">$' . $converted . '</td>';
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            if(!empty($hotel_markup_percentage)){
                $total_cols = 0;
                foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                    foreach ($hotels as $hotel_name => $categories) {
                        foreach ($categories as $cat => $occupancies) {
                            if (is_array($occupancies)) {
                                $total_cols += count($occupancies);
                            }
                        }
                    }
                }
                $converted_other = ($currency->country_currency_value > 0) 
                    ? round($grand_total_pp / $currency->country_currency_value) 
                    : 0;
                $cost_html .= '<tr>
                    <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                    <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                </tr>';
            }
            $cost_html .= '</table>';
        }

            // if ($has_valid_nights) {

            //     $hotels_by_ratings = [];

            //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //         foreach ($hotels as $hotel_name => $categories) {
            //             $nights_array = $categories['nights'] ?? [];
            //             // $filtered_nights = is_array($nights_array)
            //             //     ? array_filter($nights_array, fn($v) => $v != 0)
            //             //     : [];
            //             $filtered_nights = is_array($nights_array) ? $nights_array : [];

            //             if (empty($filtered_nights)) continue;

            //             foreach ($filtered_nights as $night_no) {
            //                 $hotels_by_ratings[$rating_key][$night_no][] = [
            //                     'name' => $hotel_name,
            //                     'rating' => $rating_key,
            //                     'night_no' => $night_no,
            //                     'categories' => $categories
            //                 ];
            //             }
            //         }
            //     }

            //     $all_ratings = array_keys($hotels_by_ratings);
            //     $all_nights = [];

            //     foreach ($hotels_by_ratings as $rating => $night_hotels) {
            //         $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            //     }

            //     sort($all_nights);

            //     foreach ($all_ratings as $rating) {
            //         foreach ($all_nights as $night_no) {
            //             if (
            //                 !isset($hotels_by_ratings[$rating][$night_no]) ||
            //                 empty($hotels_by_ratings[$rating][$night_no])
            //             ) {
            //                 foreach ($all_ratings as $alt_rating) {
            //                     if ($alt_rating === $rating) continue;
            //                     if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                         $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
            //                         break;
            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     $packages = [];
            //     $package_index = 1;

            //     foreach ($hotels_by_ratings as $rating => $night_groups) {
            //         $max_count = 0;
            //         foreach ($night_groups as $night_hotels) {
            //             $max_count = max($max_count, count($night_hotels));
            //         }

            //         for ($i = 0; $i < $max_count; $i++) {
            //             $combo = [];

            //             foreach ($all_nights as $night_no) {
            //                 $night_hotels = $night_groups[$night_no];
            //                 $hotel = $night_hotels[$i] ?? end($night_hotels);

            //                 if (!$hotel) {
            //                     foreach ($all_ratings as $alt_rating) {
            //                         if ($alt_rating == $rating) continue;
            //                         if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                             $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
            //                             if ($hotel) break;
            //                         }
            //                     }
            //                 }

            //                 if ($hotel) {
            //                     $combo[] = $hotel;
            //                 }
            //             }
            //             if (!empty($combo)) {
            //                 $merged_costs = [];
            //                 foreach ($combo as $hotel) {
            //                     $categories = $hotel['categories'];
            //                     foreach ($categories as $cat => $occupancies) {
            //                         if (!is_array($occupancies) || $cat === 'nights') continue;

            //                         foreach ($occupancies as $occ) {
            //                             $occ_arr = explode('__', $occ);
            //                             $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
            //                             $occ_cost = floatval($occ_arr[1] ?? 0);

            //                             // Only add if not already added for this hotel
            //                             if (!isset($merged_costs[$hotel['name']][$occ_type])) {
            //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
            //                                 $merged_costs[$hotel['name']][$occ_type] = true; // mark as added
            //                             }
            //                         }
            //                     }
            //                 }

            //                 $packages[] = [
            //                     'name' => 'Package ' . $package_index++,
            //                     'rating' => $rating,
            //                     'hotels' => $combo,
            //                     'merged_costs' => $merged_costs
            //                 ];
            //             }
            //         }
            //     }
            //     $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">
            //         <th rowspan="2">Package</th>
            //         <th rowspan="2">Hotel</th>
            //         <th rowspan="2">Rating</th>
            //         <th rowspan="2">Nights</th>
            //         <th colspan="3">Cost Per Person</th>
            //     </tr>
            //     <tr style="background:#d6d8d9; font-weight:bold;">
            //         <th>Single</th>
            //         <th>Double / Twin</th>
            //         <th>Triple</th>
            //     </tr>';

            //     // foreach ($packages as $pkg) {
            //     //     $rowspan = count($pkg['hotels']);
            //     //     $first_row = true;

            //     //     foreach ($pkg['hotels'] as $hotel) {
            //     //         $name = $hotel['name'];
            //     //         $rating = $hotel['rating'];
            //     //         $night_no = $hotel['night_no'];
            //     //         $stars = str_replace('_', ' ', $rating);

            //     //         // Hotel costs are already multiplied by nights
            //     //         // $single_cost = ((isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0) + $grand_total_pp) / $currency->country_currency_value;
            //     //         // $double_cost = ((isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0) + $grand_total_pp) / $currency->country_currency_value;
            //     //         // $triple_cost = ((isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0) + $grand_total_pp) / $currency->country_currency_value;
            //     //         // Apply markup (hotel-specific or default)
            //     //         $single_base = isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0;
            //     //         $double_base = isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0;
            //     //         $triple_base = isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0;

            //     //         // Apply hotel markup if available, else use general markup
            //     //         if(!empty($hotel_markup_percentage)) {
            //     //             $single_base += ($single_base * ($hotel_markup_percentage / 100));
            //     //             $double_base += ($double_base * ($hotel_markup_percentage / 100));
            //     //             $triple_base += ($triple_base * ($hotel_markup_percentage / 100));
            //     //         } else {
            //     //             $single_base += ($single_base * ($markup_percentage / 100));
            //     //             $double_base += ($double_base * ($markup_percentage / 100));
            //     //             $triple_base += ($triple_base * ($markup_percentage / 100));
            //     //         }

            //     //         // Add other per-person grand totals
            //     //         $single_cost = ($single_base + $grand_total_pp) / $currency->country_currency_value;
            //     //         $double_cost = ($double_base + $grand_total_pp) / $currency->country_currency_value;
            //     //         $triple_cost = ($triple_base + $grand_total_pp) / $currency->country_currency_value;



            //     //         $cost_html .= '<tr style="background-color: #d6d8d9;">';
            //     //         if ($first_row) {
            //     //             $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;">' . $pkg['name'] . '</td>';
            //     //         }
            //     //         $cost_html .= '<td style=" font-weight:bold;color:#6060a9;">' . $name . '</td>';
            //     //         $cost_html .= '<td>' . $stars . '</td>';
            //     //         if($night_no == 0 )
            //     //         {
            //     //             $cost_html .= '<td> Early Check-in</td>';
            //     //         }else{
            //     //             $cost_html .= '<td>' . $night_no . 'N' . '</td>';
            //     //         }

            //     //         if ($first_row) {
            //     //             $cost_html .= '<td rowspan="' . $rowspan . '"> $' .
            //     //                 number_format($single_cost) . ' / $' .
            //     //                 number_format($double_cost) . ' / $' .
            //     //                 number_format($triple_cost) . '</td>';
            //     //             $first_row = false;
            //     //         }
            //     //         $cost_html .= '</tr>';
            //     //     }
            //     // }
            //     foreach ($packages as $pkg) {

            //     // Group same hotel names across multiple nights
            //     $grouped_hotels = [];
            //     foreach ($pkg['hotels'] as $hotel) {
            //         $name = $hotel['name'];
            //         $rating = $hotel['rating'];
            //         $night_no = $hotel['night_no'];
            
            //         if (!isset($grouped_hotels[$name])) {
            //             $grouped_hotels[$name] = [
            //                 'name' => $name,
            //                 'rating' => $rating,
            //                 'nights' => [],
            //             ];
            //         }
            //         $grouped_hotels[$name]['nights'][] = $night_no;
            //     }
            
            //     $rowspan = count($grouped_hotels);
            //     $first_row = true;
            
            //     foreach ($grouped_hotels as $hotel) {
            //         $name = $hotel['name'];
            //         $rating = $hotel['rating'];
            //         $stars = str_replace('_', ' ', $rating);
            //         $unique_nights = array_unique($hotel['nights']);
            //             $nights_text = implode(', ', array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $unique_nights));

            //             $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
            //             if (in_array(0, $unique_nights)) {
            //                 $total_nights += 1; // count Early Check-in as 1 night
            //             }

            //             $nights_text = $total_nights;
            
            //         // Combine nights like "1N, 2N, 4N"
            //         // $nights_text = implode(', ', array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $hotel['nights']));
            
            //         $single_base = isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0;
            //         $double_base = isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0;
            //         $triple_base = isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0;
            
            //         if (!empty($hotel_markup_percentage)) {
            //             $single_base += ($single_base * ($hotel_markup_percentage / 100));
            //             $double_base += ($double_base * ($hotel_markup_percentage / 100));
            //             $triple_base += ($triple_base * ($hotel_markup_percentage / 100));
            //         } else {
            //             $single_base += ($single_base * ($markup_percentage / 100));
            //             $double_base += ($double_base * ($markup_percentage / 100));
            //             $triple_base += ($triple_base * ($markup_percentage / 100));
            //         }
                    
            //           $add_total = empty($hotel_markup_percentage) ? $grand_total_pp : 0;
            //             $single_cost = ($single_base + $add_total) / $currency->country_currency_value;
            //             $double_cost = ($double_base + $add_total) / $currency->country_currency_value;
            //             $triple_cost = ($triple_base + $add_total) / $currency->country_currency_value;
            
            //         // $single_cost = ($single_base + $grand_total_pp) / $currency->country_currency_value;
            //         // $double_cost = ($double_base + $grand_total_pp) / $currency->country_currency_value;
            //         // $triple_cost = ($triple_base + $grand_total_pp) / $currency->country_currency_value;
            
            //         $cost_html .= '<tr>';
            //         if ($first_row) {
            //             $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
            //         }
            
            //         $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
            //         $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
            //         $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';
            
            //         if ($first_row) {
            //             // $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //             //     number_format($single_cost) . ' / $' .
            //             //     number_format($double_cost) . ' / $' .
            //             //     number_format($triple_cost) . '</td>';
            //             $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($single_cost) . '</td>';
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($double_cost) . '</td>';
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($triple_cost) . '</td>';
            //             $first_row = false;
            //         }
            
            //         $cost_html .= '</tr>';
            //     }
            // }
            // if(!empty($hotel_markup_percentage)){
            //         $total_cols = 0;
            //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //             foreach ($hotels as $hotel_name => $categories) {
            //                 foreach ($categories as $cat => $occupancies) {
            //                     if (is_array($occupancies)) {
            //                         $total_cols += count($occupancies);
            //                     }
            //                 }
            //             }
            //         }
            //         $converted_other = ($currency->country_currency_value > 0) 
            //             ? round($grand_total_pp / $currency->country_currency_value) 
            //             : 0;
            //         $cost_html .= '<tr>
            //             <th style="background-color:#d6d8d9;">Land Package Cost Per Person</th>
            //             <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
            //         </tr>';
            //     }

            //     $cost_html .= '</table>';
            // }
            // if ($has_valid_nights) {
            //     $hotels_by_ratings = [];

            //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //         foreach ($hotels as $hotel_name => $categories) {
            //             $nights_array = $categories['nights'] ?? [];
            //             $filtered_nights = is_array($nights_array) ? $nights_array : [];

            //             if (empty($filtered_nights)) continue;

            //             foreach ($filtered_nights as $night_no) {
            //                 $hotels_by_ratings[$rating_key][$night_no][] = [
            //                     'name' => $hotel_name,
            //                     'rating' => $rating_key,
            //                     'night_no' => $night_no,
            //                     'categories' => $categories
            //                 ];
            //             }
            //         }
            //     }

            //     $all_ratings = array_keys($hotels_by_ratings);
            //     $all_nights = [];

            //     foreach ($hotels_by_ratings as $rating => $night_hotels) {
            //         $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            //     }

            //     sort($all_nights);

            //     foreach ($all_ratings as $rating) {
            //         foreach ($all_nights as $night_no) {
            //             if (
            //                 !isset($hotels_by_ratings[$rating][$night_no]) ||
            //                 empty($hotels_by_ratings[$rating][$night_no])
            //             ) {
            //                 foreach ($all_ratings as $alt_rating) {
            //                     if ($alt_rating === $rating) continue;
            //                     if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                         $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
            //                         break;
            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     $packages = [];
            //     $package_index = 1;

            //     foreach ($hotels_by_ratings as $rating => $night_groups) {
            //         $max_count = 0;
            //         foreach ($night_groups as $night_hotels) {
            //             $max_count = max($max_count, count($night_hotels));
            //         }

            //         for ($i = 0; $i < $max_count; $i++) {
            //             $combo = [];

            //             foreach ($all_nights as $night_no) {
            //                 $night_hotels = $night_groups[$night_no];
            //                 $hotel = $night_hotels[$i] ?? end($night_hotels);

            //                 if (!$hotel) {
            //                     foreach ($all_ratings as $alt_rating) {
            //                         if ($alt_rating == $rating) continue;
            //                         if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                             $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
            //                             if ($hotel) break;
            //                         }
            //                     }
            //                 }

            //                 if ($hotel) {
            //                     $combo[] = $hotel;
            //                 }
            //             }
            //             if (!empty($combo)) {
            //                 $merged_costs = [];
            //                 foreach ($combo as $hotel) {
            //                     $categories = $hotel['categories'];
            //                     foreach ($categories as $cat => $occupancies) {
            //                         if (!is_array($occupancies) || $cat === 'nights') continue;

            //                         foreach ($occupancies as $occ) {
            //                             $occ_arr = explode('__', $occ);
            //                             $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
            //                             $occ_cost = floatval($occ_arr[1] ?? 0);

            //                             // Only add if not already added for this hotel
            //                             if (!isset($merged_costs[$hotel['name']][$occ_type])) {
            //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
            //                                 $merged_costs[$hotel['name']][$occ_type] = true; // mark as added
            //                             }
            //                         }
            //                     }
            //                 }

            //                 $packages[] = [
            //                     'name' => 'Package ' . $package_index++,
            //                     'rating' => $rating,
            //                     'hotels' => $combo,
            //                     'merged_costs' => $merged_costs
            //                 ];
            //             }
            //         }
            //     }

            //     // Determine which occupancy types actually have costs
            //     $all_occupancy_types = ['Single', 'Double', 'Triple'];
            //     $available_occupancy_types = [];
                
            //     foreach ($packages as $pkg) {
            //         foreach ($all_occupancy_types as $type) {
            //             if (isset($pkg['merged_costs'][$type]) && $pkg['merged_costs'][$type] > 0) {
            //                 $available_occupancy_types[$type] = true;
            //             }
            //         }
            //     }

            //     // Create column headers based on available occupancy types
            //     $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            //     $cost_html .= '<th rowspan="2">Package</th>';
            //     $cost_html .= '<th rowspan="2">Hotel</th>';
            //     $cost_html .= '<th rowspan="2">Rating</th>';
            //     $cost_html .= '<th rowspan="2">No. of Nights</th>';
                
            //     if (!empty($available_occupancy_types)) {
            //         $cost_html .= '<th colspan="' . count($available_occupancy_types) . '">Cost Per Person</th>';
            //     }
            //     $cost_html .= '</tr>';
                
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            //     foreach (array_keys($available_occupancy_types) as $type) {
            //         if ($type === 'Double') {
            //             $cost_html .= '<th>Double / Twin</th>';
            //         } else {
            //             $cost_html .= '<th>' . $type . '</th>';
            //         }
            //     }
            //     $cost_html .= '</tr>';

            //     foreach ($packages as $pkg) {
            //         // Group same hotel names across multiple nights
            //         $grouped_hotels = [];
            //         foreach ($pkg['hotels'] as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $night_no = $hotel['night_no'];

            //             if (!isset($grouped_hotels[$name])) {
            //                 $grouped_hotels[$name] = [
            //                     'name' => $name,
            //                     'rating' => $rating,
            //                     'nights' => [],
            //                 ];
            //             }
            //             $grouped_hotels[$name]['nights'][] = $night_no;
            //         }

            //         $rowspan = count($grouped_hotels);
            //         $first_row = true;

            //         foreach ($grouped_hotels as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $stars = str_replace('_', ' ', $rating);
            //             $unique_nights = array_unique($hotel['nights']);
                        
            //             $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
            //             if (in_array(0, $unique_nights)) {
            //                 $total_nights += 1; // count Early Check-in as 1 night
            //             }

            //             $nights_text = $total_nights;

            //             // Calculate costs for available occupancy types only
            //             $occupancy_costs = [];
            //             foreach (array_keys($available_occupancy_types) as $type) {
            //                 $base_cost = isset($pkg['merged_costs'][$type]) ? $pkg['merged_costs'][$type] : 0;
                            
            //                 if (!empty($hotel_markup_percentage)) {
            //                     $base_cost += ($base_cost * ($hotel_markup_percentage / 100));
            //                 } else {
            //                     $base_cost += ($base_cost * ($markup_percentage / 100));
            //                 }

            //                 $add_total = empty($hotel_markup_percentage) ? $grand_total_pp : 0;
            //                 $final_cost = ($base_cost + $add_total) / $currency->country_currency_value;
                            
            //                 $occupancy_costs[$type] = $final_cost;
            //             }

            //             $cost_html .= '<tr>';
            //             if ($first_row) {
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
            //             }

            //             $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';

            //             // Only show costs for available occupancy types
            //             if ($first_row) {
            //                 foreach ($occupancy_costs as $cost) {
            //                     $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' . number_format($cost) . '</td>';
            //                 }
            //                 $first_row = false;
            //             }

            //             $cost_html .= '</tr>';
            //         }
            //     }
                
            //     if(!empty($hotel_markup_percentage)){
            //         $total_cols = 4 + count($available_occupancy_types); // Package, Hotel, Rating, Nights + occupancy columns
            //         $converted_other = ($currency->country_currency_value > 0) 
            //             ? round($grand_total_pp / $currency->country_currency_value) 
            //             : 0;
            //         $cost_html .= '<tr>
            //             <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
            //             <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
            //         </tr>';
            //     }
            //     $cost_html .= '</table>';
            // }
        if ($has_valid_nights) {
            $hotels_by_ratings = [];

            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    $nights_array = $categories['nights'] ?? [];
                    $filtered_nights = is_array($nights_array) ? $nights_array : [];

                    if (empty($filtered_nights)) continue;

                    foreach ($filtered_nights as $night_no) {
                        $hotels_by_ratings[$rating_key][$night_no][] = [
                            'name' => $hotel_name,
                            'rating' => $rating_key,
                            'night_no' => $night_no,
                            'categories' => $categories
                        ];
                    }
                }
            }

            $all_ratings = array_keys($hotels_by_ratings);
            $all_nights = [];

            foreach ($hotels_by_ratings as $rating => $night_hotels) {
                $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            }

            sort($all_nights);

            foreach ($all_ratings as $rating) {
                foreach ($all_nights as $night_no) {
                    if (
                        !isset($hotels_by_ratings[$rating][$night_no]) ||
                        empty($hotels_by_ratings[$rating][$night_no])
                    ) {
                        foreach ($all_ratings as $alt_rating) {
                            if ($alt_rating === $rating) continue;
                            if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
                                $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
                                break;
                            }
                        }
                    }
                }
            }

            $packages = [];
            $package_index = 1;

            foreach ($hotels_by_ratings as $rating => $night_groups) {
                $max_count = 0;
                foreach ($night_groups as $night_hotels) {
                    $max_count = max($max_count, count($night_hotels));
                }

                for ($i = 0; $i < $max_count; $i++) {
                    $combo = [];

                    foreach ($all_nights as $night_no) {
                        $night_hotels = $night_groups[$night_no];
                        $hotel = $night_hotels[$i] ?? end($night_hotels);

                        if (!$hotel) {
                            foreach ($all_ratings as $alt_rating) {
                                if ($alt_rating == $rating) continue;
                                if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
                                    $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
                                    if ($hotel) break;
                                }
                            }
                        }

                        if ($hotel) {
                            $combo[] = $hotel;
                        }
                    }
                    if (!empty($combo)) {
                        $merged_costs = [];
                        $hotel_wise_costs = []; 
                        
                        $hotel_nights_in_package = [];
                        foreach ($combo as $hotel) {
                            $hotel_name = $hotel['name'];
                            if (!isset($hotel_nights_in_package[$hotel_name])) {
                                $hotel_nights_in_package[$hotel_name] = 0;
                            }
                            $hotel_nights_in_package[$hotel_name]++;
                        }
                        
                        foreach ($combo as $hotel) {
                            $categories = $hotel['categories'];
                            $hotel_name = $hotel['name'];
                            $hotel_wise_costs[$hotel_name] = []; 
                            
                            $original_nights = 0;
                            if (isset($categories['nights'])) {
                                if (is_array($categories['nights'])) {
                                    $original_nights = count(array_filter($categories['nights'], fn($n) => $n > 0));
                                } else {
                                    $original_nights = (int)$categories['nights'];
                                }
                            }
                            
                            $actual_nights_in_this_package = $hotel_nights_in_package[$hotel_name];
                            
                            foreach ($categories as $cat => $occupancies) {
                                if (!is_array($occupancies) || $cat === 'nights') continue;

                                foreach ($occupancies as $occ) {
                                    $occ_arr = explode('__', $occ);
                                    $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
                                    $occ_total_cost = floatval($occ_arr[1] ?? 0); 
                                    
                                    $occ_cost_per_night = $original_nights > 0 ? $occ_total_cost / $original_nights : 0;
                                    
                                    $total_cost_for_package = $occ_cost_per_night * $actual_nights_in_this_package;
                                    // print_r($total_cost_for_package);

                                    if (!isset($hotel_wise_costs[$hotel_name][$occ_type])) {
                                        $hotel_wise_costs[$hotel_name][$occ_type] = 0;
                                    }
                                    $hotel_wise_costs[$hotel_name][$occ_type] += $total_cost_for_package;

                                    if (!isset($merged_costs[$occ_type])) {
                                        $merged_costs[$occ_type] = 0;
                                    }
                                    $merged_costs[$occ_type] += $total_cost_for_package;
                                }
                            }
                        }

                        $packages[] = [
                            'name' => 'Package ' . $package_index++,
                            'rating' => $rating,
                            'hotels' => $combo,
                            'merged_costs' => $merged_costs,
                            'hotel_wise_costs' => $hotel_wise_costs 
                        ];
                    }
                }
            }

            $all_occupancy_types = ['Single', 'Double', 'Triple'];
            $available_occupancy_types = [];
            
            foreach ($packages as $pkg) {
                foreach ($all_occupancy_types as $type) {
                    if (isset($pkg['merged_costs'][$type]) && $pkg['merged_costs'][$type] > 0) {
                        $available_occupancy_types[$type] = true;
                    }
                }
            }

            $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            $cost_html .= '<th rowspan="2">Package</th>';
            $cost_html .= '<th rowspan="2">Hotel</th>';
            $cost_html .= '<th rowspan="2">Rating</th>';
            $cost_html .= '<th rowspan="2">No. of Nights</th>';
            if (!empty($available_occupancy_types)) {
                $cost_label = !empty($hotel_markup_percentage) ? 'Cost Per Room / Night' : 'Cost Per Person';
                $cost_html .= '<th colspan="' . count($available_occupancy_types) . '" >' . $cost_label . '</th>';
            }
            $cost_html .= '</tr>';
            
            $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            foreach (array_keys($available_occupancy_types) as $type) {
                if ($type === 'Double') {
                    $cost_html .= '<th>Double / Twin</th>';
                } else {
                    $cost_html .= '<th>' . $type . '</th>';
                }
            }
            $cost_html .= '</tr>';

            foreach ($packages as $pkg) {
                // Group same hotel names across multiple nights
                $grouped_hotels = [];
                foreach ($pkg['hotels'] as $hotel) {
                    $name = $hotel['name'];
                    $rating = $hotel['rating'];
                    $night_no = $hotel['night_no'];

                    if (!isset($grouped_hotels[$name])) {
                        $grouped_hotels[$name] = [
                            'name' => $name,
                            'rating' => $rating,
                            'nights' => [],
                        ];
                    }
                    $grouped_hotels[$name]['nights'][] = $night_no;
                }

                $rowspan = count($grouped_hotels);
                $first_row = true;

                foreach ($grouped_hotels as $hotel_name => $hotel_data) {
                    $name = $hotel_data['name'];
                    $rating = $hotel_data['rating'];
                    $stars = str_replace('_', ' ', $rating);
                    $unique_nights = array_unique($hotel_data['nights']);
                    
                    $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
                    if (in_array(0, $unique_nights)) {
                        $total_nights += 1; 
                    }

                    $nights_text = $total_nights;

                    $cost_html .= '<tr>';
                    if ($first_row) {
                        $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
                    }

                    $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
                    $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
                    $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';

                    if (!empty($hotel_markup_percentage)) {
                        $hotel_costs = $pkg['hotel_wise_costs'][$hotel_name] ?? [];
                        foreach (array_keys($available_occupancy_types) as $type) {
                            $base_cost = isset($hotel_costs[$type]) ? $hotel_costs[$type] : 0;
                            $base_cost += ($base_cost * ($hotel_markup_percentage / 100));

                            // $multiplier = 1;
                            // switch (strtolower($type)) {
                            //     case 'double':
                            //         $multiplier = 2;
                            //         break;
                            //     case 'triple':
                            //         $multiplier = 3;
                            //         break;
                            //     default:
                            //         $multiplier = 1;
                            // }

                            // $base_cost *= $multiplier;
                            $final_total_cost = $base_cost / $currency->country_currency_value;
                            // $final_cost_per_night = $total_nights > 0 ? $final_total_cost / $total_nights : 0;

                            $cost_html .= '<td style="background-color: #d6d8d9;"> $' . number_format($final_total_cost) . '</td>';
                        }
                    }

                    else 
                    {
                        $occupancy_costs = [];
                        foreach (array_keys($available_occupancy_types) as $type) {
                            $base_cost = isset($pkg['merged_costs'][$type]) ? $pkg['merged_costs'][$type] : 0;
                            
                            $base_cost += ($base_cost * ($markup_percentage / 100));
                            $final_cost_hotel = $total_nights > 0 ? $base_cost / $total_nights : 0;
                            
                            $add_total = $grand_total_pp;
                            $final_cost = ($final_cost_hotel + $add_total) / $currency->country_currency_value;
                            
                            $occupancy_costs[$type] = $final_cost;
                        }

                        if ($first_row) {
                            foreach ($occupancy_costs as $cost) {
                                $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' . number_format($cost) . '</td>';
                            }
                        }
                    }

                    if ($first_row) {
                        $first_row = false;
                    }
                    $cost_html .= '</tr>';
                }
            }
            
            if(!empty($hotel_markup_percentage)){
                $total_cols = 4 + count($available_occupancy_types); 
                $converted_other = ($currency->country_currency_value > 0) 
                    ? round($grand_total_pp / $currency->country_currency_value) 
                    : 0;
                $cost_html .= '<tr>
                    <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                    <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                </tr>';
            }
            $cost_html .= '</table>';
        }
        // return $cost_html;
        }
        // echo '<pre>';print_r($hotel_costing_category_wise);
        // echo $cost_html;die();
        $flight_details='<div style="background-color: #d6d8d9;padding: 0 10px 10px;">
            <div class="title" style="padding: 12px 20px; margin: 0 0 5px; background-color: #d6d8d9; text-align: center;"><h4 style="padding: 0; margin: 0; color: #6060a9; text-decoration: none; text-transform: capitalize;">FLIGHT ENVISAGED</h4></div>
                <div class="text">
                    <div class="flight-wrapper" style="">
                        <div class="flight-card from" style="margin-bottom: 5px;display: flex;box-sizing: border-box;  padding: 12px; background-color: #fff;">
                        
                            <div class="card-header" style="width: 24%; font-size: 16px;  color: #2e3b4e; border-right: dashed 1px #ccc; margin-bottom: 6px; padding-bottom: 15px; display: flex;  align-items: center; gap: 8px;"> <i class="fa-solid fa-plane-departure"></i> <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Arrival</h4></div>
                            <div style="width: 65%;padding-left: 20px;">
                            <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                                <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Airline:</div>
                                <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
                            </div>
                            <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                                <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Time:</div>
                                <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('arrival_time').'</div>
                            </div>
                            </div>
                        </div>
                        <div class="flight-card to" style=" display: flex;box-sizing: border-box;  padding: 12px; background-color: #fff;">
                        
                            <div class="card-header" style="width: 24%; font-size: 16px;  color: #2e3b4e; border-right: dashed 1px #ccc; margin-bottom: 6px; padding-bottom: 15px; display: flex;  align-items: center; gap: 8px;"><i class="fa-solid fa-plane-arrival"></i> <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Departure</h4></div>
                            <div style="width: 65%;padding-left: 20px;">
                            <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                                <div class="label" style="font-size: 12px; color: #778093; text-transform: uppercase;">Airline:</div>
                                <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
                            </div>
                            <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                                <div class="label" style="font-size: 12px; color: #778093; text-transform: uppercase;">Time:</div>
                                <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('departing_time').'</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>';

            $only_itinerary_html = '
                <div class="text" style="margin-top:-30px;">
                    <div class="itinerary-table">
                        <div class="itinerary-header" style="background-color: #d6d8d9;display: flex;padding: 10px;">
                            <div class="col-one" style="width: 13% !important;">
                                <b style="color:black !important;">Day</b>
                            </div>
                            <div class="col-two" style="border-left: solid 1px #8299b0;padding-left: 15px;width: 57% !important;">
                                <b style="color:black !important;">Activity</b>
                               
                            </div>
                            <div class="col-three" style="border-left: solid 1px #8299b0; padding-left: 15px; width: 30% !important;">
                                <b style="color:black;">Remark</b>
                                <b style="display: inline-block; float: right; color:blue;">
                                    <a style="color:blue;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">Click here for detailed itinerary.</a>
                                </b>
                            </div>
                        </div>';

            $total_transportation_outside = 0;
            $total_transportation_inside = 0;
            $activities = '';

            for ($i = 1; $i <= $cnt; $i++) {   
                $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;

                $only_itinerary_html .= '
                    <div class="itinerary-item" style="border-bottom: dashed 1.6px #8299b070;align-items: center;
            display: flex;
            padding: 8px 10px;">
                        <div class="col-one" style="width: 13% !important;">
                            <span>Day ' . $i . '</span>
                        </div>
                        <div class="col-two" style=" border-left: solid 1px #8299b0;padding-left: 15px;width: 57% !important;">
                            <ul style="margin: 0;padding: 0 13px !important;">';
                            
                        $ticket_name = $this->input->post('itinerary_entry_ticket_' . $i);
                        if (!empty($ticket_name)) {
                            if (is_array($ticket_name)) {
                                foreach ($ticket_name as $t) {
                                    if (!empty($t)) {
                                        $all_ticket_names[] = $t;
                                    }
                                }
                            } else {
                                $all_ticket_names[] = $ticket_name;
                            }
                        }


                if ($cnt_text > 0) {
                    
                    for ($j = 0; $j < $cnt_text; $j++) {
                        if ($i == $cnt && $j == 0) {
                            continue;
                        }
                        
                        $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') 
                            ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' 
                            : '';
                        $only_itinerary_html .= '<li>' . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';
                    }
                    
                    $itinerary_entry_ticket_html = '';
                    if (!empty($all_ticket_names) && is_array($all_ticket_names)) 
                        {
                            $unique_tickets = array_unique($all_ticket_names);
                        foreach ($unique_tickets as $ticket) {
                            $itinerary_entry_ticket_html .= '<li style="position:relative; color:#555555; margin-bottom:6px;">' . $ticket . '</li>';
                        }
                    }

                    if (!empty($this->input->post('itinerary_activities_'.$i))) {
                        foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
                            if ($activity != "") {
                               $activities .= '<li style="position:relative; color:#555555;">' . $activity . '</li>';
                                $only_itinerary_html .= '<li>' . $activity . '</li>';
                            }
                        }
                    }
                } else {
                    // Show message when no itinerary
                    $only_itinerary_html .= '<li><i>No Itinerary</i></li>';
                }

                $only_itinerary_html .= '
                            </ul>
                        </div>
                        <div class="col-two" style="border-left: solid 1px #8299b0; padding-left: 15px; width: 30% !important;">
                            <ul style="margin: 0;padding: 0 13px !important;">';
                                if ($i == $cnt) {
                            $only_itinerary_html .= '<li>Departure Souvenir Gift</li>';
                        } else {
                            $only_itinerary_html .= '<li >Free Wifi</li>';
                        }
                      $only_itinerary_html .= '</ul>
                        </div>
                    </div>';

                if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
                    $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
                }
                if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
                    $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
                }
            }

            $only_itinerary_html .= '
                    </div>
                </div>';
                
                $vehicless_json = $this->input->post('vehicless');
                $vehicless_arr = json_decode($vehicless_json, true);
                $vehicles_with_name = [];
            
                    if (!empty($vehicless_arr)) {
                        foreach ($vehicless_arr as $veh) {
                            $vehicle_id = $veh['vehicle_id'];
                            $qnty = $veh['qnty'];
            
                            if (!empty($vehicle_id)) {
                                $query = $this->db->select('vehicle_name')
                                                ->from('transportation')
                                                ->where('id', $vehicle_id)
                                                ->get();
            
                                if ($query && $query->num_rows() > 0) {
                                    $vehicle = $query->row();
                                    $vehicles_with_name[] = [
                                        $vehicle_name = $vehicle->vehicle_name,
                                    ];
                                } else {
                                    // Fallback if vehicle not found
                                    $vehicles_with_name[] = [
                                        $vehicle_name ='',
                                    ];
                                }
                            }
                        }
                    }
            
                    // Now $vehicles_with_name contains vehicle names and quantities
                    foreach ($vehicles_with_name as $v) {
                           
                        $vehicle_name=$vehicle_name;
                    }
    // echo $itinerary_entry_ticket_html ; die();

                $short_itinerary='<div class="title" style="padding: 12px 20px;background-color: #d6d8d9;">
                    <h4 style="color:#6060a9;">SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
                </div>';
                $activites = '';
                
        $inclusions='<div style="background-color: #d6d8d9;  padding: 0px 10px 1px 10px;"><div class="title" style=" background-color: #d6d8d9; text-align: center;">
                <h4 style="padding:12px 20px; margin: 0; color:#6060a9; text-decoration: none; text-transform: capitalize;">OUR INCLUSIONS</h4>
            </div>
         <div style="padding: 10px 15px;margin: 0 2px;background-color: #fff;width: 100%;
    box-sizing: border-box;">
            <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Stay :</h4>
            <p style="padding: 0; margin: 0;display: inline;">As Mentioned Above</p>
        </div>
            <div class="text">
                <div class="our-inclusion" style="">
                   <div class="inclusion-item" style="background-color: #fff;margin: 10px 2px;padding: 1px 0px 12px 0 !important;">
                        <div class="box" style"padding: 1px 0px 12px 0 !important;">
                            <h4 style="padding-left: 12px;padding-top: 0; margin: 10px 0px;">Transportation & '.$guide.'</h4>
                            <ul style="margin:0; padding-left:20px;">
                                <li style="">All transfers & sightseeing by private vehicle ('.$vehicle_name.') for 12 Hrs (10AM – 10PM Only) </li>
                                <li style="">Airport – hotel – airport transfers</li>
                                <li style="port Drop Off</li>
                                <li style="">Dinner Transfers</li>
                                <li style="">All transfers & sightseeing include services of an English-speaking '.$guide.'.</li>
                                <li style="">Airport meet & greet by our English-speaking staff.</li>
                            
                            </ul>
                        </div>
                    </div>';
                    
            $meal_data = json_decode($meal_type_daywise_price, true);
            $meal_counts = [];
            if (is_array($meal_data)) {
                foreach ($meal_data as $day => $meals) {
                    foreach ($meals as $meal_type => $details) {
                        $meal_type_clean = strtolower(str_replace(' ', '_', $meal_type)); 
                        if (isset($meal_counts[$meal_type_clean])) {
                            $meal_counts[$meal_type_clean]++;
                        } else {
                            $meal_counts[$meal_type_clean] = 1;
                        }
                    }
                }
            }


                $inclusions.='
                    <div class="inclusion-item" style="background-color: #fff;margin: 10px 2px;padding: 1px 0px 12px 0 !important;">
                        <div class="box" style"border-left: solid 1px #ccc; background-color: #d6d8d9;padding: 1px 0px 12px 0 !important;">
                            <h4 style="padding-left: 12px;padding-top: 0; margin: 10px 0px;">Entrance & Activities</h4>
                            <ul style="margin:0; padding-left:20px;">
                            '.$itinerary_entry_ticket_html.'
                                '.$activities;
                                if(!empty($final_toll_price) || $final_toll_price >0)
                                { 
                                    $inclusions.='<li style="color:#555555;">Toll Included</li>';
                                }

                           $inclusions.='
                            </ul>
                        </div>
                    </div>
                    <div class="inclusion-item" style="background-color: #fff;margin: 10px 2px;padding: 1px 0px 12px 0 !important;">
                         <div class="box" style"width: 100%; height: 90%; border-left: solid 1px #ccc; background-color: #fff !important;padding: 1px 0px 12px 0;">
                            <h4 style="padding-left: 12px;padding-top: 0px; margin: 10px 0px;">Meals</h4>
                            <ul style="margin:0; padding-left:25px;">';
                                    $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>Breakfast at your hotel</li>";
                            foreach ($meal_counts as $type => $count) {
                                if ($count > 0) {
                                    $email_summary = $count . ' - ' . ucfirst(str_replace('_', ' ', $type)) . '<br>';
                                    $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$email_summary</li>";
                                }
                            }
                            $inclusions.='</ul>
                        </div>
                          </div>
                          <div class="inclusion-item" style="background-color: #fff;margin: 10px 2px;padding: 1px 0px 12px 0 !important;">
                        <div class="box" style"border-left: solid 1px #ccc; background-color: #d6d8d9; margin-top:-100px !important;">
                            <h4 style="padding-left: 12px;padding-top:0px; margin: 5px 0px;">Complimentary Services</h4>
                            <ul style="margin:0; padding-left:20px;">';
                            $mandatory_services_json = $_POST['mandatory_services'] ?? '[]';
                            $mandatory_services = json_decode($mandatory_services_json, true);
                                if (!empty($mandatory_services)) {
                                    $service_text1 = rtrim(explode("|", $mandatory_services[0]['service'])[0], "_");
                                    $price1        = explode("|", $mandatory_services[0]['service'])[1];
                                    $qnty1         = $mandatory_services[0]['qnty'];

                                    $service_text2 = rtrim(explode("|", $mandatory_services[1]['service'])[0], "_");
                                    $price2        = explode("|", $mandatory_services[1]['service'])[1];
                                    $qnty2         = $mandatory_services[1]['qnty'];

                                    $service_text3 = rtrim(explode("|", $mandatory_services[2]['service'])[0], "_");
                                    $price3        = explode("|", $mandatory_services[2]['service'])[1];
                                    $qnty3         = $mandatory_services[2]['qnty'];

                                    $service_text4 = rtrim(explode("|", $mandatory_services[3]['service'])[0], "_");
                                    $price4        = explode("|", $mandatory_services[3]['service'])[1];
                                    $qnty4         = $mandatory_services[3]['qnty'];

                                    $inclusions .= "<li style=''>$service_text3</li>";
                                    $inclusions .= "<li style=''>$service_text2</li>";
                                    $inclusions .= "<li style=''>$service_text4</li>";
                                    $inclusions .= "<li style=''>$service_text1</li>";

                                    // foreach ($mandatory_services as $service) {
                                    //     // print_r()
                                    //     $service_text = rtrim(explode("|", $service['service'])[0], "_");
                                    //     $price = explode("|", $service['service'])[1];
                                    //     $qnty = $service['qnty'];
                                    //     $inclusions .= "<li style='position:relative; list-style:none; color:#555555; margin-bottom:6px;'>{$service_text}</li>";
                                    // }
                                } else {
                                    $inclusions .="<li style='position:relative; list-style:none; color:#555555; margin-bottom:6px;'>No mandatory services provided.</li>";
                                }
                            $inclusions.='</ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>';
            // $activities_html='<b>Click here for <a href="'.base_url('assets/aditional_activities_cost.pdf').'" target="_blank" >Additional Activities.</b></a>';
                $activities_html='<br><span><b style="font-size:18px;"><i class="fas fa-tasks"></i> Click here for <a href="'.base_url('assets/aditional_activities_cost.pdf').'" target="_blank" >Additional Activities.</b></a></span><br><br>';

            // $activities_html = '
            //     <div style="margin-top:20px;">
    
            //         <table border="1" cellspacing="0" cellpadding="6" width="100%" style="border-collapse:collapse; font-size:14px; color:#333;">
            //             <thead>
            //                 <tr style="background-color:#d6d8d9; font-weight:bold; text-align:center;">
            //                     <th style="width:50px;">S.NO</th>
            //                     <th>Additional Activity Name</th>
            //                 </tr>
            //             </thead>
            //             <tbody>
            //                 <tr><td align="center">1</td><td align="center">Private outdoor picnic set-up with lunch near River/Lakeside</td></tr>
            //                 <tr><td align="center">2</td><td align="center">Party in a stretch Limo with music, Hostesses & champagne (2 hours)</td></tr>
            //                 <tr><td align="center">3</td><td align="center">Paragliding</td></tr>
            //                 <tr><td align="center">4</td><td align="center">Go-Karting + Buggy adventure</td></tr>
            //                 <tr><td align="center">5</td><td align="center">Double barrel shotgun shooting experience</td></tr>
            //                 <tr><td align="center">6</td><td align="center">Night club hopping</td></tr>
            //                 <tr><td align="center">7</td><td align="center">3rd Longest Zipline in the world</td></tr>
            //                 <tr><td align="center">8</td><td align="center">Private Pool Villa party</td></tr>
            //                 <tr><td align="center">9</td><td align="center">Hot Air Ballooning</td></tr>
            //                 <tr><td align="center">10</td><td align="center">River Rafting</td></tr>
            //                 <tr><td align="center">11</td><td align="center">Picnic lunch near the river side</td></tr>
            //                 <tr><td align="center">12</td><td align="center">Yacht Party</td></tr>
            //                 <tr><td align="center">13</td><td align="center">GyroPlane experience</td></tr>
            //                 <tr><td align="center">14</td><td align="center">Cessna – Learn to fly a plane</td></tr>
            //                 <tr><td align="center">15</td><td align="center">Visit Big Almaty Lake on an E-Bikes/E-Cycles</td></tr>
            //                 <tr><td align="center">16</td><td align="center">E-Scootie experience in the city</td></tr>
            //                 <tr><td align="center">17</td><td align="center">Casino visit</td></tr>
            //                 <tr><td align="center">18</td><td align="center">ATV ride</td></tr>
            //                 <tr><td align="center">19</td><td align="center">Falcon show</td></tr>
            //                 <tr><td align="center">20</td><td align="center">Dolphin Show</td></tr>
            //                 <tr><td align="center">21</td><td align="center">Huns Ethno Village</td></tr>
            //                 <tr><td align="center">22</td><td align="center">Wine Tasting</td></tr>
            //                 <tr><td align="center">23</td><td align="center">Party Bus</td></tr>
            //                 <tr><td align="center">24</td><td align="center">Rifle Shooting (Asanov)</td></tr>
            //                 <tr><td align="center">25</td><td align="center">Qazaq Shooters (Carbine, Sniper, Revolver, Glock, Mosin, Steyr Aug etc)</td></tr>
            //             </tbody>
            //         </table>
            //     </div>';

               $country = ucfirst($currency->country); 
                
        //         echo '
        // <!DOCTYPE html><html><head>
        // <meta charset="UTF-8" />
        //     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        //     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        //     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        //         <style>
        //             th, td {
                      
                        
        //             }
                   
        //                 .title {

        //     background-color: #d6d8d9;
        //     text-align: center;
        // }
        // label {
        //     font-weight: bold;
        // }
   
        // .flight-card {
        //     background-color: #fff;
        //     border: solid 1px #ccc;
        //     width: 100%;
          
        //     padding: 15px 24px;
        // }
        //     .card-header {
        //     font-size: 16px;
        //     font-weight: 600;
        //     color: #2e3b4e;
        //     margin-bottom: 6px;
        //     padding-bottom: 15px;
        //     display: flex;
        //     align-items: center;
        //     gap: 8px;
        // }
        // .flight-row {
        //     margin-bottom: 4px;
        //     display: flex;
        //     justify-content: space-between;
        // }
        //     .label {
        //     font-size: 12px;
        //     color: #778093;
        //     text-transform: uppercase;
        //     margin-bottom: 4px;
        // }

        // .value {
        //     font-size: 14px;
        //     font-weight: 500;
        //     color: #2d3748;
        // }
        //     .title>h4 {
        //     padding: 0;
        //     margin: 0;
        //     color: #000;
        //     text-decoration: none;
        //     text-transform: capitalize;
        // }
   



        // .col-one>span {
        //     font-size: 18px;
        //     color: #3c556e;
        //     font-weight: 500;
        // }



        // .inclusion-item {
        //     width: 100%;
        //         margin: 0 4px;
        // }

 

        // .box h4 {
        //     padding-left: 12px;
        //     padding-top: 12px;
        // }

        // .inclusion-item ul li {
        //     position: relative;
        //     color: #555555;
        // }

        // .inclusion-item ul li::before {
        //     position: absolute;
        //     color: #242424;
        //     left: -22px;
        //     font-size: 11px;
        //     top: 0;
        // }
        //   .activites-item {
        //     background: #d6d8d9;
        //     display: flex;
        //     /* width: 33.33%; */
        //     padding: 8px 20px;
        //     margin-bottom: 6px;
        // }
        // .our-activites {
        //     display: flex;
        // }
        // .activites-item>div:nth-child(1) {
        //     width: 10%;
        // }
        // .activites-item>div:nth-child(2) {
        //     width: 6%;
        // }
        // .activites-item>div:nth-child(3) {
        //     width: 80%;
        // }
        // .our-activites>div {
        //     width: 33.33%;
        // }
        // .activites-item i {
        //     color: #6c6c6c;
        // }
        // .top-table+br{
        //         display: none !important;
        // }
        //  .top-table+br+br{
        //         display: none !important;
        // }
        //         </style>
        //     </head><body>
        //         <div class="table-container">
        //             <table class="top-table" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#d6d8d9;">
        //                 <tr>
        //                     <!-- Logo column -->
        //                     <td align="left" style="">
        //                     <img src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="Logo" width="95" style="display:block; border:0; max-width:95px;">
        //                     </td>

        //                     <!-- Text column -->
        //                     <td align="right" style="font-size:15px;color:#2e3b4e;padding-right:8px;">
        //                     <span style="font-weight:700;">The Most Trusted, Reliable & Innovative DMC for</span><br>
                 
        //                     <span style="display: block;width: 100%;"><ul style="text-transform:uppercase;display: inline-flex;margin:0px;">
        //                     <li style="padding-right: 18px;font-size: 12px;">Armenia</li>
        //                     <li style="color:#ed1e88;padding-right: 18px;font-size: 12px;">Kazakhstan</li>
        //                     <li style="color:#ec1f23;padding-right: 18px;font-size: 12px;">Azerbaijan</li>
        //                     <li style="color:#d0a600;padding-right: 18px;font-size: 12px;">Belarus</li>
        //                     <li style="color:#31448e;padding-right: 18px;font-size: 12px;">Georgia</li>
        //                     <li style="color:#1ca9c9;font-size: 12px;">Uzbekistan</li>
        //                     </ul></span>
                            
        //                     </td>
        //                 </tr>
        //             </table>
                    
        //             <table style="width:100%;">
        //             <br>
        //                 <tr><td colspan="12" align="left">Dear Mr/Mrs '.$this->input->post('agent_name').',</td></tr>
                       
        //                 <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
        //                 <tr><td colspan="12" align="left">Please find given below Commercial Proposal of '.$this->input->post('arrival_city').' ('.$country.')_<b>No of pax('.$total_persons.')</b>__ For <b>'.$enquiry->number_of_nights.'N</b>/<b>'.($enquiry->number_of_nights+1).'D</b></td></tr>

        //                 <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:red;">With Hotel</label>':'<label style="color:red;">Without Hotel</label>').')</td></tr>
        //                 <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
        //                 <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
        //                 <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
        //                 <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
        //                 <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
        //                 <tr><td colspan="12" align="left">'.$activities_html.'</td></tr>
        //                 <br><br>
        //                 <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;"  align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">EXCLUSIONS:</span>
        //                 <br>
        //                 '.$this->input->post('exclusions').'
                            
        //                 </td>  
                        
        //                 </tr>
                        
                        
                        
        //                  <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;" align="left">
        //                     <span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px; display:inline-block;">IMPORTANT NOTES:</span><br>
        //                     <div style="padding-left:24px;margin-top:5px;">
        //                         <div style="color:red;">1. Above quote is valid for 72 hrs</div>
        //                         <div style="color:red;">2. Above quote is subject to currency fluctuation</div>
        //                         <div style="color:red;">3. Today\'s ROE 1U$ = '.$currency->currency_abbr.' '. ($roe ? $roe : $currency->country_currency_value).' Tenge</div>
        //                         <div style="color:red;">4. We encourage our partners to conduct due diligence and review hotel feedback online before making any bookings.</div>
        //                     </div>
        //                     '.$this->input->post('important_notes').'
        //                 </td></tr>
        //                 <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;" align="left">
                        
                            
        //                 <span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">CANCELLATION POLICY:</span><br>
        //                 <div style="padding-left: 20px;">'.$this->input->post('cancellation_policy').'</div>
        //                 </td></tr>
                        
        //                 </table>

        //         </div>
        //     </body></html>';
        //     die();
                
        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => $email_subject,
            'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'to' => [ 
                [ 'name' => 'Sumeet Verma', 'email' => 'anant.thaver@gmail.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'back.office@kazindmc.com'],
                    // [ 'name' => 'Sumeet Verma', 'email' => 'rohit@kazindmc.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'pankaj@thavertech.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'mailus@thavertech.com'],
                    ],
            'htmlContent' => '<!DOCTYPE html><html><head>
        <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
                <style>
                    th, td {
                      
                        
                    }
                   
                        .title {

            background-color: #d6d8d9;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
   
        .flight-card {
            background-color: #fff;
            border: solid 1px #ccc;
            width: 100%;
          
            padding: 15px 24px;
        }
            .card-header {
            font-size: 16px;
            font-weight: 600;
            color: #2e3b4e;
            margin-bottom: 6px;
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .flight-row {
            margin-bottom: 4px;
            display: flex;
            justify-content: space-between;
        }
            .label {
            font-size: 12px;
            color: #778093;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .value {
            font-size: 14px;
            font-weight: 500;
            color: #2d3748;
        }
            .title>h4 {
            padding: 0;
            margin: 0;
            color: #000;
            text-decoration: none;
            text-transform: capitalize;
        }
   



        .col-one>span {
            font-size: 18px;
            color: #3c556e;
            font-weight: 500;
        }



        .inclusion-item {
            width: 100%;
                margin: 0 4px;
        }

 

        .box h4 {
            padding-left: 12px;
            padding-top: 12px;
        }

        .inclusion-item ul li {
            position: relative;
            color: #555555;
        }

        .inclusion-item ul li::before {
            position: absolute;
            color: #242424;
            left: -22px;
            font-size: 11px;
            top: 0;
        }
          .activites-item {
            background: #d6d8d9;
            display: flex;
            /* width: 33.33%; */
            padding: 8px 20px;
            margin-bottom: 6px;
        }
        .our-activites {
            display: flex;
        }
        .activites-item>div:nth-child(1) {
            width: 10%;
        }
        .activites-item>div:nth-child(2) {
            width: 6%;
        }
        .activites-item>div:nth-child(3) {
            width: 80%;
        }
        .our-activites>div {
            width: 33.33%;
        }
        .activites-item i {
            color: #6c6c6c;
        }
        .top-table+br{
                display: none !important;
        }
         .top-table+br+br{
                display: none !important;
        }
                </style>
            </head><body>
                <div class="table-container">
                    <table class="top-table" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#d6d8d9;">
                        <tr>
                            <!-- Logo column -->
                            <td align="left" style="">
                            <img src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="Logo" width="95" style="display:block; border:0; max-width:95px;">
                            </td>

                            <!-- Text column -->
                            <td align="right" style="font-size:15px;color:#2e3b4e;padding-right:8px;">
                            <span style="font-weight:700;">The Most Trusted, Reliable & Innovative DMC for</span><br>
                 
                            <span style="display: block;width: 100%;"><ul style="text-transform:uppercase;display: inline-flex;margin:0px;">
                            <li style="color:#ed1e88;padding-right: 18px;font-size: 12px;">Kazakhstan</li>
                            <li style="color:#31448e;padding-right: 18px;font-size: 12px;">Georgia</li>
                            <li style="color:#ec1f23;padding-right: 18px;font-size: 12px;">Azerbaijan</li>
                            <li style="color:#1ca9c9;padding-right: 18px;font-size: 12px;">Uzbekistan</li>
                            <li style="padding-right: 18px;font-size: 12px;color:#B85C38;">Armenia</li>
                            <li style="color:#d0a600;font-size: 12px;">Belarus</li>
                            </ul></span>
                            
                            </td>
                        </tr>
                    </table>
                    
                    <table style="width:100%;">
                    <br>
                        <tr><td colspan="12" align="left">Dear Mr/Mrs '.$this->input->post('agent_name').',</td></tr>
                       
                        <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                        <tr><td colspan="12" align="left">Please find given below Commercial Proposal of '.$this->input->post('arrival_city').' ('.$country.')_<b>No of pax('.$total_persons.')</b>__ For <b>'.$enquiry->number_of_nights.'N</b>/<b>'.($enquiry->number_of_nights+1).'D</b></td></tr>

                        <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:red;">With Hotel</label>':'<label style="color:red;">Without Hotel</label>').')</td></tr>
                        <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
                        <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
                        <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
                        <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
                        <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
                        <tr><td colspan="12" align="left">'.$activities_html.'</td></tr>
                        <br><br>
                        <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;"  align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">EXCLUSIONS:</span>
                        <br>
                        '.$this->input->post('exclusions').'
                            
                        </td>  
                        
                        </tr>
                        
                        
                        
                         <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;" align="left">
                            <span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px; display:inline-block;">IMPORTANT NOTES:</span><br>
                            <div style="padding-left:24px;margin-top:5px;">
                                <div style="color:red;">1. Above quote is valid for 72 hrs</div>
                                <div style="color:red;">2. Above quote is subject to currency fluctuation</div>
                                <div style="color:red;">3. Today\'s ROE 1U$ = '.$currency->currency_abbr.' '. ($roe ? $roe : $currency->country_currency_value).' Tenge</div>
                                <div style="color:red;">4. We encourage our partners to conduct due diligence and review hotel feedback online before making any bookings.</div>
                            </div>
                            '.$this->input->post('important_notes').'
                        </td></tr>
                        <tr><td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;" align="left">
                        
                            
                        <span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">CANCELLATION POLICY:</span><br>
                        <div style="padding-left: 20px;">'.$this->input->post('cancellation_policy').'</div>
                        </td></tr>
                        
                        </table>

                </div>
            </body></html>',
             /*'params' => ['bodyMessage' => '']*/
        ]);

        try {
            $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
            //print_r($sendinblue_response);
        } catch (Exception $e) {
            //echo $e->getMessage(),PHP_EOL;
        }
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
        echo json_encode($response);
        exit;		
    }     

    public function get_email_body()
    {
        $vehicless_json = $this->input->post('vehicless');
        $vehicless_arr = json_decode($vehicless_json, true);


        $postData = $this->input->post();
        $cnt = count($postData['itinerary_date']);

        if (empty($postData['enquiry_id'])) {
            show_error('Enquiry ID is required to generate email body.');
            return;
        }

        $data['form'] = $postData;
        $enquiry_id = $postData['enquiry_id'];

        $where = 'enquiry.id = "' . $this->db->escape_str($enquiry_id) . '"';
        $join = [
            [
                'type' => 'LEFT',
                'join_table' => 'company_details',
                'condition' => 'company_details.company_id = enquiry.company_details_id'
            ],
            [
                'type' => 'LEFT',
                'join_table' => 'company',
                'condition' => 'company.company_id = enquiry.company_id'
            ],
        ];

        $enquiryData = $this->common_model->get_data('enquiry', '', '', '*', $where, '', false, $join);
        if (empty($enquiryData)) {
            show_error('No enquiry found for ID ' . $enquiry_id);
            return;
        }

        $data['enquiry'] = $enquiryData[0];
        // print_r($data['enquiry'] = $enquiryData[0]);
        $total_persons = $data['enquiry']->number_persons + $data['enquiry']->number_child;
        $data['total_persons'] = $total_persons;

        // Get currency
        $char = substr($data['enquiry']->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;
        $where = 'currency_value.country = "' . strtolower($country[$char]) . '" AND currency_value.status = "active" Order by currency_value.id DESC';
        $currencyData = $this->common_model->get_data('currency_value', '', '', '*', $where, '', false);
        $currency = !empty($currencyData) ? $currencyData[0] : null;
        $data['currency'] = $currency;
        $data['country'] = $currencyData[0]->country;
        $activites = '';
        $only_itinerary_html = '
        <div class="text">
            <div class="itinerary-table">
                <div class="itinerary-header" style=" color: #fff; background-color: #d6d8d9; display: flex; padding: 10px;">
                    <div class="col-one" style="width: 13% !important;">
                        <b style="color:black;">Day</b>
                    </div>
                    <div class="col-two" style="border-left: solid 1px #8299b0;padding-left: 15px;width: 57% !important;">
                        <b style="color:black;">Activity</b>
                    </div>
                    <div class="col-three" style="border-left: solid 1px #8299b0; padding-left: 15px; width: 30% !important;">
                        <b style="color:black;">Remark</b>
                        <b style="display: inline-block; float: right; color:blue;">
                            <a style="color:blue;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">Click here for detailed itinerary.</a>
                        </b>
                    </div>
                </div>';

        $total_transportation_outside = 0;
        $total_transportation_inside = 0;
        $n = 0;
        $all_ticket_names=[];

        for ($i = 1; $i <= $cnt; $i++) {   
            $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;

            $only_itinerary_html .= '
                <div class="itinerary-item" style=" display: flex; padding: 8px 10px; border-bottom:dashed 1.6px #8299b070; align-items: center;">
                    <div class="col-one" style="width: 13% !important;">
                        <span style="font-size: 17px; color: #3c556e; font-weight: 500;">Day ' . $i . '</span>
                    </div>
                    <div class="col-two" style=" border-left: solid 1px #8299b0;padding-left: 15px;width: 57% !important;">
                        <ul style="margin: 0;padding: 0 13px !important;">';

            if ($cnt_text > 0) {
                for ($j = 0; $j < $cnt_text; $j++) {
                    // Skip first item if it's the last day
                    if ($i == $cnt && $j == 0) {
                        continue;
                    }
                    $ticket_name = $this->input->post('itinerary_entry_ticket_' . $i)[$j] ?? '';
                    if (!empty($ticket_name)) {
                        $all_ticket_names[] = $ticket_name;
                    }
                    $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') 
                        ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' 
                        : '';

                        $only_itinerary_html .= '<li>' . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';
                }

                if (!empty($this->input->post('itinerary_activities_'.$i))) {
                    foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
                        if ($activity != "") {
                            $activites .= '<li style="margin-left:0px;color:#555555;">' . $activity . '</li>';
                            $only_itinerary_html .= '<li style="margin-left:0px;">' . $activity . '</li>';
                        }
                    }
                }
            } else {
                // Show message when no itinerary
                $only_itinerary_html .= '<li><i>No Itinerary</i></li>';
            }
            $only_itinerary_html .= '
                        </ul>
                    </div>
                    <div class="col-two" style="border-left: solid 1px #8299b0; padding-left: 15px; width: 30% !important;">
                        <ul style="margin: 0;padding: 0 13px !important;">';
                         if ($i == $cnt) {
                            $only_itinerary_html .= '<li>Departure Souvenir Gift</li>';
                        } else {
                            $only_itinerary_html .= '<li >Free Wifi</li>';
                        }
                      $only_itinerary_html .= '</ul>
                        </div>
                </div>';

            $n++;

            if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
                $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
            }

            if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
                $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
            }
        }

        $only_itinerary_html .= '
            </div>
            </div>';

        $data['only_itinerary_html'] = $only_itinerary_html;
        $data['activites'] = $activites;
        $data['itinerary_entry_ticket'] = $all_ticket_names;
        $total_transportation = isset($postData['final_transport']) ? (float)$postData['final_transport'] : 0;
        $guide_grand_total = isset($postData['hdn_guide_grand_total']) ? (float)$postData['hdn_guide_grand_total'] : 0;
        $mandatory_grand_total = isset($postData['hdn_mandatory_grand_total']) ? (float)$postData['hdn_mandatory_grand_total'] : 0;
        $all_day_activities_total = isset($postData['all_day_activities_total']) ? (float)$postData['all_day_activities_total'] : 0;
        $final_ticket_price = isset($postData['hdn_final_ticket_price']) ? (float)$postData['hdn_final_ticket_price'] : 0;
        $final_toll_price = isset($postData['final_toll_price']) ? (float)$postData['final_toll_price'] : 0;
        $grandTotalMeal = isset($postData['grandTotalMeal']) ? $postData['grandTotalMeal'] : 0;
        
        $meal_type_daywise_price = isset($postData['meal_type_daywise_price']) ? $postData['meal_type_daywise_price'] :'';
                
        // Hotel related data
        $hotel_names_category_wise = isset($postData['hotel_names_category_wise']) ? json_decode($postData['hotel_names_category_wise'], true) : [];
        $hotel_costing_category_wise = isset($postData['hotel_costing_category_wise']) ? json_decode($postData['hotel_costing_category_wise'], true) : [];
        $hotel_room_category_names_wise = isset($postData['hotel_room_category_names_wise']) ? json_decode($postData['hotel_room_category_names_wise'], true) : [];

        $markup_percentage = isset($postData['markup_percentage']) ? (float)$postData['markup_percentage'] : 0;
        $hotel_markup_percentage = isset($postData['hotel_markup_percentage']) ? $postData['hotel_markup_percentage'] : '';


        $group_type = isset($postData['hdn_group_type']) ? $postData['hdn_group_type'] : 'individual';

        $cost_html = '';
        $nights = isset($postData['hotel_nights']) ? (int)$postData['hotel_nights'] : 0;

        // === FAMILY GROUP TYPE ===
        if ($group_type == 'family') {
            $cost_html .= $this->generate_family_cost_table(
                $hotel_names_category_wise,
                $hotel_costing_category_wise,
                $hotel_room_category_names_wise,
                $total_persons,
                $total_transportation,
                $guide_grand_total,
                $mandatory_grand_total,
                $all_day_activities_total,
                $final_ticket_price,
                $markup_percentage,
                $currency,
                $nights,
                $hotel_markup_percentage,
                $grandTotalMeal
            );
        }
        // === INDIVIDUAL GROUP TYPE ===
        else {
            $cost_html .= $this->generate_individual_cost_table(
                $hotel_costing_category_wise,
                $total_persons,
                $total_transportation,
                $guide_grand_total,
                $mandatory_grand_total,
                $all_day_activities_total,
                $final_ticket_price,
                $markup_percentage,
                $currency,
                $nights,
                $hotel_markup_percentage,
                $grandTotalMeal
            );
        }
        
        $vehicles_with_name = [];

        if (!empty($vehicless_arr)) {
            foreach ($vehicless_arr as $veh) {
                $vehicle_id = $veh['vehicle_id'];
                $qnty = $veh['qnty'];

                if (!empty($vehicle_id)) {
                    $query = $this->db->select('vehicle_name')
                                    ->from('transportation')
                                    ->where('id', $vehicle_id)
                                    ->get();

                    if ($query && $query->num_rows() > 0) {
                        $vehicle = $query->row();
                        $vehicles_with_name[] = [
                            $vehicle_name = $vehicle->vehicle_name,
                        ];
                    } else {
                        // Fallback if vehicle not found
                        $vehicles_with_name[] = [
                            $vehicle_name ='',
                        ];
                    }
                }
            }
        }

        // Now $vehicles_with_name contains vehicle names and quantities
        foreach ($vehicles_with_name as $v) {
               
            $data['vehicle_name']=$vehicle_name;
        }


        $data['cost_html'] = $cost_html;

        $data['postData'] = $postData;

        // Load the email body view
        $this->load->view('admin/email_body', $data);
    }

    // private function generate_family_cost_table($hotel_names_category_wise, $hotel_costing_category_wise, $hotel_room_category_names_wise, $total_persons, $total_transportation, $guide_grand_total, $hdn_mandatory_grand_total, $all_day_activities_total, $hdn_final_ticket_price, $markup_percentage, $currency, $nights)
    // {
    //     $cost_html = '';
    //     $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';

    //     $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
    //     foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //         $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
    //         $colspan = max(count($hotels), 1); 
    //         $rating_display = ucwords(str_replace('_', ' ', $rating_key));

    //         $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
    //     }
    //     $cost_html .= '</tr>';

    //     $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
    //     foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //         foreach ($hotels as $hotelId => $hotelData) {
    //             $hotel_name = $hotelData['hotel_name'] ?? '-';
    //             $nights = isset($hotelData['nights']) ? ' (' . $hotelData['nights'] . 'N)' : '';
    //             $cost_html .= '<td style="background-color: #d6d8d9;font-weight:bold;color:#6060a9;">' . $hotel_name . $nights . '</td>';
    //         }
    //     }
    //     $cost_html .= '</tr>';
    //     $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
    //     foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //         foreach ($hotels as $hotelId => $hotelName) {
    //             $room_categories = $hotel_room_category_names_wise[$rating_key][$hotelId] ?? [];
    //             if (!empty($room_categories)) {
    //                 $cost_html .= '<td style="background-color: #d6d8d9;">' . implode('<br>', $room_categories) . '</td>';
    //             } else {
    //                 $cost_html .= '<td style="background-color: #d6d8d9;">-</td>';
    //             }
    //         }
    //     }
    //     $cost_html .= '</tr>';
    //     $label = ($nights == '') ? "Cost Per Person" : "Hotel Cost Per Person";
    //     $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
    //     // $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
    //     foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //         foreach ($hotels as $hotelId => $hotelName) {
    //             $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;
    //             if($nights =='')
    //             {
    //                 $grand_total = $total_transportation + $hotel_cost + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price ;
    //             }
    //             else{
    //                 $grand_total = $hotel_cost;
    //             }
                
    //             $markup_percentage = floatval($this->input->post('markup_percentage'));
    //             $grand_total += ($grand_total * ($markup_percentage / 100));

    //             $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
    //                 ? round(($grand_total / $total_persons) / $currency->country_currency_value)
    //                 : 0;

    //             $cost_html .= '<td style="background-color: #d6d8d9;">$' . $per_person_cost . '</td>';
    //         }
    //     }
    //     $cost_html .= '</tr>';
    //     if($nights !='')
    //     {
    //         $total_cols = 0;
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotelData) {
    //                 if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
    //                     $total_cols++;
    //                 }
    //             }
    //         }
    //         $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price ;
    //         $markup_percentage = floatval($this->input->post('markup_percentage'));
    //         $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
    //         $converted_other = ($currency->country_currency_value > 0) 
    //             ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
    //             : 0;
    //         $cost_html .= '<tr>
    //             <th style="background-color:#d6d8d9;">Other Cost Per Person</th>
    //             <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
    //         </tr>';

    //     }
    //     $cost_html .= '</table>';

    //     if ($nights != '') 
    //     {
    //         $grouped_combos = [];

    //         // Group hotels by city per rating
    //         $hotels_by_city = [];
    //         foreach ($hotel_names_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_id => $hotelData) {
    //                 $city = $hotelData['hotel_city'] ?? 'Unknown';
    //                 $hotels_by_city[$rating_key][$city][] = [
    //                     'id' => $hotel_id,
    //                     'name' => $hotelData['hotel_name'],
    //                     'nights' => $hotelData['nights'] ?? 0,
    //                     'cost' => $hotel_costing_category_wise[$rating_key][$hotel_id] ?? 0
    //                 ];
    //             }
    //         }

    //         // Create combos
    //         foreach ($hotels_by_city as $rating_key => $cities) {
    //             $city_lists = array_values($cities); 
    //             $max_count = max(array_map('count', $city_lists));

    //             for ($i = 0; $i < $max_count; $i++) {
    //                 $combo = [];
    //                 foreach ($city_lists as $city_hotels) {
    //                     $hotel = $city_hotels[$i] ?? $city_hotels[0]; 
    //                     $combo[] = $hotel;
    //                 }

    //                 $group_name_parts = [];
    //                 $total_hotel_cost = 0;

    //                 foreach ($combo as $hotel) {
    //                     $group_name_parts[] = $hotel['name'] . " (" . $hotel['nights'] . "N)";

    //                     // Use hotel cost as-is (already for all nights)
    //                     $hotel_cost = $hotel['cost'] ?? 0;

    //                     // Convert to per-person
    //                     $per_person = ($total_persons > 0 && $currency->country_currency_value > 0)
    //                         ? round($hotel_cost / $total_persons / $currency->country_currency_value)
    //                         : 0;

    //                     // Apply markup once
    //                     $markup_percentage = floatval($this->input->post('markup_percentage'));
    //                     $per_person += round($per_person * ($markup_percentage / 100));

    //                     $total_hotel_cost += $per_person;
    //                 }

    //                 // Add other per-person costs
    //                 $package_total_per_person = $total_hotel_cost + $converted_other;

    //                 $group_name = implode(" + ", $group_name_parts);
    //                 $grouped_combos[$rating_key][$group_name] = $package_total_per_person;
    //             }
    //         }

    //         // Step 3: Render Package Cost Table
    //         $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
    //         $cost_html .= '<tr><th style="background-color:#d6d8d9;">Package Cost With Hotel</th></tr>';

    //         foreach ($grouped_combos as $rating => $combos) {
    //             // $cost_html .= '<tr><th colspan="'.count($combos).'" style="background-color:#d6d8d9;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';
    //             $cost_html .= '<tr>';
    //             foreach ($combos as $group_name => $total_cost) {
    //                 $cost_html .= '<td style="background-color:#d6d8d9;color:#6060a9;">'.$group_name.'</td>';
    //             }
    //             $cost_html .= '</tr><tr>';
    //             foreach ($combos as $group_name => $total_cost) {
    //                 $cost_html .= '<td style="background-color:#d6d8d9;">$'.$total_cost.'</td>';
    //             }
    //             $cost_html .= '</tr>';
    //         }

    //         $cost_html .= '</table>';
    //     }

    //     return $cost_html;
    // }

    // private function generate_individual_cost_table($hotel_costing_category_wise, $total_persons, $total_transportation, $guide_grand_total, $hdn_mandatory_grand_total, $all_day_activities_total, $hdn_final_ticket_price, $markup_percentage, $currency, $nights)
    // {
    //     $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price;
         
    //         $grand_total_pp = $grand_total / $total_persons;
    //         $cost_html = '';

    //         $cost_html .= '<table class="rating-table" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:100%; text-align: center;">';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             $colspan = 0;
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                      if (is_array($occupancies)) {
    //                         $colspan += count($occupancies); 
    //                      }
    //                 }
    //             }
    //             $rating_display = ucwords(str_replace('_', ' ', $rating_key));
    //             $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
    //         }
    //         $cost_html .= '</tr>';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) { 
    //                 $occ_count = 0;
    //                 foreach ($categories as $cat => $occupancies) {
    //                 if ($cat === "nights") continue;
    //                     if (is_array($occupancies)) {
    //                         $occ_count += count($occupancies);
    //                     }
    //                 }

    //                 $nights = isset($categories['nights']) ? $categories['nights'] : 0;
    //                 $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
    //                 $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #d6d8d9; font-weight:bold;color:#6060a9;">' . $hotel_display . '</td>';
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //       $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 $roomCats = [];
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $roomCats[] = $cat;
    //                     }
    //                 }
    //                 $prev = null;
    //                 $span = 0;
    //                 foreach ($roomCats as $i => $cat) {
    //                     if ($cat === $prev) {
    //                         $span++;
    //                     } else {
    //                         if ($prev !== null) {
    //                             $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
    //                             $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
    //                         }
    //                         $prev = $cat;
    //                         $span = 1;
    //                     }
    //                 }
    //                 if ($prev !== null) {
    //                     $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
    //                     $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Occupancy</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $occ_arr = explode('__', $occ);
    //                         $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
    //                         $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
    //                         $occupancy_type = trim($occupancy_type);
    //                         // $cost_html .= '<td style="background-color: #d6d8d9;">' . $occupancy_type . '</td>';
    //                         if(($occupancy_type) == 'Double'){
    //                             $occupancy_type = 'Double/Twin';
    //                             $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
    //                         }else{
    //                             $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         $label = ($nights == 0) ? "Cost Per Person" : "Hotel Cost Per Person";
    //         $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
    //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //             foreach ($hotels as $hotel_name => $categories) {
    //                 foreach ($categories as $cat => $occupancies) {
    //                     if (!is_array($occupancies)) continue;
    //                     foreach ($occupancies as $occ) {
    //                         $occ_arr = explode('__', $occ);
    //                         $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

    //                         if ($nights == 0) {
    //                             $cost_with_total = $occupancy_cost + $grand_total_pp;
    //                         } else {
    //                             $cost_with_total = $occupancy_cost;
    //                         }
    //                         $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

    //                         $cost_html .= '<td style="background-color: #d6d8d9;">$' . $converted . '</td>';
    //                     }
    //                 }
    //             }
    //         }
    //         $cost_html .= '</tr>';
    //         if ($nights != 0) {
    //             $total_cols = 0;
    //             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotel_name => $categories) {
    //                     foreach ($categories as $cat => $occupancies) {
    //                         if (is_array($occupancies)) {
    //                             $total_cols += count($occupancies);
    //                         }
    //                     }
    //                 }
    //             }
    //             $converted_other = ($currency->country_currency_value > 0) 
    //                 ? round($grand_total_pp / $currency->country_currency_value) 
    //                 : 0;
    //             $cost_html .= '<tr>
    //                 <th style="background-color:#d6d8d9;">Other Cost Per Person</th>
    //                 <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
    //             </tr>';
    //         }
    //         $cost_html .= '</table>';

    //       if ($nights != 0) {

    //             $hotels_by_city = [];
    //             foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
    //                 foreach ($hotels as $hotel_name => $categories) {
    //                     $city = $categories['hotel_city'] ?? 'Unknown';
    //                     $hotels_by_city[$rating_key][$city][] = [
    //                         'name' => $hotel_name,
    //                         'nights' => $categories['nights'],
    //                         'categories' => $categories
    //                     ];
    //                 }
    //             }

    //             $paired_combos = [];
    //             foreach ($hotels_by_city as $rating => $cities) {
    //                 $city_lists = array_values($cities); 
    //                 $max_count = max(array_map('count', $city_lists));

    //                 for ($i = 0; $i < $max_count; $i++) {
    //                     $combo = [];
    //                     foreach ($city_lists as $city_hotels) {
    //                         $hotel = $city_hotels[$i] ?? null;
    //                         if ($hotel) $combo[] = $hotel;
    //                     }
    //                     if (!empty($combo)) $paired_combos[$rating][] = $combo;
    //                 }
    //             }

    //             $all_occupancies = [];
    //             $grouped_combos = [];
    //             foreach ($paired_combos as $rating => $combos) {
    //                 foreach ($combos as $combo) {
    //                     // $group_name = implode(" + ", array_map(fn($h) => $h['name']." (".$h['categories']['hotel_city'].") ".$h['nights']."N", $combo));
    //                     $group_name = implode(" + ", array_map(fn($h) => $h['name']." ".$h['nights']."N", $combo));
    //                     $merged_costs = [];

    //                     foreach ($combo as $hotel) {
    //                         foreach ($hotel['categories'] as $cat => $occupancies) {
    //                             if (!is_array($occupancies)) continue;
    //                             foreach ($occupancies as $occ) {
    //                                 $occ_arr = explode('__', $occ);
    //                                 $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
    //                                 $occ_cost = floatval($occ_arr[1] ?? 0);
    //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
    //                                 $all_occupancies[$occ_type] = true;
    //                             }
    //                         }
    //                     }
                        
    //                     $grouped_combos[$rating][$group_name] = $merged_costs;
    //                 }
    //             }
    //             $total_cols = 0;
    //                     foreach ($grouped_combos as $rating => $combos) {
    //                         foreach ($combos as $group_name => $costs) {
    //                             $total_cols += count($costs);
    //                         }
    //                     }

    //             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:99%; text-align:center; margin:5px;">';
    //             $cost_html .= '<tr><th colspan="'.$total_cols.'" style="background-color:#d6d8d9;">Package Cost With Hotel</th></tr>';

    //             foreach ($grouped_combos as $rating => $combos) {
    //                 // $cost_html .= '<tr><th colspan="'.(count($combos)+1).'" style="background-color:#d6d8d9;">'.ucwords(str_replace("_"," ",$rating)).'</th></tr>';

    //                 $cost_html .= '<tr><th style="background-color:#d6d8d9;">Occupancy</th>';
    //                 foreach ($combos as $group_name => $costs) {
    //                     $cost_html .= '<th style="background-color:#d6d8d9;color:#6060a9 !important;">'.$group_name.'</th>';
    //                 }
    //                 $cost_html .= '</tr>';

    //                 foreach ($all_occupancies as $occ_type => $_) {
    //                     $cost_html .= '<tr><td style="font-weight:bold;">'.$occ_type.'</td>';
    //                     foreach ($combos as $costs) {
    //                         $occupancy_cost = isset($costs[$occ_type]) ? floatval($costs[$occ_type]) : 0;
    //                         $total_cost = $occupancy_cost + $grand_total_pp;
    //                         $converted = ($currency->country_currency_value > 0) 
    //                             ? round($total_cost / $currency->country_currency_value) 
    //                             : 0;
    //                         $cost_html .= '<td>$'.$converted.'</td>';
    //                     }
    //                     $cost_html .= '</tr>';
    //                 }
    //             }

    //             $cost_html .= '</table>';
    //         }

    //     return $cost_html;
    // }

    private function generate_family_cost_table($hotel_names_category_wise, $hotel_costing_category_wise, $hotel_room_category_names_wise, $total_persons, $total_transportation, $guide_grand_total, $hdn_mandatory_grand_total, $all_day_activities_total, $hdn_final_ticket_price, $markup_percentage, $currency, $nights, $hotel_markup_percentage, $grandTotalMeal)
    {
        // print_r($hotel_names_category_wise);
        $has_any_night = false;
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            foreach ($hotels as $hotelId => $hotelData) {
                if (!empty($hotelData['nights'])) {
                    // Check if any night > 0
                    $filtered_nights = array_filter($hotelData['nights'], fn($v) => $v > 0);
                    if (!empty($filtered_nights)) {
                        $has_any_night = true;
                        break 2; // exit both loops
                    }
                }
            }
        }
        $cost_html = '';
        if (!$has_any_night) {
        $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:100%; text-align: left;">';

        $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            $room_cat_list = $hotel_room_category_names_wise[$rating_key] ?? [];
            $colspan = max(count($hotels), 1); 
            $rating_display = ucwords(str_replace('_', ' ', $rating_key));

            $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
        }
        $cost_html .= '</tr>';

        $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            foreach ($hotels as $hotelId => $hotelData) {
                $hotel_name = $hotelData['hotel_name'] ?? '-';
                // $nights = isset($hotelData['nights']) ? ' (' . $hotelData['nights'] . 'N)' : '';
                $nights_value = '';
                if (!empty($hotelData['nights'])) {
                    $nights_value = is_array($hotelData['nights']) 
                        ? implode(',', array_filter($hotelData['nights'])) 
                        : $hotelData['nights'];
                        $nights = ' (' . $nights_value . ' N)';
                } else {
                    $nights = '';
                }
                
                $cost_html .= '<td style="background-color: #d6d8d9;font-weight:bold;color:#6060a9;">' . $hotel_name . $nights . '</td>';
            }
        }
        $cost_html .= '</tr>';
        $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            foreach ($hotels as $hotelId => $hotelName) {
                $room_categories = $hotel_room_category_names_wise[$rating_key][$hotelId] ?? [];
                if (!empty($room_categories)) {
                    $cost_html .= '<td style="background-color: #d6d8d9;">' . implode('<br>', $room_categories) . '</td>';
                } else {
                    $cost_html .= '<td style="background-color: #d6d8d9;">-</td>';
                }
            }
        }
        $cost_html .= '</tr>';
        $label = ($nights == '') ? "Cost Per Person" : "Hotel Cost Per Person";
        $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
        // $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
        foreach ($hotel_names_category_wise as $rating_key => $hotels) {
            foreach ($hotels as $hotelId => $hotelName) {
                $hotel_cost = $hotel_costing_category_wise[$rating_key][$hotelId] ?? 0;

                $markup_percentage = floatval($this->input->post('markup_percentage'));
                $hotel_markup_percentage = floatval($this->input->post('hotel_markup_percentage'));
                if(!empty($hotel_markup_percentage))
                {
                    $hotel_cost += ($hotel_cost * ($hotel_markup_percentage / 100));
                  
                }else{
                    $hotel_cost += ($hotel_cost * ($markup_percentage / 100));
                }

                if($nights =='')
                {
                    $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                    $grand_total += ($grand_total * ($markup_percentage / 100));
                   
                }
                else{
                    $grand_total = $hotel_cost;
                }
                
                // $markup_percentage = floatval($this->input->post('markup_percentage'));
                // $grand_total += ($grand_total * ($markup_percentage / 100));
                $grand_total_new = $hotel_cost;
                if(empty($hotel_markup_percentage))
                    {
                        $grand_total_new += $grand_total;
                    };
             

                $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
                    ? round(($grand_total_new / $total_persons) / $currency->country_currency_value)
                    : 0;

                $cost_html .= '<td style="background-color: #d6d8d9;">$' . $per_person_cost . '</td>';
            }
        }
        $cost_html .= '</tr>';
        if(!empty($hotel_markup_percentage))
        {
            $total_cols = 0;
            foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotelData) {
                    if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
                        $total_cols++;
                    }
                }
            }
            $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
            $markup_percentage = floatval($this->input->post('markup_percentage'));
            $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
            $converted_other = ($currency->country_currency_value > 0) 
                ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
                : 0;
            $cost_html .= '<tr>
                <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
            </tr>';

        }
        $cost_html .= '</table>';
        }   

        if ($has_any_night) {
            $markup_percentage = floatval($this->input->post('markup_percentage'));
            $packages = [];
            $package_index = 1;

            $all_available_nights = [];
            foreach ($hotel_names_category_wise as $rating => $hotels) {
                foreach ($hotels as $hotel_data) {
                    if (isset($hotel_data['nights']) && !empty($hotel_data['nights']) && is_array($hotel_data['nights'])) {
                        $all_available_nights = array_merge($all_available_nights, $hotel_data['nights']);
                    }
                }
            }
            $all_available_nights = array_unique($all_available_nights);
            sort($all_available_nights);
            
            $final_nights_order = [];
            if (in_array(0, $all_available_nights)) {
                $final_nights_order[] = 0; 
            }
            
            foreach ($all_available_nights as $night) {
                if ($night != 0) {
                    $final_nights_order[] = $night;
                }
            }
            
            $all_available_nights = $final_nights_order;

            $main_hotels = [];
            foreach ($hotel_names_category_wise as $rating => $hotels) {
                foreach ($hotels as $hotel_id => $hotel_data) {
                    if (!isset($hotel_data['nights']) || empty($hotel_data['nights'])) {
                        $hotel_data['nights'] = $all_available_nights;
                    }
                    
                    $available_nights_count = count($hotel_data['nights']);
                    if ($available_nights_count >= 2) {
                        $main_hotels[] = [
                            'hotel_id' => $hotel_id,
                            'hotel_data' => $hotel_data,
                            'rating' => $rating
                        ];
                    }
                }
            }

            $package_signatures = [];
            $used_fallback_hotels = []; 

            foreach ($main_hotels as $main_hotel_info) {
                $hotel_id = $main_hotel_info['hotel_id'];
                $hotel_data = $main_hotel_info['hotel_data'];
                $rating = $main_hotel_info['rating'];

                $total_hotel_cost = floatval($hotel_costing_category_wise[$rating][$hotel_id] ?? 0);
                
                $nights_array = isset($hotel_data['nights']) ? $hotel_data['nights'] : $all_available_nights;
                $nights_count = count($nights_array);
                $per_night_cost = $total_hotel_cost / max($nights_count, 1);

                $package_hotels = [];
                $total_package_cost = 0;
                $fallback_hotels_used = [];
                $hotel_markup_percentage = floatval($this->input->post('hotel_markup_percentage'));
                foreach ($all_available_nights as $night_no) {
                    if (in_array($night_no, $nights_array)) 
                        {
                        $per_person = ($total_persons > 0 && $currency->country_currency_value > 0)
                            ? ($per_night_cost / $total_persons) / $currency->country_currency_value
                            : 0;
                        // $per_person += $per_person * ($markup_percentage / 100);
                        
                        if(!empty($hotel_markup_percentage))
                        {
                            $per_person += ($per_person * ($hotel_markup_percentage / 100));
                        
                        }else{
                            $per_person += ($per_person * ($markup_percentage / 100));
                        }

                        $package_hotels[] = [
                            'name' => $hotel_data['hotel_name'],
                            'rating' => $rating,
                            'night' => $night_no,
                            'cost_per_person' => round($per_person),
                            'type' => 'same_hotel'
                        ];
                        
                        $total_package_cost += $per_person;
                    } else {
                        $fallback_hotel = $this->findFallbackHotel($hotel_names_category_wise, $hotel_costing_category_wise, $night_no, $rating, $hotel_data['hotel_name'], $total_persons, $currency, $markup_percentage, $used_fallback_hotels, $hotel_markup_percentage);
                        
                        $package_hotels[] = $fallback_hotel;
                        $total_package_cost += $fallback_hotel['cost_per_person'];
                        
                        if ($fallback_hotel['type'] != 'same_hotel') {
                            $fallback_hotels_used[] = $fallback_hotel['name'];
                        }
                    }
                }

                $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                $grand_total_other += $grand_total_other * ($markup_percentage / 100);
                $converted_other = ($currency->country_currency_value > 0)
                    ? round(($grand_total_other / $total_persons) / $currency->country_currency_value, 2)
                    : 0;

                // $total_package_cost += $converted_other;
                 if(empty($hotel_markup_percentage)) {
                    $total_package_cost += $converted_other;
                }


                $fallback_signature = implode('|', array_unique($fallback_hotels_used));
                $package_signature = $hotel_data['hotel_name'] . "|" . $fallback_signature;

                if (!in_array($package_signature, $package_signatures)) {
                    $package_signatures[] = $package_signature;
                    
                    $packages[] = [
                        'name' => 'Package ' . $package_index++,
                        'primary_rating' => $rating,
                        'main_hotel' => $hotel_data['hotel_name'],
                        'fallback_hotels' => array_unique($fallback_hotels_used),
                        'hotels' => $package_hotels,
                        'total_cost' => round($total_package_cost)
                    ];
                }
            }
            
            // 🔹 Merge same hotel nights within each package
            foreach ($packages as &$pkg) {
                $merged_hotels = [];
                foreach ($pkg['hotels'] as $hotel) {
                    $key = $hotel['name'] . '_' . $hotel['rating'];
                    if (!isset($merged_hotels[$key])) {
                        $merged_hotels[$key] = [
                            'name' => $hotel['name'],
                            'rating' => $hotel['rating'],
                            'nights' => [],
                            'cost_per_person' => $hotel['cost_per_person'],
                            'type' => $hotel['type']
                        ];
                    }
                    $merged_hotels[$key]['nights'][] = $hotel['night'];
                }

                foreach ($merged_hotels as &$h) {
                    sort($h['nights']);
                    $unique_nights = array_unique($h['nights']);
                    $formatted_nights = array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $unique_nights);

                    $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
                    if (in_array(0, $unique_nights)) {
                        $total_nights += 1; // count early check-in as 1N
                    }

                    $h['night'] = $total_nights ;
                }

                $pkg['hotels'] = array_values($merged_hotels);
            }
            unset($pkg);
            
            if (!empty($packages)) {
                $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
                $cost_html .= '<tr style="background-color: #d6d8d9; font-weight:bold;">
                    <th>Package</th>
                    <th>Hotel</th>
                    <th>Rating</th>
                    <th>No. of Nights</th>';
                    if (!empty($hotel_markup_percentage)) {
                            $cost_html .= '<th>Cost Per Person / Night</th>';
                        } else {
                            $cost_html .= '<th>Cost Per Person</th>';
                        }
                $cost_html .='</tr>';
                // usort($packages, function($a, $b) {
                //     return $a['total_cost'] <=> $b['total_cost'];
                // });
                foreach ($packages as $pkg) {
                    $rowspan = count($pkg['hotels']);
                    $first_row = true;

                    foreach ($pkg['hotels'] as $index => $hotel) {
                        $cost_html .= '<tr>';
                        if ($first_row) {
                            $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
                            $first_row = false;
                        }
                        
                        $hotel_bg_color = ($hotel['type'] == 'same_hotel') ? '#d6d8d9' : '#d6d8d9';
                        $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: ' . $hotel_bg_color . ';">' . $hotel['name'] . '</td>';
                        $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . str_replace('_', ' ', $hotel['rating']) . '</td>';
                        
                        // if ($hotel['night'] == 0) {
                        //     $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">Early Check-in</td>';
                        // } else {
                        //     $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . $hotel['night'] . ' N</td>';
                        // }
                        $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">' . $hotel['night'] . '</td>';
                        
                        if(!empty($hotel_markup_percentage))
                        {
                            $cost_html .= '<td style="background-color: ' . $hotel_bg_color . ';">$' . $hotel['cost_per_person'] . '</td>';
                        }else
                        {
                            if ($index === 0) {
                                $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9; font-weight:bold;">$' . number_format($pkg['total_cost']) . '</td>';
                            }
                        }
                        $cost_html .= '</tr>';
                    }
                }
                if(!empty($hotel_markup_percentage))
                {
                    $total_cols = 0;
                    foreach ($hotel_names_category_wise as $rating_key => $hotels) {
                        foreach ($hotels as $hotelData) {
                            if (isset($hotelData['nights']) && $hotelData['nights'] > 0) {
                                $total_cols++;
                            }
                        }
                    }
                    $grand_total_other = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
                    $markup_percentage = floatval($this->input->post('markup_percentage'));
                    $grand_total_other += ($grand_total_other * ($markup_percentage / 100));
                    $converted_other = ($currency->country_currency_value > 0) 
                        ? round(($grand_total_other / $total_persons) / $currency->country_currency_value) 
                        : 0;
                    $cost_html .= '<tr>
                        <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                        <td colspan="4" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                    </tr>';

                }

                $cost_html .= '</table>';
            }
        }
        return $cost_html;
    }

    private function findFallbackHotel($hotel_names_category_wise, $hotel_costing_category_wise, $night_no, $preferred_rating, $main_hotel_name, $total_persons, $currency, $markup_percentage, &$used_fallback_hotels = [], $hotel_markup_percentage)
    {
        // Step 1: Pehle same rating mein available hotels collect karo (excluding main hotel and NA)
        $same_rating_hotels = [];
        foreach ($hotel_names_category_wise[$preferred_rating] ?? [] as $hotel_id => $hotel_data) {
            // Check if nights array exists
            $has_nights = isset($hotel_data['nights']) && is_array($hotel_data['nights']);
            $is_available = $has_nights && in_array($night_no, $hotel_data['nights']);
            
            if ($hotel_data['hotel_name'] != $main_hotel_name && 
                $hotel_data['hotel_name'] != 'NA' && 
                !in_array($hotel_data['hotel_name'], $used_fallback_hotels) &&
                $is_available) {
                $same_rating_hotels[] = [
                    'hotel_id' => $hotel_id,
                    'hotel_data' => $hotel_data,
                    'rating' => $preferred_rating,
                    'cost' => $hotel_costing_category_wise[$preferred_rating][$hotel_id] ?? 0
                ];
            }
        }
        
        if (!empty($same_rating_hotels)) {
            usort($same_rating_hotels, function($a, $b) {
                return $a['cost'] <=> $b['cost'];
            });
            
            $selected_hotel = $same_rating_hotels[0];
            $used_fallback_hotels[] = $selected_hotel['hotel_data']['hotel_name'];
            
            return $this->calculateHotelCost($selected_hotel, $night_no, $total_persons, $currency, $markup_percentage, 'same_rating_fallback', $hotel_markup_percentage);
        }

        // Step 2: Same rating mein hotels check karo (used hotels allow karo)
        $same_rating_all_hotels = [];
        foreach ($hotel_names_category_wise[$preferred_rating] ?? [] as $hotel_id => $hotel_data) {
            // Check if nights array exists - CORRECTION ADDED HERE
            $has_nights = isset($hotel_data['nights']) && is_array($hotel_data['nights']);
            $is_available = $has_nights && in_array($night_no, $hotel_data['nights']);
            
            if ($hotel_data['hotel_name'] != $main_hotel_name && 
                $hotel_data['hotel_name'] != 'NA' &&
                $is_available) { // CORRECTION: $is_available use karo
                $same_rating_all_hotels[] = [
                    'hotel_id' => $hotel_id,
                    'hotel_data' => $hotel_data,
                    'rating' => $preferred_rating,
                    'cost' => $hotel_costing_category_wise[$preferred_rating][$hotel_id] ?? 0,
                    'already_used' => in_array($hotel_data['hotel_name'], $used_fallback_hotels)
                ];
            }
        }
        
        if (!empty($same_rating_all_hotels)) {
            usort($same_rating_all_hotels, function($a, $b) {
                if ($a['already_used'] != $b['already_used']) {
                    return $a['already_used'] ? 1 : -1;
                }
                return $a['cost'] <=> $b['cost'];
            });
            
            $selected_hotel = $same_rating_all_hotels[0];
            
            if (!$selected_hotel['already_used']) {
                $used_fallback_hotels[] = $selected_hotel['hotel_data']['hotel_name'];
            }
            
            return $this->calculateHotelCost($selected_hotel, $night_no, $total_persons, $currency, $markup_percentage, 'same_rating_used_fallback', $hotel_markup_percentage);
        }

        // Step 3: Dusri ratings check karo
        $other_rating_hotels = [];
        foreach ($hotel_names_category_wise as $rating => $hotels) {
            if ($rating == $preferred_rating) continue;
            
            foreach ($hotels as $hotel_id => $hotel_data) {
                // Agar hotel mein nights array nahi hai, toh assume karo ki sabhi nights ke liye available hai
                $has_nights = isset($hotel_data['nights']) && is_array($hotel_data['nights']);
                $is_available = !$has_nights || in_array($night_no, $hotel_data['nights']);
                
                // NA ko exclude karo, lekin used hotels allow karo
                if ($hotel_data['hotel_name'] != 'NA' && 
                    $is_available) {
                    $other_rating_hotels[] = [
                        'hotel_id' => $hotel_id,
                        'hotel_data' => $hotel_data,
                        'rating' => $rating,
                        'cost' => $hotel_costing_category_wise[$rating][$hotel_id] ?? 0,
                        'already_used' => in_array($hotel_data['hotel_name'], $used_fallback_hotels)
                    ];
                }
            }
        }
        
        // Step 4: Dusri rating mein mil gaya, toh use karo
        if (!empty($other_rating_hotels)) {
            // Pehle unused hotels, phir used hotels (cheapest first)
            usort($other_rating_hotels, function($a, $b) {
                // Pehle unused hotels
                if ($a['already_used'] != $b['already_used']) {
                    return $a['already_used'] ? 1 : -1;
                }
                // Phir cost ke hisaab se
                return $a['cost'] <=> $b['cost'];
            });
            
            $selected_hotel = $other_rating_hotels[0];
            
            // Used hotels mein add karo (agar pehle se used nahi hai)
            if (!$selected_hotel['already_used']) {
                $used_fallback_hotels[] = $selected_hotel['hotel_data']['hotel_name'];
            }
            
            return $this->calculateHotelCost($selected_hotel, $night_no, $total_persons, $currency, $markup_percentage, 'different_rating_fallback', $hotel_markup_percentage);
        }

        // Step 5: Same rating mein NA available hai, toh NA use karo
        $na_hotels = [];
        foreach ($hotel_names_category_wise[$preferred_rating] ?? [] as $hotel_id => $hotel_data) {
            // Check if nights array exists
            $has_nights = isset($hotel_data['nights']) && is_array($hotel_data['nights']);
            $is_available = $has_nights && in_array($night_no, $hotel_data['nights']);
            
            if ($hotel_data['hotel_name'] == 'NA' && $is_available) {
                $na_hotels[] = [
                    'hotel_id' => $hotel_id,
                    'hotel_data' => $hotel_data,
                    'rating' => $preferred_rating,
                    'cost' => $hotel_costing_category_wise[$preferred_rating][$hotel_id] ?? 0
                ];
            }
        }
        
        if (!empty($na_hotels)) {
            $selected_hotel = $na_hotels[0];
            return $this->calculateHotelCost($selected_hotel, $night_no, $total_persons, $currency, $markup_percentage, 'na_fallback', $hotel_markup_percentage);
        }

        // Step 6: Koi bhi hotel nahi mila
        return [
            'name' => 'N/A',
            'rating' => 'No Hotel',
            'night' => $night_no,
            'cost_per_person' => 0,
            'type' => 'not_available'
        ];
    }

    // Helper function to calculate hotel cost - CORRECTION ADDED FOR HOTELS WITHOUT NIGHTS ARRAY
    private function calculateHotelCost($hotel_info, $night_no, $total_persons, $currency, $markup_percentage, $type, $hotel_markup_percentage)
    {
        $hotel_id = $hotel_info['hotel_id'];
        $hotel_data = $hotel_info['hotel_data'];
        $rating = $hotel_info['rating'];
        $total_hotel_cost = $hotel_info['cost'];
        
        // CORRECTION: Agar nights array nahi hai, toh 1 night assume karo
        $nights_count = isset($hotel_data['nights']) && is_array($hotel_data['nights']) ? count($hotel_data['nights']) : 1;
        $per_night_cost = $total_hotel_cost / max($nights_count, 1);
        
        $per_person = ($total_persons > 0 && $currency->country_currency_value > 0)
            ? ($per_night_cost / $total_persons) / $currency->country_currency_value
            : 0;
        // $per_person += $per_person * ($markup_percentage / 100);
        if(!empty($hotel_markup_percentage))
        {
            $per_person += ($per_person * ($hotel_markup_percentage / 100));   
        }else{
            $per_person += ($per_person * ($markup_percentage / 100));
        }

        return [
            'name' => $hotel_data['hotel_name'],
            'rating' => $rating,
            'night' => $night_no,
            'cost_per_person' => round($per_person),
            'type' => $type
        ];
    }
    
    private function generate_individual_cost_table($hotel_costing_category_wise, $total_persons, $total_transportation, $guide_grand_total, $hdn_mandatory_grand_total, $all_day_activities_total, $hdn_final_ticket_price, $markup_percentage, $currency, $nights, $hotel_markup_percentage, $grandTotalMeal)
    {
        $grand_total = $total_transportation + $guide_grand_total + $all_day_activities_total + $hdn_mandatory_grand_total + $hdn_final_ticket_price + $grandTotalMeal;
        $grand_total_pp = $grand_total / $total_persons;
        $grand_total_pp += ($grand_total_pp * ($markup_percentage / 100));

            $cost_html = '';
            $has_valid_nights = false;
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    if (!empty($categories['nights'])) {
                        $filtered_nights = array_filter($categories['nights'], fn($v) => $v != 0);
                        if (count($filtered_nights) > 0) {
                            $has_valid_nights = true;
                            break 2; // exit both loops
                        }
                    }
                }
            }
        if (!$has_valid_nights) {
            $cost_html .= '<table class="rating-table" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:100%; text-align: left;">';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Rating</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                $colspan = 0;
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                         if (is_array($occupancies)) {
                            $colspan += count($occupancies); 
                         }
                    }
                }
                $rating_display = ucwords(str_replace('_', ' ', $rating_key));
                $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d6d8d9;">' . $rating_display . '</th>';
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Hotel</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) { 
                    $occ_count = 0;
                    foreach ($categories as $cat => $occupancies) {
                    if ($cat === "nights") continue;
                        if (is_array($occupancies)) {
                            $occ_count += count($occupancies);
                        }
                    }

                    $nights = isset($categories['nights']) ? $categories['nights'] : 0;
                
                    if (is_array($nights)) {
                        $filtered_nights = array_filter($nights, function($v) {
                            return $v != 0; // remove any 0 entries
                        });
                        $night_count = count($filtered_nights);
                    } else {
                        $night_count = (int)$nights;
                    }
                    $hotel_display = $hotel_name . ($nights ? " ({$night_count}N)" : "");
                    $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #d6d8d9; font-weight:bold;color:#6060a9;">' . $hotel_display . '</td>';
                }
            }
            $cost_html .= '</tr>';
           $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Category</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    $roomCats = [];
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $roomCats[] = $cat;
                        }
                    }
                    $prev = null;
                    $span = 0;
                    foreach ($roomCats as $i => $cat) {
                        if ($cat === $prev) {
                            $span++;
                        } else {
                            if ($prev !== null) {
                                $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                                $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
                            }
                            $prev = $cat;
                            $span = 1;
                        }
                    }
                    if ($prev !== null) {
                        $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                        $cost_html .= '<td'.$colspan.' style="background-color: #d6d8d9;">'.$prev.'</td>';
                    }
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">Room Occupancy</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
                            $occupancy_type = str_ireplace("Occupancy", "", $occupancy_type);
                            $occupancy_type = trim($occupancy_type);
                            // $cost_html .= '<td style="background-color: #d6d8d9;">' . $occupancy_type . '</td>';
                            if(($occupancy_type) == 'Double'){
                                $occupancy_type = 'Double/Twin';
                                $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
                            }else{
                                $cost_html .= '<td style="background-color: #d6d8d9;"><b>' . $occupancy_type . '</b></td>';
                            }
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            $label = ($has_valid_nights) ? "Hotel Cost Per Person" : "Cost Per Person";
            $cost_html .= '<tr><th style="background-color: #d6d8d9;">'. $label .'</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

                            if(!empty($hotel_markup_percentage))
                            {
                                $occupancy_cost += ($occupancy_cost * ($hotel_markup_percentage / 100));
                            
                            }else{
                                $occupancy_cost += ($occupancy_cost * ($markup_percentage / 100));
                            }

                            if ($has_valid_nights) 
                            {
                                $cost_with_total = $occupancy_cost;
                            } else {
                                 $cost_with_total = $occupancy_cost;
                                if (empty($hotel_markup_percentage)) {
                                    $cost_with_total += $grand_total_pp;
                                }
                            }
                            $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

                            $cost_html .= '<td style="background-color: #d6d8d9;">$' . $converted . '</td>';
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            if(!empty($hotel_markup_percentage)){
                $total_cols = 0;
                foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                    foreach ($hotels as $hotel_name => $categories) {
                        foreach ($categories as $cat => $occupancies) {
                            if (is_array($occupancies)) {
                                $total_cols += count($occupancies);
                            }
                        }
                    }
                }
                $converted_other = ($currency->country_currency_value > 0) 
                    ? round($grand_total_pp / $currency->country_currency_value) 
                    : 0;
                $cost_html .= '<tr>
                    <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                    <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                </tr>';
            }
            $cost_html .= '</table>';
        }
        

            // if ($has_valid_nights) {

            //     $hotels_by_ratings = [];

            //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //         foreach ($hotels as $hotel_name => $categories) {
            //             $nights_array = $categories['nights'] ?? [];
            //             // $filtered_nights = is_array($nights_array)
            //             //     ? array_filter($nights_array, fn($v) => $v != 0)
            //             //     : [];
            //             $filtered_nights = is_array($nights_array) ? $nights_array : [];

            //             if (empty($filtered_nights)) continue;

            //             foreach ($filtered_nights as $night_no) {
            //                 $hotels_by_ratings[$rating_key][$night_no][] = [
            //                     'name' => $hotel_name,
            //                     'rating' => $rating_key,
            //                     'night_no' => $night_no,
            //                     'categories' => $categories
            //                 ];
            //             }
            //         }
            //     }

            //     $all_ratings = array_keys($hotels_by_ratings);
            //     $all_nights = [];

            //     foreach ($hotels_by_ratings as $rating => $night_hotels) {
            //         $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            //     }

            //     sort($all_nights);

            //     foreach ($all_ratings as $rating) {
            //         foreach ($all_nights as $night_no) {
            //             if (
            //                 !isset($hotels_by_ratings[$rating][$night_no]) ||
            //                 empty($hotels_by_ratings[$rating][$night_no])
            //             ) {
            //                 foreach ($all_ratings as $alt_rating) {
            //                     if ($alt_rating === $rating) continue;
            //                     if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                         $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
            //                         break;
            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     $packages = [];
            //     $package_index = 1;

            //     foreach ($hotels_by_ratings as $rating => $night_groups) {
            //         $max_count = 0;
            //         foreach ($night_groups as $night_hotels) {
            //             $max_count = max($max_count, count($night_hotels));
            //         }

            //         for ($i = 0; $i < $max_count; $i++) {
            //             $combo = [];

            //             foreach ($all_nights as $night_no) {
            //                 $night_hotels = $night_groups[$night_no];
            //                 $hotel = $night_hotels[$i] ?? end($night_hotels);

            //                 if (!$hotel) {
            //                     foreach ($all_ratings as $alt_rating) {
            //                         if ($alt_rating == $rating) continue;
            //                         if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                             $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
            //                             if ($hotel) break;
            //                         }
            //                     }
            //                 }

            //                 if ($hotel) {
            //                     $combo[] = $hotel;
            //                 }
            //             }
            //             if (!empty($combo)) {
            //                 $merged_costs = [];
            //                 foreach ($combo as $hotel) {
            //                     $categories = $hotel['categories'];
            //                     foreach ($categories as $cat => $occupancies) {
            //                         if (!is_array($occupancies) || $cat === 'nights') continue;

            //                         foreach ($occupancies as $occ) {
            //                             $occ_arr = explode('__', $occ);
            //                             $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
            //                             $occ_cost = floatval($occ_arr[1] ?? 0);

            //                             // Only add if not already added for this hotel
            //                             if (!isset($merged_costs[$hotel['name']][$occ_type])) {
            //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
            //                                 $merged_costs[$hotel['name']][$occ_type] = true; // mark as added
            //                             }
            //                         }
            //                     }
            //                 }

            //                 $packages[] = [
            //                     'name' => 'Package ' . $package_index++,
            //                     'rating' => $rating,
            //                     'hotels' => $combo,
            //                     'merged_costs' => $merged_costs
            //                 ];
            //             }
            //         }
            //     }
            //     $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">
            //         <th rowspan="2">Package</th>
            //         <th rowspan="2">Hotel</th>
            //         <th rowspan="2">Rating</th>
            //         <th rowspan="2">Nights</th>
            //         <th colspan="3">Cost Per Person</th>
            //     </tr>
            //     <tr style="background:#d6d8d9; font-weight:bold;">
            //         <th>Single</th>
            //         <th>Double / Twin</th>
            //         <th>Triple</th>
            //     </tr>';

            //     // foreach ($packages as $pkg) {
            //     //     $rowspan = count($pkg['hotels']);
            //     //     $first_row = true;

            //     //     foreach ($pkg['hotels'] as $hotel) {
            //     //         $name = $hotel['name'];
            //     //         $rating = $hotel['rating'];
            //     //         $night_no = $hotel['night_no'];
            //     //         $stars = str_replace('_', ' ', $rating);

            //     //         // Hotel costs are already multiplied by nights
            //     //         // $single_cost = ((isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0) + $grand_total_pp) / $currency->country_currency_value;
            //     //         // $double_cost = ((isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0) + $grand_total_pp) / $currency->country_currency_value;
            //     //         // $triple_cost = ((isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0) + $grand_total_pp) / $currency->country_currency_value;

            //     //         // Apply markup (hotel-specific or default)
            //     //         $single_base = isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0;
            //     //         $double_base = isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0;
            //     //         $triple_base = isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0;

            //     //         // Apply hotel markup if available, else use general markup
            //     //         if(!empty($hotel_markup_percentage)) {
            //     //             $single_base += ($single_base * ($hotel_markup_percentage / 100));
            //     //             $double_base += ($double_base * ($hotel_markup_percentage / 100));
            //     //             $triple_base += ($triple_base * ($hotel_markup_percentage / 100));
            //     //         } else {
            //     //             $single_base += ($single_base * ($markup_percentage / 100));
            //     //             $double_base += ($double_base * ($markup_percentage / 100));
            //     //             $triple_base += ($triple_base * ($markup_percentage / 100));
            //     //         }

            //     //         // Add other per-person grand totals
            //     //         $single_cost = ($single_base + $grand_total_pp) / $currency->country_currency_value;
            //     //         $double_cost = ($double_base + $grand_total_pp) / $currency->country_currency_value;
            //     //         $triple_cost = ($triple_base + $grand_total_pp) / $currency->country_currency_value;


            //     //         $cost_html .= '<tr>';
            //     //         if ($first_row) {
            //     //             $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
            //     //         }
            //     //         $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
            //     //         $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
            //     //         if($night_no == 0 )
            //     //         {
            //     //             $cost_html .= '<td style="background-color: #d6d8d9;"> Early Check-in</td>';
            //     //         }else{
            //     //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $night_no . 'N' . '</td>';
            //     //         }

            //     //         if ($first_row) {
            //     //             $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //     //                 number_format($single_cost) . ' / $' .
            //     //                 number_format($double_cost) . ' / $' .
            //     //                 number_format($triple_cost) . '</td>';
            //     //             $first_row = false;
            //     //         }
            //     //         $cost_html .= '</tr>';
            //     //     }
            //     // }
            //     foreach ($packages as $pkg) {

            //         // Group same hotel names across multiple nights
            //         $grouped_hotels = [];
            //         foreach ($pkg['hotels'] as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $night_no = $hotel['night_no'];
                
            //             if (!isset($grouped_hotels[$name])) {
            //                 $grouped_hotels[$name] = [
            //                     'name' => $name,
            //                     'rating' => $rating,
            //                     'nights' => [],
            //                 ];
            //             }
            //             $grouped_hotels[$name]['nights'][] = $night_no;
            //         }
                
            //         $rowspan = count($grouped_hotels);
            //         $first_row = true;
                
            //         foreach ($grouped_hotels as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $stars = str_replace('_', ' ', $rating);
            //             $unique_nights = array_unique($hotel['nights']);
            //             $nights_text = implode(', ', array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $unique_nights));

            //             $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
            //             if (in_array(0, $unique_nights)) {
            //                 $total_nights += 1; // count Early Check-in as 1 night
            //             }

            //             $nights_text = $total_nights;
                
            //             // Combine nights like "1N, 2N, 4N"
            //             // $nights_text = implode(', ', array_map(fn($n) => ($n == 0 ? 'Early Check-in' : $n . 'N'), $hotel['nights']));
                
            //             $single_base = isset($pkg['merged_costs']['Single']) ? $pkg['merged_costs']['Single'] : 0;
            //             $double_base = isset($pkg['merged_costs']['Double']) ? $pkg['merged_costs']['Double'] : 0;
            //             $triple_base = isset($pkg['merged_costs']['Triple']) ? $pkg['merged_costs']['Triple'] : 0;
                
            //             if (!empty($hotel_markup_percentage)) {
            //                 $single_base += ($single_base * ($hotel_markup_percentage / 100));
            //                 $double_base += ($double_base * ($hotel_markup_percentage / 100));
            //                 $triple_base += ($triple_base * ($hotel_markup_percentage / 100));
            //             } else {
            //                 $single_base += ($single_base * ($markup_percentage / 100));
            //                 $double_base += ($double_base * ($markup_percentage / 100));
            //                 $triple_base += ($triple_base * ($markup_percentage / 100));
            //             }
                
            //             // $single_cost = ($single_base + $grand_total_pp) / $currency->country_currency_value;
            //             // $double_cost = ($double_base + $grand_total_pp) / $currency->country_currency_value;
            //             // $triple_cost = ($triple_base + $grand_total_pp) / $currency->country_currency_value;
            //             $add_total = empty($hotel_markup_percentage) ? $grand_total_pp : 0;

            //             $single_cost = ($single_base + $add_total) / $currency->country_currency_value;
            //             $double_cost = ($double_base + $add_total) / $currency->country_currency_value;
            //             $triple_cost = ($triple_base + $add_total) / $currency->country_currency_value;

                
            //             $cost_html .= '<tr>';
            //             if ($first_row) {
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
            //             }
                
            //             $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';
                
            //             if ($first_row) {
            //                 // $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                 //     number_format($single_cost) . ' / $' .
            //                 //     number_format($double_cost) . ' / $' .
            //                 //     number_format($triple_cost) . '</td>';
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($single_cost) . '</td>';
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($double_cost) . '</td>';
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' .
            //                     number_format($triple_cost) . '</td>';
            //                 $first_row = false;
            //             }
                
            //             $cost_html .= '</tr>';
            //         }
            //     }

            //     if(!empty($hotel_markup_percentage)){
            //         $total_cols = 0;
            //         foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //             foreach ($hotels as $hotel_name => $categories) {
            //                 foreach ($categories as $cat => $occupancies) {
            //                     if (is_array($occupancies)) {
            //                         $total_cols += count($occupancies);
            //                     }
            //                 }
            //             }
            //         }
            //         $converted_other = ($currency->country_currency_value > 0) 
            //             ? round($grand_total_pp / $currency->country_currency_value) 
            //             : 0;
            //         $cost_html .= '<tr>
            //             <th style="background-color:#d6d8d9;">Land Package Cost Per Person</th>
            //             <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;"> $'.$converted_other.'</td>
            //         </tr>';
            //     }
            //     $cost_html .= '</table>';
            // }
            // if ($has_valid_nights) {
            //     $hotels_by_ratings = [];

            //     foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
            //         foreach ($hotels as $hotel_name => $categories) {
            //             $nights_array = $categories['nights'] ?? [];
            //             $filtered_nights = is_array($nights_array) ? $nights_array : [];

            //             if (empty($filtered_nights)) continue;

            //             foreach ($filtered_nights as $night_no) {
            //                 $hotels_by_ratings[$rating_key][$night_no][] = [
            //                     'name' => $hotel_name,
            //                     'rating' => $rating_key,
            //                     'night_no' => $night_no,
            //                     'categories' => $categories
            //                 ];
            //             }
            //         }
            //     }

            //     $all_ratings = array_keys($hotels_by_ratings);
            //     $all_nights = [];

            //     foreach ($hotels_by_ratings as $rating => $night_hotels) {
            //         $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            //     }

            //     sort($all_nights);

            //     foreach ($all_ratings as $rating) {
            //         foreach ($all_nights as $night_no) {
            //             if (
            //                 !isset($hotels_by_ratings[$rating][$night_no]) ||
            //                 empty($hotels_by_ratings[$rating][$night_no])
            //             ) {
            //                 foreach ($all_ratings as $alt_rating) {
            //                     if ($alt_rating === $rating) continue;
            //                     if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                         $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
            //                         break;
            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     $packages = [];
            //     $package_index = 1;

            //     foreach ($hotels_by_ratings as $rating => $night_groups) {
            //         $max_count = 0;
            //         foreach ($night_groups as $night_hotels) {
            //             $max_count = max($max_count, count($night_hotels));
            //         }

            //         for ($i = 0; $i < $max_count; $i++) {
            //             $combo = [];

            //             foreach ($all_nights as $night_no) {
            //                 $night_hotels = $night_groups[$night_no];
            //                 $hotel = $night_hotels[$i] ?? end($night_hotels);

            //                 if (!$hotel) {
            //                     foreach ($all_ratings as $alt_rating) {
            //                         if ($alt_rating == $rating) continue;
            //                         if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
            //                             $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
            //                             if ($hotel) break;
            //                         }
            //                     }
            //                 }

            //                 if ($hotel) {
            //                     $combo[] = $hotel;
            //                 }
            //             }
            //             if (!empty($combo)) {
            //                 $merged_costs = [];
            //                 foreach ($combo as $hotel) {
            //                     $categories = $hotel['categories'];
            //                     foreach ($categories as $cat => $occupancies) {
            //                         if (!is_array($occupancies) || $cat === 'nights') continue;

            //                         foreach ($occupancies as $occ) {
            //                             $occ_arr = explode('__', $occ);
            //                             $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
            //                             $occ_cost = floatval($occ_arr[1] ?? 0);

            //                             // Only add if not already added for this hotel
            //                             if (!isset($merged_costs[$hotel['name']][$occ_type])) {
            //                                 $merged_costs[$occ_type] = ($merged_costs[$occ_type] ?? 0) + $occ_cost;
            //                                 $merged_costs[$hotel['name']][$occ_type] = true; // mark as added
            //                             }
            //                         }
            //                     }
            //                 }

            //                 $packages[] = [
            //                     'name' => 'Package ' . $package_index++,
            //                     'rating' => $rating,
            //                     'hotels' => $combo,
            //                     'merged_costs' => $merged_costs
            //                 ];
            //             }
            //         }
            //     }

            //     // Determine which occupancy types actually have costs
            //     $all_occupancy_types = ['Single', 'Double', 'Triple'];
            //     $available_occupancy_types = [];
                
            //     foreach ($packages as $pkg) {
            //         foreach ($all_occupancy_types as $type) {
            //             if (isset($pkg['merged_costs'][$type]) && $pkg['merged_costs'][$type] > 0) {
            //                 $available_occupancy_types[$type] = true;
            //             }
            //         }
            //     }

            //     // Create column headers based on available occupancy types
            //     $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            //     $cost_html .= '<th rowspan="2">Package</th>';
            //     $cost_html .= '<th rowspan="2">Hotel</th>';
            //     $cost_html .= '<th rowspan="2">Rating</th>';
            //     $cost_html .= '<th rowspan="2">No. of Nights</th>';
                
            //     if (!empty($available_occupancy_types)) {
            //         $cost_html .= '<th colspan="' . count($available_occupancy_types) . '">Cost Per Person</th>';
            //     }
            //     $cost_html .= '</tr>';
                
            //     $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            //     foreach (array_keys($available_occupancy_types) as $type) {
            //         if ($type === 'Double') {
            //             $cost_html .= '<th>Double / Twin</th>';
            //         } else {
            //             $cost_html .= '<th>' . $type . '</th>';
            //         }
            //     }
            //     $cost_html .= '</tr>';

            //     foreach ($packages as $pkg) {
            //         // Group same hotel names across multiple nights
            //         $grouped_hotels = [];
            //         foreach ($pkg['hotels'] as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $night_no = $hotel['night_no'];

            //             if (!isset($grouped_hotels[$name])) {
            //                 $grouped_hotels[$name] = [
            //                     'name' => $name,
            //                     'rating' => $rating,
            //                     'nights' => [],
            //                 ];
            //             }
            //             $grouped_hotels[$name]['nights'][] = $night_no;
            //         }

            //         $rowspan = count($grouped_hotels);
            //         $first_row = true;

            //         foreach ($grouped_hotels as $hotel) {
            //             $name = $hotel['name'];
            //             $rating = $hotel['rating'];
            //             $stars = str_replace('_', ' ', $rating);
            //             $unique_nights = array_unique($hotel['nights']);
                        
            //             $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
            //             if (in_array(0, $unique_nights)) {
            //                 $total_nights += 1; // count Early Check-in as 1 night
            //             }

            //             $nights_text = $total_nights;

            //             // Calculate costs for available occupancy types only
            //             $occupancy_costs = [];
            //             foreach (array_keys($available_occupancy_types) as $type) {
            //                 $base_cost = isset($pkg['merged_costs'][$type]) ? $pkg['merged_costs'][$type] : 0;
                            
            //                 if (!empty($hotel_markup_percentage)) {
            //                     $base_cost += ($base_cost * ($hotel_markup_percentage / 100));
            //                 } else {
            //                     $base_cost += ($base_cost * ($markup_percentage / 100));
            //                 }

            //                 $add_total = empty($hotel_markup_percentage) ? $grand_total_pp : 0;
            //                 $final_cost = ($base_cost + $add_total) / $currency->country_currency_value;
                            
            //                 $occupancy_costs[$type] = $final_cost;
            //             }

            //             $cost_html .= '<tr>';
            //             if ($first_row) {
            //                 $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
            //             }

            //             $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
            //             $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';

            //             // Only show costs for available occupancy types
            //             if ($first_row) {
            //                 foreach ($occupancy_costs as $cost) {
            //                     $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' . number_format($cost) . '</td>';
            //                 }
            //                 $first_row = false;
            //             }

            //             $cost_html .= '</tr>';
            //         }
            //     }
                
            //     if(!empty($hotel_markup_percentage)){
            //         $total_cols = 4 + count($available_occupancy_types); // Package, Hotel, Rating, Nights + occupancy columns
            //         $converted_other = ($currency->country_currency_value > 0) 
            //             ? round($grand_total_pp / $currency->country_currency_value) 
            //             : 0;
            //         $cost_html .= '<tr>
            //             <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
            //             <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
            //         </tr>';
            //     }
            //     $cost_html .= '</table>';
            // }
             if ($has_valid_nights) {
            $hotels_by_ratings = [];

            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    $nights_array = $categories['nights'] ?? [];
                    $filtered_nights = is_array($nights_array) ? $nights_array : [];

                    if (empty($filtered_nights)) continue;

                    foreach ($filtered_nights as $night_no) {
                        $hotels_by_ratings[$rating_key][$night_no][] = [
                            'name' => $hotel_name,
                            'rating' => $rating_key,
                            'night_no' => $night_no,
                            'categories' => $categories
                        ];
                    }
                }
            }

            $all_ratings = array_keys($hotels_by_ratings);
            $all_nights = [];

            foreach ($hotels_by_ratings as $rating => $night_hotels) {
                $all_nights = array_unique(array_merge($all_nights, array_keys($night_hotels)));
            }

            sort($all_nights);

            foreach ($all_ratings as $rating) {
                foreach ($all_nights as $night_no) {
                    if (
                        !isset($hotels_by_ratings[$rating][$night_no]) ||
                        empty($hotels_by_ratings[$rating][$night_no])
                    ) {
                        foreach ($all_ratings as $alt_rating) {
                            if ($alt_rating === $rating) continue;
                            if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
                                $hotels_by_ratings[$rating][$night_no] = $hotels_by_ratings[$alt_rating][$night_no];
                                break;
                            }
                        }
                    }
                }
            }

            $packages = [];
            $package_index = 1;

            foreach ($hotels_by_ratings as $rating => $night_groups) {
                $max_count = 0;
                foreach ($night_groups as $night_hotels) {
                    $max_count = max($max_count, count($night_hotels));
                }

                for ($i = 0; $i < $max_count; $i++) {
                    $combo = [];

                    foreach ($all_nights as $night_no) {
                        $night_hotels = $night_groups[$night_no];
                        $hotel = $night_hotels[$i] ?? end($night_hotels);

                        if (!$hotel) {
                            foreach ($all_ratings as $alt_rating) {
                                if ($alt_rating == $rating) continue;
                                if (!empty($hotels_by_ratings[$alt_rating][$night_no])) {
                                    $hotel = $hotels_by_ratings[$alt_rating][$night_no][$i] ?? end($hotels_by_ratings[$alt_rating][$night_no]);
                                    if ($hotel) break;
                                }
                            }
                        }

                        if ($hotel) {
                            $combo[] = $hotel;
                        }
                    }
                    if (!empty($combo)) {
                        $merged_costs = [];
                        $hotel_wise_costs = []; 
                        
                        $hotel_nights_in_package = [];
                        foreach ($combo as $hotel) {
                            $hotel_name = $hotel['name'];
                            if (!isset($hotel_nights_in_package[$hotel_name])) {
                                $hotel_nights_in_package[$hotel_name] = 0;
                            }
                            $hotel_nights_in_package[$hotel_name]++;
                        }
                        
                        foreach ($combo as $hotel) {
                            $categories = $hotel['categories'];
                            $hotel_name = $hotel['name'];
                            $hotel_wise_costs[$hotel_name] = []; 
                            
                            $original_nights = 0;
                            if (isset($categories['nights'])) {
                                if (is_array($categories['nights'])) {
                                    $original_nights = count(array_filter($categories['nights'], fn($n) => $n > 0));
                                } else {
                                    $original_nights = (int)$categories['nights'];
                                }
                            }
                            
                            $actual_nights_in_this_package = $hotel_nights_in_package[$hotel_name];
                            
                            foreach ($categories as $cat => $occupancies) {
                                if (!is_array($occupancies) || $cat === 'nights') continue;

                                foreach ($occupancies as $occ) {
                                    $occ_arr = explode('__', $occ);
                                    $occ_type = trim(str_ireplace("Occupancy", "", $occ_arr[0] ?? ''));
                                    $occ_total_cost = floatval($occ_arr[1] ?? 0); 
                                    
                                    $occ_cost_per_night = $original_nights > 0 ? $occ_total_cost / $original_nights : 0;
                                    
                                    $total_cost_for_package = $occ_cost_per_night * $actual_nights_in_this_package;
                                    // print_r($total_cost_for_package);

                                    if (!isset($hotel_wise_costs[$hotel_name][$occ_type])) {
                                        $hotel_wise_costs[$hotel_name][$occ_type] = 0;
                                    }
                                    $hotel_wise_costs[$hotel_name][$occ_type] += $total_cost_for_package;

                                    if (!isset($merged_costs[$occ_type])) {
                                        $merged_costs[$occ_type] = 0;
                                    }
                                    $merged_costs[$occ_type] += $total_cost_for_package;
                                }
                            }
                        }

                        $packages[] = [
                            'name' => 'Package ' . $package_index++,
                            'rating' => $rating,
                            'hotels' => $combo,
                            'merged_costs' => $merged_costs,
                            'hotel_wise_costs' => $hotel_wise_costs 
                        ];
                    }
                }
            }

            $all_occupancy_types = ['Single', 'Double', 'Triple'];
            $available_occupancy_types = [];
            
            foreach ($packages as $pkg) {
                foreach ($all_occupancy_types as $type) {
                    if (isset($pkg['merged_costs'][$type]) && $pkg['merged_costs'][$type] > 0) {
                        $available_occupancy_types[$type] = true;
                    }
                }
            }

            $cost_html .= '<table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:left;">';
            $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            $cost_html .= '<th rowspan="2">Package</th>';
            $cost_html .= '<th rowspan="2">Hotel</th>';
            $cost_html .= '<th rowspan="2">Rating</th>';
            $cost_html .= '<th rowspan="2">No. of Nights</th>';
            if (!empty($available_occupancy_types)) {
                $cost_label = !empty($hotel_markup_percentage) ? 'Cost Per Room / Night' : 'Cost Per Person';
                $cost_html .= '<th colspan="' . count($available_occupancy_types) . '" >' . $cost_label . '</th>';
            }
            $cost_html .= '</tr>';
            
            $cost_html .= '<tr style="background:#d6d8d9; font-weight:bold;">';
            foreach (array_keys($available_occupancy_types) as $type) {
                if ($type === 'Double') {
                    $cost_html .= '<th>Double / Twin</th>';
                } else {
                    $cost_html .= '<th>' . $type . '</th>';
                }
            }
            $cost_html .= '</tr>';

            foreach ($packages as $pkg) {
                // Group same hotel names across multiple nights
                $grouped_hotels = [];
                foreach ($pkg['hotels'] as $hotel) {
                    $name = $hotel['name'];
                    $rating = $hotel['rating'];
                    $night_no = $hotel['night_no'];

                    if (!isset($grouped_hotels[$name])) {
                        $grouped_hotels[$name] = [
                            'name' => $name,
                            'rating' => $rating,
                            'nights' => [],
                        ];
                    }
                    $grouped_hotels[$name]['nights'][] = $night_no;
                }

                $rowspan = count($grouped_hotels);
                $first_row = true;

                foreach ($grouped_hotels as $hotel_name => $hotel_data) {
                    $name = $hotel_data['name'];
                    $rating = $hotel_data['rating'];
                    $stars = str_replace('_', ' ', $rating);
                    $unique_nights = array_unique($hotel_data['nights']);
                    
                    $total_nights = count(array_filter($unique_nights, fn($n) => $n > 0));
                    if (in_array(0, $unique_nights)) {
                        $total_nights += 1; 
                    }

                    $nights_text = $total_nights;

                    $cost_html .= '<tr>';
                    if ($first_row) {
                        $cost_html .= '<td rowspan="' . $rowspan . '" style="font-weight:bold;background-color: #d6d8d9;">' . $pkg['name'] . '</td>';
                    }

                    $cost_html .= '<td style="font-weight:bold;color:#6060a9;background-color: #d6d8d9;">' . $name . '</td>';
                    $cost_html .= '<td style="background-color: #d6d8d9;">' . $stars . '</td>';
                    $cost_html .= '<td style="background-color: #d6d8d9;">' . $nights_text . '</td>';

                    if (!empty($hotel_markup_percentage)) {
                        $hotel_costs = $pkg['hotel_wise_costs'][$hotel_name] ?? [];
                        foreach (array_keys($available_occupancy_types) as $type) {
                            $base_cost = isset($hotel_costs[$type]) ? $hotel_costs[$type] : 0;
                            $base_cost += ($base_cost * ($hotel_markup_percentage / 100));

                            // $multiplier = 1;
                            // switch (strtolower($type)) {
                            //     case 'double':
                            //         $multiplier = 2;
                            //         break;
                            //     case 'triple':
                            //         $multiplier = 3;
                            //         break;
                            //     default:
                            //         $multiplier = 1;
                            // }

                            // $base_cost *= $multiplier;
                            $final_total_cost = $base_cost / $currency->country_currency_value;
                            // $final_cost_per_night = $total_nights > 0 ? $final_total_cost / $total_nights : 0;

                            $cost_html .= '<td style="background-color: #d6d8d9;"> $' . number_format($final_total_cost) . '</td>';
                        }
                    }
                    else 
                    {
                        $occupancy_costs = [];
                        foreach (array_keys($available_occupancy_types) as $type) {
                            $base_cost = isset($pkg['merged_costs'][$type]) ? $pkg['merged_costs'][$type] : 0;
                            
                            $base_cost += ($base_cost * ($markup_percentage / 100));
                            $final_cost_hotel = $total_nights > 0 ? $base_cost / $total_nights : 0;
                            
                            $add_total = $grand_total_pp;
                            $final_cost = ($final_cost_hotel + $add_total) / $currency->country_currency_value;
                            
                            $occupancy_costs[$type] = $final_cost;
                        }

                        if ($first_row) {
                            foreach ($occupancy_costs as $cost) {
                                $cost_html .= '<td rowspan="' . $rowspan . '" style="background-color: #d6d8d9;"> $' . number_format($cost) . '</td>';
                            }
                        }
                    }

                    if ($first_row) {
                        $first_row = false;
                    }
                    $cost_html .= '</tr>';
                }
            }
            
            if(!empty($hotel_markup_percentage)){
                $total_cols = 4 + count($available_occupancy_types); 
                $converted_other = ($currency->country_currency_value > 0) 
                    ? round($grand_total_pp / $currency->country_currency_value) 
                    : 0;
                $cost_html .= '<tr>
                    <th style="background-color:#d6d8d9;color:red;">Land Package Cost Per Person</th>
                    <td colspan="'.$total_cols.'" style="background-color:#d6d8d9;color:red;"> $'.$converted_other.'</td>
                </tr>';
            }
            $cost_html .= '</table>';
        }
        return $cost_html;
    }
    
    
    public function brief_itinerary($id)
    {
        $id= base64_decode($id);
        $where = 'quotations.enquiry_id = ' . $id;
        $result = $this->common_model->get_data('quotations', '', '', '*', $where, 'ORDER BY id DESC LIMIT 1', false);

        $itinerary_json = $result[0]->itinerary_details ?? '[]';
        $decoded_itinerary = json_decode($itinerary_json, true);

        $site_map = [];
        $sites = $this->common_model->get_data('sites');
        foreach ($sites as $site) {
            $site_map[$site->id] = $site->site_name;
            $site_map2[$site->id] = $site->description;
            $site_map3[$site->id] = $site->entry_ticket_for;
            $site_map4[$site->id] = $site->departing_time_from_hotel;
            $site_map5[$site->id] = $site->duration_hours;
            $site_map6[$site->id] = $site->duration_minutes;
        }

        $brief_itinerary = [];
        foreach ($decoded_itinerary as $day_data) {
            $day_sites = [];

            // Safely access itinerary array only if it's set and is an array
            if (isset($day_data['itinerary']) && is_array($day_data['itinerary'])) {
                foreach ($day_data['itinerary'] as $entry) {
                    $site_id = $entry['site_id'] ?? null;
                    if ($site_id) {
                        $day_sites[] = [
                            'departing_time_from_hotel'=> $site_map4[$site_id] ?? '',
                            'site_name' => $site_map[$site_id] ?? '',
                            'description' => $site_map2[$site_id] ?? '',
                            'entry_ticket_for' => $site_map3[$site_id] ?? '',
                            'duration_hours' => $site_map5[$site_id] ?? '',
                            'duration_minutes' => $site_map6[$site_id] ?? '',
                        ];
                    }
                }
            }
            $brief_itinerary[] = $day_sites;
        }
        $data['brief_itinerary'] = $brief_itinerary;

        log_user_activity('Brief Itinerary', $this->session->userdata('id'), 'View');
        $this->load->view('admin/brief_itinerary', $data);
    }

   
    
    public function airline_city(){
        $response = array();
        $this->db->select('DISTINCT(departure_city)');
        $this->db->where("departure_city like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->limit(10);
        $records = $this->db->get('flight_schedule')->result();
        foreach ($records as $row) {
            $response[] = array("departure_city" => trim($row->departure_city), "label" => trim($row->departure_city));
        }
        echo json_encode($response);
    }

    public function get_airlines(){
        $departure_city = $this->input->post('departure_city');
        $arrival_city = $this->input->post('arrival_city');
        $search = trim($this->input->post('search'));
        $where = '';
        if($departure_city != "" && $arrival_city != ""){
            $where = ' flight_schedule.departure_city = "'.$departure_city.'" AND flight_schedule.arrival_city = "'.$arrival_city.'" AND ';
        }else if($departure_city != "" && $arrival_city == ""){
            $where = ' flight_schedule.departure_city = "'.$departure_city.'" AND ';
        }
        $where .= ' flight_schedule.status = "active" AND airlines.status="active"';
        if($this->input->post('start_day')<>''){
            $where .= ' AND (flight_schedule.days_of_operations LIKE "%'.trim($this->input->post('start_day')).'%"';
            $where .= ' OR flight_schedule.days_of_operations  = "daily")';
        }else if($this->input->post('end_day')<>''){
            $where .= ' AND (flight_schedule.days_of_operations LIKE "%'.trim($this->input->post('end_day')).'%"';
            $where .= ' OR flight_schedule.days_of_operations  = "daily")';
        }
        // $where .= ' AND LOWER(airlines.name) LIKE "%'.$search.'%"';
        if (preg_match('/^([a-zA-Z]+)(\d+)$/', $search, $matches)) 
        {
            $airline_code = strtoupper($matches[1]); 
            $flight_number = $matches[2];
            $where .= ' AND ( UPPER(airlines.code) LIKE "%' . $airline_code . '%" AND flight_schedule.flight_number LIKE "%' . $flight_number . '%" )';
        } else {
                $where .= ' AND (LOWER(airlines.name) LIKE "%' . $search . '%" OR UPPER(airlines.code) LIKE "%' . strtoupper($search) . '%" OR CAST(flight_schedule.flight_number AS CHAR) LIKE "%' . $search . '%")';
        }

        $join = [['type' => '', 'join_table' => 'airlines', 'condition' => 'flight_schedule.airline_id = airlines.id'],];
        $data = $this->common_model->get_data('flight_schedule','', '', '*',$where, '', $count = false,$join);
        //echo $this->db->last_query();'<pre>';print_R($data);exit;
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name.' ('.$row->code.$row->flight_number.')'),'departure_time'=>trim($row->departure_time),'arrival_time'=>trim($row->arrival_time));
        }
        echo json_encode($response);
        exit;
    }

    // **************************************************************************************
	
	
    public function index(){
        
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid details!</div>');
            redirect('enquiry-followup');
        }
        $id = base64_decode($this->input->get('id'));
        
        $where = 'enquiry.id = '.$id;
        $quotation_enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false)[0];
        $data['details'] = $quotation_enquiry;
        //echo '<pre>';print_r($quotation_enquiry);exit;
        $capacity = $quotation_enquiry->number_persons + $quotation_enquiry->number_child;        
        
        $where = 'enquiry.status = "confirm" AND enquiry.enquiry_abbr = "'.$quotation_enquiry->enquiry_abbr.'" AND enquiry.number_of_nights <= '.$quotation_enquiry->number_of_nights;
        $where .= ' AND enquiry.number_persons <= '.$quotation_enquiry->number_persons .' AND enquiry.number_child <= '.$quotation_enquiry->number_child; 
        $where .= ' AND date(enquiry.date) >= "'.date('Y-m-d', strtotime('-30 days')).'"';
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
                ['type' => '', 'join_table' => 'itinerary', 'condition' => '(itinerary.arrival_id = arrivals.id AND itinerary.status="active")'],];
        $data['itinerary'] = $this->common_model->get_data('enquiry','', '', 'DISTINCT enquiry.enquiry_no,enquiry.*,arrivals.id AS arrival_id',$where, '', $count = false,$join);
        //echo $this->db->last_query();exit;
        
        $select = 'hotels.id,hotels.name';
        $where = 'enquiry.status = "confirm" AND enquiry.enquiry_abbr = "'.$quotation_enquiry->enquiry_abbr.'" AND enquiry.number_of_nights = '.$quotation_enquiry->number_of_nights;
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
                ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrivals.enquiry_id = arrival_hotel_details.enquiry_id'],
                ['type' => '', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
        $data['hotels'] = $this->common_model->get_data('enquiry','', '', $select,$where, ' GROUP BY hotels.id', $count = false,$join);
        
        $char = substr($quotation_enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
        $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
        $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, '', $count = false);
        
        //echo '<pre>';print_r($data);exit;
         
        $this->load->view('admin/quotation_suggesstions',$data);
    }
    
    public function create(){
        $_GET = $_POST;
        //echo '<pre>';print_r($this->input->get());exit;
		
        $enquiry_id = base64_decode(urldecode($this->input->get('enquiry_id')));
        $where = 'enquiry.id = '.$enquiry_id;
        $data['details'] = $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false)[0];
		
	$char = substr($enquiry->enquiry_abbr,1,1);
        $country = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
		$data['country'] = $country[$char];

	$where = 'country = "'.$country[$char] .'" AND itinerary_templates_content.status != "deleted"';
        $template = $this->common_model->get_data('itinerary_templates_content','', '', '*',$where, ' ORDER BY itinerary_templates_content.id ASC', $count = false);
        
	    /*$select = 'sites.*'; // For later use
        $where = 'location_masters.destination_type = "outsidecity" AND location_masters.status = "active" AND LOWER(location_masters.country)="'.$country[$char].'"';
        $join = [['type' => '', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
        $sites = $this->common_model->get_data('sites','', '', $select,$where, '', $count = false,$join);*/
		
        $data['airport_transfer_in'] = $data['airport_transfer_out'] = [];
        if($this->input->get('airport_pick_drop')=='yes' && $this->input->get('chk_vehicle')<>''){
            $transport_id = implode(',',$this->input->get('chk_vehicle'));
            $where = ' transportation_costs.transport_id IN ('.$transport_id.') AND transportation_costs.type IN ("airport-transfer-in","airport-transfer-out")';
            $where .= ' AND date(transportation_costs.valid_from) <= "'.$data['details']->check_in_date.'" AND date(transportation_costs.valid_to) >= "'.$data['details']->check_out_date.'"';
            $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = transportation_costs.transport_id'],];
            $airport_transportation = $this->common_model->get_data('transportation_costs','', '', '*',$where, '', $count = false,$join);

            foreach($airport_transportation AS $list){
                if($list->type == 'airport-transfer-in'){
                    $key = array_search($list->id, $this->input->get('chk_vehicle[]'));
                    $data['airport_transfer_in'][] = ['vehicle_name'=>$list->vehicle_name,'price'=>$list->price,'currency'=>$list->currency,
                                                                        'quantity'=>$this->input->get('vehicle_quantity')[$key]];
                }elseif($list->type == 'airport-transfer-out'){
                    $key = array_search($list->id, $this->input->get('chk_vehicle[]'));
                    $data['airport_transfer_out'][] = ['vehicle_name'=>$list->vehicle_name,'price'=>$list->price,'currency'=>$list->currency,
                                                                        'quantity'=>$this->input->get('vehicle_quantity')[$key]];
                }
            }
        }
        $data['transportation'] = [];
        if($this->input->get('chk_vehicle')<>''){
            $transport_id = implode(',',$this->input->get('chk_vehicle'));
            $where = ' transportation.id IN ('.$transport_id.') AND transportation.status = "active"';
            $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, '', $count = false);
        }
		
        $start_date = new DateTime($enquiry->check_in_date);
        $last_date = new DateTime($enquiry->check_out_date);
        $diff = $last_date->diff($start_date);
        $data['duration'] = $diff->days;
        
//         echo $start_date->format('Y-m-d'); // ya jaisa format chahiye
// echo "<br>";
// echo $last_date->format('Y-m-d');
// echo "Duration: ".$data['duration']." days";
// die();
		
        $arrival_time = ($this->input->get('hdn_arrival_time')<>'')?$this->input->get('hdn_arrival_time'):'08:00';
        $departure_time = ($this->input->get('hdn_departure_time')<>'')?$this->input->get('hdn_departure_time'):'20:00';
		
        for($i=0;$i<=$diff->days;$i++){
            $date = date('Y-m-d', strtotime($enquiry->check_in_date)+($i*24*60*60));
            if($i==0){
                if($this->input->get('airport_pick_drop') == 'no'){
                    $template[0]->content = explode('After',$template[0]->content)[0];
                }
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$arrival_time,'content'=>$template[0]->content,'remarks'=>''];
            }else if($i==$diff->days){
                if($this->input->get('airport_pick_drop') == 'no'){
                    $template[2]->content = explode('Our',$template[2]->content)[0];
                }
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$departure_time,'content'=>$template[2]->content,'remarks'=>''];
            }else{
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>'07:00','content'=>'','remarks'=>''];
            }
           // echo '<pre>';print_R($data);exit;
        }
	    // echo '<pre>';print_R($data);exit;
		$data['content'] = 'admin/quotation_create';
        $this->load->view('admin/layout',$data);
    }    
    
    // public function get_hotel_prices(){ //echo '<br>'; print_r($this->input->post());exit;
    //     $hotel_id = $this->input->post('hotel_id');
    //     $check_in = $this->input->post('check_in');
    //     $check_out = $this->input->post('check_out');
    //     $type = $this->input->post('type');//implode('","',$this->input->post('type'));
    //     $where = 'hotel_room_categories.hotel_id = '.$hotel_id.' AND hotel_room_categories.status = "active" ';
    //     $where .= ' AND hotels.category IN ("'.$type.'")';
    //     $where .= ' AND date(room_category_costing.from_date) <= "'.$check_in.'" AND date(room_category_costing.to_date) >= "'.$check_out.'"';
    //     $qry = 'SELECT hotels.name,hotels.location,hotel_room_categories.id,hotel_room_categories.category_name, GROUP_CONCAT( CONCAT(room_category_costing.person_count,"(",if(room_category_costing.type="adult", "A","C") ,") ",room_category_costing.price_with_breakfast," ",room_category_costing.child_bed) ORDER BY room_category_costing.type,room_category_costing.person_count SEPARATOR ",") AS details ';
    //     $qry .= 'FROM hotel_room_categories JOIN room_category_costing ON (room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active") ';
    //     $qry .= 'JOIN hotels ON hotels.id = hotel_room_categories.hotel_id WHERE '.$where.' GROUP BY hotel_room_categories.id ';
    //     //echo $qry;exit;
    //     $data['result'] = $this->common_model->custom_query($qry);
    //     echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    //     exit;
    // }
    
    
      public function get_hotel_prices(){
        $hotel_id = $this->input->post('hotel_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');
        $type = $this->input->post('type');

        // ✅ First check if this hotel is booting_resort
        $hotel = $this->db->select('booting_resort')
                        ->where('id', $hotel_id)
                        ->get('hotels')
                        ->row();

        $where = 'hotel_room_categories.hotel_id = '.$hotel_id.' 
                AND hotel_room_categories.status = "active" ';

        // ✅ If booting_resort = yes → force 4 Star
        if (!empty($hotel) && strtolower($hotel->booting_resort) == 'yes') {
            $where .= ' AND hotels.category IN ("4 Star")';
        } else {
            $where .= ' AND hotels.category IN ("'.$type.'")';
        }

        // ✅ Room availability overlap condition
        $where .= ' AND date(room_category_costing.from_date) <= "'.$check_in.'" 
                    AND date(room_category_costing.to_date) >= "'.$check_out.'"';

        $qry = 'SELECT hotels.name,
                    hotels.location,
                    hotel_room_categories.id,
                    hotel_room_categories.category_name, 
                    GROUP_CONCAT(
                        CONCAT(
                            room_category_costing.person_count,
                            "(", IF(room_category_costing.type="adult", "A","C") ,") ",
                            room_category_costing.price_with_breakfast," ",
                            room_category_costing.child_bed
                        ) ORDER BY room_category_costing.type,room_category_costing.person_count SEPARATOR ","
                    ) AS details
                FROM hotel_room_categories 
                JOIN room_category_costing 
                    ON (room_category_costing.category_id = hotel_room_categories.id 
                        AND room_category_costing.status="active") 
                JOIN hotels 
                    ON hotels.id = hotel_room_categories.hotel_id 
                WHERE '.$where.' 
                GROUP BY hotel_room_categories.id';

        // echo $qry;exit; // ✅ Uncomment for debugging
        $data['result'] = $this->common_model->custom_query($qry);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }

    
    public function get_cities(){
        $char = substr($this->input->post('enq_no'),1,2);
        $search = trim($this->input->post('search'));
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $select = 'DISTINCT(cities.name) as name';
        $where = 'LOWER(countries.name) = "'.$locations[$char].'" AND cities.name LIKE "%'.$search.'%"';
        $join = [['type' => '', 'join_table' => 'states', 'condition' => 'cities.state_id = states.id'],
                ['type' => '', 'join_table' => 'countries', 'condition' => 'countries.id = states.country_id'],];
        $data = $this->common_model->get_data('cities','', '', $select,$where, ' LIMIT 10', $count = false,$join);
        //echo '<pre>';print_r((array)$data);exit;
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name),'suburb_flag'=>false);
        }
        if(empty($response)){
            $select = 'suburbs.name';
            $where = 'LOWER(countries.name) = "'.$locations[$char].'" AND suburbs.name LIKE "%'.$search.'%"';
            $join = [['type' => '', 'join_table' => 'suburbs', 'condition' => 'suburbs.city_id = cities.id'],
                    ['type' => '', 'join_table' => 'states', 'condition' => 'cities.state_id = states.id'],
                    ['type' => '', 'join_table' => 'countries', 'condition' => 'countries.id = states.country_id'],];
            $data = $this->common_model->get_data('cities','', '', $select,$where, ' LIMIT 10', $count = false,$join);
            //echo '<pre>';print_r((array)$data);exit;
            foreach ($data as $row) {
                $response[] = array("label" => trim($row->name),'suburb_flag'=>true);
            }
        }
        echo json_encode($response);
        exit;
    }
    
    // public function get_hotel_citywise(){
    //     //echo '<pre>';print_r($this->input->post());exit;
    //     $city = $this->input->post('city');
    //     $search = trim($this->input->post('search'));
    //     $selected_hotel_ids = $this->input->post('hotel_ids');
    //     //echo '<pre>';print_R($selected_hotel_ids);exit;
    //     //$type = (count($this->input->post('type'))>1)?implode('","',$this->input->post('type')):$this->input->post('type')[0];
    //     $type = $this->input->post('type');
    //     $select = 'hotels.name,hotels.id';
    //     $where = 'LOWER(hotels.city) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';
    //     if(array_key_exists('suburb',$this->input->post())){
    //         $where = 'LOWER(hotels.suburb) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';
    //     }
    //     $where .= ' AND hotels.status = "active" AND hotels.category IN ("'.$type.'")';
    //     $filteredArray = array_filter($selected_hotel_ids, function($value) {
    //         return !empty($value) && trim($value) !== '';
    //     });
    //     if(!empty($filteredArray)){            
    //         $where .= ' AND hotels.id NOT IN ('.implode(',',$filteredArray).')';
    //     }
    //     $data = $this->common_model->get_data('hotels','', '', $select,$where, ' LIMIT 10', $count = false);
    //     //echo $this->db->last_query();exit;
    //     $response = [];
    //     foreach ($data as $row) {
    //         $response[] = array("label" => trim($row->name),'hotel_id'=>$row->id);
    //     }

    //     $where = 'suburbs.name = "'.$city.'"';
    //     $join = [['type' => 'LEFT', 'join_table' => 'cities', 'condition' => 'cities.id = suburbs.city_id'],];
    //     $data_suburbs = $this->common_model->get_data('suburbs','', '', 'suburbs.name',$where, '', $count = false,$join);
    //     if(empty($response) && !empty($data_suburbs)){
    //         $_POST['city'] = $data_suburbs[0]->name;
    //         $_POST['suburb'] = $data_suburbs[0]->name;
    //         $this->get_hotel_citywise();
    //     }

    //     echo json_encode($response);
    //     exit;
    // }
    
    // public function get_hotel_citywise()
    // {
    //     $city               = $this->input->post('city');
    //     $search             = trim($this->input->post('search'));
    //     $selected_hotel_ids = $this->input->post('hotel_ids');
    //     $type               = $this->input->post('type');
    //     $check_in           = $this->input->post('check_in');
    //     $check_out          = $this->input->post('check_out');

    //     $select = 'hotels.id, hotels.name';
    //     $where  = 'LOWER(hotels.city) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';

    //     if ($this->input->post('suburb')) {
    //         $where = 'LOWER(hotels.suburb) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';
    //     }

    //     $where .= ' AND hotels.status = "active" AND hotels.category IN ("'.$type.'")';

    //     $filteredArray = array_filter($selected_hotel_ids, function($value) {
    //         return !empty($value) && trim($value) !== '';
    //     });
    //     if (!empty($filteredArray)) {            
    //         $where .= ' AND hotels.id NOT IN ('.implode(',', $filteredArray).')';
    //     }

    //     $data = $this->common_model->get_data('hotels', '', '', $select, $where, ' LIMIT 10', false);
    //     $response = [];

    //     foreach ($data as $row) {
    //         $hotel_id = $row->id;
    //         $qry  = 'SELECT COUNT(*) as cnt FROM hotel_room_categories ';
    //         $qry .= 'JOIN room_category_costing ON (room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active") ';
    //         $qry .= 'WHERE hotel_room_categories.hotel_id = '.$hotel_id.' ';
    //         $qry .= 'AND hotel_room_categories.status="active" ';
    //         $qry .= 'AND date(room_category_costing.from_date) <= "'.$check_in.'" ';
    //         $qry .= 'AND date(room_category_costing.to_date) >= "'.$check_out.'" ';
    //         $result = $this->db->query($qry)->row();

    //         if ($result->cnt > 0) {
    //             $response[] = [
    //                 "label"    => trim($row->name),
    //                 "hotel_id" => $hotel_id
    //             ];
    //         }
    //     }
    //     if (empty($response) && !$this->input->post('suburb')) {
    //         $where = 'suburbs.name = "'.$city.'"';
    //         $join  = [
    //             ['type' => 'LEFT', 'join_table' => 'cities', 'condition' => 'cities.id = suburbs.city_id']
    //         ];
    //         $data_suburbs = $this->common_model->get_data('suburbs','', '', 'suburbs.name',$where, '', false,$join);

    //         if (!empty($data_suburbs)) {
    //             $_POST['city']   = $data_suburbs[0]->name;
    //             $_POST['suburb'] = $data_suburbs[0]->name;
    //             return $this->get_hotel_citywise(); 
    //         }
    //     }
    //     // if (empty($response)) {
    //     //     $all_cities = $this->input->post('all_cities') ?? [];
    //     //     $normalized = array_map(function($c) {
    //     //         return strtolower(trim($c));
    //     //     }, $all_cities);
    //     //     $unique_cities = array_unique($normalized);
    //     //     if (count($unique_cities) > 1) {
    //     //         $response[] = [
    //     //             "label"    => "<span style='color:red;'>NA (Proceed Without Hotel)</span>",
    //     //             "hotel_id" => "0"
    //     //         ];
    //     //     }
    //     // }
    //     $response[] = [
    //         "label"    => "<span style='color:red;'>NA (Proceed Without Hotel)</span>",
    //         "hotel_id" => "0"
    //     ];
    //     echo json_encode($response);
    //     exit;
    // }
    
    // public function get_hotel_citywise()
    // {
    //     $city               = $this->input->post('city');
    //     $search             = trim($this->input->post('search'));
    //     $selected_hotel_ids = $this->input->post('hotel_ids');
    //     $type               = $this->input->post('type');
    //     $check_in           = $this->input->post('check_in');
    //     $check_out          = $this->input->post('check_out');

    //     $select = 'hotels.id, hotels.name';

    //     // Special case for Kolsai
    //     if (strtolower($city) == 'kolsai') {
    //         $where = 'hotels.booting_resort = "yes" AND hotels.status = "active"';
    //     } else {
    //         $where = 'LOWER(hotels.city) = "'.strtolower($city).'" 
    //                 AND hotels.name LIKE "%'.$search.'%" 
    //                 AND hotels.status = "active" 
    //                 AND hotels.category IN ("'.$type.'")';

    //         if (!empty($filteredArray)) {
    //             $where .= ' AND hotels.id NOT IN ('.implode(',', $filteredArray).')';
    //         }
    //     }


    //     // Filter out already selected hotel IDs
    //     $filteredArray = array_filter($selected_hotel_ids, function($value) {
    //         return !empty($value) && trim($value) !== '';
    //     });

    //     // Get hotel data
    //     $data = $this->common_model->get_data('hotels', '', '', $select, $where, ' LIMIT 10', false);
    //     $response = [];

    //     // Check room availability for each hotel
    //     foreach ($data as $row) {
    //         $hotel_id = $row->id;
    //         $qry  = 'SELECT COUNT(*) as cnt FROM hotel_room_categories ';
    //         $qry .= 'JOIN room_category_costing ON (room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active") ';
    //         $qry .= 'WHERE hotel_room_categories.hotel_id = '.$hotel_id.' ';
    //         $qry .= 'AND hotel_room_categories.status="active" ';
    //         $qry .= 'AND date(room_category_costing.from_date) <= "'.$check_in.'" ';
    //         $qry .= 'AND date(room_category_costing.to_date) >= "'.$check_out.'" ';
    //         $result = $this->db->query($qry)->row();

    //         if ($result->cnt > 0) {
    //             $response[] = [
    //                 "label"    => trim($row->name),
    //                 "hotel_id" => $hotel_id
    //             ];
    //         }
    //     }

    //     // Add "Proceed Without Hotel" option
    //     $response[] = [
    //         "label"    => "<span style='color:red;'>NA (Proceed Without Hotel)</span>",
    //         "hotel_id" => "0"
    //     ];

    //     echo json_encode($response);
    //     // echo $this->db->last_query();
    //     exit;
    // }
    
    public function get_hotel_citywise()
    {
        $city               = $this->input->post('city');
        $search             = trim($this->input->post('search'));
        $selected_hotel_ids = $this->input->post('hotel_ids');
        $type               = $this->input->post('type');
        $check_in           = $this->input->post('check_in');
        $check_out          = $this->input->post('check_out');

        $select = 'hotels.id, hotels.name';

        // Filter out already selected hotel IDs first
        $filteredArray = array_filter($selected_hotel_ids, function($value) {
            return !empty($value) && trim($value) !== '';
        });

        // Special case for Kolsai
        if (strtolower($city) == 'kolsai') {
            $where = 'hotels.booting_resort = "yes" AND hotels.status = "active" AND hotels.name LIKE "%'.$search.'%"';
            // Exclude already selected booting_resort hotels
            if (!empty($filteredArray)) {
                $where .= ' AND hotels.id NOT IN ('.implode(',', $filteredArray).')';
            }
        } else {
            $where = 'LOWER(hotels.city) = "'.strtolower($city).'" 
                    AND hotels.name LIKE "%'.$search.'%" 
                    AND hotels.status = "active" 
                    AND hotels.category IN ("'.$type.'")';

            // Exclude already displayed hotels
            if (!empty($filteredArray)) {
                $where .= ' AND hotels.id NOT IN ('.implode(',', $filteredArray).')';
            }
        }

        // Get hotel data
        $data = $this->common_model->get_data('hotels', '', '', $select, $where, ' LIMIT 10', false);
        $response = [];

        foreach ($data as $row) {
            $hotel_id = $row->id;
            $qry  = 'SELECT COUNT(*) as cnt FROM hotel_room_categories ';
            $qry .= 'JOIN room_category_costing ON (room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active") ';
            $qry .= 'WHERE hotel_room_categories.hotel_id = '.$hotel_id.' ';
            $qry .= 'AND hotel_room_categories.status="active" ';
            $qry .= 'AND date(room_category_costing.from_date) <= "'.$check_in.'" ';
            $qry .= 'AND date(room_category_costing.to_date) >= "'.$check_out.'" ';
            $result = $this->db->query($qry)->row();

            if ($result->cnt > 0) {
                $response[] = [
                    "label"    => trim($row->name),
                    "hotel_id" => $hotel_id
                ];
            }
        }

        // Add "Proceed Without Hotel" option
        $response[] = [
            "label"    => "<span style='color:red;'>NA (Proceed Without Hotel)</span>",
            "hotel_id" => "0"
        ];

        echo json_encode($response);
        exit;
    }
    
    public function get_restaurants_citywise(){
        //echo '<pre>';print_R($this->input->post());exit;
        $city = $this->input->post('city');
        $search = trim($this->input->post('search'));
        $select = 'restaurants.name,restaurants.id';
        $where = 'LOWER(restaurants.city) = "'.strtolower($city).'" AND restaurants.name LIKE "%'.$search.'%"';        
        $where .= ' AND restaurants.status = "active"';
        $data = $this->common_model->get_data('restaurants','', '', $select,$where, ' LIMIT 10', $count = false);
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name),'restaurants_id'=>$row->id);
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_sites(){
        $char = substr($this->input->post('enq_no'),1,2);
        $search = trim($this->input->post('search'));
         $city = $this->input->post('city');
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $select = 'sites.id,sites.site_name AS label,sites.days_of_operation,sites.entry_ticket_fee,sites.child_entry_ticket_fee';
        $where = 'sites.status= "active" AND LOWER(sites.country) = "'.$country[$char].'" AND sites.site_name LIKE "%'.$search.'%" AND FIND_IN_SET(LOWER("'.$city.'"), LOWER(sites.city))  LIMIT 15';
        //$join = [['type' => 'LEFT', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
    	$sites = $this->common_model->get_data('sites','', '', $select,$where,'', $count = false);
        echo json_encode($sites);
        exit;
    }
    
    public function get_activities(){
        $site_id = $this->input->post('site_id');
        $select = 'site_activities_costs.*';
        $where = 'site_activities_costs.sites_id = '.$site_id;
    	$site_activities = $this->common_model->get_data('site_activities_costs','', '', $select,$where,'', $count = false);
        echo json_encode(['response' => 's', 'details' => $site_activities, 'msg' => '']);
        exit;
    }
    
    public function get_restaurants_prices(){
        //echo '<pre>';print_R($this->input->post());exit;
        $restaurant_id = $this->input->post('restaurant_id');
        $meals = trim($this->input->post('meals'));
        $meals_type = trim($this->input->post('meals_type'));
        $select = 'restaurant_cuisine_prices.*';
        $where = 'LOWER(restaurant_cuisine_prices.type) = "'.strtolower($meals_type).'" AND LOWER(restaurant_cuisine_prices.buffet_name) = "'.strtolower($meals).'"';        
        $where .= ' AND restaurant_cuisine_prices.status = "active" AND restaurant_cuisine_prices.restaurant_id = '.$restaurant_id;
        $data = $this->common_model->get_data('restaurant_cuisine_prices','', '', $select,$where, '', $count = false);
        //echo $this->db->last_query();exit;
        if(!empty($data)){
            $data = $data[0];
        }
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function get_guides()
    {
        $city = $this->input->post('city');
        $search = trim($this->input->post('search'));
        $select = 'guides.name,guides.last_name,guides.id';
        $where = 'LOWER(guides.city) = "'.strtolower($city).'" AND guides.status = "active"';        
        $where .= ' AND (guides.name LIKE "%'.$search.'%" OR guides.last_name LIKE "%'.$search.'%")';
        $data = $this->common_model->get_data('guides','', '', $select,$where, ' LIMIT 10', $count = false);
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name).' '.trim($row->last_name),'guide_id'=>$row->id);
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_mandatory_services(){
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("auxiliary_miscellaneous.title like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(auxiliary_miscellaneous.country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('auxiliary_miscellaneous')->result();
        foreach ($records as $row) {
            // $response[] = array("t_id" => $row->id, "label" => trim($row->title),'price'=>$row->adult_price);
             $response[] = array(
                "t_id" => $row->id,
                "label" => trim($row->title),
                "price" => $row->adult_price,
                "quantity" => $row->quantity,
                "cost_by" => $row->cost_by, 
                "group_type" => $row->group_type
            );
        }
        echo json_encode($response);
    }
    
    // public function save_quotation(){
    //     //echo '<pre>';print_r(json_decode($this->input->post('quotation_arr')));
    //     //echo '<pre>';print_r(json_decode($this->input->post('hotel_arr')));exit;
    //     $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Quotation Not Saved. Try Again!</div>'];
    //     if($this->input->post('quotation_arr') <> '' && $this->input->post('hotel_arr') <> ''){
    //         $quotation_arr = json_decode($this->input->post('quotation_arr'),true);
    //         // $quotation_arr = $quotation_arr + ['created'=>date('Y-m-d H:i:s'),'modified'=>date('Y-m-d H:i:s')];
    //         if ($quotation_arr) {
    //             $quotation_arr += ['created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')];
    //         } else {
    //             echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">Invalid quotation data.</div>']);
    //             exit;
    //         }
    //         $id = $this->common_model->insert_data(['table_name' => 'quotations', 'insert_data' => $quotation_arr]);
    //         if($id){
    //             $hotel_arr = json_decode($this->input->post('hotel_arr'),true);
    //             //echo '<pre>';print_r($hotel_arr);exit;
    //             foreach($hotel_arr AS $arr){
    //                 $hotel_details[] = $arr + ['quotation_id' => $id,'created' => date('Y-m-d H:i:s')];
    //             }
    //             if(!empty($hotel_details)){
    //                 $this->common_model->insert_data_batch(['table_name' => 'quotation_hotel_details', 'insert_data' => $hotel_details]);
    //             }
    //             $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Saved Successfully!</div>'];
    //         }
    //     }
    //     echo json_encode($response);
    //     exit;
    // }
    // public function save_quotation(){
    //     $response = [
    //         'response' => 'e',
    //         'details' => '',
    //         'msg' => '<div class="alert alert-danger">Quotation Not Saved. Try Again!</div>'
    //     ];

    //     if($this->input->post('quotation_arr') && $this->input->post('hotel_arr')){

    //         $quotation_arr = json_decode($this->input->post('quotation_arr'), true);
    //         if ($quotation_arr) {
    //             $quotation_arr += [
    //                 'created' => date('Y-m-d H:i:s'),
    //                 'modified' => date('Y-m-d H:i:s')
    //             ];
    //         } else {
    //             echo json_encode([
    //                 'response' => 'e',
    //                 'msg' => '<div class="alert alert-danger">Invalid quotation data.</div>'
    //             ]);
    //             exit;
    //         }

    //         // Insert into `quotations` table
    //         $id = $this->common_model->insert_data([
    //             'table_name' => 'quotations',
    //             'insert_data' => $quotation_arr
    //         ]);

    //         if ($id) {
    //             $hotel_arr = json_decode($this->input->post('hotel_arr'), true);
    //             $hotel_details = [];

    //             foreach ($hotel_arr as $arr) {
    //                 $hotel_detail = [
    //                     'quotation_id'   => $id,
    //                     'hotel_category' => $arr['hotel_category'] ?? '',
    //                     'night'          => $arr['night'] ?? '',
    //                     'hotel_name'     => $arr['hotel_name'] ?? '',
    //                     'hotel_id'       => $arr['hotel_id'] ?? '',
    //                     'created'        => date('Y-m-d H:i:s'),
    //                 ];

    //                 // If `hotel_room_details` exists, store it as JSON
    //                 if (!empty($arr['hotel_room_details'])) {
    //                     $hotel_detail['hotel_room_details'] = json_encode($arr['hotel_room_details'], JSON_UNESCAPED_UNICODE);
    //                 } else {
    //                     $hotel_detail['hotel_room_details'] = null;
    //                 }

    //                 $hotel_details[] = $hotel_detail;
    //             }

    //             if (!empty($hotel_details)) {
    //                 $this->common_model->insert_data_batch([
    //                     'table_name'  => 'quotation_hotel_details',
    //                     'insert_data' => $hotel_details
    //                 ]);
    //             }

    //             $response = [
    //                 'response' => 's',
    //                 'details' => '',
    //                 'msg' => '<div class="alert alert-success">Saved Successfully!</div>'
    //             ];
    //         }
    //     }

    //     echo json_encode($response);
    //     exit;
    // }
    
    public function save_quotation(){
        $response = [
            'response' => 'e',
            'details' => '',
            'msg' => '<div class="alert alert-danger">Quotation Not Saved. Try Again!</div>'
        ];

        $names = $this->input->post('mandatory_services_name'); 
        $costs = $this->input->post('mandatory_services_cost');
        $qtys  = $this->input->post('mandatory_services_qnty');
        if (is_array($names)) {
            foreach ($names as $key => $name) {
                $mandatory_services[] = [
                    'service' => $name . "_|_" . $costs[$key],
                    'qnty'    => $qtys[$key]
                ];
            }
        }
        $final_transport  = $this->input->post('final_transport');
        $final_transport_without_toll  = $this->input->post('final_transport_without_toll');
        $guide_arr = $this->input->post('guide_arr');
        if (!empty($guide_arr)) {
            $guide_arr = json_decode($guide_arr, true);
        } else {
            $guide_arr = [];
        }
        $airport_pic_drop  = $this->input->post('airport_pic_drop');
        $luggage_vehicle_cost  = $this->input->post('luggage_vehicle_cost');
        $full_day_cost  = $this->input->post('full_day_cost');
        $overnight_cost  = $this->input->post('overnight_cost');
        $outside_cost  = $this->input->post('outside_cost');
        $final_toll_price  = $this->input->post('final_toll_price');
        $meal_type_price_data  = $this->input->post('meal_type_daywise_price');

        //  print_r(json_encode($mandatory_services, JSON_UNESCAPED_UNICODE));
        // exit;
        if($this->input->post('quotation_arr') && $this->input->post('hotel_arr'))
        {
            //   echo $this->input->post('hotel_arr');die();
            $quotation_arr = json_decode($this->input->post('quotation_arr'), true);
            if ($quotation_arr) {
                $quotation_arr += [
                    'mandatory_services'=>json_encode($mandatory_services, JSON_UNESCAPED_UNICODE),
                    'total_transport'=> $final_transport,
                    'total_transport_without_tol'=> $final_transport_without_toll,
                    'airport_pic_drop_cost'=> $airport_pic_drop,
                    'luggage_vehicle_cost'=> $luggage_vehicle_cost,
                    'full_day_cost'=> $full_day_cost,
                    'overnight_cost'=> $overnight_cost,
                    'outside_cost'=> $outside_cost,
                    'transport_toll'=> $final_toll_price,
                    'guide_cost' => json_encode($guide_arr, JSON_UNESCAPED_UNICODE),
                    'meal_type_daywise_price' => $meal_type_price_data,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
            } else {
                echo json_encode([
                    'response' => 'e',
                    'msg' => '<div class="alert alert-danger">Invalid quotation data.</div>'
                ]);
                exit;
            }

            $id = $this->common_model->insert_data(['table_name' => 'quotations', 'insert_data' => $quotation_arr]);
            if ($id) {
                $hotel_arr = json_decode($this->input->post('hotel_arr'), true);

                // Step 1: build a map of hotel_id => first non-empty room_details
                $hotelRoomMap = [];
                foreach ($hotel_arr as $arr) {
                    if (!empty($arr['hotel_id']) && !empty($arr['hotel_room_details']) && $arr['hotel_room_details'] !== "[]") {
                        $hotelRoomMap[$arr['hotel_id']] = $arr['hotel_room_details'];
                    }
                }

                $hotel_details = [];
                foreach ($hotel_arr as $arr) {
                    $hotel_detail = [
                        'quotation_id'   => $id,
                        'hotel_category' => $arr['hotel_category'] ?? '',
                        'night'          => $arr['night'] ?? '',
                        'hotel_name'     => $arr['hotel_name'] ?? '',
                        'hotel_id'       => $arr['hotel_id'] ?? '',
                        'created'        => date('Y-m-d H:i:s'),
                    ];

                    // Step 2: if current is blank but we have stored details for this hotel_id, reuse
                    if (!empty($arr['hotel_room_details']) && $arr['hotel_room_details'] !== "[]") {
                        // Always re-encode to string with quotes escaped
                        $hotel_detail['hotel_room_details'] = json_encode($arr['hotel_room_details'], JSON_UNESCAPED_UNICODE);
                    } elseif (!empty($arr['hotel_id']) && isset($hotelRoomMap[$arr['hotel_id']])) {
                        // Also re-encode reused values
                        $hotel_detail['hotel_room_details'] = json_encode($hotelRoomMap[$arr['hotel_id']], JSON_UNESCAPED_UNICODE);
                    } else {
                        $hotel_detail['hotel_room_details'] = null;
                    }


                    $hotel_details[] = $hotel_detail;
                }

                if (!empty($hotel_details)) {
                    $this->common_model->insert_data_batch([
                        'table_name'  => 'quotation_hotel_details',
                        'insert_data' => $hotel_details
                    ]);
                }
                $response = [
                    'response' => 's',
                    'details' => '',
                    'msg' => '<div class="alert alert-success">Saved Successfully!</div>'
                ];
            }
        }
        echo json_encode($response);
        exit;
    }
    
    public function fetch_quotation(){
        //echo '<pre>';print_r($this->input->post('id'));exit;
        $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Invalid Id. Try Again!</div>'];
        
        if($this->input->post('id') <> '' && is_numeric($this->input->post('id'))){
            $join = [['type' => 'LEFT', 'join_table' => 'quotation_hotel_details', 'condition' => 'quotations.id = quotation_hotel_details.quotation_id'],];
            $where = ' quotations.id = '.$this->input->post('id');
            $select = 'quotations.*,quotation_hotel_details.hotel_category,quotation_hotel_details.hotel_name,quotation_hotel_details.hotel_id,quotation_hotel_details.hotel_room_details,quotation_hotel_details.night';
            $data['quotation'] = $this->common_model->get_data('quotations','', '', $select,$where,'', $count = false,$join);
            //echo '<pre>';print_r($data['quotation']);exit;
            $data['sites_table_data'] = $this->db->get('sites')->result_array();
             $data['hotels'] = $this->db->where('quotation_id', $this->input->post('id'))->get('quotation_hotel_details')->result_array();
            $data['saved_hotels'] = $this->db->where('quotation_id', $this->input->post('id'))->get('quotation_hotel_details')->result_array();
            $response = ['response' => 's', 'details' => $data, 'msg' => '<div class="alert alert-success">Quotation Found Successfully!</div>'];
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_by_id(){
        //echo '<pre>';print_r($this->input->post());exit;
        $table_name = $this->input->post('tname');
        $where = $table_name.'.id = '.$this->input->post('id');
        $select = '*';
        $data['result'] = $this->common_model->get_data($table_name,'', '', $select,$where,'', $count = false);
        $response = ['response' => 's', 'details' => $data, 'msg' => ''];
        echo json_encode($response);
        exit;
    }
    public function getItineraryContent()
    {   
        $enquiry_no = $this->input->get('enquiry_no');

        $sql = "
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = ?
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        ";

        $result = $this->db->query($sql, [$enquiry_no])->result();
        $siteData = "
            SELECT id, site_name, description
            FROM sites 
            WHERE id IN (199, 43, 30, 18, 19);";
        $siteResult = $this->db->query($siteData)->result();

        $firstDay = '';
        $lastDay  = '';

        if (!empty($result)) {
            foreach ($result as $row) {
                $decodedContent = urldecode($row->content); 
                $decodedContent = html_entity_decode($decodedContent, ENT_QUOTES, 'UTF-8');

                if ($row->day == 'start') {
                    $firstDay = $decodedContent;
                }
                if ($row->day == 'last') {
                    $lastDay = $decodedContent;
                }
            }
        }

        echo json_encode([
            'status'   => 'success',
            'firstDay' => $firstDay,
            'lastDay'  => $lastDay,
            'siteData' => $siteResult,
        ]);
    }
    // public function generate_itinerary()
    // {
    //     $check_in_time = $this->input->post('arrival_time');
    //     $check_out_time = $this->input->post('departure_time');
    //     $check_in_date = $this->input->post('check_in');
    //     $check_out_date = $this->input->post('check_out');

    //     $this->db->where('city', 'Almaty');
    //     $this->db->where('category', 'sitescene');
    //     $query = $this->db->get('sites'); 
    //     $sites = $query->result_array();

    //     if (empty($sites)) {
    //         echo "No sites found in the database.";
    //         return;
    //     }

    //     $siteDescriptions = array_map(function($site) {
    //         return $site['id'] . '. ' . $site['site_name'] . 
    //         ' (Duration: ' . $site['duration_hours'] . 'h, Days: ' . $site['days_of_operation'] . 
    //         ', Location ID: ' . $site['location_ids'] . ', Start Time: ' . $site['departing_time_from_hotel'] .
    //         ', Entry Fee: ' . $site['entry_ticket_fee'] . ', Child Fee: ' . $site['child_entry_ticket_fee'] . ')';
    //     }, $sites);
    //     $siteList = implode(", ", $siteDescriptions);

    //     $start = new DateTime($check_in_date);
    //     $end = new DateTime($check_out_date);
    //     $end->modify('+1 day'); // include checkout day
    //     $interval = new DateInterval('P1D');
    //     $dateRange = new DatePeriod($start, $interval, $end);

    //     $days = [];
    //     foreach ($dateRange as $index => $date) {
    //         $dayNum = $index + 1;
    //         $dayName = $date->format('l'); // Monday, Tuesday etc
    //         $dateStr = $date->format('Y-m-d');
    //         $days[] = [
    //             'day' => $dayNum,
    //             'date' => $dateStr,
    //             'day_name' => $dayName
    //         ];
    //     }

    //     $dayConditions = [];
    //     foreach ($days as $day) {
    //         if ($day['day'] === 1 || $day['day'] === count($days)) {
    //             $dayConditions[] = "Day {$day['day']} ({$day['date']}) is for location_id = 0 (inside city only)";
    //         } else {
    //             $dayConditions[] = "Day {$day['day']} ({$day['date']}) allows 1 site with location_id != 0 (outside city) first, then location_id = 0 if time remains.";
    //         }
    //     }

    //     $dayLogic = implode("\n- ", $dayConditions);
        
    //     $prompt = <<<EOD
    //     You are a travel itinerary planner for tourists visiting Kazakhstan.

    //     Generate a JSON itinerary using the following site list:
    //     $siteList

    //     Constraints:

    //     1. **Travel Dates**:
    //     - Check-in: $check_in_date at $check_in_time
    //     - Check-out: $check_out_date at $check_out_time

    //     2. **General Rules**:
    //     - Activities must not overlap.
    //     - Insert a **1-hour rest gap** between activities.
    //     - Include `departing_time_from_hotel`, `start_time`, `end_time`, and `duration_hours` in each activity.
    //         - Each activity must start at or after departing_time_from_hotel, which is the same as start_time
    //         - No activity should begin before start_time.

    //     3. **Day 1 (Arrival Day)**:
    //     - If check-in time is after 17:00 (5:00 PM), skip Day 1 entirely — no activity should be scheduled.
    //     - If check-in time is before 08:00 AM, start the first activity from **10:00 AM** onward.
    //     - If check-in time is between 08:00 and 17:00:
    //         - Allow Day 1 activities only if (check-in time + 2 hours) is before 22:00.
    //         - First activity must start after (check-in + 2 hours).
    //         - No activity should end after 22:00.


    //     4. **Middle Days (Day 2 to Day N-1)**:
    //     - Activities must start no earlier than **10:00 AM**.
    //     - Activities must end no later than **10:00 PM**.

    //     5. **Last Day (Checkout Day)**:
    //     - If check-out time is before 15:00 (3:00 PM), do not schedule any activities on the last day. Skip Last Day completely.
    //     - If check-out time is **at or after 15:00 (3:00 PM)**:
    //         - Activities may be scheduled only if they can **end at least 5 hours before check-out time**.
    //         - No activity should end later than **(check-out time - 5 hours)**.

    //     6. **Day Tagging**:
    //     - Include `day`, `date`, and list of `activities` for each day.
    //     - Ensure dates are sequential from check-in to check-out.

    //     - $dayLogic

    //     Output format: JSON array. Each object must have:

    //     ```json
    //     {
    //     "day": 1,
    //     "date": "YYYY-MM-DD",
    //     "activities": [
    //         {
    //         "id": 0,
    //         "site_name": "...",
    //         "start_time": "HH:MM",
    //         "end_time": "HH:MM",
    //         "duration_hours": 0,
    //         "departing_time_from_hotel": "HH:MM",
    //         "entry_ticket_fee": 0,
    //         "child_entry_ticket_fee": 0,
    //         "day_of_operation_used": "Monday"
    //         }
    //     ]
    //     }
    //     EOD;

    //     $apiKey = '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';
    //     $endpoint = 'https://api.openai.com/v1/chat/completions';

    //     $postData = [
    //         'model' => 'gpt-4o-mini',
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You are a helpful travel planner. Respond only with valid JSON.'],
    //             ['role' => 'user', 'content' => $prompt]
    //         ],
    //         'temperature' => 0.7
    //     ];

    //     $headers = [
    //         'Content-Type: application/json',
    //         'Authorization: ' . 'Bearer ' . $apiKey
    //     ];

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $endpoint);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     $result = json_decode($response, true);

    //     if (isset($result['choices'][0]['message']['content'])) {
    //         $content = $result['choices'][0]['message']['content'];

    //         $cleaned = trim($content);
    //         $cleaned = preg_replace('/^```(json)?/i', '', $cleaned); 
    //         $cleaned = preg_replace('/```$/', '', $cleaned);       
    //         $cleaned = str_replace(['“', '”'], '"', $cleaned);

    //         $itinerary = json_decode($cleaned, true);

    //         if (json_last_error() === JSON_ERROR_NONE) 
    //         {
    //             header('Content-Type: application/json');
    //             echo json_encode($itinerary);
    //         } else {
    //             http_response_code(500);
    //             echo json_encode([
    //                 'error' => 'JSON parsing failed',
    //                 'raw_response' => $content,
    //                 'error_message' => json_last_error_msg()
    //             ]);
    //         }

    //     } else {
    //         echo "❌ Failed to generate itinerary: <pre>" . print_r($result, true) . "</pre>";
    //     }
    // }
    
    
    
    
    
    // public function checkCityNights()
    // {   
    //     $city = $this->input->post('city');

    //     // Step 1: Get site details
    //     $site = $this->db->select('id, city, no_of_nights, entry_ticket_fee, child_entry_ticket_fee')
    //                     ->from('sites')
    //                     ->where('city', $city)
    //                     ->get()
    //                     ->row();

    //     if (!$site) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'City not found in sites table'
    //         ]);
    //         return;
    //     }

    //     // Step 2: Get overnight_itinerary rows with days
    //     $overnightItineraries = $this->db->select('id, itinerary_id, site_ids, days')
    //                                     ->from('overnight_itinerary')
    //                                     ->where('itinerary_id', $site->id)
    //                                     ->get()
    //                                     ->result_array();

    //     $relatedSitesByDay = [];

    //     if (!empty($overnightItineraries)) {
    //         foreach ($overnightItineraries as $row) {
    //             // Fetch site details for each site_id
    //             $siteDetail = $this->db->select('id, city, site_name, no_of_nights, entry_ticket_fee, child_entry_ticket_fee')
    //                                 ->from('sites')
    //                                 ->where('id', $row['site_ids'])
    //                                 ->get()
    //                                 ->row_array();

    //             if ($siteDetail) {
    //                 $relatedSitesByDay['day' . $row['days']][] = $siteDetail;
    //             }
    //         }
    //     }

    //     echo json_encode([
    //         'status' => 'success',
    //         'city' => $site->city,
    //         'no_of_nights' => $site->no_of_nights,
    //         'site_id' => $site->id,
    //         'related_sites' => $relatedSitesByDay
    //     ]);
    // }
    
     public function checkCityNights()
    {   
        $city   = $this->input->post('city');
        $nights = $this->input->post('nights'); // number of times city appears

        // Step 1: Try to get site details with both city + no_of_nights match
        $this->db->select('id, city, no_of_nights, entry_ticket_fee, child_entry_ticket_fee');
        $this->db->from('sites');
        $this->db->where('city', $city);

        if (!empty($nights) && intval($nights) > 0) {
            $this->db->where('no_of_nights', intval($nights));
        }

        $site = $this->db->get()->row();

        // Step 2: If not found, fallback to city only
        if (!$site) {
            $site = $this->db->select('id, city, no_of_nights, entry_ticket_fee, child_entry_ticket_fee')
                            ->from('sites')
                            ->where('city', $city)
                            ->get()
                            ->row();
        }

        if (!$site) {
            echo json_encode([
                'status' => 'error',
                'message' => 'City not found in sites table'
            ]);
            return;
        }

        // Step 3: Get overnight_itinerary rows with days
        $overnightItineraries = $this->db->select('id, itinerary_id, site_ids, days')
                                        ->from('overnight_itinerary')
                                        ->where('itinerary_id', $site->id)
                                        ->get()
                                        ->result_array();

        $relatedSitesByDay = [];

        if (!empty($overnightItineraries)) {
            foreach ($overnightItineraries as $row) {
                $siteDetail = $this->db->select('id, city, site_name, no_of_nights, entry_ticket_fee, child_entry_ticket_fee')
                                    ->from('sites')
                                    ->where('id', $row['site_ids'])
                                    ->get()
                                    ->row_array();

                if ($siteDetail) {
                    $relatedSitesByDay['day' . $row['days']][] = $siteDetail;
                }
            }
        }

        echo json_encode([
            'status' => 'success',
            'city' => $site->city,
            'no_of_nights' => $site->no_of_nights,
            'site_id' => $site->id,
            'related_sites' => $relatedSitesByDay
        ]);
    }
    
    public function generate_itinerary()
    {
        $check_in_time = $this->input->post('arrival_time');
        $check_out_time = $this->input->post('departure_time');
        $check_in_date = $this->input->post('check_in');
        $check_out_date = $this->input->post('check_out');

        $this->db->where('city', 'Almaty');
        $this->db->where('category', 'sitescene');
        $query = $this->db->get('sites'); 
        $sites = $query->result_array();

        if (empty($sites)) {
            echo "No sites found in the database.";
            return;
        }

        $siteDescriptions = array_map(function($site) {
            return $site['id'] . '. ' . $site['site_name'] . 
            ' (Duration: ' . $site['duration_hours'] . 'h, Days: ' . $site['days_of_operation'] . 
            ', Location ID: ' . $site['location_ids'] . ', Start Time: ' . $site['departing_time_from_hotel'] .
            ', Entry Fee: ' . $site['entry_ticket_fee'] . ', Child Fee: ' . $site['child_entry_ticket_fee'] . ')';
        }, $sites);
        $siteList = implode(", ", $siteDescriptions);

        $start = new DateTime($check_in_date);
        $end = new DateTime($check_out_date);
        $end->modify('+1 day'); // include checkout day
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($start, $interval, $end);

        $days = [];
        foreach ($dateRange as $index => $date) {
            $dayNum = $index + 1;
            $dayName = $date->format('l'); // Monday, Tuesday etc
            $dateStr = $date->format('Y-m-d');
            $days[] = [
                'day' => $dayNum,
                'date' => $dateStr,
                'day_name' => $dayName
            ];
        }

        $dayConditions = [];
        foreach ($days as $day) {
            if ($day['day'] === 1 || $day['day'] === count($days)) {
                $dayConditions[] = "Day {$day['day']} ({$day['date']}) is for location_id = 0 (inside city only)";
            } else {
                $dayConditions[] = "Day {$day['day']} ({$day['date']}) allows 1 site with location_id != 0 (outside city) first, then location_id = 0 if time remains.";
            }
        }

        $dayLogic = implode("\n- ", $dayConditions);
        
        $prompt = <<<EOD
        You are a travel itinerary planner for tourists visiting Kazakhstan.

        Generate a JSON itinerary using the following site list:
        $siteList

        Constraints:

        1. **Travel Dates**:
        - Check-in: $check_in_date at $check_in_time
        - Check-out: $check_out_date at $check_out_time

        2. **General Rules**:
        - Activities must not overlap.
        - Insert a **1-hour rest gap** between activities.
        - Include `departing_time_from_hotel`, `start_time`, `end_time`, and `duration_hours` in each activity.
            - Each activity must start at or after departing_time_from_hotel, which is the same as start_time
            - No activity should begin before start_time.

        3. **Day 1 (Arrival Day)**:
        - If check-in time is after 17:00 (5:00 PM), skip Day 1 entirely — no activity should be scheduled.
        - If check-in time is before 08:00 AM, start the first activity from **10:00 AM** onward.
        - If check-in time is between 08:00 and 17:00:
            - Allow Day 1 activities only if (check-in time + 2 hours) is before 22:00.
            - First activity must start after (check-in + 2 hours).
            - No activity should end after 22:00.


        4. **Middle Days (Day 2 to Day N-1)**:
        - Activities must start no earlier than **10:00 AM**.
        - Activities must end no later than **10:00 PM**.

        5. **Last Day (Checkout Day)**:
        - If check-out time is before 15:00 (3:00 PM), do not schedule any activities on the last day. Skip Last Day completely.
        - If check-out time is **at or after 15:00 (3:00 PM)**:
            - Activities may be scheduled only if they can **end at least 5 hours before check-out time**.
            - No activity should end later than **(check-out time - 5 hours)**.

        6. **Day Tagging**:
        - Include `day`, `date`, and list of `activities` for each day.
        - Ensure dates are sequential from check-in to check-out.

        - $dayLogic

        Output format: JSON array. Each object must have:

        ```json
        {
        "day": 1,
        "date": "YYYY-MM-DD",
        "activities": [
            {
            "id": 0,
            "site_name": "...",
            "start_time": "HH:MM",
            "end_time": "HH:MM",
            "duration_hours": 0,
            "departing_time_from_hotel": "HH:MM",
            "entry_ticket_fee": 0,
            "child_entry_ticket_fee": 0,
            "day_of_operation_used": "Monday"
            }
        ]
        }
        EOD;
        $apiKey = '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';

        // $apiKey = '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';
        $endpoint = 'https://api.openai.com/v1/chat/completions';

        $postData = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful travel planner. Respond only with valid JSON.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer ' . $apiKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['choices'][0]['message']['content'])) {
            $content = $result['choices'][0]['message']['content'];

            $cleaned = trim($content);
            $cleaned = preg_replace('/^```(json)?/i', '', $cleaned); 
            $cleaned = preg_replace('/```$/', '', $cleaned);       
            $cleaned = str_replace(['“', '”'], '"', $cleaned);

            $itinerary = json_decode($cleaned, true);

            if (json_last_error() === JSON_ERROR_NONE) 
            {
                header('Content-Type: application/json');
                echo json_encode($itinerary);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'JSON parsing failed',
                    'raw_response' => $content,
                    'error_message' => json_last_error_msg()
                ]);
            }

        } else {
            echo "❌ Failed to generate itinerary: <pre>" . print_r($result, true) . "</pre>";
        }
    
    }
    
}