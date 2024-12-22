<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Donations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto flex justify-center">
                <div class="flex space-x-6">
                    <a href="/admin/donation" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-lg">Donations</a>
                    <a href="/admin/event" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-lg">Events</a>
                </div>
            </div>
        </nav>

        <div class="container mx-auto p-6">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-indigo-600">Donations</h1>
                @if (session('success'))
                    <p class="text-green-500 mt-4">{{ session('success') }}</p>
                @endif
            </div>

            <!-- Donations List -->
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Donations List</h2>
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">User ID</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Total Items</th>
                            <th class="px-4 py-2">Item Name</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Expiration Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $donation->id }}</td>
                                <td class="px-4 py-2">{{ $donation->user_id }}</td>
                                <td class="px-4 py-2">{{ $donation->status }}</td>
                                <td class="px-4 py-2">{{ $donation->total_items }}</td>
                                <td class="px-4 py-2">{{ $donation->name }}</td>
                                <td class="px-4 py-2">{{ $donation->quantity }}</td>
                                <td class="px-4 py-2">{{ $donation->expiration_date }}</td>
                                <td class="px-4 py-2">
                                    <button onclick="showEventForm({{ $donation->id }})" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">Create Event</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Create Event Form -->
            <div id="event-form" class="mt-8 p-6 bg-white rounded-lg shadow-lg" style="display:none;">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Create Event</h2>
                <form action="{{ route('admin.create_event') }}" method="POST">
                    @csrf
                    <input type="hidden" name="donation_id" id="donation-id">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-md" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700">Date</label>
                        <input type="datetime-local" id="date" name="date" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="location" class="block text-gray-700">Location</label>
                        <input type="text" id="location" name="location" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" onclick="closeEventForm()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 focus:outline-none">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">Create Event</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show and Hide Event Form
            function showEventForm(donationId) {
                document.getElementById('donation-id').value = donationId;
                document.getElementById('event-form').style.display = 'block';
            }

            function closeEventForm() {
                document.getElementById('event-form').style.display = 'none';
            }
        </script>
    </div>
</body>
</html>