(function () {
    var method;
    var noop = function () { };
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* fade out and reload */

$(document).on('click', '.count', function(e) {    
    //var aLink = $(this).attr("href");

    $("#random-image").fadeOut(560, function() {
        $.get('index.php', function(data){
            var $data= $(data);
            $("#stats-outer").html($data.find('#stats'));
            $(".count").html($data.find("#random-image"));
        });
    });

    e.preventDefault();
});

/*
			document.getElementById("button").addEventListener("click", function () {
				var httpRequest = new XMLHttpRequest();
				var images = document.getElementById("random-image");
				var counter = document.getElementById("stats");

				httpRequest.onreadystatechange = function (data) {
					
					if (httpRequest.readyState != 4 || httpRequest.status != 200) {
						images.classList.add("fade--out");
						document.getElementById("stats").innerHTML;
						
						console.log("success");
					}
				}

				httpRequest.open("GET", "loader.php")
				httpRequest.send()
			});
			*/