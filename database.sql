CREATE DATABASE IF NOT EXISTS wedding_shedding CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wedding_shedding;

CREATE TABLE IF NOT EXISTS settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(120) NOT NULL UNIQUE,
  setting_value TEXT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS media (
  id INT AUTO_INCREMENT PRIMARY KEY,
  media_type ENUM('photo','video','reel') NOT NULL DEFAULT 'photo',
  title VARCHAR(180) NOT NULL,
  category VARCHAR(120) DEFAULT 'General',
  file_path VARCHAR(255) NOT NULL,
  alt_text VARCHAR(255) NULL,
  sort_order INT DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  phone VARCHAR(80) NOT NULL,
  email VARCHAR(150) NULL,
  event_date VARCHAR(80) NULL,
  message TEXT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings (setting_key, setting_value) VALUES
('business_name','Wedding Shedding'),
('tagline','Premium Wedding Photography & Cinematic Films'),
('logo_path','assets/images/logo.png'),
('hero_background_image','assets/images/hero.jpg'),
('hero_background_video',''),
('hero_heading','Professional Wedding Photography,\nCinematic Wedding Video &\nWedding Shedding Services'),
('hero_description','We provide professional wedding photography, pre-wedding shoots, candid photography, traditional photography, wedding videos, cinematic wedding films, drone shoots and wedding shedding services for weddings, engagements, receptions and family functions.'),
('whatsapp_number','+91 7503550936'),
('whatsapp_link','https://wa.me/917503550936'),
('call_number','+917503550936'),
('google_review_link','https://g.page/r/CaNUqaPpp9tuEBM/review'),
('contact_email','booking@weddingshedding.com'),
('contact_address','India'),
('map_embed','https://www.google.com/maps?q=Wedding%20Photography%20India&output=embed')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

INSERT INTO media (media_type,title,category,file_path,alt_text,sort_order) VALUES
('photo','Wedding Couple Cinematic','Wedding','assets/images/photo-01.jpg','Wedding Shedding premium photography',1),
('photo','Haldi Celebration','Wedding','assets/images/photo-02.jpg','Wedding Shedding premium photography',2),
('photo','Haldi Candid Smile','Wedding','assets/images/photo-03.jpg','Wedding Shedding premium photography',3),
('photo','Bride Groom Haldi','Wedding','assets/images/photo-04.jpg','Wedding Shedding premium photography',4),
('photo','Couple Joy Moment','Wedding','assets/images/photo-05.jpg','Wedding Shedding premium photography',5),
('photo','Family Haldi Function','Wedding','assets/images/photo-06.jpg','Wedding Shedding premium photography',6),
('photo','Bride Groom Portrait','Wedding','assets/images/photo-07.jpg','Wedding Shedding premium photography',7),
('photo','Royal Laugh Moment','Wedding','assets/images/photo-08.jpg','Wedding Shedding premium photography',8),
('photo','Wedding Close-up','Wedding','assets/images/photo-09.jpg','Wedding Shedding premium photography',9),
('photo','Outdoor Pre Wedding','Pre-Wedding','assets/images/photo-10.jpg','Wedding Shedding premium photography',10),
('photo','Pre Wedding Car Shoot','Pre-Wedding','assets/images/photo-11.jpg','Wedding Shedding premium photography',11),
('photo','Bride Portrait','Pre-Wedding','assets/images/photo-12.jpg','Wedding Shedding premium photography',12),
('photo','Premium Couple Shoot','Pre-Wedding','assets/images/photo-13.jpg','Wedding Shedding premium photography',13),
('photo','Album Style Layout','Pre-Wedding','assets/images/photo-14.jpg','Wedding Shedding premium photography',14),
('photo','Function Candid','Pre-Wedding','assets/images/photo-15.jpg','Wedding Shedding premium photography',15),
('photo','Family Selfie Moment','Pre-Wedding','assets/images/photo-16.jpg','Wedding Shedding premium photography',16),
('photo','Bridal Haldi Portrait','Candid','assets/images/photo-17.jpg','Wedding Shedding premium photography',17),
('photo','Groom Ceremony Portrait','Candid','assets/images/photo-18.jpg','Wedding Shedding premium photography',18),
('video','Cinematic Wedding Film','Wedding Video','assets/videos/sample-video.mp4','Cinematic wedding film',1),
('reel','Instagram Wedding Reel','Reels','assets/videos/sample-reel.mp4','Wedding reel highlight',1)
ON DUPLICATE KEY UPDATE title=VALUES(title);
