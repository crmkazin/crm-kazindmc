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
                <!--    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Order Acknowledgement</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Order Acknowledgement</li>
                            </ol>
                        </div>
                    </div> -->			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>
                     <div class="row">
                        <div class="col-md-12">
                            <form method="post">
                            <div class="card card-box" id="print">
                                <div class="card-body">
                                    
                                    <table class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
												<th style="text-align: left;"><img src="<?=base_url()?>assets/images/logo.png"></th>
												<th style="text-align: right;">GST : 07AAJCA0972F32Q <br>CIN :U29128DL2011PTC212297</th>
                                            </tr>
                                        </thead>
                                    </table>
                                
                                <p>Ref.No : <?=$detail->quotation_number?></p>
                   
                                <p>Kind Attn : <?=$detail->contact_person?><br><?=$detail->name?> <br><?=$detail->address.','.$detail->city.','.$detail->state.','.$detail->country?></p>
                             
                                <p>Mob   : <?=$detail->contact_number?> <br>Email : <?=$detail->email?></p>
                             
                                <p>SUb   : Quotation</p>
                           
                                <p>Dear Sir,<br> We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions - </p>
                                
                                    <table class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
                                                <th class="center"></th>
												<th class="center">No.</th>
												<th class="center">Item Description</th>
												<th class="center">Unit Price</th>
												<th class="center">Quantity</th>
												<th class="center">Amount</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php if($detail->multiple == "Yes"){
                                        if(!empty($multiple_enquiry)){
                                        $i = 1;    
                                        foreach($multiple_enquiry as $enquiry){
                                        ?>
                                            <tr>
                                                <td class="center"><input type="checkbox" name="checked[]" value="<?=$enquiry['enquiry_id']?>"></td>
                                                <input type="hidden" name="enquiry_id" value="<?=$enquiry['enquiry_id']?>">
                                                <td class="center"><?=$i?></td>
                                                <td class="center"><?=$enquiry['enquiry']?></td>
                                                <td class="center"><input type="text" name="unit_price[]"></td>
                                                <td class="center"><input type="number" name="quantity[]"></td>
                                                <td class="center"><input type="number" name="amount[]" readonly></td>
                                                
                                            </tr>                                        
                                        <?php $i++;   
                                        }    
                                        }
                                        
                                        }else{
                                        ?>     
                                            <tr>
                                                <td class="center">1.</td>
                                                <td class="center"><?=$detail->enquiry_for?></td>
                                                <td class="center"><input type="text" name="unit_price"></td>
                                                <td class="center"><input type="number" name="quantity"></td>
                                                <td class="center"><input type="number" name="amount" readonly></td>
                                                
                                            </tr>
                                        <?php }?>    
                                        </tbody> 
                                        
                                    </table>                                
                                
                                <b><u>Term and Conditions</u></b>
                            
                                    <table class=" full-width">
                                        <thead>
                                            <tr>
												<th class="center">Price:<input type="text" name="price"></th>
												<th class="center"></th>
												<th class="center">Payment:<input type="text" name="payment"></th>
                                            </tr>
                            
                                            <tr>
												<th class="center">GST:<input type="text" name="gst"></th>
												<th class="center"></th>
												<th class="center">Validity:<input type="text" name="validity"></th>
                                            </tr>                                            
                                            
                                            <tr>
												<th class="center">Delivery:<input type="text" name="delivery"></th>
												<th class="center"></th>
												<th class="center">Warranty:<input type="text" name="warranty"></th>
                                            </tr>                                            
                                            
                                        </thead>
                                        
                                    </table>
                              <br>
                                <p>Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                                
                                <p>Your truly<br>For Intellitest Solutions Pvt. Ltd.</p>
                                <p>Chandani Mehta<br>Sales Executive - #9250059893</p>
                                <hr>
                                    <table class=" full-width">
                                        <thead>
                                            <tr>
												<th class="center"></th>
												<th class="center"></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody> 
                                            <tr>
                                                <td><b>Intellitest Solutions Pvt. Ltd.</b></td>
                                                <td style="text-align: right;">Toll Free : 1800123000003</td>
                                            </tr>
                                            <tr>
                                                <td>Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121107(Delhi NCR)</td>
                                                <td style="text-align: right;">Telephone : +91-129-4096069</td>
                                            </tr>
                                            <tr>
                                                <td>Regd Office - 119-FF, Vardhman Star City Mall, Sector-7, Dwarka, New Delhi -110075</td>
                                                <td style="text-align: right;">Mobile : +91-92550059892</td>
                                            </tr>
                                            <tr>
                                                <td>Web : www.intellitest.co.in</td>
                                                <td style="text-align: right;">Email : solutions@intellitest.co.in,intellitestspl@gmail.com</td>
                                            </tr>                                            
                                        </tbody> 
                                        
                                    </table>                                
                                
                                </div>
                            </div>
						         <div class="col-lg-12 p-t-20 text-center"> 
<input type="submit" name="submit" value="Print" id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink"  />
						            </div>
						      </form>      
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

function PrintElem(elem)
{
      myFunction($('<div/>').append($(elem).clone()).html());
}

function myFunction() {
var prtContent = document.getElementById("print");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}

</script>

</body>
</html>