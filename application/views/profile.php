
<div class="gtco-container">

    <?php
        if($this->session->flashdata('reserved')){

            echo "<div class='row'>
                    <div class='col-md-8 col-md-offset-2 text-center gtco-heading'>
                        <h3 class='cursive-font primary-color'>Thank you for reserving table in Savory restoraunt.</h3>
                        <p>Now you just need to confirm your reservation with paying $5 <br>(This will be calculated on giving bill).</p>
                    </div>
                </div>";
        }
        //
        // prikazi njegov profil itd 
        // prikazi sta je sve mislio da rezervise ali samo one stvari koje su vece od danasnjeg datuma ostale obrisi
        // ako je nesto rezervisano a proso datum prebaci u history
        //
    ?>



	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
			<h2 class="cursive-font primary-color"><?php echo $userInfo->firstName .' '. $userInfo->lastName ;?></h2>
			<p><?php echo $userInfo->email;?></p>
			<p><?php 
                $date = new DateTime();
                $date->setTimestamp($userInfo->timeOfReg);
                echo $date->format('d/m/Y H:i:s');
            ?></p>
		</div>
	</div>

    
    <?php
        $date = new DateTime();

        foreach($userReservations as $row){
            $date->setTimestamp($row->reservationTime);
            $time = $date->format('d/m/Y H:i');
            if($row->reservationStatus == 1){
                echo "<div class='row'>
                    <div class='col-md-8 col-md-offset-2 text-center gtco-heading'>
                        Tables is reserved for: ".$time."
                    </div>
                </div>";
            }
            else{
            echo "<div class='row'>
                <div class='col-md-8 col-md-offset-2 text-center gtco-heading'>
                    Reservation for: ".$time." --- ".anchor('checkout/pay/'.$row->reservationID,'Pay reservation')." or ".anchor('profile/removeReservation/'.$row->reservationID,'Delete reservation')."
                </div>
            </div>";
            }
        }
    ?>

</div>