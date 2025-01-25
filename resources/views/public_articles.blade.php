<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - Public Articles</title>
    <link rel="stylesheet" href="css/public_articles.css" />
</head>

<body>
    <nav>
        <div class="nav-content">
        <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                <a href="{{ route('public.articles') }}">Public Articles</a>
                <a href="{{ route('auth') }}">Sign in/up</a>
            </div>
        </div>
    </nav>

    <section class="articles">
        <h2 class="section-title">Public Articles</h2>
        <div class="cards-container">
            @foreach ($articles as $article)
                <div class="card">
                    <img src="images/ai.png" alt="{{ $article->title }}" />
                    <div class="card-content">
                        <h3>{{ $article->title }}</h3>
                        <p>{{ Str::limit($article->description, 150) }}</p>
                        <!-- Display creation date and author name -->
                        <p class="meta-info">
                            Created on: {{ $article->created_at->format('M d, Y') }} | 
                            Author: {{ $article->author->name }}
                        </p>
                        <a href="{{ route('article_details', $article->id) }}" class="read-more-btn">Read More</a>
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