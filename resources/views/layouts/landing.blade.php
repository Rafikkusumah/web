<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Cahaya Dimensi Bumi') }} - @yield('title', 'General Contractor & Automatic Door Solutions')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <style>
        /* ===== GLOBAL ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, sans-serif; background: #fff; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 10px; }

        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* ===== NAVBAR ===== */
        #main-header {
            background: rgba(9, 9, 11, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }
        #main-header.scrolled {
            background: rgba(9, 9, 11, 0.97) !important;
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.5) !important;
        }

        /* Nav links */
        .nav-item {
            color: rgba(255, 255, 255, 0.55);
            font-size: 13.5px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
        }
        .nav-item:hover, .nav-item.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.07);
        }
        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: #dc2626;
            border-radius: 2px;
        }

        /* Logo shimmer */
        .logo-shimmer {
            background: linear-gradient(110deg, #fbbf24, #ef4444, #f97316);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200%;
            animation: shimmer 4s linear infinite;
        }

        /* dormakaba badge */
        .nav-partner-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(34, 197, 94, 0.08);
            border: 1px solid rgba(34, 197, 94, 0.18);
            padding: 5px 12px;
            border-radius: 100px;
            margin-right: 8px;
        }
        .nav-partner-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            position: relative;
            flex-shrink: 0;
        }
        .nav-partner-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1px solid #22c55e;
            animation: pulse-ring 1.8s ease-out infinite;
        }

        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s;
            opacity: 0;
            background: rgba(9, 9, 11, 0.98);
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }
        #mobile-menu.open {
            max-height: 480px;
            opacity: 1;
        }
        .mobile-nav-item {
            display: block;
            color: rgba(255, 255, 255, 0.6);
            font-size: 15px;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .mobile-nav-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
        }

        /* CTA button */
        .nav-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dc2626;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            padding: 9px 20px;
            border-radius: 100px;
            text-decoration: none;
            transition: all 0.25s;
            margin-left: 12px;
        }
        .nav-cta-btn:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(220, 38, 38, 0.35);
        }

        /* ===== FOOTER ===== */
        .footer-nav-link {
            display: block;
            color: #52525b;
            font-size: 14px;
            text-decoration: none;
            padding: 6px 0 6px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            position: relative;
        }
        .footer-nav-link::before {
            content: '→';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) translateX(-4px);
            opacity: 0;
            color: #dc2626;
            font-size: 11px;
            transition: all 0.2s;
        }
        .footer-nav-link:hover {
            color: #fff;
            padding-left: 22px;
        }
        .footer-nav-link:hover::before {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }

        .social-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s;
        }
        .social-icon-btn:hover {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
        }
        .social-icon-btn svg { transition: fill 0.2s; }
        .social-icon-btn:hover svg { fill: #fff !important; }

        .footer-contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        .footer-contact-item:hover .footer-contact-icon {
            background: rgba(220, 38, 38, 0.12);
            border-color: rgba(220, 38, 38, 0.2);
        }
        .footer-contact-item:hover .footer-contact-val {
            color: #d4d4d8;
        }

        /* Back to top */
        .back-to-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #dc2626;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
            z-index: 999;
            border: none;
        }
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        .back-to-top:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.5);
        }

        /* Footer col title */
        .footer-col-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-col-title::before {
            content: '';
            width: 3px;
            height: 14px;
            background: #dc2626;
            border-radius: 2px;
            display: inline-block;
            flex-shrink: 0;
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased">

    <!-- ===== HEADER / NAVBAR ===== -->
    <header id="main-header" class="fixed w-full z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[72px]">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline flex-shrink-0">
                    <span class="logo-shimmer text-[26px] font-black tracking-tight">CDB</span>
                    <div style="width:1px;height:22px;background:rgba(255,255,255,0.12)"></div>
                    <span class="hidden sm:block text-sm font-semibold" style="color:rgba(255,255,255,0.65)">Cahaya Dimensi Bumi</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center">
                    <!-- Partner badge -->
                    <div class="nav-partner-badge">
                        <div class="nav-partner-dot"></div>
                        <span style="font-size:11px;font-weight:600;letter-spacing:0.06em;color:#4ade80">dormakaba Partner</span>
                    </div>

                    <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                    <a href="{{ route('our-projects') }}" class="nav-item {{ request()->routeIs('our-projects') ? 'active' : '' }}">Our Project</a>
                    <a href="{{ route('blog') }}" class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
                    <a href="{{ route('contact') }}" class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-cta-btn">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('contact') }}" class="nav-cta-btn">
                            Free Consultation
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Toggle -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-xl transition-all" style="color:rgba(255,255,255,0.7)">
                    <svg id="menu-icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="menu-icon-close" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}" class="mobile-nav-item">Home</a>
                <a href="{{ route('about') }}" class="mobile-nav-item">About</a>
                <a href="{{ route('our-projects') }}" class="mobile-nav-item">Our Project</a>
                <a href="{{ route('blog') }}" class="mobile-nav-item">Blog</a>
                <a href="{{ route('contact') }}" class="mobile-nav-item">Contact Us</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="block text-center px-4 py-3 rounded-xl text-[15px] font-bold text-white mt-2 no-underline"
                        style="background:#dc2626">Dashboard</a>
                @else
                    <a href="{{ route('contact') }}"
                        class="block text-center px-4 py-3 rounded-xl text-[15px] font-bold text-white mt-2 no-underline"
                        style="background:#dc2626">Free Consultation</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-[72px]">
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer style="background:#09090b;position:relative;overflow:hidden">
        <!-- Top accent line -->
        <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(220,38,38,0.5),transparent)"></div>

        <!-- Decorative orbs -->
        <div style="position:absolute;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.06) 0%,transparent 70%);top:-120px;right:-100px;pointer-events:none"></div>
        <div style="position:absolute;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.04) 0%,transparent 70%);bottom:-80px;left:-80px;pointer-events:none"></div>

        <!-- Main footer content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

                <!-- Brand Column -->
                <div class="md:col-span-1">
                    <div class="logo-shimmer text-[38px] font-black tracking-tight mb-1">CDB</div>
                    <div style="font-size:11px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#52525b;margin-bottom:20px">
                        Cahaya Dimensi Bumi
                    </div>
                    <p style="font-size:14px;line-height:1.8;color:#3f3f46;max-width:260px;margin-bottom:24px">
                        Spesialis konstruksi umum & solusi pintu otomatis dormakaba berkualitas tinggi untuk proyek komersial & residensial di Indonesia.
                    </p>

                    <!-- Active status badge -->
                    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.15);padding:8px 14px;border-radius:12px;margin-bottom:16px">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span style="font-size:12px;font-weight:600;color:#4ade80">Active & Accepting Projects</span>
                    </div>

                    <!-- Business hours -->
                    <div style="display:flex;flex-direction:column;gap:3px">
                        <span style="font-size:12px;color:#52525b">Mon – Fri: 09.00 – 18.00 WIB</span>
                        <span style="font-size:12px;color:#52525b">Sabtu: 09.00 – 14.00 WIB</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <div class="footer-col-title">Menu</div>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:2px">
                        <li><a href="{{ route('home') }}" class="footer-nav-link">Home</a></li>
                        <li><a href="{{ route('about') }}" class="footer-nav-link">About</a></li>
                        <li><a href="{{ route('our-projects') }}" class="footer-nav-link">Our Project</a></li>
                        <li><a href="{{ route('blog') }}" class="footer-nav-link">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-nav-link">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <div class="footer-col-title">Layanan</div>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:2px">
                        <li><a href="{{ route('our-projects') }}" class="footer-nav-link">General Construction</a></li>
                        <li><a href="{{ route('our-projects') }}" class="footer-nav-link">dormakaba Systems</a></li>
                        <li><a href="{{ route('our-projects') }}" class="footer-nav-link">Interior & Renovasi</a></li>
                        <li><a href="{{ route('our-projects') }}" class="footer-nav-link">Project Management</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-nav-link">Konsultasi Gratis</a></li>
                    </ul>
                </div>

                <!-- Contact + Socials -->
                <div>
                    <div class="footer-col-title">Hubungi Kami</div>

                    <!-- Location -->
                    <div class="footer-contact-item" style="display:flex;align-items:flex-start;gap:12px;margin-bottom:16px">
                        <div class="footer-contact-icon">
                            <svg width="16" height="16" fill="none" stroke="#71717a" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.08em;color:#3f3f46;margin-bottom:2px">Lokasi</div>
                            <div class="footer-contact-val" style="font-size:13px;color:#71717a">Jakarta, Indonesia</div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="footer-contact-item" style="display:flex;align-items:flex-start;gap:12px;margin-bottom:16px">
                        <div class="footer-contact-icon">
                            <svg width="16" height="16" fill="none" stroke="#71717a" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.08em;color:#3f3f46;margin-bottom:2px">Email</div>
                            <div class="footer-contact-val" style="font-size:13px;color:#71717a">info@cahayadimensibumi.com</div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="footer-contact-item" style="display:flex;align-items:flex-start;gap:12px;margin-bottom:24px">
                        <div class="footer-contact-icon" style="background:rgba(34,197,94,0.08);border-color:rgba(34,197,94,0.15)">
                            <svg width="16" height="16" fill="#22c55e" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.08em;color:#3f3f46;margin-bottom:2px">WhatsApp</div>
                            <a href="https://wa.me/6285171711375" target="_blank"
                               style="font-size:13px;font-weight:600;color:#4ade80;text-decoration:none">
                                +62 851-7171-1375
                            </a>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="footer-col-title">Follow Us</div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap">
                        <!-- Instagram -->
                        <a href="#" class="social-icon-btn" aria-label="Instagram">
                            <svg width="16" height="16" fill="#71717a" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="social-icon-btn" aria-label="Facebook">
                            <svg width="16" height="16" fill="#71717a" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <!-- LinkedIn -->
                        <a href="#" class="social-icon-btn" aria-label="LinkedIn">
                            <svg width="16" height="16" fill="#71717a" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6285171711375" target="_blank" class="social-icon-btn" aria-label="WhatsApp">
                            <svg width="16" height="16" fill="#71717a" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Bar -->
        <div style="border-top:1px solid rgba(255,255,255,0.05);padding:20px 0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-3">
                <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:#3f3f46">
                    <span style="width:5px;height:5px;border-radius:50%;background:#dc2626;display:inline-block;flex-shrink:0"></span>
                    &copy; {{ date('Y') }} PT Cahaya Dimensi Bumi. All rights reserved.
                </div>
                <div style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);padding:6px 14px;border-radius:8px">
                    <span style="font-size:11px;color:#52525b">Official Partner</span>
                    <span style="font-size:11px;font-weight:700;color:#dc2626">dormakaba</span>
                </div>
                <div style="display:flex;gap:20px">
                    <a href="#" style="font-size:13px;color:#3f3f46;text-decoration:none;transition:color 0.2s" onmouseover="this.style.color='#71717a'" onmouseout="this.style.color='#3f3f46'">Privacy Policy</a>
                    <a href="#" style="font-size:13px;color:#3f3f46;text-decoration:none;transition:color 0.2s" onmouseover="this.style.color='#71717a'" onmouseout="this.style.color='#3f3f46'">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="back-to-top" id="back-to-top" aria-label="Back to top">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <script>
        // ---- Navbar scroll effect ----
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.pageYOffset > 40);
            const btn = document.getElementById('back-to-top');
            if (btn) btn.classList.toggle('visible', window.pageYOffset > 300);
        }, { passive: true });

        // ---- Mobile menu ----
        const mobileBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('menu-icon-open');
        const iconClose = document.getElementById('menu-icon-close');

        mobileBtn?.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            iconOpen.classList.toggle('hidden', isOpen);
            iconClose.classList.toggle('hidden', !isOpen);
        });

        document.addEventListener('click', (e) => {
            if (!mobileMenu?.contains(e.target) && !mobileBtn?.contains(e.target)) {
                mobileMenu?.classList.remove('open');
                iconOpen?.classList.remove('hidden');
                iconClose?.classList.add('hidden');
            }
        });

        // ---- Back to top ----
        document.getElementById('back-to-top')?.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // ---- Smooth scroll for anchor links ----
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>