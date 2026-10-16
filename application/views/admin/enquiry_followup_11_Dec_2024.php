<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="icon-and-text-button-demo">
                                <a href="enquiry-followup" class="btn btn-info waves-effect" style="margin-left:5px;">
                                    <i class="material-icons">supervisor_account</i><br>
                                    <span>Queryboard</span>
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Queryboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Queryboard</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Queryboard</header>
                                    <div class="tools"
                                        style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'block'; ?>">
                                        <a href="<?= base_url(); ?>enquiry" class="btn btn-success" style="padding:6px;"
                                            title="Add Query B2B">
                                            <i class="fa fa-plus"></i> Add (B2B)</a>
                                        <a href="<?= base_url(); ?>enquiry_b2c" class="btn btn-success"
                                            style="padding:6px;" title="Add Query B2C">
                                            <i class="fa fa-plus"></i> Add (B2C)</a>
                                        <?php if(($this->session->userdata('type') == 1)){ ?>    
                                        <a href="<?= base_url('enquiry-excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-primary"
                                            style="padding:6px;" title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i> Download Excel</a>
                                        <?php } ?>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Search</h4>
                                            </div>

                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="location" id="location" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>
                                                        <?php
                                                        asort($locations);
                                                        foreach ($locations as $key => $val) { //$val[]='All'; 
                                                            if ($this->session->userdata('locations') == $key || $this->session->userdata('locations') == 'all') {
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="staff_id" id="staff_id" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>

                                                    </select>
                                                    <label class="mdl-textfield__label">Staff</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="booking_type" id="booking_type"
                                                        class="mdl-textfield__input" style="padding: 10px;">
                                                    </select>
                                                    <label class="mdl-textfield__label">Booking Type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">From</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'to', 'id' => 'to', 'placeholder' => '', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">To</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="followup_status" id="followup_status" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value=""></option>
                                                        <option value="pending">Pending</option>
                                                        <option value="in-progress">In-progress</option>
                                                        <option value="confirm">Confirm</option>
                                                        <option value="cancel-at-arrival">Cancel At Arrival</option>
                                                        <option value="not-materialized">Not materialized</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Status</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('company'))]); ?>
                                                    <label class="mdl-textfield__label">Company</label>
                                                </div>
                                                <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                            </div>

                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'mdl-textfield__input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                                    <label class="mdl-textfield__label">Query Number</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="<?=$this->input->get('country_id')?>">
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('state'))]) ?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="<?=$this->input->get('state_id')?>">

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('city'))]) ?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'value' => 'Search']); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-scrollable">

                                        <div class="row mb-3 prog-4">
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-black"><?php echo (isset($counts['pending']) ? $counts['pending'] : '0'); ?></span>
                                                Pending
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-perp"><?php echo (isset($counts['in-progress']) ? $counts['in-progress'] : '0'); ?></span>
                                                In-Progress
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-green"><?php echo (isset($counts['confirm']) ? $counts['confirm'] : '0'); ?></span>
                                                Confirm
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-orange"><?php echo (isset($counts['not-materialized']) ? $counts['not-materialized'] : '0'); ?></span>
                                                Not Materialized
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-danger"><?php echo (isset($counts['cancel-at-arrival']) ? $counts['cancel-at-arrival'] : '0'); ?></span>
                                                Cancel At Arrival
                                            </div>
                                        </div>

                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No.</th>
                                                    <th class="center">Query Received Date</th>
                                                    <th class="center">Query Entry Date/Time</th>
                                                    <th class="center">Query Number</th>
                                                    <th class="center">Handling File By</th>
                                                    <th class="center">Check-in</th>
                                                    <th class="center">Check-out</th>
                                                    <th class="center">Number Of Guests</th>
                                                    <th class="center">Agent Name</th>
                                                    <th class="center">Company</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $enquiries) {
                                                        
                                                        $where = ' arrival_room_details.enquiry_id = '.$enquiries->id;
                                                        $room_details = $this->common_model->get_data('arrival_room_details', '', '', '*', $where, '', $count = false);
                                                        $total_persons_accomodated = 0;
                                                        $actual_total = $enquiries->number_persons + $enquiries->number_child;
                                                        if(!empty($room_details)){
                                                            foreach($room_details AS $list){
                                                                $total_persons_accomodated = $total_persons_accomodated + ($list->number_adults * $list->number_of_rooms + $list->number_child * $list->number_of_rooms);
                                                            }
                                                        }else{
                                                            $total_persons_accomodated = $actual_total;
                                                        }
                                                        
                                                        
                                                        $records_cnt++;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->query_received_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php 
                                                                $d = explode(' ',$enquiries->date);
                                                                if($d[1] == '00:00:00'){
                                                                    echo date('d-M-Y', strtotime($enquiries->date));
                                                                }else {
                                                                    echo date('d-M-Y (h:i a)', strtotime($enquiries->date));
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo $enquiries->enquiry_no;
                                                                        if($enquiries->split_count > 0){
                                                                            echo ' <span class="badge bg-info" style="text-transform:capitalize;"> Split '.($enquiries->split_number+1).'</span>';
                                                                        }
                                                                ?>
                                                                <?php if(in_array($enquiries->follow_status,['pending','in-progress']) && in_array($this->session->userdata('id'),[14,13])){ ?>
                                                                    <br><a href="<?=base_url('quotation/?id='.base64_encode($enquiries->id)) ?>" class="btn-link" title="Make Quotation" style="padding:0 2px;font-size:10px;" target="_blank">Quotation</a>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->staff_name ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_in_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_out_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)' ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->contact_person ?></td>
                                                            <td class="center"><?= $enquiries->name ?></td>
                                                            <td class="center"><?= $enquiries->city ?></td>
                                                            <td class="center">
                                                                <?php
                                                                $status_color = ['pending' => '#000000', 'in-progress' => '#8795fb', 'confirm' => '#18ce0f', 'not-materialized' => '#f96332', 'cancel-at-arrival' => 'red'];
                                                                $status = $enquiries->follow_status;
                                                                //if(isset($arr[0]) && $arr[0]==''){ $status = 'pending'; }else{ $status = $arr[0]; }  ?>
                                                                <a class="btn btn-xs"
                                                                    style="background-color: <?= $status_color[$status] ?>;color:#FFF;"
                                                                    href="<?= base_url() . $enquiries->id . '/'; ?>followup"><?= ucfirst(str_replace('-', ' ', $status)) ?></a>

                                                            </td>

                                                            <td style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'flex'; ?>;">
                                                                <?php if ($status == 'confirm') {
                                                                    $url = base_url('add_arrival?enq_id=' . base64_encode($enquiries->id));
                                                                    $title = 'Add To Arrival Chart';
                                                                    $style = '';
                                                                    if ($enquiries->arrival_id <> '') {
                                                                        $url = base_url('edit_arrival?id=' . base64_encode($enquiries->arrival_id));
                                                                        $title = 'Edit Arrival Chart';
                                                                        $style = 'background-color:#ff8b47;';
                                                                    }
                                                                    ?>
                                                                    <a href="<?= $url ?>" class="btn btn-tbl-edit btn-xs"
                                                                        title="<?= $title ?>" style="<?= $style ?>"><i
                                                                            class="fa fa-plane"></i></a>
                                                                            
                                                                    <?php if($actual_total - $total_persons_accomodated > 0){ 
                                                                            $split_count = $enquiries->split_count + 1;
                                                                    ?>                                                                        
                                                                        <a href="<?= base_url('add_arrival?enq_id=' . base64_encode($enquiries->id).'&split='.base64_encode($split_count)); ?>" class="badge mt-1 mr-1" title="Split" style="color:#FFF;text-transform: none;"><i class="fa fa-plane"></i> Split</a>                                                                            
                                                                    <?php }} ?>
                                                                    <a href="<?= base_url() . $enquiries->id ?>/edit-enquiry"
                                                                        class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                            class="fa fa-edit"></i></a>
                                                                    <?php if ($this->session->userdata('type') == 1) { ?>
                                                                        <a href="<?= base_url() . $enquiries->id ?>/delete-enquiry"
                                                                            onclick="return confirm('Are you sure you want to delete this Enquiry?');"
                                                                            class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                                class="fa fa-trash-o"></i></a>
                                                                    <?php } ?>
                                                                    
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                    <?php echo $links; ?>
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

    <!-- end js include path -->
    <script>
        url = new URL(window.location.href);
        $(document).ready(function () {
            $("#location").on("change", function () {
                var v = $(this).find(':selected').attr('data-abbr');
                var selected;
                $("#booking_type").empty().parent().removeClass("is-dirty");
                if (v !== "" && v !== undefined) {
                    var opts = v.split(",");
                    $("#booking_type").parent().addClass("is-dirty");
                    $.each(opts, function (i, d) {
                        selected = (url.searchParams.get('booking_type')==d)?'selected="selected"':'';
                        $('#booking_type').append('<option value="' + d + '"'+selected+'>' + d + '</option>');
                    });
                    selected = (url.searchParams.get('booking_type')=="all")?'selected="selected"':'';
                    $('#booking_type').append('<option value="all" '+selected+'>All</option>');
                    get_staff();
                }
            });
            
            if (url.searchParams.has('location')) {
                $("#location").trigger("change");               
            }
            if (url.searchParams.has('followup_status')) {
                $("#followup_status").val(url.searchParams.get('followup_status'));               
            }
            /*$("#from").on("change",function(){
                var el = $(this);
                const selectedDate = new Date(el.val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
                $("#dt-from").val(formattedDate).parent().addClass('is-focused');
            });*/

            $(".dt-search").on("change", function () {
                var idx = $(this).index(".dt-search");
                const selectedDate = new Date($(".dt-search").eq(idx).val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                };
                const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
                $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

                if ($(this).attr("id") === "from" && $("#to").val() === "") {
                    $("#to").attr("min", $(this).val());
                } else if ($(this).attr("id") === "from" && $("#to").val() !== "") {
                    const selectedToDate = new Date($("#to").val());
                    if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                        $("#to").val('').attr("min", $(this).val());
                        $(".dt-search-show").eq($("#to").index(".dt-search")).val('');
                    }
                }
                if ($(this).attr("id") === "to" && $("#from").val() === "") {
                    $("#from").attr("max", $(this).val());
                } else if ($(this).attr("id") === "to" && $("#from").val() !== "") {
                    const selectedFromDate = new Date($("#from").val());
                    if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                        $("#from").val('').attr("max", $(this).val());
                        $(".dt-search-show").eq($("#from").index(".dt-search")).val('');
                    }
                }

            });


        });

        function get_staff() {
            if ($("#location").val() === "") {
                $("#staff_id").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/enquiry/get_staff",
                data: {
                    'location': $("#location").val()
                },
                dataType: "JSON",
                success: function (data) {
                    $("#staff_id").empty().parent().addClass("is-dirty");
                    var opts = data.details;
                    $.each(opts, function (i, d) {
                        $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
                            '</option>');
                    });
                    $('#staff_id').append('<option value="all">All</option>');
                },
                complete:function(){
                    $('#staff_id').val(url.searchParams.get('staff_id'));
                },
                error: function (jqXHR, textStatus, errorThrown) { }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#company").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {
                            response(data);
                            dt = data;
                            $(".err").html('');;
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#company').val(ui.item.label); // display the selected text
                    $('#company_id').val(ui.item.company_id); // save selected id to input
                }
            }).blur(function(event) {
                if($('#company').val()==''){
                    $('#company_id').val('');
                }               
            });
            var country_flag = false;
            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    country_flag = false;
                },
                select: function (event, ui) {
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input
                    country_flag = true;
                    return false;
                }
            }).blur(function(event) {
                if(country_flag==false){
                    $("#country").val("");
                }               
            });

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }
            var state_flag = false;
            $("#state").autocomplete({
                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    state_flag = false;
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    if (terms.length > 2) {
                        $("#city").val("").attr('disabled', 'disabled');
                    } else {
                        $("#city").removeAttr('disabled');
                        $('#state_id').val(ui.item.state_id);
                    } state_flag = true;
                    return false;

                    //$('#state').val(ui.item.label); // display the selected text
                    //$('#state_id').val(ui.item.state_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(state_flag==false){
                     $("#state").val("");
                }               
            });
            
            var city_flag = false;
            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            state_id: $('#state_id').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                    city_flag = false;
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    city_flag = true;
                    return false;

                    //$('#city').val(ui.item.label); // display the selected text
                    //$('#company_id').val(ui.item.company_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(city_flag==false){
                     $("#city").val("");
                }               
            });
        });
    </script>
</body>

</html>