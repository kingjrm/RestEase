<?php
session_start();
require 'vendor/autoload.php';      // PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cloudflare Turnstile keys (replace with your keys)
$turnstile_sitekey = '0x4AAAAAAB9DMwi4JEs-E7Dk';
$turnstile_secret  = '0x4AAAAAAB9DM0HH3_jtHziIMzaFQztRwcA';

$successMsg = $_SESSION['successMsg'] ?? '';
$errorMsg = $_SESSION['errorMsg'] ?? '';
unset($_SESSION['successMsg'], $_SESSION['errorMsg']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple server-side validation
    $name = trim($_POST['name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $turnstile_response = $_POST['cf-turnstile-response'] ?? '';

    // Cloudflare Turnstile verification function
    function verify_turnstile($token, $secret, $remoteip = null) {
        if (empty($token) || empty($secret)) return false;
        $ch = curl_init('https://challenges.cloudflare.com/turnstile/v0/siteverify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $post = ['secret' => $secret, 'response' => $token];
        if ($remoteip) $post['remoteip'] = $remoteip;
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $resp = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($resp);
        return ($obj && !empty($obj->success));
    }

    if (!$name) {
        $_SESSION['errorMsg'] = 'Name is required.';
    } elseif (!$contact) {
        $_SESSION['errorMsg'] = 'Contact is required.';
    } elseif (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMsg'] = 'Valid email is required.';
    } elseif (!$message) {
        $_SESSION['errorMsg'] = 'Message is required.';
    } elseif (empty($turnstile_response) || !verify_turnstile($turnstile_response, $turnstile_secret, $_SERVER['REMOTE_ADDR'] ?? '')) {
        $_SESSION['errorMsg'] = 'Please complete the Cloudflare verification before submitting.';
    } else {
        // Send email via PHPMailer
        /*
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'resteasempdo@gmail.com';
            $mail->Password = 'vvkblrlppiflbksu';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('resteasempdo@gmail.com', 'RestEase Contact Form');
            $mail->addAddress('resteasempdo@gmail.com');

            $mail->Subject = 'New Contact Form Submission';
            $mail->Body = "Name: $name\nContact: $contact\nEmail: $email\nMessage:\n$message";

            $mail->send();
            $_SESSION['successMsg'] = 'Your message has been sent successfully!';
        } catch (Exception $e) {
            $_SESSION['errorMsg'] = 'Message could not be sent. Please try again later.';
        }
        */
        // Optionally, set a message indicating email sending is disabled
        $_SESSION['errorMsg'] = 'Message sending is currently disabled.';
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEase</title>
    <link rel="icon" type="image/png" href="./assets/re logo blue.png">
    <!-- Add Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <!-- Desktop-only extra spacing for Associated By logos -->
    <style>
        @media (min-width: 992px) {
            /* increased gap between logos on desktop only */
            .associated-by .footer-icons {
                gap: 4.5rem !important; /* increased from 3rem */
            }
            /* ensure images remain visually consistent */
            .associated-by .footer-icons img {
                max-height: 80px;
                width: auto;
                display: inline-block;
            }
        }
    </style>
    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/RE Logo New.png" alt="Logo">
                <span class="brand-name">RestEase</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about-us.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact</a></li>
                    <li class="nav-item"><a class="btn btn-signin" href="login.php">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="hero scroll-animate fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="trust-badge mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="partner-avatars d-flex">
                                    <img src="assets/Logo garcia.png" alt="Partner" class="avatar-img">
                                    <img src="assets/BSU Logo.png" alt="Partner" class="avatar-img">
                                    <img src="assets/Seal_of_Batangas.png" alt="Partner" class="avatar-img">
                                </div>
                                <span class="trust-text">Trusted by Padre Garcia, Batangas</span>
                            </div>
                        </div>
                        <h1 class="hero-title fade-in-up delay-1">Manage Cemetery Records with <span class="highlight">Perfect Digital Organization.</span></h1>
                        <p class="hero-description fade-in-up delay-2">Empowering Padre Garcia, Batangas with digital cemetery management solutions. Simplify tracking niches, renewals, and documents.</p>
                        <div class="hero-buttons fade-in-up delay-3">
                            <a href="login.php" class="btn btn-primary-hero">Request Now</a>
                            <a href="#explore-restease" class="btn btn-secondary-hero">Watch Demo</a>
                        </div>
                        <p class="hero-note fade-in-up delay-4">No paperwork. No hassle. No delays. No stress.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container fade-in-up delay-2">
                        <img src="assets/garcia.webp" alt="RestEase Cemetery Management" class="hero-main-image">
                        <div class="floating-badge badge-1">
                            <i class="fas fa-check-circle"></i> <span>Organized Records</span>
                        </div>
                        <div class="floating-badge badge-2">
                            <i class="fas fa-map-marked-alt"></i> <span>Interactive Maps</span>
                        </div>
                        <div class="floating-badge badge-3">
                            <i class="fas fa-bell"></i> <span>Renewal Reminders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="partners-section py-4">
        <div class="container">
            <div class="partners-wrapper">
                <p class="partners-label">Trusted Partners:</p>
                <div class="partners-logos-inline">
                    <img src="assets/Logo garcia.png" alt="Padre Garcia" class="partner-logo-inline">
                    <img src="assets/re logo blue.png" alt="RestEase" class="partner-logo-inline">
                    <img src="assets/BSU Logo.png" alt="BSU" class="partner-logo-inline">
                    <img src="assets/Seal_of_Batangas.png" alt="Batangas" class="partner-logo-inline">
                </div>
            </div>
        </div>
    </section>
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <span class="about-badge">About RestEase</span>
                        <h2 class="about-title">Transforming Cemetery Management for <span class="highlight">Padre Garcia</span></h2>
                        <p class="about-description">
                            At RestEase, we transform traditional cemetery management into a seamless digital experience. Our platform serves the Municipal Planning and Development Office (MPDO) of Padre Garcia, Batangas.
                        </p>
                        <div class="about-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Digital Records</h4>
                                    <p>Easy access and long-term preservation of all cemetery records</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Interactive Maps</h4>
                                    <p>Precise niche tracking with GIS technology</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Smart Reminders</h4>
                                    <p>Timely renewal notifications for families</p>
                                </div>
                            </div>
                        </div>
                        <a href="about-us.php" class="btn btn-primary-hero mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <img src="assets/testimony-image.webp" alt="Who we are" class="about-main-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="our-services py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Services</h2>
                <p class="section-description">
                    RestEase offers a modern, efficient, and transparent approach to cemetery management through digital innovation.
                </p>
            </div>
            <div class="row mt-4 d-flex align-items-stretch scroll-animate-stagger scale-in">
                <!-- Card 1 -->
                <div class="col-md-4 d-flex">
                    <div class="service-card flex-grow-1 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="service-title flex-grow-1">Record Keeping</h3>
                            <div class="icon">
                                <img src="assets/recordsicon.png" alt="Record Keeping" class="img-fluid">
                            </div>
                        </div>
                        <p class="service-description" style="text-align: center;">
                            We provide a secure and organized digital database that allows administrators to easily store, access, and manage burial and certificate records, ensuring data accuracy and long-term preservation.
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4 d-flex">
                    <div class="service-card flex-grow-1 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="service-title flex-grow-1">Cemetery Mapping</h3>
                            <div class="icon">
                                <img src="assets/mappicon.png" alt="Cemetery Mapping" class="img-fluid">
                            </div>
                        </div>
                        <p class="service-description" style="text-align: center;">
                            Using GIS technology, we offer an interactive digital map that helps users and administrators locate niches, track availability, and visualize the layout of the cemetery in real time.
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4 d-flex">
                    <div class="service-card flex-grow-1 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="service-title flex-grow-1">Notifications and Reminders</h3>
                            <div class="icon">
                                <img src="assets/notificon.png" alt="Notifications and Reminders" class="img-fluid">
                            </div>
                        </div>
                        <p class="service-description" style="text-align: center;">
                            Our notification system keeps families informed by sending timely alerts for certificate renewals, updates, and important announcements—ensuring no deadlines are missed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore RestEase Section (NEW) -->
    <section id="explore-restease" class="explore-restease-section py-5 scroll-animate fade-up" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="section-bg-objects">
            <div class="section-bg-object circle automove3" style="width:90px;height:90px;top:15%;left:75%;"></div>
            <div class="section-bg-object square automove1" style="width:65px;height:65px;top:80%;left:25%;"></div>
            <div class="section-bg-object triangle automove2" style="top:60%;left:50%;width:0;height:0;"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Content -->
                <div class="col-lg-7 col-md-12 mb-4 mb-lg-0 d-flex flex-column justify-content-center" style="height:100%;">
                    <h2 class="fw-bold mb-3">Explore RestEase</h2>
                    <!-- Carousel Start -->
                    <div id="exploreCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <p class="explore-carousel-text" style="text-align: justify; cursor: pointer;">
                                   RestEase is more than just a record management system, it’s a modern digital solution built to simplify and improve cemetery operations in Padre Garcia. Through its web-based platform, users can easily access burial records, request certificates, and track renewal schedules without the hassle of paperwork.

The system provides a secure and transparent way to manage cemetery information, ensuring that data remains accurate and protected. Families can locate niches, receive renewal notifications, and access important updates online, while administrators benefit from organized records and faster processing. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image Content -->
                <div class="col-lg-5 col-md-12 text-center d-flex justify-content-center align-items-center" style="height:100%;">
                    <img src="assets/explore.png" alt="Explore RestEase" class="img-fluid rounded" style="max-width: 350px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section scroll-animate fade-down">
        <div class="section-bg-objects">
            <div class="section-bg-object circle automove1" style="width:120px;height:120px;top:30%;left:10%;"></div>
            <div class="section-bg-object square automove2" style="width:85px;height:85px;top:75%;left:80%;"></div>
            <div class="section-bg-object triangle automove3" style="top:65%;left:40%;width:0;height:0;"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2>Contact Us</h2>
                    <p class="mb-4">Connect with us for more information or assistance. Whether you have concerns, suggestions, or need help, we're just a message away!</p>
                    
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success"><?php echo $successMsg; ?></div>
                    <?php elseif ($errorMsg): ?>
                        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>

                    <form method="POST" id="contactForm" novalidate>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <div class="invalid-feedback">Name is required.</div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contact" placeholder="Contact" required>
                                <div class="invalid-feedback">Contact is required.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            <div class="invalid-feedback">Valid email is required.</div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                            <div class="invalid-feedback">Message is required.</div>
                        </div>
                        <!-- Cloudflare Turnstile widget -->
                        <div class="mb-3 w-100 turnstile-container" aria-hidden="false">
                            <div class="cf-turnstile" data-sitekey="<?php echo htmlspecialchars($turnstile_sitekey); ?>" data-theme="light"></div>
                        </div>
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
                
                <div class="col-lg-5">
                    <div class="contact-info d-flex flex-column justify-content-center h-100" style="min-height: 400px;">
                        <h3>Address</h3>
                        <p>
                            <a href="https://maps.app.goo.gl/JpSWRWs45M6FuBQe8" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               style="text-decoration: none; color: inherit;">
                               281 V. Luna St., Padre Garcia, 4224 Batangas
                            </a>
                             <a href="https://maps.app.goo.gl/mDY9KqeRBaXTm2JR6" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               style="text-decoration: none; color: inherit;">
                             <p>V6F8+P38, Padre Garcia, Batangas</p>
                             </a>
                              <a href="https://maps.app.goo.gl/gKD6GszPE12M2GRn9" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               style="text-decoration: none; color: inherit;">
                                <p> V6MF+8JH, Banaba, Padre Garcia, Batangas</p>
                            </a>
                        </p>
                        
                        <h3>Contact</h3>
                        <p>Phone: +0923-456-789</p>
                        <p>Email: resteasempdo@gmail.com</p>
                        
                        <h3>Open Time</h3>
                        <p>Monday - Sunday : 8:00am - 5:00pm</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimony py-5 scroll-animate scale-in">
        <div class="section-bg-objects">
            <div class="section-bg-object circle automove2" style="width:110px;height:110px;top:25%;left:60%;"></div>
            <div class="section-bg-object square automove3" style="width:65px;height:65px;top:85%;left:20%;"></div>
            <div class="section-bg-object triangle automove1" style="top:70%;left:70%;width:0;height:0;"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="./assets/Poster.webp" alt="Testimony Image" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <blockquote class="blockquote">
                        <p class="mb-4" style="font-style: italic;">
                            "In a world where time moves fast, we ensure that remembering and honoring the past is effortless. Through innovation and organization, we provide a seamless way to preserve legacies and manage what truly matters."
                        </p>
                        <footer class="blockquote-footer">RestEase</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
    <?php include 'Includes/footer.php'; ?>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Slow hover to next carousel item for Explore RestEase
    let exploreHoverTimeout;
    document.querySelectorAll('.explore-carousel-text').forEach(function(el) {
        el.addEventListener('mouseenter', function() {
            clearTimeout(exploreHoverTimeout);
            exploreHoverTimeout = setTimeout(function() {
                var carousel = document.getElementById('exploreCarousel');
                var bsCarousel = bootstrap.Carousel.getOrCreateInstance(carousel);
                bsCarousel.next();
            }, 1000); // 1000ms = 1 second delay
        });
        el.addEventListener('mouseleave', function() {
            clearTimeout(exploreHoverTimeout);
        });
    });

    // Sync custom dots with carousel
    var exploreCarousel = document.getElementById('exploreCarousel');
    var dots = document.querySelectorAll('#customExploreDots .explore-dot');
    if (exploreCarousel) {
        exploreCarousel.addEventListener('slid.bs.carousel', function (e) {
            dots.forEach(function(dot, idx) {
                dot.style.background = (idx === e.to) ? '#333' : '#bbb';
                dot.classList.toggle('active', idx === e.to);
            });
        });
    }

    // Multi-effect Scroll Animation Script
    let lastScrollY = window.scrollY;
    function animateOnScroll() {
        var elements = document.querySelectorAll('.scroll-animate, .scroll-animate-stagger');
        var windowHeight = window.innerHeight;
        let currentScrollY = window.scrollY;
        let direction = currentScrollY > lastScrollY ? 'down' : 'up';
        elements.forEach(function(el) {
            var rect = el.getBoundingClientRect();
            if (rect.top < windowHeight - 60) {
                el.classList.add('visible');
                // Multi-effect: toggle effect class based on scroll direction
                if (el.classList.contains('fade-up') || el.classList.contains('fade-down') || el.classList.contains('scale-in')) {
                    el.classList.remove('fade-up', 'fade-down', 'scale-in');
                    if (direction === 'down') {
                        el.classList.add('fade-up');
                    } else {
                        el.classList.add('fade-down');
                    }
                }
            } else {
                el.classList.remove('visible');
            }
        });
        lastScrollY = currentScrollY;
    }
    document.addEventListener('scroll', animateOnScroll);
    document.addEventListener('DOMContentLoaded', animateOnScroll);
    window.addEventListener('resize', animateOnScroll);
    setTimeout(animateOnScroll, 100);

    // Client-side validation for contact form
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        let valid = true;
        const form = e.target;
        // Name
        if (!form.name.value.trim()) {
            form.name.classList.add('is-invalid');
            valid = false;
        } else {
            form.name.classList.remove('is-invalid');
        }
        // Contact
        if (!form.contact.value.trim()) {
            form.contact.classList.add('is-invalid');
            valid = false;
        } else {
            form.contact.classList.remove('is-invalid');
        }
        // Email
        if (!form.email.value.trim() || !form.email.value.match(/^[^@]+@[^@]+\.[^@]+$/)) {
            form.email.classList.add('is-invalid');
            valid = false;
        } else {
            form.email.classList.remove('is-invalid');
        }
        // Message
        if (!form.message.value.trim()) {
            form.message.classList.add('is-invalid');
            valid = false;
        } else {
            form.message.classList.remove('is-invalid');
        }
        if (!valid) {
            e.preventDefault();
        }
    });
    </script>
    <style>
        /* Turnstile alignment: center and constrain so it lines up with inputs */
        .turnstile-container {
            max-width: 420px;
            margin: 8px auto 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .turnstile-container .cf-turnstile {
            display: inline-flex !important;
            justify-content: center;
            align-items: center;
        }
        @media (max-width: 480px) {
            .turnstile-container { max-width: 100%; padding: 0 12px; }
        }
    </style>
</body>
</html>