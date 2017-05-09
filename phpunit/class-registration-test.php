<?php
/**
 * Blocks registration Tests
 *
 * @package Gutenberg
 */

/**
 * Test register_block
 */
class Registration_Test extends WP_UnitTestCase {
	function tearDown() {
		$GLOBALS['wp_registered_blocks'] = array();
	}

	/**
	 * Should reject numbers
	 *
	 * @expectedIncorrectUsage register_block
	 */
	function test_invalid_non_string_slugs() {
		register_block( 1, array() );
	}

	/**
	 * Should reject blocks without a namespace
	 *
	 * @expectedIncorrectUsage register_block
	 */
	function test_invalid_slugs_without_namespace() {
		register_block( 'text', array() );
	}

	/**
	 * Should reject blocks with invalid characters
	 *
	 * @expectedIncorrectUsage register_block
	 */
	function test_invlalid_characters() {
		register_block( 'still/_doing_it_wrong', array() );
	}

	/**
	 * Should accept valid block names
	 */
	function test_register_block() {
		$settings = array(
			'icon' => 'text',
		);
		$updated_settings = register_block( 'core/text', $settings );
		$this->assertEquals( $updated_settings, array(
			'icon' => 'text',
			'slug' => 'core/text',
		) );
	}

	/**
	 * Unregistering should fail if a block is not registered
	 *
	 * @expectedIncorrectUsage unregister_block
	 */
	function test_unregister_not_registered_block() {
		unregister_block( 'core/unregistered' );
	}

	/**
	 * Should unregister existing blocks
	 */
	function test_unregister_block() {
		$settings = array(
			'icon' => 'text',
		);
		register_block( 'core/text', $settings );
		$unregistered_block = unregister_block( 'core/text' );
		$this->assertEquals( $unregistered_block, array(
			'icon' => 'text',
			'slug' => 'core/text',
		) );
	}
}