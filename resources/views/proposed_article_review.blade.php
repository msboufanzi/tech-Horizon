<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tech Horizon - Review Proposed Article</title>
    <link rel="stylesheet" href="{{ asset('css/proposed_article_review.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('editor_dashboard') }}" class="logo">Back to Dashboard</a>
        </div>
    </nav>
    <main>
        <section>
            <h1>Review Proposed Article</h1>
            <div class="article-details">
                <h2>{{ $proposal->title }}</h2>
                <p><strong>Author:</strong> {{ $proposal->author->name }}</p>
                <p><strong>Theme:</strong> {{ $proposal->theme->title }}</p>
                <p><strong>Submitted:</strong> {{ $proposal->created_at->format('Y-m-d') }}</p>

                <div class="content-section">
                    <h3>Description</h3>
                    <p>{{ $proposal->description }}</p>
                </div>

                <div class="content-section">
                    <h3>Content</h3>
                    <div class="article-content">
                        {{ $proposal->content }}
                    </div>
                </div>

                @if($proposal->image)
                    <div class="content-section">
                        <h3>Image</h3>
                        <img src="{{ $proposal->image }}" alt="Article image" class="article-image">
                    </div>
                @endif

                <div class="actions">
                    <form action="{{ route('editor.approve_article', $proposal->id) }}" method="POST"
                        class="inline-form">
                        @csrf
                        <button type="submit" class="btn-success">Approve</button>
                    </form>

                    <form action="{{ route('editor.reject_article', $proposal->id) }}" method="POST"
                        class="inline-form">
                        @csrf
                        <button type="submit" class="btn-danger">Reject</button>
                    </form>

                </div>
            </div>
        </section>
    </main>
</body>

</html>