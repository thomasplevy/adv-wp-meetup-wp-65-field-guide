<?php
/** 
 * Registers a block bindings "source" for the block bindings api.
 * 
 * After registering, a paragraph block could load the copyright binding into its
 * content with the following markup:
 * 
<!-- wp:paragraph {
	"metadata":{
		"bindings":{
			"content":{
				"source":"advwp/copyright"
			}
		}
	}
} -->
<p>&Copy 2011 - $CurrentYear</p>
<!-- /wp:paragraph -->
 */
function advwp_register_block_bindings() {
    register_block_bindings_source( 'advwp/copyright', array(
        'label'              => __( 'Copyright', 'advwp' ),
		'get_value_callback' => 'advwp_copyright_binding'
    ) );
}
add_action( 'init', 'advwp_register_block_bindings' );

function advwp_copyright_binding() {
	return '&copy; 2011 - ' . date( 'Y' );
}
