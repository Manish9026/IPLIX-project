<?php

$stats = [
    [
        "id" => 1,
        "icon" => "👥",
        "value" => "50+",
        "label" => "Team Members"
    ],
    [
        "id" => 2,
        "icon" => "🏆",
        "value" => "200+",
        "label" => "Projects Completed"
    ],
    [
        "id" => 3,
        "icon" => "🌍",
        "value" => "15+",
        "label" => "Countries Served"
    ],
    [
        "id" => 4,
        "icon" => "⏰",
        "value" => "6+",
        "label" => "Years of Excellence"
    ],
    [
        "id" => 5,
        "icon" => "💕💕💕",
        "value" => "90+",
        "label" => "our teams"
    ]
];

?>
<?= $this->extend('dashboard/layout/main.php') ?>

<?= $this->section('headScripts') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<?= $this->endSection() ?>


<?= $this->section('styles') ?>

<style>
    .search-filter-section {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 1.5rem;
        margin-bottom: 3rem;
        opacity: 0;
        transform: translateY(30px);
    }

    .search-container {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.5);
    }

    .filter-dropdown {
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        cursor: pointer;
        min-width: 150px;
    }

    .filter-dropdown:focus {
        outline: none;
        border-color: #667eea;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="home-content" class="page-content p-4 lg:p-6 ">

<section class="search-filter-section relative z-50">
    <div class="search-container relative z-50">
        <i class="fas fa-search search-icon"></i>
        <input 
            type="text" 
            onfocus="searchWork(event.target.value)" 
            onblur="onReset(event)" 
            oninput="searchWork(event.target.value)" 
            class="search-input" 
            placeholder="Search projects, content, or keywords..." 
            id="workSearchInput"
        >
        
        <!-- Work List Dropdown -->
        <ul 
            id="workListContainer" 
            class="mt-2 hidden overflow-auto glass-card rounded-md p-2 w-full absolute top-full left-0 z-[9999] max-h-[500px] text-white shadow-lg backdrop-blur-md">
            <!-- Injected work items -->
        </ul>
    </div>

    <!-- Filters -->
    <select class="filter-dropdown" id="categoryFilter">
        <option value="">All Categories</option>
        <option value="contact">Contact Info</option>
        <option value="hero">Hero Section</option>
        <option value="services">Services</option>
        <option value="social">Social Media</option>
        <option value="location">Location</option>
    </select>

    <select class="filter-dropdown" id="statusFilter">
        <option value="">All Status</option>
        <option value="active">Active</option>
        <option value="draft">Draft</option>
        <option value="archived">Archived</option>
    </select>
</section>

<section id="workSection" class="relative z-0 w-full h-full">
    <p class="text-gray-400">Loading...</p>
</section>


</div>




<?= $this->section('scripts') ?>

<script>
    // Search and filter section animation
    gsap.to('.search-filter-section', {
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.4,
        ease: 'power3.out'
    });

    // Content grid animation
    gsap.to('.content-grid', {
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.6,
        ease: 'power3.out'
    });
</script>

<script src="<?= base_url('assets/js/dashboard/singleWork.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>