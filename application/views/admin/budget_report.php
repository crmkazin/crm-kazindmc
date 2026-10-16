<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Report</title>
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
</head>
<body>

    <div class="header-section">
        <div class="main-title">BUDGET REPORT | <?php echo date('d M Y', strtotime($enquiry->check_in_date)); ?> - <?php echo date('d M Y', strtotime($enquiry->check_out_date)); ?></div>
        <div class="sub-title">
            <?php 
            $company_name = '';
            if (!empty($enquiry->company_id)) {
                $company = $this->db
                    ->select('name')
                    ->from('company')
                    ->where('company_id', $enquiry->company_id)
                    ->get()
                    ->row();

                if (!empty($company->name)) {
                    $company_name = $company->name;
                }
            }
            echo $company_name ; ?> - <?php echo $enquiry->enquiry_no ?? ''; ?>
        </div>
        <div class="sub-title">Person - <?php echo $total_persons; ?></div>
    </div>

    <!-- <table class="budget-report" style="margin-bottom:50px;" >
    <thead>
        <tr>
            <th width="10%">#</th>
            <th width="50%">Hotel</th>
            <th width="20%">No Of Nights</th>
            <th width="20%">Price</th>
        </tr>
    </thead>
    <tbody>
       <?php 
            $index = 1;
            foreach ($hotels as $hotel) {
                $hotel_name = $hotel['hotel_name'];
                $nights_count = $hotel['night_count'];
                $hotel_total_price = $hotel['hotel_total_price'];
            ?>
                <tr>
                    <td><?= $index ?></td>
                    <td><?= htmlspecialchars($hotel_name) ?></td>
                    <td><?= $nights_count ?></td>
                    <td><?= $hotel_total_price; ?></td>
                </tr>
            <?php 
                $index++;
            }
        ?>
    </tbody>
</table>  -->


    <table class="budget-report" style="border:2px solid #000000ff;">
        <thead>
            <tr>
                <th colspan="4" style="background-color: #FF7C80;"></th>
                <th style="background-color: #FF7C80;">BUDGET</th>
                <th style="background-color: #FF7C80;">ACTUAL EXPENSE</th>
                <th style="background-color: #FF7C80;"></th>
            </tr>
            <tr>
                <th style="background-color: #E6B8B7;">DATE</th>
                <th style="background-color: #E6B8B7;">SERVICES</th>
                <th style="background-color: #E6B8B7;">FREQUENCY</th>
                <th style="background-color: #E6B8B7;">RATE IN <?php echo $currency_abbr ?? 'KZT'; ?></th>
                <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr ?? 'KZT'; ?></th>
                <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr ?? 'KZT'; ?></th>
                <th style="background-color: #E6B8B7;">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $checkInDate = new DateTime($enquiry->check_in_date);
                $checkOutDate = new DateTime($enquiry->check_out_date);
                $currentDate = clone $checkInDate;
                $totalDays = $checkOutDate->diff($checkInDate)->days + 1;
                $mandatory_services = $mandatory_data;
                
                // Variables to calculate totals
                $total_kzt = 0;
                $exchange_rate = $currency ?? 0;
                $all_services = [];
                
                // Parse vehicless data for transportation
                $vehicless_data = json_decode($vehicless, true);
                $vehicle_names = [];
                $total_vehicle_quantity = 0;
                $vehicle_quantities_display = '';
                
                if (!empty($vehicless_data) && is_array($vehicless_data)) {
                    $quantity_array = [];
                    foreach ($vehicless_data as $vehicle) {
                        $vehicle_id = $vehicle['vehicle_id'] ?? '';
                        $quantity = $vehicle['qnty'] ?? 0;
                        
                        // Fetch vehicle name
                        $vehicle_name = '';
                        if (!empty($vehicle_id)) {
                            $where = "id = '" . $this->db->escape_str($vehicle_id) . "'";
                            $vehicle_data = $this->common_model->get_data('transportation', '', '', '*', $where, '', false);
                            
                            if (!empty($vehicle_data)) {
                                $vehicle_name = $vehicle_data[0]->vehicle_name ?? 'Vehicle ' . $vehicle_id;
                            } else {
                                $vehicle_name = 'Vehicle ' . $vehicle_id;
                            }
                        }
                        
                        $vehicle_names[] = $vehicle_name;
                        $quantity_array[] = $quantity;
                        $total_vehicle_quantity += (int)$quantity;
                    }
                    
                    $vehicle_names_display = implode(', ', $vehicle_names);
                    $vehicle_quantities_display = implode(', ', $quantity_array);
                } else {
                    $vehicle_names_display = 'No vehicles';
                    $vehicle_quantities_display = '';
                }

            ?>
            <?php for ($i = 0; $i < $totalDays; $i++): ?>
                <?php 
                    $displayDate = $currentDate->format('j-M');
                    $dayServices = [];

                    // Add ALL hotels only on first day with their separate costs
                    if ($i == 0) {
                        foreach ($hotels as $hotel) {
                            $hotel_name = $hotel['hotel_name'];
                            $hotel_total_price = $hotel['hotel_total_price'];
                            
                            if ($hotel_total_price > 0) {
                                $dayServices[] = [
                                    'services' => $hotel_name,
                                    'qty' => 1,
                                    'price' => $hotel_total_price,
                                    'total' => $hotel_total_price
                                ];
                                // Add to total calculation
                                $total_kzt += $hotel_total_price;
                            }
                        }
                    }

                    if (!empty($guideTotals[$i])) {
                        $guideData = $guideTotals[$i];
                        if (!isset($guideData['empty']) || $guideData['empty'] !== true) {
                            if (($guideData['price'] !== 'no charge' && $guideData['price'] !== '0' && !empty($guideData['price'])) || 
                                ($guideData['qty'] !== '0' && !empty($guideData['qty']))) {
                                $guide_price = is_numeric($guideData['price']) ? $guideData['price'] : 0;
                                $guide_qty = is_numeric($guideData['qty']) ? $guideData['qty'] : 0;
                                $guide_total = $guide_price * $guide_qty;
                                
                                $dayServices[] = $guideTotals[$i];
                                // Add to total calculation
                                $total_kzt += $guide_total;
                            }
                        }
                    }
                    
                    // Ticket totals को handle करने के लिए
                    if (!empty($ticket_totals[$i])) {
                        // Check if it's an array of tickets or single ticket
                        if (isset($ticket_totals[$i][0]) && is_array($ticket_totals[$i][0])) {
                            // Multiple tickets for this day
                            foreach ($ticket_totals[$i] as $ticket) {
                                if (!isset($ticket['empty']) || $ticket['empty'] !== true) {
                                    if (!empty($ticket['services']) && $ticket['services'] !== '') {
                                        $ticket_price = is_numeric($ticket['price']) ? $ticket['price'] : 0;
                                        $ticket_qty = is_numeric($ticket['qty']) ? $ticket['qty'] : 0;
                                        $ticket_total = is_numeric($ticket['total']) ? $ticket['total'] : 0;
                                        
                                        // Check ticket type
                                        $is_group = isset($ticket['is_group']) ? $ticket['is_group'] : false;
                                        $ticket_type = isset($ticket['ticket_type']) ? $ticket['ticket_type'] : '';
                                        
                                        $service_name = $ticket['services'];
                                        
                                        $dayServices[] = [
                                            'services' => $service_name,
                                            'qty' => $ticket_qty,
                                            'price' => $ticket_price,
                                            'total' => $ticket_total,
                                            'is_group' => $is_group,
                                            'ticket_type' => $ticket_type,
                                            'includes_guide' => isset($ticket['includes_guide']) ? $ticket['includes_guide'] : false
                                        ];
                                        
                                        // Add to total calculation
                                        $total_kzt += $ticket_total;
                                    }
                                }
                            }
                        } else {
                            // Single ticket for this day (old format)
                            $ticketData = $ticket_totals[$i];
                            if (!isset($ticketData['empty']) || $ticketData['empty'] !== true) {
                                if (!empty($ticketData['services']) && $ticketData['services'] !== '') {
                                    $ticket_price = is_numeric($ticketData['price']) ? $ticketData['price'] : 0;
                                    $ticket_qty = is_numeric($ticketData['qty']) ? $ticketData['qty'] : 0;
                                    $ticket_total = is_numeric($ticketData['total']) ? $ticketData['total'] : 0;
                                    
                                    $dayServices[] = [
                                        'services' => $ticketData['services'],
                                        'qty' => $ticket_qty,
                                        'price' => $ticket_price,
                                        'total' => $ticket_total
                                    ];
                                    
                                    // Add to total calculation
                                    $total_kzt += $ticket_total;
                                }
                            }
                        }
                    }
                    
                    // Add mandatory services and calculate totals
                    if ($i == 0) {
                        if (!empty($mandatory_services[2])) {
                            $mandatory = $mandatory_services[2];
                            $mandatory_price = is_numeric($mandatory['price']) ? $mandatory['price'] : 0;
                            $mandatory_qty = is_numeric($mandatory['qty']) ? $mandatory['qty'] : 0;
                            $mandatory_total = $mandatory_price * $mandatory_qty;
                            
                            $dayServices[] = $mandatory_services[2];
                            // Add to total calculation
                            $total_kzt += $mandatory_total;
                        }
                    } elseif ($i == $totalDays - 1) {
                        for ($m = 0; $m < count($mandatory_services); $m++) {
                            if($m == 2) continue;
                            if (!empty($mandatory_services[$m])) {
                                $mandatory = $mandatory_services[$m];
                                $mandatory_price = is_numeric($mandatory['price']) ? $mandatory['price'] : 0;
                                $mandatory_qty = is_numeric($mandatory['qty']) ? $mandatory['qty'] : 0;
                                $mandatory_total = $mandatory_price * $mandatory_qty;
                                
                                $dayServices[] = $mandatory_services[$m];
                                // Add to total calculation
                                $total_kzt += $mandatory_total;
                            }
                        }
                    }
                    
                    // Store all services for this day
                    if (!empty($dayServices)) {
                        $all_services[$i] = [
                            'date' => $displayDate,
                            'services' => $dayServices
                        ];
                    }
                    
                    $currentDate->modify('+1 day');
                ?>
            <?php endfor; ?>
            
            <?php
                // Display all services
                $day_counter = 0;
                $total_days_count = count($all_services);
                foreach ($all_services as $i => $dayData):
                    $dayServices = $dayData['services'];
                    $displayDate = $dayData['date'];
                    
                    if (!empty($dayServices)):
                        $rowspan = count($dayServices);
                        foreach ($dayServices as $index => $service):
                            $service_name = $service['services'] ?? '';
                            $qty = $service['qty'] ?? 0;
                            $rate = $service['price'] ?? 0;
                            $service_total = ($rate === 'no charge' || $rate === '' || $qty == 0) ? 0 : ($rate * $qty);
            ?>
                <tr>
                    <?php if ($index == 0): ?>
                        <td rowspan="<?= $rowspan; ?>" style="background-color: #eeeeeeff;font-weight:bold; text-align:center;"><?= $displayDate; ?></td>
                    <?php endif; ?>
                    <td style="background-color: #eeeeeeff;"><?= htmlspecialchars($service_name); ?></td>
                    <td style="background-color: #eeeeeeff;"><?= htmlspecialchars($qty); ?></td>
                    <td style="background-color: #eeeeeeff;">
                        <?php if (($rate === 'no charge' || $rate === '') || $qty == 0) {
                                echo '0';
                            }else{
                                echo $rate; 
                            }?>
                    </td>
                    <td style="background-color: #eccdccff;">
                        <?php
                            if (($rate === 'no charge' || $rate === '') || $qty == 0) {
                                echo '0';
                            } else {
                                echo $service_total;
                            }
                        ?>
                    </td>
                    <td style="background-color: #eccdccff;">
                        <?= isset($service['empty']) && $service['empty'] ? '<i>Empty</i>' : ''; ?>
                    </td>
                    <td style="background-color: #eeeeeeff;">   </td>
                </tr> 
                
            <?php 
                        endforeach;
                        $day_counter++;
                        if ($day_counter < $total_days_count) {
            ?>
                            <tr style="height: 20px;">
                                <td colspan="7" style="background-color: #e0e0e0ff;"></td>
                            </tr>
            <?php
                        }
                    endif;
                endforeach;
                
    
                $luggage_vehicle_name = '';
                $luggage_vehicle_qty = 0;
                $luggage_total = 0;

                if (!empty($luggage_vehicle)) {
                    $parts = explode('__', $luggage_vehicle);
                    
                    if (count($parts) >= 3) {
                        $luggage_vehicle_name = $parts[0] ?? '';
                        $luggage_vehicle_qty = (int)$parts[2] ?? 0;
                    } elseif (count($parts) == 1) {
                        $luggage_vehicle_name = $luggage_vehicle;
                        $luggage_vehicle_qty = 1;
                    }
                }

                $all_day_luggage_total_num = (float)$all_day_luggage_total;
                $luggage_total = (float)$luggage_vehicle_qty * $all_day_luggage_total_num;

                $outside_cost_json = $outside_cost;
                $outside_cost_total = 0;
                $outside_cost_details = [];

                if (!empty($outside_cost_json)) {
                    $outside_data = json_decode($outside_cost_json, true);
                    
                    if (is_array($outside_data)) {
                        foreach ($outside_data as $day_data) {
                            if (isset($day_data['vehicles']) && is_array($day_data['vehicles'])) {
                                foreach ($day_data['vehicles'] as $vehicle) {
                                    $vehicle_name = isset($vehicle['vehicle_name']) ? trim($vehicle['vehicle_name']) : 'Unknown Vehicle';
                                    $price = isset($vehicle['price']) ? (float)$vehicle['price'] : 0;
                                    $toll = isset($vehicle['toll']) ? (float)$vehicle['toll'] : 0;
                                    $parking = isset($vehicle['parking']) ? (float)$vehicle['parking'] : 0;
                                    $qty = isset($vehicle['qty']) ? (int)$vehicle['qty'] : 1;
                                    $total = isset($vehicle['total']) ? (float)$vehicle['total'] : $price;
                                    $sitescene = isset($vehicle['sitescene']) ? $vehicle['sitescene'] : '';
                                    
                                
                                    $outside_cost_total += $total + ($toll * $qty); 
                                    
                                    $outside_cost_details[] = [
                                        'vehicle_name' => $vehicle_name,
                                        'price' => $price,
                                        'toll' => $toll,
                                        'parking' => $parking,
                                        'qty' => $qty,
                                        'total_without_toll' => $total, 
                                        'total_with_toll' => $total + ($toll * $qty),
                                        'sitescene' => $sitescene,
                                    ];
                                }
                            }
                        }
                    }
                }

                    $final_transport_numeric = (float)$final_transport- $outside_cost_total;
                    $transport_total = 0;
                    if ($final_transport_numeric > 0 && $total_vehicle_quantity > 0) {
                        $transport_total = $final_transport_numeric * $total_vehicle_quantity;
                    }
          
                $net_bundle_total = $transport_total; 
                $total_kzt += $net_bundle_total; 
                $total_kzt += $outside_cost_total; 

                $usd_amount = 0;
                if ($exchange_rate > 0) {
                    $usd_amount = round($total_kzt / $exchange_rate, 2);
                }
           
            ?>

            <tr>
                <th></th>
                <td style="background-color: #eeeeeeff;font-weight: bold;">Additional Transfers</td>
                <td style="background-color: #eeeeeeff;">0</td>
                <td style="background-color: #eeeeeeff;">0</td>
                <td style="background-color: #eccdccff;">0</td>
                <td style="background-color: #eccdccff;"></td>
                <td style="background-color: #eeeeeeff;"></td>
            </tr>

            <tr style="background-color: #eeeeeeff;">
                <th></th>
                <td style="font-weight: bold;background-color: #FFC000 !important;">Bundle Price (Incl.3%)</td>
                <td><?= htmlspecialchars($vehicle_quantities_display); ?></td>
                <td><?= $final_transport_numeric; ?></td>
                <td style="background-color: #eccdccff;"><?= $net_bundle_total; ?></td>
                <td style="background-color: #eccdccff;"></td>
                <td><?= htmlspecialchars($vehicle_names_display); ?></td>
            </tr>


            <!-- Alternative: Detailed outside cost display -->
            <?php if (!empty($outside_cost_details)): ?>
                <?php foreach ($outside_cost_details as $detail): ?>
                <tr style="background-color: #f9f9f9;">
                    <th></th>
                    <td style="font-weight: bold;background-color:#FFC000 !important;"><?= $detail['sitescene']; ?></td>
                    <td style="background-color: #eeeeeeff;"><?= $detail['qty']; ?></td>
                    <td style="background-color: #eeeeeeff;">
                        <?php 
                        $rate_per_vehicle = $detail['price'] + $detail['toll'];
                        echo $rate_per_vehicle;
                        ?>
                    </td>
                    <td style="background-color: #eccdccff;">
                        <?php 
                        echo $detail['total_with_toll'];
                        ?>
                    </td>
                    <td style="background-color: #eccdccff;"></td>
                    <td style="background-color: #eeeeeeff;">
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Empty row before totals -->
            <tr style="height:20px;background-color: #e0e0e0ff;">
                <td colspan="7"></td>
            </tr>

            <!-- TOTAL AMOUNT IN KZT -->
            <tr style="background-color: #eeeeeeff;">
                <td colspan="4">TOTAL AMOUNT IN <?php echo $currency_abbr ?? 'KZT'; ?></td>
                <td style="font-weight: bold;background-color: #FF7C80;"><?php echo $total_kzt; ?></td>
                <td style="background-color: #FF7C80;"></td>
                <td></td>
            </tr>
            
            <!-- EXCHANGE RATE -->
            <tr style="background-color: #eeeeeeff;">
                <td colspan="4">EXCHANGE RATE</td>
                <td style="font-weight: bold;background-color: #FF7C80;"><?php echo $exchange_rate; ?></td>
                <td style="background-color: #FF7C80;"></td>
                <td></td>
            </tr>
            
            <!-- AMOUNT IN USD -->
            <tr style="background-color: #c4c4c4ff !important;">
                <td style="font-weight: bold;" colspan="4">AMOUNT IN USD</td>
                <td style="font-weight: bold;"><?php echo number_format($usd_amount, 0); ?></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

        

    <div style="margin-top: 30px; font-size: 12px; color: #7f8c8d;">
        <p>Generated on: <?php echo date('d M Y H:i:s'); ?></p>
        <p>Prepared by: <?php echo $form['agent_name'] ?? 'System'; ?></p>
    </div>

    <div class="no-print text-center" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Report</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Close</button>
    </div>  
</body>
</html>