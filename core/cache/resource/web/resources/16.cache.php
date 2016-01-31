<?php  return array (
  'resourceClass' => 'modDocument',
  'resource' => 
  array (
    'id' => 16,
    'type' => 'document',
    'contentType' => 'text/xml',
    'pagetitle' => 'sitemap.xml',
    'longtitle' => '',
    'description' => '',
    'alias' => 'sitemap',
    'link_attributes' => '',
    'published' => 1,
    'pub_date' => 0,
    'unpub_date' => 0,
    'parent' => 0,
    'isfolder' => 0,
    'introtext' => '',
    'content' => '[[!GoogleSiteMap? &context=`web,marketing`]]',
    'richtext' => 0,
    'template' => 0,
    'menuindex' => 1,
    'searchable' => 0,
    'cacheable' => 1,
    'createdby' => 1,
    'createdon' => 1444567859,
    'editedby' => 1,
    'editedon' => 1444567988,
    'deleted' => 0,
    'deletedon' => 0,
    'deletedby' => 0,
    'publishedon' => 1444567800,
    'publishedby' => 1,
    'menutitle' => '',
    'donthit' => 0,
    'privateweb' => 0,
    'privatemgr' => 0,
    'content_dispo' => 0,
    'hidemenu' => 1,
    'class_key' => 'modDocument',
    'context_key' => 'web',
    'content_type' => 2,
    'uri' => 'sitemap.xml',
    'uri_override' => 0,
    'hide_children_in_tree' => 0,
    'show_in_tree' => 1,
    'properties' => NULL,
    '_content' => '[[!GoogleSiteMap? &context=`web,marketing`]]',
    '_isForward' => false,
  ),
  'contentType' => 
  array (
    'id' => 2,
    'name' => 'XML',
    'description' => 'XML content',
    'mime_type' => 'text/xml',
    'file_extensions' => '.xml',
    'headers' => NULL,
    'binary' => 0,
  ),
  'policyCache' => 
  array (
  ),
  'sourceCache' => 
  array (
    'modChunk' => 
    array (
    ),
    'modSnippet' => 
    array (
      'GoogleSiteMap' => 
      array (
        'fields' => 
        array (
          'id' => 11,
          'source' => 0,
          'property_preprocess' => true,
          'name' => 'GoogleSiteMap',
          'description' => 'Builds the Google SiteMap XML.',
          'editor_type' => 0,
          'category' => 3,
          'cache_type' => 0,
          'snippet' => '/**
 * GoogleSiteMap
 *
 * Copyright 2009-2010 by Shaun McCormick <shaun@modx.com>
 *
 * - Based on Michal Till\'s MODx Evolution GoogleSiteMap_XML snippet
 *
 * GoogleSiteMap is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * GoogleSiteMap is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GoogleSiteMap; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package googlesitemap
 */
/**
 * GoogleSiteMap for MODx Revolution
 *
 * @package googlesitemap
 */
require_once $modx->getOption(\'googlesitemap.core_path\',null,$modx->getOption(\'core_path\').\'components/googlesitemap/\').\'model/googlesitemap/googlesitemap.class.php\';
$GoogleSiteMap = new GoogleSiteMap($modx,$scriptProperties);

/* setup default properties */
$googleSchema = $modx->getOption(\'googleSchema\',$scriptProperties,\'http://www.sitemaps.org/schemas/sitemap/0.9\');
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,\'gContainer\');
$startId = (int)$modx->getOption(\'startId\',$scriptProperties,0);

/* get container tpl and content */
return $GoogleSiteMap->getChunk($containerTpl,array(
    \'schema\' => $googleSchema,
    \'items\' => $GoogleSiteMap->run($startId),
));',
          'locked' => false,
          'properties' => 
          array (
            'allowedtemplates' => 
            array (
              'name' => 'allowedtemplates',
              'desc' => 'prop_gsm.allowedtemplates_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.allowedtemplates_desc',
              'area_trans' => '',
            ),
            'containerTpl' => 
            array (
              'name' => 'containerTpl',
              'desc' => 'prop_gsm.containertpl_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'gContainer',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.containertpl_desc',
              'area_trans' => '',
            ),
            'context' => 
            array (
              'name' => 'context',
              'desc' => 'prop_gsm.context_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.context_desc',
              'area_trans' => '',
            ),
            'excludeChildrenOf' => 
            array (
              'name' => 'excludeChildrenOf',
              'desc' => 'prop_gsm.excludechildrenof_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.excludechildrenof_desc',
              'area_trans' => '',
            ),
            'excludeResources' => 
            array (
              'name' => 'excludeResources',
              'desc' => 'prop_gsm.excluderesources_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.excluderesources_desc',
              'area_trans' => '',
            ),
            'googleSchema' => 
            array (
              'name' => 'googleSchema',
              'desc' => 'prop_gsm.googleschema_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.googleschema_desc',
              'area_trans' => '',
            ),
            'hideDeleted' => 
            array (
              'name' => 'hideDeleted',
              'desc' => 'prop_gsm.hidedeleted_desc',
              'type' => 'combo-boolean',
              'options' => 
              array (
              ),
              'value' => true,
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.hidedeleted_desc',
              'area_trans' => '',
            ),
            'itemTpl' => 
            array (
              'name' => 'itemTpl',
              'desc' => 'prop_gsm.itemtpl_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'gItem',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.itemtpl_desc',
              'area_trans' => '',
            ),
            'maxDepth' => 
            array (
              'name' => 'maxDepth',
              'desc' => 'prop_gsm.maxdepth_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '0',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.maxdepth_desc',
              'area_trans' => '',
            ),
            'priorityTV' => 
            array (
              'name' => 'priorityTV',
              'desc' => 'prop_gsm.prioritytv_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.prioritytv_desc',
              'area_trans' => '',
            ),
            'published' => 
            array (
              'name' => 'published',
              'desc' => 'prop_gsm.published_desc',
              'type' => 'combo-boolean',
              'options' => 
              array (
              ),
              'value' => true,
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.published_desc',
              'area_trans' => '',
            ),
            'searchable' => 
            array (
              'name' => 'searchable',
              'desc' => 'prop_gsm.searchable_desc',
              'type' => 'combo-boolean',
              'options' => 
              array (
              ),
              'value' => true,
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.searchable_desc',
              'area_trans' => '',
            ),
            'showHidden' => 
            array (
              'name' => 'showHidden',
              'desc' => 'prop_gsm.showhidden_desc',
              'type' => 'combo-boolean',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.showhidden_desc',
              'area_trans' => '',
            ),
            'sortBy' => 
            array (
              'name' => 'sortBy',
              'desc' => 'prop_gsm.sortby_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'menuindex',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.sortby_desc',
              'area_trans' => '',
            ),
            'sortByAlias' => 
            array (
              'name' => 'sortByAlias',
              'desc' => 'prop_gsm.sortbyalias_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'modResource',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.sortbyalias_desc',
              'area_trans' => '',
            ),
            'sortDir' => 
            array (
              'name' => 'sortDir',
              'desc' => 'prop_gsm.sortdir_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'ASC',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.sortdir_desc',
              'area_trans' => '',
            ),
            'startId' => 
            array (
              'name' => 'startId',
              'desc' => 'prop_gsm.startid_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '0',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.startid_desc',
              'area_trans' => '',
            ),
            'templateFilter' => 
            array (
              'name' => 'templateFilter',
              'desc' => 'prop_gsm.templatefilter_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => 'id',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.templatefilter_desc',
              'area_trans' => '',
            ),
            'where' => 
            array (
              'name' => 'where',
              'desc' => 'prop_gsm.where_desc',
              'type' => 'textfield',
              'options' => 
              array (
              ),
              'value' => '',
              'lexicon' => NULL,
              'area' => '',
              'desc_trans' => 'prop_gsm.where_desc',
              'area_trans' => '',
            ),
          ),
          'moduleguid' => '',
          'static' => false,
          'static_file' => '',
          'content' => '/**
 * GoogleSiteMap
 *
 * Copyright 2009-2010 by Shaun McCormick <shaun@modx.com>
 *
 * - Based on Michal Till\'s MODx Evolution GoogleSiteMap_XML snippet
 *
 * GoogleSiteMap is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * GoogleSiteMap is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GoogleSiteMap; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package googlesitemap
 */
/**
 * GoogleSiteMap for MODx Revolution
 *
 * @package googlesitemap
 */
require_once $modx->getOption(\'googlesitemap.core_path\',null,$modx->getOption(\'core_path\').\'components/googlesitemap/\').\'model/googlesitemap/googlesitemap.class.php\';
$GoogleSiteMap = new GoogleSiteMap($modx,$scriptProperties);

/* setup default properties */
$googleSchema = $modx->getOption(\'googleSchema\',$scriptProperties,\'http://www.sitemaps.org/schemas/sitemap/0.9\');
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,\'gContainer\');
$startId = (int)$modx->getOption(\'startId\',$scriptProperties,0);

/* get container tpl and content */
return $GoogleSiteMap->getChunk($containerTpl,array(
    \'schema\' => $googleSchema,
    \'items\' => $GoogleSiteMap->run($startId),
));',
        ),
        'policies' => 
        array (
          'web' => 
          array (
          ),
        ),
        'source' => 
        array (
        ),
      ),
    ),
    'modTemplateVar' => 
    array (
    ),
  ),
);