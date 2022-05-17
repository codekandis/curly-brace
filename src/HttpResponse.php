<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

use CodeKandis\CurlyBrace\Headers\Cookies\CookieJar;
use CodeKandis\CurlyBrace\Headers\Cookies\CookieJarInterface;
use CodeKandis\CurlyBrace\Headers\ResponseHeaderCollection;
use CodeKandis\CurlyBrace\Headers\ResponseHeaderCollectionInterface;

/**
 * Represents a Http response.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HttpResponse implements HttpResponseInterface
{
	/**
	 * Stores the headers.
	 * @var ResponseHeaderCollectionInterface
	 */
	private ResponseHeaderCollectionInterface $headers;

	/**
	 * Stores the cookie jar.
	 * @var CookieJarInterface
	 */
	private CookieJarInterface $cookieJar;

	/**
	 * Stores the payload.
	 * @var ?string
	 */
	private ?string $payload;

	/**
	 * {@inheritDoc}
	 */
	public function getHeaders(): ResponseHeaderCollectionInterface
	{
		return $this->headers ?? $this->headers = new ResponseHeaderCollection();
	}

	/**
	 * Sets the collection of response headers.
	 * @param ResponseHeaderCollectionInterface $headers The collection of response headers.
	 */
	public function setHeaders( ResponseHeaderCollectionInterface $headers ): void

	{
		$this->headers = $headers;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCookieJar(): CookieJarInterface
	{
		return $this->cookieJar ?? $this->cookieJar = new CookieJar();
	}

	/**
	 * Sets the cookie jar.
	 * @param CookieJarInterface $cookieJar The cookie jar.
	 */
	public function setCookieJar( CookieJarInterface $cookieJar ): void
	{
		$this->cookieJar = $cookieJar;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPayload(): ?string
	{
		return $this->payload ?? $this->payload = null;
	}

	/**
	 * Sets the payload.
	 * @param ?string $payload The payload.
	 */
	public function setPayload( ?string $payload ): void
	{
		$this->payload = $payload;
	}
}
