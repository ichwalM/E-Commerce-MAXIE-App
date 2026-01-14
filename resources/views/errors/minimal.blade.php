<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Maxie Skincare</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #99010A;
                --primary-dark: #7a0108;
                --gray-50: #f9fafb;
                --gray-100: #f3f4f6;
                --gray-800: #1f2937;
                --gray-600: #4b5563;
            }
            body {
                font-family: 'Instrument Sans', sans-serif;
                margin: 0;
                padding: 0;
                background-color: var(--gray-50);
                color: var(--gray-800);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                text-align: center;
            }
            .container {
                max-width: 600px;
                padding: 2rem;
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 16px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            .error-code {
                font-size: 6rem;
                font-weight: 700;
                color: var(--primary);
                line-height: 1;
                margin-bottom: 1rem;
            }
            .error-message {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
                color: var(--gray-800);
            }
            .error-description {
                color: var(--gray-600);
                margin-bottom: 2rem;
                line-height: 1.5;
            }
            .btn {
                display: inline-block;
                background-color: var(--primary);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.2s;
            }
            .btn:hover {
                background-color: var(--primary-dark);
            }
            .brand {
                margin-bottom: 2rem;
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--gray-800);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }
            .brand span {
                color: var(--primary);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="brand">
                MAXIE <span>SKINCARE</span>
            </div>
            
            <div class="error-code">
                @yield('code')
            </div>

            <div class="error-message">
                @yield('message')
            </div>

            <p class="error-description">
                We encountered an unexpected issue or the page you are looking for does not exist.
            </p>

            <a href="{{ url('/') }}" class="btn">
                Back to Home
            </a>
        </div>
    </body>
</html>
