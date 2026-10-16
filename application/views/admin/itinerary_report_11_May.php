<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php include ('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Arrivals Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Itinerary Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Itinerary Report</header>
                                    <!-- <div class="tools">
                                        <a href="<?= base_url(); ?>add-party-bus" class="btn btn-success"
                                            style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div> -->
                                </div>
                                <form method="get">
                                    <div class="card-body row">
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($locations);
                                                    foreach ($locations as $key => $val) {
                                                        $val[] = 'All'; ?>
                                                    <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>">
                                                        <?= ucfirst($key) ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="no_of_nights" id="no_of_nights"
                                                    class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($nights);
                                                    foreach ($nights as $night) {
                                                        ?>
                                                    <option value="<?= $night->number_of_nights ?>"
                                                        data-abbr="<?= $night->number_of_nights ?>">
                                                        <?= ucfirst($night->number_of_nights) ?>
                                                    </option>
                                                    <?php } ?>

                                                </select>
                                                <label class="mdl-textfield__label">No. of Nights</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">S.No.</th>
                                                    <th class="center">Query <br>Number</th>
                                                    <th class="center">Guests</th>
                                                    <th class="center">No. of Nights</th>
                                                    <th class="center">Arrival</th>
                                                    <th class="center">Departure</th>
                                                    <th class="center">Itinerary Brief Content</th>
                                                    <th class="center">Print</thclass>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = 1;
                                                    foreach ($result as $list) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?= $list->enquiry_no ?></td>
                                                    <td class="center">
                                                        <?php echo $list->number_persons + $list->number_child; ?>
                                                        (<?php echo $list->number_persons; ?>A+<?php echo $list->number_child; ?>C)
                                                        <?php echo $list->group_type; ?>
                                                    </td>
                                                    <td class="center"><?= $list->number_of_nights ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= date('d M, Y', strtotime($list->check_in_date)) ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= date('d M, Y', strtotime($list->check_out_date)) ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= urldecode($list->content) . ' ...'; ?>
                                                    </td>
                                                    <td class="center"> <a
                                                            href="<?= base_url('print-itinerary-voucher?arrival_id=' . base64_encode($list->arrival_id)) ?>"
                                                            class="btn btn-tbl-edit btn-xs"
                                                            title="Print Restaurant Voucher"
                                                            style="background-color:green;" target="_blank"><i
                                                                class="fa fa-print"></i></a></td>
                                                </tr>
                                                <?php }
                                                } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <script>
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true,
            //"scrollY": "200px",
            "pageLength": 10

        });
    });
    </script>
</body>

</html>