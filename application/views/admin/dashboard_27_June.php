<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php'); ?> 

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
        
        
        	<!-- The Modal -->
	  <div class="modal dash-pop" id="myModal">
		<div class="modal-dialog">
		  <div class="modal-content">
		  
			<!-- Modal Header -->
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<!--
			  <div class="modal-header"></div>
			-->
			
			<!-- Modal body -->
			<div class="modal-body">
			 <div class="col-sm-12">
			  <div class="row">
			   <div class="col-lg-6 po-box bg-black text-white">
			       <div>
			          <h2 class="mb-1"><?php echo (isset($counts['pending'])?$counts['pending']:'0'); ?></h2>Pending
			       </div>
			   </div>  
			   <div class="col-lg-6 po-box bg-perp text-white">
			      <div> 
			       <h2 class="mb-1"><?php echo (isset($counts['in-progress'])?$counts['in-progress']:'0'); ?></h2>In-Progress
			      </div>
			   </div>
			   <div class="col-lg-6 po-box bg-green text-white">
			      <div>
			       <h2 class="mb-1"><?php echo (isset($counts['confirm'])?$counts['confirm']:'0'); ?></h2>Confirm
			     </div>
			   </div>
			   <div class="col-lg-6 po-box bg-orange text-white">
			     <div>
			       <h2 class="mb-1"><?php echo (isset($counts['not-materialized'])?$counts['not-materialized']:'0'); ?></h2>Not Materialized</div>
			     </div>  
			  </div>    
			     
			 </div>
			  
			</div>
			
		  </div>
		</div>
	  </div>
        
        
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 		    <!-- end sidebar menu --> 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content page-dashboard">
                    
                     <?php if($this->session->flashdata('msg')<>''){ ?>
				     <div class="row">
				     <div class="col-lg-12 ">
					  <?php echo $this->session->flashdata('msg'); ?>
					  <br/><br/>
				     </div></div>
				     <?php } ?>
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    
                  
                   <div class="row">
				     <div class="col-lg-12 ">
					  <h1 style="text-align: center; font-size: 36px !important; font-weight: 900; padding: 0; margin: -70px auto 50px auto;width:100%;max-width:600px;">Welcome To Kazin DMC</h1>
				    <br/><br/>
				     </div> 
				    
                   </div>				  
                   
                    <!-- <?php $users_modules_mapping = ['1'=>['database','query-board','reports','arrival-chart','party-bus','itinerary-masters','restaurants-master','restaurants-menu-master','hotels','currency'],
                                                    '2'=>['query-board','arrival-chart','itinerary-masters','restaurants-master','restaurants-menu-master','hotels'],
                                                     '3'=>['database','arrival-chart','query-board','reports','party-bus','itinerary-masters','restaurants-master','restaurants-menu-master','hotels','currency'],
                                                     '4'=>['arrival-chart','party-bus','itinerary-masters','restaurants-master','restaurants-menu-master','hotels'],
                                                     '5'=>['database','query-board','arrival-chart']]; ?> -->
                                                     
                    <?php $users_modules_mapping = [
                        '1' => ['database', 'query-board', 'reports', 'arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency'],
                        '2' => ['query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels'],
                        '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency'],
                        '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels'],
                        '5' => ['database', 'query-board', 'arrival-chart', 'currency']
                    ]; ?>
                        <div class="container dash-container">
                          <div class="row">
                           <div class="col-md-1"></div>
                        <div class="container dash-container">
                          <div class="row">
                           <div class="col-md-1"></div>
                             <?php if($this->session->userdata('type')==1){ ?> 
                             <div class="col-md-2 image-icon">					 
                                 <a href="<?php echo base_url('all-user');?>">					  
                                 <img src="assets/admin/images/icon-10.png" class="img-fluid">
                                 <h4>Users</h4>
                                </a>
                             </div>
                             <?php } ?>
                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('database',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">

                          <a href="<?php echo base_url('clients');?>">
                        <img src="assets/admin/images/icon-2.png" class="img-fluid">
                        <h4>Database</h4>
                        </a>
                      </div>	
                        
			        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('itinerary-masters',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">					  
                        <a href="<?php echo base_url('all-masters');?>">											
                        <img src="assets/admin/images/itinerary-masters.png" class="img-fluid">
                        <h4>Itinerary Masters</h4>
                       </a>
                      </div>
                         <!--div class="col-md-2 image-icon">					  
                            <a href="<?php //echo base_url('all-templates');?>">											
                            <img src="assets/admin/images/itinerary-template.png" class="img-fluid">
                            <h4>Itinerary Templates</h4>
                           </a>
                          </div-->
                        
                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('restaurants-master',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">					  
                            <a href="<?php echo base_url('all-masters-restaurants');?>">											
                            <img src="assets/admin/images/restaurant.png" class="img-fluid">
                            <h4>Restaurants Masters</h4>
                           </a>
                        </div>		  					  
                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('restaurants-menu-master',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">
                            <a href="<?php echo base_url('restaurant-menu-master'); ?>">
                                <img src="assets/admin/images/rastURnt.png" class="img-fluid">
                                <h4>Restaurant Menu Master</h4>
                            </a>
                        </div>
			</div>
			<div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2 image-icon">
                               <a href="<?php echo base_url('all-flight');?>">
                                   <img src="assets/admin/images/flight.png" class="img-fluid">
                                   <h4>Airlines</h4>
                                </a>
                            </div>	
                            <div class="col-md-2 image-icon" style="display:<?php echo (in_array('hotels',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">
                            <a href="<?php echo base_url('all-hotel');?>">
                                <img src="assets/admin/images/hotel.png" class="img-fluid">
                                <h4>Hotels</h4>
                            </a>
                        </div>

                        <div class="col-md-2 image-icon">
                            <a href="<?php echo base_url('all-transport');?>">
                                <img src="assets/admin/images/transportation.png" class="img-fluid">
                                <h4>Transportations</h4>
                            </a>
                        </div>
                        <div class="col-md-2 image-icon">
                            <a href="<?php echo base_url('all-guide');?>">
                                <img src="assets/admin/images/guide.png" class="img-fluid">
                                <h4>Guide</h4>
                            </a>
                        </div>
                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('query-board',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">
                            <a href="<?php echo base_url('enquiry-followup');?>">					 
                                <img src="assets/admin/images/icon-3.png" class="img-fluid">
                                <h4>Query Board</h4>
                            </a>
                       </div>  	
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2 image-icon" style="display:<?php echo (in_array('arrival-chart',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">					  
                                <a href="<?php echo base_url('arrivals');?>">											
                                <img src="assets/admin/images/icon-6.png" class="img-fluid">
                                <h4>Arrival Chart</h4>
                            </a>
                        </div> 
                        <div class="col-md-2 image-icon"
                            style="display:<?php echo (in_array('party-bus',$users_modules_mapping[$this->session->userdata('type')]) && in_array(strtolower($this->session->userdata('locations')),['kazakhstan','all']))?'block':'none'; ?>">
                            <a href="<?php echo base_url('party-bus');?>">
                                <img src="assets/admin/images/partybus.png" class="img-fluid">
                                <h4>Party Bus</h4>
                            </a>
                        </div>
                        
						<div class="col-md-2 image-icon" style="display:<?php //echo (in_array('reports',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>block">
					  
                            <a href="<?php echo base_url('itinerary-report');?>">

                            <img src="assets/admin/images/icon-11.png" class="img-fluid">
                            <h4>Reports</h4>
                           </a>
                          </div>
				        
                        <div class="col-md-2 image-icon">					  
                            <a href="<?php echo base_url('change_password');?>">											
                                <img src="assets/admin/images/icon-12.png" class="img-fluid">
                                <h4>Change Password</h4>
                            </a>
                      </div>
					  
					  <div class="col-md-2 image-icon" style="display:<?php echo (in_array('currency',$users_modules_mapping[$this->session->userdata('type')]))?'block':'none'; ?>">
					  
                            <a href="<?php echo base_url('currency_list');?>">

                            <img src="assets/admin/images/currency.png" class="img-fluid">
                            <h4>Currency</h4>
                           </a>
                          </div>
					  
                    </div>   
                </div>
				          
                    
                </div>
                
                
                <div class="row" id="numbers-count" style="display:none;">
                    
			 <div class="col-sm-12" style="border: solid 5px #FFF;">
			  <div class="row">
			   <div class="col-lg-3 po-box bg-black text-white" style="border-right: solid 5px #FFF;">
			       <div>
			          <h3 class="mb-1" style="text-align:right;"><?php echo (isset($counts['pending'])?$counts['pending']:'N/A'); ?> <i class="fa fa-hourglass-start" style="float:left;margin-top: 14px;font-size:18px;"> Pending</i> </h3>
			       </div>
			   </div>  
			   <div class="col-lg-3 po-box bg-perp text-white" style="border-right: solid 5px #FFF;">
			      <div> 
			       <h3 class="mb-1" style="text-align:right;"><?php echo (isset($counts['in-progress'])?$counts['in-progress']:'N/A'); ?> <i class="fa fa-clipboard" style="float:left;margin-top: 14px;font-size:18px;"> In-Progress</i></h3>
			      </div>
			   </div>
			   <div class="col-lg-3 po-box bg-green text-white" style="border-right: solid 5px #FFF;">
			      <div>
			       <h3 class="mb-1" style="text-align:right;"><?php echo (isset($counts['confirm'])?$counts['confirm']:'N/A'); ?>  <i class="fa fa-gavel" style="float:left;margin-top: 14px;font-size:18px;"> Confirm</i></h3>
			     </div>
			   </div>
			   <div class="col-lg-3 po-box bg-orange text-white">
			     <div>
			       <h3 class="mb-1" style="text-align:right;"><?php echo (isset($counts['not-materialized'])?$counts['not-materialized']:'N/A'); ?>  <i class="fa fa-trash" style="float:left;margin-top: 14px;font-size:18px;"> Not Materialized</i></h3></div>
			     </div>  
			  </div>    
			     
			 </div>
			  
			</div>
                
                
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> <?=date('Y') ?> © By
            <a href="#" target="_top" class="makerCss">Thavertech</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>        <!-- end footer -->
    </div>
<?php include('admin_footer_js.php');?>

<script>
    	 $(window).on('load',function(){
    		var delayMs = 500; // delay in milliseconds
    		
    		setTimeout(function(){
    			//$('#myModal').modal('show');
    			$("#numbers-count").toggle('slow');
    		}, delayMs);
    	 });
      </script>

  </body>
</html>