$(document).ready(function() {
$("#news_dis").mouseover(function() {
	$(this).attr("src","App/Themes/Image/news_on.png");
	})
$("#news_dis").mouseout(function() {
	$(this).attr("src","App/Themes/Image/news.png");
})
$("#news_dis").click(function() {
	window.location.href='?c=home&a=index';
});
})