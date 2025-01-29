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


<!-- Custom styles for the ticket page -->

<style>

    body {

        background-color: #f4f4f4; /* Light background for the body */

        font-family: 'Arial', sans-serif; /* Modern font */

    }

    .container {

        margin-top: 20px; /* Space above the container */

    }

    h2 {

        color: #253d5c; /* Dark blue for headings */

        margin-bottom: 20px; /* Space below heading */

    }

    .panel-heading {

        background-color: #e9ecef; /* Light gray background for panel heading */

        border-bottom: 2px solid #253d5c; /* Dark blue border */

        padding: 15px; /* Padding for the heading */

    }

    .table {

        background: #ffffff; /* White background for the table */

        border-radius: 8px; /* Rounded corners */

        overflow: hidden; /* Prevent overflow */

        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */

    }

    .table th, .table td {

        vertical-align: middle; /* Center align content */

        text-align: center; /* Center align text */

    }

    .table th {

        background-color: #253d5c; /* Dark blue background for header */

        color: #ffffff; /* White text for header */

    }

    .table-striped > tbody > tr:nth-of-type(odd) {

        background-color: #f2f2f2; /* Light gray for odd rows */

    }

    .btn {

        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for button hover */

    }

    .btn:hover {

        background-color: #2a69ac; /* Darker blue on hover */

        color: #ffffff; /* White text on hover */

        transform: scale(1.05); /* Slightly enlarge button on hover */

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {

        padding: 0.5em 1em; /* Padding for pagination buttons */

        margin: 0 0.1em; /* Margin between buttons */

        border-radius: 5px; /* Rounded corners */

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

        background-color: #2a69ac; /* Darker blue on hover */

        color: #ffffff; /* White text on hover */

    }

</style>


<?php include('inc/container.php');?>

<div class="container">	

    <div class="row home-sections">

        <h2>e-Service System</h2>	

        <?php include('menus.php'); ?>		

    </div> 

    <div class="">   		

        <p>View and manage tickets that may have responses from the support team.</p>	


        <div class="panel-heading">

            <div class="row">

                <div class="col-md-10">

                    <h3 class="panel-title">Manage Tickets</h3>

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

                    <th>Branch</th>	

                </tr>

            </thead>

        </table>

    </div>

    <?php include('add_ticket_model.php'); ?>

</div>	

<?php include('inc/footer.php');?>