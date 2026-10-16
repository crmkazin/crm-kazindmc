<div class="page-wrapper">
  <div class="container-fluid">
    <div class="page-content-wrapper">
      <div class="page-bar">
        <div class="row page-titles">
          <div class="col-lg-3 col-sm-6  col-6 align-self-center">
            <h4 class="text-themecolor">Change Password</h4>
          </div>
          <div class="col-lg-4 only-for-dashbord"></div>
          <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
              <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item">
                  <a href="
                    <?php echo base_url('dashboard'); ?>">Home </a>
                </li>
                <li class="breadcrumb-item active">Change Password</li>
              </ol>
            </div>
          </div>
        </div>
      </div> 
      <div class="page-content">
        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> <div class="row">
          <div class="col-sm-12">
            <div class="card-box">
              <form method="post">
                <div class="card-body row" style="background-color: #f6f6f6;">
                  <div class="col-lg-4 p-t-20">
                    <label class="">Current Password</label>
                    <div class="input-container">
                      <div class="mySelect">
                          <?php echo form_input(['name'=>'current_password','id'=>'current_password','class'=>'input','required'=>'required','value'=>set_value('current_password')])?> 
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                      <label class="">New Password</label> 
                      <div class="input-container">
                        <div class="mySelect">
                           <?php echo form_input(['name'=>'new_password','id'=>'new_password','class'=>'input','required'=>'required','value'=>set_value('new_password')])?> 
                           <?php echo form_error('new_password'); ?>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                     <label class="">Confirm Password</label> 
                     <div class="input-container">
                        <div class="mySelect">
                           <?php echo form_input(['name'=>'confirm_password','id'=>'confirm_password','class'=>'input','type'=>'password','required'=>'required','value'=>set_value('confirm_password')])?> 
                           <?php echo form_error('confirm_password'); ?>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-12 p-t-20 text-center"> <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-info', 'value'=>'Submit']);?> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $("#type").on("change",function(){
            $("#rights").css("display","none");
            if($(this).val()==="2"){
                $("#rights").css("display","block");
            }
        });
    });
</script>