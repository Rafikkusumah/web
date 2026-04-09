@extends('layouts.landing')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-white">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Cahaya Dimensi Bumi</h1>
            <p class="text-xl md:text-2xl mb-8">General Contractor & Automatic Door Solutions</p>
            <p class="text-lg mb-12">Your Trusted Partner for Construction Excellence & dormakaba Automatic Door Systems</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('our-projects') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">View Our Projects</a>
                <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-red-600 px-8 py-3 rounded-lg font-semibold transition">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-16 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">About Us</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
        </div>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right" data-aos-duration="1000">
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    <strong>PT Cahaya Dimensi Bumi</strong> adalah perusahaan general kontraktor yang berfokus pada solusi konstruksi berkualitas tinggi dan merupakan partner resmi <strong>dormakaba</strong> untuk solusi pintu otomatis di Indonesia.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Dengan pengalaman dan keahlian yang mumpuni, kami berkomitmen memberikan pelayanan terbaik dalam setiap proyek konstruksi, mulai dari pembangunan baru, renovasi, hingga instalasi sistem pintu otomatis dormakaba.
                </p>
                <a href="{{ route('about') }}" class="inline-block bg-red-600 text-white hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition transform hover:-translate-y-1 hover:shadow-lg duration-300">Learn More →</a>
            </div>
            <div class="relative" data-aos="fade-left" data-aos-duration="1000">
                <div class="transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('storage/Logo-CDBPM.jpg') }}" alt="PT Cahaya Dimensi Bumi" class="rounded-xl shadow-xl w-full h-80 object-contain bg-white p-8" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                </div>
                <div class="hidden bg-gray-200 h-80 rounded-lg flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-24 h-24 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-lg">Company Image</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 text-lg">Solusi terlengkap untuk kebutuhan konstruksi dan pintu otomatis Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- General Construction -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 group" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-gradient-to-br from-red-500 to-red-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:rotate-12 transition-transform duration-500">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4 text-center group-hover:text-red-600 transition-colors duration-300">General Construction</h3>
                <p class="text-gray-600 text-center leading-relaxed">Layanan konstruksi menyeluruh untuk proyek pembangunan baru, renovasi, dan rehabilitasi dengan standar kualitas tertinggi dan tim profesional berpengalaman.</p>
            </div>

            <!-- Automatic Door Solutions -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 group" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-gradient-to-br from-red-500 to-red-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:rotate-12 transition-transform duration-500">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm10-1a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4 text-center group-hover:text-red-600 transition-colors duration-300">dormakaba Automatic Doors</h3>
                <p class="text-gray-600 text-center leading-relaxed">Sebagai partner resmi dormakaba, kami menyediakan instalasi, maintenance, dan perbaikan sistem pintu otomatis berkualitas tinggi untuk gedung komersial dan residensial.</p>
            </div>

            <!-- Interior & Renovation -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 group" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-gradient-to-br from-red-500 to-red-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:rotate-12 transition-transform duration-500">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4 text-center group-hover:text-red-600 transition-colors duration-300">Interior & Renovation</h3>
                <p class="text-gray-600 text-center leading-relaxed">Jasa renovasi dan desain interior profesional untuk rumah, kantor, hotel, dan ruang komersial dengan hasil kerja berkualitas tinggi dan tepat waktu.</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Clients Section -->
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Clients</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 text-lg">Dipercaya oleh perusahaan terkemuka di Indonesia</p>
        </div>

        <!-- Scrolling Logos Container -->
        <div class="overflow-hidden">
            <div class="animate-scroll">
                <!-- First set of logos (8 items) -->
                <div class="client-logo"><img src="{{ asset('storage/clients/Double-Tree.webp') }}" alt="Double Tree" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Horison.webp') }}" alt="Horison" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/ITC.webp') }}" alt="ITC" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/LGInnotek.webp') }}" alt="LG Innotek" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Sasa.webp') }}" alt="Sasa" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Abipraya.webp') }}" alt="Abipraya" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Astra-International.webp') }}" alt="Astra" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/BSJ.webp') }}" alt="BSJ" onerror="this.style.display='none'"></div>
                <!-- Duplicate set for seamless loop (same 8 items) -->
                <div class="client-logo"><img src="{{ asset('storage/clients/Double-Tree.webp') }}" alt="Double Tree" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Horison.webp') }}" alt="Horison" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/ITC.webp') }}" alt="ITC" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/LGInnotek.webp') }}" alt="LG Innotek" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Sasa.webp') }}" alt="Sasa" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Abipraya.webp') }}" alt="Abipraya" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/Astra-International.webp') }}" alt="Astra" onerror="this.style.display='none'"></div>
                <div class="client-logo"><img src="{{ asset('storage/clients/BSJ.webp') }}" alt="BSJ" onerror="this.style.display='none'"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            animation: scroll 35s linear infinite;
            display: flex;
            width: max-content;
        }
        .animate-scroll:hover {
            animation-play-state: paused;
        }
        .client-logo {
            width: 140px;
            height: 80px;
            flex-shrink: 0;
            margin: 0 20px;
            background: white;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .client-logo:hover {
            border-color: #f87171;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.15);
            transform: scale(1.05);
        }
        .client-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }
    </style>
</section>

<!-- Vision & Mission Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Vision & Mission</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-12">
            <!-- Vision -->
            <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-red-600 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-right">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded-xl transform hover:rotate-6 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 ml-4">Our Vision</h3>
                </div>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Menjadi perusahaan general kontraktor terdepan yang dikenal dengan kualitas, integritas, dan inovasi dalam industri konstruksi Indonesia, serta menjadi solusi utama untuk sistem pintu otomatis berkualitas dunia.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-red-600 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-left">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded-xl transform hover:rotate-6 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 ml-4">Our Mission</h3>
                </div>
                <ul class="text-gray-700 text-lg leading-relaxed space-y-3">
                    <li class="flex items-start group">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-1 flex-shrink-0 transform group-hover:scale-125 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Memberikan layanan konstruksi berkualitas tinggi dengan standar internasional
                    </li>
                    <li class="flex items-start group">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-1 flex-shrink-0 transform group-hover:scale-125 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Menyediakan solusi pintu otomatis dormakaba yang canggih dan aman
                    </li>
                    <li class="flex items-start group">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-1 flex-shrink-0 transform group-hover:scale-125 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Membangun hubungan jangka panjang berdasarkan kepercayaan dan kepuasan pelanggan
                    </li>
                    <li class="flex items-start group">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-1 flex-shrink-0 transform group-hover:scale-125 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Berkontribusi pada pembangunan infrastruktur Indonesia yang lebih baik
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Logo Philosophy Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Logo Philosophy</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="flex justify-center" data-aos="fade-right">
                <div class="transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('storage/Logo-CDBPM.jpg') }}" alt="PT Cahaya Dimensi Bumi Logo" class="max-w-xs rounded-2xl shadow-2xl bg-white p-8">
                </div>
            </div>

            <div data-aos="fade-left">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Makna di Balik Logo Kami</h3>

                <div class="space-y-8">
                    <div class="flex items-start group">
                        <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded-xl mr-5 flex-shrink-0 transform group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300">Cahaya</h4>
                            <p class="text-gray-600 leading-relaxed">Melambangkan penerangan, harapan, dan komitmen kami untuk memberikan solusi terbaik yang menerangi setiap langkah proyek klien kami.</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded-xl mr-5 flex-shrink-0 transform group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300">Dimensi</h4>
                            <p class="text-gray-600 leading-relaxed">Mencerminkan keberagaman layanan dan kemampuan kami dalam berbagai dimensi konstruksi, dari bangunan hingga sistem otomatis.</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded-xl mr-5 flex-shrink-0 transform group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V9a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300">Bumi</h4>
                            <p class="text-gray-600 leading-relaxed">Menandakan fondasi kuat dan akar kami di Indonesia, dengan dedikasi untuk membangun infrastruktur yang kokoh dan berkelanjutan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Projects Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Recent Projects</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto"></div>
            <p class="text-gray-600 mt-4 text-lg">Beberapa proyek terbaru yang telah kami kerjakan</p>
        </div>
        
        @if($recentProjects->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($recentProjects as $project)
            <a href="{{ route('project.detail', $project->id) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    @if($project->cover_image)
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover">
                    @else
                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->company_name }}</h3>
                    <p class="text-gray-600 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $project->location }}
                    </p>
                    <p class="text-gray-700 line-clamp-3">{{ Str::limit($project->description, 100) }}</p>
                    <p class="text-red-600 mt-4 font-semibold">View Details →</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('our-projects') }}" class="inline-block bg-red-600 text-white hover:bg-red-700 px-8 py-3 rounded-lg font-semibold transition">View All Projects →</a>
        </div>
        @else
        <div class="text-center text-gray-500 py-12">
            <p class="text-lg">No projects available yet.</p>
        </div>
        @endif
    </div>
</section>

<!-- Latest Blog Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest News & Blog</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto"></div>
            <p class="text-gray-600 mt-4 text-lg">Informasi dan artikel terbaru dari kami</p>
        </div>
        
        @if($latestBlogs->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($latestBlogs as $blog)
            <a href="{{ route('blog.detail', $blog->slug) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    @else
                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $blog->published_at->format('M d, Y') }}</p>
                    <p class="text-gray-700 line-clamp-3">{{ Str::limit($blog->excerpt, 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="inline-block bg-red-600 text-white hover:bg-red-700 px-8 py-3 rounded-lg font-semibold transition">View All Blog →</a>
        </div>
        @else
        <div class="text-center text-gray-500 py-12">
            <p class="text-lg">No blog posts available yet.</p>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Start Your Project?</h2>
        <p class="text-xl mb-8">Hubungi kami untuk konsultasi gratis dan penawaran terbaik</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">Contact Us</a>
            <a href="tel:+6221xxxxxxxx" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-red-600 px-8 py-3 rounded-lg font-semibold transition">Call Now</a>
        </div>
    </div>
</section>
@endsection
