<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechCorp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Floating Animations */
        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        .floating-icon:nth-child(1) {
            animation-delay: 0s;
        }

        .floating-icon:nth-child(2) {
            animation-delay: 1s;
        }

        .floating-icon:nth-child(3) {
            animation-delay: 2s;
        }

        .floating-icon:nth-child(4) {
            animation-delay: 3s;
        }

        .floating-icon:nth-child(5) {
            animation-delay: 4s;
        }

        .floating-icon:nth-child(6) {
            animation-delay: 5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(5deg);
            }

            66% {
                transform: translateY(10px) rotate(-3deg);
            }
        }

        /* Login Container */
        .login-container {
            transform: translateY(50px);
            opacity: 0;
        }

        /* Logo Animation */
        .logo-icon {
            transform: scale(0.8);
            opacity: 0;
        }

        /* Form Styling */
        .form-input {
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .form-input.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .form-input.success {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        /* Submit Button Animation */
        .submit-btn {
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        /* Loading State */
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-btn.loading .btn-text {
            opacity: 0;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Social Buttons */
        .social-btn {
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Links */
        .forgot-link,
        .signup-link {
            position: relative;
        }

        .forgot-link::after,
        .signup-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            transition: width 0.3s ease;
        }

        .forgot-link:hover::after,
        .signup-link:hover::after {
            width: 100%;
        }

        /* Messages */
        .success-message {
            animation: slideInRight 0.5s ease-out;
        }

        .error-message {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Back Button */
        .back-home {
            transition: all 0.3s ease;
        }

        .back-home:hover {
            transform: translateX(-3px);
        }

        /* Password Toggle */
        #togglePassword {
            transition: all 0.2s ease;
        }

        #togglePassword:hover {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .login-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .floating-icon {
                font-size: 1.5rem;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 overflow-hidden flex items-center justify-center flex-col">
    <!-- Floating Background Icons -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="floating-icon absolute top-20 left-10 text-blue-200 text-4xl opacity-30">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="floating-icon absolute top-32 right-20 text-purple-200 text-3xl opacity-40">
            <i class="fas fa-lock"></i>
        </div>
        <div class="floating-icon absolute top-60 left-1/4 text-indigo-200 text-5xl opacity-20">
            <i class="fas fa-key"></i>
        </div>
        <div class="floating-icon absolute bottom-40 right-10 text-blue-300 text-3xl opacity-35">
            <i class="fas fa-fingerprint"></i>
        </div>
        <div class="floating-icon absolute bottom-60 left-16 text-purple-300 text-4xl opacity-25">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div class="floating-icon absolute top-1/2 right-1/4 text-indigo-300 text-2xl opacity-30">
            <i class="fas fa-user-lock"></i>
        </div>
    </div>

    <!-- Login Container -->
    <div class=" flex items-center w-full max-w-6xl justify-center p-4 relative z-10">
        <div class="login-container bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 w-full max-w-md border border-white/20">
            <!-- Logo and Title -->
            <div class="text-center mb-8 logo-section">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-4 logo-icon">
                    <i class="fas fa-code text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2 login-title">Welcome Back</h1>
                <p class="text-gray-600 login-subtitle">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-6">
                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-all duration-300"
                        placeholder="Enter your email"
                        required>
                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-purple-500"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:outline-none transition-all duration-300"
                            placeholder="Enter your password"
                            required>
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-blue-600 hover:text-blue-700 transition-colors duration-200 forgot-link">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="loginBtn"
                    class="submit-btn w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-300 transform hover:scale-[1.02]">
                    <span class="btn-text flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </span>
                </button>
            </form>

            <!-- Social Login -->


            <!-- Sign Up Link -->
            <div class="mt-8 text-center signup-section">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-200 signup-link">
                        Sign up here
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="fixed opacity-0 top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <div>
                <h4 class="font-semibold">Login Successful!</h4>
                <p class="text-sm">Welcome back to orgix media</p>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    <div id="errorMessage" class="fixed opacity-0 top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
            <div>
                <h4 class="font-semibold">Login Failed</h4>
                <p class="text-sm" id="errorText">Please check your credentials</p>
            </div>
        </div>
    </div>

    <!-- Back to Home -->
    <a href="<?= base_url('/dashboard')?>" class="fixed top-6 left-6 bg-white/80 backdrop-blur-sm text-gray-700 px-4 py-2 rounded-lg shadow-lg hover:bg-white/90 transition-all duration-200 z-20 back-home">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Home
    </a>

    <script>
        // Register GSAP plugins
        gsap.registerPlugin(ScrollTrigger);

        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initAnimations();
            initFormValidation();
            initPasswordToggle();
        });

        function initAnimations() {
            // Login container entrance animation
            gsap.to('.login-container', {
                y: 0,
                opacity: 1,
                duration: 1.2,
                ease: 'power3.out',
                delay: 0.3
            });

            // Logo animation
            gsap.to('.logo-icon', {
                scale: 1,
                opacity: 1,
                duration: 0.8,
                ease: 'back.out(1.7)',
                delay: 0.6
            });

            // Title and subtitle animation
            gsap.fromTo('.login-title', {
                y: 20,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power2.out',
                delay: 0.8
            });

            gsap.fromTo('.login-subtitle', {
                y: 15,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                ease: 'power2.out',
                delay: 1.0
            });

            // Form groups animation
            gsap.fromTo('.form-group', {
                y: 30,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power2.out',
                delay: 1.2
            });

            // Submit button animation
            gsap.fromTo('.submit-btn', {
                y: 20,
                opacity: 0,
                scale: 0.95
            }, {
                y: 0,
                opacity: 1,
                scale: 1,
                duration: 0.8,
                ease: 'power2.out',
                delay: 1.6
            });

            // Social section animation
            gsap.fromTo('.social-section', {
                y: 20,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                ease: 'power2.out',
                delay: 1.8
            });

            // Signup section animation
            gsap.fromTo('.signup-section', {
                y: 15,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                ease: 'power2.out',
                delay: 2.0
            });

            // Back home button animation
            gsap.fromTo('.back-home', {
                x: -50,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power2.out',
                delay: 0.5
            });

            // Floating icons continuous animation
            gsap.to('.floating-icon:nth-child(odd)', {
                y: -30,
                duration: 4,
                ease: 'power1.inOut',
                yoyo: true,
                repeat: -1
            });

            gsap.to('.floating-icon:nth-child(even)', {
                y: 30,
                duration: 5,
                ease: 'power1.inOut',
                yoyo: true,
                repeat: -1
            });

            // Form input focus animations
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                input.addEventListener('focus', () => {
                    gsap.to(input, {
                        scale: 1.02,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });

                input.addEventListener('blur', () => {
                    gsap.to(input, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });

            // Social button hover animations
            const socialBtns = document.querySelectorAll('.social-btn');
            socialBtns.forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    gsap.to(btn, {
                        rotation: 360,
                        duration: 0.6,
                        ease: 'power2.out'
                    });
                });
            });
        }

        function initFormValidation() {
            const form = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Reset previous states
                clearMessages();
                clearErrors();

                // Validate form
                const isValid = validateForm();

                if (isValid) {
                    loginUser(e);
                } else {
                    showError('Please correct the errors and try again.');
                }
            });

            function validateForm() {
                let isValid = true;
                const email = document.getElementById('email');
                const password = document.getElementById('password');

                // Email validation
                const emailError = email.parentNode.querySelector('.error-message');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!email.value.trim()) {
                    showFieldError(email, emailError, 'Email is required');
                    isValid = false;
                } else if (!emailRegex.test(email.value)) {
                    showFieldError(email, emailError, 'Please enter a valid email address');
                    isValid = false;
                }

                // Password validation
                const passwordError = password.parentNode?.parentNode.querySelector('.error-message');

                if (!password.value.trim()) {
                    showFieldError(password, passwordError, 'Password is required');
                    isValid = false;
                } else if (password.value.length < 6) {
                    showFieldError(password, passwordError, 'Password must be at least 6 characters');
                    isValid = false;
                }

                return isValid;
            }

            function showFieldError(field, errorSpan, message) {
                field.classList.add('error');
                errorSpan.textContent = message;
                errorSpan.classList.remove('hidden');

                // Animate error
                gsap.fromTo(errorSpan, {
                    opacity: 0,
                    x: -10
                }, {
                    opacity: 1,
                    x: 0,
                    duration: 0.3,
                    ease: 'power2.out'
                });

                // Shake animation for field
                gsap.to(field, {
                    x: 5,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 3,
                    ease: 'power2.inOut'
                });
            }

            function clearErrors() {
                const errorSpans = document.querySelectorAll('.error-message');
                const inputs = document.querySelectorAll('.form-input');

                errorSpans.forEach(span => {
                    span.classList.add('hidden');
                });

                inputs.forEach(input => {
                    input.classList.remove('error', 'success');
                });
            }

            function clearMessages() {
                successMessage.style.transform = 'translateX(100%)';
                errorMessage.style.transform = 'translateX(100%)';
            }

            async function loginUser(form) {

                const formData = new FormData(form?.target);
                const email = formData.get("email");
                const password = formData?.get("password");

                console.log(password, email);

                // Show loading state
                loginBtn.classList.add('loading');

                try {
                    const baseurl = window?.origin;
                    console.log(formData, form, baseurl);
                    const response = await fetch("/api/auth/login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            email,
                            password
                        }),
                    });
                    const result = await response.json();

                    console.log(result);

                    if (result?.status) {
                        loginBtn.classList.remove('loading');
                        showSuccess();
                        window.location.href = '/dashboard';

                    } else {
                        showError((result?.message ?? 'Invalid email or password. Please try again.'));

                    }
                } catch (error) {
                    showError((error?.message ?? 'Invalid email or password. Please try again.'));
                } finally {
                    loginBtn.classList.remove('loading');
                }




            }

            function showSuccess() {
                successMessage.style.transform = 'translateX(0)';
                successMessage?.classList?.remove("opacity-0")

                // Mark inputs as success
                const inputs = document.querySelectorAll('.form-input');
                inputs.forEach(input => {
                    if (input.value.trim()) {
                        input.classList.add('success');
                    }
                });

                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.style.transform = 'translateX(100%)';
                    successMessage?.classList?.add("opacity-0")

                }, 5000);
            }

            function showError(message) {
                const errorText = document.getElementById('errorText');
                console.log(successMessage,errorText);
                
                errorText.textContent = message;
                errorMessage?.classList?.remove("opacity-0")
                errorMessage.style.transform = 'translateX(0)';
                console.log(successMessage,errorText);


                // Hide error message after 5 seconds
                setTimeout(() => {
                    errorMessage.style.transform = 'translateX(100%)';
                    errorMessage?.classList?.add("opacity-0")

                }, 5000);
            }
        }

        function initPasswordToggle() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle icon
                const icon = this.querySelector('i');
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }

                // Animate toggle
                gsap.to(this, {
                    rotation: 360,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        }

        // Mouse movement parallax effect
        document.addEventListener('mousemove', (e) => {
            const {
                clientX,
                clientY
            } = e;
            const {
                innerWidth,
                innerHeight
            } = window;

            const xPercent = (clientX / innerWidth) * 100;
            const yPercent = (clientY / innerHeight) * 100;

            gsap.to('.floating-icon', {
                x: (xPercent - 50) * 0.3,
                y: (yPercent - 50) * 0.3,
                duration: 2,
                ease: 'power2.out'
            });
        });
    </script>
</body>

</html>