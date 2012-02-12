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
    //public $helpers = array('Crumb');
    /*
     * Array que contiene los componentes que necesita el controlador, en este caso, los componentes
     * que necesita la clase base AppController.
     */
    public $components = array(
        'Session',
        'Auth' => array(
            'authError' => "No tienes los suficientes privilegios para esta acción.",
            'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'welcome'),
            'authorize' => array('Controller')
        )
    );
    
    //public $helpers = array('Crumb');
    
    /**
     * Función llamada antes de ejecutar cada acción del controlador.
     */
    public function beforeFilter() {
        $this->Auth->allow('display');
        if ($this->request['controller'] === 'pages') {
            $this->layout = 'pages';
        }
        //pr($this->Auth->user());
        $this->set('authUser', $this->Auth->user());
        //$this->set('isAdmin', $this->Auth->user('role') === 'admin');
        $this->set('isAdmin', $this->isAdmin());
    }
    
    /**
     * Función llamada después de que cada acción del controlador ha sido ejecutada,
     * pero antes de renderizar su vista.
     */
    public function beforeRender()
    {
        // Sólo compila si no es un entorno de producción.
        if (Configure::read('debug') > 0) {
            // Importa los modulos necesarios.
            App::import('Vendor', 'lessc');
 
            if (defined('WEBROOT_DIR')) {
                // Array de los archivos less.
                $css_array = array('bootstrap', 'responsive', 'main');
                
		for ($i = 0; $i < count($css_array); $i++) {
                    // Establece el directorio donde está el archivo LESS.
                    $less = ROOT . DS . WEBROOT_DIR . DS . 'less' . DS . $css_array[$i] .'.less';
 
                    // Establece dónde se guardará el CSS compilado.
                    $css = ROOT . DS . WEBROOT_DIR . DS . 'css' . DS . $css_array[$i] . '.css';
 
                    // Compila el archivo LESS
                    lessc::ccompile($less, $css);  
                }
            }
        }
        
        // Llama a la función de la clase padre 'Controller'.
        parent::beforeRender();
    }
    
    /*
     * Revisa si el usuario tiene como rol 'Administrador'.
     */
    public function isAdmin($user = null) {
        if ($user === null) {
            $user = $this->Auth->user();
        }
        if (isset($user['role']) && $user['role'] == 'admin') {
            return true;
        }
        return false;
    }
    
    /* 
     * Revisa si el User ha iniciado sesión.
     */
    public function isAuthorized($user) {
        /*if(isset($user)) {
            return true;
        } else {
            return false;
        }*/
        return isset($user);
    }
    
    /*
     * Mensajes Flash.
     */
    public function alert($message, $type = 'warning', $key = null) {
        $this->Session->setFlash($message, 'alert', array('type' => 'alert-' . $type));
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
