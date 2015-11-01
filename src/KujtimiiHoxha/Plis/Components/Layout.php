<?php
/**
 * Created by PhpStorm.
 * User: kujti
 * Date: 10/29/2015
 * Time: 19:40
 */

namespace KujtimiiHoxha\Plis\Components;




use KujtimiiHoxha\Plis\Core\Html\Html;
use KujtimiiHoxha\Plis\Core\Html\Link;
use KujtimiiHoxha\Plis\Core\Html\Script;

class Layout extends Html
{


    public function __construct(array $options=null){
        if($options==null)$options=[];
        if(!array_key_exists('html',$options))$options['html']=null;
        parent::__construct($options['html']);
    }
    public function construct(){
        $config=include(dirname(__DIR__).'/config.php');
        foreach($config['css'] as $styleSheet){
            $this->addStyleSheet($styleSheet);
        }
        foreach($config['js'] as $script){
            $this->addScript($script);
        }
        return parent::construct();
    }
    public function addStyleSheet($path){
        $link=new Link();
        $link->addAttribute('rel',"stylesheet")->addAttribute('type',"text/css")->addAttribute('href',$path);
        array_push($this->head->styleSheets,$link);

    }
    public function addScript($path){
        $script=new Script();
        $script->addAttribute('type',"text/javascript")->addAttribute('src',$path);
        array_push($this->body->scripts,$script);
    }
}