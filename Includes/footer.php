<!-- Add Font Awesome CDN for social icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
html, body {
    margin: 0;
    padding: 0;
}

.footer {
    background: linear-gradient(135deg, #0a2463 0%, #247ba0 100%);
    color: white;
    padding: 50px 20px 30px;
    margin: 0;
    position: relative;
    bottom: 0;
    width: 100%;
}

.footer .container {
    max-width: 1200px;
}

.footer-logo {
    height: 45px;
    width: auto;
    transition: transform 0.3s ease;
}

.footer-logo:hover {
    transform: scale(1.05);
}

.footer-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: white;
}

.footer-subtitle {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-weight: 500;
}

.footer-section-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: white;
}

.footer .list-unstyled a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer .list-unstyled a:hover {
    color: #64b5f6;
}

.footer .list-unstyled li {
    margin-bottom: 8px;
}

.footer-contact {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-contact i {
    color: #64b5f6;
    font-size: 1rem;
}

.footer-hr {
    border: 0;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    margin: 25px 0;
}

.footer-credit {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 400;
}

@media (max-width: 768px) {
    .footer {
        padding: 40px 20px 25px;
    }
    
    .footer-section-title {
        margin-top: 20px;
    }
}
</style>
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Logo and About Section -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="./assets/white.png" alt="RestEase Logo" class="footer-logo">
                    <div class="ms-2">
                        <h4 class="footer-title mb-0">RestEase</h4>
                        <p class="footer-subtitle">MPDO</p>
                    </div>
                </div>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.8); line-height: 1.5;">Honoring memories, simplifying legacy.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="footer-section-title">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="termscondtion.php">Terms</a></li>
                    <li><a href="privacy_policy.php">Privacy</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-section-title">Contact</h5>
                <p class="footer-contact">
                    <i class="fas fa-map-marker-alt"></i>
                    Banaba, Padre Garcia, Batangas
                </p>
                <p class="footer-contact">
                    <i class="fas fa-envelope"></i>
                    resteasempdo@gmail.com
                </p>
                <p class="footer-contact">
                    <i class="fas fa-phone"></i>
                    +0923-456-789
                </p>
            </div>

            <!-- Tagline -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="footer-section-title">About RestEase</h5>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.8); line-height: 1.6; margin: 0;">RestEase brings clarity, care, and convenience to every remembrance. Digitizing cemetery management for Padre Garcia.</p>
            </div>
        </div>

        <div class="footer-hr"></div>

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="footer-credit mb-0">&copy; 2025 RestEase. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="footer-credit mb-0">Designed with <i class="fas fa-heart" style="color: #ff6b6b;"></i> by RestEase Team</p>
            </div>
        </div>
    </div>
</footer>