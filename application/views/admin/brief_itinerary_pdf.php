<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detailed Itinerary</title>
    <style>
        /* Reset and basic styles */
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .container-fluid {
            width: 100%;
            padding: 0;
        }
        
        .text-center {
            text-align: center;
        }
        
        .print-sub-head {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
            color: #000;
        }
        
        /* Table styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        
        .table-bordered {
            border: 1px solid #53767e;
        }
        
        .table-bordered thead {
            background: #53767e;
            color: #fff;
        }
        
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #53767e;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        .table-bordered th {
            font-weight: bold;
            padding: 10px;
        }
        
        .table tbody tr:nth-child(odd) {
            background-color: #f4f4f4;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: rgba(203, 187, 187, 0.35);
        }
        
        /* Day heading */
        .day-heading {
            font-size: 16px;
            font-weight: 600;
            color: #081c74;
            text-transform: uppercase;
            text-align: center;
            margin: 15px 0 10px 0;
            position: relative;
        }
        
        .day-heading:before,
        .day-heading:after {
            content: '';
            position: absolute;
            top: 50%;
            width: 20px;
            height: 2px;
            background-color: #081c74;
        }
        
        .day-heading:before {
            left: -30px;
        }
        
        .day-heading:after {
            right: -30px;
        }
        
        /* Image styles */
        .image-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        
        .image-table td {
            vertical-align: top;
            padding: 0;
        }
        
        .large-cell {
            width: 45%;
        }
        
        .small-cell {
            width: 55%;
        }
        
        .image-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        
        .image-row {
            display: table-row;
        }
        
        .image-cell {
            display: table-cell;
            vertical-align: top;
            border: 2px solid #fff;
        }
        
        .ex-small1 {
            width: 35%;
        }
        
        .ex-small2 {
            width: 65%;
        }
        
        .ex-small {
            width: 50%;
        }
        
        img.season {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .large-pic {
            height: 200px;
            object-fit: cover;
        }
        
        .small-pic {
            height: 100px;
            object-fit: cover;
        }
        
        .pic {
            height: 122px;
            object-fit: cover;
        }
        
        /* Remove Bootstrap-specific classes */
        .row, .col-md-12, .col-lg-12, .mt-2, .ps-0, .pe-0, .m-4, .d-flex, .justify-content-center {
            all: unset;
        }
        
        .in-pl {
            padding: 0;
        }
        
        .head-space {
            margin: 10px 0;
        }
        
        /* Page breaks */
        .page-break {
            page-break-after: always;
        }
        
        /* Activity text */
        .activity-text {
            font-size: 12px;
            font-weight: 400;
        }
        
        .activity-bold {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="head-space">
            <div class="in-pl d-flex align-items-center">
                <table>
                    <tr style="border:none; background:#fff">
                        <td width="50%" style="border:none">
                            <?php if(!empty($agent_logo)):?>
                                <img src="<?= base_url('assets/company/'.$agent_logo); ?>">
                            <?php else : ?>
                                <img src="<?= base_url('assets/company/no-image.png'); ?>">
                            <?php endif; ?>
                        </td>
                        <td width="50%" style="border:none">
                            <div class="print-sub-head" style="font-size: 20px;float: initial;">Detailed Itinerary</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <?php
        $check_in_date = $enquiry[0]->check_in_date;
        $check_out_date = $enquiry[0]->check_out_date;
        
        $check_in = strtotime($check_in_date);
        $check_out = strtotime($check_out_date);
        
        $year = date('Y', $check_in);
        $summer_start = strtotime("$year-03-01");
        $summer_end = strtotime("$year-10-30");
        
        if (($check_in >= $summer_start && $check_in <= $summer_end) || 
            ($check_out >= $summer_start && $check_out <= $summer_end)): ?>
            <table class="image-table">
                <tr>
                    <td style="width: 100%;">
                         <?php if($city_of_arrival =='FGE' || $city_of_arrival =='IGE' || $city_of_arrival =='GGE'){?>
                            <img class="season" src="<?php echo base_url('assets/images/georgia/summer.png'); ?>" alt="">
                        <?php }elseif($city_of_arrival =='FUZ' || $city_of_arrival =='IUZ' || $city_of_arrival =='GUZ'){ ?>
                            <img class="season" src="<?php echo base_url('assets/images/uzbekistan/summer.png'); ?>" alt="">
                        <?php }else{ ?>
                            <img class="season" src="<?php echo base_url('assets/images/almaty/summer.png'); ?>" alt="" style="height: 314px;">
                        <?php } ?>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <table class="image-table">
                <tr>
                    <td style="width: 100%;">
                         <?php if($city_of_arrival =='FGE' || $city_of_arrival =='IGE' || $city_of_arrival =='GGE'){?>
                            <img class="season" src="<?php echo base_url('assets/images/georgia/summer.png'); ?>" alt="">
                        <?php }elseif($city_of_arrival =='FUZ' || $city_of_arrival =='IUZ' || $city_of_arrival =='GUZ'){ ?>
                            <img class="season" src="<?php echo base_url('assets/images/uzbekistan/summer.png'); ?>" alt="">
                        <?php }else{ ?>
                            <img class="season" src="<?php echo base_url('assets/images/almaty/winter.png'); ?>" alt="">
                        <?php } ?>
                    </td>
                </tr>
            </table>
        <?php endif; ?>

        <?php 
        $totalDays = count($brief_itinerary);
        foreach ($brief_itinerary as $dayIndex => $sites): ?>
            <div style="margin: 15px 0;">
                <div class="text-center">
                    <div class="day-heading">Day <?php echo($dayIndex + 1); ?></div>
                </div>
                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%" style="font-weight:bold;">Start Time</th>
                                        <th width="70%" style="font-weight:bold;">Activities</th>
                                        <!-- <th width="8%" style="font-weight:bold;">Duration</th> -->
                                        <th width="20%" style="font-weight:bold;">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $isMiddleDay = ($dayIndex > 0 && $dayIndex < ($totalDays - 1));
                                    $hasOnlySite15 = false;
                                    $siteCount = count($sites);
                                    $foundSite15 = false;
                                    $firstSiteAfter15 = false;
                                    
                                    // Check if only site ID 15 exists in this day
                                    if ($siteCount == 1 && isset($sites[0]['site_id']) && $sites[0]['site_id'] == '15') {
                                        $hasOnlySite15 = true;
                                    }
                                    ?>
                                    
                                    <?php foreach ($sites as $siteIndex => $site): ?>
                                        <?php
                                        // Track site 15 and first site after it
                                        if ($site['site_id'] == '15') {
                                            $foundSite15 = true;
                                            $firstSiteAfter15 = true; // Next site will be first after site 15
                                        } elseif ($foundSite15 && $firstSiteAfter15) {
                                            // This is the first site after site 15
                                            $showTimeForThisSite = true;
                                            $firstSiteAfter15 = false; // Reset so next sites don't get time
                                        } else {
                                            $showTimeForThisSite = false;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                // For site ID 15 in middle days - show time from master
                                                if ($isMiddleDay && $site['site_id'] == '15' && !empty($site['departing_time_from_hotel'])): ?>
                                                    <!-- <span style="font-size:14px;"><?php //echo $site['departing_time_from_hotel']; ?> Hrs</span><br> -->
                                                
                                                <?php 
                                                // For first site after site_id 15 in middle days - show 10:00 Hrs
                                                elseif ($isMiddleDay && isset($showTimeForThisSite) && $showTimeForThisSite && $site['site_name'] != 'No service'): ?>
                                                    <span style="font-size:14px;">10:00 Hrs</span>
                                                
                                                <?php 
                                                // For first itinerary in middle days (when no site 15) - show 10:00 Hrs
                                                elseif ($isMiddleDay && $siteIndex === 0 && !$foundSite15 && $site['site_name'] != 'No service'): ?>
                                                    <span style="font-size:14px;">10:00 Hrs</span>
                                                
                                                <?php 
                                                // For arrival time (first day)
                                                elseif(!empty($site['arrival_time'])): 
                                                    if($site['arrival_time'] == 'morning' || $site['arrival_time'] == 'evening'){ ?>
                                                    <span style="font-size:14px;"><?php echo ucfirst($site['arrival_time']); ?></span><br>
                                                <?php } else { ?>
                                                    <span style="font-size:14px;"><?php echo $site['arrival_time']; ?> Hrs</span><br>
                                                 <?php } ?>
                                                <?php 
                                                // For departing time (last day)
                                                elseif($site['site_id'] == '18' && !empty($site['departing_time'])):
                                                    $time = $site['departing_time'];
                                                    $time_3hr_before = date("H:i", strtotime("$time -3 hours"));
                                                if($site['departing_time'] == 'morning' || $site['departing_time'] == 'evening'){
                                                ?>
                                                        <span style="font-size:14px;"><?php echo ucfirst($site['departing_time']); ?></span><br>
                                               <?php }else{ ?>
                                                    <span style="font-size:14px;"><?php echo $time_3hr_before; ?> Hrs</span><br>
                                                    <?php } ?>
                                                <?php endif; ?>
                                            </td>
                                            
                                            <td>
                                                <span style="font-size: 14px;">
                                                    <?php if(!empty($site['site_name'])): ?>
                                                        <span for="" style="font-weight: 600 !important;"><?php echo $site['site_name']; ?></span>
                                                    <?php endif; ?>
                                                    <?php echo $site['description']; ?>
                                                </span>
                                            </td>
                                            
                                            <!-- <td>
                                                <span style="font-size: 14px;"> -->
                                                    <?php
                                                    $duration_text = '';
                                                    if (!empty($site['duration_hours'])) {
                                                        $duration_text .= $site['duration_hours'] . 'h ';
                                                    }
                                                    if (!empty($site['duration_minutes'])) {
                                                        $duration_text .= $site['duration_minutes'] . 'min';
                                                    }
                                                   // echo trim($duration_text); 
                                                    ?> 
                                                <!-- </span>
                                            </td> -->
                                            
                                            <td>
                                                <span style="font-size: 14px;">
                                                    <?php echo $site['entry_ticket_for'] ?? ''; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        <?php 
                                        // Agar sirf site_id 15 hai to uske baad "No service" add karo
                                        if ($hasOnlySite15 && $siteIndex === 0): ?>
                                            <tr>
                                                <td>
                                                    <?php if ($isMiddleDay): ?>
                                                        <span style="font-size:14px;">10:00 Hrs</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span style="font-size: 14px;">
                                                        <span for="" style="font-weight: 600 !important;">No service</span>
                                                        Today is a free and easy day at your disposal
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="font-size: 14px;"></span>
                                                </td>
                                                <td>
                                                    <span style="font-size: 14px;"></span>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
            </div>
            
            <?php if (($dayIndex + 1) % 2 == 0): ?>
                <div class="page-break"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>
</html>