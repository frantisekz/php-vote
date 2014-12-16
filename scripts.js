var doughnutData = [
				{
					value: 30,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Odpověď 1"
				},
				{
					value: 5,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Odpověď 2"
				},
				{
					value: 10,
					color: "#fff400",
					highlight: "#fffba4",
					label: "Odpověď 3"
				},
				{
					value: 40,
					color: "#2c6acf",
					highlight: "#6594e0",
					label: "Odpověď 4"
				},

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
			};




$(function() {
    $('#Poll_2, #Poll_1, #Poll_3, #Poll_4').textfill({
        maxFontPixels: 400
    });
});

$('.tlt').textillate({
  // the default selector to use when detecting multiple texts to animate
  selector: '.texts',

  // enable looping
  loop: false,

  // sets the minimum display time for each text before it is replaced
  minDisplayTime: 2000,

  // sets the initial delay before starting the animation
  // (note that depending on the in effect you may need to manually apply 
  // visibility: hidden to the element before running this plugin)
  initialDelay: 0,

  // set whether or not to automatically start animating
  autoStart: true,

  // custom set of 'in' effects. This effects whether or not the 
  // character is shown/hidden before or after an animation  
  inEffects: [],

  // custom set of 'out' effects
  outEffects: [ 'hinge' ],

  // in animation settings
  in: {
    // set the effect name
    effect: 'fadeInLeftBig',

    // set the delay factor applied to each consecutive character
    delayScale: 1.5,

    // set the delay between each character
    delay: 50,

    // set to true to animate all the characters at the same time
    sync: false,

    // randomize the character sequence 
    // (note that shuffle doesn't make sense with sync = true)
    shuffle: false,

    // reverse the character sequence 
    // (note that reverse doesn't make sense with sync = true)
    reverse: false,

    // callback that executes once the animation has finished
    callback: function () {}
  },

  // out animation settings.
  out: {
    effect: 'hinge',
    delayScale: 1.5,
    delay: 50,
    sync: false,
    shuffle: false,
    reverse: false,
    callback: function () {}
  },

  // callback that executes once textillate has finished 
  callback: function () {}
});
