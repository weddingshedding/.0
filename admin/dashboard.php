<?php require_once __DIR__ . '/../config.php'; require_admin();
$notice=''; $error='';
try {
  if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'save_text') {
      foreach (['business_name','tagline','hero_heading','hero_description','whatsapp_number','whatsapp_link','call_number','google_review_link','contact_email','contact_address','map_embed'] as $key) update_setting($key, trim($_POST[$key] ?? ''));
      $notice = 'Website text and contact details saved.';
    }
    if ($action === 'upload_logo') {
      $path = upload_file('logo', 'uploads/logo', ['jpg','jpeg','png','webp','gif','svg']); if ($path) update_setting('logo_path', $path); $notice='Logo updated.';
    }
    if ($action === 'upload_bg_image') {
      $path = upload_file('bg_image', 'uploads/backgrounds', ['jpg','jpeg','png','webp']); if ($path) update_setting('hero_background_image', $path); $notice='Homepage background image updated.';
    }
    if ($action === 'upload_bg_video') {
      $path = upload_file('bg_video', 'uploads/backgrounds', ['mp4','webm','mov']); if ($path) update_setting('hero_background_video', $path); $notice='Homepage background video updated.';
    }
    if ($action === 'clear_bg_video') { update_setting('hero_background_video', ''); $notice='Homepage background video removed.'; }
    if ($action === 'upload_service') {
      $key = $_POST['service_key'] ?? ''; $allowed = array_column(services_list(), 2);
      if (in_array($key, $allowed, true)) { $path = upload_file('service_image', 'uploads/services', ['jpg','jpeg','png','webp']); if ($path) update_setting($key, $path); $notice='Service image updated.'; }
    }
    if ($action === 'upload_media') {
      $type = $_POST['media_type'] ?? 'photo';
      $title = trim($_POST['title'] ?? ''); $cat = trim($_POST['category'] ?? 'General');
      $dir = $type === 'photo' ? 'uploads/photos' : ($type === 'video' ? 'uploads/videos' : 'uploads/reels');
      $ext = $type === 'photo' ? ['jpg','jpeg','png','webp','gif'] : ['mp4','webm','mov'];
      $path = upload_file('media_file', $dir, $ext); if ($path) { add_media($type, $title, $cat, $path, $title); $notice=ucfirst($type).' uploaded.'; }
    }
    if ($action === 'delete_media') { delete_media((int)($_POST['id'] ?? 0)); $notice='Media deleted.'; }
    if ($action === 'edit_media') { update_media_meta((int)($_POST['id'] ?? 0), trim($_POST['title'] ?? ''), trim($_POST['category'] ?? 'General')); $notice='Media updated.'; }
  }
} catch (Throwable $th) { $error = $th->getMessage(); }
$settings = get_settings(); $allMedia = get_all_media(); $messages = get_messages();
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Dashboard | Wedding Shedding</title><link rel="stylesheet" href="../assets/css/admin.css"></head><body>
<header class="topbar"><div class="topbar-inner"><div><strong style="color:var(--maroon)">Wedding Shedding Dashboard</strong><div class="db-badge"><?= db_ready() ? 'MySQL Connected' : 'Local storage active - website still works' ?></div></div><div><a class="btn gold" href="../index.php" target="_blank">View Website</a> <a class="btn" href="logout.php">Logout</a></div></div></header>
<main class="admin-wrap">
  <?php if($notice): ?><div class="alert"><?= e($notice) ?></div><?php endif; ?>
  <?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
  <div class="admin-grid">
    <section class="panel full"><h2>Manage Homepage Text & Contact Details</h2><form method="post"><input type="hidden" name="action" value="save_text"><label>Business Name</label><input name="business_name" value="<?= e($settings['business_name']) ?>"><label>Tagline</label><input name="tagline" value="<?= e($settings['tagline']) ?>"><label>Hero Heading</label><textarea name="hero_heading"><?= e($settings['hero_heading']) ?></textarea><label>Hero Description</label><textarea name="hero_description"><?= e($settings['hero_description']) ?></textarea><div style="display:grid;grid-template-columns:repeat(2,1fr);gap:14px"><div><label>WhatsApp Number</label><input name="whatsapp_number" value="<?= e($settings['whatsapp_number']) ?>"></div><div><label>WhatsApp Link</label><input name="whatsapp_link" value="<?= e($settings['whatsapp_link']) ?>"></div><div><label>Call Number</label><input name="call_number" value="<?= e($settings['call_number']) ?>"></div><div><label>Google Review Link</label><input name="google_review_link" value="<?= e($settings['google_review_link']) ?>"></div><div><label>Email</label><input name="contact_email" value="<?= e($settings['contact_email']) ?>"></div><div><label>Address</label><input name="contact_address" value="<?= e($settings['contact_address']) ?>"></div></div><label>Google Map Embed URL</label><input name="map_embed" value="<?= e($settings['map_embed']) ?>"><button class="btn gold" type="submit">Save Text</button></form></section>
    <section class="panel"><h2>Change Website Logo</h2><img src="../<?= e($settings['logo_path']) ?>" style="width:160px;max-height:120px;object-fit:contain;background:#fff;border-radius:18px;padding:6px"><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="upload_logo"><input type="file" name="logo" accept="image/*" required><button class="btn gold">Upload Logo</button></form></section>
    <section class="panel"><h2>Homepage Background</h2><img src="../<?= e($settings['hero_background_image']) ?>" style="width:100%;height:180px;object-fit:cover;border-radius:18px"><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="upload_bg_image"><input type="file" name="bg_image" accept="image/*" required><button class="btn gold">Upload Background Image</button></form><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="upload_bg_video"><input type="file" name="bg_video" accept="video/*"><button class="btn">Upload Background Video</button></form><form method="post"><input type="hidden" name="action" value="clear_bg_video"><button class="btn danger">Remove Background Video</button></form></section>
    <section class="panel full"><h2>Change Service Images</h2><div class="media-admin"><?php foreach(services_list() as $service): ?><div class="media-item"><img src="../<?= e(setting($service[2])) ?>"><strong><?= e($service[0]) ?></strong><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="upload_service"><input type="hidden" name="service_key" value="<?= e($service[2]) ?>"><input type="file" name="service_image" accept="image/*" required><button class="btn gold">Update</button></form></div><?php endforeach; ?></div></section>
    <section class="panel full"><h2>Upload Photos / Videos / Reels</h2><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="upload_media"><div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px"><div><label>Type</label><select name="media_type"><option value="photo">Photo</option><option value="video">Video</option><option value="reel">Reel</option></select></div><div><label>Title</label><input name="title" placeholder="Title"></div><div><label>Category</label><input name="category" placeholder="Wedding / Pre-Wedding / Candid"></div><div><label>File</label><input type="file" name="media_file" required></div></div><button class="btn gold">Upload Media</button></form></section>
    <section class="panel full"><h2>Edit / Delete Gallery</h2><div class="media-admin"><?php foreach($allMedia as $m): ?><div class="media-item"><?php if(($m['media_type'] ?? '')==='photo'): ?><img src="../<?= e($m['file_path']) ?>"><?php else: ?><video src="../<?= e($m['file_path']) ?>" controls></video><?php endif; ?><form method="post" class="mini-form"><input type="hidden" name="id" value="<?= (int)$m['id'] ?>"><input name="title" value="<?= e($m['title']) ?>"><input name="category" value="<?= e($m['category']) ?>"><button class="btn gold" name="action" value="edit_media">Save</button><button class="btn danger" name="action" value="delete_media" onclick="return confirm('Delete this item?')">Delete</button></form></div><?php endforeach; ?></div></section>
    <section class="panel full"><h2>Contact Form Messages</h2><?php if(!$messages): ?><p class="muted">No messages yet.</p><?php endif; ?><?php foreach($messages as $msg): ?><div class="media-item" style="margin-bottom:10px"><strong><?= e($msg['name'] ?? '') ?> - <?= e($msg['phone'] ?? '') ?></strong><p class="muted"><?= e($msg['message'] ?? '') ?></p><small><?= e($msg['created_at'] ?? '') ?> <?= e($msg['event_date'] ?? '') ?></small></div><?php endforeach; ?></section>
  </div>
</main></body></html>
