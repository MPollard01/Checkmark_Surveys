<?php require_once __DIR__.'/./header.php'?>
<div class="card shadow border-0 mx-auto" style="width: 60%;">
  <div class="card-body">
    <h5 class="card-title mb-2">Sign In</h5>
    <form action="./login" method="post" class="row g-3" novalidate>
	<div class="col-12">
		<label class="form-label">Username</label>
		<input type="text" class="form-control" name="username" maxlength="30" aria-describedby="invalid-1" required>
		<div class="text-danger" id="invalid-1"><?php echo $errors['username'][0] ?? ''; ?></div>
	</div>
	<div class="col-12">
		<label class="form-label">Password</label>
		<input type="password" class="form-control" name="password" maxlength="30" value="" required>
		<div class="text-danger"><?php echo $errors['password'][0] ?? ''; ?></div>
	</div>
	<div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Sign In</button>
    </div>
  </form>	
 </div>
</div>