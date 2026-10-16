<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
<style>
    .dataTables_scrollHeadInner {
        width: auto !important;
    }
    .dataTable thead th[class*=sorting]:after{display: none !important;}

</style>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Hotel Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Vendor</a></li>
                                    <li class="breadcrumb-item active">Hotel Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include('report_links.php'); ?>
                    <?php if ($this->session->flashdata('message') <> '') {
                        echo $this->session->flashdata('message');
                    } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                              
                                <form method="get">
                                    <div class="card-body row">
                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Location</label>
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
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id" value="">
                                    
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">State</label>
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="state_id" id="state_id" value="">

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Hotel</label>
                                                <select name="hotel" id="hotel" class="mdl-textfield__input js-example-basic-multiple" style="padding: 10px;">
                                                    <option value="">Select Hotel</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_from')]) ?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php //echo form_error('date_from'); ?>
                                            </div-->
											
                                            <label class="mdl-textfield__label">From</label>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:100%;"
													value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
											</div>
											
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_to')]) ?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php //echo form_error('date_to'); ?>
                                            </div-->
											
                                            <label class="mdl-textfield__label">To</label>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:100%;"
													value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'dts dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right;position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
											</div>
											
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Report Type</label>
                                                <select name="report_type" id="report_type" class="mdl-textfield__input" style="padding: 10px;" required>
                                                    <option value="all" <?php echo ($this->input->get('report_type')=='all')?'selected="selected"':''; ?>>All</option>
                                                    <option value="individual" <?php echo ($this->input->get('report_type')=='individual')?'selected="selected"':''; ?>>Individual (FIT)</option>
                                                    <option value="group" <?php echo ($this->input->get('report_type')=='group')?'selected="selected"':''; ?>>Group (GIT)</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary mt-4', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            <a class="btn btn-primary mb-2 mt-4 p-2" style="padding:4px 8px;float:right;" href="<?php echo base_url('vendor-report?excel_download=1&submit=submit&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i> </a>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">

                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable order-column full-width"
                                            id="hotel_report">
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
                                                            <td class="center"><?= $list->hotel_name ?></td>
                                                            <td class="center"><?= $list->address ?></td>
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
                                                                echo $list->total_room_nights;
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
                                    id="vendor_hotel_report">
                                    <thead>
                                        <tr>
                                            <th class="center">Sr.No</th>
                                            <th class="center">Enquiry No.</th>
                                            <th class="center">Checkin Date</th>
                                            <th class="center">Checkout Date</th>
                                            <th class="center">Hotel</th>
                                            <!--<th class="center">Category</th>-->
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

    </div>
 <script>
        var url = new URL(window.location.href);
        $(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Select..',
            });
        });
        
        $(document).ready(function() {
            $('#myModal').on('shown.bs.modal', function () {
                $('#vendor_hotel_report').DataTable({
                    responsive: true,
                    destroy: true
                });
            });

            $("#hotel_report").DataTable({
                responsive: true,
                paging: false,
                info: false,
            }); 

            const allowedCountryIds = {
                'armenia': 11,
                'kazakhstan': 112,
                'georgia': 81,
                'belarus': 20,
                'azerbaijan': 15
            };

            $("#location").on("change", function() {
                var v = $(this).val();
                if (allowedCountryIds.hasOwnProperty(v)) {
                    $("#country_id").val(allowedCountryIds[v]);
                } else {
                    $("#country_id").val('');
                }

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

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#state").autocomplete({
            source: function (request, response) {
                var country_id = $('#country_id').val();
                // if (!country_id) {
                // alert("Please select country");
                // $('#state').val('');
                // $('#state_id').val('');
                // return; 
                // }
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
                }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $("#city").autocomplete({
            source: function (request, response) {
                var state_id = $('#state').val();
                // if (!state_id) {
                //     alert("Please select state");
                //     $('#city').val('');
                //     return; 
                // }
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
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
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

            // $('.view-details-btn').on('click', function() {

            //     // Destroy existing DataTable instance if it exists
            //     if ($.fn.DataTable.isDataTable('#example4')) {
            //         $('#example4').DataTable().clear().destroy();
            //     }

            //     var hotelId = $(this).data('hotel_id');
            //     const urlParams = new URLSearchParams(window.location.search);

            //     // Function to format date
            //     function formatDate(dateStr) {
            //         var options = {
            //             year: 'numeric',
            //             month: '2-digit',
            //             day: '2-digit'
            //         };
            //         return new Date(dateStr).toLocaleDateString(undefined, options);
            //     }

            //     // AJAX request to fetch data
            //     $.ajax({
            //         url: '<?php //echo base_url() ?>admin/report/booking_room_details_data',
            //         type: 'GET',
            //         data: {
            //             hotelId: hotelId,
            //             'date_from': urlParams.get('date_from'),
            //             'date_to': urlParams.get('date_to'),
            //             'report_type' : urlParams.get('report_type'),
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             var tableBody = $('.room-detail-table tbody');
            //             tableBody.empty();
            //             var reportName = ''; // Define a meaningful report name if needed

            //             // Object to track unique enquiry_no and aggregate data
            //             var aggregatedData = {};

            //             // Iterate over the response data to aggregate
            //             $.each(response.details.arrival_room_details, function(index, item) {
            //                 // Generate a unique key for the enquiry_no
            //                 var uniqueKey = item.enquiry_no;

            //                 if (index === 0) {
            //                     reportName = item.name; // Get the name from the first item
            //                 }

            //                 // Check if this enquiry_no exists in the aggregatedData
            //                 if (!aggregatedData[uniqueKey]) {
            //                     // Initialize the data for this enquiry_no
            //                     aggregatedData[uniqueKey] = {
            //                         enquiry_no: item.enquiry_no,
            //                         checkin_date: item.checkin_date,
            //                         checkout_date: item.checkout_date,
            //                         name: item.name,
            //                         category: item.category,
            //                         number_adults: 0, //item.number_adults,
            //                         number_child: 0,//item.number_child,
            //                         total_room_nights: 0, // Initialize room nights count
            //                         number_of_rooms : 0
            //                     };
            //                 }

            //                 // Calculate the difference in days between checkin_date and checkout_date
            //                 var checkinDate = new Date(item.checkin_date);
            //                 var checkoutDate = new Date(item.checkout_date);
            //                 var timeDiff = checkoutDate.getTime() - checkinDate.getTime();
            //                 var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert time difference to days

            //                 // Multiply the difference in days by the number of rooms
            //                 var totalDaysMultipliedByRooms = dayDiff * parseInt(item.number_of_rooms, 10);

            //                 // Aggregate the total room nights for this enquiry_no
            //                 aggregatedData[uniqueKey].total_room_nights += totalDaysMultipliedByRooms;
            //                 aggregatedData[uniqueKey].number_adults += parseInt(item.number_adults);
            //                 aggregatedData[uniqueKey].number_child += parseInt(item.number_child);
            //                 aggregatedData[uniqueKey].number_of_rooms += parseInt(item.number_of_rooms);
            //             });

            //             // Initialize a counter for row index
            //             var rowIndex = 1;

            //             // Create rows from aggregated data
            //             $.each(aggregatedData, function(key, item) {
            //                 // Construct the table row
            //                 var row = '<tr>' +
            //                     '<td class="center">' + rowIndex + '</td>' +
            //                     '<td class="center">' + item.enquiry_no + '</td>' +
            //                     '<td class="center">' + formatDate(item.checkin_date) + '</td>' +
            //                     '<td class="center">' + formatDate(item.checkout_date) + '</td>' +
            //                     '<td class="center">' + item.name + '</td>' +
            //                     '<td class="center">' + item.category + '</td>' +
            //                     '<td class="center <?php //echo ($this->input->get('report_type')=='group')?'hide':''; ?>">' + item.number_adults + '+' + item.number_child + '</td>' +
            //                     '<td class="center">'+item.number_of_rooms+'</td>' +
            //                     '<td class="center">' + item.total_room_nights + '</td>' +
            //                     '</tr>';

            //                 // Append the row to the table body
            //                 tableBody.append(row);

            //                 // Increment the rowIndex counter
            //                 rowIndex++;
            //             });

            //             // Initialize DataTable with new data
            //             $('#example4').DataTable({
            //                 "scrollX": true,
            //                 "scrollY": true,
            //                 "pageLength": 10
            //             });

            //             // Set up the export button click event
            //             $('#export_to_excel').off('click').on('click', function() {
            //                 var clonedTable = $('<table>');

            //                 // Construct the table header
            //                 var header = '<tr>' +
            //                     '<th>Sr.No.</th>' +
            //                     '<th>Enquiry No</th>' +
            //                     '<th>Check-in Date</th>' +
            //                     '<th>Check-out Date</th>' +
            //                     '<th>Name</th>' +
            //                     '<th>Category</th>' +
            //                     <?php //if($this->input->get('report_type')!='group'){ ?>
            //                     '<th>Passengers(A+C)</th>' +
            //                     <?php //} ?>
            //                     '<th>Number of Rooms</th>' +
            //                     '<th>Room Nights</th>' +
            //                     '</tr>';
            //                 clonedTable.append(header);

            //                 // Construct the table rows for export from aggregated data
            //                 var exportIndex = 1;
            //                 $.each(aggregatedData, function(key, item) {
            //                     var row = '<tr>' +
            //                         '<td class="center">' + exportIndex + '</td>' +
            //                         '<td class="center">' + item.enquiry_no + '</td>' +
            //                         '<td class="center">' + formatDate(item.checkin_date) + '</td>' +
            //                         '<td class="center">' + formatDate(item.checkout_date) + '</td>' +
            //                         '<td class="center">' + item.name + '</td>' +
            //                         '<td class="center">' + item.category + '</td>' +
            //                         <?php //if($this->input->get('report_type')!='group'){ ?>
            //                         '<td class="center">' + item.number_adults + '+' + item.number_child + '</td>' +
            //                         <?php //} ?>
            //                         '<td class="center">'+item.number_of_rooms+'</td>' +
            //                         '<td class="center">' + item.total_room_nights + '</td>' +
            //                         '</tr>';

            //                     clonedTable.append(row);
            //                     exportIndex++;
            //                 });

            //                 // Export the cloned table using table2excel plugin
            //                 clonedTable.table2excel({
            //                     preserveColors: true,
            //                     filename: reportName + ".xls"
            //                 });
            //             });
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error:', error);
            //         }
            //     });

            // });
            
            // 🔁 Attach modal cleanup ONCE when DOM is ready
        $('#myModal').on('hidden.bs.modal', function () {
            $('.room-detail-table tbody').empty();
            if ($.fn.DataTable.isDataTable('#vendor_hotel_report')) {
                $('#vendor_hotel_report').DataTable().clear().destroy();
            }
        });

            $('.view-details-btn').on('click', function () {
                var hotelId = $(this).data('hotel_id');
                const urlParams = new URLSearchParams(window.location.search);

                // Optional: Show modal here (before AJAX or after success, your choice)
                $('#myModal').modal('show');

                function formatDate(dateStr) {
                    var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                    return new Date(dateStr).toLocaleDateString(undefined, options);
                }

                $.ajax({
                    url: '<?php echo base_url() ?>admin/report/booking_room_details_data',
                    type: 'GET',
                    data: {
                        hotelId: hotelId,
                        date_from: urlParams.get('date_from'),
                        date_to: urlParams.get('date_to'),
                        report_type: urlParams.get('report_type'),
                    },
                    dataType: 'json',
                    // success: function (response) {
                    //     var tableBody = $('.room-detail-table tbody');
                    //     tableBody.empty();

                    //     let reportName = '';
                    //     let aggregatedData = {};

                    //     $.each(response.details.arrival_room_details, function (index, item) {
                    //         var uniqueKey = item.enquiry_no;

                    //         if (index === 0) {
                    //             reportName = item.name;
                    //         }

                    //         if (!aggregatedData[uniqueKey]) {
                    //             aggregatedData[uniqueKey] = {
                    //                 enquiry_no: item.enquiry_no,
                    //                 checkin_date: item.checkin_date,
                    //                 checkout_date: item.checkout_date,
                    //                 name: item.name,
                    //                 category: item.category,
                    //                 number_adults: 0,
                    //                 number_child: 0,
                    //                 total_room_nights: 0,
                    //                 number_of_rooms: 0
                    //             };
                    //         }

                    //         var checkin = new Date(item.checkin_date);
                    //         var checkout = new Date(item.checkout_date);
                    //         var dayDiff = Math.ceil((checkout - checkin) / (1000 * 3600 * 24));
                    //         var roomNights = dayDiff * parseInt(item.number_of_rooms);

                    //         aggregatedData[uniqueKey].total_room_nights += roomNights;
                    //         aggregatedData[uniqueKey].number_adults += parseInt(item.number_adults);
                    //         aggregatedData[uniqueKey].number_child += parseInt(item.number_child);
                    //         aggregatedData[uniqueKey].number_of_rooms += parseInt(item.number_of_rooms);
                    //     });

                    //     let rowIndex = 1;

                    //     $.each(aggregatedData, function (key, item) {
                    //         var row = `
                    //             <tr>
                    //                 <td class="center">${rowIndex}</td>
                    //                 <td class="center">${item.enquiry_no}</td>
                    //                 <td class="center">${formatDate(item.checkin_date)}</td>
                    //                 <td class="center">${formatDate(item.checkout_date)}</td>
                    //                 <td class="center">${item.name}</td>
                    //                 <td class="center">${item.category}</td>
                    //                 <td class="center <?php echo ($this->input->get('report_type')=='group')?'hide':''; ?>">
                    //                     ${item.number_adults}+${item.number_child}
                    //                 </td>
                    //                 <td class="center">${item.number_of_rooms}</td>
                    //                 <td class="center">${item.total_room_nights}</td>
                    //             </tr>
                    //         `;
                    //         tableBody.append(row);
                    //         rowIndex++;
                    //     });

                    //     // ✅ Destroy and reinitialize DataTable
                    //     if ($.fn.DataTable.isDataTable('#vendor_hotel_report')) {
                    //         $('#vendor_hotel_report').DataTable().clear().destroy();
                    //     }

                    //     // $('#example4').DataTable({
                    //     //     scrollX: true,
                    //     //     scrollY: true,
                    //     //     pageLength: 10
                    //     // });

                    //     // ✅ Setup export
                    //     $('#export_to_excel').off('click').on('click', function () {
                    //         var clonedTable = $('<table>');
                    //         var header = `
                    //             <tr>
                    //                 <th>Sr.No.</th>
                    //                 <th>Enquiry No</th>
                    //                 <th>Check-in Date</th>
                    //                 <th>Check-out Date</th>
                    //                 <th>Name</th>
                    //                 <th>Category</th>
                    //                 <?php if($this->input->get('report_type')!='group'){ ?>
                    //                 <th>Passengers(A+C)</th>
                    //                 <?php } ?>
                    //                 <th>Number of Rooms</th>
                    //                 <th>Room Nights</th>
                    //             </tr>
                    //         `;
                    //         clonedTable.append(header);

                    //         let exportIndex = 1;
                    //         $.each(aggregatedData, function (key, item) {
                    //             var row = `
                    //                 <tr>
                    //                     <td>${exportIndex}</td>
                    //                     <td>${item.enquiry_no}</td>
                    //                     <td>${formatDate(item.checkin_date)}</td>
                    //                     <td>${formatDate(item.checkout_date)}</td>
                    //                     <td>${item.name}</td>
                    //                     <td>${item.category}</td>
                    //                     <?php if($this->input->get('report_type')!='group'){ ?>
                    //                     <td>${item.number_adults}+${item.number_child}</td>
                    //                     <?php } ?>
                    //                     <td>${item.number_of_rooms}</td>
                    //                     <td>${item.total_room_nights}</td>
                    //                 </tr>
                    //             `;
                    //             clonedTable.append(row);
                    //             exportIndex++;
                    //         });

                    //         clonedTable.table2excel({
                    //             preserveColors: true,
                    //             filename: reportName + ".xls"
                    //         });
                    //     });
                    // },
                    // error: function (xhr, status, error) {
                    //     console.error('Error:', error);
                    // }
                    success: function (response) {
					var tableBody = $('.room-detail-table tbody');
					tableBody.empty();

					let reportName = '';
					let aggregatedData = {}; // Initialize aggregatedData object

					// Process each item and aggregate by enquiry_no
					$.each(response.details.arrival_room_details, function (index, item) {
						if (index === 0) {
							reportName = item.hotel_name || item.name || 'Hotel Report';
						}

						// Store data in aggregatedData for export
						if (!aggregatedData[item.enquiry_no]) {
							aggregatedData[item.enquiry_no] = {
								enquiry_no: item.enquiry_no,
								min_checkin_date: item.min_checkin_date || item.checkin_date,
								max_checkout_date: item.max_checkout_date || item.checkout_date,
								hotel_name: item.hotel_name || item.name,
								total_adults: parseInt(item.total_adults || item.number_adults || 0),
								total_children: parseInt(item.total_children || item.number_child || 0),
								total_rooms: parseInt(item.total_rooms || item.number_of_rooms || 0),
								total_room_nights: parseInt(item.total_room_nights || 
									(function() {
										// Calculate room nights if not provided
										var checkin = new Date(item.min_checkin_date || item.checkin_date);
										var checkout = new Date(item.max_checkout_date || item.checkout_date);
										var dayDiff = Math.ceil((checkout - checkin) / (1000 * 3600 * 24));
										return dayDiff * parseInt(item.total_rooms || item.number_of_rooms || 1);
									})()
								)
							};
						} else {
							// If same enquiry_no appears multiple times, sum up values
							aggregatedData[item.enquiry_no].total_adults += parseInt(item.total_adults || item.number_adults || 0);
							aggregatedData[item.enquiry_no].total_children += parseInt(item.total_children || item.number_child || 0);
							aggregatedData[item.enquiry_no].total_rooms += parseInt(item.total_rooms || item.number_of_rooms || 0);
							aggregatedData[item.enquiry_no].total_room_nights += parseInt(item.total_room_nights || 
								(function() {
									var checkin = new Date(item.min_checkin_date || item.checkin_date);
									var checkout = new Date(item.max_checkout_date || item.checkout_date);
									var dayDiff = Math.ceil((checkout - checkin) / (1000 * 3600 * 24));
									return dayDiff * parseInt(item.total_rooms || item.number_of_rooms || 1);
								})()
							);
						}

						// Add row to table (using aggregated or individual data based on your preference)
						// For display, you might want to show individual records or aggregated ones
						var row = `
							<tr>
								<td class="center">${index + 1}</td>
								<td class="center">${item.enquiry_no}</td>
								<td class="center">${formatDate(item.min_checkin_date || item.checkin_date)}</td>
								<td class="center">${formatDate(item.max_checkout_date || item.checkout_date)}</td>
								<td class="center">${item.hotel_name || item.name}</td>
								<td class="center <?php echo ($this->input->get('report_type')=='group')?'hide':''; ?>">
									${parseInt(item.total_adults || item.number_adults || 0)}+${parseInt(item.total_children || item.number_child || 0)}
								</td>
								<td class="center">${item.total_rooms || item.number_of_rooms || 0}</td>
								<td class="center">${item.total_room_nights || 
									(function() {
										var checkin = new Date(item.min_checkin_date || item.checkin_date);
										var checkout = new Date(item.max_checkout_date || item.checkout_date);
										var dayDiff = Math.ceil((checkout - checkin) / (1000 * 3600 * 24));
										return dayDiff * parseInt(item.total_rooms || item.number_of_rooms || 1);
									})()
								}</td>
							</tr>
						`;
						tableBody.append(row);
					});

					// Setup export button AFTER table is populated
					$('#export_to_excel').off('click').on('click', function () {
						var clonedTable = $('<table>');
						var header = `
							<tr>
								<th>Sr.No.</th>
								<th>Enquiry No</th>
								<th>Check-in Date</th>
								<th>Check-out Date</th>
								<th>Hotel Name</th>
						`;
						
						// Conditionally add passenger column
						<?php if($this->input->get('report_type')!='group'){ ?>
						header += `<th>Passengers (A+C)</th>`;
						<?php } ?>
						
						header += `
								<th>Number of Rooms</th>
								<th>Room Nights</th>
							</tr>
						`;
						
						clonedTable.append(header);

						let exportIndex = 1;
						$.each(aggregatedData, function (key, item) {
							var row = `
								<tr>
									<td>${exportIndex}</td>
									<td>${item.enquiry_no}</td>
									<td>${formatDate(item.min_checkin_date)}</td>
									<td>${formatDate(item.max_checkout_date)}</td>
									<td>${item.hotel_name}</td>
							`;
							
							<?php if($this->input->get('report_type')!='group'){ ?>
							row += `<td>${item.total_adults}+${item.total_children}</td>`;
							<?php } ?>
							
							row += `
									<td>${item.total_rooms}</td>
									<td>${item.total_room_nights}</td>
								</tr>
							`;
							
							clonedTable.append(row);
							exportIndex++;
						});

						// Make sure table2excel is loaded and working
						if (typeof clonedTable.table2excel === 'function') {
							clonedTable.table2excel({
								preserveColors: true,
								filename: reportName + ".xls"
							});
						} else {
							console.error('table2excel function not found! Make sure the library is loaded.');
							alert('Export library not loaded. Please check the console for errors.');
						}
					});
				},
				error: function (xhr, status, error) {
					console.error('Error:', error);
					alert('Error loading data. Please try again.');
				}
                });
            });


            $('.close-modal').on('click', function() {
                // Destroy existing DataTable instance if it exists
                if ($.fn.DataTable.isDataTable('#vendor_hotel_report')) {
                    $('#vendor_hotel_report').DataTable().clear().destroy();
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