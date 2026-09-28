# Aman.dev — Standalone PHP Portfolio

Personal portfolio for **Md Aman Ullah**, Full Stack PHP Developer & Digital Marketer in Dammam, Saudi Arabia.

A fast, secure, **standalone PHP** website. It needs no framework, no database and no Composer. Upload it to any PHP 8.1+ host and it runs.

## Features

- **Multi-page site with clean URLs**: Home, Services, Work, a case-study page per project, About, Blog, Contact, and a 404 page
- **All content in one file**: edit `config.php` to change text, services, projects, testimonials, FAQ and contact details
- **Working contact form**
  - CSRF token, honeypot and a minimum fill time to stop spam bots
  - Per-IP rate limiting (5 messages per hour)
  - Server-side validation that keeps what the visitor typed if a field is wrong (Post/Redirect/Get)
  - Messages are saved to `storage/messages.json`, and email delivery through `mail()` is optional
- **Password-protected inbox** at `/admin` to read, mark and delete messages, with login rate limiting
- **SEO**: a unique title and description on every page, canonical URLs, Open Graph tags, JSON-LD (`Person` plus `CreativeWork` for each case study), `/sitemap.xml` and `/robots.txt`
- **Security headers**: CSP with a nonce, X-Frame-Options, nosniff, Referrer-Policy and Permissions-Policy. Sessions use HttpOnly, SameSite cookies
- **Design**: dark and light theme (follows the visitor's system setting, with a manual toggle), responsive down to 360px, scroll-reveal animations, animated counters and skill bars, a project filter, and a floating WhatsApp button
- **Accessible and progressive**: semantic HTML, a skip link, keyboard focus styles and `prefers-reduced-motion` support. Every page also works with JavaScript turned off

## Structure

```
├── index.php              Front controller & routes
├── config.php             ← ALL site content & settings
├── router.php             Router for PHP's built-in dev server
├── .htaccess              Apache rewrites + blocks internal folders
├── nginx.conf.example     Example nginx config
├── src/
│   ├── functions.php      Helpers (config, escaping, URLs, CSRF, icons, render)
│   ├── storage.php        Flat-file JSON storage with file locking + rate limiter
│   ├── contact.php        Contact form handler
│   └── admin.php          Inbox login & actions
├── templates/
│   ├── layout.php         <head>, header, footer
│   └── partials.php       Reusable cards/sections
├── pages/                 One template per page
├── assets/{css,js,img}/   Styles, scripts, favicon & OG image
└── storage/               Messages & rate-limit data (web access denied)
```

## Run locally

```bash
php -S localhost:8000 router.php
```

Then open http://localhost:8000.

## Deploy (shared hosting / cPanel / VPS)

1. Upload all files to `public_html` (or to a subfolder, which also works).
2. Make sure `storage/` is writable by PHP (`chmod 775 storage`).
3. In `config.php`:
   - set `site.url` to your real domain
   - set `admin_password_hash` to enable `/admin`:
     ```bash
     php -r "echo password_hash('your-strong-password', PASSWORD_DEFAULT), PHP_EOL;"
     ```
   - optionally set `mail.send => true` and use a `mail.from` address on your own domain
4. On **Apache**, the included `.htaccess` handles clean URLs. On **nginx**, see `nginx.conf.example`.
   If your host doesn't support URL rewriting, set `site.pretty_urls => false` in `config.php`. Links will then use `index.php?p=...`.

> GitHub Pages cannot run PHP. Use any PHP host, such as Hostinger, cPanel hosting or a VPS.

## Editing content

Everything is in `config.php`. Add a project by copying one of the entries in `projects`. It gets a case-study page at `/work/<slug>` automatically, and it is added to the sitemap too.

## Contact

- WhatsApp: +966 555 963 438
- Email: mdamanullah.ksa@gmail.com
- LinkedIn: [linkedin.com/in/amannurweb](https://linkedin.com/in/amannurweb)
- Fiverr: [fiverr.com/amanun](https://www.fiverr.com/amanun)
