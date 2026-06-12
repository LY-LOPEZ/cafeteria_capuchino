<?php

if (!function_exists('publicAssetUrl')) {
   function publicAssetUrl($path) {
      $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
      $projectBase = preg_replace('#/(admin|employee|public)$#', '', $scriptDir);
      return rtrim($projectBase, '/') . '/public/' . ltrim($path, '/');
   }
}
