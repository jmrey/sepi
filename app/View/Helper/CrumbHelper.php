<?php


App::uses('AppHelper', 'View/Helper');

class CrumbHelper extends AppHelper {
    public $helpers = array('Html');
    
    protected $_crumbs = array();
    
    public function add($name, $link = null, $options = null) {
        $this->_crumbs[] = array($name, $link, $options);
    }
    
    public function getList($options = array()) {
        if (!empty($this->_crumbs)) {
            $result = '';
            $length = count($this->_crumbs);
            $ulOptions = $options;
            $separatorTag = $this->Html->tag('span', '/', array('class' => 'divider'));
            foreach ($this->_crumbs as $which => $crumb) {
                $options = array();
                if (empty($crumb[1])) {
                    $elementContent = $crumb[0];
                } else {
                    $elementContent = $this->Html->link($crumb[0], $crumb[1], $crumb[2]);
                }
                $result .= $this->Html->tag('li', $elementContent . $separatorTag, $options);
            }
            return $this->Html->tag('ul', $result, $ulOptions);
        } else {
            return null;
        }
    }
}

?>
