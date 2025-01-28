<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: authenticate.php");
}
include('inc/header.php');
$ticketDetails = $tickets->ticketInfo($_GET['id']);
$ticketReplies = $tickets->getTicketReplies($ticketDetails['id']);
$user = $users->getUserInfo();
$tickets->updateTicketReadStatus($ticketDetails['id']);
?>
<title>SMSYSTEM</title>
<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php'); ?>
<div class="container">
	<div class="row home-sections">
		<h2>e-Service System</h2>
		<?php include('menus.php'); ?>
	</div>

	<section class="comment-list">
		<article class="row">
			<div class="col-md-10 col-sm-10">
				<div class="panel panel-default arrow left">
				<div class="panel-heading right">
				<?php if ($ticketDetails['resolved']) { ?>
        <button type="button" class="btn btn-danger btn-sm">
            <span class="glyphicon glyphicon-eye-close"></span> Closed
        </button>
    <?php } else { ?>
        <button type="button" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-eye-open"></span> Open
        </button>
    <?php } ?>
    <a href="generate_invoice.php?ticket_id=<?php echo $ticketDetails['id']; ?>" 
       class="btn btn-primary btn-sm">
        <span class="glyphicon glyphicon-download-alt"></span> Download Invoice
    </a>
    <?php if ($ticketDetails['priority'] == 1) { ?>
        <button type="button" class="btn btn-danger btn-sm">
            <span class="glyphicon glyphicon-warning-sign"></span> High Priority
        </button>
    <?php } else { ?>
        <button type="button" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-info-sign"></span> Normal Priority
        </button>
    <?php } ?>
    <span class="ticket-title"><?php echo $ticketDetails['title']; ?></span>
</div>
<div class="panel-body">
    <div class="comment-post">
        <p>
            <?php echo nl2br(htmlspecialchars($ticketDetails['message'])); ?>
        </p>
    </div>
</div>
<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$timestamp = (int) $ticketDetails['date'];
$formattedDate = date('d-m-Y h:i:s A', $timestamp);
$isoDate = date('Y-m-d\TH:i:s', $timestamp);
?>
			
			<div class="panel-heading right">
    <div class="ticket-info">
        <div class="info-row">
            <div class="info-item">
                <strong>Date:</strong> 
                <time class="comment-date" datetime="<?php echo $isoDate; ?>"><?php echo $formattedDate; ?></time>
            </div>
            <div class="info-item">
                <strong>Ticket ID:</strong> 
                <?php echo htmlspecialchars($ticketDetails['uniqid'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>

        <div class="info-row">
            <div class="info-item">
                <strong>Created By:</strong> 
                <?php echo htmlspecialchars($ticketDetails['creater'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div class="info-item">
                <strong>Categories:</strong> 
                <?php echo htmlspecialchars($ticketDetails['department'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>

        <div class="info-row">
            <div class="info-item">
                <strong>Branch:</strong> 
                <?php echo htmlspecialchars($ticketDetails['branch'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div class="info-item">
                <strong>Priority:</strong> 
                <?php echo $ticketDetails['priority'] == 1 ? 'High' : 'Normal'; ?>
            </div>
        </div>

        <div class="info-row">
            <div class="info-item">
                <strong>Client Name:</strong> 
                <?php echo isset($ticketDetails['client_name']) ? htmlspecialchars($ticketDetails['client_name'], ENT_QUOTES, 'UTF-8') : 'N/A'; ?>
            </div>
            <div class="info-item">
                <strong>Client Phone:</strong> 
                <?php echo isset($ticketDetails['client_phone']) ? htmlspecialchars($ticketDetails['client_phone'], ENT_QUOTES, 'UTF-8') : 'N/A'; ?>
            </div>
        </div>

        <div class="info-row">
            <div class="info-item">
                <strong>Payment:</strong> 
                <?php echo htmlspecialchars($ticketDetails['payment'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div class="info-item">
                <strong>Status:</strong> 
                <?php echo $ticketDetails['resolved'] ? 'Closed' : 'Open'; ?>
            </div>
        </div>
    </div>
</div>
				</div>
			</div>
		</article>

		<?php foreach ($ticketReplies as $replies) { ?>
	<article class="row">
		<div class="col-md-10 col-sm-10">
			<div class="panel panel-default arrow right">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-time"></span>
					<time class="comment-date" datetime="<?php echo date('c', $replies['date']); ?>">
						<!-- Using ISO 8601 format -->
						<i class="fa fa-clock-o"></i>
						<?php
						date_default_timezone_set('Asia/Kuala_Lumpur'); // Set timezone to Malaysia
						echo date('d-m-Y H:i:s A', $replies['date']); // Format the Unix timestamp
						?>
					</time>
					&nbsp;&nbsp;
					<?php if ($replies['user_type'] == 'admin') { ?>
						<span class="glyphicon glyphicon-user"></span> <?php echo $replies['creater']; ?>
					<?php } else { ?>
						<span class="glyphicon glyphicon-user"></span> <?php echo $replies['creater']; ?>
					<?php } ?>
				</div>
				<div class="panel-body">
    <div class="comment-post">
        <p>
            <?php echo nl2br(htmlspecialchars($replies['message'])); ?>
        </p>
    </div>
</div>
			</div>
		</div>
	</article>
<?php } ?>


<form method="post" id="ticketReply">
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <textarea class="form-control" rows="8" id="message" name="message" 
                    placeholder="Enter your reply... (Press Enter for new line)" 
                    style="white-space: pre-wrap;" required></textarea>
            </div>
        </div>
    </article>
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="form-group">
						<input type="submit" name="reply" id="reply" class="btn btn-success" value="Reply" />
					</div>
				</div>
			</article>
			<input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
			<input type="hidden" name="action" id="action" value="saveTicketReplies" />
		</form>
	</section>
	<?php include('add_ticket_model.php'); ?>
</div>
<?php include('inc/footer.php'); ?>