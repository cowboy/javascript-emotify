<?PHP

include "../index.php";

$shell['title3'] = "Basic Emotification";

$shell['h2'] = 'Making the web a better place, one tiny image at a time...';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  
  // This "emoticon set" uses the Yahoo Instant Messenger smilies.. Feel free
  // to use this one or create your own!
  
  var smilies = { /*
    smiley     image_url          title_text              alt_smilies           */
    ":)":    [ "1.gif",           "happy",                ":-)"                 ],
    ":(":    [ "2.gif",           "sad",                  ":-("                 ],
    ";)":    [ "3.gif",           "winking",              ";-)"                 ],
    ":D":    [ "4.gif",           "big grin",             ":-D"                 ],
    ";;)":   [ "5.gif",           "batting eyelashes"                           ],
    ">:D<":  [ "6.gif",           "big hug"                                     ],
    ":-/":   [ "7.gif",           "confused",             ":/"                  ],
    ":x":    [ "8.gif",           "love struck",          ":X"                  ],
    ":\">":  [ "9.gif",           "blushing"                                    ],
    ":P":    [ "10.gif",          "tongue",               ":p", ":-p", ":-P"    ],
    ":-*":   [ "11.gif",          "kiss",                 ":*"                  ],
    "=((":   [ "12.gif",          "broken heart"                                ],
    ":-O":   [ "13.gif",          "surprise",             ":O"                  ],
    "X(":    [ "14.gif",          "angry"                                       ],
    ":>":    [ "15.gif",          "smug"                                        ],
    "B-)":   [ "16.gif",          "cool"                                        ],
    ":-S":   [ "17.gif",          "worried"                                     ],
    "#:-S":  [ "18.gif",          "whew!",                "#:-s"                ],
    ">:)":   [ "19.gif",          "devil",                ">:-)"                ],
    ":((":   [ "20.gif",          "crying",               ":-((", ":'(", ":'-(" ],
    ":))":   [ "21.gif",          "laughing",             ":-))"                ],
    ":|":    [ "22.gif",          "straight face",        ":-|"                 ],
    "/:)":   [ "23.gif",          "raised eyebrow",       "/:-)"                ],
    "=))":   [ "24.gif",          "rolling on the floor"                        ],
    "O:-)":  [ "25.gif",          "angel",                "O:)"                 ],
    ":-B":   [ "26.gif",          "nerd"                                        ],
    "=;":    [ "27.gif",          "talk to the hand"                            ],
    "I-)":   [ "28.gif",          "sleepy"                                      ],
    "8-|":   [ "29.gif",          "rolling eyes"                                ],
    "L-)":   [ "30.gif",          "loser"                                       ],
    ":-&":   [ "31.gif",          "sick"                                        ],
    ":-$":   [ "32.gif",          "don't tell anyone"                           ],
    "[-(":   [ "33.gif",          "not talking"                                 ],
    ":O)":   [ "34.gif",          "clown"                                       ],
    "8-}":   [ "35.gif",          "silly"                                       ],
    "<:-P":  [ "36.gif",          "party",                "<:-p"                ],
    "(:|":   [ "37.gif",          "yawn"                                        ],
    "=P~":   [ "38.gif",          "drooling"                                    ],
    ":-?":   [ "39.gif",          "thinking"                                    ],
    "#-o":   [ "40.gif",          "d'oh",                 "#-O"                 ],
    "=D>":   [ "41.gif",          "applause"                                    ],
    ":-SS":  [ "42.gif",          "nailbiting",           ":-ss"                ],
    "@-)":   [ "43.gif",          "hypnotized"                                  ],
    ":^o":   [ "44.gif",          "liar"                                        ],
    ":-w":   [ "45.gif",          "waiting",              ":-W"                 ],
    ":-<":   [ "46.gif",          "sigh"                                        ],
    ">:P":   [ "47.gif",          "phbbbbt",              ">:p"                 ],
    "<):)":  [ "48.gif",          "cowboy"                                      ],
    ":@)":   [ "49.gif",          "pig"                                         ],
    "3:-O":  [ "50.gif",          "cow",                  "3:-o"                ],
    ":(|)":  [ "51.gif",          "monkey"                                      ],
    "~:>":   [ "52.gif",          "chicken"                                     ],
    "@};-":  [ "53.gif",          "rose"                                        ],
    "%%-":   [ "54.gif",          "good luck"                                   ],
    "**==":  [ "55.gif",          "flag"                                        ],
    "(~~)":  [ "56.gif",          "pumpkin"                                     ],
    "~O)":   [ "57.gif",          "coffee"                                      ],
    "*-:)":  [ "58.gif",          "idea"                                        ],
    "8-X":   [ "59.gif",          "skull"                                       ],
    "=:)":   [ "60.gif",          "bug"                                         ],
    ">-)":   [ "61.gif",          "alien"                                       ],
    ":-L":   [ "62.gif",          "frustrated",           ":L"                  ],
    "[-O<":  [ "63.gif",          "praying"                                     ],
    "$-)":   [ "64.gif",          "money eyes"                                  ],
    ":-\"":  [ "65.gif",          "whistling"                                   ],
    "b-(":   [ "66.gif",          "feeling beat up"                             ],
    ":)>-":  [ "67.gif",          "peace sign"                                  ],
    "[-X":   [ "68.gif",          "shame on you"                                ],
    "\\:D/": [ "69.gif",          "dancing"                                     ],
    ">:/":   [ "70.gif",          "bring it on"                                 ],
    ";))":   [ "71.gif",          "hee hee"                                     ],
    "o->":   [ "72.gif",          "hiro"                                        ],
    "o=>":   [ "73.gif",          "billy"                                       ],
    "o-+":   [ "74.gif",          "april"                                       ],
    "(%)":   [ "75.gif",          "yin yang"                                    ],
    ":-@":   [ "76.gif",          "chatterbox"                                  ],
    "^:)^":  [ "77.gif",          "not worthy"                                  ],
    ":-j":   [ "78.gif",          "oh go on"                                    ],
    "(*)":   [ "79.gif",          "star"                                        ],
    ":)]":   [ "100.gif",         "on the phone"                                ],
    ":-c":   [ "101.gif",         "call me"                                     ],
    "~X(":   [ "102.gif",         "at wits' end"                                ],
    ":-h":   [ "103.gif",         "wave"                                        ],
    ":-t":   [ "104.gif",         "time out"                                    ],
    "8->":   [ "105.gif",         "daydreaming"                                 ],
    ":-??":  [ "106.gif",         "I don't know"                                ],
    "%-(":   [ "107.gif",         "not listening"                               ],
    ":o3":   [ "108.gif",         "puppy dog eyes"                              ],
    "X_X":   [ "109.gif",         "I don't want to see",  "x_x"                 ],
    ":!!":   [ "110.gif",         "hurry up!"                                   ],
    "\\m/":  [ "111.gif",         "rock on!"                                    ],
    ":-q":   [ "112.gif",         "thumbs down"                                 ],
    ":-bd":  [ "113.gif",         "thumbs up"                                   ],
    "^#(^":  [ "114.gif",         "it wasn't me"                                ],
    ":bz":   [ "115.gif",         "bee"                                         ],
    ":ar!":  [ "pirate.gif",      "pirate"                                      ],
    "[..]":  [ "transformer.gif", "transformer"                                 ]
  };
  
  // Add the above smilies, setting the appropirate base_url.
  emotify.emoticons( '../../shared/emoticons/Yahoo.AdiumEmoticonset/', smilies );
  
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
  
  // When the textarea changes, update the output!
  $('textarea')
    .keyup(function(){
      var text = $(this).val(),
        html = emotify( text );
      
      $('#output').html( html.replace( /\n/g, "<br/>" ) );
      
    })
    .keyup();
  
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
<?= $shell['donate'] ?>

<p>
  The emoticons in this example are defined in a rather large data structure. For a
  much more "intense" emotify experience, check out the
  <a href="../adium-emoticonset">Adium Emoticonsets</a> version.
</p>
<p>
  This example uses the "Yahoo" Adium Emoticonset, which I created for
  <a href="http://benalman.com/projects/simplified-style/">Simplified</a>, my
  <a href="http://www.conceitedsoftware.com/products/linkinus">Linkinus</a> message theme.
</p>

<h3>Input text (edit this)</h3>

<div class="clear"></div>
<form action="" method="get">
  <textarea name="emotify">This is some :-) sample text :P with a few  :-* smilies X( like :( this :(( and :)) that.. The only :-B rule is that =; each smiley L-) must ;) be :-& surrounded @-) by :ar! whitespace!

<):) <):) <):) COWBOY HATS! <):) <):) <):)</textarea>
</form>

<h3>Emotified HTML</h3>
<div id="output"></div>

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
