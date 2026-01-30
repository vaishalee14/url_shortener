@extends('layouts.logout')
@section('title', 'Member Dashboard')
@section('content')
    <style>
        /* ===== UI STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        :root {
            --accent: #6366f1;
            --bg: #f8f9fa;
            --card: #fff;
            --border: #e1e4e8;
        }

        body {
            font-family: Manrope, sans-serif;
            background: var(--bg)
        }

        .container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 2rem
        }

        .main-card {
            background: var(--card);
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 3rem
        }

        .section-title {
            color: var(--accent);
            margin-bottom: 2rem
        }

        .input-section {
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 2rem
        }

        .form-group {
            margin-bottom: 1.5rem
        }

        input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border);
            border-radius: 10px
        }

        .btn-generate {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            padding: 1rem 3rem;
            border-radius: 10px
        }

        .result-section {
            margin-top: 2rem
        }

        .result-display {
            display: flex;
            gap: 1rem;
            background: #eef2ff;
            border: 2px solid var(--accent);
            border-radius: 10px;
            padding: .5rem
        }

        .result-url {
            flex: 1;
            background: #fff;
            border-radius: 8px;
            padding: .75rem;
            font-weight: 600
        }

        .btn-copy {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: .75rem 2rem;
            border-radius: 8px
        }

        .btn-copy.copied {
            background: #10b981
        }

        .btn-back {
            background: #64748b;
            color: #fff;
            border: none;
            padding: .75rem 2rem;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 2rem;
            display: inline-flex;
            align-items: center;
            gap: .5rem
        }

        .btn-back:hover {
            background: #475569
        }
    </style>

    <div class="container">
        <a href="{{ route('member.dashboard') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                ← Back
            </a>

        <div class="main-card">
            <h2 class="section-title">Generate Short URL</h2>

            <div class="input-section">
                <form action="{{ route('url.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Long URL</label>
                        <input type="text" name="long_url" placeholder="https://example.com" required />
                    </div>

                    <button type="submit" class="btn-generate">
                        Generate
                    </button>
                </form>

                @if (session('short_url'))
                    <div class="result-section">
                        <div class="result-display">
                            <div class="result-url">
                                <a href="{{ session('short_url') }}" target="_blank" id="shortUrl">
                                    {{ session('short_url') }}
                                </a>
                            </div>
                            <button class="btn-copy" onclick="copyToClipboard(this)">
                                Copy
                            </button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(btn) {
            const text = document.getElementById('shortUrl').textContent;
            navigator.clipboard.writeText(text);
            btn.textContent = '✓ Copied';
            btn.classList.add('copied');

            setTimeout(() => {
                btn.textContent = 'Copy';
                btn.classList.remove('copied');
            }, 2000);
        }
    </script>
@endsection
