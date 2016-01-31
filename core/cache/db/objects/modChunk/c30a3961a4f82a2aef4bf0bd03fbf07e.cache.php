<?php  return array (
  0 => 
  array (
    'modChunk_id' => '29',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'count',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '
[[!FormIt?
   &formName=`count`
   &hooks=`spam,email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`sendEmailTpl_book`
   &emailTo=`kim_55@bigmir.net`
   &emailSubject=`Заявка на книгу [[++site_url]]`
   &redirectTo=`363`
   &validate=`un_phone:required`
   &submitVar=`book`
]]

<div class="univer-action" id="univer">
<div class="wrapper">
<div class="univer-action__img"><img src="../assets/img/book.png" alt="" /></div>
<div class="univer-action-i">
<div class="univer-action__title">Бесплатный доступ будет закрыт через:</div>
<div class="countdown countdown_univer-action">
<div class="counter-title counter-title_univer"><span>Дней</span><span>Часов</span><span>Минут</span><span>Секунд</span></div>
<div class="counter counter_univer-action js-univer-counter">00000000</div>
</div>
<form class="univer-action__form" action="[[~[[*id]]]]#univer" method="post">
<div class="univer-action__form-title">Получи доступ к полезной информации!</div>
<span class="error">[[!+fi.error.un_phone]]</span>
<input type="text" placeholder="Электронная почта" class="univer-action__input" name="un_phone"/> 

<input name="book" type="submit" value="Получить!" class="button button_univer-action  " />


</form></div>
</div>
</div> ',
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