gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    initCaseStudyAnimations();
    initMagneticButtons();
});

function initCaseStudyAnimations() {
    // Hero section animations
    const heroTl = gsap.timeline();
    
    heroTl.fromTo('.category', 
        { opacity: 0, y: 30 },
        { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }
    )
    .fromTo('.hero-title', 
        { opacity: 0, y: 50, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 1.2, ease: 'power3.out' },
        '-=0.6'
    )
    .fromTo('.hero-subtitle',
        { opacity: 0, y: 30 },
        { opacity: 1, y: 0, duration: 1, ease: 'power3.out' },
        '-=0.8'
    )
    .fromTo('.project-details',
        { opacity: 0, y: 20 },
        { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' },
        '-=0.6'
    );

    gsap.fromTo('.story-content',
        { opacity: 0, x: -100, rotationY: 20 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            duration: 1.5,
            ease: 'power3.out'
        }
    );

    gsap.fromTo('.story-image',
        { opacity: 0, x: 100, scale: 0.8, rotationY: -20 },
        {
            opacity: 1,
            x: 0,
            scale: 1,
            rotationY: 0,
            duration: 1.5,
            ease: 'power3.out'
        },
        '-=1.2'
    );

    // Section titles
    gsap.utils.toArray('.section-title').forEach(title => {
        gsap.fromTo(title,
            { opacity: 0, y: 50, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: title,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Challenge section
    gsap.fromTo('.challenge-text',
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.challenge-text',
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Strategy section
    gsap.fromTo('.strategy-text',
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.strategy-text',
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    gsap.utils.toArray('[data-strategy]').forEach((image, index) => {
        gsap.fromTo(image,
            { opacity: 0, y: 50, rotationX: 30, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                rotationX: 0,
                scale: 1,
                duration: 1,
                ease: 'power3.out',
                delay: index * 0.2,
                scrollTrigger: {
                    trigger: image,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Metrics with counter animation
    gsap.utils.toArray('[data-metric]').forEach((card, index) => {
        gsap.fromTo(card,
            { opacity: 0, y: 30, scale: 0.9, rotationY: 15 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                rotationY: 0,
                duration: 0.8,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse',
                    onEnter: () => animateCounter(card.querySelector('.counter'))
                }
            }
        );
    });

    // Impact section
    gsap.fromTo('.impact-content',
        { opacity: 0, x: -100, rotationY: 20 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.impact-content',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    gsap.fromTo('.impact-image',
        { opacity: 0, x: 100, scale: 0.8 },
        {
            opacity: 1,
            x: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.impact-image',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Impact list items
    gsap.utils.toArray('[data-impact]').forEach((item, index) => {
        gsap.fromTo(item,
            { opacity: 0, x: -30 },
            {
                opacity: 1,
                x: 0,
                duration: 0.6,
                ease: 'power3.out',
                delay: 0.5 + (index * 0.1),
                scrollTrigger: {
                    trigger: '.impact-content',
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

function animateCounter(counter) {
    const target = parseFloat(counter.getAttribute('data-target'));
    const duration = 2;
    
    gsap.to({ value: 0 }, {
        value: target,
        duration: duration,
        ease: 'power2.out',
        onUpdate: function() {
            const currentValue = this.targets()[0].value;
            if (target >= 1000) {
                counter.textContent = (currentValue / 1000).toFixed(1);
            } else if (target >= 100) {
                counter.textContent = Math.round(currentValue);
            } else {
                counter.textContent = currentValue.toFixed(1);
            }
        }
    });
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
    });
}
