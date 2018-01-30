<?php

namespace functions\template_tags;

use Tribe\Events\Tests\Testcases\Events_TestCase;

class organizerTest extends Events_TestCase {

	/**
	 * It should allow getting found posts when querying organizers
	 *
	 * @test
	 */
	public function should_allow_getting_found_posts_when_querying_organizers() {
		$this->factory()->organizer->create_many( 5 );

		$this->assertEquals( 5, tribe_get_organizers( false, - 1, true, [ 'found_posts' => true ] ) );
	}

	public function truthy_and_falsy_values() {
		return [
			[ 'true', true ],
			[ 'true', true ],
			[ '0', false ],
			[ '1', true ],
			[ 0, false ],
			[ 1, true ],
		];

	}

	/**
	 * It should allow truthy and falsy values for the found_posts argument
	 *
	 * @test
	 * @dataProvider truthy_and_falsy_values
	 */
	public function should_allow_truthy_and_falsy_values_for_the_found_posts_argument( $found_posts, $bool ) {
		$this->factory()->organizer->create_many( 5 );

		$this->assertEquals(
			tribe_get_organizers( false, - 1, true, [ 'found_posts' => $found_posts ] ),
			tribe_get_organizers( false, - 1, true, [ 'found_posts' => $bool ] )
		);
	}

	/**
	 * It should override posts_per_page and paged arguments when using found_posts
	 *
	 * @test
	 */
	public function should_override_posts_per_page_and_paged_arguments_when_using_found_posts() {
		$this->factory()->organizer->create_many( 5 );

		$found_posts = tribe_get_organizers( false, - 1, true, [ 'found_posts' => true, 'paged' => 2 ] );

		$this->assertEquals( 5, $found_posts );
	}

	/**
	 * It should return 0 when no posts are found and found_posts is set
	 *
	 * @test
	 */
	public function should_return_0_when_no_posts_are_found_and_found_posts_is_set() {
		$found_posts = tribe_get_organizers( false, - 1, true, [ 'found_posts' => true] );

		$this->assertEquals( 0, $found_posts );
	}
}