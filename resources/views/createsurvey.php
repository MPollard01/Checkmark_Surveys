<?php require_once __DIR__.'/./header.php'?>

<div class="d-flex position-fixed end-0" style="margin-right: 18%">
	<div class="d-flex flex-column shadow-sm form-control border-0" aria-orientation="vertical">
		<button type="button" class="btn btn-sm btn-outline-secondary mb-2" id="addQuestion" data-bs-toggle="tooltip" data-bs-placement="right" title="Add question"><i class="fa fa-plus"></i></button>
		<button type="button" id="surveybtn" class="btn btn-sm btn-outline-secondary mb-2" name="submitSurvey" data-bs-toggle="tooltip" data-bs-placement="right" title="Save"><i class="fas fa-save"></i></button>
		<button type="button" class="btn btn-sm btn-outline-secondary" id="emailModalbtn" data-bs-toggle="tooltip" data-bs-placement="right"  title="Email"><i class="fas fa-envelope"></i></button>
	</div>
</div>

<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Email survey</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="email-form" action="surveys/email" method="post">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" name="recipients">
          </div>
          <div class="mb-3">
            <label for="subject" class="col-form-label">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="body"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="email-btn" class="btn btn-primary">Send survey</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="warningModalLabel">Save your survey</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Save your survey before sending it out!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<form id="survey-form" class="form-control shadow-sm border-0 row g-3 mx-auto pb-4" style="width: 60%" action="create_survey.php" method="post">
	<div class="col-12 mb-3">
		<input class="form-control form-control-lg input-border" type="text" name="title" placeholder="Survey Title" required> 
	</div>
	<div class="input-wrap row g-3">
		<div class="col-md-7">
			<input type="text" name="question[]" class="form-control input-border" placeholder="Question">
		</div>
		<div class="col-md-4">
		<select class="choices form-select" name="Question-type[]">
			<option value="radio">Multiple choice</option>
			<option value="checkbox">Check boxes</option>
			<option value="text">Text</option>
		</select>
		</div>
		
		<div class="col-md-1">
			<button type="button" class="btn btn-sm btn-outline-secondary remove-question" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove question"><i class="fa fa-trash"></i></button>
		</div>
		<div class="row g-3 question-type">
			<div class="qtype col-md-1 d-flex justify-content-center align-items-center">
				<input class="form-check-input" type="radio" disabled>
			</div>
			<div class="col-md-6">
				<input class="rd form-control input-border" type="text" name="options[]" placeholder="Option" required>
			</div>
			<div class="col-md-2">
				<button type="button" class="add btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Add option"><i class="fa fa-plus"></i></button>
			</div>
		</div>
  </div>
</form>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    
    <div class="toast-body bg-success text-light">
      Saved successfully
    </div>
  </div>
</div>

</div>


<script src="../resources/assets/js/survey.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>