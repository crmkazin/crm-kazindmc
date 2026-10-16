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
                                            class="table table-hover table-checkable order-column full-width details-table"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">File No.(Agent)</th>
                                                    <th class="center">Check In / Check Out</th>
                                                    <th class="center">Flight Details</th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>
    <script>
    $(document).ready(function() {

        var table = $('#example4').DataTable({
            "scrollX": true,
            //"scrollY": "200px",
            "pageLength": 10

        });


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
                    // Assuming response is structured as expected
                    responseData = response; // Store the response data
                    var tableBody = $('.details-table tbody');
                    tableBody.empty(); // Clear existing table rows

                    // Loop through the response data and append rows to the table
                    $.each(response.details.arrivals, function(index, item) {
                        var guideNames = '';

                        // Check if item.n is null or 0
                        if (item.n === null || item.n === 0) {
                            // Fetch guide names based on enquiry_id from response.details.guide_names
                            if (response.details.guide_names.hasOwnProperty(item
                                    .enquiry_id)) {
                                guideNames = response.details.guide_names[item.enquiry_id]
                                    .join(', ');
                            }
                        } else {
                            // Use item.n directly if it's not null or 0
                            guideNames = item.n;
                        }

                        var row = '<tr>' +
                            '<td class="center">' + (index + 1) + '</td>' +
                            '<td class="center">' + (item.enquiry_no !== null ? item
                                .enquiry_no + (item.filename ? '<br>(' + item.filename +
                                    ')' : '') : '-') + '</td>' +
                            '<td class="center">' + formatDate(item.check_in_date) +
                            '<br>' + formatDate(item.check_out_date) +
                            '</td>' +
                            '<td class="center">' + (item.departure_date !== null ? 'D- ' +
                                formatDate(item.departure_date) + '<br>A- ' + formatDate(
                                    item.flight_arrival_date) + '<br>(' + item.airline_name + ')' :
                                '-') + '</td>' +
                            '</td>' +
                            '<td class="center">' + formatDate(item.arrival_date) +
                            '</td>' +
                            '<td class="center">' + ((item.number_persons !== null ? item
                                    .number_persons : '-') + '+' +
                                (item.number_child !== null ? item.number_child : '-')) +
                            '</td>' +
                            '<td class="center">' + (item.hotel_name !== null ? item
                                .hotel_name : '-') + '</td>' +
                            '<td class="center">' + guideNames + '</td>' +
                            '<td class="center"><a href="' + item.id +
                            '/activity-log" class="btn btn-success btn-xs" target="_blank" " data-id="' +
                            item.id + '">Track</a></td>' +
                            '</tr>';
                        tableBody.append(row);
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