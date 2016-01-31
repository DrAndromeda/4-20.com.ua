<?php  return array (
  0 => 
  array (
    'modChunk_id' => '23',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'forms',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '[[#!FormIt?
   &formName=`forms1`
   &hooks=`email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`email_tpl`
   &emailTo=`kim_55@bigmir.net`
   &emailSubject=`[[+sub]] с сайта [[++site_name]]`
   &emailFromName=`[[+name]]`
   &emailFrom=`[[+email]]`
   &validate=`name:required,phone:required,name:required,email:email:required,theme:required,text:required:stripTags`
   &submitVar=`form-phone1`

]]

[[!+fi.error_message:notempty=`<p class="">[[!+fi.error_message]]</p>`]]

<div class="modal-windows">
    <div class="modal-forms js-question-form">
        <div class="box-modal_close arcticmodal-close arcticmodal-forms-close">Закрыть</div>
        <div class="modal-forms__title">
            Задать свой вопрос
        </div>
        <div class="modal-forms-i">
            <form class="apply-form apply-form_modal js-apply-form validate" method="post" action="[[~[[*id]]]]">

<input name="sub" id="sub" type="hidden" value="Задать свой вопрос"/>


				<span class="error">[[!+fi.error.theme]]</span>

                <div class="apply-form__fields">
                    <label>Тема вопроса</label>
                    <input name="theme" id="theme" class="apply__input js-field" type="text" placeholder="Тема вопроса" value="[[!+fi.theme]]"/>
                </div>
				<span class="error">[[!+fi.error.name]]</span>
                <div class="apply-form__fields">
                    <label>Фамилия, Имя, Отчество</label>
                    <input name="name" id="name" class="apply__input js-name" type="text" placeholder="Фамилия, Имя, Отчество" value="[[!+fi.name]]"/>
                </div>
				<span class="error">[[!+fi.error.email]]</span>
                <div class="apply-form__fields">
                    <label>Электронная почта</label>
                    <input name="email" id="email" class="apply__input js-email" type="text" placeholder="Электронная почта" value="[[!+fi.email]]"/>
                </div>
				<span class="error">[[!+fi.error.text]]</span>
                <div class="apply-form__fields">
                    <label>Ваш вопрос</label>
                    <input name="text" id="text" class="apply__text" placeholder="Ваш вопрос" value="[[!+fi.text]]">
                </div>
             <input class="submit_button button button_apply js-telefon" name="submit" type="submit" value="Отправить">
            </form>
        </div>
    </div>    

    <div class="modal-forms js-question-form-tnx">
        <div class="modal-tnx">
            <img src="/assets/img/mcheck.gif" alt=""/>
            <div class="modal-tnx__title">
                Здравствуйте,<br>
                Ваш вопрос принят в работу!
            </div>
            <div class="modal-tnx__txt">
                Благодарим Вас за интерес,<br>
                проявленный к нашей компании!
            </div>
            <div class="modal-tnx__buy">
                Всего доброго!
            </div>
            <div class="box-modal_close arcticmodal-close arcticmodal-tnx-close button">
                <span>Закрыть</span>
            </div>        </div>
    </div>

    <div class="modal-forms js-order-form">
        <div class="box-modal_close arcticmodal-close arcticmodal-forms-close">Закрыть</div>
        <div class="modal-forms__title">
            Оставь свой почтовый адрес и подпишись на новости сайта
        </div>
        <div class="modal-forms-i">
            <form class="apply-form apply-form_modal js-apply-form validate" method="post" action="[[~[[*id]]]]">
			<input name="sub" id="sub" type="hidden" value="Оставь свой почтовый арес"/>

				<span class="error">[[!+fi.error.name]]</span>
                <div class="apply-form__fields">
                    <label>Фамилия, Имя, Отчество</label>
                    <input name="name" id="name" class="apply__input js-name" type="text" placeholder="Фамилия, Имя, Отчество" value=\'[[!+fi.name]]\'/>
                </div>

				<span class="error">[[!+fi.error.phone]]</span>
                <div class="apply-form__fields">
                    <label>Телефон или Skype</label>
                    <input id="phone" name="phone" class="apply__input js-field" type="text" placeholder="Телефон или Skype" value=\'[[!+fi.phone]]\'/>
                </div>

				<span class="error">[[!+fi.error.email]]</span>
                <div class="apply-form__fields">
                    <label>Электронная почта</label>
                    <input name="email" id="email" class="apply__input js-email" type="text" placeholder="Электронная почта" value="[[!+fi.email]]"/>
                </div>

				<span class="error">[[!+fi.error.text]]</span>
                <div class="apply-form__fields">
                    <label>Коментарий</label>
                   <input name="text" id="text" class="apply__text" placeholder="Коментарий" value="[[!+fi.text]]">
                </div>
              <input class="submit_button button button_apply js-telefon" name="submit" type="submit" value="Отправить">
            </form>
        </div>
    </div>
    <div class="modal-forms js-order-form-tnx">
        <div class="modal-tnx">
            <img src="/assets/img/mcheck.gif" alt=""/>
            <div class="modal-tnx__title">
                Ваша заявка принята!
                <p>Наши менеджеры свяжутся с Вами<br> в кротчайшие сроки.</p>
            </div>
            <div class="modal-tnx__txt">
               Благодарим Вас за интерес,<br>
                проявленный к нашей компании!
            </div>
            <div class="modal-tnx__buy">
                Всего доброго!
            </div>
            <div class="box-modal_close arcticmodal-close arcticmodal-tnx-close button">
                <span>Закрыть</span>
            </div>        </div>
    </div>
    
<div class="modal-forms js-phone-form">
        <div class="box-modal_close arcticmodal-close arcticmodal-forms-close">Закрыть</div>
        <div class="modal-forms__title">
            Подписаться на рассылку
        </div>
        <div class="modal-forms-i">
             <form class="apply-form apply-form_modal js-apply-form validate" method="post" action="[[~[[*id]]]]">
			<input name="sub" id="sub" type="hidden" value="Подписаться на рассылку"/>

                <div class="apply-form__fields">
                    <label>Электронная почта</label>
                    <input name="email" id="email" class="apply__input js-email" type="text" placeholder="Электронная почта" value="[[!+fi.email]]"/>
                </div>
               <input class="submit_button button button_apply js-telefon" name="submit" type="submit" value="Отправить">
            </form>
        </div>
    </div>

    <div class="modal-forms js-phone-tnx">
        <div class="modal-tnx">
            <img src="/assets/img/mcheck.gif" alt=""/>
            <div class="modal-tnx__title">
                Здравствуйте,<br>
                Ваш вопрос принят в работу!
          </div>
            <div class="box-modal_close arcticmodal-close arcticmodal-tnx-close button">
                <span>Закрыть</span>
            </div>        </div>
    </div>


[[!FormIt?
   &formName=`forms2`
   &hooks=`email,hook_FormIt_megaplanCreateClient,redirect`
   &emailTpl=`email_tpl`
   &emailTo=`kim_55@bigmir.net`
   &emailSubject=`[[+sub]] с сайта [[++site_url]]`
   &emailFromName=`[[+phone_name]]`
   &redirectTo=`362`
   &validate=`phone_name:required,phone_phone:required,phone_text:required:stripTags`
   &submitVar=`form-phone`

]]
<div class="modal-forms js-telefon-form">
        <div class="box-modal_close arcticmodal-close arcticmodal-forms-close">Закрыть</div>
        <div class="modal-forms__title">
            Заказать
        </div>
        <div class="modal-forms-i">
 <form class="apply-form apply-form_modal js-apply-form validate" method="post" id="phone_form"  action="[[~[[*id]]]]">
			<input name="sub" id="sub" type="hidden" value="Заказать"/>

				<span class="error">[[!+fi.error.phone_name]]</span>
                <div class="apply-form__fields">
                    <label>Фамилия, Имя, Отчество</label>
                    <input name="phone_name" id="name" class="apply__input js-name" type="text" placeholder="Федоров Дмитрий Олегович" value=\'[[!+fi.name]]\'/>
                </div>
				<span class="error">[[!+fi.error.phone_phone]]</span>
                <div class="apply-form__fields">
                    <label>Номер телефона</label>
                    <input id="phone" name="phone_phone" class="apply__input js-field" type="text" placeholder="+7 925 123 45 67" value=\'[[!+fi.phone]]\'/>
                </div>
				<span class="error" >[[+theme]]</span>
<div class="apply-form__fields"><label value=" [[!getname]]">Товар</label> <input id="theme" class="apply__input js-theme" type="text" name="theme"   value=" [[!getname]]" /></div>

				<span class="error">[[!+fi.error.phone_text]]</span>
                <div class="apply-form__fields">
                    <label>Коментарий</label>
                    <input id="text" name="phone_text" class="apply__text" placeholder="Хочу поступить в Австрию!" value=\'[[!+fi.text]]\'>
                </div>
                <input class="submit_button button button_apply js-telefon" name="form-phone" type="submit" value="Отправить">
            </form>
        </div>
    </div>
<div class="modal-forms js-service-form">
        <div class="box-modal_close arcticmodal-close arcticmodal-forms-close">Закрыть</div>
        <div class="modal-forms__title">
            Заказать услугу
        </div>
        <div class="modal-forms-i">
<form class="apply-form apply-form_modal js-apply-form validate" method="post" action="[[~[[*id]]]]">
			<input name="sub" id="sub" type="hidden" value="Заказать услугу"/>

				<span class="error">[[!+fi.error.name]]</span>
                <div class="apply-form__fields">
                    <label>Фамилия, Имя, Отчество</label>
                    <input name="name" id="name" class="apply__input js-name" type="text" placeholder="Фамилия, Имя, Отчество" value="[[!+fi.name]]"/>
                </div>

				<span class="error">[[!+fi.error.email]]</span>
                <div class="apply-form__fields">
                    <label>Электронная почта</label>
                    <input name="mail" id="mail" class="apply__input js-email" type="text" placeholder="Электронная почта" value="[[!+fi.email]]"/>
                </div>

				<span class="error">[[!+fi.error.text]]</span>
                <div class="apply-form__fields">
                    <label>Коментарий</label>
                    <input name="text" id="text" class="apply__text" placeholder="Коментарий" value="[[!+fi.text]]">
                </div>
                <input class="submit_button button button_apply js-telefon" name="submit" type="submit" value="Отправить">
            </form>
        </div>
    </div>
</div>

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