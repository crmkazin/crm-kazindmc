<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
    
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php include('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Comparisons Charts</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Comparisons Charts</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Comparisons Charts</header>                                    
                                </div>
                                <div class="card-body">
                                    <form method="" id="frm-graph">
                                        <div class="card-body row">
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="tenure" id="tenure" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select Years..</option>
                                                        <?php
                                                        for ($i=2023;$i<date('Y');$i++) { ?>
                                                            <option value="<?php echo $i.'-'.date('Y',strtotime('+1 year',strtotime($i.'-01-01'))); ?>">
																<?php echo $i.'-'.date('Y',strtotime('+1 year',strtotime($i.'-01-01'))); ?>
															</option>
                                                        <?php } ?>
                                                    </select>			
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="graph_type" id="graph_type" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">Select..</option>
                                                        <option value="query">Queries Received</option>
                                                        <option value="revenue">Revenue</option>
                                                        <option value="agents">Number Of Agents</option>
                                                    </select>			
                                                </div>
                                            </div>
                                            <div class="col-lg-1 p-t-20 text-center">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="radio" class="mdl-textfield__input" name="charts_type" value="pie" checked> <label>Pie Chart</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 p-t-20 text-center">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="radio" class="mdl-textfield__input" name="charts_type" value="line"> <label>Line Chart</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-3 p-t-20 text-center">
                                                <button type="button" id="btn-compare" class="btn btn-md btn-primary mt-4">Compare</button>
                                            </div>
                                        </div>
                                    </form>
                                   
                                    <div class="row mb-4 ">
                                        <div class="col-lg-12 p-2">
                                            <canvas id="line-chart"></canvas>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var type = '';
            $("#btn-compare").on("click",function(){
            let myForm = document.getElementById("frm-graph");
                var data = new FormData(myForm);
		type = data.get('graph_type');
                $.ajax({
                    url: "<?= base_url(); ?>admin/comparisons/get_data",
                    type: "post",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if($("input[name='charts_type']:checked").val()==="line"){
                            plot_graph(data);
                        }else if($("input[name='charts_type']:checked").val()==="pie"){
                            plot_graph_pie(data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
			});
			//plot_graph();
			let lineChart = null;
                        let pieChart = null;
			function plot_graph(data){
                            if (lineChart) {
                                lineChart.destroy();
                            }
                            if (pieChart) {
                                pieChart.destroy();
                            }
                            var d1=[];
                            var d2=[];	
                            $.each(data.details.data1, function(i, d) {
                                d1.push(d);
                                d2.push(data.details.data2[i]);
                            });
                            var ctx = $("#line-chart");
                            lineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                    datasets: [
                                    {
                                        label: data.details.label1,
                                        backgroundColor: "white",
                                        borderWidth: 1,
                                        borderColor: "#900",
                                        fill: false,
                                        data: d1 /*[0,0,900,600,140,120,1600,130,900,700,600,1000]*/
                                    },
                                    {
                                        label: data.details.label2,
                                        backgroundColor: "white",
                                        borderWidth: 1,
                                        borderColor: "#090",
                                        fill: false,
                                        data: d2 /*[100,875,650,500,1245,800,1675,1750,600,700,600,1000]*/
                                     }
                                ]
                                    },
                            options: {
                                    responsive: true,
                                    plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Comparison Line Chart'
                                            }
                                    },
                                    scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Months'
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: type.charAt(0).toUpperCase()+type.slice(1).toLowerCase() 
                                                }
                                            }
                                    }
                            }
                            });
			}
                        
                        function plot_graph_pie(dt){
                            if (lineChart) {
                                lineChart.destroy();
                            }
                            if (pieChart) {
                                pieChart.destroy();
                            }
                            var d1=[];
                            var d2=[];	
                            $.each(dt.details.data1, function(i, d) {
                                d1.push(d);
                                d2.push(dt.details.data2[i]);
                            });
                            const ctx = document.getElementById('line-chart').getContext('2d');

                            const data = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [
                                    {
                                        label: dt.details.label1,
                                        data: d1,
                                        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56','#FFA500','#808000','#00FF00','#E2F516','#00FFFF','#008080','#FF00FF','#EDC9AF','#FFC0CB']
                                    },
                                    {
                                        label: dt.details.label2,
                                        data: d2,
                                        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56','#FFA500','#808000','#00FF00','#E2F516','#00FFFF','#008080','#FF00FF','#EDC9AF','#FFC0CB']
                                    }
                                ]
                            };

                            const config = {
                                type: 'pie',
                                data: data,
                                options: {
                                    responsive: true
                                }
                            };

                        pieChart = new Chart(ctx, config);
                    }
		});
    </script>

</body>

</html>