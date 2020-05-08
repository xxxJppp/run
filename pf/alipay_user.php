<?php
$cope = $_GET['code'];

require_once 'aop/AopClient.php';
$merchant_private_key = 'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCea2tbcv/wPguRi6LpQKbQYq9GGQBLD//vv4hw1VQNh1DBOQvy/Dpo0RDYrcGygsFa03KHW7pdg3nGJpn2bT21xKLeiQP5jvRfJ46T5WoKwQYG3yLguZlog6+J1kuo2dvAT7ma5V+D8pYAFrEbzaAd4DIg48ypdYo3HW0qstN36AY0UnNTms47TayZEHd1+i1eQg+TZ9u4wip9BE4usmD92Isc49FrT3Hd+4ltC7xmsvMpijCujh1aYWEjjUr9s22HFOBO1nD2XCxe8zR2eqRDLXDE7epbi1jqQYD0Hhh7QvShOHiFpK114w4XlgkwHqUDvVu1jiNUC6VgoWqnzMzRAgMBAAECggEAG4P+3qBn0duE+N+vCSKAlts9JEi9Y0xBIOw8j5SOB9eD8DuvVqH2pzQA4BG1/gJ2AQeO8fG9ufZXFVKpFUM+H68qtspHlXX9/fUJ76g+NeX23QSusyepfJy6xY8iDw7f+1QdocjLQUjGQveuBW0+rVG+gzXt21UeD5qd1ne/ASlWsH0yRZn48BtTnxWr0xYJ09/sOEakwIE+ws05cwBxzBparni9Q46z04qBuvnxWdfLVwhqpJmY8+DXEzXQ0/iHtuYTsLh1TJQmnP5t0FlrAT7AcFD7yjKWGwPHDVExOAar0VN+XNymwl2yuqkzXmsUpcIvJZzpy7GnC1c8hU+oEQKBgQDVL7LsgfR6vjHUBgkSG6PD5uOmH2ay9EGjJd0aur7wAG9sKOgUNyT4+0XAkFF4dp04qsrDn8f/oWgNkof39GM0/BZayGZJiCEYUFd/ZUPnjqE7Tk832V1jlHsofDW4c7yp8Fd2er2PoyXHgAhzvPAALdkKbgZoDMpnShiVh1EevQKBgQC+PBASAxlZREs85DuHbiGs9bLtDuqfvBGJQEJLn87mcO/LQBn4nWVXcB4hcC1h92QIj4fQ+p4jt3ME5X6WfNt2J687ct5l4jMuHo1uQJJlp8Gsha2yDf1IqxSs9cEkHKrXS+SuSHTsJKLwLbfdHFEkPj9s4PnVwe0MDHPrlO5BpQKBgQChgQZKuFTvXAFBv+TFTB0vv049PtK9xd+n6npr0ofuKFZBGWhgUDp5SVrZfDvMSAfpszHzK6wHVE8Q4S6SwRkbPdLtqZ4cHL39vnfa8muUE/C/jh7jj495bjYzQI4uE7gdAhAwmOHc3Fs1nSBKFhu39wPTK/E8iFwaDf874Iyq/QKBgQCgE1SGg5sR9ZjF/VtmQ7MMopdUSUf+77dl4e+nSStF1+TACAmSnYdIQ2znQEi/9fd0CKsFm830Sgr8JM0XfqsBSrV2ddtUqjnc5hKmoqlN5xLexIH7oS/vtR4pyIYkiAbuMcuVKB1TFCUTq7Ta11gkAklGqi0wxQVeLSBiLSkrjQKBgQCWq0kRlCTOSmbJrhYQZoUDVyZNH9otIAiYHy25zr+uYKDNDTT6r9pAvU+qq/+8kJlXSpkZIC5MeV58mrbKqNN+LxxojSyPC1czsuhWYIH7nBFw1jlXTVm4zba770FB/OvRqeiX7OFNBguO+gf14SMiJTEB+/d18DKyNWPyRnAfQQ==';
if(strpos($merchant_private_key,'PRIVATE') === false){ 
  	$merchant_private_key = "-----BEGIN PRIVATE KEY-----\n" .
            wordwrap($merchant_private_key, 64, "\n", true) .
            "\n-----END PRIVATE KEY-----";
}

$aop = new AopClient ();
$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
$aop->appId = '2019051064472036';
$aop->rsaPrivateKey = $merchant_private_key;
$aop->alipayrsaPublicKey= 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAk7pSZ8xF48Z+ui/Gdz3MW52vLZhE404wQ8ZrgKxgkIBZfqqgzU2h56FMR8EP5ZGhmSo9bZ4454yOFLzIUyiOrgXxGdj346R95Xo+wnJw7gZD0rO75ivf4u8LZBIuiu5pTO9bEDTAOLsJYq0Ssf2GNceCgrpaQTVNTdR1dbRIyPvj9AlJqe016lsCqR6M9LHwI7oLK0q80TuTtFEvOmM3TcnyuVoLWH2UJiw78e7A/rCuVjyuTZWLWNHrs4pVZ+MfSM1mKc96VZs4dgwCDmrPe4wI38CUvKUSrA5DbNQXWqPN3OY3UjbTu5WB5jr1lgkNNdWlsRrkvvD93f0rRxXzTwIDAQAB';
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset='UTF-8';
$aop->format='json';

require_once 'aop/request/AlipaySystemOauthTokenRequest.php';
$request = new AlipaySystemOauthTokenRequest ();
$request->setCode($cope);
$request->setGrantType('authorization_code');
$result = $aop->execute ( $request);

$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
$user_id = $result->$responseNode->user_id;

echo $user_id;
?>