<?php //echo '<pre>';        print_r($this->input->post());die;
require_once FCPATH.'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html><html lang="en"><head>';
$html .='<style>html, body {
            height: 100%;
            margin: 0;
            font-size:13px !important;
            font-family: "Times New Roman", Times, serif;
            color:#000000;
          }
          .content {
            min-height: 100%;
          }
          .content-inside {
            padding: 5px;
            padding-bottom: 10px;
          }
    .border-right { border-right: 1px solid #000;  }
  .no-border { border-bottom: 0;  }
.margin-0 { margin: 0;}
.padding-0 {  padding: 0;}
.table td{
  margin: 0;
 border: .1em solid #e6dfdf !important;
      padding: 0 0 5px 0;
     }
     
.table_ td {
  border:0;
 border-bottom: .1em solid #e6dfdf !important;
  border-right: .1em solid #e6dfdf !important;
}

    .first { border-top: 0; }
    .last { border-bottom: 0;}
    
.invoice-bill td{
 border: .1em solid #e6dfdf !important;
     }

.inner-items td{ border-bottom: 0;border-top: 0; }
.inner-items-bottom td{ border-bottom: 1px solid #000; }
b {font-weight:bold;}
hr{ margin-bottom:0 !important; }
</style>';
$html .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
$html .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>';
$html .=  '</head><body>';
$html .= '<div class="content">
                        <div class="content-inside">
                        <table class="full-width" style="text-align:center; border:0; width:100%;"><tr><td>Tax Invoice</td></tr></table>    
                               
  <table class="table full-width" style="margin-bottom:0; width:100%;">
    <tr>
    <td style="width:50%;vertical-align:baseline;">
        Seller<br><b>Intellitest Solutions Pvt. Ltd.</b><br> Business Hub 12A08 Sec.-81<br>Faridabad -121007 <br>GSTIN: '.$this->input->post('gst_number').'<br>TEL.: 0129-2976069, 2986069<br> Email: solutions@intellitest.co.in
        <br><br><b>Bank Details</b><br>
        Name: INTELLITEST SOLUTIONS PRIVATE LIMITED.<br>
        Account No.: 10076914831<br>
        RTGS/IFSC: IDFB0021314<br>
        Bank Name: IDFC First Bank
    </td>
      <td style="width:50%;padding-bottom:0;">
      <table class="table table_" cellspacing="0" cellpadding="0" style="margin-bottom:0;">
          <tbody>
          <tr>
            <td>
              Invoice No<br>
              <b>'.$this->input->post('invoice_no').'</b>
            </td>
            <td class="">
              Dated<br>
              <b>'.$this->input->post('invoice_date').'</b>
            </td>
          </tr>
          <tr>
            <td>
              Supplier`s Ref.<br>
              '.$this->input->post('supplier_ref').'
            </td>
            <td class="">
              Other Reference(s)<br>
              '.$this->input->post('other_ref').'
            </td>
          </tr>
          <tr>
            <td>
              Delivery Note<br>
              <span>'.$this->input->post('delivery_note').'</span>
            </td>
            <td>
              Mode/Terms of Payment<br>
              <span>'.$this->input->post('mode_payment').'</span>
            </td>
          </tr>
          <tr>
            <td class="">
              Buyers Order No<br>
              '.$this->input->post('buyer_order_no').'
            </td>
            <td class="">
              Dated<br>
              '.$this->input->post('buyer_dated').'
            </td>
          </tr>
        <tr>
            <td colspan="2" style="padding-bottom:0;">
            Eway Bill (If required)<br><br>
            <table class="table full-width" style="border:0;margin-bottom:0;">
                <tr><td style="width:43%;">eWay Bill No.</td><td>'.$this->input->post('eway_bill_no').'</td></tr>
                <tr><td>Transport Mode </td><td>'.$this->input->post('eway_bill_mode').'</td></tr>
                <tr><td>Vehicle number</td><td>'.$this->input->post('eway_bill_vehicle_no').'</td></tr>
                <tr><td>Date of Supply</td><td>'.$this->input->post('eway_bill_date_supply').'</td></tr>
                <tr><td>Place of Supply</td><td>'.$this->input->post('eway_bill_place_supply').'</td></tr>
            </table>
            </td>
            
          </tr>
        
         </tbody>
        </table>
        </td>
        </tr>
        <tr>
            <td>
            <p>Consignee</p>
            <p><b>'.$this->input->post('consignee').'</b><br>'.$this->input->post('consignee_address').'<br>'.$this->input->post('consignee_location').'</p>
            GSTIN:'.$this->input->post('consignee_gstin').'<br>
            PHONE:'.$this->input->post('consignee_phone').'<br>
            Email:'.$this->input->post('consignee_email').'
            </td><td><p> Buyer </p>
            <p><b>'.$this->input->post('buyer').'</b><br>'.$this->input->post('buyer_address').'<br>'.$this->input->post('buyer_location').'</p>
            GSTIN:'.$this->input->post('buyer_gstin').'<br>
            PHONE:'.$this->input->post('buyer_phone').'<br>
            Email:'.$this->input->post('buyer_email').'
            </td>
        </tr>
        </table>
    
        <table class="invoice-bill" style="width:100%;">
          <tr>
            <td width="5%">
              SL. No.
            </td>
            <td width="45%">
              Description of Goods
            </td>
            <td style="text-align:center;">
              HSN/SAC
            </td>
            <td style="text-align:center;" width="8%">
            Unit
            </td>
            <td style="text-align:center;">
              Rate
            </td>
            <td style="text-align:center;">
              Qty.
            </td>
            <td style="text-align:center;">
              Amount
            </td>
          </tr>';
$cnt = count($this->input->post('amount[]'));
$fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::CURRENCY);
for($i=0;$i<$cnt;$i++){
    if($this->input->post('amount['.$i.']')<>''){
$html .= '<tr class="inner-items" id="product_1">
            <td style="text-align:center;">'.($i+1).'</td>
            <td><b>'.$this->input->post('product_name['.$i.']').'</b></td>
            <td style="text-align:center;">'.$this->input->post('hsn_sac['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('unit['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('rate['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('quantity['.$i.']').'</td>
            <td><b>'.$fmt->format($this->input->post('amount['.$i.']')).'</b></td>
          </tr>';
}}

$td_tax = '<table style="width: 100%;">
<tr class="inner-items"><td colspan="2">Central Tax</td><td colspan="2">State Tax</td></tr>
<tr><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr>
</table>';


if($this->input->post('rdo_tax')=='cgst_sgst'){
$html .= '<tr class="inner-items"><td></td>
            <td style="text-align: right;"><b>CGST</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$fmt->format($this->input->post('cgst')).'</b></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>SGST</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$fmt->format($this->input->post('sgst')).'</b></td>
          </tr>';
}
if($this->input->post('rdo_tax')=='igst'){          
$html .= '<tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>IGST</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$fmt->format($this->input->post('igst')).'</b></td>
          </tr>';
$td_tax = '<table style="width: 100%;">
<tbody><tr><td colspan="2">Integrated Tax</td></tr>
<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
}
if($this->input->post('rdo_tax')=='gst_5'){
$html .= '<tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>GST@5%</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$fmt->format($this->input->post('gst_5')).'</b></td>
          </tr>';
$td_tax = '<table style="width: 100%;">
<tbody><tr><td colspan="2">Integrated Tax</td></tr>
<tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
}

$html .= '<tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>ROUND OFF</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$this->input->post('amount_round').'</b></td>
          </tr>
          <tr class="inner-items"><td style="line-height:120px;">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <tr>
            <td></td>
            <td style="text-align: right;">Total</td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td>'.$fmt->format($this->input->post('total_amount')).'</td>
          </tr>
          <tr class="">
              <td colspan="6"><span style="float: left;">Amount Chargeable (in words)</span><br/>
                  <b>'.$this->input->post('hdn_amount_words').'</b>
              </td>
              <td>E. & O.E</td>
          </tr>
        </table>
            <table class="invoice-bill" id="">
                <tr>
                    <td width="55%" style="text-align:center;">HSN/SAC</td><td width="10%">Taxable Value</td>
                    <td style="text-align:center;">
                        '.$td_tax.'
                    </td>
                    <td width="10%">Total Tax Amount</td>
                </tr>';
$total_amt_taxable = 0;$total_tax_amt=0;
for($i=0;$i<$cnt;$i++){
    if($this->input->post('amount['.$i.']')<>''){
        if($this->input->post('rdo_tax')=='cgst_sgst'){
            $total_amt_taxable = $total_amt_taxable + $this->input->post('amount['.$i.']');
            $total_tax_amt = $total_tax_amt + $this->input->post('rate_tax['.$i.']');
        $html .= '<tr>
                    <td style="text-align: left;">'.$this->input->post('hsn_sac['.$i.']').'</td><td>'.$this->input->post('amount['.$i.']').'</td>
                    <td>
                        <table style="width: 100%;">
                            <tr><td style="width: 19%;">9%</td><td>'.$this->input->post('rate_tax['.$i.']').'</td><td style="width: 19%;">9%</td><td>'.$this->input->post('rate_tax['.$i.']').'</td></tr></table>
                    </td>
                    <td>'.(2*trim($this->input->post('rate_tax['.$i.']'))).'</td>
                </tr>';
        }else{
            $total_amt_taxable = $total_amt_taxable + $this->input->post('amount['.$i.']');
            $total_tax_amt = $total_tax_amt + $this->input->post('rate_tax['.$i.']');
            $percentage_rate = 18;
            if($this->input->post('rdo_tax')=='gst_5'){ $percentage_rate = 5;}
            $html .= '<tr>
                    <td style="text-align: left;">'.$this->input->post('hsn_sac['.$i.']').'</td><td>'.$this->input->post('amount['.$i.']').'</td>
                    <td>
                        <table style="width: 100%;">
                    <tbody><tr><td style="width: 37%;">'.$percentage_rate.'%</td><td>'.$this->input->post('rate_tax['.$i.']').'</td></tr></tbody></table>
                    </td>
                    <td>'.$this->input->post('rate_tax['.$i.']').'</td>
                </tr>';
        }
}}         
    if($this->input->post('rdo_tax')=='cgst_sgst'){
       $html .='<tr class="tr_calc"><td style="text-align: right;">Total &nbsp;</td><td>'.$total_amt_taxable.'</td>';
       $html .='<td><table style="width: 100%;">';
       $html .='<tbody><tr><td style="width: 19%;"></td><td>'.$total_tax_amt.'</td><td style="width: 19%;"></td><td>'.$total_tax_amt.'</td></tr></tbody></table>';
       $html .='</td><td>'.(2*$total_tax_amt).'</td></tr>';
    }else{
        $html .='<tr class="tr_calc"><td style="text-align: right;">Total</td><td>'.$total_amt_taxable.'</td>';
        $html .='<td><table style="width: 100%;">';
        $html .='<tbody><tr><td style="width: 37%;"></td><td>'.$total_tax_amt.'</td></tr></tbody></table>';
        $html .='</td><td>'.$total_tax_amt.'</td></tr>';
    }           
  $html .= '</table>Tax Amount (in words) : <b>'.$this->input->post('hdn_tax_words').'</b>';
  $html .= '<table style="width: 100%;border:0;margin-top:50px;">
                <tr>
                    <td style="width: 50%;border: 0;">
                        <p>
                            Company`s CIN: U29128DL2011PTC212297<br>
                            Company`s CST No. : ABC1234560147<br>
                            Company`s PAN: AAJCA0972F<br>
                        </p>
                    </td>
                    <td style="border: 0;">
                       
                    </td>
                </tr>
            </table>';
  $html_footer = '<table class="invoice-bill" style="width: 100%;padding:0 !important;">
                <tr>
                    <td colspan="2" style="border: 0;">
                    Terms & Conditions:-<br>
                        Any dispute is subject to Faridabad Jurisdiction only irrespective of any condition in purchase order or any other document.
                    </td>
                </tr>
            </table>';
$mpdf->SetHTMLFooter($html_footer);
//$html .=$html_footer;
$html .= '</div></div></body></html>';
//echo $html;exit;
$mpdf->WriteHTML($html);
//$mpdf->Output(FCPATH.'assets/invoice.pdf','F');
$mpdf->Output('invoice.pdf','D');