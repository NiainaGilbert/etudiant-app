<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', __('Dashboard'))</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Styles intégrés temporaires - à déplacer dans app.css après */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header et Navigation */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .nav-brand h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .nav-brand i {
            margin-right: 10px;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .language-switcher select {
            padding: 0.5rem;
            border-radius: 4px;
            border: none;
            background-color: white;
            color: #333;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Alertes */
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #666;
            border-top: 1px solid #e0e0e0;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .nav-actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @auth
    <header>
        <nav class="navbar">
            <div class="nav-brand">
                <h1><i class="fas fa-graduation-cap"></i> {{ __('Dashboard') }}</h1>
            </div>
            
            <div class="nav-menu">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i> {{ __('Dashboard') }}
                </a>
                <a href="{{ route('students.index') }}">
                    <i class="fas fa-users"></i> {{ __('Students') }}
                </a>
                <a href="{{ route('students.create') }}">
                    <i class="fas fa-user-plus"></i> {{ __('Add Student') }}
                </a>
            </div>
            
            <div class="nav-actions">
                <x-language-switcher />
                
                <span class="user-info">
                    <i class="fas fa-user"></i> {{ Auth::user()->username }}
                </span>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </nav>
    </header>
    @endauth
    
    <main class="container">
        <x-alert />
        
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; {{ date('Y') }} {{ __('Gestion des Étudiants') }}. {{ __('Tous droits réservés') }}.</p>
    </footer>
    
    @stack('scripts')
</body>
</html>