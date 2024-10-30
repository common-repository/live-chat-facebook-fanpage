<?php

// Register a theme options page
add_filter( 'mb_settings_pages', function ( $settings_pages ) {
    $settings_pages[] = array(
        'id'          => 'fb-live-chat',
        'option_name' => 'fb_live_chat',
        'menu_title'  => 'FB Live Chat',
        'parent'      => 'options-general.php',
        'icon_url'    => 'dashicons-edit',
        'style'       => 'no-boxes',
        'columns'     => 2,
        'tabs'        => array(
            'general' => 'General',
            'design'  => 'Apparence',
            'faq'     => 'Author',
        ),
    );
    return $settings_pages;
} );

// Register meta boxes and fields for settings page
add_filter( 'rwmb_meta_boxes', function ( $meta_boxes ) {
	
	// load TitanFramework options
	$opzioni_old =  maybe_unserialize(get_option('titb_flc_options'));
	
	// titb_flc_url
	if ( $opzioni_old['titb_flc_url'] ) {
		$titb_flc_url_std = $opzioni_old['titb_flc_url'];
	} else {
		$titb_flc_url_std = '';
	}
	
	// titb_flc_btnlabel
	if ( $opzioni_old['titb_flc_btnlabel'] ) {
		$titb_flc_btnlabel_std = $opzioni_old['titb_flc_btnlabel'];
	} else {
		$titb_flc_btnlabel_std = 'Chat with Us!';
	}
	
	// titb_flc_titlesize
	if ( $opzioni_old['titb_flc_titlesize'] ) {
		$titb_flc_titlesize_std = $opzioni_old['titb_flc_titlesize'];
	} else {
		$titb_flc_titlesize_std = 'true';
	}
	
	// titb_flc_language
	if ( $opzioni_old['titb_flc_language'] ) {
		$titb_flc_language_std = $opzioni_old['titb_flc_language'];
	} else {
		$titb_flc_language_std = 'en_GB';
	}
	
	// button_icon
	if ( $opzioni_old['button_icon'] ) {
		$button_icon_std = $opzioni_old['button_icon'];
	} else {
		$button_icon_std = '001-messenger';
	}
	
	// button_size
	if ( $opzioni_old['button_size'] ) {
		$button_size_std = $opzioni_old['button_size'];
	} else {
		$button_size_std = 'flc_medium';
	}
	
	// button_position 
	if ( $opzioni_old['button_position'] ) {
		$button_position_std = $opzioni_old['button_position'];
	} else {
		$button_position_std = 'right';
	}
	
	
    $meta_boxes[] = array(
        'id'             => 'general',
        'title'          => 'General',
        'settings_pages' => 'fb-live-chat',
        'tab'            => 'general',
        'fields' => array(
           
			array(
				'type'        => 'text',
				'name'        => esc_html__( 'Insert Your URL Fanpage', 'live-chat-facebook-fanpage' ),
				'id'          => 'titb_flc_url',
				'desc'		  => 'Please insert here your fanpage url',
				'std'		  => $titb_flc_url_std,
			),
			
			array(
				'type'        => 'text',
				'name'        => esc_html__( 'Define Your Button Label', 'live-chat-facebook-fanpage' ),
				'id'          => 'titb_flc_btnlabel',
				'desc'		  => 'Please insert here button label',
				'std'		  => $titb_flc_btnlabel_std,
			),
			
			array(
				'type'        => 'image_select',
				'name'        => esc_html__( 'Select Title Size', 'live-chat-facebook-fanpage' ),
				'id'          => 'titb_flc_titlesize',
				'options'  => array(
			        'true'  => plugins_url( '../assets/img/title_small.png', __FILE__ ),
			        'false' => plugins_url( '../assets/img/title_big.png', __FILE__ ),
			    ),
			    'std'		  => $titb_flc_titlesize_std,
			    'class'		  => 'select_size',
			),
			
			array(
				'type'        => 'select_advanced',
				'name'        => esc_html__( 'Select Language', 'live-chat-facebook-fanpage' ),
				'id'          => 'titb_flc_language',
				'desc'		  => 'Please select your localization',
				'options'         => array(
			        'af_ZA' => 'Afrikaans',
					'ak_GH' => 'Akan',
					'am_ET' => 'Amharic',
					'ar_AR' => 'Arabic',
					'as_IN' => 'Assamese',
					'ay_BO' => 'Aymara',
					'az_AZ' => 'Azerbaijani',
					'be_BY' => 'Belarusian',
					'bg_BG' => 'Bulgarian',
					'bn_IN' => 'Bengali',
					'br_FR' => 'Breton',
					'bs_BA' => 'Bosnian',
					'ca_ES' => 'Catalan',
					'cb_IQ' => 'Sorani Kurdish',
					'ck_US' => 'Cherokee',
					'co_FR' => 'Corsican',
					'cs_CZ' => 'Czech',
					'cx_PH' => 'Cebuano',
					'cy_GB' => 'Welsh',
					'da_DK' => 'Danish',
					'de_DE' => 'German',
					'el_GR' => 'Greek',
					'en_GB' => 'English (UK)',
					'en_IN' => 'English (India)',
					'en_PI' => 'English (Pirate)',
					'en_UD' => 'English (Upside Down)',
					'en_US' => 'English (US)',
					'eo_EO' => 'Esperanto',
					'es_CL' => 'Spanish (Chile)',
					'es_CO' => 'Spanish (Colombia)',
					'es_ES' => 'Spanish (Spain)',
					'es_LA' => 'Spanish',
					'es_MX' => 'Spanish (Mexico)',
					'es_VE' => 'Spanish (Venezuela)',
					'et_EE' => 'Estonian',
					'eu_ES' => 'Basque',
					'fa_IR' => 'Persian',
					'fb_LT' => 'Leet Speak',
					'ff_NG' => 'Fulah',
					'fi_FI' => 'Finnish',
					'fo_FO' => 'Faroese',
					'fr_CA' => 'French (Canada)',
					'fr_FR' => 'French (France)',
					'fy_NL' => 'Frisian',
					'ga_IE' => 'Irish',
					'gl_ES' => 'Galician',
					'gn_PY' => 'Guarani',
					'gu_IN' => 'Gujarati',
					'gx_GR' => 'Classical Greek',
					'ha_NG' => 'Hausa',
					'he_IL' => 'Hebrew',
					'hi_IN' => 'Hindi',
					'hr_HR' => 'Croatian',
					'ht_HT' => 'Haitian Creole',
					'hu_HU' => 'Hungarian',
					'hy_AM' => 'Armenian',
					'id_ID' => 'Indonesian',
					'ig_NG' => 'Igbo',
					'is_IS' => 'Icelandic',
					'it_IT' => 'Italian',
					'ja_JP' => 'Japanese',
					'ja_KS' => 'Japanese (Kansai)',
					'jv_ID' => 'Javanese',
					'ka_GE' => 'Georgian',
					'kk_KZ' => 'Kazakh',
					'km_KH' => 'Khmer',
					'kn_IN' => 'Kannada',
					'ko_KR' => 'Korean',
					'ku_TR' => 'Kurdish (Kurmanji)',
					'ky_KG' => 'Kyrgyz',
					'la_VA' => 'Latin',
					'lg_UG' => 'Ganda',
					'li_NL' => 'Limburgish',
					'ln_CD' => 'Lingala',
					'lo_LA' => 'Lao',
					'lt_LT' => 'Lithuanian',
					'lv_LV' => 'Latvian',
					'mg_MG' => 'Malagasy',
					'mi_NZ' => 'Māori',
					'mk_MK' => 'Macedonian',
					'ml_IN' => 'Malayalam',
					'mn_MN' => 'Mongolian',
					'mr_IN' => 'Marathi',
					'ms_MY' => 'Malay',
					'mt_MT' => 'Maltese',
					'my_MM' => 'Burmese',
					'nb_NO' => 'Norwegian (bokmal)',
					'nd_ZW' => 'Ndebele',
					'ne_NP' => 'Nepali',
					'nl_BE' => 'Dutch (België)',
					'nl_NL' => 'Dutch',
					'nn_NO' => 'Norwegian (nynorsk)',
					'ny_MW' => 'Chewa',
					'or_IN' => 'Oriya',
					'pa_IN' => 'Punjabi',
					'pl_PL' => 'Polish',
					'ps_AF' => 'Pashto',
					'pt_BR' => 'Portuguese (Brazil)',
					'pt_PT' => 'Portuguese (Portugal)',
					'qc_GT' => 'Quiché',
					'qu_PE' => 'Quechua',
					'rm_CH' => 'Romansh',
					'ro_RO' => 'Romanian',
					'ru_RU' => 'Russian',
					'rw_RW' => 'Kinyarwanda',
					'sa_IN' => 'Sanskrit',
					'sc_IT' => 'Sardinian',
					'se_NO' => 'Northern Sámi',
					'si_LK' => 'Sinhala',
					'sk_SK' => 'Slovak',
					'sl_SI' => 'Slovenian',
					'sn_ZW' => 'Shona',
					'so_SO' => 'Somali',
					'sq_AL' => 'Albanian',
					'sr_RS' => 'Serbian',
					'sv_SE' => 'Swedish',
					'sw_KE' => 'Swahili',
					'sy_SY' => 'Syriac',
					'sz_PL' => 'Silesian',
					'ta_IN' => 'Tamil',
					'te_IN' => 'Telugu',
					'tg_TJ' => 'Tajik',
					'th_TH' => 'Thai',
					'tk_TM' => 'Turkmen',
					'tl_PH' => 'Filipino',
					'tl_ST' => 'Klingon',
					'tr_TR' => 'Turkish',
					'tt_RU' => 'Tatar',
					'tz_MA' => 'Tamazight',
					'uk_UA' => 'Ukrainian',
					'ur_PK' => 'Urdu',
					'uz_UZ' => 'Uzbek',
					'vi_VN' => 'Vietnamese',
					'wo_SN' => 'Wolof',
					'xh_ZA' => 'Xhosa',
					'yi_DE' => 'Yiddish',
					'yo_NG' => 'Yoruba',
					'zh_CN' => 'Simplified Chinese (China)',
					'zh_HK' => 'Traditional Chinese (Hong Kong)',
					'zh_TW' => 'Traditional Chinese (Taiwan)',
					'zu_ZA' => 'Zulu',
					'zz_TR' => 'Zazaki',
			    ),
				'std'		  => $titb_flc_language_std,
			),

			

        ),
    );
    
    
    $meta_boxes[] = array(
        'id'             => 'apparence',
        'title'          => 'Apparence',
        'settings_pages' => 'fb-live-chat',
        'tab'            => 'design',
        'fields' => array(
            
            array(
				'type'        => 'image_select',
				'name'        => esc_html__( 'Select Icon', 'live-chat-facebook-fanpage' ),
				'id'          => 'button_icon',
				'options'  => array(
			        '001-messenger' => plugins_url( '/assets/icons/png/001-messenger.png', dirname(__FILE__) ),
			        '002-i-message' => plugins_url( '/assets/icons/png/002-i-message.png', dirname(__FILE__) ),
			        '003-messenger-1' => plugins_url( '/assets/icons/png/003-messenger-1.png', dirname(__FILE__) ),
			        '004-facebook-2' => plugins_url( '/assets/icons/png/004-facebook-2.png', dirname(__FILE__) ),
			        '005-facebook' => plugins_url( '/assets/icons/png/005-facebook.png', dirname(__FILE__) ),
			        '006-facebook-1' => plugins_url( '/assets/icons/png/006-facebook-1.png', dirname(__FILE__) ),
			    ),
			    'std'		  => $button_icon_std,
			    'class'		  => 'select_icon',
			),
			
			
			
			
			array(
			    'name'        => esc_html__( 'Button Size', 'live-chat-facebook-fanpage' ),
			    'id'      => 'button_size',
			    'type'    => 'radio',
			    'desc' => 'Select the button size',
			    // Array of 'value' => 'Label' pairs for radio options.
			    // Note: the 'value' is stored in meta field, not the 'Label'
			    'options' => array(
			        'flc_tiny' => 'Tiny',
					'flc_medium' => 'Medium',
					'flc_large' => 'Large',
			    ),
			    // Show choices in the same line?
			    'inline' => false,
			    'std' => $button_size_std,
			),
			
			
			array(
			    'name'        => esc_html__( 'Button Position', 'live-chat-facebook-fanpage' ),
			    'id'      => 'button_position',
			    'type'    => 'radio',
			    'desc' => 'Select the button position',
			    // Array of 'value' => 'Label' pairs for radio options.
			    // Note: the 'value' is stored in meta field, not the 'Label'
			    'options' => array(
			        'left' => 'Left',
					'right' => 'Right',
			    ),
			    // Show choices in the same line?
			    'inline' => false,
			    'std' => $button_position_std,
			),
			
			array(
			    'name' => 'Horizontal shift',
			    'id'   => 'titb_shit_h',
			    'type' => 'slider',
			
			    // Text labels displayed before and after value
			    'suffix' => ' px',
			
			    // jQuery UI slider options. See here http://api.jqueryui.com/slider/
			    'js_options' => array(
			        'min'   => -100,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			
			    'std' => 0,
			),

			
			
			array(
			    'name'        => esc_html__( 'Animation', 'live-chat-facebook-fanpage' ),
			    'id'      => 'button_animate',
			    'type'    => 'switch',
			    'desc' => 'Enable animation on the chat button',
			    'style'     => 'square',
			    // On label: can be any HTML
			    'on_label'  => 'Enabled',
			
			    // Off label
			    'off_label' => 'Disabled',
			),

            
            
            
        ),
    );
    
    
    $meta_boxes[] = array(
        'id'             => 'info',
        'title'          => 'Theme Info',
        'settings_pages' => 'fb-live-chat',
        'tab'            => 'faq',
        'fields'         => array(
            array(
                'type' => 'custom_html',
                'std'  => 'Development by <a href="https://www.themeinthebox.com" target="_blank">ThemeintheBox.com</a></br>
                For information  <a href="mailto:support@themeinthebox.com">support@themeinthebox.com</a> (ENG)',
            ),
            
/*
            array(
                'type' => 'custom_html',
                'std'  => '<h3>Looking for some more features?</h3>
                Would you like to enter more than one list?<br>
                <ul id="wprpl-features">
                    <li>Unlimited lists (create as many lists as you want)</li>
                    <li>Define the font size for the titles, the price and the description of the articles</li>
                    <li>Dedicated technical assistance</li>
                    <li>Many other improvements</li>
                </ul>

                <p>We are working on the pro version, <a href="https://www.themeinthebox.com/wp-restaurant-price-list-pro/?ref=3&campaign=plugin" target="_blank">Check Out Now!</a></p>

                <p><a href="https://www.themeinthebox.com/contact-us/" target="_blank">Contact our support center</a> for a free trial in the administrator dashboard</p>',
            ),
*/
        ),
    );
    return $meta_boxes;
} );
