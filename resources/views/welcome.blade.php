<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoulSync — Community Wellness Board</title>
    <meta name="description" content="A safe space for reflection, gratitude, and community support.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">

        {{-- ── Navigation ── --}}
        <nav class="nav-bar">
            <a href="{{ route('home') }}" class="nav-logo" style="text-decoration: none;">SoulSync</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">🌍 Community</a>
                @auth
                    <a href="{{ route('dashboard') }}">📊 Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">🚪 Logout</a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-auth">Login</a>
                    <a href="{{ route('register') }}" class="btn-auth btn-primary-nav">Join Us</a>
                @endauth
            </div>
        </nav>

        {{-- ── Header ── --}}
        <header>
            <h1>Discover Inner Peace</h1>
            <p>A safe space for reflection, gratitude, and community support.</p>
        </header>

        {{-- ── Alerts ── --}}
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert" style="background: rgba(239,68,68,0.12); color: #f87171; border: 1px solid rgba(239,68,68,0.2);">
                @foreach($errors->all() as $error) {{ $error }} @endforeach
            </div>
        @endif

        {{-- ── Category Filters ── --}}
        <section class="filter-bar">
            <a href="{{ route('home') }}" class="filter-chip {{ !request('category_id') ? 'active' : '' }}">✨ All Sparks</a>
            @foreach($categories as $cat)
                <a href="{{ route('home', ['category_id' => $cat->id]) }}" 
                   class="filter-chip {{ request('category_id') == $cat->id ? 'active' : '' }}">
                    {{ $cat->icon }} {{ $cat->name }}
                </a>
            @endforeach
        </section>

        {{-- ── Create Spark Form ── --}}
        <section class="spark-form">
            <h3>✍️ Share your reflection</h3>
            <form action="{{ route('sparks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">What's on your mind today?</label>
                    <textarea id="content" name="content" rows="3" placeholder="Write a thought, a gratitude, or a reflection..." required>{{ old('content') }}</textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mood_score">Current Vibe: <span id="mood-val" style="color: var(--accent);">7</span>/10</label>
                        <input type="range" id="mood_score" name="mood_score" min="1" max="10" value="7" oninput="document.getElementById('mood-val').textContent = this.value">
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">{{ Auth::check() ? '🚀 Post Spark' : '🚀 Post as Anonymous' }}</button>
            </form>
        </section>

        {{-- ── Sparks Board ── --}}
        <main class="board">
            @forelse($sparks as $spark)
                <div class="spark-card {{ $spark->color }}">
                    <div class="category-badge">
                        {{ $spark->category->icon ?? '✨' }} {{ $spark->category->name ?? 'General' }}
                    </div>
                    <div class="spark-content">"{{ $spark->content }}"</div>
                    <div class="spark-footer">
                        <span class="spark-author">{{ $spark->author ?? 'Anonymous' }}</span>
                        <div class="spark-meta">
                            <form action="{{ route('sparks.toggle', $spark) }}" method="POST">
                                @csrf
                                <button type="submit" class="reaction-btn {{ Auth::check() && $spark->isIgnitedBy(Auth::user()) ? 'active' : '' }}">
                                    <span class="heart-icon">{{ Auth::check() && $spark->isIgnitedBy(Auth::user()) ? '❤️' : '🤍' }}</span>
                                    <span>{{ $spark->reactions->count() }}</span>
                                </button>
                            </form>
                            <span>{{ $spark->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🌟</div>
                    <p>No reflections here yet. Be the first to share!</p>
                </div>
            @endforelse
        </main>
    </div>
</body>
</html>
