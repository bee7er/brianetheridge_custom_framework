<script type="text/javascript">
{literal}	
	$(document).ready(function(){
	});
{/literal}	
</script>

<h4>Welcome to the <strong>Healthcare-Learning Company</strong> Clinician application.</h4>

<table width="100%" cellspacing="0" cellpadding="0" border="0"> 
	<tr>
		<td id="pageTitle"><h1>Site Offline</h1></td>
	</tr>
	{if ($appMsgs neq '')}
		{foreach from=$appMsgs item='appMsg'}
  			<tr><td class="emphatic">{$appMsg}</td></tr>
		{/foreach}
	{/if}	
	<tr><td>&nbsp;</td></tr>
	<tr><td>We are carrying out an essential upgrade to the website.</td></tr>
	<tr><td>Upgrades normally do not last more than 30 minutes, so please check back later.</td></tr>
	<tr><td class="offline">Click here to <a href="{$basePath}">check if the site is available once more</a>.</td></tr>
	<tr><td>&nbsp;</td></tr>	
  {if (!$userLoggedIn)}
    <tr><td class="offline">Click here to <a href="{$basePath}login">access the login page</a>.</td></tr>
  {/if}    
</table>
{literal}
<script type="text/javascript">	
	$("#txt_title").focus();
</script>
{/literal}