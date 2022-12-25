<section class="post-area">
	<div class="container">
		<?php if (isset($_SESSION['success'])) { ?>
		<div class="row">
			<div class="col-lg-3 col-md-0"></div>
			<div class="col-lg-6 col-md-12">
				<div class="comment-form center-text single-post-comment-success">
					<div class="alert-success" role="alert"><?= $_SESSION['success'] ?></div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-lg-1 col-md-0"></div>
			<div class="col-lg-10 col-md-12">
				<div class="main-post single-post-row">
					<div class="post-top-area">
						<h3 class="title"><b><?= $post['chapo'] ?></b></h3>
						<div class="post-info">
							<div class="left-area">
								<a class="avatar" href="#"><img src=<?= isset($user['picture']) ? "public/uploads/".$user['picture'] : "public/images/default-profile.png" ?> alt="Photo de profil"></a>
							</div>
							<div class="middle-area">
								<a class="name" href="#"><b><?= $user['firstName'] .' '. $user['lastName'] ?></b></a>							
								<?php if (isset($post['dateUpdated'])): ?>
									<h6 class="date">Dernière modification le : <?= $post['dateUpdated'] ?></h6>
								<?php else: ?>
									<h6 class="date">Publié le : <?= $post['dateCreated'] ?></h6>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="post-bottom-area">
						<p class="para"><?= $post['content'] ?></p>
						<ul class="tags">
							<li><a href="#"><?= $category['name'] ?></a></li>
						</ul>
						<div class="post-icons-area">
							<ul class="post-icons">
								<li><a href="#"><i class="ion-chatbubble"></i><?php if (!empty($comments)) { echo count($comments); } else { echo '0'; } ?></a></li>
							</ul>
							<ul class="icons">
								<li>PARTAGER : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="comment-section center-text">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-0"></div>
			<div class="col-lg-8 col-md-12">
				<?php if (!empty($_SESSION)) { ?>
				<div class="comment-form">
                    <form method="post" action="post&addComment=action" class="contact1-form validate-form">
						<div class="row">
							<div class="col-sm-12">
                                <input type="hidden" name="id_user" value=<?= $_SESSION['id'] ?>>
                                <input type="hidden" name="id_post" value=<?= $post['id'] ?>>
								<textarea name="comment" rows="2" class="text-area-messge form-control"
									placeholder="Entrez votre commentaire" aria-required="true" aria-invalid="false" required></textarea >
							</div>
							<div class="col-sm-12">
								<button class="submit-btn" type="submit" id="form-submit"><b>POSTER UN COMMENTAIRE</b></button>
							</div>
						</div>
					</form>
				</div>
				<?php } ?>
				<?php if (!empty($comments)) { ?>
				<div class="commnets-area text-left">
					<?php foreach ($comments as $comment): ?>
					<div class="comment">
						<div class="post-info">
							<div class="left-area">
								<a class="avatar" href="#"><img src=<?= isset($user['picture']) ? "public/uploads/".$user['picture'] : "public/images/default-profile.png" ?> alt="Profile Image"></a>
							</div>
							<div class="middle-area">
								<a class="name" href="#"><b><?= $comment['firstName'] .' '. $comment['lastName'] ?></b></a>
								<h6 class="date">Publié le : <?= $comment['dateCreated'] ?></h6>
							</div>
						</div>
						<p><?= $comment['content'] ?></p>
					</div>
					<?php endforeach ?>
				</div>
				<a class="more-comment-btn" href="#"><b>VOIR PLUS DE COMMENTAIRES</a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php unset ($_SESSION["success"]) ?>