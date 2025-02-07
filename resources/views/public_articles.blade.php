<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - Public Articles</title>
    <link rel="stylesheet" href="{{ asset('css/public_articles.css') }}" />
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                <a href="{{ route('public.articles') }}">Public Articles</a>
                @if(auth()->check())
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('auth') }}">Sign in/up</a>
                @endif
            </div>
        </div>
    </nav>

    <section class="articles">
        <h2 class="section-title">Public Articles</h2>
        <div class="cards-container">
            @foreach ($articles as $article)
                <div class="card">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" />
                    <div class="card-content">
                        <h3 class="public-title">{{ $article->title }}</h3>
                        <p>{{ $article->description }}</p>
                        <!-- Display creation date, author, and theme -->
                        <div class="public-meta">
                            <span class="public-date">{{ $article->created_at->format('M d, Y') }}</span> |
                            <span class="public-author">by {{ $article->author->name }}</span> |
                            <span class="theme-info">
                                <a href="{{ route('themes') }}">{{ $article->theme->title }}</a>
                            </span>
                        </div>
                        <br>
                        <!-- Conditional link based on authentication -->
                        @if(auth()->check())
                            <a href="{{ route('article_details', $article->id) }}" class="read-more-btn">Read More</a>
                        @else
                            <a href="{{ route('guest_article_details', $article->id) }}" class="read-more-btn">Read More</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tech Horizon. All rights reserved.</p>
    </footer>
</body>

</html>