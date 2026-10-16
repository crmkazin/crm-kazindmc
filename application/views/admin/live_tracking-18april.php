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

    .page-content  {
    background-image: url('assets/admin/images/map.png'); /* Replace with your image path */
    /* background-size: cover; Adjust to cover the entire body */
    background-repeat: round; /* Prevent repeating */
    }

    .page-container-bg-solid .page-bar, .page-content-white .page-bar{
        background-color: transparent !important; 
    }

    /* .page-header-fixed .page-container {
    margin-top: 0px !important;
    } */

    .page-bar{
        background-color: transparent !important;
    }

    .card{
        background-color: transparent  !important;
    }

    p{
        color: white !important;
        margin: 85px !important;
    }

    .custom-link {
        font-size: 35px;
        color: black;
        margin-left: 40px;
    }

    /* Hover state */
    .custom-link:hover {
        color: green; /* Change text color on hover */
        text-decoration: none; /* Remove underline */
    }
    </style>
    <!-- Include CSS files -->
    <?php include ('admin_head_css.php'); ?>
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
                <div class="page-content" id="page-content" >
                <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title text-danger"><strong>Live Tracking</strong></div>
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

                                            <div class="col-lg-4 p-t-20"></div>
                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php
                                                    $today = date('Y-m-d'); // Get today's date in the format 'YYYY-MM-DD'
                                                    echo form_input(['name' => 'date', 'type' => 'date', 'id' => 'date', 'class' => 'mdl-textfield__input', 'value' => $today]);
                                                    ?>
                                                    <label class="mdl-textfield__label" for="date" style="color:black !important; margin-left:15px;">Date</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body row" id="count-details" style="justify-content: center; margin-top:50px;">
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

        function fetchFiles(selectedDate) {
            $.ajax({
                url: '<?= base_url() ?>files/' + selectedDate,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var countDetailsDiv = $('#count-details');
                    countDetailsDiv.empty(); // Clear previous content
                    
                    var locations_arr = {
                            'Azerbaijan': ['AZ'],
                            'Belarus': ['BZ'],
                            'Georgia': ['GE'],
                            'Kazakhstan': ['KZ']
                        };
                    
                    var locations = {}; 
                    <?php if($this->session->userdata('locations')=='all'){ ?>
                        var locations = {
                            'Azerbaijan': ['AZ'],
                            'Belarus': ['BZ'],
                            'Georgia': ['GE'],
                            'Kazakhstan': ['KZ']
                        };  
                    <?php }else{ ?>
                        var locations = {                        
                        '<?=ucfirst($this->session->userdata('locations')) ?>': locations_arr["<?=ucfirst($this->session->userdata('locations')) ?>"]
                    };
                    <?php } ?>

                    var countDetailsDiv = $('#count-details');
                    countDetailsDiv.empty(); // Clear previous content

                    // Initialize an object to store counts for each location
                    var locationCounts = {
                        'Azerbaijan': 0,
                        'Belarus': 0,
                        'Georgia': 0,
                        'Kazakhstan': 0
                    };

                    // Iterate through response.details to count occurrences for each location
                    $.each(response.details, function(enquiryAbbr, count) {
                        var foundLocation = false;
                        $.each(locations, function(locationKey, abbrList) {
                            if (abbrList.includes(enquiryAbbr.toUpperCase())) {
                                locationCounts[locationKey] += count;
                                foundLocation = true;
                                return false; // Exit the loop once found
                            }
                        });

                        // If no matching location found, count it as 'Other'
                        if (!foundLocation) {
                            locationCounts['Other'] = (locationCounts['Other'] || 0) + count;
                        }
                    });

                    // Create cards for each location and 'Other' with their respective counts
                    $.each(locations, function(locationKey, abbrList) {
                        var count = locationCounts[locationKey];
                        var url = `<?= base_url() ?>live-tracking-files?date=${selectedDate}&enq_abbr=${abbrList[0]}`;

                        // Create card elements
                        var card = $(`<div class="card m-3" style="min-width:300px;"></div>`);
                        var cardBody = $(`<a href="${url}"><div class="card-body p-0"></div></a>`);

                        // Create count item with formatted HTML
                        var countItem = $(`
                            <div>
                                <p>
                                    <span style="color: crimson; font-size: x-large;"><strong>${locationKey}</strong></span><br><br>
                                    <a class="custom-link" href="${url}">${count}</a>
                                </p>
                            </div>
                        `);

                        // Append count item to card body
                        cardBody.append(countItem);
                        card.append(cardBody);

                        // Append card to count details div
                        countDetailsDiv.append(card);
                    });
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

        $('#date').trigger('change');
    });
    </script>
</body>

</html>