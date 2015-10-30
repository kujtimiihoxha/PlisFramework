<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 13:16
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Nav extends Node
{
    public function __construct(array $options = null)
    {
        parent::__construct('nav', $options);
    }
}