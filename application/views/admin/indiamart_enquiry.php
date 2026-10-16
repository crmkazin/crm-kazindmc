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
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="icon-and-text-button-demo">
                        <a href="indiamart-followup" class="btn btn-success waves-effect">
                            <i class="material-icons">devices</i><br>
                            <span>Indiamart Enquiry</span>
                        </a>
                        <a href="enquiry-followup" class="btn btn-info waves-effect" style="margin-left:5px;">
                            <i class="material-icons">supervisor_account</i><br>
                            <span>Reference Enquiry</span>
                        </a>
                        
                    </div>
                </div>
                    </div>
                    
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Indiamart Enquiry</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Indiamart Enquiry</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h4>' .$this->session->flashdata('message'). '</h4>'; unset($_SESSION['message']); ?>						
 -->					<div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Add/Remove Column Fields</header>
                                <input type="checkbox" name="" class="view_all"/>
                                <label style="color:#000 !important;font-weight: 500;font-size: 15px !important;">View All</label>
                            </div>
                            <div class="card-body">
                                <div class="row"> 
                                						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="1" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Followup</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry For</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry Mode</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry Type</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Status</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Remarks</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Country</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">State</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Address</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Person</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact No</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Assign To</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="16" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="17" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Action</label>
                                    </div>
                                </div>
								
					</div>                            
                        </div>
                            
                        </div>
                    </div>
                </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Indiamart Enquiries</header>
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
                                                    <th class="center">Followup</th>
                                                    <th class="center">Enquiry For</th>	
                                                    <th class="center">Enquiry Mode</th>
                                                    <th class="center">Enquiry Type</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Remarks</th>
                                                    <th class="center">Organization</th>
                                                    <th class="center">Country</th>	
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Address</th>
                                                    <th class="center">Contact Person</th>
                                                    <th class="center">Contact No</th>			
                                                    <th class="center">Email</th>
                                                    <?php if($this->session->userdata('type') != 3){?>
                                                    <th class="center">Assign To</th>
                                                    <?php }?>
                                                    <th class="center">Date</th>
                                                    <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i=1;
                                    //echo '<pre>';print_r($enquiry);die;
                                    if(!empty($enquiry)) {
                                    foreach($enquiry as $enquiries) {
                                    ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                    <td class="center">
                                                    <?php if($enquiries->enquiry_for != 'Other' && $enquiries->status != 'automated-enquiry'){?>    
                                                    <a href="<?=base_url().$enquiries->id.'/';?>followup">Followup</a>
                                                    <?php }else{ ?><a href="<?=base_url().$enquiries->id.'/edit-enquiry-indiamart';?>">Edit</a><?php }?>
                                                    </td>												
                                                    <td class="center"><?=$enquiries->enquiry_for?></td>
                                                    <td class="center"><?=$enquiries->mode?></td>
                                                    <td class="center"><?=$enquiries->enquiry_type?></td>
                                                    <td class="center"><?=$enquiries->status?></td>
                                                    <td class="center"><?=$enquiries->remarks?></td>
                                                    <td class="center">
                                                    <?php if(is_numeric($enquiries->name)){
                                                    echo "Name Not Found";	
                                                    }else{
                                                    echo $enquiries->name;	
                                                    }?>
                                                    </td>
                                                    <td class="center"><?=$enquiries->country?></td>
                                                    <td class="center"><?=$enquiries->state?></td>
                                                    <td class="center"><?=$enquiries->city?></td>
                                                    <td class="center"><?=$enquiries->address?></td>
                                                    <td class="center"><?=$enquiries->contact_person?></td>
                                                    <td class="center"><?=$enquiries->contact_number?></td>
                                                    <td class="center"><?=$enquiries->email?></td>
                                                <?php if($this->session->userdata('type') != 3){?>
                                                <td class="center">
                                                <?php if($enquiries->added_by <> ''){ 
                                                                    $user = $this->common_model->get_row(['table_name'=>'admin','condition'=>['id'=>$enquiries->added_by]]);
                                                                    //$user = $this->enquiry_model->get_user($enquiries->added_by);
                                                            echo ($user)?$user[0]->name:'No One';
                                                }
                                                else{ echo "No One";}?>
                                                </td>
                                                <?php } ?>
                                                    <td class="center"><?= date('d-M-Y',strtotime($enquiries->date)) ?></td>
                                                    <td class="center">
                                                    <?php if($this->session->userdata('type') != 3){?>    
                                                    <a href="<?=base_url().$enquiries->id?>/delete-enquiry" onclick="return confirm('Are you sure you want to delete this Enquiry?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    <?php }?>
                                                    </td>
                                            </tr>
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

	$(document).ready(function() {
            var table = $('#example4').DataTable({
                            "scrollX": true
                            //"scrollY": "200px",
                            //"paging": false
                    });
            table.columns( [ 3,4,5,6,7,8,9,10,11,12,13,14,15,16 ] ).visible( false, false );
            table.columns.adjust().draw( false );
            $('.mdl-textfield__input').on( 'click', function (e) {
                // Get the column API object
                var column = table.column( $(this).attr('data-column') );
                // Toggle the visibility
                column.visible( ! column.visible() );
                table.columns.adjust().draw( false );
                $('.view_all').prop("checked",false);
                $(".dataTables_info").parent().parent('div').show();
            });
            
            $(".view_all").on('click',function(){
                if($(this).prop("checked") === true){
                    $('.mdl-textfield__input').prop('checked',true);
                    table.columns( '.center' ).visible( true );
                    $(".dataTables_info").parent().parent('div').show();
                }else{
                    $('.mdl-textfield__input').prop("checked",false);
                    table.columns( '.center' ).visible( false );
                    $(".dataTables_info").parent().parent('div').hide();
                }
            });
            
	});

</script>
</body>
</html>