<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

use CodeKandis\CurlyBrace\Headers\Cookies\CookieJarInterface;
use CodeKandis\CurlyBrace\Headers\RequestHeaderCollectionInterface;
use CodeKandis\CurlyBrace\Queries\PostArgumentCollectionInterface;

/**
 * Represents the interface of any HTTP request.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HttpRequestInterface
{
	/**
	 * Gets the collection of request headers.
	 * @return RequestHeaderCollectionInterface The collection request headers.
	 */
	public function getHeaders(): RequestHeaderCollectionInterface;

	/**
	 * Gets the cookie jar.
	 * @return CookieJarInterface The cookie jar.
	 */
	public function getCookieJar(): CookieJarInterface;

	/**
	 * Gets the HTTP request method.
	 * @return string The HTTP request method.
	 */
	public function getHttpRequestMethod(): string;

	/**
	 * Gets the collection of post arguments.
	 * @return PostArgumentCollectionInterface The collection of post arguments.
	 */
	public function getPostArguments(): PostArgumentCollectionInterface;

	/**
	 * Adds additional cURL options.
	 * @param array $curlOptions The cURL options to add.
	 */
	public function addCurlOptions( array $curlOptions ): void;

	/**
	 * Sends the request and returns the request result.
	 * @return HttpRequestResultInterface The request result.
	 */
	public function send(): HttpRequestResultInterface;
}
