<?php include ('admin_head_css.php'); ?>
<style>
    .dataTables_scrollHeadInner {
        width: 100% !important;
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Meal Master List</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Meal Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="<?php echo base_url('add-meal-price'); ?>" class="btn btn-primary mb-2">
                                        Add Meal Price
                                    </a>
                                </div>
                            </div>
                            <!--<div class="card-body">-->
                                <div class="table-scrollable">
                                    <table class="table table-hover table-striped border table-checkable order-column full-width"
                                        id="meal_master">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Country Name</th>
                                                <th class="center">Meal Type</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($meals as $list): ?>
                                                <tr>
                                                    <td class="center"><?= $i++ ?></td>

                                                    <td class="center">
                                                        <?= $list['country_name'] ?>
                                                    </td>

                                                    <td class="center">
                                                        <?= ucfirst($list['ctype']) ?>
                                                    </td>

                                                    <td class="center">
                                                        <a href="<?= base_url('meal-master-edit/'.$list['id'].'/'.$list['ctype']) ?>"
                                                        class="btn btn-sm btn-primary">
                                                        Edit
                                                        </a>

                                                        <a href="<?= base_url('meal-master-delete/'.$list['id'].'/'.$list['ctype']) ?>"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var table = $('#meal_master').DataTable({
            responsive: true,
        });
    });
</script>