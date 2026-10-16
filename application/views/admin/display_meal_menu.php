<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($buffet['Buffet']) ?> - Standard Menu</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8f6f2, #f1ede6);
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .menu-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.07);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .menu-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, #c8a35f, #e6c27a);
        }

        /* Logo */
        .logo-wrapper {
            /* margin-bottom: 20px; */
        }

        .logo-wrapper img {
            width: 100px;
            height: auto;
        }

        .menu-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            margin-bottom: 5px;
        }

        .menu-subtitle {
            font-size: 15px;
            color: #888;
            margin-bottom: 30px;
        }

        .divider {
            width: 70px;
            height: 3px;
            background: #c8a35f;
            margin: 0 auto 35px auto;
            border-radius: 2px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            border-left: 4px solid #c8a35f;
            padding-left: 12px;
            text-align: left;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px 40px;
            text-align: left;
        }

        .menu-item {
            background: #fafafa;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .menu-item:hover {
            background: #f3efe6;
            transform: translateY(-2px);
        }

        .entertainment {
            margin-top: 35px;
            padding: 20px;
            background: #fff8e8;
            border-radius: 10px;
            border: 1px solid #f0e0b5;
            text-align: left;
        }

        .entertainment h4 {
            margin: 0 0 8px 0;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 13px;
            color: #999;
        }

        /* Responsive */

        @media (max-width: 768px) {

            .menu-card {
                padding: 25px;
            }

            .menu-title {
                font-size: 24px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .logo-wrapper img {
                width: 90px;
            }
        }

        @media (max-width: 480px) {
            .container {
                margin: 20px auto;
                padding: 10px;
            }

            .menu-card {
                padding: 20px;
                border-radius: 12px;
            }

            .menu-title {
                font-size: 20px;
            }

            .menu-subtitle {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="menu-card">

        <!-- LOGO -->
        <div class="logo-wrapper">
            <img src="<?= base_url('uploads/logo/meal-logo.png') ?>" alt="Meal Menu Logo">
        </div>

        <!-- Buffet Name -->
        <div class="menu-title">
            <?= ucfirst($buffet['Buffet']) ?>
        </div>

        <div class="menu-subtitle">
            Standard <?= ucfirst($buffet['ctype']) ?> <?= ucfirst($buffet['Buffet']) ?>
        </div>

        <div class="divider"></div>

        <?php if (!empty($remarks)) : ?>
            <div class="section-title">Menu Highlights</div>

            <div class="menu-grid">
                <?php foreach ($remarks as $item) : ?>
                    <div class="menu-item">
                        <?= htmlspecialchars($item) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($belly_dance)) : ?>
            <div class="entertainment">
                <h4>Entertainment</h4>
                <?= htmlspecialchars($belly_dance['entertainment_name']) ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            Thank you for dining with us.
        </div>

    </div>
</div>

</body>
</html>