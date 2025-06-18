gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    // Wait for dynamic content to be rendered first
    setTimeout(() => {
        initOurWorkAnimations();
        animateWorkCards();
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

