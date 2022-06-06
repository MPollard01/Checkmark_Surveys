<?php require_once __DIR__.'/./header.php'?>

<div class="card shadow border-0 mx-auto" style="width: 60%;">
  <div class="card-body">
    <h5 class="card-title mb-2">Sign Up</h5>
	<h6 class="card-subtitle mb-4 text-muted">Fill in the form and start creating today!</h6>
<form action="./register" method="post" class="row g-3">
	<div class="col-md-6">
		<label class="form-label">First name</label>
		<input type="text" class="form-control" name="firstname" maxlength="20" value="" required>
		<div class="text-danger"><?php echo $errors['firstname'][0] ?? ''; ?></div>
	</div>
	<div class="col-md-6">
		<label class="form-label">Surname</label>
		<input type="text" class="form-control" name="surname" maxlength="30" value="" required>
		<div class="text-danger"><?php echo $errors['surname'][0] ?? ''; ?></div>
	</div>
	<div class="col-md-4">
		<label class="form-label">DOB</label>
		<input type="date" class="form-control" name="dob" maxlength="10" value="" required>
		<div class="text-danger"><?php echo $errors['dob'][0] ?? ''; ?></div>
	</div>
	<div class="col-md-8">
		<label class="form-label">Tel</label>
		<input type="number" class="form-control" name="tel" maxlength="50" value="" required>
		<div class="text-danger"><?php echo $errors['tel'][0] ?? ''; ?></div>
	</div>
	<div class="col-md-6">
		<label class="form-label">Username</label>
		<input type="text" class="form-control" name="username" maxlength="30" value="" required>
		<div class="text-danger"><?php echo $errors['username'][0] ?? ''; ?></div>
	</div>
	<div class="col-md-6">
		<label class="form-label">Password</label>
		<input type="password" class="form-control" name="password" maxlength="30" value="" required>
		<div class="text-danger"><?php echo $errors['password'][0] ?? ''; ?></div>
	</div>
	<div class="col-12">
		<label class="form-label">Email</label>
		<input type="email" class="form-control" name="email" maxlength="64" value="" required>
		<div class="text-danger"><?php echo $errors['email'][0] ?? ''; ?></div>
	</div>
	<div class="d-grid gap-2">
    <button type="submit" class="btn btn-primary">Sign up</button>
  </div>
   
</form>	
</div>
</div>