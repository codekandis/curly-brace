<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents an exception if a request header already exists.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class RequestHeaderExistsException extends HeaderExistsException
{
}
