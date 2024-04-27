<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$title     = get_field( 'title' );
$questions = get_field( 'questions' );
//title
//question
?>
<section class="faq">
	<div class="container">
		<h2 class="faq__title mwf-title--line"><?php echo $title; ?></h2>
		<div class="accordion">
			<?php foreach ( $questions as $question ) : ?>
				<div class="accordion-item">
					<div class="accordion-title"><?php echo $question['title']; ?></div>
					<div class="accordion-content">
						<p><?php echo $question['question']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
