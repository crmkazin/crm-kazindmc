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
                                <div class="page-title">Bid Followup</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>bid">Bids</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Bid Followup</li>
                            </ol>
                        </div>
                    </div>			
<?php 
    if($this->session->flashdata('message')<>''){
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>'; unset($_SESSION['message']);
    }
?>

                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
    <i class="material-icons">arrow_back</i>
</button>
                                    <header>Bid Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Bid No</th>
                                                <th class="center">Organization</th>
                                                <th class="center">City</th>
                                                <th class="center">Work/Equipment</th>
                                                <th class="center">Tender For</th>
                                                <th class="center">E Tender ID</th>
                                                <th class="center">Publish Date</th>
                                                <th class="center">Status</th>
                                                <th class="center">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td class="center"><?=$detail->bid_number?></td>
                                                <td class="center"><?=$detail->name?></td>
                                                <td class="center"><?=$detail->city?></td>
                                                <td class="center"><?=$detail->equipment?></td>
                                                <td class="center"><?=$detail->tender_for?></td>
                                                <td class="center"><?=$detail->e_tender_id?></td>
                                                <td class="center"><?=$detail->publish_date?></td>
                                                <td class="center"><?=$detail->status?></td>
                                                <td class="center"><?=$detail->remarks?></td>
                                            </tr>	
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $status='';
                        $key = array_search('Awarded to Us', array_column($followups, 'followup_status'));
                        if($key !== False && is_numeric($key)){
                            $status = 'hide'; 
                        } 
                    ?>
                     <div class="row">
                            <div class="col-sm-12">
                                    <div class="card-box">
                                            <div class="card-head">
                                                <header>Bid Status</header>
                                                <span class="label label-success <?php echo ($status=='')?'hide':''; ?>">Awarded To Us</span>
                                            </div>	
                                        <form method="post" class="<?php echo $status; ?>">
                                        <fieldset>
                                            <div class="card-body row">																

                                            <div class="col-lg-4 p-t-20"> 
                                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                <select name="status" id="status" class="mdl-textfield__input" required> 
                                                    <option value=""></option>
                                                    <option value="Under Evaluation">Under Evaluation</option>
                                                    <option value="Opeining Pending">Opening Pending</option>
                                                    <option value="Technical Reject">Technical Reject</option>
                                                    <option value="Financial Pending">Financial Pending</option>
                                                    <option value="Not Lowest">Not Lowest</option>
                                                    <option value="Lowest">Lowest</option>
                                                    <option value="Tender Cancel">Tender Cancel</option>
                                                    <option value="Retender">Re-tender</option>
                                                    <option value="Awarded to Other">Awarded to Other</option>
                                                    <option value="Awarded to Us">Awarded to Us</option>
                                                </select>    
                                                <label class = "mdl-textfield__label">Select Status</label>		 	 
                                              </div>
                                            </div>

                                        <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <textarea name="remarks" class="mdl-textfield__input"> </textarea>			 
                                        <!-- <input type="text" name="remarks" class="mdl-textfield__input" required> -->
                                            <label class = "mdl-textfield__label">Remarks</label>	 	 
                                            </div>
                                        </div>									

                                             <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
                                        <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                                             </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    </div>
                            </div>
					</div> 					
				
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Followup Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="msg"></div>
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Followup Status</th>
                                                <th class="center">Remarks</th>
                                                <th class="center">Date</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($followups)){
                                                $i = 1;
                                        foreach($followups as $followup){
                                        ?>
                                                <tr class="odd gradeX">
                                                <td class="center"><?=$i;?></td>
                                                <td class="center"><?=$followup->followup_status?></td>
                                                <td class="center"><?=$followup->remarks?></td>
                                                <td class="center"><?=$followup->date?></td>
                                                <td class="center">                                                
                                                <i class="fa fa-edit edit-followup" style="cursor:pointer;" data-toggle="collapse" data-target="#collapseExample_<?php echo $followup->id; ?>" aria-expanded="true" aria-controls="collapseExample"></i>
                                                <a href="<?=base_url().$detail->id?>/delete-bid-followup"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs"> 
                                                <i class="fa fa-trash-o "></i> </a>	
                                                </td>												
                                                </tr>        
                                                <tr>        
                                                    <td colspan="5">        
                                                        <div class="collapse in" id="collapseExample_<?php echo $followup->id; ?>" aria-expanded="true" style="text-align: left;background: #f3f5f7;padding:10px;">     
                                                            <div class="well">  
                                                                <div class="container row">                
                                                      <div class="col-md-1"><label><strong>Remarks:</strong></label></div> 
                                                                            <div class="col-md-4">        
                                                                                <textarea name="" id="remarks_<?php echo $followup->id;  ?>" class="mdl-textfield__input"> </textarea> 
                                                                                </div>       
                                                                                <div class="col-md-2">      
                                                                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" onclick="edit_bid_followup(<?php echo $followup->id; ?>)">Update</button>     
                                                                                    </div>      
                                                                                    </div>        
                                                                                    </div>        
                                                                                    </div>        
                                                                                    </td>            
                                                                                    </tr>                                                                                                                        
                                        <?php $i++; } }?>	
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
        function edit_bid_followup(id){ 
            event.preventDefault();      
            //$(this).parent().parent().remove();
            if(id != ''){   
                $.ajax({
                    url: "<?php echo base_url('admin/followup/update_bid_followup'); ?>",
                    method: "POST",
                    data: {'remarks':$("#remarks_"+id).val(),'id':id}, 
                    dataType: 'json', 
                    success: function (data) {
                        if(data.err_msg!=''){
                            $("#msg").html(data.err_msg);
                            }
                            else{
                                location.reload();
                                }
                                } 
                    });
                }
            } 
        </script>    
</body>
</html>