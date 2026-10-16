<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  
    <style>
        .dataTables_paginate .page-item>.page-link { padding: 0 12px !important; }
        .form-control { border : 1px solid #ede5e5 !important; }
    </style>  
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php include ('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Itinerary Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Itinerary Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Itinerary Report</header>
                                    <!-- <div class="tools">
                                        <a href="<?= base_url(); ?>add-party-bus" class="btn btn-success"
                                            style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div> -->
                                </div>
                                <form method="get">
                                    <div class="card-body row">
                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input"
                                                    style="padding: 10px;" required>
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($locations);
                                                    foreach ($locations as $key => $val) {
                                                        //$val[] = 'All'; 
                                                        if($key!='all'){
                                                        ?>
                                                        <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>">
                                                            <?= ucfirst($key) ?>
                                                        </option>
                                                    <?php }} ?>
                                                </select>
                                                <label class="mdl-textfield__label">Country</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-5 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="title[]" id="title" class="mdl-textfield__input js-example-basic-multiple" multiple=""
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    
                                                </select>
                                                <label class="mdl-textfield__label">In Title</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-5 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="not_in_title[]" id="not_in_title" class="mdl-textfield__input js-example-basic-multiple" multiple=""
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    
                                                </select>
                                                <label class="mdl-textfield__label">Not In Title</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="no_of_nights" id="no_of_nights"
                                                    class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($nights);
                                                    foreach ($nights as $night) {
                                                        if($night->number_of_nights>0){
                                                        ?>
                                                        <option value="<?= $night->number_of_nights ?>"
                                                            data-abbr="<?= $night->number_of_nights ?>">
                                                            <?= $night->number_of_nights ?>
                                                        </option>
                                                    <?php }} ?>

                                                </select>
                                                <label class="mdl-textfield__label">No. of Nights</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="table-scrollable">

                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">S.No.</th>
                                                    <th class="center">Country</th>
                                                    <!-- <th class="center">Guests</th> -->
                                                    <th class="center">No. of Nights</th>
                                                    <th class="center"><?php  echo (!empty($this->input->get('not_in_title')))?'Not In ':'In ';  ?>Title</th>
                                                    <th class="center">Print</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = 1;
                                                    foreach ($result as $list) {
                                                        $records_cnt++;
                                                        $decodedTitle = $cleanedTitle = [];
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?php $char = substr($list->enquiry_abbr, 1, 1);
                                                            $locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
                                                            echo ucfirst($locations[$char]);
                                                            ?></td>
                                                            <!-- <td class="center">
                                                                <?php //echo $list->number_persons + $list->number_child; ?>
                                                                (<?php //echo $list->number_persons; ?>A+<?php //echo $list->number_child; ?>C)
                                                                <?php //echo $list->group_type; ?>
                                                            </td> -->
                                                            <td class="center"><?= $list->number_of_nights ?>
                                                            </td>
                                                            <?php //$decodedTitle = explode(',', strip_tags(urldecode($list->title)));
                                                            //echo '<pre>' ; print_r($decodedTitle);
                                                            //echo '<br><br>';
                                                            // Strings you want to remove
                                                            //$stringsToRemove = ['Overnight Stay At Hotel', 'OPEN RESTAURANT (lunch)', 'OPEN RESTAURANT (Dinner)', 'ALMATY ORIENTATION TOUR', 'Hotel Drop-Off', 'Journey back to Almaty', 'Enjoy Breakfast at your hotel.', 'Check-out formalities', 'Transfer to the airport.', 'Meet & Greet with your Driver', 'Breakfast', 'Checkout From Your Hotel', 'for rest', 'NO SERVICE', 'Check Out The Hotel and  Formalities', 'Transfer To Airport', 'Early', ' Check Out From Hotel ', 'PACKED', ' Check Out From Hotel', 'Overnight Stay At Your Hotel ', 'Checkout From your Apartment', 'Check Out The Hotel and  Formalities'];

                                                            // Remove the specified strings from the decoded title
                                                            //$cleanedTitle = str_replace($stringsToRemove, '', $decodedTitle);
                                                            // $cleanedTitle = preg_replace('/,+/', ',', $cleanedTitle);
                                                    
                                                            // Trim any leading or trailing commas and whitespace
                                                            //$cleanedTitle = trim($decodedTitle, ', ');
                                                            /*foreach($decodedTitle AS $list_title){
                                                                //if($list_title <> '' && in_array(trim($list_title),$sites_names)){                                                                    
                                                                    $cleanedTitle[] = $list_title;
                                                                //}
                                                            }*/
                                                            ?>
                                                            <td class=""><ol>
                                                                <?php 
                                                                    if($title[0]!=''){
                                                                        foreach($title AS $t){ echo '<li>'.$t.'</li>'; } //echo $list->title;//implode(', ',$cleanedTitle); 
                                                                    }else{
                                                                        echo '<li>'.urldecode($list->title).'</li>';
                                                                    }
                                                                ?>
                                                                </ol>
                                                            </td>
                                                            <td class="center"> <a
                                                                    href="<?= base_url('print-itinerary-voucher?arrival_id=' . base64_encode($list->arrival_id)) ?>"
                                                                    class="btn btn-tbl-edit btn-xs"
                                                                    title="Print Restaurant Voucher"
                                                                    style="background-color:green;" target="_blank"><i
                                                                        class="fa fa-print"></i></a></td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
    <script>
        $(document).ready(function () {
            var table = $('#example4').DataTable({
                "scrollX": true,
                //"scrollY": "200px",
                "pageLength": 10

            });

            $("#location").on('change', function () {
                
                $.ajax({
                    url: "<?php echo site_url('admin/report/get_site_titles'); ?>",
                    type: "post",
                    data: { 'country': $("#location").val() },
                    dataType: 'JSON',
                    //contentType : false,
                    //processData: false,
                    beforeSend: function () { },
                    success: function (res) {
                        if (res.response === "s") {
                            $("#title,#not_in_title").empty();
                            $.each(res.details, function (index, item) {
                                $("#title").append('<option value="' + item
                                .site_name + '">' + item.site_name +
                                '</option>');
                            });
                            $.each(res.details, function (index, item) {
                                $("#not_in_title").append('<option value="' + item
                                .site_name + '">' + item.site_name +
                                '</option>');
                            });
                        }
                    }
                });

            });
            
            $('#title').on("select2:select", function(e) { 
                $("#not_in_title").val('').trigger('change');
            });
            $('#not_in_title').on("select2:select", function(e) { 
                $("#title").val('').trigger('change');
            });
            
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Title',
                
            });

        });
    </script>
</body>

</html>