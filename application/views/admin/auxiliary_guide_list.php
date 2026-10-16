 <?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Ancillary Guide Masters</h4>
                        </div>
                        <div class="col-lg-4 only-for-dashbord">
                        </div>
                        <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item">Masters</li>
                                    <li class="breadcrumb-item">Ancillary Masters</li>
                                    <li class="breadcrumb-item active">Guide</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                            <form method="get" autocomplete="off" class="content">
                                <div class="card-body row">
                                    <!-- Country Field -->
                                    <div class="col-lg-3">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                           <label class="mdl-textfield__label">Select Country</label>

                                            <?php echo form_input([
                                                'name' => 'country', 
                                                'id' => 'countrys', 
                                                'placeholder' => 'Country', 
                                                'class' => 'mdl-textfield__input bg-white',
                                                'value' => $this->input->get('country')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id">

                                    <!-- Submit -->
                                    <div class="col-lg-3 mt-4">
                                        <?php echo form_submit([
                                            'name' => 'submit', 
                                            'id' => 'submit', 
                                            'class' => 'btn btn-md btn-info', 
                                            'style' => 'float:left;', 
                                            'value' => 'Search'
                                        ]); ?>
                                         <a href="<?= base_url('auxiliary-guide-create'); ?>" class="btn btn-info ms-3"
                                            style="padding:8px;" title="Create Masters"><i class="fa fa-plus"></i> 
                                        </a>
                                    </div>
                                </div>
                            </form>
                                <!-- <div class="card-head">
                                    <header>Ancillary Guide</header>
                                    <div class="tools">

                                        <a href="<?= base_url('auxiliary-guide-create'); ?>" class="btn btn-success"
                                            style="padding:6px;" title="Create Masters"><i class="fa fa-plus"></i> Add
                                        </a> -->
                                        <!--a id="export_to_excel" style="padding:6px;" class="btn btn-info" title="Export"><i class="fa fa-download"></i> Export </a-->
                                        <!-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width"
                                            id="auxiliary_guidelist">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Guide Type</th>
                                                     <th class="center">Vehicle</th> 
                                                    <th class="center">Languages</th>
                                                    <th class="center">Day Charge</th>
                                                    <th class="center">Day Start Timing</th>
                                                    <th class="center">Day Finish Timing</th>
                                                    <th class="center">Night Charge</th>
                                                    <th class="center">Night Start Timing</th>
                                                    <th class="center">Night Finish Timing</th>
                                                    <th class="center">OutStation Day Charge</th>
                                                    <th class="center">OutStation Start Timing</th>
                                                    <th class="center">OutStation Finish Timing</th>
                                                    <th class="center">Overnight Guide Charge</th>
                                                    <th class="center">Overnight Food Charge</th>
                                                    <th class="center">Overnight Accomodation Charge</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
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
                                                            <td class="center"><?php echo $companies->location; ?></td>
                                                            <td class="center"><?= ucfirst(($companies->guide_type == 'driver_cum_guide') ? 'Driver Cum Guide' : $companies->guide_type) ?></td>
                                                             <td class="center"><?= ucwords($companies->vehicle) ?></td> 
                                                            <td class="center"><?= str_replace(',', ' | ', $companies->languages) ?></td>
                                                            <td class="center"><?=$companies->day_charge; ?></td>
                                                            <td class="center"><?=$companies->day_start_time; ?></td>
                                                            <td class="center"><?=$companies->day_finish_time; ?></td>
                                                            <td class="center"><?=$companies->night_charge; ?></td>
                                                            <td class="center"><?=$companies->night_start_time; ?></td>
                                                            <td class="center"><?=$companies->night_finish_time; ?></td>
                                                            <td class="center"><?=$companies->outday_charge; ?></td>
                                                            <td class="center"><?=$companies->outday_start_time; ?></td>
                                                            <td class="center"><?=$companies->outday_end_time; ?></td>
                                                            <td class="center"><?=$companies->guide_charge; ?></td>
                                                            <td class="center"><?=$companies->food_charge; ?></td>
                                                            <td class="center"><?=$companies->accommodation_charge; ?></td>

                                                            <td class="center">
                                                                <a href="<?php echo base_url('auxiliary-guide-edit?id=' . base64_encode($companies->id)); ?>"
                                                                    class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                        class="fa fa-edit"></i></a>

                                                                <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <a href="<?= base_url('auxiliary-guide-delete?id=' . base64_encode($companies->id)) ?>"
                                                                        onclick="return confirm('Are you sure you want to delete this ?');"
                                                                        class="btn btn-tbl-delete btn-xs" title="Delete">
                                                                        <i class="fas fa-trash "></i> </a>
                                                                <?php } ?>
                                                            </td>
                                                            <td></td>
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
    </div>
<script>
    $('#export_to_excel').click(function () {
        $("#auxiliary_guidelist").table2excel({
            filename: "data.xls"
        });
    });

    $(document).ready(function () {
        var table = $('#auxiliary_guidelist').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: -1
                }
            },
             columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets: -1
                }
            ],
            order: [[0, 'asc']]
        });

        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;
        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_specific_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: { search: request.term, allowed_ids: allowedCountryIds.join(',') },
                    success: function (data) {
                        response(data);
                    }
                });
                country_flag = false;
            },
            select: function (event, ui) {
                $('#countrys').val(ui.item.label);
                $('#country_id').val(ui.item.country_id);
                country_flag = true;
                return false;
            }
        }).blur(function () {
            if (!country_flag) $("#countrys").val("");
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
