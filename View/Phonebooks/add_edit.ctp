<div id="PhonebookAddEdit">
	
	<?php echo $this->Form->create('Phonebooks.Phonebook'); ?>
	
		<?php if(CakePlugin::loaded('Media')) { echo $this->Element('Media.media_selector', array('multiple' => false)); } ?>
		
		<?php if(!empty($this->request->data['Phonebook']['id'])) { echo $this->Form->input('Phonebook.id'); } ?>
		
		<?php echo $this->Form->input('Phonebook.name'); ?>
		
		<?php echo $this->Form->input('Phonebook.description', array('type' => 'textarea')); ?>
		
		<?php echo $this->Form->input('Phonebook.email'); ?>
		
		<?php echo $this->Form->input('Phonebook.website'); ?>
		
		<?php echo $this->Form->input('Phonebook.phone'); ?>
		
		<?php echo $this->Form->input('Phonebook.address_1'); ?>
		
		<?php echo $this->Form->input('Phonebook.address_2'); ?>
		
		<?php echo $this->Form->input('Phonebook.city'); ?>
		
		<?php echo $this->Form->input('Phonebook.state', array('type' => 'select', 'options' => states())); ?>
		
		<?php echo $this->Form->input('Phonebook.zip'); ?>
	
	
	<?php echo $this->Form->end('Save'); ?>
</div>
