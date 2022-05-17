<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

use function http_build_query;

/**
 * Represents a post field.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostField implements PostFieldInterface
{
	/**
	 * Stores the post field name.
	 * @var string
	 */
	private string $name;

	/**
	 * Stores the post field value.
	 * @var string
	 */
	private string $value;

	/**
	 * Constructor method.
	 * @param string $name The post field name.
	 * @param string $value The post field value.
	 */
	public function __construct( string $name, string $value )
	{
		$this->name  = ( new PostFieldNamePreparator() )
			->prepare( $name );
		$this->value = $value;
	}

	/**
	 * Creates a post field from another post field.
	 * @param PostFieldInterface $postField The post field to create the new post field from.
	 * @return PostFieldInterface The new post field.
	 */
	public static function fromPostField( PostFieldInterface $postField ): PostFieldInterface
	{
		return new static(
			$postField->getName(),
			$postField->getValue()
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
	public function getFullPostFieldString(): string
	{
		return http_build_query(
			[
				$this->name => $this->value
			]
		);
	}
}
