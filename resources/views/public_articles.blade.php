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
      <div class="logo">Tech Horizon</div>
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
        <p>{{ $article->description}}</p>
        <a href="{{ route('article_details', $article->id) }}" class="read-more">Read More</a>
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