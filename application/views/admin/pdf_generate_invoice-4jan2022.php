<?php //echo '<pre>';        print_r($this->input->post());die;
//ini_set('display_errors', 1); 
//error_reporting(E_ALL);
 
require_once FCPATH.'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html><html lang="en"><head>';
$html .='<style>html, body {
            height: 100%;
            margin: 0;
            /*font-size:13px !important;*/
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
    .border-right { border-right: .1em solid #000;  }
  .no-border { border-bottom: 0;  }
.margin-0 { margin: 0;}
.padding-0 {  padding: 0;}
.table td{
  margin: 0;
 border: .1em solid #000 !important;
      padding: 0 0 5px 0;
     }
     
.table_ td {
  border:0;
 border-bottom: .1em solid #000 !important;
  border-right: .1em solid #000 !important;
}

    .first { border-top: 0; }
    .last { border-bottom: 0;}
    
.invoice-bill td{
 border: .1em solid #000 !important;
 padding:2px;
     }

.inner-items td{ border-bottom: 0;border-top: 0;}
.inner-items-bottom td{ border-bottom: .1em solid #000;}
b {font-weight:bold;}
hr{ margin-bottom:0 !important; }
.invoice-bill-head td { font-weight:bold; }
.company-name { font-size: 1.2rem; }
</style>';
$html .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
$html .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>';
$html .=  '</head><body>';
$html .= '<div class="content">
                        <div class="content-inside">
                        <table class="full-width" style="text-align:center; border:0; width:100%; margin-bottom:5px;font-size:0.7rem;"><tr><td>Tax Invoice</td></tr></table>    
                               
  <table class="table full-width" style="margin-bottom:0; width:100%;font-size:1rem;">
    <tbody>
    <tr>
    <td style="vertical-align:baseline;padding-left: 10px;" width="50%">
        Seller<br><span class="company-name"><b>Intellitest Solutions Pvt. Ltd.</b><br> Business Hub 12A08 Sec.-81<br>Faridabad (Haryana), India-121007 </span>'.'<br>Phone.: +91-129-2976069, 2986069 <br> Email: solutions@intellitest.co.in<br>CIN &nbsp;: U29128DL2011PTC212297 <br> GST &nbsp;: 06AAJCA0972F1ZU<br>PAN &nbsp;: AAJCA0972F
        <br><br><b>Bank Details</b><br>
        Account Name : INTELLITEST SOLUTIONS PVT. LTD.<br>
          Account No.&nbsp;&nbsp;&nbsp;&nbsp; : 10076914831 | IFSC: IDFB0021314<br>
        Bank Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : IDFC First Bank | Branch :Sector - 21, Faridabad
    </td>
      <td style="padding:0 !important;">
      <table class="" cellspacing="0" cellpadding="0" style="margin-bottom:0;padding:0;border:0;">
          <tbody>
          <tr>
            <td style="width: 70%; padding: 15px;border-left:0;border-bottom:0;border-top:0;">
              Invoice No. : <b>'.$this->input->post('invoice_no').'</b>
            </td>
            <td style="width: 30%; padding: 15px;border-bottom:0;border-right:0;border-top:0;" >
              Date : <b>'.$this->input->post('invoice_date').'</b>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-bottom:0; width:100%;border:0;">
           <!--  Eway Bill (If required)<br><br> -->
            <table style="width: 100%;border:0;margin-bottom:0;" class="full-width">
                <tbody><tr><td colspan="2" style="width:50%; padding: 15px;border-left:0;border-right:0;">eWay Bill No. : '.$this->input->post('eway_bill_no').'</td></tr>
                <tr><td colspan="2" style="padding: 15px;border:0;">Reverse Charge : '.$this->input->post('reverse_charge').'</td></tr>
                <tr><td colspan="2" style="padding: 15px;border-left:0;border-bottom:0;border-right:0;">Place of Supply : '.$this->input->post('place_of_supply').'</td></tr>
                <tr><td colspan="2" style="padding: 15px;border-left:0;border-bottom:0;border-right:0;padding-bottom:25px;">Buyers Order No. : '.$this->input->post('buyers_order_no').'</td></tr>
                
            </tbody></table>
            </td> 
          </tr>        
         </tbody>
        </table>
        </td>
        </tr>
        <tr>
            <td style="padding-left: 10px;">
            <p style="margin: 0;">Buyer / Bill to</p>
            <p style="margin: 0;"><span class="company-name"><b>'.$this->input->post('consignee').'</b><br>'.$this->input->post('consignee_address').'<br>'.$this->input->post('consignee_location').'</span></p>
            Phone&nbsp;&nbsp;: '.$this->input->post('consignee_phone').'<br>
            Email&nbsp;&nbsp;&nbsp;: '.$this->input->post('consignee_email').'<br>
            GSTIN&nbsp;&nbsp;: '.$this->input->post('consignee_gstin').'</td><td style="padding-left: 10px;"><p style="margin: 0;">Consignee / Ship to </p>
            <p style="margin: 0;"><span class="company-name"><b>'.$this->input->post('buyer').'</b><br>'.$this->input->post('buyer_address').'<br>'.$this->input->post('buyer_location').'</span></p>
            Phone&nbsp;&nbsp;: '.$this->input->post('buyer_phone').'<br>
            Email&nbsp;&nbsp;&nbsp;: '.$this->input->post('buyer_email').'<br>
            GSTIN&nbsp;&nbsp;: '.$this->input->post('buyer_gstin').'
            </td>
        </tr></tbody>
        </table>
    
        <table class="invoice-bill" style="width:100%;font-size: 0.7rem;">
          <tr class="invoice-bill-head">
            <td width="5%">
              S.No.
            </td>
            <td width="45%">
              Description of Goods / Services
            </td>
            <td style="text-align:center;">
              HSN / SAC
            </td>
            <td style="text-align:center;" width="10%">
            Unit
            </td>
            <td style="text-align:center;">
              Rate
            </td>
            <td style="text-align:center;" width="4%">
              Qty.
            </td>
            <td style="text-align:center;">
              Amount
            </td>
          </tr>';
$cnt = count($this->input->post('amount[]'));
$fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL );
for($i=0;$i<$cnt;$i++){
    if($this->input->post('amount['.$i.']')<>''){
$html .= '<tr class="inner-items-bottoms" id="product_1">
            <td style="text-align:center;">'.($i+1).'</td>
            <td><b>'.$this->input->post('product_name['.$i.']').'</b></td>
            <td style="text-align:center;">'.$this->input->post('hsn_sac['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('unit['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('rate['.$i.']').'</td>
            <td style="text-align:center;">'.$this->input->post('quantity['.$i.']').'</td>
            <td style="text-align:right;"><b> &#8377;'.$fmt->format($this->input->post('amount['.$i.']')).'</b></td>
          </tr>';
}}

$html .='<tr class="inner-items-bottoms"><td></td>
            <td style="text-align: right;"><b>Packing</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('packing')).'</b></td>
          </tr>';
$html .=     '<tr class="inner-items-bottoms"><td></td>
            <td style="text-align: right;"><b>Freight / Transport</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('fright')).'</b></td>
          </tr>';
$html .=     '<tr class="inner-items-bottoms"><td></td>
            <td style="text-align: right;"><b>Installation / Mobilization</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('installation')).'</b></td>
          </tr>';

//$td_tax = '<table style="width: 100%;"><tr class="inner-items"><td colspan="2">Central Tax</td><td colspan="2">State Tax</td></tr><tr><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr></table>';
$html .= '<tr class="inner-items-bottoms">
            <td colspan="6" style="text-align: right;"><b>Total Amount Without Tax</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('total_without_tax')).'</b></td>
          </tr>';

if($this->input->post('rdo_tax')=='cgst_sgst'){
$html .= '<tr class="inner-items-bottoms">
            <td colspan="6" style="text-align: right;"><b>CGST@9%</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('cgst')).'</b></td>
          </tr>
          <tr class="inner-items-bottoms">
            <td colspan="6" style="text-align: right;"><b>SGST@9%</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('sgst')).'</b></td>
          </tr>';
}
if($this->input->post('rdo_tax')=='igst'){          
$html .= '<tr class="inner-items-bottoms">
            <td colspan="6" style="text-align: right;"><b>IGST@18%</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('igst')).'</b></td>
          </tr>';
//$td_tax = '<table style="width: 100%;"><tbody><tr><td colspan="2">Integrated Tax</td></tr><tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
}
if($this->input->post('rdo_tax')=='gst_5'){
$html .= '<tr class="inner-items-bottoms">
            <td colspan="6" style="text-align: right;"><b>GST@5%</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('gst_5')).'</b></td>
          </tr>';
//$td_tax = '<table style="width: 100%;"><tbody><tr><td colspan="2">Integrated Tax</td></tr><tr><td>Rate</td><td>Amount</td></tr></tbody></table>';
}

/*$html .= '<tr class="inner-items">
            <td></td>
            <td style="text-align: right;"><b>ROUND OFF</b></td>
            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td><b>'.$this->input->post('amount_round').'</b></td>
          </tr>';*/

$html .= '<tr class="inner-items-bottoms">
              <td colspan="7">&nbsp;</td>
          </tr>';

$html .= '<tr><td colspan="6" style="text-align: right;"><b>Total Amount</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('total')).'</b></td>
          </tr><tr><td colspan="6" style="text-align: right;"><b>Advanced Received</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('advanced_received')).'</b></td>
          </tr><tr><td colspan="6" style="text-align: right;"><b>Total Amount Payable</b></td>
            <td style="text-align: right;"><b> &#8377;'.$fmt->format($this->input->post('total_amount')).'</b></td>
          </tr>
          <tr class="">
              <td colspan="7" style="text-align: right;"><span>Amount Payable (in words)</span><br/>
                  <b>'.$this->input->post('hdn_amount_words').'</b>
              </td>
          </tr>
        </table>';
        /*$html .='<table class="invoice-bill" id="">';
             $html . ='<tr><td width="55%" style="text-align:center;">HSN/SAC</td><td width="10%">Taxable Value</td><td style="text-align:center;">'.$td_tax.'</td><td width="10%">Total Tax Amount</td></tr>';
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
  $html .= '</table>';*/
  /*$html .= 'Tax Amount (in words) : <b>.$this->input->post('hdn_tax_words').</b><table style="width: 100%;border:0;margin-top:50px;">
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
            </table>';*/
  /*$html_footer = '<table class="invoice-bill" style="width: 100%;padding:0 !important;">
                <tr>
                    <td colspan="2" style="border: 0;">
                    Terms & Conditions:-<br>
                        Any dispute is subject to Faridabad Jurisdiction only irrespective of any condition in purchase order or any other document.
                    </td>
                </tr>
            </table>';*/
//$mpdf->SetHTMLFooter($html_footer);
//$html .=$html_footer;
$html .= '<br><p style="text-align:center; font-weight: bold;font-size:0.7rem;">NOTE: Any disputes is subject to Faridabad Jurisdiction only irrespective of any condition in Purchase 
                order or any other document / Communication.</p>';
$html .= '</div></div></body></html>';
//echo $html;exit;
$mpdf->WriteHTML($html);
//$mpdf->Output(FCPATH.'assets/invoice.pdf','F');
$mpdf->Output('invoice.pdf','D');