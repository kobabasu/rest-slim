<?php
namespace Lib\Legacy;

class String {

  public function __construct() {}

  /**
   * prettyPrint
   * php5.3 or above in use JSON_PRETTY_PRINT
   * @param string $json The original JSON string
   * @return string Indented of the original JSON string.
   */
  public function prettyPrint($json) {
    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {
      $char = substr($json, $i, 1);

      if ($char == '"' && $prevChar != '\\') {
        $outOfQuotes = !$outOfQuotes;
      } else if(
        ($char == '}' || $char == ']')
        && $outOfQuotes)
      {
        $result .= $newLine;
        $pos --;
        for ($j=0; $j<$pos; $j++) {
          $result .= $indentStr;
        }
      }

      $result .= $char;

      if (
        ($char == ',' || $char == '{' || $char == '[')
        && $outOfQuotes)
      {
        $result .= $newLine;
        if ($char == '{' || $char == '[') {
          $pos ++;
        }

        for ($j = 0; $j < $pos; $j++) {
          $result .= $indentStr;
        }
      }

      $prevChar = $char;
    }

    return $result;
  }


  /**
   * json_xencode
   * php5.3 or above in use JSON_UNESCAPED_UNICODE
   * @param mixed   $value
   * @param int     $options
   * @param boolean $unescapee_unicode
   */
  public function json_xencode(
    $value,
    $options = 0,
    $unescapee_unicode = true
  ) {
    $v = json_encode($value, $options);
    if ($unescapee_unicode) {
      $v = $this->unicode_encode($v);
      $v = preg_replace('/\\\\\//', '/', $v);
    }
    return $v;
  }

  /**
   * return unescaped UTF8
   * 参考:http://d.hatena.ne.jp/iizukaw/20090422
   * php6 or above in use unicode_encode()
   * @param unknown_type $str
   */
  public function unicode_encode($str)
  {
    return preg_replace_callback(
      "/\\\\u([0-9a-zA-Z]{4})/",
      function ($matches) {
        return mb_convert_encoding(
          pack("H*", $matches[1]),
          "UTF-8",
          "UTF-16"
        );
      },
      $str
    );
  }

}
