<?php
/**
 * REST API модулей
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
	}
	include $path.'/includes/404.php';
}

class Rest_api extends Api
{
	/**
	 * Конструктор класса
	 *
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		parent::__construct($diafan);
	}

	/**
	 * Определение свойств класса
	 *
	 * @return void
	 */
	public function variables()
	{
		$this->page_404 = true;
		$this->$only_https = true;

		// Новые свойства
		$this->http_method = getenv('REQUEST_METHOD');
		$this->working_module = $this->method;
		$this->endpoint = $_GET["rewrite"]; // TODO: что за костыль

		// Новые ошибки
		$this->errors["module_not_implemented"] = "Модуль не реализован.";
		$this->errors["endpoint_not_implemented"] = "Эндпоинт не реализован.";
		$this->errors["http_method_not_implemented"] = "Метод HTTP не реализован.";
		$this->errors["http_method_not_supported"] = "Метод HTTP не поддерживается.";
	}

	/**
	 * Инициализация API модуля
	 *
	 * @return void
	 */
	public function init()
	{

		if(! $this->is_auth() || ! $this->user->id)
		{
			$this->set_error("wrong_token");
		}
		if($this->result())
		{
			return;
		}

		switch($this->working_module)
		{

			case 'shop': // TODO: case 'модуль, который установлен на сайте'

				switch($this->endpoint)
				{
					case 'elements':
						$this->shop_elements();
						break;

					default:
						$this->set_error("endpoint_not_implemented");
						break;
				}
				break;

			default:
				$this->set_error("module_not_implemented");
				break;

		}

	}

	/**
	 * Например, Работа с товарами
	 * Например, https://site.ru/api/rest/shop/elements
	 *
	 * @return void
	 */
	private function shop_elements()
	{

		// TODO: сделать функцию универсальной (shop, news и т.д.)

		switch($this->http_method)
		{
			case 'GET':

				// TODO: получать все колонки, что есть в таблице
				// таблицу брать из запроса

				$q = "SELECT id, [name] FROM {shop} WHERE [act]='1' AND trash='0'";

				// TODO: устанавливать фильтры по всем параметрам из запроса

				if($cat_id = $this->diafan->filter($_GET, 'int', 'cat_id'))
				{
					$q .= " AND cat_id=".$cat_id;
				}

				if($limit = $this->diafan->filter($_GET, 'int', 'limit'))
				{
					$q .= " LIMIT ".$limit;
				}

				$data = DB::query_fetch_all($q);

				$this->result['result']['elements'] = $data;
				break;

			case 'POST':
			case 'PUT':
			case 'PATCH':
				// TODO: создавать / править товары
				// со всеми плюшками (доп. параметрами, картой сайта)
				$this->set_error("http_method_not_implemented");
				break;

			case 'DELETE':
				// TODO: корректно удалять товары в корзину
				$this->set_error("http_method_not_implemented");
				break;

			case 'OPTIONS':
				// TODO: отдавать структуру таблицы с описаниями типов данных
				$this->set_error("http_method_not_implemented");
				break;

			default:
				$this->set_error("http_method_not_supported");
				break;
		}

	}
}
