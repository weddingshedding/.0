<?php require_once __DIR__ . '/config.php'; $seo_title='Video Gallery | '.setting('business_name'); include __DIR__.'/partials/header.php'; $videos=get_media('video'); ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">Video Gallery</span><h1>Cinematic Wedding Video</h1><p>Wedding films, cinematic highlights and professional video samples.</p></div></section>
  <section class="section"><div class="container"><div class="grid grid-3">
    <?php foreach($videos as $video): ?>
      <article class="glass-card media-card reveal" data-lightbox data-type="video" data-src="<?= e($video['file_path']) ?>"><video src="<?= e($video['file_path']) ?>" muted playsinline preload="metadata"></video><div class="media-caption"><strong><?= e($video['title']) ?></strong><br><span><?= e($video['category']) ?></span></div></article>
    <?php endforeach; ?>
  </div></div></section>
</main><div class="lightbox"><button class="lightbox-close" aria-label="Close">×</button><div class="lightbox-content"></div></div>
<?php include __DIR__.'/partials/footer.php'; ?>
