<?php include ('admin_head_css.php'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-5 col-sm-8 col-8 align-self-center">
                            <h4 class="text-themecolor">Merge / Revoke(Rollback) Companies</h4>
                        </div>
                        <div class="col-lg-1 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-4 col-4 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Merge / Revoke(Rollback) Companies</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-box">
                            <!-- <div class="card-t -->
                            <div class="card-body">
                                <form method="post" autocomplete="off" id="frm-companies-merge" onsubmit="return confirm('Merge Companies. Are You Sure?')">
                                    <div class="card-body row">
                                            <div class="col-lg-12">
                                                <?php echo $this->session->flashdata('message');
                                                    unset($_SESSION['message']);
                                                        ?>
                                                </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Main Company</label>													
                                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input']) ?>
                                            </div>
                                            <?php echo form_error('main_company_id'); ?>
                                            <input type="hidden" name="main_company_id" id="main_company_id">
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Duplicate Company</label>
                                                <?php echo form_input(['name' => '', 'id' => 'company_merge', 'placeholder' => 'Click To Add Company Name', 'class' => 'mdl-textfield__input']) ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 p-t-20">
                                            <div class="panel panel-info">
                                                <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Duplicate Companies List</div>
                                                <div class="panel-body row" id="merge-companies">
                                                    
                                                </div>
                                            </div>
                                            <?php echo form_error('companies_merger[]'); ?>
                                        </div>
                                        
                                        <div class="col-lg-12 p-t-20">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:right;', 'value' => 'Merge']); ?>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="card card-box">
                            <!-- <div class="card-head">
                                <header>Revoke(Rollback) Merged Companies</header>
                            </div> -->
                            <div class="card-body">
                                <form method="post" autocomplete="off" id="frm-companies-revoke">
                                    <div class="card-body row">
                                        <div class="col-lg-12 msg"></div>
                                        <div class="col-lg-12 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Main Company</label>													
                                                <?php echo form_input(['name' => 'revoke_main_company', 'id' => 'revoke_main_company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input']) ?>
                                            </div>
                                            <?php echo form_error('revoke_main_company'); ?>
                                            <input type="hidden" name="revoke_main_company_id" id="revoke_main_company_id">
                                        </div>
                                        
                                        
                                        <div class="col-lg-12 p-t-20">
                                            <div class="panel panel-info">
                                                <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Merged Companies List</div>
                                                <div class="panel-body row" id="merged-companies-list">
                                                    
                                                </div>
                                            </div>												
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
    <!-- end page container -->

</div>

<script>
    $(document).ready(function() {
        $("#company").autocomplete({
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
                $('#company').val(ui.item.label); // display the selected text
                $('#main_company_id').val(ui.item.company_id); // save selected id to input
            },
            close: function(event, ui)  {
                $("#merge-companies").empty();
            }
        });
        
        $("#company_merge").autocomplete({
            source: function(request, response) {
                // Fetch data
                let myForm = document.getElementById("frm-companies-merge");
                var frm_data = new FormData(myForm);
                frm_data.set("search",request.term);
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_names_merge",
                    type: 'POST',
                    dataType: "json",
                    contentType: false,
                        processData: false,
                    data: frm_data,
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                var html = '<div class="col-md-12"><input type="checkbox" value="'+ui.item.company_id+'" checked="checked" name="companies_merger[]"> '+ui.item.label+' <i title="Remove" class="fa fa-remove" style="color:red;cursor:pointer;"></i></div>';
                $("#merge-companies").append(html);				
            },
            close: function(event, ui)  {
            // Close event fires when selection options closes
            $("#company_merge").val(""); // Clear the input field 
            }
        });
        
        $("#frm-companies-merge").on('click', '.fa-remove', function (e) {
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
        });
        
        
        $("#revoke_main_company").autocomplete({
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
                $('#revoke_main_company').val(ui.item.label); // display the selected text
                $('#revoke_main_company_id').val(ui.item.company_id); // save selected id to input
                get_merge_companies();
            }
        });
        
        $("#frm-companies-revoke").on("click",".revoke",function(){
            if(!confirm("Rollback Company. Are You Sure?")){
                return false;
            }
            event.preventDefault();
            var ele = $(this);
            var c_id = ele.attr("data-id");
            $.ajax({
                url: "<?= base_url() ?>admin/company/revoke_merged_company",
                type: 'POST',
                dataType: "json",
                //contentType: false,
                //processData: false,
                data: {'company_id':c_id,'revoke_main_company_id':$("#revoke_main_company_id").val()},
                success: function(data) {
                    $(".msg").html(data.msg);
                    if(data.response === "s"){
                        ele.parent().remove();
                    }
                }
            });
            
            
        });
        
    });
    
    function get_merge_companies(){
        let myForm = document.getElementById("frm-companies-revoke");
        var frm_data = new FormData(myForm);
        $.ajax({
            url: "<?= base_url() ?>admin/company/get_merged_companies",
            type: 'POST',
            dataType: "json",
            contentType: false,
            processData: false,
            data: frm_data,
            success: function(data) {
                $.each(data.merged_companies,function(i,d){
                    var html = '<div class="col-md-12" style="font-weight:500;"><i class="fa fa-check" aria-hidden="true"></i> '+d.name+' <button type="button" title="Revoke" class="btn btn-xs btn-primary revoke" data-id="'+d.company_id+'" style="float: right;padding: 4px;">Revoke</button></div>';
                    $("#merged-companies-list").append(html);
                });
            }
        });
    }
</script>
