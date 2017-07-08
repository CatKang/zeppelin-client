<?php

$metas["127.0.0.1"] = "9801";
#$metas["127.0.0.1"] = "9802";
$timeout = 100;

//$zp_options = new Zeppelin("127.0.0.1", 9801, "test1");
$zp_options = new Zeppelin($metas, "options_key_table", $timeout);
$times = 200;
while($times--) {
  $num = rand(10, 1000);
  $ret = $zp_options->Set("options_key", $num);
  if ($ret == false) {
    echo "Set Error". PHP_EOL;
    break;
  }
  $val = $zp_options->Get("options_key");
  if ($val == false || $val != $num) {
    echo "Error, num: ". $num. " val: ". $val. PHP_EOL;
    var_dump($val);
    break;
  }

  $ret = $zp_options->Delete("options_key");
  if ($ret == false) {
    echo "Delete Error". PHP_EOL;
    break;
  }

  $val = $zp_options->Get("options_key");
  if ($val != false) {
    echo "Error, expect false, but: ". " val: ". $val. PHP_EOL;
    var_dump($val);
    break;
  }
  $ret = $zp_options->Set("options_key", $num);
  if ($ret == false) {
    echo "Set Error". PHP_EOL;
    break;
  }
}

echo "done". PHP_EOL;
