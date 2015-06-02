<?php

	class InputSanitizer extends DomDocument {

		public $tags_allowed_in_fields = NULL;
		public $dropWithChildren = array('head','script','frameset', 'iframe');
		public $elemWhitelist = array('html','style','h1','h2','h3','h4','h5','h6','div','p','span','ul','ol','li','table',
										'thead','tbody','tr','th','td','a','img','b','i','em','strong','sup','sub','br','hr'
									);
		public $attrWhitelist = array('src','href','title','height','width','alt','border','id','class','rel',);
      	# these are full regexes!
		public $attrValueBlacklist = array('/javascript:.*/i','/eval\s*\([^\)]\)/i');


  		#pretty printing
  		public $indent = FALSE;
  		public $elemWrap = FALSE;
  		public $attrWrap = FALSE;
  		public $collapseWhitespace = FALSE;
  		# set this  to allow all tags
  		public $passthrough = FALSE;
  		# set this to TRUE to allow HTML in all fields, not just those definied in the $tags_allowed_in_fields global
  		public $htmlAllowedEverywhere = FALSE;

  		function __construct($elemWhitelist = NULL, $attrWhitelist = NULL) {
  			# defined in config.inc
  			global $tags_allowed_in_fields;
  			parent::__construct();
  			if ($elemWhitelist) {
  				$this->elemWhitelist = $elemWhitelist;
  			}
  			if ($attrWhitelist) {
  				$this->attrWhitelist = $attrWhitelist;
  			}
  			$this->tags_allowed_in_fields = $tags_allowed_in_fields;
  		}

  		function process($input, $length=null) {
  			if (is_string($input) && $input != "") {
  				$this->loadHTML('<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>'.$input);
  				$this->maxchars = $length;
  				$input = $this->saveSanitizedBody();
  			} else if (is_array($input)) {
  				foreach($input as $key=>$value) {
	  				if (is_array($value)) {
	  					# multidim array
	  					$input[$key] = $this->process($value, $length);
	  				} /*else if (!$this->htmlAllowedEverywhere && !in_array($key, @$this->tags_allowed_in_fields)) {echo 4;
	  					$t = strip_tags($value);
	  					if ($length) {
	  						# truncate string
	  						$t = $this->truncate_utf8($t, $length);
	  					}
	  					$input[$key] = $t;
	  				}*/
	  					else {
	  					$t = $this->process($value, $length);
	  					//if (preg_match("#^\<p\>([^\<]*)\</p\>$#", $t, $m)) {
	  						//$t = $m[1];
	  					//}
	  					$input[$key] = $t;
	  				}
	  			}
	  		}
	  		return $input;
	  	}

	  	function truncate_utf8($t, $length) {
	  		$pos = 0;
	  		$remaining = $length;
	  		$slen = strlen($t);
	  		for ($pos = 0; ($pos < $slen) && ($remaining > 0) ; --$remaining) {
	  			$c = ord($t[$pos]);
	  			$char_len = (!($c & 0x80)) ? 1 : ((($c & 0xe0) == 0xc0) ? 2 : ((($c & 0xf0) == 0xe0) ? 3 : ((($c & 0xf8) == 0xf0) ? 4 : -1)));
	  			if ($char_len == -1) {
	  				return substr($t, 0, $length);
	  			} else {
	  				$pos += $char_len;
	  			}
	  		}
	  		return substr($t, 0, $pos);
	  	}

	  	function esc_wbr($s, $blklen) {
	  		$len = strlen($s);
	  		$out = '';
	  		for ($i = 0; $i < $len; $i += $blklen) {
  				$out .= (substr($s, $i, $blklen)).'<wbr/>';
  			}
  			return $out;
  		}

  		function special($plain_text) {
  			$plain_text = htmlspecialchars($plain_text);
  			if (!empty($this->wbr)) {
  				# we are to insert <wbr/> tags to break up longer strings
  				$out = '';
  				$tokens = preg_split("/(\s+)/", $plain_text, -1, PREG_SPLIT_DELIM_CAPTURE);
  				foreach($tokens as $i=>$t) {
  					if (strlen($t) > $this->wbr) {
  						$t = $this->esc_wbr($t, $this->wbr);
  					}
  					$out .= $t;
  				}
  				$plain_text = $out;
  			}
  			return $plain_text;
  		}

  		function loadHTML($HTMLString) {
  			if (! preg_match("/\w+/",$HTMLString)) {
  				$HTMLString = " ";
  				# again, we hit the 'keep last DOm on empty input' thing
  			}
  			return @ parent::loadHTML($HTMLString);
  		}

  		function saveSanitizedHTML() {
  			list($sHTML, $charcount) = $this->dump_nodes();
  			return $sHTML;
  		}

  		function saveSanitizedBody() {
  			$html = $this->saveSanitizedHTML();
  			$html = preg_replace(array("/<!DOCTYPE[^>]*>/is","/^.*<body[^>]*>/is","/<\/body>.*$/is"),"",$html);
  			# saveHTML() insists on padding text in <p></p>
  			if(!in_array('p', $this->elemWhitelist)) {
  				$html = preg_replace('|</*p>|i', '', $html);
  			}
  			return $html;
  		}

  		private function doAttrWrap($indent) {
  			if ($this->attrWrap) {
  				return PHP_EOL.$this->doIndent($indent);
  			}
  		}

  		private function doIndent($indent) {
  			if ($this->indent) {
  				return str_repeat(' ', $indent*2);
  			}
  		}

  		private function doElemWrap() {
  			if ($this->elemWrap) {
  				return PHP_EOL;
  			}
  		}

  		function dump_nodes($node=null, $indent=null, $prevcharcount=0) {
  			if (!$indent) {
  				$indent = $this->indent;
  			}
  			if (!$node) {
  				$node = $this;
  			}
  			$elemWhitelist = $this->elemWhitelist;
  			$attrWhitelist = $this->attrWhitelist;
  			$attrValueBlacklist = $this->attrValueBlacklist;
  			$dropWithChildren = $this->dropWithChildren;
  			$html = '';
  			$charcount = $prevcharcount;
  			if($node->hasChildNodes()) {
  				foreach($node->childNodes as $child) {
  					if($child->nodeName == "#text") {
  						$t = $child->nodeValue;
  						# collapse whitespace
  						if ($this->collapseWhitespace) {
  							$t = preg_replace("/^(\s)+$/", "\\1", $t);
  						}
  						# truncate
  						if($this->maxchars > 0) {
  							$tlen = strlen($t);
  							for ($tpos = 0; $tpos < $tlen && ($charcount < $this->maxchars); ++$charcount) {
  								$c = ord($t[$tpos]);
  								$char_len = (!($c & 0x80)) ? 1 : ((($c & 0xe0) == 0xc0) ? 2 : ((($c & 0xf0) == 0xe0) ? 3 : ((($c & 0xf8) == 0xf0) ? 4 : -1)));
  								if ($char_len == -1) { // invalid utf-8 - fall back to byte-by-byte counting
  									++ $tpos;
  								} else { // character size detected
  									$tpos += $char_len;
  								}
  							}
  							# if we hit maxchars before the end of the string, cut it off from here
  							if ($tpos < $tlen) {
  								$t = substr($t, 0, $tpos);
  								$this->maxchars = -1;
  							}
  						} else if ($this->maxchars == -1) {
  							$t = '';
  						}
  						$html .= $this->doIndent($indent).$this->special($t).$this->doElemWrap();
  					} else if ($this->passthrough) {
  						# we specified we would allow any tags and attributes
  						if($this->maxchars != -1) {
  							$n = $child->nodeName;
  							$html .= "<$n";
  							if ($child->hasAttributes()) {
  								$attrs = $child->attributes;
  								foreach ($attrs as $attr) {
  									$attrValue = $attr->value;
  									$html .= " ".$attr->name."=\"".$attrValue."\"";
  								}
  							}
  							if(! $child->hasChildNodes()) {
  								$html .= " />";
  							} else {
  								$html .= ">";
  								list($h,$charcount) = $this->dump_nodes($child, $indent+1, $charcount);
  								$html.= "$h</$n>";
  							}
  						}
  					} else if (in_array($child->nodeName, $dropWithChildren)) {
  						# we do nothing but indent and prettyprint here
  						$html .= $this->doElemWrap();
  					} else if (! in_array($child->nodeName, $elemWhitelist)) {
  						list($h, $charcount) = $this->dump_nodes($child, $indent, $charcount);
  						$html.= $h;
  					} else {
  						if($this->maxchars != -1) {
  							# we only do this if we still want more content!
  							$n = $child->nodeName;
  							$html .= $this->doIndent($indent)."<$n";
  							if ($child->hasAttributes()) {
  								$attrs = $child->attributes;
  								foreach ($attrs as $attr) {
  									if(in_array($attr->name, $attrWhitelist)) {
  										$attrValue = preg_replace($attrValueBlacklist, "", $attr->value);
  										$html .= $this->doAttrWrap($indent);
  										$html .= " ".$attr->name."=\"".$attrValue."\"";
  									}
  								}
  							}
  							if(! $child->hasChildNodes()) {
  								$html .= " />".$this->doElemWrap();
  							} else {
  								$html .= ">".$this->doElemWrap();
  								list($h,$charcount) = $this->dump_nodes($child, $indent+1, $charcount);
  								$html.= $h;
  								$html.= $this->doIndent($indent)."</$n>".$this->doElemWrap();
  							}
  						}
  					}
  				}
  			}
  			if ($this->collapseWhitespace) {
  				$html = preg_replace("/(\n\s+)+/","[\n]", $html);
  			}
  			return array($html, $charcount);
  		}
  	}
?>