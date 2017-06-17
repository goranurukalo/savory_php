<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					
						<div class="row row-mt-13em">
						<div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
							
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Password Reset</h3>
											<?php
                                            /*
												if($this->session->flashdata('userNotExist')){
													echo "<div><p>We are sorry but Email or Password are not good.</p></div>";
												}*/
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div id='val_errors'>".validation_errors()."</div>";


												# 	otvaranje forme
												echo form_open('reservation/forgotpassword','onsubmit="return forgotpassword();"');

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
								# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Reset Password',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();
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