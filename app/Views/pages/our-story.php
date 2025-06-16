<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story - IPLIX</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

</head>

</html>


<?= $this->extend('layout') ?>


<?= $this->section('styles') ?>
    
    <style>
        /* Fix horizontal scroll issues and ensure full screen coverage */
        html, body {
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
        
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #06b6d4);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 4s ease infinite;
        }
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
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
        .orbit-1 { width: 100px; height: 100px; }
        .orbit-2 { width: 175px; height: 175px; }
        .orbit-3 { width: 250px; height: 250px; }
        
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
            .orbit-1 { width: 70px; height: 70px; }
            .orbit-2 { width: 120px; height: 120px; }
            .orbit-3 { width: 170px; height: 170px; }
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
            
            <div class="relative z-10 container text-center">
                <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-bold mb-6 opacity-0">
                    We're here to build
                    <br />
                    <span class="gradient-text">icons</span>
                </h1>
                <p class="hero-subtitle text-base sm:text-lg md:text-xl text-gray-400 max-w-3xl mx-auto opacity-0 px-4">
                    Our journey began with a simple belief: every brand has the potential to become iconic. 
                    Through strategic thinking, creative excellence, and relentless execution, we transform 
                    ordinary businesses into extraordinary brands.
                </p>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="py-20 bg-gray-900">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="story-content opacity-0">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6">Our Mission</h2>
                        <p class="text-base sm:text-lg text-gray-400 mb-6">
                            We exist to elevate brands beyond the ordinary. In a world saturated with noise, 
                            we create clarity. In markets filled with followers, we build leaders.
                        </p>
                        <p class="text-base sm:text-lg text-gray-400">
                            Our approach combines data-driven insights with creative intuition, ensuring 
                            every campaign not only looks amazing but delivers measurable results.
                        </p>
                    </div>
                    <div class="story-image opacity-0">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Team collaboration" class="rounded-lg shadow-2xl w-full h-auto">
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
                    <div id="desktop-timeline-cards">
                      <!-- Desktop timeline cards will be rendered by JS -->
                    </div>
                </div>

                <!-- Mobile Timeline -->
                <div class="md:hidden relative px-2 overflow-hidden">
                    <!-- Vertical line fixed for all widths -->
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-blue-400 to-purple-600 z-0"></div>
                    <div id="mobile-timeline"></div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-gradient-to-r from-gray-900 to-black">
            <div class="container">
                <h2 class="section-title text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-16 opacity-0">By the Numbers</h2>
                
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-black/50 rounded-lg border border-gray-800 opacity-0" data-stat="1">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4">👥</div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="50">0</div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base">Team Members</div>
                    </div>
                    
                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-black/50 rounded-lg border border-gray-800 opacity-0" data-stat="2">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4">🏆</div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="200">0</div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base">Projects Completed</div>
                    </div>
                    
                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-black/50 rounded-lg border border-gray-800 opacity-0" data-stat="3">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4">🌍</div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="15">0</div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base">Countries Served</div>
                    </div>
                    
                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-black/50 rounded-lg border border-gray-800 opacity-0" data-stat="4">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4">⏰</div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="6">0</div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base">Years of Excellence</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer will be rendered by common.js -->

    <!-- Common Elements -->


</body>

<?= $this->section('scripts') ?>
    <script>
        // Timeline data (single source of truth)
        const timelineMilestones = [
            {
                year: '2018',
                color: 'blue-400',
                title: 'The Beginning',
                description: 'Founded with a vision to revolutionize digital marketing'
            },
            {
                year: '2019',
                color: 'purple-400',
                title: 'First Major Client',
                description: 'Landed our first Fortune 500 client and grew the team'
            },
            {
                year: '2021',
                color: 'cyan-400',
                title: 'Global Expansion',
                description: 'Opened offices in London and Singapore'
            },
            {
                year: '2023',
                color: 'pink-400',
                title: 'Award Recognition',
                description: 'Won Digital Agency of the Year award'
            }
        ];

        // Render desktop timeline (ensures visibility on md+ screens)
        function renderDesktopTimeline() {
            const container = document.getElementById('desktop-timeline-cards');
            if (!container) return;
            container.innerHTML = '';
            timelineMilestones.forEach((milestone, idx) => {
                const left = idx % 2 === 0;
                const flexRow = document.createElement('div');
                flexRow.className = 'timeline-milestone flex items-center' + (left ? '' : ' flex-row-revers');
                flexRow.setAttribute('data-milestone', idx + 1);

                // Milestone card
                const cardWrap = document.createElement('div');
                cardWrap.className = 
                  'w-1/2 flex ' +
                  (left ? 'justify-end pr-8' : 'justify-start pl-8');
                const cardColor = milestone.color;
                const cardGradient = `hover:border-${cardColor} hover:shadow-${cardColor}/20`;
                cardWrap.innerHTML = `
                    <div class="bg-gray-900 p-6 rounded-lg border border-gray-800 transition-all duration-300 hover:shadow-lg text-${left ? 'right' : 'left'} max-w-lg w-full
                        ${cardGradient}">
                        <div class="text-${milestone.color} text-2xl font-bold mb-2">${milestone.year}</div>
                        <h3 class="text-xl font-semibold mb-2">${milestone.title}</h3>
                        <p class="text-gray-400">${milestone.description}</p>
                    </div>
                `;

                // Dot & line
                const dotLineWrap = document.createElement('div');
                dotLineWrap.className = 'flex flex-col items-center w-12 relative';
                dotLineWrap.innerHTML = `
                    <div class="timeline-dot w-5 h-5 bg-${milestone.color} rounded-full border-4 border-black z-10"></div>
                    ${
                        idx < timelineMilestones.length - 1
                          ? `<div class="h-full w-1 bg-gradient-to-b from-${milestone.color} to-gray-900"></div>`
                          : ''
                    }
                `;

                const emptyHalf = document.createElement('div');
                emptyHalf.className = 'w-1/2';

                if (left) {
                    flexRow.append(cardWrap, dotLineWrap, emptyHalf);
                } else {
                    flexRow.append(emptyHalf, dotLineWrap, cardWrap);
                }
                container.appendChild(flexRow);
            });
        }

        // Render mobile timeline (always from same timelineMilestones)
        function renderMobileTimeline() {
            const container = document.getElementById('mobile-timeline');
            if (!container) return;
            container.innerHTML = '';
            timelineMilestones.forEach((milestone,idx) => {
                const dotClass = `bg-${milestone.color}`;
                const yearClass = `text-${milestone.color}`;
                const card = document.createElement('div');
                card.className = "relative flex items-start mb-14 last:mb-0";
                card.setAttribute('data-milestone', idx + 1);
                card.innerHTML = `
                    <!-- Dot -->
                    <div class="absolute left-[1.1rem] top-6 w-4 h-4 ${dotClass} rounded-full border-2 border-black z-10"></div>
                    <!-- Card offset right from dot -->
                    <div class="ml-12 w-full mobile-timeline-card">
                        <div class="bg-gray-900 p-4 rounded-lg border border-gray-800 shadow-lg">
                            <div class="${yearClass} text-lg font-bold mb-1">${milestone.year}</div>
                            <h3 class="text-base font-semibold mb-1">${milestone.title}</h3>
                            <p class="text-gray-400 text-xs leading-relaxed">${milestone.description}</p>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        // On DOMContentLoaded, always render both timelines
        document.addEventListener('DOMContentLoaded', function() {
            renderMobileTimeline();
            renderDesktopTimeline();
        });
    </script>

<script src="<?= base_url('assets/js/story.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>