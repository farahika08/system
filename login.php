<?php

include 'init.php';

if ($users->isLoggedIn()) {
    header('Location: ticket.php');
}

$errorMessage = $users->login();

include('inc/header.php');

?>

<title>Service System</title>

<!-- Inline CSS for the Login Page -->
<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f2f5; /* Light background color for the page */
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

/* Login Box Container */
.container {
    width: 100%;
    max-width: 500px; /* Max width of the login box */
    padding: 0 20px;
}

/* Centered Login Form */
.contact {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    text-align: center;
}

/* Heading */
.contact h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Panel Heading */
.panel-heading {
    background-color: #00796B;
    color: white;
    padding: 12px;
    font-size: 1.2rem;
    font-weight: bold;
    border-radius: 5px 5px 0 0;
}

/* Input Fields */
.input-group {
    margin-bottom: 20px;
    position: relative;
}

/* Style input fields */
.form-control {
    width: 100%;
    padding: 15px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fafafa;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    border-color: #00796B;
    box-shadow: 0 0 8px rgba(0, 121, 107, 0.3);
    outline: none;
}

/* Error Message Styles */
#login-alert {
    color: white;
    background-color: #f44336;
    border-radius: 5px;
    padding: 12px;
    margin-bottom: 20px;
    font-size: 1rem;
}

/* Normal Login Button Styles */
.btn-success {
    width: 100%;
    padding: 14px;
    font-size: 1.2rem;
    background-color: #00796B;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 121, 107, 0.2); /* Subtle shadow for depth */
}

/* Button Focus State */
.btn-success:focus {
    outline: none;
    box-shadow: 0 0 8px rgba(0, 121, 107, 0.5); /* Focus effect */
}

/* Responsive Design */
@media (max-width: 576px) {
    .contact {
        padding: 20px;
        max-width: 100%;
    }

    .panel-heading {
        font-size: 1.1rem;
    }

    .btn-success {
        font-size: 1.1rem;
    }
}
</style>

<?php include('inc/container.php');?>

<!-- Login Form -->
<div class="container">
    <div class="contact">
        <h2>Service System</h2>    

        <div class="panel panel-info">

            <div class="panel-heading">
                <div class="panel-title">User Login</div>                        
            </div>

            <div class="panel-body">

                <?php if ($errorMessage != '') { ?>
                    <div id="login-alert" class="alert alert-danger"><?php echo $errorMessage; ?></div>                            
                <?php } ?>

                <form id="loginform" method="POST" action="">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" value="Login" class="btn btn-success">                        
                        </div>                      
                    </div>

                </form>

            </div>                    
        </div>  

    </div>
</div>

<?php include('inc/footer.php');?>

