<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use Countable;
use Iterator;

/**
 * Represents the interface of any 🍪 jar.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CookieJarInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of cookies in the cookie jar.
	 * @return int The amount of cookies in the cookie jar.
	 */
	public function count(): int;

	/**
	 * Gets the current cookie.
	 * @return CookieInterface The current cookie.
	 */
	public function current(): CookieInterface;

	/**
	 * Moves the internal pointer to the next cookie.
	 */
	public function next(): void;

	/**
	 * Gets the index of the current cookie.
	 * @return ?int The index of the current cookie, null if the internal pointer does not point to any cookie.
	 */
	public function key(): ?int;

	/**
	 * Determines if the current internal pointer position is valid.
	 * @return bool True if the current internal pointer position is valid, otherwise false.
	 */
	public function valid(): bool;

	/**
	 * Rewinds the internal pointer.
	 */
	public function rewind(): void;

	/**
	 * Converts the cookie jar into an array.
	 * @return array The converted array.
	 */
	public function toArray(): array;

	/**
	 * Gets the request header value of the whole cookie jar.
	 * @return string The request header value of the whole cookie jar.
	 */
	public function getRequestHeaderValue(): string;

	/**
	 * Adds cookies to the cookie jar.
	 * @param CookieInterface[] $cookies The cookies to add.
	 */
	public function add( CookieInterface ...$cookies ): void;

	/**
	 * Gets the first cookie in line by its specified name.
	 * @param string $name The name of the cookie.
	 * @return ?CookieInterface The cookie if found, otherwise null.
	 */
	public function findFirst( string $name ): ?CookieInterface;

	/**
	 * Gets the last cookie in line by its specified name.
	 * @param string $name The name of the cookie.
	 * @return ?CookieInterface The cookie if found, otherwise null.
	 */
	public function findLast( string $name ): ?CookieInterface;

	/**
	 * Gets all cookies by a specified name.
	 * @param string $name The name of the cookies.
	 * @return ?CookieJarInterface The found cookies.
	 */
	public function findAll( string $name ): self;
}
