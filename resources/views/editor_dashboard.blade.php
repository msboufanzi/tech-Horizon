<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tech Horizon - Editor Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
</head>

<body>
    <nav>
        <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
        <ul>
            <li><a href="#existing-articles">Existing Articles</a></li>
            <li><a href="#articles">Articles Request Management</a></li>
            <li><a href="#users">User Management</a></li>
            <li><a href="#statistics">Global Statistics</a></li>
        </ul>
    </nav>
    <main>
        <h1>Editor Dashboard</h1>
        <section id="existing-articles">
            <h2>All Articles</h2>
            <table id="existing-articles-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Theme</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($existingArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->theme->title }}</td>
                            <td>{{ $article->ispublic ? 'Visible' : 'Private' }}</td>
                            <td>
                                <a href="{{ route('article_details', ['id' => $article->id]) }}"
                                    class="btn-primary">View</a>
                                <label class="switch">
                                    <input type="checkbox" {{ $article->ispublic ? 'checked' : '' }}
                                        onchange="toggleArticleStatus({{ $article->id }}, this)">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $existingArticles->appends(['pending_page' => request('pending_page'), 'users_page' => request('users_page')])->links('pagination::bootstrap-4') }}
        </section>
        <section id="articles">
            <h2>New Articles Requests</h2>
            <table id="articles-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Theme</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->theme->title }}</td>
                            <td>{{ $article->ispublic ? 'Visible' : 'Private' }}</td>
                            <td>
                                <a href="{{ route('article_details', ['id' => $article->id]) }}"
                                    class="btn-primary">Review</a>
                                <label class="switch">
                                    <input type="checkbox" {{ $article->ispublic ? 'checked' : '' }}
                                        onchange="toggleArticleStatus({{ $article->id }}, this)">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pendingArticles->appends(['existing_page' => request('existing_page'), 'users_page' => request('users_page')])->links('pagination::bootstrap-4') }}
        </section>
        <section id="users">
            <h2>User Management</h2>
            <button id="add-user-btn" class="btn-primary" onclick="addUser()">Add User</button>
            <table id="users-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <button class="btn-primary" onclick="editUser({{ $user->id }})">Edit</button>
                                <button class="btn-primary" onclick="manageRoles({{ $user->id }})">Manage Roles</button>
                                <button class="btn-danger" onclick="blockUser({{ $user->id }})">Block</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->appends(['existing_page' => request('existing_page'), 'pending_page' => request('pending_page')])->links('pagination::bootstrap-4') }}
        </section>
        <section id="statistics">
            <h2>Global Statistics</h2>
            <div id="stats-container">
                @foreach($statistics as $label => $value)
                    <div class="stat-box">
                        <h3>{{ ucwords(str_replace('_', ' ', $label)) }}</h3>
                        <p>{{ number_format($value) }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    <script src="{{ asset('js/editor.js') }}"></script>
</body>

</html>