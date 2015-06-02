<?php /* Smarty version 2.6.20, created on 2015-06-02 11:09:29
         compiled from core/home.tpl */ ?>
<script type="text/javascript">
    <?php echo '
    $(document).ready(function () {
        $(function(){
            $(\'#products\').slides({
                preload: true,
                preloadImage: \'assets/less/slides/img/loading.gif\',
                effect: \'slide, fade\',
                crossfade: true,
                slideSpeed: 350,
                fadeSpeed: 500,
                generateNextPrev: true,
                generatePagination: false,
                animationStart: function(current){
                    $(\'.caption\').animate({
                        bottom:-35
                    },100);
                    if (window.console && console.log) {
                        // example return of current slide number
                        ///console.log(\'animationStart on slide: \', current);
                    };
                },
                animationComplete: function(current){
                    $(\'.caption\').animate({
                        bottom:0
                    },200);
                    if (window.console && console.log) {
                        // example return of current slide number
                        ///console.log(\'animationComplete on slide: \', current);
                    };
                },
                slidesLoaded: function() {
                    $(\'.caption\').animate({
                        bottom:0
                    },200);
                }
            });
        });
    });
    '; ?>

    <?php if (( $this->_tpl_vars['resources'] != '' )): ?>
    <?php echo '
        $(document).ready(function () {
            $("a[rel^=\'prettyPhoto\']").prettyPhoto();
        });

        function gotoPageOnClick(page) {
            if (page) {
                PostBack(\'gotoPageOnClick\', page);
                return true;
            }
            return false;
        }
    '; ?>

    <?php endif; ?>
</script>

<div style="height:380px;width:640px;padding-top:40px;">

    <?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tbody>
                <?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
                <tr>
                    <td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div id="container">
    <?php if (( $this->_tpl_vars['resources'] != '' )): ?>
        <div id="products">
            <div class="slides_container">
                <?php $_from = $this->_tpl_vars['resources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resource']):
?>
                    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
assets/content/images/<?php echo $this->_tpl_vars['resource']['url']; ?>
" title="<?php echo $this->_tpl_vars['resource']['name']; ?>
" target="_self" rel="prettyPhoto[iframe]">
                        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
assets/content/images/<?php echo $this->_tpl_vars['resource']['image']; ?>
" width="366" title="<?php echo $this->_tpl_vars['resource']['name']; ?>
"  alt="<?php echo $this->_tpl_vars['resource']['name']; ?>
"/>
                        <div class="caption" style="bottom:0">
                            <p><?php echo $this->_tpl_vars['resource']['name']; ?>
</p>
                        </div>
                    </a>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <ul class="pagination">
                <?php $_from = $this->_tpl_vars['resources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resource']):
?>
                    <li><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
assets/content/images/<?php echo $this->_tpl_vars['resource']['thumb']; ?>
" width="55"></a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>

            <br />
            <?php if ($this->_tpl_vars['paginationStr']): ?>
                <?php echo $this->_tpl_vars['paginationStr']; ?>

            <?php endif; ?>
        </div>

    <?php endif; ?>
    </div>
    <div class="clear"></div>
    <div style="margin-top:18px;">Some of my favourite photos.</div>
    <div>All well and good, but <a href="http://www.glazzle.co.uk" target="_blank">this is more interesting.</a></div>
</div>
<?php echo '
<script type="text/javascript">

</script>
'; ?>
	