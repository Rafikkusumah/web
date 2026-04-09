@extends('layouts.landing')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">About Us</h1>
        <p class="text-xl">Mengenal lebih dekat PT Cahaya Dimensi Bumi</p>
    </div>
</section>

<!-- Company Profile Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">PT Cahaya Dimensi Bumi</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Perusahaan yang berfokus pada <strong>general construction</strong> dan solusi <strong>pintu otomatis dormakaba</strong> yang berkualitas tinggi untuk berbagai kebutuhan konstruksi di Indonesia.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    Kami berkomitmen memberikan layanan terbaik dengan standar profesionalisme tinggi, mengutamakan kualitas, keamanan, dan kepuasan pelanggan dalam setiap proyek yang kami kerjakan.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Sebagai partner resmi <strong>dormakaba</strong>, kami menyediakan solusi pintu otomatis yang canggih, aman, dan efisien untuk gedung komersial, perkantoran, rumah sakit, dan berbagai fasilitas lainnya.
                </p>
            </div>
            <div class="relative">
                <img src="{{ asset('storage/Logo-CDBPM.jpg') }}" alt="PT Cahaya Dimensi Bumi" class="rounded-lg shadow-lg w-full h-96 object-contain bg-white p-8" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="hidden bg-gray-200 h-96 rounded-lg flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-32 h-32 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-lg">Company Photo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-red-600 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 ml-4">Our Vision</h3>
                </div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Menjadi perusahaan general kontraktor terdepan yang dikenal dengan kualitas, integritas, dan inovasi dalam industri konstruksi Indonesia, serta menjadi solusi utama untuk sistem pintu otomatis berkualitas dunia.
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-red-600 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 ml-4">Our Mission</h3>
                </div>
                <ul class="text-gray-600 text-lg leading-relaxed space-y-2">
                    <li>✓ Memberikan layanan konstruksi berkualitas tinggi dengan standar internasional</li>
                    <li>✓ Menyediakan solusi pintu otomatis dormakaba yang canggih dan aman</li>
                    <li>✓ Membangun hubungan jangka panjang dengan klien berdasarkan kepercayaan</li>
                    <li>✓ Mengutamakan keselamatan dan kepuasan pelanggan</li>
                    <li>✓ Berkontribusi pada pembangunan infrastruktur Indonesia</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto"></div>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Berpengalaman & Profesional</h3>
                <p class="text-gray-600">Tim profesional berpengalaman dengan keahlian khusus dalam industri konstruksi dan sistem pintu otomatis.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Kualitas Terjamin</h3>
                <p class="text-gray-600">Menggunakan material berkualitas tinggi dan standar kerja yang ketat untuk hasil terbaik.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15 16.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zm11 7a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1zm-1 3a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Partner Resmi dormakaba</h3>
                <p class="text-gray-600">Partner resmi dormakaba untuk solusi pintu otomatis berkualitas dunia dengan garansi resmi.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Tepat Waktu</h3>
                <p class="text-gray-600">Komitmen penyelesaian proyek tepat waktu dengan perencanaan yang matang.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Layanan Pelanggan 24/7</h3>
                <p class="text-gray-600">Support dan after-sales service yang responsif untuk kebutuhan Anda.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Harga Kompetitif</h3>
                <p class="text-gray-600">Penawaran harga yang kompetitif tanpa mengorbankan kualitas pekerjaan.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Tertarik Bekerja Sama?</h2>
        <p class="text-xl mb-8">Hubungi kami untuk konsultasi gratis dan penawaran terbaik</p>
        <a href="{{ route('contact') }}" class="inline-block bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">Contact Us Now →</a>
    </div>
</section>
@endsection
