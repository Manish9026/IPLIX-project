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
    <div class="pt-20">
        <!-- Hero Section -->
        <!-- <section 
        class="py-20 bg-gradient-to-b from-black to-gray-900 parallax-bg" 
        style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200');"> -->
        <section class="relative h-[calc(100vh-80px)] z-10  w-full">
            <div class="swiper carousel h-full">
                <div class="swiper-wrapper">
                    <div class="swiper-slide py-20 bg-gradient-to-b from-black to-gray-900 parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200');">



                    </div>
                    <div class="swiper-slide py-20 bg-gradient-to-b from-black to-gray-900 parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://www.theforage.com/blog/wp-content/uploads/2022/09/tech-companies.jpg');">



                    </div>


                    <!-- Add more slides as needed -->
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>

            <div class="max-w-7xl absolute w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="story-content opacity-0">
                        <div class="text-blue-400 text-lg mb-4 category">Technology</div>
                        <h1 class="hero-title text-5xl md:text-7xl font-bold mb-6">Tech Burner</h1>
                        <p class="hero-subtitle text-xl text-gray-400 mb-8">Transforming a Tech Reviewer into a Digital Icon</p>

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
                    <div class="story-image opacity-0">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800" alt="Tech Burner" class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </section>


        <!-- Results Section -->
        <section class="py-20 bg-gradient-to-r from-gray-900 to-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="section-title text-4xl font-bold text-center mb-16 opacity-0">The Results</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="1">
                        <div class="text-3xl font-bold text-blue-400 mb-2 counter" data-target="2.5">0</div>
                        <div class="text-gray-300 mb-2">YouTube Subscribers (M)</div>
                        <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                            <span>📈</span>
                            +400%
                        </div>
                    </div>

                    <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="2">
                        <div class="text-3xl font-bold text-purple-400 mb-2 counter" data-target="800">0</div>
                        <div class="text-gray-300 mb-2">Instagram Followers (K)</div>
                        <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                            <span>📈</span>
                            +600%
                        </div>
                    </div>

                    <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="3">
                        <div class="text-3xl font-bold text-cyan-400 mb-2 counter" data-target="50">0</div>
                        <div class="text-gray-300 mb-2">Monthly Revenue (K)</div>
                        <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                            <span>📈</span>
                            +800%
                        </div>
                    </div>

                    <div class="metric-card p-8 rounded-lg text-center opacity-0" data-metric="4">
                        <div class="text-3xl font-bold text-pink-400 mb-2 counter" data-target="25">0</div>
                        <div class="text-gray-300 mb-2">Brand Partnerships</div>
                        <div class="text-green-400 text-sm flex items-center justify-center gap-1">
                            <span>📈</span>
                            +500%
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Impact Section -->
        <section class="py-20 bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="impact-content opacity-0">
                        <h2 class="text-4xl font-bold mb-6">The Impact</h2>
                        <p class="text-lg text-gray-400 mb-6">
                            Through our comprehensive approach, we successfully transformed Tech Burner from
                            a single-platform creator into a multi-faceted digital brand with diversified
                            revenue streams and a loyal community.
                        </p>
                        <ul class="space-y-4 text-gray-400 impact-list">
                            <li class="flex items-start opacity-0" data-impact="1">
                                <span class="text-blue-400 mr-2 mt-1">🏆</span>
                                Established as a leading tech authority in India
                            </li>
                            <li class="flex items-start opacity-0" data-impact="2">
                                <span class="text-blue-400 mr-2 mt-1">🏆</span>
                                Successful launch of merchandise line
                            </li>
                            <li class="flex items-start opacity-0" data-impact="3">
                                <span class="text-blue-400 mr-2 mt-1">🏆</span>
                                Strategic partnerships with major tech brands
                            </li>
                            <li class="flex items-start opacity-0" data-impact="4">
                                <span class="text-blue-400 mr-2 mt-1">🏆</span>
                                Community of engaged tech enthusiasts
                            </li>
                        </ul>
                    </div>
                    <div class="impact-image opacity-0">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600" alt="Impact metrics" class="rounded-lg shadow-2xl transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
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