<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning | TripMate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <h1>halo</h1>
    <header class="bg-white absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="px-4 flex items-center space-x-8">
                <a href="index.php" class="font-bold text-lg text-primary py-6">TripMate</a>
                <nav class="hidden lg:flex space-x-8">
                    <a href="index.php" class="text-base text-dark hover:text-primary">Home</a>
                    <a href="destination.php" class="text-base text-dark hover:text-primary">Destination</a>
                    <a href="planning.php" class="text-base text-dark hover:text-primary">Planning</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Form Itinerary Start -->
    <div class="max-w-lg mx-auto mt-24 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Plan Your Trip</h2>
        <form action="prosesItinerary.php" method="POST">
            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Itinerary Name</span>
                <input name="list_name" type="text" class="w-full mt-1 p-3 border border-gray-300 rounded-lg" placeholder="Enter itinerary name" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Departure Date</span>
                <input id="departure_date" name="departure_date" type="date" class="w-full mt-1 p-3 border border-gray-300 rounded-lg" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Return Date</span>
                <input id="return_date" name="return_date" type="date" class="w-full mt-1 p-3 border border-gray-300 rounded-lg" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Trip Days</span>
                <input id="trip_days" type="text" class="w-full mt-1 p-3 border border-gray-300 rounded-lg bg-gray-100" readonly>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Departure City</span>
                <select name="departure_city" class="w-full mt-1 p-3 border border-gray-300 rounded-lg" required>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                </select>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700 font-medium">Destination City</span>
                <select name="destination_city" class="w-full mt-1 p-3 border border-gray-300 rounded-lg" required>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                </select>
            </label>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Submit</button>
            </div>
        </form>
    </div>
    <!-- Form Itinerary End -->

    <script>
        document.getElementById('departure_date').addEventListener('change', calculateDays);
        document.getElementById('return_date').addEventListener('change', calculateDays);

        function calculateDays() {
            const departure = new Date(document.getElementById('departure_date').value);
            const returnDate = new Date(document.getElementById('return_date').value);
            if (!isNaN(departure) && !isNaN(returnDate) && returnDate >= departure) {
                const diffDays = Math.ceil((returnDate - departure) / (1000 * 60 * 60 * 24));
                document.getElementById('trip_days').value = diffDays;
            } else {
                document.getElementById('trip_days').value = '';
            }
        }
    </script>
</body>
</html>
