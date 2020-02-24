@extends('layout')

@section('title')
Ваш профиль
@stop

@section('banner')
<a href="/bonus" class=" bonus-banner bonus-banner_auth  ">
    <div class="hidden-xs bonus-banner__button">Подробнее</div>
</a>
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
                                    <img
                                        src="https://219316.selcdn.ru/egger/money__icon_yellow.png"
                                        alt=""
                                        class="profile-row__balance-img">
                                    {{Auth::user()->money}}<span class="rouble">p</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="profile-row__button-line button-line">
                                    <button
                                        class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_hlight modal-toggle"
                                        data-toggle="add-cash">Пополнить баланс</button>
                                    <button
                                        class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-hlight modal-toggle"
                                        data-toggle="remove-cash">Вывести средства</button>
                                    <a
                                        href="/logout"
                                        onclick="return confirm('Вы действительно хотите выйти из аккаунта?')"
                                        class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-dark">Выйти</a>
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
                                    <img
                                        src="https://219316.selcdn.ru/egger/egg-icon_64.png"
                                        alt=""
                                        class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value profile-row__user-stat-value_alone">
                                    Место в топе:&nbsp;<span>{{$usr_pos}}</span>
                                    <img
                                        src="https://219316.selcdn.ru/egger/position-icon_64.png"
                                        alt=""
                                        class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value">
                                    Пригласил:&nbsp;<span>{{$my_refs}}</span><br>
                                    Заработал:&nbsp;<span>{{$zarabotal}}<span class="rouble">p</span></span>
                                    <img
                                        src="https://219316.selcdn.ru/egger/users-icon_64.png"
                                        alt=""
                                        class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lk-tabs button-line">
                        <a
                            href="/profile"
                            class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            История игр
                        </a>
                        <a
                            href="/profile/partner"
                            class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            Партнёрская программа
                        </a>
                        <a
                            href="/profile/finance"
                            class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark button-rounding_active">
                            Финансы
                        </a>
                    </div>
                    <div id="finance" class="lk-block finance">
                        <div class="lk-block__header">
                            <div class="lk-block__header-line"></div>
                            <div class="lk-block__header-text">Финансовые<span>операции</span></div>
                            <div class="lk-block__header-line"></div>
                        </div>
                        <div class="nav-line finance__nav-line">
                            <div class="nav-line__element finance__nav-element">
                                <div
                                    data-toggleup=""
                                    data-toggledown=".finance__tr_cashout, .finance__tr_cashin, .finance__tr_bonus, .finance__tr_affiliate"
                                    class="nav-line__link finance__filter-button nav-line__link_active">
                                    Все операции
                                </div>
                            </div>
                            <div class="nav-line__element finance__nav-element">
                                <div
                                    data-toggleup=".finance__tr_cashout, .finance__tr_affiliate"
                                    data-toggledown=".finance__tr_cashin, .finance__tr_bonus"
                                    class="nav-line__link finance__filter-button">
                                    Пополнения
                                </div>
                            </div>
                            <div class="nav-line__element finance__nav-element">
                                <div
                                    data-toggleup=".finance__tr_cashin, .finance__tr_bonus, .finance__tr_affiliate"
                                    data-toggledown=".finance__tr_cashout"
                                    class="nav-line__link finance__filter-button">
                                    Выводы
                                </div>
                            </div>
                            <div class="nav-line__element finance__nav-element">
                                <div
                                    data-toggleup=".finance__tr_cashout, .finance__tr_cashin, .finance__tr_bonus"
                                    data-toggledown=".finance__tr_affiliate"
                                    class="nav-line__link finance__filter-button">
                                    Партнерские отчисления
                                </div>
                            </div>
                        </div>
                        <div class="table-col">
                            <table class="finance__table main-table">
                                <thead>
                                    <tr>
                                        <th class="main-table__th main-table__th_center">№</th>
                                        <th class="main-table__th main-table__th_left">Тип операции</th>
                                        <th class="main-table__th main-table__th_left">Название</th>
                                        <th class="main-table__th main-table__th_center">Сумма</th>
                                        <th class="main-table__th main-table__th_center">Статус</th>
                                        <th class="main-table__th main-table__th_center">Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($operations as $key => $o)
                                    <tr class="main-table__tbody-tr finance__tr @if($o->type == 0) finance__tr_cashin @elseif($o->type == 1) finance__tr_cashout @elseif($o->type == 3) finance__tr_affiliate @elseif($o->type == 4) finance__tr_bonus @endif" style="">
                                        <td class="main-table__td main-table__td_reg main-table__th_center">{{$o->id}}</td>
                                        <td class="main-table__td main-table__td_reg main-table__td_left">
                                            <div class="finance__type">@if($o->type == 0) Пополнение баланса @elseif($o->type == 1) Вывод стредств @elseif($o->type == 3) Партнерское начисление @elseif($o->type == 4) Бонусное начисление @endif</div>
                                        </td>
                                        <td class="main-table__td main-table__td_reg main-table__td_left">@if($o->type == 0) Пополнение баланса через платежную систему @elseif($o->type == 1) Вывод средств на кошелек {{ $o->koshelek }} @elseif($o->type == 3) Пополнение счета рефералом @elseif($o->type == 4) Бонусное начисление за регистрацию @endif</td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">{{$o->amount}}<span class="rouble rouble_white">p</span></td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">
                                            <div class="finance__status finance__status_expects">@if($o->status == 0) Ожидание @elseif($o->status == 1) Выполнен @elseif($o->status == 3) Отклонен @endif</div>
                                        </td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">{{$o->timestamp}}</td>
                                    </tr>
									@endforeach
                                </tbody>
                            </table>
                            <div class="button-line button-line_center hidden">
                                <button
                                    class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight"
                                    id="profile_finance_more"
                                    data-last-transaction="">
                                    Показать ещё
                                </button>
                            </div>
                            <div class="button-line button-line_center hidden">
                                <p>У вас пока нет финансовых операций.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop