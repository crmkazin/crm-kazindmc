<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
<?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
<?php include('side_bar.php');?>
            <!-- end sidebar menu --> 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                   <!-- start widget -->
                    <div class="state-overview">
                            <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-blue">
                                <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Clients</span>
                                  <span class="info-box-number"><?php echo $organization ?></span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div> </a>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-orange">
                                <span class="info-box-icon push-bottom"><i class="material-icons">content_paste</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Enquiry</span>
                                  <span class="info-box-number"><?=$enquiry ?></span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-40"></div>
                                  </div>
                                  <span class="progress-description">
                                        40% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-purple">
                                <span class="info-box-icon push-bottom"><i class="material-icons">mail</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Quotations</span>
                                  <span class="info-box-number"><?=$quotation ?></span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-80"></div>
                                  </div>
                                  <span class="progress-description">
                                        80% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-teal">
                                <span class="info-box-icon push-bottom"><i class="material-icons">work</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Tenders</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-light-green">
                                <span class="info-box-icon push-bottom"><i class="material-icons">assignment_turned_in</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Bids</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-lime">
                                <span class="info-box-icon push-bottom"><i class="material-icons">redeem</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">OA</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>							

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-deep-purple">
                                <span class="info-box-icon push-bottom"><i class="material-icons">person_add</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Job Assign</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-blue-grey">
                                <span class="info-box-icon push-bottom"><i class="material-icons">create</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Invoices</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                            <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-success">
                                <span class="info-box-icon push-bottom"><i class="material-icons">shopping_cart</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Product</span>
                                  <span class="info-box-number"><?=$product ?></span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-amber">
                                <span class="info-box-icon push-bottom"><i class="material-icons">people</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Users</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-brown">
                                <span class="info-box-icon push-bottom"><i class="material-icons">public</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Groups</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                                    <div class="col-xl-3 col-md-6 col-12">
                              <div class="info-box bg-indigo">
                                <span class="info-box-icon push-bottom"><i class="material-icons">library_books</i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Reports</span>
                                  <span class="info-box-number">(Number Here)</span>
                                <!--  <div class="progress">
                                    <div class="progress-bar width-60"></div>
                                  </div>
                                  <span class="progress-description">
                                        60% Increase in 28 Days
                                      </span> -->
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                          </div>
                            </div>
                    <!-- end widget -->
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
<?php include('admin_footer_js.php');?>
  </body>
</html>