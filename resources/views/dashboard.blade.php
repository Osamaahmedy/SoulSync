<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — SoulSync</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">

        {{-- ── Navigation ── --}}
        <nav class="nav-bar">
            <a href="{{ route('home') }}" class="nav-logo" style="text-decoration:none;">SoulSync</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">🌍 Community</a>
                <a href="{{ route('dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('profile.edit') }}">⚙️ Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">🚪 Logout</a>
                </form>
            </div>
        </nav>

        {{-- ── Header ── --}}
        <header style="margin-bottom: 2.5rem;">
            <h1>Welcome back, {{ Auth::user()->name }} 👋</h1>
            <p>Here's a snapshot of your mental well-being journey.</p>
        </header>

        {{-- ── Alerts ── --}}
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif

        {{-- ── Stats Cards ── --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-value">{{ $totalSparks }}</div>
                <div class="stat-label">Total Reflections</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">😊</div>
                <div class="stat-value">{{ number_format($avgMood, 1) }}</div>
                <div class="stat-label">Average Vibe</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔥</div>
                <div class="stat-value">{{ $totalIgnites }}</div>
                <div class="stat-label">Total Ignites</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-value">{{ $streakDays }}</div>
                <div class="stat-label">Day Streak</div>
            </div>
        </div>

        {{-- ── Charts ── --}}
        <div class="charts-container">
            <div class="chart-box">
                <h3>📈 Mood Trend (Last 7 Days)</h3>
                <canvas id="moodChart"></canvas>
            </div>
            <div class="chart-box">
                <h3>📊 Reflections by Category</h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        {{-- ── Manage Sparks Table ── --}}
        <section class="manage-section">
            <div class="section-title">
                <span>🗂️</span> Manage Your Reflections
            </div>

            @if($allSparks->count() > 0)
            <table class="spark-table">
                <thead>
                    <tr>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Mood</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allSparks as $spark)
                    <tr>
                        <td style="max-width: 300px;">{{ Str::limit($spark->content, 60) }}</td>
                        <td>{{ $spark->category->icon ?? '✨' }} {{ $spark->category->name ?? 'General' }}</td>
                        <td>
                            <span style="color: {{ $spark->mood_score >= 7 ? '#34d399' : ($spark->mood_score >= 4 ? '#fbbf24' : '#f87171') }};">
                                {{ $spark->mood_score }}/10
                            </span>
                        </td>
                        <td>{{ $spark->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <button class="btn-sm btn-edit" onclick="openEditModal({{ $spark->id }}, '{{ addslashes($spark->content) }}', {{ $spark->category_id }}, {{ $spark->mood_score }})">
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('sparks.destroy', $spark) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reflection?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="empty-state" style="padding: 2rem;">
                    <div class="empty-icon">📭</div>
                    <p>You haven't shared any reflections yet. Head to the community board!</p>
                </div>
            @endif
        </section>

    </div>

    {{-- ── Edit Modal ── --}}
    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeEditModal()">✕</button>
            <h3>✏️ Edit Reflection</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_content">Content</label>
                    <textarea id="edit_content" name="content" rows="3" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_category">Category</label>
                        <select id="edit_category" name="category_id" required>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_mood">Mood: <span id="edit-mood-val" style="color: var(--accent);">5</span>/10</label>
                        <input type="range" id="edit_mood" name="mood_score" min="1" max="10" value="5" oninput="document.getElementById('edit-mood-val').textContent = this.value">
                    </div>
                </div>
                <button type="submit" class="btn-submit">💾 Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // ── Edit Modal ──
        function openEditModal(id, content, categoryId, mood) {
            document.getElementById('editForm').action = '/sparks/' + id;
            document.getElementById('edit_content').value = content;
            document.getElementById('edit_category').value = categoryId;
            document.getElementById('edit_mood').value = mood;
            document.getElementById('edit-mood-val').textContent = mood;
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        // ── Chart.js: Mood Trend ──
        const moodCtx = document.getElementById('moodChart').getContext('2d');
        new Chart(moodCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($moodTrend->pluck('date')) !!},
                datasets: [{
                    label: 'Average Mood',
                    data: {!! json_encode($moodTrend->pluck('avg_mood')) !!},
                    borderColor: '#38bdf8',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(56, 189, 248, 0.08)',
                    pointBackgroundColor: '#38bdf8',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { min: 1, max: 10, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#64748b' } },
                    x: { grid: { display: false }, ticks: { color: '#64748b' } }
                },
                plugins: { legend: { display: false } }
            }
        });

        // ── Chart.js: Category Distribution ──
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryDistribution->map(fn($item) => $item->category->name ?? 'General')) !!},
                datasets: [{
                    data: {!! json_encode($categoryDistribution->pluck('count')) !!},
                    backgroundColor: ['#38bdf8', '#818cf8', '#fb7185', '#fbbf24', '#34d399'],
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8', padding: 16, font: { size: 12 } } } }
            }
        });
    </script>
</body>
</html>
