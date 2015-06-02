<?php /* Smarty version 2.6.20, created on 2013-08-02 04:19:30
         compiled from core/change_pwd.tpl */ ?>
<script>
    var basePath = '<?php echo $this->_tpl_vars['basePath']; ?>
';
<?php echo '
	function submitLoginDetails() {
        var password = $(\'#txt_password\').get(0);
        var confirmPassword = $(\'#txt_confirm_password\').get(0);

        var fv = new formValidator();
        if (!password.value || password.value==\'\') {
            fv.raiseError(\'Please enter a new password\', password);
        }
        if (!confirmPassword.value || confirmPassword.value==\'\') {
            fv.raiseError(\'Please enter a confirmation password\', confirmPassword);
        }
        if (!fv.isError()) {
            if (confirmPassword.value != password.value) {
                fv.raiseError(\'Confirmation password must equal your new password\', confirmPassword);
            }
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
        $(\'#frm\').attr(\'action\',basePath+\'forgotPwd/changePwd\');
        $(\'#frm\').submit();
        return true;
	}
'; ?>

</script>
<h4>Reset Your Password</h4>

<?php if (( $this->_tpl_vars['userLoggedIn'] )): ?>
	    <p>You are already logged in.</p>
<?php else: ?>
	<div class="">
		<div style="width:600px;">
            <input type="hidden" name="token" id="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />

			<div style="width:100%;"><h3 class="">Please enter your new password details.</h3></div>
			<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
				<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
		  			<p class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</p>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>			
			<div class=""><label for="txt_password">Password</label></div>
		    <div class=""><input name="txt_password" id="txt_password" type="password" size="20" value='' autocomplete='off' /></div>
		    <div class="clear"></div>
            <div class=""><label for="txt_confirm_password">Confirm password</label></div>
            <div class=""><input name="txt_confirm_password" id="txt_confirm_password" type="password" size="20" value='' autocomplete='off' /></div>
            <div class="clear"></div>
		    <div class="contactRight" style="margin-top:6px;width:150px;">
                <input type="button" value="Submit" onclick="submitLoginDetails();" class="btnTurq" />
            </div>
		    <div class="clear"></div>			
		</div>
		<?php if (( $this->_tpl_vars['siteIsOffline'] )): ?>
			<div class="">
				<div class=""><h3 class="emphatic">Site Offline</h3></div>
			</div>		
		<?php endif; ?>
	</div>
<script type="text/javascript">
	$("#txt_password").focus();
</script>	
<?php endif; ?>