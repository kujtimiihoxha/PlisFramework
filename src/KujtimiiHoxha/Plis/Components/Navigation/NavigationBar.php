<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 11:26
 */

namespace KujtimiiHoxha\Plis\Components\Navigation;


use KujtimiiHoxha\Plis\Core\Html\A;
use KujtimiiHoxha\Plis\Core\Html\Li;
use KujtimiiHoxha\Plis\Core\Html\Span;
use KujtimiiHoxha\Plis\Core\Html\Text;
use KujtimiiHoxha\Plis\Core\Html\Ul;
use KujtimiiHoxha\Plis\Core\Node;

class NavigationBar extends Node
{
    private $menu;
    private $opt;
    public function __construct(array $options = null)
    {
        parent::__construct('div', $options);
        $this->setId('navbar');
        $this->addClass('navbar-collapse collapse');
        $this->opt=$options;

    }
    public function construct(){
        if(is_array($this->opt)){
            if(!array_key_exists('side',$this->opt))$this->opt['side']='right';
            if($this->opt['side']==='right'){
                $this->menu=(new Ul($this->opt))->addClass("nav navbar-nav navbar-right");
                $this->addMenu($this->opt);

            }
            else if($this->opt['side']==='left'){
                $this->menu=(new Ul($this->opt))->addClass("nav navbar-nav");
                $this->addMenu($this->opt);

            }

            $this->addChildNode($this->menu);
        }
        return parent::construct();
    }
    private function addMenu($options){
        if(array_key_exists('items',$options)){
            foreach($options['items'] as $item){
                if(array_key_exists('active',$item)){
                    $li=new Li();
                    $li->addClass('active');
                    if(array_key_exists("subItems",$item)){
                        $li->addClass('dropdown')
                            ->addChildNode((new A(['attributes'=>['href'=>$item['path'],'class'=>"dropdown-toggle",
                                'data-toggle'=>"dropdown",'role'=>"button",'aria-haspopup'=>"true" ,'aria-expanded'=>"false"]]))
                                ->addChildNode(new Text($item['text']))
                                ->addChildNode((new Span())
                                    ->addClass("caret")
                                )
                            );
                        $subMenu=(new Ul())->addClass("dropdown-menu");
                        foreach($item['subItems']as $subItms){
                            if(array_search('active',$subItms)){
                                $subLi=(new Li())
                                    ->addClass('active')
                                    ->addChildNode((new A())
                                        ->addAttribute('href',$subItms['path'])
                                        ->addChildNode(new Text($subItms['text']))
                                    );
                            }
                            else{
                                $subLi=(new Li())
                                    ->addChildNode((new A())
                                        ->addAttribute('href',$subItms['path'])
                                        ->addChildNode(new Text($subItms['text']))
                                    );
                            }
                            $subMenu->addChildNode($subLi);
                        }
                        $li->addChildNode($subMenu);
                    }
                    else{
                        $li->addChildNode((new A())
                            ->addAttribute('href',$item['path'])
                            ->addChildNode(new Text($item['text']))
                        );
                    }
                    $this->menu->addChildNode($li);
                }
                else{
                    $li=new Li();
                    if(array_key_exists("subItems",$item)){
                        $li->addClass('dropdown')
                            ->addChildNode((new A(['attributes'=>['href'=>$item['path'],'class'=>"dropdown-toggle",
                                'data-toggle'=>"dropdown",'role'=>"button",'aria-haspopup'=>"true" ,'aria-expanded'=>"false"]]))
                                ->addChildNode(new Text($item['text']))
                                ->addChildNode((new Span())
                                    ->addClass("caret")
                                )
                            );
                        $subMenu=(new Ul())->addClass("dropdown-menu");
                        foreach($item['subItems']as $subItms){

                            $subLi=(new Li())
                                ->addChildNode((new A())
                                    ->addAttribute('href',$subItms['path'])
                                    ->addChildNode(new Text($subItms['text']))
                                );
                            $subMenu->addChildNode($subLi);
                        }
                        $li->addChildNode($subMenu);
                    }
                    else{
                        $li->addChildNode((new A())
                            ->addAttribute('href',$item['path'])
                            ->addChildNode(new Text($item['text']))
                        );
                    }
                    $this->menu->addChildNode($li);
                }
            }
        }
    }
    public function setMenuSide($side){
        if(!array_key_exists('side',$this->opt))$this->opt['side']=[];
        $this->opt['side']=$side;
        return $this;
    }

    public function addMenuItem($text,$path,$active,$subItems=null){
        if(!array_key_exists('items',$this->opt))$this->opt['items']=[];
        if($subItems==null){
            if($active){
                array_push($this->opt['items'],['text'=>$text,'active'=>true,'path'=>$path]);
            }
            else{
                array_push($this->opt['items'],['text'=>$text,'path'=>$path]);
            }
        }
        else {
            if ($active) {
                array_push($this->opt['items'], ['text' => $text, 'active' => true, 'path' => $path, 'subItems' => $subItems]);
            } else {
                array_push($this->opt['items'], ['text' => $text, 'path' => $path, 'subItems' => $subItems]);
            }
        }
        return $this;
    }

}