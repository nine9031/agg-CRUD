<?php
include 'model/Address.php';
include 'model/Person.php';

// Database connection
$mysqli = new mysqli("localhost", "root", "", "persondb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch records
$result = $mysqli->query("SELECT * FROM persons");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Person List</title>
</head>
<body>
    <h1>Person List</h1>
    <a href="form.html">Add New Person</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <?php 
            $address = new Address($row['street'], $row['city'], $row['state'], $row['postalCode']);
            $person = new Person($row['name'], $row['age'], $address);
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $person->getName(); ?></td>
            <td><?php echo $person->getAge(); ?></td>
            <td><?php echo $person->getAddress(); ?></td>
            <td>
                <a href="form.html?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

