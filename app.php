<?php

class BG {  // this is a singleton CLASS

	const VERSION = '1.0';
	const DS = DIRECTORY_SEPARATOR;
		
	public $version;
	public $baseUrl;
	public $basePath;
	public $hostname;
	public $page;  // the permalink page name used to select a custom page function
	public $pageTitle;
	public $config;  // an object that abstracts the config array
	
	
	private static $_app;  // holds the singleton class instantiation
	
	private $_pageFile;
	private $_protectedPath;
	private $_pagesPath;
	
	
	public static function createWebApplication($configFilePath) {
		if ( !self::$_app ) self::$_app = new BG($configFilePath);		
		return self::$_app;		
	}
	
	public static function app() { return self::$_app; }
	
	private function __construct($configFilePath) {
		
		// ToDo: validate $configFilePath and the array that is returned, else ERROR
		$config = include $configFilePath;
		$this->config = json_decode(json_encode($config));  // create an object from the config array
		$config = $this->config;	
		
		$this->version 	= self::VERSION;	
		$this->hostname = $_SERVER['SERVER_NAME'];			
		
		$this->basePath = preg_replace('/(.*)[\/\\\]protected[\/\\\]config[\/\\\]\w+\.php$/','$1',$configFilePath);	
		$this->baseUrl = preg_replace('/(.*)\/index.php$/','$1',$_SERVER['PHP_SELF']);
				
		$this->_protectedPath = $this->basePath.self::DS.'protected';
		$this->_pagesPath = $this->_protectedPath.self::DS.'pages';
				
		
		// parse the page name from the url
		$regex = str_replace('/','\/',strtolower($this->baseUrl));  // change /kevin/home  to \/kevin\/home		
		$this->page = preg_replace('/'.$regex.'(.*)$/','$1',strtolower($_SERVER['REQUEST_URI']));
		$this->page = substr($this->page,1);  // remove the "/" prefix
		if ( !strlen($this->page) ) $this->page = strtolower($config->homePage);
		
		
		// check if a page file of this name exists in the pages directory, else 404
		$this->_pageFile = $this->_pagesPath.self::DS.$this->page.'.php';
				
		if ( !is_file($this->_pageFile) ) {
			$this->_pageFile = $this->_pagesPath.self::DS.'404.php';
			$this->page = '404';
			header('HTTP/1.0 404 Not Found');
		}
		
		$this->page = ucfirst($this->page);  // change about to About
		$this->pageTitle = (strlen($config->siteName) ? $config->siteName.' : ' : '').$this->page;
	}
	
	
	public function buildPage() {
		//echo '<pre>'.print_r(self::app(),true).'</pre>';
		include_once $this->_pageFile;
	}
	
	public function get_header($filename='header.php') {
		include_once $this->_protectedPath.self::DS.$filename;
	}
	
	public function get_footer($filename='footer.php') {
		include_once $this->_protectedPath.self::DS.$filename;
	}
	
	
	public function link($text, $url, $htmlOptions=NULL) {
		$url = preg_match('/^http.*/',$url) ? $url : $this->baseUrl.$url;
		return '<a href="'.$url.'">'.$text.'</a>';		
	}
	
	
	public function jsParams() {  // this object is passed to bgUI.js in a data-json attribute in the html tag
		return json_encode(array(
						  'baseUrl' => $this->baseUrl,
						  'host' => $this->hostname,
						  'codeStage' => $this->config->codeStage,
						  'googleAnalytics' => array(
													 'id'=>$this->config->GoogleAnalytics->id,
													 'activate' => $this->config->GoogleAnalytics->activate ? 'true' : 'false',
													 ),
						  ));
	}
	
	
	public function html($category, $options=NULL) {
		if ( $category == 'widget' ) return self::widgetHtml($options);
		else return '';	
	}
	
	
	private static function widgetHtml($meta) {
		
		/*	returns the following structure	
		<div class="bg-widget sand">
			<h2 class="blue">Widget Title</h2>
			<div class="widgetContent padded">
				<p>Here is some sample widget content.</p>
			</div>
		</div>
		*/		
		
		$defaultMeta = array(
						'height'=>'auto',
						'padded'=>FALSE,
						'class'=>'',
						'title'=>'Title',
						'titleBackgroundColor'=>'blue',
						'widgetBackgroundColor'=>'sand',
						'imageFilename'=>false, 
						'content'=>'Content',
				  );
		
		$meta = array_merge($defaultMeta,$meta);
		
		$height = $meta['height']=='auto' ? '' : 'height:'.$meta['height'].'px;';
		$padded = $meta['padded']==TRUE ? 'padded' : '';
		$class = strlen($meta['class']) ? $meta['class'] : '';
		
		$html = array();
		$html[]  = '<div class="bg-widget '.$meta['widgetBackgroundColor'].' '.$class.'" style="'.$height.'">';
		$html[]  = '<h2 class="'.$meta['titleBackgroundColor'].'">'.$meta['title'].'</h2>';
		$html[]  = '<div class="widgetContent '.$padded.'">'.$meta['content'].'</div>';
		$html[]  = '</div>';
		
		return implode("\n",$html);
	}
	
}  // BG class
