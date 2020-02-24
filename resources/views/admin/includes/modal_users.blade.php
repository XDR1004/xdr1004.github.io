<script>
	$("#range_1").ionRangeSlider({
		type: "single",
		min: 0,
		max: 100,
		step: 10,
	});
</script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ $user->username }}</h4>
</div>
<form method="post" action="/admin/user/save" class="horizontal-form" id="save">
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<a href="https://vk.com/{{ $user->login }}" target="_blank"><img style="width: 150px;margin: 0 auto;border-radius: 50% !important;display: block;margin-bottom: 15px;" src="{{ $user->avatar }}" /></a>
		</div>
	</div>
	
	<input name="id" value="{{$user->id}}" type="hidden">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Имя Фамилия</label>
					<input type="text" class="form-control" name="name" value="{{ $user->username }}" readonly="readonly">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Баланс</label>
					<input type="number" class="form-control" name="money" value="{{ $user->money }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Админ</label>
					<select class="form-control" tabindex="1" name="is_admin" value="{{ $user->is_admin }}">
						<option value="1" @if($user->is_admin == 1) selected @endif>Да</option>
						<option value="0" @if($user->is_admin == 0) selected @endif>Нет</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Ютубер</label>
					<select class="form-control" tabindex="1" name="is_yt" value="{{ $user->is_yt }}">
						<option value="1" @if($user->is_yt == 1) selected @endif>Да</option>
						<option value="0" @if($user->is_yt == 0) selected @endif>Нет</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Бонусный баланс</label>
					<input type="number" class="form-control" name="bonus_money" value="{{ $user->bonus_money }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Реф.ссылка</label>
					<input type="text" class="form-control" name="ref_link" value="{{ $user->ref_link }}">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Открыл кейсов</label>
					<input type="number" class="form-control" name="opened" value="{{ $user->opened }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">На сумму</label>
					<input type="number" class="form-control" name="deposit" value="{{ $user->deposit }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">Пополнил на сумму: </label>
					<input type="text" class="form-control" value="{{ $user->payed }} РУБ" readonly="readonly">
				</div>
			</div>
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">Вывел на сумму: </label>
					<input type="text" class="form-control" value="{{ $user->with }} РУБ" readonly="readonly">
				</div>
			</div>
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">Ожидает выплаты: </label>
					<input type="text" class="form-control" value="{{ $user->with0 }} РУБ" readonly="readonly">
				</div>
			</div>
		</div>
	</div>
	
</div>
<div class="modal-footer">
	<button type="button" class="btn dark btn-outline" data-dismiss="modal">Закрыть</button>
	<button type="submit" class="btn green"><i class="fa fa-check"></i> Сохранить</button>
</div>
</form>