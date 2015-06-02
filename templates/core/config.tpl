<script type="text/javascript">
{literal}	
	$(document).ready(function(){
    {/literal}
      {if ($alerts neq '')}
        // Generating alerts
        {foreach from=$alerts item='alert'}
            alert('{$alert}');
        {/foreach}
      {/if}   
    {literal} 
	});
	
	function submitAdminDetails() {
		var errors = [];

		if (errors.length > 0) {
			var msg = '';
			var sep = '';
			for (var i=0; i<errors.length; i++) {
				msg += (sep + errors[i]);
				sep = "\n";
			}
			alert(msg);
			return false;
		}		
		$("#frm").submit();
		return true;
	}	    
{/literal}
</script>

<h1>Manage Site Configuration</h1>

<table width="100%" cellspacing="0" cellpadding="0" border="0"> 
	<tbody>
	{if ($appMsgs neq '')}
		{foreach from=$appMsgs item='appMsg'}
  			<tr><td class="emphatic">{$appMsg}</td></tr>
		{/foreach}
	{/if}	  
	<tr>
		<td>
			{if !($administratorCapability & $userOptionsMask)}
				<!-- User is not able to maintain config -->
        You are not authorised to this page
			{else}
				<div class="tableHeaderRow">
					<a href="javascript:" onclick="openWindow('{$basePath}help/config',600,640);" class="btnTurq" title="Help with configuring the system"><span class="helpBtn">Help with Config</span></a>
				</div>			      
        <table id="contentTable" class="formColours" width="100%" cellspacing="0" cellpadding="0" border="0">
          <thead></thead>
          <tbody>	
            {if ($configEntries neq '')}
              {foreach from=$configEntries item='configEntry'}
                  <tr>
                    <td class="">{$configEntry.name}</td>
                    <td class="">
                      <input type="hidden" id="config_id[]" name="config_id[]" value="{$configEntry.config_id}" />
                      <input type="hidden" id="config_name[]" name="config_name[]" value="{$configEntry.name}" />
                      <input type="text" id="config_value[]" name="config_value[]" value="{$configEntry.value}" size="{$configEntry.length}" />
                    </td>
                    <td class="">{$configEntry.comment}</td>
                  </tr>
              {/foreach}
            {else}
              <tr><td class="emphatic">No configuration entries found</td></tr>
            {/if}
          <tr><td colspan="3">&nbsp;</td></tr>
          <tr>
              <td colspan="3" style="text-align:right;">
              <input type="button" value="Submit" onclick="submitAdminDetails();" class="btnTurq" />
              </td>
          </tr>  			
          </tbody>
        </table>
      {/if}
		</td>
	</tr>
	</tbody>
</table>
{literal}
<script type="text/javascript">	
	$("#txt_title").focus();
</script>
{/literal}