<?php /* Smarty version 2.6.20, created on 2013-03-02 09:12:16
         compiled from core/userEdit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'core/userEdit.tpl', 122, false),)), $this); ?>
<script type="text/javascript">
var mode = '<?php echo $this->_tpl_vars['mode']; ?>
';
<?php echo '
	function submitDetails() {
        var emailId = $(\'#txt_email_id\').get(0);
        var password = $(\'#txt_password\').get(0);
        var confirmPassword = $(\'#txt_confirm_password\').get(0);
        var fv = new formValidator();
        if (!emailId.value || emailId.value==\'\') {
            fv.raiseError(\'Please enter a valid email address.\', emailId);
        }
        if (password.value && password.value!=\'\') {
            if (!confirmPassword.value || confirmPassword.value==\'\') {
                fv.raiseError(\'Please enter a confirmation password.\', confirmPassword);
            } else {
                if (confirmPassword.value != password.value) {
                    fv.raiseError(\'Your password and confirmation password do not match.\', password);
                }
            }
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
		$("#frm").submit();
		return true;
	}

    function cancelEdit() {
        '; ?>

        window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
users/list/<?php echo $this->_tpl_vars['user']['user_id']; ?>
';
        <?php echo '
    }

$(document).ready(function(){

	});
    
  $(function() {
      $(\'#txt_created_on\').datepicker();
      $(\'#txt_updated_on\').datepicker();
  });      
'; ?>
	
</script>

<input type="hidden" name="hid_user_id" id="hid_user_id" value="<?php echo $this->_tpl_vars['user']['user_id']; ?>
" />

<h1><?php if ($this->_tpl_vars['user'] != ''): ?>Update<?php else: ?>Create<?php endif; ?> User</h1>

<table id="contentTable" class="formColours" width="100%" cellspacing="0" cellpadding="0" border="0">
	<thead></thead>
	<tbody>
	<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
		<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
  			<tr><td class="emphatic" colspan="2"><?php echo $this->_tpl_vars['appMsg']; ?>
</td></tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>	
	<?php if ($this->_tpl_vars['user']['user_id'] > 0): ?>
		<tr>
		    <td class="label">Id:</td>
		    <td><?php echo $this->_tpl_vars['user']['user_id']; ?>
</td>
		</tr>
	<?php endif; ?>	
	<tr>
		<td class="label">Role:</td>
	    <td>
        <select name="sel_user_role_id" id="sel_user_role_id">
          <?php if (( $this->_tpl_vars['userRoles'] != '' )): ?>
            <?php $_from = $this->_tpl_vars['userRoles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userRole']):
?>
                <option value="<?php echo $this->_tpl_vars['userRole']['user_role_id']; ?>
" <?php if ($this->_tpl_vars['userRole']['user_role_id'] == $this->_tpl_vars['user']['user_role_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['userRole']['role_title']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          <?php endif; ?>        
        </select>
	    </td>
	</tr>
    <tr>
		<td class="label">First name:</td>
	    <td>
	    	<input type="text" name="txt_first_name" id="txt_first_name" value="<?php echo $this->_tpl_vars['user']['first_name']; ?>
" />
	    </td>
	</tr>
    <tr>
		<td class="label">Surname:</td>
	    <td>
	    	<input type="text" name="txt_surname" id="txt_surname" value="<?php echo $this->_tpl_vars['user']['surname']; ?>
" />
	    </td>
	</tr>  
    <tr>
		<td class="label">Email:</td>
	    <td>
	    	<input type="text" name="txt_email_id" id="txt_email_id" value="<?php echo $this->_tpl_vars['user']['email_id']; ?>
" size="48" />
	    </td>
	</tr>
    <tr>
        <td class="label">Password:</td>
        <td>
            <input type="password" name="txt_password" id="txt_password" value="" size="24" autocomplete='off' />
        </td>
    </tr>
    <tr>
        <td class="label">Confirm password:</td>
        <td>
            <input type="password" name="txt_confirm_password" id="txt_confirm_password" value="" size="24" autocomplete='off' />
        </td>
    </tr>
    <tr>
		<td class="label">Account status:</td>
	    <td>
        <select name="sel_account_status" id="sel_account_status">
          <?php if (( $this->_tpl_vars['accountStatuses'] != '' )): ?>
            <?php $_from = $this->_tpl_vars['accountStatuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['accountStatus']):
?>
                <option value="<?php echo $this->_tpl_vars['accountStatus']; ?>
" <?php if ($this->_tpl_vars['accountStatus'] == $this->_tpl_vars['user']['account_status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['accountStatus']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          <?php endif; ?>        
        </select>
	    </td>
	</tr>  
	<tr>
		<td class="label">Date added:</td>
	    <td>
	    	<?php echo ((is_array($_tmp=$this->_tpl_vars['user']['created_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y %H:%M') : smarty_modifier_date_format($_tmp, '%d/%m/%Y %H:%M')); ?>

	    </td>
	</tr>
	<tr>
		<td class="label">Date updated:</td>
	    <td>
	    	<?php if ($this->_tpl_vars['user']['updated_on'] == '0000-00-00 00:00:00'): ?>&nbsp;<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['updated_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y %H:%M') : smarty_modifier_date_format($_tmp, '%d/%m/%Y %H:%M')); ?>
<?php endif; ?>
	    </td>
	</tr>  
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
	    <td colspan="2" style="text-align:right;">
			<input type="button" value="Submit" onclick="submitDetails();" class="btnTurq" />
			&nbsp;
            <input type="button" value="Cancel" onclick="cancelEdit();" class="btnTurq" />
	    </td>
	</tr>  
	</tbody>       
</table>
<script type="text/javascript">	
  <?php echo '
    $("#sel_user_role_id").focus();		
  '; ?>

</script>