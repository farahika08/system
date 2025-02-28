$(document).ready(function() {        
    var departmentData = $('#listDepartment').DataTable({
        "searching": false,
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "department_action.php",
            type: "POST",
            data: { action: 'listDepartment' },
            dataType: "json",
            error: function(xhr, error, thrown) {
                console.error("Error fetching data: ", error);
                alert("An error occurred while fetching data. Please check the console for details.");
            }
        },
        "columnDefs": [
            {
                "targets": [0, 3, 4], // Adjust based on your actual columns
                "orderable": false,
            },
        ],
        "pageLength": 10,
        "createdRow": function(row, data, dataIndex) {
            // Set the S/N based on the current index
            $('td:eq(0)', row).html(dataIndex + 1); // Assuming the first column is for S/N
        }
    });    

    $(document).on('click', '.update', function() {
        var departmentId = $(this).attr("id");
        var action = 'getDepartmentDetails';
        $.ajax({
            url: 'department_action.php',
            method: "POST",
            data: { departmentId: departmentId, action: action },
            dataType: "json",
            success: function(data) {
                $('#departmentModal').modal('show');
                $('#departmentId').val(data.id);
                $('#department').val(data.name);
                $('#status').val(data.status);                
                $('.modal-title').html("<i class='fa fa-plus'></i> Edit Department");
                $('#action').val('updateDepartment');
                $('#save').val('Save');
            },
            error: function(xhr, error, thrown) {
                console.error("Error fetching department details: ", error);
                alert("An error occurred while fetching department details. Please check the console for details.");
            }
        });
    });        

    $('#addDepartment').click(function() {
        $('#departmentModal').modal('show');
        $('#departmentForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Department");
        $('#action').val('addDepartment');
        $('#save').val('Save');
    });    

    $(document).on('submit', '#departmentForm', function(event) {
        event.preventDefault();
        $('#save').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url: "department_action.php",
            method: "POST",
            data: formData,
            success: function(data) {                
                $('#departmentForm')[0].reset();
                $('#departmentModal').modal('hide');                
                $('#save').attr('disabled', false);
                departmentData.ajax.reload(null, false); // Reload the data without resetting the paging
            },
            error: function(xhr, error, thrown) {
                console.error("Error adding/updating department: ", error);
                alert("An error occurred while adding/updating the department. Please check the console for details.");
                $('#save').attr('disabled', false);
            }
        });
    });            

    $(document).on('click', '.delete', function() {
        var departmentId = $(this).attr("id");        
        var action = "deleteDepartment";
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "department_action.php",
                method: "POST",
                data: { departmentId: departmentId, action: action },
                success: function(data) {                    
                    departmentData.ajax.reload(null, false); // Reload the data without resetting the paging
                },
                error: function(xhr, error, thrown) {
                    console.error("Error deleting department: ", error);
                    alert("An error occurred while deleting the department. Please check the console for details.");
                }
            });
        } else {
            return false;
        }
    });    
});