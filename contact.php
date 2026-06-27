<?php require_once __DIR__ . '/config.php';
$seo_title='Contact | '.setting('business_name'); $sent='';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $msg = [
        'name'=>trim($_POST['name'] ?? ''), 'phone'=>trim($_POST['phone'] ?? ''), 'email'=>trim($_POST['email'] ?? ''),
        'event_date'=>trim($_POST['event_date'] ?? ''), 'message'=>trim($_POST['message'] ?? '')
    ];
    if ($msg['name'] && $msg['phone']) { save_contact_message($msg); $sent='Your enquiry has been saved. We will contact you soon.'; }
    else { $sent='Please enter name and phone number.'; }
}
include __DIR__.'/partials/header.php'; ?>
<main>
  <section class="page-head"><div class="container"><span class="eyebrow">Contact</span><h1>Book Wedding Shedding</h1><p>WhatsApp, call, review and contact form included.</p></div></section>
  <section class="section"><div class="container grid grid-2">
    <div class="glass-card contact-card reveal"><h3>Contact Details</h3><p><strong>Business:</strong> <?= e(setting('business_name')) ?></p><p><strong>WhatsApp:</strong> <?= e(setting('whatsapp_number')) ?></p><p><strong>Address:</strong> <?= e(setting('contact_address')) ?></p><div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:22px"><a class="btn btn-primary" href="<?= e(setting('whatsapp_link')) ?>" target="_blank">WhatsApp</a><a class="btn btn-gold" href="tel:<?= e(setting('call_number')) ?>">Call</a><a class="btn btn-ghost" href="<?= e(setting('google_review_link')) ?>" target="_blank">Google Review</a></div></div>
    <form class="glass-card contact-card contact-form reveal" method="post"><h3>Send Enquiry</h3><?php if($sent): ?><div class="alert"><?= e($sent) ?></div><?php endif; ?><label>Name</label><input name="name" required><label>Phone</label><input name="phone" required><label>Email</label><input name="email" type="email"><label>Event Date</label><input name="event_date" type="date"><label>Message</label><textarea name="message" placeholder="Wedding date, location and services required"></textarea><button class="btn btn-gold" type="submit">Submit Enquiry</button></form>
  </div></section>
  <section class="section map"><div class="container"><iframe src="<?= e(setting('map_embed')) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div></section>
</main>
<?php include __DIR__.'/partials/footer.php'; ?>
