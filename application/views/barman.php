<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
				<?php if(isset($list)):?>
                    <?php if(isset($barman)):?>
                        <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">


                            <table class='table table-responsive table-condensed'>
                                <thead>
                                    <tr>
                                        <th class="col-md-7 text-center">Supply name</th>
                                        <th class="col-md-1">Num.</th>
                                        <th class="col-md-1">Meas.</th>
                                        <th class="col-md-1">Modify</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($barman as $row){
                                            echo "<tr>
                                                    <td class='col-md-8 text-left'>".$row->name."</td>
                                                    <td class='col-md-1'>".$row->quantity."</td>
                                                    <td class='col-md-1'>".$row->measure."</td>
                                                    <td class='col-md-1'>".anchor('barman/onesupplie/'.$row->supplieID,'Modify')."</td>
                                                </tr>";
                                        }
                                    ?>
                                
                                </tbody>
                            </table>
							<?php echo $pagination;?>
                            </div>
                        </div>
                    <?php else:?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">

                                <div><p>No more supplies from Barman.</p></div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php elseif(isset($add)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                            






                            <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory add supply</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div id='val_errors'>".validation_errors()."</div>";

								    # 	otvaranje forme
												echo form_open('barman/adddrink');

									# 	SUPPLIE NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Drink Name','drinkName');			
												echo form_input(array(
													'id'=>'drinkName',
													'name'=>'drinkName',
													'placeholder'=>'DRINK NAME',
													'class'=>'form-control',
													'value'=>set_value('drinkName')
												));
												echo "	</div>
													</div>";
                                                
                                    # 	NUMBER
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Number','number');			
												echo form_input(array(
													'id'=>'number',
													'name'=>'number',
													'placeholder'=>'NUMBER',
													'class'=>'form-control',
													'value'=>set_value('number')
												));
												echo "	</div>
													</div>";
                                    # 	MEASURE
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Measure','measure');			
												echo form_input(array(
													'id'=>'measure',
													'name'=>'measure',
													'placeholder'=>'MEASURE',
													'class'=>'form-control',
													'value'=>set_value('measure')
												));
												echo "	</div>
													</div>";
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Add New Drink',
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
                <?php elseif(isset($modify) && isset($onesuppliedata)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                                






                            <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory modify supply</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div>".validation_errors()."</div>";

								    # 	otvaranje forme
												echo form_open('barman/onesupplie');
									# 	SUPPLY NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Drink Name','drinkName');			
												echo form_input(array(
													'id'=>'drinkName',
													'name'=>'drinkName',
													'placeholder'=>'DRINK NAME',
													'class'=>'form-control',
													'value'=>$onesuppliedata->name
												));
												echo "	</div>
													</div>";
                                                
                                    # 	NUMBER
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Number','number');			
												echo form_input(array(
													'id'=>'number',
													'name'=>'number',
													'placeholder'=>'NUMBER',
													'class'=>'form-control',
													'value'=>$onesuppliedata->quantity
												));
												echo "	</div>
													</div>";
                                    # 	MEASURE
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Measure','measure');			
												echo form_input(array(
													'id'=>'measure',
													'name'=>'measure',
													'placeholder'=>'MEASURE',
													'class'=>'form-control',
													'value'=>$onesuppliedata->measure
												));
												echo "	</div>
													</div>";

                                                echo form_hidden(array(
													'drinkID'=>$onesuppliedata->supplieID
                                                ));
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify Drink',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";

												echo anchor('barman/removeonesupplie/'.$onesuppliedata->supplieID,'Remove drink');
												echo form_close();
											?>
										</div>	
									</div>

								</div>
							</div>













                            </div>
                    </div>
                <?php endif;?>


				</div>
			</div>
		</div>
</header>