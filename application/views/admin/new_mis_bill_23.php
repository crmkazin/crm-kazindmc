<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .table, th, td{
            border: 1px solid #fff;
        }
        .table1, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        .table4 tr td{
          border: none;
          font-size: 16px;
          font-weight: 400;

        }
        .table5 tr td{
          /* border: none; */
          border-right: 1px solid;
          border-left: 1px solid;
        }
        .table5 tr:nth-last-child(1){
          border-bottom: 1px solid;
        }
        .table>:not(caption)>*>* {
    padding: 0.2rem 0.2rem;
    font-size: 14px;
}
li{
  list-style: none;
}
ol, ul {
    padding-left: 0rem;
}
.table6 tr td{
border: none;
}
.table5 tr td{
  border:none;
  border-left: 1px solid;
}
        </style>
</head>
<body>
<?php $miscellinous=$miscellinous[0] ; ?>
   <div class="container" style="margin-left:12px;">
    <div class="row d-flex justify-content-center mt-3" >
      <div class="col-md-8" >
        <img src="<?=base_url()?>assets/images/new_logo.png" width="359px" alt="">
      </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" >
      <div class="col-md-8 d-flex justify-content-center" >
        <h4 class="d-flex justify-content-center pb-2" style="border-bottom: 1px solid #6c757d; width: 50%;">Miscellaneous Expenses</h4>
      </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
      <div class="col-md-8">
        <table class="table table4">
          <tr>
            <td></td>
            <td class="text-end">Date :    <?php $time = $miscellinous->date; echo $time = date("d-M-Y",strtotime($time));?></td>
            
          </tr>
          <tr>
            <td class="">Grade : <?php echo $miscellinous->grade; ?></td>
            <td class="text-end">Amount : <?php echo  number_format($miscellinous->bill_amount); ?></td>
          
            
          </tr>
          <tr>
            
            <td>Name : <?php echo $miscellinous->name; ?></td>
            <td class="text-end">Location : <?php echo $miscellinous->location; ?></td>
            
          </tr>
         
        </table>
        <table class="table  table5" style="height:630px;">
          <tr class="table" style="height: 30px;">
            <th style="width:50px;">S. No.</th>
            <th style="border:1px solid;">Bill No.</th>
            <th style="width:100px; border:1px solid;">Bill Date</th>
            <th  style="border:1px solid;">Expenses With Remark</th>
            <th  style="border:1px solid;">Amount</th>
          </tr>
          <?php
                   // echo '<pre>';    print_r($intercity_travel_expenses);exit;
                        
                        $i=1;
                       // echo '<pre>';print_r($local_travel_expenses);exit;
                       foreach($miscellinous_detail as $record2){
                          ?>
          <tr style="height: 30px;">
            <td><?php echo $i++; ?></td>
            <td><?php echo $record2->bill_no; ?></td>
            <td> <?php $time = $record2->bill_date; echo $time = date("d-m-Y",strtotime($time));?></td>
            <td><?php echo $record2->expenses_remarks; ?></td>
            <td style="border-right: 1px solid;"><?php echo number_format($record2->amount) ; ?></td>
          </tr>
          <?php } ?>
         
          
          <tr style="border-left: 1px solid;border-right: 1px solid;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
       <tbody height="30px" style="border:none;">
        <tr >
        <td colspan="4">Total</td>
        <td style="border-right: 1px solid;"><?php echo number_format($miscellinous->bill_amount) ; ?></td>
        </tr>
       </tbody>
          
        </table>
     
      </div>
      <div class="col-md-8" >
       <p class="text-end" id="rupess2">THIRTY THOUSAND RUPEES ONLY.</p>
        
        <table class="table table6">

            <td>Employee Signature</td>
            <td >Checked By</td>
            <td class="text-center">Approved By</td>
            <td class="text-end">Accounts</td>
          </tr>
          <tr>
            <td>______________</td>
            <td >______________</td>
            <td class="text-center">______________</td>
            <td class="text-end">______________</td>
          </tr>
         

        </table>
      </div>
    </div>
   </div>
</body>
<script>
   //alert('hello');
  var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

function inWords(num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return;
    var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
    return str;
}


</script>
<script>


 
 
 document.getElementById('rupess2').innerHTML=inWords(<?php echo $miscellinous->bill_amount; ?>).toUpperCase()+'RUPEES ONLY.';
 $word=inWords(<?php echo $miscellinous->bill_amount;?>).toUpperCase();
 console.log($word);
  

  
</script>
</html>