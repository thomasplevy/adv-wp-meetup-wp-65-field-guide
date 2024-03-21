<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generate unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	<?php 
	/**
	 * Activate the interactivity API on the DOM element (and it's childern).
	 * 
	 * This should be the ID of the block.
	 */
	?>
	data-wp-interactive="create-block" 
	<?php 
	/**
	 * Provides the local state used by the interactivity API
	 * 
	 * In this case we're only using the 'isOpen' property which defined in the store.
	 */
	?>
	<?php echo wp_interactivity_data_wp_context( array( 'isOpen' => false ) ); ?>
	<?php 
	/**
	 * Determines a callback to run when the state changes.
	 * 
	 * In our example the callback runs when the 'isOpen' property changes.
	 */
	?>
	data-wp-watch="callbacks.logIsOpen"
>
	<button
		<?php 
		/**
		 * Triggers the store "toggle" action when the button is clicked.
		 * 
		 * Other JS events can be bound following this same pattern, eg data-wp-on--keyup.
		 */
		?>
		data-wp-on--click="actions.toggle"
		<?php 
		/**
		 * Binds dynamic properties to the element.
		 * 
		 * In this case we're changing the "aria-expanded" property of the button element.
		 * 
		 * We could bind a classname change or any other property following this pattenr:
		 * data-wp-bind--[propertyName]
		 */
		?>	
		data-wp-bind--aria-expanded="context.isOpen"
		aria-controls="<?php echo esc_attr( $unique_id ); ?>"
	>
		<?php echo $attributes['btnText']; ?>
	</button>

	<div
		class="popup-content"
		id="<?php echo esc_attr( $unique_id ); ?>"
		<?php 
		/**
		 * Binds dynamic properties to the element.
		 * 
		 * In this case we're changing the "hidden" property of the element to be the
		 * opposite of the isOpen property of the store.
		 */
		?>	
		data-wp-bind--hidden="!context.isOpen"
	>
		<div class="popup-inner-content">
			<?php foreach( $block->inner_blocks as $innerBlock ) : ?>
				<?php echo $innerBlock->render(); ?>
			<?php endforeach; ?>
			<button
				data-wp-on--click="actions.toggle"
				data-wp-bind--aria-expanded="context.isOpen"
				aria-controls="<?php echo esc_attr( $unique_id ); ?>"
			>
				<?php _e('Close', 'adv-wp-65'); ?>
			</button>
		</div>
	</div>
</div>
