<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
	
	<nav class="navbar navbar-inverse"style="background: #253d5c; color: #f6f8f9; font-weight: bold;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li id="ticket">
                    <a href="ticket.php">
                        <i class="fas fa-ticket-alt"></i> Tickets
                    </a>
                </li>
                <li id="dashboard">
                    <a href="dashboard.php">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <?php if (isset($_SESSION["admin"])): ?>
                    <li id="department">
                        <a href="department.php">
                            <i class="fas fa-folder"></i> Categories
                        </a>
                    </li>
                    <li id="user">
                        <a href="user.php">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                        <span class="label label-pill label-danger count"></span>
                        <img src="//gravatar.com/avatar/<?php echo md5($user['email']); ?>?s=100" 
                             alt="<?php echo htmlspecialchars($user['name']); ?>" class="user-image">
                        <span class="user-name"><?php echo isset($_SESSION["userid"]) ? htmlspecialchars($user['name']) : ''; ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>