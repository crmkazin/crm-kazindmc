<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Breif Itinerary</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
        .bg-light-back {
            background-color: #ebebeb !important
        }

        .remove-border {
            background-color: #bfbfbf !important
        }

        .table.table-bordered thead {
            vertical-align: bottom;
            background: #53767e;
            color: #fff;   
        }
        .table.table-bordered tbody tr td p{
            font-size: 13px;
            font-weight: 400;
            margin-top: 10px;
        }
        .table.table-bordered tbody tr td span{
            font-weight: 600;
        }
        .table.table-bordered thead tr th{
            padding: 10px;
        }
        .table.table-bordered {
            margin-top: 15px;
            margin-bottom: 30px;
        }
        .print-data table, td, th, tr{
            font-size: 14px;
        }
        .print-data table, td, th, tr {
            border: solid 1px #53767e;
        }


        @media print {
            html {
                -webkit-print-color-adjust: exact;
            }

            .print-data {
                page-break-after: always;
            }

            .noPrint {
                display: none;
            }
        }
        ol {
        list-style-type: decimal;
        margin-left: 20px;
        padding-left: 10px;
        color: #333;

        }
        .large-img {
            width: 100%;
        }
        .large-img img{
            width: 100%;
        }
        .gallery-col-left {
            width: 49%;
            padding: 0;
        }
        .gallery-boxs >div{
            width: 33.33%;
        }
        .gallery-boxs >div img{
            width: 100%;
        }
        .gallery-boxs {
            width: 100%;
            display: flex;
        }

        .gallery-col-left img {
            width: 100%;
        }
        .gallery-col-right {
            width: 51%;
            padding: 0;
        }
        .gallery-boxs{
            width: 100%;
        }
        .sub-title+h5{
            position: relative;
            display: initial;
            font-size:22px;
            font-weight:600;
            color:#081c74; 
            text-transform: uppercase;

        }
        .sub-title+h5::after, .sub-title+h5::before{
            position: absolute;
            top: 50%;
            content: '';
            width: 20px;
            height: 2px;
            background-color: #081c74;
        }
        .sub-title+h5::after{
            left: -30px;
        }
        .sub-title+h5::before{
            right: -30px;
        }

        table tbody tr:nth-child(odd){
            background-color: #f4f4f4;
        }

        table tbody tr:nth-child(even){
            background-color: rgb(203 187 187 / 35%);
        }
        @media screen and (max-width:576px) {
        .table.table-bordered {
            margin-top: 10px;
            margin-bottom: 8px;
            width: 850px;
        }
        .table.table-bordered tbody tr td p {
            font-size: 12px;
            margin-top: 10px;
        }
        .print-data table, td, th, tr {
            font-size: 12px;
        }
        .sub-title+h5 {
            font-size: 18px;
        }
        .print-sub-head{
            font-size: 18px !important;
        }
        }

        img.large-pic {
            object-fit: cover;
            width: 100%;
            height: 320px;
        }

        img.small-pic {
            width: 100%;
            object-fit: cover;
            height: 170px;
        }

        .pic {
            width: 100%;
            height: 245px;
            object-fit: cover;
        }

        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .large-cell {
            width: 50%;
        }

        .small-cell {
            width: 50%;
        }

        .season {
            width: 100%;
            display: block;
            object-fit: cover;
            height: 100%;
        }

        .ex-small1>img,
        .ex-small2>img,
        .ex-small>img {
            height: 157px;
            object-fit: cover;
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
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        /* Download buttons styles */
        .download-buttons {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .download-buttons .btn {
            margin: 5px 10px;
            min-width: 150px;
        }

        @media print {
            .download-buttons {
                display: none;
            }
        }

</style>
</head>
<body>
    <div id="cnt-print-data">

        <div class="container-fluid row" style="margin:0 0px ">
              <div class="col-lg-12 head-space">
                    <div class="in-pl d-flex align-items-center" >
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
                                    <div class="print-sub-head" style="font-size: 30px;float: initial;">Detailed Itinerary</div>
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

                    // Define summer start and end (same year as check-in)
                    $year = date('Y', $check_in);
                    $summer_start = strtotime("$year-03-01");
                    $summer_end = strtotime("$year-10-30");

                    // Check if either check-in or check-out falls in summer
                    if (($check_in >= $summer_start && $check_in <= $summer_end) || 
                        ($check_out >= $summer_start && $check_out <= $summer_end)) { ?>
                            <table>
                                <tr>
                                    <td style="width: 100%;" class="large-cell">
                                        <?php if($city_of_arrival =='FGE' || $city_of_arrival =='IGE' || $city_of_arrival =='GGE'){?>
                                        <img class="season" src="<?php echo base_url('assets/images/georgia/summer.png'); ?>" alt="">
                                    <?php }elseif($city_of_arrival =='FUZ' || $city_of_arrival =='IUZ' || $city_of_arrival =='GUZ'){ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/uzbekistan/summer.png'); ?>" alt="">
                                    <?php }elseif($city_of_arrival =='FAZ' || $city_of_arrival =='IAZ' || $city_of_arrival =='GAZ'){ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/azerbaijan/summer.png'); ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/almaty/summer.png'); ?>" alt="">
                                        <?php } ?>
                                    </td>
                                    
                            </table>
                   <?php } else { ?>
                    <table>
                        <tr>
                            <td style="width: 100%;" class="large-cell">
                                <div>
                                    <?php if($city_of_arrival =='FGE' || $city_of_arrival =='IGE' || $city_of_arrival =='GGE'){?>
                                        <img class="season" src="<?php echo base_url('assets/images/georgia/summer.png'); ?>" alt="">
                                     <?php }elseif($city_of_arrival =='FUZ' || $city_of_arrival =='IUZ' || $city_of_arrival =='GUZ'){ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/uzbekistan/summer.png'); ?>" alt="">
                                    <?php }elseif($city_of_arrival =='FAZ' || $city_of_arrival =='IAZ' || $city_of_arrival =='GAZ'){ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/azerbaijan/summer.png'); ?>" alt="">
                                    <?php }else{ ?>
                                        <img class="season" src="<?php echo base_url('assets/images/almaty/winter.png'); ?>" alt="">
                                    <?php } ?>
                                </div>
                               
                            </td>
                            
                        </tr>
                    </table>
            
                   <?php } ?>

            <?php
            $totalDays = count($brief_itinerary);
            foreach ($brief_itinerary as $dayIndex => $sites): ?>
                <div class="col-md-12 mt-2 ps-0 pe-0">
                    <div class="in-pl text-center">
                        <div class="col-12 text-center sub-title"></div>
                        <h5>Day <?php echo($dayIndex + 1); ?></h5>
                        <div style="overflow-y: hidden;">
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
     <!-- Download Buttons at the bottom -->
    <div class="col-12 download-buttons">
        <div class="text-center">
            <a href="<?php echo base_url('brief-itinerary/' . $encoded_id . '?print=pdf'); ?>" class="btn btn-danger btn-lg">
                <i class="fas fa-file-pdf me-2"></i> Save as PDF
            </a>
            <button onclick="exportHTMLToDoc()" class="btn btn-primary btn-lg">
                <i class="fas fa-file-word me-2"></i> Save as DOC
            </button>
        </div>
    </div>
</body>
</html>

<script>
    function exportHTMLToDoc() {
        var enquiryNo = "<?php echo isset($enquiry[0]->enquiry_no) ? addslashes($enquiry[0]->enquiry_no) : 'Itinerary'; ?>";
        var fileName = enquiryNo + "_detailed_itinerary.doc";

        var header = `
        <html xmlns:o='urn:schemas-microsoft-com:office:office'
            xmlns:w='urn:schemas-microsoft-com:office:word'
            xmlns='http://www.w3.org/TR/REC-html40'>
        <head>
            <meta charset='utf-8'>
            <title>${enquiryNo} - Detailed Itinerary</title>
            <style>
                body {
                    font-family: "Segoe UI", sans-serif;
                    background: #f5f5f5;
                    padding: 40px;
                    font-size: 11pt;
                    color: #333;
                }
                .text-center { text-align: center; }
                .print-head {
                    font-size: 26px;
                    font-weight: bold;
                    margin-bottom: 20px;
                    text-transform: uppercase;
                }
                .lab-data {
                    font-size: 14px;
                    font-weight: bold;
                    margin: 4px 0;
                    display: block;
                }
                .row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 10px;
                }
                .col-lg-3 {
                    width: 25%;
                    padding: 10px;
                }
                .col-lg-12, .col-md-12 {
                    width: 100%;
                    padding: 10px;
                }
                img {
                    max-width: 100%;
                    height: auto;
                    display: block;
                    border-radius: 4px;
                }
                .table-img{
                    border: none !important;
                }
                .table-img td, th, tr{
                    border: none;
                }
                .print-head, .in-pl{
                    text-align: center;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                    background: #fff;
                    font-size: 10.5pt;
                }
                th, td {
                    border: 1px solid #53767e;
                    padding: 8px 10px;
                    vertical-align: top;
                }
                th {
                    background-color: #53767e;
                    color: #fff;
                    font-weight: bold;
                    text-align: left;
                }
                .text-white {
                    color: #fff !important;
                }
                .section {
                    margin-top: 30px;
                }
                .day-heading {
                    background: #081c74;
                    color: white;
                    font-weight: bold;
                    padding: 12px;
                    font-size: 14pt;
                    text-align: center;
                    text-transform: uppercase;
                    margin: 20px 0 10px 0;
                }
                .fadetbl{
                    background-color: #e6d295;
                }
                .table-bordered {
                    border: 1px solid #53767e;
                }
                .table-bordered tbody tr:nth-child(odd) {
                    background-color: #f4f4f4;
                }
                .table-bordered tbody tr:nth-child(even) {
                    background-color: rgba(203, 187, 187, 0.35);
                }
                .sub-title+h5 {
                    position: relative;
                    display: block;
                    font-size: 22px;
                    font-weight: 600;
                    color: #081c74;
                    text-transform: uppercase;
                    text-align: center;
                    margin: 20px 0;
                }
                .sub-title+h5::after, .sub-title+h5::before {
                    position: absolute;
                    top: 50%;
                    content: '';
                    width: 20px;
                    height: 2px;
                    background-color: #081c74;
                }
                .sub-title+h5::after {
                    left: -30px;
                }
                .sub-title+h5::before {
                    right: -30px;
                }
            </style>
        </head>
        <body>
        `;

        var footer = "</body></html>";
        var content = document.getElementById("cnt-print-data").innerHTML;
        var sourceHTML = header + content + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        fileDownload.href = source;
        fileDownload.download = fileName;

        document.body.appendChild(fileDownload);
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>