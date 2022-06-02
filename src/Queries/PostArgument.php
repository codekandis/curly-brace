<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use function http_build_query;

/**
 * Represents a post argument.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostArgument implements PostArgumentInterface
{
	/**
	 * Stores the post argument name.
	 * @var string
	 */
	private string $name;

	/**
	 * Stores the post argument value.
	 * @var string
	 */
	private string $value;

	/**
	 * Constructor method.
	 * @param string $name The post argument name.
	 * @param string $value The post argument value.
	 */
	public function __construct( string $name, string $value )
	{
		$this->name  = ( new PostArgumentNamePreparator() )
			->prepare( $name );
		$this->value = $value;
	}

	/**
	 * Creates a post argument from another post argument.
	 * @param PostArgumentInterface $postArgument The post argument to create the new post argument from.
	 * @return PostArgumentInterface The new post argument.
	 */
	public static function fromPostArgument( PostArgumentInterface $postArgument ): PostArgumentInterface
	{
		return new static(
			$postArgument->getName(),
			$postArgument->getValue()
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
	public function getFullPostArgumentString(): string
	{
		return http_build_query(
			[
				$this->name => $this->value
			]
		);
	}
}
