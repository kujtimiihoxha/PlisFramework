<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:30
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Footer extends Node
{
    public function __construct(array $options=null){
        parent::__construct('footer',$options);
    }
}