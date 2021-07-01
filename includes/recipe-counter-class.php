<?php 
/**
 * Adds Recipe_Counter_widget.
 */
class Recipe_Counter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'recipe-counter', // Base ID
			esc_html__( 'Recipe Counter', 'recipe-counter' ), // Name
			array( 'description' => __( 'A widget to display the recipe count from multiple categories', 'recipe-counter' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // Whatever you want to add before the widget (<div>, etc)

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
    ?>
	
    <!-- Widget content output -->
    <div class="recipe-counter-container">
      <h3 class="recipe-counter-container__heading">
        <?php esc_html_e( 'Here&#39;s what you can find in our archive of recipes for the following categories', 'recipe-counter' ); ?>
	</h3>

			<!-- Category 1 -->
      <div class="recipe-counter-container__item">
				
				<hr class="recipe-counter-container__hr" />

        <div class="recipe-counter-container__category">
					<?php $cat1 = get_cat_ID( $instance[ 'category1' ] ); ?>
					<?php $cat1_name = get_cat_name( $cat1 ); ?>
					<?php $cat1_cat = get_category( $cat1 ); ?>
					<?php $cat1_count = $cat1_cat->count; ?>

					<p>
						<span>
							<a href="<?php echo get_category_link( $cat1 ); ?>"><?php echo $cat1_name; ?></a>
						</span>
						<span>
							<?php echo _e( 'Recipes: ') . $cat1_count; ?>
						</span>
					</p>

					<?php $cat1_args = [
						'posts_per_page'		=> 3,
						'post_type'					=> 'ssc_recipes',
						'cat'								=> $cat1
					]; ?>

					<div class="recipe-counter-container__images">
						<?php $cat1_query = new WP_Query( $cat1_args );
							if($cat1_query->have_posts() ) : 
								while($cat1_query->have_posts() ) :
									$cat1_query->the_post(); ?>
										<div class="recipe-counter-container__img">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
										</div><!-- .recipe-counter-container__img -->
								<?php
								endwhile;
							endif;
							wp_reset_postdata(); 
						?>
					</div><!-- .recipe-counter-container__images -->
				</div><!-- .recipe-counter-container__category -->
      </div><!-- .recipe-counter-container__item -->

			<!-- Category 2 -->
      <div class="recipe-counter-container__item">
        <p class="recipe-counter-container__category">
					<?php $cat2 = get_cat_ID( $instance[ 'category2' ] ); ?>
					<?php $cat2_name = get_cat_name( $cat2 ); ?>
					<?php $cat2_cat = get_category( $cat2 ); ?>
					<?php $cat2_count = $cat2_cat->count; ?>
					<?php _e( 'Currently there are ' ); ?> <?php echo $cat2_count; ?> <?php _e( 'recipes categorized under ' ); ?> <a href="<?php echo get_category_link( $cat2 ); ?>"><?php echo $cat2_name; ?></a>
				</p>
      </div>

			<!-- Category 3 -->
      <div class="recipe-counter-container__item">
        <p class="recipe-counter-container__category">
					<?php $cat3 = get_cat_ID( $instance[ 'category3' ] ); ?>
					<?php $cat3_name = get_cat_name( $cat3 ); ?>
					<?php $cat3_cat = get_category( $cat3 ); ?>
					<?php $cat3_count = $cat3_cat->count; ?>
					<?php _e( 'Currently there are ' ); ?> <?php echo $cat3_count; ?> <?php _e( 'recipes categorized under ' ); ?> <a href="<?php echo get_category_link( $cat3 ); ?>"><?php echo $cat3_name; ?></a>
				</p>
      </div>

			<!-- Category 4 -->
      <div class="recipe-counter-container__item">
        <p class="recipe-counter-container__category">
					<?php $cat4 = get_cat_ID( $instance[ 'category4' ] ); ?>
					<?php $cat4_name = get_cat_name( $cat4 ); ?>
					<?php $cat4_cat = get_category( $cat4 ); ?>
					<?php $cat4_count = $cat4_cat->count; ?>
					<?php _e( 'Currently there are ' ); ?> <?php echo $cat4_count; ?> <?php _e( 'recipes categorized under ' ); ?> <a href="<?php echo get_category_link( $cat4 ); ?>"><?php echo $cat4_name; ?></a>
				</p>
      </div>

    </div><!-- .recipe-counter-container -->

    <?php
		echo $args['after_widget']; // Whatever you want to add after the widget (</div>, etc)
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recipe Counter', 'recipe-counter' );

		$category1 = ! empty( $instance['category1'] ) ? $instance['category1'] : esc_html__( '', 'recipe-counter' );

		$category2 = ! empty( $instance['category2'] ) ? $instance['category2'] : esc_html__( '', 'recipe-counter' );

		$category3 = ! empty( $instance['category3'] ) ? $instance['category3'] : esc_html__( '', 'recipe-counter' );

		$category4 = ! empty( $instance['category4'] ) ? $instance['category4'] : esc_html__( '', 'recipe-counter' );

		
		?>

		<!-- TITLE -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php esc_attr_e( 'Title:', 'recipe-counter' ); ?>
		</label> 

		<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $title ); ?>">
		</p>

		<!-- CATEGORY 1 -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category1' ) ); ?>">
			<?php esc_attr_e( 'Category 1:', 'recipe-counter' ); ?>
		</label> 

		<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'category1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category1' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $category1 ); ?>">
		</p>

		<!-- CATEGORY 2 -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category2' ) ); ?>">
			<?php esc_attr_e( 'Category 2:', 'recipe-counter' ); ?>
		</label> 

		<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'category2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category2' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $category2 ); ?>">
		</p>

		<!-- CATEGORY 3 -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category3' ) ); ?>">
			<?php esc_attr_e( 'Category 3:', 'recipe-counter' ); ?>
		</label> 

		<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'category3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category3' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $category3 ); ?>">
		</p>

		<!-- CATEGORY 4 -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category4' ) ); ?>">
			<?php esc_attr_e( 'Category 4:', 'recipe-counter' ); ?>
		</label> 

		<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'category4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category4' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $category4 ); ?>">
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		$instance['category1'] = ( ! empty( $new_instance['category1'] ) ) ? sanitize_text_field( $new_instance['category1'] ) : '';

		$instance['category2'] = ( ! empty( $new_instance['category2'] ) ) ? sanitize_text_field( $new_instance['category2'] ) : ''; 

		$instance['category3'] = ( ! empty( $new_instance['category3'] ) ) ? sanitize_text_field( $new_instance['category3'] ) : '';

		$instance['category4'] = ( ! empty( $new_instance['category4'] ) ) ? sanitize_text_field( $new_instance['category4'] ) : '';

		return $instance;
	}

} // class Recipe_Counter_Widget