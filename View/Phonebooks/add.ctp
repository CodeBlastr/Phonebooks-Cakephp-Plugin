<div class="phonebooks form">
	<?php echo $this->Form->create('Phonebook', array('type' => 'file')); ?>
	<div class="col-md-12 clearfix">
		<div class="span6 col-md-6">
			<?php echo $this->Form->input('Phonebook.name'); ?>
		</div>
		<div class="span6 col-md-6">
			<?php echo CakePlugin::loaded('Media') ? $this->Element('Media.selector', array('media' => $this->request->data['Media'], 'multiple' => false)) : null; ?>
		</div>
	</div>

	<div class="col-md-12 clearfix">
		<div class="col-md-12">
			<?php echo $this->Form->input('Phonebook.description', array('type' => 'textarea')); ?>
		</div>
	</div>

	<div class="col-md-12 clearfix">
		<div class="span4 col-md-4">
			<?php echo $this->Form->input('Phonebook.email'); ?>
		</div>
		<div class="span4 col-md-4">
			<?php echo $this->Form->input('Phonebook.website'); ?>
		</div>
		<div class="span4 col-md-4">
			<?php echo $this->Form->input('Phonebook.phone'); ?>
		</div>
	</div>
	
	<div class="col-md-12 clearfix">
		<div class="span4 col-md-3">
			<?php echo $this->Form->input('Phonebook.address_1'); ?>
		</div>
		<div class="span4 col-md-3">
			<?php echo $this->Form->input('Phonebook.address_2'); ?>
		</div>
		<div class="span4 col-md-3">
			<?php echo $this->Form->input('Phonebook.city'); ?>
		</div>
		<div class="span4 col-md-1">
			<?php echo $this->Form->input('Phonebook.state', array('type' => 'select', 'options' => states(), 'class' => 'input-medium')); ?>
		</div>
		<div class="span4 col-md-2">
			<?php echo $this->Form->input('Phonebook.zip'); ?>
		</div>
	</div>

	<div class="col-md-12 clearfix">
		<div class="span4 col-md-4">
			<?php echo $this->Form->input('Phonebook.country', array('options' => Zuha::enum('COUNTRIES', null, array('fields' => array('Enumeration.name', 'Enumeration.name'))))); ?>
		</div>
		<div class="span4 col-md-4">
			<?php echo CakePlugin::loaded('Categories') ? $this->Form->input('Category.Category', array('multiple' => 'checkbox', 'legend' => false, 'class' => 'input-medium', 'label' => $categoryLabel[key($categoryLabel)], 'options' => $categories, 'limit' => 3)) : null; ?>
		</div>
	</div>
	

	<div class="col-md-12 clearfix">
		<div class="col-md-12">
			<?php echo $this->Form->end('Save'); ?>
		</div>
	</div>
	
</div>

		
<?php //echo $this->Form->input('PhonebookService.0.name', array('label'=> 'Service Name')); ?>
<?php //echo $this->Form->input('PhonebookService.0.description', array('label'=> 'Service Description')); ?>
<?php //echo $this->Form->input('PhonebookService.0.price', array('label'=> 'Service Price')); ?>
<?php 
// set the contextual menu items 
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Phonebooks',
		'items' => array(
			$this->Html->link(__('List'), array('controller' => 'phonebooks', 'action' => 'index')),
			)
		)
	)));

