<?php $__env->startSection('content'); ?>
<main>
<script type="text/javascript">
               
               function resize(){
                   
                   
                   var iOS = ['iPad', 'iPhone', 'iPod'].indexOf(navigator.platform) >= 0;
                   
                    if (iOS) { 
                    
    $('.topbar-wrap').css("margin-bottom", "0px");
     
   $('.topbar.has-fixed').addClass('d-none');
   $('.page-content').css("margin-top", "0px");
   $('.casino-play__wrapper-place').css("margin-top", "0px");
   var iframe = document.getElementById('iframe_slot');
   iframe.style.cssText += 'position: fixed; left: 0; top: 0;';
   iframe.style.width = document.body.clientWidth + 'px';
   iframe.style.height = document.body.clientHeight - 80 + 'px';
   
 }else{
   var iframe = document.getElementById('iframe_slot');
   iframe.style.cssText += 'position: fixed; left: 0; top: 0;';
   iframe.style.width = document.body.clientWidth + 'px';
   iframe.style.height = document.body.clientHeight - 30 + 'px';
 }


   
};
   

 function fullscreen()  
   {  
       var docElm = document.getElementById('iframe_slot');  
       //W3C   
       if (docElm.requestFullscreen) {  
           docElm.requestFullscreen();  
       }  
           //FireFox   
       else if (docElm.mozRequestFullScreen) {  
           docElm.mozRequestFullScreen();  
       }  
                        // Chrome и т. Д.   
       else if (docElm.webkitRequestFullScreen) {  
           docElm.webkitRequestFullScreen();  
       }  
       else if (docElm.webkitFullscreenElement) {
           docElm.webkitFullscreenElement();
       }
       else if (docElm.msFullscreenElement) {
           docElm.msFullscreenElement();
       }
           //IE11   
       else if (docElm.msRequestFullscreen) {  
           docElm.msRequestFullscreen();  
       } else {
            docElm.documentElement;
     docElm.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
       }  
   }  

</script>
<div class="content-area card">
        <div class="card-innr">
            <div class="content container game game-component">
            						  <div class="game_slot">
                        <div class="game-component">
                            <div class="casino-play__wrapper-place">
                                <div class="casino-play__controls" style="width: 100%;">
                                    <div class="casino-play__control casino-play__control_change" onclick="location.href = '/slots'">
                                        <span>Back</span>
                                    </div>  
									 <div class="casino-play__name casino-play__control_change2">
                                    <?php echo e($title); ?>

                                    </div>  &nbsp;
                                    <div role="button" class="casino-play__control casino-play__control_fullscreen" onclick="fullscreen()">
                                        <img src="/dist/img/fullscreen.svg">
                                    </div>
                                </div>
								
								     
<style type="text/css">
@media (min-width: 1000px) {
	.container.slots {
	margin-right: 200px;
    max-width: 1400px !Important;
}

}

@media (max-width: 1000px) {
.casino-play__name {
font-size: 12px !important;
    letter-spacing: 1px !important;
}

}


.col-lg-3 {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
}
img.random_dice {
    width: 30px !important;
    height: 30px !important;
}
.game_slot {
    display: -webkit-flex;
    display: flex;
    width: 100%;
    -webkit-align-items: stretch;
    align-items: stretch;
    position: relative
}
.game-component {
    -webkit-align-items: stretch;
    align-items: stretch;
    width: 100%;
    position: relative
}
.casino-play__wrapper-place {
    position: relative;
    width: 100%;
    padding-top: 56.5%;
    margin-top: 62px;
	margin-bottom: 25px;
    border-radius: 5px;
    box-shadow: 0 0 20px rgb(143 157 174 / 50%);
 
}
.casino-play__wrapper-place iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    overflow: hidden;
}


.casino-play__control:hover {
    -webkit-transition: all ease-out .2s;
    -moz-transition: all ease-out .2s;
    -ms-transition: all ease-out .2s;
    -o-transition: all ease-out .2s;
    transition: all ease-out .2s;
    background: #1e67cd;
}

.casino-play__controls {
    position: absolute;
    top: -55px;
    right: 0;
    display: flex;
    align-items: center;
}
.casino-play__control {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
	width: 36px;
    height: 36px;
    background: #4e6588;
    border-radius: 5px;
    cursor: pointer;
}
.casino-play__name {
	width: 100%;
	    font-size: 21px;
    letter-spacing: 1.2px;
display: flex;
    align-items: center;
    justify-content: center;
}
.casino-play__control+.casino-play__control {
    margin-left: 5px;
}
.casino-play__control_change {
    width: 120px; 
}
 
.casino-play__control>img {
    width: 18px;
    height: 18px;
    transition: filter .2s ease-in-out;
}
.casino-play__control_change>span {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 2px;
    color: #fff; 
    transition: color .2s ease-in-out;
}
 
</style>

 
        <iframe id="iframe_slot" scrolling="no" frameborder="0" webkitallowfullscreen="true" allowfullscreen="true" mozallowfullscreen="true" src="<?php echo e($link); ?>"></iframe> 
                            </div>
                        </div>    </div>
                    </div>
									 

        </div></div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/slot.blade.php */ ?>