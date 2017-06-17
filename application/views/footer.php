<footer id="gtco-footer" role="contentinfo" style="background-image: url(<?php echo base_url();?>images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row row-pb-md">

				

				
				<div class="col-md-12 text-center">
					<?php if($this->session->userdata('logged')){?>
					<div class="gtco-widget">
						<h3>My Profile</h3>
						<ul class="gtco-quick-contact">
							<?php echo '<li>'.anchor('profile','Profile').'</li>';?>
							<?php echo '<li>'.anchor('reservation','Reservation').'</li>';?>
							<?php if($this->session->userdata('role')=='Director'){echo '<li>'.anchor('mydoc.pdf','Documentation').'</li>';}?>							
							<?php echo '<li>'.anchor('reservation/logout','Logout').'</li>';?>
						</ul>
					</div>
					<?php } ?>
					
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@GetTemplates.co</a></li>
							<?php echo '<li>'.anchor('author','Author').'</li>';?>
						</ul>
					</div>
					<div class="gtco-widget">
						<h3>Get Social</h3>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-12 text-center copyright">
					<p><small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://gettemplates.co/" target="_blank">GetTemplates.co</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small></p>
				</div>

			</div>

			

		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="<?php echo base_url();?>js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php echo base_url();?>js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="<?php echo base_url();?>js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="<?php echo base_url();?>js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="<?php echo base_url();?>js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="<?php echo base_url();?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url();?>js/magnific-popup-options.js"></script>
	
	<script src="<?php echo base_url();?>js/moment.min.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap-datetimepicker.min.js"></script>


	<!-- Main -->
	<script src="<?php echo base_url();?>js/main.js"></script>
	
	<!-- MY -->
	<script src="<?php echo base_url();?>js/myscript.js"></script>

	</body>
</html>

