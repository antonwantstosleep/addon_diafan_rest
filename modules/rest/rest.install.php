<?php
/**
 * Установка модуля
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

class Rest_install extends Install
{
	/**
	 * @var string название
	 */
	public $title = "REST API модулей";

	/**
	 * @var array таблицы в базе данных
	 */
	public $tables = array(
		// TODO: при необходимости
	);

	/**
	 * @var array записи в таблице {modules}
	 */
	public $modules = array(
	    array(
	        'name' => 'rest',
	        'admin' => true,
	        'site' => true,
	        'title' => 'REST API модулей'
	   ),
	);

	/**
	 * @var array меню административной части
	 */
	public $admin = array(
		// TODO: при необходимости
	);

	/**
	 * @var array страницы сайта
	 */
	public $site = array(
		// TODO: при необходимости
	);

	/**
	 * @var array настройки
	 */
	public $config = array(
		// TODO: при необходимости
	);

	/**
	 * @var array SQL-запросы
	 */
	public $sql = array(
		// TODO: при необходимости
	);

}