<?php $users_modules_mapping = [
    '1' => ['auxiliary-guide-master', 'auxiliary-luggage-vehicle', 'auxiliary-miscellaneous-master', 'auxiliary-sightseeing-master'],
    '2' => ['query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
    '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency','location-master'],
    '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels','location-master'],
    '5' => ['database', 'query-board', 'arrival-chart', 'currency']
]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <style>
        .currency-row > div { 
          border: 1px solid #f2eded;
        }
    </style>
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark sidemenu-closed">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <!-- logo end -->
                <ul class="nav navbar-nav navbar-left in ">
                    <li><a href="dashboard" class=""><img src="assets/admin/images/logo.png" style="height:25px;"></a></li>
                </ul>

                <div class="d-user d-flex">
                    <div class="name"><?php echo $this->session->userdata('name'); ?> | <a
                            href="<?php echo base_url('logout'); ?>">Logout </a></div>
                    <img src="assets/admin/images/admin.png">
                </div>

                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- end mobile menu -->
                <!-- start header menu -->
                <div id="msgSave" style="text-align: center;margin-top: 15px;display: none;">Saving...</div>
            </div>
        </div> <!-- end header -->


        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <!-- end sidebar menu -->
            <!-- start page content -->
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

                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <!-- <div class=" pull-left">
                                <div class="page-title">Auxiliary Masters Dashboard</div>
                            </div> -->
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?php echo base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li><i class=""></i>&nbsp;<a class="parent-item"
                                        href="<?php echo base_url('masters'); ?>">Masters</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Ancillary Masters</li>
                            </ol>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 ">
                             <h1 style="display: flex; text-align: center; font-size: 36px !important; font-weight: 900; padding: 0; margin: -70px auto 50px auto;width:100%;max-width:600px;">
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
                <!-- end page container -->
                <!-- start footer -->
                <div class="page-footer">
                    <div class="page-footer-inner"> <?= date('Y') ?> © By
                        <a href="#" target="_top" class="makerCss">Thavertech</a>
                    </div>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                </div> <!-- end footer -->
            </div>
            <?php include ('admin_footer_js.php'); ?>

            <script>
            $(window).on('load', function() {
                var delayMs = 500; // delay in milliseconds

                setTimeout(function() {
                    //$('#myModal').modal('show');
                    $("#numbers-count").toggle('slow');
                }, delayMs);
            });
            </script>

</body>

</html>