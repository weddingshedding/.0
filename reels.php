<?php require_once __DIR__ . '/config.php'; $seo_title='Reels | '.setting('business_name'); include __DIR__.'/partials/header.php'; $reels=get_media('reel'); ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">Instagram Reels</span><h1>Wedding Reels</h1><p>Short, vertical and share-ready wedding highlights.</p></div></section>
  <section class="section"><div class="container"><div class="grid grid-3">
    <?php foreach($reels as $reel): ?>
      <article class="glass-card media-card reveal" data-lightbox data-type="video" data-src="<?= e($reel['file_path']) ?>"><video src="<?= e($reel['file_path']) ?>" muted playsinline preload="metadata"></video><div class="media-caption"><strong><?= e($reel['title']) ?></strong><br><span><?= e($reel['category']) ?></span></div></article>
    <?php endforeach; ?>
  </div></div></section>
</main><div class="lightbox"><button class="lightbox-close" aria-label="Close">×</button><div class="lightbox-content"></div></div>
<?php include __DIR__.'/partials/footer.php'; ?>
