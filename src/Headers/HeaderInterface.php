<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents the interface of any header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HeaderInterface
{
	/**
	 * Gets the header name.
	 * @return string The header name.
	 */
	public function getName(): string;

	/**
	 * Gets the header value.
	 * @return string The header value.
	 */
	public function getValue(): string;

	/**
	 * Returns the stringified header.
	 * @return string The stringified header.
	 */
	public function getFullHeaderString():string;
}
