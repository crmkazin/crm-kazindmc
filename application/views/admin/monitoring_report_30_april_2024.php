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
                                                <label class="mdl-textfield__label">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="staff_id" id="staff_id" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select...</option>

                                                </select>
                                                <label class="mdl-textfield__label">Staff</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="booking_type" id="booking_type"
                                                    class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">Select...</option>
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
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="agent" id="agent" class="mdl-textfield__input">
                                                    <option value="">Select..</option>
                                                </select>
                                                <label class="mdl-textfield__label">Select Agent</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="sales" id="sales" class="mdl-textfield__input">
                                                    <option value="0">Select..</option>
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
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type'=>'date', 'name'=>'date_from','placeholder'=>'','id'=>'check_in', 'class'=>'dts mdl-textfield__input'])?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php echo form_error('check_in');?>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
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
                                                <select name="status" id="status" class="mdl-textfield__input">
                                                    <option value="">Select Status</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="in-progress">In-progress</option>
                                                    <option value="confirm">Confirm</option>
                                                    <option value="not-materialized">Not materialized</option>
                                                    <option value="cancel-at-arrival">Cancel at Arrival</option>
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
                                                    <th class="center"><strong>Company</strong></th>
                                                    <?php if(!empty($enquiry[0]->contact_person)):?>
                                                    <th class="center"><strong>Agent Name</strong></th>
                                                    <?php endif ?>
                                                    <th class="center"><strong>Total Files</strong></th>
                                                    <th class="center"><strong>Pending Files</strong></th>
                                                    <th class="center"><strong>In-Progress Files</strong></th>
                                                    <th class="center"><strong>Confirm Files</strong></th>
                                                    <th class="center"><strong>Cancel Files</strong></th>
                                                    <th class="center"><strong>Not-Materialized Files</strong>
                                                    </th>
                                                    <th class="center"><strong>Billing Amount USD</strong></th>
                                                    <th class="center"><strong>Recieved Amount USD</strong>
                                                    </th>
                                                    <th class="center"><strong>Billing Amount INR</strong>
                                                    <th class="center"><strong>Recieved Amount INR</strong>
                                                    </th>
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
                                                    <td class="center"><?=$enquiries->name?></td>
                                                    <?php if(!empty($enquiry[0]->contact_person)):?>
                                                    <td class="center"><?=$enquiries->contact_person?></td>
                                                    <?php endif ?>
                                                    <!-- <td class="center">
                                                        <?=date('d-M-Y',strtotime($enquiries->check_in_date))?>
                                                    </td> -->
                                                    <td class="center"><?=$enquiries->total_files?></td>
                                                    <td class="center">
                                                        <?=$enquiries->total_pending_files?>
                                                    </td>
                                                    <td class="center"><?=$enquiries->total_in_progress_files?></td>
                                                    <td class="center"><?=$enquiries->total_confirm_files?></td>

                                                    <td class="center">
                                                        <?=$enquiries->total_cancelled_files?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->total_not_materialized_files?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->total_billing_amount_in_dollar?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->billing_balance_difference_in_dollar?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->total_billing_amount_in_inr?>
                                                    </td>
                                                    <td class="center">
                                                        <?=$enquiries->billing_balance_difference_in_inr?>
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
                get_agents();
                
            }
        });

        function get_agents() {
            if ($("#company_id").val() === "") {
                $("#agent").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/company/get_branch_ajax",
                data: {
                    'company': $("#company_id").val()
                },
                success: function(data) {
                    $("#agent").empty().parent().addClass("is-dirty");
                    $('#agent').append('<option value="">Select..</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#agent').append('<option value="' + d.company_id +
                            '" data-id="' + d.company_id + '">' + d
                            .contact_person + '</option>');
                    });

                },
                complete: function() {
                    $("#agent option[data-id='<?php echo $enquiries->company_details_id; ?>']")
                        .prop(
                            "selected", true);
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