<?php  return array (
  0 => 
  array (
    'modChunk_id' => '24',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'form_main',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '[[!FormIt?
   &formName=`form_main`
   &hooks=`spam,email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`sendEmailTpl_main`
   &emailTo=`kim_55@bigmir.net`
   &emailSubject=`Оценка шансов на поступление [[++site_url]]`
   &redirectTo=`358`
   &validate=`u_name:required,u_phone:required,u_name:required,u_email:email:required,u_text:required:stripTags`
   &submitVar=`form-uslugi`
]]
[[!+fi.error_message:notempty=`<p>[[!+fi.error_message]]</p>`]]





<form class="apply-form js-apply-form" action="[[~[[*id]]]]#form" method="post" id="form">
<span class="error">[[!+fi.error.u_name]]</span>
<div class="apply-form__fields"><label>Фамилия, Имя, Отчество</label> <input id="name" class="apply__input js-name" type="text" name="u_name" /></div>

<span class="error">[[!+fi.error.u_phone]]</span>
<div class="apply-form__fields"><label>Контактный телефон или Skype</label> <input id="phone" class="apply__input js-phone_skype" type="text" name="u_phone" /></div>

<span class="error">[[!+fi.error.u_email]]</span>
<div class="apply-form__fields"><label>Электронная почта</label> <input id="memail" class="apply__input js-email" type="text" name="u_email" /></div>

<span class="error">[[!+fi.error.u_text]]</span>
<div class="apply-form__fields"><label>Ваш вопрос</label><textarea id="message" class="apply__text js-text" name="u_text"></textarea></div>
<input name="form-uslugi" type="submit" value="Отправить заявку" class="button button_apply  submit_button button button_apply  " />
</form>',
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