


<?= $this->extend('layout') ?>
<?= $this->section('headScripts') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
 <style>
        /* Fix horizontal scroll issues and ensure full screen coverage */
        html, body {
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
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
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
        .container, .max-w-7xl {
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
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <h1 class="hero-title text-4xl md:text-8xl font-bold mb-6">
                <?= $heroContent['title'] ?>
                    <!-- <br /> -->
                    <span class="bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
                                        <?= $heroContent['gradient_text'] ?>

                    </span>
                </h1>
                <p class="hero-subtitle text-xl text-gray-400 max-w-3xl mx-auto">
                                  <?= $heroContent['description'] ?>

                </p>
            </div>
        </section>

        <!-- Dynamic Category Sections -->

<div id="categories-container">
    <div class="max-w-7xl pt-10 mx-auto px-4 sm:px-6 lg:px-8">
        <?php foreach ($projects as $category): ?>
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
                            <p class="text-gray-400 text-lg"><?= $category['description'] ?></p>
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
                <div class="swiper category-carousel" data-category="<?= $category['id'] ?>">
                    <div class="swiper-wrapper">
                        <?php foreach ($category['projects'] as $project): ?>
                            <div class="swiper-slide p-6 md:p-0">
                                <a href="<?= $project['link'] ?>" class="work-card block group"
                                   data-work="<?= $project['id'] ?>"
                                   data-category="<?= $category['name'] ?>">

                                    <!-- Image -->
                                    <div class="card-image aspect-video overflow-hidden relative">
                                        <img src="<?= $project['image'] ?>"
                                             alt="<?= $project['title'] ?>"
                                             class="w-full h-full object-cover transition-transform duration-500">
                                        <div class="card-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                            <div class="p-4 w-full">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-white font-medium">
                                                        <?= ($project['link'] === '#') ? 'View Project' : 'View Case Study' ?>
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
                <button class="cta-button bg-white text-black px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition-colors transform hover:scale-105">
                    Start Your Project
                </button>
            </div>
        </section>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // DYNAMIC DATA CONFIGURATION
        // Add new categories and projects here - no need to modify HTML/CSS
        const portfolioData = {
            categories: [
                {
                    id: 'technology',
                    name: 'Technology',
                    description: 'Digital innovation and tech solutions that drive the future',
                    icon: '💻',
                    projectCount: 12,
                    gradient: 'from-blue-400 to-cyan-400',
                    accentColor: 'blue-400',
                    tagColor: 'blue-300',
                    projects: [
                        {
                            id: 'tech-burner',
                            title: 'Tech Burner',
                            description: 'Transforming a tech reviewer into a digital icon with strategic brand development',
                            image: 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600',
                            tags: ['Brand Strategy', 'Content Marketing'],
                            link: './case-study'
                        },
                        {
                            id: 'ai-platform',
                            title: 'AI Platform Launch',
                            description: 'Building the next generation of AI-powered solutions for enterprises',
                            image: 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600',
                            tags: ['Product Launch', 'AI/ML'],
                            link: '#'
                        },
                        {
                            id: 'saas-platform',
                            title: 'SaaS Platform',
                            description: 'Scaling a B2B software solution to enterprise level with strategic growth',
                            image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600',
                            tags: ['B2B Marketing', 'Lead Generation'],
                            link: '#'
                        }
                    ]
                },
                {
                    id: 'fashion',
                    name: 'Fashion',
                    description: 'Style and lifestyle brands that define trends',
                    icon: '👗',
                    projectCount: 8,
                    gradient: 'from-purple-400 to-pink-400',
                    accentColor: 'purple-400',
                    tagColor: 'purple-300',
                    projects: [
                        {
                            id: 'lifestyle-brand',
                            title: 'Lifestyle Brand',
                            description: 'Building a sustainable fashion brand from the ground up with conscious values',
                            image: 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600',
                            tags: ['Brand Identity', 'E-commerce'],
                            link: '#'
                        },
                        {
                            id: 'luxury-fashion',
                            title: 'Luxury Accessories',
                            description: 'Elevating a premium accessories brand to global recognition and prestige',
                            image: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600',
                            tags: ['Luxury Branding', 'Global Expansion'],
                            link: '#'
                        }
                    ]
                },
                {
                    id: 'food-beverage',
                    name: 'Food & Beverage',
                    description: 'Culinary and restaurant brands that delight customers',
                    icon: '🍽️',
                    projectCount: 15,
                    gradient: 'from-orange-400 to-red-400',
                    accentColor: 'orange-400',
                    tagColor: 'orange-300',
                    projects: [
                        {
                            id: 'food-delivery',
                            title: 'Food Delivery App',
                            description: 'Launching a hyperlocal food delivery platform with seamless UX',
                            image: 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=600',
                            tags: ['Digital Marketing', 'App Marketing'],
                            link: '#'
                        },
                        {
                            id: 'restaurant-chain',
                            title: 'Restaurant Chain',
                            description: 'Scaling a local restaurant to nationwide franchise with brand consistency',
                            image: 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600',
                            tags: ['Franchise Marketing', 'Brand Expansion'],
                            link: '#'
                        },
                        {
                            id: 'craft-brewery',
                            title: 'Craft Brewery',
                            description: 'Building a premium craft beer brand from scratch with authentic storytelling',
                            image: 'https://images.unsplash.com/photo-1544148103-0773bf10d330?w=600',
                            tags: ['Premium Branding', 'Local Marketing'],
                            link: '#'
                        }
                    ]
                },
                {
                    id: 'health-wellness',
                    name: 'Health & Wellness',
                    description: 'Fitness and healthcare solutions that empower lives',
                    icon: '🏃‍♂️',
                    projectCount: 10,
                    gradient: 'from-green-400 to-emerald-400',
                    accentColor: 'green-400',
                    tagColor: 'green-300',
                    projects: [
                        {
                            id: 'fitness-app',
                            title: 'Fitness Revolution',
                            description: 'Creating a community-driven fitness platform for lasting impact',
                            image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600',
                            tags: ['Community Building', 'Content Strategy'],
                            link: '#'
                        },
                        {
                            id: 'wellness-products',
                            title: 'Wellness Products',
                            description: 'Launching a holistic wellness product line with care',
                            image: 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600',
                            tags: ['Product Launch', 'Wellness Marketing'],
                            link: '#'
                        }
                    ]
                },
                {
                    id: 'fintech',
                    name: 'Financial Technology',
                    description: 'FinTech and banking solutions that innovate finance',
                    icon: '💳',
                    projectCount: 6,
                    gradient: 'from-yellow-400 to-amber-400',
                    accentColor: 'yellow-400',
                    tagColor: 'yellow-300',
                    projects: [
                        {
                            id: 'fintech-startup',
                            title: 'FinTech Startup',
                            description: 'Positioning a fintech startup as the future of banking',
                            image: 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600',
                            tags: ['Brand Positioning', 'Thought Leadership'],
                            link: '#'
                        },
                        {
                            id: 'digital-banking',
                            title: 'Digital Banking',
                            description: 'Revolutionizing traditional banking with digital solutions',
                            image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600',
                            tags: ['Digital Transformation', 'User Experience'],
                            link: '#'
                        }
                    ]
                },
                {
                    id: 'sustainability',
                    name: 'Sustainability',
                    description: 'Eco-friendly and green initiatives that inspire change',
                    icon: '🌱',
                    projectCount: 9,
                    gradient: 'from-teal-400 to-green-500',
                    accentColor: 'teal-400',
                    tagColor: 'teal-300',
                    projects: [
                        {
                            id: 'eco-products',
                            title: 'Eco-Friendly Products',
                            description: 'Championing environmental consciousness through brand storytelling',
                            image: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600',
                            tags: ['Purpose Marketing', 'Sustainability'],
                            link: '#'
                        },
                        {
                            id: 'green-energy',
                            title: 'Green Energy Solutions',
                            description: 'Promoting renewable energy adoption through strategic campaigns',
                            image: 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600',
                            tags: ['Renewable Energy', 'Advocacy'],
                            link: '#'
                        }
                    ]
                }
            ]
        };

        // DYNAMIC RENDERING FUNCTIONS
        function renderCategories() {
            const container = document.getElementById('categories-container').querySelector('.max-w-7xl');
            
            portfolioData.categories.forEach(category => {
                const categorySection = createCategorySection(category);
                container.appendChild(categorySection);
            });
        }

        function createCategorySection(category) {
            const section = document.createElement('div');
            section.className = 'mb-20';
            
            section.innerHTML = `
                <div class="category-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-4xl">${category.icon}</span>
                                <h2 class="text-3xl font-bold bg-gradient-to-r ${category.gradient} bg-clip-text text-transparent">${category.name}</h2>
                            </div>
                            <p class="text-gray-400 text-lg">${category.description}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-${category.accentColor}">${category.projectCount}</div>
                            <div class="text-sm text-gray-400">Projects</div>
                        </div>
                    </div>
                </div>
                
                <div class="swiper category-carousel" data-category="${category.id}">
                    <div class="swiper-wrapper">
                        ${category.projects.map(project => createProjectCard(project, category)).join('')}
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            `;
            
            return section;
        }

        function createProjectCard(project, category) {
            return `
                <div class="swiper-slide">
                    <a href="${project.link}" class="work-card block group" data-work="${project.id}" data-category="${category.name}">
                        <div class="card-image aspect-video overflow-hidden relative">
                            <img src="${project.image}" alt="${project.title}" class="w-full h-full object-cover transition-transform duration-500">
                            <div class="card-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-4 w-full">
                                    <div class="flex justify-between items-center">
                                        <span class="text-white font-medium">${project.link === '#' ? 'View Project' : 'View Case Study'}</span>
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="category-tag text-xs font-semibold mb-3 px-3 py-1 rounded-full inline-block text-${category.tagColor}">${category.name}</div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-${category.accentColor} transition-colors">${project.title}</h3>
                            <p class="text-gray-400 mb-4 text-sm leading-relaxed">${project.description}</p>
                            <div class="flex flex-wrap gap-2">
                                ${project.tags.map(tag => `<span class="tag-pill px-3 py-1 text-xs rounded-full text-gray-300">${tag}</span>`).join('')}
                            </div>
                        </div>
                    </a>
                </div>
            `;
        }

        function initializeCarousels() {
            const carousels = document.querySelectorAll('.category-carousel');
            
            carousels.forEach(carousel => {
                new Swiper(carousel, {
                    slidesPerView: 1,
                    spaceBetween: 20,
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
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    }
                });
            });
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize common elements (navigation and footer)
            // CommonElements.init('work');
            
            // Initialize page-specific content
            // renderCategories();
            initializeCarousels();
        });
    </script>
</body>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/our-work.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>