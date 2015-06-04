<?php
/*
Plugin Name: OptionTree Extension: Gravity Forms
Description: Adds Option Tree fields for linking Gravity Forms to Option Tree, allowing you to select a specific form for an option.
Version: 0.2.1
Author: Jesper van Engelen
Author URI: http://www.jepps.nl
License: GPLv2 or later
*/

/**
 * Main plugin class
 *
 * @since 0.2
 */
class JWOTGF_Plugin {

	/**
	 * Constructor
	 *
	 * @since 0.2
	 */
	public function __construct() {
		// Hooks
		add_action( 'init', array( $this, 'localize' ) );
		add_filter( 'ot_option_types_array', array( $this, 'optiontree_types' ) );
	}

	/**
	 * Add Gravity Forms types to OptionTree
	 *
	 * @since 0.2
	 * @see filter:ot_option_types_array
	 */
	public function optiontree_types( $types ) {
		if ( isset( $optiontypes['gravityforms-form'] ) || ! class_exists( 'RGFormsModel' ) ) {
			return $types;
		}

		$types['gravityforms-form'] = __( 'Gravity Forms: Form', 'jwotgf' );

		asort( $types );

		return $types;
	}
	
	/**
	 * Handle localization, loading the plugin textdomain
	 *
	 * @since 0.2
	 */
	public function localize() {
		load_plugin_textdomain( 'jwotgf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

}

new JWOTGF_Plugin();

if ( ! function_exists( 'ot_type_gravityforms_form' ) ) {
	/**
	 * OptionTree option type: Gravity Forms form
	 *
	 * @since 0.2
	 *
	 * @param array $args Option field arguments
	 */
	function ot_type_gravityforms_form( $args = array() ) {
		// Whether the field has a description
		$has_description = ! empty( $args['field_description'] );
		
		// Fetch forms
		$forms = false;
		
		if ( class_exists( 'RGFormsModel' ) ) {
			$forms = RGFormsModel::get_forms( 1 );
		}
		?>
		<div class="format-setting type-gravityforms-form <?php echo $has_description ? 'has-desc' : 'no-desc'; ?>">
			<?php if ( $has_description ) : ?>
				<div class="description"><?php echo htmlspecialchars_decode( $args['field_description'] ); ?></div>
			<?php endif; ?>
			<div class="format-setting-inner">
				<?php if ( empty( $forms ) ) : ?>
					<input type="hidden" name="<?php echo esc_attr($args['field_name']); ?>" id="<?php echo esc_attr( $args['field_id'] ); ?>" value="<?php echo $args['field_value']; ?>" />
					<?php _e( 'There are no forms available.', 'jwotgf' ); ?>
				<?php else : ?>
					<select name="<?php echo esc_attr( $args['field_name'] ); ?>" id="<?php echo esc_attr( $args['field_id'] ); ?>" class="option-tree-ui-select <?php echo $args['field_class']; ?>">
						<option value="0"><?php _e( 'Please select a form', 'jwotgf' ); ?></option>
						<?php foreach ($forms as $index => $form) : ?>
							<option value="<?php echo $form->id; ?>" <?php selected( $form->id, $args['field_value'] ); ?>><?php echo $form->title; ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
?>