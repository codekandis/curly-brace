<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use DateTimeInterface;

/**
 * Represents the interface of any 🍪.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CookieInterface
{
	/**
	 * Gets the name of the cookie.
	 * @return ?string The name of the cookie.
	 */
	public function getName(): ?string;

	/**
	 * Gets the value of the cookie.
	 * @return ?string The value of the cookie.
	 */
	public function getValue(): ?string;

	/**
	 * Gets the maximum lifetime of the cookie.
	 * @return ?DateTimeInterface The maximum lifetime of the cookie.
	 */
	public function getExpires(): ?DateTimeInterface;

	/**
	 * Gets the number of seconds until the cookie expires.
	 * @return ?int The number of seconds until the cooie expires.
	 */
	public function getMaxAge(): ?int;

	/**
	 * Gets the host to which the cookie will be sent.
	 * @return ?string The host to which the cookie will be sent.
	 */
	public function getDomain(): ?string;

	/**
	 * Gets the path that must exist in the URL to send the cookie.
	 * @return ?string The path that must exist in the URL to send the cookie.
	 */
	public function getPath(): ?string;

	/**
	 * Gets whether the cookie must be sent over HTTPS only.
	 * @return ?bool True if the cookie must be sent over HTTPS only, otherwise false.
	 */
	public function getSecure(): ?bool;

	/**
	 * Gets whether the cookie will be forbidden to get accessed by JavaScript.
	 * @return ?bool True if the cookie will be forbidden to get accessed by JavaScript, otherwise false.
	 */
	public function getHttpOnly(): ?bool;

	/**
	 * Returns the request header value.
	 * @return string The request header value.
	 */
	public function getRequestHeaderValue(): string;

	/**
	 * Gets the response header value.
	 * @return string The response header value.
	 */
	public function getResponseHeaderValue(): string;
}
