{literal}
<script>		 
	function submitLoginDetails() {
        var emailId = $('#txt_email_id').get(0);
        var captcha = $('#txt_captcha').get(0);

        var fv = new formValidator();
        if (!emailId.value || emailId.value=='') {
            fv.raiseError('Please enter your registered email address.', emailId);
        }
        if (!captcha.value || captcha.value=='') {
            fv.raiseError('Please enter the security characters', captcha);
        }
        if (fv.isError()) {
            fv.displayErrors();
            fv.setFocusToFirstError();
            return false;
        }
        $('#frm').submit();
        return true;
	}
</script>
{/literal}
<h4>Forgotten Password</h4>

{if ($userLoggedIn)}
	{* Ok *}
    <p>You are already logged in.</p>
{else }

    <input type="hidden" name="from_forgot" value="Y" />
	<div class="">
		<div style="width:600px;">
			<div style="width:100%;"><h3 class="">Please enter your user details and we will email you with instructions.</h3></div>
			{if ($appMsgs neq '')}
				{foreach from=$appMsgs item='appMsg'}
		  			<p class="emphatic">{$appMsg}</p>
				{/foreach}
			{/if}			
			<div class=""><label for="txt_email_id">Username (your email address):</label></div>
		    <div class=""><input name="txt_email_id" id="txt_email_id" type="text" size="42" value='{$txt_email_id}' /></div>
		    <div class="clear"></div>
            <div class=""><label for="txt_email_id">Please key the following security characters:</label></div>
            <div class="emphatic">{$captcha}</div>
            <div class=""><input name="txt_captcha" id="txt_captcha" type="text" size="12" value='' /></div>
            <div class="clear"></div>
		    <div class="contactRight" style="margin-top:6px;width:150px;">
                <input type="button" value="Submit" onclick="submitLoginDetails();" class="btnTurq" />
                &nbsp;
                <input type="button" value="Cancel" onclick="window.location='{$basePath}login'" class="btnTurq" />
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
    {literal}
    if ($("#txt_email_id") != '') {
	    $("#txt_captcha").focus();
    } else {
        $("#txt_email_id").focus();
    }
    {/literal}
</script>	
{/if}