<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(<?php echo base_url().'images/img_bg_6.jpg';?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					
						<div class="row row-mt-15em">
						<div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
							
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Login</h3>
											<?php
												if($this->session->flashdata('userNotExist')){
													echo "<div><p>We are sorry but Email or Password are not good.</p></div>";
												}
												if($this->session->flashdata('userNotAllowed')){
													echo "<div><p>We are sorry but you are not allowed to login.</p></div>";
												}
												if($this->session->flashdata('userNeedToValid')){
													echo "<div><p>Before you login, check your email and confirm registration.</p></div>";
												}
												if($this->session->flashdata('userVerify')){
													echo "<div><p>You have verified email.</p></div>";
												}
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div id='val_errors'>".validation_errors()."</div>";


												# 	otvaranje forme
												echo form_open('reservation','onsubmit="return login();"');

												# 	Email
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Email','email');			
												echo form_input(array(
													'id'=>'email',
													'name'=>'email',
													'placeholder'=>'EMAIL',
													'class'=>'form-control',
													'value'=>set_value('email')
												));
												echo "	</div>
													</div>";
												# 	password
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Password','password');			
												echo form_password(array(
													'id'=>'password',
													'name'=>'password',
													'placeholder'=>'PASSWORD',
													'class'=>'form-control'
												));
												echo "	</div>
													</div>";
												# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Login',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();
												echo anchor('reservation/forgotpassword','Forgot password?');
												echo "<br>";
												echo anchor('reservation/registration','Don\'t have an Savory account?');
											?>
										</div>	
									</div>

								</div>
							</div>

						</div>
					</div>
					
				</div>
			</div>
		</div>
</header>