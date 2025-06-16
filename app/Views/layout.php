<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'My Site') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($description ?? 'Default description for my site') ?>">
    <!-- Global CDN Assets -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <?= $this->renderSection('headScripts') ?>


    <!-- Page-Specific Styles -->
    <?= $this->renderSection('styles') ?>
</head>
<!-- Layout: app/Views/layouts/main.php -->

<body class="font-[Inter] <?= esc($bodyClass ?? 'bg-black text-white') ?>">

    <!-- ✅ Conditionally Show Header -->
    <?php if (!isset($hideHeader) || !$hideHeader): ?>
        <?= view('partials/header') ?>
    <?php endif; ?>


    <main class="min-h-screen ">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ✅ Conditionally Show Footer -->
    <?php if (!isset($hideFooter) || !$hideFooter): ?>
        <?= view('partials/footer') ?>
    <?php endif; ?>

    <!-- Page-Specific Scripts -->
    <script src="<?= base_url('assets/js/common.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>

    <script>

        CommonElements.initCommonNavigation();
    </script>
</body>

</html>