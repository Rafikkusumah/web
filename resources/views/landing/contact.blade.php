@extends('layouts.landing')

@section('title', 'Contact Us - Cahaya Dimensi Bumi')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;background:#fff;overflow-x:hidden}
    ::-webkit-scrollbar{width:5px}::-webkit-scrollbar-thumb{background:#dc2626;border-radius:10px}

    @keyframes float{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-18px) scale(1.02)}}
    @keyframes fadeUp{from{opacity:0;transform:translateY(32px)}to{opacity:1;transform:translateY(0)}}
    @keyframes pulse-ring{0%{transform:scale(1);opacity:1}100%{transform:scale(2.2);opacity:0}}
    @keyframes shimmer{0%{background-position:-200% center}100%{background-position:200% center}}
    @keyframes borderPulse{0%,100%{border-color:rgba(220,38,38,0.3)}50%{border-color:rgba(220,38,38,0.8)}}

    .reveal{opacity:0;transform:translateY(36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
    .reveal.in{opacity:1;transform:none}
    .reveal-scale{opacity:0;transform:scale(0.92);transition:all 0.6s cubic-bezier(0.16,1,0.3,1)}
    .reveal-scale.in{opacity:1;transform:none}

    /* Hero Section */
    .hero-contact{min-height:70vh;display:flex;align-items:center;position:relative;overflow:hidden;
      background:linear-gradient(135deg,#09090b 0%,#18181b 40%,#1c0a0a 70%,#0f0505 100%)}
    .hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 20%,transparent 100%)}
    .hero-orb1{position:absolute;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.18) 0%,transparent 70%);top:-100px;right:-100px;animation:float 10s ease-in-out infinite}
    .hero-orb2{position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.12) 0%,transparent 70%);bottom:-50px;left:-80px;animation:float 13s ease-in-out infinite 2s}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(220,38,38,0.1);border:1px solid rgba(220,38,38,0.3);padding:6px 16px;border-radius:100px;color:#fca5a5;font-size:12px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:28px;animation:fadeUp 0.6s ease forwards;animation:borderPulse 3s ease infinite}
    .pulse-dot{width:8px;height:8px;border-radius:50%;background:#ef4444;position:relative}
    .pulse-dot::after{content:'';position:absolute;inset:-4px;border-radius:50%;border:2px solid #ef4444;animation:pulse-ring 1.5s ease-out infinite}
    .hero-title{font-size:clamp(52px,8vw,96px);font-weight:900;line-height:1.0;letter-spacing:-0.035em;color:#fff;margin-bottom:24px;animation:fadeUp 0.7s 0.15s ease both}
    .hero-title .line2{background:linear-gradient(110deg,#fbbf24,#ef4444,#f97316);-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:shimmer 4s linear infinite}
    .hero-sub{color:#a1a1aa;font-size:18px;font-weight:400;max-width:520px;line-height:1.7;margin-bottom:40px;animation:fadeUp 0.7s 0.25s ease both}

    .container{max-width:1180px;margin:0 auto;padding:0 24px}

    /* Contact Cards & Form */
    .contact-card{background:#0f0f12;border-radius:32px;border:1px solid rgba(255,255,255,0.06);overflow:hidden;margin-top:-80px;position:relative;z-index:20;backdrop-filter:blur(4px);padding:48px}
    .form-group{margin-bottom:24px}
    .form-label{display:block;font-size:14px;font-weight:600;color:#fff;margin-bottom:8px}
    .form-control{width:100%;padding:14px 18px;background:#1a1a1f;border:1px solid rgba(255,255,255,0.08);border-radius:16px;color:#fff;font-size:14px;transition:all 0.2s}
    .form-control:focus{outline:none;border-color:#dc2626;background:#1f1f24}
    .form-control::placeholder{color:#52525b}
    textarea.form-control{resize:vertical;min-height:120px}
    .btn-submit{width:100%;background:linear-gradient(95deg,#dc2626,#b91c1c);color:#fff;padding:14px 24px;border-radius:100px;font-weight:700;font-size:15px;border:none;cursor:pointer;transition:all 0.3s;margin-top:12px}
    .btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 25px rgba(220,38,38,0.3)}

    .info-card{background:#1a1a1f;border-radius:24px;padding:24px;transition:all 0.3s;border:1px solid rgba(255,255,255,0.05);margin-bottom:20px}
    .info-card:hover{transform:translateY(-4px);background:#1f1f24;border-color:rgba(220,38,38,0.3)}
    .info-icon{width:48px;height:48px;background:linear-gradient(135deg,#dc2626,#991b1b);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:16px}
    .info-title{font-size:18px;font-weight:700;color:#fff;margin-bottom:8px}
    .info-text{color:#a1a1aa;font-size:14px;line-height:1.5}
    .info-link{color:#f87171;text-decoration:none;font-weight:500}
    .info-link:hover{color:#ef4444;text-decoration:underline}

    .map-card{background:#1a1a1f;border-radius:24px;overflow:hidden;border:1px solid rgba(255,255,255,0.05);margin-top:24px}
    .map-card iframe{width:100%;height:280px;border:none}
    .map-link{display:inline-flex;align-items:center;gap:8px;color:#f87171;font-weight:600;margin-top:16px;transition:gap 0.2s}
    .map-link:hover{gap:12px;color:#ef4444}
</style>

<!-- Hero Section (dark, matching homepage) -->
<section class="hero-contact">
    <div class="hero-grid"></div>
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>
    <div class="container" style="position:relative;z-index:10;text-align:center;padding-top:100px;padding-bottom:100px">
        <div class="hero-badge" style="margin-left:auto;margin-right:auto">
            <div class="pulse-dot"></div>
            <span>Get In Touch</span>
        </div>
        <h1 class="hero-title">
            Contact<br>
            <span class="line2">Us</span>
        </h1>
        <p class="hero-sub" style="max-width:600px;margin-left:auto;margin-right:auto">
            Hubungi kami untuk konsultasi gratis dan penawaran terbaik untuk proyek konstruksi & pintu otomatis Anda.
        </p>
    </div>
</section>

<!-- Contact Form & Info Section -->
<section class="pb-24 bg-[#09090b] relative">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(220,38,38,0.05),transparent)]"></div>
    <div class="container relative z-10">
        <div class="contact-card reveal-scale">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Form -->
                <div>
                    <h2 style="font-size:28px;font-weight:800;color:#fff;margin-bottom:8px">Kirim Pesan</h2>
                    <p style="color:#a1a1aa;margin-bottom:32px">Tim kami akan merespon dalam 1x24 jam</p>

                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" required class="form-control" placeholder="Nama Anda">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" required class="form-control" placeholder="email@domain.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+62 xxx xxxx xxxx">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Perihal</label>
                            <input type="text" name="subject" required class="form-control" placeholder="Subjek pesan">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pesan</label>
                            <textarea name="message" rows="4" required class="form-control" placeholder="Detail proyek atau pertanyaan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Pesan →</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 style="font-size:28px;font-weight:800;color:#fff;margin-bottom:8px">Informasi Kontak</h2>
                    <p style="color:#a1a1aa;margin-bottom:32px">Hubungi kami melalui saluran berikut</p>

                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="22" height="22" fill="#fff" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </div>
                        <div class="info-title">Kantor Pusat</div>
                        <div class="info-text">Jakarta, Indonesia</div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="22" height="22" fill="#fff" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </div>
                        <div class="info-title">Email</div>
                        <a href="mailto:info@cahayadimensibumi.com" class="info-link">info@cahayadimensibumi.com</a>
                    </div>

                    <div class="info-card">
                        <div class="info-icon" style="background:linear-gradient(135deg,#22c55e,#15803d)">
                            <svg width="22" height="22" fill="#fff" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div class="info-title">Telepon & WhatsApp</div>
                        <a href="https://wa.me/6285171711375" target="_blank" class="info-link">+62 851-7171-1375</a>
                        <div class="info-text" style="margin-top:6px">Senin - Jumat, 09:00 - 18:00</div>
                    </div>

                    <!-- Google Maps -->
                    <div class="map-card">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1699999999999!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <a href="https://maps.app.goo.gl/v6gYr7owtsoDeEbEA" target="_blank" class="map-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Lihat di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const obs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}})
    },{threshold:0.12,rootMargin:'0px 0px -20px 0px'});
    document.querySelectorAll('.reveal, .reveal-scale').forEach(el=>obs.observe(el));
</script>
@endsection