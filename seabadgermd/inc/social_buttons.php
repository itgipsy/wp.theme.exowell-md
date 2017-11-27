<?php
/**
* Social button settings
*/

function seabadgermd_get_available_social_buttons () {
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

function seabadgermd_display_social_buttons() {
	?>
	<div class="social_buttons">
	<?php
	foreach (seabadgermd_get_available_social_buttons() as $id => $settings) {
		if (get_theme_mod('seabadgermd_social_' . $id . '_show', false)) {
			$url = get_theme_mod('seabadgermd_social_' . $id . '_url', '#');
			$bgcolor = get_theme_mod('seabadgermd_social_' . $id . '_bgcolor', '');
			if ($bgcolor) {
				$style='style="background-color: ' .$bgcolor . '"';
			} else {
				$style='';
			}
			?>
			<a href="<?= $url ?>" class="btn btn-round btn-social themecolor" <?= $style ?>>
				<i class="fa <?= $settings['icon'] ?>"></i>
				<span class="sr-only"><?php printf(__('%s page of this site', 'seabadgermd'), $settings['name']) ?></a>
			</a>
			<?php
		}
	}
	?>
	</div>
	<?php
}

function seabadgermd_customize_social_buttons($wp_customize) {
	$wp_customize->add_section('seabadgermd_social', array(
		'title' => __('Social links', 'seabadgermd'),
		'priority' => 30
	));
	foreach (seabadgermd_get_available_social_buttons() as $id => $settings) {
		$wp_customize->add_setting('seabadgermd_social_' . $id . '_show', array(
			'default' => false,
			'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
		));
		$wp_customize->add_control('seabadgermd_social_' . $id . '_show', array(
			'type' => 'checkbox',
			'section' => 'seabadgermd_social',
			'label' => sprintf(__('Display %s button', 'seabadgermd'), $settings['name']),
			'description' => __('Show this social button in the footer and in the social widget', 'seabadgermd')
		));
		$wp_customize->add_setting('seabadgermd_social_' . $id . '_url', array(
			'default' => 'https://',
			'sanitize_callback' => 'esc_url'
		));
		$wp_customize->add_control('seabadgermd_social_' . $id . '_url', array(
			'type' => 'text',
			'section' => 'seabadgermd_social',
			'label' => sprintf(__('%s URL', 'seabadgermd'), $settings['name'])
		));
		$wp_customize->add_setting('seabadgermd_social_' . $id . '_bgcolor', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'seabadgermd_social_' . $id . '_bgcolor',
			array(
				'label' => sprintf(__('%s button background color', 'seabadgermd'), $settings['name']),
				'section' => 'seabadgermd_social',
				'settings' => 'seabadgermd_social_' . $id . '_bgcolor'
			)
		));
	}
}

add_action( 'customize_register', 'seabadgermd_customize_social_buttons' );

function seabadgermd_sanitize_checkbox( $input ) {
	if (is_bool($input)) return $input;
	return false;
}
