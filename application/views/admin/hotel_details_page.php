<?php $firstOutside = explode(',', $hotel->outside)[0] ?? ''; ?>
<?php $firstSpa = explode(',', $hotel->spa)[0] ?? ''; ?>
<?php $firstPool = explode(',', $hotel->pool)[0] ?? ''; ?>
<?php $firstReception = explode(',', $hotel->reception)[0] ?? ''; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .room-title {
            color: #b2742c;
            font-size: 32px;
            font-weight: 600;
        }

        .title {
            font-weight: 600;
            color: #b2742c;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .mobile {
            display: none;
        }

        .modal-content img {
            border-radius: 14px;
        }

        @media screen and (max-width:991px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }
        }

        @media(max-width:768px) {
            .room-title {
                font-size: 24px;
                text-align: center;
            }
        }

        @media screen and (max-width:576px) {
            .map-box {

                padding: 8px;
                border-radius: 0px;
            }

            .map-box iframe {
                height: 155px;
            }

            .main-card {
                padding: 14px;
                border-radius: 5px;
            }

            .gallery-box {
                padding: 15px;
            }
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 15px;
            color: #b2742c;
        }

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
            padding: 20px 40px;
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
        .room-img{
          width: 680px;
          height: 510px;
          object-fit: cover;

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

        .description {
            margin-bottom: 35px;
            padding: 25px;
            border-radius: 16px;
            background: #f8f8f8;
            border: 1px solid #eee;
        }

        .description h5 {
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
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .transport-image {
            position: relative;
        }

        .transport-image img {
            width: 100%;
            object-fit: cover;
        }

        /* ===== Desktop Layout ===== */

        /* 1 Image */
        .gallery:has(.transport-image:nth-child(1):last-child) .transport-image {
            width: 100%;
        }

        .gallery-box>img {
            width: 350px;
            height: 255px;
            object-fit: cover;
        }

        /* 2 Images */
        .gallery:has(.transport-image:nth-child(2):last-child) .transport-image {
            width: calc(50% - 6px);
        }

        /* 3 Images */
        .gallery:has(.transport-image:nth-child(3):last-child) .transport-image {
            width: calc(33.33% - 8px);
        }

        .padding {
            padding: 35px 15px;
        }

        /* 4 Images */
        .gallery:has(.transport-image:nth-child(4):last-child) .transport-image {
            width: calc(25% - 9px);
        }


        /* ===== Tablet ===== */

        @media (max-width:991px) {

            .gallery .transport-image {
                width: calc(50% - 6px) !important;
            }

        }


        /* ===== Mobile ===== */

        @media (max-width:576px) {

            .gallery .transport-image {
                width: 100% !important;
            }

        }
    </style>
</head>

<body>

    <!-- Hero Title -->
    <section class="hero">
        <h1>Hotel Details</h1>
    </section>

    <div class="container">
        <div class="transport-card">

            <!-- Transport Image -->


            <div class="row">

                <div class="col-lg-7">
                    <h2 class="room-title mb-3 mobile"><?= ucwords(strtolower($hotel->name)) ?? ''; ?>
                      <?php 
                          if (isset($hotel->booting_resort) && $hotel->booting_resort == 'yes') {
                              echo '(Boutique Resort)';
                          } else {
                              if (!empty($hotel->category)) {
                                  $stars = (int) filter_var($hotel->category, FILTER_SANITIZE_NUMBER_INT);
                                  if ($stars > 0 && $stars <= 5) {
                                      echo '(';
                                      for ($i = 1; $i <= $stars; $i++) {
                                          echo '<span style="color: #ecc900; font-size:20px;">★</span>';
                                      }
                                      echo ')';
                                  } else {
                                      echo htmlspecialchars($hotel->category);
                                  }
                              } else {
                                  echo 'N/A';
                              }
                          }
                      ?>
                    </h2>
                     <?php if (!empty($hotel->image)): ?>
                        <img src="<?= base_url('uploads/hotels/' . $hotel->image) ?>" 
                                alt="<?= $hotel->name ?>" 
                                class="img-fluid room-img">
                    <?php else: ?>
                       
                      <img src="<?= base_url('uploads/hotels/no-image.jpeg') ?>" 
                        alt="No Image" 
                        class="img-fluid room-img">
                    <?php endif; ?>
                </div>

                <div class="col-lg-5 padding">

                    <h2 class="room-title mb-4 desktop"><?= ucwords(strtolower($hotel->name)) ?? '';?>
                      <?php 
                          if (isset($hotel->booting_resort) && $hotel->booting_resort == 'yes') {
                              echo '(Boutique Resort)';
                          } else {
                              if (!empty($hotel->category)) {
                                  $stars = (int) filter_var($hotel->category, FILTER_SANITIZE_NUMBER_INT);
                                  if ($stars > 0 && $stars <= 5) {
                                      echo '(';
                                      for ($i = 1; $i <= $stars; $i++) {
                                          echo '<span style="color: #ecc900; font-size:20px;">★</span>';
                                      }
                                      echo ')';
                                  } else {
                                      echo htmlspecialchars($hotel->category);
                                  }
                              } else {
                                  echo 'N/A';
                              }
                          }
                      ?>
                    </h2>

                    <div class="title">Address: </div>
                    <p><?= !empty($hotel->address_1) ? $hotel->address_1 : '' ?> <?= !empty($hotel->address_2) ? $hotel->address_2 : '' ?> , (<?= !empty($hotel->country) ? $hotel->country : '' ?> , <?= !empty($hotel->state) ? $hotel->state : '' ?>)</p>

                    <div class="title">Location Map</div>

                    <a href="<?= !empty($hotel->map) ? $hotel->map : '#' ?>" target="_blank">
                      View on Google Maps
                    </a>

                </div>
            </div>

            <!-- Content -->

            <div class="transport-content">
                <div class="description">
                    <h5>Hotel Description</h5>
                    <p>
                        <?= !empty($hotel->description) ? nl2br(htmlspecialchars($hotel->description)) : 'No description available.' ?>
                    </p>
                </div>

                <div class="info-grid">

                    <div class="info-item">
                        <div class="gallery-box">
                            <div class="section-title">Lobby</div>
                              <img src="<?= !empty($firstOutside) ? base_url('uploads/hotels/building/' . $firstOutside) : base_url('uploads/hotels/no-image.jpg') ?>" class="preview-img">
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="gallery-box">
                            <div class="section-title">Reception</div>
                              <img src="<?= !empty($firstReception) ? base_url('uploads/hotels/reception/' . $firstReception) : base_url('uploads/hotels/no-image.jpg') ?>" class="preview-img">
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="gallery-box">
                            <div class="section-title">Pool</div>
                              <img src="<?= !empty($firstPool) ? base_url('uploads/hotels/pool/' . $firstPool) : base_url('uploads/hotels/no-image.jpg') ?>" class="preview-img">
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="gallery-box large">
                            <div class="section-title">Spa</div>
                              <img src="<?= !empty($firstSpa) ? base_url('uploads/hotels/spa/' . $firstSpa) : base_url('uploads/hotels/no-image.jpg') ?>" class="preview-img">
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </div>

</body>

</html>