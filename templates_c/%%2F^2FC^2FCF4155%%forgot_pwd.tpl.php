<?php /* Smarty version 2.6.20, created on 2013-07-28 21:59:31
         compiled from core/forgot_pwd.tpl */ ?>
<?php echo '
<script>		 
	function submitLoginDetails() {
        var emailId = $(\'#txt_email_id\').get(0);
        var captcha = $(\'#txt_captcha\').get(0);

        var fv = new formValidator();
        if (!emailId.value || emailId.value==\'\') {
            fv.raiseError(\'Please enter your registered email address.\', emailId);
        }
        if (!captcha.value || captcha.value==\'\') {
            fv.raiseError(\'Please enter the security characters\', captcha);
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
        $(\'#frm\').submit();
        return true;
	}
</script>
'; ?>

<h4>Forgotten Password</h4>

<?php if (( $this->_tpl_vars['userLoggedIn'] )): ?>
	    <p>You are already logged in.</p>
<?php else: ?>

    <input type="hidden" name="from_forgot" value="Y" />
	<div class="">
		<div style="width:600px;">
			<div style="width:100%;"><h3 class="">Please enter your user details and we will email you with instructions.</h3></div>
			<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
				<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
		  			<p class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</p>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>			
			<div class=""><label for="txt_email_id">Username (your email address):</label></div>
		    <div class=""><input name="txt_email_id" id="txt_email_id" type="text" size="42" value='<?php echo $this->_tpl_vars['txt_email_id']; ?>
' /></div>
		    <div class="clear"></div>
            <div class=""><label for="txt_email_id">Please key the following security characters:</label></div>
            <div class="emphatic"><?php echo $this->_tpl_vars['captcha']; ?>
</div>
            <div class=""><input name="txt_captcha" id="txt_captcha" type="text" size="12" value='' /></div>
            <div class="clear"></div>
		    <div class="contactRight" style="margin-top:6px;width:150px;">
                <input type="button" value="Submit" onclick="submitLoginDetails();" class="btnTurq" />
                &nbsp;
                <input type="button" value="Cancel" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
login'" class="btnTurq" />
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
    <?php echo '
    if ($("#txt_email_id") != \'\') {
	    $("#txt_captcha").focus();
    } else {
        $("#txt_email_id").focus();
    }
    '; ?>

</script>	
<?php endif; ?>