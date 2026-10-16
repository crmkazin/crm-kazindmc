<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
    
 #overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 85%;
  z-index: 5000;
  top: 0;
  left: 245px;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}
button {
  margin: 40px;
  padding: 5px 20px;
  cursor: pointer;
}
.spinner {
    margin: 0 auto;
    height: 60px;
    width: 60px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid #2CA8FF;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.btnHide {
    position: absolute;
    top: 15px;
    color: red;
    right: 25px;
    cursor: pointer;
}
</style>
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
<style>
    
  .row{
    border-bottom: 1px solid #000; 
  }
   
    .border-right {
      border-right: 1px solid #000;
    }
  
  
  .no-border {
    border-bottom: 0;
  }


.margin-0 {
  margin: 0;
}

.padding-0 {
  padding: 0;
}

img {
  height: 30px;
}

.table {
  width: 100%;
  margin: 0;
  > tbody > tr {
    > td {
      border: 1px solid #000;
      padding: 5px 0 5px 10px;
      width: 50%;
    }
    
    .first {
      border-top: 0;
    }
    
    .last {
      border-bottom: 0;
    }
    
    b {
      display: block;
    }
    
    span {
      font-size: 14px;
    }
  }
}

.invoice-bill {
  width: 98%;
  text-align: center;
}

  td {
    border: .1em solid #e6dfdf;
  }
  
  .serial-no {
    width: 70px;
  }
  
  /*.particulars {
    width: 500px;
  }*/
  
  .amount {
    width: 150px;
  }
  
  .particular-items {
    padding: 5px 10px;
  }
  
  .amount-items {
    padding: 5px 0;
  }


.entry-id {
  margin: 35px 0;
}

.bank-details {
  margin-top: 30px;
}

.authorised-sign-wrapper {
  width: 300px;
  border: 1px solid #000;
  padding: 5px 20px;
}
p {font-size: 15px !important;}
.inner-items td{ border-bottom: 0;border-top: 0; }
.inner-items-bottom td{ border-bottom: 1px solid #000; }
</style>
<form method="post" onsubmit="return check_validations()" id="frminvoice">
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <!--div class="card-head">
                                    <header>All Invoices</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div-->
                                
    <div class="row margin-0">
      <div class="col-sm-12 center">
          <p style="margin-top:12px;"><b>Tax Invoice</b></p>
      </div>
    </div>
  
    <div class="row margin-0" style="padding-top:5px;">
      <div class="col-sm-6">
            <p>Seller<br><b>Intellitest Solutions Pvt. Ltd.</b><br/> Business Hub 12A08 Sec.-81<br/>Faridabad -121007 <br/>
                Phone.: +91-129-2976069, 2986069<br> Email : solutions@intellitest.co.in <br>CIN &nbsp;&nbsp;&nbsp;: U29128DL2011PTC212297 <br> GST: <select name="gst_number" id="gst_number" style="width:40%;height: 30px;"><option value="06AAJCA0972F1ZU">06AAJCA0972F1ZU</option><option value="07AAJCA0972F3ZQ">07AAJCA0972F3ZQ</option></select> <br> PAN: AAJCA0972F  
              
          <br><br><b>Bank Details</b><br>
          <label ><input type="radio" name="rdo_selectbank" value="idfc" checked=""> IDFC <input type="radio" value="icici" name="rdo_selectbank"> ICICI </label>
            <div id="idfc">Account Name : INTELLITEST SOLUTIONS PVT. LTD.<br>
          Account No.&nbsp;&nbsp;&nbsp;&nbsp; : 10076914831 | IFSC: IDFB0021314<br>
        Bank Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : IDFC First Bank | Branch :Sector - 21, Faridabad
        </div>
            <div id="icici" style="display:none;">Account Name : INTELLITEST SOLUTIONS PVT. LTD.<br>
          Account No.&nbsp;&nbsp;&nbsp;&nbsp; : 057105000683 | IFSC: ICIC0000571<br>
        Bank Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ICICI Bank <br> 
        Branch&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : A-117/118 Palam Extn., Sector-7
        Dwarka, New Delhi-110075
        </div>
      </div>
      <div class="col-sm-6 padding-0">
          <table class="table table_" style="width: 100%;" style="margin-bottom:0;">
          <tbody>
          <tr>
            <td style="width: 50%; padding: 15px; font-size: 1.05rem;">
              Invoice No. : <input name="invoice_no" value="<?php echo $detail->invoice_no; ?>" class="mdl-textfield__input" style="display:inline;width: 100%;">
            </td>
            <td style="width: 50%; padding: 15px; font-size: 1.05rem;" >
              Date : <input name="invoice_date" value="<?php echo $detail->date;//$invoice->date; ?>" class="mdl-textfield__input" style="display:inline;width: 75%;">
            </td>
          </tr>          
        <tr>
            <td colspan="2" style="padding-bottom:0; width:100%;">
           <!--  Eway Bill (If required)<br><br> -->
            <table style="width: 100%;" class="table full-width" style="border:0;margin-bottom:0;">
                <tbody><tr><td colspan="2" style="width:50%; padding: 15px; font-size: 1.05rem;">eWay Bill No. : <input name="eway_bill_no" value="<?php echo $detail->eway_bill_no; ?>" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></td></tr>
                <!-- <tr><td colspan="2" style="width:50%;padding: 10px; font-size: 1.05rem; ">Transporter GST No. : sfsdf/sdf-fsdf</td></tr> -->
                    <tr><td style="width:50%;padding: 15px; font-size: 1.05rem;">Reverse Charge : <select name="reverse_charge" id="reverse_charge" class="mdl-textfield__input float-right" style="width:25%;display:inline;"><option <?php if($detail->reverse_charge=="yes"){ echo 'selected="selected"'; } ?> value="yes">Yes</option><option <?php if($detail->reverse_charge=="no"){ echo 'selected="selected"'; } ?> value="no">No</option></select></td>
                    <td style="padding: 10px;">Place of Supply : <input name="place_of_supply" id="place_of_supply" value="<?php echo $detail->place_of_supply; ?>" class="mdl-textfield__input float-right" style="width:100%;display:inline;"></td></tr>
                    <tr><td colspan="2" style="width:50%;padding: 15px; font-size: 1.05rem; ">Buyers Order No. : <input name="buyers_order_no" value="<?php echo isset($detail->client_order_no)?$detail->client_order_no:''; ?>" class="mdl-textfield__input float-right" style="width:75%;display:inline;" readonly=""></td></tr>
            </tbody></table>
            </td>           
          </tr>
         </tbody>
        </table>
      </div>
    </div>
    <div class="row" style="padding: 10px;">
      <div class="col-sm-6 border-right">
          <p>Buyer /Bill to <span style="float: right;">Branch: <select name="branch_name" id="branch_name" onchange="change_branch(this.value);">
                <?php foreach($branch AS $list){ ?>
                    <option <?php if($list->branch_id == $detail->branch){ echo 'selected="selected"'; } ?> value="<?php echo $list->branch_id;  ?>"><?php echo $list->city; ?></option>
                <?php } ?>
            </select></span></p>
        <?php 
        $style = 'display:block;';
        foreach($branch AS $list){ ?>
              <div id="<?php echo $list->branch_id; ?>" style="<?php echo $style;  ?>" class="branch">
                  <p><input type="text" name="consignee[<?php echo $list->branch_id; ?>]" value="<?php echo $list->name; ?>" class="consignee mdl-textfield__input"/>
            <input type="text" name="consignee_address[<?php echo $list->branch_id; ?>]" value="<?php echo $list->address; ?>" class="consignee mdl-textfield__input"/>
            <input type="text" name="consignee_location[<?php echo $list->branch_id; ?>]" value="<?php echo $list->city.', '.$list->state.', '.$list->country; ?>" class="consignee mdl-textfield__input"/></p>
        
        <p>Phone:&nbsp;<input name="consignee_phone[<?php echo $list->branch_id; ?>]" value="<?php echo $list->contact_number; ?>" class="consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>Email:&nbsp;<input name="consignee_email[<?php echo $list->branch_id; ?>]" value="<?php echo $list->email; ?>" class="consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>GSTIN:&nbsp;<input name="consignee_gstin[<?php echo $list->branch_id; ?>]" id="" value="<?php echo ($list->gstin<>'')?$list->gstin:$detail->customer_gst; ?>" class="csg consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
        </div>
        <?php  $style='display:none;'; } ?>
      </div>
      <div class="col-sm-6 border-right">
        <p><input type="checkbox" id="chk_same"/> Consignee /Ship to <span style="float: right;">Branch: <select name="branch_name_consignee" id="branch_name_consignee" onchange="change_branch_consignee(this.value);">
                  <?php foreach($branch AS $list){ ?>
                  <option value="<?php echo $list->branch_id;  ?>"><?php echo $list->city; ?></option>
                  <?php } ?>
              </select></span></p>
              <p><input type="text" name="buyer" value="" class="buyer mdl-textfield__input" placeholder="Organization Name"/>
            <input type="text" name="buyer_address" value="" class="buyer mdl-textfield__input" placeholder="Complete Address"/>
            <input type="text" name="buyer_location" id="buyer_location" value="" class="buyer mdl-textfield__input" placeholder="City, State, Country"/></p>
        
        <p>Phone:&nbsp;<input name="buyer_phone" value="" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>Email:&nbsp;<input name="buyer_email" value="" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>GSTIN:&nbsp;<input name="buyer_gstin" value="" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
      </div>
    </div>
    
    <div class="row margin-0">
        <div class="col-sm-12 padding-0" style="min-height:500px;">
        <table class="invoice-bill">
          <tr>
            <td class="serial-no">
              <b>SL. No.</b>
            </td>
            <td class="particulars" width="50%">
              <b>Description of Goods /Services</b>
            </td>
            <td class="particulars">
              <b>HSN/SAC</b>
            </td>
            <td class="particulars">
              <b>Unit</b>
            </td>            
            <td class="particulars">
              <b>Rate</b>
            </td>
            <td class="particulars">
              <b>Qty.</b>
            </td>
            <td class="amount">
              <b>Amount</b>
            </td>
          </tr>
          <?php 
          //$equipment = explode(',',$detail->equipment);
          $equipment = explode('_~$~_',$detail->equipment); // 11 April 2023
          // $cnt = count($equipment);
          $hsn_sac = explode(',',$detail->hsn_sac);
          $unit = explode(',',$detail->unit);
          $rate = explode(',',$detail->rate);
          $cnt = count($rate); // 15 Feb 2023
          $quantity = explode(',',$detail->quantity);
          $amount = explode(',',$detail->amount);
          for($i=0;$i<$cnt;$i++){
          ?>
          <tr class="inner-items products" id="product_1">
            <td></td>
            <td><input type="text" name="product_name[]" class="mdl-textfield__input" value="<?php echo $equipment[$i]; ?>"/></td>
            <td><input type="text" name="hsn_sac[]" class="mdl-textfield__input t_hsn" value="<?php echo $hsn_sac[$i]; ?>"/></td>
            <td><input type="text" name="unit[]" class="mdl-textfield__input" value="<?php echo $unit[$i]; ?>"/></td>
            <td><input type="text" name="rate[]" class="mdl-textfield__input t2" value="<?php echo $rate[$i]; ?>" id="rate_1" onblur="addamount(this)"/></td>
            <td><input type="text" name="quantity[]" class="mdl-textfield__input t1" value="<?php echo $quantity[$i]; ?>" id="quantity_1" onblur="addamount(this)"/></td>
            <td><input type="text" name="amount[]" class="mdl-textfield__input t3" value="<?php echo $amount[$i]; ?>" id="amount_1" readonly=""/></td>
          </tr>
          <?php } ?>
          <tr><td colspan="7"><button class="btn btn-info btn-xs pull-right p-2 m-2 addRow"><i class="fa fa-plus">Add Row</i></button></td></tr>
          <tr><td></td><td colspan="6" style="text-align: left;">&nbsp;
                  <b>Tax Percentage:</b> <select name="tax_percentage" id="tax_percentage">
                    <?php for($i=0;$i<=20;$i++){ ?>
                      <option <?php if($detail->igst==$i){ echo 'selected="selected"'; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>  
                <input type="radio" name="rdo_tax" <?php if($detail->igst_tax == 'cgst_sgst'){ echo 'checked="checked"'; } ?> value="cgst_sgst"/> <b>CGST+SGST</b>&nbsp; <input type="radio" <?php if($detail->igst_tax == 'igst'){ echo 'checked="checked"'; } ?> name="rdo_tax" value="igst"/> <b>IGST</b>&nbsp; <input type="radio" <?php if($detail->igst_tax == 'gst_5'){ echo 'checked="checked"'; } ?> name="rdo_tax" value="gst_5"/> <b>GST@5%</b></td></tr>
          
          <!--tr class="inner-items">
            <td></td>
            <td style="text-align: right;">ROUND OFF</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="amount_round" id="amount_round" class="mdl-textfield__input"/></td>
          </tr-->
          
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;">Packing</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="packing" id="packing" value="<?php echo $detail->packing; ?>" class="mdl-textfield__input t4"/></td>
          </tr>
          
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;">Freight / Transport</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="fright" id="fright" value="<?php echo $detail->fright_transport; ?>" class="mdl-textfield__input t4"/></td>
          </tr>
          
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;">Installation / Mobilization</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="installation" id="installation" value="<?php echo $detail->installation_mobilization; ?>" class="mdl-textfield__input t4"/></td>
          </tr>
          
          <tr class="inner-items-bottoms">
            <td></td>
            <td colspan="5" style="text-align: right;">Total Amount Without Tax</td>
            <td><input type="text" name="total_without_tax" id="total_without_tax" value="<?php echo $detail->subtotal; ?>" class="calc_total mdl-textfield__input" required/></td>
          </tr>          
          
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;" colspan="5">CGST</td>
            <td><input type="text" name="cgst" class="mdl-textfield__input gst"/></td>
          </tr>
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;" colspan="5">SGST</td>
            
            <td><input type="text" name="sgst" class="mdl-textfield__input gst"/></td>
          </tr>
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;" colspan="5">IGST</td>
           
            <td><input type="text" name="igst" class="mdl-textfield__input gst"/></td>
          </tr>
          <tr class="inner-items-bottoms">
            <td></td>
            <td style="text-align: right;" colspan="5">GST@5%</td>
            
            <td><input type="text" name="gst_5" class="mdl-textfield__input gst"/></td>
          </tr>
               
          <tr class="inner-items-bottom">
              <td colspan="7">&nbsp;</td>
          </tr>
          
          <tr class="inner-items-bottom">
            <td></td>
            <td style="text-align: right;" colspan="5">Total Amount</td>
            <td><input type="text" name="total" value="" id="total" value="" class="calc_total mdl-textfield__input"/></td>
          </tr>
          
          <!--tr class="inner-items-bottom">
            <td></td>
            <td style="text-align: right;" colspan="5">Discount</td>
            
            <td><input type="text" name="discount" id="discount" value="" class="mdl-textfield__input"/></td>
          </tr-->
          
          <tr class="inner-items-bottom">
            <td></td>
            <td style="text-align: right;" colspan="5">Advanced Received</td>
            
            <td><input type="text" name="advanced_received" id="advanced_received" value="<?php echo $detail->received_amount; ?>" class="mdl-textfield__input"/></td>
          </tr>
          
          <tr class="inner-items-bottom">
            <td></td>
            <td style="text-align: right;" colspan="5">Total Amount Payable</td>            
            <td><input type="text" name="total_amount" id="total_amount" value="<?php echo $detail->amount_payable; ?>" class="mdl-textfield__input"/></td>
          </tr>
          <tr class="inner-items-bottom">
              <td colspan="7"><span style="float: right;">Amount Payable (in words)</span><br/>
                  <span style="float: right;font-weight: bold;" id="amount_words"></span>
                  <input type="hidden" name="hdn_amount_words" id="hdn_amount_words"/>
              </td>
              
          </tr>
        </table>
            <table class="invoice-bill hidden" id="tbl_hsn_tax">
                <tr>
                    <td style="width:56%;">HSN/SAC</td><td>Taxable Value</td>
                    <td style="text-align: center;" class="tdTax">
                        <table style="border:.1em solid #e6dfdf;width: 100%;">
                            <tr><td colspan="2">Central Tax</td><td colspan="2">State Tax</td></tr>
                            <tr><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr>
                        </table>
                            
                    </td>
                    
                        <td>Total Tax Amount</td>
                </tr-->
                <!--tr>
                    <td style="width:56%;text-align: left;">78547125</td><td>100000</td>
                    <td>
                        <table style="border:.1em solid #e6dfdf;width: 100%;">
                            <tr><td style="width: 19%;">9%</td><td>1000000</td><td style="width: 19%;">9%</td><td>1000000</td></tr></table>
                    </td>
                    <td>20000</td>
                </tr-->
                <!--tr>
                    <td style="width:56%;text-align: right;">Total</td><td>1000000</td>
                    <td><table style="border:.1em solid #e6dfdf;width: 100%;">
                            <tr><td style="width: 30%;">9%</td><td>1000000</td><td style="width: 30%;">9%</td><td>1000000</td></tr></table></td><td>Total Tax Amount</td>
                </tr-->
                
            </table>
      </div>
    </div>
                                <div id="tax_words"></div><input type="hidden" name="hdn_tax_words" id="hdn_tax_words" />
            <!--table style="width: 100%;border:0;margin-top:145px;">
                <tr>
                    <td style="width: 50%;border: 0;">
                        <p>
                            Company's CIN: U29128DL2011PTC212297<br>
                            Company's GSTIN: 06AAJCA0972F1ZU<br>
                            Company's PAN: AAJCA0972F<br>
                        </p>
                    </td>
                    <td style="border: 0;">
                       
                    </td>
                </tr>
            </table-->
            <table>
                <tr>
                    <td colspan="2" style="border: 0;">
                        <p style="text-align:center; font-weight: bold; font-size: 1.1rem;">NOTE: Any disputes is subject to Faridabad Jurisdiction only irrespective of any condition in Purchase 
                order or any other document /Communication.</p>
                    </td>
                </tr>
            </table>
                            </div></div></div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-6">
                            <input class="btn btn-lg btn-success pull-right p-2 m-2" type="submit" name="submit" value="Update">
                            <button type="button" id="btnpreview" class="btn btn-lg btn-info pull-right p-2 m-2">Preview</button>
                        </div> 
                    </div>
                </div></div></form>
</div>
<div id="overlay" style="display:none;">
            <i class="fa fa-close btnHide"></i>
            <div class="spinner"></div>
            <p style="padding-top: 12px;padding-left: 12px;font-weight: bold;">Loading...</p>
        </div>
        <!-- start footer -->
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->
<script>
    $(document).ready(function(){
        
        $("#advanced_received").on("blur",function(){
            var advanced = $(this).val();
            //var total_amount = $("#total_amount").val();
            var total_amount = $("#total").val();
            //var discount = $("#discount").val();
            if(advanced=='') { advanced=0; }
            //if(discount=='') { discount=0; } 
            var payable_amt = parseInt(total_amount)-parseInt(advanced);
            $("#total_amount").val(payable_amt);
            var t_words = inWords(payable_amt);
            $("#amount_words").html('').html(t_words);
            $("#hdn_amount_words").val(t_words);
        });
        
        $("#chk_same").on("click",function(){
            var i = 0;
            if($(this).is(":checked")){
                $('.consignee').each(function () {
                    $('.buyer').eq(i).val($(this).val());
                    i++;
                    //console.log($(this).val());
                });
                var ad = $('.buyer').eq(2).val().split(',');
                $("#place_of_supply").val(ad[0]+','+ad[1]);
            }else{
                $('.buyer').each(function () {
                    $(this).val('');
                });
                $("#place_of_supply").val('');
            }
        });
        
        $(".addRow").on("click",function(){
            event.preventDefault();
            var x = Math.floor((Math.random() * 1000) + 1);
            var h = $("#product_1").clone().attr('id','product_'+x);
            h.find('input').val('');
            h.append('<i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;"></i>');
            h.insertAfter(".products:last");
            $(".products:last").find('.t1').attr("id",'quantity_'+x);
            $(".products:last").find('.t2').attr("id",'rate_'+x);
            $(".products:last").find('.t3').attr("id",'amount_'+x); 
        });
        
        $(".invoice-bill").on('click', '.fa-remove', function(e){
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
            $("input[name='rdo_tax']").prop('checked', false);
            $('.gst').each(function () {
                $(this).val('');
            });
        });
        
        $("input[name='rdo_tax']").on("click",function(){
            
            var total = 0;
            $('.t3').each(function () {
                if($(this).val()!=''){
                    total = total + parseFloat($(this).val()); 
                }
            });
            
            $('.t4').each(function () {
                if($(this).val()!=''){
                    total = total + parseFloat($(this).val()); 
                }
            });
            $("#total_without_tax").val(total);
            //$("#advanced_received").val('');
            var tx = 0;
            $('.gst').each(function () {
                $(this).val('');
            });
            if($(this).val() == 'cgst_sgst'){
                let tx_percentage = ($("#tax_percentage").val())/2;
                tx = Math.round((total*tx_percentage)/100);
                //console.log(tx);
                $(".gst").eq(0).val(tx);
                $(".gst").eq(1).val(tx);
                tx = 2*tx;
                var td_gst = '<table style="border:.1em solid #e6dfdf;width: 100%;">';
                    td_gst += '<tbody><tr><td colspan="2">Central Tax</td><td colspan="2">State Tax</td></tr>';
                    td_gst += '<tr><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr></tbody></table>';
                $(".tdTax").html(td_gst);
                var cnt = 0;var tr_hsn;var total_amt_tax=0;
                $('.t3').each(function () {
                    var amt = $(this).val();
                    var amt_tax = (amt*tx_percentage)/100;
                    tr_hsn +='<tr class="tr_calc hidden"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
                    tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                    tr_hsn +='<tbody><tr><td style="width: 19%;">9%</td><td width="31%"><input type="text" name="rate_tax[]" style="text-align:center;" class="mdl-textfield__input" value="'+amt_tax+'"></td><td style="width: 19%;">9%</td><td>'+amt_tax+'</td></tr></tbody></table>';
                    tr_hsn +='</td><td>'+parseFloat(2*amt_tax)+'</td></tr>';
                    cnt++;
                    total_amt_tax = total_amt_tax+amt_tax;
                });
                var total_tax_payable = parseFloat((2*total_amt_tax).toFixed(2));
                tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: right;">Total</td><td>'+total+'</td>';
                tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                tr_hsn +='<tbody><tr><td style="width: 19%;"></td><td>'+total_amt_tax.toFixed(2)+'</td><td style="width: 19%;"></td><td>'+total_amt_tax.toFixed(2)+'</td></tr></tbody></table>';
                tr_hsn +='</td><td>'+total_tax_payable+'</td></tr>';
                $("#tbl_hsn_tax").find(".tr_calc").remove();
                $("#tbl_hsn_tax").append(tr_hsn);
                var t_payable = inWords(total_tax_payable);
                //$("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
                $("#hdn_tax_words").val(t_payable);
            }
            if($(this).val() == 'igst'){
                let tx_percentage = $("#tax_percentage").val();
                tx = Math.round((total*tx_percentage)/100);
                //tx = tx.toFixed(2);
                $(".gst").eq(2).val(tx);
                var td_gst = '<table style="border:.1em solid #e6dfdf;width: 100%;">';
                    td_gst += '<tbody><tr><td colspan="2">Integrated Tax</td></tr>';
                    td_gst += '<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
                $(".tdTax").html(td_gst);
                var cnt = 0;var tr_hsn;var total_amt_tax=0;
                $('.t3').each(function () {
                    var amt = $(this).val();
                    var amt_tax = (amt*tx_percentage)/100;
                    tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
                    tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                    tr_hsn +='<tbody><tr><td style="width: 37%;">18%</td><td><input type="text" name="rate_tax[]" style="text-align:center;" class="mdl-textfield__input" value="'+amt_tax+'"></td></tr></tbody></table>';
                    tr_hsn +='</td><td>'+parseFloat(amt_tax)+'</td></tr>';
                    cnt++;
                    total_amt_tax = parseFloat(total_amt_tax+amt_tax);
                });
                var total_tax_payable = parseFloat(total_amt_tax.toFixed(2));
                tr_hsn +='<tr class="tr_calc hidden"><td style="width:56%;text-align: right;">Total</td><td>'+total+'</td>';
                tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                tr_hsn +='<tbody><tr><td style="width: 37%;"></td><td>'+total_amt_tax.toFixed(2)+'</td></tr></tbody></table>';
                tr_hsn +='</td><td>'+total_tax_payable+'</td></tr>';
                $("#tbl_hsn_tax").find(".tr_calc").remove();
                $("#tbl_hsn_tax").append(tr_hsn);
                var t_payable = inWords(total_tax_payable);
                //$("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
                $("#hdn_tax_words").val(t_payable);
            }
            if($(this).val() == 'gst_5'){
                tx = Math.round((total*5)/100);
                //tx = tx.toFixed(2);
                $(".gst").eq(3).val(tx);
                var td_gst = '<table style="border:.1em solid #e6dfdf;width: 100%;">';
                    td_gst += '<tbody><tr><td colspan="2">Integrated Tax@5%</td></tr>';
                    td_gst += '<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
                $(".tdTax").html(td_gst);
                var cnt = 0;var tr_hsn;var total_amt_tax=0;
                $('.t3').each(function () {
                    var amt = $(this).val();
                    var amt_tax = (amt*5)/100;
                    tr_hsn +='<tr class="tr_calc hidden"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
                    tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                    tr_hsn +='<tbody><tr><td style="width: 37%;">5%</td><td><input type="text" name="rate_tax[]" style="text-align:center;" class="mdl-textfield__input" value="'+amt_tax+'"></td></tr></tbody></table>';
                    tr_hsn +='</td><td>'+parseFloat(amt_tax)+'</td></tr>';
                    cnt++;
                    total_amt_tax = parseFloat(total_amt_tax+amt_tax);
                });
                var total_tax_payable = parseFloat(total_amt_tax.toFixed(2));
                tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: right;">Total</td><td>'+total+'</td>';
                tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                tr_hsn +='<tbody><tr><td style="width: 37%;"></td><td>'+total_tax_payable+'</td></tr></tbody></table>';
                tr_hsn +='</td><td>'+total_tax_payable+'</td></tr>';
                $("#tbl_hsn_tax").find(".tr_calc").remove();
                $("#tbl_hsn_tax").append(tr_hsn);
                var t_payable = inWords(total_tax_payable);
                //$("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
                $("#hdn_tax_words").val(t_payable);
            }
            //console.log(total+tx);
            var t = (total+tx).toFixed(2);
            //console.log(t);
            st = t.split(".");
            if(parseInt(st[1]) <= 49){
                rf = "-0."+st[1];
                t = Math.round(t,2);
            }else{ 
                rf = "+0."+(parseInt(100-st[1]));
                t = Math.round(t,2);
            }
            $("#amount_round").val(rf);
            $("#total_amount").val(t);
            $("#total").val(t);
            /*var t_words = inWords(t);
            $("#amount_words").html('').html(t_words);
            $("#hdn_amount_words").val(t_words);*/
        });
        
        //$("#consignee_gstin").on("blur",function(){
        $(".csg").on("blur",function(){//alert('a');
            let text = $("input[name='consignee_gstin["+$("#branch_name").val()+"]']").val();//$(this).val();
            let result = text.substring(0, 2);
            let gst_number = $("#gst_number").val().substring(0, 2);
            //alert(gst_number);
            if(result != "" && result != gst_number){
                $("input[name='rdo_tax'][value='igst']").prop('checked', true);
            }else if(result != "" && result == gst_number){
                $("input[name='rdo_tax'][value='cgst_sgst']").prop('checked', true);
            }
        });
        
        $("#gst_number").on("change",function(){
            //if($("#consignee_gstin").val()!='') $("#consignee_gstin").trigger('blur');
            if($("input[name='consignee_gstin["+$("#branch_name").val()+"]']").val()!=''){
                $("input[name='consignee_gstin["+$("#branch_name").val()+"]']").trigger('blur');
            }
        });
        
        $("input[name='rdo_selectbank']").on("click",function(){
            //alert($("input[name='rdo_selectbank']:checked").val());
            $("#idfc").toggle();
            $("#icici").toggle();
        });
        
        
        $(".calc_total").on("focus",function(){
            let v = $("input[name='rdo_tax']:checked").val();
            //console.log(v);
            $("input[name='rdo_tax'][value='"+v+"']").trigger("click");
        });
        
        $("#buyer_location").on("blur",function(){
            if($(this).val() !== ''){
                var ad = $(this).val().split(',');
                if(ad.length === 3){
                    $("#place_of_supply").val(ad[0]+','+ad[1]);
                }else{
                    alert('Provide information as City, State, Country');
                }
            }
        });
        $(".calc_total").focus();
        $("#advanced_received").blur();
    });
    
    function change_branch_consignee(id){//alert(id);
        //$("input[name='consignee_gstin["+$this.value+"]']").val();
        var i = 0;
        $('#'+id+ ' .consignee').each(function () {
            $('.buyer').eq(i).val($(this).val());
            i++;
            //console.log($(this).val());
        });
        var ad = $('.buyer').eq(2).val().split(',');
        $("#place_of_supply").val(ad[0]+','+ad[1]);
    }
    
    function check_validations(){
        //if($("#reverse_charge").val()=='no' && $("#consignee_gstin").val()==''){
        if($("#reverse_charge").val()=='no' && $("input[name='consignee_gstin["+$("#branch_name").val()+"]']").val()==''){
            alert('GSTIN required in reverse charge!');
            return false;
        }
    }
    
    function addamount(elem){
        var num = $(elem).attr("id").split("_"); 
        //var amountid = "amount_".concat(num[1]);
        var quantity = document.getElementById("quantity_".concat(num[1])).value;
        var rate = document.getElementById("rate_".concat(num[1])).value;
        if(isNaN(quantity) || quantity==""){
            quantity = 1;
        }
        document.getElementById("amount_".concat(num[1])).value = Math.round(quantity * rate) ;
        //$("input[name='rdo_tax']").prop('checked', false);
        $('.gst').each(function () {
            $(this).val('');
        });
    }
    
    var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
    var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];

    function inWords (num_amt) {
        var q = num_amt.toFixed(2).toString().split(".");
        num = q[0];
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        if(q.length==2 && q[1] == '00') {
            let txt = " INR "+str; 
            if(txt.search(/only/i) == -1){
                txt = txt+' only';
            }
            return txt;
        }
        if(q.length > 1 && q[1] != '00'){
            str=str.replace(' and','');str=str.replace('only ','');
            num = parseInt(q[1]);
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str_new = '';
            str_new += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
            str_new += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
            str_new += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
            str_new += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
            str_new += (n[5] != 0) ? ((str_new != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'paise only ' : '';
            return " INR "+str+'and '+str_new;
        }
        
    }
    
    function change_branch(id){
        $(".branch").hide();
        $(".branch input").removeClass('consignee');
        $("#"+id).removeClass('hide').css('display','block');
        $("#"+id+" input").addClass('consignee');
        //$(".branch").find('.csg').attr("id",'');
        //$("#"+id).find('.csg').attr("id",'consignee_gstin');
        //$("input[name='consignee_gstin["+id+"]']").addClass('csg');
        $("#chk_same").prop('checked', false);
        $('.buyer').each(function () {
            $(this).val('');
        });
    }
    
    $(document).ready(function(){
        $("#btnpreview").on('click',function(e){
            e.preventDefault();
            if($("#total_without_tax").val()==''){
                alert("Make complete invoice to generate preview!");
                return false;
            }
            $('#overlay').fadeIn();
            let myForm = document.getElementById("frminvoice");
            var data = new FormData(myForm);
            $.ajax({
                url: "<?php echo site_url('invoice_generate_preview'); ?>",
                type: "post",
                data: data,
                responseType: 'blob',
                //dataType : 'blob',
                contentType : false,
                processData: false,
                success: function (data) {
                    // data should be your response data in base64 format
                    const blob = dataURItoBlob(data);
                    const url = URL.createObjectURL(blob);
                    // to open the PDF in a new window
                    window.open(url, '_blank');
                    $('#overlay').fadeOut();
                 }
            });
        });
    });
    function dataURItoBlob(dataURI) {
        const byteString = window.atob(dataURI);
        const arrayBuffer = new ArrayBuffer(byteString.length);
        const int8Array = new Uint8Array(arrayBuffer);
        for (let i = 0; i < byteString.length; i++) {
          int8Array[i] = byteString.charCodeAt(i);
        }
        const blob = new Blob([int8Array], { type: 'application/pdf'});
        return blob;
    }
    
    
</script>