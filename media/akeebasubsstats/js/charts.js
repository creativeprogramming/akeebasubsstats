/**
 * AkeebaSubsStats chart script
 *
 * @package         AkeebaSubsStats
 * @version         1.0.0
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2012 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

var akeebasubsstats_charts = [];

function akeebasubsstats_render_chart(by, format, data, max_count, max_amount, avg_count, avg_amount)
{
	(function($)
	{
		$.jqplot.config.enablePlugins = true;
		akeebasubsstats_charts[by] = $.jqplot('akeebasubsstats_chart_' + by, data,
			{
				axes: {
					xaxis: {
						renderer: $.jqplot.DateAxisRenderer,
						tickOptions: {
							formatString: format
						}
					},
					yaxis: {
						numberTicks: 5,
						min: 0,
						max: max_count,
						tickOptions: {
							formatString: '%.0f',
							textColor: '#317331'
						}
					},
					y2axis: {
						numberTicks: 3,
						min: 0,
						max: max_amount,
						tickOptions: {
							formatString: '%.0f',
							textColor: '#00468f'
						}
					}
				},
				seriesDefaults: {
					renderer: $.jqplot.LineRenderer,
					lineWidth: 1,
					rendererOptions: {
						smooth: true,
						highlightMouseDown: true
					},
					showMarker: true,
					markerOptions: {
						size: 4
					},
					shadow: false
				},
				series: [
					{
						label: 'Subscriptions',
						color: 'rgba(49, 115, 49, 0.5)',
						fill: true,
					},
					{
						label: 'Net Sales',
						yaxis: 'y2axis',
						color: 'rgba(0, 70, 143, 0.5)',
						fill: true,
					},
					{
						label: 'Subscriptions',
						color: 'rgba(49, 115, 49, 1)',
						lineWidth: 2,
						showMarker: true,
					},
					{
						label: 'Net Sales',
						yaxis: 'y2axis',
						color: 'rgba(0, 70, 143, 1)',
						lineWidth: 2,
						showMarker: true,
						markerOptions: {
							size: 7
						}
					}
				],
				canvasOverlay: {
					show: true,
					objects: [
						{dashedHorizontalLine: {
							name: 'Subscriptions',
							y: avg_count,
							lineWidth: 1,
							color: 'rgba(49, 115, 49, 1)',
							shadow: false
						}},
						{dashedHorizontalLine: {
							name: 'Net Sales',
							y: (avg_amount / max_amount * max_count ),
							lineWidth: 1,
							color: 'rgba(0, 70, 143, 1)',
							shadow: false
						}}
					]
				},
				highlighter: {
					show: true,
					sizeAdjust: 4,
					formatString: '%s<br />#serieLabel#: %d',
				}
			});
	})(akeeba.jQuery);
}

function akeebasubsstats_render_chart_levels(by, data, labels, max_amount, stacked)
{
	(function($)
	{
		$.jqplot.config.enablePlugins = true;
		akeebasubsstats_charts[by] = $.jqplot('akeebasubsstats_chart_' + by, data,
			{
				axes: {
					xaxis: (by == 'day' ? {
						renderer: $.jqplot.DateAxisRenderer,
						tickOptions: {
							formatString: '%b&nbsp;%#d'
						}
					} : {
						renderer: $.jqplot.CategoryAxisRenderer
					}),
					yaxis: {
						numberTicks: 3,
						min: 0,
						max: max_amount,
						tickOptions: {
							formatString: '%.0f'
						}
					}
				},
				seriesColors: [
					'#0064cd',
					'#46a546',
					'#9d261d',
					'#ffc40d',
					'#049cdb',
					'#f89406',
					'#c3325f',
					'#7a43b6',

					'#00468f',
					'#317331',
					'#6e1b14',
					'#b28909',
					'#036d99',
					'#ad6704',
					'#882342',
					'#552f7f',

					'#4d93dc',
					'#7ec07e',
					'#ad6704',
					'#ffd656',
					'#50bae6',
					'#fab451',
					'#d5708f',
					'#a27ccc',
				],
				stackSeries: stacked,
				seriesDefaults: {
					fill: stacked,
					lineWidth: 2,
					rendererOptions: {
						smooth: true,
						highlightMouseDown: true
					},
					showMarker: true,
					markerOptions: {
						size: 7
					},
					shadow: false
				},
				series: labels,
				highlighter: {
					show: true,
					sizeAdjust: 4,
					tooltipAxes: 'y',
					formatString: '%s : #serieLabel#'
				},
				legend: {
					renderer: $.jqplot.EnhancedLegendRenderer,
					show: true,
					location: 'e',
					placement: 'outside',
					rowSpacing: "0px",
				}
			});
	})(akeeba.jQuery);
}
