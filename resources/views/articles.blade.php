<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tech Horizon</title>
  <link rel="stylesheet" href="{{ asset('css/articles.css') }}" />
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
      <a href="#" class="profile-link">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-pic" onclick="toggleMenu()" />
      </a>
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-pic" />
            <h3>name of user</h3>
          </div>
          <hr>

          <a href="#" class="sub-menu-link">
            <p>Profile</p>
            <span>></span>
          </a>

          <a href="#" class="sub-menu-link">
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
      <span class="date">{{ $article->created_at->format('F j, Y') }}</span>
      </div>
      <p>{{ $article->description }}</p>
      <br />
      <a href="#" class="read-more">Read More</a>
    </article>
  @endforeach
  @else
  <p>No articles found for this theme.</p>
@endif
  </main>

  <aside>
    <section class="public-articles">
      <h3>Public Articles</h3>
      @foreach ($publicArticles as $publicArticle)
      <article class="public-post">
      <img src="{{ asset('images/ai.png') }}" alt="{{ $publicArticle->title }}" class="public-image" />
      <div class="public-info">
        <h4 class="public-title">
        <a href="{{ route('guest_article_details', $publicArticle->id) }}">
          {{ Str::limit($publicArticle->title, 30, '...') }}
        </a>
        </h4>
        <p class="public-description">
        {{ Str::limit($publicArticle->description, 50, '...') }}
        </p>
        <!-- Display metadata (date, author, theme) -->
        <div class="public-meta">
        <span class="public-date">{{ $publicArticle->created_at->format('M d, Y') }}</span> |
        <span class="public-author">by {{ $publicArticle->author->name }}</span> |
        <span class="public-theme">
          <a href="{{ route('articles.byTheme', $publicArticle->theme->id) }}">
          {{ $publicArticle->theme->title }}
          </a>
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
  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }

    document.addEventListener('DOMContentLoaded', function () {
      const navLinks = document.querySelectorAll('.nav-link');

      // Function to set the active link
      function setActiveLink() {
        // Get the current theme ID from the URL
        const currentThemeId = window.location.pathname.split('/').pop();
        console.log('Current Theme ID:', currentThemeId);

        // Remove active class from all links
        navLinks.forEach(link => link.classList.remove('active'));

        // Add active class to the link that matches the current theme ID
        const activeLink = document.querySelector(`.nav-link[href*="/articles/theme/${currentThemeId}"]`);
        console.log('Active Link:', activeLink);

        if (activeLink) {
          activeLink.classList.add('active');
        }
      }

      // Set the active link on page load
      setActiveLink();

      // Add click event listeners to all links
      navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
          // Prevent default link behavior (if needed)
          e.preventDefault();

          // Remove active class from all links
          navLinks.forEach(link => link.classList.remove('active'));

          // Add active class to the clicked link
          this.classList.add('active');

          // Log the clicked link's href
          console.log('Clicked Link Href:', this.href);

          // Navigate to the new URL
          window.location.href = this.href;
        });
      });
    });
  </script>
</body>

</html>