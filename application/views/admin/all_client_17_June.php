<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <style>
    .img-width {
        max-width: 80px;
    }
    </style>
    <!-- Include CSS files -->
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- Include header -->
        <?php include ('header.php'); ?>

        <div class="page-container">
            <!-- Include sidebar menu -->
            <?php include ('side_bar.php'); ?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Clients</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"><a class="parent-item"
                                        href="<?= base_url(); ?>clients">Clients</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Agents</header>
                                    <div class="tools"
                                        style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'block'; ?>">
                                        <a href="<?= base_url(); ?>company" class="btn btn-success" style="padding:6px;"
                                            title="Add Query B2B">
                                            <i class="fa fa-plus"></i> Add</a>

                                        <a href="<?php echo base_url('client-excel-download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                            id="export_to_excel" class="btn btn-success" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="get" autocomplete="off">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="">
                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="">

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Company</label>
                                                </div>
                                                <input type="hidden" name="company_id" id="company_id">
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="agent" id="agent" class="mdl-textfield__input">
                                                        <option value="">Select..</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Select Agent</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'email', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Agent email', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Email Address</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-scrollable">
                                        <table
                                            class="table table-hover table-checkable order-column full-width client-table"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Company Name</th>
                                                    <?php if (isset($company[0]->totalRows)): ?>
                                                    <th class="center">Total Agents</th>
                                                    <?php endif; ?>
                                                    <th class="center">Agent</th>
                                                    <!-- <th class="center">Total Agents</th> -->
                                                    <th class="center">Contact Number</th>
                                                    <th class="center">Email</th>
                                                    <th class="center">City</th>
                                                    <th class="center">State</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Date</th>
                                                    <th class="center remove">Company Logo</th>
                                                    <th class="center">Designation</th>
                                                    <th class="center remove">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($company)) {
                                                    $i = $offset + 1;
                                                    foreach ($company as $companies) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?= ucwords(strtolower($companies->name)); ?>
                                                    </td>
                                                    <?php if (isset($company[0]->totalRows)): ?>
                                                    <td class="center" id="totalRowsCell"><?= $companies->totalRows ?>
                                                    </td>
                                                    <?php endif; ?>
                                                    <td class="center"><?= $companies->contact_person ?></td>
                                                    <td class="center"><?= $companies->contact_person_number ?></td>
                                                    <td class="center"><?= $companies->email ?></td>
                                                    <td class="center"><?= ucwords(strtolower($companies->city)); ?>
                                                    </td>
                                                    <td class="center"><?= ucwords(strtolower($companies->state)); ?>
                                                    </td>
                                                    <td class="center"><?= ucwords(strtolower($companies->country)); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php $d = strtotime($companies->creation_date);
                                                                echo date('d-M-Y', $d); ?>
                                                    </td>
                                                    <td class="center remove"><img class="img-width"
                                                            src="<?= base_url('assets/company/') . $companies->company_logo; ?>"
                                                            alt=""></td>
                                                    <td class="center">
                                                        <?= ucwords(strtolower($companies->designation)); ?>
                                                    </td>
                                                    <td class="center" style="display:inline-flex;">
                                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client-logo"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit Logo"
                                                            style="background-color: #FFF;"><i class="fa fa-image"
                                                                style="color:#000;"></i></a>

                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>

                                                        <?php } else if ($companies->user_id == $this->session->userdata('id')) { ?>

                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client-logo"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit Logo"
                                                            style="background-color: #FFF;"><i class="fa fa-image"
                                                                style="color:#000;"></i></a>

                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>

                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                                        <a href="<?= base_url() . $companies->company_id ?>/delete-client"
                                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                                            class="btn btn-tbl-delete btn-xs" title="Delete">
                                                            <i class="fa fa-trash-o "></i>
                                                        </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                    <?php echo $links; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                            <!-- Table header -->
                            <thead>
                                <tr>
                                    <th class="center">Sr.No</th>
                                    <th class="center">Agent</th>
                                    <th class="center">Contact Number</th>
                                    <th class="center">Email</th>
                                    <th class="center">City</th>
                                    <th class="center">State</th>
                                    <th class="center">Country</th>
                                    <th class="center">Date</th>
                                    <th class="center">Designation</th>
                                    <!-- <th class="center">Action</th> -->
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <?php
                                $records_cnt = 0;
                                if (!empty($company_details)) {
                                    $i = $offset + 1;
                                    foreach ($company_details as $companies) {
                                        $records_cnt++;
                                        ?>
                                <tr class="odd gradeX">
                                    <td class="center"><?= $i++ ?></td>
                                    <td class="center"><?= $companies->contact_person ?></td>
                                    <td class="center">
                                        <?= $companies->contact_person_isd_code . ' ' . $companies->contact_person_number ?>
                                    </td>
                                    <td class="center"><?= $companies->email ?></td>
                                    <td class="center"><?= ucwords(strtolower($companies->city)); ?>
                                    </td>
                                    <td class="center"><?= ucwords(strtolower($companies->state)); ?>
                                    </td>
                                    <td class="center"><?= ucwords(strtolower($companies->country)); ?>
                                    </td>
                                    <td class="center">
                                        <?php $d = strtotime($companies->creation_date);
                                                echo date('d-M-Y', $d); ?>
                                    </td>
                                    <td class="center">
                                        <?= ucwords(strtolower($companies->designation)); ?>
                                    </td>
                                    <!-- <td class="center">
                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                        <?php } else if ($companies->user_id == $this->session->userdata('id')) { ?>
                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                        <a href="<?= base_url() . $companies->company_id ?>/delete-client"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-tbl-delete btn-xs" title="Delete">
                                            <i class="fa fa-trash-o "></i>
                                        </a>
                                        <?php } ?>
                                    </td> -->
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <style>
            /* Modal styles */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1;
                /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgba(0, 0, 0, 0.4);
                /* Black w/ opacity */
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                /* Could be more or less, depending on screen size */
            }

            /* Close button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
            </style>

        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>


    <script>
    $(document).ready(function() {
        $("#company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_agents();
            }
        });

        function get_agents() {
            if ($("#company_id").val() === "") {
                $("#agent").empty();
                return false;
            }
            var id = $('#company_id').val();

            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>get-agent-ajax/' + id,
                dataType: 'json',
                success: function(response) {
                    responseData = response.details; // Store the response data
                    console.log(responseData)
                    $("#agent").empty().parent().addClass("is-dirty");
                    $('#agent').append('<option value="">Select..</option>');
                    $.each(response.details, function(i, agent) {
                        $('#agent').append('<option value="' + agent.contact_person +
                            '">' + agent
                            .contact_person + '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching agents:", errorThrown);
                }
            });
        }

        $("#country").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#country').val(ui.item.label); // display the selected text
                $('#country_id').val(ui.item.country_id); // save selected id to input

                return false;
            }
        });

        function split( val ) {
            return val.split( /,\s*/ );
        }        
        function extractLast( term ) {
            return split( term ).pop();
        }
        $("#state").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('#country_id').val()
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                if(terms.length > 2){
                    $("#city").val("").attr('disabled','disabled');
                }else { $("#city").removeAttr('disabled');$('#state_id').val(ui.item.state_id); }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $("#city").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('#state_id').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );                
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        });
    });

    document.getElementById('totalRowsCell').addEventListener('click', function() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    document.getElementById('closeModal').addEventListener('click', function() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    });

    </script>

</body>

</html>