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
<form method="post">
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
      <div class="col-sm-5">
          <p>Seller<br><b>Intellitest Solutions Pvt. Ltd.</b><br/> Business Hub 12A08 Sec.-81<br/>Faridabad -121007 <br/>GSTIN: <input type="text" name="gst_number" class="mdl-textfield__input" value="06AAJCA0972F1ZU" style="display:inline;width: 75%;"><br/>TEL.: 0129-2976069, 2986069<br/> Email: solutions@intellitest.co.in</p>
          <br><br><b>Bank Details</b><br>
        Name: INTELLITEST SOLUTIONS PRIVATE LIMITED.<br>
        Account No.: 10076914831<br>
        RTGS/IFSC: IDFB0021314<br>
        Bank Name: IDFC First Bank
      </div>
      <div class="col-sm-7 padding-0">
        <table class="table" cellspacing="0" cellpadding="10">
          <tbody>
          <tr>
            <td class="first">
              <b>Invoice No</b>
              <span><input name="invoice_no" value="<?php echo $invoice->invoice_no; ?>" class="mdl-textfield__input" style="display:inline;width: 75%;"></span>
            </td>
            <td class="first">
              <b>Dated</b>
              <span><input name="invoice_date" value="<?php echo $invoice->date; ?>" class="mdl-textfield__input" style="display:inline;width: 75%;"></span>
            </td>
          </tr>
          <tr>
            <td class="last">
              <b>Supplier's Ref</b>
              <span><input name="supplier_ref" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
            <td class="last">
              <b>Other Reference(s)</b>
              <span><input name="other_ref" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
          </tr>
          <tr>
            <td>
              <b>Delivery Note</b>
              <span><input name="delivery_note" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
            <td>
              <b>Mode/Terms of payment</b>
              <span><input name="mode_payment" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
          </tr>
          <tr>
            <td class="first b-left">
              <b>Buyer's Order No</b>
              <span><input name="buyer_order_no" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
            <td class="first">
              <b>Dated</b>
              <span><input name="buyer_dated" value="<?php //echo $invoice->date; ?>" class="mdl-textfield__input" ></span>
            </td>
          </tr>
          <tr>
              <td class="" colspan="2">
              <b>Eway Bill (If required)</b>
              <p>eWay Bill No.: <input name="eway_bill_no" value="" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></p>
              <p>Transport Mode: <input name="eway_bill_mode" value="" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></p>
              <p>Vehicle number: <input name="eway_bill_vehicle_no" value="" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></p>
              <p>Date of Supply: <input name="eway_bill_date_supply" value="" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></p>
              <p>Place of Supply: <input name="eway_bill_place_supply" value="" class="mdl-textfield__input float-right" style="width:75%;display:inline;"></p>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row margin-0">
      <div class="col-sm-6 border-right">
        <p>Consignee</p>
        <p><input type="text" name="consignee" value="<?php echo $invoice->name; ?>" class="consignee mdl-textfield__input"/>
            <input type="text" name="consignee_address" value="<?php echo $invoice->address; ?>" class="consignee mdl-textfield__input"/>
            <input type="text" name="consignee_location" value="<?php echo $invoice->city.', '.$invoice->state.', '.$invoice->country; ?>" class="consignee mdl-textfield__input"/></p>
        <p>GSTIN:<input name="consignee_gstin" value="<?php //echo $invoice->date; ?>" class="consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>PHONE:<input name="consignee_phone" value="<?php //echo $invoice->date; ?>" class="consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>Email:<input name="consignee_email" value="<?php //echo $invoice->date; ?>" class="consignee mdl-textfield__input" style="display:inline;width: 75%;"></p>
      </div>
      <div class="col-sm-6 border-right">
        <p><input type="checkbox" id="chk_same"/> Buyer </p>
        <p><input type="text" name="buyer" value="" class="buyer mdl-textfield__input"/>
            <input type="text" name="buyer_address" value="" class="buyer mdl-textfield__input"/>
            <input type="text" name="buyer_location" value="" class="buyer mdl-textfield__input"/></p>
        <p>GSTIN:<input name="buyer_gstin" value="<?php //echo $invoice->date; ?>" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>PHONE:<input name="buyer_phone" value="<?php //echo $invoice->date; ?>" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
        <p>Email:<input name="buyer_email" value="<?php //echo $invoice->date; ?>" class="buyer mdl-textfield__input" style="display:inline;width: 75%;"></p>
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
              <b>Description of Goods</b>
            </td>
            <td class="particulars">
              <b>HSN/SAC</b>
            </td>
            <td class="particulars">
              <b>UOM</b>
            </td>            
            <td class="particulars">
              <b>Quantity</b>
            </td>
            <td class="particulars">
              <b>Unit Price</b>
            </td>
            <td class="amount">
              <b>Amount (&#8377;)</b>
            </td>
          </tr>
          <tr class="inner-items products" id="product_1">
            <td></td>
            <td><input type="text" name="product_name[]" class="mdl-textfield__input" value="<?php echo $invoice->enquiry_for; ?>"/></td>
            <td><input type="text" name="hsn_sac[]" class="mdl-textfield__input t_hsn"/></td>
            <td><input type="text" name="unit[]" class="mdl-textfield__input"/></td>
            <td><input type="text" name="quantity[]" class="mdl-textfield__input t1" id="quantity_1" onblur="addamount(this)"/></td>
            <td><input type="text" name="rate[]" class="mdl-textfield__input t2" id="rate_1" onblur="addamount(this)"/></td>
            
            <td><input type="text" name="amount[]" class="mdl-textfield__input t3" id="amount_1" readonly=""/></td>
          </tr>
          <tr><td colspan="7"><button class="btn btn-info btn-xs pull-right p-2 m-2 addRow"><i class="fa fa-plus">Add Row</i></button></td></tr>
          <tr><td></td><td colspan="6" style="text-align: left;">&nbsp;<input type="radio" name="rdo_tax" value="cgst_sgst"/> <b>CGST+SGST</b>&nbsp; <input type="radio" name="rdo_tax" value="igst"/> <b>IGST</b>&nbsp; <input type="radio" name="rdo_tax" value="gst_5"/> <b>GST@5%</b></td></tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;">CGST</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="cgst" class="mdl-textfield__input gst" readonly=""/></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;">SGST</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="sgst" class="mdl-textfield__input gst" readonly=""/></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;">IGST</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="igst" class="mdl-textfield__input gst" readonly=""/></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;">GST@5%</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="gst_5" class="mdl-textfield__input gst" readonly=""/></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;">ROUND OFF</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="amount_round" id="amount_round" class="mdl-textfield__input"/></td>
          </tr>
          <tr class="inner-items-bottom">
            <td></td>
            <td style="text-align: right;">Total</td>
            <td colspan="4">&nbsp;</td>
            <td><input type="text" name="total_amount" id="total_amount" value="" class="mdl-textfield__input"/></td>
          </tr>
          <tr class="inner-items-bottom">
              <td colspan="6"><span style="float: left;">Amount Chargeable (in words)</span><br/>
                  <span style="float: left;font-weight: bold;" id="amount_words"></span>
                  <input type="hidden" name="hdn_amount_words" id="hdn_amount_words"/>
              </td>
              <td>E. & O.E</td>
          </tr>
        </table>
            <table class="invoice-bill" id="tbl_hsn_tax">
                <tr>
                    <td style="width:56%;">HSN/SAC</td><td>Taxable Value</td>
                    <td style="text-align: center;" class="tdTax">
                        <!--table style="border:.1em solid #e6dfdf;width: 100%;">
                            <tr><td colspan="2">Central Tax</td><td colspan="2">State Tax</td></tr>
                            <tr><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr>
                        </table-->
                            
                    </td>
                    
                        <td>Total Tax Amount</td>
                </tr>
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
            <table style="width: 100%;border:0;margin-top:145px;">
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
            </table>
            <table>
                <tr>
                    <td colspan="2" style="border: 0;">
                        Terms & Conditions:-<br>
                        Any dispute is subject to Faridabad Jurisdiction only irrespective of any condition in purchase order or any other document.
                    </td>
                </tr>
            </table>
                            </div></div></div>
                    <div class="row"><div class="col-md-offset-6 col-md-6"><input class="btn btn-lg btn-success pull-right p-2 m-2" type="submit" name="submit" value="Submit"></div> </div>
                </div></div></form>
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
        $("#chk_same").on("click",function(){
            var i = 0;
            if($(this).is(":checked")){
                $('.consignee').each(function () {
                    $('.buyer').eq(i).val($(this).val());
                    i++;
                    //console.log($(this).val());
                });
            }else{
                $('.buyer').each(function () {
                    $(this).val('');
                });
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
                total = total + parseFloat($(this).val()); 
            });
            var tx = 0;
            $('.gst').each(function () {
                $(this).val('');
            });
            if($(this).val() == 'cgst_sgst'){
                tx = (total*9)/100;
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
                    var amt_tax = (amt*9)/100;
                    tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
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
                $("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
                $("#hdn_tax_words").val(t_payable);
            }
            if($(this).val() == 'igst'){
                tx = (total*18)/100;
                $(".gst").eq(2).val(tx);
                var td_gst = '<table style="border:.1em solid #e6dfdf;width: 100%;">';
                    td_gst += '<tbody><tr><td colspan="2">Integrated Tax</td></tr>';
                    td_gst += '<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
                $(".tdTax").html(td_gst);
                var cnt = 0;var tr_hsn;var total_amt_tax=0;
                $('.t3').each(function () {
                    var amt = $(this).val();
                    var amt_tax = (amt*18)/100;
                    tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
                    tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                    tr_hsn +='<tbody><tr><td style="width: 37%;">18%</td><td><input type="text" name="rate_tax[]" style="text-align:center;" class="mdl-textfield__input" value="'+amt_tax+'"></td></tr></tbody></table>';
                    tr_hsn +='</td><td>'+parseFloat(amt_tax)+'</td></tr>';
                    cnt++;
                    total_amt_tax = parseFloat(total_amt_tax+amt_tax);
                });
                var total_tax_payable = parseFloat(total_amt_tax.toFixed(2));
                tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: right;">Total</td><td>'+total+'</td>';
                tr_hsn +='<td><table style="border:.1em solid #e6dfdf;width: 100%;">';
                tr_hsn +='<tbody><tr><td style="width: 37%;"></td><td>'+total_amt_tax.toFixed(2)+'</td></tr></tbody></table>';
                tr_hsn +='</td><td>'+total_tax_payable+'</td></tr>';
                $("#tbl_hsn_tax").find(".tr_calc").remove();
                $("#tbl_hsn_tax").append(tr_hsn);
                var t_payable = inWords(total_tax_payable);
                $("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
                $("#hdn_tax_words").val(t_payable);
            }
            if($(this).val() == 'gst_5'){
                tx = (total*5)/100;
                $(".gst").eq(3).val(tx);
                var td_gst = '<table style="border:.1em solid #e6dfdf;width: 100%;">';
                    td_gst += '<tbody><tr><td colspan="2">Integrated Tax@5%</td></tr>';
                    td_gst += '<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
                $(".tdTax").html(td_gst);
                var cnt = 0;var tr_hsn;var total_amt_tax=0;
                $('.t3').each(function () {
                    var amt = $(this).val();
                    var amt_tax = (amt*5)/100;
                    tr_hsn +='<tr class="tr_calc"><td style="width:56%;text-align: left;">'+$(".t_hsn").eq(cnt).val()+'</td><td>'+amt+'</td>';
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
                $("#tax_words").html("Tax Amount (in words) : <b>"+t_payable+"</b>");
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
            var t_words = inWords(t);
            $("#amount_words").html('').html(t_words);
            $("#hdn_amount_words").val(t_words);
        });
        
    });
    function addamount(elem){
        var num = $(elem).attr("id").split("_"); 
        //var amountid = "amount_".concat(num[1]);
        var quantity = document.getElementById("quantity_".concat(num[1])).value;
        var rate = document.getElementById("rate_".concat(num[1])).value;
        if(isNaN(quantity) || quantity==""){
            quantity = 1;
        }
        document.getElementById("amount_".concat(num[1])).value = quantity * rate;
        $("input[name='rdo_tax']").prop('checked', false);
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
        if(q.length==2 && q[1] == '00') return " INR "+str;
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
    
</script>
