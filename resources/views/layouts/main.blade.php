<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Careers & Jobs')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    @stack('styles')
    
    <style>
        /* Base styles similar to the original site */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            background: #fafafa;
        }
        
        /* Header styles */
        .site-header {
            text-align: center;
            padding: 1rem 0;
            position: relative;
        }
        .site-header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }
        .site-header .logo img {
            height: 3.5rem;
            margin-right: 0.5rem;
            background: none;
        }
        .site-header .tagline {
            display: block;
            width: 100%;
            background: #0033a0;
            color: #fff;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        
        .service{
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #0033a0;
            font-size: 2rem;
            font-weight: extra-bold;
            font: bold 1.5rem/1.5 "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Form section styles */
        section {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        section h1 {
            margin-bottom: 1rem;
            font-size: 1.8rem;
            color: #0033a0;
            text-align: center;
        }
        
        section p {
            margin-bottom: 1.5rem;
        }
        
        /* Form styles */
        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }
        
        input, select {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            height: 20px;
        }
        
        button {
            width: 100%;
            background: #0033a0;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        button:hover {
            background: #00257a;
        }
        
        /* Footer styles */
        .site-footer {
            background: #f1f1f1;
            padding: 2rem 1rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.8rem;
        }
        
        .footer-nav {
            margin-top: 1rem;
        }
        
        .footer-nav a {
            color: #0033a0;
            text-decoration: none;
        }
        
        .footer-nav .divider {
            margin: 0 0.5rem;
            color: #999;
        }
        
        /* Job section specific */
        .job-section img {
            display: block;
            margin: 0 auto 1.5rem;
            height: 60px;
        }
        
        .info-list {
            list-style: none;
            margin: 1rem 0;
        }
        
        .info-list li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 1.2rem;
        }
        
        .info-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #0033a0;
            font-weight: bold;
        }
        
        .disclaimer {
            font-size: 0.8rem;
            color: #777;
            margin-top: 1.5rem;
        }
        
        /* Background check styles */
        .trusted-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }
        
        .trusted-section h2 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }
        
        .review-carousel {
            margin-top: 2rem;
            overflow: hidden;
        }
        
        .carousel-track {
            display: flex;
            animation: scroll 30s linear infinite;
        }
        
        .review {
            flex: 0 0 100%;
            padding: 1rem;
            background: #f7f9ff;
            border-radius: 4px;
            margin-right: 1rem;
        }
        
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-500%); }
        }
        
        /* Form validation */
        .invalid-feedback {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .is-invalid {
            border-color: red;
        }
        
        /* Alert messages */
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div id="app">
        <header class="site-header">
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                Careers&amp;Jobs
            </div>
            <div class="tagline">DISCOVER THE RIGHT FIT</div>
            <br/>
            <div class="service">{{ \App\Models\Setting::getValue('service_name', 'Kelly Service') }}</div>
        </header>

        <main>
            @if (session('error'))
                <div class="alert alert-danger" role="alert" style="max-width: 600px; margin: 1rem auto;">
                    {{ session('error') }}
                </div>
            @endif
            
            @if (session('success'))
                <div class="alert alert-success" role="alert" style="max-width: 600px; margin: 1rem auto;">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </main>

        <footer class="site-footer">
            <p class="footer-copy">
                © 2011 – 2025 StartAcareear. All rights reserved.
            </p>
            <p class="footer-description">
                StartAcareear is a job search engine. We are not an agent or representative of any Employer.<br>
                Registered trademarks are the property of their respective owners who do not sponsor or endorse this website.<br>
                This site may provide a list of third-party job postings and is not affiliated with any employer. You may be transferred to a third-party website to apply for a specific job. Sharing your personal information is optional.
            </p>
            <nav class="footer-nav footer-nav–legal">
                <a href="#">CA Consumers: Do Not Sell My Info</a>
                <span class="divider">|</span>
                <a href="#">Notice of Collection</a>
            </nav>
            <nav class="footer-nav">
                <a href="#">Terms and Conditions</a>
                <span class="divider">|</span>
                <a href="#">Privacy Policy</a>
                <span class="divider">|</span>
                <a href="#">FAQ</a>
                <span class="divider">|</span>
                <a href="#">Contact Us</a>
            </nav>
        </footer>
    </div>
    
    @stack('scripts')
</body>
</html>
