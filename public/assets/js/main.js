// GSAP Animations
gsap.registerPlugin(ScrollTrigger);

// Initialize animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // CommonElements.init('home');
    initAnimations();
    initMagneticButtons();
});

function initAnimations() {
    // Hero text animation with stagger
    const heroTimeline = gsap.timeline();
    
    // Split text into characters for individual animation
    const heroLines = document.querySelectorAll('.hero-line-1, .hero-line-2, .hero-line-3');
    heroLines.forEach(line => {
        const text = line.textContent;
        line.innerHTML = '';
    console.log(text);
    
        for (let i = 0; i < text.length; i++) {
            const char = document.createElement('span');
            char.textContent = text[i] === ' ' ? '\u00A0' : text[i];
            char.classList.add('char');
            line.appendChild(char);
        }
    });

    // Animate hero text
    heroTimeline
        .fromTo('.hero-line-1 .char', 
            { y: 100, opacity: 0, rotationX: 90 },
            { y: 0, opacity: 1, rotationX: 0, duration: 1.2, ease: 'power3.out', stagger: 0.05 }
        )
        .fromTo('.hero-line-2 .char',
            { y: 100, opacity: 0, rotationX: 90 },
            { y: 0, opacity: 1, rotationX: 0, duration: 1.2, ease: 'power3.out', stagger: 0.05 },
            '-=0.8'
        )
        .fromTo('.hero-line-3 .char',
            { y: 100, opacity: 0, rotationX: 90 },
            { y: 0, opacity: 1, rotationX: 0, duration: 1.2, ease: 'power3.out', stagger: 0.05 },
            '-=0.8'
        )
        .to('.hero-subtitle', 
            { opacity: 1, y: 0, duration: 1, ease: 'power3.out' },
            '-=0.5'
        )
        .to('.hero-cta',
            { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' },
            '-=0.3'
        );

    // Floating elements animation
    gsap.to('.floating', {
        y: -20,
        duration: 2,
        ease: 'power2.inOut',
        yoyo: true,
        repeat: -1,
        stagger: 0.5
    });

    // Section titles animation
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
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Service cards animation with morphing effect
    gsap.utils.toArray('[data-service]').forEach((card, index) => {
        gsap.fromTo(card,
            { 
                opacity: 0, 
                y: 60, 
                scale: 0.8,
                rotationY: 45,
                transformOrigin: 'center center'
            },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                rotationY: 0,
                duration: 1,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    end: 'bottom 15%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Hover animation for service cards
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                scale: 1.05,
                rotationY: 5,
                z: 50,
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

    // Work items with 3D flip animation
    gsap.utils.toArray('[data-work]').forEach((item, index) => {
        gsap.fromTo(item,
            { 
                opacity: 0, 
                y: 80, 
                rotationX: 45,
                scale: 0.9
            },
            {
                opacity: 1,
                y: 0,
                rotationX: 0,
                scale: 1,
                duration: 1.2,
                ease: 'power3.out',
                delay: index * 0.15,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    end: 'bottom 10%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Story section with parallax effect
    gsap.fromTo('.story-content',
        { opacity: 0, x: -100, rotationY: 20 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.story-content',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    gsap.fromTo('.story-image',
        { opacity: 0, x: 100, rotationY: -20, scale: 0.8 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.story-image',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Footer sections animation
    gsap.utils.toArray('[data-footer]').forEach((section, index) => {
        gsap.fromTo(section,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
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

    // Continuous background animation
    gsap.to('.gradient-text', {
        backgroundPosition: '200% center',
        duration: 4,
        ease: 'none',
        repeat: -1
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

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            gsap.to(window, {
                duration: 1.5,
                scrollTo: target,
                ease: 'power2.inOut'
            });
        }
    });
});

// Page transition animation
function pageTransition() {
    const tl = gsap.timeline();
    
    tl.to('.page-transition', {
        duration: 0.5,
        scaleY: 1,
        transformOrigin: 'bottom',
        ease: 'power4.inOut'
    })
    .to('.page-transition', {
        duration: 0.5,
        scaleY: 0,
        transformOrigin: 'top',
        ease: 'power4.inOut',
        delay: 0.1
    });
}

// Parallax scrolling effects
gsap.utils.toArray('.parallax-bg').forEach(bg => {
    gsap.to(bg, {
        yPercent: -50,
        ease: 'none',
        scrollTrigger: {
            trigger: bg,
            start: 'top bottom',
            end: 'bottom top',
            scrub: true
        }
    });
});

// Mouse follower effect
document.addEventListener('mousemove', (e) => {
    gsap.to('.mouse-follower', {
        x: e.clientX,
        y: e.clientY,
        duration: 0.3,
        ease: 'power2.out'
    });
});
