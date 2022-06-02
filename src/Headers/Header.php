<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents a header.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class Header implements HeaderInterface
{
	/**
	 * Stores the header name.
	 * @var string
	 */
	private string $name;

	/**
	 * Stores the header value.
	 * @var string
	 */
	private string $value;

	/**
	 * Constructor method.
	 * @param string $name The header name.
	 * @param string $value The header value.
	 */
	public function __construct( string $name, string $value )
	{
		$this->name  = ( new HeaderNamePreparator() )
			->prepare( $name );
		$this->value = ( new HeaderValuePreparator() )
			->prepare( $value );
	}

	/**
	 * Creates a header from a header.
	 * @param string $headerString The header string to create the new header from.
	 * @return HeaderInterface The new header.
	 */
	public static function fromHeaderString( string $headerString ): HeaderInterface
	{
		$preparedHeader = explode( ':', $headerString, 2 );

		return new static( $preparedHeader[ 0 ], $preparedHeader[ 1 ] );
	}

	/**
	 * Creates a header from another header.
	 * @param HeaderInterface $header The header to create the new header from.
	 * @return HeaderInterface The new header.
	 */
	public static function fromHeader( HeaderInterface $header ): HeaderInterface
	{
		return new static(
			$header->getName(),
			$header->getValue()
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFullHeaderString(): string
	{
		return sprintf(
			'%s: %s',
			$this->name,
			$this->value
		);
	}
}
