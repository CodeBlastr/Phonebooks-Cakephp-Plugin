<div class="phonebooks index">
<?php if(!empty($phonebooks)): ?>
	<div class="list-group">
		<?php foreach($phonebooks as $phonebook): ?>
		<div class="list-group-item clearfix">
			<div class="span3 col-md-3">
				<?php echo $this->Media->phpthumb($phonebook['Media'][0], array('width' => 150, 'height' => 150, 'w' => 150, 'h' => 150, 'zc' => 1)); ?>
				<h4><?php echo $phonebook['Phonebook']['name']; ?></h4>
			</div>
			<div class="span3 col-md-3">
				<address>
					<p><?php echo $phonebook['Phonebook']['address_1']; ?></p>
					<?php if(!empty($phonebook['Phonebook']['address_2'])) { echo '<p>'.$phonebook['Phonebook']['address_2'].'</p>'; } ?>
					<p><?php echo $phonebook['Phonebook']['city']; ?>, <?php echo $phonebook['Phonebook']['state']; ?> <?php echo $phonebook['Phonebook']['zip']; ?></p>
				</address>
			</div>
			<div class="span3 col-md-3">
				<p><?php echo $phonebook['Phonebook']['email']; ?></p>
				<p><?php echo $phonebook['Phonebook']['phone']; ?></p>
				<p><?php echo $this->Html->link('Website', $phonebook['Phonebook']['website']); ?></p>
			</div>
			<div class="span3 col-md-3 action-links">
				<?php echo $this->Html->link('View', array('action' => 'view', $phonebook['Phonebook']['id']), array('class' => 'btn')); ?>
				<?php echo $this->Html->link('Edit', array('action' => 'edit', $phonebook['Phonebook']['id']), array('class' => 'btn')); ?>
				<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $phonebook['Phonebook']['id']), array('class' => 'btn'), ('Are you sure you want to delete '.$phonebook['Phonebook']['name'].'?')); ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php echo $this->element('paging'); ?>
<?php else: ?>
	<h4>No Results Found</h4>
<?php endif; ?>
</div>

<?php 
// set the contextual menu items 
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Phonebooks',
		'items' => array(
			$this->Html->link(__('Add'), array('controller' => 'phonebooks', 'action' => 'add'))
			)
		)
	)));