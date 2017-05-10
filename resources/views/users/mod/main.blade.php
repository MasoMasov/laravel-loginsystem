@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-12">
			<h2><i class="fa fa-users" aria-hidden="true"></i> @lang('auth.Users')</h2>
			@if (session('message'))
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('message') }}
				</div>
			@endif
			
			<table class="table table-striped table-hover table-bordered" width="100%">
				<thead class="thead-inverse">
					<tr>
						<th><i class="fa fa-power-off" aria-hidden="true"></i></th>
						<th>username</th>
						<th>email</th>
						<th>class</th>
						@if(Auth::user()->class > 8)
						<th>
							{{ Form::open(['action'=> ['AdminTools@setInvites','userid'=>0],'class' => 'form-inline']) }}
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" name="inc" value="-1">-</button>
								</span>
								<button class="btn" type="button">inv</button>
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" name="inc" value="1">+</button>
								</span>
							</div>
							{{ Form::close() }}
						</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						@if($user->enabled) <tr> @else <tr class="table-danger"> @endif
						<td>
							@if($user->class < Auth::user()->class)
							{{ Form::open(['action'=> ['ModTools@enableUser','userid'=>$user->id]]) }}
								@if($user->enabled)
									<button type="submit" class="btn btn-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></button>
								@else
									<button type="submit" class="btn btn-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></button>
								@endif
							{{ Form::close() }}
							@endif
						</td>
						<td>
							@if($user->avatar != '')
								<img src="{{ url($user->avatar) }}" class="img-thumbnail" width="50">
							@endif
							{{ $user->name }}
						</td>
						<td>{{ $user->email }}</td>
						<td>
							@if(Auth::user()->class > 9 && Auth::user()->class > $user->class)
								{{ Form::open(['action'=> ['AdminTools@setUserClass','userid'=>$user->id],'class' => 'form-inline']) }}
								<div class="form-group">
									<select name="class" class="form-control">
										@foreach(config('customuser.userclasses') as $classes => $classname)
										<option value="{{ $classes }}" @if($user->class == $classes) selected @endif >{{ $classname }}</option>
										@endforeach
									</select>
									<button type="submit" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
								</div>
								{{ Form::close() }}
							@else
								{{ $user->className }}
							@endif
						</td>
						@if(Auth::user()->class > 8)
						<td>
							{{ Form::open(['action'=> ['AdminTools@setInvites','userid'=>$user->id],'class' => 'form-inline']) }}
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" name="inc" value="-1">-</button>
								</span>
								<button class="btn" type="button">{{ $user->invites }}</button>
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" name="inc" value="1">+</button>
								</span>
							</div>
							{{ Form::close() }}
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection