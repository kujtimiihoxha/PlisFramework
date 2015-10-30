<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:40
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Style extends Node
{
    public function __construct(array $options = null)
    {
        parent::__construct('style', $options);
    }
}