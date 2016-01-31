<?php

class RedirectorUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'modRedirect';
    public $languageTopics = array('redirector:default');
    public $objectType = 'redirector.redirect';

    public function initialize() {
        $this->modx->getParser();
        return parent::initialize();
    }

    public function beforeSet() {
        $context = $this->getProperty('context_key');
        if(empty($context)) {
            $this->setProperty('context_key', NULL);
        }
        $context = $this->getProperty('context_key');

        // check if pattern is an existing resource
        $criteria = array('uri' => $this->getProperty('pattern'), 'published' => true, 'deleted' => false);
        if(!empty($context)) { $criteria['context_key'] = $context; }
        $resource = $this->modx->getObject('modResource', $criteria);
        if(!empty($resource) && is_object($resource)) {
            $this->addFieldError('pattern', $this->modx->lexicon('redirector.redirect_err_ae_uri', array('id' => $resource->get('id'), 'context' => $resource->get('context_key'))));
        }

        // check if target is a NON existing resource
        $target = $this->getProperty('target');
        if(strpos($target, '$') === false) {

            // parse link & MODX tags
            $this->modx->parser->processElementTags('', $target, true, true);

            if(!empty($target)) {

                if (!strpos($target, '://')) {
                    $target = $this->modx->getOption('site_url') . (($target == '/') ? '' : $target);
                }

                // checking full links
                if(strpos($target, '://') !== false) {

                    $headers = @get_headers($target);
                    if(empty($headers)) {
                        $this->addFieldError('target', $this->modx->lexicon('redirector.redirect_err_ne_target'));
                    }
                }
                else {

                    $criteria = array('uri' => $target);
                    if(!empty($context)) { $criteria['context_key'] = $context; }
                    $resource = $this->modx->getObject('modResource', $criteria);
                    if(empty($resource) || !is_object($resource)) {

                        // check if could be a file?
                        $basePath = $this->modx->getOption('base_path');
                        if(!file_exists($basePath.$target)) {
                            $this->addFieldError('target', $this->modx->lexicon('redirector.redirect_err_ne_target'));
                        }
                    }
                }
            }
            else {
                $this->addFieldError('target', $this->modx->lexicon('redirector.redirect_err_ne_target'));
            }
        }

        return parent::beforeSet();
    }
}

return 'RedirectorUpdateProcessor';