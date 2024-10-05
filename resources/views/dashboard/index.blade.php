<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>

        <form method="POST" action="{{ route('logout') }}" class="mb-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </form>

        <h3 class="text-2xl font-semibold mb-4 text-gray-700">Employee List</h3>

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-300 text-gray-700">
                    <th class="py-3 px-4 border-b text-left">Name</th>
                    <th class="py-3 px-4 border-b text-left">Email</th>
                    <th class="py-3 px-4 border-b text-left">Creation Date</th>
                    <th class="py-3 px-4 border-b text-left">Photo</th>
                    <th class="py-3 px-4 border-b text-left">Edit</th>
                    <th class="py-3 px-4 border-b text-left">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="border-b hover:bg-gray-100 transition duration-200 ease-in-out">
                        <td class="py-2 px-4 text-gray-600 font-medium">{{ $employee->name }}</td>
                        <td class="py-2 px-4 text-gray-600">{{ $employee->email }}</td>
                        <td class="py-2 px-4 text-gray-600">{{ $employee->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 text-center">
                            @if($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" width="60" class="rounded-full border-2 border-gray-300 shadow-lg transform transition duration-500 hover:scale-110">
                            @endif
                        </td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('employees.edit', $employee->id) }}">
                                <button type="button" class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                            </a>
                        </td>
                        <td class="py-2 px-4 text-center">
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete?')" class="bg-red-500 text-white px-4 py-1 rounded-md hover:bg-red-600 transition duration-300 flex items-center">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('employees.create') }}">
                <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add New Employee
                </button>
            </a>
        </div>
    </div>

</body>
</html>
