<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripMate</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <!-- Header Section Start -->
    <header class="bg-white absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo dan Menu -->
   
            <div class="px-4 flex items-center space-x-8">
                <a href="#home" class="font-bold text-lg text-primary py-6">TripMate</a>
                <nav class="hidden lg:flex space-x-8">
                    <a href="#home" class="text-base text-dark hover:text-primary">Home</a>
                    <a href="destination.php" class="text-base text-dark hover:text-primary">Destination</a>
                    <a href="#planning" class="text-base text-dark hover:text-primary">Planning</a>
                </nav>
            </div>

            <!-- Tombol Sign In & Register (Hanya di Desktop) -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="login.php?page=login" class="text-base text-dark hover:text-primary">Sign In</a>
                <a href="login.php?page=register" class="text-base text-dark py-2 mx-8 lg:mx-4 lg:px-4 lg:py-2 lg:border lg:border-primary lg:rounded-full lg:hover:bg-primary lg:hover:text-white lg:transition lg:duration-300">Create Account</a>
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
                <li><a href="#home" class="text-base text-dark hover:text-primary block">Home</a></li>
                <li><a href="destination.php" class="text-base text-dark hover:text-primary block">Destination</a></li>
                <li><a href="#planning" class="text-base text-dark hover:text-primary block">Planning</a></li>
                <li><a href="login.php" class="text-base text-dark hover:text-primary block">Sign In</a></li>
                <li><a href="login.php?page=register" class="text-base text-dark hover:text-primary block">Create Account</a></li>
            </ul>
        </nav>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Start -->
    <section id="home" class="pt-20">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class="text-balance font-semibold text-dark md:text-sl lg:text-xl">Welcome to <span class="block font-bold text-primary text-4xl lg:text-5xl mb-2">TripMate!🌴🚗</span></h1>
                    <h2 class="font-medium text-secondary text-lg mb-8 lg:text-xl">Your Trip <span class="text-slate-700 font-style: italic">Soulmate</span></h2>
                    <p class="font-medium text-secondary mb-10 leading-relaxed">New Places Await, Just Tap TripMate!</p>

                    <a href="#" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Mulai Planning Trip!</a>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="relative mt-10 lg:mt-0 lg:right-0">
                        <img src="img/foto tourguide nunjuk.png" alt="Tour Guide" class="max-w-full mx-auto"/>
                        <span class="absolute -bottom-0 -z-10 translate-x-6 md:scale-125"> 
                            <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#dc2626" d="M35.1,-49.7C49.8,-45.3,68.7,-42.7,79.5,-32.4C90.3,-22.1,93,-4.2,90.7,13.2C88.4,30.5,81.1,47.3,67.1,51.3C53,55.3,32,46.6,15.9,49C-0.3,51.4,-11.7,64.9,-22.2,66.1C-32.7,67.3,-42.3,56.1,-53.4,45.2C-64.4,34.3,-77,23.6,-81.8,9.9C-86.7,-3.7,-83.8,-20.4,-75.4,-32.6C-66.9,-44.8,-52.9,-52.6,-39.4,-57.5C-25.9,-62.4,-12.9,-64.3,-1.3,-62.3C10.3,-60.2,20.5,-54.1,35.1,-49.7Z" transform="translate(100 100)" />
                              </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="pt-26 pb-32">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full px-4 mb-10">
                    <h4 class="font-bold uppercase text-primary text-lg mb-3">Tentang TripMate</h4>
                    <h2 class="font-bold text-dark text-3xl mb-5 max-w-xl">Yuk, kenalan sama TripMate!</h2>
                    <p class="font-medium text-base text-secondary">
                        TripMate adalah platform perjalanan yang memudahkan perencanaan, pemesanan, dan eksplorasi destinasi dengan cara yang praktis dan aman. Dengan fitur cerdas dan rekomendasi personal, TripMate membantu pengguna menemukan akomodasi, transportasi, dan aktivitas terbaik, menjadikan setiap perjalanan lebih lancar dan berkesan.
                    </p>
                </div>
                <!-- <div class="w-full px-4">
                    <h3 class="font-bold text-dark text-3xl mb-3">Temukan TripMate</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae in eaque, molestiae consectetur placeat recusandae laborum.</p>
                </div> -->
            </div>
        </div>
     </section>
    <!-- About Section End -->

    <!-- Chart Section Start -->
    <section id="chart" class="pt-26 pb-32">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full px-4 mb-10">
                    <h2 class="font-bold text-dark text-3xl mb-5 max-w-xl">Destinasi Terfavorit TripMate</h2>
                    <div style="width: 250px; height: 250px; display: flex; justify-content: center; align-items: center; margin: auto;">
                    <canvas id="myChart"></canvas>
                    </div>

                    <?php
                        include 'koneksi.php'; // Pastikan ada file koneksi ke database

                        function getJumlahDestinasi($conn, $destination_city) {
                            $query = mysqli_query($conn, "SELECT * FROM tb_Itinerary WHERE LOWER(destination_city) = LOWER('$destination_city')");
                            return mysqli_num_rows($query);
                        }

                        // Mengambil jumlah data dari database
                        $jumlah_surabaya = getJumlahDestinasi($conn, "Surabaya");
                        $jumlah_jakarta = getJumlahDestinasi($conn, "Jakarta");
                        $jumlah_bandung = getJumlahDestinasi($conn, "Bandung");
                        $jumlah_yogyakarta = getJumlahDestinasi($conn, "Yogyakarta");
                        
                        ?>

                        <script>
                        var ctx = document.getElementById("myChart").getContext('2d');

                        var myChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ["Surabaya", "Jakarta", "Bandung", "Yogyakarta"],
                                datasets: [{
                                    label: 'Destinasi Favorit',
                                    data: [
                                        <?php echo $jumlah_surabaya; ?>,
                                        <?php echo $jumlah_jakarta; ?>,
                                        <?php echo $jumlah_bandung; ?>,
                                        <?php echo $jumlah_yogyakarta; ?>
                                    ],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.7)',
                                        'rgba(54, 162, 235, 0.7)',
                                        'rgba(255, 206, 86, 0.7)',
                                        'rgba(75, 192, 192, 0.7)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            }
                        });
                        </script>

                </div>
            </div>
        </div>
    </section>
    <!-- Chart Section Start -->
     
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
