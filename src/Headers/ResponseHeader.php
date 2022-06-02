<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents a request header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class ResponseHeader extends Header implements ResponseHeaderInterface
{
	/**
	 * Creates a response header from a header string.
	 * @param string $headerString The header string to create the new response header from.
	 * @return ResponseHeaderInterface The new response header.
	 */
	public static function fromHeaderString( string $headerString ): ResponseHeaderInterface
	{
		return parent::fromString( $headerString );
	}

	/**
	 * Creates a response header from a header.
	 * @param HeaderInterface $header The header to create the response header from.
	 * @return ResponseHeaderInterface The new response header.
	 */
	public static function fromHeader( HeaderInterface $header ): ResponseHeaderInterface
	{
		return parent::fromHeader( $header );
	}

	/**
	 * {@inheritDoc}
	 */
	public static function fromResponseHeader( ResponseHeaderInterface $responseHeader ): ResponseHeaderInterface
	{
		return static::fromHeader( $responseHeader );
	}
}
