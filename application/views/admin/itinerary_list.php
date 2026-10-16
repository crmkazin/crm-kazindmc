<?php include('admin_head_css.php');?> 
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="row page-titles">
                    <div class="col-md-7 col-7 align-self-center" style="display: flex;justify-content: space-between; margin-bottom: 5px;">
                        <h4 class="text-themecolor mt-2">Itinerary</h4>
                    </div>
                    
                    <div class="col-md-5 col-5 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                                <li class="breadcrumb-item active">Itinerary</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-body">
                                    <form method="get">
                                    <div class="row">                                        
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">From</label>	 	 
                                            <?php echo form_input(['type'=>'date','name'=>'date_from','placeholder'=>'','id'=>'date_from','class'=>'mdl-textfield__input','value'=>($this->input->get('date_from')<>'')?$this->input->get('date_from'):''])?>			 
                                        </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">To</label>	 	 
                                            <?php echo form_input(['type'=>'date','name'=>'date_to','id'=>'date_to','placeholder'=>'','class'=>'mdl-textfield__input','value'=>($this->input->get('date_to')<>'')?$this->input->get('date_to'):''])?>			 
                                        </div>
                                        </div>
                                                                                
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Query Number</label>	 	 
                                            <?php echo form_input(['name'=>'query_number','id'=>'query_number','class'=>'mdl-textfield__input','value'=>($this->input->get('query_number')<>'')?$this->input->get('query_number'):''])?>			 
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary mt-4', 'value'=>'Search']);?>		 	 
                                            </div>
                                        </div>                                        
                                    </div>
                                    </form>
                                    <div class="table-scrollable">
                                    
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">S.No.</th>
                                                <th class="center">Query <br>Number</th>                                     
                                                <th class="center">Guests</th>
                                                <th class="center">Arrival</th>
                                                <th class="center">Departure</th>
                                                <th class="center" width="45%">Itinerary Brief Content</th>
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
                                                <td class="center"><?=$list->enquiry_no?></td>
                                                <?php 
                                                    $adults  = (int) ($list->number_persons ?? 0);
                                                    $child   = (int) ($list->number_child ?? 0);
                                                    $group   = $list->group_type ?? '';
                                                ?>
                                                    
                                                <td class="center">
                                                    <?= ($adults + $child) ?> (<?= $adults ?>A+<?= $child ?>C) <?= $group ?>
                                                </td>
                                                <td class="center"><?=date('d M, Y',strtotime($list->check_in_date))?></td>
                                                <td class="center"><?=date('d M, Y',strtotime($list->check_out_date))?></td>
                                                <td class="center"><?= urldecode($list->content).' ...';?></td>
                                                <td class="center">
                                                    <a href="<?=base_url('edit_itinerary?id='.base64_encode($list->arrival_id)) ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>    
                                                    <?php if($this->session->userdata('type') == 1){?>
                                                    <a href="<?=base_url().base64_encode($list->arrival_id)?>/delete-itinerary" onclick="return confirm('Are you sure you want to delete this Enquiry?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o"></i></a>
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
                                    <?php //echo $links; ?></div>
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
