<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Themes</title>
    <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                @if(auth()->check())
                    <a href="{{ route('articles') }}">All Articles</a>
                @else
                    <a href="{{ route('public.articles') }}">Public Articles</a>
                @endif
                @if(auth()->check())
                    @if(auth()->user()->role === 'subscriber')
                        <a href="{{ route('subscriber_dashboard') }}">Dashboard</a>
                    @elseif(auth()->user()->role === 'editor')
                        <a href="{{ route('editor_dashboard') }}">Dashboard</a>
                    @elseif(auth()->user()->role === 'manager')
                        <a href="{{ route('theme_manager_dashboard') }}">Dashboard</a>
                    @endif
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
                        <a href="{{ auth()->check() ? route('articles.byTheme', ['themeId' => $theme->id]) : route('auth') }}"
                            class="theme-title-link">
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
        <p>&copy; 2025 Tech Horizon. All rights reserved.</p>
    </footer>
</body>

</html>