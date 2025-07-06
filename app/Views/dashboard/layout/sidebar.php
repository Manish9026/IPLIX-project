<?php $uri = service('uri');  $session=session()?>
    
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 glass-card z-50 lg:translate-x-0">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
                    IPLIX Dashboard
                </h1>
                <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
           <nav class="space-y-2">
    <a href="<?= base_url('dashboard') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === "" ? 'active' : '' ?>" 
       data-page="overview">
        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
        <span>Overview</span>
    </a>

    <a href="<?= base_url('dashboard/home') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'home' ? 'active' : '' ?>" 
       data-page="home">
        <i data-lucide="home" class="w-5 h-5"></i>
        <span>Home Page</span>
    </a>

    <a href="<?= base_url('dashboard/story') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'story' ? 'active' : '' ?>" 
       data-page="story">
        <i data-lucide="book-open" class="w-5 h-5"></i>
        <span>Our Story</span>
    </a>

    <a href="<?= base_url('dashboard/services') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'services' ? 'active' : '' ?>" 
       data-page="services">
        <i data-lucide="briefcase" class="w-5 h-5"></i>
        <span>Services</span>
    </a>

    <a href="<?= base_url('dashboard/work') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'work' ? 'active' : '' ?>" 
       data-page="work">
        <i data-lucide="folder" class="w-5 h-5"></i>
        <span>Our Work</span>
    </a>

     <a href="<?= base_url('dashboard/hero') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'hero' ? 'active' : '' ?>" 
       data-page="hero">
        <i data-lucide="folder" class="w-5 h-5"></i>
        <span>Manage Hero</span>
    </a>
    <a href="<?= base_url('dashboard/careers') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'careers' ? 'active' : '' ?>" 
       data-page="careers">
        <i data-lucide="users" class="w-5 h-5"></i>
        <span>Careers</span>
    </a>

    <a href="<?= base_url('dashboard/contact') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'contact' ? 'active' : '' ?>" 
       data-page="contact">
        <i data-lucide="mail" class="w-5 h-5"></i>
        <span>Contact</span>
    </a>

     <a href="<?= base_url('dashboard/manage-work') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'manage-work' ? 'active' : '' ?>" 
       data-page="contact">
        <i data-lucide="mail" class="w-5 h-5"></i>
        <span>Manage Project</span>
    </a>

    <a href="<?= base_url('dashboard/case-studies') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'case-studies' ? 'active' : '' ?>" 
       data-page="case-studies">
        <i data-lucide="file-text" class="w-5 h-5"></i>
        <span>Case Studies</span>
    </a>

    <a href="<?= base_url('dashboard/settings') ?>" 
       class="sidebar-item flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'settings' ? 'active' : '' ?>" 
       data-page="settings">
        <i data-lucide="settings" class="w-5 h-5"></i>
        <span>Settings</span>
    </a>
    
            <?php if ($session->has('user')): ?>
 <button  onclick="handleLogout()"
       class="sidebar-item w-full flex items-center space-x-3 p-3 rounded-lg <?= $uri->getSegment(2) === 'settings' ? 'active' : '' ?>" 
       data-page="logout">
        <i data-lucide="log-out" class="w-5 h-5"></i>
        <span>Logout</span>
    </button>
                <?php endif ;?>
</nav>

        </div>
    </aside>