<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-logo">
      <img src="<?= e(setting('logo_path')) ?>" alt="<?= e(setting('business_name')) ?> Logo">
      <h4><?= e(setting('business_name')) ?></h4>
      <p><?= e(setting('tagline')) ?></p>
    </div>
    <div>
      <h4>Pages</h4>
      <a href="about.php">About</a>
      <a href="services.php">Services</a>
      <a href="gallery.php">Photo Gallery</a>
      <a href="videos.php">Video Gallery</a>
      <a href="reels.php">Reels</a>
    </div>
    <div>
      <h4>Contact</h4>
      <a href="<?= e(setting('whatsapp_link')) ?>" target="_blank" rel="noopener">WhatsApp: <?= e(setting('whatsapp_number')) ?></a>
      <a href="tel:<?= e(setting('call_number')) ?>">Call Now</a>
      <a href="<?= e(setting('google_review_link')) ?>" target="_blank" rel="noopener">Google Reviews</a>
    </div>
  </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js" defer></script>
<script src="assets/js/main.js" defer></script>
</body>
</html>
