<?php
require_once ('./operations.php'); // Assuming operations.php contains your inputFields function
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h3 class="text-center my-3">Registration</h3>
    <div class="container d-flex justify-content-center">
        <form action="display.php" method="POST" class="w-50" enctype="multipart/form-data">
            <?php inputFields("Username", "username", "", "text"); ?>
            <?php inputFields("Mobile", "mobile", "", "text"); ?>
            <?php inputFields("", "file", "", "file"); ?>
            <button class="btn btn-dark" type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>