
<script type="text/javascript">
{literal}
    function deleteResource(resourceId) {
        if (confirm('Are you sure you want to delete this resource?')) {
            {/literal}
            window.location = '{$basePath}resource/delete/'+resourceId;
            {literal}
        }
    }

    function editResourceDetails(resourceId) {
        {/literal}
        window.location = '{$basePath}resource/edit/'+resourceId;
        {literal}
    }

    function createResource() {
        {/literal}
        window.location = '{$basePath}resource/create';
        {literal}
    }

    function gotoPageOnClick(page) {
        if (page) {
            PostBack('gotoPageOnClick', page);
            return true;
        }
        return false;
    }
{/literal}
</script>

<br />
<nav id="staticNav">
    <ul>
        <li><input type="button" value="Add new resource" onclick="createResource();" class="btnTurq" /></li>
    </ul>
</nav>
{if $appMsgs}
    <table cellspacing="3" cellpadding="3">
    {foreach from=$appMsgs item=appMsg}
        <tr><td class="emphatic">{$appMsg}</td></tr>
    {/foreach} 
    </table>
{/if}

<div class="tableHeaderRow">
    {if $paginationStr}
        {$paginationStr}
    {/if}
</div>

<div class="prompt-text" style="margin-left:40px;"> 
    {if $resources}
        <table cellspacing="3" cellpadding="3">
            <tr><th>Resource id</th><th>Seq</th><th>Name</th><th>Description</th><th>Type</th><th>Status</th><th>Action</th></tr>
            {foreach from=$resources item=resource}
                {* cycle values='oddRow,evenRow' assign=rowClass *} 
                <tr class="{$rowClass}">
                    <td>{$resource.id}</td>
                    <td>{$resource.seq}</td>
                    <td>{$resource.name}</td>
                    <td>{$resource.description|substr:0:64}</td>
                    <td>{$resource.type}</td>
                    <td>{$resource.status}</td>
                    <td>
                        <input type="button" value="Edit" onclick="editResourceDetails({$resource.id});" class="btnTurq" />
                        <input type="button" value="Delete" onclick="deleteResource({$resource.id});" class="btnTurq" />
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
</div>	
