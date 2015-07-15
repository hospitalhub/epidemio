jQuery(document).ready(function($) {
	var nowPlus = new Date();
	nowPlus.setTime(nowPlus.getTime() + 24 * 60 * 60 * 1000);
	// yyyy-mm-dd
	$('.datepicker').datepicker({
		format : 'yyyy-mm-dd',
		language : "pl",
		"autoclose" : true,
		"todayHighlight" : true,
		startDate : new Date(2014, 11, 1),
		endDate : nowPlus
	});
	$('.datepicker').datepicker('update', new Date());
	// yyyy-mm
	$('.datepicker-lastmonth').datepicker({
		format : 'yyyy-mm',
		language : "pl",
		"autoclose" : true,
		"todayHighlight" : true,
		minViewMode : 1,
		startDate : new Date(2014, 11, 1),
		endDate : nowPlus
	});
	var minusMonth = new Date();
	minusMonth.setMonth(minusMonth.getMonth() - 1);
	$('.datepicker-lastmonth').datepicker('update', minusMonth);
	$('.datepicker-month-no-autovalue').datepicker({
		format : 'yyyy-mm',
		language : "pl",
		"autoclose" : true,
		"todayHighlight" : true,
		minViewMode : 1
	});

	if (typeof data !== 'undefined') {
		var $table = $('#table-transform');
		var $params = {
			'data' : data,
			formatSearch : function() {
				return "szukaj"
			},
			formatToggle : function() {
				return "widok kart"
			},
			formatColumns : function() {
				return "kolumny"
			},
			formatNoMatches : function() {
				return "brak wyników"
			},
		};
		$table.bootstrapTable($params);
		$(".saveVeryfication").on('click', function() {
			var id = $(this).attr('name');
			$("#weryfikacja" + id).css("background-color", "#FF0");
			var data = {
				'action' : 'infections_verification_action',
				'data' : readForm(id)
			};
			postData(data);
		});

		function readForm(id) {
			var infectionVeryfication = {};
			infectionVeryfication['id'] = id;
			var value = $('#weryfikacja' + id).attr('value');
			infectionVeryfication['value'] = value;
			var resultString = JSON.stringify(infectionVeryfication);
			console.log('INFECTIONS: ' + resultString);
			return resultString;
		}

		function postData(data) {
			try {
				// implementations
				jQuery.post('admin-ajax.php', data, function(response) {
					try {
						var message = stripTags(response);
						console.log('RESPONSE ID: ' + message);
						var id = "#weryfikacja" + message.replace("\n", "");
						$(id).css("background-color", "#3C3");
					} catch (err) {
						console.log("ERR: " + err);
					}
				});
			} catch (err) {
				console.log("ERR: " + err);
			}
		}

		function stripTags(text) {
			return $("<html>" + text + "</html>").text();
		}
		
	}
});
