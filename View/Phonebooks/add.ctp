<div class="phonebooks form">
	<?php echo $this->Form->create('Phonebook', array('type' => 'file')); ?>
	<?php //echo $this->Form->input('Phonebook.id'); ?>
	<div class="row-fluid">
		<div class="span6">
			<?php echo $this->Form->input('Phonebook.name'); ?>
		</div>
		<div class="span6">
			<?php echo $this->Form->input('GalleryImage.filename', array('type' => 'file')); ?>
		</div>
	</div>

	<div class="row-fluid">
		<?php echo $this->Form->input('Phonebook.description', array('type' => 'textarea')); ?>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.email'); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.website'); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.phone'); ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.address_1'); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.address_2'); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.city'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo CakePlugin::loaded('Categories') ? $this->Form->input('Category.Category', array('multiple' => 'checkbox', 'legend' => false, 'class' => 'input-medium', 'label' => $categoryLabel[key($categoryLabel)], 'options' => $categories, 'limit' => 3)) : null; ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.state', array('type' => 'select', 'options' => states(), 'class' => 'input-medium')); ?>
		</div>
		<div class="span4">
			<?php echo $this->Form->input('Phonebook.zip'); ?>
		</div>
	</div>
	
	<?php echo $this->Form->end('Save'); ?>
</div>

		
<?php //echo $this->Form->input('PhonebookService.0.name', array('label'=> 'Service Name')); ?>
<?php //echo $this->Form->input('PhonebookService.0.description', array('label'=> 'Service Description')); ?>
<?php //echo $this->Form->input('PhonebookService.0.price', array('label'=> 'Service Price')); ?>

