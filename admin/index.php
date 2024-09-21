<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .dashboard {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div class="dashboard">
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>john_doe</td>
                    <td>john@example.com</td>
                    <td>
                        <a href="#">Edit</a> | <a href="#">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>jane_doe</td>
                    <td>jane@example.com</td>
                    <td>
                        <a href="#">Edit</a> | <a href="#">Delete</a>
                    </td>
                </tr>
                <!-- Add more users as needed -->
            </tbody>
        </table>

        <h2>Manage Parlors</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Parlor Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Glamour Beauty</td>
                    <td>New York</td>
                    <td>
                        <a href="#">Edit</a> | <a href="#">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Elegance Salon</td>
                    <td>Los Angeles</td>
                    <td>
                        <a href="#">Edit</a> | <a href="#">Delete</a>
                    </td>
                </tr>
                <!-- Add more parlors as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>
