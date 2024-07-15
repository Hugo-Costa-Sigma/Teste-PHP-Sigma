<?php
$rede_name_data = fetchAllData($conn, "SELECT rede_name, id FROM footer WHERE rede_name IS NOT NULL");
$rede_url_data = fetchAllData($conn, "SELECT rede_url, id FROM footer WHERE rede_url IS NOT NULL");

function fetchAllData($conn, $query)
{
    $query_result = sqlsrv_query($conn, $query);
    if ($query_result == false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($query_result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
    return $data;
}
?>



<div class="container">
    <table class="table">
        <thead>
            <tr class="coluna">
                <th>Icon da Rede</th>
                <th>Url da Rede</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rowCount = max(count($rede_name_data), count($rede_url_data));

            for ($i = 0; $i < $rowCount; $i++) {
                if (!empty($rede_name_data[$i]['rede_name'])) {
                    ?>
                    <tr>
                        <td class="Cabecalho">
                            <div class="rede">
                                <p><?php echo $rede_name_data[$i]['rede_name']; ?></p>
                                <div class="record">
                                    <input type="text" value="<?php echo $rede_name_data[$i]['id']; ?>" name="delete_id"
                                        style="display:none;" class="delete_id">
                                    <input type="text" value="rede_name" name="delete_table" style="display:none;"
                                        class="delete_table">
                                </div>
                            </div>
                        </td>
                        <td class="Cabecalho">
                            <p><?php echo $rede_url_data[$i]['rede_url']; ?></p>
                            <div class="record">
                                <input type="text" value="<?php echo $rede_url_data[$i]['id']; ?>" name="edit_id"
                                    style="display:none;" class="edit_id">
                                <input type="text" value="rede_url" name="edit_table" style="display:none;" class="edit_table">
                            </div>
                        </td>
                        <td><button data-id="<?php echo $rede_url_data[$i]['id']; ?>"
                                class="apaga_rede fa-regular btn btn-outline-danger edit-button editButton">
                                <i class="fa-regular fa-trash-can"></i>
                            </button></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
        <tfoot class=>
            <tr>

                <td>
                    <input type="text" class="Caixa form-control" id="rede_name_novo" name="rede_name_novo"
                        placeholder="Icon da rede" required>
                </td>
                <td>
                    <input type="text" class="Caixa form-control" id="rede_url_novo" name="rede_url_novo"
                        placeholder="Url da rede" required>
                </td>
                <td><button form="form" type="submit" class="Adicionar btn btn-primary">Enviar</button></td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('.apaga_rede').click(function () {
            var meu_id = $(this).attr("data-id");
            var edit_type = 'rede';

            $.ajax({
                url: '<?php echo URL::getBase(); ?>/class/editar.php',
                type: 'POST',
                data: {
                    edit_id: meu_id,
                    edit_type: edit_type
                },
                success: function (response) {
                    alert('Rede apagada com sucesso');
                    console.log(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Erro ao apagar rede');
                    console.error(xhr.responseText);
                }
            });
        });

        $('.Adicionar').click(function (e) {
            e.preventDefault();
            var meu_id = $(this).attr("data-id");
            var rede = $('#rede_name_novo').val();
            var url = $('#rede_url_novo').val();

            if (rede === "" || url === "") {
                alert('Por favor, insira um nome e uma URL para a rede.');
                return false;
            }

            $.ajax({
                url: '<?php echo URL::getBase(); ?>/class/upload.php',
                type: 'POST',
                data: {
                    edit_id: meu_id,
                    edit_type: 'rede',
                    rede_name_novo: rede,
                    rede_url_novo: url
                },
                success: function (response) {
                    alert(response);
                    console.log(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Erro ao adicionar rede');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>