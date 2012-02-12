<?php

/**
 * Issuu Client API for PHP
 *  Owner: atinypixel
 * https://gist.github.com/749091
 */


class IssuuComponent extends Component {
    /**
     * Nombre de la acción a realizar.
     * @var string 
     */
    private $_actionName;
    
    /**
     *Los datos para la acción
     * @var array 
     */
    private $_data;
    
    /**
     * String de los datos que se pasara como parámetro HTTP
     * @var string 
     */
    private $_dataString;
    
    /**
     * Respuesta de la API de issuu
     * @var response object 
     */
    private $_response;
    
    
    private $_file;
    /**
     * 
     * @var type 
     */
    private $_responseType;
    
    /**
     * Key de la API pública
     * @var string 
     */
    private $_publicApiKey;
    
    /**
     * Key de la API privada.
     * @var string 
     */
    private $_privateApiKey;
    
    /**
     * Url de la API de issuu
     * @var string 
     */
    public $apiAddress = null;
    
    /**
     * Component Contruct
     * 
     * @param string $apiAddress
     * @return void 
     */
    public function initialize($controller) {
        $this->_publicApiKey = "5h2jdh47dz9y4ddj5wckuv4g1qipbn5p";
        $this->_privateApiKey = "qp7dsg1p6so5xlr3imh8sxgy5rh5bhaz";
        //$this->_apiAddress = $apiAddress;
    }
    
    /**
     * Inicia una acción y prepara para recibir los parametros.
     * 
     * @param string $actionName
     * @return void 
     */
    public function openAction($actionName) {
        $this->closeAction();
        $this->_actionName = $actionName;
        $this->_data = array();
    }
    
    /**
     * Ejecuta la acción
     * 
     * @return void 
     */
    public function executeAction() {
        $this->prepareData();
        $this->sendData();
        
    }
    
    /**
     * Reinicia la acción actual y todos sus datos
     * 
     * @return void 
     */
    public function closeAction() {
        $this->_data = null;
        $this->_dataString = null;
        $this->_actionName = null;
        $this->_response = null;
    }
    
    /**
     * Retorna todos los datos de la acción como string
     * @return string 
     */
    public function getActionData() {
        $data = new stdClass();
        $data->data = $this->_data;
        $data->dataString = $this->_dataString;
        $data->response = $this->_response;
        $data->name = $this->_actionName;
        return $data->dataString;
    }
    
    /**
     * Retorna el valor de un parámetro de la acción.
     * 
     * @param string $key
     * @return mixed
     * @throws Exception 
     */
    /*public function __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        } else {
            throw new Exception('Value with key ' . $key . ' is not available.');
        }
    }*/
    
    /**
     * Establece un valor para un parámetro de la acción.
     * 
     * @param string $name
     * @param mixed $value
     * @return void 
     */
    /*public function __set($name, $value) {
        $this->_data[$name] = $value;
    }*/
    
    public function setFile($file) {
        $this->_file = $file;
    }
    
    /**
     * Retorna la respuesta de issuu
     * 
     * @return object 
     */
    public function getResponse() {
        return $this->_response;
    }
    
    /**
     * Prepara los datos de la acción.
     * 
     * @return void 
     */
    protected function prepareData() {
        $this->_data['apiKey'] = $this->_publicApiKey;
        $this->_data['action'] = $this->_actionName;
        $this->_data['name'] = $this->_file['name'];
        $this->_data['format'] = 'json';
        //$fileName = $this->_file['tmp_name'];
        //$this->_data['file'] = "@$fileName";
        $this->_data['responseParams'] = 'title,documentId';
        //debug($this->_data); die;
        ksort($this->_data);
        $signature = (string)$this->_privateApiKey;
        foreach($this->_data as $k => $v){
            $this->_dataString[] = $k . '=' . $v;
            $signature .= $k . $v;
        }
        $this->_data['signature'] = md5($signature);
        $fileName = $this->_file['tmp_name'];
        $this->_data['file'] = "@$fileName";
        $this->_dataString[] = 'signature' . '=' . $this->_data['signature'];
        //debug($this->_dataString); die;
        $this->_dataString .= implode('&', $this->_dataString);
        //debug($this->_dataString); die;
        $this->_dataString = preg_replace('{Array}', '', $this->_dataString);
        //return $this->_dataString;
        //debug($this->_dataString); die;
    }
    
    /**
     * Envía los datos a issuu y maneja la respuesta.
     * 
     * @return void
     */
    protected function sendData() {
        //debug($this->_dataString); die;
        $ch = curl_init();
        //debug($ch); die;
        curl_setopt($ch, CURLOPT_URL, $this->apiAddress);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //debug($this->_data) ; die;
        $this->prepareReceivedData(curl_exec($ch));
        //die;
    }
    
    /**
     * Transforma la respuesta json de issuu en un objeto.
     * 
     * @param string json object
     * @return void 
     */
    protected function prepareReceivedData($jsonData) {
        //debug($jsonData); die;
        $this->_response = json_decode($jsonData, true);
    }
}
?>
