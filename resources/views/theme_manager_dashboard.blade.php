<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Theme Manager Dashboard: Artificial Intelligence</title>
    <link rel="stylesheet" href="{{ asset('css/theme_manager.css') }}">
</head>

<body>
    <nav>
        <div class="logo">Tech Horizon</div>
        <ul>
            <li><a href="#subscriptions">Subscriptions</a></li>
            <li><a href="#articles">Articles</a></li>
            <li><a href="#proposals">Proposals</a></li>
            <li><a href="#statistics">Statistics</a></li>
            <li><a href="#comments">Comments</a></li>
        </ul>
    </nav>
    <main>
        <h1>Theme Manager Dashboard: Artificial Intelligence</h1>
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
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
        <section id="statistics">
            <h2>Theme Statistics</h2>
            <div id="stats-container"></div>
        </section>

    </main>
    <script src="js/theme_manager.js"></script>
</body>

</html>