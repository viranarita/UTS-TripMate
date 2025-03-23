

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripMate</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    
    <!-- Header Section Start -->
    <header class="bg-white fixed top-0 left-0 w-full flex items-center z-10 h-20">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo dan Menu -->
            <div class="px-4 flex items-center space-x-8">
                <a href="#home" class="font-bold text-lg text-primary py-6">TripMate</a>
                <nav class="hidden lg:flex space-x-8">
                    <a href="index.php" class="text-base text-dark hover:text-primary">Home</a>
                    <a href="#destination" class="text-base text-dark hover:text-primary">Destination</a>
                    <a href="#planning" class="text-base text-dark hover:text-primary">Planning</a>
                </nav>
            </div>

            <!-- Tombol Sign In & Register (Hanya di Desktop) -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="#signin" class="text-base text-dark hover:text-primary">Sign In</a>
                <a href="#signup" class="text-base text-dark py-2 mx-8 lg:mx-4 lg:px-4 lg:py-2 lg:border lg:border-primary lg:rounded-full lg:hover:bg-primary lg:hover:text-white lg:transition lg:duration-300">Create Account</a>
            </div>

            <!-- Tombol Hamburger (Hanya di Mobile) -->
            <button id="hamburger" class="lg:hidden">
                <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                <span class="hamburger-line transition duration-300 ease-in-out"></span>
                <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <nav id="nav-menu" class="hidden absolute bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:hidden">
            <ul class="block text-left space-y-4 p-5">
                <li><a href="index.php" class="text-base text-dark hover:text-primary block">Home</a></li>
                <li><a href="#destination" class="text-base text-dark hover:text-primary block">Destination</a></li>
                <li><a href="#planning" class="text-base text-dark hover:text-primary block">Planning</a></li>
                <li><a href="#signin" class="text-base text-dark hover:text-primary block">Sign In</a></li>
                <li><a href="#signup" class="text-base text-dark hover:text-primary block">Create Account</a></li>
            </ul>
        </nav>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Start-->
    <section id="destination" class="relative w-screen h-[400px] pt-20">
        <div class="absolute inset-0 w-full h-full">
            <img src="img/destination2.jpg" alt="Hero Image" class="w-full h-full object-cover">
        </div>
        <div class="absolute left-0 right-0 bottom-0 top-20 flex items-center justify-center z-10 bg-black bg-opacity-10">
            <div class="container">
                <h1 class="font-semibold text-white text-2xl md:text-3xl lg:text-4xl -mt-28">
                    Mau berlibur kemana?
                </h1>
                <form id="searchbar" class="mt-4">
                    <div class="flex">
                        <input type="search-desti" id="search-desti" class="w-full px-4 py-2 border rounded-l-lg bg-white focus:ring-primary focus:border-primary shadow" placeholder="Search for places" required>
                        <button class="bg-primary text-white px-12 text-lg font-semibold py-2 rounded-r-lg">Search</button>
                    </div>
                </form>          
            </div>
        </div>
        <div class="z-20 absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full">
            <div class="container mx-auto px-4 h-16 flex items-center bg-white rounded-t-full border-b border-slate-300">
                <nav id="destination-nav" class="flex mx-auto space-x-32">
                    <a href="#hotel" id="nav-hotel" class="text-base text-dark hover:text-primary">Hotel</a>
                    <a href="#transport" id="nav-transport" class="text-base text-dark hover:text-primary">Transportation</a>
                    <a href="#trend-act" id="nav-trend" class="text-base text-dark hover:text-primary">Trending Activity</a>
                    <a href="#culinary" id="nav-culinary" class="text-base text-dark hover:text-primary">Culinary</a>
                    <a href="#package" id="nav-package" class="text-base text-dark hover:text-primary">Package</a>
                </nav>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Destination Section Start -->
    <div class="relative z-20 flex justify-center w-screen lg:h-[300px] sm:min-h-screen bg-dark overflow-auto">
        <div class="container mx-auto px-4 flex flex-col items-start bg-white gap-5 lg:gap-10 p-7">
            <!-- Teks Sejajar dengan Kartu -->
            <div class="w-full px-4">
                <h2 class="font-bold text-dark text-2xl max-w-xl mt-5 lg:mt-0">Yuk, rasakan suasana baru!</h2>
            </div>
            <!-- Container Kartu -->
            <div class="flex flex-wrap justify-center gap-5 w-full">
                <!-- Card 1 -->
                <div class="rounded-2xl w-[200px] h-[250px] bg-gray-200 overflow-hidden drop-shadow flex flex-col">
                    <img src="img/hotel/hotel1.png" class="w-full h-1/2 object-cover rounded-b"/>
                    <div class="p-3 flex flex-col justify-between min-h-[80px]">
                        <h1 class="font-semibold text-black mb-2 text-center">Ubu Villa Pulowatu</h1>
                        <p class="text-sm text-center">Sleman, Yogyakarta</p>
                        <p class="text-xs text-center text-gray-600">⭐ 4.7 (120 reviews)</p>
                    </div>
                </div>
            
                <!-- Card 2 -->
                <div class="rounded-2xl w-[200px] h-[250px] bg-gray-200 overflow-hidden drop-shadow flex flex-col">
                    <img src="img/hotel/hotel2.png" class="w-full h-1/2 object-cover rounded-b"/>
                    <div class="p-3 flex flex-col justify-between min-h-[80px]">
                        <h1 class="font-semibold text-black mb-2 text-center">Garrya Bianti</h1>
                        <p class="text-sm text-center">Yogyakarta</p>
                        <p class="text-xs text-center text-gray-600">⭐ 4.8 (98 reviews)</p>
                    </div>
                </div>
            
                <!-- Card 3 -->
                <div class="rounded-2xl w-[200px] h-[250px] bg-gray-200 overflow-hidden drop-shadow flex flex-col">
                    <img src="img/hotel/hotel3.png" class="w-full h-1/2 object-cover rounded-b"/>
                    <div class="p-3 flex flex-col justify-between min-h-[80px]">
                        <h1 class="font-semibold text-black mb-2 text-center">The Rinra Hotel</h1>
                        <p class="text-sm text-center">Makassar, Sulawesi Selatan</p>
                        <p class="text-xs text-center text-gray-600">⭐ 4.6 (85 reviews)</p>
                    </div>
                </div>
            
                <!-- Card 4 -->
                <div class="rounded-2xl w-[200px] h-[250px] bg-gray-200 overflow-hidden drop-shadow flex flex-col">
                    <img src="img/hotel/hotel4.png" class="w-full h-1/2 object-cover rounded-b"/>
                    <div class="p-3 flex flex-col justify-between min-h-[80px]">
                        <h1 class="font-semibold text-black mb-2 text-center">Glamp Nusa</h1>
                        <p class="text-sm text-center">Nusa Penida, Bali</p>
                        <p class="text-xs text-center text-gray-600">⭐ 4.9 (150 reviews)</p>
                    </div>
                </div>
            
                <!-- Card 5 -->
                <div class="rounded-2xl w-[200px] h-[250px] bg-gray-200 overflow-hidden drop-shadow flex flex-col">
                    <img src="img/hotel/hotel5.png" class="w-full h-1/2 object-cover rounded-b"/>
                    <div class="p-3 flex flex-col justify-between min-h-[80px]">
                        <h1 class="font-semibold text-black mb-2 text-center">Alila Villas Uluwatu</h1>
                        <p class="text-sm text-center">Uluwatu, Bali</p>
                        <p class="text-xs text-center text-gray-600">⭐ 4.8 (110 reviews)</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

    <!-- Destination Section End -->


    <!-- Footer Start -->
    <footer class="bg-dark pt-24 pb-12">
        <div class="container">
            <div class="flex flex-wrap">
                <!-- Bagian Kiri -->
                <div class="w-full px-4 mb-12 md:w-1/2 flex flex-col justify-center items-center text-center">
                    <h2 class="font-bold text-6xl text-primary py-6">TripMate</h2>
                </div>
                <!-- Bagian Kanan -->
                <div class="w-full px-4 mb-12 text-slate-300 md:w-1/2 flex flex-col justify-center items-center text-center">
                    <h3 class="font-bold text-2xl mb-2">Contact Us</h3>
                    <p>TripMate@business.com</p>
                    <p>Jl. Ir. Soekarno No.127</p>
                    <p>Surabaya</p>
                </div>
            </div>
            <div class="w-full pt-10 border-t border-slate-700">
                <p class="font-medium text-sm text-slate-500 text-center">Copyright © 2025 <a class="font-bold text-primary">TripMate</a>. All rights reserved.</p>
            </div>
        </div>
        
    </footer>
    <!-- Footer End -->

    <script src="js/script.js"></script>

</body>
</html>
