<?php $users_modules_mapping = [
    '1' => ['auxiliary-guide-master', 'auxiliary-luggage-vehicle', 'auxiliary-miscellaneous-master', 'auxiliary-sightseeing-master'],
    '2' => ['query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
    '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency','location-master'],
    '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
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
            <!-- start page content -->
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Ancillary Masters</h4>
                    </div>
                    <div class="col-lg-4 only-for-dashbord">
                    </div>
                    <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('masters'); ?>">Masters</a></li>
                                <li class="breadcrumb-item active">Ancillary Masters</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content-wrapper">
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
                        <div class="col-lg-12 ">
                             <h1  class="mt-1" style="display: flex; text-align: center; font-size: 36px !important; font-weight: 900; padding: 0; margin: -70px auto 50px auto;width:100%;max-width:600px;">
                             Ancillary Masters Dashboard
                            </h1>
                        </div>
                    </div>
					<br><br>
                    <div class="container dash-container">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="container dash-container">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    
                                        <div class="col-md-3 image-icon" style="display:<?php echo (in_array('auxiliary-guide-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
											<a href="<?php echo base_url('auxiliary-guide-master'); ?>">
												<img src="assets/admin/images/guide1.png" class="img-fluid">
												<h4>Guide Charge</h4>
											</a>
										</div>
                                        <div class="col-md-3 image-icon" style="display:<?php echo (in_array('auxiliary-luggage-vehicle', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
											<a href="<?php echo base_url('auxiliary-luggage-vehicle'); ?>">
												<img src="assets/admin/images/luggage.png" class="img-fluid">
												<h4>Luggage Vehicle Charge</h4>
											</a>
										</div>
                                        <div class="col-md-3 image-icon" style="display:<?php echo (in_array('auxiliary-miscellaneous-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
											<a href="<?php echo base_url('auxiliary-miscellaneous-master'); ?>">
												<img src="assets/admin/images/miscellaneous1.png" class="img-fluid">
												<h4>Mandatory Services</h4>
											</a>
										</div>
                                        <!-- <div class="col-md-2 image-icon" style="display:<?php echo (in_array('auxiliary-sightseeing-master', $users_modules_mapping[$this->session->userdata('type')])) ? 'block' : 'none'; ?>">
											<a href="<?php echo base_url('auxiliary-sightseeing-master'); ?>">
												<img src="assets/admin/images/sightseeing.png" class="img-fluid">
												<h4>Ancillary Sightseeing Vehicle</h4>
											</a>
										</div> -->
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row" id="numbers-count" style="display:none;">

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

                        </div> -->


                    </div>
                    <!-- end page content -->
                </div>
                </div>
                </div>
                <!-- end page container -->
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