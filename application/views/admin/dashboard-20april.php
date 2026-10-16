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
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark sidemenu-closed">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->                
                <!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="" ><img src="assets/admin/images/logo.png" style="height:25px;"></a></li>
				</ul>
                
				<div class="d-user">
				 <div class="name"><?php echo $this->session->userdata('name'); ?> | <a href="<?php echo base_url('logout'); ?>">Logout </a></div>
				 <img src="assets/admin/images/admin.png">
				</div>
                
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
               <div id="msgSave" style="text-align: center;margin-top: 15px;display: none;">Saving...</div>
            </div>
        </div>        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 		    <!-- end sidebar menu --> 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content page-dashboard">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="https://crm.intellitest.co.in/dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    
                  
                   <div class="row">
				     <div class="col-lg-12 ">
					  <h1 style="text-align: center; font-size: 36px !important; font-weight: 900; padding: 0; margin: -70px auto 50px auto;width:100%;max-width:600px;">Welcome To Intellitest</h1>
				     </div>                        
                   </div>				  
				   
				   <div class="container dash-container">
				     <div class="row">
				      <div class="col-md-1"></div>
					  
					
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('group-list'); ?>">
					     <img src="assets/admin/images/dash-03.png" class="img-fluid">
					     <h4>Product Group</h4>
					   </a>
					  </div>
					  
					    <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('product-list'); ?>">
					     <img src="assets/admin/images/dash-02.png" class="img-fluid">
					     <h4>Products</h4>
					   </a>
					  </div>
					  					 					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('clients'); ?>">
					    <img src="assets/admin/images/dash-15.png" class="img-fluid">
					    <h4>Organizations</h4>
					    </a>
					  </div>
					  
					   <div class="col-md-2 image-icon">
					   <a href="<?php  echo base_url('enquiry-navigate'); //echo base_url('indiamart-followup'); ?>">
					     <img src="assets/admin/images/dash-04.png" class="img-fluid">
					     <h4>Enquiry</h4>
					   </a>
					  </div>
					  

					  
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('quotation'); ?>">
					    <img src="assets/admin/images/dash-06.png" class="img-fluid">
					    <h4>Quotations</h4>		
                       </a>						
					  </div>
					  
					  
					  
					  <div class="col-md-1"></div>
				     </div>
					 
					 <div class="row">
				      <div class="col-md-1"></div>
				      
				       <!--div class="col-md-2 image-icon">					  
					   <a href="<?php //echo base_url('clients'); ?>">
					     <img src="assets/admin/images/dash-01.png" class="img-fluid">
					     <h4>Clients</h4>
					   </a>
					  </div-->
				       <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('tender-list'); ?>">
					    <img src="assets/admin/images/dash-05.png" class="img-fluid">
					    <h4>Tender</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('bid'); ?>">
					    <img src="assets/admin/images/dash-08.png" class="img-fluid">
					    <h4>Bid</h4>
					   </a>	
					  </div>
				      
				      <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('order-acknowledgement'); ?>">
					    <img src="assets/admin/images/dash-09.png" class="img-fluid">
					    <h4>OA</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="#">
					     <img src="assets/admin/images/dash-07.png" class="img-fluid">
					     <h4>Purchase</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="#">
					    <img src="assets/admin/images/dash-10.png" class="img-fluid">
					    <h4>Jobs</h4>
					   </a>
					  </div>
					  
					 
					  
					  <div class="col-md-1"></div>
				     </div>
					 
					 <div class="row">
				      <div class="col-md-1"></div>
				       <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('invoices'); ?>">
					    <img src="assets/admin/images/dash-11.png" class="img-fluid">
					    <h4>Invoice</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('expenses/travel-expenses-details'); ?>">
					    <img src="assets/admin/images/dash-12.png" class="img-fluid">
					    <h4>Expense</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('all-user'); ?>">
					    <img src="assets/admin/images/dash-13.png" class="img-fluid">
					    <h4>Users</h4>
					   </a>
					  </div>
					  
					  <div class="col-md-2 image-icon">
					   <a href="<?php echo base_url('client-report'); ?>">
					    <img src="assets/admin/images/dash-14.png" class="img-fluid">
					    <h4>Report</h4>
					   </a>
					  </div>
					  
					  <!--<div class="col-md-2 image-icon">-->
					  <!-- <a href="<?php echo base_url('clients'); ?>">-->
					  <!--  <img src="assets/admin/images/dash-15.png" class="img-fluid">-->
					  <!--  <h4>Clients</h4>-->
					  <!--  </a>-->
					  <!--</div>-->
					  
					  <div class="col-md-1"></div>
				     </div>
				   </div>
                                      
                    
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2020 © By
            <a href="#" target="_top" class="makerCss">Thavertech</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>        <!-- end footer -->
    </div>
<?php include('admin_footer_js.php');?>
  </body>
</html>