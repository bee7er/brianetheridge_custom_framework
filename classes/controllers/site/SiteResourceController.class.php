<?php
/*
 * This controller is for handling requests for the admin resources
 */
class SiteResourceController extends CoreController {
	
    private static $validMimeTypes = array(
        	'image/pjpeg',
			'image/jpeg',
			'image/gif',
			'image/x-png',
			'image/png'
    );	
    
	private $_action;
    private $_parm1;
    private $_parm2;
    private $startPage;
    	
	public function __construct($action = '', $parm1 = '', $parm2 = '') {
		parent::__construct();

        if (!$_SESSION['userLoggedIn']) {
            MessageHelper::addMessage("You need to be logged in to access this page", MessageHelper::MESSAGE_TYPE_COMPLETION);
            $this->redirect('home');
        }
		$this->_action = $action;		
        $this->_parm1 = $parm1;	
        $this->_parm2 = $parm2;
	}

	public function perform()
	{
		parent::perform();

        switch($this->_action) {
            case 'edit':
                $this->editResource($this->_parm1);
                break;
            case 'create':
                $this->createResource();
                break; 
            case 'delete':
                $this->deleteResource($this->_parm1);
                break;             
            default:
                $this->displayMain();
                break;
        }		
	}

	public function displayMain()
	{	
        $this->startPage = (isset($_SESSION['resource_startPage']) ? $_SESSION['resource_startPage'] : 1);

        // Gather data
        $Resource = new Resource();
        $Paginate = new Paginate();
        $Paginate->generate($Resource, '', $this->startPage);
        $resources = $Paginate->getData();
        if ($resources) {
            foreach ($resources as &$resource) {
                // Nothing to do at present
            }
        }

        $this->_View->assign('resources', $resources);
        $this->_View->assign('paginationStr', $Paginate->getPaginationStr());
		$this->_View->assign('appMsgs', MessageHelper::getMessages());			
		
		$this->_View->assign('MenuSelected', 'Resources');
        $this->_View->assign('page', 'resources');
		$this->_View->assign('Content', $this->_View->fetch('site/resources.tpl'));
	}
    
   	private function getFormData()
	{
        $data = array();
        $imageFile = $this->getImage('image_file');
        $thumbFile = $this->getImage('thumb_file');
        $data = array('seq'=>$_POST['seq'],
            'name'=>$_POST['name'],
            'description'=>$_POST['description'],                
            'type'=>$_POST['type'],
            'url'=>$_POST['url'],
            'page_text'=>$_POST['page_text'],
            'status'=>$_POST['status']);
        if ($imageFile) {
            $data['image'] = $imageFile;
        }
        if ($thumbFile) {
            $data['thumb'] = $thumbFile;
        } 
        return $data;
	}
    
    private function setupPageVariables($mode, $record=null)
	{
        $this->_View->assign('statusList', Resource::$statusList);   
        $this->_View->assign('typeList', Resource::$typeList);
        $this->_View->assign('PAGE_TYPE', Resource::RESOURCE_TYPE_PAGE);
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
	}    
    
	public function createResource()
	{
        $Resource = new Resource();
        if (isset($_POST['update'])) {
            // Insert
            $data = $this->getFormData();
            $newResourceId = $Resource->insert($data);
            MessageHelper::addMessage("Resource '{$data['name']}' inserted with id '{$newResourceId}'", MessageHelper::MESSAGE_TYPE_COMPLETION);
            $this->redirect('resources');
        }
        // Setup common variables
        $this->setupPageVariables('insert');
        $this->_View->assign('resource', array()); 
		$this->_View->assign('Content', $this->_View->fetch('site/resource_edit.tpl'));
	} 
    
	public function editResource($resourceId)
	{
        $Resource = new Resource();
        if (isset($_POST['update'])) {
            // Update resource details
            $data = $this->getFormData();
            //pr($data);
            $Resource->update($data, array('id'=>$resourceId));
            MessageHelper::addMessage("Resource '{$data['name']}' updated", MessageHelper::MESSAGE_TYPE_COMPLETION);
            $this->redirect('resources');
        }
        // Setup common variables
        $this->setupPageVariables('edit');
        // Gather data
        $resource = $Resource->getResourceById($resourceId, $status=Resource::RESOURCE_ALL);  
        $this->_View->assign('resource', $resource); 
		$this->_View->assign('Content', $this->_View->fetch('site/resource_edit.tpl'));
	}
    
	public function deleteResource($resourceId)
	{	
        $Resource = new Resource();
        $Resource->delete($resourceId);
        MessageHelper::addMessage("Resource '{$resourceId}' deleted", MessageHelper::MESSAGE_TYPE_COMPLETION);
        $this->redirect('resource');
	}    
    
	private function getImage($imageName)
    {
//        pr(IMAGES_DIR);
        // Update resource details
        $returnImageFileName = null;
        if (isset($_FILES[$imageName]['name']) && $_FILES[$imageName]['name']) {
            if (!$this->isValidType($_FILES[$imageName]['type'])) {
                MessageHelper::addMessage('Invalid file type. Please select a gif, jpg or png image only');
                return false;					
            }	
            $newImageFileName = $_FILES[$imageName]['name'];
            $result = LiteUpload::upload($imageName, 'File', IMAGES_DIR, true);
            if ($result) {
                $returnImageFileName = $newImageFileName;
            } else {
                die('Error uploading image');		
            } 
        }
        return $returnImageFileName;
	}    

    private function isValidType($type)
	{
		if (in_array($type, self::$validMimeTypes)) {
			return true;
		}
		return false;
	}

    protected function gotoPageOnClick($page) {
        $_SESSION['resource_startPage'] = $page;
    }
}