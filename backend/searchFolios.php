<?php 

	include_once '../includes/dbconnect.php';

	global $mysqli;

	/* retrieve the search term that autocomplete sends */
	$term = trim(strip_tags($_GET['search_text'])); 
	$a_json = array();
	$a_json_row = array();



    $query = "SELECT mscript_id, folio_id, res_ident "
            . "FROM folios "
            . "WHERE res_ident like '%" . $term . "%' ORDER BY mscript_id ASC " ;
    $result = $mysqli->query($query);

    if ($data = $mysqli->query($query)) {
		while($row = mysqli_fetch_array($data)) {
			$a_json_row["mscript_id"] = htmlentities(stripslashes($row['mscript_id']));
			$a_json_row["folio_id"] = htmlentities(stripslashes($row['folio_id']));
			$a_json_row["res_ident"] = htmlentities(stripslashes($row['res_ident']));
			array_push($a_json, $a_json_row);
		}
	}
	// return JSON data
	echo json_encode($a_json);
        	
?>