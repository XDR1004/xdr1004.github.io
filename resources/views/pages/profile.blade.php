@extends('layout')

@section('title')
Ваш профиль
@stop

@section('content')
<div class="content">
<?php  $settings = \DB::table('settings')->where('id', 1)->first(); 
		$my_refs = \DB::table('users')->where('ref_use', Auth::user()->id)->count();
		$zarabotal = \DB::table('operations')->where('ref_user', Auth::user()->id)->where('type', 0)->where('status', 1)->sum('amount');
		if($zarabotal == '')
		{
			$zarabotal = 0;
		}
		?>
	<div class="profile-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
					<div class="profile-row__user-info-wrapper">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
								<div class="profile-row__user-avatar">
									<div class="profile-row__user-avatar-wrapper">
										<img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->userame}}" class="profile-row__user-avatar-img">
									</div>
								</div>
								<div class="profile-row__user-name">{{Auth::user()->username}}</div>
								<div class="profile-row__balance">
									<img src="https://219316.selcdn.ru/egger/money__icon_yellow.png" alt="" class="profile-row__balance-img">
									{{Auth::user()->money}}<span class="rouble">p</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
								<div class="profile-row__button-line button-line">
									<button class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_hlight modal-toggle" data-toggle="add-cash">Пополнить баланс</button>
									<button class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-hlight modal-toggle" data-toggle="remove-cash">Вывести средства</button>
									<a href="/logout" onclick="return confirm('Вы действительно хотите выйти из аккаунта?')" class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-dark">Выйти</a>
								</div>
							</div>
						</div>
					</div>
				</div>               
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="profile-row__user-stat-block">
							<div class="profile-row__user-stat-value">
								Открыл кейсов:&nbsp;<span>{{Auth::user()->opened}}</span><br>
								На сумму:&nbsp;<span>{{Auth::user()->profit}}<span class="rouble">p</span></span>
								<img src="https://219316.selcdn.ru/egger/egg-icon_64.png" alt="" class="profile-row__user-stat-img">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="profile-row__user-stat-block">
							<div class="profile-row__user-stat-value profile-row__user-stat-value_alone">
								Место в топе:&nbsp;<span>{{$usr_pos}}</span>
								<img src="https://219316.selcdn.ru/egger/position-icon_64.png" alt="" class="profile-row__user-stat-img">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="profile-row__user-stat-block">
							<div class="profile-row__user-stat-value">
								Пригласил:&nbsp;<span>{{$my_refs}}</span><br>
								Заработал:&nbsp;<span>{{$zarabotal}}<span class="rouble">p</span></span>
								<img src="https://219316.selcdn.ru/egger/users-icon_64.png" alt="" class="profile-row__user-stat-img">
							</div>
						</div>
					</div>
				</div>                    <div class="lk-tabs button-line">
                        <a href="/profile" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark button-rounding_active">
                            История игр
                        </a>
                        <a href="/profile/partner" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            Партнёрская программа
                        </a>
                        <a href="/profile/finance" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            Финансы
                        </a>
                    </div>
                    <div id="game-history" class="lk-block game-history">
                        <div class="lk-block__header">
                            <div class="lk-block__header-line"></div>
                            <div class="lk-block__header-text">История<span>игр</span></div>
                            <div class="lk-block__header-line"></div>
                        </div>
                        <div class="game__contains">
                            <div class="row">
							@if(isset($history) && !empty($history))
								@foreach($history as $h)
								@if(isset($h->image))
								<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
									<div class="game__contains-cell game__contains-cell_none">
										
											<div class="game__contains-img-wrapper game__contains-img-wrapper_with-header">
												<div class="game__contains-header">{{$h->name}}</div>
												<div class="game__contains-egg-glow"></div><img src="{{$h->image}}" alt="" class="game__contains-egg-img">
											</div>
										
									</div>
								</div> 
								@endif
								@endforeach
							@endif
							</div>
                            <div class="button-line button-line_center @if(count($history) != 24) hidden @endif">
                                <button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_games_more" data-user-id="{{Auth::user()->id}}" data-last-game="{{$last_g}} ">
                                    Показать ещё
                                </button>
                            </div>
                            <div class="button-line button-line_center @if(isset($history) && count($history) != 0) hidden @endif">
                                <p>Вы пока не сыграли ни одну игру на баланс.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop