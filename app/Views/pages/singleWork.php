<?php
// Basic string fields
$id = isset($workList['id']) ? trim($workList['id']) : uniqid();
$title = isset($workList['title']) ? trim($workList['title']) : '';
$description = isset($workList['description']) ? trim($workList['description']) : '';

$catId = isset($workList['catId']) ? trim($workList['catId']) : '';
$catTitle = isset($workList['catTitle']) ? trim($workList['catTitle']) : '';
$catDes = isset($workList['catDes']) ? trim($workList['catDes']) : '';

// Optional metadata
$gradient = isset($workList['gradient']) ? trim($workList['gradient']) : '';
$accentColor = isset($workList['accentColor']) ? trim($workList['accentColor']) : '';
$tagColor = isset($workList['tagColor']) ? trim($workList['tagColor']) : '';
$alterColor = isset($workList['alterColor']) ? trim($workList['alterColor']) : '';
$baseColor = isset($workList['baseColor']) ? trim($workList['baseColor']) : '';

// Timestamps
$createdAt = isset($workList['created_at']) ? trim($workList['created_at']) : date("Y-m-d H:i:s");
$updatedAt = isset($workList['updated_at']) ? trim($workList['updated_at']) : date("Y-m-d H:i:s");

// Arrays
$tags = (isset($workList['tags']) && is_array($workList['tags'])) ? $workList['tags'] : [];

$bannerMedia = (isset($workList['bannerMedia']) && is_array($workList['bannerMedia']) && !empty($workList['bannerMedia']))
    ? $workList['bannerMedia']
    : [];

$cardMedia = (isset($workList['cardMedia']) && is_array($workList['cardMedia']) && !empty($workList['cardMedia']))
    ? $workList['cardMedia']
    : [];

$result = (isset($workList['result']) && is_array($workList['result']) && !empty($workList['result']))
    ? $workList['result']
    : [];

$impacts = (isset($workList['impacts']) && is_array($workList['impacts']) && !empty($workList['impacts']))
    ? $workList['impacts']
    : [];

$challenges = (isset($workList['challenges']) && is_array($workList['challenges']) && !empty($workList['challenges']))
    ? $workList['challenges']
    : [];


log_message("error", print_r($bannerMedia, true));

?>
<?= $this->extend('layout') ?>


<?= $this->section('styles') ?>
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .gradient-text {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6, #06b6d4);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .metric-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .parallax-bg {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<body class="bg-black text-white overflow-x-hidden">
    <!-- Navigation -->
    <div class="">

        <section class="relative h-[calc(100vh)] z-10  w-full">
            <div class="swiper carousel h-full">
                <div class="swiper-wrapper">


                    <?php if (!empty($bannerMedia)): ?>

                        <?php foreach ($bannerMedia as $media):
                            $url = !empty($media['url']) ? base_url($media['url']) : "https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200";
                            $type = !empty($media['type']) ? $media['type'] : "image";

                        ?>
                            <div class="swiper-slide py-20 bg-gradient-to-b from-black to-gray-900 parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?= esc($url) ?>');">

                            </div>
                        <?php endforeach; ?>


                    <?php else : ?>

                        <div class="swiper-slide py-20 bg-gradient-to-b from-black to-gray-900 parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://www.theforage.com/blog/wp-content/uploads/2022/09/tech-companies.jpg');">



                        </div>
                    <?php endif; ?>

                </div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>

            <div class="max-w-7xl absolute w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="story-content opacity-0">
                        <div class="text-blue-400 text-lg mb-4 category"><?= esc($catTitle) ?></div>
                        <h1 class="hero-title text-5xl md:text-7xl font-bold mb-6"><?= esc($title) ?></h1>
                        <p class="hero-subtitle text-xl text-gray-400 mb-8"><?= esc($description) ?></p>

                        <div class="flex flex-wrap gap-6 text-gray-400 project-details">
                            <div class="flex items-center gap-2">
                                <span>📅</span>
                                <span>6 months</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span>👥</span>
                                <span>8 members</span>
                            </div>
                        </div>
                    </div>
                    <div class="story-image opacity-0 min-h-[300px] min-w-[300px] relative">
                        <img src="<?= esc(!empty($cardMedia[0]["url"]) ? base_url($cardMedia[0]["url"]) : "https://images.unsplash.com/photo-1518770660439-4636190af475?w=800") ?>" alt="Tech Burner" class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-500 object-contain rounded-xl w-full absolute h-full">
                    </div>
                </div>
            </div>
        </section>


        <!-- Results Section -->
        <section class="py-20 bg-gradient-to-r from-gray-900 to-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="section-title text-4xl font-bold text-center mb-16 opacity-0">The Results</h2>


                <?php if (isset($result) && is_array($result) && count($result) > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php foreach ($result as $i => $item): ?>
                            <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="<?= esc($i) ?>">
                                <div class="text-3xl font-bold text-blue-400 mb-2 counter" data-target="<?= esc($item['value']) ?>">0</div>
                                <div class="text-gray-300 mb-2"><?= isset($item['title']) ? esc($item['title']) : "" ?></div>
                                <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                                    <span><?= esc($item['icon'] ?? '📈') ?></span>
                                    <?= esc($item['label']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="1">
                            <div class="text-3xl font-bold text-blue-400 mb-2 counter" data-target="2.5">0</div>
                            <div class="text-gray-300 mb-2">YouTube Subscribers (M)</div>
                            <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                                <span>📈</span>
                                +400%
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No items available.</p>
                <?php endif; ?>

            </div>
        </section>
        <!-- Impact Section -->
        <section class="py-20 bg-gray-900">

            <?php if (isset($impacts) && is_array($impacts) && count($impacts) > 0): ?>
                <div class="max-w-7xl mx-auto px-4 flex flex-wrap gap-8 sm:px-6 lg:px-8">

                    <?php foreach ($impacts as $i => $item):

                        $iTitle = !empty($item['title']) && isset($item['title']) ? $item['title'] : "";
                        $iSubTitle = !empty($item['subTitle']) && isset($item['subTitle']) ? $item['subTitle'] : "";
                        $iDes = !empty($item['description']) && isset($item['description']) ? $item['description'] : "";
                        $media = !empty($item['media']) && isset($item['media']) && count($item['media']) > 0 ? $item['media'] : [];
                        $iPoints = !empty($item['points']) && isset($item['points']) && count($item['points']) > 0 ? $item['points'] : [];
                        $isReversed = $i % 2 === 0 ? false : true;
                        log_message("error", ("index" . $isReversed));
                    ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center sm:my-8 mb-12 my-4">
                            <div class="impact-content opacity-0 order-<?= $isReversed ? "2" : "1" ?>">
                                <h2 class="text-4xl font-bold mb-6"><?= esc($iTitle) ?></h2>
                                <p class="text-lg text-gray-400 mb-6">
                                    <?= esc($iDes) ?>
                                </p>
                                <ul class="space-y-4 text-gray-400 impact-list">
                                    <?php foreach ($iPoints as $i => $point): ?>
                                        <li class="flex items-start opacity-0" data-impact="<?= esc($i) ?>">
                                            <span class="text-blue-400 mr-2 mt-1">🏆</span>
                                            <?= esc($point) ?>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                            <div class="impact-image opacity-0 order-<?= $isReversed ? "1" : "2" ?>">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600" alt="Impact metrics" class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No items available.</p>
            <?php endif; ?>


        </section>
        <!-- Challenge Section -->
        <section class="py-20 bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="section-title text-4xl font-bold mb-8 opacity-0">The Challenge</h2>
                <p class="challenge-text text-lg text-gray-400 max-w-4xl opacity-0">
                    Tech Burner needed to scale beyond YouTube reviews and establish himself as a trusted tech authority across multiple platforms while building a sustainable business model. The challenge was to maintain authenticity while expanding reach and revenue streams.
                </p>
            </div>
        </section>

        <!-- Strategy Section -->
        <section class="py-20 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="section-title text-4xl font-bold mb-8 opacity-0">Our Strategy</h2>
                <p class="strategy-text text-lg text-gray-400 max-w-4xl mb-12 opacity-0">
                    We developed a comprehensive brand strategy focusing on authenticity, expertise, and community building. Our approach included content diversification, strategic partnerships, and merchandise development.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="strategy-image opacity-0" data-strategy="1">
                        <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600" alt="Strategy 1" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="strategy-image opacity-0" data-strategy="2">
                        <img src="https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?w=600" alt="Strategy 2" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="strategy-image opacity-0" data-strategy="3">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600" alt="Strategy 3" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </section>





        <!-- CTA Section -->
        <section class="py-20 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="cta-title text-4xl font-bold mb-6 opacity-0">Ready to Transform Your Brand?</h2>
                <p class="cta-text text-xl text-gray-400 mb-8 max-w-2xl mx-auto opacity-0">
                    Let's create your success story. Get in touch to discuss how we can help
                    you achieve similar results.
                </p>
                <button class="cta-button magnetic-btn bg-white text-black px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition-colors opacity-0">
                    Start Your Project
                </button>
            </div>
        </section>
    </div>
</body>

<?= $this->section('scripts') ?>
<script>
    const swiper = new Swiper('.mySwiper', {
        loop: true,
        grabCursor: true,
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            },
        },
    });
</script>

<script src="<?= base_url('assets/js/case-study.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>