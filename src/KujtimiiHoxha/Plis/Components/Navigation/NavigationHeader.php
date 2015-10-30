<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 11:27
 */

namespace KujtimiiHoxha\Plis\Components\Navigation;


use KujtimiiHoxha\Plis\Core\Html\Button;
use KujtimiiHoxha\Plis\Core\Html\Span;
use KujtimiiHoxha\Plis\Core\Node;

class NavigationHeader extends Node
{
    /**
     * @var NavigationBrand
     */
    private $navBrand;

    public function __construct(array $options = null){
        parent::__construct('div',$options);
        $this->addClass('navbar-header');
        $this->addChildNode((new Button(['attributes'=>[ 'type'=>"button",'class'=>"navbar-toggle",'data-toggle'=>"collapse",'data-target'=>".navbar-collapse"]]))
                                ->addChildNode((new Span())->addClass("icon-bar"))
                                ->addChildNode((new Span())->addClass("icon-bar"))
                                ->addChildNode((new Span())->addClass("icon-bar"))
        );
        if($options==null)$options=[];if(!array_key_exists('brand',$options))$options['brand']=null;
        $this->navBrand=new NavigationBrand($options['brand']);
    }
    public function construct(){
        $this->addChildNode($this->navBrand);
        return parent::construct();
    }
    public function setBrandImage($link,$width,$height){
        $this->navBrand->setBrandImage($link,$width,$height);
        return $this;
    }
    public function setBrandLink($link){
        $this->navBrand->setBrandLink($link);
        return $this;
    }
    public function setTitle($title){
        $this->navBrand->setTitle($title);
        return $this;
    }

}