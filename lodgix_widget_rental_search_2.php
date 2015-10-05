<?php

class LodgixWidgetRentalSearch2 extends WP_Widget {

    private static $DEFAULT_SETTINGS;

	function __construct() {
		parent::__construct(
			'lodgix_rental_search',
			__('Lodgix Rental Search'),
			array('description' => __('Lodgix Rental Search Widget'))
		);
        self::$DEFAULT_SETTINGS = array(
            'title' => __('Rental Search'),
            'horizontal' => false,
            'location' => true,
            'bedrooms' => true,
            'price' => true,
            'amenities' => false,
            'name' => true
        );
	}

	function form($instance) {
        $title = self::$DEFAULT_SETTINGS['title'];
        $horizontal = self::$DEFAULT_SETTINGS['horizontal'];
        $location = self::$DEFAULT_SETTINGS['location'];
        $bedrooms = self::$DEFAULT_SETTINGS['bedrooms'];
        $price = self::$DEFAULT_SETTINGS['price'];
        $amenities = self::$DEFAULT_SETTINGS['amenities'];
        $name = self::$DEFAULT_SETTINGS['name'];
		if ($instance) {
            if (array_key_exists('title', $instance)) {
                $title = esc_attr($instance['title']);
            }
            if (array_key_exists('horizontal', $instance)) {
                $horizontal = esc_attr($instance['horizontal']);
            }
            if (array_key_exists('location', $instance)) {
                $location = esc_attr($instance['location']);
            }
            if (array_key_exists('bedrooms', $instance)) {
                $bedrooms = esc_attr($instance['bedrooms']);
            }
            if (array_key_exists('price', $instance)) {
                $price = esc_attr($instance['price']);
            }
            if (array_key_exists('amenities', $instance)) {
			    $amenities = esc_attr($instance['amenities']);
            }
            if (array_key_exists('name', $instance)) {
                $name = esc_attr($instance['name']);
            }
		}
		?>
			<p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"><br>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('horizontal'); ?>" name="<?php echo $this->get_field_name('horizontal'); ?>" type="checkbox" <?php checked(true, $horizontal); ?>>
                <label for="<?php echo $this->get_field_id('horizontal'); ?>"><?php _e('Horizontal Layout'); ?></label>
			</p>
            <p>
                <input id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="checkbox" <?php checked(true, $location); ?>>
                <label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Search by Location'); ?></label>
			</p>
            <p>
                <input id="<?php echo $this->get_field_id('bedrooms'); ?>" name="<?php echo $this->get_field_name('bedrooms'); ?>" type="checkbox" <?php checked(true, $bedrooms); ?>>
                <label for="<?php echo $this->get_field_id('bedrooms'); ?>"><?php _e('Search by Bedrooms'); ?></label>
			</p>
            <p>
                <input id="<?php echo $this->get_field_id('price'); ?>" name="<?php echo $this->get_field_name('price'); ?>" type="checkbox" <?php checked(true, $price); ?>>
                <label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('Search by Price'); ?></label>
			</p>
            <p>
                <input id="<?php echo $this->get_field_id('amenities'); ?>" name="<?php echo $this->get_field_name('amenities'); ?>" type="checkbox" <?php checked(true, $amenities); ?>>
                <label for="<?php echo $this->get_field_id('amenities'); ?>"><?php _e('Search by Amenities'); ?></label>
			</p>
            <p>
                <input id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="checkbox" <?php checked(true, $name); ?>>
                <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Search by Name or ID'); ?></label>
			</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['horizontal'] = ($new_instance['horizontal'] == 'on');
        $instance['location'] = ($new_instance['location'] == 'on');
        $instance['bedrooms'] = ($new_instance['bedrooms'] == 'on');
        $instance['price'] = ($new_instance['price'] == 'on');
        $instance['amenities'] = ($new_instance['amenities'] == 'on');
        $instance['name'] = ($new_instance['name'] == 'on');
		return $instance;
	}

	function widget($args, $instance) {
		global $wpdb;

        $pluginPath = plugin_dir_url(plugin_basename(__FILE__));
        $localizationDomain = 'p_lodgix';
        $lang = substr(get_locale(), 0, 2);

        $tableProperties = $wpdb->prefix . 'lodgix_properties';
        $tableRules = $wpdb->prefix . 'lodgix_rules';
        $tableAmenities = $wpdb->prefix . 'lodgix_searchable_amenities';
        $tableAmenitiesLang = $wpdb->prefix . 'lodgix_lang_amenities';

		extract($args);

		$lodgixSettings = get_option('p_lodgix_options');

        $areas = $wpdb->get_results("SELECT DISTINCT area FROM $tableProperties WHERE area <> '' AND area IS NOT NULL");

        $dateFormat = $lodgixSettings['p_lodgix_date_format'];
        if ($dateFormat == '%m/%d/%Y') {
            $dateFormat = 'mm/dd/yy';
        } else if ($dateFormat == '%d/%m/%Y') {
            $dateFormat = 'dd/mm/yy';
        } else if ($dateFormat == '%m-%d-%Y') {
            $dateFormat = 'mm-dd-yy';
        } else if ($dateFormat == '%d-%m-%Y') {
            $dateFormat = 'dd-mm-yy';
        } else if ($dateFormat == '%d %b %Y') {
            $dateFormat = 'dd M yy';
        }

        $title = apply_filters('widget_title', empty($instance['title']) ? self::$DEFAULT_SETTINGS['title'] : esc_html($instance['title']));
        $horizontal = array_key_exists('horizontal', $instance) ? $instance['horizontal'] : self::$DEFAULT_SETTINGS['horizontal'];
        $showLocation = array_key_exists('location', $instance) ? $instance['location'] : self::$DEFAULT_SETTINGS['location'];
        $showBedrooms = array_key_exists('bedrooms', $instance) ? $instance['bedrooms'] : self::$DEFAULT_SETTINGS['bedrooms'];
        $showPrice = array_key_exists('price', $instance) ? $instance['price'] : self::$DEFAULT_SETTINGS['price'];
        $showAmenities = array_key_exists('amenities', $instance) ? $instance['amenities'] : self::$DEFAULT_SETTINGS['amenities'];
        $showName = array_key_exists('name', $instance) ? $instance['name'] : self::$DEFAULT_SETTINGS['name'];

        echo $before_widget;

        if (!$horizontal) {
            echo $before_title . $title . $after_title;
        }

        if ($lang != 'en') {
            echo '<script src="' . $pluginPath . 'js/i18n/datepicker-' . $lang. '.js"></script>';
        }

        ?>
            <div class="ldgxRentalSearchWidget <?php echo $horizontal ? 'ldgxRentalSearchWidgetHorizontal' : 'ldgxRentalSearchWidgetVertical'; ?>">
                <form id="ldgxRentalSearchForm" method="post" action="<?php echo get_permalink((int)$lodgixSettings['p_lodgix_search_rentals_page_' . $lang]); ?>">
                    <div class="ldgxRentalSearchContainer">
                        <div class="ldgxRentalSearchDiv ldgxRentalSearchDivArrival">
                            <input type="text" id="ldgxRentalSearchDatepicker" name="lodgix-custom-search-datepicker" value="<?php echo htmlspecialchars($_POST['lodgix-custom-search-datepicker']); ?>" placeholder="<?php echo __('Arriving', $localizationDomain); ?>" onchange="lodgixRentalSearch()" readonly>
        					<input type="hidden" id="ldgxRentalSearchArrival" name="lodgix-custom-search-arrival" value="<?php echo htmlspecialchars($_POST['lodgix-custom-search-arrival']); ?>">
                        </div>
                        <div class="ldgxRentalSearchDiv ldgxRentalSearchDivNights">
                            <select id="ldgxRentalSearchNights" name="lodgix-custom-search-nights" onchange="lodgixRentalSearch()">
                                <?php
                                    $minNights = $wpdb->get_var("SELECT MIN(min_nights) FROM $tableRules");
                                    if ($minNights < 1) {
                                        $minNights = 1;
                                    }
                                    if (isset($_POST['lodgix-custom-search-nights'])) {
                                        $value = (int)$_POST['lodgix-custom-search-nights'];
                                        for ($i = $minNights; $i < 100; $i++) {
                                            $selected = $value == $i ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i " . __($i > 1 ? 'nights' : 'night', $localizationDomain) . "</option>";
                                        }
                                    } else {
                                        echo '<option value="" selected>' . __('Nights', $localizationDomain) . '</option>';
                                        for ($i = $minNights; $i < 100; $i++) {
                                            echo "<option value='$i'>$i " . __($i > 1 ? 'nights' : 'night', $localizationDomain) . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            if ($showLocation) {
                                ?>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivArea">
                                    <select id="ldgxRentalSearchArea" name="lodgix-custom-search-area" onchange="lodgixRentalSearch()">
                                        <?php
                                            if (isset($_POST['lodgix-custom-search-area'])) {
                                                $value = $_POST['lodgix-custom-search-area'];
                                                if ($value == 'ALL_AREAS') {
                                                    echo '<option value="ALL_AREAS" selected>' . __('All Areas', $localizationDomain) . '</option>';
                                                    foreach ($areas as $area) {
                                                        echo "<option value='$area->area'>$area->area</option>";
                                                    }
                                                } else {
                                                    echo '<option value="ALL_AREAS">' . __('All Areas', $localizationDomain) . '</option>';
                                                    foreach ($areas as $area) {
                                                        $selected = $value == $area->area ? 'selected' : '';
                                                        echo "<option value='$area->area' $selected>$area->area</option>";
                                                    }
                                                }
                                            } else {
                                                echo '<option value="" selected>' . __('Location', $localizationDomain) . '</option>';
                                                echo '<option value="ALL_AREAS">' . __('All Areas', $localizationDomain) . '</option>';
                                                foreach ($areas as $area) {
                                                    echo "<option value='$area->area'>$area->area</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            if ($showBedrooms) {
                                ?>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivBedrooms">
                                    <select id="ldgxRentalSearchBedrooms" name="lodgix-custom-search-bedrooms" onchange="lodgixRentalSearch()">
                                        <?php
                                            $minRooms = (int)$wpdb->get_var("SELECT MIN(bedrooms) FROM $tableProperties");
                                            $maxRooms = (int)$wpdb->get_var("SELECT MAX(bedrooms) FROM $tableProperties");
                                            if (isset($_POST['lodgix-custom-search-bedrooms'])) {
                                                $value = $_POST['lodgix-custom-search-bedrooms'];
                                                if ($value == 'ANY') {
                                                    echo '<option value="ANY" selected>Any Bedrooms</option>';
                                                    if ($minRooms == 0) {
                                                        echo '<option value="0">Studio</option>';
                                                    }
                                                    for ($i = 1; $i <= $maxRooms; $i++) {
                                                        echo "<option value='$i'>$i " . __($i > 1 ? 'bedrooms' : 'bedroom', $localizationDomain) . "</option>";
                                                    }
                                                } else {
                                                    echo '<option value="ANY">Any Bedrooms</option>';
                                                    if ($minRooms == 0) {
                                                        if ($value == '0') {
                                                            echo '<option value="0" selected>Studio</option>';
                                                        } else {
                                                            echo '<option value="0">Studio</option>';
                                                        }
                                                    }
                                                    $value = (int)$value;
                                                    for ($i = 1; $i <= $maxRooms; $i++) {
                                                        $selected = $value == $i ? 'selected' : '';
                                                        echo "<option value='$i' $selected>$i " . __($i > 1 ? 'bedrooms' : 'bedroom', $localizationDomain) . "</option>";
                                                    }
                                                }
                                            } else {
                                                echo '<option value="" selected>' . __('Bedrooms', $localizationDomain) . '</option>';
                                                echo '<option value="ANY">Any Bedrooms</option>';
                                                if ($minRooms == 0) {
                                                    echo '<option value="0">Studio</option>';
                                                }
                                                for ($i = 1; $i <= $maxRooms; $i++) {
                                                    echo "<option value='$i'>$i " . __($i > 1 ? 'bedrooms' : 'bedroom', $localizationDomain) . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            if ($showPrice) {
                                ?>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivDailyPriceFrom">
                                    <select id="ldgxRentalSearchDailyPriceFrom" name="lodgix-custom-search-daily-price-from" onchange="lodgixRentalSearch()">
                                        <?php
                                            if (isset($_POST['lodgix-custom-search-daily-price-from'])) {
                                                $value = (int)$_POST['lodgix-custom-search-daily-price-from'];
                                                for ($i = 0; $i <= 1000; $i += 50) {
                                                    $selected = $value == $i ? 'selected' : '';
                                                    $label = $i > 0 ? '$' . $i : 'Any Price';
                                                    echo "<option value='$i' $selected>From $label</option>";
                                                }
                                            } else {
                                                echo '<option value="" selected>Daily Price From</option>';
                                                for ($i = 0; $i <= 1000; $i += 50) {
                                                    $label = $i > 0 ? '$' . $i : 'Any Price';
                                                    echo "<option value='$i'>From $label</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivDailyPriceTo">
                                    <select id="ldgxRentalSearchDailyPriceTo" name="lodgix-custom-search-daily-price-to" onchange="lodgixRentalSearch()">
                                        <?php
                                            if (isset($_POST['lodgix-custom-search-daily-price-to'])) {
                                                $value = (int)$_POST['lodgix-custom-search-daily-price-to'];
                                                for ($i = 0; $i <= 1000; $i += 50) {
                                                    $selected = $value == $i ? 'selected' : '';
                                                    $label = $i > 0 ? '$' . $i : 'Any Price';
                                                    echo "<option value='$i' $selected>To $label</option>";
                                                }
                                            } else {
                                                echo '<option value="" selected>Daily Price To</option>';
                                                for ($i = 0; $i <= 1000; $i += 50) {
                                                    $label = $i > 0 ? '$' . $i : 'Any Price';
                                                    echo "<option value='$i'>To $label</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            if ($showAmenities) {
                                ?>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivAmenities">
                                    <?php
                                        $values = isset($_POST['lodgix-custom-search-amenity']) ? $_POST['lodgix-custom-search-amenity'] : array();
                                        $amenities = $wpdb->get_results("SELECT DISTINCT * FROM $tableAmenities");
                                        $i = 0;
                                        foreach ($amenities as $amenity) {
                                            $amenityName = trim($amenity->description);
                                            $amenityNameTranslated = $wpdb->get_var("SELECT description_translated FROM $tableAmenitiesLang WHERE description='$amenityName' AND language_code='$lang'");
                                            if (!$amenityNameTranslated) {
                                                $amenityNameTranslated = __($amenityName, $localizationDomain);
                                            }
                                            $checked = in_array($amenityName, $values) ? 'checked' : '';
                                            echo "
                                                <div class='ldgxRentalSearchAmenity'>
                                                    <input type='checkbox' id='ldgxRentalSearchAmenity$i' name='lodgix-custom-search-amenity[]' value='$amenityName' $checked onclick='lodgixRentalSearch()'>
                                                    <label for='ldgxRentalSearchAmenity$i'>$amenityNameTranslated</label>
                                                </div>
                                            ";
                                            $i++;
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                            if ($showName) {
                                ?>
                                <div class="ldgxRentalSearchDiv ldgxRentalSearchDivId">
                                    <input type="text" id="ldgxRentalSearchId" name="lodgix-custom-search-id"
                                           placeholder="<?php echo __('Property Name or ID', $localizationDomain); ?>"
                                           onkeyup="lodgixRentalSearch()"
                                           value="<?php echo htmlspecialchars($_POST['lodgix-custom-search-id']); ?>">
                                </div>
                                <?php
                            }
                        ?>
                        <div class="ldgxRentalSearchDiv ldgxRentalSearchDivSubmit">
                            <button id="ldgxRentalSearchSubmit"><?php echo __('Display Results', $localizationDomain); ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                (function($) {
                    'use strict';

                    $.templates({
                        lodgixRentalSearchResultsTooltip: ['<div class="ldgxRentalSearchResultsTooltipContent">{{:numResults}} <?php echo __('Properties Found',$localizationDomain); ?></div>'].join('')
                    });

                    window.lodgixRentalSearchTooltip = new LodgixTooltip();
                    window.lodgixRentalSearchTooltip.el().addClass('ldgxRentalSearchResultsTooltip');

                    window.lodgixRentalSearch = function() {
                        if (!$('#ldgxRentalSearchArrival').val()) {
                            var tomorrow = new Date();
                            tomorrow.setDate(tomorrow.getDate() + 1);
                            jQueryLodgix('#ldgxRentalSearchDatepicker').datepicker('setDate', tomorrow);
                        }
                        $('#ldgxRentalSearchNights option[value=""]').remove();
                        $('#ldgxRentalSearchArea option[value=""]').remove();
                        $('#ldgxRentalSearchBedrooms option[value=""]').remove();
                        $('#ldgxRentalSearchDailyPriceFrom option[value=""]').remove();
                        $('#ldgxRentalSearchDailyPriceTo option[value=""]').remove();
                        if (parseInt($('#ldgxRentalSearchDailyPriceFrom').val()) > parseInt($('#ldgxRentalSearchDailyPriceTo').val())) {
                            $('#ldgxRentalSearchDailyPriceTo option[value="0"]').prop('selected', true);
                        }
                        $('#ldgxRentalSearchSubmit').addClass('ldgxRainbowAnimation');
                        $('#ldgxRentalSearchForm').ajaxSubmit({
                            url: '<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php',
                            data: {
                                'action': 'p_lodgix_custom_search'
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    var submitButton = $('#ldgxRentalSearchSubmit');
                                    var hideTooltip = function() {
                                        window.lodgixRentalSearchTooltip.hide();
                                    };
                                    window.lodgixRentalSearchTooltip.show({
                                        trigger: submitButton,
                                        template: 'lodgixRentalSearchResultsTooltip',
                                        params: {
                                            numResults: response.num_results || 0
                                        },
                                        touch: true,
                                        onTouch: function() {
                                            window.lodgixRentalSearchTooltip.hide();
                                        },
                                        onBeforeHide: function() {
                                            submitButton.off({
                                                mouseover: hideTooltip,
                                                click: hideTooltip
                                            });
                                            window.lodgixRentalSearchTooltip.el().off({
                                                mouseover: hideTooltip
                                            });
                                        }
                                    });
                                    submitButton.on({
                                        mouseover: hideTooltip,
                                        click: hideTooltip
                                    });
                                    window.lodgixRentalSearchTooltip.el().on({
                                        mouseover: hideTooltip
                                    });

                                    var min_nights = response.min_nights || 1;
                                    var selectbox = $('#ldgxRentalSearchNights');
                                    var selected = parseInt(selectbox.val());
                                    if (isNaN(selected) || selected < min_nights) {
                                        selected = min_nights;
                                    }
                                    var options = [];
                                    for (var i = min_nights; i < 100; i++) {
                                        options.push('<option value="');
                                        options.push(i);
                                        options.push('">');
                                        options.push(i);
                                        if (i > 1) {
                                            options.push(' <?php echo __('nights', $localizationDomain); ?>');
                                        } else {
                                            options.push(' <?php echo __('night', $localizationDomain); ?>');
                                        }
                                        options.push('</option>');
                                    }
                                    selectbox.empty().append(options.join(''));
                                    $('#ldgxRentalSearchNights option[value="' + selected + '"]').prop('selected', true);
                                }
                            },
                            complete: function() {
                                $('#ldgxRentalSearchSubmit').removeClass('ldgxRainbowAnimation');
                            }
                        });
                    };

                    $(document).ready(function() {
                        jQueryLodgix('#ldgxRentalSearchDatepicker').datepicker({
                                showOn: 'both',
                                buttonImage: '<?php echo $pluginPath; ?>images/calendar.png',
                                buttonImageOnly: true,
                                dateFormat: '<?php echo $dateFormat; ?>',
                                altField: '#ldgxRentalSearchArrival',
                                altFormat: 'yy-mm-dd',
                                minDate: 0,
                                beforeShow: function() {
                                    setTimeout(function() {
                                        jQueryLodgix('#lodgix-datepicker-div').css('z-index', 99999999999999);
                                    }, 0);
                                }
                            }<?php if ($lang != 'en') { echo ', jQueryLodgix.datepicker.regional["' . $lang. '"]'; } ?>)
                            .next('.lodgix-datepicker-trigger').addClass('ldgxRentalSearchDatepickerTrigger');
                    });

                }(jQLodgix));
            </script>
        <?php

		echo $after_widget;
	}
}

function lodgixRegisterWidgetRentalSearch2() {
    register_widget('LodgixWidgetRentalSearch2');
}

add_action('widgets_init', 'lodgixRegisterWidgetRentalSearch2');
