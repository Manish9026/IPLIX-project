gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    // CommonElements.init('careers');
    initCareersAnimations();
    initMagneticButtons();

});

function initCareersAnimations() {
    // Hero animations with stagger
    const heroTl = gsap.timeline();
    
    heroTl.fromTo('.hero-title', 
        { opacity: 0, y: 100, scale: 0.9, rotationX: 45 },
        { opacity: 1, y: 0, scale: 1, rotationX: 0, duration: 1.5, ease: 'power3.out' }
    )
    .fromTo('.hero-subtitle',
        { opacity: 0, y: 50 },
        { opacity: 1, y: 0, duration: 1, ease: 'power3.out' },
        '-=0.8'
    )
    .fromTo('.hero-cta',
        { opacity: 0, y: 30, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 0.8, ease: 'back.out(1.7)' },
        '-=0.5'
    );

    // Floating shapes continuous animation
    gsap.utils.toArray('.floating-shape').forEach((shape, index) => {
        gsap.to(shape, {
            y: -30,
            rotation: 360,
            duration: 4 + index,
            ease: 'power2.inOut',
            yoyo: true,
            repeat: -1,
            delay: index * 0.5
        });
    });

    // Section titles
    gsap.utils.toArray('.section-title').forEach(title => {
        gsap.fromTo(title,
            { opacity: 0, y: 50, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 1.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: title,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Perk cards with 3D effect
    gsap.utils.toArray('[data-perk]').forEach((card, index) => {
        gsap.fromTo(card,
            { 
                opacity: 0, 
                y: 60, 
                rotationY: 45,
                scale: 0.8
            },
            {
                opacity: 1,
                y: 0,
                rotationY: 0,
                scale: 1,
                duration: 1,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
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
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                scale: 1,
                rotationY: 0,
                z: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Position cards with slide-in effect
    gsap.utils.toArray('[data-position]').forEach((card, index) => {
        gsap.fromTo(card,
            { 
                opacity: 0, 
                x: index % 2 === 0 ? -100 : 100,
                scale: 0.9
            },
            {
                opacity: 1,
                x: 0,
                scale: 1,
                duration: 1,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Culture section
    gsap.fromTo('.culture-content',
        { opacity: 0, x: -100, rotationY: 20 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.culture-content',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    gsap.fromTo('.culture-image',
        { opacity: 0, x: 100, scale: 0.8 },
        {
            opacity: 1,
            x: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.culture-image',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Culture values with sequential reveal
    gsap.utils.toArray('[data-value]').forEach((value, index) => {
        gsap.fromTo(value,
            { opacity: 0, x: -50 },
            {
                opacity: 1,
                x: 0,
                duration: 0.6,
                ease: 'power3.out',
                delay: 0.8 + (index * 0.15),
                scrollTrigger: {
                    trigger: '.culture-content',
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // CTA section
    const ctaTl = gsap.timeline({
        scrollTrigger: {
            trigger: '.cta-title',
            start: 'top 85%',
            toggleActions: 'play none none reverse'
        }
    });

    ctaTl.fromTo('.cta-title',
        { opacity: 0, y: 30 },
        { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }
    )
    .fromTo('.cta-text',
        { opacity: 0, y: 20 },
        { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' },
        '-=0.4'
    )
    .fromTo('.cta-button',
        { opacity: 0, y: 20, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 0.6, ease: 'back.out(1.7)' },
        '-=0.3'
    );
}



function initMagneticButtons() {
    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mouseenter', (e) => {
            gsap.to(btn, {
                scale: 1.1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mouseleave', (e) => {
            gsap.to(btn, {
                scale: 1,
                x: 0,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            gsap.to(btn, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });}