<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - {{ config('app.name') }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .language-switcher-login {
            margin-top: 1.5rem;
            text-align: center;
        }

        .language-switcher-login select {
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: white;
            color: #333;
            cursor: pointer;
        }

        .test-credentials {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-graduation-cap"></i> {{ __('Welcome') }}</h1>
            <p>{{ __('Login') }}</p>
            <p class="test-credentials">
                Test: admin / admin123
            </p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <div class="form-group">
                <label for="username">
                    <i class="fas fa-user"></i> {{ __('Username') }}
                </label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="{{ old('username') }}"
                       required 
                       autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> {{ __('Password') }}
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> {{ __('Login button') }}
            </button>
        </form>
        
        <div class="language-switcher-login">
            <form action="{{ route('language.change') }}" method="get">
                <select name="lang" onchange="this.form.submit()">
                    <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>
                        🇫🇷 {{ __('French') }}
                    </option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                        🇬🇧 {{ __('English') }}
                    </option>
                </select>
            </form>
        </div>
    </div>
</body>
</html>