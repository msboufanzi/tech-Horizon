<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - Subscriber Dashboard</title>
    <link rel="stylesheet" href="css/subsriber.css" />
</head>

<body>
    <nav>
        <div class="logo">Tech Horizon</div>
        <ul>
            <li><a href="#subscriptions">My Subscriptions</a></li>
            <li><a href="#browsing-history">Browsing History</a></li>
            <li><a href="#propose-article">Propose an Article</a></li>
            <li><a href="#proposed-articles">Proposed Articles</a></li>
            <li><a href="#conversations">My Conversations</a></li>
        </ul>
    </nav>
    <main>
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
                <tbody></tbody>
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
                <tbody></tbody>
            </table>
        </section>
        <section id="propose-article">
            <h2>Propose an Article</h2>
            <form id="article-proposal-form">
                <label for="article-title">Title:</label>
                <input type="text" id="article-title" name="article-title" required />

                <label for="article-theme">Theme:</label>
                <select id="article-theme" name="article-theme" required>
                    <option value="">Select a theme</option>
                    <option value="ai">Artificial Intelligence</option>
                    <option value="cybersecurity">Cybersecurity</option>
                    <option value="iot">Internet of Things</option>
                </select>

                <label for="article-content">Content:</label>
                <textarea id="article-content" name="article-content" required rows="10"></textarea>

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
                <tbody></tbody>
            </table>
        </section>
        <section id="conversations">
            <h2>My Conversations</h2>
            <div id="conversations-list"></div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>