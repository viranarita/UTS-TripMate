document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ Script berhasil dimuat!");

    // FORM LOGIN
    document.addEventListener("DOMContentLoaded", function () {
        console.log("✅ Script login berhasil dimuat!");
    
        const loginForm = document.getElementById("loginForm");
    
        if (!loginForm) {
            console.error("❌ Form login tidak ditemukan!");
            return;
        }
    
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();
    
            const formData = new FormData(loginForm);
    
            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (!data.includes("Login gagal")) {
                    window.location.href = "dashboard.php"; // Arahkan ke dashboard jika sukses
                } else {
                    alert("Login gagal: " + data);
                }
            })
            .catch(error => {
                console.error("❌ Terjadi kesalahan:", error);
                alert("Terjadi kesalahan, coba lagi.");
            });
        });
    });    
    
  
    // FORM REGISTER
    document.addEventListener("DOMContentLoaded", function () {
        console.log("✅ Script berhasil dimuat!");
    
        const registerForm = document.getElementById("registerForm");
    
        if (!registerForm) {
            console.error("❌ Form register tidak ditemukan!");
            return;
        }
    
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah reload default
    
            const formData = new FormData(registerForm);
    
            console.log("📨 Mengirim data ke register.php...");
    
            fetch("register.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("✅ Server Response (Register):", data); // Debugging response
    
                if (data.trim() === "success") {
                    alert("Registrasi berhasil! Mengalihkan ke dashboard...");
                    window.location.href = "dashboard.php"; // Ke dashboard setelah daftar sukses
                } else {
                    alert("Registrasi gagal: " + data);
                }
            })
            .catch(error => {
                console.error("❌ Terjadi kesalahan:", error);
                alert("Terjadi kesalahan, coba lagi.");
            });
        });
    });
    
    

    // Toggle antara Login dan Register Page
    const loginPage = document.getElementById("loginPage");
    const registerPage = document.getElementById("registerPage");
    const showRegisterLinks = document.querySelectorAll("#showRegister");
    const showLogin = document.getElementById("showLogin");

    // Debugging: Pastikan elemen ditemukan
    console.log("🔍 loginPage:", loginPage);
    console.log("🔍 registerPage:", registerPage);

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
