<?php  return array (
  'id' => 7,
  'source' => 1,
  'property_preprocess' => 0,
  'templatename' => 'text',
  'description' => '',
  'editor_type' => 0,
  'category' => 0,
  'icon' => '',
  'template_type' => 0,
  'content' => '<!DOCTYPE html lang="ru">
<html class="no-js" lang="ru">
[[$head]]
<body>
<div class="wr"> 
[[$header]]
</div>
[[$menu]]
[[$menu-mobile]]
[[*intro]]

<div class="wrapper">[[$bread]]
<h1>[[*pagetitle]]</h1>
    <div class="col2">
      <div class="col-l">
        <div class="articles"> [[*content]]</div></div>
<div class="col-r">
<div class="col-r">
<div class="services-i-l services-i-l_2">
<ul class="services__list">
<!--[[Wayfinder?
			&startId=`[[*id]]`
			&level=`1`
			&ignoreHidden=`1`]]!-->
</ul></div>
 [[$r]]
</div></div>
</div>
<!--[[$count]]!-->
[[$social]]
[[$footer]]

[[$forms]]

[[$js]]

</body>
</html>
',
  'locked' => 0,
  'properties' => 'a:0:{}',
  'static' => 0,
  'static_file' => '',
);