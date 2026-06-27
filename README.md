# Wedding Shedding - Working PHP Website

## Upload Method
1. Open this ZIP.
2. Upload all files and folders directly inside your hosting `public_html` or website root.
3. Open your domain. `index.php` is already at root.

## Important
This version works immediately without MySQL because local storage fallback is active. Admin uploads, text changes and contact messages save in `data/storage.json` and upload folders.

## Optional MySQL Setup
1. Create a MySQL database.
2. Import `database.sql`.
3. Open `config.php`.
4. Set `DB_ENABLED = true`.
5. Add DB name, user and password.

If DB details are wrong, set `DB_ENABLED = false` again and the website will still work.

## Hidden Admin
Admin is not shown in the navbar.

Open the small circular `SONU` button on the website to access the private panel.

Direct `/admin/index.php` shows a private 404 page.

Private ID and password are not written in the website UI or README. They are stored as bcrypt hashes in `config.php`.

## Upload Folders
Make sure these folders are writable on hosting if uploads fail:
- `uploads/photos`
- `uploads/videos`
- `uploads/reels`
- `uploads/logo`
- `uploads/backgrounds`
- `uploads/services`
- `data`

Folder permission usually: `755`. On some shared hosting: `775`.

## Pages Included
- Home
- About
- Services
- Photo Gallery
- Video Gallery
- Reels
- Contact
- Hidden Admin Panel

## Contact Buttons
- Floating WhatsApp
- Call button
- Google Review button
- Contact form
- Google map section
