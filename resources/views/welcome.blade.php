<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    .nav-link {
    color: #475569;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    padding: 9px 8px;
}

.nav-link:hover {
    color: #2563eb;
}

html {
    scroll-behavior: smooth;
}

@media (max-width: 700px) {
    .nav-link {
        display: none;
    }

    .nav-actions {
        gap: 6px;
    }
}
    
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        .home-wrapper {
            min-height: 100vh;
        }

        /* Navbar */

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #111827;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            background: #2563eb;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .brand-text h2 {
            margin: 0;
            font-size: 20px;
        }

        .brand-text span {
            font-size: 12px;
            color: #6b7280;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-btn {
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .login-btn {
            color: #2563eb;
            border: 1px solid #2563eb;
            background: white;
        }

        .register-btn {
            color: white;
            background: #2563eb;
        }

        .nav-btn:hover {
            opacity: 0.9;
        }

        /* Hero */

        .hero {
            padding: 90px 6% 80px;
            background: linear-gradient(135deg, #eff6ff, #ffffff);
        }

        .hero-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 60px;
        }

        .hero-content h1 {
            margin: 0 0 20px;
            font-size: 52px;
            line-height: 1.1;
            color: #111827;
        }

        .hero-content h1 span {
            color: #2563eb;
        }

        .hero-content p {
            margin: 0 0 30px;
            max-width: 650px;
            font-size: 18px;
            line-height: 1.7;
            color: #64748b;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .hero-btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }

        .primary-btn {
            background: #2563eb;
            color: white;
        }

        .secondary-btn {
            background: white;
            color: #2563eb;
            border: 1px solid #2563eb;
        }

        .hero-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
            border: 1px solid #e5e7eb;
        }

        .dashboard-preview {
            background: #f8fafc;
            border-radius: 14px;
            padding: 20px;
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .preview-header strong {
            font-size: 17px;
        }

        .preview-header span {
            font-size: 12px;
            color: #64748b;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .preview-box {
            background: white;
            border-radius: 10px;
            padding: 16px;
            border: 1px solid #e5e7eb;
        }

        .preview-box span {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .preview-box strong {
            font-size: 24px;
            color: #111827;
        }

        /* Features */

        .features {
            padding: 80px 6%;
            background: white;
        }

        .section-title {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 45px;
        }

        .section-title h2 {
            margin: 0 0 12px;
            font-size: 34px;
            color: #111827;
        }

        .section-title p {
            margin: 0;
            color: #64748b;
            line-height: 1.7;
        }

        .feature-grid {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .feature-card {
            padding: 28px 22px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            background: #ffffff;
            transition: 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .feature-card p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Modules */

        .modules {
            padding: 80px 6%;
            background: #f8fafc;
        }

        .module-grid {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .module-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .module-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .module-item strong {
            display: block;
            margin-bottom: 4px;
        }

        .module-item span {
            font-size: 12px;
            color: #64748b;
        }

        /* CTA */

        .cta {
            padding: 80px 6%;
            background: #2563eb;
            text-align: center;
            color: white;
        }

        .cta h2 {
            margin: 0 0 14px;
            font-size: 36px;
        }

        .cta p {
            margin: 0 auto 25px;
            max-width: 650px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .cta-btn {
            display: inline-block;
            padding: 13px 25px;
            background: white;
            color: #2563eb;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 700;
        }

        /* Footer */

       /* Footer */

.footer {
    padding: 50px 6% 20px;
    background: #0f172a;
    color: #cbd5e1;
}

.footer-container {
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 50px;
    padding-bottom: 35px;
}

.footer-brand {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.footer-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.footer-brand strong {
    display: block;
    color: white;
    font-size: 17px;
    margin-bottom: 8px;
}

.footer-brand p {
    margin: 0;
    max-width: 400px;
    color: #94a3b8;
    font-size: 13px;
    line-height: 1.6;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.footer-links strong {
    color: white;
    font-size: 14px;
    margin-bottom: 5px;
}

.footer-links a {
    color: #94a3b8;
    text-decoration: none;
    font-size: 13px;
}

.footer-links a:hover {
    color: white;
}

.footer-bottom {
    max-width: 1200px;
    margin: auto;
    padding-top: 20px;
    border-top: 1px solid #1e293b;
    display: flex;
    justify-content: space-between;
    gap: 15px;
    color: #64748b;
    font-size: 12px;
}

@media (max-width: 700px) {

    .footer {
        padding: 40px 5% 20px;
    }

    .footer-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}

        /* Responsive */

        @media (max-width: 1000px) {
            .hero-container {
                grid-template-columns: 1fr;
            }

            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .module-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-content {
                text-align: center;
            }

            .hero-content p {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 650px) {
            .navbar {
                padding: 14px 5%;
            }

            .brand-text h2 {
                font-size: 17px;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .nav-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .hero {
                padding: 60px 5%;
            }

            .hero-content h1 {
                font-size: 38px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .feature-grid,
            .module-grid {
                grid-template-columns: 1fr;
            }

            .features,
            .modules {
                padding: 60px 5%;
            }

            .section-title h2 {
                font-size: 28px;
            }

            .cta {
                padding: 60px 5%;
            }

            .cta h2 {
                font-size: 28px;
            }

            .preview-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    /* Statistics */

.statistics {
    padding: 35px 6%;
    background: #ffffff;
}

.statistics-container {
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.stat-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    flex-shrink: 0;
}

.stat-card strong {
    display: block;
    font-size: 28px;
    color: #111827;
    margin-bottom: 4px;
}

.stat-card span {
    display: block;
    color: #64748b;
    font-size: 13px;
}

@media (max-width: 1000px) {
    .statistics-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 650px) {
    .statistics {
        padding: 25px 5%;
    }

    .statistics-container {
        grid-template-columns: 1fr;
    }
}
/* Role Welcome */

.role-welcome {
    padding: 20px 6% 35px;
    background: #ffffff;
}

.role-welcome-container {
    max-width: 1200px;
    margin: auto;
    padding: 22px 25px;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.welcome-label {
    display: block;
    color: #64748b;
    font-size: 13px;
    margin-bottom: 5px;
}

.role-welcome h2 {
    margin: 0 0 5px;
    font-size: 24px;
    color: #111827;
}

.role-welcome p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}

.role-badge {
    padding: 9px 18px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
}

.role-admin {
    background: #fee2e2;
    color: #b91c1c;
}

.role-teacher {
    background: #dbeafe;
    color: #1d4ed8;
}

.role-accountant {
    background: #dcfce7;
    color: #15803d;
}

@media (max-width: 650px) {
    .role-welcome {
        padding: 15px 5% 25px;
    }

    .role-welcome-container {
        align-items: flex-start;
        flex-direction: column;
    }

    .role-badge {
        width: 100%;
        text-align: center;
    }
}
    .feature-link {
    display: inline-block;
    margin-top: 16px;
    color: #2563eb;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
}

.feature-link:hover {
    text-decoration: underline;
}
.module-item {
    text-decoration: none;
    color: #111827;
    transition: 0.2s;
}

.module-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
}

.module-item strong {
    color: #111827;
}

.module-item:hover strong {
    color: #2563eb;
}

/* ========================================
   HOME PAGE FINAL UI POLISH
======================================== */

/* Better page rendering */

body {
    overflow-x: hidden;
}

.home-wrapper {
    overflow: hidden;
}


/* Hero improvement */

.hero {
    position: relative;
}

.hero-content h1 {
    letter-spacing: -1.2px;
}

.hero-content p {
    max-width: 620px;
}

.hero-card {
    transition: 0.25s ease;
}

.hero-card:hover {
    transform: translateY(-4px);
}


/* Statistics polish */

.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.10);
}

.stat-card strong {
    line-height: 1;
}


/* Feature cards */

.feature-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.feature-card p {
    flex: 1;
}

.feature-icon {
    transition: 0.2s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.08);
}


/* Module cards */

.module-item {
    min-height: 84px;
}

.module-icon {
    transition: 0.2s ease;
}

.module-item:hover .module-icon {
    transform: scale(1.08);
}


/* Buttons */

.hero-btn,
.nav-btn,
.cta-btn {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.primary-btn:hover,
.register-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.20);
}

.secondary-btn:hover,
.login-btn:hover {
    transform: translateY(-2px);
}


/* Section spacing */

.features,
.modules {
    scroll-margin-top: 20px;
}


/* Role welcome */

.role-welcome-container {
    transition: 0.2s ease;
}

.role-welcome-container:hover {
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
}


/* Footer */

.footer {
    position: relative;
}


/* Better mobile experience */

@media (max-width: 650px) {

    .hero-container {
        gap: 35px;
    }

    .hero-content h1 {
        font-size: 36px;
        letter-spacing: -0.5px;
    }

    .hero-card {
        padding: 18px;
    }

    .stat-card {
        padding: 18px;
    }

    .feature-card {
        padding: 22px 20px;
    }

    .module-item {
        min-height: 76px;
        padding: 16px;
    }

    .hero-buttons {
        width: 100%;
    }

    .hero-btn {
        width: 100%;
        text-align: center;
    }
}
    </style>
</head>

<body>

<div class="home-wrapper">

    <!-- Navbar -->

    <nav class="navbar">

        <a href="{{ url('/') }}" class="brand">

            <div class="brand-icon">
                🏫
            </div>

            <div class="brand-text">
                <h2>School Management</h2>
                <span>Management System</span>
            </div>

        </a>

        <div class="nav-actions">

            <a href="{{ url('/') }}" class="nav-link"> Home </a>
             <a href="#features" class="nav-link"> Features </a>
              <a href="#modules" class="nav-link"> Modules </a>

            @auth

                <a href="{{ route('dashboard') }}"
                   class="nav-btn register-btn">
                    Dashboard
                </a>

            @else

                <a href="{{ route('login') }}"
                   class="nav-btn login-btn">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="nav-btn register-btn">
                    Register
                </a>

            @endauth

        </div>

    </nav>


    <!-- Hero -->

    <section class="hero">

        <div class="hero-container">

            <div class="hero-content">

                <h1>
                    Modern
                    <span>School Management</span>
                    System
                </h1>

                <p>
                    Manage students, teachers, classes, attendance,
                    results, fees, expenses and income from one
                    powerful school management platform.
                </p>

                <div class="hero-buttons">

                    @auth

                        <a href="{{ route('dashboard') }}"
                           class="hero-btn primary-btn">
                            Go to Dashboard →
                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="hero-btn primary-btn">
                            Get Started →
                        </a>

                        <a href="{{ route('register') }}"
                           class="hero-btn secondary-btn">
                            Create Account
                        </a>

                    @endauth

                </div>

            </div>


            <div class="hero-card">

                <div class="dashboard-preview">

                    <div class="preview-header">

                        <strong>School Dashboard</strong>

                        <span>Overview</span>

                    </div>

                    <div class="preview-grid">

                        <div class="preview-box">
                            <span>Students</span>
                            <strong>120+</strong>
                        </div>

                        <div class="preview-box">
                            <span>Teachers</span>
                            <strong>25+</strong>
                        </div>

                        <div class="preview-box">
                            <span>Attendance</span>
                            <strong>95%</strong>
                        </div>

                        <div class="preview-box">
                            <span>Results</span>
                            <strong>98%</strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

  
    @auth
        <!-- Role Welcome -->

        <section class="role-welcome">

            <div class="role-welcome-container">

                <div>
                    <span class="welcome-label">Welcome back</span>

                    <h2>
                        {{ auth()->user()->name }}
                    </h2>

                    <p>
                        You are logged in as
                        <strong>{{ ucfirst(auth()->user()->role) }}</strong>.
                    </p>
                </div>

                <div class="role-badge role-{{ auth()->user()->role }}">
                    {{ ucfirst(auth()->user()->role) }}
                </div>

            </div>

        </section>
    @endauth



    <!-- Features -->

    <section class="features" id="features">

        <div class="section-title">

            <h2>Everything You Need</h2>

            <p>
                A complete school management solution designed
                to simplify daily academic and financial operations.
            </p>

        </div>


        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">👨‍🎓</div>

                <h3>Student Management</h3>

                <p>
                    Manage student profiles, academic information,
                    classes, sections and student records.
                </p>
                <a href="{{ route('students.index') }}" class="feature-link">
                     View Details →
                </a>
            </div>


            <div class="feature-card">

                <div class="feature-icon">👨‍🏫</div>

                <h3>Teacher Management</h3>

                <p>
                    Manage teacher information, subjects,
                    qualifications and assigned students.
                </p>
                <a href="{{ route('teachers.index') }}" class="feature-link">
                    View Details →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-icon">📅</div>

                <h3>Attendance</h3>

                <p>
                    Track daily student attendance with
                    present, absent and late status.
                </p>
                <a href="{{ route('attendances.index') }}" class="feature-link">
                    View Details →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-icon">📊</div>

                <h3>Results</h3>

                <p>
                    Manage exam results with marks, grades,
                    GPA and student result reports.
                </p>
                <a href="{{ route('results.index') }}" class="feature-link">
                    View Details →
                </a>

            </div>

        </div>

    </section>

   
    <!-- Statistics -->

    <section class="statistics">

        <div class="statistics-container">

            <div class="stat-card">
                <div class="stat-icon">👨‍🎓</div>
                <div>
                    <strong>{{ $students }}</strong>
                    <span>Total Students</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👨‍🏫</div>
                <div>
                    <strong>{{ $teachers }}</strong>
                    <span>Total Teachers</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🏫</div>
                <div>
                    <strong>{{ $classes }}</strong>
                    <span>Total Classes</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div>
                    <strong>{{ $subjects }}</strong>
                    <span>Total Subjects</span>
                </div>
            </div>

        </div>

    </section>




    <!-- Modules -->

  <!-- Modules -->

<section class="modules" id="modules">

    <div class="section-title">

        <h2>Powerful Management Modules</h2>

        <p>
            Manage your entire school from a single system.
        </p>

    </div>


    <div class="module-grid">

        <!-- Students -->

        <a href="{{ route('students.index') }}" class="module-item">

            <div class="module-icon">👨‍🎓</div>

            <div>
                <strong>Students</strong>
                <span>Student records & profiles</span>
            </div>

        </a>


        <!-- Teachers -->

        <a href="{{ route('teachers.index') }}" class="module-item">

            <div class="module-icon">👨‍🏫</div>

            <div>
                <strong>Teachers</strong>
                <span>Teacher information</span>
            </div>

        </a>


        <!-- Classes -->

        <a href="{{ route('classes.index') }}" class="module-item">

            <div class="module-icon">🏫</div>

            <div>
                <strong>Classes</strong>
                <span>Class & section management</span>
            </div>

        </a>


        <!-- Subjects -->

        <a href="{{ route('subjects.index') }}" class="module-item">

            <div class="module-icon">📚</div>

            <div>
                <strong>Subjects</strong>
                <span>Subject management</span>
            </div>

        </a>


        <!-- Attendance -->

        <a href="{{ route('attendances.index') }}" class="module-item">

            <div class="module-icon">📅</div>

            <div>
                <strong>Attendance</strong>
                <span>Daily attendance tracking</span>
            </div>

        </a>


        <!-- Results -->

        <a href="{{ route('results.index') }}" class="module-item">

            <div class="module-icon">📝</div>

            <div>
                <strong>Results</strong>
                <span>Marks, grade & GPA</span>
            </div>

        </a>


        <!-- Fees -->

        <a href="{{ route('fees.index') }}" class="module-item">

            <div class="module-icon">💰</div>

            <div>
                <strong>Fees</strong>
                <span>Student fee management</span>
            </div>

        </a>


        <!-- Expenses -->

        <a href="{{ route('expenses.index') }}" class="module-item">

            <div class="module-icon">💸</div>

            <div>
                <strong>Expenses</strong>
                <span>School expense tracking</span>
            </div>

        </a>


        <!-- Income -->

        <a href="{{ route('incomes.index') }}" class="module-item">

            <div class="module-icon">💵</div>

            <div>
                <strong>Income</strong>
                <span>Income management & reports</span>
            </div>

        </a>

    </div>

</section>

    <!-- CTA -->

    <section class="cta">

        <h2>Ready to Manage Your School?</h2>

        <p>
            Access your school management dashboard and
            manage academic and financial activities efficiently.
        </p>

        @auth

            <a href="{{ route('dashboard') }}"
               class="cta-btn">
                Open Dashboard →
            </a>

        @else

            <a href="{{ route('login') }}"
               class="cta-btn">
                Login to System →
            </a>

        @endauth

    </section>


    <!-- Footer -->

    <footer class="footer">

    <div class="footer-container">

        <div class="footer-brand">

            <div class="footer-icon">
                🏫
            </div>

            <div>
                <strong>School Management System</strong>

                <p>
                    Complete school management solution
                    for academic and financial operations.
                </p>
            </div>

        </div>


        <div class="footer-links">

            <strong>Quick Links</strong>

            <a href="{{ url('/') }}">
                Home
            </a>

            <a href="#features">
                Features
            </a>

            <a href="#modules">
                Modules
            </a>

        </div>


        <div class="footer-links">

            <strong>Account</strong>

            @auth

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

            @else

                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}">
                    Register
                </a>

            @endauth

        </div>

    </div>


    <div class="footer-bottom">

        <span>
            © {{ date('Y') }} School Management System.
            All rights reserved.
        </span>

        <span>
            System Status: ● Online
        </span>

    </div>

</footer>

</div>

</body>
</html>