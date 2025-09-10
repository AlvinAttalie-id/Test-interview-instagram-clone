<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>InstaClone — Share your world</title>
    <meta name="description"
        content="InstaClone — aplikasi berbagi foto & video, story, follow, like, dan komentar. Ringan, cepat, dan mudah digunakan." />
    <!-- Optional font (Google) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #4f46e5;
            --accent-600: #4338ca;
            --glass: rgba(255, 255, 255, 0.6);
            --radius: 16px;
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, var(--bg), #ffffff);
            color: #0f172a;
            line-height: 1.5
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 36px 20px
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-600));
            display: inline-grid;
            place-items: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.18)
        }

        nav {
            display: flex;
            gap: 14px;
            align-items: center
        }

        nav a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600
        }

        .btn {
            background: var(--accent);
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.15)
        }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: 1fr 460px;
            gap: 36px;
            align-items: center;
            padding: 48px 0
        }

        .eyebrow {
            display: inline-block;
            background: linear-gradient(90deg, #eef2ff, #fce7f3);
            color: var(--accent-600);
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px
        }

        h1 {
            font-size: 34px;
            margin: 14px 0 8px;
            line-height: 1.05
        }

        p.lead {
            color: var(--muted);
            margin: 0 0 20px
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px
        }

        .feature {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: var(--card);
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
            min-width: 200px
        }

        .feature .ico {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eef2ff;
            color: var(--accent);
            display: grid;
            place-items: center;
            font-weight: 700
        }

        /* phone mock */
        .mock {
            background: linear-gradient(180deg, #fff, #f8fafc);
            border-radius: 28px;
            padding: 18px;
            box-shadow: 0 18px 50px rgba(2, 6, 23, 0.08);
            display: flex;
            justify-content: center
        }

        .mock .screen {
            width: 260px;
            height: 520px;
            border-radius: 20px;
            background: #111827;
            overflow: hidden;
            position: relative
        }

        .mock .screen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            opacity: 0.95
        }

        /* Sections */
        section {
            padding: 48px 0;
            border-top: 1px solid rgba(15, 23, 42, 0.03)
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px
        }

        .card {
            background: var(--card);
            padding: 18px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04)
        }

        footer {
            padding: 36px 0;
            text-align: center;
            color: var(--muted);
            font-size: 14px
        }

        /* Responsive */
        @media (max-width:980px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center
            }

            .mock {
                order: -1;
                margin-bottom: 8px
            }

            .grid-3 {
                grid-template-columns: 1fr;
                gap: 14px
            }

            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px
            }

            nav {
                width: 100%;
                justify-content: space-between
            }
        }

        @media (max-width:420px) {
            h1 {
                font-size: 28px
            }

            .mock .screen {
                width: 220px;
                height: 440px
            }
        }

        /* small helpers */
        .muted {
            color: var(--muted)
        }

        .cta-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 18px
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <a href="/" class="brand" aria-label="InstaClone home">
                <div class="logo">IC</div>
                <div>
                    <div style="font-weight:700">InstaClone</div>
                    <div style="font-size:12px;color:var(--muted)">Share. Follow. Connect.</div>
                </div>
            </a>

            <nav>
                <a href="#features">Features</a>
                <a href="#screens">Screens</a>
                <a class="btn" href="/register">Get Started</a>
            </nav>
        </header>

        <!-- HERO -->
        <main class="hero" role="main" aria-labelledby="hero-title">
            <div>
                <span class="eyebrow">New • Mobile & Web</span>
                <h1 id="hero-title">InstaClone — Aplikasi berbagi foto & video, cepat dan sederhana</h1>
                <p class="lead">Bangun komunitasmu — posting feed, story, follow teman, like, dan komentar. Dibangun
                    untuk performa dan kemudahan penggunaan.</p>

                <div class="features" aria-hidden="false">
                    <div class="feature">
                        <div class="ico">💬</div>
                        <div>
                            <div style="font-weight:700">Realtime Comments</div>
                            <div class="muted" style="font-size:13px">Interaksi cepat dan lancar pada setiap post</div>
                        </div>
                    </div>

                    <div class="feature">
                        <div class="ico">📸</div>
                        <div>
                            <div style="font-weight:700">Media First</div>
                            <div class="muted" style="font-size:13px">Optimized uploads & responsive gallery</div>
                        </div>
                    </div>

                    <div class="feature">
                        <div class="ico">🔒</div>
                        <div>
                            <div style="font-weight:700">Privacy Controls</div>
                            <div class="muted" style="font-size:13px">Set profile public/private & block users</div>
                        </div>
                    </div>
                </div>

                <div class="cta-row">
                    <a class="btn" href="/register">Create Account</a>
                    <a href="/login"
                        style="display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;background:transparent;color:var(--accent);text-decoration:none;font-weight:600;border:1px solid rgba(79,70,229,0.08)">Try
                        Demo</a>
                </div>
            </div>

            <div class="mock" aria-hidden="true">
                <div class="screen">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder"
                        alt="App preview mock">
                </div>
            </div>
        </main>

        <!-- Screens / Gallery -->
        <section id="screens">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px">
                <h2 style="margin:0">Screenshots</h2>
                <p class="muted" style="margin:0">Preview of feed, profile, and upload flow</p>
            </div>

            <div class="grid-3" aria-hidden="false">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder"
                        alt="Feed"
                        style="width:100%;height:160px;object-fit:cover;border-radius:10px;margin-bottom:12px">
                    <strong>Feed</strong>
                    <p class="muted" style="margin:8px 0 0">Fast infinite scroll with like & comment interactions.</p>
                </div>

                <div class="card">
                    <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder"
                        alt="Profile"
                        style="width:100%;height:160px;object-fit:cover;border-radius:10px;margin-bottom:12px">
                    <strong>Profile</strong>
                    <p class="muted" style="margin:8px 0 0">User profile with posts, follower counts, and edit options.
                    </p>
                </div>

                <div class="card">
                    <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder"
                        alt="Upload"
                        style="width:100%;height:160px;object-fit:cover;border-radius:10px;margin-bottom:12px">
                    <strong>Upload</strong>
                    <p class="muted" style="margin:8px 0 0">Quick media uploader with captions, tagging and privacy
                        controls.</p>
                </div>
            </div>
        </section>

        <!-- Features / Benefits -->
        <section id="features">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px">
                <h2 style="margin:0">Why InstaClone?</h2>
                <p class="muted" style="margin:0">Designed for creators & communities</p>
            </div>

            <div class="grid-3" style="margin-top:18px">
                <div class="card">
                    <h3 style="margin:0 0 8px">Lightweight & Fast</h3>
                    <p class="muted" style="margin:0">Optimized frontend and CDN-ready uploads so your feed loads
                        quickly for everyone.</p>
                </div>

                <div class="card">
                    <h3 style="margin:0 0 8px">Open & Extensible</h3>
                    <p class="muted" style="margin:0">Built to be extended — add plugins, analytics, or integrate
                        third-party auth easily.</p>
                </div>

                <div class="card">
                    <h3 style="margin:0 0 8px">Privacy First</h3>
                    <p class="muted" style="margin:0">Per-post privacy, block/report flow, and account controls for
                        safe communities.</p>
                </div>
            </div>
        </section>

        <footer>
            <div style="margin-bottom:10px">© <strong>InstaClone</strong> — built with ❤️</div>
            <div class="muted">Made for demo & prototyping. Replace images and texts with your copy.</div>
        </footer>
    </div>
</body>

</html>
