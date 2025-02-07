<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tech Horizon</title>
  <link rel="stylesheet" href="{{ asset('css/articles.css') }}" />
  <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
  <header>
    <nav>
      <h1>
        <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
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
            <p>Dashboard</p>
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
    @if(isset($articles) && $articles->count() > 0)
    @foreach($articles as $article)
    <article class="post">
      <h2>{{ $article->title }}</h2>
      <div class="meta">
      <!-- Display the article's creation date -->
      <span class="date">{{ $article->created_at->format('M j, Y') }}</span>

      <!-- Display the article's author -->
      <span class="author"> | by {{ $article->author->name }}</span>

      <!-- Display the article's theme as a link -->
      <span class="theme"> |
      <a href="{{ route('articles.byTheme', $article->theme->id) }}">{{ $article->theme->title }}</a>
      </span>
      </div>

      <img src="{{ $article->image }}" alt="{{ $article->title }}"
      style="width: 100%; max-width: 100%; height: auto; margin-bottom: 10px;" />
      <p>{{ $article->description }}</p>
      <br />
      <a href="{{ route('article_details', $article->id) }}" class="read-more">Read More</a>
    </article>
  @endforeach
  @else
  <p>No articles found for this theme.</p>
@endif
  </main>


  <aside>
    <section class="recent-articles">
      <h3>Recent Articles</h3>
      @foreach($recentArticles as $recentrticle)
      <article class="recent-post">
      <img src="{{ $recentrticle->image }}" alt="{{ $recentrticle->title }}" class="recent-image" />
      <div class="recent-info">
        <h4>
        <a href="{{ route('article_details', $recentrticle->id) }}">
          {{ Str::limit($recentrticle->title, 30, '...') }}
        </a>
        </h4>
        <p>
        {{ Str::limit($recentrticle->description, 50, '...') }}
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