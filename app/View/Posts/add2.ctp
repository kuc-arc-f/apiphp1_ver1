<div class="row">
  <div class="col-md-3"  >
	<div class="actions" style="margin : 20px;">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>

			<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		</ul>
	</div>
  </div>
  <div class="col-md-9" id="container_right" >
	<div class="posts form" style="margin : 20px;">

	<?php echo $this->Form->create('Post'); ?>
		<fieldset>
			<legend><?php echo __('Add Post'); ?></legend>
		<?php
//			echo $this->Form->input('title');
//			echo $this->Form->input('body');
		?>
	        <div class="form-group">
	            <label for="name">title</label>
	            <input name="data[Post][title]" id="name" type="text" class="form-control" />
	        </div>

	        <div class="form-group">
	            <label for="name">body</label>
<!--
	            <input  id="age" type="textarea" class="form-control" />
 -->
	<br />
		    <textarea name="data[Post][body]" class="form-control" rows="3"></textarea>
	        </div>

		</fieldset>
	<?php echo $this->Form->end(__('Submit') ); ?>
	</div>
  </div>
</div>


