<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					
					<div class="row row-mt-10em">
						<div class="col-md-12 col-md-push-0 animate-box" data-animate-effect="fadeInRight">
							<?php

                                if(isset($adduser)){
                            ?>
                            <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Registration</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												echo "<div>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/adduser');

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
                                    # 	role
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Role','activities');			
												echo form_dropdown('role', $rolelist, (set_value('role') != NULL)? set_value('role') : '2' ,'id="activities" class="form-control"');
												echo "	</div>
													</div>";
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Add New User',
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
                            <?php
                                }
                                else if(isset($users)){
									if($this->session->flashdata('userisadded')){
										echo "<div>".$this->session->flashdata('userisadded')."</div>";
									}
									if($this->session->flashdata('userismodify')){
										echo "<div>".$this->session->flashdata('userismodify')."</div>";
									}

									if(isset($userlist)){
										
										echo "<table class='table table-responsive table-hover table-condensed'>
												<thead>
												<tr>
													<th>ID</th>
													<th>Full name</th>
													<th>Email</th>
													<th>Role</th>
													<th>Time of reg</th>
													<th>Status</th>
													<th>Modify</th>
												</tr>
												</thead>
												<tbody>";
										foreach($userlist as $row){
											if($row->status == 'Verified'){
												echo "<tr class='success'>";
											}	
											else if($row->status == 'Banned'){
												echo "<tr class='danger'>";
											}
											else if($row->status == 'Deleted'){
												echo "<tr class='warning'>";
											}
											else {
												echo "<tr class='info'>";
											}
											echo "
													<td>".$row->userID."</td>
													<td>".$row->firstName." ".$row->lastName."</td>
													<td>".$row->email."</td>
													<td>".$row->role."</td>
													<td>".@date('d/m/Y',$row->timeOfReg)."</td>
													<td>".$row->status."</td>
													<td>".anchor('admin/oneuser/'.$row->userID,'Modify')."</td>
												</tr>";
										}
										echo "</tbody>
											</table>";

										echo $pagination;
									}
                                }
                                else if(isset($oneuser)){
                                    ?>
                            <div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Modify</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}
												if($this->session->flashdata('badpassword')){
													echo "<div>".$this->session->flashdata('badpassword')."</div>";
												}
												echo "<div>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/oneuser');
									# 	USER ID
												echo form_hidden('userID', $userdata->userID);
									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('First Name','firstName');			
												echo form_input(array(
													'id'=>'firstName',
													'name'=>'firstName',
													'placeholder'=>'FIRST NAME',
													'class'=>'form-control',
													'value'=>$userdata->firstName
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
													'value'=>$userdata->lastName
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
													'value'=>$userdata->email
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
                                    # 	role
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Role','activities');			
												echo form_dropdown('role', $rolelist, $userdata->roleID ,'id="activities" class="form-control"');
												echo "	</div>
													</div>";
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify User',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();

												echo anchor('admin/userban/'.$userdata->userID,'Ban this User.');
												echo " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; " ;
												echo anchor('admin/userdelete/'.$userdata->userID,'Delete this User.');
											?>
										</div>	
									</div>

								</div>
							</div>
                            <?php
                                }
								elseif(isset($menilist)){
                            ?>


								<?php if(isset($menidata)):?>
                                <table class='table table-responsive table-condensed'>
                                    <thead>
                                        <tr>
                                            <th class="col-md-3">Link text</th>
                                            <th class="col-md-3">Link</th>
                                            <th class="col-md-3">Modify</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($menidata as $row){
                                                echo "<tr>
                                                        <td class='col-md-3'>".$row->meni."</td>
                                                        <td class='col-md-3'>".$row->meniLink."</td>
                                                        <td class='col-md-3'>".anchor('admin/modifymeni/'.$row->meniID,'Modify')."</td>
													</tr>";
                                            }
                                        ?>
                                    
                                    </tbody>
                                </table>
								<?php echo $pagination;?>
							
                            <?php else:?>
                                <div><p>We dont have any data.</p></div>
                            <?php endif;?>

							<?php
                                }
								elseif(isset($polllist)){
                            ?>
								<?php if(isset($polldata)):?>
                                <table class='table table-responsive table-condensed'>
                                    <thead>
                                        <tr>
                                            <th class="col-md-3">Question</th>
                                            <th class="col-md-3">Modify</th>
                                            <th class="col-md-3">On / Off</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($polldata as $row){
                                                echo "<tr>
                                                        <td class='col-md-3'>".$row->pollQuestion."</td>
                                                        <td class='col-md-3'>".anchor('admin/modifypoll/'.$row->pollQuestionID,'Modify')."</td>
														<td class='col-md-3'>".
														form_button(array(
															'name'=>'onoff[]',
															'value'=>$row->onOff ? 'On': 'Off',
															'content'=>$row->onOff ? 'On': 'Off',
															'class'=>'btn '. ($row->onOff ? 'btn-success': 'btn-danger'),
															'onclick'=>'ajaxOnOff(this,'.$row->pollQuestionID.','.$row->onOff.');'													
														))
														."</td>
													</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
								<?php echo $pagination;?>
							
                            <?php else:?>
                                <div><p>We dont have any data.</p></div>
                            <?php endif;?>
							<script>
								function ajaxOnOff(obj,id,val){
									$.ajax({
										url: '<?php echo base_url()?>voteajax/ajaxOnOff',
										type:'POST',
										data: {onOff: {onOffID: id, onOffval: val}},
										success: function(c){

											if(c == 'true'){
												if(obj.value=="On"){ 
													obj.value = "Off";
													obj.innerHTML  = "Off";
													obj.className = "btn btn-danger";
													var nval = val ? 0 : 1;
													obj.setAttribute('onclick','ajaxOnOff(this,'+id+','+nval+')');
												}
												else if(obj.value=="Off"){ 
													obj.value = "On";
													obj.innerHTML  = "On";
													obj.className = "btn btn-success";
													var nval = val ? 0 : 1;
													obj.setAttribute('onclick','ajaxOnOff(this,'+id+','+nval+')');
												}
											}
											else{
												console.log('error in ajax');
											}
										}
									});
								}
								</script>

							<?php } 
								elseif(isset($addpoll)){
							?>

							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Add Poll</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}

												echo "<div id='val_errors'>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/addpoll');
												
									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Question','question');			
												echo form_input(array(
													'id'=>'question',
													'name'=>'question',
													'placeholder'=>'QUESTION',
													'class'=>'form-control',
													'value'=>set_value('question')
												));
												echo "	</div>
													</div>";
                                                echo "<div id='answerparent'>";
												# 	LAST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Answer','');			
												echo form_input(array(
													'name'=>'answers[]',
													'placeholder'=>'ANSWER',
													'class'=>'form-control answers',
													'value'=>set_value('answers[]')
												));
												echo "	</div>
													</div>";
                                    # 	LAST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Answer','');			
												echo form_input(array(
													'name'=>'answers[]',
													'placeholder'=>'ANSWER',
													'class'=>'form-control answers',
													'value'=>set_value('answers[]')
												));
												echo "	</div>
													</div>";
												

												for($i = 2;$i < $answerelementnumber; $i++){
													echo "<div class='row form-group'>
														<div class='col-md-12'>";
													echo form_label('Answer','');			
													echo form_input(array(
														'name'=>'answers[]',
														'placeholder'=>'ANSWER',
														'class'=>'form-control answers',
														'value'=>set_value('answers[]')
													));
													echo "	</div>
														</div>";
												}
												echo "</div>";
									# 	add more dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_button(array(
													'id'=>'addmore',
													'name'=>'addmore',
													'value'=>'true',
													'content'=>'Add one more answer',
													'class'=>'btn btn-default btn-block',
													'onclick'=>'ineedanswer();'													
												));

												echo	"</div>
													</div>";

									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Add Poll',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();
											?>
										</div>	
									</div>

									<script>
										function ineedanswer(){
											var parent = document.getElementById('answerparent');
											var row = document.createElement('div');
											row.setAttribute('class', 'row form-group');

											var col = document.createElement('div');
											col.setAttribute('class', 'col-md-12');
											
											var label = document.createElement('label');
											label.appendChild(document.createTextNode("Answer"));
											var answer = document.createElement('input');
											answer.setAttribute('type', 'text');
											answer.setAttribute('name', 'answers[]');
											answer.setAttribute('class', 'form-control answers');
											answer.setAttribute('placeholder', 'ANSWER');

											col.appendChild(label);
											col.appendChild(answer);
											row.appendChild(col);
											parent.appendChild(row);
										}
									</script>
								</div>
							</div>
							<?php } 
								elseif(isset($modifypoll)){
							?>

							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Modify Poll</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}

												echo "<div>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/modifypoll');
												echo form_hidden(array('pollID' => $modifypolldataquestion->pollQuestionID));
									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Question','question');			
												echo form_input(array(
													'id'=>'question',
													'name'=>'question',
													'placeholder'=>'QUESTION',
													'class'=>'form-control',
													'value'=>$modifypolldataquestion->pollQuestion
												));
												echo "	</div>
													</div>";
                                                echo "<div id='answerparent'>";

												foreach($modifypolldataanswers as $row){
													echo "<div class='row form-group'>
														<div class='col-md-12'>";
													echo form_label('Answer','');			
													echo form_input(array(
														'name'=>'answers['.$row->pollAnswerID.']',
														'placeholder'=>'ANSWER',
														'class'=>'form-control answers',
														'value'=>$row->pollAnswer
													));
													echo "	</div>
														</div>";
													if(count($modifypolldataanswers)>2){
														echo anchor('admin/deletepollanswer/'.$row->pollAnswerID.'/'.$modifypolldataquestion->pollQuestionID, 'Remove this Answer');
													}
												}
												echo "</div><br>";
									# 	add more dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_button(array(
													'id'=>'addmore',
													'name'=>'addmore',
													'value'=>'true',
													'content'=>'Add one more answer',
													'class'=>'btn btn-default btn-block',
													'onclick'=>'ineedanswer();'													
												));

												echo	"</div>
													</div>";

									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify Poll',
													'class'=>'btn btn-primary btn-block'													
												));
												
												echo	"</div>
													</div>";

													echo anchor('admin/deletepoll/'.$modifypolldataquestion->pollQuestionID,'Remove this Poll');
												echo form_close();
											?>
										</div>	
									</div>

									<script>
										var negativnums = -1;
										function ineedanswer(){
											var parent = document.getElementById('answerparent');
											var row = document.createElement('div');
											row.setAttribute('class', 'row form-group');

											var col = document.createElement('div');
											col.setAttribute('class', 'col-md-12');
											
											var label = document.createElement('label');
											label.appendChild(document.createTextNode("Answer"));
											var answer = document.createElement('input');
											answer.setAttribute('type', 'text');
											answer.setAttribute('name', 'answers['+(negativnums--)+']');
											answer.setAttribute('class', 'form-control answers');
											answer.setAttribute('placeholder', 'ANSWER');

											col.appendChild(label);
											col.appendChild(answer);
											row.appendChild(col);
											parent.appendChild(row);
										}
									</script>
								</div>
							</div>

							<?php } 
								elseif(isset($addmeni)){
							?>

							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Modify Meni</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}

												echo "<div>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/addmeni');
									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Meni text','menitext');			
												echo form_input(array(
													'id'=>'menitext',
													'name'=>'menitext',
													'placeholder'=>'MENI TEXT',
													'class'=>'form-control',
													'value'=>set_value('menitext')
												));
												echo "	</div>
													</div>";
                                                
                                    # 	LAST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Meni Link','menilink');			
												echo form_input(array(
													'id'=>'menilink',
													'name'=>'menilink',
													'placeholder'=>'MENI LINK',
													'class'=>'form-control',
													'value'=>set_value('menilink')
												));
												echo "	</div>
													</div>";
                                   
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Add meni',
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


							<?php } 
								elseif(isset($modifymeni)){
							?>

							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Savory Modify Meni</h3>
											<?php
												if($this->session->flashdata('noinsert')){
													echo "<div>".$this->session->flashdata('noinsert')."</div>";
												}

												echo "<div>".validation_errors()."</div>";

												# 	otvaranje forme
												echo form_open('admin/modifymeni');
									# 	MENI ID
												echo form_hidden('meniID', $menidata->meniID);
									# 	FIRST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Meni text','menitext');			
												echo form_input(array(
													'id'=>'menitext',
													'name'=>'menitext',
													'placeholder'=>'MENI TEXT',
													'class'=>'form-control',
													'value'=>$menidata->meni
												));
												echo "	</div>
													</div>";
                                                
                                    # 	LAST NAME
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_label('Meni Link','menilink');			
												echo form_input(array(
													'id'=>'menilink',
													'name'=>'menilink',
													'placeholder'=>'MENI LINK',
													'class'=>'form-control',
													'value'=>$menidata->meniLink
												));
												echo "	</div>
													</div>";
                                   
									# 	submit dugme
												echo "<div class='row form-group'>
														<div class='col-md-12'>";
												echo form_submit(array(
													'id'=>'submit',
													'name'=>'submit',
													'value'=>'Modify meni',
													'class'=>'btn btn-primary btn-block'													
												));

												echo	"</div>
													</div>";
												echo form_close();

												echo anchor('admin/menidelete/'.$menidata->meniID,'Delete this Meni.');
											?>
										</div>	
									</div>

								</div>
							</div>


							<?php } ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
</header>