<?php

use App\Helpers\Utils;

require_once APPPATH . 'Helpers/Utils.php';

?>


<?= $this->extend('layout') ?>
<?= $this->section('headScripts') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* Fix horizontal scroll issues and ensure full screen coverage */
    html,
    body {
        max-width: 100vw;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    /* Main container using flexbox */
    body {
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        width: 100%;
    }

    /* Ensure all sections use full width */
    section {
        width: 100%;
        flex-shrink: 0;
    }

    .work-card {
        backdrop-filter: blur(20px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.03) 100%);
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border-radius: 16px;
        overflow: hidden;
    }

    .work-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 32px 64px rgba(0, 0, 0, 0.4), 0 0 40px rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
    }

    .work-card .card-image {
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .work-card:hover .card-image img {
        transform: scale(1.1);
    }

    .work-card .card-overlay {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
        transition: all 0.4s ease;
    }

    .work-card:hover .card-overlay {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(147, 51, 234, 0.6) 100%);
    }

    .category-tag {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(147, 51, 234, 0.2) 100%);
        border: 1px solid rgba(59, 130, 246, 0.3);
        backdrop-filter: blur(10px);
    }

    .floating {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }

    .category-btn {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backdrop-filter: blur(10px);
    }

    .category-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(147, 51, 234, 0.2) 100%) !important;
        backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 50% !important;
        width: 56px !important;
        height: 56px !important;
        transition: all 0.3s ease !important;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.4) 0%, rgba(147, 51, 234, 0.4) 100%) !important;
        transform: scale(1.1) !important;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: 600 !important;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.4) !important;
        width: 12px !important;
        height: 12px !important;
        transition: all 0.3s ease !important;
    }

    .swiper-pagination-bullet-active {
        background: linear-gradient(135deg, #3b82f6 0%, #9333ea 100%) !important;
        transform: scale(1.3) !important;
    }

    .category-carousel {
        overflow: hidden;
        margin: 0 -20px;
        padding: 20px 0;
    }

    .category-header {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .tag-pill {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .tag-pill:hover {
        background: rgba(59, 130, 246, 0.2);
        border-color: rgba(59, 130, 246, 0.4);
        transform: translateY(-1px);
    }

    /* Mobile responsive fixes using flexbox */
    @media (max-width: 768px) {
        .max-w-7xl {
            max-width: 100%;
            margin: 0;
            padding-left: 1rem;
            padding-right: 1rem;
            width: 100%;
        }

        section {
            overflow-x: hidden;
            width: 100%;
        }

        .grid {
            overflow-x: hidden;
            width: 100%;
        }
    }

    /* Ensure all containers use full width */
    .container,
    .max-w-7xl {
        width: 100%;
        box-sizing: border-box;
    }

    /* Grid layout fixes */
    .grid {
        width: 100%;
        box-sizing: border-box;
    }

    /* Footer positioning */
    footer {
        margin-top: auto;
        width: 100%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<body class="bg-black text-white">
    <!-- Navigation and Footer will be injected by common.js -->

    <div class="flex-1">
        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-purple-900/20 to-black"></div>
            <div class="absolute inset-0">
                <div class="floating absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-60"></div>
                <div class="floating absolute top-40 right-20 w-6 h-6 bg-purple-400 rounded-full opacity-40" style="animation-delay: 2s;"></div>
                <div class="floating absolute bottom-40 left-1/4 w-3 h-3 bg-cyan-400 rounded-full opacity-50" style="animation-delay: 4s;"></div>
            </div>



            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 ">


                <?php if (!empty($hero['title'])) : ?>
                    <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-bold mb-6 opacity-0">
                        <?= esc($hero['title'] ?? "about title") ?>
                        <br />
                        <?php if (!empty($hero['gradientTitle'])) : ?>
                            <span class="gradient-text"> <?= esc($hero['gradientTitle'] ?? "gradient content title") ?></span>
                        <?php endif; ?>
                        <br />
                        <?php if (!empty($hero['subTitle'])) : ?>
                            <?= esc($hero['subTitle'] ?? "gradient content title") ?>
                        <?php endif; ?>

                    </h1>
                <?php endif; ?>


                <?php if (!empty($hero['description'])) : ?>
                    <p class="hero-subtitle text-base sm:text-lg md:text-xl text-gray-400 max-w-3xl mx-auto opacity-0 px-4">
                        <?= esc($hero['description'] ?? "description about page") ?>
                    </p>
                <?php endif; ?>




                <?php if (!empty($hero['btn']) && count($hero['btn']) > 0 && is_array($hero['btn'])) : ?>
                    <div class="mt-10 sm:gap-4 gap-2 hero-cta opacity-0 flex flex-wrap sm:flex-row gap-4 justify-center items-center transition-all ease duration-500 ">
                        <?php foreach ($hero['btn'] as $i => $btn) : ?>

                            <?php if ($i % 2 === 0): ?>
                                <a href="<?= base_url($btn['link'] ?? "")  ?>" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-gray-200 transition-all duration-300">
                                    <?= esc($btn['label'] ?? "") ?>
                                </a>

                            <?php else: ?>
                                <a href="<?= base_url($btn['link'] ?? "")  ?>" class="magnetic-btn border border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-white hover:text-black transition-all duration-300">
                                    <?= esc($btn['label'] ?? "") ?>
                                </a>
                            <?php endif; ?>


                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Dynamic Category Sections -->

        <div id="categories-container">
            <div class="max-w-7xl pt-10 mx-auto px-4 sm:px-6 lg:px-8">
                <?php foreach ($projects as $category): ?>
                    <?php if (isset($category) && is_array($category['projects']) && count($category['projects']) > 0): ?>
                        <div class="mb-20">
                            <!-- Category Header -->
                            <div class="category-header">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center gap-3 mb-3">
                                            <span class="text-4xl"><?= $category['icon'] ?></span>
                                            <h2 class="text-3xl font-bold bg-gradient-to-r <?= $category['gradient'] ?> bg-clip-text text-transparent">
                                                <?= $category['name'] ?>
                                            </h2>
                                        </div>
                                        <p class="text-gray-400 text-lg hidden md:block"><?= $category['description'] ?></p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-<?= $category['accentColor'] ?>">
                                            <?= $category['projectCount'] ?>
                                        </div>
                                        <div class="text-sm text-gray-400">Projects</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Carousel -->
                            <div class="card-carousel-wrapper  w-full">
                                <div class="swiper category-carousel sm:px-8" data-category="<?= $category['id'] ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($category['projects'] as $project):

                                            $media = $project["media"] ?? [];
                                            $image = $project['image'] ?? "";
                                        ?>


                                            <div class="swiper-slide  p-6 md:p-0 h-[400px] flex md:justify-start justify-center">
                                                <a href="<?= isset($project['title']) ?esc(base_url("/work/". Utils::slugify($project['title']))):"" ?>" class="work-card flex flex-col card-carousel-wrapper  h-full mx-2 sm:mx-4 w-full min-w-[250px] w-full sm:max-w-[300px] group"
                                                    data-work="<?= $project['id'] ?>"
                                                    data-category="<?= $category['name'] ?>">

                                                    <!-- Image -->
                                                    <div class="card-image max-h-[70%]  overflow-hidden relative aspect-[4/3]">
                                                        <?php

                                                        if (count($media) > 0 && is_array($media) && !empty($media)): ?>
                                                            <img src="<?= base_url($media[0]['url']) ?>"
                                                                alt="<?= $project['title'] ?>"
                                                                class="w-full absolute h-full object-fill transition-transform duration-500">
                                                        <?php else : ?>
                                                            <img src="<?= $image ?>"
                                                                alt="<?= $project['title'] ?>"
                                                                class="w-full h-full object-cover transition-transform duration-500">

                                                        <?php endif ?>

                                                        <div class="card-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                                            <div class="p-4 w-full">
                                                                <div class="flex justify-between items-center">
                                                                    <span class="text-white font-medium">

                                                                        <?= isset($project['link']) ? "View Project" : 'View Case Study' ?>

                                                                    </span>
                                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Content -->
                                                    <div class="p-6">
                                                        <div class="category-tag text-xs font-semibold mb-3 px-3 py-1 rounded-full inline-block text-<?= $category['tagColor'] ?>">
                                                            <?= $category['name'] ?>
                                                        </div>
                                                        <h3 class="text-xl font-bold mb-3 group-hover:text-<?= $category['accentColor'] ?> transition-colors">
                                                            <?= $project['title'] ?>
                                                        </h3>
                                                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                                                            <?= $project['description'] ?>
                                                        </p>
                                                        <div class="flex flex-wrap gap-2">
                                                            <?php foreach ($project['tags'] as $tag): ?>
                                                                <span class="tag-pill px-3 py-1 text-xs rounded-full text-gray-300"><?= $tag ?></span>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>

        <!-- CTA Section -->
        <section class="py-20 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="section-title text-4xl font-bold mb-6">Ready to Create Your Success Story?</h2>
                <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                    Let's discuss how we can help transform your brand and achieve remarkable results together.
                </p>
                <a href="/contact" class="cta-button bg-white text-black px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition-colors transform hover:scale-105">
                    Start Your Project
                </a>
            </div>
        </section>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        function calculateSlidesPerView(wrapper, cardMinWidth = 300, spacing = 24) {
            const wrapperWidth = wrapper.offsetWidth;
            const totalCardWidth = cardMinWidth + spacing;
            const perView = Math.floor(wrapperWidth / totalCardWidth);
            return Math.max(1, perView);
        }

        function initializeProjectCarousels() {
            const carousels = document.querySelectorAll('.category-carousel');

            carousels.forEach(carousel => {
                const wrapper = carousel.closest('.card-carousel-wrapper');
                const perView = calculateSlidesPerView(wrapper);

                const swiper = new Swiper(carousel, {
                    slidesPerView: perView,
                    spaceBetween: 24,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: carousel.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: carousel.querySelector('.swiper-button-next'),
                        prevEl: carousel.querySelector('.swiper-button-prev'),
                    }
                });

                window.addEventListener('resize', () => {
                    const newPerView = calculateSlidesPerView(wrapper);
                    swiper.params.slidesPerView = newPerView;
                    swiper.update();
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initializeProjectCarousels);
    </script>
</body>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/our-work.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>