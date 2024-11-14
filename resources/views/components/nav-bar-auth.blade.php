<div>
    <nav class="navbar">
        <div class="logo">POLLSAFE</div>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}" class="dashboard">Dashboard</a></li>
            <li><a href="{{ route('organization') }}" class="organization">Organization</a></li>
        </ul>
        <div class="nav-auth">
            <div class="user-icon" onclick="toggleDropdown(event)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40">
                    <title>account</title>
                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                </svg>
            </div>
            <div class="dropdown" id="userDropdown">
                <div class="dropdown-item user-info">
                    <span class="username">{{ $user_name }}</span>
                    <span class="user-role">{{ $user_role }}</span>
                </div>
                <a href="{{ route('logout') }}" class="dropdown-item logout">Log Out</a>
            </div>
        </div>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </nav>
    
    <div class="mobile-menu">
        <ul>
            <li>
                <div class="user-info-mobile">
                    <span class="username-mobile">{{ $user_name }}</span>
                    <span class="user-role-mobile">{{ $user_role }}</span>
                </div>
            </li>
            <li><a href="{{ route('dashboard') }}" class="dashboard">Dashboard</a></li>
            <li><a href="{{ route('organization') }}" class="organization">Organization</a></li>
            <li><a href="{{ route('logout') }}" class="logout">Log Out</a></li>
        </ul>
    </div>

    <script>
        function toggleDropdown(event) {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
            event.stopPropagation();
        }


        window.addEventListener('click', function (event) {
            const dropdown = document.getElementById('userDropdown');
            if (!dropdown.contains(event.target) && !event.target.closest('.user-icon')) {
                dropdown.classList.remove('show');
            }
        });

        function toggleMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }

        function changeActive() {
            const linkClassList = {
                [new URL("{{ route('dashboard') }}").pathname]: 'dashboard',
                [new URL("{{ route('organization') }}").pathname]: 'organization',
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
        position: relative;
    }

    .user-icon {
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
        background-color: #f3f1f1;
        border: 2px solid black;
    }

    svg {
        width: 24px;
        height: 24px;
    }

    .dropdown {
        display: none;
        position: absolute;
        top: 35px;
        right: 0;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 200px;
        z-index: 1000;
    }

    .dropdown.show {
        display: block;
    }

    .dropdown-item {
        padding: 10px 15px;
        color: gray;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
        color: rgb(0, 105, 255);
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 15px;
        border-bottom: 1px solid rgb(227, 232, 244);
    }

    .username {
        font-size: 16px;
        font-weight: bold;
        color: black;
    }

    .user-role {
        font-size: 12px;
        color: gray;
        margin-top: 5px;
    }

    .user-info-mobile {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 0px;
        border-bottom: 1px solid rgb(227, 232, 244);
    }

    .user-info-mobile .username-mobile {
        font-size: 16px;
        font-weight: bold;
        color: black;
    }

    .user-info-mobile .user-role-mobile {
        font-size: 12px;
        color: gray;
        margin-top: 5px;
    }

    .logout {
        color: red;
    }

    .logout:hover {
        color: rgb(206, 0, 0);
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        .mobile-menu .logout {
            color: red;
        }

        .mobile-menu .logout:hover {
            color: rgb(206, 0, 0);
        }
    }
</style>

