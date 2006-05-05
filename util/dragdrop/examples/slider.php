<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"
		xmlns:x2="http://www.w3.org/TR/xhtml2"
		xmlns:role="http://www.w3.org/2005/01/wai-rdf/GUIRoleTaxonomy#"
		xmlns:state="http://www.w3.org/2005/07/aaa">
<head>
<title>Yahoo! UI Library - Slider Widget</title>
<link rel="stylesheet" type="text/css" href="css/screen.css">
<style type="text/css">
</style>
</head>
<body> 
<div id="pageTitle"><h3>Drag and Drop - Slider Widgets</h3></div> 

<div id="container">
  <div id="containerTop">
    <div id="header"><img src="img/logo.gif" vspace="4" hspace="4" /></div>
	<div id="main">

		<div id="content"> 
		  <div class="newsItem"> 
			<h3>Basic Sliders</h3>
			  <p>
				The slider widget is an implementation of YAHOO.util.DragDrop 
				It also will use YAHOO.util.Animation if available to
				animate the movement of the thumb when you click the 
				slider background.

				The only difference between the two sliders aside from
				the fact that one is vertical and one horizontal is that 
				the horizontal slider implements the "tick mark" feature
				of drag and drop; it will "snap" to the tick marks spaced
				25 pixels apart.
			  </p>
              <!--
			  <p>
				<a href="javascript:slider1.lock()">Lock</a>
				<a href="javascript:slider1.unlock()">Unlock</a>
			  </p>
              -->

              <div id="vertWrapper">
              <div 
                 id="vertBGDiv"
                 name="vertBGDiv"
                 tabindex="0" 
                 x2:role="role:slider" 
                 state:valuenow="0" 
                 state:valuemin="0" 
                 state:valuemax="200"
                 title="Vertical Slider" 
                 onkeypress="return handleVertSliderKey(this, YAHOO.util.Event.getEvent(event))"
               >
              <div id="vertHandleDiv"><img src="img/vertSlider.png"></div> 
              </div>

                <div id="vertValueDiv">
                    <form name="formV" onsubmit="return updateVert()">
                    <input name="vertVal" id="vertVal" type="text" value="0" size="4" maxlength="4" />
                    <input type="button" value="Update" onclick="updateVert()" />
                    </form>
                </div>


              </div>
 
           <div id="horizWrapper">
           <div
             id="horizBGDiv"
             name="horizBGDiv"
             tabindex="0" 
             x2:role="role:slider" 
             state:valuenow="0" 
             state:valuemin="-100" 
             state:valuemax="100"
             title="Horizontal Slider" 
             onkeypress="return handleHorizSliderKey(this, YAHOO.util.Event.getEvent(event))"
           >
             <div id="horizHandleDiv" ><img src="img/horizSlider.png"></div> 

          </div> 

            <div id="horizValueDiv">
                <form name="formH" onsubmit="return updateHoriz()">
                <input name="horizVal" id="horizVal" type="text" value="0" size="4" maxlength="4" />
                <input type="button" value="Update" onclick="updateHoriz()" />
                </form>
            </div>


          </div>

     
		</div> 
      
    </div>
  </div>
</div>

<div id="content"> 
    <h3>Color Picker</h3>
      <p>
      Implements a slider region and a vertical slider to implement an HSV color
      picker.
      </p>

 

        <div id="pickerPanel" class="dragPanel">
            <h4 id="pickerHandle">&nbsp;</h4>
            <div id="pickerDiv">
              <img id="pickerbg" src="img/pickerbg.png" alt="">
              <div id="selector"><img src="img/select.gif"></div> 
            </div>

             <div id="hueBg">
              <div id="hueThumb"><img src="img/hline.png"></div> 
            </div> 

            <div id="pickervaldiv">
                <form name="pickerform" onsubmit="return pickerUpdate()">
                <br />
                R <input name="pickerrval" id="pickerrval" type="text" value="0" size="3" maxlength="3" />
                H <input name="pickerhval" id="pickerhval" type="text" value="0" size="3" maxlength="3" />
                <br />
                G <input name="pickergval" id="pickergval" type="text" value="0" size="3" maxlength="3" />
                S <input name="pickergsal" id="pickersval" type="text" value="0" size="3" maxlength="3" />
                <br />
                B <input name="pickerbval" id="pickerbval" type="text" value="0" size="3" maxlength="3" />
                V <input name="pickervval" id="pickervval" type="text" value="0" size="3" maxlength="3" />
                <br />
                <br />
                # <input name="pickerhexval" id="pickerhexval" type="text" value="0" size="6" maxlength="6" />
                <br />

                </form>
            </div>

            <div id="pickerSwatch">&nbsp;</div>
        </div>


		</div> 
      
    </div>
  </div>
</div>

<div id="content"> 
    <h3>RGB Slider</h3>
      <p>
      The RGB slider implements three slider controls to generate a
      RGB color.  The background color of each slider is also
      dynamically modified to reflect the colors that could be
      generated by moving a single slider.
      </p>


		</div> 
     

<?php include('inc/inc-alljs.php'); ?>

<script type="text/javascript" src="js/color.js" ></script>
<script type="text/javascript" src="js/key.js" ></script>
<script type="text/javascript" src="../../build/animation/animation.js" ></script>
<script type="text/javascript" src="../../build/slider/slider.js" ></script>
<script type="text/javascript">

	var hue;
	var picker;
	var gLogger;
	var dd1, dd2;
	var r, g, b;

	function init() {
		if (typeof(ygLogger) != "undefined") {
			ygLogger.init(document.getElementById("logDiv"));
			gLogger = new ygLogger("slider.php");
		}

        standardSliderInit();
        // rgbInit();
        pickerInit();
    }

    // Picker ---------------------------------------------------------

    function pickerInit() {
		hue = YAHOO.widget.Slider.getVertSlider("hueBg", "hueThumb", 0, 180);
		hue.onChange = function(newVal) { hueUpdate(newVal); };

		picker = YAHOO.widget.Slider.getSliderRegion("pickerDiv", "selector", 
				0, 180, 0, 180);
		picker.onChange = function(newX, newY) { pickerUpdate(newX, newY); };

		hueUpdate();

		dd1 = new YAHOO.util.DD("pickerPanel");
		dd1.setHandleElId("pickerHandle");
		dd1.endDrag = function(e) {
			// picker.thumb.resetConstraints();
			// hue.thumb.resetConstraints(); 
        };
	}

	window.onload = init;

	function pickerUpdate(newX, newY) {
		pickerSwatchUpdate();
	}

	function hueUpdate(newVal) {

		var h = (180 - hue.getValue()) / 180;
		if (h == 1) { h = 0; }

		gLogger.debug("hue " + hue.getValue());

		var a = YAHOO.util.Color.hsv2rgb( h, 1, 1);

		document.getElementById("pickerDiv").style.backgroundColor = 
			"rgb(" + a[0] + ", " + a[1] + ", " + a[2] + ")";

		pickerSwatchUpdate();
	}

	function pickerSwatchUpdate() {
		var h = (180 - hue.getValue());
		if (h == 180) { h = 0; }
		document.getElementById("pickerhval").value = (h*2);

		h = h / 180;
		gLogger.debug("h " + hue.getValue());

		var s = picker.getXValue() / 180;
		document.getElementById("pickersval").value = Math.round(s * 100);

		gLogger.debug("s " + s);

		var v = (180 - picker.getYValue()) / 180;
		document.getElementById("pickervval").value = Math.round(v * 100);

		gLogger.debug("v " + v);

		var a = YAHOO.util.Color.hsv2rgb( h, s, v );

		document.getElementById("pickerSwatch").style.backgroundColor = 
			"rgb(" + a[0] + ", " + a[1] + ", " + a[2] + ")";

		document.getElementById("pickerrval").value = a[0];
		document.getElementById("pickergval").value = a[1];
		document.getElementById("pickerbval").value = a[2];
		document.getElementById("pickerhexval").value = 
			YAHOO.util.Color.rgb2hex(a[0], a[1], a[2]);
	}


    // RGB slider ---------------------------------------------------------

	function rgbInit() {

		r = YAHOO.widget.Slider.getHorizSlider("rBG", "rthumb", 0, 128);
		r.onChange = function(newVal) { listenerUpdate("r", newVal*2); };

		g = YAHOO.widget.Slider.getHorizSlider("gBG", "gthumb", 0, 128);
		g.onChange = function(newVal) { listenerUpdate("g", newVal*2); };

		b = YAHOO.widget.Slider.getHorizSlider("bBG", "bthumb", 0, 128);
		b.onChange = function(newVal) { listenerUpdate("b", newVal*2); };

		initColor();

		dd2 = new YAHOO.util.DD("rgbPanel");
		dd2.setHandleElId("rgbHandle");
		dd2.endDrag = function(e) {
			// r.thumb.resetConstraints();
			// g.thumb.resetConstraints();
			// b.thumb.resetConstraints();
		}
	}


	function initColor() {
		var ch = " ";

		d = document.createElement("P");
		d.className = "rb";
		r.getEl().appendChild(d);
		d = document.createElement("P");
		d.className = "rb";
		g.getEl().appendChild(d);
		d = document.createElement("P");
		d.className = "rb";
		b.getEl().appendChild(d);

		for (var i=0; i<34; i++) {
			d = document.createElement("SPAN");
			d.id = "rBG" + i
			// d.innerHTML = ch;
			r.getEl().appendChild(d);

			d = document.createElement("SPAN");
			d.id = "gBG" + i
			// d.innerHTML = ch;
			g.getEl().appendChild(d);

			d = document.createElement("SPAN");
			d.id = "bBG" + i
			// d.innerHTML = ch;
			b.getEl().appendChild(d);
		}

		d = document.createElement("P");
		d.className = "lb";
		r.getEl().appendChild(d);
		d = document.createElement("P");
		d.className = "lb";
		g.getEl().appendChild(d);
		d = document.createElement("P");
		d.className = "lb";
		b.getEl().appendChild(d);

		userUpdate();
	}

	function updateSliderColors() {
		var curr, curg, curb;
		curr = Math.min(r.getValue() * 2, 255);
		curg = Math.min(g.getValue() * 2, 255);
		curb = Math.min(b.getValue() * 2, 255);

        gLogger.debug("updateSliderColor " + curr + ", " + curg + ", " + curb);

		var d;
		for (var i=0; i<34; i++) {
			d = document.getElementById("rBG" + i);
			d.style.backgroundColor = 
				"rgb(" + (i*8) + "," + curg + "," + curb + ")";

			d = document.getElementById("gBG" + i);
			d.style.backgroundColor = 
				"rgb(" + curr + "," + (i*8) + "," + curb + ")";

			d = document.getElementById("bBG" + i);
			d.style.backgroundColor = 
				"rgb(" + curr + "," + curg + "," + (i*8) + ")";
		}

		document.getElementById("rgbSwatch").style.backgroundColor =
			"rgb(" + curr + "," + curg + "," + curb + ")";

		document.getElementById("hexval").value = 
					YAHOO.util.Color.rgb2hex(curr, curg, curb);
	}


	function listenerUpdate(whichSlider, newVal) {
		if (newVal == 256) {
			newVal = 255;
		}
		document.getElementById(whichSlider + "val").value = newVal;
		updateSliderColors();
	}

	function userUpdate(isHex) {
        gLogger.debug("userupdate");
		var v;
		var f = document.forms['rgbform'];

		if (isHex) {
			var hexval = f["hexval"].value;
			// shorthand #369
			if (hexval.length == 3) {
				var newval = "";
				for (var i=0;i<3;i++) {
					var a = hexval.substr(i, 1);
					newval += a + a;
				}

				hexval = newval;
			}

			gLogger.debug("hexval:" + hexval);

			if (hexval.length != 6) {
				alert("illegal hex code: " + hexval);
			} else {
				var rgb = YAHOO.util.Color.hex2rgb(hexval);
				// alert(rgb.toString());
				if (YAHOO.util.Color.isValidRGB(rgb)) {
					f['rval'].value = rgb[0];
					f['gval'].value = rgb[1];
					f['bval'].value = rgb[2];
				}
			}
		}

		// red
		v = parseFloat(f['rval'].value);
		v = ( isNaN(v) ) ? 0 : Math.round(v);
		r.setValue(Math.round(v) / 2);

		v = parseFloat(f['gval'].value);
		v = ( isNaN(v) ) ? 0 : Math.round(v);
		g.setValue(Math.round(v) / 2);

		v = parseFloat(f['bval'].value);
		v = ( isNaN(v) ) ? 0 : Math.round(v);
		b.setValue(Math.round(v) / 2);

		updateSliderColors();

		return false;
	}

	function userReset() {
		var v;
		var f = document.forms['rgbform'];

		r.setValue(0);
		g.setValue(0);
		b.setValue(0);
	}

var slider1, slider2;
	function standardSliderInit() {

		slider1 = YAHOO.widget.Slider.getVertSlider("vertBGDiv", "vertHandleDiv", 0, 200);

		slider1.onChange = function(offsetFromStart) {
			document.getElementById("vertVal").value = offsetFromStart;
		}

		slider2 = YAHOO.widget.Slider.getHorizSlider("horizBGDiv", "horizHandleDiv", 100, 100, 25);

		slider2.onChange = function(offsetFromStart) {
			document.getElementById("horizVal").value = offsetFromStart;
		}

        // if (document.getElementById("vertBGDiv").getAttributeNS) {
            // slider1.focusOnClick = true;
            // slider2.focusOnClick = true;
        // }
	}

	function updateVert() {
		var v = parseFloat(document.forms['formV']['vertVal'].value, 10);
		if ( isNaN(v) ) v = 0;
		slider1.setValue(Math.round(v));
		return false;
	}
	
	function updateHoriz() {
		var v = parseFloat(document.forms['formH']['horizVal'].value, 10);
		if ( isNaN(v) ) v = 0;
		slider2.setValue(Math.round(v));
		return false;
	}

// accessibility keypress test
function handleHorizSliderKey(slider, ev) {
	if (gLogger) gLogger.debug("horizontal slider keypress");

    // Firefox 1.5+ only at this point
    if (!slider.getAttributeNS) {
        return true;
    }

	// var valueNow = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuenow"));

	var valueNow = slider2.getValue();

	var valueMin = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuemin"));
	var valueMax = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuemax"));

	var delta = 0;

	var kc = ev.keyCode;

	if (gLogger) gLogger.debug("keycode: " + kc);

	if (kc == YAHOO.util.Key.DOM_VK_LEFT) {
		delta = -25;
	} else if (kc == YAHOO.util.Key.DOM_VK_RIGHT) {
		delta = 25;
	} else if (kc == YAHOO.util.Key.DOM_VK_HOME) {
		delta = -( valueNow - valueMin );
	} else if (kc == YAHOO.util.Key.DOM_VK_END) {
		delta = valueMax - valueNow;
	} else {
		return true;
	}
	
	valueNow += delta;

	slider2.setValue(valueNow, true);

	slider.setAttributeNS("http://www.w3.org/2005/07/aaa", "valuenow", valueNow);
	
	// displaySlider(slider);

	return false;
}

function handleVertSliderKey(slider, ev) {
	if (gLogger) gLogger.debug("vertical slider keypress");

    // Firefox 1.5+ only at this point
    if (!slider.getAttributeNS) {
        return true;
    }

	// var valueNow = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuenow"));

	var valueNow = slider1.getValue();

	var valueMin = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuemin"));
	var valueMax = parseInt(slider.getAttributeNS("http://www.w3.org/2005/07/aaa", "valuemax"));

	var delta = 0;
	var kc = ev.keyCode;
	if (kc == YAHOO.util.Key.DOM_VK_UP) {
		delta = -20;
	}
	else if (kc == YAHOO.util.Key.DOM_VK_DOWN) {
		delta = 20;
	}
	else if (kc == YAHOO.util.Key.DOM_VK_HOME) {
		delta = -( valueNow - valueMin );
	}
	else if (kc == YAHOO.util.Key.DOM_VK_END) {
		delta = valueMax - valueNow;
	}
	else {
		return true;
	}
	
	valueNow += delta;
	if (valueNow < valueMin) {
		valueNow = valueMin;
	}

	if (valueNow > valueMax) {
		valueNow = valueMax;
	}  
	slider.setAttributeNS("http://www.w3.org/2005/07/aaa", "valuenow", valueNow);
	
	// displaySlider(slider);
	slider1.setValue(valueNow, true);

	return false;
}

</script>


<!--[if gte IE 5.5000]>
<script type="text/javascript">

function correctPNG() // correctly handle PNG transparency in Win IE 5.5 or higher.
   {
   for(var i=0; i<document.images.length; i++)
      {
	  var img = document.images[i]
	  var imgName = img.src.toUpperCase()
	  if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
	     {
		 var imgID = (img.id) ? "id='" + img.id + "' " : ""
		 var imgClass = (img.className) ? "class='" + img.className + "' " : ""
		 var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
		 var imgStyle = "display:inline-block;" + img.style.cssText 
		 if (img.align == "left") imgStyle = "float:left;" + imgStyle
		 if (img.align == "right") imgStyle = "float:right;" + imgStyle
		 if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle		
		 var strNewHTML = "<span " + imgID + imgClass + imgTitle
		 + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
	     + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
		 + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
		 img.outerHTML = strNewHTML
		 i = i-1
	     }
      }
   }

YAHOO.util.Event.addListener(window, "load", correctPNG);

</script>
<![endif]-->

</body>
</html>
