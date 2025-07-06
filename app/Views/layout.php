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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <?= $this->renderSection('headScripts') ?>


    <!-- Page-Specific Styles -->
    <?= $this->renderSection('styles') ?>
    <style>
        /* Global Scrollbar Styling (WebKit browsers) */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #1f2937;
            /* Tailwind: bg-gray-800 */
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            /* blue to purple */
            border-radius: 8px;
            border: 2px solid #1f2937;
            /* Creates padding effect */
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #7c3aed);
            /* darker on hover */
        }

        /* Firefox scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #8b5cf6 #1f2937;
            /* border-radius: 5px; */
            /* scrollbar-color: transparent transparent; */
        }

        .magnetic-btn {
            transition: all ease 1s;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #06b6d4);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 4s ease infinite;
            text-transform: capitalize;
        }

        /* footer css */

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .active-link::after {
            width: 100% !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .wave {
            animation: wave 2s linear infinite;
        }

        @keyframes wave {
            0% {
                transform: rotate(0deg);
            }

            10% {
                transform: rotate(14deg);
            }

            20% {
                transform: rotate(-8deg);
            }

            30% {
                transform: rotate(14deg);
            }

            40% {
                transform: rotate(-4deg);
            }

            50% {
                transform: rotate(10deg);
            }

            60% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        /* Water Flow Layer Styles */
        .water-flow {
            position: relative;
            overflow: hidden;
        }

        .water-flow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            clip-path: polygon(0 0, 100% 0, 100% 60%, 85% 80%, 70% 70%, 50% 85%, 30% 75%, 15% 90%, 0 75%);
            z-index: 1;
        }

        .water-flow::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(135deg, rgba(103, 126, 234, 0.7) 0%, rgba(118, 75, 162, 0.7) 100%);
            clip-path: polygon(0 0, 100% 0, 100% 40%, 80% 60%, 60% 50%, 40% 65%, 20% 55%, 0 70%);
            z-index: 2;
            animation: flow 4s ease-in-out infinite;
        }

        @keyframes flow {

            0%,
            100% {
                clip-path: polygon(0 0, 100% 0, 100% 40%, 80% 60%, 60% 50%, 40% 65%, 20% 55%, 0 70%);
            }

            50% {
                clip-path: polygon(0 0, 100% 0, 100% 50%, 75% 70%, 55% 60%, 35% 75%, 25% 65%, 0 80%);
            }
        }

        .water-layer-1 {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            clip-path: polygon(0 0, 100% 0, 100% 30%, 70% 50%, 50% 40%, 30% 55%, 0 45%);
            animation: wave-flow-1 6s ease-in-out infinite;
            z-index: 3;
        }

        .water-layer-2 {
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            height: 50px;
            background: rgba(255, 255, 255, 0.05);
            clip-path: polygon(0 0, 100% 0, 100% 25%, 75% 45%, 45% 35%, 25% 50%, 0 40%);
            animation: wave-flow-2 8s ease-in-out infinite reverse;
            z-index: 4;
        }

        @keyframes wave-flow-1 {

            0%,
            100% {
                clip-path: polygon(0 0, 100% 0, 100% 30%, 70% 50%, 50% 40%, 30% 55%, 0 45%);
            }

            50% {
                clip-path: polygon(0 0, 100% 0, 100% 40%, 65% 60%, 45% 50%, 25% 65%, 0 55%);
            }
        }

        @keyframes wave-flow-2 {

            0%,
            100% {
                clip-path: polygon(0 0, 100% 0, 100% 25%, 75% 45%, 45% 35%, 25% 50%, 0 40%);
            }

            50% {
                clip-path: polygon(0 0, 100% 0, 100% 35%, 70% 55%, 40% 45%, 20% 60%, 0 50%);
            }


        }

        .gradient-bg {
            background: radial-gradient(ellipse at center, rgba(99, 102, 241, 0.1) 0%, rgba(0, 0, 0, 1) 70%);
        }

        .animated-gradient {
            background-size: 200% 200%;
            animation: move-bg 4s ease infinite;
        }

        @keyframes move-bg {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .text-gradient-animated {
            background-size: 200% 200%;
            background-image: linear-gradient(270deg, #8b5cf6, #ec4899, #a855f7);
            animation: gradient-move 4s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes gradient-move {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .swiper-pagination-bullet-active {
            background-image: linear-gradient(45deg, rgb(108, 14, 104), rgb(142, 39, 206)) !important;
            opacity: 1 !important;

        }

        .swiper-pagination-bullet {
            background-color: rgba(74, 36, 150, 0.82);
            opacity: .8 !important;
            width: 15px !important;
            height: 15px !important;
        }

        .swiper-pagination {
            /* position: relative; */
            bottom: 0;
        }
    </style>
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


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url('assets/js/common.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>

    <script>
        CommonElements.initCommonNavigation();
        gsap.registerPlugin(ScrollToPlugin);
        document.addEventListener('DOMContentLoaded', function() {

            // Scroll on anchor click
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const target = document.querySelector(this.getAttribute('href'));

                    if (target) {
                        gsap.to(window, {
                            duration: 1.5,
                            scrollTo: {
                                y: target,
                                offsetY: 60
                            },
                            ease: 'power2.inOut'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>