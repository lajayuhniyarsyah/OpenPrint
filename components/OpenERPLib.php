<?php
/* OpenERP PHP connection script. Under GPL V3 , All Rights Are Reserverd , tejas.tank.mca@gmail.com
 *
 * @Author : Tejas L Tank.,             https://twitter.com/snippetbucket
 * @Email : tejas.tank.mca@gmail.com
 * @Country : India
 * @Date : 14 Feb 2011
 * @License : GPL V3
 * @Contact : www.facebook.com/tejaskumar.tank or www.linkedin.com/profile/view?id=48881854
 *
 *
 * OpenERP XML-RPC connections methods are db, common, object , report , wizard
 *
 *
 *
 *
 */
// session_start();

namespace app\components;
use Yii;
use yii\base\Component;

use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;

class OpenERPLib extends Component{

    public $server;
    public $database = "";
    public $uid = "";/**  @uid = once user succesful login then this will asign the user id */
    public $username = ""; /*     * * @userid = general name of user which require to login at openerp server */
    public $password = "";/** @password = password require to login at openerp server * */

    public function login($username, $password, $database=null, $server=null) {
        if($server){
            $this->server = $server;
        }
        if($database){
            $this->database = $database;
        }

        $this->username = $username;
        $this->password = $password;

        $sock = new Client($this->server . 'common');
        $msg = new Request('login');
        $msg->addParam(new Value($this->database, "string"));
        $msg->addParam(new Value($this->username, "string"));
        $msg->addParam(new Value($this->password, "string"));

        $resp = $sock->send($msg);
        if($resp->errno > 0 ){
            //print "Error : ". $resp->errstr;
            return -1;
        }
        //$val = $resp->value();
        //$id = $val->scalarval();
        if ( isset($resp->value()->me['int']) ) {
            $this->uid = $resp->value()->me['int'];
            return $resp->value()->me['int']; //* userid of succesful login person *//
        } else {
            return -1; //** if userid not exists , username or password wrong.. */
        }
    }

    public function search($values, $model_name,$offset=0,$max=40, $order="id DESC") {
        $domains = array();
        $client = new Client($this->server."object");
        $client->return_type = 'phpvals';

        $msg = new Request('execute');

        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("search", "string"));/** method which u like to execute */

        foreach($values as $x){
            if(!empty($x)){
                    array_push( $domains,  new Value( 
                                                        array(  new Value($x[0], "string" ),
                                                                 new Value( $x[1],"string" ),
                                                                 new Value( $x[2], xmlrpc_get_type($x[2]) )
                                                              ),
                                                              "array"
                                                       )
                             );
            }
        }

        $msg->addParam(new Value($domains, "array")); /* SEARCH DOMAIN */
        $msg->addParam(new Value($offset, "int")); /* OFFSET, START FROM */
        $msg->addParam(new Value($max, "int")); /* MAX RECORD LIMITS */
        $msg->addParam(new Value($order, "string"));
        
        $resp = $client->send($msg);
        
        if ($resp->faultCode())
            return -1; /* if the record is not created  */
        else
            return $resp->value();  /* return new generated id of record */
    }

    public function searchread($values, $model_name, $fields=array(), $offset=0, $max=10, $order = "id DESC", $context=array()) {
        $domains = array();
        $client = new Client($this->server."object");
        $client->return_type = 'phpvals';

        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("search", "string"));/** method which u like to execute */

        foreach($values as $x){
            if(!empty($x)){
                    array_push( $domains,  new Value( 
                                                        array(  new Value($x[0], "string" ),
                                                                 new Value( $x[1],"string" ),
                                                                 new Value( $x[2], xmlrpc_get_type($x[2]) )
                                                              ),
                                                              "array"
                                                       )
                             );
            }
        }
        $msg->addParam(new Value($domains, "array")); /* SEARCH DOMAIN */
        $msg->addParam(new Value($offset, "int")); /* OFFSET, START FROM */
        $msg->addParam(new Value($max, "int")); /* MAX RECORD LIMITS */
        $msg->addParam(new Value($order, "string"));
        
        $resp = $client->send($msg);

        if ($resp->faultCode())
            return -1; /* if the record is not created  */
        else
            return $this->read($resp->value(), $fields, $model_name, $context);  /* return new generated id of record */
    }


    public function create($values, $model_name) {

        $client = new Client($this->server."object");
        $client->return_type = 'phpvals';
        //   ['execute','userid','password','module.name',{values....}]
        $nval = array();
        foreach($values as $k=>$v){
            $nval[$k] = new Value( $v, xmlrpc_get_type($v) );
        }
         
        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("create", "string"));/** method which u like to execute */
        $msg->addParam(new Value($nval, "struct"));/** parameters of the methods with values....  */
        
        $resp = $client->send($msg);
        
        if ($resp->faultCode())
            return -1; /* if the record is not created  */
        else
            return $resp->value();  /* return new generated id of record */
    }

    public function write($ids, $values, $model_name) {
        $client = new Client($this->server."object");
        $client->return_type = 'phpvals';
        //   ['execute','userid','password','module.name',{values....}]

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new Value($id, "int");
        $nval = array();
        foreach($values as $k=>$v){
            $nval[$k] = new Value( $v, xmlrpc_get_type($v) );
        }

        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("write", "string"));/** method which u like to execute */
        $msg->addParam(new Value($id_val, "array"));/** ids of record which to be updting..   this array must be Value array */
        $msg->addParam(new Value($nval, "struct"));/** parameters of the methods with values....  */
        $resp = $client->send($msg);
        
        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            return $resp->value();  /* return new generated id of record */
    }

    public function read($ids, $fields, $model_name, $context=array() ) {
        $client = new Client($this->server."object");
        //   ['execute','userid','password','module.name',{values....}]
        $client->return_type = 'phpvals';

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new Value($id, "int");

        $fields_val = array();
        $count = 0;
        foreach ($fields as $field)
            $fields_val[$count++] = new Value($field, "string");

        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("read", "string"));/** method which u like to execute */
        $msg->addParam(new Value($id_val, "array"));/** ids of record which to be updting..   this array must be Value array */
        $msg->addParam(new Value($fields_val, "array"));/** parameters of the methods with values....  */
#        $ctx = array();
#        foreach($context as $k=>$v){
#            $ctx[$k] = new Value( xmlrpc_get_type($v) );
#        }
        if(!empty($context)){
            $msg->addParam(new Value(array("lang" => new Value("nl_NL", "string"),'pricelist'=>new Value($context['pricelist'], xmlrpc_get_type($context['pricelist']) )) , "struct"));
        }

        $resp = $client->send($msg);
        ///print_r($resp);
        // var_dump($resp);
        
        if ($resp->faultCode()){
            // throw new \yii\web\NotFoundHttpException("Not Found");
            // return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        }
        else{
            return $resp->value();
        }
    }

    public function unlink($ids , $model_name) {
        
        $client = new Client($this->server."object");
      
        $client->return_type = 'phpvals';

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new Value($id, "int");

        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("unlink", "string"));/** method which u like to execute */
        $msg->addParam(new Value($id_val, "array"));/** ids of record which to be updting..   this array must be Value array */
//        $msg->addParam(new Value($fields_val, "array"));/** parameters of the methods with values....  */
        $resp = $client->send($msg);

        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            //print_r( $resp->value() );
            return ( $resp->value() );
    }


    public function price_get($ids, $product_id, $qty, $partner_id) {
        $client = new Client($this->server."object");
        //   ['execute','userid','password','module.name',{values....}]
        $client->return_type = 'phpvals';

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new Value($id, "int");

        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value('product.pricelist', "string"));/** model name where operation will held * */
        $msg->addParam(new Value("price_get", "string"));/** method which u like to execute */
        $msg->addParam(new Value($id_val, "array"));/** ids of record which to be updting..   this array must be Value array */
        $msg->addParam(new Value($product_id, "int"));
        $msg->addParam(new Value($qty, xmlrpc_get_type($qty)  ));
        $msg->addParam(new Value($partner_id, "int"));

        $resp = $client->send($msg);
        //print_r($resp);
        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            return $resp->value();
    }
    public function get_fields($model){
        $client = new Client($this->server."object");
        $client->return_type = 'phpvals';
        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("fields_get", "string"));/** method which u like to execute */
        $resp = $client->send($msg);
        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            return $resp->value();
    }
    public function get_default_values($model){
        $values = $this->get_fields($model);

        $columns = array_keys($values);
        $array_temp = array();
        foreach($columns as $column){
            array_push($array_temp, new Value($column,"string"));
        }
         
        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model, "string"));/** model name where operation will held * */
        $msg->addParam(new Value("default_get", "string"));/** method which u like to execute */
        $msg->addParam(new Value($array_temp, "array"));
        
        $resp = $client->send($msg);
        print_r($resp);
        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            return $resp->value();
    }
    
    public function button_click($model, $method, $record_ids){
        $client = new Client($this->server."object");
        $client->setSSLVerifyPeer(0);
        $client->return_type = 'phpvals';
        //   ['execute','userid','password','module.name',{values....}]
        $nval = array();
        
        $msg = new Request('execute');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model, "string"));/** model name where operation will held * */
        $msg->addParam(new Value($method, "string"));/** method which u like to execute */
        $msg->addParam(new Value($record_id, "int"));/** parameters of the methods with values....  */
        
        $resp = $client->send($msg);
        
        if ($resp->faultCode())
            return -1; /* if the record is not created  */
        else
            return $resp->value();  /* return new generated id of record */
    }
    
    public function workflow($model, $method, $record_id) {
        $client = new Client($this->server."object");
        $client->setSSLVerifyPeer(0);
        $client->return_type = 'phpvals';
        
        $msg = new Request('exec_workflow');
        $msg->addParam(new Value($this->database, "string"));  //* database name */
        $msg->addParam(new Value($this->uid, "int")); /* useid */
        $msg->addParam(new Value($this->password, "string"));/** password */
        $msg->addParam(new Value($model, "string"));/** model name where operation will held * */
        $msg->addParam(new Value($method, "string"));/** method which u like to execute */
        $msg->addParam(new Value($record_id, "int"));/** parameters of the methods with values....  */
        
        $resp = $client->send($msg);
        if ($resp->faultCode())
            return -1; /* if the record is not created  */
        else
            return $resp->value();  /* return new generated id of record */
    }
}

?>
