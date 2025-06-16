

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

    /* Container system for responsive design */
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

    .gradient-text {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6, #06b6d4);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 4s ease infinite;
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

    .perk-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .floating-shape {
        animation: float 8s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        25% {
            transform: translateY(-20px) rotate(5deg);
        }

        50% {
            transform: translateY(-10px) rotate(-5deg);
        }

        75% {
            transform: translateY(-30px) rotate(3deg);
        }
    }

    /* Grid layout fixes */
    .grid {
        width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    /* Ensure cards don't overflow */
    .perk-card,
    .position-card {
        width: 100%;
        box-sizing: border-box;
    }

    /* Mobile responsive text sizes */
    @media (max-width: 640px) {
        .hero-title {
            font-size: 3rem;
            line-height: 1.1;
        }

        .section-title {
            font-size: 2.5rem;
            line-height: 1.2;
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


    <div class="flex-1 pt-20">
        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 via-blue-900/20 to-black"></div>

            <!-- Floating shapes -->
            <div class="absolute inset-0">
                <div class="floating-shape absolute top-20 left-4 sm:left-10 w-6 sm:w-8 h-6 sm:h-8 bg-blue-400 rounded-full opacity-30"></div>
                <div class="floating-shape absolute top-40 right-8 sm:right-20 w-8 sm:w-12 h-8 sm:h-12 bg-purple-400 rounded-lg opacity-20" style="animation-delay: 2s;"></div>
                <div class="floating-shape absolute bottom-40 left-1/4 w-4 sm:w-6 h-4 sm:h-6 bg-cyan-400 opacity-40" style="animation-delay: 4s; clip-path: polygon(50% 0%, 0% 100%, 100% 100%);"></div>
                <div class="floating-shape absolute bottom-20 right-1/3 w-6 sm:w-10 h-6 sm:h-10 bg-pink-400 rounded-full opacity-25" style="animation-delay: 1s;"></div>
                <div class="floating-shape absolute top-1/2 left-1/3 w-3 sm:w-4 h-3 sm:h-4 bg-yellow-400 opacity-30" style="animation-delay: 3s; clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);"></div>
            </div>

            <div class="container text-center z-10">
                <h1 class="hero-title text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold leading-tight mb-6 sm:mb-8 opacity-0">
                    Do cool
                    <br />
                    <span class="gradient-text">sh*t</span>
                    <br />
                    with us.
                </h1>

                <p class="hero-subtitle text-lg sm:text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto mb-8 sm:mb-12 opacity-0 px-4">
                    Join a team of creative rebels who are redefining what it means to build iconic brands.
                    We're not just offering jobs – we're offering adventures.
                </p>

                <div class="hero-cta opacity-0 flex flex-col sm:flex-row gap-4 justify-center items-center px-4">
                    <a href="mailto:careers@iplix.in" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-base sm:text-lg hover:bg-gray-200 transition-all duration-300">
                        Apply Now
                    </a>
                    <button class="magnetic-btn border border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-base sm:text-lg hover:bg-white hover:text-black transition-all duration-300">
                        View Openings
                    </button>
                </div>
            </div>
        </section>

        <!-- Why Join Us Section -->
        <section class="py-16 sm:py-20 bg-gradient-to-b from-black to-gray-900">
            <div class="container">
                <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-center mb-12 sm:mb-16 opacity-0">
                    Why <span class="gradient-text">Join Us</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="1">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">🏖️</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Unlimited Leave</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Take time off when you need it. We trust you to manage your time and deliver great work.</p>
                    </div>

                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="2">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">🌎</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Remote Friendly</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Work from anywhere in the world. All we need is great internet and even greater ideas.</p>
                    </div>

                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="3">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">🎨</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Creative Freedom</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Your ideas matter. We give you the space and tools to bring your wildest creative visions to life.</p>
                    </div>

                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="4">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">💰</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Equity Participation</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Everyone gets a piece of the pie. When we grow, you grow with us.</p>
                    </div>

                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="5">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">📚</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Learning Budget</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Unlimited budget for courses, conferences, and books. Keep learning, keep growing.</p>
                    </div>

                    <div class="perk-card p-6 sm:p-8 rounded-2xl text-center group opacity-0" data-perk="6">
                        <div class="text-4xl sm:text-5xl md:text-6xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">🎉</div>
                        <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Epic Team Events</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Quarterly retreats, annual offsites, and spontaneous celebrations. Work hard, party harder.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Open Positions -->
        <section class="py-16 sm:py-20 bg-gray-900">
            <div class="container">
                <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-center mb-12 sm:mb-16 opacity-0">
                    Open <span class="gradient-text">Positions</span>
                </h2>

                <div class="space-y-6">
                    <div class="position-card bg-black/50 p-6 sm:p-8 rounded-2xl border border-gray-800 hover:border-gray-600 transition-all duration-300 group opacity-0" data-position="1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 group-hover:text-blue-400 transition-colors">Senior Creative Director</h3>
                                <p class="text-gray-400 mb-2 text-sm sm:text-base">Lead creative vision for major brand campaigns</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 sm:px-3 py-1 bg-blue-900/30 text-blue-400 text-xs sm:text-sm rounded-full">Full-time</span>
                                    <span class="px-2 sm:px-3 py-1 bg-purple-900/30 text-purple-400 text-xs sm:text-sm rounded-full">Remote</span>
                                    <span class="px-2 sm:px-3 py-1 bg-green-900/30 text-green-400 text-xs sm:text-sm rounded-full">5+ years</span>
                                </div>
                            </div>
                            <a href="mailto:careers@iplix.in?subject=Senior Creative Director Application" class="magnetic-btn bg-white text-black px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors text-sm sm:text-base text-center">
                                Apply Now
                            </a>
                        </div>
                    </div>

                    <div class="position-card bg-black/50 p-6 sm:p-8 rounded-2xl border border-gray-800 hover:border-gray-600 transition-all duration-300 group opacity-0" data-position="2">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 group-hover:text-purple-400 transition-colors">Brand Strategist</h3>
                                <p class="text-gray-400 mb-2 text-sm sm:text-base">Develop winning brand strategies and positioning</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 sm:px-3 py-1 bg-blue-900/30 text-blue-400 text-xs sm:text-sm rounded-full">Full-time</span>
                                    <span class="px-2 sm:px-3 py-1 bg-purple-900/30 text-purple-400 text-xs sm:text-sm rounded-full">Hybrid</span>
                                    <span class="px-2 sm:px-3 py-1 bg-green-900/30 text-green-400 text-xs sm:text-sm rounded-full">3+ years</span>
                                </div>
                            </div>
                            <a href="mailto:careers@iplix.in?subject=Brand Strategist Application" class="magnetic-btn bg-white text-black px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors text-sm sm:text-base text-center">
                                Apply Now
                            </a>
                        </div>
                    </div>

                    <div class="position-card bg-black/50 p-6 sm:p-8 rounded-2xl border border-gray-800 hover:border-gray-600 transition-all duration-300 group opacity-0" data-position="3">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 group-hover:text-cyan-400 transition-colors">Digital Marketing Manager</h3>
                                <p class="text-gray-400 mb-2 text-sm sm:text-base">Drive growth through innovative digital campaigns</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 sm:px-3 py-1 bg-blue-900/30 text-blue-400 text-xs sm:text-sm rounded-full">Full-time</span>
                                    <span class="px-2 sm:px-3 py-1 bg-purple-900/30 text-purple-400 text-xs sm:text-sm rounded-full">Remote</span>
                                    <span class="px-2 sm:px-3 py-1 bg-green-900/30 text-green-400 text-xs sm:text-sm rounded-full">2+ years</span>
                                </div>
                            </div>
                            <a href="mailto:careers@iplix.in?subject=Digital Marketing Manager Application" class="magnetic-btn bg-white text-black px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors text-sm sm:text-base text-center">
                                Apply Now
                            </a>
                        </div>
                    </div>

                    <div class="position-card bg-black/50 p-6 sm:p-8 rounded-2xl border border-gray-800 hover:border-gray-600 transition-all duration-300 group opacity-0" data-position="4">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 group-hover:text-pink-400 transition-colors">Motion Graphics Designer</h3>
                                <p class="text-gray-400 mb-2 text-sm sm:text-base">Create stunning animations and video content</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 sm:px-3 py-1 bg-blue-900/30 text-blue-400 text-xs sm:text-sm rounded-full">Full-time</span>
                                    <span class="px-2 sm:px-3 py-1 bg-purple-900/30 text-purple-400 text-xs sm:text-sm rounded-full">Remote</span>
                                    <span class="px-2 sm:px-3 py-1 bg-green-900/30 text-green-400 text-xs sm:text-sm rounded-full">2+ years</span>
                                </div>
                            </div>
                            <a href="mailto:careers@iplix.in?subject=Motion Graphics Designer Application" class="magnetic-btn bg-white text-black px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors text-sm sm:text-base text-center">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Culture Section -->
        <section class="py-16 sm:py-20 bg-black">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="culture-content opacity-0">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 sm:mb-6">
                            Our <span class="gradient-text">Culture</span>
                        </h2>
                        <p class="text-base sm:text-lg text-gray-400 mb-4 sm:mb-6">
                            We're not your typical agency. We're a collective of creative misfits who believe
                            that the best work comes from authentic collaboration, bold experimentation, and
                            having a damn good time while doing it.
                        </p>
                        <p class="text-base sm:text-lg text-gray-400 mb-6 sm:mb-8">
                            Here, your voice matters. Your ideas are heard. Your growth is our priority.
                            We're building something special, and we want you to be part of it.
                        </p>
                        <div class="culture-values space-y-3 sm:space-y-4">
                            <div class="culture-value flex items-center opacity-0" data-value="1">
                                <span class="text-xl sm:text-2xl mr-3 sm:mr-4">🚀</span>
                                <span class="text-base sm:text-lg">Innovation over convention</span>
                            </div>
                            <div class="culture-value flex items-center opacity-0" data-value="2">
                                <span class="text-xl sm:text-2xl mr-3 sm:mr-4">🤝</span>
                                <span class="text-base sm:text-lg">Collaboration over competition</span>
                            </div>
                            <div class="culture-value flex items-center opacity-0" data-value="3">
                                <span class="text-xl sm:text-2xl mr-3 sm:mr-4">💡</span>
                                <span class="text-base sm:text-lg">Creativity over conformity</span>
                            </div>
                            <div class="culture-value flex items-center opacity-0" data-value="4">
                                <span class="text-xl sm:text-2xl mr-3 sm:mr-4">🎯</span>
                                <span class="text-base sm:text-lg">Impact over activity</span>
                            </div>
                        </div>
                    </div>
                    <div class="culture-image opacity-0">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Team culture" class="rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500 w-full h-auto">
                            <div class="absolute -bottom-4 sm:-bottom-6 -right-4 sm:-right-6 w-16 sm:w-24 h-16 sm:h-24 bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl opacity-80"></div>
                            <div class="absolute -top-4 sm:-top-6 -left-4 sm:-left-6 w-12 sm:w-16 h-12 sm:h-16 bg-gradient-to-br from-cyan-400 to-pink-600 rounded-full opacity-60"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 sm:py-20 bg-gradient-to-r from-gray-900 to-black">
            <div class="container text-center">
                <h2 class="cta-title text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6 opacity-0">Ready to Join the Adventure?</h2>
                <p class="cta-text text-lg sm:text-xl text-gray-400 mb-6 sm:mb-8 max-w-2xl mx-auto opacity-0 px-4">
                    Don't see a perfect fit? We're always looking for exceptional talent.
                    Send us your portfolio and let's start a conversation.
                </p>
                <a href="mailto:careers@iplix.in" class="cta-button magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold hover:bg-gray-200 transition-colors opacity-0 text-sm sm:text-base">
                    Get in Touch
                </a>
            </div>
        </section>
    </div>
  
</body>


<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/careers.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>