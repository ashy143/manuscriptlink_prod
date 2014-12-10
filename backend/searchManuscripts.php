<?php 

	include_once '../includes/dbconnect.php';

	global $mysqli;

	/* retrieve the search term that autocomplete sends */
	$term = trim(strip_tags($_GET['search_text'])); 
	$a_json = array();
	$a_json_row = array();

	$table = 'manuscript';
	if(isset($_GET['unpublished'])){
		$table = 'manuscript_temp';
	}

    $query = "SELECT mscript_id, mlink_part "
            . "FROM ". $table 
            . " WHERE mlink_part like '%" . $term . "%' ORDER BY mlinknumber ASC " ;
    $result = $mysqli->query($query);

    if ($data = $mysqli->query($query)) {
		while($row = mysqli_fetch_array($data)) {
			$a_json_row["mscript_id"] = htmlentities(stripslashes($row['mscript_id']));
			$a_json_row["mlink_part"] = htmlentities(stripslashes($row['mlink_part']));
			array_push($a_json, $a_json_row);
		}
	}
	// return JSON data
	echo json_encode($a_json);
        	
?>