<?php 
$postClass=new postQueryModel;
$postPerPage=3;
$aboutData=$postClass->cmsQuery('home-content',$postPerPage);

 ?>

<div class="container">
		<div class="contact">
			<h2 class=" contact-in"><?php echo strtoupper($title); ?></h2>
				<?php foreach($aboutData as $abouts): ?>
					<div class="col-md-12">
						<h3><?php echo $abouts->heading; ?></h3>
						<div class="about-content">
							<?php echo $abouts->content; ?>
						</div> 
					</div>
				<?php endforeach; ?>	

			<div class="clearfix"> </div>
		</div>
	</div>
	