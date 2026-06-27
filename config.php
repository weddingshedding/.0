<?php
/**
 * Wedding Shedding - Working Hosting Ready Configuration
 * Front website works without database. If MySQL is configured, admin/media/contact data also syncs to MySQL.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Asia/Kolkata');

// Optional MySQL. Keep DB_ENABLED false until database.sql is imported and credentials are correct.
const DB_ENABLED = false;
const DB_HOST = 'localhost';
const DB_NAME = 'wedding_shedding';
const DB_USER = 'root';
const DB_PASS = '';

// Admin private ID and password are stored only as bcrypt hashes. Do not write plain details here.
const ADMIN_ID_HASH = '$2y$12$A7TRwBP/paZf.oVE1kQ4tuBpF9ar7CtDNIiwt3tT2n8kOwaLLBSw.';
const ADMIN_PASS_HASH = '$2y$12$sv6HP8RFa.u14A6hxbfNNexm75qSR9Z1H5NgkY1uGQz5ctvk5aWAK';

function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function project_root(): string { return __DIR__; }
function data_file(): string { return project_root() . '/data/storage.json'; }
function now_stamp(): string { return date('Y-m-d H:i:s'); }

function db(): ?PDO {
    static $pdo = null;
    static $checked = false;
    if ($checked) return $pdo;
    $checked = true;
    if (!DB_ENABLED) return null;
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (Throwable $th) { $pdo = null; }
    return $pdo;
}
function db_ready(): bool { return db() instanceof PDO; }

function default_settings(): array {
    return [
        'business_name' => 'Wedding Shedding',
        'tagline' => 'Premium Wedding Photography & Cinematic Films',
        'logo_path' => 'assets/images/logo.png',
        'hero_background_image' => 'assets/images/hero.jpg',
        'hero_background_video' => '',
        'hero_heading' => "Professional Wedding Photography,\nCinematic Wedding Video &\nWedding Shedding Services",
        'hero_description' => 'We provide professional wedding photography, pre-wedding shoots, candid photography, traditional photography, wedding videos, cinematic wedding films, drone shoots and wedding shedding services for weddings, engagements, receptions and family functions.',
        'whatsapp_number' => '+91 7503550936',
        'whatsapp_link' => 'https://wa.me/917503550936',
        'call_number' => '+917503550936',
        'google_review_link' => 'https://g.page/r/CaNUqaPpp9tuEBM/review',
        'contact_email' => 'booking@weddingshedding.com',
        'contact_address' => 'India',
        'map_embed' => 'https://www.google.com/maps?q=Wedding%20Photography%20India&output=embed',
        'service_wedding_photography' => 'assets/images/photo-10.jpg',
        'service_pre_wedding_shoot' => 'assets/images/photo-13.jpg',
        'service_candid_photography' => 'assets/images/photo-01.jpg',
        'service_traditional_photography' => 'assets/images/photo-04.jpg',
        'service_wedding_video' => 'assets/images/hero.jpg',
        'service_cinematic_wedding_video' => 'assets/images/photo-11.jpg',
        'service_drone_shoot' => 'assets/images/photo-12.jpg',
        'service_wedding_shedding' => 'assets/images/photo-02.jpg',
    ];
}

function default_media(): array {
    $photos = [];
    $titles = [
        'Wedding Couple Cinematic', 'Haldi Celebration', 'Haldi Candid Smile', 'Bride Groom Haldi', 'Couple Joy Moment', 'Family Haldi Function',
        'Bride Groom Portrait', 'Royal Laugh Moment', 'Wedding Close-up', 'Outdoor Pre Wedding', 'Pre Wedding Car Shoot', 'Bride Portrait',
        'Premium Couple Shoot', 'Album Style Layout', 'Function Candid', 'Family Selfie Moment', 'Bridal Haldi Portrait', 'Groom Ceremony Portrait',
        'Premium Bride Styling', 'Wedding Story Frame', 'Luxury Couple Memory', 'Traditional Couple Frame', 'Candid Wedding Day', 'Wedding Ritual Moment',
        'Reception Portrait', 'Family Function Moment', 'Engagement Memory', 'Bridal Story', 'Cinematic Wedding Smile'
    ];
    for ($i=1; $i<=29; $i++) {
        $num = str_pad((string)$i, 2, '0', STR_PAD_LEFT);
        $path = "assets/images/photo-$num.jpg";
        if (is_file(project_root() . '/' . $path)) {
            $photos[] = [
                'id' => 1000 + $i,
                'media_type' => 'photo',
                'title' => $titles[$i-1] ?? "Wedding Photo $num",
                'category' => ($i <= 9 ? 'Wedding' : ($i <= 16 ? 'Pre-Wedding' : 'Candid')),
                'file_path' => $path,
                'alt_text' => 'Wedding Shedding premium photography',
                'sort_order' => $i,
                'created_at' => now_stamp(),
            ];
        }
    }
    $videos = [
        ['id'=>5001,'media_type'=>'video','title'=>'Cinematic Wedding Film','category'=>'Wedding Video','file_path'=>'assets/videos/sample-video.mp4','alt_text'=>'Cinematic wedding film','sort_order'=>1,'created_at'=>now_stamp()],
        ['id'=>6001,'media_type'=>'reel','title'=>'Instagram Wedding Reel','category'=>'Reels','file_path'=>'assets/videos/sample-reel.mp4','alt_text'=>'Wedding reel highlight','sort_order'=>1,'created_at'=>now_stamp()],
    ];
    return array_merge($photos, $videos);
}

function default_storage(): array {
    return ['settings'=>default_settings(), 'media'=>default_media(), 'messages'=>[], 'next_media_id'=>9001, 'next_message_id'=>1];
}

function ensure_storage(): void {
    if (!is_dir(project_root() . '/data')) mkdir(project_root() . '/data', 0755, true);
    $deny = project_root() . '/data/.htaccess';
    if (!is_file($deny)) file_put_contents($deny, "Require all denied\nDeny from all\n");
    if (!is_file(data_file())) save_storage(default_storage());
}

function load_storage(): array {
    ensure_storage();
    $raw = file_get_contents(data_file());
    $data = json_decode($raw ?: '', true);
    if (!is_array($data)) $data = default_storage();
    $seed = default_storage();
    $data['settings'] = array_merge($seed['settings'], $data['settings'] ?? []);
    $data['media'] = array_values($data['media'] ?? $seed['media']);
    if (count($data['media']) < 5) $data['media'] = $seed['media'];
    $data['messages'] = array_values($data['messages'] ?? []);
    $data['next_media_id'] = max((int)($data['next_media_id'] ?? 9001), 9001);
    $data['next_message_id'] = max((int)($data['next_message_id'] ?? 1), 1);
    return $data;
}

function save_storage(array $data): void {
    if (!is_dir(project_root() . '/data')) mkdir(project_root() . '/data', 0755, true);
    file_put_contents(data_file(), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function get_settings(): array {
    $settings = default_settings();
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->query('SELECT setting_key, setting_value FROM settings');
            foreach ($stmt as $row) if ($row['setting_value'] !== '') $settings[$row['setting_key']] = $row['setting_value'];
            return $settings;
        } catch (Throwable $th) {}
    }
    $data = load_storage();
    return array_merge($settings, $data['settings'] ?? []);
}
function setting(string $key, string $fallback = ''): string {
    $settings = get_settings();
    return (string)($settings[$key] ?? $fallback);
}
function update_setting(string $key, string $value): void {
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
            $stmt->execute([$key, $value]);
        } catch (Throwable $th) {}
    }
    $data = load_storage();
    $data['settings'][$key] = $value;
    save_storage($data);
}

function get_media(string $type = 'photo', ?string $category = null, int $limit = 200): array {
    $pdo = db();
    if ($pdo) {
        try {
            if ($category) {
                $stmt = $pdo->prepare('SELECT * FROM media WHERE media_type=? AND category=? ORDER BY sort_order ASC, id DESC LIMIT ' . (int)$limit);
                $stmt->execute([$type, $category]);
            } else {
                $stmt = $pdo->prepare('SELECT * FROM media WHERE media_type=? ORDER BY sort_order ASC, id DESC LIMIT ' . (int)$limit);
                $stmt->execute([$type]);
            }
            $rows = $stmt->fetchAll();
            if ($rows) return $rows;
        } catch (Throwable $th) {}
    }
    $data = load_storage();
    $rows = array_values(array_filter($data['media'], fn($m) => ($m['media_type'] ?? '') === $type && (!$category || ($m['category'] ?? '') === $category)));
    usort($rows, fn($a,$b) => (($a['sort_order'] ?? 999) <=> ($b['sort_order'] ?? 999)) ?: (($b['id'] ?? 0) <=> ($a['id'] ?? 0)));
    return array_slice($rows, 0, $limit);
}
function get_all_media(): array {
    $data = load_storage();
    return $data['media'];
}
function add_media(string $type, string $title, string $category, string $filePath, string $alt=''): void {
    $data = load_storage();
    $id = (int)$data['next_media_id'];
    $row = ['id'=>$id, 'media_type'=>$type, 'title'=>$title ?: ucfirst($type), 'category'=>$category ?: 'General', 'file_path'=>$filePath, 'alt_text'=>$alt, 'sort_order'=>$id, 'created_at'=>now_stamp()];
    $data['media'][] = $row;
    $data['next_media_id'] = $id + 1;
    save_storage($data);
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare('INSERT INTO media (media_type,title,category,file_path,alt_text,sort_order,created_at) VALUES (?,?,?,?,?,?,?)');
            $stmt->execute([$type,$row['title'],$row['category'],$filePath,$alt,$row['sort_order'],$row['created_at']]);
        } catch (Throwable $th) {}
    }
}
function delete_media(int $id): void {
    $data = load_storage();
    $deletePath = '';
    $data['media'] = array_values(array_filter($data['media'], function($m) use ($id, &$deletePath) {
        if ((int)($m['id'] ?? 0) === $id) { $deletePath = (string)($m['file_path'] ?? ''); return false; }
        return true;
    }));
    save_storage($data);
    if ($deletePath && str_starts_with($deletePath, 'uploads/')) {
        $full = project_root() . '/' . $deletePath;
        if (is_file($full)) @unlink($full);
    }
    $pdo = db();
    if ($pdo) {
        try { $stmt = $pdo->prepare('DELETE FROM media WHERE id=?'); $stmt->execute([$id]); } catch (Throwable $th) {}
    }
}
function update_media_meta(int $id, string $title, string $category): void {
    $data = load_storage();
    foreach ($data['media'] as &$m) {
        if ((int)$m['id'] === $id) { $m['title'] = $title; $m['category'] = $category; }
    }
    unset($m);
    save_storage($data);
    $pdo = db();
    if ($pdo) {
        try { $stmt = $pdo->prepare('UPDATE media SET title=?, category=? WHERE id=?'); $stmt->execute([$title,$category,$id]); } catch (Throwable $th) {}
    }
}

function admin_valid(string $id, string $pass): bool {
    return password_verify($id, ADMIN_ID_HASH) && password_verify($pass, ADMIN_PASS_HASH);
}
function require_admin(): void {
    if (empty($_SESSION['ws_admin'])) { header('Location: ../sonu.php'); exit; }
}
function save_contact_message(array $msg): void {
    $data = load_storage();
    $msg['id'] = (int)$data['next_message_id'];
    $msg['created_at'] = now_stamp();
    $data['messages'][] = $msg;
    $data['next_message_id'] = $msg['id'] + 1;
    save_storage($data);
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare('INSERT INTO contact_messages (name,phone,email,event_date,message,created_at) VALUES (?,?,?,?,?,?)');
            $stmt->execute([$msg['name'] ?? '', $msg['phone'] ?? '', $msg['email'] ?? '', $msg['event_date'] ?? '', $msg['message'] ?? '', $msg['created_at']]);
        } catch (Throwable $th) {}
    }
}
function get_messages(): array { $data = load_storage(); return array_reverse($data['messages']); }

function upload_file(string $field, string $targetDir, array $allowedExt): ?string {
    if (empty($_FILES[$field]['name']) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) return null;
    $name = $_FILES[$field]['name'];
    $tmp = $_FILES[$field]['tmp_name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) throw new RuntimeException('Invalid file type.');
    $relativeDir = trim($targetDir, '/');
    $fullDir = project_root() . '/' . $relativeDir;
    if (!is_dir($fullDir)) mkdir($fullDir, 0755, true);
    $safe = preg_replace('/[^a-zA-Z0-9._-]+/', '-', pathinfo($name, PATHINFO_FILENAME));
    $file = $safe . '-' . time() . '-' . random_int(100,999) . '.' . $ext;
    $dest = $fullDir . '/' . $file;
    if (!move_uploaded_file($tmp, $dest)) throw new RuntimeException('Upload failed. Check folder permission.');
    return $relativeDir . '/' . $file;
}

function services_list(): array {
    return [
        ['Wedding Photography','Royal ceremony coverage with clean premium editing.','service_wedding_photography'],
        ['Pre-Wedding Shoot','Outdoor, couple, romantic and concept-based pre-wedding shoot.','service_pre_wedding_shoot'],
        ['Candid Photography','Natural family emotions, smiles and moments captured beautifully.','service_candid_photography'],
        ['Traditional Photography','Complete ritual coverage with classic wedding framing.','service_traditional_photography'],
        ['Wedding Video','Full wedding video coverage for all main functions.','service_wedding_video'],
        ['Cinematic Wedding Video','Film-style storytelling, music, color grading and highlights.','service_cinematic_wedding_video'],
        ['Drone Shoot','Aerial shots and premium cinematic venue coverage.','service_drone_shoot'],
        ['Wedding Shedding','Professional wedding shedding services for functions and family events.','service_wedding_shedding'],
    ];
}

function seo_schema(): string {
    $name = e(setting('business_name'));
    $phone = e(setting('call_number'));
    return '<script type="application/ld+json">{"@context":"https://schema.org","@type":"LocalBusiness","name":"'.$name.'","telephone":"'.$phone.'","serviceType":"Wedding Photography"}</script>';
}
ensure_storage();
?>
