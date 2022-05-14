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
 * Represents a collection of response headers.
 * @package codekandis/responseHeaders
 * @author Christian Ramelow <info@codekandis.net>
 */
class ResponseHeaderCollection implements ResponseHeaderCollectionInterface
{
	/**
	 * Stores the internal list of response headers.
	 * @var ResponseHeaderInterface[]
	 */
	private array $responseHeaders = [];

	/**
	 * Constructor method.
	 * @param ResponseHeaderInterface[] $responseHeaders The initial response headers of the collection.
	 */
	public function __construct( ResponseHeaderInterface ...$responseHeaders )
	{
		$this->add( ...$responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): ResponseHeaderInterface
	{
		return current( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->responseHeaders;
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( ResponseHeaderInterface ...$responseHeaders ): void
	{
		$this->responseHeaders = array_merge( $this->responseHeaders, $responseHeaders );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findFirst( string $name ): ?ResponseHeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( $this->responseHeaders as $responseHeader )
		{
			if ( $responseHeader->getName() === $name )
			{
				return $responseHeader;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findLast( string $name ): ?ResponseHeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( array_reverse( $this->responseHeaders ) as $responseHeader )
		{
			if ( $responseHeader->getName() === $name )
			{
				return $responseHeader;
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

		$responseHeaders = new static();
		foreach ( $this->responseHeaders as $responseHeader )
		{
			if ( $responseHeader->getName() === $name )
			{
				$responseHeaders->add( $responseHeader );
			}
		}

		return $responseHeaders;
	}
}
