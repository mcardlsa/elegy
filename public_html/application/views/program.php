<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1>Program</h1>
        	<p>A Program for your Guests.</p>
          
            <div class="clearfix"></div>            
            
            <form class="register_form journal">
                <div class="form-group">
                    <label>Full Name</label>
                	<input type="text" class="form-control" value="<?php echo $program['name']; ?>" disabled/>
                </div>
                
                <div class="form-group">
                    <label>Date of Birth</label>
                	<input type="text" class="form-control" value="<?php echo $program['dateOfBirth']; ?>" disabled/>
                </div>
                
                 <div class="form-group">
                    <label>Date of Death</label>
                	<input type="text" class="form-control" value="<?php echo $program['dateOfDeath']; ?>" disabled/>
                    
                   
                </div>
                
                <div class="form-group">
                    <label>Surviving Family Members</label>
					<?php foreach($program['other_details']['familyMember'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>" disabled/>
					<?php } ?>
                </div>
                
                <div class="form-group">
                    <label>Pallbearers</label>
					<?php foreach($program['other_details']['pallbearer'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>" disabled/>
                    
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label>Officient</label>
                	<?php foreach($program['other_details']['officient'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>"disabled/>
                    
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label>Person Delivering the Eulogy</label>
                	<?php foreach($program['other_details']['eulogy'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>"disabled/>
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label>Songs</label>
                	<?php foreach($program['other_details']['song'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>"disabled/>
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label>Readings</label>
                	<?php foreach($program['other_details']['reading'] as $val){ ?>
                	<input type="text" class="form-control" value="<?php echo $val; ?>"disabled/>
                    
                    <?php } ?>
                </div>                
            </form>
        </div>
    </div>

