<?php
include 'init.php'; // Includes the database connection and required classes

if (!$users->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

// Fetch total tickets
$totalTicketsQuery = $db->query("SELECT COUNT(*) AS totalTickets FROM hd_tickets");
$totalTickets = $totalTicketsQuery->fetch_assoc()['totalTickets'];

// Fetch total open tickets
$totalOpenTicketsQuery = $db->query("SELECT COUNT(*) AS totalOpenTickets FROM hd_tickets WHERE resolved = 0");
$totalOpenTickets = $totalOpenTicketsQuery->fetch_assoc()['totalOpenTickets'];

// Fetch total closed tickets
$totalClosedTicketsQuery = $db->query("SELECT COUNT(*) AS totalClosedTickets FROM hd_tickets WHERE resolved = 1");
$totalClosedTickets = $totalClosedTicketsQuery->fetch_assoc()['totalClosedTickets'];

// Fetch user activity
$userActivityQuery = $db->query("
    SELECT u.name AS userName, COUNT(t.id) AS ticketsCreated 
    FROM hd_users u 
    LEFT JOIN hd_tickets t ON u.id = t.user 
    GROUP BY u.name
");
$userActivity = [];
while ($row = $userActivityQuery->fetch_assoc()) {
    $userActivity[] = $row;
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
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">	
	<div class="row home-sections">
	<h2>e-Service System</h2>	
	<?php include('menus.php'); ?>		
	</div> 

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - e-Service System</title>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/general.js"></script>
    <script src="js/tickets.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">    
        <h2>Dashboard</h2>    
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Total Tickets</div>
                    <div class="panel-body">
                        <h3><?php echo htmlspecialchars($totalTickets); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Open Tickets</div>
                    <div class="panel-body">
                        <h3><?php echo htmlspecialchars($totalOpenTickets); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">Closed Tickets</div>
                    <div class="panel-body">
                        <h3><?php echo htmlspecialchars($totalClosedTickets); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <canvas id="userActivityChart"></canvas>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('userActivityChart').getContext('2d');
            const userActivityData = <?php echo json_encode($userActivity); ?>;

            const labels = userActivityData.map(activity => activity.userName);
            const data = userActivityData.map(activity => activity.ticketsCreated);

            const userActivityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tickets Created by Users',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <?php include('inc/footer.php'); ?>
</body>
</html>