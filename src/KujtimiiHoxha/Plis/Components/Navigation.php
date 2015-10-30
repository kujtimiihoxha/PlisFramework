<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 11:26
 */

namespace KujtimiiHoxha\Plis\Components;


use KujtimiiHoxha\Plis\Components\Navigation\NavigationBar;
use KujtimiiHoxha\Plis\Components\Navigation\NavigationBrand;
use KujtimiiHoxha\Plis\Components\Navigation\NavigationHeader;
use KujtimiiHoxha\Plis\Core\Html\Div;
use KujtimiiHoxha\Plis\Core\Html\Nav;
use KujtimiiHoxha\Plis\Core\Node;

class Navigation extends Node
{
    /**
     * @var NavigationBar
     */
    private $navigationBar;
    /**
     * @var NavigationHeader
     */
    private $navigationHeader;

    private $opt;
    /** @noinspection PhpMissingParentConstructorInspection
     * @param array $options
     */
    public function __construct(array $options = []){
        if(!array_key_exists('type',$options))$options['type']='static';
        $this->opt=$options;
        if(!array_key_exists('header',$this->opt))$this->opt['header']=[];
        if(!array_key_exists('menu',$this->opt))$this->opt['menu']=[];
        $this->navigationBar=new NavigationBar($this->opt['menu']);
        $this->navigationHeader=new NavigationHeader($this->opt['header']);
    }
    public  function construct(){
        if($this->opt['type']==='fluid'){
            parent::__construct('div', $this->opt);
            $this->addClass('container');
            $this->addChildNode((new Nav())
                ->addClass('navbar navbar-default')
                ->addChildNode((new Div())
                    ->addClass('container-fluid')
                    ->addChildNode($this->navigationHeader)
                    ->addChildNode($this->navigationBar)
                )
            );
        }
        else if($this->opt['type']==='static'){
            parent::__construct('nav', $this->opt);
            $this->addClass('navbar navbar-default navbar-static-top');
            $this->addChildNode((new Div())
                ->addClass('container')
                ->addChildNode($this->navigationHeader)
                ->addChildNode( $this->navigationBar));

        }
        else if($this->opt['type']==='fixed'){
            parent::__construct('nav', $this->opt);
            $this->addClass('navbar navbar-default navbar-fixed-top');
            $this->addChildNode((new Div())
                ->addClass('container')
                ->addChildNode($this->navigationHeader)
                ->addChildNode($this->navigationBar));

        }

        return  parent::construct();
    }
    public function setType($type){
        $this->opt['type']=$type;
        return $this;
    }
    public function setColors($background,$text='rgba(255,255,255,.84)'){
        if(!array_key_exists('attributes',$this->opt))$this->opt['attributes']=[];
        $this->opt['attributes']['style']='background-color:'.$background.';color:'.$text.';';
        return $this;
    }
    public function setMenuSide($side){
        $this->navigationBar->setMenuSide($side);
        return $this;
    }
    public function setBrandTitle($title){
        $this->navigationHeader->setTitle($title);
        return $this;

    }
    public function setBrandImage($link,$width=20,$height=20){
        $this->navigationHeader->setBrandImage($link,$width,$height);
        return $this;

    }
    public function setBrandLink($link){
        $this->navigationHeader->setBrandLink($link);
        return $this;
    }
    public function addMenuItem($text,$path,$active=false,$subItems=null){
        $this->navigationBar->addMenuItem($text,$path,$active,$subItems);
        return $this;
    }
}