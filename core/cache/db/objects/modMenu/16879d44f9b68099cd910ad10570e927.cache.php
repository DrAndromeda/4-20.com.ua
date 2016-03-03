<?php  return array (
  0 => 
  array (
    'text' => 'users',
    'parent' => 'manage',
    'action' => 'security/user',
    'description' => 'user_management_desc',
    'icon' => '',
    'menuindex' => '0',
    'params' => '',
    'handler' => '',
    'permissions' => 'view_user',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
  1 => 
  array (
    'text' => 'refresh_site',
    'parent' => 'manage',
    'action' => '',
    'description' => 'refresh_site_desc',
    'icon' => '',
    'menuindex' => '1',
    'params' => '',
    'handler' => 'MODx.clearCache(); return false;',
    'permissions' => 'empty_cache',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
  2 => 
  array (
    'text' => 'remove_locks',
    'parent' => 'manage',
    'action' => '',
    'description' => 'remove_locks_desc',
    'icon' => '',
    'menuindex' => '2',
    'params' => '',
    'handler' => '
MODx.msg.confirm({
    title: _(\'remove_locks\')
    ,text: _(\'confirm_remove_locks\')
    ,url: MODx.config.connectors_url
    ,params: {
        action: \'system/remove_locks\'
    }
    ,listeners: {
        \'success\': {fn:function() {
            var tree = Ext.getCmp("modx-resource-tree");
            if (tree && tree.rendered) {
                tree.refresh();
            }
         },scope:this}
    }
});',
    'permissions' => 'remove_locks',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
  3 => 
  array (
    'text' => 'flush_access',
    'parent' => 'manage',
    'action' => '',
    'description' => 'flush_access_desc',
    'icon' => '',
    'menuindex' => '3',
    'params' => '',
    'handler' => 'MODx.msg.confirm({
    title: _(\'flush_access\')
    ,text: _(\'flush_access_confirm\')
    ,url: MODx.config.connector_url
    ,params: {
        action: \'security/access/flush\'
    }
    ,listeners: {
        \'success\': {fn:function() { location.href = \'./\'; },scope:this}
    }
});',
    'permissions' => 'access_permissions',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
  4 => 
  array (
    'text' => 'flush_sessions',
    'parent' => 'manage',
    'action' => '',
    'description' => 'flush_sessions_desc',
    'icon' => '',
    'menuindex' => '4',
    'params' => '',
    'handler' => 'MODx.msg.confirm({
    title: _(\'flush_sessions\')
    ,text: _(\'flush_sessions_confirm\')
    ,url: MODx.config.connector_url
    ,params: {
        action: \'security/flush\'
    }
    ,listeners: {
        \'success\': {fn:function() { location.href = \'./\'; },scope:this}
    }
});',
    'permissions' => 'flush_sessions',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
  5 => 
  array (
    'text' => 'reports',
    'parent' => 'manage',
    'action' => '',
    'description' => 'reports_desc',
    'icon' => '',
    'menuindex' => '5',
    'params' => '',
    'handler' => '',
    'permissions' => 'menu_reports',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
  ),
);