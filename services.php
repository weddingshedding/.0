<?php require_once __DIR__ . '/config.php'; $seo_title='Services | '.setting('business_name'); include __DIR__.'/partials/header.php'; $services=services_list(); ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">Premium Services</span><h1>Wedding Photography Services</h1><p>No decoration packages. Only photography, video, drone, reels and wedding shedding services.</p></div></section>
  <section class="section"><div class="container"><div class="grid grid-4">
    <?php foreach($services as $service): ?>
      <article class="glass-card service-card reveal"><img class="service-img" src="<?= e(setting($service[2])) ?>" alt="<?= e($service[0]) ?>" loading="lazy"><div class="card-body"><h3><?= e($service[0]) ?></h3><p><?= e($service[1]) ?></p><a class="btn btn-gold" href="<?= e(setting('whatsapp_link')) ?>" target="_blank">Book Now</a></div></article>
    <?php endforeach; ?>
  </div></div></section>
</main>
<?php include __DIR__.'/partials/footer.php'; ?>
