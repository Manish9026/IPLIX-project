<?= $this->extend('layout') ?>


<?= $this->section('styles') ?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        background: #0a0a0a;
        color: #ffffff;
        overflow-x: hidden;
        line-height: 1.6;
    }

    /* Navigation */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 1rem 2rem;
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ffffff;
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        list-style: none;
        gap: 2rem;
    }

    .nav-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: #ffffff;
    }

    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: radial-gradient(ellipse at center, rgba(99, 102, 241, 0.1) 0%, rgba(0, 0, 0, 1) 70%);
        position: relative;
        overflow: hidden;
    }

    .hero-content h1 {
        font-size: clamp(3rem, 8vw, 8rem);
        font-weight: 900;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        opacity: 0;
        transform: translateY(100px);
    }

    .hero-content p {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        margin: 0 auto 3rem;
        opacity: 0;
        transform: translateY(50px);
    }

    /* Floating Icons */
    .floating-icons {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-icon {
        position: absolute;
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-icon:nth-child(1) {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-icon:nth-child(2) {
        top: 60%;
        left: 80%;
        animation-delay: -2s;
    }

    .floating-icon:nth-child(3) {
        top: 30%;
        right: 20%;
        animation-delay: -4s;
    }

    .floating-icon:nth-child(4) {
        bottom: 30%;
        left: 15%;
        animation-delay: -1s;
    }

    .floating-icon:nth-child(5) {
        top: 70%;
        left: 30%;
        animation-delay: -3s;
    }

    .floating-icon:nth-child(6) {
        top: 15%;
        left: 70%;
        animation-delay: -5s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-30px) rotate(180deg);
        }
    }

    /* Contact Section */
    .contact-section {
        padding: 8rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6rem;
        align-items: start;
    }

    .contact-info {
        opacity: 0;
        transform: translateX(-50px);
    }

    .contact-info h2 {
        font-size: 3rem;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(30px);
        backdrop-filter: blur(10px);
    }

    .contact-item:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.15);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .contact-item-icon {
        font-size: 2.2rem;
        margin-right: 2rem;
        color: #667eea;
        min-width: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 70px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }

    .contact-item-content h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .contact-item-content p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }

    .contact-item-content small {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    /* Enhanced Contact Form */
    .contact-form {
        opacity: 0;
        transform: translateX(50px);
        background: rgba(255, 255, 255, 0.02);
        padding: 3rem;
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        position: relative;
        overflow: hidden;

    }

    .contact-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.5), transparent);
    }

    .contact-form h3 {
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #ffffff;
        text-align: center;
        font-weight: 600;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        /* margin-bottom: 2rem; */
    }

    .form-group {
        /* margin-bottom: 2rem; */
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.8rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 30px rgba(102, 126, 234, 0.2);
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 140px;
        font-family: inherit;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .submit-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1.3rem 4rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        margin: 2rem auto 0;
        min-width: 200px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
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

    .submit-btn i {
        transition: transform 0.3s ease;
    }

    .submit-btn:hover i {
        transform: translateX(5px);
    }

    /* Form Input Icons */
    .input-with-icon {
        position: relative;
    }

    .input-with-icon .form-control {
        padding-left: 3.5rem;
    }

    .input-with-icon .input-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.1rem;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .input-with-icon .form-control:focus+.input-icon {
        color: #667eea;
    }

    /* Map Section Enhanced */
    .map-section {
        margin-top: 6rem;
        opacity: 0;
        transform: translateY(50px);
    }

    .map-container {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 25px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.08);
        text-align: center;
        backdrop-filter: blur(15px);
    }

    .map-placeholder {
        height: 350px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }

    .map-placeholder i {
        font-size: 4.5rem;
        color: #667eea;
        margin-bottom: 1.5rem;
    }

    .map-placeholder h3 {
        font-size: 1.8rem;
        margin-bottom: 0.8rem;
        color: #ffffff;
    }

    .map-placeholder p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
    }

    /* Social Links Enhanced */
    .social-section {
        text-align: center;
        margin-top: 5rem;
        opacity: 0;
        transform: translateY(30px);
    }

    .social-section h3 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #ffffff;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 2.5rem;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #ffffff;
        font-size: 1.6rem;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .social-link:hover::before {
        opacity: 1;
    }

    .social-link:hover {
        transform: translateY(-8px) scale(1.1);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        border-color: transparent;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .contact-grid {
            grid-template-columns: 1fr;
            gap: 4rem;
        }

        .hero-content h1 {
            font-size: 4rem;
        }

        .contact-info h2 {
            font-size: 2.5rem;
        }

        .contact-form {
            padding: 2rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .social-links {
            gap: 1rem;
        }

        .floating-icon {
            font-size: 1.5rem;
        }

        .contact-item {
            padding: 1.5rem;
            min-width: 250px;
        }

        .contact-item-icon {
            min-width: 60px;
            height: 60px;
            font-size: 1.8rem;
            margin-right: 1.5rem;
        }
    }

    @media (min-width:800px) {
        .contact-item {
            min-width: 400px;
        }

    }

    /* Additional Animations */
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .magnetic-btn {
        transition: transform 0.3s ease;
    }

    .magnetic-btn:hover {
        transform: scale(1.05);
    }

    .service-item {
        cursor: pointer;
        position: relative;

        &::after {
            content: "";
            position: absolute;
            left: 20px;
            bottom: -5px;
            width: 0%;
            height: 2px;
            border-radius: 20px;
            background-image: linear-gradient(45deg, rgb(119, 54, 184), rgba(255, 78, 214, 0.86));
            transition: all ease 1.5s;
        }

    }

    .service-item:hover::after {
        width: 70%;

    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="hero">
    <div class="floating-icons">
        <i class="floating-icon fas fa-envelope"></i>
        <i class="floating-icon fas fa-phone"></i>
        <i class="floating-icon fas fa-map-marker-alt"></i>
        <i class="floating-icon fab fa-twitter"></i>
        <i class="floating-icon fab fa-linkedin"></i>
        <i class="floating-icon fas fa-comments"></i>
    </div>

    <div class="hero-content container text-center z-10">

        <?php if (!empty($hero['title'])) : ?>
            <h1 class="hero-title ">
                <?= esc($hero['title'] ?? "about title") ?>

                <?php if (!empty($hero['gradientTitle'])) : ?>
                    <br />
                    <span class="gradient-text"> <?= esc($hero['gradientTitle'] ?? "gradient content title") ?></span>
                <?php endif; ?>

                <?php if (!empty($hero['subTitle'])) : ?>
                    <br />
                    <?= esc($hero['subTitle'] ?? "gradient content title") ?>
                <?php endif; ?>

            </h1>
        <?php endif; ?>


        <?php if (!empty($hero['description'])) : ?>
            <p class="hero-subtitle">
                <?= esc($hero['description'] ?? "description about page") ?>
            </p>
        <?php endif; ?>





        <?php if (!empty($hero['btn']) && count($hero['btn']) > 0 && is_array($hero['btn'])) : ?>
            <div class="mt-10 sm:gap-4 gap-2 hero-cta opacity-0 flex flex-wrap sm:flex-row gap-4 justify-center items-center transition-all ease duration-500 ">
                <?php foreach ($hero['btn'] as $i => $btn) : ?>

                    <?php if ($i % 2 === 0): ?>
                        <a href="<?= base_url($btn['link'] ?? "")  ?>" class="magnetic-btn bg-white text-black px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-gray-200 transition-all duration-300">
                            <?= esc($btn['label'] ?? "") ?>
                        </a>

                    <?php else: ?>
                        <a href="<?= base_url($btn['link'] ?? "")  ?>" class="magnetic-btn border border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-sm sm:text-lg hover:bg-white hover:text-black transition-all duration-300">
                            <?= esc($btn['label'] ?? "") ?>
                        </a>
                    <?php endif; ?>


                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- <div class="hero-content">
        <h1 class="hero-title">Get In Touch</h1>
        <p class="hero-subtitle">Let's create something amazing together. We're here to bring your vision to life.</p>
    </div> -->
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-grid">

        <div class="max-w-5xl w-full bg-black/80 backdrop-blur-md text-white p-8 rounded-3xl shadow-2xl border border-fuchsia-700">
            <h2 class="text-3xl font-bold text-white mb-6 relative inline-block">
                Our Services
                <span class="block w-16 h-1 bg-orange-500 absolute left-0 -bottom-2"></span>
            </h2>

            <?php
            $total = count($services);

            $half = ceil($total / 2);  // fixed 5 pairs
            $left = array_slice($services, 0, $half);
            $right = array_slice($services, $half, $half);

            if (!empty($services) && is_array($services) && $total > 0) : ?>
                <div class="grid md:grid-cols-2 gap-y-4 gap-x-12 text-lg">



                    <div class="space-y-3">

                        <?php foreach ($left as $i => $service): ?>
                            <div class="flex items-center gap-2 service-item">
                                <span class="text-orange-500 text-xl">✓</span> <?= esc($service['title']) ?>
                            </div>
                        <?php endforeach; ?>


                    </div>

                    <div class="space-y-3">
                        <?php foreach ($right as $i => $service): ?>
                            <div class="flex items-center gap-2 service-item">
                                <span class="text-orange-500 text-xl">✓</span> <?= esc($service['title']) ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            <?php else : ?>

                <span>No services</span>
            <?php endif; ?>


            <div class="mt-8 flex gap-6 text-orange-500 text-2xl">
                <a href="#" class="hover:text-white transition-all"><i class="ph ph-instagram-logo"></i></a>
                <a href="#" class="hover:text-white transition-all"><i class="ph ph-youtube-logo"></i></a>
                <a href="#" class="hover:text-white transition-all"><i class="ph ph-linkedin-logo"></i></a>
            </div>
        </div>
        <!-- Enhanced Contact Form -->
        <div class="contact-form" id="contact">
            <h3>Send us a message</h3>
            <form id="contactForm" class="flex flex-col gap-4">

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
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <div class="input-with-icon">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required>
                            <i class="input-icon fas fa-user"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <div class="input-with-icon">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email address" required>
                            <i class="input-icon fas fa-envelope"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobNo">Contact No.</label>
                    <div class="input-with-icon">
                        <input type="number"  name="mobNo"  id="mobNo" class="form-control" placeholder="Ex.. +91 7346723747" required>
                        <i class="input-icon fa-solid fa-phone"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <!-- <div class="input-with-icon"> -->
                    <select name="service" id="subject" class="form-control" required>
                        <option hidden class="bg-white text-black" selected data-id="" disabled value="">What's this about?</option>
                        <?php
                        if (!empty($services) && is_array($services) && count($services) > 0) : ?>

                            <?php foreach ($services as $i => $service): ?>
                                <option class="bg-white text-black" data-id="<?= esc($service['id']) ?>" value="<?= esc($service['title']) ?>"><?= esc($service['title']) ?></option>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <option hidden data-id="" disabled class="bg-white text-black" selected value="">no more services</option>
                        <?php endif; ?>

                    </select>
                    <!-- <i class="input-icon fas fa-tag"></i>
                    </div> -->
                </div>

                <div class="form-group">
                    <label for="message">Your Message</label>
                    <div class="input-with-icon">
                        <textarea id="message" name="message" class="form-control" placeholder="Tell us about your project or inquiry..." required></textarea>
                        <i class="input-icon fas fa-comment"></i>
                    </div>
                </div>

                <button type="submit" class="submit-btn magnetic-btn">
                    
                    <i class="fas fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>
    <!-- Contact Information -->
    <div class="contact-info ">
        <h2>Let's Talk</h2>

        <div class="flex flex-wrap flex-1 w-full gap-2 sm:gap-4">

            <div class="contact-item flex-1 " data-contact="email">
                <div class="contact-item-icon">
                    <i class="fas fa-envelope pulse-animation"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Email Us</h3>
                    <p>hello@iplix.com</p>
                    <small>We respond within 24 hours</small>
                </div>
            </div>

            <div class="contact-item flex-1" data-contact="phone">
                <div class="contact-item-icon">
                    <i class="fas fa-phone pulse-animation"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Call Us</h3>
                    <p>+1 (555) 123-4567</p>
                    <small>Mon-Fri 9AM-6PM EST</small>
                </div>
            </div>

            <div class="contact-item flex-1" data-contact="location">
                <div class="contact-item-icon">
                    <i class="fas fa-map-marker-alt pulse-animation"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Visit Us</h3>
                    <p>New York, NY</p>
                    <small>Schedule an appointment</small>
                </div>
            </div>

            <div class="contact-item flex-1" data-contact="hours">
                <div class="contact-item-icon">
                    <i class="fas fa-clock pulse-animation"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Business Hours</h3>
                    <p>Monday - Friday</p>
                    <small>9:00 AM - 6:00 PM EST</small>
                </div>
            </div>
        </div>

    </div>
    <!-- Map Section -->
    <div class="map-section">
        <div class="map-container">
            <div class="map-placeholder">
                <i class="fas fa-map-marked-alt"></i>
                <h3>Find Us Here</h3>
                <p>123 Innovation Street, New York, NY 10001</p>
            </div>
        </div>
    </div>

    <!-- Social Links -->
    <div class="social-section">
        <h3>Connect With Us</h3>
        <div class="social-links">
            <a href="#" class="social-link magnetic-btn">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-link magnetic-btn">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="#" class="social-link magnetic-btn">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-link magnetic-btn">
                <i class="fab fa-dribbble"></i>
            </a>
            <a href="#" class="social-link magnetic-btn">
                <i class="fab fa-behance"></i>
            </a>
        </div>
    </div>
</section>
<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/contact.js') ?>"></script>
<script>
    const tl = gsap.timeline();
    tl.fromTo('.hero-title', {
            opacity: 0,
            y: 100,
            scale: 0.9
        }, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out'
        })
        .fromTo('.hero-subtitle', {
                opacity: 0,
                y: 50
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out'
            },
            '-=0.8'
        ).to('.hero-cta', {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out'
            },
            '-=0.3'
        );
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>