<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Proposed Article: {{ $proposal->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/theme_manager.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>
    <nav>
        <a href="{{ route('theme_manager_dashboard') }}" class="logo">Back to Dashboard</a>
    </nav>
    <main>
        <h1>Proposed Article: {{ $proposal->title }}</h1>
        <section>
            <h2>Author: {{ $proposal->author->name }}</h2>
            <p>Proposed on: {{ $proposal->created_at->format('Y-m-d') }}</p>
            <div>
                <h3>Description</h3>
                <p>{{ $proposal->description }}</p>
            </div>
            <div>
                <h3>Content</h3>
                <p>{{ $proposal->content }}</p>
            </div>
            <div>
                <h3>Image</h3>
                <img src="{{ $proposal->image }}" alt="{{ $proposal->title }}" style="max-width: 100%;">
            </div>
            <div>
                <form action="{{ route('theme_manager.update_proposal') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                    <button type="submit" class="btn-primary">Propose to Editor</button>
                </form>
                <form action="{{ route('theme_manager.delete_proposal', $proposal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>

