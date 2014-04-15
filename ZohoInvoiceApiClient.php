<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 15/04/2014
 * Time: 15:08
 */
namespace Kairos\ZohoInvoiceApi;

use Guzzle\Common\Collection;
use Guzzle\Http\Message\Request;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class ZohoInvoiceApiClient extends Client
{
    public static function factory($config = array())
    {
        $default = array(
            'ssl' => true
        );

        $required = array('service_definition', 'authtoken', 'organization_id', 'ssl');

        $config = Collection::fromConfig($config, $default, $required);

        $baseUrl = 'https://invoice.zoho.com';
        $client = new self($baseUrl, $config);


        $filePath = __DIR__ . '/Services/' . $config->get('service_definition') .".json";

        //check if service definition exists
        if(!file_exists($filePath))
            throw new \Exception("Service not found exception, couldn't find service " . $config->get('service_definition'));

        $description = ServiceDescription::factory($filePath);
        $client->setDescription($description);

        if (true === isset($config['authtoken'])) {
            $client->getEventDispatcher()->addListener('command.before_prepare', function (\Guzzle\Common\Event $e) use($config) {
                    if (false === $e['command']->hasKey('authtoken')) {
                        $e['command']->set('authtoken', $config['authtoken']);
                    }
                })
            ;
        }

        if (true === isset($config['organization_id'])) {
            $client->getEventDispatcher()->addListener('command.before_prepare', function (\Guzzle\Common\Event $e) use($config) {
                    if (false === $e['command']->hasKey('organization_id')) {
                        $e['command']->set('organization_id', $config['organization_id']);
                    }
                })
            ;
        }

        return $client;
    }

    /**
     * Get right service
     *
     * @param $service
     * @param array $config
     * @return ZohoInvoiceApiClient
     */
    public static function getService($service, $config = array()) {
        return self::factory(array_merge($config, array('service_definition' => $service)));
    }
}