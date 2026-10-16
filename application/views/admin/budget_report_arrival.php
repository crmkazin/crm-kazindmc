<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Closing Budget Report</title>
    <!-- SweetAlert2 (for Swal.fire) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fff;
        }
        .budget-report {
            width: 100%;
            border-collapse: collapse;
        }
        .budget-report th, .budget-report td {
            border: 2px solid #161616ff;
            padding: 4px;
            text-align: center;

        }
        .budget-report th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .header-section {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .total-row {
            background-color: #e8f4fd;
            font-weight: bold;
        }
        .service-row {
            background-color: #fff;
        }
        .date-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .main-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .sub-title {
            font-size: 20px;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 10px;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
    <style>
        .budget-report {
            border-collapse: collapse;
            width: 100%;
        }
        .budget-report th, .budget-report td {
            border: 1px solid #000000;
            padding: 5px 8px;
            text-align: center;
        }
        .budget-report select {
            width: 100%;
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .budget-report input[type="text"], 
        .budget-report input[type="number"] {
            width: 100%;
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 3px;
            text-align: center;
        }
        .budget-report textarea {
            width: 100%;
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
            min-height: 40px;
        }
        .date-gap-row {
            height: 15px;
            background-color: #f5f5f5;
        }
        .total-row {
            font-weight: bold;
        }
        .editable {
            background-color: #fffacd !important;
        }
        .editable-input {
            background-color: #fffacd;
            border: 1px solid #ffcc00;
        }
        .update-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .update-button:hover {
            background-color: #45a049;
        }
        .outside-section {
            /* background-color: #fce4e4ff !important; */
        }
    </style>
</head>
<body>

    <div class="header-section">
        <div class="main-title">CLOSING BUDGET REPORT | <?php echo date('d M Y', strtotime($report->check_in_date)); ?> - <?php echo date('d M Y', strtotime($report->check_out_date)); ?></div>
        <div class="sub-title">
            <?php 
            $company_name = '';
            if (!empty($report->company_id)) {
                $company = $this->db
                    ->select('name')
                    ->from('company')
                    ->where('company_id', $report->company_id)
                    ->get()
                    ->row();

                if (!empty($company->name)) {
                    $company_name = $company->name;
                }
            }
            echo $company_name ; ?> - <?php echo $report->enquiry_no ?? ''; ?>
        </div>
        <div class="sub-title">No Of Nights - <?php echo $report->no_of_nights; ?></div>
        <div class="sub-title">Person - <?php echo $report->number_persons + $report->number_child; ?></div>
    </div>

<?php
// Get original data
$guideCosts = json_decode($report->guide_cost, true);
$luggageData = json_decode($report->luggage_vehicle_cost ?? '[]', true);
$ticketCosts = json_decode($report->ticket_cost ?? '[]', true);
$mandatoryServices = json_decode($report->mandatory_services ?? '[]', true);
$mandatoryChildServices = json_decode($report->child_mandatory_services ?? '[]', true);
$outside_cost = json_decode($report->outside_cost ?? '[]', true);
$activity_cost = json_decode($report->activity_cost ?? '[]', true);
$entrance_cost = json_decode($report->entrance_cost ?? '[]', true);
$dinner_transfer_data = json_decode($report->dinner_transfer_data ?? '[]', true);
$hotel_cost = json_decode($report->hotel_cost ?? '[]', true);
$totalTransport = $report->total_transport ?? 0;
$discount_bundle_price = $report->discount_bundle_price ?? 0;
$guideDetails = json_decode($report->guide_details, true);
$itinerary_details = $report->itinerary_details ?? '';
$meal_type_daywise_price = $report->meal_type_daywise_price ?? '';
$entertainment_daywise_price = $report->daywise_entertainment ?? '';
// $guide_details = $report->cnb ?? '';
// $guide_details = $report->cnb_count ?? '';
// $guide_details = $report->cwb ?? '';
// $guide_details = $report->cwb_count ?? '';
$driverCosts = json_decode($report->driver_cost ?? '[]', true);
$markup_split = $report->markup_split ?? 'no';
$fullDayCost = $report->full_day_cost ?? 0;
$daywise_train = $report->daywise_train ?? 0;
$daywise_train_transport = $report->daywise_train_transport ?? 0;
$airport_pic_drop = json_decode($report->airport_pic_drop_cost ?? '[]', true);

$savedBudgetQuery = $this->db->where(['quote_id' => $report->id, 'enquiry_id' => $report->enq_id])->order_by('id', 'DESC')->limit(1)->get('saved_budget_reports');
if ($savedBudgetQuery->num_rows() > 0) {
    $savedRow = $savedBudgetQuery->row();
    $savedFinalData = json_decode($savedRow->saved_data, true);
    $savedFinalData['final_budget'] = $savedRow->final_budget;
}
// Parse meal data
$mealData = [];
if ($meal_type_daywise_price) {
    $mealData = json_decode($meal_type_daywise_price, true);
}

$entertainmentData = [];
if ($entertainment_daywise_price) {
    $entertainmentData = json_decode($entertainment_daywise_price, true);
}

$startDate = $report->check_in_date ?? date('Y-m-d');
$endDate = $report->check_out_date ?? date('Y-m-d', strtotime($startDate . ' + 6 days'));

// Calculate total days dynamically
$startDateTime = new DateTime($startDate);
$endDateTime = new DateTime($endDate);
$totalDays = $endDateTime->diff($startDateTime)->days + 1;
$lastDay = $totalDays - 1;

$exchangeRate = $report->roe;

$currency_query = $this->db
    ->select('currency_abbr')
    ->from('currency_value')
    ->where('currency_name', $report->currency)
    ->get();

if ($currency_query->num_rows() > 0) {
    $currency_data = $currency_query->row();
    $currency_abbr = $currency_data->currency_abbr;
} else {
    $currency_abbr ='';
}

$itineraryDays = [];
if ($itinerary_details) {
    $itineraryData = json_decode($itinerary_details, true);
    if ($itineraryData && is_array($itineraryData)) {
        foreach ($itineraryData as $dayKey => $dayData) {
            $dayNumber = (int)str_replace('itinerary_sites_id_', '', $dayKey) - 1; 
            if ($dayNumber >= 0) {
                $itineraryDays[$dayNumber] = $dayData['itinerary'] ?? [];
            }
        }
    }
}

// Get saved budget data if exists
$savedBudgetData = [];
$savedCategoryTotals = [];
$savedSelections = ['date_selections' => [], 'outside_selections' => []];
$savedRemarks = [];
$savedActualExpenses = [];
$savedFrequencies = [];
$savedRates = [];

// Check if saved data exists in database
$savedBudgetQuery = $this->db->where(['quote_id' => $report->id, 'enquiry_id' => $report->enq_id])->order_by('id', 'DESC')->limit(1)->get('saved_budget_reports');
if ($savedBudgetQuery->num_rows() > 0) {
    $savedRow = $savedBudgetQuery->row();
    $savedData = json_decode($savedRow->saved_data, true);
    
    if ($savedData && is_array($savedData)) {
        $savedBudgetData = $savedData;
        
        // Extract selections
        if (isset($savedData['selections'])) {
            $savedSelections = $savedData['selections'];
        }
        
        // Extract data from date_items
        if (isset($savedData['date_items']) && is_array($savedData['date_items'])) {
            foreach ($savedData['date_items'] as $item) {
                if (isset($item['item_id'])) {
                    $itemId = $item['item_id'];
                    if (isset($item['remarks'])) {
                        $savedRemarks[$itemId] = $item['remarks'];
                    }
                    if (isset($item['actual_total'])) {
                        $savedActualExpenses[$itemId] = $item['actual_total'];
                    }
                    if (isset($item['actual_frequency'])) {
                        $savedFrequencies[$itemId] = $item['actual_frequency'];
                    }
                    if (isset($item['actual_rate'])) {
                        $savedRates[$itemId] = $item['actual_rate'];
                    }
                }
            }
        }
        
        // Extract outside costs data
        if (isset($savedData['outside_costs']) && is_array($savedData['outside_costs'])) {
            foreach ($savedData['outside_costs'] as $item) {
                if (isset($item['item_id'])) {
                    $itemId = $item['item_id'];
                    if (isset($item['remarks'])) {
                        $savedRemarks[$itemId] = $item['remarks'];
                    }
                    if (isset($item['actual_total'])) {
                        $savedActualExpenses[$itemId] = $item['actual_total'];
                    }
                    if (isset($item['actual_frequency'])) {
                        $savedFrequencies[$itemId] = $item['actual_frequency'];
                    }
                    if (isset($item['actual_rate'])) {
                        $savedRates[$itemId] = $item['actual_rate'];
                    }
                }
            }
        }
        
        // Extract additional transfers
        if (isset($savedData['additional_transfers'])) {
            $savedRemarks['additional_transfers'] = $savedData['additional_transfers']['remarks'] ?? '';
            $savedActualExpenses['additional_transfers'] = $savedData['additional_transfers']['actual_total'] ?? 0;
            $savedFrequencies['additional_transfers'] = $savedData['additional_transfers']['actual_frequency'] ?? 0;
            $savedRates['additional_transfers'] = $savedData['additional_transfers']['actual_rate'] ?? 0;
        }
        
        // Extract bundle price
        if (isset($savedData['bundle_price'])) {
            $savedRemarks['bundle_price'] = $savedData['bundle_price']['remarks'] ?? '';
            $savedActualExpenses['bundle_price'] = $savedData['bundle_price']['actual_total'] ?? 0;
            $savedFrequencies['bundle_price'] = $savedData['bundle_price']['actual_frequency'] ?? 1;
            $savedRates['bundle_price'] = $savedData['bundle_price']['actual_rate'] ?? 0;
        }
        
        // Extract totals
        $savedActualExpenses['total_actual'] = $savedData['totals']['actual_total'] ?? 0;
        if (isset($savedData['totals'])) {
            $savedActualExpenses['exchange_rate'] = $savedData['totals']['actual_exchange_rate'] ?? $exchangeRate;
            $savedActualExpenses['usd_actual'] = $savedData['totals']['actual_usd'] ?? 0;
        }
            $savedCategoryTotals = $savedData['category_totals'] ?? [];
    }
}

$itemsByDate = [];

function addItemToDate(&$itemsByDate, $startDate, $dayNumber, $service, $frequency, $rate, $total, $type = 'service', $remarks = '', $itemId = '', $savedData = []) {
    
    error_log("Adding item - Type: $type, Service: $service, ItemID: $itemId");
    $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $dayNumber . ' days'));
    $displayDate = date('d M', strtotime($startDate . ' + ' . $dayNumber . ' days'));
    
    if (!isset($itemsByDate[$dateKey])) {
        $itemsByDate[$dateKey] = [
            'display_date' => $displayDate,
            'date_key' => $dateKey,
            'items' => []
        ];
    }
    
    // Get saved values
    $savedFrequency = $savedData['frequency'] ?? $frequency;
    $savedRate = $savedData['rate'] ?? $rate;
    $savedTotal = $savedData['total'] ?? $total;
    $savedRemarks = $savedData['remarks'] ?? $remarks;
    
    $itemsByDate[$dateKey]['items'][] = [
        'service' => $service,
        'frequency' => $savedFrequency,
        'rate' => $savedRate,
        'total' => $total, // Keep original budget total
        'actual_total' => $savedTotal, // Use saved actual total
        'type' => $type,
        'remarks' => $savedRemarks,
        'item_id' => $itemId ?: uniqid()
    ];
}

// Helper function to generate unique IDs for items
function generateItemId($type, $index) {
    return $type . '_' . $index;
}

function formatServiceText($service)
{
    $service = htmlspecialchars($service ?? '', ENT_QUOTES, 'UTF-8');

    // Make only included bundle text bold
    $service = preg_replace(
        '/(included in(?: transport)? bundle)/i',
        '<strong>$1</strong>',
        $service
    );

    return $service;
}

// Airport Pickup & Drop-off (included in bundle)
if (!empty($airport_pic_drop) && is_array($airport_pic_drop)) {
    foreach ($airport_pic_drop as $transfer) {
        $type = $transfer['type'] ?? '';
        $vehicleName = $transfer['vehicle_name'] ?? 'Vehicle';
        $quantity = (int)($transfer['quantity'] ?? 1);
        // Only show if quantity > 0 and type is pickup or drop
        if ($quantity <= 0) continue;
        if ($type === 'pickup') {
            $dayNumber = 0; // first day
            $serviceName = "Airport Pickup ($vehicleName) - (Included in bundle)";
        } elseif ($type === 'drop') {
            $dayNumber = $lastDay; // last day
            $serviceName = "Airport Drop-off ($vehicleName) - (Included in bundle)";
        } else {
            continue;
        }
        $itemId = generateItemId('airport_transfer', $type);
        // Use saved data if exists (though likely not edited, but for consistency)
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? 1,
            'rate'      => 0,
            'total'     => 0,
            'remarks'   => $savedRemarks[$itemId] ?? ''
        ];
        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, 1, 0, 0, 'airport_transfer', 'Price included in transport bundle', $itemId, $savedData);
    }
}

// hotel cost processing logic updated on 2026-05-28
$updated_hotel_cutoff_date = '2026-05-28';
$mark_final_date = $report->modified;
if($mark_final_date >= $updated_hotel_cutoff_date)
{
    // 1. Get hotel cost and room breakdown (same as before)
    $hotel_cost = $report->hotel_cost ?? [];
    if (is_string($hotel_cost)) $hotel_cost = json_decode($hotel_cost, true);
    if (!is_array($hotel_cost)) $hotel_cost = [];

    $room_breakdown_data = $report->room_breakdown ?? [];
    if (is_string($room_breakdown_data)) $room_breakdown_data = json_decode($room_breakdown_data, true);
    if (!is_array($room_breakdown_data)) $room_breakdown_data = [];

    // 2. Build adult lookup (unchanged)
    $adultLookup = [];          // key: hotelName|roomName|capacity
    $adultLookupById = [];      // key: hotelId|roomName|capacity

    foreach ($room_breakdown_data as $hotelData) {
        $hotelName = trim($hotelData['hotel_name'] ?? '');
        $hotelId   = $hotelData['hotel_id'] ?? null;
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

    // 3. Build child lookup per room (NEW)
    $childLookupPerRoom = [];
    $childLookupPerRoomById = [];

    foreach ($room_breakdown_data as $hotelData) {
        $hotelName = trim($hotelData['hotel_name'] ?? '');
        $hotelId   = $hotelData['hotel_id'] ?? null;
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

    // 4. Occupancy mapping and settings (unchanged)
    $occupancyMapping = [
        'Single Occupancy' => 1, 'Double Occupancy' => 2, 'Triple Occupancy' => 3,
        'Quad Occupancy' => 4, 'Quint Occupancy' => 5, 'Sext Occupancy' => 6
    ];
    $markup_split = $report->markup_split ?? 'no';
    $tripNights = (int)($report->total_nights ?? 1);
    $startDate = $report->check_in_date ?? date('Y-m-d');

    $hotelItems = [];

    // 5. Process each hotel from the budget
    foreach ($hotel_cost as $hotelCategory => $hotels) {
        foreach ($hotels as $hotelNameRaw => $roomData) {
            $cleanHotelName = trim(preg_replace('/_\d+(?:_\d+)*$/', '', $hotelNameRaw));
            $isNewFormat = isset($roomData['hotel_id']) || isset($roomData['hotel_city']) || isset($roomData['nights']);

            if ($isNewFormat) {
                // Determine total nights from hotel name suffix if 'nights' array missing
                $hotelNights = $roomData['nights'] ?? [];
                $totalNightsForHotel = count($hotelNights);
                if ($totalNightsForHotel == 0 && preg_match('/_(\d+(?:_\d+)*)$/', $hotelNameRaw, $matches)) {
                    $totalNightsForHotel = count(explode('_', $matches[1]));
                }
                if ($totalNightsForHotel == 0) $totalNightsForHotel = $tripNights;

                foreach ($roomData as $key => $value) {
                    if (in_array($key, ['hotel_id', 'hotel_city', 'nights', 'hotel_name'])) continue;

                    // Extract room type and night count
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

                        // Adult occupancy
                        if (isset($occupancyMapping[$occupancyType])) {
                            $capacity = $occupancyMapping[$occupancyType];
                            $roomCount = 0;
                            
                            // Match by hotel ID (primary)
                            if (!empty($roomData['hotel_id'])) {
                                $lookupKeyById = $roomData['hotel_id'] . '|' . $roomType . '|' . $capacity;
                                $roomCount = $adultLookupById[$lookupKeyById] ?? 0;
                            }
                            // Fallback to name-based matching if ID not found (old data)
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
                        }
                        // CNB – match by hotel ID
                        elseif ($occupancyType === 'CNB Occupancy') {
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
                            $total = ($markup_split == 'yes') ? $rate * $frequency * $nightsCount : $rate * $frequency;
                            $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cnb'];
                        }
                        // CWB – match by hotel ID
                        elseif ($occupancyType === 'CWB Occupancy') {
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
                            $total = ($markup_split == 'yes') ? $rate * $frequency * $nightsCount : $rate * $frequency;
                            $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_cwb'];
                        }
                    }
                }
            } else {
                // Old format – simplified (unchanged)
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
                                // $total = $rate * $roomCount * $nightsCount;
                                $total = $rate * $roomCount;
                            }
                            $hotelItems[] = ['name' => $serviceName, 'frequency' => $frequency, 'rate' => $rate, 'total' => $total, 'type' => 'hotel_adult'];
                        }
                    }
                }
            }
        }
    }

    // 6. Add hotel items to itemsByDate
    foreach ($hotelItems as $index => $item) {
        $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? $item['frequency'],
            'rate'      => $savedRates[$itemId]      ?? $item['rate'],
            'total'     => $savedActualExpenses[$itemId] ?? $item['total'],
            'remarks'   => $savedRemarks[$itemId]    ?? ''
        ];
        addItemToDate($itemsByDate, $startDate, 0, $item['name'], $item['frequency'], $item['rate'], $item['total'], 'hotel', '', $itemId, $savedData);
    }

} else {
    // 07 Feb 2026 updated – now using per‑room breakdown (same as new logic)
    $hotelCostTotal = 0;
    $hotelItems = [];

    // 1. Decode room_breakdown
    $roomBreakdownData = [];
    if (!empty($report->room_breakdown)) {
        $decoded = json_decode($report->room_breakdown, true);
        if (is_array($decoded)) {
            $roomBreakdownData = $decoded;
        }
    }

    // 2. Build lookups
    $adultLookup = [];        // For standard format: hotel|room|capacity → count
    $adultLookupByCapacity = []; // For simple format: capacity → total rooms
    $childLookupPerRoom = []; // Not used in simple format – will fallback to global counts
    $isSimpleFormat = false;

    // Check if top-level keys are room types (single, double, etc.) and no 'hotel_name' exists
    $possibleRoomTypes = ['single', 'double', 'triple', 'quad', 'quint', 'sext'];
    $topKeys = array_keys($roomBreakdownData);
    if (!empty($topKeys) && count(array_intersect($topKeys, $possibleRoomTypes)) > 0 && !isset($roomBreakdownData['hotel_name'])) {
        $isSimpleFormat = true;
        foreach ($roomBreakdownData as $roomTypeKey => $roomInfo) {
            $capacity = $roomInfo['capacity_per_room'] ?? 1;
            $roomCount = $roomInfo['room_count'] ?? 0;
            if ($roomCount > 0) {
                $adultLookupByCapacity[$capacity] = ($adultLookupByCapacity[$capacity] ?? 0) + $roomCount;
            }
        }
    } else {
        // Standard format (same as 'if' block)
        foreach ($roomBreakdownData as $hotelData) {
            $hotelName = trim($hotelData['hotel_name'] ?? '');
            $rooms = $hotelData['rooms'] ?? [];
            foreach ($rooms as $roomInfo) {
                $roomName = trim($roomInfo['room_name'] ?? '');
                foreach ($roomInfo['occupancies'] ?? [] as $occ) {
                    $occupancy = (int)($occ['occupancy'] ?? 0);
                    $roomCount = (int)($occ['room_count'] ?? 0);
                    if ($roomCount > 0) {
                        $key = $hotelName . '|' . $roomName . '|' . $occupancy;
                        $adultLookup[$key] = ($adultLookup[$key] ?? 0) + $roomCount;
                    }
                }
                foreach ($roomInfo['children'] ?? [] as $child) {
                    $type = strtoupper($child['type'] ?? '');
                    $count = (int)($child['count'] ?? 0);
                    if ($count > 0 && in_array($type, ['CNB', 'CWB'])) {
                        $key = $hotelName . '|' . $roomName . '|' . $type;
                        $childLookupPerRoom[$key] = ($childLookupPerRoom[$key] ?? 0) + $count;
                    }
                }
            }
        }
    }

    // 3. Process hotel_cost (same loop, but use appropriate lookup)
    $markup_split = $report->markup_split ?? 'no';
    $tripNights = (int)($report->total_nights ?? 1);
    $startDate = $report->check_in_date ?? date('Y-m-d');

    $occupancyMapping = [
        'Single Occupancy' => 1, 'Double Occupancy' => 2, 'Triple Occupancy' => 3,
        'Quad Occupancy' => 4, 'Quint Occupancy' => 5, 'Sext Occupancy' => 6
    ];

    $hotelItems = [];
    $hotelCostTotal = 0;
    if (!empty($hotel_cost) && is_array($hotel_cost)): 
        foreach ($hotel_cost as $hotelCategory => $hotels) {
            foreach ($hotels as $hotelNameRaw => $roomData) {
                $cleanHotelName = trim(preg_replace('/_\d+(?:_\d+)*$/', '', $hotelNameRaw));
                $isNewFormat = isset($roomData['hotel_id']) || isset($roomData['hotel_city']) || isset($roomData['nights']);
    
                if ($isNewFormat) {
                    // Determine nights (same as before)
                    $hotelNights = $roomData['nights'] ?? [];
                    $totalNightsForHotel = count($hotelNights);
                    if ($totalNightsForHotel == 0 && preg_match('/_(\d+(?:_\d+)*)$/', $hotelNameRaw, $matches)) {
                        $totalNightsForHotel = count(explode('_', $matches[1]));
                    }
                    if ($totalNightsForHotel == 0) $totalNightsForHotel = $tripNights;
    
                    foreach ($roomData as $key => $value) {
                        if (in_array($key, ['hotel_id', 'hotel_city', 'nights', 'hotel_name'])) continue;
    
                        // Extract room type and night count
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
    
                            // Adult occupancy
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
    
                                // Original else calculation formulas
                                if ($markup_split == 'yes') {
                                    $rate = $cost;
                                    $total = $rate * $roomCount * $nightsCount;
                                } else {
                                    $rate = $cost * $capacity;
                                    $total = $cost * $capacity * $roomCount;
                                }
    
                                $hotelItems[] = [
                                    'name' => $serviceName,
                                    'frequency' => $frequency,
                                    'rate' => $rate,
                                    'total' => $total,
                                    'type' => 'hotel_adult'
                                ];
                                $hotelCostTotal += $total;
                            }
                            // CNB Occupancy
                            elseif ($occupancyType === 'CNB Occupancy') {
                                $childCount = 0;
                                if (!$isSimpleFormat) {
                                    $childLookupKey = $cleanHotelName . '|' . $roomType . '|CNB';
                                    $childCount = $childLookupPerRoom[$childLookupKey] ?? 0;
                                } else {
                                    // Simple format: use global counts from report
                                    $childCount = $report->cnb_count ?? 0;
                                }
                                if ($childCount == 0) continue;
    
                                $serviceName = "$cleanHotelName - $roomType (CNB)";
                                $frequency = $childCount;
                                $rate = $cost;
                                $total = ($markup_split == 'yes') ? $rate * $frequency * $nightsCount : $rate * $frequency;
                                $hotelItems[] = [
                                    'name' => $serviceName,
                                    'frequency' => $frequency,
                                    'rate' => $rate,
                                    'total' => $total,
                                    'type' => 'hotel_cnb'
                                ];
                                $hotelCostTotal += $total;
                            }
                            // CWB Occupancy
                            elseif ($occupancyType === 'CWB Occupancy') {
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
                                $hotelItems[] = [
                                    'name' => $serviceName,
                                    'frequency' => $frequency,
                                    'rate' => $rate,
                                    'total' => $total,
                                    'type' => 'hotel_cwb'
                                ];
                                $hotelCostTotal += $total;
                            }
                        }
                    }
                } else {
                    // Old format (no nights array) – keep original logic, but adapt lookup
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
                                $hotelItems[] = [
                                    'name' => $serviceName,
                                    'frequency' => $frequency,
                                    'rate' => $rate,
                                    'total' => $total,
                                    'type' => 'hotel_adult'
                                ];
                                $hotelCostTotal += $total;
                            }
                            // For children in old format, fallback to global counts (as original)
                        }
                    }
                }
            }
        }
    endif;

    // 4. Add items to itemsByDate (unchanged)
    foreach ($hotelItems as $index => $item) {
        $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? $item['frequency'],
            'rate'      => $savedRates[$itemId]      ?? $item['rate'],
            'total'     => $savedActualExpenses[$itemId] ?? $item['total'],
            'remarks'   => $savedRemarks[$itemId]    ?? ''
        ];
        addItemToDate(
            $itemsByDate,
            $startDate,
            0,
            $item['name'],
            $item['frequency'],
            $item['rate'],
            $item['total'],
            'hotel',
            '',
            $itemId,
            $savedData
        );
    }
}

// ------------------------------------------------------------------
// FULL DAY TOUR (included in transport bundle) – informational rows
// ------------------------------------------------------------------
if (!empty($fullDayCost)) {
    // Decode if it's a JSON string
    if (is_string($fullDayCost)) {
        $fullDayCost = json_decode($fullDayCost, true);
    }
    
    if (is_array($fullDayCost)) {
        foreach ($fullDayCost as $index => $tourDay) {
            // Expected keys: 'day' (1‑based), 'name' (optional)
            if (!isset($tourDay['day'])) continue;
            
            $dayNumber = (int)$tourDay['day'] - 1;
            if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
            
            // Use custom name if provided, else default
            $tourName = isset($tourDay['name']) ? $tourDay['name'] : 'Full day tour';
            $serviceName = $tourName . ' (Included in bundle)';
            
            $itemId = generateItemId('full_day_tour', $dayNumber . '_' . ($tourDay['id'] ?? $index));
            
            // Apply saved data if it exists (e.g., remarks, but rate/total must remain 0)
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? 1,
                'rate'      => 0,  // always 0 – price already in bundle
                'total'     => 0,  // always 0
                'remarks'   => $savedRemarks[$itemId] ?? ''
            ];
            
            addItemToDate(
                $itemsByDate, $startDate, $dayNumber,
                $serviceName,
                1,          // budget frequency (always 1)
                0,          // budget rate (0)
                0,          // budget total (0)
                'full_day_tour',
                'Included in transport bundle',
                $itemId,
                $savedData
            );
        }
    }
}

// Guide costs code start from here
if ($guideCosts && is_array($guideCosts)) {
    // Labels for each cost position (only used for breakdown)
    $costLabels = [
        0 => 'Food',
        1 => 'Accommodation',
        2 => 'Day charge'
    ];

    foreach ($guideCosts as $index => $guideDay) {
        $dayNumber = $guideDay['day'];
        $qty = $guideDay['qty']; // Usually 1

        // Normalize 'costs' into an array (handle array or comma-separated string)
        $costsArray = [];
        if (isset($guideDay['costs'])) {
            if (is_array($guideDay['costs'])) {
                $costsArray = $guideDay['costs'];
            } elseif (is_string($guideDay['costs']) && strpos($guideDay['costs'], ',') !== false) {
                // Convert comma-separated string to array, trim and cast to float
                $costsArray = array_map('trim', explode(',', $guideDay['costs']));
                $costsArray = array_map('floatval', $costsArray);
            }
        }

        $multipleCosts = (count($costsArray) > 1);

        $guideLabel = $guideDetails[0]['type'];
        if($guideLabel == 'guide'){
            $guideLabel = 'Guide';
        }else{
            $guideLabel = 'Driver Cum Guide';
        }

        if ($multipleCosts) {
            // --- BREAKDOWN: one line per cost ---
            foreach ($costsArray as $costIndex => $costAmount) {
                // Skip zero costs if desired
                if ($costAmount == 0) {
                    continue;
                }

                $label = isset($costLabels[$costIndex]) ? $costLabels[$costIndex] : 'Extra';
                // $itemName = 'Day Guide (' . $label . ')';
                $itemName = $guideLabel . ' ('.$label . ')';

                $defaultRate = $costAmount;
                $defaultTotal = $costAmount * $qty;

                $itemId = generateItemId('guide', $index . '_' . $costIndex);

                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $qty,
                    'rate'      => $savedRates[$itemId] ?? $defaultRate,
                    'total'     => $savedActualExpenses[$itemId] ?? $defaultTotal,
                    'remarks'   => $savedRemarks[$itemId] ?? ''
                ];

                addItemToDate(
                    $itemsByDate,
                    $startDate,
                    $dayNumber,
                    $itemName,
                    $qty,
                    $savedData['rate'],
                    $savedData['total'],
                    'guide',
                    '',
                    $itemId,
                    $savedData
                );
            }
        } else {
            // --- SINGLE ITEM: normal 'Guide' ---
            // Determine total: use provided 'total', or sum of costs (if one cost), or fallback to 0
            if (isset($guideDay['total']) && $guideDay['total'] > 0) {
                $total = $guideDay['total'];
            } elseif (!empty($costsArray)) {
                $total = array_sum($costsArray) * $qty;
            } else {
                $total = 0;
            }

            $rate = ($qty > 0) ? $total / $qty : 0;

            $itemId = generateItemId('guide', $index);
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $qty,
                'rate'      => $savedRates[$itemId] ?? $rate,
                'total'     => $savedActualExpenses[$itemId] ?? $total,
                'remarks'   => $savedRemarks[$itemId] ?? ''
            ];

            addItemToDate(
                $itemsByDate,
                $startDate,
                $dayNumber,
                $guideLabel,
                $qty,
                $savedData['rate'],
                $savedData['total'],
                'guide',
                '',
                $itemId,
                $savedData
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

        // Prepare saved data (if any previous edits)
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? $totalQty,
            'rate'      => $savedRates[$itemId] ?? $rate,
            'total'     => $savedActualExpenses[$itemId] ?? $total,
            'remarks'   => $savedRemarks[$itemId] ?? "Luggage vehicle cost included in transport bundle"
        ];

        // Item name: include vehicle info
        $itemName = "Luggage Transfer (" . $vehicleList . " - included in transport bundle)";

        addItemToDate(
            $itemsByDate,
            $startDate,
            $dayNumber,
            $itemName,
            $totalQty,          // frequency (e.g., 1)
            $savedData['rate'],
            $savedData['total'],
            'luggage',          // category
            '',                 // extra info
            $itemId,
            $savedData
        );
    }
}

// Adult mandatory services code starts here
if (!empty($mandatoryServices) && is_array($mandatoryServices)) {

    foreach ($mandatoryServices as $index => $serviceItem) {

        $rawService = trim(
            (string) ($serviceItem['service'] ?? '')
        );

        $serviceParts = explode(
            '_|_',
            $rawService
        );

        $serviceName = trim(
            (string) ($serviceParts[0] ?? $rawService)
        );

        // Float use kiya hai taaki 0.75 jaisi rate 0 na bane.
        $serviceRate = isset($serviceParts[1])
            ? (float) trim($serviceParts[1])
            : 0.0;

        $quantity = (int) (
            $serviceItem['qnty'] ?? 0
        );

        $totalCost = $serviceRate * $quantity;

        // Default me service last day par add hogi.
        $dayNumber = $lastDay;

        // Ye specific services first day par add hongi.
        if (
            stripos(
                $serviceName,
                'Refreshing napkins'
            ) !== false ||
            stripos(
                $serviceName,
                'chocolate inside the vehicle upon arrival'
            ) !== false
        ) {
            $dayNumber = 0;
        }

        $itemId = generateItemId(
            'mandatory',
            $index
        );

        $savedData = [
            'frequency' => isset($savedFrequencies[$itemId])
                ? (int) $savedFrequencies[$itemId]
                : $quantity,

            'rate' => isset($savedRates[$itemId])
                ? (float) $savedRates[$itemId]
                : $serviceRate,

            'total' => isset($savedActualExpenses[$itemId])
                ? (float) $savedActualExpenses[$itemId]
                : $totalCost,

            'remarks' => isset($savedRemarks[$itemId])
                ? (string) $savedRemarks[$itemId]
                : ''
        ];

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
            $itemId,
            $savedData
        );
    }
}

// Child mandatory services code starts here
if (!empty($mandatoryChildServices) && is_array($mandatoryChildServices)) {

    foreach ($mandatoryChildServices as $index => $serviceItem) {

        $rawService = trim(
            (string) ($serviceItem['service'] ?? '')
        );

        $serviceParts = explode(
            '_|_',
            $rawService
        );

        $serviceName = trim(
            (string) ($serviceParts[0] ?? $rawService)
        );

        // Float use kiya hai taaki 0.75 jaisi rate 0 na bane.
        $serviceRate = isset($serviceParts[1])
            ? (float) trim($serviceParts[1])
            : 0.0;

        $quantity = (int) (
            $serviceItem['qnty'] ?? 0
        );

        $totalCost = $serviceRate * $quantity;

        // Default me service last day par add hogi.
        $dayNumber = $lastDay;

        // Ye specific services first day par add hongi.
        if (
            stripos(
                $serviceName,
                'Refreshing napkins'
            ) !== false ||
            stripos(
                $serviceName,
                'chocolate inside the vehicle upon arrival'
            ) !== false
        ) {
            $dayNumber = 0;
        }

        $itemId = generateItemId(
            'child_mandatory',
            $index
        );

        $savedData = [
            'frequency' => isset($savedFrequencies[$itemId])
                ? (int) $savedFrequencies[$itemId]
                : $quantity,

            'rate' => isset($savedRates[$itemId])
                ? (float) $savedRates[$itemId]
                : $serviceRate,

            'total' => isset($savedActualExpenses[$itemId])
                ? (float) $savedActualExpenses[$itemId]
                : $totalCost,

            'remarks' => isset($savedRemarks[$itemId])
                ? (string) $savedRemarks[$itemId]
                : ''
        ];

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
            $itemId,
            $savedData
        );
    }
}

if ($ticketCosts && is_array($ticketCosts)) {
    foreach ($ticketCosts as $groupIndex => $ticketGroup) {
        if (!isset($ticketGroup['tickets']) || !is_array($ticketGroup['tickets'])) {
            continue;
        }
        
        $dayNumber = isset($ticketGroup['day']) ? (int)$ticketGroup['day'] : 0;
        $dayNumber = max(0, $dayNumber - 1);
        
        foreach ($ticketGroup['tickets'] as $ticketIndex => $ticket) {
            // ------------------------------
            // 1. GROUP TICKET (new)
            // ------------------------------
            if (isset($ticket['ticket_type']) && $ticket['ticket_type'] === 'group') {
                $ticketName = $ticket['ticket_for'] ?? 'Group Ticket';
                $groupSize = $ticket['group_size'] ?? 0;
                $groupCount = $ticket['group_count'] ?? 1;
                $price = $ticket['price'] ?? 0;
                $total = $ticket['total'] ?? ($ticket['adult_total'] ?? $price * $groupCount);
                
                $serviceName = $ticketName . ($groupSize > 0 ? " (Group of $groupSize)" : " (Group)");
                $itemId = generateItemId('ticket_group', $groupIndex . '_' . $ticketIndex . '_group');
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $groupCount,
                    'rate'      => $savedRates[$itemId]      ?? $price,
                    'total'     => $savedActualExpenses[$itemId] ?? $total,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $serviceName,
                    $groupCount, $price, $total,
                    'ticket', '', $itemId, $savedData
                );
                continue; // skip adult/child processing for this ticket
            }
            
            // ------------------------------
            // 2. Adult row (original)
            // ------------------------------
            $ticketName = $ticket['ticket_for'] ?? 'Ticket';
            $adultCount = isset($ticket['adult_count']) ? (int)$ticket['adult_count'] : 0;
            if ($adultCount > 0) {
                $adultPrice = isset($ticket['price']) ? (float)$ticket['price'] : 0;
                $adultTotal = isset($ticket['adult_total']) ? (float)$ticket['adult_total'] : ($adultCount * $adultPrice);
                
                $itemId = generateItemId('ticket_adult', $groupIndex . '_' . $ticketIndex . '_adult');
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                    'rate'      => $savedRates[$itemId]      ?? $adultPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $adultTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $ticketName . ' (Adult)',
                    $adultCount, $adultPrice, $adultTotal,
                    'ticket', '', $itemId, $savedData
                );
            }
            
            // ------------------------------
            // 3. Child rows (age‑based or flat)
            // ------------------------------
            $isAgeBased = isset($ticket['age_based']) && $ticket['age_based'] == 1;
            
            if ($isAgeBased && isset($ticket['child_ranges']) && is_array($ticket['child_ranges'])) {
                foreach ($ticket['child_ranges'] as $rangeIndex => $range) {
                    $childCount = isset($range['count']) ? (int)$range['count'] : 0;
                    if ($childCount <= 0) continue;
                    
                    $childPrice = isset($range['price']) ? (float)$range['price'] : 0;
                    $childTotal = isset($range['subtotal']) ? (float)$range['subtotal'] : ($childCount * $childPrice);
                    $ageLabel = $range['age_range'] ?? ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                    
                    $itemId = generateItemId('ticket_child_range', $groupIndex . '_' . $ticketIndex . '_range_' . $rangeIndex);
                    $savedData = [
                        'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                        'rate'      => $savedRates[$itemId]      ?? $childPrice,
                        'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                        'remarks'   => $savedRemarks[$itemId]    ?? ''
                    ];
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $ticketName . ' (' . $ageLabel . ')',
                        $childCount, $childPrice, $childTotal,
                        'ticket', '', $itemId, $savedData
                    );
                }
            } else {
                // Flat child pricing
                $childCount = isset($ticket['child_count']) ? (int)$ticket['child_count'] : 0;
                if ($childCount > 0) {
                    $childPrice = isset($ticket['child_price']) ? (float)$ticket['child_price'] : (isset($ticket['price']) ? (float)$ticket['price'] : 0);
                    $childTotal = isset($ticket['child_total']) ? (float)$ticket['child_total'] : ($childCount * $childPrice);
                    
                    $itemId = generateItemId('ticket_child', $groupIndex . '_' . $ticketIndex . '_child');
                    $savedData = [
                        'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                        'rate'      => $savedRates[$itemId]      ?? $childPrice,
                        'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                        'remarks'   => $savedRemarks[$itemId]    ?? ''
                    ];
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $ticketName . ' (Child)',
                        $childCount, $childPrice, $childTotal,
                        'ticket', '', $itemId, $savedData
                    );
                }
            }
        }
    }
}

// sitetscene activity cost code start from here
$activityCostTotal = 0;
if ($activity_cost && is_array($activity_cost)) {
    // Bring saved data arrays into scope
    $addActivityRows = function($dayNumber, $activity, $activityName, $dayIndex, $activityIndex) use (
        &$activityCostTotal, &$itemsByDate, $startDate,
        $savedFrequencies, $savedRates, $savedActualExpenses, $savedRemarks
    ) {
        // ---- GROUP row ----
        if (isset($activity['is_group']) && $activity['is_group'] == 1) {
            $groupCount = isset($activity['group_count']) ? (int)$activity['group_count'] : 0;
            if ($groupCount > 0) {
                $groupPrice = isset($activity['group_price']) ? (float)$activity['group_price'] : 0;
                $groupTotal = isset($activity['group_total']) ? (float)$activity['group_total'] : ($groupPrice * $groupCount);
                $groupSize = isset($activity['group_size']) ? (int)$activity['group_size'] : 0;
                $groupLabel = $groupSize > 0 ? " (Group of $groupSize)" : " (Group)";
                $activityCostTotal += $groupTotal;
                
                $itemId = generateItemId('activity_group', $dayIndex . '_' . $activityIndex . '_group');
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $groupCount,
                    'rate'      => $savedRates[$itemId]      ?? $groupPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $groupTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . $groupLabel,
                    $groupCount, $groupPrice, $groupTotal,
                    'activity', 'Activity', $itemId, $savedData
                );
            }
            return;
        }
        
        // ---- Adult row ----
        $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
        if ($adultCount > 0) {
            $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
            $adultTotal = isset($activity['adult_total']) ? (float)$activity['adult_total'] : ($adultPrice * $adultCount);
            $activityCostTotal += $adultTotal;
            
            $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                'rate'      => $savedRates[$itemId]      ?? $adultPrice,
                'total'     => $savedActualExpenses[$itemId] ?? $adultTotal,
                'remarks'   => $savedRemarks[$itemId]    ?? ''
            ];
            addItemToDate(
                $itemsByDate, $startDate, $dayNumber,
                $activityName . ' (Adult)',
                $adultCount, $adultPrice, $adultTotal,
                'activity', 'Activity', $itemId, $savedData
            );
        }
        
        // ---- Child rows (age ranges) ----
        if (isset($activity['child_age_ranges']) && is_array($activity['child_age_ranges']) && !empty($activity['child_age_ranges'])) {
            foreach ($activity['child_age_ranges'] as $rangeIndex => $range) {
                $childCount = isset($range['count']) ? (int)$range['count'] : 0;
                if ($childCount <= 0) continue;
                
                $childPrice = isset($range['price']) ? (float)$range['price'] : 0;
                $childTotal = isset($range['total']) ? (float)$range['total'] : ($childPrice * $childCount);
                $ageLabel = ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                
                $activityCostTotal += $childTotal;
                $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_range_' . $rangeIndex);
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                    'rate'      => $savedRates[$itemId]      ?? $childPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . ' (' . $ageLabel . ')',
                    $childCount, $childPrice, $childTotal,
                    'activity', 'Activity', $itemId, $savedData
                );
            }
        } else {
            // Flat child pricing (old format)
            $childCount = isset($activity['child_count']) ? (int)$activity['child_count'] : 0;
            if ($childCount > 0) {
                $childPrice = isset($activity['child_price']) ? (float)$activity['child_price'] : 0;
                $childTotal = isset($activity['child_total']) ? (float)$activity['child_total'] : ($childPrice * $childCount);
                $activityCostTotal += $childTotal;
                
                $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_child');
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                    'rate'      => $savedRates[$itemId]      ?? $childPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . ' (Child)',
                    $childCount, $childPrice, $childTotal,
                    'activity', 'Activity', $itemId, $savedData
                );
            }
        }
    };
    
    // Case 1: New format with 'activity_data' key
    if (isset($activity_cost['activity_data']) && is_array($activity_cost['activity_data'])) {
        foreach ($activity_cost['activity_data'] as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    $addActivityRows($dayNumber, $activity, $activityName, $dayIndex, $activityIndex);
                }
            }
        }
    }
    // Case 2: Old format (numeric array)
    elseif (isset($activity_cost[0]) && is_array($activity_cost[0])) {
        foreach ($activity_cost as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    $addActivityRows($dayNumber, $activity, $activityName, $dayIndex, $activityIndex);
                }
            }
        }
    }
}

// ------------------------------------------------------------------
// ENTRANCE COSTS (sites, museums, etc.) – day-wise (supports group pricing)
// ------------------------------------------------------------------
if (!empty($entrance_cost) && is_array($entrance_cost)) {
    foreach ($entrance_cost as $entranceDayGroup) {
        if (!isset($entranceDayGroup['day']) || !isset($entranceDayGroup['entrances'])) {
            continue;
        }
        
        $dayNumber = (int)$entranceDayGroup['day'];
        if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
        
        $entrances = $entranceDayGroup['entrances'];
        if (!is_array($entrances)) continue;
        
        foreach ($entrances as $entrance) {
            $entranceName = $entrance['entrance_name'] ?? 'Entrance';
            $isGroup = isset($entrance['is_group']) && $entrance['is_group'] == 1;
            
            if ($isGroup) {
                $groupCount = isset($entrance['group_count']) ? (int)$entrance['group_count'] : 0;
                if ($groupCount > 0) {
                    $groupPrice = isset($entrance['group_price']) ? (float)$entrance['group_price'] : 0;
                    $groupTotal = isset($entrance['group_total']) ? (float)$entrance['group_total'] : ($groupPrice * $groupCount);
                    $personsPerGroup = isset($entrance['persons_per_group']) ? (int)$entrance['persons_per_group'] : 0;
                    $groupLabel = $personsPerGroup > 0 ? " (Group of $personsPerGroup)" : " (Group)";
                    
                    $itemId = generateItemId('entrance_group', $entrance['entrance_id'] ?? uniqid());
                    
                    // --- Load saved data for this entrance group ---
                    $savedData = [
                        'frequency' => $savedFrequencies[$itemId] ?? $groupCount,
                        'rate'      => $savedRates[$itemId]      ?? $groupPrice,
                        'total'     => $savedActualExpenses[$itemId] ?? $groupTotal,
                        'remarks'   => $savedRemarks[$itemId]    ?? ''
                    ];
                    
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $entranceName . $groupLabel,
                        $savedData['frequency'], $savedData['rate'], $groupTotal,
                        'entrance', '', $itemId, $savedData
                    );
                }
                continue;
            }
            
            // --- Adult row ---
            $adultPrice = $entrance['adult_price'] ?? 0;
            $adultCount = $entrance['adult_count'] ?? 0;
            $adultTotal = $entrance['adult_total'] ?? ($adultPrice * $adultCount);
            
            if ($adultCount > 0 && $adultPrice > 0) {
                $itemId = generateItemId('entrance_adult', $entrance['entrance_id'] ?? uniqid());
                
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                    'rate'      => $savedRates[$itemId]      ?? $adultPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $adultTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $entranceName . ' (Adult)',
                    $savedData['frequency'], $savedData['rate'], $adultTotal,
                    'entrance', '', $itemId, $savedData
                );
            }
            
            // --- Child age group rows ---
            if (isset($entrance['child_age_ranges']) && is_array($entrance['child_age_ranges'])) {
                foreach ($entrance['child_age_ranges'] as $ageRange) {
                    $childCount = $ageRange['count'] ?? 0;
                    $childPrice = $ageRange['price'] ?? 0;
                    $childTotal = $ageRange['total'] ?? ($childPrice * $childCount);
                    $ageLabel = ($ageRange['age_from'] ?? 0) . '-' . ($ageRange['age_to'] ?? 0) . ' yrs';
                    
                    if ($childCount > 0) {
                        $itemId = generateItemId('entrance_child', ($entrance['entrance_id'] ?? uniqid()) . '_' . ($ageRange['age_range_id'] ?? uniqid()));
                        
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                            'rate'      => $savedRates[$itemId]      ?? $childPrice,
                            'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                            'remarks'   => $savedRemarks[$itemId]    ?? ''
                        ];
                        
                        addItemToDate(
                            $itemsByDate, $startDate, $dayNumber,
                            $entranceName . ' (' . $ageLabel . ')',
                            $savedData['frequency'], $savedData['rate'], $childTotal,
                            'entrance', '', $itemId, $savedData
                        );
                    }
                }
            }
            // ---- Flat child pricing (if no age ranges) ----
            else if (isset($entrance['child_price']) && isset($entrance['child_count']) && $entrance['child_count'] > 0) {
                $childCount = (int)$entrance['child_count'];
                $childPrice = (float)$entrance['child_price'];
                $childTotal = isset($entrance['child_total']) ? (float)$entrance['child_total'] : ($childPrice * $childCount);
                $itemId = generateItemId('entrance_child_flat', ($entrance['entrance_id'] ?? uniqid()) . '_flat');
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $entranceName . ' (Child)',
                    $savedData['frequency'], $savedData['rate'], $childTotal,
                    'entrance', '', $itemId, $savedData
                );
            }
        }
    }
}

// OUTSIDE COSTS PROCESSING - पुराने लॉजिक के अनुसार
$outsideCostByDate = [];
$outsideCostTotal = 0;
$vehicleNames = [];

if ($outside_cost && is_array($outside_cost)) {
    foreach ($outside_cost as $outsideIndex => $outsideDay) {
        $dayNumber = $outsideDay['day'];
        
        if (isset($outsideDay['vehicles']) && is_array($outsideDay['vehicles'])) {
            foreach ($outsideDay['vehicles'] as $vehicleIndex => $vehicle) {
                
                $vehicleName = $vehicle['vehicle_name'] ?? 'Vehicle';
                if (!in_array($vehicleName, $vehicleNames)) {
                    $vehicleNames[] = $vehicleName;
                }
                
                $siteScene = $vehicle['sitescene'] ?? '';
                $siteId = $vehicle['site_id'] ?? '';
                $qty = $vehicle['qty'] ?? 1;
                
                // Calculate components
                $vehiclePrice = $vehicle['price'] ?? 0;
                $parkingAmount = $vehicle['parking'] ?? 0;
                $tollAmount = $vehicle['toll'] ?? 0;
                
                // Total price (price + parking)
                $price = $vehiclePrice + $parkingAmount;
                $total = ($price * $qty) + $tollAmount;

                $outsideCostTotal += $total;
                
                $vehicleItemId = generateItemId('outside', $outsideIndex . '_' . $vehicleIndex . '_vehicle');
                $tollItemId = generateItemId('outside', $outsideIndex . '_' . $vehicleIndex . '_toll');
                
                // Map to itinerary day if site_id exists
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
                
                if (!isset($outsideCostByDate[$actualDayNumber])) {
                    $outsideCostByDate[$actualDayNumber] = [];
                }
                
                // Add vehicle row (with supplement in bracket)
                $serviceName = $siteScene;
                if ($parkingAmount > 0) {
                    $serviceName .= " (Supplement " . number_format($parkingAmount, 2, '.', '') . ")";
                }
                
                $savedVehicleData = [
                    'frequency' => $savedFrequencies[$vehicleItemId] ?? $qty,
                    'rate' => $savedRates[$vehicleItemId] ?? $price,
                    'total' => $savedActualExpenses[$vehicleItemId] ?? ($price * $qty),
                    'remarks' => $savedRemarks[$vehicleItemId] ?? ''
                ];
                
                $outsideCostByDate[$actualDayNumber][] = [
                    'service' => $serviceName . " (Supplement) (Included in bundle)",
                    'frequency' => $savedVehicleData['frequency'],
                    'rate' => 0,
                    'total' => 0,
                    'actual_total' => 0,
                    'type' => 'outside',
                    'remarks' => $savedVehicleData['remarks'],
                    'item_id' => $vehicleItemId,
                    'site_id' => $siteId,
                    'parking_amount' => $parkingAmount,
                    'is_vehicle' => true
                ];
                
                // Add separate row for toll if toll amount > 0
                if ($tollAmount > 0) {
                    $savedTollData = [
                        'frequency' => $savedFrequencies[$tollItemId] ?? $qty,
                        'rate' => $savedRates[$tollItemId] ?? $tollAmount,
                        'total' => $savedActualExpenses[$tollItemId] ?? $tollAmount,
                        'remarks' => $savedRemarks[$tollItemId] ?? ''
                    ];
                    
                    $outsideCostByDate[$actualDayNumber][] = [
                        'service' => $serviceName . " (Toll)",
                        'frequency' => $savedTollData['frequency'],
                        'rate' => 0,
                        'total' => 0,
                        'actual_total' => 0,
                        'type' => 'outside_toll',
                        'remarks' => $savedTollData['remarks'],
                        'item_id' => $tollItemId,
                        'site_id' => $siteId,
                        'is_toll' => true,
                        'parent_vehicle' => $vehicleItemId
                    ];
                }
            }
        }
    }
}

// Add outside costs to itemsByDate
foreach ($outsideCostByDate as $dayNumber => $outsideItems) {
    $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $dayNumber . ' days'));
    
    if (!isset($itemsByDate[$dateKey])) {
        $displayDate = date('d M', strtotime($startDate . ' + ' . $dayNumber . ' days'));
        $itemsByDate[$dateKey] = [
            'display_date' => $displayDate,
            'date_key' => $dateKey,
            'items' => []
        ];
    }
    
    foreach ($outsideItems as $item) {
        $itemsByDate[$dateKey]['items'][] = $item;
    }
}

// Use the same cutoff date as hotel costing
$mark_final_date_meal = $report->modified;
$cutoff_date_meal = '2026-04-17';
// $cutoff_date_meal = '2026-05-01';

if ($mark_final_date_meal >= $cutoff_date_meal) {

    if (!empty($mealData) && is_array($mealData)) {

        // Step 1: Collect all unique meal IDs from the data (works for both structures)
        $mealIds = [];
        foreach ($mealData as $dayMeals) {
            if (!is_array($dayMeals)) continue;

            // Detect structure for this day: direct mealId map or cuisine grouping
            $isDirect = false;
            foreach ($dayMeals as $k => $v) {
                if (is_numeric($k) && is_array($v) && isset($v['adult'])) {
                    $isDirect = true;
                    break;
                }
            }

            if ($isDirect) {
                // Structure: day => [ mealId => details ]
                foreach ($dayMeals as $mealId => $details) {
                    if (is_numeric($mealId)) $mealIds[$mealId] = $mealId;
                }
            } else {
                // Structure: day => [ cuisine => [ mealId => details ] ]
                foreach ($dayMeals as $mealsByCuisine) {
                    if (!is_array($mealsByCuisine)) continue;
                    foreach ($mealsByCuisine as $mealId => $details) {
                        if (is_numeric($mealId)) $mealIds[$mealId] = $mealId;
                    }
                }
            }
        }

        // Step 2: Fetch buffet names from database
        $buffetNames = [];
        if (!empty($mealIds)) {
            $query = $this->db->select('id, buffet')
                ->from('meal_per_person_cost')
                ->where_in('id', $mealIds)
                ->get();
            foreach ($query->result() as $row) {
                $buffetNames[$row->id] = $row->buffet;
            }
        }

        // Step 3: Build entertainment lookup array by day_key and meal_id
        $entertainmentLookup = [];
        if (!empty($entertainmentData) && is_array($entertainmentData)) {
            foreach ($entertainmentData as $dayKey => $dayEntertainment) {
                if (!is_array($dayEntertainment)) continue;
                foreach ($dayEntertainment as $mealId => $entertainmentItems) {
                    if (!is_array($entertainmentItems)) continue;
                    foreach ($entertainmentItems as $entName => $details) {
                        $entertainmentLookup[$dayKey][$mealId][$entName] = $details;
                    }
                }
            }
        }

        // Step 4: Process each day and meal – add entertainment immediately after each meal's rows
        foreach ($mealData as $dayKey => $dayMeals) {
            if (strtolower($dayKey) === 'all') continue;

            $dayNumber = 0;
            if (preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) {
                $dayNumber = (int)$matches[1] - 1;
            } else {
                continue;
            }
            if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
            if (!is_array($dayMeals)) continue;

            // ---- Detect structure for this day ----
            $isDirectMealMap = false;
            foreach ($dayMeals as $k => $v) {
                if (is_numeric($k) && is_array($v) && isset($v['adult'])) {
                    $isDirectMealMap = true;
                    break;
                }
            }

            if ($isDirectMealMap) {
                // ----- STRUCTURE A: day => [ mealId => details ] (your provided array) -----
                foreach ($dayMeals as $mealId => $mealDetails) {
                    if (!isset($mealDetails['adult'])) continue;

                    $buffetName = $buffetNames[$mealId] ?? ($mealDetails['buffet'] ?? 'Meal ' . $mealId);
                    $ctype = $mealDetails['cuisine'] ?? 'Unknown';
                    $serviceBase = ucfirst($ctype) . ' (' . ucfirst($buffetName) . ')';

                    $adultData = $mealDetails['adult'];
                    $adultPrice = $adultData['price'] ?? 0;
                    $adultCount = $adultData['count'] ?? 0;
                    $adultTotal = $adultData['total'] ?? ($adultPrice * $adultCount);

                    // ---- Adult row ----
                    if ($adultCount > 0 && $adultPrice > 0) {
                        $itemId = generateItemId('meal_adult', $dayKey . '_' . $mealId);
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                            'rate'      => $savedRates[$itemId]      ?? $adultPrice,
                            'total'     => $savedActualExpenses[$itemId] ?? $adultTotal,
                            'remarks'   => $savedRemarks[$itemId]    ?? ''
                        ];
                        addItemToDate(
                            $itemsByDate, $startDate, $dayNumber,
                            $serviceBase . ' (Adult)',
                            $adultCount, $adultPrice, $adultTotal,
                            'meal', '', $itemId, $savedData
                        );
                    }

                    // ---- Child groups rows ----
                    if (isset($mealDetails['child_groups']) && is_array($mealDetails['child_groups'])) {
                        foreach ($mealDetails['child_groups'] as $groupIndex => $group) {
                            $childCount = $group['count'] ?? 0;
                            $childPrice = $group['price'] ?? 0;
                            $childTotal = $group['total'] ?? ($childPrice * $childCount);
                            $range = $group['range'] ?? 'Child';
                            if ($childCount > 0) {
                                $itemId = generateItemId('meal_child', $dayKey . '_' . $mealId . '_' . $groupIndex);
                                $savedData = [
                                    'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                                    'rate'      => $savedRates[$itemId]      ?? $childPrice,
                                    'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                                ];
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceBase . ' (' . $range . ')',
                                    $childCount, $childPrice, $childTotal,
                                    'meal', '', $itemId, $savedData
                                );
                            }
                        }
                    }

                    // ---- ENTERTAINMENT for this exact meal ----
                    if (isset($entertainmentLookup[$dayKey][$mealId])) {
                        $entData = $entertainmentLookup[$dayKey][$mealId];
                        
                        // Check if this is the old structure (direct price/qty/total, no name level)
                        if (isset($entData['price']) && isset($entData['qty']) && isset($entData['total'])) {
                            // Old structure: create a single item with a default name (e.g., "Entertainment")
                            // You can change the default name as needed, or pass a variable from context
                            $defaultName = 'Belly Dance'; // or 'Entertainment'
                            $originalQty   = $entData['qty'];
                            $originalPrice = $entData['price'];
                            $originalTotal = $entData['total'];
                            
                            if ($originalPrice > 0) {
                                $itemId = generateItemId('entertainment', $dayKey . '_' . $mealId . '_default');
                                
                                $frequency = $savedFrequencies[$itemId] ?? $originalQty;
                                $rate      = $savedRates[$itemId]      ?? $originalPrice;
                                $actualTotal = $savedActualExpenses[$itemId] ?? $originalTotal;
                                $remarks   = $savedRemarks[$itemId]    ?? '';
                                
                                $savedData = [
                                    'frequency' => $frequency,
                                    'rate'      => $rate,
                                    'total'     => $actualTotal,
                                    'remarks'   => $remarks
                                ];
                                
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $defaultName, $frequency, $rate, $originalTotal,
                                    'entertainment', '', $itemId, $savedData
                                );
                            }
                        } else {
                            // New structure: iterate over entertainment names
                            foreach ($entData as $entName => $details) {
                                $originalQty   = $details['qty'] ?? 1;
                                $originalPrice = $details['price'] ?? 0;
                                $originalTotal = $details['total'] ?? ($originalPrice * $originalQty);
                                
                                if ($originalPrice <= 0) continue;
                                
                                $itemId = generateItemId('entertainment', $dayKey . '_' . $mealId . '_' . $entName);
                                
                                $frequency = $savedFrequencies[$itemId] ?? $originalQty;
                                $rate      = $savedRates[$itemId]      ?? $originalPrice;
                                $actualTotal = $savedActualExpenses[$itemId] ?? $originalTotal;
                                $remarks   = $savedRemarks[$itemId]    ?? '';
                                
                                $serviceName = ucwords(str_replace('_', ' ', $entName)); // "belly_dance" -> "Belly Dance"
                                
                                $savedData = [
                                    'frequency' => $frequency,
                                    'rate'      => $rate,
                                    'total'     => $actualTotal,
                                    'remarks'   => $remarks
                                ];
                                
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceName, $frequency, $rate, $originalTotal,
                                    'entertainment', '', $itemId, $savedData
                                );
                            }
                        }
                    }
                }
            } else {
                // ----- STRUCTURE B: day => [ cuisine => [ mealId => details ] ] (original expectation) -----
                foreach ($dayMeals as $cuisineType => $mealsByCuisine) {
                    if (!is_array($mealsByCuisine)) continue;
                    foreach ($mealsByCuisine as $mealId => $mealDetails) {
                        if (!isset($mealDetails['adult'])) continue;

                        $buffetName = $buffetNames[$mealId] ?? 'Meal ' . $mealId;
                        $ctype = $mealDetails['ctype'] ?? $cuisineType;
                        $serviceBase = ucfirst($ctype) . ' (' . ucfirst($buffetName) . ')';

                        $adultData = $mealDetails['adult'];
                        $adultPrice = $adultData['price'] ?? 0;
                        $adultCount = $adultData['count'] ?? 0;
                        $adultTotal = $adultData['total'] ?? ($adultPrice * $adultCount);

                        // ---- Adult row ----
                        if ($adultCount > 0 && $adultPrice > 0) {
                            $itemId = generateItemId('meal_adult', $dayKey . '_' . $cuisineType . '_' . $mealId);
                            $savedData = [
                                'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                                'rate'      => $savedRates[$itemId]      ?? $adultPrice,
                                'total'     => $savedActualExpenses[$itemId] ?? $adultTotal,
                                'remarks'   => $savedRemarks[$itemId]    ?? ''
                            ];
                            addItemToDate(
                                $itemsByDate, $startDate, $dayNumber,
                                $serviceBase . ' (Adult)',
                                $adultCount, $adultPrice, $adultTotal,
                                'meal', '', $itemId, $savedData
                            );
                        }

                        // ---- Child groups rows ----
                        if (isset($mealDetails['child_groups']) && is_array($mealDetails['child_groups'])) {
                            foreach ($mealDetails['child_groups'] as $groupIndex => $group) {
                                $childCount = $group['count'] ?? 0;
                                $childPrice = $group['price'] ?? 0;
                                $childTotal = $group['total'] ?? ($childPrice * $childCount);
                                $range = $group['range'] ?? 'Child';
                                if ($childCount > 0) {
                                    $itemId = generateItemId('meal_child', $dayKey . '_' . $cuisineType . '_' . $mealId . '_' . $groupIndex);
                                    $savedData = [
                                        'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                                        'rate'      => $savedRates[$itemId]      ?? $childPrice,
                                        'total'     => $savedActualExpenses[$itemId] ?? $childTotal,
                                        'remarks'   => $savedRemarks[$itemId]    ?? ''
                                    ];
                                    addItemToDate(
                                        $itemsByDate, $startDate, $dayNumber,
                                        $serviceBase . ' (' . $range . ')',
                                        $childCount, $childPrice, $childTotal,
                                        'meal', '', $itemId, $savedData
                                    );
                                }
                            }
                        }

                        // ---- ENTERTAINMENT for this exact meal ----
                        if (isset($entertainmentLookup[$dayKey][$mealId])) {
                            foreach ($entertainmentLookup[$dayKey][$mealId] as $entName => $details) {
                                $price = $details['price'] ?? 0;
                                $qty   = $details['qty'] ?? 1;
                                $total = $details['total'] ?? ($price * $qty);
                                if ($price <= 0) continue;
                                $serviceName = ucwords($entName);
                                $itemId = generateItemId('entertainment', $dayKey . '_' . $mealId . '_' . $entName);
                                $savedData = [
                                    'frequency' => $savedFrequencies[$itemId] ?? $qty,
                                    'rate'      => $savedRates[$itemId]      ?? $price,
                                    'total'     => $savedActualExpenses[$itemId] ?? $total,
                                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                                ];
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceName, $qty, $price, $total,
                                    'entertainment', '', $itemId, $savedData
                                );
                            }
                        }
                    }
                }
            }
        }
    }

} else {
    // ------------------------------
    // OLD MEAL STRUCTURE (simple price per person)
    // ------------------------------
    if (!empty($mealData) && is_array($mealData)) {
        foreach ($mealData as $dayKey => $dayMeals) {
            if (strtolower($dayKey) === 'all') continue;
            
            $dayNumber = 0;
            if (preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) {
                $dayNumber = (int)$matches[1] - 1;
            } else {
                continue;
            }
            if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
            
            if (!is_array($dayMeals)) continue;
            
            foreach ($dayMeals as $mealType => $mealDetails) {
                if (!is_array($mealDetails)) continue;
                
                $mealName = ucfirst($mealType);
                if (isset($mealDetails['cusine']) && !empty($mealDetails['cusine'])) {
                    $mealName .= " ({$mealDetails['cusine']})";
                }
                
                $price = $mealDetails['price'] ?? 0;
                $totalPersons = $mealDetails['total_persons'] ?? 0;
                $mealTotal = $mealDetails['meal_total'] ?? ($price * $totalPersons);
                
                if ($price <= 0) continue;
                if ($totalPersons <= 0) $totalPersons = 1;
                if ($mealTotal <= 0) $mealTotal = $price * $totalPersons;
                
                $itemId = generateItemId('meal', $dayKey . '_' . $mealType);
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $totalPersons,
                    'rate'      => $savedRates[$itemId]      ?? $price,
                    'total'     => $savedActualExpenses[$itemId] ?? $mealTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $mealName, $totalPersons, $price, $mealTotal,
                    'meal', '', $itemId, $savedData
                );
            }
        }
    }
}

// ------------------------------------------------------------------
// TRAIN TICKETS (daywise_train) – with saved data support
// ------------------------------------------------------------------
if (!empty($daywise_train)) {
    if (is_string($daywise_train)) {
        $daywise_train = json_decode($daywise_train, true);
    }
    
    if (is_array($daywise_train)) {
        foreach ($daywise_train as $trainDay) {
            if (!isset($trainDay['day']) || !isset($trainDay['trains'])) continue;
            $dayNumber = (int)$trainDay['day'] - 1;
            if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
            
            foreach ($trainDay['trains'] as $idx => $train) {
                $passengerType = $train['passenger_type'] ?? 'adult';
                $qty = (int)($train['qty'] ?? 0);
                if ($qty == 0) continue;
                
                // Determine service name based on available fields
                $trainName = trim($train['train_name'] ?? '');
                $ticketTypeLabel = trim($train['ticket_type_label'] ?? '');
                
                if ($passengerType === 'child') {
                    // For child tickets, use a default name if labels are missing
                    if (empty($trainName) && empty($ticketTypeLabel)) {
                        $serviceName = "Train (Child)";
                    } elseif (empty($trainName)) {
                        $serviceName = "Train ($ticketTypeLabel) - Child";
                    } elseif (empty($ticketTypeLabel)) {
                        $serviceName = "Train: $trainName - Child";
                    } else {
                        $serviceName = "Train: $trainName ($ticketTypeLabel) - Child";
                    }
                } else {
                    // Adult tickets – require at least train name or label to be meaningful
                    if (empty($trainName) && empty($ticketTypeLabel)) {
                        continue; // skip completely empty adult tickets
                    }
                    if (empty($trainName)) {
                        $serviceName = "Train ($ticketTypeLabel) - Adult";
                    } elseif (empty($ticketTypeLabel)) {
                        $serviceName = "Train: $trainName - Adult";
                    } else {
                        $serviceName = "Train: $trainName ($ticketTypeLabel) - Adult";
                    }
                }
                
                $budgetQty = $qty;
                $budgetPrice = (float)($train['price'] ?? 0);
                $budgetTotal = (float)($train['total'] ?? ($budgetPrice * $budgetQty));
                
                $itemId = generateItemId('train_ticket', $trainDay['day'] . '_' . $idx);
                
                // Apply saved data if any
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $budgetQty,
                    'rate'      => $savedRates[$itemId]      ?? $budgetPrice,
                    'total'     => $savedActualExpenses[$itemId] ?? $budgetTotal,
                    'remarks'   => $savedRemarks[$itemId]    ?? ''
                ];
                
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $serviceName,
                    $budgetQty,   // budget frequency
                    $budgetPrice, // budget rate
                    $budgetTotal, // budget total
                    'train_ticket', '', $itemId, $savedData
                );
            }
        }
    }
}

// ------------------------------------------------------------------
// DINNER TRANSFER COSTS – per day (with saved remarks & actuals)
// ------------------------------------------------------------------
if (!empty($dinner_transfer_data) && is_array($dinner_transfer_data)) {
    foreach ($dinner_transfer_data as $dayKey => $transferItems) {
        if (empty($transferItems) || !is_array($transferItems)) {
            continue;
        }
        
        if (preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) {
            $dayNumber = (int)$matches[1] - 1;
            if ($dayNumber < 0 || $dayNumber >= $totalDays) {
                continue;
            }
        } else {
            continue;
        }
        
        foreach ($transferItems as $mealId => $details) {
            $price = $details['price'] ?? 0;
            $qty   = $details['qty'] ?? 1;
            $total = $details['total'] ?? ($price * $qty);
            
            if ($price <= 0) continue;
            
            $serviceName = 'Dinner Transfer';
            $itemId = generateItemId('dinner_transfer', $dayKey . '_' . $mealId);
            
            // Build saved data array
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $qty,
                'rate'      => $savedRates[$itemId]      ?? 0,
                'total'     => $savedActualExpenses[$itemId] ?? 0,
                'remarks'   => $savedRemarks[$itemId]    ?? ''
            ];
            
            addItemToDate(
                $itemsByDate, $startDate, $dayNumber,
                $serviceName . ' (' . 'Included in bundle' . ')',
                $qty, 0, 0,
                'dinner_transfer',
                '', $itemId, $savedData   // <-- pass saved data
            );
        }
    }
}

// ------------------------------------------------------------------
// DRIVER COSTS – day-wise (food, accommodation, guide charge)
// ------------------------------------------------------------------
if (!empty($driverCosts) && is_array($driverCosts)) {
    foreach ($driverCosts as $driverItem) {
        if (!isset($driverItem['day'])) continue;
        $dayNumber = (int)$driverItem['day'];
        if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
        
        $qty = isset($driverItem['qty']) ? (int)$driverItem['qty'] : 1;
        
        // --- Food ---
        if (isset($driverItem['food']) && $driverItem['food'] >= 0) {
            $foodPrice = (float)$driverItem['food'];
            $foodTotal = $foodPrice * $qty;
            $itemId = generateItemId('driver_food', $driverItem['index'] ?? uniqid());
            
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $qty,
                'rate'      => $savedRates[$itemId]      ?? $foodPrice,
                'total'     => $savedActualExpenses[$itemId] ?? $foodTotal,
                'remarks'   => $savedRemarks[$itemId]    ?? ''
            ];
            
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Food)', 
                $qty, $foodPrice, $foodTotal, 'driver', '', $itemId, $savedData);
        }
        
        // --- Accommodation ---
        if (isset($driverItem['accomodation']) && $driverItem['accomodation'] >= 0) {
            $accomPrice = (float)$driverItem['accomodation'];
            $accomTotal = $accomPrice * $qty;
            $itemId = generateItemId('driver_accom', $driverItem['index'] ?? uniqid());
            
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $qty,
                'rate'      => $savedRates[$itemId]      ?? $accomPrice,
                'total'     => $savedActualExpenses[$itemId] ?? $accomTotal,
                'remarks'   => $savedRemarks[$itemId]    ?? ''
            ];
            
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Accommodation)', 
                $qty, $accomPrice, $accomTotal, 'driver', '', $itemId, $savedData);
        }
        
        // --- Guide charge (driver guide charge) ---
        if (isset($driverItem['guide_charge']) && $driverItem['guide_charge'] >= 0) {
            $guidePrice = (float)$driverItem['guide_charge'];
            $guideTotal = $guidePrice * $qty;
            $itemId = generateItemId('driver_guide', $driverItem['index'] ?? uniqid());
            
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $qty,
                'rate'      => $savedRates[$itemId]      ?? $guidePrice,
                'total'     => $savedActualExpenses[$itemId] ?? $guideTotal,
                'remarks'   => $savedRemarks[$itemId]    ?? ''
            ];
            
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Day Charge)', 
                $qty, $guidePrice, $guideTotal, 'driver', '', $itemId, $savedData);
        }
    }
}

// ------------------------------------------------------------------
// Add "No Service" for any day that has no items
// ------------------------------------------------------------------
for ($day = 0; $day < $totalDays; $day++) {
    $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $day . ' days'));
    if (!isset($itemsByDate[$dateKey])) {
        $displayDate = date('d M', strtotime($startDate . ' + ' . $day . ' days'));
        $itemsByDate[$dateKey] = [
            'display_date' => $displayDate,
            'date_key' => $dateKey,
            'items' => [
                [
                    'service' => 'No Service',
                    'frequency' => 0,
                    'rate' => 0,
                    'total' => 0,
                    'type' => 'noservice',
                    'remarks' => '',
                    'item_id' => 'noservice_' . $day
                ]
            ]
        ];
    }
}

// Sort by date
ksort($itemsByDate);

// Calculate Entrance, Activity, Meal, Guide, Entertainment, Dinner transfer totals
$hotelTotal = 0;
$TicketCostTotal = 0;
$trainTicketTotal = 0;
$entranceTotal = 0;
$activityTotal = 0;
$dinnerTransferTotal = 0;
$mealTotal = 0;
$guideTotal = 0;
$entertainmentTotal = 0;
foreach ($itemsByDate as $dateData) {
    foreach ($dateData['items'] as $item) {
        if ($item['type'] === 'entrance') {
            $entranceTotal += $item['total'];
        } elseif ($item['type'] === 'activity') {
            $activityTotal += $item['total'];
        } elseif ($item['type'] === 'dinner_transfer') {
            $dinnerTransferTotal += $item['total'];
        } elseif ($item['type'] === 'meal') {
            $mealTotal += $item['total'];
        } elseif ($item['type'] === 'guide') {
            $guideTotal += (float)$item['total'];
        } elseif ($item['type'] === 'entertainment') {
            $entertainmentTotal += $item['total'];
        } elseif ($item['type'] === 'hotel') {
            $hotelTotal += $item['total'];
        } elseif ($item['type'] === 'ticket') {
            $TicketCostTotal += $item['total'];
        } elseif ($item['type'] === 'train_ticket') {
            $trainTicketTotal += $item['total'];
        } 
    }
}

// Recalculate subtotal with meals included
$subtotal = 0;
$actualSubtotal = 0;
foreach ($itemsByDate as $dateData) {
    foreach ($dateData['items'] as $item) {
        $subtotal += (float)$item['total'] ?? 0;
        // $actualSubtotal += (float)$item['actual_total'] ?? 0;
        $actualSubtotal += (float)($item['actual_total'] ?? 0);
    }
}

$bundlePriceRemark = '';
if (!empty($vehicleNames)) {
    $bundlePriceRemark = implode(', ', $vehicleNames);
}

// $netBundlePrice = ($totalTransport - $discount_bundle_price) - $outsideCostTotal;
$netBundlePrice = ($totalTransport - $discount_bundle_price);
if ($netBundlePrice < 0) {
    $netBundlePrice = 0;
}

// Get saved bundle price data
$savedBundleTotal = $savedActualExpenses['bundle_price']?? $netBundlePrice;
$savedBundleRemark = $savedRemarks['bundle_price'] ?? $bundlePriceRemark;

// Calculate final total including meals - पुराने लॉजिक के अनुसार
$finalTotal = $subtotal + $netBundlePrice; 
$finalActualTotal = $actualSubtotal + $savedBundleTotal;

// Get saved exchange rate and USD amount
$savedExchangeRate = $savedActualExpenses['exchange_rate'] ?? $exchangeRate;
$savedUSDAmount = $savedActualExpenses['usd_actual'] ?? (($savedExchangeRate > 0) ? $finalActualTotal / $savedExchangeRate : 0);

$usdAmount = ($exchangeRate > 0) ? $finalTotal / $exchangeRate : 0;
?>

    <table class="budget-report" style="border:2px solid #000000ff;">
        <thead>
            <tr >
                <th colspan="5" style="background-color: #FF7C80;"></th>
                <th style="background-color: #FF7C80;">ORIGINAL BUDGET</th>
                <th style="background-color: #FF7C80;">CLOSING BUDGET</th>
                <th style="background-color: #FF7C80;"></th>
            </tr>
            <tr>
                <th style="background-color: #E6B8B7; width: 100px;">SELECTION</th>
                <th style="background-color: #E6B8B7;">DATE</th>
                <th style="background-color: #E6B8B7;">SERVICES</th>
                <th style="background-color: #E6B8B7;">FREQUENCY</th>
                <th style="background-color: #E6B8B7;">RATE IN <?php echo $currency_abbr; ?></th>
                <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr; ?></th>
                <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr; ?></th>
                <th style="background-color: #E6B8B7;min-width:400px;">REMARKS</th>
                <th style="background-color: #E6B8B7; display: none;">COMPLETE DATA (Hidden)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $hasData = !empty($itemsByDate);
            $previousDateKey = null;
            $dateCounter = 0;
            
            if ($hasData) {
                foreach ($itemsByDate as $dateKey => $dateData) {
                    // Add gap between different dates
                    if ($previousDateKey !== null && $dateCounter > 0) {
                        echo '<tr class="date-gap-row">';
                        echo '<td colspan="8"></td>';
                        echo '</tr>';
                    }
                    
                    $displayDate = $dateData['display_date'];
                    $items = $dateData['items'];
                    $rowspan = count($items);
                    
                    // Get saved selection for this date
                    $savedDateSelection = $savedSelections['date_selections'][$dateKey] ?? 'no_change';
                    
                    foreach ($items as $index => $item) {
                        // Set background color based on item type
                        $bgColor = '';
                        $rowBgColor = '';
                        if ($item['type'] === 'activity') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                            $rowBgColor = 'style="background-color: #D9EAD3;"';
                        } elseif ($item['type'] === 'hotel') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                            $rowBgColor = 'style="background-color: #ffffffff;"';
                        } elseif ($item['type'] === 'outside') {
                            $bgColor = 'style="background-color: #ffffffff !important;"';
                            $rowBgColor = 'style="background-color: #ffffffff;"';
                        } elseif ($item['type'] === 'meal') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                            $rowBgColor = 'style="background-color: #ffffffff;"';
                        }
                        
                        // Determine if this is the first row for this date
                        $isFirstRow = ($index === 0);
            ?>
            <tr <?php echo $rowBgColor; ?> data-item-id="<?php echo $item['item_id']; ?>" data-date-key="<?php echo $dateKey; ?>" data-type="<?php echo $item['type']; ?>">
                <?php if ($isFirstRow): ?>
                <td rowspan="<?php echo $rowspan; ?>" <?php echo $rowBgColor; ?> style="vertical-align: top;">
                    <select class="date-selection" data-date-key="<?php echo $dateKey; ?>" onchange="handleDateSelectionChange(this)">
                        <option value="no_change" <?php echo ($savedDateSelection == 'no_change') ? 'selected' : ''; ?>>No Change</option>
                        <option value="change" <?php echo ($savedDateSelection == 'change') ? 'selected' : ''; ?>>Change</option>
                    </select>
                </td>
                <td rowspan="<?php echo $rowspan; ?>" <?php echo $rowBgColor; ?> style="vertical-align: top;">
                    <?php echo htmlspecialchars($displayDate); ?>
                </td>
                <?php endif; ?>
                
                <td <?php echo $bgColor; ?> data-service="<?php echo htmlspecialchars($item['service']); ?>">
                    <?php if ($item['type'] === 'outside'): ?>
                        <?php echo formatServiceText($item['service']); ?>
                    <?php else: ?>
                        <?php echo formatServiceText($item['service']); ?>
                    <?php endif; ?>
                </td>
                
                <td <?php echo $bgColor; ?>>
                    <input type="text" class="frequency-input" data-item-id="<?php echo $item['item_id']; ?>" 
                        value="<?php echo $item['frequency']; ?>" 
                        readonly
                        onchange="updateItemTotal('<?php echo $item['item_id']; ?>')">
                </td>
                
                <td <?php echo $bgColor; ?>>
                    <?php 
                        $rateValue = '';
                        if (is_string($item['rate']) && strpos($item['rate'], '/') !== false) {
                            $rateParts = explode('/', $item['rate']);
                            $rateValue = number_format($rateParts[0], 2, '.', '');
                            if (isset($rateParts[1]) && $rateParts[1] > 0) {
                                $rateValue .= '/' . number_format($rateParts[1], 2, '.', '');
                            }
                        } else {
                            $rateValue = number_format($item['rate'], 2, '.', '');
                        }
                    ?>
                    <input type="text" 
                        class="rate-input" 
                        data-item-id="<?php echo $item['item_id']; ?>" 
                        value="<?php echo $rateValue; ?>" 
                        readonly
                        onchange="updateItemTotal('<?php echo $item['item_id']; ?>')">
                </td>
                
                <td style="background-color: #eccdccff;" class="budget-total" data-item-id="<?php echo $item['item_id']; ?>">
                    <?php echo number_format((float)$item['total'], 2, '.', ''); ?>
                </td>
                
                <td style="background-color: #eccdccff;">
                    <input type="text" 
                        class="actual-expense-input" 
                        data-item-id="<?php echo $item['item_id']; ?>" 
                        value="<?php echo number_format((float)($item['actual_total'] ?? 0), 2, '.', ''); ?>" 
                        readonly
                        onchange="updateTotalCalculations()">
                </td>
                
                <td <?php echo $bgColor; ?>>
                    <textarea class="remarks-input" 
                            data-item-id="<?php echo $item['item_id']; ?>" 
                            placeholder="Add remarks..." 
                            style="background-color: #fffacd;"><?php echo htmlspecialchars($item['remarks']); ?></textarea>
                    <div class="remark-required" style="color: red; font-size: 12px; display: none;">Remark is required</div>
                </td>
            </tr>
            <?php
                    }
                    $previousDateKey = $dateKey;
                    $dateCounter++;
                }
            
                $lastDate = date('d M', strtotime($startDate . ' + ' . $lastDay . ' days'));
            ?>
            
            <!-- Additional Transfers (Editable, No Date) -->
            <?php 
                $savedAdditionalSelection = $savedSelections['outside_selections']['additional_transfers'] ?? 'no_change';
                $savedAdditionalFrequency = $savedFrequencies['additional_transfers'] ?? 0;
                $savedAdditionalRate = $savedRates['additional_transfers'] ?? 0;
                $savedAdditionalTotal = $savedActualExpenses['additional_transfers'] ?? 0;
                $savedAdditionalRemark = $savedRemarks['additional_transfers'] ?? '';
            ?>
            <tr class="outside-section">
                <td>
                    <select class="outside-selection" data-type="additional_transfers" onchange="handleOutsideSelectionChange(this)">
                        <option value="no_change" <?php echo ($savedAdditionalSelection == 'no_change') ? 'selected' : ''; ?>>No Change</option>
                        <option value="change" <?php echo ($savedAdditionalSelection == 'change') ? 'selected' : ''; ?>>Change</option>
                    </select>
                </td>
                <td></td>
                <td style="font-weight: bold;">Add On-Ground Services (Miscellaneous)</td>
                <td>
                    <input type="text" 
                        id="additional-transfers-frequency" 
                        value="<?php echo $savedAdditionalFrequency; ?>" 
                        readonly
                        onchange="updateAdditionalTransfersTotal()">
                </td>
                <td>
                    <input type="text" 
                        id="additional-transfers-rate" 
                        value="<?php echo number_format($savedAdditionalRate, 2, '.', ''); ?>" 
                        readonly
                        onchange="updateAdditionalTransfersTotal()">
                </td>
                <td style="background-color: #eccdccff;" id="additional-transfers-budget-total">0</td>
                <td style="background-color: #eccdccff;">
                    <input type="text" 
                        id="additional-transfers-actual-expense" 
                        value="<?php echo number_format($savedAdditionalTotal, 2, '.', ''); ?>" 
                        readonly
                        onchange="updateTotalCalculations()">
                </td>
                <td>
                    <textarea id="additional-transfers-remarks" placeholder="Add remarks..." style="background-color: #fffacd;"><?php echo htmlspecialchars($savedAdditionalRemark); ?></textarea>
                    <div class="remark-required" style="color: red; font-size: 12px; display: none;">Remark is required when value is changed</div>
                </td>
            </tr>
            
            <!-- Bundle Price (Editable, No Date) -->
            <?php if ($totalTransport > 0): ?>
            <?php
            $savedBundleSelection = $savedSelections['outside_selections']['bundle_price'] ?? 'no_change';
            $savedBundleFrequency = $savedFrequencies['bundle_price'] ?? 1;
            ?>
            <tr class="outside-section">
                <td>
                    <select class="outside-selection" data-type="bundle_price" onchange="handleOutsideSelectionChange(this)">
                        <option value="no_change" <?php echo ($savedBundleSelection == 'no_change') ? 'selected' : ''; ?>>No Change</option>
                        <option value="change" <?php echo ($savedBundleSelection == 'change') ? 'selected' : ''; ?>>Change</option>
                    </select>
                </td>
                <td></td>
                <td style="font-weight: 800;background-color: #FFC000 !important;">Bundle Price (Transport Uses)</td>
                <td>
                    <input type="text" 
                        id="bundle-frequency" 
                        value="<?php echo $savedBundleFrequency; ?>" 
                        readonly
                        onchange="updateBundleTotal()">
                </td>
                <td>
                    <input type="text" 
                        id="bundle-rate" 
                        value="<?php echo number_format($savedBundleTotal, 2, '.', ''); ?>" 
                        readonly
                        onchange="updateBundleTotal()">
                </td>
                <td style="background-color: #eccdccff;" id="bundle-budget-total">
                    <?php echo number_format($netBundlePrice, 2, '.', ''); ?>
                </td>
                <td style="background-color: #eccdccff;">
                    <input type="text" 
                        id="bundle-actual-expense" 
                        value="<?php echo number_format($savedBundleTotal, 2, '.', ''); ?>" 
                        readonly
                        onchange="updateTotalCalculations()">
                </td>
                <td>
                    <textarea id="bundle-remarks" placeholder="Add remarks..." style="background-color: #fffacd;"><?php 
                    echo htmlspecialchars($savedBundleRemark);
                    ?></textarea>
                    <div class="remark-required" style="color: red; font-size: 12px; display: none;">Remark is required when value is changed</div>
                </td>
            </tr>
            <?php endif; ?>

            <!-- Gap before totals -->
            <tr class="date-gap-row">
                <td colspan="8"></td>
            </tr>

            <!-- Total Amount -->
            <?php
                $savedTotalSelection = isset($savedBudgetData['totals']['final_selection_changed']) && $savedBudgetData['totals']['final_selection_changed'] ? 'change' : 'no_change';
            ?>
            <!-- Total Amount -->
            <tr style="font-weight: bold; background-color: #FFE4E1;">
                <td colspan="5" style="text-align: right;">TOTAL AMOUNT IN (<?php echo $currency_abbr; ?>)</td>
                <td id="total-budget-amount"><?php echo number_format($finalTotal, 2, '.', ''); ?></td>
                <td>
                    <input type="text" id="total-actual-expense" value="<?php echo number_format($finalActualTotal, 2, '.', ''); ?>" readonly>
                </td>
                <td></td>
            </tr>

            <!-- Exchange Rate -->
            <tr style="font-weight: bold;">
                <td colspan="5" style="text-align: right;">EXCHANGE RATE ROE</td>
                <td id="original-exchange-rate"><?php echo number_format($exchangeRate, 2, '.', ''); ?></td>
                <td>
                    <input type="text" id="exchange-rate-input" value="<?php echo number_format($savedExchangeRate, 2, '.', ''); ?>" onchange="updateUSDCalculation()">
                </td>
                <td></td>
            </tr>

            <!-- Amount in USD -->
            <tr style="font-weight: bold; background-color: #E8F4F8;">
                <td colspan="5" style="text-align: right;">AMOUNT IN USD</td>
                <td id="usd-budget-amount"><?php echo number_format($usdAmount, 2, '.', ''); ?></td>
                <td>
                    <input type="text" id="usd-actual-expense" value="<?php echo number_format($savedUSDAmount, 2, '.', ''); ?>" readonly>
                </td>
                <td></td>
            </tr>

           <?php
                $categoryTotals = [
                    'hotel' => ['label' => 'Hotel', 'budget' => $hotelTotal],
                    'ticket' => ['label' => 'Ticket', 'budget' => $TicketCostTotal],
                    'entrance' => ['label' => 'ENTRANCE', 'budget' => $entranceTotal],
                    'activity' => ['label' => 'ACTIVITY', 'budget' => $activityTotal],
                    'guide' => ['label' => 'Guide', 'budget' => $guideTotal],
                    'meal' => ['label' => 'Meal', 'budget' => $mealTotal],
                    'entertainment' => ['label' => 'Entertainment', 'budget' => $entertainmentTotal],
                    // 'dinner_transfer' => ['label' => 'Dinner Transfer', 'budget' => $dinnerTransferTotal]
                ];

                foreach ($categoryTotals as $categoryKey => $category):
                    if ($category['budget'] <= 0) continue;

                    $savedCategory = $savedCategoryTotals[$categoryKey] ?? [];
                    $categoryActual = $savedCategory['actual_total'] ?? $category['budget'];
                    $categoryRemarks = $savedCategory['remarks'] ?? '';
                    $categorySelection = !empty($savedCategory['selection_changed']) ? 'change' : 'no_change';
                ?>
                <tr class="category-total-row"
                    data-category="<?php echo $categoryKey; ?>"
                    data-original-actual="<?php echo number_format($category['budget'], 2, '.', ''); ?>"
                    style="font-weight:bold;background-color:#D5E8D4;">

                    <td>
                        <select class="category-total-selection"
                                data-category="<?php echo $categoryKey; ?>"
                                onchange="handleCategoryTotalSelection(this)">
                            <option value="no_change" <?php echo $categorySelection === 'no_change' ? 'selected' : ''; ?>>No Change</option>
                            <option value="change" <?php echo $categorySelection === 'change' ? 'selected' : ''; ?>>Change</option>
                        </select>
                    </td>

                    <td style="text-align:right;">
                        <?php echo $category['label']; ?> TOTAL (<?php echo $currency_abbr; ?>)
                    </td>

                    <td class="category-budget-total">
                        <?php echo number_format($category['budget'], 2, '.', ''); ?>
                    </td>

                    <td>
                        <input type="text"
                            class="category-actual-total <?php echo $categoryKey; ?>_total"
                            data-category="<?php echo $categoryKey; ?>"
                            value="<?php echo number_format($categoryActual, 2, '.', ''); ?>"
                            data-original="<?php echo number_format($categoryActual, 2, '.', ''); ?>"
                            readonly
                            onchange="handleCategoryTotalValueChange(this)">
                    </td>

                    <td colspan="4">
                        <textarea class="category-total-remarks"
                                data-category="<?php echo $categoryKey; ?>"
                                placeholder="Add remarks..."
                                style="background-color:#fffacd;"
                                <?php echo $categorySelection === 'change' ? 'required' : ''; ?>><?php echo htmlspecialchars($categoryRemarks); ?></textarea>
                        <div class="category-remark-required" style="color:red;font-size:12px;display:none;">
                            Remark is required
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php
                } else {
            ?>
            <tr>
                <td colspan="8" style="text-align: center;">No cost data available</td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <div class="no-print text-center" style="margin-bottom: 60px; margin-top: 30px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <div class="d-flex align-items-center justify-content-center gap-1">
                    <select id="final-selection" onchange="handleFinalSelectionChange(this)" class="form-control" style="flex: 1; max-width: 200px;">
                        <option value="no_change" <?php echo ($savedTotalSelection == 'no_change') ? 'selected' : ''; ?>>No Change</option>
                        <option value="change" <?php echo ($savedTotalSelection == 'change') ? 'selected' : ''; ?>>Change</option>
                    </select>
                    <button class="btn btn-primary" onclick="updateAllChanges()" style="margin-top: -55px !important;">UPDATE</button>&nbsp;&nbsp;
                    <button onclick="window.close()" class="btn btn-danger"style="margin-top: -55px !important;"><i class="glyphicon glyphicon-remove"></i> Close</button>
                </div>
            </div>  
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-center gap-1">
                        <?php $current_saved_id = $savedBudgetQuery->row()->id ?? 0; ?>
                        <input type="hidden" id="saved_budget_report_id" value="<?php echo $current_saved_id; ?>">
                        <button class="btn btn-primary" id="btn_final_budget" style="" title="click here to update final budget">FINAL Budget</button>
                   </div>
                </div>  
        </div>
    </div>
<script>
    // FINAL Budget button click handler
    $('#btn_final_budget').click(function() {
        const savedId = $('#saved_budget_report_id').val();
        if (!savedId || savedId == 0) {
            Swal.fire('Error', 'No saved budget report found', 'error');
            return;
        }

        const quote_id = <?php echo $report->id ?? 'null'; ?>;
        const enq_id = <?php echo $report->enq_id ?? 'null'; ?>;

        Swal.fire({
            title: 'Finalize Budget?',
            text: 'Once marked as FINAL, you will no longer be able to edit or update this budget report.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, finalize it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url("admin/quotation/finalize_budget"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        saved_id: savedId,
                        quote_id: quote_id,
                        enq_id: enq_id
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Budget has been marked as FINAL.',
                                icon: 'success',
                                confirmButtonColor: '#28a745',
                                timer: 2000,
                                timerProgressBar: true
                            }).then(() => {
                                // Disable both buttons
                                $('#btn_final_budget').prop('disabled', true);
                                $('.btn-primary[onclick="updateAllChanges()"]').prop('disabled', true);
                                // Optionally hide or change text
                                $('#btn_final_budget').text('FINALIZED');
                            });
                        } else {
                            Swal.fire('Error', response.message || 'Failed to finalize budget', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Server error. Please try again.', 'error');
                    }
                });
            }
        });
    });

    // On page load, check if budget is already final and disable buttons accordingly
    $(document).ready(function() {
        <?php if (isset($savedFinalData['final_budget']) && $savedFinalData['final_budget'] == 'yes'): ?>
            $('#btn_final_budget').prop('disabled', true).text('FINALIZED');
            $('.btn-primary[onclick="updateAllChanges()"]').prop('disabled', true);
        <?php endif; ?>
    });

    // After loading saved data, set Selection to "Change" for any row that already has a non‑empty remark
    function syncSelectionFromSavedRemarks() {
        // 1. Date rows
        document.querySelectorAll('.remarks-input').forEach(textarea => {
            const row = textarea.closest('tr');
            if (row && textarea.value.trim() !== '') {
                const dateKey = row.dataset.dateKey;
                if (dateKey) {
                    const dateSelect = document.querySelector(`.date-selection[data-date-key="${dateKey}"]`);
                    if (dateSelect && dateSelect.value !== 'change') {
                        dateSelect.value = 'change';
                        dateSelect.dispatchEvent(new Event('change'));
                    }
                }
            }
        });

        // 2. Additional transfers
        const addRemarks = document.getElementById('additional-transfers-remarks');
        if (addRemarks && addRemarks.value.trim() !== '') {
            const select = document.querySelector('.outside-selection[data-type="additional_transfers"]');
            if (select && select.value !== 'change') {
                select.value = 'change';
                select.dispatchEvent(new Event('change'));
            }
        }

        // 3. Bundle price
        const bundleRemarks = document.getElementById('bundle-remarks');
        if (bundleRemarks && bundleRemarks.value.trim() !== '') {
            const select = document.querySelector('.outside-selection[data-type="bundle_price"]');
            if (select && select.value !== 'change') {
                select.value = 'change';
                select.dispatchEvent(new Event('change'));
            }
        }

        // 4. Outside cost rows (if any have their own selection)
        document.querySelectorAll('.outside-remarks-input').forEach(textarea => {
            const row = textarea.closest('tr');
            if (row && textarea.value.trim() !== '') {
                const select = row.querySelector('.outside-selection[data-type="outside_cost"]');
                if (select && select.value !== 'change') {
                    select.value = 'change';
                    select.dispatchEvent(new Event('change'));
                }
            }
        });
    }

    // Call this after initializing saved selections
    document.addEventListener('DOMContentLoaded', function() {
        initializeSavedSelections();
        initializeOriginalValues();
        syncSelectionFromSavedRemarks();   // <-- highlight saved remarks
        setupRemarkAutoSelection();        // <-- auto-set on user input (from previous answer)
        // ... rest of your code
    });

    // Store original values for comparison
    let originalValues = {};
    let changedSelections = new Set(); // Track which selections have been changed

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check all selections and enable/disable inputs accordingly
        initializeSavedSelections();
        setupRemarkAutoSelection();
        syncSelectionFromSavedRemarks();
        
        // Make exchange rate always editable
        const exchangeRateInput = document.getElementById('exchange-rate-input');
        if (exchangeRateInput) {
            exchangeRateInput.readOnly = false;
            exchangeRateInput.style.backgroundColor = '#fffacd';
        }
        
        // Initialize calculations
        updateTotalCalculations();
    });

    // Initialize saved selections
    function initializeSavedSelections() {
        // Check date selections
        document.querySelectorAll('.date-selection').forEach(select => {
            if (select.value === 'change') {
                const dateKey = select.dataset.dateKey;
                changedSelections.add('date_' + dateKey);
                enableDateInputs(dateKey);
            }
        });
        
        // Check outside selections
        document.querySelectorAll('.outside-selection').forEach(select => {
            if (select.value === 'change') {
                const type = select.dataset.type;
                const itemId = select.dataset.itemId;
                const key = itemId || type;
                changedSelections.add('outside_' + key);
                enableOutsideInputs(type, itemId);
            }
        });
        
        // Check final selection
        const finalSelect = document.getElementById('final-selection');
        if (finalSelect && finalSelect.value === 'change') {
            const totalActualInput = document.getElementById('total-actual-expense');
            if (totalActualInput) {
                totalActualInput.readOnly = false;
                totalActualInput.style.backgroundColor = '#fffacd';
            }
        }

        document.querySelectorAll('.category-total-selection').forEach(select => {
            handleCategoryTotalSelection(select);
        });
    }

    // Function to enable inputs for a date
    function enableDateInputs(dateKey) {
        const rows = document.querySelectorAll(`tr[data-date-key="${dateKey}"]`);
        rows.forEach(row => {
            const itemId = row.dataset.itemId;
            
            // Enable frequency input
            const freqInput = row.querySelector('.frequency-input');
            if (freqInput) {
                freqInput.readOnly = false;
                freqInput.style.backgroundColor = '#fffacd';
                // Store original value
                if (!freqInput.dataset.original) {
                    freqInput.dataset.original = freqInput.value;
                }
            }
            
            // Enable rate input
            const rateInput = row.querySelector('.rate-input');
            if (rateInput) {
                rateInput.readOnly = false;
                rateInput.style.backgroundColor = '#fffacd';
                // Store original value
                if (!rateInput.dataset.original) {
                    rateInput.dataset.original = rateInput.value;
                }
            }
            
            // Enable actual expense input
            const actualInput = row.querySelector('.actual-expense-input');
            if (actualInput) {
                actualInput.readOnly = false;
                actualInput.style.backgroundColor = '#fffacd';
                // Store original value
                if (!actualInput.dataset.original) {
                    actualInput.dataset.original = actualInput.value;
                }
            }
            
            // Enable remarks (always editable)
            const remarksTextarea = row.querySelector('.remarks-input');
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
            }
            
            // Add change event listeners for remark validation
            if (freqInput) {
                freqInput.addEventListener('input', function() {
                    validateRemarkRequired(row);
                });
            }
            if (rateInput) {
                rateInput.addEventListener('input', function() {
                    validateRemarkRequired(row);
                });
            }
            if (actualInput) {
                actualInput.addEventListener('input', function() {
                    validateRemarkRequired(row);
                });
            }
        });
    }

    // Function to enable inputs for outside items
    function enableOutsideInputs(type, itemId) {
        if (type === 'additional_transfers') {
            const freqInput = document.getElementById('additional-transfers-frequency');
            const rateInput = document.getElementById('additional-transfers-rate');
            const actualInput = document.getElementById('additional-transfers-actual-expense');
            const remarksTextarea = document.getElementById('additional-transfers-remarks');
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = false;
                    input.style.backgroundColor = '#fffacd';
                    // Store original value
                    if (!input.dataset.original) {
                        input.dataset.original = input.value;
                    }
                    // Add change event for remark validation
                    input.addEventListener('input', function() {
                        validateOutsideRemarkRequired(type, itemId);
                    });
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
            }
        }
        else if (type === 'bundle_price') {
            const freqInput = document.getElementById('bundle-frequency');
            const rateInput = document.getElementById('bundle-rate');
            const actualInput = document.getElementById('bundle-actual-expense');
            const remarksTextarea = document.getElementById('bundle-remarks');
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = false;
                    input.style.backgroundColor = '#fffacd';
                    // Store original value
                    if (!input.dataset.original) {
                        input.dataset.original = input.value;
                    }
                    // Add change event for remark validation
                    input.addEventListener('input', function() {
                        validateOutsideRemarkRequired(type, itemId);
                    });
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
            }
        }
        else if (type === 'outside_cost' && itemId) {
            const row = document.querySelector(`.outside-section [data-item-id="${itemId}"]`).closest('tr');
            
            const freqInput = row.querySelector('.outside-frequency-input');
            const rateInput = row.querySelector('.outside-rate-input');
            const actualInput = row.querySelector('.outside-actual-expense-input');
            const remarksTextarea = row.querySelector('.outside-remarks-input');
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = false;
                    input.style.backgroundColor = '#fffacd';
                    // Store original value
                    if (!input.dataset.original) {
                        input.dataset.original = input.value;
                    }
                    // Add change event for remark validation
                    input.addEventListener('input', function() {
                        validateOutsideRemarkRequired(type, itemId);
                    });
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
            }
        }
    }

    // Validate remark required for date items
    function validateRemarkRequired(row) {
        const freqInput = row.querySelector('.frequency-input');
        const rateInput = row.querySelector('.rate-input');
        const actualInput = row.querySelector('.actual-expense-input');
        const remarksTextarea = row.querySelector('.remarks-input');
        const remarkRequiredDiv = row.querySelector('.remark-required');
        
        let valueChanged = false;
        
        // Check if any value has changed from original
        if (freqInput && freqInput.dataset.original && freqInput.value !== freqInput.dataset.original) {
            valueChanged = true;
        }
        if (rateInput && rateInput.dataset.original && rateInput.value !== rateInput.dataset.original) {
            valueChanged = true;
        }
        if (actualInput && actualInput.dataset.original && actualInput.value !== actualInput.dataset.original) {
            valueChanged = true;
        }
        
        // Show/hide remark required message
        if (valueChanged && remarkRequiredDiv) {
            if (!remarksTextarea.value.trim()) {
                remarkRequiredDiv.style.display = 'block';
                remarksTextarea.style.border = '1px solid red';
            } else {
                remarkRequiredDiv.style.display = 'none';
                remarksTextarea.style.border = '1px solid #ccc';
            }
        } else if (remarkRequiredDiv) {
            remarkRequiredDiv.style.display = 'none';
            if (remarksTextarea) {
                remarksTextarea.style.border = '1px solid #ccc';
            }
        }
    }

    // Validate remark required for outside items
    function validateOutsideRemarkRequired(type, itemId) {
        let remarksTextarea, remarkRequiredDiv;
        let freqInput, rateInput, actualInput;
        
        if (type === 'additional_transfers') {
            remarksTextarea = document.getElementById('additional-transfers-remarks');
            remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            freqInput = document.getElementById('additional-transfers-frequency');
            rateInput = document.getElementById('additional-transfers-rate');
            actualInput = document.getElementById('additional-transfers-actual-expense');
        }
        else if (type === 'bundle_price') {
            remarksTextarea = document.getElementById('bundle-remarks');
            remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            freqInput = document.getElementById('bundle-frequency');
            rateInput = document.getElementById('bundle-rate');
            actualInput = document.getElementById('bundle-actual-expense');
        }
        else if (type === 'outside_cost' && itemId) {
            const row = document.querySelector(`.outside-section [data-item-id="${itemId}"]`).closest('tr');
            remarksTextarea = row.querySelector('.outside-remarks-input');
            remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            freqInput = row.querySelector('.outside-frequency-input');
            rateInput = row.querySelector('.outside-rate-input');
            actualInput = row.querySelector('.outside-actual-expense-input');
        }
        
        let valueChanged = false;
        
        // Check if any value has changed from original
        if (freqInput && freqInput.dataset.original && freqInput.value !== freqInput.dataset.original) {
            valueChanged = true;
        }
        if (rateInput && rateInput.dataset.original && rateInput.value !== rateInput.dataset.original) {
            valueChanged = true;
        }
        if (actualInput && actualInput.dataset.original && actualInput.value !== actualInput.dataset.original) {
            valueChanged = true;
        }
        
        // Show/hide remark required message
        if (valueChanged && remarkRequiredDiv) {
            if (!remarksTextarea.value.trim()) {
                remarkRequiredDiv.style.display = 'block';
                remarksTextarea.style.border = '1px solid red';
            } else {
                remarkRequiredDiv.style.display = 'none';
                remarksTextarea.style.border = '1px solid #ccc';
            }
        } else if (remarkRequiredDiv) {
            remarkRequiredDiv.style.display = 'none';
            if (remarksTextarea) {
                remarksTextarea.style.border = '1px solid #ccc';
            }
        }
    }

    // hotel category remarks js 
    function handleCategoryTotalSelection(select) {
        const row = select.closest('.category-total-row');
        if (!row) return;

        const isChange = select.value === 'change';
        const actualInput = row.querySelector('.category-actual-total');
        const remarksInput = row.querySelector('.category-total-remarks');
        const requiredMessage = row.querySelector('.category-remark-required');

        actualInput.readOnly = !isChange;
        actualInput.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
        remarksInput.required = isChange;

        if (isChange) {
            document.getElementById('final-selection').value = 'change';
        } else {
            actualInput.value = row.dataset.originalActual;
            requiredMessage.style.display = 'none';
            remarksInput.style.border = '';
        }

        updateTotalCalculations();
    }

    function handleCategoryTotalValueChange(input) {
        const row = input.closest('.category-total-row');
        const select = row.querySelector('.category-total-selection');

        if (select.value !== 'change') {
            select.value = 'change';
            handleCategoryTotalSelection(select);
        }

        updateTotalCalculations();
    }

    // Handle date selection change
    function handleDateSelectionChange(select) {
        const dateKey = select.dataset.dateKey;
        const isChange = select.value === 'change';
        
        // Add to changed selections
        if (isChange) {
            changedSelections.add('date_' + dateKey);
            // Also update the final selection to "change"
            document.getElementById('final-selection').value = 'change';
        } else {
            changedSelections.delete('date_' + dateKey);
        }
        
        // Find all inputs for this date
        const rows = document.querySelectorAll(`tr[data-date-key="${dateKey}"]`);
        
        rows.forEach(row => {
            const itemId = row.dataset.itemId;
            
            // Enable/disable frequency input
            const freqInput = row.querySelector('.frequency-input');
            if (freqInput) {
                freqInput.readOnly = !isChange;
                freqInput.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                if (!isChange) {
                    // Reset to original value
                    if (freqInput.dataset.original) {
                        freqInput.value = freqInput.dataset.original;
                    }
                }
            }
            
            // Enable/disable rate input
            const rateInput = row.querySelector('.rate-input');
            if (rateInput) {
                rateInput.readOnly = !isChange;
                rateInput.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                if (!isChange) {
                    // Reset to original value
                    if (rateInput.dataset.original) {
                        rateInput.value = rateInput.dataset.original;
                    }
                }
            }
            
            // Enable/disable actual expense input
            const actualInput = row.querySelector('.actual-expense-input');
            if (actualInput) {
                actualInput.readOnly = !isChange;
                actualInput.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                if (!isChange) {
                    // Reset to original budget value
                    const budgetTotal = row.querySelector('.budget-total').textContent;
                    actualInput.value = budgetTotal.replace(/,/g, '');
                    // Update original value
                    actualInput.dataset.original = actualInput.value;
                }
            }
            
            // Enable/disable remarks (always editable for remarks)
            const remarksTextarea = row.querySelector('.remarks-input');
            const remarkRequiredDiv = row.querySelector('.remark-required');
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
                if (!isChange) {
                    // Clear remark required message
                    if (remarkRequiredDiv) {
                        remarkRequiredDiv.style.display = 'none';
                    }
                    remarksTextarea.style.border = '1px solid #ccc';
                }
            }
        });
        
        updateTotalCalculations();
    }

    // Handle outside selection change (additional transfers, bundle price, outside costs)
    function handleOutsideSelectionChange(select) {
        const type = select.dataset.type;
        const itemId = select.dataset.itemId;
        const isChange = select.value === 'change';
        
        // Add to changed selections and update final selection
        if (isChange) {
            changedSelections.add('outside_' + (itemId || type));
            document.getElementById('final-selection').value = 'change';
        } else {
            changedSelections.delete('outside_' + (itemId || type));
        }
        
        if (type === 'additional_transfers') {
            const freqInput = document.getElementById('additional-transfers-frequency');
            const rateInput = document.getElementById('additional-transfers-rate');
            const actualInput = document.getElementById('additional-transfers-actual-expense');
            const remarksTextarea = document.getElementById('additional-transfers-remarks');
            const remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = !isChange;
                    input.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                    if (!isChange) {
                        // Reset to original value
                        if (input.dataset.original) {
                            input.value = input.dataset.original;
                        }
                    }
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
                if (!isChange && remarkRequiredDiv) {
                    remarkRequiredDiv.style.display = 'none';
                    remarksTextarea.style.border = '1px solid #ccc';
                }
            }
            
            if (!isChange) {
                // Reset to saved values
                const budgetTotal = document.getElementById('additional-transfers-budget-total').textContent;
                if (actualInput) {
                    actualInput.value = budgetTotal.replace(/,/g, '');
                    actualInput.dataset.original = actualInput.value;
                }
                updateAdditionalTransfersTotal();
            }
        }
        else if (type === 'bundle_price') {
            const freqInput = document.getElementById('bundle-frequency');
            const rateInput = document.getElementById('bundle-rate');
            const actualInput = document.getElementById('bundle-actual-expense');
            const remarksTextarea = document.getElementById('bundle-remarks');
            const remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = !isChange;
                    input.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                    if (!isChange) {
                        // Reset to original value
                        if (input.dataset.original) {
                            input.value = input.dataset.original;
                        }
                    }
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
                if (!isChange && remarkRequiredDiv) {
                    remarkRequiredDiv.style.display = 'none';
                    remarksTextarea.style.border = '1px solid #ccc';
                }
            }
            
            if (!isChange) {
                // Reset to original budget value
                const budgetTotal = document.getElementById('bundle-budget-total').textContent;
                if (rateInput) {
                    rateInput.value = budgetTotal.replace(/,/g, '');
                    rateInput.dataset.original = rateInput.value;
                }
                if (actualInput) {
                    actualInput.value = budgetTotal.replace(/,/g, '');
                    actualInput.dataset.original = actualInput.value;
                }
                updateBundleTotal();
            }
        }
        else if (type === 'outside_cost' && itemId) {
            const row = document.querySelector(`.outside-section [data-item-id="${itemId}"]`).closest('tr');
            
            const freqInput = row.querySelector('.outside-frequency-input');
            const rateInput = row.querySelector('.outside-rate-input');
            const actualInput = row.querySelector('.outside-actual-expense-input');
            const remarksTextarea = row.querySelector('.outside-remarks-input');
            const remarkRequiredDiv = remarksTextarea ? remarksTextarea.nextElementSibling : null;
            
            [freqInput, rateInput, actualInput].forEach(input => {
                if (input) {
                    input.readOnly = !isChange;
                    input.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
                    if (!isChange) {
                        // Reset to original value
                        if (input.dataset.original) {
                            input.value = input.dataset.original;
                        }
                    }
                }
            });
            
            // Remarks always editable
            if (remarksTextarea) {
                remarksTextarea.readOnly = false;
                remarksTextarea.style.backgroundColor = '#fffacd';
                if (!isChange && remarkRequiredDiv) {
                    remarkRequiredDiv.style.display = 'none';
                    remarksTextarea.style.border = '1px solid #ccc';
                }
            }
            
            if (!isChange) {
                // Reset to budget value
                const budgetTotal = row.querySelector('.outside-budget-total').textContent;
                if (actualInput) {
                    actualInput.value = budgetTotal.replace(/,/g, '');
                    actualInput.dataset.original = actualInput.value;
                }
                updateOutsideItemTotal(itemId);
            }
        }
        
        updateTotalCalculations();
    }

    // Handle final selection change
    function handleFinalSelectionChange(select) {
        const isChange = select.value === 'change';
        
        // Exchange rate is always editable, no need to change
        
        // Enable/disable total actual expense input
        const totalActualInput = document.getElementById('total-actual-expense');
        if (totalActualInput) {
            totalActualInput.readOnly = !isChange;
            totalActualInput.style.backgroundColor = isChange ? '#fffacd' : '#f5f5f5';
        }
        
        if (!isChange) {
            // Reset total actual expense to budget total
            const budgetTotalEl = document.getElementById('total-budget-amount');
            if (budgetTotalEl && totalActualInput) {
                totalActualInput.value = budgetTotalEl.textContent.replace(/,/g, '');
            }
            
            updateUSDCalculation();
        }
    }

    // Update item total when frequency or rate changes
    function updateItemTotal(itemId) {
        const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
        if (!row) return;
        
        const freqInput = row.querySelector('.frequency-input');
        const rateInput = row.querySelector('.rate-input');
        const actualInput = row.querySelector('.actual-expense-input');
        
        if (!freqInput || !rateInput || !actualInput) return;
        
        const frequency = parseFloat(freqInput.value) || 0;
        const rate = parseFloat(rateInput.value) || 0;
        const total = frequency * rate;
        
        // actualInput.value = Math.round(total);
        actualInput.value = total.toFixed(2); 
        
        // Validate remark required
        validateRemarkRequired(row);
        
        updateTotalCalculations();
    }

    // Update outside item total
    function updateOutsideItemTotal(itemId) {
        const row = document.querySelector(`.outside-section [data-item-id="${itemId}"]`).closest('tr');
        if (!row) return;
        
        const freqInput = row.querySelector('.outside-frequency-input');
        const rateInput = row.querySelector('.outside-rate-input');
        const actualInput = row.querySelector('.outside-actual-expense-input');
        
        if (!freqInput || !rateInput || !actualInput) return;
        
        const frequency = parseFloat(freqInput.value) || 0;
        const rate = parseFloat(rateInput.value) || 0;
        const total = frequency * rate;
        
        actualInput.value = total.toFixed(2);
        
        // Validate remark required
        validateOutsideRemarkRequired('outside_cost', itemId);
        
        updateTotalCalculations();
    }

    // Update additional transfers total
    function updateAdditionalTransfersTotal() {
        const freqInput = document.getElementById('additional-transfers-frequency');
        const rateInput = document.getElementById('additional-transfers-rate');
        const actualInput = document.getElementById('additional-transfers-actual-expense');
        
        if (!freqInput || !rateInput || !actualInput) return;
        
        const frequency = parseFloat(freqInput.value) || 0;
        const rate = parseFloat(rateInput.value) || 0;
        const total = frequency * rate;
        
        // actualInput.value = Math.round(total);
        actualInput.value = total.toFixed(2);
        
        // Validate remark required
        validateOutsideRemarkRequired('additional_transfers', null);
        
        updateTotalCalculations();
    }

    // Update bundle total
    function updateBundleTotal() {
        const freqInput = document.getElementById('bundle-frequency');
        const rateInput = document.getElementById('bundle-rate');
        const actualInput = document.getElementById('bundle-actual-expense');
        
        if (!freqInput || !rateInput || !actualInput) return;
        
        const frequency = parseFloat(freqInput.value) || 1;
        const rate = parseFloat(rateInput.value) || 0;
        const total = frequency * rate;
        
        // actualInput.value = Math.round(total);
        actualInput.value = total.toFixed(2);
        
        // Validate remark required
        validateOutsideRemarkRequired('bundle_price', null);
        
        updateTotalCalculations();
    }

    function updateTotalCalculations() {
        let totalActualExpense = 0;
        
        // Sum all actual expense inputs
        document.querySelectorAll('.actual-expense-input, .outside-actual-expense-input, #additional-transfers-actual-expense, #bundle-actual-expense').forEach(input => {
            const value = parseFloat(input.value.replace(/,/g, '')) || 0;
            totalActualExpense += value;
        });

        document.querySelectorAll('.category-total-row').forEach(row => {
            const select = row.querySelector('.category-total-selection');
            const actualInput = row.querySelector('.category-actual-total');

            if (select && actualInput && select.value === 'change') {
                const calculatedTotal = parseFloat(row.dataset.originalActual.replace(/,/g, '')) || 0;
                const changedTotal = parseFloat(actualInput.value.replace(/,/g, '')) || 0;

                totalActualExpense += changedTotal - calculatedTotal;
            }
        });
        
        // Update total actual expense input
        const totalActualInput = document.getElementById('total-actual-expense');
        if (totalActualInput) {
            // totalActualInput.value = Math.round(totalActualExpense);
            totalActualInput.value = totalActualExpense.toFixed(2);
        }
        
        // Update USD calculation
        updateUSDCalculation();

        recalculateCategoryTotals();
    }

    // Recalculate category totals (entrance, activity, guide, meal, entertainment, dinner transfer)
    function recalculateCategoryTotals() {
        const totals = {
            hotel: 0,
            entrance: 0,
            activity: 0,
            guide: 0,
            meal: 0,
            entertainment: 0,
            dinner_transfer: 0
        };
        
        // Sum all actual expense inputs from date items (rows with data-type attribute)
        document.querySelectorAll('.actual-expense-input').forEach(input => {
            let row = input.closest('tr');
            if (row && row.dataset.type) {
                const type = row.dataset.type;
                const value = parseFloat(input.value.replace(/,/g, '')) || 0;
                if (totals.hasOwnProperty(type)) {
                    totals[type] += value;
                }
            }
        });
        
        // Update each category total's actual input field using its class
        const classMapping = {
            hotel: '.hotel_total',
            entrance: '.entrance_total',
            activity: '.activity_total',
            guide: '.guide_total',
            meal: '.meal_total',
            entertainment: '.entertainment_total',
            dinner_transfer: '.dinner_transfer_total'
        };
        
        for (const [type, className] of Object.entries(classMapping)) {
            const inputEl = document.querySelector(className);
            // if (inputEl) {
            //     inputEl.value = totals[type].toFixed(2);
            // }
            if (inputEl) {
                const row = inputEl.closest('.category-total-row');
                const select = row ? row.querySelector('.category-total-selection') : null;

                row.dataset.originalActual = totals[type].toFixed(2);

                if (!select || select.value !== 'change') {
                    inputEl.value = totals[type].toFixed(2);
                    inputEl.dataset.original = totals[type].toFixed(2);
                }
            }
        }
    }

    // Update USD calculation based on exchange rate
    function updateUSDCalculation() {
        const exchangeRateInput = document.getElementById('exchange-rate-input');
        const totalActualInput = document.getElementById('total-actual-expense');
        const usdActualInput = document.getElementById('usd-actual-expense');
        const usdBudgetEl = document.getElementById('usd-budget-amount');
        const totalBudgetEl = document.getElementById('total-budget-amount');
        
        if (!exchangeRateInput || !totalActualInput || !usdActualInput || !totalBudgetEl) return;
        
        const exchangeRate = parseFloat(exchangeRateInput.value.replace(/,/g, '')) || 0;
        const totalAmount = parseFloat(totalActualInput.value.replace(/,/g, '')) || 0;
        const budgetAmount = parseFloat(totalBudgetEl.textContent.replace(/,/g, '')) || 0;
        
        // Update budget USD (based on original exchange rate)
        const originalExchangeRateEl = document.getElementById('original-exchange-rate');
        const originalExchangeRate = originalExchangeRateEl ? parseFloat(originalExchangeRateEl.textContent.replace(/,/g, '')) : exchangeRate;
        
        if (originalExchangeRate > 0 && usdBudgetEl) {
            const budgetUSDAmount = budgetAmount / originalExchangeRate;
            // usdBudgetEl.textContent = Math.round(budgetUSDAmount);
            usdBudgetEl.textContent = budgetUSDAmount.toFixed(2);
        }
        
        // Update actual USD
        if (exchangeRate > 0) {
            const usdAmount = totalAmount / exchangeRate;
            // usdActualInput.value = Math.round(usdAmount);
            usdActualInput.value = usdAmount.toFixed(2);
        } else {
            usdActualInput.value = '0';
        }
    }

    // Check if any remark is missing when values are changed
    function validateAllRemarksBeforeUpdate() {
        let isValid = true;
        const missingRemarks = [];
        
        // Check date items
        document.querySelectorAll('tr[data-date-key]').forEach(row => {
            const freqInput = row.querySelector('.frequency-input');
            const rateInput = row.querySelector('.rate-input');
            const actualInput = row.querySelector('.actual-expense-input');
            const remarksTextarea = row.querySelector('.remarks-input');
            
            let valueChanged = false;
            
            // Check if any value has changed from original
            if (freqInput && freqInput.dataset.original && freqInput.value !== freqInput.dataset.original) {
                valueChanged = true;
            }

            if (rateInput && rateInput.dataset.original && rateInput.value !== rateInput.dataset.original) {
                valueChanged = true;
            }

            if (actualInput && actualInput.dataset.original && actualInput.value !== actualInput.dataset.original) {
                valueChanged = true;
            }
            
            if (valueChanged && (!remarksTextarea || !remarksTextarea.value.trim())) {
                isValid = false;
                const serviceCell = row.querySelector('td[data-service]');
                const service = serviceCell ? serviceCell.getAttribute('data-service') : 'Item';
                missingRemarks.push(service);
                
                // Highlight the missing remark
                const remarkRequiredDiv = row.querySelector('.remark-required');
                if (remarkRequiredDiv) {
                    remarkRequiredDiv.style.display = 'block';
                    if (remarksTextarea) {
                        remarksTextarea.style.border = '1px solid red';
                    }
                }
            }
        });
        
        // Check outside items
        document.querySelectorAll('.outside-section').forEach(row => {
            const selectElement = row.querySelector('.outside-selection');
            if (selectElement && selectElement.value === 'change') {
                const remarksTextarea = row.querySelector('textarea');
                const freqInput = row.querySelector('input[type="text"]:nth-of-type(1)');
                const rateInput = row.querySelector('input[type="text"]:nth-of-type(2)');
                const actualInput = row.querySelector('input[type="text"]:nth-of-type(3)');
                
                if (remarksTextarea && freqInput && rateInput && actualInput) {
                    let valueChanged = false;
                    
                    if (freqInput.dataset.original && freqInput.value !== freqInput.dataset.original) {
                        valueChanged = true;
                    }
                    if (rateInput.dataset.original && rateInput.value !== rateInput.dataset.original) {
                        valueChanged = true;
                    }
                    if (actualInput.dataset.original && actualInput.value !== actualInput.dataset.original) {
                        valueChanged = true;
                    }
                    
                    if (valueChanged && !remarksTextarea.value.trim()) {
                        isValid = false;
                        const serviceCell = row.querySelector('td:nth-child(3)');
                        const service = serviceCell ? serviceCell.textContent.trim() : 'Outside Item';
                        missingRemarks.push(service);
                        
                        // Highlight the missing remark
                        const remarkRequiredDiv = remarksTextarea.nextElementSibling;
                        if (remarkRequiredDiv && remarkRequiredDiv.classList.contains('remark-required')) {
                            remarkRequiredDiv.style.display = 'block';
                            remarksTextarea.style.border = '1px solid red';
                        }
                    }
                }
            }
        });

        document.querySelectorAll('.category-total-row').forEach(row => {
            const select = row.querySelector('.category-total-selection');
            const remarksInput = row.querySelector('.category-total-remarks');
            const requiredMessage = row.querySelector('.category-remark-required');

            if (select && select.value === 'change' && !remarksInput.value.trim()) {
                isValid = false;

                const categoryName = row.dataset.category || 'Category Total';
                missingRemarks.push(categoryName + ' Total');

                requiredMessage.style.display = 'block';
                remarksInput.style.border = '1px solid red';
            } else {
                requiredMessage.style.display = 'none';
                remarksInput.style.border = '';
            }
        });
        
        if (!isValid) {
            showNotification('Remarks are required for changed items: ' + missingRemarks.join(', '), 'error');
        }
        
        return isValid;
    }

    // Update all changes (for the update button) - Modified to include USD amounts
    function updateAllChanges() {
        // Validate all remarks first
        if (!validateAllRemarksBeforeUpdate()) {
            return false;
        }
        
        // Collect all data for saving
        const reportData = {
            date_items: [],
            additional_transfers: {},
            bundle_price: {},
            outside_costs: [],
            category_totals: {},
            totals: {},
            selections: {},
            margins: {},
            timestamp: new Date().toISOString()
        };
        
        // Collect date-based items (with both budget and actual values)
        document.querySelectorAll('tr[data-date-key]').forEach(row => {
            const itemId = row.dataset.itemId;
            const dateKey = row.dataset.dateKey;
            const serviceCell = row.querySelector('td[data-service]');
            const service = serviceCell ? serviceCell.getAttribute('data-service') : 
                        (row.querySelector('td:nth-child(3)') ? 
                        row.querySelector('td:nth-child(3)').textContent.trim() : '');
            const freqInput = row.querySelector('.frequency-input');
            const rateInput = row.querySelector('.rate-input');
            const budgetTotalEl = row.querySelector('.budget-total');
            const actualInput = row.querySelector('.actual-expense-input');
            const remarksTextarea = row.querySelector('.remarks-input');
            const selectionSelect = row.closest('tr').querySelector('.date-selection');
            
            if (budgetTotalEl && actualInput) {
                reportData.date_items.push({
                    item_id: itemId,
                    date_key: dateKey,
                    service: service,
                    budget_frequency: freqInput ? freqInput.getAttribute('data-original') || freqInput.value : '0',
                    budget_rate: rateInput ? rateInput.getAttribute('data-original') || rateInput.value : '0',
                    budget_total: budgetTotalEl.textContent.replace(/\s+/g, ''),
                    actual_frequency: freqInput ? freqInput.value : '0',
                    actual_rate: rateInput ? rateInput.value : '0',
                    actual_total: actualInput.value.replace(/,/g, ''),
                    remarks: remarksTextarea ? remarksTextarea.value.trim() : '',
                    selection_changed: selectionSelect ? selectionSelect.value === 'change' : false,
                    margin: calculateMargin(budgetTotalEl.textContent.replace(/\s+/g, ''), actualInput.value.replace(/,/g, ''))
                });
            }
        });
        
        // Collect additional transfers
        const addTransfersFreq = document.getElementById('additional-transfers-frequency');
        const addTransfersRate = document.getElementById('additional-transfers-rate');
        const addTransfersBudget = document.getElementById('additional-transfers-budget-total');
        const addTransfersActual = document.getElementById('additional-transfers-actual-expense');
        const addTransfersRemarks = document.getElementById('additional-transfers-remarks');
        const addTransfersSelect = document.querySelector('.outside-selection[data-type="additional_transfers"]');
        
        if (addTransfersBudget && addTransfersActual) {
            reportData.additional_transfers = {
                budget_frequency: '0',
                budget_rate: '0',
                budget_total: '0',
                actual_frequency: addTransfersFreq ? addTransfersFreq.value : '0',
                actual_rate: addTransfersRate ? addTransfersRate.value : '0',
                actual_total: addTransfersActual.value.replace(/,/g, ''),
                remarks: addTransfersRemarks ? addTransfersRemarks.value.trim() : '',
                selection_changed: addTransfersSelect ? addTransfersSelect.value === 'change' : false,
                margin: calculateMargin('0', addTransfersActual.value.replace(/,/g, ''))
            };
        }
        
        // Collect bundle price
        const bundleFreq = document.getElementById('bundle-frequency');
        const bundleRate = document.getElementById('bundle-rate');
        const bundleBudget = document.getElementById('bundle-budget-total');
        const bundleActual = document.getElementById('bundle-actual-expense');
        const bundleRemarks = document.getElementById('bundle-remarks');
        const bundleSelect = document.querySelector('.outside-selection[data-type="bundle_price"]');
        
        if (bundleBudget && bundleActual) {
            reportData.bundle_price = {
                budget_frequency: '1',
                budget_rate: bundleBudget.textContent.replace(/\s+/g, ''),
                budget_total: bundleBudget.textContent.replace(/\s+/g, ''),
                actual_frequency: bundleFreq ? bundleFreq.value : '1',
                actual_rate: bundleRate ? bundleRate.value : bundleBudget.textContent.replace(/\s+/g, ''),
                actual_total: bundleActual.value.replace(/,/g, ''),
                remarks: bundleRemarks ? bundleRemarks.value.trim() : '',
                selection_changed: bundleSelect ? bundleSelect.value === 'change' : false,
                margin: calculateMargin(bundleBudget.textContent.replace(/\s+/g, ''), bundleActual.value.replace(/,/g, ''))
            };
        }
        
        // Collect outside costs
        document.querySelectorAll('.outside-section').forEach(row => {
            const selectElement = row.querySelector('.outside-selection[data-type="outside_cost"]');
            if (selectElement) {
                const itemId = selectElement.dataset.itemId;
                const serviceCell = row.querySelector('td[data-service]');
                const service = serviceCell ? serviceCell.getAttribute('data-service') : 
                            (row.querySelector('td:nth-child(3)') ? 
                            row.querySelector('td:nth-child(3)').textContent.trim() : '');
                const freqInput = row.querySelector('.outside-frequency-input');
                const rateInput = row.querySelector('.outside-rate-input');
                const budgetTotalEl = row.querySelector('.outside-budget-total');
                const actualInput = row.querySelector('.outside-actual-expense-input');
                const remarksTextarea = row.querySelector('.outside-remarks-input');
                
                if (budgetTotalEl && actualInput) {
                    reportData.outside_costs.push({
                        item_id: itemId,
                        service: service,
                        budget_frequency: freqInput ? freqInput.getAttribute('data-original') || freqInput.value : '0',
                        budget_rate: rateInput ? rateInput.getAttribute('data-original') || rateInput.value : '0',
                        budget_total: budgetTotalEl.textContent.replace(/\s+/g, ''),
                        actual_frequency: freqInput ? freqInput.value : '0',
                        actual_rate: rateInput ? rateInput.value : '0',
                        actual_total: actualInput.value.replace(/,/g, ''),
                        remarks: remarksTextarea ? remarksTextarea.value.trim() : '',
                        selection_changed: selectElement.value === 'change',
                        margin: calculateMargin(budgetTotalEl.textContent.replace(/\s+/g, ''), actualInput.value.replace(/,/g, ''))
                    });
                }
            }
        });

        // Collect category totals
        document.querySelectorAll('.category-total-row').forEach(row => {
            const category = row.dataset.category;
            const budgetElement = row.querySelector('.category-budget-total');
            const actualInput = row.querySelector('.category-actual-total');
            const remarksInput = row.querySelector('.category-total-remarks');
            const select = row.querySelector('.category-total-selection');

            if (!category || !budgetElement || !actualInput || !remarksInput || !select) return;

            const budgetTotal = budgetElement.textContent.replace(/,/g, '').trim();
            const actualTotal = actualInput.value.replace(/,/g, '').trim();

            reportData.category_totals[category] = {
                budget_total: budgetTotal,
                actual_total: actualTotal,
                remarks: remarksInput.value.trim(),
                selection_changed: select.value === 'change',
                margin: calculateMargin(budgetTotal, actualTotal)
            };
        });

        // Collect totals
        const budgetTotalEl = document.getElementById('total-budget-amount');
        const totalActualInput = document.getElementById('total-actual-expense');
        const exchangeRateInput = document.getElementById('exchange-rate-input');
        const usdBudgetEl = document.getElementById('usd-budget-amount');
        const usdActualInput = document.getElementById('usd-actual-expense');
        const finalSelect = document.getElementById('final-selection');
        const originalExchangeRateEl = document.getElementById('original-exchange-rate');
        
        if (budgetTotalEl && totalActualInput && exchangeRateInput && usdBudgetEl && usdActualInput) {
            const budgetUSD = parseFloat(usdBudgetEl.textContent.replace(/,/g, '')) || 0;
            const actualUSD = parseFloat(usdActualInput.value.replace(/,/g, '')) || 0;
            
            reportData.totals = {
                budget_total: budgetTotalEl.textContent.replace(/,/g, ''),
                actual_total: totalActualInput.value.replace(/,/g, ''),
                original_exchange_rate: originalExchangeRateEl ? originalExchangeRateEl.textContent.replace(/,/g, '') : exchangeRateInput.value.replace(/,/g, ''),
                actual_exchange_rate: exchangeRateInput.value.replace(/,/g, ''),
                budget_usd: budgetUSD.toString(),
                actual_usd: actualUSD.toString(),
                final_selection_changed: finalSelect ? finalSelect.value === 'change' : false,
                overall_margin: calculateMargin(budgetTotalEl.textContent.replace(/,/g, ''), totalActualInput.value.replace(/,/g, '')),
                usd_margin: calculateMargin(budgetUSD, actualUSD)
            };
        }
        
        // Collect all selections
        reportData.selections = {
            changed_items: Array.from(changedSelections),
            date_selections: {},
            outside_selections: {}
        };
        
        // Collect date selections
        document.querySelectorAll('.date-selection').forEach(select => {
            reportData.selections.date_selections[select.dataset.dateKey] = select.value;
        });
        
        // Collect outside selections
        document.querySelectorAll('.outside-selection').forEach(select => {
            const key = select.dataset.itemId || select.dataset.type;
            reportData.selections.outside_selections[key] = select.value;
        });
        
        // Calculate total margin
        if (reportData.totals.budget_total && reportData.totals.actual_total) {
            reportData.margins = {
                total_budget: reportData.totals.budget_total,
                total_actual: reportData.totals.actual_total,
                total_margin: calculateMargin(reportData.totals.budget_total, reportData.totals.actual_total),
                margin_percentage: calculateMarginPercentage(reportData.totals.budget_total, reportData.totals.actual_total),
                usd_budget: reportData.totals.budget_usd,
                usd_actual: reportData.totals.actual_usd,
                usd_margin: calculateMargin(parseFloat(reportData.totals.budget_usd), parseFloat(reportData.totals.actual_usd)),
                usd_margin_percentage: calculateMarginPercentage(parseFloat(reportData.totals.budget_usd), parseFloat(reportData.totals.actual_usd))
            };
        }
        
        // Send data to server via AJAX
        saveReportData(reportData);
    }

    // Calculate margin (Budget - Actual)
    function calculateMargin(budget, actual) {
        const budgetNum = parseFloat(budget) || 0;
        const actualNum = parseFloat(actual) || 0;
        // return Math.round(budgetNum - actualNum);
        return (budgetNum - actualNum).toFixed(2);
    }

    // Calculate margin percentage
    function calculateMarginPercentage(budget, actual) {
        const budgetNum = parseFloat(budget) || 0;
        const actualNum = parseFloat(actual) || 0;
        if (budgetNum === 0) return 0;
        return ((budgetNum - actualNum) / budgetNum * 100).toFixed(2);
    }

    // Automatically set selection to "Change" when a remark is added
    function setupRemarkAutoSelection() {
        // Helper: update selection dropdown for a given row (date-based)
        function setDateSelectionToChange(dateKey) {
            const dateSelect = document.querySelector(`.date-selection[data-date-key="${dateKey}"]`);
            if (dateSelect && dateSelect.value !== 'change') {
                dateSelect.value = 'change';
                // Trigger the change event so that inputs become editable and final selection is updated
                dateSelect.dispatchEvent(new Event('change'));
            }
        }

        // Helper: update outside selection (additional transfers / bundle price)
        function setOutsideSelectionToChange(type, itemId = null) {
            let selector = '';
            if (type === 'additional_transfers') {
                selector = '.outside-selection[data-type="additional_transfers"]';
            } else if (type === 'bundle_price') {
                selector = '.outside-selection[data-type="bundle_price"]';
            } else if (type === 'outside_cost' && itemId) {
                selector = `.outside-selection[data-type="outside_cost"][data-item-id="${itemId}"]`;
            }
            if (selector) {
                const select = document.querySelector(selector);
                if (select && select.value !== 'change') {
                    select.value = 'change';
                    select.dispatchEvent(new Event('change'));
                }
            }
        }

        // 1. Date rows remarks (includes outside_cost items inside date groups)
        document.querySelectorAll('.remarks-input').forEach(textarea => {
            textarea.addEventListener('input', function() {
                const row = this.closest('tr');
                if (!row) return;
                const dateKey = row.dataset.dateKey;
                if (dateKey && this.value.trim() !== '') {
                    setDateSelectionToChange(dateKey);
                }
            });
        });

        // 2. Additional transfers remarks
        const additionalRemarks = document.getElementById('additional-transfers-remarks');
        if (additionalRemarks) {
            additionalRemarks.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    setOutsideSelectionToChange('additional_transfers');
                }
            });
        }

        // 3. Bundle price remarks
        const bundleRemarks = document.getElementById('bundle-remarks');
        if (bundleRemarks) {
            bundleRemarks.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    setOutsideSelectionToChange('bundle_price');
                }
            });
        }

        // 4. Outside cost rows that have their own selection (if any)
        document.querySelectorAll('.outside-remarks-input').forEach(textarea => {
            textarea.addEventListener('input', function() {
                const row = this.closest('tr');
                if (!row) return;
                const select = row.querySelector('.outside-selection[data-type="outside_cost"]');
                if (select && this.value.trim() !== '') {
                    const itemId = select.dataset.itemId;
                    setOutsideSelectionToChange('outside_cost', itemId);
                }
            });
        });
    }

    // Save report data to server
    function saveReportData(data) {
        // Show loading indicator
        const updateBtn = document.querySelector('button[onclick="updateAllChanges()"]');
        const originalText = updateBtn.textContent;
        updateBtn.textContent = 'Saving...';
        updateBtn.disabled = true;
        
        // Get report ID
        const quote_id = <?php echo $report->id ?? 'null'; ?>;
        const enq_id = <?php echo $report->enq_id ?? 'null'; ?>;
        
        // Prepare data for sending
        const postData = {
            quote_id: quote_id,
            enquiry_id: enq_id,
            data: data
        };
        
        console.log('Saving data:', postData); // Debug
        
        // Send AJAX request
        fetch('<?php echo base_url("admin/BudgetReport/save_budget_data"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(postData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log('Save result:', result); // Debug
            
            if (result.success) {
                // Update UI to show saved state
                document.querySelectorAll('.date-selection, .outside-selection, #final-selection').forEach(select => {
                    select.value = 'no_change';
                    // Trigger change event to reset inputs
                    select.dispatchEvent(new Event('change'));
                });
                
                // Clear changed selections
                changedSelections.clear();
                
                // Show success message
                showNotification('Budget report saved successfully!', 'success');
                location.reload();
            } else {
                showNotification('Error saving data: ' + (result.message || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Failed to save data. Please try again.', 'error');
        })
        .finally(() => {
            // Restore button
            updateBtn.textContent = originalText;
            updateBtn.disabled = false;
        });
    }

    // Show notification
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            z-index: 9999;
            transition: opacity 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        `;
        
        notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Initialize data-original attributes for inputs
    function initializeOriginalValues() {
        // Store original values in data attributes
        document.querySelectorAll('.frequency-input, .rate-input, .outside-frequency-input, .outside-rate-input, .actual-expense-input, .outside-actual-expense-input').forEach(input => {
            if (!input.hasAttribute('data-original')) {
                input.setAttribute('data-original', input.value);
            }
        });
    }

    // Call initialization
    initializeOriginalValues();
</script>
<!--<div class="no-print text-center " style="margin-bottom: 60px;margin-top: 30px;">
    <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Report</button>
</div>-->
</body>
</html>