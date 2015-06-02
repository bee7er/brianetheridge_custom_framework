<script type="text/javascript">
    {literal}
    $(document).ready(function () {
        $(function(){
            $('#products').slides({
                preload: true,
                preloadImage: 'assets/less/slides/img/loading.gif',
                effect: 'slide, fade',
                crossfade: true,
                slideSpeed: 350,
                fadeSpeed: 500,
                generateNextPrev: true,
                generatePagination: false,
                animationStart: function(current){
                    $('.caption').animate({
                        bottom:-35
                    },100);
                    if (window.console && console.log) {
                        // example return of current slide number
                        ///console.log('animationStart on slide: ', current);
                    };
                },
                animationComplete: function(current){
                    $('.caption').animate({
                        bottom:0
                    },200);
                    if (window.console && console.log) {
                        // example return of current slide number
                        ///console.log('animationComplete on slide: ', current);
                    };
                },
                slidesLoaded: function() {
                    $('.caption').animate({
                        bottom:0
                    },200);
                }
            });
        });
    });
    {/literal}
    {if ($resources neq '')}
    {literal}
        $(document).ready(function () {
            $("a[rel^='prettyPhoto']").prettyPhoto();
        });

        function gotoPageOnClick(page) {
            if (page) {
                PostBack('gotoPageOnClick', page);
                return true;
            }
            return false;
        }
    {/literal}
    {/if}
</script>

<div style="height:380px;width:640px;padding-top:40px;">

    {if ($appMsgs neq '')}
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tbody>
                {foreach from=$appMsgs item='appMsg'}
                <tr>
                    <td class="emphatic">{$appMsg}</td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}

    <div id="container">
    {if ($resources neq '')}
        <div id="products">
            <div class="slides_container">
                {foreach from=$resources item='resource'}
                    <a href="{$basePath}assets/content/images/{$resource.url}" title="{$resource.name}" target="_self" rel="prettyPhoto[iframe]">
                        <img src="{$basePath}assets/content/images/{$resource.image}" width="366" title="{$resource.name}"  alt="{$resource.name}"/>
                        <div class="caption" style="bottom:0">
                            <p>{$resource.name}</p>
                        </div>
                    </a>
                {/foreach}
            </div>
            <ul class="pagination">
                {foreach from=$resources item='resource'}
                    <li><a href="#"><img src="{$basePath}assets/content/images/{$resource.thumb}" width="55"></a></li>
                {/foreach}
            </ul>

            <br />
            {if $paginationStr}
                {$paginationStr}
            {/if}
        </div>

    {/if}
    </div>
    <div class="clear"></div>
    <div style="margin-top:18px;">Some of my favourite photos.</div>
    <div>All well and good, but <a href="http://www.glazzle.co.uk" target="_blank">this is more interesting.</a></div>
</div>
{literal}
<script type="text/javascript">

</script>
{/literal}	