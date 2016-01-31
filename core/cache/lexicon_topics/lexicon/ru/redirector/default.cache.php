<?php  return array (
  'redirector' => 'Redirector',
  'redirector.active' => 'Включён',
  'redirector.desc' => 'Управление редиректами на вашем сайте. Красным цветом отмечены редиректы с некорректным шаблоном (в качестве шаблона указан еще существующий URL) или несуществующим целевым URL. Такие редиректы не будут работать.',
  'redirector.nothing_found' => 'Редиректов пока нет!',
  'redirector.description' => 'Описание',
  'redirector.redirect_err_ae' => 'Редирект с таким именем уже есть.',
  'redirector.redirect_err_ae_pattern' => 'Редирект с таким шаблоном уже есть.',
  'redirector.redirect_err_ae_patctx' => 'Редирект с таким шаблоном и контекстом "[[+context]]" уже есть.',
  'redirector.redirect_err_ae_uri' => 'URI уже существует (ресурс с ID [[+id]] в контексте "[[+context]]")... Редирект не будет работать...',
  'redirector.redirect_err_nf' => 'Редирект не найден.',
  'redirector.redirect_err_ns' => 'Редирект не указан.',
  'redirector.redirect_err_ns_name' => 'Укажите имя редиректа.',
  'redirector.redirect_err_ne_target' => 'Целевой URI не существет... Редирект не будет работать...',
  'redirector.redirect_err_remove' => 'Произошла ошибка при попытке удалить редирект.',
  'redirector.redirect_err_save' => 'Произошла ошибка при попытке сохранить редирект.',
  'redirector.redirect_create' => 'Создать новый редирект',
  'redirector.redirect_remove' => 'Удалить редирект',
  'redirector.redirect_remove_confirm' => 'Вы уверены, что хотите удалить этот редирект?',
  'redirector.redirect_update' => 'Обновить редирект',
  'redirector.redirects' => 'Редиректы',
  'redirector.management' => 'Управление редиректами',
  'redirector.menu_desc' => 'Управление редиректами.',
  'redirector.pattern' => 'Шаблон',
  'redirector.search...' => 'Поиск...',
  'redirector.target' => 'Цель',
  'redirector.context' => 'Контекст',
  'redirector.context_desc' => 'Если контекст указан, редирект будет работать только когда загружен указанный контекст.',
  'redirector.triggered' => 'Triggered',
  'redirector.triggered_first' => 'First time triggered',
  'redirector.triggered_last' => 'Last time triggered',
  'redirector.import' => 'Импорт CSV',
  'redirector.import_desc' => 'Здесь вы можете импортировать новые правила в формате CSV. Вы можете загрузить CSV файл или вставить CSV данные в текстовую область.',
  'redirector.import.csv_desc' => 'Обратите внимание: CSV данные должны соответствовать формату "шаблон;цель;контекст", где "контекст" может отсутствовать или остаться пустым.<br/>Также URL-ссылки должны быть относительными, не включать в себя [[+site_url]] и т.п.',
  'redirector.import.csv_file' => 'Выбрать CSV файл',
  'redirector.import.raw_csv' => 'Вставить CSV данные',
  'redirector.import.do' => 'Начать импорт!',
  'redirector.import.doing' => 'Идет импорт CSV данных...',
  'redirector.import.success' => 'Найдено [[+total]] записей. Импортировано: [[+succeed]] успешно и [[+failed]] неудачно!',
  'redirector.import.failed' => 'Импорт CSV закончился неудачно... Попробуйте снова!',
  'redirector.regex_explain' => 'Вы можете использовать в шаблоне регулярные выражения с групповыми подвыражениями и ссылаться на группы в целевом URL.

Например: у вас есть старые ссылки вида "shop/category-{name}/" и вы хотите перенаправить их на новые в формате "webshop/{name}/".
Создайте такой редирект:

<b>Шаблон:</b> ^shop\\/category-(.*)\\/$
<b>Цель:</b> webshop/$1/

Вы можете использовать несколько групповых подстановок (.*) и ссылаться на них через $2, $3 и т.д. Обратите внимание: при использовании регулярных выражений необходимо экранировать слэш-символ /, а также использовать символ начала строки ^ и символ конца строки $ .',
  'setting_redirector.track_uri_updates' => 'Отслеживать обновления URI',
  'setting_redirector.track_uri_updates_desc' => 'Если включено, будут отслеживаться обновления URI ресурсов и автоматически создаваться соответствующие редиректы (со старого URI на новый).',
);