	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, June 2006
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	

	
	
	
	var opacitySpeed = 2;	// Speed of opacity - switching between large images - Lower = faster
	var opacitySteps = 6; 	// Also speed of opacity - Higher = faster
	var slideSpeed = 4;	// Speed of thumbnail slide - Lower = faster
	
	/* Don't change anything below here */
	var DHTMLgoodies_largeImage = false;
	var DHTMLgoodies_imageToShow = false;
	var DHTMLgoodies_currentOpacity = 100;
	var DHTMLgoodies_slideWidth = false;
	var DHTMLgoodies_thumbTotalWidth = false;
	var DHTMLgoodies_viewableWidth = false;
	
	var currentUnqiueOpacityId = false;
	var DHTMLgoodies_currentActiveImage = false;
	var DHTMLgoodies_thumbDiv = false;
	var DHTMLgoodies_thumbSlideInProgress = false;
	
	var browserIsOpera = navigator.userAgent.indexOf('Opera')>=0?true:false;
	var leftArrowObj;
	var rightArrowObj;
	
	function initGalleryScript()
	{
		leftArrowObj = document.getElementById('DHTMLgoodies_leftArrow');		
		leftArrowObj.style.visibility='hidden';
		rightArrowObj = document.getElementById('DHTMLgoodies_rightArrow');	
		leftArrowObj.style.cursor = 'pointer';	
		rightArrowObj.style.cursor = 'pointer';	
		leftArrowObj.onclick = moveThumbnails;
		rightArrowObj.onclick = moveThumbnails;
		DHTMLgoodies_largeImage = document.getElementById('DHTMLgoodies_largeImage').getElementsByTagName('IMG')[0];
		var innerDiv = document.getElementById('DHTMLgoodies_thumbs_inner');
		DHTMLgoodies_slideWidth = innerDiv.getElementsByTagName('DIV')[0].offsetWidth;
		DHTMLgoodies_thumbDiv = document.getElementById('DHTMLgoodies_thumbs_inner');
		DHTMLgoodies_thumbDiv.style.left = '0px';
		
		var subDivs = DHTMLgoodies_thumbDiv.getElementsByTagName('DIV');
		DHTMLgoodies_thumbTotalWidth = 0;
		for(var no=0;no<subDivs.length;no++){
			if(subDivs[no].className=='strip_of_thumbnails')DHTMLgoodies_thumbTotalWidth = DHTMLgoodies_thumbTotalWidth + DHTMLgoodies_slideWidth;
		}

		DHTMLgoodies_viewableWidth = document.getElementById('DHTMLgoodies_thumbs').offsetWidth;
		
		
		DHTMLgoodies_currentActiveImage = DHTMLgoodies_thumbDiv.getElementsByTagName('A')[0].getElementsByTagName('IMG')[0];
		DHTMLgoodies_currentActiveImage.className='activeImage';
	}
	
	function moveThumbnails()
	{
		if(DHTMLgoodies_thumbSlideInProgress)return;
		DHTMLgoodies_thumbSlideInProgress = true;
		if(this.id=='DHTMLgoodies_leftArrow'){
			rightArrowObj.style.visibility='visible';
			if(DHTMLgoodies_thumbDiv.style.left.replace('px','')/1>=0){
				leftArrowObj.style.visibility='hidden';
				DHTMLgoodies_thumbSlideInProgress = false;
				return;
			}
			slideThumbs(4,0);
			
		}else{
			leftArrowObj.style.visibility='visible';
			var left = DHTMLgoodies_thumbDiv.style.left.replace('px','')/1;			
			if(DHTMLgoodies_thumbTotalWidth + left - DHTMLgoodies_slideWidth <= DHTMLgoodies_viewableWidth){
				rightArrowObj.style.visibility='hidden';
				DHTMLgoodies_thumbSlideInProgress = false;
				return;
			}	
			slideThumbs(-4,0);
		}	
		
	}
	
	function slideThumbs(speed,currentPos)
	{
		var leftPos = DHTMLgoodies_thumbDiv.style.left.replace('px','')/1;
		currentPos = currentPos + Math.abs(speed);		
		leftPos = leftPos + speed;
		DHTMLgoodies_thumbDiv.style.left = leftPos + 'px';
		if(currentPos<DHTMLgoodies_slideWidth)setTimeout('slideThumbs(' + speed + ',' + currentPos + ')',slideSpeed);else{
			if(DHTMLgoodies_thumbDiv.style.left.replace('px','')/1>=0){
				document.getElementById('DHTMLgoodies_leftArrow').style.visibility='hidden';
			}	
			var left = DHTMLgoodies_thumbDiv.style.left.replace('px','')/1;		
			if(DHTMLgoodies_thumbTotalWidth + left - DHTMLgoodies_slideWidth <= DHTMLgoodies_viewableWidth){
				document.getElementById('DHTMLgoodies_rightArrow').style.visibility='hidden';
			}					
			DHTMLgoodies_thumbSlideInProgress = false;
		}
	
	}
	
	function showPreview(imagePath,inputObj)
	{		
		if(DHTMLgoodies_currentActiveImage){
			if(DHTMLgoodies_currentActiveImage==inputObj.getElementsByTagName('IMG')[0])return;
			DHTMLgoodies_currentActiveImage.className='';
		}
		DHTMLgoodies_currentActiveImage = inputObj.getElementsByTagName('IMG')[0];
		DHTMLgoodies_currentActiveImage.className='activeImage';
		
		DHTMLgoodies_imageToShow = imagePath;
		var tmpImage = new Image();
		tmpImage.src = imagePath;
		currentUnqiueOpacityId = Math.random();
		moveOpacity(opacitySteps*-1,currentUnqiueOpacityId);
	}
	
	function setOpacity()
	{
		if(document.all)
		{
			DHTMLgoodies_largeImage.style.filter = 'alpha(opacity=' + DHTMLgoodies_currentOpacity + ')';
		}else{
			DHTMLgoodies_largeImage.style.opacity = DHTMLgoodies_currentOpacity/100;
		}		
	}
	function moveOpacity(speed,uniqueId)
	{
		
		if(browserIsOpera){
			DHTMLgoodies_largeImage.src = DHTMLgoodies_imageToShow;
			return;
		}
		
		DHTMLgoodies_currentOpacity = DHTMLgoodies_currentOpacity + speed;
		if(DHTMLgoodies_currentOpacity<=5 && speed<0){
		
			var tmpParent = DHTMLgoodies_largeImage.parentNode; 
			DHTMLgoodies_largeImage.parentNode.removeChild(DHTMLgoodies_largeImage);
			DHTMLgoodies_largeImage = document.createElement('IMG');
			tmpParent.appendChild(DHTMLgoodies_largeImage);
			setOpacity();
			DHTMLgoodies_largeImage.src = DHTMLgoodies_imageToShow;
		
			speed=opacitySteps;
		}
		if(DHTMLgoodies_currentOpacity>=99 && speed>0)DHTMLgoodies_currentOpacity=99;		
		setOpacity();	
		if(DHTMLgoodies_currentOpacity>=99 && speed>0)return;		
		if(uniqueId==currentUnqiueOpacityId)setTimeout('moveOpacity(' + speed + ',' + uniqueId + ')',opacitySpeed);		
	}