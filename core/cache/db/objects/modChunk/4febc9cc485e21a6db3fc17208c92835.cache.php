<?php  return array (
  0 => 
  array (
    'modChunk_id' => '42',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'menu-mobile',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '<nav class="menu-mobile-container">
  <div class="wrapper">
<div class="search-form">
            [[!SimpleSearchForm? &landing=`356` &tpl=`sf`]]
            <hr/>
</div>
	<div>
	  <ul class="menu-mobile">
		[[Wayfinder?
		&startId=`1`
		&level=`2`
		&outerTpl=`tpl.Wayfinder.outer`
		&parentRowTpl=`tpl.Wayfinder.row.parent.mobile`
		&innerRowTpl=`tpl.Wayfinder.row.inner`
		&rowTpl=`tpl.Wayfinder.row.mobile`             
		]]
	  </ul>
	</div>
  </div>
</nav>
',
    'modChunk_locked' => '0',
    'modChunk_properties' => 'a:0:{}',
    'modChunk_static' => '0',
    'modChunk_static_file' => '',
    'Source_id' => '1',
    'Source_name' => 'Filesystem',
    'Source_description' => '',
    'Source_class_key' => 'sources.modFileMediaSource',
    'Source_properties' => 'a:0:{}',
    'Source_is_stream' => '1',
  ),
);