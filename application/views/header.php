	<header id="gtco-header" class="gtco-cover <?php echo isset($needReservation)? 'gtco-cover-md' : 'gtco-cover-sm'; ?>" role="banner" style="background-image: url(<?php echo base_url().$headerImgLink;?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 <?php echo isset($needReservation)? 'text-left' : 'text-center'; ?>">
					
				<?php if(isset($needReservation)){?>

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small"><?php echo $headerH1TextAbove;?></span>
							<h1 class="cursive-font"><?php echo $headerH1Text;?></h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Table Reservation</h3>
											<?php
												if($this->session->flashdata('noMoreTables')){
													echo "<div>All tables are reserved for next 2h.</div>";
												}
												if($this->session->flashdata('dontgobackwithtime')){
													echo "<div>The date must be at least 15 min in the future.</div>";
												}
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
											?>
											<?php echo "<div id='val_errors'>".validation_errors()."</div>";?>
											<?php echo form_open('reservation','onsubmit="return reservation();"');?>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="activities">Persons</label>
														<?php
															$options = array(
																	'0' => 'Persons',
																	'1' => '1',
																	'2' => '2',
																	'3' => '3',
																	'4' => '4',
																	'5' => '5+',
															);
															echo form_dropdown('persons', $options, set_value('persons'),'id="activities" class="form-control"');
														?>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="date-start">Date</label>
														<?php
															echo form_input(array(
																'id'=>'date',
																'name'=>'date',
																'placeholder'=>'',
																'class'=>'form-control',
																'value'=>set_value('date')
															));
														?>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="date-start">Time</label>
														<?php
															echo form_input(array(
																'id'=>'time',
																'name'=>'time',
																'placeholder'=>'',
																'class'=>'form-control',
																'value'=>set_value('time')
															));
														?>
													</div>
												</div>

												<div class="row form-group">
													<div class="col-md-12">
														<?php
															echo form_submit(array(
																'id'=>'a',
																'name'=>'a',
																'value'=>'Reserve Now',
																'class'=>'btn btn-primary btn-block'													
															));
														?>
													</div>
												</div>
											<?php echo form_close();?>
										</div>	
									</div>

								</div>
							</div>

						</div>
					</div>

					<?php }else{?>
						<div class="row row-mt-15em">
							<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
								<span class="intro-text-small"><?php echo $headerH1TextAbove;?></span>
								<h1 class="cursive-font"><?php echo $headerH1Text;?></h1>	
							</div>				
						</div>
					<?php }?>

				</div>
			</div>
		</div>
	</header>