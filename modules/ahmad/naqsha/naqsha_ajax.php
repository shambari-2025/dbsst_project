<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

/*Collect datas*/
$specialties = query("SELECT * FROM `specialties` WHERE `id_s_l` = '1' ORDER BY `id_faculty`");
$studyviews = query("SELECT * FROM `study_view`");
$studytype = query("SELECT * FROM `study_type`");
$studylevel = query("SELECT * FROM `study_level`");
/*Collect datas*/

switch($option){
    
    case "add":
        define("MY_URL", $_REQUEST['my_url']);
        
        $studyyears = query("SELECT * FROM `study_years` ORDER BY `id` DESC");
        
        include("ajax/add_n_q.php");
        exit;
    break;
    
    case "editForm":
        $id = $_REQUEST['id'];
        define("MY_URL", $_REQUEST['my_url']);
        $n_d = query("SELECT * FROM `qabul_plan_detail` WHERE `id` = '$id'");
        
        include("ajax/editForm.php");
        exit;
    break;
    
    case "getSpecs":
        $id_s_l = $_REQUEST['id_s_l'];
        
        $specs = select("specialties", "*", "", "id", false, "");
        
        include("ajax/specsforfaculty.php");
        exit;
    break;
    
    case "addForm":
        $id = $_REQUEST['id'];
        
        define("MY_URL", $_REQUEST['my_url']);
        
        include("ajax/addform.php");
        exit;
    break;
    
    case "getNewRow":
        /*Collect datas*/
        $specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`");
        $studyviews = query("SELECT * FROM `study_view`");
        $studytype = query("SELECT * FROM `study_type`");
        $studylevel = query("SELECT * FROM `study_level`");
        /*Collect datas*/
        
        include("ajax/data_part.php");
        exit;
    break;

    case "addData":
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $specialties = isset($_POST['specialties']) ? $_POST['specialties'] : [];

        if ($id && !empty($specialties)) {
            foreach ($specialties as $specialty) {
                $id_spec = isset($specialty['id_spec']) ? intval($specialty['id_spec']) : 0;
                $id_s_l = isset($specialty['id_s_l']) ? intval($specialty['id_s_l']) : 0;
                $groups = isset($specialty['groups']) ? $specialty['groups'] : [];

                foreach ($groups as $group) {
                    $lang = isset($group['lang']) ? mysqli_real_escape_string($connection, $group['lang']) : '';
                    $study_type = isset($group['study_type']) ? intval($group['study_type']) : 0;
                    $study_view = isset($group['study_view']) ? intval($group['study_view']) : 0;
                    $money = isset($group['money']) ? mysqli_real_escape_string($connection, $group['money']) : '';
                    $money_foreign = isset($group['money_foreign']) ? mysqli_real_escape_string($connection, $group['money_foreign']) : '';
                    $plan = isset($group['plan']) ? intval($group['plan']) : 0;

                    $sql = "INSERT INTO `qabul_plan_detail` (
                        `id_qabul_plan`, `id_spec`, `id_s_l`, `id_s_t`, `id_s_v`, `lang`, `money`, `money_other`, `plan`
                    ) VALUES (
                        '$id', '$id_spec', '$id_s_l', '$study_type', '$study_view', '$lang', '$money', '$money_foreign', '$plan'
                    )";

                    $result = query($sql);

                    if (!$result) {
                        $response = [
                            'status' => 'error',
                            'message' => "Хато ҳангоми сабт: " . mysqli_error($connection)
                        ];
                        echo json_encode($response);
                        exit;
                    }
                }
            }

            $response = [
                'status' => 'success',
                'message' => 'Маълумот бомуваффақият сабт шуд!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Маълумот барои сабт мавҷуд нест!'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    break;
}

?>