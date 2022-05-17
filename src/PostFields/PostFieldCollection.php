<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

use function array_map;
use function count;
use function current;
use function implode;
use function key;
use function next;
use function reset;

/**
 * Represents a post field collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostFieldCollection implements PostFieldCollectionInterface
{
	/**
	 * Stores the internal list of post fields.
	 * @var PostFieldInterface[]
	 */
	private array $postFields = [];

	/**
	 * Constructor method.
	 * @param PostFieldInterface[] $postFields The initial post fields of the collection.
	 */
	public function __construct( PostFieldInterface ...$postFields )
	{
		$this->add( ...$postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): PostFieldInterface
	{
		return current( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key(): ?string
	{
		return key( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->postFields );
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->postFields;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFullPostFieldString(): string
	{
		return implode(
			'&',
			array_map(
				function ( PostFieldInterface $postField )
				{
					return $postField->getFullPostFieldString();
				},
				$this->postFields
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( PostFieldInterface ...$postFields ): void
	{
		foreach ( $postFields as $postField )
		{
			$this->postFields[] = $postField;
		}
	}
}
