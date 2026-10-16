<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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
                                <div class="page-title">Other Product</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Other Product</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Other Product Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
												<th class="center">Sr.No</th>
												<th class="center">Client</th>
												<th class="center">Branch</th>
												<th class="center">Email</th>
												<th class="center">Contact</th>
												<th class="center">Enquiry For</th>	
												<th class="center">Enquiry Type</th>		
												<th class="center">Status</th>
												<th class="center">Remarks</th>
												<th class="center">Date</th>
												<th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										if(!empty($products)) {
										foreach($products as $product) {
										    
										?>
										<form method="post">
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center">
												<?php if(is_numeric($product->client)){ echo "No Name Found";}else{ echo $product->client; }?>
												</td>
												<td class="center"><?=$product->city?></td>
												<td class="center"><?=$product->email?></td>
												<td class="center"><?=$product->contact_number?></td>
												<td class="center"><?=$product->enquiry_for?></td>
												<td class="center"><?=$product->enquiry_type?></td>
												<td class="center"><?=$product->status?></td>
												<td class="center"><?=$product->remarks?></td>
												<td class="center"><?=$product->date?></td>
												<td class="center"><a href="<?=base_url().$product->id.'/edit-product';?>">Edit</a></td>
											</tr>
										</form>	
										<?php } }?>	
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
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->	
	
<script>
 $("#followup_status").change(function(){ 
	if($(this).val() == 'Future Prospects'){
		$("#followup_date_section").show();
	}else{
		$("#followup_date_section").hide();
	}	
});
</script>	
</body>
</html>