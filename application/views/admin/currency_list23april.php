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
                                <div class="page-title">Currency</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Currency
                                </li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Currency</header>
                                    <!-- <div class="tools"
                                        style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'block'; ?>"> -->
                                    <div class="tools" style="">
                                        <a href="<?= base_url(); ?>add_currency" class="btn btn-success"
                                            style="padding:6px;" title="Add Currency Value">
                                            <i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-scrollable">
                                        <table
                                            class="table table-hover table-checkable order-column full-width client-table"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Currency Name</th>
                                                    <th class="center">Currency Value</th>
                                                    <th class="center">Added By</th>
                                                    <th class="center">Added On</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = $offset + 1;
                                                    foreach ($result as $list) {
                                                        $records_cnt++;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= ucwords($list->country); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= ucfirst($list->currency_name) . ' (' . $list->currency_abbr . ')' ?>
                                                            </td>
                                                            <td class="center"> <?= $list->country_currency_value ?></td>
                                                            <td class="center"><?= $list->name; ?></td>
                                                            <td class="center"><?php $d = strtotime($list->created);
                                                            echo date('d-M-Y', $d); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="<?= base_url('add_currency') . '?name=' . strtolower($list->country) . '&value=' . $list->country_currency_value ?>"
                                                                    id="editCurrency"
                                                                    data-id="<?= $list->country_currency_value ?>"
                                                                    class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                        class="fa fa-edit"></i></a>
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
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching agents:", errorThrown);
                    }
                });
            }

            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input

                    return false;
                }
            });

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }
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
        });

        document.getElementById('totalRowsCell').addEventListener('click', function () {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
        });

        // Close the modal when the close button is clicked
        document.getElementById('closeModal').addEventListener('click', function () {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        });
    </script>

</body>

</html>