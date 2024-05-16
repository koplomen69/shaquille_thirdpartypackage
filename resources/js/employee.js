$(document).ready(function() {
    $("#employeeTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/getEmployees",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "firstname", name: "firstname" },
            { data: "lastname", name: "lastname" },
            { data: "email", name: "email" },
            { data: "age", name: "age" },
            { data: "position.name", name: "position.name" },
            {
                data: null,
                name: "actions",
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    const fullName = `${row.firstname} ${row.lastname}`;
                    return `
                        <div class="d-flex">
                            <a href="/employees/${row.id}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                            <a href="/employees/${row.id}/edit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                            <div>
                                <form action="/employees/${row.id}" method="POST" style="display: inline-block;" class="form-delete">

                                    <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete" data-name="${fullName}">
                                        <i class="bi-trash"></i>
                                    </button>
                                </form>
                                <form action="/employees/${row.id}/deleteFile" method="POST" style="display: inline-block;">
                                    
                                    <button type="submit" class="btn btn-outline-dark btn-sm me-2" onclick="return confirm('Are you sure you want to delete this CV file?')">Delete CV File</button>
                                </form>
                            </div>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, "desc"]],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    });

    // Add event listener for delete button
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest("form");
        var name = $(this).data("name");

        Swal.fire({
            title: `Are you sure you want to delete ${name}?`,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "bg-primary",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
