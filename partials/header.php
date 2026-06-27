<?php
$seo_title = $seo_title ?? setting('business_name') . ' | Premium Wedding Photography';
$seo_description = $seo_description ?? setting('hero_description');
$body_class = $body_class ?? '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($seo_title) ?></title>
  <meta name="description" content="<?= e($seo_description) ?>">
  <meta name="keywords" content="wedding photography, pre wedding shoot, candid photography, traditional photography, wedding video, cinematic wedding video, drone shoot, wedding shedding">
  <meta name="robots" content="index,follow">
  <meta property="og:title" content="<?= e($seo_title) ?>">
  <meta property="og:description" content="<?= e($seo_description) ?>">
  <meta property="og:image" content="<?= e(setting('hero_background_image')) ?>">
  <link rel="icon" href="<?= e(setting('logo_path')) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <?= seo_schema() ?>
</head>
<body class="<?= e($body_class) ?>">
<div class="premium-loader"><div class="loader-ring"></div></div>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="logo" href="index.php" aria-label="Wedding Shedding Home">
      <img src="<?= e(setting('logo_path')) ?>" alt="<?= e(setting('business_name')) ?> Logo">
    </a>
    <nav class="nav-links" aria-label="Main Navigation">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="services.php">Services</a>
      <a href="gallery.php">Photo Gallery</a>
      <a href="videos.php">Video Gallery</a>
      <a href="reels.php">Reels</a>
      <a href="contact.php">Contact</a>
    </nav>
    <button class="menu-toggle" aria-label="Open menu">☰</button>
  </div>
</header>
<a class="secret-admin" href="sonu.php" aria-label="Secret admin button">SONU</a>
<div class="float-actions" aria-label="Quick contact buttons">
  <a href="<?= e(setting('whatsapp_link')) ?>" target="_blank" rel="noopener" title="WhatsApp">WA</a>
  <a href="tel:<?= e(setting('call_number')) ?>" title="Call">☎</a>
  <a class="review" href="<?= e(setting('google_review_link')) ?>" target="_blank" rel="noopener" title="Google Review">★</a>
</div>
