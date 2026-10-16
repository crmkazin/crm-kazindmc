<?php include('admin_head_css.php'); ?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .dataTables_paginate .page-item>.page-link {
        padding: 0 12px !important;
    }

    .form-control {
        border: 1px solid #ede5e5 !important;
    }

    .bg-previous_confirm {
        color: #fff;
        background-color: #2CA8FF;
    }
</style>
 <div class="page-wrapper">
        <div class="container-fluid">

            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">                               
                                
                                <div class="card-body">
                                    <div class="row mb-4 ">
                                        <div class="col-lg-12 text-center">
                                            <canvas id="previous-pie-chart"></canvas>
                                            <br>
                                            <strong>Previous Prospect</strong>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <canvas id="current-pie-chart"></canvas>
                                            <br>
                                            <strong>Current Prospect</strong>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <canvas id="future-pie-chart"></canvas>
                                            <br>
                                            <strong>Future Prospect</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php //echo '<pre>';print_r($staff_data);exit;  ?>
    </div>
        <?php if ($staff_data) {
            ?>
            <script>
                var previous_datasets = [];
                var current_datasets = [];
                var future_datasets = [];
            </script>
            <?php foreach ($staff_data as $staff) { 
                $key = array_search($staff->id, array_column($previous_prospect, 'id'));
                   $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                            'in-progress'=>'0','confirm'=>'0']; 
                    if($key!==false){
                        $result = explode(',',$previous_prospect[$key]->result);
                        foreach($result AS $list){
                            $res = explode('_',$list);
                            $number_cnt[$res[1]] = $res[0];

                        }
                    }
            ?>
            <script>
                previous_datasets.push({
                    label:"<?=$staff->name?>",
                    data:[<?=$number_cnt['cancel-at-arrival']?>,
                            <?=$number_cnt['not-materialized']?>,
                            <?=$number_cnt['pending']?>,
                            <?=$number_cnt['in-progress']?>,
                            <?=$number_cnt['confirm']?>],
                    backgroundColor: ['#e55957', '#f07101', '#000000','#663399','#008400']        
                    });
            </script>
            <?php $key = array_search($staff->id, array_column($current_prospect, 'id'));
                $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                        'in-progress'=>'0','confirm'=>'0']; 
                if($key!==false){
                    $result = explode(',',$current_prospect[$key]->result);
                    foreach($result AS $list){
                        $res = explode('_',$list);
                        $number_cnt[$res[1]] = $res[0];
                        //echo '<div class="col-md-6 mb-2"><span class="line-num text-white status-span '.$span_class[$res[1]].'" style="width:30px;height:30px;line-height:30px;">'.$res[0].'</span> '.ucwords($res[1]).'</div>';
                    }
                    //echo '<pre>';print_r($current_prospect[$key]);
                }
            ?>
            <script>
                current_datasets.push({
                    label:"<?=$staff->name?>",
                    data:[<?=$number_cnt['cancel-at-arrival']?>,
                            <?=$number_cnt['not-materialized']?>,
                            <?=$number_cnt['pending']?>,
                            <?=$number_cnt['in-progress']?>,
                            <?=$number_cnt['confirm']?>],
                    backgroundColor: ['#e55957', '#f07101', '#000000','#663399','#008400']        
                    });
            </script>
                <?php $key = array_search($staff->id, array_column($future_prospect, 'id'));
                        $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                                'in-progress'=>'0','confirm'=>'0'];
                        if($key!==false){
                            $result = explode(',',$future_prospect[$key]->result);
                            foreach($result AS $list){
                                $res = explode('_',$list);
                                $number_cnt[$res[1]] = $res[0];
                                //echo '<div class="col-md-6 mb-2"><span class="line-num text-white status-span '.$span_class[$res[1]].'" style="width:30px;height:30px;line-height:30px;">'.$res[0].'</span> '.ucwords($res[1]).'</div>';
                            }
                            //echo '<pre>';print_r($future_prospect[$key]);
                        }
                ?>
                <script>
                    future_datasets.push({
                        label:"<?=$staff->name?>",
                        data:[<?=$number_cnt['cancel-at-arrival']?>,
                                <?=$number_cnt['not-materialized']?>,
                                <?=$number_cnt['pending']?>,
                                <?=$number_cnt['in-progress']?>,
                                <?=$number_cnt['confirm']?>],
                        backgroundColor: ['#e55957', '#f07101', '#000000','#663399','#008400']        
                        });
                </script>                                                       
            <?php } ?>
        <?php }  ?>                   
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> -->
<script>
    Chart.register(ChartDataLabels);
    function previous_graph_pie(){
        const ctx = document.getElementById('previous-pie-chart').getContext('2d');
        const data = {
            labels: ["Cancel At Arrival", "Not Materialized", "Pending", "In-progress", "Confirm"],
            datasets: previous_datasets
        };
        const config = {
            type: 'pie',
            data: data,
                options: {
                    responsive:true,
                    plugins: {
                        datalabels: {
                            color: '#000', // Label color
                            font: {
                                weight: 'bold'
                            },
                            backgroundColor: 'rgba(255, 255, 255, 0.7)',
                            borderRadius: 4,
                            padding: 6,
                            textAlign: 'center',
                            anchor: 'center', // Places label on the pie ring
                            align: 'center',  // Keeps it centered on the slice
                            offset: 0, // No extra offset
                            //offset: -30,
                            formatter: (value, ctx) => {
                                return ctx.dataset.label+" : "+ctx.dataset.data;
                            }
                        },
                        tooltip: {
                            enabled: true,
                            position: 'nearest',
                            backgroundColor: 'rgba(0, 95, 179, 1)',  // Dark background
                            titleColor: '#ffffff',  // Title text color
                            bodyColor: '#ffeb3b',   // Body text color (yellow)
                            borderColor: '#ffffff', // White border
                            borderWidth: 2,         // Border thickness
                            cornerRadius: 8,        // Rounded corners
                            padding: 10,            // Spacing inside the tooltip
                        }
                    }
                }
        };
        new Chart(ctx, config);
    }
    
    function current_graph_pie(dt){
        const ctx = document.getElementById('current-pie-chart').getContext('2d');

        const data = {
            labels: ["Cancel At Arrival", "Not Materialized", "Pending", "In-progress", "Confirm"],
            datasets: current_datasets
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive:true,
                    plugins: {
                        datalabels: {
                            color: '#000', // Label color
                            font: {
                                weight: 'bold'
                            },
                            backgroundColor: 'rgba(255, 255, 255, 0.7)',
                            borderRadius: 4,
                            padding: 6,
                            textAlign: 'center',
                            anchor: 'center', // Places label on the pie ring
                            align: 'center',  // Keeps it centered on the slice
                            offset: 0, // No extra offset
                            //offset: -30,
                            formatter: (value, ctx) => {
                                return ctx.dataset.label+" : "+ctx.dataset.data;
                            }
                        },
                        tooltip: {
                            enabled: true,
                            position: 'nearest',
                            backgroundColor: 'rgba(0, 95, 179, 1)',  // Dark background
                            titleColor: '#ffffff',  // Title text color
                            bodyColor: '#ffeb3b',   // Body text color (yellow)
                            borderColor: '#ffffff', // White border
                            borderWidth: 2,         // Border thickness
                            cornerRadius: 8,        // Rounded corners
                            padding: 10,            // Spacing inside the tooltip
                        }
                    }
            }
        };

        new Chart(ctx, config);
    }
    function future_graph_pie(){
        const ctx = document.getElementById('future-pie-chart').getContext('2d');
        const data = {
            labels: ["Cancel At Arrival", "Not Materialized", "Pending", "In-progress", "Confirm"],
            datasets: future_datasets
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive:true,
                    plugins: {
                        datalabels: {
                            color: '#000', // Label color
                            font: {
                                weight: 'bold'
                            },
                            backgroundColor: 'rgba(255, 255, 255, 0.7)',
                            borderRadius: 4,
                            padding: 6,
                            textAlign: 'center',
                            anchor: 'center', // Places label on the pie ring
                            align: 'center',  // Keeps it centered on the slice
                            offset: 0, // No extra offset
                            //offset: -30,
                            formatter: (value, ctx) => {
                                return ctx.dataset.label+" : "+ctx.dataset.data;
                            }
                        },
                        tooltip: {
                            enabled: true,
                            position: 'nearest',
                            backgroundColor: 'rgba(0, 95, 179, 1)',  // Dark background
                            titleColor: '#ffffff',  // Title text color
                            bodyColor: '#ffeb3b',   // Body text color (yellow)
                            borderColor: '#ffffff', // White border
                            borderWidth: 2,         // Border thickness
                            cornerRadius: 8,        // Rounded corners
                            padding: 10,            // Spacing inside the tooltip
                            
                        }
                    }
            }
        };

        new Chart(ctx, config);
    }
    previous_graph_pie();
    current_graph_pie();
    future_graph_pie();
</script>