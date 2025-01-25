<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - {{ $article->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/guest_article_details.css') }}" />

</head>

<body>

    <main>
        <!-- Dynamic Article Content -->
        <article class="post">
            <h1 class="article-title">{{ $article->title }}</h1>
            <div class="meta">
                <span class="date">{{ $article->created_at->format('M d, Y') }}</span>
                <span class="author">by {{ $article->author->name }}</span>
            </div>
            <img src="{{ asset('images/cyber_security.jpg') }}" alt="{{ $article->title }}" class="featured-image" />
            <div class="content">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Comments Section -->
        <section class="comments">
            <h3>Comments</h3>

            <!-- Comment 1 -->
            <div class="comment">
                <div class="comment-avatar">
                    <img src="{{ asset('images/profile.jpeg') }}" alt="Alice's Avatar" />
                </div>
                <div class="comment-content">
                    <span class="comment-author">Alice</span>
                    <span class="comment-date">Posted on January 9, 2025</span>
                    <p class="comment-text">
                        This is a very insightful article! The details about AI-powered
                        cyberattacks really made me think about how much more secure we
                        need to be in the digital age.
                    </p>
                    <div class="user-rating">
                        <span class="star">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                </div>
            </div>

            <!-- Comment 2 -->
            <div class="comment">
                <div class="comment-avatar">
                    <img src="{{ asset('images/profile.jpeg') }}" alt="Bob's Avatar" />
                </div>
                <div class="comment-content">
                    <span class="comment-author">Bob</span>
                    <span class="comment-date">Posted on January 8, 2025</span>
                    <p class="comment-text">
                        It’s incredible how fast technology is evolving. Cybersecurity is
                        indeed a critical area to focus on. Thanks for sharing this
                        article!
                    </p>
                    <div class="user-rating">
                        <span class="star">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                </div>
            </div>

            <!-- Comment 3 -->
            <div class="comment">
                <div class="comment-avatar">
                    <img src="{{ asset('images/profile.jpeg') }}" alt="Bob's Avatar" />
                </div>
                <div class="comment-content">
                    <span class="comment-author">Bob</span>
                    <span class="comment-date">Posted on January 8, 2025</span>
                    <p class="comment-text">
                        It’s incredible how fast technology is evolving. Cybersecurity is
                        indeed a critical area to focus on. Thanks for sharing this
                        article!
                    </p>
                    <div class="user-rating">
                        <span class="star">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                </div>
            </div>

            <!-- Comment 4 -->
            <div class="comment">
                <div class="comment-avatar">
                    <img src="{{ asset('images/profile.jpeg') }}" alt="Bob's Avatar" />
                </div>
                <div class="comment-content">
                    <span class="comment-author">Bob</span>
                    <span class="comment-date">Posted on January 8, 2025</span>
                    <p class="comment-text">
                        It’s incredible how fast technology is evolving. Cybersecurity is
                        indeed a critical area to focus on. Thanks for sharing this
                        article!
                    </p>
                    <div class="user-rating">
                        <span class="star">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Dynamic Sidebar (Public Articles) -->
    <aside>
        <section class="public-articles">
            <h3>Public Articles</h3>
            @foreach ($publicArticles as $publicArticle)
                <article class="public-post">
                    <img src="{{ asset('images/ai.png') }}" alt="{{ $publicArticle->title }}" class="public-image" />
                    <div class="public-info">
                        <h4><a
                                href="{{ route('guest_article_details', $publicArticle->id) }}">{{ $publicArticle->title }}</a>
                        </h4>
                        <p>{{ Str::limit($publicArticle->description, 100) }}</p>
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