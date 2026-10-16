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
  width: 100%;
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
                               
  <table class="table full-width" style="margin-bottom:0;">
    <tr>
    <td style="width:55%">
        <p><b>Intellitest Solutions Pvt. Ltd.</b><br/> Business Hub 12A08 Sec.-81<br/>Faridabad -121007 <br/>GSTIN/UIN: '.$this->input->post('gst_number').'<br/>PAN: AAJCA0972F<br/>TEL.: 0129-2976069, +91-9250059892-93<br/> Email: solutions@intellitest.co.in</p><hr>
        <p>Consignee</p>
        <p><b>'.$this->input->post('consignee').'</b><br>'.$this->input->post('consignee_address').'<br>'.$this->input->post('consignee_location').'</p><hr>
            <p> Buyer (if other than consignee)</p>
        <p><b>'.$this->input->post('buyer').'</b><br>'.$this->input->post('buyer_address').'<br>'.$this->input->post('buyer_location').'</p>
    </td>
      <td style="width:45%;vertical-align:baseline;">
      <table class="table_ full-width" cellspacing="0" cellpadding="0">
          <tbody>
          <tr>
            <td>
              Invoice No<br>
              <b>INV00147</b>
            </td>
            <td class="">
              Dated<br>
              <b>14/09/21</b>
            </td>
          </tr>
          <tr>
            <td>
              Delivery Note<br>
              <span></span>
            </td>
            <td>
              Mode/Terms of Payment<br>
              <span></span>
            </td>
          </tr>
          <tr>
            <td>
              Supplier`s Ref.<br>
              <b>111111</b>
            </td>
            <td class="">
              Other Reference(s)<br>
              <b>11/12/2016</b>
            </td>
          </tr>
         
          <tr>
            <td class="">
              Buyers Order No<br>
              <b>11/12/2016</b>
            </td>
            <td class="">
              Dated<br>
              <b>11/12/2016</b>
            </td>
          </tr>
        
        
          <tr>
            <td colspan="2" style="border-bottom:0;">
              Terms of Delivery<br>
              <b></b>
            </td>
            
          </tr>
         </tbody>
        </table>
        </td>
        </tr>
        </table>
    
        <table class="invoice-bill" style="width:100%;">
          <tr>
            <td width="5%">
              SL. No.
            </td>
            <td width="50%">
              Description of Goods
            </td>
            <td>
              HSN/SAC
            </td>
            <td>
              Quantity
            </td>
            <td>
              Rate
            </td>
            <td>
              Per
            </td>
            <td>
              Amount
            </td>
          </tr>';
$cnt = count($this->input->post('amount[]'));
for($i=0;$i<$cnt;$i++){
    if($this->input->post('amount['.$i.']')<>''){
$html .= '<tr class="inner-items" id="product_1">
              <td>'.($i+1).'</td>
              <td><b>'.$this->input->post('product_name['.$i.']').'</b></td>
              <td>'.$this->input->post('hsn_sac['.$i.']').'</td>
              <td>'.$this->input->post('quantity['.$i.']').'</td>
              <td>'.$this->input->post('rate['.$i.']').'</td>
              <td>'.$this->input->post('per['.$i.']').'</td>
              <td><b>'.$this->input->post('amount['.$i.']').'</b></td>
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
            <td><b>'.$this->input->post('cgst').'</b></td>
          </tr>
          <tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>SGST</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$this->input->post('sgst').'</b></td>
          </tr>';
}
if($this->input->post('rdo_tax')=='igst'){          
$html .= '<tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>IGST</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$this->input->post('igst').'</b></td>
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
            <td><b>'.$this->input->post('gst_5').'</b></td>
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
            <td>'.$this->input->post('total_amount').'</td>
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
       $html .='<tr class="tr_calc"><td style="text-align: right;">Total</td><td>'.$total_amt_taxable.'</td>';
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
                            Company`s VAT TIN : ABC1234560147<br>
                            Company`s CST No. : ABC1234560147<br>
                            Declaration<br>
                            We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
                        </p>
                    </td>
                    <td style="border: 0;">
                        <p>Company`s Bank Details<br>
                        Bank Name : ICICI Bank<br>
                        A/c No. : 057105000683<br>
                        A/C Name : Intellitest Solutions Pvt. Ltd.<br>
                        Branch : A-117/118 Palam Extn., Sector-7, Dwarka, New Delhi-110075<br>
                        IFSC Code : ICIC0000571

                        </p>
                    </td>
                </tr>
            </table>
            <table class="invoice-bill" style="width: 100%;padding:0 !important;">
                <tr><td style="width:50%;vertical-align:baseline;">Customer`s Seal and Signature</td>
                    <td style="text-align: right;vertical-align:baseline;">
                        for Intellitest Solutions Pvt. Ltd.<br><br><br>
                        <span>Authorized Signatory</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;border: 0;">This is a Computer Generated Invoice</td></tr>
            </table></div>
        </div>';

$html .= '</body></html>';
//echo $html;
$mpdf->WriteHTML($html);
//$mpdf->Output(FCPATH.'assets/invoice.pdf','F');
$mpdf->Output('invoice.pdf','D');