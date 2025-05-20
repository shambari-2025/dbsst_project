<?php
require_once '../../lib/header_file.php';

// Маълумот барои dropdowns
$specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`");
$studyviews = query("SELECT * FROM `study_view`");
$studytype = query("SELECT * FROM `study_type`");
$studylevel = query("SELECT * FROM `study_level`");

// Муайян кардани массиви $langs (агар аллакай муайян нашуда бошад)
$langs = [
    'tojiki' => 'Тоҷикӣ',
    'rusi' => 'Русӣ',
    'english' => 'Англисӣ' // Тағйир аз 'English' ба 'Англисӣ'
];
?>

<form action="<?=MY_URL?>?option=naqsha&action=update_detail" method="post" enctype="multipart/form-data">
    <table class="addform testcase" style="width: 100%">    
        <tr>
            <td style="width: 50%">
                <label for="id_spec">Ихтисосро интихоб кунед:</label>
                <select name="id_spec" id="id_spec" class="form-control">
                    <?php foreach($specialties as $item): ?>
                        <option <?php if($n_d[0]['id_spec'] == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['code']?> - <?=$item['title_tj'];?> (<?=getFaculty($item['id_faculty']); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </td>
            
            <td>
                <label for="id_s_l">Зинаи таҳсилро интихоб кунед:</label>
                <select name="id_s_l" id="id_s_l" class="form-control">
                    <?php foreach($studylevel as $item): ?>
                        <option <?php if($n_d[0]['id_s_l'] == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            
            <td>
                <label for="id_s_v">Шакли таҳсилро интихоб кунед:</label>
                <select name="id_s_v" id="id_s_v" class="form-control">
                    <?php foreach($studyviews as $item): ?>
                        <option <?php if($n_d[0]['id_s_v'] == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>    
        <tr>    
            <td>
                <label for="id_s_t">Намуди таҳсилро интихоб кунед:</label>
                <select name="id_s_t" id="id_s_t" class="form-control">
                    <?php foreach($studytype as $item): ?>
                        <option <?php if($n_d[0]['id_s_t'] == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            
            <td>
                <label for="money">Маблағи таҳсил:</label>
                <input value="<?=$n_d[0]['money']?>" type="text" name="money" id="money" class="form-control">
            </td>
            
            <td>
                <label for="money_other">Барои шаҳрвандони хориҷӣ:</label>
                <input value="<?=$n_d[0]['money_other']?>" type="text" name="money_other" id="money_other" class="form-control">
            </td>
        </tr>    
        <tr>    
            <td>
                <label for="lang">Забони таҳсилро интихоб кунед:</label>
                <select name="lang" id="lang" class="form-control">
                    <?php foreach($langs as $v => $k): ?>
                        <option <?php if($n_d[0]['lang'] == $v):?>selected<?php endif;?> value="<?=$v;?>"><?=$k?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            
            <td colspan="2">
                <label for="plan">Миқдори довталаб:</label>
                <input value="<?=$n_d[0]['plan']?>" type="text" name="plan" id="plan" class="form-control">
            </td>
        </tr>
    </table>
    
    <table style="width:100%">
        <tr>
            <td colspan="2">
                <br>
                <input type="hidden" name="id" value="<?=$id?>">
                <button type="submit" class="btn btn-success">Сабт кардан</button>
            </td>
        </tr>
    </table>
</form>