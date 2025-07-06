<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'My Site') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($description ?? 'Default description for my site') ?>">
    <!-- Global CDN Assets -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <?= $this->renderSection('headScripts') ?>


    <!-- Page-Specific Styles -->
    <?= $this->renderSection('styles') ?>
    <style>
        /* Global Scrollbar Styling (WebKit browsers) */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #1f2937;
            /* Tailwind: bg-gray-800 */
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            /* blue to purple */
            border-radius: 8px;
            border: 2px solid #1f2937;
            /* Creates padding effect */
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #7c3aed);
            /* darker on hover */
        }

        /* Firefox scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #8b5cf6 #1f2937;
            /* border-radius: 5px; */
            /* scrollbar-color: transparent transparent; */
        }

        .glass-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            /* border-radius: 0.75rem; */
        }

        .metric-card {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #60a5fa;
        }

        .sidebar-item.active {
            background: rgba(59, 130, 246, 0.2);
            border-left: 3px solid #3b82f6;
        }

        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        @media (max-width: 1024px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            #sidebar.active {
                transform: translateX(0);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<!-- Layout: app/Views/layouts/main.php -->

<body class="font-[Inter] lg:ml-64 min-h-screen <?= esc($bodyClass ?? 'bg-gradient-to-t from-slate-900 to-gray-900 text-white') ?>">

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden hidden"></div>
    <!-- ✅ Conditionally Show Header -->
    <?php if (!isset($hideHeader) || !$hideHeader): ?>
        <?= view('dashboard/layout/sidebar.php') ?>
    <?php endif; ?>


    <main class="min-h-screen ">
        <?php if (!isset($hideHeader) || !$hideHeader): ?>
            <?= view('dashboard/layout/header.php') ?>
        <?php endif; ?>
        <div id="dashboard-content">
            <?= $this->renderSection('content') ?>
        </div>


        <!-- Universal Modal -->
        <div id="universal-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50  flex items-center justify-center  p-4 hidden">


            <div class="glass-card max-w-2xl w-full max-h-[90vh] overflow-y-auto ">
                
                <div class="p-6 relative">
                       <div class="flex items-center justify-between mb-6">
                        <h3 id="modal-title" class="text-xl font-semibold"></h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>
                    <div id="errorBox" class=" relative bg-red-50 border border-red-200 text-red-700 rounded-xl p-5 shadow-md animate-fade-in w-full hidden mb-5">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 font-semibold text-red-600 text-base">
                            <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                            <span>Oops! Please fix the following errors:</span>
                        </div>
                        <!-- Close Button -->
                        <button onclick="document.getElementById('errorBox').classList.add('hidden')" class="text-red-400 hover:text-red-600 transition-all">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Error List -->
                    <ul id="errorList" class="list-disc list-inside mt-4 space-y-2 text-sm text-red-700 pl-2">
                        
                    </ul>
                </div>
                 
                    <div class="absolute top-0 left-0 backdrop-blur-xs center flex gap-4 items-center justify-center   w-full h-full z-[1000] hidden " id="loading">
                        <i data-lucide="loader-circle" class="w-6 h-6 animate-spin"></i> processing...

                    </div>
                    <div id="modal-content" class="relative">


                    </div>
                </div>
            </div>
        </div>
        <div id="successToast"
            class="fixed top-[80px] right-5 z-50  bg-green-500 text-white hidden px-5 py-4 rounded-xl shadow-lg flex items-center space-x-3"
            role="alert">
            <!-- Success Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
            <span id="successMessage" class="text-sm font-medium">Success message</span>
        </div>

    </main>

    <!-- ✅ Conditionally Show Footer -->


    <!-- Page-Specific Scripts -->
    <script src="<?= base_url('assets/js/dashboard/main.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>

    <script>
        // CommonElements.initCommonNavigation();
        gsap.registerPlugin(ScrollToPlugin);
        document.addEventListener('DOMContentLoaded', function() {

            // Scroll on anchor click
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const target = document.querySelector(this.getAttribute('href'));

                    if (target) {
                        gsap.to(window, {
                            duration: 1.5,
                            scrollTo: {
                                y: target,
                                offsetY: 60
                            },
                            ease: 'power2.inOut'
                        });
                    }
                });
            });
        });
    </script>

   
</body>

</html>