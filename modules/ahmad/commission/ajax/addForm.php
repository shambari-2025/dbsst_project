<form id="add_member_form" action="<?=MY_URL?>?option=commission&action=insert_member" method="post" enctype="multipart/form-data">
    <table class="addform">
        <tr>
            <td>
                <label for="id_teacher">Омӯзгорро интихоб кунед:</label>
                <select name="id_user" id="id_teacher" class="form-control" required>
                    <option value="">-- Интихоб кунед! --</option>
                    <?php foreach($all_teachers as $item): ?>
                        <option value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label>Факултетҳо:</label>
                <div class="checkbox-zoom zoom-success">
                    <label for="ALL_FACULTIES">
                        <input type="checkbox" name="faculties[]" id="ALL_FACULTIES" value="ALL">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                        <span>Ҳамаи факултетҳо</span>
                    </label>
                </div>
                <?php foreach($faculties as $f_item): ?>
                    <div class="checkbox-zoom zoom-success">
                        <label for="faculty_<?=$f_item['id']?>">
                            <input type="checkbox" name="faculties[]" id="faculty_<?=$f_item['id']?>" value="<?=$f_item['id']?>">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                            <span><?=$f_item['title']?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>

        <tr>
            <td>
                <label>Зинаҳои таҳсил:</label>
                <div class="checkbox-zoom zoom-success">
                    <label for="ALL_STUDY_LEVELS">
                        <input type="checkbox" name="study_level[]" id="ALL_STUDY_LEVELS" value="ALL">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                        <span>Ҳамаи зинаҳои таҳсил</span>
                    </label>
                </div>
                <?php foreach($studylevels as $s_item): ?>
                    <div class="checkbox-zoom zoom-success">
                        <label for="study_level_<?=$s_item['id']?>">
                            <input type="checkbox" name="study_level[]" id="study_level_<?=$s_item['id']?>" value="<?=$s_item['id']?>">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                            <span><?=$s_item['title']?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>

        <tr>
            <td>
                <label>Мамлакатҳо:</label>
                <div class="checkbox-zoom zoom-success">
                    <label for="ALL_COUNTRIES">
                        <input type="checkbox" name="countries[]" id="ALL_COUNTRIES" value="ALL">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                        <span>Ҳамаи мамлакатҳо</span>
                    </label>
                </div>
                <?php foreach($countries as $c_item): ?>
                    <div class="checkbox-zoom zoom-success">
                        <label for="id_countries_<?=$c_item['id']?>">
                            <input type="checkbox" name="countries[]" id="id_countries_<?=$c_item['id']?>" value="<?=$c_item['id']?>">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-success"></i></span>
                            <span><?=$c_item['title']?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>

        <tr>
            <td>
                <button type="submit" id="save_member_button" class="btn btn-success">
                    <span id="save_text"><i class="fa fa-save"></i> Сабт кардан</span>
                    <span id="saving_text" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Сабт шуда истодааст...</span>
                </button>
            </td>
        </tr>
    </table>
</form>

<!-- JavaScript барои сабт ва аниматсия -->
<script type="text/javascript">
jQuery(document).ready(function($){
    var form_submitted = false;

    $("#add_member_form").on("submit", function(e) {
        if (form_submitted) {
            e.preventDefault();
            return false;
        }
        form_submitted = true;
        $("#save_member_button").prop('disabled', true);
        $("#save_text").hide();
        $("#saving_text").show();
    });

    // Агар modal истифода мешуд барои формаи дигар
    $('.modal').on('shown.bs.modal', function () {
        $('.check_money').trigger('focus');
    });
});
</script>
