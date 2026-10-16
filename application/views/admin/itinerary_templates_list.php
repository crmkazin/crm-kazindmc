<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 </head>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Itinerary Templates</h4>
                        </div>
                        <div class="col-lg-6 only-for-dashbord">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="">Itinerary Templates</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>	
                </div>		
                <div class="page-content">		
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
		
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Itinerary Templates</header>   
                                    <div class="tools">
                                    <a href="itinerary_template" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                                      Create New</a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                  </div>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                    <div class="row">                                        
                                        <div class="col-lg-12"><h4>Search</h4></div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','value'=>($this->input->get('name')<>'')?$this->input->get('name'):''])?>			 
                                            <label class = "mdl-textfield__label">Name</label>	 	 
                                        </div>
                                        </div>                                  
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input','value'=>($this->input->get('country')<>'')?$this->input->get('country'):''])?>			 
                                            <label class = "mdl-textfield__label">Country</label>	 	 
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary', 'value'=>'Search']);?>		 	 
                                            
                                            </div>
                                        </div>                                        
                                    </div>
                                    </form>
                                    <div class="table-scrollable">
                                    
                                    <table class="table table-hover table-checkable order-column full-width" id="example4s">
                                        <thead>
                                            <tr>
                                                <th class="center">S.No.</th>
                                                <th class="center">Name</th>                                     
                                                <th class="center">Country</th>
                                                <th class="center">Status</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php     
                                        $records_cnt=0;
                                        if(!empty($result)) {
                                           $i=$offset+1;
                                        foreach($result as $list) {
                                            $records_cnt++;
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                <td class="center"><?=$list->name?></td>
                                                <td class="center"><?=$list->country?></td>
                                                <td class="center"><?=ucfirst($list->status)?></td>
                                                <td class="center">
                                                    <a href="<?=base_url('edit_template?id='.base64_encode($list->id)) ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>    
                                                    <?php if($this->session->userdata('type') == 1){?>
                                                    <a href="<?=base_url().base64_encode($list->id)?>/delete-template" onclick="return confirm('Are you sure you want to delete this Template?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        <?php } }?>	
                                        </tbody>
                                    </table>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php //echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
                                    <?php echo $links; ?></div>
                            </div>                             
                        </div>                        
                    </div> 					
					
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->

    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->
<script>
    $(document).ready(function() {
        $("#location").on("change",function(){
            var v = $(this).find(':selected').attr('data-abbr');
            $("#booking_type").empty().parent().removeClass("is-dirty");
            if(v !== "" && v !== undefined){
                var opts = v.split(",");
                $("#booking_type").parent().addClass("is-dirty");
                $.each(opts, function(i, d) {
                   $('#booking_type').append('<option value="' + d +'">' + d + '</option>');
                });
                get_staff();
            }
        });
    });
    
    function get_staff(){
        if($("#location").val() === "") { $("#staff_id").empty(); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/enquiry/get_staff",
            data:{'location':$("#location").val()},
            dataType:"JSON",
            success: function(data){
                $("#staff_id").empty().parent().addClass("is-dirty");
                var opts = data.details;
                $.each(opts, function(i, d) {
                   $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] + '</option>');
                });
                
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
    
</script>
