gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    // Wait for dynamic content to be rendered first
    setTimeout(() => {
        initOurWorkAnimations();
        // initNavigation();
    // CommonElements.init('careers');

        initMobileMenu();
    }, 100);
});

function initOurWorkAnimations() {
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

    // Animate dynamically generated work cards
    animateWorkCards();

    // CTA section
    const ctaTl = gsap.timeline({
        scrollTrigger: {
            trigger: '.section-title',
            start: 'top 85%',
            toggleActions: 'play none none reverse'
        }
    });

    ctaTl.fromTo('.section-title',
        { opacity: 0, y: 30, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 0.8, ease: 'power3.out' }
    )
    .fromTo('.cta-button',
        { opacity: 0, y: 20, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 0.6, ease: 'back.out(1.7)' },
        '-=0.3'
    );

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

    // Animate category headers
    gsap.utils.toArray('.category-header').forEach((header, index) => {
        gsap.fromTo(header,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: header,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });
}

function animateWorkCards() {
    gsap.utils.toArray('[data-work]').forEach((card, index) => {
        gsap.fromTo(card,
            { 
                opacity: 0, 
                y: 80, 
                scale: 0.8,
                rotationY: 45
            },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                rotationY: 0,
                duration: 1.2,
                ease: 'power3.out',
                delay: index * 0.15,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Enhanced hover effect
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                scale: 1.05,
                rotationY: 10,
                z: 100,
                duration: 0.4,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                scale: 1,
                rotationY: 0,
                z: 0,
                duration: 0.4,
                ease: 'power2.out'
            });
        });
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
