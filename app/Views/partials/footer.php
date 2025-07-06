<!-- 
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
                            <li><a href="./story" class="hover:text-white transition-colors">About</a></li>
                            <li><a href="./services" class="hover:text-white transition-colors">Services</a></li>
                            <li><a href="./careers" class="hover:text-white transition-colors">Careers</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section" data-footer="3">
                        <h4 class="font-semibold mb-4">Work</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="./work" class="hover:text-white transition-colors">Portfolio</a></li>
                            <li><a href="./case-study" class="hover:text-white transition-colors">Case Studies</a></li>
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
                    <p>&copy; <?= date('Y') ?> IPLIX. All rights reserved.</p>
                </div>
            </div>
        </footer>
     -->



<?php

use App\Helpers\Utils;

$info = Utils::read("contact.json");
$serviceData = Utils::read("services.json");
$services = !empty($serviceData) ? $serviceData['services'] : [];
$contact = $info['contact'] ?? [];
$social = $info["social"] ?? [];
$company = $info["company"] ??[];
$navLinks = $info['navLinks'] ?? [];

?>

<footer class="bg-slate-900 max-w-[1400px] w-full rounded-[500px] md:mx-auto lg:my-10">


    <!-- Background Animation Elements -->

    <div class="gradient-bg w-full border-[1px] border-purple-400  text-white relative overflow-hidden lg:rounded-[50px] rounded-t-[50px]" style="padding-top: 0px;">

        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-20 h-20 bg-slate-600  rounded-full animate-pulse"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-slate-600 backdrop-blur-sm rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white rounded-full animate-ping"></div>
            <div class="absolute bottom-32 right-1/3 w-8 h-8 bg-white rounded-full animate-pulse"></div>
        </div>

        <div class="container mx-auto px-6 py-16 relative z-10">

            <!-- headers -->
            <div class="flex flex-col gap-2 items-center justify-center px-6 pb-20">
                <h2 class="text-4xl font-bold text-center text-gradient-animated ">Elevate Your Content with Orgix </h2>
                <h5 class="text-lg">Create. Connect. Convert.</h5>

                <a href=<?= base_url('/contact') ?> class="px-8 py-2 mt-8 h-14 text-white rounded-2xl font-semibold 
                 bg-gradient-to-r from-violet-500 via-fuchsia-500 to-purple-500 
                 animated-gradient flex items-center shadow-lg">
                    Let Connect
                </a>

            </div>
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12" id="footer-content">

                <!-- Company Info -->
                <div class="footer-section">
                    <div class="flex items-center mb-6">
                        <div class="size-[50px] bg-white rounded-lg flex items-center justify-center mr-3 overflow-hidden">
                            <?php if (!empty($company['logo'])) : ?>
                                <img src="<?= base_url($company['logo']) ?>" alt="" class="w-full h-full object-fill">
                            <?php else : ?>
                                <i class="fas fa-code text-blue-600 text-xl"></i>
                            <?php endif; ?>

                        </div>
                        <h3 class="text-2xl font-bold"><?= esc($company['name']) ?? "company name" ?></h3>
                    </div>
                    <p class="text-gray-200 mb-4 leading-relaxed">
                        <?= esc($company['description']) ?? "Leading the digital transformation with innovative solutions and cutting-edge technology" ?>
                        .
                    </p>
                    <div class="flex items-center text-gray-200">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span><?= esc($company['address']) ?? "123 Tech Street, Innovation City, TC 12345" ?> </span>
                    </div>
                </div>

                <!-- Quick Links -->

                <?php if (!empty($navLinks) && is_array($navLinks) && count($navLinks) > 0): ?>

                    <div class="footer-section">
                        <h4 class="text-xl font-semibold mb-6 flex items-center">
                            <i class="fas fa-link mr-2"></i>
                            Quick Links
                        </h4>
                        <ul class="space-y-3">

                            <?php
                            foreach ($navLinks as $nav): ?>
                                <li><a href="<?= esc($nav['link']) ?>" class="footer-link nav-link text-gray-200 hover:text-white"><?= esc($nav['name']) ?></a></li>
                            <?php endforeach; ?>


                        </ul>
                    </div>

                <?php endif; ?>

                <!-- Services -->

                <?php if (!empty($services) && is_array($services) && count($services) > 0): ?>
                    <div class="footer-section">
                        <h4 class="text-xl font-semibold mb-6 flex items-center">
                            <i class="fas fa-cogs mr-2"></i>
                            Services
                        </h4>
                        <ul class="space-y-3">

                            <?php

                            $finalServices = Utils::getRandomList($services, 10, "title");
                            foreach ($finalServices as $service): ?>
                                <li><a href="#" class="footer-link nav-link text-gray-200 hover:text-white"><?= esc($service['title']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Contact & Newsletter -->
                <div class="footer-section">
                    <h4 class="text-xl font-semibold mb-6 flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Stay Connected
                    </h4>


                    <?php if (!empty($contact) && is_array($contact) && count($contact) > 0) : ?>
                        <div class="space-y-4">

                            <?php foreach ($contact as $item): ?>
                                <div class="flex items-center text-gray-200">
                                    <i data-luicde="<?= esc($item['icon'] ?? "") ?>" class="<?= esc($item['icon'] ?? "fas fa-phone") ?>  mr-3"></i>
                                    <span><?= esc($item['value'] ?? "") ?></span>
                                </div>
                            <?php endforeach; ?>



                        </div>
                    <?php else : ?>
                        <h3 class="flex-1 flex p-4">No contacts!</h3>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Social Media Links -->
            <div class="border-t border-white border-opacity-20 pt-8" id="social-section">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <h5 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="wave mr-2">👋</span>
                            Follow Us
                        </h5>

                        <?php if (isset($social) && count($social) > 0 && is_array($social)): ?>


                            <div class="flex space-x-4">
                                <?php foreach ($social as $item): ?>
                                    <a href="<?= esc($item['link']) ?>" class="social-icon w-12 h-12 bg-<?= esc($item['color']) ?? "blue" ?>-600 bg-[<?= esc($item['color']) ?? "#3b5998" ?>]
                                
                               hover:opacity-80 transition-colors duration-300
                                 rounded-full flex items-center justify-center hover:scale-110">
                                        <i data-luicde="<?= esc($item['icons']) ?>" class=" <?= esc($item['icons'] ?? "fab fa-facebook-f") ?>  text-xl"></i>
                                    </a>
                                <?php endforeach; ?>

                            </div>

                        <?php endif; ?>

                    </div>

                    <!-- Awards/Certifications -->
                    <div class="hidden  text-center md:text-right">
                        <p class="text-gray-200 mb-2">Certified & Trusted</p>
                        <div class="flex space-x-3">
                            <div class="glass-effect rounded-lg p-3">
                                <i class="fas fa-award text-yellow-400 text-2xl"></i>
                            </div>
                            <div class="glass-effect rounded-lg p-3">
                                <i class="fas fa-shield-alt text-green-400 text-2xl"></i>
                            </div>
                            <div class="glass-effect rounded-lg p-3">
                                <i class="fas fa-star text-yellow-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white border-opacity-20 mt-8 pt-6 text-center" id="copyright">
                <div class="flex flex-col md:flex-row justify-between items-center text-gray-200">
                    <p>&copy; <?= date('Y') ?> <?= esc($company['name']) ?? "company name" ?>. All rights reserved. Made with <i class="fas fa-heart text-red-400 mx-1"></i> by our amazing team.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="footer-link nav-link hover:text-white">Privacy Policy</a>
                        <a href="#" class="footer-link nav-link hover:text-white">Terms of Service</a>
                        <a href="#" class="footer-link nav-link hover:text-white">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</footer>