<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') — Egger</title>
    <link rel="stylesheet" href="/css/common.css?id=ea2af84986443f9fe436">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<?php $settings = \DB::table('settings')->where('id', 1)->first();  ?>
	<script> var vk_group = '{{$settings->vk_group}}'; </script>
</head>

@if(Auth::guest())
<body data-user-id="0" data-user-balance="0">
@else
<body data-user-id="{{Auth::user()->id}}" data-user-balance="@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{Auth::user()->bonus_money}} @else {{Auth::user()->money}} @endif">
@endif

@yield('banner')
<div class="main-wrapper @yield('bonus')">
    <div class="header">
    <div class="container">
        <div class="header-row">
            <div class="header-row__element_static">
                <div class="header-menu-button visible-xs visible-sm">
                    <div class="header-menu-button__wrapper">
                        <div class="header-menu-button__line"></div>
                        <div class="header-menu-button__line"></div>
                        <div class="header-menu-button__line"></div>
                    </div>
                </div>
            </div>
            <div class="header-row__element_static header-row__element_sm-rubber header-row__element_xs-rubber">
                <div class="logo-wrapper hidden-xs"><a href="/"><img src="/img/logo-big.svg" alt="Egger - кейсы с деньгами!" class="logo-wrapper__img"></a></div>
                <div class="logo-wrapper visible-xs"><a href="/"><img src="/img/logo-min.svg" alt="Egger - кейсы с деньгами!" class="logo-wrapper__img"></a></div>
            </div>
            <div class="header-row__element header-row__element_lg-rubber header-row__element_md-rubber">
                <nav class="nav-line hidden-sm hidden-xs">
                    <div class="nav-line__element">
						<a href="/">
							<div class="nav-line__link  @yield('index')">
								Главная
							</div>
						</a>
					</div>
					<div class="nav-line__element">
						<a href="/top100">
							<div class="nav-line__link @yield('top')">
								Рейтинг
							</div>
						</a>
					</div>
					<div class="nav-line__element">
						<a href="/opinions">
							<div class="nav-line__link @yield('opinions')">
								Отзывы
							</div>
						</a>
					</div>
					<div class="nav-line__element">
						<a href="/help">
							<div class="nav-line__link @yield('help')">
								Помощь
							</div>
						</a>
					</div>
                </nav>
            </div>
			@if(Auth::guest())
            <div class="header-row__element_static">
				<div class="header-row__login-button">
                    <button data-toggle="login" data-title="Войти &lt;span&gt;на сайт&lt;/span&gt;" class="modal-toggle button-rounding button-rounding_big button-rounding_hlight">Войти</button>
                    <button data-toggle="login" data-title="Регистрация &lt;span&gt;на сайте&lt;/span&gt;" class="modal-toggle button-rounding button-rounding_big button-rounding_trans-hlight hidden-500">Регистрация</button>
                </div>
			</div>
			@else
			<div class="header-row__element_static">
                <div class="user-block">
                    <div class="user-block__wrapper hidden-xs">
                        <a href="/profile">
                            <div class="user-block__avatar">
                                <img src="{{Auth::user()->avatar}}" class="user-block__avatar-img" alt="Мой профиль">
                            </div>
                        </a>
                    </div>
                    <div class="user-block__wrapper">
                        <div class="user-block__balance-block">
                            <div class="user-block__counters">
                                <div class="user-block__counter-balance">
                                    <span class="user-block__balance_value">@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{ number_format(Auth::user()->bonus_money, 0, ',', ' ') }} @else {{ number_format(Auth::user()->money, 0, ',', ' ') }} @endif</span> ₽
                                </div>
                                <a href="/profile" class="user-block__counters-name-link">Профиль</a>
                            </div>
                            <div class="user-block__cash-buttons">
                                <button data-toggle="add-cash" class="modal-toggle user-block__cashin">
                                    <img src="/img/plus.svg" class="user-block__cash-button-img" alt="Пополнить" title="Пополнить">
                                    <img src="/img/plus-w.svg" class="user-block__cash-button-img user-block__cash-button-img_hover" alt="Пополнить" title="Пополнить">
                                    Пополнить
                                </button>
                                <button data-toggle="remove-cash" class="modal-toggle user-block__cashout">
                                    <img src="/img/minus.svg" class="user-block__cash-button-img" alt="Вывести" title="Вывести">
                                    <img src="/img/minus-w.svg" class="user-block__cash-button-img user-block__cash-button-img_hover" alt="Вывести" title="Вывести">
                                    Вывести
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			@endif
        </div>
    </div>
</div>    <div class="live-win">
    <div class="container">
        <div class="live-win__header">
            <div class="live-win__header-text">Прямой эфир</div>
        </div>
		<?php
			$users = \DB::table('users')->count();
			$drops = \DB::table('games')->count();
			$last_drop = \DB::table('games')->orderBy('id', 'desc')->limit(15)->get();
			foreach($last_drop as $d)
			{
				$item = \DB::table('items')->where('id', $d->drop_item)->first();
				$user = \DB::table('users')->where('id', $d->user)->first();
				
				$d->price = $item->cost;
				$d->avatar = $user->avatar;
			}
		?>
        <div class="live-win__stat-wrapper">
                        <div class="live-win__stat-line">
                <div class="live-win__stat-block live-win__stat-block_gold">
                    <div class="live-win__stat-key">Онлайн:&nbsp;</div>
                    <div id="online-counter" class="live-win__stat-value" data-value="1">1</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_red">
                    <div class="live-win__stat-key">Пользователей:&nbsp;</div>
                    <div id="user-counter" class="live-win__stat-value" data-value="{{$users}}">{{$users}}</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_blue">
                    <div class="live-win__stat-key">Игр:&nbsp;</div>
                    <div id="case-counter" class="live-win__stat-value" data-value="{{$drops}}">{{$drops}}</div>
                </div>
            </div>
        </div>
                <div class="live-win__wrapper">
            <div class="live-win__block-shadow_right"></div>
            <div class="live-win__block-shadow_left"></div>
            <div class="live-win__coins-wrapper">
                <div class="coin-block-min coin-block-min__new_min"></div>
                <div class="coin-block-min coin-block-min__new"></div>
					@foreach($last_drop as $d)
					<div class="coin-block-min coin-block-min_none">
                        <div class="coin-block-min__coin-glow"></div>
                        <img src="/img/coins/90/{{$d->price}}.png" alt="" class="coin-block-min__coin-img"/>
                        <div class="coin-block-min__ava-link">
                            <div class="circle-ava">
                                <a href="/user/{{$d->user}}">
                                    <img src="{{$d->avatar}}" alt="" class="circle-ava__img"/>
                                </a> 
                            </div>
                        </div>
                    </div>
					@endforeach
			</div>
        </div>
    </div>
</div>    
   @yield('content')
</div>
<div class="footer-wrapper">
    <div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-3 col-lg-3 hidden-xs">
                <div class="footer__copyright-block">
                    <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2018</div>
                    <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">Кейсы с деньгами!</div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_m">Написать нам: <a href="/cdn-cgi/l/email-protection#056d6069696a4560626260772b71606468"><span class="text-block__link"><span class="__cf_email__" data-cfemail="2d45484141426d484a4a485f0359484c40">[email&#160;protected]</span></span></a></div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        Авторизуясь на сайте вы принимаете
                        <a href="/terms" class="text-block__link">пользовательское соглашение</a>
                    </div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        <a href="/privacy" class="text-block__link">Политика конфиденциальности</a>
                    </div>
                    <div class="footer__age-limit-wrapper">
                        <div class="age-limit">18+</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                <div class="footer__nav-block">
                    <div class="footer__nav-link  @yield('foo_index') ">
						<a href="/">Главная</a>
					</div>
					<div class="footer__nav-link @yield('foo_top')">
						<a href="/top100">Рейтинг</a>
					</div>
					<div class="footer__nav-link @yield('foo_opinions')">
						<a href="/opinions">Отзывы</a>
					</div>
					<div class="footer__nav-link @yield('foo_help')">
						<a href="/help">Помощь</a>
					</div>
                    
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="footer__pay-system-header text-block text-block_fs_m">Мы принимаем:</div>
                <div class="pay-system">
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_visa_mc.png" alt="Visa/MasterCard" title="Visa/MasterCard" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_ym.png" alt="Яндекс.Деньги" title="Яндекс.Деньги" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_qiwi.png" alt="Qiwi" title="Qiwi" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_payeer.png" alt="Payeer" title="Payeer" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_mts.png" alt="МТС" title="МТС" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_mf.png" alt="Мегафон" title="Мегафон" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_tele2.png" alt="Tele2" title="Tele2" class="pay-system__img"/></div>
					<div class="pay-system__img-wrapper"><img src="https://219316.selcdn.ru/egger/pay-icon_bee.png" alt="Beeline" title="Beeline" class="pay-system__img"/></div>
				</div>
            </div>
            <div class="col-xs-12 visible-xs">
                <div class="footer__copyright-block">
                    <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2018</div>
                    <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">Кейсы с деньгами!</div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_m">Написать нам: <a href="/cdn-cgi/l/email-protection#7e161b1212113e1b19191b0c500a1b1f13"><span class="text-block__link"><span class="__cf_email__" data-cfemail="b1d9d4dddddef1d4d6d6d4c39fc5d4d0dc">[email&#160;protected]</span></span></a></div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        Авторизуясь на сайте вы принимаете
                        <a href="/terms" class="text-block__link">пользовательское соглашение</a></div>
                    <div class="footer__age-limit-wrapper">
                        <div class="age-limit">18+</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
<!--header menu-->
<div class="header-menu-layout"></div>
<!--header menu layout-->
<div class="header-menu">
    <div class="header-menu__logo-line"><img src="/img/logo-big.svg" alt="" class="header-menu__logo-img"></div>
    <div class="header-menu__close-button">
        <img src="/img/close-mobile-menu.svg" alt="" class="header-menu__close-button-img">
        <img src="/img/close-mobile-menu-hover.svg" alt="" class="header-menu__close-button-img header-menu__close-button-img_hover">
    </div>
    <div class="header-menu__link-line">
        <a href="/">
            <div class="header-menu__link  @yield('header_index') ">
                Главная
            </div>
        </a>
    </div>
    <div class="header-menu__link-line">
        <a href="/top100">
            <div class="header-menu__link @yield('header_top')">
                Рейтинг
            </div>
        </a>
    </div>
    <div class="header-menu__link-line">
        <a href="/opinions">
            <div class="header-menu__link @yield('header_opinions')">
                Отзывы
            </div>
        </a>
    </div>
    <div class="header-menu__link-line">
        <a href="/help">
            <div class="header-menu__link @yield('header_help')">
                Помощь
            </div>
        </a>
    </div>
</div><div class="modal-layout"></div>
<div id="login" class="modal-window modal-window_size_s modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Войти <span>на сайт</span>
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element modal-window__social-button-block">
                <div class="modal-window__social-button-wrapper">
                    <a href="/login/vkontakte" title="ВКонтакте" class="modal-window__social-button modal-window__social-button_vk"><img src="https://219316.selcdn.ru/egger/logo-vk.png" alt="site.AuthVK" class="modal-window__social-button-img"></a>
                </div>
                
                <div class="modal-window__social-button-wrapper">
                    <a href="/login/odnoklassniki" title="Одноклассники" class="modal-window__social-button modal-window__social-button_ok"><img src="https://219316.selcdn.ru/egger/logo-ok.png" alt="site.AuthOK" class="modal-window__social-button-img"></a>
                </div>
            </div>
        </div>
    </div>
</div><div id="add-cash" class="modal-window modal-window_size_m modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Пополнить <span>баланс</span>
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">Введите сумму:</div>
            <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                <div class="input-block modal-window__input-wrapper">
                    <input class="input-block__input payment-amount" title="Сумма платежа" value="<?php echo $settings->min_dep; ?>">
                </div>
            </div>
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">Выберите способ пополнения:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system">
						<div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="1" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_mc-visa_l.png" alt="Банковская карта" class="pay-system__img">
                        </div>
						<div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="5" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_ym_l.png" alt="Яндекс.Деньги" class="pay-system__img">
                        </div>
						<div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="4" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_qiwi_l.png" alt="Qiwi" class="pay-system__img">
                        </div>
                                                                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="10" data-provider="2">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_payeer_l.png" alt="Payeer" class="pay-system__img">
                        </div>
                                                                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="19" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_mts_l.png" alt="МТС" class="pay-system__img">
                        </div>
                                                                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="18" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_mf_l.png" alt="Мегафон" class="pay-system__img">
                        </div>
                                                                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="21" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_bee_l.png" alt="Билайн" class="pay-system__img">
                        </div>
                                                                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="20" data-provider="3">
                            <img src="https://219316.selcdn.ru/egger/pay-icon_tele2_l.png" alt="Теле2" class="pay-system__img">
                        </div>
                                        <div class="pay-system__img-wrapper pay-system__more pay-system__more_show">
                        <div class="pay-system__more-button">Ещё</div>
                    </div>
                    <div class="pay-system__img-wrapper pay-system__more pay-system__more_hide">
                        <div class="pay-system__more-button">Скрыть</div>
                    </div>
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight" id="payment-in-submit">Пополнить</button>
            </div>
        </div>
    </div>
</div>
@if(!Auth::guest() && Auth::user()->deposit >= $settings->min_width)
<div id="remove-cash" class="modal-window modal-window_size_s modal-window_color_default" style="display: none; margin-top: -124.5px; margin-left: -260px;">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Вывод <span>средств</span>
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
                            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center text-block_align_center">Выберите платёжную систему:</div>
                <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                    <div class="modal-window__pay-system pay-system modal-window__pay-system_center">
                                                                                                             <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="5" data-provider="3">
                                <img src="https://219316.selcdn.ru/egger/pay-icon_ym_l_big.png" alt="Яндекс.Деньги" class="pay-system__img">
                            </div>
                                                                                <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="4" data-provider="3">
                                <img src="https://219316.selcdn.ru/egger/pay-icon_qiwi_l_big.png" alt="Qiwi" class="pay-system__img">
                            </div>
                                                                                <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="10" data-provider="2">
                                <img src="https://219316.selcdn.ru/egger/pay-icon_payeer_l_big.png" alt="Payeer" class="pay-system__img">
                            </div>
                                                                                                                                                                </div>
                    <input type="hidden" class="payment-currency">
                    <input type="hidden" class="payment-provider">
                </div>
                <div class="modal-window__amount_purse hidden">
                    <div class="modal-window__element-header modal-window__element-header_no-margin-bottom text-block text-block_tf_up text-block_align_center">Доступно для вывода: <span class="yellow total_amount">0</span><span class="rouble yellow">p</span></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">Введите сумму:</div>
                            <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                                <div class="input-block modal-window__input-wrapper">
                                    <input class="input-block__input payment-amount" title="Сумма выплаты">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center purse_label">Введите кошелёк:</div>
                            <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                                <div class="input-block modal-window__input-wrapper">
                                    <input class="input-block__input payment-purse" title="Кошелек для выплаты">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-window__element modal-window__element_no-margin-top modal-window__button-block">
                        <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_trans-hlight" id="payment-out-submit">Вывести</button>
                    </div>
                </div>
                    </div>
    </div>
</div>
@else
<div id="remove-cash" class="modal-window modal-window_size_s modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Вывод <span>средств</span>
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
				<div class="modal-window__element text-block text-block_color_gray text-block_align_center">Для активации вывода средств необходимо пополнить баланс от {{$settings->min_width}} руб.</div>
                <div class="modal-window__element modal-window__button-block">
                    <button data-toggle="add-cash" class="modal-toggle modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight">Пополнить баланс</button>
                </div>
		</div>
    </div>
</div>
@endif
<div id="alert-modal" class="modal-window modal-window_size_s">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header"></div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element text-block text-block_color_gray text-block_align_center"></div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight">Войти</button>
            </div>
        </div>
    </div>
</div>
<!--Модалка ожидайте входа-->
<div id="entering-modal" class="modal-window modal-window_size_s modal-window_color_info">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Вход
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="modal-window__element text-block text-block_fs_mb">
                        Выполняется вход, пожалуйста подождите...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('modal')

<!--
<a href="http://www.free-kassa.ru/"><img src="http://www.free-kassa.ru/img/fk_btn/14.png"></a>
 -->

<input type="hidden" id="flash_status" value="">
<script data-cfasync="false" src="/cdn-cgi/scripts/af2821b0/cloudflare-static/email-decode.min.js"></script>
<script type="text/javascript" src="/js/app.js?id=baca541411ef5613df69"></script>
<script type="text/javascript" src="/js/react.js?id=de5187640871bb394b76"></script>
<script src="https://cdn.socket.io/socket.io-1.0.0.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-97673662-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>