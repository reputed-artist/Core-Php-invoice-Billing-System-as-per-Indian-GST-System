<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable Example</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
</head>
<body>
    <form id="upload_csv" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" id="csv_file" accept=".csv">
        <input type="submit" name="upload" id="upload" value="Upload CSV">
    </form>

    <table id="data-table" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Phone</th>
                <th>Select</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here by DataTable -->
        </tbody>
    </table>

    <button id="ckbCheckAll">Check All</button>
    <button class="email_button" data-action="bulk">Send Bulk Email</button>

    <script>
        $(document).ready(function() {
            console.log("Document is ready"); // Debug line

            // Check All functionality
            $("#ckbCheckAll").click(function () {
                var oTable = $('#data-table').DataTable();
                var allPages = oTable.rows().nodes();

                if ($(this).hasClass('allChecked')) {
                    $('input[type="checkbox"]', allPages).prop('checked', false);
                } else {
                    $('input[type="checkbox"]', allPages).prop('checked', true);
                }
                $(this).toggleClass('allChecked');
            });

            // Handle email button click
            $(document).on('click', '.email_button', function() {
                console.log("Button clicked"); // Debug line

                var action = $(this).data("action");
                var email_data = [];

                if (action == 'single') {
                    var item = {
                        id: $(this).attr("id"),
                        email: $(this).data("email"),
                        name: $(this).data("name")
                    };
                    email_data.push(item);

                    var elementId = 'status_' + item.id;

                    $.ajax({
                        url: "send_mail.php",
                        method: "POST",
                        data: { email_data: item.email, name: item.name },
                        beforeSend: function() {
                            $('#' + elementId).html('Sending...');
                            $('#' + elementId).removeClass('label-default').addClass('label-warning');
                        },
                        success: function(data) {
                            handleAjaxSuccess(data, elementId);
                        },
                        error: function() {
                            handleAjaxError(elementId);
                        }
                    });
                } else {
                    $('.single_select:checked').each(function() {
                        email_data.push({
                            id: $(this).data("id"),
                            email: $(this).data("email"),
                            name: $(this).data("name")
                        });
                    });

                    email_data.forEach(function(item) {
                        var elementId = 'status_' + item.id;

                        if ($('#' + elementId).length === 0) {
                            var row = $('#data-table tbody tr').filter(function() {
                                return $(this).find('button[id="' + item.id + '"]').length > 0;
                            });
                            if (row.length > 0) {
                                row.append('<td><span id="' + elementId + '" class="label label-default">Pending</span></td>');
                            }
                        }
                    });

                    email_data.forEach(function(item) {
                        var elementId = 'status_' + item.id;

                        $.ajax({
                            url: "send_mail.php",
                            method: "POST",
                            data: { email_data: item.email, name: item.name },
                            beforeSend: function() {
                                $('#' + elementId).html('Sending...');
                                $('#' + elementId).removeClass('label-default').addClass('label-warning');
                            },
                            success: function(data) {
                                handleAjaxSuccess(data, elementId);
                            },
                            error: function() {
                                handleAjaxError(elementId);
                            }
                        });
                    });
                }
            });

            // Handle CSV upload
            $('#upload_csv').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "import.php",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(jsonData) {
                        $('#csv_file').val('');
                        $('#data-table').DataTable({
                            data: jsonData,
                            columns: [
                                { data: "student_id" },
                                { data: "student_name" },
                                { data: "student_phone" },
                                {
                                    data: function(data) {
                                        return '<input type="checkbox" class="single_select checkBoxClass btn btn-info btn-sm" name="single_select" data-id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '">';
                                    }
                                },
                                {
                                    data: function(data) {
                                        return '<input type="button" class="btn btn-info btn-xs email_button" name="email_button" value="Send Single" id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '" data-action="single">';
                                    }
                                },
                                {
                                    data: function(data) {
                                        return '<span id="status_'+ data.student_id + '" class="label label-default">Pending</span>';
                                    }
                                }
                            ],
                            paging: true,
                            lengthChange: true,
                            searching: true,
                            processing: true,
                            ordering: true,
                            info: true,
                            autoWidth: false,
                            dom: "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
                            buttons: getTableButtons(),
                            initComplete: function () {
                                var btns = $('.dt-button');
                                btns.addClass('btn btn-primary btn-sm btn-group');
                                btns.removeClass('dt-button');
                            },
                            lengthMenu: [[100, 50, 150, -1], [100, 50, 150, "All"]]
                        });
                    }
                });
            });
        });

        function handleAjaxSuccess(data, elementId) {
            data = $.trim(data);

            if (data === "ok") {
                $('#' + elementId).html('&#10003; Success');
                $('#' + elementId).removeClass('label-default').addClass('label-success');
            } else {
                $('#' + elementId).html(data);
                $('#' + elementId).removeClass('label-warning').addClass('label-danger');
            }
        }

        function handleAjaxError(elementId) {
            $('#' + elementId).html('Failed');
            $('#' + elementId).removeClass('label-warning').addClass('label-danger');
        }

        function getTableButtons() {
            return [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o">&nbsp; Copy </i>',
                    className: "btn-sm btn btn-danger",
                    titleAttr: 'Copy',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
                    className: "btn-sm btn btn-danger",
                    titleAttr: 'Excel',
                    title: 'AdminLT || Clients Data',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ];
        }
    </script>
</body>
</html>
