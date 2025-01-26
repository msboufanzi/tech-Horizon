<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tech Horizon</title>
  <link rel="stylesheet" href="{{ asset('css/article_details.css') }}" />
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&family=Source+Sans+Pro:wght@400;700&display=swap"
    rel="stylesheet" />
</head>

<body>
  <header>
    <nav>
      <h1><a href="#" class="logo">Tech Horizon</a></h1>
      <ul class="nav-links">
        @foreach($themes as $theme)
      <li>
        <a href="{{ route('articles.byTheme', $theme->id) }}" class="nav-link">{{ $theme->title }}</a>
      </li>
    @endforeach
      </ul>
      <a href="/dashboard" class="profile-link">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-pic" />
      </a>
    </nav>
  </header>

  <main>
    <article class="post">
      <h1 class="article-title">{{ $article->title }}</h1>
      <div class="meta">
        <span class="date">{{ $article->created_at->format('M d, Y') }}</span> |
        <span class="author">by {{ $article->author->name }}</span> |
        <span class="theme-info">
          <a href="{{ route('articles.byTheme', $article->theme->id) }}">{{ $article->theme->title }}</a>
        </span>
      </div>
      <img src="{{ asset('images/cyber_security.jpg') }}" alt="{{ $article->title }}" class="featured-image" />
      <div class="content">
        {!! $article->content !!}
      </div>
    </article>

    <!-- Rating Section -->
    <section class="article-rating">
      <h3>Rate This Article</h3>
      <div class="stars">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5" title="5 stars">&#9733;</label>
        <input type="radio" id="star4" name="rating" value="4" />
        <label for="star4" title="4 stars">&#9733;</label>
        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3" title="3 stars">&#9733;</label>
        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2" title="2 stars">&#9733;</label>
        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1" title="1 star">&#9733;</label>
      </div>
    </section>

    <!-- Comments Section -->
    <section class="comments">
      <h3>Comments</h3>

      <!-- Comment 1 -->
      <div class="comment">
        <div class="comment-avatar">
          <img src="{{ asset('images/profile.jpg') }}" alt="Alice's Avatar" />
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
          <img src="{{ asset('images/profile.jpg') }}" alt="Bob's Avatar" />
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

    <!-- Add Comment Section -->
    <section class="add-comment">
      <h3>Leave a Comment</h3>
      <textarea placeholder="Write your comment here..."></textarea>
      <button type="submit">Post Comment</button>
    </section>
  </main>

  <aside>
    <section class="recent-articles">
      <h3>Recent Articles</h3>
      @foreach($publicArticles as $publicArticle)
      <article class="recent-post">
      <img src="{{ asset('images/ai.png') }}" alt="{{ $publicArticle->title }}" class="recent-image" />
      <div class="recent-info">
        <h4>
        <a href="{{ route('article_details', $publicArticle->id) }}">
          {{ Str::limit($publicArticle->title, 30, '...') }}
        </a>
        </h4>
        <p>
        {{ Str::limit($publicArticle->description, 50, '...') }}
        </p>
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