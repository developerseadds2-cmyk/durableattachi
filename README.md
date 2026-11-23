# 💍 Glamora — Premium Jewelry Ecommerce

A full-featured Laravel ecommerce platform for a jewelry store, with a beautiful Glamora-themed frontend, complete CMS, admin panel, and payment gateway integration.

---

## 🚀 Features

### Frontend
- ✅ Animated, responsive homepage matching Glamora design
- ✅ Hero slider with animations
- ✅ Category circles with hover effects
- ✅ Product cards with quick-add to cart & wishlist
- ✅ Mega menu (admin-managed, live data)
- ✅ Cart drawer (AJAX)
- ✅ Fully animated shop, product detail, cart, checkout pages
- ✅ Blog with sidebar
- ✅ Contact form
- ✅ Customer account dashboard, orders, addresses, wishlist

### Admin Panel
- ✅ Beautiful dark sidebar admin layout
- ✅ Dashboard with chart (revenue + orders)
- ✅ Products CRUD (with gallery, attributes/variants, rich editor)
- ✅ Categories (parent/child hierarchy)
- ✅ Brands
- ✅ Orders management (status updates, invoice printing)
- ✅ Users management
- ✅ **Mega Menu Manager** (add/edit columns, items, promo banners)
- ✅ Sliders & Banners management
- ✅ CMS Pages
- ✅ Blog Posts & Categories
- ✅ Coupons
- ✅ Reviews moderation
- ✅ Newsletter subscribers
- ✅ Contact messages
- ✅ Shipping methods
- ✅ Settings (General, Payment, Email, SEO)
- ✅ Sales/Products/Customers reports

### Payment Gateways
- ✅ **Stripe** (credit/debit card)
- ✅ **PayPal** (redirect flow)
- ✅ **Cash on Delivery (COD)**

---

## 🔧 Installation

### Requirements
- PHP 8.2+
- MySQL 8.0+
- Composer
- Laravel 11

### Steps

```bash
# 1. Clone / copy project
cd your-server-root
# project already at: F:\PHP-Projects\htdocs\laravel-websites\pacific

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Create MySQL database
# Open phpMyAdmin or MySQL CLI and run:
CREATE DATABASE glamora_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 6. Import SQL Schema (recommended — fastest method)
mysql -u root glamora_db < glamora.sql
# OR use phpMyAdmin: Import > glamora.sql

# 7. Update .env database credentials
DB_DATABASE=glamora_db
DB_USERNAME=root
DB_PASSWORD=your_password

# 8. Run migrations (if not importing SQL)
php artisan migrate --seed

# 9. Create storage symlink
php artisan storage:link

# 10. Set folder permissions
chmod -R 775 storage bootstrap/cache

# 11. Start the server
php artisan serve
# OR configure Apache/Nginx to point to /public
```

### XAMPP Users
- Place project in `htdocs\laravel-websites\pacific`
- Access at: `http://localhost/pacific/public`
- OR set Apache VirtualHost to `pacific.test`

---

## 🔐 Default Login Credentials

### Admin Panel
- URL: `/admin`
- Email: `admin@glamora.com`
- Password: `password`

### Customer Account
- Email: `customer@glamora.com`
- Password: `password`

---

## 💳 Payment Gateway Setup

### Stripe
1. Create account at [stripe.com](https://stripe.com)
2. Get API keys from Dashboard > Developers > API Keys
3. Admin Panel > Settings > Payment > Enter Stripe Keys

### PayPal
1. Create app at [developer.paypal.com](https://developer.paypal.com)
2. Get Client ID & Secret
3. Admin Panel > Settings > Payment > Enter PayPal Keys
4. Set mode to `sandbox` for testing, `live` for production

---

## 📁 Project Structure

```
pacific/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # 14 admin controllers
│   │   │   ├── Frontend/      # 9 frontend controllers
│   │   │   └── PaymentController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/                # 20 Eloquent models
│   └── Providers/
├── database/
│   ├── migrations/            # 7 migration files
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── admin/             # Complete admin panel
│       └── frontend/          # Glamora-themed frontend
├── routes/
│   └── web.php                # All routes
├── glamora.sql                # Complete database schema + seed data
├── .env.example
└── composer.json
```

---

## 🎨 Design

The frontend matches the **Glamora Jewelry** design from the provided screenshot:
- Elegant serif (Cormorant Garamond) + sans-serif (Jost) typography
- Gold (`#c9a96e`) accent color throughout
- Cream/warm background tones
- Smooth CSS animations and transitions
- Full mega menu with category columns + promo banner
- Swiper.js sliders
- Fully responsive (mobile-first)

---

## 📧 Support

For customization or support, update the settings in Admin Panel > Settings.

---

*Built with ❤️ using Laravel 11 + Bootstrap 5*
