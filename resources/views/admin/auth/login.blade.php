@extends('admin.layouts.guest')

@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div class="admin-login-alert">
            <span>✓</span>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div class="admin-login-form-group">
            <label for="email" class="admin-login-label">Email Address</label>
            <input 
                id="email" 
                class="admin-login-input @error('email') admin-login-error @enderror" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Enter your email"
                required 
                autofocus 
                autocomplete="username" 
            />
            @error('email')
                <div class="admin-login-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="admin-login-form-group">
            <label for="password" class="admin-login-label">Password</label>
            <input 
                id="password" 
                class="admin-login-input @error('password') admin-login-error @enderror"
                type="password"
                name="password"
                placeholder="Enter your password"
                required 
                autocomplete="current-password" 
            />
            @error('password')
                <div class="admin-login-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="admin-login-checkbox-group">
            <input 
                id="remember_me" 
                type="checkbox" 
                class="admin-login-checkbox" 
                name="remember"
                {{ old('remember') ? 'checked' : '' }}
            />
            <label for="remember_me" class="admin-login-checkbox-label">Remember me</label>
        </div>

        <div class="admin-login-actions">
            <span></span>
            <button type="submit" class="admin-login-button" id="loginButton">
                Sign In
            </button>
        </div>
    </form>

    <script>
        // Add loading state to form submission
        document.getElementById('loginForm').addEventListener('submit', function() {
            const button = document.getElementById('loginButton');
            button.classList.add('loading');
            button.textContent = 'Signing In...';
            button.disabled = true;
        });

        // Add focus effects
        const inputs = document.querySelectorAll('.admin-login-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.admin-login-label').style.color = 'var(--primary-color)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.admin-login-label').style.color = 'var(--text-primary)';
            });
        });
    </script>
@endsection
