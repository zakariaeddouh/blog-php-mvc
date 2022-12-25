<?php include 'extensions/adminMenu.php' ?>
<section class="blog-area section admin-manager-section">
	<div class="container">
		<div class="row">
            <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-info">
                            <h4 class="title manager-comment-title"><a href="post&id=<?= $post['id'] ?>"><b><?= substr($post['chapo'], 0, 30). "..." ?></b></a></h4><hr>
						</div>
                        <div class="blog-info">
                            <h6 class="title title-padding"><?= substr($post['content'], 0, 200). "..." ?></h6>
                            <ul class="post-footer">
                                <li><a href="admin&modifyPost&id=<?= $post['id'] ?>"><i class="ion-edit"></i></a></li>
                                <li><a href="admin&deletePost&id=<?= $post['id'] ?>" onclick="return confirm('Voulez-vous supprimer définitivement cet article ?')"><i class="ion-android-delete"></i></a></li>
                                <li><a href="post&id=<?= $post['id'] ?>"><i class="ion-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
		    </div>
            <?php endforeach ?>
        </div>
	</div>
</section>