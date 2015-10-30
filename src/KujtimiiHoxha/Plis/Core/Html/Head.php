<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:30
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Head extends Node
{
    public $styleSheets;
    public function __construct(array $options=null){
        $this->styleSheets=[];
        parent::__construct('head',$options);
    }
    public function construct(){
        foreach($this->styleSheets as $sheets){
            $this->addChildNode($sheets);
        }
        return parent::construct();
    }
}