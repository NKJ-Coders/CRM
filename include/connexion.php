<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=c1642016c_syscrm_2;charset=utf8', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
	die("Error: " . $e->getMessage());
}

// insertion dans uns une table
function add($table, $param)
{
	$bdd = dbConnect();
	$sql = "INSERT INTO " . $table . "( ";

	for ($i = 0; $i < count($param); $i++) {

		$col = $param[$i]['col'];
		$sql .= $col;
		if ($i < count($param) - 1) $sql .= " , ";
	} //Fin For

	$sql .= ")VALUES(";

	for ($i = 0; $i < count($param); $i++) {


		$val = $param[$i]['val'];
		$sql .= "'" . $val . "'";
		if ($i < count($param) - 1) $sql .= " , ";
	} //Fin For

	$sql .= ")";

	$req = $bdd->prepare($sql);
	$req->execute();
	$lastId = $bdd->lastInsertId();
	return $lastId; // $lastId['id'] cette variable contient le dernier id<br>
	$req->closeCursor;
}

// update dans une table en fonction d'une table
function UpdateById($table, $id, $param)
{
	if (!empty($param) && is_array($param)) {
		$bdd = dbConnect();

		$sql = "UPDATE " . $table . " SET ";
		for ($i = 0; $i < count($param); $i++) {
			$val = $param[$i]['val'];
			$col = $param[$i]['col'];
			if ($i == 0) $sql .= $col . "='" . $val . "' ";
			if ($i != 0) $sql .= " ," . $col . "='" . $val . "' ";
		} //fin for

		$sql .= " WHERE id='$id'";

		$req = $bdd->prepare($sql);
		return $req->execute();
		$req->closeCursor;
	} else {
		return 0;
	}
}

function dbConnect()
{
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=c1642016c_syscrm_2', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $bdd;
	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
	}
}
