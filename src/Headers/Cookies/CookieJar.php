<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers\Cookies;

use function array_reverse;
use function count;
use function current;
use function key;
use function next;
use function reset;

/**
 * Represents the base class of any 🍪 jar.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class CookieJar implements CookieJarInterface
{
	/**
	 * Stores the internal list of enitites of the cookie jar.
	 * @var CookieInterface[]
	 */
	private array $cookies = [];

	/**
	 * Constructor method.
	 * @param CookieInterface[] $cookies The initial cookies of the cookie jar.
	 */
	public function __construct( CookieInterface ...$cookies )
	{
		$this->add( ...$cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): CookieInterface
	{
		return current( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?int
	{
		return key( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->cookies;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRequestHeaderValue(): string
	{
		return implode(
			'; ',
			array_map(
				function ( CookieInterface $cookie )
				{
					return $cookie->getRequestHeaderValue();
				},
				$this->cookies
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( CookieInterface ...$cookies ): void
	{
		$this->cookies = array_merge( $this->cookies, $cookies );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findFirst( string $name ): ?CookieInterface
	{
		foreach ( $this->cookies as $cookie )
		{
			if ( $cookie->getName() === $name )
			{
				return $cookie;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findLast( string $name ): ?CookieInterface
	{
		foreach ( array_reverse( $this->cookies ) as $cookie )
		{
			if ( $cookie->getName() === $name )
			{
				return $cookie;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll( string $name ): self
	{
		$cookies = new static();
		foreach ( $this->cookies as $cookie )
		{
			if ( $cookie->getName() === $name )
			{
				$cookies->add( $cookie );
			}
		}

		return $cookies;
	}
}
