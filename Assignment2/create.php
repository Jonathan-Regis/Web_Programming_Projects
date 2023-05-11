<?php
require_once('menuDAO.php');


$name = $description = $date = $price = $image = "";
$name_err = $description_err = $date_err = $price_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validates name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validates description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter an address";
    } else {
        $description = $input_description;
    }

    // Validate date
    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Please enter a date.";
    } elseif (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $input_date)) {
        $date_err = "Please enter a valid date in the format 'YYYY-MM-DD'.";
    } else {
        $date = $input_date;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price.";
    } elseif (!ctype_digit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }

    // Check input errors before inserting in databse
    if (empty($name_err) && empty($description_err) && empty($date_err) && empty($price_err)) {
        $image = $_FILES['Image']['name'];//images upload 
        move_uploaded_file($_FILES["Image"]["tmp_name"], "images/" . $image);
        $menuDAO = new menuDAO();
        $menu = new menu(0, $name, $description, $date, $price, $image);
        $addResult = $menuDAO->addMenu($menu);
        header("refresh:2; url=index.php");
        echo '<br><h6 style="text-align:center">' . $addResult . '</h6>';
        // Close connection
        $menuDAO->getMysqli()->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Create Record</title>
    <link rel="stylesheet" href=>
</head>

<body>
    <h2>Create Record</h2>
    <p>Please fill this form and submit to add employee record to the databse.</p>

    <form name="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="v" value="4osO3A70sAY">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" name="name"
                id="name" placeholder="Name" value="<?php echo $name; ?>">
            <span class="invalid-feedback">
                <?php echo $name_err; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control <?php echo (!empty($description_err)) ? 'is-invalid ' : ''; ?>"
                name="description" id="description" placeholder="description"><?php echo $description; ?></textarea>
            <span calss="invalid-feedback">
                <?php echo $description_err; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="pass">Date</label>
            <input type="text" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
                value="<?php echo $date; ?>" name="date" id="date" placeholder="YYYY-MM-DD">
            <span class="invalid-feedback">
                <?php echo $date_err; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" name="price"
                id="price" placeholder="price" value="<?php echo $price; ?>">
            <span class="invalid-feedback">
                <?php echo $price_err; ?>
            </span>
        </div>
        <div>
            <input type="file" name="Image" id="Image">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        <button type="reset" class="btn btn-danger mt-2">Reset</button>
        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
    </form>
    <? include 'footer.php'; ?>

</body>

</html>