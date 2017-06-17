<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Popular Dishes</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">

				<?php if(isset($dishlist)):?>
				<?php foreach($dishlist as $dl):?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<a href="<?php echo base_url().$dl->imgLink;?>" class="fh5co-card-item image-popup">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="<?php echo base_url().$dl->imgLink;?>" alt="<?php echo $dl->imgAlt; ?>" class="img-responsive">
							</figure>
							
							<div class="fh5co-text">
								<h2><?php echo $dl->name;?></h2>
								<p style="height:100px;"><?php echo $dl->description;?></p>
								<p><span class="price cursive-font">$<?php echo number_format($dl->price,2);?></span></p>
							</div>
						</a>
					</div>
				<?php endforeach;?>

				<?php echo $pagination;?>
			<?php endif;?>

			</div>
		</div>
	</div>

	<div class="gtco-cover gtco-cover-sm" style="background-image: url(<?php echo base_url();?>images/img_bg_8.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>&ldquo; Their high quality of service makes me back over and over again!&rdquo;</h1>
					<p>&mdash; John Doe, CEO of XYZ Co.</p>
				</div>	
			</div>
		</div>
	</div>
