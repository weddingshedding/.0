<?php require_once __DIR__ . '/config.php'; $seo_title='Photo Gallery | '.setting('business_name'); include __DIR__.'/partials/header.php'; $photos=get_media('photo'); $cats=array_values(array_unique(array_map(fn($p)=>$p['category'],$photos))); ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">Photo Gallery</span><h1>Premium Wedding Frames</h1><p>Instagram-style filtering, lazy loading and lightbox viewer.</p></div></section>
  <section class="section"><div class="container"><div class="filter-bar"><button class="filter-btn active" data-filter="all">All</button><?php foreach($cats as $cat): ?><button class="filter-btn" data-filter="<?= e($cat) ?>"><?= e($cat) ?></button><?php endforeach; ?></div><div class="grid grid-3">
    <?php foreach($photos as $photo): ?>
      <article class="glass-card media-card reveal" data-category="<?= e($photo['category']) ?>" data-lightbox data-type="image" data-src="<?= e($photo['file_path']) ?>"><img src="<?= e($photo['file_path']) ?>" alt="<?= e($photo['alt_text'] ?: $photo['title']) ?>" loading="lazy"><div class="media-caption"><strong><?= e($photo['title']) ?></strong><br><span><?= e($photo['category']) ?></span></div></article>
    <?php endforeach; ?>
  </div></div></section>
</main><div class="lightbox"><button class="lightbox-close" aria-label="Close">×</button><div class="lightbox-content"></div></div>
<?php include __DIR__.'/partials/footer.php'; ?>
