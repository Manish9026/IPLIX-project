gsap.registerPlugin(ScrollTrigger);
document.addEventListener('DOMContentLoaded', function() {
    initPageLoadAnimations();
    initOrbitalAnimation();
    initStoryAnimations();
    initTeamAnimations();
    initGalleryAnimations();

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

function initTeamAnimations() {
    // Team section title animation
    gsap.fromTo('.section-title',
        { opacity: 0, y: 50 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.section-title',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Team subtitle animation
    gsap.fromTo('.team-subtitle',
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.team-subtitle',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Team cards hover animations
    gsap.utils.toArray('.team-card').forEach((card, index) => {
        // Initial animation when scrolling into view
        gsap.fromTo(card,
            { opacity: 0, y: 50, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.6,
                delay: index * 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Hover animations
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -10,
                scale: 1.05,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                scale: 1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Pause auto-scroll on hover
    const teamTrack = document.getElementById('team-track');
    if (teamTrack) {
        teamTrack.addEventListener('mouseenter', () => {
            teamTrack.style.animationPlayState = 'paused';
        });

        teamTrack.addEventListener('mouseleave', () => {
            teamTrack.style.animationPlayState = 'running';
        });
    }
}


function initGalleryAnimations() {
    // Gallery section title animation
    gsap.fromTo('.gallery-subtitle',
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.gallery-subtitle',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Gallery items staggered animation (initial 6 items)
    gsap.utils.toArray('.gallery-item').forEach((item, index) => {

        console.log(item, index); // Debugging line to check items
        
        gsap.fromTo(item,
            { 
                opacity: 0, 
                y: 10, 
                x: (index % 2 === 0 ? -10 : 10), // Alternate horizontal position
                // scale: 0.8,
                // rotationY: 45
            },
            {
                opacity: 1,
                y: 0,
                x: 0,
                scale: 1,
                rotationY: 0,
                duration: 0.8,
                delay: index * 0.1,
                ease: 'power3.easeInOut',
                scrollTrigger: {
                    trigger: item,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Enhanced hover animation
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                y: -8,
                scale: 1.05,
                rotationY: 5,
                duration: 0.4,
                ease: 'power2.out'
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                y: 0,
                scale: 1,
                rotationY: 0,
                duration: 0.4,
                ease: 'power2.out'
            });
        });

        // Click animation
        item.addEventListener('click', () => {
            gsap.to(item, {
                scale: 0.95,
                duration: 0.1,
                ease: 'power2.out',
                yoyo: true,
                repeat: 1
            });
        });
    });

    // View More/Less button functionality


    // Intersection Observer for performance optimization
    const galleryObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                // Add subtle floating animation for in-view items
                gsap.to(entry.target, {
                    y: "+=2",
                    duration: 3 + Math.random() * 2,
                    ease: "sine.inOut",
                    repeat: -1,
                    yoyo: true,
                    delay: Math.random() * 2
                });
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.gallery-item').forEach(item => {
        galleryObserver.observe(item);
    });

    // Enhanced responsive behavior
    const updateGalleryLayout = () => {
        const galleryGrid = document.getElementById('gallery-grid');
        const screenWidth = window.innerWidth;
        
        if (screenWidth < 480) {
            galleryGrid.style.gridTemplateColumns = '1fr';
        } else if (screenWidth < 768) {
            galleryGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
        } else if (screenWidth < 1024) {
            galleryGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
        } else {
            galleryGrid.style.gridTemplateColumns = 'repeat(3, 1fr)';
        }
    };

    // Initial layout update
    updateGalleryLayout();

    // Update layout on window resize
    window.addEventListener('resize', updateGalleryLayout);
}
