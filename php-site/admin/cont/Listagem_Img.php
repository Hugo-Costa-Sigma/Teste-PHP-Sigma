<?php
    $imgs_data = fetchAllData($conn, "SELECT * FROM imagens");

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

    $imgs_data = fetchAllData($conn, "SELECT * FROM imagens"); ?>

<tr>
    <body>
        <div class="container">
            <table class="table">
                <thead>
                    <tr class="coluna">
                        <th scope="col">Imagens</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rowCount = count($imgs_data);
                    for ($i = 0; $i < $rowCount; $i++) { ?>
                        <tr>
                            <td class="Cabecalho">
                                <div class="Imagens">
                                    <p><img width=100 src="<?php echo $imgs_data[$i]['url_imagens']; ?>"></p>
                                    <div class="record">
                                        <input type="text" value="<?php echo $imgs_data[$i]['id']; ?>" name="delete_id"
                                            style="display:none;" class="delete_id">
                                        <input type="text" value="imagens" name="delete_table" style="display:none;"
                                            class="delete_table">

                                    </div>
                                </div>
                            </td>
                            <td><button class="fa-regular btn btn-outline-danger delete-button deleteButton">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="pies">
                    <tr>
                        <td>

                        </td>
                        <td>

                            <input type="text" class="Caixa form-control" id="imagem" name="imagem_nova"
                                placeholder="Adiciona um imagem novo" required>

                            <button form="form" type="submit" class="Adicionar btn btn-primary">Enviar</button>

                        </td>
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
                            alert('Imagem apagada com sucesso');
                            console.log(response);
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert('Erro ao apagar imagem');
                            console.error(xhr.responseText);
                        }
                    });
                });

                $('.Adicionar').click(function (e) {
                    e.preventDefault();

                    var imagem = $('#imagem').val();

                    if (imagem === "") {
                        alert('Por favor, insira uma URL de imagem.');
                        return false;
                    }

                    $.ajax({
                        url: '<?php echo URL::getBase(); ?>/class/upload.php',
                        type: 'POST',
                        data: {
                            imagem_nova: imagem,
                        },
                        success: function (response) {
                            alert('Imagem adicionada com sucesso');
                            console.log(response);
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert('Erro ao adicionar imagem');
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>



