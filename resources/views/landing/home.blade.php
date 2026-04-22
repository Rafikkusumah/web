
@extends('layouts.landing')

@section('title', 'Home')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#fff;overflow-x:hidden}
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-thumb{background:#dc2626;border-radius:10px}

@keyframes float{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-18px) scale(1.02)}}
@keyframes spin-slow{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(32px)}to{opacity:1;transform:translateY(0)}}
@keyframes pulse-ring{0%{transform:scale(1);opacity:1}100%{transform:scale(2.2);opacity:0}}
@keyframes glow{0%,100%{box-shadow:0 0 20px rgba(220,38,38,0.3)}50%{box-shadow:0 0 40px rgba(220,38,38,0.6)}}
@keyframes shimmer{0%{background-position:-200% center}100%{background-position:200% center}}
@keyframes countUp{from{opacity:0;transform:scale(0.5)}to{opacity:1;transform:scale(1)}}
@keyframes borderPulse{0%,100%{border-color:rgba(220,38,38,0.3)}50%{border-color:rgba(220,38,38,0.8)}}

.reveal{opacity:0;transform:translateY(36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
.reveal.in{opacity:1;transform:none}
.reveal-l{opacity:0;transform:translateX(-36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
.reveal-l.in{opacity:1;transform:none}
.reveal-r{opacity:0;transform:translateX(36px);transition:all 0.75s cubic-bezier(0.16,1,0.3,1)}
.reveal-r.in{opacity:1;transform:none}
.reveal-scale{opacity:0;transform:scale(0.92);transition:all 0.6s cubic-bezier(0.16,1,0.3,1)}
.reveal-scale.in{opacity:1;transform:none}

/* HERO */
.hero{min-height:100vh;display:flex;align-items:center;position:relative;overflow:hidden;padding-top:80px;
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
.hero-btns{display:flex;gap:14px;flex-wrap:wrap;animation:fadeUp 0.7s 0.35s ease both}
.btn-primary{background:#dc2626;color:#fff;padding:14px 30px;border-radius:100px;font-weight:700;font-size:15px;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;text-decoration:none;animation:glow 3s ease infinite}
.btn-primary:hover{background:#b91c1c;transform:translateY(-3px);box-shadow:0 20px 40px rgba(220,38,38,0.4)}
.btn-ghost{background:rgba(255,255,255,0.06);color:#fff;padding:14px 30px;border-radius:100px;font-weight:600;font-size:15px;border:1px solid rgba(255,255,255,0.15);cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;text-decoration:none;backdrop-filter:blur(8px)}
.btn-ghost:hover{background:rgba(255,255,255,0.12);border-color:rgba(255,255,255,0.3);transform:translateY(-3px)}
.hero-stats{display:flex;gap:40px;margin-top:56px;padding-top:36px;border-top:1px solid rgba(255,255,255,0.08);animation:fadeUp 0.7s 0.5s ease both}
.hero-stat-num{font-size:30px;font-weight:900;color:#fff;letter-spacing:-0.03em}
.hero-stat-label{font-size:11px;color:#71717a;text-transform:uppercase;letter-spacing:0.1em;margin-top:2px}
.hero-visual{position:absolute;right:6%;top:50%;transform:translateY(-50%);animation:fadeUp 0.8s 0.4s ease both}
.hero-card-stack{position:relative;width:320px;height:400px}
.hcard{position:absolute;border-radius:20px;padding:24px;backdrop-filter:blur(20px)}
.hcard-main{background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);width:280px;height:320px;top:40px;left:20px;animation:float 8s ease-in-out infinite}
.hcard-accent{background:rgba(220,38,38,0.15);border:1px solid rgba(220,38,38,0.25);width:220px;height:180px;top:0;right:0;animation:float 10s ease-in-out infinite 1.5s}
.hcard-small{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);width:160px;height:100px;bottom:20px;right:10px;animation:float 7s ease-in-out infinite 3s}

/* ABOUT */
.about{padding:100px 0;background:#fff;position:relative;overflow:hidden}
.about-bg{position:absolute;top:-200px;right:-200px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.04) 0%,transparent 70%)}
.section-label{display:inline-block;background:#fef2f2;color:#dc2626;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:6px 14px;border-radius:100px;margin-bottom:16px}
.section-title{font-size:clamp(32px,5vw,54px);font-weight:900;line-height:1.1;letter-spacing:-0.025em;color:#09090b;margin-bottom:16px}
.section-title span{color:#dc2626}
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:36px 0}
.stat-box{background:#fff;border:1px solid #f3f4f6;border-radius:16px;padding:24px 20px;text-align:center;transition:all 0.3s;position:relative;overflow:hidden}
.stat-box::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(220,38,38,0.04),transparent);opacity:0;transition:opacity 0.3s}
.stat-box:hover{transform:translateY(-6px);border-color:rgba(220,38,38,0.2);box-shadow:0 16px 40px rgba(0,0,0,0.08)}
.stat-box:hover::before{opacity:1}
.stat-num{font-size:36px;font-weight:900;color:#dc2626;letter-spacing:-0.03em;line-height:1}
.stat-lbl{font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;margin-top:6px}
.logo-wrapper{background:#fafafa;border-radius:24px;padding:48px;border:1px solid #f0f0f0;position:relative;overflow:hidden;transition:all 0.4s}
.logo-wrapper:hover{box-shadow:0 24px 64px rgba(0,0,0,0.1);transform:scale(1.01)}
.logo-wrapper::after{content:'';position:absolute;inset:0;border-radius:24px;background:linear-gradient(135deg,rgba(220,38,38,0.04),transparent)}
.logo-wrapper img{width:100%;object-fit:contain;position:relative;z-index:1}

/* SERVICES */
.services{padding:100px 0;background:#09090b;position:relative;overflow:hidden}
.services-bg{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:800px;height:800px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.06) 0%,transparent 70%)}
.services .section-title{color:#fff}
.services .section-title span{background:linear-gradient(110deg,#fbbf24,#ef4444);-webkit-background-clip:text;background-clip:text;color:transparent}
.services .section-label{background:rgba(220,38,38,0.15);color:#fca5a5;border:1px solid rgba(220,38,38,0.2)}
.svc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,0.06);border-radius:24px;overflow:hidden;margin-top:48px}
.svc-card{background:#0f0f12;padding:40px 32px;transition:all 0.4s;position:relative;overflow:hidden;cursor:default}
.svc-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(220,38,38,0.08),transparent);opacity:0;transition:opacity 0.4s}
.svc-card:hover{background:#111117}
.svc-card:hover::before{opacity:1}
.svc-card:hover .svc-icon{transform:scale(1.1) rotate(3deg);box-shadow:0 0 30px rgba(220,38,38,0.4)}
.svc-card:hover .svc-arrow{opacity:1;transform:translateX(4px)}
.svc-icon{width:56px;height:56px;background:linear-gradient(135deg,#dc2626,#991b1b);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;transition:all 0.4s;box-shadow:0 8px 24px rgba(220,38,38,0.2)}
.svc-title{font-size:20px;font-weight:700;color:#fff;margin-bottom:12px;letter-spacing:-0.01em}
.svc-desc{font-size:14px;color:#71717a;line-height:1.7}
.svc-arrow{opacity:0;transition:all 0.3s;color:#ef4444;margin-top:20px;font-size:22px}

/* CLIENTS */
.clients{padding:80px 0;background:#fff;overflow:hidden}
.logo-track{display:flex;gap:20px;animation:marquee 30s linear infinite;width:max-content}
.logo-track:hover{animation-play-state:paused}
.logo-item{width:140px;height:72px;background:#fafafa;border:1px solid #f0f0f0;border-radius:14px;display:flex;align-items:center;justify-content:center;padding:12px;flex-shrink:0;transition:all 0.3s}
.logo-item:hover{border-color:rgba(220,38,38,0.2);background:#fff;box-shadow:0 8px 24px rgba(0,0,0,0.06)}
.logo-item img{max-width:100%;max-height:100%;object-fit:contain;filter:grayscale(1) opacity(0.6);transition:0.3s}
.logo-item:hover img{filter:none;opacity:1}
.logo-fade{mask-image:linear-gradient(to right,transparent,black 12%,black 88%,transparent)}

/* VISION/MISSION */
.vm{padding:100px 0;background:linear-gradient(180deg,#fafafa 0%,#fff 100%)}
.vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:48px}
.vm-card{background:#fff;border-radius:24px;padding:40px;border:1px solid #f0f0f0;position:relative;overflow:hidden;transition:all 0.4s}
.vm-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,#dc2626,#991b1b);border-radius:4px 0 0 4px}
.vm-card:hover{transform:translateY(-6px);box-shadow:0 24px 48px rgba(0,0,0,0.08);border-color:rgba(220,38,38,0.15)}
.vm-icon{width:48px;height:48px;background:#fef2f2;border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:20px}
.vm-title{font-size:26px;font-weight:800;color:#09090b;margin-bottom:16px;letter-spacing:-0.02em}
.vm-text{font-size:15px;color:#4b5563;line-height:1.8}
.vm-list{list-style:none;space-y:12px}
.vm-list li{display:flex;gap:10px;padding:8px 0;border-bottom:1px solid #f9fafb;font-size:15px;color:#4b5563;line-height:1.6}
.vm-list li:last-child{border-bottom:none}
.vm-arrow{color:#dc2626;font-weight:800;flex-shrink:0;font-size:13px;margin-top:3px}

/* PROJECTS */
.projects{padding:100px 0;background:#09090b}
.projects .section-title{color:#fff}
.projects .section-label{background:rgba(220,38,38,0.15);color:#fca5a5;border:1px solid rgba(220,38,38,0.2)}
.proj-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px}
.proj-card{border-radius:20px;overflow:hidden;position:relative;aspect-ratio:3/4;background:#1a1a1f;cursor:pointer;transition:all 0.4s}
.proj-card:hover{transform:scale(1.02)}
.proj-img{width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease;filter:brightness(0.7)}
.proj-card:hover .proj-img{transform:scale(1.08);filter:brightness(0.5)}
.proj-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.85) 0%,transparent 50%);padding:24px}
.proj-info{position:absolute;bottom:0;left:0;right:0;padding:28px;transform:translateY(8px);transition:transform 0.4s}
.proj-card:hover .proj-info{transform:translateY(0)}
.proj-tag{background:rgba(220,38,38,0.8);color:#fff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;padding:4px 10px;border-radius:100px;display:inline-block;margin-bottom:10px}
.proj-name{font-size:18px;font-weight:800;color:#fff;letter-spacing:-0.01em;margin-bottom:6px}
.proj-loc{font-size:13px;color:#a1a1aa;display:flex;align-items:center;gap:4px}
.proj-cta{opacity:0;transition:opacity 0.3s 0.1s;margin-top:12px;color:#f87171;font-size:13px;font-weight:600}
.proj-card:hover .proj-cta{opacity:1}

/* TESTIMONIALS */
.testi{padding:100px 0;background:#fff}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:48px}
.testi-card{background:#fff;border:1px solid #f0f0f0;border-radius:24px;padding:32px;transition:all 0.4s;position:relative;overflow:hidden}
.testi-card::before{content:'"';position:absolute;top:-10px;right:20px;font-size:120px;color:#fef2f2;font-family:serif;line-height:1;z-index:0}
.testi-card:hover{transform:translateY(-8px);box-shadow:0 24px 48px rgba(0,0,0,0.1);border-color:rgba(220,38,38,0.12)}
.stars{color:#f59e0b;font-size:14px;margin-bottom:16px;letter-spacing:2px}
.testi-text{font-size:14px;color:#4b5563;line-height:1.8;position:relative;z-index:1;font-style:italic}
.testi-author{margin-top:20px;padding-top:16px;border-top:1px solid #f3f4f6}
.testi-name{font-weight:700;color:#09090b;font-size:14px}
.testi-role{font-size:12px;color:#9ca3af;margin-top:2px}

/* CTA */
.cta{padding:100px 0;background:linear-gradient(135deg,#7f1d1d 0%,#dc2626 50%,#991b1b 100%);position:relative;overflow:hidden}
.cta-grid-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.05) 1px,transparent 1px);background-size:40px 40px}
.cta-orb{position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.06);top:-100px;right:-80px}
.cta h2{font-size:clamp(32px,5vw,56px);font-weight:900;color:#fff;letter-spacing:-0.025em;margin-bottom:16px}
.cta p{color:rgba(255,255,255,0.75);font-size:17px;margin-bottom:40px}
.btn-white{background:#fff;color:#dc2626;padding:16px 36px;border-radius:100px;font-weight:800;font-size:15px;border:none;cursor:pointer;transition:all 0.3s;text-decoration:none;display:inline-flex;align-items:center;gap:8px}
.btn-white:hover{background:#f9fafb;transform:translateY(-3px);box-shadow:0 20px 40px rgba(0,0,0,0.2)}
.btn-border{background:rgba(255,255,255,0.08);color:#fff;padding:16px 36px;border-radius:100px;font-weight:700;font-size:15px;border:2px solid rgba(255,255,255,0.3);cursor:pointer;transition:all 0.3s;text-decoration:none;display:inline-flex;align-items:center;gap:8px;backdrop-filter:blur(8px)}
.btn-border:hover{background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.6);transform:translateY(-3px)}

.container{max-width:1180px;margin:0 auto;padding:0 24px}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center}
.text-muted{color:#6b7280;font-size:16px;line-height:1.8}
.arrow{display:inline-flex;align-items:center;gap:6px;background:#dc2626;color:#fff;padding:14px 28px;border-radius:100px;font-weight:700;font-size:14px;text-decoration:none;transition:all 0.3s;margin-top:32px}
.arrow:hover{background:#b91c1c;transform:translateY(-3px);box-shadow:0 16px 32px rgba(220,38,38,0.3)}
.arrow svg{transition:transform 0.2s}.arrow:hover svg{transform:translateX(4px)}

@media(max-width:768px){
  .hero-visual{display:none}
  .svc-grid,.vm-grid,.proj-grid,.testi-grid,.grid-2,.stats-grid{grid-template-columns:1fr}
  .hero-stats{gap:24px}
}
</style>

<!-- HERO -->
<section class="hero">
  <div class="hero-grid"></div>
  <div class="hero-orb1"></div>
  <div class="hero-orb2"></div>
  <div class="container" style="position:relative;z-index:10;padding-top:80px;padding-bottom:80px">
    <div class="hero-badge">
      <div class="pulse-dot"></div>
      <span>General Contractor & dormakaba Partner</span>
    </div>
    <h1 class="hero-title">
      Cahaya<br>
      <span class="line2">Dimensi Bumi</span>
    </h1>
    <p class="hero-sub">Building Excellence, Engineering Trust — Solusi Konstruksi & Pintu Otomatis Terintegrasi untuk Indonesia.</p>
    <div class="hero-btns">
      <a href="{{ route('our-projects') }}" class="btn-primary">
        Explore Projects
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="https://wa.me/6285171711375" target="_blank" class="btn-ghost">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 17z"/></svg>
        Free Consultation
      </a>
    </div>
    <div class="hero-stats">
      <div><div class="hero-stat-num">10+</div><div class="hero-stat-label">Years Excellence</div></div>
      <div style="width:1px;background:rgba(255,255,255,0.08)"></div>
      <div><div class="hero-stat-num">150+</div><div class="hero-stat-label">Projects Done</div></div>
      <div style="width:1px;background:rgba(255,255,255,0.08)"></div>
      <div><div class="hero-stat-num">100%</div><div class="hero-stat-label">Satisfaction</div></div>
    </div>
  </div>
  <!-- Floating card stack - decorative -->
  <div class="hero-visual">
    <div class="hero-card-stack">
      <div class="hcard hcard-accent" style="display:flex;flex-direction:column;justify-content:flex-end">
        <div style="font-size:11px;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px">Active Project</div>
        <div style="font-size:20px;font-weight:800;color:#fff">DoubleTree Hotel</div>
        <div style="font-size:12px;color:rgba(255,255,255,0.6);margin-top:4px">Jakarta, Indonesia</div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:8px">
          <div style="height:4px;flex:1;background:rgba(255,255,255,0.15);border-radius:4px"><div style="height:100%;width:72%;background:#ef4444;border-radius:4px"></div></div>
          <span style="font-size:11px;color:#fca5a5;font-weight:700">72%</span>
        </div>
      </div>
      <div class="hcard hcard-main" style="display:flex;flex-direction:column;justify-content:flex-end">
        <div style="width:40px;height:40px;background:linear-gradient(135deg,#dc2626,#991b1b);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px">
          <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22" stroke="#fff" fill="none" stroke-width="2"/></svg>
        </div>
        <div style="font-size:11px;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px">Completed</div>
        <div style="font-size:24px;font-weight:900;color:#fff;letter-spacing:-0.02em">128<span style="color:#ef4444">+</span></div>
        <div style="font-size:14px;color:rgba(255,255,255,0.5);margin-top:4px">Total Projects</div>
        <div style="margin-top:20px;display:flex;gap:8px">
          <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12)"></div>
          <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);margin-left:-12px"></div>
          <div style="width:36px;height:36px;border-radius:50%;background:rgba(220,38,38,0.4);border:1px solid rgba(220,38,38,0.5);margin-left:-12px;font-size:11px;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700">+86</div>
        </div>
      </div>
      <div class="hcard hcard-small" style="display:flex;align-items:center;gap:12px">
        <div style="width:36px;height:36px;background:rgba(34,197,94,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
          <svg width="16" height="16" fill="#22c55e" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01" stroke="#22c55e" fill="none" stroke-width="2.5"/></svg>
        </div>
        <div>
          <div style="font-size:11px;font-weight:700;color:#fff">On Schedule</div>
          <div style="font-size:10px;color:rgba(255,255,255,0.4);margin-top:2px">All active projects</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about">
  <div class="about-bg"></div>
  <div class="container">
    <div class="grid-2">
      <div class="reveal-l">
        <div class="logo-wrapper">
          <div style="width:100%;height:220px;background:linear-gradient(135deg,#fef2f2,#fff);border-radius:16px;display:flex;align-items:center;justify-content:center">
            <div style="text-align:center">
              <div style="font-size:48px;font-weight:900;color:#dc2626;letter-spacing:-0.03em;line-height:1">CDB</div>
              <div style="font-size:11px;color:#9ca3af;letter-spacing:0.2em;text-transform:uppercase;margin-top:4px">Cahaya Dimensi Bumi</div>
            </div>
          </div>
        </div>
      </div>
      <div class="reveal-r">
        <span class="section-label">Tentang Kami</span>
        <h2 class="section-title">The <span>Trusted Force</span> Behind Modern Infrastructure</h2>
        <p class="text-muted">PT Cahaya Dimensi Bumi adalah perusahaan general kontraktor kelas atas yang mengkombinasikan keahlian konstruksi dengan teknologi pintu otomatis dormakaba — memberikan solusi <strong>end-to-end</strong> untuk proyek komersial & residensial premium.</p>
        <div class="stats-grid">
          <div class="stat-box reveal-scale"><div class="stat-num counter" data-target="128">0</div><div class="stat-lbl">Projects</div></div>
          <div class="stat-box reveal-scale" style="transition-delay:0.08s"><div class="stat-num counter" data-target="86">0</div><div class="stat-lbl">Clients</div></div>
          <div class="stat-box reveal-scale" style="transition-delay:0.16s"><div class="stat-num counter" data-target="12">0</div><div class="stat-lbl">Years</div></div>
        </div>
        <a href="{{ route('about') }}" class="arrow">Discover Our Story <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="services">
  <div class="services-bg"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="reveal" style="text-align:center">
      <span class="section-label">Layanan Unggulan</span>
      <h2 class="section-title" style="margin-top:12px">Kompetensi <span>Inti Kami</span></h2>
      <p style="color:#52525b;font-size:16px;margin-top:8px">Solusi terintegrasi untuk kebutuhan konstruksi dan akses otomatis</p>
    </div>
    <div class="svc-grid">
      <div class="svc-card reveal-scale">
        <div class="svc-icon">
          <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22" stroke="#fff" fill="none" stroke-width="1.5"/></svg>
        </div>
        <div class="svc-title">General Construction</div>
        <p class="svc-desc">Pembangunan baru, renovasi besar, manajemen proyek kompleks dengan standar internasional dan pengawasan ketat.</p>
        <div class="svc-arrow">→</div>
      </div>
      <div class="svc-card reveal-scale" style="transition-delay:0.1s">
        <div class="svc-icon">
          <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="3" x2="12" y2="21"/><line x1="3" y1="9" x2="21" y2="9"/></svg>
        </div>
        <div class="svc-title">dormakaba Systems</div>
        <p class="svc-desc">Distributor resmi & installer pintu otomatis dormakaba: sliding, revolving, folding door dengan sensor teknologi canggih.</p>
        <div class="svc-arrow">→</div>
      </div>
      <div class="svc-card reveal-scale" style="transition-delay:0.2s">
        <div class="svc-icon">
          <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <div class="svc-title">Interior & Renovation</div>
        <p class="svc-desc">Desain interior modern, renovasi total, tata ruang ergonomis untuk perkantoran, retail, dan hunian premium.</p>
        <div class="svc-arrow">→</div>
      </div>
    </div>
  </div>
</section>

<!-- CLIENTS -->
<section class="clients">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:40px">
      <h3 style="font-size:20px;font-weight:700;color:#09090b">Dipercaya oleh <span style="color:#dc2626">100+ Perusahaan</span> di Indonesia</h3>
      <p style="color:#9ca3af;margin-top:8px;font-size:14px">Mitra strategis berbagai industri terkemuka</p>
    </div>
  </div>
  <div class="logo-fade">
    <div style="overflow:hidden">
      <div class="logo-track">
        <div class="logo-item"><img src="{{ asset('storage/clients/Double-Tree.webp') }}" alt="DoubleTree" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>DoubleTree</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Horison.webp') }}" alt="Horison" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Horison Hotels</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/ITC.webp') }}" alt="ITC" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>ITC Group</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/LGInnotek.webp') }}" alt="LG Innotek" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>LG Innotek</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Sasa.webp') }}" alt="Sasa" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Sasa Foods</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Abipraya.webp') }}" alt="Abipraya" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Abipraya</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Astra-International.webp') }}" alt="Astra" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Astra Int\'l</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/BSJ.webp') }}" alt="BSJ" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>BSJ Group</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Double-Tree.webp') }}" alt="DoubleTree" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>DoubleTree</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Horison.webp') }}" alt="Horison" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Horison Hotels</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/ITC.webp') }}" alt="ITC" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>ITC Group</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/LGInnotek.webp') }}" alt="LG Innotek" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>LG Innotek</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Sasa.webp') }}" alt="Sasa" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Sasa Foods</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Abipraya.webp') }}" alt="Abipraya" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Abipraya</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/Astra-International.webp') }}" alt="Astra" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>Astra Int\'l</span>'"></div>
        <div class="logo-item"><img src="{{ asset('storage/clients/BSJ.webp') }}" alt="BSJ" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;color:#374151;font-size:13px\'>BSJ Group</span>'"></div>
      </div>
    </div>
  </div>
</section>

<!-- VISION MISSION -->
<section class="vm">
  <div class="container">
    <div class="reveal" style="text-align:center">
      <span class="section-label">Pilar Perusahaan</span>
      <h2 class="section-title" style="margin-top:12px">Visi & <span>Misi</span></h2>
    </div>
    <div class="vm-grid">
      <div class="vm-card reveal-l">
        <div class="vm-icon">
          <svg width="22" height="22" fill="#dc2626" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <div class="vm-title">Visi</div>
        <p class="vm-text">Menjadi perusahaan kontraktor terdepan di Asia Tenggara dengan solusi konstruksi berkelanjutan & pintu otomatis berteknologi tinggi, mengutamakan inovasi dan kepercayaan klien.</p>
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
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- RECENT PROJECTS FROM DATABASE -->
<section class="projects">
  <div class="container">
    <div class="reveal" style="text-align:center">
      <span class="section-label">Portofolio</span>
      <h2 class="section-title" style="margin-top:12px">Proyek <span style="background:linear-gradient(110deg,#fbbf24,#ef4444);-webkit-background-clip:text;background-clip:text;color:transparent">Terbaru</span></h2>
      <p style="color:#9ca3af;margin-top:8px;font-size:14px">Beberapa proyek terbaru yang telah kami kerjakan</p>
    </div>

    @if(isset($recentProjects) && $recentProjects->count() > 0)
    <div class="proj-grid">
      @foreach($recentProjects->take(3) as $project)
      <a href="{{ route('project.detail', $project->id) }}" class="proj-card reveal-scale" style="text-decoration:none;display:block;{{ $loop->index > 0 ? 'transition-delay:' . ($loop->index * 0.1) . 's' : '' }}" onmouseover="this.querySelector('.proj-img')?.style.setProperty('transform','scale(1.05)')" onmouseout="this.querySelector('.proj-img')?.style.setProperty('transform','scale(1)')">
        <div style="width:100%;height:100%;overflow:hidden;position:relative">
          @if($project->cover_image)
          <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="proj-img" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s">
          @else
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
            <svg width="48" height="48" fill="rgba(255,255,255,0.1)" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          </div>
          @endif
        </div>
        <div class="proj-info">
          <div class="proj-tag">{{ $project->category ?? 'Project' }}</div>
          <div class="proj-name">{{ $project->company_name }}</div>
          <div class="proj-loc">📍 {{ $project->location }}</div>
          <div class="proj-cta">Lihat detail →</div>
        </div>
      </a>
      @endforeach
    </div>
    <div class="reveal" style="text-align:center;margin-top:40px">
      <a href="{{ route('our-projects') }}" class="btn-primary" style="display:inline-flex">Lihat Semua Proyek <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
    </div>
    @else
    <div class="reveal" style="text-align:center;padding:60px 20px;background:rgba(255,255,255,0.02);border-radius:16px;border:1px solid rgba(255,255,255,0.08)">
      <svg width="64" height="64" fill="rgba(255,255,255,0.1)" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
      <p style="color:#9ca3af;font-size:15px">Belum ada proyek untuk ditampilkan.</p>
    </div>
    @endif
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testi">
  <div class="container">
    <div class="reveal" style="text-align:center">
      <span class="section-label">Testimonial</span>
      <h2 class="section-title" style="margin-top:12px">Apa Kata <span>Klien Kami?</span></h2>
      <p class="text-muted" style="margin-top:8px;max-width:480px;margin-left:auto;margin-right:auto">100+ perusahaan mempercayakan proyeknya kepada kami</p>
    </div>
    <div class="testi-grid">
      <div class="testi-card reveal-scale">
        <div class="stars">★★★★★</div>
        <p class="testi-text">"Profesionalisme tinggi, hasil konstruksi sangat presisi. Tim bekerja dengan efisien dan selalu update progres secara real-time."</p>
        <div class="testi-author">
          <div class="testi-name">Manajer Proyek</div>
          <div class="testi-role">Astra International</div>
        </div>
      </div>
      <div class="testi-card reveal-scale" style="transition-delay:0.1s">
        <div class="stars">★★★★★</div>
        <p class="testi-text">"Pemasangan pintu otomatis dormakaba sangat mulus, dukungan purna jual responsif. Sangat direkomendasikan untuk proyek hospitality."</p>
        <div class="testi-author">
          <div class="testi-name">Facility Manager</div>
          <div class="testi-role">DoubleTree Hotel Jakarta</div>
        </div>
      </div>
      <div class="testi-card reveal-scale" style="transition-delay:0.2s">
        <div class="stars">★★★★★</div>
        <p class="testi-text">"Partner tepercaya untuk proyek infrastruktur besar. Tepat waktu, komunikasi transparan, dan hasil akhir memuaskan."</p>
        <div class="testi-author">
          <div class="testi-name">Direktur Operasional</div>
          <div class="testi-role">LG Innotek Indonesia</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <div class="cta-grid-bg"></div>
  <div class="cta-orb"></div>
  <div class="container" style="position:relative;z-index:1;text-align:center">
    <div class="reveal">
      <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:6px 14px;border-radius:100px;border:1px solid rgba(255,255,255,0.2);margin-bottom:20px">Mulai Sekarang</span>
      <h2>Siap Memulai<br>Proyek Anda?</h2>
      <p>Dapatkan konsultasi gratis dan penawaran kompetitif dari tim ahli kami.</p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="https://wa.me/6285171711375" target="_blank" class="btn-white">Hubungi Sekarang <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        <a href="https://wa.me/6285171711375" target="_blank" class="btn-border">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 0C5.373 0 0 5.373 0 12c0 2.117.554 4.107 1.523 5.836L0 24l6.338-1.498A11.956 11.956 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 11.999 0z"/></svg>
          WhatsApp Kami
        </a>
      </div>
    </div>
  </div>
</section>

<script>
const obs = new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}})
},{threshold:0.12,rootMargin:'0px 0px -20px 0px'});
document.querySelectorAll('.reveal,.reveal-l,.reveal-r,.reveal-scale').forEach(el=>obs.observe(el));

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
