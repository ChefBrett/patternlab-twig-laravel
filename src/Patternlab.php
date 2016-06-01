<?php

namespace Daspete\Laravel;

use Twig_Extension;
use Twig_Extension_InitRuntimeInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_Loader_Chain;
use Twig_SimpleFunction;
use Twig_SimpleTest;
use Labcoat\Twig\Loader as LabcoatLoader;
use Labcoat\PatternLab as LabcoatPatternlab;

use Config;

class Patternlab extends Twig_Extension implements Twig_Extension_InitRuntimeInterface {

    public function initRuntime(Twig_Environment $env){
        parent::initRuntime($env);

        $config = (object)Config::get('patternlab');
        var_dump($config->path);
    }

    public function getName(){
        return 'Daspete_Twig_Extension_Patternlab';
    }

}