<script>
    var basePath = '{$basePath}';
{literal}
	function submitLoginDetails() {
        var password = $('#txt_password').get(0);
        var confirmPassword = $('#txt_confirm_password').get(0);

        var fv = new formValidator();
        if (!password.value || password.value=='') {
            fv.raiseError('Please enter a new password', password);
        }
        if (!confirmPassword.value || confirmPassword.value=='') {
            fv.raiseError('Please enter a confirmation password', confirmPassword);
        }
        if (!fv.isError()) {
            if (confirmPassword.value != password.value) {
                fv.raiseError('Confirmation password must equal your new password', confirmPassword);
            }
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
        $('#frm').attr('action',basePath+'forgotPwd/changePwd');
        $('#frm').submit();
        return true;
	}
{/literal}
</script>
<h4>Reset Your Password</h4>

{if ($userLoggedIn)}
	{* Ok *}
    <p>You are already logged in.</p>
{else }
	<div class="">
		<div style="width:600px;">
            <input type="hidden" name="token" id="token" value="{$token}" />

			<div style="width:100%;"><h3 class="">Please enter your new password details.</h3></div>
			{if ($appMsgs neq '')}
				{foreach from=$appMsgs item='appMsg'}
		  			<p class="emphatic">{$appMsg}</p>
				{/foreach}
			{/if}			
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
		{if ($siteIsOffline)}
			<div class="">
				<div class=""><h3 class="emphatic">Site Offline</h3></div>
			</div>		
		{/if}
	</div>
<script type="text/javascript">
	$("#txt_password").focus();
</script>	
{/if}