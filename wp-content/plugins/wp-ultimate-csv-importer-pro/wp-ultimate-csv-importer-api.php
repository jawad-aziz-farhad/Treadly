<?php
/**
 * Seamlessly create / update posts, custom posts, pages, products, media, SEO and contents of premium plugins from your CSV data with ease.
 *
 * Class SmackUCI_API | wp-ultimate-csv-importer-api.php
 *
 * @package     WP Ultimate CSV Importer
 * @author      Smackcoders <info@smackcoders.com>
 * @version     Version 1.0 (23/01/2017)
 * @copyright   Copyright (c) 2017, Smackcoders
 *
 * @since       [5.1]
 */
/******************************************************************************************
 * Copyright (C) Smackcoders. - All Rights Reserved under Smackcoders Proprietary License
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * You can contact Smackcoders at email address info@smackcoders.com.
 *******************************************************************************************/
class SmackUCI_API {

	/**
	 * Function to get available fields based on the module
	 *
	 * @param $module  - Name of the module | Posts (or) WooCommerce (or) Event (or) movie. Here, movie belongs to CustomPost.
	 * @source wp-ultimate-csv-importer-api.php 26 29 should be like Posts (or) Pages (or) WooCommerce (or) movie
	 *
	 * @return array    - Fields set as based on the groups
	 */
	public function get_available_fields( $module = null ) {
		global $uci_admin;
		if($module == null)
			$module = 'CustomPosts';
		$import_type = $importAs = $module;

		$possible_widgets = array();
		$possible_widgets = $uci_admin->available_widgets($import_type, $importAs);
		$fieldSet = $data = array();
		if(!empty($possible_widgets)) {
			foreach ( $possible_widgets as $widget_name => $groupName ) {
				$fields = $uci_admin->get_widget_fields( $widget_name, $import_type, $importAs );
				if ( ! empty( $fields[ $groupName ] ) ) {
					foreach ( $fields[ $groupName ] as $key => $val ) {
						$fieldSet[ $groupName ][ $val['name'] ] = $val['name'];
					}
				} else {
					$fieldSet[ $groupName ] = array();
				}
			}
			$data['type'] = 'object';
			$data['fields'] = $fieldSet;
		} else {
			$data['type'] = 'string';
			$data['message'] = 'Please provide a valid a module name.';
		}
		return $data;
	}

	/**
	 * Function to get the mapping template information
	 *
	 * @param $name - Name of the template ( For your reference on future imports )
	 * @source wp-ultimate-csv-importer-api.php 63 20 name should be a template name
	 *
	 * @return array    - Template information as based on the field groups
	 */
	public function getMapping( $name ) {
		global $wpdb;
		$data = array();
		$name = str_replace ( '%20', ' ', $name );
		$templateInfo = $wpdb->get_results(
			$wpdb->prepare("select mapping, module, eventKey from wp_ultimate_csv_importer_mappingtemplate where templatename = %s", $name)
		);
		if(!empty($templateInfo)) {
			$data['type'] = 'object';
			$data['mapping']  = maybe_unserialize( $templateInfo[0]->mapping );
			$data['eventKey'] = $templateInfo[0]->eventKey;
			return $data;
		} else {
			$data['type'] = 'string';
			$data['message'] = 'There is no template available in the given name.';
			$data['description'] = 'Please sanitize your template name';
			return $data;
		}
	}

	/**
	 * Function which helps to save the mapping
	 *
	 * @param $module        - Name of the module | Posts (or) Pages (or) WooCommerce (or) movie ( movie belongs to CustomPost )
	 * @param $eventMapping  - Group based mapping | WP fields (Vs) CSV Headers.
	 * @param $is_template   - Save Template ( optional ). Value can be 0 / 1.
	 * @param $template_name - Name of the template.
	 *
	 * @source wp-ultimate-csv-importer-api.php 94 20 Module name should be like Posts (or) Pages (or) WooCommerce (or) movie also the template name & their mapping information also should be a valid one
	 * @return array|string  - Saved template information
	 */
	public function saveMapping($module, $eventMapping, $is_template, $template_name) {
		$result = array();
		if($is_template == 1 && $eventMapping != 0) {
			$template_name = trim($template_name);
			if($template_name != '' && $template_name != null) {
				$result = $this->saveTemplate( $template_name, $eventMapping, $module );
			} else {
				$result['type'] = 'string';
				$result['message'] = "Don't leave empty on \"template_name\".";
			}
		} else {
			if($eventMapping == 0) {
				$result['type'] = 'string';
				$result['message'] = "Provide a valid template information. Please, Validate your given template information.";
				return $result;
			}
			$result['type'] = 'string';
			$result['message'] = 'Assign value as 1 in "is_template".';
		}

		return $result;
	}

	/**
	 * Save mapping as a template
	 *
	 * @param $template_name    - Name of the template
	 * @param $template_info    - Template information "Group based mapping" | WP fields (Vs) CSV Headers.
	 * @param $module           - Name of the module | Posts (or) WooCommerce (or) Event (or) movie. Here, movie belongs to CustomPost.
	 *
	 * @source wp-ultimate-csv-importer-api.php 127 52 Module name should be like Posts (or) Pages (or) WooCommerce (or) movie also the template name & their mapping information also should be a valid one
	 * @return array|string     - Saved template information
	 */
	private function saveTemplate($template_name, $template_info, $module) {
		global $wpdb, $uci_admin;
		$data = $result = array();
		$data['module'] = $module;
		$eventKey = '';
		$get_available_fields = get_available_fields($data);
		#$get_available_fields['fields'] = unserialize($get_available_fields['fields']);
		if(isset($get_available_fields['fields']) && !empty($get_available_fields['fields'])) {
			$custom_field_groups = array( 'CORECUSTFIELDS', 'PODS', 'ACF', 'RF', 'TYPES', 'CCTM' );
			foreach ( $template_info as $groupIndex => $groupField ) {
				if ( ! array_key_exists( $groupIndex, $get_available_fields['fields'] ) ) {
					$result['type']    = 'string';
					$result['message'] = "Don't use the unknown group name.";

					return $result;
				}
				foreach ( $groupField as $key => $val ) {
					if ( ! array_key_exists( $key, $get_available_fields['fields'][ $groupIndex ] ) && ! in_array( $groupIndex, $custom_field_groups ) ) {
						$result['type']    = 'string';
						$result['message'] = "Can't add custom field in this group" . "\"$groupIndex\"";

						return $result;
					}
				}
			}
			$find_is_exist = $wpdb->get_results( $wpdb->prepare( "select *from wp_ultimate_csv_importer_mappingtemplate where templatename = %s", $template_name ) );
			if ( empty( $find_is_exist ) ) {
				$template_info = maybe_serialize( $template_info );
				$wpdb->insert( 'wp_ultimate_csv_importer_mappingtemplate', array(
					'templatename' => $template_name,
					'mapping'      => $template_info,
					'module'       => $module,
					'eventKey'     => $eventKey,
				), array( '%s', '%s', '%s', '%s' ) );
				$result['type']          = 'object';
				$result['message']       = 'Template added successfully!';
				$result['template_name'] = $template_name;
				$result['id']['type']    = 'integer';
				$result['id']['value']   = $wpdb->insert_id;

				return $result;
			} else {
				$result['type']    = 'string';
				$result['message'] = 'Template Exist!';

				return $result;
			}
		} else {
			return $get_available_fields;
		}
	}

	/**
	 * Function to push the data into WordPress as below
	 * Posts, Pages, Products, Custom Posts, Comments, Categories, Tags, Taxonomies, Customer Reviews & Users
	 *
	 * @param $importType           - Name of the module | Posts (or) WooCommerce (or) Event (or) movie. Here, movie belongs to CustomPost.
	 * @param $importMethod         - Import Method as "import_with_api"
	 * @param $mode                 - Import Mode | "Insert" (or) "Update"
	 * @param $data                 - Data Array | Group based field with value.
	 * @param $row_no               - Row Number ( optional ).
	 * @param $eventMapping         - Mapping information | Group based field mapping, WP Fields (vs) CSV Headers.
	 * @param array $affectedRecords- Affected Records ( optional ). It can be empty.
	 * @param array $mediaConfig    - Media Configuration ( optional ).
	 * @param array $importConfig   - Import Configuration ( optional ).
	 * @param int $is_template      - Save Template ( optional ). Value can be 0 / 1.
	 * @param $template_name        - Name of the template ( It can be an existing template or new one )
	 *
	 * @source wp-ultimate-csv-importer-api.php 199 30 Which helps to push the data into WordPress
	 * @return array                - Information about the processed data
	 */
	public function importData($importType, $importMethod, $mode, $data, $row_no = 1, $eventMapping, $affectedRecords = array(), $mediaConfig = array(), $importConfig = array(), $is_template = 0, $template_name = null) {
		global $uci_admin;
		$eventKey = '';
		$result = array();
		if($is_template == 1) {
			$template_info = maybe_serialize($eventMapping);
			$this->saveTemplate( $template_name, $template_info, $importType );
		}
		if( empty($mediaConfig) ) {
			$mediaConfig = array(
				'eventkey'                => $eventKey,
				'download_img_tag_src'    => 'on',
				'media_thumbnail_size'    => 'on',
				'media_medium_size'       => 'on',
				'media_medium_large_size' => 'on',
				'media_large_size'        => 'on',
			);
		}
		$uci_admin->importData($eventKey, $importType, $importMethod, $mode, $data, $row_no, $eventMapping, $affectedRecords, $mediaConfig, $importConfig);
		if(is_int($uci_admin->getLastImportId())) {
			$result['type'] = 'integer';
			$result['description'] = 'Record affected successfully!';
			$result['id'] = $uci_admin->getLastImportId();
		} else {
			$result['type'] = 'string';
			$result['message'] = 'Please validate your record information.';
		}
		return $result;
	}

	/**
	 * Function which helps to assign featured image to the specific post / product
	 * @param $imageURL | External URL of the image
	 * @param $postID   | Valid ID of the Post / Page / Product
	 * @param $renameImage | Name of the image which you want to assign it.
	 *
	 * @source  wp-ultimate-csv-importer-api.php 238 27 Helps to assign the featured image for the existing Post / Page / Product
	 * @return array
	 */
	public function setFeaturedImage($imageURL, $postID, $renameImage = null) {
		$thumbnailId = null;
		$result = array();
		$mediaSettings = array(
			'eventkey' => '',
			'download_img_tag_src' => 'on',
			'media_thumbnail_size' => 'on',
			'media_medium_size' => 'on',
			'media_medium_large_size' => 'on',
			'media_large_size' => 'on',
		);
		$thumbnailId = SmackUCIMediaScheduler::convert_local_imageURL($imageURL, $postID, $renameImage, $mediaSettings);
		if($thumbnailId != null) {
			set_post_thumbnail( $postID, $thumbnailId );
		}

		if(is_int($thumbnailId)) {
			$result['type'] = 'integer';
			$result['description'] = 'Featured image assigned successfully!';
			$result['id'] = $thumbnailId;
		} else {
			$result['type'] = 'string';
			$result['message'] = 'Please validate your image url.';
		}
		return $result;
	}

	/**
	 * Function which helps to assign the terms with parent -> child hierarchical
	 * as any number of depth for a specific post / product
	 *
	 * @param $terms | Terms with any number of Parent -> Child hierarchical Ex:- Cars -> BMW -> Safety kits -> Airbags
	 * @param $taxonomy_name | Name of the taxonomy Ex:- Product Category
	 * @param $pID | Valid ID of the Post / Page / Product.
	 *
	 * @source wp-ultimate-csv-importer-api.php 276 20 Helps to assign the Terms / Taxonomies for the existing post types
	 * @return array
	 */
	public function setTerms($terms, $taxonomy_name, $pID) {
		global $uci_admin;
		$result = $category_list = array();
		$is_exist_record = get_post($pID);
		if($is_exist_record == null) {
			$result['type'] = 'string';
			$result['message'] = 'Provide a valid a record (Post / Product) number.';
			return $result;
		}
		$category_list = $uci_admin->assignTermsAndTaxonomies($terms, $taxonomy_name, $pID);

		if(!empty($category_list)) {
			$result['type'] = 'object';
			$result['terms'] = $category_list;
			$result['description'] = 'Terms assigned successfully!';
		}

		return $result;
	}

	/**
	 * Function which helps to register the custom field for ACF, PODS, Toolset Types plugins
	 *
	 * @param $field_info | It has the field information like ( label, name, desc, field_type, required, choice, role, related_to, bi_directional )
	 * @param $module     | Name of the module | Posts (or) WooCommerce (or) Event (or) CustomPost.
	 * @param $import_type | If you want to register field under any custom post means, the value should be like movie. Here, movie is a custom post type.
	 * @param $plugin   | Should mention the plugin name like acf (or) types (or) pods
	 *
	 * @source wp-ultimate-csv-importer-api.php 310 43 Helps to Register custom fields for ACF, PODS, Types plugin
	 * @return array
	 */
	public function registerField($field_info, $module, $import_type, $plugin) {
		global $uci_admin;
		$result = array();
		$active_plugins = get_option('active_plugins');
		foreach($field_info as $key => $value) {
			$field_info['field_info'][$key] = $value;
		}
		$field_info['import_type'] = $uci_admin->import_post_types($module, $import_type);
		// Register Fields
		if($plugin == 'acf') {
			if(!in_array('advanced-custom-fields-pro/acf.php', $active_plugins) && !in_array('advanced-custom-fields/acf.php', $active_plugins)) {
				$result['message'] = "ACF plugin is not installed or activated!";
			} else {
				require_once "includes/class-uci-acf-data-import.php";
				$acfObj = new SmackUCIACFDataImport();
				if ( in_array( 'advanced-custom-fields-pro/acf.php', $active_plugins ) ) {
					$result['message'] = $acfObj->Register_ProFields( $field_info, $plugin );
				} else {
					$result['message'] = $acfObj->Register_FreeFields( $field_info, $plugin );
				}
			}
		} elseif($plugin == 'types') {
			if(!in_array('types/wpcf.php', $active_plugins)) {
				$result['message'] = "Types plugin is not installed or activated!";
			} else {
				require_once "includes/class-uci-types-data-import.php";
				$typesObj = new SmackUCITypesDataImport();
				$result['message'] = $typesObj->Register_Fields($field_info, $plugin);
			}
		} elseif($plugin == 'pods') {
			if(!in_array('pods/init.php', $active_plugins)) {
				$result['message'] = "PODS plugin is not installed or activated!";
			} else {
				require_once "includes/class-uci-pods-data-import.php";
				$podsObj = new SmackUCIPODSDataImport();
				$result['message'] = $podsObj->Register_Fields($field_info, $plugin);
			}
		} else {
			$result['message'] = 'Unknown plugin!';
		}

		return $result;
	}

	/**
	 * Function which helps you to fetch the record based on the module & ID of the specific record
	 *
	 * @param $data | Which contains the ID of the specific record & module name.
	 *
	 * @source wp-ultimate-csv-importer-api.php 362 45 Helps to assign the Terms / Taxonomies for the existing post types
	 * @return mixed
	 */
	public function fetchRecord($data) {
		global $uci_admin;
		require_once "includes/class-uci-exporter.php";
		$exportObj = new SmackUCIExporter();
		$importAs = $data['module'];
		$exportObj->module = $uci_admin->import_post_types($data['module'], $importAs);
		switch ($data['module']) {
			case 'Posts':
			case 'Pages':
			case 'CustomPosts':
			case 'WooCommerce':
			case 'MarketPress':
			case 'WooCommerceVariations':
			case 'WooCommerceOrders':
			case 'WooCommerceCoupons':
			case 'WooCommerceRefunds':
			case 'WPeCommerce':
			case 'eShop':
				$exportObj->generateHeaders($data['module'], $exportObj->optionalType);
				$exportObj->data[$data['id']] = $exportObj->getPostsDataBasedOnRecordId($data['id']);
				$exportObj->getPostsMetaDataBasedOnRecordId($data['id'], $exportObj->module, $exportObj->optionalType);
				$exportObj->getTermsAndTaxonomies($data['id'], $exportObj->module, $exportObj->optionalType);
				break;
			case 'Users':
				$exportObj->FetchUsers('webservice');
				break;
			case 'Comments':
				$exportObj->FetchComments('webservice');
				break;
			case 'Taxonomies':
				$exportObj->FetchTaxonomies('webservice');
				break;
			case 'CustomerReviews':
				$exportObj->FetchCustomerReviews('webservice');
				break;
			case 'Categories':
				$exportObj->FetchCategories('webservice');
				break;
			case 'Tags':
				$exportObj->FetchTags('webservice');
				break;
		}
		return $exportObj->data[$data['id']];
	}

}