<?php            
namespace Concrete\Package\HwSimpleBlog;
use Package;
use View;
use Loader;
use Log;
use Concrete\Core\Backup\ContentImporter;
use \Concrete\Core\Page\Template;
use \Concrete\Core\Page\Feed;
use \Concrete\Core\Page\Type\Type;
use \Concrete\Core\Tree\Type\Topic;
use \Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

	protected $pkgHandle = 'hw_simple_blog';
	protected $appVersionRequired = '5.7.4';
	protected $pkgVersion = '1.0.1';
	
			
 	
	public function getPackageName() 
	{
		return t("Simple Blog setup");
	}

	public function getPackageDescription() 
	{
		return t("Recreates a simple blog as in the default Elemental theme");
	}

	public function install() 
	{
		//If a Blog Page exists then throw an exception and halt the install.
		$blogpage = \Page::getByPath('/blog');
		if(!$blogpage->isError()) {
			throw new \Exception('You already have a Blog page installed, please delete before proceeding');
		}
		
		$pkg = parent::install();
		
		    if (!is_object(Template::getByHandle('right_sidebar'))){
					$pt = Template::add('right_sidebar', 'Right Sidebar' , 'right_sidebar.png');
			}
			
			// If the a Blog type already installed, delete and recreate otherwise you get duplication issues.
			if (is_object(Type::getByHandle('blog'))){
				$pageType = Type::getByHandle('blog');
				$pageType->delete();
			}
			if (is_object(Type::getByHandle('blog_entry'))){
				$pageType = Type::getByHandle('blog_entry');
				$pageType->delete();
			}
			if (is_object(Topic:: getByName('Blog Entries'))){
			$deleteTopic = Topic:: getByName('Blog Entries');
			$deleteTopic->delete();
			}
			if (is_object(CollectionAttributeKey::getByHandle('blog_entry_topics'))){
				$pageAttribute = CollectionAttributeKey::getByHandle('blog_entry_topics');
				$pageAttribute->delete();
			}
			
			$this->insert_trees($pkg);
			$this->insert_attributes($pkg);
			$this->insert_page($pkg);
			$this->insert_feeds($pkg);
			$this->insert_pagetypes($pkg);
		
			If (is_object(Feed::getByhandle('blog'))){
				if (is_object(Type::getByHandle('blog_entry'))){
					$pageType = Type::getByHandle('blog_entry');
					$pageTypeID = $pageType->getPageTypeID();
					$editFeed = Feed::getByhandle('blog');
					$editFeed->setPageTypeID($pageTypeID);
				}
			}

			if (is_object(\Page::getByPath('blog'))){
				$deletePage = \Page::getByPath('/blog');
				$deletePage->delete();
				$this->insert_page($pkg);
			}
		return $pkg;
		
	}
	
	public function insert_feeds($pkg) {
		
		$ci = new ContentImporter();
        $ci->importContentFile($this->getPackagePath() . '/install/content_feeds.xml');
	}
	
	public function insert_pagetypes($pkg) {
		
		$ci = new ContentImporter();
        $ci->importContentFile($this->getPackagePath() . '/install/content_pagetypes.xml');
	}
	
	public function insert_page($pkg) {
		
		$ci = new ContentImporter();
        $ci->importContentFile($this->getPackagePath() . '/install/content_page.xml');
	}
	
	public function insert_attributes($pkg) {
		
		$ci = new ContentImporter();
        $ci->importContentFile($this->getPackagePath() . '/install/content_attributes.xml');
	}
	
	public function insert_trees($pkg) {
		
		$ci = new ContentImporter();
        $ci->importContentFile($this->getPackagePath() . '/install/content_trees.xml');
	}
	
	public function uninstall() {
		parent::uninstall();
		
		if (is_object(\Page::getByPath('blog'))){
			$deletePage = \Page::getByPath('/blog');
			$deletePage->delete();
		}
		If (is_object(Feed::getByhandle('blog'))){
			$deleteFeed = Feed::getByhandle('blog');
			$deleteFeed->delete();
		}
		if (is_object(Topic:: getByName('Blog Entries'))){
			$deleteTopic = Topic:: getByName('Blog Entries');
			$deleteTopic->delete();
		}
		
	}

}