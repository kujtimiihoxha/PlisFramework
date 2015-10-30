<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 11:26
 */

namespace KujtimiiHoxha\Plis\Components\Navigation;


use KujtimiiHoxha\Plis\Core\Html\Img;
use KujtimiiHoxha\Plis\Core\Html\Text;
use KujtimiiHoxha\Plis\Core\Node;

class NavigationBrand extends Node
{
    public function __construct(array $options = null){
        parent::__construct('a',$options);
        $this->addClass('navbar-brand');
        if($options!=null && is_array($options)){
            if(array_key_exists('link',$options)){
                $this->addAttribute('href',$options['link']);
            }
            else{
                $this->addAttribute('href',"#");
            }
            if(array_key_exists('img',$options))
            {
                if(!array_key_exists('width',$options['img']))$options['img']['width']=30;
                if(!array_key_exists('height',$options['img']))$options['img']['height']=30;
                $this->addChildNode(new Img(['attributes'=>['width'=>$options['img']['width'],'height'=>$options['img']['height'],'alt'=>'Brand','src'=>$options['img']['link']]]));
            }
            else if(array_key_exists('title',$options['brand'])){
                $this->addChildNode(new Text($options['title']));
            }
            else{
                $this->addChildNode(new Text('Brand'));

            }
        }
    }
    public function setBrandImage($link,$width,$height){
        $this->addChildNode(new Img(['attributes'=>['width'=>$width,'height'=>$height,'alt'=>'Brand','src'=>$link]]));
        return $this;
    }
    public function setBrandLink($link){
        $this->addAttribute('href',$link);
        return $this;
    }
    public function setTitle($title){
        $this->addChildNode(new Text($title));
        return $this;
    }

}