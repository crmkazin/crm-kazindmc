<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
    <style>
        .dataTables_paginate .page-item>.page-link {
            padding: 0 12px !important;
        }

        .form-control {
            border: 1px solid #ede5e5 !important;
        }

        .bg-previous_confirm {
            color: #fff;
            background-color: #2CA8FF;
        }
    </style>
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php include('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Staff Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Staff Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Staff Report</header>
                                    <?php if (!empty($status_uri)) { ?>
                                        <div class="float-right">
                                            <a href="<?php echo base_url('admin/report/staff_export_excel?' . $this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel" target="_blank">
                                                <i class="fa fa-download"></i> Excel Download</a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="float-right">
                                            <a href="<?php echo base_url('admin/report/staff_count_excel?' . $this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel" target="_blank">
                                                <i class="fa fa-download"></i> Excel Download</a>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="card-body">
                                    <form method="get">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="location" id="location" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select..</option>
                                                        <?php
                                                        asort($locations);
                                                        foreach ($locations as $key => $val) {
                                                            $val[] = 'All'; ?>
                                                            <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>">
                                                                <?= ucfirst($key) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="staff_id" id="staff_id" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select...</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Staff</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input', 'required' => 'required']) ?>
                                                    <label class="mdl-textfield__label">From
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input', 'required' => 'required']) ?>
                                                    <label class="mdl-textfield__label">To
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20 text-center">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- <?php if ($this->input->get('submit') <> '' && empty($this->input->get('status'))) : ?> -->
                                        <?php if ($staff_data) {
                                            $i = 1; ?>
                                            <?php foreach ($staff_data as $staff) { ?>
                                                <div class="row mb-4 prog-4" style="background-color:#f7f7f7 !important;">
                                                    <div class="col-lg-4 mt-4">
                                                        <?= $i++; ?>). <strong>Staff Name:</strong> <?= $staff['name'] ? $staff['name'] : 'N/A'; ?>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white bg-dark status-span" style="cursor:pointer;" data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="total">
                                                            <?= ($staff['future_confirm'] + $staff['confirm'] + $staff['pending'] + $staff['not_materialized']); ?>
                                                        </span>
                                                        Total Files
                                                    </div>
                                                    <div class="offset-1"></div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white bg-green status-span" style="cursor:pointer;" data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="confirm">
                                                            <?= $staff['confirm']; ?>
                                                        </span>
                                                        Confirm
                                                    </div>
                                                    <div class="offset-1"></div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white bg-perp status-span" data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="pending">
                                                            <?= $staff['pending']; ?>
                                                        </span>
                                                        Pending
                                                    </div>
                                                    <div class="offset-4"></div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white bg-danger status-span" data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="not_materialized">
                                                            <?= $staff['not_materialized']; ?>
                                                        </span>
                                                        Not Materialized
                                                    </div>
                                                    <div class="offset-1"></div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white status-span bg-previous_confirm"  data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="future_confirm">
                                                            <?= $staff['future_confirm']; ?>
                                                        </span>
                                                        Future Confirm
                                                    </div>
                                                    <div class="offset-1"></div>
                                                    <div class="col-lg-2">
                                                        <span class="line-num text-white status-span" style="background-color:#b20783;" data-staff_id="<?= $staff['file_handle_by'] ?>" data-status="previous_confirm">
                                                            <?= $staff['previous_confirm']; ?>
                                                        </span>
                                                        Previous Confirm
                                                    </div>
                                                    <div class="offset-1"></div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="row mb-3 pt-2 prog-4">
                                                <div class="col-lg-12 mt-2 text-center">
                                                    <p><strong>No record found !</strong></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <!-- <?php endif; ?> -->

                                    <?php if (!empty($this->input->get('status'))) { ?>
                                        <div class="table-scrollable">
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
                                                    <!-- <th class="center">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $enquiries) {
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
                                                            <td class="center"><?= $enquiries->enquiry_no ?></td>
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
                                                                    href="#"><?= ucfirst(str_replace('-', ' ', $status)) ?></a>

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
                                    <?php echo $links; ?></div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
    <script>
        $(document).ready(function() {

            $("#location").on("change", function() {
                get_staff();
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
                    success: function(data) {
                        $("#staff_id").empty().parent().addClass("is-dirty");
                        var opts = data.details;
                        $.each(opts, function(i, d) {
                            $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
                                '</option>');
                        });
                        $('#staff_id').append('<option value="all">All</option>');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSpans = document.querySelectorAll('.status-span');

            statusSpans.forEach(function(span) {
                span.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    const staff_id = this.getAttribute('data-staff_id');
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('status', status);

                    // If you want to keep other parameters in the URL, you can get them from the current URL
                    const location = urlParams.get('location') || '';
                    const date_from = urlParams.get('date_from') || '';
                    const date_to = urlParams.get('date_to') || '';

                    // Construct the new URL
                    const newUrl = `staff-report?location=${location}&staff_id=${staff_id}&date_from=${date_from}&date_to=${date_to}&status=${status}&submit=Search`;
                    window.open(newUrl, '_blank');
                });
            });
        });
    </script>

</body>

</html>