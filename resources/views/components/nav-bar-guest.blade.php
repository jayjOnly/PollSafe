
<div>
    <nav class="navbar">
        <div class="logo">POLLSAFE</div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="home-link">Home</a></li>
            <li><a href="{{ route('about-us') }}" class="about-us-link">About Us</a></li>
            <li><a href="{{ route('faq') }}" class="faq-link">FAQ</a></li>
        </ul>
        <div class="nav-auth">
            <a href="{{ route('login') }}" class="login">Log In</a>
            <a href="{{ route('register') }}" class="register">Register</a>
        </div>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </nav>
    
    <div class="mobile-menu">
        <ul>
            <li><a href="{{ route('home') }}" class="home-link">Home</a></li>
            <li><a href="{{ route('about-us') }}" class="about-us-link">About Us</a></li>
            <li><a href="{{ route('faq') }}" class="faq-link">FAQ</a></li>
            <li><a href="{{ route('login') }}" class="login">Log In</a></li>
            <li><a href="{{ route('register') }}" class="register">Register</a></li>
        </ul>
    </div>
    
    <script>
        function toggleMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }

        function changeActive() {
            const linkClassList = {
                [new URL("{{ route('home') }}").pathname]: 'home-link',
                [new URL("{{ route('about-us') }}").pathname]: 'about-us-link',
                [new URL("{{ route('faq') }}").pathname]: 'faq-link',
            };
            
            const linkClass = linkClassList[new URL(window.location.href).pathname];
            if (linkClass) {
                const linkTextList = document.getElementsByClassName(linkClass);
                for (const linkTextItem of linkTextList) {
                    linkTextItem.classList.add('active')
                }
            }
        }
        
        changeActive();
    </script>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Nunito', sans-serif;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .navbar {
        font-weight: 750;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 15px 20px;
        position: relative;
        border-bottom: 1px solid rgb(227, 232, 244);
    }

    .logo {
        color: rgb(0, 105, 255);
        font-size: 24px;
    }

    .nav-links {
        list-style: none;
        display: flex;
    }

    .nav-links li {
        margin: 0 15px;
    }

    .nav-links a {
        text-decoration: none;
        color: gray;
        transition: color 0.3s;
    }

    .nav-links a.active,
    .nav-links a:hover {
        color: rgb(0, 105, 255);
    }

    .nav-auth {
        display: flex;
        align-items: center;
    }

    .nav-auth .login {
        text-decoration: none;
        color: gray;
        margin-right: 15px;
    }

    .nav-auth .login:hover {
        color: rgb(0, 105, 255);
    }

    .nav-auth .register {
        text-decoration: none;
        color: white;
        background: linear-gradient(135deg, rgb(0, 105, 255), rgb(0, 176, 255));
        padding: 10px 25px;
        border-radius: 25px;
    }

    .nav-auth .register:hover {
        background: linear-gradient(135deg, rgb(0, 90, 220), rgb(0, 150, 255));
    }

    .hamburger {
        display: none;
        font-size: 24px;
        cursor: pointer;
    }

    .mobile-menu {
        font-weight: 750;
        display: none;
        background-color: white;
        position: absolute;
        top: 60px;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .mobile-menu ul {
        list-style: none;
        padding: 10px 0;
    }

    .mobile-menu li {
        padding: 10px 20px;
    }

    .mobile-menu a {
        text-decoration: none;
        color: gray;
        display: block;
    }

    .mobile-menu a.active,
    .mobile-menu a:hover {
        color: rgb(0, 105, 255);
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .nav-auth {
            display: none;
        }

        .hamburger {
            display: block;
        }

        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: block;
        }
    }
</style>