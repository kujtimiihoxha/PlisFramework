<?php
use KujtimiiHoxha\Plis\Components\Layout;
require_once "../../../vendor/autoload.php";

$layout=new Layout();
$layout->body
    ->addAjaxLoading()
    ->addNavigation((new \KujtimiiHoxha\Plis\Components\Navigation())
//                                ->setBrandImage('http://digitalconfederacy.com/images/Articles/Urrday/GGInter/s/s.png',30,30)
                                ->setBrandTitle("Plis")
                                ->addMenuItem("Welcome",'#/',true,[['text'=>'hello','path'=>'#']])
                                ->addMenuItem("About",'#/about')
                                ->addMenuItem("Contact",'#/contact')
                                ->setMenuSide('right')
                                ->setColors('#006064')
                                )
    ->addContent((new \KujtimiiHoxha\Plis\Core\Html\Div())->addClass('row')
        ->addChildNode((new \KujtimiiHoxha\Plis\Core\Html\Div())->addChildNode((new \KujtimiiHoxha\Plis\Core\Html\H1())->setText('Hello'))->addClass('col-md-6'))
        ->addChildNode((new \KujtimiiHoxha\Plis\Core\Html\Div())->addChildNode((new \KujtimiiHoxha\Plis\Core\Html\H1())->setText('Hi'))->addClass('col-md-6'))
    );
echo $layout->construct()->insert();