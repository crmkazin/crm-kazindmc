<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  
    <style>
        .dataTables_scrollHeadInner{
            width:auto !important;
        }
    </style>  
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
                                <div class="page-title">Database Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Database Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Database Report</header>
                                    <div class="float-right">                                        
                                        <a href="<?php echo base_url('admin/report/database_report_excel?'.$this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                </div>
                                <form method="get" autocomplete="off">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>$this->input->get('country')]) ?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="">
                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="">

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input', 'value'=>($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                                                    <label class="mdl-textfield__label">Company</label>
                                                </div>
                                                <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
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
                                                    <?php echo form_input(['name' => 'email', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Agent email', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('email'))]) ?>
                                                    <label class="mdl-textfield__label">Email Address</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'mobile', 'type' => 'text', 'id' => 'mobile', 'placeholder' => 'Agent Contact Details', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('mobile'))]) ?>
                                                    <label class="mdl-textfield__label">Contact Number</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            </div>
                                        </div>
                                    </form>
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No </th>
                                                    <th class="center">Company</th>
                                                    <th class="center">Total Agents</th>
                                                    <th class="center">GST</th>
                                                    <th class="center">Address</th>
                                                    <th class="center">Pincode</th>
                                                    <th class="center">City</th>
                                                    <th class="center">State</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Added Date</th>
                                                    <th class="center remove">Company Logo</th>
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
                                                            <td class="center">
                                                                <a class="btn btn-primary view-agent-btn" data-toggle="modal" data-target="#myModal" data-id="<?= $companies->company_id ?>" style="padding: 3px 10px;" title="View"><?= $companies->totalRows ?></a>
                                                            </td>
                                                            <td class="center"><?= !empty($companies->gstin) ? ucwords(strtolower($companies->gstin)) : '-'; ?></td>
                                                            <td class="center"><?= !empty($companies->address) ? $companies->address : '-'; ?></td>
                                                            <td class="center"><?= !empty($companies->pincode) ? $companies->pincode : '-'; ?></td>
                                                            <td class="center"><?= !empty($companies->city) ? ucwords(strtolower($companies->city)) : '-'; ?></td>
                                                            </td>
                                                            <td class="center"><?= !empty($companies->state) ? ucwords(strtolower($companies->state)) : '-'; ?></td>
                                                            </td>
                                                            <td class="center"><?= !empty($companies->country) ? ucwords(strtolower($companies->country)) : '-'; ?></td>
                                                            </td>
                                                            <td class="center">
                                                                <?php $d = strtotime($companies->date);
                                                                echo date('d-M-Y', $d); ?>
                                                            </td>
                                                            <td class="center remove"><img class="img-width"
                                                                    src="<?= base_url('assets/company/') . $companies->company_logo; ?>"
                                                                    alt="" height="90px"></td>
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
        </div>

                               <div class="modal fade" id="myModal" role="dialog" >
                                    <div class="modal-dialog modal-lg" style="max-width: 1250px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <div class="card-head">
                                                <div class="tools">
                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                    <a id="export_to_excel">Export to excel</a>
                                                </div>
                                            </div>
                                            <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body ui-front">
                                            <table class="table table-hover table-checkable order-column full-width agents-table"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Sr.No</th>
                                                            <th class="center">Agent Name</th>
                                                            <th class="center">Email</th>
                                                            <th class="center">Contact Number</th>
                                                            <th class="center">Address</th>
                                                            <th class="center">City</th>
                                                            <th class="center">State</th>
                                                            <th class="center">Country</th>
                                                            <th class="center">Designation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table body content -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
    <script>
        var url = new URL(window.location.href);
        $(document).ready(function () {
            $("#company").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {
                            response(data);
                            dt = data;
                            $(".err").html('');;
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#company').val(ui.item.label); // display the selected text
                    $('#company_id').val(ui.item.company_id); // save selected id to input
                    get_agents();
                }
            });
            
            if (url.searchParams.has('company_id')) {
                get_agents();                
            }
            
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
                    success: function (response) {
                        responseData = response.details; // Store the response data
                        console.log(responseData)
                        $("#agent").empty().parent().addClass("is-dirty");
                        $('#agent').append('<option value="">Select..</option>');
                        $.each(response.details, function (i, agent) {
                            $('#agent').append('<option value="' + agent.contact_person +
                                '">' + agent
                                    .contact_person + '</option>');
                        });
                    },
                    complete:function(){ 
                        $('#agent').val(url.searchParams.get('agent')); 
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching agents:", errorThrown);
                    }
                });
            }

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }

            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    if (terms.length > 2) {
                        $("#state").val("").attr('disabled', 'disabled');
                    } else {
                        $("#state").removeAttr('disabled');
                        $('#country_id').val(ui.item.country_id); 
                    }
                    return false;
                }
            });

            $("#state").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    if (terms.length > 2) {
                        $("#city").val("").attr('disabled', 'disabled');
                    } else {
                        $("#city").removeAttr('disabled');
                        $('#state_id').val(ui.item.state_id);
                    }
                    return false;

                    //$('#state').val(ui.item.label); // display the selected text
                    //$('#state_id').val(ui.item.state_id); // save selected id to input
                    //return false;
                }
            });

            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            state_id: $('#state_id').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    return false;

                    //$('#city').val(ui.item.label); // display the selected text
                    //$('#company_id').val(ui.item.company_id); // save selected id to input
                    //return false;
                }
            });

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
                const monthNames = [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
                    "Aug", "Sept", "Oct", "Nov", "Dec"
                ];
                const month = monthNames[date.getMonth()]; // Get the month name
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

        $('.view-agent-btn').on('click', function() {

            if ($.fn.DataTable.isDataTable('#example4')) {
                $('#example4').DataTable().clear().destroy();
            }

            var id = $(this).data('id');

            // Make a GET request using AJAX
            $.ajax({
                url: '<?php echo base_url()?>admin/report/get_company_agent_details',
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    var tableBody = $('.agents-table tbody');
                    tableBody.empty();
                    var companyName = '';

                    $.each(response.details, function(index, item) {

                        if (index === 0) {
                            companyName = item.name; // Get the name from the first item
                        }

                        // Construct the table row
                        var row = '<tr>' +
                            '<td class="center">' + (index + 1) + '</td>' + 
                            '<td class="center">' + item.contact_person + '</td>' +
                            '<td class="center">' + item.email + '</td>' + 
                            '<td class="center">' + item.contact_person_isd_code + '' +item.contact_person_number+'</td>' + 
                            '<td class="center">' + item.address + ((item.address_2!="")?', '+item.address_2:"")+ '</td>' + 
                            '<td class="center">' + item.city + '</td>' + 
                            '<td class="center">' + item.state +'</td>' + 
                            '<td class="center">' + item.country + '</td>' + 
                            '<td class="center">' + item.designation + '</td>' + 
                            '</tr>';

                        // Append the row to the table body
                        tableBody.append(row);
                    });

                    // Initialize DataTable with new data
                    $('#example4').DataTable({
                        "scrollX": true,
                        "scrollY": true,
                        "pageLength": 10
                    });

                    // Set up the export button click event
                    $('#export_to_excel').off('click').on('click', function() {
                        // Make another AJAX request to get all records for export
                        $.ajax({
                            url: '<?php echo base_url()?>admin/report/get_company_agent_details',
                            type: 'GET',
                            data: {
                                id: id ,
                                allRecords: true // This is to fetch all records
                            },
                            dataType: 'json',
                            success: function(fullResponse) {
                                var clonedTable = $('<table>');

                                // Construct the table header
                                var header = '<tr>' +
                                    '<th>Sr No.</th>' +
                                    '<th>Agent Name</th>' +
                                    '<th>Email</th>' +
                                    '<th>Contact Number</th>' +
                                    '<th>Address</th>' +
                                    '<th>City</th>' +
                                    '<th>State</th>' +
                                    '<th>Country</th>' +
                                    '<th>Designation</th>' +
                                    '</tr>';
                                clonedTable.append(header);

                                // Construct the table rows
                                $.each(fullResponse.details, function(index, item) {

                                    var row = '<tr>' +
                                    '<td class="center">' + (index + 1) + '</td>' + 
                                    '<td class="center">' + item.contact_person + '</td>' +
                                    '<td class="center">' + item.email + '</td>' + 
                                    '<td class="center">' + item.contact_person_isd_code +''+item.contact_person_number+'</td>' + 
                                    '<td class="center">' + item.address + ((item.address_2!="")?', '+item.address_2:"")+ '</td>' + 
                                    '<td class="center">' + item.city + '</td>' + 
                                    '<td class="center">' + item.state +'</td>' + 
                                    '<td class="center">' + item.country + '</td>' + 
                                    '<td class="center">' + item.designation + '</td>' + 
                                        '</tr>';

                                    clonedTable.append(row);
                                });

                                // Export the cloned table using table2excel plugin
                                clonedTable.table2excel({
                                    preserveColors: true,
                                    filename: companyName + "_Agent_Report.xls"
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching all records for export:', error);
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.close-modal').on('click', function() {
           // Destroy existing DataTable instance if it exists
           if ($.fn.DataTable.isDataTable('#example4')) {
                $('#example4').DataTable().clear().destroy();
            }
        });

        });
    </script>
</body>

</html>