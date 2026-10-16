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
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
    <style>
        .dataTables_scrollHeadInner {
            width: auto !important;
        }
    </style>
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                <div class="page-title">Hotel Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Hotel Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php if ($this->session->flashdata('message') <> '') {
                        echo $this->session->flashdata('message');
                    } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Hotel Report</header>
                                    <div class="float-right hide">
                                        <a href="<?php echo base_url('vendor-excel-download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                </div>
                                <form method="get">
                                    <div class="card-body row">
                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input"
                                                    style="padding: 10px;" required>
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($locations);
                                                    foreach ($locations as $key => $val) {
                                                        if ($key != 'all') {  ?>
                                                            <option value="<?= $key ?>" <?php echo ($this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                                <?= ucfirst($key) ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="hotel" id="hotel" class="mdl-textfield__input js-example-basic-multiple" style="padding: 10px;">
                                                    <option value="">Select Hotel</option>
                                                </select>
                                                <label class="mdl-textfield__label">Hotel</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_from')]) ?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php //echo form_error('date_from'); ?>
                                            </div-->
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;"
													value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:20px;float:right;']) ?>
												<label class="mdl-textfield__label">From</label>
											</div>
											
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_to')]) ?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php //echo form_error('date_to'); ?>
                                            </div-->
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;"
													value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:20px;float:right;']) ?>
												<label class="mdl-textfield__label">To</label>
											</div>
											
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="report_type" id="report_type" class="mdl-textfield__input" style="padding: 10px;" required>
                                                    <option value="individual" <?php echo ($this->input->get('report_type')=='individual')?'selected="selected"':''; ?>>Individual (FIT)</option>
                                                    <option value="group" <?php echo ($this->input->get('report_type')=='group')?'selected="selected"':''; ?>>Group (GIT)</option>
                                                </select>
                                                <label class="mdl-textfield__label">Report Type</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">

                                    <div class="table-scrollable">
                                        <a class="btn btn-primary mb-2" style="padding:4px 8px;float:right;" href="<?php echo base_url('vendor-report?excel_download=1&submit=submit&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i> Excel</a>
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Hotel Name</strong></th>
                                                    <th class="center"><strong>Address</strong></th>
                                                    <th class="center"><strong>City</strong></th>
                                                    <th class="center"><strong>State</strong></th>
                                                    <th class="center"><strong>Country</strong></th>
                                                    <th class="center"><strong>Rooms Nights</strong></th>
                                                    <th class="center"><strong>Action</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($vendor_report)) {
                                                    $i = $offset + 1;
                                                    foreach ($vendor_report as $list) {
                                                        $records_cnt++;
                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= $list->name ?></td>
                                                            <td class="center"><?= $list->address_1 ?></td>
                                                            <td class="center"><?= $list->city ?></td>
                                                            <td class="center"><?= $list->state ?></td>
                                                            <td class="center"><?= $list->country ?></td>
                                                            <td class="center">
                                                                <?php
                                                                /*$number_nights = 0;
                                                                $check_dates =  explode(',', $list->check_dates);
                                                                if (!empty($check_dates)) {
                                                                    foreach ($check_dates as $date_list) {
                                                                        $explode_data = explode('__', $date_list);

                                                                        $d = explode('to', $explode_data[0]);
                                                                        $date_checkin = new DateTime(trim($d[0]));
                                                                        $date_checkout = new DateTime(trim($d[1]));
                                                                        $interval = $date_checkin->diff($date_checkout);
                                                                        //echo '<pre>';print_r($interval);
                                                                        //$number_nights = ($number_nights + ($interval->d * (int)$explode_data[1]));
                                                                        $number_nights = $number_nights + $interval->d;
                                                                    }
                                                                }*/
                                                                echo $list->number_nights;
                                                                ?>
                                                            </td>

                                                            <td class="center">
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#myModal" id="" data-hotel_id="<?= $list->hotel_id ?>"
                                                                    class="btn btn-info view-details-btn p-1"><i class="fa fa-eye text-dark"></i>
                                                                </button>
                                                            </td>
                                                            <!--td class="center"><?php //echo $list->enquiry_ids 
                                                                                    ?></td-->
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

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width: 950px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card-head">
                                <div class="tools">
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a id="export_to_excel">Export to excel</a>
                                </div>
                            </div>
                            <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body ui-front">
                            <div class="table-scrollable">
                                <table class="table table-hover table-checkable order-column full-width room-detail-table"
                                    id="example4">
                                    <thead>
                                        <tr>
                                            <th class="center">Sr.No</th>
                                            <th class="center">Enquiry No.</th>
                                            <th class="center">Checkin Date</th>
                                            <th class="center">Checkout Date</th>
                                            <th class="center">Hotel</th>
                                            <th class="center">Category</th>
                                            <th class="center <?php echo ($this->input->get('report_type')=='group')?'hide':''; ?>">Passengers(A+C)</th>
                                            <th class="center">No. of Rooms</th>
                                            <th class="center">Room Nights</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body content -->
                                    </tbody>
                                </table>
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
    <!-- end js include path -->

    <!-- suggesstion Script -->
    <!-- jQuery UI -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        var url = new URL(window.location.href);
        $(function() {
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Select..',
                //width: '450px'
            });
        });
        
        $(document).ready(function() {

            $("#location").on("change", function() {
                var v = $(this).val();
                $("#hotel").empty().parent().removeClass("is-dirty");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('get_hotels'); ?>",
                    data: {
                        'location': v
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var opts = data.details;
                        $('#hotel').append('<option value="">Select..</option>');
                        $.each(opts, function(i, d) {
                            $('#hotel').append('<option value="' + d.id + '">' + d.name + '</option>');
                        });
                    },
                    complete:function(){ 
                        $('#hotel').val(url.searchParams.get('hotel')).select2(); 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });

            });
            
            if (url.searchParams.has('location')) {
                $("#location").trigger("change");                
            }

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
                const monthNames = [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
                    "Aug", "Sept", "Oct", "Nov", "Dec"
                ];
                const month = monthNames[date.getMonth()]; // Get the month name
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            $('.view-details-btn').on('click', function() {

                // Destroy existing DataTable instance if it exists
                if ($.fn.DataTable.isDataTable('#example4')) {
                    $('#example4').DataTable().clear().destroy();
                }

                var hotelId = $(this).data('hotel_id');
                const urlParams = new URLSearchParams(window.location.search);

                // Function to format date
                function formatDate(dateStr) {
                    var options = {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    };
                    return new Date(dateStr).toLocaleDateString(undefined, options);
                }

                // AJAX request to fetch data
                $.ajax({
                    url: '<?php echo base_url() ?>admin/report/booking_room_details_data',
                    type: 'GET',
                    data: {
                        hotelId: hotelId,
                        'date_from': urlParams.get('date_from'),
                        'date_to': urlParams.get('date_to'),
                        'report_type' : urlParams.get('report_type'),
                    },
                    dataType: 'json',
                    success: function(response) {
                        var tableBody = $('.room-detail-table tbody');
                        tableBody.empty();
                        var reportName = ''; // Define a meaningful report name if needed

                        // Object to track unique enquiry_no and aggregate data
                        var aggregatedData = {};

                        // Iterate over the response data to aggregate
                        $.each(response.details.arrival_room_details, function(index, item) {
                            // Generate a unique key for the enquiry_no
                            var uniqueKey = item.enquiry_no;

                            if (index === 0) {
                                reportName = item.name; // Get the name from the first item
                            }

                            // Check if this enquiry_no exists in the aggregatedData
                            if (!aggregatedData[uniqueKey]) {
                                // Initialize the data for this enquiry_no
                                aggregatedData[uniqueKey] = {
                                    enquiry_no: item.enquiry_no,
                                    checkin_date: item.checkin_date,
                                    checkout_date: item.checkout_date,
                                    name: item.name,
                                    category: item.category,
                                    number_adults: 0, //item.number_adults,
                                    number_child: 0,//item.number_child,
                                    total_room_nights: 0, // Initialize room nights count
                                    number_of_rooms : 0
                                };
                            }

                            // Calculate the difference in days between checkin_date and checkout_date
                            var checkinDate = new Date(item.checkin_date);
                            var checkoutDate = new Date(item.checkout_date);
                            var timeDiff = checkoutDate.getTime() - checkinDate.getTime();
                            var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert time difference to days

                            // Multiply the difference in days by the number of rooms
                            var totalDaysMultipliedByRooms = dayDiff * parseInt(item.number_of_rooms, 10);

                            // Aggregate the total room nights for this enquiry_no
                            aggregatedData[uniqueKey].total_room_nights += totalDaysMultipliedByRooms;
                            aggregatedData[uniqueKey].number_adults += parseInt(item.number_adults);
                            aggregatedData[uniqueKey].number_child += parseInt(item.number_child);
                            aggregatedData[uniqueKey].number_of_rooms += parseInt(item.number_of_rooms);
                        });

                        // Initialize a counter for row index
                        var rowIndex = 1;

                        // Create rows from aggregated data
                        $.each(aggregatedData, function(key, item) {
                            // Construct the table row
                            var row = '<tr>' +
                                '<td class="center">' + rowIndex + '</td>' +
                                '<td class="center">' + item.enquiry_no + '</td>' +
                                '<td class="center">' + formatDate(item.checkin_date) + '</td>' +
                                '<td class="center">' + formatDate(item.checkout_date) + '</td>' +
                                '<td class="center">' + item.name + '</td>' +
                                '<td class="center">' + item.category + '</td>' +
                                '<td class="center <?php echo ($this->input->get('report_type')=='group')?'hide':''; ?>">' + item.number_adults + '+' + item.number_child + '</td>' +
                                '<td class="center">'+item.number_of_rooms+'</td>' +
                                '<td class="center">' + item.total_room_nights + '</td>' +
                                '</tr>';

                            // Append the row to the table body
                            tableBody.append(row);

                            // Increment the rowIndex counter
                            rowIndex++;
                        });

                        // Initialize DataTable with new data
                        $('#example4').DataTable({
                            "scrollX": true,
                            "scrollY": true,
                            "pageLength": 10
                        });

                        // Set up the export button click event
                        $('#export_to_excel').off('click').on('click', function() {
                            var clonedTable = $('<table>');

                            // Construct the table header
                            var header = '<tr>' +
                                '<th>Sr.No.</th>' +
                                '<th>Enquiry No</th>' +
                                '<th>Check-in Date</th>' +
                                '<th>Check-out Date</th>' +
                                '<th>Name</th>' +
                                '<th>Category</th>' +
                                <?php if($this->input->get('report_type')!='group'){ ?>
                                '<th>Passengers(A+C)</th>' +
                                <?php } ?>
                                '<th>Number of Rooms</th>' +
                                '<th>Room Nights</th>' +
                                '</tr>';
                            clonedTable.append(header);

                            // Construct the table rows for export from aggregated data
                            var exportIndex = 1;
                            $.each(aggregatedData, function(key, item) {
                                var row = '<tr>' +
                                    '<td class="center">' + exportIndex + '</td>' +
                                    '<td class="center">' + item.enquiry_no + '</td>' +
                                    '<td class="center">' + formatDate(item.checkin_date) + '</td>' +
                                    '<td class="center">' + formatDate(item.checkout_date) + '</td>' +
                                    '<td class="center">' + item.name + '</td>' +
                                    '<td class="center">' + item.category + '</td>' +
                                    <?php if($this->input->get('report_type')!='group'){ ?>
                                    '<td class="center">' + item.number_adults + '+' + item.number_child + '</td>' +
                                    <?php } ?>
                                    '<td class="center">'+item.number_of_rooms+'</td>' +
                                    '<td class="center">' + item.total_room_nights + '</td>' +
                                    '</tr>';

                                clonedTable.append(row);
                                exportIndex++;
                            });

                            // Export the cloned table using table2excel plugin
                            clonedTable.table2excel({
                                preserveColors: true,
                                filename: reportName + ".xls"
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });

            });

            $('.close-modal').on('click', function() {
                // Destroy existing DataTable instance if it exists
                if ($.fn.DataTable.isDataTable('#example4')) {
                    $('#example4').DataTable().clear().destroy();
                }
            });
			
		$(".dt-search").on("change", function () {
			var idx = $(this).index(".dt-search");
			const selectedDate = new Date($(".dt-search").eq(idx).val());
			if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
			//const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
			const options = {
				year: 'numeric',
				month: 'short',
				day: '2-digit'
			};
			const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
			$(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

			if ($(this).attr("id") === "date_from" && $("#date_to").val() === "") {
				$("#date_to").attr("min", $(this).val());
			} else if ($(this).attr("id") === "date_from" && $("#date_to").val() !== "") {
				const selectedToDate = new Date($("#date_to").val());
				if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
					$("#date_to").val('').attr("min", $(this).val());
					$(".dt-search-show").eq($("#date_to").index(".dt-search")).val('');
				}
			}
			if ($(this).attr("id") === "date_to" && $("#date_from").val() === "") {
				$("#date_from").attr("max", $(this).val());
			} else if ($(this).attr("id") === "date_to" && $("#date_from").val() !== "") {
				const selectedFromDate = new Date($("#date_from").val());
				if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
					$("#date_from").val('').attr("max", $(this).val());
					$(".dt-search-show").eq($("#date_from").index(".dt-search")).val('');
				}
			}

		});
			
        });
    </script>

</body>

</html>