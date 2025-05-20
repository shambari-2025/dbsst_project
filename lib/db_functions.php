<?php

	function connect(){
		$link = mysqli_connect(HOST, USER, PASS, DB_NAME) or die('Хатоги дар пайвастшави ба сервер.');
		mysqli_query($link, "SET NAMES 'UTF8'") or die('Хатоги дар гузоштани кодировка.');
		return $link;
	}
	
	function Result_To_Array($result){
		$res_array = array();
		$count = 0;
		
		while($row = mysqli_fetch_assoc($result)){
			$res_array[$count] = $row;
			$count++;
		}
		return $res_array;
	}
	
	/*====	Функсияи SELECT барои гирифтани маълумотхо		====*/
	function select($table, $fields, $where = "", $order = "", $up = true, $limit = ""){
		$field = '';
		if($fields != "*"){
			for ($i = 0; $i < count($fields); $i++) {
				if(($pos_1 = strpos($fields[$i], "(")) !== false){
					$pos_2 = strpos($fields[$i], ")");
					$field .= substr($fields[$i], 0, $pos_1)."(`".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."`),";
				}else{
					$field .= "`".$fields[$i]."`,";
				}
			}
			$field = substr($field, 0, -1);
		}else{
			$field = "*";
		}
		
		if($where) $where = " WHERE $where";
		if(!$order) $order = "ORDER BY `id`";
		
		if($order != "RAND()") {
			$order = "ORDER BY `$order`";
			if($up) $order .= " DESC";
		}else $order = "ORDER BY $order";
		
		if ($limit) $limit = "LIMIT $limit";
		
		$query = "SELECT $field FROM `$table` $where $order $limit";
		//echo "<br>";
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$result = Result_To_Array($res_query);
		mysqli_free_result($res_query); 
		mysqli_close($link);
		return $result;
	}
	/*====	Функсияи SELECT барои гирифтани маълумотхо		====*/
	
	
	/*====	Функсияи SELECT барои гирифтани маълумотхо		====*/
	function select2($table, $fields, $where = "", $order = "", $up = true, $limit = ""){
		$field = '';
		if($fields != "*"){
			for ($i = 0; $i < count($fields); $i++) {
				if(($pos_1 = strpos($fields[$i], "(")) !== false){
					$pos_2 = strpos($fields[$i], ")");
					$field .= substr($fields[$i], 0, $pos_1)."(`".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."`),";
				}else{
					$field .= "`".$fields[$i]."`,";
				}
			}
			$field = substr($field, 0, -1);
		}else{
			$field = "*";
		}
		
		if($where) $where = " WHERE $where";
		if(!$order) $order = "ORDER BY `id`";
		
		if($order != "RAND()") {
			$order = "ORDER BY `$order`";
			if($up) $order .= " DESC";
		}else $order = "ORDER BY $order";
		
		if ($limit) $limit = "LIMIT $limit";
		
		echo $query = "SELECT $field FROM `$table` $where $order $limit";
		echo "<br>";
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$result = Result_To_Array($res_query);
		mysqli_free_result($res_query); 
		mysqli_close($link);
		return $result;
	}
	
	/*====	Функсияи SELECT барои гирифтани маълумотхо		====*/
	
	function query($query) {
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$result = Result_To_Array($res_query);
		mysqli_free_result($res_query); 
		mysqli_close($link);
		return $result;
	}
	
	function query2($query) {
		echo $query."<br><br><br>";
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$result = Result_To_Array($res_query);
		mysqli_free_result($res_query); 
		mysqli_close($link);
		return $result;
	}
	
	/*====	Функсияи INSERT барои сабт кардани маълумотхо	====*/
	function insert($table, $fields, $data, $print = false){
		for ($i = 0; $i < count($fields); $i++) {
			$fields[$i] = "`".$fields[$i]."`";
        }
		$fields = implode(",", $fields);
		
		$query = ("INSERT INTO `$table` ($fields) VALUES ($data)");
		if ($print) echo $query.'<br>';
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$res_query = mysqli_insert_id($link);
		mysqli_close($link);
		return $res_query;
	}
	/*====	Функсияи INSERT барои сабт кардани маълумотхо	====*/
	
	/*====	Дархостҳои ручной	====*/
	function insert_query($query) {
		$link = connect();
		$res_query = mysqli_query($link, $query);
		$res_query = mysqli_insert_id($link);
		mysqli_close($link);
		return $res_query;
	}
	/*====	Дархостҳои ручной	====*/
	
	
	/*====	Функсияи UPDATE барои сабти тагироти маълумотхо	====*/
	function update($table, $upd_fields, $where, $print = false){
		$query = "UPDATE `$table` SET ";
		
		foreach ($upd_fields as $fields => $value) {
			if($value == 'NULL'){
				$query .= "`$fields` = $value,";
			}else{
				$query .= "`$fields` = '".addslashes($value)."',";
			}
		}
        $query = substr($query, 0, -1);
        if($where)
			$query .= " WHERE $where";
		if ($print) echo $query.'<br>';
		$link = connect();
		$res_query = mysqli_query($link, $query);
		mysqli_close($link);
		return $res_query;
	}
	
	function update_query($query, $print = false) {
		if($print) echo $query.'<br>';
		$link = connect();
		$res_query = mysqli_query($link, $query);
		mysqli_close($link);
		return $res_query;
	}
	
	/*====	Функсияи UPDATE барои сабти тагироти маълумотхо	====*/
	
	
	/*====	Функсияи DELETE барои нест кардани маълумотхо	====*/
	function delete($table, $where, $print = false) {
		$query = "DELETE FROM `$table` WHERE $where";
		if($print) echo $query;
		$link = connect();
		$res_query = mysqli_query($link, $query);
		mysqli_close($link);
		
		if($res_query)
			return true;
		else
			return false;
	}
	/*====	Функсияи DELETE барои нест кардани маълумотхо	====*/
	
?>