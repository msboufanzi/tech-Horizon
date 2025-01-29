<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tech Horizon - Editor Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
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
            <li><a href="#existing-articles">Existing Articles</a></li>
            <li><a href="#articles">Articles Request Management</a></li>
            <li><a href="#users">User Management</a></li>
            <li><a href="#magazines">Magazine Numbers</a></li>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->theme->title }}</td>
                            <td>
                                <a href="{{ route('editor.show_proposed_article', $article->id) }}"
                                    class="btn-primary">Review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pendingArticles->appends(['existing_page' => request('existing_page'), 'users_page' => request('users_page')])->links('pagination::bootstrap-4') }}
        </section>
        <section id="users">
    <h2>User Management</h2>
    <button id="add-user-btn" class="btn-primary">Add User</button>
    
    <!-- Add User Modal -->
    <div id="add-user-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New User</h2>
            <form id="add-user-form">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="" selected disabled>-- Select Role --</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="manager">Manager</option>
                </select>

                <div id="theme-section" style="display: none;">
                    <label for="theme">Assign Theme</label>
                    <select id="theme" name="theme_id">
                        <option value="" selected disabled>-- Select Theme --</option>
                        @foreach($availableThemes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn-modal">Add User</button>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit User</h2>
            <form id="edit-user-form">
                <input type="hidden" id="edit-user-id" name="user_id">
                
                <label for="edit-name">Name</label>
                <input type="text" id="edit-name" name="name" required>
                
                <label for="edit-email">Email</label>
                <input type="email" id="edit-email" name="email" required>
                
                <button type="submit" class="btn-modal">Update User</button>
            </form>
        </div>
    </div>

    <!-- Manage Roles Modal -->
    <div id="manage-roles-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Manage User Role</h2>
            <form id="manage-roles-form">
                <input type="hidden" id="role-user-id" name="user_id">
                
                <label for="new-role">New Role</label>
                <select id="new-role" name="role" required>
                    <option value="" selected disabled>-- Select Role --</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="manager">Manager</option>
                </select>

                <div id="role-theme-section" style="display: none;">
                    <label for="role-theme">Assign Theme</label>
                    <select id="role-theme" name="theme_id">
                        <option value="" selected disabled>-- Select Theme --</option>
                        @foreach($availableThemes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn-modal">Update Role</button>
            </form>
        </div>
    </div>

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
                        <button class="btn-primary edit-user-btn">Edit</button>
                        <button class="btn-primary manage-roles-btn">Manage Roles</button>
                        <button class="btn-danger block-user-btn">Block</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->appends(['existing_page' => request('existing_page'), 'pending_page' => request('pending_page')])->links('pagination::bootstrap-4') }}
</section>

        <section id="add-theme">
            <h2>Add Theme</h2>
            <form id="add-theme-form" action="{{ route('add-theme') }}" method="POST">
                @csrf
                <label for="theme-title">Title:</label>
                <input type="text" id="theme-title" name="theme-title" required />

                <label for="theme-image">Image link:</label>
                <input type="text" id="theme-image" name="theme-image" required />

                <label for="theme-manager">Theme's Manager:</label>
                <select id="theme-manager" name="theme-manager">
                    <option value="">No manager</option>
                    @foreach($subscribers as $subscriber)
                        <option value="{{ $subscriber->id }}">{{ $subscriber->name }}</option>
                    @endforeach
                </select>

                <label for="theme-description">Description:</label>
                <textarea id="theme-description" name="theme-description" required rows="10"></textarea>

                <button type="submit" class="btn-primary">Add</button>
            </form>
        </section>

        <section id="magazines">
            <h2>Magazine Numbers</h2>
            <div class="magazine-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="magazine-number">Number:</label>
                        <input type="text" id="magazine-number" required>
                    </div>
                    <div class="form-group">
                        <label for="magazine-title">Title:</label>
                        <input type="text" id="magazine-title" required>
                    </div>
                    <div class="form-group">
                        <label for="magazine-status">Is Public:</label>
                        <select id="magazine-status">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button onclick="addMagazine()" class="btn-primary">Add Magazine Number</button>
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Title</th>
                        <th>Is Public</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="magazines-table-body">
                    @foreach($magazines as $magazine)
                        <tr data-magazine-id="{{ $magazine->id }}">
                            <td>{{ $magazine->number }}</td>
                            <td>{{ $magazine->title }}</td>
                            <td>{{ $magazine->is_public ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('magazines.manage', ['id' => $magazine->id]) }}"
                                    class="btn-primary">Manage</a>
                                <form action="{{ route('magazines.destroy', ['id' => $magazine->id]) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this magazine?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="vue-themes">
            <h2>Vue Themes Management</h2>
            <table id="vue-themes-table">
                <thead>
                    <tr>
                        <th>Theme Name</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($themes as $theme)
                        <tr>
                            <td>{{ $theme->title }}</td>
                            <td>{{ $theme->manager ? $theme->manager->name : 'No Manager' }}</td>
                            <td>
                                <button class="btn-danger delete-theme-btn" data-theme-id="{{ $theme->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="add-article">
            <h2>Add Article</h2>
            <form id="add-article-form">
                @csrf
                <div class="form-group">
                    <label for="article-title">Title:</label>
                    <input type="text" id="article-title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="article-description">Description:</label>
                    <textarea id="article-description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="article-content">Content:</label>
                    <textarea id="article-content" name="content" required></textarea>
                </div>

                <div class="form-group">
                    <label for="article-image">Image URL:</label>
                    <input type="url" id="article-image" name="image" required>
                </div>

                <div class="form-group">
                    <label for="article-theme">Theme:</label>
                    <select id="article-theme" name="theme_id" required>
                        <option value="">Select a theme</option>
                        @foreach($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="article-magazine">Magazine Number (Optional):</label>
                    <select id="article-magazine" name="magazine_id">
                        <option value="">Select a magazine</option>
                        @foreach($magazines as $magazine)
                            <option value="{{ $magazine->id }}">{{ $magazine->number }} - {{ $magazine->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-primary">Add Article</button>
            </form>
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

