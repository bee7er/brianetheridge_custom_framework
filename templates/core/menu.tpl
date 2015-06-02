<ul>
    <li><a class="btnTurq" href="{$basePath}home"><span class="homeBtn">Home</span></a></li>
    {if (!$siteIsOffline)}
        {if ($page!='svenskaList')}
            <li><a class="btnTurq" href="{$basePath}svenska"><span class="svenskaBtn">Learning Swedish</span></a></li>
        {/if}
    {/if}
{if (!$userLoggedIn)}
    {if ($page!='login')}
        <li><a class="btnTurq" href="{$basePath}login"><span class="loginBtn">Login</span></a></li>
    {/if}
{/if}
    <li><a class="btnTurq" href="javascript:" onclick="openWindow('{$basePath}help{$help}',600,640);"><span class="helpBtn">Help</span></a></li>
</ul>
<br />
<ul>
    {if ($userLoggedIn)}
        {if ($administratorCapability & $userOptionsMask)}
            <li><a class="btnTurq" href="{$basePath}users"><span class="userBtn">Users</span></a></li>
            <li><a class="btnTurq" href="{$basePath}resource"><span class="resourceBtn">Resources</span></a></li>
            <li><a class="btnTurq" href="{$basePath}test"><span class="checkBtn">API Test</span></a></li>
            <li><a class="btnTurq" href="{$basePath}config"><span class="toolBtn">Config</span></a></li>
        {/if}
        {if ($siteIsOffline)}
            <li>&nbsp;&nbsp;<span class="emphatic">Site Offline{if ($administratorCapability & $userOptionsMask)} - Admin{/if}</span></li>
        {/if}
    {/if}
</ul>