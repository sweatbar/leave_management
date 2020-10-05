$(document).ready(function() {

    function list_employee_leave() {
        $.ajax({
            url: base_url + 'leaveGrid/fetchEmployeeLeave',
            method: 'POST',
            data: {
                data_action : 'fetch_all',
            },
            success: function(dataResult) {
                console.log(dataResult);
                $('tbody').html(dataResult);
            }
        })
    }

    list_employee_leave();

    $('.add_leave').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text('Add leave');
        $('#action').val('Add leave');
        $('#data_action').val('insert');
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        var formData = $(this).serializeArray();
        formData.push({name: "employee_name", value: $('#employee_name').val()});
        console.log(formData);

        $.ajax({
            url: base_url + 'leaveGrid/addEditLeave',
            method: 'POST',
            data: formData,
            dataType: "json",
            success: function(dataResult) {
                console.log(dataResult);
                if(dataResult.success) {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    list_employee_leave();

                    if($('#data_action').val() == 'insert') {
                        $('#success_message').html('<div class="alert alert-success"> Leave added successfully...</div>')
                    }

                    if($('#data_action').val() == 'update') {
                        $('#success_message').html('<div class="alert alert-success"> Leave updated successfully...</div>')
                    }
                }
                if(dataResult.error) {
                    console.log(dataResult);
                    $('#employee_name_error').html(dataResult.employee_name_error);
                    $('#leave_date_error').html(dataResult.leave_date_error);
                    $('#leave_type_error').html(dataResult.leave_type_error);
                }
            },
            error: function(jqxhr, status, exception) {
                console.log('Exception:', exception);
                console.log('status:', status);
                console.log('jqxhr:', jqxhr);
            }
        });
    });

    $(document).on('click', '.delete', function(){
        var leave_id = $(this).attr('id');
        console.log(leave_id + ' ' + base_url + 'leaveGrid/deleteLeave');

        if(confirm("Are you sure you want to delete this?")) {

            $.ajax({
                url: base_url + 'leaveGrid/deleteLeave',
                method: "POST",
                data: {
                    leave_id:leave_id,
                    data_action:'delete', 
                },
                dataType:"json",
                success: function(dataResult) {
                    console.log(dataResult);
                    if(dataResult.success) {
                        $('#success_message').html('<div class="alert alert-success"> Leave deleted successfully...</div>');
                        list_employee_leave();
                    }
                },
                error: function(jqxhr, status, exception) {
                    console.log('Exception:', exception);
                    console.log('status:', status);
                    console.log('jqxhr:', jqxhr);
                }
            });

        }

          
    });

    $(document).on('click', '.edit', function(event){

        var leave_id = $(this).attr('id');
        console.log(leave_id);

        $.ajax({
            url: base_url + 'leaveGrid/fetchLeave',
            method: 'POST',
            data: {
                leave_id : leave_id,
                data_action:'fetch_single',
            },
            dataType: "json",
            success: function(dataResult) {
                $('#employee_id').val(dataResult.employee_id);
                $('#employee_name').val(dataResult.employee_name);
                $('#leave_date').val(dataResult.leave_date);
                $('#leave_type_id').val(dataResult.leave_type_id);
                $('#leave_reason').val(dataResult.leave_reason);
                $('#leave_id').val(dataResult.leave_id);
                $('#userModal').modal('show');

                $('.modal-title').text('Update Leave');
                $('#action').val('Update Leave');
                $('#data_action').val('update');
                console.log(dataResult);
            },
            error: function(jqxhr, status, exception) {
                console.log('Exception:', exception);
                console.log('status:', status);
                console.log('jqxhr:', jqxhr);
            }
        });
    });

    

});