<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="{{ asset('css/styleshistory.css') }}">

</head>
<body>
    <div class="order-history-container">
        <h2>Order History</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="search-order" placeholder="Search by Order ID..." />
            <button id="search-btn">Search</button>
        </div>

        <!-- Order Table -->
        <table class="order-history-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody id="order-list">
                <!-- Example Order Row -->
                <tr>
                    <td>#12345</td>
                    <td>2024-12-01</td>
                    <td>Completed</td>
                    <td>$45.99</td>
                    <td><a href="#order-details" class="details-link">View Details</a></td>
                </tr>
                <tr>
                    <td>#12346</td>
                    <td>2024-12-02</td>
                    <td>Pending</td>
                    <td>$99.99</td>
                    <td><a href="#order-details" class="details-link">View Details</a></td>
                </tr>
                <!-- Add more rows here dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Simple search functionality
        document.getElementById('search-btn').addEventListener('click', function() {
            const searchQuery = document.getElementById('search-order').value.toLowerCase();
            const rows = document.querySelectorAll('#order-list tr');

            rows.forEach(row => {
                const orderId = row.cells[0].textContent.toLowerCase();
                if (orderId.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
