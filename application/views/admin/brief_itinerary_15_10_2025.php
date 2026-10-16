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
    /* padding: 10px; */
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
  list-style-type: decimal; /* Options: decimal, lower-roman, upper-alpha, etc. */
  margin-left: 20px;         /* Controls indentation */
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
       /* background-color: #fff4f4; */
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
    </style>
</head>
<?php //print_r($arrivals); ?>
<body>
    <div >

        <div class="container-fluid row" style="margin:0 0px ">
              <div class="col-lg-12 head-space">
                    <div class="in-pl text-center" >
                        <div  class="print-sub-head" style="font-size: 28px;float: initial;    text-transform: uppercase;">Brief Itinerary</div>
                    </div>
                </div>
<section>
        <div class="row">
            <div class="gallery-col-left">
                <img src="<?php echo base_url('assets/images/almaty/img.jpg'); ?>" alt="">
            </div>
            <div class="gallery-col-right">
                <div class="gallery-boxs">
                    <div><img src="<?php echo base_url('assets/images/almaty/1.jpg'); ?>" alt=""></div>
                    <div> <img src="<?php echo base_url('assets/images/almaty/2.jpg'); ?>" alt=""></div>
                    <div><img src="<?php echo base_url('assets/images/almaty/3.jpg'); ?>" alt=""></div>

                </div>
                <div class="large-img">
                    <img src="<?php echo base_url('assets/images/almaty/img3.jpg'); ?>" alt="">
                </div>
            </div>
        </div>


    </section>

                <?php foreach ($brief_itinerary as $dayIndex => $sites): ?>
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
                                        <th width="67%" style="font-weight:bold;">Site Name</th>
                                        <!-- <th width="42%" style="font-weight:bold;">Description</th> -->
                                        <th width="8%" style="font-weight:bold;">Duration</th>
                                        <th width="15%" style="font-weight:bold;">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sites as $site): ?>
                                        <tr>
                                            <td ><span style="font-size: 14px;"><?php echo $site['departing_time_from_hotel']; ?></span></td>
                                            <td ><span style="font-size: 14px;"><?php echo $site['site_name']; ?><?php echo $site['description']; ?></span></td>
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