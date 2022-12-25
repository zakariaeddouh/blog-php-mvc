<div class="slider h-30">
    <div class="display-table  center-text">
		<?php if (isset($_SESSION['id'])) { ?>
        	<h1 class="title display-table-cell"><b><?= $_SESSION['firstName'] .' '. $_SESSION['lastName'] ?>, le développeur qu’il vous faut !</b></h1>
		<?php } else { ?>
			<h1 class="title display-table-cell"><b>Bienvenue sur mon blog !</b></h1>
		<?php } ?>
    </div>
</div>
<section class="blog-area section">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-12 col-md-6">
				<div class="card h-100">
					<div class="single-post post-style-1 home-post-bottom">
						<p class="error-font-100">Oups !</p>
                        <p class="error-font-30">La page que vous recherchez semble introuvable.</p>
                        <p class="error-font-25">Voici quelques liens utiles à la place :</p>
                        <p class="error-font-20">
                            <a href="post&home">Page d'accueil</a> |
                            <a href="user&connect">Connexion</a> |
                            <a href="user&register">Inscription</a> |
                            <a href="service&contact">Contact</a>
                        </p>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
