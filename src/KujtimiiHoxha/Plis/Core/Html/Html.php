<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:30
 */

namespace KujtimiiHoxha\Plis\Core\Html;


use KujtimiiHoxha\Plis\Core\Node;

class Html extends Node
{
    /**
     * @var Node
     */
    public $head;
    /**
     * @var Node
     */
    public $body;
    /**
     * @var Node
     */
    public $footer;

    /**
     * @param array|null $options
     */
    public function __construct(array $options=null){
        if($options==null)$options=[];
        if(!array_key_exists('head',$options))$options['head']=null;
        if(!array_key_exists('body',$options))$options['body']=null;
        if(!array_key_exists('footer',$options))$options['footer']=null;
        $this->head=new Head($options['head']);
        $this->body=new Body($options['body']);
        $this->footer=new Footer($options['footer']);
        parent::__construct('html',$options);
    }
    public function construct(){
        $this->addChildNode($this->head)->addChildNode($this->body)->addChildNode($this->footer);
        parent::construct();
        return $this;
    }
}