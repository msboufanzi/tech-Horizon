<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Theme Manager Dashboard: {{ $theme->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/theme_manager.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
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
            <li><a href="#subscriptions">Subscriptions</a></li>
            <li><a href="#articles">Articles</a></li>
            <li><a href="#proposals">Proposals</a></li>
            <li><a href="#statistics">Statistics</a></li>
            <li><a href="#comments">Comments</a></li>
        </ul>
    </nav>
    <main>
        <h1>Theme Manager Dashboard: {{ $theme->title }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section id="subscriptions">
            <h2>Subscription Management</h2>
            <table id="subscriptions-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subscription Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->user->name }}</td>
                            <td>{{ $subscription->user->email }}</td>
                            <td>{{ $subscription->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('theme_manager.remove_subscriber') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $subscription->user_id }}">
                                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                    <button type="submit" class="btn-danger">Kick Subscription</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="articles">
            <h2>Article Management</h2>
            <table id="articles-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('article_details', $article->id) }}" class="btn-primary">View</a>
                                <form action="{{ route('theme_manager.delete_article', $article->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="proposals">
            <h2>Subscriber Proposals</h2>
            <table id="proposals-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $proposal)
                        <tr>
                            <td>{{ $proposal->title }}</td>
                            <td>{{ $proposal->author->name }}</td>
                            <td>{{ $proposal->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($proposal->position == 1)
                                    sent
                                @elseif($proposal->position == 2)
                                    Processed
                                @elseif($proposal->position == 3)
                                    Retained
                                @else
                                    Rejected
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('theme_manager.show_proposed_article', $proposal->id) }}"
                                    class="btn-primary">Review</a>
                                @if($proposal->position == 1)
                                    <form action="{{ route('theme_manager.update_proposal') }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                                        <button type="submit" class="btn-primary">Propose to Editor</button>
                                    </form>
                                @endif
                                <form action="{{ route('theme_manager.delete_proposal', $proposal->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="comments">
            <h2>Comments Management</h2>
            <table id="comments-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Comment</th>
                        <th>Article</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->text }}</td>
                            <td>{{ $comment->article->title }}</td>
                            <td>
                                <form action="{{ route('theme_manager.delete_comment', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="statistics">
            <h2>Theme Statistics</h2>
            <div id="stats-container">
                @foreach($stats as $key => $value)
                    <div class="stat-box">
                        <h3>{{ $key }}</h3>
                        <p>{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</body>

</html>