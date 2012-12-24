<?php namespace Illuminate\Foundation\Testing;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client as BaseClient;
use Symfony\Component\BrowserKit\Request as DomRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Client extends BaseClient {

	/**
	 * Convert a BrowserKit request into a Illuminate request.
	 *
	 * @param  Symfony\Component\BrowserKit\Request  $request
	 * @return Illuminate\Http\Request
	 */
	protected function filterRequest(DomRequest $request)
	{
		$httpRequest = Request::create($request->getUri(), $request->getMethod(), $request->getParameters(), $request->getCookies(), $request->getFiles(), $request->getServer(), $request->getContent());

		$httpRequest->files->replace($this->filterFiles($httpRequest->files->all()));

		return $this->prepareRequest($httpRequest);
	}

	/**
	 * Prepare the Illuminate HTTP request.
	 *
	 * @param  Illuminate\Http\Request  $request
	 * @return Illuminate\Http\Request
	 */
	protected function prepareRequest($request)
	{
		if (isset($this->kernel['session']))
		{
			$request->setSessionStore($this->kernel['session']);
		}

		return $request;
	}

}