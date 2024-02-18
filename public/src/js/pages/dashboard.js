//[Dashboard Javascript]

//Project:	CRMi - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
		var options = {
          series: [{
		  name: 'Inpatients',
          data: [1044, 1055, 957, 1056, 861, 958, 863, 1045, 1012, 999, 1002, 956, 1025, 956, 745]
        }, {
          name: 'Outpatients',
          data: [1276, 1385, 1101, 1198, 1187, 1105, 1291, 1296, 1285, 1201, 1398, 1387, 1205, 1091, 1191]
        }],
          chart: {
          type: 'bar',
		  foreColor:"#172b4c",
          height: 380,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
			borderRadius: 3,
            horizontal: false,
            columnWidth: '40%',
          },
        },
        dataLabels: {
          enabled: false,
        },
		grid: {
			show: true,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#3596f7', '#172b4c'],
        xaxis: {
          categories: ['10 May', '11 May', '12 May', '13 May', '14 May', '15 May', '16 May', '17 May', '18 May', '19 May', '20 May', '21 May', '22 May', '23 May', '24 May'],
			
        },
        yaxis: {
          
        },
		 legend: {
      		show: true,
			position: 'top',
      		horizontalAlign: 'right',
		 },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "Total"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#patients_trend"), options);
        chart.render(); 
	
		
		
	
		var options = {
          series: [{
			  name: 'waiting',
			  data: [50, 36, 50, 46, 59, 50, 67]
		  }],
          chart: {
          type: 'bar',
		  foreColor:"#172b4c",
          height: 385,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
			horizontal: true,
          },
        },
        dataLabels: {
          enabled: false,
        },
		grid: {
			show: true,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#3596f7'],
        xaxis: {
          categories: ['Cardiology', 'Dematology', 'Gynaecology', 'Neurology', 'Oncology', 'Orthopaedics', 'Surgery'],
			
        },
		 annotations: {
          xaxis: [{
            x: 50,
            borderColor: '#00E396',
            label: {
              borderColor: '#00E396',
              style: {
                color: '#fff',
                background: '#00E396',
              },
              text: 'Avg. Waiting',
            }
          }],
		 },
        fill: {
          opacity: 1
        },
		 legend: {
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 40
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "Total"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#avg_waiting"), options);
        chart.render(); 
	
	
	
	
	
		var options = {
          series: [42, 38, 20],
		  labels: ['Excellent', 'Good', 'Negative'],
          chart: {
          height: 330,
          type: 'donut',
        },
        dataLabels: {
          enabled: false
        },
		plotOptions: {
			pie: {
			  customScale: 0.90,
			  donut: {
				size: '60%',
				  labels: {
					show: true,
					total: {
					  showAlways: true,
					  show: true,
					  label: 'Positive',
					  formatter: function (w) {
						return w.globals.seriesTotals.reduce((a, b, c) => {
						  return a + b + c
						}, -23)
					  }
					},
					  
				  }
			  },
			  offsetY: 0,
			},
			stroke: {
			  colors: undefined
			}
		 },
		colors:['#3596f7', '#146dc7', '#c8c8c8'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              height: 300
            },
            legend: {
              show: false
            }
          }
        }],
        legend: {
          position: 'bottom',
        }
        };

        var chart = new ApexCharts(document.querySelector("#patient_satisfaction"), options);
        chart.render();
	
	
		
		
		
	
		var options = {
          series: [{			  
			  data: [45, 26, 17, 7, 4]
		  }],
          chart: {
          type: 'bar',
		  foreColor:"#172b4c",
          height: 200,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
			borderRadius: 3,
			horizontal: true,
            columnWidth: '20%',
			  dataLabels: {
				  position: 'top',
				},
          },
        },
        dataLabels: {
          enabled: true,
          offsetX: -6,
          style: {
            fontSize: '12px',
            colors: ['#fff']
          },
			formatter: function (val) {
              return val + "%"
            }
        },
		grid: {
			show: false,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#3596f7'],
        xaxis: {
          categories: ['Full Agree', 'Rather Agree', 'Rather Disagree', 'Full Disagree', 'Dont Know'],
			
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "%"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#treatment_satisfaction"), options);
        chart.render();
	
	
	
	
		
		
		
	
		var options = {
          series: [{			  
			  data: [31, 33, 24, 8, 4]
		  }],
          chart: {
          type: 'bar',
		  foreColor:"#172b4c",
          height: 200,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
			borderRadius: 3,
			horizontal: true,
            columnWidth: '20%',
			  dataLabels: {
				  position: 'top',
				},
          },
        },
        dataLabels: {
          enabled: true,
          offsetX: -6,
          style: {
            fontSize: '12px',
            colors: ['#fff']
          },
			formatter: function (val) {
              return val + "%"
            }
        },
		grid: {
			show: false,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#3596f7'],
        xaxis: {
          categories: ['Full Agree', 'Rather Agree', 'Rather Disagree', 'Full Disagree', 'Dont Know'],
			
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "%"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#physician_satisfaction"), options);
        chart.render();
	
		
		
		var options = {
          series: [{
          name: 'OPD',
          data: [76, 85, 101, 98, 87, 105, 91]
        }, {
          name: 'Admitted',
          data: [44, 55, 57, 56, 61, 58, 63]
        }],
          chart: {
          type: 'bar',
		  foreColor:"#172b4c",
          height: 245,
		  stacked: true,
		  toolbar: {
			show: false,
		  }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '30%',
          },
        },
        dataLabels: {
          enabled: false,
        },
		grid: {
			show: true,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#3596f7', '#88c3ff'],
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July'],
			
        },
        yaxis: {
          
        },
		 legend: {
      		show: true,
			position: 'top',
		 },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#patient_statistics"), options);
        chart.render();
	
	
		
		
	
		var options = {
          series: [
          {
            name: "Heart",
			data: [12, 22, 14, 18, 22 , 13, 17]
          },
          {
            name: "Fracture",            
            data: [28, 39, 23, 36, 45, 32, 43]
          },
          {
            name: "Cold",            
            data: [17, 12, 28, 12, 33, 26, 23]
          }
        ],
          chart: {
          height: 245,
          type: 'area',
		  foreColor:"#172b4c",
          toolbar: {
            show: false
          }
        },
        colors: ['#3596f7', '#7047ee', '#ee3158'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
			width: 1,
        },
        grid: {
          borderColor: '#e7e7e7',
        },
		fill: {
			colors: ['#3596f7', '#7047ee', '#ee3158'],
  			opacity: 0.9,
		},
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        },
        legend: {
      		show: true,
			position: 'top',
        }
        };

        var chart = new ApexCharts(document.querySelector("#recovery_statistics"), options);
        chart.render();
	
		$('.inner-user-div4').slimScroll({
			height: '127px'
	    });
		$('.inner-user-div').slimScroll({
			height: '283px'
		});
		$('.inner-user-div3').slimScroll({
			height: '435px'
		});
		$('.inner-user-div2').slimScroll({
			height: '408px'
		});
	
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 0,
			responsiveClass: true,
			autoplay: true,
			dots: false,
			nav: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  600: {
				items: 1,
			  },
			  1000: {
				items: 1,
			  }
			}
		  });
	
	
	
}); // End of use strict


$(function () {

  'use strict';
	
	
	
}); // End of use strict
