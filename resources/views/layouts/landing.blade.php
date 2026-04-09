<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Cahaya Dimensi Bumi') }} - @yield('title', 'General Contractor & Automatic Door Solutions')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-md fixed w-full z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-red-600">Cahaya Dimensi Bumi</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">About</a>
                    <a href="{{ route('our-projects') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">Our Project</a>
                    <a href="{{ route('blog') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">Blog</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">Contact Us</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-red-600 text-white hover:bg-red-700 px-4 py-2 rounded-md text-sm font-medium transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-red-600 text-white hover:bg-red-700 px-4 py-2 rounded-md text-sm font-medium transition">Login</a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-red-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-red-600 px-3 py-2 text-base font-medium">Home</a>
                <a href="{{ route('about') }}" class="block text-gray-700 hover:text-red-600 px-3 py-2 text-base font-medium">About</a>
                <a href="{{ route('our-projects') }}" class="block text-gray-700 hover:text-red-600 px-3 py-2 text-base font-medium">Our Project</a>
                <a href="{{ route('blog') }}" class="block text-gray-700 hover:text-red-600 px-3 py-2 text-base font-medium">Blog</a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-red-600 px-3 py-2 text-base font-medium">Contact Us</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block bg-red-600 text-white hover:bg-red-700 px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block bg-red-600 text-white hover:bg-red-700 px-3 py-2 rounded-md text-base font-medium">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Cahaya Dimensi Bumi</h3>
                    <p class="text-gray-400">General Contractor & Automatic Door Solutions</p>
                    <p class="text-gray-400 mt-2">Spesialis konstruksi umum dan solusi pintu otomatis berkualitas tinggi.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">About</a></li>
                        <li><a href="{{ route('our-projects') }}" class="text-gray-400 hover:text-white transition">Our Project</a></li>
                        <li><a href="{{ route('blog') }}" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            </svg>
                            <span>info@cahayadimensibumi.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <a href="https://wa.me/6285171711375" target="_blank" class="hover:text-white transition text-green-400">+62 851-7171-1375</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Cahaya Dimensi Bumi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    </script>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
