
<body>
    <form method="post" action="">
        <input type="checkbox" id="option1" name="options[]" value="Option 1">
        <label for="option1">Option 1</label><br>
        <input type="checkbox" id="option2" name="options[]" value="Option 2">
        <label for="option2">Option 2</label><br>
        <input type="checkbox" id="option3" name="options[]" value="Option 3">
        <label for="option3">Option 3</label><br>
        <input type="checkbox" id="option4" name="options[]" value="Option 4">
        <label for="option4">Option 4</label><br>
        <input type="checkbox" id="option5" name="options[]" value="Option 5">
        <label for="option5">Option 5</label><br>
        <input type="submit" value="Submit">
    </form>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $options = $_POST['options']; // This is an array

    foreach ($options as $option) {
        echo htmlspecialchars($option) . '<br>';
    }
}
?>


