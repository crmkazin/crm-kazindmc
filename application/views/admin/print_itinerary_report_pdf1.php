<!DOCTYPE html>
<html lang="en">
<head>
  <title>Itinerary</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="<?= base_url('assets/admin/print/css/bootstrap.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/admin/print/css/style.css') ?>" rel="stylesheet">
  <style>
    @media print {
      html { -webkit-print-color-adjust: exact; }
      .print-data { page-break-after: always; }
      .noPrint { display: none; }
    }
    strong { font-weight: bold; }
    .tbl-arrivals { margin-bottom: 8px; }
    .tbl-arrivals td { padding: 4px !important; }
    .table td, th { border: 1px solid #000 !important; padding: 4px !important; }
    @page * {
      margin-top: 2.54cm;
    }
  </style>
</head>
<body>
<div class="container print-data" id="cnt-print-data">
  <div class="row" style="margin:0 0px">
    <div class="col-lg-12">
      <div class="print-head">ITINERARY</div>
    </div>

    <table class="tbl-arrivals" style="border:0px;">
      <tbody>
        <tr>
          <td class="text-center" colspan="4">
            <div class="field-name" style="font-size:50px;">
              <label class="lab-data"><?= $data[0]->number_of_nights ?> Nights, <?= $stays ?> Days</label>
              (<label class="lab-data"><?= ucfirst($locations) ?></label>)
            </div>
          </td>
        </tr>
        <?php print_r($locations);?>
        <tr>
          <td><img src="<?php echo base_url();?>/assets/images/itinerary/<?= $locations ?>/1.jpg" width="100%" height="475"/></td>
          <td><img src="<?php echo base_url();?>/assets/images/itinerary/<?= $locations ?>/2.jpg" width="100%" height="475"/></td>
          <td><img src="<?php echo base_url();?>/assets/images/itinerary/<?= $locations ?>/3.jpg" width="100%" height="475"/></td>
          <td><img src="<?php echo base_url();?>/assets/images/itinerary/<?= $locations ?>/4.jpg" width="100%" height="475"/></td>
        </tr>
      </tbody>
    </table>

    <?php
    if (!empty($itinerary)) {
        $i = 0;
        $day = 1;
        $itinerary_date = $itinerary[0]->date;

        foreach ($itinerary as $list) {
            if ($i == 0 || $itinerary_date != $list->date) {
                ?>
                <table class="table mt-2">
                  <thead>
                    <tr>
                      <th colspan="12" class="bg-secondary">
                        <strong class="text-white">Day: <?= $day++ ?></strong>
                      </th>
                    </tr>
                    <tr>
                      <th class="bg-warning" width="10%"><strong class="text-white">Time</strong></th>
                      <th class="bg-warning" width="70%"><strong class="text-white">Activities</strong></th>
                      <th class="bg-warning" width="20%"><strong class="text-white">Remark</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
            }

            ?>
            <tr style="border-bottom: 1px solid #000;">
              <td class="bg-white"><?= $list->time ?></td>
              <td class="bg-white">
                <?= ($list->title != '') ? urldecode($list->title) . '<br>' : '' ?>
                <?= urldecode($list->content) ?>
              </td>
              <td class="bg-white"><?= urldecode($list->remarks) ?></td>
            </tr>
            <?php

            $itinerary_date = $list->date;
            if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) {
                echo '</tbody></table>';
            }
            $i++;
        }
    }
    ?>
  </div>
</div>
</body>
</html>