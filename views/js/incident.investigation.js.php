<?php
?>
<script>
(function() {
	if (typeof window.mnzInvestigationData === 'undefined') return;

	var d = window.mnzInvestigationData;
	var isDark = document.body.getAttribute('theme') === 'dark-theme' ||
		document.documentElement.getAttribute('theme') === 'dark-theme';
	var textColor = isDark ? '#e0e0e0' : '#333333';
	var labelColor = isDark ? '#999999' : '#666666';
	var barBg = isDark ? '#3a3a3a' : '#e9ecef';
	var barFill = isDark ? '#0275b8' : '#0275b8';

	function renderBarChart(containerId, data, labels, color) {
		var el = document.getElementById(containerId);
		if (!el) return;
		var max = Math.max.apply(Math, data);
		if (max === 0) max = 1;
		var html = '<div class="mnz-investigation-bars">';
		for (var i = 0; i < data.length; i++) {
			var h = (data[i] / max) * 80;
			html += '<div class="mnz-investigation-bar-item" title="' + labels[i] + ': ' + data[i] + '">';
			html += '<div class="mnz-investigation-bar" style="height:' + Math.max(h, 4) + 'px;background:' + (data[i] > 0 ? color : barBg) + '"></div>';
			html += '<span class="mnz-investigation-bar-label">' + labels[i] + '</span>';
			html += '</div>';
		}
		html += '</div>';
		el.innerHTML = html;
	}

	function renderMonthlyChart(containerId, data, labels) {
		var el = document.getElementById(containerId);
		if (!el) return;
		var max = Math.max.apply(Math, data);
		if (max === 0) max = 1;
		var html = '<div class="mnz-investigation-monthly-bars">';
		for (var i = 0; i < data.length; i++) {
			var h = (data[i] / max) * 100;
			var isCurrent = i === data.length - 1;
			var col = data[i] > 0 ? (isCurrent ? '#ff9800' : barFill) : barBg;
			html += '<div class="mnz-investigation-monthly-item" title="' + labels[i] + ': ' + data[i] + '">';
			html += '<div style="font-size:11px;font-weight:bold;color:' + textColor + '">' + data[i] + '</div>';
			html += '<div class="mnz-investigation-monthly-bar" style="height:' + Math.max(h, 4) + 'px;background:' + col + '"></div>';
			html += '<span class="mnz-investigation-monthly-label" style="color:' + labelColor + '">' + labels[i] + '</span>';
			html += '</div>';
		}
		html += '</div>';
		el.innerHTML = html;
	}

	jQuery(document).ready(function() {
		renderBarChart('mnz-investigation-hourly-chart', d.hourly, d.hourLabels, barFill);
		renderBarChart('mnz-investigation-weekly-chart', d.weekly, d.weekLabels, '#28a745');
		renderMonthlyChart('mnz-investigation-monthly-chart', d.monthly, d.monthLabels);
	});
})();
</script>
