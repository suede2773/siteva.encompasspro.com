<?php
$Revision = "147";

/************************************************************************************
  A-Team Systems Source Code
  
  Copyright (c) 2020 by A-Team Systems, LLC.  All Rights Reserved.

  FULL SUPPORT IS AVAILABLE
  Email:  assistance@ateamsystems.com         USA Phone:   1.877.883.1394
    Web:  http://www.ateamsystems.com/       Intl Phone:  +1.603.244.3974
      
  You are hereby granted non-transferable rights to use this code in applications,
  software and scripts developed for you by A-Team Productions, LLC.
  
  Do not modify, resell, transfer or otherwise copy this code except for backup or
  migration purposes.
************************************************************************************/

$SiteName = $_SERVER["SERVER_NAME"];
$PHPVersionArray = explode('.', PHP_VERSION);

if ( isset( $_GET["Mode"] ) )
   $Mode = $_GET["Mode"];
else
   $Mode = "";

if ( isset( $_GET["Type"] ) )
   $ImgType = $_GET["Type"];
else
   $ImgType = "Gray";

if ( $Mode == "RandomImage" )
   {
   if ( isset( $_GET["Type"] ) )
      $ImgSize = $_GET["Size"];
   else
      $ImgSize = 64;

   if ( $PHPVersionArray[0] >= 7 )
      {
      // -- PHP 7.x / OpenSSL
      $cipher = "aes-128-gcm";
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivlen);
      }
   else
      {
      $td = mcrypt_module_open (MCRYPT_RIJNDAEL_256, "", MCRYPT_MODE_CBC, "");
      $iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_DEV_RANDOM);
      }

   header("Content-type: image/png");
   
   $img = imagecreatetruecolor($ImgSize,$ImgSize);
   
   if ( $ImgType == "Green" )
      $bgcolor = imagecolorallocate($img, 34, 170, 34);
   elseif ( $ImgType == "Red" )
      $bgcolor = imagecolorallocate($img, 170, 34, 34);
   elseif ( $ImgType == "Gray" )
      $bgcolor = imagecolorallocate($img, 128, 128, 128);
   else
      $bgcolor = imagecolorallocate($img, 0, 0, 0);
   
   imagefill($img, 0, 0, $bgcolor);   

   //$ink = imagecolorallocate($img,255,255,255);
   $ink = imagecolorallocate($img,255,255,255);
   for($i=0;$i<255;$i++) {
     for($j=0;$j<255;$j++) {
     $twobytes = substr ($iv, 0, 2);
     $iv = substr ($iv, 2);
     if (!strlen ($iv))
      {
      if ( $PHPVersionArray[0] >= 7 )
         $iv = openssl_random_pseudo_bytes($ivlen);
      else
         $iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
      }

     @imagesetpixel($img, ord($twobytes[0]), ord($twobytes[1]), $ink);
     }
   }

   imagepng($img);
   imagedestroy($img);

   exit();
   }

// ---- Detect Framework
//

// Not used anymore
/*
$fp = fopen("../public" . $_SERVER["DOCUMENT_URI"], "r");

$Framework = "Unknown";
if ( $fp == FALSE )
   {
   $Framework = "Laravel";
   }
*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
   <title><?php echo($SiteName);?> - A-Team Welcome Index</title>
   <style type="text/css">
      ::selection{ background-color: #E13300; color: white; }
      ::moz-selection{ background-color: #E13300; color: white; }
      ::webkit-selection{ background-color: #E13300; color: white; }

      body {
              background-color: #fff;
              margin: 12px;
              font: 13px/20px normal Helvetica, Arial, sans-serif;
              color: #4F5155;
      }

      a {
              color: #003399;
              background-color: transparent;
              font-weight: normal;
      }

      h1 {
              color: #444;
              background-color: transparent;
              border-bottom: 1px solid #D0D0D0;
              font-size: 24px;
              font-weight: bold;
              margin: 0 0 14px 0;
              padding: 14px 15px 10px 15px;
      }

      h2 {
              color: #444;
              background-color: transparent;
              font-size: 20px;
              font-weight: bold;
              margin: 0 0 0px 0;
              padding: 2px 15px 0px 15px;
      }

      code { 
              font-family: Consolas, Monaco, Courier New, Courier, monospace;
              font-size: 12px;
              background-color: #f9f9f9;
              border: 1px solid #D0D0D0;
              color: #002166;
              display: block;
              margin: 14px 0 14px 0;
              padding: 12px 10px 12px 10px;
      }

      p {
              margin: 12px 15px 12px 15px;
      }
      
      ul li {
              margin-bottom: 10px;
      }
      
      #container {
              margin: 10px;
              /* border: 1px solid #D0D0D0;
              -webkit-box-shadow: 0 0 8px #D0D0D0;*/
      }

      .PHPCode {
              font-family: Consolas, Monaco, Courier New, Courier, monospace;
              font-size: 12px;
              font-weight: bold;
              background-color: #EAEAEA;
              color: #002166;
              white-space: nowrap;
              padding: 1px 4px 1px 4px;
      }
      
      .SysCode {
              font-family: Consolas, Monaco, Courier New, Courier, monospace;
              font-size: 12px;
              font-weight: bold;
              background-color: black;
              color: #21E021;
              white-space: nowrap;
              padding: 1px 4px 1px 4px;
      }
      
      .TestTable {
              width: 96%;
              margin: 2px 15px 20px 15px;
      }
      
      .TestTable th {
              font-size: 100%;
              vertical-align: middle;
      }
      
      .TestTable td {
              font-size: 100%;
              vertical-align: middle;
              padding: 15px;
      }
      
      .TestPassed {
              color: #22AA22;
              font-weight: bold;
              font-size: 18px;
      }
      
      .TestFailed {
              color: #AA2222;
              font-weight: bold;
              font-size: 18px;
      }
      
      .TestNotInstalled {
              color: #888888;
              font-weight: bold;
              font-size: 18px;
      }
            
      .TestInfo {
              margin-top: 5px;
              font-size: 10px;
              color: #888888;
      }
   </style>
</head>

<body>  
   <div id="container">
      <div style="margin: 0px 0px 20px 0px; border-bottom: 1px solid #333333; padding-bottom: 10px;">
         <img src="https://www.ateamsystems.com/_email/ats-logo-welcome.png" style="float: none;" />
      </div>
            
      <h1><?php echo($SiteName);?></h1>
      
      <p>
         <strong>Welcome to your new site!</strong>
         If this is your first experience with A-Team's setup please take a look at the information below, it will help you get to know your new A-Team PHP-FPM Chroot environment.
         
         Remember, <strong>we're here to help</strong>! We're PHP developers ourselves so don't hesitate to give us a shout if you run into any problems or have any questions.
         
         <ul>
            <li><strong>Support Ticket System:</strong> <a href="https://support.ateamsystems.com/" target="_blank">https://support.ateamsystems.com/</a></li>
            <li><strong>Support Phone:</strong> +1 877.883.1394 option 1</li>
         </ul>
      </p>

      <h1>Self-Tests</h1>
      
      <table class="TestTable">
         <tr>
            <th>Test</th>
            <th>Description</th>
            <th>Result</th>
         </tr>
         
         <tr>
            <th>CHRoot</th>
            <td>CHRoot PHP-FPM pool variable is set.  This is non-critical and mostly for informational purposes.</td>
            <td>
               <?php
               if ( isset($_SERVER["CHROOT"]) == TRUE )               
                  $result = TRUE;
               else
                  $result = FALSE;
                  
               if ( $result === FALSE )
                  {
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">Define <pre>env[CHROOT]</pre> in the site pool config</div>\n\n");
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>Sending Mail</th>
            <td>The <span class="PHPCode">mail()</span> function works.</td>
            <td>
               <?php
               if ( mail("ateam-mailtest-DyLqszL88J0@ateamsystems.com", "Mail test", "Message") == TRUE )
                  $result = TRUE;
               else
                  $result = FALSE;
                  
               if ( $result === FALSE )
                  {
                  $TestError = "";
                  
                  $SendmailPath = ini_get("sendmail_path");
                  if ( strstr($SendmailPath, "/bin/mini_sendmail") === FALSE )
                     $TestError .= sprintf("mini_sendmail not in sendmail_path\n");
                  
                  if ( file_exists("/bin/mini_sendmail") == FALSE )
                     $TestError .= sprintf("/bin/mini_sendmail not present\n");
                  
                  if ( file_exists("/bin/sh") == FALSE )
                     $TestError .= sprintf("/bin/sh not present\n");
                  
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">%s</div>\n\n", nl2br(trim($TestError)));
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>cURL HTTPS</th>
            <td>Outgoing <span class="PHPCode">curl()</span> calls work 100% securely including host verification which means cURL can find the CA Root Certificate Bundle.</td>
            <td>
               <?php
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, 'https://www.ateamsystems.com/ip/');
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
               $result = curl_exec($ch);
               
               if ( $result === FALSE )
                  {
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">cURL Error: %s</div>\n\n", curl_error($ch));
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  printf("<div class=\"TestInfo\">External&nbsp;IP:&nbsp;%s</div>\n\n", $result);
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>Cryptography</th>
            <td>
               Entropy data source is suitable for cryptography.
            </td>
            <td>
               <?php
               // ---- Make sure /dev/urandom exists and is readable
               //
               $TestError = "";
               $TestSuccess = TRUE;
               
               $fp = fopen("/dev/urandom", "r");
               
               if ( $fp == FALSE )
                  {
                  $TestSuccess = FALSE;
                  $TestError = "/dev/urandom does not exist";
                  }
                  
               // ---- Do full MCRYPT_DEV_URANDOM test
               //
               function CryptTestErrorHandler ( $errno, $errstr, $errfile, $errline )
                  {
                  global $TestError, $TestSuccess;
                  
                  // -- Ignore 8192 (Deprecated) errors
                  if ( $errno != 8192 )
                     {
                     $TestError = $errstr;
                     $TestSuccess = FALSE;
                     }
                  }
               
               if ( $TestSuccess !== FALSE )
                  {
                  set_error_handler("CryptTestErrorHandler");
                  
                  if ( $PHPVersionArray[0] >= 7 )
                     {
                     // -- PHP 7.x / OpenSSL
                     $key = "password123";
                     $plaintext = "testing encryption";
                     $cipher = "aes-128-gcm";
                     $ivlen = openssl_cipher_iv_length($cipher);
                     $iv = openssl_random_pseudo_bytes($ivlen);
                     $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);                  
                     }
                  else
                     {
                     // -- PHP 5.6 / mcrypt
                     $td = mcrypt_module_open (MCRYPT_RIJNDAEL_256, "", MCRYPT_MODE_CBC, "");
                     $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_DEV_URANDOM);
                     }
                  
                  restore_error_handler();
                  }
               
               // ---- Process results
               //
               if ( $TestSuccess === FALSE )
                  {
                  printf("<a href=\"" . $_SERVER["PHP_SELF"] . "?Mode=RandomImage&Size=256\" target=\"_blank\"><img src=\"" . $_SERVER["PHP_SELF"] . "?Mode=RandomImage&Size=64&Type=Red\" style=\"float: right; margin: 0px 0px 0px 10px;\" /></a>\n");
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">Error: %s</div>\n\n", $TestError);
                  }
               else
                  {
                  printf("<a href=\"" . $_SERVER["PHP_SELF"] . "?Mode=RandomImage&Size=256\" target=\"_blank\"><img src=\"" . $_SERVER["PHP_SELF"] . "?Mode=RandomImage&Size=64&Type=Green\" style=\"float: right; margin: 0px 0px 0px 10px;\" /></a>\n");
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  printf("<div class=\"TestInfo\">mcrypt_create_iv() uses /dev/urandom</div>\n\n", $TestError);
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>Temp Files</th>
            <td>Verify files can be written to <span class="SysCode">/tmp</span> which is needed for uploads, SOAP calls, sessions and more.</td>
            <td>
               <?php
               $TestFile = "/tmp/php-write-test";
               $TestSuccess = FALSE;
               
               $fp = fopen($TestFile, "w");
               
               if ( $fp == FALSE )
                  {
                  $TestSuccess = FALSE;
                  $TestError = "fopen() failure opening $TestFile for writing.";
                  }
               else
                  {
                  $Ret = fwrite($fp, "dXTPqMlGxeueOyVmsnWL");
                  
                  if ( $Ret === FALSE )
                     {
                     $TestSuccess = FALSE;
                     $TestError = "fwrite() writing to $TestFile returned an error.";
                     }
                  elseif ( $Ret != 20 )
                     {
                     $TestSuccess = FALSE;
                     $TestError = "fwrite() writing to $TestFile did not save all test data.";
                     }
                  else
                     {
                     $TestSuccess = TRUE;
                     }
                  
                  fclose($fp);
                  unlink($TestFile);
                  }
               
               if ( $TestSuccess === FALSE )
                  {
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>SOAP / WSDL</th>
            <td>Verify <span class="PHPCode">SoapClient()</span> can retrieve a WSDL via HTTPS.</td>
            <td>
               <?php
               $TestSuccess = TRUE;
               
               try 
                  {
                  $url = "https://www.ateamsystems.com/ip/wsdl.php";
                  $params = array ( "trace" => 1, "cache_wsdl" =>  WSDL_CACHE_NONE );
                  
                  $SoapCall = new SoapClient($url, $params);
                  
                  if ( $SoapCall == NULL )
                     {
                     $TestSuccess = FALSE;
                     $TestError = "SoapClient() returned NULL";
                     }
                  else
                     {
                     $SoapFunctions = $SoapCall->__getFunctions();
                     if ( $SoapFunctions[0] != "string sayHello2n1iC8CyyzTXuzY6wUmJ(string \$firstName)" )
                        {
                        $TestSuccess = FALSE;
                        $TestError = "__getFunctions() did not return correctly";
                        }
                     }
                  
                  $auth_params = new STDClass();
                  }
               catch (SoapFault $SoapError)
                  {
                  $TestSuccess = FALSE;
                  $TestError = "<pre>" .  print_r($SoapError, TRUE) . "</pre>";
                  }
               
               if ( $TestSuccess === FALSE )
                  {
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>Zend OPcache</th>
            <td>Verify OPcache is configured correctly PHP-FPM + chrooting.</td>
            <td>
               <?php
               $TestSuccess = TRUE;
               $TestError = "";
               
               if ( extension_loaded("Zend OPcache") )
                  {
                  $OPCStatus = ini_get("opcache.enable");
                  $OPCValRoot = ini_get("opcache.validate_root");
                  $OPCValPerm = ini_get("opcache.validate_permission");

                  if ( $OPCStatus != 0 )
                     {
                     // OpCache is OK as long as it's setup right.
                     if ( $OPCValRoot != 1 )
                        {
                        $TestSuccess = FALSE;
                        $TestError = "Set 'opcache.validate_root = 1' in php.ini";
                        }
                     if ( $OPCValPerm != 1 )
                        {
                        if ( $TestSuccess == FALSE )
                           $TestError .= "<br />";
                        else
                           $TestSuccess = FALSE;
                        
                        $TestError .= "Set 'opcache.validate_permission = 1' in php.ini";
                        }
                     
                     // Show that we know it's setup right for PHP-FPM
                     if ( $TestSuccess != FALSE ) 
                        $TestError = "Module enabled and configured correctly";
                     }
                  else
                     $TestError = "Module loaded but disabled";
                  }
               else
                  $TestError = "";
               
               if ( $TestSuccess === FALSE )
                  {
                  printf("<div class=\"TestFailed\">FAILED</div>");
                  printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                  }
               else
                  {
                  printf("<div class=\"TestPassed\">PASSED</div>");
                  printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                  }
               ?>
            </td>
         </tr>
         <tr>
            <th>Image-Magick</th>
            <td>Verify Image-Magick is installed and its filters/formats work.</td>
            <td>
               <?php
               $TestSuccess = TRUE;
               $PluginPresent = FALSE;
               
               if ( extension_loaded("imagick") )
                  {  
                  $PluginPresent = TRUE;
                  
                  try 
                     {
                     $IMFormats = \Imagick::queryformats();
                     
                     $FormatCount = count($IMFormats);
                     
                     if ( $FormatCount < 5 )
                        {
                        $TestSuccess = FALSE;
                        $TestError = "Imagick::queryformats()<br />$FormatCount formats installed";
                        }
                     else
                        {
                        $TestError = "$FormatCount formats installed";
                        }
                     }
                  catch (ImagickException $IMError)
                     {
                     $TestSuccess = FALSE;
                     $TestError = "<pre>" .  print_r($IMError, TRUE) . "</pre>";
                     }
                  }
               if ( $PluginPresent == TRUE )
                  {
                  if ( $TestSuccess === FALSE )
                     {
                     printf("<div class=\"TestFailed\">FAILED</div>");
                     printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                     }
                  else
                     {
                     printf("<div class=\"TestPassed\">PASSED</div>");
                     printf("<div class=\"TestInfo\">%s</div>\n\n", $TestError);
                     }
                  }
               else
                  {
                  printf("<div class=\"TestNotInstalled\">Not Installed</div>");
                  printf("<div class=\"TestInfo\">Extension pecl-imagick not installed</div>\n\n");
                  }
               ?>
            </td>
         </tr>
      </table>
      <div style="color: #AEAEAE; margin: -15px 0px 0px 20px; font-size: 10px;">Revision <?php echo($Revision) ?></div>
      
      <h1>Things to Note</h1>
      <p>
         PHP-FPM with chrooting offers much better performance and security over mod_php or PHP/CGI, but there are some things to know when moving to this setup:
         
         <ul>
            <li>If you are new to the concept of chrooting take a quick glance at the <a href="https://en.wikipedia.org/wiki/Chroot" target="_blank">Wikipedia Chroot page</a> for some background.</li>
            <li>Each site has its own process pool and associated user which its PHP code runs as inside the chroot.  This site's user is <span class="SysCode"><?php echo($_SERVER["USER"]); ?></span>.</li>
            <li>When using MySQL do not use <span class="PHPCode">localhost</span> as the connection host, even if the MySQL server is local.  MySQL co-opts this value and will switch to socket mode if <span class="PHPCode">localhost</span> is passed.  Since PHP cannot access files outside the chroot, it will fail to connect to the MySQL file socket.  To connect to a MySQL server on the same host as PHP use <span class="PHPCode">127.0.0.1</span> as the hostname.  This ensures that the TCP connection method is used.</li>
            <li>Directory paths, according to PHP, are all relative of the chroot.  For example, this site's documents are located in <span class="SysCode"><?php echo($_SERVER["CHROOT"] . $_SERVER["DOCUMENT_ROOT"]); ?></span>, however PHP sees this as <span class="SysCode"><?php echo($_SERVER["DOCUMENT_ROOT"]); ?></span>.  Make sure this is taken into account if absolute paths are being used.</li>
            <li>Web server (NginX or Apache) and PHP logs for this site are located in <span class="SysCode"><?php echo($_SERVER["CHROOT"]); ?>/log</span>.  PHP errors are never displayed and instead sent to the file <span class="SysCode">php-errors</span>.  You can have your application write any custom logs you might have to this directory as well.  All files in this directory are automatically rotated periodically.</li>
            <li><span class="PHPCode">$_SESSION</span> storage needs to be moved into the database.  In staging and production environments the default file based session storage will not work as these are not shared between servers.  What will appear to happen is that <span class="PHPCode">$_SESSION</span> will vanish or fail to be set as requests are spread across all back end servers evenly.  A-Team has example code and instructions on how to set this up and easily switch over with minimal changes, just ask!</li>
            <li>Uploads should be placed into the <span class="SysCode">/htwritable</span> directory which is outside of the public access scope.  By default <span class="SysCode">/htwritable</span>, <span class="SysCode">/tmp</span>, and <span class="SysCode">/log</span> (relative to the chroot) are the only places that the <span class="SysCode"><?php echo($_SERVER["USER"]); ?></span> user can write to, which is what this site's PHP code runs as.</li>
            <li>If you are using cURL be sure that host verification is enabled via  <span class="PHPCode">curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);</span> as without that any secure calls are vulnerable to man-in-the-middle attacks.  This is the default in PHP 5.6, and also applies to SOAP and other HTTPS-using functions.</li>
            <li>If permissions become an issue contact us, we can work out a secure permissions and ownership structure that works for you. Please <strong>DO NOT</strong> make anything world writable either via command line or in PHP.  We scan continuously for this and will receive alerts if any file is set this way.</li>
         </ul>
         
      </p>
      
      <h1>PHP Logging Settings</h1>
      <p>
         <?php
         function error2string($value)
            {
            $level_names = array(
               E_ERROR => 'E_ERROR', E_WARNING => 'E_WARNING',
               E_PARSE => 'E_PARSE', E_NOTICE => 'E_NOTICE',
               E_CORE_ERROR => 'E_CORE_ERROR', E_CORE_WARNING => 'E_CORE_WARNING',
               E_COMPILE_ERROR => 'E_COMPILE_ERROR', E_COMPILE_WARNING => 'E_COMPILE_WARNING',
               E_USER_ERROR => 'E_USER_ERROR', E_USER_WARNING => 'E_USER_WARNING',
               E_USER_NOTICE => 'E_USER_NOTICE' );
               
            if(defined('E_STRICT')) $level_names[E_STRICT]='E_STRICT';
            if(defined('E_DEPRECATED')) $level_names[E_DEPRECATED]='E_DEPRECATED';
	    if(defined('E_USER_DEPRECATED')) $level_names[E_USER_DEPRECATED]='E_USER_DEPRECATED';
            
            $levels=array();
            
            if(($value&E_ALL)==E_ALL)
               {
               $levels[]='E_ALL';
               $value&=~E_ALL;
               }
 
            foreach($level_names as $level=>$name)
                if(($value&$level)==$level) $levels[]=$name;
            
            return implode(' | ',$levels); 
            }
         
         printf("Effective logging settings for this site: %s\n", error2string(ini_get("error_reporting")));
         
         ?>
      </p>

      <h1>$_SERVER</h1>
      <p>
         Under PHP-FPM/chrooting the <span class="PHPCode">$_SERVER</span> variables can be a bit different.
         <?php
         if ( isset($_SERVER["BACKEND_REMOTE_ADDR"]) ) 
            {
            printf("Front end proxying (which is the case for this site) also has its own changes (see above).");
            }
         ?>
         
         <ul>
            <li>A-Team does some 'magic' in <span class="SysCode">etc/fix-php-fpm.inc</span>.  This code is executed before every PHP script's code for a site.  Most of this is fixing <span class="PHPCode">$_SERVER</span> to what applications expect.  For this site that file is located at <span class="SysCode"><?php echo($_SERVER["CHROOT"]); ?>/etc/fix-php-fpm.inc</span>.  This file is maintained by A-Team but let us know if you have any questions or concerns.
            <?php
               if ( isset($_SERVER["BACKEND_REMOTE_ADDR"]) ) 
                  {
                  // We're being proxied
                  ?>
                  <li><b>For this site the actual PHP application server is behind front-end proxies</b>.  We do our best to rewrite <span class="PHPCode">$_SERVER["REMOTE_*"]</span> and <span class="PHPCode">$_SERVER["SERVER_*"]</span> variables so that the proxies are invisible to the code running on the back end servers.  This means that PHP on the back end servers can still see the outside visitor's IP (instead of just the proxies) and so forth.</li>
                  <li>Per the above, when proxied, you can still access the original pre-magic variables via <span class="PHPCode">$_SERVER["BACKEND_REMOTE_*"]</span> if you wish to use information about the connection between the back end server and the proxy.</li>
                  <?php
                  }
                  ?>
            <li>A-Team defines <span class="PHPCode">$_SERVER["SITE_MODE"]</span> which is set to either <span class="PHPCode">dev</span>, <span class="PHPCode">staging</span>, or <span class="PHPCode">prod</span> so you can do conditional if statements to detect if the code is running in the dev, staging or production environment.</li>
            <li>A-Team defines <span class="PHPCode">$_SERVER["SERVER_FQDN"]</span> which is set to the hostname of the server the script is currently running on.  This is not to be confused with <span class="PHPCode">$_SERVER["SERVER_NAME"]</span> which references the virtual host name of the web site.</li>
            <li>A-Team defines <span class="PHPCode">$_SERVER["CHROOT"]</span> which is set to the real path that the site chroot is located under on the server.  This directory is what PHP sees as the root directory.</li>
         </ul>
      </p>

      <p>
         Here is what <span class="PHPCode">$_SERVER</span> looks like for this site:
      </p>
      
      <div style="margin: 5px 20px 5px 40px;">
         <code><pre><?php
            ksort($_SERVER);
            print_r($_SERVER);
            ?></pre></code>
      </div>

      <h1>PHP Info</h1>
      <p>
         Take a look at the <span class="PHPCode">phpinfo()</span> output below:
      </p>
      
      <div style="margin: 5px 20px 5px 40px; height: 500px; overflow: auto; width: 1000px; border: 1px solid black; padding: 10px;">
         <?php
            phpinfo();
         ?>
      </div>

   <div style="margin: 20px 0px 10px 0px; border-top: 1px solid #333333; padding-top: 10px; font-weight: bold; font-size: 12px; color: #888888;">
      Revision <?php echo($Revision) ?> - Copyright &copy; 2016 A-Team Productions, LLC. All Rights Reserved.
   </div>

   </div><!-- container -->
</body>
</html>
