<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-main',
    'version' => 'dev-main',
    'aliases' => 
    array (
    ),
    'reference' => 'd5b52dcaf6511347f82c0f538194f8c2986e9dad',
    'name' => 'topthink/think',
  ),
  'versions' => 
  array (
    'league/flysystem' => 
    array (
      'pretty_version' => '1.1.10',
      'version' => '1.1.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '3239285c825c152bcc315fe0e87d6b55f5972ed1',
    ),
    'league/flysystem-cached-adapter' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd1925efb2207ac4be3ad0c40b8277175f99ffaff',
    ),
    'league/mime-type-detection' => 
    array (
      'pretty_version' => '1.13.0',
      'version' => '1.13.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a6dfb1194a2946fcdc1f38219445234f65b35c96',
    ),
    'phpmailer/phpmailer' => 
    array (
      'pretty_version' => 'v6.9.1',
      'version' => '6.9.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '039de174cd9c17a8389754d3b877a2ed22743e18',
    ),
    'predis/predis' => 
    array (
      'pretty_version' => 'v2.2.1',
      'version' => '2.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f2b410a74afaff296a87a494e4c5488cf9fab57',
    ),
    'psr/cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd11b50ad223250cf17b86e38383413f5a6764bf8',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.1.2',
      'version' => '1.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '513e0666f7216c7459170d56df27dfcefe1689ea',
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.1',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cb6ce4845ce34a8ad9e68117c10ee90a29919eba',
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.4',
      'version' => '1.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.28.0',
      'version' => '1.28.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '42292d99c55abe617799667f454222c54c60e229',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.28.0',
      'version' => '1.28.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '70f4aebd92afca2f865444d30a4d2151c13c3179',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.28.0',
      'version' => '1.28.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6caa57379c4aec19c0a12a38b59b26487dcfe4b5',
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v4.4.47',
      'version' => '4.4.47.0',
      'aliases' => 
      array (
      ),
      'reference' => '1069c7a3fca74578022fab6f81643248d02f8e63',
    ),
    'topthink/framework' => 
    array (
      'pretty_version' => 'v6.1.4',
      'version' => '6.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '66eb9cf4d627df12911344cd328faf9bb596bf2c',
    ),
    'topthink/think' => 
    array (
      'pretty_version' => 'dev-main',
      'version' => 'dev-main',
      'aliases' => 
      array (
      ),
      'reference' => 'd5b52dcaf6511347f82c0f538194f8c2986e9dad',
    ),
    'topthink/think-filesystem' => 
    array (
      'pretty_version' => 'v1.0.3',
      'version' => '1.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '29f19f140a9267c717fecd7ccb22c84c2d72382e',
    ),
    'topthink/think-helper' => 
    array (
      'pretty_version' => 'v3.1.6',
      'version' => '3.1.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '769acbe50a4274327162f9c68ec2e89a38eb2aff',
    ),
    'topthink/think-multi-app' => 
    array (
      'pretty_version' => 'v1.0.17',
      'version' => '1.0.17.0',
      'aliases' => 
      array (
      ),
      'reference' => '4055a6187296ac16c0bc7bbab4ed5d92f82f791c',
    ),
    'topthink/think-orm' => 
    array (
      'pretty_version' => 'v2.0.61',
      'version' => '2.0.61.0',
      'aliases' => 
      array (
      ),
      'reference' => '10528ebf4a5106b19c3bac9c6deae7a67ff49de6',
    ),
    'topthink/think-template' => 
    array (
      'pretty_version' => 'v2.0.9',
      'version' => '2.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '6d25642ae0e306166742fd7073dc7a159e18073c',
    ),
    'topthink/think-trace' => 
    array (
      'pretty_version' => 'v1.6',
      'version' => '1.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '136cd5d97e8bdb780e4b5c1637c588ed7ca3e142',
    ),
    'topthink/think-view' => 
    array (
      'pretty_version' => 'v1.0.14',
      'version' => '1.0.14.0',
      'aliases' => 
      array (
      ),
      'reference' => 'edce0ae2c9551ab65f9e94a222604b0dead3576d',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
