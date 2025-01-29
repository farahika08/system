<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        /* Custom styles for the navbar */
        body {
            font-family: 'Arial', sans-serif; /* Modern font */
            background-color: #f4f4f4; /* Light background for the body */
        }
        .navbar {
            background: linear-gradient(90deg, #1e3c72, #2a69ac); /* Blue gradient background */
            color: #f6f8f9; /* Light text color */
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            padding: 15px 20px; /* Increased padding for height */
        }
        .navbar-brand, .nav > li > a {
            color: #f6f8f9 !important; /* Light text color for links */
            transition: color 0.3s; /* Smooth color transition */
            font-size: 16px; /* Increased font size */
            padding: 10px 15px; /* Add padding for better click area */
        }
        .navbar-brand:hover, .nav > li > a:hover {
            color: #ffffff !important; /* White on hover */
            text-decoration: underline; /* Underline on hover */
        }
        .dropdown-menu {
            background-color: #ffffff; /* White background for dropdown */
            border-radius: 0; /* Remove border radius for a sharper look */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for dropdown */
        }
        .dropdown-menu > li > a {
            color: #253d5c; /* Dark text color for dropdown items */
            padding: 10px 15px; /* Add padding for dropdown items */
        }
        .dropdown-menu > li > a:hover {
            background-color: #e2e2e2; /* Light gray on hover */
        }
        .user-avatar {
            border-radius: 50%; /* Circular avatar */
            margin-right: 5px; /* Space between avatar and name */
        }
        .navbar-toggler {
            border: none; /* Remove border from toggler */
        }
        .navbar-toggler-icon {
            background-color: #f6f8f9; /* Toggler icon color */
        }
    </style>
</head>
<body>
	
	<nav class="navbar navbar-inverse" style="background: #253d5c; color: #f6f8f9; font-weight: bold;">
    <div class="container-fluid">
    <ul class="nav navbar-nav menus">
                    <li id="ticket" class="nav-item">
                        <a href="ticket.php" class="nav-link"><i class="fas fa-ticket-alt"></i> Ticket</a>
                    </li>
                    <li id="dashboard" class="nav-item">
                        <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <?php if (isset($_SESSION["admin"])): ?>
                        <li id="department" class="nav-item">
                            <a href="department.php" class="nav-link"><i class="fas fa-th-list"></i> Categories</a>
                        </li>
                        <li id="user" class="nav-item">
                            <a href="user.php" class="nav-link"><i class="fas fa-users"></i> Users</a>
                        </li>
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