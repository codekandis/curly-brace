<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

/**
 * Represents the interface of any HTTP request result.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HttpRequestResultInterface
{
	/**
	 * Gets the error of the request.
	 * @return ?RequestErrorInterface The error of the request.
	 */
	public function getError(): ?RequestErrorInterface;

	/**
	 * Gets the response of the request.
	 * @return ?HttpResponseInterface The response of the request.
	 */
	public function getResponse(): ?HttpResponseInterface;
}
