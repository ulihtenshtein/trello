<?
class ParamsFile
{
	public function __construct($fileName = "data.json")
	{
		$this->fileName = $fileName;
	}
	
	/**
	 * Возвращает сохранённые параметры в таблице
	 * 
	 * @param string $paraName - имя параметра
	 * @return object|bool - возвращаетс асс. массив или false
	 */
	public function getParams($paramName)
	{	
		$obj = $this->getFullPaprams();
		if ($obj)
		{
			return $obj[$paramName];
		}
		return false;
	}
	
	public function updateParams($paramName, $obj)
	{
		//~ print_r($obj);
		$params = $this->getFullPaprams();
		//~ print_r($params);
		if ($params)
		{
			if ($this->fileName)
			{
				$path = Utils::dirRoot().'/'.$this->fileName;
				$params[$paramName] = $obj;
				//~ print_r($params);exit();
				$json = json_encode($params, JSON_UNESCAPED_UNICODE);
				//~ var_dump($json);
				return file_put_contents($path, $json);
			}
		}
		return false;
	}
	
	private function getFullPaprams()
	{
		$path = Utils::dirRoot().'/'.$this->fileName;
		
		if( is_file($path) )
		{
			$json = file_get_contents($path);
			
			if (strlen($json) > 0)
			{
				$obj = json_decode($json, true);
				return $obj;
			}
		}
		return false;
	}
}

class Controller
{
	public function __construct()
	{
		$this->initCache();
		$this->initCt();
		//~ $this->params = new ParamsFile();//new Params();
	}
	
    public function start()
    {
		$uri = $_SERVER["REQUEST_URI"];
		$uri = explode('?', $uri);
		$uri = $uri[0];
        $parts_tmp = explode('/', $uri);
		$this->get = $_GET;
		$furls_fragments = array();
		//~ print_r($parts_tmp);
        foreach ($parts_tmp as $part) {
            if ($part !== '') {
                $furls_fragments[] = $part;
            }
        }
        
        $action = 'index';
        
		if ( count($furls_fragments) > 0 && method_exists($this, $furls_fragments[0]) )
		{
			$action = $furls_fragments[0];
		}
		//~ $this->getParams();
		$this->$action();
		
    }
    
    public function index()
    {
		$document = Document::getInstance();
		$document->setTitle("Trello");
		$document->render("main", $this);
	}
	
	public function boardlist()
	{
		//~ echo "<br/> boardlist"; exit();
		$document = Document::getInstance();
		
		$id = $this->get['id'];
		if ($id)
		{
			$this->listId = $id;
			$this->boardlist = TrelloRequest::getList($id);
			$this->cards = TrelloRequest::getList($id,"cards");
		}
		$document->setTitle($this->boardlist['name']);
		$document->render('list', $this);
	}
	public function card()
	{
		$document = Document::getInstance();
		$id = $this->get['id'];
		if ($id)
		{
			$this->listId = $this->get['listId'];
			$this->cardId = $id;
			$this->card = TrelloRequest::getCard($id);
			$this->cardComments = TrelloRequest::getCard($id, 'actions');
		}
		$document->setTitle($this->card['name']);
		$document->render('card', $this);
		
	}
	
	private function initSessions($lifeTimeSeconds = 259200)
    {
        ini_set('session.gc_maxlifetime', $lifeTimeSeconds);
        ini_set('session.cookie_lifetime', $lifeTimeSeconds);
        session_start();
    }

    private function initCache()
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Cache-Control: post-check=0,pre-check=0", false);
        header("Cache-Control: max-age=0", false);
        header("Pragma: no-cache");
    }

    //Генерация настроек кодировки
    private function initCt()
    {
        header('Content-Type: text/html; charset=utf-8');
    }
	
	private function checkPermissin()
	{
	
		if (isset($_COOKIE["digcalc_login_token"]) && $_COOKIE["digcalc_login_token"] == "zaq1xsw2") 
		{ 
			return true;
		}
			
		return false;
	}
}

?>
