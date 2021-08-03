<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <link rel="icon" href="img/favicon_192x192.png">
  <link rel="stylesheet" href="">
  <!-- <script src="manifest.json"></script> -->
  <meta name="mobile-web-app-capable" content="yes">
  <title>JustType Chat</title>

  <meta name="title" content="JustType Chat">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="index, follow">
  <meta name="language" content="Portuguese">
  <meta name="theme-color" content="">
  <link rel="canonical" href="">

  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:site_name" content="">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <meta property="og:image:type" content="image/">
  <meta property="og:image:width" content="">
  <meta property="og:image:height" content="">

  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:site" content="">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="">
  <meta name="twitter:image:alt" content="">
  <link rel="apple-touch-icon" sizes="" href="">

  <link rel="stylesheet" href="css/index.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>

<body>

  <main>

    <div id="chat-container">

      <header id="header-container">
        <img src="img/favicon.svg" alt="Logo do JustType Chat" title="JustType Chat">
        <span>JustType Chat</span>
        <span id="nickname-container"></span>
      </header>

      <div id="messages-container"></div>

      <div id="input-container">
        <input id="message" name="input" type="text" placeholder="Mensagem...">
        <button id="send-message"><img src="img/send.svg" alt="Botão enviar mensagem." title="Enviar"></button>
      </div>

    </div>

    <form id="insert-name" method="POST">
      <input value="brunoferreira" type="text" maxlength="25" minlength="3" placeholder="Digite um nickname...">
      <button type="button">OK</button>
    </form>

  </main>

  <script src="js/Messager.js"></script>
  <script src="js/main.js"></script>

</body>

</html>


<!--
  <div class="msg current-user-msg">
    <div class="msg-header">
      <span>BrunoFerreira</span><span>#21312</span>
    </div>
    <p>Lorem ipsum dolor sit amet</p>
  </div>
  
  <div class="msg another-user-msg">
    <div class="msg-header">
      <span>BrunoFerreira</span><span>#21312</span>
    </div>
    <p>Lorem ipsum dolor sit amet</p>
  </div>
-->
<!-- {"msg":"Ol&aacute;, my friend!","_user_id":"nstvddl…_id":"7t2uk90op","user_nickname":"jusbiscleiton"} -->