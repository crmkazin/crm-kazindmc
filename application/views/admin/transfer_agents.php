<?php include('admin_head_css.php');?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-4 col-sm-8 col-8 align-self-center">
                            <h4 class="text-themecolor">Transfer / Revoke(Rollback) Agents</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-4 col-4 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Transfer / Revoke(Rollback) Agents</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <!-- <div class="card-head">
                                <header>Transfer Agents</header>
                            </div> -->
                            <div class="card-body">
                                <form method="post" autocomplete="off" id="frm-agents-transfer" onsubmit="return confirm('Transfer Agents. Are You Sure?')">
                                    <div class="card-body row">
                                        <div class="col-lg-12 msg-1">
                                            <?php echo $this->session->flashdata('message');
                                                unset($_SESSION['message']);
                                                    ?>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Main Company</label>													
                                                <?php echo form_input(['name' => '', 'id' => 'main_company', 'placeholder' => 'Main Company', 'class' => 'mdl-textfield__input company_suggestions']) ?>
                                            </div>
                                            <?php echo form_error('main_company_id'); ?>
                                            <input type="hidden" name="main_company_id" id="main_company_id">
                                        </div>
                                            
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Transfer To Company</label>													
                                                <?php echo form_input(['name' => '', 'id' => 'transfer_company', 'placeholder' => 'Transfer To Company', 'class' => 'mdl-textfield__input company_suggestions']) ?>
                                            </div>
                                            <?php echo form_error('transfer_company_id'); ?>
                                            <input type="hidden" name="transfer_company_id" id="transfer_company_id">
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Select Agent</label>
                                                <?php echo form_input(['name' => '', 'id' => 'agent_transfer', 'placeholder' => 'Click To Add Agent Name', 'class' => 'mdl-textfield__input']) ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 p-t-20">
                                            <div class="panel panel-info">
                                                <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Transfer Agent List</div>
                                                <div class="panel-body row" id="transfer-agents">
                                                    
                                                </div>
                                            </div>
                                            <?php echo form_error('agents_transfer[]'); ?>
                                        </div>
                                        
                                        <div class="col-lg-12 p-t-20">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:right;', 'value' => 'Transfer']); ?>
                                        </div>
                                    </div>
                                </form>
                                
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
    $(document).ready(function() {
        $(".company_suggestions").autocomplete({            
            source: function(request, response) {
                // Fetch data                
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                var idx = $(this).index(".company_suggestions");
                var ele_id = $(".company_suggestions").eq(idx).attr("id");
                $('#'+ele_id).val(ui.item.label); // display the selected text
                $('#'+ele_id+'_id').val(ui.item.company_id); // save selected id to input
            },
            close: function(event, ui)  {
                $("#transfer-agents").empty();
            }
        });
        
        $("#agent_transfer").autocomplete({
            source: function(request, response) {
                // Fetch data
                if($('#main_company').val() == "" || $('#main_company_id').val() == ""){ return false; }
                let myForm = document.getElementById("frm-agents-transfer");
                var frm_data = new FormData(myForm);
                frm_data.set("search",request.term);
                $.ajax({
                    url: "<?= base_url() ?>admin/company/agent_names_transfer",
                    type: 'POST',
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    data: frm_data,
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');
                    }
                });
            },
            select: function(event, ui) {
                $(".msg-1").html("");
                if($("#main_company_id").val() == $("#transfer_company_id").val()){
                    $(".msg-1").html("<div class='alert alert-danger'>Not Allowed. Transferring to same company.</div>");                    
                    return false;
                } 
                var html = '<div class="col-md-12"><input type="checkbox" value="'+ui.item.company_id+'" checked="checked" name="agents_transfer[]"> '+ui.item.label+' <i title="Remove" class="fa fa-remove" style="color:red;cursor:pointer;"></i></div>';
                $("#transfer-agents").append(html);				
            },
            close: function(event, ui)  {
            // Close event fires when selection options closes
            $("#agent_transfer").val(""); // Clear the input field 
            }
        });
        
        $("#frm-agents-transfer").on('click', '.fa-remove', function (e) {
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
        });
        
    });
</script>