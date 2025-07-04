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

    .service-section {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.02);
    }

    .service-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
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

    /* Footer positioning */
    footer {
        margin-top: auto;
        width: 100%;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<body class="bg-black text-white">
    <!-- Navigation -->


    <div class="flex-1">
        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-purple-900/20 to-black"></div>
            <div class="absolute inset-0">
                <div class="floating absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-60"></div>
                <div class="floating absolute top-40 right-20 w-6 h-6 bg-purple-400 rounded-full opacity-40" style="animation-delay: 2s;"></div>
                <div class="floating absolute bottom-40 left-1/4 w-3 h-3 bg-cyan-400 rounded-full opacity-50" style="animation-delay: 4s;"></div>
            </div>

            <div class="container text-center z-10">

                <?php if (!empty($hero['title'])) : ?>
                    <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-bold mb-6 opacity-0">
                        <?= esc($hero['title'] ?? "about title") ?>
                        <br />
                        <?php if (!empty($hero['gradientTitle'])) : ?>
                            <span class="gradient-text"> <?= esc($hero['gradientTitle'] ?? "gradient content title") ?></span>
                        <?php endif; ?>
                        <br/>
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

        <!-- Service Sections -->
        <div id="services-container">
            <?php foreach ($services as $index => $service): ?>
                <section class="service-section py-20 <?= $index % 2 === 0 ? 'bg-gray-900' : 'bg-black' ?>" data-service="<?= nl2br(esc($index)) ?>" data-reversed="<?= ($index % 2 !== 0) ? '1' : '0' ?>" data-feature='<?= count($service['features']) ?>'>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center <?= ($index % 2 !== 0) ? 'lg:grid-flow-col-dense' : '' ?>">

                            <!-- Content Section -->
                            <div class="service-content <?= ($index % 2 !== 0) ? 'lg:col-start-2' : '' ?>" data-content="<?= esc($index) ?>">
                                <div class="text-6xl mb-6 service-icon" data-icon="<?= esc($index) ?>"><?= esc($service['icon']) ?></div>
                                <h2 class="text-4xl md:text-5xl font-bold mb-6 service-title" data-title="<?= esc($index) ?>">
                                    <?= esc($service['title']) ?>
                                </h2>
                                <p class="text-xl text-gray-300 mb-8 service-description" data-description="<?= esc($index) ?>">
                                    <?= esc($service['description']) ?>
                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                    <?php foreach ($service['features'] as $featureIndex => $feature): ?>
                                        <div class="service-feature flex items-center text-gray-400" data-feature="<?= esc($index) ?>-<?= $featureIndex ?>">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 flex-shrink-0"></div>
                                            <span><?= esc($feature) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <button class="service-cta bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105"
                                    data-cta="<?= esc($index) ?>">
                                    Learn More
                                </button>
                            </div>

                            <!-- Image Section -->
                            <div class="service-image-container <?= ($index % 2 !== 0) ? 'lg:col-start-1' : '' ?>" data-image-container="<?= esc($index) ?>">
                                <div class="relative group">
                                    <div class="service-image-wrapper overflow-hidden rounded-2xl shadow-2xl" data-image-wrapper="<?= esc($index) ?>">

                                        <?php if (strpos($service['mediaType'], 'image/') === 0): ?>
                                            <img src="<?= base_url($service['media']) ?>" alt="Service Image" class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110"
                                                data-image="<?= esc($index) ?>" />
                                        <?php elseif (strpos($service['mediaType'], 'video/') === 0): ?>
                                            <video autoplay muted loop class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110"
                                                data-image="<?= esc($index) ?>">
                                                <source src="<?= base_url($service['media']) ?>" type="<?= esc($service['mediaType']) ?>">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php else: ?>
                                            <p>Unsupported media type</p>
                                        <?php endif; ?>

                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-500/20 to-purple-600/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" data-glow="<?= esc($index) ?>"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>


        <!-- Process Section -->
        <section class="py-20 bg-black">
            <div class="container">
                <h2 class="section-title text-4xl md:text-6xl font-bold text-center mb-16">Our Process</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    <?php foreach ($workflow as $index => $item) : ?>
                        <div class="process-step text-center" data-step='<?= esc($index) ?>'>
                            <div class="text-4xl font-bold text-blue-400 mb-4"><?= esc($item['step']) ?></div>
                            <h3 class="text-xl font-semibold mb-4"><?= esc($item['title']) ?></h3>
                            <p class="text-gray-400"><?= esc($item['description']) ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    </div>


</body>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/what-we-do.js') ?>"></script>

<?= $this->endSection() ?>