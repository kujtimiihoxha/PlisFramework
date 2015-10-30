<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/30/2015
 * Time: 12:44
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Span extends Node
{
    public function __construct(array $options = null)
    {
        parent::__construct('span', $options);
    }
}