<?php

class LiteUpload{

        // allowed image file extension/s
        public static $imgExtension = '/[.gif|.jpg|.png|.jpeg]$/i';

        // allowed file extension/s other types
        public static $fileExtension = '/[.txt]$/i';
        
        public static $validMimeTypes = array(
        	'image/pjpeg',
		'image/jpeg',
		'image/gif',
		'image/x-png',
		'image/png',
		'image/bmp',
		'application/pdf',
        'application/x-pdf',
		'application/msword',
        	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'application/vnd.ms-powerpoint',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'text/html',
        'text/plain',
		'audio/mpeg',
		'audio/vnd.wave'
        );



        function __construct(){

        }// end of construct



        static function checkFile($tmpFile, $fileType){

                $result = false; // must pass file inspection to be true
                $fileType = strtolower($fileType);

                // is it an image file and with correct extension?
                // http://www.php.net/exif_imagetype
                if(($fileType == 'image' && is_int(exif_imagetype($_FILES[$tmpFile]['tmp_name'])) && preg_match(self::$imgExtension, $_FILES[$tmpFile]['name'])) ){

                        $result = true; // image file passed inspection

                }

                // other file types, beware what you allow!
                if( $fileType != 'image' && in_array($_FILES[$tmpFile]['type'], self::$validMimeTypes)){
                		$result = true; // file passed inspection
                } else {
                	p('Unsupported file type: '.$_FILES[$tmpFile]['type']);
                }

        return $result;
        }// end of checkFile



        static function maxFileSize(){

                // how big can the uploaded file be in bytes? (simple calculation)
                $maxSizeIdent = array('/K/i', '/M/i', '/G/i'); // size identifier
                        $maxSizeZero = array('', '000', '000000'); // remove identifier with zeros (K, M, G)
                                $maxFileSizeBytes = 1024 * preg_replace($maxSizeIdent, $maxSizeZero, ini_get('upload_max_filesize')); // byte size

        return $maxFileSizeBytes;
        }// end of maxFileSize



        static function upload($fieldName, $fileType = 'image', $finalDest = null, $deleteExistingFile = false){

                $result = array();
				
				//Praveen: if user has not selected the file--START
				if($_FILES[$fieldName]['tmp_name']=="")
				{
					  $result['status'] = 5;
                      $result['message'] = 'File not Selected';
					   return $result;
				}
			
                // is the file uploaded?
                // http://www.php.net/is_uploaded_file
                if( is_uploaded_file($_FILES[$fieldName]['tmp_name']) ){			

                        // allowed file type and extension?
                //praveen if( self::checkFile($fieldName, $fileType) ){
				     if( self::checkFile($fieldName, $fileType) ) {

                                // does the file already exist?
                                // http://www.php.net/file_exists
                                $finalFilename = $finalDest.'/'.$_FILES[$fieldName]['name'];
                                
                                //p($finalFilename);
                                
                                $exists = file_exists($finalFilename);
                                if ($exists && $deleteExistingFile) {
                                	unlink($finalFilename);
                                	$exists = false;
                                }
                                if(!$exists){

                                        // move the file to the final destination
                                        // http://www.php.net/move_uploaded_file

										/*echo "<br> tmp name...".$_FILES[$fieldName]['tmp_name'];
										echo "<br> field name...".$_FILES[$fieldName]['name'];
*/

                                        $result['status'] = @(int)move_uploaded_file($_FILES[$fieldName]['tmp_name'], $finalFilename);
                                        
										$result['message'] = 'Successful upload of '.$_FILES[$fieldName]['name'].' to directory '.$finalDest;

                                        // if move_uploaded_file failed
                                        if( $result['status'] === 0 ){

                                                $result['message'] = 'error - unable to move '.$_FILES[$fieldName]['name'].' to '.$finalDest;

                                        }

                                }else{

                                        $result['status'] = 4;
                                        $result['message'] = 'error - file already exist';

                                }// if = file_exists()

                        }
						else{

                                $result['status'] = 3;
                                $result['message'] = 'error - unsupported file type';

                    } // if = self::checkFile()

                }else{
                                $result['status'] = 2;
                                $result['message'] = 'error - file not uploaded or file is bigger than '.ini_get('upload_max_filesize');

                }// if = is_uploaded_file()

			/*echo "<pre>";
			print_r($result);
			exit();*/

        return $result;
        }// end of upload

		function resize($source,$destination,$max_h,$max_w)
		{
			include_once("imageresize.class.php");
		$source=realpath($source);
		$destination=realpath($destination);


		
		$size = getimagesize($source);	

		$orig_h = $size[1];
		$orig_w = $size[0];

		if ($orig_h > $max_h)
		{	
			$diff_h= $orig_h-$max_h;
		}
		if ($orig_w > $max_w)
		{	
			$diff_w= $orig_w-$max_w;
		}
		
		if($diff_h >= $diff_w)
		{
			$perct=(100*$max_h)/$orig_h;
			$max_h=$orig_h-$diff_h;
			$max_w= ($orig_w*$perct)/100;
		
		}
		elseif($diff_w >$diff_h)
		{
			$perct=(100*$max_w)/$orig_w;
			$max_w=$orig_w-$diff_w;
			$max_h= ($orig_h*$perct)/100;
		
		}
		$img = new Resize_image;		
		$img->ResizeImage($source, $destination,$max_w,$max_h);

		}


}// end of class

?>