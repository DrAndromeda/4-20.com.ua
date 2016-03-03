<?php  return array (
  'id' => 22,
  'source' => 1,
  'property_preprocess' => 0,
  'name' => 'starRating',
  'description' => 'Star Rating for MODx Revolution 2.0.0',
  'editor_type' => 0,
  'category' => 9,
  'cache_type' => 0,
  'snippet' => '/**
 * Star Rating snippet
 *
 * @package star_rating
 */
$snippetPath = $modx->getOption(\'core_path\').\'components/star_rating/\';
$modx->addPackage(\'star_rating\',$snippetPath.\'model/\');

$manager = $modx->getManager();
$manager->createObjectContainer(\'starRating\');

$starId = isset($starId) ? $starId : null;
$groupId = isset($groupId) ? $groupId : \'\';

$c = $modx->newQuery(\'starRating\');
$c->where(array(\'star_id\' => $starId));
if ($groupId != \'\') $c->where(array(\'group_id\' => $groupId));

$starRating = $modx->getObject(\'starRating\', $c);
if ($starRating == null) {
    $starRating = $modx->newObject(\'starRating\');
    $starRating->set(\'star_id\',$starId);
    $starRating->set(\'group_id\',$groupId);
}
$starRating->initialize();

/* parameters */
$starRating->setConfig($scriptProperties);

/* process star rating */
$starRating->loadTheme();

$groupIdCheck = isset($_GET[\'group_id\']) && $starRating->get(\'group_id\') !== $_GET[\'group_id\'] ? false : true;

if (isset($_GET[\'vote\']) && isset($_GET[\'star_id\']) && $starRating->get(\'star_id\') == $_GET[\'star_id\'] && $groupIdCheck) {
    $starRating->setVote($_GET[\'vote\']);
    $starRating->addVote();
    $modx->sendRedirect($starRating->getRedirectUrl());
}

return $starRating->renderVote();',
  'locked' => 0,
  'properties' => 'a:13:{s:12:"cookieExpiry";a:7:{s:4:"name";s:12:"cookieExpiry";s:4:"desc";s:45:"The expiration time in seconds of the cookie.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:6:"608400";s:7:"lexicon";N;s:4:"area";s:0:"";}s:10:"cookieName";a:7:{s:4:"name";s:10:"cookieName";s:4:"desc";s:51:"If useCookie is true, this will be the cookie name.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:11:"starrrating";s:7:"lexicon";N;s:4:"area";s:0:"";}s:7:"cssFile";a:7:{s:4:"name";s:7:"cssFile";s:4:"desc";s:32:"The name of the css file to use.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:4:"star";s:7:"lexicon";N;s:4:"area";s:0:"";}s:7:"groupId";a:7:{s:4:"name";s:7:"groupId";s:4:"desc";s:46:"An optional ID to group star ratings together.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:1:"1";s:7:"lexicon";N;s:4:"area";s:0:"";}s:8:"imgWidth";a:7:{s:4:"name";s:8:"imgWidth";s:4:"desc";s:29:"The width of the star images.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:2:"25";s:7:"lexicon";N;s:4:"area";s:0:"";}s:8:"maxStars";a:7:{s:4:"name";s:8:"maxStars";s:4:"desc";s:36:"The number of stars used in ranking.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:1:"5";s:7:"lexicon";N;s:4:"area";s:0:"";}s:11:"sessionName";a:7:{s:4:"name";s:11:"sessionName";s:4:"desc";s:67:"If useSession is true, this will be the name of the session to use.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:10:"starrating";s:7:"lexicon";N;s:4:"area";s:0:"";}s:6:"starId";a:7:{s:4:"name";s:6:"starId";s:4:"desc";s:44:"The unique ID for this specific star rating.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:1:"1";s:7:"lexicon";N;s:4:"area";s:0:"";}s:7:"starTpl";a:7:{s:4:"name";s:7:"starTpl";s:4:"desc";s:53:"The name of the Chunk to use for rendering the stars.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:7:"starTpl";s:7:"lexicon";N;s:4:"area";s:0:"";}s:5:"theme";a:7:{s:4:"name";s:5:"theme";s:4:"desc";s:17:"The theme to use.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:7:"default";s:7:"lexicon";N;s:4:"area";s:0:"";}s:9:"urlPrefix";a:7:{s:4:"name";s:9:"urlPrefix";s:4:"desc";s:52:"This will prefix this value to any Star Rating URLs.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";N;s:4:"area";s:0:"";}s:9:"useCookie";a:7:{s:4:"name";s:9:"useCookie";s:4:"desc";s:51:"If true, will use cookie to prevent multiple votes.";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:0;s:7:"lexicon";N;s:4:"area";s:0:"";}s:10:"useSession";a:7:{s:4:"name";s:10:"useSession";s:4:"desc";s:52:"If true, will use session to prevent multiple votes.";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:1;s:7:"lexicon";N;s:4:"area";s:0:"";}}',
  'moduleguid' => '',
  'static' => 0,
  'static_file' => '',
  'content' => '/**
 * Star Rating snippet
 *
 * @package star_rating
 */
$snippetPath = $modx->getOption(\'core_path\').\'components/star_rating/\';
$modx->addPackage(\'star_rating\',$snippetPath.\'model/\');

$manager = $modx->getManager();
$manager->createObjectContainer(\'starRating\');

$starId = isset($starId) ? $starId : null;
$groupId = isset($groupId) ? $groupId : \'\';

$c = $modx->newQuery(\'starRating\');
$c->where(array(\'star_id\' => $starId));
if ($groupId != \'\') $c->where(array(\'group_id\' => $groupId));

$starRating = $modx->getObject(\'starRating\', $c);
if ($starRating == null) {
    $starRating = $modx->newObject(\'starRating\');
    $starRating->set(\'star_id\',$starId);
    $starRating->set(\'group_id\',$groupId);
}
$starRating->initialize();

/* parameters */
$starRating->setConfig($scriptProperties);

/* process star rating */
$starRating->loadTheme();

$groupIdCheck = isset($_GET[\'group_id\']) && $starRating->get(\'group_id\') !== $_GET[\'group_id\'] ? false : true;

if (isset($_GET[\'vote\']) && isset($_GET[\'star_id\']) && $starRating->get(\'star_id\') == $_GET[\'star_id\'] && $groupIdCheck) {
    $starRating->setVote($_GET[\'vote\']);
    $starRating->addVote();
    $modx->sendRedirect($starRating->getRedirectUrl());
}

return $starRating->renderVote();',
);