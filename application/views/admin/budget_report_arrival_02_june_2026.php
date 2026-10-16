<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Closing Budget Report</title>
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
        <div class="sub-title">Person - <?php echo $report->number_persons + $report->number_child; ?></div>
    </div>

<?php
// Get original data
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
$guide_details = $report->cnb ?? '';
$guide_details = $report->cnb_count ?? '';
$guide_details = $report->cwb ?? '';
$guide_details = $report->cwb_count ?? '';
// Parse meal data
$mealData = [];
if ($meal_type_daywise_price) {
    $mealData = json_decode($meal_type_daywise_price, true);
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
        if (isset($savedData['totals'])) {
            $savedActualExpenses['total_actual'] = $savedData['totals']['actual_total'] ?? 0;
            $savedActualExpenses['exchange_rate'] = $savedData['totals']['actual_exchange_rate'] ?? $exchangeRate;
            $savedActualExpenses['usd_actual'] = $savedData['totals']['actual_usd'] ?? 0;
        }
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

// Add items with unique IDs
if ($guideCosts && is_array($guideCosts)) {
    foreach ($guideCosts as $index => $guideDay) {
        $dayNumber = $guideDay['day'];
        $rate = ($guideDay['qty'] > 0 && $guideDay['total'] > 0) ? 
                $guideDay['total'] / $guideDay['qty'] : 0;
        
        $itemId = generateItemId('guide', $index);
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? $guideDay['qty'],
            'rate' => $savedRates[$itemId] ?? $rate,
            'total' => $savedActualExpenses[$itemId] ?? $guideDay['total'],
            'remarks' => $savedRemarks[$itemId] ?? ''
        ];
        
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
            $itemId,
            $savedData
        );
    }
}

if (empty($report->room_breakdown)) 
{
    // HOTEL COSTS - Handle both formats with separate rows for CNB/CWB
    $hotelCostTotal = 0;
    if ($hotel_cost && is_array($hotel_cost)) {
        $dayNumber = 0; 
        $hotelItems = []; // Store all hotel items separately
        
        $cnb = $report->cnb ?? '';
        $cnb_count = $report->cnb_count ?? '';
        $cwb = $report->cwb ?? '';
        $cwb_count = $report->cwb_count ?? '';
        
        foreach ($hotel_cost as $hotelCategory => $hotels) {
            foreach ($hotels as $hotelName => $roomData) {
                if (isset($roomData['hotel_id']) || isset($roomData['hotel_city'])) {
                    $total = 0;
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
                                    $cost = $cost * (int)$nights;
                                    
                                    // Add separate items for each occupancy type
                                    switch($occupancyType) {
                                        case 'Single Occupancy':
                                        case 'Double Occupancy': 
                                        case 'Triple Occupancy':
                                            $serviceName = "$hotelName ($occupancyType)";
                                            $frequency = $report->number_persons ?? 1;
                                            $totalCost = $cost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $cost,
                                                'total' => $totalCost,
                                                'type' => 'hotel_adult'
                                            ];
                                            $hotelCostTotal += $totalCost;
                                            break;
                                            
                                        case 'CNB Occupancy':
                                            if ($cnb > 0 && $cnb_count > 0) {
                                                $serviceName = "$hotelName (CNB Occupancy)";
                                                $frequency = $cnb_count;
                                                $totalCost = $cost * $frequency;
                                                
                                                $hotelItems[] = [
                                                    'name' => $serviceName,
                                                    'frequency' => $frequency,
                                                    'rate' => $cost,
                                                    'total' => $totalCost,
                                                    'type' => 'hotel_cnb'
                                                ];
                                                $hotelCostTotal += $totalCost;
                                            }
                                            break;
                                            
                                        case 'CWB Occupancy':
                                            if ($cwb > 0 && $cwb_count > 0) {
                                                $serviceName = "$hotelName (CWB Occupancy)";
                                                $frequency = $cwb_count;
                                                $totalCost = $cost * $frequency;
                                                
                                                $hotelItems[] = [
                                                    'name' => $serviceName,
                                                    'frequency' => $frequency,
                                                    'rate' => $cost,
                                                    'total' => $totalCost,
                                                    'type' => 'hotel_cwb'
                                                ];
                                                $hotelCostTotal += $totalCost;
                                            }
                                            break;
                                    }
                                }
                            }
                        }
                    }
                } else {
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
                                        $totalCost = $cost * $frequency;
                                        
                                        $hotelItems[] = [
                                            'name' => $serviceName,
                                            'frequency' => $frequency,
                                            'rate' => $cost,
                                            'total' => $totalCost,
                                            'type' => 'hotel_adult'
                                        ];
                                        $hotelCostTotal += $totalCost;
                                        break;
                                        
                                    case 'CNB Occupancy':
                                        if ($cnb > 0 && $cnb_count > 0) {
                                            $serviceName = "$hotelName (CNB Occupancy)";
                                            $frequency = $cnb_count;
                                            $totalCost = $cost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $cost,
                                                'total' => $totalCost,
                                                'type' => 'hotel_cnb'
                                            ];
                                            $hotelCostTotal += $totalCost;
                                        }
                                        break;
                                        
                                    case 'CWB Occupancy':
                                        if ($cwb > 0 && $cwb_count > 0) {
                                            $serviceName = "$hotelName (CWB Occupancy)";
                                            $frequency = $cwb_count;
                                            $totalCost = $cost * $frequency;
                                            
                                            $hotelItems[] = [
                                                'name' => $serviceName,
                                                'frequency' => $frequency,
                                                'rate' => $cost,
                                                'total' => $totalCost,
                                                'type' => 'hotel_cwb'
                                            ];
                                            $hotelCostTotal += $totalCost;
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
            $savedData = [
                'frequency' => $savedFrequencies[$itemId] ?? $item['frequency'],
                'rate' => $savedRates[$itemId] ?? $item['rate'],
                'total' => $savedActualExpenses[$itemId] ?? $item['total'],
                'remarks' => $savedRemarks[$itemId] ?? ''
            ];
            
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
                $itemId,
                $savedData
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
                                                $rate = $cost * $nightsCount; // Cost per room for all nights
                                                $total = $rate * $roomCount; 
                                            } else {
                                                $rate = $cost * $capacity ; // Cost per room for all nights (with capacity)
                                                $total = $rate * $roomCount;
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
                                            
                                            if ($markup_split == 'yes') {
                                                $rate = $cost * $nightsCount;
                                                $total = ($cost * $frequency) * $nightsCount;
                                            } else {
                                                $rate = $cost * $nightsCount;
                                                $total = ($cost * $frequency);
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
                                            
                                            if ($markup_split == 'yes') {
                                                $rate = $cost * $nightsCount;
                                                $total = ($cost * $frequency) * $nightsCount;
                                            } else {
                                                $rate = $cost * $nightsCount;
                                                $total = ($cost * $frequency);
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
            
            // Store original budget values
            $originalFrequency = $item['frequency'];
            $originalRate = $item['rate'];
            $originalTotal = $item['total'];
            
            // Get saved values if they exist
            $savedFrequency = isset($savedFrequencies[$itemId]) ? $savedFrequencies[$itemId] : $originalFrequency;
            $savedRate = isset($savedRates[$itemId]) ? $savedRates[$itemId] : $originalRate;
            $savedTotal = isset($savedActualExpenses[$itemId]) ? $savedActualExpenses[$itemId] : $originalTotal;
            $savedRemarks = isset($savedRemarks[$itemId]) ? $savedRemarks[$itemId] : '';
            
            // Check if any values have been changed by the user
            $hasChanges = false;
            if (isset($savedFrequencies[$itemId]) && $savedFrequencies[$itemId] != $originalFrequency) {
                $hasChanges = true;
            }
            if (isset($savedRates[$itemId]) && $savedRates[$itemId] != $originalRate) {
                $hasChanges = true;
            }
            if (isset($savedActualExpenses[$itemId]) && $savedActualExpenses[$itemId] != $originalTotal) {
                $hasChanges = true;
            }
            
            // Prepare saved data array with actual values
            $savedData = [
                'frequency' => $savedFrequency,
                'rate' => $savedRate,
                'total' => $savedTotal,
                'remarks' => $savedRemarks,
                'has_changes' => $hasChanges
            ];
            
            // Pass original budget values as parameters 4, 5, 6
            // The saved values will be used for actual_total in addItemToDate
            addItemToDate(
                $itemsByDate,
                $startDate,
                $dayNumber,
                $item['name'],
                $originalFrequency,  // Original budget frequency
                $originalRate,       // Original budget rate
                $originalTotal,      // Original budget total
                'hotel',
                '',
                $itemId,
                $savedData
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
        
        // Default to last day for most services
        $dayNumber = $lastDay;
        
        // Check for specific services that should be on first day
        if (strpos($serviceName, 'Refreshing napkins') !== false || 
            strpos($serviceName, 'chocolate inside the vehicle upon arrival') !== false) {
            $dayNumber = 0; // First day
        }
        
        $itemId = generateItemId('mandatory', $index);
        $savedData = [
            'frequency' => $savedFrequencies[$itemId] ?? $quantity,
            'rate' => $savedRates[$itemId] ?? $serviceRate,
            'total' => $savedActualExpenses[$itemId] ?? $totalCost,
            'remarks' => $savedRemarks[$itemId] ?? ''
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

if ($ticketCosts && is_array($ticketCosts)) {
    foreach ($ticketCosts as $groupIndex => $ticketGroup) {
        if (isset($ticketGroup['tickets']) && is_array($ticketGroup['tickets'])) {
            foreach ($ticketGroup['tickets'] as $ticketIndex => $ticket) {

                $dayNumber = isset($ticketGroup['day']) ? (int)$ticketGroup['day'] : 0;
                $dayNumber = max(0, $dayNumber - 1);

                // ✅ Individual - Adult
                if (isset($ticket['ticket_type']) && $ticket['ticket_type'] == 'individual') {

                    if (!empty($ticket['adult_count']) && $ticket['adult_count'] > 0) {

                        $itemId = generateItemId('ticket_adult', $groupIndex . '_' . $ticketIndex . '_adult');

                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $ticket['adult_count'],
                            'rate' => $savedRates[$itemId] ?? $ticket['price'],
                            'total' => $savedActualExpenses[$itemId] ?? ($ticket['adult_count'] * $ticket['price']),
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];

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
                            $itemId,
                            $savedData
                        );
                    }

                    // ✅ Individual - Child
                    if (!empty($ticket['child_count']) && $ticket['child_count'] > 0) {

                        $childPrice = isset($ticket['child_price']) ? $ticket['child_price'] : $ticket['price'];

                        $itemId = generateItemId('ticket_child', $groupIndex . '_' . $ticketIndex . '_child');

                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $ticket['child_count'],
                            'rate' => $savedRates[$itemId] ?? $childPrice,
                            'total' => $savedActualExpenses[$itemId] ?? ($ticket['child_count'] * $childPrice),
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];

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
                            $itemId,
                            $savedData
                        );
                    }
                }

                // ✅ NEW: Group Ticket
                if (isset($ticket['ticket_type']) && $ticket['ticket_type'] == 'group') {

                    if (!empty($ticket['group_count']) && $ticket['group_count'] > 0) {

                        $itemId = generateItemId('ticket_group', $groupIndex . '_' . $ticketIndex . '_group');

                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $ticket['group_count'],
                            'rate' => $savedRates[$itemId] ?? $ticket['price'],
                            'total' => $savedActualExpenses[$itemId] ?? ($ticket['group_count'] * $ticket['price']),
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];

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
                            $itemId,
                            $savedData
                        );
                    }
                }
            }
        }
    }
}

// ADD ACTIVITY COSTS HERE
$activityCostTotal = 0;
if ($activity_cost && is_array($activity_cost)) {
    if (isset($activity_cost['activity_data']) && is_array($activity_cost['activity_data'])) {
        foreach ($activity_cost['activity_data'] as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    
                    // Adult activity separate row
                    $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
                    if ($adultCount > 0) {
                        $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
                        $adultTotal = $adultPrice * $adultCount;
                        $activityCostTotal += $adultTotal;
                        
                        $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                            'rate' => $savedRates[$itemId] ?? $adultPrice,
                            'total' => $savedActualExpenses[$itemId] ?? $adultTotal,
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];
                        
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
                            $itemId,
                            $savedData
                        );
                    }
                    
                    // Child activity separate row
                    $childCount = isset($activity['child_count']) ? (int)$activity['child_count'] : 0;
                    if ($childCount > 0) {
                        $childPrice = isset($activity['child_price']) ? (float)$activity['child_price'] : 0;
                        $childTotal = $childPrice * $childCount;
                        $activityCostTotal += $childTotal;
                        
                        $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_child');
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                            'rate' => $savedRates[$itemId] ?? $childPrice,
                            'total' => $savedActualExpenses[$itemId] ?? $childTotal,
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];
                        
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
                            $itemId,
                            $savedData
                        );
                    }
                }
            }
        }
    }
    // Check if it's direct array structure
    elseif (isset($activity_cost[0]) && is_array($activity_cost[0])) {
        foreach ($activity_cost as $dayIndex => $dayData) {
            $dayNumber = isset($dayData['day']) ? (int)$dayData['day'] : 0;
            $dayNumber = max(0, $dayNumber - 1);
            
            if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                foreach ($dayData['activities'] as $activityIndex => $activity) {
                    $activityName = isset($activity['activity_name']) ? $activity['activity_name'] : 'Activity';
                    
                    // Adult activity separate row
                    $adultCount = isset($activity['adult_count']) ? (int)$activity['adult_count'] : 0;
                    if ($adultCount > 0) {
                        $adultPrice = isset($activity['adult_price']) ? (float)$activity['adult_price'] : 0;
                        $adultTotal = $adultPrice * $adultCount;
                        $activityCostTotal += $adultTotal;
                        
                        $itemId = generateItemId('activity_adult', $dayIndex . '_' . $activityIndex . '_adult');
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $adultCount,
                            'rate' => $savedRates[$itemId] ?? $adultPrice,
                            'total' => $savedActualExpenses[$itemId] ?? $adultTotal,
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];
                        
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
                            $itemId,
                            $savedData
                        );
                    }
                    
                    // Child activity separate row
                    $childCount = isset($activity['child_count']) ? (int)$activity['child_count'] : 0;
                    if ($childCount > 0) {
                        $childPrice = isset($activity['child_price']) ? (float)$activity['child_price'] : 0;
                        $childTotal = $childPrice * $childCount;
                        $activityCostTotal += $childTotal;
                        
                        $itemId = generateItemId('activity_child', $dayIndex . '_' . $activityIndex . '_child');
                        $savedData = [
                            'frequency' => $savedFrequencies[$itemId] ?? $childCount,
                            'rate' => $savedRates[$itemId] ?? $childPrice,
                            'total' => $savedActualExpenses[$itemId] ?? $childTotal,
                            'remarks' => $savedRemarks[$itemId] ?? ''
                        ];
                        
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
                            $itemId,
                            $savedData
                        );
                    }
                }
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
                    $serviceName .= " (Supplement " . number_format($parkingAmount, 0, '.', '') . ")";
                }
                
                $savedVehicleData = [
                    'frequency' => $savedFrequencies[$vehicleItemId] ?? $qty,
                    'rate' => $savedRates[$vehicleItemId] ?? $price,
                    'total' => $savedActualExpenses[$vehicleItemId] ?? ($price * $qty),
                    'remarks' => $savedRemarks[$vehicleItemId] ?? ''
                ];
                
                $outsideCostByDate[$actualDayNumber][] = [
                    'service' => $serviceName . " (Supplement)",
                    'frequency' => $savedVehicleData['frequency'],
                    'rate' => $savedVehicleData['rate'],
                    'total' => $price * $qty,
                    'actual_total' => $savedVehicleData['total'],
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
                        'rate' => $savedTollData['rate'],
                        'total' => $tollAmount,
                        'actual_total' => $savedTollData['total'],
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

// Sort by date
ksort($itemsByDate);

// Add meal costs to itemsByDate - पुराने लॉजिक के अनुसार
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
                $savedData = [
                    'frequency' => $savedFrequencies[$itemId] ?? $totalPersons,
                    'rate' => $savedRates[$itemId] ?? $price,
                    'total' => $savedActualExpenses[$itemId] ?? $mealTotal,
                    'remarks' => $savedRemarks[$itemId] ?? ''
                ];
                
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
                    $itemId,
                    $savedData
                );
            }
        }
    }
}

// Recalculate subtotal with meals included
$subtotal = 0;
$actualSubtotal = 0;
foreach ($itemsByDate as $dateData) {
    foreach ($dateData['items'] as $item) {
        $subtotal += $item['total'];
        $actualSubtotal += $item['actual_total'];
    }
}

$bundlePriceRemark = '';
if (!empty($vehicleNames)) {
    $bundlePriceRemark = implode(', ', $vehicleNames);
}

// Calculate net bundle price (after subtracting outside cost) - पुराने लॉजिक के अनुसार
$netBundlePrice = ($totalTransport - $discount_bundle_price) - $outsideCostTotal;
if ($netBundlePrice < 0) {
    $netBundlePrice = 0;
}

// Get saved bundle price data
$savedBundleTotal = $savedActualExpenses['bundle_price'] ?? $netBundlePrice;
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
        <tr <?php echo $rowBgColor; ?> data-item-id="<?php echo $item['item_id']; ?>" data-date-key="<?php echo $dateKey; ?>">
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
                    <?php echo htmlspecialchars($item['service']); ?>
                <?php else: ?>
                    <?php echo htmlspecialchars($item['service']); ?>
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
                    $rateValue = number_format($rateParts[0], 0, '.', '');
                    if (isset($rateParts[1]) && $rateParts[1] > 0) {
                        $rateValue .= '/' . number_format($rateParts[1], 0, '.', '');
                    }
                } else {
                    $rateValue = number_format($item['rate'], 0, '.', '');
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
                <?php echo number_format($item['total'], 0, '.', ''); ?>
            </td>
            
            <td style="background-color: #eccdccff;">
                <input type="text" 
                       class="actual-expense-input" 
                       data-item-id="<?php echo $item['item_id']; ?>" 
                       value="<?php echo number_format($item['actual_total'], 0, '.', ''); ?>" 
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
            <td style="font-weight: bold;">Additional / On‑Ground Services</td>
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
                       value="<?php echo number_format($savedAdditionalRate, 0, '.', ''); ?>" 
                       readonly
                       onchange="updateAdditionalTransfersTotal()">
            </td>
            <td style="background-color: #eccdccff;" id="additional-transfers-budget-total">0</td>
            <td style="background-color: #eccdccff;">
                <input type="text" 
                       id="additional-transfers-actual-expense" 
                       value="<?php echo number_format($savedAdditionalTotal, 0, '.', ''); ?>" 
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
            <td style="font-weight: 800;background-color: #FFC000 !important;">Bundle Price</td>
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
                       value="<?php echo number_format($savedBundleTotal, 0, '.', ''); ?>" 
                       readonly
                       onchange="updateBundleTotal()">
            </td>
            <td style="background-color: #eccdccff;" id="bundle-budget-total">
                <?php echo number_format($netBundlePrice, 0, '.', ''); ?>
            </td>
            <td style="background-color: #eccdccff;">
                <input type="text" 
                       id="bundle-actual-expense" 
                       value="<?php echo number_format($savedBundleTotal, 0, '.', ''); ?>" 
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
            <td id="total-budget-amount"><?php echo number_format($finalTotal, 0, '.', ''); ?></td>
            <td>
                <input type="text" id="total-actual-expense" value="<?php echo number_format($finalActualTotal, 0, '.', ''); ?>" readonly>
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
            <td id="usd-budget-amount"><?php echo number_format($usdAmount, 0, '.', ''); ?></td>
            <td>
                <input type="text" id="usd-actual-expense" value="<?php echo number_format($savedUSDAmount, 0, '.', ''); ?>" readonly>
            </td>
            <td></td>
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
<div class="no-print text-center" style="margin-bottom: 60px; margin-top: 30px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="d-flex align-items-center justify-content-center gap-1">
                <select id="final-selection" onchange="handleFinalSelectionChange(this)" class="form-control" style="flex: 1; max-width: 200px;">
                    <option value="no_change" <?php echo ($savedTotalSelection == 'no_change') ? 'selected' : ''; ?>>No Change</option>
                    <option value="change" <?php echo ($savedTotalSelection == 'change') ? 'selected' : ''; ?>>Change</option>
                </select>
                <button class="btn btn-primary" onclick="updateAllChanges()" style="margin-top: -55px !important;">UPDATE</button>&nbsp;&nbsp;
                <button onclick="window.close()" class="btn btn-danger"style="margin-top: -55px !important;"><i class="glyphicon glyphicon-remove"></i> Close</button>
            </div>
        </div>  
    </div>
</div>

<script>
// Store original values for comparison
let originalValues = {};
let changedSelections = new Set(); // Track which selections have been changed

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check all selections and enable/disable inputs accordingly
    initializeSavedSelections();
    
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
    
    actualInput.value = Math.round(total);
    
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
    
    actualInput.value = Math.round(total);
    
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
    
    actualInput.value = Math.round(total);
    
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
    
    actualInput.value = Math.round(total);
    
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
    
    // Update total actual expense input
    const totalActualInput = document.getElementById('total-actual-expense');
    if (totalActualInput) {
        totalActualInput.value = Math.round(totalActualExpense);
    }
    
    // Update USD calculation
    updateUSDCalculation();
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
        usdBudgetEl.textContent = Math.round(budgetUSDAmount);
    }
    
    // Update actual USD
    if (exchangeRate > 0) {
        const usdAmount = totalAmount / exchangeRate;
        usdActualInput.value = Math.round(usdAmount);
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
    return Math.round(budgetNum - actualNum);
}

// Calculate margin percentage
function calculateMarginPercentage(budget, actual) {
    const budgetNum = parseFloat(budget) || 0;
    const actualNum = parseFloat(actual) || 0;
    if (budgetNum === 0) return 0;
    return ((budgetNum - actualNum) / budgetNum * 100).toFixed(2);
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


    <!-- <div class="no-print text-center " style="margin-bottom: 60px;margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Report</button>
        
    </div>   -->

    <script>
        
    </script>
</body>
</html>