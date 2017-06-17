<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
				<?php if(isset($list)):?>
                    <?php if(isset($cook)):?>
                        <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                            <?php
                                if($this->session->flashdata('noinsert')){
									echo "<div>".$this->session->flashdata('noinsert')."</div>";
								}
                            ?>

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
                                        foreach($cook as $row){
                                            echo "<tr>
                                                    <td class='col-md-8 text-left'>".$row->name."</td>
                                                    <td class='col-md-1'>".$row->quantity."</td>
                                                    <td class='col-md-1'>".$row->measure."</td>
                                                    <td class='col-md-1'>".anchor('cook/onesupplie/'.$row->supplieID,'Modify')."</td>
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

                                <div><p>No more supplies from Cook.</p></div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php elseif(isset($standard)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                                <h3 class="cursive-font primary-color">Are you sure you want to add 'Standard Supplies'?</h3>
                                <br>
                                <br>
                                <div class="row row-mt-10em">
                                    <div class="col-md-4">
                                        <?php echo anchor('cook/addstandardsupplies/YES','Yes');?>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                        <?php echo anchor('cook','No');?>
                                    </div>
                                </div>
                            </div>
                    </div>
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
												echo "<div>".validation_errors()."</div>";

								    # 	otvaranje forme
												echo form_open('cook/addsupplie');

									# 	SUPPLIE NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Supply Name','supplieName');			
												echo form_input(array(
													'id'=>'supplieName',
													'name'=>'supplieName',
													'placeholder'=>'SUPPLY NAME',
													'class'=>'form-control',
													'value'=>set_value('supplieName')
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
													'value'=>'Add New Supply',
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
												echo form_open('cook/onesupplie');
									# 	SUPPLIE NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Supply Name','supplieName');			
												echo form_input(array(
													'id'=>'supplieName',
													'name'=>'supplieName',
													'placeholder'=>'SUPPLY NAME',
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
													'supplieID'=>$onesuppliedata->supplieID
                                                ));
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify Supply',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";

												echo anchor('cook/removeonesupplie/'.$onesuppliedata->supplieID,'Remove supply');
												echo form_close();
											?>
										</div>	
									</div>

								</div>
							</div>




                            </div>
                    </div>
                <?php elseif(isset($dishlist)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                                
                            <?php if(isset($dishdata)):?>
                                <table class='table table-responsive table-condensed'>
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Dish name</th>
                                            <th class="col-md-3">Description</th>
                                            <th class="col-md-1">Price</th>
                                            <th class="col-md-1">Modify</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($dishdata as $row){
                                                echo "<tr>
                                                        <td class='col-md-2'>".$row->name."</td>
                                                        <td class='col-md-3'>".$row->description."</td>
                                                        <td class='col-md-1'>$".$row->price."</td>
                                                        <td class='col-md-1'>".anchor('cook/modifydish/'.$row->dishID,'Modify')."</td>
                                                    </tr>";
                                            }
                                        ?>
                                    
                                    </tbody>
                                </table>
								<?php echo $pagination;?>
                            <?php else:?>
                                <div><p>No more supplies from Cook.</p></div>
                            <?php endif;?>

                            </div>
                    </div>
                <?php elseif(isset($adddish)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                                <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory add dish</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div id='val_errors'>".validation_errors()."</div>";
								    # 	otvaranje forme
												echo form_open_multipart('cook/adddish');
                                                
                                                echo "<div class='row form-group'>
														<div class='col-md-6'>";
                                                        echo "<div class='form-group'>
                                                                <label for='img'>Dish image</label>";

                                                        echo form_upload(array(
                                                            'id'=>'img',
                                                            'name'=>'img',
                                                            'class'=>'form-control',
                                                            'accept'=>'image/*'
                                                        ));

                                                echo "	</div>";
												echo "</div>
                                                </div>";
                                    # 	NAME
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Dish name','name');			
												echo form_input(array(
													'id'=>'name',
													'name'=>'name',
													'placeholder'=>'NAME',
													'class'=>'form-control',
													'value'=>set_value('name')
												));
												echo "	</div>
													</div>";
                                    # 	DESCRIPTION
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Description','description');			
												echo form_input(array(
													'id'=>'description',
													'name'=>'description',
													'placeholder'=>'DESCRIPTION',
													'class'=>'form-control',
													'value'=>set_value('description')
												));
												echo "	</div>
													</div>";
                                    # 	PRICE
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Price','price');			
												echo form_input(array(
													'id'=>'price',
													'name'=>'price',
													'placeholder'=>'PRICE',
													'class'=>'form-control',
													'value'=>set_value('price')
												));
												echo "	</div>
													</div>";
                                    # 	IMGALT
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Img alt','imgalt');			
												echo form_input(array(
													'id'=>'imgalt',
													'name'=>'imgalt',
													'placeholder'=>'IMG ALT',
													'class'=>'form-control',
													'value'=>set_value('imgalt')
												));
												echo "	</div>
													</div>";
                                            
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Add Dish',
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
                <?php elseif(isset($modifydish)):?>
                    <div class="row row-mt-10em">
                            <div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
                                <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory modify dish</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div>".validation_errors()."</div>";
								    # 	otvaranje forme
												echo form_open_multipart('cook/modifydish');
                                                
                                                echo "<img src='".base_url().$dishdata->imgLink."' alt='".$dishdata->imgAlt."' class='img-rounded col-md-4'>";
                                                
                                                echo "<div class='row form-group'>
														<div class='col-md-6'>";
                                                        echo "<div class='form-group'>
                                                                <label for='img'>Dish image</label>";
                                                                
                                                            
                                                        echo form_upload(array(
                                                            'id'=>'img',
                                                            'name'=>'img',
                                                            'class'=>'form-control',
                                                            'accept'=>'image/*'
                                                        ));

                                                echo "	</div>";
                                                echo "
                                                     <div class='checkbox'>
                                                        <label>";
                                                echo form_checkbox(array(
                                                    'name'=> 'cbimg',
                                                    'id'=> 'cbimg',
                                                    'value'=> 'importimg',
                                                    'checked'=> FALSE
                                                ));
                                                echo "Modify with file?
                                                        </label>
                                                    </div>
                                                ";
												echo "</div>
                                                </div>";
                                    # 	NAME
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Dish name','name');			
												echo form_input(array(
													'id'=>'name',
													'name'=>'name',
													'placeholder'=>'NAME',
													'class'=>'form-control',
													'value'=>$dishdata->name
												));
												echo "	</div>
													</div>";
                                    # 	DESCRIPTION
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Description','description');			
												echo form_input(array(
													'id'=>'description',
													'name'=>'description',
													'placeholder'=>'DESCRIPTION',
													'class'=>'form-control',
													'value'=>$dishdata->description
												));
												echo "	</div>
													</div>";
                                    # 	PRICE
                                                echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Price','price');			
												echo form_input(array(
													'id'=>'price',
													'name'=>'price',
													'placeholder'=>'PRICE',
													'class'=>'form-control',
													'value'=>$dishdata->price
												));
												echo "	</div>
													</div>";
                                    # 	IMGALT
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Img alt','imgalt');			
												echo form_input(array(
													'id'=>'imgalt',
													'name'=>'imgalt',
													'placeholder'=>'IMG ALT',
													'class'=>'form-control',
													'value'=>$dishdata->imgAlt
												));
												echo "	</div>
													</div>";
                                                
                                                echo form_hidden(array(
                                                    'dishID'=>$dishdata->dishID
                                                ));
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify Dish',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();
                                                echo anchor('cook/removedish/'.$dishdata->dishID,'Remove dish');
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