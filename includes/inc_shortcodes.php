<?php
/* VerveThemes Shortcodes 
 * Author: VerveThemes
 * Version:2.0
 */

/*------------------------------------------------------------------------*/
/* 	Layout
/*------------------------------------------------------------------------*/

function vtsc_section( $atts, $content = null ) {
   extract(shortcode_atts(array(	'bgcolor' 		=> '#f9f9f9',
									'bgimage' 		=> '',
									'parallax'		=> 'yes'
									), $atts));

   	if ($bgimage != NULL) { $style = 'style="background-image: url('.$bgimage.');"';} 
	else if ($bgcolor != NULL) { $style = 'style="background-color: '.$bgcolor.';"'; }
	
	if ($parallax == 'yes') { $parallax = ' scroll-in';} else { $parallax = '';}
	
	return '<div class="row-container'.$parallax.'" '.$style.'><div class="container">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'vtsc_section', 'vtsc_section' );

function vtsc_row( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="row vtsc-row one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'vtsc_row', 'vtsc_row' );

function vtsc_one_half( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="col-md-12 col-xs-24">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_half', 'vtsc_one_half' );


function vtsc_one_third( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="col-md-8 col-xs-24">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_third', 'vtsc_one_third' );

function vtsc_two_third( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="col-md-16 col-xs-24">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'two_third', 'vtsc_two_third' );

function vtsc_one_fourth( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="col-md-6 col-xs-24">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_fourth', 'vtsc_one_fourth' );

function vtsc_three_fourth( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));

   return '<div class="col-md-18 col-xs-24">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'three_fourth', 'vtsc_three_fourth' );

/*------------------------------------------------------------------------*/
/* 	Notification boxes
/*------------------------------------------------------------------------*/

function vtsc_notif( $atts, $content = null ) {
   extract(shortcode_atts(array(	'type' 			=> 'alert-info',
									'closebutton' 	=> 'yes',
									'icon'			=> ''
									), $atts));
	if($icon=='') { $icon = false; }
	else if($icon=='keep-default') {
		if ($type=='alert-info') { $icon = '<i class="notify-icon fa fa-info-circle"></i>'; }
		if ($type=='alert-warning') { $icon = '<i class="notify-icon fa fa-warning"></i>'; }
		if ($type=='alert-danger') { $icon = '<i class="notify-icon fa fa-times-circle"></i>'; }
		if ($type=='alert-success') { $icon = '<i class="notify-icon fa fa-check-circle"></i>'; }
	}
	else { $icon = '<i class="notify-icon fa '.$icon.'"></i>'; }

	if ($closebutton == "yes") { return '<div class="alert alert-dismissable ' . $type . '"><button type="button" class="close" aria-hidden="true">&times;</button>' . $icon . do_shortcode($content) . '</div>'; }
	else { return '<div class="alert ' . $type . '">' . $icon . do_shortcode($content) . '</div>'; }
}
add_shortcode( 'notification', 'vtsc_notif' );

/*------------------------------------------------------------------------*/
/* 	Horizontal dividers
/*------------------------------------------------------------------------*/

function vtsc_hdivider( $atts, $content = null ) {
   extract(shortcode_atts(array(	'type' 	=> 'single',
									'length'=> 'long'
									), $atts));

	return '<div class="hdivider hr-' . $type . ' hr-' . $length . '"></div>'; 
}
add_shortcode( 'hdivider', 'vtsc_hdivider' );

/*------------------------------------------------------------------------*/
/* 	Tabs
/*------------------------------------------------------------------------*/

function vtsc_tab_wrapper( $atts, $content = null ) {
   extract(shortcode_atts(array(	'position' 		=> 'top'
									), $atts));
	
	return '<div class="tab-wrapper tabber-on-' . $position . '"><ul class="nav nav-tabs tabber">' . do_shortcode($content) . '</ul><div class="tab-content"></div></div>'; 
}
add_shortcode( 'tab_wrapper', 'vtsc_tab_wrapper' );

function vtsc_tab( $atts, $content = null ) {
   extract(shortcode_atts(array(	'title' => 'Tab',
   									'initial' => 'no'
									), $atts)); 
	$title_ns = str_replace(' ', '', $title);
	if ($initial=='yes') { return '<li class="active"><a href="#' . $title_ns . '" data-toggle="tab">' . $title . '</a></li><div class="dummy-content-tab"><div class="tab-pane active" id="'. $title_ns .'">'. do_shortcode($content) .'</div></div>'; }
	else { return '<li><a href="#' . $title_ns . '" data-toggle="tab">' . $title . '</a></li><div class="dummy-content-tab"><div class="tab-pane" id="'. $title_ns .'">'. do_shortcode($content) .'</div></div>'; }
}
add_shortcode( 'tab', 'vtsc_tab' );

/*------------------------------------------------------------------------*/
/* 	Accordions
/*------------------------------------------------------------------------*/

function vtsc_accordion_wrapper( $atts, $content = null ) {
	return '<div class="accordion-wrapper">' . do_shortcode($content) . '</div>'; 
}
add_shortcode( 'accordion_wrapper', 'vtsc_accordion_wrapper' );

function vtsc_accordion_single( $atts, $content = null ) {
   extract(shortcode_atts(array(	'title' => 'Title of the accordion toggle',
   									'initial' => 'no'
									), $atts)); 
	if ($initial=='yes') { return '<div class="accordion-single active"><p class="toggler"><span class="toggle-icon"><i class="fa fa-minus-square"></i></span>' . $title . '</p><div class="toggle-content">'. do_shortcode($content) .'</div></div>'; }
	else { return '<div class="accordion-single"><p class="toggler"><span class="toggle-icon"><i class="fa fa-plus-square"></i></span>' . $title . '</p><div class="toggle-content">'. do_shortcode($content) .'</div></div>'; }
}
add_shortcode( 'accordion_single', 'vtsc_accordion_single' );

/*------------------------------------------------------------------------*/
/* 	Progressbars
/*------------------------------------------------------------------------*/

function vtsc_progressbar( $atts, $content = null ) {
   extract(shortcode_atts(array(	'title' 	=> 'ProgressBar Title',
   									'progress'	=> '100',
   									'color'		=> 'blue',
   									'icon'		=> ''
									), $atts));
	if ($icon=='' || $icon=='none') { $icon = ''; } else { $icon = '<i class="fa '.$icon.'"></i>';}
	return '<div class="progress progress-' . $color . ' progress-striped active"><span class="progress-title">'. $icon . $title .'</span><div class="progress-bar" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $progress . '%"><span class="sr-only">' . $progress . '% complete</span></div></div>'; 
}
add_shortcode( 'progressbar', 'vtsc_progressbar' );

/*------------------------------------------------------------------------*/
/* 	Testimonials
/*------------------------------------------------------------------------*/

function vtsc_testimonial( $atts, $content = null ) {
   extract(shortcode_atts(array(	'name' 		=> '',
   									'subtitle'	=> '',
   									'url'		=> '',
									), $atts));
	$url = ' - <a href="'.$url.'">'.$url.'</a>';
	return '<div class="testimonial"><blockquote><p>'.do_shortcode($content).'</p><small><cite>'.$name.'</cite><br>'.$subtitle.$url.'</small></blockuote></div>'; 
}
add_shortcode( 'testimonial', 'vtsc_testimonial' );

/*------------------------------------------------------------------------*/
/* 	Typography - Labels
/*------------------------------------------------------------------------*/

function vtsc_label( $atts, $content = null ) {
   extract(shortcode_atts(array(	'color' => 'label-blue',
									'shape'	=> 'label-rounded'
									), $atts));

	return '<span class="label label-default ' . $color . ' ' . $shape . '">' . do_shortcode($content) . '</span>'; 
}
add_shortcode( 'label', 'vtsc_label' );

/*------------------------------------------------------------------------*/
/* 	Typography - Dropcaps
/*------------------------------------------------------------------------*/

function vtsc_dropcap( $atts, $content = null ) {
   extract(shortcode_atts(array(	'color' 	=> '#333333',
   									'bgcolor'	=> 'transparent',
   									'shape'		=> 'dp-circle'
									), $atts));

	return '<span class="dropcap '. $shape .'" style="color:' . $color . '; background-color:'. $bgcolor .'">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'dropcap', 'vtsc_dropcap' );

/*------------------------------------------------------------------------*/
/* 	Buttons
/*------------------------------------------------------------------------*/

function vtsc_button( $atts, $content = null ) {
   extract(shortcode_atts(array(	'size' 		=> 'btn-md',
									'shape'		=> 'btn-rounded',
									'color' 	=> 'btn-theme-color',
									'position'	=> 'btn-align-none',
									'icon'		=> '',
									'target'	=> '_self',
									'url'		=> '#'
									), $atts));
	$icon = $icon!='' ? '<i style="font-size: 110%; margin-right:10px" class="fa '.$icon.'"></i>':false;
	if($position=='btn-align-none') { return '<div class="btn-wrap"><a href="' . $url . '" target="'. $target .'" class="' . $size . ' ' . $shape . ' ' . $color . ' btn btn-default">' . $icon . do_shortcode($content) . '</a></div>'; }
	else { return '<div class="btn-wrap '. $position .'"><a href="' . $url . '" target="'. $target .'" class="' . $size . ' ' . $shape . ' ' . $color . ' btn btn-default">' . $icon . do_shortcode($content) . '</a></div><div class="clearfix"></div>'; }
	
}
add_shortcode( 'button', 'vtsc_button' );

/*------------------------------------------------------------------------*/
/* 	IconBox
/*------------------------------------------------------------------------*/

function vtsc_iconbox( $atts, $content = null ) {
   extract(shortcode_atts(array(	'title' 	=> '',
									'iconsize'	=> '48',
									'position' 	=> 'left',
									'icon'		=> ''
									), $atts));
	if($position=='left') { $icon = $icon!='' ? '<i style="font-size:'.$iconsize.'px" class="pull-left fa '.$icon.'"></i>':false; return '<div class="iconbox-wrap media">'.$icon.'<div class="media-body"><h4>'.$title.'</h4>' . do_shortcode($content) . '</div></div><div class="clearfix"></div>'; }
	else { $icon = $icon!='' ? '<i style="font-size:'.$iconsize.'px" class="fa '.$icon.'"></i>':false; return '<div class="iconbox-wrap text-center">'.$icon.'<div class="clearfix"></div><h4>'.$title.'</h4>' . do_shortcode($content) . '</div><div class="clearfix"></div>'; }
	
}
add_shortcode( 'iconbox', 'vtsc_iconbox' );

/*------------------------------------------------------------------------*/
/* 	Visibility - This shortcode will render the content completely invisible on specified devices. 
/** It endures eternally, giving constant and impenetrable concealment, no matter what spells are cast at it.
/*------------------------------------------------------------------------*/

function vtsc_show_on( $atts, $content = null ) {
   extract(shortcode_atts(array(	'device' 	=> 'desktops' // Available options: desktops, tablets, phones
									), $atts));

	return '<span class="show-on-' . $device . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'show_on', 'vtsc_show_on' );

function vtsc_hide_on( $atts, $content = null ) {
   extract(shortcode_atts(array(	'device' 	=> 'desktops'
									), $atts));

	return '<span class="hide-on-' . $device . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'hide_on', 'vtsc_hide_on' );

/*------------------------------------------------------------------------*/
/* 	Visibility - Registered users only
/*------------------------------------------------------------------------*/

function member_check( $atts, $content = null ) {
	 if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return $content;
	return '';
}
add_shortcode( 'member_only', 'member_check' );

/* ================================================================================================== */
/* 	Sanitizing content: Bitfade's approach as accepted by ThemeForest (http://cl.ly/3y2x1Z3o4109)
/* ================================================================================================== */

function sanitize_content($content) {
 
// array of custom shortcodes requiring the fix :  https://gist.github.com/bitfade/4555047
$block = join("|",array("vtsc_section","vtsc_row","one_half","one_third","two_third","one_fourth", "three_fourth"));
 
// opening tag
$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
// closing tag
$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
return $rep;
}
add_filter("the_content", "sanitize_content");
?>