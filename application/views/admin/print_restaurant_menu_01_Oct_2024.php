<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=$restaurant_menus->name ?> Menu Report</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
        @media print {
            html {
                -webkit-print-color-adjust: exact;
            }

            .print-data {
                page-break-after: always;
            }

            .noPrint {
                display: none;
            }
        }
        .tr_rows>td { font-weight:bold; } 
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12 text-start logo-left bg-new"><img
                    src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
        </div>
        <div class="row" style="margin:0 0px ">
            <div class="col-lg-12">
                <div class="print-head">RESTAURANT MENU</div>
            </div>

            <div class="col-lg-12">
                <div class="in-pl">

                </div>
            </div>
            
            <!-- Restaurant Menu -->

            <?php if (!empty($restaurant_menus)) { ?>

            <div class="col-lg-12">
            
                <div class="in-pl">
                    <table class="table table-bordered">
                        <thead>
                            <tr>                                
                                <th class="bg-warning text-center"><strong class="text-white">Restaurant</strong></th>
                                <th class="bg-warning text-center"><strong class="text-white">Restaurant Address</strong></th> 
                                <th class="bg-warning text-center"><strong class="text-white">City</strong></th>
                                <th class="bg-warning text-center"><strong class="text-white">Country</strong></th>                                 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bg-light-back text-center"><strong><?=$restaurant_menus->name ?></strong></td>
                                <td class="bg-light-back text-center"><strong><?=$restaurant_menus->restaurant_address ?></strong></td>
                                <td class="bg-light-back text-center"><strong><?=$restaurant_menus->city ?></strong></td>
                                <td class="bg-light-back text-center"><strong><?=$restaurant_menus->country ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
                <div class="in-pl">
                    <table class="table table-bordered">
                        
                        <tbody>

                            <tr>
                                <td class="bg-light-back text-center" colspan="2"><strong>Menus</strong></td>
                            </tr>
                            <?php
                                    foreach ($restaurant_menus->menu_cuisine_map as $menu_type => $cuisine_items) {
                                        
                                        ?>
                            <tr>
                                <td class="bg-light-back" style="width:15%;">
                                    <strong><?php echo ucfirst(str_replace('_', ' ', $menu_type)); ?></strong>
                                </td>
                                <td class="bg-light-back" width="90%"><?= $cuisine_items ?></td>
                            </tr>
                            <?php
                            }
                            ?>                                    
                            
                        </tbody>


                    </table>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-lg-12">
                <p style="text-align: center;color: #fda2a2;">No Restaurant Menu</p>
            </div>
            <?php } ?>


            <!-- partial -->
        </div>

    </div>
</body>

<br>
    <div class="content row noPrint">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
            <button class="btn btn-warning btn-sm" onclick="window.open('<?php echo base_url('print-restaurant-menu-report?restaurant='.$restaurant_menus->restaurants_id.'&print=pdf'); ?>','_blank')">Save As Pdf</button>
            <!--<button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>-->
        </div>
    </div>
    <br>

</html>
<script>
    function exportHTMLToDoc() {
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><meta charset='utf-8'><title>" + '<?php echo $arrivals->enquiry_no; ?>' + "</title></head><body>";
        var footer = "</body></html>";
        var sourceHTML = header + document.getElementById("cnt-print-data").innerHTML + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;

        fileDownload.download = '<?php echo $arrivals->enquiry_no .'_restaurant_voucher'; ?>.doc';

        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>