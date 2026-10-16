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
    <!-- style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/css/pages/extra_pages.css"> 
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/images/favicon.ico" sizes="32x32" />
</head>
<body>
    <div class="limiter">
        <div class="container-login100 page-background" style="background-image:url(<?=base_url();?>assets/images/login.png); z-index:auto!important;">
            <div class="wrap-login100">

                <form method="post" id="frm_verify" action="<?php echo base_url('verify_otp/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>" class="login100-form">
                    <span class="login100-form-logo">
                        <img src="<?php echo base_url(); ?>assets/images/login-logo.png">
                    </span>					
                    <span class="login100-form-title p-b-34 p-t-27"> OTP <p style="color:#FFF;">Sent On Login Email ID</p></span>
                    
                    <div id="msg"></div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="wrap-input100 ">
                    <?php echo form_input(['name'=>'otp_code', 'class'=>'input100','placeholder'=>'Enter OTP Code','required'=>'required', 'value'=>''])?>	
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    <?php echo form_error('otp_code');?><br>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="login" value="submit">
                                Submit
                        </button>
                    </div>
                    <input type="hidden" name="otp_id" value="<?php echo $this->uri->segment(2); ?>"/>
                    <input type="hidden" name="admin_id" value="<?php echo $this->uri->segment(3); ?>"/>
                    <div style="text-align: center;"><button type="button" id="resend" class="btn btn-xs btn-link" style="color:#FFF;">Resend OTP</button></div>
                </form>
            </div>
        </div>
    </div>
    <!-- start js include path -->
    <script src="<?=base_url();?>assets/admin/plugins/jquery/jquery.min.js" ></script>
    <!-- bootstrap -->
    <script src="<?=base_url();?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <!-- <script src="<?=base_url();?>assets/admin/assets/js/pages/extra_pages/login.js" ></script> -->
    <!-- end js include path -->
    <script>
        $(document).ready(function(){
            $("#resend").on("click",function(e){
              e.preventDefault();
              let myForm = document.getElementById("frm_verify");
              var data = new FormData(myForm);
              var e = $("#resend");
              e.html('Resending..').attr('disabled','disabled');
            $.ajax({
                url: "<?php echo site_url('otp_resend'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.response === 's'){
                        //$("#msgDiv").fadeIn().html('').html('');
                        e.html('Resend OTP').removeAttr('disabled','disabled');
                        $("#msg").html('<div class="alert alert-success">OTP Resend Successfully!</div>');
                    }
                 }
            });
        });

        });
    </script>
    
</body>
</html>