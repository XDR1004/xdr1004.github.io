@extends('layout')

@section('bonus')
bonus-page
@stop

@section('content')
<div class="content">
	<div class="bonus">
        <div class="container">
            <div class="bonus__content">
                <div class="bonus__info-wrapper">
					<div class="bonus__info-header">Ваш бонус активирован!</div>
                            <div class="bonus__button-line"></div>
                                        <div class="bonus__info-text">На них можно открыть любой кейс, как при игре на настоящие деньги. Но есть два отличия:</div>
                    <div class="bonus__info-litext">
                        <img src="/img/oval-4.svg" class="bonus__info-litext-icon" alt="oval-4" title="oval-4">
                        Бонусные деньги нельзя вывести
                    </div>
                    <div class="bonus__info-litext">
                        <img src="/img/oval-4.svg" class="bonus__info-litext-icon" alt="oval-4" title="oval-4">
                        Они сгорают при пополнении баланса
                    </div>
                </div>
                <div class="bonus__img-wrapper">
                    <img src="/img/faya.gif" class="bonus__img" alt="faya" title="faya">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bonus-page {
    background: #050202;
}
.live-win{
	display: none;
}
</style>
@stop