






gsap.registerPlugin(ScrollTrigger);

// Services data - easily modifiable
const servicesData = [
    {
        id: 1,
        title: "Brand Strategy",
        description: "We help define your brand's core identity, positioning, and messaging strategy to create a strong foundation for all marketing efforts. Our comprehensive approach ensures your brand stands out in the competitive landscape.",
        icon: "🎯",
        image: "https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=600&h=400&fit=crop",
        features: ["Brand Positioning", "Messaging Framework", "Competitive Analysis", "Brand Guidelines"],
        isReversed: false
    },
    {
        id: 2,
        title: "Creative Campaigns",
        description: "From concept to execution, we create innovative campaigns that capture attention, spark conversations, and drive meaningful engagement across all channels. Every campaign is crafted to tell your unique story.",
        icon: "💡",
        image: "https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=400&fit=crop",
        features: ["Campaign Conceptualization", "Creative Direction", "Content Production", "Multi-channel Activation"],
        isReversed: true
    },
    {
        id: 3,
        title: "Social Media Marketing",
        description: "Building engaged communities and meaningful connections with your audience across all major social platforms. We create content that resonates and drives genuine interaction with your brand.",
        icon: "📱",
        image: "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600&h=400&fit=crop",
        features: ["Content Strategy", "Community Management", "Influencer Partnerships", "Social Advertising"],
        isReversed: false
    },
    {
        id: 4,
        title: "Digital Growth",
        description: "Accelerating your digital presence with data-driven strategies that deliver measurable results and sustainable growth. We focus on ROI and long-term success for your business.",
        icon: "🚀",
        image: "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&h=400&fit=crop",
        features: ["Performance Marketing", "SEO & SEM", "Conversion Optimization", "Analytics & Reporting"],
        isReversed: true
    },
    {
        id: 5,
        title: "Content Creation",
        description: "Crafting compelling stories and visual content that resonates with your audience and reinforces your brand message. From video to photography, we bring your vision to life.",
        icon: "✏️",
        image: "https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=600&h=400&fit=crop",
        features: ["Video Production", "Photography", "Copywriting", "Graphic Design"],
        isReversed: false
    },
    {
        id: 6,
        title: "Analytics & Insights",
        description: "Turning data into actionable insights that inform strategy and optimize performance across all touchpoints. We believe in making decisions based on solid data and measurable results.",
        icon: "📊",
        image: "https://images.unsplash.com/photo-1500673922987-e212871fec22?w=600&h=400&fit=crop",
        features: ["Data Analysis", "Performance Tracking", "Customer Insights", "ROI Measurement"],
        isReversed: true
    }
];

document.addEventListener('DOMContentLoaded', function() {
    generateServiceSections();
    initWhatWeDoAnimations();
    // initNavigation();
    //  CommonElements.init('services');
    initMobileMenu();
});

function generateServiceSections() {
    const container = document.getElementById('services-container');
    
    servicesData.forEach((service, index) => {
        const sectionHTML = `
            <section class="service-section py-20 ${index % 2 === 0 ? 'bg-gray-900' : 'bg-black'}" data-service="${service.id}">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center ${service.isReversed ? 'lg:grid-flow-col-dense' : ''}">
                        <!-- Content Section -->
                        <div class="service-content ${service.isReversed ? 'lg:col-start-2' : ''}" data-content="${service.id}">
                            <div class="text-6xl mb-6 service-icon" data-icon="${service.id}">${service.icon}</div>
                            <h2 class="text-4xl md:text-5xl font-bold mb-6 service-title" data-title="${service.id}">
                                ${service.title}
                            </h2>
                            <p class="text-xl text-gray-300 mb-8 service-description" data-description="${service.id}">
                                ${service.description}
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                ${service.features.map((feature, featureIndex) => `
                                    <div class="service-feature flex items-center text-gray-400" data-feature="${service.id}-${featureIndex}">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 flex-shrink-0"></div>
                                        <span>${feature}</span>
                                    </div>
                                `).join('')}
                            </div>
                            
                            <button class="service-cta bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105" data-cta="${service.id}">
                                Learn More
                            </button>
                        </div>
                        
                        <!-- Image Section -->
                        <div class="service-image-container ${service.isReversed ? 'lg:col-start-1' : ''}" data-image-container="${service.id}">
                            <div class="relative group">
                                <div class="service-image-wrapper overflow-hidden rounded-2xl shadow-2xl" data-image-wrapper="${service.id}">
                                    <img 
                                        src="${service.image}" 
                                        alt="${service.title}"
                                        class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110"
                                        data-image="${service.id}"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500/20 to-purple-600/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" data-glow="${service.id}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;
        
        container.innerHTML += sectionHTML;
    });
}

function initWhatWeDoAnimations() {
    // Hero animation
    const tl = gsap.timeline();
    tl.fromTo('.hero-title', 
        { opacity: 0, y: 100, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 1.5, ease: 'power3.out' }
    )
    .fromTo('.hero-subtitle',
        { opacity: 0, y: 50 },
        { opacity: 1, y: 0, duration: 1, ease: 'power3.out' },
        '-=0.8'
    );

    // Service sections animations
    servicesData.forEach((service) => {
        // Icon animation
        gsap.fromTo(`[data-icon="${service.id}"]`,
            { opacity: 0, scale: 0.5, rotation: -180 },
            {
                opacity: 1,
                scale: 1,
                rotation: 0,
                duration: 1,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Title animation
        gsap.fromTo(`[data-title="${service.id}"]`,
            { opacity: 0, x: service.isReversed ? 100 : -100 },
            {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: 'power3.out',
                delay: 0.2,
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Description animation
        gsap.fromTo(`[data-description="${service.id}"]`,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                delay: 0.4,
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Features animation
        service.features.forEach((feature, featureIndex) => {
            gsap.fromTo(`[data-feature="${service.id}-${featureIndex}"]`,
                { opacity: 0, x: -20 },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.6,
                    ease: 'power3.out',
                    delay: 0.6 + (featureIndex * 0.1),
                    scrollTrigger: {
                        trigger: `[data-service="${service.id}"]`,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    }
                }
            );
        });

        // CTA button animation
        gsap.fromTo(`[data-cta="${service.id}"]`,
            { opacity: 0, scale: 0.8 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.6,
                ease: 'back.out(1.7)',
                delay: 1,
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Image animations
        gsap.fromTo(`[data-image-wrapper="${service.id}"]`,
            { 
                opacity: 0, 
                x: service.isReversed ? -100 : 100,
                scale: 0.8,
                rotationY: service.isReversed ? -15 : 15
            },
            {
                opacity: 1,
                x: 0,
                scale: 1,
                rotationY: 0,
                duration: 1.2,
                ease: 'power3.out',
                delay: 0.3,
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Glow effect animation
        gsap.fromTo(`[data-glow="${service.id}"]`,
            { opacity: 0, scale: 0.8 },
            {
                opacity: 0.3,
                scale: 1,
                duration: 1.5,
                ease: 'power3.out',
                delay: 0.8,
                scrollTrigger: {
                    trigger: `[data-service="${service.id}"]`,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Process section animation
    const processTl = gsap.timeline({
        scrollTrigger: {
            trigger: '.section-title',
            start: 'top 85%',
            toggleActions: 'play none none reverse'
        }
    });

    processTl.fromTo('.section-title',
        { opacity: 0, y: 30, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 0.8, ease: 'power3.out' }
    );

    // Process steps
    gsap.utils.toArray('[data-step]').forEach((step, index) => {
        gsap.fromTo(step,
            { opacity: 0, y: 30, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.8,
                ease: 'power3.out',
                delay: index * 0.2,
                scrollTrigger: {
                    trigger: step,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Footer sections
    gsap.utils.toArray('[data-footer]').forEach((section, index) => {
        gsap.fromTo(section,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: section,
                    start: 'top 95%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });
}

function initNavigation() {
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            gsap.to(navbar, {
                backgroundColor: 'rgba(0, 0, 0, 0.9)',
                backdropFilter: 'blur(10px)',
                borderBottom: '1px solid rgba(255, 255, 255, 0.1)',
                duration: 0.3
            });
        } else {
            gsap.to(navbar, {
                backgroundColor: 'transparent',
                backdropFilter: 'none',
                borderBottom: 'none',
                duration: 0.3
            });
        }
    });
}

function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    let isMenuOpen = false;

    mobileMenuBtn.addEventListener('click', () => {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            mobileMenu.classList.remove('hidden');
            gsap.fromTo(mobileMenu, 
                { opacity: 0, y: -20 },
                { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' }
            );
            
            // Animate menu icon to X
            gsap.to(mobileMenuBtn.querySelector('svg'), {
                rotation: 180,
                duration: 0.3
            });
        } else {
            gsap.to(mobileMenu, {
                opacity: 0,
                y: -20,
                duration: 0.3,
                ease: 'power2.out',
                onComplete: () => {
                    mobileMenu.classList.add('hidden');
                }
            });
            
            // Animate menu icon back
            gsap.to(mobileMenuBtn.querySelector('svg'), {
                rotation: 0,
                duration: 0.3
            });
        }
    });
}
