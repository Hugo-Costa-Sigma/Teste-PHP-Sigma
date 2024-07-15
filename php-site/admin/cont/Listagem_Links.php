<?php
    $link_name_data = fetchAllData($conn, "SELECT link_name, id FROM footer WHERE link_name IS NOT NULL");
    $link_url_data = fetchAllData($conn, "SELECT link_url, id FROM footer WHERE link_url IS NOT NULL");

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
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="coluna">
                    <th>Nome do Link</th>
                    <th>URL do Link</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rowCount = max(count($link_name_data), count($link_url_data));

                for ($i = 0; $i < $rowCount; $i++) {
                    if (!empty($link_name_data[$i]['link_name'])) {
                        ?>
                        <tr>
                            <td class="Cabecalho">
                                <div class="Link">
                                    <p><?php echo $link_name_data[$i]['link_name']; ?></p>
                                    <div class="record">
                                        <input type="text" value="<?php echo $link_name_data[$i]['id']; ?>" name="delete_id"
                                            style="display:none;" class="delete_id">
                                        <input type="text" value="link_name" name="delete_table" style="display:none;"
                                            class="delete_table">
                                    </div>
                                </div>
                            </td>
                            <td class="Cabecalho">
                                <p><?php echo $link_url_data[$i]['link_url']; ?></p>
                                <div class="record">
                                    <input type="text" value="<?php echo $link_url_data[$i]['id']; ?>" name="edit_id"
                                        style="display:none;" class="edit_id">
                                    <input type="text" value="link_url" name="edit_table" style="display:none;"
                                        class="edit_table">
                                </div>
                            </td>
                            <td> <button data-id="<?php echo $link_url_data[$i]['id']; ?>"
                                    class="apaga_link fa-regular btn btn-outline-danger edit-button editButton">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button></td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <input type="text" class="Caixa form-control" id="link_name_novo" name="link_name_novo"
                            placeholder="Nome do Link" required>
                    </td>
                    <td>
                        <input type="text" class="Caixa form-control" id="link_url_novo" name="link_url_novo"
                            placeholder="URL do Link" required>
                    </td>
                    <td><button form="form" type="submit" class="Adicionar btn btn-primary">Enviar</button></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('.apaga_link').click(function () {
                var meu_id = $(this).attr("data-id");
                var edit_type = 'link';

                $.ajax({
                    url: '<?php echo URL::getBase(); ?>/class/editar.php',
                    type: 'POST',
                    data: {
                        edit_id: meu_id,
                        edit_type: edit_type,
                    },
                    success: function (response) {
                        alert('Link apagado com sucesso');
                        console.log(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao apagar link');
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.Adicionar').click(function (e) {
                e.preventDefault();

                var link_name = $('#link_name_novo').val();
                var link_url = $('#link_url_novo').val();

                if (link_name === "" || link_url === "") {
                    alert('Por favor, insira um nome e uma URL para o link.');
                    return false;
                }

                $.ajax({
                    url: '<?php echo URL::getBase(); ?>/class/upload.php',
                    type: 'POST',
                    data: {
                        link_name_novo: link_name,
                        link_url_novo: link_url
                    },
                    success: function (response) {
                        alert('Link adicionado com sucesso');
                        console.log(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao adicionar link');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

