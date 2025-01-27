<?php if(!Auth::check() && $settings->site_disable || $settings->site_disable && Auth::check() && !$u->is_admin): ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($settings->title); ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/pre.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="/img/luck2x-logo.png?v=11" alt="">
        <span class="title">Technical works!</span>
        <a href="<?php echo e($settings->vk_url); ?>" class="vk" target="_blank"><span>Join the group </span><i class="fab fa-vk"></i></a>
    </div>
</body>
<?php else: ?>
<?php if(Auth::user() && $u->ban): ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($settings->title); ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/img/favicon.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/pre.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="/img/luck2x-logo.png?v=11" alt="">
        <span class="title">You're banned!</span>
        <?php if($u->ban_reason): ?><span class="text"><?php echo e($u->ban_reason); ?></span><?php endif; ?>
        <a href="<?php echo e($settings->vk_url); ?>" class="vk" target="_blank"><span>Join the group </span><i class="fab fa-vk"></i></a>
        <a href="/logout" class="vk" target="_blank"><span>Logout</span></a>
    </div>
</body>
<?php else: ?>
<!DOCTYPE html>
   <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="description" content="">
    <link href="/img/luck2x-fav.png" rel="shortcut icon"> 
        <title><?php echo e($settings->title); ?></title>
        <link rel="stylesheet" href="/css/main.css?v=<?php echo e(time()); ?>">
        <link rel="stylesheet" href="/css/icon.css">
        <link rel="stylesheet" href="/css/notify.css?v=2">
        <link rel="stylesheet" href="/css/animation.css">
        <link rel="stylesheet" href="/css/media.css">
        <link rel="stylesheet" href="/css/winter.css?v=4">
        <!--<link rel="stylesheet" href="/css/light.css?v=1">-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <?php echo NoCaptcha::renderJs(); ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js?v=<?php echo e(time()); ?>"></script> 
        <script type="text/javascript" src="/js/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="/js/wnoty.js?v=<?php echo e(time()); ?>"></script>
        <script type="text/javascript" src="/js/snowfall.jquery.js?v=<?php echo e(time()); ?>"></script>
        <script type="text/javascript" src="/js/main.js?v=<?php echo e(time()); ?>"></script>
        <?php if(Auth::user() and $u->is_admin == 1 || $u->is_moder == 1): ?>
        <script type="text/javascript" src="/js/moderatorOptions.js"></script>
        <?php endif; ?>
        <script>
            <?php if(auth()->guard()->check()): ?>
            const USER_ID = '<?php echo e($u->unique_id); ?>';
            const youtuber = '<?php echo e($u->is_youtuber); ?>';
            const admin = '<?php echo e($u->is_admin); ?>';
            const moder = '<?php echo e($u->is_moder); ?>';
            <?php else: ?>
            const USER_ID = null;
            const youtuber = null;
            const admin = null;
            const moder = null;
            <?php endif; ?>
            const settings = <?php echo json_encode($gws); ?>;
        </script>
      </head>
      <body>
        <span class="snowman" style="right: 1.7%; opacity: 1;"></span>
        <span class="snow-layer"></span>
         <div class="wrapper">
            <div class="page">
            <div class="header" style="right:0px;z-index: 1003;">
                <div class="header-inner">
                    <div class="header-block">
                        <a class="logo" href="/">
                            <img src="/img/luck2x-logo.png?v=11" alt="" style="transform: translateY(-3px);">
                        </a>
                        <?php if(auth()->guard()->check()): ?>
                        <div class="top-nav-wrapper">
                            <button class="opener">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                            </button>
                            <ul class="top-nav">
                                <li>
                                    <a class="<?php echo e(Request::is('affiliate') ? 'isActive' : ''); ?>" href="/affiliate">
                                        <svg class="icon icon-affiliate">
                                            <use xlink:href="/img/symbols.svg#icon-affiliate"></use>
                                        </svg>
                                        <span>Affiliate</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('free') ? 'isActive' : ''); ?>" href="/free">
                                        <svg class="icon icon-faucet">
                                            <use xlink:href="/img/symbols.svg#icon-faucet"></use>
                                        </svg>
                                        <span>Free Coins</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-target="#promoModal">
                                        <svg class="icon icon-promo">
                                            <use xlink:href="/img/symbols.svg#icon-promo"></use>
                                        </svg>
                                        <span>Promo codes</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('rank') ? 'isActive' : ''); ?>" href="/rank">
                                        <svg class="icon icon-crash">
                                            <use xlink:href="/img/symbols.svg#icon-crash"></use>
                                        </svg>
                                        <span>Ranks</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('tournament') ? 'isActive' : ''); ?>" href="/tournament" style="color: gold;">
                                        <svg class="icon icon-top">
                                            <use xlink:href="/img/symbols.svg#icon-top"></use>
                                        </svg>
                                        <span>Tournament</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="toggle">
                                        <button class="btn">
                                            <svg class="icon icon-faq">
                                                <use xlink:href="/img/symbols.svg#icon-faq"></use>
                                            </svg>
                                            <span>Help</span>
                                            <svg class="icon icon-down">
                                                <use xlink:href="/img/symbols.svg#icon-down"></use>
                                            </svg>
                                        </button>
                                        <ul class="">
                                            <li>
                                                <a class="" href="/faq">
                                                    <svg class="icon icon-faq">
                                                        <use xlink:href="/img/symbols.svg#icon-faq"></use>
                                                    </svg>
                                                    <span>FAQ</span>
                                                </a>
                                            </li>
                                            <?php if($settings->vk_support_link): ?>
                                            <li>
                                                <a href="<?php echo e($settings->vk_support_link); ?>" target="_blank">
                                                    <svg class="icon icon-support">
                                                        <use xlink:href="/img/symbols.svg#icon-support"></use>
                                                    </svg>
                                                    Support
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="toggle">
                                        <button class="btn">
                                            <span>More</span>
                                            <svg class="icon icon-down">
                                                <use xlink:href="/img/symbols.svg#icon-down"></use>
                                            </svg>
                                        </button>
                                        <ul class="">
                                        <li>
                                            <a class="<?php echo e(Request::is('clans') ? 'isActive' : ''); ?>" href="/clans">
                                                <span>Clans</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="<?php echo e(Request::is('clan') ? 'isActive' : ''); ?>" href="/clan/my">
                                                <span>My Clan</span>
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php if(Auth::check() && $u->is_admin): ?>
                                <li>
                                    <a href="/admin">
                                        <svg class="icon icon-fairness">
                                            <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                        </svg>
                                        <span>Panel</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if(auth()->guard()->guest()): ?>
                    <div class="auth-buttons">
                        <a data-toggle="modal" data-target="#authModal" class="btn">
                            <span>Login</span>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="deposit-wrap">
                        <div class="bottom-start rounded dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-secondary" data-toggle="dropdown">
                                <div class="selected balance">
                                    <svg class="icon icon-coin">
                                        <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                    </svg>
                                </div>
                                <div class="opener">
                                    <svg class="icon icon-down">
                                        <use xlink:href="/img/symbols.svg#icon-down"></use>
                                    </svg>
                                </div>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start">
                                <button type="button" data-id="balance" tabindex="0" role="menuitem" class="dropdown-item">
                                    <div class="balance-item balance">
                                        <svg class="icon icon-coin">
                                            <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                        </svg><span>&nbsp;Real Balance</span>
                                        <div class="value" id="balance_bal"><?php echo e($u->balance); ?></div>
                                    </div>
                                </button>
                                <button type="button" data-id="bonus" tabindex="0" role="menuitem" class="dropdown-item">
                                    <div class="balance-item bonus">
                                        <svg class="icon icon-coin">
                                            <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                        </svg><span>&nbsp;Bonus Balance</span>
                                        <div class="value" id="bonus_bal"><?php echo e($u->bonus); ?></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="deposit-block">
                            <div class="select-field"><span id="balance">0</span></div>
                        </div>
                    </div>
                    <div class="user-box">
                      <div class="rounded dropdown">
                        <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown">
                          <div class="user-avatar">
                            <img src="<?php echo e($u->avatar); ?>" alt="">
                          </div>
                          <div class="user-wrapper">
                            <div class="user-name-box">
                              <div class="user-name" style="<?php if($u->style > 0): ?> <?php echo e(\App\Styles::where('id', $u->style)->first()->css); ?> <?php endif; ?>"><?php echo e($u->username); ?></div>
                              <div class="opener">
                                <svg class="icon icon-down">
                                  <use xlink:href="/img/symbols.svg#icon-down"></use>
                                </svg>
                              </div>
                            </div>
                            <div class="star-level">
                              <svg class="icon-star ">
                                <use xlink:href="/img/symbols.svg#icon-star"></use>
                              </svg>
                              <svg class="icon-star ">
                                <use xlink:href="/img/symbols.svg#icon-star"></use>
                              </svg>
                              <svg class="icon-star ">
                                <use xlink:href="/img/symbols.svg#icon-star"></use>
                              </svg>
                              <svg class="icon-star ">
                                <use xlink:href="/img/symbols.svg#icon-star"></use>
                              </svg>
                              <svg class="icon-star ">
                                <use xlink:href="/img/symbols.svg#icon-star"></use>
                              </svg>
                            </div>
                          </div>
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right dropdown-menu-anim" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(172px, 37px, 0px);">
                          <button type="button" tabindex="0" role="menuitem" class="user-link dropdown-item" data-id="<?php echo e($u->unique_id); ?>">
                            <div class="user-item">
                              <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-person"></use>
                              </svg>
                              <span class="user-item-text">Profile</span>
                            </div>
                          </button>
                          <a href="/profile/history">
                            <button type="button" tabindex="0" role="menuitem" class="dropdown-item">
                              <div class="user-item">
                                <svg class="icon icon-history">
                                  <use xlink:href="/img/symbols.svg#icon-history"></use>
                                </svg>
                                <span class="user-item-text">History</span>
                              </div>
                            </button>
                          </a>

                          <a href="/logout">
                            <button type="button" tabindex="0" role="menuitem" class="dropdown-item">
                              <div class="user-item">
                                <svg class="icon icon-logout">
                                  <use xlink:href="/img/symbols.svg#icon-logout"></use>
                                </svg>
                                <span class="user-item-text">Logout</span>
                              </div>
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
               <div class="left-sidebar">
                <ul class="side-nav">
                    <li class="<?php echo e(Request::is('crash') ? 'current' : ''); ?>">
                        <a class="" href="/crash">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-crash"></use>
                            </svg>
                            <div class="side-nav-tooltip">Crash</div>
                        </a>
                    </li>   
                    <li class="<?php echo e(Request::is('mines') ? 'current' : ''); ?>">
                        <a class="" href="/mines">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-mines"></use>
                            </svg>
                            <div class="side-nav-tooltip">Mines</div>
                        </a>
                    </li>    
                    <li class="<?php echo e(Request::is('tower') ? 'current' : ''); ?>">
                        <a class="" href="/tower">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-tower"></use>
                            </svg>
                            <div class="side-nav-tooltip">Tower</div>
                        </a>
                    </li>  
                    <!--
                    <li class="<?php echo e(Request::is('slots') ? 'current' : ''); ?>">
                        <a class="" href="/slots">
                           
                            <img class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAACWElEQVR4nO2bsYoUQRCGW1GMDM5YREQFAxE0MDnkQCNzA7NLPNQXMNI9EMTFrf/vFhzdSDgfwOSiUzAUfAEjT8zVQDARZKR1TtZhZ3aC3u52pj6oZLdgq/+pqu6e7jVGURRFUZQ2RqPRAQA3ST4lOY1tAAjgSlN81tpTJNdJ3hKRsyY0AF6SLFMbgI3ag9nvxSH5s+a75Zw7FGTwInIy9cBnBNitPZi7Lf6PgwhAci31wGdtL67pdHoQwNcWsX6IyJHeCkDyTAf/S70VwDl3dJHvZDI53VsBPADetfi+903S9FkAkhdJfqv7APgeJP1zF8AjIudIblff++lwG8B5EwrOCFApuxV5EbTTJkAV4/Eqvo/BBt6QAY9MZMqy3AfgUxYCANgVkdt+RRbRRrMrvaQCMANTARKXwGffBwA8jGjPsikBAA+C/0C3GN5mIQDJTf+ZtXaV5J15trcfF5GrTT5d/ay1x7wPgDdZCUBys6VRrVdBP1/Q0Lr4rakARjPALCqB8Xh82K8ZSF4fTAmwuW+sDkWAssF+x6gChIKaAdQSoPYAahOkzgL8O8X4c7qm3Ztz7oL3sdZea9vldfQ7kdU0iIx2g6nWAV8A3G/b5S3Bnsx7H+CzY54VRbGyTAHK1BZ0cF1QAfhPBnzwlxBivhUmeW/RK7Glwv/gXGCpsHYyBOBF5JOh19oDqE2wzKIEmIGpALGhZgCHXQLy5wbGq1wsugCDpyiKlWr/n4VFfyAceg/g0AWQjC9LRwOZXJcneSPlHyY2ABSp/jBhrb2cZPCKoiiKYnrLL9I0UoHrw+GrAAAAAElFTkSuQmCC">
                            <div class="side-nav-tooltip">Slots</div>
                        </a>
                    </li>-->
                    <li class="<?php echo e(Request::is('dice') ? 'current' : ''); ?>">
                        <a class="" href="/dice">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-dice"></use>
                            </svg>
                            <div class="side-nav-tooltip">Dice</div>
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('battle') ? 'current' : ''); ?>">
                        <a class="" href="/battle">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-battle"></use>
                            </svg>
                            <div class="side-nav-tooltip">Battle</div>
                        </a>
                    </li>
                     <li class="<?php echo e(Request::is('coinflip') ? 'current' : ''); ?>">
                        <a class="" href="/pvp">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-flip"></use>
                            </svg>
                            <div class="side-nav-tooltip">Pvp</div>
                        </a>
                    </li>                            
                    <li class="<?php echo e(Request::is('wheel') ? 'current' : ''); ?>">
                        <a class="" href="/wheel">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-roulette"></use>
                            </svg>
                            <div class="side-nav-tooltip">Roulette</div>
                        </a>
                    </li>                          
                    <li class="<?php echo e(Request::is('hilo') ? 'current' : ''); ?>">
                        <a class="" href="/HiLo">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-hilo"></use>
                            </svg>
                            <div class="side-nav-tooltip">HiLo</div>
                        </a>
                    </li>                         
                    <li class="<?php echo e(Request::is('king') ? 'current' : ''); ?>">
                        <a class="" href="/king">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-king"></use>
                            </svg>
                            <div class="side-nav-tooltip">King</div>
                        </a>
                    </li>           
                    <li class="<?php echo e(Request::is('jackpot') ? 'current' : '' || Request::is('jackpot/history') ? 'current' : ''  || Request::is('jackpot/history/*') ? 'current' : ''); ?>">
                        <a class="" href="/jackpot">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-jackpot"></use>
                            </svg>
                            <div class="side-nav-tooltip">Jackpot</div>
                        </a>
                    </li>                                                                              
                </ul>
               </div>
               <div class="main-content">
                  <div class="main-content-top" style="margin-top:-40px">
                     <link rel="stylesheet" href="/css/games.css?v=12">
                        <div class="section_Section__14IWw landing_LandingGameSection__JPR73">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                  </div>
                <div class="main-content-footer">
                    <div class="footer-counters">
                        <div class="container">
                            <div class="row">
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-user"></use></svg>
                                        <div class="counter-num"><?php echo e($stats['countUsers']+2736); ?></div>
                                        <div class="counter-text">Total players</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-add-user"></use></svg>
                                        <div class="counter-num"><?php echo e($stats['countUsersToday']+128); ?></div>
                                        <div class="counter-text">Today's players</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-clock"></use></svg>
                                        <div class="counter-num"><?php echo e($stats['totalGames']); ?></div>
                                        <div class="counter-text">Games played</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                <div class="counter-block">
                                <svg class="icon-statistics" style="fill: #d8edf9;"><use xlink:href="/img/symbols.svg#icon-stats-card"></use></svg>
                                    <div class="counter-num"><?php echo e($stats['totalWithdraw']+74839); ?></div>
                                        <div class="counter-text">Paid out</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="footer">
                        <div class="container">
                            <div class="row">
                                <div class="col col-7">
                                    <ul class="footer-nav">
                                        <li><a class="" data-toggle="modal" data-target="#tosModal">Terms of Use</a></li>
</a>
                                        <?php if($settings->vk_url): ?>
                                        <li>
                                            <a href="<?php echo e($settings->vk_url); ?>" target="_blank">
                                                <svg class="icon icon-vk">
                                                    <use xlink:href="/img/symbols.svg#icon-vk"></use>
                                                </svg><?php echo e($settings->sitename); ?>

                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col col-5">
                                    <div class="copyright">
                                        <div class="footer-logo"><img src="/img/luck2x-fav.png" alt=""></div>
                                        <div class="text">© 2023 <?php echo e($settings->sitename); ?>

                                            <br> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
               
            <div class="right-sidebar">
            <div id="btnchat">
                            </svg>
                        </div>
                <div class="sidebar-container">
                  <?php if(auth()->guard()->check()): ?>
          
                    <?php endif; ?>
                    <div class="chat tab current">
                        <?php if(auth()->guard()->check()): ?>
                        
                        <?php endif; ?>
                        <div class="chat-params" style="margin-top: 60px;">
                            <div class="item">
                            <div class="point-online"></div>
                                <div class="chat-online">On-Line:&nbsp;<span>0</span></div>
                            </div>
                            <div class="item">
                                <?php if(Auth::user() and $u->is_admin): ?>
                                <div class="toggle">
                                  <a class="toggle-btn" data-toggle="tooltip" data-placement="top" title="Administrator mode">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-sheriff"></use>
                    </svg>
                  </a>
                                </div>
                                <?php endif; ?>
                                <?php if(Auth::user() and $u->is_admin || $u->is_moder): ?>
                                <div class="list">
                                  <button class="banned-btn" data-toggle="tooltip" data-placement="top" title="Banned users">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-ban"></use>
                    </svg>
                  </button>
                                </div>
                                <div class="clear">
                                  <button class="clear-btn clearChat" data-toggle="tooltip" data-placement="top" title="Clear chat">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-clear"></use>
                    </svg>
                  </button>
                                </div>
                                <?php endif; ?>
                                <?php if(auth()->guard()->check()): ?>
                                <div class="share">
                                  <button class="share-btn shareToChat" data-toggle="tooltip" data-placement="top" title="Share the balance">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-coin"></use>
                    </svg>
                  </button>
                                </div>
                                <?php endif; ?>
                                <button class="close-btn">
                                    <svg class="icon icon-close">
                                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="chat-conversation">
                            <div class="scrollbar-container chat-conversation-inner ps">
                                <?php if($messages != 0): ?> <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="message-block user_<?php echo e($sms['unique_id']); ?>" id="chatm_<?php echo e($sms['time2']); ?>">
                                    <div class="message-avatar <?php echo e($sms['admin'] ? 'isAdmin' : ''); ?><?php echo e($sms['moder'] ? 'isModerator' : ''); ?>"><img src="<?php echo e($sms['avatar']); ?>" alt=""></div>
                                    <div class="message-content">
                                        <div>
                                            <button class="user-link" type="button" data-id="<?php echo e($sms['unique_id']); ?>">
                                                <span class="sanitize-name" style="<?php echo e($sms['userStyle']); ?>">
                                                    <?php echo $sms['rank']; ?>

                                                  <span class="sanitize-text"><?php if($sms['admin']): ?> <span class="admin-badge isAdmin" data-toggle="tooltip" data-placement="top" title="Administrator">
                                                    <span class="">
                                                      <svg class="icon icon-a">
                                                        <use xlink:href="/img/symbols.svg#icon-a"></use>
                                                      </svg>
                                                    </span>
                                                  </span> Moderator <?php elseif($sms['moder']): ?> <span class="admin-badge isModerator" data-toggle="tooltip" data-placement="top" title="Moderator">
                                                    <span class="">
                                                      <svg class="icon icon-m">
                                                        <use xlink:href="/img/symbols.svg#icon-m"></use>
                                                      </svg>
                                                    </span>
                                                  </span> <?php echo e($sms['username']); ?> <?php elseif($sms['youtuber']): ?> <span class="admin-badge isYouTuber" data-toggle="tooltip" data-placement="top" title="YouTuber">
                                                    <span class="">
                                                      <svg class="icon icon-y">
                                                        <use xlink:href="/img/symbols.svg#icon-y"></use>
                                                      </svg>
                                                    </span>
                                                  </span> <?php echo e($sms['username']); ?> <?php else: ?> <?php echo e($sms['username']); ?> <?php endif; ?> <span>&nbsp;</span>
                                                </span>
                                                </span>
                                            </button>
                                            <div class="message-text"><?php echo $sms['messages']; ?></div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user() and $u->is_admin || $u->is_moder): ?>
                  <div class="delete">
                    <button type="button" class="btn btn-light" onclick="chatdelet(<?php echo e($sms['time2']); ?>)">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                      </svg><span>&nbsp;Delete</span>
                    </button>
                    <?php if(!$sms['admin']): ?>
                    <?php if(!$sms['ban']): ?>
                    <button type="button" class="btn btn-light btnBan" data-name="<?php echo e($sms['username']); ?>" data-id="<?php echo e($sms['unique_id']); ?>">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-ban"></use>
                      </svg><span>&nbsp;Ban</span>
                    </button>
                    <?php else: ?>
                    <button type="button" class="btn btn-light btnUnBan" data-name="<?php echo e($sms['username']); ?>" data-id="<?php echo e($sms['unique_id']); ?>">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-ban"></use>
                      </svg><span>Unban</span>
                    </button>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                                  <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!Auth::User()): ?>
                        <div class="chat-empty-block">You must be logged in to write in the chat room</div>
                        <?php else: ?>
                          <input type="hidden" id="optional" value="0">
                          <?php if($u->banchat): ?>
                          <div class="chat-ban-block">
                            <div class="title">Chat blocked!</div>
                          </div>
                          <?php else: ?>
                          <div class="chat-message-input">
                            <div class="chat-textarea">
                              <div class="chat-editable" contenteditable="true"></div>
                            </div>
                            <div class="chat-controls">
                                </svg>
                              </button>
                              <button type="submit" class="item sendMessage">
                                <svg class="icon icon-send">
                                  <use xlink:href="/img/symbols.svg#icon-send"></use>
                                </svg>
                              </button>
                            </div>
                          </div>
                          <?php endif; ?>
                        <?php endif; ?>
                    </div>
          <div class="user-profile tab">
            <?php if(auth()->guard()->check()): ?>
            <div class="user-block" style="margin-top: 60px;">
              <div class="user-avatar">
                <button class="close-btn">
                  <svg class="icon icon-close">
                    <use xlink:href="/img/symbols.svg#icon-close"></use>
                  </svg>
                </button>
                <div class="avatar"><img src="<?php echo e($u->avatar); ?>" alt=""></div>
              </div>
              <div class="user-name">
                <div class="nickname" style="<?php if($u->style > 0): ?> <?php echo e(\App\Styles::where('id', $u->style)->first()->css); ?> <?php endif; ?>"><?php echo e($u->username); ?></div>
              </div>
            </div>
            <ul class="profile-nav">
              <li>
                <a class="" href="/profile/history">
                  <div class="item-icon">
                    <svg class="icon icon-history">
                      <use xlink:href="/img/symbols.svg#icon-history"></use>
                    </svg>
                  </div><span>History</span>
                </a>
              </li>
            </ul>
            <a href="/logout" class="btn btn-logout">
              <div class="item-icon">
                <svg class="icon icon-logout">
                  <use xlink:href="/img/symbols.svg#icon-logout"></use>
                </svg>
              </div><span>Logout</span>
            </a>
            <?php endif; ?>
          </div>
                </div>
            </div>
               <div class="mobile-nav-component">
                    <?php if(auth()->guard()->check()): ?>
                    <div class="pull-out other">
                        <button class="close-btn">
                            <svg class="icon icon-close">
                                <use xlink:href="/img/symbols.svg#icon-close"></use>
                            </svg>
                        </button>
                        <ul class="pull-out-nav">
                            <li>
                                <a href="/affiliate">
                                    <svg class="icon icon-affiliate">
                                        <use xlink:href="/img/symbols.svg#icon-affiliate"></use>
                                    </svg>affiliate
                                </a>
                            </li>
                            <li>
                                <a href="/faq">
                                    <svg class="icon icon-faq">
                                        <use xlink:href="/img/symbols.svg#icon-faq"></use>
                                    </svg>FAQ
                                </a>
                            </li>
                            <?php if($settings->vk_support_url): ?>
                            <li>
                                <a href="<?php echo e($settings->vk_support_url); ?>" target="_blank">
                                    <svg class="icon icon-support">
                                        <use xlink:href="/img/symbols.svg#icon-support"></use>
                                    </svg>Tech. Support
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="/free">
                                    <svg class="icon icon-faucet">
                                        <use xlink:href="/img/symbols.svg#icon-faucet"></use>
                                    </svg>Free Coins
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#promoModal">
                                    <svg class="icon icon-promo">
                                        <use xlink:href="/img/symbols.svg#icon-promo"></use>
                                    </svg>Promo codes
                                </a>
                            </li>
                            <li>
                                <a href="/rank">
                                    <svg class="icon icon-promo">
                                        <use xlink:href="/img/symbols.svg#icon-crash"></use>
                                    </svg>Ranks
                                </a>
                            </li>
                            <li>
                                <a href="/tournament" style="color: gold;">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-top"></use>
                                    </svg>Tournament
                                </a>
                            </li>
                            <li>
                                <a href="/clans">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-person"></use>
                                    </svg>Clans
                                </a>
                            </li>
                            <li>
                                <a href="/clan/my">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-person"></use>
                                    </svg>My clan
                                </a>
                            </li>
                            <li>
                                <a href="/profile/history">
                                    <svg class="icon icon-history">
                                        <use xlink:href="/img/symbols.svg#icon-history"></use>
                                    </svg>History
                                </a>
                            </li>
                            <?php if(Auth::check() && $u->is_admin): ?>
                            <li>
                                <a href="/admin">
                                    <svg class="icon icon-fairness">
                                        <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                    </svg>Admin
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <div class="pull-out game">
                     <button class="close-btn">
                        <svg class="icon icon-close">
                           <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                     </button>
                     <ul class="pull-out-nav">
                        
                        <li>
                           <a href="/crash">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-crash"></use>
                              </svg>
                              Crash
                           </a>
                        </li>

                        <li>
                           <a href="/mines">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-mines"></use>
                              </svg>
                              Mines
                           </a>
                        </li>
                        <li>
                           <a href="/tower">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-tower"></use>
                              </svg>
                              Tower
                           </a>
                        </li>            
                        <!--                                                               
                        <li>
                           <a href="/slots">
                              <img style="margin-left: -10;" class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAACWElEQVR4nO2bsYoUQRCGW1GMDM5YREQFAxE0MDnkQCNzA7NLPNQXMNI9EMTFrf/vFhzdSDgfwOSiUzAUfAEjT8zVQDARZKR1TtZhZ3aC3u52pj6oZLdgq/+pqu6e7jVGURRFUZQ2RqPRAQA3ST4lOY1tAAjgSlN81tpTJNdJ3hKRsyY0AF6SLFMbgI3ag9nvxSH5s+a75Zw7FGTwInIy9cBnBNitPZi7Lf6PgwhAci31wGdtL67pdHoQwNcWsX6IyJHeCkDyTAf/S70VwDl3dJHvZDI53VsBPADetfi+903S9FkAkhdJfqv7APgeJP1zF8AjIudIblff++lwG8B5EwrOCFApuxV5EbTTJkAV4/Eqvo/BBt6QAY9MZMqy3AfgUxYCANgVkdt+RRbRRrMrvaQCMANTARKXwGffBwA8jGjPsikBAA+C/0C3GN5mIQDJTf+ZtXaV5J15trcfF5GrTT5d/ay1x7wPgDdZCUBys6VRrVdBP1/Q0Lr4rakARjPALCqB8Xh82K8ZSF4fTAmwuW+sDkWAssF+x6gChIKaAdQSoPYAahOkzgL8O8X4c7qm3Ztz7oL3sdZea9vldfQ7kdU0iIx2g6nWAV8A3G/b5S3Bnsx7H+CzY54VRbGyTAHK1BZ0cF1QAfhPBnzwlxBivhUmeW/RK7Glwv/gXGCpsHYyBOBF5JOh19oDqE2wzKIEmIGpALGhZgCHXQLy5wbGq1wsugCDpyiKlWr/n4VFfyAceg/g0AWQjC9LRwOZXJcneSPlHyY2ABSp/jBhrb2cZPCKoiiKYnrLL9I0UoHrw+GrAAAAAElFTkSuQmCC">
                              Slots
                           </a>
                        </li>      -->
                        <li>
                           <a href="/dice">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-dice"></use>
                              </svg>
                              Dice
                           </a>
                        </li>

                        <li>
                           <a href="/battle">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-battle"></use>
                              </svg>
                              Battle
                           </a>
                        </li>
                        <li>
                           <a href="/pvp">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-flip"></use>
                              </svg>
                              PVP
                           </a>
                        </li>                                                                           
                        <li>
                           <a href="/wheel">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-roulette"></use>
                              </svg>
                              Roulette
                           </a>
                        </li>                                                                           
                        <li>
                           <a href="/king">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-king"></use>
                              </svg>
                              King
                           </a>
                        </li>                                          
                        <li>
                           <a href="/jackpot">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-jackpot"></use>
                              </svg>
                              Jackpot
                           </a>
                        </li>                                                                        
                     </ul>                                      
                  </div>
                  <div class="mobile-nav-menu-wrapper">
                    <ul class="mobile-nav-menu">
                        <li>
                           <button id="gamesMenu">
                              <svg class="icon icon-gamepad">
                                 <use xlink:href="/img/symbols.svg#icon-gamepad"></use>
                              </svg>
                              Modes
                           </button>
                        </li>
                        <li>
                           <button id="chatMenu">
                              <svg class="icon icon-conversations">
                                 <use xlink:href="/img/symbols.svg#icon-conversations"></use>
                              </svg>
                              Chat
                           </button>
                        </li>
                        <?php if(auth()->guard()->check()): ?>
                        <li>
                           <button onclick="location.href = '/profile/<?php echo e($u->unique_id); ?>';">
                              <svg class="icon icon-person">
                                 <use xlink:href="/img/symbols.svg#icon-person"></use>
                              </svg>
                              Profile
                           </button>
                        </li>

                        <li>
                           <button id="otherMenu">
                              <svg class="icon icon-more">
                                 <use xlink:href="/img/symbols.svg#icon-more"></use>
                              </svg>
                              <span>Other</span>
                           </button>
                        </li>
                        <?php endif; ?>
                                             </ul>

                  </div>
               </div>
            </div>
         </div>


        <div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModal" aria-hidden="true">
            <div class="modal-dialog deposit-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="auth-modal-component sosi">
                     <div class="wrap">
                        <div class="tabs">
                           <button type="button" class="btn btn-tab isActive">Login</button>
                           <button type="button" class="btn btn-tab">Register</button>
                        </div>
                        <div class="deposit-section tab active" data-type="auth">
                            <div style=" width: 250px;height: 250px;position: absolute;top: 50%;left: 50%;margin: -125px 0 0 -113px;">
                                <div class="social vk ">
                                    <a href="/auth/vkontakte"><i class="fa fa-vk fa-2x"></i></a>
                                </div>
                                <div class="social google">
                                    <a href="/auth/google"><i class="fa fa-google fa-2x"></i></a>
                                </div>
                              <!--  <div class="social steam">
                                    <a href="/auth/steam"><i class="fa fa-steam fa-2x"></i></a>
                                </div>
                                <div class="social yandex">
                                    <a href="/auth/yandex"><i class="fa fa-yoast fa-2x"></i></a>
                                </div>-->
                            </div>
                            <br><br><br><br><br>
                            <div>
                              <div class="form-row">
                                 <label>
                                    <div class="form-label">Username</div>
                                    <div class="form-field">
                                        <div class="input-valid">
                                          <input class="input-field" type="text" id="authlog">
                                        </div>
                                    </div>
                                 </label>
                              </div>
                              <div class="form-row">
                                    <div class="form-label">Password</div>
                                    <div class="form-field">
                                        <div class="input-valid">
                                          <input class="input-field" type="password" id="authpass">
                                        </div>
                                    </div>
                              </div>
                              <button id="auth" class="btn btn-green">Login</button>
                            </div>
                        </div>
                        <div class="deposit-section tab" data-type="register">
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Username</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field" type="text" id="reglog">
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Password</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field" type="password" id="regpass">
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <button id="register" class="btn btn-green" disabled="">Register</button>
                           <div class="checkbox-block">
                              <label>I agree to the Terms of Use                               <input name="agree" type="checkbox" id="register-checkbox" value=""><span class="checkmark"></span></label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <style>
                @import  url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
.social a {
text-align: center;
width: 48px;
height: 48px;
float: left;
background: #071542;
border: 1px solid #504343;
box-shadow: 0 2px 4px rgb(0 0 0 / 15%), inset 0 0 50px rgb(0 0 0 / 10%);
border-radius: 24px;
margin: 0 10px 10px 0;
padding: 8px;
color: #b3a0a0;
}
.github a:hover {background: #191919; color: #fff;}
.youtube a:hover {background: #c4302b; color: #fff;}
.google-pluse a:hover {background: #DD4B39; color: #fff;}
.twitter a:hover {background: #00acee; color: #fff;}
.instagram a:hover {background: #3f729b; color: #fff;}
.facebook a:hover {background: #3b5998; color: #fff;}
.skype a:hover {background: #00aff0; color: #fff;}
.vk a:hover {background: #5d84ae; color: #fff;}
.odnoklassniki a:hover {background: #f93; color: #fff;}
.pinterest a:hover {background: #c8232c; color: #fff;}
.linkedin a:hover {background: #0e76a8; color: #fff;}
.telegram a:hover {background: #249bd7; color: #fff;}
.tumblr a:hover {background: #34526f; color: #fff;}
.windows a:hover {background: #125acd; color: #fff;}
.whatsapp a:hover {background: #50b154; color: #fff;}
.weibo a:hover {background: #d52b2b; color: #fff;}
.dropbox a:hover {background: #1087dd; color: #fff;}
            </style>
         </div>
         <?php if(auth()->guard()->check()): ?>
         <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exchangeModalLabel" aria-hidden="true">
            <div class="modal-dialog deposit-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="deposit-modal-component">
                     <div class="wrap"> 
                        <div class="deposit-section">
                        <div class="caption-line"><span class="span">Settings</span></div>
                           <form action="/pay" method="post" id="payment">
                              <div class="form-row">
                                <?php if($u->tg_id == 0): ?>
                                <a href="<?php echo e(env('TELEGRAM_LINK')); ?>?start=<?php echo e($u->unique_id); ?>" target="_blank">
                                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px;"><span>Telegram</span></button>
                                </a>
                                <?php else: ?>
                                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" disabled><span>Telegram is tethered</span></button>
                                <?php endif; ?>
                              </div>
                              <button type="submit" class="btn btn-green" disabled>Save changes</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>




        <div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
            <div class="dura modal-dialog deposit-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="deposit-modal-component">
                     <div class="wrap">
                        <div class="tabs">
                           <button type="button" class="btn btn-tab isActive">Deposit</button>
                           <button type="button" class="btn btn-tab">Withdraw</button>
                        </div>
                        <div class="deposit-section tab active" data-type="deposite">
                           <form action="/pay" method="post" id="payment">
                              <div class="form-row">
                                 <label>
                                    <div class="form-label">Deposit</div>
                                    <div class="form-field">
                                       <div class="input-valid">
                                          <input class="input-field input-with-icon" name="amount" value="50.00" placeholder="Min. Amount: 50.00euro.">
                                          <div class="input-icon">
                                             <svg class="icon icon-coin">
                                                <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                             </svg>
                                          </div>
                                          <div class="valid inline"></div>
                                       </div>
                                    </div>
                                 </label>
                              </div>
                              <div class="form-row">
                                 <div class="form-label">Payment method</div>
                                 <div class="select-payment">
                                    <input type="hidden" name="type" value="" id="depositType">
                                    <div class="bottom-start dropdown">
                                       <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-secondary" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Choose a method                                          <div class="opener">
                                             <svg class="icon icon-down">
                                                <use xlink:href="/img/symbols.svg#icon-down"></use>
                                             </svg>
                                          </div>
                                       </button>
                                       <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" data-placement="bottom-start">
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="freekassa">
                                             <div class="image"><img src="/img/fkwallet.png" alt="freekassa"></div>
                                             <span>FreeKassa</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="linepay">
                                             <div class="image"><img src="/img/wallets/qiwi.png" alt="linepay"></div>
                                             <span>Qiwi</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="linepay">
                                             <div class="image"><img src="/img/wallets/payeer.png" alt="linepay"></div>
                                             <span>Payeer</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="linepay">
                                             <div class="image"><img src="/img/wallets/yoomoney.png" alt="linepay"></div>
                                             <span>Yoomoney</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="freekassa">
                                             <div class="image"><img src="/img/wallets/visa.png" alt="freekassa"></div>
                                             <span>Visa / MasterCard</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="linepay">
                                             <div class="image"><img src="/img/wallets/mobile.png" alt="linepay"></div>
                                             <span>Mobile Operators</span>
                                          </button>
                                        </div> 

                                    </div>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-green">Go to payment</button>
                           </form>
                        </div>

                        <div class="deposit-section tab" data-type="withdraw">
                           <div class="form-row">
                           </div>
                           <div class="form-row">
                              <div class="form-label">Withdraw Method</div>
                              <div class="select-payment">
                                 <input type="hidden" name="type" value="" id="withdrawType">
                                 <div class="bottom-start dropdown">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-secondary" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select a method                                       <div class="opener">
                                          <svg class="icon icon-down">
                                             <use xlink:href="/img/symbols.svg#icon-down"></use>
                                          </svg>
                                       </div>
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 46px, 0px);" data-placement="bottom-start">
                                       <button type="button" data-id="6" tabindex="0" role="menuitem" class="dropdown-item" data-system="payeer">
                                          <div class="image"><img src="/img/wallets/payeer.png" alt="payeer"></div>
                                          <span>Payeer</span>
                                       </button>
                                       <button type="button" data-id="6" tabindex="0" role="menuitem" class="dropdown-item" data-system="qiwi">
                                          <div class="image"><img src="/img/wallets/qiwi.png" alt="qiwi"></div>
                                          <span>Qiwi</span>
                                       </button>
                                       <button type="button" data-id="3" tabindex="0" role="menuitem" class="dropdown-item" data-system="yandex">
                                          <div class="image"><img src="/img/wallets/yoomoney.png" alt="yoomoney"></div>
                                          <span>YooMoney</span>
                                       </button>
                                       <button type="button" data-id="2" tabindex="0" role="menuitem" class="dropdown-item" data-system="visa">
                                          <div class="image"><img src="/img/wallets/visa.png" alt="visa"></div>
                                          <span>VISA / Mastercard</span>
                                       </button>
                                       <button type="button" data-id="2" tabindex="0" role="menuitem" class="dropdown-item" data-system="mobile" disabled>
                                          <div class="image"><img src="/img/wallets/mobile.png" alt="Mobile payments"></div>
                                          <span>Mobile payments</span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Enter your wallet number</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field" name="purse" placeholder="" value="" id="numwallet">
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Withdraw Method</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field input-with-icon" name="amount" value="" id="valwithdraw" placeholder="Enter the amount">
                                       <div class="input-icon">
                                          <svg class="icon icon-coin">
                                             <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                          </svg>
                                       </div>
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <div class="form-row">
                              <div class="com-row">
                              Commission: <span>0%</span>
                              </div>
                           </div>
                           <button type="submit" disabled="" class="btn btn-green" id="submitwithdraw">Withdraw (<span id="totalwithdraw">0</span>)</button>
                           <div class="checkbox-block">
                              <label>I confirm that the details are correct                              <input name="agree" type="checkbox" id="withdraw-checkbox" value=""><span class="checkmark"></span></label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="exchangeModal" tabindex="-1" role="dialog" aria-labelledby="exchangeModalLabel" aria-hidden="true">
            <div class="modal-dialog faucet-demo-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                <div class="faucet-container">
                    <h3 class="faucet-caption"><span>Bonus exchange</span></h3>
                    <div class="caption-line"><span class="span"><svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div>
                    <div class="faucet-modal-form">
                        <div class="faucet-reload"><span>Min. amount</span> <span><?php echo e($settings->exchange_min); ?></span> <svg class="icon icon-coin bonus"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                    </div>
                    <div class="faucet-modal-form">
                        <div class="faucet-reload"><span>Course</span> <span><?php echo e($settings->exchange_curs); ?></span> <svg class="icon icon-coin bonus"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg> = <span>1</span> <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                    </div>
                    <div class="form-row">
                        <label>
                            <div class="form-label">Exchange amount</div>
                            <div class="form-field">
                                <div class="input-valid">
                                    <input class="input-field input-with-icon" name="amount" placeholder="Enter the amount" id="exSum">
                                    <div class="input-icon">
                                        <svg class="icon icon-coin">
                                            <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                        </svg>
                                    </div>
                                    <div class="valid inline"></div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="faucet-modal-form">
                        <div class="faucet-amount">
                            <div class="faucet-reload"><span>You will get:</span> <span id="exTotal">0</span> <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                        </div>
                        <button type="button" class="btn btn-green exchangeBonus"><span>Swap</span></button>
                    </div>
                </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="promoModalLabel" aria-hidden="true">
            <div class="modal-dialog faucet-demo-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="faucet-container">
                     <h3 class="faucet-caption"><span>Activate promo code</span></h3>
                     <div class="caption-line">
                        <span class="span">
                           <svg class="icon icon-coin">
                              <use xlink:href="/img/symbols.svg#icon-coin"></use>
                           </svg>
                        </span>
                     </div>
                     <div class="form-row">
                        <label>
                           <div class="form-field">
                              <div class="input-valid">
                                 <input class="input-field input-with-icon" name="promo" placeholder="XXXX-XXXX-XXXX-XXXX" id="promoInput">
                                 <div class="input-icon">
                                    <svg class="icon icon-promo">
                                       <use xlink:href="/img/symbols.svg#icon-promo"></use>
                                    </svg>
                                 </div>
                              </div>
                           </div>
                        </label>
                     </div>
                     <div class="faucet-modal-form">
                        <button type="button" class="btn btn-green activatePromo"><span>Activate</span></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="captchaModal" tabindex="-1" role="dialog" aria-labelledby="captchaModalLabel" aria-hidden="true">
            <div class="modal-dialog captcha-need-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="captcha-need-modal-container">
                     <div class="caption">Confirm you are not a robot!</div>
                     <div class="form">
                        <div class="label">Click "I am not a robot" to continue!</div>
                        <div class="captcha">
                           <div hl="ru">
                              <div>
                                 <div style="width: 304px; height: 78px;">
                                    <div data-callback="recaptchaCallback" data-sitekey="6Lfmcu4nAAAAAGvGcNYxERxBDsopA6-SD8ZCIvFu" class="g-recaptcha"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <button type="button" disabled="" class="btn" id="submitBonus">Continue</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <?php if($u->is_admin == 1 || $u->is_moder == 1): ?>
        <div class="modal fade" id="bannedModal" tabindex="-1" role="dialog" aria-labelledby="bannedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button class="modal-close" data-dismiss="modal" aria-label="Close">
                        <svg class="icon icon-close">
                            <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                    </button>
                    <div class="faucet-container">
                        <h3 class="faucet-caption"><span>Locked users</span></h3>
                        <h3 class="faucet-caption"><div id="unbanName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <div class="table-heading">
                                <div class="thead">
                                    <div class="tr">
                                        <div class="th">User</div>
                                        <div class="th">Ban Ending</div>
                                        <div class="th">Reason</div>
                                        <div class="th">Actions</div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-ban-wrap" style="max-height: 100%;">
                                <div class="table-wrap" style="transform: translateY(0px);">
                                    <table class="table">
                                        <tbody id="bannedList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
            <div class="modal-dialog faucet-demo-modal modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button class="modal-close" data-dismiss="modal" aria-label="Close">
                        <svg class="icon icon-close">
                            <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                    </button>
                    <div class="faucet-container">
                        <h3 class="faucet-caption"><span>Block Chat to a user</span></h3>
                        <h3 class="faucet-caption"><div id="banName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <input type="hidden" name="user_ban_id">
                            <label>
                                <div class="form-label">Ban time in minutes</div>
                                <div class="form-field">
                                    <div class="input-valid">
                                        <input class="input-field input-with-icon" name="time" placeholder="Time" id="banTime">
                                        <div class="input-icon">
                                            <svg class="icon">
                                                <use xlink:href="/img/symbols.svg#icon-time"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-row">
                            <input type="hidden" name="user_ban_id">
                            <label>
                                <div class="form-label">Reason for ban</div>
                                <div class="form-field">
                                    <div class="input-valid">
                                        <input class="input-field input-with-icon" name="reason" placeholder="Reason" id="banReason">
                                        <div class="input-icon">
                                            <svg class="icon">
                                                <use xlink:href="/img/symbols.svg#icon-edit"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-row">
                            <button type="button" class="btn btn-green banThis"><span>Ban</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="unbanModal" tabindex="-1" role="dialog" aria-labelledby="unbanModalLabel" aria-hidden="true">
            <div class="modal-dialog faucet-demo-modal modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button class="modal-close" data-dismiss="modal" aria-label="Close">
                        <svg class="icon icon-close">
                            <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                    </button>
                    <div class="faucet-container">
                        <h3 class="faucet-caption"><span>Unlock chat to a user</span></h3>
                        <h3 class="faucet-caption"><div id="unbanName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <input type="hidden" name="user_unban_id">
                            <button type="button" class="btn btn-green unbanThis"><span>Unban</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
         <?php endif; ?>
         <div class="modal fade" id="tosModal" tabindex="-1" role="dialog" aria-labelledby="tosModalLabel" aria-hidden="true">
            <div class="modal-dialog tos-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="tos-modal-container">
                     <div class="scrollbar-container tos-modal-block ps"></div>
                     <p>Terms used in this Agreement:</p>

<p>"Game" means an entertaining gaming event starting at the time of day specified in the Organiser's schedule and taking place during a certain continuous period of time in accordance with the scenario and conditions determined by the Organiser, which include, among other things, compliance with the Rules.</p>

<p>"Place of Service" means the Internet site located at: https://www.luck2x.com</p>

<p>"Organiser" means the Person who is the right holder of the Site, as well as the performer providing access to the Site.</p>

<p>"Personal Data" - any information relating directly or indirectly to a specific or identifiable natural person (subject of personal data).</p>

<p>"User" means an individual who has made a registration on the Site in accordance with the terms of this Agreement.</p>

<p>"Rules" - requirements and rules mandatory for each Participant to comply with when receiving Services, including, but not limited to: restrictions on age, composition and number of Participants for participation in the Game, restrictions on the Participant's health and physical condition, etc. depending on the conditions of provision of Services of a certain type.</p>

<p>"Profile" - a combination of login and password to access the User's personal page within the Website, allowing access to the Website services.</p>

<p>"Site" - a resource placed in the Internet at https://www.luck2x.com, through which information about the Services is provided.</p>

<p>"Service", "Services" - a set of activities to provide the User access to the Website, carried out by the Organiser, as well as other related activities in accordance with the order of the User, Participant (his/her legal representative) or other person who wishes to participate in the Game personally or to ensure the participation of other person(s) in the Game.</p>

<p>"In-game currency" is a conventional unit used on the Site to calculate additional in-game features available to the User. In-game currency is not a means of payment and cannot be used outside the Site. In-game currency may be credited to the User without payment when the User performs certain actions on the Site. The actions resulting in the accrual of the In-game currency are determined by the Administrator.</p>

<p>"Participant" means an individual who is the recipient of the Service(s) to participate in the Game.</p>

<p>1.1 This Agreement is a public offer in accordance with Clause 2 of Article 437 of the Civil Code of the Russian Federation and defines the terms and conditions of rendering and receiving the Services, provisions for booking the Services, as well as the terms and conditions of using the Website.</p>

<p>1.2 This Agreement enters into force from the moment the User and/or the Participant (his/her legal representative) expresses consent to its terms and conditions in the manner specified in clauses 1.3 and 1.4 of this Agreement and is valid indefinitely. 1.3 and 1.4 of this Agreement and shall be valid indefinitely.</p>

<p>1.3 Having passed the registration procedure, the User is considered to have read in detail and unconditionally accepted the terms of this Agreement in full without limitation in accordance with Article 438 of the Civil Code of the Russian Federation by ticking the box next to the link to the text of the User Agreement. If the User does not agree fully or partially with the provisions of this Agreement, he/she shall not be entitled to use the Site, as well as to receive the Services.</p>

<p>1.4 The Organiser may at any time unilaterally and without any special notice make changes and/or amendments to this Agreement by publishing an updated version on the Website. The updated version of this Agreement shall come into force from the moment of its publication on the Website.</p>

<p>If the User does not agree fully or partially with the provisions of the updated version of the Agreement, he/she may not use the Site.</p>

<p>1.6 The terms of use of materials and services of the Site are governed by this Agreement and other agreements posted on the Site.</p>

<p>2. Terms and Conditions of the Services.</p>

<p>2.1 In order to receive the Services, the Member must acquire the status of a User as set forth in Section 4 of this Agreement. The person wishing to receive the Services may also purchase in-game currency in accordance with Section 4 of this Agreement.</p>

<p>2.2 Participants who comply with the Rules in accordance with Section 3 of this Agreement are allowed to participate in the Game.</p>

<p>2.3 The Organiser has the right to organise various stimulating events to attract the attention of potential Participants to the Game (promotions, gift cards for participation, etc.). The procedure for their implementation shall be communicated to Users on the Website, as well as by other means determined by the Organiser.</p>

<p>3. Rules for admission and participation in the Game.</p>

<p>3.1 Persons aged 18 years and older are allowed to participate in the Game. Persons under the age of 18 are not allowed to participate in the Game.</p>

<p>3.2 The physical as well as psychological condition of the Participant must comply with the conditions and procedure of the Game and participation in it. In particular, the Game shall not allow the following categories of persons to participate in it:</p>

<p>- persons with disabilities,</p>

<p>- persons with mental disorders of any kind in any manifestation,</p>

<p>- of violent individuals,</p>

<p>- persons who do not comply with any other terms and conditions of this Agreement or who do not fulfil the requirements specified in this Agreement,</p>

<p>- any other persons in respect of whom there is a possibility that participation in the Game may provoke a risk of any kind of negative consequences for the Participant.</p>

<p>3.3 The Organiser reserves the unconditional right to refuse to provide the Services if it suspects the authenticity of the data reported by the Participant (his/her legal representative) under clauses 3.1. and 3.2. of this Agreement.</p>

<p>3.4 The Participant and/or his/her legal representative has the right to independently decide to refuse to participate in the Game at any time.</p>

<p>4. payment for the Services.</p>

<p>4.1 The provision of Services to provide access to the Site, including for participation in the Game, is provided only to registered users. To participate in the Game, the User has the right to purchase in-game currency.</p>

<p>4.2 The purchase of the In-game currency is carried out by the User on a voluntary basis.</p>

<p>4.3 In case of payment of the In-game currency, it is credited to the User in the amount corresponding to the paid denomination. After payment or deposit of the amount in the In-game currency on the Site, its further use is carried out exclusively within the Site, and the Administrator's obligations to transfer the In-game currency (crediting the payment) are considered to be fulfilled in full, regardless of whether the User uses these certain additional functions on the Site or not.</p>

<p>4.4 The User acknowledges and agrees that the Administrator does not convert the In-game currency back into cash in cash or non-cash form and does not compensate any expenses of the User, including, but not limited to, expenses in connection with the transfer of funds to the Administrator, as well as does not pay interest for the use of funds. The User may not purchase the In-game currency from any third parties, as well as sell or transfer the In-game currency free of charge.</p>

<p>4.5 The User acknowledges and agrees that the In-Game Currency may only be used to obtain additional in-game features within the game and the funds credited to the User's account are non-refundable in any form.</p>

<p>4.6 When paying for the Service, the User confirms that he/she is fully aware, understands the terms of this Agreement and accepts them, as well as understands and agrees that the Administrator reserves the right at any time to remove any content from the Site without notice to the User, including in connection with the expiry of the Administrator's licence agreements with right holders, and/or add any content to the Site without notice to the User. Before paying for the Service, the User undertakes to familiarise himself/herself in advance with the list of content units on the Site. Payment by the User of the Service means that the User is familiarised with the list of content units and is fully satisfied with its content.</p>

<p>4.7 The Parties acknowledge and agree that the Administrator shall not be liable to the User in case of failure to receive funds to the User's account for reasons beyond the control of the Administrator, including, but not limited to: software failures or equipment failures of banks, telecom operators, payment systems and other payment intermediaries that ensure the receipt of payments for Services from Users and their transfer to the Administrator. The Parties also recognise and agree that the Administrator is not obliged to provide the User with the Service until the moment of receipt of funds for it from the User to the current account of the Administrator.</p>

<p>5. Terms of use of materials and services of the Site.</p>

<p>5.1 The User undertakes to read this Agreement carefully.</p>

<p>5.2 The Administrator unilaterally has the right to establish restrictions in the use of materials and services of the Site both for all Users and for certain categories of Users.</p>

<p>5.3 The User may not use any devices, programmes, procedures, algorithms and methods, automatic devices or equivalent manual processes to access, acquire, copy or monitor the content of the Site.</p>

<p>5.4 The User has no right to violate the security or authentication system on the Site or any network related to the Site or the Administrator.</p>

<p>5.5 The User may not use the Site and its content for any purposes prohibited by the legislation of the Russian Federation, as well as incite any illegal activities or other activities that violate the rights of the Organiser and/or other persons.</p>

<p>6. Personal data and privacy policy.</p>

<p>See the relevant section.</p>

<p>7. Deposit, transfer, withdrawal from the account.</p>

<p>7.1 We do not accept cash deposits and deposits/withdrawals from third party accounts.</p>

<p>7.2 All payment methods will be available on the Website, these may vary from country to country and may also be changed by the Website from time to time.</p>

<p>7.3 You are responsible for payment of fees that may be charged by payment processors. Funds deposited to an account on the Web Site must be cleared of all such fees.</p>

<p>7.4 You need to put money into an account that belongs to you, we may require proof of the source of the funds. Personal details are shown on the debit / credit card. The e-wallet / bank transfer (e.g. full name) must match the personal details of the User's account on the Website to which the funds are being transferred.</p>

<p>7.4.1 If a credit/debit card is used, We ask You to provide images of the front and back of Your card showing the card name and number, date of issue and CVV code.</p>

<p>7.5 The Website, as and when it deems necessary, may change the limits for deposits/withdrawals.
7.6 The website is not a bank or other institution, therefore no interest will be charged on your deposit.
7.7 The Website will transfer funds within 24 hours of successful completion of identification as set out above or in accordance with your chosen payment processor's terms and conditions. For some payment processors the transfer may take up to 3 working days.
7.8 The minimum amount for withdrawal is 100 RUB. Withdrawal limit per week: 30 000 RUB. The site reserves the right to divide the amount into smaller amounts when withdrawing. Withdrawal of funds is possible only if the balance is reached. You will be able to withdraw funds as soon as you have played 100% of the deposit amount.
7.9 The Organiser will not refund the deposited funds under any circumstances
8. Liability. Limitation of liability.</p>

<p>8.1 Access to the Site is provided "as it exists" and the Administrator makes no warranty or representation with respect thereto.</p>

<p>8.2 The User understands and agrees that the Administrator may remove or move (without warning) any results of intellectual activity posted on the Site (including content) at its sole discretion, for any reason or for no reason, including without any limitation moving or removing the results of intellectual activity.</p>

<p>8.3 The User understands and agrees that the Administrator is not responsible for any errors, omissions, interruptions, deletions, defects, delays in processing or transmission of data, communication line failures, theft, destruction or unauthorised access by third parties to the results of intellectual activity posted on the Site. The Administrator is not responsible for any technical failures or other problems of any telephone networks or services, computer systems, servers or providers, computer or telephone equipment, software, failure of e-mail services or scripts for technical reasons. Also, the Administrator is not responsible for compliance of the whole Site or its parts (services) with the expectations of Users, error-free and uninterrupted operation of the service, termination of User's access to the Site and the results of intellectual activity posted on the Site, losses incurred by Users for reasons related to technical failures of hardware or software.</p>

<p>8.4 The Administrator is not responsible for any damage to the User's or any other person's electronic devices, mobile devices, any other hardware or software caused by or related to the use of the Site.</p>

<p>8.5 Under no circumstances shall the Administrator be liable to the User or any third parties for any direct, indirect, unintentional damage, including lost profits or lost data, harm to honour, dignity or business reputation, caused in connection with the use of the Site or the results of intellectual activity posted on the Site. In any case, the Parties agree that the amount of losses of the User for any violations of the Administrator related to the use of the Site is limited by the Parties to the amount of 500 (five hundred) rubles.</p>

<p>8.6 The Administrator shall not be liable to the User or any third parties for:</p>

<p>User's actions on the Website;</p>

<p>content and legality, reliability of the information used/received by the User on the Website;</p>

<p>quality of goods/works/services purchased by the User after viewing advertising messages (banners, videos, etc.) posted on the Website and their possible non-compliance with generally accepted standards or expectations of the User;</p>

<p>reliability of the advertising information used/received by the User on the Website and the quality of the goods/works/services advertised therein;</p>

<p>consequences of the application of information used/received by the User on the Website.</p>

<p>8.7 The Administrator shall not be liable for violation by the User of the terms and conditions set forth in this Agreement.</p>

<p>8.8 The site may contain links to other resources of the global Internet. The User acknowledges and agrees that the Administrator does not control and bears no responsibility for the availability of these resources and for their content, as well as for any consequences associated with the use of these resources. Any clicks on the links made by the User, the latter makes at his own risk.</p>

<p>9.Handling of complaints and applicable law.</p>

<p>9.1 In case of disputes and disagreements, MoneYear's decision is final and the User fully agrees with it. All disputes and disagreements arising in connection with this Agreement shall be resolved through negotiations. If it is impossible to reach an agreement through negotiations, disputes, disagreements and claims arising from this Agreement shall be resolved in accordance with the applicable laws of the Netherlands Antilles.
</p>


                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="fairModal" tabindex="-1" role="dialog" aria-labelledby="tosModalLabel" aria-hidden="true">
            <div class="modal-dialog fair-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="fair-modal__container">
                     <h1><span>Provably Fair</span></h1>
                     <span>Our fair play system ensures that we cannot manipulate the outcome of the game. <br><br> Just as you would remove the deck in a real casino. This implementation gives you complete peace of mind during the game, knowing that we cannot "adjust" the bets in our favour.<br><br></span>
                     <div class="collapse-component">
                        <div class="form-field">
                           <div class="input-valid">
                              <input class="input-field input-with-icon" name="hash" id="gameHash" placeholder="Enter a hash">
                              <div class="input-icon">
                                 <svg class="icon icon-coin">
                                    <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                 </svg>
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="button" class="btn btn-rotate checkHash"><span>Check</span></button>
                     <div class="fair-table" style="display: none;">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th><span># Games</span></th>
                                 <th><span>Generated number</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td id="gameRound"></td>
                                 <td id="gameNumber"></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog user-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="user-modal__container"></div>
               </div>
            </div>
         </div>
    <?php if(session('error')): ?>
        <script>
        $.notify({
            type: 'error',
            message: "<?php echo e(session('error')); ?>"
        });
        </script>
    <?php elseif(session('success')): ?>
        <script>
        $.notify({
            type: 'success',
            message: "<?php echo e(session('success')); ?>"
        });
        </script>
    <?php endif; ?>
    </body>
   </html>
<?php endif; ?>
<?php endif; ?>
<?php /* /var/www/html/resources/views/layout.blade.php */ ?>