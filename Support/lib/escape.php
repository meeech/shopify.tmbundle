<?php 
/**
* Escape class. 
*
* Port of escape.rb that comes with textmate.
*/
class Escape{
    
    // escape text to make it useable in a shell script as one “word” (string)
    function sh($text) {
        return str_replace("\n", "'\n'", preg_replace('/(?=[^a-zA-Z0-9_.\/\-\x7F-\xFF\n])/', '\\', $text));
    }


}
