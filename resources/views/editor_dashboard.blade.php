<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Editor Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
</head>
<body>
    <nav>
        <div class="logo">Tech Horizon</div>
        <ul>
            <li><a href="#existing-articles">Existing Articles</a></li>
            <li><a href="#articles">Article Management</a></li>
            <li><a href="#users">User Management</a></li>
            <li><a href="#statistics">Global Statistics</a></li>
        </ul>
    </nav>
    <main>
        <h1>Editor Dashboard</h1>
        <section id="existing-articles">
            <h2>Existing Article Management</h2>
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
                <tbody></tbody>
            </table>
        </section>
        <section id="articles">
            <h2>Article Management</h2>
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
                <tbody></tbody>
            </table>
        </section>
        <section id="users">
            <h2>User Management</h2>
            <button id="add-user-btn" class="btn-primary">Add User</button>
            <table id="users-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
        <section id="statistics">
            <h2>Global Statistics</h2>
            <div id="stats-container"></div>
        </section>
    </main>
    <script src="js/editor.js"></script>
</body>
</html>


