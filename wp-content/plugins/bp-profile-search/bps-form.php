<?php

add_action ('bp_before_directory_members_tabs', 'bps_add_form');
function bps_add_form ()
{
	global $post;

	$page = $post->ID;
	if ($page == 0)
	{
		$bp_pages = bp_core_get_directory_page_ids ();
		$page = $bp_pages['members'];
	}

	$page = bps_wpml_id ($page, 'default');
	if (bp_get_current_member_type ())  $page = bp_get_current_member_type ();
	$len = strlen ((string)$page);

	$args = array (
		'post_type' => 'bps_form',
		'orderby' => 'ID',
		'order' => 'ASC',
		'nopaging' => true,
		'meta_query' => array (
			array (
				'key' => 'bps_options',
				'value' => 's:9:"directory";s:3:"Yes";',
				'compare' => 'LIKE',
			),
			array (
				'key' => 'bps_options',
				'value' => "s:6:\"action\";s:$len:\"$page\";",
				'compare' => 'LIKE',
			),
		)
	);

	$args = apply_filters ('bps_form_order', $args);
	$posts = get_posts ($args);

	foreach ($posts as $post)
	{
		$meta = bps_meta ($post->ID);
		bps_display_form ($post->ID, 'directory');
	}
}

add_action ('bps_display_form', 'bps_display_form', 10, 2);
function bps_display_form ($form, $location='')
{
	$meta = bps_meta ($form);

	if (!function_exists ('bp_locate_template'))
	{
		bps_error ('buddypress_not_active');
	}
	else if (empty ($meta['field_code']))
	{
		bps_error ('form_empty_or_nonexistent', $form);
	}
	else
	{
		bps_call_form_template ($meta['template'], array ($form, $location));
	}
}

add_shortcode ('bps_form', 'bps_show_form');
function bps_show_form ($attr, $content)
{
	ob_start ();

	if (isset ($attr['id']))
		bps_display_form ($attr['id'], 'shortcode');

	return ob_get_clean ();
}

add_shortcode ('bps_display', 'bps_show_form0');
function bps_show_form0 ($attr, $content)
{
	ob_start ();

	if (isset ($attr['form']))
		bps_display_form ($attr['form'], 'shortcode');

	return ob_get_clean ();
}

function bps_template_args ()
{
	return end ($GLOBALS['bps_template_args']);
}

function bps_call_template ($template, $args = array ())
{
	$located = bp_locate_template ($template. '.php');

	if ($located === false)
	{
		bps_error ('template_not_found', $template);
		return false;
	}

	echo "\n<!-- BP Profile Search ". BPS_VERSION. " $template -->\n";
	if (bps_debug ())
	{
		$path = str_replace (WP_CONTENT_DIR, '', $located);
		echo "<!--\n";
		echo "path $path\n";
		echo "args "; print_r ($args);
		echo "-->\n";
	}

	$GLOBALS['bps_template_args'][] = $args;
	include $located;
	array_pop ($GLOBALS['bps_template_args']);

	echo "\n<!-- BP Profile Search end $template -->\n";
	return true;
}

function bps_call_form_template ($template, $args)
{
	$template = bps_valid_template ($template);
	$located = bp_locate_template ($template. '.php');

	if ($located === false)
	{
		bps_error ('template_not_found', $template);
		return false;
	}

	$form = $args[0];
	$meta = bps_meta ($form);
	$options = isset ($meta['template_options'][$template])? $meta['template_options'][$template]: array ();

	echo "\n<!-- BP Profile Search ". BPS_VERSION. " $template -->\n";
	if (bps_debug ())
	{
		$path = str_replace (WP_CONTENT_DIR, '', $located);
		echo "<!--\n";
		echo "path $path\n";
		echo "args "; print_r ($args);
		echo "options "; print_r ($options);
		echo "-->\n";
	}

	$GLOBALS['bps_template_args'][] = $args;
	include $located;
	array_pop ($GLOBALS['bps_template_args']);

	echo "\n<!-- BP Profile Search end $template -->\n";
	return true;
}

function bps_error ($code, $data = array ())
{
	$errors = array
	(
		'template_not_found'			=> __('%1$s error: Template "%2$s" not found.', 'bp-profile-search'),
		'buddypress_not_active'			=> __('%1$s error: BuddyPress is not active.', 'bp-profile-search'),
		'form_empty_or_nonexistent'		=> __('%1$s error: Form ID "%2$d" is empty or nonexistent.', 'bp-profile-search'),
	);

	$data = (array)$data;
	$plugin = '<strong>BP Profile Search '. BPS_VERSION. '</strong>';
	array_unshift ($data, $plugin);
?>
	<p class="bps-error"><?php vprintf ($errors[$code], $data); ?></p>
<?php
}

function bps_set_wpml ($form, $code, $key, $value)
{
	if (!class_exists ('BPML_XProfile'))  return false;
	if (empty ($value))  return false;

	do_action ('wpml_register_single_string', 'Profile Search', "form {$form} {$code} {$key}", $value);
}

function bps_wpml ($form, $code, $key, $value)
{
	if (empty ($value))  return $value;

	if (class_exists ('BPML_XProfile'))
	{
		switch ($key)
		{
		case 'name':
			return apply_filters ('wpml_translate_single_string', $value, 'Buddypress Multilingual', "profile field {$code} name");
		case 'label':
			return apply_filters ('wpml_translate_single_string', $value, 'Profile Search', "form {$form} {$code} label");
		case 'description':
			return apply_filters ('wpml_translate_single_string', $value, 'Buddypress Multilingual', "profile field {$code} description");
		case 'comment':
			return apply_filters ('wpml_translate_single_string', $value, 'Profile Search', "form {$form} {$code} comment");
		case 'option':
			$option = bpml_sanitize_string_name ($value, 30);
			return apply_filters ('wpml_translate_single_string', $value, 'Buddypress Multilingual', "profile field {$code} - option '{$option}' name");
		case 'header':
			return apply_filters ('wpml_translate_single_string', $value, 'Profile Search', "form {$form} - header");
		case 'toggle form':
			return apply_filters ('wpml_translate_single_string', $value, 'Profile Search', "form {$form} - toggle form");
		}
	}
	else if (class_exists ('WPGlobus_Core'))
	{
		return WPGlobus_Core::text_filter ($value, WPGlobus::Config()->language);	
	}

	return $value;
}

function bps_wpml_id ($id, $lang='current')
{
	if (class_exists ('BPML_XProfile'))
	{
		$language = $lang == 'current'? apply_filters ('wpml_current_language', null): apply_filters ('wpml_default_language', null);
		$id = apply_filters ('wpml_object_id', $id, 'page', true, $language);
	}

	return $id;
}
