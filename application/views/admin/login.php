<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>KazinDMC CRM</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="<?=base_url();?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?=base_url();?>assets/admin/plugins/iconic/css/material-design-iconic-font.min.css">
    <!-- bootstrap -->
	<link href="<?=base_url();?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/images/login-logo.png">
    <title>Log in</title>

    <link href="<?=base_url();?>assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/dist/css/style.min.css" rel="stylesheet">
</head>
<body class="skin-default card-no-border">
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?=base_url();?>assets/images/login.png);">
            <div class="login-box card">
                <div class="card-body">
				<form method="post" class="form-horizontal form-material login100-form" id="loginform" autocomplete="off" action="<?php echo base_url('login'); ?>">
				    <h3 style="text-align: center;font-weight: 400; font-size: 1.4rem;">CRM LOGIN</h3>
					<!-- Logo Section -->
					<h3 class="text-center m-b-20">
						<img src="<?php echo base_url(); ?>assets/images/login-logo.png" alt="">
					</h3>
					<!-- Flash Message -->
					<?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> 
					<!-- Email Field -->
					<div class="form-group">
						<div class="col-xs-12">
							<?php echo form_input([
								'name'        => 'email',
								'type'        => 'text',
								'class'       => 'form-control input100',
								'placeholder' => 'Email',
								'required'    => 'required',
								'value'       => set_value('email')
							]); ?>
							<p class="text-danger"><?php echo form_error('email'); ?></p>
						</div>
					</div>

					<!-- Password Field -->
					<div class="form-group">
						<div class="col-xs-12">
							<?php echo form_input([
								'name'        => 'password',
								'type'        => 'password',
								'class'       => 'form-control input100',
								'placeholder' => 'Password',
								'required'    => 'required',
								'value'       => set_value('password')
							]); ?>
							<p class="text-danger"><?php echo form_error('password'); ?></p>
						</div>
					</div>
					<!-- Submit Button -->
					<div class="form-group text-center">
						<div class="col-xs-12">
							<button class="btn w-100 btn-lg btn-info btn-rounded text-white login100-form-btn" type="submit" name="login" value="login">
								Log In
							</button>
						</div>
					</div>
				</form>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap tether Core JavaScript -->

	<script src="<?=base_url();?>assets/admin/plugins/jquery/jquery.min.js" ></script>
    <!-- bootstrap -->
    <script src="<?=base_url();?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });

        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    
</body>
</html>