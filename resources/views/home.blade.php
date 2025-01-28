<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - Home</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="#about">About</a>
                <a href="{{ route('themes') }}">Themes</a>
                @if(auth()->check())
                    <a href="{{ route('articles') }}">All Articles</a>
                @else
                    <a href="{{ route('public.articles') }}">Public Articles</a>
                @endif
                @if(auth()->check())
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('auth') }}">Sign in/up</a>
                @endif
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Welcome to Tech Horizon</h1>
            <p>
                Explore the future of technology with our comprehensive guides and
                insights into the latest tech trends.
            </p>
        </div>
    </section>

    <section class="about" id="about">
        <h2 class="section-title">About Us</h2>
        <div class="about-content">
            <div class="about-grid">
                <div class="about-item">
                    <img src="images/mission.jpg" alt="Our Mission" class="about-image" />
                    <h3>Our Mission</h3>
                    <p>
                        Empowering individuals and businesses with cutting-edge
                        technological knowledge to drive digital transformation.
                    </p>
                </div>
                <div class="about-item">
                    <img src="images/expertise.jpg" alt="Our Expertise" class="about-image" />
                    <h3>Our Expertise</h3>
                    <p>
                        Bringing you insights on AI, cybersecurity, cloud computing, and
                        more from industry experts and thought leaders.
                    </p>
                </div>
                <div class="about-item">
                    <img src="images/community.jpg" alt="Our Community" class="about-image" />
                    <h3>Our Community</h3>
                    <p>
                        Join a thriving community of tech enthusiasts, professionals, and
                        innovators shaping the future of technology.
                    </p>
                </div>
            </div>
            <div class="about-description">
                <p>
                    Tech Horizon is your gateway to the cutting-edge world of
                    technology. We are passionate about bringing you the latest
                    insights, trends, and innovations across various tech domains. Our
                    mission is to empower individuals and businesses with knowledge that
                    drives digital transformation and technological advancement.
                </p>
            </div>
        </div>
    </section>

    <!-- Displaying 3 first themes from database -->
    <section class="themes" id="themes">
        <h2 class="section-title">Explore Our Themes</h2>
        <div class="cards-container">
            @foreach ($themes as $theme)
                <div class="card">
                    <img src="{{ $theme->image }}" alt="{{ $theme->title }}" />
                    <div class="card-content">
                        <h3>{{ $theme->title }}</h3>
                        <p>{{ $theme->description }}</p>
                        <!-- Add creation date -->
                        <p class="creation-date">Created on: {{ $theme->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('themes') }}" class="show-more">Show More</a>
    </section>

    <!-- Public Articles Section -->
    <section class="articles" id="articles">
        <h2 class="section-title">Public Articles</h2>
        <div class="cards-container">
            @foreach ($articles as $article)
                <div class="card">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" />
                    <div class="card-content">
                        <h3>{{ $article->title }}</h3>
                        <!-- Display theme name -->
                        <p class="theme-info">
                            <a href="{{ route('themes') }}">{{ $article->theme->title }}</a>
                        </p>
                        <p>{{$article->description}}</p>

                        <p class="meta-info">
                            Created on: {{ $article->created_at->format('M d, Y') }} |
                            Author: {{ $article->author->name }}
                        </p>
                        <a href="{{ route('guest_article_details', $article->id) }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('public.articles') }}" class="show-more">View More Articles</a>
    </section>

    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: contact@techhorizon.com</p>
                <p>Phone: +212-600-0000</p>
                <p>Address: 123 Tech Street, Tangier, Morocco</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <p>
                    <a href="#home" style="color: #ccc; text-decoration: none">Home</a>
                </p>
                <p>
                    <a href="#about" style="color: #ccc; text-decoration: none">About</a>
                </p>
                <p>
                    <a href="#themes" style="color: #ccc; text-decoration: none">Themes</a>
                </p>
                <p>
                    <a href="#articles" style="color: #ccc; text-decoration: none">Public Articles</a>
                </p>
            </div>
        </div>
    </footer>
</body>

</html>