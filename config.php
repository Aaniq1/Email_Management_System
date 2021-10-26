<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51JocKUGfeQeGO4uV94dbRMPqC5kPEAoTPJgRiqWv52OjVkTWqzw4jhsglHiXEeFS9fpG1pObrU5fC4by9QMatRn200rwKb47zl";

$secretKey="sk_test_51JocKUGfeQeGO4uVmDwhcZ73SDPP2E4TkSrzD7CUTZRzJhJAyOcHxlmgS4qaFIrNupA8dNaWq1z6xSj25mVL9Q6w009jgXQ6eR";

\Stripe\Stripe::setApiKey($secretKey);
?>