<div class="didyoumeanLanguages form">
<?php echo $this->Form->create('DidyoumeanLanguage');?>
	<fieldset>
 		<legend><?php __('Edit Didyoumean Language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
    <?php echo $this->element('menu'); ?>
    <?php echo $this->element('language_menu'); ?>
</div>