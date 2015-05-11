
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Language" content="pt-br">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">

<meta name="description" content="Sistema de Administração - Acesso Restrito">
<meta name="robots" content="none">

<meta name="keywords" content="Sistema de Administração - Acesso Restrito">


<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/colorpicker/assets/skins/sam/colorpicker.css" />

    <title>Escolha a cor</title>

  </head>
  
  <body bgcolor="#dddddd" leftmargin=0 topmargin=0>


<div id="container" class="yui-skin-sam" ></div>

<!-- javaskripti -->
<script type="text/javascript" src="../_js/colorscripts_0.1.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/slider/slider-min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/element/element-min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/colorpicker/colorpicker-min.js"></script>
<script type="text/javascript" language="javascript"> 
(function() {
 var Event = YAHOO.util.Event, picker, hexcolor;
 
 Event.onDOMReady(function() {
 picker = new YAHOO.widget.ColorPicker("container", {
 showhsvcontrols: true,
 showhexcontrols: true,
					showwebsafe: false,
					images: {
						PICKER_THUMB: "http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/colorpicker/assets/picker_thumb.png",
						HUE_THUMB: "http://ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/colorpicker/assets/hue_thumb.png"
 				} });
			picker.skipAnim=true;	
			var onRgbChange = function(o) {				setTimeout ("document.getElementById('yui-picker-hex').select()", 50);			}
			picker.on("rgbChange", onRgbChange);
			Event.on("newcolor", "click", function(e) {
				hexcolor = checkcolor1(document.getElementById('startcolor').value);
				picker.setValue([HexToR(hexcolor), HexToG(hexcolor), HexToB(hexcolor)], false); 
			});
 });
})();
</script>




  </body>
</html>

