<style>
    .img-width {
        max-width: 80px;
    }
</style>
<?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Currency</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li><li class="breadcrumb-item active">Currency</li>
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
                              
                                <div class="card-body">

                                    <div class="table-scrollable">
                                        <table
                                            class="table table-hover table-striped border table-checkable order-column full-width client-table"
                                            id="currency_list">
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
                                    <?php //echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                    <?php //echo $links; ?>
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
        $(document).ready(function () {
            $('#currency_list').DataTable({
                responsive: true
            });      
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
