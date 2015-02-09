<?php namespace CristianJaramillo\Basic\Controllers;

/**
 *
 */
class BasicController extends BaseController
{
	/**
	 *
	 * @return
	 */
	public function index()
	{
		return view('basic::layout');
	}
}