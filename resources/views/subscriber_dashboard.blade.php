<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tech Horizon - Subscriber Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/subscriber.css') }}" />
</head>
<body>
<nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                    <a href="{{ route('articles') }}">All Articles</a>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </div>
        </div>
       <hr>
        <ul>
            <li><a href="#subscriptions">My Subscriptions</a></li>
            <li><a href="#browsing-history">Browsing History</a></li>
            <li><a href="#propose-article">Propose an Article</a></li>
            <li><a href="#proposed-articles">Proposed Articles</a></li>
            <li><a href="#comments">My Comments</a></li>
        </ul>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Subscriber Dashboard</h1>

        <section id="subscriptions">
            <h2>My Subscriptions</h2>
            <table id="subscriptions-table">
                <thead>
                    <tr>
                        <th>Theme</th>
                        <th>Subscription Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->theme->title }}</td>
                            <td>{{ $subscription->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('subscriber.unfollow') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="theme_id" value="{{ $subscription->theme_id }}">
                                    <button type="submit" class="btn-danger">Unfollow</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="browsing-history">
            <h2>Browsing History</h2>
            <table id="history-table">
                <thead>
                    <tr>
                        <th>Article Title</th>
                        <th>Theme</th>
                        <th>Date Read</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $item)
                        <tr>
                            <td>{{ $item->article->title }}</td>
                            <td>{{ $item->article->theme->title }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('subscriber.deleteHistory') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="article_id" value="{{ $item->article_id }}">
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="propose-article">
            <h2>Propose an Article</h2>
            <form action="{{ route('subscriber.proposeArticle') }}" method="POST" id="article-proposal-form">
                @csrf
                <label for="article-title">Title:</label>
                <input type="text" id="article-title" name="title" required />

                <label for="article-theme">Theme:</label>
                <select id="article-theme" name="theme_id" required>
                    <option value="">Select a theme</option>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                    @endforeach
                </select>

                <label for="article-image">Image URL:</label>
                <input type="url" id="article-image" name="image" required />

                <label for="article-description">Description:</label>
                <textarea id="article-description" name="description" required></textarea>

                <label for="article-content">Content:</label>
                <textarea id="article-content" name="content" required rows="10"></textarea>

                <button type="submit" class="btn-primary">Submit Proposal</button>
            </form>
        </section>

        <section id="proposed-articles">
            <h2>My Proposed Articles</h2>
            <table id="proposed-articles-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Theme</th>
                        <th>Date Proposed</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposedArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->theme->title }}</td>
                            <td>{{ $article->created_at->format('Y-m-d') }}</td>
                            <td>
                                @switch($article->position)
                                    @case(1)
                                        Waiting
                                        @break
                                    @case(2)
                                        Almost Done
                                        @break
                                    @case(3)
                                        Done Posted
                                        @break
                                    @case(4)
                                        Rejected
                                        @break
                                    @default
                                        Unknown
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="comments">
            <h2>My Comments</h2>
            <div id="comments-list">
                @foreach($comments as $comment)
                    <div class="conversation-item">
                        <h3>{{ $comment->article->title }}</h3>
                        <p>{{ $comment->text }}</p>
                        <p>Posted on: {{ $comment->created_at->format('Y-m-d') }}</p>
                        <form action="{{ route('subscriber.deleteComment') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</body>
</html>