<?php
	
	function getDecan($id_faculty, $S_Y, $H_Y){
		$query = query("SELECT * FROM `faculties_settings` WHERE `id_faculty` = '$id_faculty' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		return $query[0]['id_decan'];
	}
	
	
	function docx2text($filename) {
		return getTextFromZippedXML($filename, "word/document.xml");
	}
	
	function getTextFromZippedXML($archiveFile, $contentFile) {
		// Создаёт "реинкарнацию" zip-архива...
		$zip = new ZipArchive;
		// И пытаемся открыть переданный zip-файл
		if ($zip->open($archiveFile)) {
			// В случае успеха ищем в архиве файл с данными
			if (($index = $zip->locateName($contentFile)) !== false) {
				// Если находим, то читаем его в строку
				$content = $zip->getFromIndex($index);
				// Закрываем zip-архив, он нам больше не нужен
				$zip->close();
				// После этого подгружаем все entity и по возможности include'ы других файлов
				// Проглатываем ошибки и предупреждения
				$xml = new DOMDocument();
				$xml->loadXML($content, LIBXML_NOENT | LIBXML_XINCLUDE 
				| LIBXML_NOERROR | LIBXML_NOWARNING);
				//$xml = @DOMDocument::loadXML();
				// После чего возвращаем данные без XML-тегов форматирования
				return strip_tags($xml->saveXML());
			}
			$zip->close();
		}
		// Если что-то пошло не так, возвращаем пустую строку
		return "";
	}
	
	
	function getErrors($text){
		//$text = preg_replace("/\s+/", " ", $text);
		$variants = array(1=>"A","B","C","D","E");
		$symbols = array(1=>".", ",",";");
		$arr_search = array("Њ","Ў","Ќ","Ї","Љ","Ѓ","њ","ў","ќ","ї","љ","ѓ");
		$arr_replace = array("Ҳ","Ӯ","Қ","Ӣ","Ҷ","Ғ","ҳ","ӯ","қ","ӣ","ҷ","ғ");
		$text = str_replace($arr_search, $arr_replace, $text);
		
		$arr_search = array('$А','$ А','$В','$ В','$С','$ С','$Е','$ Е','$Б','$ Б','$Г','$ Г',"\xC2\xA0", " ;", "@ ");
		$arr_replace = array('$A','$A','$B','$B','$C','$C','$E','$E','$B','$B','$D','$D', " ", ";", "@");
		$text = str_replace($arr_search, $arr_replace, $text);
		
		$arr_search = array ('$ A','$ B','$ C','$ D','$ E');
		$arr_replace = array('$A' , '$B', '$C', '$D', '$E');
		$text = str_replace($arr_search, $arr_replace, $text);
		
		
		$exp = preg_split("/@[0-9]+./iu", $text);
		
		// Муайян кардани варианти чавоби дуруст
		$r_q = explode("=", $exp[0]);
		$r_q = trim($r_q[1]);
		$j_d = substr($r_q, 0, strlen($r_q)-1);
		$v_j_d = array_search($j_d, $variants);
		// Муайян кардани варианти чавоби дуруст
		
		
		if(empty($v_j_d)){
			$_SESSION['r_q']['error'] = "<h4 class='alert_warning'>Дар тест калиди ҷавобҳо вуҷуд надорад!</h4>";
			redirect();
		}
		
		$new_text = '';
		$new_text .= "Дуруст = $j_d.";
		
		$res = 0;
		$allq = count($exp) - 1;
		
		
		for ($i = 1; $i < count($exp); $i++){
			$str = trim($exp[$i]);
			$first_s_q = mb_substr($str, 0, 1);
			if($first_s_q == "."){
				$str = mb_substr($str, 1, mb_strlen($str));
			}
			
			$second_str = preg_split("/\\$([A-E])\)/", $str);
			
			
			$new_text .= "@$i. $second_str[0]";
			if(count($second_str)-1 != 0){
				$res++;
			}
			for($j = 1; $j < count($second_str); $j++){
				
				$st = trim($second_str[$j]);
				$last_s = mb_substr($st, mb_strlen($st) - 1, mb_strlen($st));
				if(array_search($last_s, $symbols)){
					if($last_s != ";"){
						$st = mb_substr($st,0,-1);
						$st .= ";";
					}
				}else{
					$st .= ";";
				}
				$new_text .= '$'.chr(64+$j).') '.$st;
				
			}
			
		}
		
		if($res < $i-1){
			$_SESSION['count']['error'] .= "<h4 class='alert_warning'>Дар яке аз ҷавобҳо аломати $ нест!</h4>";
			redirect();
		}
		
		if(isset($_SESSION['q']['error'])){
			redirect();
			unlink($file);
		}else{
			return $new_text;
		}
	}
	
	function SaveQuestionAndAnswer($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_fan, $lang, $type, $text, $s_y, $h_y){
		
		$variants = array(1=>"A","B","C","D","E");
		$exp = preg_split("/@[0-9]+./iu", $text);
		
		// Муайян кардани варианти чавоби дуруст
		$r_q = explode("=", $exp[0]);
		$r_q = trim($r_q[1]);
		$j_d = substr($r_q, 0, strlen($r_q)-1);
		$v_j_d = array_search($j_d, $variants);
		// Муайян кардани варианти чавоби дуруст
		
		for ($i = 1; $i < count($exp); $i++){
			$str = trim($exp[$i]);
			
			$second_str = preg_split("/\\$([A-E])\)/", $str);
			$question = trim($second_str[0]);
			
			unset($data, $fields);
			$data['id_faculty'] = "'$id_faculty'";
			$data['id_s_l'] = "'$id_s_l'";
			$data['id_s_v'] = "'$id_s_v'";
			$data['id_course'] = "'$id_course'";
			$data['id_spec'] = "'$id_spec'";
			$data['id_fan'] = "'".clear_admin($id_fan)."'";
			$data['lang'] = "'$lang'";
			
			if(WEEK < 10)
				$data['rating'] = "'1'";
			else
				$data['rating'] = "'2'";
			
			$data['type'] = "'$type'";
			$data['text'] = "'".clear_admin($question)."'";
			$data['author'] = "'".$_SESSION['user']['id']."'";
			$data['s_y'] = "'".clear_admin($s_y)."'";
			$data['h_y'] = "'".clear_admin($h_y)."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			
			if($id = insert("questions", $fields, $data)){
				
				for($j = 1; $j < count($second_str); $j++){
					$new_str = substr($second_str[$j], 1, strlen($second_str[$j]));
					$new_str = trim($new_str);
					$st = trim($new_str);
					
					unset($data_j, $fields);
					
					$data_j['id_question'] = "'".$id."'";
					$data_j['position'] = "'1'";
					$data_j['text'] = "'".$new_str."'";
					
					if($j == $v_j_d)
						$data_j['right_answer'] = "'". 1 ."'";
					
					$fields = array_keys($data_j);
					$data_j = implode(", ", $data_j);
					insert("answers", $fields, $data_j);
				}
			}
		}
		
		return true;
	}
	
	function getMoneyShartnoma($id_student, $s_y){
		$query = query("SELECT SUM(`check_money`) as `money` FROM `rasidho` WHERE `type` = '2' AND `payed` = '1' AND `id_student` = '$id_student' AND `s_y` = '$s_y'");
		
		if(isset($query[0]['money'])){
			return $query[0]['money'];
		}else return '0';
	}
	
	function getMoneyShartnomaLitsey($id_student, $s_y){
		$query = query("SELECT SUM(`check_money`) as `money` FROM `rasidho` WHERE `type` = '20' AND `payed` = '1' AND `id_student` = '$id_student' AND `s_y` = '$s_y'");
		
		if(isset($query[0]['money'])){
			return $query[0]['money'];
		}else return '0';
	}
	
	function getLastOnlinePage($id_user){
		$query = query("SELECT * FROM `_datasonline` WHERE `id_user` = '$id_user' ORDER BY `id` DESC LIMIT 1");
		
		$arr['title'] = $query[0]['page_title'];
		$arr['url'] = $query[0]['url'];
		return $arr;
	}
	
	function getBalanceStudent($id_student, $S_Y, $H_Y){
		$balance  = query("SELECT `balance` FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `S_Y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($balance)){
			return $balance[0]['balance'];
		}else{
			return '';
		}
	}
	function getBalanceLitStudent($id_student, $S_Y, $H_Y){
		$balance  = query("SELECT `balance` FROM `student_litsey` WHERE `id_xonanda` = '$id_student' AND `S_Y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($balance)){
			return $balance[0]['balance'];
		}else{
			return '';
		}
	}
	
	
	function getContingent($status, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $s_y, $h_y) {
		if($status){
			$s = "`students`.`status` = '$status' AND";
		}else {
			$s = '';
		}
		
		/* Баровардани контингенти гурух */
		$students = query("
		SELECT 
			`students`.*,
			`student_mmt_information`.*,
			`davrho`.`short` as `davr_title`,
			`user_passports`.*,
			`countries`.`title` as `country_title`,
			`regions`.`name` as `region_title`,
			`districts`.`name` as `district_title`,
			`nations`.`title` as `nation_title`,
			
			`study_type`.`title` as `study_type_title`,
			`study_level`.`title` as `study_level_title`,
			`users`.*,
			COALESCE(`r`.`total_sum`, 0) AS `total_sum`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		LEFT JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` 
		LEFT JOIN `davrho` ON `davrho`.`id` = `student_mmt_information`.`davri_qabul_mmt` 
		
		LEFT JOIN `countries` ON `user_passports`.`id_country` = `countries`.`id`
		LEFT JOIN `regions` ON `user_passports`.`id_region` = `regions`.`id`
		LEFT JOIN `districts` ON `user_passports`.`id_district` = `districts`.`id`
		LEFT JOIN `nations` ON `user_passports`.`id_nation` = `nations`.`id`
		
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		
		LEFT JOIN 
		(
			SELECT 
				`id_student`, 
				SUM(`check_money`) AS `total_sum`
			FROM 
				`rasidho` 
			GROUP BY 
				`id_student`
		) r 
		ON r.`id_student` = `students`.`id_student`
		
		WHERE $s
		`students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `users`.`fullname_tj`");
		/* Баровардани контингенти гурух */
		
		return $students;
	}
	
	function getContingent2($status, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $s_y, $h_y) {
		if($status){
			$s = "`students`.`status` = '$status' AND";
		}else {
			$s = '';
		}
		
		/* Баровардани контингенти гурух */
		$students = query("
		SELECT 
			`students`.*,
			`student_mmt_information`.*,
			`davrho`.`short` as `davr_title`,
			`user_passports`.*,
			`countries`.`title` as `country_title`,
			`regions`.`name` as `region_title`,
			`districts`.`name` as `district_title`,
			`nations`.`title` as `nation_title`,
			
			`study_type`.`title` as `study_type_title`,
			`study_level`.`title` as `study_level_title`,
			`users`.*,
			COALESCE(`r`.`total_sum`, 0) AS `total_sum`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		LEFT JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` 
		LEFT JOIN `davrho` ON `davrho`.`id` = `student_mmt_information`.`davri_qabul_mmt` 
		
		LEFT JOIN `countries` ON `user_passports`.`id_country` = `countries`.`id`
		LEFT JOIN `regions` ON `user_passports`.`id_region` = `regions`.`id`
		LEFT JOIN `districts` ON `user_passports`.`id_district` = `districts`.`id`
		LEFT JOIN `nations` ON `user_passports`.`id_nation` = `nations`.`id`
		
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		
		LEFT JOIN 
		(
			SELECT 
				`id_student`, 
				SUM(`check_money`) AS `total_sum`
			FROM 
				`rasidho` 
			GROUP BY 
				`id_student`
		) r 
		ON r.`id_student` = `students`.`id_student`
		
		WHERE $s
		`students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `users`.`fullname_tj`");
		/* Баровардани контингенти гурух */
		
		return $students;
	}
	
	function getStudentCountry($student_id)
	{
		$title = query("SELECT `countries`.title FROM `user_passports` INNER JOIN `countries` ON `countries`.`id` = `user_passports`.`id_country` where user_passports.id_user='$student_id'");
		/* Баровардани контингенти гурух */
		
		return $title[0]['title'];
	}
	
	function getNation($id) {
		$query = select("nations", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getRegion($id) {
		$query = select("regions", "*", "`id` = '$id'", "id", true, "");
		if(!empty($query))
			return $query[0]['name'];
	}
	
	function graph(){
		$query = query("SELECT DISTINCT(`date`) FROM `_datasonline` ORDER BY `date` DESC  LIMIT 20");
		
		$array = [];
		$i = 0;
		foreach($query as $item){
			$date = $item['date'];
			$visitors = query("SELECT COUNT(DISTINCT(`id_user`)) as `visitors` FROM `_datasonline` WHERE `date` = '$date'");
			$views = query("SELECT SUM(`counter`) as `views` FROM `_datasonline` WHERE `date` = '$date'");
			
			$array[$i]['date'] = strval($date);
			$array[$i]['visitors'] = $visitors[0]['visitors'];
			$array[$i]['views'] = $views[0]['views'];
			
			$i++;
		}
		return $array;
	}
	
	function getSeenPages($id_user, $date){
		$query = query("SELECT SUM(`counter`) as `seen` FROM `_datasonline` WHERE `id_user` = '$id_user' AND `date` = '$date'");
		
		return $query[0]['seen'];
	}
	
	
	function redirect($http = false){
		if($http) $redirect = $http;
			else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : URL;
		
		header("Location: $redirect");
		exit;
	}
	/* ===Редирект=== */
	
	function clear_data($data){
		$data = trim(htmlspecialchars(stripcslashes($data)));
		return $data;
	}
	
	
	function countMavzu($id_fan, $S_Y, $H_Y){
		$query = query("SELECT COUNT(*) as `count` FROM `mavodho` WHERE `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		return $query[0]['count'];
	}
	
	function getWeek($id) {
		$query = select("weeks", "*", "`id`='$id'", "id", false, "");
		return $query[0]['title'];
	}
	
	function setUserOnlineData($id_user, $url, $page_title, $day = false){
		$table = "_datasonline";
		$ip = $_SERVER["REMOTE_ADDR"];
		
		if(!$day){
			$date = date("Y-m-d", time());
			$time = date("H:i:s", time());
		}else{
			$date = $day;
			$time = rand(8, 23).':'.rand(10, 59).':'.rand(10, 59);
		}
		
		$check = query("SELECT * FROM `$table` WHERE `id_user` = '$id_user' AND `page_title` = '$page_title' AND `url` = '$url' AND `ip` = '$ip' AND `date` = '$date'");
		if(empty($check)){
			$data['id_user'] = "'".$id_user."'";
			$data['url'] = "'".$url."'";
			$data['ip'] = "'".$ip."'";
			$data['page_title'] = "'".$page_title."'";
			$data['date'] = "'".$date."'";
			$data['first_time'] = "'".$time."'";
			$data['counter'] = "'1'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert($table, $fields, $data);
		}else{
			$query = update_query("UPDATE `$table` SET `last_time` = '$time', `counter` = `counter` + 1 WHERE `id_user` = '$id_user' AND `url` = '$url' AND `page_title` = '$page_title' AND `date` = '$date'");
		}
	}
	
	
	function getCountry($id) {
		$query = select("countries", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getVaziOilavi($id) {
		$query = select("vazi_oilavi", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getDepartament($id) {
		$query = select("departaments", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getDepartamentShort($id) {
		$query = select("departaments", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['short'];
	}
	
	function getDepartamentByIdFan($id_fan) {
		$query_fan = query("SELECT * FROM `fan_test` WHERE `id` = '$id_fan'");
		$id_dep = $query_fan[0]['id_departament'];
		
		$query = select("departaments", "*", "`id` = '$id_dep'", "id", true, "");
		return $query[0]['title'];
	}
	
	
	function getMudirDepartamentByIdFan($id_fan) {
		$query_fan = query("SELECT * FROM `fan_test` WHERE `id` = '$id_fan'");
		$id_dep = $query_fan[0]['id_departament'];
		
		$query = select("departaments", "*", "`id` = '$id_dep'", "id", true, "");
		$id = $query[0]['id_mudir'];
		
		
		$info = query("SELECT * FROM `users` WHERE `id` = '$id'");
		
		return $info;
	}
	
	
	

	
	function getDistrict($id) {
		$query = select("districts", "*", "`id` = '$id'", "id", true, "");
		if(!empty($query))
			return $query[0]['name'];
	}
	
	function clear_admin($var){
		$link = connect();
		$var = trim($var);
		$var = htmlspecialchars(stripcslashes($var));
		$var = mysqli_real_escape_string($link, $var);
		return $var;
	}

	function print_arr($array){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
	
	function getUserName($id){
		$query = select("users", "*", "`id` = '$id'", "id", false, "");
		if($query){
			return $query[0]['fullname_tj'];
		}else{
			$query = select("users_2", "*", "`id` = '$id'", "id", false, "");
			return $query[0]['fio'];		
		}
	}
	
	function getShortName($id){
		$query = select("users", "*", "`id` = '$id'", "id", false, "");
		$name = trim($query[0]['fullname_tj']);
		$name = preg_replace("/\s+/", " ", $name);
		$exp = explode(" ", $name);
		
		$new_name = $exp[0].' ';
		for($i = 1; $i < count($exp); $i++){
			$new_name .= mb_substr($exp[$i],0,1).'. ';
		}
		
		return trim($new_name);
	}
	
	function getDay($id) {
		if($id == 1)
			return "Душанбе";
		elseif($id == 2)
			return "Сешанбе";
		elseif($id == 3)
			return "Чоршанбе";
		elseif($id == 4)
			return "Панҷшанбе";
		elseif($id == 5)
			return "Ҷумъа";
		elseif($id == 6)
			return "Шанбе";
	}
	
	function getLessonsType($id){
		$l_type = query("SELECT * FROM `lessons_type` WHERE `id`='$id'");
		return $l_type[0]['title_tj'];
	}
	
	
	function ShortName($name){
		$exp = explode(" ", $name);
		
		$new_name = $exp[0].' ';
		for($i = 1; $i < count($exp); $i++){
			$new_name .= mb_substr($exp[$i],0,1).'. ';
		}
		
		return trim($new_name);
	}
	
	function getFaculty($id) {
		$query = select("faculties", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getFacultyShort($id) {
		$query = select("faculties", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['short_title'];
	}
	
	function getFan($id) {
		$query = select("fan", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title_tj'];
	}
	
	function getFanTest($id) {
		$query = select("fan_test", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title_tj'];
	}
	
	function getStudyView($id) {
		$query = select("study_view", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getImtForZamima($id_fan, $id_student){
		$query = query("SELECT `total_score`, `trimestr_score` FROM `results` 
							WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' ORDER BY `id` DESC
						");
		if($query){
			$res['total_score'] = $query[0]['total_score'];				
			$res['trimestr_score'] = $query[0]['trimestr_score'];				
		}else{
			$res['total_score'] = 0;				
			$res['trimestr_score'] = 0;
		}
		return $res;
	}
	
	function getKKForZamima($id_fan, $id_student){
		$query = query("SELECT `kori_kursi` FROM `results` 
							WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' ORDER BY `id` DESC
						");
		return $query[0]['kori_kursi'];
	}
	
	function getFanCreditsByNT($id_nt, $id_fan){
		$query = query("SELECT SUM(c_u) as `credits` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_fan` = '$id_fan'");
		return $query[0]['credits'];
	}
	
	function getCredits($id){
		$query = "SELECT SUM(c_u) as `sum` FROM `nt_content` WHERE `id_nt` = '$id'";
		$link = connect();
		$isset_f = mysqli_query($link, $query);
		$result = Result_To_Array($isset_f);
		if(!empty($result[0]['sum']))
			return $result[0]['sum'];
		else return 0;
	}
	
	function getCredit($id_fan, $id_nt, $h_y){
		$nt = select("nt_content", "*", "`id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `h_y` = '$h_y'", "id_fan", false, "");
		if(isset($nt[0]['c_u']))
			return $nt[0]['c_u'];
		else
			return '0';
	}
	
	function getCreditiFaol($id_nt, $semestr, $id_fan){
		$nt = select("nt_content", "*", "`id_nt` = '$id_nt' AND `semestr` = '$semestr' AND `id_fan` = '$id_fan'", "id_fan", false, "");
		if(isset($nt[0]['c_f_u']))
			return $nt[0]['c_f_u'];
		else
			return '0';
	}
	
	function getStudyLevel($id) {
		$query = select("study_level", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getStudyYear($id) {
		$query = select("study_years", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getHalfYear($h_y){
		if($h_y == 1) return " нимсолаи $h_y-ум";
		else return " нимсолаи $h_y-юм";
	}
	
	function getNTSOL($id) {
		$query = select("nt_list", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['soli_tasdiq'];
	}
	function getNT($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y){
		$id_nt = query("SELECT `id_nt` FROM `std_study_groups` 
							WHERE `id_faculty` = '$id_faculty'
								AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '$id_s_v'
								AND `id_course` = '$id_course'
								AND `id_spec` = '$id_spec'
								AND `id_group` = '$id_group'
								AND `s_y` = '$S_Y'
								AND `h_y` = '$H_Y'
					");
		return $id_nt[0]['id_nt'];
		
	}
	
	function getStudyType($id) {
		$query = select("study_type", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getCourse($id) {
		$query = select("course", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getCourse2($id) {
		$query = select("course", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['id'];
	}
	
	function getSpecialtyCode($id) {
		$query = select("specialties", "*", "`id` = '$id'", "id", true, "");
		
		if($query[0]['id_s_l'] == '2')
			return $query[0]['code'].' м 2-юм';
		else
			return $query[0]['code'];
	}
	
	function getSpecialtyCode2($id) {
		$query = select("specialties", "*", "`id` = '$id'", "id", true, "");
		
		return $query[0]['code'];
	}
	
	function getSpecialtyMoney($id) {
		$query = select("specialties", "*", "`id` = '$id'", "id", true, "");
		
		return $query[0]['money'];
	}
	
	function getSpecialtyTitle($id) {
		$query = select("specialties", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title_tj'];
	}
	
	
	function getKoriKursi($id_nt, $id_fan) {
		$query = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `k_k` IS NOT NULL");
		
		if(!empty($query))
			return true;
		else return false;
	}
	
	function getMyPersent($id_student, $S_Y){
		$query = query("SELECT `sh_persent` FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' ORDER BY `sh_persent` DESC");
		if(!empty($query))
			return $query[0]['sh_persent'];
		else return false;
	}
	
	
	function getGroup($id) {
		$query = select("groups", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
	}
	
	function getJins($jins) {
		if($jins == 1)
			return "Мард";
		else return "Зан";
	}
	
	function getGroup2($id){
		
		$query = select("groups", "*", "`id` = '$id'", "id", true, "");
		return $query[0]['title'];
		
		/*
		if($id == 1) return "А1";
		elseif($id == 2) return "А2";
		elseif($id == 3) return "А3";
		elseif($id == 4) return "Б1";
		elseif($id == 5) return "Б2";
		elseif($id == 6) return "Б3";
		*/
	}
	
	function getUserImg($id_user, $jins, $photo, $access_type = false){
		if($photo != ""){
			if($access_type){
				$file = $_SERVER['DOCUMENT_ROOT']."/userfiles/teachers/".$photo;
				$photo = "/userfiles/teachers/".$photo;
			}else{
				$file = $_SERVER['DOCUMENT_ROOT']."/userfiles/students/".$photo;
				$photo = "/userfiles/students/".$photo;
			}
			
			if(!file_exists($file)){
				if($jins == 1)
					$photo = URL."userfiles/man.png";
				else
					$photo = URL."userfiles/woman.png";
			}
		}
		else {
			if($jins == 1)
				$photo = URL."userfiles/man.png";
			else
				$photo = URL."userfiles/woman.png";
		}
		
		return $photo;
	}
	
	
	function getStudentResult($id_nt, $id_student, $id_course, $h_y){
		$fanlist = query("
		SELECT 
		`nt_content`.`id_fan`, `nt_content`.`k_k`, `nt_content`.`c_u`,
		`results`.`nf_1_score` as `r_1`, `results`.`nf_2_score` as `r_2`, `results`.`imt_score` as `imt_score`, `results`.`imt_add_date` as `imt_date`,
		`mamur_score`.`score` as `admin_score`,
		
		SUM(`results`.`nf_1_score` + `results`.`nf_2_score` + `mamur_score`.`score` + `results`.`imt_score`) as `allscore`
		
		FROM `nt_content`
		
		LEFT JOIN `results` ON `nt_content`.`id_fan` = `results`.`id_fan` AND `nt_content`.`id_course` = `results`.`id_course`
		AND `nt_content`.`h_y` = `results`.`h_y`
		AND `results`.`id_student` = '$id_student'
		
		LEFT JOIN `mamur_score` ON `mamur_score`.`s_y` = `results`.`s_y` AND `mamur_score`.`h_y` = `results`.`h_y` AND
		`mamur_score`.`id_course` = '$id_course' AND `mamur_score`.`id_student` = '$id_student'
		
		WHERE `id_nt` = '$id_nt' AND `nt_content`.`id_course` = '$id_course' AND `nt_content`.`h_y` = '$h_y'
		GROUP BY `nt_content`.`id`, `results`.`id`, `mamur_score`.`id`
		ORDER BY `results`.`s_y` DESC, `results`.`h_y`, `nt_content`.`id_fan`
		");
		
		return $fanlist;
	}
	
	function getDavriFaol($S_Y, $H_Y, $id_faculty = false, $id_course = false, $id_spec = false, $id_group = false){
		
		if(!empty($id_faculty)){
			$query = query("SELECT DISTINCT(`id_student`), `id_faculty`, `id_course`, `id_spec`, `id_group`, 
			MIN(`allscore`) as `min`, MAX(`allscore`) as `max` FROM `_pres_results` 
			WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' 
			AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'
			GROUP BY `id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`");
		}else{
			$query = query("SELECT DISTINCT(`id_student`), `id_faculty`, `id_course`, `id_spec`, `id_group`,
			MIN(`allscore`) as `min`, MAX(`allscore`) as `max` FROM `_pres_results` 
			WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y'
			GROUP BY `id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`");
		}
		
		
		if(empty($query)) return false;
		
		$res['5'] = $res['45'] = $res['4'] = $res['3'] = $res['345'] = $res['fx'] = $res['f'] = 0;
		foreach($query as $item){
			
			//echo $item['min']. ' '.$item['max'];
			
			if($item['min'] >= 90 && $item['max'] < 120){
				//echo "alo";
				$res['5']++;
				$res['students']['5'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['5'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['5'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['5'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
				
			}
			elseif($item['min'] >= 75 && $item['max'] < 90){
				//echo "xub";
				$res['4']++;
				$res['students']['4'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['4'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['4'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['4'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			
			elseif($item['min'] >= 75 && $item['max'] < 120){
				//echo "xub/alo";
				$res['45']++;
				$res['students']['45'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['45'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['45'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['45'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			
			elseif($item['min'] >= 50 && $item['max'] < 75){
				//echo "qanoatbaxsh";
				$res['3']++;
				$res['students']['3'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['3'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['3'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['3'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			elseif($item['min'] >= 50 && $item['max'] < 120){
				$res['345']++;
				$res['students']['345'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['345'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['345'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['345'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			elseif($item['min'] >= 45 && $item['min'] < 50){
				$res['fx']++;
			}
			elseif($item['min'] < 45){
				$res['f']++;
			}
		}
		
		//print_arr($res);
		//exit;
		return $res;
	}
	
	function getSuporid($id_faculty, $s_t, $id_s_l, $id_s_v){
		$students =  query("SELECT DISTINCT(`id_student`) FROM `results` WHERE `imt_score` IS NOT NULL AND `id_student` IN(
								SELECT `id_student` FROM `students` WHERE `status` = '1' AND `id_faculty` ='$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_s_t` = '$s_t' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."')
							AND `results`.`s_y` ='".S_Y."' AND `results`.`h_y` = '".H_Y."'
							");
		return count($students);
	}
	
	
	function MarkFan($id_nt, $id_faculty, $id_course, $id_spec, $id_group, $s_y, $h_y){
		
		
		$results = query("
		SELECT 
		`nt_content`.`id_fan`, `nt_content`.`k_k`, `nt_content`.`c_u`,
		`results`.`id_student`,
		`results`.`nf_1_score` as `r_1`, `results`.`nf_2_score` as `r_2`, `results`.`imt_score` as `imt_score`, 
		`results`.`imt_add_date` as `imt_date`,
		COALESCE(`mamur_score`.`score`, 0) as `admin_score`,
		
		SUM(`results`.`nf_1_score` + `results`.`nf_2_score` + `mamur_score`.`score` + `results`.`imt_score`) as `allscore`
		
		FROM `nt_content`
		
		LEFT JOIN `results` ON `nt_content`.`id_fan` = `results`.`id_fan` AND `nt_content`.`id_course` = `results`.`id_course`
		AND `nt_content`.`h_y` = `results`.`h_y`
		AND `results`.`id_faculty` = '$id_faculty' AND `results`.`id_course` = '$id_course' AND `results`.`id_spec` = '$id_spec' AND `results`.`id_group` = '$id_group'
		AND `results`.`s_y` = '$s_y' AND `results`.`h_y` = '$h_y'
		
		LEFT JOIN `mamur_score` ON `mamur_score`.`s_y` = `results`.`s_y` AND `mamur_score`.`h_y` = `results`.`h_y` AND
		`mamur_score`.`id_course` = '$id_course' AND `mamur_score`.`id_student` = `results`.`id_student`
		AND `mamur_score`.`s_y` = '$s_y' AND `mamur_score`.`h_y` = '$h_y'
		
		WHERE `id_nt` = '$id_nt' AND `nt_content`.`id_course` = '$id_course' AND `nt_content`.`h_y` = '$h_y'
		GROUP BY `nt_content`.`id`, `results`.`id`, `mamur_score`.`id`
		ORDER BY `results`.`id_student`, `results`.`s_y` DESC, `results`.`h_y`, `nt_content`.`id_fan`
		");
		
		$res = [];
		foreach($results as $item){
			if(!isset($res[$item['id_fan']]['A'])) $res[$item['id_fan']]['A'] = 0;
			if(!isset($res[$item['id_fan']]['A-'])) $res[$item['id_fan']]['A-'] = 0;
			if(!isset($res[$item['id_fan']]['B+'])) $res[$item['id_fan']]['B+'] = 0;
			if(!isset($res[$item['id_fan']]['B'])) $res[$item['id_fan']]['B'] = 0;
			if(!isset($res[$item['id_fan']]['B-'])) $res[$item['id_fan']]['B-'] = 0;
			if(!isset($res[$item['id_fan']]['C+'])) $res[$item['id_fan']]['C+'] = 0;
			if(!isset($res[$item['id_fan']]['C'])) $res[$item['id_fan']]['C'] = 0;
			if(!isset($res[$item['id_fan']]['C-'])) $res[$item['id_fan']]['C-'] = 0;
			if(!isset($res[$item['id_fan']]['D+'])) $res[$item['id_fan']]['D+'] = 0;
			if(!isset($res[$item['id_fan']]['D'])) $res[$item['id_fan']]['D'] = 0;
			if(!isset($res[$item['id_fan']]['Fx'])) $res[$item['id_fan']]['Fx'] = 0;
			if(!isset($res[$item['id_fan']]['F'])) $res[$item['id_fan']]['F'] = 0;
			
			
			if($item['allscore'] >= 95 && $item['allscore'] < 120){
				$res[$item['id_fan']]['A']++;
			}
			elseif($item['allscore'] >= 90 && $item['allscore'] < 95){
				$res[$item['id_fan']]['A-']++;
			}
			elseif($item['allscore'] >= 85 && $item['allscore'] < 90){
				$res[$item['id_fan']]['B+']++;
			}
			elseif($item['allscore'] >= 80 && $item['allscore'] < 85){
				$res[$item['id_fan']]['B']++;
			}
			elseif($item['allscore'] >= 75 && $item['allscore'] < 80){
				$res[$item['id_fan']]['B-']++;
			}
			elseif($item['allscore'] >= 70 && $item['allscore'] < 75){
				$res[$item['id_fan']]['C+']++;
			}
			elseif($item['allscore'] >= 65 && $item['allscore'] < 70){
				$res[$item['id_fan']]['C']++;
			}
			elseif($item['allscore'] >= 60 && $item['allscore'] < 65){
				$res[$item['id_fan']]['C-']++;
			}
			elseif($item['allscore'] >= 55 && $item['allscore'] < 60){
				$res[$item['id_fan']]['D+']++;
			}
			elseif($item['allscore'] >= 50 && $item['allscore'] < 55){
				$res[$item['id_fan']]['D']++;
			}
			elseif($item['allscore'] >= 45 && $item['allscore'] < 50){
				$res[$item['id_fan']]['Fx']++;
			}
			elseif($item['allscore'] >= 0 && $item['allscore'] < 45){
				$res[$item['id_fan']]['F']++;
			}
		}
		
		return $res;
	}
	
	
	function MakeXatmMenu(){
		$faculties = select("std_study_groups", array("DISTINCT(id_faculty)"), "`s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_faculty", false, "");
		
		$superarr = array();
		$i = 0;
		foreach($faculties as $faculty){
			$id_faculty = $faculty['id_faculty'];
			$superarr[$id_faculty]["id"] = $id_faculty;
			$superarr[$id_faculty]["title"] = getFaculty($id_faculty);
			$superarr[$id_faculty]["short"] = getFacultyShort($id_faculty);
			
			
			$views = select("std_study_groups", array("DISTINCT(id_s_v)"), 
			"`id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_s_v", false, "");
			
			foreach($views as $view){
				$view = $view['id_s_v'];
				
				$superarr[$id_faculty]["view"][$view]['id'] = $view;
				$superarr[$id_faculty]["view"][$view]['title'] = getStudyView($view);
				
				$Study_Years = query("SELECT DISTINCT `s_y` FROM `students`");
				
				foreach($Study_Years as $study_item){
					$s_y = $study_item['s_y'];
					$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['id'] = $s_y;
					$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['title'] = getStudyYear($s_y);
					
					$xatm_specs = query("SELECT DISTINCT `id_spec`, `id_group` FROM `students` 
					WHERE `id_faculty` = '$id_faculty' AND `id_s_v` = '$view' AND `id_course` = '4' AND
					`s_y` = '$s_y' AND `h_y` = '2' ORDER BY `id_spec`, `id_group`");
					
					foreach($xatm_specs as $xatm_item){
						$id_spec = $xatm_item['id_spec'];
						$id_group = $xatm_item['id_group'];
						
						$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['spec'][$id_spec]['group'][$id_group]['id'] = $id_spec;
						$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['spec'][$id_spec]['group'][$id_group]['code'] = getspecialtyCode($id_spec);
						$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['spec'][$id_spec]['group'][$id_group]['id_group'] = $id_group;
						$superarr[$id_faculty]["view"][$view]["s_y"][$s_y]['spec'][$id_spec]['group'][$id_group] = getspecialtyTitle($id_spec).' '.getGroup2($id_group);
					}
				}
			}
			
			
		}
		
		print_arr($superarr);
		exit;
	}
	
	function MakeMenu($commission = false){
		if(!isset($_SESSION['superarr']) || !isset($_SESSION['biometric'])){
			
			if(MY_URL == URL.'admin/'){
				$faculties = select("std_study_groups", array("DISTINCT(id_faculty)"), "`status` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_faculty", false, "");
			}else{
				if($commission[0]['id_faculties'] == 'ALL'){
					$where = "";
				}else {
					$where = "`id_faculty` IN ({$commission[0]['id_faculties']}) AND ";
				}
				$faculties = query("SELECT DISTINCT(`id_faculty`) FROM `std_study_groups` WHERE $where `status` = '1' AND`s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`");
			}
			
			$superarr = array();
			$i = 0;
			
			foreach($faculties as $faculty){
				
				$id_faculty = $faculty['id_faculty'];
				$superarr[$id_faculty]["id"] = $id_faculty;
				$superarr[$id_faculty]["title"] = getFaculty($id_faculty);
				$superarr[$id_faculty]["short"] = getFacultyShort($id_faculty);
				
				if(MY_URL == URL.'admin/'){
					$levels = query("SELECT DISTINCT(`id_s_l`) FROM `std_study_groups` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_l`");
				}else {
					if($commission[0]['id_s_l'] == 'ALL'){
						$where = "";
					}else {
						$where = "`id_s_l` IN ({$commission[0]['id_s_l']}) AND ";
					}
					$levels = query("SELECT DISTINCT(`id_s_l`) FROM `std_study_groups` WHERE $where `status` = '1' AND `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_l`");
				}
				
				foreach($levels as $level) {
					$level = $level['id_s_l'];
					
					$superarr[$id_faculty]["level"][$level]['id'] = $level;
					$superarr[$id_faculty]["level"][$level]['title'] = getStudyLevel($level);
					
					
					$views = select("std_study_groups", array("DISTINCT(id_s_v)"), 
					"`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_s_v", false, "");
					
					foreach($views as $view){
						$view = $view['id_s_v'];
						
						$courses = select("std_study_groups", array("DISTINCT(id_course)"), 
						"`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_course", false, "");
						
						$superarr[$id_faculty]["level"][$level]["view"][$view]['id'] = $view;
						$superarr[$id_faculty]["level"][$level]["view"][$view]['title'] = getStudyView($view);
						
						foreach($courses as $course){
							$id_course = $course['id_course'];
							$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['id'] = $id_course;
							$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['title'] = getCourse($id_course);
							
							
							if(MY_URL == URL.'admin/'){
								$specs = select("std_study_groups", array("DISTINCT(id_spec)"), 
								"`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_spec", false, "");
							
							}else{
								if($commission[0]['id_s_l'] == 'ALL'){
									$where = "";
								}else {
									$where = "`id_s_l` IN ({$commission[0]['id_s_l']}) AND ";
								}
								
								$specs = select("std_study_groups", array("DISTINCT(id_spec)"), 
								"$where `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_spec", false, "");
							}
							
							foreach($specs as $spec){
								$id_spec = $spec['id_spec'];
								
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['id'] = $id_spec;
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['code'] = getspecialtyCode($id_spec);
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['title'] = getspecialtyTitle($id_spec);
								
								$groups = query("SELECT * FROM `std_study_groups` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_group`");
								
								//print_arr($groups);
								
								foreach($groups as $group){
									$id_group = $group['id_group'];
									
									$nt = query("SELECT `id_nt`, `lang` FROM `std_study_groups` WHERE `status` = 1 AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
									
									$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'] = $id_group;
									$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['title'] = getGroup($id_group);
									$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['short'] = getGroup2($id_group);
									$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id_nt'] = $nt[0]['id_nt'];
									$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['lang'] = $nt[0]['lang'];
								}
							}
						}
						
					}
				}
				$i++;
			}
		}
		
		return $superarr;
	}
	
	
	
	function MakeMenuDecan($options = false){
		
		if(MY_URL == URL.'admin/'){
			$faculties = select("std_study_groups", array("DISTINCT(id_faculty)"), "`s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_faculty", false, "");
		}else{
			if($options[0]['id_faculty'] == 'ALL'){
				$where = "";
			}else {
				$where = "`id_faculty` IN ({$options[0]['id_faculty']}) AND ";
			}
			$faculties = query("SELECT DISTINCT(`id_faculty`) FROM `std_study_groups` WHERE $where `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`");
		}
		
		
		$superarr = array();
		$i = 0;
		
		foreach($faculties as $faculty){
			
			$id_faculty = $faculty['id_faculty'];
			$superarr[$id_faculty]["id"] = $id_faculty;
			$superarr[$id_faculty]["title"] = getFaculty($id_faculty);
			$superarr[$id_faculty]["short"] = getFacultyShort($id_faculty);
			
			//$levels = query("SELECT DISTINCT(`id_s_l`) FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_l`");
			
			if(MY_URL == URL.'admin/'){
				$levels = query("SELECT DISTINCT(`id_s_l`) FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_l`");
			}else {
				if($options[0]['id_s_l'] == 'ALL'){
					$where = "";
				}else {
					$where = "`id_s_l` IN ({$options[0]['id_s_l']}) AND ";
				}
				$levels = query("SELECT DISTINCT(`id_s_l`) FROM `std_study_groups` WHERE $where `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_l`");
			}
			
			
			foreach($levels as $level) {
				$level = $level['id_s_l'];
				
				$superarr[$id_faculty]["level"][$level]['id'] = $level;
				$superarr[$id_faculty]["level"][$level]['title'] = getStudyLevel($level);
				
				
				//$views = select("std_study_groups", array("DISTINCT(id_s_v)"), "`id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_s_v", false, "");
				
				if(MY_URL == URL.'admin/'){
					$views = query("SELECT DISTINCT(`id_s_v`) FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_v`");
				}else {
					if($options[0]['id_s_v'] == 'ALL'){
						$where = "";
					}else {
						$where = "`id_s_v` IN ({$options[0]['id_s_v']}) AND ";
					}
					$views = query("SELECT DISTINCT(`id_s_v`) FROM `std_study_groups` WHERE $where `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_v`");
				}
				
				foreach($views as $view){
					$view = $view['id_s_v'];
					
					$courses = select("std_study_groups", array("DISTINCT(id_course)"), 
					"`id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_course", false, "");
					
					$superarr[$id_faculty]["level"][$level]["view"][$view]['id'] = $view;
					$superarr[$id_faculty]["level"][$level]["view"][$view]['title'] = getStudyView($view);
					
					foreach($courses as $course){
						$id_course = $course['id_course'];
						$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['id'] = $id_course;
						$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['title'] = getCourse($id_course);
						
						
						//$specs = select("std_study_groups", array("DISTINCT(id_spec)"), "`id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_spec", false, "");
						
						if(MY_URL == URL.'admin/'){
							$specs = select("std_study_groups", array("DISTINCT(id_spec)"), 
							"`id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_spec", false, "");
						
						}else{
							if($options[0]['id_s_l'] == 'ALL'){
								$where = "";
							}else {
								$where = "`id_s_l` IN ({$options[0]['id_s_l']}) AND ";
							}
							
							$specs = select("std_study_groups", array("DISTINCT(id_spec)"), 
							"$where `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_spec", false, "");
						}
						
						
						foreach($specs as $spec){
							$id_spec = $spec['id_spec'];
							
							$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['id'] = $id_spec;
							$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['code'] = getspecialtyCode($id_spec);
							$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['title'] = getspecialtyTitle($id_spec);
							
							$groups = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
							
							
							foreach($groups as $group){
								$id_group = $group['id_group'];
								
								$nt = query("SELECT `id_nt`, `lang` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$level' AND `id_s_v` = '$view' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
								
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'] = $id_group;
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['title'] = getGroup($id_group);
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['short'] = getGroup2($id_group);
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id_nt'] = $nt[0]['id_nt'];
								$superarr[$id_faculty]["level"][$level]["view"][$view]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['lang'] = $nt[0]['lang'];
							}
						}
					}
					
				}
			}
			$i++;
		}
		
		return $superarr;
	}
	
	function makeBeauty($n){
		return number_format($n, 0, '.', ',');
	}
	
	
	function count_summa_where($table, $field, $where = false, $print = false){
		$link = connect();
		
		$query = "SELECT SUM(`$field`) FROM `$table`";
		if($where)
			$query .= " WHERE $where";
		
		if($print){
			echo $query;
		}
		$select = mysqli_query ($link, $query) or die ("Can't select result");
		$tmp = mysqli_fetch_row ($select);
		$result = $tmp[0];
		if($result) return $result;
		else return 0;
	}
	
	function count_table_where($table, $where = false, $print = false) {
		$link = connect();
		
		$query = "SELECT COUNT(*) FROM `$table`";
		if($where)
			$query .= " WHERE $where";
		if($print)
			echo $query.'<br>';
		
		$select = mysqli_query ($link, $query) or die ("Can't select result");
		$tmp = mysqli_fetch_row ($select);
		if($tmp)
			return $tmp[0];
		else return 0;
	}
	
	function getJinsInGroup($id_faculty, $id_s_v, $id_course, $id_spec = false, $id_group = false, $jins=false, $S_Y=false, $H_Y = false){
		
		if($id_spec !== false){
			$spec = "AND `id_spec` = '$id_spec'";
		}else {
			$spec = '';
		}
		
		if($id_group !== false){
			$group = "AND `id_group` = '$id_group'";
		}else {
			$group = '';
		}
		
		$query = query("SELECT COUNT(`students`.`id`) as `counter` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` 
		WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' $spec $group AND 
		`users`.`jins` = '$jins' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		return $query[0]['counter'];
	}
	
	function checkStudentIn2Semestr($id_student, $S_Y){
		$query = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y'");
		if(count($query) == 2){
			return true;
		}else return false;
	}
	
	function getFromStudyGroups($id_faculty, $id_s_v, $id_course, $id_spec, $id_group, $field, $S_Y, $H_Y){
		$query = query("SELECT `$field` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		return $query[0][$field];
	}
	
	function getLang($short){
		if($short == 'tj') return "Тоҷикӣ";
		elseif($short == 'ru') return "Руссӣ";
		elseif($short == 'en') return "Англисӣ";
	}
	
	function getZaboniTahsil($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y){
		$query = query("SELECT `lang` FROM `std_study_groups` 
						WHERE `id_faculty` = '$id_faculty' AND
							`id_s_l` = '$id_s_l' AND
							`id_s_v` = '$id_s_v' AND
							`id_course` = '$id_course' AND
							`id_spec` = '$id_spec' AND 
							`id_group`  = '$id_group' AND
							`s_y` = '$S_Y' AND
							`h_y` = '$H_Y'
						");
		return getLang($query[0]['lang']);
	}
	
	function getStudyYearBySemestr($id_course, $semestr, $r=false){
		$course = getCourseBySemestr($semestr);
		$s_y= S_Y - $id_course + $course;
		if(!$r)
			$study_year = getStudyYear($s_y);
		else
			$study_year = $s_y;
		return $study_year;
	}
	
	function getStudyYearStudentBySemestr($id_student, $semestr){
		$id_course = getCourseBySemestr($semestr);
		$nimsola = getNimsolaBySemestr($semestr);
		$s_y = query("SELECT `s_y` FROM `students` WHERE status='1' AND `id_student`='$id_student' AND `id_course`='$id_course' AND `h_y`='$nimsola'");
		$s_y = @$s_y[0]['s_y'];
		return $s_y;
	}
	
	function getCourseBySemestr($semestr){
		if($semestr == 1 || $semestr == 2){
			$course = 1;
		}elseif($semestr == 3 || $semestr == 4){
			$course = 2;
		}elseif($semestr == 5 || $semestr == 6){
			$course = 3;
		}elseif($semestr == 7 || $semestr == 8){
			$course = 4;
		}elseif($semestr == 9 || $semestr == 10){
			$course = 5;
		}
		
		return $course;
	}
	
	function getSemestr($id_course, $half_year){
		if($id_course == 1 && $half_year == 1):
			$semestr = 1;
		elseif($id_course == 1 && $half_year == 2):
			$semestr = 2;
		elseif($id_course == 2 && $half_year == 1):
			$semestr = 3;
		elseif($id_course == 2 && $half_year == 2):
			$semestr = 4;
		elseif($id_course == 3 && $half_year == 1):
			$semestr = 5;
		elseif($id_course == 3 && $half_year == 2):
			$semestr = 6;
		elseif($id_course == 4 && $half_year == 1):
			$semestr = 7;
		elseif($id_course == 4 && $half_year == 2):
			$semestr = 8;
		elseif($id_course == 5 && $half_year == 1):
			$semestr = 9;
		elseif($id_course == 5 && $half_year == 2):
			$semestr = 10;
		endif;
		
		
		return $semestr;
	}
	
	
	function getNimsolaBySemestr($semestr){
		if($semestr % 2==1){
			return 1;
		}else{
			return 2;
		}
	}
	
	
	function getAdad($value) {
		$adad = '';
		
		if($value < 50) $adad = 0;
		if($value >= 45 && $value < 50) $adad = "0";
		if($value >= 50 && $value < 55) $adad = "1.0";
		if($value >= 55 && $value < 60) $adad = "1.33";
		if($value >= 60 && $value < 65) $adad = "1.67";
		if($value >= 65 && $value < 70) $adad = "2.0";
		if($value >= 70 && $value < 75) $adad = "2.33";
		if($value >= 75 && $value < 80) $adad = "2.67";
		if($value >= 80 && $value < 85) $adad = "3.0";
		if($value >= 85 && $value < 90) $adad = "3.33";
		if($value >= 90 && $value < 95) $adad = "3.67";
		if($value >= 95 && $value <= 100) $adad = "4.0";
		
		return $adad;
	}
	
	function getAnanavi($value) {
		$adad = '';
		
		if($value <= 49) $adad = 2;
		if($value >= 50 && $value < 75) $adad = 3;
		if($value >= 75 && $value < 90) $adad = 4;
		if($value >= 90 && $value <= 100) $adad = 5;
		return $adad;
	}
	
	function getAnanaviMatn($value) {
		$adad = '';
		if($value >= 50 && $value < 75) $adad = "Қаноатбахш";
		if($value >= 75 && $value < 90) $adad = "Хуб";
		if($value >= 90 && $value <= 100) $adad = "Аъло";
		return $adad;
	}
	
	function getLatter($value) {
		$latter = '';
		if($value < 45) $latter = "F";
		if($value >= 45 && $value < 50) $latter = "Fx";
		if($value >= 50.0 && $value < 55) $latter = "D";
		if($value >= 55.0 && $value < 60) $latter = "D+";
		if($value >= 60.0 && $value < 65) $latter = "C-";
		if($value >= 65.0 && $value < 70) $latter = "C";
		if($value >= 70.0 && $value < 75) $latter = "C+";
		if($value >= 75.0 && $value < 80) $latter = "B-";
		if($value >= 80.0 && $value < 85) $latter = "B";
		if($value >= 85.0 && $value < 90) $latter = "B+";
		if($value >= 90.0 && $value < 95) $latter = "A-";
		if($value >= 95.0 && $value <= 100) $latter = "A";
		
		return $latter;
	}
	
	function getSinuSol($date){
		return date_diff(new DateTime(), new DateTime($date))->y;
	}
	
	function makeDay($date){
		$tmp = explode("-", $date);
		return $tmp[2].'.'.$tmp[1].'.'.$tmp[0];
	}
	
	
	
	function makeLogin($name, $c){
		$name = trim($name);
		$name = mb_strtolower($name);
		$tj = array("а","б","в","г","ғ","д","е","ё","ж","з","и","ӣ","й","к","қ","л","м","н","о","п","р","с","т","у","ӯ","ф","х","ҳ","ч","ҷ","ш","ъ","э","ю","я","ц","щ","ы","ь");
		$en = array("a","b","v","g","gh","d","e","yo","zh","z","i","i","y","k","q","l","m","n","o","p","r","s","t","u","u","f","kh","h","ch","j","sh","a","e","yu","ya","tsa","hsa","ii","iy");
		$name = str_replace($tj, $en, $name);
		
		$name = explode(" ", $name);
		
		for($i = 0; $i < count($name); $i++){
			$login = $name[$i];
			$log = busylogin($login."/".S_Y);
			if(!$log){
				return $login."/".S_Y;
				break;
			}
		}
		
		if($log){
			$c++;
			return time().$c."/".S_Y;
		}
		
	}
	
	function busylogin($login) {
		$fan = select("users", "*", "`login` = '$login'", "id", false, "");
		if($fan) {
			return true;
		}else{
			return false;
		}
	}
	
	function Mybusylogin($login, $id_student) {
		$fan = select("users", "*", "`login` = '$login' AND `id` != '$id_student'", "id", false, "");
		if($fan) {
			return true;
		}else{
			return false;
		}
	}
	
	function doTajik($str){
		$arr_search = array("Њ","Ў","Ќ","Ї","Љ","Ѓ","њ","ў","ќ","ї","љ","ѓ");
		$arr_replace = array("Ҳ","Ӯ","Қ","Ӣ","Ҷ","Ғ","ҳ","ӯ","қ","ӣ","ҷ","ғ");
		$str = str_replace($arr_search, $arr_replace, $str);
		
		$str = str_replace("&nbsp;", "", $str);
		$str = preg_replace("/\s+/", " ", $str);
		return $str;
	}
	
	function getFarmonType($type){
		if($type == 1)
			return "Дохилшавӣ";
		elseif($type == 2)
			return "Интиқол аз дигар МТОК";
		elseif($type == 3)
			return "Интиқоли дохилӣ";
		elseif($type == 4)
			return "Барқарор";
		elseif($type == 5)
			return "Барқарор интиқол";
	}
	
	function getMessage($code){
		$query = select("messages", "*", "`code`='$code'", "id", false, "");
		return $query[0]['title'];
	}
	
	function formatDate($date){
		//2022-09-14 20:19:32
		if($date){
			$tmp = explode(" ", $date);
			$d = explode("-", $tmp[0]);
			
			$month = [
				'01' => 'Январ',
				'02' => 'Феврал',
				'03' => 'Март',
				'04' => 'Апрел',
				'05' => 'Май',
				'06' => 'Июн',
				'07' => 'Июл',
				'08' => 'Август',
				'09' => 'Сентябр',
				'10' => 'Октябр',
				'11' => 'Ноябр',
				'12' => 'Декабр',
			];
			
			$m = $month[$d[1]];
			
			if(isset($tmp[1]))
				return "{$d[2]} {$m} {$d[0]}, {$tmp[1]}";
			else return "{$d[2]}.{$d[1]}.{$d[0]}";
		}
	}
	
	function formatDateNoTime($date){
		//2022-09-14 20:19:32
		if($date){
			$tmp = explode(" ", $date);
			$d = explode("-", $tmp[0]);
			
			$month = [
				'01' => 'Январ',
				'02' => 'Феврал',
				'03' => 'Март',
				'04' => 'Апрел',
				'05' => 'Май',
				'06' => 'Июн',
				'07' => 'Июл',
				'08' => 'Август',
				'09' => 'Сентябр',
				'10' => 'Октябр',
				'11' => 'Ноябр',
				'12' => 'Декабр',
			];
			
			$m = $month[$d[1]];
			
			if(isset($tmp[1]))
				return "{$d[2]} {$m} {$d[0]}";
			else return "{$d[2]}.{$d[1]}.{$d[0]}";
		}
	}
	
	function getTeacher($id_faculty, $id_course, $id_spec, $id_group, $id_fan, $S_Y, $H_Y){
		$query = query("SELECT * FROM `jd` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($query))
			return getShortName($query[0]['id_teacher']);
	}
	
	function getOnline($access_type = false){
		if($access_type)
			$w = " AND `access_type` = '$access_type'";
		else $w = '';
		
		$now = date("Y-m-d H:i:s");
		//2023-04-04 12:00:00
		$data = query("SELECT * FROM `users` WHERE UNIX_TIMESTAMP('$now') - UNIX_TIMESTAMP(last_login) < ".ONLINE_TIME." $w");
		return $data;
	}
	
	
	function getUserOnline($id_user){
		$now = date("Y-m-d H:i:s");
		$data = query("SELECT * FROM `users` WHERE `id` = '$id_user' AND UNIX_TIMESTAMP('$now') - UNIX_TIMESTAMP(last_login) < ".ONLINE_TIME);
		if(!empty($data))
			return true;
		else return false;
	}
	
	
	function getLastOnline($data) {
		$t = explode(" ", $data);
		$day = date_diff(new DateTime(), new DateTime($t[0]))->days;
		
		if($day == 0):
			echo "Имрӯз";
		else:
			echo "$day рӯз пеш";
		endif;
	}
	
	function isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, $S_Y, $H_Y, $status = 1){
		/*
		$info = query("SELECT * FROM `std_study_groups` WHERE 
		`status` = '$status' AND `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND
		`id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'
		");
		*/
		$info = select("std_study_groups", "*", "`status` = '$status' AND
		`id_faculty` = '".$id_faculty."' AND `id_course` = '".$id_course."' AND
		`id_spec` = '".$id_spec."' AND `id_group` = '".$id_group."' AND
		`id_s_l` = '".$id_s_l."' AND `id_s_v` = '".$id_s_v."' AND
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");
		
		
		if(empty($info)){
			unset($data, $fields);
			$data['status'] = "'".clear_admin($status)."'";
			$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
			$data['id_course'] = "'".clear_admin($id_course)."'";
			$data['id_spec'] = "'".clear_admin($id_spec)."'";
			$data['id_group'] = "'".clear_admin($id_group)."'";
			$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
			$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
			$data['s_y'] = $S_Y;
			$data['h_y'] = $H_Y;
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			if(insert("std_study_groups", $fields, $data)){
				/*Барои илова кардан дар массиви меню*/
				if(!isset($_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'])){
					
					$_SESSION['superarr'][$id_faculty]["id"] = $id_faculty;
					$_SESSION['superarr'][$id_faculty]["title"] = getFaculty($id_faculty);
					$_SESSION['superarr'][$id_faculty]["short"] = getFacultyShort($id_faculty);
					
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]['id'] = $id_s_l;
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]['title'] = getStudyLevel($id_s_l);
					
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]['id'] = $id_s_v;
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]['title'] = getStudyView($id_s_v);
					
					
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['id'] = $id_course;
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['title'] = getCourse($id_course);
					
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['id'] = $id_spec;
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['code'] = getspecialtyCode($id_spec);
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['title'] = getspecialtyTitle($id_spec);
					
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'] = $id_group;
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['title'] = getGroup($id_group);
					$_SESSION['superarr'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['short'] = getGroup2($id_group);
				}
				
				if(!isset($_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'])){
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['id'] = $id_spec;
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['code'] = getspecialtyCode($id_spec);
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['title'] = getspecialtyTitle($id_spec);
					
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'] = $id_group;
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['title'] = getGroup($id_group);
					$_SESSION['biometric'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['short'] = getGroup2($id_group);
				}
				
				if(!isset($_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'])){
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['id'] = $id_spec;
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['code'] = getspecialtyCode($id_spec);
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['title'] = getspecialtyTitle($id_spec);
					
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['id'] = $id_group;
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['title'] = getGroup($id_group);
					$_SESSION['bugaltaria'][$id_faculty]["level"][$id_s_l]["view"][$id_s_v]["course"][$id_course]['spec'][$id_spec]['groups'][$id_group]['short'] = getGroup2($id_group);
				}
				/*Барои илова кардан дар массиви меню*/
			}
		}
	}
	
	function inVIP($id_student, $s_y, $h_y){
		$info = query("SELECT * FROM `_vip_list` WHERE `id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		if(!empty($info)){
			return true;
		}else return false;
	}
	
	function getNF($pole, $id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT `$pole` as `score` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query[0]['score']))
			return round($query[0]['score'], 2);
		else return 0;
	}
	
	function getNF2($nf, $id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT SUM(IFNULL(`nf_{$nf}_score`,0) + IFNULL(`nf_{$nf}_absent`,0) + IFNULL(`nf_{$nf}_score_r`,0)) as `score` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query[0]['score']))
			return round($query[0]['score'], 2);
		else return 0;
	}
	
	function getNF12($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT SUM(`nf_1_score` + `nf_2_score`) as `nf12` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!is_null($query[0]['nf12']))
			return $query[0]['nf12'];
		else return 0;
	}
	
	function getIMT($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT `imt_score` as `imt` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		//print_arr($query);
		
		if(!empty($query) && !is_null($query[0]['imt']))
			return $query[0]['imt'];
		else return 0;
		
	}
	
	function getTotalScore($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT `total_score` as `total_score` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query)){
			return $query[0]['total_score'];
		}
		else return 0;
		
	}
	
	function getTrimestrScore($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT `trimestr_score` as `trimestr_score` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query) && !is_null($query[0]['trimestr_score']))
			return $query[0]['trimestr_score'];
		else return 0;
		
	}
	
	function getAllScore($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT SUM(`nf_1_score` + `nf_1_absent`+ `nf_2_score` + `nf_2_absent`+ `imt_score`) as `allscore` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		if(!empty($query[0]['allscore']))
			return $query[0]['allscore'];
		else return 0;
	}
	
	function getAdministrationScore($id_student, $s_y, $h_y){
		$query = query("SELECT `score` FROM `mamur_score` WHERE `id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query[0]['score']))
			return $query[0]['score'];
		else return 0;
	}
	
	
	function pagination($url, $active, $elements, $on_page, $show_page, $znak){
		$count_pages = ceil($elements / $on_page);
		if($count_pages > 1){
			$left = $active - 1;
			$right = $count_pages - $active;
			if($left < floor($show_page / 2)) $start = 1;
			else $start = $active - floor($show_page / 2);
			$end = $start + $show_page - 1;
			if($end > $count_pages) {
				$start -= ($end - $count_pages);
				$end = $count_pages;
				if($start < 1) $start = 1;
			}
			
			echo '<ul class="pagination">';
			
			if($active != 1){
				$tmp = '<li><a href="'.$url.'" title="Ба аввал">«</a></li>';
				if($active == 2){
					$t = $url;
				}else{
					$t = $url.$znak.'page='.($active - 1);
				}
				$tmp .= '<li><a href="'.$t.'" title="Пешина">‹</a></li>';
			}else{
				$tmp = '<li><span>«</span></li>';
				$tmp .= '<li><span>‹</span></li>';
			}
			echo $tmp;
			for($i = $start; $i <= $end; $i++){
				if($i == $active) {
					echo "<li class='active'><a>$i</a></li>";
				}else{
					echo '<li><a href="'.$url.$znak.'page='.$i.'">'.$i.'</a></li>';
				}
			}
			
			if($active != $count_pages){
				$l = '<li><a href="'.$url.$znak.'page='.($active + 1).'" title="Ба пеш">›</a></li>';
				$l .= '<li><a href="'.$url.$znak.'page='.$count_pages.'" title="Ба охир">»</a></li>';
			}else{
				$l = '<li><span>›</span></li>';
				$l .= '<li><span>»</span></li>';
			}
			echo $l;
			echo '</ul>';
		}
	}
	
	
	
	
	
?>
