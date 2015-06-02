<?php

//WARNING: uploadDir will be incorrect if the user is executing a PHP file from anywhere apart from one dir up

class FileManager 
{
	
	public $uploadDir = UPLOAD_DIR;
	private $maxSize = 5000000;
	private $fileTypes = array();


	function putFile($file,$type='',$format='')
	{
	
		if ($file['size'] < $this->maxSize)
		{
			$ct = 0;
			$filename = $file['name'];
			$outputfile = $filename;
			if($type)
			{
			    if($format == 'images')
				{
					$uploaddir=$this->uploadDir . $type . "/images/";
				}
				if($format == 'media')
				{
					$uploaddir=$this->uploadDir . $type . "/media/";
				}
				if($format == 'interviewer')
				{
					$uploaddir=$this->uploadDir . $type . "/interviewer/";
				}
				if($format == 'interviewee')
				{
					$uploaddir=$this->uploadDir . $type . "/interviewee/";
				}
				if($format == 'previewmedia')
				{
					$uploaddir=$this->uploadDir . $type . "/previewmedia/";
				}
				if($format == 'transcript')
				{
					$uploaddir=$this->uploadDir . $type . "/transcript/";
				}
			}
			else
			{
				$uploaddir=$this->uploadDir;
			}
			
			/*do 
			{
				if ($ct > 0)
				{
					$outputfile = explode(".", $filename);
					$outputfile[0] .= "-" . $ct;
					$outputfile = implode(".", $outputfile);
				}
				$exists = file_exists($uploaddir . $outputfile);
				$ct++;
			} while ($exists > 0);*/
			
			move_uploaded_file($file['tmp_name'], $uploaddir . $outputfile);
		}
		return $outputfile;
	}
	function uploadFile($filename)
	{
		$file_realname = trim($_FILES[$filename]['name']);
		$uploaddir = BASE_URL;

		if (move_uploaded_file($_FILES[$filename]['tmp_name'],  $uploaddir . $file_realname)) {
		} else {
		print "<strong>$file_realname</strong> did not upload!";
		} 
	}
			
	function getFile($filename,$uploadDir)
	{
		if (file_exists($uploadDir . $filename)) 
		{
			return file_get_contents($uploadDir . $filename);
		}		
	}
	
	function showFile($filename,$uploadDir)
	{
		//determine and set mime type
		$arr_filename=explode(",",$filename);
		if(count($arr_filename)>1)
		{
			$filename=$arr_filename[count($arr_filename)-1];
		}
		else
		{
			$filename=$arr_filename[0];
		}
	
		$mime = $this->getMIMEType($filename);
		header("Content-Type: $filename");
		
		// set to download
		header("Content-Disposition: attachment; filename=$filename");
		
		//output file
		echo $this->getFile($filename,$uploadDir);

		// don't want rest of template so stop processing
		exit;
	}
	
	function showImage($filename,$uploadDir)
	{
		//determine and set mime type
		$mime = $this->getMIMEType($filename);
		header("Content-Type: $mime");
		
		//output file
		echo $this->getFile($filename);
		
		// don't want rest of template so stop processing
		exit();
	}
	
	function removeFile($filename) 
	{
		if ($filename) 
		{
			if (file_exists($this->$uploaddir . $filename)) 
			{
				@unlink($this->$uploaddir . $filename);
			}
		}
	}
	
	function getMIMEType($filename)
	{
        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

        switch(strtolower($fileSuffix[1]))
        {
            case "js" :
                return "application/x-javascript";

            case "json" :
                return "application/json";

            case "jpg" :
            case "jpeg" :
            case "jpe" :
                return "image/jpg";

            case "png" :
            case "gif" :
            case "bmp" :
            case "tiff" :
                return "image/".strtolower($fileSuffix[1]);

            case "css" :
                return "text/css";

            case "xml" :
                return "application/xml";

            case "doc" :
            case "docx" :
                return "application/msword";

            case "xls" :
            case "xlt" :
            case "xlm" :
            case "xld" :
            case "xla" :
            case "xlc" :
            case "xlw" :
            case "xll" :
                return "application/vnd.ms-excel";

            case "ppt" :
            case "pps" :
                return "application/vnd.ms-powerpoint";

            case "rtf" :
                return "application/rtf";

            case "pdf" :
                return "application/pdf";

            case "html" :
            case "htm" :
            case "php" :
                return "text/html";

            case "txt" :
                return "text/plain";

            case "mpeg" :
            case "mpg" :
            case "mpe" :
                return "video/mpeg";

            case "mp3" :
                return "audio/mpeg3";

            case "wav" :
                return "audio/wav";

            case "aiff" :
            case "aif" :
                return "audio/aiff";

            case "avi" :
                return "video/msvideo";

            case "wmv" :
                return "video/x-ms-wmv";

            case "mov" :
                return "video/quicktime";

            case "zip" :
                return "application/zip";

            case "tar" :
                return "application/x-tar";

            case "swf" :
                return "application/x-shockwave-flash";

            default :
            if(function_exists("mime_content_type"))
            {
                $fileSuffix = mime_content_type($filename);
            }

            return "unknown/" . trim($fileSuffix[0], ".");
        }
    }
	
	
}

?>