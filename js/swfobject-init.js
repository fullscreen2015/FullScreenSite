	// esta função necessita da biblioteca "swfobject.js"

	function fw_flash(id_flash,url,largura,altura)
	{

		swfobject.embedSWF
		(
			url, 
			id_flash, 
			largura, 
			altura,
			(swfobject.getQueryParamValue("detectflash")=="false" ? "0" : "10.2.0"), 
			"expressInstall.swf", 
			false, 
			{
				scale:"noscale", 
				menu:"false",
				wmode:"transparent"
			},
			{
				id:id_flash
			}	
		);

	}