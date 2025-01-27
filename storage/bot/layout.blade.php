@if(!Auth::check() && $settings->site_disable || $settings->site_disable && Auth::check() && !$u->is_admin)
<!DOCTYPE html>
<html>
<head>
    <title>{{$settings->title}}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/pre.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="/img/logo233.png" alt="">
        <span class="title">Тех. работы!</span>
        <a href="{{$settings->vk_url}}" class="vk" target="_blank"><span>Перейти в группу </span><i class="fab fa-vk"></i></a>
    </div>
</body>
@else
@if(Auth::user() && $u->ban)
<!DOCTYPE html>
<html>
<head>
    <title>{{$settings->title}}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/pre.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="/img/logo233.png" alt="">
        <span class="title">Вы забанены!</span>
        @if($u->ban_reason)<span class="text">{{$u->ban_reason}}</span>@endif
        <a href="{{$settings->vk_url}}" class="vk" target="_blank"><span>Перейти в группу </span><i class="fab fa-vk"></i></a>
        <a href="/logout" class="vk" target="_blank"><span>Выйти</span></a>
    </div>
</body>
@else
<!DOCTYPE html>
   <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="description" content="">
        <title>{{$settings->title}}</title>
        <link rel="stylesheet" href="/css/main.css?v={{ time() }}">
        <link rel="stylesheet" href="/css/icon.css">
        <link rel="stylesheet" href="/css/notify.css?v=2">
        <link rel="stylesheet" href="/css/animation.css">
        <link rel="stylesheet" href="/css/media.css">
        <link rel="stylesheet" href="/css/winter.css?v=4">
        <!--<link rel="stylesheet" href="/css/light.css?v=1">-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        {!! NoCaptcha::renderJs() !!}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
        <script type="text/javascript" src="/js/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="/js/wnoty.js"></script>
        <script type="text/javascript" src="/js/snowfall.jquery.js"></script>
        <script type="text/javascript" src="/js/main.js?v=20"></script>
        @if(Auth::user() and $u->is_admin == 1 || $u->is_moder == 1)
        <script type="text/javascript" src="/js/moderatorOptions.js"></script>
        @endif
        <script>
            @auth
            const USER_ID = '{{ $u->unique_id }}';
            const youtuber = '{{ $u->is_youtuber }}';
            const admin = '{{ $u->is_admin }}';
            const moder = '{{ $u->is_moder }}';
            @else
            const USER_ID = null;
            const youtuber = null;
            const admin = null;
            const moder = null;
            @endauth
            const settings = {!! json_encode($gws) !!};
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
                            <img src="/img/logo233.png" alt="" style="transform: translateY(-3px);">
                        </a>
                        @auth
                        <div class="top-nav-wrapper">
                            <button class="opener">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                            </button>
                            <ul class="top-nav">
                                <li>
                                    <a class="{{ Request::is('affiliate') ? 'isActive' : '' }}" href="/affiliate">
                                        <svg class="icon icon-affiliate">
                                            <use xlink:href="/img/symbols.svg#icon-affiliate"></use>
                                        </svg>
                                        <span>Рефералы</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('free') ? 'isActive' : '' }}" href="/free">
                                        <svg class="icon icon-faucet">
                                            <use xlink:href="/img/symbols.svg#icon-faucet"></use>
                                        </svg>
                                        <span>Раздача</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-target="#promoModal">
                                        <svg class="icon icon-promo">
                                            <use xlink:href="/img/symbols.svg#icon-promo"></use>
                                        </svg>
                                        <span>Промокоды</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('ranks') ? 'isActive' : '' }}" href="/ranks">
                                        <svg class="icon icon-crash">
                                            <use xlink:href="/img/symbols.svg#icon-crash"></use>
                                        </svg>
                                        <span>Ранги</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('tournament') ? 'isActive' : '' }}" href="/tournament" style="color: gold;">
                                        <svg class="icon icon-top">
                                            <use xlink:href="/img/symbols.svg#icon-top"></use>
                                        </svg>
                                        <span>Турнир</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="toggle">
                                        <button class="btn">
                                            <svg class="icon icon-faq">
                                                <use xlink:href="/img/symbols.svg#icon-faq"></use>
                                            </svg>
                                            <span>Помощь</span>
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
                                                    <span>Ответы на вопросы</span>
                                                </a>
                                            </li>
                                            @if($settings->vk_support_link)
                                            <li>
                                                <a href="{{$settings->vk_support_link}}" target="_blank">
                                                    <svg class="icon icon-support">
                                                        <use xlink:href="/img/symbols.svg#icon-support"></use>
                                                    </svg>
                                                    Написать в поддержку
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="toggle">
                                        <button class="btn">
                                            <span>Еще</span>
                                            <svg class="icon icon-down">
                                                <use xlink:href="/img/symbols.svg#icon-down"></use>
                                            </svg>
                                        </button>
                                        <ul class="">
                                        <li>
                                            <a class="{{ Request::is('clans') ? 'isActive' : '' }}" href="/clans">
                                                <span>Кланы</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('clan') ? 'isActive' : '' }}" href="/clan/my">
                                                <span>Мой клан</span>
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                </li>
                                @if(Auth::check() && $u->is_admin)
                                <li>
                                    <a href="/admin">
                                        <svg class="icon icon-fairness">
                                            <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                        </svg>
                                        <span>Панель</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endauth
                    </div>
                    @guest
                    <div class="auth-buttons">
                        <a href="/auth/vkontakte" class="btn">
                            Войти через
                            <svg class="icon icon-vk">
                                <use xlink:href="/img/symbols.svg#icon-vk"></use>
                            </svg>
                        </a>
                    </div>
                    @else
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
                                        </svg><span>&nbsp;Реальный счет</span>
                                        <div class="value" id="balance_bal">{{$u->balance}}</div>
                                    </div>
                                </button>
                                <button type="button" data-id="bonus" tabindex="0" role="menuitem" class="dropdown-item">
                                    <div class="balance-item bonus">
                                        <svg class="icon icon-coin">
                                            <use xlink:href="/img/symbols.svg#icon-coin"></use>
                                        </svg><span>&nbsp;Бонусный счет</span>
                                        <div class="value" id="bonus_bal">{{$u->bonus}}</div>
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
                            <img src="{{$u->avatar}}" alt="">
                          </div>
                          <div class="user-wrapper">
                            <div class="user-name-box">
                              <div class="user-name" style="@if($u->style > 0) {{\App\Styles::where('id', $u->style)->first()->css}} @endif">{{$u->username}}</div>
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
                          <button type="button" tabindex="0" role="menuitem" class="user-link dropdown-item" data-id="{{$u->unique_id}}">
                            <div class="user-item">
                              <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-person"></use>
                              </svg>
                              <span class="user-item-text">Информация</span>
                            </div>
                          </button>
                          <a href="/profile/history">
                            <button type="button" tabindex="0" role="menuitem" class="dropdown-item">
                              <div class="user-item">
                                <svg class="icon icon-history">
                                  <use xlink:href="/img/symbols.svg#icon-history"></use>
                                </svg>
                                <span class="user-item-text">История</span>
                              </div>
                            </button>
                          </a>
                           <!-- <button type="button" tabindex="0" role="menuitem" class="dropdown-item" id="settings">
                              <div class="user-item">
                                <svg class="icon icon-history">
                                  <use xlink:href="/img/symbols.svg#icon-settings"></use>
                                </svg>
                                <span class="user-item-text">Настройки</span>
                              </div>
                            </button>-->
                          <a href="/logout">
                            <button type="button" tabindex="0" role="menuitem" class="dropdown-item">
                              <div class="user-item">
                                <svg class="icon icon-logout">
                                  <use xlink:href="/img/symbols.svg#icon-logout"></use>
                                </svg>
                                <span class="user-item-text">Выход</span>
                              </div>
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                    @endguest
                </div>
            </div>
               <div class="left-sidebar">
                <ul class="side-nav">
                    <li class="{{ Request::is('jackpot') ? 'current' : '' || Request::is('jackpot/history') ? 'current' : ''  || Request::is('jackpot/history/*') ? 'current' : '' }}">
                        <a class="" href="/jackpot">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-jackpot"></use>
                            </svg>
                            <div class="side-nav-tooltip">Jackpot</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('wheel') ? 'current' : '' || Request::is('wheel/history') ? 'current' : '' }}">
                        <a class="" href="/wheel">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-roulette"></use>
                            </svg>
                            <div class="side-nav-tooltip">Wheel</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('crash') ? 'current' : '' }}">
                        <a class="" href="/crash">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-crash"></use>
                            </svg>
                            <div class="side-nav-tooltip">Crash</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('coinflip') ? 'current' : '' }}">
                        <a class="" href="/coinflip">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-flip"></use>
                            </svg>
                            <div class="side-nav-tooltip">PvP</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('battle') ? 'current' : '' }}">
                        <a class="" href="/battle">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-battle"></use>
                            </svg>
                            <div class="side-nav-tooltip">Battle</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('dice') ? 'current' : '' }}">
                        <a class="" href="/dice">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-dice"></use>
                            </svg>
                            <div class="side-nav-tooltip">Dice</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('hilo') ? 'current' : '' }}">
                        <a class="" href="/hilo">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-hilo"></use>
                            </svg>
                            <div class="side-nav-tooltip">Hilo</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('tower') ? 'current' : '' }}">
                        <a class="" href="/tower">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-tower"></use>
                            </svg>
                            <div class="side-nav-tooltip">Tower</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('king') ? 'current' : '' }}">
                        <a class="" href="/king">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-king"></use>
                            </svg>
                            <div class="side-nav-tooltip">King</div>
                        </a>
                    </li>
                    <li class="{{ Request::is('mines') ? 'current' : '' }}">
                        <a class="" href="/mines">
                            <svg class="icon">
                                <use xlink:href="/img/symbols.svg#icon-mines"></use>
                            </svg>
                            <div class="side-nav-tooltip">Mines</div>
                        </a>
                    </li>
                </ul>
               </div>
               <div class="main-content">
                  <div class="main-content-top" style="margin-top:-40px">
                     <link rel="stylesheet" href="/css/games.css?v=12">
                        <div class="section_Section__14IWw landing_LandingGameSection__JPR73">
                            @yield('content')
                        </div>
                  </div>
                <div class="main-content-footer">
                    <div class="footer-counters">
                        <div class="container">
                            <div class="row">
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-user"></use></svg>
                                        <div class="counter-num">{{$stats['countUsers']}}</div>
                                        <div class="counter-text">Всего игроков</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-add-user"></use></svg>
                                        <div class="counter-num">{{$stats['countUsersToday']}}</div>
                                        <div class="counter-text">За сегодня игроков</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                    <div class="counter-block">
                                    <svg class="icon-statistics"><use xlink:href="/img/symbols.svg#icon-stats-clock"></use></svg>
                                        <div class="counter-num">{{$stats['totalGames']}}</div>
                                        <div class="counter-text">Сыграно игр</div>
                                    </div>
                                </div>
                                <div class="col col-3 col-md-6">
                                <div class="counter-block">
                                <svg class="icon-statistics" style="fill: #d8edf9;"><use xlink:href="/img/symbols.svg#icon-stats-card"></use></svg>
                                    <div class="counter-num">{{$stats['totalWithdraw']}}</div>
                                        <div class="counter-text">Выплачено</div>
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
                                        <li><a class="" data-toggle="modal" data-target="#tosModal">Пользовательское соглашение</a></li>
                                        @if($settings->vk_url)
                                        <li>
                                            <a href="{{$settings->vk_url}}" target="_blank">
                                                <svg class="icon icon-vk">
                                                    <use xlink:href="/img/symbols.svg#icon-vk"></use>
                                                </svg>{{$settings->sitename}}
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col col-5">
                                    <div class="copyright">
                                        <div class="footer-logo"><img src="/img/logo233.png" alt=""></div>
                                        <div class="text">© 2023 {{$settings->sitename}}
                                            <br> All rights reserved</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
               
            <div class="right-sidebar">
            <div id="btnchat">
                            <svg class="icon icon-close">
                                <use xlink:href="/img/symbols.svg#icon-close"></use>
                            </svg>
                        </div>
                <div class="sidebar-container">
                  @auth
          
                    @endauth
                    <div class="chat tab current">
                        @auth
                        
                        @endauth
                        <div class="chat-params" style="margin-top: 60px;">
                            <div class="item">
                            <div class="point-online"></div>
                                <div class="chat-online">On-Line:&nbsp;<span>0</span></div>
                            </div>
                            <div class="item">
                                @if(Auth::user() and $u->is_admin)
                                <div class="toggle">
                                  <a class="toggle-btn" data-toggle="tooltip" data-placement="top" title="Режим администратора">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-sheriff"></use>
                    </svg>
                  </a>
                                </div>
                                @endif
                                @if(Auth::user() and $u->is_admin || $u->is_moder)
                                <div class="list">
                                  <button class="banned-btn" data-toggle="tooltip" data-placement="top" title="Забаненные пользователи">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-ban"></use>
                    </svg>
                  </button>
                                </div>
                                <div class="clear">
                                  <button class="clear-btn clearChat" data-toggle="tooltip" data-placement="top" title="Очистить чат">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-clear"></use>
                    </svg>
                  </button>
                                </div>
                                @endif
                                @auth
                                <div class="share">
                                  <button class="share-btn shareToChat" data-toggle="tooltip" data-placement="top" title="Поделиться балансом">
                    <svg class="icon">
                      <use xlink:href="/img/symbols.svg#icon-coin"></use>
                    </svg>
                  </button>
                                </div>
                                @endauth
                                <button class="close-btn">
                                    <svg class="icon icon-close">
                                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="chat-conversation">
                            <div class="scrollbar-container chat-conversation-inner ps">
                                @if($messages != 0) @foreach($messages as $sms)
                                <div class="message-block user_{{$sms['unique_id']}}" id="chatm_{{$sms['time2']}}">
                                    <div class="message-avatar {{ $sms['admin'] ? 'isAdmin' : '' }}{{ $sms['moder'] ? 'isModerator' : '' }}"><img src="{{$sms['avatar']}}" alt=""></div>
                                    <div class="message-content">
                                        <div>
                                            <button class="user-link" type="button" data-id="{{$sms['unique_id']}}">
                                                <span class="sanitize-name" style="{{$sms['userStyle']}}">
                                                    {!!$sms['rank']!!}
                                                  <span class="sanitize-text">@if($sms['admin']) <span class="admin-badge isAdmin" data-toggle="tooltip" data-placement="top" title="Администратор">
                                                    <span class="">
                                                      <svg class="icon icon-a">
                                                        <use xlink:href="/img/symbols.svg#icon-a"></use>
                                                      </svg>
                                                    </span>
                                                  </span> Администратор @elseif($sms['moder']) <span class="admin-badge isModerator" data-toggle="tooltip" data-placement="top" title="Модератор">
                                                    <span class="">
                                                      <svg class="icon icon-m">
                                                        <use xlink:href="/img/symbols.svg#icon-m"></use>
                                                      </svg>
                                                    </span>
                                                  </span> {{$sms['username']}} @elseif($sms['youtuber']) <span class="admin-badge isYouTuber" data-toggle="tooltip" data-placement="top" title="YouTuber">
                                                    <span class="">
                                                      <svg class="icon icon-y">
                                                        <use xlink:href="/img/symbols.svg#icon-y"></use>
                                                      </svg>
                                                    </span>
                                                  </span> {{$sms['username']}} @else {{$sms['username']}} @endif <span>&nbsp;</span>
                                                </span>
                                                </span>
                                            </button>
                                            <div class="message-text">{!!$sms['messages']!!}</div>
                                        </div>
                                    </div>
                                    @if(Auth::user() and $u->is_admin || $u->is_moder)
                  <div class="delete">
                    <button type="button" class="btn btn-light" onclick="chatdelet({{$sms['time2']}})">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                      </svg><span>&nbsp;Удалить</span>
                    </button>
                    @if(!$sms['admin'])
                    @if(!$sms['ban'])
                    <button type="button" class="btn btn-light btnBan" data-name="{{$sms['username']}}" data-id="{{$sms['unique_id']}}">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-ban"></use>
                      </svg><span>&nbsp;Забанить</span>
                    </button>
                    @else
                    <button type="button" class="btn btn-light btnUnBan" data-name="{{$sms['username']}}" data-id="{{$sms['unique_id']}}">
                      <svg class="icon">
                        <use xlink:href="/img/symbols.svg#icon-ban"></use>
                      </svg><span>Разбанить</span>
                    </button>
                    @endif
                    @endif
                  </div>
                                  @endif
                                </div>
                                @endforeach @endif
                            </div>
                        </div>
                        @if(!Auth::User())
                        <div class="chat-empty-block">Чтобы писать в чат, необходимо авторизоваться</div>
                        @else
                          <input type="hidden" id="optional" value="0">
                          @if($u->banchat)
                          <div class="chat-ban-block">
                            <div class="title">Чат заблокирован!</div>
                          </div>
                          @else
                          <div class="chat-message-input">
                            <div class="chat-textarea">
                              <div class="chat-editable" contenteditable="true"></div>
                            </div>
                            <div class="chat-controls">
                              <button class="item" id="smilesBlock" data-toggle="popover" data-placement="top">
                                <svg class="icon icon-smile">
                                  <use xlink:href="/img/symbols.svg#icon-smile"></use>
                                </svg>
                              </button>
                              <button type="submit" class="item sendMessage">
                                <svg class="icon icon-send">
                                  <use xlink:href="/img/symbols.svg#icon-send"></use>
                                </svg>
                              </button>
                            </div>
                          </div>
                          @endif
                        @endif
                    </div>
          <div class="user-profile tab">
            @auth
            <div class="user-block" style="margin-top: 60px;">
              <div class="user-avatar">
                <button class="close-btn">
                  <svg class="icon icon-close">
                    <use xlink:href="/img/symbols.svg#icon-close"></use>
                  </svg>
                </button>
                <div class="avatar"><img src="{{$u->avatar}}" alt=""></div>
              </div>
              <div class="user-name">
                <div class="nickname" style="@if($u->style > 0) {{\App\Styles::where('id', $u->style)->first()->css}} @endif">{{$u->username}}</div>
              </div>
            </div>
            <ul class="profile-nav">
              <li>
                <a class="" href="/profile/history">
                  <div class="item-icon">
                    <svg class="icon icon-history">
                      <use xlink:href="/img/symbols.svg#icon-history"></use>
                    </svg>
                  </div><span>История</span>
                </a>
              </li>
            </ul>
            <a href="/logout" class="btn btn-logout">
              <div class="item-icon">
                <svg class="icon icon-logout">
                  <use xlink:href="/img/symbols.svg#icon-logout"></use>
                </svg>
              </div><span>Выход</span>
            </a>
            @endauth
          </div>
                </div>
            </div>
               <div class="mobile-nav-component">
                    @auth
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
                                    </svg>Рефералы
                                </a>
                            </li>
                            <li>
                                <a href="/faq">
                                    <svg class="icon icon-faq">
                                        <use xlink:href="/img/symbols.svg#icon-faq"></use>
                                    </svg>FAQ
                                </a>
                            </li>
                            @if($settings->vk_support_url)
                            <li>
                                <a href="{{$settings->vk_support_url}}" target="_blank">
                                    <svg class="icon icon-support">
                                        <use xlink:href="/img/symbols.svg#icon-support"></use>
                                    </svg>Тех. Поддержка
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="/free">
                                    <svg class="icon icon-faucet">
                                        <use xlink:href="/img/symbols.svg#icon-faucet"></use>
                                    </svg>Раздача
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#promoModal">
                                    <svg class="icon icon-promo">
                                        <use xlink:href="/img/symbols.svg#icon-promo"></use>
                                    </svg>Промокоды
                                </a>
                            </li>
                            <li>
                                <a href="/ranks">
                                    <svg class="icon icon-promo">
                                        <use xlink:href="/img/symbols.svg#icon-crash"></use>
                                    </svg>Ранги
                                </a>
                            </li>
                            <li>
                                <a href="/tournament" style="color: gold;">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-top"></use>
                                    </svg>Турнир
                                </a>
                            </li>
                            <li>
                                <a href="/clans">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-person"></use>
                                    </svg>Кланы
                                </a>
                            </li>
                            <li>
                                <a href="/clan/my">
                                    <svg class="icon icon-top">
                                        <use xlink:href="/img/symbols.svg#icon-person"></use>
                                    </svg>Мой клан
                                </a>
                            </li>
                            <li>
                                <a href="/profile/history">
                                    <svg class="icon icon-history">
                                        <use xlink:href="/img/symbols.svg#icon-history"></use>
                                    </svg>История
                                </a>
                            </li>
                            @if(Auth::check() && $u->is_admin)
                            <li>
                                <a href="/admin">
                                    <svg class="icon icon-fairness">
                                        <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                    </svg>ПУ
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endauth
                    <div class="pull-out game">
                     <button class="close-btn">
                        <svg class="icon icon-close">
                           <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                     </button>
                     <ul class="pull-out-nav">
                        <li>
                           <a href="/jackpot">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-jackpot"></use>
                              </svg>
                              Jackpot
                           </a>
                        </li>
                        <li>
                           <a href="/wheel">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-roulette"></use>
                              </svg>
                              Wheel
                           </a>
                        </li>
                        <li>
                           <a href="/crash">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-crash"></use>
                              </svg>
                              Crash
                           </a>
                        </li>
                        <li>
                           <a href="/coinflip">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-flip"></use>
                              </svg>
                              PvP
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
                           <a href="/dice">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-dice"></use>
                              </svg>
                              Dice
                           </a>
                        </li>
                        <li>
                           <a href="/hilo">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-hilo"></use>
                              </svg>
                              Hilo
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
                        <li>
                           <a href="/king">
                              <svg class="icon">
                                 <use xlink:href="/img/symbols.svg#icon-king"></use>
                              </svg>
                              King
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
                     </ul>
                  </div>
                  <div class="mobile-nav-menu-wrapper">
                    <ul class="mobile-nav-menu">
                        <li>
                           <button id="gamesMenu">
                              <svg class="icon icon-gamepad">
                                 <use xlink:href="/img/symbols.svg#icon-gamepad"></use>
                              </svg>
                              Режимы
                           </button>
                        </li>
                        <li>
                           <button id="chatMenu">
                              <svg class="icon icon-conversations">
                                 <use xlink:href="/img/symbols.svg#icon-conversations"></use>
                              </svg>
                              Чат
                           </button>
                        </li>
                        @auth
                        <li>
                           <button onclick="location.href = '/profile/{{ $u->unique_id }}';">
                              <svg class="icon icon-person">
                                 <use xlink:href="/img/symbols.svg#icon-person"></use>
                              </svg>
                              Профиль
                           </button>
                        </li>
                      <!--  <li>
                           <button onclick="$('#settingsModal').modal('show');">
                              <svg class="icon icon-person">
                                 <use xlink:href="/img/symbols.svg#icon-settings"></use>
                              </svg>
                              Настройки
                           </button>
                        </li>-->
                        <li>
                           <button id="otherMenu">
                              <svg class="icon icon-more">
                                 <use xlink:href="/img/symbols.svg#icon-more"></use>
                              </svg>
                              <span>Прочее</span>
                           </button>
                        </li>
                        @endauth
                                             </ul>

                  </div>
               </div>
            </div>
         </div>
         @auth
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
                        <div class="caption-line"><span class="span">Настройки</span></div>
                           <form action="/pay" method="post" id="payment">
                              <div class="form-row">
                                @if($u->tg_id == 0)
                                <a href="{{env('TELEGRAM_LINK')}}?start={{$u->unique_id}}" target="_blank">
                                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px;"><span>Привязать Telegram</span></button>
                                </a>
                                @else
                                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" disabled><span>Telegram привязан</span></button>
                                @endif
                              </div>
                              <button type="submit" class="btn btn-green" disabled>Сохранить изменения</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
            <div class="modal-dialog deposit-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="deposit-modal-component">
                     <div class="wrap">
                        <div class="tabs">
                           <button type="button" class="btn btn-tab isActive">Депозит</button>
                           <button type="button" class="btn btn-tab">Вывод</button>
                        </div>
                        <div class="deposit-section tab active" data-type="deposite">
                           <form action="/pay" method="post" id="payment">
                              <div class="form-row">
                                 <label>
                                    <div class="form-label">Депозит</div>
                                    <div class="form-field">
                                       <div class="input-valid">
                                          <input class="input-field input-with-icon" name="amount" value="50.00" placeholder="Min. Amount: 50.00р.">
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
                                 <div class="form-label">Метод оплаты</div>
                                 <div class="select-payment">
                                    <input type="hidden" name="type" value="" id="depositType">
                                    <div class="bottom-start dropdown">
                                       <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-secondary" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Выберите метод                                          <div class="opener">
                                             <svg class="icon icon-down">
                                                <use xlink:href="/img/symbols.svg#icon-down"></use>
                                             </svg>
                                          </div>
                                       </button>
                                       <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" data-placement="bottom-start">
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="linepay">
                                             <div class="image"><img src="/img/wallets/qiwi.png" alt="linepay"></div>
                                             <span>LinePay</span>
                                          </button>
                                          <button type="button" data-id="1" tabindex="0" role="menuitem" class="dropdown-item" data-system="freekassa">
                                             <div class="image"><img src="/img/wallets/fk.png" alt="freekassa"></div>
                                             <span>Freekassa</span>
                                          </button>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-green">Перейти к оплате</button>
                           </form>
                        </div>
                        <div class="deposit-section tab" data-type="withdraw">
                           <div class="form-row">
                           </div>
                           <div class="form-row">
                              <div class="form-label">Метод вывода</div>
                              <div class="select-payment">
                                 <input type="hidden" name="type" value="" id="withdrawType">
                                 <div class="bottom-start dropdown">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-secondary" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Выберите метод                                       <div class="opener">
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
                                          <span>ЮMoney</span>
                                       </button>
                                       <button type="button" data-id="2" tabindex="0" role="menuitem" class="dropdown-item" data-system="visa">
                                          <div class="image"><img src="/img/wallets/visa.png" alt="visa"></div>
                                          <span>VISA / Mastercard</span>
                                       </button>
                                       <button type="button" data-id="2" tabindex="0" role="menuitem" class="dropdown-item" data-system="mobile" disabled>
                                          <div class="image"><img src="/img/wallets/mobile.png" alt="Мобильные платежи"></div>
                                          <span>Мобильные операторы</span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Введите номер кошелька</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field" name="purse" placeholder="" value="" id="numwallet">
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <div class="form-row">
                              <label>
                                 <div class="form-label">Метод вывода</div>
                                 <div class="form-field">
                                    <div class="input-valid">
                                       <input class="input-field input-with-icon" name="amount" value="" id="valwithdraw" placeholder="Введите сумму">
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
                                 Комиссия: <span>0%</span>
                              </div>
                           </div>
                           <button type="submit" disabled="" class="btn btn-green" id="submitwithdraw">Вывод (<span id="totalwithdraw">0</span>)</button>
                           <div class="checkbox-block">
                              <label>Я подтверждаю правильность реквизитов                              <input name="agree" type="checkbox" id="withdraw-checkbox" value=""><span class="checkmark"></span></label>
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
                    <h3 class="faucet-caption"><span>Обмен бонусов</span></h3>
                    <div class="caption-line"><span class="span"><svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div>
                    <div class="faucet-modal-form">
                        <div class="faucet-reload"><span>Мин. сумма</span> <span>{{$settings->exchange_min}}</span> <svg class="icon icon-coin bonus"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                    </div>
                    <div class="faucet-modal-form">
                        <div class="faucet-reload"><span>Курс</span> <span>{{$settings->exchange_curs}}</span> <svg class="icon icon-coin bonus"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg> = <span>1</span> <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                    </div>
                    <div class="form-row">
                        <label>
                            <div class="form-label">Сумма обмена</div>
                            <div class="form-field">
                                <div class="input-valid">
                                    <input class="input-field input-with-icon" name="amount" placeholder="Введите сумму" id="exSum">
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
                            <div class="faucet-reload"><span>Вы получите:</span> <span id="exTotal">0</span> <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
                        </div>
                        <button type="button" class="btn btn-green exchangeBonus"><span>Обменять</span></button>
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
                     <h3 class="faucet-caption"><span>Активация промокодов</span></h3>
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
                        <button type="button" class="btn btn-green activatePromo"><span>Активировать</span></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="captchaModal" tabindex="-1" role="dialog" aria-labelledby="captchaModalLabel" aria-hidden="true">
            <div class="modal-dialog captcha-need-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="captcha-need-modal-container">
                     <div class="caption">Подтвердите что вы не робот!</div>
                     <div class="form">
                        <div class="label">Нажмите "Я не робот" для продолжения!</div>
                        <div class="captcha">
                           <div hl="ru">
                              <div>
                                 <div style="width: 304px; height: 78px;">
                                    <div data-callback="recaptchaCallback" data-sitekey="6Lf0SVskAAAAAHlPgkSNH4MIo2hYVk6AssAXxnCH" class="g-recaptcha"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <button type="button" disabled="" class="btn" id="submitBonus">Продолжить</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        @if($u->is_admin == 1 || $u->is_moder == 1)
        <div class="modal fade" id="bannedModal" tabindex="-1" role="dialog" aria-labelledby="bannedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button class="modal-close" data-dismiss="modal" aria-label="Close">
                        <svg class="icon icon-close">
                            <use xlink:href="/img/symbols.svg#icon-close"></use>
                        </svg>
                    </button>
                    <div class="faucet-container">
                        <h3 class="faucet-caption"><span>Заблокированные пользователи</span></h3>
                        <h3 class="faucet-caption"><div id="unbanName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <div class="table-heading">
                                <div class="thead">
                                    <div class="tr">
                                        <div class="th">Пользователь</div>
                                        <div class="th">Окончание блокировки</div>
                                        <div class="th">Причина</div>
                                        <div class="th">Действия</div>
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
                        <h3 class="faucet-caption"><span>Блокировка чата пользователю</span></h3>
                        <h3 class="faucet-caption"><div id="banName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <input type="hidden" name="user_ban_id">
                            <label>
                                <div class="form-label">Время бана в минутах</div>
                                <div class="form-field">
                                    <div class="input-valid">
                                        <input class="input-field input-with-icon" name="time" placeholder="Время" id="banTime">
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
                                <div class="form-label">Причина бана</div>
                                <div class="form-field">
                                    <div class="input-valid">
                                        <input class="input-field input-with-icon" name="reason" placeholder="Причина" id="banReason">
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
                            <button type="button" class="btn btn-green banThis"><span>Забанить</span></button>
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
                        <h3 class="faucet-caption"><span>Разблокировка чата пользователю</span></h3>
                        <h3 class="faucet-caption"><div id="unbanName"></div></h3>
                        <div class="caption-line"><span class="span"><svg class="icon"><use xlink:href="/img/symbols.svg#icon-ban"></use></svg></span></div>
                        <div class="form-row">
                            <input type="hidden" name="user_unban_id">
                            <button type="button" class="btn btn-green unbanThis"><span>Разбанить</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
         @endauth
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
                     <p>Понятия, использующиеся в настоящем Соглашении:</p>

<p>«Игра» — развлекательное игровое мероприятие, начинающееся в указанное в расписании Организатора время суток и проходящее в течение определенного непрерывного промежутка времени в соответствии с определенным Организатором сценарием и условиями, которые включают в себя в том числе соблюдение Правил.</p>

<p>«Место оказания услуг» — интернет - сайт, расположенный по адресу: https://moneyear.ru/</p>

<p>«Организатор» — Лицо, являющееся правообладателем Сайта, а также исполнителем, предоставляющим доступ к Сайту.</p>

<p>«Персональные данные» — любая информация, относящаяся прямо или косвенно к определенному или определяемому физическому лицу (субъекту персональных данных).</p>

<p>«Пользователь» — физическое лицо, осуществившее регистрацию на Сайте в соответствии с условиями настоящего Соглашения.</p>

<p>«Правила» — обязательные для соблюдения при получении Услуг каждым Участником требования и правила, включая, но не ограничиваясь: ограничения по возрасту, составу и количеству Участников для участия в Игре, ограничения по состоянию здоровья Участника и его физическому состоянию и т. п. в зависимости от условий оказания Услуги определенного вида.</p>

<p>«Профиль» — комбинация из логина и пароля для доступа к персональной странице Пользователя в рамках Сайта, позволяющая получать доступ к сервисам Сайта.</p>

<p>«Сайт» — ресурс, размещенный в сети Интернет по адресу https://moneyear.ru/, посредством которого обеспечивается предоставление информации об Услугах.</p>

<p>«Услуга», «Услуги» — комплекс мероприятий по предоставлению доступа Пользователя к Сайту, осуществляемых Организатором, а также иных сопутствующих мероприятий в соответствии с поручением Пользователя, Участника (его законного представителя) или иного лица, желающего принять участие в Игре лично или обеспечить участие в Игре иного лица (лиц).</p>

<p>«Внутриигровая валюта» - условная единица, используемая на Сайте для расчета доступных Пользователю дополнительных внутриигровых функций. Внутриигровая валюта не является средством платежа и не может использоваться за пределами Сайта. Внутриигровая валюта может быть начислена Пользователю без внесения платы при совершении Пользователем некоторых действий на Сайте. Действия, влекущие за собой начисление Внутриигровой валюты, определяются Администратором.</p>

<p>«Участник» — физическое лицо, являющееся получателем Услуги (Услуг) по участию в Игре.</p>

<p>1.1. Настоящее Соглашение является публичной офертой в соответствии с п.2 ст. 437 ГК РФ и определяет условия оказания и получения Услуг, положения о бронировании Услуг, а также условия использования Сайта.</p>

<p>1.2. Настоящее Соглашение вступает в силу с момента выражения Пользователем и/или Участником (его законным представителем) согласия с его условиями в порядке, определенном пп. 1.3 и 1.4. настоящего Соглашения, и действует бессрочно.</p>

<p>1.3. Пройдя процедуру регистрации, Пользователь считается подробно ознакомившимся и безоговорочно принявшим условия настоящего Соглашения в полном объеме без ограничений в соответствии со статьей 438 ГК РФ путем проставления отметки о согласии (галочки) в специальном поле рядом со ссылкой на текст Пользовательского Соглашения. В случае, если Пользователь не согласен полностью или частично с положениями настоящего Соглашения, он не вправе использовать Сайт, а также получать Услуги.</p>

<p>1.4. Организатор вправе в любой момент в одностороннем порядке и без какого - либо специального уведомления внести изменения и/или дополнения в настоящее Соглашение путем опубликования обновленной версии на Сайте. Обновленная версия настоящего Соглашения вступает в силу с момента ее публикации на Сайте.</p>

<p>В случае, если Пользователь не согласен полностью или частично с положениями обновлённой версии Соглашения, он не вправе использовать Сайт.</p>

<p>1.6. Условия использования материалов и сервисов Сайта регулируются настоящим Соглашением и иными соглашениями, размещенными на Сайте.</p>

<p>2. Условия предоставления Услуг.</p>

<p>2.1. Для того чтобы получить Услуги, Участник должен приобрести статус Пользователя в порядке, указанном в разделе 4 настоящего Соглашения. Лицо, желающее получить Услуги, также вправе приобрести внутриигровую валюту, согласно разделу 4 настоящего Соглашения.</p>

<p>2.2. К участию в Игре допускаются Участники, соответствующие Правилам в соответствии с разделом 3 настоящего Соглашения.</p>

<p>2.3. Организатор вправе организовывать различные стимулирующие мероприятия с целью привлечения внимания потенциальных Участников к Игре (акции, подарочные карты на участие и т.п.). Порядок их проведения сообщаются Пользователям на Сайте, а также иными способами, определяемыми Организатором.</p>

<p>3. Правила допуска и участия в Игре.</p>

<p>3.1. К участию в Игре допускаются лица от 18-ти лет. Лица в возрасте до 18-ти лет не имеют права участвовать в Игре.</p>

<p>3.2. Физическое, а также психологическое состояние Участника должно соответствовать условиям и порядку проведения Игры и участия в ней. В частности, Игра не предполагает возможность участия в ней следующих категорий лиц:</p>

<p>- лиц с ограниченными возможностями здоровья,</p>

<p>- лиц с психическими расстройствами любого рода в любом проявлении,</p>

<p>- агрессивно настроенных лиц,</p>

<p>- лиц, не соблюдающих каких-либо иных условияй настоящего Соглашения или не соответствующих указанным в настоящем Соглашении требованиям,</p>

<p>- любых иных лиц, в отношении которых существует вероятность того, что участие в Игре может спровоцировать риск возникновения какого - либо рода негативных последствий для Участника.</p>

<p>3.3. Организатор сохраняет за собой безусловное право отказать в оказании Услуг в случае, если у него возникают подозрения в отношении достоверности сообщаемых Участником (его законным представителем) данных по пунктам 3.1. и 3.2. настоящего Соглашения.</p>

<p>3.4. Участник и/или его законный представитель вправе самостоятельно принять решение об отказе в участии в Игре в любой момент времени.</p>

<p>4. Оплата Услуг.</p>

<p>4.1. Оказание Услуг по предоставлению доступа к Сайту, в том числе для участия в Игре, предоставляется только зарегистрированным пользователям. Для участия в игре Пользователь вправе приобрести внутриигровую валюту.</p>

<p>4.2. Приобретение Внутриигровой валюты осуществляется Пользователем на добровольной основе.</p>

<p>4.3. В случае оплаты Внутриигровой валюты, она начисляется Пользователю в объеме, соответствующем оплаченному номиналу. После внесения оплаты или внесения суммы во Внутриигровой валюте на Сайте дальнейшее её использование осуществляется исключительно внутри Сайта, а обязательства Администратора по перечислению Внутриигровой валюты (зачислению оплаты) считаются выполненными в полном объеме независимо от того, воспользуется Пользователь данными определенными дополнительными функциями на Сайте или нет.</p>

<p>4.4. Пользователь признает и соглашается с тем, что Администратор не осуществляет обратную конвертацию Внутриигровой валюты в денежные средства в наличной или безналичной форме и не компенсирует какие-либо расходы Пользователя, включая в том числе расходы в связи с перечислением денежных средств Администратору, а также не выплачивает проценты за использование денежных средств. Пользователь не вправе приобретать Внутриигровую валюту у любых третьих лиц, а также осуществлять продажу или безвозмездную передачу Внутриигровой валюты.</p>

<p>4.5. Пользователь признает и соглашается с тем, что Внутриигровая валюта может быть использована только для получения Пользователем дополнительных внутриигровых функций в рамках игры, и средства, зачисленные на счет Пользователя, не подлежат возврату в какой - либо форме.</p>

<p>4.6. При оплате Услуги Пользователь подтверждает, что полностью осознает, понимает условия настоящего Соглашения и принимает их, а также понимает и соглашается, что Администратор оставляет за собой право в любое время удалять из Сайта любой контент без уведомления Пользователя, в том числе в связи с окончанием срока действия лицензионных соглашений Администратора с правообладателями, и/или добавлять на Сайт любой контент без уведомления Пользователя. До момента оплаты Услуги, Пользователь обязуется предварительно ознакомиться с перечнем единиц контента на Сайте. Оплата Пользователем Услуги означает, что Пользователь ознакомлен с перечнем единиц контента и его полностью удовлетворяет его содержание.</p>

<p>4.7. Стороны признают и соглашаются, что Администратор не несет перед Пользователем ответственности в случае не поступления денежных средств на счет Пользователя по причинам, не зависящим от Администратора, включая, но, не ограничиваясь: сбоями в программном обеспечении или поломках оборудования банков, операторов связи, платежных систем и иных платежных посредников, которые обеспечивают прием платежей за Услуг от Пользователей и их перечисление Администратору. Стороны также признают и соглашаются, что Администратор не обязан оказывать Пользователю Услугу до момента поступления денежных средств за неё от Пользователя на расчетный счет Администратора.</p>

<p>5. Условия использования материалов и сервисов Сайта.</p>

<p>5.1. Пользователь обязуется внимательно ознакомиться с настоящим Соглашением.</p>

<p>5.2. Администратор в одностороннем порядке вправе устанавливать ограничения в использовании материалов и сервисов Сайта как для всех Пользователей, так и для отдельных категорий Пользователей.</p>

<p>5.3. Пользователь не вправе использовать любые устройства, программы, процедуры, алгоритмы и методы, автоматические устройства или эквивалентные ручные процессы для доступа, приобретения, копирования или отслеживания содержания Сайта.</p>

<p>5.4. Пользователь не имеет права нарушать систему безопасности или аутентификации на Сайте или в любой сети, относящейся к Сайту или Администратору.</p>

<p>5.5. Пользователь не имеет права использовать Сайт и его содержание в любых целях, запрещенных законодательством Российской Федерации, а также подстрекать к любой незаконной деятельности или другой деятельности, нарушающей права Организатора и/или других лиц.</p>

<p>6. Персональные данные и политика конфиденциальности.</p>

<p>См. соответствующий раздел.</p>

<p>7. Депозит, перевод, вывод со счета.</p>

<p>7.1. Мы не принимаем денежные депозиты и депозиты / снятия со счетов третьих лиц.</p>

<p>7.2. Все способы оплаты будут доступны на Веб - сайте, они могут отличаться в зависимости от страны, а также могут время от времени изменяться Веб-сайтом.</p>

<p>7.3. Вы несете ответственность за оплату сборов, которые могут взимать платежные системы. Средства, внесенные на счет на Веб - сайте, должны быть очищены от всех таких сборов.</p>

<p>7.4. Вам необходимо положить деньги на счет, который принадлежит Вам, мы можем потребовать подтверждение источника средств. Личные данные указаны на дебетовой / кредитной карте. Электронный кошелек / банковский перевод (например, полное имя) должен совпадать с личными данными учетной записи Пользователя на Веб - сайте, на который переводятся средства.</p>

<p>7.4.1. Если используется кредитная / дебетовая карта, Мы просим Вас предоставить изображения лицевой и обратной стороны Вашей карты с указанием названия и номера карты, даты выдачи и кода CVV.</p>

<p>7.5. Веб - сайт, как и когда он сочтет это необходимым, может изменять пределы пополнения / снятия средств.
7.6. Веб - сайт не является банком или другим учреждением, поэтому на Ваш депозит проценты не начисляются.
7.7 Веб - сайт переведет средства в течение 24 часов после успешного завершения идентификации, как указано выше, или в соответствии с выбранными Вами условиями обработчика платежей. Для некоторых платежных систем перевод может занять до 3 рабочих дней.
7.8. Минимальная сумма для снятия составляет 100 RUB. Лимит снятия средств в неделю: 30 000 RUB. Сайт оставляет за собой право при выводе разделить сумму на меньшие суммы. Снятие средств возможно только при условии наигровки баланса. Вы сможете снять средства, как только наиграете 100% от суммы пополнения.
7.9 Организатор не осуществляет возврат пополненных средств при любых обстоятельствах
8. Ответственность. Ограничение ответственности.</p>

<p>8.1. Доступ к Сайту предоставляется «в том виде, в котором он существует», и Администратор не дает никакой гарантии или заверения в отношении его.</p>

<p>8.2. Пользователь понимает и соглашается с тем, что Администратор может удалять или перемещать (без предупреждения) любые результаты интеллектуальной деятельности, размещенные на Сайте (включая контент), по своему личному усмотрению, по любой причине или без причины, включая без всяких ограничений перемещение или удаление результатов интеллектуальной деятельности.</p>

<p>8.3. Пользователь понимает и соглашается, что Администратор не несет ответственности за любые ошибки, упущения, прерывания, удаления, дефекты, задержки в обработке или передаче данных, сбои линий связи, кражи, уничтожение или неправомерный доступ третьих лиц к результатам интеллектуальной деятельности, размещенным на Сайте. Администратор не отвечает за любые технические сбои или иные проблемы любых телефонных сетей или служб, компьютерных систем, серверов или провайдеров, компьютерного или телефонного оборудования, программного обеспечения, сбоев сервисов электронной почты или скриптов по техническим причинам. Также Администратор не отвечает за соответствие Сайта целиком или его частей (служб) ожиданиям Пользователей, безошибочную и бесперебойную работу сервиса, прекращение доступа Пользователя к Сайту и результатам интеллектуальной деятельности, размещенным на Сайте, убытки, возникшие у Пользователей по причинам, связанным с техническими сбоями аппаратного или программного обеспечения.</p>

<p>8.4. Администратор не несет ответственности за любой ущерб электронным устройствам Пользователя или иного лица, мобильным устройствам, любому другому оборудованию или программному обеспечению, вызванный или связанный с использованием Сайта.</p>

<p>8.5. Ни при каких обстоятельствах Администратор не несет ответственность перед Пользователем или любыми третьими лицами за любой прямой, косвенный, неумышленный ущерб, включая упущенную выгоду или потерянные данные, вред чести, достоинству или деловой репутации, вызванные в связи с использованием Сайта или результатов интеллектуальной деятельности, размещенных на Сайте. В любом случае Стороны соглашаются, что сумма убытков Пользователя за любые нарушения Администратора, связанные с использованием Сайта ограничена Сторонами суммой 500 (пятьсот) рублей.</p>

<p>8.6. Администратор не несет ответственности перед Пользователем или любыми третьими лицами за:</p>

<p>действия Пользователя на Сайте;</p>

<p>содержание и законность, достоверность информации, используемой/получаемой Пользователем на Сайте;</p>

<p>качество товаров/работ/услуг, приобретенных Пользователем, после просмотра рекламных сообщений (баннеров, роликов и т.п.), размещенных на Сайте, и их возможное несоответствие общепринятым стандартам или ожиданиям Пользователя;</p>

<p>достоверность рекламной информации, используемой/получаемой Пользователем на Сайте, и качество рекламируемых в ней товаров/работ/услуг;</p>

<p>последствия применения информации, используемой/получаемой Пользователем на Сайте.</p>

<p>8.7. Администратор не несет ответственности за нарушение Пользователем условий, изложенных в настоящем Соглашении.</p>

<p>8.8. Сайт может содержать ссылки на другие ресурсы глобальной сети Интернет. Пользователь признает и соглашается с тем, что Администратор не контролирует и не несет никакой ответственности за доступность этих ресурсов и за их содержание, а также за любые последствия, связанные с использованием этих ресурсов. Любые переходы по ссылкам, осуществляемые Пользователем, последний производит на свой страх и риск.</p>

<p>9.Обращение с жалобами и применимое законодательство.</p>

<p>9.1. В случае возникновения споров и разногласий решение MoneYear является окончательным и Пользователь с ним полностью согласен. Все споры и разногласия, возникающие в связи с настоящим Соглашением, разрешаются путем переговоров. Если невозможно достичь соглашения путем переговоров, споры, разногласия и претензии, вытекающие из настоящего Соглашения, разрешаются в соответствии с действующим законодательством Нидерландских Антильских островов.
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
                     <h1><span>Честная игра</span></h1>
                     <span>Наша система честной игры гарантирует, что мы не сможем манипулировать исходом игры. <br><br> Точно так же, как вы снимаете колоду в настоящем казино. Эта реализация дает вам полное спокойствие во время игры, зная, что мы не можем "корректировать" ставки в нашу пользу.<br><br></span>
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
                     <button type="button" class="btn btn-rotate checkHash"><span>Проверить</span></button>
                     <div class="fair-table" style="display: none;">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th><span># Игры</span></th>
                                 <th><span>Сгенерированный номер</span></th>
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
    @if(session('error'))
        <script>
        $.notify({
            type: 'error',
            message: "{{ session('error') }}"
        });
        </script>
    @elseif(session('success'))
        <script>
        $.notify({
            type: 'success',
            message: "{{ session('success') }}"
        });
        </script>
    @endif
    </body>
   </html>
@endif
@endif