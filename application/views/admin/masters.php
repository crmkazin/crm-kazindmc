<?php $users_modules_mappings = [
    '1' => ['database', 'query-board', 'reports', 'arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency', 'live-tracking','blackout-dates','location-master','auxiliary-master'],
    '2' => ['query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
    '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency','location-master'],
    '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
    '5' => ['database', 'query-board', 'arrival-chart', 'currency']
]; ?>

<style>
    .currency-row > div { 
        border: 1px solid #f2eded;
    }
</style>
<?php include('admin_head_css.php'); ?>
<div class="page-wrapper">
   <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Masters Dashboard</h4>
                    </div>
                    <div class="col-lg-4 only-for-dashbord">
                        <h4>Welcome To Kazin DMC Masters</h4>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Masters Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content page-dashboard"><?php if ($this->session->flashdata('msg') <> '') { ?> 
                <div class="row">
                    <div class="col-lg-12 "> <?php echo $this->session->flashdata('msg'); ?> <br />
                    <br />
                    </div>
                </div> 
                <?php } ?> 

                <div class="container dash-container">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="container dash-container">
                                <div class="row">
                                    <!-- <div class="col-md-1"></div> -->
                                    
                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('itinerary-masters', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('all-masters'); ?>">
                                                        <img src="assets/admin/images/itinerary-masters.png" class="img-fluid">
                                                        <h4>Itinerary Masters</h4>
                                                </a>
                                        </div>

                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('restaurants-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('all-masters-restaurants'); ?>">
                                                        <img src="assets/admin/images/restaurant.png" class="img-fluid">
                                                        <h4>Restaurants Masters</h4>
                                                </a>
                                        </div>
                                        <div class="col-md-2 image-icon"
                                                style="display:<?php echo (in_array('restaurants-menu-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('restaurant-menu-master'); ?>">
                                                        <img src="assets/admin/images/rastURnt.png" class="img-fluid">
                                                        <h4>Restaurant Menu Master</h4>
                                                </a>
                                        </div>
                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('blackout-dates', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('blackout-dates'); ?>">
                                                        <img src="assets/admin/images/blackout-dates.png" class="img-fluid">
                                                        <h4>Black Out Dates Masters</h4>
                                                </a>
                                        </div>
                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('location-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('location-master'); ?>">
                                                        <img src="assets/admin/images/location-master.png" class="img-fluid">
                                                        <h4>Location Masters</h4>
                                                </a>
                                        </div>
                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('auxiliary-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('auxiliary-master'); ?>">
                                                        <img src="assets/admin/images/auxiliary.webp" class="img-fluid">
                                                        <h4>Ancillary Masters</h4>
                                                </a>
                                        </div>
                                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('drivers-list', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
                                                <a href="<?php echo base_url('drivers-list'); ?>">
                                                    <img src="assets/admin/images/driver.png" class="img-fluid">
                                                    <h4>Drivers Master</h4>
                                                </a>
                                        </div>  
                                </div>
                            </div>
                        </div>


                        <div class="row" id="numbers-count" style="display:none;">

                            <div class="col-sm-12" style="border: solid 5px #FFF;">
                                <div class="row">
                                    <div class="col-lg-3 po-box bg-black text-white"
                                        style="border-right: solid 5px #FFF;">
                                        <div>
                                            <h3 class="mb-1" style="text-align:right;">
                                                <?php echo (isset($counts['pending']) ? $counts['pending'] : 'N/A'); ?>
                                                <i class="fa fa-hourglass-start"
                                                    style="float:left;margin-top: 14px;font-size:18px;"> Pending</i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 po-box bg-perp text-white"
                                        style="border-right: solid 5px #FFF;">
                                        <div>
                                            <h3 class="mb-1" style="text-align:right;">
                                                <?php echo (isset($counts['in-progress']) ? $counts['in-progress'] : 'N/A'); ?>
                                                <i class="fa fa-clipboard"
                                                    style="float:left;margin-top: 14px;font-size:18px;"> In-Progress</i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 po-box bg-green text-white"
                                        style="border-right: solid 5px #FFF;">
                                        <div>
                                            <h3 class="mb-1" style="text-align:right;">
                                                <?php echo (isset($counts['confirm']) ? $counts['confirm'] : 'N/A'); ?>
                                                <i class="fa fa-gavel"
                                                    style="float:left;margin-top: 14px;font-size:18px;"> Confirm</i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 po-box bg-orange text-white">
                                        <div>
                                            <h3 class="mb-1" style="text-align:right;">
                                                <?php echo (isset($counts['not-materialized']) ? $counts['not-materialized'] : 'N/A'); ?>
                                                <i class="fa fa-trash"
                                                    style="float:left;margin-top: 14px;font-size:18px;"> Not
                                                    Materialized</i>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
<script>
$(window).on('load', function() {
    var delayMs = 500; // delay in milliseconds

    setTimeout(function() {
        //$('#myModal').modal('show');
        $("#numbers-count").toggle('slow');
    }, delayMs);
});
</script>