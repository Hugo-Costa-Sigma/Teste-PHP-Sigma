
    <?php
    $banners_data = fetchAllData($conn, "SELECT * FROM banners");

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

    $banners_data = fetchAllData($conn, "SELECT * FROM banners");
    ?>



    <div class="container">
        <table class="table">
            <thead>
                <tr class="coluna">
                    <th scope="col">Banners</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rowCount = count($banners_data);
                for ($i = 0; $i < $rowCount; $i++) { ?>
                    <tr>
                        <td class="Cabecalho">
                            <div class="banners">
                                <p><img width="100" src="<?php echo $banners_data[$i]['url_banners']; ?>"></p>
                                <div class="record">
                                    <input type="text" value="<?php echo $banners_data[$i]['id']; ?>" name="delete_id"
                                        style="display:none;" class="delete_id">
                                    <input type="text" value="banners" name="delete_table" style="display:none;"
                                        class="delete_table">

                                </div>
                            </div>
                        </td>
                        <td> <button class="fa-regular btn btn-outline-danger delete-button deleteButton">
                                <i class="fa-regular fa-trash-can"></i>
                            </button></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot class="pies">
                <tr>

                    <td>
                        <input type="text" class="Caixa form-control" id="banner" name="banner_novo"
                            placeholder="Adiciona um novo banner" required>
                        <button form="form" type="submit" class="Adicionar btn btn-primary">Enviar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('.deleteButton').click(function () {
                var record = $(this).closest('tr');
                var delete_id = record.find('.delete_id').val();
                var delete_table = record.find('.delete_table').val();

                $.ajax({
                    url: '<?php echo URL::getBase(); ?>/class/excluir.php',
                    type: 'POST',
                    data: {
                        delete_id: delete_id,
                        delete_table: delete_table
                    },
                    success: function (response) {
                        alert('Banner apagado com sucesso');
                        console.log(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao apagar banner');
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.Adicionar').click(function (e) {
                e.preventDefault();

                var banner = $('#banner').val();

                if (banner === "") {
                    alert('Por favor, insira um URL de banner.');
                    return false;
                }

                $.ajax({
                    url: '<?php echo URL::getBase(); ?>/class/upload.php',
                    type: 'POST',
                    data: {
                        banner_novo: banner,
                    },
                    success: function (response) {
                        alert('Banner adicionado com sucesso');
                        console.log(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao adicionar banner');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
