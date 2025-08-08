# Thoitrang DG - Fashion Portfolio Website

A comprehensive Laravel 12 fashion portfolio website with content management system, built for showcasing fashion designs, portfolios, and services.

## 🌟 Features

### Public Website
- **Vietnamese Localized Routes**: `/gioi-thieu` (About), `/du-an` (Portfolio), `/dich-vu` (Services), `/lien-he` (Contact)
- **Portfolio Gallery**: Showcase fashion designs with image galleries and categories
- **Blog System**: Fashion articles and news with attachments
- **Services**: Display fashion services with categories
- **Team Members**: Team profile pages
- **Testimonials**: Customer reviews and feedback
- **Contact System**: Contact forms with message management
- **Hero Sliders**: Dynamic homepage banners
- **Mobile-Responsive**: Optimized for all devices

### Admin Panel
- **Full CRUD Operations**: Manage all content types
- **User Management**: Admin user roles and permissions
- **Image Upload**: Portfolio and blog image management
- **SEO-Friendly**: Slug generation and meta management
- **Content Organization**: Categories for services and portfolios
- **Order Management**: Drag-and-drop ordering for galleries
- **Settings Management**: Header, footer, contact, and about settings

## 🏗️ Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Tailwind CSS + Alpine.js + Bootstrap 5
- **Build Tool**: Vite
- **Authentication**: Laravel Breeze
- **Database**: MySQL/PostgreSQL/SQLite
- **Testing**: Pest PHP

## 📋 Models & Features

### Core Models
- `Blog` - Blog posts with file attachments
- `Portfolio` - Portfolio items with image galleries
- `Service` - Services with categories and thumbnails
- `TeamMember` - Team member profiles
- `Testimonial` - Customer testimonials
- `HeroSlider` - Homepage banner management

### Supporting Models
- `PortfolioCategory` - Portfolio categorization
- `ServiceCategory` - Service categorization
- `PortfolioImage` - Portfolio image gallery management
- `BlogAttachment` - Blog file attachments
- `ContactMessage` - Contact form submissions
- Various settings models for site configuration

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/PostgreSQL/SQLite

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/sangle173/thoitrang-dg.git
   cd thoitrang-dg
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=thoitrang_dg
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🎯 Usage

### Public Routes
- **Homepage**: `/` - Main landing page with hero sliders, services, and portfolio highlights
- **About**: `/gioi-thieu` - About us page
- **Portfolio**: `/du-an` - Portfolio listing and detail pages
- **Services**: `/dich-vu` - Services listing and detail pages
- **Blog**: `/blogs` - Blog listing and article pages
- **Contact**: `/lien-he` - Contact page with form

### Admin Routes
- **Dashboard**: `/dashboard` - Admin overview
- **Admin Panel**: `/admin/*` - Full content management system

### Default Admin User
After running seeders, you can log in with:
- **Email**: Check `database/seeders/UserSeeder.php`
- **Password**: Check the seeder file for default credentials

## 🛠️ Development

### Building for Production
```bash
npm run build
```

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/           # Admin panel controllers
│   ├── Auth/            # Authentication controllers
│   └── *.php            # Public controllers
├── Models/              # Eloquent models
└── View/Components/     # Blade components

resources/views/
├── admin/               # Admin panel views
├── components/          # Reusable components
├── home/                # Homepage sections
└── *.blade.php         # Public views

database/
├── migrations/          # Database migrations
└── seeders/            # Database seeders

public/
├── icons/              # Social media and UI icons
└── overlay/            # Image overlays
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📞 Contact

- **GitHub**: [@sangle173](https://github.com/sangle173)
- **Email**: leducsang.10dt2@gmail.com

## 🎨 Features in Detail

### Portfolio Management
- **Image Galleries**: Multiple images per portfolio item
- **Categories**: Organize portfolios by type
- **Ordering**: Custom order for both portfolios and images
- **Descriptions**: Rich text descriptions for each portfolio

### Blog System
- **File Attachments**: Support for various file types
- **Hashtags**: Tag system for better organization
- **SEO**: Slug-based URLs for better SEO

### Admin Dashboard
- **Content Management**: Easy-to-use interface for all content
- **User Roles**: Admin user management
- **Settings**: Configurable site settings
- **Analytics**: Basic site statistics

### Responsive Design
- **Mobile-First**: Optimized for mobile devices
- **Cross-Browser**: Compatible with all modern browsers
- **Performance**: Optimized loading times

---

Built with ❤️ using Laravel 12

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
