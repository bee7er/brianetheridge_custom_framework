<script type="text/javascript">
var mode = '{$mode}';
{literal}
	function submitDetails() {
        var emailId = $('#txt_email_id').get(0);
        var password = $('#txt_password').get(0);
        var confirmPassword = $('#txt_confirm_password').get(0);
        var fv = new formValidator();
        if (!emailId.value || emailId.value=='') {
            fv.raiseError('Please enter a valid email address.', emailId);
        }
        if (password.value && password.value!='') {
            if (!confirmPassword.value || confirmPassword.value=='') {
                fv.raiseError('Please enter a confirmation password.', confirmPassword);
            } else {
                if (confirmPassword.value != password.value) {
                    fv.raiseError('Your password and confirmation password do not match.', password);
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
        {/literal}
        window.location = '{$basePath}users/list/{$user.user_id}';
        {literal}
    }

$(document).ready(function(){

	});
    
  $(function() {
      $('#txt_created_on').datepicker();
      $('#txt_updated_on').datepicker();
  });      
{/literal}	
</script>

<input type="hidden" name="hid_user_id" id="hid_user_id" value="{$user.user_id}" />

<h1>{if $user neq ''}Update{else}Create{/if} User</h1>

<table id="contentTable" class="formColours" width="100%" cellspacing="0" cellpadding="0" border="0">
	<thead></thead>
	<tbody>
	{if ($appMsgs neq '')}
		{foreach from=$appMsgs item='appMsg'}
  			<tr><td class="emphatic" colspan="2">{$appMsg}</td></tr>
		{/foreach}
	{/if}	
	{if $user.user_id gt 0}
		<tr>
		    <td class="label">Id:</td>
		    <td>{$user.user_id}</td>
		</tr>
	{/if}	
	<tr>
		<td class="label">Role:</td>
	    <td>
        <select name="sel_user_role_id" id="sel_user_role_id">
          {if ($userRoles neq '')}
            {foreach from=$userRoles item='userRole'}
                <option value="{$userRole.user_role_id}" {if $userRole.user_role_id==$user.user_role_id}selected{/if}>{$userRole.role_title}</option>
            {/foreach}
          {/if}        
        </select>
	    </td>
	</tr>
    <tr>
		<td class="label">First name:</td>
	    <td>
	    	<input type="text" name="txt_first_name" id="txt_first_name" value="{$user.first_name}" />
	    </td>
	</tr>
    <tr>
		<td class="label">Surname:</td>
	    <td>
	    	<input type="text" name="txt_surname" id="txt_surname" value="{$user.surname}" />
	    </td>
	</tr>  
    <tr>
		<td class="label">Email:</td>
	    <td>
	    	<input type="text" name="txt_email_id" id="txt_email_id" value="{$user.email_id}" size="48" />
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
          {if ($accountStatuses neq '')}
            {foreach from=$accountStatuses item='accountStatus'}
                <option value="{$accountStatus}" {if $accountStatus==$user.account_status}selected{/if}>{$accountStatus}</option>
            {/foreach}
          {/if}        
        </select>
	    </td>
	</tr>  
	<tr>
		<td class="label">Date added:</td>
	    <td>
	    	{$user.created_on|date_format:'%d/%m/%Y %H:%M'}
	    </td>
	</tr>
	<tr>
		<td class="label">Date updated:</td>
	    <td>
	    	{if $user.updated_on=='0000-00-00 00:00:00'}&nbsp;{else}{$user.updated_on|date_format:'%d/%m/%Y %H:%M'}{/if}
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
  {literal}
    $("#sel_user_role_id").focus();		
  {/literal}
</script>