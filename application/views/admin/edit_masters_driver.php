<?php include ('admin_head_css.php'); ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Edit Guide driver</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Edit Guide driver</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <?php echo $this->session->flashdata('message');
            unset($_SESSION['message']); ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Edit Guide driver</header>
                            <div class="tools">
                                <a href="<?= site_url('add-guide-driver') ?>">List</a>
                            </div>
                        </div>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?= site_url('update-guide-driver') ?>">
                            <div class="card-body row">
                                <div class="col-lg-2 p-t-20">
                                    <input type="hidden" name="id" value="<?= $drivers->id ?>">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input type ="text" name= "driver_name" class="mdl-textfield__input" value="<?= htmlspecialchars($drivers->driver_name, ENT_QUOTES, 'UTF-8') ?>" required>
                                        <label class="mdl-textfield__label">Driver Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input type ="number" name= "driver_number" class="mdl-textfield__input" value="<?= htmlspecialchars($drivers->driver_phone_number, ENT_QUOTES, 'UTF-8') ?>" required>
                                    <label class="mdl-textfield__label">Driver Phone Numberme</label>
                                </div>
                                <div class="col-lg-12 p-t-20">
                                    <button type="submit" class="btn btn-success">Update Driver</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>