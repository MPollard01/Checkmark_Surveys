<?php require_once __DIR__.'/./header.php'?>
	<section class="container">
	<div class="row row-cols-4 g-4">
		<div class="col">
			<div class="card" aria-hidden="true">
				<div class="card-body">
				<h5 class="card-title placeholder-wave">
					<span class="placeholder col-6"></span>
				</h5>
				<p class="card-text placeholder-wave">
					<span class="placeholder col-7"></span>
					<span class="placeholder col-4"></span>
					<span class="placeholder col-4"></span>
					<span class="placeholder col-6"></span>
					<span class="placeholder col-8"></span>
				</p>
				<a href="./createsurvey" class="btn purple-btn btn-lg">Create</a>
				</div>
		  	</div>
		</div>
	<?php
		if($surveys)
		{ 
			foreach($surveys as $key => $value)
			{
				echo 
					'<div class="col">
						<div class="card shadow" style="width: 18rem;">
							<div class="card-header">Created: '.$surveys[$key][4].'</div>
							<div class="card-body">
								<h5 class="card-title">'.$surveys[$key][1].'</h5>
							</div>
							<div class="card-body">
								<a class="btn btn-sm btn-primary" href="./surveys/edit/'.$surveys[$key][0].'" class="card-link"><i class="fas fa-pen"></i></a>
								<button class="btn btn-sm btn-danger delete card-link"><p hidden>'.$surveys[$key][0].'</p><i class="fas fa-trash"></i></button>
								<a type="button" href="./surveys/responses/'.$surveys[$key][0].'" class="btn btn-sm btn-success position-relative">
								<i class="fas fa-envelope"></i>
								'.($count[$key] > 0 ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$count[$key].'<span class="visually-hidden">unread messages</span></span>' : '').'
								</a>
							</div>
						</div>
					</div>';
			}
				echo "</div></section>";
		}
		else
		{
			echo <<<_END
			<div class="container container-mt">
			<h3 class="text-secondary text-center mb-5">There are currently no surveys in your list.</h3>
			<h4 class="text-secondary text-center mb-5">Click create to start creating one today!</h4>
			
			</div>
			_END;
		}
	?>
    
</div>

<script src="../resources/assets/js/delete.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>