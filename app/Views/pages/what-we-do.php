
<?= $this->extend('layout') ?>
<?= $this->section('styles') ?>
    <style>
        /* Fix horizontal scroll issues and ensure full screen coverage */
        html, body {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        * {
            box-sizing: border-box;
        }
        
        /* Main container using flexbox */
        body { 
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }
        
        /* Ensure all sections use full width */
        section {
            width: 100%;
            flex-shrink: 0;
        }
        
        /* Container fixes */
        .container {
            width: 100%;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        @media (min-width: 640px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        @media (min-width: 1024px) {
            .container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
        
        @media (min-width: 1280px) {
            .container {
                max-width: 1280px;
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
        
        .service-section {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.02);
        }
        .service-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        /* Footer positioning */
        footer {
            margin-top: auto;
            width: 100%;
        }
    </style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<body class="bg-black text-white">
    <!-- Navigation -->


    <div class="flex-1">
        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-purple-900/20 to-black"></div>
            <div class="absolute inset-0">
                <div class="floating absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-60"></div>
                <div class="floating absolute top-40 right-20 w-6 h-6 bg-purple-400 rounded-full opacity-40" style="animation-delay: 2s;"></div>
                <div class="floating absolute bottom-40 left-1/4 w-3 h-3 bg-cyan-400 rounded-full opacity-50" style="animation-delay: 4s;"></div>
            </div>
            
            <div class="container text-center z-10">
                <h1 class="hero-title text-6xl md:text-8xl font-bold mb-6">
                    What We
                    <br />
                    <span class="bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
                        Do
                    </span>
                </h1>
                <p class="hero-subtitle text-xl text-gray-400 max-w-3xl mx-auto">
                    We provide comprehensive digital marketing solutions that transform brands 
                    and drive measurable business growth through strategic creativity.
                </p>
            </div>
        </section>

        <!-- Service Sections -->
        <div id="services-container"></div>

        <!-- Process Section -->
        <section class="py-20 bg-black">
            <div class="container">
                <h2 class="section-title text-4xl md:text-6xl font-bold text-center mb-16">Our Process</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="process-step text-center" data-step="1">
                        <div class="text-4xl font-bold text-blue-400 mb-4">01</div>
                        <h3 class="text-xl font-semibold mb-4">Discovery</h3>
                        <p class="text-gray-400">Understanding your brand, audience, and objectives</p>
                    </div>
                    <div class="process-step text-center" data-step="2">
                        <div class="text-4xl font-bold text-blue-400 mb-4">02</div>
                        <h3 class="text-xl font-semibold mb-4">Strategy</h3>
                        <p class="text-gray-400">Developing a comprehensive roadmap for success</p>
                    </div>
                    <div class="process-step text-center" data-step="3">
                        <div class="text-4xl font-bold text-blue-400 mb-4">03</div>
                        <h3 class="text-xl font-semibold mb-4">Creation</h3>
                        <p class="text-gray-400">Bringing ideas to life with exceptional execution</p>
                    </div>
                    <div class="process-step text-center" data-step="4">
                        <div class="text-4xl font-bold text-blue-400 mb-4">04</div>
                        <h3 class="text-xl font-semibold mb-4">Optimization</h3>
                        <p class="text-gray-400">Continuously improving based on data and insights</p>
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>

 <script src="<?= base_url('assets/js/what-we-do.js') ?>"></script>

<?= $this->endSection() ?>
