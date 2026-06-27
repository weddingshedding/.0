<?php require_once __DIR__ . '/config.php'; $seo_title='About | '.setting('business_name'); include __DIR__.'/partials/header.php'; ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">About Studio</span><h1>Wedding Shedding</h1><p>Premium photography, cinematic films and wedding shedding services for elegant celebrations.</p></div></section>
  <section class="section"><div class="container split">
    <div class="glass-card reveal"><img src="<?= e(setting('hero_background_image')) ?>" alt="About Wedding Shedding"></div>
    <div class="reveal"><h2 class="gold-text" style="font-family:Playfair Display,Georgia,serif;font-size:54px;line-height:1.05;">A premium wedding visual experience.</h2><p style="color:var(--muted);line-height:1.8;">We capture wedding stories with a clean luxury look, natural emotions, cinematic lighting and professional editing. Our work covers weddings, engagements, receptions, haldi, mehndi, family functions and pre-wedding shoots.</p><ul class="feature-list"><li>✓ Professional wedding photography</li><li>✓ Cinematic wedding films and reels</li><li>✓ Drone shoot and premium gallery delivery</li></ul><a class="btn btn-gold" href="contact.php">Contact Now</a></div>
  </div></section>
</main>
<?php include __DIR__.'/partials/footer.php'; ?>
