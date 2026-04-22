@extends('layouts.landing')

@section('title', $blog->title . ' - Cahaya Dimensi Bumi')

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
    .hero-detail{min-height:60vh;display:flex;align-items:center;position:relative;overflow:hidden;
      background:linear-gradient(135deg,#09090b 0%,#18181b 40%,#1c0a0a 70%,#0f0505 100%)}
    .hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 20%,transparent 100%)}
    .hero-orb1{position:absolute;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.18) 0%,transparent 70%);top:-100px;right:-100px;animation:float 10s ease-in-out infinite}
    .hero-orb2{position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.12) 0%,transparent 70%);bottom:-50px;left:-80px;animation:float 13s ease-in-out infinite 2s}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(220,38,38,0.1);border:1px solid rgba(220,38,38,0.3);padding:6px 16px;border-radius:100px;color:#fca5a5;font-size:12px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:28px;animation:fadeUp 0.6s ease forwards;animation:borderPulse 3s ease infinite}
    .pulse-dot{width:8px;height:8px;border-radius:50%;background:#ef4444;position:relative}
    .pulse-dot::after{content:'';position:absolute;inset:-4px;border-radius:50%;border:2px solid #ef4444;animation:pulse-ring 1.5s ease-out infinite}
    .hero-title{font-size:clamp(42px,6vw,72px);font-weight:900;line-height:1.1;letter-spacing:-0.035em;color:#fff;margin-bottom:24px;animation:fadeUp 0.7s 0.15s ease both}
    .hero-title span{background:linear-gradient(110deg,#fbbf24,#ef4444,#f97316);-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:shimmer 4s linear infinite}
    .hero-sub{color:#a1a1aa;font-size:16px;font-weight:400;max-width:600px;line-height:1.7;margin-bottom:0;animation:fadeUp 0.7s 0.25s ease both}

    .container{max-width:1180px;margin:0 auto;padding:0 24px}

    /* Content card */
    .detail-card{background:#0f0f12;border-radius:32px;border:1px solid rgba(255,255,255,0.06);overflow:hidden;margin-top:-80px;position:relative;z-index:20;backdrop-filter:blur(4px)}
    .detail-cover{height:460px;overflow:hidden;position:relative}
    .detail-cover img{width:100%;height:100%;object-fit:cover;transition:transform 0.7s ease}
    .detail-cover:hover img{transform:scale(1.02)}
    .detail-content{padding:48px}
    .blog-meta{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.05);border-radius:100px;padding:6px 16px;font-size:13px;color:#a1a1aa;margin-bottom:24px;width:fit-content}
    .blog-title{font-size:36px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin-bottom:24px;line-height:1.2}
    .blog-content{font-size:16px;color:#d4d4d8;line-height:1.8}
    .blog-content p{margin-bottom:1.5em}
    .blog-content h2{font-size:28px;font-weight:700;color:#fff;margin:1.5em 0 0.5em}
    .blog-content h3{font-size:22px;font-weight:600;color:#fff;margin:1.25em 0 0.5em}
    .blog-content ul, .blog-content ol{margin:1em 0 1em 1.5em}
    .blog-content li{margin:0.5em 0}
    .blog-content a{color:#f87171;text-decoration:underline}
    .blog-content a:hover{color:#ef4444}
    .blog-content blockquote{border-left:4px solid #dc2626;padding-left:20px;margin:1.5em 0;font-style:italic;color:#a1a1aa}
    .blog-content img{max-width:100%;border-radius:16px;margin:1.5em 0}
    .back-link{display:inline-flex;align-items:center;gap:8px;color:#a1a1aa;font-weight:500;transition:all 0.2s;text-decoration:none;margin-top:20px}
    .back-link:hover{color:#f87171;gap:12px}

    /* CTA section */
    .cta-section{padding:100px 0;background:linear-gradient(135deg,#7f1d1d 0%,#dc2626 50%,#991b1b 100%);position:relative;overflow:hidden}
    .cta-grid-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.05) 1px,transparent 1px);background-size:40px 40px}
    .cta-orb{position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.06);top:-100px;right:-80px}
    .btn-white{background:#fff;color:#dc2626;padding:16px 36px;border-radius:100px;font-weight:800;font-size:15px;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;text-decoration:none}
    .btn-white:hover{background:#f9fafb;transform:translateY(-3px);box-shadow:0 20px 40px rgba(0,0,0,0.2)}
</style>

<!-- Hero Section (dark, matching homepage) -->
<section class="hero-detail">
    <div class="hero-grid"></div>
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>
    <div class="container" style="position:relative;z-index:10;text-align:center;padding-top:100px;padding-bottom:100px">
        <div class="hero-badge" style="margin-left:auto;margin-right:auto">
            <div class="pulse-dot"></div>
            <span>Blog Article</span>
        </div>
        <h1 class="hero-title">
            <span>{{ Str::limit($blog->title, 60) }}</span>
        </h1>
        <p class="hero-sub">
            {{ $blog->published_at->format('F d, Y') }}
        </p>
    </div>
</section>

<!-- Blog Content -->
<section class="pb-24 bg-[#09090b] relative">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(220,38,38,0.05),transparent)]"></div>
    <div class="container relative z-10">
        <div class="detail-card reveal-scale">
            @if($blog->featured_image)
            <div class="detail-cover">
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
            </div>
            @else
            <div class="detail-cover bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                <svg class="w-32 h-32 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4zM8 8h8v2H8zm0 4h8v2H8zm0 4h5v2H8z"/>
                </svg>
            </div>
            @endif

            <div class="detail-content">
                <div class="blog-meta">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>{{ $blog->published_at->format('d M Y') }}</span>
                </div>

                <h1 class="blog-title">{{ $blog->title }}</h1>

                <div class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <div style="margin-top:48px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.08)">
                    <a href="{{ route('blog') }}" class="back-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back to All Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section (matching homepage) -->
<section class="cta-section">
    <div class="cta-grid-bg"></div>
    <div class="cta-orb"></div>
    <div class="container" style="position:relative;z-index:1;text-align:center">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:6px 14px;border-radius:100px;border:1px solid rgba(255,255,255,0.2);margin-bottom:20px">Mulai Sekarang</span>
            <h2 style="font-size:clamp(32px,5vw,56px);font-weight:900;color:#fff;letter-spacing:-0.025em;margin-bottom:16px">Butuh Konsultasi Konstruksi?</h2>
            <p style="color:rgba(255,255,255,0.75);font-size:17px;margin-bottom:40px">Hubungi tim ahli kami untuk solusi terbaik proyek Anda</p>
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
    const obs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}})
    },{threshold:0.12,rootMargin:'0px 0px -20px 0px'});
    document.querySelectorAll('.reveal, .reveal-scale').forEach(el=>obs.observe(el));
</script>
@endsection