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
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Live Tracking</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"><a class="parent-item" href="">Live Tracking</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-body">
                                    <form method="get" autocomplete="off">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20"></div>
                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php
                                                    $today = date('Y-m-d'); // Get today's date in the format 'YYYY-MM-DD'
                                                    echo form_input(['name' => 'date', 'type' => 'date', 'id' => 'date', 'class' => 'mdl-textfield__input', 'value' => $today]);
                                                    ?>
                                                    <label class="mdl-textfield__label" for="date">Date</label>
                                                </div>
                                            </div>



                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select class="mdl-textfield__input" name="file" id="file" required>
                                                    </select>
                                                    <label class="mdl-textfield__label">File Number</label>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <div class="table-scrollable">
                                        <table
                                            class="table table-hover table-checkable order-column full-width details-table"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">File No.</th>
                                                    <th class="center">Check In</th>
                                                    <th class="center">Check Out</th>
                                                    <th class="center">No. Of Passengers</th>
                                                    <th class="center">Hotel</th>
                                                    <th class="center">Guide</th>
                                                    <th class="center remove">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->

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

        function fetchFiles(selectedDate) {
            $.ajax({
                url: '<?= base_url() ?>files/' + selectedDate,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var select = $('#file');
                    select.empty(); // Clear any existing options
                    $.each(response.details, function(index, item) {
                        var option = $('<option></option>').val(item.id).text(item
                            .enquiry_no);
                        select.append(option);
                    });
                    $('#file').trigger('click');
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        }

        $('#date').on('change', function() {
            var selectedDate = $(this).val();
            fetchFiles(selectedDate);
        });

        function formatDate(dateStr) {
        const date = new Date(dateStr);
        const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
        const monthNames = [
            "January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"
        ];
        const month = monthNames[date.getMonth()]; // Get the month name
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
        }


        $('#file').on('click', function() {
            var selectedId = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>get-file/' + selectedId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Assuming response is an array of options
                    responseData = response; // Store the response data
                    var tableBody = $('.details-table tbody');
                    tableBody.empty(); // Clear existing table rows
                    // Loop through the response data and append rows to the table
                    $.each(response.details, function(index, item) {
                        var row = '<tr>' +
                            '<td class="center">' + (index + 1) + '</td>' +
                            '<td class="center">' + (item.enquiry_no !== null ? item
                                .enquiry_no : '-') + '</td>' +
                            '<td class="center">' + formatDate(item.check_in_date) + '</td>' +
                            '<td class="center">' + formatDate(item.check_out_date) + '</td>' +
                            '<td class="center">' + ((item.number_persons !== null ?
                                    item.number_persons : '-') + '+' +
                                (item.number_child !== null ? item.number_child :
                                    '-')) + '</td>' +
                            '<td class="center">' + (item.hotel_name !== null ? item
                                .hotel_name : '-') + '</td>' +
                            '<td class="center">' + (item.n !== null ? item.n :
                                '-') + '</td>' +
                            '<td class="center"><a href="' + item.id +
                            '/activity-log" class="btn btn-success btn-xs" target="_blank" id="the-btn-delete" data-id="' +
                            item.id + '">Track</a></td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        });

        // Trigger the change event on the #date element
        $('#date').trigger('change');
        $('#file').trigger('click');

    });
    </script>
</body>

</html>