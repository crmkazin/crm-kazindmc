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

img {
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

    </style>
</head>
<body>
    <div >

        <div class="container-fluid row" style="margin:0 0px ">
              <div class="col-lg-12 head-space">
                    <div class="in-pl text-center" >
                        <div  class="print-sub-head" style="font-size: 28px;float: initial;    text-transform: uppercase;">Detailed Itinerary</div>
                    </div>
                </div>
<!--<section>-->
<!--        <div class="row">-->
<!--            <div class="gallery-col-left">-->
<!--                <img src="<?php //echo base_url('assets/images/almaty/img.jpg'); ?>" alt="">-->
<!--            </div>-->
<!--            <div class="gallery-col-right">-->
<!--                <div class="gallery-boxs">-->
<!--                    <div><img src="<?php //echo base_url('assets/images/almaty/1.jpg'); ?>" alt=""></div>-->
<!--                    <div> <img src="<?php //echo base_url('assets/images/almaty/2.jpg'); ?>" alt=""></div>-->
<!--                    <div><img src="<?php //echo base_url('assets/images/almaty/3.jpg'); ?>" alt=""></div>-->

<!--                </div>-->
<!--                <div class="large-img">-->
<!--                    <img src="<?php //echo base_url('assets/images/almaty/img3.jpg'); ?>" alt="">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

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
                                    <td style="width: 45%;" class="large-cell">
                                        <img src="<?php echo base_url('assets/images/almaty/img/img_1.jpg'); ?>" alt="">
                                    </td>
                                    <td style="width: 55%;" colspan="2" class="small-cell">
                                        <div style="display:flex; width: 100%; border-bottom: solid 2px #fff;">
                                            <div class="ex-small1" style=" border-right: solid 2px #fff;">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_2.jpg'); ?>" alt="">
                                            </div>
                                            <div class="ex-small2">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_3.jpg'); ?>" alt="">
                                            </div>
                                        </div>
                                        <div style="display:flex; width: 100%;    border-bottom: solid 2px #fff;">
                                            <div class="ex-small" style=" border-right: solid 2px #fff;">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_4.jpg'); ?>" alt="">
                                            </div>
                                            <div class="ex-small">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_5.jpg'); ?>" alt="">
                                            </div>
                                        </div>

                                        <div style="display:flex; width: 100%;">
                                            <div class="ex-small2" style=" border-right: solid 2px #fff;">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_6.jpg'); ?>" alt="">
                                            </div>
                                            <div class="ex-small1">
                                                <img src="<?php echo base_url('assets/images/almaty/img/img_7.jpg'); ?>" alt="">
                                            </div>
                                        </div>
                                    </td>
                            </table>
                   <?php } else { ?>
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <div>
                                    <img class="large-pic" src="<?php echo base_url('assets/images/almaty/winter.jpg'); ?>" alt="">
                                </div>
                                <div>
                                    <img class="small-pic" src="<?php echo base_url('assets/images/almaty/winter1.jpg'); ?>" alt="">
                                </div>
                            </td>
                            <td style="width: 25%;">
                                <div>
                                    <img class="pic" src="<?php echo base_url('assets/images/almaty/winter2.jpg'); ?>" alt="">
                                </div>
                                <div>
                                    <img class="pic" src="<?php echo base_url('assets/images/almaty/winter3.jpg'); ?>" alt="">
                                </div>
                            </td>
                            <td style="width: 25%;">
                                <div>
                                     <img class="pic" src="<?php echo base_url('assets/images/almaty/winter4.jpg'); ?>" alt="">
                                </div>
                                <div>
                                    <img class="pic" src="<?php echo base_url('assets/images/almaty/winter5.jpg'); ?>" alt="">
                                </div>
                            </td>
                        </tr>
                    </table>
                 <?php } ?>

                <?php
                 $totalDays = count($brief_itinerary);
                foreach ($brief_itinerary as $dayIndex => $sites): ?>
                    <div class="col-md-12 mt-2 ps-0 pe-0">
                        <div class="in-pl text-center" >

                            <div class="col-12 text-center sub-title">
                            </div>
                               <h5 >Day                                                                                                                                                                                                     <?php echo($dayIndex + 1); ?></h5>
                           <div style="overflow-y: hidden;">
                             <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%" style="font-weight:bold;">Start Time</th>
                                        <th width="67%" style="font-weight:bold;">Activities</th>
                                        <!-- <th width="42%" style="font-weight:bold;">Description</th> -->
                                        <th width="8%" style="font-weight:bold;">Duration</th>
                                        <th width="15%" style="font-weight:bold;">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sites as $siteIndex => $site): ?>
                                        <tr>
                                            <td>
                                                <?php if(!empty($site['arrival_time'])): ?>
                                                    <span style="font-size:14px;"><?php echo $site['arrival_time']; ?> Hrs</span><br>
                                                <?php endif; ?>

                                                <?php if(!empty($site['departing_time'])): ?>
                                                    <span style="font-size:14px;"><?php echo $site['departing_time']; ?> Hrs</span><br>
                                                <?php endif; ?>

                                                <?php if(!empty($site['departing_time_from_hotel'])): ?>
                                                    <!--<span style="font-size:14px;"><?php echo $site['departing_time_from_hotel']; ?> Hrs</span>-->
                                                <?php endif; ?>
                                                <?php   $isMiddleDay = ($dayIndex > 0 && $dayIndex < ($totalDays - 1));
                                                $isFirstItinerary = ($siteIndex === 0);
                                                
                                                if ($isMiddleDay && $isFirstItinerary): ?>
                                                <span style="font-size:14px;">10:00 Hrs</span>
                                                <?php endif; ?>
                                            </td>
                                            <td ><span style="font-size: 14px;" ><?php echo $site['site_name']; ?><?php echo $site['description']; ?></span></td>
                                            <!-- <td ><span style="font-size: 18px;"><?php echo $site['description']; ?></span></td> -->
                                            <td ><span style="font-size: 14px;"><?php
                                                                                    $duration_text = '';
                                                                                    if (! empty($site['duration_hours'])) {
                                                                                        $duration_text .= $site['duration_hours'] . 'h ';
                                                                                    }
                                                                                    if (! empty($site['duration_minutes'])) {
                                                                                        $duration_text .= $site['duration_minutes'] . 'min';
                                                                                }
                                                                                echo trim($duration_text); ?></span></td>
                                            <td ><span style="font-size: 14px;"><?php echo $site['entry_ticket_for'] ?? ''; ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                           </div>
                        </div>
                    </div>
                <?php endforeach; ?>

        </div>
    </div>
</body>

</html>