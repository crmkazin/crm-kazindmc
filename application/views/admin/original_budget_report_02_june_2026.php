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
        <div class="sub-title">Person - <?php echo $report->number_persons + $report->number_child; ?></div>
        </div>
    </div>

<?php
$guideCosts = json_decode($report->guide_cost, true);
$ticketCosts = json_decode($report->ticket_cost ?? '[]', true);
$mandatoryServices = json_decode($report->mandatory_services ?? '[]', true);
$outside_cost = json_decode($report->outside_cost ?? '[]', true);
$activity_cost = json_decode($report->activity_cost ?? '[]', true);
$hotel_cost = json_decode($report->hotel_cost ?? '[]', true);
$totalTransport = $report->total_transport ?? 0;
$discount_bundle_price = $report->discount_bundle_price ?? 0;
$guide_details = $report->guide_details ?? '';
$itinerary_details = $report->itinerary_details ?? '';
$meal_type_daywise_price = $report->meal_type_daywise_price ?? '';
$cnb = $report->cnb ?? '';
$cnb_count = $report->cnb_count ?? '';
$cwb = $report->cwb ?? '';
$cwb_count = $report->cwb_count ?? '';

// Parse meal data
$mealData = [];
if ($meal_type_daywise_price) {
    $mealData = json_decode($meal_type_daywise_price, true);
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


if ($guideCosts && is_array($guideCosts)) {
    foreach ($guideCosts as $index => $guideDay) {
        $dayNumber = $guideDay['day'];
        $rate = ($guideDay['qty'] > 0 && $guideDay['total'] > 0) ? 
                $guideDay['total'] / $guideDay['qty'] : 0;
        
        $itemId = generateItemId('guide', $index);
        
        addItemToDate(
            $itemsByDate,
            $startDate,
            $dayNumber,
            'Day Guide',
            $guideDay['qty'],
            $rate,
            $guideDay['total'],
            'guide',
            '',
            $itemId
        );
    }
}

if (empty($report->room_breakdown)) {
    // HOTEL COSTS - Handle both formats with CNB/CWB separate rows
    $hotelCostTotal = 0;
    if ($hotel_cost && is_array($hotel_cost)) {
        $dayNumber = 0; 
        $hotelItems = []; // Array to store all hotel items
        
        $cnb = $report->cnb ?? 0;
        $cnb_count = $report->cnb_count ?? 0;
        $cwb = $report->cwb ?? 0;
        $cwb_count = $report->cwb_count ?? 0;
        
        foreach ($hotel_cost as $hotelCategory => $hotels) {
            foreach ($hotels as $hotelName => $roomData) {
                // New format with hotel_id, hotel_city, nights
                if (isset($roomData['hotel_id']) || isset($roomData['hotel_city'])) {
                    $nights = $roomData['nights'] ?? 1;
                    
                    foreach ($roomData as $key => $value) {
                        if (in_array($key, ['hotel_id', 'hotel_city', 'nights'])) {
                            continue;
                        }
                        if (is_array($value)) {
                            foreach ($value as $occupancyData) {
                                if (is_string($occupancyData) && strpos($occupancyData, '__') !== false) {
                                    $parts = explode('__', $occupancyData);
                                    $occupancyType = $parts[0] ?? '';
                                    $cost = (int)$parts[1] ?? 0;
                                    
                                    // Calculate per night cost
                                    $perNightCost = $cost;
                                    $totalCost = $cost * (int)$nights;
                                    
                                    // Create separate items for each occupancy type
                                    switch($occupancyType) {
                                        case 'Single Occupancy':
                                        case 'Double Occupancy': 
                                        case 'Triple Occupancy':
                                            $serviceName = "$hotelName ($occupancyType)";
                                            $frequency = $report->number_persons ?? 1;
                                            $rate = $perNightCost * $frequency;
                                            $total = $totalCost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_adult'
                                            ];
                                            $hotelCostTotal += $total;
                                            break;
                                            
                                        case 'CNB Occupancy':
                                            if ($cnb > 0 && $cnb_count > 0) {
                                                $serviceName = "$hotelName (CNB Occupancy)";
                                                $frequency = $cnb_count;
                                                $rate = $perNightCost * $frequency;
                                                $total = $totalCost * $frequency;
                                                
                                                $hotelItems[] = [
                                                    'name' => $serviceName,
                                                    'frequency' => $frequency,
                                                    'rate' => $rate,
                                                    'total' => $total,
                                                    'type' => 'hotel_cnb'
                                                ];
                                                $hotelCostTotal += $total;
                                            }
                                            break;
                                            
                                        case 'CWB Occupancy':
                                            if ($cwb > 0 && $cwb_count > 0) {
                                                $serviceName = "$hotelName (CWB Occupancy)";
                                                $frequency = $cwb_count;
                                                $rate = $perNightCost * $frequency;
                                                $total = $totalCost * $frequency;
                                                
                                                $hotelItems[] = [
                                                    'name' => $serviceName,
                                                    'frequency' => $frequency,
                                                    'rate' => $rate,
                                                    'total' => $total,
                                                    'type' => 'hotel_cwb'
                                                ];
                                                $hotelCostTotal += $total;
                                            }
                                            break;
                                    }
                                }
                            }
                        }
                    }
                } 
                // Old format - direct room types
                else {
                    foreach ($roomData as $roomType => $occupancies) {
                        foreach ($occupancies as $occupancyData) {
                            if (is_string($occupancyData) && strpos($occupancyData, '__') !== false) {
                                $parts = explode('__', $occupancyData);
                                $occupancyType = $parts[0] ?? '';
                                $cost = (int)$parts[1] ?? 0;
                                
                                switch($occupancyType) {
                                    case 'Single Occupancy':
                                    case 'Double Occupancy': 
                                    case 'Triple Occupancy':
                                        $serviceName = "$hotelName ($occupancyType)";
                                        $frequency = $report->number_persons ?? 1;
                                        $rate = $cost;
                                        $total = $cost * $frequency;
                                        
                                        $hotelItems[] = [
                                            'name' => $serviceName,
                                            'frequency' => $frequency,
                                            'rate' => $rate,
                                            'total' => $total,
                                            'type' => 'hotel_adult'
                                        ];
                                        $hotelCostTotal += $total;
                                        break;
                                        
                                    case 'CNB Occupancy':
                                        if ($cnb > 0 && $cnb_count > 0) {
                                            $serviceName = "$hotelName (CNB Occupancy)";
                                            $frequency = $cnb_count;
                                            $rate = $cost;
                                            $total = $cost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_cnb'
                                            ];
                                            $hotelCostTotal += $total;
                                        }
                                        break;
                                        
                                    case 'CWB Occupancy':
                                        if ($cwb > 0 && $cwb_count > 0) {
                                            $serviceName = "$hotelName (CWB Occupancy)";
                                            $frequency = $cwb_count;
                                            $rate = $cost;
                                            $total = $cost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_cwb'
                                            ];
                                            $hotelCostTotal += $total;
                                        }
                                        break;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        // Add all hotel items to itemsByDate
        foreach ($hotelItems as $index => $item) {
            $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
            
            addItemToDate(
                $itemsByDate,
                $startDate,
                $dayNumber,
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
}else{
    // 07 Feb 2026 updated 
    // HOTEL COSTS - Handle both formats with CNB/CWB separate rows
    $hotelCostTotal = 0;
    if ($hotel_cost && is_array($hotel_cost)) {
        $dayNumber = 0; 
        $hotelItems = []; 
        
        $roomBreakdown = [];
        if (!empty($report->room_breakdown)) {
            $roomBreakdown = json_decode($report->room_breakdown, true);
        }
        
        $markup_split = $report->markup_split ?? 'no';
        
        $cnb = $report->cnb ?? 0;
        $cnb_count = $report->cnb_count ?? 0;
        $cwb = $report->cwb ?? 0;
        $cwb_count = $report->cwb_count ?? 0;
        
        // Mapping from occupancy type to room type key and capacity
        $occupancyMapping = [
            'Single Occupancy' => ['key' => 'single', 'capacity' => 1],
            'Double Occupancy' => ['key' => 'double', 'capacity' => 2],
            'Triple Occupancy' => ['key' => 'triple', 'capacity' => 3],
            'Quad Occupancy' => ['key' => 'quad', 'capacity' => 4],
            'Quint Occupancy' => ['key' => 'quint', 'capacity' => 5],
            'Sext Occupancy' => ['key' => 'sext', 'capacity' => 6]
        ];
        
        foreach ($hotel_cost as $hotelCategory => $hotels) 
        {
            foreach ($hotels as $hotelName => $roomData) 
            {
                $cleanHotelName = preg_replace('/_\d+(?:_\d+)*$/', '', $hotelName);
                
                $isNewFormat = isset($roomData['hotel_id']) || isset($roomData['hotel_city']) || isset($roomData['nights']);
                
                if ($isNewFormat) {
                    $hotel_id = $roomData['hotel_id'] ?? 0;
                    $hotel_city = $roomData['hotel_city'] ?? '';
                    $hotel_nights = $roomData['nights'] ?? [];
                    
                    foreach ($roomData as $key => $value) {
                        if (in_array($key, ['hotel_id', 'hotel_city', 'nights', 'hotel_name'])) {
                            continue;
                        }
                        
                        if (is_array($value)) {
                            $roomTypeNights = [];
                            if (strpos($key, '_nights_') !== false) {
                                $parts = explode('_nights_', $key);
                                if (isset($parts[1])) {
                                    $nightNumbers = explode('_', $parts[1]);
                                    $roomTypeNights = array_map('intval', $nightNumbers);
                                }
                            }
                            
                            $nightsCount = count($roomTypeNights);
                            if ($nightsCount == 0) {
                                $nightsCount = count($hotel_nights);
                            }
                            
                            foreach ($value as $occupancyData) {
                                if (is_string($occupancyData) && strpos($occupancyData, '__') !== false) {
                                    $parts = explode('__', $occupancyData);
                                    $occupancyType = $parts[0] ?? '';
                                    $cost = (int)$parts[1] ?? 0;
                                    
                                    if (isset($occupancyMapping[$occupancyType])) {
                                        $mapping = $occupancyMapping[$occupancyType];
                                        $roomTypeKey = $mapping['key'];
                                        $capacity = $mapping['capacity'];
                                        
                                        $roomCount = $roomBreakdown[$roomTypeKey]['room_count'] ?? 0;
                                        
                                        if ($roomCount > 0) {
                                            $serviceName = "$cleanHotelName ($occupancyType)";
                                            $frequency = $roomCount;
                                            
                                            if ($markup_split == 'yes') {
                                                $rate = $cost * $nightsCount; // Cost per room per night
                                                $total = ($rate * $roomCount); 
                                            } else {
                                                $rate = $cost * $capacity; 
                                                $total = ($cost * $capacity * $roomCount); // (cost per person * capacity * room count) * nights
                                            }
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_adult',
                                                'room_type' => $occupancyType,
                                                'room_count' => $roomCount,
                                                'capacity' => $capacity,
                                                'nights' => $nightsCount,
                                                'cost_per_person' => $cost,
                                                'markup_split' => $markup_split,
                                                'format' => 'new'
                                            ];
                                            $hotelCostTotal += $total;
                                        }
                                    } 
                                    // Handle CNB and CWB
                                    elseif ($occupancyType === 'CNB Occupancy') {
                                        if ($cnb > 0 && $cnb_count > 0) {
                                            $serviceName = "$cleanHotelName (CNB Occupancy)";
                                            $frequency = $cnb_count;
                                            
                                            // For CNB, always use per child calculation
                                            
                                            if ($markup_split == 'yes') {
                                                $rate = $cost;
                                                $total = ($cost * $frequency) * $nightsCount;
                                            } else {
                                                $rate = $cost; // Cost per child per night
                                                $total = ($cost * $frequency); // (cost per person * capacity * room count) * nights
                                            }
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_cnb',
                                                'nights' => $nightsCount,
                                                'markup_split' => $markup_split
                                            ];
                                            $hotelCostTotal += $total;
                                        }
                                    }
                                    elseif ($occupancyType === 'CWB Occupancy') {
                                        if ($cwb > 0 && $cwb_count > 0) {
                                            $serviceName = "$cleanHotelName (CWB Occupancy)";
                                            $frequency = $cwb_count;
                                            
                                            // For CWB, always use per child calculation
                                            // $rate = $cost; // Cost per child per night
                                            // $total = ($cost * $frequency) * $nightsCount;
                                            if ($markup_split == 'yes') {
                                                $rate = $cost;
                                                $total = ($cost * $frequency) * $nightsCount;
                                            } else {
                                                $rate = $cost; // Cost per child per night
                                                $total = ($cost * $frequency); // (cost per person * capacity * room count) * nights
                                            }
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $rate,
                                                'total' => $total,
                                                'type' => 'hotel_cwb',
                                                'nights' => $nightsCount,
                                                'markup_split' => $markup_split
                                            ];
                                            $hotelCostTotal += $total;
                                        }
                                    }
                                }
                            }
                        }
                    }
                } 
                // Old format - direct room types
                else {
                    // For old format, get trip nights
                    $tripNights =  1;
                    
                    foreach ($roomData as $roomType => $occupancies) {
                        foreach ($occupancies as $occupancyData) {
                            if (is_string($occupancyData) && strpos($occupancyData, '__') !== false) {
                                $parts = explode('__', $occupancyData);
                                $occupancyType = $parts[0] ?? '';
                                $cost = (int)$parts[1] ?? 0;
                                
                                if (isset($occupancyMapping[$occupancyType])) {
                                    $mapping = $occupancyMapping[$occupancyType];
                                    $roomTypeKey = $mapping['key'];
                                    $capacity = $mapping['capacity'];
                                    
                                    // Get room count from room breakdown
                                    $roomCount = $roomBreakdown[$roomTypeKey]['room_count'] ?? 0;
                                    
                                    if ($roomCount > 0) {
                                        $serviceName = "$cleanHotelName ($occupancyType)";
                                        $frequency = $roomCount;
                                        
                                        // For old format, always multiply by capacity (per person pricing)
                                        $rate = $cost * $capacity; // Rate per room per night
                                        $total = ($cost * $capacity * $roomCount) * $tripNights;
                                        
                                        $hotelItems[] = [
                                            'name' => $serviceName,
                                            'frequency' => $frequency,
                                            'rate' => $rate,
                                            'total' => $total,
                                            'type' => 'hotel_adult',
                                            'room_type' => $occupancyType,
                                            'room_count' => $roomCount,
                                            'capacity' => $capacity,
                                            'nights' => $tripNights,
                                            'cost_per_person' => $cost,
                                            'format' => 'old'
                                        ];
                                        $hotelCostTotal += $total;
                                    }
                                }
                                // Handle CNB and CWB
                                elseif ($occupancyType === 'CNB Occupancy') {
                                    if ($cnb > 0 && $cnb_count > 0) {
                                        $serviceName = "$cleanHotelName (CNB Occupancy)";
                                        $frequency = $cnb_count;
                                        
                                        // For CNB, cost is per child per night
                                        $rate = $cost; // Cost per child per night
                                        $total = ($cost * $frequency) * $tripNights;
                                        
                                        $hotelItems[] = [
                                            'name' => $serviceName,
                                            'frequency' => $frequency,
                                            'rate' => $rate,
                                            'total' => $total,
                                            'type' => 'hotel_cnb',
                                            'nights' => $tripNights
                                        ];
                                        $hotelCostTotal += $total;
                                    }
                                }
                                elseif ($occupancyType === 'CWB Occupancy') {
                                    if ($cwb > 0 && $cwb_count > 0) {
                                        $serviceName = "$cleanHotelName (CWB Occupancy)";
                                        $frequency = $cwb_count;
                                        
                                        // For CWB, cost is per child per night
                                        $rate = $cost; // Cost per child per night
                                        $total = ($cost * $frequency) * $tripNights;
                                        
                                        $hotelItems[] = [
                                            'name' => $serviceName,
                                            'frequency' => $frequency,
                                            'rate' => $rate,
                                            'total' => $total,
                                            'type' => 'hotel_cwb',
                                            'nights' => $tripNights
                                        ];
                                        $hotelCostTotal += $total;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        // Add all hotel items to itemsByDate
        foreach ($hotelItems as $index => $item) {
            $itemId = generateItemId('hotel_' . $item['type'], md5($item['name']) . '_' . $index);
            
            addItemToDate(
                $itemsByDate,
                $startDate,
                $dayNumber,
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
}
if ($mandatoryServices && is_array($mandatoryServices)) {
    foreach ($mandatoryServices as $index => $serviceItem) {
        $serviceParts = explode('_|_', $serviceItem['service']);
        $serviceName = $serviceParts[0] ?? $serviceItem['service'];
        $serviceRate = isset($serviceParts[1]) ? (int)$serviceParts[1] : 0;
        $quantity = (int)$serviceItem['qnty'];
        $totalCost = $serviceRate * $quantity;
        
        $dayNumber = $lastDay;
        
        if (strpos($serviceName, 'Refreshing napkins') !== false || 
            strpos($serviceName, 'chocolate inside the vehicle upon arrival') !== false) {
            $dayNumber = 0; 
        }
        
        $itemId = generateItemId('mandatory', $index);
        
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

if ($ticketCosts && is_array($ticketCosts)) {
    foreach ($ticketCosts as $groupIndex => $ticketGroup) {
        if (isset($ticketGroup['tickets']) && is_array($ticketGroup['tickets'])) {
            foreach ($ticketGroup['tickets'] as $ticketIndex => $ticket) {

                $dayNumber = isset($ticketGroup['day']) ? (int)$ticketGroup['day'] : 0;
                $dayNumber = max(0, $dayNumber - 1);

                // ✅ Individual Ticket - Adult
                if (isset($ticket['ticket_type']) && $ticket['ticket_type'] == 'individual') {

                    if (!empty($ticket['adult_count']) && $ticket['adult_count'] > 0) {
                        $itemId = generateItemId('ticket_adult', $groupIndex . '_' . $ticketIndex . '_adult');

                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $ticket['ticket_for'] . ' (Adult)',
                            $ticket['adult_count'],
                            $ticket['price'],
                            $ticket['adult_count'] * $ticket['price'],
                            'ticket',
                            '',
                            $itemId
                        );
                    }

                    // Child
                    if (!empty($ticket['child_count']) && $ticket['child_count'] > 0) {
                        $childPrice = isset($ticket['child_price']) ? $ticket['child_price'] : $ticket['price'];

                        $itemId = generateItemId('ticket_child', $groupIndex . '_' . $ticketIndex . '_child');

                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $ticket['ticket_for'] . ' (Child)',
                            $ticket['child_count'],
                            $childPrice,
                            $ticket['child_count'] * $childPrice,
                            'ticket',
                            '',
                            $itemId
                        );
                    }
                }

                // ✅ Group Ticket Logic (NEW)
                if (isset($ticket['ticket_type']) && $ticket['ticket_type'] == 'group') {

                    if (!empty($ticket['group_count']) && $ticket['group_count'] > 0) {

                        $itemId = generateItemId('ticket_group', $groupIndex . '_' . $ticketIndex . '_group');

                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $ticket['ticket_for'] . ' (Group)',
                            $ticket['group_count'], // number of groups
                            $ticket['price'],       // price per group
                            $ticket['group_count'] * $ticket['price'],
                            'ticket',
                            '',
                            $itemId
                        );
                    }
                }
            }
        }
    }
}



$activityCostTotal = 0;
if ($activity_cost && is_array($activity_cost)) {
    if (isset($activity_cost['activity_data']) && is_array($activity_cost['activity_data'])) {
        foreach ($activity_cost['activity_data'] as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    
                    // Adult activity अलग row में
                    $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
                    if ($adultCount > 0) {
                        $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
                        $adultTotal = $adultPrice * $adultCount;
                        $activityCostTotal += $adultTotal;
                        
                        $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
                        
                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $activityName . ' (Adult)',
                            $adultCount,
                            $adultPrice,
                            $adultTotal,
                            'activity',
                            'Activity',
                            $itemId
                        );
                    }
                    
                    // Child activity अलग row में
                    $childCount = isset($activity['child_count']) ? (int)$activity['child_count'] : 0;
                    if ($childCount > 0) {
                        $childPrice = isset($activity['child_price']) ? (float)$activity['child_price'] : 0;
                        $childTotal = $childPrice * $childCount;
                        $activityCostTotal += $childTotal;
                        
                        $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_child');
                        
                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $activityName . ' (Child)',
                            $childCount,
                            $childPrice,
                            $childTotal,
                            'activity',
                            'Activity',
                            $itemId
                        );
                    }
                }
            }
        }
    }
    elseif (isset($activity_cost[0]) && is_array($activity_cost[0])) {
        foreach ($activity_cost as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    
                    // Adult activity अलग row में
                    $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
                    if ($adultCount > 0) {
                        $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
                        $adultTotal = $adultPrice * $adultCount;
                        $activityCostTotal += $adultTotal;
                        
                        $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
                        
                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $activityName . ' (Adult)',
                            $adultCount,
                            $adultPrice,
                            $adultTotal,
                            'activity',
                            'Activity',
                            $itemId
                        );
                    }
                    
                    // Child activity अलग row में
                    $childCount = isset($activity['child_count']) ? (int)$activity['child_count'] : 0;
                    if ($childCount > 0) {
                        $childPrice = isset($activity['child_price']) ? (float)$activity['child_price'] : 0;
                        $childTotal = $childPrice * $childCount;
                        $activityCostTotal += $childTotal;
                        
                        $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_child');
                        
                        addItemToDate(
                            $itemsByDate,
                            $startDate,
                            $dayNumber,
                            $activityName . ' (Child)',
                            $childCount,
                            $childPrice,
                            $childTotal,
                            'activity',
                            'Activity',
                            $itemId
                        );
                    }
                }
            }
        }
    }
}


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
                    'service' => $serviceName . " (Supplement)",
                    'frequency' => $qty,
                    'rate' => $price,
                    'total' => $vehicleTotal,
                    'type' => 'outside',
                    'item_id' => $vehicleItemId,
                    'site_id' => $siteId,
                    'is_vehicle' => true
                ];
                
                // Add separate row for toll if toll amount > 0
                if ($tollAmount > 0) {
                    $outsideCostByDate[$actualDayNumber][] = [
                        'service' => $serviceName . " (Toll)",
                        'frequency' => $qty,
                        'rate' => $tollAmount,
                        'total' => $tollAmount,
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

// Sort by date
ksort($itemsByDate);

// Add meal costs to itemsByDate
if (!empty($mealData) && is_array($mealData)) {
    foreach ($mealData as $dayKey => $dayMeals) {
        // Skip 'all' key completely - case insensitive
        if (strtolower($dayKey) === 'all') {
            continue;
        }
        
        // Extract day number from key - handle multiple formats
        $dayNumber = 0;
        
        // Handle formats: day_1, Day_1, day 1, Day 1, etc.
        if (preg_match('/day[_\s]?(\d+)/i', $dayKey, $matches)) {
            $dayNumber = (int)$matches[1] - 1;
        } else {
            continue; // Skip if not a valid day key
        }
        
        // Valid day check
        if ($dayNumber < 0 || $dayNumber >= $totalDays) {
            continue;
        }
        
        if (is_array($dayMeals)) {
            foreach ($dayMeals as $mealType => $mealDetails) {
                if (!is_array($mealDetails)) {
                    continue;
                }
                
                $mealName = ucfirst($mealType);
                
                // Add cuisine if available
                if (isset($mealDetails['cusine']) && !empty($mealDetails['cusine'])) {
                    $mealName .= " ({$mealDetails['cusine']})";
                }
                
                // Get values from day-specific data only
                $price = $mealDetails['price'] ?? 0;
                $totalPersons = $mealDetails['total_persons'] ?? 0;
                $mealTotal = $mealDetails['meal_total'] ?? ($price * $totalPersons);
                
                // Skip if no valid price
                if ($price <= 0) {
                    continue;
                }
                
                // If total_persons is 0, use 1 as default (minimum 1 person)
                if ($totalPersons <= 0) {
                    $totalPersons = 1;
                }
                
                // Recalculate mealTotal if it's 0
                if ($mealTotal <= 0) {
                    $mealTotal = $price * $totalPersons;
                }
                
                $itemId = generateItemId('meal', $dayKey . '_' . $mealType);
                
                addItemToDate(
                    $itemsByDate,
                    $startDate,
                    $dayNumber,
                    $mealName,
                    $totalPersons,
                    $price,
                    $mealTotal,
                    'meal',
                    '',
                    $itemId
                );
            }
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

$netBundlePrice = ($totalTransport - $discount_bundle_price) - $outsideCostTotal;
if ($netBundlePrice < 0) {
    $netBundlePrice = 0;
}

// Calculate final total including meals
$finalTotal = $subtotal + $netBundlePrice; 

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
                        $rateDisplay = number_format($item['rate'], 0, '.', '');
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
                    <?php echo htmlspecialchars($item['service']); ?>
                <?php else: ?>
                    <?php echo htmlspecialchars($item['service']); ?>
                <?php endif; ?>
            </td>
            
            <td <?php echo $bgColor; ?>>
                <span class="value-display"><?php echo $item['frequency']; ?></span>
            </td>
            
            <td <?php echo $bgColor; ?>>
                <span class="value-display"><?php echo $rateDisplay; ?></span>
            </td>
            
            <td style="background-color: #eccdccff;" class="budget-total" data-item-id="<?php echo $item['item_id']; ?>">
                <span class="value-display"><?php echo number_format($item['total'], 0, '.', ''); ?></span>
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
            <td style="font-weight: 800;background-color: #FFC000 !important;">Bundle Price</td>
            <td>
                <span class="value-display">1</span>
            </td>
            <td>
                <span class="value-display"><?php echo number_format($netBundlePrice, 0, '.', ''); ?></span>
            </td>
            <td style="background-color: #eccdccff;" id="bundle-budget-total">
                <span class="value-display"><?php echo number_format($netBundlePrice, 0, '.', ''); ?></span>
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
                <span class="value-display"><?php echo number_format($finalTotal, 0, '.', ''); ?></span>
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
                <span class="value-display"><?php echo number_format($usdAmount, 0, '.', ''); ?></span>
            </td>
        </tr>
        
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
    <!-- <button onclick="downloadPDF()" class="btn btn-success" style="margin-right: 15px;">
        <i class="glyphicon glyphicon-download"></i> Download PDF
    </button> -->
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
            margin: [10, 10, 10, 10],
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