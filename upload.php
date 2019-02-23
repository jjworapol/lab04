<?php
      $product = array();
      $quantity = array();
      $price = array();
      $total = array();
      $totalPrice = 0;
      $max_value = 0;
      $max_index =0;
      $total_product =0;
      $file = fopen($_POST['filename'],"r");
      
      $i = 0;
      while(($row = fgetcsv($file,0,","))!== FALSE) //input data to array
        {
          if($i != 0 ){
            $product[] = $row[0];
            $quantity[] = $row[1];
            $price[] = $row[2];
            $total[] = $row[1]*$row[2];
            $totalPrice += $row[1]*$row[2];
          }
          $i++;
        }
      fclose($file);
      for ($j=0; $j < count($total)  ; $j++) { 
        $total_product += 1;
        if($max_value<$total[$j]){
            $max_value=$total[$j];
            $max_index=$j;
        }
        
        }
      ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> 
    <link rel="stylesheet" media="screen" href="style.css">
</head>
<body>
    <div class="jumbotron text-center">
    <h1>Result here</h1>
    </div>
    <div class = "container">
        
        <table class="table">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="datarow">
                    <?php
                        for($j=0 ; $j<$i-1 ; $j++){
                            echo"<tr>";
                            echo"<td> $product[$j]";
                            echo"<td> $quantity[$j]";
                            echo"<td> $price[$j]";
                            echo"<td> $total[$j]";
                            echo"</th></tr>";
                            }
                        ?>
                    </tbody>
        </table>
        <label> total product = <?php  echo $total_product?> </label>
                            <br>
    <label>total price = <?php echo $totalPrice ?> </label><br>
    <label>Product highest price is <?php echo $product[$max_index]?> and price = <?php echo $total[$max_index]?></label>
    </div>
    
</body>
</html>