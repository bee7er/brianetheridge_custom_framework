<script>
    var basePath = '{$basePath}';
{literal}
	function submitLoginDetails() {
        var emailId = $('#txt_email_id').get(0);
        var password = $('#txt_password').get(0);

        var fv = new formValidator();
        if (!emailId.value || emailId.value=='') {
            fv.raiseError('Please enter your registered email address.', emailId);
        }
        if (!password.value || password.value=='') {
            fv.raiseError('Please enter your password', password);
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
		PostBack('btnLoginOnClick');
		return true;
	}

    function submitForgotPwdDetails() {
        $('#frm').get(0).action = basePath+'forgotPwd';
        $('#frm').submit();
        return true;
    }
	
	function checkSubmit(e) {
	   if (e && e.keyCode == 13) {
	      return submitLoginDetails();
	   }
	}
{/literal}
</script>
<h4>Welcome to the home of Number 9 Software.</h4>

{if ($userLoggedIn)}
	{* Ok *}
    <p>You are already logged in.</p>
{else }
	<div class=""> 
		<div onkeypress="return checkSubmit(event);" style="width:400px;">
			<div class=""><h3 class="">Please enter your login details</h3></div>
			{if ($appMsgs neq '')}
				{foreach from=$appMsgs item='appMsg'}
		  			<p class="emphatic">{$appMsg}</p>
				{/foreach}
			{/if}			
			<div class=""><label for="txt_email_id">Username:</label></div>
		    <div class=""><input name="txt_email_id" id="txt_email_id" type="text" size="42" value='{$txt_email_id}' /></div>
		    <div class="clear"></div>
		
			<div class="">
				<div class=""><label for="txt_password">Password:</label></div>
			    <div class=""><input name="txt_password" id="txt_password" type="password" size="42" /></div> 
			    <div class="clear"></div>
			</div>
		    <div class="contactRight" style="margin-top:6px;width:150px;"><input type="button" value="Submit" onclick="submitLoginDetails();" class="btnTurq" /></div>
		    <div class="clear"></div>			
		</div>
		{if ($siteIsOffline)}
			<div class="">
				<div class=""><h3 class="emphatic">Site Offline</h3></div>
			</div>
        {else}
            <div class="">
                <h3 class="">Forgotten your password?</h3>
                <div class="">If you have forgotten your password <a href="javascript:submitForgotPwdDetails();" style="color:#1b85af;">Click here</a> to reset it.</div>
            </div>
		{/if}
	</div>
<script type="text/javascript">
	document.getElementById("txt_email_id").focus();
</script>	
{/if}