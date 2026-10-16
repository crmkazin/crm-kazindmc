<?php $users_modules_mapping = [
    '1' => ['database', 'query-board', 'reports', 'arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency', 'live-tracking','blackout-dates'],
    '2' => ['query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels'],
    '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency'],
    '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels'],
    '5' => ['database', 'query-board', 'arrival-chart', 'currency']
]; ?>
<?php include ('admin_head_css.php'); ?>
<style>
    .currency-row > div { 
        border: 1px solid #f2eded;
    }
</style>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Vendor Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Vendor Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content page-dashboard">

                    <?php if ($this->session->flashdata('msg') <> '') { ?>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <?php echo $this->session->flashdata('msg'); ?>
                            <br /><br />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-lg-12">
                             <h1 class="text-center mt-0">
                                Vendor Reports
                            </h1>
                        </div>
                    </div>
					<br><br>
                    <div class="container dash-container">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="container dash-container">
                                <div class="row">
                                    <div class="col-md-2"></div>                                    
									<div class="col-md-2 image-icon" style="">
										<a href="<?php echo base_url('vendor-report'); ?>">
											<img src="assets/admin/images/hotel.png" class="img-fluid">
											<h4>Hotel Report</h4>
										</a>
									</div>
									<div class="col-md-2 image-icon" style="">
										<a href="<?php echo base_url('transportation-report'); ?>">
											<img src="assets/admin/images/transportation.png" class="img-fluid">
											<h4>Transportation Report</h4>
										</a>
									</div>
									<div class="col-md-2 image-icon" style="">
										<a href="<?php echo base_url('restaurant-report'); ?>">
											<img src="assets/admin/images/restaurant.png" class="img-fluid">
											<h4>Restaurant Report</h4>
										</a>
									</div>
									<div class="col-md-2 image-icon" style="">
										<a href="<?php echo base_url('restaurant-menu-report'); ?>">
											<img src="assets/admin/images/rastURnt.png" class="img-fluid">
											<h4>Menu Report</h4>
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
                    <!-- end page content -->
                </div>
                <!-- end page container -->
            </div>
            </div>
            </div>
