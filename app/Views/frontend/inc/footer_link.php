
<script type='text/javascript'>
		const lazyloadRunObserver = () => {
			const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
			const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						let lazyloadBackground = entry.target;
						if (lazyloadBackground) {
							lazyloadBackground.classList.add('e-lazyloaded');
						}
						lazyloadBackgroundObserver.unobserve(entry.target);
					}
				});
			}, { rootMargin: '200px 0px 200px 0px' });
			lazyloadBackgrounds.forEach((lazyloadBackground) => {
				lazyloadBackgroundObserver.observe(lazyloadBackground);
			});
		};
		const events = [
			'DOMContentLoaded',
			'elementor/lazyload/observe',
		];
		events.forEach((event) => {
			document.addEventListener(event, lazyloadRunObserver);
		});
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/dist/hooks.min.js?ver=4d63a3d491d11ffd8ac6" id="wp-hooks-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/dist/i18n.min.js?ver=5e580eb46a90c2b997e6" id="wp-i18n-js"></script>
	<script id="wp-i18n-js-after">
		wp.i18n.setLocaleData({ 'text direction\u0004ltr': ['ltr'] });
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=6.0" id="swv-js"></script>
	<script id="contact-form-7-js-before">
		var wpcf7 = {
			"api": {
				"root": "https:\/\/demo.awaikenthemes.com\/novaride\/wp-json\/",
				"namespace": "contact-form-7\/v1"
			}
		};
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/contact-form-7/includes/js/index.js?ver=6.0" id="contact-form-7-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/SmoothScroll.js?ver=1.0.1" id="SmoothScroll-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/gsap.min.js?ver=1.0.1" id="gsap-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/magiccursor.js?ver=1.0.1" id="magiccursor-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/SplitText.js?ver=1.0.1" id="SplitText-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/ScrollTrigger.min.js?ver=1.0.1" id="ScrollTrigger-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/themes/novaride/assets/js/function.js?ver=1.0.1" id="theme-js-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit-lite/libs/framework/assets/js/frontend-script.js?ver=3.3.1"
		id="elementskit-framework-js-frontend-js"></script>
	<script id="elementskit-framework-js-frontend-js-after">
		var elementskit = {
			resturl: 'https://demo.awaikenthemes.com/novaride/wp-json/elementskit/v1/',
		}


	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit-lite/widgets/init/assets/js/widget-scripts.js?ver=3.3.1"
		id="ekit-widget-scripts-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit/modules/parallax/assets/js/anime.js?ver=3.7.4"
		id="animejs-js"></script>
	<script defer="" src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit/modules/parallax/assets/js/parallax-frontend.js?ver=3.7.4"
		id="elementskit-parallax-frontend-defer-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementor/assets/lib/jquery-numerator/jquery-numerator.min.js?ver=0.2.1"
		id="jquery-numerator-js"></script>
	<script id="mediaelement-core-js-before">
		var mejsL10n = { "language": "en", "strings": { "mejs.download-file": "Download File", "mejs.install-flash": "You are using a browser that does not have Flash player enabled or installed. Please turn on your Flash player plugin or download the latest version from https:\/\/get.adobe.com\/flashplayer\/", "mejs.fullscreen": "Fullscreen", "mejs.play": "Play", "mejs.pause": "Pause", "mejs.time-slider": "Time Slider", "mejs.time-help-text": "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.", "mejs.live-broadcast": "Live Broadcast", "mejs.volume-help-text": "Use Up\/Down Arrow keys to increase or decrease volume.", "mejs.unmute": "Unmute", "mejs.mute": "Mute", "mejs.volume-slider": "Volume Slider", "mejs.video-player": "Video Player", "mejs.audio-player": "Audio Player", "mejs.captions-subtitles": "Captions\/Subtitles", "mejs.captions-chapters": "Chapters", "mejs.none": "None", "mejs.afrikaans": "Afrikaans", "mejs.albanian": "Albanian", "mejs.arabic": "Arabic", "mejs.belarusian": "Belarusian", "mejs.bulgarian": "Bulgarian", "mejs.catalan": "Catalan", "mejs.chinese": "Chinese", "mejs.chinese-simplified": "Chinese (Simplified)", "mejs.chinese-traditional": "Chinese (Traditional)", "mejs.croatian": "Croatian", "mejs.czech": "Czech", "mejs.danish": "Danish", "mejs.dutch": "Dutch", "mejs.english": "English", "mejs.estonian": "Estonian", "mejs.filipino": "Filipino", "mejs.finnish": "Finnish", "mejs.french": "French", "mejs.galician": "Galician", "mejs.german": "German", "mejs.greek": "Greek", "mejs.haitian-creole": "Haitian Creole", "mejs.hebrew": "Hebrew", "mejs.hindi": "Hindi", "mejs.hungarian": "Hungarian", "mejs.icelandic": "Icelandic", "mejs.indonesian": "Indonesian", "mejs.irish": "Irish", "mejs.italian": "Italian", "mejs.japanese": "Japanese", "mejs.korean": "Korean", "mejs.latvian": "Latvian", "mejs.lithuanian": "Lithuanian", "mejs.macedonian": "Macedonian", "mejs.malay": "Malay", "mejs.maltese": "Maltese", "mejs.norwegian": "Norwegian", "mejs.persian": "Persian", "mejs.polish": "Polish", "mejs.portuguese": "Portuguese", "mejs.romanian": "Romanian", "mejs.russian": "Russian", "mejs.serbian": "Serbian", "mejs.slovak": "Slovak", "mejs.slovenian": "Slovenian", "mejs.spanish": "Spanish", "mejs.swahili": "Swahili", "mejs.swedish": "Swedish", "mejs.tagalog": "Tagalog", "mejs.thai": "Thai", "mejs.turkish": "Turkish", "mejs.ukrainian": "Ukrainian", "mejs.vietnamese": "Vietnamese", "mejs.welsh": "Welsh", "mejs.yiddish": "Yiddish" } };
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=4.2.17"
		id="mediaelement-core-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/mediaelement/mediaelement-migrate.min.js?ver=6.7.1"
		id="mediaelement-migrate-js"></script>
	<script id="mediaelement-js-extra">
		var _wpmejsSettings = { "pluginPath": "\/novaride\/wp-includes\/js\/mediaelement\/", "classPrefix": "mejs-", "stretching": "responsive", "audioShortcodeLibrary": "mediaelement", "videoShortcodeLibrary": "mediaelement" };
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=6.7.1" id="wp-mediaelement-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.25.4"
		id="elementor-webpack-runtime-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.25.4"
		id="elementor-frontend-modules-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3" id="jquery-ui-core-js"></script>
	<script id="elementor-frontend-js-before">
		var elementorFrontendConfig = { "environmentMode": { "edit": false, "wpPreview": false, "isScriptDebug": false }, "i18n": { "shareOnFacebook": "Share on Facebook", "shareOnTwitter": "Share on Twitter", "pinIt": "Pin it", "download": "Download", "downloadImage": "Download image", "fullscreen": "Fullscreen", "zoom": "Zoom", "share": "Share", "playVideo": "Play Video", "previous": "Previous", "next": "Next", "close": "Close", "a11yCarouselWrapperAriaLabel": "Carousel | Horizontal scrolling: Arrow Left & Right", "a11yCarouselPrevSlideMessage": "Previous slide", "a11yCarouselNextSlideMessage": "Next slide", "a11yCarouselFirstSlideMessage": "This is the first slide", "a11yCarouselLastSlideMessage": "This is the last slide", "a11yCarouselPaginationBulletMessage": "Go to slide" }, "is_rtl": false, "breakpoints": { "xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600 }, "responsive": { "breakpoints": { "mobile": { "label": "Mobile Portrait", "value": 767, "default_value": 767, "direction": "max", "is_enabled": true }, "mobile_extra": { "label": "Mobile Landscape", "value": 880, "default_value": 880, "direction": "max", "is_enabled": false }, "tablet": { "label": "Tablet Portrait", "value": 1024, "default_value": 1024, "direction": "max", "is_enabled": true }, "tablet_extra": { "label": "Tablet Landscape", "value": 1200, "default_value": 1200, "direction": "max", "is_enabled": false }, "laptop": { "label": "Laptop", "value": 1366, "default_value": 1366, "direction": "max", "is_enabled": false }, "widescreen": { "label": "Widescreen", "value": 2400, "default_value": 2400, "direction": "min", "is_enabled": false } }, "hasCustomBreakpoints": false }, "version": "3.25.4", "is_static": false, "experimentalFeatures": { "additional_custom_breakpoints": true, "container": true, "e_swiper_latest": true, "e_nested_atomic_repeaters": true, "e_onboarding": true, "e_css_smooth_scroll": true, "home_screen": true, "nested-elements": true, "editor_v2": true, "e_element_cache": true, "link-in-bio": true, "floating-buttons": true }, "urls": { "assets": "https:\/\/demo.awaikenthemes.com\/novaride\/wp-content\/plugins\/elementor\/assets\/", "ajaxurl": "https:\/\/demo.awaikenthemes.com\/novaride\/wp-admin\/admin-ajax.php", "uploadUrl": "https:\/\/demo.awaikenthemes.com\/novaride\/wp-content\/uploads" }, "nonces": { "floatingButtonsClickTracking": "461d0eb5f2" }, "swiperClass": "swiper", "settings": { "page": [], "editorPreferences": [] }, "kit": { "body_background_background": "classic", "active_breakpoints": ["viewport_mobile", "viewport_tablet"], "global_image_lightbox": "yes", "lightbox_enable_counter": "yes", "lightbox_enable_fullscreen": "yes", "lightbox_enable_zoom": "yes", "lightbox_enable_share": "yes", "lightbox_title_src": "title", "lightbox_description_src": "description" }, "post": { "id": 776, "title": "About%20Us%20%E2%80%93%20Novaride", "excerpt": "", "featuredImage": false } };
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.25.4"
		id="elementor-frontend-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit-lite/widgets/init/assets/js/animate-circle.min.js?ver=3.3.1"
		id="animate-circle-js"></script>
	<script id="elementskit-elementor-js-extra">
		var ekit_config = { "ajaxurl": "https:\/\/demo.awaikenthemes.com\/novaride\/wp-admin\/admin-ajax.php", "nonce": "d6c34f6b01" };
	</script>
	<script src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit-lite/widgets/init/assets/js/elementor.js?ver=3.3.1"
		id="elementskit-elementor-js"></script>
	<script src="<?= base_url()?>public/assets/motomates/-content/plugins/elementskit/widgets/init/assets/js/elementor.js?ver=3.7.4"
		id="elementskit-elementor-pro-js"></script>
	<script defer=""
		src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit/modules/sticky-content/assets/js/elementskit-sticky-content.js?ver=3.7.4"
		id="elementskit-sticky-content-script-init-defer-js"></script>
	<script defer="" src="<?= base_url()?>public/assets/motomates/wp-content/plugins/elementskit/modules/parallax/assets/js/parallax-admin.js?ver=3.7.4"
		id="elementskit-parallax-admin-defer-js"></script>
	<script src="<?= base_url()?>public/assets/js/theme-panel.js"></script>



<!-- script js -->
<!-- <script src="<?=base_url()?>public/assets/js/script.js"></script> -->
	<?php
        if (!empty ($footer_asset_link)) {
            foreach ($footer_asset_link as $link) {
                echo "<script src='" . base_url() . 'public/' . $link . "'></script>";
            }
        }
        if (!empty ($footer_link)) {
            foreach ($footer_link as $link) {
                require_once ('js/' . $link);
            }
        }
    ?>

    



</body>

</html>