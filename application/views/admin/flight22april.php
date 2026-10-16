<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php');?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php');?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add New Airline</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i clflight_modelass="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add New Airline</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add New Airline</header>
                                    <div class="tools">
                                        <a href="all-flight" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i> List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>


                                <?php echo form_open(); ?>
                                <div class="card-body row">
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'airline_name', 'id' => 'airline_name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'placeholder'=> '', 'value' => set_value('airline_name')]); ?>
                                            <label class="mdl-textfield__label">Airline Name</label>
                                            <?php echo form_error('airline_name'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'code', 'id' => 'code', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => set_value('code')]); ?>
                                            <label class="mdl-textfield__label">Code</label>
                                            <?php echo form_error('code'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php');?>
    <!-- end js include path -->

</body>

</html>