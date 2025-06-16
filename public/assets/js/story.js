gsap.registerPlugin(ScrollTrigger);
document.addEventListener('DOMContentLoaded', function() {
    // CommonElements.init('story');
    initPageLoadAnimations();
    initOrbitalAnimation();
    initStoryAnimations();
    // initNavigation();
    initMobileMenu();
});

function initPageLoadAnimations() {
    // Page load fade in and zoom animation
    const tl = gsap.timeline();
    
    // Animate orbital system first
    tl.fromTo('#orbital-system', 
        { 
            opacity: 0, 
            scale: 0.5,
            rotation: -180
        },
        { 
            opacity: 1, 
            scale: 1,
            rotation: 0,
            duration: 1.5,
            ease: 'power3.out'
        }
    )
    // Then animate hero content
    .fromTo('.hero-title', 
        { opacity: 0, y: 100, scale: 0.8 },
        { opacity: 1, y: 0, scale: 1, duration: 1.2, ease: 'power3.out' },
        '-=0.8'
    )
    .fromTo('.hero-subtitle',
        { opacity: 0, y: 50, scale: 0.9 },
        { opacity: 1, y: 0, scale: 1, duration: 1, ease: 'power3.out' },
        '-=0.6'
    );
}

function initOrbitalAnimation() {
    // Wait for initial load animation to complete, then start orbital animation
    gsap.delayedCall(2, () => {
        // Create continuous orbital rotations
        const orbitAnimation1 = gsap.to("#planet-1", {
            rotation: 360,
            duration: 15,
            ease: "none",
            repeat: 2, // Rotate 3 times total
            transformOrigin: "-50px center"
        });

        const orbitAnimation2 = gsap.to("#planet-2", {
            rotation: 360,
            duration: 25,
            ease: "none",
            repeat: 2, // Rotate 3 times total
            transformOrigin: "-87.5px center"
        });

        const orbitAnimation3 = gsap.to("#planet-3", {
            rotation: 360,
            duration: 35,
            ease: "none",
            repeat: 2, // Rotate 3 times total
            transformOrigin: "-125px center"
        });

        // Add pulsing effect to the sun
        gsap.to(".sun", {
            scale: 1.3,
            duration: 2,
            ease: "power2.inOut",
            repeat: 6,
            yoyo: true
        });

        // Add floating animation to planets
        gsap.to(".planet-1", {
            y: "+=5",
            duration: 1.5,
            ease: "sine.inOut",
            repeat: 8,
            yoyo: true
        });

        gsap.to(".planet-2", {
            y: "+=4",
            duration: 2,
            ease: "sine.inOut",
            repeat: 6,
            yoyo: true
        });

        gsap.to(".planet-3", {
            y: "+=3",
            duration: 2.5,
            ease: "sine.inOut",
            repeat: 5,
            yoyo: true
        });

        // Orbit glow animation
        gsap.to(".orbit", {
            opacity: 0.8,
            duration: 3,
            ease: "power2.inOut",
            repeat: 4,
            yoyo: true,
            stagger: 0.3
        });

        // After all animations complete, fade out the orbital system
        gsap.delayedCall(45, () => {
            gsap.to('#orbital-system', {
                opacity: 0,
                scale: 0.3,
                rotation: 180,
                duration: 2,
                ease: 'power3.in'
            });
        });
    });
}

function initStoryAnimations() {
    // Story content animations
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
                toggleActions: 'play none none reverse'
            }
        }
    );

    gsap.fromTo('.story-image',
        { opacity: 0, x: 100, scale: 0.8 },
        {
            opacity: 1,
            x: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.story-image',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Section titles
    gsap.utils.toArray('.section-title').forEach(title => {
        gsap.fromTo(title,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
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

    // Timeline milestones with sequential animation
    gsap.utils.toArray('[data-milestone]').forEach((milestone, index) => {
        gsap.fromTo(milestone,
            { 
                opacity: 0, 
                y: 50, 
                scale: 0.9,
                rotationX: 45
            },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                rotationX: 0,
                duration: 1,
                ease: 'power3.out',
                delay: index * 0.2,
                scrollTrigger: {
                    trigger: milestone,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Stat cards with counter animation
    gsap.utils.toArray('[data-stat]').forEach((card, index) => {
        gsap.fromTo(card,
            { opacity: 0, y: 30, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
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
}

function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2;
    
    gsap.to({ value: 0 }, {
        value: target,
        duration: duration,
        ease: 'power2.out',
        onUpdate: function() {
            counter.textContent = Math.round(this.targets()[0].value) + '+';
        }
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

    if (mobileMenuBtn && mobileMenu) {
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
}
