<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>CRM</title>
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
                                <div class="page-title">Add Package</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Package</li>
                            </ol>
                        </div>
                    </div>			
<?php if($this->session->flashdata('message')<>''){ echo $this->session->flashdata('message');  unset($_SESSION['message']); } ?>						
                     <div class="row">
                    <div class="col-sm-12">
                            <div class="card-box">
                                    <div class="card-head">
                                            <header>Add Package</header>
                                            <div class="tools">
                                                <a href="product-list" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i> List</a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            </div>
                                    </div>	
                            <form method="post">
                                    <div class="card-body row">


                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'new_product','id'=>'new_product','class'=>'mdl-textfield__input','required'=>'required'])?>			 
                                <label class = "mdl-textfield__label">Add New Package</label>	 	 
                              </div>
                                </div>
                                     
                                    <!--div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <select name="group_id" class="mdl-textfield__input" required>
                                          <option value="" selected="selected">Select Group</option>
                                          <?php //foreach($groups AS $list){ ?>
                                          <option value="<?php //echo $list->id; ?>"><?php //echo $list->group_name; ?></option>
                                          <?php //} ?>
                                      </select>
                                
                              </div>
                                </div-->
                                        
                                        
                                     <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
                                </div>
                                    </div>
                            </form>
                            </div>
                    </div>
            </div>
				<!--
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Products</header>
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
												<th class="center">Name</th>
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
												<td class="center"><?=$product->name?></td>
												<td class="center">
												<a href="<?=base_url().$product->id.'/delete-product';?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
												</td>
											</tr>
										</form>	
										<?php } }?>	
										</tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->				
					
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
  
    <!-- end js include path -->
    <script>
    
    $(document).ready(function(){
       // alert('hello');
      
      var select = false;
      let dt = [];
     $( "#new_product" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>search_product",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
            console.log(data);
         response( data );
         dt = data;
         $(".err").html('');;
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	   
	   var company_id = ui.item.company_id;
	   
// 	$.ajax({
//         type: "POST",
//         url: "<?=base_url();?>admin/company/get_branch_ajax",
//         data:{'company':$("#company_id").val()},
//         success: function(data){
//             $("#branch").empty();
// 			$('#branch').append('<option value="">Select Branch</option>');
//             var opts = $.parseJSON(data);
//             $.each(opts, function(i, d) {
//               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
//             });
// 			$('#branch').append('<option value="">Add New Branch</option>');
//         },
// 		 error: function(jqXHR, textStatus, errorThrown) {
//           console.log(textStatus, errorThrown);
//         }
//     });		select = true; 
        
	$("#branch_section").show();	
       return false;
      }
     }).blur(function(){
    if(!select)
    {
        //console.log(dt);
        $.each(dt, function(key,value) {
            if(value.label.toLowerCase() == $("#name").val().trim().toLowerCase()){
                $("#name").focus();
                $(".err").html('Product Already Added!');
                return false;
            }
        }); 
    }
});

  });
        
        
    </script>
    
	
</body>
</html>