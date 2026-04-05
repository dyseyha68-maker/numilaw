<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'National University of Management - Faculty of Law')">
    <title>@yield('title', 'NUMiLaw')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Inter:wght@300;400;500;600&display=swap');
        
        :root {
            --primary: #003A46;
            --secondary: #006d77;
            --accent: #00a8cc;
            --nav-bg: #003A46;
            --font-en: 'Merriweather', serif;
            --font-km: 'Kantumruy Pro', sans-serif;
            --current-font: 'Merriweather', serif;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: var(--current-font);
            background: #f8fafc;
            color: #1e293b;
            font-size: 17px;
            line-height: 1.7;
        }
        
        html[lang="km"] body, body.km {
            --current-font: 'Kantumruy Pro', sans-serif;
            font-size: 16px;
            line-height: 1.8;
        }

        /* TOP BAR */
        .top-bar {
            background: #003A46;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 0;
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .top-bar-left svg {
            width: 14px;
            height: 14px;
            opacity: 0.5;
            flex-shrink: 0;
        }
        .top-bar-left span {
            font-size: 11px;
            color: #8aa5b5;
            letter-spacing: 0.04em;
        }
        .top-bar-left strong {
            font-size: 11px;
            color: #00a8cc;
            font-weight: 500;
            letter-spacing: 0.04em;
        }
        .top-bar-pipe {
            color: #004d5c;
            margin: 0 2px;
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 0;
        }
        .top-bar-right a {
            font-size: 11px;
            color: #8aa5b5;
            text-decoration: none;
            letter-spacing: 0.04em;
            padding: 0 12px;
            transition: color 0.15s;
            border-right: 1px solid #004d5c;
        }
        .top-bar-right a:first-child {
            border-left: 1px solid #004d5c;
        }
        .top-bar-right a:hover {
            color: #00a8cc;
        }
        .lang-switch {
            display: flex;
            align-items: center;
            gap: 0;
        }
        .lang-switch a {
            font-size: 11px;
            color: #8aa5b5;
            text-decoration: none;
            padding: 0 10px;
            border-right: 1px solid #004d5c;
            transition: color 0.15s;
        }
        .lang-switch a:hover, .lang-switch a.active {
            color: #00a8cc;
        }
        .lang-switch a:last-child {
            border-right: none;
        }

        /* BRAND BAR */
        .brand-bar {
            display: flex;
            width: 100%;
            background: #fff;
            position: sticky;
            top: 29px;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-bottom: 1px solid #f0ede6;
        }
        .brand-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }
        .brand-logo img {
            height: 70px;
            width: auto;
            display: block;
        }
        .brand-logo-fallback {
            width: 70px;
            height: 70px;
            background: #0f1d33;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            display: none;
        }
        .brand-logo-fallback span {
            font-family: 'Merriweather', serif;
            font-size: 20px;
            font-weight: 700;
            color: #c4a35a;
            letter-spacing: 0.1em;
        }
        .brand-sep {
            width: 1px;
            height: 46px;
            background: #e0d8c8;
        }
        .brand-text h1 {
            font-family: 'Merriweather', serif;
            font-size: 21px;
            font-weight: 700;
            color: #0f1d33;
            letter-spacing: 0.03em;
            line-height: 1.15;
        }
        .brand-text p {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #9a8a60;
            margin-top: 3px;
        }
        .brand-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-right: 8px;
        }
        .brand-info-line {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #888;
            letter-spacing: 0.03em;
        }
        .brand-info-line svg {
            opacity: 0.5;
            flex-shrink: 0;
            width: 11px;
            height: 11px;
        }
        .brand-info-line + .brand-info-line {
            margin-top: 3px;
        }
        .btn-srch {
            background: none;
            border: 1px solid #e0e0e0;
            color: #666;
            padding: 8px 14px;
            font-family: 'Merriweather', serif;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.2s;
            letter-spacing: 0.03em;
        }
        .btn-srch:hover {
            border-color: #003A46;
            color: #003A46;
        }
        .btn-lg {
            background: transparent;
            border: none;
            color: #003A46;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-lg:hover {
            color: #00a8cc;
        }
        .btn-lg i {
            font-size: 32px;
        }
        .mobile-login-btn a {
            background: transparent;
            border: none;
            color: #003A46;
            padding: 8px 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .mobile-login-btn a:hover {
            color: #00a8cc;
        }
        .mobile-login-btn a i {
            font-size: 32px;
        }
        .btn-ap {
            background: #00a8cc;
            border: 1.5px solid #00a8cc;
            color: #fff;
            padding: 8px 22px;
            font-family: 'Merriweather', serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 5px;
            letter-spacing: 0.06em;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-ap:hover {
            background: #0088aa;
            border-color: #0088aa;
            color: #fff;
        }

        /* NAV BAR */
        .nav-bar {
            background: #003A46;
            width: 100%;
            position: fixed;
            top: 130px;
            left: 0;
            right: 0;
            z-index: 998;
            transform: translateY(0);
            transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }
        .nav-bar.nav-hidden {
            transform: translateY(-100%);
        }
        .nav-bar.nav-visible {
            transform: translateY(0);
        }
        .nav-bar-inner {
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            padding: 0;
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }

        .nav-list {
            display: flex;
            list-style: none;
            gap: 0;
            align-items: stretch;
            margin: 0;
            padding: 0;
        }
        .nav-list > li {
            position: relative;
            display: flex;
            align-items: stretch;
        }
        .nav-list > li > a {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0 18px;
            height: 48px;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.03em;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            position: relative;
        }
        .nav-list > li > a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #00a8cc;
            transition: width 0.3s ease;
        }
        .nav-list > li > a:hover,
        .nav-list > li:hover > a {
            color: #00a8cc;
            background: rgba(255,255,255,0.05);
        }
        .nav-list > li > a:hover::after,
        .nav-list > li:hover > a::after {
            width: 80%;
        }
        .nav-list > li.act > a {
            color: #00a8cc;
        }
        .nav-list > li.act > a::after {
            width: 80%;
        }
        .nav-list > li > a .arr {
            transition: transform 0.2s;
            opacity: 0.6;
            font-size: 10px;
        }
        .nav-list > li:hover > a .arr {
            transform: rotate(180deg);
            opacity: 1;
        }
        .nav-drop {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 240px;
            background: #fff;
            border-top: 3px solid #00a8cc;
            z-index: 999;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 0 0 8px 8px;
            opacity: 0;
            transform: translateY(-8px) translateZ(0);
            transition: opacity 0.1s ease-out, transform 0.1s ease-out;
            will-change: opacity, transform;
            backface-visibility: hidden;
            contain: layout style;
        }
        .nav-list > li:hover .nav-drop {
            display: block;
            opacity: 1;
            transform: translateY(0) translateZ(0);
        }
        .nav-drop a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            font-size: 13px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
            letter-spacing: 0.02em;
        }
        .nav-drop a:last-child {
            border-bottom: none;
            border-radius: 0 0 8px 8px;
        }
        .nav-drop a:hover {
            background: #f8fafc;
            color: #003A46;
            padding-left: 28px;
        }
        .nav-drop a::before {
            content: '';
            width: 5px;
            height: 5px;
            background: #00a8cc;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }
        .nav-drop a:hover::before {
            opacity: 1;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-tag {
            background: rgba(0, 168, 204, 0.15);
            border: 1px solid rgba(0, 168, 204, 0.3);
            color: #00a8cc;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 3px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .nav-adm {
            background: #00a8cc;
            color: #fff;
            font-family: 'Merriweather', serif;
            font-size: 11px;
            font-weight: 700;
            padding: 0 20px;
            height: 48px;
            border: none;
            cursor: pointer;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .nav-adm:hover {
            background: #0088aa;
            color: #fff;
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 400px);
            padding-top: 0;
        }

        /* Footer */
        .footer {
            background: #003A46;
            color: #a8c5cf;
            padding: 0;
            width: 100%;
        }
        .why-choose-section {
            background: white;
            width: 100%;
        }
        .why-choose-section .why-choose-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 3rem 15px;
        }
        .footer-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 50px 0 30px;
            width: 100%;
        }
        .footer-top {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        .footer-brand-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
        }
        .footer-logo img {
            height: 45px;
            width: auto;
        }
        .footer-logo-text {
            font-family: 'Merriweather', serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.03em;
        }
        .footer-desc {
            font-size: 13px;
            line-height: 1.4;
            color: #8aa5b5;
            margin-bottom: 0;
        }
        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }
        .footer-social a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            color: #a8c5cf;
            transition: all 0.2s;
        }
        .footer-social a:hover {
            background: #00a8cc;
            color: #fff;
            transform: translateY(-2px);
        }
        .footer-title {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-align: center;
        }
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 2px;
            background: #00a8cc;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: #8aa5b5;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .footer-links a::before {
            content: '';
            width: 4px;
            height: 4px;
            background: #00a8cc;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .footer-links a:hover {
            color: #fff;
            transform: translateX(4px);
        }
        .footer-links a:hover::before {
            opacity: 1;
        }
        .footer-contact {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .footer-contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 13px;
            color: #8aa5b5;
            text-align: center;
        }
        .footer-contact-item svg {
            width: 16px;
            height: 16px;
            color: #00a8cc;
            flex-shrink: 0;
        }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            font-size: 12px;
            color: #6b8a96;
        }
        .footer-bottom a {
            color: #00a8cc;
            text-decoration: none;
        }
        .footer-bottom a:hover {
            text-decoration: underline;
        }
        
        /* Mobile Navigation */
        .mobile-fixed-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 65px;
            background: #fff;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        
        .mobile-menu-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            color: #003A46;
            font-size: 32px;
            cursor: pointer;
            padding: 8px;
        }
        
        .mobile-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .mobile-logo img {
            height: 55px;
            width: auto;
        }
        
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
        }
        
        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            right: -320px;
            width: 85%;
            max-width: 320px;
            height: 100%;
            background: #fff;
            z-index: 1000;
            overflow-y: auto;
            transition: right 0.3s ease;
            box-shadow: -5px 0 20px rgba(0,0,0,0.2);
        }
        
        .mobile-nav.active {
            right: 0;
        }
        
        .mobile-nav-header {
            background: #003A46;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .mobile-nav-close {
            background: none;
            border: none;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
        }
        
        .mobile-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .mobile-nav-list > li {
            border-bottom: 1px solid #eee;
        }
        
        .mobile-nav-list > li > a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            color: #003A46;
            text-decoration: none;
            font-weight: 500;
        }
        
        .mobile-nav-list > li > a:hover {
            background: #f5f5f5;
        }
        
        .mobile-nav-drop {
            display: none;
            background: #f8f9fa;
        }
        
        .mobile-nav-drop.active {
            display: block;
        }
        
        .mobile-nav-drop a {
            display: block;
            padding: 12px 20px 12px 35px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }
        
        .mobile-nav-drop a:hover {
            background: #e9ecef;
        }
        
        .mobile-lang-switch {
            padding: 15px 20px;
            display: flex;
            gap: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .mobile-lang-switch a {
            flex: 1;
            text-align: center;
            padding: 10px;
            background: #f5f5f5;
            color: #003A46;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }
        
        .mobile-lang-switch a.active {
            background: #003A46;
            color: #fff;
        }

        /* Tablet Responsive */
        @media (max-width: 991px) {
            .top-bar, .brand-bar, .nav-bar, .top-bar-inner, .brand-bar-inner, .nav-bar-inner {
                padding-left: 20px;
                padding-right: 20px;
            }
            .top-bar {
                flex-direction: column;
                gap: 8px;
                padding: 10px 20px;
            }
            .brand-bar {
                flex-wrap: wrap;
                gap: 15px;
            }
            .brand-info {
                display: none;
            }
            .nav-bar {
                overflow-x: auto;
            }
            .nav-list {
                flex-wrap: nowrap;
            }
            .footer-top {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }
            .footer-bottom {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            body {
                background: #f8fafc !important;
                padding-top: 65px !important;
            }
            .mobile-fixed-header {
                display: flex !important;
            }
            .top-bar {
                display: none !important;
            }
            .brand-bar {
                display: none !important;
            }
            .nav-bar {
                display: none !important;
            }
            .mobile-overlay {
                display: block !important;
            }
            .mobile-nav {
                display: block !important;
            }
            .footer-top {
                grid-template-columns: 1fr;
            }
            .hero-section {
                min-height: 60vh !important;
            }
        }
        
        @media (max-width: 576px) {
            .footer-top {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="{{ app()->getLocale() }}">
    <!-- Mobile Fixed Header -->
    <div class="mobile-fixed-header" id="mobileHeader">
        <a href="{{ url('/') }}" class="mobile-logo">
            <img src="{{ url('/laravel-img/logo.png') }}" alt="NUM iLAW">
        </a>
        <button class="mobile-menu-btn" onclick="toggleMobileNav()">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Registration Banner -->
    @php
        $upcomingRegistrations = \App\Models\MootParticipation::with('moot')
            ->where('status', 'registration_open')
            ->where('is_published', true)
            ->orderBy('year', 'desc')
            ->get();
    @endphp
    
    @if($upcomingRegistrations->count() > 0)
    <div class="registration-banner" style="background: linear-gradient(135deg, #003A46 0%, #006d77 100%); padding: 0.75rem 0;">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2" style="max-width: 1400px; margin: 0 auto;">
            <div class="d-flex align-items-center text-white">
                <i class="bi bi-calendar-check me-2" style="font-size: 1.2rem;"></i>
                <span class="fw-semibold">{{ app()->getLocale() === 'km' ? 'ការចុះឈ្មោះបើកទទួលបាន!' : 'Open for Registration!' }}</span>
                <span class="text-white-50 ms-2 d-none d-md-inline">
                    @if($upcomingRegistrations->count() === 1)
                        {{ $upcomingRegistrations->first()->moot->name_en }} {{ $upcomingRegistrations->first()->year }}
                    @else
                        {{ $upcomingRegistrations->count() }} {{ app()->getLocale() === 'km' ? '�ារប្រកួត' : 'competitions' }}
                    @endif
                </span>
            </div>
            <a href="{{ route('public.moot-programs.index') }}#register" 
               class="btn btn-light btn-sm fw-bold" 
               style="background: #fff; color: #003A46; border-radius: 20px; padding: 0.4rem 1.25rem;">
                <i class="bi bi-pencil-square me-1"></i>
                {{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យ' : 'Register Now' }}
            </a>
        </div>
    </div>
    @endif

    <!-- TOP BAR -->
    <div class="top-bar" style="background: #003A46 !important;">
        <div class="top-bar-inner">
            <div class="top-bar-left">
                <svg viewBox="0 0 24 24" fill="none" stroke="#00a8cc" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <strong>National University of Management</strong>
                <span class="top-bar-pipe">·</span>
                <span>International Program of Legal Studies</span>
            </div>
            <div class="top-bar-right">
                <a href="https://numregister.com/students/login" target="_blank">Student Portal</a>
                <a href="https://www.librarynum.com/" target="_blank">E-Library</a>
                <a href="{{ route('public.faculty.index') }}">Directory</a>
                <a href="{{ route('public.about.index') }}">Contact</a>
                <div class="lang-switch">
                    <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('language.switch', 'km') }}" class="{{ app()->getLocale() === 'km' ? 'active' : '' }}">ខ្មែរ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- BRAND BAR -->
    <div class="brand-bar" style="background: #fff !important;">
        <div class="brand-bar-inner">
            <a href="{{ url('/') }}" class="brand-logo">
                <img src="{{ url('/laravel-img/logo.png') }}" alt="NUM iLAW" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="brand-logo-fallback"><span>iLAW</span></div>
            </a>

            <div class="brand-right">
                <div class="brand-info">
                    <div class="brand-info-line">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        St.96 Christopher Howes, Khan Daun Penh, Phnom Penh
                    </div>
                    <div class="brand-info-line">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.58 3.38a2 2 0 0 1 2-2.18H7.5a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        +855 (17) 611-252 &nbsp;·&nbsp; info@numilaw.edu.kh
                    </div>
                </div>
                <a href="{{ route('login') }}" class="btn-lg" title="Login">
                    <i class="bi bi-person"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- NAVIGATION BAR -->
    <nav class="nav-bar" style="background: #003A46 !important;">
        <div class="nav-bar-inner">
            <ul class="nav-list">
            <li class="{{ request()->routeIs('public.admission.*') ? 'act' : '' }}">
                <a href="{{ route('public.admission.index') }}">{{ app()->getLocale() === 'km' ? 'ការទទួលពាក្យចូលរៀន' : 'Admissions' }}</a>
            </li>
            <li class="{{ request()->routeIs('public.academic_program*') || request()->routeIs('public.academic-calendar.*') || request()->routeIs('public.faculty.*') || request()->routeIs('student-experience.*') ? 'act' : '' }}">
                <a href="#">
                    {{ app()->getLocale() === 'km' ? 'វគ្គសិក្សា' : 'Academic' }}
                    <svg class="arr" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="nav-drop">
                    <a href="{{ route('public.academic-programs.index') }}">{{ app()->getLocale() === 'km' ? 'កម្មវិធីសិក្សា' : 'Programs' }}</a>
                    <a href="{{ route('public.academic-calendar.index') }}">{{ app()->getLocale() === 'km' ? 'ប្រតិទិន' : 'Academic Calendar' }}</a>
                    <a href="{{ route('public.faculty.index') }}">{{ app()->getLocale() === 'km' ? 'សាស្ត្រាចារ្យ' : 'Faculty' }}</a>
                    <a href="{{ route('student-experience.index') }}">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</a>
                </div>
            </li>
            <li class="{{ request()->routeIs('public.moot-programs.*') ? 'act' : '' }}">
                <a href="{{ route('public.moot-programs.index') }}">{{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់' : 'Moot Courts' }}</a>
            </li>
            <li class="{{ request()->routeIs('public.articles.*') || request()->routeIs('public.events.*') || request()->routeIs('public.projects.*') ? 'act' : '' }}">
                <a href="#">
                    {{ app()->getLocale() === 'km' ? 'ប្រព័ន្ធផ្សព្វផ្សាយ' : 'Media & Publications' }}
                    <svg class="arr" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="nav-drop">
                    <a href="{{ route('public.articles.index') }}">{{ app()->getLocale() === 'km' ? 'អត្ថបទ' : 'Articles' }}</a>
                    <a href="{{ route('public.events.index') }}">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events' }}</a>
                    <a href="{{ route('public.projects.index') }}">{{ app()->getLocale() === 'km' ? 'គម្រោង' : 'Projects' }}</a>
                </div>
            </li>
            <li class="{{ request()->routeIs('public.alumni.*') || request()->routeIs('public.jobs.*') || request()->routeIs('public.alumni-events.*') ? 'act' : '' }}">
                <a href="#">
                    {{ app()->getLocale() === 'km' ? 'សមាគមអតីតនិស្សិត' : 'Alumni Association' }}
                    <svg class="arr" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="nav-drop">
                    <a href="{{ route('public.alumni.index') }}">{{ app()->getLocale() === 'km' ? 'អំពីសមាគម' : 'About Association' }}</a>
                    <a href="{{ route('public.jobs.index') }}">{{ app()->getLocale() === 'km' ? 'ការងារ' : 'Jobs' }}</a>
                    <a href="{{ route('public.alumni-events.index') }}">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Alumni Events' }}</a>
                </div>
            </li>
            <li class="{{ request()->routeIs('public.about.*') || request()->routeIs('partners.*') ? 'act' : '' }}">
                <a href="#">
                    {{ app()->getLocale() === 'km' ? 'អំពី' : 'About' }}
                    <svg class="arr" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="nav-drop">
                    <a href="{{ route('public.about.index') }}">{{ app()->getLocale() === 'km' ? 'អំពីកម្មវិធី' : 'About Us' }}</a>
                    <a href="{{ route('partners.index') }}">{{ app()->getLocale() === 'km' ? 'ដៃគូសាកលវិទ្យាល័យ' : 'Partner Universities' }}</a>
                    <a href="{{ route('public.about.leadership') }}">{{ app()->getLocale() === 'km' ? ' ក្រុមប្រឹក្សា' : 'Leadership Team' }}</a>
                </div>
            </li>
        </ul>
        </div>
    </nav>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileNav()"></div>
    
    <!-- Mobile Navigation Drawer -->
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <span style="font-family: 'Merriweather', serif; font-weight: 700;">NUMiLaw</span>
            <button class="mobile-nav-close" onclick="toggleMobileNav()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="mobile-lang-switch">
            <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            <a href="{{ route('language.switch', 'km') }}" class="{{ app()->getLocale() === 'km' ? 'active' : '' }}">KH</a>
        </div>
        <ul class="mobile-nav-list">
            <li>
                <a href="{{ route('public.admission.index') }}">
                    {{ app()->getLocale() === 'km' ? 'ការទទួលពាក្យចូលរៀន' : 'Admissions' }}
                </a>
            </li>
            <li>
                <a href="#" onclick="toggleMobileDrop(this); return false;">
                    {{ app()->getLocale() === 'km' ? 'វគ្គសិក្សា' : 'Academic' }}
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="mobile-nav-drop">
                    <a href="{{ route('public.academic-programs.index') }}">{{ app()->getLocale() === 'km' ? 'កម្មវិធីសិក្សា' : 'Programs' }}</a>
                    <a href="{{ route('public.academic-calendar.index') }}">{{ app()->getLocale() === 'km' ? 'ប្រតិទិន' : 'Academic Calendar' }}</a>
                    <a href="{{ route('public.faculty.index') }}">{{ app()->getLocale() === 'km' ? 'សាស្ត្រាចារ្យ' : 'Faculty' }}</a>
                    <a href="{{ route('student-experience.index') }}">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</a>
                </div>
            </li>
            <li>
                <a href="{{ route('public.moot-programs.index') }}">
                    {{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់' : 'Moot Courts' }}
                </a>
            </li>
            <li>
                <a href="#" onclick="toggleMobileDrop(this); return false;">
                    {{ app()->getLocale() === 'km' ? 'ប្រព័ន្ធផ្សព្វផ្សាយ' : 'Media & Publications' }}
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="mobile-nav-drop">
                    <a href="{{ route('public.articles.index') }}">{{ app()->getLocale() === 'km' ? 'អត្ថបទ' : 'Articles' }}</a>
                    <a href="{{ route('public.events.index') }}">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events' }}</a>
                    <a href="{{ route('public.projects.index') }}">{{ app()->getLocale() === 'km' ? 'គម្រោង' : 'Projects' }}</a>
                </div>
            </li>
            <li>
                <a href="#" onclick="toggleMobileDrop(this); return false;">
                    {{ app()->getLocale() === 'km' ? 'សមាគមអតីតនិស្សិត' : 'Alumni Association' }}
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="mobile-nav-drop">
                    <a href="{{ route('public.alumni.index') }}">{{ app()->getLocale() === 'km' ? 'អំពីសមាគម' : 'About Association' }}</a>
                    <a href="{{ route('public.jobs.index') }}">{{ app()->getLocale() === 'km' ? 'ការងារ' : 'Jobs' }}</a>
                    <a href="{{ route('public.alumni-events.index') }}">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Alumni Events' }}</a>
                </div>
            </li>
            <li>
                <a href="#" onclick="toggleMobileDrop(this); return false;">
                    {{ app()->getLocale() === 'km' ? 'អំពី' : 'About' }}
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="mobile-nav-drop">
                    <a href="{{ route('public.about.index') }}">{{ app()->getLocale() === 'km' ? 'អំពីកម្មវិធី' : 'About Us' }}</a>
                    <a href="{{ route('partners.index') }}">{{ app()->getLocale() === 'km' ? 'ដៃគូសាកលវិទ្យាល័យ' : 'Partner Universities' }}</a>
                    <a href="{{ route('public.about.leadership') }}">{{ app()->getLocale() === 'km' ? 'ក្រុមប្រឹក្សា' : 'Leadership Team' }}</a>
                </div>
            </li>
            <li class="mobile-login-btn">
                <a href="{{ route('login') }}" title="Login">
                    <i class="bi bi-person"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand-section">
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                    <p class="footer-desc" style="margin-top: 15px;">
                        {{ app()->getLocale() === 'km' ? 'កម្មវិធីអន្តរជាតិផ្នែកច្បាប់ នៃ សាកលវិទ្យាល័យជាតិគ្រប់គ្រង' : 'National University of Management - International Program of Legal Studies' }}
                    </p>
                    <p class="footer-desc" style="font-size: 12px;">
                        St.96 Christopher Howes, Khan Daun Penh, Phnom Penh<br>
                        +855 (17) 611-252 · info@numilaw.edu.kh
                    </p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} NUM iLAW. {{ app()->getLocale() === 'km' ? 'រក្សាសិទ្ធិគ្រប់បែប' : 'All rights reserved.' }}</p>
                <div>
                    <a href="#">{{ app()->getLocale() === 'km' ? ' ភាក្ខីភាព' : 'Privacy Policy' }}</a>
                    <span style="margin: 0 10px;">|</span>
                    <a href="#">{{ app()->getLocale() === 'km' ? ' លក្ខខណ្ឌ' : 'Terms of Use' }}</a>
                </div>
            </div>
        </div>
    </footer>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set font based on locale
        document.addEventListener('DOMContentLoaded', function() {
            const locale = document.documentElement.lang;
            if (locale === 'km') {
                document.body.style.fontFamily = "'Kantumruy Pro', sans-serif";
            } else {
                document.body.style.fontFamily = "'Merriweather', serif";
            }
        });
        
        // Scroll behavior for header (hide on scroll down, show on scroll up)
        (function() {
            const navBar = document.querySelector('.nav-bar');
            if (!navBar) return;
            
            let lastScrollY = window.scrollY;
            let ticking = false;
            
            function updateNav() {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > lastScrollY && currentScrollY > 100) {
                    // Scrolling down - hide nav
                    navBar.classList.add('nav-hidden');
                    navBar.classList.remove('nav-visible');
                } else {
                    // Scrolling up - show full nav bar
                    navBar.classList.remove('nav-hidden');
                    navBar.classList.add('nav-visible');
                }
                
                lastScrollY = currentScrollY;
                ticking = false;
            }
            
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(updateNav);
                    ticking = true;
                }
            }, { passive: true });
        })();
        
        // Mobile Navigation Functions
        function toggleMobileNav() {
            const nav = document.getElementById('mobileNav');
            const overlay = document.getElementById('mobileOverlay');
            nav.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        
        function toggleMobileDrop(element) {
            const drop = element.nextElementSibling;
            const icon = element.querySelector('i');
            drop.classList.toggle('active');
            if (drop.classList.contains('active')) {
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
            } else {
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
            }
        }
        
        // Close mobile nav when clicking on a link
        document.querySelectorAll('.mobile-nav-drop a').forEach(function(link) {
            link.addEventListener('click', function() {
                toggleMobileNav();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
