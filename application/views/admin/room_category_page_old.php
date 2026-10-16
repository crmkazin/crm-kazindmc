<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Category Data</title>
    <style>
        .info-box {
            display: flex;
            background: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            border-left: 4px solid #007bff;
        }
        .info-box-icon {
            padding: 0 15px 0 0;
            display: flex;
            align-items: center;
        }
        .info-box-icon > i {
            font-size: 30px;
            color: #007bff;
        }
        .info-box-content {
            flex: 1;
        }
        .info-box-text {
            display: block;
            font-size: 14px;
            color: #6c757d;
        }
        .info-box-number {
            display: block;
            font-size: 18px;
            font-weight: bold;
            color: #343a40;
        }
        .well {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef !important;
        }
        .category-header {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #6060a9;
            padding-bottom: 15px;
        }
        .category-image {
            flex-shrink: 0;
        }
        .category-title {
            flex: 1;
        }
        .label-success {
            background-color: #5cb85c;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
        }
        .label-danger {
            background-color: #d9534f;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .col-md-3, .col-md-4 {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .portlet-body {
            padding: 20px;
        }
        .img-thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 4px;
        }
    </style>
</head>
<body style="max-width:1200px; margin:50px auto;">
    <div class="portlet-body" style="border-left:2px solid grey; border-right:2px solid grey;">
        <!-- Category Header with Image and Name in Same Row -->
        <div class="category-header">
            <!-- Category Image -->
            <div class="category-image">
                <div class="thumbnail" style="border: none;">
                    <?php if (!empty($category->category_image)): ?>
                        <img src="<?= base_url('assets/admin/hotel_category/' . $category->category_image) ?>" 
                             alt="<?= $category->category_name ?>" 
                             class="img-responsive img-thumbnail"
                             style="max-height: 200px; max-width: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="text-center" style="height: 200px; width: 200px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                            <div>
                                <i class="fa fa-image fa-3x text-muted"></i>
                                <p class="text-muted mt-2" style="font-size: 12px;">No Image</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Category Name and Basic Info -->
            <div class="category-title">
                <h2 class="mt-0" style="color: #6060a9; margin-bottom: 10px;">
                    <?= ucwords(strtolower($category->category_name)) ?>
                </h2>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><strong>Hotel:</strong></label>
                            <p class="form-control-static" style="margin: 5px 0;"><?= !empty($category->hotel_name) ? $category->hotel_name : 'N/A' ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><strong>Room Size:</strong></label>
                            <p class="form-control-static" style="margin: 5px 0;"><?= !empty($category->room_size) ? $category->room_size : 'N/A' ?></p>
                        </div>
                    </div>
                    <!--<div class="col-md-4">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label"><strong>Hotel Location:</strong></label>-->
                    <!--        <p class="form-control-static" style="margin: 5px 0;"><?= !empty($category->location) ? $category->location : 'N/A' ?></p>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-blue">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Max Occupancy</span>
                                <span class="info-box-number"><?= $category->max_accomodation ?? 'N/A' ?> Persons</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-green">
                                <i class="fa fa-male"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Adults</span>
                                <span class="info-box-number"><?= $category->number_adults ?? 'N/A' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-orange">
                                <i class="fa fa-child"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Children</span>
                                <span class="info-box-number"><?= $category->number_childs ?? 'N/A' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Room Specifications -->
        
        
        <!-- Category Description -->
        <div class="form-group" style="margin-top: 20px;">
            <label class="control-label"><strong>Description:</strong></label>
            <div class="well" style="background: #f9f9f9; padding: 15px; border-radius: 5px; min-height: 100px;">
                <?php if (!empty($category->category_description)): ?>
                    <?= nl2br(htmlspecialchars($category->category_description)) ?>
                <?php else: ?>
                    <p class="text-muted text-center" style="padding: 30px 0;">
                        <i class="fa fa-info-circle"></i> No description                     </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>