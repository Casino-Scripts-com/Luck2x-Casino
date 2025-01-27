<?php $__env->startSection('content'); ?>
    <main>
    <style>.game_:hover .info{opacity:1;pointer-events:all}.info .title{font-weight:700;padding-top:20px;z-index:1;color:#fff;display:flex;flex-direction:column}.info .title2{z-index:1;color:#fff;display:flex;font-size:30px;flex-direction:column;opacity:.95}.info .title3{padding-bottom:18px;z-index:1;color:#fff;display:flex;flex-direction:column}.info{opacity:0;position:absolute;top:0;left:0;width:100%;height:100%;flex-direction:column;display:flex;justify-content:space-between;padding:var(--spacing-1);pointer-events:none;transition:.4s}.info:before{opacity:.85;content:"";position:absolute;left:0;top:0;width:100%;height:100%;background-image:linear-gradient(to bottom,#2c80ff,#1d66ca)}.list{text-align:center}.game_ img{width:180px;height:250px;border-radius:10px}.game_{margin:2px;border:0;cursor:pointer;border-radius:.5rem;width:170px;height:250px;transition:400ms ease;overflow:hidden;position:relative;display:inline-flex;justify-content:center;align-items:center;box-shadow:0 5px 10px 2px rgb(8 10 12/5%)}.game_:hover{transform:translateY(-4%)}</style>
        <div class="games-page">
        <div class="content-area card">
   <div class="card-innr">
      <div class="content">
         <div class="list">
            <style>
               img.random_dice {
               width: 20px !important;
               height: 20px !important;
               }
               .page-item.active .page-link {
               z-index: 10;
               color: #fff;
               background-color: #4e6588;
               border-color: #4e6588;
               }
               .page-link {
               color: #4e6588;
               }
               .casino-set:hover {
               -webkit-transition: all ease-out .2s;
               -moz-transition: all ease-out .2s;
               -ms-transition: all ease-out .2s;
               -o-transition: all ease-out .2s;
               transition: all ease-out .2s;
               background: #1e67cd;
               }
               .casino-set {
               display: inline-block;
               align-items: center;
               justify-content: center;
               min-width: 140px;
               width: 100px;
               background: #4e658859;
               border-radius: 50px;
               cursor: pointer;
               padding: 15px;
	   	       padding: 5px;
               margin: 5px 5px;
               }
               .casino-provider>span {
               font-size: 14px;
               font-weight: 500;
               margin-bottom: 2px;
               color: #fff;
               transition: color .2s ease-in-out;
               }

               .pagination {
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: .25rem;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #4e6588;
    border-color: #4e6588;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #081338;
    border-color: #504c4c;
}
.page-link:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.page-link {
    color: #4e6588;
}
.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #ffffff;
    background-color: #040c2f;
    border: 1px solid #292a2a;
}
            </style>
            	<style>
	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		display: none;
		pointer-events: none;
	}

	.modalDialog:target {
		display: block;
		pointer-events: auto;
	}

.modalDialog > div {
    width: 400px;
    position: relative;
    margin: 3% auto;
    padding: 3px 1px 17px 1px;
    border-radius: 15px;
    background: #3b3b56;
    background: -moz-linear-gradient(#fff, #999);
    background: -webkit-linear-gradient(#040c2f, #040c2f);
    background: -o-linear-gradient(#fff, #999);
}



	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover { background: #00d9ff; }
	</style>
</head>

<body>

<center><a class="buttons" href="#openModal">LIST OF PROVIDERS</a></center>


<input 
    placeholder="Search.."
    id="search_slots"
    style="
    height: 39px;
    font-size: 14px;
    padding: 0 12px;
    outline: none!important;
    border-radius: 5px;
    color: #fff;
    background: #1b2852;
    border: 12px solid transparent;
    font-family: Roboto,Open Sans,sans-serif;
    "
>


<button onclick="searchSlots()">Search...</button>
<script>
    const searchSlots = () => {
        location.href = `/slots?search=${$('#search_slots').val()}`
    }
</script>
<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
        <ul class="subnav">
            <a class="buttonss" href="/slots" class="documents">All games</a>
            <a class="buttonss" href="/slots/NetEnt" class="documents">NETENT</a>
            <a class="buttonss" href="/slots/amatic" class="signout">Amatic</a>
			<a class="buttonss" href="/slots/pragmatic" class="signout">PRAGMATIC Play</a>
			<a class="buttonss" href="/slots/egt" class="signout">EGT</a>	
		<a class="buttonss" href="/slots/novomatic_html5" class="signout">Novomatic</a>
		<a class="buttonss" href="/slots/microgaming" class="signout">Microgaming</a>
		<a class="buttonss" href="/slots/igt" class="signout">IGT</a>
		<a class="buttonss" href="/slots/Apollo" class="signout">Apollo</a>
		<a class="buttonss" href="/slots/Wazdan" class="signout">Wazdan</a>
		<a class="buttonss" href="/slots/apex" class="signout">Apex</a>
		<a class="buttonss" href="/slots/habanero" class="signout">habanero</a>
		<a class="buttonss" href="/slots/igrosoft" class="signout">Igrosoft</a>
		<a class="buttonss" href="/slots/igt_html5" class="signout">IGT_html5</a>
		<a class="buttonss" href="/slots/microgaming_html5" class="signout">microgaming_html5</a>
		<a class="buttonss" href="/slots/netent_html5" class="signout">netent_html5</a>
		<a class="buttonss" href="/slots/novomatic_deluxe" class="signout">novomatic_deluxe</a>
		<a class="buttonss" href="/slots/novomatic_html5" class="signout">novomatic_html5</a>
		<a class="buttonss" href="/slots/quickspin" class="signout">quickspin</a>
		<a class="buttonss" href="/slots/Aristocrat" class="signout">Aristocrat</a>
		<a class="buttonss" href="/slots/scientific_games" class="signout">scientific_games</a>
		<a class="buttonss" href="/slots/table_games" class="signout">table_games</a>


        </ul>
</div>
</div>
<style>
a.buttons {
    width: 350px;
    height: 50px;
    text-decoration: none;
    padding-top: 15px;
    color: #ffffff;
    text-align: center;
    line-height: 20px;
    display: block;
    margin: 20px auto;
    font: normal 17px arial;
}



a.buttons:not(.active) {
    box-shadow: inset 0 1px 1px rgb(4 12 47), inset 0 -1px 0px rgb(63 59 113 / 20%), 0 9px 16px 0 rgb(0 0 0 / 30%), 0 4px 3px 0 rgb(0 0 0 / 30%), 0 0 0 1px #040c2f;
    background-image: linear-gradient(#040c2f, #040c2f);
    text-shadow: 0 0 21px rgb(223 206 228 / 50%), 0 -1px 0 #000000;
}


a.buttons:not(.active):hover,
a.buttons:not(.active):focus {
  transition: color 200ms linear, text-shadow 500ms linear;
  color: #fff;
  text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 0 10px rgba(223, 206, 228, 0.4), 0 0 2px #2a153c;
}
a.buttons:not(:hover) {
    transition: 0.6s;
}
a.buttonss {
  width: 150px;
  height: 20px;
  text-decoration: none;
  padding-top: 5px;
  color: #bdbdbd;
  text-align: center;
  line-height: 20px;
  display: block;
  margin: 10px auto;
  font: normal 12px arial;
}

a.buttonss:not(.active) {
    box-shadow: inset 0 1px 1px rgb(4 12 47), inset 0 -1px 0px rgb(63 59 113 / 20%), 0 9px 16px 0 rgb(0 0 0 / 30%), 0 4px 3px 0 rgb(0 0 0 / 30%), 0 0 0 1px #040c2f;
    background-image: linear-gradient(#271e30, #040c2f);
    text-shadow: 0 0 21px rgb(223 206 228 / 50%), 0 -1px 0 #000000;
}


a.buttonss:not(.active):hover,
a.buttonss:not(.active):focus {
  transition: color 200ms linear, text-shadow 500ms linear;
  color: #fff;
  text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 0 10px rgba(223, 206, 228, 0.4), 0 0 2px #2a153c;
}
a.buttonss:not(:hover) {
    transition: 0.6s;
}
</style>
            <br>
 <!--           <div style="width: 130px;margin:5px;" class="casino-set casino-provider" onclick="location.href= '/slots_list'">
               <span>Все игры</span>
            </div>
            <div class="casino-set casino-provider" onclick="location.href= '/slots_list/netent'">
               <span>NETENT</span>
            </div>
            <div class="casino-set casino-provider" onclick="location.href= '/slots_list/playngo'">
               <span>Play'n GO</span>
            </div>
            <div class="casino-set casino-provider" onclick="location.href= '/slots_list/pragmatic'">
               <span>PRAGMATIC</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/yggdrasil'">
               <span>YGGDRASIL</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/igrosoft'">
               <span>IGROSOFT</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/novomatic'">
               <span>NOVOMATIC</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/betinhell'">
               <span>BETINHELL</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/belatra'">
               <span>BELATRA</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/unicum'">
               <span>UNICUM</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/megajack'">
               <span>MEGAJACK</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/playtech'">
               <span>PLAYTECH</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/erotic'">
               <span>EROTIC</span>
            </div>
			<div class="casino-set casino-provider" onclick="location.href= '/slots_list/microgaming'">
               <span>MICROGAMING</span>
            </div>-->
            <br>
            <div style="display: inline-block;">
                <?php echo e($slots->links()); ?>

            </div>
            <br>
 <br>
            <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div data-group="Pragmatic Play" onclick="location.href = '/slots/game/<?php echo e($slot->game_id); ?>'" class="game_">
               <img src="<?php echo e($slot->icon); ?>">
               <div class="info">
                  <div class="title"><?php echo e($slot->title); ?></div>
                  <div class="title2"><i class="fa fa-play"></i></div>
                  <div class="title3"><?php echo e($slot->provider); ?></div>
               </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <br><br>
            <div style="display: inline-block;">
                <?php echo e($slots->links()); ?>

            </div>
         </div>
      </div>
   </div>
</div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/slots.blade.php */ ?>