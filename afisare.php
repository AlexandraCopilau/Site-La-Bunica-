<?php



$con=mysqli_connect("localhost","root","","login");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM comenzi ");

echo "<table border='1'>
<tr>
<th>Client</th>
<th>Produs</th>
<th>Cantitate</th>
<th>Pret</th>

</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['c_client'] . "</td>";
echo "<td>" . $row['c_produs'] . "</td>";
echo "<td>" . $row['c_cant'] . "</td>";
echo "<td>" . $row['c_pret'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>