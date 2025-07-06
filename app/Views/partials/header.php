<?php

use App\Helpers\Utils;

$info = Utils::read("contact.json");
$uri = service('uri');
$company=$info['company'] ?? "";
$navLinks = $info['navLinks'] ?? [];

$currentSegment = $uri->getSegment(1);
if ($currentSegment !== 'contact') {
    $navLinks = array_filter($navLinks, fn($item) => $item['slug'] !== 'careers');
}
?>
<nav id="navbar" class="fixed top-0 left-0 right-0 w-[100vw] z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">

  
            <a href="./" class="text-2xl flex items-center font-bold text-white logo">
                <span class="aspect-[4/1] w-20 h-10 relative">
  <img src="<?=base_url($company['logo']) ?>" alt="Logo" class="w-full h-full object-contain absolute" />
</span>
            
            <?=esc($company['name']) ?>
        
        
        </a>

            <!-- <div class="hidden md:flex space-x-8">

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
                <a href="<?= base_url('contact') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'contact' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors capitalize duration-300">
                    contact us
                </a>

                <a href="<?= base_url('careers') ?>"
                    class="nav-link <?= $uri->getSegment(1) === 'careers' ? 'text-white' : 'text-white/80' ?> hover:text-white transition-colors duration-300">
                    Careers
                </a>

            </div> -->



            <?php if (!empty($navLinks) && is_array($navLinks) && count($navLinks) > 0) : ?>
                <div class="hidden md:flex space-x-8">
                    <?php foreach ($navLinks as $nav): ?>

                        <?php


                        // Handle default active for home
                        $isActive = ($currentSegment === $nav['slug']) || ($nav['slug'] === '' && $currentSegment === '');
                        $linkClass = $isActive ? 'text-white active-link' : 'text-white/80';
                        ?>

                        <a href="<?= base_url($nav['link']) ?>"
                            class=" <?= $linkClass ?>  nav-link hover:text-white transition-colors duration-300 capitalize">
                            <?= esc($nav['name']) ?>
                        </a>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



            <button id="mobile-menu-btn" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    <?php if (!empty($navLinks) && is_array($navLinks) && count($navLinks) > 0) : ?>
        <div id="mobile-menu" class="md:hidden bg-black/95 backdrop-blur-md border-t border-gray-800 hidden">
            <div class="px-4 py-6 space-y-4">
                <?php
                foreach ($navLinks as $link):
                    $isActive = ($currentSegment === $link['slug']) || ($link['slug'] === '' && $currentSegment === '');
                    $linkClass = $isActive ? 'text-white active-link' : 'text-white/80';
                ?>
                    <a href="<?= base_url($link['link']) ?>"
                        class="block <?= esc($linkClass) ?>  hover:text-white transition-colors"
                        data-page="<?= esc($link['slug']) ?>">
                        <?= esc($link['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</nav>