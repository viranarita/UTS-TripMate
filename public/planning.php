<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning | TripMate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">

    <?php include "header.html"; ?>

    <!-- Form Itinerary Start -->
    <section id="form-itinerary" class="pt-20 pb-20">
        <div class="container mx-auto flex flex-wrap justify-center items-center min-h-screen">
            <div class="lg:w-1/2 w-full max-w-lg p-8 bg-white rounded-2xl shadow-xl">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Plan Your Trip</h2>
                <form action="prosesItinerary.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Itinerary Name</label>
                        <input name="list_name" type="text" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter itinerary name" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Departure Date</label>
                        <input id="departure_date" name="departure_date" type="date" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Return Date</label>
                        <input id="return_date" name="return_date" type="date" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Trip Days</label>
                        <input id="trip_days" type="text" class="w-full mt-2 p-3 border border-gray-300 rounded-lg bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Departure City</label>
                        <select name="departure_city" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium">Destination City</label>
                        <select name="destination_city" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg hover:shadow-lg transition font-semibold text-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
