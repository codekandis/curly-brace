<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use function array_map;
use function count;
use function current;
use function implode;
use function key;
use function next;
use function reset;

/**
 * Represents a get argument collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class GetArgumentCollection implements GetArgumentCollectionInterface
{
	/**
	 * Stores the internal list of get arguments.
	 * @var GetArgumentInterface[]
	 */
	private array $getArguments = [];

	/**
	 * Constructor method.
	 * @param GetArgumentInterface[] $getArguments The initial get arguments of the collection.
	 */
	public function __construct( GetArgumentInterface ...$getArguments )
	{
		$this->add( ...$getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): GetArgumentInterface
	{
		return current( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->getArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->getArguments;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFullGetArgumentString(): string
	{
		return implode(
			'&',
			array_map(
				function ( GetArgumentInterface $getArgument )
				{
					return $getArgument->getFullGetArgumentString();
				},
				$this->getArguments
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( GetArgumentInterface ...$getArguments ): void
	{
		foreach ( $getArguments as $getArgument )
		{
			$this->getArguments[] = $getArgument;
		}
	}
}
