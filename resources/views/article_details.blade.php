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
      <h1>
        <a href="{{ route('articles.byTheme', 1) }}" class="logo">Tech Horizon</a>
      </h1>
      <ul class="nav-links">
        @foreach($themes->take(4) as $theme) <!-- Show only the first 4 themes -->
      <li>
        <a href="{{ route('articles.byTheme', $theme->id) }}" class="nav-link">{{ $theme->title }}</a>
      </li>
    @endforeach
        <!-- Dropdown for additional themes -->
        @if($themes->count() > 4)
      <li class="dropdown">
        <a href="#" class="nav-link dropdown-toggle">More <span>&#9660;</span></a>
        <ul class="dropdown-menu">
        @foreach($themes->slice(4) as $theme) <!-- Show the rest of the themes -->
      <li>
        <a href="{{ route('articles.byTheme', $theme->id) }}" class="dropdown-item">{{ $theme->title }}</a>
      </li>
    @endforeach
        </ul>
      </li>
    @endif
      </ul>
      <a href="#" class="profile-link">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-pic" onclick="toggleMenu()" />
      </a>
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-pic" />
            <h3>{{ Auth::user()->name }}</h3> <!-- Display the logged-in user's name -->
          </div>
          <hr>

          <a href="{{ route('redirectToDashboard') }}" class="sub-menu-link" id="profile-link">
            <p>Profile</p>
            <span>></span>
          </a>

          <!-- Logout Form -->
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="#" class="sub-menu-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <p>Log out</p>
            <span>></span>
          </a>
        </div>
      </div>
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
      <img src="{{ $article->image }}" alt="{{ $article->title }}"
        style="width: 100%; max-width: 100%; height: auto; margin-bottom: 10px;" />
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
      @foreach($recentArticles as $recentArticle)
      <article class="recent-post">
      <img src="{{ $recentArticle->image }}" alt="{{ $recentArticle->title }}" class="recent-image" />
      <div class="recent-info">
        <h4>
        <a href="{{ route('article_details', $recentArticle->id) }}">
          {{ Str::limit($recentArticle->title, 30, '...') }}
        </a>
        </h4>
        <p>
        {{ Str::limit($recentArticle->description, 50, '...') }}
        </p>
      </div>
      </article>
    @endforeach
    </section>
  </aside>

  <footer>
    <p>&copy; 2025 Tech Horizon. All rights reserved.</p>
  </footer>

  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }

    // Dropdown functionality
    document.addEventListener('DOMContentLoaded', function () {
      const dropdownToggle = document.querySelector('.dropdown-toggle');
      const dropdownMenu = document.querySelector('.dropdown-menu');

      if (dropdownToggle && dropdownMenu) {
        dropdownToggle.addEventListener('click', function (e) {
          e.preventDefault();
          dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
          if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
          }
        });
      }

      // Active link functionality
      const navLinks = document.querySelectorAll('.nav-link');

      function setActiveLink() {
        const currentThemeId = window.location.pathname.split('/').pop();
        navLinks.forEach(link => link.classList.remove('active'));

        const activeLink = document.querySelector(`.nav-link[href*="/articles/theme/${currentThemeId}"]`);
        if (activeLink) {
          activeLink.classList.add('active');
        }
      }

      setActiveLink();

      navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          navLinks.forEach(link => link.classList.remove('active'));
          this.classList.add('active');
          window.location.href = this.href;
        });
      });
    });
  </script>
</body>

</html>