<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use LogicException;

/**
 * Represents an exception if a cookie already exists a collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class CookieExistsException extends LogicException
{
}
