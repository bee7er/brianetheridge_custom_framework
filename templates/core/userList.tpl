<script type="text/javascript">
    var searchPlaceholder = "{$searchPlaceholder}";
    {literal}
    $(document).ready(function () {
        $("#txt_searchPattern").focus(function () {
            if (this.placeholder == searchPlaceholder) {
                this.placeholder = '';
            }
        });
        $("#txt_searchPattern").blur(function () {
            if (this.placeholder == '') {
                this.placeholder = searchPlaceholder;
            }
        });
    });

    function searchOnClick() {
        PostBack('searchOnClick');
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
        if (e && e.keyCode == 13) {
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

    function editUserDetails(userId) {
        {/literal}
        window.location = '{$basePath}users/edit/'+userId;
        {literal}
    }

    function userActivityStatus(userId, status) {
        if (status == 'inactive') {
            if (confirm('Are you sure you want to make this user account inactive?')) {
                {/literal}
                window.location = '{$basePath}users/inactive/'+userId;
                {literal}
            }
        } else {
            {/literal}
            window.location = '{$basePath}users/active/'+userId;
            {literal}
        }
    }
    {/literal}
</script>

<h1>Manage Users</h1>

<div id="filter">
    <div id="search" onkeypress="return checkSubmit(event);">
        <input type="text" class="searchInput" placeholder="{$searchPlaceholder}" name="txt_searchPattern"
               id="txt_searchPattern" value="{$txt_searchPattern}"/>
        <br/><br/>
        <span class="searchInputSubmit">User role:</span>
        <select name="sel_user_role_id" id="sel_user_role_id">
            <option value="" {if $selUserRoleId==''}selected{/if}>Any</option>
        {if ($userRoles neq '')}
            {foreach from=$userRoles item='userRoleEntry'}
                <option value="{$userRoleEntry.user_role_id}"
                        {if $userRoleEntry.user_role_id==$selUserRoleId}selected{/if}>{$userRoleEntry.role_title}</option>
            {/foreach}
        {/if}
        </select>
        &nbsp;
        <span class="searchInputSubmit">User status:</span>
        <select name="sel_account_status" id="sel_account_status">
            <option value="" {if $userAccountStatus==''}selected{/if}>Any</option>
        {if ($accountStatuses neq '')}
            {foreach from=$accountStatuses item='accountStatus'}
                <option value="{$accountStatus}"
                        {if $accountStatus==$selAccountStatus}selected{/if}>{$accountStatus}</option>
            {/foreach}
        {/if}
        </select>
        &nbsp;
        <a href="javascript:searchOnClick();" class="btnTurqRI">Search</a>
    </div>
</div>

{if ($appMsgs neq '')}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <thead></thead>
    <tbody>
        {foreach from=$appMsgs item='appMsg'}
        <tr>
            <td class="emphatic">{$appMsg}</td>
        </tr>
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
        <th>User name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    {if $users}
        {foreach from=$users item='user'}
        <tr>
            <td>{$user.first_name} {$user.surname}</td>
            <td>{$user.role_title}</td>
            <td>{$user.account_status}</td>
            <td>
                <input type="button" value="Edit" onclick="editUserDetails({$user.user_id});" class="btnTurq" />
                &nbsp;
                {if $user.account_status=='active'}
                    <input type="button" value="Make Inactive" onclick="userActivityStatus({$user.user_id}, 'inactive');" class="btnTurq" />
                {else}
                    <input type="button" value="Make Active" onclick="userActivityStatus({$user.user_id}, 'active');" class="btnTurq" />
                {/if}
            </td>
        </tr>
        {/foreach}
        {else}
    <tr>
        <td colspan="99">No users, or none that match your selection criteria</td>
    </tr>
    {/if}
    </tbody>
</table>

{literal}
<script type="text/javascript">

</script>
{/literal}	