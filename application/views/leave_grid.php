<html>
<head>
    <title>Leave List</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/datepicker.js" ></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/leaveform.js" ></script>
    
</head>
<body>
    <div class="container">
        <br />
        <h3 align="center">User Leave List</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title user-header"><?php echo $_SESSION['employee_name'] . '\'s leave data'; ?></h3>
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" id="add_leave" class="btn btn-info btn-xs add_leave">Add Leave</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Leave Date</th>
                            <th>Leave Type</th>
                            <th>Leave Rason</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $_SESSION['employee_id']; ?>"/>
                    <label>Employee Name *</label>
                    <input type="text" name="employee_name" id="employee_name" class="form-control" value="<?php echo $_SESSION['employee_name']; ?>" disabled/>
                    <span id="employee_name_error" class="text-danger"></span>
                    <br />
                    <label>Leave Date *</label>
                    <input class="form-control" id="leave_date" name="leave_date" placeholder="YYY-MM-DD" type="text"/>
                    <span id="leave_date_error" class="text-danger"></span>
                    <br />
                    <label>Leave Type *</label>
                    <select type="text" name="leave_type_id" id="leave_type_id" class="form-control">
                        <?php
                            foreach ($leave_types as $leave_type) {
                                echo "<option value='".$leave_type['leave_type_id'] ."'>".$leave_type['leave_type_name'] ."</option>";
                            }
                        ?>
                    </select>    
                    <span id="leave_type_error" class="text-danger"></span>
                    <br />
                    <label>Leave Reason</label>
                    <textarea type="text" name="leave_reason" id="leave_reason" class="form-control"></textarea>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="leave_id" id="leave_id" value=""/>
                    <input type="hidden" name="data_action" id="data_action" value="insert"/>
                    <input type="submit" name="action" id="action" class="btn btn-success action" value="Add Leave"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
