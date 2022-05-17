<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

/**
 * Represents a HTTP request result.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HttpRequestResult implements HttpRequestResultInterface
{
	/**
	 * Stores the error of the request.
	 * @var ?RequestErrorInterface
	 */
	private ?RequestErrorInterface $error;

	/**
	 * Stores the response of the request.
	 * @var ?HttpResponseInterface
	 */
	private ?HttpResponseInterface $response;

	/**
	 * Constructor method.
	 * @param ?RequestErrorInterface $error The request error.
	 * @param ?HttpResponseInterface $response The request response.
	 */
	public function __construct( ?RequestErrorInterface $error, ?HttpResponseInterface $response )
	{
		$this->error    = $error;
		$this->response = $response;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getError(): ?RequestErrorInterface
	{
		return $this->error;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getResponse(): ?HttpResponseInterface
	{
		return $this->response;
	}
}
