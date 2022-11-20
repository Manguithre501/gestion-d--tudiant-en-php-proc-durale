<?php require_once './config/app.config.php';
isNotConnected();
?>

<!DOCTYPE html>
<html lang="fr" class="light-style <?= ($page === 'login') ? 'customizer-hide' :  'layout-menu-fixed' ?>" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= SITE_NAME ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="public/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./public/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./public/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./public/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./public/css/demo.css" />
    <link rel="stylesheet" href="./public/css/all.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./public/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <?php if ($page === 'login') : ?>
        <link rel="stylesheet" href="./public/vendor/css/pages/page-auth.css" />
    <?php endif ?>

    <?php if ($page === '404') : ?>
        <link rel="stylesheet" href="./public/vendor/css/pages/page-misc.css" />
    <?php endif ?>

    <!-- Helpers -->
    <script src="./public/vendor/js/helpers.js"></script>


    <script src="./public/js/config.js"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <?php if ($page != 'login' && $page != '404') { ?>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php require_once PARTIALS . 'sidebar.php'; ?>
                <div class="layout-page">
                    <?php require_once PARTIALS . 'header.php'; ?>
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <?php require_once PAGES . $page . '.php'; ?>
                        </div>
                        <?php require_once PARTIALS . 'footer.php'; ?>
                    </div>

                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    <?php  } else { ?>
        <?php require_once PAGES . $page . '.php'; ?>
    <?php  } ?>

    <!-- Core JS -->
    <script src="public/vendor/libs/jquery/jquery.js"></script>
    <script src="public/vendor/libs/popper/popper.js"></script>
    <script src="public/vendor/js/bootstrap.js"></script>
    <script src="public/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="public/vendor/js/menu.js"></script>

    <script src="public/js/main.js"></script>


</body>

</html>