<?php
global $amp_conf;
$html = '';
$version	 = get_framework_version();
$version = $version ? $version : getversion();
$version_tag = '?load_version=' . urlencode($version);
if ($amp_conf['FORCE_JS_CSS_IMG_DOWNLOAD']) {
  $this_time_append	= '.' . time();
  $version_tag 		.= $this_time_append;
} else {
	$this_time_append = '';
}


// Brandable logos in footer
//fpbx logo
$html .= '<div class="col-md-4">
	<a target="_blank" href="'
                . $amp_conf['BRAND_IMAGE_FREEPBX_LINK_FOOT']
                . '" >'
                . '<img id="footer_logo1" src="'.$amp_conf['BRAND_IMAGE_FREEPBX_FOOT'].$version_tag
                . '" alt="'.$amp_conf['BRAND_FREEPBX_ALT_FOOT'] .'"/>
	</a>
	</div>';

//text
$html .= '<div class="col-md-4 citadel-footer-text" id="footer_text">';
$html .= '<span class="citadel-footer-headline">' . htmlspecialchars($amp_conf['DASHBOARD_FREEPBX_BRAND'], ENT_QUOTES, 'UTF-8') . '</span>' . br();
$html .= '<span class="citadel-footer-tagline">A converged platform for GSM and VoIP orchestration.</span>' . br();
$html .= '<span class="citadel-footer-meta">Powered by FreePBX ' . $version . ' - <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GPL</a></span>';

//module license
if (!empty($active_modules[$module_name]['license'])) {
  $html .= br() . sprintf(_('Current module licensed under %s'),
  trim($active_modules[$module_name]['license']));
}

//benchmarking
if (isset($amp_conf['DEVEL']) && $amp_conf['DEVEL']) {
	$benchmark_time = number_format(microtime_float() - $benchmark_starttime, 4);
	$html .= '<br><span id="benchmark_time">Page loaded in ' . $benchmark_time . 's</span>';
}
$html .= '<br /><small class="citadel-footer-meta">&copy; ' . date('Y', time()) . ' ' . htmlspecialchars($amp_conf['DASHBOARD_FREEPBX_BRAND'], ENT_QUOTES, 'UTF-8') . '</small>';
$html .= '<br /><small class="citadel-footer-legal">FreePBX is a registered trademark of Sangoma Technologies Inc.</small>';
$html .= '</div>';
$html .= '<div class="col-md-4">';
	<a target="_blank" href="' . $amp_conf['BRAND_IMAGE_SPONSOR_LINK_FOOT']
		. '" >'
		. '<img id="footer_logo" src="' . $amp_conf['BRAND_IMAGE_SPONSOR_FOOT'] . '" '
		. 'alt="' . $amp_conf['BRAND_SPONSOR_ALT_FOOT'] . '"/>
	</a>
	</div>';
echo $html;
?>
