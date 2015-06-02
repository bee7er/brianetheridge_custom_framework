{literal}
{/literal}
<a name="top"><h2>{$pageTitle}</h2></a>
<p>
<strong>Help Topics</strong>
<ul>
  {if $topics}
    {foreach from=$topics item='topic'}
      <li><a href="./help#topic{$topic.topic_id}">{$topic.title}</a></li>
    {/foreach}
  {else}
    <li><a href="#">No data</a></li>
  {/if}
</ul>
</p>
{if $topics}
  {foreach from=$topics item='topic'}
    <p><a name="topic{$topic.topic_id}"><strong>{$topic.title}</strong></a></p>
    <p style="margin-left:15px;">{if $topic.description}{$topic.description}{else}No additional information is available.{/if}</p>
    <div style="text-align:right;padding:5px;"><a href="./help#top">Top</a></div>
  {/foreach}
{/if}