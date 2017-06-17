<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					
                <?php if(isset($supplies)):?>
					<div class="row row-mt-10em">
						<div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">

                        <?php if($this->session->flashdata('removeDone')){ echo $this->session->flashdata('removeDone');}?>


                        <table class='table table-responsive table-condensed'>
							<thead>
                                <tr>
                                    <th class="col-md-7 text-center">Supply name</th>
                                    <th class="col-md-1">Num.</th>
                                    <th class="col-md-1">Meas.</th>
                                    <th class="col-md-1">Done</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($supplies as $row){
                                        echo "<tr>
                                                <td class='col-md-8 text-left'>".$row->name."</td>
                                                <td class='col-md-1'>".$row->quantity."</td>
                                                <td class='col-md-1'>".$row->measure."</td>
                                                <td class='col-md-1'><a class='btn btn-lin col-md-1' href='".base_url()."supplier/remove/".$row->supplieID."' role='button'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></a></td>
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

                        <?php if($this->session->flashdata('removeDone')){ echo $this->session->flashdata('removeDone');}?>
                            <div><p>No more supplies.</p></div>
                        </div>
                    </div>
                <?php endif;?>


				</div>
			</div>
		</div>
</header>