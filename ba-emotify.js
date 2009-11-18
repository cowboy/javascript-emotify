/*!
 * JavaScript Emotify - v0.6 - 11/17/2009
 * http://benalman.com/projects/javascript-emotify/
 * 
 * Copyright (c) 2009 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

// Script: JavaScript Emotify: Making the web a better place, one tiny image at a time
//
// *Version: 0.6, Last updated: 11/17/2009*
// 
// Project Home - http://benalman.com/projects/javascript-emotify/
// GitHub       - http://github.com/cowboy/javascript-emotify/
// Source       - http://github.com/cowboy/javascript-emotify/raw/master/ba-emotify.js
// (Minified)   - http://github.com/cowboy/javascript-emotify/raw/master/ba-emotify.min.js (1.1kb)
// 
// About: License
// 
// Copyright (c) 2009 "Cowboy" Ben Alman,
// Dual licensed under the MIT and GPL licenses.
// http://benalman.com/about/license/
// 
// About: Examples
// 
// These working examples, complete with fully commented code, illustrate a few
// ways in which this plugin can be used.
// 
// Basic Emotification - http://benalman.com/code/projects/javascript-emotify/examples/emotify/
// Adium Emoticonsets  - http://benalman.com/code/projects/javascript-emotify/examples/adium-emoticonset/
// 
// About: Support and Testing
// 
// Information about what browsers this code has been tested in.
// 
// Browsers Tested - Internet Explorer 6-8, Firefox 3-3.5, Safari 3-4, Chrome, Opera 9.6-10.
// 
// About: Release History
// 
// 0.6 - (11/17/2009) Minor tweaks and bugfixes
// 0.5 - (8/17/2009) Initial release

window.emotify = (function(){
  var emotify,
    EMOTICON_RE,
    emoticons = {},
    lookup = [];
  
  // Function: emotify
  // 
  // Turn text into emotified html. You know, like, with smileys.
  // 
  // Usage:
  // 
  //  > var html = emotify( text [, callback ] );
  // 
  // Arguments:
  // 
  //  text - (String) Non-HTML text containing emoticons to be parsed.
  //  callback - (Function) If specified, this will be called once for each
  //    emoticon with four arguments: img, title, smiley and text. The img and
  //    title arguments are the matched emoticon's stored image url and title
  //    text. The smiley argument is the primary smiley, and the text argument
  //    is the original text that was replaced. If unspecified, the default
  //    emotification function is used.
  // 
  // Returns:
  // 
  //  (String) An HTML string containing inline emoticon image HTML.
  
  emotify = function( txt, callback ) {
    callback = callback || function( img, title, smiley, text ) {
      title = ( title + ', ' + smiley ).replace( /"/g, '&quot;' ).replace( /</g, '&lt;' );
      return '<img src="' + img + '" title="' + title + '" alt="" class="smiley"/>';
    };
    
    return txt.replace( EMOTICON_RE, function( a, b, text ) {
      var i = 0,
        smiley = text,
        e = emoticons[ text ];
      
      // If smiley matches on manual regexp, reverse-lookup the smiley.
      if ( !e ) {
        while ( i < lookup.length && !lookup[ i ].regexp.test( text ) ) { i++ };
        smiley = lookup[ i ].name;
        e = emoticons[ smiley ];
      }
      
      // If the smiley was found, return HTML, otherwise the original search string
      return e ? ( b + callback( e[ 0 ], e[ 1 ], smiley, text ) ) : a;
    });
  };
  
  // Method: emotify.emoticons
  // 
  // By default, no emoticons are registered with <emotify>. This method allows
  // you to add one or more emoticons for future emotify parsing.
  // 
  // Usage:
  // 
  //  > emotify.emoticons( [ base_url, ] [ replace_all, ] [ smilies ] );
  // 
  // Arguments:
  // 
  // base_url (String) - An optional string to prepend to all image urls.
  // replace_all (Boolean) - By default, added smileys only overwrite existing
  //   smileys with the same key, leaving the rest. Set this to true to first
  //   remove all existing smileys before adding the new smileys.
  // smilies (Object) - An object containing all the smileys to be added. If
  //   smilies is omitted, the method does nothing but return the current
  //   internal smilies object.
  // 
  // Returns:
  // 
  //  (Object) The internal smilies object. Do not modify this object directly,
  //  use the emotify.emoticons method instead.
  // 
  // A sample emotify.emoticons call and smilies object:
  // 
  //  > emotify.emoticons( "/path/to/images/", {
  //  > 
  //  >   // "smiley": [ image_url, title_text [, alt_smiley ... ] ]
  //  > 
  //  >   ":-)": [ "happy.gif", "happy" ],
  //  >   ":-(": [ "sad.gif", "sad", ":(", "=(", "=-(" ]
  //  > });
  // 
  // In the above example, the happy.gif image would be used to replace all
  // occurrences of :-) in the input text. The callback would be called with the
  // arguments "happy.gif", "happy", ":-)", ":-)" and would generate this html
  // by default: <img src="happy.gif" title="happy, :-)" alt="" class="smiley"/>
  // 
  // The sad.gif image would be used to replace not just :-( in the input text,
  // but also :( and :^(. If the text =( was matched, the callback would be called
  // with the arguments "sad.gif", "sad", ":-(", "=(" and would generate this
  // html by default: <img src="sad.gif" title="sad, :-(" alt="" class="smiley"/>
  // 
  // Visit this URL for a much more tangible example.
  // 
  // http://benalman.com/code/projects/javascript-emotify/examples/emotify/
  
  emotify.emoticons = function() {
    var args = Array.prototype.slice.call( arguments ),
      base_url = typeof args[0] === 'string' ? args.shift() : '',
      replace_all = typeof args[0] === 'boolean' ? args.shift() : false,
      smilies = args[0],
      
      e,
      arr = [],
      alts,
      i,
      regexp_str;
    
    if ( smilies ) {
      
      if ( replace_all ) {
        emoticons = {};
        lookup = [];
      }
      
      for ( e in smilies ) {
        emoticons[ e ] = smilies[ e ];
        emoticons[ e ][ 0 ] = base_url + emoticons[ e ][ 0 ];
      }
      
      // Generate the smiley-match regexp.
      for ( e in emoticons ) {
        
        if ( emoticons[ e ].length > 2 ) {
          // Generate regexp from smiley and alternates.
          alts = emoticons[ e ].slice( 2 ).concat( e );
          
          i = alts.length
          while ( i-- ) {
            alts[i] = alts[i].replace( /(\W)/g, '\\$1' );
          }
          
          regexp_str = alts.join( '|' );
          
          // Manual regexp, map regexp back to smiley so we can reverse-match.
          lookup.push({ name: e, regexp: new RegExp( '^' + regexp_str + '$' ) });
          
        } else {
          // Generate regexp from smiley.
          regexp_str = e.replace( /(\W)/g, '\\$1' );
        }
        
        arr.push( regexp_str );
      }
      
      EMOTICON_RE = new RegExp( '(^|\\s)(' + arr.join('|') + ')(?=(?:$|\\s))', 'g' );
    }
    
    return emoticons;
  };
  
  return emotify;
  
})();