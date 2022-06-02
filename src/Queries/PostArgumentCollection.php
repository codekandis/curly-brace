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
 * Represents a post argument collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostArgumentCollection implements PostArgumentCollectionInterface
{
	/**
	 * Stores the internal list of post arguments.
	 * @var PostArgumentInterface[]
	 */
	private array $postArguments = [];

	/**
	 * Constructor method.
	 * @param PostArgumentInterface[] $postArguments The initial post arguments of the collection.
	 */
	public function __construct( PostArgumentInterface ...$postArguments )
	{
		$this->add( ...$postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): PostArgumentInterface
	{
		return current( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->postArguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->postArguments;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFullPostArgumentString(): string
	{
		return implode(
			'&',
			array_map(
				function ( PostArgumentInterface $postArgument )
				{
					return $postArgument->getFullPostArgumentString();
				},
				$this->postArguments
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( PostArgumentInterface ...$postArguments ): void
	{
		foreach ( $postArguments as $postArgument )
		{
			$this->postArguments[] = $postArgument;
		}
	}
}
