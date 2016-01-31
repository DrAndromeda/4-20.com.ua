<?php  return array (
  'id' => 1,
  'source' => 0,
  'property_preprocess' => 0,
  'templatename' => 'index',
  'description' => 'Template',
  'editor_type' => 0,
  'category' => 0,
  'icon' => '',
  'template_type' => 0,
  'content' => '<!DOCTYPE html lang="ru">
<html class="no-js" lang="ru">
[[$head]]
<body>

[[$header]]

[[$menu]]
[[$menu-mobile]]
[[*intro]]

<section class="content" role="main">
    <div class="wrapper">
        <section class="text-main">
		  <h1>[[*pagetitle]]</h1>
		  <p> [[*introtext]]</p>
        </section>
[[$bestuniver]]
<section class="text-main">
[[*content]]</section>

    </div>
</section>
[[$problems]]
<!--[[$bloks]]
<!--[[$slider_text]]!-->
<!--[[$form_request_consult]]!-->
[[$inform]]
[[$social]]
[[$footer]]
[[$forms]]
[[$js]]
</body>
</html>',
  'locked' => 0,
  'properties' => 'a:0:{}',
  'static' => 0,
  'static_file' => '',
);