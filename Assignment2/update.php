<?php
// Include employeeDAO file
require_once 'menuDAO.php';
require_once 'menu.php';


$menuDAO = new menuDAO();



// Check existence of id parameter before processing further
if (isset($_GET["id"])) {
    // Get URL parameter
    $id = trim($_GET["id"]);
    echo $id;
    $menu = $menuDAO->readMenu($id);

    if ($menu) {
        // Retrieve individual field value
        $name = $menu->getName();
        $description = $menu->getDescription();
        $date = $menu->getDate();
        $price = $menu->getPrice();
        $image = $menu->getImage();
    }

    if (isset($_POST['submit'])) {
        $image = $_FILES['Image']['name'];
        move_uploaded_file($_FILES["Image"]["tmp_name"], "images/" . $image);
        // Retrieve individual field value
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $image = "images/" . $image;
        $menu = new menu($id, $name, $description, $date, $price, $image);
        $menuDAO = new menuDAO();
        $menuDAO->updateMenu($menu);
        header("location: index.php");
    }
}
// close connection
$menuDAO->getMysqli()->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b>
                                <?php echo $name; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b>
                                <?php echo $description; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <p><b>
                                <?php echo $date; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <p><b>
                                <?php echo $price; ?>
                            </b></p>
                    </div>
                    <div>
                        <input type="file">
                        <p><b>
                                <?php echo $image; ?>
                            </b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the menu record.</p>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>

                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control">

                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div>
                            <input type="file" name="Image" id="image">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>