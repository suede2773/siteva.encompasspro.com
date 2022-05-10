<?php
header("Content-type: text/plain");

$SNormal        = "O" . "K";
$SError         = "Error";

$SubChecks      = array();

// ---- Check PHP
array_push($SubChecks, array("Name" => "PHP Core", "Status" => $SNormal) );

// ---- Loop through and display status
reset($SubChecks);
$AnyErrors = FALSE;
foreach ($SubChecks as $key => $SArray)
   {
   if ( $SArray["Status"] != $SNormal )
      $AnyErrors = TRUE;

   printf($SArray["Name"] . ": " . $SArray["Status"] . "\n");
   }

// ---- Display overall status
printf("--\n");
if ( $AnyErrors == TRUE )
   printf("Overall Status: FAILED\n");
else
   printf("Overall Status: PAS" . "SED\n");
?>
