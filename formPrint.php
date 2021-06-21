<?php
$con = mysqli_connect('localhost', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
mysqli_select_db($con, 'c1642016c_syscrm_2');
?>
<html>

<head>
	<title>Invoice Generator</title>
</head>

<body>
	Selection le Prospect:
	<form method='get' action='impression db.php'>
		<select name='nompros'>
			<?php
			$query = mysqli_query($con, "select * from prospect");
			while ($prospect = mysqli_fetch_array($query)) {
				echo "<option value='" . $prospect['nompros'] . "'>" . $prospect['nompros'] . "</option>";
			}
			?>
		</select>
		<input type='submit' value='Imprimer'>
	</form>
</body>

</html>