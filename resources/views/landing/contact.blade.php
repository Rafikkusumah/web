@extends('layouts.landing')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-xl">Hubungi kami untuk konsultasi dan penawaran</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Your full name">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="your.email@example.com">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="+62 xxx xxxx xxxx">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="What is this regarding?">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Tell us about your project or inquiry..."></textarea>
                    </div>
                    
                    <button type="submit"
                        class="w-full bg-red-600 text-white hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition">
                        Send Message
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Get In Touch</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Office Address</h3>
                            <p class="text-gray-600">Jakarta, Indonesia</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Us</h3>
                            <p class="text-gray-600">info@cahayadimensibumi.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Call / WhatsApp Us</h3>
                            <a href="https://wa.me/6285171711375" target="_blank" class="text-green-600 hover:text-green-700 font-semibold">+62 851-7171-1375</a>
                            <p class="text-gray-500 text-sm">Monday - Friday, 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Google Maps -->
                <div class="mt-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1699999999999!5m2!1sen!2sid" width="100%" height="250" style="border:0; border-radius: 0.5rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a href="https://maps.app.goo.gl/v6gYr7owtsoDeEbEA" target="_blank" class="mt-3 inline-flex items-center text-red-600 hover:text-red-700 font-semibold transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        View on Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
