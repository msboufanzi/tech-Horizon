<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Magazine Management - Tech Horizon</title>
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
</head>
<body>
    <nav class="top-nav">
        <div class="container">
            <a href="{{ route('editor_dashboard') }}" class="back-link">Back to Dashboard</a>
        </div>
    </nav>

    <main class="container">
        <div class="magazine-details">
            <h1>Magazine Number {{ $magazine->number }} - collection {{ date('Y') }}</h1>
            <p>Status: {{ $magazine->is_public ? 'Public' : 'Private' }}</p>
            <p>Total Articles: {{ $magazine->articles->count() }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <section class="add-article-section">
            <h2>Add Article to Magazine</h2>
            <form action="{{ route('magazines.addArticle', ['id' => $magazine->id]) }}" method="POST" class="add-article-form">
                @csrf
                <select name="article_id" class="article-select" required>
                    <option value="">Select Article</option>
                    @foreach($availableArticles as $article)
                        <option value="{{ $article->id }}">{{ $article->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary">Add Article</button>
            </form>
        </section>

        <section class="magazine-articles">
            <h2>Articles in this Magazine</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Theme</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($magazine->articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author->name }}</td>
                        <td>{{ $article->theme->title }}</td>
                        <td>
                            <form action="{{ route('magazines.removeArticle', ['id' => $magazine->id, 'articleId' => $article->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>

