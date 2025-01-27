<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>{{$settings->sitename}} | Панель управления</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Montserrat:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link href="/dash/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		<link href="/dash/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="/dash/css/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="/dash/css/flaticon2.css" rel="stylesheet" type="text/css" />
		<link href="/dash/css/style.bundle.css" rel="stylesheet" type="text/css" />
    	<link href="/css/notify.css" rel="stylesheet" />
		<link href="/dash/css/datatables.bundle.min.css" rel="stylesheet" type="text/css" />
		
		<script src="/dash/js/jquery.min.js" type="text/javascript"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    	<script src="/js/wnoty.js" type="text/javascript"></script>
		<script src="/dash/js/popper.min.js" type="text/javascript"></script>
		<script src="/dash/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/dash/js/perfect-scrollbar.min.js" type="text/javascript"></script>
		<script src="/dash/js/scripts.bundle.js" type="text/javascript"></script>
		<script src="/dash/js/datatables.bundle.min.js" type="text/javascript"></script>
	</head>
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="/panel">
					<img alt="Logo" src="/dash/img/logo-light.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="/panel">
								<img alt="Logo" src="/dash/img/logo-light.png" />
							</a>
						</div>
					</div>

					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
							<ul class="kt-menu__nav ">
								<li class="kt-menu__section ">
									<h4 class="kt-menu__section-text">Site management</h4>
									<i class="kt-menu__section-icon flaticon-more-v2"></i>
								</li>
								<li class="kt-menu__item {{ Request::is('panel') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="/panel" class="kt-menu__link">
										<span class="kt-menu__link-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect id="bound" x="0" y="0" width="24" height="24"/>
													<circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
													<path d="M12.4208204,17.1583592 L15.4572949,11.0854102 C15.6425368,10.7149263 15.4923686,10.2644215 15.1218847,10.0791796 C15.0177431,10.0271088 14.9029083,10 14.7864745,10 L12,10 L12,7.17705098 C12,6.76283742 11.6642136,6.42705098 11.25,6.42705098 C10.965921,6.42705098 10.7062236,6.58755277 10.5791796,6.84164079 L7.5427051,12.9145898 C7.35746316,13.2850737 7.50763142,13.7355785 7.87811529,13.9208204 C7.98225687,13.9728912 8.09709167,14 8.21352549,14 L11,14 L11,16.822949 C11,17.2371626 11.3357864,17.572949 11.75,17.572949 C12.034079,17.572949 12.2937764,17.4124472 12.4208204,17.1583592 Z" id="Path-3" fill="#000000"/>
												</g>
											</svg>
										</span>
										<span class="kt-menu__link-text">Promo codes</span>
									</a>
								</li>
								<li class="kt-menu__section ">
									<h4 class="kt-menu__section-text">Chat control</h4>
									<i class="kt-menu__section-icon flaticon-more-v2"></i>
								</li>
								<li class="kt-menu__item {{ Request::is('panel/filter') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
									<a href="/panel/filter" class="kt-menu__link">
										<span class="kt-menu__link-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect id="bound" x="0" y="0" width="24" height="24"/>
													<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"/>
													<path d="M10.5857864,12 L9.17157288,10.5857864 C8.78104858,10.1952621 8.78104858,9.56209717 9.17157288,9.17157288 C9.56209717,8.78104858 10.1952621,8.78104858 10.5857864,9.17157288 L12,10.5857864 L13.4142136,9.17157288 C13.8047379,8.78104858 14.4379028,8.78104858 14.8284271,9.17157288 C15.2189514,9.56209717 15.2189514,10.1952621 14.8284271,10.5857864 L13.4142136,12 L14.8284271,13.4142136 C15.2189514,13.8047379 15.2189514,14.4379028 14.8284271,14.8284271 C14.4379028,15.2189514 13.8047379,15.2189514 13.4142136,14.8284271 L12,13.4142136 L10.5857864,14.8284271 C10.1952621,15.2189514 9.56209717,15.2189514 9.17157288,14.8284271 C8.78104858,14.4379028 8.78104858,13.8047379 9.17157288,13.4142136 L10.5857864,12 Z" id="Combined-Shape" fill="#000000"/>
												</g>
											</svg>
										</span>
										<span class="kt-menu__link-text">Word filter</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
							</div>
						</div>
						<div class="kt-header__topbar">
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile">{{$u->username}}</span>
										<img alt="Pic" src="{{$u->avatar}}" />
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
									<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(/dash/img/bg-1.jpg)">
										<div class="kt-user-card__avatar">
											<img alt="Pic" src="{{$u->avatar}}" />
										</div>
										<div class="kt-user-card__name">
											{{$u->username}}
										</div>
									</div>
									<div class="kt-notification">
										<div class="kt-notification__custom">
											<a href="/" class="btn btn-label-brand btn-sm btn-bold">Return to site</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
						@yield('content')
					</div>

					<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
						<div class="kt-footer__copyright">
							 © &nbsp;<a href="http://vk.com" target="_blank" class="kt-link">Luck2x</a>
						</div>
					</div>

				</div>
			</div>
		</div>
		
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
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