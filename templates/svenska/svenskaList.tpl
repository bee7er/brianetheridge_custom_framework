<script type="text/javascript">
	var searchPlaceholder = "{$searchPlaceholder}";
    var basePath = "{$basePath}";
{literal}
    $(document).ready(function(){
        $("#txt_searchPattern").focus(function(){
            if (this.placeholder==searchPlaceholder) {
                this.placeholder='';
            }
        });
        $("#txt_searchPattern").blur(function(){
            if (this.placeholder=='') {
                this.placeholder=searchPlaceholder;
            }
        });
        $(function() {
            // Set up all elements to use the enhanced tooltip
            $('*').tooltip({
                track: true,
                delay: 0,
                showURL: false,
                opacity: 1,
                fixPNG: true,
                showBody: " - ",
                fade: 250,
                extraClass: "tooltip",
                top: 8,
                left: 5
            });
        });
    });
    
	function searchOnClick() {
        PostForm(basePath+'svenska', 'searchOnClick');
        return true;
	}
    
	function gotoPageOnClick(page) {
        if (page) {
            PostBack('gotoPageOnClick', page);
            return true;
        }
        return false;
	}
    
	function checkSubmit(e) {
        if(e && e.keyCode == 13) {
          PostBack('searchOnClick');
          return true;
        }
	} 
    
	function checkForSearch() {
        if ($('#txt_searchPattern').val() == '' || $('#txt_searchPattern').val() == searchPlaceholder) {
          alert('Please enter your search pattern');
          return false;
        }
        PostBack('searchOnClick');
        return true;
	}     
{/literal}	
</script>
	
    <h1>Swedish Words and Phrases</h1>
    <p>
        I have had a long term passion for all things Swedish. However, trying to learn a language without ever speaking it is difficult.
        This page is intended to help me learn some vocabulary and pronunciation.
    </p>

	<div id="filter">
		<div id="search" onkeypress="return checkSubmit(event);">
				<input type="text" class="searchInput" title="{$specialChars}" placeholder="{$searchPlaceholder}" name="txt_searchPattern" id="txt_searchPattern" value="{$txt_searchPattern}" />
        &nbsp;
				<a href="javascript:searchOnClick();" class="btnTurqRI">Search</a>
		</div>
	</div>
            
	{if ($appMsgs neq '')}
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead></thead>
			<tbody>    
				{foreach from=$appMsgs item='appMsg'}
		  			<tr><td class="emphatic">{$appMsg}</td></tr>
				{/foreach}
			</tbody>
		</table>	
	{/if}
  
	<div class="tableHeaderRow">
		{if $paginationStr}
            {$paginationStr}
		{/if}
	</div>  

  <table cellpadding="0" cellspacing="0" border="0" id="contentTable" width="100%">
    <thead>
      <tr>
        <th>Swedish Word/Phrase</th>
        <th>Pronunciation</th>
        <th>English Equivalent</th>
      </tr>
    </thead>
    <tbody>
      {if $phrases}
        {foreach from=$phrases item='phrase'}
          <tr>
            <td>{$phrase.fphrase}</td>
            <td>{$phrase.pronunciation}</td>
            <td>{$phrase.ephrase}</td>
          </tr>
        {/foreach}
      {else}
          <tr><td colspan="99">No phrases found</td></tr>
      {/if}
    </tbody>
  </table>	
	
{literal}
<script type="text/javascript">	
	
</script>
{/literal}	