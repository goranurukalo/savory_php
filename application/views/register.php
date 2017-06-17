<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					
						<div class="row row-mt-10em"><!-- bio .row-mt-15em  // .mt-sm-->
						<div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
							
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Registration</h3>
											<?php
                                            
												if($this->session->flashdata('registerError')){
													echo "<div><p>".$this->session->flashdata('registerError')."</p></div>";
												}
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div id='val_errors'>".validation_errors()."</div>";


												# 	otvaranje forme
												echo form_open('reservation/registration' ,'onsubmit="return registration();"');

									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('First Name','firstName');			
												echo form_input(array(
													'id'=>'firstName',
													'name'=>'firstName',
													'placeholder'=>'FIRST NAME',
													'class'=>'form-control',
													'value'=>set_value('firstName')
												));
												echo "	</div>
													</div>";
                                                
                                    # 	LAST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Last Name','lastName');			
												echo form_input(array(
													'id'=>'lastName',
													'name'=>'lastName',
													'placeholder'=>'LAST NAME',
													'class'=>'form-control',
													'value'=>set_value('lastName')
												));
												echo "	</div>
													</div>";
                                    # 	EMAIL
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
                                    # 	re-password
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Re-enter Password','re_password');			
												echo form_password(array(
													'id'=>'re_password',
													'name'=>'re_password',
													'placeholder'=>'RE-ENTER PASSWORD',
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
													'value'=>'Register',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();
												echo anchor('reservation','Already have an account?');
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