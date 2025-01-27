<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - {{ $article->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/guest_article_details.css') }}" />
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

    <main>
        <!-- Dynamic Article Content -->
        <article class="post">
            <h1 class="article-title">{{ $article->title }}</h1>
            <div class="meta">
                <span class="date">{{ $article->created_at->format('M d, Y') }}</span> |
                <span class="author">by {{ $article->author->name }}</span> |
                <span class="theme-info"><a href="{{ route('themes') }}">{{ $article->theme->title }}</a></span>
            </div>
            <img src="{{ $article->image }}" alt="{{ $article->title }}"
                style="width: 100%; max-width: 100%; height: auto; margin-bottom: 10px;" />
            <div class="content">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Comments Section -->
        <section class="comments">
            <h3>Comments</h3>

            @foreach ($article->comments as $comment)
                    <div class="comment">
                        <div class="comment-avatar">
                            <img src="{{ asset('images/profile.jpg') }}" alt="{{ $comment->user->name }}'s Avatar" />
                        </div>
                        <div class="comment-content">
                            <span class="comment-author">{{ $comment->user->name }}</span>
                            <span class="comment-date">Posted on {{ $comment->created_at->format('F j, Y') }}</span>
                            <p class="comment-text">
                                {{ $comment->text }}
                            </p>
                            @if ($comment->ratings->isNotEmpty())
                                            <div class="user-rating">
                                                @php
                                                    $rating = $comment->ratings->first();
                                                    $ratingValue = $rating->rating;
                                                    $fullStars = str_repeat('&#9733;', $ratingValue);
                                                    $emptyStars = str_repeat('&#9734;', 5 - $ratingValue);
                                                @endphp
                                                <span class="star">{!! $fullStars . $emptyStars !!}</span>
                                            </div>
                            @endif
                        </div>
                    </div>
            @endforeach
        </section>
    </main>

    <aside>
        <section class="public-articles">
            <h3>Public Articles</h3>
            @foreach ($publicArticles as $publicArticle)
                <article class="public-post">
                    <img src="{{ $publicArticle->image }}" alt="{{ $publicArticle->title }}" class="public-image" />
                    <div class="public-info">
                        <h4 class="public-title">
                            <a href="{{ route('guest_article_details', $publicArticle->id) }}">
                                {{ $publicArticle->title }}
                            </a>
                        </h4>
                        <p class="public-description">
                            {{ $publicArticle->description}}
                        </p>
                        <!-- Display metadata (date, author, theme) -->
                        <div class="public-meta">
                            <span class="public-date">{{ $publicArticle->created_at->format('M d, Y') }}</span> |
                            <span class="public-author">by {{ $publicArticle->author->name }}</span> |
                            <span class="public-theme">
                                <a href="{{ route('themes') }}">{{ $publicArticle->theme->title }}</a>
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    </aside>
    <footer>
        <p>&copy; 2025 Tech Horizon. All rights reserved.</p>
    </footer>
</body>

</html>