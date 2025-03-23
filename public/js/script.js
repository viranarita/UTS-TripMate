document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ Script berhasil dimuat!");

    // Navigasi antara index.html dan destination.html
    document.querySelectorAll('a[href="destination.php"]').forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            window.location.href = "destination.php";
        });
    });

    document.querySelectorAll('a[href="index.php"]').forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            window.location.href = "index.php";
        });
    });

    // FORM LOGIN
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();
            console.log("✅ Login berhasil, mengalihkan ke index.php...");
            window.location.href = "index.php"; // Arahkan setelah login
        });
    } else {
        console.error("❌ Form login tidak ditemukan!");
    }

    // FORM REGISTER
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault();
            console.log("✅ Registrasi berhasil, mengalihkan ke index.php...");
            window.location.href = "index.php"; // Arahkan setelah daftar
        });
    } else {
        console.error("❌ Form register tidak ditemukan!");
    }

    // Login & Register Page Toggle
    const loginPage = document.getElementById("loginPage");
    const registerPage = document.getElementById("registerPage");
    const showRegisterLinks = document.querySelectorAll("#showRegister");
    const showLogin = document.getElementById("showLogin");

    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get("page");

    if (page === "register") {
        loginPage?.classList.add("hidden");
        registerPage?.classList.remove("hidden");
    } else {
        registerPage?.classList.add("hidden");
        loginPage?.classList.remove("hidden");
    }

    if (loginPage && registerPage && showRegisterLinks.length > 0 && showLogin) {
        showRegisterLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                loginPage.classList.add("hidden");
                registerPage.classList.remove("hidden");
                history.replaceState(null, "", "?page=register");
            });
        });

        showLogin.addEventListener("click", function (event) {
            event.preventDefault();
            registerPage.classList.add("hidden");
            loginPage.classList.remove("hidden");
            history.replaceState(null, "", "?page=login");
        });
    } else {
        console.warn("⚠️ Salah satu elemen navigasi tidak ditemukan!");
    }

    // Navbar Fixed
    window.onscroll = function () {
        const header = document.querySelector('header');
        if (!header) return;

        if (window.pageYOffset > header.offsetTop) {
            header.classList.add('navbar-fixed');
        } else {
            header.classList.remove('navbar-fixed');
        }
    };

    // Hamburger Menu
    const hamburger = document.querySelector('#hamburger');
    const navMenu = document.querySelector('#nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('hamburger-active');
            navMenu.classList.toggle('hidden');
        });
    }

    // Responsive Navigation di Destination Section
    function updateNavDisplay() {
        const navLinks = document.querySelectorAll("#destination nav a");
        if (window.innerWidth < 640) {
            navLinks.forEach((link, index) => index !== 0 && link.classList.add("hidden"));
        } else if (window.innerWidth < 1024) {
            navLinks.forEach((link, index) => index > 1 ? link.classList.add("hidden") : link.classList.remove("hidden"));
        } else {
            navLinks.forEach(link => link.classList.remove("hidden"));
        }
    }

    window.addEventListener("resize", updateNavDisplay);
    updateNavDisplay();
});
