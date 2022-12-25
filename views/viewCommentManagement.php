<?php include 'extensions/adminMenu.php' ?>
<section class="blog-area section admin-manager-section">
	<div class="container">
		<div class="row">
            <?php foreach ($comments as $comment): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-info">
                            <h4 class="title manager-comment-title"><a href="post&id=<?= $comment['id_post'] ?>"><b><?= substr($comment['chapo'], 0, 30). "..." ?></b></a></h4><hr>
						</div>
						<div class="blog-info">
                            <h6 class="title title-padding"><?= $comment['content'] ?></h6>
                            <ul class="post-footer">
                                <li><a href="admin&validateComment&id=<?= $comment['id'] ?>"><i class="ion-android-done"></i></a></li>
                                <li><a href="admin&deleteComment&id=<?= $comment['id'] ?>" onclick="return confirm('Voulez-vous supprimer définitivement ce commentaire ?')"><i class="ion-android-delete"></i></a></li>
                            </ul>
						</div>
                    </div>
                </div>
		    </div>
            <?php endforeach ?>
        </div>
	</div>
</section>