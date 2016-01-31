<?php return array (
  'ca17e80a4250e8ca4c78b97ec521301b' => 
  array (
    'criteria' => 
    array (
      'name' => 'sisea',
    ),
    'object' => 
    array (
      'name' => 'sisea',
      'path' => '{core_path}components/simplesearch/',
      'assets_path' => '{assets_path}components/simplesearch/',
    ),
  ),
  '0ed665171abf704a8190dcdf78693069' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearchIndexer',
    ),
    'object' => 
    array (
      'id' => 4,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearchIndexer',
      'description' => 'Automatically indexes Resources into Solr.',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * Plugin to index Resources whenever they are changed, published, unpublished,
 * deleted, or undeleted.
 *
 * @var modX $modx
 * @var SimpleSearch $search
 *
 * @package simplesearch
 */

require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

$search->loadDriver($scriptProperties);
if (!$search->driver || (!($search->driver instanceof SimpleSearchDriverSolr) && !($search->driver instanceof SimpleSearchDriverElastic))) return;

/**
 * helper method for missing params in events
 * @param modX $modx
 * @param array $children
 * @param int $parent
 * @return boolean
 */
if (!function_exists(\'SimpleSearchGetChildren\')) {
    function SimpleSearchGetChildren(&$modx,&$children,$parent) {
        $success = false;
        $kids = $modx->getCollection(\'modResource\',array(
            \'parent\' => $parent,
        ));
        if (!empty($kids)) {
            /** @var modResource $kid */
            foreach ($kids as $kid) {
                $children[] = $kid->toArray();
                SimpleSearchGetChildren($modx,$children,$kid->get(\'id\'));
            }
        }
        return $success;
    }
}

$action = \'index\';
$resourcesToIndex = array();
switch ($modx->event->name) {
    case \'OnDocFormSave\':
        $action = \'index\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();

        if ($resourceArray[\'published\'] == 1 && $resourceArray[\'deleted\'] == 0) {
            $action = \'index\';
            foreach ($_POST as $k => $v) {
                if (substr($k,0,2) == \'tv\') {
                    $id = str_replace(\'tv\',\'\',$k);
                    /** @var modTemplateVar $tv */
                    $tv = $modx->getObject(\'modTemplateVar\',$id);
                    if ($tv) {
                        $resourceArray[$tv->get(\'name\')] = $tv->renderOutput($resource->get(\'id\'));
                        $modx->log(modX::LOG_LEVEL_DEBUG,\'Indexing \'.$tv->get(\'name\').\': \'.$resourceArray[$tv->get(\'name\')]);
                    }
                    unset($resourceArray[$k]);
                }
            }
        } else {
            $action = \'removeIndex\';
        }

        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnDocPublished\':
        $action = \'index\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();
        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnDocUnpublished\':
    case \'OnDocUnPublished\':
        $action = \'removeIndex\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();
        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnResourceDuplicate\':
        $action = \'index\';
        /** @var modResource $newResource */
        $resourcesToIndex[] = $newResource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$newResource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
    case \'OnResourceDelete\':
        $action = \'removeIndex\';
        $resourcesToIndex[] = $resource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$resource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
    case \'OnResourceUndelete\':
        $action = \'index\';
        $resourcesToIndex[] = $resource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$resource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
}

foreach ($resourcesToIndex as $resourceArray) {
    if (!empty($resourceArray[\'id\'])) {
        if ($action == \'index\') {
            $search->driver->index($resourceArray);
        } else if ($action == \'removeIndex\') {
            $search->driver->removeIndex($resourceArray[\'id\']);
        }
    }
}
return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * Plugin to index Resources whenever they are changed, published, unpublished,
 * deleted, or undeleted.
 *
 * @var modX $modx
 * @var SimpleSearch $search
 *
 * @package simplesearch
 */

require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

$search->loadDriver($scriptProperties);
if (!$search->driver || (!($search->driver instanceof SimpleSearchDriverSolr) && !($search->driver instanceof SimpleSearchDriverElastic))) return;

/**
 * helper method for missing params in events
 * @param modX $modx
 * @param array $children
 * @param int $parent
 * @return boolean
 */
if (!function_exists(\'SimpleSearchGetChildren\')) {
    function SimpleSearchGetChildren(&$modx,&$children,$parent) {
        $success = false;
        $kids = $modx->getCollection(\'modResource\',array(
            \'parent\' => $parent,
        ));
        if (!empty($kids)) {
            /** @var modResource $kid */
            foreach ($kids as $kid) {
                $children[] = $kid->toArray();
                SimpleSearchGetChildren($modx,$children,$kid->get(\'id\'));
            }
        }
        return $success;
    }
}

$action = \'index\';
$resourcesToIndex = array();
switch ($modx->event->name) {
    case \'OnDocFormSave\':
        $action = \'index\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();

        if ($resourceArray[\'published\'] == 1 && $resourceArray[\'deleted\'] == 0) {
            $action = \'index\';
            foreach ($_POST as $k => $v) {
                if (substr($k,0,2) == \'tv\') {
                    $id = str_replace(\'tv\',\'\',$k);
                    /** @var modTemplateVar $tv */
                    $tv = $modx->getObject(\'modTemplateVar\',$id);
                    if ($tv) {
                        $resourceArray[$tv->get(\'name\')] = $tv->renderOutput($resource->get(\'id\'));
                        $modx->log(modX::LOG_LEVEL_DEBUG,\'Indexing \'.$tv->get(\'name\').\': \'.$resourceArray[$tv->get(\'name\')]);
                    }
                    unset($resourceArray[$k]);
                }
            }
        } else {
            $action = \'removeIndex\';
        }

        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnDocPublished\':
        $action = \'index\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();
        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnDocUnpublished\':
    case \'OnDocUnPublished\':
        $action = \'removeIndex\';
        $resourceArray = $scriptProperties[\'resource\']->toArray();
        unset($resourceArray[\'ta\'],$resourceArray[\'action\'],$resourceArray[\'tiny_toggle\'],$resourceArray[\'HTTP_MODAUTH\'],$resourceArray[\'modx-ab-stay\'],$resourceArray[\'resource_groups\']);
        $resourcesToIndex[] = $resourceArray;
        break;
    case \'OnResourceDuplicate\':
        $action = \'index\';
        /** @var modResource $newResource */
        $resourcesToIndex[] = $newResource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$newResource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
    case \'OnResourceDelete\':
        $action = \'removeIndex\';
        $resourcesToIndex[] = $resource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$resource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
    case \'OnResourceUndelete\':
        $action = \'index\';
        $resourcesToIndex[] = $resource->toArray();
        $children = array();
        SimpleSearchGetChildren($modx,$children,$resource->get(\'id\'));
        foreach ($children as $child) {
            $resourcesToIndex[] = $child;
        }
        break;
}

foreach ($resourcesToIndex as $resourceArray) {
    if (!empty($resourceArray[\'id\'])) {
        if ($action == \'index\') {
            $search->driver->index($resourceArray);
        } else if ($action == \'removeIndex\') {
            $search->driver->removeIndex($resourceArray[\'id\']);
        }
    }
}
return;',
    ),
  ),
  '00c0203ee5bab3959773d66e156fc0d6' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7ea9d3bf6bc3a24ad5c2a2a4510e0819' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocPublished',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocPublished',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '68bba5fc95cc095e8bc9e759af5b4410' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocUnPublished',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocUnPublished',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '47dbc9f3097672fbc36a0253dea7f80d' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceDuplicate',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceDuplicate',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '13e43b9885d95560a3ed7ab36a787a58' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceDelete',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceDelete',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'de094518ff187faa9101a866c3f35062' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceUndelete',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnResourceUndelete',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'e531aaaebde14f3324d57235b66563d3' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.driver_class',
    ),
    'object' => 
    array (
      'key' => 'sisea.driver_class',
      'value' => 'SimpleSearchDriverBasic',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '0bf5049734b009854a08f60d76b5a21b' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.driver_class_path',
    ),
    'object' => 
    array (
      'key' => 'sisea.driver_class_path',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'f4b524d56f58e8e367b7b359fc20d967' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.driver_db_specific',
    ),
    'object' => 
    array (
      'key' => 'sisea.driver_db_specific',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'sisea',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6a6cc8645ee082174c4ab7b7b8229e32' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.hostname',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.hostname',
      'value' => '127.0.0.1',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '318e90fc5843c0e7d24d3a1b4aac34ec' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.port',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.port',
      'value' => '8983',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '0e89c99be8d9abfcd5ea59615801dc24' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.path',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.path',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a45f71e9f5b85aaa7c96e543f48807b9' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.username',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.username',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6a7b762664dee315dd5e5905c2da797a' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.password',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.password',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'e27209f2ecd5f5daa0192e9176d4e25f' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.timeout',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.timeout',
      'value' => '30',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'e8136b8bebb5f767f344fb1c9fab5fce' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'de4f0d2915dd4f61a819951cf50094ac' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl_cert',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl_cert',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '81256ebf9428258d077674008645fdd8' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl_key',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c5a70a452d18a24fe9f4bb38502fcdc9' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl_keypassword',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl_keypassword',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'b95a6a0a630a348d94ac1411e29069a2' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl_cainfo',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl_cainfo',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6f04cf46ce931ba4cf75d8c4ef5210b8' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.ssl_capath',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.ssl_capath',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'f80ba4c1fc0c32e2120cabb00a188cf9' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.proxy_host',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.proxy_host',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'd8e5d6ff08425b8cd2234a180c93d73a' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.proxy_port',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.proxy_port',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a123a457cf209986ec05f24afcb73ece' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.proxy_username',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.proxy_username',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c4a646c8b117847018f633780a0a0b40' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.solr.proxy_password',
    ),
    'object' => 
    array (
      'key' => 'sisea.solr.proxy_password',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'Solr',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ea5adc677925692ef6331c4549b04f94' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.elastic.hostname',
    ),
    'object' => 
    array (
      'key' => 'sisea.elastic.hostname',
      'value' => 'http://127.0.0.1',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'ElasticSearch',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '634a8bb1ad15a76ec123f97f2eab83d9' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.elastic.port',
    ),
    'object' => 
    array (
      'key' => 'sisea.elastic.port',
      'value' => '9200',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'ElasticSearch',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '60518aa8288c113e0c1b5d5080a1093f' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.elastic.index',
    ),
    'object' => 
    array (
      'key' => 'sisea.elastic.index',
      'value' => 'simplesearchindex',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'ElasticSearch',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6d388f57e62eca4163005181ceddda8c' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.elastic.search_fields',
    ),
    'object' => 
    array (
      'key' => 'sisea.elastic.search_fields',
      'value' => 'pagetitle^20,introtext^10,alias^5,content^1',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'ElasticSearch',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'baabac2a0f7c2365bc1a61847f46a674' => 
  array (
    'criteria' => 
    array (
      'key' => 'sisea.elastic.search_boost',
    ),
    'object' => 
    array (
      'key' => 'sisea.elastic.search_boost',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'sisea',
      'area' => 'ElasticSearch',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '4b069db97fc3c1695d015c445a9aab8a' => 
  array (
    'criteria' => 
    array (
      'category' => 'SimpleSearch',
    ),
    'object' => 
    array (
      'id' => 4,
      'parent' => 0,
      'category' => 'SimpleSearch',
      'rank' => 0,
    ),
  ),
  'c8b265675ca4e675ef1d776a46ec150e' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearch',
    ),
    'object' => 
    array (
      'id' => 12,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearch',
      'description' => '',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * SimpleSearch snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

/* find search index and toplaceholder setting */
$searchIndex = $modx->getOption(\'searchIndex\',$scriptProperties,\'search\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
$noResultsTpl = $modx->getOption(\'noResultsTpl\',$scriptProperties,\'SearchNoResults\');

/* get search string */
if (empty($_REQUEST[$searchIndex])) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => \'\',
    ));
    return $search->output($output,$toPlaceholder);
}
$searchString = $search->parseSearchString($_REQUEST[$searchIndex]);
if (!$searchString) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => $searchString,
    ));
    return $search->output($output,$toPlaceholder);
}

/* setup default properties */
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'SearchResult\');
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,\'SearchResults\');
$showExtract = $modx->getOption(\'showExtract\',$scriptProperties,true);
$extractSource = $modx->getOption(\'extractSource\',$scriptProperties,\'content\');
$extractLength = $modx->getOption(\'extractLength\',$scriptProperties,200);
$extractEllipsis = $modx->getOption(\'extractEllipsis\',$scriptProperties,\'...\');
$highlightResults = $modx->getOption(\'highlightResults\',$scriptProperties,true);
$highlightClass = $modx->getOption(\'highlightClass\',$scriptProperties,\'sisea-highlight\');
$highlightTag = $modx->getOption(\'highlightTag\',$scriptProperties,\'span\');
$perPage = $modx->getOption(\'perPage\',$scriptProperties,10);
$pagingSeparator = $modx->getOption(\'pagingSeparator\',$scriptProperties,\' | \');
$placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'sisea.\');
$includeTVs = $modx->getOption(\'includeTVs\',$scriptProperties,\'\');
$processTVs = $modx->getOption(\'processTVs\',$scriptProperties,\'\');
$tvPrefix = $modx->getOption(\'tvPrefix\',$scriptProperties,\'\');
$offsetIndex = $modx->getOption(\'offsetIndex\',$scriptProperties,\'sisea_offset\');
$idx = isset($_REQUEST[$offsetIndex]) ? intval($_REQUEST[$offsetIndex]) + 1 : 1;
$postHooks = $modx->getOption(\'postHooks\',$scriptProperties,\'\');
$activeFacet = $modx->getOption(\'facet\',$_REQUEST,$modx->getOption(\'activeFacet\',$scriptProperties,\'default\'));
$activeFacet = $modx->sanitizeString($activeFacet);
$facetLimit = $modx->getOption(\'facetLimit\',$scriptProperties,5);
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$addSearchToLink = intval($modx->getOption(\'addSearchToLink\',$scriptProperties,"0"));
$searchInLinkName = $modx->getOption(\'searchInLinkName\',$scriptProperties,"search");

/* get results */
$response = $search->getSearchResults($searchString,$scriptProperties);
$placeholders = array(\'query\' => $searchString);
$resultsTpl = array(\'default\' => array(\'results\' => array(),\'total\' => $response[\'total\']));
if (!empty($response[\'results\'])) {
    /* iterate through search results */
    foreach ($response[\'results\'] as $resourceArray) {
        $resourceArray[\'idx\'] = $idx;
        if (empty($resourceArray[\'link\'])) {
            $ctx = !empty($resourceArray[\'context_key\']) ? $resourceArray[\'context_key\'] : $modx->context->get(\'key\');
            $args = \'\';
            if ($addSearchToLink) {
                $args = array($searchInLinkName => $searchString);
            }
            $resourceArray[\'link\'] = $modx->makeUrl($resourceArray[\'id\'],$ctx,$args);
        }
        if ($showExtract) {
            $extract = $searchString;
            if (array_key_exists($extractSource, $resourceArray)) {
                $text = $resourceArray[$extractSource];
            } else {
                $text = $modx->runSnippet($extractSource, $resourceArray);
            }
            $extract = $search->createExtract($text,$extractLength,$extract,$extractEllipsis);
            /* cleanup extract */
            $extract = strip_tags(preg_replace("#\\<!--(.*?)--\\>#si",\'\',$extract));
            $extract = preg_replace("#\\[\\[(.*?)\\]\\]#si",\'\',$extract);
            $extract = str_replace(array(\'[[\',\']]\'),\'\',$extract);
            $resourceArray[\'extract\'] = !empty($highlightResults) ? $search->addHighlighting($extract,$highlightClass,$highlightTag) : $extract;
        }
        $resultsTpl[\'default\'][\'results\'][] = $search->getChunk($tpl,$resourceArray);
        $idx++;
    }
}

/* load postHooks to get faceted results */
if (!empty($postHooks)) {
    $limit = !empty($facetLimit) ? $facetLimit : $perPage;
    $search->loadHooks(\'post\');
    $search->postHooks->loadMultiple($postHooks,$response[\'results\'],array(
        \'hooks\' => $postHooks,
        \'search\' => $searchString,
        \'offset\' => !empty($_GET[$offsetIndex]) ? intval($_GET[$offsetIndex]) : 0,
        \'limit\' => $limit,
        \'perPage\' => $limit,
    ));
    if (!empty($search->postHooks->facets)) {
        foreach ($search->postHooks->facets as $facetKey => $facetResults) {
            if (empty($resultsTpl[$facetKey])) {
                $resultsTpl[$facetKey] = array();
                $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
                $resultsTpl[$facetKey][\'results\'] = array();
            } else {
                $resultsTpl[$facetKey][\'total\'] = $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
            }

            $idx = !empty($resultsTpl[$facetKey]) ? count($resultsTpl[$facetKey][\'results\'])+1 : 1;
            foreach ($facetResults[\'results\'] as $r) {
                $r[\'idx\'] = $idx;
                $fTpl = !empty($scriptProperties[\'tpl\'.$facetKey]) ? $scriptProperties[\'tpl\'.$facetKey] : $tpl;
                $resultsTpl[$facetKey][\'results\'][] = $search->getChunk($fTpl,$r);
                $idx++;
            }
        }
    }
}

/* set faceted results to placeholders for easy result positioning */
$output = array();
foreach ($resultsTpl as $facetKey => $facetResults) {
    $resultSet = implode($outputSeparator,$facetResults[\'results\']);
    $placeholders[$facetKey.\'.results\'] = $resultSet;
    $placeholders[$facetKey.\'.total\'] = !empty($facetResults[\'total\']) ? $facetResults[\'total\'] : 0;
    $placeholders[$facetKey.\'.key\'] = $facetKey;
}
$placeholders[\'results\'] = $placeholders[$activeFacet.\'.results\']; /* set active facet results */
$placeholders[\'total\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? $resultsTpl[$activeFacet][\'total\'] : 0;
$placeholders[\'page\'] = isset($_REQUEST[$offsetIndex]) ? ceil(intval($_REQUEST[$offsetIndex]) / $perPage) + 1 : 1;
$placeholders[\'pageCount\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? ceil($resultsTpl[$activeFacet][\'total\'] / $perPage) : 1;

if (!empty($response[\'results\'])) {
    /* add results found message */
    $placeholders[\'resultInfo\'] = $modx->lexicon(\'sisea.results_found\',array(
        \'count\' => $placeholders[\'total\'],
        \'text\' => !empty($highlightResults) ? $search->addHighlighting($searchString,$highlightClass,$highlightTag) : $searchString,
    ));
    /* if perPage set to >0, add paging */
    if ($perPage > 0) {
        $placeholders[\'paging\'] = $search->getPagination($searchString,$perPage,$pagingSeparator,$placeholders[\'total\']);
    }
}
$placeholders[\'query\'] = $searchString;
$placeholders[\'facet\'] = $activeFacet;

/* output */
$modx->setPlaceholder($placeholderPrefix.\'query\',$searchString);
$modx->setPlaceholder($placeholderPrefix.\'count\',$response[\'total\']);
$modx->setPlaceholders($placeholders,$placeholderPrefix);
if (empty($response[\'results\'])) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => $searchString,
    ));
} else {
    $output = $search->getChunk($containerTpl,$placeholders);
}
return $search->output($output,$toPlaceholder);',
      'locked' => 0,
      'properties' => 'a:43:{s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:14:"sisea.tpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"SearchResult";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:12:"containerTpl";a:7:{s:4:"name";s:12:"containerTpl";s:4:"desc";s:23:"sisea.containertpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:13:"SearchResults";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"useAllWords";a:7:{s:4:"name";s:11:"useAllWords";s:4:"desc";s:22:"sisea.useallwords_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:8:"maxWords";a:7:{s:4:"name";s:8:"maxWords";s:4:"desc";s:19:"sisea.maxwords_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:7;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:8:"minChars";a:7:{s:4:"name";s:8:"minChars";s:4:"desc";s:19:"sisea.minchars_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:3;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"searchStyle";a:7:{s:4:"name";s:11:"searchStyle";s:4:"desc";s:22:"sisea.searchstyle_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:13:"sisea.partial";s:5:"value";s:7:"partial";}i:1;a:2:{s:4:"text";s:11:"sisea.match";s:5:"value";s:5:"match";}}s:5:"value";s:7:"partial";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:7:"perPage";a:7:{s:4:"name";s:7:"perPage";s:4:"desc";s:18:"sisea.perpage_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:10;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"showExtract";a:7:{s:4:"name";s:11:"showExtract";s:4:"desc";s:22:"sisea.showextract_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:13:"extractLength";a:7:{s:4:"name";s:13:"extractLength";s:4:"desc";s:24:"sisea.extractlength_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:200;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:15:"extractEllipsis";a:7:{s:4:"name";s:15:"extractEllipsis";s:4:"desc";s:26:"sisea.extractellipsis_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"...";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:10:"includeTVs";a:7:{s:4:"name";s:10:"includeTVs";s:4:"desc";s:21:"sisea.includetvs_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:10:"processTVs";a:7:{s:4:"name";s:10:"processTVs";s:4:"desc";s:21:"sisea.processtvs_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:16:"highlightResults";a:7:{s:4:"name";s:16:"highlightResults";s:4:"desc";s:27:"sisea.highlightresults_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:14:"highlightClass";a:7:{s:4:"name";s:14:"highlightClass";s:4:"desc";s:25:"sisea.highlightclass_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:15:"sisea-highlight";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:12:"highlightTag";a:7:{s:4:"name";s:12:"highlightTag";s:4:"desc";s:23:"sisea.highlighttag_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"span";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:9:"pageLimit";a:7:{s:4:"name";s:9:"pageLimit";s:4:"desc";s:20:"sisea.pagelimit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"0";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:7:"pageTpl";a:7:{s:4:"name";s:7:"pageTpl";s:4:"desc";s:18:"sisea.pagetpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:8:"PageLink";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:12:"pageFirstTpl";a:7:{s:4:"name";s:12:"pageFirstTpl";s:4:"desc";s:23:"sisea.pagefirsttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"pageLastTpl";a:7:{s:4:"name";s:11:"pageLastTpl";s:4:"desc";s:22:"sisea.pagelasttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"pagePrevTpl";a:7:{s:4:"name";s:11:"pagePrevTpl";s:4:"desc";s:22:"sisea.pageprevtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"pageNextTpl";a:7:{s:4:"name";s:11:"pageNextTpl";s:4:"desc";s:22:"sisea.pagenexttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:14:"currentPageTpl";a:7:{s:4:"name";s:14:"currentPageTpl";s:4:"desc";s:25:"sisea.currentpagetpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:15:"CurrentPageLink";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:15:"pagingSeparator";a:7:{s:4:"name";s:15:"pagingSeparator";s:4:"desc";s:26:"sisea.pagingseparator_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:" | ";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:3:"ids";a:7:{s:4:"name";s:3:"ids";s:4:"desc";s:14:"sisea.ids_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:6:"idType";a:7:{s:4:"name";s:6:"idType";s:4:"desc";s:17:"sisea.idtype_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:13:"sisea.parents";s:5:"value";s:7:"parents";}i:1;a:2:{s:4:"text";s:15:"sisea.documents";s:5:"value";s:9:"documents";}}s:5:"value";s:7:"parents";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:7:"exclude";a:7:{s:4:"name";s:7:"exclude";s:4:"desc";s:18:"sisea.exclude_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:5:"depth";a:7:{s:4:"name";s:5:"depth";s:4:"desc";s:16:"sisea.depth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:10;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:8:"hideMenu";a:7:{s:4:"name";s:8:"hideMenu";s:4:"desc";s:19:"sisea.hidemenu_desc";s:4:"type";s:9:"textfield";s:7:"options";a:3:{i:0;a:2:{s:4:"text";s:22:"sisea.hidemenu_visible";s:5:"value";i:0;}i:1;a:2:{s:4:"text";s:21:"sisea.hidemenu_hidden";s:5:"value";i:1;}i:2;a:2:{s:4:"text";s:19:"sisea.hidemenu_both";s:5:"value";i:2;}}s:5:"value";i:2;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:8:"contexts";a:7:{s:4:"name";s:8:"contexts";s:4:"desc";s:19:"sisea.contexts_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"searchIndex";a:7:{s:4:"name";s:11:"searchIndex";s:4:"desc";s:22:"sisea.searchindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"search";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"offsetIndex";a:7:{s:4:"name";s:11:"offsetIndex";s:4:"desc";s:22:"sisea.offsetindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"sisea_offset";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:17:"placeholderPrefix";a:7:{s:4:"name";s:17:"placeholderPrefix";s:4:"desc";s:28:"sisea.placeholderprefix_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"sisea.";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:24:"sisea.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:8:"andTerms";a:7:{s:4:"name";s:8:"andTerms";s:4:"desc";s:19:"sisea.andterms_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:13:"matchWildcard";a:7:{s:4:"name";s:13:"matchWildcard";s:4:"desc";s:24:"sisea.matchwildcard_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:9:"docFields";a:7:{s:4:"name";s:9:"docFields";s:4:"desc";s:20:"sisea.docfields_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:55:"pagetitle,longtitle,alias,description,introtext,content";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:12:"fieldPotency";a:7:{s:4:"name";s:12:"fieldPotency";s:4:"desc";s:23:"sisea.fieldpotency_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:9:"urlScheme";a:7:{s:4:"name";s:9:"urlScheme";s:4:"desc";s:20:"sisea.urlscheme_desc";s:4:"type";s:4:"list";s:7:"options";a:3:{i:0;a:2:{s:4:"text";s:18:"sisea.url_relative";s:5:"value";i:-1;}i:1;a:2:{s:4:"text";s:18:"sisea.url_absolute";s:5:"value";s:3:"abs";}i:2;a:2:{s:4:"text";s:14:"sisea.url_full";s:5:"value";s:4:"full";}}s:5:"value";i:-1;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:9:"postHooks";a:7:{s:4:"name";s:9:"postHooks";s:4:"desc";s:20:"sisea.posthooks_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"activeFacet";a:7:{s:4:"name";s:11:"activeFacet";s:4:"desc";s:22:"sisea.activefacet_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"default";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:10:"facetLimit";a:7:{s:4:"name";s:10:"facetLimit";s:4:"desc";s:21:"sisea.facetlimit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:5;s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:6:"sortBy";a:7:{s:4:"name";s:6:"sortBy";s:4:"desc";s:17:"sisea.sortby_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:7:"sortDir";a:7:{s:4:"name";s:7:"sortDir";s:4:"desc";s:18:"sisea.sortdir_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:15:"sisea.ascending";s:5:"value";s:3:"ASC";}i:1;a:2:{s:4:"text";s:16:"sisea.descending";s:5:"value";s:4:"DESC";}}s:5:"value";s:4:"DESC";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * SimpleSearch snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

/* find search index and toplaceholder setting */
$searchIndex = $modx->getOption(\'searchIndex\',$scriptProperties,\'search\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
$noResultsTpl = $modx->getOption(\'noResultsTpl\',$scriptProperties,\'SearchNoResults\');

/* get search string */
if (empty($_REQUEST[$searchIndex])) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => \'\',
    ));
    return $search->output($output,$toPlaceholder);
}
$searchString = $search->parseSearchString($_REQUEST[$searchIndex]);
if (!$searchString) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => $searchString,
    ));
    return $search->output($output,$toPlaceholder);
}

/* setup default properties */
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'SearchResult\');
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,\'SearchResults\');
$showExtract = $modx->getOption(\'showExtract\',$scriptProperties,true);
$extractSource = $modx->getOption(\'extractSource\',$scriptProperties,\'content\');
$extractLength = $modx->getOption(\'extractLength\',$scriptProperties,200);
$extractEllipsis = $modx->getOption(\'extractEllipsis\',$scriptProperties,\'...\');
$highlightResults = $modx->getOption(\'highlightResults\',$scriptProperties,true);
$highlightClass = $modx->getOption(\'highlightClass\',$scriptProperties,\'sisea-highlight\');
$highlightTag = $modx->getOption(\'highlightTag\',$scriptProperties,\'span\');
$perPage = $modx->getOption(\'perPage\',$scriptProperties,10);
$pagingSeparator = $modx->getOption(\'pagingSeparator\',$scriptProperties,\' | \');
$placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'sisea.\');
$includeTVs = $modx->getOption(\'includeTVs\',$scriptProperties,\'\');
$processTVs = $modx->getOption(\'processTVs\',$scriptProperties,\'\');
$tvPrefix = $modx->getOption(\'tvPrefix\',$scriptProperties,\'\');
$offsetIndex = $modx->getOption(\'offsetIndex\',$scriptProperties,\'sisea_offset\');
$idx = isset($_REQUEST[$offsetIndex]) ? intval($_REQUEST[$offsetIndex]) + 1 : 1;
$postHooks = $modx->getOption(\'postHooks\',$scriptProperties,\'\');
$activeFacet = $modx->getOption(\'facet\',$_REQUEST,$modx->getOption(\'activeFacet\',$scriptProperties,\'default\'));
$activeFacet = $modx->sanitizeString($activeFacet);
$facetLimit = $modx->getOption(\'facetLimit\',$scriptProperties,5);
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$addSearchToLink = intval($modx->getOption(\'addSearchToLink\',$scriptProperties,"0"));
$searchInLinkName = $modx->getOption(\'searchInLinkName\',$scriptProperties,"search");

/* get results */
$response = $search->getSearchResults($searchString,$scriptProperties);
$placeholders = array(\'query\' => $searchString);
$resultsTpl = array(\'default\' => array(\'results\' => array(),\'total\' => $response[\'total\']));
if (!empty($response[\'results\'])) {
    /* iterate through search results */
    foreach ($response[\'results\'] as $resourceArray) {
        $resourceArray[\'idx\'] = $idx;
        if (empty($resourceArray[\'link\'])) {
            $ctx = !empty($resourceArray[\'context_key\']) ? $resourceArray[\'context_key\'] : $modx->context->get(\'key\');
            $args = \'\';
            if ($addSearchToLink) {
                $args = array($searchInLinkName => $searchString);
            }
            $resourceArray[\'link\'] = $modx->makeUrl($resourceArray[\'id\'],$ctx,$args);
        }
        if ($showExtract) {
            $extract = $searchString;
            if (array_key_exists($extractSource, $resourceArray)) {
                $text = $resourceArray[$extractSource];
            } else {
                $text = $modx->runSnippet($extractSource, $resourceArray);
            }
            $extract = $search->createExtract($text,$extractLength,$extract,$extractEllipsis);
            /* cleanup extract */
            $extract = strip_tags(preg_replace("#\\<!--(.*?)--\\>#si",\'\',$extract));
            $extract = preg_replace("#\\[\\[(.*?)\\]\\]#si",\'\',$extract);
            $extract = str_replace(array(\'[[\',\']]\'),\'\',$extract);
            $resourceArray[\'extract\'] = !empty($highlightResults) ? $search->addHighlighting($extract,$highlightClass,$highlightTag) : $extract;
        }
        $resultsTpl[\'default\'][\'results\'][] = $search->getChunk($tpl,$resourceArray);
        $idx++;
    }
}

/* load postHooks to get faceted results */
if (!empty($postHooks)) {
    $limit = !empty($facetLimit) ? $facetLimit : $perPage;
    $search->loadHooks(\'post\');
    $search->postHooks->loadMultiple($postHooks,$response[\'results\'],array(
        \'hooks\' => $postHooks,
        \'search\' => $searchString,
        \'offset\' => !empty($_GET[$offsetIndex]) ? intval($_GET[$offsetIndex]) : 0,
        \'limit\' => $limit,
        \'perPage\' => $limit,
    ));
    if (!empty($search->postHooks->facets)) {
        foreach ($search->postHooks->facets as $facetKey => $facetResults) {
            if (empty($resultsTpl[$facetKey])) {
                $resultsTpl[$facetKey] = array();
                $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
                $resultsTpl[$facetKey][\'results\'] = array();
            } else {
                $resultsTpl[$facetKey][\'total\'] = $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
            }

            $idx = !empty($resultsTpl[$facetKey]) ? count($resultsTpl[$facetKey][\'results\'])+1 : 1;
            foreach ($facetResults[\'results\'] as $r) {
                $r[\'idx\'] = $idx;
                $fTpl = !empty($scriptProperties[\'tpl\'.$facetKey]) ? $scriptProperties[\'tpl\'.$facetKey] : $tpl;
                $resultsTpl[$facetKey][\'results\'][] = $search->getChunk($fTpl,$r);
                $idx++;
            }
        }
    }
}

/* set faceted results to placeholders for easy result positioning */
$output = array();
foreach ($resultsTpl as $facetKey => $facetResults) {
    $resultSet = implode($outputSeparator,$facetResults[\'results\']);
    $placeholders[$facetKey.\'.results\'] = $resultSet;
    $placeholders[$facetKey.\'.total\'] = !empty($facetResults[\'total\']) ? $facetResults[\'total\'] : 0;
    $placeholders[$facetKey.\'.key\'] = $facetKey;
}
$placeholders[\'results\'] = $placeholders[$activeFacet.\'.results\']; /* set active facet results */
$placeholders[\'total\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? $resultsTpl[$activeFacet][\'total\'] : 0;
$placeholders[\'page\'] = isset($_REQUEST[$offsetIndex]) ? ceil(intval($_REQUEST[$offsetIndex]) / $perPage) + 1 : 1;
$placeholders[\'pageCount\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? ceil($resultsTpl[$activeFacet][\'total\'] / $perPage) : 1;

if (!empty($response[\'results\'])) {
    /* add results found message */
    $placeholders[\'resultInfo\'] = $modx->lexicon(\'sisea.results_found\',array(
        \'count\' => $placeholders[\'total\'],
        \'text\' => !empty($highlightResults) ? $search->addHighlighting($searchString,$highlightClass,$highlightTag) : $searchString,
    ));
    /* if perPage set to >0, add paging */
    if ($perPage > 0) {
        $placeholders[\'paging\'] = $search->getPagination($searchString,$perPage,$pagingSeparator,$placeholders[\'total\']);
    }
}
$placeholders[\'query\'] = $searchString;
$placeholders[\'facet\'] = $activeFacet;

/* output */
$modx->setPlaceholder($placeholderPrefix.\'query\',$searchString);
$modx->setPlaceholder($placeholderPrefix.\'count\',$response[\'total\']);
$modx->setPlaceholders($placeholders,$placeholderPrefix);
if (empty($response[\'results\'])) {
    $output = $search->getChunk($noResultsTpl,array(
        \'query\' => $searchString,
    ));
} else {
    $output = $search->getChunk($containerTpl,$placeholders);
}
return $search->output($output,$toPlaceholder);',
    ),
  ),
  'f84159172be279316e9fa09095114c42' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearchForm',
    ),
    'object' => 
    array (
      'id' => 13,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearchForm',
      'description' => '',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * Show the search form
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

/* setup default options */
$scriptProperties = array_merge(array(
  \'tpl\' => \'SearchForm\',
  \'method\' => \'get\',
  \'searchIndex\' => \'search\',
  \'toPlaceholder\' => false,
  \'landing\' => $modx->resource->get(\'id\'),
), $scriptProperties);

if (empty($scriptProperties[\'landing\'])) {
  $scriptProperties[\'landing\'] = $modx->resource->get(\'id\');
}

/* if get value already exists, set it as default */
$searchValue = isset($_REQUEST[$scriptProperties[\'searchIndex\']]) ? $_REQUEST[$scriptProperties[\'searchIndex\']] : \'\';
$searchValues = explode(\' \', $searchValue);
array_map(array($modx, \'sanitizeString\'), $searchValues);
$searchValue = implode(\' \', $searchValues);
$placeholders = array(
    \'method\' => $scriptProperties[\'method\'],
    \'landing\' => $scriptProperties[\'landing\'],
    \'searchValue\' => strip_tags(str_replace(array(\'[\',\']\',\'"\',"\'"),array(\'&#91;\',\'&#93;\',\'&quot;\',\'&apos;\'),$searchValue)),
    \'searchIndex\' => $scriptProperties[\'searchIndex\'],
);

$output = $search->getChunk($scriptProperties[\'tpl\'],$placeholders);
return $search->output($output,$scriptProperties[\'toPlaceholder\']);',
      'locked' => 0,
      'properties' => 'a:5:{s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:19:"sisea.tpl_form_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:10:"SearchForm";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:7:"landing";a:7:{s:4:"name";s:7:"landing";s:4:"desc";s:18:"sisea.landing_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:11:"searchIndex";a:7:{s:4:"name";s:11:"searchIndex";s:4:"desc";s:22:"sisea.searchindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"search";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:6:"method";a:7:{s:4:"name";s:6:"method";s:4:"desc";s:17:"sisea.method_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:9:"sisea.get";s:5:"value";s:3:"get";}i:1;a:2:{s:4:"text";s:10:"sisea.post";s:5:"value";s:4:"post";}}s:5:"value";s:3:"get";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:24:"sisea.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:16:"sisea:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * SimpleSearch
 *
 * Copyright 2010-11 by Shaun McCormick <shaun+sisea@modx.com>
 *
 * This file is part of SimpleSearch, a simple search component for MODx
 * Revolution. It is loosely based off of AjaxSearch for MODx Evolution by
 * coroico/kylej, minus the ajax.
 *
 * SimpleSearch is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SimpleSearch is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SimpleSearch; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package simplesearch
 */
/**
 * Show the search form
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(\'sisea.core_path\',null,$modx->getOption(\'core_path\').\'components/simplesearch/\').\'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx,$scriptProperties);

/* setup default options */
$scriptProperties = array_merge(array(
  \'tpl\' => \'SearchForm\',
  \'method\' => \'get\',
  \'searchIndex\' => \'search\',
  \'toPlaceholder\' => false,
  \'landing\' => $modx->resource->get(\'id\'),
), $scriptProperties);

if (empty($scriptProperties[\'landing\'])) {
  $scriptProperties[\'landing\'] = $modx->resource->get(\'id\');
}

/* if get value already exists, set it as default */
$searchValue = isset($_REQUEST[$scriptProperties[\'searchIndex\']]) ? $_REQUEST[$scriptProperties[\'searchIndex\']] : \'\';
$searchValues = explode(\' \', $searchValue);
array_map(array($modx, \'sanitizeString\'), $searchValues);
$searchValue = implode(\' \', $searchValues);
$placeholders = array(
    \'method\' => $scriptProperties[\'method\'],
    \'landing\' => $scriptProperties[\'landing\'],
    \'searchValue\' => strip_tags(str_replace(array(\'[\',\']\',\'"\',"\'"),array(\'&#91;\',\'&#93;\',\'&quot;\',\'&apos;\'),$searchValue)),
    \'searchIndex\' => $scriptProperties[\'searchIndex\'],
);

$output = $search->getChunk($scriptProperties[\'tpl\'],$placeholders);
return $search->output($output,$scriptProperties[\'toPlaceholder\']);',
    ),
  ),
  'd23ee13520ba37051f32f290175b75ae' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearchElasticIndexSetup_default',
    ),
    'object' => 
    array (
      'id' => 14,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearchElasticIndexSetup_default',
      'description' => 'Setup snippet for ElasticSearch index',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '$indexSetup = array(
    \'number_of_shards\' => 5,
    \'number_of_replicas\' => 1,
    \'analysis\' => array(
        \'analyzer\' => array(
            \'default_index\' => array(
                "type" => "custom",
                "tokenizer" => "whitespace",
                "filter" => array(
                    "asciifolding",
                    "standard",
                    "lowercase",
                    "haystack_edgengram"
                )
            ),
            \'default_search\' => array(
                "type" => "custom",
                "tokenizer" => "whitespace",
                "filter" => array(
                    "asciifolding",
                    "standard",
                    "lowercase"
                )
            )
        ),
        "filter" => array(
            "haystack_ngram" => array(
                "type" => "nGram",
                "min_gram" => 2,
                "max_gram" => 30,
            ),
            "haystack_edgengram" => array(
                "type" => "edgeNGram",
                "min_gram" => 2,
                "max_gram" => 30,
            )
        )
    )
);

return $modx->toJSON($indexSetup);',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '$indexSetup = array(
    \'number_of_shards\' => 5,
    \'number_of_replicas\' => 1,
    \'analysis\' => array(
        \'analyzer\' => array(
            \'default_index\' => array(
                "type" => "custom",
                "tokenizer" => "whitespace",
                "filter" => array(
                    "asciifolding",
                    "standard",
                    "lowercase",
                    "haystack_edgengram"
                )
            ),
            \'default_search\' => array(
                "type" => "custom",
                "tokenizer" => "whitespace",
                "filter" => array(
                    "asciifolding",
                    "standard",
                    "lowercase"
                )
            )
        ),
        "filter" => array(
            "haystack_ngram" => array(
                "type" => "nGram",
                "min_gram" => 2,
                "max_gram" => 30,
            ),
            "haystack_edgengram" => array(
                "type" => "edgeNGram",
                "min_gram" => 2,
                "max_gram" => 30,
            )
        )
    )
);

return $modx->toJSON($indexSetup);',
    ),
  ),
);