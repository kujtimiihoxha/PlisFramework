<?php
/**
 * author: Kujtim Hoxha
 */

namespace KujtimiiHoxha\Plis\Core;
use DOMDocument;
use DOMNode;
use Exception;

class Node
{
    /**
     * @var array
     */
    private $options;
    /**
     * @var DOMNode
     */
    private $node;
    /**
     * @var string
     */
    private $tag;
    /**
     * @var string
     */
    private $id;
    /**
     * @var DOMDocument;
     */
    private $document;
    /**
     * @param $tag
     * @param array|null $options
     */
    public function __construct($tag,array $options=null){
        $this->options=[];
        $this->tag=$tag;
        $this->document=new DOMDocument();
        $this->decodeOptions($options);

        if($this->tag==null){
            if(array_key_exists('htmlCode',$options)){
                $this->tag='div';
                $this->createNodeFromHtml();
            }
            else $this->createTextNode();
        }
        else {
            $this->createNode();
        }

    }
    public function construct(){
        if(!$this->tag==null){
            $this->addAttribute('id',$this->id);
            if (array_key_exists('attributes', $this->options)) {
                foreach ($this->options['attributes'] as $key => $value) {
                    $this->addAttribute($key,$value);
                }
            }
            if (array_key_exists('children', $this->options)) {
                foreach ($this->options['children'] as $child) {

                    $subNode=$this->document->importNode($child,true);
                    $this->node->appendChild($subNode);
                }
            }
        }
        return $this;
    }
    public function addAttribute($key,$value){
        $attribute=$this->document->createAttribute($key);
        $attribute->value=$value;
        $this->node->appendChild($attribute);
        return $this;
    }
    public function addClass($value){
        $this->addAttribute('class',$value);
        return $this;
    }
    private function createNode(){
        $this->node=$this->document->createElement($this->tag);
    }
    public function setId($id){
        $this->id=$id;
        return $this;
    }
    private function createTextNode(){
        $this->node=$this->document->createTextNode($this->options[0]);
    }
    private function createNodeFromHtml()
    {
        $html = '<div id="html-to-dom-input-wrapper">' . $this->options['htmlCode'] . '</div>';
        $docWithNodes = DOMDocument::loadHTML($html);
        $child_array = array();
        try {
            $children = $docWithNodes->getElementById('html-to-dom-input-wrapper')->childNodes;
            foreach($children as $child) {
                $child =$this->document->importNode($child, true);
                array_push($child_array, $child);
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage(), 0);
        }
        if(count($child_array)>1){
            $this->createNode();
            foreach( $child_array as $child){
                if(array_key_exists('children',$this->options)){
                    array_push( $this->options["children"],$child);
                }
                else{
                    $this->options["children"]=[];
                    array_push( $this->options["children"],$child);
                }
            }
        }
        else{
            $this->node=$child_array[0];
        }
    }
    public function insert(){
        $this->document->appendChild($this->node);
        return $this->document->saveHTML();
    }
    public function getNode(){
        return $this->node;
    }
    private function decodeOptions($options)
    {
        if($options==null)$options=[];
        if(array_key_exists('htmlCode',$options)){
            $this->options['htmlCode']=$options['htmlCode'];
        }
        else if($this->tag==null){
            $this->options[0]=$options[0];
        }
        else {
            if (array_key_exists('id', $options)) $this->id = $options['id'];
            else $this->id = $this->gen_uuid();
            if (array_key_exists('attributes', $options))$this->options['attributes']=$options['attributes'];
            if (array_key_exists('removeAttributes', $options)) $this->removeAttributes($options['removeAttributes']);
            if (array_key_exists('children', $options)) foreach ($options['children'] as $child) {
                $this->addChildNode($child);
            }
            if (array_key_exists('prependChildren', $options)) foreach ($options['prependChildren'] as $child) {
                $this->prependChildNode($child);
            }
        }

    }
    public function removeAttributes(array $attributesToBeRemoved){
        foreach($attributesToBeRemoved as $key=>$value){
            if(array_key_exists('attributes',$this->options)){
                $keyExists=false;
                foreach($this->options['attributes']as $existingKey=>$existingValue){
                    if($key==$existingKey)$keyExists=true;
                }
                if($keyExists){
                    $existingValue=$this->options['attributes'][$key];
                    $existingValueArray=explode(" ",$existingValue);
                    $newValue='';
                    foreach($existingValueArray as $attr){
                        if($attr!=$value){
                            $newValue.=" ".$attr;
                        }
                    }
                    $newValue=$existingValue." ".$value;
                    $this->options['attributes'][$key]=$newValue;
                }
            }
        }
    }
    /**
     * @param Node $child
     * @return $this
     */
    public function prependChildNode(Node $child){
        if(array_key_exists('children',$this->options)){
            array_unshift( self::$options["children"],$child->construct()->getNode());
        }
        else{
            $this->options["children"]=[];
            array_unshift( $this->options["children"],$child->construct()->getNode());
        }
        return $this;
    }

    /**
     * @param Node $child
     * @return $this
     */
    public function addChildNode(Node $child){
        if(array_key_exists('children',$this->options)){
            array_push( $this->options["children"],$child->construct()->getNode());
        }
        else{
            $this->options["children"]=[];
            array_push( $this->options["children"],$child->construct()->getNode());
        }
        return $this;
    }

    protected function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }


}