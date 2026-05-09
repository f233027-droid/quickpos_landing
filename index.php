<?php session_start(); // QuickPOS - POS-8 POS-9 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPOS - Smart Point of Sale System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <i class="fas fa-cash-register"></i> QuickPOS™
            </div>
            <nav class="nav">
                <a href="#features">Features</a>
                <a href="#pricing">Pricing</a>
                <a href="#contact">Contact</a>
            </nav>
            <a href="#contact" class="btn btn-primary">Sign Up Free</a>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <h1>Sell Smarter with <span class="highlight">QuickPOS™</span></h1>
            <p>The fastest, easiest point-of-sale system for modern businesses. Manage sales, inventory, and staff from one dashboard.</p>
            <a href="#contact" class="btn btn-hero">Get Started Free &rarr;</a>
            <div class="hero-stats">
                <div class="stat"><strong>10,000+</strong><span>Businesses</span></div>
                <div class="stat"><strong>99.9%</strong><span>Uptime</span></div>
                <div class="stat"><strong>24/7</strong><span>Support</span></div>
            </div>
        </div>
    </section>

<!-- FEATURES -->
<section id="features" class="features">
  <div class="container">
    <h2 class="section-title">Why Choose QuickPOS?</h2>
    <p class="section-subtitle">Everything you need to run your business smoothly</p>
    <div class="features-grid">
      <div class="feature-card">
        <i class="fas fa-bolt"></i>
        <h3>Lightning Fast</h3>
        <p>Process sales in under 2 seconds. No lag, no waiting, no lost customers.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-chart-line"></i>
        <h3>Real-Time Reports</h3>
        <p>Live dashboards showing your daily sales, top products, and revenue trends.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-mobile-alt"></i>
        <h3>Works on Any Device</h3>
        <p>Desktop, tablet, or phone — QuickPOS adapts perfectly to your setup.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-shield-alt"></i>
        <h3>Secure &amp; Reliable</h3>
        <p>Bank-grade encryption with 99.9% uptime guarantee. Your data is always safe.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-sync-alt"></i>
        <h3>Auto Sync</h3>
        <p>All your data syncs instantly across every device and location in real time.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-headset"></i>
        <h3>24/7 Support</h3>
        <p>Our expert team is available around the clock to help you solve any issue.</p>
      </div>
    </div>
  </div>
</section>

    <!-- PRICING -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2 class="section-title">Simple, Transparent Pricing</h2>
            <p class="section-subtitle">No hidden fees. Cancel anytime. 14-day free trial on all plans.</p>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Basic</h3>
                    <div class="price">$9<span>/mo</span></div>
                    <p class="plan-desc">Perfect for small shops</p>
                    <ul>
                        <li>✅ 1 Terminal</li>
                        <li>✅ Basic Sales Reports</li>
                        <li>✅ Email Support</li>
                        <li>✅ Up to 500 products</li>
                        <li>✅ Daily backups</li>
                        <li>❌ Multi-location</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline">Start Free Trial</a>
                </div>
                <div class="pricing-card featured">
                    <span class="badge">Most Popular</span>
                    <h3>Pro</h3>
                    <div class="price">$29<span>/mo</span></div>
                    <p class="plan-desc">For growing businesses</p>
                    <ul>
                        <li>✅ 5 Terminals</li>
                        <li>✅ Advanced Analytics</li>
                        <li>✅ Priority Support</li>
                        <li>✅ Unlimited products</li>
                        <li>✅ Real-time sync</li>
                        <li>✅ Multi-location</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary">Start Free Trial</a>
                </div>
                <div class="pricing-card">
                    <h3>Enterprise</h3>
                    <div class="price">$99<span>/mo</span></div>
                    <p class="plan-desc">For large operations</p>
                    <ul>
                        <li>✅ Unlimited Terminals</li>
                        <li>✅ Custom Reports</li>
                        <li>✅ 24/7 Dedicated Support</li>
                        <li>✅ API Access</li>
                        <li>✅ White labeling</li>
                        <li>✅ SLA guarantee</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="form-wrapper">
                <?php 
                $errors = []; 
                if (isset($_SESSION['errors'])) {
                    $errors = $_SESSION['errors']; 
                    unset($_SESSION['errors']); 
                } 
                $success = isset($_GET['success']) ? $_GET['success'] : ''; 
                ?>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error">
                        <?php foreach($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="process_form.php" method="POST" class="contact-form">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Send Message <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <i class="fas fa-cash-register"></i> QuickPOS™
                    <p>Smart selling for modern businesses.</p>
                </div>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> QuickPOS. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
