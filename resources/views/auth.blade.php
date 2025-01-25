<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Horizon - Authentication</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <nav>
        <div class="nav-content">
            <a href="{{ route('home') }}" class="logo">Tech Horizon</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('themes') }}">Themes</a>
                <a href="{{ route('public.articles') }}">Public Articles</a>
                <a href="{{ route('auth') }}">Sign in/up</a>
            </div>
        </div>
    </nav>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
                <input type="password" name="password" placeholder="Password" required />
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#" id="forgot">Forgot your password?</a>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
                <button type="submit">Sign In</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        To keep connected with us please login with your personal info
                    </p>
                    <button class="ghost" id="signInSwap">Swap To Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUpSwap">Swap To Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/auth.js"></script>
</body>

</html>