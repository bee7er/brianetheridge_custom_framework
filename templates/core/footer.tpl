
    <div style="text-align:center;margin-top:40px;">
        {assign var=sep value=''}
        {if $page!='cookies' && !$siteIsOffline}
            <a href="{$basePath}cookies">Cookies</a>&nbsp;&nbsp;
            {assign var=sep value='|&nbsp;&nbsp;'}
        {/if}
        {if $page!='contact' && !$siteIsOffline}
            {$sep}<a href="{$basePath}contact">Contact</a>&nbsp;&nbsp;
        {/if}
    </div>
<footer>&copy; 2015 {$companyName}</footer>