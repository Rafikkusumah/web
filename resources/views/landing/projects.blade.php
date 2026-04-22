@extends('layouts.landing')

@section('title', 'Our Projects - Cahaya Dimensi Bumi')

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
    .hero-projects{min-height:70vh;display:flex;align-items:center;position:relative;overflow:hidden;
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

    /* Project Cards (matching homepage style) */
    .proj-card{background:#0f0f12;border-radius:24px;overflow:hidden;transition:all 0.4s cubic-bezier(0.2,0.9,0.4,1.1);border:1px solid rgba(255,255,255,0.06);height:100%;display:flex;flex-direction:column;text-decoration:none}
    .proj-card:hover{transform:translateY(-8px);background:#111117;border-color:rgba(220,38,38,0.3);box-shadow:0 20px 40px rgba(0,0,0,0.3)}
    .proj-img-wrapper{height:240px;overflow:hidden;position:relative}
    .proj-img{width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease}
    .proj-card:hover .proj-img{transform:scale(1.08)}
    .proj-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);opacity:0;transition:opacity 0.3s;display:flex;align-items:flex-end;padding:20px}
    .proj-card:hover .proj-overlay{opacity:1}
    .proj-category{background:rgba(220,38,38,0.9);color:#fff;font-size:11px;font-weight:700;padding:4px 12px;border-radius:100px;letter-spacing:0.08em}
    .proj-content{padding:24px;flex:1}
    .proj-title{font-size:20px;font-weight:800;color:#fff;margin-bottom:10px;letter-spacing:-0.01em;transition:color 0.2s}
    .proj-card:hover .proj-title{color:#f87171}
    .proj-loc{display:flex;align-items:center;gap:6px;font-size:13px;color:#a1a1aa;margin-bottom:16px}
    .proj-desc{font-size:14px;color:#71717a;line-height:1.6;margin-bottom:20px}
    .proj-link{display:flex;align-items:center;gap:6px;color:#ef4444;font-weight:600;font-size:13px;transition:gap 0.2s}
    .proj-card:hover .proj-link{gap:10px}

    /* Pagination styling */
    .pagination{display:flex;justify-content:center;gap:8px;margin-top:48px;flex-wrap:wrap}
    .pagination .page-item{list-style:none}
    .pagination .page-link{display:flex;align-items:center;justify-content:center;min-width:40px;height:40px;padding:0 12px;background:#0f0f12;border:1px solid rgba(255,255,255,0.08);border-radius:100px;color:#a1a1aa;font-weight:500;transition:all 0.2s;text-decoration:none}
    .pagination .page-link:hover{background:#1f1f24;border-color:rgba(220,38,38,0.4);color:#fff}
    .pagination .active .page-link{background:#dc2626;border-color:#dc2626;color:#fff}
    .pagination .disabled .page-link{opacity:0.4;cursor:not-allowed}
</style>

<!-- Hero Section - matching homepage -->
<section class="hero-projects">
    <div class="hero-grid"></div>
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>
    <div class="container" style="position:relative;z-index:10;text-align:center;padding-top:80px;padding-bottom:80px">
        <div class="hero-badge" style="margin-left:auto;margin-right:auto">
            <div class="pulse-dot"></div>
            <span>Our Portfolio</span>
        </div>
        <h1 class="hero-title">
            Our<br>
            <span class="line2">Projects</span>
        </h1>
        <p class="hero-sub" style="max-width:600px;margin-left:auto;margin-right:auto">
            Portofolio proyek unggulan yang telah kami kerjakan dengan standar kualitas tertinggi.
        </p>
    </div>
</section>

<!-- Projects Grid Section -->
<section class="py-24 bg-[#09090b] relative">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(220,38,38,0.05),transparent)]"></div>
    <div class="container relative z-10">
        @if($projects->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <a href="{{ route('project.detail', $project->id) }}" class="proj-card reveal-scale">
                <div class="proj-img-wrapper">
                    @if($project->cover_image)
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="proj-img">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22" stroke="#fff" fill="none" stroke-width="1.5"/>
                        </svg>
                    </div>
                    @endif
                    <div class="proj-overlay">
                        <span class="proj-category">{{ $project->category ?? 'Featured Project' }}</span>
                    </div>
                </div>
                <div class="proj-content">
                    <h3 class="proj-title">{{ $project->company_name }}</h3>
                    <div class="proj-loc">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22c-2 0-8-5.5-8-10c0-4.5 3.5-8 8-8s8 3.5 8 8c0 4.5-6 10-8 10z"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ $project->location }}
                    </div>
                    <p class="proj-desc">{{ Str::limit($project->description, 100) }}</p>
                    <div class="proj-link">
                        <span>View Details</span>
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination (styling dark mode) -->
        <div class="reveal" style="margin-top:60px">
            {{ $projects->links('pagination::tailwind') }}
        </div>

        @else
        <div class="text-center py-24 bg-white/5 rounded-3xl border border-white/10">
            <svg class="w-24 h-24 mx-auto text-gray-500 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22" stroke="#fff" fill="none" stroke-width="1.5"/>
            </svg>
            <p class="text-gray-400 text-lg">Belum ada proyek untuk ditampilkan.</p>
        </div>
        @endif
    </div>
</section>

<script>
    const obs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}})
    },{threshold:0.12,rootMargin:'0px 0px -20px 0px'});
    document.querySelectorAll('.reveal, .reveal-scale').forEach(el=>obs.observe(el));
</script>
@endsection