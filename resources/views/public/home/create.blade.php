<div class="container-fluid">
	{!! Form::open(array('url' => URL::to('item'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> false,'id'=>'form-item')) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@if (count($errors) > 0)  
			        <div class="alert alert-danger alert-dismissible" role="alert">
			          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			          <ol>
			          {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
			          </ol>          
			        </div>
				@endif	
				@if(Session::has('alert_success'))
		          <div class="alert alert-success alert-dismissible" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            {{ Session::get("alert_success") }}		            
		          </div>
		        @endif
		        @if(Session::has('alert_danger'))
		          <div class="alert alert-success alert-dismissible" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            {{ Session::get("alert_danger") }}		            
		          </div>
		        @endif
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<div class="panel panel-default">			
					<div class="panel-body">			   
			              <div class="form-group">
			                <label for="vendor" class="col-md-3 control-label">Vendor</label>
			                <div class="col-md-9">
			                  {!! Form::select('vendor', $vendor, null, ['class' => 'form-control group-error']) !!}
			                </div>
		       			  </div>
		       			  <div class="form-group">
		       			  	{{ Form::label('container', 'Container#', ['class' => 'col-md-3 control-label text-danger']) }}
			                <div class="col-md-9">
			                  {{ Form::text('container', NULL, array_merge(['class' => 'form-control','id'=>'container'], array())) }}
			                </div>
		       			  </div>
		       			  <div class="form-group">
		       			  	{{ Form::label('receive', 'Reiceive#', ['class' => 'col-md-3 control-label']) }}
			                <div class="col-md-9">
			                  {{ Form::text('receive', NULL, array_merge(['class' => 'form-control','id'=>'receive'], array())) }}
			                </div>
		       			  </div>       			          
					</div>
				</div>
			</div>           
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">		
				<div class="panel panel-default">
					<div class="panel-body">
				   	  <div class="form-group">
		                <label for="measure" class="col-md-4 control-label">Measurement</label>
		                <div class="col-md-8">
		                  {!! Form::select('measure', $measure, null, ['class' => 'form-control']) !!}
		                </div>
		   			  </div>
		   			  <div class="form-group">
		   			  	{{ Form::label('Date', 'Date#', ['class' => 'col-md-4 control-label']) }}
		                <div class="col-md-8">
		                  {{ Form::text('date', NULL, array_merge(['class' => 'form-control','id'=>'date','disabled'], array())) }}
		                </div>
		   			  </div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">		
				<div class="panel panel-default">
					<div class="panel-body">
				   	  <div class="form-group">
					   	  	<div class="col-md-6">
						   	  	<div class="btn-group" role="group" aria-label="Basic example">
						   	  		{!! Form::button('Add',['class'=>'btn btn-success','id'=>'add']) !!}
						   	  		{!! Form::button('Remove',['class'=>'btn btn-danger','id'=>'remove']) !!}					   	  		
						   	  	</div>
					   	  	</div>
			                <div class="col-md-6">
				                <div class="input-group"> 
				                {{ Form::text('action', NULL, array_merge(['class' => 'form-control','id'=>'action'], array())) }} 
				                <span class="input-group-addon" id="basic-addon2">#Row</span>
				                </div>		                	
			                </div>
		   			  </div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">	
				<div class="panel panel-primary">
					  <div class="panel-heading">
							<h3 class="panel-title">Action</h3>
					  </div>
					  <div class="panel-body">
							{!! Form::button('Cancel',['class'=>'btn btn-default']) !!}
	   	  					{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}				
					  </div>
				</div>   	  		
			</div>
		</div>
		<div class="alert alert-info no-display" id="handler_error">
			
			
		</div>
		<div class="row">	
			{{-- */$i = 0;$list = array(11,12,13,14)/* --}}
			@foreach($item as $key => $val)
				@if($i == count($item))
					</div></div>
				@endif
				@if($i == 0)
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="row">
				@endif
				@if($i !=0 && $i%2==0 && $i%4==0)
					</div></div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="row">
				@endif
				@if(in_array($i , $list))
				{{-- */$class="";/* --}}
				@else
				{{-- */$class="text-red";/* --}}
				@endif
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 {{ $class }}">							
						{{ ucwords($val) }}						
						{{ Form::text($val.'[0]', NULL, array_merge(['class' => 'form-control style-margin'], array('data-name'=>$val))) }}	

						@if(count($errors) > 0)
							@for($j = 1; $j < count(old($val)) ; $j++)
								{{ Form::text($val.'['.$j.']', NULL, array_merge(['class' => 'form-control style-margin'], array('data-name'=>$val))) }}
							@endfor
						@endif		
						</div>
						{{-- <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							b
						</div>			
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							c
						</div>			
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							d
						</div>		 --}}					
{{-- 					</div>
				</div> --}}
				{{-- */$i++/* --}}
			@endforeach
			
		</div>
	{!! Form::close() !!}
</div>
