<?PHP

$shell['title1'] = "JavaScript Emotify";
$shell['link1']  = "http://benalman.com/projects/javascript-emotify/";

ob_start();
?>
  <a href="http://benalman.com/projects/javascript-emotify/">Project Home</a>,
  <a href="http://benalman.com/code/projects/javascript-emotify/docs/">Documentation</a>,
  <a href="http://github.com/cowboy/javascript-emotify/">Source</a>
<?
$shell['h3'] = ob_get_contents();
ob_end_clean();

$shell['jquery'] = 'jquery-1.3.2.js';

$shell['shBrush'] = array( 'JScript' );

?>
