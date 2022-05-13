<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents the interface of any request header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface RequestHeaderInterface extends HeaderInterface
{
	/**
	 * Creates a request header from another request header.
	 * @param RequestHeaderInterface $requestHeader The request header to create the header from.
	 * @return RequestHeaderInterface The new request header.
	 */
	public static function fromRequestHeader( RequestHeaderInterface $requestHeader ): RequestHeaderInterface;
}
