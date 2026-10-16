<?php include('admin_head_css.php');?> 
<div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">City Master List</h4>
                    </div>

                    <div class="col-lg-6 only-for-dashbord">
                    </div>

                    <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="">City Master List</a></li>
                            </ol>
                        </div>
                    </div>
                </div>	
            </div>		
            <div class="page-content">		
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>City Master List</header>   
                                <div class="tools">
                                    <a href="city-master" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                                    Create New</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                                <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4s">
                                        <thead>
                                            <tr>
                                                <th class="center">S.No.</th>
                                                <th class="center">Country</th>
                                                <th class="center">Region</th>
                                                <th class="center">City</th>                                     
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 0;
                                            foreach($regions as $list) {
                                                $index++;
                                                $region = $this->db->select('*')->from('states')->where('status !=', 'no')->where('is_deleted !=', 'yes')->where('id',$list['state_id'])->order_by('id', 'DESC')->get()->row_array();
                                                $country = $this->db->select('*')->from('countries')->where('id',$region['country_id'])->order_by('id', 'DESC')->get()->row_array();
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$index?></td>
                                                    <td class="center"><?= !empty($country) ? $country['name'] : '-' ?></td>
                                                    <td class="center"><?= !empty($region) ? $region['name'] : '-' ?></td>
                                                    <td class="center"><?=$list['name']?></td>
                                                    <td class="center">
                                                        <a href="edit-city-master/<?=$list['id']?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="delete-city-master/<?=$list['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this city?');"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php }?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12 dataTables_paginate paging_simple_numbers" id=""> 
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
