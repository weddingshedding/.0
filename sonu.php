<?php require_once __DIR__ . '/config.php';
if (!empty($_SESSION['ws_admin'])) { header('Location: admin/dashboard.php'); exit; }
$error='';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $id = trim($_POST['private_id'] ?? '');
    $pass = trim($_POST['private_password'] ?? '');
    if (admin_valid($id, $pass)) {
        session_regenerate_id(true);
        $_SESSION['ws_admin'] = true;
        header('Location: admin/dashboard.php'); exit;
    }
    $error = 'Private details are incorrect.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow,noarchive"><title>Private Panel</title><link rel="stylesheet" href="assets/css/admin.css"></head><body>
<main class="admin-login"><form class="login-card" method="post" autocomplete="off"><img class="preview-logo" src="<?= e(setting('logo_path')) ?>" alt="Logo"><h1>SONU Private Panel</h1><p class="muted" style="text-align:center">Hidden admin page. ID and password are not shown publicly.</p><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?><label>Private ID</label><input type="password" name="private_id" placeholder="Private ID" inputmode="numeric" required autocomplete="off"><label>Password</label><input type="password" name="private_password" placeholder="Password" required autocomplete="new-password"><button class="btn" type="submit">Open Dashboard</button> <a class="btn gold" href="index.php">Back</a></form></main>
</body></html>
