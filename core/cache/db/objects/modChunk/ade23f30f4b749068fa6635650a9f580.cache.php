<?php  return array (
  0 => 
  array (
    'modChunk_id' => '7',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'sendmail',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '[[!FormIt?
   &formName=`sendmail`
   &hooks=`spam,email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`sendEmailTpl_email`
   &emailTo=`kim_55@bigmir.net`
   &emailSubject=`Подписка на новости с главной [[++site_url]]`
   &redirectTo=`359`
   &validate=`e_email:email:required`
   &submitVar=`e-submit`
]]
<section class="send-mail-b send-mail-b_index" id="email" >
        <div class="send-mail-b__title">
            Отправь нам свою почту
        </div>
        <div class="send-mail-b__subtitle">
            и будь вкурсе всех новостей связаных с Коноплей в Украине
        </div>
        <form name="email" class="send-mail-b__form cntmm" method="post" action="[[~[[*id]]]]#email">
		<span class="error">[[!+fi.error.e_email]]</span>
            <input name="e_email" id="emailz" class="send-mail-b__input" type="text" placeholder="Электронная почта" value="[[!+fi.email]]">
            <input class="submit_button button button_apply js-telefon" name="e-submit" type="submit" value="Отправить">
         </form>
    </section>',
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