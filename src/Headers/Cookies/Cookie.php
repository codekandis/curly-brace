<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use DateTimeInterface;
use function sprintf;
use function trim;

/**
 * Represents the interface of any 🍪.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class Cookie implements CookieInterface
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
	 * Stores the name of the cookie.
	 * @var ?string
	 */
	private ?string $name;

	/**
	 * Stores the value of the cookie.
	 * @var ?string
	 */
	private ?string $value;

	/**
	 * Stores the maximum lifetime of the cookie.
	 * @var ?DateTimeInterface
	 */
	private ?DateTimeInterface $expires;

	/**
	 * Stores the number of seconds until the cookie expires.
	 * @var ?int
	 */
	private ?int $maxAge;

	/**
	 * Stores the host to which the cookie will be sent.
	 * @var ?string
	 */
	private ?string $domain;

	/**
	 * Stores the path that must exist in the URL to send the cookie.
	 * @var ?string
	 */
	private ?string $path;

	/**
	 * Stores whether the cookie must be sent over HTTPS only.
	 * @var ?bool
	 */
	private ?bool $secure;

	/**
	 * Stores whether cookie will be forbidden to get accessed by JavaScript.
	 * @var ?bool
	 */
	private ?bool $httpOnly;

	/**
	 * Constructor method.
	 * @param ?string $name The name of the cookie.
	 * @param ?string $value The value of the cookie.
	 * @param ?DateTimeInterface $expires The maximum lifetime of the cookie.
	 * @param ?int $maxAge The number of seconds until the cookie expires.
	 * @param ?string $domain The host to which the cookie will be sent.
	 * @param ?string $path The path that must exist in the URL to send the cookie.
	 * @param ?bool $secure Specifies whether the cookie must be sent over HTTPS only.
	 * @param ?bool $httpOnly Specifies whether cookie will be forbidden to get accessed by JavaScript.
	 * @throws CookieIsEmptyException The cookie has no name and no value.
	 */
	public function __construct( ?string $name, ?string $value, ?DateTimeInterface $expires = null, ?int $maxAge = null, ?string $domain = null, ?string $path = null, ?bool $secure = null, ?bool $httpOnly = null )
	{
		$name = null === $name
			? $name
			: trim( $name );
		$name = '' === $name
			? null
			: $name;

		$value = null === $value
			? $value
			: trim( $value );
		$value = '' === $value
			? null
			: $value;

		$domain = null === $domain
			? $domain
			: trim( $domain );
		$domain = '' === $domain
			? null
			: $domain;

		$path = null === $path
			? $path
			: trim( $path );
		$path = '' === $path
			? null
			: $path;

		$this->guardCookieData( $name, $value, $maxAge, $domain, $path );

		$this->name     = $name;
		$this->value    = $value;
		$this->expires  = $expires;
		$this->maxAge   = $maxAge;
		$this->domain   = $domain;
		$this->path     = $path;
		$this->secure   = $secure;
		$this->httpOnly = $httpOnly;
	}

	/**
	 * Creates a cookie from a cookie header value.
	 * @param string $cookieHeaderValue The cookie header value to create the cookie from.
	 * @return static The cookie created from the cookie header value.
	 * @throws CookieIsEmptyException The cookie has no name and no value.
	 * @throws InvalidCookieNameException The cookie name is invalid.
	 */
	public static function fromCookieHeaderValue( string $cookieHeaderValue ): self
	{
		$parsedCookieHeaderValue = ( new CookieHeaderValueParser( $cookieHeaderValue ) )
			->parse();

		return new static(
			$parsedCookieHeaderValue[ 'name' ],
			$parsedCookieHeaderValue[ 'value' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'Expires' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'Max-Age' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'Domain' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'Path' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'Secure' ],
			$parsedCookieHeaderValue[ 'attributes' ][ 'HttpOnly' ],
		);
	}

	/**
	 * Guards if the passed cookie name, cookie value and cookie attributes are valid.
	 * @param ?string $name The name of the cookie.
	 * @param ?string $value The value of the cookie.
	 * @param ?int $maxAge The number of seconds until the cookie expires.
	 * @param ?string $domain The host to which the cookie will be sent.
	 * @param ?string $path The path that must exist in the URL to send the cookie.
	 * @throws CookieIsEmptyException The cookie has no name and no value.
	 */
	private function guardCookieData( ?string $name, ?string $value, ?int $maxAge, ?string $domain, ?string $path ): void
	{
		if ( null === $name && null === $value )
		{
			throw new CookieIsEmptyException( static::ERROR_COOKIE_IS_EMPTY );
		}
		if ( null === $name )
		{
			throw new InvalidCookieNameException( static::ERROR_INVALID_COOKIE_NAME );
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?string
	{
		return $this->value;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getExpires(): ?DateTimeInterface
	{
		return $this->expires;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getMaxAge(): ?int
	{
		return $this->maxAge;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getDomain(): ?string
	{
		return $this->domain;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPath(): ?string
	{
		return $this->path;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSecure(): ?bool
	{
		return $this->secure;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHttpOnly(): ?bool
	{
		return $this->httpOnly;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRequestHeaderValue(): string
	{
		return sprintf(
			'%s=%s',
			$this->name,
			$this->value
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getResponseHeaderValue(): string
	{
		$responseHeaderValues = [];

		$responseHeaderValues[] = sprintf(
			'%s=%s',
			$this->name,
			$this->value
		);
		if ( null !== $this->expires )
		{
			$responseHeaderValues[] = sprintf(
				'Expires=%s',
				$this->expires->format( DateTimeInterface::RFC7231 )
			);
		}
		if ( null !== $this->maxAge )
		{
			$responseHeaderValues[] = sprintf(
				'Max-Age=%d',
				$this->maxAge
			);
		}
		if ( null !== $this->domain )
		{
			$responseHeaderValues[] = sprintf(
				'Domain=%s',
				$this->domain
			);
		}
		if ( null !== $this->path )
		{
			$responseHeaderValues[] = sprintf(
				'Path=%s',
				$this->path
			);
		}
		if ( true === $this->secure )
		{
			$responseHeaderValues[] = 'Secure';
		}
		if ( true === $this->httpOnly )
		{
			$responseHeaderValues[] = 'HttpOnly';
		}

		return implode( '; ', $responseHeaderValues );
	}
}
