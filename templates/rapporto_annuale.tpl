<?php require_once "views/layouts/header.php"; ?>

<div class="row">
    <div class="col-md-12">
        <h1><i class="fa fa-file-text"></i>  <?php echo Yii::t('app', 'Contract report'); ?></h1>

		<form action="genera_rapporto_annuale.php" method="post" name="form1" class="form-horizontal well">

			<h4>Rapporto riassuntivo per mese</h4>
		
			<div class="form-group">
			    <label for="date_year" class="col-lg-2 control-label"><?php echo Yii::t('app', 'Dal'); ?></label>
			    <div class="col-lg-10">
			    	<select id="date_year" name="date_year">
			    		<?php for ($i = 2001; $i <= date('Y', strtotime("next year")); $i++): ?>
			    			<option value="<?php echo $i; ?>" <?php if ($i == date("Y", time()): ?>selected="selected"<?php endif; ?>><?php echo $i; ?></option>
			    		<?php endfor; ?>
			    	</select>
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Create'); ?></button>
			    </div>
			</div>

		</form>

		<form action="genera_rapporto_annuale2.php" method="post" name="form1" class="form-horizontal well">

			<h4>Rapporto dettagliato per Fattura</h4>
		
			<div class="form-group">
			    <label for="date_year" class="col-lg-2 control-label"><?php echo Yii::t('app', 'Dal'); ?></label>
			    <div class="col-lg-10">
			    	<select id="date_year" name="date_year">
			    		<?php for ($i = 2001; $i <= date('Y', strtotime("next year")); $i++): ?>
			    			<option value="<?php echo $i; ?>" <?php if ($i == date("Y", time()): ?>selected="selected"<?php endif; ?>><?php echo $i; ?></option>
			    		<?php endfor; ?>
			    	</select>
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Create'); ?></button>
			    </div>
			</div>

		</form>
    </div>
</div>

<?php require_once "views/layouts/footer.php"; ?>
