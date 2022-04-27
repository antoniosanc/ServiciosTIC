<?
	include_once( "../configuration.php");
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Backup - Soluciones IM </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="./libs/bootstrap/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
	<?
		if( $_GET["q"] == "bk" || $_GET["g"] = md5(5) )
		{
			$params = array();
			$params["db_host"] = "127.0.0.1";
			$params["db_uname"] = $_POST["usuariodb"];
			$params["db_password"] = $_POST["passworddb"];
			$params["db_to_backup"] = $_POST["basedatos"];
			
			backup_database_mysql( $params );
		}

		function backup_database_mysql( $params )
		{
			$mtables = array(); $contents = "-- Database: `".$params['db_to_backup']."` --\n";
		   
			$mysqli = new mysqli($params['db_host'], $params['db_uname'], $params['db_password'], $params['db_to_backup']);
			if ($mysqli->connect_error) {
				die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
			}
		   
			$results = $mysqli->query("SHOW TABLES");
		   
			while($row = $results->fetch_array()){
				if (!in_array($row[0], $params['db_exclude_tables'])){
					$mtables[] = $row[0];
				}
			}

			foreach($mtables as $table){
				$contents .= "-- Table `".$table."` --\n";
			   
				$results = $mysqli->query("SHOW CREATE TABLE ".$table);
				while($row = $results->fetch_array()){
					$contents .= $row[1].";\n\n";
				}

				$results = $mysqli->query("SELECT * FROM ".$table);
				$row_count = $results->num_rows;
				$fields = $results->fetch_fields();
				$fields_count = count($fields);
			   
				$insert_head = "INSERT INTO `".$table."` (";
				for($i=0; $i < $fields_count; $i++){
					$insert_head  .= "`".$fields[$i]->name."`";
						if($i < $fields_count-1){
								$insert_head  .= ', ';
							}
				}
				$insert_head .=  ")";
				$insert_head .= " VALUES\n";       
					   
				if($row_count>0){
					$r = 0;
					while($row = $results->fetch_array()){
						if(($r % 400)  == 0){
							$contents .= $insert_head;
						}
						$contents .= "(";
						for($i=0; $i < $fields_count; $i++){
							$row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));
						   
							switch($fields[$i]->type){
								case 8: case 3:
									$contents .=  $row_content;
									break;
								default:
									$contents .= "'". $row_content ."'";
							}
							if($i < $fields_count-1){
									$contents  .= ', ';
								}
						}
						if(($r+1) == $row_count || ($r % 400) == 399){
							$contents .= ");\n\n";
						}else{
							$contents .= "),\n";
						}
						$r++;
					}
				}
			}
		   
			if (!is_dir ( $params['db_backup_path'] )) {
					mkdir ( $params['db_backup_path'], 0777, true );
			 }
		   
			$backup_file_name = "cms-backup-".date( "d-m-Y--h-i-s").".sql";
				 
			$fp = fopen($backup_file_name ,'w+');
			if (($result = fwrite($fp, $contents))) {
				echo correcto("<strong>Copia de seguridad creada exitosamente</strong>: <a href='$backup_file_name'>Descarga ahora</a>");
			}
			fclose($fp);
		}

		?>
	</body>
</html>