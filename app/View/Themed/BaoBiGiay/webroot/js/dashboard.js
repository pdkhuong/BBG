$(function() {
  if ($('#UserUsername')) {
    if ($('#UserUsername').val() === '') {
      $('#UserUsername').focus();
    } else {
      $('#UserPassword').focus();
    }
  }



  function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
  }

  //

  function setCode(lines) {
    $("#code").text(lines.join("\n"));
  }
  
  jQuery(".block .block-tool > a").on("click", function(e) {
    if (jQuery(this).data("action") == undefined) {
      return
    }
    var t = jQuery(this).data("action");
    var n = jQuery(this);
    switch (t) {
      case"collapse":
        jQuery(n).children("i").addClass("anim-turn180");
        jQuery(this).parents(".block").children(".block-body").slideToggle(500, function() {
          if (jQuery(this).is(":hidden")) {
            jQuery(n).children("i").attr("class", "fa fa-chevron-down")
          } else {
            jQuery(n).children("i").attr("class", "fa fa-chevron-up")
          }
        });
        break;
      case"close":
        jQuery(this).parents(".block").fadeOut(500, function() {
          jQuery(this).parent().remove()
        });
    }
    e.preventDefault();
  });

  jQuery(".todo-list li").on("click", function(e){
    var tag_a = $(this).find("a");
    window.location = tag_a.attr("href");
  });

    if (jQuery().sf_radio_checkbox) {
        $("input[type=checkbox], input[type=radio]").sf_radio_checkbox();
    }

    if (jQuery.plot) {
        var g = $("#visitors-chart");
        if ($(g).size() == 0) {
            return
        }
        var y = [
            [8, 100],
            [9, 270],
            [10, 570],
            [11, 830],
            [12, 630],
            [13, 580],
            [14, 380],
            [15, 550],
            [16, 680],
            [17, 610],
            [18, 520]
        ];
        var b = [
            [8, 50],
            [9, 160],
            [10, 370],
            [11, 470],
            [12, 370],
            [13, 80],
            [14, 60],
            [15, 190],
            [16, 430],
            [17, 280],
            [18, 350]
        ];
        var w = ["#88bbc8", "#ed7a53", "#9FC569", "#bbdce3", "#9a3b1b", "#5a8022", "#2c7282"];
        var E = {
            grid: {
                show: true,
                aboveData: true,
                color: "#3f3f3f",
                labelMargin: 5,
                axisMargin: 0,
                borderWidth: 0,
                borderColor: null,
                minBorderMargin: 5,
                clickable: true,
                hoverable: true,
                autoHighlight: true,
                mouseActiveRadius: 20
            },
            series: {
                grow: {
                    active: false,
                    stepMode: "linear",
                    steps: 50,
                    stepDelay: true
                },
                lines: {
                    show: true,
                    fill: true,
                    lineWidth: 3,
                    steps: false
                },
                points: {
                    show: true,
                    radius: 4,
                    symbol: "circle",
                    fill: true,
                    borderColor: "#fff"
                }
            },
            legend: {
                position: "ne",
                margin: [0, -25],
                noColumns: 0,
                labelBoxBorderColor: null,
                labelFormatter: function(e, t) {
                    return e + "&nbsp;&nbsp;"
                }
            },
            yaxis: {
                min: 0
            },
            xaxis: {
                ticks: 11,
                tickDecimals: 0
            },
            colors: w,
            shadowSize: 1,
            tooltip: true,
            tooltipOpts: {
                content: "%s : %y.0",
                defaultTheme: false,
                shifts: {
                    x: -30,
                    y: -50
                }
            }
        };
        $.plot(g, [{
            label: "Visits",
            data: y,
            lines: {
                fillColor: "#f2f7f9"
            },
            points: {
                fillColor: "#88bbc8"
            }
        }, {
            label: "Prospect",
            data: b,
            lines: {
                fillColor: "#fff8f2"
            },
            points: {
                fillColor: "#ed7a53"
            }
        }], E);

        //
//    var data = [],
//      series = Math.floor(Math.random() * 6) + 3;
//    var devices = ['iPhone 4', 'iPhone 5', 'Samsung', 'HTC', 'Nokia', 'LG', 'iPad 3', 'iPad 4'];
//    for (var i = 0; i < series; i++) {
//      data[i] = {
//        label: devices[i],
//        data: Math.floor(Math.random() * 100) + 1
//      }
//    }
//    $.plot('#placeholder', data, {
//      series: {
//        pie: {
//          show: true,
//          radius: 1,
//          tilt: 0.5,
//          label: {
//            show: true,
//            radius: 1,
//            formatter: labelFormatter,
//            background: {
//              opacity: 0.8
//            }
//          },
//          combine: {
//            color: '#999',
//            threshold: 0.1
//          }
//        }
//      },
//      legend: {
//        show: false
//      }
//    });
    }
})