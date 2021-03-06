<?php /* Smarty version 2.6.20, created on 2013-01-06 08:38:49
         compiled from core/contact.tpl */ ?>
<script>
<?php echo '
	function submitContactDetails() {
        var email = $(\'#email\').get(0);
        var name = $(\'#name\').get(0);
        var subject = $(\'#subject\').get(0);
        var message = $(\'#message\').get(0);

        var fv = new formValidator();
        if (!name.value || name.value==\'\') {
            fv.raiseError(\'Please enter your name\', name);
        }
        if (!email.value || email.value==\'\') {
            fv.raiseError(\'Please enter your email address.\', email);
        }
        if (!subject.value || subject.value==\'\') {
            fv.raiseError(\'Please enter the subject\', subject);
        }
        if (!message.value || message.value==\'\') {
            fv.raiseError(\'Please enter your message\', message);
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
		PostBack(\'btnContactOnClick\');
		return true;
	}
'; ?>

</script>

<div class="">
    <div onkeypress="return checkSubmit(event);" style="width:400px;">
        <div class=""><h3 class="">Please enter your message details</h3></div>
        <?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
            <?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
                <p class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</p>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <div class=""><label for="name">Your name:</label></div>
        <div class=""><input name="name" id="name" type="text" size="42" value='<?php echo $this->_tpl_vars['name']; ?>
' /></div>
        <div class="clear"></div>

        <div class=""><label for="email">Your email address:</label></div>
        <div class=""><input name="email" id="email" type="text" size="42" value='<?php echo $this->_tpl_vars['email']; ?>
' /></div>
        <div class="clear"></div>

        <div class=""><label for="subject">Message subject:</label></div>
        <div class=""><input name="subject" id="subject" type="text" size="42" value='<?php echo $this->_tpl_vars['subject']; ?>
' /></div>
        <div class="clear"></div>

        <div class=""><label for="message">Enter your message:</label></div>
        <div class=""><textarea name="message" id="message" rows="8" cols="64" /><?php echo $this->_tpl_vars['message']; ?>
</textarea></div>
        <div class="clear"></div>

        <div class="contactRight" style="margin-top:6px;width:150px;"><input type="button" value="Send" onclick="submitContactDetails();" class="btnTurq" /></div>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
	document.getElementById("name").focus();
</script>