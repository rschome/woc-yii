$(document).ready(function() {
	$("#TableSorter tr").hover(function() {
		$(this).addClass("tb_active");
	}, function() {
		$(this).removeClass("tb_active");
	});
$(".bd_c_1 tr:even , .bd_c_2 tr:even").addClass("even");

});
