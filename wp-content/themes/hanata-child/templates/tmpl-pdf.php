<?php
/**
 * Template Name: PDF File
 * Post Type: page
 *
 * @package hanata
 */

get_header();


$pdf_files = get_field( 'pdf_files', 'option' );

if ( $pdf_files ): ?>
	<table class="pdf-table">
		<thead>
		<tr>
			<th>#</th>
			<th><?php  echo esc_html__( 'Назва файлу' ) ?></th>
			<th><?php  echo esc_html__( 'Скачати' ) ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $pdf_files as $index => $pdf ):
			$pdf_file = $pdf['pdf_file'];
			$pdf_title = ! empty( $pdf['pdf_title'] ) ? $pdf['pdf_title'] : 'Документ';
			?>
			<tr>
				<td><?php echo $index + 1; ?></td>
				<td><?php echo esc_html( $pdf_title ); ?></td>
				<td>
					<a href="<?php echo esc_url( $pdf_file ); ?>"
					   download="<?php echo sanitize_title( $pdf_title ); ?>.pdf">
						<?php echo esc_html( 'Завантажити PDF' ) ?>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif;

get_footer();