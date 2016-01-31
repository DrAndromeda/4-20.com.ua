<?php  return array (
  0 => 
  array (
    'modChunk_id' => '46',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'form_request_consult',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '<div class="main-form-container request_consult">
    <form method="post" action="request_consult">
        <div class="container-main">
        <p class="block_header rel-con">Бесплатная консультация </p>
            <p class="form-desc">Заполните форму и мы перезвоним Вам в течение 1 рабочего дня!</p>
            <div class="container-row inputs">
                <div>
                    <label for="name"><span class="strong uppercase">Ваше имя</span></label>
                    <input id="name" type="text"/></div>
                <div>
                    <label for="phone_num"><span class="strong uppercase">Ваш телефон</span></label>
                    <input id="phone_num" type="text"/></div>
            </div>
         <div class="container-row">
                <span class="strong uppercase">Я хочу </span>
                <input id="6m" type="radio" name="request_year"/>
                <label for="6m">6 месяцев</label>
                <input id="12m" type="radio" name="request_year"/>
                <label for="12m">1 года</label>
                <input id="24m" type="radio" name="request_year"/>
                <label for="24m">2 лет</label>
            </div>
            <div class="rel-con">
                <p><span class="strong">Для  Вам понадобится только </span></p>
                <p><span class="strong">Все остальные документы мы оформим за Вас!</span></p>
            </div>
            <hr class="desc_blue"/>
            <input type="submit" value="Отправить заявку" class="rel-con"/>
        </div>
    </form>
</div>',
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