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