# Cahaya Dimensi Bumi - Company Website

Website perusahaan **Cahaya Dimensi Bumi** yang berfokus pada general konstruksi dan solusi pintu otomatis dormakaba.

## Fitur Utama

### Landing Page
- ✅ Home dengan hero section, recent projects, dan latest blog
- ✅ About Us (company profile, visi-misi, why choose us)
- ✅ Our Projects (portofolio proyek dengan foto)
- ✅ Blog & News (artikel dan informasi)
- ✅ Contact Us (form kontak dan informasi)
- ✅ Responsive design dengan Tailwind CSS

### Admin Dashboard
- ✅ Dashboard dengan statistik
- ✅ Project Management (CRUD + upload multiple photos/videos)
- ✅ Blog Management (CRUD dengan publish/unpublish)
- ✅ Quotation Generator dengan:
  - Line items dinamis (bisa tambah/hapus item)
  - VAT checkbox (opsional menggunakan VAT)
  - Perhitungan otomatis (subtotal, VAT, total)
  - Notes & Terms
  - Download PDF dengan kop surat
- ✅ Invoice Generator (similar dengan quotation)
- ✅ PDF Export dengan letterhead (logo, PT name, tanda tangan Valerie Febriana Putri)

### Authentication
- ✅ Login/Register dengan Laravel Breeze
- ✅ Protected admin routes

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Blade Templates
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **PDF Generation**: barryvdh/laravel-dompdf

## Setup Instructions

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- XAMPP (untuk development)

### Installation

1. **Start MySQL Server**
   - Buka XAMPP Control Panel
   - Start MySQL

2. **Create Database**
   ```sql
   CREATE DATABASE cahaya_dimensi_bumi;
   ```

3. **Run Migrations**
   ```bash
   cd C:\xampp\htdocs\web
   php artisan migrate
   ```

4. **Seed Demo Data** (optional)
   ```bash
   php artisan db:seed --class=DemoDataSeeder
   ```
   
   Ini akan membuat:
   - 1 admin user (email: admin@cahayadimensibumi.com, password: password123)
   - 3 demo projects
   - 2 demo blog posts

5. **Build Assets**
   ```bash
   npm run build
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```
   
   Website akan tersedia di: http://localhost:8000

## Usage

### Landing Page
- **Home**: http://localhost:8000/
- **About**: http://localhost:8000/about
- **Projects**: http://localhost:8000/our-projects
- **Blog**: http://localhost:8000/blog
- **Contact**: http://localhost:8000/contact

### Admin Dashboard
- **Login**: http://localhost:8000/login
- **Dashboard**: http://localhost:8000/admin/dashboard

**Demo Admin Credentials:**
- Email: `admin@cahayadimensibumi.com`
- Password: `password123`

### Admin Features

#### Projects Management
1. Navigate to Admin → Projects
2. Click "Add New Project"
3. Fill in: Company Name, Location, Description, Cover Image
4. After creating, you can upload additional photos/videos on edit page
5. Toggle "Active" to show/hide on landing page

#### Blog Management
1. Navigate to Admin → Blog
2. Click "Add New Blog Post"
3. Fill in: Title, Excerpt, Content, Featured Image
4. Check "Publish immediately" to make it visible on landing page

#### Quotation Generator
1. Navigate to Admin → Quotations
2. Click "Create New Quotation"
3. Fill in:
   - Quotation Number, Date, Valid Until
   - Salesperson
   - Client Information (Company, Address, City, Zip)
   - Project Description
   - Line Items (Item Name, Description, Unit Price, Quantity, Unit)
   - Click "Add Item" untuk menambah item
   - VAT checkbox (check untuk menggunakan VAT)
   - Notes & Terms (optional)
4. Click "Create Quotation"
5. View, Edit, or Download PDF

#### Invoice Generator
Similar workflow dengan Quotation.

#### PDF Format
PDF akan digenerate dengan:
- Kop surat: Logo (kiri) + PT Cahaya Dimensi Bumi info (kanan)
- Document details
- Client information
- Line items dalam format tabel
- Subtotal, VAT (jika dipilih), Total
- Notes & Terms
- Tanda tangan: Valerie Febriana Putri (Director)

## File Structure

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   ├── DashboardController.php
│   │   ├── ProjectController.php
│   │   ├── BlogController.php
│   │   ├── QuotationController.php
│   │   ├── InvoiceController.php
│   │   └── PdfController.php
│   └── LandingPageController.php
├── Models/
│   ├── Project.php
│   ├── ProjectMedia.php
│   ├── Blog.php
│   ├── Quotation.php
│   ├── QuotationItem.php
│   ├── Invoice.php
│   └── InvoiceItem.php
resources/
├── views/
│   ├── layouts/
│   │   ├── landing.blade.php
│   │   └── admin.blade.php
│   ├── landing/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── projects.blade.php
│   │   ├── blog.blade.php
│   │   ├── blog-detail.blade.php
│   │   └── contact.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── projects/
│   │   ├── blogs/
│   │   ├── quotations/
│   │   └── invoices/
│   └── pdf/
│       ├── quotation.blade.php
│       └── invoice.blade.php
```

## Customization

### Company Information
Edit di file-file berikut:
- `resources/views/layouts/landing.blade.php` (footer contact)
- `resources/views/pdf/quotation.blade.php` (letterhead)
- `.env` (APP_NAME, email)

### Logo
Ganti logo placeholder di:
- `resources/views/pdf/quotation.blade.php` (line ~141)

### VAT Default Percentage
Edit di controllers:
- `QuotationController.php` (line ~68)
- `InvoiceController.php` (line ~68)

## Notes

- MySQL harus running sebelum menjalankan migrations
- File uploads disimpan di `storage/app/public/`
- Pastikan `php artisan storage:link` sudah dijalankan
- Build CSS setelah perubahan: `npm run build`
- Untuk production: set `APP_DEBUG=false` di `.env`

## License

Proprietary - PT Cahaya Dimensi Bumi
