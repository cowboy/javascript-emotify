<?PHP

include "../index.php";

$shell['title3'] = "Adium Emoticonsets";

$shell['h2'] = 'Making the world a better place, one tiny image at a time...';


$emo_base = '../../shared/emoticons/';
$emo_sets = array();

$files = scandir( $emo_base );
foreach ( $files as $file ) {
  if ( file_exists( "$emo_base$file/Emoticons.plist" ) ) {
    $emo_sets[] = $file;
  }  
}

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  
  // Load an Adium Emoticonset.
  function emo_set_load( emoticon_set, callback ) {
    var emoticons_base = '<?= $emo_base ?>' + emoticon_set + '/',
      obj = {};
    
    // For some reason, jQuery's :contains doesn't seem to work when parsing XML in IE.
    function contains( text ) {
      return function() {
        return ( this.textContent || this.text || '' ).indexOf( text ) !== -1;
      }
    };
    
    $.ajax({
      // The web server must be configured to serve .plist files as text/xml!
      dataType: 'xml',
      
      // The XML file that defines the Adium Emoticonset.
      url: emoticons_base + 'Emoticons.plist',
      
      // Parse Adium Emoticonset .plist file.
      success: function( data, textStatus ){
        $(data).find( 'plist > dict > dict > key' ).each(function(){
          
          var that = $(this),
            image = that.text(),
            equivalents = that.next().children().filter( contains('Equivalents') ).next().children(),
            name = that.next().children( 'key' ).filter( contains('Name') ).next().text(),
            text,
            arr = [];
          
          debug.log( image, equivalents.length, name );
          
          equivalents.each(function(){
            text = $(this).text();
            text && arr.push( text );
          });
          
          obj[ arr.shift() ] = [ emoticons_base + image, name ].concat( arr );
        });
        
        // Overwrite all current emoticons with those in the Emoticonset.
        callback( emotify.emoticons( true, obj ) );
      },
      
      // Oops?
      error: function() {
        callback( false );
      }
    });  
  };
  
  // When an Adium Emoticonset is loaded, update the page.
  function emo_set_onload( emoticons ) {
    if ( !emoticons ) {
      debug.log( 'Error loading emoticons!' );
      return;
    }
    
    // Let's override the "cowboy" smiley with something a little sexier :D
    emotify.emoticons({
      "<):)": [ "../../shared/cowboy.png", "cowboy" ]
    });
    
    // Generate "emoticons key" table for this example.
    var html = '',
      cols = 7,
      i = -1;
    
    $.each( emotify.emoticons(), function(k,v){
      i++;
      html += i % cols == 0 ? '<tr>' : '';
      html += '<td class="key1">' + k + '<\/td><td class="key2">' + emotify( k ) + '<\/td>';
      html += i % cols == cols - 1 ? '<\/tr>' : '';
    });
    
    while ( ++i % cols ) {
      html += '<td class="key3" colspan="2"><\/td>';
    }
    
    $('#key').html( '<table>' + html + '<\/table>' );
    
    // Redraw the output.
    $('textarea').keyup();
  };
  
  // When the textarea changes, update the output!
  $('textarea')
    .keyup(function(){
      var text = $(this).val(),
        html = emotify( text );
      
      $('#output').html( html.replace( /\n/g, "<br/>" ) );
      
    })
    .keyup();
  
  // When the select changes, load an Adium Emoticonset!
  $('#choose')
    .change(function(){
      emo_set_load( $(this).val(), emo_set_onload );
    })
    .change();
  
});

<?
$shell['script'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../ba-emotify.js"></script>
<script type="text/javascript" language="javascript">

<?= $shell['script']; ?>

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  width: 700px;
}

textarea {
  display: block;
  height: 8em;
  width: 692px;
}

textarea,
#output {
  border: 1px solid #000;
  padding: 3px;
  margin-bottom: 0.6em;
}

#output {
  line-height: 1.6em;
}

img.smiley {
  vertical-align: -20%;
}

table {
  width: 100%;
}

table img.smiley {
  #vertical-align: middle;
}

table td {
  text-align: center;
}

table .key1 {
  border-right: none;
}

table .key2 {
  border-left: none;
}

table .key3 {
  border: none;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>

<p>
  This example gets its emoticons by using jQuery to dynamically parse Adium Emoticonsets (among other
  things). Most newer sets will work, but YMMV depending on the image formats (.tif is generally bad,
  for example) and internal folder structure. For a much simpler emotify example, check out the
  <a href="../emotify">static emoticon</a> version.
</p>
<p>
  Note that all included Adium Emoticonsets are assumed to be in the public domain, and were
  downloaded from the <a href="http://www.adiumxtras.com/index.php?a=search&cat_id=2">Adium Xtras - Emoticons</a>
  page, with the exception of the "Yahoo" set, which I created for <a href="http://benalman.com/projects/simplified-style/">Simplified</a>, my <a href="http://www.conceitedsoftware.com/products/linkinus">Linkinus</a> message theme.
</p>

<h3>Input text (edit this)</h3>
<form action="" method="get">
  <textarea name="emotify">This is some :-) sample text :P with a few  :-* smilies X( like :( this :(( and :)) that.. The only :-B rule is that =; each smiley L-) must ;) be :-& surrounded @-) by :ar! whitespace! :V And if a :B smiley doesn't (:) exist in the <3 set, it just won't =[ get [..] replaced.

<):) <):) <):) COWBOY HATS! <):) <):) <):)</textarea>
</form>

<h3>Emotified HTML</h3>
<div id="output"></div>

<h3>Choose an Adium Emoticonset</h3>
<form action="" method="get">
  <select id="choose">
<?
foreach ( $emo_sets as $emo_set ) {
  print "    <option value=\"$emo_set\">" . preg_replace( '/\.[^.]+$/', '', $emo_set ) . "</option>\n";
}
?>
  </select>
</form>

<h3>Emoticons key</h3>
<div id="key"></div>

<h3>The code</h3>

<pre class="brush:js">
<?= htmlspecialchars( $shell['script'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
