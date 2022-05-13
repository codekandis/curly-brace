<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents a request header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class RequestHeader extends Header implements RequestHeaderInterface
{
	/**
	 * Creates a request header from a header string.
	 * @param string $headerString The header string to create the new request header from.
	 * @return RequestHeaderInterface The new request header.
	 */
	public static function fromString( string $headerString ): RequestHeaderInterface
	{
		return parent::fromHeader( $headerString );
	}

	/**
	 * Creates a request header from a header.
	 * @param HeaderInterface $header The header to create the request header from.
	 * @return RequestHeaderInterface The new request header.
	 */
	public static function fromHeader( HeaderInterface $header ): RequestHeaderInterface
	{
		return parent::fromHeader( $header );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function fromRequestHeader( RequestHeaderInterface $requestHeader ): RequestHeaderInterface
	{
		return parent::fromHeader( $requestHeader );
	}
}
