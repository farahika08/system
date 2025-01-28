<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
	
	<nav class="navbar navbar-inverse" style="background: #253d5c; color: #f6f8f9; font-weight: bold;">
    <div class="container-fluid">
        <ul class="nav navbar-nav menus">
            <li id="ticket"><a href="ticket.php" class="navbar-brand">Ticket</a></li>
            <li id="dashboard"><a href="dashboard.php" class="navbar-brand">Dashboard</a></li>
            <?php if (isset($_SESSION["admin"])): ?>
                <li id="department"><a href="department.php" class="navbar-brand">Categories</a></li>
                <li id="user"><a href="user.php" class="navbar-brand">Users</a></li>
            <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="label label-pill label-danger count"></span>
                    <img src="//gravatar.com/avatar/<?php echo md5($user['email']); ?>?s=100" width="20" alt="User Avatar">&nbsp; 
                    <?php echo isset($_SESSION["userid"]) ? $user['name'] : ''; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>