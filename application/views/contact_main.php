<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>Get In Touch</h3>
					<?php
						if($this->session->flashdata('noinsert')){
							echo "<div>".$this->session->flashdata('noinsert')."</div>";
						}
					?>
					<?php echo "<div id='val_errors'>".validation_errors()."</div>";?>

					<?php echo form_open('contact','onsubmit="return contactform();"'); ?>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<?php echo form_input(array(
									'id'=>'name',
									'name'=>'name',
									'class'=>'form-control',
									'placeholder'=>'Your fullname',
									'value'=>set_value('name')
								));?>
							</div>
							
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<?php echo form_input(array(
									'id'=>'email',
									'name'=>'email',
									'class'=>'form-control',
									'placeholder'=>'Your email address',
									'value'=>set_value('email')
								));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<?php echo form_textarea(array(
									'id'=>'message',
									'name'=>'message',
									'cols'=>'30',
									'rows'=>'10',
									'class'=>'form-control',
									'placeholder'=>'Write us something',
									'value'=>set_value('message')
								));?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_submit(array(
								'id'=>'submit',
								'name'=>'submit',
								'value'=>'Send Message',
								'class'=>'btn btn-primary'													
							));?>
						</div>

					<?php echo form_close();?>	

                    
				</div>
					<div class="col-md-5 col-md-push-1 animate-box">
						
						<div class="gtco-contact-info">
							<h3>Contact Information</h3>
							<ul>
								<li class="address">198 West 21th Street, <br> Suite 721 New York NY 10016</li>
								<li class="phone"><a href="tel://1234567920">+ 1235 2355 98</a></li>
								<li class="email"><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
								<li class="url"><a href="http://google.com">goranurukalo.com</a></li>
							</ul>
						</div>


					</div>


					<div class="col-md-5 col-md-push-1 animate-box">
						
						<div class="gtco-contact-info">
						<?php if($anypoll):?>
							<h2>Poll</h2>
							<div id='votepollcont'>
								<?php echo form_open(''); ?>
								<h3><?php echo $polldata['question']->pollQuestion; ?></h3>
								<?php
									foreach($polldata['answers'] as $answer):
								?>
									<div class='radio'>
										<label>
											<?php echo form_radio('poll', $answer->pollAnswerID, FALSE); echo $answer->pollAnswer; ?>
										</label>
									</div>
								<?php 
									endforeach;
								?>
								<?php echo form_button(array(
												'name'=>'button',
												'id'=>'button',
												'value'=>'true',
												'content'=>'Vote',
												'class'=>'btn btn-primary',
												'onclick'=>'ajaxVotePoll();'													
											));
								?>
								<?php echo form_close(); ?>
							</div>
						<?php endif;?>
						</div>

					</div>

					<script>
					function ajaxVotePoll(){
						var checkedRadioButton = $("input[name=poll]:checked").val();

						$.ajax({
							url: 'voteajax/pollvote',
							type:'POST',
							data: {vote: checkedRadioButton},
							success: function(c){
								$("#votepollcont").html(c);
							}
						});
					}
					</script>


				</div>
			</div>
		</div>
	</div>