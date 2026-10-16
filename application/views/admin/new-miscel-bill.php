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
</head>
<style>
  
   
</style>
<body>
    <body>
        <div class="container header" style="background-color:#fff !important;">
        <table class="table table-hover table-checkable order-column full-width" style="border:none !important;">
                                            <thead style="border:none !important;">
                                                <tr style="border:none !important;">
                                                    <th style=" padding-top:1rem;text-align: left; border:none !important;"><img width="359px" src="<?=base_url()?>assets/images/new_logo.png"></th>
                                                    <th style="padding-bottom:2rem;text-align: right; border:none !important;"><br></th>
                                                </tr>
                                            </thead>
                                        </table>
        </div>
        <div  class="container cont1 mt-2">
            <div class="row ">
                <div class="col-md-12">
                    <h4 class="m text-center mt-3" >Miscellaneous Expenses</h4>
                    <hr>
                </div>
            </div>
            </div>
           
            <?php $miscellinous=$miscellinous[0] ; ?>
        
        <div class="container cont2" style="margin-bottom:50px ;">
       
            <div class="row" >
                <div class="col-md-12">
                    <table style="width:100%">
                       
    
                        <tr>
                            <th>Name</th>
                            <td><?php echo $miscellinous->name; ?></td>
                            <th> Date</th>
                            <td><?php echo $miscellinous->date; ?></td>
                        </tr>
                        <tr>
                            <th>Bill Amount</th>
                            <td><?php echo $miscellinous->bill_amount; ?></td>
                            <th></th>
                            <td></td>
                        </tr>
                                         
                        </table>                      
                </div>
            </div>
        </div>
        <div class="container cont2" style="margin-bottom:50px ;">
            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%;">
                    <?php if(!empty($miscellinous_detail)){
  ?>
                       <tr> <h6>MISCELLANEOUS TRAVEL</h6></tr>
                        <tr style="background-color:rgb(156, 155, 155) ;">
                            <th>S.No.</th>
                            <th>Bill No</th>
                            <th>Bill Date</th>
                            <th>Expenses With Remark</th>
                            <th>Amount</th>
                           
                        </tr>
                        <?php
                   // echo '<pre>';    print_r($intercity_travel_expenses);exit;
                        
                        $i=1;
                       // echo '<pre>';print_r($local_travel_expenses);exit;
                       foreach($miscellinous_detail as $record2){
                          ?>
                        <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $record2->bill_no; ?></td>
                        <td><?php echo $record2->bill_date; ?></td>
                        <td><?php echo $record2->expenses_remarks; ?></td>
                        <td><?php echo $record2->amount; ?></td>
                    </tr>
                    <?php } ?>
                        <?php } ?>
                       
                       
                    </table>
                    <div class="total" >
                        <h6 style="text-align:right ;"><small><strong > Total Amount: <?php echo $miscellinous->bill_amount; ?></strong></small></h6>
                        
                        <h6 style="text-align:right ;"><small id="rupess2"></small></h6>
                    </div>
                    <table style="width: 100%;">
                       
                    </table>
                    <table style="width: 100%;">
                     
                    </table>
                </div>
            </div>

            </div>

        <div class="container cont2" style="margin-bottom:-10px">
       
    
            <div class="row">
                <div class="col-md-12">
                    <h6></h6>
                    
                </div>
            </div>
             <?php 

            $total=count($miscellinous_detail);
            if($total<=6){
                
               echo '<br>';
               echo '<br>';
               echo '<br>';
               echo '<br>';
               echo '<br>';
               echo '<br>';
               echo '<br>';
               echo '<br>';
                
            }
            
            
            
            ?>
            <div class="row" style=" margin-top:-2px !important">
                <div class="col-md-12">
                    <table style="width:100%">
                    <tr >
                        <th class="thed" style="width:50%; border:0px solid; font-size:13px ;">&nbsp;</th>
                        <th  class="thed" style="width:50%; border:0px solid ;font-size:13px ;">FOR ACCOUNT DEPARTMENT USE ONLY</th>
                           
                        </tr>
                    <tr >
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Employee Signature :</th>
                        <th class="thed"  style="width:50%; border:0px solid ;font-size:13px ;">Paid to :	</th>
                           
                        </tr>
                    <tr >
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Approved by :	</th>
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Payment mode :		Cash / Cheque / Bank Transfer</th>
                           
                        </tr>
                    <tr >
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Received Rs……………. On…………</th>
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Payment details :	</th>
                           
                        </tr>
                    <tr >
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Receiver's Signature……………………</th>
                        <th class="thed" style="width:50%; border:0px solid ;font-size:13px ;">Account for :	</th>
                           
                        </tr>
                       
                        
                
                    </table>
                   
                   
                </div>
            </div>
            
            <div class="text-center">
       
      </div>
        </div>
        
        
         <footer>
        <div class="container cont2" style="margin-top:-17px;">
        <div class="row">
       
        
        
        </div>
        <button  id="myPrntbtn" class="btn btn-primary" style="float:right;margin-right:40px;" onclick="printMyPage()"; >PRINT</button>
        </div>
        </footer> 
        
    
        
</body>
</html>
<script type="text/javascript">
   // alert('hello');
    function printMyPage() {
        
        var printButton = document.getElementById("myPrntbtn");
        
        printButton.style.visibility = 'hidden';

        window.print()
        //-webkit-print-color-adjust: exact; 

        printButton.style.visibility = 'visible';
    }
</script>
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