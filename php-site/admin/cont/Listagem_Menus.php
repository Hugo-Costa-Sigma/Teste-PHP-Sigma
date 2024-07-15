<?php
$menus_data = fetchAllData($conn, "SELECT * FROM Menus");

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

$menus_data = fetchAllData($conn, "SELECT * FROM Menus");
?>

<body>

    <div class="container">
        <table class="table">
            <thead>
                <tr class="coluna">
                    <th scope="col">Menus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($menus_data as $menu) { ?>
                    <tr>
                        <td class="Cabecalho">
                            <div class="Menus">
                                <p><?php echo htmlspecialchars($menu['text_content']); ?></p>
                                <div class="record">
                                    <input type="hidden" value="<?php echo $menu['id']; ?>" name="delete_id"
                                        class="delete_id">
                                    <input type="hidden" value="Menus" name="delete_table" class="delete_table">
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="fa-regular btn btn-outline-danger delete-button deleteButton">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot class="pies">
                <tr>
                    <td></td>
                    <td>
                        <input type="text" class="Caixa form-control" id="menu" name="Menu_novo"
                            placeholder="Adiciona um novo menu" required>
                    </td>
                    <td><button class="Adicionar btn btn-primary">Enviar</button></td>
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
                        alert(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao apagar menu');
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.Adicionar').click(function (e) {
                e.preventDefault();

                var menu = $('#menu').val();

                if (menu === "") {
                    alert('Por favor, insira um menu.');
                    return false;
                }

                $.ajax({
                    url: '<?php echo URL::getBase(); ?>/class/upload.php',
                    type: 'POST',
                    data: {
                        Menu_novo: menu,
                    },
                    success: function (response) {
                        alert('Menu adicionado com sucesso');
                        console.log(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao adicionar menu');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>