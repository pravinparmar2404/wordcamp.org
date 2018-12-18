<?php

namespace WordCamp\Blocks\Speakers;
defined( 'WPINC' ) || die();

/** @var array $attributes */
/** @var array $speakers */
/** @var array $sessions */
?>

<?php if ( ! empty( $posts ) ) : ?>
	<ul class="wordcamp-speakers-block wordcamp-speakers-block-<?php echo sanitize_html_class( $attributes['display'] ); ?> <?php echo sanitize_html_class( $attributes['className'] ); ?>">
		<?php foreach ( $speakers as $post ) : setup_postdata( $post ); ?>
			<li class="wordcamp-speaker wordcamp-speaker-<?php echo sanitize_html_class( $post->post_name ); ?>">
				<h3 class="wordcamp-speaker-name-heading">
					<?php the_title(); ?>
				</h3>

				<?php if ( true === $attributes['show_avatars'] ) : ?>
					<?php
					get_avatar(
						$post->_wcb_speaker_email,
						$attributes['avatar_size'],
						'',
						sprintf( __( 'Avatar of %s', 'wordcamporg'), get_the_title( $post ) ),
						[
							'class'         => [
								'wordcamp-speaker-avatar',
								'align-' . sanitize_html_class( $attributes['avatar_align'] )
							],
							'force_display' => true,
						]
					);
					?>
				<?php endif; ?>

				<?php if ( 'none' !== $attributes['content'] || true === $attributes['speaker_link'] ) : ?>
					<div class="wordcamp-speaker-content">
						<?php if ( 'full' === $attributes['content'] ) : ?>
							<?php the_content(); ?>
						<?php elseif ( 'excerpt' === $attributes['content'] ) : ?>
							<?php get_speaker_excerpt( $post, $attributes['excerpt_length'] ) ?>
						<?php endif; ?>

						<?php if ( true === $attributes['speaker_link'] ) : ?>
							<a class="wordcamp-speaker-more-link" href="<?php echo esc_url( get_permalink( $post ) ); ?>">
								<?php esc_html_e( 'Read more', 'wordcamporg' ) ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( true === $attributes['show_session'] && ! empty( $sessions[ $post->ID ] ) ) : ?>
					<h4 class="wordcamp-speaker-session-heading">
						<?php echo esc_html( _n( 'Session', 'Sessions', count( $sessions[ $post->ID ] ), 'wordcamporg' ) ); ?>
					</h4>

					<ul class="wordcamp-speaker-session-list">
						<?php foreach ( $sessions[ $post->ID ] as $session ) : ?>
							<li class="wordcamp-speaker-session-content">
								<a class="wordcamp-speaker-session-link" href="<?php echo esc_url( get_permalink( $session ) ); ?>">
									<?php echo get_the_title( $session ); ?>
								</a>
								<br />
								<span class="wordcamp-speaker-session-info">
									<?php if ( ! empty( $tracks = get_the_terms( $session, 'wcb_track' ) ) && ! is_wp_error( $tracks ) ) : ?>
										<?php
											printf(
												/* translators: 1: A date and time; 2: a location; */
												esc_html__( '%1$s in %2$s', 'wordcamporg' ),
												date_i18n( _x( 'l, F jS, Y \at g:i a', 'date format', 'wordcamporg' ), $session->_wcpt_session_time ),
												esc_html( $tracks[0]->name )
											);
										?>
									<?php else : ?>
										<?php echo date_i18n( _x( 'l, F jS, Y \at g:i a', 'date format', 'wordcamporg' ), $session->_wcpt_session_time ); ?>
									<?php endif; ?>
								</span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; wp_reset_postdata(); ?>
	</ul>
<?php endif; ?>