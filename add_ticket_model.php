<div id="ticketModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="ticketForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Ticket</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="client_name" class="control-label">Client Name</label>
						<input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter client name" required>
					</div>
					<div class="form-group">
						<label for="client_phone" class="control-label">Client Phone</label>
						<input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="Enter client phone number" required>
					</div>
					<div class="form-group"
						<label for="subject" class="control-label">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>			
					</div>
					<div class="form-group">
						<label for="branch" class="control-label">Branch</label>              
						<select id="branch" name="branch" class="form-control" required>
							<option value=""></option>
							<option value="Panji">Panji</option>             
							<option value="KTCC">KTCC</option>  
						</select>                       
					</div>
					<div class="form-group">
						<label for="department" class="control-label">Categories</label>							
						<select id="department" name="department" class="form-control" placeholder="Department...">		
						<option value="admin"></option>				
							<?php $tickets->getDepartments(); ?>
						</select>						
					</div>	
					<div class="form-group">
						<label for="status" class="control-label">Status</label>							
						<select id="status" name="status" class="form-control" required>
						<option value="0"></option>	
						<option value="0">Open</option>
							<?php if(isset($_SESSION["admin"])) { ?>
								<option value="1">Close</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="priority" class="control-label">Priority</label>							
						<select id="priority" name="priority" class="form-control" required>
						<option value="0"></option>	
						<option value="0">Normal</option>
							<option value="1">High</option>
						</select>
					</div>					
					<div class="form-group">
						<label for="message" class="control-label">Message</label>							
						<textarea class="form-control" rows="5" id="message" name="message"></textarea>							
					</div>	
					<div class="form-group">
    <label for="payment" class="control-label">Payment (RM)</label>
    <input type="number" step="0.01" class="form-control" id="payment" name="payment" placeholder="Enter payment amount" required>
</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="ticketId" id="ticketId" />
					<input type="hidden" name="action" id="action" value="" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>