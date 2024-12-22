<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Pickup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">Request Pickup</h3>
            </div>
            <div class="card-body">
                <form action="/pick-up" method="POST">
                    @csrf

                    <!-- Total Items -->
                    <div class="mb-4">
                        <label for="total_items" class="form-label fw-bold">Total Items:</label>
                        <input type="number" name="total_items" id="total_items" class="form-control" placeholder="Enter total items" required>
                    </div>

                    <!-- Pickup Items -->
                    <h5 class="fw-bold mb-3">Pickup Items</h5>
                    <div id="items-container" class="p-3 border rounded">
                        <div class="item mb-3">
                            <div class="mb-3">
                                <label for="items[0][name]" class="form-label">Name:</label>
                                <input type="text" name="items[0][name]" id="items[0][name]" class="form-control" placeholder="Enter item name" required>
                            </div>
                            <div class="mb-3">
                                <label for="items[0][quantity]" class="form-label">Quantity:</label>
                                <input type="number" name="items[0][quantity]" id="items[0][quantity]" class="form-control" placeholder="Enter quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="items[0][expiration_date]" class="form-label">Expiration Date:</label>
                                <input type="date" name="items[0][expiration_date]" id="items[0][expiration_date]" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Add Item Button -->
                    <button type="button" id="add-item" class="btn btn-secondary mt-3">Add Item</button>

                    <!-- Submit Button -->
                    <div class="text-center mt-4 bg-dark">
                        <button type="submit" class="btn btn-dark w-100">Submit Pickup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-item').addEventListener('click', function () {
            const container = document.getElementById('items-container');
            const itemCount = container.querySelectorAll('.item').length;
            const newItem = `
                <div class="item mb-3">
                    <div class="mb-3">
                        <label for="items[${itemCount}][name]" class="form-label">Name:</label>
                        <input type="text" name="items[${itemCount}][name]" id="items[${itemCount}][name]" class="form-control" placeholder="Enter item name" required>
                    </div>
                    <div class="mb-3">
                        <label for="items[${itemCount}][quantity]" class="form-label">Quantity:</label>
                        <input type="number" name="items[${itemCount}][quantity]" id="items[${itemCount}][quantity]" class="form-control" placeholder="Enter quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="items[${itemCount}][expiration_date]" class="form-label">Expiration Date:</label>
                        <input type="date" name="items[${itemCount}][expiration_date]" id="items[${itemCount}][expiration_date]" class="form-control" required>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        });
    </script>

    <style>
        body {
            background-color: #28242c;
        }

        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
        }

        .card-header {
           
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #items-container {
            background-color: #f8f9fa;
        }

        .bg-light{
            background-color:#28242c;
        }
    </style>
</body>
</html>