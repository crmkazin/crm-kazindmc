<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Final Budget Report - <?php echo $report->enquiry_no ?? ''; ?></title>
    <!-- Add html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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
            margin-bottom: 14px;
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
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        .saved-info {
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .actual-expense-col {
            background-color: #fffacd !important;
        }
        .budget-expense-col {
            background-color: #eccdccff !important;
        }
        .date-gap-row {
            height: 15px;
            background-color: #f5f5f5;
        }
        .outside-section {
            font-weight: bold;
        }
        .margin-positive {
            color: #28a745;
            font-weight: bold;
        }
        .margin-negative {
            color: #dc3545;
            font-weight: bold;
        }
        .no-print {
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .debug-info {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-family: monospace;
            font-size: 12px;
            max-height: 200px;
            overflow-y: auto;
        }
        .card {
            margin: 1% 10%;
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
        }
        body{
            background-color: #ededed;
        }
        /* Loading overlay */
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
        }
        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <h4>Generating PDF...</h4>
            <p>Please wait while we generate your budget report.</p>
        </div>
    </div>

    <div class="card">
        <div class="header-section">
            <div class="main-title text-center">FINAL BUDGET REPORT | <?php echo date('d M Y', strtotime($report->check_in_date)); ?> - <?php echo date('d M Y', strtotime($report->check_out_date)); ?></div>
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
        if ($saved_data):
            
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
                $currency_abbr = '';
            }
        ?>

        <table class="budget-report" style="border:2px solid #000000ff;">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #FF7C80;"></th>
                    <th style="background-color: #FF7C80;">ORIGINAL BUDGET</th>
                    <th style="background-color: #FF7C80;">CLOSING BUDGET</th>
                    <th style="background-color: #FF7C80;"></th>
                </tr>
                <tr>
                    <th style="background-color: #E6B8B7;">DATE</th>
                    <th style="background-color: #E6B8B7;">SERVICES</th>
                    <th style="background-color: #E6B8B7;">FREQUENCY</th>
                    <th style="background-color: #E6B8B7;white-space: nowrap;">RATE IN <?php echo $currency_abbr; ?></th>
                    <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr; ?></th>
                    <th style="background-color: #E6B8B7;">TOTAL IN <?php echo $currency_abbr; ?></th>
                    <th style="background-color: #E6B8B7;min-width:300px;">REMARKS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Group items by date
                $groupedByDate = [];
                foreach ($saved_data['date_items'] as $item) {
                    $dateKey = $item['date_key'] ?? '';
                    if (!isset($groupedByDate[$dateKey])) {
                        $groupedByDate[$dateKey] = [];
                    }
                    $groupedByDate[$dateKey][] = $item;
                }
                
                // Sort dates
                ksort($groupedByDate);
                
                $previousDateKey = null;
                $dateCounter = 0;
                
                foreach ($groupedByDate as $dateKey => $items):
                    // Add gap between different dates
                    if ($previousDateKey !== null && $dateCounter > 0) {
                        echo '<tr class="date-gap-row">';
                        echo '<td colspan="7"></td>';
                        echo '</tr>';
                    }
                    
                    $dateDisplay = date('d M', strtotime($dateKey));
                    $rowspan = count($items);
                    
                    foreach ($items as $index => $item):
                        // Get service name from saved data - FIXED LOGIC
                        $serviceName = $item['service'] ?? '';
                        
                        // If service name is still empty after checking saved data
                        if (empty(trim($serviceName))) {
                            // Try to determine service name from item_id
                            $itemId = $item['item_id'] ?? '';
                            
                            if (strpos($itemId, 'guide_') === 0) {
                                $serviceName = 'Day Guide';
                            } elseif (strpos($itemId, 'hotel_') === 0) {
                                $serviceName = 'Hotel';
                            } elseif (strpos($itemId, 'ticket_') === 0) {
                                $serviceName = 'Ticket';
                            } elseif (strpos($itemId, 'mandatory_') === 0) {
                                $serviceName = 'Mandatory Service';
                            } elseif (strpos($itemId, 'activity_') === 0) {
                                $serviceName = 'Activity';
                            } else {
                                $serviceName = 'Service'; // Default fallback
                            }
                        }
                        
                        // Set background color based on item type
                        $bgColor = '';
                        $rowBgColor = '';
                        $itemId = $item['item_id'] ?? '';
                        if (strpos($itemId, 'activity_') === 0) {
                            // $bgColor = 'style="background-color: #eff8ebff;"';
                            // $rowBgColor = 'style="background-color: #ffffffff;"';
                        } elseif (strpos($itemId, 'hotel_') === 0) {
                            // $bgColor = 'style="background-color: #fff8f8ff;"';
                            // $rowBgColor = 'style="background-color: #ffffffff;"';
                        }
                        
                        // Check if this item was changed
                        $itemChanged = $item['selection_changed'] ?? false;
                        $itemStatus = $itemChanged ? '<span style="color: #28a545; font-size: 11px;">✓ Changed</span>' : '';
                ?>
                <tr <?php echo $rowBgColor; ?>>
                    <?php if ($index === 0): ?>
                    <td rowspan="<?php echo $rowspan; ?>" style="vertical-align: top;white-space: nowrap;">
                        <b><?php echo htmlspecialchars($dateDisplay); ?></b>
                    </td>
                    <?php endif; ?>
                    
                    <td <?php echo $bgColor; ?>>
                        <?php echo htmlspecialchars($serviceName); ?>
                    </td>
                    
                    <td <?php echo $bgColor; ?>>
                        <?php echo htmlspecialchars($item['actual_frequency'] ?? '0'); ?>
                    </td>
                    
                    <td <?php echo $bgColor; ?>>
                        <?php echo number_format($item['actual_rate'] ?? 0, 2, '.', ''); ?>
                    </td>
                    
                    <td style="background-color: #eccdccff;" class="budget-expense-col">
                        <?php echo number_format($item['budget_total'] ?? 0, 2, '.', ''); ?>
                    </td>
                    
                    <td style="background-color: #eccdccff;" class="actual-expense-col">
                        <?php echo number_format($item['actual_total'] ?? 0, 2, '.', ''); ?>
                    </td>
                    
                    <td <?php echo $bgColor; ?>>
                        <?php echo htmlspecialchars($item['remarks'] ?? ''); ?>
                    </td>
                </tr>
                <?php
                    endforeach;
                    $previousDateKey = $dateKey;
                    $dateCounter++;
                endforeach;
                ?>

                <!-- Additional Transfers -->
                <?php 
                $addTransfers = $saved_data['additional_transfers'] ?? [];
                $addTransfersService = $addTransfers['service'] ?? 'Additional Transfers';
                ?>
                
                <tr class="outside-section">
                    <td></td>
                    <td style="font-weight: bold;"><?php echo htmlspecialchars($addTransfersService); ?></td>
                    <td><?php echo htmlspecialchars($addTransfers['actual_frequency'] ?? '0'); ?></td>
                    <td><?php echo number_format($addTransfers['actual_rate'] ?? 0, 2, '.', ''); ?></td>
                    <td class="budget-expense-col"><?php echo number_format($addTransfers['budget_total'] ?? 0, 2, '.', ''); ?></td>
                    <td class="actual-expense-col">
                        <?php echo number_format($addTransfers['actual_total'] ?? 0, 2, '.', ''); ?>
                    </td>
                    <td><?php echo htmlspecialchars($addTransfers['remarks'] ?? ''); ?></td>
                </tr>

                <!-- Bundle Price -->
                <?php if (!empty($saved_data['bundle_price'])): 
                    $bundle = $saved_data['bundle_price'];
                    $bundleService = $bundle['service'] ?? 'Bundle Price (Transport Uses)';
                ?>
                <tr class="outside-section">
                    <td></td>
                    <td style="font-weight: 800;background-color: #FFC000 !important;"><?php echo htmlspecialchars($bundleService); ?></td>
                    <td><?php echo htmlspecialchars($bundle['actual_frequency'] ?? '1'); ?></td>
                    <td><?php echo number_format($bundle['actual_rate'] ?? 0, 2, '.', ''); ?></td>
                    <td class="budget-expense-col"><?php echo number_format($bundle['budget_total'] ?? 0, 2, '.', ''); ?></td>
                    <td class="actual-expense-col">
                        <?php echo number_format($bundle['actual_total'] ?? 0, 2, '.', ''); ?>
                    </td>
                    <td><?php echo htmlspecialchars($bundle['remarks'] ?? ''); ?></td>
                </tr>
                <?php endif; ?>

                <!-- Outside Costs -->
                <?php if (!empty($saved_data['outside_costs'])): ?>
                    <?php foreach ($saved_data['outside_costs'] as $outsideItem): 
                        $outsideService = $outsideItem['service'] ?? 'Outside Service';
                    ?>
                    <tr class="outside-section">
                        <td></td>
                        <td style="font-weight: bold;background-color: #FFC000 !important;"><?php echo htmlspecialchars($outsideService); ?></td>
                        <td><?php echo htmlspecialchars($outsideItem['actual_frequency'] ?? '0'); ?></td>
                        <td><?php echo number_format($outsideItem['actual_rate'] ?? 0, 2, '.', ''); ?></td>
                        <td class="budget-expense-col"><?php echo number_format($outsideItem['budget_total'] ?? 0, 2, '.', ''); ?></td>
                        <td class="actual-expense-col">
                            <?php echo number_format($outsideItem['actual_total'] ?? 0, 2, '.', ''); ?>
                        </td>
                        <td><?php echo htmlspecialchars($outsideItem['remarks'] ?? ''); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Gap before totals -->
                <tr class="date-gap-row">
                    <td colspan="7"></td>
                </tr>

                <!-- Total Amount -->
                <tr style="font-weight: bold; background-color: #FFE4E1;">
                    <td colspan="4" style="text-align: right;">TOTAL AMOUNT IN (<?php echo $currency_abbr; ?>)</td>
                    <td id="total-budget-amount"><?php echo number_format($saved_data['totals']['budget_total'] ?? 0, 2, '.', ''); ?></td>
                    <td id="total-actual-expense">
                        <?php echo number_format($saved_data['totals']['actual_total'] ?? 0, 2, '.', ''); ?>
                    </td>
                    <td></td>
                </tr>

                <!-- Exchange Rate -->
                <tr style="font-weight: bold;">
                    <td colspan="4" style="text-align: right;">EXCHANGE RATE ROE</td>
                    <td id="original-exchange-rate"><?php echo number_format($saved_data['totals']['original_exchange_rate'] ?? 0, 2, '.', ''); ?></td>
                    <td id="exchange-rate-input">
                        <?php echo number_format($saved_data['totals']['actual_exchange_rate'] ?? 0, 2, '.', ''); ?>
                    </td>
                    <td></td>
                </tr>

                <!-- Amount in USD -->
                <tr style="font-weight: bold; background-color: #E8F4F8;">
                    <td colspan="4" style="text-align: right;">AMOUNT IN USD</td>
                    <td id="usd-budget-amount">$<?php echo number_format($saved_data['totals']['budget_usd'] ?? 0, 2, '.', ''); ?></td>
                    <td id="usd-actual-expense">
                        $<?php echo number_format($saved_data['totals']['actual_usd'] ?? 0, 2, '.', ''); ?> 
                    </td>
                    <td>
                       <?php 
                    $usdMargin = $saved_data['totals']['usd_margin'] ?? 0;

                    if ($usdMargin == 0) {
                        $displayValue = '0';
                        $color = 'inherit';
                    } else {
                        $isNegative = $usdMargin < 0;
                        $displayValue = ($isNegative ? '-' : '+') . '$' . number_format(abs($usdMargin), 2, '.', '');
                        $color = $isNegative ? 'red' : 'green';
                    }
                    ?>
                    <span style="color: <?php echo $color; ?>; font-weight: 800;">
                        <?php echo $displayValue; ?>
                    </span>
                    </td>   
                </tr>

                <?php
                    $categoryTotals = $saved_data['category_totals'] ?? [];

                    $categoryLabels = [
                        'hotel' => 'HOTEL TOTAL',
                        'ticket' => 'TICKET TOTAL',
                        'train_ticket' => 'TRAIN TICKET TOTAL',
                        'trainTicketTotal' => 'TRAIN TICKET TOTAL',
                        'entrance' => 'ENTRANCE TOTAL',
                        'activity' => 'ACTIVITY TOTAL',
                        'guide' => 'GUIDE TOTAL',
                        'meal' => 'MEAL TOTAL',
                        'entertainment' => 'ENTERTAINMENT TOTAL',
                        'dinner_transfer' => 'DINNER TRANSFER TOTAL',
                        'mandatory' => 'MANDATORY SERVICE TOTAL',
                        'outside' => 'OUTSIDE COST TOTAL'
                    ];
                ?>

                <?php if (!empty($categoryTotals) && is_array($categoryTotals)): ?>

                    <?php foreach ($categoryTotals as $category => $categoryData):
                        if (!is_array($categoryData)) continue;

                        $label = $categoryLabels[$category] ?? strtoupper(str_replace('_', ' ', $category)) . ' TOTAL';
                        $budgetTotal = (float)($categoryData['budget_total'] ?? 0);
                        $actualTotal = (float)($categoryData['actual_total'] ?? 0);
                        $remarks = trim($categoryData['remarks'] ?? '');
                    ?>
                        <tr style="font-weight:bold;background-color:#D5E8D4;">
                            <!-- <td></td> -->

                            <td style="text-align:right;">
                                <?php echo htmlspecialchars($label); ?> (<?php echo htmlspecialchars($currency_abbr); ?>)
                            </td>

                            <td class="budget-expense-col" colspan="2">
                                <?php echo number_format($budgetTotal, 2, '.', ''); ?>
                            </td>

                            <td class="actual-expense-col" colspan="2">
                                <?php echo number_format($actualTotal, 2, '.', ''); ?>
                            </td>

                            <td style="text-align:left;" colspan="2">
                                <?php echo nl2br(htmlspecialchars($remarks)); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">
                        <div class="alert alert-warning">
                            <i class="glyphicon glyphicon-warning-sign"></i> No saved budget report found for this enquiry.
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>