<?php
//index.php

$error = '';
$name = '';
$email = '';


function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if($error == '')
 {
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>html to excel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> 
    <script src="jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" media="screen" href="style.css">
  
</head>
<body>
  <br />
  <div class="jumbotron text-center">
   <h1 align="center">Welcome to Calculate <br>total price in supermarket</h1>
  </div>
  <div class="container">
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <h3 align="center">Contact Info</h3>
     <br />
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
      <div class="form-group" align="center-left">
      <!-- <input type="download" name="downloadCSVFile" class="btn btn-info" value="Download CSV File" /> -->
      <a href="contact_data.csv" download>
        <p>
            <input type="button" value="Download File" class = "btn btn-info">
        </p>
            </a>
            <form action="upload.php" method="post" class = "btn btn-info">
          <!-- <input type="hidden" name ='name' value=<?php$_POST['name']?> > -->
          <input type="file" name="filename" id="filename"accept=".csv">
          <input type="submit" value="Upload File" name="upload" class = "btn btn-info">
        </form>
     </div>
     

    </form>
    
   </div>
    <div class = "form-group" align ="right ">
        
    </div>
  </div>
 </body>
</html>