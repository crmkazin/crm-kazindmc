<?php include ('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  
<style>
    .dataTables_paginate .page-item>.page-link { padding: 0 12px !important; }
    .form-control { border : 1px solid #ede5e5 !important; }
    .dataTable thead th[class*=sorting]:after{display: none !important;}
    .select2-container .select2-selection{
        padding:0;
        border:none;
    }
    .select2-container.select2-container--open .select2-selection:before{
        display:none;
    }
</style>  
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Itinerary Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Itinerary Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include ('report_links.php'); ?>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <!-- <div class="card-head">
                                    <header>Itinerary Report</header> -->
                                    <!-- <div class="tools">
                                        <a href="<?= base_url(); ?>add-party-bus" class="btn btn-success"
                                            style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div> -->
                                <!-- </div> -->
                                <form method="get" class="content">
                                    <div class="card-body row">
                                        <div class="col-lg-3">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Country</label>
                                                <select name="location" id="location" class="bg-white mdl-textfield__input"
                                                    style="padding: 10px;" required>
                                                    <option value="">Select..</option>
                                                    <?php if($this->session->userdata('admin_type') == 'user') {
                                                        $user_locations = explode(',', $this->session->userdata('locations')); 
                                                        asort($locations);

                                                        foreach ($locations as $key => $val) {
                                                            if (in_array($key, $user_locations)) {
                                                                $selected = ($this->input->get('location') != '' && $this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?= $selected ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php 
                                                            }
                                                        } 
                                                    } else { ?>
                                                        <?php 
                                                        asort($locations);
                                                        foreach($locations AS $key=>$val){ $val[]='All'; ?>
                                                        <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                            <?= ucfirst($key)?></option>
                                                       <?php } ?>
                                                   <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">No. of Nights</label>
                                                <select name="no_of_nights" id="no_of_nights"
                                                    class="mdl-textfield__input bg-white" style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($nights);
                                                    foreach ($nights as $night) {
                                                        if($night->number_of_nights>0){
                                                        ?>
                                                        <option value="<?= $night->number_of_nights ?>" data-abbr="<?= $night->number_of_nights ?>" <?=($this->input->get('no_of_nights')<>'' && $this->input->get('no_of_nights')==$night->number_of_nights)?'selected="selected"':''; ?>>
                                                            <?= $night->number_of_nights ?>
                                                        </option>
                                                    <?php }} ?>

                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">In Title</label>
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width mdl-textfield__input">
                                                <select name="title[]" id="title" class="js-example-basic-multiple" multiple=""
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Not In Title</label>
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width mdl-textfield__input">
                                                <select name="not_in_title[]" id="not_in_title" class="js-example-basic-multiple" multiple=""
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mt-4 btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="table-scrollable">

                                        <table class="table table-striped border table-hover table-checkable order-column full-width"
                                            id="itinerary_report">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">S.No.</th>
                                                    <th class="center">Country</th>
                                                    <!-- <th class="center">Guests</th> -->
                                                    <th class="center">No. of Nights</th>
                                                    <th class="center">Brief</th>
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
                                                            <td class="center">
                                                            <?php $char = substr($list->enquiry_abbr, 1, 2);
                                                            $locations = ['AZ' => 'azerbaijan', 'BZ' => 'belarus', 'GE' => 'georgia', 'KZ' => 'kazakhstan','AR'=>'armenia', 'UZ'=> 'uzbekistan'];
                                                            echo ucfirst($locations[$char]);
                                                            ?></td>
                                                            <!-- <td class="center">
                                                                <?php //echo $list->number_persons + $list->number_child; ?>
                                                                (<?php //echo $list->number_persons; ?>A+<?php //echo $list->number_child; ?>C)
                                                                <?php //echo $list->group_type; ?>
                                                            </td> -->
                                                            <td class="center"><?= $list->number_of_nights ?>
                                                            </td>
                                                            <?php $decodedTitle = explode(',', strip_tags(urldecode($list->title)));
                                                            //echo '<pre>' ; print_r($decodedTitle);
                                                            //echo '<br><br>';
                                                            // Strings you want to remove
                                                            //$stringsToRemove = ['Overnight Stay At Hotel', 'OPEN RESTAURANT (lunch)', 'OPEN RESTAURANT (Dinner)', 'ALMATY ORIENTATION TOUR', 'Hotel Drop-Off', 'Journey back to Almaty', 'Enjoy Breakfast at your hotel.', 'Check-out formalities', 'Transfer to the airport.', 'Meet & Greet with your Driver', 'Breakfast', 'Checkout From Your Hotel', 'for rest', 'NO SERVICE', 'Check Out The Hotel and  Formalities', 'Transfer To Airport', 'Early', ' Check Out From Hotel ', 'PACKED', ' Check Out From Hotel', 'Overnight Stay At Your Hotel ', 'Checkout From your Apartment', 'Check Out The Hotel and  Formalities'];

                                                            // Remove the specified strings from the decoded title
                                                            //$cleanedTitle = str_replace($stringsToRemove, '', $decodedTitle);
                                                            // $cleanedTitle = preg_replace('/,+/', ',', $cleanedTitle);
                                                    
                                                            // Trim any leading or trailing commas and whitespace
                                                            //$cleanedTitle = trim($decodedTitle, ', ');
                                                            foreach($decodedTitle AS $list_title){
                                                                if($list_title <> ''){                                                                    
                                                                    $cleanedTitle[] = $list_title;
                                                                }
                                                            }
                                                            ?>
                                                            <td class="center">
                                                                <?php echo implode(', ',$cleanedTitle); ?>
                                                            </td>
                                                            <td class="center"> <a
                                                                    href="<?= base_url('print-itinerary-voucher?arrival_id=' . base64_encode($list->arrival_id)) ?>"
                                                                    class="btn btn-tbl-edit btn-xs"
                                                                    title="Restaurant Voucher"
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
    </div>
<script>
    $(document).ready(function () {
        var table = $('#itinerary_report').DataTable({
            // "scrollX": true,
            //"scrollY": "200px",
            // "pageLength": 10
            responsive: true

        });
        url = new URL(window.location.href);
        
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
                            .id + '">' + item.site_name +
                            '</option>');
                        });
                        $.each(res.details, function (index, item) {
                            $("#not_in_title").append('<option value="' + item
                            .id + '">' + item.site_name +
                            '</option>');
                        });
                    }
                },
                complete:function(){
                    $("#title").val(url.searchParams.getAll('title[]')).select2();
                    $("#not_in_title").val(url.searchParams.getAll('not_in_title[]')).select2();
                },
            });

        });
        if (url.searchParams.has('location')) {
            $("#location").trigger("change");               
        }
        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Title',
            
        });

    });
</script>