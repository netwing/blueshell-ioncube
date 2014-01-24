<?php

// Configuration parameters
$url      = 'http://bs21.ispeed.local/app/soap.php'; // You can use http or https
$username = "admin";
$password = "password";

ini_set("soap.wsdl_cache_ttl", '0');
ini_set("soap.wsdl_cache_enabled", '0');

// Get client
$client = new SoapClient($url);
// Try to login if not logged in
if (!$client->loggedIn()) {
    try {
        $login = $client->login($username, $password);
        echo "Login successful" . PHP_EOL;
    } catch (SoapFault $e) {
        echo $e->faultcode . PHP_EOL;
        echo $e->faultstring . PHP_EOL;
        exit;
    }
}

print_r(get_class_methods(get_class($client)));
print_r($client->__getFunctions());
print_r($client->index());
exit;

// Get a client
try {
    echo "This is our first customer:" . PHP_EOL;
    $customer = $client->get(1);
    print_r($customer);
} catch (SoapFault $e) {
    echo $e->faultcode . PHP_EOL;
    echo $e->faultstring . PHP_EOL;
}

// Get total customer and first 10 customers
try {
    $count = $client->count();
    echo "We have " . $count . " total customers." . PHP_EOL;
    $limit = 2;
    $offset = 0;
    $customer = $client->getList($limit, $offset);
    echo "This are our first " . $limit . " customers:" . PHP_EOL;
    print_r($customer);
} catch (SoapFault $e) {
    echo $e->faultcode . PHP_EOL;
    echo $e->faultstring . PHP_EOL;
}

// Get client vectors
try {
    echo "Client 1 has the following vectors:" . PHP_EOL;
    $vectors = $client->getVectors(1);
    print_r($vectors);
} catch (SoapFault $e) {
    echo $e->faultcode . PHP_EOL;
    echo $e->faultstring . PHP_EOL;
}



// Create a new client
/*
try {
    // This field are mandatory, if you omit one of them, the response will be a SoapFault exception
    $my = array(
        "cliente_nominativo" => "New client name",
        "cliente_telefono1"  => "1234567890",
    );
    $customer = $client->create($my);
    print_r($customer);
} catch (SoapFault $e) {
    echo $e->faultcode . PHP_EOL;
    echo $e->faultstring . PHP_EOL;
}
*/
