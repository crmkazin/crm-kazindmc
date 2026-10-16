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
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Party Buses</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Buses</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Party Bus</header>
                                    <div class="tools">
                                        <a href="<?= base_url(); ?>add-party-bus" class="btn btn-success"
                                            style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                    <div class="tools">
                                        <!-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> -->
                                        <a id="export_to_excel" class="btn btn-success">Export to excel</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
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
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                // $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                                if (!empty($buses)) {
                                                    foreach ($buses as $bus) {

                                                        ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center"><?= date('d-M-Y',strtotime($bus->date_of_booking)) ?></td>
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
                                                        </td>
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
                                                                    class="fa fa-trash-o "></i></a>
                                                        </td>
                                                    </tr>
                                                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>

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

    <script>
    $('#export_to_excel').click(function() {
        // Clone the table to avoid modifying the original table
        var clonedTable = $("#example4").clone();

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

</body>

</html>