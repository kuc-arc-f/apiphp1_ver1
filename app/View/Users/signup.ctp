<div>
	<?php echo $this->Form->create('User', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend>ユーザー登録</legend>
		<?php
//			echo $this->Form->input('email', array('label' => 'メールアドレス', 'required' => 'required'));
			echo $this->Form->input('username', array('label' => 'UserName', 'required' => 'required'));
			echo $this->Form->input('password', array('label' => 'パスワード', 'required' => 'required'));
		?>
		<?php echo $this->Form->submit('登録');?>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>