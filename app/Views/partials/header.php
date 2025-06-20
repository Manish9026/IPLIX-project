<?php $uri = service('uri'); ?>
<nav id="navbar" class="fixed top-0 left-0 right-0 w-[100vw] z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <a href="./" class="text-2xl font-bold text-white logo">IPLIX</a>

            <div class="hidden md:flex space-x-8">
                <a href="<?= base_url('/') ?>"
                    class="nav-link <?= $uri->getSegment(1) === '' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    Home
                </a>

                <a href="<?= base_url('story') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'story' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    About
                </a>

                <a href="<?= base_url('services') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'services' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    Services
                </a>

                <a href="<?= base_url('work') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'work' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    Portfolio
                </a>

                <a href="<?= base_url('careers') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'careers' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    Careers
                </a>

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


            <a href="<?= base_url('/') ?>"
                class="block <?= $uri->getSegment(1) === '' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors"
                data-page="home">Home</a>

            <a href="<?= base_url('story') ?>"
                class="block <?= $uri->getSegment(1) === 'story' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors"
                data-page="story">About</a>

            <a href="<?= base_url('services') ?>"
                class="block <?= $uri->getSegment(1) === 'services' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors"
                data-page="services">Services</a>

            <a href="<?= base_url('work') ?>"
                class="block <?= $uri->getSegment(1) === 'work' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors"
                data-page="work">Portfolio</a>

            <a href="<?= base_url('careers') ?>"
                class="block <?= $uri->getSegment(1) === 'careers' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors"
                data-page="careers">Careers</a>

        </div>
    </div>
</nav>