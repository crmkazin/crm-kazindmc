<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'sendinblue/vendor/autoload.php';
class BudgetReport extends CI_Controller {
    
    var $locations = LOCATIONS;
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
    }		

    // ************************************* 29 Dec 2025 ************************************
	public function original_budget_report($id){
        $data['title'] = 'Budget Report';
        $decoded_id = base64_decode($id);
        
        $this->db->select('enquiry.id as enq_id,enquiry.*, quotations.*');
        $this->db->from('enquiry');
        $this->db->join('quotations', 'quotations.enquiry_id = enquiry.id', 'left');
        $this->db->where('enquiry.id', $decoded_id);
        $this->db->where('quotations.quot_final', 'yes');
        
        $data['report'] = $this->db->get()->row();
        $data['encoded_id'] = $id; 

        // Check for Excel download request
        if ($this->input->get('excel_download') == '1') {
            $this->original_budget_report_excel_download($data['report']);
            exit;
        }
        
        $this->load->view('admin/original_budget_report', $data);
    }
    
    public function budget_report($id){
        $data['title'] = 'Budget Report';
        $decoded_id = base64_decode($id);
        
        $this->db->select('enquiry.id as enq_id,enquiry.*, quotations.*');
        $this->db->from('enquiry');
        $this->db->join('quotations', 'quotations.enquiry_id = enquiry.id', 'left');
        $this->db->where('enquiry.id', $decoded_id);
        $this->db->where('quotations.quot_final', 'yes');
        
        $data['report'] = $this->db->get()->row();
        
        $this->load->view('admin/budget_report_arrival', $data);
    }

    public function save_budget_data() 
    {
        header('Content-Type: application/json');
        
        $postData = json_decode(file_get_contents('php://input'), true);
        $enquiry_id = $postData['enquiry_id'] ?? 0;
        $quote_id = $postData['quote_id'] ?? 0;
        $data = $postData['data'] ?? [];
        
        if (!$enquiry_id || empty($data)) {
            echo json_encode(['success' => false, 'message' => 'Invalid data. Enquiry ID: ' . $enquiry_id]);
            return;
        }
        
        try {
            // Calculate totals if not provided
            $total_budget = isset($data['margins']['total_budget']) ? floatval($data['margins']['total_budget']) : 0;
            $total_actual = isset($data['margins']['total_actual']) ? floatval($data['margins']['total_actual']) : 0;
            $margin = isset($data['margins']['total_margin']) ? floatval($data['margins']['total_margin']) : 0;
            $margin_percentage = isset($data['margins']['margin_percentage']) ? floatval($data['margins']['margin_percentage']) : 0;
            $exchange_rate = isset($data['totals']['actual_exchange_rate']) ? floatval($data['totals']['actual_exchange_rate']) : 0;
            
            // USD amounts
            $usd_budget = isset($data['margins']['usd_budget']) ? floatval($data['margins']['usd_budget']) : 0;
            $usd_actual = isset($data['margins']['usd_actual']) ? floatval($data['margins']['usd_actual']) : 0;
            $usd_margin = isset($data['margins']['usd_margin']) ? floatval($data['margins']['usd_margin']) : 0;
            $usd_margin_percentage = isset($data['margins']['usd_margin_percentage']) ? floatval($data['margins']['usd_margin_percentage']) : 0;
            
            // Save to database
            $savedData = [
                'enquiry_id' => $enquiry_id,
                'quote_id' => $quote_id,
                'saved_data' => json_encode($data),
                'total_budget' => $total_budget,
                'total_actual' => $total_actual,
                'margin' => $margin,
                'margin_percentage' => $margin_percentage,
                'exchange_rate' => $exchange_rate,
                'usd_budget' => $usd_budget,
                'usd_actual' => $usd_actual,
                'usd_margin' => $usd_margin,
                'usd_margin_percentage' => $usd_margin_percentage,
                'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // Check if already exists
           // $existing = $this->db->where('enquiry_id', $enquiry_id)->get('saved_budget_reports')->row();
            
            // if ($existing) {
            //     $this->db->where('id', $existing->id)->update('saved_budget_reports', $savedData);
            //     $action = 'updated';
            // } else {
                $this->db->insert('saved_budget_reports', $savedData);
                $action = 'inserted';
           // }
            
            echo json_encode([
                'success' => true, 
                'message' => 'Budget report saved successfully',
                'action' => $action
            ]);
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }
    
    public function view_saved_budget($id) {
      $decoded_id = base64_decode($id);
        
        // Original report data fetch karein
        $this->db->select('enquiry.id as enq_id, enquiry.*, quotations.*');
        $this->db->from('enquiry');
        $this->db->join('quotations', 'quotations.enquiry_id = enquiry.id', 'left');
        $this->db->where('enquiry.id', $decoded_id);
        $this->db->where('quotations.quot_final', 'yes');
        
        $data['report'] = $this->db->get()->row();
        
        // Saved budget report data fetch karein
        $this->db->where(['quote_id' => $data['report']->id, 'enquiry_id' => $data['report']->enq_id]);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $saved_report = $this->db->get('saved_budget_reports')->row();
        
        if ($saved_report) {
            $data['saved_data'] = json_decode($saved_report->saved_data, true);
            $data['saved_date'] = $saved_report->created_at;
        } else {
            $data['saved_data'] = null;
        }
        $data['encoded_id'] = $id; 
        
        // Check for Excel download request
        if ($this->input->get('excel_download') == '1' && $data['saved_data']) {
            $this->saved_budget_excel_download($data['report'], $data['saved_data']);
            exit;
        }
        
        $data['title'] = 'Saved Budget Report';
        
        $this->load->view('admin/view_saved_budget_report', $data);
    }
        
     // original budget report excel download funcationality
    public function original_budget_report_excel_download($report)
    {
        // Clean output buffer
        if (ob_get_length()) ob_end_clean();

        // Decode JSON fields
        $guideCosts = json_decode($report->guide_cost, true);
        $luggageData = json_decode($report->luggage_vehicle_cost ?? '[]', true);
        $ticketCosts = json_decode($report->ticket_cost ?? '[]', true);
        $mandatoryServices = json_decode($report->mandatory_services ?? '[]', true);
        $mandatoryChildServices = json_decode($report->child_mandatory_services ?? '[]', true);
        $outside_cost = json_decode($report->outside_cost ?? '[]', true);
        $activity_cost = json_decode($report->activity_cost ?? '[]', true);
        $entrance_cost = json_decode($report->entrance_cost ?? '[]', true);
        $hotel_cost = json_decode($report->hotel_cost ?? '[]', true);
        $totalTransport = $report->total_transport ?? 0;
        $discount_bundle_price = $report->discount_bundle_price ?? 0;
        $itinerary_details = $report->itinerary_details ?? '';
        $meal_type_daywise_price = $report->meal_type_daywise_price ?? '';
        $entertainment_daywise_price = $report->daywise_entertainment ?? '';
        $driverCosts = json_decode($report->driver_cost ?? '[]', true);
        $markup_split = $report->markup_split ?? 'no';
        $daywise_train = $report->daywise_train ?? 0;
        $fullDayCost = $report->full_day_cost ?? 0;
        $airport_pic_drop = json_decode($report->airport_pic_drop_cost ?? '[]', true);
        
        // Meal & entertainment data
        $mealData = $meal_type_daywise_price ? json_decode($meal_type_daywise_price, true) : [];
        $entertainmentData = $entertainment_daywise_price ? json_decode($entertainment_daywise_price, true) : [];
        
        // Date calculations
        $startDate = $report->check_in_date ?? date('Y-m-d');
        $endDate = $report->check_out_date ?? date('Y-m-d', strtotime($startDate . ' + 6 days'));
        $startDateTime = new DateTime($startDate);
        $endDateTime = new DateTime($endDate);
        $totalDays = $endDateTime->diff($startDateTime)->days + 1;
        $lastDay = $totalDays - 1;
        
        $exchangeRate = $report->roe;
        
        // Currency abbreviation
        $currency_query = $this->db->select('currency_abbr')->from('currency_value')->where('currency_name', $report->currency)->get();
        $currency_abbr = ($currency_query->num_rows() > 0) ? $currency_query->row()->currency_abbr : '';
        
        // Itinerary mapping for outside costs
        $itineraryDays = [];
        if ($itinerary_details) {
            $itineraryData = json_decode($itinerary_details, true);
            if (is_array($itineraryData)) {
                foreach ($itineraryData as $dayKey => $dayData) {
                    $dayNumber = (int)str_replace('itinerary_sites_id_', '', $dayKey) - 1;
                    if ($dayNumber >= 0) {
                        $itineraryDays[$dayNumber] = $dayData['itinerary'] ?? [];
                    }
                }
            }
        }
        
        $itemsByDate = [];
        
        // Helper functions
        function addItemToDate(&$itemsByDate, $startDate, $dayNumber, $service, $frequency, $rate, $total, $type = 'service', $remarks = '', $itemId = '') {
            $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $dayNumber . ' days'));
            $displayDate = date('d M', strtotime($startDate . ' + ' . $dayNumber . ' days'));
            if (!isset($itemsByDate[$dateKey])) {
                $itemsByDate[$dateKey] = ['display_date' => $displayDate, 'date_key' => $dateKey, 'items' => []];
            }
            $itemsByDate[$dateKey]['items'][] = [
                'service' => $service,
                'frequency' => $frequency,
                'rate' => $rate,
                'total' => $total,
                'type' => $type,
                'remarks' => $remarks,
                'item_id' => $itemId ?: uniqid()
            ];
        }
        
        function generateItemId($type, $index) {
            return $type . '_' . $index;
        }
        
        // ----- Airport Pickup/Drop (included in bundle) -----
        if (!empty($airport_pic_drop) && is_array($airport_pic_drop)) {
            foreach ($airport_pic_drop as $transfer) {
                $type = $transfer['type'] ?? '';
                $vehicleName = $transfer['vehicle_name'] ?? 'Vehicle';
                $quantity = (int)($transfer['quantity'] ?? 1);
                if ($quantity <= 0) continue;
                if ($type === 'pickup') {
                    $dayNumber = 0;
                    $serviceName = "Airport Pickup ($vehicleName) - Included in bundle";
                } elseif ($type === 'drop') {
                    $dayNumber = $lastDay;
                    $serviceName = "Airport Drop-off ($vehicleName) - Included in bundle";
                } else {
                    continue;
                }
                addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, 1, 0, 0, 'airport_transfer', 'Price included in transport bundle', generateItemId('airport_transfer', $type));
            }
        }
        
        // ----- HOTEL COST (full logic with cutoff) -----
        $updated_hotel_cutoff_date = '2026-05-28';
        $mark_final_date = $report->modified;
        // Initialize hotel_cost and room_breakdown_data
        $hotel_cost = json_decode($report->hotel_cost ?? '[]', true);
        if (!is_array($hotel_cost)) $hotel_cost = [];
        $room_breakdown_data = json_decode($report->room_breakdown ?? '[]', true);
        if (!is_array($room_breakdown_data)) $room_breakdown_data = [];
        
        $adultLookup = [];
        $adultLookupById = [];
        foreach ($room_breakdown_data as $hotelData) {
            $hotelName = trim($hotelData['hotel_name'] ?? '');
            $hotelId = $hotelData['hotel_id'] ?? null;
            $rooms = $hotelData['rooms'] ?? [];
            foreach ($rooms as $roomInfo) {
                $roomName = trim($roomInfo['room_name'] ?? '');
                foreach ($roomInfo['occupancies'] ?? [] as $occ) {
                    $occupancy = (int)($occ['occupancy'] ?? 0);
                    $roomCount = (int)($occ['room_count'] ?? 0);
                    if ($roomCount > 0) {
                        $key = $hotelName . '|' . $roomName . '|' . $occupancy;
                        $adultLookup[$key] = ($adultLookup[$key] ?? 0) + $roomCount;
                        if ($hotelId) {
                            $keyById = $hotelId . '|' . $roomName . '|' . $occupancy;
                            $adultLookupById[$keyById] = ($adultLookupById[$keyById] ?? 0) + $roomCount;
                        }
                    }
                }
            }
        }
        
        $childLookupPerRoom = [];
        $childLookupPerRoomById = [];
        foreach ($room_breakdown_data as $hotelData) {
            $hotelName = trim($hotelData['hotel_name'] ?? '');
            $hotelId = $hotelData['hotel_id'] ?? null;
            $rooms = $hotelData['rooms'] ?? [];
            foreach ($rooms as $roomInfo) {
                $roomName = trim($roomInfo['room_name'] ?? '');
                $children = $roomInfo['children'] ?? [];
                foreach ($children as $child) {
                    $type = strtoupper($child['type'] ?? '');
                    $count = (int)($child['count'] ?? 0);
                    if ($count > 0 && in_array($type, ['CNB', 'CWB'])) {
                        $key = $hotelName . '|' . $roomName . '|' . $type;
                        $childLookupPerRoom[$key] = ($childLookupPerRoom[$key] ?? 0) + $count;
                        if ($hotelId) {
                            $keyById = $hotelId . '|' . $roomName . '|' . $type;
                            $childLookupPerRoomById[$keyById] = ($childLookupPerRoomById[$keyById] ?? 0) + $count;
                        }
                    }
                }
            }
        }
        
        $occupancyMapping = [
            'Single Occupancy' => 1, 'Double Occupancy' => 2, 'Triple Occupancy' => 3,
            'Quad Occupancy' => 4, 'Quint Occupancy' => 5, 'Sext Occupancy' => 6
        ];
        $tripNights = (int)($report->total_nights ?? 1);
        $hotelItems = [];
        
        // Process hotel_cost (both new and old format)
        if ($mark_final_date >= $updated_hotel_cutoff_date) {
            // Use new hotel logic (with ID matching)
            foreach ($hotel_cost as $hotelCategory => $hotels) {
                foreach ($hotels as $hotelNameRaw => $roomData) {
                    $cleanHotelName = trim(preg_replace('/_\d+(?:_\d+)*$/', '', $hotelNameRaw));
                    $isNewFormat = isset($roomData['hotel_id']) || isset($roomData['hotel_city']) || isset($roomData['nights']);
                    if ($isNewFormat) {
                        $hotelNights = $roomData['nights'] ?? [];
                        $totalNightsForHotel = count($hotelNights);
                        if ($totalNightsForHotel == 0 && preg_match('/_(\d+(?:_\d+)*)$/', $hotelNameRaw, $matches)) {
                            $totalNightsForHotel = count(explode('_', $matches[1]));
                        }
                        if ($totalNightsForHotel == 0) $totalNightsForHotel = $tripNights;
                        
                        foreach ($roomData as $key => $value) {
                            if (in_array($key, ['hotel_id', 'hotel_city', 'nights', 'hotel_name'])) continue;
                            if (strpos($key, '_nights_') !== false) {
                                $parts = explode('_nights_', $key);
                                $roomType = trim($parts[0]);
                                $nightNumbers = explode('_', $parts[1]);
                                $nightsCount = count($nightNumbers);
                            } else {
                                $roomType = trim($key);
                                $nightsCount = $totalNightsForHotel;
                            }
                            if (!is_array($value)) $value = [$value];
                            foreach ($value as $occupancyString) {
                                if (!is_string($occupancyString) || strpos($occupancyString, '__') === false) continue;
                                list($occupancyType, $cost) = explode('__', $occupancyString);
                                $cost = (float)$cost;
                                if (isset($occupancyMapping[$occupancyType])) {
                                    $capacity = $occupancyMapping[$occupancyType];
                                    $roomCount = 0;
                                    if (!empty($roomData['hotel_id'])) {
                                        $lookupKeyById = $roomData['hotel_id'] . '|' . $roomType . '|' . $capacity;
                                        $roomCount = $adultLookupById[$lookupKeyById] ?? 0;
                                    }
                                    if ($roomCount == 0) {
                                        $lookupKey = $cleanHotelName . '|' . $roomType . '|' . $capacity;
                                        $roomCount = $adultLookup[$lookupKey] ?? 0;
                                    }
                                    if ($roomCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType ($occupancyType)";
                                    $frequency = $roomCount;
                                    if ($markup_split == 'yes') {
                                        $rate = $cost;
                                        $total = $rate * $roomCount * $nightsCount;
                                    } else {
                                        $rate = $cost * $capacity;
                                        $total = $rate * $roomCount;
                                    }
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_adult'];
                                } elseif ($occupancyType === 'CNB Occupancy') {
                                    $childCount = 0;
                                    if (!empty($roomData['hotel_id'])) {
                                        $childLookupKeyById = $roomData['hotel_id'] . '|' . $roomType . '|CNB';
                                        $childCount = $childLookupPerRoomById[$childLookupKeyById] ?? 0;
                                    }
                                    if ($childCount == 0) {
                                        $childLookupKey = $cleanHotelName . '|' . $roomType . '|CNB';
                                        $childCount = $childLookupPerRoom[$childLookupKey] ?? 0;
                                    }
                                    if ($childCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType (CNB)";
                                    $frequency = $childCount;
                                    $rate = $cost;
                                    $total = ($markup_split == 'yes') ? $rate * $frequency : $rate * $frequency * $nightsCount;
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cnb'];
                                } elseif ($occupancyType === 'CWB Occupancy') {
                                    $childCount = 0;
                                    if (!empty($roomData['hotel_id'])) {
                                        $childLookupKeyById = $roomData['hotel_id'] . '|' . $roomType . '|CWB';
                                        $childCount = $childLookupPerRoomById[$childLookupKeyById] ?? 0;
                                    }
                                    if ($childCount == 0) {
                                        $childLookupKey = $cleanHotelName . '|' . $roomType . '|CWB';
                                        $childCount = $childLookupPerRoom[$childLookupKey] ?? 0;
                                    }
                                    if ($childCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType (CWB)";
                                    $frequency = $childCount;
                                    $rate = $cost;
                                    $effectiveNights = ($nightsCount > 0) ? $nightsCount : 1;
                                    $total = ($markup_split == 'yes') ? $rate * $frequency : $rate * $frequency * $effectiveNights;
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cwb'];
                                }
                            }
                        }
                    } else {
                        // Old format (no nights array)
                        $nightsCount = $tripNights;
                        foreach ($roomData as $roomType => $occupancyArray) {
                            foreach ($occupancyArray as $occupancyString) {
                                if (!is_string($occupancyString) || strpos($occupancyString, '__') === false) continue;
                                list($occupancyType, $cost) = explode('__', $occupancyString);
                                $cost = (float)$cost;
                                if (isset($occupancyMapping[$occupancyType])) {
                                    $capacity = $occupancyMapping[$occupancyType];
                                    $lookupKey = $cleanHotelName . '|' . $roomType . '|' . $capacity;
                                    $roomCount = $adultLookup[$lookupKey] ?? 0;
                                    if ($roomCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType ($occupancyType)";
                                    $frequency = $roomCount;
                                    if ($markup_split == 'yes') {
                                        $rate = $cost;
                                        $total = $rate * $roomCount * $nightsCount;
                                    } else {
                                        $rate = $cost * $capacity;
                                        $total = $rate * $roomCount;
                                    }
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_adult'];
                                }
                            }
                        }
                    }
                }
            }
        } else {
            // Old hotel logic (pre‑cutoff) – simplified, works with room_breakdown
            $hotelItems = [];
            $adultLookupByCapacity = [];
            $isSimpleFormat = false;
            $possibleRoomTypes = ['single', 'double', 'triple', 'quad', 'quint', 'sext'];
            $topKeys = array_keys($room_breakdown_data);
            if (!empty($topKeys) && count(array_intersect($topKeys, $possibleRoomTypes)) > 0 && !isset($room_breakdown_data['hotel_name'])) {
                $isSimpleFormat = true;
                foreach ($room_breakdown_data as $roomTypeKey => $roomInfo) {
                    $capacity = $roomInfo['capacity_per_room'] ?? 1;
                    $roomCount = $roomInfo['room_count'] ?? 0;
                    if ($roomCount > 0) {
                        $adultLookupByCapacity[$capacity] = ($adultLookupByCapacity[$capacity] ?? 0) + $roomCount;
                    }
                }
            }
            foreach ($hotel_cost as $hotelCategory => $hotels) {
                foreach ($hotels as $hotelNameRaw => $roomData) {
                    $cleanHotelName = trim(preg_replace('/_\d+(?:_\d+)*$/', '', $hotelNameRaw));
                    $isNewFormat = isset($roomData['hotel_id']) || isset($roomData['hotel_city']) || isset($roomData['nights']);
                    if ($isNewFormat) {
                        $hotelNights = $roomData['nights'] ?? [];
                        $totalNightsForHotel = count($hotelNights);
                        if ($totalNightsForHotel == 0 && preg_match('/_(\d+(?:_\d+)*)$/', $hotelNameRaw, $matches)) {
                            $totalNightsForHotel = count(explode('_', $matches[1]));
                        }
                        if ($totalNightsForHotel == 0) $totalNightsForHotel = $tripNights;
                        foreach ($roomData as $key => $value) {
                            if (in_array($key, ['hotel_id', 'hotel_city', 'nights', 'hotel_name'])) continue;
                            if (strpos($key, '_nights_') !== false) {
                                $parts = explode('_nights_', $key);
                                $roomType = trim($parts[0]);
                                $nightsCount = count(explode('_', $parts[1]));
                            } else {
                                $roomType = trim($key);
                                $nightsCount = $totalNightsForHotel;
                            }
                            if (!is_array($value)) $value = [$value];
                            foreach ($value as $occupancyString) {
                                if (!is_string($occupancyString) || strpos($occupancyString, '__') === false) continue;
                                list($occupancyType, $cost) = explode('__', $occupancyString);
                                $cost = (float)$cost;
                                if (isset($occupancyMapping[$occupancyType])) {
                                    $capacity = $occupancyMapping[$occupancyType];
                                    if ($isSimpleFormat) {
                                        $roomCount = $adultLookupByCapacity[$capacity] ?? 0;
                                    } else {
                                        $lookupKey = $cleanHotelName . '|' . $roomType . '|' . $capacity;
                                        $roomCount = $adultLookup[$lookupKey] ?? 0;
                                    }
                                    if ($roomCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType ($occupancyType)";
                                    $frequency = $roomCount;
                                    if ($markup_split == 'yes') {
                                        $rate = $cost;
                                        $total = $rate * $roomCount * $nightsCount;
                                    } else {
                                        $rate = $cost * $capacity;
                                        $total = $cost * $capacity * $roomCount;
                                    }
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_adult'];
                                } elseif ($occupancyType === 'CNB Occupancy') {
                                    $childCount = 0;
                                    if (!$isSimpleFormat) {
                                        $childLookupKey = $cleanHotelName . '|' . $roomType . '|CNB';
                                        $childCount = $childLookupPerRoom[$childLookupKey] ?? 0;
                                    } else {
                                        $childCount = $report->cnb_count ?? 0;
                                    }
                                    if ($childCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType (CNB)";
                                    $frequency = $childCount;
                                    $rate = $cost;
                                    $total = ($markup_split == 'yes') ? $rate * $frequency * $nightsCount : $rate * $frequency;
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cnb'];
                                } elseif ($occupancyType === 'CWB Occupancy') {
                                    $childCount = 0;
                                    if (!$isSimpleFormat) {
                                        $childLookupKey = $cleanHotelName . '|' . $roomType . '|CWB';
                                        $childCount = $childLookupPerRoom[$childLookupKey] ?? 0;
                                    } else {
                                        $childCount = $report->cwb_count ?? 0;
                                    }
                                    if ($childCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType (CWB)";
                                    $frequency = $childCount;
                                    $rate = $cost;
                                    $total = ($markup_split == 'yes') ? $rate * $frequency * $nightsCount : $rate * $frequency;
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cwb'];
                                }
                            }
                        }
                    } else {
                        // Old format (no nights array)
                        $nightsCount = $tripNights;
                        foreach ($roomData as $roomType => $occupancyArray) {
                            foreach ($occupancyArray as $occupancyString) {
                                if (!is_string($occupancyString) || strpos($occupancyString, '__') === false) continue;
                                list($occupancyType, $cost) = explode('__', $occupancyString);
                                $cost = (float)$cost;
                                if (isset($occupancyMapping[$occupancyType])) {
                                    $capacity = $occupancyMapping[$occupancyType];
                                    if ($isSimpleFormat) {
                                        $roomCount = $adultLookupByCapacity[$capacity] ?? 0;
                                    } else {
                                        $lookupKey = $cleanHotelName . '|' . $roomType . '|' . $capacity;
                                        $roomCount = $adultLookup[$lookupKey] ?? 0;
                                    }
                                    if ($roomCount == 0) continue;
                                    $serviceName = "$cleanHotelName - $roomType ($occupancyType)";
                                    $frequency = $roomCount;
                                    if ($markup_split == 'yes') {
                                        $rate = $cost;
                                        $total = $rate * $roomCount * $nightsCount;
                                    } else {
                                        $rate = $cost * $capacity;
                                        $total = $cost * $capacity * $roomCount;
                                    }
                                    $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_adult'];
                                }
                            }
                        }
                    }
                }
            }
        }
        
        // Add hotel items to itemsByDate (all on day 0)
        foreach ($hotelItems as $index => $item) {
            $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
            addItemToDate($itemsByDate, $startDate, 0, $item['name'], $item['frequency'], $item['rate'], $item['total'], 'hotel', '', $itemId);
        }
        
        // ----- TRAIN TICKETS -----
        if (!empty($daywise_train)) {
            if (is_string($daywise_train)) $daywise_train = json_decode($daywise_train, true);
            if (is_array($daywise_train)) {
                foreach ($daywise_train as $trainDay) {
                    if (!isset($trainDay['day'], $trainDay['trains'])) continue;
                    $dayNumber = (int)$trainDay['day'] - 1;
                    if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                    foreach ($trainDay['trains'] as $idx => $train) {
                        $passengerType = $train['passenger_type'] ?? 'adult';
                        $qty = (int)($train['qty'] ?? 0);
                        if ($qty == 0) continue;
                        $trainName = trim($train['train_name'] ?? '');
                        $ticketTypeLabel = trim($train['ticket_type_label'] ?? '');
                        if ($passengerType === 'child') {
                            if (empty($trainName) && empty($ticketTypeLabel)) $serviceName = "Train (Child)";
                            elseif (empty($trainName)) $serviceName = "Train ($ticketTypeLabel) - Child";
                            elseif (empty($ticketTypeLabel)) $serviceName = "Train: $trainName - Child";
                            else $serviceName = "Train: $trainName ($ticketTypeLabel) - Child";
                        } else {
                            if (empty($trainName) && empty($ticketTypeLabel)) continue;
                            if (empty($trainName)) $serviceName = "Train ($ticketTypeLabel) - Adult";
                            elseif (empty($ticketTypeLabel)) $serviceName = "Train: $trainName - Adult";
                            else $serviceName = "Train: $trainName ($ticketTypeLabel) - Adult";
                        }
                        $budgetPrice = (float)($train['price'] ?? 0);
                        $budgetTotal = (float)($train['total'] ?? ($budgetPrice * $qty));
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, $qty, $budgetPrice, $budgetTotal, 'train_ticket', '', generateItemId('train_ticket', $trainDay['day'] . '_' . $idx));
                    }
                }
            }
        }
        
        // ----- FULL DAY TOUR (included in bundle) -----
        if (!empty($fullDayCost)) {
            if (is_string($fullDayCost)) $fullDayCost = json_decode($fullDayCost, true);
            if (is_array($fullDayCost)) {
                foreach ($fullDayCost as $tourDay) {
                    if (!isset($tourDay['day'])) continue;
                    $dayNumber = (int)$tourDay['day'] - 1;
                    if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                    $tourName = $tourDay['name'] ?? 'Full day tour';
                    $serviceName = $tourName . ' (included in bundle)';
                    addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, 1, 0, 0, 'full_day_tour', 'Included in bundle price', generateItemId('full_day_tour', $dayNumber . '_' . uniqid()));
                }
            }
        }
        
        // ----- GUIDE COSTS -----
        if ($guideCosts && is_array($guideCosts)) {
            // Labels for each cost position
            $costLabels = [
                0 => 'Food',
                1 => 'Accommodation',
                2 => 'Day charge'  // you can rename to 'Other' if preferred
            ];

            foreach ($guideCosts as $index => $guideDay) {
                $dayNumber = $guideDay['day'];
                $qty = $guideDay['qty']; // Usually 1

                // Normalize 'costs' into an array (handle comma-separated string or array)
                $costsArray = [];
                if (isset($guideDay['costs'])) {
                    if (is_array($guideDay['costs'])) {
                        $costsArray = $guideDay['costs'];
                    } elseif (is_string($guideDay['costs']) && strpos($guideDay['costs'], ',') !== false) {
                        // Convert comma-separated string to array, trim whitespace
                        $costsArray = array_map('trim', explode(',', $guideDay['costs']));
                        // Convert to numeric values
                        $costsArray = array_map('floatval', $costsArray);
                    }
                }

                // Decide whether to show breakdown (multiple costs) or single line
                $multipleCosts = (count($costsArray) > 1);

                if ($multipleCosts) {
                    // Show detailed breakdown: one line per cost
                    foreach ($costsArray as $costIndex => $costAmount) {
                        // Skip zero costs if desired
                        if ($costAmount == 0) {
                            continue;
                        }

                        $label = isset($costLabels[$costIndex]) ? $costLabels[$costIndex] : 'Extra';
                        $rate = $costAmount;
                        $total = $costAmount * $qty;

                        $itemId = generateItemId('guide', $index . '_' . $costIndex);

                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            'Day Guide (' . $label . ')',
                            $qty,
                            $rate,
                            $total,
                            'guide',
                            '',
                            $itemId
                        );
                    }
                } else {
                    // Single cost – display as normal 'Guide'
                    // Determine the total (use provided total, or sum of costs, or fallback to 0)
                    if (!empty($guideDay['total']) && $guideDay['total'] > 0) {
                        $total = $guideDay['total'];
                    } elseif (!empty($costsArray)) {
                        $total = array_sum($costsArray) * $qty;
                    } else {
                        $total = 0;
                    }

                    $rate = ($qty > 0) ? $total / $qty : 0;
                    $itemId = generateItemId('guide', $index);

                    addItemToDate(
                        $itemsByDate,
                        $startDate,
                        $dayNumber,
                        'Day Guide',
                        $qty,
                        $rate,
                        $total,
                        'guide',
                        '',
                        $itemId
                    );
                }
            }
        }
        
        if (!empty($luggageData) && is_array($luggageData)) {
            // Determine first day (0) and last day index
            $firstDay = 0;
            $lastDay = $totalDays - 1; // assuming $totalDays is available
        
            // We only want to display on these two days
            $displayDays = [$firstDay, $lastDay];
        
            // Optional: merge multiple luggage items into a single description
            $vehicleNames = array_unique(array_column($luggageData, 'vehicle_name'));
            $vehicleList = implode(' + ', $vehicleNames); // e.g. "Mini Van + Mini Van"
        
            foreach ($displayDays as $dayNumber) {
                // Calculate total quantity and total cost (original, but we will override price to 0)
                $totalQty = array_sum(array_column($luggageData, 'quantity'));
                $originalTotal = array_sum(array_column($luggageData, 'total'));
        
                // Set price/rate to 0 because cost is included in transport bundle
                $rate = 0;
                $total = 0;
        
                // Create a unique item ID for luggage (could use day number)
                $itemId = generateItemId('luggage', $dayNumber);
        
                // Item name: include vehicle info
                $itemName = "Luggage Transfer (" . $vehicleList . " - included in transport bundle)";
        
                addItemToDate(
                    $itemsByDate,
                    $startDate,
                    $dayNumber,
                    $itemName,
                    $totalQty,
                    $rate,
                    $total,
                    'luggage',
                    '',
                    $itemId
                );
            }
        }
        
        // ----- ADULT MANDATORY SERVICES -----
        if (!empty($mandatoryServices) && is_array($mandatoryServices)) {
            foreach ($mandatoryServices as $index => $serviceItem) {

                $rawService = trim(
                    (string)($serviceItem['service'] ?? '')
                );

                $serviceParts = explode(
                    '_|_',
                    $rawService
                );

                $serviceName = trim(
                    (string)($serviceParts[0] ?? $rawService)
                );

                // Decimal rate jaise 0.75 ko preserve karega.
                $serviceRate = isset($serviceParts[1])
                    ? (float)trim($serviceParts[1])
                    : 0.0;

                $quantity = (int)($serviceItem['qnty'] ?? 0);

                $totalCost = $serviceRate * $quantity;

                $dayNumber = (
                    stripos(
                        $serviceName,
                        'Refreshing napkins'
                    ) !== false ||
                    stripos(
                        $serviceName,
                        'chocolate inside the vehicle upon arrival'
                    ) !== false
                )
                    ? 0
                    : $lastDay;

                $itemId = generateItemId(
                    'mandatory',
                    $index
                );

                addItemToDate(
                    $itemsByDate,
                    $startDate,
                    $dayNumber,
                    $serviceName,
                    $quantity,
                    $serviceRate,
                    $totalCost,
                    'mandatory',
                    '',
                    $itemId
                );
            }
        }


        // ----- CHILD MANDATORY SERVICES -----
        if (
            !empty($mandatoryChildServices) &&
            is_array($mandatoryChildServices)
        ) {
            foreach ($mandatoryChildServices as $index => $serviceItem) {

                $rawService = trim(
                    (string)($serviceItem['service'] ?? '')
                );

                $serviceParts = explode(
                    '_|_',
                    $rawService
                );

                $serviceName = trim(
                    (string)($serviceParts[0] ?? $rawService)
                );

                // Decimal rate jaise 0.75 ko preserve karega.
                $serviceRate = isset($serviceParts[1])
                    ? (float)trim($serviceParts[1])
                    : 0.0;

                $quantity = (int)($serviceItem['qnty'] ?? 0);

                $totalCost = $serviceRate * $quantity;

                $dayNumber = (
                    stripos(
                        $serviceName,
                        'Refreshing napkins'
                    ) !== false ||
                    stripos(
                        $serviceName,
                        'chocolate inside the vehicle upon arrival'
                    ) !== false
                )
                    ? 0
                    : $lastDay;

                $itemId = generateItemId(
                    'child_mandatory',
                    $index
                );

                addItemToDate(
                    $itemsByDate,
                    $startDate,
                    $dayNumber,
                    $serviceName,
                    $quantity,
                    $serviceRate,
                    $totalCost,
                    'child_mandatory',
                    '',
                    $itemId
                );
            }
        }
        
        // ----- TICKET COSTS -----
        if ($ticketCosts && is_array($ticketCosts)) {
            foreach ($ticketCosts as $groupIndex => $ticketGroup) {
                if (!isset($ticketGroup['tickets'])) continue;
                $dayNumber = isset($ticketGroup['day']) ? max(0, (int)$ticketGroup['day'] - 1) : 0;
                foreach ($ticketGroup['tickets'] as $ticketIndex => $ticket) {
                    if (isset($ticket['ticket_type']) && $ticket['ticket_type'] === 'group') {
                        $ticketName = $ticket['ticket_for'] ?? 'Group Ticket';
                        $groupSize = $ticket['group_size'] ?? 0;
                        $groupCount = $ticket['group_count'] ?? 1;
                        $price = $ticket['price'] ?? 0;
                        $total = $ticket['total'] ?? ($ticket['adult_total'] ?? $price * $groupCount);
                        $serviceName = $ticketName . ($groupSize > 0 ? " (Group of $groupSize)" : " (Group)");
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, $groupCount, $price, $total, 'ticket', '', generateItemId('ticket_group', $groupIndex . '_' . $ticketIndex));
                        continue;
                    }
                    $ticketName = $ticket['ticket_for'] ?? 'Ticket';
                    $adultCount = (int)($ticket['adult_count'] ?? 0);
                    if ($adultCount > 0) {
                        $adultPrice = (float)($ticket['price'] ?? 0);
                        $adultTotal = (float)($ticket['adult_total'] ?? ($adultCount * $adultPrice));
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $ticketName . ' (Adult)', $adultCount, $adultPrice, $adultTotal, 'ticket', '', generateItemId('ticket_adult', $groupIndex . '_' . $ticketIndex));
                    }
                    $isAgeBased = isset($ticket['age_based']) && $ticket['age_based'] == 1;
                    if ($isAgeBased && isset($ticket['child_ranges']) && is_array($ticket['child_ranges'])) {
                        foreach ($ticket['child_ranges'] as $rangeIndex => $range) {
                            $childCount = (int)($range['count'] ?? 0);
                            if ($childCount <= 0) continue;
                            $childPrice = (float)($range['price'] ?? 0);
                            $childTotal = (float)($range['subtotal'] ?? ($childCount * $childPrice));
                            $ageLabel = $range['age_range'] ?? ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                            addItemToDate($itemsByDate, $startDate, $dayNumber, $ticketName . ' (' . $ageLabel . ')', $childCount, $childPrice, $childTotal, 'ticket', '', generateItemId('ticket_child_range', $groupIndex . '_' . $ticketIndex . '_' . $rangeIndex));
                        }
                    } else {
                        $childCount = (int)($ticket['child_count'] ?? 0);
                        if ($childCount > 0) {
                            $childPrice = (float)($ticket['child_price'] ?? ($ticket['price'] ?? 0));
                            $childTotal = (float)($ticket['child_total'] ?? ($childCount * $childPrice));
                            addItemToDate($itemsByDate, $startDate, $dayNumber, $ticketName . ' (Child)', $childCount, $childPrice, $childTotal, 'ticket', '', generateItemId('ticket_child', $groupIndex . '_' . $ticketIndex));
                        }
                    }
                }
            }
        }
        
        // ----- ACTIVITY COSTS -----
        if ($activity_cost && is_array($activity_cost)) {
            $addActivityRows = function($dayNumber, $activity, $activityName, $dayIndex, $activityIndex) use (&$itemsByDate, $startDate) {
                if (isset($activity['is_group']) && $activity['is_group'] == 1) {
                    $groupCount = (int)($activity['group_count'] ?? 0);
                    if ($groupCount > 0) {
                        $groupPrice = (float)($activity['group_price'] ?? 0);
                        $groupTotal = (float)($activity['group_total'] ?? ($groupPrice * $groupCount));
                        $groupSize = (int)($activity['group_size'] ?? 0);
                        $groupLabel = $groupSize > 0 ? " (Group of $groupSize)" : " (Group)";
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $activityName . $groupLabel, $groupCount, $groupPrice, $groupTotal, 'activity', 'Activity', generateItemId('activity_group', $dayIndex . '_' . $activityIndex));
                    }
                    return;
                }
                $adultCount = (int)($activity['adult_count'] ?? 0);
                if ($adultCount > 0) {
                    $adultPrice = (float)($activity['adult_price'] ?? 0);
                    $adultTotal = (float)($activity['adult_total'] ?? ($adultPrice * $adultCount));
                    addItemToDate($itemsByDate, $startDate, $dayNumber, $activityName . ' (Adult)', $adultCount, $adultPrice, $adultTotal, 'activity', 'Activity', generateItemId('activity_adult', $dayIndex . '_' . $activityIndex));
                }
                if (isset($activity['child_age_ranges']) && is_array($activity['child_age_ranges'])) {
                    foreach ($activity['child_age_ranges'] as $rangeIndex => $range) {
                        $childCount = (int)($range['count'] ?? 0);
                        if ($childCount <= 0) continue;
                        $childPrice = (float)($range['price'] ?? 0);
                        $childTotal = (float)($range['total'] ?? ($childPrice * $childCount));
                        $ageLabel = ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $activityName . ' (' . $ageLabel . ')', $childCount, $childPrice, $childTotal, 'activity', 'Activity', generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_' . $rangeIndex));
                    }
                } else {
                    $childCount = (int)($activity['child_count'] ?? 0);
                    if ($childCount > 0) {
                        $childPrice = (float)($activity['child_price'] ?? 0);
                        $childTotal = (float)($activity['child_total'] ?? ($childPrice * $childCount));
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $activityName . ' (Child)', $childCount, $childPrice, $childTotal, 'activity', 'Activity', generateItemId('activity_child', $dayIndex . '_' . $activityIndex));
                    }
                }
            };
            if (isset($activity_cost['activity_data']) && is_array($activity_cost['activity_data'])) {
                foreach ($activity_cost['activity_data'] as $dayIndex => $dayData) {
                    $dayNumber = isset($dayData['day']) ? max(0, (int)$dayData['day'] - 1) : 0;
                    if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                        foreach ($dayData['activities'] as $activityIndex => $activity) {
                            $activityName = $activity['activity_name'] ?? 'Activity';
                            $addActivityRows($dayNumber, $activity, $activityName, $dayIndex, $activityIndex);
                        }
                    }
                }
            } elseif (isset($activity_cost[0]) && is_array($activity_cost[0])) {
                foreach ($activity_cost as $dayIndex => $dayData) {
                    $dayNumber = isset($dayData['day']) ? max(0, (int)$dayData['day'] - 1) : 0;
                    if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                        foreach ($dayData['activities'] as $activityIndex => $activity) {
                            $activityName = $activity['activity_name'] ?? 'Activity';
                            $addActivityRows($dayNumber, $activity, $activityName, $dayIndex, $activityIndex);
                        }
                    }
                }
            }
        }
        
        // ----- ENTRANCE COSTS (with flat child price support) -----
        if (!empty($entrance_cost) && is_array($entrance_cost)) {
            foreach ($entrance_cost as $entranceDayGroup) {
                if (!isset($entranceDayGroup['day'], $entranceDayGroup['entrances'])) continue;
                $dayNumber = (int)$entranceDayGroup['day'];
                if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                foreach ($entranceDayGroup['entrances'] as $entrance) {
                    $entranceName = $entrance['entrance_name'] ?? 'Entrance';
                    $isGroup = isset($entrance['is_group']) && $entrance['is_group'] == 1;
                    if ($isGroup) {
                        $groupCount = (int)($entrance['group_count'] ?? 0);
                        if ($groupCount > 0) {
                            $groupPrice = (float)($entrance['group_price'] ?? 0);
                            $groupTotal = (float)($entrance['group_total'] ?? ($groupPrice * $groupCount));
                            $personsPerGroup = (int)($entrance['persons_per_group'] ?? 0);
                            $groupLabel = $personsPerGroup > 0 ? " (Group of $personsPerGroup)" : " (Group)";
                            addItemToDate($itemsByDate, $startDate, $dayNumber, $entranceName . $groupLabel, $groupCount, $groupPrice, $groupTotal, 'entrance', '', generateItemId('entrance_group', $entrance['entrance_id'] ?? uniqid()));
                        }
                        continue;
                    }
                    // Adult row
                    $adultPrice = (float)($entrance['adult_price'] ?? 0);
                    $adultCount = (int)($entrance['adult_count'] ?? 0);
                    $adultTotal = (float)($entrance['adult_total'] ?? ($adultPrice * $adultCount));
                    if ($adultCount > 0 && $adultPrice > 0) {
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $entranceName . ' (Adult)', $adultCount, $adultPrice, $adultTotal, 'entrance', '', generateItemId('entrance_adult', $entrance['entrance_id'] ?? uniqid()));
                    }
                    // Child rows: age ranges OR flat child_price
                    if (isset($entrance['child_age_ranges']) && is_array($entrance['child_age_ranges'])) {
                        foreach ($entrance['child_age_ranges'] as $ageRange) {
                            $childCount = (int)($ageRange['count'] ?? 0);
                            if ($childCount <= 0) continue;
                            $childPrice = (float)($ageRange['price'] ?? 0);
                            $childTotal = (float)($ageRange['total'] ?? ($childPrice * $childCount));
                            $ageLabel = ($ageRange['age_from'] ?? 0) . '-' . ($ageRange['age_to'] ?? 0) . ' yrs';
                            addItemToDate($itemsByDate, $startDate, $dayNumber, $entranceName . ' (' . $ageLabel . ')', $childCount, $childPrice, $childTotal, 'entrance', '', generateItemId('entrance_child', ($entrance['entrance_id'] ?? uniqid()) . '_' . ($ageRange['age_range_id'] ?? uniqid())));
                        }
                    } elseif (isset($entrance['child_price']) && isset($entrance['child_count']) && $entrance['child_count'] > 0) {
                        // Flat child pricing
                        $childCount = (int)$entrance['child_count'];
                        $childPrice = (float)$entrance['child_price'];
                        $childTotal = isset($entrance['child_total']) ? (float)$entrance['child_total'] : ($childPrice * $childCount);
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $entranceName . ' (Child)', $childCount, $childPrice, $childTotal, 'entrance', '', generateItemId('entrance_child_flat', ($entrance['entrance_id'] ?? uniqid()) . '_flat'));
                    }
                }
            }
        }
        
        // ----- OUTSIDE COST (vehicles) -----
        $outsideCostByDate = [];
        $outsideCostTotal = 0;
        $vehicleNames = [];
        if ($outside_cost && is_array($outside_cost)) {
            foreach ($outside_cost as $outsideIndex => $outsideDay) {
                $dayNumber = $outsideDay['day'];
                if (isset($outsideDay['vehicles']) && is_array($outsideDay['vehicles'])) {
                    foreach ($outsideDay['vehicles'] as $vehicleIndex => $vehicle) {
                        $vehicleName = $vehicle['vehicle_name'] ?? 'Vehicle';
                        if (!in_array($vehicleName, $vehicleNames)) $vehicleNames[] = $vehicleName;
                        $siteScene = $vehicle['sitescene'] ?? '';
                        $siteId = $vehicle['site_id'] ?? '';
                        $qty = (int)($vehicle['qty'] ?? 1);
                        $price = ((float)($vehicle['price'] ?? 0)) + ((float)($vehicle['parking'] ?? 0));
                        $vehicleTotal = $price * $qty;
                        $tollAmount = (float)($vehicle['toll'] ?? 0);
                        $outsideCostTotal += $vehicleTotal + $tollAmount;
                        $actualDayNumber = $dayNumber;
                        if ($siteId && !empty($itineraryDays)) {
                            foreach ($itineraryDays as $itineraryDayNum => $itineraryItems) {
                                foreach ($itineraryItems as $itineraryItem) {
                                    if (isset($itineraryItem['site_id']) && $itineraryItem['site_id'] == $siteId) {
                                        $actualDayNumber = $itineraryDayNum;
                                        break 2;
                                    }
                                }
                            }
                        }
                        if (!isset($outsideCostByDate[$actualDayNumber])) $outsideCostByDate[$actualDayNumber] = [];
                        $serviceName = $siteScene;
                        if (($vehicle['parking'] ?? 0) > 0) {
                            $serviceName .= " (Supplement " . number_format($vehicle['parking'], 0, '.', '') . ")";
                        }
                        $outsideCostByDate[$actualDayNumber][] = [
                            'service' => $serviceName . " (Supplement)",
                            'frequency' => $qty,
                            'rate' => $price,
                            'total' => $vehicleTotal,
                            'type' => 'outside',
                            'item_id' => generateItemId('outside', $outsideIndex . '_' . $vehicleIndex . '_vehicle')
                        ];
                        if ($tollAmount > 0) {
                            $outsideCostByDate[$actualDayNumber][] = [
                                'service' => $serviceName . " (Toll)",
                                'frequency' => $qty,
                                'rate' => $tollAmount,
                                'total' => $tollAmount,
                                'type' => 'outside_toll',
                                'item_id' => generateItemId('outside', $outsideIndex . '_' . $vehicleIndex . '_toll')
                            ];
                        }
                    }
                }
            }
        }

        foreach ($outsideCostByDate as $dayNumber => $outsideItems) {
            $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $dayNumber . ' days'));
            if (!isset($itemsByDate[$dateKey])) {
                $itemsByDate[$dateKey] = [
                    'display_date' => date('d M', strtotime($startDate . ' + ' . $dayNumber . ' days')),
                    'date_key' => $dateKey,
                    'items' => []
                ];
            }
            foreach ($outsideItems as $item) $itemsByDate[$dateKey]['items'][] = $item;
        }
        
        // ----- MEAL COSTS (with cutoff) -----
        $mark_final_date_meal = $report->modified;
        $cutoff_date_meal = '2026-04-17';
        if ($mark_final_date_meal >= $cutoff_date_meal) {
            if (!empty($mealData) && is_array($mealData)) {
                $mealIds = [];
                foreach ($mealData as $dayMeals) {
                    if (!is_array($dayMeals)) continue;
                    $isDirect = false;
                    foreach ($dayMeals as $k => $v) {
                        if (is_numeric($k) && is_array($v) && isset($v['adult'])) { $isDirect = true; break; }
                    }
                    if ($isDirect) {
                        foreach ($dayMeals as $mealId => $details) if (is_numeric($mealId)) $mealIds[$mealId] = $mealId;
                    } else {
                        foreach ($dayMeals as $cuisineMeals) {
                            if (!is_array($cuisineMeals)) continue;
                            foreach ($cuisineMeals as $mealId => $details) if (is_numeric($mealId)) $mealIds[$mealId] = $mealId;
                        }
                    }
                }
                $buffetNames = [];
                if (!empty($mealIds)) {
                    $query = $this->db->select('id, buffet')->from('meal_per_person_cost')->where_in('id', $mealIds)->get();
                    foreach ($query->result() as $row) $buffetNames[$row->id] = $row->buffet;
                }
                $entertainmentLookup = [];
                if (!empty($entertainmentData) && is_array($entertainmentData)) {
                    foreach ($entertainmentData as $dayKey => $dayEntertainment) {
                        if (!is_array($dayEntertainment)) continue;
                        foreach ($dayEntertainment as $mealId => $entertainmentItems) {
                            if (!is_array($entertainmentItems)) continue;
                            foreach ($entertainmentItems as $entName => $details) $entertainmentLookup[$dayKey][$mealId][$entName] = $details;
                        }
                    }
                }
                foreach ($mealData as $dayKey => $dayMeals) {
                    if (strtolower($dayKey) === 'all') continue;
                    if (!preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) continue;
                    $dayNumber = (int)$matches[1] - 1;
                    if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                    if (!is_array($dayMeals)) continue;
                    $isDirectMealMap = false;
                    foreach ($dayMeals as $k => $v) {
                        if (is_numeric($k) && is_array($v) && isset($v['adult'])) { $isDirectMealMap = true; break; }
                    }
                    if ($isDirectMealMap) {
                        foreach ($dayMeals as $mealId => $mealDetails) {
                            if (!isset($mealDetails['adult'])) continue;
                            $buffetName = $buffetNames[$mealId] ?? ($mealDetails['buffet'] ?? 'Meal ' . $mealId);
                            $ctype = $mealDetails['cuisine'] ?? 'Unknown';
                            $serviceBase = ucfirst($ctype) . ' (' . ucfirst($buffetName) . ')';
                            $adultData = $mealDetails['adult'];
                            $adultPrice = (float)($adultData['price'] ?? 0);
                            $adultCount = (int)($adultData['count'] ?? 0);
                            $adultTotal = (float)($adultData['total'] ?? ($adultPrice * $adultCount));
                            if ($adultCount > 0 && $adultPrice > 0) {
                                addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceBase . ' (Adult)', $adultCount, $adultPrice, $adultTotal, 'meal', '', generateItemId('meal_adult', $dayKey . '_' . $mealId));
                            }
                            if (isset($mealDetails['child_groups']) && is_array($mealDetails['child_groups'])) {
                                foreach ($mealDetails['child_groups'] as $groupIndex => $group) {
                                    $childCount = (int)($group['count'] ?? 0);
                                    if ($childCount <= 0) continue;
                                    $childPrice = (float)($group['price'] ?? 0);
                                    $childTotal = (float)($group['total'] ?? ($childPrice * $childCount));
                                    $range = $group['range'] ?? 'Child';
                                    addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceBase . ' (' . $range . ')', $childCount, $childPrice, $childTotal, 'meal', '', generateItemId('meal_child', $dayKey . '_' . $mealId . '_' . $groupIndex));
                                }
                            }
                            if (isset($entertainmentLookup[$dayKey][$mealId])) {
                                $entData = $entertainmentLookup[$dayKey][$mealId];
                                if (isset($entData['price']) && isset($entData['qty']) && isset($entData['total'])) {
                                    $price = $entData['price']; $qty = $entData['qty']; $total = $entData['total'];
                                    if ($price > 0) addItemToDate($itemsByDate, $startDate, $dayNumber, 'Belly Dance', $qty, $price, $total, 'entertainment', '', generateItemId('entertainment', $dayKey . '_' . $mealId . '_bellydance'));
                                } else {
                                    foreach ($entData as $entName => $details) {
                                        $price = (float)($details['price'] ?? 0);
                                        $qty = (int)($details['qty'] ?? 1);
                                        $total = (float)($details['total'] ?? ($price * $qty));
                                        if ($price <= 0) continue;
                                        $serviceName = ucwords(str_replace('_', ' ', $entName));
                                        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, $qty, $price, $total, 'entertainment', '', generateItemId('entertainment', $dayKey . '_' . $mealId . '_' . $entName));
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($dayMeals as $cuisineType => $mealsByCuisine) {
                            if (!is_array($mealsByCuisine)) continue;
                            foreach ($mealsByCuisine as $mealId => $mealDetails) {
                                if (!isset($mealDetails['adult'])) continue;
                                $buffetName = $buffetNames[$mealId] ?? 'Meal ' . $mealId;
                                $ctype = $mealDetails['ctype'] ?? $cuisineType;
                                $serviceBase = ucfirst($ctype) . ' (' . ucfirst($buffetName) . ')';
                                $adultData = $mealDetails['adult'];
                                $adultPrice = (float)($adultData['price'] ?? 0);
                                $adultCount = (int)($adultData['count'] ?? 0);
                                $adultTotal = (float)($adultData['total'] ?? ($adultPrice * $adultCount));
                                if ($adultCount > 0 && $adultPrice > 0) {
                                    addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceBase . ' (Adult)', $adultCount, $adultPrice, $adultTotal, 'meal', '', generateItemId('meal_adult', $dayKey . '_' . $cuisineType . '_' . $mealId));
                                }
                                if (isset($mealDetails['child_groups']) && is_array($mealDetails['child_groups'])) {
                                    foreach ($mealDetails['child_groups'] as $groupIndex => $group) {
                                        $childCount = (int)($group['count'] ?? 0);
                                        if ($childCount <= 0) continue;
                                        $childPrice = (float)($group['price'] ?? 0);
                                        $childTotal = (float)($group['total'] ?? ($childPrice * $childCount));
                                        $range = $group['range'] ?? 'Child';
                                        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceBase . ' (' . $range . ')', $childCount, $childPrice, $childTotal, 'meal', '', generateItemId('meal_child', $dayKey . '_' . $cuisineType . '_' . $mealId . '_' . $groupIndex));
                                    }
                                }
                                if (isset($entertainmentLookup[$dayKey][$mealId])) {
                                    foreach ($entertainmentLookup[$dayKey][$mealId] as $entName => $details) {
                                        $price = (float)($details['price'] ?? 0);
                                        $qty = (int)($details['qty'] ?? 1);
                                        $total = (float)($details['total'] ?? ($price * $qty));
                                        if ($price <= 0) continue;
                                        $serviceName = ucwords($entName);
                                        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, $qty, $price, $total, 'entertainment', '', generateItemId('entertainment', $dayKey . '_' . $mealId . '_' . $entName));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            // Old meal structure (simple price per person)
            if (!empty($mealData) && is_array($mealData)) {
                foreach ($mealData as $dayKey => $dayMeals) {
                    if (strtolower($dayKey) === 'all') continue;
                    if (!preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) continue;
                    $dayNumber = (int)$matches[1] - 1;
                    if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                    if (!is_array($dayMeals)) continue;
                    foreach ($dayMeals as $mealType => $mealDetails) {
                        if (!is_array($mealDetails)) continue;
                        $mealName = ucfirst($mealType);
                        if (isset($mealDetails['cusine']) && !empty($mealDetails['cusine'])) $mealName .= " ({$mealDetails['cusine']})";
                        $price = (float)($mealDetails['price'] ?? 0);
                        $totalPersons = (int)($mealDetails['total_persons'] ?? 0);
                        $mealTotal = (float)($mealDetails['meal_total'] ?? ($price * $totalPersons));
                        if ($price <= 0) continue;
                        if ($totalPersons <= 0) $totalPersons = 1;
                        if ($mealTotal <= 0) $mealTotal = $price * $totalPersons;
                        addItemToDate($itemsByDate, $startDate, $dayNumber, $mealName, $totalPersons, $price, $mealTotal, 'meal', '', generateItemId('meal', $dayKey . '_' . $mealType));
                    }
                }
            }
        }
        
        // ----- DRIVER COSTS -----
        if (!empty($driverCosts) && is_array($driverCosts)) {
            foreach ($driverCosts as $driverItem) {
                if (!isset($driverItem['day'])) continue;
                $dayNumber = (int)$driverItem['day'];
                if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
                $qty = (int)($driverItem['qty'] ?? 1);
                if (isset($driverItem['food']) && $driverItem['food'] >= 0) {
                    $foodPrice = (float)$driverItem['food'];
                    $foodTotal = $foodPrice * $qty;
                    addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Food)', $qty, $foodPrice, $foodTotal, 'driver', '', generateItemId('driver_food', uniqid()));
                }
                if (isset($driverItem['accomodation']) && $driverItem['accomodation'] >= 0) {
                    $accomPrice = (float)$driverItem['accomodation'];
                    $accomTotal = $accomPrice * $qty;
                    addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Accommodation)', $qty, $accomPrice, $accomTotal, 'driver', '', generateItemId('driver_accom', uniqid()));
                }
                if (isset($driverItem['guide_charge']) && $driverItem['guide_charge'] >= 0) {
                    $guidePrice = (float)$driverItem['guide_charge'];
                    $guideTotal = $guidePrice * $qty;
                    addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Day Charge)', $qty, $guidePrice, $guideTotal, 'driver', '', generateItemId('driver_guide', uniqid()));
                }
            }
        }
        
        // ----- FILL MISSING DAYS WITH "No Service" -----
        for ($day = 0; $day < $totalDays; $day++) {
            $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $day . ' days'));
            if (!isset($itemsByDate[$dateKey])) {
                $displayDate = date('d M', strtotime($startDate . ' + ' . $day . ' days'));
                $itemsByDate[$dateKey] = [
                    'display_date' => $displayDate,
                    'date_key' => $dateKey,
                    'items' => [['service' => 'No Service', 'frequency' => 0, 'rate' => 0, 'total' => 0, 'type' => 'noservice', 'remarks' => '', 'item_id' => 'noservice_' . $day]]
                ];
            }
        }

        ksort($itemsByDate);
        
        // ----- CALCULATE TOTALS -----
        $trainTicketTotal = 0;
        $hotelTotal = 0;
        $TicketCostTotal = 0;
        $entranceTotal = 0;
        $activityTotal = 0;
        $dinnerTransferTotal = 0;
        $mealTotal = 0;
        $guideTotal = 0;
        $entertainmentTotal = 0;
        foreach ($itemsByDate as $dateData) {
            foreach ($dateData['items'] as $item) {
                switch ($item['type']) {
                    case 'entrance': $entranceTotal += $item['total']; break;
                    case 'activity': $activityTotal += $item['total']; break;
                    case 'dinner_transfer': $dinnerTransferTotal += $item['total']; break;
                    case 'meal': $mealTotal += $item['total']; break;
                    case 'guide': $guideTotal += $item['total']; break;
                    case 'entertainment': $entertainmentTotal += $item['total']; break;
                    case 'hotel': $hotelTotal += $item['total']; break;
                    case 'ticket': $TicketCostTotal += $item['total']; break;
                    case 'train_ticket': $trainTicketTotal += $item['total']; break;
                }
            }
        }
        
        $subtotal = 0;
        foreach ($itemsByDate as $dateData) {
            foreach ($dateData['items'] as $item) $subtotal += $item['total'];
        }
        
        $netBundlePrice = ($totalTransport - $discount_bundle_price) - $outsideCostTotal;
        if ($netBundlePrice < 0) $netBundlePrice = 0;
        $finalTotal = $subtotal + $netBundlePrice;
        $usdAmount = ($exchangeRate > 0) ? $finalTotal / $exchangeRate : 0;
        
        // --------------------------------------------------------------
        // 2. EXCEL GENERATION (using the populated $itemsByDate)
        // --------------------------------------------------------------
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        
        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->setActiveSheetIndex(0);
        
        // Company name for header
        $company_name = '';
        if (!empty($report->company_id)) {
            $company = $this->db->select('name')->from('company')->where('company_id', $report->company_id)->get()->row();
            if (!empty($company->name)) $company_name = $company->name;
        }
        
        $sheet->setCellValue('A1', 'ORIGINAL BUDGET REPORT');
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Date Range: ' . date('d M Y', strtotime($report->check_in_date)) . ' - ' . date('d M Y', strtotime($report->check_out_date)));
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A3', 'Company: ' . $company_name);
        $sheet->setCellValue('A4', 'Enquiry No: ' . ($report->enquiry_no ?? ''));
        $sheet->setCellValue('A5', 'Persons: ' . ($report->number_persons + $report->number_child));
        $sheet->setCellValue('A6', 'Currency: ' . $currency_abbr);

        // Style for info rows (A3:A6)
        $sheet->getStyle('A3:A6')->getFont()->setBold(true);

        // ----- Table headers (row 8) -----
        $sheet->setCellValue('A8', 'DATE');
        $sheet->setCellValue('B8', 'SERVICES');
        $sheet->setCellValue('C8', 'FREQUENCY');
        $sheet->setCellValue('D8', 'RATE (' . $currency_abbr . ')');
        $sheet->setCellValue('E8', 'TOTAL (' . $currency_abbr . ')');

        // Header styling: bold, background color, borders, centered
        $headerStyle = array(
            'font' => array('bold' => true, 'color' => array('rgb' => '000000')),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'E6B8B7')),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER),
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        );
        $sheet->getStyle('A8:E8')->applyFromArray($headerStyle);

        // Freeze the header row so it stays visible when scrolling
        $sheet->freezePane('A9');
        
        $row = 9;

        foreach ($itemsByDate as $dateData) {
            $displayDate = $dateData['display_date'];
            $items = $dateData['items'];
            $firstRow = true;
            foreach ($items as $item) {
                if ($firstRow) {
                    $sheet->setCellValue('A' . $row, $displayDate);
                    $firstRow = false;
                } else {
                    $sheet->setCellValue('A' . $row, '');
                }
                $sheet->setCellValue('B' . $row, $item['service']);
                $sheet->setCellValue('C' . $row, $item['frequency']);
                $sheet->setCellValue('D' . $row, number_format($item['rate'], 2));
                $sheet->setCellValue('E' . $row, number_format($item['total'], 2));
                
                $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                ));
                $row++;
            }
            // Blank row between dates – light gray
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
                'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F5F5F5'))
            ));
            $row++;
        }

        // ----- Bundle price row (if applicable) -----
        if ($totalTransport > 0) {
            $sheet->setCellValue('B' . $row, 'Bundle Price');
            $sheet->setCellValue('C' . $row, 1);
            $sheet->setCellValue('D' . $row, number_format($netBundlePrice, 2));
            $sheet->setCellValue('E' . $row, number_format($netBundlePrice, 2));
            $sheet->getStyle('B' . $row . ':E' . $row)->getFont()->setBold(true);
            $sheet->getStyle('B' . $row . ':E' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC000');
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
                'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
            ));
            $row++;
        }

        
        $row++; // empty row

        // Main totals (right side, columns D-E)
        $sheet->setCellValue('D' . $row, 'TOTAL AMOUNT (' . $currency_abbr . '):');
        $sheet->setCellValue('E' . $row, number_format($finalTotal, 2));
        $sheet->getStyle('D' . $row . ':E' . $row)->getFont()->setBold(true);
        $sheet->getStyle('D' . $row . ':E' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFE4E1');
        $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row++;

        $sheet->setCellValue('D' . $row, 'EXCHANGE RATE ROE:');
        $sheet->setCellValue('E' . $row, number_format($exchangeRate, 2));
        $sheet->getStyle('D' . $row . ':E' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row++;

        $sheet->setCellValue('D' . $row, 'AMOUNT IN USD:');
        $sheet->setCellValue('E' . $row, number_format($usdAmount, 2));
        $sheet->getStyle('D' . $row . ':E' . $row)->getFont()->setBold(true);
        $sheet->getStyle('D' . $row . ':E' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E8F4F8');
        $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row++;
        $row++; // extra spacing

        // ----- Breakdown totals on the LEFT side (columns A-B) -----
        $breakdowns = [
            'Hotel TOTAL' => $hotelTotal,
            'Train Ticket TOTAL' => $trainTicketTotal,
            'Ticket TOTAL' => $TicketCostTotal,
            'Entrance TOTAL' => $entranceTotal,
            'Activity TOTAL' => $activityTotal,
            'Guide TOTAL' => $guideTotal,
            'Meal TOTAL' => $mealTotal,
            'Entertainment TOTAL' => $entertainmentTotal,
            'Dinner Transfer TOTAL' => $dinnerTransferTotal
        ];

        foreach ($breakdowns as $label => $value) {
            if ($value > 0) {
                $sheet->setCellValue('A' . $row, $label);
                $sheet->setCellValue('B' . $row, number_format($value, 2));
                $sheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);
                $sheet->getStyle('A' . $row . ':B' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D5E8D4');
                $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray(array(
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                ));
                // Optionally, set the value alignment to right for currency
                $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $row++;
            }
        }

        // ----- Auto-size columns -----
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output file
        $filename = 'Original_Budget_Report_' . date('d-M-Y') . '_' . $report->enquiry_no . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    // Download final budget report in excel format
    public function saved_budget_excel_download($report, $saved_data)
    {
        // Clean output buffer
        if (ob_get_length()) ob_end_clean();

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        // --- Company name and header info ---
        $company_name = '';
        if (!empty($report->company_id)) {
            $company = $this->db->select('name')->from('company')->where('company_id', $report->company_id)->get()->row();
            if (!empty($company->name)) $company_name = $company->name;
        }

        // Currency abbreviation
        $currency_query = $this->db->select('currency_abbr')->from('currency_value')->where('currency_name', $report->currency)->get();
        $currency_abbr = ($currency_query->num_rows() > 0) ? $currency_query->row()->currency_abbr : '';

        // Title and info
        $sheet->setCellValue('A1', 'FINAL BUDGET REPORT');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Date Range: ' . date('d M Y', strtotime($report->check_in_date)) . ' - ' . date('d M Y', strtotime($report->check_out_date)));
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A3', 'Company: ' . $company_name);
        $sheet->setCellValue('A4', 'Enquiry No: ' . ($report->enquiry_no ?? ''));
        $sheet->setCellValue('A5', 'Persons: ' . ($report->number_persons + $report->number_child));
        $sheet->setCellValue('A6', 'Currency: ' . $currency_abbr);
        $sheet->getStyle('A3:A6')->getFont()->setBold(true);

        // --- Table headers (row 8) ---
        $sheet->setCellValue('A8', 'DATE');
        $sheet->setCellValue('B8', 'SERVICES');
        $sheet->setCellValue('C8', 'FREQUENCY');
        $sheet->setCellValue('D8', 'RATE (' . $currency_abbr . ')');
        $sheet->setCellValue('E8', 'ORIGINAL BUDGET');
        $sheet->setCellValue('F8', 'CLOSING BUDGET');
        $sheet->setCellValue('G8', 'REMARKS');

        $headerStyle = array(
            'font' => array('bold' => true, 'color' => array('rgb' => '000000')),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'E6B8B7')),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER),
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        );
        $sheet->getStyle('A8:G8')->applyFromArray($headerStyle);
        $sheet->freezePane('A9');

        // --- Data rows ---
        $groupedByDate = [];
        foreach ($saved_data['date_items'] as $item) {
            $dateKey = $item['date_key'] ?? '';
            if (!isset($groupedByDate[$dateKey])) $groupedByDate[$dateKey] = [];
            $groupedByDate[$dateKey][] = $item;
        }
        ksort($groupedByDate);

        $row = 9;
        foreach ($groupedByDate as $dateKey => $items) {
            $displayDate = date('d M', strtotime($dateKey));
            $firstRow = true;
            foreach ($items as $item) {
                // Service name (with fallback logic)
                $serviceName = $item['service'] ?? '';
                if (empty(trim($serviceName))) {
                    $itemId = $item['item_id'] ?? '';
                    if (strpos($itemId, 'guide_') === 0) $serviceName = 'Day Guide';
                    elseif (strpos($itemId, 'hotel_') === 0) $serviceName = 'Hotel';
                    elseif (strpos($itemId, 'ticket_') === 0) $serviceName = 'Ticket';
                    elseif (strpos($itemId, 'mandatory_') === 0) $serviceName = 'Mandatory Service';
                    elseif (strpos($itemId, 'activity_') === 0) $serviceName = 'Activity';
                    elseif (strpos($itemId, 'hotel_') === 0) $serviceName['hotel'] += $actual;
                    elseif (strpos($itemId, 'train_ticket_') === 0) $serviceName['trainTicketTotal'] += $actual;
                    else $serviceName = 'Service';
                }

                if ($firstRow) {
                    $sheet->setCellValue('A' . $row, $displayDate);
                    $firstRow = false;
                } else {
                    $sheet->setCellValue('A' . $row, '');
                }
                $sheet->setCellValue('B' . $row, $serviceName);
                $sheet->setCellValue('C' . $row, $item['actual_frequency'] ?? 0);
                $sheet->setCellValue('D' . $row, number_format($item['actual_rate'] ?? 0, 2));
                $sheet->setCellValue('E' . $row, number_format($item['budget_total'] ?? 0, 2));
                $sheet->setCellValue('F' . $row, number_format($item['actual_total'] ?? 0, 2));
                $sheet->setCellValue('G' . $row, $item['remarks'] ?? '');
                $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                ));
                $row++;
            }
            // Light gray separator row between dates
            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F5F5F5'))
            ));
            $row++;
        }

        // --- Additional Transfers (if exists) ---
        if (!empty($saved_data['additional_transfers'])) {
            $add = $saved_data['additional_transfers'];
            $sheet->setCellValue('B' . $row, $add['service'] ?? 'Additional Transfers');
            $sheet->setCellValue('C' . $row, $add['actual_frequency'] ?? 0);
            $sheet->setCellValue('D' . $row, number_format($add['actual_rate'] ?? 0, 2));
            $sheet->setCellValue('E' . $row, number_format($add['budget_total'] ?? 0, 2));
            $sheet->setCellValue('F' . $row, number_format($add['actual_total'] ?? 0, 2));
            $sheet->setCellValue('G' . $row, $add['remarks'] ?? '');
            $sheet->getStyle('B' . $row . ':G' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
            ));
            $row++;
        }

        // --- Bundle Price ---
        if (!empty($saved_data['bundle_price'])) {
            $bundle = $saved_data['bundle_price'];
            $sheet->setCellValue('B' . $row, $bundle['service'] ?? 'Bundle Price');
            $sheet->setCellValue('C' . $row, $bundle['actual_frequency'] ?? 1);
            $sheet->setCellValue('D' . $row, number_format($bundle['actual_rate'] ?? 0, 2));
            $sheet->setCellValue('E' . $row, number_format($bundle['budget_total'] ?? 0, 2));
            $sheet->setCellValue('F' . $row, number_format($bundle['actual_total'] ?? 0, 2));
            $sheet->setCellValue('G' . $row, $bundle['remarks'] ?? '');
            $sheet->getStyle('B' . $row . ':G' . $row)->getFont()->setBold(true);
            $sheet->getStyle('B' . $row . ':G' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC000');
            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
            ));
            $row++;
        }

        // --- Outside Costs ---
        if (!empty($saved_data['outside_costs']) && is_array($saved_data['outside_costs'])) {
            foreach ($saved_data['outside_costs'] as $outside) {
                $sheet->setCellValue('B' . $row, $outside['service'] ?? 'Outside Service');
                $sheet->setCellValue('C' . $row, $outside['actual_frequency'] ?? 0);
                $sheet->setCellValue('D' . $row, number_format($outside['actual_rate'] ?? 0, 2));
                $sheet->setCellValue('E' . $row, number_format($outside['budget_total'] ?? 0, 2));
                $sheet->setCellValue('F' . $row, number_format($outside['actual_total'] ?? 0, 2));
                $sheet->setCellValue('G' . $row, $outside['remarks'] ?? '');
                $sheet->getStyle('B' . $row . ':G' . $row)->getFont()->setBold(true);
                $sheet->getStyle('B' . $row . ':G' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC000');
                $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                ));
                $row++;
            }
        }

        // --- Spacer row ---
        $row++;
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F5F5F5'))
        ));
        $row++;

        // --- Totals section ---
        $totals = $saved_data['totals'];
        // Total Amount
        $sheet->setCellValue('D' . $row, 'TOTAL AMOUNT (' . $currency_abbr . '):');
        $sheet->setCellValue('E' . $row, number_format($totals['budget_total'] ?? 0, 2));
        $sheet->setCellValue('F' . $row, number_format($totals['actual_total'] ?? 0, 2));
        $sheet->getStyle('D' . $row . ':F' . $row)->getFont()->setBold(true);
        $sheet->getStyle('D' . $row . ':F' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFE4E1');
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row++;

        // Exchange Rate
        $sheet->setCellValue('D' . $row, 'EXCHANGE RATE ROE:');
        $sheet->setCellValue('E' . $row, number_format($totals['original_exchange_rate'] ?? 0, 2));
        $sheet->setCellValue('F' . $row, number_format($totals['actual_exchange_rate'] ?? 0, 2));
        $sheet->getStyle('D' . $row . ':F' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row++;

        // USD Amount
        $sheet->setCellValue('D' . $row, 'AMOUNT IN USD:');
        $sheet->setCellValue('E' . $row, '$' . number_format($totals['budget_usd'] ?? 0, 2));
        $sheet->setCellValue('F' . $row, '$' . number_format($totals['actual_usd'] ?? 0, 2));
        $usdMargin = $totals['usd_margin'] ?? 0;
        $marginDisplay = ($usdMargin >= 0 ? '+' : '-') . '$' . number_format(abs($usdMargin), 2);
        $sheet->setCellValue('G' . $row, $marginDisplay);
        $sheet->getStyle('D' . $row . ':G' . $row)->getFont()->setBold(true);
        $sheet->getStyle('D' . $row . ':F' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('E8F4F8');
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ));
        $row += 2;

        // --- Category totals (left side) ---
        // Calculate from saved_data items
        $catTotals = [
            'Hotel TOTAL' => 0,
            'Train Ticket TOTAL' => 0,
            'Entrance TOTAL' => 0,
            'Activity TOTAL' => 0,
            'Guide TOTAL' => 0,
            'Meal TOTAL' => 0,
            'Entertainment TOTAL' => 0,
            'Dinner Transfer TOTAL' => 0
        ];
        foreach ($saved_data['date_items'] as $item) {
            $id = $item['item_id'] ?? '';
            $actual = (float)($item['actual_total'] ?? 0);
            if (strpos($id, 'entrance_') === 0) $catTotals['Entrance TOTAL'] += $actual;
            elseif (strpos($id, 'activity_') === 0) $catTotals['Activity TOTAL'] += $actual;
            elseif (strpos($id, 'guide_') === 0) $catTotals['Guide TOTAL'] += $actual;
            elseif (strpos($id, 'meal_') === 0) $catTotals['Meal TOTAL'] += $actual;
            elseif (strpos($id, 'entertainment_') === 0) $catTotals['Entertainment TOTAL'] += $actual;
            elseif (strpos($id, 'dinner_transfer_') === 0) $catTotals['Dinner Transfer TOTAL'] += $actual;
            elseif (strpos($id, 'hotel_') === 0) $catTotals['Hotel TOTAL'] += $actual;
            elseif (strpos($id, 'train_ticket_') === 0) $catTotals['Train Ticket TOTAL'] += $actual;
        }

        foreach ($catTotals as $label => $value) {
            if ($value > 0) {
                $sheet->setCellValue('A' . $row, $label);
                $sheet->setCellValue('B' . $row, number_format($value, 2));
                $sheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);
                $sheet->getStyle('A' . $row . ':B' . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D5E8D4');
                $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(array(
                    'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                ));
                $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $row++;
            }
        }

        // --- Auto-size columns ---
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        // Optional: set column A width
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(30);

        // Output file
        $filename = 'Final_Budget_Report_' . date('d-M-Y') . '_' . $report->enquiry_no . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    // Download original budget report as PDF using mPDF
    public function original_budget_report_mpdf($id)
    {
        $decoded_id = base64_decode($id);
        
        $this->db->select('enquiry.id as enq_id, enquiry.*, quotations.*');
        $this->db->from('enquiry');
        $this->db->join('quotations', 'quotations.enquiry_id = enquiry.id', 'left');
        $this->db->where('enquiry.id', $decoded_id);
        $this->db->where('quotations.quot_final', 'yes');
        $data['report'] = $this->db->get()->row();
        
        if (!$data['report']) {
            show_404();
        }
        
        // Load mPDF with landscape A4 and larger margins
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4-L',           // Landscape
            'orientation'   => 'L',              // Landscape
            'margin_top'    => 15,
            'margin_bottom' => 15,
            'margin_left'   => 10,
            'margin_right'  => 10,
            'default_font_size' => 12,           // Larger default font
            'default_font'      => 'dejavusans'
        ]);
        
        // Load the PDF view
        $html = $this->load->view('admin/original_budget_report_pdf', $data, true);
        
        // Write HTML to PDF
        $mpdf->WriteHTML($html);
        
        // Generate filename
        $company_name = '';
        if (!empty($data['report']->company_id)) {
            $company = $this->db->select('name')->from('company')->where('company_id', $data['report']->company_id)->get()->row();
            if (!empty($company->name)) $company_name = $company->name;
        }
        $filename = 'Original_Budget_Report_' . $company_name . '_' . ($data['report']->enquiry_no ?? '') . '_' . date('d-M-Y') . '.pdf';
        
        $mpdf->Output($filename, 'D');
        exit;
    }

    // Download final budget report as PDF using mPDF
    public function final_budget_report_mpdf($id)
    {
        $decoded_id = base64_decode($id);
        
        // Original report data fetch karein
        $this->db->select('enquiry.id as enq_id, enquiry.*, quotations.*');
        $this->db->from('enquiry');
        $this->db->join('quotations', 'quotations.enquiry_id = enquiry.id', 'left');
        $this->db->where('enquiry.id', $decoded_id);
        $this->db->where('quotations.quot_final', 'yes');
        
        $data['report'] = $this->db->get()->row();
        
        // Saved budget report data fetch karein
        $this->db->where(['quote_id' => $data['report']->id, 'enquiry_id' => $data['report']->enq_id]);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $saved_report = $this->db->get('saved_budget_reports')->row();
        
        if ($saved_report) {
            $data['saved_data'] = json_decode($saved_report->saved_data, true);
            $data['saved_date'] = $saved_report->created_at;
        } else {
            $data['saved_data'] = null;
        }
        
        // Load mPDF with landscape A4 and larger margins
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4-L',           // Landscape
            'orientation'   => 'L',              // Landscape
            'margin_top'    => 15,
            'margin_bottom' => 15,
            'margin_left'   => 10,
            'margin_right'  => 10,
            'default_font_size' => 12,           // Larger default font
            'default_font'      => 'dejavusans'
        ]);
        
        // Load the PDF view
        $html = $this->load->view('admin/final_budget_report_pdf', $data, true);
        
        // Write HTML to PDF
        $mpdf->WriteHTML($html);
        
        // Generate filename
        $company_name = '';
        if (!empty($data['report']->company_id)) {
            $company = $this->db->select('name')->from('company')->where('company_id', $data['report']->company_id)->get()->row();
            if (!empty($company->name)) $company_name = $company->name;
        }
        $filename = 'Final_Budget_Report_' . $company_name . '_' . ($data['report']->enquiry_no ?? '') . '_' . date('d-M-Y') . '.pdf';
        
        $mpdf->Output($filename, 'D');
        exit;
    }
}
?>