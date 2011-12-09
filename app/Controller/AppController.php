<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/Controller/AppController.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
    public $components = array(
        'Session',
        'Auth' => array(
            'authError' => "Necesitas iniciar Sesión para acceder.",
            'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'welcome'),
            'authorize' => array('Controller')
        )
    );
    
    public function beforeFilter() {
        $this->Auth->allow('display');
        $this->set('authUser', $this->Auth->user());
    }
    
    public function beforeRender()
    {
        // only compile it on development mode
        if (Configure::read('debug') > 0) {
            // import the file to application
            App::import('Vendor', 'lessc');
 
            if (defined('WEBROOT_DIR')) {
                $css_array = array('bootstrap', 'main');
		for ($i = 0; $i < count($css_array); $i++) {
                    // set the LESS file location
                    $less = ROOT . DS . WEBROOT_DIR . DS . 'less' . DS . $css_array[$i] .'.less';
 
                    // set the CSS file to be written
                    $css = ROOT . DS . WEBROOT_DIR . DS . 'css' . DS . $css_array[$i] . '.css';
 
                    // compile the file
                    lessc::ccompile($less, $css);  
                }
            }
        }
        parent::beforeRender();
    }
    
    /*
     * Revisa si el usuario es administrador.
     */
    public function isAdmin($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }
    
    /*
     * 
     */
    public function isAuthorized($user) {
        if(isset($user)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**** Alert Messages ****/
    public function alert($message, $type = 'warning', $key = null) {
        $this->Session->setFlash($message,'alert', array('type' => $type));
    }
    
    public function error($message) {
        $this->alert($message, 'error');
    }
    
    public function success($message) {
        $this->alert($message, 'success');
    }
    
    public function warning($message) {
        $this->alert($message, 'warning');
    }
    
    public function info($message) {
        $this->alert($message, 'info');
    }
}
