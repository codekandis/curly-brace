<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use function count;
use function current;
use function key;
use function next;
use function reset;

/**
 * Represents a collection of headers.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HeaderCollection implements HeaderCollectionInterface
{
	/**
	 * Stores the internal list of headers.
	 * @var HeaderInterface[]
	 */
	private array $headers = [];

	/**
	 * Constructor method.
	 * @param HeaderInterface[] $headers The initial headers of the collection.
	 */
	public function __construct( HeaderInterface ...$headers )
	{
		$this->add( ...$headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): HeaderInterface
	{
		return current( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->headers;
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( HeaderInterface ...$headers ): void
	{
		$this->headers = array_merge( $this->headers, $headers );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findFirst( string $name ): ?HeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( $this->headers as $header )
		{
			if ( $header->getName() === $name )
			{
				return $header;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findLast( string $name ): ?HeaderInterface
	{
		$name = ( new HeaderNamePreparator() )
			->prepare( $name );

		foreach ( array_reverse( $this->headers ) as $header )
		{
			if ( $header->getName() === $name )
			{
				return $header;
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

		$headers = new static();
		foreach ( $this->headers as $header )
		{
			if ( $header->getName() === $name )
			{
				$headers->add( $header );
			}
		}

		return $headers;
	}
}
