<section class="comment-section center-text">
	<div class="container">
		<?php if (isset($success)) { ?>
		<div class="row">
			<div class="col-lg-4 col-md-0"></div>
			<div class="col-lg-4 col-md-12">
				<div class="comment-form">
					<div class="alert-info" role="alert"><?php echo $success ?> </div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-lg-2 col-md-0"></div>
			<div class="col-lg-8 col-md-12">
				<div class="comment-form">
                    <form method="post" action="user&userConnect=action" class="contact1-form validate-form">
						<div class="row">
							<div class="col-sm-12">
								<input type="email" aria-required="true" name="email" class="form-control"
									placeholder="Email" aria-invalid="true" required >
							</div>
							<div class="col-sm-12">
								<input type="password" aria-required="true" minlength="6" name="password" class="form-control"
									placeholder="Mot de passe" aria-invalid="true" required>
							</div>
							<div class="col-sm-12">
								<button class="submit-btn" type="submit" id="form-submit"><b>CONNEXION</b></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>