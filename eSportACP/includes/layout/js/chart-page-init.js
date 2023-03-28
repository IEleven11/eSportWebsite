  $(function() {
    // we use an inline data source in the example, usually data would
    // be fetched from a server
   // ==============================================================
    // Real Time Visits
    // ==============================================================

    // Set up the control widget
    var updateInterval = 1000;
    $("#updateInterval").val(updateInterval).change(function() {
        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            if (updateInterval < 1) {
                updateInterval = 1;
            } else if (updateInterval > 1000) {
                updateInterval = 1000;
            }
            $(this).val("" + updateInterval);
        }
    });
    window.onresize = function(event) {
        $.plot($("#real-time"), []);
    }

    function update() {
        plot.setData([]);
        // Since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        setTimeout(update, updateInterval);
    }
    update();

        console.log("document ready");
        var offset = 0;
        plot1();

        function plot1() {
            var visitors = [];
            for (var i = 0; i < 30; i += 1) {
                visitors.push([i, Math.sin(i + offset)]);
            }
            var options = {
                series: {
                    lines: {
                        show: true
                    }
                    , points: {
                        show: true
                    }
                }
                , grid: {
                    hoverable: true //IMPORTANT! this is needed for tooltip to work
                }
                , yaxis: {
                    min: 0
                    , max: 50000  
                }
                , colors: ["#ee7951"]
                , grid: {
                    color: "#AFAFAF"
                    , hoverable: true
                    , borderWidth: 0
                    , backgroundColor: '#FFF'
                }
                , tooltip: true
                , tooltipOpts: {
                    content: "'%s' of %x.1 is %y.10"
                    , shifts: {
                        x: -60
                        , y: 25
                    }
                }
            };
            var plotObj = $.plot($("#flot-line-chart"), [{
                data: visitors
                , label: "عدد الزوار"
            , }, ], options);
        }

});