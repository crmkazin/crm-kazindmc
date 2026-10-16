<?php include ('admin_head_css.php'); ?>
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Party Bus</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('party-bus'); ?>">Party Bus List</a></li>
                                    <li class="breadcrumb-item active">Party Bus</li>
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
                              
                                <form method="get" class="content">
                                    <div class="card-body row">
                                        <div class="col-lg-12">
                                            <!-- <h4>Search</h4> -->
                                        </div>
                                        <div class="col-lg-2">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'booking_date', 'placeholder' => '', 'id' => 'booking_date', 'class' => 'dts mdl-textfield__input']) ?>
                                                <label class="mdl-textfield__label">Booking Date
                                                </label><?php //echo form_error('booking_date'); ?>
                                            </div-->
											
                                            <label class="mdl-textfield__label">Booking Date</label>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show bg-white" style="width:100%;"
													value="<?php echo ($this->input->get('booking_date') <> '') ? date('d M Y', strtotime($this->input->get('booking_date'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'booking_date', 'placeholder' => '', 'id' => 'booking_date', 'class' => 'bg-white dts dt-search', 'value' => ($this->input->get('booking_date') <> '') ? $this->input->get('booking_date') : '', 'style' => 'width:17px;float:right;position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
											</div>
                                            
                                        </div>

                                        <div class="col-lg-2">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">File Number</label>
                                                <?php echo form_input(['name' => 'file_number', 'id' => 'file_number', 'class' => 'bg-white mdl-textfield__input']) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Kazin Query</label>
                                                <?php echo form_input(['name' => 'kazin_query', 'id' => 'kazin_query', 'class' => 'bg-white mdl-textfield__input']) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Package</label>
                                                <select name="package" id="package" class="bg-white mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($packages as $package) {
                                                        ?>
                                                        <option value="<?= $package->id ?>">
                                                            <?= $package->package ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20 text-end">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => ' mt-2 btn btn-md btn-info', 'value' => 'Search']); ?>
                                                <a href="<?= base_url(); ?>add-party-bus" class="btn btn-info mt-2 ms-2"
                                            style="padding: 8px;"><i class="fa fa-plus"></i>New</a>
                                        <?php if (in_array($this->session->userdata('type'), ['1'])) { ?> 
                                        <a href="<?php echo base_url('partybus-excel-download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-info mt-2 ms-2" style="padding:8px; float:right"
                                            title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i></a>
                                        <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border no-wrap table-checkable order-column full-width" id="party_bus">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Date Of Booking</th>
                                                    <th class="center">Start Time</th>
                                                    <th class="center">End Time</th>
                                                    <th class="center">File No.</th>
                                                    <th class="center">Kazin Query</th>
                                                    <th class="center">No. of Passengers</th>
                                                    <th class="center">Package</th>
                                                    <th class="center">Package Price</th>
                                                    <th class="center">Balance</th>
                                                    <th class="center">Purchase Cost</th>
                                                    <th class="center">Net Margin</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = ($this->input->get('per_page')<>'')?$this->input->get('per_page'):0;
                                                // $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                                if (!empty($buses)) {
                                                    foreach ($buses as $bus) {

                                                        ?>
                                                        <form method="post">
                                                            <tr class="odd gradeX">
                                                                <td class="center"><?= ++$i ?></td>
                                                                <td class="center">
                                                                    <?= date('d-M-Y', strtotime($bus->date_of_booking)) ?>
                                                                </td>
                                                                <td class="center"><?= $bus->start_time ?></td>
                                                                <td class="center"><?= $bus->end_time ?></td>
                                                                <td class="center"><?= ucfirst($bus->file_number) ?></td>
                                                                <td class="center">
                                                                    <?= !empty($bus->kazin_query) ? $bus->kazin_query : '-' ?>
                                                                </td>
                                                                <td class="center"><?= $bus->number_of_passengers ?></td>
                                                                <td class="center">
                                                                    <?= !empty($bus->package) ? $bus->package : '-' ?>
                                                                </td>
                                                                <td class="center"><?= $bus->package_price ?></td>
                                                                <td class="center"><?= $bus->balance ?></td>
                                                                <td class="center"><?= $bus->purchase_cost ?></td>
                                                                <td class="center"><?= $bus->net_margin ?></td>
                                                                
                                                                <!-- <td class="center">
                                                            <?php if ($user->status == 0) {
                                                                echo "Active";
                                                            } else {
                                                                echo "Inactive";
                                                            } ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php
                                                            $type = ['1' => 'Admin', '2' => 'User', '3' => 'Accounts', '4' => 'International', '5' => 'Sales'];
                                                            //if(in_array($user->email,$super_admins)){ echo "Super Admin"; } elseif($user->type == 1){echo "Admin";}else {echo "User";}
                                                            echo $type[$user->type] . (($user->admin_type == 'superadmin') ? '<br>(Super Admin)' : '');
                                                            ?>
                                                        </td> -->
                                                                <td class="center">
                                                                    <a href="<?= base_url() . 'edit-party-bus?id=' . base64_encode($bus->id); ?>"
                                                                        class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                            class="fa fa-edit"></i></a>

                                                                    <a href="<?= base_url() . $bus->id . '/delete-bus'; ?>"
                                                                        onclick="return confirm('Are you sure you want to delete this Bus?');"
                                                                        class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                            class="fas fa-trash"></i></a>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        </form>
                                                    <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php //echo $links; ?>
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
    $(document).ready(function () {
        var table = $('#party_bus').DataTable({
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
        
        $(".dt-search").on("change", function () {
            var idx = $(this).index(".dt-search");
            const selectedDate = new Date($(".dt-search").eq(idx).val());
            if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
            $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
        });
    });
</script>

<script>
    $('#export_to_excel').click(function () {
        // Clone the table to avoid modifying the original table
        var clonedTable = $("#party_bus").clone();

        // Export the cloned table using table2excel plugin
        $('<table>')
            .append($(
                '<tr><td colspan="3"></td><td><strong>Partybus</strong></td></tr><tr></tr>'
            ))
            .append(clonedTable)
            .table2excel({
                preserveColors: true,
                filename: "Partybus.xls"
            });
    });
</script>