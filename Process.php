<?php
include 'model/Address.php';
include 'model/Person.php';

// Database connection
$mysqli = new mysqli("localhost", "root", "", "persondb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Create or update record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    $address = new Address($street, $city, $state, $postalCode);
    $person = new Person($name, $age, $address);

    if (empty($id)) {
        // Create new record
        $stmt = $mysqli->prepare("INSERT INTO persons (name, age, street, city, state, postalCode) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $person->getName(), $person->getAge(), $address->getStreet(), $address->getCity(), $address->getState(), $address->getPostalCode());
    } else {
        // Update existing record
        $stmt = $mysqli->prepare("UPDATE persons SET name=?, age=?, street=?, city=?, state=?, postalCode=? WHERE id=?");
        $stmt->bind_param("sissssi", $person->getName(), $person->getAge(), $address->getStreet(), $address->getCity(), $address->getState(), $address->getPostalCode(), $id);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}

// Delete record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $mysqli->prepare("DELETE FROM persons WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}
?>


