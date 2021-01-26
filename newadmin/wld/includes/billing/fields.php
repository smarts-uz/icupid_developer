<div class="page">
	<div class="heading">
		<h2>Manage Fields</h2>
	</div>
	<br/>
	<div class="content">
		
		<form name="form1" method="post" action="">
			<input name="do" type="hidden" value="addf" class="hidden">
			<input name="mid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
			<input name="market_id" type="hidden" value="<?=$_REQUEST['market_id'] ?>" class="hidden">

			<ul class="form">
				<div class="box_body">
				<li>
					<label><?=$admin_billing[8] ?>: </label>
					<input name="name" type="text" size="40" maxlength="255">
				</li>
				<li>
					<label><?=$admin_billing[9] ?>: </label>
					<input name="value" type="text" size="40" maxlength="255">
				</li>
				<li>
					<label><?=$admin_billing[10] ?>: </label>
				    <select class="input" name="type">
				    	<option value="hidden">hidden field</option>
			        </select>
				</li>
				<li>
					<input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn">
				</li>
				</div>
			</ul>
		</form>

		<br class="clear">
		<div id="header-text">
			<h2><?=$admin_billing[11] ?></h2>
		</div>

		<form method="post" action=""  name="profile2" onSubmit="return CheckMemberForm2();">
			<input name="do" type="hidden" value="none" id="do2" class="hidden">
			<input name="mid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
			<input name="market_id" type="hidden" value="<?php echo $_REQUEST['market_id'];?>">
			<table class="widefat">
            	<thead>
                	<tr> 
	                    <th></th>
	                    <th><?=$admin_billing[8] ?></th>
	                    <th><?=$admin_billing[9] ?></th>
                  	</tr>
            	</thead>
                <tbody>
                	<?php $totalnum =WLDDisplayRows($_REQUEST['market_id'],$_REQUEST['id']); ?>
                </tbody>
			</table>

			<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>

			<br class="clear">

			<div class="bar_save">

				<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca2(<?=$totalnum ?>)"/>
				<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua2(<?=$totalnum ?>)"/> -
				<input type="button" value="<?=$admin_button_val[5] ?>" class="NormBtn"  onclick="WLDChangeOption2('paymentitemdelete');"/>

			</div>
		</form>
		<br class="clear">	  

	</div>

</div>