<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 20:45
 */

namespace KujtimiiHoxha\Plis\Core;


class PureHtml extends Node
{
    public function __construct($htmlCode){
        $options=[];
        $options['htmlCode']=$htmlCode;
        parent::__construct(null,$options);
    }

}