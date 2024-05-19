<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список покупок</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>

<body>
    <div class="container">

        <table>
            <thead>
                <tr>
                    <th class="sortable" data-sort="id" data-order="asc">ID</th>
                    <th class="sortable" data-sort="name" data-order="asc">VALUE</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="shoppingTable">
                <!-- AJAX Content -->
            </tbody>
        </table>
        <form id="addForm" class="add-item-form" method="post">
            <input type="text" name="item_name" id="item_name" required>
            <br>
            <button type="submit">Добавить</button>
        </form>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadTableData() {
                $.ajax({
                    url: 'index_ajax.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var rows = response.data;
                            $("#shoppingTable").html('');
                            rows.forEach(function(item) {

                                $('#shoppingTable').append(
                                    `<tr>` +
                                    '<td>' + item.id + '</td>' +
                                    '<td>' + item.value + '</td>' +
                                    `<td><a href="items/edit_item.php?id=${item.id}">Edit</a></td>` +
                                    `<td><a href="#" class="deleteItem" data-id="${item.id}">Delete</a></td>` +
                                    '</tr>'
                                );
                            });
                        } else {
                            alert(response.error);
                        }
                    }
                });
            }

            loadTableData();

            $(document).on('click', '.deleteItem', function(e) {
                e.preventDefault();
                var itemId = $(this).data('id');
                $.ajax({
                    url: 'items/delete_item.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        itemId: itemId
                    },
                    success: function(response) {
                        if (response.success) {
                            loadTableData();
                        } else {
                            alert(response.error);
                        }
                    }
                });
            });

            $("#addForm").on("submit", function(event) {
                event.preventDefault();

                var itemName = $('#item_name').val();

                $.ajax({
                    url: 'items/add_item.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        itemName: itemName
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#addForm')[0].reset();
                            loadTableData();
                        } else {
                            alert(response.error);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>