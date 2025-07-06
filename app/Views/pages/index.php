<?php
$workList = $workList ?? [];
function limitToWords(string $text, int $limit = 20): string
{
    $words = preg_split('/\s+/', strip_tags($text));
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
    return $text;
}

?>
<?= $this->extend('layout') ?>

<?= $this->section('styles') ?>

<style>
    /* Fix horizontal scroll issues and ensure full screen coverage */
    html,
    body {
        width: 100%;
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
        overflow-x: hidden;
    }

    /* Container fixes */
    .container {
        width: 100%;
        margin: 0 auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 640px) {
        .container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .container {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    @media (min-width: 1280px) {
        .container {
            max-width: 1280px;
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    .hero-text {
        overflow: hidden;
    }

    .char {
        display: inline-block;
        background: inherit;
        -webkit-background-clip: inherit;
        background-clip: inherit;
        -webkit-text-fill-color: inherit;
        color: inherit;
    }

    .floating {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .gradient-text {
        background: linear-gradient(135deg, #60a5fa 0%, #a855f7 50%, #3b82f6 100%);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        animation: gradientShift 4s ease infinite;
        display: inline;
        position: relative;
        z-index: 1;
    }

    .gradient-text .char {
        background: linear-gradient(135deg, #60a5fa 0%, #a855f7 50%, #3b82f6 100%);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        animation: gradientShift 4s ease infinite;
    }

    .gradient-text::-moz-selection,
    .gradient-text .char::-moz-selection {
        background: rgba(96, 165, 250, 0.3);
        -webkit-text-fill-color: white;
        color: white;
    }

    .gradient-text::selection,
    .gradient-text .char::selection {
        background: rgba(96, 165, 250, 0.3);
        -webkit-text-fill-color: white;
        color: white;
    }

    .gradient-text,
    .gradient-text .char {
        transform: translateZ(0);
        will-change: background-position;
        backface-visibility: hidden;
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    @supports not (-webkit-background-clip: text) {

        .gradient-text,
        .gradient-text .char {
            background: none;
            color: #60a5fa;
            -webkit-text-fill-color: initial;
        }
    }

    .service-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .magnetic-btn {
        transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .work-item {
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .work-item:hover {
        transform: scale(1.05) rotateY(5deg);
    }

    .parallax-bg {
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    @media (min-width: 769px) {
        .parallax-bg {
            background-attachment: fixed;
        }
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
    <!-- Navigation will be rendered by common.js -->

    <div class="flex-1 pt-20">
        <!-- Hero Section -->

        <?php if (!empty($hero) && count($hero) > 0 && isset($hero)) : ?>


            <section class="min-h-screen flex items-center justify-center relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-purple-900/20 to-black"></div>
                <div class="absolute inset-0">
                    <div class="floating absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-60"></div>
                    <div class="floating absolute top-40 right-20 w-6 h-6 bg-purple-400 rounded-full opacity-40" style="animation-delay: 2s;"></div>
                    <div class="floating absolute bottom-40 left-1/4 w-3 h-3 bg-cyan-400 rounded-full opacity-50" style="animation-delay: 4s;"></div>
                    <div class="floating absolute bottom-20 right-1/3 w-5 h-5 bg-pink-400 rounded-full opacity-30" style="animation-delay: 1s;"></div>
                </div>

                <div class="container text-center z-10">

                    <?php if (!empty($hero['title'])) : ?>
                        <div class="hero-text mb-8">
                            <h1 class="text-4xl sm:text-6xl md:text-6xl lg:text-7xl font-bold leading-tight">

                                <span class="block hero-line-1"><?= esc($hero['title']) ?></span>
                                <?php if (!empty($hero['gradientTitle'])) : ?>

                                    <span class="block hero-line-2 gradient-text"><?= esc($hero['gradientTitle']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($hero['subTitle'])) : ?>

                                    <span class="block hero-line-3"><?= esc($hero['subTitle']) ?></span>
                                <?php endif; ?>
                            </h1>
                        </div>
                    <?php endif; ?>


                    <p class="hero-subtitle text-lg sm:text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto mb-12 opacity-0">
                        <?= esc($hero['description']) ?>
                    </p>

                    <div class="hero-cta opacity-0 flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="<?= base_url($hero['btn'][0]['link'])  ?>" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-gray-200 transition-all duration-300">
                            <?= esc($hero['btn'][0]['label']) ?>
                        </a>
                        <a href="<?= base_url($hero['btn'][1]['link'])  ?>" class="magnetic-btn border border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-white hover:text-black transition-all duration-300">
                            <?= esc($hero['btn'][1]['label']) ?>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif ?>
        <!-- What We Do Section -->



        <?php if (!empty($services) && count($services) > 0 && isset($services)) : ?>
            <section class="py-16 sm:py-20 bg-gradient-to-b from-black to-gray-900">
                <div class="container">
                    <h2 class="section-title text-3xl sm:text-5xl md:text-7xl font-bold text-center mb-12 sm:mb-16 opacity-0">
                        What We <span class="gradient-text">Do</span>
                    </h2>

                    <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] ">

                        <?php foreach ($services as $i => $service):
                            $subTitle = "";
                            if (isset($service['subTitle']) && !empty($service['subTitle'])) {
                                $subTitle = '<p class="text-gray-400 text-sm sm:text-base">' . esc(limitToWords($service['subTitle'], 15))

                                    . '</p>
                    ';
                            } else {
                                $subTitle = '<p class="text-gray-400 max-h-[200px]  text-sm sm:text-base">' . esc(limitToWords($service['description'], 15))

                                    . '</p>
                    ';
                            }
                        ?>
                            <div class="service-card sm:m-4 m-2 p-6 max-w-[400px] sm:p-8 rounded-2xl text-center group opacity-0 min-w-[250px]" data-service="<?= esc($i) ?>">
                                <div class="text-3xl sm:text-4xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300"><?= esc($service['icon'] ?? '🎯') ?></div>
                                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4"><?= esc($service['title']) ?></h3>
                                <p class="text-gray-400 text-sm sm:text-base">

                                    <?= $subTitle ?></p>
                            </div>
                        <?php endforeach; ?>



                    </div>

                    <div class="text-center mt-8 sm:mt-12">
                        <a href="./services" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold hover:bg-gray-200 transition-all duration-300 text-sm sm:text-base">
                            View All Services
                        </a>
                    </div>
                </div>
            </section>
        <?php endif ?>




        <!-- Our Work Section -->

        <?php if (!empty($workList) && count($workList) > 0 && isset($workList)) : ?>
            <section class="py-16 sm:py-20 bg-gray-900">
                <div class="container">
                    <h2 class="section-title text-3xl sm:text-5xl md:text-7xl font-bold text-center mb-12 sm:mb-16 opacity-0">
                        Our <span class="gradient-text">Work</span>
                    </h2>
                    <div class="swiper mySwiper w-full">
                        <div class="swiper-wrapper">

                            <?php foreach ($workList as $i => $item):


                            ?>

                                <a href="./case-study" class="work-item  swiper-slide block group opacity-0 h-[350px] md:h-[400px] " data-work="<?= esc($i) ?>">
                                    <div class="bg-black/50 min-h-full flex flex-col rounded-2xl border border-gray-800 overflow-hidden">
                                        <div class="flex-1 max-h-[70%] h-full bg-gradient-to-br from-<?= esc($item['baseColor'] ?? "blue") ?>-500 to-<?= esc($item['alterColor'] ?? "teal") ?>-600 relative overflow-hidden">
                                            <img src="<?= base_url($item['cardMedia'][0]['url'] ?? "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600") ?>" alt="<?= esc($item['title']) ?>" class="w-full h-full object-fill absolute  group-hover:scale-110 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        </div>
                                        <div class="p-4 sm:p-6">
                                            <div class="text-xs sm:text-sm text-<?= esc($item['baseColor'] ?? "blue") ?>-400 mb-2"><?= esc($item['catTitle']) ?></div>
                                            <h3 class="text-lg sm:text-xl font-semibold mb-3 group-hover:text-<?= esc($item['baseColor'] ?? "blue")  ?>-400 transition-colors"><?= esc($item['title']) ?></h3>
                                            <p class="text-gray-400 text-sm sm:text-base"><?= esc($item['description']) ?></p>
                                        </div>
                                    </div>
                                </a>


                            <?php endforeach; ?>


                            <!-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8"> -->




                            <!-- </div> -->
                        </div>
                        <div class="swiper-pagination bottom-0"></div>
                    </div>

                    <div class="text-center mt-8 sm:mt-12">
                        <a href="./portfolio" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold hover:bg-gray-200 transition-all duration-300 text-sm sm:text-base">
                            View All Projects
                        </a>
                    </div>
            </section>
        <?php endif ?>




        <!-- Our Story Teaser -->
        <section class="py-16 sm:py-20 bg-black parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200');">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="story-content opacity-0 text-center lg:text-left">
                        <h2 class="text-3xl sm:text-5xl md:text-6xl font-bold mb-4 sm:mb-6">
                            We're here to build
                            <span class="gradient-text">icons</span>
                        </h2>
                        <p class="text-lg sm:text-xl text-gray-300 mb-6 sm:mb-8">
                            Our journey began with a simple belief: every brand has the potential to become iconic.
                            Through strategic thinking and creative excellence, we transform ordinary businesses into extraordinary brands.
                        </p>
                        <a href="./story" class="magnetic-btn border border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold hover:bg-white hover:text-black transition-all duration-300 text-sm sm:text-base">
                            Our Story
                        </a>
                    </div>
                    <div class="story-image opacity-0">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600" alt="Our team" class="rounded-2xl shadow-2xl w-full h-auto">
                            <div class="absolute -bottom-4 sm:-bottom-6 -right-4 sm:-right-6 w-16 sm:w-24 h-16 sm:h-24 bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl opacity-80"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer will be rendered by common.js -->

    <!-- Common Elements -->

    <script>
        // Initialize common elements for home page
        // CommonElements.init('home');
    </script>
</body>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>