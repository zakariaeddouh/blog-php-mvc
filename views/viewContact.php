<section class="comment-section">
	<div class="container">
        <?php if (isset($result)) { ?>
		<div class="row">
			<div class="col-lg-3 col-md-0"></div>
			<div class="col-lg-6 col-md-12">
				<div class="comment-form center-text">
					<div class="alert-info" role="alert"><?php echo $result ?> </div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-lg-2 col-md-0"></div>
			<div class="col-lg-8 col-md-12">
				<div class="comment-form">
					<form method="POST" action="service&contactSend=action" class="contact1-form validate-form" enctype="multipart/form-data">
						<div class="row">
                            <div class="col-sm-6">
								<input type="text" aria-required="true" minlength="3" name="firstName" class="form-control"
									placeholder="Votre prénom" aria-invalid="true" required>
							</div>
							<div class="col-sm-6">
								<input type="text" aria-required="true" minlength="3" name="lastName" class="form-control"
									placeholder="Votre nom" aria-invalid="true" required>
							</div>
                            <div class="col-sm-6">
								<input type="email" aria-required="true" name="email" class="form-control"
									placeholder="Votre email" aria-invalid="true" required>
							</div>
							<div class="col-sm-6">
								<input type="tel" aria-required="true" name="tel" pattern="[0-9]{10}" class="form-control"
									placeholder="Format: 0611223344" aria-invalid="true" required>
							</div>
                            <div class="col-sm-12">
                                <textarea aria-required="true" name="message" class="form-control"
									placeholder="Votre message" aria-invalid="true" required></textarea>
							</div>
							<div class="col-sm-12 center-text">
								<button class="submit-btn" type="submit" id="form-submit"><b>ENVOYER</b></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>