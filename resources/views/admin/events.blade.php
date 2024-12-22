<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto flex justify-center items-center">
                <a href="/admin/donation" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-lg">Donations</a>
                <a href="/admin/event" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-lg ml-4">Events</a>
            </div>
        </nav>

        <div class="container mx-auto p-6">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-indigo-600">Events</h1>
                @if (session('success'))
                    <p class="text-green-500 mt-4">{{ session('success') }}</p>
                @endif
            </div>

            <!-- Event List -->
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Event List</h2>
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-2">Event ID</th>
                            <th class="px-4 py-2">Donation ID</th>
                            <th class="px-4 py-2">Admin</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Location</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $event->id }}</td>
                                <td class="px-4 py-2">{{ $event->donation_id }}</td>
                                <td class="px-4 py-2">{{ $event->admin->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">{{ $event->description }}</td>
                                <td class="px-4 py-2">{{ $event->date }}</td>
                                <td class="px-4 py-2">{{ $event->location }}</td>
                                <td class="px-4 py-2">
                                    <button onclick="showEditForm({{ json_encode(['id' => $event->id, 'title' => $event->title, 'description' => $event->description, 'date' => $event->date, 'location' => $event->location]) }})" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">Edit</button>
                                    <form action="{{ route('admin.delete_event', $event->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this event?');" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Edit Event Form -->
            <div id="edit-form" class="mt-8 p-6 bg-white rounded-lg shadow-lg" style="display:none;">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Event</h2>
                <form id="editEventForm" action="" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-4">
                        <label for="event-title" class="block text-gray-700">Title</label>
                        <input type="text" id="event-title" name="title" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="event-description" class="block text-gray-700">Description</label>
                        <textarea id="event-description" name="description" class="w-full px-4 py-2 border rounded-md" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="event-date" class="block text-gray-700">Date</label>
                        <input type="datetime-local" id="event-date" name="date" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="event-location" class="block text-gray-700">Location</label>
                        <input type="text" id="event-location" name="location" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="closeEditForm()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 focus:outline-none">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">Update Event</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show and Hide the Edit Form
            function showEditForm(event) {
                document.getElementById('edit-form').style.display = 'block';
                document.getElementById('event-title').value = event.title;
                document.getElementById('event-description').value = event.description;
                document.getElementById('event-date').value = event.date;
                document.getElementById('event-location').value = event.location;

                const formAction = '/admin/events/' + event.id;
                document.getElementById('editEventForm').action = formAction;
            }

            function closeEditForm() {
                document.getElementById('edit-form').style.display = 'none';
            }
        </script>
    </div>
</body>
</html>