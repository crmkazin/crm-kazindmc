<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Original Budget Report</title>
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
            border-bottom: 3px solid #adadad;
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
        .date-gap-row {
            height: 15px;
            background-color: #f5f5f5;
        }
        .total-row {
            font-weight: bold;
        }
        .value-display {
            padding: 3px;
            display: block;
            min-height: 24px;
        }
        .card {
            margin: 1% 10%;
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
        }
        body {
            background-color: #ededed;
        }
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            flex-direction: column;
        }
        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner">
        <div class="spinner"></div>
        <h4>Generating PDF...</h4>
        <p>Please wait while we generate your budget report.</p>
    </div>
</div>
<div class="card">
    <div class="header-section">
        <div class="main-title text-center">ORIGINAL BUDGET REPORT | <?php echo date('d M Y', strtotime($report->check_in_date)); ?> - <?php echo date('d M Y', strtotime($report->check_out_date)); ?></div>
        <div style="display: flex; justify-content: center; column-gap: 83px;"> 
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
    </div>

<?php
$guideCosts = json_decode($report->guide_cost, true);
$guideDetails = json_decode($report->guide_details, true);
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
$guide_details = $report->guide_details ?? '';
$itinerary_details = $report->itinerary_details ?? '';
$meal_type_daywise_price = $report->meal_type_daywise_price ?? '';
$entertainment_daywise_price = $report->daywise_entertainment ?? '';
$cnb = $report->cnb ?? '';
$cnb_count = $report->cnb_count ?? '';
$cwb = $report->cwb ?? '';
$cwb_count = $report->cwb_count ?? '';
$driverCosts = json_decode($report->driver_cost ?? '[]', true);
$markup_split = $report->markup_split ?? 'no';
$land_markup = $report->land_markup ?? 0;
$daywise_train = $report->daywise_train ?? 0;
$daywise_train_transport = $report->daywise_train_transport ?? 0;
$fullDayCost = $report->full_day_cost ?? 0;
$airport_pic_drop = json_decode($report->airport_pic_drop_cost ?? '[]', true);

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

$itemsByDate = [];

function addItemToDate(&$itemsByDate, $startDate, $dayNumber, $service, $frequency, $rate, $total, $type = 'service', $remarks = '', $itemId = '') {
    $dateKey = date('Y-m-d', strtotime($startDate . ' + ' . $dayNumber . ' days'));
    $displayDate = date('d M', strtotime($startDate . ' + ' . $dayNumber . ' days'));
    
    if (!isset($itemsByDate[$dateKey])) {
        $itemsByDate[$dateKey] = [
            'display_date' => $displayDate,
            'date_key' => $dateKey,
            'items' => []
        ];
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

        addItemToDate($itemsByDate, $startDate, $dayNumber, $serviceName, 1, 0, 0, 'airport_transfer', 'Price included in transport bundle', $itemId);
    }
}

// Hotel cost logic implemented here based on modification date of the report
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
            }
            else {
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
        addItemToDate($itemsByDate, $startDate, 0, $item['name'], $item['frequency'], $item['rate'], $item['total'], 'hotel', '', $itemId);
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
    $hotel_cost = $hotel_cost ?? [];

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

    // 4. Add items to itemsByDate (unchanged)
    foreach ($hotelItems as $index => $item) {
        $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
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
            $itemId
        );
    }
}

// ------------------------------------------------------------------
// TRAIN TICKETS (daywise_train) – includes child tickets
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
                
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $serviceName,
                    $budgetQty,   // budget frequency
                    $budgetPrice, // budget rate
                    $budgetTotal, // budget total
                    'train_ticket', '', $itemId
                );
            }
        }
    }
}

// ------------------------------------------------------------------
// FULL DAY TOUR (included in bundle) – day‑wise display only
// ------------------------------------------------------------------
if (!empty($fullDayCost)) {
    // Decode if it's a JSON string
    if (is_string($fullDayCost)) {
        $fullDayCost = json_decode($fullDayCost, true);
    }
    
    if (is_array($fullDayCost)) {
        foreach ($fullDayCost as $tourDay) {
            // Expecting at least 'day' and optionally 'name' or 'description'
            if (!isset($tourDay['day'])) continue;
            
            $dayNumber = (int)$tourDay['day'] - 1; // convert 1‑based to 0‑based
            if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
            
            // Use a custom name if provided, otherwise default text
            $tourName = isset($tourDay['name']) ? $tourDay['name'] : 'Full day tour';
            $serviceName = $tourName . ' (Included in bundle)';
            
            // Always show frequency 1, rate 0, total 0
            $itemId = generateItemId('full_day_tour', $dayNumber . '_' . ($tourDay['index'] ?? uniqid()));
            
            addItemToDate(
                $itemsByDate,
                $startDate,
                $dayNumber,
                $serviceName,
                1,      // frequency
                0,      // rate
                0,      // total
                'full_day_tour',
                'Included in bundle price',
                $itemId
            );
        }
    }
}

// Guide costs code start from here
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
        $guideLabel = $guideDetails[0]['type'];
        if($guideLabel == 'guide'){
            $guideLabel = 'Guide';
        }else{
            $guideLabel = 'Driver Cum Guide';
        }

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
                    $guideLabel . ' ('.$label . ')',
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
                $guideLabel,
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

// Adult mandatory services code start from here
if ($mandatoryServices && is_array($mandatoryServices)) {
    foreach ($mandatoryServices as $index => $serviceItem) {

        $serviceParts = explode(
            '_|_',
            $serviceItem['service']
        );

        $serviceName = trim(
            $serviceParts[0] ?? $serviceItem['service']
        );

        $serviceRate = isset($serviceParts[1])
            ? (float) trim($serviceParts[1])
            : 0.0;

        $quantity = (int) ($serviceItem['qnty'] ?? 0);

        $totalCost = $serviceRate * $quantity;

        $dayNumber = $lastDay;

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

// Child mandatory services code start from here
if ($mandatoryChildServices && is_array($mandatoryChildServices)) {
    foreach ($mandatoryChildServices as $index => $serviceItem) {

        $serviceParts = explode(
            '_|_',
            $serviceItem['service']
        );

        $serviceName = trim(
            $serviceParts[0] ?? $serviceItem['service']
        );

        // Decimal price preserve karne ke liye float use karein.
        $serviceRate = isset($serviceParts[1])
            ? (float) trim($serviceParts[1])
            : 0.0;

        $quantity = (int) ($serviceItem['qnty'] ?? 0);

        $totalCost = $serviceRate * $quantity;

        $dayNumber = $lastDay;

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
            'mandatory_child',
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
            'mandatory_child',
            '',
            $itemId
        );
    }
}

// sitescene ticket cost start from here
if ($ticketCosts && is_array($ticketCosts)) {
    foreach ($ticketCosts as $groupIndex => $ticketGroup) {
        if (!isset($ticketGroup['tickets']) || !is_array($ticketGroup['tickets'])) {
            continue;
        }
        
        $dayNumber = isset($ticketGroup['day']) ? (int)$ticketGroup['day'] : 0;
        $dayNumber = max(0, $dayNumber - 1); // convert 1‑based to 0‑based
        
        foreach ($ticketGroup['tickets'] as $ticketIndex => $ticket) {
            
            // ---- NEW: Group ticket (if type is group) ----
            if (isset($ticket['ticket_type']) && $ticket['ticket_type'] === 'group') {
                $ticketName = $ticket['ticket_for'] ?? 'Group Ticket';
                $groupSize = $ticket['group_size'] ?? 0;
                $groupCount = $ticket['group_count'] ?? 1;
                $price = $ticket['price'] ?? 0;
                $total = $ticket['total'] ?? ($ticket['adult_total'] ?? $price * $groupCount);
                
                $serviceName = $ticketName . ($groupSize > 0 ? " (Group of $groupSize)" : " (Group)");
                $itemId = generateItemId('ticket_group', $groupIndex . '_' . $ticketIndex . '_group');
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $serviceName,
                    $groupCount, $price, $total,
                    'ticket', '', $itemId
                );
                continue; // skip adult/child processing for this ticket
            }
            
            // ---- Adult row (original) ----
            $ticketName = $ticket['ticket_for'] ?? 'Ticket';
            $adultCount = isset($ticket['adult_count']) ? (int)$ticket['adult_count'] : 0;
            if ($adultCount > 0) {
                $adultPrice = isset($ticket['price']) ? (float)$ticket['price'] : 0;
                $adultTotal = isset($ticket['adult_total']) ? (float)$ticket['adult_total'] : ($adultCount * $adultPrice);
                
                $itemId = generateItemId('ticket_adult', $groupIndex . '_' . $ticketIndex . '_adult');
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $ticketName . ' (Adult)',
                    $adultCount, $adultPrice, $adultTotal,
                    'ticket', '', $itemId
                );
            }
            
            // ---- Child rows: age‑based OR flat ----
            $isAgeBased = isset($ticket['age_based']) && $ticket['age_based'] == 1;
            
            if ($isAgeBased && isset($ticket['child_ranges']) && is_array($ticket['child_ranges'])) {
                foreach ($ticket['child_ranges'] as $rangeIndex => $range) {
                    $childCount = isset($range['count']) ? (int)$range['count'] : 0;
                    if ($childCount <= 0) continue;
                    
                    $childPrice = isset($range['price']) ? (float)$range['price'] : 0;
                    $childTotal = isset($range['subtotal']) ? (float)$range['subtotal'] : ($childCount * $childPrice);
                    $ageLabel = $range['age_range'] ?? ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                    
                    $itemId = generateItemId('ticket_child_range', $groupIndex . '_' . $ticketIndex . '_range_' . $rangeIndex);
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $ticketName . ' (' . $ageLabel . ')',
                        $childCount, $childPrice, $childTotal,
                        'ticket', '', $itemId
                    );
                }
            } else {
                // Flat child pricing
                $childCount = isset($ticket['child_count']) ? (int)$ticket['child_count'] : 0;
                if ($childCount > 0) {
                    $childPrice = isset($ticket['child_price']) ? (float)$ticket['child_price'] : (isset($ticket['price']) ? (float)$ticket['price'] : 0);
                    $childTotal = isset($ticket['child_total']) ? (float)$ticket['child_total'] : ($childCount * $childPrice);
                    
                    $itemId = generateItemId('ticket_child', $groupIndex . '_' . $ticketIndex . '_child');
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $ticketName . ' (Child)',
                        $childCount, $childPrice, $childTotal,
                        'ticket', '', $itemId
                    );
                }
            }
        }
    }
}

// sitetscene activity cost code start from here
$activityCostTotal = 0;
if ($activity_cost && is_array($activity_cost)) {
    // Helper function to add activity rows (adult, child, group)
    $addActivityRows = function($dayNumber, $activity, $activityName, $dayIndex, $activityIndex) use (&$activityCostTotal, &$itemsByDate, $startDate) {
        
        // ---- GROUP row (if activity is group pricing) ----
        if (isset($activity['is_group']) && $activity['is_group'] == 1) {
            $groupCount = isset($activity['group_count']) ? (int)$activity['group_count'] : 0;
            if ($groupCount > 0) {
                $groupPrice = isset($activity['group_price']) ? (float)$activity['group_price'] : 0;
                $groupTotal = isset($activity['group_total']) ? (float)$activity['group_total'] : ($groupPrice * $groupCount);
                $groupSize = isset($activity['group_size']) ? (int)$activity['group_size'] : 0;
                $groupLabel = $groupSize > 0 ? " (Group of $groupSize)" : " (Group)";
                $activityCostTotal += $groupTotal;
                
                $itemId = generateItemId('activity_group', $dayIndex . '_' . $activityIndex . '_group');
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . $groupLabel,
                    $groupCount, $groupPrice, $groupTotal,
                    'activity', 'Activity', $itemId
                );
            }
            // If group, do NOT add adult/child rows (skip further processing)
            return;
        }
        
        // ---- Adult row (only if not group) ----
        $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
        if ($adultCount > 0) {
            $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
            $adultTotal = isset($activity['adult_total']) ? (float)$activity['adult_total'] : ($adultPrice * $adultCount);
            $activityCostTotal += $adultTotal;
            
            $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
            addItemToDate(
                $itemsByDate, $startDate, $dayNumber,
                $activityName . ' (Adult)',
                $adultCount, $adultPrice, $adultTotal,
                'activity', 'Activity', $itemId
            );
        }
        
        // ---- Child rows (age ranges OR flat) ----
        if (isset($activity['child_age_ranges']) && is_array($activity['child_age_ranges']) && !empty($activity['child_age_ranges'])) {
            // Age‑based child pricing
            foreach ($activity['child_age_ranges'] as $rangeIndex => $range) {
                $childCount = isset($range['count']) ? (int)$range['count'] : 0;
                if ($childCount <= 0) continue;
                
                $childPrice = isset($range['price']) ? (float)$range['price'] : 0;
                $childTotal = isset($range['total']) ? (float)$range['total'] : ($childPrice * $childCount);
                $ageLabel = ($range['age_from'] ?? 0) . '-' . ($range['age_to'] ?? 0) . ' yrs';
                
                $activityCostTotal += $childTotal;
                $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_range_' . $rangeIndex);
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . ' (' . $ageLabel . ')',
                    $childCount, $childPrice, $childTotal,
                    'activity', 'Activity', $itemId
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
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $activityName . ' (Child)',
                    $childCount, $childPrice, $childTotal,
                    'activity', 'Activity', $itemId
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
        // Skip if no day or entrances
        if (!isset($entranceDayGroup['day']) || !isset($entranceDayGroup['entrances'])) {
            continue;
        }
        
        $dayNumber = (int)$entranceDayGroup['day']; // convert 1‑based to 0‑based
        if ($dayNumber < 0 || $dayNumber >= $totalDays) continue;
        
        $entrances = $entranceDayGroup['entrances'];
        if (!is_array($entrances)) continue;
        
        foreach ($entrances as $entrance) {
            $entranceName = $entrance['entrance_name'] ?? 'Entrance';
            
            // Check if this is a group entrance
            $isGroup = isset($entrance['is_group']) && $entrance['is_group'] == 1;
            
            if ($isGroup) {
                // ---- Group row ----
                $groupCount = isset($entrance['group_count']) ? (int)$entrance['group_count'] : 0;
                if ($groupCount > 0) {
                    $groupPrice = isset($entrance['group_price']) ? (float)$entrance['group_price'] : 0;
                    $groupTotal = isset($entrance['group_total']) ? (float)$entrance['group_total'] : ($groupPrice * $groupCount);
                    $personsPerGroup = isset($entrance['persons_per_group']) ? (int)$entrance['persons_per_group'] : 0;
                    $groupLabel = $personsPerGroup > 0 ? " (Group of $personsPerGroup)" : " (Group)";
                    
                    $itemId = generateItemId('entrance_group', $entrance['entrance_id'] ?? uniqid());
                    addItemToDate(
                        $itemsByDate, $startDate, $dayNumber,
                        $entranceName . $groupLabel,
                        $groupCount, $groupPrice, $groupTotal,
                        'entrance', '', $itemId
                    );
                }
                // Skip adult/child rows for group entrances
                continue;
            }
            
            // ---- Adult row (non-group) ----
            $adultPrice = $entrance['adult_price'] ?? 0;
            $adultCount = $entrance['adult_count'] ?? 0;
            $adultTotal = $entrance['adult_total'] ?? ($adultPrice * $adultCount);
            
            if ($adultCount > 0 && $adultPrice > 0) {
                $itemId = generateItemId('entrance_adult', $entrance['entrance_id'] ?? uniqid());
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $entranceName . ' (Adult)',
                    $adultCount, $adultPrice, $adultTotal,
                    'entrance', '', $itemId
                );
            }
            
            // ---- Child age group rows ----
            if (isset($entrance['child_age_ranges']) && is_array($entrance['child_age_ranges'])) {
                foreach ($entrance['child_age_ranges'] as $ageRange) {
                    $childCount = $ageRange['count'] ?? 0;
                    $childPrice = $ageRange['price'] ?? 0;
                    $childTotal = $ageRange['total'] ?? ($childPrice * $childCount);
                    $ageLabel = ($ageRange['age_from'] ?? 0) . '-' . ($ageRange['age_to'] ?? 0) . ' yrs';
                    
                    if ($childCount > 0) {
                        $itemId = generateItemId('entrance_child', ($entrance['entrance_id'] ?? uniqid()) . '_' . ($ageRange['age_range_id'] ?? uniqid()));
                        addItemToDate(
                            $itemsByDate, $startDate, $dayNumber,
                            $entranceName . ' (' . $ageLabel . ')',
                            $childCount, $childPrice, $childTotal,
                            'entrance', '', $itemId
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
                    $childCount, $childPrice, $childTotal,
                    'entrance', '', $itemId
                );
            }
        }
    }
}


// Outside cost (vehicles, parking, tolls) – day-wise with mapping to itinerary days if site_id matches
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
                
                // Main vehicle price (price + parking)
                $price = ($vehicle['price'] ?? 0) + ($vehicle['parking'] ?? 0);
                $vehicleTotal = ($price * $qty);
                
                // Toll amount (if any)
                $tollAmount = $vehicle['toll'] ?? 0;
                
                $outsideCostTotal += $vehicleTotal + $tollAmount;
                
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
                if ($vehicle['parking'] ?? 0 > 0) {
                    $serviceName .= " (Supplement " . number_format($vehicle['parking'], 0, '.', '') . ")";
                }
                
                $outsideCostByDate[$actualDayNumber][] = [
                    'service' => $serviceName . " (Supplement) (Included in bundle)",
                    'frequency' => $qty,
                    'rate' => 0,
                    'total' => 0,
                    'type' => 'outside',
                    'item_id' => $vehicleItemId,
                    'site_id' => $siteId,
                    'is_vehicle' => true
                ];
                
                // Add separate row for toll if toll amount > 0
                if ($tollAmount > 0) {
                    $outsideCostByDate[$actualDayNumber][] = [
                        'service' => $serviceName . " (Toll) (Included in bundle)",
                        'frequency' => $qty,
                        'rate' => 0,
                        'total' => 0,
                        'type' => 'outside_toll',
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

if ($mark_final_date_meal >= $cutoff_date_meal) {
    
    if (!empty($mealData) && is_array($mealData)) {

        // Step 1: Collect all unique meal IDs from the data (works for both structures)
        $mealIds = [];
        foreach ($mealData as $dayMeals) {
            if (!is_array($dayMeals)) continue;

            // Detect structure for this day
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
                foreach ($dayMeals as $cuisineMeals) {
                    if (!is_array($cuisineMeals)) continue;
                    foreach ($cuisineMeals as $mealId => $details) {
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
            // Skip 'all'
            if (strtolower($dayKey) === 'all') continue;

            // Extract day number
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
                        addItemToDate(
                            $itemsByDate, $startDate, $dayNumber,
                            $serviceBase . ' (Adult)',
                            $adultCount, $adultPrice, $adultTotal,
                            'meal', '', $itemId
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
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceBase . ' (' . $range . ')',
                                    $childCount, $childPrice, $childTotal,
                                    'meal', '', $itemId
                                );
                            }
                        }
                    }

                    // ---- ENTERTAINMENT for this exact meal ----
                    if (isset($entertainmentLookup[$dayKey][$mealId])) {
                        $entData = $entertainmentLookup[$dayKey][$mealId];
                        
                        // Check if the structure is missing the name level (i.e., direct price/qty/total)
                        if (isset($entData['price']) && isset($entData['qty']) && isset($entData['total'])) {
                            // Old structure: no entertainment name -> use default "Belly Dance"
                            $price = $entData['price'];
                            $qty   = $entData['qty'];
                            $total = $entData['total'];
                            if ($price > 0) {
                                $serviceName = 'Belly Dance';
                                $itemId = generateItemId('entertainment', $dayKey . '_' . $mealId . '_bellydance');
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceName, $qty, $price, $total,
                                    'entertainment', '', $itemId
                                );
                            }
                        } else {
                            // Correct structure: iterate over entertainment names
                            foreach ($entData as $entName => $details) {
                                $price = $details['price'] ?? 0;
                                $qty   = $details['qty'] ?? 1;
                                $total = $details['total'] ?? ($price * $qty);
                                if ($price <= 0) continue;
                                $serviceName = ucwords(str_replace('_', ' ', $entName));
                                $itemId = generateItemId('entertainment', $dayKey . '_' . $mealId . '_' . $entName);
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceName, $qty, $price, $total,
                                    'entertainment', '', $itemId
                                );
                            }
                        }
                    }
                }
            } else {
                // ----- STRUCTURE B: day => [ cuisine => [ mealId => details ] ] (original) -----
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
                            addItemToDate(
                                $itemsByDate, $startDate, $dayNumber,
                                $serviceBase . ' (Adult)',
                                $adultCount, $adultPrice, $adultTotal,
                                'meal', '', $itemId
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
                                    addItemToDate(
                                        $itemsByDate, $startDate, $dayNumber,
                                        $serviceBase . ' (' . $range . ')',
                                        $childCount, $childPrice, $childTotal,
                                        'meal', '', $itemId
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
                                addItemToDate(
                                    $itemsByDate, $startDate, $dayNumber,
                                    $serviceName, $qty, $price, $total,
                                    'entertainment', '', $itemId
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
                addItemToDate(
                    $itemsByDate, $startDate, $dayNumber,
                    $mealName, $totalPersons, $price, $mealTotal,
                    'meal', '', $itemId
                );
            }
        }
    }
}

// ------------------------------------------------------------------
// DINNER TRANSFER COSTS – per day
// ------------------------------------------------------------------
if (!empty($dinner_transfer_data) && is_array($dinner_transfer_data)) {
    foreach ($dinner_transfer_data as $dayKey => $transferItems) {
        // Skip empty or non‑day keys (e.g., stray [4] => [])
        if (empty($transferItems) || !is_array($transferItems)) {
            continue;
        }
        
        // Extract day number from keys like "day_1", "Day_1", "day 1"
        if (preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) {
            $dayNumber = (int)$matches[1] - 1; // convert 1‑based to 0‑based
            if ($dayNumber < 0 || $dayNumber >= $totalDays) {
                continue;
            }
        } else {
            continue; // not a valid day key
        }
        
        foreach ($transferItems as $mealId => $details) {
            $price = $details['price'] ?? 0;
            $qty   = $details['qty'] ?? 1;
            $total = $details['total'] ?? ($price * $qty);
            
            if ($price <= 0) {
                continue;
            }
            
            $serviceName = 'Dinner Transfer';
            $itemId = generateItemId('dinner_transfer', $dayKey . '_' . $mealId);
            
            addItemToDate(
                $itemsByDate, $startDate, $dayNumber,
                $serviceName .' ('. 'Included in bundle' . ')',
                $qty, 0, 0,
                'dinner_transfer',  // type for optional styling
                '', $itemId
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
        
        // Food
        if (isset($driverItem['food']) && $driverItem['food'] >= 0) {
            $foodPrice = (float)$driverItem['food'];
            $foodTotal = $foodPrice * $qty;
            $itemId = generateItemId('driver_food', $driverItem['index'] ?? uniqid());
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Food)', $qty, $foodPrice, $foodTotal, 'driver', '', $itemId);
        }
        
        // Accommodation
        if (isset($driverItem['accomodation']) && $driverItem['accomodation'] >= 0) {
            $accomPrice = (float)$driverItem['accomodation'];
            $accomTotal = $accomPrice * $qty;
            $itemId = generateItemId('driver_accom', $driverItem['index'] ?? uniqid());
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Accommodation)', $qty, $accomPrice, $accomTotal, 'driver', '', $itemId);
        }
        
        // Guide charge (driver guide charge)
        if (isset($driverItem['guide_charge']) && $driverItem['guide_charge'] >= 0) {
            $guidePrice = (float)$driverItem['guide_charge'];
            $guideTotal = $guidePrice * $qty;
            $itemId = generateItemId('driver_guide', $driverItem['index'] ?? uniqid());
            addItemToDate($itemsByDate, $startDate, $dayNumber, 'Driver (Day Charge)', $qty, $guidePrice, $guideTotal, 'driver', '', $itemId);
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
$trainTicketTotal = 0;
$trainTransportTotal = 0;
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
        if ($item['type'] === 'entrance') {
            $entranceTotal += $item['total'];
        } elseif ($item['type'] === 'activity') {
            $activityTotal += $item['total'];
        } elseif ($item['type'] === 'dinner_transfer') {
            $dinnerTransferTotal += $item['total'];
        } elseif ($item['type'] === 'meal') {
            $mealTotal += $item['total'];
        } elseif ($item['type'] === 'guide') {
            $guideTotal += $item['total'];
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
foreach ($itemsByDate as $dateData) {
    foreach ($dateData['items'] as $item) {
        $subtotal += $item['total'];
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

// Calculate final total including meals
$finalTotal = $subtotal + $netBundlePrice;
// $finalTotal += ($finalTotal * ($land_markup / 100));

$usdAmount = ($exchangeRate > 0) ? $finalTotal / $exchangeRate : 0;
?>

<table class="budget-report" style="border:2px solid #000000ff;">
    <thead>
        <tr >
            <th colspan="4" style="background-color: #FF7C80;"></th>
            <th style="background-color: #FF7C80;">AGGREED BUDGET</th>
        </tr>
        <tr>
            <th style="background-color: #E6B8B7;">DATE</th>
            <th style="background-color: #E6B8B7;">SERVICES</th>
            <th style="background-color: #E6B8B7;">FREQUENCY</th>
            <th style="background-color: #E6B8B7;">RATE IN <?php echo $currency_abbr; ?></th>
            <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr; ?></th>
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
                    
                    foreach ($items as $index => $item) {
                        // Set background color based on item type
                        $bgColor = '';
                        $rowBgColor = '';
                        if ($item['type'] === 'activity') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                        } elseif ($item['type'] === 'hotel') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                        } elseif ($item['type'] === 'outside') {
                            $bgColor = 'style="background-color: #ffffffff !important;"';
                        } elseif ($item['type'] === 'meal') {
                            $bgColor = 'style="background-color: #ffffffff;"';
                        }
                        
                        // Determine if this is the first row for this date
                        $isFirstRow = ($index === 0);
                        
                        // Format rate display
                        $rateDisplay = '';
                        if (is_string($item['rate']) && strpos($item['rate'], '/') !== false) {
                            $rateParts = explode('/', $item['rate']);
                            $rateDisplay = number_format($rateParts[0], 0, '.', '');
                            if (isset($rateParts[1]) && $rateParts[1] > 0) {
                                $rateDisplay .= '/' . number_format($rateParts[1], 0, '.', '');
                            }
                        } else {
                            // $rateDisplay = number_format($item['rate'], 0, '.', '');
                            $rateDisplay = number_format($item['rate'], 2, '.', '');
                        }
                ?>
                <tr <?php echo $rowBgColor; ?> data-item-id="<?php echo $item['item_id']; ?>" data-date-key="<?php echo $dateKey; ?>">
                    <?php if ($isFirstRow): ?>
                
                    <td rowspan="<?php echo $rowspan; ?>" <?php echo $rowBgColor; ?> style="vertical-align: top;">
                        <b><?php echo htmlspecialchars($displayDate); ?></b>
                    </td>
                    <?php endif; ?>
                    
                    <td <?php echo $bgColor; ?>  data-service="<?php echo htmlspecialchars($item['service']); ?>">
                        <?php if ($item['type'] === 'outside'): ?>
                            <?php echo formatServiceText($item['service']); ?>
                        <?php else: ?>
                            <?php echo formatServiceText($item['service']); ?>
                        <?php endif; ?>
                    </td>        
                    
                    <td <?php echo $bgColor; ?>>
                        <span class="value-display"><?php echo $item['frequency']; ?></span>
                    </td>
                    
                    <td <?php echo $bgColor; ?>>
                        <span class="value-display"><?php echo $rateDisplay; ?></span>
                    </td>
                    
                    <td style="background-color: #eccdccff;" class="budget-total" data-item-id="<?php echo $item['item_id']; ?>">
                        <span class="value-display"><?php echo number_format($item['total'], 2, '.', ''); ?></span>
                    </td>
                </tr>
                <?php
                        }
                        $previousDateKey = $dateKey;
                        $dateCounter++;
                    }
                
                    $lastDate = date('d M', strtotime($startDate . ' + ' . $lastDay . ' days'));
                ?>
        
                <?php if ($totalTransport > 0): ?>
                <!-- Bundle Price -->
                <tr class="outside-section">
                    <td></td>
                    <td style="font-weight: 800;background-color: #FFC000 !important;">Bundle Price (Transport Uses)</td>
                    <td>
                        <span class="value-display">1</span>
                    </td>
                    <td>
                        <span class="value-display"><?php echo number_format($netBundlePrice, 2, '.', ''); ?></span>
                    </td>
                    <td style="background-color: #eccdccff;" id="bundle-budget-total">
                        <span class="value-display"><?php echo number_format($netBundlePrice, 2, '.', ''); ?></span>
                    </td>
                </tr>
                <?php endif; ?>

                <!-- Gap before totals -->
                <tr class="date-gap-row">
                    <td colspan="8"></td>
                </tr>

                <!-- Total Amount -->
                <tr style="font-weight: bold; background-color: #FFE4E1;">
                    <td colspan="4" style="text-align: right;">TOTAL AMOUNT IN (<?php echo $currency_abbr; ?>)</td>
                    <td id="total-budget-amount">
                        <span class="value-display"><?php echo number_format($finalTotal, 2, '.', ''); ?></span>
                    </td>
                </tr>

                <!-- Exchange Rate -->
                <tr style="font-weight: bold;">
                    <td colspan="4" style="text-align: right;">EXCHANGE RATE ROE</td>
                    <td id="original-exchange-rate">
                        <span class="value-display"><?php echo number_format($exchangeRate, 2, '.', ''); ?></span>
                    </td>
                </tr>

                <!-- Amount in USD -->
                <tr style="font-weight: bold; background-color: #E8F4F8;">
                    <td colspan="4" style="text-align: right;">AMOUNT IN USD</td>
                    <td id="usd-budget-amount">
                        <span class="value-display"><?php echo number_format($usdAmount, 2, '.', ''); ?></span>
                    </td>
                </tr>
                
                <!-- Hotel Total -->
                <?php if ($hotelTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <!-- <td></td> -->
                    <td colspan="1" style="text-align: right;">Hotel TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($hotelTotal, 2, '.', ''); ?></td>

                    <td colspan="4"></td>
                </tr>
                <?php endif; ?>

                <!-- Train Ticket Total -->
                <?php if ($trainTicketTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">Train Ticket TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($trainTicketTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>
                                
                <!-- Ticket Total -->
                <?php if ($TicketCostTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <!-- <td></td> -->
                    <td colspan="1" style="text-align: right;">Ticket TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($TicketCostTotal, 2, '.', ''); ?></td>

                    <td colspan="4"></td>
                </tr>
                <?php endif; ?>

                <!-- Entrance Total -->
                <?php if ($entranceTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">ENTRANCE TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($entranceTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>

                <!-- Activity Total -->
                <?php if ($activityTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">ACTIVITY TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($activityTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>

                <!-- Guide Total -->
                <?php if ($guideTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">Guide TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($guideTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>
                
                <!-- Meal Total -->
                <?php if ($mealTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">Meal TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($mealTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>

                 <!-- Entertainment Total -->
                <?php if ($entertainmentTotal > 0): ?>
                <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">Entertainment TOTAL (<?php echo $currency_abbr; ?>)</td>
                    <td><?php echo number_format($entertainmentTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>
                
                <!-- Dinner Transfer Total -->
                <?php //if ($dinnerTransferTotal > 0): ?>
                <!-- <tr style="font-weight: bold; background-color: #D5E8D4;">
                    <td colspan="1" style="text-align: right;">Dinner Transfer TOTAL (<?php //echo $currency_abbr; ?>)</td>
                    <td><?php //echo number_format($dinnerTransferTotal, 2, '.', ''); ?></td>
                    <td colspan="3"></td>
                </tr> -->
                <?php //endif; ?>
                
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

<div class="text-center" style="margin-top: 30px; margin-bottom: 30px;">
    <a href="<?php echo base_url('admin/BudgetReport/original_budget_report_mpdf/' . $encoded_id); ?>" class="btn btn-primary" style="margin-right: 15px;">
        <i class="glyphicon glyphicon-download"></i> Download PDF
    </a>
    <a href="?excel_download=1" class="btn btn-success" style="margin-right: 15px;">
        <i class="glyphicon glyphicon-download-alt"></i> Export to Excel
    </a>
    <button onclick="window.close()" class="btn btn-danger">
        <i class="glyphicon glyphicon-remove"></i> Close
    </button>
</div>
</div>
<script>
    // Download PDF Function
    function downloadPDF() {
        const loadingOverlay = document.getElementById('loadingOverlay');
        loadingOverlay.style.display = 'flex';
        
        // Get the card element
        const element = document.querySelector('.card');
        
        // Generate filename
        const companyName = "<?php echo addslashes($company_name); ?>";
        const enquiryNo = "<?php echo $report->enquiry_no ?? ''; ?>";
        const checkInDate = "<?php echo date('d-M-Y', strtotime($report->check_in_date)); ?>";
        const checkOutDate = "<?php echo date('d-M-Y', strtotime($report->check_out_date)); ?>";
        const filename = `Budget_Report_${companyName}_${enquiryNo}_${checkInDate}_to_${checkOutDate}.pdf`;
        
        // PDF options
        const options = {
            margin: [0, 0, 0, 0],
            filename: filename,
            image: { 
                type: 'jpeg', 
                quality: 0.98 
            },
            html2canvas: { 
                scale: 2,
                useCORS: true,
                scrollY: 0,
                backgroundColor: '#FFFFFF',
                logging: false
            },
            jsPDF: { 
                unit: 'mm', 
                format: 'a4', 
                orientation: 'portrait' 
            }
        };
        
        // Generate and download PDF
        html2pdf()
            .set(options)
            .from(element)
            .save()
            .then(() => {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';
                
                // Show success message
                showNotification('PDF downloaded successfully!', 'success');
            })
            .catch((error) => {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';
                
                // Show error message
                showNotification('Error generating PDF. Please try again.', 'error');
                console.error('PDF generation error:', error);
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
            z-index: 10000;
            transition: opacity 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease-out;
        `;
        
        notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
        notification.textContent = message;
        
        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
        
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
</script>
</body>
</html>