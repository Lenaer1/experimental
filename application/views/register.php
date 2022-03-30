    <!DOCTYPE html>
    <html>
    <head>
    	<meta charset="utf-8">
    	<title>CodeIgniter Signup with Email Verification</title>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
    	<h1 class="page-header text-center">CodeIgniter Signup with Email Verification</h1>
    	<div class="row">
    		<div class="col-sm-4">
    			<?php
    		    	if(validation_errors()){
    		    		?>
    		    		<div class="alert alert-info text-center">
    		    			<?php echo validation_errors(); ?>
    		    		</div>
    		    		<?php
    		    	}
     
    				if($this->session->flashdata('message')){
    					?>
    					<div class="alert alert-info text-center">
    						<?php echo $this->session->flashdata('message'); ?>
    					</div>
    					<?php
    					unset($_SESSION['message']);
    				}	
    		    ?>
    			<h3 class="text-center">Signup Form</h3>
    			<form method="POST" action="<?php echo base_url().'saveregister'; ?>">
    				<div class="form-group">
    					<label for="email">Email:</label>
    					<input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
    				</div>
    				<div class="form-group">
    					<label for="password">Password:</label>
    					<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
    				</div>
    				<div class="form-group">
    					<label for="password_confirm">Confirm Password:</label>
    					<input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>">
    				</div>
    				<button type="submit" class="btn btn-primary">Register</button>
    			</form>
    		</div>
    		<div class="col-sm-8">
    			<h3 class="text-center">Users Table</h3>
    			<table class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>UserID</th>
    						<th>Email</th>
    						<th>Password</th>
    						<th>Code</th>
    						<th>Active</th>
    					</tr>
    				</thead>
    				<tbody>
    				<?php
    					foreach($users as $row){
    						?>
    						<tr>
    							<td><?php echo $row->id; ?></td>
    							<td><?php echo $row->email; ?></td>
    							<td><?php echo $row->password; ?></td>
    							<td><?php echo $row->code; ?></td>
    							<td><?php echo $row->active ? 'True' : 'False'; ?></td>
    						</tr>
    						<?php
    					}
    				?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
    </body>
    </html>