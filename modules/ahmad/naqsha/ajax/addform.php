<?php
require_once '../../lib/header_file.php';

// Маълумот барои dropdowns
$specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`");
$studyviews = query("SELECT * FROM `study_view`");
$studytype = query("SELECT * FROM `study_type`");
$studylevel = query("SELECT * FROM `study_level`");

// Гирифтани ID-и нақша (агар мавҷуд бошад)
$id = isset($_REQUEST['id']) ? clear_admin($_REQUEST['id']) : null;

// Гирифтани қиматҳои пешфарз барои маблағи таҳсил ва барои шаҳрвандони хориҷӣ (агар лозим бошад, аммо дар ин ҳолат мо онҳоро истифода намекунем)
$default_money = '';
$default_money_other = '';
if ($id) {
    $first_specialty_id = isset($specialties[0]['id']) ? $specialties[0]['id'] : null;
    if ($first_specialty_id) {
        $plan_details = query("SELECT money, money_other FROM `qabul_plan_detail` WHERE `id_qabul_plan` = '$id' AND `id_spec` = '$first_specialty_id' LIMIT 1");
        if (!empty($plan_details)) {
            $default_money = $plan_details[0]['money'] ?? '';
            $default_money_other = $plan_details[0]['money_other'] ?? '';
        }
    }
}
?>

<form id="specialtyForm" action="<?=MY_URL?>?option=naqsha&action=addData" method="post" enctype="multipart/form-data">
    <div id="specialtiesContainer">
        <!-- Ихтисоси аввал -->
        <div class="specialty-item">
            <table class="addform testcase" style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td style="width: 50%">
                        <label for="id_spec_0">Ихтисосро интихоб кунед:</label>
                        <select name="specialties[0][id_spec]" id="id_spec_0" class="form-control specialty-select" required>
                            <option value="" disabled selected>-Интихоб кунед-</option>
                            <?php foreach($specialties as $item): ?>
                                <option value="<?=$item['id'];?>"><?=$item['code']?> - <?=$item['title_tj']; ?> (<?=getFaculty($item['id_faculty'])?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <label for="id_s_l_0">Зинаи таҳсилро интихоб кунед:</label>
                        <select name="specialties[0][id_s_l]" id="id_s_l_0" class="form-control study-level-select" required>
                            <option value="" disabled selected>-Интихоб кунед-</option>
                            <?php foreach($studylevel as $item): ?>
                                <option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <!-- Ин қисмат холӣ мемонад -->
                    </td>
                </tr>
                <!-- Бахши гурӯҳҳо -->
                <tr>
                    <td colspan="3">
                        <label>Гурӯҳҳо</label>
                        <table class="group-table" style="width: 100%; border-collapse: collapse;" data-spec-index="0">
                            <thead>
                                <tr style="background-color: #edf2f7;">
                                    <th style="border: 1px solid #ddd; padding: 8px;">№</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Забон</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Намуди таҳсил</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Маҷмӯи маблағи шартнома</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Барои шаҳрвандони хориҷӣ</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Шакли таҳсил</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Нақша</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Амал</th>
                                </tr>
                            </thead>
                            <tbody class="groups-container">
                                <tr class="group-item" data-group-index="0">
                                    <td style="border: 1px solid #ddd; padding: 8px;">1</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <select name="specialties[0][groups][0][lang]" class="form-control" required>
                                            <option value="tojiki">Тоҷикӣ</option>
                                            <option value="rusi">Русӣ</option>
                                            <option value="english">Англисӣ</option>
                                        </select>
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <select name="specialties[0][groups][0][study_type]" class="form-control study-type-select" required>
                                            <option value="" disabled selected>-Интихоб кунед-</option>
                                            <?php foreach($studytype as $item): ?>
                                                <option value="<?=$item['id'];?>"><?=$item['title']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <input type="text" name="specialties[0][groups][0][money]" class="form-control group-money-input" placeholder="Маҷмӯи маблағи шартнома">
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <input type="text" name="specialties[0][groups][0][money_foreign]" class="form-control group-money-foreign-input" placeholder="Барои шаҳрвандони хориҷӣ">
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <select name="specialties[0][groups][0][study_view]" class="form-control study-view-select" required>
                                            <option value="" disabled selected>-Интихоб кунед-</option>
                                            <?php foreach($studyviews as $item): ?>
                                                <option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <input type="number" name="specialties[0][groups][0][plan]" class="form-control" required min="1" placeholder="Нақша">
                                    </td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        <button type="button" class="btn btn-danger remove-group"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success mt-2 add-group" data-spec-index="0"><i class="fa fa-plus-square mr-1"></i> Иловаи гурӯҳ</button>
                    </td>
                </tr>
            </table>
            <button type="button" class="btn btn-danger remove-specialty mt-2"><i class="fa fa-trash mr-1"></i> Нест кардани ихтисос</button>
            <hr style="margin: 20px 0;">
        </div>
    </div>
    <button type="button" class="btn btn-primary mb-4" id="addSpecialty"><i class="fa fa-plus-square mr-1"></i> Иловаи ихтисос</button>
    <table style="width:100%">
        <tr>
            <td colspan="2">
                <br>
                <input type="hidden" name="id" value="<?php echo isset($id) ? htmlspecialchars($id) : ''; ?>">
                <button type="submit" class="btn btn-success">Сабт кардан</button>
            </td>
        </tr>
    </table>
</form>

<style>
    .btn-primary {
        background-color: #2b6cb0;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }
    .btn-primary:hover {
        background-color: #2c5282;
    }
    .btn-success {
        background-color: #38a169;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }
    .btn-success:hover {
        background-color: #2f855a;
    }
    .btn-danger {
        background-color: #e53e3e;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }
    .btn-danger:hover {
        background-color: #c53030;
    }
    .form-control {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    .form-control:disabled {
        background-color: #f0f0f0;
        cursor: not-allowed;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        // Функсия барои иловаи ихтисос
        function addSpecialty(index) {
            const specialtyHtml = `
                <div class="specialty-item">
                    <table class="addform testcase" style="width: 100%; margin-bottom: 20px;">
                        <tr>
                            <td style="width: 50%">
                                <label for="id_spec_${index}">Ихтисосро интихоб кунед:</label>
                                <select name="specialties[${index}][id_spec]" id="id_spec_${index}" class="form-control specialty-select" required>
                                    <option value="" disabled selected>-Интихоб кунед-</option>
                                    <?php foreach($specialties as $item): ?>
                                        <option value="<?=$item['id'];?>"><?=$item['code']?> - <?=$item['title_tj']; ?> (<?=getFaculty($item['id_faculty'])?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <label for="id_s_l_${index}">Зинаи таҳсилро интихоб кунед:</label>
                                <select name="specialties[${index}][id_s_l]" id="id_s_l_${index}" class="form-control study-level-select" required>
                                    <option value="" disabled selected>-Интихоб кунед-</option>
                                    <?php foreach($studylevel as $item): ?>
                                        <option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <!-- Ин қисмат холӣ мемонад -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label>Гурӯҳҳо</label>
                                <table class="group-table" style="width: 100%; border-collapse: collapse;" data-spec-index="${index}">
                                    <thead>
                                        <tr style="background-color: #edf2f7;">
                                            <th style="border: 1px solid #ddd; padding: 8px;">№</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Забон</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Намуди таҳсил</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Маҷмӯи маблағи шартнома</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Барои шаҳрвандони хориҷӣ</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Шакли таҳсил</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Нақша</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Амал</th>
                                        </tr>
                                    </thead>
                                    <tbody class="groups-container">
                                        <tr class="group-item" data-group-index="0">
                                            <td style="border: 1px solid #ddd; padding: 8px;">1</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <select name="specialties[${index}][groups][0][lang]" class="form-control" required>
                                                    <option value="tojiki">Тоҷикӣ</option>
                                                    <option value="rusi">Русӣ</option>
                                                    <option value="english">Англисӣ</option>
                                                </select>
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <select name="specialties[${index}][groups][0][study_type]" class="form-control study-type-select" required>
                                                    <option value="" disabled selected>-Интихоб кунед-</option>
                                                    <?php foreach($studytype as $item): ?>
                                                        <option value="<?=$item['id'];?>"><?=$item['title']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <input type="text" name="specialties[${index}][groups][0][money]" class="form-control group-money-input" placeholder="Маҷмӯи маблағи шартнома">
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <input type="text" name="specialties[${index}][groups][0][money_foreign]" class="form-control group-money-foreign-input" placeholder="Барои шаҳрвандони хориҷӣ">
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <select name="specialties[${index}][groups][0][study_view]" class="form-control study-view-select" required>
                                                    <option value="" disabled selected>-Интихоб кунед-</option>
                                                    <?php foreach($studyviews as $item): ?>
                                                        <option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <input type="number" name="specialties[${index}][groups][0][plan]" class="form-control" required min="1" placeholder="Нақша">
                                            </td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                <button type="button" class="btn btn-danger remove-group"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success mt-2 add-group" data-spec-index="${index}"><i class="fa fa-plus-square mr-1"></i> Иловаи гурӯҳ</button>
                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-danger remove-specialty mt-2"><i class="fa fa-trash mr-1"></i> Нест кардани ихтисос</button>
                    <hr style="margin: 20px 0;">
                </div>
            `;
            $('#specialtiesContainer').append(specialtyHtml);
        }

        // Рӯйдоди иловаи ихтисос
        $('#addSpecialty').on('click', function() {
            const index = $('#specialtiesContainer .specialty-item').length;
            addSpecialty(index);
        });

        // Рӯйдоди нест кардани ихтисос
        $('#specialtiesContainer').on('click', '.remove-specialty', function() {
            if ($('#specialtiesContainer .specialty-item').length > 1) {
                $(this).closest('.specialty-item').remove();
                // Навсозии индексҳо
                $('#specialtiesContainer .specialty-item').each(function(specIndex) {
                    $(this).find('select, input').each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            const newName = name.replace(/specialties\[\d+\]/, `specialties[${specIndex}]`);
                            $(this).attr('name', newName);
                        }
                        const id = $(this).attr('id');
                        if (id) {
                            const newId = id.replace(/_\d+$/, `_${specIndex}`);
                            $(this).attr('id', newId);
                        }
                    });
                    const groupTable = $(this).find('.group-table');
                    groupTable.attr('data-spec-index', specIndex);
                    groupTable.find('.add-group').attr('data-spec-index', specIndex);
                    groupTable.find('.group-item').each(function(groupIndex) {
                        $(this).find('td:first').text(groupIndex + 1);
                        $(this).find('select, input').each(function() {
                            const name = $(this).attr('name');
                            if (name) {
                                const newName = name.replace(/specialties\[\d+\]\[groups\]\[\d+\]/, `specialties[${specIndex}][groups][${groupIndex}]`);
                                $(this).attr('name', newName);
                            }
                        });
                        $(this).attr('data-group-index', groupIndex);
                    });
                });
            } else {
                alert('Ақаллан як ихтисос бояд бошад!');
            }
        });

        // Рӯйдоди иловаи гурӯҳ
        $('#specialtiesContainer').on('click', '.add-group', function() {
            const specIndex = $(this).data('spec-index');
            const groupTable = $(this).prev('.group-table');
            const groupIndex = groupTable.find('.group-item').length;
            const groupHtml = `
                <tr class="group-item" data-group-index="${groupIndex}">
                    <td style="border: 1px solid #ddd; padding: 8px;">${groupIndex + 1}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <select name="specialties[${specIndex}][groups][${groupIndex}][lang]" class="form-control" required>
                            <option value="tojiki">Тоҷикӣ</option>
                            <option value="rusi">Русӣ</option>
                            <option value="english">Англисӣ</option>
                        </select>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <select name="specialties[${specIndex}][groups][${groupIndex}][study_type]" class="form-control study-type-select" required>
                            <option value="" disabled selected>-Интихоб кунед-</option>
                            <?php foreach($studytype as $item): ?>
                                <option value="<?=$item['id'];?>"><?=$item['title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <input type="text" name="specialties[${specIndex}][groups][${groupIndex}][money]" class="form-control group-money-input" placeholder="Маҷмӯи маблағи шартнома">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <input type="text" name="specialties[${specIndex}][groups][${groupIndex}][money_foreign]" class="form-control group-money-foreign-input" placeholder="Барои шаҳрвандони хориҷӣ">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <select name="specialties[${specIndex}][groups][${groupIndex}][study_view]" class="form-control study-view-select" required>
                            <option value="" disabled selected>-Интихоб кунед-</option>
                            <?php foreach($studyviews as $item): ?>
                                <option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <input type="number" name="specialties[${specIndex}][groups][${groupIndex}][plan]" class="form-control" required min="1" placeholder="Нақша">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <button type="button" class="btn btn-danger remove-group"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `;
            groupTable.find('.groups-container').append(groupHtml);
            // Триггер барои санҷиши аввалияи намуди таҳсил дар гурӯҳи нав
            groupTable.find('.group-item:last .study-type-select').trigger('change');
        });

        // Рӯйдоди хориҷ кардани гурӯҳ
        $('#specialtiesContainer').on('click', '.remove-group', function() {
            const groupTable = $(this).closest('.group-table');
            if (groupTable.find('.group-item').length > 1) {
                $(this).closest('.group-item').remove();
                // Навсозии рақамҳо дар сутуни №
                groupTable.find('.group-item').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                    const specIndex = groupTable.data('spec-index');
                    $(this).find('select, input').each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            const newName = name.replace(/specialties\[\d+\]\[groups\]\[\d+\]/, `specialties[${specIndex}][groups][${index}]`);
                            $(this).attr('name', newName);
                        }
                    });
                    $(this).attr('data-group-index', index);
                });
            } else {
                alert('Ақаллан як гурӯҳ бояд бошад!');
            }
        });

        // Рӯйдоди тағйири "Намуди таҳсил" барои фаъол/ғайрифаъол кардани майдонҳои маблағ
        $('#specialtiesContainer').on('change', '.study-type-select', function() {
            const $groupItem = $(this).closest('.group-item');
            const studyType = $(this).val();
            const $moneyInput = $groupItem.find('.group-money-input');
            const $moneyForeignInput = $groupItem.find('.group-money-foreign-input');

            // Фарз мекунем: 1 - Шартномавӣ, 2 - Буҷавӣ, 3 - Квота, 4 - Буҷавӣ
            if (studyType == '1') { // Шартномавӣ
                $moneyInput.prop('disabled', false).prop('required', true);
                $moneyForeignInput.prop('disabled', false).prop('required', true);
            } else { // Буҷавӣ (2, 4) ё Квота (3)
                $moneyInput.prop('disabled', true).prop('required', false).val('');
                $moneyForeignInput.prop('disabled', true).prop('required', false).val('');
            }
        });

        // Валидатсияи маблағҳо (танҳо рақамҳо)
        $('#specialtiesContainer').on('input', '.group-money-input, .group-money-foreign-input', function() {
            const value = $(this).val();
            if (!/^\d*$/.test(value)) {
                $(this).val('');
                alert('Лутфан танҳо рақамҳо ворид кунед!');
            }
        });

        // Рӯйдоди сабти форма
        $('#specialtyForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            console.log('Form Data:', formData); // Логги барои санҷиш

            // Санҷиши холӣ набудани маблағҳо барои намуди шартномавӣ
            let isValid = true;
            $('.group-item').each(function() {
                const studyType = $(this).find('.study-type-select').val();
                const $moneyInput = $(this).find('.group-money-input');
                const $moneyForeignInput = $(this).find('.group-money-foreign-input');

                if (studyType == '1') { // Шартномавӣ
                    if ($moneyInput.val().trim() === '' || $moneyForeignInput.val().trim() === '') {
                        alert('Лутфан ҳамаи майдонҳои "Маҷмӯи маблағи шартнома" ва "Барои шаҳрвандони хориҷӣ"-ро барои намуди шартномавӣ пур кунед!');
                        isValid = false;
                        return false;
                    }
                }
            });

            if (!isValid) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response); // Логги барои санҷиш
                    if (response.status === 'success') {
                        alert(response.message);
                        $('#specialtyModal').modal('hide');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Хато:', xhr.responseText, status, error); // Логги барои хато
                    alert('Хато рух дод, лутфан консолро санҷед (F12 → Console).');
                }
            });
        });

        // Триггер барои санҷиши аввалияи намуди таҳсил
        $('.study-type-select').trigger('change');
    });
</script>