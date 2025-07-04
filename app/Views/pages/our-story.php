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
        flex: 1;
        margin: 0 auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .team-track,
    .team-card {
        will-change: transform;
    }

    .team-scroll-container {

        overflow: hidden;
        mask: linear-gradient(90deg, transparent, white 20%, white 80%, transparent);
    }

    .team-track {
        display: flex;
        gap: 2rem;
        animation: scroll-left 30s linear infinite;
    }

    @keyframes scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .team-card {
        min-width: 280px;
        flex-shrink: 0;
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



    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .timeline-line {
        background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
    }

    .orbital-system {
        position: absolute;
        top: 10%;
        left: 10%;
        width: 300px;
        height: 300px;
        pointer-events: none;
        opacity: 0;
    }

    .orbit {
        position: absolute;
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .orbit-1 {
        width: 100px;
        height: 100px;
    }

    .orbit-2 {
        width: 175px;
        height: 175px;
    }

    .orbit-3 {
        width: 250px;
        height: 250px;
    }

    .planet {
        position: absolute;
        border-radius: 50%;
        top: 50%;
        left: 50%;
    }

    .sun {
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        box-shadow: 0 0 15px rgba(245, 158, 11, 0.5);
        transform: translate(-50%, -50%);
    }

    .planet-1 {
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 0 8px rgba(59, 130, 246, 0.4);
    }

    .planet-2 {
        width: 10px;
        height: 10px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.4);
    }

    .planet-3 {
        width: 7px;
        height: 7px;
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        box-shadow: 0 0 6px rgba(6, 182, 212, 0.4);
    }

    /* Enhanced Mobile Responsive Fixes */
    @media (max-width: 768px) {
        .orbital-system {
            width: 200px;
            height: 200px;
            top: 5%;
            left: 5%;
        }

        .orbit-1 {
            width: 70px;
            height: 70px;
        }

        .orbit-2 {
            width: 120px;
            height: 120px;
        }

        .orbit-3 {
            width: 170px;
            height: 170px;
        }

        .team-card {
            min-width: 240px;
        }
    }

    /* Timeline Animation Classes */
    .timeline-milestone {
        opacity: 0;
        transform: translateY(30px) scale(0.9);
        transition: all 0.6s ease-out;
    }

    .timeline-milestone.animate-in {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .timeline-dot {
        transition: all 0.3s ease;
    }

    .timeline-dot:hover {
        transform: scale(1.2);
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
    }

    /* Enhanced Mobile Timeline Styles */
    @media (max-width: 768px) {
        .mobile-timeline-card {
            max-width: calc(100vw - 4rem);
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    }

    @media (max-width: 480px) {
        .mobile-timeline-card {
            max-width: calc(100vw - 3rem);
        }
    }

    /* gallery css  */

    /* ======= Gallery Grid ======= */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        aspect-ratio: 4 / 3;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        /* object-fit: cover; */
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: end;
        padding: 1.5rem;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    /* ======= Animated Gallery ======= */
    .animated-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1rem;
        transition: all 0.3s ease;
        will-change: transform;
    }

    .gallery-card {
        will-change: transform;
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border-radius: 1rem;
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .gallery-card:hover {
        transform: translateY(-8px) scale(1.02);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: fill;
        transition: all 0.6s ease;
        clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    /* ======= Hover Shape Variants ======= */
    .gallery-card:nth-child(1) .gallery-image:hover {
        clip-path: circle(70% at 50% 50%);
    }

    .gallery-card:nth-child(2) .gallery-image:hover {
        clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
    }

    .gallery-card:nth-child(3) .gallery-image:hover {
        clip-path: ellipse(65% 80% at 50% 50%);
    }

    .gallery-card:nth-child(4) .gallery-image:hover {
        clip-path: polygon(0% 0%, 75% 0%, 100% 100%, 25% 100%);
    }

    .gallery-card:nth-child(5) .gallery-image:hover {
        clip-path: circle(60% at 50% 50%);
    }

    .gallery-card:nth-child(6) .gallery-image:hover {
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    }

    .gallery-card:nth-child(7) .gallery-image:hover {
        clip-path: ellipse(80% 60% at 50% 50%);
    }

    .gallery-card:nth-child(8) .gallery-image:hover {
        clip-path: polygon(0% 20%, 60% 20%, 60% 0%, 100% 50%, 60% 100%, 60% 80%, 0% 80%);
    }

    .gallery-card:nth-child(9) .gallery-image:hover {
        clip-path: circle(65% at 50% 50%);
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.15);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.8), rgba(139, 92, 246, 0.8));
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.4s ease;
        border-radius: 1rem;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-text {
        text-align: center;
        color: white;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.1s;
    }

    .gallery-card:hover .gallery-text {
        transform: translateY(0);
    }

    /* ======= Button Styles ======= */
    .view-more-btn {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .view-more-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1d4ed8, #7c3aed);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .view-more-btn:hover::before {
        opacity: 1;
    }

    .view-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }

    .view-more-btn span {
        position: relative;
        z-index: 1;
    }

    /* ======= Visibility Toggle ======= */
    .hidden-gallery {
        display: none;
    }

    .show-gallery {
        display: grid;
        animation: fadeInUp 0.6s ease-out;
    }

    /* ======= Responsive ======= */
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .animated-gallery {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            max-width: 500px;
        }
    }

    @media (max-width: 480px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }

        .animated-gallery {
            grid-template-columns: 1fr;
            max-width: 300px;
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

    <div class="">



    </div>

    <div class="flex-1 pt-20">
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-b from-black to-gray-900 overflow-hidden">
            <!-- Orbital Animation -->
            <div class="orbital-system" id="orbital-system">
                <!-- Sun (center) -->
                <div class="sun planet"></div>

                <!-- Orbit paths -->
                <div class="orbit orbit-1"></div>
                <div class="orbit orbit-2"></div>
                <div class="orbit orbit-3"></div>

                <!-- Planets -->
                <div class="planet planet-1" id="planet-1"></div>
                <div class="planet planet-2" id="planet-2"></div>
                <div class="planet planet-3" id="planet-3"></div>
            </div>

            <div class="relative z-10 container text-center capitalize">

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



        <!-- Mission Section -->
        <section class="py-20 bg-gray-900">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="story-content opacity-0">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6"><?= esc($ourMission['title']) ?></h2>
                        <p class="text-base sm:text-lg text-gray-400 mb-6">
                            <?= nl2br(esc($ourMission['description'])) ?>

                        </p>
                        <p class="text-base sm:text-lg text-gray-400">
                            Our approach combines data-driven insights with creative intuition, ensuring
                            every campaign not only looks amazing but delivers measurable results.
                        </p>
                    </div>
                    <div class="story-image opacity-0">
                        <img src="<?= esc($ourMission['image']) ?>" alt="Team collaboration" class="rounded-lg shadow-2xl w-full h-auto">
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Timeline Section -->
        <section class="py-20 bg-black">
            <div class="container">
                <h2 class="section-title text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-center mb-16 opacity-0">Our Journey</h2>

                <!-- Desktop Timeline -->
                <div class="hidden md:block relative">
                    <div class="timeline-line absolute left-1/2 transform -translate-x-px h-full w-0.5"></div>
                    <?php if (!empty($timeline)): ?>
                        <div id="desktop-timeline-cards" class="space-y-10">
                            <?php foreach ($timeline as $idx => $milestone):
                                $left = $idx % 2 === 0;
                            ?>
                                <div class="timeline-milestone flex items-center<?= $left ? '' : ' flex-row-reverse' ?>" data-milestone="<?= $idx + 1 ?>">
                                    <!-- Milestone Card -->
                                    <div class="w-1/2 flex <?= $left ? 'justify-end pr-8' : 'justify-start pl-8' ?>">
                                        <div class="bg-gray-900 p-6 rounded-lg border border-gray-800 transition-all duration-300 hover:shadow-lg text-<?= $left ? 'right' : 'left' ?> max-w-lg w-full
                        hover:border-<?= esc($milestone['color']) ?> hover:shadow-<?= esc($milestone['color']) ?>/20">
                                            <div class="text-<?= esc($milestone['color']) ?> text-2xl font-bold mb-2"><?= esc($milestone['year']) ?></div>
                                            <h3 class="text-xl font-semibold mb-2"><?= esc($milestone['title']) ?></h3>
                                            <p class="text-gray-400"><?= esc($milestone['description']) ?></p>
                                        </div>
                                    </div>

                                    <!-- Dot & Line -->
                                    <div class="flex flex-col items-center w-12 relative">
                                        <div class="timeline-dot w-5 h-5 bg-<?= esc($milestone['color']) ?> rounded-full border-4 border-black z-10"></div>
                                        <?php if ($idx < count($timeline) - 1): ?>
                                            <div class="h-full w-1 bg-gradient-to-b from-<?= esc($milestone['color']) ?> to-gray-900"></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Empty Half -->
                                    <div class="w-1/2"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Mobile Timeline -->
                <div class="md:hidden relative px-2 overflow-hidden">
                    <!-- Vertical line fixed for all widths -->
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-blue-400 to-purple-600 z-0"></div>
                    <div id="mobile-timeline-wrapper" class="block md:hidden ">
                        <!-- Loading State -->
                        <div id="timeline-loading" class="flex justify-center py-10">
                            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-500 border-t-transparent"></div>
                        </div>

                        <!-- Timeline Content -->
                        <div id="mobile-timeline" class="hidden">
                            <?php if (!empty($timeline)): ?>
                                <?php foreach ($timeline as $idx => $milestone): ?>
                                    <div class="relative flex items-start mb-14 last:mb-0" data-milestone="<?= $idx + 1 ?>">
                                        <!-- Dot -->
                                        <div class="absolute left-[1.1rem] top-6 w-4 h-4 bg-<?= esc($milestone['color']) ?> rounded-full border-2 border-black z-10"></div>

                                        <!-- Card offset right from dot -->
                                        <div class="ml-12 w-full mobile-timeline-card">
                                            <div class="bg-gray-900 p-4 rounded-lg border border-gray-800 shadow-lg transition-all hover:shadow-<?= esc($milestone['color']) ?>/40">
                                                <div class="text-<?= esc($milestone['color']) ?> text-lg font-bold mb-1">
                                                    <?= esc($milestone['year']) ?>
                                                </div>
                                                <h3 class="text-base font-semibold mb-1"><?= esc($milestone['title']) ?></h3>
                                                <p class="text-gray-400 text-xs leading-relaxed"><?= esc($milestone['description']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-gray-400 py-10">
                                    <p class="text-xl font-semibold">No timeline data available.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-gradient-to-r from-gray-900 to-black">
            <div class="container">
                <h2 class="section-title text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-16 opacity-0">By the Numbers</h2>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                    <?php if (!empty($stats)): ?>
                        <?php foreach ($stats as $index => $item): ?>

                            <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-black/50 rounded-lg border border-gray-800 opacity-0"
                                data-stat="<?= esc($index) ?>">
                                <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4"><?= esc($item['icon']) ?></div>
                                <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="<?= preg_replace('/\D/', '', $item['value']) ?>">
                                    0
                                </div>
                                <div class="text-gray-400 text-xs sm:text-sm md:text-base"><?= esc($item['label']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-full text-center text-gray-400">No stats available.</div>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-20 bg-gradient-to-r from-black to-gray-900">
            <div class=" m-0 md:mx-auto p-2 sm:p-4 md:p-6 lg:p-8 max-w-screen-4xl">
                <h2 class="section-title text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-center mb-16 opacity-0">Meet Our Team</h2>
                <p class="text-center text-gray-400  max-w-2xl mx-auto opacity-1 team-subtitle ">
                    Behind every great project is an exceptional team. Meet the creative minds and strategic thinkers who bring your vision to life.
                </p>

                <div class="team-scroll-container pt-12">
                    <div class="team-track" id="team-track">

                        <?php
                        // Repeat the loop twice for seamless scrolling
                        for ($repeat = 0; $repeat < 2; $repeat++):
                            foreach ($teamMembers as $member):
                                $profilePic = $member["profilePic"] ?? "";
                                $emoji = $member['emoji'] ?? ""
                        ?>
                                <div class="team-card w-[300px] will-change-transform sm:w-[400px] md:w-[600px] bg-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                                    <div class="w-20 h-20 bg-gradient-to-br <?= $member['color'] ?> rounded-full mb-4 mx-auto flex items-center justify-center">
                                        <?php
                                        if (!empty($profilePic) && isset($profilePic)  && file_exists(FCPATH . $profilePic)):

                                        ?>
                                            <img src="<?= base_url($profilePic) ?>" class="rounded-full w-full h-full rounded-full object-fill">

                                        <?php else: ?>
                                            <span class="text-2xl"><?= $emoji ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="text-xl font-semibold text-center mb-2"><?= htmlspecialchars($member['name']) ?></h3>
                                    <p class="<?= $member['textColor'] ?> text-center mb-3"><?= htmlspecialchars($member['role']) ?></p>
                                    <p class="text-gray-400 text-sm text-center"><?= htmlspecialchars($member['desc']) ?></p>
                                </div>
                        <?php
                            endforeach;
                        endfor;
                        ?>

                    </div>
                </div>
            </div>
        </section>

        <!-- IMAGE GALLERY -->

        <?php

        if (!empty($galleryItems) && is_array($galleryItems) && count($galleryItems) > 0) : ?>
            <section class="py-20 bg-gray-900">
                <div class="container">
                    <h2 class="section-title text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-center mb-16 opacity-0">Our Journey in Pictures</h2>
                    <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto opacity-0 gallery-subtitle">
                        A visual story of our growth, achievements, and the memorable moments that define who we are.
                    </p>

                    <div class="animated-gallery" id="gallery-grid">
                        <?php foreach ($galleryItems as $index => $item): ?>
                            <div
                                class="gallery-item <?= $item['hidden'] ? 'hidden' : '' ?>">
                                <?php foreach ($item['media'] as $indx => $media): ?>
                                    <?php if ($media["type"] == "image") : ?>
                                        <img
                                            src="<?= base_url($media['url'] ?? "") ?>"
                                            alt="<?= htmlspecialchars($item['alt']) ?>"
                                            class=" text-center  gallery-image object-fill"
                                            loading="lazy">

                                    <?php else : ?>

                                        <video class="gallery-image text-center" src="<?= base_url($media['url'] ?? "") ?>" muted autoplay loop></video>

                                    <?php endif; ?>

                                    <div class="gallery-overlay">
                                        <div class="gallery-text">
                                            <h3 class="font-semibold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
                                            <p class="text-sm"><?= htmlspecialchars($item['desc']) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-center mt-12">
                        <button id="view-more-btn" class="view-more-btn">
                            <span>View More</span>
                        </button>
                        <button id="view-less-btn" class="view-more-btn hidden">
                            <span>View Less</span>
                        </button>
                    </div>
                </div>
            </section>
        <?php endif ?>




    </div>

    <!-- Footer will be rendered by common.js -->

    <!-- Common Elements -->


</body>

<?= $this->section('scripts') ?>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const loading = document.getElementById('timeline-loading');
        const timeline = document.getElementById('mobile-timeline');

        // Simulate loading (optional: can be skipped if server-rendered only)
        setTimeout(() => {
            loading.classList.add('hidden');
            timeline.classList.remove('hidden');
            timeline.classList.add('animate-fadeIn');
        }, 500); // delay for smooth effect
    });
</script>
<script src="<?= base_url('assets/js/story.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>