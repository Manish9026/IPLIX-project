gsap.registerPlugin(ScrollTrigger);

function initAnimations() {
    // Footer entrance animation
    gsap.set(".footer-section", { y: 50, opacity: 0 });
    gsap.set("#social-section", { y: 30, opacity: 0 });
    gsap.set("#copyright", { y: 20, opacity: 0 });

    
    // Create timeline for footer animations
    const footerTl = gsap.timeline({
        scrollTrigger: {
            trigger: "footer",
            start: "top 80%",
            end: "bottom 20%",
            toggleActions: "play none none reverse"
        }
    });

    // Animate footer sections
    footerTl
        .to(".footer-section", {
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.2,
            ease: "power2.out"
        })
        .to("#social-section", {
            y: 0,
            opacity: 1,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.4")
        .to("#copyright", {
            y: 0,
            opacity: 1,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.2");

    // Water flow animation
    gsap.timeline({ repeat: -1 })
        .to(".water-flow::before", {
            clipPath: "polygon(0 0, 100% 0, 100% 70%, 90% 85%, 75% 75%, 55% 90%, 35% 80%, 20% 95%, 0 80%)",
            duration: 3,
            ease: "power2.inOut"
        })
        .to(".water-flow::before", {
            clipPath: "polygon(0 0, 100% 0, 100% 60%, 85% 80%, 70% 70%, 50% 85%, 30% 75%, 15% 90%, 0 75%)",
            duration: 3,
            ease: "power2.inOut"
        });

    // Social icons hover animation
    const socialIcons = document.querySelectorAll('.social-icon');
    socialIcons.forEach(icon => {
        icon.addEventListener('mouseenter', () => {
            gsap.to(icon, {
                rotation: 360,
                duration: 0.6,
                ease: "power2.out"
            });
        });
    });

    // Newsletter form animation
    const newsletterInput = document.querySelector('input[type="email"]');
    const newsletterBtn = document.querySelector('button');
    
    newsletterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (newsletterInput.value) {
            gsap.to(newsletterBtn, {
                scale: 0.95,
                duration: 0.1,
                yoyo: true,
                repeat: 1,
                onComplete: () => {
                    // Simulate success
                    newsletterInput.value = '';
                    newsletterInput.placeholder = 'Thanks for subscribing!';
                    setTimeout(() => {
                        newsletterInput.placeholder = 'Enter your email';
                    }, 3000);
                }
            });
        }
    });

    // Floating animation for company logo
    gsap.to(".fas.fa-code", {
        y: -10,
        duration: 2,
        ease: "power2.inOut",
        yoyo: true,
        repeat: -1
    });

    // Parallax effect for background elements
    gsap.to(".absolute.top-10", {
        y: -50,
        duration: 10,
        ease: "none",
        repeat: -1,
        yoyo: true
    });

    gsap.to(".absolute.top-32", {
        x: -30,
        duration: 8,
        ease: "none",
        repeat: -1,
        yoyo: true
    });

    // Water flow layer animation
    gsap.to(".water-layer-1", {
        y: 5,
        duration: 4,
        ease: "sine.inOut",
        repeat: -1,
        yoyo: true
    });

    gsap.to(".water-layer-2", {
        y: -3,
        duration: 6,
        ease: "sine.inOut",
        repeat: -1,
        yoyo: true
    });
}

// Common navigation functionality
function initCommonNavigation() {
    const navbar = document.getElementById('navbar');

    // Navbar scroll effect
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

    // Mobile menu functionality
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    let isMenuOpen = false;

    mobileMenuBtn?.addEventListener('click', () => {
        isMenuOpen = !isMenuOpen;
        
        console.log(isMenuOpen);
        
        if (isMenuOpen) {
            mobileMenu.classList.remove('hidden');
            // mobileMenu.classList.add('flex');

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


// Export for use in other files
window.CommonElements = {
    initCommonNavigation
};

document.addEventListener('DOMContentLoaded', function() {

    initMagneticButtons();
    initAnimations()
    lucide.createIcons({
        attrs: {
    class: 'w-8 h-8 '
  }
    });
});