<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use function array_merge;
use function array_reverse;
use function count;
use function current;
use function key;
use function next;
use function reset;

/**
 * Represents a collection of request headers.
 * @package codekandis/requestHeaders
 * @author Christian Ramelow <info@codekandis.net>
 */
class RequestHeaderCollection implements RequestHeaderCollectionInterface
{
	/**
	 * Stores the internal list of request headers.
	 * @var RequestHeaderInterface[]
	 */
	private array $requestHeaders = [];

	/**
	 * Constructor method.
	 * @param RequestHeaderInterface[] $requestHeaders The initial request headers of the collection.
	 */
	public function __construct( RequestHeaderInterface ...$requestHeaders )
	{
		$this->add( ...$requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): RequestHeaderInterface
	{
		return current( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->requestHeaders;
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( RequestHeaderInterface ...$requestHeaders ): void
	{
		$this->requestHeaders = array_merge( $this->requestHeaders, $requestHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findFirst( string $name ): ?RequestHeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( $this->requestHeaders as $requestHeader )
		{
			if ( $requestHeader->getName() === $name )
			{
				return $requestHeader;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findLast( string $name ): ?RequestHeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( array_reverse( $this->requestHeaders ) as $requestHeader )
		{
			if ( $requestHeader->getName() === $name )
			{
				return $requestHeader;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll( string $name ): self
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		$requestHeaders = new static();
		foreach ( $this->requestHeaders as $requestHeader )
		{
			if ( $requestHeader->getName() === $name )
			{
				$requestHeaders->add( $requestHeader );
			}
		}

		return $requestHeaders;
	}
}
