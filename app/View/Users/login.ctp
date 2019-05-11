<div>
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal'));?>
    <fieldset>
        <legend>ログイン</legend>
        <?php
//        echo $this->Form->input('email', array( 'label' => 'メールアドレス', 'required' => 'required'));
        echo $this->Form->input('username', array( 'label' => 'UserName', 'required' => 'required'));
        echo $this->Form->input('password', array( 'label' => 'パスワード', 'required' => 'required'));
        echo $this->Form->submit('ログイン');
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
