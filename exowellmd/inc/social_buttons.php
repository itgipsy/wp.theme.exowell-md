<?php
/**
* Social button settings
*/

function get_available_social_buttons () {
	return array(
		'facebook' => array(
			'name' => 'Facebook',
			'icon' => 'fa-facebook'
		),
		'twitter' => array(
			'name' => 'Twitter',
			'icon' => 'fa-twitter'
		),
		'google-plus' => array(
			'name' => 'Google+',
			'icon' => 'fa-google-plus'
		),
		'linkedin' => array(
			'name' => 'LinkedIn',
			'icon' => 'fa-linkedin'
		),
		'instagram' => array(
			'name' => 'Instagram',
			'icon' => 'fa-instagram'
		),
		'pinterest' => array(
			'name' => 'Pinterest',
			'icon' => 'fa-pinterest'
		),
		'youtube' => array(
			'name' => 'YouTube',
			'icon' => 'fa-youtube'
		),
		'dribbble' => array(
			'name' => 'Dribbble',
			'icon' => 'fa-dribbble'
		),
		'vk' => array(
			'name' => 'VK',
			'icon' => 'fa-vk'
		),
		'stack-overflow' => array(
			'name' => 'Stack Overflow',
			'icon' => 'fa-stack-overflow'
		),
		'slack' => array(
			'name' => 'Slack',
			'icon' => 'fa-slack'
		),
		'github' => array(
			'name' => 'GitHub',
			'icon' => 'fa-github'
		),
		'comments' => array(
			'name' => 'Comments',
			'icon' => 'fa-comments'
		),
		'email' => array(
			'name' => 'Email',
			'icon' => 'fa-envelope'
		)
	);
}

function display_social_buttons() {
	?>
	<div class="social_buttons">
	<?php
	foreach (get_available_social_buttons() as $id => $settings) {
		if (get_theme_mod('social_' . $id . '_show', false)) {
			$url = get_theme_mod('social_' . $id . '_url', '#');
			$bgcolor = get_theme_mod('social_' . $id . '_bgcolor', '');
			if ($bgcolor) {
				$style='style="background-color: ' .$bgcolor . '"';
			} else {
				$style='';
			}
			?>
			<a href="<?= $url ?>" class="btn btn-round btn-social themecolor" <?= $style ?>>
				<i class="fa <?= $settings['icon'] ?>"></i>
				<span class="sr-only"><?= __($settings['name'] . ' page of this site')?></a>
			</a>
			<?php
		}
	}
	?>
	</div>
	<?php
}

function customize_social_buttons($wp_customize) {
	$wp_customize->add_section('social', array(
		'title' => __('Social links'),
		'priority' => 30
	));
	foreach (get_available_social_buttons() as $id => $settings) {
		$wp_customize->add_setting('social_' . $id . '_show', array(
			'default' => false,
			'type' => 'theme_mod'
		));
		$wp_customize->add_control('social_' . $id . '_show', array(
			'type' => 'checkbox',
			'section' => 'social',
			'label' => __('Display ' . $settings['name'] . ' button'),
			'description' => __('Show this social button in the footer and in the social widget')
		));
		$wp_customize->add_setting('social_' . $id . '_url', array(
			'default' => 'https://',
			'type' => 'theme_mod'
		));
		$wp_customize->add_control('social_' . $id . '_url', array(
			'type' => 'text',
			'section' => 'social',
			'label' => __($settings['name'] . ' URL')
		));
		$wp_customize->add_setting('social_' . $id . '_bgcolor', array(
			'default' => '',
			'type' => 'theme_mod'
		));
		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'social_' . $id . '_bgcolor',
			array(
				'label' => __($settings['name'] . ' button background color'),
				'section' => 'social',
				'settings' => 'social_' . $id . '_bgcolor'
			)
		));
	}
}

add_action( 'customize_register', 'customize_social_buttons' );
