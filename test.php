<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 11/04/2014
 * Time: 16:11
 */

require 'vendor/autoload.php';

use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Client as sClient;
use Guzzle\Http\Client;


/*$client = new sClient();
$description = ServiceDescription::factory('./services/OrganizationService.json');
$client->setDescription($description);

$command = $client->getCommand('GetOrganizations', array('authtoken' => '3fef0d268cc77ba49aea9c8fe6e4060d'));

$responseModel = $client->execute($command);
var_dump($responseModel);*/

//3fef0d268cc77ba49aea9c8fe6e4060d
//35702016


$client = sClient::factory(array('debug' => true, 'exceptions' => false));

$description = ServiceDescription::factory('./services/contacts/ContactsService.json');
$client->setDescription($description);

//$command = $client->getCommand('GetContacts', array('authtoken' => '3fef0d268cc77ba49aea9c8fe6e4060d', 'organization_id' => '35702016'));
//$command = $client->getCommand('getTax', array('authtoken' => '3fef0d268cc77ba49aea9c8fe6e4060d', 'organization_id' => '35702016', 'tax_id' => '494047000000030045'));



$command = $client->getCommand('createContact',
    array(
        'authtoken' => '3fef0d268cc77ba49aea9c8fe6e4060d',
        'organization_id' => '35702016',
        'contact_name' => 'Joffrey Baratheon',
        'blrr' => 'bnbnb'
        /*,
        'billing_address' => (object) array(
            'city' => 'king\'s landing',
            'country' => 'the eyrie'
        ),
        'shipping_address' => (object) array(
            'city' => 'king\'s landing',
            'country' => 'the eyrie'
        )*/
    )
);
/*$request = $command->prepare();
var_dump($request->getCurlOptions( ));
var_dump($request->getQuery());
var_dump($request->getResource());
var_dump($request->getParams());
var_dump($request->getResponseBody());
//$command = $client->getCommand('getContacts', array('authtoken' => '3fef0d268cc77ba49aea9c8fe6e4060d', 'organization_id' => '35702016'));
var_dump($request->send());*/

//$responseModel = $client->execute($command);
//var_dump($responseModel);


$c = new Client();
$request = $c->get('http://localhost:3000/api/v3/contacts',array(), array('debug' => true, 'exceptions' => false));
$response = $request->send();
var_dump($response->getBody(true));