<?php
  //BY: BRAYAN VILLA
  //01/05/23 11:33 a.m
  //You need use ideviceactivation 
  
  $activation = $_POST['activation-info'];
	
  $encodedrequest = new DOMDocument;
  $encodedrequest->loadXML($activation);

  $decodedrequest = new DOMDocument;
  $decodedrequest->loadXML(base64_decode($encodedrequest->getElementsByTagName('data')->item(0)->nodeValue));
  $nodes = $decodedrequest->getElementsByTagName('dict')->item(0)->getElementsByTagName('*');

  for ($i = 0; $i < $nodes->length - 1; $i=$i+2) 
  {
    switch ($nodes->item($i)->nodeValue) 
    {
      case "UniqueChipID": 
        $ucid = $nodes->item($i + 1)->nodeValue; 
        break;
    }
  }

  if(!file_exists("TokensGenerated")){
    mkdir("TokensGenerated", 0777, true);
  }
  if(!file_exists("TokensGenerated/".$ucid)){
    mkdir("TokensGenerated/".$ucid, 0777, true);
  }

  file_put_contents("TokensGenerated/".$ucid."/".$ucid."-act-req.token", $activation);

  die();
 ?>
