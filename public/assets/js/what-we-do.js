
gsap.registerPlugin(ScrollTrigger);


document.addEventListener('DOMContentLoaded', function() {
    initWhatWeDoAnimations();
});


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

