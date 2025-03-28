<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<body class="bg-gray-100">
    <!-- Sidebar Start -->
    <aside class="bg-white fixed top-0 left-0 h-full w-64 shadow-lg flex flex-col z-10">

        <!-- Sidebar Wrapper -->
        <div class="flex flex-col h-full">
            
            <!-- Logo -->
            <div class="p-7 border-b border-gray-200">
                <a href="#home" class="font-bold text-lg text-primary">TripMate</a>
            </div>

            <!-- Menu (Tetap di Atas) -->
            <div>
                <div class="p-7 space-y-3 border-b border-gray-200">
                    <a href="#dashboard" class="text-base text-dark hover:text-primary">Dashboard</a>
                </div>
                
                <!-- Menu Manage Places -->
                <div class="flex flex-col border-b border-gray-200 w-full">
                    <!-- Tombol utama -->
                    <button onclick="showMenu1()" class="p-7 text-left text-dark flex justify-between items-center w-full py-5">
                        <p class="text-base text-dark hover:text-primary">Manage Places</p>
                        <svg id="icon1" class="transform transition-transform duration-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="menu1" class="hidden flex-col w-full space-y-1 p-7 pt-0">
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Attractions</p>
                        </button>
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Culinaries</p>
                        </button>
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Hotels</p>
                        </button>
                    </div>
                </div>
                <!-- Menu Manage Places -->

                <!-- Menu Manage Transportation -->
                <div class="flex flex-col border-b border-gray-200 w-full">
                    <!-- Tombol utama -->
                    <button onclick="showMenu2()" class="p-7 text-left text-dark flex justify-between items-center w-full py-5">
                        <p class="text-base text-dark hover:text-primary">Manage Transportation</p>
                        <svg id="icon2" class="transform transition-transform duration-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="menu2" class="hidden flex-col w-full space-y-1 p-7 pt-0">
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Buses</p>
                        </button>
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Flights</p>
                        </button>
                        <button class="flex justify-start items-center text-gray-600 hover:text-primary focus:bg-gray-700 rounded px-3 py-2 w-full md:w-52">
                            <p class="text-base leading-4">Trains</p>
                        </button>
                    </div>
                </div>
                <!-- Menu Manage Transportation -->
                
                <!-- Menu Manage Packages -->
                <div class="flex flex-col border-b border-gray-200 w-full">
                    <!-- Tombol utama -->
                    <button onclick="showMenu1()" class="p-7 text-left text-dark flex justify-between items-center w-full py-5">
                        <p class="text-base text-dark hover:text-primary">Manage Packages</p>
                    </button>
                </div>

            </div>

            <!-- Logout Nempel di Bawah -->
            <div class="mt-auto p-7 border-t border-gray-200">
                <form method="POST" action="prosesLogout.php">
                    <button type="submit" name="logout" class="text-base text-dark hover:text-primary w-full">Logout</button>
                </form>
            </div>

        </div>

    </aside>

    <!-- Sidebar End -->
</body>
<script>
function showMenu1() {
    const menu = document.getElementById("menu1");
    const icon = document.getElementById("icon1");
    menu.classList.toggle("hidden");
    icon.classList.toggle("rotate-180");
}
</script>
<script>
    function showMenu2() {
    const menu = document.getElementById("menu2");
    const icon = document.getElementById("icon2");
    menu.classList.toggle("hidden");
    icon.classList.toggle("rotate-180");
}
</script>
</html>