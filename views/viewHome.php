<div class="slider h-30">
    <div class="display-table  center-text">
		<?php if (isset($_SESSION['id'])) { ?>
        	<h1 class="title display-table-cell"><b>Zakaria Eddouh, le développeur qu’il vous faut !</b></h1>
		<?php } else { ?>
			<h1 class="title display-table-cell"><b>Bienvenue sur mon blog !</b></h1>
		<?php } ?>
    </div>
</div>
<section class="blog-area section">
	<div class="container">
		<div class="row">
			<?php foreach ($posts as $post): ?>
			<div class="col-lg-4 col-md-6">
				<div class="card h-100">
					<div class="single-post post-style-1 home-post-bottom">
						<div class="blog-image home-image-post">
							<img src="public/images/default-post.jpg" alt="Blog Image">
							<h1 class="title home-title-image-post"><b><?= substr($post['title'], 0, 10) ?></b></h1>
						</div>
						<div class="blog-info">
                            <h4 class="title home-blog-title"><a href="post&id=<?= $post['id'] ?>"><b><?= substr($post['chapo'], 0, 30). "..." ?></b></a></h4>
						</div>
						<div class="blog-info home-blog-title">
							<h6 class="title title-padding"><?= substr($post['content'], 0, 200). "..." ?></h6>
						</div>
						<div class="blog-info manager-comment-title">
							<?php if (isset($post['dateUpdated'])): ?>
								<h6 class="title home-title">Dernière modification le : <?= $post['dateUpdated'] ?></h6>
							<?php else: ?>
								<h6 class="title home-title">Publié le : <?= $post['dateCreated'] ?></h6>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<!--
		<a class="load-more-btn" href="#"><b>AFFICHER PLUS</b></a>
		-->
	</div>
</section>
