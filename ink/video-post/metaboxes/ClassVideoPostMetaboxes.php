<?php

/*Metaboxes for single video posts*/

if ( ! class_exists( 'VideoPostMetaboxes' ) ) {

	class VideoPostMetaboxes {

		public function __construct() {
			add_action( 'load-post.php', array( &$this, 'video_metaboxes_setup' ) );
			add_action( 'load-post-new.php', array( &$this, 'video_metaboxes_setup' ) );
		}

		public function video_metaboxes_setup() {
			add_action( 'add_meta_boxes', array( &$this, 'add_video_metaboxes' ) );
			add_action( 'save_post', array( &$this, 'video_source_embed_save' ) );
		}

		public function add_video_metaboxes() {
			add_meta_box(
				'video_source_embed',
				esc_html__( 'Embed video source', 'wpbootstrap' ),
				array( &$this, 'video_source_embed_render' ),
				'video',
				'normal',
				'default'
			);
		}

		public function video_source_embed_render( $object, $box ) { ?>

			<?php wp_nonce_field( 'post_embed_source', 'video_embed_nonce' ); ?>

			<p>
				<label for="embed-source"><?php esc_html_e( "Insert link to embed source of featured video", 'wpbootstrap' ); ?></label>
				<input class="widefat" type="text" name="embed-source" id="embed-source" value="<?php echo esc_attr( get_post_meta( $object->ID, 'video_source_embed', true ) ); ?>" size="30" />
			</p>
		<?php }

		public function video_source_embed_save( $post_id ) {

			if ( ! isset( $_POST['video_embed_nonce'] ) ) {
				return $post_id;
			}

			$nonce = $_POST['video_embed_nonce'];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'post_embed_source' ) ) {
				return $post_id;
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}


			$embed_source = sanitize_text_field( $_POST['embed-source'] );

			// Update the meta field.
			update_post_meta( $post_id, 'video_source_embed', $embed_source );
		}
	}

}

if ( class_exists( 'VideoPostMetaboxes' ) ) {
	$VideoPostMetaboxes = new VideoPostMetaboxes;
}