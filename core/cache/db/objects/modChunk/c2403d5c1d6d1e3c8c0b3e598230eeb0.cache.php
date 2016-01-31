<?php  return array (
  0 => 
  array (
    'modChunk_id' => '26',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'form1',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '[[!FormIt?
   &formName=`form1`
   &hooks=`spam,email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`sendEmailTpl`
   &emailTo=`kim.romanishin@gmail.com`
   &emailSubject=`Заявка на заказ [[++site_url]]`
   &redirectTo=`360`
   <!--&validate=`phone:required`!-->
   &submitVar=`form-question`
]]
[[!+fi.error_message:notempty=`<p>[[!+fi.error_message]]</p>`]]
<!--form action="[[~[[*id]]]]" method="post" class="form">
    <input type="hidden" name="nospam:blank" value="" />
    <label for="name">Ваше имя <span class="required">*</span>:</label>
    <span class="error">[[!+fi.error.name]]</span>
    <input type="text" name="name" id="name" value="[[!+fi.name]]" />
 
    <label for="phone">Телефон <span class="required">*</span>:</label>
    <span class="error">[[!+fi.error.phone]]</span>
    <input type="text" name="phone" id="phone" value="[[!+fi.phone]]" />
 
    <label for="email">Email <span class="required">*</span>:</label>
    <span class="error">[[!+fi.error.email]]</span>
    <input type="text" name="email" id="email" value="[[!+fi.email]]" />
  
    <label for="text">Сообщение <span class="required">*</span>:</label>
    <span class="error">[[!+fi.error.text]]</span>
    <textarea name="text" id="text" cols="55" rows="7"
       value="[[!+fi.text]]">[[!+fi.text]]</textarea>
          
    <input class="submit_button" type="submit" value="Отправить" />
</form-->

<input type="hidden" name="item" />
<div class="order-form-wrapper" >
<form class="apply-form apply-form_order js-apply-form"   action="[[~[[*id]]]]#form" method="post" id="form">

[[!+fi.error_message:notempty=`<p class="">[[!+fi.error_message]]</p>`]]

<span class="error" >[[!+fi.error.name]]</span>
<div class="apply-form__fields"><input id="name" class="apply__input js-name"  type="text" name="name" value="[[!+fi.name]]" placeholder="Ваше имя"/></div>

<span class="error">[[!+fi.error.phone]]</span>
<div class="apply-form__fields"><input id="phone" class="apply__input js-phone_skype" type="text" name="phone" value="[[!+fi.phone]]" placeholder="Телефон"/></div>

<span class="error" >[[!+fi.error.email]]</span>
<div class="apply-form__fields"><label value=" [[!getname]]"></label> <input id="email" class="apply__input js-email" type="text" name="email" value="[[!+fi.email]]" placeholder="Email @"/></div>

<span class="error" >[[+theme]]</span>
<div class="apply-form__fields"><label value=" [[!getname]]"></label> <input id="theme" class="apply__input js-theme" type="text" name="theme" value=" [[!getname]]" placeholder="Товар"/></div>

<span class="error">[[!+fi.error.text]]</span>
<div class="apply-form__fields"><span class="apply__text--label js-text-placeholder" ></span> <textarea id="text" class="apply__text" name="text" placeholder="Ваш вопрос или данные для отправки заказа"></textarea></div>
<input class="submit_button button button_apply js-telefon" type="submit" name="form-question" value="Отправить" /></form></div>',
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