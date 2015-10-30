<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 11:18
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class H1 extends Node
{
    private $text;
    public function __construct(array $options = null)
    {
        if($options!=null)if(is_array($options))if(array_key_exists('text',$options)) $this->text=$options['text'];
        parent::__construct('h1', $options);
    }
    public function construct(){
        if($this->text!=null)$this->addChildNode(new Text($this->text));
        return parent::construct();
    }
    public function  setText($text){
        $this->text=$text;
        return $this;
    }
}