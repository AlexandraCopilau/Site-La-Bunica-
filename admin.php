<?php
 include('server.php');

 if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$record = mysqli_query($db, "SELECT * FROM martisoare WHERE id=$id");

		$n = mysqli_fetch_array($record);
		$name = $n['nume'];
		$address = $n['cod'];
		$var2 = $n['pret'];
		$var3 = $n['imagine'];
	
}

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin</title>


</head>
<body>


<style>
body {
    font-size: 17px;
	font-family: 'Open Sans', sans-serif;
	background-color: #dadbd9;
}
table{
    width: 50%;
    margin: 15px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 15px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}

form {
    width: 25%;
    margin: 25px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 2.5px;
}

.input-group {
    margin: 5px 0px 5px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
	margin:auto;
	display: block;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #220f0f;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #b02323;
}
.msg {
    padding: 10px; 
    color: #3c763d; 
    width: 50%;
    text-align: center;
}
</style>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM martisoare"); ?>


	<br/><br/><br/>

	 <?php 
	    if(isset($_SESSION['username'])) {
			 if($_SESSION['username']== 'admin') { ?>

  <table>
	<thead>
		<tr>
						 	<th width="20%">Imagine</th>
    						  <th width="35%">Nume</th>  
                               <th width="10%">Cod</th>
                               <th width="5%">Pret</th>
							   <th width="5%"></th>  
							   <th width="5%"></th>
			
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><img src="<?php echo $row['imagine']; ?>" height="200" width="200" /></td>
			<td><?php echo $row['nume']; ?></td>
			<td><?php echo $row['cod']; ?></td>
			<td><?php echo $row['pret']; ?></td>
			<td>
				<a href="admin.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

	<form method="post" action="server.php" >
		<div class="input-group">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Nume</label>
			<input type="text" name="nume" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Cod</label>
			<input type="text" name="cod" value="<?php echo $address; ?>">
		</div>
		
		<div class="input-group">
			<label>Pret</label>
			<input type="text" name="pret" value="<?php echo $var2; ?>">
		</div>
		<div class="input-group">
			<label>Imagine</label>
			<input type="text" name="imagine" value="<?php echo $var3; ?>">
		</div>
		<div class="input-group">
		
		<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
		</div>
	</form>

	<?php 
			 } else echo "Must be admin to use this function";
			}
			else echo "Must be admin to use this function";
			?>

			
			
			<div>
	<button class="btn" type="submit" name="see" style="background: #556B2F; position: center; text-align: center;"  onclick="window.location.href='afisare.php'">See orders</button>
</div>
	
	<br><br>
</body>
</html>