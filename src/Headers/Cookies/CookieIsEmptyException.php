<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

/**
 * Represents an exception if a cookie has no name and no value.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class CookieIsEmptyException extends InvalidCookieException
{
}
