<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            margin: 0;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #b2742c, #e6b980);
            padding: 60px 0 120px;
            text-align: center;
            color: #fff;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            margin: 0;
        }

        /* Main Card */
        .transport-card {
            margin-top: -90px;
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Image Section */
        .transport-image {
            position: relative;
        }

        .transport-image img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .image-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #fff;
            color: #b2742c;
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Content Section */
        .transport-content {
            padding: 45px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .info-item {
            background: #f9fafc;
            padding: 20px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: 0.3s;
        }

        .info-item:hover {
            transform: translateY(-5px);
            background: #eef3f9;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #b2742c, #e6b980);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .label {
            font-size: 13px;
            color: #777;
        }

        .value {
            font-weight: 600;
            font-size: 15px;
            color: #222;
        }

        .remarks {
            margin-top: 35px;
            padding: 25px;
            border-radius: 16px;
            background: #f8f8f8;
            border: 1px solid #eee;
        }

        .remarks h5 {
            font-weight: 600;
            margin-bottom: 12px;
        }

        /* Responsive */
        @media(max-width:768px) {
            .hero h1 {
                font-size: 26px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .transport-content {
                padding: 25px;
            }

            .transport-image img {
                height: 250px;
            }
        }
    </style>
<style>

.gallery{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
}

.transport-image{
    position:relative;
}

.transport-image img{
    width:100%;
    object-fit:cover;
}

/* ===== Desktop Layout ===== */

/* 1 Image */
.gallery:has(.transport-image:nth-child(1):last-child) .transport-image{
    width:100%;
}

/* 2 Images */
.gallery:has(.transport-image:nth-child(2):last-child) .transport-image{
    width:calc(50% - 6px);
}

/* 3 Images */
.gallery:has(.transport-image:nth-child(3):last-child) .transport-image{
    width:calc(33.33% - 8px);
}

/* 4 Images */
.gallery:has(.transport-image:nth-child(4):last-child) .transport-image{
    width:calc(25% - 9px);
}


/* ===== Tablet ===== */

@media (max-width:991px){

.gallery .transport-image{
    width:calc(50% - 6px) !important;
}

}


/* ===== Mobile ===== */

@media (max-width:576px){

.gallery .transport-image{
    width:100% !important;
}

}

</style>
</head>

<body>

    <!-- Hero Title -->
    <section class="hero">
        <h1>Transport Details</h1>
    </section>

    <div class="container">
        <div class="transport-card">

            <?php 
                $total_images = count($images);
                // $col_class = '';
                // switch($total_images) {
                //     case 1: $col_class = 'col-12'; break;
                //     case 2: $col_class = 'col-6'; break;
                //     case 3: $col_class = 'col-4'; break;
                //     default: $col_class = 'col-3'; break; // 4 or more
                // }
            ?>
            
            <div class="gallery">
                <?php foreach ($images as $image): ?>
                        <div class="transport-image">
                            <img src="<?= base_url('uploads/transportation/'.$image) ?>" alt="<?= $transport->vehicle_name ?>" class="img-fluid">
                            <div class="image-badge">Transport image</div>
                        </div>
                <?php endforeach; ?>
            </div>

            <!-- Content -->
            <div class="transport-content">

                <div class="info-grid">

                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-flag"></i></div>
                        <div>
                            <div class="label">Country</div>
                            <div class="value"><?= $transport->country ?? ''; ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-map"></i></div>
                        <div>
                            <div class="label">State</div>
                            <div class="value"><?= $transport->state ?? ''; ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-city"></i></div>
                        <div>
                            <div class="label">City</div>
                            <div class="value"><?= $transport->city ?? '';?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-bus"></i></div>
                        <div>
                            <div class="label">Type</div>
                            <div class="value"><?= $transport->vehicle_name ?? ''; ?></div>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-calculator"></i></div>
                        <div>
                            <div class="label">Seating Capacity</div>
                            <div class="value"><?= $transport->capacity ?? ''; ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-box"><i class="fas fa-luggage-cart"></i></div>
                        <div>
                            <div class="label">Luggage Capacity</div>
                            <div class="value"><?= $transport->luggage ?? ''; ?></div>
                        </div>
                    </div>

                </div>

                <div class="remarks">
                    <h5>Remarks</h5>
                    <p>
                        <?= $transport->remarks ?? ''; ?>
                    </p>
                </div>

            </div>

        </div>
    </div>

</body>

</html>