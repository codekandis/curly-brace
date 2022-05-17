<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

use CodeKandis\CurlyBrace\Headers\Cookies\CookieJarInterface;
use CodeKandis\CurlyBrace\Headers\ResponseHeaderCollectionInterface;

/**
 * Represents the interface of any HTTP response.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HttpResponseInterface
{
	/**
	 * Gets the collection of response headers.
	 * @return ResponseHeaderCollectionInterface The collection response headers.
	 */
	public function getHeaders(): ResponseHeaderCollectionInterface;

	/**
	 * Gets the cookie jar.
	 * @return CookieJarInterface The cookie jar.
	 */
	public function getCookieJar(): CookieJarInterface;

	/**
	 * Gets the payload.
	 * @return ?string The payload if the request was successful, otherwise null.
	 */
	public function getPayload(): ?string;
}
