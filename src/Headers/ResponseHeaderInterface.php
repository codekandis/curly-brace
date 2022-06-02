<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents the interface of any response header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ResponseHeaderInterface extends HeaderInterface
{
	/**
	 * Creates a response header from another response header.
	 * @param ResponseHeaderInterface $responseHeader The response header to create the header from.
	 * @return ResponseHeaderInterface The new response header.
	 */
	public static function fromResponseHeader( ResponseHeaderInterface $responseHeader ): ResponseHeaderInterface;
}
