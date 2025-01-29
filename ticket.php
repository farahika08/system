<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
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
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">	
	<div class="row home-sections">
	<h2>e-Service System</h2>	
	<?php include('menus.php'); ?>		
	</div> 
	<div class="">   		
		<p>View and manage tickets that may have responses from support team.</p>	

		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="createTicket" class="btn btn-success btn-xs">Create Ticket</button>
				</div>
			</div>
		</div>
		<table id="listTickets" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>S/N</th>
					<th>Ticket ID</th>
					<th>Subject</th>
					<th>Categories</th>
					<th>Created By</th>					
					<th>Created</th>	
					<th>Status</th>
					<th>View</th>
					<th>Edit</th>
					<th>Close</th>
					<th>Delete</th>			
				</tr>
			</thead>
			<tbody>
				<!-- Existing rows will be populated here -->
			</tbody>
		</table>
	</div>
	<?php include('add_ticket_model.php'); ?>
</div>	
<?php include('inc/footer.php');?>