
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
					<td><h3>Error detected</h3></td>
				</tr>
				<tr>
					<td class="contentpadding">
						<table width="100%" cellspacing="0" cellpadding="0">					
							{foreach from=$error_messages item=message}
								<tr><td class="contenttxt emphatic">{$message}</td></tr>			
							{/foreach}	
						</table>
					</td>
					<tr><td>&nbsp;</td></tr>		
				</tr>
				<tr>
					<td class="contenttxt">
						{if $inPopup}							
							<a href="javascript:window.close()">Click here</a> to close this window.
						{else}
							<a href="{$basePath}home">Click here</a> to return to the homepage.
						{/if}
					</td>
				</tr>				
			</table>
		</td>
	</tr>
</table>
