<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use DateTimeImmutable;
use DateTimeInterface;
use function array_pad;
use function explode;
use function preg_match;
use function strpos;
use function strtolower;
use function substr;
use function trim;

/**
 * Represents a 🍪 header value parser.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class CookieHeaderValueParser implements CookieHeaderValueParserInterface
{
	/**
	 * Represents the error message if a cookie has no name and no value.
	 * @var string
	 */
	protected const ERROR_COOKIE_IS_EMPTY = 'The cookie has no name and no value.';

	/**
	 * Represents the error message if the cookie name is invalid.
	 * @var string
	 */
	protected const ERROR_INVALID_COOKIE_NAME = 'The cookie name is invalid. A `non-empty string` is expected.';

	/**
	 * Stores the cookie header value to parse.
	 * @var string
	 */
	private string $cookieHeaderValue;

	/**
	 * Constructor method.
	 * @param string $cookieHeaderValue The cookie header value to parse.
	 */
	public function __construct( string $cookieHeaderValue )
	{
		$this->cookieHeaderValue = $cookieHeaderValue;
	}

	/**
	 * {@inheritDoc}
	 * @throws CookieIsEmptyException The cookie has no name and no value.
	 * @throws InvalidCookieNameException The cookie name is invalid.
	 */
	public function parse(): array
	{
		$parsedCookieHeaderValue = [
			'name'       => null,
			'value'      => null,
			'attributes' => [
				'Expires'  => null,
				'Max-Age'  => null,
				'Domain'   => null,
				'Path'     => null,
				'Secure'   => null,
				'HttpOnly' => null
			]
		];

		foreach ( explode( ';', $this->cookieHeaderValue ) as $index => $keyValuePair )
		{
			$keyValuePair = trim( $keyValuePair );

			if ( 0 === $index )
			{
				if ( '' === $keyValuePair || '=' === $keyValuePair )
				{
					throw new CookieIsEmptyException( static::ERROR_COOKIE_IS_EMPTY );
				}

				if ( false === strpos( $keyValuePair, '=' ) )
				{
					throw new InvalidCookieNameException( static::ERROR_INVALID_COOKIE_NAME );
				}
			}

			[
				$key,
				$value
			] = array_pad(
				explode( '=', $keyValuePair ),
				2,
				null
			);

			$key = trim( $key );
			$key = '' === $key
				? null
				: $key;

			$value = null === $value
				? $value
				: trim( $value );
			$value = '' === $value
				? null
				: $value;

			if ( 0 === $index )
			{
				if ( null === $key )
				{
					throw new InvalidCookieNameException( static::ERROR_INVALID_COOKIE_NAME );
				}

				$parsedCookieHeaderValue[ 'name' ]  = $key;
				$parsedCookieHeaderValue[ 'value' ] = $value;

				continue;
			}

			if ( null === $key )
			{
				continue;
			}

			$key = strtolower( $key );

			if ( 'expires' === $key )
			{
				if ( null !== $value && false !== $expiresTimestamp = DateTimeImmutable::createFromFormat( DateTimeInterface::RFC7231, $value ) )
				{
					$parsedCookieHeaderValue[ 'attributes' ][ 'Expires' ] = $expiresTimestamp;
				}

				continue;
			}
			if ( 'max-age' === $key )
			{
				if ( null !== $value && 1 === preg_match( '~^-?[0-9]+$~', $value ) )
				{
					$parsedCookieHeaderValue[ 'attributes' ][ 'Max-Age' ] = (int) $value;
				}

				continue;
			}
			if ( 'domain' === $key )
			{
				if ( null !== $value )
				{
					while ( '.' === $value[ 0 ] )
					{
						$value = substr( $value, 1 );
					}

					if ( '' !== $value )
					{
						$parsedCookieHeaderValue[ 'attributes' ][ 'Domain' ] = strtolower( $value );
					}
				}

				continue;
			}
			if ( 'path' === $key )
			{
				if ( null !== $value && '/' === $value[ 0 ] )
				{
					$parsedCookieHeaderValue[ 'attributes' ][ 'Path' ] = $value;
				}

				continue;
			}
			if ( 'secure' === $key )
			{
				$parsedCookieHeaderValue[ 'attributes' ][ 'Secure' ] = true;

				continue;
			}
			if ( 'httponly' === $key )
			{
				$parsedCookieHeaderValue[ 'attributes' ][ 'HttpOnly' ] = true;

				continue;
			}
		}

		return $parsedCookieHeaderValue;
	}
}
