<div class="test1" style="padding : 20px; ">
  <a href="#" id="test1"> [ Test1 ] </a>
<br />
<?php $cdn_domain='aaaa.com'; ?>
<?php echo ($cdn_domain); ?>

</div>

<div class="row">
  <div class="col-md-3"  >
	<div class="actions" style="margin : 20px;">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
<!--
			<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add2')); ?></li>
 -->
			<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add2')
							    ,array(
								'class' => 'btn btn-primary',
								'escape' => false
								));
			 ?></li>
		</ul>
	</div>

  </div>
  <div class="col-md-9" id="container_right">
	<div class="posts index" style="margin : 20px;" >
		<h2 style="color:blue;"><?php echo __('Posts'); ?></h2>
		<table class="table table-striped" cellpadding="0" cellspacing="0">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('body'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($posts as $post): ?>
		<tr id="post_<?php echo h($post['Post']['id']); ?>">
			<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['body']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<a href="">
				<?php echo $this->Html->link(__('View'), array('action' => 'view',  $post['Post']['id'])
							    ,array( 'class' => 'btn btn-primary', 'escape' => false) ); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])
				,array( 'class' => 'btn btn-primary', 'escape' => false) );  ?>
				<?php echo $this->Form->postLink(__('[ Delete ]'), array('action' => 'delete', $post['Post']['id'])
				, array(  'class' => 'btn btn-default' , 'escape' => false,'confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?>
				&nbsp;<a href="" onClick="delete_low(<?php echo($post['Post']['id']); ?>);">[del-Ajax]</a>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<div class="paging">
<!--
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		<br />

 -->
		<!-- test  -->
		 <?php
		    echo $this->Paginator->prev(' [ 前へ ] ' . __(''), array(), null, array('class' => 'prev disabled'));
		  ?>
		      
		  <?php
		    echo $this->Paginator->counter(array(
		        'format' => __('&nbsp;{:page}/{:pages}ページを表示&nbsp;')
		    ));
		  ?>
		      
		  <?php
		    echo $this->Paginator->next(__('') . ' [ 次へ ] ', array(), null, array('class' => 'next disabled'));
		  ?>
		</div>
	</div>
  <?php 
    //echo S_SITE_CONTEXT . "<br />"; 
    //echo $this->name;
  ?>

  </div>
  <script>
  $(function(){
	  $('#test1').click(function(e){
//	    alert('#test1');
	      $.get('/<?php echo S_SITE_CONTEXT;  ?>/posts/test1' ,{}, function(res){
	alert( res.result );
	          //$('#post_' +res.result).fadeOut();
	        }, "json");

	  });
  });
  </script>
<?php echo $this->Html->script('post.js?20170309');  ?>
</div>


