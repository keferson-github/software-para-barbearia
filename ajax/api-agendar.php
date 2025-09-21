<?php

if($api == 'menuia'){
   $mensagem = str_replace("%0A", "\n", $mensagem); 
   
   $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://chatbot.menuia.com/api/create-message',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
    'appkey' => $instancia,
    'authkey' => $token,
    'to' => $telefone,
    'message' => $mensagem,
    'agendamento' => $data_mensagem,
    'file' => '',
    'nomearquivo' => '',
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;

  $responseData = json_decode($response, true);
  $hash = @$responseData['id'];  
  
}else{

   $url = "http://api.wordmensagens.com.br/agendar-text";
  $data = array('instance' => $instancia,
                'to' => $telefone,
                'token' => $token,
                'message' => $mensagem,
                'data' => $data_mensagem);


  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = @file_get_contents($url, false, $stream);

  $res = json_decode($result, true);
    $hash = @$res['message']['hash'];

  //echo $result;
}




 ?>