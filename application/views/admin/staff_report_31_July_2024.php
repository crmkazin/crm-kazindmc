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
                                    <?php if(!empty($status_uri)):?>
                                    <div class="float-right">
                                        <a href="<?php echo base_url('admin/report/staff_export_excel?' . $this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                    <?php endif;?>
                                </div>

                                <div class="card-body">
                                    <form method="get">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="staff" id="staff" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select..</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Staff</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="staff_id" id="staff_id" value="">

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="country" id="country" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select..</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="country_id" id="country_id" value="">

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">From
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">To
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 p-t-20 text-center">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row mb-3 prog-4">
                                        <div class="col-lg-2 mt-2">
                                            <strong>Staff Name:</strong> <?= !empty($staff) ? $staff : 'None'; ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <strong>Form date: </strong> <?= !empty($date_from) ? date('d-M-Y', strtotime($date_from)) : ''; ?>
                                            <br>
                                            <strong>To date: </strong><?= !empty($date_from) ? date('d-M-Y', strtotime($date_from)) : ''; ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="line-num text-white bg-perp status-span" data-status="in-progress"><?php echo (isset($progress_files) ? $progress_files : '0'); ?></span>
                                            In-Progress
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="line-num text-white bg-green status-span" data-status="complete"><?php echo (isset($confirm_files) ? $confirm_files : '0'); ?></span>
                                            Complete
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="line-num text-white bg-danger status-span" data-status="cancel"><?php echo (isset($cancelled_files) ? $cancelled_files : '0'); ?></span>
                                            Cancel
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="line-num text-white status-span" style="background-color:#b20783;" data-status="file-closed"><?php echo (isset($closed_files) ? $closed_files : '0'); ?></span>
                                            File Closed
                                        </div>
                                    </div>


                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">S.No.</th>
                                                    <th class="center">Query <br>Number</th>
                                                    <th class="center">Physical <br>Arrival<br> Date</th>
                                                    <th class="center">Number Of<br> Nights</th>
                                                    <th class="center">Handling <br>Staff <br>Name</th>
                                                    <th class="center">Hotel <br>Name </th>
                                                    <th class="center">Transportation</th>
                                                    <th class="center">Guide</th>
                                                    <th class="center">Group <br>Type</th>
                                                    <th class="center">Handover <br>To <br>Client</th>
                                                    <th class="center">Nos. of<br>Guests</th>
                                                    <th class="center">Company Name</th>
                                                    <?php  //if(in_array($this->session->userdata('type'),['1','3'])){ 
                                                    if ($this->session->userdata('email') != 'vishal@kazindmc.com') {
                                                    ?>
                                                        <th class="center">Currency</th>
                                                        <th class="center">Client <br>Billing</th>
                                                        <th class="center">Payment <br>Received <br>In India</th>
                                                        <th class="center">Payment <br>Received <br>In Other</th>
                                                        <th class="center">Balance <br>Amount</th>
                                                        <th class="center">Payment Remarks</th>
                                                    <?php } ?>
                                                    <th class="center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = $offset + 1;
                                                    foreach ($result as $list) {
                                                        $records_cnt++;

                                                        $enq_id = $list->enquiry_id;
                                                        $where = 'arrival_flight_details.enquiry_id= ' . $enq_id . ' GROUP BY flight_mode';
                                                        $select = 'SUM(arrival_flight_details.number_persons) AS person_cnt,arrival_flight_details.flight_mode';
                                                        $flight_details = $this->common_model->get_data('arrival_flight_details', '', '', $select, $where, '', $count = false);
                                                        //echo '<pre>';print_r($flight_details);

                                                        $arrival_date = date_create($list->arrival_date);
                                                        $days_to_add = $list->number_of_nights + 1;
                                                        date_add($arrival_date, date_interval_create_from_date_string($days_to_add . ' days'));
                                                        $d1_arrival = date_format($arrival_date, 'Y-m-d');
                                                        $d2_today = date('Y-m-d');
                                                        $auto_updated = 0;
                                                        if ($d1_arrival < $d2_today && $list->status == 'in-progress' /*&& $list->enquiry_no=='FAZ3706'*/) {
                                                            $update_arr = array('status' => 'complete');
                                                            $id = $list->id;
                                                            $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
                                                            $affected_rows = $this->common_model->update_data_limit($update_data);
                                                            if ($affected_rows) {
                                                                $list->status = 'complete';
                                                                $auto_updated = 1;
                                                            }
                                                        }
                                                        if ($d1_arrival < $d2_today && $list->status == 'complete' && $list->balance_amount == '0' /*&& $list->enquiry_no=='FAZ3706'*/) {
                                                            $update_arr = array('status' => 'file-closed');
                                                            $id = $list->id;
                                                            $update_data = ['table_name' => 'arrivals', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
                                                            $affected_rows = $this->common_model->update_data_limit($update_data);
                                                            if ($affected_rows) {
                                                                $list->status = 'file-closed';
                                                                $auto_updated = 1;
                                                            }
                                                        }

                                                        $where = 'arrival_hotel_details.enquiry_id = ' . $enq_id;
                                                        $select = 'arrival_hotel_details.hotel_name';
                                                        $hotel = $this->common_model->get_data('arrival_hotel_details', '', '', $select, $where, ' ORDER BY arrival_hotel_details.id ASC LIMIT 1', $count = false);
                                                        $hotel_name = (!empty($hotel) ? $hotel[0]->hotel_name : '');

                                                        $where = 'payment_details.arrival_id= ' . $list->id;
                                                        $select = 'payment_details.remarks';
                                                        $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $select, $where, ' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
                                                        $remarks = (!empty($payment_details_remarks)) ? $payment_details_remarks[0]->remarks : '';

                                                        $where = 'enquiry_transport.enquiry_id= ' . $enq_id . ' ORDER BY enquiry_transport.id ASC LIMIT 1 ';
                                                        $join = [['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id']];
                                                        $trans_details = $this->common_model->get_data('enquiry_transport', '', '', 'transportation.vehicle_type', $where, '', $count = false, $join);

                                                        $where = 'enquiry_guide.enquiry_id= ' . $enq_id . ' ORDER BY enquiry_guide.id ASC';
                                                        $join = [['type' => '', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id']];
                                                        $guide_details = $this->common_model->get_data('enquiry_guide', '', '', 'guides.name', $where, '', $count = false, $join);
                                                        $guides = [];
                                                        if (!empty($guide_details)) {
                                                            foreach ($guide_details as $guide_list) {
                                                                $guides[] = $guide_list->name;
                                                            }
                                                        }
                                                        if ($list->guide <> '') {
                                                            $guides[] = $list->guide;
                                                        }

                                                ?>
                                                        <?php
                                                        $status_color = ['in-progress' => '#663399', 'complete' => '#18ce0f', 'cancel' => '#FF3636', 'file-closed' => '#b20783'];
                                                        $status = $list->status;
                                                        ?>

                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>

                                                            <?php if ($status == "cancel") { ?>

                                                                <td class="center" style="background-color: <?= $status_color[$status] ?>;">
                                                                    <?= $list->enquiry_no ?></td>
                                                                <td class="center" style="background-color: <?= $status_color[$status] ?>;">
                                                                    <?= date('d-M-Y', strtotime($list->arrival_date)) ?></td>
                                                            <?php } else { ?>
                                                                <td class="center"><?= $list->enquiry_no ?></td>
                                                                <td class="center">
                                                                    <?= date('d-M-Y', strtotime($list->arrival_date)) ?></td>
                                                            <?php } ?>
                                                            <td class="center"><?= $list->number_of_nights ?></td>
                                                            <td class="center"><?= $list->staff_name ?></td>
                                                            <td class="center"><?= $hotel_name ?></td>
                                                            <td class="center">
                                                                <?php if ($list->vehicle_type <> '') {
                                                                    echo $list->vehicle_type;
                                                                } else if (!empty($trans_details)) {
                                                                    echo $trans_details[0]->vehicle_type;
                                                                } ?></td>
                                                            <td class="center">
                                                                <?php //if($list->guide<>''){ echo $list->guide;}
                                                                if (!empty($guides)) {
                                                                    if (count($guides) == 1) {
                                                                        echo $guides[0];
                                                                    } else {
                                                                        $div = '<div class="guide-hide">' . $guides[0] . ' ..<button class="btn btn-xs btn-primary btn-more">more</button></div>';
                                                                        $div .= '<div class="guide-show" style="display:none;">' . implode(', ', $guides) . ' <button class="btn btn-xs btn-danger btn-less">less</button></div>';
                                                                        echo $div;
                                                                    }
                                                                } else {
                                                                    echo '<i class="fa fa-user-times" aria-hidden="true" title="No Guide" style="color: #ffb1b1;"></i>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center"><?= $list->group_type ?></td>
                                                            <td class="center"><?= $list->handover_to_client ?></td>
                                                            <td class="center">
                                                                <?= (($list->number_persons == '') ? '0' : $list->number_persons) + (($list->number_child == '') ? '0' : $list->number_child) ?>
                                                            </td>
                                                            <td class="center"><?= $list->name ?></td>
                                                            <?php  //if(in_array($this->session->userdata('type'),['1','3'])){ 
                                                            if ($this->session->userdata('email') != 'vishal@kazindmc.com') {
                                                            ?>
                                                                <td class="center"><?= $list->currency ?></td>
                                                                <td class="center"><?= $list->client_billing ?></td>
                                                                <td class="center"><?= (int)$list->payment_received_india + (int)$list->paymentreceived_india ?></td>
                                                                <td class="center"><?= (int)$list->payment_received_almaty + (int)$list->paymentrecieved_in_other ?></td>
                                                                <td class="center"><?= $list->balance_amount ?></td>
                                                                <td class="center"><?= $remarks ?></td>
                                                            <?php } ?>
                                                            <td class="center">
                                                                <a class="btn btn-xs" style="background-color: <?= $status_color[$status] ?>;color:#FFF;" href="#">
                                                                    <?php echo ucfirst($status); ?>
                                                                </a>
                                                                <?php if ($list->remarks <> '') {
                                                                    $div = '<div class="remarks-hide"><span style="font-size: 9px;font-weight: bold;">Remarks..</span> <button class="btn btn-xs btn-primary btn-remarks-show">show</button></div>';
                                                                    $div .= '<div class="remarks-show" style="display:none;">' . $list->remarks . ' <button class="btn btn-xs btn-danger btn-remarks-hide">hide</button></div>';
                                                                    echo $div;
                                                                } ?>
                                                                <?php if ($auto_updated) { ?>
                                                                    <span class="badge badge-warning"><i class="fa fa-hand-o-right"></i> Auto-updated At
                                                                        <?php echo date('Y-m-d H:i:s'); ?></span>
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
                                    <?php //echo 'Showing '.$records_cnt.' of '.$total.' Records'; 
                                    ?>
                                    <?php echo $links; ?></div>
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

            function staffFetch() {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/report/get_staff',
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.details) {
                            var select = $('#staff');
                            select.empty(); // Clear previous options
                            select.append('<option value=""> Select </option>');
                            $.each(response.details, function(i, details) {
                                select.append('<option value="' + details.name + '" data-id="' + details.id + '">' + details.name + '</option>');
                            });
                        } else {
                            console.error('Unexpected response format:', response); // Debugging log for unexpected response format
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error); // Debugging log
                    }
                });
            }

            staffFetch();

            // Handle change event of #staff select
            $('#staff').click(function() {
                var selectedOption = $(this).find(':selected');
                var selectedStaffId = selectedOption.data('id'); // Get data-id attribute
                $('#staff_id').val(selectedStaffId); // Set selected ID to #staff_id input
                countryFetch(); // Fetch countries based on selected staff
            });

            function capitalizeFirstLetter(string) {
                return string.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }


            function countryFetch() {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/report/get_country_by_staff',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        staff_id: $('#staff_id').val(),
                    },
                    success: function(response) {
                        if (response && response.details) {
                            var select = $('#country');
                            select.empty(); // Clear previous options
                            $.each(response.details, function(i, details) {
                                var capitalizedLocation = details.location.charAt(0).toUpperCase() + details.location.slice(1);
                                select.append('<option value="' + details.id + '">' + capitalizedLocation + '</option>');
                            });
                        } else {
                            console.error('Unexpected response format:', response); // Debugging log for unexpected response format
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error); // Debugging log
                    }
                });
            }

            // Handle change event of #country select
            $('#country').change(function() {
                var selectedOption = $(this).find(':selected');
                var selectedCountryId = selectedOption.data('id'); // Get data-id attribute
                $('#country_id').val(selectedCountryId); // Set selected ID to #country_id input
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSpans = document.querySelectorAll('.status-span');

        statusSpans.forEach(function (span) {
            span.addEventListener('click', function () {
                const status = this.getAttribute('data-status');
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('status', status);

                // If you want to keep other parameters in the URL, you can get them from the current URL
                const staff = urlParams.get('staff') || '';
                const staff_id = urlParams.get('staff_id') || '';
                const country = urlParams.get('country') || '';
                const country_id = urlParams.get('country_id') || '';
                const date_from = urlParams.get('date_from') || '';
                const date_to = urlParams.get('date_to') || '';

                // Construct the new URL
                const newUrl = `<?php echo base_url()?>staff-report?staff=${staff}&staff_id=${staff_id}&country=${country}&country_id=${country_id}&date_from=${date_from}&date_to=${date_to}&status=${status}&submit=Search`;
                window.location.href = newUrl;
            });
        });
    });
</script>

</body>

</html>