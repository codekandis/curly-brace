<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

/**
 * Represents the interface of any 🍪 header value parser.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CookieHeaderValueParserInterface
{
	/**
	 * Parses a cookie header value into an array with cookie name, cookie value and cookie attributes.
	 * @return array The parsed array with cookie name, cookie value and cookie attributes.
	 */
	public function parse( ): array;
}
