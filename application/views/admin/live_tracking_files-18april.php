<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <style>
    .img-width {
        max-width: 80px;
    }

    #file {
        max-height: 200px;
        /* Adjust height as needed */
        overflow-y: auto;
    }

    .page-content {
        background-image: url('assets/admin/images/map.png');
        /* Replace with your image path */
        background-size: cover;
        /* Adjust to cover the entire body */
        background-repeat: round;
        /* Prevent repeating */
    }

    .page-container-bg-solid .page-bar,
    .page-content-white .page-bar {
        background-color: transparent !important;
    }

    .page-bar {
        background-color: transparent !important;
    }
    </style>
    <!-- Include CSS files -->
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- Include header -->
        <?php include ('header.php'); ?>

        <div class="page-container">
            <!-- Include sidebar menu -->
            <?php include ('side_bar.php'); ?>

            <div class="page-content-wrapper">
                <div class="page-content" id="page-content" style="margin-top:-50px; ">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title text-danger">Live Tracking Files</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="">&nbsp;<a class="parent-item" href="<?= base_url(); ?>live-tracking">Live
                                        Tracking</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                                <li class="active"><a class="parent-item" href="">Live Tracking Files</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table
                                            class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">File No.(Agent)</th>
                                                    <th class="center">Check In / Check Out</th>
                                                    <!--<th class="center">Flight Details</th>-->
                                                    <th class="center">Physical Arrival</th>
                                                    <th class="center">No. Of Passengers</th>
                                                    <th class="center">Hotel</th>
                                                    <th class="center">Guide</th>
                                                    <th class="center remove">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

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
    <!-- end js include path -->

    <script>
        $(document).ready(function() {

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

            function getQueryParam(param) {
                var urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(param);
            }

            // Get selectedId from URL query parameters
            var date = getQueryParam('date');
            var enq_abbr = getQueryParam('enq_abbr');

            function loadFiles() {
                $.ajax({
                    url: '<?= base_url() ?>live-tracking-all-files/' + date + '/' + enq_abbr,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var responseData = response; // Store the response data
                        var tableBody = $('#example4 tbody');
                        tableBody.empty(); // Clear existing table rows

                        // Loop through the response data and append rows to the table
                        $.each(response.details.arrivals, function(index, item) {
                            var guideNames = '';

                            // Check if item.n is null or 0
                            if (item.n === null || item.n === 0) {
                                // Fetch guide names based on enquiry_id from response.details.guide_names
                                if (response.details.guide_names.hasOwnProperty(item.enquiry_id)) {
                                    guideNames = response.details.guide_names[item.enquiry_id].join(', ');
                                }
                            } else {
                                // Use item.n directly if it's not null or 0
                                guideNames = item.n;
                            }

                            // Fetch flight details for the current item
                            var flightDetails = '';
                            if (response.details.flight_details.hasOwnProperty(item.enquiry_id)) {
                                var flightDetailsArray = response.details.flight_details[item.enquiry_id];
                                if (flightDetailsArray.length > 0) {
                                    var firstFlight = flightDetailsArray[0];
                                    flightDetails = '<div class="flight-detail"><strong>Dep- </strong>' + formatDate(firstFlight.departure_date) +'<br><strong>From- </strong>' + firstFlight.departure_city +'('+firstFlight.departure_time+')' +'<br>(' + firstFlight.airline_name + '- ' + firstFlight.flight_mode + ')' + 
                                                    '<br><strong>Arr- </strong>' + formatDate(firstFlight.flight_arrival_date) +'<br><strong>To- </strong>' + firstFlight.arrival_city +'('+firstFlight.arrival_time+')'+'<br>(' + firstFlight.airline_name + '- ' + firstFlight.flight_mode + ')</div>';
                                    
                                    if (flightDetailsArray.length > 1) {
                                        flightDetails += '<a href="#" class="see-more" data-enquiry-id="' + item.enquiry_id + '">See More</a>';
                                        var hiddenFlights = '';
                                        for (var i = 1; i < flightDetailsArray.length; i++) {
                                            var flight = flightDetailsArray[i];
                                            hiddenFlights = '<div class="hidden-flight-detail" style="display: none;"><strong>Dep- </strong>' + formatDate(flight.departure_date) +'<br><strong>From- </strong>' + flight.departure_city +'('+flight.departure_time+')' +'<br>(' + flight.airline_name + '- ' + flight.flight_mode + ')' + 
                                            '<br><strong>Arr- </strong>' + formatDate(flight.flight_arrival_date) +'<br><strong>To- </strong>' + firstFlight.arrival_city +'('+ flight.arrival_time+')'+'<br>(' + flight.airline_name + '- ' + flight.flight_mode + ')</div>';    
                                        }
                                        flightDetails += hiddenFlights;
                                    }
                                }
                            }

                            // Construct the table row
                            var row = '<tr>' +
                                '<td class="center">' + (index + 1) + '</td>' + // Row number
                                '<td class="center">' + (item.enquiry_no !== null ? item.enquiry_no + (item.filename ? '<br>(' + item.filename + ')' : '') : '-') + '</td>' + // Enquiry number and filename
                                '<td class="center">' + formatDate(item.check_in_date) + '<br>' + formatDate(item.check_out_date) + '</td>' + // Check-in and check-out dates
                                // '<td class="center">' + (flightDetails !== '' ? flightDetails : '-') + '</td>' + // Flight details
                                '<td class="center">' + (item.arrival_date ? formatDate(item.arrival_date) : '-') + '</td>' + // Arrival date
                                '<td class="center">' + ((item.number_persons !== null ? item.number_persons : '-') + '+' + (item.number_child !== null ? item.number_child : '-')) + '</td>' + // Number of persons and children
                                '<td class="center">' + (item.hotel_name !== null ? item.hotel_name : '-') + '</td>' + // Hotel name
                                '<td class="center">' + guideNames + '</td>' + // Guide names
                                '<td class="center"><a href="' + item.id + '/activity-log" class="btn btn-success btn-xs" target="_blank" data-id="' + item.id + '">Track</a></td>' + // Track link
                                '</tr>';

                            // Append the row to the table body
                            tableBody.append(row);
                        });

                        // Add click event listener for "See More" links
                        $('.see-more').on('click', function(e) {
                            e.preventDefault();
                            var enquiryId = $(this).data('enquiry-id');
                            $(this).siblings('.hidden-flight-detail').slideDown();
                            $(this).remove();
                        });

                        $('#example4').DataTable({
                            "scrollX": true,
                            "pageLength": 10
                        });
                    },
                    error: function() {
                        console.log('Error fetching data');
                    }
                });
            };

            loadFiles();

        });
    </script>

</body>

</html>