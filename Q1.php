<?php
// PHP Backend for Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $gender = sanitize($_POST['gender']);
    $color = isset($_POST['colour']) ? $_POST['colour'] : '';
    $colors = isset($_POST['colors']) ? $_POST['colors'] : '';

    if (!empty($colors)) {
        echo '<p>Colors selected:</p>';
        echo '<ul>';
        foreach ($colors as $color) {
            echo '<li>'. $color. '</li>';
        }
        echo '</ul>';
    }else{
        echo("empty");
    }

    // Connect to MySQL database
    $conn = new mysqli('localhost', 'root', '', 'test');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare('INSERT INTO users (name, email, phone, address, gender ,color) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssss', $name, $email, $phone, $address, $gender, $color);

    // foreach ($colors as $color) {
    //     // $sql = "INSERT INTO MyGuests (color, car)
    //     // VALUES ('$color', '$car')";

    //     // if ($conn->query($sql) === TRUE) {
    //     //     echo "New record created successfully";
    //     // } else {
    //     //     echo "Error: " . $sql . "<br>" . $conn->error;
    //     // }
    // }

    // Execute the statement

    echo '<script type="text/javascript">';
    if ($stmt->execute()) {
        echo 'alert("New record created successfully");';
    } else {
        echo 'alert("Error :'.$stmt->error.'");';
    }
    echo '</script>';
    $stmt->close();
    $conn->close();
}

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<style>
    legend{
        text-align: center;
        font-size: 30px;
        padding-top: 10px;
        color: blue;
    }
    fieldset{
        
        margin-bottom: 25%;
        margin-left: 25%;
        margin-right: 25%;
        padding-top: 5%;
        padding-bottom: 5%;
        padding-left: 5%;
        padding-right: 5%;
    }
    input[type="text"]{
        height: 30px;
        width: 440px;
        margin-right: 20%;
    }
    label{
        text-align: left;
        font-size: 20px;
    }
    input[type="submit"]{
            text-align: center;
            align-items: center;
            height: 30px;
            width: 70px;
            margin-top: 20px;
    }
    body {
        font-family: Arial, sans-serif;
    }
</style>

<!-- HTML Form -->
<fieldset>
<form id="userForm" method="post" action="">
    <legend>Register</legend>
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <p id="namee"></p>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>
    <p id="emaile"></p>
    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone"><br>
    <p id="phonee"></p>
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address"><br>
    <p id="addresse"></p>
    
    <!-- Radio Input -->
    <p>Please select your gender:</p>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label><br>
    <input type="radio" id="other" name="gender" value="other">
    <label for="other">Other</label>
    <p id="gendere"></p>
    <!-- Dropdown Input -->
    <p>Please select your favorite color:</p>
    <select name="colour">
        <option value="red">Red</option>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
        <!-- Add more options as needed -->
    </select>
    <input type="checkbox" id="red" name="color[]" value="Red">
    <label for="red">Red</label><br>
    <input type="checkbox" id="blue" name="color[]" value="Blue">
    <label for="blue">Blue</label><br>
    <input type="checkbox" id="green" name="color[]" value="Green">
    <label for="green">Green</label><br>

    <br>
    <input type="submit" value="Submit">
</form>
</fieldset>
<script>
// JavaScript Form Validation
document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var radios = document.getElementsByName('gender');
    var formValid = false;

    // Validate Name
    if(!/^[a-zA-Z]+$/.test(name)) {
        document.getElementById("name").style.borderColor='red';
        document.getElementById("namee").innerHTML="Invalid name";
        document.getElementById("namee").style.color='red';
        return false;
    }

    // Validate Email
    if(!/^\S+@\S+\.\S+$/.test(email)) {
        document.getElementById("email").style.borderColor='red';
        document.getElementById("emaile").innerHTML="Invalid email";
        document.getElementById("emaile").style.color='red';
        return false;
    }

    // Validate Phone Number
    if(!/^\d{10}$/.test(phone)) {
        document.getElementById("phone").style.borderColor='red';
        document.getElementById("phonee").innerHTML="Invalid phone Number";
        document.getElementById("phonee").style.color='red';
        return false;
    }

    // Validate Address
    if(address === '') {
        document.getElementById("address").style.borderColor='red';
        document.getElementById("addresse").innerHTML="Invalid name";
        document.getElementById("addresse").style.color='red';
        return false;
    }
    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }
    if (!formValid){
        document.getElementById("gendere").innerHTML="Must select one!";
        document.getElementById("gendere").style.color='red';
        return formValid;
    }
    
    // If validation passes, allow form submission
    event.target.submit();
});
</script>

<!-- MySQL Database Setup
CREATE DATABASE IF NOT EXISTS database;
USE database;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(15),
    address VARCHAR(255)
);
-->
