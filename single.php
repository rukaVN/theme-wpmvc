<style>
	body {
		font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	}

	table {
		border-collapse: collapse;
		border-spacing: 0;
		width: 100%;
		border: 1px solid #ddd;
	}

	th,
	td {
		text-align: left;
		padding: 8px;
		border: 1px solid #ddd;
	}

	h2 {
		text-align: center;
	}

	h4 {
		margin: 20px 0 8px 0;
		padding: 0;
	}

	a {
		text-decoration: none;
		color: #000;
		font-weight: 600;
	}

	.all_docs a {
		font-weight: normal;
		color: purple;
	}
</style>
<?php
if (have_posts()) : while (have_posts()) : the_post();
		$release_date = get_post_meta($post->ID, 'document_release_date', true);
		$effect_date = get_post_meta($post->ID, 'document_effective_date', true);
		$doc_num = get_post_meta($post->ID, 'document_number', true);
		$description = get_post_meta($post->ID, 'document_description', true);
		$doc_type = wp_get_object_terms($post->ID, 'loai-tai-lieu', array('fields' => 'names'));
		$doc_holder = wp_get_object_terms($post->ID, 'don-vi-quan-ly', array('fields' => 'names'));
		$doc_ref = get_post_meta($post->ID, 'document_references', true);
?>
		<h2><?php the_title() ?></h2>
		<h4>Thuộc tính tài liệu</h4>
		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>Số/ký hiệu</th>
					<td><?php echo $doc_num ?></td>
				</tr>
				<tr>
					<th>Mô tả</th>
					<td><?php echo $description ?></td>
				</tr>
				<tr>
					<th>Ngày ban hành</th>
					<td><?php echo $release_date ?></td>
				</tr>
				<tr>
					<th>Ngày có hiệu lực</th>
					<td><?php echo $effect_date ?></td>
				</tr>
				<tr>
					<th>Đơn vị quản lý</th>
					<td><?php echo implode(',', $doc_holder) ?></td>
				</tr>
				<tr>
					<th>Loại tài liệu</th>
					<td><?php echo implode(',', $doc_type) ?></td>
				</tr>
			</table>
		</div>
		<h4>Tài liệu liên quan</h4>
		<table>
			<?php
			foreach ($doc_ref as $key) : ?>
				<tr>
					<td>
						<a href="document/<?php $__post = get_post($key);
											echo $__post->post_name ?>">
							<?php echo get_the_title($key) . ' (' . get_post_meta($key, 'document_release_date', true) . ')' ?>
						</a>
					</td>
				</tr>
			<?php endforeach  ?>
		</table>
	<?php endwhile; ?>
<?php endif; ?>
<h4>Tất cả tài liệu</h4>
<?php
$loop = new WP_Query(array('post_type' => 'document', 'posts_per_page' => 20));
while ($loop->have_posts()) : $loop->the_post(); ?>
	<div class="all_docs">
		<div>
			<a href="document/<?php echo the_permalink_rss() ?>">
				<?php the_title() ?>
			</a>
		</div>
	</div>
<?php endwhile; ?>