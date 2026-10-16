<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php');?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php');?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php include('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Arrivals Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Arrivals Report</li>
                            </ol>
                        </div>
                    </div>
                    <!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>
 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Search Queries</header>
                                    <div class="tools">
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a id="export_to_excel">Export to excel</a>
                                    </div>
                                </div>
                                <form method="get">
                                    <div class="card-body row">
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    <?php 
                                                    asort($locations);
                                                    foreach($locations AS $key=>$val){ $val[]='All'; ?>
                                                    <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>">
                                                        <?= ucfirst($key)?></option>
                                                    <?php } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="staff_id" id="staff_id" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value=""></option>

                                                </select>
                                                <label class="mdl-textfield__label">Staff</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="booking_type" id="booking_type"
                                                    class="mdl-textfield__input" style="padding: 10px;">
                                                </select>
                                                <label class="mdl-textfield__label">Booking Type</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>
                                                <label
                                                    class="mdl-textfield__label">Company</label><?php echo form_error('company');?>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id">
                                        </div>
                                        <!-- <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="agent" id="agent" class="mdl-textfield__input">
                                                    <option value=""></option>
                                                </select>
                                                <label class="mdl-textfield__label">Select Agent</label>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="sales" id="sales" style="padding-top: 30px;"
                                                    class="mdl-textfield__input">
                                                    <option value="">Select..</option>
                                                </select>
                                                <label class="mdl-textfield__label">Sales Team</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="company_details_id" id="company_details_id" value="">
                                        <!-- <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name'=>'agent_name','id'=>'agent_name', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                <label class="mdl-textfield__label">Agent</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="company_details_id" id="company_details_id" value=""> -->
                                         <div class="col-lg-3" style="padding-top: 37px;">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type'=>'date', 'name'=>'date_from','placeholder'=>'','id'=>'check_in', 'class'=>'dts mdl-textfield__input'])?>
                                                <label class="mdl-textfield__label">From
                                                    Date</label><?php echo form_error('check_in');?>

                                            </div>
                                        </div>

                                        <div class="col-lg-3" style="padding-top: 37px;">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type'=>'date', 'name'=>'date_to','placeholder'=>'','id'=>'check_out', 'class'=>'dts mdl-textfield__input'])?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php echo form_error('check_out');?>

                                            </div>
                                        </div>
                                        <!-- 
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                <?php echo form_input(['name'=>'state','id'=>'state',  'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                <label class="mdl-textfield__label">State</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="state_id" id="state_id" value=""> -->

                                        <!-- <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name'=>'city','type'=>'text','id' =>'city', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                <label class="mdl-textfield__label">City</label>
                                            </div>
                                        </div> -->

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="guide" id="guide" class="mdl-textfield__input"
                                                    style="padding-top: 30px;">
                                                    <option value="">Select..</option>
                                                </select>
                                                <label class="mdl-textfield__label">Guide</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="transport" id="transport" class="mdl-textfield__input"
                                                    style="padding-top: 30px;">
                                                    <option value="">Select..</option>
                                                </select>
                                                <label class="mdl-textfield__label">Transport</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="status" id="status" class="mdl-textfield__input"
                                                    style="padding-top: 30px;">
                                                    <option value="">Select..</option>
                                                    <option value="in-progress"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>
                                                        In-progress</option>
                                                    <option value="complete"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>
                                                        Complete</option>
                                                    <option value="cancel"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>
                                                        Cancel</option>
                                                    <option value="file-closed"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>
                                                        File Closed</option>
                                                </select>
                                                <label class="mdl-textfield__label">Status</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary', 'style'=>'float:left;', 'value'=>'Search']);?>
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
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>File No.</strong></th>
                                                    <!-- <th class="center"><strong>Travel Date</strong></th> -->
                                                    <th class="center"><strong>Physical Date</strong></th>
                                                    <th class="center"><strong>Handling By</strong></th>
                                                    <th class="center"><strong>Check In</strong></th>
                                                    <th class="center"><strong>Check Out</strong></th>
                                                    <th class="center"><strong>No. Of Nights</strong></th>
                                                    <!-- <th class="center"><strong>Agent Name</strong></th> -->
                                                    <th class="center"><strong>Company</strong></th>
                                                    <th class="center"><strong>Guide</strong></th>
                                                    <th class="center"><strong>Transportation</strong></th>
                                                    <th class="center"><strong>Biling Amount</strong></th>
                                                    <th class="center"><strong>Status</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php     
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $enquiries) {
                                                        $records_cnt++;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                    <td class="center"><?=$enquiries->enquiry_no?></td>
                                                    <td class="center">
                                                        <?=date('d-M-Y',strtotime($enquiries->check_in_date))?>
                                                    </td>
                                                    <td class="center"><?=$enquiries->staff_name?></td>
                                                    <td class="center">
                                                        <?=date('d-M-Y',strtotime($enquiries->check_in_date))?>
                                                    </td>
                                                    <td class="center">
                                                        <?=date('d-M-Y',strtotime($enquiries->check_out_date))?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->number_of_nights?>
                                                    </td>
                                                    <td class="center"><?=$enquiries->name?></td>
                                                    <td class="center"><?=$enquiries->guide?></td>

                                                    <td class="center">
                                                        <?=$enquiries->vehicle_type?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->balance_amount?>
                                                    </td>

                                                    <td class="center">
                                                        <?php
                                                    $status_color = ['in-progress'=>'#663399','complete'=>'#18ce0f','cancel'=>'#FF3636','file-closed'=>'#b20783'];
                                                    $arrivals_status = $enquiries->status;
                                                    //if(isset($arr[0]) && $arr[0]==''){ $status = 'pending'; }else{ $status = $arr[0]; }  ?>
                                                        <a class="btn btn-xs"
                                                            style="background-color: <?=$status_color[$arrivals_status]?>;color:#FFF;"
                                                            href=""><?=ucfirst($arrivals_status)?></a>
                                                    </td>

                                                </tr>
                                                <?php } }	?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
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
        <?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php');?>
    <!-- end js include path -->

    <!-- suggesstion Script -->
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
<script>
    $(document).ready(function() {
        $("#company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?=base_url()?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_sales();
            }
        });

        function get_sales() {
            if ($("#company_id").val() === "") {
                $("#sales").empty();
                return false;
            }
            var sales_id = "<?php echo $enquiries->sales_admin_id; ?>";
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/company/get_sales",
                data: {
                    'company': $("#company_id").val()
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#sales").empty().append('<option value="0">Select..</option>').parent()
                        .addClass(
                            "is-dirty");
                    $.each(data["details"].sales_team, function(i, d) {

                        $('#sales').append('<option value="' + d.id + '" ' + ((d.id ==
                                sales_id) ? "selected" : '') + '>' + d.name +
                            '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        }
    });
    </script>


    <script>

        $("#location").on("change", function() {
            var v = $(this).find(':selected').attr('data-abbr');
            $("#booking_type").empty().parent().removeClass("is-dirty");
            if (v !== "" && v !== undefined) {
                var opts = v.split(",");
                $("#booking_type").parent().addClass("is-dirty");
                $.each(opts, function(i, d) {
                    $('#booking_type').append('<option value="' + d + '">' + d + '</option>');
                });
                get_staff();
            }
        });

        function get_staff() {
            if ($("#location").val() === "") {
                $("#staff_id").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/enquiry/get_staff",
                data: {
                    'location': $("#location").val()
                },
                dataType: "JSON",
                success: function(data) {
                    $("#staff_id").empty().parent().addClass("is-dirty");
                    var opts = data.details;
                    $.each(opts, function(i, d) {
                        $('#staff_id').append('<option value="' + d['id'] + '">' + d[
                                'name'] +
                            '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        }

        $(document).ready(function() {
            $.ajax({
                url: 'admin/report/get_transportation',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response && response.response === 's' && response.details.length >
                        0) {
                        var select = $('#transport');
                        //select.empty(); // Clear existing options
                        $.each(response.details, function(index, item) {
                            select.append($('<option></option>').val(item.id).text(
                                item.vehicle_type));
                        });
                    } else {
                        console.error('Error: Invalid response format or empty data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });


        $(document).ready(function() {
            $.ajax({
                url: 'admin/report/get_guide',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response && response.response === 's' && response.details.length >
                        0) {
                        var select = $('#guide');
                        //select.empty(); // Clear existing options
                        $.each(response.details, function(index, item) {
                            select.append($('<option></option>').val(item.id).text(
                                item.name + ' ' + item.last_name));
                        });
                    } else {
                        console.error('Error: Invalid response format or empty data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });


        $(".dts").on("change", function() {
            if ($('.dts:eq(0)').val() === "" || $('.dts:eq(1)').val() === "") {
                return false;
            }
            const pre = new Date($('.dts:eq(0)').val());
            const last = new Date($('.dts:eq(1)').val());
            if (pre > last) {
                alert('Check-in date must be less than Check-out date.');
                $(".dts").val('');
            } else {
                const diffInMs = Math.abs(last - pre);
                const diffInDays = Math.round(diffInMs / (1000 * 60 * 60 * 24));
                $("#number_of_nights").val(diffInDays);
            }
        });

    </script>

</body>

</html>