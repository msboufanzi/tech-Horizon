<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Themes</title>
    <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                <a href="{{ route('public.articles') }}">Public Articles</a>
                <a href="{{ auth()->check() ? route('articles') : route('auth') }}">Sign in/up</a>
            </div>
        </div>
    </nav>

    <section class="themes">
        <h2 class="section-title">Explore Our Themes</h2>
        <div class="cards-container">
            @foreach ($themes as $theme)
                <div class="card">
                    <img src="{{ $theme->image }}" alt="{{ $theme->title }}" />
                    <div class="card-content">
                        <!-- Make the title clickable -->
                        <a href="{{ route('articles.byTheme', ['themeId' => $theme->id]) }}" class="theme-title-link">
                            <h3>{{ $theme->title }}</h3>
                        </a>
                        <p>{{ $theme->description }}</p>
                        <p class="creation-date">Created on: {{ $theme->created_at->format('M d, Y') }}</p>
                        @if (auth()->check())
                            @if ($theme->is_followed)
                                <form action="{{ route('themes.unfollow') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="unfollow-button">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('themes.follow') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="follow-button">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Tech Horizon. All rights reserved.</p>
    </footer>
</body>

</html>