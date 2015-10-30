<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:30
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Text extends Node
{
    public function __construct($text){
        $options=[];
        $options[0]=$text;
        parent::__construct(null,$options);
    }

}