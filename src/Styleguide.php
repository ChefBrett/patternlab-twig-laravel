<?php

namespace Daspete\Laravel;

use Twig_Environment;
use Twig_Loader_Chain;
use Twig_Loader_Array;
use Labcoat\Twig\Loader;
use Labcoat\Configuration\Configuration;
use Labcoat\Styleguide\Styleguide as LabcoatStyleguide;
use Daspete\Laravel\Patternlab as PatternlabExtension;

use Config;

class Styleguide extends LabcoatStyleguide {

    protected function makePatternParser(){
        parent::makePatternParser();

        $this->patternParser->addExtension(new PatternlabExtension());
    }

    protected function makeTemplateParser(){
        parent::makeTemplateParser();

        $this->templateParser->addExtension(new PatternlabExtension());
    }

    public static function getConfig(){
        $extConfig = (object)Config::get('patternlab');

        $config = new Configuration();
        $config->setPatternExtension('twig');
        $config->setHiddenControls(['hay']);

        $config->setTwigOptions([
            'debug' => true,
            'cache' => false,
            'strict_variables' => true
        ]);

        $config->setStyleguideHeader(base_path() . '/' . $extConfig->styleguide_source_path . '/_head.twig');
        $config->setStyleguideFooter(base_path() . '/' . $extConfig->styleguide_source_path . '/_foot.twig');
        $config->setAnnotationsFile(base_path() . '/' . $extConfig->styleguide_source_path . '/annotations.js');

        $dataPath = base_path() . '/' . $extConfig->styleguide_source_path . '/data/';
        $dataDir = dir($dataPath);

        while(($data = $dataDir->read()) !== false){
            if(!is_file($dataPath . $data)){
                continue;
            }

            $config->addGlobalData($dataPath . $data);
        }

        $config->setPatternsDirectory(base_path() . '/' . $extConfig->layout_path . '/patterns');

        $config->addStyleguideAssetDirectory(base_path() . '/' . $extConfig->vendor_path . '/pattern-lab/styleguidekit-assets-default/dist');
        $config->setStyleguideTemplatesDirectory(base_path() . '/' . $extConfig->vendor_path . '/pattern-lab/styleguidekit-twig-default/views');
        
        return $config;
    }

}