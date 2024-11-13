<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah KB/PPLI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label, select, input {
            display: block;
            margin-bottom: 10px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Tambah Pengguna (KB atau PPLI)</h2>
    <form action="admin_manage_users.php" method="POST">
        <label for="role">Pilih Peranan:</label>
        <select name="role" id="role" required>
            <option value="">--Pilih Peranan--</option>
            <option value="KB-TPP">KB-TPP</option>
            <option value="KB-CADDS">KB-CADDS</option>
            <option value="PPLI-TPP">PPLI-TPP</option>
            <option value="PPLI-CADDS">PPLI-CADDS</option>
        </select>

        <label for="username">Nama Pengguna:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Kata Laluan:</label>
        <input type="password" id="password" name="password" required>

        <label for="full_name">Nama Penuh:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Nombor Telefon:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="course">Kursus (TPP atau CADDS):</label>
        <select name="course" id="course" required>
            <option value="">--Pilih Kursus--</option>
            <option value="TPP">TPP</option>
            <option value="CADDS">CADDS</option>
        </select>

        <input type="submit" value="Tambah Pengguna">
    </form>
</body>
</html>
