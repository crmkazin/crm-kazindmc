 <?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-6 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Ancillary Luggage Vehicle Masters</h4>
                        </div>
                        <!--<div class="col-lg-2 only-for-dashbord">-->
                        <!--</div>-->
                        <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item">Masters</li>
                                    <li class="breadcrumb-item">Ancillary Masters</li>
                                    <li class="breadcrumb-item active">Ancillary Luggage Vehicle</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-content">
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <!-- <header>Ancillary Luggage Vehicle</header> -->
                                    <div class="tools">

                                        <a href="<?= base_url('auxiliary-luggage-vehicle-create'); ?>" class="btn btn-info"
                                            style="padding:6px;" title="Create Masters"><i class="fa fa-plus"></i> 
                                        </a>
                                        <!--a id="export_to_excel" style="padding:6px;" class="btn btn-info" title="Export"><i class="fa fa-download"></i> Export </a-->
                                        <!-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable order-column full-width"
                                            id="auxiliary_luggage_vehicle">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Vehicle Type</th>
                                                    <!-- <th class="center">Vehicle Name</th> -->
                                                    <th class="center">Price</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                                $i = 1;
                                                if (!empty($result)) {
                                                    foreach ($result as $companies) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?php echo $companies->country; ?></td>
                                                            <td class="center"><?=$companies->vehicle_type;?></td>
                                                            <!-- <td class="center"><?=  $companies->vehicle_name; ?></td> -->
                                                            <td class="center"><?=$companies->price; ?></td>

                                                            <td class="center">
                                                                <a href="<?php echo base_url('auxiliary-luggage-vehicle-edit?id=' . base64_encode($companies->id)); ?>"
                                                                    class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                        class="fa fa-edit"></i></a>

                                                                <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <a href="<?= base_url('auxiliary-luggage-vehicle-delete?id=' . base64_encode($companies->id)) ?>"
                                                                        onclick="return confirm('Are you sure you want to delete this ?');"
                                                                        class="btn btn-tbl-delete btn-xs" title="Delete">
                                                                        <i class="fas fa-trash"></i> </a>
                                                                <?php } ?>
                                                            </td>
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
    </div>
<script>
    $('#export_to_excel').click(function () {
        $("#auxiliary_luggage_vehicle").table2excel({
            filename: "data.xls"
        });
    });

    $(document).ready(function () {
        var table = $('#auxiliary_luggage_vehicle').DataTable({
            responsive: true
            //"scrollY": "200px",
            //"paging": false
        });

        table.columns.adjust().draw(false);
        $('.mdl-textfield__input').on('click', function (e) {
            // Get the column API object
            var column = table.column($(this).attr('data-column'));
            // Toggle the visibility
            column.visible(!column.visible());
            table.columns.adjust().draw(false);
            $('.view_all').prop("checked", false);
            $(".dataTables_info").parent().parent('div').show();
        });

        $(".view_all").on('click', function () {
            if ($(this).prop("checked") === true) {
                $('.mdl-textfield__input').prop('checked', true);
                table.columns('.center').visible(true);
                $(".dataTables_info").parent().parent('div').show();
            } else {
                $('.mdl-textfield__input').prop("checked", false);
                table.columns('.center').visible(false);
                $(".dataTables_info").parent().parent('div').hide();
            }
        });

    });
</script>