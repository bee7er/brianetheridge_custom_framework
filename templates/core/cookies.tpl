
{literal}  
<script type="text/JavaScript">
	$(document).ready(function(){

	});
</script>
{/literal}
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top" class="gradientbg" style="padding-left:20px;">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td><h3>Cookies</h3></td>
				</tr>
				<tr>
					<td class="contentpadding">
						<table width="100%" cellspacing="0" cellpadding="0">					
							{foreach from=$appMsgs item=message}
								<tr><td class="contenttxt emphatic">{$message}</td></tr>			
							{/foreach}	
						</table>
					</td>
					<tr><td>&nbsp;</td></tr>		
				</tr>
				<tr>
					<td class="contenttxt">
                        I use cookies on this website to track sessions only, and not to do anything sinister.
					</td>
				</tr>
            </table>
		</td>
	</tr>
</table>
