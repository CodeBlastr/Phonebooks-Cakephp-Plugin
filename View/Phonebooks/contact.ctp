<div class="phonebook view">
	<div class="row-fluid clearfix">
		<div class="span5 pull-left">
			<?php echo $this->Element('Galleries.thumb', array('thumbSize' => 'large', 'model' => 'Phonebook', 'foreignKey' => $phonebook['Phonebook']['id'])); ?>
		</div>
		<div class="span7 pull-right">
			<h3><?php echo $phonebook['Phonebook']['name']; ?></h3>
			<hr />
			<div class="row-fluid">
				<div class="span6 pull-left meta">
					<strong>Website: </strong> <?php echo $this->Html->link($phonebook['Phonebook']['website'], $phonebook['Phonebook']['website'], array('target' => '_blank')); ?> </br />
				</div>
				<div class="span6 pull-right meta">
					<strong>Phone: </strong> <?php echo $phonebook['Phonebook']['phone']; ?>
				</div>
			</div>
			<hr />
			<div class="row-fluid">
				<strong>Description: </strong><span class="truncate"> <?php echo $phonebook['Phonebook']['description']; ?> </span><br />
				<strong>City: </strong> <?php echo $phonebook['Phonebook']['city']; ?> <strong> State: </strong> <?php echo $phonebook['Phonebook']['state']; ?> <strong>Zip: </strong> <?php echo $phonebook['Phonebook']['zip']; ?> <br />
				<?php if (!$this->Session->read('Auth.User.id')) : ?>				
					<div class="alert alert-info"> you must be <?php echo $this->Html->link('signed in', array('plugin' => 'phonebooks', 'controller' => 'phonebooks', 'action' => 'contact', $phonebook['Phonebook']['id'])); ?> to contact business</div>
				<?php endif; ?>
				<strong>Posted on: </strong> <?php echo ZuhaInflector::datify($phonebook['Phonebook']['created']); ?> in 
				<?php if(empty($phonebook['Category'][0])): ?>	
                	<span class="badge badge-inverse">Uncategorized</span>
               	<?php else: ?>
               		<?php foreach($phonebook['Category'] as $category): ?>
               			<span class="badge badge-inverse"><?php echo $category['name']; ?></span>
               		<?php endforeach; ?>
               	<?php endif; ?>  
			</div>
		</div>
	</div>
	
	<hr />
	
	<div class="row-fluid clearfix">
		<h3>Contact Business</h3>
		<?php echo $this->Form->create(); ?>
		<?php echo $this->Form->input('Phonebook.your_email'); ?>
		<?php echo $this->Form->input('Phonebook.your_message', array('type' => 'textarea')); ?>
		<?php echo $this->Form->end('Send'); ?>
	</div>
	
	<hr />
	
	<div class="row-fluid clearfix">
		<div class="pull-right">
			<a href="#" onclick="window.open(
				'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
				'facebook-share-dialog', 
				'width=626,height=436'); 
				return false;">
				<img width="45" height="20" title="" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAUCAYAAAAZb7T/AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oMAw8wDHWY6uMAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAmxJREFUSMfVl09Ik2Ecxz/P+769riktXTjTktUt0ZD+4CmsDtrFPHgpZOAlhN7LLnV4iR0GeV7Egg6GIIQQHiwI8lJqFBjoUMNbDNOGS7OJfza33qeLLcmt2lYyf6eH3/N7eD98f9/39/AIKSWRz2syurLBVtKiWKNEV6mqsFPpLBXa0sqGjK0lqD5SiiJE0UJbUrIci6OpqlTmo2s4HbaiBgZQhMDpsDEfXUVJpqyiB94JnkhaaNkKznf0kNrYJKVAytJQVA1hbfJN6ChSI6nG0RQVsWVht5fwbtDcM/is0NVVx//PFxen8fbCLbOBmnwVz+dQ/Yky7nS3cvtGS3awnmkW/pTbS+h7dzu50lyFruVwyNVAoAB1C4bWgL6B9/jvP8/NFr8qPTVGu/GMwcXtfaOfdqP/Z+5fQNfVlfP6cTcqFp5rZxkZMArz9kMwg210uOYI+L9yPehhKOhhyOdmrDe7lXJpMDZp48WrEJeaT/FmcoXR0cn8gBdC3PS7MYMXaAJYjBEmzEsjvKPIzTxktFNO0BOzESZmI7RePA2pJMPjc/lB1zRingvT0zfHUFdtOvfgLz2fl6clCqQSBf1Mx1raMBnBOxwDlwP3QognUwXOaYAz9ZlntZCA1NP7EzMfM1vACKVbbfoO7ypp6mrmrfEUL1cJ+Brx+vtp39GNbMpr+ai0RRJd038/3oINuyG3L81A+vKsxRv0bK8zn8lJ6XLHwcwKApc7H+2q3csQ4zMRebL6EPslPnxaRTmgKVhS7gtgS0psuoJy1GlnORYvevAfjwCXswwhpSS6tC4jX9aL/7nlLKWywi6+AwjX5/Utedc6AAAAAElFTkSuQmCC" />
			</a>
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-hashtags="bakkenbook">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div>	
	
	<hr />
	
	<div class="row-fluid clearfix">
		<?php echo $this->Element('interior-content-ads'); ?>
	</div>
	
	<hr />
	
</div>
