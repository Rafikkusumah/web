@extends('layouts.landing')

@section('title', 'About Us - Cahaya Dimensi Bumi')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;background:#fff;overflow-x:hidden}
    ::-webkit-scrollbar{width:5px}::-webkit-scrollbar-thumb{background:#dc2626;border-radius:10px}

    @keyframes float{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-18px) scale(1.02)}}
    @keyframes spin-slow{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
    @keyframes fadeUp{from{opacity:0;transform:translateY(32px)}to{opacity:1;transform:translateY(0)}}
    @keyframes pulse-ring{0%{transform:scale(1);opacity:1}100%{transform:scale(2.2);opacity:0}}
    @keyframes glow{0%,100%{box-shadow:0 0 20px rgba(220,38,38,0.3)}50%{box-shadow:0 0 40px rgba(220,38,38,0.6)}}
    @keyframes shimmer{0%{background-position:-200% center}100%{background-position:200% center}}
    @keyframes borderPulse{0%,100%{border-color:rgba(220,38,38,0.3)}50%{border-color:rgba(220,38,38,0.8)}}

    .reveal{opacity:0;transform:translateY(36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
    .reveal.in{opacity:1;transform:none}
    .reveal-l{opacity:0;transform:translateX(-36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
    .reveal-l.in{opacity:1;transform:none}
    .reveal-r{opacity:0;transform:translateX(36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
    .reveal-r.in{opacity:1;transform:none}
    .reveal-scale{opacity:0;transform:scale(0.92);transition:all 0.6s cubic-bezier(0.16,1,0.3,1)}
    .reveal-scale.in{opacity:1;transform:none}

    /* Hero Section (matching homepage) */
    .hero-about{min-height:70vh;display:flex;align-items:center;position:relative;overflow:hidden;
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

    /* Container */
    .container{max-width:1180px;margin:0 auto;padding:0 24px}
    .section-label{display:inline-block;background:#fef2f2;color:#dc2626;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:6px 14px;border-radius:100px;margin-bottom:16px}
    .section-title{font-size:clamp(32px,5vw,54px);font-weight:900;line-height:1.1;letter-spacing:-0.025em;color:#09090b;margin-bottom:16px}
    .section-title span{color:#dc2626}
    .text-muted{color:#6b7280;font-size:16px;line-height:1.8}

    /* Cards and grid */
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center}
    .stat-box{background:#fff;border:1px solid #f3f4f6;border-radius:16px;padding:24px 20px;text-align:center;transition:all 0.3s}
    .stat-box:hover{transform:translateY(-6px);border-color:rgba(220,38,38,0.2);box-shadow:0 16px 40px rgba(0,0,0,0.08)}
    .stat-num{font-size:36px;font-weight:900;color:#dc2626;letter-spacing:-0.03em}
    .stat-lbl{font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;margin-top:6px}
    .logo-wrapper{background:#fafafa;border-radius:24px;padding:48px;border:1px solid #f0f0f0;transition:all 0.4s}
    .logo-wrapper:hover{box-shadow:0 24px 64px rgba(0,0,0,0.1);transform:scale(1.01)}

    /* Vision Mission Cards */
    .vm-card{background:#fff;border-radius:24px;padding:40px;border:1px solid #f0f0f0;position:relative;overflow:hidden;transition:all 0.4s}
    .vm-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,#dc2626,#991b1b);border-radius:4px 0 0 4px}
    .vm-card:hover{transform:translateY(-6px);box-shadow:0 24px 48px rgba(0,0,0,0.08);border-color:rgba(220,38,38,0.15)}
    .vm-icon{width:48px;height:48px;background:#fef2f2;border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:20px}
    .vm-title{font-size:26px;font-weight:800;color:#09090b;margin-bottom:16px;letter-spacing:-0.02em}
    .vm-text{font-size:15px;color:#4b5563;line-height:1.8}
    .vm-list{list-style:none;padding:0}
    .vm-list li{display:flex;gap:10px;padding:8px 0;border-bottom:1px solid #f9fafb;font-size:15px;color:#4b5563;line-height:1.6}
    .vm-list li:last-child{border-bottom:none}
    .vm-arrow{color:#dc2626;font-weight:800;flex-shrink:0}

    /* Strength Cards (matching service cards) */
    .strength-card{background:#0f0f12;border-radius:24px;padding:32px 24px;transition:all 0.4s;border:1px solid rgba(255,255,255,0.06);text-align:center}
    .strength-card:hover{transform:translateY(-8px);background:#111117;border-color:rgba(220,38,38,0.3);box-shadow:0 20px 40px rgba(0,0,0,0.3)}
    .strength-icon{width:56px;height:56px;background:linear-gradient(135deg,#dc2626,#991b1b);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;transition:all 0.4s}
    .strength-card:hover .strength-icon{transform:scale(1.1) rotate(3deg);box-shadow:0 0 30px rgba(220,38,38,0.4)}
    .strength-title{font-size:20px;font-weight:700;color:#fff;margin-bottom:12px}
    .strength-desc{font-size:14px;color:#71717a;line-height:1.6}

    /* CTA matching homepage */
    .cta-section{padding:100px 0;background:linear-gradient(135deg,#7f1d1d 0%,#dc2626 50%,#991b1b 100%);position:relative;overflow:hidden}
    .cta-grid-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.05) 1px,transparent 1px);background-size:40px 40px}
    .cta-orb{position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.06);top:-100px;right:-80px}
    .btn-white{background:#fff;color:#dc2626;padding:16px 36px;border-radius:100px;font-weight:800;font-size:15px;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;text-decoration:none}
    .btn-white:hover{background:#f9fafb;transform:translateY(-3px);box-shadow:0 20px 40px rgba(0,0,0,0.2)}
</style>

<!-- Hero Section - matching homepage style -->
<section class="hero-about">
    <div class="hero-grid"></div>
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>
    <div class="container" style="position:relative;z-index:10;padding-top:80px;padding-bottom:80px;text-align:center">
        <div class="hero-badge" style="margin-left:auto;margin-right:auto">
            <div class="pulse-dot"></div>
            <span>Who We Are</span>
        </div>
        <h1 class="hero-title">
            About<br>
            <span class="line2">Cahaya Dimensi Bumi</span>
        </h1>
        <p class="hero-sub" style="max-width:600px;margin-left:auto;margin-right:auto">
            Mengenal lebih dekat perusahaan general kontraktor dan partner resmi dormakaba terpercaya di Indonesia.
        </p>
    </div>
</section>

<!-- Company Profile Section - Clean modern -->
<section class="py-24 bg-white">
    <div class="container">
        <div class="grid-2">
            <div class="reveal-l">
                <div class="logo-wrapper">
                    <div style="width:100%;height:260px;background:linear-gradient(135deg,#fef2f2,#fff);border-radius:16px;display:flex;align-items:center;justify-content:center">
                        <div style="text-align:center">
                            <div style="font-size:56px;font-weight:900;color:#dc2626;letter-spacing:-0.03em;line-height:1">CDB</div>
                            <div style="font-size:11px;color:#9ca3af;letter-spacing:0.2em;text-transform:uppercase;margin-top:4px">Cahaya Dimensi Bumi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal-r">
                <span class="section-label">Company Profile</span>
                <h2 class="section-title">PT Cahaya <span>Dimensi Bumi</span></h2>
                <p class="text-muted" style="margin-bottom:20px">
                    Perusahaan yang berfokus pada <strong>general construction</strong> dan solusi <strong>pintu otomatis dormakaba</strong> berkualitas tinggi untuk berbagai kebutuhan konstruksi di Indonesia.
                </p>
                <p class="text-muted" style="margin-bottom:20px">
                    Kami berkomitmen memberikan layanan terbaik dengan standar profesionalisme tinggi, mengutamakan kualitas, keamanan, dan kepuasan pelanggan dalam setiap proyek.
                </p>
                <p class="text-muted">
                    Sebagai partner resmi <strong>dormakaba</strong>, kami menyediakan solusi pintu otomatis canggih, aman, dan efisien untuk gedung komersial, perkantoran, rumah sakit, dan berbagai fasilitas lainnya.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission - matching homepage style -->
<section class="py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:48px">
            <span class="section-label">Pilar Perusahaan</span>
            <h2 class="section-title">Visi & <span>Misi</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="vm-card reveal-l">
                <div class="vm-icon">
                    <svg width="22" height="22" fill="#dc2626" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div class="vm-title">Visi</div>
                <p class="vm-text">Menjadi perusahaan general kontraktor terdepan di Asia Tenggara dengan solusi konstruksi berkelanjutan & pintu otomatis berteknologi tinggi, mengutamakan inovasi dan kepercayaan klien.</p>
            </div>
            <div class="vm-card reveal-r">
                <div class="vm-icon">
                    <svg width="22" height="22" fill="#dc2626" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="vm-title">Misi</div>
                <ul class="vm-list">
                    <li><span class="vm-arrow">→</span> Layanan konstruksi premium, tepat waktu & anggaran.</li>
                    <li><span class="vm-arrow">→</span> Sistem dormakaba andal, aman, dan modern.</li>
                    <li><span class="vm-arrow">→</span> Kemitraan jangka panjang berbasis integritas.</li>
                    <li><span class="vm-arrow">→</span> Standar keselamatan & lingkungan tertinggi.</li>
                    <li><span class="vm-arrow">→</span> Kontribusi nyata pada pembangunan infrastruktur Indonesia.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us - Dark theme cards like services on homepage -->
<section class="py-24 bg-[#09090b] relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(220,38,38,0.08),transparent)]"></div>
    <div class="container relative z-10">
        <div class="reveal" style="text-align:center;margin-bottom:56px">
            <span class="section-label" style="background:rgba(220,38,38,0.15);color:#fca5a5;border:1px solid rgba(220,38,38,0.2)">Our Strengths</span>
            <h2 class="section-title text-white">Why <span class="bg-gradient-to-r from-amber-200 to-red-300 bg-clip-text text-transparent">Choose Us</span></h2>
            <p class="text-gray-400" style="margin-top:8px">Keunggulan yang membuat kami berbeda</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="strength-card reveal-scale">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div class="strength-title">Berpengalaman & Profesional</div>
                <p class="strength-desc">Tim profesional dengan keahlian khusus di konstruksi dan sistem pintu otomatis.</p>
            </div>
            <div class="strength-card reveal-scale" style="transition-delay:0.1s">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <div class="strength-title">Kualitas Terjamin</div>
                <p class="strength-desc">Material berkualitas tinggi dan standar kerja ketat untuk hasil terbaik.</p>
            </div>
            <div class="strength-card reveal-scale" style="transition-delay:0.2s">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="3" x2="12" y2="21"/><line x1="3" y1="9" x2="21" y2="9"/></svg>
                </div>
                <div class="strength-title">Partner Resmi dormakaba</div>
                <p class="strength-desc">Solusi pintu otomatis berkualitas dunia dengan garansi resmi.</p>
            </div>
            <div class="strength-card reveal-scale" style="transition-delay:0.3s">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="strength-title">Tepat Waktu</div>
                <p class="strength-desc">Komitmen penyelesaian proyek tepat waktu dengan perencanaan matang.</p>
            </div>
            <div class="strength-card reveal-scale" style="transition-delay:0.4s">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <div class="strength-title">Layanan 24/7</div>
                <p class="strength-desc">Support dan after-sales service responsif untuk kebutuhan Anda.</p>
            </div>
            <div class="strength-card reveal-scale" style="transition-delay:0.5s">
                <div class="strength-icon">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div class="strength-title">Harga Kompetitif</div>
                <p class="strength-desc">Penawaran harga kompetitif tanpa mengorbankan kualitas pekerjaan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section (optional, to reinforce credibility) -->
<section class="py-16 bg-white">
    <div class="container">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center reveal-scale">
                <div class="stat-num counter" data-target="128">0</div>
                <div class="stat-lbl">Projects Completed</div>
            </div>
            <div class="text-center reveal-scale" style="transition-delay:0.1s">
                <div class="stat-num counter" data-target="86">0</div>
                <div class="stat-lbl">Happy Clients</div>
            </div>
            <div class="text-center reveal-scale" style="transition-delay:0.2s">
                <div class="stat-num counter" data-target="12">0</div>
                <div class="stat-lbl">Years Experience</div>
            </div>
            <div class="text-center reveal-scale" style="transition-delay:0.3s">
                <div class="stat-num counter" data-target="24">0</div>
                <div class="stat-lbl">Team Members</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - matching homepage -->
<section class="cta-section">
    <div class="cta-grid-bg"></div>
    <div class="cta-orb"></div>
    <div class="container" style="position:relative;z-index:1;text-align:center">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:6px 14px;border-radius:100px;border:1px solid rgba(255,255,255,0.2);margin-bottom:20px">Mulai Sekarang</span>
            <h2 style="font-size:clamp(32px,5vw,56px);font-weight:900;color:#fff;letter-spacing:-0.025em;margin-bottom:16px">Tertarik Bekerja Sama?</h2>
            <p style="color:rgba(255,255,255,0.75);font-size:17px;margin-bottom:40px">Hubungi kami untuk konsultasi gratis dan penawaran terbaik</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="{{ route('contact') }}" class="btn-white">Hubungi Sekarang <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="https://wa.me/6285171711375" target="_blank" style="background:rgba(255,255,255,0.08);color:#fff;padding:16px 36px;border-radius:100px;font-weight:700;font-size:15px;border:2px solid rgba(255,255,255,0.3);display:inline-flex;align-items:center;gap:8px;text-decoration:none;backdrop-filter:blur(8px);transition:0.3s" onmouseover="this.style.background='rgba(255,255,255,0.15)';this.style.borderColor='rgba(255,255,255,0.6)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.3)'">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 0C5.373 0 0 5.373 0 12c0 2.117.554 4.107 1.523 5.836L0 24l6.338-1.498A11.956 11.956 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 11.999 0z"/></svg>
                    WhatsApp Kami
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Intersection Observer for reveal animations
    const obs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}})
    },{threshold:0.12,rootMargin:'0px 0px -20px 0px'});
    document.querySelectorAll('.reveal,.reveal-l,.reveal-r,.reveal-scale').forEach(el=>obs.observe(el));

    // Counter animation
    const cObs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{
            if(e.isIntersecting){
                const el=e.target, target=+el.dataset.target, dur=1400;
                let start=null;
                const step=ts=>{
                    if(!start)start=ts;
                    const p=Math.min((ts-start)/dur,1);
                    const ease=1-Math.pow(1-p,3);
                    el.textContent=Math.floor(ease*target)+(p<1?'':'+');
                    if(p<1)requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
                cObs.unobserve(el);
            }
        })
    },{threshold:0.5});
    document.querySelectorAll('.counter').forEach(c=>cObs.observe(c));
</script>
@endsection