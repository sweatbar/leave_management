<?php
if(count($result) > 0) {

foreach($result as $row) {
?>

    <tr>
        <td><?php echo $row->leave_date; ?> </td>
        <td><?php echo$row->leave_type_name; ?></td>
        <td><?php echo$row->leave_reason; ?></td>
        <td><button type='button' name='edit' class='btn btn-warning btn-xs edit' id='<?php echo$row->leave_id; ?>'>Edit</button></td>
        <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id='<?php echo$row->leave_id; ?>'>Delete</button></td>
    </tr>

<?php    
}

}
else {
?>
    <tr>
        <td colspan='4' align='center'>No leave taken so far..</td>
    </tr>
<?php

}

?>