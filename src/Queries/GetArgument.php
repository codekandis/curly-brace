<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use function http_build_query;

/**
 * Represents a get argument.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class GetArgument implements GetArgumentInterface
{
	/**
	 * Stores the get argument name.
	 * @var string
	 */
	private string $name;

	/**
	 * Stores the get argument value.
	 * @var string
	 */
	private string $value;

	/**
	 * Constructor method.
	 * @param string $name The get argument name.
	 * @param string $value The get argument value.
	 */
	public function __construct( string $name, string $value )
	{
		$this->name  = ( new GetArgumentNamePreparator() )
			->prepare( $name );
		$this->value = $value;
	}

	/**
	 * Creates a get argument from another get argument.
	 * @param GetArgumentInterface $getArgument The get argument to create the new get argument from.
	 * @return GetArgumentInterface The new get argument.
	 */
	public static function fromGetArgument( GetArgumentInterface $getArgument ): GetArgumentInterface
	{
		return new static(
			$getArgument->getName(),
			$getArgument->getValue()
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
	public function getFullGetArgumentString(): string
	{
		return http_build_query(
			[
				$this->name => $this->value
			]
		);
	}
}
