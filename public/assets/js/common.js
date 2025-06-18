
// Common elements for all pages
const COMMON_ELEMENTS = {
    navigation: `
        <nav id="navbar" class="fixed top-0 left-0 right-0 w-[100vw] z-50 transition-all duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <a href="index.html" class="text-2xl font-bold text-white logo">IPLIX</a>
                    
                    <div class="hidden md:flex space-x-8">
                        <a href="/" class="nav-link text-white/80 hover:text-white transition-colors duration-300" data-page="home">Home</a>
                        <a href="./story" class="nav-link text-white/80 hover:text-white transition-colors duration-300" data-page="story">Our Story</a>
                        <a href="./services" class="nav-link text-white/80 hover:text-white transition-colors duration-300" data-page="services">What We Do</a>
                        <a href="./work" class="nav-link text-white/80 hover:text-white transition-colors duration-300" data-page="work">Our Work</a>
                        <a href="./careers" class="nav-link text-white/80 hover:text-white transition-colors duration-300" data-page="careers">Careers</a>
                    </div>

                    <button id="mobile-menu-btn" class="md:hidden text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div id="mobile-menu" class="md:hidden bg-black/95 backdrop-blur-md border-t border-gray-800 hidden">
                <div class="px-4 py-6 space-y-4">
                    <a href="./" class="block text-white/80 hover:text-white transition-colors" data-page="home">Home</a>
                    <a href="./story" class="block text-white/80 hover:text-white transition-colors" data-page="story">Our Story</a>
                    <a href="./services" class="block text-white/80 hover:text-white transition-colors" data-page="services">What We Do</a>
                    <a href="./work" class="block text-white/80 hover:text-white transition-colors" data-page="work">Our Work</a>
                    <a href="./careers" class="block text-white/80 hover:text-white transition-colors" data-page="careers">Careers</a>
                </div>
            </div>
        </nav>
    `,
    
    footer: `
        <footer class="py-12 w-[100vw]  bg-gray-900 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="footer-section" data-footer="1">
                        <h3 class="text-2xl font-bold mb-4">IPLIX</h3>
                        <p class="text-gray-400 mb-4">Building digital icons through strategic creativity.</p>
                    </div>
                    
                    <div class="footer-section" data-footer="2">
                        <h4 class="font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="our-story.html" class="hover:text-white transition-colors">Our Story</a></li>
                            <li><a href="what-we-do.html" class="hover:text-white transition-colors">What We Do</a></li>
                            <li><a href="careers.html" class="hover:text-white transition-colors">Careers</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section" data-footer="3">
                        <h4 class="font-semibold mb-4">Work</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="our-work.html" class="hover:text-white transition-colors">Our Work</a></li>
                            <li><a href="case-study.html" class="hover:text-white transition-colors">Case Studies</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section" data-footer="4">
                        <h4 class="font-semibold mb-4">Connect</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors">hello@iplix.in</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">+91 98765 43210</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8 mt-8 text-center text-gray-400">
                    <p>&copy; 2024 IPLIX. All rights reserved.</p>
                </div>
            </div>
        </footer>
    `
};

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

// Function to set active navigation link
function setActiveNavLink(currentPage) {
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        link.classList.add('text-white/80');
    });

    // Add active class to current page link
    document.querySelectorAll(`[data-page="${currentPage}"]`).forEach(link => {
        link.classList.add('active');
        link.classList.remove('text-white/80');
        link.classList.add('text-white');
    });
}

// Function to render navigation
function renderNavigation(currentPage = '') {
    // const navContainer = document.querySelector('body');
    // navContainer.insertAdjacentHTML('afterbegin', COMMON_ELEMENTS.navigation);
    
    // // Set active link after rendering
    // if (currentPage) {
    //     setActiveNavLink(currentPage);
    // }
    
    // Initialize navigation functionality
    initCommonNavigation();
}

// Function to render footer
function renderFooter() {
    const footerContainer = document.querySelector('body');
    footerContainer.insertAdjacentHTML('beforeend', COMMON_ELEMENTS.footer);
}

// Function to initialize common elements
function initCommonElements(currentPage = '') {
    renderNavigation(currentPage);
    renderFooter();
}

// Export for use in other files
window.CommonElements = {
    init: initCommonElements,
    renderNavigation,
    renderFooter,
    setActiveNavLink,
    initCommonNavigation
};

