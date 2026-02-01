<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./assets/restease-logo.png">
    <title>About Us - RestEase</title>
    <!-- Add Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/about-us.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/RE Logo New.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about-us.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact</a></li>
                    <li class="nav-item"><a class="btn btn-signin" href="login.php">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Us Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="about-badge fade-in-up delay-1">About RestEase</span>
                    <h1 class="fade-in-up delay-2">Transforming Cemetery Management with <span class="highlight-text">Digital Innovation</span></h1>
                    <p class="fade-in-up delay-3">RestEase is a cutting-edge digital cemetery management system designed to help Padre Garcia keep records organized, certificates updated, and families informed with secure and efficient services. We bring peace of mind through technology.</p>
                    <div class="hero-stats fade-in-up delay-4">
                        <div class="stat-item">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Records Managed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Families Served</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Digital</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-grid fade-in-up delay-2">
                        <div class="grid-item item-1">
                            <img src="assets/abt1.webp" alt="Team Member 1">
                        </div>
                        <div class="grid-item item-2">
                            <img src="assets/abt2.webp" alt="Team Member 2">
                        </div>
                        <div class="grid-item item-3">
                            <img src="assets/abt3.webp" alt="Team Member 3">
                        </div>
                        <div class="grid-item item-4">
                            <img src="assets/abt4.webp" alt="Team Member 4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Are Section -->
    <section class="who-we-are-section">
        <div class="container">
            <h2>Who we are</h2>
            <div class="main-description">
                <p>RestEase is an innovative online niche management system designed to streamline record-keeping, certificate issuance, and renewal processes for the Municipal Planning and Development Offices of Padre Garcia, Batangas. It simplifies tracking niches, renewals, and documents while providing a 2d mapping feature for easy reference.</p>
            </div>

            <div class="mission-vision">
                <div class="our-mission">
                    <h3>Our Mission</h3>
                    <p>Our mission is to modernize ossuary niche management by offering a digital platform that enhances organization, transparency, and accessibility. We aim to simplify niche tracking, document management, and renewal processes while ensuring families can easily locate and honor their loved ones.</p>
                </div>
                <div class="our-vision">
                    <h3>Our Vision</h3>
                    <p>We envision a future where cemetery and niche management is seamlessly digital, reducing administrative burdens while preserving historical and cultural records. RestEase aspires to be the leading niche management system, bringing innovation, efficiency, and peace of mind to local governments and communities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="what-we-do-section">
        <div class="container">
            <h3>What we do</h3>
            <div class="divider"></div>
            
            <div class="content-section">
                <p>RestEase provides a comprehensive digital solution for managing niche records, ensuring efficient tracking, documentation, and certificate issuance. Our system is designed to support local government offices in handling cemetery operations with ease and precision.
                </p>
            </div>

            <div class="content-section">
               <ul>
                <li>Digitally map and organize niches for efficient management.</li>
                <li>Implement issuance and renewal of niches certificates.</li>
                <li>Offer a user-friendly interface for the public to search for niches.</li>
                <li>Improve record security and accuracy through a centralized database.</li>
               </ul>
            </div>

            <h3>Building a Future of Efficient Memorial Management</h3><br>
            <div class="content-section">
                <p>
                    RestEase is committed to transforming how cemetery and niche records are managed. By integrating modern technology into traditional processes, we eliminate inefficiencies and ensure that every record is well-documented, easily accessible, and securely stored. Our system is designed not only to assist administrators but also to provide families with a seamless way to locate and honor their loved ones without the hassle of manual record searching. As we continue to innovate, RestEase aims to set the standard for digital cemetery management—making memorial record-keeping simpler, more transparent, and future-ready for generations to come.</p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="section-divider"></div>
    </div>
    <?php include 'Includes/footer.php'; ?>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
