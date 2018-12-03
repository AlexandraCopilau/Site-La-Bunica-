<?php



$con=mysqli_connect("localhost","root","","login");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM martisoare ORDER BY id DESC LIMIT 1");

echo "<table border='1'>
<tr>
<th>Client</th>
<th>Adresa</th>
<th>Telefon</th>
<th>Produs</th>

</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['client'] . "</td>";
echo "<td>" . $row['adresa'] . "</td>";
echo "<td>" . $row['telefon'] . "</td>";
echo "<td>" . $row['produs'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>