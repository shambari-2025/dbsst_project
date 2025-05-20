<?php
switch($action) {
    case "qabul":
        $list = query("SELECT * FROM `qabul_plan` ORDER BY `id`");
        $page_info['title'] = 'Нақшаҳои қабул';
        break;

    case "insert":
        $data['title'] = "'".clear_admin($_REQUEST['title'])."'";
        $data['s_y'] = "'".clear_admin($_REQUEST['s_y'])."'";
        
        $fields = array_keys($data);
        $data = implode(",", $data);
        
        insert("qabul_plan", $fields, $data);
        redirect();
        break;

    case "detail":
        $id = $_REQUEST['id'];
        
        $info = query("SELECT * FROM `qabul_plan` WHERE `id` = '$id'");
        $s_y = $info[0]['s_y'];
        $page_info['title'] = 'Нақшаи қабули соли '.getStudyYear($s_y);
        
        $naqsha_details = query("SELECT * FROM `qabul_plan_detail` WHERE `id_qabul_plan` = '$id' ORDER BY `id_spec`, `id_s_l`");
        
        // Муайян кардани массиви $langs барои табдили забонҳо
        $langs = [
            'tojiki' => 'Тоҷикӣ',
            'rusi' => 'Русӣ',
            'english' => 'Англисӣ'
        ];
        
        // Логги барои санҷиш
        error_log("Naqsha Details: " . print_r($naqsha_details, true));
        
        // Табдили қиматҳои lang ба забони нишондодашуда
        foreach ($naqsha_details as &$detail) {
            $detail['lang_display'] = isset($langs[$detail['lang']]) ? $langs[$detail['lang']] : 'Номаълум';
        }
        unset($detail);
        break;

    case "addData":
        $id = isset($_REQUEST['id']) ? clear_admin($_REQUEST['id']) : null;
        $specialties = isset($_REQUEST['specialties']) ? $_REQUEST['specialties'] : [];

        // Логги барои санҷиш
        error_log("Received ID: " . $id);
        error_log("Received Specialties: " . print_r($specialties, true));

        // Санҷиши мавҷудияти id
        if (empty($id)) {
            echo json_encode(['status' => 'error', 'message' => 'ID нақша мавҷуд нест!']);
            exit;
        }

        // Санҷиши мавҷудияти specialties
        if (empty($specialties)) {
            echo json_encode(['status' => 'error', 'message' => 'Ягон ихтисос интихоб нашудааст!']);
            exit;
        }

        $success = true;
        foreach ($specialties as $specIndex => $spec) {
            // Санҷиши мавҷудияти майдонҳои асосӣ
            if (!isset($spec['id_spec']) || !isset($spec['id_s_l']) || !isset($spec['groups'])) {
                error_log("Missing required fields for specialty index $specIndex: " . print_r($spec, true));
                $success = false;
                continue;
            }

            $id_spec = clear_admin($spec['id_spec']);
            $id_s_l = clear_admin($spec['id_s_l']);
            $money = !empty($spec['money']) ? clear_admin($spec['money']) : null;
            $money_other = !empty($spec['money_other']) ? clear_admin($spec['money_other']) : null;
            $groups = $spec['groups'];

            // Санҷиши мавҷудияти гурӯҳҳо
            if (empty($groups)) {
                error_log("No groups provided for specialty index $specIndex");
                $success = false;
                continue;
            }

            foreach ($groups as $groupIndex => $group) {
                // Санҷиши мавҷудияти майдонҳои гурӯҳ
                if (!isset($group['lang']) || !isset($group['study_type']) || !isset($group['study_view']) || !isset($group['plan'])) {
                    error_log("Missing required fields for group index $groupIndex in specialty $specIndex: " . print_r($group, true));
                    $success = false;
                    continue;
                }

                // Санҷиши қимати lang
                $lang = clear_admin($group['lang']);
                $valid_langs = ['tojiki', 'rusi', 'english'];
                if (!in_array($lang, $valid_langs)) {
                    error_log("Invalid lang value for group index $groupIndex in specialty $specIndex: $lang");
                    $lang = 'tojiki'; // Пешфарз ба 'tojiki'
                }

                $id_s_v = clear_admin($group['study_view']);
                $id_s_t = clear_admin($group['study_type']);

                $data = [];
                $data['id_qabul_plan'] = "'$id'";
                $data['id_spec'] = "'$id_spec'";
                $data['id_s_l'] = "'$id_s_l'";
                $data['id_s_v'] = "'$id_s_v'";
                $data['id_s_t'] = "'$id_s_t'";
                if ($money) $data['money'] = "'$money'";
                if ($money_other) $data['money_other'] = "'$money_other'";
                $data['lang'] = "'$lang'";
                $data['plan'] = "'".clear_admin($group['plan'])."'";

                $fields = array_keys($data);
                $values = implode(",", $data);

                // Логги барои санҷиш
                error_log("Inserting data: " . print_r($data, true));

                try {
                    $insert_id = insert("qabul_plan_detail", $fields, $values);
                    if (!$insert_id) {
                        error_log("Failed to insert data for specialty $specIndex, group $groupIndex");
                        $success = false;
                    }
                } catch (Exception $e) {
                    error_log("Insert error: " . $e->getMessage());
                    $success = false;
                    echo json_encode(['status' => 'error', 'message' => 'Хато ҳангоми сабт: ' . $e->getMessage()]);
                    exit;
                }
            }
        }

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Маълумот бомуваффақият сабт шуд!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Хато ҳангоми сабт, лутфан маълумотро санҷед!']);
        }
        exit;
        break;

    case "update_detail":
        $id = $_REQUEST['id'];
        
        $fields['id_spec'] = clear_admin($_REQUEST['id_spec']);
        $fields['id_s_l'] = clear_admin($_REQUEST['id_s_l']);
        $fields['id_s_v'] = clear_admin($_REQUEST['id_s_v']);
        $fields['id_s_t'] = clear_admin($_REQUEST['id_s_t']);
        
        if (isset($_REQUEST['money']) && !empty($_REQUEST['money']))
            $fields['money'] = clear_admin($_REQUEST['money']);
        else
            $fields['money'] = 'NULL';
        
        if (isset($_REQUEST['money_other']) && !empty($_REQUEST['money_other']))
            $fields['money_other'] = clear_admin($_REQUEST['money_other']);
        else
            $fields['money_other'] = 'NULL';
        
        $lang = clear_admin($_REQUEST['lang']);
        if (strlen($lang) > 20) { // Маҳдудият ба андозаи VARCHAR(20) мувофиқ аст
            $lang = substr($lang, 0, 20);
            error_log("Lang value truncated to 20 characters in update_detail: $lang");
        }
        $fields['lang'] = $lang;
        $fields['plan'] = clear_admin($_REQUEST['plan']);
        
        update("qabul_plan_detail", $fields, "`id` = '$id'");
        redirect();
        break;

    case "deleteitem":
        $id = $_REQUEST['id'];
        delete('qabul_plan_detail', "`id` = '$id'");
        redirect();
        break;

    case "getSpecialtyFees":
        $id_spec = isset($_REQUEST['id_spec']) ? clear_admin($_REQUEST['id_spec']) : null;
        $id_qabul_plan = isset($_REQUEST['id_qabul_plan']) ? clear_admin($_REQUEST['id_qabul_plan']) : null;

        if (!$id_spec || !$id_qabul_plan) {
            echo json_encode(['status' => 'error', 'message' => 'Параметрҳо нодурустанд!']);
            exit;
        }

        $details = query("SELECT money, money_other FROM `qabul_plan_detail` WHERE `id_qabul_plan` = '$id_qabul_plan' AND `id_spec` = '$id_spec' LIMIT 1");

        if (!empty($details)) {
            echo json_encode([
                'status' => 'success',
                'money' => $details[0]['money'],
                'money_other' => $details[0]['money_other']
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Маълумот ёфт нашуд!']);
        }
        exit;
        break;
}
?>