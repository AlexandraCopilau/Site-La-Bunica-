<?php
 include('server.php');
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SHOP</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="shopstyle.css">
</head>

<body>

<style>
body {
    font-size: 17px;
	background-color: #dadbd9;
}



</style>

<br><br><br>
<h1 style="text-align:center; font-family:courier; font-size:450%;margin-top:60px; margin-bottom: 5px; padding: 2px;"> Shop</h1>	
<br><br>
<?php   
 $connect = mysqli_connect("localhost", "root", "", "login");  

 $itName = array();
 $itQuant = array();
 $itPrice = array();
						
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id' =>$_GET["id"],  
                     'item_name' =>$_POST["hidden_name"],  
                     'item_price' =>$_POST["hidden_price"],  
                     'item_quantity' =>$_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="cos.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id' =>$_GET["id"],  
                'item_name' =>$_POST["hidden_name"],  
                'item_price' =>$_POST["hidden_price"],  
                'item_quantity'=>$_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="cos.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  
 
 
                <?php  
                $query = "SELECT * FROM martisoare ORDER BY id ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?> 
				
				
			
                <div class="col-md-4">  
                     <form method="post" action="cos.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:0.5px solid #c9c9c9; background-color:#dfdfdf; border-radius:2px; padding:8px;" align="center">  
						    <img src="<?php echo $row["imagine"]; ?>" height="200" width="150" >
                               <h4 class="text-info"><?php echo $row["nume"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["cod"]; ?></h4>  
							   <h4 class="text-danger"> <?php echo $row["pret"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["nume"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["pret"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Adauga" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
				
				
				
                <div style="clear:both"></div>  
                <br /> 
				<br><br>
                <h2 style="text-align:center; font-family:courier; font-size:350%;margin-top:60px; margin-bottom: 5px; padding: 2px;"> Detalii comanda</h2>  
				
				<br><br>
				
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="10%"> Nume</th>  
                               <th width="5%">Cantitate</th>  
                               <th width="5%">Pret</th>  
                               <th width="5%">Total</th>  
                               <th width="5%">Actiune</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
						 $total = 0;
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {
							 array_push($itName,$values["item_name"]);
							 array_push($itQuant, $values["item_quantity"]);
							 array_push($itPrice, $values["item_price"]);
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td><?php echo $values["item_price"]; ?></td>  
                               <td><?php echo number_format((float)$values["item_quantity"] *(float) $values["item_price"], 2); ?>lei</td>  
                               <td><a href="cos.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Sterge</span></a></td>  
                          </tr>  
					 <?php  
					 
							 $total = number_format((float)$total+ ((float)$values["item_quantity"] * (float)$values["item_price"])) ;
							 
                               }  
                          ?>  
                          <tr>  
                           <td colspan="3" align="right">Total</td>  
				    		 <td align="right"><?php echo number_format((float)$total, 2); 
						 ?></td>  
                               <td></td>  
                          </tr>  
					 <?php 
                          }  
                          ?>  
                     </table>  
                </div> 

			 <?php if(isset($_SESSION['username']))
				echo "<form method='POST' action='".saveItems($db,$itName, $itQuant, $itPrice)."'>
                    
					<button type='submit' name='save_item' >Trimite comanda</button>
					</form>"
			?>
                
		<br><br>
</body>

</html>
