@extends('layout')

@section('title')
Ваш профиль
@stop

@section('content')
<div class="container">
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
									Заработал:&nbsp;<span>{{$zarabotal*($settings->ref_percent/100)}}<span class="rouble">p</span></span>
									<img src="https://219316.selcdn.ru/egger/users-icon_64.png" alt="" class="profile-row__user-stat-img">
								</div>
							</div>
						</div>
					</div>                    
					<div class="lk-tabs button-line">
                        <a href="/profile" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            История игр
                        </a>
                        <a href="/profile/partner" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark button-rounding_active">
                            Партнёрская программа
                        </a>
                        <a href="/profile/finance" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            Финансы
                        </a>
                    </div>
                    <div class="lk-block">
                        <div class="lk-block__header">
                            <div class="lk-block__header-line"></div>
                            <div class="lk-block__header-text">Партнёрская<span>программа</span></div>
                            <div class="lk-block__header-line"></div>
                        </div>
                        <div class="profile-row__user-affiliate-line">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-row__user-affiliate-block">
                                        <div class="profile-row__user-affiliate-header text-block text-block_fs_m text-block_tf_up text-block_fw_bold">
                                            Приглашай друзей и
                                            &nbsp;<span>зарабатывай {{$settings->ref_percent}}%</span>&nbsp;
                                            от всех пополнений!
                                        </div>
                                        <div class="profile-row__user-affiliate-header-text text-block">Отправь свою уникальную ссылку друзьям и получай {{$settings->ref_percent}}% от каждого пополнения баланса другом! Например: если твой друг пополнит свой баланс на 100 рублей - мы начислим {{100*($settings->ref_percent/100)}} рублей на твой счет!</div>
                                        <div class="profile-row__user-affiliate-input input-block">
										@if(Auth::user()->ref_link != 'none')
											<input value="{{Auth::user()->ref_link}}" readonly="readonly" class="input-block__input input-block__input_size_full">
										@else
											<a href="/profile/partner/get-link" style="margin-top: 10px" id="get-partner-link" class="button-rounding button-rounding_big button-rounding_long button-rounding_hlight">Получить партнерскую ссылку</a>
										@endif
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-block">
                            <div class="faq-block__block">
                                <div class="faq-block__header text-block">Вопросы и ответы:</div>
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                    Что получают мои друзья при регистрации по моей ссылке?
                                </div>
                                <div class="faq-block__answer text-block">Каждый кто зарегистрируется по твоей ссылке получит 1000 бонусных рублей!</div>
                            </div>
                            <div class="faq-block__block">
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                    Где можно распространять партнерскую ссылку?
                                </div>
                                <div class="faq-block__answer text-block">Ты можешь отправить ее в личном сообщении своим друзьям или поставить в описании видео на Youtube про наш сайт. 
                        Мы не ограничиваем распространение партнерских ссылок, кроме случаев СПАМА. В случае выявления спам-рассылок с партнерской ссылкой 
                        мы можем заблокировать твой аккаунт.</div>
                            </div>
                            <div class="faq-block__block">
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                    Как происходит выплата партнерского вознаграждения?
                                </div>
                                <div class="faq-block__answer text-block">Все партнерские отчисления зачисляются на твой баланс. Ты можешь вывести заработанные деньги в любое время.</div>
                            </div>
                        </div>
                        <div class="lk-block__subheader">Привлечённые игроки:</div>
                        <div class="partner-list">
                            <div class="row">
                                <div class="table-col col-xs-12">
                                    <table class="partner-list__table main-table">
                                        <thead>
                                        <tr>
                                            <th class="main-table__th main-table__th_left">Игрок</th>
                                            <th class="main-table__th main-table__th_center">Пополнения</th>
                                            <th class="main-table__th main-table__th_center">Отчисление</th>
                                            <th class="main-table__th main-table__th_center">Дата</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										@foreach($referals as $r)
										<tr>
											<th class="main-table__th main-table__th_left">{{$r->username}}</th>
                                            <th class="main-table__th main-table__th_center">{{$r->deposit}}</th>
                                            <th class="main-table__th main-table__th_center">{{$settings->ref_percent}}%</th>
                                            <th class="main-table__th main-table__th_center">{{$r->updated_at}}</th>
										</tr>
										@endforeach
										</tbody>
                                    </table>
                                    <div class="button-line button-line_center hidden">
                                        <button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_referrals_more" data-last-user="0">
                                            Показать ещё
                                        </button>
                                    </div>
                                    <div class="button-line button-line_center @if(count($referals) > 0) hidden @endif">
                                        <p>У вас пока нет привлеченных игроков.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@stop