<?php
// Include the database connection file
include('./connect.php');

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve form input values
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['file'];
    
    // Debugging: Print input values
    
    // Get the image file name
    $imagefilename = $image['name'];
   

    // Get the image file error status
    $imagefilenameerror = $image['error'];
   

    // Get the temporary file path
    $imagefiletemp = $image['tmp_name'];
    

    // Split the file name to get the file extension
    $filename_separate = explode('.', $imagefilename);
   
    // Get the file extension
    $file_extension = strtolower(end($filename_separate));
    

    // Allowed file extensions
    $extension=array('jpeg','jpg','png','gif','jfif');
    
    // Check if the file extension is allowed
    if(in_array($file_extension,$extension)){
        // Set the upload path
        $upload_image=$imagefilename;
        
        // Move the uploaded file to the destination path
        move_uploaded_file($imagefiletemp,$upload_image);

        // Insert the data into the database
        $sql="INSERT INTO `registration`(name, mobile, image) VALUES ('$username','$mobile','$upload_image')";

        // Execute the query
        $result = mysqli_query($con, $sql);
        
        // Check if the data was inserted successfully
        if($result){
            echo
                '<div class="alert alert-success" role="alert">
                    <strong> Success ,</strong>
                Data inserted successfully 
                </div>';
           

            // // Data to be converted to JSON
            // $data = array("message" => "Data inserted successfully");

            // // Convert the data to JSON format
            // $json_data = json_encode($data);

            // // Output the JSON data
            // echo $json_data;
        }
        else{
            die(mysqli_error($con));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    img {
        width: 200px;
    }
    </style>
</head>

<body>
    <h1 class="text-center my-4">User data</h1>
    <div class="container mt-5 d-flex justify-content-center">
        <table class="table table-bordered w-50">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Assuming $con is your database connection
                $sql = "SELECT * FROM `registration`";
                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];

                    echo '<tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$name.'</td>
                            <td><img src="'.$image.'" alt="User Image"/></td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>