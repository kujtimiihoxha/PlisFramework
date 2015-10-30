<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:30
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Body extends Node
{
    public $scripts;
    public $container;
    public function __construct(array $options=null){
        $this->scripts=[];
        parent::__construct('body',$options);
        $this->container=(new Div())->addClass('container');
    }
    public function construct(){
        $this->addChildNode($this->container);
        foreach($this->scripts as $script){
            $this->addChildNode($script);
        }
        return parent::construct();
    }
    public function addNavigation($nav){
        $this->addChildNode($nav);
        return $this;
    }
    public function addContent($node){
        $this->container->addChildNode($node);
        return $this;
    }
    public function addAjaxLoading(){
        $this->container->setId('view');
        return $this;
    }
}