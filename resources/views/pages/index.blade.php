@extends('layout')

@section('title')
Кейсы с деньгами
@stop

@section('banner')
@if(Auth::guest())
<a href="/bonus" class="  bonus-banner ">
    <div class="hidden-xs bonus-banner__button">Подробнее</div>
</a>
@endif
@stop

@section('index')
nav-line__link_active 
@stop

@section('content')
<div class="content">
	<div class="cases-line">
        <div class="container">
            <div class="row eggs-cases-row">
				@foreach($cases as $c)
				<div class="new-card-col col-xs-12 col-sm-4 col-md-3 col-lg-3" id="list-box-{{$c->id}}">
					<a href="/cart/{{$c->id}}">
						<div class="new-card">
							<img
								class="new-card__bg-img"
								src="{{$c->image}}"
								alt=""
							/>
							<div class="new-card__header">
								<div class="new-card__price">
									{{$c->cost}}<span class="rouble">p</span>
								</div>
							</div>
							<div class="new-card__footer">
								<div class="new-card__name">{{$c->name}}</div>
								<div class="new-card__content">
									Выигрыш от
									<span>
									{{$c->min}}<span class="rouble">p</span>
									</span>
									до
									<span>
										{{$c->max}}<span class="rouble">p</span>
									</span>
								</div>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
        </div>
    </div>
    <div class="top-line hidden-xs">
        <div class="container">
            <div class="top-line__header">
                <div class="top-line__header-line"></div>
                <div class="top-line__header-text">Топ<span>10</span></div>
                <div class="top-line__header-line"></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					@foreach($top_users as $key => $user)
					<div class="@if($key == 0) top-line__card top-line__card_gold @elseif($key == 1) top-line__card top-line__card_red @elseif($key == 2) top-line__card top-line__card_blue @else top-line__card top-line__card_default @endif">
						<a href="/user/{{$user->id}}">
							<div class="top-line__position">{{$key+1}}</div>
							<div class="top-line__user-ava">
								<div class="circle-ava">
									<img src="{{$user->avatar}}" alt="{{$user->username}}" class="circle-ava__img"/>
								</div>
							</div>
							<div class="top-line__user-name">{{$user->username}}</div>
							<div class="top-line__user-stat-block">
								<div class="top-line__user-stat">
									<div class="top-line__user-stat-icon"><img src="https://219316.selcdn.ru/egger/egg-icon_gold.png" alt="" class="top-line__user-stat-icon-img"/></div>
									<div class="top-line__user-stat-value">{{$user->opened}}</div>
								</div>
								<div class="top-line__user-stat">
									<div class="top-line__user-stat-icon"><img src="https://219316.selcdn.ru/egger/money__icon_yellow.png" alt="" class="top-line__user-stat-icon-img"/></div>
									<div class="top-line__user-stat-value">{{$user->profit}}<span class="rouble">p</span></div>
								</div>
							</div>
						</a>
					</div>   
					@endforeach
				 </div>
            </div>
        </div>
    </div>
    <div class="advantages-block">
        <div class="container">
            <div class="advantages-block__header">
                <div class="advantages-block__header-line"></div>
                <div class="advantages-block__header-text">Наши <span>преимущества</span></div>
                <div class="advantages-block__header-line"></div>
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="https://219316.selcdn.ru/egger/rocket.png" alt="" class="advantages-block__icon"/></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header">Быстрые выплаты</div>
                    <div class="advantages__text">Минимальное время выплаты всего 1 минута! Все платежи проходят в автоматическом режиме. Вам больше не нужно ждать по 24 часа свой выигрыш! Минимальная сумма для вывода всего 100 рублей! Все выплаты производятся без дополнительных комиссий!</div>
                </div>
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="https://219316.selcdn.ru/egger/wifi.png" alt="" class="advantages-block__icon"/></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header">Безопасность</div>
                    <div class="advantages__text">Все данные надежно защищены и передаются по зашифрованному протоколу SSL, благодаря чему ваша учетная запись в полной безопасности.</div>
                </div>
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="https://219316.selcdn.ru/egger/happy-man.png" alt="" class="advantages-block__icon"/></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header">Открытость и безопасность</div>
                    <div class="advantages__text">Все игры отображаются в живой ленте. Профили игроков открыты вместе с историей всех игр! В целях предотвращения мошенничества мы не публикуем конфиденциальную информацию пользователей и ссылки на профили в социальных сетях!</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@stop

@section('modal')
@if(Auth::guest() && isset($utm_name) && isset($utm_avatar))
<!-- Модалка приветствия -->
<div id="hi-modal" class="modal-window modal-window_size_s modal-window_color_default" style="display: none; margin-top: -154.5px; margin-left: -260px;">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                Привет!
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="modal-window__user-ava modal-window__element circle-ava"><img src="{{$utm_avatar}}" alt="" class="circle-ava__img"></div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="modal-window__element text-block text-block_fs_mb">Денежный бонус от {{$utm_name}}</div>
                    <div class="modal-window__element text-block text-block_color_gray">Чтобы получить бонус пройди простую регистрацию!</div>
                    <div class="modal-window__element">
                        <button data-toggle="login" data-title="Регистрация <span>на сайте</span>" class="modal-toggle modal-window__button button-rounding button-rounding_big button-rounding_light">Пройти регистрацию</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop


@section('foo_index')
footer__nav-link_active
@stop

@section('header_index')
header-menu__link_active
@stop