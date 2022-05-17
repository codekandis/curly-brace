<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use LogicException;

/**
 * Represents an exception if a header does not exist.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HeaderNotFoundException extends LogicException
{
}
