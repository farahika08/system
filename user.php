<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<title>SMSYSTEM</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/user.js"></script>

<script>
	$(document).ready(function () {
		$('#role').change(function () {
			if ($(this).val() == 'technician') {
				$('#specializationGroup').show();
			} else {
				$('#specializationGroup').hide();
			}
		});
	});
</script>

<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php'); ?>

<div class="container">
	<div class="row home-sections">
		<h2>e-Service System</h2>
		<?php include('menus.php'); ?>
	</div>

	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add New</button>
			</div>
		</div>
	</div>

	<table id="listUser" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>S/N</th>
				<th>Name</th>
				<th>Email</th>
				<th>Created</th>
				<th>Role</th>
				<th>Status</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
	</table>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="userForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add New</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userName" class="control-label">Name*</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="User name" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="role" class="control-label">Role*</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="technician">Technician</option>
                        </select>
                    </div>

                    <div class="form-group" id="specializationGroup" style="display:none;">
                        <label for="specialization" class="control-label">Specialization*</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Specialization">
                    </div>

                    <div class="form-group">
                        <label for="newPassword" class="control-label">Password*</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value="addUser">
                    <input type="submit" name="save" id="save" class="btn btn-info" value="Add">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('inc/footer.php'); ?>